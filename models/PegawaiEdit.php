<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PegawaiEdit extends Pegawai
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'pegawai';

    // Page object name
    public $PageObjName = "PegawaiEdit";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page layout
    public $UseLayout = true;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl($withArgs = true)
    {
        $route = GetRoute();
        $args = RemoveXss($route->getArguments());
        if (!$withArgs) {
            foreach ($args as $key => &$val) {
                $val = "";
            }
            unset($val);
        }
        $url = rtrim(UrlFor($route->getName(), $args), "/") . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return $this->TableVar == $CurrentForm->getValue("t");
            }
            if (Get("t") !== null) {
                return $this->TableVar == Get("t");
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;
        global $UserTable;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (pegawai)
        if (!isset($GLOBALS["pegawai"]) || get_class($GLOBALS["pegawai"]) == PROJECT_NAMESPACE . "pegawai") {
            $GLOBALS["pegawai"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'pegawai');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $tbl = Container("pegawai");
                $doc = new $class($tbl);
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "PegawaiView") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
		        $this->foto->OldUploadPath = "file_foto";
		        $this->foto->UploadPath = $this->foto->OldUploadPath;
		        $this->file_cv->OldUploadPath = "file_cv";
		        $this->file_cv->UploadPath = $this->file_cv->OldUploadPath;
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['id'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id->Visible = false;
        }
    }

    // Lookup data
    public function lookup($ar = null)
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = $ar["field"] ?? Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = $ar["ajax"] ?? Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal") || SameText($lookupType, "filter")) {
            $searchValue = $ar["q"] ?? Param("q") ?? $ar["sv"] ?? Post("sv", "");
            $pageSize = $ar["n"] ?? Param("n") ?? $ar["recperpage"] ?? Post("recperpage", 10);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = $ar["q"] ?? Param("q", "");
            $pageSize = $ar["n"] ?? Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
        }
        $start = $ar["start"] ?? Param("start", -1);
        $start = is_numeric($start) ? (int)$start : -1;
        $page = $ar["page"] ?? Param("page", -1);
        $page = is_numeric($page) ? (int)$page : -1;
        $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        $userSelect = Decrypt($ar["s"] ?? Post("s", ""));
        $userFilter = Decrypt($ar["f"] ?? Post("f", ""));
        $userOrderBy = Decrypt($ar["o"] ?? Post("o", ""));
        $keys = $ar["keys"] ?? Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        $lookup->FilterValues = []; // Clear filter values first
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = $ar["v0"] ?? $ar["lookupValue"] ?? Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = $ar["v" . $i] ?? Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        return $lookup->toJson($this, !is_array($ar)); // Use settings from current page
    }

    // Properties
    public $FormClassName = "ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";
        $this->UseLayout = $this->UseLayout && !$this->IsModal;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id->Visible = false;
        $this->pid->Visible = false;
        $this->_username->setVisibility();
        $this->_password->setVisibility();
        $this->nip->setVisibility();
        $this->nama->setVisibility();
        $this->alamat->setVisibility();
        $this->_email->setVisibility();
        $this->wa->setVisibility();
        $this->hp->setVisibility();
        $this->tgllahir->setVisibility();
        $this->rekbank->setVisibility();
        $this->jenjang_id->setVisibility();
        $this->pendidikan->setVisibility();
        $this->jurusan->setVisibility();
        $this->agama->setVisibility();
        $this->jabatan->setVisibility();
        $this->jenkel->setVisibility();
        $this->mulai_bekerja->setVisibility();
        $this->status->setVisibility();
        $this->keterangan->setVisibility();
        $this->level->setVisibility();
        $this->aktif->setVisibility();
        $this->foto->setVisibility();
        $this->file_cv->setVisibility();
        $this->hideFieldsForAddEdit();

        // Set lookup cache
        if (!in_array($this->PageID, Config("LOOKUP_CACHE_PAGE_IDS"))) {
            $this->setUseLookupCache(false);
        }

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->jenjang_id);
        $this->setupLookupOptions($this->pendidikan);
        $this->setupLookupOptions($this->agama);
        $this->setupLookupOptions($this->jabatan);
        $this->setupLookupOptions($this->jenkel);
        $this->setupLookupOptions($this->level);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-edit-form";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("id") ?? Key(0) ?? Route(2)) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->id->setOldValue($this->id->QueryStringValue);
            } elseif (Post("id") !== null) {
                $this->id->setFormValue(Post("id"));
                $this->id->setOldValue($this->id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("id") ?? Route("id")) !== null) {
                    $this->id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                    // Load current record
                    $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values

            // Set up detail parameters
            $this->setupDetailParms();
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("PegawaiList"); // No matching record, return to list
                        return;
                    }

                // Set up detail parameters
                $this->setupDetailParms();
                break;
            case "update": // Update
                $returnUrl = "PegawaiList";
                if (GetPageName($returnUrl) == "PegawaiList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsApi()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed

                    // Set up detail parameters
                    $this->setupDetailParms();
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }

            // Render search option
            if (method_exists($this, "renderSearchOptions")) {
                $this->renderSearchOptions();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
        $this->foto->Upload->Index = $CurrentForm->Index;
        $this->foto->Upload->uploadFile();
        $this->foto->CurrentValue = $this->foto->Upload->FileName;
        $this->file_cv->Upload->Index = $CurrentForm->Index;
        $this->file_cv->Upload->uploadFile();
        $this->file_cv->CurrentValue = $this->file_cv->Upload->FileName;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'username' first before field var 'x__username'
        $val = $CurrentForm->hasValue("username") ? $CurrentForm->getValue("username") : $CurrentForm->getValue("x__username");
        if (!$this->_username->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_username->Visible = false; // Disable update for API request
            } else {
                $this->_username->setFormValue($val);
            }
        }

        // Check field name 'password' first before field var 'x__password'
        $val = $CurrentForm->hasValue("password") ? $CurrentForm->getValue("password") : $CurrentForm->getValue("x__password");
        if (!$this->_password->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_password->Visible = false; // Disable update for API request
            } else {
                $this->_password->setFormValue($val);
            }
        }

        // Check field name 'nip' first before field var 'x_nip'
        $val = $CurrentForm->hasValue("nip") ? $CurrentForm->getValue("nip") : $CurrentForm->getValue("x_nip");
        if (!$this->nip->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nip->Visible = false; // Disable update for API request
            } else {
                $this->nip->setFormValue($val);
            }
        }

        // Check field name 'nama' first before field var 'x_nama'
        $val = $CurrentForm->hasValue("nama") ? $CurrentForm->getValue("nama") : $CurrentForm->getValue("x_nama");
        if (!$this->nama->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nama->Visible = false; // Disable update for API request
            } else {
                $this->nama->setFormValue($val);
            }
        }

        // Check field name 'alamat' first before field var 'x_alamat'
        $val = $CurrentForm->hasValue("alamat") ? $CurrentForm->getValue("alamat") : $CurrentForm->getValue("x_alamat");
        if (!$this->alamat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->alamat->Visible = false; // Disable update for API request
            } else {
                $this->alamat->setFormValue($val);
            }
        }

        // Check field name 'email' first before field var 'x__email'
        $val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
        if (!$this->_email->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_email->Visible = false; // Disable update for API request
            } else {
                $this->_email->setFormValue($val);
            }
        }

        // Check field name 'wa' first before field var 'x_wa'
        $val = $CurrentForm->hasValue("wa") ? $CurrentForm->getValue("wa") : $CurrentForm->getValue("x_wa");
        if (!$this->wa->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->wa->Visible = false; // Disable update for API request
            } else {
                $this->wa->setFormValue($val);
            }
        }

        // Check field name 'hp' first before field var 'x_hp'
        $val = $CurrentForm->hasValue("hp") ? $CurrentForm->getValue("hp") : $CurrentForm->getValue("x_hp");
        if (!$this->hp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->hp->Visible = false; // Disable update for API request
            } else {
                $this->hp->setFormValue($val);
            }
        }

        // Check field name 'tgllahir' first before field var 'x_tgllahir'
        $val = $CurrentForm->hasValue("tgllahir") ? $CurrentForm->getValue("tgllahir") : $CurrentForm->getValue("x_tgllahir");
        if (!$this->tgllahir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tgllahir->Visible = false; // Disable update for API request
            } else {
                $this->tgllahir->setFormValue($val, true, $validate);
            }
            $this->tgllahir->CurrentValue = UnFormatDateTime($this->tgllahir->CurrentValue, $this->tgllahir->formatPattern());
        }

        // Check field name 'rekbank' first before field var 'x_rekbank'
        $val = $CurrentForm->hasValue("rekbank") ? $CurrentForm->getValue("rekbank") : $CurrentForm->getValue("x_rekbank");
        if (!$this->rekbank->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rekbank->Visible = false; // Disable update for API request
            } else {
                $this->rekbank->setFormValue($val);
            }
        }

        // Check field name 'jenjang_id' first before field var 'x_jenjang_id'
        $val = $CurrentForm->hasValue("jenjang_id") ? $CurrentForm->getValue("jenjang_id") : $CurrentForm->getValue("x_jenjang_id");
        if (!$this->jenjang_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jenjang_id->Visible = false; // Disable update for API request
            } else {
                $this->jenjang_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'pendidikan' first before field var 'x_pendidikan'
        $val = $CurrentForm->hasValue("pendidikan") ? $CurrentForm->getValue("pendidikan") : $CurrentForm->getValue("x_pendidikan");
        if (!$this->pendidikan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pendidikan->Visible = false; // Disable update for API request
            } else {
                $this->pendidikan->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'jurusan' first before field var 'x_jurusan'
        $val = $CurrentForm->hasValue("jurusan") ? $CurrentForm->getValue("jurusan") : $CurrentForm->getValue("x_jurusan");
        if (!$this->jurusan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jurusan->Visible = false; // Disable update for API request
            } else {
                $this->jurusan->setFormValue($val);
            }
        }

        // Check field name 'agama' first before field var 'x_agama'
        $val = $CurrentForm->hasValue("agama") ? $CurrentForm->getValue("agama") : $CurrentForm->getValue("x_agama");
        if (!$this->agama->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->agama->Visible = false; // Disable update for API request
            } else {
                $this->agama->setFormValue($val);
            }
        }

        // Check field name 'jabatan' first before field var 'x_jabatan'
        $val = $CurrentForm->hasValue("jabatan") ? $CurrentForm->getValue("jabatan") : $CurrentForm->getValue("x_jabatan");
        if (!$this->jabatan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jabatan->Visible = false; // Disable update for API request
            } else {
                $this->jabatan->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'jenkel' first before field var 'x_jenkel'
        $val = $CurrentForm->hasValue("jenkel") ? $CurrentForm->getValue("jenkel") : $CurrentForm->getValue("x_jenkel");
        if (!$this->jenkel->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jenkel->Visible = false; // Disable update for API request
            } else {
                $this->jenkel->setFormValue($val);
            }
        }

        // Check field name 'mulai_bekerja' first before field var 'x_mulai_bekerja'
        $val = $CurrentForm->hasValue("mulai_bekerja") ? $CurrentForm->getValue("mulai_bekerja") : $CurrentForm->getValue("x_mulai_bekerja");
        if (!$this->mulai_bekerja->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->mulai_bekerja->Visible = false; // Disable update for API request
            } else {
                $this->mulai_bekerja->setFormValue($val, true, $validate);
            }
            $this->mulai_bekerja->CurrentValue = UnFormatDateTime($this->mulai_bekerja->CurrentValue, $this->mulai_bekerja->formatPattern());
        }

        // Check field name 'status' first before field var 'x_status'
        $val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
        if (!$this->status->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->status->Visible = false; // Disable update for API request
            } else {
                $this->status->setFormValue($val);
            }
        }

        // Check field name 'keterangan' first before field var 'x_keterangan'
        $val = $CurrentForm->hasValue("keterangan") ? $CurrentForm->getValue("keterangan") : $CurrentForm->getValue("x_keterangan");
        if (!$this->keterangan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->keterangan->Visible = false; // Disable update for API request
            } else {
                $this->keterangan->setFormValue($val);
            }
        }

        // Check field name 'level' first before field var 'x_level'
        $val = $CurrentForm->hasValue("level") ? $CurrentForm->getValue("level") : $CurrentForm->getValue("x_level");
        if (!$this->level->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->level->Visible = false; // Disable update for API request
            } else {
                $this->level->setFormValue($val);
            }
        }

        // Check field name 'aktif' first before field var 'x_aktif'
        $val = $CurrentForm->hasValue("aktif") ? $CurrentForm->getValue("aktif") : $CurrentForm->getValue("x_aktif");
        if (!$this->aktif->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->aktif->Visible = false; // Disable update for API request
            } else {
                $this->aktif->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey) {
            $this->id->setFormValue($val);
        }
		$this->foto->OldUploadPath = "file_foto";
		$this->foto->UploadPath = $this->foto->OldUploadPath;
		$this->file_cv->OldUploadPath = "file_cv";
		$this->file_cv->UploadPath = $this->file_cv->OldUploadPath;
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->_username->CurrentValue = $this->_username->FormValue;
        $this->_password->CurrentValue = $this->_password->FormValue;
        $this->nip->CurrentValue = $this->nip->FormValue;
        $this->nama->CurrentValue = $this->nama->FormValue;
        $this->alamat->CurrentValue = $this->alamat->FormValue;
        $this->_email->CurrentValue = $this->_email->FormValue;
        $this->wa->CurrentValue = $this->wa->FormValue;
        $this->hp->CurrentValue = $this->hp->FormValue;
        $this->tgllahir->CurrentValue = $this->tgllahir->FormValue;
        $this->tgllahir->CurrentValue = UnFormatDateTime($this->tgllahir->CurrentValue, $this->tgllahir->formatPattern());
        $this->rekbank->CurrentValue = $this->rekbank->FormValue;
        $this->jenjang_id->CurrentValue = $this->jenjang_id->FormValue;
        $this->pendidikan->CurrentValue = $this->pendidikan->FormValue;
        $this->jurusan->CurrentValue = $this->jurusan->FormValue;
        $this->agama->CurrentValue = $this->agama->FormValue;
        $this->jabatan->CurrentValue = $this->jabatan->FormValue;
        $this->jenkel->CurrentValue = $this->jenkel->FormValue;
        $this->mulai_bekerja->CurrentValue = $this->mulai_bekerja->FormValue;
        $this->mulai_bekerja->CurrentValue = UnFormatDateTime($this->mulai_bekerja->CurrentValue, $this->mulai_bekerja->formatPattern());
        $this->status->CurrentValue = $this->status->FormValue;
        $this->keterangan->CurrentValue = $this->keterangan->FormValue;
        $this->level->CurrentValue = $this->level->FormValue;
        $this->aktif->CurrentValue = $this->aktif->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssociative($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }
        if (!$row) {
            return;
        }

        // Call Row Selected event
        $this->rowSelected($row);
        $this->id->setDbValue($row['id']);
        $this->pid->setDbValue($row['pid']);
        $this->_username->setDbValue($row['username']);
        $this->_password->setDbValue($row['password']);
        $this->nip->setDbValue($row['nip']);
        $this->nama->setDbValue($row['nama']);
        $this->alamat->setDbValue($row['alamat']);
        $this->_email->setDbValue($row['email']);
        $this->wa->setDbValue($row['wa']);
        $this->hp->setDbValue($row['hp']);
        $this->tgllahir->setDbValue($row['tgllahir']);
        $this->rekbank->setDbValue($row['rekbank']);
        $this->jenjang_id->setDbValue($row['jenjang_id']);
        $this->pendidikan->setDbValue($row['pendidikan']);
        $this->jurusan->setDbValue($row['jurusan']);
        $this->agama->setDbValue($row['agama']);
        $this->jabatan->setDbValue($row['jabatan']);
        $this->jenkel->setDbValue($row['jenkel']);
        $this->mulai_bekerja->setDbValue($row['mulai_bekerja']);
        $this->status->setDbValue($row['status']);
        $this->keterangan->setDbValue($row['keterangan']);
        $this->level->setDbValue($row['level']);
        $this->aktif->setDbValue($row['aktif']);
        $this->foto->Upload->DbValue = $row['foto'];
        $this->foto->setDbValue($this->foto->Upload->DbValue);
        $this->file_cv->Upload->DbValue = $row['file_cv'];
        $this->file_cv->setDbValue($this->file_cv->Upload->DbValue);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['pid'] = $this->pid->DefaultValue;
        $row['username'] = $this->_username->DefaultValue;
        $row['password'] = $this->_password->DefaultValue;
        $row['nip'] = $this->nip->DefaultValue;
        $row['nama'] = $this->nama->DefaultValue;
        $row['alamat'] = $this->alamat->DefaultValue;
        $row['email'] = $this->_email->DefaultValue;
        $row['wa'] = $this->wa->DefaultValue;
        $row['hp'] = $this->hp->DefaultValue;
        $row['tgllahir'] = $this->tgllahir->DefaultValue;
        $row['rekbank'] = $this->rekbank->DefaultValue;
        $row['jenjang_id'] = $this->jenjang_id->DefaultValue;
        $row['pendidikan'] = $this->pendidikan->DefaultValue;
        $row['jurusan'] = $this->jurusan->DefaultValue;
        $row['agama'] = $this->agama->DefaultValue;
        $row['jabatan'] = $this->jabatan->DefaultValue;
        $row['jenkel'] = $this->jenkel->DefaultValue;
        $row['mulai_bekerja'] = $this->mulai_bekerja->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        $row['keterangan'] = $this->keterangan->DefaultValue;
        $row['level'] = $this->level->DefaultValue;
        $row['aktif'] = $this->aktif->DefaultValue;
        $row['foto'] = $this->foto->DefaultValue;
        $row['file_cv'] = $this->file_cv->DefaultValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id
        $this->id->RowCssClass = "row";

        // pid
        $this->pid->RowCssClass = "row";

        // username
        $this->_username->RowCssClass = "row";

        // password
        $this->_password->RowCssClass = "row";

        // nip
        $this->nip->RowCssClass = "row";

        // nama
        $this->nama->RowCssClass = "row";

        // alamat
        $this->alamat->RowCssClass = "row";

        // email
        $this->_email->RowCssClass = "row";

        // wa
        $this->wa->RowCssClass = "row";

        // hp
        $this->hp->RowCssClass = "row";

        // tgllahir
        $this->tgllahir->RowCssClass = "row";

        // rekbank
        $this->rekbank->RowCssClass = "row";

        // jenjang_id
        $this->jenjang_id->RowCssClass = "row";

        // pendidikan
        $this->pendidikan->RowCssClass = "row";

        // jurusan
        $this->jurusan->RowCssClass = "row";

        // agama
        $this->agama->RowCssClass = "row";

        // jabatan
        $this->jabatan->RowCssClass = "row";

        // jenkel
        $this->jenkel->RowCssClass = "row";

        // mulai_bekerja
        $this->mulai_bekerja->RowCssClass = "row";

        // status
        $this->status->RowCssClass = "row";

        // keterangan
        $this->keterangan->RowCssClass = "row";

        // level
        $this->level->RowCssClass = "row";

        // aktif
        $this->aktif->RowCssClass = "row";

        // foto
        $this->foto->RowCssClass = "row";

        // file_cv
        $this->file_cv->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // pid
            $this->pid->ViewValue = $this->pid->CurrentValue;
            $this->pid->ViewValue = FormatNumber($this->pid->ViewValue, $this->pid->formatPattern());
            $this->pid->ViewCustomAttributes = "";

            // username
            $this->_username->ViewValue = $this->_username->CurrentValue;
            $this->_username->ViewCustomAttributes = "";

            // password
            $this->_password->ViewValue = $this->_password->CurrentValue;
            $this->_password->ViewCustomAttributes = "";

            // nip
            $this->nip->ViewValue = $this->nip->CurrentValue;
            $this->nip->ViewCustomAttributes = "";

            // nama
            $this->nama->ViewValue = $this->nama->CurrentValue;
            $this->nama->ViewCustomAttributes = "";

            // alamat
            $this->alamat->ViewValue = $this->alamat->CurrentValue;
            $this->alamat->ViewCustomAttributes = "";

            // email
            $this->_email->ViewValue = $this->_email->CurrentValue;
            $this->_email->ViewCustomAttributes = "";

            // wa
            $this->wa->ViewValue = $this->wa->CurrentValue;
            $this->wa->ViewCustomAttributes = "";

            // hp
            $this->hp->ViewValue = $this->hp->CurrentValue;
            $this->hp->ViewCustomAttributes = "";

            // tgllahir
            $this->tgllahir->ViewValue = $this->tgllahir->CurrentValue;
            $this->tgllahir->ViewValue = FormatDateTime($this->tgllahir->ViewValue, $this->tgllahir->formatPattern());
            $this->tgllahir->ViewCustomAttributes = "";

            // rekbank
            $this->rekbank->ViewValue = $this->rekbank->CurrentValue;
            $this->rekbank->ViewCustomAttributes = "";

            // jenjang_id
            $this->jenjang_id->ViewValue = $this->jenjang_id->CurrentValue;
            $curVal = strval($this->jenjang_id->CurrentValue);
            if ($curVal != "") {
                $this->jenjang_id->ViewValue = $this->jenjang_id->lookupCacheOption($curVal);
                if ($this->jenjang_id->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->jenjang_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->jenjang_id->Lookup->renderViewRow($rswrk[0]);
                        $this->jenjang_id->ViewValue = $this->jenjang_id->displayValue($arwrk);
                    } else {
                        $this->jenjang_id->ViewValue = FormatNumber($this->jenjang_id->CurrentValue, $this->jenjang_id->formatPattern());
                    }
                }
            } else {
                $this->jenjang_id->ViewValue = null;
            }
            $this->jenjang_id->ViewCustomAttributes = "";

            // pendidikan
            $this->pendidikan->ViewValue = $this->pendidikan->CurrentValue;
            $curVal = strval($this->pendidikan->CurrentValue);
            if ($curVal != "") {
                $this->pendidikan->ViewValue = $this->pendidikan->lookupCacheOption($curVal);
                if ($this->pendidikan->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->pendidikan->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->pendidikan->Lookup->renderViewRow($rswrk[0]);
                        $this->pendidikan->ViewValue = $this->pendidikan->displayValue($arwrk);
                    } else {
                        $this->pendidikan->ViewValue = FormatNumber($this->pendidikan->CurrentValue, $this->pendidikan->formatPattern());
                    }
                }
            } else {
                $this->pendidikan->ViewValue = null;
            }
            $this->pendidikan->ViewCustomAttributes = "";

            // jurusan
            $this->jurusan->ViewValue = $this->jurusan->CurrentValue;
            $this->jurusan->ViewCustomAttributes = "";

            // agama
            $this->agama->ViewValue = $this->agama->CurrentValue;
            $curVal = strval($this->agama->CurrentValue);
            if ($curVal != "") {
                $this->agama->ViewValue = $this->agama->lookupCacheOption($curVal);
                if ($this->agama->ViewValue === null) { // Lookup from database
                    $filterWrk = "`name`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->agama->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->agama->Lookup->renderViewRow($rswrk[0]);
                        $this->agama->ViewValue = $this->agama->displayValue($arwrk);
                    } else {
                        $this->agama->ViewValue = $this->agama->CurrentValue;
                    }
                }
            } else {
                $this->agama->ViewValue = null;
            }
            $this->agama->ViewCustomAttributes = "";

            // jabatan
            $this->jabatan->ViewValue = $this->jabatan->CurrentValue;
            $curVal = strval($this->jabatan->CurrentValue);
            if ($curVal != "") {
                $this->jabatan->ViewValue = $this->jabatan->lookupCacheOption($curVal);
                if ($this->jabatan->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->jabatan->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->jabatan->Lookup->renderViewRow($rswrk[0]);
                        $this->jabatan->ViewValue = $this->jabatan->displayValue($arwrk);
                    } else {
                        $this->jabatan->ViewValue = FormatNumber($this->jabatan->CurrentValue, $this->jabatan->formatPattern());
                    }
                }
            } else {
                $this->jabatan->ViewValue = null;
            }
            $this->jabatan->ViewCustomAttributes = "";

            // jenkel
            $curVal = strval($this->jenkel->CurrentValue);
            if ($curVal != "") {
                $this->jenkel->ViewValue = $this->jenkel->lookupCacheOption($curVal);
                if ($this->jenkel->ViewValue === null) { // Lookup from database
                    $filterWrk = "`gen`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->jenkel->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->jenkel->Lookup->renderViewRow($rswrk[0]);
                        $this->jenkel->ViewValue = $this->jenkel->displayValue($arwrk);
                    } else {
                        $this->jenkel->ViewValue = $this->jenkel->CurrentValue;
                    }
                }
            } else {
                $this->jenkel->ViewValue = null;
            }
            $this->jenkel->ViewCustomAttributes = "";

            // mulai_bekerja
            $this->mulai_bekerja->ViewValue = $this->mulai_bekerja->CurrentValue;
            $this->mulai_bekerja->ViewValue = FormatDateTime($this->mulai_bekerja->ViewValue, $this->mulai_bekerja->formatPattern());
            $this->mulai_bekerja->ViewCustomAttributes = "";

            // status
            $this->status->ViewValue = $this->status->CurrentValue;
            $this->status->ViewCustomAttributes = "";

            // keterangan
            $this->keterangan->ViewValue = $this->keterangan->CurrentValue;
            $this->keterangan->ViewCustomAttributes = "";

            // level
            if ($Security->canAdmin()) { // System admin
                $curVal = strval($this->level->CurrentValue);
                if ($curVal != "") {
                    $this->level->ViewValue = $this->level->lookupCacheOption($curVal);
                    if ($this->level->ViewValue === null) { // Lookup from database
                        $filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                        $sqlWrk = $this->level->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                        $conn = Conn();
                        $config = $conn->getConfiguration();
                        $config->setResultCacheImpl($this->Cache);
                        $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                        $ari = count($rswrk);
                        if ($ari > 0) { // Lookup values found
                            $arwrk = $this->level->Lookup->renderViewRow($rswrk[0]);
                            $this->level->ViewValue = $this->level->displayValue($arwrk);
                        } else {
                            $this->level->ViewValue = FormatNumber($this->level->CurrentValue, $this->level->formatPattern());
                        }
                    }
                } else {
                    $this->level->ViewValue = null;
                }
            } else {
                $this->level->ViewValue = $Language->phrase("PasswordMask");
            }
            $this->level->ViewCustomAttributes = "";

            // aktif
            $this->aktif->ViewValue = $this->aktif->CurrentValue;
            $this->aktif->ViewValue = FormatNumber($this->aktif->ViewValue, $this->aktif->formatPattern());
            $this->aktif->ViewCustomAttributes = "";

            // foto
            $this->foto->UploadPath = "file_foto";
            if (!EmptyValue($this->foto->Upload->DbValue)) {
                $this->foto->ViewValue = $this->foto->Upload->DbValue;
            } else {
                $this->foto->ViewValue = "";
            }
            $this->foto->ViewCustomAttributes = "";

            // file_cv
            $this->file_cv->UploadPath = "file_cv";
            if (!EmptyValue($this->file_cv->Upload->DbValue)) {
                $this->file_cv->ViewValue = $this->file_cv->Upload->DbValue;
            } else {
                $this->file_cv->ViewValue = "";
            }
            $this->file_cv->ViewCustomAttributes = "";

            // username
            $this->_username->LinkCustomAttributes = "";
            $this->_username->HrefValue = "";

            // password
            $this->_password->LinkCustomAttributes = "";
            $this->_password->HrefValue = "";

            // nip
            $this->nip->LinkCustomAttributes = "";
            $this->nip->HrefValue = "";

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";

            // email
            $this->_email->LinkCustomAttributes = "";
            $this->_email->HrefValue = "";

            // wa
            $this->wa->LinkCustomAttributes = "";
            $this->wa->HrefValue = "";

            // hp
            $this->hp->LinkCustomAttributes = "";
            $this->hp->HrefValue = "";

            // tgllahir
            $this->tgllahir->LinkCustomAttributes = "";
            $this->tgllahir->HrefValue = "";

            // rekbank
            $this->rekbank->LinkCustomAttributes = "";
            $this->rekbank->HrefValue = "";

            // jenjang_id
            $this->jenjang_id->LinkCustomAttributes = "";
            $this->jenjang_id->HrefValue = "";

            // pendidikan
            $this->pendidikan->LinkCustomAttributes = "";
            $this->pendidikan->HrefValue = "";

            // jurusan
            $this->jurusan->LinkCustomAttributes = "";
            $this->jurusan->HrefValue = "";

            // agama
            $this->agama->LinkCustomAttributes = "";
            $this->agama->HrefValue = "";

            // jabatan
            $this->jabatan->LinkCustomAttributes = "";
            $this->jabatan->HrefValue = "";

            // jenkel
            $this->jenkel->LinkCustomAttributes = "";
            $this->jenkel->HrefValue = "";

            // mulai_bekerja
            $this->mulai_bekerja->LinkCustomAttributes = "";
            $this->mulai_bekerja->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // keterangan
            $this->keterangan->LinkCustomAttributes = "";
            $this->keterangan->HrefValue = "";

            // level
            $this->level->LinkCustomAttributes = "";
            $this->level->HrefValue = "";

            // aktif
            $this->aktif->LinkCustomAttributes = "";
            $this->aktif->HrefValue = "";

            // foto
            $this->foto->LinkCustomAttributes = "";
            $this->foto->HrefValue = "";
            $this->foto->ExportHrefValue = $this->foto->UploadPath . $this->foto->Upload->DbValue;

            // file_cv
            $this->file_cv->LinkCustomAttributes = "";
            $this->file_cv->HrefValue = "";
            $this->file_cv->ExportHrefValue = $this->file_cv->UploadPath . $this->file_cv->Upload->DbValue;
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // username
            $this->_username->setupEditAttributes();
            $this->_username->EditCustomAttributes = "";
            if (!$this->_username->Raw) {
                $this->_username->CurrentValue = HtmlDecode($this->_username->CurrentValue);
            }
            $this->_username->EditValue = HtmlEncode($this->_username->CurrentValue);
            $this->_username->PlaceHolder = RemoveHtml($this->_username->caption());

            // password
            $this->_password->setupEditAttributes();
            $this->_password->EditCustomAttributes = "";
            if (!$this->_password->Raw) {
                $this->_password->CurrentValue = HtmlDecode($this->_password->CurrentValue);
            }
            $this->_password->EditValue = HtmlEncode($this->_password->CurrentValue);
            $this->_password->PlaceHolder = RemoveHtml($this->_password->caption());

            // nip
            $this->nip->setupEditAttributes();
            $this->nip->EditCustomAttributes = "";
            if (!$this->nip->Raw) {
                $this->nip->CurrentValue = HtmlDecode($this->nip->CurrentValue);
            }
            $this->nip->EditValue = HtmlEncode($this->nip->CurrentValue);
            $this->nip->PlaceHolder = RemoveHtml($this->nip->caption());

            // nama
            $this->nama->setupEditAttributes();
            $this->nama->EditCustomAttributes = "";
            if (!$this->nama->Raw) {
                $this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
            }
            $this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
            $this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

            // alamat
            $this->alamat->setupEditAttributes();
            $this->alamat->EditCustomAttributes = "";
            if (!$this->alamat->Raw) {
                $this->alamat->CurrentValue = HtmlDecode($this->alamat->CurrentValue);
            }
            $this->alamat->EditValue = HtmlEncode($this->alamat->CurrentValue);
            $this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

            // email
            $this->_email->setupEditAttributes();
            $this->_email->EditCustomAttributes = "";
            if (!$this->_email->Raw) {
                $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
            }
            $this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
            $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

            // wa
            $this->wa->setupEditAttributes();
            $this->wa->EditCustomAttributes = "";
            if (!$this->wa->Raw) {
                $this->wa->CurrentValue = HtmlDecode($this->wa->CurrentValue);
            }
            $this->wa->EditValue = HtmlEncode($this->wa->CurrentValue);
            $this->wa->PlaceHolder = RemoveHtml($this->wa->caption());

            // hp
            $this->hp->setupEditAttributes();
            $this->hp->EditCustomAttributes = "";
            if (!$this->hp->Raw) {
                $this->hp->CurrentValue = HtmlDecode($this->hp->CurrentValue);
            }
            $this->hp->EditValue = HtmlEncode($this->hp->CurrentValue);
            $this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

            // tgllahir
            $this->tgllahir->setupEditAttributes();
            $this->tgllahir->EditCustomAttributes = "";
            $this->tgllahir->EditValue = HtmlEncode(FormatDateTime($this->tgllahir->CurrentValue, $this->tgllahir->formatPattern()));
            $this->tgllahir->PlaceHolder = RemoveHtml($this->tgllahir->caption());

            // rekbank
            $this->rekbank->setupEditAttributes();
            $this->rekbank->EditCustomAttributes = "";
            if (!$this->rekbank->Raw) {
                $this->rekbank->CurrentValue = HtmlDecode($this->rekbank->CurrentValue);
            }
            $this->rekbank->EditValue = HtmlEncode($this->rekbank->CurrentValue);
            $this->rekbank->PlaceHolder = RemoveHtml($this->rekbank->caption());

            // jenjang_id
            $this->jenjang_id->setupEditAttributes();
            $this->jenjang_id->EditCustomAttributes = "";
            $this->jenjang_id->EditValue = HtmlEncode($this->jenjang_id->CurrentValue);
            $curVal = strval($this->jenjang_id->CurrentValue);
            if ($curVal != "") {
                $this->jenjang_id->EditValue = $this->jenjang_id->lookupCacheOption($curVal);
                if ($this->jenjang_id->EditValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->jenjang_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->jenjang_id->Lookup->renderViewRow($rswrk[0]);
                        $this->jenjang_id->EditValue = $this->jenjang_id->displayValue($arwrk);
                    } else {
                        $this->jenjang_id->EditValue = HtmlEncode(FormatNumber($this->jenjang_id->CurrentValue, $this->jenjang_id->formatPattern()));
                    }
                }
            } else {
                $this->jenjang_id->EditValue = null;
            }
            $this->jenjang_id->PlaceHolder = RemoveHtml($this->jenjang_id->caption());

            // pendidikan
            $this->pendidikan->setupEditAttributes();
            $this->pendidikan->EditCustomAttributes = "";
            $this->pendidikan->EditValue = HtmlEncode($this->pendidikan->CurrentValue);
            $curVal = strval($this->pendidikan->CurrentValue);
            if ($curVal != "") {
                $this->pendidikan->EditValue = $this->pendidikan->lookupCacheOption($curVal);
                if ($this->pendidikan->EditValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->pendidikan->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->pendidikan->Lookup->renderViewRow($rswrk[0]);
                        $this->pendidikan->EditValue = $this->pendidikan->displayValue($arwrk);
                    } else {
                        $this->pendidikan->EditValue = HtmlEncode(FormatNumber($this->pendidikan->CurrentValue, $this->pendidikan->formatPattern()));
                    }
                }
            } else {
                $this->pendidikan->EditValue = null;
            }
            $this->pendidikan->PlaceHolder = RemoveHtml($this->pendidikan->caption());

            // jurusan
            $this->jurusan->setupEditAttributes();
            $this->jurusan->EditCustomAttributes = "";
            if (!$this->jurusan->Raw) {
                $this->jurusan->CurrentValue = HtmlDecode($this->jurusan->CurrentValue);
            }
            $this->jurusan->EditValue = HtmlEncode($this->jurusan->CurrentValue);
            $this->jurusan->PlaceHolder = RemoveHtml($this->jurusan->caption());

            // agama
            $this->agama->setupEditAttributes();
            $this->agama->EditCustomAttributes = "";
            if (!$this->agama->Raw) {
                $this->agama->CurrentValue = HtmlDecode($this->agama->CurrentValue);
            }
            $this->agama->EditValue = HtmlEncode($this->agama->CurrentValue);
            $curVal = strval($this->agama->CurrentValue);
            if ($curVal != "") {
                $this->agama->EditValue = $this->agama->lookupCacheOption($curVal);
                if ($this->agama->EditValue === null) { // Lookup from database
                    $filterWrk = "`name`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->agama->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->agama->Lookup->renderViewRow($rswrk[0]);
                        $this->agama->EditValue = $this->agama->displayValue($arwrk);
                    } else {
                        $this->agama->EditValue = HtmlEncode($this->agama->CurrentValue);
                    }
                }
            } else {
                $this->agama->EditValue = null;
            }
            $this->agama->PlaceHolder = RemoveHtml($this->agama->caption());

            // jabatan
            $this->jabatan->setupEditAttributes();
            $this->jabatan->EditCustomAttributes = "";
            $this->jabatan->EditValue = HtmlEncode($this->jabatan->CurrentValue);
            $curVal = strval($this->jabatan->CurrentValue);
            if ($curVal != "") {
                $this->jabatan->EditValue = $this->jabatan->lookupCacheOption($curVal);
                if ($this->jabatan->EditValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->jabatan->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->jabatan->Lookup->renderViewRow($rswrk[0]);
                        $this->jabatan->EditValue = $this->jabatan->displayValue($arwrk);
                    } else {
                        $this->jabatan->EditValue = HtmlEncode(FormatNumber($this->jabatan->CurrentValue, $this->jabatan->formatPattern()));
                    }
                }
            } else {
                $this->jabatan->EditValue = null;
            }
            $this->jabatan->PlaceHolder = RemoveHtml($this->jabatan->caption());

            // jenkel
            $this->jenkel->EditCustomAttributes = "";
            $curVal = trim(strval($this->jenkel->CurrentValue));
            if ($curVal != "") {
                $this->jenkel->ViewValue = $this->jenkel->lookupCacheOption($curVal);
            } else {
                $this->jenkel->ViewValue = $this->jenkel->Lookup !== null && is_array($this->jenkel->lookupOptions()) ? $curVal : null;
            }
            if ($this->jenkel->ViewValue !== null) { // Load from cache
                $this->jenkel->EditValue = array_values($this->jenkel->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`gen`" . SearchString("=", $this->jenkel->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->jenkel->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->jenkel->EditValue = $arwrk;
            }
            $this->jenkel->PlaceHolder = RemoveHtml($this->jenkel->caption());

            // mulai_bekerja
            $this->mulai_bekerja->setupEditAttributes();
            $this->mulai_bekerja->EditCustomAttributes = "";
            $this->mulai_bekerja->EditValue = HtmlEncode(FormatDateTime($this->mulai_bekerja->CurrentValue, $this->mulai_bekerja->formatPattern()));
            $this->mulai_bekerja->PlaceHolder = RemoveHtml($this->mulai_bekerja->caption());

            // status
            $this->status->setupEditAttributes();
            $this->status->EditCustomAttributes = "";
            if (!$this->status->Raw) {
                $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
            }
            $this->status->EditValue = HtmlEncode($this->status->CurrentValue);
            $this->status->PlaceHolder = RemoveHtml($this->status->caption());

            // keterangan
            $this->keterangan->setupEditAttributes();
            $this->keterangan->EditCustomAttributes = "";
            if (!$this->keterangan->Raw) {
                $this->keterangan->CurrentValue = HtmlDecode($this->keterangan->CurrentValue);
            }
            $this->keterangan->EditValue = HtmlEncode($this->keterangan->CurrentValue);
            $this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

            // level
            $this->level->setupEditAttributes();
            $this->level->EditCustomAttributes = "";
            if (!$Security->canAdmin()) { // System admin
                $this->level->EditValue = $Language->phrase("PasswordMask");
            } else {
                $curVal = trim(strval($this->level->CurrentValue));
                if ($curVal != "") {
                    $this->level->ViewValue = $this->level->lookupCacheOption($curVal);
                } else {
                    $this->level->ViewValue = $this->level->Lookup !== null && is_array($this->level->lookupOptions()) ? $curVal : null;
                }
                if ($this->level->ViewValue !== null) { // Load from cache
                    $this->level->EditValue = array_values($this->level->lookupOptions());
                } else { // Lookup from database
                    if ($curVal == "") {
                        $filterWrk = "0=1";
                    } else {
                        $filterWrk = "`userlevelid`" . SearchString("=", $this->level->CurrentValue, DATATYPE_NUMBER, "");
                    }
                    $sqlWrk = $this->level->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    $arwrk = $rswrk;
                    $this->level->EditValue = $arwrk;
                }
                $this->level->PlaceHolder = RemoveHtml($this->level->caption());
            }

            // aktif
            $this->aktif->setupEditAttributes();
            $this->aktif->EditCustomAttributes = "";
            $this->aktif->EditValue = HtmlEncode($this->aktif->CurrentValue);
            $this->aktif->PlaceHolder = RemoveHtml($this->aktif->caption());
            if (strval($this->aktif->EditValue) != "" && is_numeric($this->aktif->EditValue)) {
                $this->aktif->EditValue = FormatNumber($this->aktif->EditValue, null);
            }

            // foto
            $this->foto->setupEditAttributes();
            $this->foto->EditCustomAttributes = "";
            $this->foto->UploadPath = "file_foto";
            if (!EmptyValue($this->foto->Upload->DbValue)) {
                $this->foto->EditValue = $this->foto->Upload->DbValue;
            } else {
                $this->foto->EditValue = "";
            }
            if (!EmptyValue($this->foto->CurrentValue)) {
                $this->foto->Upload->FileName = $this->foto->CurrentValue;
            }
            if ($this->isShow()) {
                RenderUploadField($this->foto);
            }

            // file_cv
            $this->file_cv->setupEditAttributes();
            $this->file_cv->EditCustomAttributes = "";
            $this->file_cv->UploadPath = "file_cv";
            if (!EmptyValue($this->file_cv->Upload->DbValue)) {
                $this->file_cv->EditValue = $this->file_cv->Upload->DbValue;
            } else {
                $this->file_cv->EditValue = "";
            }
            if (!EmptyValue($this->file_cv->CurrentValue)) {
                $this->file_cv->Upload->FileName = $this->file_cv->CurrentValue;
            }
            if ($this->isShow()) {
                RenderUploadField($this->file_cv);
            }

            // Edit refer script

            // username
            $this->_username->LinkCustomAttributes = "";
            $this->_username->HrefValue = "";

            // password
            $this->_password->LinkCustomAttributes = "";
            $this->_password->HrefValue = "";

            // nip
            $this->nip->LinkCustomAttributes = "";
            $this->nip->HrefValue = "";

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";

            // email
            $this->_email->LinkCustomAttributes = "";
            $this->_email->HrefValue = "";

            // wa
            $this->wa->LinkCustomAttributes = "";
            $this->wa->HrefValue = "";

            // hp
            $this->hp->LinkCustomAttributes = "";
            $this->hp->HrefValue = "";

            // tgllahir
            $this->tgllahir->LinkCustomAttributes = "";
            $this->tgllahir->HrefValue = "";

            // rekbank
            $this->rekbank->LinkCustomAttributes = "";
            $this->rekbank->HrefValue = "";

            // jenjang_id
            $this->jenjang_id->LinkCustomAttributes = "";
            $this->jenjang_id->HrefValue = "";

            // pendidikan
            $this->pendidikan->LinkCustomAttributes = "";
            $this->pendidikan->HrefValue = "";

            // jurusan
            $this->jurusan->LinkCustomAttributes = "";
            $this->jurusan->HrefValue = "";

            // agama
            $this->agama->LinkCustomAttributes = "";
            $this->agama->HrefValue = "";

            // jabatan
            $this->jabatan->LinkCustomAttributes = "";
            $this->jabatan->HrefValue = "";

            // jenkel
            $this->jenkel->LinkCustomAttributes = "";
            $this->jenkel->HrefValue = "";

            // mulai_bekerja
            $this->mulai_bekerja->LinkCustomAttributes = "";
            $this->mulai_bekerja->HrefValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";

            // keterangan
            $this->keterangan->LinkCustomAttributes = "";
            $this->keterangan->HrefValue = "";

            // level
            $this->level->LinkCustomAttributes = "";
            $this->level->HrefValue = "";

            // aktif
            $this->aktif->LinkCustomAttributes = "";
            $this->aktif->HrefValue = "";

            // foto
            $this->foto->LinkCustomAttributes = "";
            $this->foto->HrefValue = "";
            $this->foto->ExportHrefValue = $this->foto->UploadPath . $this->foto->Upload->DbValue;

            // file_cv
            $this->file_cv->LinkCustomAttributes = "";
            $this->file_cv->HrefValue = "";
            $this->file_cv->ExportHrefValue = $this->file_cv->UploadPath . $this->file_cv->Upload->DbValue;
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        $validateForm = true;
        if ($this->_username->Required) {
            if (!$this->_username->IsDetailKey && EmptyValue($this->_username->FormValue)) {
                $this->_username->addErrorMessage(str_replace("%s", $this->_username->caption(), $this->_username->RequiredErrorMessage));
            }
        }
        if (!$this->_username->Raw && Config("REMOVE_XSS") && CheckUsername($this->_username->FormValue)) {
            $this->_username->addErrorMessage($Language->phrase("InvalidUsernameChars"));
        }
        if ($this->_password->Required) {
            if (!$this->_password->IsDetailKey && EmptyValue($this->_password->FormValue)) {
                $this->_password->addErrorMessage(str_replace("%s", $this->_password->caption(), $this->_password->RequiredErrorMessage));
            }
        }
        if (!$this->_password->Raw && Config("REMOVE_XSS") && CheckPassword($this->_password->FormValue)) {
            $this->_password->addErrorMessage($Language->phrase("InvalidPasswordChars"));
        }
        if ($this->nip->Required) {
            if (!$this->nip->IsDetailKey && EmptyValue($this->nip->FormValue)) {
                $this->nip->addErrorMessage(str_replace("%s", $this->nip->caption(), $this->nip->RequiredErrorMessage));
            }
        }
        if ($this->nama->Required) {
            if (!$this->nama->IsDetailKey && EmptyValue($this->nama->FormValue)) {
                $this->nama->addErrorMessage(str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
            }
        }
        if ($this->alamat->Required) {
            if (!$this->alamat->IsDetailKey && EmptyValue($this->alamat->FormValue)) {
                $this->alamat->addErrorMessage(str_replace("%s", $this->alamat->caption(), $this->alamat->RequiredErrorMessage));
            }
        }
        if ($this->_email->Required) {
            if (!$this->_email->IsDetailKey && EmptyValue($this->_email->FormValue)) {
                $this->_email->addErrorMessage(str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
            }
        }
        if ($this->wa->Required) {
            if (!$this->wa->IsDetailKey && EmptyValue($this->wa->FormValue)) {
                $this->wa->addErrorMessage(str_replace("%s", $this->wa->caption(), $this->wa->RequiredErrorMessage));
            }
        }
        if ($this->hp->Required) {
            if (!$this->hp->IsDetailKey && EmptyValue($this->hp->FormValue)) {
                $this->hp->addErrorMessage(str_replace("%s", $this->hp->caption(), $this->hp->RequiredErrorMessage));
            }
        }
        if ($this->tgllahir->Required) {
            if (!$this->tgllahir->IsDetailKey && EmptyValue($this->tgllahir->FormValue)) {
                $this->tgllahir->addErrorMessage(str_replace("%s", $this->tgllahir->caption(), $this->tgllahir->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tgllahir->FormValue, $this->tgllahir->formatPattern())) {
            $this->tgllahir->addErrorMessage($this->tgllahir->getErrorMessage(false));
        }
        if ($this->rekbank->Required) {
            if (!$this->rekbank->IsDetailKey && EmptyValue($this->rekbank->FormValue)) {
                $this->rekbank->addErrorMessage(str_replace("%s", $this->rekbank->caption(), $this->rekbank->RequiredErrorMessage));
            }
        }
        if ($this->jenjang_id->Required) {
            if (!$this->jenjang_id->IsDetailKey && EmptyValue($this->jenjang_id->FormValue)) {
                $this->jenjang_id->addErrorMessage(str_replace("%s", $this->jenjang_id->caption(), $this->jenjang_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jenjang_id->FormValue)) {
            $this->jenjang_id->addErrorMessage($this->jenjang_id->getErrorMessage(false));
        }
        if ($this->pendidikan->Required) {
            if (!$this->pendidikan->IsDetailKey && EmptyValue($this->pendidikan->FormValue)) {
                $this->pendidikan->addErrorMessage(str_replace("%s", $this->pendidikan->caption(), $this->pendidikan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pendidikan->FormValue)) {
            $this->pendidikan->addErrorMessage($this->pendidikan->getErrorMessage(false));
        }
        if ($this->jurusan->Required) {
            if (!$this->jurusan->IsDetailKey && EmptyValue($this->jurusan->FormValue)) {
                $this->jurusan->addErrorMessage(str_replace("%s", $this->jurusan->caption(), $this->jurusan->RequiredErrorMessage));
            }
        }
        if ($this->agama->Required) {
            if (!$this->agama->IsDetailKey && EmptyValue($this->agama->FormValue)) {
                $this->agama->addErrorMessage(str_replace("%s", $this->agama->caption(), $this->agama->RequiredErrorMessage));
            }
        }
        if ($this->jabatan->Required) {
            if (!$this->jabatan->IsDetailKey && EmptyValue($this->jabatan->FormValue)) {
                $this->jabatan->addErrorMessage(str_replace("%s", $this->jabatan->caption(), $this->jabatan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jabatan->FormValue)) {
            $this->jabatan->addErrorMessage($this->jabatan->getErrorMessage(false));
        }
        if ($this->jenkel->Required) {
            if ($this->jenkel->FormValue == "") {
                $this->jenkel->addErrorMessage(str_replace("%s", $this->jenkel->caption(), $this->jenkel->RequiredErrorMessage));
            }
        }
        if ($this->mulai_bekerja->Required) {
            if (!$this->mulai_bekerja->IsDetailKey && EmptyValue($this->mulai_bekerja->FormValue)) {
                $this->mulai_bekerja->addErrorMessage(str_replace("%s", $this->mulai_bekerja->caption(), $this->mulai_bekerja->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->mulai_bekerja->FormValue, $this->mulai_bekerja->formatPattern())) {
            $this->mulai_bekerja->addErrorMessage($this->mulai_bekerja->getErrorMessage(false));
        }
        if ($this->status->Required) {
            if (!$this->status->IsDetailKey && EmptyValue($this->status->FormValue)) {
                $this->status->addErrorMessage(str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
            }
        }
        if ($this->keterangan->Required) {
            if (!$this->keterangan->IsDetailKey && EmptyValue($this->keterangan->FormValue)) {
                $this->keterangan->addErrorMessage(str_replace("%s", $this->keterangan->caption(), $this->keterangan->RequiredErrorMessage));
            }
        }
        if ($this->level->Required) {
            if (!$this->level->IsDetailKey && EmptyValue($this->level->FormValue)) {
                $this->level->addErrorMessage(str_replace("%s", $this->level->caption(), $this->level->RequiredErrorMessage));
            }
        }
        if ($this->aktif->Required) {
            if (!$this->aktif->IsDetailKey && EmptyValue($this->aktif->FormValue)) {
                $this->aktif->addErrorMessage(str_replace("%s", $this->aktif->caption(), $this->aktif->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->aktif->FormValue)) {
            $this->aktif->addErrorMessage($this->aktif->getErrorMessage(false));
        }
        if ($this->foto->Required) {
            if ($this->foto->Upload->FileName == "" && !$this->foto->Upload->KeepFile) {
                $this->foto->addErrorMessage(str_replace("%s", $this->foto->caption(), $this->foto->RequiredErrorMessage));
            }
        }
        if ($this->file_cv->Required) {
            if ($this->file_cv->Upload->FileName == "" && !$this->file_cv->Upload->KeepFile) {
                $this->file_cv->addErrorMessage(str_replace("%s", $this->file_cv->caption(), $this->file_cv->RequiredErrorMessage));
            }
        }

        // Validate detail grid
        $detailTblVar = explode(",", $this->getCurrentDetailTable());
        $detailPage = Container("PegDokumenGrid");
        if (in_array("peg_dokumen", $detailTblVar) && $detailPage->DetailEdit) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("PegKeluargaGrid");
        if (in_array("peg_keluarga", $detailTblVar) && $detailPage->DetailEdit) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }
        $detailPage = Container("PegSkillGrid");
        if (in_array("peg_skill", $detailTblVar) && $detailPage->DetailEdit) {
            $validateForm = $validateForm && $detailPage->validateGridForm();
        }

        // Return validate result
        $validateForm = $validateForm && !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
            $this->foto->OldUploadPath = "file_foto";
            $this->foto->UploadPath = $this->foto->OldUploadPath;
            $this->file_cv->OldUploadPath = "file_cv";
            $this->file_cv->UploadPath = $this->file_cv->OldUploadPath;
        }

        // Set new row
        $rsnew = [];

        // username
        $this->_username->setDbValueDef($rsnew, $this->_username->CurrentValue, null, $this->_username->ReadOnly);

        // password
        $this->_password->setDbValueDef($rsnew, $this->_password->CurrentValue, null, $this->_password->ReadOnly || Config("ENCRYPTED_PASSWORD") && $rsold['password'] == $this->_password->CurrentValue);

        // nip
        $this->nip->setDbValueDef($rsnew, $this->nip->CurrentValue, null, $this->nip->ReadOnly);

        // nama
        $this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, null, $this->nama->ReadOnly);

        // alamat
        $this->alamat->setDbValueDef($rsnew, $this->alamat->CurrentValue, null, $this->alamat->ReadOnly);

        // email
        $this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, null, $this->_email->ReadOnly);

        // wa
        $this->wa->setDbValueDef($rsnew, $this->wa->CurrentValue, null, $this->wa->ReadOnly);

        // hp
        $this->hp->setDbValueDef($rsnew, $this->hp->CurrentValue, null, $this->hp->ReadOnly);

        // tgllahir
        $this->tgllahir->setDbValueDef($rsnew, UnFormatDateTime($this->tgllahir->CurrentValue, $this->tgllahir->formatPattern()), null, $this->tgllahir->ReadOnly);

        // rekbank
        $this->rekbank->setDbValueDef($rsnew, $this->rekbank->CurrentValue, null, $this->rekbank->ReadOnly);

        // jenjang_id
        $this->jenjang_id->setDbValueDef($rsnew, $this->jenjang_id->CurrentValue, null, $this->jenjang_id->ReadOnly);

        // pendidikan
        $this->pendidikan->setDbValueDef($rsnew, $this->pendidikan->CurrentValue, null, $this->pendidikan->ReadOnly);

        // jurusan
        $this->jurusan->setDbValueDef($rsnew, $this->jurusan->CurrentValue, null, $this->jurusan->ReadOnly);

        // agama
        $this->agama->setDbValueDef($rsnew, $this->agama->CurrentValue, null, $this->agama->ReadOnly);

        // jabatan
        $this->jabatan->setDbValueDef($rsnew, $this->jabatan->CurrentValue, null, $this->jabatan->ReadOnly);

        // jenkel
        $this->jenkel->setDbValueDef($rsnew, $this->jenkel->CurrentValue, null, $this->jenkel->ReadOnly);

        // mulai_bekerja
        $this->mulai_bekerja->setDbValueDef($rsnew, UnFormatDateTime($this->mulai_bekerja->CurrentValue, $this->mulai_bekerja->formatPattern()), null, $this->mulai_bekerja->ReadOnly);

        // status
        $this->status->setDbValueDef($rsnew, $this->status->CurrentValue, null, $this->status->ReadOnly);

        // keterangan
        $this->keterangan->setDbValueDef($rsnew, $this->keterangan->CurrentValue, null, $this->keterangan->ReadOnly);

        // level
        if ($Security->canAdmin()) { // System admin
            $this->level->setDbValueDef($rsnew, $this->level->CurrentValue, null, $this->level->ReadOnly);
        }

        // aktif
        $this->aktif->setDbValueDef($rsnew, $this->aktif->CurrentValue, null, $this->aktif->ReadOnly);

        // foto
        if ($this->foto->Visible && !$this->foto->ReadOnly && !$this->foto->Upload->KeepFile) {
            $this->foto->Upload->DbValue = $rsold['foto']; // Get original value
            if ($this->foto->Upload->FileName == "") {
                $rsnew['foto'] = null;
            } else {
                $rsnew['foto'] = $this->foto->Upload->FileName;
            }
        }

        // file_cv
        if ($this->file_cv->Visible && !$this->file_cv->ReadOnly && !$this->file_cv->Upload->KeepFile) {
            $this->file_cv->Upload->DbValue = $rsold['file_cv']; // Get original value
            if ($this->file_cv->Upload->FileName == "") {
                $rsnew['file_cv'] = null;
            } else {
                $rsnew['file_cv'] = $this->file_cv->Upload->FileName;
            }
        }

        // Update current values
        $this->setCurrentValues($rsnew);

        // Begin transaction
        if ($this->getCurrentDetailTable() != "" && $this->UseTransaction) {
            $conn->beginTransaction();
        }
        if ($this->foto->Visible && !$this->foto->Upload->KeepFile) {
            $this->foto->UploadPath = "file_foto";
            $oldFiles = EmptyValue($this->foto->Upload->DbValue) ? [] : [$this->foto->htmlDecode($this->foto->Upload->DbValue)];
            if (!EmptyValue($this->foto->Upload->FileName)) {
                $newFiles = [$this->foto->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->foto, $this->foto->Upload->Index);
                        if (file_exists($tempPath . $file)) {
                            if (Config("DELETE_UPLOADED_FILES")) {
                                $oldFileFound = false;
                                $oldFileCount = count($oldFiles);
                                for ($j = 0; $j < $oldFileCount; $j++) {
                                    $oldFile = $oldFiles[$j];
                                    if ($oldFile == $file) { // Old file found, no need to delete anymore
                                        array_splice($oldFiles, $j, 1);
                                        $oldFileFound = true;
                                        break;
                                    }
                                }
                                if ($oldFileFound) { // No need to check if file exists further
                                    continue;
                                }
                            }
                            $file1 = UniqueFilename($this->foto->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->foto->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->foto->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->foto->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->foto->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->foto->setDbValueDef($rsnew, $this->foto->Upload->FileName, null, $this->foto->ReadOnly);
            }
        }
        if ($this->file_cv->Visible && !$this->file_cv->Upload->KeepFile) {
            $this->file_cv->UploadPath = "file_cv";
            $oldFiles = EmptyValue($this->file_cv->Upload->DbValue) ? [] : [$this->file_cv->htmlDecode($this->file_cv->Upload->DbValue)];
            if (!EmptyValue($this->file_cv->Upload->FileName)) {
                $newFiles = [$this->file_cv->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->file_cv, $this->file_cv->Upload->Index);
                        if (file_exists($tempPath . $file)) {
                            if (Config("DELETE_UPLOADED_FILES")) {
                                $oldFileFound = false;
                                $oldFileCount = count($oldFiles);
                                for ($j = 0; $j < $oldFileCount; $j++) {
                                    $oldFile = $oldFiles[$j];
                                    if ($oldFile == $file) { // Old file found, no need to delete anymore
                                        array_splice($oldFiles, $j, 1);
                                        $oldFileFound = true;
                                        break;
                                    }
                                }
                                if ($oldFileFound) { // No need to check if file exists further
                                    continue;
                                }
                            }
                            $file1 = UniqueFilename($this->file_cv->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->file_cv->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->file_cv->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->file_cv->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->file_cv->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->file_cv->setDbValueDef($rsnew, $this->file_cv->Upload->FileName, null, $this->file_cv->ReadOnly);
            }
        }

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);
        if ($updateRow) {
            if (count($rsnew) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($rsnew, "", $rsold);
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
                if ($this->foto->Visible && !$this->foto->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->foto->Upload->DbValue) ? [] : [$this->foto->htmlDecode($this->foto->Upload->DbValue)];
                    if (!EmptyValue($this->foto->Upload->FileName)) {
                        $newFiles = [$this->foto->Upload->FileName];
                        $newFiles2 = [$this->foto->htmlDecode($rsnew['foto'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->foto, $this->foto->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->foto->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
                                        $this->setFailureMessage($Language->phrase("UploadErrMsg7"));
                                        return false;
                                    }
                                }
                            }
                        }
                    } else {
                        $newFiles = [];
                    }
                    if (Config("DELETE_UPLOADED_FILES")) {
                        foreach ($oldFiles as $oldFile) {
                            if ($oldFile != "" && !in_array($oldFile, $newFiles)) {
                                @unlink($this->foto->oldPhysicalUploadPath() . $oldFile);
                            }
                        }
                    }
                }
                if ($this->file_cv->Visible && !$this->file_cv->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->file_cv->Upload->DbValue) ? [] : [$this->file_cv->htmlDecode($this->file_cv->Upload->DbValue)];
                    if (!EmptyValue($this->file_cv->Upload->FileName)) {
                        $newFiles = [$this->file_cv->Upload->FileName];
                        $newFiles2 = [$this->file_cv->htmlDecode($rsnew['file_cv'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->file_cv, $this->file_cv->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->file_cv->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
                                        $this->setFailureMessage($Language->phrase("UploadErrMsg7"));
                                        return false;
                                    }
                                }
                            }
                        }
                    } else {
                        $newFiles = [];
                    }
                    if (Config("DELETE_UPLOADED_FILES")) {
                        foreach ($oldFiles as $oldFile) {
                            if ($oldFile != "" && !in_array($oldFile, $newFiles)) {
                                @unlink($this->file_cv->oldPhysicalUploadPath() . $oldFile);
                            }
                        }
                    }
                }
            }

            // Update detail records
            $detailTblVar = explode(",", $this->getCurrentDetailTable());
            if ($editRow) {
                $detailPage = Container("PegDokumenGrid");
                if (in_array("peg_dokumen", $detailTblVar) && $detailPage->DetailEdit) {
                    $Security->loadCurrentUserLevel($this->ProjectID . "peg_dokumen"); // Load user level of detail table
                    $editRow = $detailPage->gridUpdate();
                    $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                }
            }
            if ($editRow) {
                $detailPage = Container("PegKeluargaGrid");
                if (in_array("peg_keluarga", $detailTblVar) && $detailPage->DetailEdit) {
                    $Security->loadCurrentUserLevel($this->ProjectID . "peg_keluarga"); // Load user level of detail table
                    $editRow = $detailPage->gridUpdate();
                    $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                }
            }
            if ($editRow) {
                $detailPage = Container("PegSkillGrid");
                if (in_array("peg_skill", $detailTblVar) && $detailPage->DetailEdit) {
                    $Security->loadCurrentUserLevel($this->ProjectID . "peg_skill"); // Load user level of detail table
                    $editRow = $detailPage->gridUpdate();
                    $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                }
            }

            // Commit/Rollback transaction
            if ($this->getCurrentDetailTable() != "") {
                if ($editRow) {
                    if ($this->UseTransaction) { // Commit transaction
                        $conn->commit();
                    }
                } else {
                    if ($this->UseTransaction) { // Rollback transaction
                        $conn->rollback();
                    }
                }
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("UpdateCancelled"));
            }
            $editRow = false;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($editRow) {
            // foto
            CleanUploadTempPath($this->foto, $this->foto->Upload->Index);

            // file_cv
            CleanUploadTempPath($this->file_cv, $this->file_cv->Upload->Index);
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
    }

    // Set up detail parms based on QueryString
    protected function setupDetailParms()
    {
        // Get the keys for master table
        $detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
        if ($detailTblVar !== null) {
            $this->setCurrentDetailTable($detailTblVar);
        } else {
            $detailTblVar = $this->getCurrentDetailTable();
        }
        if ($detailTblVar != "") {
            $detailTblVar = explode(",", $detailTblVar);
            if (in_array("peg_dokumen", $detailTblVar)) {
                $detailPageObj = Container("PegDokumenGrid");
                if ($detailPageObj->DetailEdit) {
                    $detailPageObj->CurrentMode = "edit";
                    $detailPageObj->CurrentAction = "gridedit";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->pid->IsDetailKey = true;
                    $detailPageObj->pid->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->pid->setSessionValue($detailPageObj->pid->CurrentValue);
                }
            }
            if (in_array("peg_keluarga", $detailTblVar)) {
                $detailPageObj = Container("PegKeluargaGrid");
                if ($detailPageObj->DetailEdit) {
                    $detailPageObj->CurrentMode = "edit";
                    $detailPageObj->CurrentAction = "gridedit";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->pid->IsDetailKey = true;
                    $detailPageObj->pid->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->pid->setSessionValue($detailPageObj->pid->CurrentValue);
                }
            }
            if (in_array("peg_skill", $detailTblVar)) {
                $detailPageObj = Container("PegSkillGrid");
                if ($detailPageObj->DetailEdit) {
                    $detailPageObj->CurrentMode = "edit";
                    $detailPageObj->CurrentAction = "gridedit";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->pid->IsDetailKey = true;
                    $detailPageObj->pid->CurrentValue = $this->id->CurrentValue;
                    $detailPageObj->pid->setSessionValue($detailPageObj->pid->CurrentValue);
                }
            }
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PegawaiList"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                case "x_jenjang_id":
                    break;
                case "x_pendidikan":
                    break;
                case "x_agama":
                    break;
                case "x_jabatan":
                    break;
                case "x_jenkel":
                    break;
                case "x_level":
                    break;
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if (!$fld->hasLookupOptions() && $fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll();
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row, Container($fld->Lookup->LinkTable));
                    $ar[strval($row["lf"])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            if ($startRec !== null && is_numeric($startRec)) { // Check for "start" parameter
                $this->StartRecord = $startRec;
                $this->setStartRecordNumber($this->StartRecord);
            }
        }
        $this->StartRecord = $this->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in $customError
        return true;
    }
}
