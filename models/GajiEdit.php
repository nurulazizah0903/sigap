<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class GajiEdit extends Gaji
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'gaji';

    // Page object name
    public $PageObjName = "GajiEdit";

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
        $this->jabatan_id->setVisibility();
        $this->pegawai->setVisibility();
        $this->lembur->setVisibility();
        $this->value_lembur->setVisibility();
        $this->kehadiran->setVisibility();
        $this->gapok->setVisibility();
        $this->value_reward->setVisibility();
        $this->value_inval->setVisibility();
        $this->piket_count->setVisibility();
        $this->value_piket->setVisibility();
        $this->tugastambahan->setVisibility();
        $this->tj_jabatan->setVisibility();
        $this->sub_total->setVisibility();
        $this->potongan->setVisibility();
        $this->total->setVisibility();
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
                        $this->terminate("GajiList"); // No matching record, return to list
                        return;
                    }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "GajiList") {
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

        // Check field name 'value_lembur' first before field var 'x_value_lembur'
        $val = $CurrentForm->hasValue("value_lembur") ? $CurrentForm->getValue("value_lembur") : $CurrentForm->getValue("x_value_lembur");
        if (!$this->value_lembur->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->value_lembur->Visible = false; // Disable update for API request
            } else {
                $this->value_lembur->setFormValue($val, true, $validate);
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

        // Check field name 'gapok' first before field var 'x_gapok'
        $val = $CurrentForm->hasValue("gapok") ? $CurrentForm->getValue("gapok") : $CurrentForm->getValue("x_gapok");
        if (!$this->gapok->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gapok->Visible = false; // Disable update for API request
            } else {
                $this->gapok->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'value_reward' first before field var 'x_value_reward'
        $val = $CurrentForm->hasValue("value_reward") ? $CurrentForm->getValue("value_reward") : $CurrentForm->getValue("x_value_reward");
        if (!$this->value_reward->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->value_reward->Visible = false; // Disable update for API request
            } else {
                $this->value_reward->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'value_inval' first before field var 'x_value_inval'
        $val = $CurrentForm->hasValue("value_inval") ? $CurrentForm->getValue("value_inval") : $CurrentForm->getValue("x_value_inval");
        if (!$this->value_inval->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->value_inval->Visible = false; // Disable update for API request
            } else {
                $this->value_inval->setFormValue($val, true, $validate);
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

        // Check field name 'value_piket' first before field var 'x_value_piket'
        $val = $CurrentForm->hasValue("value_piket") ? $CurrentForm->getValue("value_piket") : $CurrentForm->getValue("x_value_piket");
        if (!$this->value_piket->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->value_piket->Visible = false; // Disable update for API request
            } else {
                $this->value_piket->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'tugastambahan' first before field var 'x_tugastambahan'
        $val = $CurrentForm->hasValue("tugastambahan") ? $CurrentForm->getValue("tugastambahan") : $CurrentForm->getValue("x_tugastambahan");
        if (!$this->tugastambahan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tugastambahan->Visible = false; // Disable update for API request
            } else {
                $this->tugastambahan->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'tj_jabatan' first before field var 'x_tj_jabatan'
        $val = $CurrentForm->hasValue("tj_jabatan") ? $CurrentForm->getValue("tj_jabatan") : $CurrentForm->getValue("x_tj_jabatan");
        if (!$this->tj_jabatan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tj_jabatan->Visible = false; // Disable update for API request
            } else {
                $this->tj_jabatan->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'sub_total' first before field var 'x_sub_total'
        $val = $CurrentForm->hasValue("sub_total") ? $CurrentForm->getValue("sub_total") : $CurrentForm->getValue("x_sub_total");
        if (!$this->sub_total->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->sub_total->Visible = false; // Disable update for API request
            } else {
                $this->sub_total->setFormValue($val, true, $validate);
            }
        }

        // Check field name 'potongan' first before field var 'x_potongan'
        $val = $CurrentForm->hasValue("potongan") ? $CurrentForm->getValue("potongan") : $CurrentForm->getValue("x_potongan");
        if (!$this->potongan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->potongan->Visible = false; // Disable update for API request
            } else {
                $this->potongan->setFormValue($val, true, $validate);
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
        if (!$this->id->IsDetailKey) {
            $this->id->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->jabatan_id->CurrentValue = $this->jabatan_id->FormValue;
        $this->pegawai->CurrentValue = $this->pegawai->FormValue;
        $this->lembur->CurrentValue = $this->lembur->FormValue;
        $this->value_lembur->CurrentValue = $this->value_lembur->FormValue;
        $this->kehadiran->CurrentValue = $this->kehadiran->FormValue;
        $this->gapok->CurrentValue = $this->gapok->FormValue;
        $this->value_reward->CurrentValue = $this->value_reward->FormValue;
        $this->value_inval->CurrentValue = $this->value_inval->FormValue;
        $this->piket_count->CurrentValue = $this->piket_count->FormValue;
        $this->value_piket->CurrentValue = $this->value_piket->FormValue;
        $this->tugastambahan->CurrentValue = $this->tugastambahan->FormValue;
        $this->tj_jabatan->CurrentValue = $this->tj_jabatan->FormValue;
        $this->sub_total->CurrentValue = $this->sub_total->FormValue;
        $this->potongan->CurrentValue = $this->potongan->FormValue;
        $this->total->CurrentValue = $this->total->FormValue;
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

            // value_lembur
            $this->value_lembur->LinkCustomAttributes = "";
            $this->value_lembur->HrefValue = "";

            // kehadiran
            $this->kehadiran->LinkCustomAttributes = "";
            $this->kehadiran->HrefValue = "";

            // gapok
            $this->gapok->LinkCustomAttributes = "";
            $this->gapok->HrefValue = "";

            // value_reward
            $this->value_reward->LinkCustomAttributes = "";
            $this->value_reward->HrefValue = "";

            // value_inval
            $this->value_inval->LinkCustomAttributes = "";
            $this->value_inval->HrefValue = "";

            // piket_count
            $this->piket_count->LinkCustomAttributes = "";
            $this->piket_count->HrefValue = "";

            // value_piket
            $this->value_piket->LinkCustomAttributes = "";
            $this->value_piket->HrefValue = "";

            // tugastambahan
            $this->tugastambahan->LinkCustomAttributes = "";
            $this->tugastambahan->HrefValue = "";

            // tj_jabatan
            $this->tj_jabatan->LinkCustomAttributes = "";
            $this->tj_jabatan->HrefValue = "";

            // sub_total
            $this->sub_total->LinkCustomAttributes = "";
            $this->sub_total->HrefValue = "";

            // potongan
            $this->potongan->LinkCustomAttributes = "";
            $this->potongan->HrefValue = "";

            // total
            $this->total->LinkCustomAttributes = "";
            $this->total->HrefValue = "";

            // month
            $this->month->LinkCustomAttributes = "";
            $this->month->HrefValue = "";

            // datetime
            $this->datetime->LinkCustomAttributes = "";
            $this->datetime->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
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

            // value_lembur
            $this->value_lembur->setupEditAttributes();
            $this->value_lembur->EditCustomAttributes = "";
            $this->value_lembur->EditValue = HtmlEncode($this->value_lembur->CurrentValue);
            $this->value_lembur->PlaceHolder = RemoveHtml($this->value_lembur->caption());
            if (strval($this->value_lembur->EditValue) != "" && is_numeric($this->value_lembur->EditValue)) {
                $this->value_lembur->EditValue = FormatNumber($this->value_lembur->EditValue, null);
            }

            // kehadiran
            $this->kehadiran->setupEditAttributes();
            $this->kehadiran->EditCustomAttributes = "";
            $this->kehadiran->EditValue = HtmlEncode($this->kehadiran->CurrentValue);
            $this->kehadiran->PlaceHolder = RemoveHtml($this->kehadiran->caption());
            if (strval($this->kehadiran->EditValue) != "" && is_numeric($this->kehadiran->EditValue)) {
                $this->kehadiran->EditValue = FormatNumber($this->kehadiran->EditValue, null);
            }

            // gapok
            $this->gapok->setupEditAttributes();
            $this->gapok->EditCustomAttributes = "";
            $this->gapok->EditValue = HtmlEncode($this->gapok->CurrentValue);
            $this->gapok->PlaceHolder = RemoveHtml($this->gapok->caption());
            if (strval($this->gapok->EditValue) != "" && is_numeric($this->gapok->EditValue)) {
                $this->gapok->EditValue = FormatNumber($this->gapok->EditValue, null);
            }

            // value_reward
            $this->value_reward->setupEditAttributes();
            $this->value_reward->EditCustomAttributes = "";
            $this->value_reward->EditValue = HtmlEncode($this->value_reward->CurrentValue);
            $this->value_reward->PlaceHolder = RemoveHtml($this->value_reward->caption());
            if (strval($this->value_reward->EditValue) != "" && is_numeric($this->value_reward->EditValue)) {
                $this->value_reward->EditValue = FormatNumber($this->value_reward->EditValue, null);
            }

            // value_inval
            $this->value_inval->setupEditAttributes();
            $this->value_inval->EditCustomAttributes = "";
            $this->value_inval->EditValue = HtmlEncode($this->value_inval->CurrentValue);
            $this->value_inval->PlaceHolder = RemoveHtml($this->value_inval->caption());
            if (strval($this->value_inval->EditValue) != "" && is_numeric($this->value_inval->EditValue)) {
                $this->value_inval->EditValue = FormatNumber($this->value_inval->EditValue, null);
            }

            // piket_count
            $this->piket_count->setupEditAttributes();
            $this->piket_count->EditCustomAttributes = "";
            $this->piket_count->EditValue = HtmlEncode($this->piket_count->CurrentValue);
            $this->piket_count->PlaceHolder = RemoveHtml($this->piket_count->caption());
            if (strval($this->piket_count->EditValue) != "" && is_numeric($this->piket_count->EditValue)) {
                $this->piket_count->EditValue = FormatNumber($this->piket_count->EditValue, null);
            }

            // value_piket
            $this->value_piket->setupEditAttributes();
            $this->value_piket->EditCustomAttributes = "";
            $this->value_piket->EditValue = HtmlEncode($this->value_piket->CurrentValue);
            $this->value_piket->PlaceHolder = RemoveHtml($this->value_piket->caption());
            if (strval($this->value_piket->EditValue) != "" && is_numeric($this->value_piket->EditValue)) {
                $this->value_piket->EditValue = FormatNumber($this->value_piket->EditValue, null);
            }

            // tugastambahan
            $this->tugastambahan->setupEditAttributes();
            $this->tugastambahan->EditCustomAttributes = "";
            $this->tugastambahan->EditValue = HtmlEncode($this->tugastambahan->CurrentValue);
            $this->tugastambahan->PlaceHolder = RemoveHtml($this->tugastambahan->caption());
            if (strval($this->tugastambahan->EditValue) != "" && is_numeric($this->tugastambahan->EditValue)) {
                $this->tugastambahan->EditValue = FormatNumber($this->tugastambahan->EditValue, null);
            }

            // tj_jabatan
            $this->tj_jabatan->setupEditAttributes();
            $this->tj_jabatan->EditCustomAttributes = "";
            $this->tj_jabatan->EditValue = HtmlEncode($this->tj_jabatan->CurrentValue);
            $this->tj_jabatan->PlaceHolder = RemoveHtml($this->tj_jabatan->caption());
            if (strval($this->tj_jabatan->EditValue) != "" && is_numeric($this->tj_jabatan->EditValue)) {
                $this->tj_jabatan->EditValue = FormatNumber($this->tj_jabatan->EditValue, null);
            }

            // sub_total
            $this->sub_total->setupEditAttributes();
            $this->sub_total->EditCustomAttributes = "";
            $this->sub_total->EditValue = HtmlEncode($this->sub_total->CurrentValue);
            $this->sub_total->PlaceHolder = RemoveHtml($this->sub_total->caption());
            if (strval($this->sub_total->EditValue) != "" && is_numeric($this->sub_total->EditValue)) {
                $this->sub_total->EditValue = FormatNumber($this->sub_total->EditValue, null);
            }

            // potongan
            $this->potongan->setupEditAttributes();
            $this->potongan->EditCustomAttributes = "";
            $this->potongan->EditValue = HtmlEncode($this->potongan->CurrentValue);
            $this->potongan->PlaceHolder = RemoveHtml($this->potongan->caption());
            if (strval($this->potongan->EditValue) != "" && is_numeric($this->potongan->EditValue)) {
                $this->potongan->EditValue = FormatNumber($this->potongan->EditValue, null);
            }

            // total
            $this->total->setupEditAttributes();
            $this->total->EditCustomAttributes = "";
            $this->total->EditValue = HtmlEncode($this->total->CurrentValue);
            $this->total->PlaceHolder = RemoveHtml($this->total->caption());
            if (strval($this->total->EditValue) != "" && is_numeric($this->total->EditValue)) {
                $this->total->EditValue = FormatNumber($this->total->EditValue, null);
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

            // Edit refer script

            // jabatan_id
            $this->jabatan_id->LinkCustomAttributes = "";
            $this->jabatan_id->HrefValue = "";

            // pegawai
            $this->pegawai->LinkCustomAttributes = "";
            $this->pegawai->HrefValue = "";

            // lembur
            $this->lembur->LinkCustomAttributes = "";
            $this->lembur->HrefValue = "";

            // value_lembur
            $this->value_lembur->LinkCustomAttributes = "";
            $this->value_lembur->HrefValue = "";

            // kehadiran
            $this->kehadiran->LinkCustomAttributes = "";
            $this->kehadiran->HrefValue = "";

            // gapok
            $this->gapok->LinkCustomAttributes = "";
            $this->gapok->HrefValue = "";

            // value_reward
            $this->value_reward->LinkCustomAttributes = "";
            $this->value_reward->HrefValue = "";

            // value_inval
            $this->value_inval->LinkCustomAttributes = "";
            $this->value_inval->HrefValue = "";

            // piket_count
            $this->piket_count->LinkCustomAttributes = "";
            $this->piket_count->HrefValue = "";

            // value_piket
            $this->value_piket->LinkCustomAttributes = "";
            $this->value_piket->HrefValue = "";

            // tugastambahan
            $this->tugastambahan->LinkCustomAttributes = "";
            $this->tugastambahan->HrefValue = "";

            // tj_jabatan
            $this->tj_jabatan->LinkCustomAttributes = "";
            $this->tj_jabatan->HrefValue = "";

            // sub_total
            $this->sub_total->LinkCustomAttributes = "";
            $this->sub_total->HrefValue = "";

            // potongan
            $this->potongan->LinkCustomAttributes = "";
            $this->potongan->HrefValue = "";

            // total
            $this->total->LinkCustomAttributes = "";
            $this->total->HrefValue = "";

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
        if ($this->value_lembur->Required) {
            if (!$this->value_lembur->IsDetailKey && EmptyValue($this->value_lembur->FormValue)) {
                $this->value_lembur->addErrorMessage(str_replace("%s", $this->value_lembur->caption(), $this->value_lembur->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->value_lembur->FormValue)) {
            $this->value_lembur->addErrorMessage($this->value_lembur->getErrorMessage(false));
        }
        if ($this->kehadiran->Required) {
            if (!$this->kehadiran->IsDetailKey && EmptyValue($this->kehadiran->FormValue)) {
                $this->kehadiran->addErrorMessage(str_replace("%s", $this->kehadiran->caption(), $this->kehadiran->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->kehadiran->FormValue)) {
            $this->kehadiran->addErrorMessage($this->kehadiran->getErrorMessage(false));
        }
        if ($this->gapok->Required) {
            if (!$this->gapok->IsDetailKey && EmptyValue($this->gapok->FormValue)) {
                $this->gapok->addErrorMessage(str_replace("%s", $this->gapok->caption(), $this->gapok->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->gapok->FormValue)) {
            $this->gapok->addErrorMessage($this->gapok->getErrorMessage(false));
        }
        if ($this->value_reward->Required) {
            if (!$this->value_reward->IsDetailKey && EmptyValue($this->value_reward->FormValue)) {
                $this->value_reward->addErrorMessage(str_replace("%s", $this->value_reward->caption(), $this->value_reward->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->value_reward->FormValue)) {
            $this->value_reward->addErrorMessage($this->value_reward->getErrorMessage(false));
        }
        if ($this->value_inval->Required) {
            if (!$this->value_inval->IsDetailKey && EmptyValue($this->value_inval->FormValue)) {
                $this->value_inval->addErrorMessage(str_replace("%s", $this->value_inval->caption(), $this->value_inval->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->value_inval->FormValue)) {
            $this->value_inval->addErrorMessage($this->value_inval->getErrorMessage(false));
        }
        if ($this->piket_count->Required) {
            if (!$this->piket_count->IsDetailKey && EmptyValue($this->piket_count->FormValue)) {
                $this->piket_count->addErrorMessage(str_replace("%s", $this->piket_count->caption(), $this->piket_count->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->piket_count->FormValue)) {
            $this->piket_count->addErrorMessage($this->piket_count->getErrorMessage(false));
        }
        if ($this->value_piket->Required) {
            if (!$this->value_piket->IsDetailKey && EmptyValue($this->value_piket->FormValue)) {
                $this->value_piket->addErrorMessage(str_replace("%s", $this->value_piket->caption(), $this->value_piket->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->value_piket->FormValue)) {
            $this->value_piket->addErrorMessage($this->value_piket->getErrorMessage(false));
        }
        if ($this->tugastambahan->Required) {
            if (!$this->tugastambahan->IsDetailKey && EmptyValue($this->tugastambahan->FormValue)) {
                $this->tugastambahan->addErrorMessage(str_replace("%s", $this->tugastambahan->caption(), $this->tugastambahan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->tugastambahan->FormValue)) {
            $this->tugastambahan->addErrorMessage($this->tugastambahan->getErrorMessage(false));
        }
        if ($this->tj_jabatan->Required) {
            if (!$this->tj_jabatan->IsDetailKey && EmptyValue($this->tj_jabatan->FormValue)) {
                $this->tj_jabatan->addErrorMessage(str_replace("%s", $this->tj_jabatan->caption(), $this->tj_jabatan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->tj_jabatan->FormValue)) {
            $this->tj_jabatan->addErrorMessage($this->tj_jabatan->getErrorMessage(false));
        }
        if ($this->sub_total->Required) {
            if (!$this->sub_total->IsDetailKey && EmptyValue($this->sub_total->FormValue)) {
                $this->sub_total->addErrorMessage(str_replace("%s", $this->sub_total->caption(), $this->sub_total->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->sub_total->FormValue)) {
            $this->sub_total->addErrorMessage($this->sub_total->getErrorMessage(false));
        }
        if ($this->potongan->Required) {
            if (!$this->potongan->IsDetailKey && EmptyValue($this->potongan->FormValue)) {
                $this->potongan->addErrorMessage(str_replace("%s", $this->potongan->caption(), $this->potongan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->potongan->FormValue)) {
            $this->potongan->addErrorMessage($this->potongan->getErrorMessage(false));
        }
        if ($this->total->Required) {
            if (!$this->total->IsDetailKey && EmptyValue($this->total->FormValue)) {
                $this->total->addErrorMessage(str_replace("%s", $this->total->caption(), $this->total->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->total->FormValue)) {
            $this->total->addErrorMessage($this->total->getErrorMessage(false));
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

        // jabatan_id
        $this->jabatan_id->setDbValueDef($rsnew, $this->jabatan_id->CurrentValue, null, $this->jabatan_id->ReadOnly);

        // pegawai
        $this->pegawai->setDbValueDef($rsnew, $this->pegawai->CurrentValue, null, $this->pegawai->ReadOnly);

        // lembur
        $this->lembur->setDbValueDef($rsnew, $this->lembur->CurrentValue, null, $this->lembur->ReadOnly);

        // value_lembur
        $this->value_lembur->setDbValueDef($rsnew, $this->value_lembur->CurrentValue, null, $this->value_lembur->ReadOnly);

        // kehadiran
        $this->kehadiran->setDbValueDef($rsnew, $this->kehadiran->CurrentValue, null, $this->kehadiran->ReadOnly);

        // gapok
        $this->gapok->setDbValueDef($rsnew, $this->gapok->CurrentValue, null, $this->gapok->ReadOnly);

        // value_reward
        $this->value_reward->setDbValueDef($rsnew, $this->value_reward->CurrentValue, null, $this->value_reward->ReadOnly);

        // value_inval
        $this->value_inval->setDbValueDef($rsnew, $this->value_inval->CurrentValue, null, $this->value_inval->ReadOnly);

        // piket_count
        $this->piket_count->setDbValueDef($rsnew, $this->piket_count->CurrentValue, null, $this->piket_count->ReadOnly);

        // value_piket
        $this->value_piket->setDbValueDef($rsnew, $this->value_piket->CurrentValue, null, $this->value_piket->ReadOnly);

        // tugastambahan
        $this->tugastambahan->setDbValueDef($rsnew, $this->tugastambahan->CurrentValue, null, $this->tugastambahan->ReadOnly);

        // tj_jabatan
        $this->tj_jabatan->setDbValueDef($rsnew, $this->tj_jabatan->CurrentValue, null, $this->tj_jabatan->ReadOnly);

        // sub_total
        $this->sub_total->setDbValueDef($rsnew, $this->sub_total->CurrentValue, null, $this->sub_total->ReadOnly);

        // potongan
        $this->potongan->setDbValueDef($rsnew, $this->potongan->CurrentValue, null, $this->potongan->ReadOnly);

        // total
        $this->total->setDbValueDef($rsnew, $this->total->CurrentValue, null, $this->total->ReadOnly);

        // month
        $this->month->setDbValueDef($rsnew, $this->month->CurrentValue, null, $this->month->ReadOnly);

        // datetime
        $this->datetime->CurrentValue = CurrentDateTime();
        $this->datetime->setDbValueDef($rsnew, $this->datetime->CurrentValue, null);

        // Update current values
        $this->setCurrentValues($rsnew);

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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("GajiList"), "", $this->TableVar, true);
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
