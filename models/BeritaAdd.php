<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class BeritaAdd extends Berita
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'berita';

    // Page object name
    public $PageObjName = "BeritaAdd";

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

        // Table object (berita)
        if (!isset($GLOBALS["berita"]) || get_class($GLOBALS["berita"]) == PROJECT_NAMESPACE . "berita") {
            $GLOBALS["berita"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'berita');
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
                $tbl = Container("berita");
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
                    if ($pageName == "BeritaView") {
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
        $this->grup->setVisibility();
        $this->judul->setVisibility();
        $this->c_by->setVisibility();
        $this->c_date->setVisibility();
        $this->aktif->setVisibility();
        $this->video->setVisibility();
        $this->berita->setVisibility();
        $this->gambar->setVisibility();
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
        $this->setupLookupOptions($this->grup);
        $this->setupLookupOptions($this->c_by);

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

        // Set up detail parameters
        $this->setupDetailParms();

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
                    $this->terminate("BeritaList"); // No matching record, return to list
                    return;
                }

                // Set up detail parameters
                $this->setupDetailParms();
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    if ($this->getCurrentDetailTable() != "") { // Master/detail add
                        $returnUrl = $this->getDetailUrl();
                    } else {
                        $returnUrl = $this->getReturnUrl();
                    }
                    if (GetPageName($returnUrl) == "BeritaList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "BeritaView") {
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

                    // Set up detail parameters
                    $this->setupDetailParms();
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
        $this->video->Upload->Index = $CurrentForm->Index;
        $this->video->Upload->uploadFile();
        $this->video->CurrentValue = $this->video->Upload->FileName;
        $this->gambar->Upload->Index = $CurrentForm->Index;
        $this->gambar->Upload->uploadFile();
        $this->gambar->CurrentValue = $this->gambar->Upload->FileName;
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

        // Check field name 'grup' first before field var 'x_grup'
        $val = $CurrentForm->hasValue("grup") ? $CurrentForm->getValue("grup") : $CurrentForm->getValue("x_grup");
        if (!$this->grup->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->grup->Visible = false; // Disable update for API request
            } else {
                $this->grup->setFormValue($val);
            }
        }

        // Check field name 'judul' first before field var 'x_judul'
        $val = $CurrentForm->hasValue("judul") ? $CurrentForm->getValue("judul") : $CurrentForm->getValue("x_judul");
        if (!$this->judul->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->judul->Visible = false; // Disable update for API request
            } else {
                $this->judul->setFormValue($val);
            }
        }

        // Check field name 'c_by' first before field var 'x_c_by'
        $val = $CurrentForm->hasValue("c_by") ? $CurrentForm->getValue("c_by") : $CurrentForm->getValue("x_c_by");
        if (!$this->c_by->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->c_by->Visible = false; // Disable update for API request
            } else {
                $this->c_by->setFormValue($val);
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

        // Check field name 'aktif' first before field var 'x_aktif'
        $val = $CurrentForm->hasValue("aktif") ? $CurrentForm->getValue("aktif") : $CurrentForm->getValue("x_aktif");
        if (!$this->aktif->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->aktif->Visible = false; // Disable update for API request
            } else {
                $this->aktif->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'berita' first before field var 'x_berita'
        $val = $CurrentForm->hasValue("berita") ? $CurrentForm->getValue("berita") : $CurrentForm->getValue("x_berita");
        if (!$this->berita->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->berita->Visible = false; // Disable update for API request
            } else {
                $this->berita->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->grup->CurrentValue = $this->grup->FormValue;
        $this->judul->CurrentValue = $this->judul->FormValue;
        $this->c_by->CurrentValue = $this->c_by->FormValue;
        $this->c_date->CurrentValue = $this->c_date->FormValue;
        $this->c_date->CurrentValue = UnFormatDateTime($this->c_date->CurrentValue, $this->c_date->formatPattern());
        $this->aktif->CurrentValue = $this->aktif->FormValue;
        $this->berita->CurrentValue = $this->berita->FormValue;
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
        $this->grup->setDbValue($row['grup']);
        $this->judul->setDbValue($row['judul']);
        $this->c_by->setDbValue($row['c_by']);
        $this->c_date->setDbValue($row['c_date']);
        $this->aktif->setDbValue($row['aktif']);
        $this->video->Upload->DbValue = $row['video'];
        $this->video->setDbValue($this->video->Upload->DbValue);
        $this->berita->setDbValue($row['berita']);
        $this->gambar->Upload->DbValue = $row['gambar'];
        $this->gambar->setDbValue($this->gambar->Upload->DbValue);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['grup'] = $this->grup->DefaultValue;
        $row['judul'] = $this->judul->DefaultValue;
        $row['c_by'] = $this->c_by->DefaultValue;
        $row['c_date'] = $this->c_date->DefaultValue;
        $row['aktif'] = $this->aktif->DefaultValue;
        $row['video'] = $this->video->DefaultValue;
        $row['berita'] = $this->berita->DefaultValue;
        $row['gambar'] = $this->gambar->DefaultValue;
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

        // grup
        $this->grup->RowCssClass = "row";

        // judul
        $this->judul->RowCssClass = "row";

        // c_by
        $this->c_by->RowCssClass = "row";

        // c_date
        $this->c_date->RowCssClass = "row";

        // aktif
        $this->aktif->RowCssClass = "row";

        // video
        $this->video->RowCssClass = "row";

        // berita
        $this->berita->RowCssClass = "row";

        // gambar
        $this->gambar->RowCssClass = "row";

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // grup
            $this->grup->ViewValue = $this->grup->CurrentValue;
            $curVal = strval($this->grup->CurrentValue);
            if ($curVal != "") {
                $this->grup->ViewValue = $this->grup->lookupCacheOption($curVal);
                if ($this->grup->ViewValue === null) { // Lookup from database
                    $filterWrk = "`nama`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->grup->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->grup->Lookup->renderViewRow($rswrk[0]);
                        $this->grup->ViewValue = $this->grup->displayValue($arwrk);
                    } else {
                        $this->grup->ViewValue = $this->grup->CurrentValue;
                    }
                }
            } else {
                $this->grup->ViewValue = null;
            }
            $this->grup->ViewCustomAttributes = "";

            // judul
            $this->judul->ViewValue = $this->judul->CurrentValue;
            $this->judul->ViewCustomAttributes = "";

            // c_by
            $this->c_by->ViewValue = $this->c_by->CurrentValue;
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

            // c_date
            $this->c_date->ViewValue = $this->c_date->CurrentValue;
            $this->c_date->ViewValue = FormatDateTime($this->c_date->ViewValue, $this->c_date->formatPattern());
            $this->c_date->ViewCustomAttributes = "";

            // aktif
            $this->aktif->ViewValue = $this->aktif->CurrentValue;
            $this->aktif->ViewValue = FormatNumber($this->aktif->ViewValue, $this->aktif->formatPattern());
            $this->aktif->ViewCustomAttributes = "";

            // video
            if (!EmptyValue($this->video->Upload->DbValue)) {
                $this->video->ViewValue = $this->video->Upload->DbValue;
            } else {
                $this->video->ViewValue = "";
            }
            $this->video->ViewCustomAttributes = "";

            // berita
            $this->berita->ViewValue = $this->berita->CurrentValue;
            $this->berita->ViewCustomAttributes = "";

            // gambar
            if (!EmptyValue($this->gambar->Upload->DbValue)) {
                $this->gambar->ViewValue = $this->gambar->Upload->DbValue;
            } else {
                $this->gambar->ViewValue = "";
            }
            $this->gambar->ViewCustomAttributes = "";

            // grup
            $this->grup->LinkCustomAttributes = "";
            $this->grup->HrefValue = "";

            // judul
            $this->judul->LinkCustomAttributes = "";
            $this->judul->HrefValue = "";

            // c_by
            $this->c_by->LinkCustomAttributes = "";
            $this->c_by->HrefValue = "";

            // c_date
            $this->c_date->LinkCustomAttributes = "";
            $this->c_date->HrefValue = "";

            // aktif
            $this->aktif->LinkCustomAttributes = "";
            $this->aktif->HrefValue = "";

            // video
            $this->video->LinkCustomAttributes = "";
            $this->video->HrefValue = "";
            $this->video->ExportHrefValue = $this->video->UploadPath . $this->video->Upload->DbValue;

            // berita
            $this->berita->LinkCustomAttributes = "";
            $this->berita->HrefValue = "";

            // gambar
            $this->gambar->LinkCustomAttributes = "";
            $this->gambar->HrefValue = "";
            $this->gambar->ExportHrefValue = $this->gambar->UploadPath . $this->gambar->Upload->DbValue;
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // grup
            $this->grup->setupEditAttributes();
            $this->grup->EditCustomAttributes = "";
            if (!$this->grup->Raw) {
                $this->grup->CurrentValue = HtmlDecode($this->grup->CurrentValue);
            }
            $this->grup->EditValue = HtmlEncode($this->grup->CurrentValue);
            $curVal = strval($this->grup->CurrentValue);
            if ($curVal != "") {
                $this->grup->EditValue = $this->grup->lookupCacheOption($curVal);
                if ($this->grup->EditValue === null) { // Lookup from database
                    $filterWrk = "`nama`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->grup->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->grup->Lookup->renderViewRow($rswrk[0]);
                        $this->grup->EditValue = $this->grup->displayValue($arwrk);
                    } else {
                        $this->grup->EditValue = HtmlEncode($this->grup->CurrentValue);
                    }
                }
            } else {
                $this->grup->EditValue = null;
            }
            $this->grup->PlaceHolder = RemoveHtml($this->grup->caption());

            // judul
            $this->judul->setupEditAttributes();
            $this->judul->EditCustomAttributes = "";
            if (!$this->judul->Raw) {
                $this->judul->CurrentValue = HtmlDecode($this->judul->CurrentValue);
            }
            $this->judul->EditValue = HtmlEncode($this->judul->CurrentValue);
            $this->judul->PlaceHolder = RemoveHtml($this->judul->caption());

            // c_by

            // c_date

            // aktif
            $this->aktif->setupEditAttributes();
            $this->aktif->EditCustomAttributes = "";
            $this->aktif->EditValue = HtmlEncode($this->aktif->CurrentValue);
            $this->aktif->PlaceHolder = RemoveHtml($this->aktif->caption());
            if (strval($this->aktif->EditValue) != "" && is_numeric($this->aktif->EditValue)) {
                $this->aktif->EditValue = FormatNumber($this->aktif->EditValue, null);
            }

            // video
            $this->video->setupEditAttributes();
            $this->video->EditCustomAttributes = "";
            if (!EmptyValue($this->video->Upload->DbValue)) {
                $this->video->EditValue = $this->video->Upload->DbValue;
            } else {
                $this->video->EditValue = "";
            }
            if (!EmptyValue($this->video->CurrentValue)) {
                $this->video->Upload->FileName = $this->video->CurrentValue;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->video);
            }

            // berita
            $this->berita->setupEditAttributes();
            $this->berita->EditCustomAttributes = "";
            $this->berita->EditValue = HtmlEncode($this->berita->CurrentValue);
            $this->berita->PlaceHolder = RemoveHtml($this->berita->caption());

            // gambar
            $this->gambar->setupEditAttributes();
            $this->gambar->EditCustomAttributes = "";
            if (!EmptyValue($this->gambar->Upload->DbValue)) {
                $this->gambar->EditValue = $this->gambar->Upload->DbValue;
            } else {
                $this->gambar->EditValue = "";
            }
            if (!EmptyValue($this->gambar->CurrentValue)) {
                $this->gambar->Upload->FileName = $this->gambar->CurrentValue;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->gambar);
            }

            // Add refer script

            // grup
            $this->grup->LinkCustomAttributes = "";
            $this->grup->HrefValue = "";

            // judul
            $this->judul->LinkCustomAttributes = "";
            $this->judul->HrefValue = "";

            // c_by
            $this->c_by->LinkCustomAttributes = "";
            $this->c_by->HrefValue = "";

            // c_date
            $this->c_date->LinkCustomAttributes = "";
            $this->c_date->HrefValue = "";

            // aktif
            $this->aktif->LinkCustomAttributes = "";
            $this->aktif->HrefValue = "";

            // video
            $this->video->LinkCustomAttributes = "";
            $this->video->HrefValue = "";
            $this->video->ExportHrefValue = $this->video->UploadPath . $this->video->Upload->DbValue;

            // berita
            $this->berita->LinkCustomAttributes = "";
            $this->berita->HrefValue = "";

            // gambar
            $this->gambar->LinkCustomAttributes = "";
            $this->gambar->HrefValue = "";
            $this->gambar->ExportHrefValue = $this->gambar->UploadPath . $this->gambar->Upload->DbValue;
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
        if ($this->grup->Required) {
            if (!$this->grup->IsDetailKey && EmptyValue($this->grup->FormValue)) {
                $this->grup->addErrorMessage(str_replace("%s", $this->grup->caption(), $this->grup->RequiredErrorMessage));
            }
        }
        if ($this->judul->Required) {
            if (!$this->judul->IsDetailKey && EmptyValue($this->judul->FormValue)) {
                $this->judul->addErrorMessage(str_replace("%s", $this->judul->caption(), $this->judul->RequiredErrorMessage));
            }
        }
        if ($this->c_by->Required) {
            if (!$this->c_by->IsDetailKey && EmptyValue($this->c_by->FormValue)) {
                $this->c_by->addErrorMessage(str_replace("%s", $this->c_by->caption(), $this->c_by->RequiredErrorMessage));
            }
        }
        if ($this->c_date->Required) {
            if (!$this->c_date->IsDetailKey && EmptyValue($this->c_date->FormValue)) {
                $this->c_date->addErrorMessage(str_replace("%s", $this->c_date->caption(), $this->c_date->RequiredErrorMessage));
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
        if ($this->video->Required) {
            if ($this->video->Upload->FileName == "" && !$this->video->Upload->KeepFile) {
                $this->video->addErrorMessage(str_replace("%s", $this->video->caption(), $this->video->RequiredErrorMessage));
            }
        }
        if ($this->berita->Required) {
            if (!$this->berita->IsDetailKey && EmptyValue($this->berita->FormValue)) {
                $this->berita->addErrorMessage(str_replace("%s", $this->berita->caption(), $this->berita->RequiredErrorMessage));
            }
        }
        if ($this->gambar->Required) {
            if ($this->gambar->Upload->FileName == "" && !$this->gambar->Upload->KeepFile) {
                $this->gambar->addErrorMessage(str_replace("%s", $this->gambar->caption(), $this->gambar->RequiredErrorMessage));
            }
        }

        // Validate detail grid
        $detailTblVar = explode(",", $this->getCurrentDetailTable());
        $detailPage = Container("KomentarGrid");
        if (in_array("komentar", $detailTblVar) && $detailPage->DetailAdd) {
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set new row
        $rsnew = [];

        // grup
        $this->grup->setDbValueDef($rsnew, $this->grup->CurrentValue, null, false);

        // judul
        $this->judul->setDbValueDef($rsnew, $this->judul->CurrentValue, null, false);

        // c_by
        $this->c_by->CurrentValue = CurrentUserID();
        $this->c_by->setDbValueDef($rsnew, $this->c_by->CurrentValue, null);

        // c_date
        $this->c_date->CurrentValue = CurrentDateTime();
        $this->c_date->setDbValueDef($rsnew, $this->c_date->CurrentValue, null);

        // aktif
        $this->aktif->setDbValueDef($rsnew, $this->aktif->CurrentValue, null, false);

        // video
        if ($this->video->Visible && !$this->video->Upload->KeepFile) {
            $this->video->Upload->DbValue = ""; // No need to delete old file
            if ($this->video->Upload->FileName == "") {
                $rsnew['video'] = null;
            } else {
                $rsnew['video'] = $this->video->Upload->FileName;
            }
        }

        // berita
        $this->berita->setDbValueDef($rsnew, $this->berita->CurrentValue, null, false);

        // gambar
        if ($this->gambar->Visible && !$this->gambar->Upload->KeepFile) {
            $this->gambar->Upload->DbValue = ""; // No need to delete old file
            if ($this->gambar->Upload->FileName == "") {
                $rsnew['gambar'] = null;
            } else {
                $rsnew['gambar'] = $this->gambar->Upload->FileName;
            }
        }
        if ($this->video->Visible && !$this->video->Upload->KeepFile) {
            $oldFiles = EmptyValue($this->video->Upload->DbValue) ? [] : [$this->video->htmlDecode($this->video->Upload->DbValue)];
            if (!EmptyValue($this->video->Upload->FileName)) {
                $newFiles = [$this->video->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->video, $this->video->Upload->Index);
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
                            $file1 = UniqueFilename($this->video->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->video->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->video->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->video->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->video->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->video->setDbValueDef($rsnew, $this->video->Upload->FileName, null, false);
            }
        }
        if ($this->gambar->Visible && !$this->gambar->Upload->KeepFile) {
            $oldFiles = EmptyValue($this->gambar->Upload->DbValue) ? [] : [$this->gambar->htmlDecode($this->gambar->Upload->DbValue)];
            if (!EmptyValue($this->gambar->Upload->FileName)) {
                $newFiles = [$this->gambar->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->gambar, $this->gambar->Upload->Index);
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
                            $file1 = UniqueFilename($this->gambar->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->gambar->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->gambar->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->gambar->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->gambar->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->gambar->setDbValueDef($rsnew, $this->gambar->Upload->FileName, null, false);
            }
        }

        // Update current values
        $this->setCurrentValues($rsnew);
        $conn = $this->getConnection();

        // Begin transaction
        if ($this->getCurrentDetailTable() != "" && $this->UseTransaction) {
            $conn->beginTransaction();
        }

        // Load db values from old row
        $this->loadDbValues($rsold);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
                if ($this->video->Visible && !$this->video->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->video->Upload->DbValue) ? [] : [$this->video->htmlDecode($this->video->Upload->DbValue)];
                    if (!EmptyValue($this->video->Upload->FileName)) {
                        $newFiles = [$this->video->Upload->FileName];
                        $newFiles2 = [$this->video->htmlDecode($rsnew['video'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->video, $this->video->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->video->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
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
                                @unlink($this->video->oldPhysicalUploadPath() . $oldFile);
                            }
                        }
                    }
                }
                if ($this->gambar->Visible && !$this->gambar->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->gambar->Upload->DbValue) ? [] : [$this->gambar->htmlDecode($this->gambar->Upload->DbValue)];
                    if (!EmptyValue($this->gambar->Upload->FileName)) {
                        $newFiles = [$this->gambar->Upload->FileName];
                        $newFiles2 = [$this->gambar->htmlDecode($rsnew['gambar'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->gambar, $this->gambar->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->gambar->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
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
                                @unlink($this->gambar->oldPhysicalUploadPath() . $oldFile);
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

        // Add detail records
        if ($addRow) {
            $detailTblVar = explode(",", $this->getCurrentDetailTable());
            $detailPage = Container("KomentarGrid");
            if (in_array("komentar", $detailTblVar) && $detailPage->DetailAdd) {
                $detailPage->pid->setSessionValue($this->id->CurrentValue); // Set master key
                $Security->loadCurrentUserLevel($this->ProjectID . "komentar"); // Load user level of detail table
                $addRow = $detailPage->gridInsert();
                $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                if (!$addRow) {
                $detailPage->pid->setSessionValue(""); // Clear master key if insert failed
                }
            }
        }

        // Commit/Rollback transaction
        if ($this->getCurrentDetailTable() != "") {
            if ($addRow) {
                if ($this->UseTransaction) { // Commit transaction
                    $conn->commit();
                }
            } else {
                if ($this->UseTransaction) { // Rollback transaction
                    $conn->rollback();
                }
            }
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
            // video
            CleanUploadTempPath($this->video, $this->video->Upload->Index);

            // gambar
            CleanUploadTempPath($this->gambar, $this->gambar->Upload->Index);
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
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
            if (in_array("komentar", $detailTblVar)) {
                $detailPageObj = Container("KomentarGrid");
                if ($detailPageObj->DetailAdd) {
                    if ($this->CopyRecord) {
                        $detailPageObj->CurrentMode = "copy";
                    } else {
                        $detailPageObj->CurrentMode = "add";
                    }
                    $detailPageObj->CurrentAction = "gridadd";

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("BeritaList"), "", $this->TableVar, true);
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
                case "x_grup":
                    break;
                case "x_c_by":
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
