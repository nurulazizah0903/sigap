<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class GajitunjanganAdd extends Gajitunjangan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'gajitunjangan';

    // Page object name
    public $PageObjName = "GajitunjanganAdd";

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

        // Table object (gajitunjangan)
        if (!isset($GLOBALS["gajitunjangan"]) || get_class($GLOBALS["gajitunjangan"]) == PROJECT_NAMESPACE . "gajitunjangan") {
            $GLOBALS["gajitunjangan"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'gajitunjangan');
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
                $tbl = Container("gajitunjangan");
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
                    if ($pageName == "GajitunjanganView") {
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
        $this->pidjabatan->Visible = false;
        $this->gapok->setVisibility();
        $this->value_kehadiran->setVisibility();
        $this->tunjangan_jabatan->setVisibility();
        $this->tunjangan_khusus->setVisibility();
        $this->reward->setVisibility();
        $this->lembur->setVisibility();
        $this->piket->setVisibility();
        $this->inval->setVisibility();
        $this->jam_lebih->setVisibility();
        $this->ekstrakuri->setVisibility();
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
                    $this->terminate("GajitunjanganList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "GajitunjanganList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "GajitunjanganView") {
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

        // Check field name 'gapok' first before field var 'x_gapok'
        $val = $CurrentForm->hasValue("gapok") ? $CurrentForm->getValue("gapok") : $CurrentForm->getValue("x_gapok");
        if (!$this->gapok->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gapok->Visible = false; // Disable update for API request
            } else {
                $this->gapok->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'value_kehadiran' first before field var 'x_value_kehadiran'
        $val = $CurrentForm->hasValue("value_kehadiran") ? $CurrentForm->getValue("value_kehadiran") : $CurrentForm->getValue("x_value_kehadiran");
        if (!$this->value_kehadiran->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->value_kehadiran->Visible = false; // Disable update for API request
            } else {
                $this->value_kehadiran->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'tunjangan_jabatan' first before field var 'x_tunjangan_jabatan'
        $val = $CurrentForm->hasValue("tunjangan_jabatan") ? $CurrentForm->getValue("tunjangan_jabatan") : $CurrentForm->getValue("x_tunjangan_jabatan");
        if (!$this->tunjangan_jabatan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tunjangan_jabatan->Visible = false; // Disable update for API request
            } else {
                $this->tunjangan_jabatan->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'tunjangan_khusus' first before field var 'x_tunjangan_khusus'
        $val = $CurrentForm->hasValue("tunjangan_khusus") ? $CurrentForm->getValue("tunjangan_khusus") : $CurrentForm->getValue("x_tunjangan_khusus");
        if (!$this->tunjangan_khusus->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tunjangan_khusus->Visible = false; // Disable update for API request
            } else {
                $this->tunjangan_khusus->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'reward' first before field var 'x_reward'
        $val = $CurrentForm->hasValue("reward") ? $CurrentForm->getValue("reward") : $CurrentForm->getValue("x_reward");
        if (!$this->reward->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->reward->Visible = false; // Disable update for API request
            } else {
                $this->reward->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'lembur' first before field var 'x_lembur'
        $val = $CurrentForm->hasValue("lembur") ? $CurrentForm->getValue("lembur") : $CurrentForm->getValue("x_lembur");
        if (!$this->lembur->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->lembur->Visible = false; // Disable update for API request
            } else {
                $this->lembur->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'piket' first before field var 'x_piket'
        $val = $CurrentForm->hasValue("piket") ? $CurrentForm->getValue("piket") : $CurrentForm->getValue("x_piket");
        if (!$this->piket->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->piket->Visible = false; // Disable update for API request
            } else {
                $this->piket->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'inval' first before field var 'x_inval'
        $val = $CurrentForm->hasValue("inval") ? $CurrentForm->getValue("inval") : $CurrentForm->getValue("x_inval");
        if (!$this->inval->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->inval->Visible = false; // Disable update for API request
            } else {
                $this->inval->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'jam_lebih' first before field var 'x_jam_lebih'
        $val = $CurrentForm->hasValue("jam_lebih") ? $CurrentForm->getValue("jam_lebih") : $CurrentForm->getValue("x_jam_lebih");
        if (!$this->jam_lebih->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jam_lebih->Visible = false; // Disable update for API request
            } else {
                $this->jam_lebih->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'ekstrakuri' first before field var 'x_ekstrakuri'
        $val = $CurrentForm->hasValue("ekstrakuri") ? $CurrentForm->getValue("ekstrakuri") : $CurrentForm->getValue("x_ekstrakuri");
        if (!$this->ekstrakuri->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ekstrakuri->Visible = false; // Disable update for API request
            } else {
                $this->ekstrakuri->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->gapok->CurrentValue = $this->gapok->FormValue;
        $this->value_kehadiran->CurrentValue = $this->value_kehadiran->FormValue;
        $this->tunjangan_jabatan->CurrentValue = $this->tunjangan_jabatan->FormValue;
        $this->tunjangan_khusus->CurrentValue = $this->tunjangan_khusus->FormValue;
        $this->reward->CurrentValue = $this->reward->FormValue;
        $this->lembur->CurrentValue = $this->lembur->FormValue;
        $this->piket->CurrentValue = $this->piket->FormValue;
        $this->inval->CurrentValue = $this->inval->FormValue;
        $this->jam_lebih->CurrentValue = $this->jam_lebih->FormValue;
        $this->ekstrakuri->CurrentValue = $this->ekstrakuri->FormValue;
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
        $this->pidjabatan->setDbValue($row['pidjabatan']);
        $this->gapok->setDbValue($row['gapok']);
        $this->value_kehadiran->setDbValue($row['value_kehadiran']);
        $this->tunjangan_jabatan->setDbValue($row['tunjangan_jabatan']);
        $this->tunjangan_khusus->setDbValue($row['tunjangan_khusus']);
        $this->reward->setDbValue($row['reward']);
        $this->lembur->setDbValue($row['lembur']);
        $this->piket->setDbValue($row['piket']);
        $this->inval->setDbValue($row['inval']);
        $this->jam_lebih->setDbValue($row['jam_lebih']);
        $this->ekstrakuri->setDbValue($row['ekstrakuri']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['pidjabatan'] = $this->pidjabatan->DefaultValue;
        $row['gapok'] = $this->gapok->DefaultValue;
        $row['value_kehadiran'] = $this->value_kehadiran->DefaultValue;
        $row['tunjangan_jabatan'] = $this->tunjangan_jabatan->DefaultValue;
        $row['tunjangan_khusus'] = $this->tunjangan_khusus->DefaultValue;
        $row['reward'] = $this->reward->DefaultValue;
        $row['lembur'] = $this->lembur->DefaultValue;
        $row['piket'] = $this->piket->DefaultValue;
        $row['inval'] = $this->inval->DefaultValue;
        $row['jam_lebih'] = $this->jam_lebih->DefaultValue;
        $row['ekstrakuri'] = $this->ekstrakuri->DefaultValue;
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

        // pidjabatan
        $this->pidjabatan->RowCssClass = "row";

        // gapok
        $this->gapok->RowCssClass = "row";

        // value_kehadiran
        $this->value_kehadiran->RowCssClass = "row";

        // tunjangan_jabatan
        $this->tunjangan_jabatan->RowCssClass = "row";

        // tunjangan_khusus
        $this->tunjangan_khusus->RowCssClass = "row";

        // reward
        $this->reward->RowCssClass = "row";

        // lembur
        $this->lembur->RowCssClass = "row";

        // piket
        $this->piket->RowCssClass = "row";

        // inval
        $this->inval->RowCssClass = "row";

        // jam_lebih
        $this->jam_lebih->RowCssClass = "row";

        // ekstrakuri
        $this->ekstrakuri->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // pidjabatan
            $this->pidjabatan->ViewValue = $this->pidjabatan->CurrentValue;
            $this->pidjabatan->ViewValue = FormatNumber($this->pidjabatan->ViewValue, $this->pidjabatan->formatPattern());
            $this->pidjabatan->ViewCustomAttributes = "";

            // gapok
            $this->gapok->ViewValue = $this->gapok->CurrentValue;
            $this->gapok->ViewValue = FormatNumber($this->gapok->ViewValue, $this->gapok->formatPattern());
            $this->gapok->ViewCustomAttributes = "";

            // value_kehadiran
            $this->value_kehadiran->ViewValue = $this->value_kehadiran->CurrentValue;
            $this->value_kehadiran->ViewValue = FormatNumber($this->value_kehadiran->ViewValue, $this->value_kehadiran->formatPattern());
            $this->value_kehadiran->ViewCustomAttributes = "";

            // tunjangan_jabatan
            $this->tunjangan_jabatan->ViewValue = $this->tunjangan_jabatan->CurrentValue;
            $this->tunjangan_jabatan->ViewValue = FormatNumber($this->tunjangan_jabatan->ViewValue, $this->tunjangan_jabatan->formatPattern());
            $this->tunjangan_jabatan->ViewCustomAttributes = "";

            // tunjangan_khusus
            $this->tunjangan_khusus->ViewValue = $this->tunjangan_khusus->CurrentValue;
            $this->tunjangan_khusus->ViewValue = FormatNumber($this->tunjangan_khusus->ViewValue, $this->tunjangan_khusus->formatPattern());
            $this->tunjangan_khusus->ViewCustomAttributes = "";

            // reward
            $this->reward->ViewValue = $this->reward->CurrentValue;
            $this->reward->ViewValue = FormatNumber($this->reward->ViewValue, $this->reward->formatPattern());
            $this->reward->ViewCustomAttributes = "";

            // lembur
            $this->lembur->ViewValue = $this->lembur->CurrentValue;
            $this->lembur->ViewValue = FormatNumber($this->lembur->ViewValue, $this->lembur->formatPattern());
            $this->lembur->ViewCustomAttributes = "";

            // piket
            $this->piket->ViewValue = $this->piket->CurrentValue;
            $this->piket->ViewValue = FormatNumber($this->piket->ViewValue, $this->piket->formatPattern());
            $this->piket->ViewCustomAttributes = "";

            // inval
            $this->inval->ViewValue = $this->inval->CurrentValue;
            $this->inval->ViewValue = FormatNumber($this->inval->ViewValue, $this->inval->formatPattern());
            $this->inval->ViewCustomAttributes = "";

            // jam_lebih
            $this->jam_lebih->ViewValue = $this->jam_lebih->CurrentValue;
            $this->jam_lebih->ViewValue = FormatNumber($this->jam_lebih->ViewValue, $this->jam_lebih->formatPattern());
            $this->jam_lebih->ViewCustomAttributes = "";

            // ekstrakuri
            $this->ekstrakuri->ViewValue = $this->ekstrakuri->CurrentValue;
            $this->ekstrakuri->ViewValue = FormatNumber($this->ekstrakuri->ViewValue, $this->ekstrakuri->formatPattern());
            $this->ekstrakuri->ViewCustomAttributes = "";

            // gapok
            $this->gapok->LinkCustomAttributes = "";
            $this->gapok->HrefValue = "";

            // value_kehadiran
            $this->value_kehadiran->LinkCustomAttributes = "";
            $this->value_kehadiran->HrefValue = "";

            // tunjangan_jabatan
            $this->tunjangan_jabatan->LinkCustomAttributes = "";
            $this->tunjangan_jabatan->HrefValue = "";

            // tunjangan_khusus
            $this->tunjangan_khusus->LinkCustomAttributes = "";
            $this->tunjangan_khusus->HrefValue = "";

            // reward
            $this->reward->LinkCustomAttributes = "";
            $this->reward->HrefValue = "";

            // lembur
            $this->lembur->LinkCustomAttributes = "";
            $this->lembur->HrefValue = "";

            // piket
            $this->piket->LinkCustomAttributes = "";
            $this->piket->HrefValue = "";

            // inval
            $this->inval->LinkCustomAttributes = "";
            $this->inval->HrefValue = "";

            // jam_lebih
            $this->jam_lebih->LinkCustomAttributes = "";
            $this->jam_lebih->HrefValue = "";

            // ekstrakuri
            $this->ekstrakuri->LinkCustomAttributes = "";
            $this->ekstrakuri->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // gapok
            $this->gapok->setupEditAttributes();
            $this->gapok->EditCustomAttributes = "";
            $this->gapok->EditValue = HtmlEncode($this->gapok->CurrentValue);
            $this->gapok->PlaceHolder = RemoveHtml($this->gapok->caption());
            if (strval($this->gapok->EditValue) != "" && is_numeric($this->gapok->EditValue)) {
                $this->gapok->EditValue = FormatNumber($this->gapok->EditValue, null);
            }

            // value_kehadiran
            $this->value_kehadiran->setupEditAttributes();
            $this->value_kehadiran->EditCustomAttributes = "";
            $this->value_kehadiran->EditValue = HtmlEncode($this->value_kehadiran->CurrentValue);
            $this->value_kehadiran->PlaceHolder = RemoveHtml($this->value_kehadiran->caption());
            if (strval($this->value_kehadiran->EditValue) != "" && is_numeric($this->value_kehadiran->EditValue)) {
                $this->value_kehadiran->EditValue = FormatNumber($this->value_kehadiran->EditValue, null);
            }

            // tunjangan_jabatan
            $this->tunjangan_jabatan->setupEditAttributes();
            $this->tunjangan_jabatan->EditCustomAttributes = "";
            $this->tunjangan_jabatan->EditValue = HtmlEncode($this->tunjangan_jabatan->CurrentValue);
            $this->tunjangan_jabatan->PlaceHolder = RemoveHtml($this->tunjangan_jabatan->caption());
            if (strval($this->tunjangan_jabatan->EditValue) != "" && is_numeric($this->tunjangan_jabatan->EditValue)) {
                $this->tunjangan_jabatan->EditValue = FormatNumber($this->tunjangan_jabatan->EditValue, null);
            }

            // tunjangan_khusus
            $this->tunjangan_khusus->setupEditAttributes();
            $this->tunjangan_khusus->EditCustomAttributes = "";
            $this->tunjangan_khusus->EditValue = HtmlEncode($this->tunjangan_khusus->CurrentValue);
            $this->tunjangan_khusus->PlaceHolder = RemoveHtml($this->tunjangan_khusus->caption());
            if (strval($this->tunjangan_khusus->EditValue) != "" && is_numeric($this->tunjangan_khusus->EditValue)) {
                $this->tunjangan_khusus->EditValue = FormatNumber($this->tunjangan_khusus->EditValue, null);
            }

            // reward
            $this->reward->setupEditAttributes();
            $this->reward->EditCustomAttributes = "";
            $this->reward->EditValue = HtmlEncode($this->reward->CurrentValue);
            $this->reward->PlaceHolder = RemoveHtml($this->reward->caption());
            if (strval($this->reward->EditValue) != "" && is_numeric($this->reward->EditValue)) {
                $this->reward->EditValue = FormatNumber($this->reward->EditValue, null);
            }

            // lembur
            $this->lembur->setupEditAttributes();
            $this->lembur->EditCustomAttributes = "";
            $this->lembur->EditValue = HtmlEncode($this->lembur->CurrentValue);
            $this->lembur->PlaceHolder = RemoveHtml($this->lembur->caption());
            if (strval($this->lembur->EditValue) != "" && is_numeric($this->lembur->EditValue)) {
                $this->lembur->EditValue = FormatNumber($this->lembur->EditValue, null);
            }

            // piket
            $this->piket->setupEditAttributes();
            $this->piket->EditCustomAttributes = "";
            $this->piket->EditValue = HtmlEncode($this->piket->CurrentValue);
            $this->piket->PlaceHolder = RemoveHtml($this->piket->caption());
            if (strval($this->piket->EditValue) != "" && is_numeric($this->piket->EditValue)) {
                $this->piket->EditValue = FormatNumber($this->piket->EditValue, null);
            }

            // inval
            $this->inval->setupEditAttributes();
            $this->inval->EditCustomAttributes = "";
            $this->inval->EditValue = HtmlEncode($this->inval->CurrentValue);
            $this->inval->PlaceHolder = RemoveHtml($this->inval->caption());
            if (strval($this->inval->EditValue) != "" && is_numeric($this->inval->EditValue)) {
                $this->inval->EditValue = FormatNumber($this->inval->EditValue, null);
            }

            // jam_lebih
            $this->jam_lebih->setupEditAttributes();
            $this->jam_lebih->EditCustomAttributes = "";
            $this->jam_lebih->EditValue = HtmlEncode($this->jam_lebih->CurrentValue);
            $this->jam_lebih->PlaceHolder = RemoveHtml($this->jam_lebih->caption());
            if (strval($this->jam_lebih->EditValue) != "" && is_numeric($this->jam_lebih->EditValue)) {
                $this->jam_lebih->EditValue = FormatNumber($this->jam_lebih->EditValue, null);
            }

            // ekstrakuri
            $this->ekstrakuri->setupEditAttributes();
            $this->ekstrakuri->EditCustomAttributes = "";
            $this->ekstrakuri->EditValue = HtmlEncode($this->ekstrakuri->CurrentValue);
            $this->ekstrakuri->PlaceHolder = RemoveHtml($this->ekstrakuri->caption());
            if (strval($this->ekstrakuri->EditValue) != "" && is_numeric($this->ekstrakuri->EditValue)) {
                $this->ekstrakuri->EditValue = FormatNumber($this->ekstrakuri->EditValue, null);
            }

            // Add refer script

            // gapok
            $this->gapok->LinkCustomAttributes = "";
            $this->gapok->HrefValue = "";

            // value_kehadiran
            $this->value_kehadiran->LinkCustomAttributes = "";
            $this->value_kehadiran->HrefValue = "";

            // tunjangan_jabatan
            $this->tunjangan_jabatan->LinkCustomAttributes = "";
            $this->tunjangan_jabatan->HrefValue = "";

            // tunjangan_khusus
            $this->tunjangan_khusus->LinkCustomAttributes = "";
            $this->tunjangan_khusus->HrefValue = "";

            // reward
            $this->reward->LinkCustomAttributes = "";
            $this->reward->HrefValue = "";

            // lembur
            $this->lembur->LinkCustomAttributes = "";
            $this->lembur->HrefValue = "";

            // piket
            $this->piket->LinkCustomAttributes = "";
            $this->piket->HrefValue = "";

            // inval
            $this->inval->LinkCustomAttributes = "";
            $this->inval->HrefValue = "";

            // jam_lebih
            $this->jam_lebih->LinkCustomAttributes = "";
            $this->jam_lebih->HrefValue = "";

            // ekstrakuri
            $this->ekstrakuri->LinkCustomAttributes = "";
            $this->ekstrakuri->HrefValue = "";
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
        if ($this->gapok->Required) {
            if (!$this->gapok->IsDetailKey && EmptyValue($this->gapok->FormValue)) {
                $this->gapok->addErrorMessage(str_replace("%s", $this->gapok->caption(), $this->gapok->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->gapok->FormValue)) {
            $this->gapok->addErrorMessage($this->gapok->getErrorMessage(false));
        }
        if ($this->value_kehadiran->Required) {
            if (!$this->value_kehadiran->IsDetailKey && EmptyValue($this->value_kehadiran->FormValue)) {
                $this->value_kehadiran->addErrorMessage(str_replace("%s", $this->value_kehadiran->caption(), $this->value_kehadiran->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->value_kehadiran->FormValue)) {
            $this->value_kehadiran->addErrorMessage($this->value_kehadiran->getErrorMessage(false));
        }
        if ($this->tunjangan_jabatan->Required) {
            if (!$this->tunjangan_jabatan->IsDetailKey && EmptyValue($this->tunjangan_jabatan->FormValue)) {
                $this->tunjangan_jabatan->addErrorMessage(str_replace("%s", $this->tunjangan_jabatan->caption(), $this->tunjangan_jabatan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->tunjangan_jabatan->FormValue)) {
            $this->tunjangan_jabatan->addErrorMessage($this->tunjangan_jabatan->getErrorMessage(false));
        }
        if ($this->tunjangan_khusus->Required) {
            if (!$this->tunjangan_khusus->IsDetailKey && EmptyValue($this->tunjangan_khusus->FormValue)) {
                $this->tunjangan_khusus->addErrorMessage(str_replace("%s", $this->tunjangan_khusus->caption(), $this->tunjangan_khusus->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->tunjangan_khusus->FormValue)) {
            $this->tunjangan_khusus->addErrorMessage($this->tunjangan_khusus->getErrorMessage(false));
        }
        if ($this->reward->Required) {
            if (!$this->reward->IsDetailKey && EmptyValue($this->reward->FormValue)) {
                $this->reward->addErrorMessage(str_replace("%s", $this->reward->caption(), $this->reward->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->reward->FormValue)) {
            $this->reward->addErrorMessage($this->reward->getErrorMessage(false));
        }
        if ($this->lembur->Required) {
            if (!$this->lembur->IsDetailKey && EmptyValue($this->lembur->FormValue)) {
                $this->lembur->addErrorMessage(str_replace("%s", $this->lembur->caption(), $this->lembur->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->lembur->FormValue)) {
            $this->lembur->addErrorMessage($this->lembur->getErrorMessage(false));
        }
        if ($this->piket->Required) {
            if (!$this->piket->IsDetailKey && EmptyValue($this->piket->FormValue)) {
                $this->piket->addErrorMessage(str_replace("%s", $this->piket->caption(), $this->piket->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->piket->FormValue)) {
            $this->piket->addErrorMessage($this->piket->getErrorMessage(false));
        }
        if ($this->inval->Required) {
            if (!$this->inval->IsDetailKey && EmptyValue($this->inval->FormValue)) {
                $this->inval->addErrorMessage(str_replace("%s", $this->inval->caption(), $this->inval->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->inval->FormValue)) {
            $this->inval->addErrorMessage($this->inval->getErrorMessage(false));
        }
        if ($this->jam_lebih->Required) {
            if (!$this->jam_lebih->IsDetailKey && EmptyValue($this->jam_lebih->FormValue)) {
                $this->jam_lebih->addErrorMessage(str_replace("%s", $this->jam_lebih->caption(), $this->jam_lebih->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jam_lebih->FormValue)) {
            $this->jam_lebih->addErrorMessage($this->jam_lebih->getErrorMessage(false));
        }
        if ($this->ekstrakuri->Required) {
            if (!$this->ekstrakuri->IsDetailKey && EmptyValue($this->ekstrakuri->FormValue)) {
                $this->ekstrakuri->addErrorMessage(str_replace("%s", $this->ekstrakuri->caption(), $this->ekstrakuri->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->ekstrakuri->FormValue)) {
            $this->ekstrakuri->addErrorMessage($this->ekstrakuri->getErrorMessage(false));
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

        // gapok
        $this->gapok->setDbValueDef($rsnew, $this->gapok->CurrentValue, null, false);

        // value_kehadiran
        $this->value_kehadiran->setDbValueDef($rsnew, $this->value_kehadiran->CurrentValue, null, false);

        // tunjangan_jabatan
        $this->tunjangan_jabatan->setDbValueDef($rsnew, $this->tunjangan_jabatan->CurrentValue, null, false);

        // tunjangan_khusus
        $this->tunjangan_khusus->setDbValueDef($rsnew, $this->tunjangan_khusus->CurrentValue, null, false);

        // reward
        $this->reward->setDbValueDef($rsnew, $this->reward->CurrentValue, null, false);

        // lembur
        $this->lembur->setDbValueDef($rsnew, $this->lembur->CurrentValue, null, false);

        // piket
        $this->piket->setDbValueDef($rsnew, $this->piket->CurrentValue, null, false);

        // inval
        $this->inval->setDbValueDef($rsnew, $this->inval->CurrentValue, null, false);

        // jam_lebih
        $this->jam_lebih->setDbValueDef($rsnew, $this->jam_lebih->CurrentValue, null, false);

        // ekstrakuri
        $this->ekstrakuri->setDbValueDef($rsnew, $this->ekstrakuri->CurrentValue, null, false);

        // pidjabatan
        if ($this->pidjabatan->getSessionValue() != "") {
            $rsnew['pidjabatan'] = $this->pidjabatan->getSessionValue();
        }

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check referential integrity for master table 'gajitunjangan'
        $validMasterRecord = true;
        $detailKeys = [];
        $detailKeys["pidjabatan"] = $this->pidjabatan->getSessionValue();
        $masterTable = Container("jabatan");
        $masterFilter = $this->getMasterFilter($masterTable, $detailKeys);
        if (!EmptyValue($masterFilter)) {
            $rsmaster = $masterTable->loadRs($masterFilter)->fetch();
            $validMasterRecord = $rsmaster !== false;
        } else { // Allow null value if not required field
            $validMasterRecord = $masterFilter === null;
        }
        if (!$validMasterRecord) {
            $relatedRecordMsg = str_replace("%t", "jabatan", $Language->phrase("RelatedRecordRequired"));
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
            if ($masterTblVar == "jabatan") {
                $validMaster = true;
                $masterTbl = Container("jabatan");
                if (($parm = Get("fk_id", Get("pidjabatan"))) !== null) {
                    $masterTbl->id->setQueryStringValue($parm);
                    $this->pidjabatan->setQueryStringValue($masterTbl->id->QueryStringValue);
                    $this->pidjabatan->setSessionValue($this->pidjabatan->QueryStringValue);
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
            if ($masterTblVar == "jabatan") {
                $validMaster = true;
                $masterTbl = Container("jabatan");
                if (($parm = Post("fk_id", Post("pidjabatan"))) !== null) {
                    $masterTbl->id->setFormValue($parm);
                    $this->pidjabatan->setFormValue($masterTbl->id->FormValue);
                    $this->pidjabatan->setSessionValue($this->pidjabatan->FormValue);
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
            if ($masterTblVar != "jabatan") {
                if ($this->pidjabatan->CurrentValue == "") {
                    $this->pidjabatan->setSessionValue("");
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("GajitunjanganList"), "", $this->TableVar, true);
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
