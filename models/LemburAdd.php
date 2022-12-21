<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class LemburAdd extends Lembur
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'lembur';

    // Page object name
    public $PageObjName = "LemburAdd";

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

        // Table object (lembur)
        if (!isset($GLOBALS["lembur"]) || get_class($GLOBALS["lembur"]) == PROJECT_NAMESPACE . "lembur") {
            $GLOBALS["lembur"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'lembur');
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
                $tbl = Container("lembur");
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
                    if ($pageName == "LemburView") {
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
		        $this->dokumen->OldUploadPath = "lembur";
		        $this->dokumen->UploadPath = $this->dokumen->OldUploadPath;
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
        $this->pegawai->setVisibility();
        $this->proyek->setVisibility();
        $this->pm->setVisibility();
        $this->tgl->setVisibility();
        $this->tgl_awal_lembur->setVisibility();
        $this->tgl_akhir_lembur->setVisibility();
        $this->total_jam->setVisibility();
        $this->jenis->setVisibility();
        $this->keterangan->setVisibility();
        $this->disetujui->setVisibility();
        $this->dokumen->setVisibility();
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
        $this->setupLookupOptions($this->proyek);
        $this->setupLookupOptions($this->pm);
        $this->setupLookupOptions($this->jenis);
        $this->setupLookupOptions($this->disetujui);

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
                    $this->terminate("LemburList"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "LemburList") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "LemburView") {
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
        $this->dokumen->Upload->Index = $CurrentForm->Index;
        $this->dokumen->Upload->uploadFile();
        $this->dokumen->CurrentValue = $this->dokumen->Upload->FileName;
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

        // Check field name 'pegawai' first before field var 'x_pegawai'
        $val = $CurrentForm->hasValue("pegawai") ? $CurrentForm->getValue("pegawai") : $CurrentForm->getValue("x_pegawai");
        if (!$this->pegawai->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pegawai->Visible = false; // Disable update for API request
            } else {
                $this->pegawai->setFormValue($val, true, $validate);
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

        // Check field name 'pm' first before field var 'x_pm'
        $val = $CurrentForm->hasValue("pm") ? $CurrentForm->getValue("pm") : $CurrentForm->getValue("x_pm");
        if (!$this->pm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pm->Visible = false; // Disable update for API request
            } else {
                $this->pm->setFormValue($val, true, $validate);
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

        // Check field name 'tgl_awal_lembur' first before field var 'x_tgl_awal_lembur'
        $val = $CurrentForm->hasValue("tgl_awal_lembur") ? $CurrentForm->getValue("tgl_awal_lembur") : $CurrentForm->getValue("x_tgl_awal_lembur");
        if (!$this->tgl_awal_lembur->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tgl_awal_lembur->Visible = false; // Disable update for API request
            } else {
                $this->tgl_awal_lembur->setFormValue($val, true, $validate);
            }
            $this->tgl_awal_lembur->CurrentValue = UnFormatDateTime($this->tgl_awal_lembur->CurrentValue, $this->tgl_awal_lembur->formatPattern());
        }

        // Check field name 'tgl_akhir_lembur' first before field var 'x_tgl_akhir_lembur'
        $val = $CurrentForm->hasValue("tgl_akhir_lembur") ? $CurrentForm->getValue("tgl_akhir_lembur") : $CurrentForm->getValue("x_tgl_akhir_lembur");
        if (!$this->tgl_akhir_lembur->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tgl_akhir_lembur->Visible = false; // Disable update for API request
            } else {
                $this->tgl_akhir_lembur->setFormValue($val, true, $validate);
            }
            $this->tgl_akhir_lembur->CurrentValue = UnFormatDateTime($this->tgl_akhir_lembur->CurrentValue, $this->tgl_akhir_lembur->formatPattern());
        }

        // Check field name 'total_jam' first before field var 'x_total_jam'
        $val = $CurrentForm->hasValue("total_jam") ? $CurrentForm->getValue("total_jam") : $CurrentForm->getValue("x_total_jam");
        if (!$this->total_jam->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->total_jam->Visible = false; // Disable update for API request
            } else {
                $this->total_jam->setFormValue($val, true, $validate);
            }
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

        // Check field name 'disetujui' first before field var 'x_disetujui'
        $val = $CurrentForm->hasValue("disetujui") ? $CurrentForm->getValue("disetujui") : $CurrentForm->getValue("x_disetujui");
        if (!$this->disetujui->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->disetujui->Visible = false; // Disable update for API request
            } else {
                $this->disetujui->setFormValue($val);
            }
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		$this->dokumen->OldUploadPath = "lembur";
		$this->dokumen->UploadPath = $this->dokumen->OldUploadPath;
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->pegawai->CurrentValue = $this->pegawai->FormValue;
        $this->proyek->CurrentValue = $this->proyek->FormValue;
        $this->pm->CurrentValue = $this->pm->FormValue;
        $this->tgl->CurrentValue = $this->tgl->FormValue;
        $this->tgl->CurrentValue = UnFormatDateTime($this->tgl->CurrentValue, $this->tgl->formatPattern());
        $this->tgl_awal_lembur->CurrentValue = $this->tgl_awal_lembur->FormValue;
        $this->tgl_awal_lembur->CurrentValue = UnFormatDateTime($this->tgl_awal_lembur->CurrentValue, $this->tgl_awal_lembur->formatPattern());
        $this->tgl_akhir_lembur->CurrentValue = $this->tgl_akhir_lembur->FormValue;
        $this->tgl_akhir_lembur->CurrentValue = UnFormatDateTime($this->tgl_akhir_lembur->CurrentValue, $this->tgl_akhir_lembur->formatPattern());
        $this->total_jam->CurrentValue = $this->total_jam->FormValue;
        $this->jenis->CurrentValue = $this->jenis->FormValue;
        $this->keterangan->CurrentValue = $this->keterangan->FormValue;
        $this->disetujui->CurrentValue = $this->disetujui->FormValue;
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
        $this->proyek->setDbValue($row['proyek']);
        $this->pm->setDbValue($row['pm']);
        $this->tgl->setDbValue($row['tgl']);
        $this->tgl_awal_lembur->setDbValue($row['tgl_awal_lembur']);
        $this->tgl_akhir_lembur->setDbValue($row['tgl_akhir_lembur']);
        $this->total_jam->setDbValue($row['total_jam']);
        $this->jenis->setDbValue($row['jenis']);
        $this->keterangan->setDbValue($row['keterangan']);
        $this->disetujui->setDbValue($row['disetujui']);
        $this->dokumen->Upload->DbValue = $row['dokumen'];
        $this->dokumen->setDbValue($this->dokumen->Upload->DbValue);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['pegawai'] = $this->pegawai->DefaultValue;
        $row['proyek'] = $this->proyek->DefaultValue;
        $row['pm'] = $this->pm->DefaultValue;
        $row['tgl'] = $this->tgl->DefaultValue;
        $row['tgl_awal_lembur'] = $this->tgl_awal_lembur->DefaultValue;
        $row['tgl_akhir_lembur'] = $this->tgl_akhir_lembur->DefaultValue;
        $row['total_jam'] = $this->total_jam->DefaultValue;
        $row['jenis'] = $this->jenis->DefaultValue;
        $row['keterangan'] = $this->keterangan->DefaultValue;
        $row['disetujui'] = $this->disetujui->DefaultValue;
        $row['dokumen'] = $this->dokumen->DefaultValue;
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

        // proyek
        $this->proyek->RowCssClass = "row";

        // pm
        $this->pm->RowCssClass = "row";

        // tgl
        $this->tgl->RowCssClass = "row";

        // tgl_awal_lembur
        $this->tgl_awal_lembur->RowCssClass = "row";

        // tgl_akhir_lembur
        $this->tgl_akhir_lembur->RowCssClass = "row";

        // total_jam
        $this->total_jam->RowCssClass = "row";

        // jenis
        $this->jenis->RowCssClass = "row";

        // keterangan
        $this->keterangan->RowCssClass = "row";

        // disetujui
        $this->disetujui->RowCssClass = "row";

        // dokumen
        $this->dokumen->RowCssClass = "row";

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

            // proyek
            $this->proyek->ViewValue = $this->proyek->CurrentValue;
            $curVal = strval($this->proyek->CurrentValue);
            if ($curVal != "") {
                $this->proyek->ViewValue = $this->proyek->lookupCacheOption($curVal);
                if ($this->proyek->ViewValue === null) { // Lookup from database
                    $filterWrk = "`proyek`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->proyek->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->proyek->Lookup->renderViewRow($rswrk[0]);
                        $this->proyek->ViewValue = $this->proyek->displayValue($arwrk);
                    } else {
                        $this->proyek->ViewValue = $this->proyek->CurrentValue;
                    }
                }
            } else {
                $this->proyek->ViewValue = null;
            }
            $this->proyek->ViewCustomAttributes = "";

            // pm
            $this->pm->ViewValue = $this->pm->CurrentValue;
            $curVal = strval($this->pm->CurrentValue);
            if ($curVal != "") {
                $this->pm->ViewValue = $this->pm->lookupCacheOption($curVal);
                if ($this->pm->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->pm->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->pm->Lookup->renderViewRow($rswrk[0]);
                        $this->pm->ViewValue = $this->pm->displayValue($arwrk);
                    } else {
                        $this->pm->ViewValue = FormatNumber($this->pm->CurrentValue, $this->pm->formatPattern());
                    }
                }
            } else {
                $this->pm->ViewValue = null;
            }
            $this->pm->ViewCustomAttributes = "";

            // tgl
            $this->tgl->ViewValue = $this->tgl->CurrentValue;
            $this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, $this->tgl->formatPattern());
            $this->tgl->ViewCustomAttributes = "";

            // tgl_awal_lembur
            $this->tgl_awal_lembur->ViewValue = $this->tgl_awal_lembur->CurrentValue;
            $this->tgl_awal_lembur->ViewValue = FormatDateTime($this->tgl_awal_lembur->ViewValue, $this->tgl_awal_lembur->formatPattern());
            $this->tgl_awal_lembur->ViewCustomAttributes = "";

            // tgl_akhir_lembur
            $this->tgl_akhir_lembur->ViewValue = $this->tgl_akhir_lembur->CurrentValue;
            $this->tgl_akhir_lembur->ViewValue = FormatDateTime($this->tgl_akhir_lembur->ViewValue, $this->tgl_akhir_lembur->formatPattern());
            $this->tgl_akhir_lembur->ViewCustomAttributes = "";

            // total_jam
            $this->total_jam->ViewValue = $this->total_jam->CurrentValue;
            $this->total_jam->ViewValue = FormatNumber($this->total_jam->ViewValue, $this->total_jam->formatPattern());
            $this->total_jam->ViewCustomAttributes = "";

            // jenis
            $this->jenis->ViewValue = $this->jenis->CurrentValue;
            $curVal = strval($this->jenis->CurrentValue);
            if ($curVal != "") {
                $this->jenis->ViewValue = $this->jenis->lookupCacheOption($curVal);
                if ($this->jenis->ViewValue === null) { // Lookup from database
                    $filterWrk = "`nama`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->jenis->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->jenis->Lookup->renderViewRow($rswrk[0]);
                        $this->jenis->ViewValue = $this->jenis->displayValue($arwrk);
                    } else {
                        $this->jenis->ViewValue = $this->jenis->CurrentValue;
                    }
                }
            } else {
                $this->jenis->ViewValue = null;
            }
            $this->jenis->ViewCustomAttributes = "";

            // keterangan
            $this->keterangan->ViewValue = $this->keterangan->CurrentValue;
            $this->keterangan->ViewCustomAttributes = "";

            // disetujui
            if (strval($this->disetujui->CurrentValue) != "") {
                $this->disetujui->ViewValue = $this->disetujui->optionCaption($this->disetujui->CurrentValue);
            } else {
                $this->disetujui->ViewValue = null;
            }
            $this->disetujui->ViewCustomAttributes = "";

            // dokumen
            $this->dokumen->UploadPath = "lembur";
            if (!EmptyValue($this->dokumen->Upload->DbValue)) {
                $this->dokumen->ViewValue = $this->dokumen->Upload->DbValue;
            } else {
                $this->dokumen->ViewValue = "";
            }
            $this->dokumen->ViewCustomAttributes = "";

            // pegawai
            $this->pegawai->LinkCustomAttributes = "";
            $this->pegawai->HrefValue = "";

            // proyek
            $this->proyek->LinkCustomAttributes = "";
            $this->proyek->HrefValue = "";

            // pm
            $this->pm->LinkCustomAttributes = "";
            $this->pm->HrefValue = "";

            // tgl
            $this->tgl->LinkCustomAttributes = "";
            $this->tgl->HrefValue = "";

            // tgl_awal_lembur
            $this->tgl_awal_lembur->LinkCustomAttributes = "";
            $this->tgl_awal_lembur->HrefValue = "";

            // tgl_akhir_lembur
            $this->tgl_akhir_lembur->LinkCustomAttributes = "";
            $this->tgl_akhir_lembur->HrefValue = "";

            // total_jam
            $this->total_jam->LinkCustomAttributes = "";
            $this->total_jam->HrefValue = "";

            // jenis
            $this->jenis->LinkCustomAttributes = "";
            $this->jenis->HrefValue = "";

            // keterangan
            $this->keterangan->LinkCustomAttributes = "";
            $this->keterangan->HrefValue = "";

            // disetujui
            $this->disetujui->LinkCustomAttributes = "";
            $this->disetujui->HrefValue = "";

            // dokumen
            $this->dokumen->LinkCustomAttributes = "";
            $this->dokumen->HrefValue = "";
            $this->dokumen->ExportHrefValue = $this->dokumen->UploadPath . $this->dokumen->Upload->DbValue;
        } elseif ($this->RowType == ROWTYPE_ADD) {
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

            // proyek
            $this->proyek->setupEditAttributes();
            $this->proyek->EditCustomAttributes = "";
            if (!$this->proyek->Raw) {
                $this->proyek->CurrentValue = HtmlDecode($this->proyek->CurrentValue);
            }
            $this->proyek->EditValue = HtmlEncode($this->proyek->CurrentValue);
            $curVal = strval($this->proyek->CurrentValue);
            if ($curVal != "") {
                $this->proyek->EditValue = $this->proyek->lookupCacheOption($curVal);
                if ($this->proyek->EditValue === null) { // Lookup from database
                    $filterWrk = "`proyek`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->proyek->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->proyek->Lookup->renderViewRow($rswrk[0]);
                        $this->proyek->EditValue = $this->proyek->displayValue($arwrk);
                    } else {
                        $this->proyek->EditValue = HtmlEncode($this->proyek->CurrentValue);
                    }
                }
            } else {
                $this->proyek->EditValue = null;
            }
            $this->proyek->PlaceHolder = RemoveHtml($this->proyek->caption());

            // pm
            $this->pm->setupEditAttributes();
            $this->pm->EditCustomAttributes = "";
            $this->pm->EditValue = HtmlEncode($this->pm->CurrentValue);
            $curVal = strval($this->pm->CurrentValue);
            if ($curVal != "") {
                $this->pm->EditValue = $this->pm->lookupCacheOption($curVal);
                if ($this->pm->EditValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->pm->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->pm->Lookup->renderViewRow($rswrk[0]);
                        $this->pm->EditValue = $this->pm->displayValue($arwrk);
                    } else {
                        $this->pm->EditValue = HtmlEncode(FormatNumber($this->pm->CurrentValue, $this->pm->formatPattern()));
                    }
                }
            } else {
                $this->pm->EditValue = null;
            }
            $this->pm->PlaceHolder = RemoveHtml($this->pm->caption());

            // tgl

            // tgl_awal_lembur
            $this->tgl_awal_lembur->setupEditAttributes();
            $this->tgl_awal_lembur->EditCustomAttributes = "";
            $this->tgl_awal_lembur->EditValue = HtmlEncode(FormatDateTime($this->tgl_awal_lembur->CurrentValue, $this->tgl_awal_lembur->formatPattern()));
            $this->tgl_awal_lembur->PlaceHolder = RemoveHtml($this->tgl_awal_lembur->caption());

            // tgl_akhir_lembur
            $this->tgl_akhir_lembur->setupEditAttributes();
            $this->tgl_akhir_lembur->EditCustomAttributes = "";
            $this->tgl_akhir_lembur->EditValue = HtmlEncode(FormatDateTime($this->tgl_akhir_lembur->CurrentValue, $this->tgl_akhir_lembur->formatPattern()));
            $this->tgl_akhir_lembur->PlaceHolder = RemoveHtml($this->tgl_akhir_lembur->caption());

            // total_jam
            $this->total_jam->setupEditAttributes();
            $this->total_jam->EditCustomAttributes = "";
            $this->total_jam->EditValue = HtmlEncode($this->total_jam->CurrentValue);
            $this->total_jam->PlaceHolder = RemoveHtml($this->total_jam->caption());
            if (strval($this->total_jam->EditValue) != "" && is_numeric($this->total_jam->EditValue)) {
                $this->total_jam->EditValue = FormatNumber($this->total_jam->EditValue, null);
            }

            // jenis
            $this->jenis->setupEditAttributes();
            $this->jenis->EditCustomAttributes = "";
            if (!$this->jenis->Raw) {
                $this->jenis->CurrentValue = HtmlDecode($this->jenis->CurrentValue);
            }
            $this->jenis->EditValue = HtmlEncode($this->jenis->CurrentValue);
            $curVal = strval($this->jenis->CurrentValue);
            if ($curVal != "") {
                $this->jenis->EditValue = $this->jenis->lookupCacheOption($curVal);
                if ($this->jenis->EditValue === null) { // Lookup from database
                    $filterWrk = "`nama`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->jenis->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->jenis->Lookup->renderViewRow($rswrk[0]);
                        $this->jenis->EditValue = $this->jenis->displayValue($arwrk);
                    } else {
                        $this->jenis->EditValue = HtmlEncode($this->jenis->CurrentValue);
                    }
                }
            } else {
                $this->jenis->EditValue = null;
            }
            $this->jenis->PlaceHolder = RemoveHtml($this->jenis->caption());

            // keterangan
            $this->keterangan->setupEditAttributes();
            $this->keterangan->EditCustomAttributes = "";
            if (!$this->keterangan->Raw) {
                $this->keterangan->CurrentValue = HtmlDecode($this->keterangan->CurrentValue);
            }
            $this->keterangan->EditValue = HtmlEncode($this->keterangan->CurrentValue);
            $this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

            // disetujui
            $this->disetujui->EditCustomAttributes = "";
            $this->disetujui->EditValue = $this->disetujui->options(false);
            $this->disetujui->PlaceHolder = RemoveHtml($this->disetujui->caption());

            // dokumen
            $this->dokumen->setupEditAttributes();
            $this->dokumen->EditCustomAttributes = "";
            $this->dokumen->UploadPath = "lembur";
            if (!EmptyValue($this->dokumen->Upload->DbValue)) {
                $this->dokumen->EditValue = $this->dokumen->Upload->DbValue;
            } else {
                $this->dokumen->EditValue = "";
            }
            if (!EmptyValue($this->dokumen->CurrentValue)) {
                $this->dokumen->Upload->FileName = $this->dokumen->CurrentValue;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->dokumen);
            }

            // Add refer script

            // pegawai
            $this->pegawai->LinkCustomAttributes = "";
            $this->pegawai->HrefValue = "";

            // proyek
            $this->proyek->LinkCustomAttributes = "";
            $this->proyek->HrefValue = "";

            // pm
            $this->pm->LinkCustomAttributes = "";
            $this->pm->HrefValue = "";

            // tgl
            $this->tgl->LinkCustomAttributes = "";
            $this->tgl->HrefValue = "";

            // tgl_awal_lembur
            $this->tgl_awal_lembur->LinkCustomAttributes = "";
            $this->tgl_awal_lembur->HrefValue = "";

            // tgl_akhir_lembur
            $this->tgl_akhir_lembur->LinkCustomAttributes = "";
            $this->tgl_akhir_lembur->HrefValue = "";

            // total_jam
            $this->total_jam->LinkCustomAttributes = "";
            $this->total_jam->HrefValue = "";

            // jenis
            $this->jenis->LinkCustomAttributes = "";
            $this->jenis->HrefValue = "";

            // keterangan
            $this->keterangan->LinkCustomAttributes = "";
            $this->keterangan->HrefValue = "";

            // disetujui
            $this->disetujui->LinkCustomAttributes = "";
            $this->disetujui->HrefValue = "";

            // dokumen
            $this->dokumen->LinkCustomAttributes = "";
            $this->dokumen->HrefValue = "";
            $this->dokumen->ExportHrefValue = $this->dokumen->UploadPath . $this->dokumen->Upload->DbValue;
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
        if ($this->proyek->Required) {
            if (!$this->proyek->IsDetailKey && EmptyValue($this->proyek->FormValue)) {
                $this->proyek->addErrorMessage(str_replace("%s", $this->proyek->caption(), $this->proyek->RequiredErrorMessage));
            }
        }
        if ($this->pm->Required) {
            if (!$this->pm->IsDetailKey && EmptyValue($this->pm->FormValue)) {
                $this->pm->addErrorMessage(str_replace("%s", $this->pm->caption(), $this->pm->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pm->FormValue)) {
            $this->pm->addErrorMessage($this->pm->getErrorMessage(false));
        }
        if ($this->tgl->Required) {
            if (!$this->tgl->IsDetailKey && EmptyValue($this->tgl->FormValue)) {
                $this->tgl->addErrorMessage(str_replace("%s", $this->tgl->caption(), $this->tgl->RequiredErrorMessage));
            }
        }
        if ($this->tgl_awal_lembur->Required) {
            if (!$this->tgl_awal_lembur->IsDetailKey && EmptyValue($this->tgl_awal_lembur->FormValue)) {
                $this->tgl_awal_lembur->addErrorMessage(str_replace("%s", $this->tgl_awal_lembur->caption(), $this->tgl_awal_lembur->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tgl_awal_lembur->FormValue, $this->tgl_awal_lembur->formatPattern())) {
            $this->tgl_awal_lembur->addErrorMessage($this->tgl_awal_lembur->getErrorMessage(false));
        }
        if ($this->tgl_akhir_lembur->Required) {
            if (!$this->tgl_akhir_lembur->IsDetailKey && EmptyValue($this->tgl_akhir_lembur->FormValue)) {
                $this->tgl_akhir_lembur->addErrorMessage(str_replace("%s", $this->tgl_akhir_lembur->caption(), $this->tgl_akhir_lembur->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tgl_akhir_lembur->FormValue, $this->tgl_akhir_lembur->formatPattern())) {
            $this->tgl_akhir_lembur->addErrorMessage($this->tgl_akhir_lembur->getErrorMessage(false));
        }
        if ($this->total_jam->Required) {
            if (!$this->total_jam->IsDetailKey && EmptyValue($this->total_jam->FormValue)) {
                $this->total_jam->addErrorMessage(str_replace("%s", $this->total_jam->caption(), $this->total_jam->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->total_jam->FormValue)) {
            $this->total_jam->addErrorMessage($this->total_jam->getErrorMessage(false));
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
        if ($this->disetujui->Required) {
            if ($this->disetujui->FormValue == "") {
                $this->disetujui->addErrorMessage(str_replace("%s", $this->disetujui->caption(), $this->disetujui->RequiredErrorMessage));
            }
        }
        if ($this->dokumen->Required) {
            if ($this->dokumen->Upload->FileName == "" && !$this->dokumen->Upload->KeepFile) {
                $this->dokumen->addErrorMessage(str_replace("%s", $this->dokumen->caption(), $this->dokumen->RequiredErrorMessage));
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

        // pegawai
        $this->pegawai->setDbValueDef($rsnew, $this->pegawai->CurrentValue, null, false);

        // proyek
        $this->proyek->setDbValueDef($rsnew, $this->proyek->CurrentValue, null, false);

        // pm
        $this->pm->setDbValueDef($rsnew, $this->pm->CurrentValue, null, false);

        // tgl
        $this->tgl->CurrentValue = CurrentDateTime();
        $this->tgl->setDbValueDef($rsnew, $this->tgl->CurrentValue, null);

        // tgl_awal_lembur
        $this->tgl_awal_lembur->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_awal_lembur->CurrentValue, $this->tgl_awal_lembur->formatPattern()), null, false);

        // tgl_akhir_lembur
        $this->tgl_akhir_lembur->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_akhir_lembur->CurrentValue, $this->tgl_akhir_lembur->formatPattern()), null, false);

        // total_jam
        $this->total_jam->setDbValueDef($rsnew, $this->total_jam->CurrentValue, null, false);

        // jenis
        $this->jenis->setDbValueDef($rsnew, $this->jenis->CurrentValue, null, false);

        // keterangan
        $this->keterangan->setDbValueDef($rsnew, $this->keterangan->CurrentValue, null, false);

        // disetujui
        $this->disetujui->setDbValueDef($rsnew, $this->disetujui->CurrentValue, null, false);

        // dokumen
        if ($this->dokumen->Visible && !$this->dokumen->Upload->KeepFile) {
            $this->dokumen->Upload->DbValue = ""; // No need to delete old file
            if ($this->dokumen->Upload->FileName == "") {
                $rsnew['dokumen'] = null;
            } else {
                $rsnew['dokumen'] = $this->dokumen->Upload->FileName;
            }
        }
        if ($this->dokumen->Visible && !$this->dokumen->Upload->KeepFile) {
            $this->dokumen->UploadPath = "lembur";
            $oldFiles = EmptyValue($this->dokumen->Upload->DbValue) ? [] : [$this->dokumen->htmlDecode($this->dokumen->Upload->DbValue)];
            if (!EmptyValue($this->dokumen->Upload->FileName)) {
                $newFiles = [$this->dokumen->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->dokumen, $this->dokumen->Upload->Index);
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
                            $file1 = UniqueFilename($this->dokumen->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->dokumen->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->dokumen->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->dokumen->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->dokumen->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->dokumen->setDbValueDef($rsnew, $this->dokumen->Upload->FileName, null, false);
            }
        }

        // Update current values
        $this->setCurrentValues($rsnew);
        $conn = $this->getConnection();

        // Load db values from old row
        $this->loadDbValues($rsold);
        $this->dokumen->OldUploadPath = "lembur";
        $this->dokumen->UploadPath = $this->dokumen->OldUploadPath;

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        if ($insertRow) {
            $addRow = $this->insert($rsnew);
            if ($addRow) {
                if ($this->dokumen->Visible && !$this->dokumen->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->dokumen->Upload->DbValue) ? [] : [$this->dokumen->htmlDecode($this->dokumen->Upload->DbValue)];
                    if (!EmptyValue($this->dokumen->Upload->FileName)) {
                        $newFiles = [$this->dokumen->Upload->FileName];
                        $newFiles2 = [$this->dokumen->htmlDecode($rsnew['dokumen'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->dokumen, $this->dokumen->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->dokumen->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
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
                                @unlink($this->dokumen->oldPhysicalUploadPath() . $oldFile);
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
            // dokumen
            CleanUploadTempPath($this->dokumen, $this->dokumen->Upload->Index);
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("LemburList"), "", $this->TableVar, true);
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
                case "x_proyek":
                    break;
                case "x_pm":
                    break;
                case "x_jenis":
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
        if(CurrentUserLevel() == '1' || CurrentUserLevel() == '2') {
            $id_user = CurrentUserInfo("id");
    	    if($id_user != '' OR $id_user != FALSE) {
            $this->pegawai->CurrentValue = $id_user ;
            $this->pegawai->ReadOnly = TRUE;
            }
            $this->disetujui->ReadOnly = TRUE;
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
