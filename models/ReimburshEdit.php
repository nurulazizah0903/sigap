<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class ReimburshEdit extends Reimbursh
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'reimbursh';

    // Page object name
    public $PageObjName = "ReimburshEdit";

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

        // Table object (reimbursh)
        if (!isset($GLOBALS["reimbursh"]) || get_class($GLOBALS["reimbursh"]) == PROJECT_NAMESPACE . "reimbursh") {
            $GLOBALS["reimbursh"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'reimbursh');
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
                $tbl = Container("reimbursh");
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
                    if ($pageName == "ReimburshView") {
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
		        $this->bukti1->OldUploadPath = "file_reimburshbukti1";
		        $this->bukti1->UploadPath = $this->bukti1->OldUploadPath;
		        $this->bukti2->OldUploadPath = "file_reimburshbukti2";
		        $this->bukti2->UploadPath = $this->bukti2->OldUploadPath;
		        $this->bukti3->OldUploadPath = "file_reimburshbukti3";
		        $this->bukti3->UploadPath = $this->bukti3->OldUploadPath;
		        $this->bukti4->OldUploadPath = "file_reimburshbukti4";
		        $this->bukti4->UploadPath = $this->bukti4->OldUploadPath;
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
        $this->pegawai->setVisibility();
        $this->nama->setVisibility();
        $this->tgl->setVisibility();
        $this->total_pengajuan->setVisibility();
        $this->tgl_pengajuan->setVisibility();
        $this->jenis->setVisibility();
        $this->keterangan->setVisibility();
        $this->rek_tujuan->setVisibility();
        $this->disetujui->setVisibility();
        $this->pembayar->setVisibility();
        $this->terbayar->setVisibility();
        $this->tgl_pembayaran->setVisibility();
        $this->jumlah_dibayar->setVisibility();
        $this->bukti1->setVisibility();
        $this->bukti2->setVisibility();
        $this->bukti3->setVisibility();
        $this->bukti4->setVisibility();
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
        $this->setupLookupOptions($this->pegawai);
        $this->setupLookupOptions($this->disetujui);

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
                        $this->terminate("ReimburshList"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "ReimburshList") {
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
        $this->bukti1->Upload->Index = $CurrentForm->Index;
        $this->bukti1->Upload->uploadFile();
        $this->bukti1->CurrentValue = $this->bukti1->Upload->FileName;
        $this->bukti2->Upload->Index = $CurrentForm->Index;
        $this->bukti2->Upload->uploadFile();
        $this->bukti2->CurrentValue = $this->bukti2->Upload->FileName;
        $this->bukti3->Upload->Index = $CurrentForm->Index;
        $this->bukti3->Upload->uploadFile();
        $this->bukti3->CurrentValue = $this->bukti3->Upload->FileName;
        $this->bukti4->Upload->Index = $CurrentForm->Index;
        $this->bukti4->Upload->uploadFile();
        $this->bukti4->CurrentValue = $this->bukti4->Upload->FileName;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'pegawai' first before field var 'x_pegawai'
        $val = $CurrentForm->hasValue("pegawai") ? $CurrentForm->getValue("pegawai") : $CurrentForm->getValue("x_pegawai");
        if (!$this->pegawai->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pegawai->Visible = false; // Disable update for API request
            } else {
                $this->pegawai->setFormValue($val, true, $validate);
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

        // Check field name 'tgl' first before field var 'x_tgl'
        $val = $CurrentForm->hasValue("tgl") ? $CurrentForm->getValue("tgl") : $CurrentForm->getValue("x_tgl");
        if (!$this->tgl->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tgl->Visible = false; // Disable update for API request
            } else {
                $this->tgl->setFormValue($val);
            }
            $this->tgl->CurrentValue = UnFormatDateTime($this->tgl->CurrentValue, $this->tgl->formatPattern());
        }

        // Check field name 'total_pengajuan' first before field var 'x_total_pengajuan'
        $val = $CurrentForm->hasValue("total_pengajuan") ? $CurrentForm->getValue("total_pengajuan") : $CurrentForm->getValue("x_total_pengajuan");
        if (!$this->total_pengajuan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->total_pengajuan->Visible = false; // Disable update for API request
            } else {
                $this->total_pengajuan->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'tgl_pengajuan' first before field var 'x_tgl_pengajuan'
        $val = $CurrentForm->hasValue("tgl_pengajuan") ? $CurrentForm->getValue("tgl_pengajuan") : $CurrentForm->getValue("x_tgl_pengajuan");
        if (!$this->tgl_pengajuan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tgl_pengajuan->Visible = false; // Disable update for API request
            } else {
                $this->tgl_pengajuan->setFormValue($val, true, $validate);
            }
            $this->tgl_pengajuan->CurrentValue = UnFormatDateTime($this->tgl_pengajuan->CurrentValue, $this->tgl_pengajuan->formatPattern());
        }

        // Check field name 'jenis' first before field var 'x_jenis'
        $val = $CurrentForm->hasValue("jenis") ? $CurrentForm->getValue("jenis") : $CurrentForm->getValue("x_jenis");
        if (!$this->jenis->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jenis->Visible = false; // Disable update for API request
            } else {
                $this->jenis->setFormValue($val);
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

        // Check field name 'rek_tujuan' first before field var 'x_rek_tujuan'
        $val = $CurrentForm->hasValue("rek_tujuan") ? $CurrentForm->getValue("rek_tujuan") : $CurrentForm->getValue("x_rek_tujuan");
        if (!$this->rek_tujuan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->rek_tujuan->Visible = false; // Disable update for API request
            } else {
                $this->rek_tujuan->setFormValue($val);
            }
        }

        // Check field name 'disetujui' first before field var 'x_disetujui'
        $val = $CurrentForm->hasValue("disetujui") ? $CurrentForm->getValue("disetujui") : $CurrentForm->getValue("x_disetujui");
        if (!$this->disetujui->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->disetujui->Visible = false; // Disable update for API request
            } else {
                $this->disetujui->setFormValue($val);
            }
        }

        // Check field name 'pembayar' first before field var 'x_pembayar'
        $val = $CurrentForm->hasValue("pembayar") ? $CurrentForm->getValue("pembayar") : $CurrentForm->getValue("x_pembayar");
        if (!$this->pembayar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pembayar->Visible = false; // Disable update for API request
            } else {
                $this->pembayar->setFormValue($val);
            }
        }

        // Check field name 'terbayar' first before field var 'x_terbayar'
        $val = $CurrentForm->hasValue("terbayar") ? $CurrentForm->getValue("terbayar") : $CurrentForm->getValue("x_terbayar");
        if (!$this->terbayar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->terbayar->Visible = false; // Disable update for API request
            } else {
                $this->terbayar->setFormValue($val);
            }
        }

        // Check field name 'tgl_pembayaran' first before field var 'x_tgl_pembayaran'
        $val = $CurrentForm->hasValue("tgl_pembayaran") ? $CurrentForm->getValue("tgl_pembayaran") : $CurrentForm->getValue("x_tgl_pembayaran");
        if (!$this->tgl_pembayaran->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tgl_pembayaran->Visible = false; // Disable update for API request
            } else {
                $this->tgl_pembayaran->setFormValue($val, true, $validate);
            }
            $this->tgl_pembayaran->CurrentValue = UnFormatDateTime($this->tgl_pembayaran->CurrentValue, $this->tgl_pembayaran->formatPattern());
        }

        // Check field name 'jumlah_dibayar' first before field var 'x_jumlah_dibayar'
        $val = $CurrentForm->hasValue("jumlah_dibayar") ? $CurrentForm->getValue("jumlah_dibayar") : $CurrentForm->getValue("x_jumlah_dibayar");
        if (!$this->jumlah_dibayar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jumlah_dibayar->Visible = false; // Disable update for API request
            } else {
                $this->jumlah_dibayar->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey) {
            $this->id->setFormValue($val);
        }
		$this->bukti1->OldUploadPath = "file_reimburshbukti1";
		$this->bukti1->UploadPath = $this->bukti1->OldUploadPath;
		$this->bukti2->OldUploadPath = "file_reimburshbukti2";
		$this->bukti2->UploadPath = $this->bukti2->OldUploadPath;
		$this->bukti3->OldUploadPath = "file_reimburshbukti3";
		$this->bukti3->UploadPath = $this->bukti3->OldUploadPath;
		$this->bukti4->OldUploadPath = "file_reimburshbukti4";
		$this->bukti4->UploadPath = $this->bukti4->OldUploadPath;
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->pegawai->CurrentValue = $this->pegawai->FormValue;
        $this->nama->CurrentValue = $this->nama->FormValue;
        $this->tgl->CurrentValue = $this->tgl->FormValue;
        $this->tgl->CurrentValue = UnFormatDateTime($this->tgl->CurrentValue, $this->tgl->formatPattern());
        $this->total_pengajuan->CurrentValue = $this->total_pengajuan->FormValue;
        $this->tgl_pengajuan->CurrentValue = $this->tgl_pengajuan->FormValue;
        $this->tgl_pengajuan->CurrentValue = UnFormatDateTime($this->tgl_pengajuan->CurrentValue, $this->tgl_pengajuan->formatPattern());
        $this->jenis->CurrentValue = $this->jenis->FormValue;
        $this->keterangan->CurrentValue = $this->keterangan->FormValue;
        $this->rek_tujuan->CurrentValue = $this->rek_tujuan->FormValue;
        $this->disetujui->CurrentValue = $this->disetujui->FormValue;
        $this->pembayar->CurrentValue = $this->pembayar->FormValue;
        $this->terbayar->CurrentValue = $this->terbayar->FormValue;
        $this->tgl_pembayaran->CurrentValue = $this->tgl_pembayaran->FormValue;
        $this->tgl_pembayaran->CurrentValue = UnFormatDateTime($this->tgl_pembayaran->CurrentValue, $this->tgl_pembayaran->formatPattern());
        $this->jumlah_dibayar->CurrentValue = $this->jumlah_dibayar->FormValue;
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
        $this->pegawai->setDbValue($row['pegawai']);
        $this->nama->setDbValue($row['nama']);
        $this->tgl->setDbValue($row['tgl']);
        $this->total_pengajuan->setDbValue($row['total_pengajuan']);
        $this->tgl_pengajuan->setDbValue($row['tgl_pengajuan']);
        $this->jenis->setDbValue($row['jenis']);
        $this->keterangan->setDbValue($row['keterangan']);
        $this->rek_tujuan->setDbValue($row['rek_tujuan']);
        $this->disetujui->setDbValue($row['disetujui']);
        $this->pembayar->setDbValue($row['pembayar']);
        $this->terbayar->setDbValue($row['terbayar']);
        $this->tgl_pembayaran->setDbValue($row['tgl_pembayaran']);
        $this->jumlah_dibayar->setDbValue($row['jumlah_dibayar']);
        $this->bukti1->Upload->DbValue = $row['bukti1'];
        $this->bukti1->setDbValue($this->bukti1->Upload->DbValue);
        $this->bukti2->Upload->DbValue = $row['bukti2'];
        $this->bukti2->setDbValue($this->bukti2->Upload->DbValue);
        $this->bukti3->Upload->DbValue = $row['bukti3'];
        $this->bukti3->setDbValue($this->bukti3->Upload->DbValue);
        $this->bukti4->Upload->DbValue = $row['bukti4'];
        $this->bukti4->setDbValue($this->bukti4->Upload->DbValue);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['pegawai'] = $this->pegawai->DefaultValue;
        $row['nama'] = $this->nama->DefaultValue;
        $row['tgl'] = $this->tgl->DefaultValue;
        $row['total_pengajuan'] = $this->total_pengajuan->DefaultValue;
        $row['tgl_pengajuan'] = $this->tgl_pengajuan->DefaultValue;
        $row['jenis'] = $this->jenis->DefaultValue;
        $row['keterangan'] = $this->keterangan->DefaultValue;
        $row['rek_tujuan'] = $this->rek_tujuan->DefaultValue;
        $row['disetujui'] = $this->disetujui->DefaultValue;
        $row['pembayar'] = $this->pembayar->DefaultValue;
        $row['terbayar'] = $this->terbayar->DefaultValue;
        $row['tgl_pembayaran'] = $this->tgl_pembayaran->DefaultValue;
        $row['jumlah_dibayar'] = $this->jumlah_dibayar->DefaultValue;
        $row['bukti1'] = $this->bukti1->DefaultValue;
        $row['bukti2'] = $this->bukti2->DefaultValue;
        $row['bukti3'] = $this->bukti3->DefaultValue;
        $row['bukti4'] = $this->bukti4->DefaultValue;
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

        // pegawai
        $this->pegawai->RowCssClass = "row";

        // nama
        $this->nama->RowCssClass = "row";

        // tgl
        $this->tgl->RowCssClass = "row";

        // total_pengajuan
        $this->total_pengajuan->RowCssClass = "row";

        // tgl_pengajuan
        $this->tgl_pengajuan->RowCssClass = "row";

        // jenis
        $this->jenis->RowCssClass = "row";

        // keterangan
        $this->keterangan->RowCssClass = "row";

        // rek_tujuan
        $this->rek_tujuan->RowCssClass = "row";

        // disetujui
        $this->disetujui->RowCssClass = "row";

        // pembayar
        $this->pembayar->RowCssClass = "row";

        // terbayar
        $this->terbayar->RowCssClass = "row";

        // tgl_pembayaran
        $this->tgl_pembayaran->RowCssClass = "row";

        // jumlah_dibayar
        $this->jumlah_dibayar->RowCssClass = "row";

        // bukti1
        $this->bukti1->RowCssClass = "row";

        // bukti2
        $this->bukti2->RowCssClass = "row";

        // bukti3
        $this->bukti3->RowCssClass = "row";

        // bukti4
        $this->bukti4->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // pegawai
            $this->pegawai->ViewValue = $this->pegawai->CurrentValue;
            $curVal = strval($this->pegawai->CurrentValue);
            if ($curVal != "") {
                $this->pegawai->ViewValue = $this->pegawai->lookupCacheOption($curVal);
                if ($this->pegawai->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->pegawai->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->pegawai->Lookup->renderViewRow($rswrk[0]);
                        $this->pegawai->ViewValue = $this->pegawai->displayValue($arwrk);
                    } else {
                        $this->pegawai->ViewValue = FormatNumber($this->pegawai->CurrentValue, $this->pegawai->formatPattern());
                    }
                }
            } else {
                $this->pegawai->ViewValue = null;
            }
            $this->pegawai->ViewCustomAttributes = "";

            // nama
            $this->nama->ViewValue = $this->nama->CurrentValue;
            $this->nama->ViewCustomAttributes = "";

            // tgl
            $this->tgl->ViewValue = $this->tgl->CurrentValue;
            $this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, $this->tgl->formatPattern());
            $this->tgl->ViewCustomAttributes = "";

            // total_pengajuan
            $this->total_pengajuan->ViewValue = $this->total_pengajuan->CurrentValue;
            $this->total_pengajuan->ViewValue = FormatNumber($this->total_pengajuan->ViewValue, $this->total_pengajuan->formatPattern());
            $this->total_pengajuan->ViewCustomAttributes = "";

            // tgl_pengajuan
            $this->tgl_pengajuan->ViewValue = $this->tgl_pengajuan->CurrentValue;
            $this->tgl_pengajuan->ViewValue = FormatDateTime($this->tgl_pengajuan->ViewValue, $this->tgl_pengajuan->formatPattern());
            $this->tgl_pengajuan->ViewCustomAttributes = "";

            // jenis
            $this->jenis->ViewValue = $this->jenis->CurrentValue;
            $this->jenis->ViewCustomAttributes = "";

            // keterangan
            $this->keterangan->ViewValue = $this->keterangan->CurrentValue;
            $this->keterangan->ViewCustomAttributes = "";

            // rek_tujuan
            $this->rek_tujuan->ViewValue = $this->rek_tujuan->CurrentValue;
            $this->rek_tujuan->ViewCustomAttributes = "";

            // disetujui
            if (strval($this->disetujui->CurrentValue) != "") {
                $this->disetujui->ViewValue = $this->disetujui->optionCaption($this->disetujui->CurrentValue);
            } else {
                $this->disetujui->ViewValue = null;
            }
            $this->disetujui->ViewCustomAttributes = "";

            // pembayar
            $this->pembayar->ViewValue = $this->pembayar->CurrentValue;
            $this->pembayar->ViewCustomAttributes = "";

            // terbayar
            $this->terbayar->ViewValue = $this->terbayar->CurrentValue;
            $this->terbayar->ViewCustomAttributes = "";

            // tgl_pembayaran
            $this->tgl_pembayaran->ViewValue = $this->tgl_pembayaran->CurrentValue;
            $this->tgl_pembayaran->ViewValue = FormatDateTime($this->tgl_pembayaran->ViewValue, $this->tgl_pembayaran->formatPattern());
            $this->tgl_pembayaran->ViewCustomAttributes = "";

            // jumlah_dibayar
            $this->jumlah_dibayar->ViewValue = $this->jumlah_dibayar->CurrentValue;
            $this->jumlah_dibayar->ViewValue = FormatNumber($this->jumlah_dibayar->ViewValue, $this->jumlah_dibayar->formatPattern());
            $this->jumlah_dibayar->ViewCustomAttributes = "";

            // bukti1
            $this->bukti1->UploadPath = "file_reimburshbukti1";
            if (!EmptyValue($this->bukti1->Upload->DbValue)) {
                $this->bukti1->ViewValue = $this->bukti1->Upload->DbValue;
            } else {
                $this->bukti1->ViewValue = "";
            }
            $this->bukti1->ViewCustomAttributes = "";

            // bukti2
            $this->bukti2->UploadPath = "file_reimburshbukti2";
            if (!EmptyValue($this->bukti2->Upload->DbValue)) {
                $this->bukti2->ViewValue = $this->bukti2->Upload->DbValue;
            } else {
                $this->bukti2->ViewValue = "";
            }
            $this->bukti2->ViewCustomAttributes = "";

            // bukti3
            $this->bukti3->UploadPath = "file_reimburshbukti3";
            if (!EmptyValue($this->bukti3->Upload->DbValue)) {
                $this->bukti3->ViewValue = $this->bukti3->Upload->DbValue;
            } else {
                $this->bukti3->ViewValue = "";
            }
            $this->bukti3->ViewCustomAttributes = "";

            // bukti4
            $this->bukti4->UploadPath = "file_reimburshbukti4";
            if (!EmptyValue($this->bukti4->Upload->DbValue)) {
                $this->bukti4->ViewValue = $this->bukti4->Upload->DbValue;
            } else {
                $this->bukti4->ViewValue = "";
            }
            $this->bukti4->ViewCustomAttributes = "";

            // pegawai
            $this->pegawai->LinkCustomAttributes = "";
            $this->pegawai->HrefValue = "";

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";

            // tgl
            $this->tgl->LinkCustomAttributes = "";
            $this->tgl->HrefValue = "";

            // total_pengajuan
            $this->total_pengajuan->LinkCustomAttributes = "";
            $this->total_pengajuan->HrefValue = "";

            // tgl_pengajuan
            $this->tgl_pengajuan->LinkCustomAttributes = "";
            $this->tgl_pengajuan->HrefValue = "";

            // jenis
            $this->jenis->LinkCustomAttributes = "";
            $this->jenis->HrefValue = "";

            // keterangan
            $this->keterangan->LinkCustomAttributes = "";
            $this->keterangan->HrefValue = "";

            // rek_tujuan
            $this->rek_tujuan->LinkCustomAttributes = "";
            $this->rek_tujuan->HrefValue = "";

            // disetujui
            $this->disetujui->LinkCustomAttributes = "";
            $this->disetujui->HrefValue = "";

            // pembayar
            $this->pembayar->LinkCustomAttributes = "";
            $this->pembayar->HrefValue = "";

            // terbayar
            $this->terbayar->LinkCustomAttributes = "";
            $this->terbayar->HrefValue = "";

            // tgl_pembayaran
            $this->tgl_pembayaran->LinkCustomAttributes = "";
            $this->tgl_pembayaran->HrefValue = "";

            // jumlah_dibayar
            $this->jumlah_dibayar->LinkCustomAttributes = "";
            $this->jumlah_dibayar->HrefValue = "";

            // bukti1
            $this->bukti1->LinkCustomAttributes = "";
            $this->bukti1->HrefValue = "";
            $this->bukti1->ExportHrefValue = $this->bukti1->UploadPath . $this->bukti1->Upload->DbValue;

            // bukti2
            $this->bukti2->LinkCustomAttributes = "";
            $this->bukti2->HrefValue = "";
            $this->bukti2->ExportHrefValue = $this->bukti2->UploadPath . $this->bukti2->Upload->DbValue;

            // bukti3
            $this->bukti3->LinkCustomAttributes = "";
            $this->bukti3->HrefValue = "";
            $this->bukti3->ExportHrefValue = $this->bukti3->UploadPath . $this->bukti3->Upload->DbValue;

            // bukti4
            $this->bukti4->LinkCustomAttributes = "";
            $this->bukti4->HrefValue = "";
            $this->bukti4->ExportHrefValue = $this->bukti4->UploadPath . $this->bukti4->Upload->DbValue;
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // pegawai
            $this->pegawai->setupEditAttributes();
            $this->pegawai->EditCustomAttributes = "";
            $this->pegawai->EditValue = HtmlEncode($this->pegawai->CurrentValue);
            $curVal = strval($this->pegawai->CurrentValue);
            if ($curVal != "") {
                $this->pegawai->EditValue = $this->pegawai->lookupCacheOption($curVal);
                if ($this->pegawai->EditValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->pegawai->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->pegawai->Lookup->renderViewRow($rswrk[0]);
                        $this->pegawai->EditValue = $this->pegawai->displayValue($arwrk);
                    } else {
                        $this->pegawai->EditValue = HtmlEncode(FormatNumber($this->pegawai->CurrentValue, $this->pegawai->formatPattern()));
                    }
                }
            } else {
                $this->pegawai->EditValue = null;
            }
            $this->pegawai->PlaceHolder = RemoveHtml($this->pegawai->caption());

            // nama
            $this->nama->setupEditAttributes();
            $this->nama->EditCustomAttributes = "";
            if (!$this->nama->Raw) {
                $this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
            }
            $this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
            $this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

            // tgl

            // total_pengajuan
            $this->total_pengajuan->setupEditAttributes();
            $this->total_pengajuan->EditCustomAttributes = "";
            $this->total_pengajuan->EditValue = HtmlEncode($this->total_pengajuan->CurrentValue);
            $this->total_pengajuan->PlaceHolder = RemoveHtml($this->total_pengajuan->caption());
            if (strval($this->total_pengajuan->EditValue) != "" && is_numeric($this->total_pengajuan->EditValue)) {
                $this->total_pengajuan->EditValue = FormatNumber($this->total_pengajuan->EditValue, null);
            }

            // tgl_pengajuan
            $this->tgl_pengajuan->setupEditAttributes();
            $this->tgl_pengajuan->EditCustomAttributes = "";
            $this->tgl_pengajuan->EditValue = HtmlEncode(FormatDateTime($this->tgl_pengajuan->CurrentValue, $this->tgl_pengajuan->formatPattern()));
            $this->tgl_pengajuan->PlaceHolder = RemoveHtml($this->tgl_pengajuan->caption());

            // jenis
            $this->jenis->setupEditAttributes();
            $this->jenis->EditCustomAttributes = "";
            if (!$this->jenis->Raw) {
                $this->jenis->CurrentValue = HtmlDecode($this->jenis->CurrentValue);
            }
            $this->jenis->EditValue = HtmlEncode($this->jenis->CurrentValue);
            $this->jenis->PlaceHolder = RemoveHtml($this->jenis->caption());

            // keterangan
            $this->keterangan->setupEditAttributes();
            $this->keterangan->EditCustomAttributes = "";
            $this->keterangan->EditValue = HtmlEncode($this->keterangan->CurrentValue);
            $this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

            // rek_tujuan
            $this->rek_tujuan->setupEditAttributes();
            $this->rek_tujuan->EditCustomAttributes = "";
            if (!$this->rek_tujuan->Raw) {
                $this->rek_tujuan->CurrentValue = HtmlDecode($this->rek_tujuan->CurrentValue);
            }
            $this->rek_tujuan->EditValue = HtmlEncode($this->rek_tujuan->CurrentValue);
            $this->rek_tujuan->PlaceHolder = RemoveHtml($this->rek_tujuan->caption());

            // disetujui
            $this->disetujui->EditCustomAttributes = "";
            $this->disetujui->EditValue = $this->disetujui->options(false);
            $this->disetujui->PlaceHolder = RemoveHtml($this->disetujui->caption());

            // pembayar
            $this->pembayar->setupEditAttributes();
            $this->pembayar->EditCustomAttributes = "";
            if (!$this->pembayar->Raw) {
                $this->pembayar->CurrentValue = HtmlDecode($this->pembayar->CurrentValue);
            }
            $this->pembayar->EditValue = HtmlEncode($this->pembayar->CurrentValue);
            $this->pembayar->PlaceHolder = RemoveHtml($this->pembayar->caption());

            // terbayar
            $this->terbayar->setupEditAttributes();
            $this->terbayar->EditCustomAttributes = "";
            if (!$this->terbayar->Raw) {
                $this->terbayar->CurrentValue = HtmlDecode($this->terbayar->CurrentValue);
            }
            $this->terbayar->EditValue = HtmlEncode($this->terbayar->CurrentValue);
            $this->terbayar->PlaceHolder = RemoveHtml($this->terbayar->caption());

            // tgl_pembayaran
            $this->tgl_pembayaran->setupEditAttributes();
            $this->tgl_pembayaran->EditCustomAttributes = "";
            $this->tgl_pembayaran->EditValue = HtmlEncode(FormatDateTime($this->tgl_pembayaran->CurrentValue, $this->tgl_pembayaran->formatPattern()));
            $this->tgl_pembayaran->PlaceHolder = RemoveHtml($this->tgl_pembayaran->caption());

            // jumlah_dibayar
            $this->jumlah_dibayar->setupEditAttributes();
            $this->jumlah_dibayar->EditCustomAttributes = "";
            $this->jumlah_dibayar->EditValue = HtmlEncode($this->jumlah_dibayar->CurrentValue);
            $this->jumlah_dibayar->PlaceHolder = RemoveHtml($this->jumlah_dibayar->caption());
            if (strval($this->jumlah_dibayar->EditValue) != "" && is_numeric($this->jumlah_dibayar->EditValue)) {
                $this->jumlah_dibayar->EditValue = FormatNumber($this->jumlah_dibayar->EditValue, null);
            }

            // bukti1
            $this->bukti1->setupEditAttributes();
            $this->bukti1->EditCustomAttributes = "";
            $this->bukti1->UploadPath = "file_reimburshbukti1";
            if (!EmptyValue($this->bukti1->Upload->DbValue)) {
                $this->bukti1->EditValue = $this->bukti1->Upload->DbValue;
            } else {
                $this->bukti1->EditValue = "";
            }
            if (!EmptyValue($this->bukti1->CurrentValue)) {
                $this->bukti1->Upload->FileName = $this->bukti1->CurrentValue;
            }
            if ($this->isShow()) {
                RenderUploadField($this->bukti1);
            }

            // bukti2
            $this->bukti2->setupEditAttributes();
            $this->bukti2->EditCustomAttributes = "";
            $this->bukti2->UploadPath = "file_reimburshbukti2";
            if (!EmptyValue($this->bukti2->Upload->DbValue)) {
                $this->bukti2->EditValue = $this->bukti2->Upload->DbValue;
            } else {
                $this->bukti2->EditValue = "";
            }
            if (!EmptyValue($this->bukti2->CurrentValue)) {
                $this->bukti2->Upload->FileName = $this->bukti2->CurrentValue;
            }
            if ($this->isShow()) {
                RenderUploadField($this->bukti2);
            }

            // bukti3
            $this->bukti3->setupEditAttributes();
            $this->bukti3->EditCustomAttributes = "";
            $this->bukti3->UploadPath = "file_reimburshbukti3";
            if (!EmptyValue($this->bukti3->Upload->DbValue)) {
                $this->bukti3->EditValue = $this->bukti3->Upload->DbValue;
            } else {
                $this->bukti3->EditValue = "";
            }
            if (!EmptyValue($this->bukti3->CurrentValue)) {
                $this->bukti3->Upload->FileName = $this->bukti3->CurrentValue;
            }
            if ($this->isShow()) {
                RenderUploadField($this->bukti3);
            }

            // bukti4
            $this->bukti4->setupEditAttributes();
            $this->bukti4->EditCustomAttributes = "";
            $this->bukti4->UploadPath = "file_reimburshbukti4";
            if (!EmptyValue($this->bukti4->Upload->DbValue)) {
                $this->bukti4->EditValue = $this->bukti4->Upload->DbValue;
            } else {
                $this->bukti4->EditValue = "";
            }
            if (!EmptyValue($this->bukti4->CurrentValue)) {
                $this->bukti4->Upload->FileName = $this->bukti4->CurrentValue;
            }
            if ($this->isShow()) {
                RenderUploadField($this->bukti4);
            }

            // Edit refer script

            // pegawai
            $this->pegawai->LinkCustomAttributes = "";
            $this->pegawai->HrefValue = "";

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";

            // tgl
            $this->tgl->LinkCustomAttributes = "";
            $this->tgl->HrefValue = "";

            // total_pengajuan
            $this->total_pengajuan->LinkCustomAttributes = "";
            $this->total_pengajuan->HrefValue = "";

            // tgl_pengajuan
            $this->tgl_pengajuan->LinkCustomAttributes = "";
            $this->tgl_pengajuan->HrefValue = "";

            // jenis
            $this->jenis->LinkCustomAttributes = "";
            $this->jenis->HrefValue = "";

            // keterangan
            $this->keterangan->LinkCustomAttributes = "";
            $this->keterangan->HrefValue = "";

            // rek_tujuan
            $this->rek_tujuan->LinkCustomAttributes = "";
            $this->rek_tujuan->HrefValue = "";

            // disetujui
            $this->disetujui->LinkCustomAttributes = "";
            $this->disetujui->HrefValue = "";

            // pembayar
            $this->pembayar->LinkCustomAttributes = "";
            $this->pembayar->HrefValue = "";

            // terbayar
            $this->terbayar->LinkCustomAttributes = "";
            $this->terbayar->HrefValue = "";

            // tgl_pembayaran
            $this->tgl_pembayaran->LinkCustomAttributes = "";
            $this->tgl_pembayaran->HrefValue = "";

            // jumlah_dibayar
            $this->jumlah_dibayar->LinkCustomAttributes = "";
            $this->jumlah_dibayar->HrefValue = "";

            // bukti1
            $this->bukti1->LinkCustomAttributes = "";
            $this->bukti1->HrefValue = "";
            $this->bukti1->ExportHrefValue = $this->bukti1->UploadPath . $this->bukti1->Upload->DbValue;

            // bukti2
            $this->bukti2->LinkCustomAttributes = "";
            $this->bukti2->HrefValue = "";
            $this->bukti2->ExportHrefValue = $this->bukti2->UploadPath . $this->bukti2->Upload->DbValue;

            // bukti3
            $this->bukti3->LinkCustomAttributes = "";
            $this->bukti3->HrefValue = "";
            $this->bukti3->ExportHrefValue = $this->bukti3->UploadPath . $this->bukti3->Upload->DbValue;

            // bukti4
            $this->bukti4->LinkCustomAttributes = "";
            $this->bukti4->HrefValue = "";
            $this->bukti4->ExportHrefValue = $this->bukti4->UploadPath . $this->bukti4->Upload->DbValue;
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
        if ($this->pegawai->Required) {
            if (!$this->pegawai->IsDetailKey && EmptyValue($this->pegawai->FormValue)) {
                $this->pegawai->addErrorMessage(str_replace("%s", $this->pegawai->caption(), $this->pegawai->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pegawai->FormValue)) {
            $this->pegawai->addErrorMessage($this->pegawai->getErrorMessage(false));
        }
        if ($this->nama->Required) {
            if (!$this->nama->IsDetailKey && EmptyValue($this->nama->FormValue)) {
                $this->nama->addErrorMessage(str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
            }
        }
        if ($this->tgl->Required) {
            if (!$this->tgl->IsDetailKey && EmptyValue($this->tgl->FormValue)) {
                $this->tgl->addErrorMessage(str_replace("%s", $this->tgl->caption(), $this->tgl->RequiredErrorMessage));
            }
        }
        if ($this->total_pengajuan->Required) {
            if (!$this->total_pengajuan->IsDetailKey && EmptyValue($this->total_pengajuan->FormValue)) {
                $this->total_pengajuan->addErrorMessage(str_replace("%s", $this->total_pengajuan->caption(), $this->total_pengajuan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->total_pengajuan->FormValue)) {
            $this->total_pengajuan->addErrorMessage($this->total_pengajuan->getErrorMessage(false));
        }
        if ($this->tgl_pengajuan->Required) {
            if (!$this->tgl_pengajuan->IsDetailKey && EmptyValue($this->tgl_pengajuan->FormValue)) {
                $this->tgl_pengajuan->addErrorMessage(str_replace("%s", $this->tgl_pengajuan->caption(), $this->tgl_pengajuan->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tgl_pengajuan->FormValue, $this->tgl_pengajuan->formatPattern())) {
            $this->tgl_pengajuan->addErrorMessage($this->tgl_pengajuan->getErrorMessage(false));
        }
        if ($this->jenis->Required) {
            if (!$this->jenis->IsDetailKey && EmptyValue($this->jenis->FormValue)) {
                $this->jenis->addErrorMessage(str_replace("%s", $this->jenis->caption(), $this->jenis->RequiredErrorMessage));
            }
        }
        if ($this->keterangan->Required) {
            if (!$this->keterangan->IsDetailKey && EmptyValue($this->keterangan->FormValue)) {
                $this->keterangan->addErrorMessage(str_replace("%s", $this->keterangan->caption(), $this->keterangan->RequiredErrorMessage));
            }
        }
        if ($this->rek_tujuan->Required) {
            if (!$this->rek_tujuan->IsDetailKey && EmptyValue($this->rek_tujuan->FormValue)) {
                $this->rek_tujuan->addErrorMessage(str_replace("%s", $this->rek_tujuan->caption(), $this->rek_tujuan->RequiredErrorMessage));
            }
        }
        if ($this->disetujui->Required) {
            if ($this->disetujui->FormValue == "") {
                $this->disetujui->addErrorMessage(str_replace("%s", $this->disetujui->caption(), $this->disetujui->RequiredErrorMessage));
            }
        }
        if ($this->pembayar->Required) {
            if (!$this->pembayar->IsDetailKey && EmptyValue($this->pembayar->FormValue)) {
                $this->pembayar->addErrorMessage(str_replace("%s", $this->pembayar->caption(), $this->pembayar->RequiredErrorMessage));
            }
        }
        if ($this->terbayar->Required) {
            if (!$this->terbayar->IsDetailKey && EmptyValue($this->terbayar->FormValue)) {
                $this->terbayar->addErrorMessage(str_replace("%s", $this->terbayar->caption(), $this->terbayar->RequiredErrorMessage));
            }
        }
        if ($this->tgl_pembayaran->Required) {
            if (!$this->tgl_pembayaran->IsDetailKey && EmptyValue($this->tgl_pembayaran->FormValue)) {
                $this->tgl_pembayaran->addErrorMessage(str_replace("%s", $this->tgl_pembayaran->caption(), $this->tgl_pembayaran->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tgl_pembayaran->FormValue, $this->tgl_pembayaran->formatPattern())) {
            $this->tgl_pembayaran->addErrorMessage($this->tgl_pembayaran->getErrorMessage(false));
        }
        if ($this->jumlah_dibayar->Required) {
            if (!$this->jumlah_dibayar->IsDetailKey && EmptyValue($this->jumlah_dibayar->FormValue)) {
                $this->jumlah_dibayar->addErrorMessage(str_replace("%s", $this->jumlah_dibayar->caption(), $this->jumlah_dibayar->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jumlah_dibayar->FormValue)) {
            $this->jumlah_dibayar->addErrorMessage($this->jumlah_dibayar->getErrorMessage(false));
        }
        if ($this->bukti1->Required) {
            if ($this->bukti1->Upload->FileName == "" && !$this->bukti1->Upload->KeepFile) {
                $this->bukti1->addErrorMessage(str_replace("%s", $this->bukti1->caption(), $this->bukti1->RequiredErrorMessage));
            }
        }
        if ($this->bukti2->Required) {
            if ($this->bukti2->Upload->FileName == "" && !$this->bukti2->Upload->KeepFile) {
                $this->bukti2->addErrorMessage(str_replace("%s", $this->bukti2->caption(), $this->bukti2->RequiredErrorMessage));
            }
        }
        if ($this->bukti3->Required) {
            if ($this->bukti3->Upload->FileName == "" && !$this->bukti3->Upload->KeepFile) {
                $this->bukti3->addErrorMessage(str_replace("%s", $this->bukti3->caption(), $this->bukti3->RequiredErrorMessage));
            }
        }
        if ($this->bukti4->Required) {
            if ($this->bukti4->Upload->FileName == "" && !$this->bukti4->Upload->KeepFile) {
                $this->bukti4->addErrorMessage(str_replace("%s", $this->bukti4->caption(), $this->bukti4->RequiredErrorMessage));
            }
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
            $this->bukti1->OldUploadPath = "file_reimburshbukti1";
            $this->bukti1->UploadPath = $this->bukti1->OldUploadPath;
            $this->bukti2->OldUploadPath = "file_reimburshbukti2";
            $this->bukti2->UploadPath = $this->bukti2->OldUploadPath;
            $this->bukti3->OldUploadPath = "file_reimburshbukti3";
            $this->bukti3->UploadPath = $this->bukti3->OldUploadPath;
            $this->bukti4->OldUploadPath = "file_reimburshbukti4";
            $this->bukti4->UploadPath = $this->bukti4->OldUploadPath;
        }

        // Set new row
        $rsnew = [];

        // pegawai
        $this->pegawai->setDbValueDef($rsnew, $this->pegawai->CurrentValue, null, $this->pegawai->ReadOnly);

        // nama
        $this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, null, $this->nama->ReadOnly);

        // tgl
        $this->tgl->CurrentValue = CurrentDateTime();
        $this->tgl->setDbValueDef($rsnew, $this->tgl->CurrentValue, null);

        // total_pengajuan
        $this->total_pengajuan->setDbValueDef($rsnew, $this->total_pengajuan->CurrentValue, null, $this->total_pengajuan->ReadOnly);

        // tgl_pengajuan
        $this->tgl_pengajuan->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_pengajuan->CurrentValue, $this->tgl_pengajuan->formatPattern()), null, $this->tgl_pengajuan->ReadOnly);

        // jenis
        $this->jenis->setDbValueDef($rsnew, $this->jenis->CurrentValue, null, $this->jenis->ReadOnly);

        // keterangan
        $this->keterangan->setDbValueDef($rsnew, $this->keterangan->CurrentValue, null, $this->keterangan->ReadOnly);

        // rek_tujuan
        $this->rek_tujuan->setDbValueDef($rsnew, $this->rek_tujuan->CurrentValue, null, $this->rek_tujuan->ReadOnly);

        // disetujui
        $this->disetujui->setDbValueDef($rsnew, $this->disetujui->CurrentValue, null, $this->disetujui->ReadOnly);

        // pembayar
        $this->pembayar->setDbValueDef($rsnew, $this->pembayar->CurrentValue, null, $this->pembayar->ReadOnly);

        // terbayar
        $this->terbayar->setDbValueDef($rsnew, $this->terbayar->CurrentValue, null, $this->terbayar->ReadOnly);

        // tgl_pembayaran
        $this->tgl_pembayaran->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_pembayaran->CurrentValue, $this->tgl_pembayaran->formatPattern()), null, $this->tgl_pembayaran->ReadOnly);

        // jumlah_dibayar
        $this->jumlah_dibayar->setDbValueDef($rsnew, $this->jumlah_dibayar->CurrentValue, null, $this->jumlah_dibayar->ReadOnly);

        // bukti1
        if ($this->bukti1->Visible && !$this->bukti1->ReadOnly && !$this->bukti1->Upload->KeepFile) {
            $this->bukti1->Upload->DbValue = $rsold['bukti1']; // Get original value
            if ($this->bukti1->Upload->FileName == "") {
                $rsnew['bukti1'] = null;
            } else {
                $rsnew['bukti1'] = $this->bukti1->Upload->FileName;
            }
        }

        // bukti2
        if ($this->bukti2->Visible && !$this->bukti2->ReadOnly && !$this->bukti2->Upload->KeepFile) {
            $this->bukti2->Upload->DbValue = $rsold['bukti2']; // Get original value
            if ($this->bukti2->Upload->FileName == "") {
                $rsnew['bukti2'] = null;
            } else {
                $rsnew['bukti2'] = $this->bukti2->Upload->FileName;
            }
        }

        // bukti3
        if ($this->bukti3->Visible && !$this->bukti3->ReadOnly && !$this->bukti3->Upload->KeepFile) {
            $this->bukti3->Upload->DbValue = $rsold['bukti3']; // Get original value
            if ($this->bukti3->Upload->FileName == "") {
                $rsnew['bukti3'] = null;
            } else {
                $rsnew['bukti3'] = $this->bukti3->Upload->FileName;
            }
        }

        // bukti4
        if ($this->bukti4->Visible && !$this->bukti4->ReadOnly && !$this->bukti4->Upload->KeepFile) {
            $this->bukti4->Upload->DbValue = $rsold['bukti4']; // Get original value
            if ($this->bukti4->Upload->FileName == "") {
                $rsnew['bukti4'] = null;
            } else {
                $rsnew['bukti4'] = $this->bukti4->Upload->FileName;
            }
        }

        // Update current values
        $this->setCurrentValues($rsnew);
        if ($this->bukti1->Visible && !$this->bukti1->Upload->KeepFile) {
            $this->bukti1->UploadPath = "file_reimburshbukti1";
            $oldFiles = EmptyValue($this->bukti1->Upload->DbValue) ? [] : [$this->bukti1->htmlDecode($this->bukti1->Upload->DbValue)];
            if (!EmptyValue($this->bukti1->Upload->FileName)) {
                $newFiles = [$this->bukti1->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->bukti1, $this->bukti1->Upload->Index);
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
                            $file1 = UniqueFilename($this->bukti1->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->bukti1->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->bukti1->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->bukti1->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->bukti1->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->bukti1->setDbValueDef($rsnew, $this->bukti1->Upload->FileName, null, $this->bukti1->ReadOnly);
            }
        }
        if ($this->bukti2->Visible && !$this->bukti2->Upload->KeepFile) {
            $this->bukti2->UploadPath = "file_reimburshbukti2";
            $oldFiles = EmptyValue($this->bukti2->Upload->DbValue) ? [] : [$this->bukti2->htmlDecode($this->bukti2->Upload->DbValue)];
            if (!EmptyValue($this->bukti2->Upload->FileName)) {
                $newFiles = [$this->bukti2->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->bukti2, $this->bukti2->Upload->Index);
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
                            $file1 = UniqueFilename($this->bukti2->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->bukti2->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->bukti2->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->bukti2->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->bukti2->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->bukti2->setDbValueDef($rsnew, $this->bukti2->Upload->FileName, null, $this->bukti2->ReadOnly);
            }
        }
        if ($this->bukti3->Visible && !$this->bukti3->Upload->KeepFile) {
            $this->bukti3->UploadPath = "file_reimburshbukti3";
            $oldFiles = EmptyValue($this->bukti3->Upload->DbValue) ? [] : [$this->bukti3->htmlDecode($this->bukti3->Upload->DbValue)];
            if (!EmptyValue($this->bukti3->Upload->FileName)) {
                $newFiles = [$this->bukti3->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->bukti3, $this->bukti3->Upload->Index);
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
                            $file1 = UniqueFilename($this->bukti3->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->bukti3->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->bukti3->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->bukti3->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->bukti3->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->bukti3->setDbValueDef($rsnew, $this->bukti3->Upload->FileName, null, $this->bukti3->ReadOnly);
            }
        }
        if ($this->bukti4->Visible && !$this->bukti4->Upload->KeepFile) {
            $this->bukti4->UploadPath = "file_reimburshbukti4";
            $oldFiles = EmptyValue($this->bukti4->Upload->DbValue) ? [] : [$this->bukti4->htmlDecode($this->bukti4->Upload->DbValue)];
            if (!EmptyValue($this->bukti4->Upload->FileName)) {
                $newFiles = [$this->bukti4->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->bukti4, $this->bukti4->Upload->Index);
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
                            $file1 = UniqueFilename($this->bukti4->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->bukti4->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->bukti4->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->bukti4->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->bukti4->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->bukti4->setDbValueDef($rsnew, $this->bukti4->Upload->FileName, null, $this->bukti4->ReadOnly);
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
                if ($this->bukti1->Visible && !$this->bukti1->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->bukti1->Upload->DbValue) ? [] : [$this->bukti1->htmlDecode($this->bukti1->Upload->DbValue)];
                    if (!EmptyValue($this->bukti1->Upload->FileName)) {
                        $newFiles = [$this->bukti1->Upload->FileName];
                        $newFiles2 = [$this->bukti1->htmlDecode($rsnew['bukti1'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->bukti1, $this->bukti1->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->bukti1->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
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
                                @unlink($this->bukti1->oldPhysicalUploadPath() . $oldFile);
                            }
                        }
                    }
                }
                if ($this->bukti2->Visible && !$this->bukti2->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->bukti2->Upload->DbValue) ? [] : [$this->bukti2->htmlDecode($this->bukti2->Upload->DbValue)];
                    if (!EmptyValue($this->bukti2->Upload->FileName)) {
                        $newFiles = [$this->bukti2->Upload->FileName];
                        $newFiles2 = [$this->bukti2->htmlDecode($rsnew['bukti2'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->bukti2, $this->bukti2->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->bukti2->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
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
                                @unlink($this->bukti2->oldPhysicalUploadPath() . $oldFile);
                            }
                        }
                    }
                }
                if ($this->bukti3->Visible && !$this->bukti3->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->bukti3->Upload->DbValue) ? [] : [$this->bukti3->htmlDecode($this->bukti3->Upload->DbValue)];
                    if (!EmptyValue($this->bukti3->Upload->FileName)) {
                        $newFiles = [$this->bukti3->Upload->FileName];
                        $newFiles2 = [$this->bukti3->htmlDecode($rsnew['bukti3'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->bukti3, $this->bukti3->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->bukti3->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
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
                                @unlink($this->bukti3->oldPhysicalUploadPath() . $oldFile);
                            }
                        }
                    }
                }
                if ($this->bukti4->Visible && !$this->bukti4->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->bukti4->Upload->DbValue) ? [] : [$this->bukti4->htmlDecode($this->bukti4->Upload->DbValue)];
                    if (!EmptyValue($this->bukti4->Upload->FileName)) {
                        $newFiles = [$this->bukti4->Upload->FileName];
                        $newFiles2 = [$this->bukti4->htmlDecode($rsnew['bukti4'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->bukti4, $this->bukti4->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->bukti4->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
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
                                @unlink($this->bukti4->oldPhysicalUploadPath() . $oldFile);
                            }
                        }
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
            // bukti1
            CleanUploadTempPath($this->bukti1, $this->bukti1->Upload->Index);

            // bukti2
            CleanUploadTempPath($this->bukti2, $this->bukti2->Upload->Index);

            // bukti3
            CleanUploadTempPath($this->bukti3, $this->bukti3->Upload->Index);

            // bukti4
            CleanUploadTempPath($this->bukti4, $this->bukti4->Upload->Index);
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ReimburshList"), "", $this->TableVar, true);
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
                case "x_pegawai":
                    break;
                case "x_disetujui":
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
