<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class TesttableAdd extends Testtable
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'testtable';

    // Page object name
    public $PageObjName = "TesttableAdd";

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

        // Table object (testtable)
        if (!isset($GLOBALS["testtable"]) || get_class($GLOBALS["testtable"]) == PROJECT_NAMESPACE . "testtable") {
            $GLOBALS["testtable"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'testtable');
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
                $tbl = Container("testtable");
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
                    if ($pageName == "TesttableView") {
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
        $this->date->setVisibility();
        $this->nojob->setVisibility();
        $this->stuffingdate->setVisibility();
        $this->shipper->setVisibility();
        $this->stuffingloc->setVisibility();
        $this->party->setVisibility();
        $this->typeparty->setVisibility();
        $this->jumlahparty->setVisibility();
        $this->shipping->setVisibility();
        $this->bookingnumer->setVisibility();
        $this->shippingline->setVisibility();
        $this->port->setVisibility();
        $this->surjal->setVisibility();
        $this->nota->setVisibility();
        $this->invoice->setVisibility();
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
                    $this->terminate("TesttableList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "TesttableList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "TesttableView") {
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

        // Check field name 'date' first before field var 'x_date'
        $val = $CurrentForm->hasValue("date") ? $CurrentForm->getValue("date") : $CurrentForm->getValue("x_date");
        if (!$this->date->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->date->Visible = false; // Disable update for API request
            } else {
                $this->date->setFormValue($val, true, $validate);
            }
            $this->date->CurrentValue = UnFormatDateTime($this->date->CurrentValue, $this->date->formatPattern());
        }

        // Check field name 'nojob' first before field var 'x_nojob'
        $val = $CurrentForm->hasValue("nojob") ? $CurrentForm->getValue("nojob") : $CurrentForm->getValue("x_nojob");
        if (!$this->nojob->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nojob->Visible = false; // Disable update for API request
            } else {
                $this->nojob->setFormValue($val);
            }
        }

        // Check field name 'stuffingdate' first before field var 'x_stuffingdate'
        $val = $CurrentForm->hasValue("stuffingdate") ? $CurrentForm->getValue("stuffingdate") : $CurrentForm->getValue("x_stuffingdate");
        if (!$this->stuffingdate->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->stuffingdate->Visible = false; // Disable update for API request
            } else {
                $this->stuffingdate->setFormValue($val, true, $validate);
            }
            $this->stuffingdate->CurrentValue = UnFormatDateTime($this->stuffingdate->CurrentValue, $this->stuffingdate->formatPattern());
        }

        // Check field name 'shipper' first before field var 'x_shipper'
        $val = $CurrentForm->hasValue("shipper") ? $CurrentForm->getValue("shipper") : $CurrentForm->getValue("x_shipper");
        if (!$this->shipper->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->shipper->Visible = false; // Disable update for API request
            } else {
                $this->shipper->setFormValue($val);
            }
        }

        // Check field name 'stuffingloc' first before field var 'x_stuffingloc'
        $val = $CurrentForm->hasValue("stuffingloc") ? $CurrentForm->getValue("stuffingloc") : $CurrentForm->getValue("x_stuffingloc");
        if (!$this->stuffingloc->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->stuffingloc->Visible = false; // Disable update for API request
            } else {
                $this->stuffingloc->setFormValue($val);
            }
        }

        // Check field name 'party' first before field var 'x_party'
        $val = $CurrentForm->hasValue("party") ? $CurrentForm->getValue("party") : $CurrentForm->getValue("x_party");
        if (!$this->party->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->party->Visible = false; // Disable update for API request
            } else {
                $this->party->setFormValue($val);
            }
        }

        // Check field name 'typeparty' first before field var 'x_typeparty'
        $val = $CurrentForm->hasValue("typeparty") ? $CurrentForm->getValue("typeparty") : $CurrentForm->getValue("x_typeparty");
        if (!$this->typeparty->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->typeparty->Visible = false; // Disable update for API request
            } else {
                $this->typeparty->setFormValue($val);
            }
        }

        // Check field name 'jumlahparty' first before field var 'x_jumlahparty'
        $val = $CurrentForm->hasValue("jumlahparty") ? $CurrentForm->getValue("jumlahparty") : $CurrentForm->getValue("x_jumlahparty");
        if (!$this->jumlahparty->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jumlahparty->Visible = false; // Disable update for API request
            } else {
                $this->jumlahparty->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'shipping' first before field var 'x_shipping'
        $val = $CurrentForm->hasValue("shipping") ? $CurrentForm->getValue("shipping") : $CurrentForm->getValue("x_shipping");
        if (!$this->shipping->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->shipping->Visible = false; // Disable update for API request
            } else {
                $this->shipping->setFormValue($val);
            }
        }

        // Check field name 'bookingnumer' first before field var 'x_bookingnumer'
        $val = $CurrentForm->hasValue("bookingnumer") ? $CurrentForm->getValue("bookingnumer") : $CurrentForm->getValue("x_bookingnumer");
        if (!$this->bookingnumer->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bookingnumer->Visible = false; // Disable update for API request
            } else {
                $this->bookingnumer->setFormValue($val);
            }
        }

        // Check field name 'shippingline' first before field var 'x_shippingline'
        $val = $CurrentForm->hasValue("shippingline") ? $CurrentForm->getValue("shippingline") : $CurrentForm->getValue("x_shippingline");
        if (!$this->shippingline->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->shippingline->Visible = false; // Disable update for API request
            } else {
                $this->shippingline->setFormValue($val);
            }
        }

        // Check field name 'port' first before field var 'x_port'
        $val = $CurrentForm->hasValue("port") ? $CurrentForm->getValue("port") : $CurrentForm->getValue("x_port");
        if (!$this->port->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->port->Visible = false; // Disable update for API request
            } else {
                $this->port->setFormValue($val);
            }
        }

        // Check field name 'surjal' first before field var 'x_surjal'
        $val = $CurrentForm->hasValue("surjal") ? $CurrentForm->getValue("surjal") : $CurrentForm->getValue("x_surjal");
        if (!$this->surjal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->surjal->Visible = false; // Disable update for API request
            } else {
                $this->surjal->setFormValue($val);
            }
        }

        // Check field name 'nota' first before field var 'x_nota'
        $val = $CurrentForm->hasValue("nota") ? $CurrentForm->getValue("nota") : $CurrentForm->getValue("x_nota");
        if (!$this->nota->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nota->Visible = false; // Disable update for API request
            } else {
                $this->nota->setFormValue($val);
            }
        }

        // Check field name 'invoice' first before field var 'x_invoice'
        $val = $CurrentForm->hasValue("invoice") ? $CurrentForm->getValue("invoice") : $CurrentForm->getValue("x_invoice");
        if (!$this->invoice->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->invoice->Visible = false; // Disable update for API request
            } else {
                $this->invoice->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->date->CurrentValue = $this->date->FormValue;
        $this->date->CurrentValue = UnFormatDateTime($this->date->CurrentValue, $this->date->formatPattern());
        $this->nojob->CurrentValue = $this->nojob->FormValue;
        $this->stuffingdate->CurrentValue = $this->stuffingdate->FormValue;
        $this->stuffingdate->CurrentValue = UnFormatDateTime($this->stuffingdate->CurrentValue, $this->stuffingdate->formatPattern());
        $this->shipper->CurrentValue = $this->shipper->FormValue;
        $this->stuffingloc->CurrentValue = $this->stuffingloc->FormValue;
        $this->party->CurrentValue = $this->party->FormValue;
        $this->typeparty->CurrentValue = $this->typeparty->FormValue;
        $this->jumlahparty->CurrentValue = $this->jumlahparty->FormValue;
        $this->shipping->CurrentValue = $this->shipping->FormValue;
        $this->bookingnumer->CurrentValue = $this->bookingnumer->FormValue;
        $this->shippingline->CurrentValue = $this->shippingline->FormValue;
        $this->port->CurrentValue = $this->port->FormValue;
        $this->surjal->CurrentValue = $this->surjal->FormValue;
        $this->nota->CurrentValue = $this->nota->FormValue;
        $this->invoice->CurrentValue = $this->invoice->FormValue;
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
        $this->date->setDbValue($row['date']);
        $this->nojob->setDbValue($row['nojob']);
        $this->stuffingdate->setDbValue($row['stuffingdate']);
        $this->shipper->setDbValue($row['shipper']);
        $this->stuffingloc->setDbValue($row['stuffingloc']);
        $this->party->setDbValue($row['party']);
        $this->typeparty->setDbValue($row['typeparty']);
        $this->jumlahparty->setDbValue($row['jumlahparty']);
        $this->shipping->setDbValue($row['shipping']);
        $this->bookingnumer->setDbValue($row['bookingnumer']);
        $this->shippingline->setDbValue($row['shippingline']);
        $this->port->setDbValue($row['port']);
        $this->surjal->setDbValue($row['surjal']);
        $this->nota->setDbValue($row['nota']);
        $this->invoice->setDbValue($row['invoice']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['date'] = $this->date->DefaultValue;
        $row['nojob'] = $this->nojob->DefaultValue;
        $row['stuffingdate'] = $this->stuffingdate->DefaultValue;
        $row['shipper'] = $this->shipper->DefaultValue;
        $row['stuffingloc'] = $this->stuffingloc->DefaultValue;
        $row['party'] = $this->party->DefaultValue;
        $row['typeparty'] = $this->typeparty->DefaultValue;
        $row['jumlahparty'] = $this->jumlahparty->DefaultValue;
        $row['shipping'] = $this->shipping->DefaultValue;
        $row['bookingnumer'] = $this->bookingnumer->DefaultValue;
        $row['shippingline'] = $this->shippingline->DefaultValue;
        $row['port'] = $this->port->DefaultValue;
        $row['surjal'] = $this->surjal->DefaultValue;
        $row['nota'] = $this->nota->DefaultValue;
        $row['invoice'] = $this->invoice->DefaultValue;
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

        // date
        $this->date->RowCssClass = "row";

        // nojob
        $this->nojob->RowCssClass = "row";

        // stuffingdate
        $this->stuffingdate->RowCssClass = "row";

        // shipper
        $this->shipper->RowCssClass = "row";

        // stuffingloc
        $this->stuffingloc->RowCssClass = "row";

        // party
        $this->party->RowCssClass = "row";

        // typeparty
        $this->typeparty->RowCssClass = "row";

        // jumlahparty
        $this->jumlahparty->RowCssClass = "row";

        // shipping
        $this->shipping->RowCssClass = "row";

        // bookingnumer
        $this->bookingnumer->RowCssClass = "row";

        // shippingline
        $this->shippingline->RowCssClass = "row";

        // port
        $this->port->RowCssClass = "row";

        // surjal
        $this->surjal->RowCssClass = "row";

        // nota
        $this->nota->RowCssClass = "row";

        // invoice
        $this->invoice->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // date
            $this->date->ViewValue = $this->date->CurrentValue;
            $this->date->ViewValue = FormatDateTime($this->date->ViewValue, $this->date->formatPattern());
            $this->date->ViewCustomAttributes = "";

            // nojob
            $this->nojob->ViewValue = $this->nojob->CurrentValue;
            $this->nojob->ViewCustomAttributes = "";

            // stuffingdate
            $this->stuffingdate->ViewValue = $this->stuffingdate->CurrentValue;
            $this->stuffingdate->ViewValue = FormatDateTime($this->stuffingdate->ViewValue, $this->stuffingdate->formatPattern());
            $this->stuffingdate->ViewCustomAttributes = "";

            // shipper
            $this->shipper->ViewValue = $this->shipper->CurrentValue;
            $this->shipper->ViewCustomAttributes = "";

            // stuffingloc
            $this->stuffingloc->ViewValue = $this->stuffingloc->CurrentValue;
            $this->stuffingloc->ViewCustomAttributes = "";

            // party
            $this->party->ViewValue = $this->party->CurrentValue;
            $this->party->ViewCustomAttributes = "";

            // typeparty
            $this->typeparty->ViewValue = $this->typeparty->CurrentValue;
            $this->typeparty->ViewCustomAttributes = "";

            // jumlahparty
            $this->jumlahparty->ViewValue = $this->jumlahparty->CurrentValue;
            $this->jumlahparty->ViewValue = FormatNumber($this->jumlahparty->ViewValue, $this->jumlahparty->formatPattern());
            $this->jumlahparty->ViewCustomAttributes = "";

            // shipping
            $this->shipping->ViewValue = $this->shipping->CurrentValue;
            $this->shipping->ViewCustomAttributes = "";

            // bookingnumer
            $this->bookingnumer->ViewValue = $this->bookingnumer->CurrentValue;
            $this->bookingnumer->ViewCustomAttributes = "";

            // shippingline
            $this->shippingline->ViewValue = $this->shippingline->CurrentValue;
            $this->shippingline->ViewCustomAttributes = "";

            // port
            $this->port->ViewValue = $this->port->CurrentValue;
            $this->port->ViewCustomAttributes = "";

            // surjal
            $this->surjal->ViewValue = $this->surjal->CurrentValue;
            $this->surjal->ViewCustomAttributes = "";

            // nota
            $this->nota->ViewValue = $this->nota->CurrentValue;
            $this->nota->ViewCustomAttributes = "";

            // invoice
            $this->invoice->ViewValue = $this->invoice->CurrentValue;
            $this->invoice->ViewCustomAttributes = "";

            // date
            $this->date->LinkCustomAttributes = "";
            $this->date->HrefValue = "";

            // nojob
            $this->nojob->LinkCustomAttributes = "";
            $this->nojob->HrefValue = "";

            // stuffingdate
            $this->stuffingdate->LinkCustomAttributes = "";
            $this->stuffingdate->HrefValue = "";

            // shipper
            $this->shipper->LinkCustomAttributes = "";
            $this->shipper->HrefValue = "";

            // stuffingloc
            $this->stuffingloc->LinkCustomAttributes = "";
            $this->stuffingloc->HrefValue = "";

            // party
            $this->party->LinkCustomAttributes = "";
            $this->party->HrefValue = "";

            // typeparty
            $this->typeparty->LinkCustomAttributes = "";
            $this->typeparty->HrefValue = "";

            // jumlahparty
            $this->jumlahparty->LinkCustomAttributes = "";
            $this->jumlahparty->HrefValue = "";

            // shipping
            $this->shipping->LinkCustomAttributes = "";
            $this->shipping->HrefValue = "";

            // bookingnumer
            $this->bookingnumer->LinkCustomAttributes = "";
            $this->bookingnumer->HrefValue = "";

            // shippingline
            $this->shippingline->LinkCustomAttributes = "";
            $this->shippingline->HrefValue = "";

            // port
            $this->port->LinkCustomAttributes = "";
            $this->port->HrefValue = "";

            // surjal
            $this->surjal->LinkCustomAttributes = "";
            $this->surjal->HrefValue = "";

            // nota
            $this->nota->LinkCustomAttributes = "";
            $this->nota->HrefValue = "";

            // invoice
            $this->invoice->LinkCustomAttributes = "";
            $this->invoice->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // date
            $this->date->setupEditAttributes();
            $this->date->EditCustomAttributes = "";
            $this->date->EditValue = HtmlEncode(FormatDateTime($this->date->CurrentValue, $this->date->formatPattern()));
            $this->date->PlaceHolder = RemoveHtml($this->date->caption());

            // nojob
            $this->nojob->setupEditAttributes();
            $this->nojob->EditCustomAttributes = "";
            if (!$this->nojob->Raw) {
                $this->nojob->CurrentValue = HtmlDecode($this->nojob->CurrentValue);
            }
            $this->nojob->EditValue = HtmlEncode($this->nojob->CurrentValue);
            $this->nojob->PlaceHolder = RemoveHtml($this->nojob->caption());

            // stuffingdate
            $this->stuffingdate->setupEditAttributes();
            $this->stuffingdate->EditCustomAttributes = "";
            $this->stuffingdate->EditValue = HtmlEncode(FormatDateTime($this->stuffingdate->CurrentValue, $this->stuffingdate->formatPattern()));
            $this->stuffingdate->PlaceHolder = RemoveHtml($this->stuffingdate->caption());

            // shipper
            $this->shipper->setupEditAttributes();
            $this->shipper->EditCustomAttributes = "";
            if (!$this->shipper->Raw) {
                $this->shipper->CurrentValue = HtmlDecode($this->shipper->CurrentValue);
            }
            $this->shipper->EditValue = HtmlEncode($this->shipper->CurrentValue);
            $this->shipper->PlaceHolder = RemoveHtml($this->shipper->caption());

            // stuffingloc
            $this->stuffingloc->setupEditAttributes();
            $this->stuffingloc->EditCustomAttributes = "";
            if (!$this->stuffingloc->Raw) {
                $this->stuffingloc->CurrentValue = HtmlDecode($this->stuffingloc->CurrentValue);
            }
            $this->stuffingloc->EditValue = HtmlEncode($this->stuffingloc->CurrentValue);
            $this->stuffingloc->PlaceHolder = RemoveHtml($this->stuffingloc->caption());

            // party
            $this->party->setupEditAttributes();
            $this->party->EditCustomAttributes = "";
            if (!$this->party->Raw) {
                $this->party->CurrentValue = HtmlDecode($this->party->CurrentValue);
            }
            $this->party->EditValue = HtmlEncode($this->party->CurrentValue);
            $this->party->PlaceHolder = RemoveHtml($this->party->caption());

            // typeparty
            $this->typeparty->setupEditAttributes();
            $this->typeparty->EditCustomAttributes = "";
            if (!$this->typeparty->Raw) {
                $this->typeparty->CurrentValue = HtmlDecode($this->typeparty->CurrentValue);
            }
            $this->typeparty->EditValue = HtmlEncode($this->typeparty->CurrentValue);
            $this->typeparty->PlaceHolder = RemoveHtml($this->typeparty->caption());

            // jumlahparty
            $this->jumlahparty->setupEditAttributes();
            $this->jumlahparty->EditCustomAttributes = "";
            $this->jumlahparty->EditValue = HtmlEncode($this->jumlahparty->CurrentValue);
            $this->jumlahparty->PlaceHolder = RemoveHtml($this->jumlahparty->caption());
            if (strval($this->jumlahparty->EditValue) != "" && is_numeric($this->jumlahparty->EditValue)) {
                $this->jumlahparty->EditValue = FormatNumber($this->jumlahparty->EditValue, null);
            }

            // shipping
            $this->shipping->setupEditAttributes();
            $this->shipping->EditCustomAttributes = "";
            if (!$this->shipping->Raw) {
                $this->shipping->CurrentValue = HtmlDecode($this->shipping->CurrentValue);
            }
            $this->shipping->EditValue = HtmlEncode($this->shipping->CurrentValue);
            $this->shipping->PlaceHolder = RemoveHtml($this->shipping->caption());

            // bookingnumer
            $this->bookingnumer->setupEditAttributes();
            $this->bookingnumer->EditCustomAttributes = "";
            if (!$this->bookingnumer->Raw) {
                $this->bookingnumer->CurrentValue = HtmlDecode($this->bookingnumer->CurrentValue);
            }
            $this->bookingnumer->EditValue = HtmlEncode($this->bookingnumer->CurrentValue);
            $this->bookingnumer->PlaceHolder = RemoveHtml($this->bookingnumer->caption());

            // shippingline
            $this->shippingline->setupEditAttributes();
            $this->shippingline->EditCustomAttributes = "";
            if (!$this->shippingline->Raw) {
                $this->shippingline->CurrentValue = HtmlDecode($this->shippingline->CurrentValue);
            }
            $this->shippingline->EditValue = HtmlEncode($this->shippingline->CurrentValue);
            $this->shippingline->PlaceHolder = RemoveHtml($this->shippingline->caption());

            // port
            $this->port->setupEditAttributes();
            $this->port->EditCustomAttributes = "";
            if (!$this->port->Raw) {
                $this->port->CurrentValue = HtmlDecode($this->port->CurrentValue);
            }
            $this->port->EditValue = HtmlEncode($this->port->CurrentValue);
            $this->port->PlaceHolder = RemoveHtml($this->port->caption());

            // surjal
            $this->surjal->setupEditAttributes();
            $this->surjal->EditCustomAttributes = "";
            if (!$this->surjal->Raw) {
                $this->surjal->CurrentValue = HtmlDecode($this->surjal->CurrentValue);
            }
            $this->surjal->EditValue = HtmlEncode($this->surjal->CurrentValue);
            $this->surjal->PlaceHolder = RemoveHtml($this->surjal->caption());

            // nota
            $this->nota->setupEditAttributes();
            $this->nota->EditCustomAttributes = "";
            if (!$this->nota->Raw) {
                $this->nota->CurrentValue = HtmlDecode($this->nota->CurrentValue);
            }
            $this->nota->EditValue = HtmlEncode($this->nota->CurrentValue);
            $this->nota->PlaceHolder = RemoveHtml($this->nota->caption());

            // invoice
            $this->invoice->setupEditAttributes();
            $this->invoice->EditCustomAttributes = "";
            if (!$this->invoice->Raw) {
                $this->invoice->CurrentValue = HtmlDecode($this->invoice->CurrentValue);
            }
            $this->invoice->EditValue = HtmlEncode($this->invoice->CurrentValue);
            $this->invoice->PlaceHolder = RemoveHtml($this->invoice->caption());

            // Add refer script

            // date
            $this->date->LinkCustomAttributes = "";
            $this->date->HrefValue = "";

            // nojob
            $this->nojob->LinkCustomAttributes = "";
            $this->nojob->HrefValue = "";

            // stuffingdate
            $this->stuffingdate->LinkCustomAttributes = "";
            $this->stuffingdate->HrefValue = "";

            // shipper
            $this->shipper->LinkCustomAttributes = "";
            $this->shipper->HrefValue = "";

            // stuffingloc
            $this->stuffingloc->LinkCustomAttributes = "";
            $this->stuffingloc->HrefValue = "";

            // party
            $this->party->LinkCustomAttributes = "";
            $this->party->HrefValue = "";

            // typeparty
            $this->typeparty->LinkCustomAttributes = "";
            $this->typeparty->HrefValue = "";

            // jumlahparty
            $this->jumlahparty->LinkCustomAttributes = "";
            $this->jumlahparty->HrefValue = "";

            // shipping
            $this->shipping->LinkCustomAttributes = "";
            $this->shipping->HrefValue = "";

            // bookingnumer
            $this->bookingnumer->LinkCustomAttributes = "";
            $this->bookingnumer->HrefValue = "";

            // shippingline
            $this->shippingline->LinkCustomAttributes = "";
            $this->shippingline->HrefValue = "";

            // port
            $this->port->LinkCustomAttributes = "";
            $this->port->HrefValue = "";

            // surjal
            $this->surjal->LinkCustomAttributes = "";
            $this->surjal->HrefValue = "";

            // nota
            $this->nota->LinkCustomAttributes = "";
            $this->nota->HrefValue = "";

            // invoice
            $this->invoice->LinkCustomAttributes = "";
            $this->invoice->HrefValue = "";
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
        if ($this->date->Required) {
            if (!$this->date->IsDetailKey && EmptyValue($this->date->FormValue)) {
                $this->date->addErrorMessage(str_replace("%s", $this->date->caption(), $this->date->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->date->FormValue, $this->date->formatPattern())) {
            $this->date->addErrorMessage($this->date->getErrorMessage(false));
        }
        if ($this->nojob->Required) {
            if (!$this->nojob->IsDetailKey && EmptyValue($this->nojob->FormValue)) {
                $this->nojob->addErrorMessage(str_replace("%s", $this->nojob->caption(), $this->nojob->RequiredErrorMessage));
            }
        }
        if ($this->stuffingdate->Required) {
            if (!$this->stuffingdate->IsDetailKey && EmptyValue($this->stuffingdate->FormValue)) {
                $this->stuffingdate->addErrorMessage(str_replace("%s", $this->stuffingdate->caption(), $this->stuffingdate->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->stuffingdate->FormValue, $this->stuffingdate->formatPattern())) {
            $this->stuffingdate->addErrorMessage($this->stuffingdate->getErrorMessage(false));
        }
        if ($this->shipper->Required) {
            if (!$this->shipper->IsDetailKey && EmptyValue($this->shipper->FormValue)) {
                $this->shipper->addErrorMessage(str_replace("%s", $this->shipper->caption(), $this->shipper->RequiredErrorMessage));
            }
        }
        if ($this->stuffingloc->Required) {
            if (!$this->stuffingloc->IsDetailKey && EmptyValue($this->stuffingloc->FormValue)) {
                $this->stuffingloc->addErrorMessage(str_replace("%s", $this->stuffingloc->caption(), $this->stuffingloc->RequiredErrorMessage));
            }
        }
        if ($this->party->Required) {
            if (!$this->party->IsDetailKey && EmptyValue($this->party->FormValue)) {
                $this->party->addErrorMessage(str_replace("%s", $this->party->caption(), $this->party->RequiredErrorMessage));
            }
        }
        if ($this->typeparty->Required) {
            if (!$this->typeparty->IsDetailKey && EmptyValue($this->typeparty->FormValue)) {
                $this->typeparty->addErrorMessage(str_replace("%s", $this->typeparty->caption(), $this->typeparty->RequiredErrorMessage));
            }
        }
        if ($this->jumlahparty->Required) {
            if (!$this->jumlahparty->IsDetailKey && EmptyValue($this->jumlahparty->FormValue)) {
                $this->jumlahparty->addErrorMessage(str_replace("%s", $this->jumlahparty->caption(), $this->jumlahparty->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jumlahparty->FormValue)) {
            $this->jumlahparty->addErrorMessage($this->jumlahparty->getErrorMessage(false));
        }
        if ($this->shipping->Required) {
            if (!$this->shipping->IsDetailKey && EmptyValue($this->shipping->FormValue)) {
                $this->shipping->addErrorMessage(str_replace("%s", $this->shipping->caption(), $this->shipping->RequiredErrorMessage));
            }
        }
        if ($this->bookingnumer->Required) {
            if (!$this->bookingnumer->IsDetailKey && EmptyValue($this->bookingnumer->FormValue)) {
                $this->bookingnumer->addErrorMessage(str_replace("%s", $this->bookingnumer->caption(), $this->bookingnumer->RequiredErrorMessage));
            }
        }
        if ($this->shippingline->Required) {
            if (!$this->shippingline->IsDetailKey && EmptyValue($this->shippingline->FormValue)) {
                $this->shippingline->addErrorMessage(str_replace("%s", $this->shippingline->caption(), $this->shippingline->RequiredErrorMessage));
            }
        }
        if ($this->port->Required) {
            if (!$this->port->IsDetailKey && EmptyValue($this->port->FormValue)) {
                $this->port->addErrorMessage(str_replace("%s", $this->port->caption(), $this->port->RequiredErrorMessage));
            }
        }
        if ($this->surjal->Required) {
            if (!$this->surjal->IsDetailKey && EmptyValue($this->surjal->FormValue)) {
                $this->surjal->addErrorMessage(str_replace("%s", $this->surjal->caption(), $this->surjal->RequiredErrorMessage));
            }
        }
        if ($this->nota->Required) {
            if (!$this->nota->IsDetailKey && EmptyValue($this->nota->FormValue)) {
                $this->nota->addErrorMessage(str_replace("%s", $this->nota->caption(), $this->nota->RequiredErrorMessage));
            }
        }
        if ($this->invoice->Required) {
            if (!$this->invoice->IsDetailKey && EmptyValue($this->invoice->FormValue)) {
                $this->invoice->addErrorMessage(str_replace("%s", $this->invoice->caption(), $this->invoice->RequiredErrorMessage));
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

        // date
        $this->date->setDbValueDef($rsnew, UnFormatDateTime($this->date->CurrentValue, $this->date->formatPattern()), null, false);

        // nojob
        $this->nojob->setDbValueDef($rsnew, $this->nojob->CurrentValue, null, false);

        // stuffingdate
        $this->stuffingdate->setDbValueDef($rsnew, UnFormatDateTime($this->stuffingdate->CurrentValue, $this->stuffingdate->formatPattern()), null, false);

        // shipper
        $this->shipper->setDbValueDef($rsnew, $this->shipper->CurrentValue, null, false);

        // stuffingloc
        $this->stuffingloc->setDbValueDef($rsnew, $this->stuffingloc->CurrentValue, null, false);

        // party
        $this->party->setDbValueDef($rsnew, $this->party->CurrentValue, null, false);

        // typeparty
        $this->typeparty->setDbValueDef($rsnew, $this->typeparty->CurrentValue, null, false);

        // jumlahparty
        $this->jumlahparty->setDbValueDef($rsnew, $this->jumlahparty->CurrentValue, null, false);

        // shipping
        $this->shipping->setDbValueDef($rsnew, $this->shipping->CurrentValue, null, false);

        // bookingnumer
        $this->bookingnumer->setDbValueDef($rsnew, $this->bookingnumer->CurrentValue, null, false);

        // shippingline
        $this->shippingline->setDbValueDef($rsnew, $this->shippingline->CurrentValue, null, false);

        // port
        $this->port->setDbValueDef($rsnew, $this->port->CurrentValue, null, false);

        // surjal
        $this->surjal->setDbValueDef($rsnew, $this->surjal->CurrentValue, null, false);

        // nota
        $this->nota->setDbValueDef($rsnew, $this->nota->CurrentValue, null, false);

        // invoice
        $this->invoice->setDbValueDef($rsnew, $this->invoice->CurrentValue, null, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("TesttableList"), "", $this->TableVar, true);
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
