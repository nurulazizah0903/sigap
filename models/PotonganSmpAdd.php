<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PotonganSmpAdd extends PotonganSmp
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'potongan_smp';

    // Page object name
    public $PageObjName = "PotonganSmpAdd";

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

        // Table object (potongan_smp)
        if (!isset($GLOBALS["potongan_smp"]) || get_class($GLOBALS["potongan_smp"]) == PROJECT_NAMESPACE . "potongan_smp") {
            $GLOBALS["potongan_smp"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'potongan_smp');
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
                $tbl = Container("potongan_smp");
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
                    if ($pageName == "PotonganSmpView") {
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
        $this->month->setVisibility();
        $this->jenjang_id->setVisibility();
        $this->jabatan_id->setVisibility();
        $this->nama->setVisibility();
        $this->terlambat->setVisibility();
        $this->value_terlambat->setVisibility();
        $this->izin->setVisibility();
        $this->value_izin->setVisibility();
        $this->izinperjam->setVisibility();
        $this->izinperjamvalue->setVisibility();
        $this->sakit->setVisibility();
        $this->value_sakit->setVisibility();
        $this->sakitperjam->setVisibility();
        $this->sakitperjamvalue->setVisibility();
        $this->pulcep->setVisibility();
        $this->value_pulcep->setVisibility();
        $this->tidakhadir->setVisibility();
        $this->value_tidakhadir->setVisibility();
        $this->tidakhadirjam->setVisibility();
        $this->tidakhadirjamvalue->setVisibility();
        $this->total->setVisibility();
        $this->u_by->setVisibility();
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
                    $this->terminate("PotonganSmpList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "PotonganSmpList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "PotonganSmpView") {
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

        // Check field name 'month' first before field var 'x_month'
        $val = $CurrentForm->hasValue("month") ? $CurrentForm->getValue("month") : $CurrentForm->getValue("x_month");
        if (!$this->month->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->month->Visible = false; // Disable update for API request
            } else {
                $this->month->setFormValue($val);
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

        // Check field name 'jabatan_id' first before field var 'x_jabatan_id'
        $val = $CurrentForm->hasValue("jabatan_id") ? $CurrentForm->getValue("jabatan_id") : $CurrentForm->getValue("x_jabatan_id");
        if (!$this->jabatan_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jabatan_id->Visible = false; // Disable update for API request
            } else {
                $this->jabatan_id->setFormValue($val, true, $validate);
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

        // Check field name 'terlambat' first before field var 'x_terlambat'
        $val = $CurrentForm->hasValue("terlambat") ? $CurrentForm->getValue("terlambat") : $CurrentForm->getValue("x_terlambat");
        if (!$this->terlambat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->terlambat->Visible = false; // Disable update for API request
            } else {
                $this->terlambat->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'value_terlambat' first before field var 'x_value_terlambat'
        $val = $CurrentForm->hasValue("value_terlambat") ? $CurrentForm->getValue("value_terlambat") : $CurrentForm->getValue("x_value_terlambat");
        if (!$this->value_terlambat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->value_terlambat->Visible = false; // Disable update for API request
            } else {
                $this->value_terlambat->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'izin' first before field var 'x_izin'
        $val = $CurrentForm->hasValue("izin") ? $CurrentForm->getValue("izin") : $CurrentForm->getValue("x_izin");
        if (!$this->izin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->izin->Visible = false; // Disable update for API request
            } else {
                $this->izin->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'value_izin' first before field var 'x_value_izin'
        $val = $CurrentForm->hasValue("value_izin") ? $CurrentForm->getValue("value_izin") : $CurrentForm->getValue("x_value_izin");
        if (!$this->value_izin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->value_izin->Visible = false; // Disable update for API request
            } else {
                $this->value_izin->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'izinperjam' first before field var 'x_izinperjam'
        $val = $CurrentForm->hasValue("izinperjam") ? $CurrentForm->getValue("izinperjam") : $CurrentForm->getValue("x_izinperjam");
        if (!$this->izinperjam->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->izinperjam->Visible = false; // Disable update for API request
            } else {
                $this->izinperjam->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'izinperjamvalue' first before field var 'x_izinperjamvalue'
        $val = $CurrentForm->hasValue("izinperjamvalue") ? $CurrentForm->getValue("izinperjamvalue") : $CurrentForm->getValue("x_izinperjamvalue");
        if (!$this->izinperjamvalue->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->izinperjamvalue->Visible = false; // Disable update for API request
            } else {
                $this->izinperjamvalue->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'sakit' first before field var 'x_sakit'
        $val = $CurrentForm->hasValue("sakit") ? $CurrentForm->getValue("sakit") : $CurrentForm->getValue("x_sakit");
        if (!$this->sakit->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sakit->Visible = false; // Disable update for API request
            } else {
                $this->sakit->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'value_sakit' first before field var 'x_value_sakit'
        $val = $CurrentForm->hasValue("value_sakit") ? $CurrentForm->getValue("value_sakit") : $CurrentForm->getValue("x_value_sakit");
        if (!$this->value_sakit->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->value_sakit->Visible = false; // Disable update for API request
            } else {
                $this->value_sakit->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'sakitperjam' first before field var 'x_sakitperjam'
        $val = $CurrentForm->hasValue("sakitperjam") ? $CurrentForm->getValue("sakitperjam") : $CurrentForm->getValue("x_sakitperjam");
        if (!$this->sakitperjam->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sakitperjam->Visible = false; // Disable update for API request
            } else {
                $this->sakitperjam->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'sakitperjamvalue' first before field var 'x_sakitperjamvalue'
        $val = $CurrentForm->hasValue("sakitperjamvalue") ? $CurrentForm->getValue("sakitperjamvalue") : $CurrentForm->getValue("x_sakitperjamvalue");
        if (!$this->sakitperjamvalue->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sakitperjamvalue->Visible = false; // Disable update for API request
            } else {
                $this->sakitperjamvalue->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'pulcep' first before field var 'x_pulcep'
        $val = $CurrentForm->hasValue("pulcep") ? $CurrentForm->getValue("pulcep") : $CurrentForm->getValue("x_pulcep");
        if (!$this->pulcep->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pulcep->Visible = false; // Disable update for API request
            } else {
                $this->pulcep->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'value_pulcep' first before field var 'x_value_pulcep'
        $val = $CurrentForm->hasValue("value_pulcep") ? $CurrentForm->getValue("value_pulcep") : $CurrentForm->getValue("x_value_pulcep");
        if (!$this->value_pulcep->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->value_pulcep->Visible = false; // Disable update for API request
            } else {
                $this->value_pulcep->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'tidakhadir' first before field var 'x_tidakhadir'
        $val = $CurrentForm->hasValue("tidakhadir") ? $CurrentForm->getValue("tidakhadir") : $CurrentForm->getValue("x_tidakhadir");
        if (!$this->tidakhadir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tidakhadir->Visible = false; // Disable update for API request
            } else {
                $this->tidakhadir->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'value_tidakhadir' first before field var 'x_value_tidakhadir'
        $val = $CurrentForm->hasValue("value_tidakhadir") ? $CurrentForm->getValue("value_tidakhadir") : $CurrentForm->getValue("x_value_tidakhadir");
        if (!$this->value_tidakhadir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->value_tidakhadir->Visible = false; // Disable update for API request
            } else {
                $this->value_tidakhadir->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'tidakhadirjam' first before field var 'x_tidakhadirjam'
        $val = $CurrentForm->hasValue("tidakhadirjam") ? $CurrentForm->getValue("tidakhadirjam") : $CurrentForm->getValue("x_tidakhadirjam");
        if (!$this->tidakhadirjam->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tidakhadirjam->Visible = false; // Disable update for API request
            } else {
                $this->tidakhadirjam->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'tidakhadirjamvalue' first before field var 'x_tidakhadirjamvalue'
        $val = $CurrentForm->hasValue("tidakhadirjamvalue") ? $CurrentForm->getValue("tidakhadirjamvalue") : $CurrentForm->getValue("x_tidakhadirjamvalue");
        if (!$this->tidakhadirjamvalue->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tidakhadirjamvalue->Visible = false; // Disable update for API request
            } else {
                $this->tidakhadirjamvalue->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'total' first before field var 'x_total'
        $val = $CurrentForm->hasValue("total") ? $CurrentForm->getValue("total") : $CurrentForm->getValue("x_total");
        if (!$this->total->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->total->Visible = false; // Disable update for API request
            } else {
                $this->total->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'u_by' first before field var 'x_u_by'
        $val = $CurrentForm->hasValue("u_by") ? $CurrentForm->getValue("u_by") : $CurrentForm->getValue("x_u_by");
        if (!$this->u_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->u_by->Visible = false; // Disable update for API request
            } else {
                $this->u_by->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'datetime' first before field var 'x_datetime'
        $val = $CurrentForm->hasValue("datetime") ? $CurrentForm->getValue("datetime") : $CurrentForm->getValue("x_datetime");
        if (!$this->datetime->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->datetime->Visible = false; // Disable update for API request
            } else {
                $this->datetime->setFormValue($val, true, $validate);
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
        $this->month->CurrentValue = $this->month->FormValue;
        $this->jenjang_id->CurrentValue = $this->jenjang_id->FormValue;
        $this->jabatan_id->CurrentValue = $this->jabatan_id->FormValue;
        $this->nama->CurrentValue = $this->nama->FormValue;
        $this->terlambat->CurrentValue = $this->terlambat->FormValue;
        $this->value_terlambat->CurrentValue = $this->value_terlambat->FormValue;
        $this->izin->CurrentValue = $this->izin->FormValue;
        $this->value_izin->CurrentValue = $this->value_izin->FormValue;
        $this->izinperjam->CurrentValue = $this->izinperjam->FormValue;
        $this->izinperjamvalue->CurrentValue = $this->izinperjamvalue->FormValue;
        $this->sakit->CurrentValue = $this->sakit->FormValue;
        $this->value_sakit->CurrentValue = $this->value_sakit->FormValue;
        $this->sakitperjam->CurrentValue = $this->sakitperjam->FormValue;
        $this->sakitperjamvalue->CurrentValue = $this->sakitperjamvalue->FormValue;
        $this->pulcep->CurrentValue = $this->pulcep->FormValue;
        $this->value_pulcep->CurrentValue = $this->value_pulcep->FormValue;
        $this->tidakhadir->CurrentValue = $this->tidakhadir->FormValue;
        $this->value_tidakhadir->CurrentValue = $this->value_tidakhadir->FormValue;
        $this->tidakhadirjam->CurrentValue = $this->tidakhadirjam->FormValue;
        $this->tidakhadirjamvalue->CurrentValue = $this->tidakhadirjamvalue->FormValue;
        $this->total->CurrentValue = $this->total->FormValue;
        $this->u_by->CurrentValue = $this->u_by->FormValue;
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
        $this->month->setDbValue($row['month']);
        $this->jenjang_id->setDbValue($row['jenjang_id']);
        $this->jabatan_id->setDbValue($row['jabatan_id']);
        $this->nama->setDbValue($row['nama']);
        $this->terlambat->setDbValue($row['terlambat']);
        $this->value_terlambat->setDbValue($row['value_terlambat']);
        $this->izin->setDbValue($row['izin']);
        $this->value_izin->setDbValue($row['value_izin']);
        $this->izinperjam->setDbValue($row['izinperjam']);
        $this->izinperjamvalue->setDbValue($row['izinperjamvalue']);
        $this->sakit->setDbValue($row['sakit']);
        $this->value_sakit->setDbValue($row['value_sakit']);
        $this->sakitperjam->setDbValue($row['sakitperjam']);
        $this->sakitperjamvalue->setDbValue($row['sakitperjamvalue']);
        $this->pulcep->setDbValue($row['pulcep']);
        $this->value_pulcep->setDbValue($row['value_pulcep']);
        $this->tidakhadir->setDbValue($row['tidakhadir']);
        $this->value_tidakhadir->setDbValue($row['value_tidakhadir']);
        $this->tidakhadirjam->setDbValue($row['tidakhadirjam']);
        $this->tidakhadirjamvalue->setDbValue($row['tidakhadirjamvalue']);
        $this->total->setDbValue($row['total']);
        $this->u_by->setDbValue($row['u_by']);
        $this->datetime->setDbValue($row['datetime']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['month'] = $this->month->DefaultValue;
        $row['jenjang_id'] = $this->jenjang_id->DefaultValue;
        $row['jabatan_id'] = $this->jabatan_id->DefaultValue;
        $row['nama'] = $this->nama->DefaultValue;
        $row['terlambat'] = $this->terlambat->DefaultValue;
        $row['value_terlambat'] = $this->value_terlambat->DefaultValue;
        $row['izin'] = $this->izin->DefaultValue;
        $row['value_izin'] = $this->value_izin->DefaultValue;
        $row['izinperjam'] = $this->izinperjam->DefaultValue;
        $row['izinperjamvalue'] = $this->izinperjamvalue->DefaultValue;
        $row['sakit'] = $this->sakit->DefaultValue;
        $row['value_sakit'] = $this->value_sakit->DefaultValue;
        $row['sakitperjam'] = $this->sakitperjam->DefaultValue;
        $row['sakitperjamvalue'] = $this->sakitperjamvalue->DefaultValue;
        $row['pulcep'] = $this->pulcep->DefaultValue;
        $row['value_pulcep'] = $this->value_pulcep->DefaultValue;
        $row['tidakhadir'] = $this->tidakhadir->DefaultValue;
        $row['value_tidakhadir'] = $this->value_tidakhadir->DefaultValue;
        $row['tidakhadirjam'] = $this->tidakhadirjam->DefaultValue;
        $row['tidakhadirjamvalue'] = $this->tidakhadirjamvalue->DefaultValue;
        $row['total'] = $this->total->DefaultValue;
        $row['u_by'] = $this->u_by->DefaultValue;
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

        // month
        $this->month->RowCssClass = "row";

        // jenjang_id
        $this->jenjang_id->RowCssClass = "row";

        // jabatan_id
        $this->jabatan_id->RowCssClass = "row";

        // nama
        $this->nama->RowCssClass = "row";

        // terlambat
        $this->terlambat->RowCssClass = "row";

        // value_terlambat
        $this->value_terlambat->RowCssClass = "row";

        // izin
        $this->izin->RowCssClass = "row";

        // value_izin
        $this->value_izin->RowCssClass = "row";

        // izinperjam
        $this->izinperjam->RowCssClass = "row";

        // izinperjamvalue
        $this->izinperjamvalue->RowCssClass = "row";

        // sakit
        $this->sakit->RowCssClass = "row";

        // value_sakit
        $this->value_sakit->RowCssClass = "row";

        // sakitperjam
        $this->sakitperjam->RowCssClass = "row";

        // sakitperjamvalue
        $this->sakitperjamvalue->RowCssClass = "row";

        // pulcep
        $this->pulcep->RowCssClass = "row";

        // value_pulcep
        $this->value_pulcep->RowCssClass = "row";

        // tidakhadir
        $this->tidakhadir->RowCssClass = "row";

        // value_tidakhadir
        $this->value_tidakhadir->RowCssClass = "row";

        // tidakhadirjam
        $this->tidakhadirjam->RowCssClass = "row";

        // tidakhadirjamvalue
        $this->tidakhadirjamvalue->RowCssClass = "row";

        // total
        $this->total->RowCssClass = "row";

        // u_by
        $this->u_by->RowCssClass = "row";

        // datetime
        $this->datetime->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // month
            $this->month->ViewValue = $this->month->CurrentValue;
            $this->month->ViewCustomAttributes = "";

            // jenjang_id
            $this->jenjang_id->ViewValue = $this->jenjang_id->CurrentValue;
            $this->jenjang_id->ViewValue = FormatNumber($this->jenjang_id->ViewValue, $this->jenjang_id->formatPattern());
            $this->jenjang_id->ViewCustomAttributes = "";

            // jabatan_id
            $this->jabatan_id->ViewValue = $this->jabatan_id->CurrentValue;
            $this->jabatan_id->ViewValue = FormatNumber($this->jabatan_id->ViewValue, $this->jabatan_id->formatPattern());
            $this->jabatan_id->ViewCustomAttributes = "";

            // nama
            $this->nama->ViewValue = $this->nama->CurrentValue;
            $this->nama->ViewCustomAttributes = "";

            // terlambat
            $this->terlambat->ViewValue = $this->terlambat->CurrentValue;
            $this->terlambat->ViewValue = FormatNumber($this->terlambat->ViewValue, $this->terlambat->formatPattern());
            $this->terlambat->ViewCustomAttributes = "";

            // value_terlambat
            $this->value_terlambat->ViewValue = $this->value_terlambat->CurrentValue;
            $this->value_terlambat->ViewValue = FormatNumber($this->value_terlambat->ViewValue, $this->value_terlambat->formatPattern());
            $this->value_terlambat->ViewCustomAttributes = "";

            // izin
            $this->izin->ViewValue = $this->izin->CurrentValue;
            $this->izin->ViewValue = FormatNumber($this->izin->ViewValue, $this->izin->formatPattern());
            $this->izin->ViewCustomAttributes = "";

            // value_izin
            $this->value_izin->ViewValue = $this->value_izin->CurrentValue;
            $this->value_izin->ViewValue = FormatNumber($this->value_izin->ViewValue, $this->value_izin->formatPattern());
            $this->value_izin->ViewCustomAttributes = "";

            // izinperjam
            $this->izinperjam->ViewValue = $this->izinperjam->CurrentValue;
            $this->izinperjam->ViewValue = FormatNumber($this->izinperjam->ViewValue, $this->izinperjam->formatPattern());
            $this->izinperjam->ViewCustomAttributes = "";

            // izinperjamvalue
            $this->izinperjamvalue->ViewValue = $this->izinperjamvalue->CurrentValue;
            $this->izinperjamvalue->ViewValue = FormatNumber($this->izinperjamvalue->ViewValue, $this->izinperjamvalue->formatPattern());
            $this->izinperjamvalue->ViewCustomAttributes = "";

            // sakit
            $this->sakit->ViewValue = $this->sakit->CurrentValue;
            $this->sakit->ViewValue = FormatNumber($this->sakit->ViewValue, $this->sakit->formatPattern());
            $this->sakit->ViewCustomAttributes = "";

            // value_sakit
            $this->value_sakit->ViewValue = $this->value_sakit->CurrentValue;
            $this->value_sakit->ViewValue = FormatNumber($this->value_sakit->ViewValue, $this->value_sakit->formatPattern());
            $this->value_sakit->ViewCustomAttributes = "";

            // sakitperjam
            $this->sakitperjam->ViewValue = $this->sakitperjam->CurrentValue;
            $this->sakitperjam->ViewValue = FormatNumber($this->sakitperjam->ViewValue, $this->sakitperjam->formatPattern());
            $this->sakitperjam->ViewCustomAttributes = "";

            // sakitperjamvalue
            $this->sakitperjamvalue->ViewValue = $this->sakitperjamvalue->CurrentValue;
            $this->sakitperjamvalue->ViewValue = FormatNumber($this->sakitperjamvalue->ViewValue, $this->sakitperjamvalue->formatPattern());
            $this->sakitperjamvalue->ViewCustomAttributes = "";

            // pulcep
            $this->pulcep->ViewValue = $this->pulcep->CurrentValue;
            $this->pulcep->ViewValue = FormatNumber($this->pulcep->ViewValue, $this->pulcep->formatPattern());
            $this->pulcep->ViewCustomAttributes = "";

            // value_pulcep
            $this->value_pulcep->ViewValue = $this->value_pulcep->CurrentValue;
            $this->value_pulcep->ViewValue = FormatNumber($this->value_pulcep->ViewValue, $this->value_pulcep->formatPattern());
            $this->value_pulcep->ViewCustomAttributes = "";

            // tidakhadir
            $this->tidakhadir->ViewValue = $this->tidakhadir->CurrentValue;
            $this->tidakhadir->ViewValue = FormatNumber($this->tidakhadir->ViewValue, $this->tidakhadir->formatPattern());
            $this->tidakhadir->ViewCustomAttributes = "";

            // value_tidakhadir
            $this->value_tidakhadir->ViewValue = $this->value_tidakhadir->CurrentValue;
            $this->value_tidakhadir->ViewValue = FormatNumber($this->value_tidakhadir->ViewValue, $this->value_tidakhadir->formatPattern());
            $this->value_tidakhadir->ViewCustomAttributes = "";

            // tidakhadirjam
            $this->tidakhadirjam->ViewValue = $this->tidakhadirjam->CurrentValue;
            $this->tidakhadirjam->ViewValue = FormatNumber($this->tidakhadirjam->ViewValue, $this->tidakhadirjam->formatPattern());
            $this->tidakhadirjam->ViewCustomAttributes = "";

            // tidakhadirjamvalue
            $this->tidakhadirjamvalue->ViewValue = $this->tidakhadirjamvalue->CurrentValue;
            $this->tidakhadirjamvalue->ViewValue = FormatNumber($this->tidakhadirjamvalue->ViewValue, $this->tidakhadirjamvalue->formatPattern());
            $this->tidakhadirjamvalue->ViewCustomAttributes = "";

            // total
            $this->total->ViewValue = $this->total->CurrentValue;
            $this->total->ViewValue = FormatNumber($this->total->ViewValue, $this->total->formatPattern());
            $this->total->ViewCustomAttributes = "";

            // u_by
            $this->u_by->ViewValue = $this->u_by->CurrentValue;
            $this->u_by->ViewValue = FormatNumber($this->u_by->ViewValue, $this->u_by->formatPattern());
            $this->u_by->ViewCustomAttributes = "";

            // datetime
            $this->datetime->ViewValue = $this->datetime->CurrentValue;
            $this->datetime->ViewValue = FormatDateTime($this->datetime->ViewValue, $this->datetime->formatPattern());
            $this->datetime->ViewCustomAttributes = "";

            // month
            $this->month->LinkCustomAttributes = "";
            $this->month->HrefValue = "";

            // jenjang_id
            $this->jenjang_id->LinkCustomAttributes = "";
            $this->jenjang_id->HrefValue = "";

            // jabatan_id
            $this->jabatan_id->LinkCustomAttributes = "";
            $this->jabatan_id->HrefValue = "";

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";

            // terlambat
            $this->terlambat->LinkCustomAttributes = "";
            $this->terlambat->HrefValue = "";

            // value_terlambat
            $this->value_terlambat->LinkCustomAttributes = "";
            $this->value_terlambat->HrefValue = "";

            // izin
            $this->izin->LinkCustomAttributes = "";
            $this->izin->HrefValue = "";

            // value_izin
            $this->value_izin->LinkCustomAttributes = "";
            $this->value_izin->HrefValue = "";

            // izinperjam
            $this->izinperjam->LinkCustomAttributes = "";
            $this->izinperjam->HrefValue = "";

            // izinperjamvalue
            $this->izinperjamvalue->LinkCustomAttributes = "";
            $this->izinperjamvalue->HrefValue = "";

            // sakit
            $this->sakit->LinkCustomAttributes = "";
            $this->sakit->HrefValue = "";

            // value_sakit
            $this->value_sakit->LinkCustomAttributes = "";
            $this->value_sakit->HrefValue = "";

            // sakitperjam
            $this->sakitperjam->LinkCustomAttributes = "";
            $this->sakitperjam->HrefValue = "";

            // sakitperjamvalue
            $this->sakitperjamvalue->LinkCustomAttributes = "";
            $this->sakitperjamvalue->HrefValue = "";

            // pulcep
            $this->pulcep->LinkCustomAttributes = "";
            $this->pulcep->HrefValue = "";

            // value_pulcep
            $this->value_pulcep->LinkCustomAttributes = "";
            $this->value_pulcep->HrefValue = "";

            // tidakhadir
            $this->tidakhadir->LinkCustomAttributes = "";
            $this->tidakhadir->HrefValue = "";

            // value_tidakhadir
            $this->value_tidakhadir->LinkCustomAttributes = "";
            $this->value_tidakhadir->HrefValue = "";

            // tidakhadirjam
            $this->tidakhadirjam->LinkCustomAttributes = "";
            $this->tidakhadirjam->HrefValue = "";

            // tidakhadirjamvalue
            $this->tidakhadirjamvalue->LinkCustomAttributes = "";
            $this->tidakhadirjamvalue->HrefValue = "";

            // total
            $this->total->LinkCustomAttributes = "";
            $this->total->HrefValue = "";

            // u_by
            $this->u_by->LinkCustomAttributes = "";
            $this->u_by->HrefValue = "";

            // datetime
            $this->datetime->LinkCustomAttributes = "";
            $this->datetime->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // month
            $this->month->setupEditAttributes();
            $this->month->EditCustomAttributes = "";
            if (!$this->month->Raw) {
                $this->month->CurrentValue = HtmlDecode($this->month->CurrentValue);
            }
            $this->month->EditValue = HtmlEncode($this->month->CurrentValue);
            $this->month->PlaceHolder = RemoveHtml($this->month->caption());

            // jenjang_id
            $this->jenjang_id->setupEditAttributes();
            $this->jenjang_id->EditCustomAttributes = "";
            $this->jenjang_id->EditValue = HtmlEncode($this->jenjang_id->CurrentValue);
            $this->jenjang_id->PlaceHolder = RemoveHtml($this->jenjang_id->caption());
            if (strval($this->jenjang_id->EditValue) != "" && is_numeric($this->jenjang_id->EditValue)) {
                $this->jenjang_id->EditValue = FormatNumber($this->jenjang_id->EditValue, null);
            }

            // jabatan_id
            $this->jabatan_id->setupEditAttributes();
            $this->jabatan_id->EditCustomAttributes = "";
            $this->jabatan_id->EditValue = HtmlEncode($this->jabatan_id->CurrentValue);
            $this->jabatan_id->PlaceHolder = RemoveHtml($this->jabatan_id->caption());
            if (strval($this->jabatan_id->EditValue) != "" && is_numeric($this->jabatan_id->EditValue)) {
                $this->jabatan_id->EditValue = FormatNumber($this->jabatan_id->EditValue, null);
            }

            // nama
            $this->nama->setupEditAttributes();
            $this->nama->EditCustomAttributes = "";
            if (!$this->nama->Raw) {
                $this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
            }
            $this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
            $this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

            // terlambat
            $this->terlambat->setupEditAttributes();
            $this->terlambat->EditCustomAttributes = "";
            $this->terlambat->EditValue = HtmlEncode($this->terlambat->CurrentValue);
            $this->terlambat->PlaceHolder = RemoveHtml($this->terlambat->caption());
            if (strval($this->terlambat->EditValue) != "" && is_numeric($this->terlambat->EditValue)) {
                $this->terlambat->EditValue = FormatNumber($this->terlambat->EditValue, null);
            }

            // value_terlambat
            $this->value_terlambat->setupEditAttributes();
            $this->value_terlambat->EditCustomAttributes = "";
            $this->value_terlambat->EditValue = HtmlEncode($this->value_terlambat->CurrentValue);
            $this->value_terlambat->PlaceHolder = RemoveHtml($this->value_terlambat->caption());
            if (strval($this->value_terlambat->EditValue) != "" && is_numeric($this->value_terlambat->EditValue)) {
                $this->value_terlambat->EditValue = FormatNumber($this->value_terlambat->EditValue, null);
            }

            // izin
            $this->izin->setupEditAttributes();
            $this->izin->EditCustomAttributes = "";
            $this->izin->EditValue = HtmlEncode($this->izin->CurrentValue);
            $this->izin->PlaceHolder = RemoveHtml($this->izin->caption());
            if (strval($this->izin->EditValue) != "" && is_numeric($this->izin->EditValue)) {
                $this->izin->EditValue = FormatNumber($this->izin->EditValue, null);
            }

            // value_izin
            $this->value_izin->setupEditAttributes();
            $this->value_izin->EditCustomAttributes = "";
            $this->value_izin->EditValue = HtmlEncode($this->value_izin->CurrentValue);
            $this->value_izin->PlaceHolder = RemoveHtml($this->value_izin->caption());
            if (strval($this->value_izin->EditValue) != "" && is_numeric($this->value_izin->EditValue)) {
                $this->value_izin->EditValue = FormatNumber($this->value_izin->EditValue, null);
            }

            // izinperjam
            $this->izinperjam->setupEditAttributes();
            $this->izinperjam->EditCustomAttributes = "";
            $this->izinperjam->EditValue = HtmlEncode($this->izinperjam->CurrentValue);
            $this->izinperjam->PlaceHolder = RemoveHtml($this->izinperjam->caption());
            if (strval($this->izinperjam->EditValue) != "" && is_numeric($this->izinperjam->EditValue)) {
                $this->izinperjam->EditValue = FormatNumber($this->izinperjam->EditValue, null);
            }

            // izinperjamvalue
            $this->izinperjamvalue->setupEditAttributes();
            $this->izinperjamvalue->EditCustomAttributes = "";
            $this->izinperjamvalue->EditValue = HtmlEncode($this->izinperjamvalue->CurrentValue);
            $this->izinperjamvalue->PlaceHolder = RemoveHtml($this->izinperjamvalue->caption());
            if (strval($this->izinperjamvalue->EditValue) != "" && is_numeric($this->izinperjamvalue->EditValue)) {
                $this->izinperjamvalue->EditValue = FormatNumber($this->izinperjamvalue->EditValue, null);
            }

            // sakit
            $this->sakit->setupEditAttributes();
            $this->sakit->EditCustomAttributes = "";
            $this->sakit->EditValue = HtmlEncode($this->sakit->CurrentValue);
            $this->sakit->PlaceHolder = RemoveHtml($this->sakit->caption());
            if (strval($this->sakit->EditValue) != "" && is_numeric($this->sakit->EditValue)) {
                $this->sakit->EditValue = FormatNumber($this->sakit->EditValue, null);
            }

            // value_sakit
            $this->value_sakit->setupEditAttributes();
            $this->value_sakit->EditCustomAttributes = "";
            $this->value_sakit->EditValue = HtmlEncode($this->value_sakit->CurrentValue);
            $this->value_sakit->PlaceHolder = RemoveHtml($this->value_sakit->caption());
            if (strval($this->value_sakit->EditValue) != "" && is_numeric($this->value_sakit->EditValue)) {
                $this->value_sakit->EditValue = FormatNumber($this->value_sakit->EditValue, null);
            }

            // sakitperjam
            $this->sakitperjam->setupEditAttributes();
            $this->sakitperjam->EditCustomAttributes = "";
            $this->sakitperjam->EditValue = HtmlEncode($this->sakitperjam->CurrentValue);
            $this->sakitperjam->PlaceHolder = RemoveHtml($this->sakitperjam->caption());
            if (strval($this->sakitperjam->EditValue) != "" && is_numeric($this->sakitperjam->EditValue)) {
                $this->sakitperjam->EditValue = FormatNumber($this->sakitperjam->EditValue, null);
            }

            // sakitperjamvalue
            $this->sakitperjamvalue->setupEditAttributes();
            $this->sakitperjamvalue->EditCustomAttributes = "";
            $this->sakitperjamvalue->EditValue = HtmlEncode($this->sakitperjamvalue->CurrentValue);
            $this->sakitperjamvalue->PlaceHolder = RemoveHtml($this->sakitperjamvalue->caption());
            if (strval($this->sakitperjamvalue->EditValue) != "" && is_numeric($this->sakitperjamvalue->EditValue)) {
                $this->sakitperjamvalue->EditValue = FormatNumber($this->sakitperjamvalue->EditValue, null);
            }

            // pulcep
            $this->pulcep->setupEditAttributes();
            $this->pulcep->EditCustomAttributes = "";
            $this->pulcep->EditValue = HtmlEncode($this->pulcep->CurrentValue);
            $this->pulcep->PlaceHolder = RemoveHtml($this->pulcep->caption());
            if (strval($this->pulcep->EditValue) != "" && is_numeric($this->pulcep->EditValue)) {
                $this->pulcep->EditValue = FormatNumber($this->pulcep->EditValue, null);
            }

            // value_pulcep
            $this->value_pulcep->setupEditAttributes();
            $this->value_pulcep->EditCustomAttributes = "";
            $this->value_pulcep->EditValue = HtmlEncode($this->value_pulcep->CurrentValue);
            $this->value_pulcep->PlaceHolder = RemoveHtml($this->value_pulcep->caption());
            if (strval($this->value_pulcep->EditValue) != "" && is_numeric($this->value_pulcep->EditValue)) {
                $this->value_pulcep->EditValue = FormatNumber($this->value_pulcep->EditValue, null);
            }

            // tidakhadir
            $this->tidakhadir->setupEditAttributes();
            $this->tidakhadir->EditCustomAttributes = "";
            $this->tidakhadir->EditValue = HtmlEncode($this->tidakhadir->CurrentValue);
            $this->tidakhadir->PlaceHolder = RemoveHtml($this->tidakhadir->caption());
            if (strval($this->tidakhadir->EditValue) != "" && is_numeric($this->tidakhadir->EditValue)) {
                $this->tidakhadir->EditValue = FormatNumber($this->tidakhadir->EditValue, null);
            }

            // value_tidakhadir
            $this->value_tidakhadir->setupEditAttributes();
            $this->value_tidakhadir->EditCustomAttributes = "";
            $this->value_tidakhadir->EditValue = HtmlEncode($this->value_tidakhadir->CurrentValue);
            $this->value_tidakhadir->PlaceHolder = RemoveHtml($this->value_tidakhadir->caption());
            if (strval($this->value_tidakhadir->EditValue) != "" && is_numeric($this->value_tidakhadir->EditValue)) {
                $this->value_tidakhadir->EditValue = FormatNumber($this->value_tidakhadir->EditValue, null);
            }

            // tidakhadirjam
            $this->tidakhadirjam->setupEditAttributes();
            $this->tidakhadirjam->EditCustomAttributes = "";
            $this->tidakhadirjam->EditValue = HtmlEncode($this->tidakhadirjam->CurrentValue);
            $this->tidakhadirjam->PlaceHolder = RemoveHtml($this->tidakhadirjam->caption());
            if (strval($this->tidakhadirjam->EditValue) != "" && is_numeric($this->tidakhadirjam->EditValue)) {
                $this->tidakhadirjam->EditValue = FormatNumber($this->tidakhadirjam->EditValue, null);
            }

            // tidakhadirjamvalue
            $this->tidakhadirjamvalue->setupEditAttributes();
            $this->tidakhadirjamvalue->EditCustomAttributes = "";
            $this->tidakhadirjamvalue->EditValue = HtmlEncode($this->tidakhadirjamvalue->CurrentValue);
            $this->tidakhadirjamvalue->PlaceHolder = RemoveHtml($this->tidakhadirjamvalue->caption());
            if (strval($this->tidakhadirjamvalue->EditValue) != "" && is_numeric($this->tidakhadirjamvalue->EditValue)) {
                $this->tidakhadirjamvalue->EditValue = FormatNumber($this->tidakhadirjamvalue->EditValue, null);
            }

            // total
            $this->total->setupEditAttributes();
            $this->total->EditCustomAttributes = "";
            $this->total->EditValue = HtmlEncode($this->total->CurrentValue);
            $this->total->PlaceHolder = RemoveHtml($this->total->caption());
            if (strval($this->total->EditValue) != "" && is_numeric($this->total->EditValue)) {
                $this->total->EditValue = FormatNumber($this->total->EditValue, null);
            }

            // u_by
            $this->u_by->setupEditAttributes();
            $this->u_by->EditCustomAttributes = "";
            $this->u_by->EditValue = HtmlEncode($this->u_by->CurrentValue);
            $this->u_by->PlaceHolder = RemoveHtml($this->u_by->caption());
            if (strval($this->u_by->EditValue) != "" && is_numeric($this->u_by->EditValue)) {
                $this->u_by->EditValue = FormatNumber($this->u_by->EditValue, null);
            }

            // datetime
            $this->datetime->setupEditAttributes();
            $this->datetime->EditCustomAttributes = "";
            $this->datetime->EditValue = HtmlEncode(FormatDateTime($this->datetime->CurrentValue, $this->datetime->formatPattern()));
            $this->datetime->PlaceHolder = RemoveHtml($this->datetime->caption());

            // Add refer script

            // month
            $this->month->LinkCustomAttributes = "";
            $this->month->HrefValue = "";

            // jenjang_id
            $this->jenjang_id->LinkCustomAttributes = "";
            $this->jenjang_id->HrefValue = "";

            // jabatan_id
            $this->jabatan_id->LinkCustomAttributes = "";
            $this->jabatan_id->HrefValue = "";

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";

            // terlambat
            $this->terlambat->LinkCustomAttributes = "";
            $this->terlambat->HrefValue = "";

            // value_terlambat
            $this->value_terlambat->LinkCustomAttributes = "";
            $this->value_terlambat->HrefValue = "";

            // izin
            $this->izin->LinkCustomAttributes = "";
            $this->izin->HrefValue = "";

            // value_izin
            $this->value_izin->LinkCustomAttributes = "";
            $this->value_izin->HrefValue = "";

            // izinperjam
            $this->izinperjam->LinkCustomAttributes = "";
            $this->izinperjam->HrefValue = "";

            // izinperjamvalue
            $this->izinperjamvalue->LinkCustomAttributes = "";
            $this->izinperjamvalue->HrefValue = "";

            // sakit
            $this->sakit->LinkCustomAttributes = "";
            $this->sakit->HrefValue = "";

            // value_sakit
            $this->value_sakit->LinkCustomAttributes = "";
            $this->value_sakit->HrefValue = "";

            // sakitperjam
            $this->sakitperjam->LinkCustomAttributes = "";
            $this->sakitperjam->HrefValue = "";

            // sakitperjamvalue
            $this->sakitperjamvalue->LinkCustomAttributes = "";
            $this->sakitperjamvalue->HrefValue = "";

            // pulcep
            $this->pulcep->LinkCustomAttributes = "";
            $this->pulcep->HrefValue = "";

            // value_pulcep
            $this->value_pulcep->LinkCustomAttributes = "";
            $this->value_pulcep->HrefValue = "";

            // tidakhadir
            $this->tidakhadir->LinkCustomAttributes = "";
            $this->tidakhadir->HrefValue = "";

            // value_tidakhadir
            $this->value_tidakhadir->LinkCustomAttributes = "";
            $this->value_tidakhadir->HrefValue = "";

            // tidakhadirjam
            $this->tidakhadirjam->LinkCustomAttributes = "";
            $this->tidakhadirjam->HrefValue = "";

            // tidakhadirjamvalue
            $this->tidakhadirjamvalue->LinkCustomAttributes = "";
            $this->tidakhadirjamvalue->HrefValue = "";

            // total
            $this->total->LinkCustomAttributes = "";
            $this->total->HrefValue = "";

            // u_by
            $this->u_by->LinkCustomAttributes = "";
            $this->u_by->HrefValue = "";

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
        if ($this->month->Required) {
            if (!$this->month->IsDetailKey && EmptyValue($this->month->FormValue)) {
                $this->month->addErrorMessage(str_replace("%s", $this->month->caption(), $this->month->RequiredErrorMessage));
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
        if ($this->jabatan_id->Required) {
            if (!$this->jabatan_id->IsDetailKey && EmptyValue($this->jabatan_id->FormValue)) {
                $this->jabatan_id->addErrorMessage(str_replace("%s", $this->jabatan_id->caption(), $this->jabatan_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jabatan_id->FormValue)) {
            $this->jabatan_id->addErrorMessage($this->jabatan_id->getErrorMessage(false));
        }
        if ($this->nama->Required) {
            if (!$this->nama->IsDetailKey && EmptyValue($this->nama->FormValue)) {
                $this->nama->addErrorMessage(str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
            }
        }
        if ($this->terlambat->Required) {
            if (!$this->terlambat->IsDetailKey && EmptyValue($this->terlambat->FormValue)) {
                $this->terlambat->addErrorMessage(str_replace("%s", $this->terlambat->caption(), $this->terlambat->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->terlambat->FormValue)) {
            $this->terlambat->addErrorMessage($this->terlambat->getErrorMessage(false));
        }
        if ($this->value_terlambat->Required) {
            if (!$this->value_terlambat->IsDetailKey && EmptyValue($this->value_terlambat->FormValue)) {
                $this->value_terlambat->addErrorMessage(str_replace("%s", $this->value_terlambat->caption(), $this->value_terlambat->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->value_terlambat->FormValue)) {
            $this->value_terlambat->addErrorMessage($this->value_terlambat->getErrorMessage(false));
        }
        if ($this->izin->Required) {
            if (!$this->izin->IsDetailKey && EmptyValue($this->izin->FormValue)) {
                $this->izin->addErrorMessage(str_replace("%s", $this->izin->caption(), $this->izin->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->izin->FormValue)) {
            $this->izin->addErrorMessage($this->izin->getErrorMessage(false));
        }
        if ($this->value_izin->Required) {
            if (!$this->value_izin->IsDetailKey && EmptyValue($this->value_izin->FormValue)) {
                $this->value_izin->addErrorMessage(str_replace("%s", $this->value_izin->caption(), $this->value_izin->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->value_izin->FormValue)) {
            $this->value_izin->addErrorMessage($this->value_izin->getErrorMessage(false));
        }
        if ($this->izinperjam->Required) {
            if (!$this->izinperjam->IsDetailKey && EmptyValue($this->izinperjam->FormValue)) {
                $this->izinperjam->addErrorMessage(str_replace("%s", $this->izinperjam->caption(), $this->izinperjam->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->izinperjam->FormValue)) {
            $this->izinperjam->addErrorMessage($this->izinperjam->getErrorMessage(false));
        }
        if ($this->izinperjamvalue->Required) {
            if (!$this->izinperjamvalue->IsDetailKey && EmptyValue($this->izinperjamvalue->FormValue)) {
                $this->izinperjamvalue->addErrorMessage(str_replace("%s", $this->izinperjamvalue->caption(), $this->izinperjamvalue->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->izinperjamvalue->FormValue)) {
            $this->izinperjamvalue->addErrorMessage($this->izinperjamvalue->getErrorMessage(false));
        }
        if ($this->sakit->Required) {
            if (!$this->sakit->IsDetailKey && EmptyValue($this->sakit->FormValue)) {
                $this->sakit->addErrorMessage(str_replace("%s", $this->sakit->caption(), $this->sakit->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->sakit->FormValue)) {
            $this->sakit->addErrorMessage($this->sakit->getErrorMessage(false));
        }
        if ($this->value_sakit->Required) {
            if (!$this->value_sakit->IsDetailKey && EmptyValue($this->value_sakit->FormValue)) {
                $this->value_sakit->addErrorMessage(str_replace("%s", $this->value_sakit->caption(), $this->value_sakit->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->value_sakit->FormValue)) {
            $this->value_sakit->addErrorMessage($this->value_sakit->getErrorMessage(false));
        }
        if ($this->sakitperjam->Required) {
            if (!$this->sakitperjam->IsDetailKey && EmptyValue($this->sakitperjam->FormValue)) {
                $this->sakitperjam->addErrorMessage(str_replace("%s", $this->sakitperjam->caption(), $this->sakitperjam->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->sakitperjam->FormValue)) {
            $this->sakitperjam->addErrorMessage($this->sakitperjam->getErrorMessage(false));
        }
        if ($this->sakitperjamvalue->Required) {
            if (!$this->sakitperjamvalue->IsDetailKey && EmptyValue($this->sakitperjamvalue->FormValue)) {
                $this->sakitperjamvalue->addErrorMessage(str_replace("%s", $this->sakitperjamvalue->caption(), $this->sakitperjamvalue->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->sakitperjamvalue->FormValue)) {
            $this->sakitperjamvalue->addErrorMessage($this->sakitperjamvalue->getErrorMessage(false));
        }
        if ($this->pulcep->Required) {
            if (!$this->pulcep->IsDetailKey && EmptyValue($this->pulcep->FormValue)) {
                $this->pulcep->addErrorMessage(str_replace("%s", $this->pulcep->caption(), $this->pulcep->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pulcep->FormValue)) {
            $this->pulcep->addErrorMessage($this->pulcep->getErrorMessage(false));
        }
        if ($this->value_pulcep->Required) {
            if (!$this->value_pulcep->IsDetailKey && EmptyValue($this->value_pulcep->FormValue)) {
                $this->value_pulcep->addErrorMessage(str_replace("%s", $this->value_pulcep->caption(), $this->value_pulcep->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->value_pulcep->FormValue)) {
            $this->value_pulcep->addErrorMessage($this->value_pulcep->getErrorMessage(false));
        }
        if ($this->tidakhadir->Required) {
            if (!$this->tidakhadir->IsDetailKey && EmptyValue($this->tidakhadir->FormValue)) {
                $this->tidakhadir->addErrorMessage(str_replace("%s", $this->tidakhadir->caption(), $this->tidakhadir->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->tidakhadir->FormValue)) {
            $this->tidakhadir->addErrorMessage($this->tidakhadir->getErrorMessage(false));
        }
        if ($this->value_tidakhadir->Required) {
            if (!$this->value_tidakhadir->IsDetailKey && EmptyValue($this->value_tidakhadir->FormValue)) {
                $this->value_tidakhadir->addErrorMessage(str_replace("%s", $this->value_tidakhadir->caption(), $this->value_tidakhadir->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->value_tidakhadir->FormValue)) {
            $this->value_tidakhadir->addErrorMessage($this->value_tidakhadir->getErrorMessage(false));
        }
        if ($this->tidakhadirjam->Required) {
            if (!$this->tidakhadirjam->IsDetailKey && EmptyValue($this->tidakhadirjam->FormValue)) {
                $this->tidakhadirjam->addErrorMessage(str_replace("%s", $this->tidakhadirjam->caption(), $this->tidakhadirjam->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->tidakhadirjam->FormValue)) {
            $this->tidakhadirjam->addErrorMessage($this->tidakhadirjam->getErrorMessage(false));
        }
        if ($this->tidakhadirjamvalue->Required) {
            if (!$this->tidakhadirjamvalue->IsDetailKey && EmptyValue($this->tidakhadirjamvalue->FormValue)) {
                $this->tidakhadirjamvalue->addErrorMessage(str_replace("%s", $this->tidakhadirjamvalue->caption(), $this->tidakhadirjamvalue->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->tidakhadirjamvalue->FormValue)) {
            $this->tidakhadirjamvalue->addErrorMessage($this->tidakhadirjamvalue->getErrorMessage(false));
        }
        if ($this->total->Required) {
            if (!$this->total->IsDetailKey && EmptyValue($this->total->FormValue)) {
                $this->total->addErrorMessage(str_replace("%s", $this->total->caption(), $this->total->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->total->FormValue)) {
            $this->total->addErrorMessage($this->total->getErrorMessage(false));
        }
        if ($this->u_by->Required) {
            if (!$this->u_by->IsDetailKey && EmptyValue($this->u_by->FormValue)) {
                $this->u_by->addErrorMessage(str_replace("%s", $this->u_by->caption(), $this->u_by->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->u_by->FormValue)) {
            $this->u_by->addErrorMessage($this->u_by->getErrorMessage(false));
        }
        if ($this->datetime->Required) {
            if (!$this->datetime->IsDetailKey && EmptyValue($this->datetime->FormValue)) {
                $this->datetime->addErrorMessage(str_replace("%s", $this->datetime->caption(), $this->datetime->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->datetime->FormValue, $this->datetime->formatPattern())) {
            $this->datetime->addErrorMessage($this->datetime->getErrorMessage(false));
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

        // month
        $this->month->setDbValueDef($rsnew, $this->month->CurrentValue, null, false);

        // jenjang_id
        $this->jenjang_id->setDbValueDef($rsnew, $this->jenjang_id->CurrentValue, null, false);

        // jabatan_id
        $this->jabatan_id->setDbValueDef($rsnew, $this->jabatan_id->CurrentValue, null, false);

        // nama
        $this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, null, false);

        // terlambat
        $this->terlambat->setDbValueDef($rsnew, $this->terlambat->CurrentValue, null, false);

        // value_terlambat
        $this->value_terlambat->setDbValueDef($rsnew, $this->value_terlambat->CurrentValue, null, false);

        // izin
        $this->izin->setDbValueDef($rsnew, $this->izin->CurrentValue, null, false);

        // value_izin
        $this->value_izin->setDbValueDef($rsnew, $this->value_izin->CurrentValue, null, false);

        // izinperjam
        $this->izinperjam->setDbValueDef($rsnew, $this->izinperjam->CurrentValue, null, false);

        // izinperjamvalue
        $this->izinperjamvalue->setDbValueDef($rsnew, $this->izinperjamvalue->CurrentValue, null, false);

        // sakit
        $this->sakit->setDbValueDef($rsnew, $this->sakit->CurrentValue, null, false);

        // value_sakit
        $this->value_sakit->setDbValueDef($rsnew, $this->value_sakit->CurrentValue, null, false);

        // sakitperjam
        $this->sakitperjam->setDbValueDef($rsnew, $this->sakitperjam->CurrentValue, null, false);

        // sakitperjamvalue
        $this->sakitperjamvalue->setDbValueDef($rsnew, $this->sakitperjamvalue->CurrentValue, null, false);

        // pulcep
        $this->pulcep->setDbValueDef($rsnew, $this->pulcep->CurrentValue, null, false);

        // value_pulcep
        $this->value_pulcep->setDbValueDef($rsnew, $this->value_pulcep->CurrentValue, null, false);

        // tidakhadir
        $this->tidakhadir->setDbValueDef($rsnew, $this->tidakhadir->CurrentValue, null, false);

        // value_tidakhadir
        $this->value_tidakhadir->setDbValueDef($rsnew, $this->value_tidakhadir->CurrentValue, null, false);

        // tidakhadirjam
        $this->tidakhadirjam->setDbValueDef($rsnew, $this->tidakhadirjam->CurrentValue, null, false);

        // tidakhadirjamvalue
        $this->tidakhadirjamvalue->setDbValueDef($rsnew, $this->tidakhadirjamvalue->CurrentValue, null, false);

        // total
        $this->total->setDbValueDef($rsnew, $this->total->CurrentValue, null, false);

        // u_by
        $this->u_by->setDbValueDef($rsnew, $this->u_by->CurrentValue, null, false);

        // datetime
        $this->datetime->setDbValueDef($rsnew, UnFormatDateTime($this->datetime->CurrentValue, $this->datetime->formatPattern()), null, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PotonganSmpList"), "", $this->TableVar, true);
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
