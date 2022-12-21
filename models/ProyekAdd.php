<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class ProyekAdd extends Proyek
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'proyek';

    // Page object name
    public $PageObjName = "ProyekAdd";

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

        // Table object (proyek)
        if (!isset($GLOBALS["proyek"]) || get_class($GLOBALS["proyek"]) == PROJECT_NAMESPACE . "proyek") {
            $GLOBALS["proyek"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'proyek');
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
                $tbl = Container("proyek");
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
                    if ($pageName == "ProyekView") {
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
		        $this->file_proyek->OldUploadPath = "file_proyek";
		        $this->file_proyek->UploadPath = $this->file_proyek->OldUploadPath;
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
        $this->klien->setVisibility();
        $this->proyek->setVisibility();
        $this->tgl_awal->setVisibility();
        $this->tgl_akhir->setVisibility();
        $this->file_proyek->setVisibility();
        $this->aktif->setVisibility();
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
                    $this->terminate("ProyekList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "ProyekList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "ProyekView") {
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
        $this->file_proyek->Upload->Index = $CurrentForm->Index;
        $this->file_proyek->Upload->uploadFile();
        $this->file_proyek->CurrentValue = $this->file_proyek->Upload->FileName;
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

        // Check field name 'klien' first before field var 'x_klien'
        $val = $CurrentForm->hasValue("klien") ? $CurrentForm->getValue("klien") : $CurrentForm->getValue("x_klien");
        if (!$this->klien->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->klien->Visible = false; // Disable update for API request
            } else {
                $this->klien->setFormValue($val);
            }
        }

        // Check field name 'proyek' first before field var 'x_proyek'
        $val = $CurrentForm->hasValue("proyek") ? $CurrentForm->getValue("proyek") : $CurrentForm->getValue("x_proyek");
        if (!$this->proyek->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->proyek->Visible = false; // Disable update for API request
            } else {
                $this->proyek->setFormValue($val);
            }
        }

        // Check field name 'tgl_awal' first before field var 'x_tgl_awal'
        $val = $CurrentForm->hasValue("tgl_awal") ? $CurrentForm->getValue("tgl_awal") : $CurrentForm->getValue("x_tgl_awal");
        if (!$this->tgl_awal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tgl_awal->Visible = false; // Disable update for API request
            } else {
                $this->tgl_awal->setFormValue($val, true, $validate);
            }
            $this->tgl_awal->CurrentValue = UnFormatDateTime($this->tgl_awal->CurrentValue, $this->tgl_awal->formatPattern());
        }

        // Check field name 'tgl_akhir' first before field var 'x_tgl_akhir'
        $val = $CurrentForm->hasValue("tgl_akhir") ? $CurrentForm->getValue("tgl_akhir") : $CurrentForm->getValue("x_tgl_akhir");
        if (!$this->tgl_akhir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tgl_akhir->Visible = false; // Disable update for API request
            } else {
                $this->tgl_akhir->setFormValue($val, true, $validate);
            }
            $this->tgl_akhir->CurrentValue = UnFormatDateTime($this->tgl_akhir->CurrentValue, $this->tgl_akhir->formatPattern());
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
		$this->file_proyek->OldUploadPath = "file_proyek";
		$this->file_proyek->UploadPath = $this->file_proyek->OldUploadPath;
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->klien->CurrentValue = $this->klien->FormValue;
        $this->proyek->CurrentValue = $this->proyek->FormValue;
        $this->tgl_awal->CurrentValue = $this->tgl_awal->FormValue;
        $this->tgl_awal->CurrentValue = UnFormatDateTime($this->tgl_awal->CurrentValue, $this->tgl_awal->formatPattern());
        $this->tgl_akhir->CurrentValue = $this->tgl_akhir->FormValue;
        $this->tgl_akhir->CurrentValue = UnFormatDateTime($this->tgl_akhir->CurrentValue, $this->tgl_akhir->formatPattern());
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
        $this->klien->setDbValue($row['klien']);
        $this->proyek->setDbValue($row['proyek']);
        $this->tgl_awal->setDbValue($row['tgl_awal']);
        $this->tgl_akhir->setDbValue($row['tgl_akhir']);
        $this->file_proyek->Upload->DbValue = $row['file_proyek'];
        $this->file_proyek->setDbValue($this->file_proyek->Upload->DbValue);
        $this->aktif->setDbValue($row['aktif']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['klien'] = $this->klien->DefaultValue;
        $row['proyek'] = $this->proyek->DefaultValue;
        $row['tgl_awal'] = $this->tgl_awal->DefaultValue;
        $row['tgl_akhir'] = $this->tgl_akhir->DefaultValue;
        $row['file_proyek'] = $this->file_proyek->DefaultValue;
        $row['aktif'] = $this->aktif->DefaultValue;
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

        // klien
        $this->klien->RowCssClass = "row";

        // proyek
        $this->proyek->RowCssClass = "row";

        // tgl_awal
        $this->tgl_awal->RowCssClass = "row";

        // tgl_akhir
        $this->tgl_akhir->RowCssClass = "row";

        // file_proyek
        $this->file_proyek->RowCssClass = "row";

        // aktif
        $this->aktif->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // klien
            $this->klien->ViewValue = $this->klien->CurrentValue;
            $this->klien->ViewCustomAttributes = "";

            // proyek
            $this->proyek->ViewValue = $this->proyek->CurrentValue;
            $this->proyek->ViewCustomAttributes = "";

            // tgl_awal
            $this->tgl_awal->ViewValue = $this->tgl_awal->CurrentValue;
            $this->tgl_awal->ViewValue = FormatDateTime($this->tgl_awal->ViewValue, $this->tgl_awal->formatPattern());
            $this->tgl_awal->ViewCustomAttributes = "";

            // tgl_akhir
            $this->tgl_akhir->ViewValue = $this->tgl_akhir->CurrentValue;
            $this->tgl_akhir->ViewValue = FormatDateTime($this->tgl_akhir->ViewValue, $this->tgl_akhir->formatPattern());
            $this->tgl_akhir->ViewCustomAttributes = "";

            // file_proyek
            $this->file_proyek->UploadPath = "file_proyek";
            if (!EmptyValue($this->file_proyek->Upload->DbValue)) {
                $this->file_proyek->ViewValue = $this->file_proyek->Upload->DbValue;
            } else {
                $this->file_proyek->ViewValue = "";
            }
            $this->file_proyek->ViewCustomAttributes = "";

            // aktif
            $this->aktif->ViewValue = $this->aktif->CurrentValue;
            $this->aktif->ViewValue = FormatNumber($this->aktif->ViewValue, $this->aktif->formatPattern());
            $this->aktif->ViewCustomAttributes = "";

            // klien
            $this->klien->LinkCustomAttributes = "";
            $this->klien->HrefValue = "";

            // proyek
            $this->proyek->LinkCustomAttributes = "";
            $this->proyek->HrefValue = "";

            // tgl_awal
            $this->tgl_awal->LinkCustomAttributes = "";
            $this->tgl_awal->HrefValue = "";

            // tgl_akhir
            $this->tgl_akhir->LinkCustomAttributes = "";
            $this->tgl_akhir->HrefValue = "";

            // file_proyek
            $this->file_proyek->LinkCustomAttributes = "";
            $this->file_proyek->HrefValue = "";
            $this->file_proyek->ExportHrefValue = $this->file_proyek->UploadPath . $this->file_proyek->Upload->DbValue;

            // aktif
            $this->aktif->LinkCustomAttributes = "";
            $this->aktif->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // klien
            $this->klien->setupEditAttributes();
            $this->klien->EditCustomAttributes = "";
            if (!$this->klien->Raw) {
                $this->klien->CurrentValue = HtmlDecode($this->klien->CurrentValue);
            }
            $this->klien->EditValue = HtmlEncode($this->klien->CurrentValue);
            $this->klien->PlaceHolder = RemoveHtml($this->klien->caption());

            // proyek
            $this->proyek->setupEditAttributes();
            $this->proyek->EditCustomAttributes = "";
            if (!$this->proyek->Raw) {
                $this->proyek->CurrentValue = HtmlDecode($this->proyek->CurrentValue);
            }
            $this->proyek->EditValue = HtmlEncode($this->proyek->CurrentValue);
            $this->proyek->PlaceHolder = RemoveHtml($this->proyek->caption());

            // tgl_awal
            $this->tgl_awal->setupEditAttributes();
            $this->tgl_awal->EditCustomAttributes = "";
            $this->tgl_awal->EditValue = HtmlEncode(FormatDateTime($this->tgl_awal->CurrentValue, $this->tgl_awal->formatPattern()));
            $this->tgl_awal->PlaceHolder = RemoveHtml($this->tgl_awal->caption());

            // tgl_akhir
            $this->tgl_akhir->setupEditAttributes();
            $this->tgl_akhir->EditCustomAttributes = "";
            $this->tgl_akhir->EditValue = HtmlEncode(FormatDateTime($this->tgl_akhir->CurrentValue, $this->tgl_akhir->formatPattern()));
            $this->tgl_akhir->PlaceHolder = RemoveHtml($this->tgl_akhir->caption());

            // file_proyek
            $this->file_proyek->setupEditAttributes();
            $this->file_proyek->EditCustomAttributes = "";
            $this->file_proyek->UploadPath = "file_proyek";
            if (!EmptyValue($this->file_proyek->Upload->DbValue)) {
                $this->file_proyek->EditValue = $this->file_proyek->Upload->DbValue;
            } else {
                $this->file_proyek->EditValue = "";
            }
            if (!EmptyValue($this->file_proyek->CurrentValue)) {
                $this->file_proyek->Upload->FileName = $this->file_proyek->CurrentValue;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->file_proyek);
            }

            // aktif
            $this->aktif->setupEditAttributes();
            $this->aktif->EditCustomAttributes = "";
            $this->aktif->EditValue = HtmlEncode($this->aktif->CurrentValue);
            $this->aktif->PlaceHolder = RemoveHtml($this->aktif->caption());
            if (strval($this->aktif->EditValue) != "" && is_numeric($this->aktif->EditValue)) {
                $this->aktif->EditValue = FormatNumber($this->aktif->EditValue, null);
            }

            // Add refer script

            // klien
            $this->klien->LinkCustomAttributes = "";
            $this->klien->HrefValue = "";

            // proyek
            $this->proyek->LinkCustomAttributes = "";
            $this->proyek->HrefValue = "";

            // tgl_awal
            $this->tgl_awal->LinkCustomAttributes = "";
            $this->tgl_awal->HrefValue = "";

            // tgl_akhir
            $this->tgl_akhir->LinkCustomAttributes = "";
            $this->tgl_akhir->HrefValue = "";

            // file_proyek
            $this->file_proyek->LinkCustomAttributes = "";
            $this->file_proyek->HrefValue = "";
            $this->file_proyek->ExportHrefValue = $this->file_proyek->UploadPath . $this->file_proyek->Upload->DbValue;

            // aktif
            $this->aktif->LinkCustomAttributes = "";
            $this->aktif->HrefValue = "";
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
        if ($this->klien->Required) {
            if (!$this->klien->IsDetailKey && EmptyValue($this->klien->FormValue)) {
                $this->klien->addErrorMessage(str_replace("%s", $this->klien->caption(), $this->klien->RequiredErrorMessage));
            }
        }
        if ($this->proyek->Required) {
            if (!$this->proyek->IsDetailKey && EmptyValue($this->proyek->FormValue)) {
                $this->proyek->addErrorMessage(str_replace("%s", $this->proyek->caption(), $this->proyek->RequiredErrorMessage));
            }
        }
        if ($this->tgl_awal->Required) {
            if (!$this->tgl_awal->IsDetailKey && EmptyValue($this->tgl_awal->FormValue)) {
                $this->tgl_awal->addErrorMessage(str_replace("%s", $this->tgl_awal->caption(), $this->tgl_awal->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tgl_awal->FormValue, $this->tgl_awal->formatPattern())) {
            $this->tgl_awal->addErrorMessage($this->tgl_awal->getErrorMessage(false));
        }
        if ($this->tgl_akhir->Required) {
            if (!$this->tgl_akhir->IsDetailKey && EmptyValue($this->tgl_akhir->FormValue)) {
                $this->tgl_akhir->addErrorMessage(str_replace("%s", $this->tgl_akhir->caption(), $this->tgl_akhir->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tgl_akhir->FormValue, $this->tgl_akhir->formatPattern())) {
            $this->tgl_akhir->addErrorMessage($this->tgl_akhir->getErrorMessage(false));
        }
        if ($this->file_proyek->Required) {
            if ($this->file_proyek->Upload->FileName == "" && !$this->file_proyek->Upload->KeepFile) {
                $this->file_proyek->addErrorMessage(str_replace("%s", $this->file_proyek->caption(), $this->file_proyek->RequiredErrorMessage));
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

        // klien
        $this->klien->setDbValueDef($rsnew, $this->klien->CurrentValue, null, false);

        // proyek
        $this->proyek->setDbValueDef($rsnew, $this->proyek->CurrentValue, null, false);

        // tgl_awal
        $this->tgl_awal->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_awal->CurrentValue, $this->tgl_awal->formatPattern()), null, false);

        // tgl_akhir
        $this->tgl_akhir->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_akhir->CurrentValue, $this->tgl_akhir->formatPattern()), null, false);

        // file_proyek
        if ($this->file_proyek->Visible && !$this->file_proyek->Upload->KeepFile) {
            $this->file_proyek->Upload->DbValue = ""; // No need to delete old file
            if ($this->file_proyek->Upload->FileName == "") {
                $rsnew['file_proyek'] = null;
            } else {
                $rsnew['file_proyek'] = $this->file_proyek->Upload->FileName;
            }
        }

        // aktif
        $this->aktif->setDbValueDef($rsnew, $this->aktif->CurrentValue, null, false);
        if ($this->file_proyek->Visible && !$this->file_proyek->Upload->KeepFile) {
            $this->file_proyek->UploadPath = "file_proyek";
            $oldFiles = EmptyValue($this->file_proyek->Upload->DbValue) ? [] : [$this->file_proyek->htmlDecode($this->file_proyek->Upload->DbValue)];
            if (!EmptyValue($this->file_proyek->Upload->FileName)) {
                $newFiles = [$this->file_proyek->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->file_proyek, $this->file_proyek->Upload->Index);
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
                            $file1 = UniqueFilename($this->file_proyek->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->file_proyek->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->file_proyek->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->file_proyek->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->file_proyek->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->file_proyek->setDbValueDef($rsnew, $this->file_proyek->Upload->FileName, null, false);
            }
        }

        // Update current values
        $this->setCurrentValues($rsnew);
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);
        $this->file_proyek->OldUploadPath = "file_proyek";
        $this->file_proyek->UploadPath = $this->file_proyek->OldUploadPath;

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
                if ($this->file_proyek->Visible && !$this->file_proyek->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->file_proyek->Upload->DbValue) ? [] : [$this->file_proyek->htmlDecode($this->file_proyek->Upload->DbValue)];
                    if (!EmptyValue($this->file_proyek->Upload->FileName)) {
                        $newFiles = [$this->file_proyek->Upload->FileName];
                        $newFiles2 = [$this->file_proyek->htmlDecode($rsnew['file_proyek'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->file_proyek, $this->file_proyek->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->file_proyek->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
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
                                @unlink($this->file_proyek->oldPhysicalUploadPath() . $oldFile);
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
            // file_proyek
            CleanUploadTempPath($this->file_proyek, $this->file_proyek->Upload->Index);
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ProyekList"), "", $this->TableVar, true);
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
