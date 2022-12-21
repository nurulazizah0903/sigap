<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PegSkillAdd extends PegSkill
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'peg_skill';

    // Page object name
    public $PageObjName = "PegSkillAdd";

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

        // Table object (peg_skill)
        if (!isset($GLOBALS["peg_skill"]) || get_class($GLOBALS["peg_skill"]) == PROJECT_NAMESPACE . "peg_skill") {
            $GLOBALS["peg_skill"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'peg_skill');
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
                $tbl = Container("peg_skill");
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
                    if ($pageName == "PegSkillView") {
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
		        $this->bukti->OldUploadPath = "bukti_skill";
		        $this->bukti->UploadPath = $this->bukti->OldUploadPath;
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
        $this->c_by->setVisibility();
        $this->pid->Visible = false;
        $this->keahlian->setVisibility();
        $this->tingkat->setVisibility();
        $this->keterangan->setVisibility();
        $this->bukti->setVisibility();
        $this->c_date->setVisibility();
        $this->u_date->setVisibility();
        $this->u_by->setVisibility();
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
        $this->setupLookupOptions($this->c_by);
        $this->setupLookupOptions($this->u_by);

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
                    $this->terminate("PegSkillList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "PegSkillList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "PegSkillView") {
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
        $this->bukti->Upload->Index = $CurrentForm->Index;
        $this->bukti->Upload->uploadFile();
        $this->bukti->CurrentValue = $this->bukti->Upload->FileName;
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

        // Check field name 'c_by' first before field var 'x_c_by'
        $val = $CurrentForm->hasValue("c_by") ? $CurrentForm->getValue("c_by") : $CurrentForm->getValue("x_c_by");
        if (!$this->c_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->c_by->Visible = false; // Disable update for API request
            } else {
                $this->c_by->setFormValue($val);
            }
        }

        // Check field name 'keahlian' first before field var 'x_keahlian'
        $val = $CurrentForm->hasValue("keahlian") ? $CurrentForm->getValue("keahlian") : $CurrentForm->getValue("x_keahlian");
        if (!$this->keahlian->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->keahlian->Visible = false; // Disable update for API request
            } else {
                $this->keahlian->setFormValue($val);
            }
        }

        // Check field name 'tingkat' first before field var 'x_tingkat'
        $val = $CurrentForm->hasValue("tingkat") ? $CurrentForm->getValue("tingkat") : $CurrentForm->getValue("x_tingkat");
        if (!$this->tingkat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tingkat->Visible = false; // Disable update for API request
            } else {
                $this->tingkat->setFormValue($val);
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

        // Check field name 'c_date' first before field var 'x_c_date'
        $val = $CurrentForm->hasValue("c_date") ? $CurrentForm->getValue("c_date") : $CurrentForm->getValue("x_c_date");
        if (!$this->c_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->c_date->Visible = false; // Disable update for API request
            } else {
                $this->c_date->setFormValue($val);
            }
            $this->c_date->CurrentValue = UnFormatDateTime($this->c_date->CurrentValue, $this->c_date->formatPattern());
        }

        // Check field name 'u_date' first before field var 'x_u_date'
        $val = $CurrentForm->hasValue("u_date") ? $CurrentForm->getValue("u_date") : $CurrentForm->getValue("x_u_date");
        if (!$this->u_date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->u_date->Visible = false; // Disable update for API request
            } else {
                $this->u_date->setFormValue($val);
            }
            $this->u_date->CurrentValue = UnFormatDateTime($this->u_date->CurrentValue, $this->u_date->formatPattern());
        }

        // Check field name 'u_by' first before field var 'x_u_by'
        $val = $CurrentForm->hasValue("u_by") ? $CurrentForm->getValue("u_by") : $CurrentForm->getValue("x_u_by");
        if (!$this->u_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->u_by->Visible = false; // Disable update for API request
            } else {
                $this->u_by->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		$this->bukti->OldUploadPath = "bukti_skill";
		$this->bukti->UploadPath = $this->bukti->OldUploadPath;
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->c_by->CurrentValue = $this->c_by->FormValue;
        $this->keahlian->CurrentValue = $this->keahlian->FormValue;
        $this->tingkat->CurrentValue = $this->tingkat->FormValue;
        $this->keterangan->CurrentValue = $this->keterangan->FormValue;
        $this->c_date->CurrentValue = $this->c_date->FormValue;
        $this->c_date->CurrentValue = UnFormatDateTime($this->c_date->CurrentValue, $this->c_date->formatPattern());
        $this->u_date->CurrentValue = $this->u_date->FormValue;
        $this->u_date->CurrentValue = UnFormatDateTime($this->u_date->CurrentValue, $this->u_date->formatPattern());
        $this->u_by->CurrentValue = $this->u_by->FormValue;
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
        $this->c_by->setDbValue($row['c_by']);
        $this->pid->setDbValue($row['pid']);
        $this->keahlian->setDbValue($row['keahlian']);
        $this->tingkat->setDbValue($row['tingkat']);
        $this->keterangan->setDbValue($row['keterangan']);
        $this->bukti->Upload->DbValue = $row['bukti'];
        $this->bukti->setDbValue($this->bukti->Upload->DbValue);
        $this->c_date->setDbValue($row['c_date']);
        $this->u_date->setDbValue($row['u_date']);
        $this->u_by->setDbValue($row['u_by']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['c_by'] = $this->c_by->DefaultValue;
        $row['pid'] = $this->pid->DefaultValue;
        $row['keahlian'] = $this->keahlian->DefaultValue;
        $row['tingkat'] = $this->tingkat->DefaultValue;
        $row['keterangan'] = $this->keterangan->DefaultValue;
        $row['bukti'] = $this->bukti->DefaultValue;
        $row['c_date'] = $this->c_date->DefaultValue;
        $row['u_date'] = $this->u_date->DefaultValue;
        $row['u_by'] = $this->u_by->DefaultValue;
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

        // c_by
        $this->c_by->RowCssClass = "row";

        // pid
        $this->pid->RowCssClass = "row";

        // keahlian
        $this->keahlian->RowCssClass = "row";

        // tingkat
        $this->tingkat->RowCssClass = "row";

        // keterangan
        $this->keterangan->RowCssClass = "row";

        // bukti
        $this->bukti->RowCssClass = "row";

        // c_date
        $this->c_date->RowCssClass = "row";

        // u_date
        $this->u_date->RowCssClass = "row";

        // u_by
        $this->u_by->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // c_by
            $curVal = strval($this->c_by->CurrentValue);
            if ($curVal != "") {
                $this->c_by->ViewValue = $this->c_by->lookupCacheOption($curVal);
                if ($this->c_by->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->c_by->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->c_by->Lookup->renderViewRow($rswrk[0]);
                        $this->c_by->ViewValue = $this->c_by->displayValue($arwrk);
                    } else {
                        $this->c_by->ViewValue = FormatNumber($this->c_by->CurrentValue, $this->c_by->formatPattern());
                    }
                }
            } else {
                $this->c_by->ViewValue = null;
            }
            $this->c_by->ViewCustomAttributes = "";

            // pid
            $this->pid->ViewValue = $this->pid->CurrentValue;
            $this->pid->ViewValue = FormatNumber($this->pid->ViewValue, $this->pid->formatPattern());
            $this->pid->ViewCustomAttributes = "";

            // keahlian
            $this->keahlian->ViewValue = $this->keahlian->CurrentValue;
            $this->keahlian->ViewCustomAttributes = "";

            // tingkat
            $this->tingkat->ViewValue = $this->tingkat->CurrentValue;
            $this->tingkat->ViewCustomAttributes = "";

            // keterangan
            $this->keterangan->ViewValue = $this->keterangan->CurrentValue;
            $this->keterangan->ViewCustomAttributes = "";

            // bukti
            $this->bukti->UploadPath = "bukti_skill";
            if (!EmptyValue($this->bukti->Upload->DbValue)) {
                $this->bukti->ViewValue = $this->bukti->Upload->DbValue;
            } else {
                $this->bukti->ViewValue = "";
            }
            $this->bukti->ViewCustomAttributes = "";

            // c_date
            $this->c_date->ViewValue = $this->c_date->CurrentValue;
            $this->c_date->ViewValue = FormatDateTime($this->c_date->ViewValue, $this->c_date->formatPattern());
            $this->c_date->ViewCustomAttributes = "";

            // u_date
            $this->u_date->ViewValue = $this->u_date->CurrentValue;
            $this->u_date->ViewValue = FormatDateTime($this->u_date->ViewValue, $this->u_date->formatPattern());
            $this->u_date->ViewCustomAttributes = "";

            // u_by
            $curVal = strval($this->u_by->CurrentValue);
            if ($curVal != "") {
                $this->u_by->ViewValue = $this->u_by->lookupCacheOption($curVal);
                if ($this->u_by->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->u_by->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->u_by->Lookup->renderViewRow($rswrk[0]);
                        $this->u_by->ViewValue = $this->u_by->displayValue($arwrk);
                    } else {
                        $this->u_by->ViewValue = FormatNumber($this->u_by->CurrentValue, $this->u_by->formatPattern());
                    }
                }
            } else {
                $this->u_by->ViewValue = null;
            }
            $this->u_by->ViewCustomAttributes = "";

            // c_by
            $this->c_by->LinkCustomAttributes = "";
            $this->c_by->HrefValue = "";

            // keahlian
            $this->keahlian->LinkCustomAttributes = "";
            $this->keahlian->HrefValue = "";

            // tingkat
            $this->tingkat->LinkCustomAttributes = "";
            $this->tingkat->HrefValue = "";

            // keterangan
            $this->keterangan->LinkCustomAttributes = "";
            $this->keterangan->HrefValue = "";

            // bukti
            $this->bukti->LinkCustomAttributes = "";
            $this->bukti->HrefValue = "";
            $this->bukti->ExportHrefValue = $this->bukti->UploadPath . $this->bukti->Upload->DbValue;

            // c_date
            $this->c_date->LinkCustomAttributes = "";
            $this->c_date->HrefValue = "";

            // u_date
            $this->u_date->LinkCustomAttributes = "";
            $this->u_date->HrefValue = "";

            // u_by
            $this->u_by->LinkCustomAttributes = "";
            $this->u_by->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // c_by
            $this->c_by->setupEditAttributes();
            $this->c_by->EditCustomAttributes = "";
            $curVal = trim(strval($this->c_by->CurrentValue));
            if ($curVal != "") {
                $this->c_by->ViewValue = $this->c_by->lookupCacheOption($curVal);
            } else {
                $this->c_by->ViewValue = $this->c_by->Lookup !== null && is_array($this->c_by->lookupOptions()) ? $curVal : null;
            }
            if ($this->c_by->ViewValue !== null) { // Load from cache
                $this->c_by->EditValue = array_values($this->c_by->lookupOptions());
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->c_by->CurrentValue, DATATYPE_NUMBER, "");
                }
                $sqlWrk = $this->c_by->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->c_by->EditValue = $arwrk;
            }
            $this->c_by->PlaceHolder = RemoveHtml($this->c_by->caption());

            // keahlian
            $this->keahlian->setupEditAttributes();
            $this->keahlian->EditCustomAttributes = "";
            if (!$this->keahlian->Raw) {
                $this->keahlian->CurrentValue = HtmlDecode($this->keahlian->CurrentValue);
            }
            $this->keahlian->EditValue = HtmlEncode($this->keahlian->CurrentValue);
            $this->keahlian->PlaceHolder = RemoveHtml($this->keahlian->caption());

            // tingkat
            $this->tingkat->setupEditAttributes();
            $this->tingkat->EditCustomAttributes = "";
            if (!$this->tingkat->Raw) {
                $this->tingkat->CurrentValue = HtmlDecode($this->tingkat->CurrentValue);
            }
            $this->tingkat->EditValue = HtmlEncode($this->tingkat->CurrentValue);
            $this->tingkat->PlaceHolder = RemoveHtml($this->tingkat->caption());

            // keterangan
            $this->keterangan->setupEditAttributes();
            $this->keterangan->EditCustomAttributes = "";
            if (!$this->keterangan->Raw) {
                $this->keterangan->CurrentValue = HtmlDecode($this->keterangan->CurrentValue);
            }
            $this->keterangan->EditValue = HtmlEncode($this->keterangan->CurrentValue);
            $this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

            // bukti
            $this->bukti->setupEditAttributes();
            $this->bukti->EditCustomAttributes = "";
            $this->bukti->UploadPath = "bukti_skill";
            if (!EmptyValue($this->bukti->Upload->DbValue)) {
                $this->bukti->EditValue = $this->bukti->Upload->DbValue;
            } else {
                $this->bukti->EditValue = "";
            }
            if (!EmptyValue($this->bukti->CurrentValue)) {
                $this->bukti->Upload->FileName = $this->bukti->CurrentValue;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->bukti);
            }

            // c_date

            // u_date

            // u_by

            // Add refer script

            // c_by
            $this->c_by->LinkCustomAttributes = "";
            $this->c_by->HrefValue = "";

            // keahlian
            $this->keahlian->LinkCustomAttributes = "";
            $this->keahlian->HrefValue = "";

            // tingkat
            $this->tingkat->LinkCustomAttributes = "";
            $this->tingkat->HrefValue = "";

            // keterangan
            $this->keterangan->LinkCustomAttributes = "";
            $this->keterangan->HrefValue = "";

            // bukti
            $this->bukti->LinkCustomAttributes = "";
            $this->bukti->HrefValue = "";
            $this->bukti->ExportHrefValue = $this->bukti->UploadPath . $this->bukti->Upload->DbValue;

            // c_date
            $this->c_date->LinkCustomAttributes = "";
            $this->c_date->HrefValue = "";

            // u_date
            $this->u_date->LinkCustomAttributes = "";
            $this->u_date->HrefValue = "";

            // u_by
            $this->u_by->LinkCustomAttributes = "";
            $this->u_by->HrefValue = "";
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
        if ($this->c_by->Required) {
            if (!$this->c_by->IsDetailKey && EmptyValue($this->c_by->FormValue)) {
                $this->c_by->addErrorMessage(str_replace("%s", $this->c_by->caption(), $this->c_by->RequiredErrorMessage));
            }
        }
        if ($this->keahlian->Required) {
            if (!$this->keahlian->IsDetailKey && EmptyValue($this->keahlian->FormValue)) {
                $this->keahlian->addErrorMessage(str_replace("%s", $this->keahlian->caption(), $this->keahlian->RequiredErrorMessage));
            }
        }
        if ($this->tingkat->Required) {
            if (!$this->tingkat->IsDetailKey && EmptyValue($this->tingkat->FormValue)) {
                $this->tingkat->addErrorMessage(str_replace("%s", $this->tingkat->caption(), $this->tingkat->RequiredErrorMessage));
            }
        }
        if ($this->keterangan->Required) {
            if (!$this->keterangan->IsDetailKey && EmptyValue($this->keterangan->FormValue)) {
                $this->keterangan->addErrorMessage(str_replace("%s", $this->keterangan->caption(), $this->keterangan->RequiredErrorMessage));
            }
        }
        if ($this->bukti->Required) {
            if ($this->bukti->Upload->FileName == "" && !$this->bukti->Upload->KeepFile) {
                $this->bukti->addErrorMessage(str_replace("%s", $this->bukti->caption(), $this->bukti->RequiredErrorMessage));
            }
        }
        if ($this->c_date->Required) {
            if (!$this->c_date->IsDetailKey && EmptyValue($this->c_date->FormValue)) {
                $this->c_date->addErrorMessage(str_replace("%s", $this->c_date->caption(), $this->c_date->RequiredErrorMessage));
            }
        }
        if ($this->u_date->Required) {
            if (!$this->u_date->IsDetailKey && EmptyValue($this->u_date->FormValue)) {
                $this->u_date->addErrorMessage(str_replace("%s", $this->u_date->caption(), $this->u_date->RequiredErrorMessage));
            }
        }
        if ($this->u_by->Required) {
            if (!$this->u_by->IsDetailKey && EmptyValue($this->u_by->FormValue)) {
                $this->u_by->addErrorMessage(str_replace("%s", $this->u_by->caption(), $this->u_by->RequiredErrorMessage));
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set new row
        $rsnew = [];

        // c_by
        $this->c_by->setDbValueDef($rsnew, $this->c_by->CurrentValue, null, false);

        // keahlian
        $this->keahlian->setDbValueDef($rsnew, $this->keahlian->CurrentValue, null, false);

        // tingkat
        $this->tingkat->setDbValueDef($rsnew, $this->tingkat->CurrentValue, null, false);

        // keterangan
        $this->keterangan->setDbValueDef($rsnew, $this->keterangan->CurrentValue, null, false);

        // bukti
        if ($this->bukti->Visible && !$this->bukti->Upload->KeepFile) {
            $this->bukti->Upload->DbValue = ""; // No need to delete old file
            if ($this->bukti->Upload->FileName == "") {
                $rsnew['bukti'] = null;
            } else {
                $rsnew['bukti'] = $this->bukti->Upload->FileName;
            }
        }

        // c_date
        $this->c_date->CurrentValue = CurrentDateTime();
        $this->c_date->setDbValueDef($rsnew, $this->c_date->CurrentValue, null);

        // u_date
        $this->u_date->CurrentValue = CurrentDateTime();
        $this->u_date->setDbValueDef($rsnew, $this->u_date->CurrentValue, null);

        // u_by
        $this->u_by->CurrentValue = CurrentUserID();
        $this->u_by->setDbValueDef($rsnew, $this->u_by->CurrentValue, null);

        // pid
        if ($this->pid->getSessionValue() != "") {
            $rsnew['pid'] = $this->pid->getSessionValue();
        }
        if ($this->bukti->Visible && !$this->bukti->Upload->KeepFile) {
            $this->bukti->UploadPath = "bukti_skill";
            $oldFiles = EmptyValue($this->bukti->Upload->DbValue) ? [] : [$this->bukti->htmlDecode($this->bukti->Upload->DbValue)];
            if (!EmptyValue($this->bukti->Upload->FileName)) {
                $newFiles = [$this->bukti->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->bukti, $this->bukti->Upload->Index);
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
                            $file1 = UniqueFilename($this->bukti->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->bukti->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->bukti->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->bukti->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->bukti->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->bukti->setDbValueDef($rsnew, $this->bukti->Upload->FileName, null, false);
            }
        }

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check referential integrity for master table 'peg_skill'
        $validMasterRecord = true;
        $detailKeys = [];
        $detailKeys["pid"] = $this->pid->getSessionValue();
        $masterTable = Container("pegawai");
        $masterFilter = $this->getMasterFilter($masterTable, $detailKeys);
        if (!EmptyValue($masterFilter)) {
            $rsmaster = $masterTable->loadRs($masterFilter)->fetch();
            $validMasterRecord = $rsmaster !== false;
        } else { // Allow null value if not required field
            $validMasterRecord = $masterFilter === null;
        }
        if (!$validMasterRecord) {
            $relatedRecordMsg = str_replace("%t", "pegawai", $Language->phrase("RelatedRecordRequired"));
            $this->setFailureMessage($relatedRecordMsg);
            return false;
        }
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);
        $this->bukti->OldUploadPath = "bukti_skill";
        $this->bukti->UploadPath = $this->bukti->OldUploadPath;

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
                if ($this->bukti->Visible && !$this->bukti->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->bukti->Upload->DbValue) ? [] : [$this->bukti->htmlDecode($this->bukti->Upload->DbValue)];
                    if (!EmptyValue($this->bukti->Upload->FileName)) {
                        $newFiles = [$this->bukti->Upload->FileName];
                        $newFiles2 = [$this->bukti->htmlDecode($rsnew['bukti'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->bukti, $this->bukti->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->bukti->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
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
                                @unlink($this->bukti->oldPhysicalUploadPath() . $oldFile);
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
            // bukti
            CleanUploadTempPath($this->bukti, $this->bukti->Upload->Index);
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
            if ($masterTblVar == "pegawai") {
                $validMaster = true;
                $masterTbl = Container("pegawai");
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
            if ($masterTblVar == "pegawai") {
                $validMaster = true;
                $masterTbl = Container("pegawai");
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
            if ($masterTblVar != "pegawai") {
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PegSkillList"), "", $this->TableVar, true);
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
                case "x_c_by":
                    break;
                case "x_u_by":
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
        $id_user = CurrentUserInfo("id");
    	if($id_user != '' OR $id_user != FALSE) {
            $this->c_by->CurrentValue = $id_user ;
            $this->c_by->ReadOnly = TRUE;
            }
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
