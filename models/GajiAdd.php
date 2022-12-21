<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class GajiAdd extends Gaji
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'gaji';

    // Page object name
    public $PageObjName = "GajiAdd";

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

        // Table object (gaji)
        if (!isset($GLOBALS["gaji"]) || get_class($GLOBALS["gaji"]) == PROJECT_NAMESPACE . "gaji") {
            $GLOBALS["gaji"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'gaji');
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
                $tbl = Container("gaji");
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
                    if ($pageName == "GajiView") {
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
        $this->jabatan_id->setVisibility();
        $this->pegawai->setVisibility();
        $this->lembur->setVisibility();
        $this->value_lembur->Visible = false;
        $this->kehadiran->setVisibility();
        $this->gapok->Visible = false;
        $this->value_reward->Visible = false;
        $this->value_inval->Visible = false;
        $this->piket_count->setVisibility();
        $this->value_piket->Visible = false;
        $this->tugastambahan->Visible = false;
        $this->tj_jabatan->Visible = false;
        $this->sub_total->Visible = false;
        $this->potongan->Visible = false;
        $this->total->Visible = false;
        $this->month->setVisibility();
        $this->datetime->setVisibility();
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
        $this->setupLookupOptions($this->jabatan_id);
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
                    $this->terminate("GajiList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "GajiList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "GajiView") {
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

        // Check field name 'jabatan_id' first before field var 'x_jabatan_id'
        $val = $CurrentForm->hasValue("jabatan_id") ? $CurrentForm->getValue("jabatan_id") : $CurrentForm->getValue("x_jabatan_id");
        if (!$this->jabatan_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jabatan_id->Visible = false; // Disable update for API request
            } else {
                $this->jabatan_id->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'pegawai' first before field var 'x_pegawai'
        $val = $CurrentForm->hasValue("pegawai") ? $CurrentForm->getValue("pegawai") : $CurrentForm->getValue("x_pegawai");
        if (!$this->pegawai->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pegawai->Visible = false; // Disable update for API request
            } else {
                $this->pegawai->setFormValue($val);
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

        // Check field name 'kehadiran' first before field var 'x_kehadiran'
        $val = $CurrentForm->hasValue("kehadiran") ? $CurrentForm->getValue("kehadiran") : $CurrentForm->getValue("x_kehadiran");
        if (!$this->kehadiran->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kehadiran->Visible = false; // Disable update for API request
            } else {
                $this->kehadiran->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'piket_count' first before field var 'x_piket_count'
        $val = $CurrentForm->hasValue("piket_count") ? $CurrentForm->getValue("piket_count") : $CurrentForm->getValue("x_piket_count");
        if (!$this->piket_count->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->piket_count->Visible = false; // Disable update for API request
            } else {
                $this->piket_count->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'month' first before field var 'x_month'
        $val = $CurrentForm->hasValue("month") ? $CurrentForm->getValue("month") : $CurrentForm->getValue("x_month");
        if (!$this->month->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->month->Visible = false; // Disable update for API request
            } else {
                $this->month->setFormValue($val);
            }
        }

        // Check field name 'datetime' first before field var 'x_datetime'
        $val = $CurrentForm->hasValue("datetime") ? $CurrentForm->getValue("datetime") : $CurrentForm->getValue("x_datetime");
        if (!$this->datetime->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->datetime->Visible = false; // Disable update for API request
            } else {
                $this->datetime->setFormValue($val);
            }
            $this->datetime->CurrentValue = UnFormatDateTime($this->datetime->CurrentValue, $this->datetime->formatPattern());
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->jabatan_id->CurrentValue = $this->jabatan_id->FormValue;
        $this->pegawai->CurrentValue = $this->pegawai->FormValue;
        $this->lembur->CurrentValue = $this->lembur->FormValue;
        $this->kehadiran->CurrentValue = $this->kehadiran->FormValue;
        $this->piket_count->CurrentValue = $this->piket_count->FormValue;
        $this->month->CurrentValue = $this->month->FormValue;
        $this->datetime->CurrentValue = $this->datetime->FormValue;
        $this->datetime->CurrentValue = UnFormatDateTime($this->datetime->CurrentValue, $this->datetime->formatPattern());
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
        $this->jabatan_id->setDbValue($row['jabatan_id']);
        $this->pegawai->setDbValue($row['pegawai']);
        $this->lembur->setDbValue($row['lembur']);
        $this->value_lembur->setDbValue($row['value_lembur']);
        $this->kehadiran->setDbValue($row['kehadiran']);
        $this->gapok->setDbValue($row['gapok']);
        $this->value_reward->setDbValue($row['value_reward']);
        $this->value_inval->setDbValue($row['value_inval']);
        $this->piket_count->setDbValue($row['piket_count']);
        $this->value_piket->setDbValue($row['value_piket']);
        $this->tugastambahan->setDbValue($row['tugastambahan']);
        $this->tj_jabatan->setDbValue($row['tj_jabatan']);
        $this->sub_total->setDbValue($row['sub_total']);
        $this->potongan->setDbValue($row['potongan']);
        $this->total->setDbValue($row['total']);
        $this->month->setDbValue($row['month']);
        $this->datetime->setDbValue($row['datetime']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['jabatan_id'] = $this->jabatan_id->DefaultValue;
        $row['pegawai'] = $this->pegawai->DefaultValue;
        $row['lembur'] = $this->lembur->DefaultValue;
        $row['value_lembur'] = $this->value_lembur->DefaultValue;
        $row['kehadiran'] = $this->kehadiran->DefaultValue;
        $row['gapok'] = $this->gapok->DefaultValue;
        $row['value_reward'] = $this->value_reward->DefaultValue;
        $row['value_inval'] = $this->value_inval->DefaultValue;
        $row['piket_count'] = $this->piket_count->DefaultValue;
        $row['value_piket'] = $this->value_piket->DefaultValue;
        $row['tugastambahan'] = $this->tugastambahan->DefaultValue;
        $row['tj_jabatan'] = $this->tj_jabatan->DefaultValue;
        $row['sub_total'] = $this->sub_total->DefaultValue;
        $row['potongan'] = $this->potongan->DefaultValue;
        $row['total'] = $this->total->DefaultValue;
        $row['month'] = $this->month->DefaultValue;
        $row['datetime'] = $this->datetime->DefaultValue;
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

        // jabatan_id
        $this->jabatan_id->RowCssClass = "row";

        // pegawai
        $this->pegawai->RowCssClass = "row";

        // lembur
        $this->lembur->RowCssClass = "row";

        // value_lembur
        $this->value_lembur->RowCssClass = "row";

        // kehadiran
        $this->kehadiran->RowCssClass = "row";

        // gapok
        $this->gapok->RowCssClass = "row";

        // value_reward
        $this->value_reward->RowCssClass = "row";

        // value_inval
        $this->value_inval->RowCssClass = "row";

        // piket_count
        $this->piket_count->RowCssClass = "row";

        // value_piket
        $this->value_piket->RowCssClass = "row";

        // tugastambahan
        $this->tugastambahan->RowCssClass = "row";

        // tj_jabatan
        $this->tj_jabatan->RowCssClass = "row";

        // sub_total
        $this->sub_total->RowCssClass = "row";

        // potongan
        $this->potongan->RowCssClass = "row";

        // total
        $this->total->RowCssClass = "row";

        // month
        $this->month->RowCssClass = "row";

        // datetime
        $this->datetime->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

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

            // pegawai
            $this->pegawai->ViewValue = $this->pegawai->CurrentValue;
            $curVal = strval($this->pegawai->CurrentValue);
            if ($curVal != "") {
                $this->pegawai->ViewValue = $this->pegawai->lookupCacheOption($curVal);
                if ($this->pegawai->ViewValue === null) { // Lookup from database
                    $filterWrk = "`nip`" . SearchString("=", $curVal, DATATYPE_STRING, "");
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
                        $this->pegawai->ViewValue = $this->pegawai->CurrentValue;
                    }
                }
            } else {
                $this->pegawai->ViewValue = null;
            }
            $this->pegawai->ViewCustomAttributes = "";

            // lembur
            $this->lembur->ViewValue = $this->lembur->CurrentValue;
            $this->lembur->ViewValue = FormatNumber($this->lembur->ViewValue, $this->lembur->formatPattern());
            $this->lembur->ViewCustomAttributes = "";

            // value_lembur
            $this->value_lembur->ViewValue = $this->value_lembur->CurrentValue;
            $this->value_lembur->ViewValue = FormatNumber($this->value_lembur->ViewValue, $this->value_lembur->formatPattern());
            $this->value_lembur->ViewCustomAttributes = "";

            // kehadiran
            $this->kehadiran->ViewValue = $this->kehadiran->CurrentValue;
            $this->kehadiran->ViewValue = FormatNumber($this->kehadiran->ViewValue, $this->kehadiran->formatPattern());
            $this->kehadiran->ViewCustomAttributes = "";

            // gapok
            $this->gapok->ViewValue = $this->gapok->CurrentValue;
            $this->gapok->ViewValue = FormatNumber($this->gapok->ViewValue, $this->gapok->formatPattern());
            $this->gapok->ViewCustomAttributes = "";

            // value_reward
            $this->value_reward->ViewValue = $this->value_reward->CurrentValue;
            $this->value_reward->ViewValue = FormatNumber($this->value_reward->ViewValue, $this->value_reward->formatPattern());
            $this->value_reward->ViewCustomAttributes = "";

            // value_inval
            $this->value_inval->ViewValue = $this->value_inval->CurrentValue;
            $this->value_inval->ViewValue = FormatNumber($this->value_inval->ViewValue, $this->value_inval->formatPattern());
            $this->value_inval->ViewCustomAttributes = "";

            // piket_count
            $this->piket_count->ViewValue = $this->piket_count->CurrentValue;
            $this->piket_count->ViewValue = FormatNumber($this->piket_count->ViewValue, $this->piket_count->formatPattern());
            $this->piket_count->ViewCustomAttributes = "";

            // value_piket
            $this->value_piket->ViewValue = $this->value_piket->CurrentValue;
            $this->value_piket->ViewValue = FormatNumber($this->value_piket->ViewValue, $this->value_piket->formatPattern());
            $this->value_piket->ViewCustomAttributes = "";

            // tugastambahan
            $this->tugastambahan->ViewValue = $this->tugastambahan->CurrentValue;
            $this->tugastambahan->ViewValue = FormatNumber($this->tugastambahan->ViewValue, $this->tugastambahan->formatPattern());
            $this->tugastambahan->ViewCustomAttributes = "";

            // tj_jabatan
            $this->tj_jabatan->ViewValue = $this->tj_jabatan->CurrentValue;
            $this->tj_jabatan->ViewValue = FormatNumber($this->tj_jabatan->ViewValue, $this->tj_jabatan->formatPattern());
            $this->tj_jabatan->ViewCustomAttributes = "";

            // sub_total
            $this->sub_total->ViewValue = $this->sub_total->CurrentValue;
            $this->sub_total->ViewValue = FormatNumber($this->sub_total->ViewValue, $this->sub_total->formatPattern());
            $this->sub_total->ViewCustomAttributes = "";

            // potongan
            $this->potongan->ViewValue = $this->potongan->CurrentValue;
            $this->potongan->ViewValue = FormatNumber($this->potongan->ViewValue, $this->potongan->formatPattern());
            $this->potongan->ViewCustomAttributes = "";

            // total
            $this->total->ViewValue = $this->total->CurrentValue;
            $this->total->ViewValue = FormatNumber($this->total->ViewValue, $this->total->formatPattern());
            $this->total->ViewCustomAttributes = "";

            // month
            $this->month->ViewValue = $this->month->CurrentValue;
            $this->month->ViewCustomAttributes = "";

            // datetime
            $this->datetime->ViewValue = $this->datetime->CurrentValue;
            $this->datetime->ViewValue = FormatDateTime($this->datetime->ViewValue, $this->datetime->formatPattern());
            $this->datetime->ViewCustomAttributes = "";

            // jabatan_id
            $this->jabatan_id->LinkCustomAttributes = "";
            $this->jabatan_id->HrefValue = "";

            // pegawai
            $this->pegawai->LinkCustomAttributes = "";
            $this->pegawai->HrefValue = "";

            // lembur
            $this->lembur->LinkCustomAttributes = "";
            $this->lembur->HrefValue = "";

            // kehadiran
            $this->kehadiran->LinkCustomAttributes = "";
            $this->kehadiran->HrefValue = "";

            // piket_count
            $this->piket_count->LinkCustomAttributes = "";
            $this->piket_count->HrefValue = "";

            // month
            $this->month->LinkCustomAttributes = "";
            $this->month->HrefValue = "";

            // datetime
            $this->datetime->LinkCustomAttributes = "";
            $this->datetime->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
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

            // pegawai
            $this->pegawai->setupEditAttributes();
            $this->pegawai->EditCustomAttributes = "";
            if (!$this->pegawai->Raw) {
                $this->pegawai->CurrentValue = HtmlDecode($this->pegawai->CurrentValue);
            }
            $this->pegawai->EditValue = HtmlEncode($this->pegawai->CurrentValue);
            $curVal = strval($this->pegawai->CurrentValue);
            if ($curVal != "") {
                $this->pegawai->EditValue = $this->pegawai->lookupCacheOption($curVal);
                if ($this->pegawai->EditValue === null) { // Lookup from database
                    $filterWrk = "`nip`" . SearchString("=", $curVal, DATATYPE_STRING, "");
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
                        $this->pegawai->EditValue = HtmlEncode($this->pegawai->CurrentValue);
                    }
                }
            } else {
                $this->pegawai->EditValue = null;
            }
            $this->pegawai->PlaceHolder = RemoveHtml($this->pegawai->caption());

            // lembur
            $this->lembur->setupEditAttributes();
            $this->lembur->EditCustomAttributes = "";
            $this->lembur->EditValue = HtmlEncode($this->lembur->CurrentValue);
            $this->lembur->PlaceHolder = RemoveHtml($this->lembur->caption());
            if (strval($this->lembur->EditValue) != "" && is_numeric($this->lembur->EditValue)) {
                $this->lembur->EditValue = FormatNumber($this->lembur->EditValue, null);
            }

            // kehadiran
            $this->kehadiran->setupEditAttributes();
            $this->kehadiran->EditCustomAttributes = "";
            $this->kehadiran->EditValue = HtmlEncode($this->kehadiran->CurrentValue);
            $this->kehadiran->PlaceHolder = RemoveHtml($this->kehadiran->caption());
            if (strval($this->kehadiran->EditValue) != "" && is_numeric($this->kehadiran->EditValue)) {
                $this->kehadiran->EditValue = FormatNumber($this->kehadiran->EditValue, null);
            }

            // piket_count
            $this->piket_count->setupEditAttributes();
            $this->piket_count->EditCustomAttributes = "";
            $this->piket_count->EditValue = HtmlEncode($this->piket_count->CurrentValue);
            $this->piket_count->PlaceHolder = RemoveHtml($this->piket_count->caption());
            if (strval($this->piket_count->EditValue) != "" && is_numeric($this->piket_count->EditValue)) {
                $this->piket_count->EditValue = FormatNumber($this->piket_count->EditValue, null);
            }

            // month
            $this->month->setupEditAttributes();
            $this->month->EditCustomAttributes = "";
            if (!$this->month->Raw) {
                $this->month->CurrentValue = HtmlDecode($this->month->CurrentValue);
            }
            $this->month->EditValue = HtmlEncode($this->month->CurrentValue);
            $this->month->PlaceHolder = RemoveHtml($this->month->caption());

            // datetime

            // Add refer script

            // jabatan_id
            $this->jabatan_id->LinkCustomAttributes = "";
            $this->jabatan_id->HrefValue = "";

            // pegawai
            $this->pegawai->LinkCustomAttributes = "";
            $this->pegawai->HrefValue = "";

            // lembur
            $this->lembur->LinkCustomAttributes = "";
            $this->lembur->HrefValue = "";

            // kehadiran
            $this->kehadiran->LinkCustomAttributes = "";
            $this->kehadiran->HrefValue = "";

            // piket_count
            $this->piket_count->LinkCustomAttributes = "";
            $this->piket_count->HrefValue = "";

            // month
            $this->month->LinkCustomAttributes = "";
            $this->month->HrefValue = "";

            // datetime
            $this->datetime->LinkCustomAttributes = "";
            $this->datetime->HrefValue = "";
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
        if ($this->jabatan_id->Required) {
            if (!$this->jabatan_id->IsDetailKey && EmptyValue($this->jabatan_id->FormValue)) {
                $this->jabatan_id->addErrorMessage(str_replace("%s", $this->jabatan_id->caption(), $this->jabatan_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jabatan_id->FormValue)) {
            $this->jabatan_id->addErrorMessage($this->jabatan_id->getErrorMessage(false));
        }
        if ($this->pegawai->Required) {
            if (!$this->pegawai->IsDetailKey && EmptyValue($this->pegawai->FormValue)) {
                $this->pegawai->addErrorMessage(str_replace("%s", $this->pegawai->caption(), $this->pegawai->RequiredErrorMessage));
            }
        }
        if ($this->lembur->Required) {
            if (!$this->lembur->IsDetailKey && EmptyValue($this->lembur->FormValue)) {
                $this->lembur->addErrorMessage(str_replace("%s", $this->lembur->caption(), $this->lembur->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->lembur->FormValue)) {
            $this->lembur->addErrorMessage($this->lembur->getErrorMessage(false));
        }
        if ($this->kehadiran->Required) {
            if (!$this->kehadiran->IsDetailKey && EmptyValue($this->kehadiran->FormValue)) {
                $this->kehadiran->addErrorMessage(str_replace("%s", $this->kehadiran->caption(), $this->kehadiran->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->kehadiran->FormValue)) {
            $this->kehadiran->addErrorMessage($this->kehadiran->getErrorMessage(false));
        }
        if ($this->piket_count->Required) {
            if (!$this->piket_count->IsDetailKey && EmptyValue($this->piket_count->FormValue)) {
                $this->piket_count->addErrorMessage(str_replace("%s", $this->piket_count->caption(), $this->piket_count->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->piket_count->FormValue)) {
            $this->piket_count->addErrorMessage($this->piket_count->getErrorMessage(false));
        }
        if ($this->month->Required) {
            if (!$this->month->IsDetailKey && EmptyValue($this->month->FormValue)) {
                $this->month->addErrorMessage(str_replace("%s", $this->month->caption(), $this->month->RequiredErrorMessage));
            }
        }
        if ($this->datetime->Required) {
            if (!$this->datetime->IsDetailKey && EmptyValue($this->datetime->FormValue)) {
                $this->datetime->addErrorMessage(str_replace("%s", $this->datetime->caption(), $this->datetime->RequiredErrorMessage));
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

        // jabatan_id
        $this->jabatan_id->setDbValueDef($rsnew, $this->jabatan_id->CurrentValue, null, false);

        // pegawai
        $this->pegawai->setDbValueDef($rsnew, $this->pegawai->CurrentValue, null, false);

        // lembur
        $this->lembur->setDbValueDef($rsnew, $this->lembur->CurrentValue, null, false);

        // kehadiran
        $this->kehadiran->setDbValueDef($rsnew, $this->kehadiran->CurrentValue, null, false);

        // piket_count
        $this->piket_count->setDbValueDef($rsnew, $this->piket_count->CurrentValue, null, false);

        // month
        $this->month->setDbValueDef($rsnew, $this->month->CurrentValue, null, false);

        // datetime
        $this->datetime->CurrentValue = CurrentDateTime();
        $this->datetime->setDbValueDef($rsnew, $this->datetime->CurrentValue, null);

        // Update current values
        $this->setCurrentValues($rsnew);
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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("GajiList"), "", $this->TableVar, true);
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
                case "x_jabatan_id":
                    break;
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
