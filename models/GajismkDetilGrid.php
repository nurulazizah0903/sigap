<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class GajismkDetilGrid extends GajismkDetil
{
    use MessagesTrait;

    // Page ID
    public $PageID = "grid";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'gajismk_detil';

    // Page object name
    public $PageObjName = "GajismkDetilGrid";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fgajismk_detilgrid";
    public $FormActionName = "k_action";
    public $FormBlankRowName = "k_blankrow";
    public $FormKeyCountName = "key_count";

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $CopyUrl;
    public $DeleteUrl;
    public $ViewUrl;
    public $ListUrl;

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
        $this->FormActionName .= "_" . $this->FormName;
        $this->OldKeyName .= "_" . $this->FormName;
        $this->FormBlankRowName .= "_" . $this->FormName;
        $this->FormKeyCountName .= "_" . $this->FormName;
        $GLOBALS["Grid"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (gajismk_detil)
        if (!isset($GLOBALS["gajismk_detil"]) || get_class($GLOBALS["gajismk_detil"]) == PROJECT_NAMESPACE . "gajismk_detil") {
            $GLOBALS["gajismk_detil"] = &$this;
        }
        $this->AddUrl = "GajismkDetilAdd";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'gajismk_detil');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");

        // List options
        $this->ListOptions = new ListOptions(["Tag" => "td", "TableVar" => $this->TableVar]);

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }

        // Grid-Add/Edit
        $this->OtherOptions["addedit"] = new ListOptions([
            "TagClassName" => "ew-add-edit-option",
            "UseDropDownButton" => false,
            "DropDownButtonPhrase" => $Language->phrase("ButtonAddEdit"),
            "UseButtonGroup" => true
        ]);
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

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $tbl = Container("gajismk_detil");
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
        unset($GLOBALS["Grid"]);
        if ($url === "") {
            return;
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

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
            SaveDebugMessage();
            Redirect(GetUrl($url));
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

    // Class variables
    public $ListOptions; // List options
    public $ExportOptions; // Export options
    public $SearchOptions; // Search options
    public $OtherOptions; // Other options
    public $FilterOptions; // Filter options
    public $ImportOptions; // Import options
    public $ListActions; // List actions
    public $SelectedCount = 0;
    public $SelectedIndex = 0;
    public $ShowOtherOptions = false;
    public $DisplayRecords = 20;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
    public $DefaultSearchWhere = ""; // Default search WHERE clause
    public $SearchWhere = ""; // Search WHERE clause
    public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 1; // For extended search
    public $RecordCount = 0; // Record count
    public $EditRowCount;
    public $StartRowCount = 1;
    public $RowCount = 0;
    public $Attrs = []; // Row attributes and cell attributes
    public $RowIndex = 0; // Row index
    public $KeyCount = 0; // Key count
    public $MultiColumnGridClass = "row-cols-md";
    public $MultiColumnEditClass = "col-12 w-100";
    public $MultiColumnCardClass = "card h-100 ew-card";
    public $MultiColumnListOptionsPosition = "bottom-start";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $MasterRecordExists;
    public $MultiSelectKey;
    public $Command;
    public $UserAction; // User action
    public $RestoreSearch = false;
    public $HashValue; // Hash value
    public $DetailPages;
    public $OldRecordset;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

        // Multi column button position
        $this->MultiColumnListOptionsPosition = Config("MULTI_COLUMN_LIST_OPTIONS_POSITION");

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();
        $this->id->Visible = false;
        $this->pid->Visible = false;
        $this->pegawai_id->setVisibility();
        $this->jabatan_id->setVisibility();
        $this->masakerja->setVisibility();
        $this->jumngajar->setVisibility();
        $this->ijin->setVisibility();
        $this->tunjangan_wkosis->setVisibility();
        $this->nominal_baku->setVisibility();
        $this->baku->setVisibility();
        $this->kehadiran->setVisibility();
        $this->prestasi->setVisibility();
        $this->jumlahgaji->setVisibility();
        $this->jumgajitotal->setVisibility();
        $this->potongan1->setVisibility();
        $this->potongan2->setVisibility();
        $this->jumlahterima->setVisibility();
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

        // Set up master detail parameters
        $this->setupMasterParms();

        // Setup other options
        $this->setupOtherOptions();

        // Set up lookup cache
        $this->setupLookupOptions($this->pegawai_id);
        $this->setupLookupOptions($this->jabatan_id);

        // Load default values for add
        $this->loadDefaultValues();

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = "";

        // Get command
        $this->Command = strtolower(Get("cmd", ""));
        if ($this->isPageRequest()) {
            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

            // Hide list options
            if ($this->isExport()) {
                $this->ListOptions->hideAllOptions(["sequence"]);
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            } elseif ($this->isGridAdd() || $this->isGridEdit()) {
                $this->ListOptions->hideAllOptions();
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            }

            // Show grid delete link for grid add / grid edit
            if ($this->AllowAddDeleteRow) {
                if ($this->isGridAdd() || $this->isGridEdit()) {
                    $item = $this->ListOptions["griddelete"];
                    if ($item) {
                        $item->Visible = true;
                    }
                }
            }

            // Set up sorting order
            $this->setupSortOrder();
        }

        // Restore display records
        if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
            $this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecords = 20; // Load default
            $this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
        }

        // Build filter
        $filter = "";
        if (!$Security->canList()) {
            $filter = "(0=1)"; // Filter all records
        }

        // Restore master/detail filter from session
        $this->DbMasterFilter = $this->getMasterFilterFromSession(); // Restore master filter from session
        $this->DbDetailFilter = $this->getDetailFilterFromSession(); // Restore detail filter from session
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Load master record
        if ($this->CurrentMode != "add" && $this->DbMasterFilter != "" && $this->getCurrentMasterTable() == "gajismk") {
            $masterTbl = Container("gajismk");
            $rsmaster = $masterTbl->loadRs($this->DbMasterFilter)->fetchAssociative();
            $this->MasterRecordExists = $rsmaster !== false;
            if (!$this->MasterRecordExists) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
                $this->terminate("GajismkList"); // Return to master page
                return;
            } else {
                $masterTbl->loadListRowValues($rsmaster);
                $masterTbl->RowType = ROWTYPE_MASTER; // Master row
                $masterTbl->renderListRow();
            }
        }

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }
        if ($this->isGridAdd()) {
            if ($this->CurrentMode == "copy") {
                $this->TotalRecords = $this->listRecordCount();
                $this->StartRecord = 1;
                $this->DisplayRecords = $this->TotalRecords;
                $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
            } else {
                $this->CurrentFilter = "0=1";
                $this->StartRecord = 1;
                $this->DisplayRecords = $this->GridAddRowCount;
            }
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->TotalRecords; // Display all records
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
        }

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset);
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
            $this->terminate(true);
            return;
        }

        // Set up pager
        $this->Pager = new PrevNextPager($this->TableVar, $this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

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

    // Set up number of records displayed per page
    protected function setupDisplayRecords()
    {
        $wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
        if ($wrk != "") {
            if (is_numeric($wrk)) {
                $this->DisplayRecords = (int)$wrk;
            } else {
                if (SameText($wrk, "all")) { // Display all records
                    $this->DisplayRecords = -1;
                } else {
                    $this->DisplayRecords = 20; // Non-numeric, load default
                }
            }
            $this->setRecordsPerPage($this->DisplayRecords); // Save to Session
            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Exit inline mode
    protected function clearInlineMode()
    {
        $this->LastAction = $this->CurrentAction; // Save last action
        $this->CurrentAction = ""; // Clear action
        $_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
    }

    // Switch to Grid Add mode
    protected function gridAddMode()
    {
        global $Security, $Language;
        if (!$Security->canAdd()) { // No add permission
            $this->CurrentAction = "";
            $this->setFailureMessage($Language->phrase("NoAddPermission"));
            return false;
        }
        $this->CurrentAction = "gridadd";
        $_SESSION[SESSION_INLINE_MODE] = "gridadd";
        $this->hideFieldsForAddEdit();
    }

    // Switch to Grid Edit mode
    protected function gridEditMode()
    {
        global $Security, $Language;
        if (!$Security->canEdit()) { // No edit permission
            $this->CurrentAction = "";
            $this->setFailureMessage($Language->phrase("NoEditPermission"));
            return false;
        }
        $this->CurrentAction = "gridedit";
        $_SESSION[SESSION_INLINE_MODE] = "gridedit";
        $this->hideFieldsForAddEdit();
    }

    // Perform update to grid
    public function gridUpdate()
    {
        global $Language, $CurrentForm;
        $gridUpdate = true;

        // Get old recordset
        $this->CurrentFilter = $this->buildKeyFilter();
        if ($this->CurrentFilter == "") {
            $this->CurrentFilter = "0=1";
        }
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        if ($rs = $conn->executeQuery($sql)) {
            $rsold = $rs->fetchAllAssociative();
        }

        // Call Grid Updating event
        if (!$this->gridUpdating($rsold)) {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
            }
            return false;
        }
        $key = "";

        // Update row index and get row key
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Update all rows based on key
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            $CurrentForm->Index = $rowindex;
            $this->setKey($CurrentForm->getValue($this->OldKeyName));
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));

            // Load all values and keys
            if ($rowaction != "insertdelete") { // Skip insert then deleted rows
                $this->loadFormValues(); // Get form values
                if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
                    $gridUpdate = $this->OldKey != ""; // Key must not be empty
                } else {
                    $gridUpdate = true;
                }

                // Skip empty row
                if ($rowaction == "insert" && $this->emptyRow()) {
                // Validate form and insert/update/delete record
                } elseif ($gridUpdate) {
                    if ($rowaction == "delete") {
                        $this->CurrentFilter = $this->getRecordFilter();
                        $gridUpdate = $this->deleteRows(); // Delete this row
                    //} elseif (!$this->validateForm()) { // Already done in validateGridForm
                    //    $gridUpdate = false; // Form error, reset action
                    } else {
                        if ($rowaction == "insert") {
                            $gridUpdate = $this->addRow(); // Insert this row
                        } else {
                            if ($this->OldKey != "") {
                                $this->SendEmail = false; // Do not send email on update success
                                $gridUpdate = $this->editRow(); // Update this row
                            }
                        } // End update
                    }
                }
                if ($gridUpdate) {
                    if ($key != "") {
                        $key .= ", ";
                    }
                    $key .= $this->OldKey;
                } else {
                    break;
                }
            }
        }
        if ($gridUpdate) {
            // Get new records
            $rsnew = $conn->fetchAllAssociative($sql);

            // Call Grid_Updated event
            $this->gridUpdated($rsold, $rsnew);
            $this->clearInlineMode(); // Clear inline edit mode
        } else {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
            }
        }
        return $gridUpdate;
    }

    // Build filter for all keys
    protected function buildKeyFilter()
    {
        global $CurrentForm;
        $wrkFilter = "";

        // Update row index and get row key
        $rowindex = 1;
        $CurrentForm->Index = $rowindex;
        $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        while ($thisKey != "") {
            $this->setKey($thisKey);
            if ($this->OldKey != "") {
                $filter = $this->getRecordFilter();
                if ($wrkFilter != "") {
                    $wrkFilter .= " OR ";
                }
                $wrkFilter .= $filter;
            } else {
                $wrkFilter = "0=1";
                break;
            }

            // Update row index and get row key
            $rowindex++; // Next row
            $CurrentForm->Index = $rowindex;
            $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        }
        return $wrkFilter;
    }

    // Perform Grid Add
    public function gridInsert()
    {
        global $Language, $CurrentForm;
        $rowindex = 1;
        $gridInsert = false;
        $conn = $this->getConnection();

        // Call Grid Inserting event
        if (!$this->gridInserting()) {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
            }
            return false;
        }

        // Init key filter
        $wrkfilter = "";
        $addcnt = 0;
        $key = "";

        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Insert all rows
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "" && $rowaction != "insert") {
                continue; // Skip
            }
            if ($rowaction == "insert") {
                $this->OldKey = strval($CurrentForm->getValue($this->OldKeyName));
                $this->loadOldRecord(); // Load old record
            }
            $this->loadFormValues(); // Get form values
            if (!$this->emptyRow()) {
                $addcnt++;
                $this->SendEmail = false; // Do not send email on insert success

                // Validate form // Already done in validateGridForm
                //if (!$this->validateForm()) {
                //    $gridInsert = false; // Form error, reset action
                //} else {
                    $gridInsert = $this->addRow($this->OldRecordset); // Insert this row
                //}
                if ($gridInsert) {
                    if ($key != "") {
                        $key .= Config("COMPOSITE_KEY_SEPARATOR");
                    }
                    $key .= $this->id->CurrentValue;

                    // Add filter for this record
                    $filter = $this->getRecordFilter();
                    if ($wrkfilter != "") {
                        $wrkfilter .= " OR ";
                    }
                    $wrkfilter .= $filter;
                } else {
                    break;
                }
            }
        }
        if ($addcnt == 0) { // No record inserted
            $this->clearInlineMode(); // Clear grid add mode and return
            return true;
        }
        if ($gridInsert) {
            // Get new records
            $this->CurrentFilter = $wrkfilter;
            $sql = $this->getCurrentSql();
            $rsnew = $conn->fetchAllAssociative($sql);

            // Call Grid_Inserted event
            $this->gridInserted($rsnew);
            $this->clearInlineMode(); // Clear grid add mode
        } else {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
            }
        }
        return $gridInsert;
    }

    // Check if empty row
    public function emptyRow()
    {
        global $CurrentForm;
        if (
            $CurrentForm->hasValue("x_pegawai_id") &&
            $CurrentForm->hasValue("o_pegawai_id") &&
            $this->pegawai_id->CurrentValue != $this->pegawai_id->DefaultValue &&
            !($this->pegawai_id->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->pegawai_id->CurrentValue == $this->pegawai_id->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_jabatan_id") &&
            $CurrentForm->hasValue("o_jabatan_id") &&
            $this->jabatan_id->CurrentValue != $this->jabatan_id->DefaultValue &&
            !($this->jabatan_id->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->jabatan_id->CurrentValue == $this->jabatan_id->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_masakerja") &&
            $CurrentForm->hasValue("o_masakerja") &&
            $this->masakerja->CurrentValue != $this->masakerja->DefaultValue &&
            !($this->masakerja->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->masakerja->CurrentValue == $this->masakerja->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_jumngajar") &&
            $CurrentForm->hasValue("o_jumngajar") &&
            $this->jumngajar->CurrentValue != $this->jumngajar->DefaultValue &&
            !($this->jumngajar->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->jumngajar->CurrentValue == $this->jumngajar->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_ijin") &&
            $CurrentForm->hasValue("o_ijin") &&
            $this->ijin->CurrentValue != $this->ijin->DefaultValue &&
            !($this->ijin->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->ijin->CurrentValue == $this->ijin->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_tunjangan_wkosis") &&
            $CurrentForm->hasValue("o_tunjangan_wkosis") &&
            $this->tunjangan_wkosis->CurrentValue != $this->tunjangan_wkosis->DefaultValue &&
            !($this->tunjangan_wkosis->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->tunjangan_wkosis->CurrentValue == $this->tunjangan_wkosis->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_nominal_baku") &&
            $CurrentForm->hasValue("o_nominal_baku") &&
            $this->nominal_baku->CurrentValue != $this->nominal_baku->DefaultValue &&
            !($this->nominal_baku->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->nominal_baku->CurrentValue == $this->nominal_baku->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_baku") &&
            $CurrentForm->hasValue("o_baku") &&
            $this->baku->CurrentValue != $this->baku->DefaultValue &&
            !($this->baku->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->baku->CurrentValue == $this->baku->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_kehadiran") &&
            $CurrentForm->hasValue("o_kehadiran") &&
            $this->kehadiran->CurrentValue != $this->kehadiran->DefaultValue &&
            !($this->kehadiran->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->kehadiran->CurrentValue == $this->kehadiran->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_prestasi") &&
            $CurrentForm->hasValue("o_prestasi") &&
            $this->prestasi->CurrentValue != $this->prestasi->DefaultValue &&
            !($this->prestasi->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->prestasi->CurrentValue == $this->prestasi->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_jumlahgaji") &&
            $CurrentForm->hasValue("o_jumlahgaji") &&
            $this->jumlahgaji->CurrentValue != $this->jumlahgaji->DefaultValue &&
            !($this->jumlahgaji->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->jumlahgaji->CurrentValue == $this->jumlahgaji->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_jumgajitotal") &&
            $CurrentForm->hasValue("o_jumgajitotal") &&
            $this->jumgajitotal->CurrentValue != $this->jumgajitotal->DefaultValue &&
            !($this->jumgajitotal->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->jumgajitotal->CurrentValue == $this->jumgajitotal->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_potongan1") &&
            $CurrentForm->hasValue("o_potongan1") &&
            $this->potongan1->CurrentValue != $this->potongan1->DefaultValue &&
            !($this->potongan1->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->potongan1->CurrentValue == $this->potongan1->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_potongan2") &&
            $CurrentForm->hasValue("o_potongan2") &&
            $this->potongan2->CurrentValue != $this->potongan2->DefaultValue &&
            !($this->potongan2->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->potongan2->CurrentValue == $this->potongan2->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_jumlahterima") &&
            $CurrentForm->hasValue("o_jumlahterima") &&
            $this->jumlahterima->CurrentValue != $this->jumlahterima->DefaultValue &&
            !($this->jumlahterima->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->jumlahterima->CurrentValue == $this->jumlahterima->getSessionValue())
        ) {
            return false;
        }
        return true;
    }

    // Validate grid form
    public function validateGridForm()
    {
        global $CurrentForm;
        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Load default values for emptyRow checking
        $this->loadDefaultValues();

        // Validate all records
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "delete" && $rowaction != "insertdelete") {
                $this->loadFormValues(); // Get form values
                if ($rowaction == "insert" && $this->emptyRow()) {
                    // Ignore
                } elseif (!$this->validateForm()) {
                    $this->EventCancelled = true;
                    return false;
                }
            }
        }
        return true;
    }

    // Get all form values of the grid
    public function getGridFormValues()
    {
        global $CurrentForm;
        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }
        $rows = [];

        // Loop through all records
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "delete" && $rowaction != "insertdelete") {
                $this->loadFormValues(); // Get form values
                if ($rowaction == "insert" && $this->emptyRow()) {
                    // Ignore
                } else {
                    $rows[] = $this->getFieldValues("FormValue"); // Return row as array
                }
            }
        }
        return $rows; // Return as array of array
    }

    // Restore form values for current row
    public function restoreCurrentRowFormValues($idx)
    {
        global $CurrentForm;

        // Get row based on current index
        $CurrentForm->Index = $idx;
        $rowaction = strval($CurrentForm->getValue($this->FormActionName));
        $this->loadFormValues(); // Load form values
        // Set up invalid status correctly
        $this->resetFormError();
        if ($rowaction == "insert" && $this->emptyRow()) {
            // Ignore
        } else {
            $this->validateForm();
        }
    }

    // Reset form status
    public function resetFormError()
    {
        $this->pegawai_id->clearErrorMessage();
        $this->jabatan_id->clearErrorMessage();
        $this->masakerja->clearErrorMessage();
        $this->jumngajar->clearErrorMessage();
        $this->ijin->clearErrorMessage();
        $this->tunjangan_wkosis->clearErrorMessage();
        $this->nominal_baku->clearErrorMessage();
        $this->baku->clearErrorMessage();
        $this->kehadiran->clearErrorMessage();
        $this->prestasi->clearErrorMessage();
        $this->jumlahgaji->clearErrorMessage();
        $this->jumgajitotal->clearErrorMessage();
        $this->potongan1->clearErrorMessage();
        $this->potongan2->clearErrorMessage();
        $this->jumlahterima->clearErrorMessage();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Load default Sorting Order
        if ($this->Command != "json") {
            $defaultSort = ""; // Set up default sort
            if ($this->getSessionOrderBy() == "" && $defaultSort != "") {
                $this->setSessionOrderBy($defaultSort);
            }
        }

        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->setStartRecordNumber(1); // Reset start position
        }

        // Update field sort
        $this->updateFieldSort();
    }

    // Reset command
    // - cmd=reset (Reset search parameters)
    // - cmd=resetall (Reset search and master/detail parameters)
    // - cmd=resetsort (Reset sort parameters)
    protected function resetCmd()
    {
        // Check if reset command
        if (StartsString("reset", $this->Command)) {
            // Reset master/detail keys
            if ($this->Command == "resetall") {
                $this->setCurrentMasterTable(""); // Clear master table
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
                        $this->pid->setSessionValue("");
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
            }

            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Set up list options
    protected function setupListOptions()
    {
        global $Security, $Language;

        // "griddelete"
        if ($this->AllowAddDeleteRow) {
            $item = &$this->ListOptions->add("griddelete");
            $item->CssClass = "text-nowrap";
            $item->OnLeft = true;
            $item->Visible = false; // Default hidden
        }

        // Add group option item ("button")
        $item = &$this->ListOptions->addGroupOption();
        $item->Body = "";
        $item->OnLeft = true;
        $item->Visible = false;

        // "view"
        $item = &$this->ListOptions->add("view");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canView();
        $item->OnLeft = true;

        // "edit"
        $item = &$this->ListOptions->add("edit");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canEdit();
        $item->OnLeft = true;

        // "copy"
        $item = &$this->ListOptions->add("copy");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canAdd();
        $item->OnLeft = true;

        // "delete"
        $item = &$this->ListOptions->add("delete");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canDelete();
        $item->OnLeft = true;

        // "sequence"
        $item = &$this->ListOptions->add("sequence");
        $item->CssClass = "text-nowrap";
        $item->Visible = true;
        $item->OnLeft = true; // Always on left
        $item->ShowInDropDown = false;
        $item->ShowInButtonGroup = false;

        // Drop down button for ListOptions
        $this->ListOptions->UseDropDownButton = false;
        $this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
        $this->ListOptions->UseButtonGroup = false;
        if ($this->ListOptions->UseButtonGroup && IsMobile()) {
            $this->ListOptions->UseDropDownButton = true;
        }

        //$this->ListOptions->ButtonClass = ""; // Class for button group

        // Call ListOptions_Load event
        $this->listOptionsLoad();
        $item = $this->ListOptions[$this->ListOptions->GroupOptionName];
        $item->Visible = $this->ListOptions->groupOptionVisible();
    }

    // Set up list options (extensions)
    protected function setupListOptionsExt()
    {
        // Preview extension
        $this->ListOptions->hideDetailItemsForDropDown(); // Hide detail items for dropdown if necessary
    }

    // Render list options
    public function renderListOptions()
    {
        global $Security, $Language, $CurrentForm, $UserProfile;
        $this->ListOptions->loadDefault();

        // Call ListOptions_Rendering event
        $this->listOptionsRendering();

        // Set up row action and key
        if ($CurrentForm && is_numeric($this->RowIndex) && $this->RowType != "view") {
            $CurrentForm->Index = $this->RowIndex;
            $actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
            $oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->OldKeyName);
            $blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
            if ($this->RowAction != "") {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
            }
            $oldKey = $this->getKey(false); // Get from OldValue
            if ($oldKeyName != "" && $oldKey != "") {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($oldKey) . "\">";
            }
            if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow()) {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
            }
        }

        // "delete"
        if ($this->AllowAddDeleteRow) {
            if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
                $options = &$this->ListOptions;
                $options->UseButtonGroup = true; // Use button group for grid delete button
                $opt = $options["griddelete"];
                if (!$Security->canDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
                    $opt->Body = "&nbsp;";
                } else {
                    $opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-ew-action=\"delete-grid-row\" data-rowindex=\"" . $this->RowIndex . "\">" . $Language->phrase("DeleteLink") . "</a>";
                }
            }
        }

        // "sequence"
        $opt = $this->ListOptions["sequence"];
        $opt->Body = FormatSequenceNumber($this->RecordCount);
        if ($this->CurrentMode == "view") {
            // "view"
            $opt = $this->ListOptions["view"];
            $viewcaption = HtmlTitle($Language->phrase("ViewLink"));
            if ($Security->canView()) {
                $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode(GetUrl($this->ViewUrl)) . "\">" . $Language->phrase("ViewLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "edit"
            $opt = $this->ListOptions["edit"];
            $editcaption = HtmlTitle($Language->phrase("EditLink"));
            if ($Security->canEdit()) {
                $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("EditLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "copy"
            $opt = $this->ListOptions["copy"];
            $copycaption = HtmlTitle($Language->phrase("CopyLink"));
            if ($Security->canAdd()) {
                $opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode(GetUrl($this->CopyUrl)) . "\">" . $Language->phrase("CopyLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "delete"
            $opt = $this->ListOptions["delete"];
            if ($Security->canDelete()) {
                $opt->Body = "<a class=\"ew-row-link ew-delete\" data-ew-action=\"\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->DeleteUrl)) . "\">" . $Language->phrase("DeleteLink") . "</a>";
            } else {
                $opt->Body = "";
            }
        } // End View mode
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Render list options (extensions)
    protected function renderListOptionsExt()
    {
        // Render list options (to be implemented by extensions)
        global $Security, $Language;
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $option = $this->OtherOptions["addedit"];
        $item = &$option->addGroupOption();
        $item->Body = "";
        $item->Visible = false;

        // Add
        if ($this->CurrentMode == "view") { // Check view mode
            $item = &$option->add("add");
            $addcaption = HtmlTitle($Language->phrase("AddLink"));
            $this->AddUrl = $this->getAddUrl();
            $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
            $item->Visible = $this->AddUrl != "" && $Security->canAdd();
        }
    }

    // Create new column option
    public function createColumnOption($name)
    {
        $field = $this->Fields[$name] ?? false;
        if ($field && $field->Visible) {
            $item = new ListOption($field->Name);
            $item->Body = '<button class="dropdown-item">' .
                '<div class="form-check ew-dropdown-checkbox">' .
                '<div class="form-check-input ew-dropdown-check-input" data-field="' . $field->Param . '"></div>' .
                '<label class="form-check-label ew-dropdown-check-label">' . $field->caption() . '</label></div></button>';
            return $item;
        }
        return null;
    }

    // Render other options
    public function renderOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
            if (in_array($this->CurrentMode, ["add", "copy", "edit"]) && !$this->isConfirm()) { // Check add/copy/edit mode
                if ($this->AllowAddDeleteRow) {
                    $option = $options["addedit"];
                    $option->UseDropDownButton = false;
                    $item = &$option->add("addblankrow");
                    $item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-ew-action=\"add-grid-row\">" . $Language->phrase("AddBlankRow") . "</a>";
                    $item->Visible = $Security->canAdd();
                    $this->ShowOtherOptions = $item->Visible;
                }
            }
            if ($this->CurrentMode == "view") { // Check view mode
                $option = $options["addedit"];
                $item = $option["add"];
                $this->ShowOtherOptions = $item && $item->Visible;
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
        $CurrentForm->FormName = $this->FormName;
        $validate = !Config("SERVER_VALIDATE");

        // Check field name 'pegawai_id' first before field var 'x_pegawai_id'
        $val = $CurrentForm->hasValue("pegawai_id") ? $CurrentForm->getValue("pegawai_id") : $CurrentForm->getValue("x_pegawai_id");
        if (!$this->pegawai_id->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->pegawai_id->Visible = false; // Disable update for API request
            } else {
                $this->pegawai_id->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_pegawai_id")) {
            $this->pegawai_id->setOldValue($CurrentForm->getValue("o_pegawai_id"));
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
        if ($CurrentForm->hasValue("o_jabatan_id")) {
            $this->jabatan_id->setOldValue($CurrentForm->getValue("o_jabatan_id"));
        }

        // Check field name 'masakerja' first before field var 'x_masakerja'
        $val = $CurrentForm->hasValue("masakerja") ? $CurrentForm->getValue("masakerja") : $CurrentForm->getValue("x_masakerja");
        if (!$this->masakerja->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->masakerja->Visible = false; // Disable update for API request
            } else {
                $this->masakerja->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_masakerja")) {
            $this->masakerja->setOldValue($CurrentForm->getValue("o_masakerja"));
        }

        // Check field name 'jumngajar' first before field var 'x_jumngajar'
        $val = $CurrentForm->hasValue("jumngajar") ? $CurrentForm->getValue("jumngajar") : $CurrentForm->getValue("x_jumngajar");
        if (!$this->jumngajar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jumngajar->Visible = false; // Disable update for API request
            } else {
                $this->jumngajar->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_jumngajar")) {
            $this->jumngajar->setOldValue($CurrentForm->getValue("o_jumngajar"));
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
        if ($CurrentForm->hasValue("o_ijin")) {
            $this->ijin->setOldValue($CurrentForm->getValue("o_ijin"));
        }

        // Check field name 'tunjangan_wkosis' first before field var 'x_tunjangan_wkosis'
        $val = $CurrentForm->hasValue("tunjangan_wkosis") ? $CurrentForm->getValue("tunjangan_wkosis") : $CurrentForm->getValue("x_tunjangan_wkosis");
        if (!$this->tunjangan_wkosis->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tunjangan_wkosis->Visible = false; // Disable update for API request
            } else {
                $this->tunjangan_wkosis->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_tunjangan_wkosis")) {
            $this->tunjangan_wkosis->setOldValue($CurrentForm->getValue("o_tunjangan_wkosis"));
        }

        // Check field name 'nominal_baku' first before field var 'x_nominal_baku'
        $val = $CurrentForm->hasValue("nominal_baku") ? $CurrentForm->getValue("nominal_baku") : $CurrentForm->getValue("x_nominal_baku");
        if (!$this->nominal_baku->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nominal_baku->Visible = false; // Disable update for API request
            } else {
                $this->nominal_baku->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_nominal_baku")) {
            $this->nominal_baku->setOldValue($CurrentForm->getValue("o_nominal_baku"));
        }

        // Check field name 'baku' first before field var 'x_baku'
        $val = $CurrentForm->hasValue("baku") ? $CurrentForm->getValue("baku") : $CurrentForm->getValue("x_baku");
        if (!$this->baku->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->baku->Visible = false; // Disable update for API request
            } else {
                $this->baku->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_baku")) {
            $this->baku->setOldValue($CurrentForm->getValue("o_baku"));
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
        if ($CurrentForm->hasValue("o_kehadiran")) {
            $this->kehadiran->setOldValue($CurrentForm->getValue("o_kehadiran"));
        }

        // Check field name 'prestasi' first before field var 'x_prestasi'
        $val = $CurrentForm->hasValue("prestasi") ? $CurrentForm->getValue("prestasi") : $CurrentForm->getValue("x_prestasi");
        if (!$this->prestasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->prestasi->Visible = false; // Disable update for API request
            } else {
                $this->prestasi->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_prestasi")) {
            $this->prestasi->setOldValue($CurrentForm->getValue("o_prestasi"));
        }

        // Check field name 'jumlahgaji' first before field var 'x_jumlahgaji'
        $val = $CurrentForm->hasValue("jumlahgaji") ? $CurrentForm->getValue("jumlahgaji") : $CurrentForm->getValue("x_jumlahgaji");
        if (!$this->jumlahgaji->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jumlahgaji->Visible = false; // Disable update for API request
            } else {
                $this->jumlahgaji->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_jumlahgaji")) {
            $this->jumlahgaji->setOldValue($CurrentForm->getValue("o_jumlahgaji"));
        }

        // Check field name 'jumgajitotal' first before field var 'x_jumgajitotal'
        $val = $CurrentForm->hasValue("jumgajitotal") ? $CurrentForm->getValue("jumgajitotal") : $CurrentForm->getValue("x_jumgajitotal");
        if (!$this->jumgajitotal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jumgajitotal->Visible = false; // Disable update for API request
            } else {
                $this->jumgajitotal->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_jumgajitotal")) {
            $this->jumgajitotal->setOldValue($CurrentForm->getValue("o_jumgajitotal"));
        }

        // Check field name 'potongan1' first before field var 'x_potongan1'
        $val = $CurrentForm->hasValue("potongan1") ? $CurrentForm->getValue("potongan1") : $CurrentForm->getValue("x_potongan1");
        if (!$this->potongan1->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->potongan1->Visible = false; // Disable update for API request
            } else {
                $this->potongan1->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_potongan1")) {
            $this->potongan1->setOldValue($CurrentForm->getValue("o_potongan1"));
        }

        // Check field name 'potongan2' first before field var 'x_potongan2'
        $val = $CurrentForm->hasValue("potongan2") ? $CurrentForm->getValue("potongan2") : $CurrentForm->getValue("x_potongan2");
        if (!$this->potongan2->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->potongan2->Visible = false; // Disable update for API request
            } else {
                $this->potongan2->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_potongan2")) {
            $this->potongan2->setOldValue($CurrentForm->getValue("o_potongan2"));
        }

        // Check field name 'jumlahterima' first before field var 'x_jumlahterima'
        $val = $CurrentForm->hasValue("jumlahterima") ? $CurrentForm->getValue("jumlahterima") : $CurrentForm->getValue("x_jumlahterima");
        if (!$this->jumlahterima->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jumlahterima->Visible = false; // Disable update for API request
            } else {
                $this->jumlahterima->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_jumlahterima")) {
            $this->jumlahterima->setOldValue($CurrentForm->getValue("o_jumlahterima"));
        }

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey && !$this->isGridAdd() && !$this->isAdd()) {
            $this->id->setFormValue($val);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        if (!$this->isGridAdd() && !$this->isAdd()) {
            $this->id->CurrentValue = $this->id->FormValue;
        }
        $this->pegawai_id->CurrentValue = $this->pegawai_id->FormValue;
        $this->jabatan_id->CurrentValue = $this->jabatan_id->FormValue;
        $this->masakerja->CurrentValue = $this->masakerja->FormValue;
        $this->jumngajar->CurrentValue = $this->jumngajar->FormValue;
        $this->ijin->CurrentValue = $this->ijin->FormValue;
        $this->tunjangan_wkosis->CurrentValue = $this->tunjangan_wkosis->FormValue;
        $this->nominal_baku->CurrentValue = $this->nominal_baku->FormValue;
        $this->baku->CurrentValue = $this->baku->FormValue;
        $this->kehadiran->CurrentValue = $this->kehadiran->FormValue;
        $this->prestasi->CurrentValue = $this->prestasi->FormValue;
        $this->jumlahgaji->CurrentValue = $this->jumlahgaji->FormValue;
        $this->jumgajitotal->CurrentValue = $this->jumgajitotal->FormValue;
        $this->potongan1->CurrentValue = $this->potongan1->FormValue;
        $this->potongan2->CurrentValue = $this->potongan2->FormValue;
        $this->jumlahterima->CurrentValue = $this->jumlahterima->FormValue;
    }

    // Load recordset
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->execute();
        $rs = new Recordset($result, $sql);

        // Call Recordset Selected event
        $this->recordsetSelected($rs);
        return $rs;
    }

    // Load records as associative array
    public function loadRows($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $result = $sql->execute();
        return $result->fetchAll(FetchMode::ASSOCIATIVE);
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
        $this->pegawai_id->setDbValue($row['pegawai_id']);
        $this->jabatan_id->setDbValue($row['jabatan_id']);
        $this->masakerja->setDbValue($row['masakerja']);
        $this->jumngajar->setDbValue($row['jumngajar']);
        $this->ijin->setDbValue($row['ijin']);
        $this->tunjangan_wkosis->setDbValue($row['tunjangan_wkosis']);
        $this->nominal_baku->setDbValue($row['nominal_baku']);
        $this->baku->setDbValue($row['baku']);
        $this->kehadiran->setDbValue($row['kehadiran']);
        $this->prestasi->setDbValue($row['prestasi']);
        $this->jumlahgaji->setDbValue($row['jumlahgaji']);
        $this->jumgajitotal->setDbValue($row['jumgajitotal']);
        $this->potongan1->setDbValue($row['potongan1']);
        $this->potongan2->setDbValue($row['potongan2']);
        $this->jumlahterima->setDbValue($row['jumlahterima']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['pid'] = $this->pid->DefaultValue;
        $row['pegawai_id'] = $this->pegawai_id->DefaultValue;
        $row['jabatan_id'] = $this->jabatan_id->DefaultValue;
        $row['masakerja'] = $this->masakerja->DefaultValue;
        $row['jumngajar'] = $this->jumngajar->DefaultValue;
        $row['ijin'] = $this->ijin->DefaultValue;
        $row['tunjangan_wkosis'] = $this->tunjangan_wkosis->DefaultValue;
        $row['nominal_baku'] = $this->nominal_baku->DefaultValue;
        $row['baku'] = $this->baku->DefaultValue;
        $row['kehadiran'] = $this->kehadiran->DefaultValue;
        $row['prestasi'] = $this->prestasi->DefaultValue;
        $row['jumlahgaji'] = $this->jumlahgaji->DefaultValue;
        $row['jumgajitotal'] = $this->jumgajitotal->DefaultValue;
        $row['potongan1'] = $this->potongan1->DefaultValue;
        $row['potongan2'] = $this->potongan2->DefaultValue;
        $row['jumlahterima'] = $this->jumlahterima->DefaultValue;
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
        $this->ViewUrl = $this->getViewUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id

        // pid

        // pegawai_id

        // jabatan_id

        // masakerja

        // jumngajar

        // ijin

        // tunjangan_wkosis

        // nominal_baku

        // baku

        // kehadiran

        // prestasi

        // jumlahgaji

        // jumgajitotal

        // potongan1

        // potongan2

        // jumlahterima

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // pid
            $this->pid->ViewValue = $this->pid->CurrentValue;
            $this->pid->ViewValue = FormatNumber($this->pid->ViewValue, $this->pid->formatPattern());
            $this->pid->ViewCustomAttributes = "";

            // pegawai_id
            $this->pegawai_id->ViewValue = $this->pegawai_id->CurrentValue;
            $curVal = strval($this->pegawai_id->CurrentValue);
            if ($curVal != "") {
                $this->pegawai_id->ViewValue = $this->pegawai_id->lookupCacheOption($curVal);
                if ($this->pegawai_id->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->pegawai_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->pegawai_id->Lookup->renderViewRow($rswrk[0]);
                        $this->pegawai_id->ViewValue = $this->pegawai_id->displayValue($arwrk);
                    } else {
                        $this->pegawai_id->ViewValue = FormatNumber($this->pegawai_id->CurrentValue, $this->pegawai_id->formatPattern());
                    }
                }
            } else {
                $this->pegawai_id->ViewValue = null;
            }
            $this->pegawai_id->ViewCustomAttributes = "";

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

            // masakerja
            $this->masakerja->ViewValue = $this->masakerja->CurrentValue;
            $this->masakerja->ViewValue = FormatNumber($this->masakerja->ViewValue, $this->masakerja->formatPattern());
            $this->masakerja->ViewCustomAttributes = "";

            // jumngajar
            $this->jumngajar->ViewValue = $this->jumngajar->CurrentValue;
            $this->jumngajar->ViewValue = FormatNumber($this->jumngajar->ViewValue, $this->jumngajar->formatPattern());
            $this->jumngajar->ViewCustomAttributes = "";

            // ijin
            $this->ijin->ViewValue = $this->ijin->CurrentValue;
            $this->ijin->ViewValue = FormatNumber($this->ijin->ViewValue, $this->ijin->formatPattern());
            $this->ijin->ViewCustomAttributes = "";

            // tunjangan_wkosis
            $this->tunjangan_wkosis->ViewValue = $this->tunjangan_wkosis->CurrentValue;
            $this->tunjangan_wkosis->ViewValue = FormatNumber($this->tunjangan_wkosis->ViewValue, $this->tunjangan_wkosis->formatPattern());
            $this->tunjangan_wkosis->ViewCustomAttributes = "";

            // nominal_baku
            $this->nominal_baku->ViewValue = $this->nominal_baku->CurrentValue;
            $this->nominal_baku->ViewValue = FormatNumber($this->nominal_baku->ViewValue, $this->nominal_baku->formatPattern());
            $this->nominal_baku->ViewCustomAttributes = "";

            // baku
            $this->baku->ViewValue = $this->baku->CurrentValue;
            $this->baku->ViewValue = FormatNumber($this->baku->ViewValue, $this->baku->formatPattern());
            $this->baku->ViewCustomAttributes = "";

            // kehadiran
            $this->kehadiran->ViewValue = $this->kehadiran->CurrentValue;
            $this->kehadiran->ViewValue = FormatNumber($this->kehadiran->ViewValue, $this->kehadiran->formatPattern());
            $this->kehadiran->ViewCustomAttributes = "";

            // prestasi
            $this->prestasi->ViewValue = $this->prestasi->CurrentValue;
            $this->prestasi->ViewValue = FormatNumber($this->prestasi->ViewValue, $this->prestasi->formatPattern());
            $this->prestasi->ViewCustomAttributes = "";

            // jumlahgaji
            $this->jumlahgaji->ViewValue = $this->jumlahgaji->CurrentValue;
            $this->jumlahgaji->ViewValue = FormatNumber($this->jumlahgaji->ViewValue, $this->jumlahgaji->formatPattern());
            $this->jumlahgaji->ViewCustomAttributes = "";

            // jumgajitotal
            $this->jumgajitotal->ViewValue = $this->jumgajitotal->CurrentValue;
            $this->jumgajitotal->ViewValue = FormatNumber($this->jumgajitotal->ViewValue, $this->jumgajitotal->formatPattern());
            $this->jumgajitotal->ViewCustomAttributes = "";

            // potongan1
            $this->potongan1->ViewValue = $this->potongan1->CurrentValue;
            $this->potongan1->ViewValue = FormatNumber($this->potongan1->ViewValue, $this->potongan1->formatPattern());
            $this->potongan1->ViewCustomAttributes = "";

            // potongan2
            $this->potongan2->ViewValue = $this->potongan2->CurrentValue;
            $this->potongan2->ViewValue = FormatNumber($this->potongan2->ViewValue, $this->potongan2->formatPattern());
            $this->potongan2->ViewCustomAttributes = "";

            // jumlahterima
            $this->jumlahterima->ViewValue = $this->jumlahterima->CurrentValue;
            $this->jumlahterima->ViewValue = FormatNumber($this->jumlahterima->ViewValue, $this->jumlahterima->formatPattern());
            $this->jumlahterima->ViewCustomAttributes = "";

            // pegawai_id
            $this->pegawai_id->LinkCustomAttributes = "";
            $this->pegawai_id->HrefValue = "";
            $this->pegawai_id->TooltipValue = "";

            // jabatan_id
            $this->jabatan_id->LinkCustomAttributes = "";
            $this->jabatan_id->HrefValue = "";
            $this->jabatan_id->TooltipValue = "";

            // masakerja
            $this->masakerja->LinkCustomAttributes = "";
            $this->masakerja->HrefValue = "";
            $this->masakerja->TooltipValue = "";

            // jumngajar
            $this->jumngajar->LinkCustomAttributes = "";
            $this->jumngajar->HrefValue = "";
            $this->jumngajar->TooltipValue = "";

            // ijin
            $this->ijin->LinkCustomAttributes = "";
            $this->ijin->HrefValue = "";
            $this->ijin->TooltipValue = "";

            // tunjangan_wkosis
            $this->tunjangan_wkosis->LinkCustomAttributes = "";
            $this->tunjangan_wkosis->HrefValue = "";
            $this->tunjangan_wkosis->TooltipValue = "";

            // nominal_baku
            $this->nominal_baku->LinkCustomAttributes = "";
            $this->nominal_baku->HrefValue = "";
            $this->nominal_baku->TooltipValue = "";

            // baku
            $this->baku->LinkCustomAttributes = "";
            $this->baku->HrefValue = "";
            $this->baku->TooltipValue = "";

            // kehadiran
            $this->kehadiran->LinkCustomAttributes = "";
            $this->kehadiran->HrefValue = "";
            $this->kehadiran->TooltipValue = "";

            // prestasi
            $this->prestasi->LinkCustomAttributes = "";
            $this->prestasi->HrefValue = "";
            $this->prestasi->TooltipValue = "";

            // jumlahgaji
            $this->jumlahgaji->LinkCustomAttributes = "";
            $this->jumlahgaji->HrefValue = "";
            $this->jumlahgaji->TooltipValue = "";

            // jumgajitotal
            $this->jumgajitotal->LinkCustomAttributes = "";
            $this->jumgajitotal->HrefValue = "";
            $this->jumgajitotal->TooltipValue = "";

            // potongan1
            $this->potongan1->LinkCustomAttributes = "";
            $this->potongan1->HrefValue = "";
            $this->potongan1->TooltipValue = "";

            // potongan2
            $this->potongan2->LinkCustomAttributes = "";
            $this->potongan2->HrefValue = "";
            $this->potongan2->TooltipValue = "";

            // jumlahterima
            $this->jumlahterima->LinkCustomAttributes = "";
            $this->jumlahterima->HrefValue = "";
            $this->jumlahterima->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // pegawai_id
            $this->pegawai_id->setupEditAttributes();
            $this->pegawai_id->EditCustomAttributes = "";
            $this->pegawai_id->EditValue = HtmlEncode($this->pegawai_id->CurrentValue);
            $curVal = strval($this->pegawai_id->CurrentValue);
            if ($curVal != "") {
                $this->pegawai_id->EditValue = $this->pegawai_id->lookupCacheOption($curVal);
                if ($this->pegawai_id->EditValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->pegawai_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->pegawai_id->Lookup->renderViewRow($rswrk[0]);
                        $this->pegawai_id->EditValue = $this->pegawai_id->displayValue($arwrk);
                    } else {
                        $this->pegawai_id->EditValue = HtmlEncode(FormatNumber($this->pegawai_id->CurrentValue, $this->pegawai_id->formatPattern()));
                    }
                }
            } else {
                $this->pegawai_id->EditValue = null;
            }
            $this->pegawai_id->PlaceHolder = RemoveHtml($this->pegawai_id->caption());

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

            // masakerja
            $this->masakerja->setupEditAttributes();
            $this->masakerja->EditCustomAttributes = "";
            $this->masakerja->EditValue = HtmlEncode($this->masakerja->CurrentValue);
            $this->masakerja->PlaceHolder = RemoveHtml($this->masakerja->caption());
            if (strval($this->masakerja->EditValue) != "" && is_numeric($this->masakerja->EditValue)) {
                $this->masakerja->EditValue = FormatNumber($this->masakerja->EditValue, null);
                $this->masakerja->OldValue = $this->masakerja->EditValue;
            }

            // jumngajar
            $this->jumngajar->setupEditAttributes();
            $this->jumngajar->EditCustomAttributes = "";
            $this->jumngajar->EditValue = HtmlEncode($this->jumngajar->CurrentValue);
            $this->jumngajar->PlaceHolder = RemoveHtml($this->jumngajar->caption());
            if (strval($this->jumngajar->EditValue) != "" && is_numeric($this->jumngajar->EditValue)) {
                $this->jumngajar->EditValue = FormatNumber($this->jumngajar->EditValue, null);
                $this->jumngajar->OldValue = $this->jumngajar->EditValue;
            }

            // ijin
            $this->ijin->setupEditAttributes();
            $this->ijin->EditCustomAttributes = "";
            $this->ijin->EditValue = HtmlEncode($this->ijin->CurrentValue);
            $this->ijin->PlaceHolder = RemoveHtml($this->ijin->caption());
            if (strval($this->ijin->EditValue) != "" && is_numeric($this->ijin->EditValue)) {
                $this->ijin->EditValue = FormatNumber($this->ijin->EditValue, null);
                $this->ijin->OldValue = $this->ijin->EditValue;
            }

            // tunjangan_wkosis
            $this->tunjangan_wkosis->setupEditAttributes();
            $this->tunjangan_wkosis->EditCustomAttributes = "";
            $this->tunjangan_wkosis->EditValue = HtmlEncode($this->tunjangan_wkosis->CurrentValue);
            $this->tunjangan_wkosis->PlaceHolder = RemoveHtml($this->tunjangan_wkosis->caption());
            if (strval($this->tunjangan_wkosis->EditValue) != "" && is_numeric($this->tunjangan_wkosis->EditValue)) {
                $this->tunjangan_wkosis->EditValue = FormatNumber($this->tunjangan_wkosis->EditValue, null);
                $this->tunjangan_wkosis->OldValue = $this->tunjangan_wkosis->EditValue;
            }

            // nominal_baku
            $this->nominal_baku->setupEditAttributes();
            $this->nominal_baku->EditCustomAttributes = "";
            $this->nominal_baku->EditValue = HtmlEncode($this->nominal_baku->CurrentValue);
            $this->nominal_baku->PlaceHolder = RemoveHtml($this->nominal_baku->caption());
            if (strval($this->nominal_baku->EditValue) != "" && is_numeric($this->nominal_baku->EditValue)) {
                $this->nominal_baku->EditValue = FormatNumber($this->nominal_baku->EditValue, null);
                $this->nominal_baku->OldValue = $this->nominal_baku->EditValue;
            }

            // baku
            $this->baku->setupEditAttributes();
            $this->baku->EditCustomAttributes = "";
            $this->baku->EditValue = HtmlEncode($this->baku->CurrentValue);
            $this->baku->PlaceHolder = RemoveHtml($this->baku->caption());
            if (strval($this->baku->EditValue) != "" && is_numeric($this->baku->EditValue)) {
                $this->baku->EditValue = FormatNumber($this->baku->EditValue, null);
                $this->baku->OldValue = $this->baku->EditValue;
            }

            // kehadiran
            $this->kehadiran->setupEditAttributes();
            $this->kehadiran->EditCustomAttributes = "";
            $this->kehadiran->EditValue = HtmlEncode($this->kehadiran->CurrentValue);
            $this->kehadiran->PlaceHolder = RemoveHtml($this->kehadiran->caption());
            if (strval($this->kehadiran->EditValue) != "" && is_numeric($this->kehadiran->EditValue)) {
                $this->kehadiran->EditValue = FormatNumber($this->kehadiran->EditValue, null);
                $this->kehadiran->OldValue = $this->kehadiran->EditValue;
            }

            // prestasi
            $this->prestasi->setupEditAttributes();
            $this->prestasi->EditCustomAttributes = "";
            $this->prestasi->EditValue = HtmlEncode($this->prestasi->CurrentValue);
            $this->prestasi->PlaceHolder = RemoveHtml($this->prestasi->caption());
            if (strval($this->prestasi->EditValue) != "" && is_numeric($this->prestasi->EditValue)) {
                $this->prestasi->EditValue = FormatNumber($this->prestasi->EditValue, null);
                $this->prestasi->OldValue = $this->prestasi->EditValue;
            }

            // jumlahgaji
            $this->jumlahgaji->setupEditAttributes();
            $this->jumlahgaji->EditCustomAttributes = "";
            $this->jumlahgaji->EditValue = HtmlEncode($this->jumlahgaji->CurrentValue);
            $this->jumlahgaji->PlaceHolder = RemoveHtml($this->jumlahgaji->caption());
            if (strval($this->jumlahgaji->EditValue) != "" && is_numeric($this->jumlahgaji->EditValue)) {
                $this->jumlahgaji->EditValue = FormatNumber($this->jumlahgaji->EditValue, null);
                $this->jumlahgaji->OldValue = $this->jumlahgaji->EditValue;
            }

            // jumgajitotal
            $this->jumgajitotal->setupEditAttributes();
            $this->jumgajitotal->EditCustomAttributes = "";
            $this->jumgajitotal->EditValue = HtmlEncode($this->jumgajitotal->CurrentValue);
            $this->jumgajitotal->PlaceHolder = RemoveHtml($this->jumgajitotal->caption());
            if (strval($this->jumgajitotal->EditValue) != "" && is_numeric($this->jumgajitotal->EditValue)) {
                $this->jumgajitotal->EditValue = FormatNumber($this->jumgajitotal->EditValue, null);
                $this->jumgajitotal->OldValue = $this->jumgajitotal->EditValue;
            }

            // potongan1
            $this->potongan1->setupEditAttributes();
            $this->potongan1->EditCustomAttributes = "";
            $this->potongan1->EditValue = HtmlEncode($this->potongan1->CurrentValue);
            $this->potongan1->PlaceHolder = RemoveHtml($this->potongan1->caption());
            if (strval($this->potongan1->EditValue) != "" && is_numeric($this->potongan1->EditValue)) {
                $this->potongan1->EditValue = FormatNumber($this->potongan1->EditValue, null);
                $this->potongan1->OldValue = $this->potongan1->EditValue;
            }

            // potongan2
            $this->potongan2->setupEditAttributes();
            $this->potongan2->EditCustomAttributes = "";
            $this->potongan2->EditValue = HtmlEncode($this->potongan2->CurrentValue);
            $this->potongan2->PlaceHolder = RemoveHtml($this->potongan2->caption());
            if (strval($this->potongan2->EditValue) != "" && is_numeric($this->potongan2->EditValue)) {
                $this->potongan2->EditValue = FormatNumber($this->potongan2->EditValue, null);
                $this->potongan2->OldValue = $this->potongan2->EditValue;
            }

            // jumlahterima
            $this->jumlahterima->setupEditAttributes();
            $this->jumlahterima->EditCustomAttributes = "";
            $this->jumlahterima->EditValue = HtmlEncode($this->jumlahterima->CurrentValue);
            $this->jumlahterima->PlaceHolder = RemoveHtml($this->jumlahterima->caption());
            if (strval($this->jumlahterima->EditValue) != "" && is_numeric($this->jumlahterima->EditValue)) {
                $this->jumlahterima->EditValue = FormatNumber($this->jumlahterima->EditValue, null);
                $this->jumlahterima->OldValue = $this->jumlahterima->EditValue;
            }

            // Add refer script

            // pegawai_id
            $this->pegawai_id->LinkCustomAttributes = "";
            $this->pegawai_id->HrefValue = "";

            // jabatan_id
            $this->jabatan_id->LinkCustomAttributes = "";
            $this->jabatan_id->HrefValue = "";

            // masakerja
            $this->masakerja->LinkCustomAttributes = "";
            $this->masakerja->HrefValue = "";

            // jumngajar
            $this->jumngajar->LinkCustomAttributes = "";
            $this->jumngajar->HrefValue = "";

            // ijin
            $this->ijin->LinkCustomAttributes = "";
            $this->ijin->HrefValue = "";

            // tunjangan_wkosis
            $this->tunjangan_wkosis->LinkCustomAttributes = "";
            $this->tunjangan_wkosis->HrefValue = "";

            // nominal_baku
            $this->nominal_baku->LinkCustomAttributes = "";
            $this->nominal_baku->HrefValue = "";

            // baku
            $this->baku->LinkCustomAttributes = "";
            $this->baku->HrefValue = "";

            // kehadiran
            $this->kehadiran->LinkCustomAttributes = "";
            $this->kehadiran->HrefValue = "";

            // prestasi
            $this->prestasi->LinkCustomAttributes = "";
            $this->prestasi->HrefValue = "";

            // jumlahgaji
            $this->jumlahgaji->LinkCustomAttributes = "";
            $this->jumlahgaji->HrefValue = "";

            // jumgajitotal
            $this->jumgajitotal->LinkCustomAttributes = "";
            $this->jumgajitotal->HrefValue = "";

            // potongan1
            $this->potongan1->LinkCustomAttributes = "";
            $this->potongan1->HrefValue = "";

            // potongan2
            $this->potongan2->LinkCustomAttributes = "";
            $this->potongan2->HrefValue = "";

            // jumlahterima
            $this->jumlahterima->LinkCustomAttributes = "";
            $this->jumlahterima->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // pegawai_id
            $this->pegawai_id->setupEditAttributes();
            $this->pegawai_id->EditCustomAttributes = "";
            $this->pegawai_id->EditValue = HtmlEncode($this->pegawai_id->CurrentValue);
            $curVal = strval($this->pegawai_id->CurrentValue);
            if ($curVal != "") {
                $this->pegawai_id->EditValue = $this->pegawai_id->lookupCacheOption($curVal);
                if ($this->pegawai_id->EditValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->pegawai_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->pegawai_id->Lookup->renderViewRow($rswrk[0]);
                        $this->pegawai_id->EditValue = $this->pegawai_id->displayValue($arwrk);
                    } else {
                        $this->pegawai_id->EditValue = HtmlEncode(FormatNumber($this->pegawai_id->CurrentValue, $this->pegawai_id->formatPattern()));
                    }
                }
            } else {
                $this->pegawai_id->EditValue = null;
            }
            $this->pegawai_id->PlaceHolder = RemoveHtml($this->pegawai_id->caption());

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

            // masakerja
            $this->masakerja->setupEditAttributes();
            $this->masakerja->EditCustomAttributes = "";
            $this->masakerja->EditValue = HtmlEncode($this->masakerja->CurrentValue);
            $this->masakerja->PlaceHolder = RemoveHtml($this->masakerja->caption());
            if (strval($this->masakerja->EditValue) != "" && is_numeric($this->masakerja->EditValue)) {
                $this->masakerja->EditValue = FormatNumber($this->masakerja->EditValue, null);
                $this->masakerja->OldValue = $this->masakerja->EditValue;
            }

            // jumngajar
            $this->jumngajar->setupEditAttributes();
            $this->jumngajar->EditCustomAttributes = "";
            $this->jumngajar->EditValue = HtmlEncode($this->jumngajar->CurrentValue);
            $this->jumngajar->PlaceHolder = RemoveHtml($this->jumngajar->caption());
            if (strval($this->jumngajar->EditValue) != "" && is_numeric($this->jumngajar->EditValue)) {
                $this->jumngajar->EditValue = FormatNumber($this->jumngajar->EditValue, null);
                $this->jumngajar->OldValue = $this->jumngajar->EditValue;
            }

            // ijin
            $this->ijin->setupEditAttributes();
            $this->ijin->EditCustomAttributes = "";
            $this->ijin->EditValue = HtmlEncode($this->ijin->CurrentValue);
            $this->ijin->PlaceHolder = RemoveHtml($this->ijin->caption());
            if (strval($this->ijin->EditValue) != "" && is_numeric($this->ijin->EditValue)) {
                $this->ijin->EditValue = FormatNumber($this->ijin->EditValue, null);
                $this->ijin->OldValue = $this->ijin->EditValue;
            }

            // tunjangan_wkosis
            $this->tunjangan_wkosis->setupEditAttributes();
            $this->tunjangan_wkosis->EditCustomAttributes = "";
            $this->tunjangan_wkosis->EditValue = HtmlEncode($this->tunjangan_wkosis->CurrentValue);
            $this->tunjangan_wkosis->PlaceHolder = RemoveHtml($this->tunjangan_wkosis->caption());
            if (strval($this->tunjangan_wkosis->EditValue) != "" && is_numeric($this->tunjangan_wkosis->EditValue)) {
                $this->tunjangan_wkosis->EditValue = FormatNumber($this->tunjangan_wkosis->EditValue, null);
                $this->tunjangan_wkosis->OldValue = $this->tunjangan_wkosis->EditValue;
            }

            // nominal_baku
            $this->nominal_baku->setupEditAttributes();
            $this->nominal_baku->EditCustomAttributes = "";
            $this->nominal_baku->EditValue = HtmlEncode($this->nominal_baku->CurrentValue);
            $this->nominal_baku->PlaceHolder = RemoveHtml($this->nominal_baku->caption());
            if (strval($this->nominal_baku->EditValue) != "" && is_numeric($this->nominal_baku->EditValue)) {
                $this->nominal_baku->EditValue = FormatNumber($this->nominal_baku->EditValue, null);
                $this->nominal_baku->OldValue = $this->nominal_baku->EditValue;
            }

            // baku
            $this->baku->setupEditAttributes();
            $this->baku->EditCustomAttributes = "";
            $this->baku->EditValue = HtmlEncode($this->baku->CurrentValue);
            $this->baku->PlaceHolder = RemoveHtml($this->baku->caption());
            if (strval($this->baku->EditValue) != "" && is_numeric($this->baku->EditValue)) {
                $this->baku->EditValue = FormatNumber($this->baku->EditValue, null);
                $this->baku->OldValue = $this->baku->EditValue;
            }

            // kehadiran
            $this->kehadiran->setupEditAttributes();
            $this->kehadiran->EditCustomAttributes = "";
            $this->kehadiran->EditValue = HtmlEncode($this->kehadiran->CurrentValue);
            $this->kehadiran->PlaceHolder = RemoveHtml($this->kehadiran->caption());
            if (strval($this->kehadiran->EditValue) != "" && is_numeric($this->kehadiran->EditValue)) {
                $this->kehadiran->EditValue = FormatNumber($this->kehadiran->EditValue, null);
                $this->kehadiran->OldValue = $this->kehadiran->EditValue;
            }

            // prestasi
            $this->prestasi->setupEditAttributes();
            $this->prestasi->EditCustomAttributes = "";
            $this->prestasi->EditValue = HtmlEncode($this->prestasi->CurrentValue);
            $this->prestasi->PlaceHolder = RemoveHtml($this->prestasi->caption());
            if (strval($this->prestasi->EditValue) != "" && is_numeric($this->prestasi->EditValue)) {
                $this->prestasi->EditValue = FormatNumber($this->prestasi->EditValue, null);
                $this->prestasi->OldValue = $this->prestasi->EditValue;
            }

            // jumlahgaji
            $this->jumlahgaji->setupEditAttributes();
            $this->jumlahgaji->EditCustomAttributes = "";
            $this->jumlahgaji->EditValue = HtmlEncode($this->jumlahgaji->CurrentValue);
            $this->jumlahgaji->PlaceHolder = RemoveHtml($this->jumlahgaji->caption());
            if (strval($this->jumlahgaji->EditValue) != "" && is_numeric($this->jumlahgaji->EditValue)) {
                $this->jumlahgaji->EditValue = FormatNumber($this->jumlahgaji->EditValue, null);
                $this->jumlahgaji->OldValue = $this->jumlahgaji->EditValue;
            }

            // jumgajitotal
            $this->jumgajitotal->setupEditAttributes();
            $this->jumgajitotal->EditCustomAttributes = "";
            $this->jumgajitotal->EditValue = HtmlEncode($this->jumgajitotal->CurrentValue);
            $this->jumgajitotal->PlaceHolder = RemoveHtml($this->jumgajitotal->caption());
            if (strval($this->jumgajitotal->EditValue) != "" && is_numeric($this->jumgajitotal->EditValue)) {
                $this->jumgajitotal->EditValue = FormatNumber($this->jumgajitotal->EditValue, null);
                $this->jumgajitotal->OldValue = $this->jumgajitotal->EditValue;
            }

            // potongan1
            $this->potongan1->setupEditAttributes();
            $this->potongan1->EditCustomAttributes = "";
            $this->potongan1->EditValue = HtmlEncode($this->potongan1->CurrentValue);
            $this->potongan1->PlaceHolder = RemoveHtml($this->potongan1->caption());
            if (strval($this->potongan1->EditValue) != "" && is_numeric($this->potongan1->EditValue)) {
                $this->potongan1->EditValue = FormatNumber($this->potongan1->EditValue, null);
                $this->potongan1->OldValue = $this->potongan1->EditValue;
            }

            // potongan2
            $this->potongan2->setupEditAttributes();
            $this->potongan2->EditCustomAttributes = "";
            $this->potongan2->EditValue = HtmlEncode($this->potongan2->CurrentValue);
            $this->potongan2->PlaceHolder = RemoveHtml($this->potongan2->caption());
            if (strval($this->potongan2->EditValue) != "" && is_numeric($this->potongan2->EditValue)) {
                $this->potongan2->EditValue = FormatNumber($this->potongan2->EditValue, null);
                $this->potongan2->OldValue = $this->potongan2->EditValue;
            }

            // jumlahterima
            $this->jumlahterima->setupEditAttributes();
            $this->jumlahterima->EditCustomAttributes = "";
            $this->jumlahterima->EditValue = HtmlEncode($this->jumlahterima->CurrentValue);
            $this->jumlahterima->PlaceHolder = RemoveHtml($this->jumlahterima->caption());
            if (strval($this->jumlahterima->EditValue) != "" && is_numeric($this->jumlahterima->EditValue)) {
                $this->jumlahterima->EditValue = FormatNumber($this->jumlahterima->EditValue, null);
                $this->jumlahterima->OldValue = $this->jumlahterima->EditValue;
            }

            // Edit refer script

            // pegawai_id
            $this->pegawai_id->LinkCustomAttributes = "";
            $this->pegawai_id->HrefValue = "";

            // jabatan_id
            $this->jabatan_id->LinkCustomAttributes = "";
            $this->jabatan_id->HrefValue = "";

            // masakerja
            $this->masakerja->LinkCustomAttributes = "";
            $this->masakerja->HrefValue = "";

            // jumngajar
            $this->jumngajar->LinkCustomAttributes = "";
            $this->jumngajar->HrefValue = "";

            // ijin
            $this->ijin->LinkCustomAttributes = "";
            $this->ijin->HrefValue = "";

            // tunjangan_wkosis
            $this->tunjangan_wkosis->LinkCustomAttributes = "";
            $this->tunjangan_wkosis->HrefValue = "";

            // nominal_baku
            $this->nominal_baku->LinkCustomAttributes = "";
            $this->nominal_baku->HrefValue = "";

            // baku
            $this->baku->LinkCustomAttributes = "";
            $this->baku->HrefValue = "";

            // kehadiran
            $this->kehadiran->LinkCustomAttributes = "";
            $this->kehadiran->HrefValue = "";

            // prestasi
            $this->prestasi->LinkCustomAttributes = "";
            $this->prestasi->HrefValue = "";

            // jumlahgaji
            $this->jumlahgaji->LinkCustomAttributes = "";
            $this->jumlahgaji->HrefValue = "";

            // jumgajitotal
            $this->jumgajitotal->LinkCustomAttributes = "";
            $this->jumgajitotal->HrefValue = "";

            // potongan1
            $this->potongan1->LinkCustomAttributes = "";
            $this->potongan1->HrefValue = "";

            // potongan2
            $this->potongan2->LinkCustomAttributes = "";
            $this->potongan2->HrefValue = "";

            // jumlahterima
            $this->jumlahterima->LinkCustomAttributes = "";
            $this->jumlahterima->HrefValue = "";
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
        if ($this->pegawai_id->Required) {
            if (!$this->pegawai_id->IsDetailKey && EmptyValue($this->pegawai_id->FormValue)) {
                $this->pegawai_id->addErrorMessage(str_replace("%s", $this->pegawai_id->caption(), $this->pegawai_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->pegawai_id->FormValue)) {
            $this->pegawai_id->addErrorMessage($this->pegawai_id->getErrorMessage(false));
        }
        if ($this->jabatan_id->Required) {
            if (!$this->jabatan_id->IsDetailKey && EmptyValue($this->jabatan_id->FormValue)) {
                $this->jabatan_id->addErrorMessage(str_replace("%s", $this->jabatan_id->caption(), $this->jabatan_id->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jabatan_id->FormValue)) {
            $this->jabatan_id->addErrorMessage($this->jabatan_id->getErrorMessage(false));
        }
        if ($this->masakerja->Required) {
            if (!$this->masakerja->IsDetailKey && EmptyValue($this->masakerja->FormValue)) {
                $this->masakerja->addErrorMessage(str_replace("%s", $this->masakerja->caption(), $this->masakerja->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->masakerja->FormValue)) {
            $this->masakerja->addErrorMessage($this->masakerja->getErrorMessage(false));
        }
        if ($this->jumngajar->Required) {
            if (!$this->jumngajar->IsDetailKey && EmptyValue($this->jumngajar->FormValue)) {
                $this->jumngajar->addErrorMessage(str_replace("%s", $this->jumngajar->caption(), $this->jumngajar->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jumngajar->FormValue)) {
            $this->jumngajar->addErrorMessage($this->jumngajar->getErrorMessage(false));
        }
        if ($this->ijin->Required) {
            if (!$this->ijin->IsDetailKey && EmptyValue($this->ijin->FormValue)) {
                $this->ijin->addErrorMessage(str_replace("%s", $this->ijin->caption(), $this->ijin->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->ijin->FormValue)) {
            $this->ijin->addErrorMessage($this->ijin->getErrorMessage(false));
        }
        if ($this->tunjangan_wkosis->Required) {
            if (!$this->tunjangan_wkosis->IsDetailKey && EmptyValue($this->tunjangan_wkosis->FormValue)) {
                $this->tunjangan_wkosis->addErrorMessage(str_replace("%s", $this->tunjangan_wkosis->caption(), $this->tunjangan_wkosis->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->tunjangan_wkosis->FormValue)) {
            $this->tunjangan_wkosis->addErrorMessage($this->tunjangan_wkosis->getErrorMessage(false));
        }
        if ($this->nominal_baku->Required) {
            if (!$this->nominal_baku->IsDetailKey && EmptyValue($this->nominal_baku->FormValue)) {
                $this->nominal_baku->addErrorMessage(str_replace("%s", $this->nominal_baku->caption(), $this->nominal_baku->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->nominal_baku->FormValue)) {
            $this->nominal_baku->addErrorMessage($this->nominal_baku->getErrorMessage(false));
        }
        if ($this->baku->Required) {
            if (!$this->baku->IsDetailKey && EmptyValue($this->baku->FormValue)) {
                $this->baku->addErrorMessage(str_replace("%s", $this->baku->caption(), $this->baku->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->baku->FormValue)) {
            $this->baku->addErrorMessage($this->baku->getErrorMessage(false));
        }
        if ($this->kehadiran->Required) {
            if (!$this->kehadiran->IsDetailKey && EmptyValue($this->kehadiran->FormValue)) {
                $this->kehadiran->addErrorMessage(str_replace("%s", $this->kehadiran->caption(), $this->kehadiran->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->kehadiran->FormValue)) {
            $this->kehadiran->addErrorMessage($this->kehadiran->getErrorMessage(false));
        }
        if ($this->prestasi->Required) {
            if (!$this->prestasi->IsDetailKey && EmptyValue($this->prestasi->FormValue)) {
                $this->prestasi->addErrorMessage(str_replace("%s", $this->prestasi->caption(), $this->prestasi->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->prestasi->FormValue)) {
            $this->prestasi->addErrorMessage($this->prestasi->getErrorMessage(false));
        }
        if ($this->jumlahgaji->Required) {
            if (!$this->jumlahgaji->IsDetailKey && EmptyValue($this->jumlahgaji->FormValue)) {
                $this->jumlahgaji->addErrorMessage(str_replace("%s", $this->jumlahgaji->caption(), $this->jumlahgaji->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jumlahgaji->FormValue)) {
            $this->jumlahgaji->addErrorMessage($this->jumlahgaji->getErrorMessage(false));
        }
        if ($this->jumgajitotal->Required) {
            if (!$this->jumgajitotal->IsDetailKey && EmptyValue($this->jumgajitotal->FormValue)) {
                $this->jumgajitotal->addErrorMessage(str_replace("%s", $this->jumgajitotal->caption(), $this->jumgajitotal->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jumgajitotal->FormValue)) {
            $this->jumgajitotal->addErrorMessage($this->jumgajitotal->getErrorMessage(false));
        }
        if ($this->potongan1->Required) {
            if (!$this->potongan1->IsDetailKey && EmptyValue($this->potongan1->FormValue)) {
                $this->potongan1->addErrorMessage(str_replace("%s", $this->potongan1->caption(), $this->potongan1->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->potongan1->FormValue)) {
            $this->potongan1->addErrorMessage($this->potongan1->getErrorMessage(false));
        }
        if ($this->potongan2->Required) {
            if (!$this->potongan2->IsDetailKey && EmptyValue($this->potongan2->FormValue)) {
                $this->potongan2->addErrorMessage(str_replace("%s", $this->potongan2->caption(), $this->potongan2->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->potongan2->FormValue)) {
            $this->potongan2->addErrorMessage($this->potongan2->getErrorMessage(false));
        }
        if ($this->jumlahterima->Required) {
            if (!$this->jumlahterima->IsDetailKey && EmptyValue($this->jumlahterima->FormValue)) {
                $this->jumlahterima->addErrorMessage(str_replace("%s", $this->jumlahterima->caption(), $this->jumlahterima->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jumlahterima->FormValue)) {
            $this->jumlahterima->addErrorMessage($this->jumlahterima->getErrorMessage(false));
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

    // Delete records based on current filter
    protected function deleteRows()
    {
        global $Language, $Security;
        if (!$Security->canDelete()) {
            $this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
            return false;
        }
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $rows = $conn->fetchAllAssociative($sql);
        if (count($rows) == 0) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
            return false;
        }

        // Clone old rows
        $rsold = $rows;
        $successKeys = [];
        $failKeys = [];
        foreach ($rsold as $row) {
            $thisKey = "";
            if ($thisKey != "") {
                $thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
            }
            $thisKey .= $row['id'];

            // Call row deleting event
            $deleteRow = $this->rowDeleting($row);
            if ($deleteRow) { // Delete
                $deleteRow = $this->delete($row);
            }
            if ($deleteRow === false) {
                if ($this->UseTransaction) {
                    $successKeys = []; // Reset success keys
                    break;
                }
                $failKeys[] = $thisKey;
            } else {
                if (Config("DELETE_UPLOADED_FILES")) { // Delete old files
                    $this->deleteUploadedFiles($row);
                }

                // Call Row Deleted event
                $this->rowDeleted($row);
                $successKeys[] = $thisKey;
            }
        }

        // Any records deleted
        $deleteRows = count($successKeys) > 0;
        if (!$deleteRows) {
            // Set up error message
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("DeleteCancelled"));
            }
        }

        // Write JSON for API request
        if (IsApi() && $deleteRows) {
            $row = $this->getRecordsFromRecordset($rsold);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $deleteRows;
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

        // pegawai_id
        $this->pegawai_id->setDbValueDef($rsnew, $this->pegawai_id->CurrentValue, null, $this->pegawai_id->ReadOnly);

        // jabatan_id
        $this->jabatan_id->setDbValueDef($rsnew, $this->jabatan_id->CurrentValue, null, $this->jabatan_id->ReadOnly);

        // masakerja
        $this->masakerja->setDbValueDef($rsnew, $this->masakerja->CurrentValue, null, $this->masakerja->ReadOnly);

        // jumngajar
        $this->jumngajar->setDbValueDef($rsnew, $this->jumngajar->CurrentValue, null, $this->jumngajar->ReadOnly);

        // ijin
        $this->ijin->setDbValueDef($rsnew, $this->ijin->CurrentValue, null, $this->ijin->ReadOnly);

        // tunjangan_wkosis
        $this->tunjangan_wkosis->setDbValueDef($rsnew, $this->tunjangan_wkosis->CurrentValue, null, $this->tunjangan_wkosis->ReadOnly);

        // nominal_baku
        $this->nominal_baku->setDbValueDef($rsnew, $this->nominal_baku->CurrentValue, null, $this->nominal_baku->ReadOnly);

        // baku
        $this->baku->setDbValueDef($rsnew, $this->baku->CurrentValue, null, $this->baku->ReadOnly);

        // kehadiran
        $this->kehadiran->setDbValueDef($rsnew, $this->kehadiran->CurrentValue, null, $this->kehadiran->ReadOnly);

        // prestasi
        $this->prestasi->setDbValueDef($rsnew, $this->prestasi->CurrentValue, null, $this->prestasi->ReadOnly);

        // jumlahgaji
        $this->jumlahgaji->setDbValueDef($rsnew, $this->jumlahgaji->CurrentValue, null, $this->jumlahgaji->ReadOnly);

        // jumgajitotal
        $this->jumgajitotal->setDbValueDef($rsnew, $this->jumgajitotal->CurrentValue, null, $this->jumgajitotal->ReadOnly);

        // potongan1
        $this->potongan1->setDbValueDef($rsnew, $this->potongan1->CurrentValue, null, $this->potongan1->ReadOnly);

        // potongan2
        $this->potongan2->setDbValueDef($rsnew, $this->potongan2->CurrentValue, null, $this->potongan2->ReadOnly);

        // jumlahterima
        $this->jumlahterima->setDbValueDef($rsnew, $this->jumlahterima->CurrentValue, null, $this->jumlahterima->ReadOnly);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check referential integrity for master table 'gajismk'
        $detailKeys = [];
        $keyValue = $rsnew['pid'] ?? $rsold['pid'];
        $detailKeys['pid'] = $keyValue;
        $masterTable = Container("gajismk");
        $masterFilter = $this->getMasterFilter($masterTable, $detailKeys);
        if (!EmptyValue($masterFilter)) {
            $rsmaster = $masterTable->loadRs($masterFilter)->fetch();
            $validMasterRecord = $rsmaster !== false;
        } else { // Allow null value if not required field
            $validMasterRecord = $masterFilter === null;
        }
        if (!$validMasterRecord) {
            $relatedRecordMsg = str_replace("%t", "gajismk", $Language->phrase("RelatedRecordRequired"));
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set up foreign key field value from Session
        if ($this->getCurrentMasterTable() == "gajismk") {
            $this->pid->CurrentValue = $this->pid->getSessionValue();
        }

        // Set new row
        $rsnew = [];

        // pegawai_id
        $this->pegawai_id->setDbValueDef($rsnew, $this->pegawai_id->CurrentValue, null, false);

        // jabatan_id
        $this->jabatan_id->setDbValueDef($rsnew, $this->jabatan_id->CurrentValue, null, false);

        // masakerja
        $this->masakerja->setDbValueDef($rsnew, $this->masakerja->CurrentValue, null, false);

        // jumngajar
        $this->jumngajar->setDbValueDef($rsnew, $this->jumngajar->CurrentValue, null, false);

        // ijin
        $this->ijin->setDbValueDef($rsnew, $this->ijin->CurrentValue, null, false);

        // tunjangan_wkosis
        $this->tunjangan_wkosis->setDbValueDef($rsnew, $this->tunjangan_wkosis->CurrentValue, null, false);

        // nominal_baku
        $this->nominal_baku->setDbValueDef($rsnew, $this->nominal_baku->CurrentValue, null, false);

        // baku
        $this->baku->setDbValueDef($rsnew, $this->baku->CurrentValue, null, false);

        // kehadiran
        $this->kehadiran->setDbValueDef($rsnew, $this->kehadiran->CurrentValue, null, false);

        // prestasi
        $this->prestasi->setDbValueDef($rsnew, $this->prestasi->CurrentValue, null, false);

        // jumlahgaji
        $this->jumlahgaji->setDbValueDef($rsnew, $this->jumlahgaji->CurrentValue, null, false);

        // jumgajitotal
        $this->jumgajitotal->setDbValueDef($rsnew, $this->jumgajitotal->CurrentValue, null, false);

        // potongan1
        $this->potongan1->setDbValueDef($rsnew, $this->potongan1->CurrentValue, null, false);

        // potongan2
        $this->potongan2->setDbValueDef($rsnew, $this->potongan2->CurrentValue, null, false);

        // jumlahterima
        $this->jumlahterima->setDbValueDef($rsnew, $this->jumlahterima->CurrentValue, null, false);

        // pid
        if ($this->pid->getSessionValue() != "") {
            $rsnew['pid'] = $this->pid->getSessionValue();
        }

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check referential integrity for master table 'gajismk_detil'
        $validMasterRecord = true;
        $detailKeys = [];
        $detailKeys["pid"] = $this->pid->getSessionValue();
        $masterTable = Container("gajismk");
        $masterFilter = $this->getMasterFilter($masterTable, $detailKeys);
        if (!EmptyValue($masterFilter)) {
            $rsmaster = $masterTable->loadRs($masterFilter)->fetch();
            $validMasterRecord = $rsmaster !== false;
        } else { // Allow null value if not required field
            $validMasterRecord = $masterFilter === null;
        }
        if (!$validMasterRecord) {
            $relatedRecordMsg = str_replace("%t", "gajismk", $Language->phrase("RelatedRecordRequired"));
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
        // Hide foreign keys
        $masterTblVar = $this->getCurrentMasterTable();
        if ($masterTblVar == "gajismk") {
            $masterTbl = Container("gajismk");
            $this->pid->Visible = false;
            if ($masterTbl->EventCancelled) {
                $this->EventCancelled = true;
            }
        }
        $this->DbMasterFilter = $this->getMasterFilterFromSession(); // Get master filter from session
        $this->DbDetailFilter = $this->getDetailFilterFromSession(); // Get detail filter from session
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
                case "x_pegawai_id":
                    break;
                case "x_jabatan_id":
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

    // ListOptions Load event
    public function listOptionsLoad()
    {
        // Example:
        //$opt = &$this->ListOptions->Add("new");
        //$opt->Header = "xxx";
        //$opt->OnLeft = true; // Link on left
        //$opt->MoveTo(0); // Move to first column
    }

    // ListOptions Rendering event
    public function listOptionsRendering()
    {
        //Container("DetailTableGrid")->DetailAdd = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailEdit = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailView = (...condition...); // Set to true or false conditionally
    }

    // ListOptions Rendered event
    public function listOptionsRendered()
    {
        // Example:
        //$this->ListOptions["new"]->Body = "xxx";
    }
}
