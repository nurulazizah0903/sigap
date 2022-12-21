<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class GajisdDetilAdd extends GajisdDetil
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'gajisd_detil';

    // Page object name
    public $PageObjName = "GajisdDetilAdd";

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

        // Table object (gajisd_detil)
        if (!isset($GLOBALS["gajisd_detil"]) || get_class($GLOBALS["gajisd_detil"]) == PROJECT_NAMESPACE . "gajisd_detil") {
            $GLOBALS["gajisd_detil"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'gajisd_detil');
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
                $tbl = Container("gajisd_detil");
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
                    if ($pageName == "GajisdDetilView") {
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
    public $FormClassName = "ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

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
        $this->pid->setVisibility();
        $this->pegawai_id->setVisibility();
        $this->jabatan_id->setVisibility();
        $this->masakerja->setVisibility();
        $this->jumngajar->setVisibility();
        $this->ijin->setVisibility();
        $this->baku->setVisibility();
        $this->kehadiran->setVisibility();
        $this->prestasi->setVisibility();
        $this->nominal_baku->setVisibility();
        $this->jumlahterima->setVisibility();
        $this->tunjangan_wkosis->setVisibility();
        $this->potongan1->setVisibility();
        $this->potongan2->setVisibility();
        $this->jumlahgaji->setVisibility();
        $this->jumgajitotal->setVisibility();
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
        $this->setupLookupOptions($this->pegawai_id);
        $this->setupLookupOptions($this->jabatan_id);

        // Load default values for add
        $this->loadDefaultValues();

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Set up master/detail parameters
        // NOTE: must be after loadOldRecord to prevent master key values overwritten
        $this->setupMasterParms();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("GajisdDetilList"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "GajisdDetilList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "GajisdDetilView") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
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
    }

    // Load default values
    protected function loadDefaultValues()
    {
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'pid' first before field var 'x_pid'
        $val = $CurrentForm->hasValue("pid") ? $CurrentForm->getValue("pid") : $CurrentForm->getValue("x_pid");
        if (!$this->pid->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pid->Visible = false; // Disable update for API request
            } else {
                $this->pid->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'pegawai_id' first before field var 'x_pegawai_id'
        $val = $CurrentForm->hasValue("pegawai_id") ? $CurrentForm->getValue("pegawai_id") : $CurrentForm->getValue("x_pegawai_id");
        if (!$this->pegawai_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pegawai_id->Visible = false; // Disable update for API request
            } else {
                $this->pegawai_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'jabatan_id' first before field var 'x_jabatan_id'
        $val = $CurrentForm->hasValue("jabatan_id") ? $CurrentForm->getValue("jabatan_id") : $CurrentForm->getValue("x_jabatan_id");
        if (!$this->jabatan_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jabatan_id->Visible = false; // Disable update for API request
            } else {
                $this->jabatan_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'masakerja' first before field var 'x_masakerja'
        $val = $CurrentForm->hasValue("masakerja") ? $CurrentForm->getValue("masakerja") : $CurrentForm->getValue("x_masakerja");
        if (!$this->masakerja->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->masakerja->Visible = false; // Disable update for API request
            } else {
                $this->masakerja->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'jumngajar' first before field var 'x_jumngajar'
        $val = $CurrentForm->hasValue("jumngajar") ? $CurrentForm->getValue("jumngajar") : $CurrentForm->getValue("x_jumngajar");
        if (!$this->jumngajar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jumngajar->Visible = false; // Disable update for API request
            } else {
                $this->jumngajar->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'ijin' first before field var 'x_ijin'
        $val = $CurrentForm->hasValue("ijin") ? $CurrentForm->getValue("ijin") : $CurrentForm->getValue("x_ijin");
        if (!$this->ijin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ijin->Visible = false; // Disable update for API request
            } else {
                $this->ijin->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'baku' first before field var 'x_baku'
        $val = $CurrentForm->hasValue("baku") ? $CurrentForm->getValue("baku") : $CurrentForm->getValue("x_baku");
        if (!$this->baku->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->baku->Visible = false; // Disable update for API request
            } else {
                $this->baku->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'kehadiran' first before field var 'x_kehadiran'
        $val = $CurrentForm->hasValue("kehadiran") ? $CurrentForm->getValue("kehadiran") : $CurrentForm->getValue("x_kehadiran");
        if (!$this->kehadiran->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kehadiran->Visible = false; // Disable update for API request
            } else {
                $this->kehadiran->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'prestasi' first before field var 'x_prestasi'
        $val = $CurrentForm->hasValue("prestasi") ? $CurrentForm->getValue("prestasi") : $CurrentForm->getValue("x_prestasi");
        if (!$this->prestasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->prestasi->Visible = false; // Disable update for API request
            } else {
                $this->prestasi->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'nominal_baku' first before field var 'x_nominal_baku'
        $val = $CurrentForm->hasValue("nominal_baku") ? $CurrentForm->getValue("nominal_baku") : $CurrentForm->getValue("x_nominal_baku");
        if (!$this->nominal_baku->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nominal_baku->Visible = false; // Disable update for API request
            } else {
                $this->nominal_baku->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'jumlahterima' first before field var 'x_jumlahterima'
        $val = $CurrentForm->hasValue("jumlahterima") ? $CurrentForm->getValue("jumlahterima") : $CurrentForm->getValue("x_jumlahterima");
        if (!$this->jumlahterima->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jumlahterima->Visible = false; // Disable update for API request
            } else {
                $this->jumlahterima->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'tunjangan_wkosis' first before field var 'x_tunjangan_wkosis'
        $val = $CurrentForm->hasValue("tunjangan_wkosis") ? $CurrentForm->getValue("tunjangan_wkosis") : $CurrentForm->getValue("x_tunjangan_wkosis");
        if (!$this->tunjangan_wkosis->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tunjangan_wkosis->Visible = false; // Disable update for API request
            } else {
                $this->tunjangan_wkosis->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'potongan1' first before field var 'x_potongan1'
        $val = $CurrentForm->hasValue("potongan1") ? $CurrentForm->getValue("potongan1") : $CurrentForm->getValue("x_potongan1");
        if (!$this->potongan1->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->potongan1->Visible = false; // Disable update for API request
            } else {
                $this->potongan1->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'potongan2' first before field var 'x_potongan2'
        $val = $CurrentForm->hasValue("potongan2") ? $CurrentForm->getValue("potongan2") : $CurrentForm->getValue("x_potongan2");
        if (!$this->potongan2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->potongan2->Visible = false; // Disable update for API request
            } else {
                $this->potongan2->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'jumlahgaji' first before field var 'x_jumlahgaji'
        $val = $CurrentForm->hasValue("jumlahgaji") ? $CurrentForm->getValue("jumlahgaji") : $CurrentForm->getValue("x_jumlahgaji");
        if (!$this->jumlahgaji->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jumlahgaji->Visible = false; // Disable update for API request
            } else {
                $this->jumlahgaji->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'jumgajitotal' first before field var 'x_jumgajitotal'
        $val = $CurrentForm->hasValue("jumgajitotal") ? $CurrentForm->getValue("jumgajitotal") : $CurrentForm->getValue("x_jumgajitotal");
        if (!$this->jumgajitotal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jumgajitotal->Visible = false; // Disable update for API request
            } else {
                $this->jumgajitotal->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->pid->CurrentValue = $this->pid->FormValue;
        $this->pegawai_id->CurrentValue = $this->pegawai_id->FormValue;
        $this->jabatan_id->CurrentValue = $this->jabatan_id->FormValue;
        $this->masakerja->CurrentValue = $this->masakerja->FormValue;
        $this->jumngajar->CurrentValue = $this->jumngajar->FormValue;
        $this->ijin->CurrentValue = $this->ijin->FormValue;
        $this->baku->CurrentValue = $this->baku->FormValue;
        $this->kehadiran->CurrentValue = $this->kehadiran->FormValue;
        $this->prestasi->CurrentValue = $this->prestasi->FormValue;
        $this->nominal_baku->CurrentValue = $this->nominal_baku->FormValue;
        $this->jumlahterima->CurrentValue = $this->jumlahterima->FormValue;
        $this->tunjangan_wkosis->CurrentValue = $this->tunjangan_wkosis->FormValue;
        $this->potongan1->CurrentValue = $this->potongan1->FormValue;
        $this->potongan2->CurrentValue = $this->potongan2->FormValue;
        $this->jumlahgaji->CurrentValue = $this->jumlahgaji->FormValue;
        $this->jumgajitotal->CurrentValue = $this->jumgajitotal->FormValue;
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
        $this->pegawai_id->setDbValue($row['pegawai_id']);
        $this->jabatan_id->setDbValue($row['jabatan_id']);
        $this->masakerja->setDbValue($row['masakerja']);
        $this->jumngajar->setDbValue($row['jumngajar']);
        $this->ijin->setDbValue($row['ijin']);
        $this->baku->setDbValue($row['baku']);
        $this->kehadiran->setDbValue($row['kehadiran']);
        $this->prestasi->setDbValue($row['prestasi']);
        $this->nominal_baku->setDbValue($row['nominal_baku']);
        $this->jumlahterima->setDbValue($row['jumlahterima']);
        $this->tunjangan_wkosis->setDbValue($row['tunjangan_wkosis']);
        $this->potongan1->setDbValue($row['potongan1']);
        $this->potongan2->setDbValue($row['potongan2']);
        $this->jumlahgaji->setDbValue($row['jumlahgaji']);
        $this->jumgajitotal->setDbValue($row['jumgajitotal']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['pid'] = $this->pid->DefaultValue;
        $row['pegawai_id'] = $this->pegawai_id->DefaultValue;
        $row['jabatan_id'] = $this->jabatan_id->DefaultValue;
        $row['masakerja'] = $this->masakerja->DefaultValue;
        $row['jumngajar'] = $this->jumngajar->DefaultValue;
        $row['ijin'] = $this->ijin->DefaultValue;
        $row['baku'] = $this->baku->DefaultValue;
        $row['kehadiran'] = $this->kehadiran->DefaultValue;
        $row['prestasi'] = $this->prestasi->DefaultValue;
        $row['nominal_baku'] = $this->nominal_baku->DefaultValue;
        $row['jumlahterima'] = $this->jumlahterima->DefaultValue;
        $row['tunjangan_wkosis'] = $this->tunjangan_wkosis->DefaultValue;
        $row['potongan1'] = $this->potongan1->DefaultValue;
        $row['potongan2'] = $this->potongan2->DefaultValue;
        $row['jumlahgaji'] = $this->jumlahgaji->DefaultValue;
        $row['jumgajitotal'] = $this->jumgajitotal->DefaultValue;
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

        // pegawai_id
        $this->pegawai_id->RowCssClass = "row";

        // jabatan_id
        $this->jabatan_id->RowCssClass = "row";

        // masakerja
        $this->masakerja->RowCssClass = "row";

        // jumngajar
        $this->jumngajar->RowCssClass = "row";

        // ijin
        $this->ijin->RowCssClass = "row";

        // baku
        $this->baku->RowCssClass = "row";

        // kehadiran
        $this->kehadiran->RowCssClass = "row";

        // prestasi
        $this->prestasi->RowCssClass = "row";

        // nominal_baku
        $this->nominal_baku->RowCssClass = "row";

        // jumlahterima
        $this->jumlahterima->RowCssClass = "row";

        // tunjangan_wkosis
        $this->tunjangan_wkosis->RowCssClass = "row";

        // potongan1
        $this->potongan1->RowCssClass = "row";

        // potongan2
        $this->potongan2->RowCssClass = "row";

        // jumlahgaji
        $this->jumlahgaji->RowCssClass = "row";

        // jumgajitotal
        $this->jumgajitotal->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // pid
            $this->pid->ViewValue = $this->pid->CurrentValue;
            $this->pid->ViewValue = FormatNumber($this->pid->ViewValue, $this->pid->formatPattern());
            $this->pid->ViewCustomAttributes = "";

            // pegawai_id
            $this->pegawai_id->ViewValue = $this->pegawai_id->CurrentValue;
            $curVal = strval($this->pegawai_id->CurrentValue);
            if ($curVal != "") {
                $this->pegawai_id->ViewValue = $this->pegawai_id->lookupCacheOption($curVal);
                if ($this->pegawai_id->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->pegawai_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->pegawai_id->Lookup->renderViewRow($rswrk[0]);
                        $this->pegawai_id->ViewValue = $this->pegawai_id->displayValue($arwrk);
                    } else {
                        $this->pegawai_id->ViewValue = FormatNumber($this->pegawai_id->CurrentValue, $this->pegawai_id->formatPattern());
                    }
                }
            } else {
                $this->pegawai_id->ViewValue = null;
            }
            $this->pegawai_id->ViewCustomAttributes = "";

            // jabatan_id
            $this->jabatan_id->ViewValue = $this->jabatan_id->CurrentValue;
            $curVal = strval($this->jabatan_id->CurrentValue);
            if ($curVal != "") {
                $this->jabatan_id->ViewValue = $this->jabatan_id->lookupCacheOption($curVal);
                if ($this->jabatan_id->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->jabatan_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->jabatan_id->Lookup->renderViewRow($rswrk[0]);
                        $this->jabatan_id->ViewValue = $this->jabatan_id->displayValue($arwrk);
                    } else {
                        $this->jabatan_id->ViewValue = FormatNumber($this->jabatan_id->CurrentValue, $this->jabatan_id->formatPattern());
                    }
                }
            } else {
                $this->jabatan_id->ViewValue = null;
            }
            $this->jabatan_id->ViewCustomAttributes = "";

            // masakerja
            $this->masakerja->ViewValue = $this->masakerja->CurrentValue;
            $this->masakerja->ViewValue = FormatNumber($this->masakerja->ViewValue, $this->masakerja->formatPattern());
            $this->masakerja->ViewCustomAttributes = "";

            // jumngajar
            $this->jumngajar->ViewValue = $this->jumngajar->CurrentValue;
            $this->jumngajar->ViewValue = FormatNumber($this->jumngajar->ViewValue, $this->jumngajar->formatPattern());
            $this->jumngajar->ViewCustomAttributes = "";

            // ijin
            $this->ijin->ViewValue = $this->ijin->CurrentValue;
            $this->ijin->ViewValue = FormatNumber($this->ijin->ViewValue, $this->ijin->formatPattern());
            $this->ijin->ViewCustomAttributes = "";

            // baku
            $this->baku->ViewValue = $this->baku->CurrentValue;
            $this->baku->ViewValue = FormatNumber($this->baku->ViewValue, $this->baku->formatPattern());
            $this->baku->ViewCustomAttributes = "";

            // kehadiran
            $this->kehadiran->ViewValue = $this->kehadiran->CurrentValue;
            $this->kehadiran->ViewValue = FormatNumber($this->kehadiran->ViewValue, $this->kehadiran->formatPattern());
            $this->kehadiran->ViewCustomAttributes = "";

            // prestasi
            $this->prestasi->ViewValue = $this->prestasi->CurrentValue;
            $this->prestasi->ViewValue = FormatNumber($this->prestasi->ViewValue, $this->prestasi->formatPattern());
            $this->prestasi->ViewCustomAttributes = "";

            // nominal_baku
            $this->nominal_baku->ViewValue = $this->nominal_baku->CurrentValue;
            $this->nominal_baku->ViewValue = FormatNumber($this->nominal_baku->ViewValue, $this->nominal_baku->formatPattern());
            $this->nominal_baku->ViewCustomAttributes = "";

            // jumlahterima
            $this->jumlahterima->ViewValue = $this->jumlahterima->CurrentValue;
            $this->jumlahterima->ViewValue = FormatNumber($this->jumlahterima->ViewValue, $this->jumlahterima->formatPattern());
            $this->jumlahterima->ViewCustomAttributes = "";

            // tunjangan_wkosis
            $this->tunjangan_wkosis->ViewValue = $this->tunjangan_wkosis->CurrentValue;
            $this->tunjangan_wkosis->ViewValue = FormatNumber($this->tunjangan_wkosis->ViewValue, $this->tunjangan_wkosis->formatPattern());
            $this->tunjangan_wkosis->ViewCustomAttributes = "";

            // potongan1
            $this->potongan1->ViewValue = $this->potongan1->CurrentValue;
            $this->potongan1->ViewValue = FormatNumber($this->potongan1->ViewValue, $this->potongan1->formatPattern());
            $this->potongan1->ViewCustomAttributes = "";

            // potongan2
            $this->potongan2->ViewValue = $this->potongan2->CurrentValue;
            $this->potongan2->ViewValue = FormatNumber($this->potongan2->ViewValue, $this->potongan2->formatPattern());
            $this->potongan2->ViewCustomAttributes = "";

            // jumlahgaji
            $this->jumlahgaji->ViewValue = $this->jumlahgaji->CurrentValue;
            $this->jumlahgaji->ViewValue = FormatNumber($this->jumlahgaji->ViewValue, $this->jumlahgaji->formatPattern());
            $this->jumlahgaji->ViewCustomAttributes = "";

            // jumgajitotal
            $this->jumgajitotal->ViewValue = $this->jumgajitotal->CurrentValue;
            $this->jumgajitotal->ViewValue = FormatNumber($this->jumgajitotal->ViewValue, $this->jumgajitotal->formatPattern());
            $this->jumgajitotal->ViewCustomAttributes = "";

            // pid
            $this->pid->LinkCustomAttributes = "";
            $this->pid->HrefValue = "";

            // pegawai_id
            $this->pegawai_id->LinkCustomAttributes = "";
            $this->pegawai_id->HrefValue = "";

            // jabatan_id
            $this->jabatan_id->LinkCustomAttributes = "";
            $this->jabatan_id->HrefValue = "";

            // masakerja
            $this->masakerja->LinkCustomAttributes = "";
            $this->masakerja->HrefValue = "";

            // jumngajar
            $this->jumngajar->LinkCustomAttributes = "";
            $this->jumngajar->HrefValue = "";

            // ijin
            $this->ijin->LinkCustomAttributes = "";
            $this->ijin->HrefValue = "";

            // baku
            $this->baku->LinkCustomAttributes = "";
            $this->baku->HrefValue = "";

            // kehadiran
            $this->kehadiran->LinkCustomAttributes = "";
            $this->kehadiran->HrefValue = "";

            // prestasi
            $this->prestasi->LinkCustomAttributes = "";
            $this->prestasi->HrefValue = "";

            // nominal_baku
            $this->nominal_baku->LinkCustomAttributes = "";
            $this->nominal_baku->HrefValue = "";

            // jumlahterima
            $this->jumlahterima->LinkCustomAttributes = "";
            $this->jumlahterima->HrefValue = "";

            // tunjangan_wkosis
            $this->tunjangan_wkosis->LinkCustomAttributes = "";
            $this->tunjangan_wkosis->HrefValue = "";

            // potongan1
            $this->potongan1->LinkCustomAttributes = "";
            $this->potongan1->HrefValue = "";

            // potongan2
            $this->potongan2->LinkCustomAttributes = "";
            $this->potongan2->HrefValue = "";

            // jumlahgaji
            $this->jumlahgaji->LinkCustomAttributes = "";
            $this->jumlahgaji->HrefValue = "";

            // jumgajitotal
            $this->jumgajitotal->LinkCustomAttributes = "";
            $this->jumgajitotal->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // pid
            $this->pid->setupEditAttributes();
            $this->pid->EditCustomAttributes = "";
            if ($this->pid->getSessionValue() != "") {
                $this->pid->CurrentValue = GetForeignKeyValue($this->pid->getSessionValue());
                $this->pid->ViewValue = $this->pid->CurrentValue;
                $this->pid->ViewValue = FormatNumber($this->pid->ViewValue, $this->pid->formatPattern());
                $this->pid->ViewCustomAttributes = "";
            } else {
                $this->pid->EditValue = HtmlEncode($this->pid->CurrentValue);
                $this->pid->PlaceHolder = RemoveHtml($this->pid->caption());
                if (strval($this->pid->EditValue) != "" && is_numeric($this->pid->EditValue)) {
                    $this->pid->EditValue = FormatNumber($this->pid->EditValue, null);
                }
            }

            // pegawai_id
            $this->pegawai_id->setupEditAttributes();
            $this->pegawai_id->EditCustomAttributes = "";
            $this->pegawai_id->EditValue = HtmlEncode($this->pegawai_id->CurrentValue);
            $curVal = strval($this->pegawai_id->CurrentValue);
            if ($curVal != "") {
                $this->pegawai_id->EditValue = $this->pegawai_id->lookupCacheOption($curVal);
                if ($this->pegawai_id->EditValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->pegawai_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->pegawai_id->Lookup->renderViewRow($rswrk[0]);
                        $this->pegawai_id->EditValue = $this->pegawai_id->displayValue($arwrk);
                    } else {
                        $this->pegawai_id->EditValue = HtmlEncode(FormatNumber($this->pegawai_id->CurrentValue, $this->pegawai_id->formatPattern()));
                    }
                }
            } else {
                $this->pegawai_id->EditValue = null;
            }
            $this->pegawai_id->PlaceHolder = RemoveHtml($this->pegawai_id->caption());

            // jabatan_id
            $this->jabatan_id->setupEditAttributes();
            $this->jabatan_id->EditCustomAttributes = "";
            $this->jabatan_id->EditValue = HtmlEncode($this->jabatan_id->CurrentValue);
            $curVal = strval($this->jabatan_id->CurrentValue);
            if ($curVal != "") {
                $this->jabatan_id->EditValue = $this->jabatan_id->lookupCacheOption($curVal);
                if ($this->jabatan_id->EditValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->jabatan_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->jabatan_id->Lookup->renderViewRow($rswrk[0]);
                        $this->jabatan_id->EditValue = $this->jabatan_id->displayValue($arwrk);
                    } else {
                        $this->jabatan_id->EditValue = HtmlEncode(FormatNumber($this->jabatan_id->CurrentValue, $this->jabatan_id->formatPattern()));
                    }
                }
            } else {
                $this->jabatan_id->EditValue = null;
            }
            $this->jabatan_id->PlaceHolder = RemoveHtml($this->jabatan_id->caption());

            // masakerja
            $this->masakerja->setupEditAttributes();
            $this->masakerja->EditCustomAttributes = "";
            $this->masakerja->EditValue = HtmlEncode($this->masakerja->CurrentValue);
            $this->masakerja->PlaceHolder = RemoveHtml($this->masakerja->caption());
            if (strval($this->masakerja->EditValue) != "" && is_numeric($this->masakerja->EditValue)) {
                $this->masakerja->EditValue = FormatNumber($this->masakerja->EditValue, null);
            }

            // jumngajar
            $this->jumngajar->setupEditAttributes();
            $this->jumngajar->EditCustomAttributes = "";
            $this->jumngajar->EditValue = HtmlEncode($this->jumngajar->CurrentValue);
            $this->jumngajar->PlaceHolder = RemoveHtml($this->jumngajar->caption());
            if (strval($this->jumngajar->EditValue) != "" && is_numeric($this->jumngajar->EditValue)) {
                $this->jumngajar->EditValue = FormatNumber($this->jumngajar->EditValue, null);
            }

            // ijin
            $this->ijin->setupEditAttributes();
            $this->ijin->EditCustomAttributes = "";
            $this->ijin->EditValue = HtmlEncode($this->ijin->CurrentValue);
            $this->ijin->PlaceHolder = RemoveHtml($this->ijin->caption());
            if (strval($this->ijin->EditValue) != "" && is_numeric($this->ijin->EditValue)) {
                $this->ijin->EditValue = FormatNumber($this->ijin->EditValue, null);
            }

            // baku
            $this->baku->setupEditAttributes();
            $this->baku->EditCustomAttributes = "";
            $this->baku->EditValue = HtmlEncode($this->baku->CurrentValue);
            $this->baku->PlaceHolder = RemoveHtml($this->baku->caption());
            if (strval($this->baku->EditValue) != "" && is_numeric($this->baku->EditValue)) {
                $this->baku->EditValue = FormatNumber($this->baku->EditValue, null);
            }

            // kehadiran
            $this->kehadiran->setupEditAttributes();
            $this->kehadiran->EditCustomAttributes = "";
            $this->kehadiran->EditValue = HtmlEncode($this->kehadiran->CurrentValue);
            $this->kehadiran->PlaceHolder = RemoveHtml($this->kehadiran->caption());
            if (strval($this->kehadiran->EditValue) != "" && is_numeric($this->kehadiran->EditValue)) {
                $this->kehadiran->EditValue = FormatNumber($this->kehadiran->EditValue, null);
            }

            // prestasi
            $this->prestasi->setupEditAttributes();
            $this->prestasi->EditCustomAttributes = "";
            $this->prestasi->EditValue = HtmlEncode($this->prestasi->CurrentValue);
            $this->prestasi->PlaceHolder = RemoveHtml($this->prestasi->caption());
            if (strval($this->prestasi->EditValue) != "" && is_numeric($this->prestasi->EditValue)) {
                $this->prestasi->EditValue = FormatNumber($this->prestasi->EditValue, null);
            }

            // nominal_baku
            $this->nominal_baku->setupEditAttributes();
            $this->nominal_baku->EditCustomAttributes = "";
            $this->nominal_baku->EditValue = HtmlEncode($this->nominal_baku->CurrentValue);
            $this->nominal_baku->PlaceHolder = RemoveHtml($this->nominal_baku->caption());
            if (strval($this->nominal_baku->EditValue) != "" && is_numeric($this->nominal_baku->EditValue)) {
                $this->nominal_baku->EditValue = FormatNumber($this->nominal_baku->EditValue, null);
            }

            // jumlahterima
            $this->jumlahterima->setupEditAttributes();
            $this->jumlahterima->EditCustomAttributes = "";
            $this->jumlahterima->EditValue = HtmlEncode($this->jumlahterima->CurrentValue);
            $this->jumlahterima->PlaceHolder = RemoveHtml($this->jumlahterima->caption());
            if (strval($this->jumlahterima->EditValue) != "" && is_numeric($this->jumlahterima->EditValue)) {
                $this->jumlahterima->EditValue = FormatNumber($this->jumlahterima->EditValue, null);
            }

            // tunjangan_wkosis
            $this->tunjangan_wkosis->setupEditAttributes();
            $this->tunjangan_wkosis->EditCustomAttributes = "";
            $this->tunjangan_wkosis->EditValue = HtmlEncode($this->tunjangan_wkosis->CurrentValue);
            $this->tunjangan_wkosis->PlaceHolder = RemoveHtml($this->tunjangan_wkosis->caption());
            if (strval($this->tunjangan_wkosis->EditValue) != "" && is_numeric($this->tunjangan_wkosis->EditValue)) {
                $this->tunjangan_wkosis->EditValue = FormatNumber($this->tunjangan_wkosis->EditValue, null);
            }

            // potongan1
            $this->potongan1->setupEditAttributes();
            $this->potongan1->EditCustomAttributes = "";
            $this->potongan1->EditValue = HtmlEncode($this->potongan1->CurrentValue);
            $this->potongan1->PlaceHolder = RemoveHtml($this->potongan1->caption());
            if (strval($this->potongan1->EditValue) != "" && is_numeric($this->potongan1->EditValue)) {
                $this->potongan1->EditValue = FormatNumber($this->potongan1->EditValue, null);
            }

            // potongan2
            $this->potongan2->setupEditAttributes();
            $this->potongan2->EditCustomAttributes = "";
            $this->potongan2->EditValue = HtmlEncode($this->potongan2->CurrentValue);
            $this->potongan2->PlaceHolder = RemoveHtml($this->potongan2->caption());
            if (strval($this->potongan2->EditValue) != "" && is_numeric($this->potongan2->EditValue)) {
                $this->potongan2->EditValue = FormatNumber($this->potongan2->EditValue, null);
            }

            // jumlahgaji
            $this->jumlahgaji->setupEditAttributes();
            $this->jumlahgaji->EditCustomAttributes = "";
            $this->jumlahgaji->EditValue = HtmlEncode($this->jumlahgaji->CurrentValue);
            $this->jumlahgaji->PlaceHolder = RemoveHtml($this->jumlahgaji->caption());
            if (strval($this->jumlahgaji->EditValue) != "" && is_numeric($this->jumlahgaji->EditValue)) {
                $this->jumlahgaji->EditValue = FormatNumber($this->jumlahgaji->EditValue, null);
            }

            // jumgajitotal
            $this->jumgajitotal->setupEditAttributes();
            $this->jumgajitotal->EditCustomAttributes = "";
            $this->jumgajitotal->EditValue = HtmlEncode($this->jumgajitotal->CurrentValue);
            $this->jumgajitotal->PlaceHolder = RemoveHtml($this->jumgajitotal->caption());
            if (strval($this->jumgajitotal->EditValue) != "" && is_numeric($this->jumgajitotal->EditValue)) {
                $this->jumgajitotal->EditValue = FormatNumber($this->jumgajitotal->EditValue, null);
            }

            // Add refer script

            // pid
            $this->pid->LinkCustomAttributes = "";
            $this->pid->HrefValue = "";

            // pegawai_id
            $this->pegawai_id->LinkCustomAttributes = "";
            $this->pegawai_id->HrefValue = "";

            // jabatan_id
            $this->jabatan_id->LinkCustomAttributes = "";
            $this->jabatan_id->HrefValue = "";

            // masakerja
            $this->masakerja->LinkCustomAttributes = "";
            $this->masakerja->HrefValue = "";

            // jumngajar
            $this->jumngajar->LinkCustomAttributes = "";
            $this->jumngajar->HrefValue = "";

            // ijin
            $this->ijin->LinkCustomAttributes = "";
            $this->ijin->HrefValue = "";

            // baku
            $this->baku->LinkCustomAttributes = "";
            $this->baku->HrefValue = "";

            // kehadiran
            $this->kehadiran->LinkCustomAttributes = "";
            $this->kehadiran->HrefValue = "";

            // prestasi
            $this->prestasi->LinkCustomAttributes = "";
            $this->prestasi->HrefValue = "";

            // nominal_baku
            $this->nominal_baku->LinkCustomAttributes = "";
            $this->nominal_baku->HrefValue = "";

            // jumlahterima
            $this->jumlahterima->LinkCustomAttributes = "";
            $this->jumlahterima->HrefValue = "";

            // tunjangan_wkosis
            $this->tunjangan_wkosis->LinkCustomAttributes = "";
            $this->tunjangan_wkosis->HrefValue = "";

            // potongan1
            $this->potongan1->LinkCustomAttributes = "";
            $this->potongan1->HrefValue = "";

            // potongan2
            $this->potongan2->LinkCustomAttributes = "";
            $this->potongan2->HrefValue = "";

            // jumlahgaji
            $this->jumlahgaji->LinkCustomAttributes = "";
            $this->jumlahgaji->HrefValue = "";

            // jumgajitotal
            $this->jumgajitotal->LinkCustomAttributes = "";
            $this->jumgajitotal->HrefValue = "";
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
        if ($this->pid->Required) {
            if (!$this->pid->IsDetailKey && EmptyValue($this->pid->FormValue)) {
                $this->pid->addErrorMessage(str_replace("%s", $this->pid->caption(), $this->pid->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pid->FormValue)) {
            $this->pid->addErrorMessage($this->pid->getErrorMessage(false));
        }
        if ($this->pegawai_id->Required) {
            if (!$this->pegawai_id->IsDetailKey && EmptyValue($this->pegawai_id->FormValue)) {
                $this->pegawai_id->addErrorMessage(str_replace("%s", $this->pegawai_id->caption(), $this->pegawai_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pegawai_id->FormValue)) {
            $this->pegawai_id->addErrorMessage($this->pegawai_id->getErrorMessage(false));
        }
        if ($this->jabatan_id->Required) {
            if (!$this->jabatan_id->IsDetailKey && EmptyValue($this->jabatan_id->FormValue)) {
                $this->jabatan_id->addErrorMessage(str_replace("%s", $this->jabatan_id->caption(), $this->jabatan_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jabatan_id->FormValue)) {
            $this->jabatan_id->addErrorMessage($this->jabatan_id->getErrorMessage(false));
        }
        if ($this->masakerja->Required) {
            if (!$this->masakerja->IsDetailKey && EmptyValue($this->masakerja->FormValue)) {
                $this->masakerja->addErrorMessage(str_replace("%s", $this->masakerja->caption(), $this->masakerja->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->masakerja->FormValue)) {
            $this->masakerja->addErrorMessage($this->masakerja->getErrorMessage(false));
        }
        if ($this->jumngajar->Required) {
            if (!$this->jumngajar->IsDetailKey && EmptyValue($this->jumngajar->FormValue)) {
                $this->jumngajar->addErrorMessage(str_replace("%s", $this->jumngajar->caption(), $this->jumngajar->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jumngajar->FormValue)) {
            $this->jumngajar->addErrorMessage($this->jumngajar->getErrorMessage(false));
        }
        if ($this->ijin->Required) {
            if (!$this->ijin->IsDetailKey && EmptyValue($this->ijin->FormValue)) {
                $this->ijin->addErrorMessage(str_replace("%s", $this->ijin->caption(), $this->ijin->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->ijin->FormValue)) {
            $this->ijin->addErrorMessage($this->ijin->getErrorMessage(false));
        }
        if ($this->baku->Required) {
            if (!$this->baku->IsDetailKey && EmptyValue($this->baku->FormValue)) {
                $this->baku->addErrorMessage(str_replace("%s", $this->baku->caption(), $this->baku->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->baku->FormValue)) {
            $this->baku->addErrorMessage($this->baku->getErrorMessage(false));
        }
        if ($this->kehadiran->Required) {
            if (!$this->kehadiran->IsDetailKey && EmptyValue($this->kehadiran->FormValue)) {
                $this->kehadiran->addErrorMessage(str_replace("%s", $this->kehadiran->caption(), $this->kehadiran->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->kehadiran->FormValue)) {
            $this->kehadiran->addErrorMessage($this->kehadiran->getErrorMessage(false));
        }
        if ($this->prestasi->Required) {
            if (!$this->prestasi->IsDetailKey && EmptyValue($this->prestasi->FormValue)) {
                $this->prestasi->addErrorMessage(str_replace("%s", $this->prestasi->caption(), $this->prestasi->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->prestasi->FormValue)) {
            $this->prestasi->addErrorMessage($this->prestasi->getErrorMessage(false));
        }
        if ($this->nominal_baku->Required) {
            if (!$this->nominal_baku->IsDetailKey && EmptyValue($this->nominal_baku->FormValue)) {
                $this->nominal_baku->addErrorMessage(str_replace("%s", $this->nominal_baku->caption(), $this->nominal_baku->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->nominal_baku->FormValue)) {
            $this->nominal_baku->addErrorMessage($this->nominal_baku->getErrorMessage(false));
        }
        if ($this->jumlahterima->Required) {
            if (!$this->jumlahterima->IsDetailKey && EmptyValue($this->jumlahterima->FormValue)) {
                $this->jumlahterima->addErrorMessage(str_replace("%s", $this->jumlahterima->caption(), $this->jumlahterima->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jumlahterima->FormValue)) {
            $this->jumlahterima->addErrorMessage($this->jumlahterima->getErrorMessage(false));
        }
        if ($this->tunjangan_wkosis->Required) {
            if (!$this->tunjangan_wkosis->IsDetailKey && EmptyValue($this->tunjangan_wkosis->FormValue)) {
                $this->tunjangan_wkosis->addErrorMessage(str_replace("%s", $this->tunjangan_wkosis->caption(), $this->tunjangan_wkosis->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->tunjangan_wkosis->FormValue)) {
            $this->tunjangan_wkosis->addErrorMessage($this->tunjangan_wkosis->getErrorMessage(false));
        }
        if ($this->potongan1->Required) {
            if (!$this->potongan1->IsDetailKey && EmptyValue($this->potongan1->FormValue)) {
                $this->potongan1->addErrorMessage(str_replace("%s", $this->potongan1->caption(), $this->potongan1->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->potongan1->FormValue)) {
            $this->potongan1->addErrorMessage($this->potongan1->getErrorMessage(false));
        }
        if ($this->potongan2->Required) {
            if (!$this->potongan2->IsDetailKey && EmptyValue($this->potongan2->FormValue)) {
                $this->potongan2->addErrorMessage(str_replace("%s", $this->potongan2->caption(), $this->potongan2->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->potongan2->FormValue)) {
            $this->potongan2->addErrorMessage($this->potongan2->getErrorMessage(false));
        }
        if ($this->jumlahgaji->Required) {
            if (!$this->jumlahgaji->IsDetailKey && EmptyValue($this->jumlahgaji->FormValue)) {
                $this->jumlahgaji->addErrorMessage(str_replace("%s", $this->jumlahgaji->caption(), $this->jumlahgaji->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jumlahgaji->FormValue)) {
            $this->jumlahgaji->addErrorMessage($this->jumlahgaji->getErrorMessage(false));
        }
        if ($this->jumgajitotal->Required) {
            if (!$this->jumgajitotal->IsDetailKey && EmptyValue($this->jumgajitotal->FormValue)) {
                $this->jumgajitotal->addErrorMessage(str_replace("%s", $this->jumgajitotal->caption(), $this->jumgajitotal->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jumgajitotal->FormValue)) {
            $this->jumgajitotal->addErrorMessage($this->jumgajitotal->getErrorMessage(false));
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set new row
        $rsnew = [];

        // pid
        $this->pid->setDbValueDef($rsnew, $this->pid->CurrentValue, null, false);

        // pegawai_id
        $this->pegawai_id->setDbValueDef($rsnew, $this->pegawai_id->CurrentValue, null, false);

        // jabatan_id
        $this->jabatan_id->setDbValueDef($rsnew, $this->jabatan_id->CurrentValue, null, false);

        // masakerja
        $this->masakerja->setDbValueDef($rsnew, $this->masakerja->CurrentValue, null, false);

        // jumngajar
        $this->jumngajar->setDbValueDef($rsnew, $this->jumngajar->CurrentValue, null, false);

        // ijin
        $this->ijin->setDbValueDef($rsnew, $this->ijin->CurrentValue, null, false);

        // baku
        $this->baku->setDbValueDef($rsnew, $this->baku->CurrentValue, null, false);

        // kehadiran
        $this->kehadiran->setDbValueDef($rsnew, $this->kehadiran->CurrentValue, null, false);

        // prestasi
        $this->prestasi->setDbValueDef($rsnew, $this->prestasi->CurrentValue, null, false);

        // nominal_baku
        $this->nominal_baku->setDbValueDef($rsnew, $this->nominal_baku->CurrentValue, null, false);

        // jumlahterima
        $this->jumlahterima->setDbValueDef($rsnew, $this->jumlahterima->CurrentValue, null, false);

        // tunjangan_wkosis
        $this->tunjangan_wkosis->setDbValueDef($rsnew, $this->tunjangan_wkosis->CurrentValue, null, false);

        // potongan1
        $this->potongan1->setDbValueDef($rsnew, $this->potongan1->CurrentValue, null, false);

        // potongan2
        $this->potongan2->setDbValueDef($rsnew, $this->potongan2->CurrentValue, null, false);

        // jumlahgaji
        $this->jumlahgaji->setDbValueDef($rsnew, $this->jumlahgaji->CurrentValue, null, false);

        // jumgajitotal
        $this->jumgajitotal->setDbValueDef($rsnew, $this->jumgajitotal->CurrentValue, null, false);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check referential integrity for master table 'gajisd_detil'
        $validMasterRecord = true;
        $detailKeys = [];
        $detailKeys["pid"] = $this->pid->CurrentValue;
        $masterTable = Container("gajisd");
        $masterFilter = $this->getMasterFilter($masterTable, $detailKeys);
        if (!EmptyValue($masterFilter)) {
            $rsmaster = $masterTable->loadRs($masterFilter)->fetch();
            $validMasterRecord = $rsmaster !== false;
        } else { // Allow null value if not required field
            $validMasterRecord = $masterFilter === null;
        }
        if (!$validMasterRecord) {
            $relatedRecordMsg = str_replace("%t", "gajisd", $Language->phrase("RelatedRecordRequired"));
            $this->setFailureMessage($relatedRecordMsg);
            return false;
        }
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up master/detail based on QueryString
    protected function setupMasterParms()
    {
        $validMaster = false;
        // Get the keys for master table
        if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                $validMaster = true;
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "gajisd") {
                $validMaster = true;
                $masterTbl = Container("gajisd");
                if (($parm = Get("fk_id", Get("pid"))) !== null) {
                    $masterTbl->id->setQueryStringValue($parm);
                    $this->pid->setQueryStringValue($masterTbl->id->QueryStringValue);
                    $this->pid->setSessionValue($this->pid->QueryStringValue);
                    if (!is_numeric($masterTbl->id->QueryStringValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
        } elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                    $validMaster = true;
                    $this->DbMasterFilter = "";
                    $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "gajisd") {
                $validMaster = true;
                $masterTbl = Container("gajisd");
                if (($parm = Post("fk_id", Post("pid"))) !== null) {
                    $masterTbl->id->setFormValue($parm);
                    $this->pid->setFormValue($masterTbl->id->FormValue);
                    $this->pid->setSessionValue($this->pid->FormValue);
                    if (!is_numeric($masterTbl->id->FormValue)) {
                        $validMaster = false;
                    }
                } else {
                    $validMaster = false;
                }
            }
        }
        if ($validMaster) {
            // Save current master table
            $this->setCurrentMasterTable($masterTblVar);

            // Reset start record counter (new master key)
            if (!$this->isAddOrEdit()) {
                $this->StartRecord = 1;
                $this->setStartRecordNumber($this->StartRecord);
            }

            // Clear previous master key from Session
            if ($masterTblVar != "gajisd") {
                if ($this->pid->CurrentValue == "") {
                    $this->pid->setSessionValue("");
                }
            }
        }
        $this->DbMasterFilter = $this->getMasterFilterFromSession(); // Get master filter from session
        $this->DbDetailFilter = $this->getDetailFilterFromSession(); // Get detail filter from session
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("GajisdDetilList"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
                case "x_pegawai_id":
                    break;
                case "x_jabatan_id":
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
