<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class AbsenDetilEdit extends AbsenDetil
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'absen_detil';

    // Page object name
    public $PageObjName = "AbsenDetilEdit";

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

    // Properties
    public $FormClassName = "ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

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
        $this->pid->Visible = false;
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

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-edit-form";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("id") ?? Key(0) ?? Route(2)) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->id->setOldValue($this->id->QueryStringValue);
            } elseif (Post("id") !== null) {
                $this->id->setFormValue(Post("id"));
                $this->id->setOldValue($this->id->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("id") ?? Route("id")) !== null) {
                    $this->id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id->CurrentValue = null;
                }
            }

            // Set up master detail parameters
            $this->setupMasterParms();

            // Load recordset
            if ($this->isShow()) {
                    // Load current record
                    $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                    if (!$loaded) { // Load record based on key
                        if ($this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                        }
                        $this->terminate("AbsenDetilList"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "AbsenDetilList") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsApi()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
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
        if (!$this->id->IsDetailKey) {
            $this->id->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
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
        } elseif ($this->RowType == ROWTYPE_EDIT) {
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

            // Edit refer script

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

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();

        // Load old row
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssociative($sql);
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            return false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
        }

        // Set new row
        $rsnew = [];

        // pegawai
        $this->pegawai->setDbValueDef($rsnew, $this->pegawai->CurrentValue, null, $this->pegawai->ReadOnly);

        // masuk
        $this->masuk->setDbValueDef($rsnew, $this->masuk->CurrentValue, null, $this->masuk->ReadOnly);

        // absen
        $this->absen->setDbValueDef($rsnew, $this->absen->CurrentValue, null, $this->absen->ReadOnly);

        // ijin
        $this->ijin->setDbValueDef($rsnew, $this->ijin->CurrentValue, null, $this->ijin->ReadOnly);

        // cuti
        $this->cuti->setDbValueDef($rsnew, $this->cuti->CurrentValue, null, $this->cuti->ReadOnly);

        // dinas_luar
        $this->dinas_luar->setDbValueDef($rsnew, $this->dinas_luar->CurrentValue, null, $this->dinas_luar->ReadOnly);

        // terlambat
        $this->terlambat->setDbValueDef($rsnew, $this->terlambat->CurrentValue, null, $this->terlambat->ReadOnly);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check referential integrity for master table 'absen'
        $detailKeys = [];
        $keyValue = $rsnew['pid'] ?? $rsold['pid'];
        $detailKeys['pid'] = $keyValue;
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

        // Call Row Updating event
        $updateRow = $this->rowUpdating($rsold, $rsnew);
        if ($updateRow) {
            if (count($rsnew) > 0) {
                $this->CurrentFilter = $filter; // Set up current filter
                $editRow = $this->update($rsnew, "", $rsold);
            } else {
                $editRow = true; // No field to update
            }
            if ($editRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("UpdateCancelled"));
            }
            $editRow = false;
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($editRow) {
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
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
            $this->setSessionWhere($this->getDetailFilterFromSession());

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
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
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

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            if ($startRec !== null && is_numeric($startRec)) { // Check for "start" parameter
                $this->StartRecord = $startRec;
                $this->setStartRecordNumber($this->StartRecord);
            }
        }
        $this->StartRecord = $this->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
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
