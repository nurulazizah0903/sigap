<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class AbsenDetilAdd extends AbsenDetil
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'absen_detil';

    // Page object name
    public $PageObjName = "AbsenDetilAdd";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Audit Trail
    public $AuditTrailOnAdd = true;
    public $AuditTrailOnEdit = true;
    public $AuditTrailOnDelete = true;
    public $AuditTrailOnView = false;
    public $AuditTrailOnViewData = false;
    public $AuditTrailOnSearch = false;

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

        // Table object (absen_detil)
        if (!isset($GLOBALS["absen_detil"]) || get_class($GLOBALS["absen_detil"]) == PROJECT_NAMESPACE . "absen_detil") {
            $GLOBALS["absen_detil"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'absen_detil');
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
                $tbl = Container("absen_detil");
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
                    if ($pageName == "AbsenDetilView") {
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
        $this->pegawai->setVisibility();
        $this->masuk->setVisibility();
        $this->absen->setVisibility();
        $this->ijin->setVisibility();
        $this->cuti->setVisibility();
        $this->dinas_luar->setVisibility();
        $this->terlambat->setVisibility();
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
                    $this->terminate("AbsenDetilList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "AbsenDetilList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "AbsenDetilView") {
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

        // Check field name 'pegawai' first before field var 'x_pegawai'
        $val = $CurrentForm->hasValue("pegawai") ? $CurrentForm->getValue("pegawai") : $CurrentForm->getValue("x_pegawai");
        if (!$this->pegawai->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pegawai->Visible = false; // Disable update for API request
            } else {
                $this->pegawai->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'masuk' first before field var 'x_masuk'
        $val = $CurrentForm->hasValue("masuk") ? $CurrentForm->getValue("masuk") : $CurrentForm->getValue("x_masuk");
        if (!$this->masuk->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->masuk->Visible = false; // Disable update for API request
            } else {
                $this->masuk->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'absen' first before field var 'x_absen'
        $val = $CurrentForm->hasValue("absen") ? $CurrentForm->getValue("absen") : $CurrentForm->getValue("x_absen");
        if (!$this->absen->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->absen->Visible = false; // Disable update for API request
            } else {
                $this->absen->setFormValue($val, true, $validate);
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

        // Check field name 'cuti' first before field var 'x_cuti'
        $val = $CurrentForm->hasValue("cuti") ? $CurrentForm->getValue("cuti") : $CurrentForm->getValue("x_cuti");
        if (!$this->cuti->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->cuti->Visible = false; // Disable update for API request
            } else {
                $this->cuti->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'dinas_luar' first before field var 'x_dinas_luar'
        $val = $CurrentForm->hasValue("dinas_luar") ? $CurrentForm->getValue("dinas_luar") : $CurrentForm->getValue("x_dinas_luar");
        if (!$this->dinas_luar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->dinas_luar->Visible = false; // Disable update for API request
            } else {
                $this->dinas_luar->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'terlambat' first before field var 'x_terlambat'
        $val = $CurrentForm->hasValue("terlambat") ? $CurrentForm->getValue("terlambat") : $CurrentForm->getValue("x_terlambat");
        if (!$this->terlambat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->terlambat->Visible = false; // Disable update for API request
            } else {
                $this->terlambat->setFormValue($val, true, $validate);
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
        $this->pegawai->CurrentValue = $this->pegawai->FormValue;
        $this->masuk->CurrentValue = $this->masuk->FormValue;
        $this->absen->CurrentValue = $this->absen->FormValue;
        $this->ijin->CurrentValue = $this->ijin->FormValue;
        $this->cuti->CurrentValue = $this->cuti->FormValue;
        $this->dinas_luar->CurrentValue = $this->dinas_luar->FormValue;
        $this->terlambat->CurrentValue = $this->terlambat->FormValue;
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
        $this->pegawai->setDbValue($row['pegawai']);
        $this->masuk->setDbValue($row['masuk']);
        $this->absen->setDbValue($row['absen']);
        $this->ijin->setDbValue($row['ijin']);
        $this->cuti->setDbValue($row['cuti']);
        $this->dinas_luar->setDbValue($row['dinas_luar']);
        $this->terlambat->setDbValue($row['terlambat']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['pid'] = $this->pid->DefaultValue;
        $row['pegawai'] = $this->pegawai->DefaultValue;
        $row['masuk'] = $this->masuk->DefaultValue;
        $row['absen'] = $this->absen->DefaultValue;
        $row['ijin'] = $this->ijin->DefaultValue;
        $row['cuti'] = $this->cuti->DefaultValue;
        $row['dinas_luar'] = $this->dinas_luar->DefaultValue;
        $row['terlambat'] = $this->terlambat->DefaultValue;
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

        // pegawai
        $this->pegawai->RowCssClass = "row";

        // masuk
        $this->masuk->RowCssClass = "row";

        // absen
        $this->absen->RowCssClass = "row";

        // ijin
        $this->ijin->RowCssClass = "row";

        // cuti
        $this->cuti->RowCssClass = "row";

        // dinas_luar
        $this->dinas_luar->RowCssClass = "row";

        // terlambat
        $this->terlambat->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // pid
            $this->pid->ViewValue = $this->pid->CurrentValue;
            $this->pid->ViewValue = FormatNumber($this->pid->ViewValue, $this->pid->formatPattern());
            $this->pid->ViewCustomAttributes = "";

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

            // masuk
            $this->masuk->ViewValue = $this->masuk->CurrentValue;
            $this->masuk->ViewValue = FormatNumber($this->masuk->ViewValue, $this->masuk->formatPattern());
            $this->masuk->ViewCustomAttributes = "";

            // absen
            $this->absen->ViewValue = $this->absen->CurrentValue;
            $this->absen->ViewValue = FormatNumber($this->absen->ViewValue, $this->absen->formatPattern());
            $this->absen->ViewCustomAttributes = "";

            // ijin
            $this->ijin->ViewValue = $this->ijin->CurrentValue;
            $this->ijin->ViewValue = FormatNumber($this->ijin->ViewValue, $this->ijin->formatPattern());
            $this->ijin->ViewCustomAttributes = "";

            // cuti
            $this->cuti->ViewValue = $this->cuti->CurrentValue;
            $this->cuti->ViewValue = FormatNumber($this->cuti->ViewValue, $this->cuti->formatPattern());
            $this->cuti->ViewCustomAttributes = "";

            // dinas_luar
            $this->dinas_luar->ViewValue = $this->dinas_luar->CurrentValue;
            $this->dinas_luar->ViewValue = FormatNumber($this->dinas_luar->ViewValue, $this->dinas_luar->formatPattern());
            $this->dinas_luar->ViewCustomAttributes = "";

            // terlambat
            $this->terlambat->ViewValue = $this->terlambat->CurrentValue;
            $this->terlambat->ViewValue = FormatNumber($this->terlambat->ViewValue, $this->terlambat->formatPattern());
            $this->terlambat->ViewCustomAttributes = "";

            // pid
            $this->pid->LinkCustomAttributes = "";
            $this->pid->HrefValue = "";

            // pegawai
            $this->pegawai->LinkCustomAttributes = "";
            $this->pegawai->HrefValue = "";

            // masuk
            $this->masuk->LinkCustomAttributes = "";
            $this->masuk->HrefValue = "";

            // absen
            $this->absen->LinkCustomAttributes = "";
            $this->absen->HrefValue = "";

            // ijin
            $this->ijin->LinkCustomAttributes = "";
            $this->ijin->HrefValue = "";

            // cuti
            $this->cuti->LinkCustomAttributes = "";
            $this->cuti->HrefValue = "";

            // dinas_luar
            $this->dinas_luar->LinkCustomAttributes = "";
            $this->dinas_luar->HrefValue = "";

            // terlambat
            $this->terlambat->LinkCustomAttributes = "";
            $this->terlambat->HrefValue = "";
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

            // masuk
            $this->masuk->setupEditAttributes();
            $this->masuk->EditCustomAttributes = "";
            $this->masuk->EditValue = HtmlEncode($this->masuk->CurrentValue);
            $this->masuk->PlaceHolder = RemoveHtml($this->masuk->caption());
            if (strval($this->masuk->EditValue) != "" && is_numeric($this->masuk->EditValue)) {
                $this->masuk->EditValue = FormatNumber($this->masuk->EditValue, null);
            }

            // absen
            $this->absen->setupEditAttributes();
            $this->absen->EditCustomAttributes = "";
            $this->absen->EditValue = HtmlEncode($this->absen->CurrentValue);
            $this->absen->PlaceHolder = RemoveHtml($this->absen->caption());
            if (strval($this->absen->EditValue) != "" && is_numeric($this->absen->EditValue)) {
                $this->absen->EditValue = FormatNumber($this->absen->EditValue, null);
            }

            // ijin
            $this->ijin->setupEditAttributes();
            $this->ijin->EditCustomAttributes = "";
            $this->ijin->EditValue = HtmlEncode($this->ijin->CurrentValue);
            $this->ijin->PlaceHolder = RemoveHtml($this->ijin->caption());
            if (strval($this->ijin->EditValue) != "" && is_numeric($this->ijin->EditValue)) {
                $this->ijin->EditValue = FormatNumber($this->ijin->EditValue, null);
            }

            // cuti
            $this->cuti->setupEditAttributes();
            $this->cuti->EditCustomAttributes = "";
            $this->cuti->EditValue = HtmlEncode($this->cuti->CurrentValue);
            $this->cuti->PlaceHolder = RemoveHtml($this->cuti->caption());
            if (strval($this->cuti->EditValue) != "" && is_numeric($this->cuti->EditValue)) {
                $this->cuti->EditValue = FormatNumber($this->cuti->EditValue, null);
            }

            // dinas_luar
            $this->dinas_luar->setupEditAttributes();
            $this->dinas_luar->EditCustomAttributes = "";
            $this->dinas_luar->EditValue = HtmlEncode($this->dinas_luar->CurrentValue);
            $this->dinas_luar->PlaceHolder = RemoveHtml($this->dinas_luar->caption());
            if (strval($this->dinas_luar->EditValue) != "" && is_numeric($this->dinas_luar->EditValue)) {
                $this->dinas_luar->EditValue = FormatNumber($this->dinas_luar->EditValue, null);
            }

            // terlambat
            $this->terlambat->setupEditAttributes();
            $this->terlambat->EditCustomAttributes = "";
            $this->terlambat->EditValue = HtmlEncode($this->terlambat->CurrentValue);
            $this->terlambat->PlaceHolder = RemoveHtml($this->terlambat->caption());
            if (strval($this->terlambat->EditValue) != "" && is_numeric($this->terlambat->EditValue)) {
                $this->terlambat->EditValue = FormatNumber($this->terlambat->EditValue, null);
            }

            // Add refer script

            // pid
            $this->pid->LinkCustomAttributes = "";
            $this->pid->HrefValue = "";

            // pegawai
            $this->pegawai->LinkCustomAttributes = "";
            $this->pegawai->HrefValue = "";

            // masuk
            $this->masuk->LinkCustomAttributes = "";
            $this->masuk->HrefValue = "";

            // absen
            $this->absen->LinkCustomAttributes = "";
            $this->absen->HrefValue = "";

            // ijin
            $this->ijin->LinkCustomAttributes = "";
            $this->ijin->HrefValue = "";

            // cuti
            $this->cuti->LinkCustomAttributes = "";
            $this->cuti->HrefValue = "";

            // dinas_luar
            $this->dinas_luar->LinkCustomAttributes = "";
            $this->dinas_luar->HrefValue = "";

            // terlambat
            $this->terlambat->LinkCustomAttributes = "";
            $this->terlambat->HrefValue = "";
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
        if ($this->pegawai->Required) {
            if (!$this->pegawai->IsDetailKey && EmptyValue($this->pegawai->FormValue)) {
                $this->pegawai->addErrorMessage(str_replace("%s", $this->pegawai->caption(), $this->pegawai->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pegawai->FormValue)) {
            $this->pegawai->addErrorMessage($this->pegawai->getErrorMessage(false));
        }
        if ($this->masuk->Required) {
            if (!$this->masuk->IsDetailKey && EmptyValue($this->masuk->FormValue)) {
                $this->masuk->addErrorMessage(str_replace("%s", $this->masuk->caption(), $this->masuk->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->masuk->FormValue)) {
            $this->masuk->addErrorMessage($this->masuk->getErrorMessage(false));
        }
        if ($this->absen->Required) {
            if (!$this->absen->IsDetailKey && EmptyValue($this->absen->FormValue)) {
                $this->absen->addErrorMessage(str_replace("%s", $this->absen->caption(), $this->absen->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->absen->FormValue)) {
            $this->absen->addErrorMessage($this->absen->getErrorMessage(false));
        }
        if ($this->ijin->Required) {
            if (!$this->ijin->IsDetailKey && EmptyValue($this->ijin->FormValue)) {
                $this->ijin->addErrorMessage(str_replace("%s", $this->ijin->caption(), $this->ijin->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->ijin->FormValue)) {
            $this->ijin->addErrorMessage($this->ijin->getErrorMessage(false));
        }
        if ($this->cuti->Required) {
            if (!$this->cuti->IsDetailKey && EmptyValue($this->cuti->FormValue)) {
                $this->cuti->addErrorMessage(str_replace("%s", $this->cuti->caption(), $this->cuti->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->cuti->FormValue)) {
            $this->cuti->addErrorMessage($this->cuti->getErrorMessage(false));
        }
        if ($this->dinas_luar->Required) {
            if (!$this->dinas_luar->IsDetailKey && EmptyValue($this->dinas_luar->FormValue)) {
                $this->dinas_luar->addErrorMessage(str_replace("%s", $this->dinas_luar->caption(), $this->dinas_luar->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->dinas_luar->FormValue)) {
            $this->dinas_luar->addErrorMessage($this->dinas_luar->getErrorMessage(false));
        }
        if ($this->terlambat->Required) {
            if (!$this->terlambat->IsDetailKey && EmptyValue($this->terlambat->FormValue)) {
                $this->terlambat->addErrorMessage(str_replace("%s", $this->terlambat->caption(), $this->terlambat->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->terlambat->FormValue)) {
            $this->terlambat->addErrorMessage($this->terlambat->getErrorMessage(false));
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

        // pegawai
        $this->pegawai->setDbValueDef($rsnew, $this->pegawai->CurrentValue, null, false);

        // masuk
        $this->masuk->setDbValueDef($rsnew, $this->masuk->CurrentValue, null, false);

        // absen
        $this->absen->setDbValueDef($rsnew, $this->absen->CurrentValue, null, false);

        // ijin
        $this->ijin->setDbValueDef($rsnew, $this->ijin->CurrentValue, null, false);

        // cuti
        $this->cuti->setDbValueDef($rsnew, $this->cuti->CurrentValue, null, false);

        // dinas_luar
        $this->dinas_luar->setDbValueDef($rsnew, $this->dinas_luar->CurrentValue, null, false);

        // terlambat
        $this->terlambat->setDbValueDef($rsnew, $this->terlambat->CurrentValue, null, false);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check referential integrity for master table 'absen_detil'
        $validMasterRecord = true;
        $detailKeys = [];
        $detailKeys["pid"] = $this->pid->CurrentValue;
        $masterTable = Container("absen");
        $masterFilter = $this->getMasterFilter($masterTable, $detailKeys);
        if (!EmptyValue($masterFilter)) {
            $rsmaster = $masterTable->loadRs($masterFilter)->fetch();
            $validMasterRecord = $rsmaster !== false;
        } else { // Allow null value if not required field
            $validMasterRecord = $masterFilter === null;
        }
        if (!$validMasterRecord) {
            $relatedRecordMsg = str_replace("%t", "absen", $Language->phrase("RelatedRecordRequired"));
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
            if ($masterTblVar == "absen") {
                $validMaster = true;
                $masterTbl = Container("absen");
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
            if ($masterTblVar == "absen") {
                $validMaster = true;
                $masterTbl = Container("absen");
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
            if ($masterTblVar != "absen") {
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("AbsenDetilList"), "", $this->TableVar, true);
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
                case "x_pegawai":
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
