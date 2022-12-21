<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class GajiList extends Gaji
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'gaji';

    // Page object name
    public $PageObjName = "GajiList";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fgajilist";
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

    // Update URLs
    public $InlineAddUrl;
    public $InlineCopyUrl;
    public $InlineEditUrl;
    public $GridAddUrl;
    public $GridEditUrl;
    public $MultiDeleteUrl;
    public $MultiUpdateUrl;

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

        // Page URL
        $pageUrl = $this->pageUrl(false);

        // Initialize URLs
        $this->AddUrl = "GajiAdd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "GajiDelete";
        $this->MultiUpdateUrl = "GajiUpdate";

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

        // List options
        $this->ListOptions = new ListOptions(["Tag" => "td", "TableVar" => $this->TableVar]);

        // Export options
        $this->ExportOptions = new ListOptions(["TagClassName" => "ew-export-option"]);

        // Import options
        $this->ImportOptions = new ListOptions(["TagClassName" => "ew-import-option"]);

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

        // Detail tables
        $this->OtherOptions["detail"] = new ListOptions(["TagClassName" => "ew-detail-option"]);
        // Actions
        $this->OtherOptions["action"] = new ListOptions(["TagClassName" => "ew-action-option"]);

        // Column visibility
        $this->OtherOptions["column"] = new ListOptions([
            "TableVar" => $this->TableVar,
            "TagClassName" => "ew-column-option",
            "ButtonGroupClass" => "ew-column-dropdown",
            "UseDropDownButton" => true,
            "DropDownButtonPhrase" => $Language->phrase("Columns"),
            "DropDownAutoClose" => "outside",
            "UseButtonGroup" => false
        ]);

        // Filter options
        $this->FilterOptions = new ListOptions(["TagClassName" => "ew-filter-option"]);

        // List actions
        $this->ListActions = new ListActions();
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
                        if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0) {
                            $val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
                        }
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
        if ($this->isAddOrEdit()) {
            $this->datetime->Visible = false;
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
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();

        // Setup import options
        $this->setupImportOptions();
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

        // Setup other options
        $this->setupOtherOptions();

        // Set up custom action (compatible with old version)
        foreach ($this->CustomActions as $name => $action) {
            $this->ListActions->add($name, $action);
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->jabatan_id);
        $this->setupLookupOptions($this->pegawai);

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = "";

        // Get command
        $this->Command = strtolower(Get("cmd", ""));
        if ($this->isPageRequest()) {
            // Process list action first
            if ($this->processListAction()) { // Ajax request
                $this->terminate();
                return;
            }

            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

            // Set up Breadcrumb
            if (!$this->isExport()) {
                $this->setupBreadcrumb();
            }

            // Check QueryString parameters
            if (Get("action") !== null) {
                $this->CurrentAction = Get("action");
            } else {
                if (Post("action") !== null) {
                    $this->CurrentAction = Post("action"); // Get action

                    // Process import
                    if ($this->isImport()) {
                        $this->import(Post(Config("API_FILE_TOKEN_NAME")));
                        $this->terminate();
                        return;
                    }
                }
            }

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

            // Hide options
            if ($this->isExport() || $this->CurrentAction) {
                $this->ExportOptions->hideAllOptions();
                $this->FilterOptions->hideAllOptions();
                $this->ImportOptions->hideAllOptions();
            }

            // Hide other options
            if ($this->isExport()) {
                $this->OtherOptions->hideAllOptions();
            }

            // Get default search criteria
            AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(true));
            AddFilter($this->DefaultSearchWhere, $this->advancedSearchWhere(true));

            // Get basic search values
            $this->loadBasicSearchValues();

            // Get and validate search values for advanced search
            if (EmptyValue($this->UserAction)) { // Skip if user action
                $this->loadSearchValues();
            }

            // Process filter list
            if ($this->processFilterList()) {
                $this->terminate();
                return;
            }
            if (!$this->validateSearch()) {
                // Nothing to do
            }

            // Restore search parms from Session if not searching / reset / export
            if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms()) {
                $this->restoreSearchParms();
            }

            // Call Recordset SearchValidated event
            $this->recordsetSearchValidated();

            // Set up sorting order
            $this->setupSortOrder();

            // Get basic search criteria
            if (!$this->hasInvalidFields()) {
                $srchBasic = $this->basicSearchWhere();
            }

            // Get search criteria for advanced search
            if (!$this->hasInvalidFields()) {
                $srchAdvanced = $this->advancedSearchWhere();
            }
        }

        // Restore display records
        if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
            $this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecords = 20; // Load default
            $this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
        }

        // Load search default if no existing search criteria
        if (!$this->checkSearchParms()) {
            // Load basic search from default
            $this->BasicSearch->loadDefault();
            if ($this->BasicSearch->Keyword != "") {
                $srchBasic = $this->basicSearchWhere();
            }

            // Load advanced search from default
            if ($this->loadAdvancedSearchDefault()) {
                $srchAdvanced = $this->advancedSearchWhere();
            }
        }

        // Restore search settings from Session
        if (!$this->hasInvalidFields()) {
            $this->loadAdvancedSearch();
        }

        // Build search criteria
        AddFilter($this->SearchWhere, $srchAdvanced);
        AddFilter($this->SearchWhere, $srchBasic);

        // Call Recordset_Searching event
        $this->recordsetSearching($this->SearchWhere);

        // Save search criteria
        if ($this->Command == "search" && !$this->RestoreSearch) {
            $this->setSearchWhere($this->SearchWhere); // Save to Session
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->Command != "json") {
            $this->SearchWhere = $this->getSearchWhere();
        }

        // Build filter
        $filter = "";
        if (!$Security->canList()) {
            $filter = "(0=1)"; // Filter all records
        }
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }
        if ($this->isGridAdd()) {
            $this->CurrentFilter = "0=1";
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->GridAddRowCount;
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) { // Display all records
                $this->DisplayRecords = $this->TotalRecords;
            }
            if (!($this->isExport() && $this->ExportAll)) { // Set up start record position
                $this->setupStartRecord();
            }
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

            // Set no record found message
            if (!$this->CurrentAction && $this->TotalRecords == 0) {
                if (!$Security->canList()) {
                    $this->setWarningMessage(DeniedMessage());
                }
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            }

            // Audit trail on search
            if ($this->AuditTrailOnSearch && $this->Command == "search" && !$this->RestoreSearch) {
                $searchParm = ServerVar("QUERY_STRING");
                $searchSql = $this->getSessionWhere();
                $this->writeAuditTrailOnSearch($searchParm, $searchSql);
            }
        }

        // Set up list action columns
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Allow) {
                if ($listaction->Select == ACTION_MULTIPLE) { // Show checkbox column if multiple action
                    $this->ListOptions["checkbox"]->Visible = true;
                } elseif ($listaction->Select == ACTION_SINGLE) { // Show list action column
                        $this->ListOptions["listactions"]->Visible = true; // Set visible if any list action is allowed
                }
            }
        }

        // Search options
        $this->setupSearchOptions();

        // Set up search panel class
        if ($this->SearchWhere != "") {
            AppendClass($this->SearchPanelClass, "show");
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

    // Get list of filters
    public function getFilterList()
    {
        global $UserProfile;

        // Initialize
        $filterList = "";
        $savedFilterList = "";
        $filterList = Concat($filterList, $this->id->AdvancedSearch->toJson(), ","); // Field id
        $filterList = Concat($filterList, $this->jabatan_id->AdvancedSearch->toJson(), ","); // Field jabatan_id
        $filterList = Concat($filterList, $this->pegawai->AdvancedSearch->toJson(), ","); // Field pegawai
        $filterList = Concat($filterList, $this->lembur->AdvancedSearch->toJson(), ","); // Field lembur
        $filterList = Concat($filterList, $this->value_lembur->AdvancedSearch->toJson(), ","); // Field value_lembur
        $filterList = Concat($filterList, $this->kehadiran->AdvancedSearch->toJson(), ","); // Field kehadiran
        $filterList = Concat($filterList, $this->gapok->AdvancedSearch->toJson(), ","); // Field gapok
        $filterList = Concat($filterList, $this->value_reward->AdvancedSearch->toJson(), ","); // Field value_reward
        $filterList = Concat($filterList, $this->value_inval->AdvancedSearch->toJson(), ","); // Field value_inval
        $filterList = Concat($filterList, $this->piket_count->AdvancedSearch->toJson(), ","); // Field piket_count
        $filterList = Concat($filterList, $this->value_piket->AdvancedSearch->toJson(), ","); // Field value_piket
        $filterList = Concat($filterList, $this->tugastambahan->AdvancedSearch->toJson(), ","); // Field tugastambahan
        $filterList = Concat($filterList, $this->tj_jabatan->AdvancedSearch->toJson(), ","); // Field tj_jabatan
        $filterList = Concat($filterList, $this->sub_total->AdvancedSearch->toJson(), ","); // Field sub_total
        $filterList = Concat($filterList, $this->potongan->AdvancedSearch->toJson(), ","); // Field potongan
        $filterList = Concat($filterList, $this->total->AdvancedSearch->toJson(), ","); // Field total
        $filterList = Concat($filterList, $this->month->AdvancedSearch->toJson(), ","); // Field month
        $filterList = Concat($filterList, $this->datetime->AdvancedSearch->toJson(), ","); // Field datetime
        if ($this->BasicSearch->Keyword != "") {
            $wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
            $filterList = Concat($filterList, $wrk, ",");
        }

        // Return filter list in JSON
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Process filter list
    protected function processFilterList()
    {
        global $UserProfile;
        if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
            $filters = Post("filters");
            $UserProfile->setSearchFilters(CurrentUserName(), "fgajisrch", $filters);
            WriteJson([["success" => true]]); // Success
            return true;
        } elseif (Post("cmd") == "resetfilter") {
            $this->restoreFilterList();
        }
        return false;
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd") !== "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter"), true);
        $this->Command = "search";

        // Field id
        $this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
        $this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
        $this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
        $this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
        $this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
        $this->id->AdvancedSearch->save();

        // Field jabatan_id
        $this->jabatan_id->AdvancedSearch->SearchValue = @$filter["x_jabatan_id"];
        $this->jabatan_id->AdvancedSearch->SearchOperator = @$filter["z_jabatan_id"];
        $this->jabatan_id->AdvancedSearch->SearchCondition = @$filter["v_jabatan_id"];
        $this->jabatan_id->AdvancedSearch->SearchValue2 = @$filter["y_jabatan_id"];
        $this->jabatan_id->AdvancedSearch->SearchOperator2 = @$filter["w_jabatan_id"];
        $this->jabatan_id->AdvancedSearch->save();

        // Field pegawai
        $this->pegawai->AdvancedSearch->SearchValue = @$filter["x_pegawai"];
        $this->pegawai->AdvancedSearch->SearchOperator = @$filter["z_pegawai"];
        $this->pegawai->AdvancedSearch->SearchCondition = @$filter["v_pegawai"];
        $this->pegawai->AdvancedSearch->SearchValue2 = @$filter["y_pegawai"];
        $this->pegawai->AdvancedSearch->SearchOperator2 = @$filter["w_pegawai"];
        $this->pegawai->AdvancedSearch->save();

        // Field lembur
        $this->lembur->AdvancedSearch->SearchValue = @$filter["x_lembur"];
        $this->lembur->AdvancedSearch->SearchOperator = @$filter["z_lembur"];
        $this->lembur->AdvancedSearch->SearchCondition = @$filter["v_lembur"];
        $this->lembur->AdvancedSearch->SearchValue2 = @$filter["y_lembur"];
        $this->lembur->AdvancedSearch->SearchOperator2 = @$filter["w_lembur"];
        $this->lembur->AdvancedSearch->save();

        // Field value_lembur
        $this->value_lembur->AdvancedSearch->SearchValue = @$filter["x_value_lembur"];
        $this->value_lembur->AdvancedSearch->SearchOperator = @$filter["z_value_lembur"];
        $this->value_lembur->AdvancedSearch->SearchCondition = @$filter["v_value_lembur"];
        $this->value_lembur->AdvancedSearch->SearchValue2 = @$filter["y_value_lembur"];
        $this->value_lembur->AdvancedSearch->SearchOperator2 = @$filter["w_value_lembur"];
        $this->value_lembur->AdvancedSearch->save();

        // Field kehadiran
        $this->kehadiran->AdvancedSearch->SearchValue = @$filter["x_kehadiran"];
        $this->kehadiran->AdvancedSearch->SearchOperator = @$filter["z_kehadiran"];
        $this->kehadiran->AdvancedSearch->SearchCondition = @$filter["v_kehadiran"];
        $this->kehadiran->AdvancedSearch->SearchValue2 = @$filter["y_kehadiran"];
        $this->kehadiran->AdvancedSearch->SearchOperator2 = @$filter["w_kehadiran"];
        $this->kehadiran->AdvancedSearch->save();

        // Field gapok
        $this->gapok->AdvancedSearch->SearchValue = @$filter["x_gapok"];
        $this->gapok->AdvancedSearch->SearchOperator = @$filter["z_gapok"];
        $this->gapok->AdvancedSearch->SearchCondition = @$filter["v_gapok"];
        $this->gapok->AdvancedSearch->SearchValue2 = @$filter["y_gapok"];
        $this->gapok->AdvancedSearch->SearchOperator2 = @$filter["w_gapok"];
        $this->gapok->AdvancedSearch->save();

        // Field value_reward
        $this->value_reward->AdvancedSearch->SearchValue = @$filter["x_value_reward"];
        $this->value_reward->AdvancedSearch->SearchOperator = @$filter["z_value_reward"];
        $this->value_reward->AdvancedSearch->SearchCondition = @$filter["v_value_reward"];
        $this->value_reward->AdvancedSearch->SearchValue2 = @$filter["y_value_reward"];
        $this->value_reward->AdvancedSearch->SearchOperator2 = @$filter["w_value_reward"];
        $this->value_reward->AdvancedSearch->save();

        // Field value_inval
        $this->value_inval->AdvancedSearch->SearchValue = @$filter["x_value_inval"];
        $this->value_inval->AdvancedSearch->SearchOperator = @$filter["z_value_inval"];
        $this->value_inval->AdvancedSearch->SearchCondition = @$filter["v_value_inval"];
        $this->value_inval->AdvancedSearch->SearchValue2 = @$filter["y_value_inval"];
        $this->value_inval->AdvancedSearch->SearchOperator2 = @$filter["w_value_inval"];
        $this->value_inval->AdvancedSearch->save();

        // Field piket_count
        $this->piket_count->AdvancedSearch->SearchValue = @$filter["x_piket_count"];
        $this->piket_count->AdvancedSearch->SearchOperator = @$filter["z_piket_count"];
        $this->piket_count->AdvancedSearch->SearchCondition = @$filter["v_piket_count"];
        $this->piket_count->AdvancedSearch->SearchValue2 = @$filter["y_piket_count"];
        $this->piket_count->AdvancedSearch->SearchOperator2 = @$filter["w_piket_count"];
        $this->piket_count->AdvancedSearch->save();

        // Field value_piket
        $this->value_piket->AdvancedSearch->SearchValue = @$filter["x_value_piket"];
        $this->value_piket->AdvancedSearch->SearchOperator = @$filter["z_value_piket"];
        $this->value_piket->AdvancedSearch->SearchCondition = @$filter["v_value_piket"];
        $this->value_piket->AdvancedSearch->SearchValue2 = @$filter["y_value_piket"];
        $this->value_piket->AdvancedSearch->SearchOperator2 = @$filter["w_value_piket"];
        $this->value_piket->AdvancedSearch->save();

        // Field tugastambahan
        $this->tugastambahan->AdvancedSearch->SearchValue = @$filter["x_tugastambahan"];
        $this->tugastambahan->AdvancedSearch->SearchOperator = @$filter["z_tugastambahan"];
        $this->tugastambahan->AdvancedSearch->SearchCondition = @$filter["v_tugastambahan"];
        $this->tugastambahan->AdvancedSearch->SearchValue2 = @$filter["y_tugastambahan"];
        $this->tugastambahan->AdvancedSearch->SearchOperator2 = @$filter["w_tugastambahan"];
        $this->tugastambahan->AdvancedSearch->save();

        // Field tj_jabatan
        $this->tj_jabatan->AdvancedSearch->SearchValue = @$filter["x_tj_jabatan"];
        $this->tj_jabatan->AdvancedSearch->SearchOperator = @$filter["z_tj_jabatan"];
        $this->tj_jabatan->AdvancedSearch->SearchCondition = @$filter["v_tj_jabatan"];
        $this->tj_jabatan->AdvancedSearch->SearchValue2 = @$filter["y_tj_jabatan"];
        $this->tj_jabatan->AdvancedSearch->SearchOperator2 = @$filter["w_tj_jabatan"];
        $this->tj_jabatan->AdvancedSearch->save();

        // Field sub_total
        $this->sub_total->AdvancedSearch->SearchValue = @$filter["x_sub_total"];
        $this->sub_total->AdvancedSearch->SearchOperator = @$filter["z_sub_total"];
        $this->sub_total->AdvancedSearch->SearchCondition = @$filter["v_sub_total"];
        $this->sub_total->AdvancedSearch->SearchValue2 = @$filter["y_sub_total"];
        $this->sub_total->AdvancedSearch->SearchOperator2 = @$filter["w_sub_total"];
        $this->sub_total->AdvancedSearch->save();

        // Field potongan
        $this->potongan->AdvancedSearch->SearchValue = @$filter["x_potongan"];
        $this->potongan->AdvancedSearch->SearchOperator = @$filter["z_potongan"];
        $this->potongan->AdvancedSearch->SearchCondition = @$filter["v_potongan"];
        $this->potongan->AdvancedSearch->SearchValue2 = @$filter["y_potongan"];
        $this->potongan->AdvancedSearch->SearchOperator2 = @$filter["w_potongan"];
        $this->potongan->AdvancedSearch->save();

        // Field total
        $this->total->AdvancedSearch->SearchValue = @$filter["x_total"];
        $this->total->AdvancedSearch->SearchOperator = @$filter["z_total"];
        $this->total->AdvancedSearch->SearchCondition = @$filter["v_total"];
        $this->total->AdvancedSearch->SearchValue2 = @$filter["y_total"];
        $this->total->AdvancedSearch->SearchOperator2 = @$filter["w_total"];
        $this->total->AdvancedSearch->save();

        // Field month
        $this->month->AdvancedSearch->SearchValue = @$filter["x_month"];
        $this->month->AdvancedSearch->SearchOperator = @$filter["z_month"];
        $this->month->AdvancedSearch->SearchCondition = @$filter["v_month"];
        $this->month->AdvancedSearch->SearchValue2 = @$filter["y_month"];
        $this->month->AdvancedSearch->SearchOperator2 = @$filter["w_month"];
        $this->month->AdvancedSearch->save();

        // Field datetime
        $this->datetime->AdvancedSearch->SearchValue = @$filter["x_datetime"];
        $this->datetime->AdvancedSearch->SearchOperator = @$filter["z_datetime"];
        $this->datetime->AdvancedSearch->SearchCondition = @$filter["v_datetime"];
        $this->datetime->AdvancedSearch->SearchValue2 = @$filter["y_datetime"];
        $this->datetime->AdvancedSearch->SearchOperator2 = @$filter["w_datetime"];
        $this->datetime->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Advanced search WHERE clause based on QueryString
    protected function advancedSearchWhere($default = false)
    {
        global $Security;
        $where = "";
        if (!$Security->canSearch()) {
            return "";
        }
        $this->buildSearchSql($where, $this->id, $default, false); // id
        $this->buildSearchSql($where, $this->jabatan_id, $default, false); // jabatan_id
        $this->buildSearchSql($where, $this->pegawai, $default, false); // pegawai
        $this->buildSearchSql($where, $this->lembur, $default, false); // lembur
        $this->buildSearchSql($where, $this->value_lembur, $default, false); // value_lembur
        $this->buildSearchSql($where, $this->kehadiran, $default, false); // kehadiran
        $this->buildSearchSql($where, $this->gapok, $default, false); // gapok
        $this->buildSearchSql($where, $this->value_reward, $default, false); // value_reward
        $this->buildSearchSql($where, $this->value_inval, $default, false); // value_inval
        $this->buildSearchSql($where, $this->piket_count, $default, false); // piket_count
        $this->buildSearchSql($where, $this->value_piket, $default, false); // value_piket
        $this->buildSearchSql($where, $this->tugastambahan, $default, false); // tugastambahan
        $this->buildSearchSql($where, $this->tj_jabatan, $default, false); // tj_jabatan
        $this->buildSearchSql($where, $this->sub_total, $default, false); // sub_total
        $this->buildSearchSql($where, $this->potongan, $default, false); // potongan
        $this->buildSearchSql($where, $this->total, $default, false); // total
        $this->buildSearchSql($where, $this->month, $default, false); // month
        $this->buildSearchSql($where, $this->datetime, $default, false); // datetime

        // Set up search parm
        if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
            $this->Command = "search";
        }
        if (!$default && $this->Command == "search") {
            $this->id->AdvancedSearch->save(); // id
            $this->jabatan_id->AdvancedSearch->save(); // jabatan_id
            $this->pegawai->AdvancedSearch->save(); // pegawai
            $this->lembur->AdvancedSearch->save(); // lembur
            $this->value_lembur->AdvancedSearch->save(); // value_lembur
            $this->kehadiran->AdvancedSearch->save(); // kehadiran
            $this->gapok->AdvancedSearch->save(); // gapok
            $this->value_reward->AdvancedSearch->save(); // value_reward
            $this->value_inval->AdvancedSearch->save(); // value_inval
            $this->piket_count->AdvancedSearch->save(); // piket_count
            $this->value_piket->AdvancedSearch->save(); // value_piket
            $this->tugastambahan->AdvancedSearch->save(); // tugastambahan
            $this->tj_jabatan->AdvancedSearch->save(); // tj_jabatan
            $this->sub_total->AdvancedSearch->save(); // sub_total
            $this->potongan->AdvancedSearch->save(); // potongan
            $this->total->AdvancedSearch->save(); // total
            $this->month->AdvancedSearch->save(); // month
            $this->datetime->AdvancedSearch->save(); // datetime
        }
        return $where;
    }

    // Build search SQL
    protected function buildSearchSql(&$where, &$fld, $default, $multiValue)
    {
        $fldParm = $fld->Param;
        $fldVal = $default ? $fld->AdvancedSearch->SearchValueDefault : $fld->AdvancedSearch->SearchValue;
        $fldOpr = $default ? $fld->AdvancedSearch->SearchOperatorDefault : $fld->AdvancedSearch->SearchOperator;
        $fldCond = $default ? $fld->AdvancedSearch->SearchConditionDefault : $fld->AdvancedSearch->SearchCondition;
        $fldVal2 = $default ? $fld->AdvancedSearch->SearchValue2Default : $fld->AdvancedSearch->SearchValue2;
        $fldOpr2 = $default ? $fld->AdvancedSearch->SearchOperator2Default : $fld->AdvancedSearch->SearchOperator2;
        $wrk = "";
        if (is_array($fldVal)) {
            $fldVal = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal);
        }
        if (is_array($fldVal2)) {
            $fldVal2 = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $fldVal2);
        }
        $fldOpr = strtoupper(trim($fldOpr ?? ""));
        if ($fldOpr == "") {
            $fldOpr = "=";
        }
        $fldOpr2 = strtoupper(trim($fldOpr2 ?? ""));
        if ($fldOpr2 == "") {
            $fldOpr2 = "=";
        }
        if (Config("SEARCH_MULTI_VALUE_OPTION") == 1 && !$fld->UseFilter || !IsMultiSearchOperator($fldOpr)) {
            $multiValue = false;
        }
        if ($multiValue) {
            $wrk = $fldVal != "" ? GetMultiSearchSql($fld, $fldOpr, $fldVal, $this->Dbid) : ""; // Field value 1
            $wrk2 = $fldVal2 != "" ? GetMultiSearchSql($fld, $fldOpr2, $fldVal2, $this->Dbid) : ""; // Field value 2
            AddFilter($wrk, $wrk2, $fldCond);
        } else {
            $fldVal = $this->convertSearchValue($fld, $fldVal);
            $fldVal2 = $this->convertSearchValue($fld, $fldVal2);
            $wrk = GetSearchSql($fld, $fldVal, $fldOpr, $fldCond, $fldVal2, $fldOpr2, $this->Dbid);
        }
        if ($this->SearchOption == "AUTO" && in_array($this->BasicSearch->getType(), ["AND", "OR"])) {
            $cond = $this->BasicSearch->getType();
        } else {
            $cond = SameText($this->SearchOption, "OR") ? "OR" : "AND";
        }
        AddFilter($where, $wrk, $cond);
    }

    // Convert search value
    protected function convertSearchValue(&$fld, $fldVal)
    {
        if ($fldVal == Config("NULL_VALUE") || $fldVal == Config("NOT_NULL_VALUE")) {
            return $fldVal;
        }
        $value = $fldVal;
        if ($fld->isBoolean()) {
            if ($fldVal != "") {
                $value = (SameText($fldVal, "1") || SameText($fldVal, "y") || SameText($fldVal, "t")) ? $fld->TrueValue : $fld->FalseValue;
            }
        } elseif ($fld->DataType == DATATYPE_DATE || $fld->DataType == DATATYPE_TIME) {
            if ($fldVal != "") {
                $value = UnFormatDateTime($fldVal, $fld->formatPattern());
            }
        }
        return $value;
    }

    // Return basic search WHERE clause based on search keyword and type
    protected function basicSearchWhere($default = false)
    {
        global $Security;
        $searchStr = "";
        if (!$Security->canSearch()) {
            return "";
        }

        // Fields to search
        $searchFlds = [];
        $searchFlds[] = &$this->jabatan_id;
        $searchFlds[] = &$this->pegawai;
        $searchFlds[] = &$this->month;
        $searchKeyword = $default ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
        $searchType = $default ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

        // Get search SQL
        if ($searchKeyword != "") {
            $ar = $this->BasicSearch->keywordList($default);
            $searchStr = GetQuickSearchFilter($searchFlds, $ar, $searchType, Config("BASIC_SEARCH_ANY_FIELDS"), $this->Dbid);
            if (!$default && in_array($this->Command, ["", "reset", "resetall"])) {
                $this->Command = "search";
            }
        }
        if (!$default && $this->Command == "search") {
            $this->BasicSearch->setKeyword($searchKeyword);
            $this->BasicSearch->setType($searchType);
        }
        return $searchStr;
    }

    // Check if search parm exists
    protected function checkSearchParms()
    {
        // Check basic search
        if ($this->BasicSearch->issetSession()) {
            return true;
        }
        if ($this->id->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->jabatan_id->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->pegawai->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->lembur->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->value_lembur->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->kehadiran->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->gapok->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->value_reward->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->value_inval->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->piket_count->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->value_piket->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->tugastambahan->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->tj_jabatan->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->sub_total->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->potongan->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->total->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->month->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->datetime->AdvancedSearch->issetSession()) {
            return true;
        }
        return false;
    }

    // Clear all search parameters
    protected function resetSearchParms()
    {
        // Clear search WHERE clause
        $this->SearchWhere = "";
        $this->setSearchWhere($this->SearchWhere);

        // Clear basic search parameters
        $this->resetBasicSearchParms();

        // Clear advanced search parameters
        $this->resetAdvancedSearchParms();
    }

    // Load advanced search default values
    protected function loadAdvancedSearchDefault()
    {
        return false;
    }

    // Clear all basic search parameters
    protected function resetBasicSearchParms()
    {
        $this->BasicSearch->unsetSession();
    }

    // Clear all advanced search parameters
    protected function resetAdvancedSearchParms()
    {
        $this->id->AdvancedSearch->unsetSession();
        $this->jabatan_id->AdvancedSearch->unsetSession();
        $this->pegawai->AdvancedSearch->unsetSession();
        $this->lembur->AdvancedSearch->unsetSession();
        $this->value_lembur->AdvancedSearch->unsetSession();
        $this->kehadiran->AdvancedSearch->unsetSession();
        $this->gapok->AdvancedSearch->unsetSession();
        $this->value_reward->AdvancedSearch->unsetSession();
        $this->value_inval->AdvancedSearch->unsetSession();
        $this->piket_count->AdvancedSearch->unsetSession();
        $this->value_piket->AdvancedSearch->unsetSession();
        $this->tugastambahan->AdvancedSearch->unsetSession();
        $this->tj_jabatan->AdvancedSearch->unsetSession();
        $this->sub_total->AdvancedSearch->unsetSession();
        $this->potongan->AdvancedSearch->unsetSession();
        $this->total->AdvancedSearch->unsetSession();
        $this->month->AdvancedSearch->unsetSession();
        $this->datetime->AdvancedSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();

        // Restore advanced search values
        $this->id->AdvancedSearch->load();
        $this->jabatan_id->AdvancedSearch->load();
        $this->pegawai->AdvancedSearch->load();
        $this->lembur->AdvancedSearch->load();
        $this->value_lembur->AdvancedSearch->load();
        $this->kehadiran->AdvancedSearch->load();
        $this->gapok->AdvancedSearch->load();
        $this->value_reward->AdvancedSearch->load();
        $this->value_inval->AdvancedSearch->load();
        $this->piket_count->AdvancedSearch->load();
        $this->value_piket->AdvancedSearch->load();
        $this->tugastambahan->AdvancedSearch->load();
        $this->tj_jabatan->AdvancedSearch->load();
        $this->sub_total->AdvancedSearch->load();
        $this->potongan->AdvancedSearch->load();
        $this->total->AdvancedSearch->load();
        $this->month->AdvancedSearch->load();
        $this->datetime->AdvancedSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Load default Sorting Order
        if ($this->Command != "json") {
            $defaultSort = $this->id->Expression . " DESC"; // Set up default sort
            if ($this->getSessionOrderBy() == "" && $defaultSort != "") {
                $this->setSessionOrderBy($defaultSort);
            }
        }

        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->jabatan_id); // jabatan_id
            $this->updateSort($this->pegawai); // pegawai
            $this->updateSort($this->lembur); // lembur
            $this->updateSort($this->value_lembur); // value_lembur
            $this->updateSort($this->kehadiran); // kehadiran
            $this->updateSort($this->gapok); // gapok
            $this->updateSort($this->value_reward); // value_reward
            $this->updateSort($this->value_inval); // value_inval
            $this->updateSort($this->piket_count); // piket_count
            $this->updateSort($this->value_piket); // value_piket
            $this->updateSort($this->tugastambahan); // tugastambahan
            $this->updateSort($this->tj_jabatan); // tj_jabatan
            $this->updateSort($this->sub_total); // sub_total
            $this->updateSort($this->potongan); // potongan
            $this->updateSort($this->total); // total
            $this->updateSort($this->month); // month
            $this->updateSort($this->datetime); // datetime
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
            // Reset search criteria
            if ($this->Command == "reset" || $this->Command == "resetall") {
                $this->resetSearchParms();
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->id->setSort("");
                $this->jabatan_id->setSort("");
                $this->pegawai->setSort("");
                $this->lembur->setSort("");
                $this->value_lembur->setSort("");
                $this->kehadiran->setSort("");
                $this->gapok->setSort("");
                $this->value_reward->setSort("");
                $this->value_inval->setSort("");
                $this->piket_count->setSort("");
                $this->value_piket->setSort("");
                $this->tugastambahan->setSort("");
                $this->tj_jabatan->setSort("");
                $this->sub_total->setSort("");
                $this->potongan->setSort("");
                $this->total->setSort("");
                $this->month->setSort("");
                $this->datetime->setSort("");
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

        // List actions
        $item = &$this->ListOptions->add("listactions");
        $item->CssClass = "text-nowrap";
        $item->OnLeft = true;
        $item->Visible = false;
        $item->ShowInButtonGroup = false;
        $item->ShowInDropDown = false;

        // "checkbox"
        $item = &$this->ListOptions->add("checkbox");
        $item->Visible = false;
        $item->OnLeft = true;
        $item->Header = "<div class=\"form-check\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"form-check-input\" data-ew-action=\"select-all-keys\"></div>";
        if ($item->OnLeft) {
            $item->moveTo(0);
        }
        $item->ShowInDropDown = false;
        $item->ShowInButtonGroup = false;

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
        $this->setupListOptionsExt();
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

        // "sequence"
        $opt = $this->ListOptions["sequence"];
        $opt->Body = FormatSequenceNumber($this->RecordCount);
        $pageUrl = $this->pageUrl(false);
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

        // Set up list action buttons
        $opt = $this->ListOptions["listactions"];
        if ($opt && !$this->isExport() && !$this->CurrentAction) {
            $body = "";
            $links = [];
            foreach ($this->ListActions->Items as $listaction) {
                $action = $listaction->Action;
                $allowed = $listaction->Allow;
                if ($listaction->Select == ACTION_SINGLE && $allowed) {
                    $caption = $listaction->Caption;
                    $icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
                    $link = "<li><button type=\"button\" class=\"dropdown-item ew-action ew-list-action\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fgajilist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button></li>";
                    if ($link != "") {
                        $links[] = $link;
                        if ($body == "") { // Setup first button
                            $body = "<button type=\"button\" class=\"btn btn-default ew-action ew-list-action\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fgajilist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button>";
                        }
                    }
                }
            }
            if (count($links) > 1) { // More than one buttons, use dropdown
                $body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-bs-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
                $content = "";
                foreach ($links as $link) {
                    $content .= "<li>" . $link . "</li>";
                }
                $body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">" . $content . "</ul>";
                $body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
            }
            if (count($links) > 0) {
                $opt->Body = $body;
            }
        }

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $opt->Body = "<div class=\"form-check\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"form-check-input ew-multi-select\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\" data-ew-action=\"select-key\"></div>";
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
        $options = &$this->OtherOptions;
        $option = $options["addedit"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("AddLink"));
        $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
        $item->Visible = $this->AddUrl != "" && $Security->canAdd();
        $option = $options["action"];

        // Show column list for column visibility
        if ($this->UseColumnVisibility) {
            $option = $this->OtherOptions["column"];
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = $this->UseColumnVisibility;
            $option->add("jabatan_id", $this->createColumnOption("jabatan_id"));
            $option->add("pegawai", $this->createColumnOption("pegawai"));
            $option->add("lembur", $this->createColumnOption("lembur"));
            $option->add("value_lembur", $this->createColumnOption("value_lembur"));
            $option->add("kehadiran", $this->createColumnOption("kehadiran"));
            $option->add("gapok", $this->createColumnOption("gapok"));
            $option->add("value_reward", $this->createColumnOption("value_reward"));
            $option->add("value_inval", $this->createColumnOption("value_inval"));
            $option->add("piket_count", $this->createColumnOption("piket_count"));
            $option->add("value_piket", $this->createColumnOption("value_piket"));
            $option->add("tugastambahan", $this->createColumnOption("tugastambahan"));
            $option->add("tj_jabatan", $this->createColumnOption("tj_jabatan"));
            $option->add("sub_total", $this->createColumnOption("sub_total"));
            $option->add("potongan", $this->createColumnOption("potongan"));
            $option->add("total", $this->createColumnOption("total"));
            $option->add("month", $this->createColumnOption("month"));
            $option->add("datetime", $this->createColumnOption("datetime"));
        }

        // Set up options default
        foreach ($options as $name => $option) {
            if ($name != "column") { // Always use dropdown for column
                $option->UseDropDownButton = false;
                $option->UseButtonGroup = true;
            }
            //$option->ButtonClass = ""; // Class for button group
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = false;
        }
        $options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
        $options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fgajisrch\" data-ew-action=\"none\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fgajisrch\" data-ew-action=\"none\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
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
        $option = $options["action"];
        // Set up list action buttons
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE) {
                $item = &$option->add("custom_" . $listaction->Action);
                $caption = $listaction->Caption;
                $icon = ($listaction->Icon != "") ? '<i class="' . HtmlEncode($listaction->Icon) . '" data-caption="' . HtmlEncode($caption) . '"></i>' . $caption : $caption;
                $item->Body = '<button type="button" class="btn btn-default ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" data-ew-action="submit" form="fgajilist"' . $listaction->toDataAttrs() . '>' . $icon . '</button>';
                $item->Visible = $listaction->Allow;
            }
        }

        // Hide grid edit and other options
        if ($this->TotalRecords <= 0) {
            $option = $options["addedit"];
            $item = $option["gridedit"];
            if ($item) {
                $item->Visible = false;
            }
            $option = $options["action"];
            $option->hideAllOptions();
        }
    }

    // Process list action
    protected function processListAction()
    {
        global $Language, $Security, $Response;
        $userlist = "";
        $user = "";
        $filter = $this->getFilterFromRecordKeys();
        $userAction = Post("useraction", "");
        if ($filter != "" && $userAction != "") {
            // Check permission first
            $actionCaption = $userAction;
            if (array_key_exists($userAction, $this->ListActions->Items)) {
                $actionCaption = $this->ListActions[$userAction]->Caption;
                if (!$this->ListActions[$userAction]->Allow) {
                    $errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
                    if (Post("ajax") == $userAction) { // Ajax
                        echo "<p class=\"text-danger\">" . $errmsg . "</p>";
                        return true;
                    } else {
                        $this->setFailureMessage($errmsg);
                        return false;
                    }
                }
            }
            $this->CurrentFilter = $filter;
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn);
            $this->UserAction = $userAction;
            $this->ActionValue = Post("actionvalue");

            // Call row action event
            if ($rs) {
                if ($this->UseTransaction) {
                    $conn->beginTransaction();
                }
                $this->SelectedCount = $rs->recordCount();
                $this->SelectedIndex = 0;
                while (!$rs->EOF) {
                    $this->SelectedIndex++;
                    $row = $rs->fields;
                    $processed = $this->rowCustomAction($userAction, $row);
                    if (!$processed) {
                        break;
                    }
                    $rs->moveNext();
                }
                if ($processed) {
                    if ($this->UseTransaction) { // Commit transaction
                        $conn->commit();
                    }
                    if ($this->getSuccessMessage() == "" && !ob_get_length() && !$Response->getBody()->getSize()) { // No output
                        $this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
                    }
                } else {
                    if ($this->UseTransaction) { // Rollback transaction
                        $conn->rollback();
                    }

                    // Set up error message
                    if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                        // Use the message, do nothing
                    } elseif ($this->CancelMessage != "") {
                        $this->setFailureMessage($this->CancelMessage);
                        $this->CancelMessage = "";
                    } else {
                        $this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
                    }
                }
            }
            if ($rs) {
                $rs->close();
            }
            if (Post("ajax") == $userAction) { // Ajax
                if ($this->getSuccessMessage() != "") {
                    echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
                    $this->clearSuccessMessage(); // Clear message
                }
                if ($this->getFailureMessage() != "") {
                    echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
                    $this->clearFailureMessage(); // Clear message
                }
                return true;
            }
        }
        return false; // Not ajax request
    }

    // Load basic search values
    protected function loadBasicSearchValues()
    {
        $this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), false);
        if ($this->BasicSearch->Keyword != "" && $this->Command == "") {
            $this->Command = "search";
        }
        $this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), false);
    }

    // Load search values for validation
    protected function loadSearchValues()
    {
        // Load search values
        $hasValue = false;

        // id
        if ($this->id->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->id->AdvancedSearch->SearchValue != "" || $this->id->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // jabatan_id
        if ($this->jabatan_id->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->jabatan_id->AdvancedSearch->SearchValue != "" || $this->jabatan_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // pegawai
        if ($this->pegawai->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->pegawai->AdvancedSearch->SearchValue != "" || $this->pegawai->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // lembur
        if ($this->lembur->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->lembur->AdvancedSearch->SearchValue != "" || $this->lembur->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // value_lembur
        if ($this->value_lembur->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->value_lembur->AdvancedSearch->SearchValue != "" || $this->value_lembur->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // kehadiran
        if ($this->kehadiran->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->kehadiran->AdvancedSearch->SearchValue != "" || $this->kehadiran->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // gapok
        if ($this->gapok->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->gapok->AdvancedSearch->SearchValue != "" || $this->gapok->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // value_reward
        if ($this->value_reward->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->value_reward->AdvancedSearch->SearchValue != "" || $this->value_reward->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // value_inval
        if ($this->value_inval->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->value_inval->AdvancedSearch->SearchValue != "" || $this->value_inval->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // piket_count
        if ($this->piket_count->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->piket_count->AdvancedSearch->SearchValue != "" || $this->piket_count->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // value_piket
        if ($this->value_piket->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->value_piket->AdvancedSearch->SearchValue != "" || $this->value_piket->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // tugastambahan
        if ($this->tugastambahan->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->tugastambahan->AdvancedSearch->SearchValue != "" || $this->tugastambahan->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // tj_jabatan
        if ($this->tj_jabatan->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->tj_jabatan->AdvancedSearch->SearchValue != "" || $this->tj_jabatan->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // sub_total
        if ($this->sub_total->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->sub_total->AdvancedSearch->SearchValue != "" || $this->sub_total->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // potongan
        if ($this->potongan->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->potongan->AdvancedSearch->SearchValue != "" || $this->potongan->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // total
        if ($this->total->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->total->AdvancedSearch->SearchValue != "" || $this->total->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // month
        if ($this->month->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->month->AdvancedSearch->SearchValue != "" || $this->month->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // datetime
        if ($this->datetime->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->datetime->AdvancedSearch->SearchValue != "" || $this->datetime->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }
        return $hasValue;
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
        $this->ViewUrl = $this->getViewUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->InlineEditUrl = $this->getInlineEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->InlineCopyUrl = $this->getInlineCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id

        // jabatan_id

        // pegawai

        // lembur

        // value_lembur

        // kehadiran

        // gapok

        // value_reward

        // value_inval

        // piket_count

        // value_piket

        // tugastambahan

        // tj_jabatan

        // sub_total

        // potongan

        // total

        // month

        // datetime

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
            $this->jabatan_id->TooltipValue = "";

            // pegawai
            $this->pegawai->LinkCustomAttributes = "";
            $this->pegawai->HrefValue = "";
            $this->pegawai->TooltipValue = "";

            // lembur
            $this->lembur->LinkCustomAttributes = "";
            $this->lembur->HrefValue = "";
            $this->lembur->TooltipValue = "";

            // value_lembur
            $this->value_lembur->LinkCustomAttributes = "";
            $this->value_lembur->HrefValue = "";
            $this->value_lembur->TooltipValue = "";

            // kehadiran
            $this->kehadiran->LinkCustomAttributes = "";
            $this->kehadiran->HrefValue = "";
            $this->kehadiran->TooltipValue = "";

            // gapok
            $this->gapok->LinkCustomAttributes = "";
            $this->gapok->HrefValue = "";
            $this->gapok->TooltipValue = "";

            // value_reward
            $this->value_reward->LinkCustomAttributes = "";
            $this->value_reward->HrefValue = "";
            $this->value_reward->TooltipValue = "";

            // value_inval
            $this->value_inval->LinkCustomAttributes = "";
            $this->value_inval->HrefValue = "";
            $this->value_inval->TooltipValue = "";

            // piket_count
            $this->piket_count->LinkCustomAttributes = "";
            $this->piket_count->HrefValue = "";
            $this->piket_count->TooltipValue = "";

            // value_piket
            $this->value_piket->LinkCustomAttributes = "";
            $this->value_piket->HrefValue = "";
            $this->value_piket->TooltipValue = "";

            // tugastambahan
            $this->tugastambahan->LinkCustomAttributes = "";
            $this->tugastambahan->HrefValue = "";
            $this->tugastambahan->TooltipValue = "";

            // tj_jabatan
            $this->tj_jabatan->LinkCustomAttributes = "";
            $this->tj_jabatan->HrefValue = "";
            $this->tj_jabatan->TooltipValue = "";

            // sub_total
            $this->sub_total->LinkCustomAttributes = "";
            $this->sub_total->HrefValue = "";
            $this->sub_total->TooltipValue = "";

            // potongan
            $this->potongan->LinkCustomAttributes = "";
            $this->potongan->HrefValue = "";
            $this->potongan->TooltipValue = "";

            // total
            $this->total->LinkCustomAttributes = "";
            $this->total->HrefValue = "";
            $this->total->TooltipValue = "";

            // month
            $this->month->LinkCustomAttributes = "";
            $this->month->HrefValue = "";
            $this->month->TooltipValue = "";

            // datetime
            $this->datetime->LinkCustomAttributes = "";
            $this->datetime->HrefValue = "";
            $this->datetime->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // jabatan_id
            $this->jabatan_id->setupEditAttributes();
            $this->jabatan_id->EditCustomAttributes = "";
            $this->jabatan_id->EditValue = HtmlEncode($this->jabatan_id->AdvancedSearch->SearchValue);
            $this->jabatan_id->PlaceHolder = RemoveHtml($this->jabatan_id->caption());

            // pegawai
            $this->pegawai->setupEditAttributes();
            $this->pegawai->EditCustomAttributes = "";
            if (!$this->pegawai->Raw) {
                $this->pegawai->AdvancedSearch->SearchValue = HtmlDecode($this->pegawai->AdvancedSearch->SearchValue);
            }
            $this->pegawai->EditValue = HtmlEncode($this->pegawai->AdvancedSearch->SearchValue);
            $this->pegawai->PlaceHolder = RemoveHtml($this->pegawai->caption());

            // lembur
            $this->lembur->setupEditAttributes();
            $this->lembur->EditCustomAttributes = "";
            $this->lembur->EditValue = HtmlEncode($this->lembur->AdvancedSearch->SearchValue);
            $this->lembur->PlaceHolder = RemoveHtml($this->lembur->caption());

            // value_lembur
            $this->value_lembur->setupEditAttributes();
            $this->value_lembur->EditCustomAttributes = "";
            $this->value_lembur->EditValue = HtmlEncode($this->value_lembur->AdvancedSearch->SearchValue);
            $this->value_lembur->PlaceHolder = RemoveHtml($this->value_lembur->caption());

            // kehadiran
            $this->kehadiran->setupEditAttributes();
            $this->kehadiran->EditCustomAttributes = "";
            $this->kehadiran->EditValue = HtmlEncode($this->kehadiran->AdvancedSearch->SearchValue);
            $this->kehadiran->PlaceHolder = RemoveHtml($this->kehadiran->caption());

            // gapok
            $this->gapok->setupEditAttributes();
            $this->gapok->EditCustomAttributes = "";
            $this->gapok->EditValue = HtmlEncode($this->gapok->AdvancedSearch->SearchValue);
            $this->gapok->PlaceHolder = RemoveHtml($this->gapok->caption());

            // value_reward
            $this->value_reward->setupEditAttributes();
            $this->value_reward->EditCustomAttributes = "";
            $this->value_reward->EditValue = HtmlEncode($this->value_reward->AdvancedSearch->SearchValue);
            $this->value_reward->PlaceHolder = RemoveHtml($this->value_reward->caption());

            // value_inval
            $this->value_inval->setupEditAttributes();
            $this->value_inval->EditCustomAttributes = "";
            $this->value_inval->EditValue = HtmlEncode($this->value_inval->AdvancedSearch->SearchValue);
            $this->value_inval->PlaceHolder = RemoveHtml($this->value_inval->caption());

            // piket_count
            $this->piket_count->setupEditAttributes();
            $this->piket_count->EditCustomAttributes = "";
            $this->piket_count->EditValue = HtmlEncode($this->piket_count->AdvancedSearch->SearchValue);
            $this->piket_count->PlaceHolder = RemoveHtml($this->piket_count->caption());

            // value_piket
            $this->value_piket->setupEditAttributes();
            $this->value_piket->EditCustomAttributes = "";
            $this->value_piket->EditValue = HtmlEncode($this->value_piket->AdvancedSearch->SearchValue);
            $this->value_piket->PlaceHolder = RemoveHtml($this->value_piket->caption());

            // tugastambahan
            $this->tugastambahan->setupEditAttributes();
            $this->tugastambahan->EditCustomAttributes = "";
            $this->tugastambahan->EditValue = HtmlEncode($this->tugastambahan->AdvancedSearch->SearchValue);
            $this->tugastambahan->PlaceHolder = RemoveHtml($this->tugastambahan->caption());

            // tj_jabatan
            $this->tj_jabatan->setupEditAttributes();
            $this->tj_jabatan->EditCustomAttributes = "";
            $this->tj_jabatan->EditValue = HtmlEncode($this->tj_jabatan->AdvancedSearch->SearchValue);
            $this->tj_jabatan->PlaceHolder = RemoveHtml($this->tj_jabatan->caption());

            // sub_total
            $this->sub_total->setupEditAttributes();
            $this->sub_total->EditCustomAttributes = "";
            $this->sub_total->EditValue = HtmlEncode($this->sub_total->AdvancedSearch->SearchValue);
            $this->sub_total->PlaceHolder = RemoveHtml($this->sub_total->caption());

            // potongan
            $this->potongan->setupEditAttributes();
            $this->potongan->EditCustomAttributes = "";
            $this->potongan->EditValue = HtmlEncode($this->potongan->AdvancedSearch->SearchValue);
            $this->potongan->PlaceHolder = RemoveHtml($this->potongan->caption());

            // total
            $this->total->setupEditAttributes();
            $this->total->EditCustomAttributes = "";
            $this->total->EditValue = HtmlEncode($this->total->AdvancedSearch->SearchValue);
            $this->total->PlaceHolder = RemoveHtml($this->total->caption());

            // month
            $this->month->setupEditAttributes();
            $this->month->EditCustomAttributes = "";
            if (!$this->month->Raw) {
                $this->month->AdvancedSearch->SearchValue = HtmlDecode($this->month->AdvancedSearch->SearchValue);
            }
            $this->month->EditValue = HtmlEncode($this->month->AdvancedSearch->SearchValue);
            $this->month->PlaceHolder = RemoveHtml($this->month->caption());

            // datetime
            $this->datetime->setupEditAttributes();
            $this->datetime->EditCustomAttributes = "";
            $this->datetime->EditValue = HtmlEncode(FormatDateTime(UnFormatDateTime($this->datetime->AdvancedSearch->SearchValue, $this->datetime->formatPattern()), $this->datetime->formatPattern()));
            $this->datetime->PlaceHolder = RemoveHtml($this->datetime->caption());
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate search
    protected function validateSearch()
    {
        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }

        // Return validate result
        $validateSearch = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateSearch = $validateSearch && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateSearch;
    }

    /**
     * Import file
     *
     * @param string $filetoken File token to locate the uploaded import file
     * @return bool
     */
    public function import($filetoken)
    {
        global $Security, $Language;
        if (!$Security->canImport()) {
            return false; // Import not allowed
        }

        // Check if valid token
        if (EmptyValue($filetoken)) {
            return false;
        }

        // Get uploaded files by token
        $files = GetUploadedFileNames($filetoken);
        $exts = explode(",", Config("IMPORT_FILE_ALLOWED_EXTENSIONS"));
        $totCnt = 0;
        $totSuccessCnt = 0;
        $totFailCnt = 0;
        $result = [Config("API_FILE_TOKEN_NAME") => $filetoken, "files" => [], "success" => false];

        // Import records
        foreach ($files as $file) {
            $res = [Config("API_FILE_TOKEN_NAME") => $filetoken, "file" => basename($file)];
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

            // Ignore log file
            if ($ext == "txt") {
                continue;
            }
            if (!in_array($ext, $exts)) {
                $res = array_merge($res, ["error" => str_replace("%e", $ext, $Language->phrase("ImportMessageInvalidFileExtension"))]);
                WriteJson($res);
                return false;
            }

            // Set up options for Page Importing event

            // Get optional data from $_POST first
            $ar = array_keys($_POST);
            $options = [];
            foreach ($ar as $key) {
                if (!in_array($key, ["action", "filetoken"])) {
                    $options[$key] = $_POST[$key];
                }
            }

            // Merge default options
            $options = array_merge(["maxExecutionTime" => $this->ImportMaxExecutionTime, "file" => $file, "activeSheet" => 0, "headerRowNumber" => 0, "headers" => [], "offset" => 0, "limit" => 0], $options);
            if ($ext == "csv") {
                $options = array_merge(["inputEncoding" => $this->ImportCsvEncoding, "delimiter" => $this->ImportCsvDelimiter, "enclosure" => $this->ImportCsvQuoteCharacter], $options);
            }
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader(ucfirst($ext));

            // Call Page Importing server event
            if (!$this->pageImporting($reader, $options)) {
                WriteJson($res);
                return false;
            }

            // Set max execution time
            if ($options["maxExecutionTime"] > 0) {
                ini_set("max_execution_time", $options["maxExecutionTime"]);
            }
            try {
                if ($ext == "csv") {
                    if ($options["inputEncoding"] != '') {
                        $reader->setInputEncoding($options["inputEncoding"]);
                    }
                    if ($options["delimiter"] != '') {
                        $reader->setDelimiter($options["delimiter"]);
                    }
                    if ($options["enclosure"] != '') {
                        $reader->setEnclosure($options["enclosure"]);
                    }
                }
                $spreadsheet = @$reader->load($file);
            } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
                $res = array_merge($res, ["error" => $e->getMessage()]);
                WriteJson($res);
                return false;
            }

            // Get active worksheet
            $spreadsheet->setActiveSheetIndex($options["activeSheet"]);
            $worksheet = $spreadsheet->getActiveSheet();

            // Get row and column indexes
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

            // Get column headers
            $headers = $options["headers"];
            $headerRow = 0;
            if (count($headers) == 0) { // Undetermined, load from header row
                $headerRow = $options["headerRowNumber"] + 1;
                $headers = $this->getImportHeaders($worksheet, $headerRow, $highestColumn);
            }
            if (count($headers) == 0) { // Unable to load header
                $res["error"] = $Language->phrase("ImportMessageNoHeaderRow");
                WriteJson($res);
                return false;
            }
            $checkValue = true; // Clear blank header values at end
            $headers = array_reverse(array_reduce(array_reverse($headers), function ($res, $name) use ($checkValue) {
                if (!EmptyValue($name) || !$checkValue) {
                    $res[] = $name;
                    $checkValue = false; // Skip further checking
                }
                return $res;
            }, []));
            foreach ($headers as $name) {
                if (!array_key_exists($name, $this->Fields)) { // Unidentified field, not header row
                    $res["error"] = str_replace('%f', $name, $Language->phrase("ImportMessageInvalidFieldName"));
                    WriteJson($res);
                    return false;
                }
            }
            $startRow = $headerRow + 1;
            $endRow = $highestRow;
            if ($options["offset"] > 0) {
                $startRow += $options["offset"];
            }
            if ($options["limit"] > 0) {
                $endRow = $startRow + $options["limit"] - 1;
                if ($endRow > $highestRow) {
                    $endRow = $highestRow;
                }
            }
            if ($endRow >= $startRow) {
                $records = $this->getImportRecords($worksheet, $startRow, $endRow, $highestColumn);
            } else {
                $records = [];
            }
            $recordCnt = count($records);
            $cnt = 0;
            $successCnt = 0;
            $failCnt = 0;
            $failList = [];
            $relLogFile = IncludeTrailingDelimiter(UploadPath(false) . Config("UPLOAD_TEMP_FOLDER_PREFIX") . $filetoken, false) . $filetoken . ".txt";
            $res = array_merge($res, ["totalCount" => $recordCnt, "count" => $cnt, "successCount" => $successCnt, "failCount" => 0]);

            // Begin transaction
            if ($this->ImportUseTransaction) {
                $conn = $this->getConnection();
                $conn->beginTransaction();
            }

            // Process records
            foreach ($records as $values) {
                $importSuccess = false;
                try {
                    if (count($values) > count($headers)) { // Make sure headers / values count matched
                        array_splice($values, count($headers));
                    }
                    $row = array_combine($headers, $values);
                    $cnt++;
                    $res["count"] = $cnt;
                    if ($this->importRow($row, $cnt)) {
                        $successCnt++;
                        $importSuccess = true;
                    } else {
                        $failCnt++;
                        $failList["row" . $cnt] = $this->getFailureMessage();
                        $this->clearFailureMessage(); // Clear error message
                    }
                } catch (\Throwable $e) {
                    $failCnt++;
                    if (@$failList["row" . $cnt] == "") {
                        $failList["row" . $cnt] = $e->getMessage();
                    }
                }

                // Reset count if import fail + use transaction
                if (!$importSuccess && $this->ImportUseTransaction) {
                    $successCnt = 0;
                    $failCnt = $cnt;
                }

                // Save progress to cache
                $res["successCount"] = $successCnt;
                $res["failCount"] = $failCnt;
                SetCache($filetoken, $res);

                // No need to process further if import fail + use transaction
                if (!$importSuccess && $this->ImportUseTransaction) {
                    break;
                }
            }
            $res["failList"] = $failList;

            // Commit/Rollback transaction
            if ($this->ImportUseTransaction) {
                $conn = $this->getConnection();
                if ($failCnt > 0) { // Rollback
                    if ($this->UseTransaction) { // Rollback transaction
                        $conn->rollback();
                    }
                } else { // Commit
                    if ($this->UseTransaction) { // Commit transaction
                        $conn->commit();
                    }
                }
            }
            $totCnt += $cnt;
            $totSuccessCnt += $successCnt;
            $totFailCnt += $failCnt;

            // Call Page Imported server event
            $this->pageImported($reader, $res);
            if ($totCnt > 0 && $totFailCnt == 0) { // Clean up if all records imported
                $res["success"] = true;
                $result["success"] = true;
            } else {
                $res["log"] = $relLogFile;
                $result["success"] = false;
            }
            $result["files"][] = $res;
        }
        if ($result["success"]) {
            CleanUploadTempPaths($filetoken);
        }
        WriteJson($result);
        return $result["success"];
    }

    /**
     * Get import header
     *
     * @param object $ws PhpSpreadsheet worksheet
     * @param int $rowIdx Row index for header row (1-based)
     * @param string $endColName End column Name (e.g. "F")
     * @return array
     */
    protected function getImportHeaders($ws, $rowIdx, $endColName)
    {
        $ar = $ws->rangeToArray("A" . $rowIdx . ":" . $endColName . $rowIdx);
        return $ar[0];
    }

    /**
     * Get import records
     *
     * @param object $ws PhpSpreadsheet worksheet
     * @param int $startRowIdx Start row index
     * @param int $endRowIdx End row index
     * @param string $endColName End column Name (e.g. "F")
     * @return array
     */
    protected function getImportRecords($ws, $startRowIdx, $endRowIdx, $endColName)
    {
        $ar = $ws->rangeToArray("A" . $startRowIdx . ":" . $endColName . $endRowIdx);
        return $ar;
    }

    /**
     * Import a row
     *
     * @param array $row
     * @param int $cnt
     * @return bool
     */
    protected function importRow($row, $cnt)
    {
        global $Language;

        // Call Row Import server event
        if (!$this->rowImport($row, $cnt)) {
            return false;
        }

        // Check field values
        foreach ($row as $name => $value) {
            $fld = $this->Fields[$name];
            if (!$this->checkValue($fld, $value)) {
                $this->setFailureMessage(str_replace(["%f", "%v"], [$fld->Name, $value], $Language->phrase("ImportMessageInvalidFieldValue")));
                return false;
            }
        }

        // Insert/Update to database
        $res = false;
        if (!$this->ImportInsertOnly && $oldrow = $this->load($row)) {
            if ($this->rowUpdating($oldrow, $row)) {
                if ($res = $this->update($row, "", $oldrow)) {
                    $this->rowUpdated($oldrow, $row);
                }
            }
        } else {
            if ($this->rowInserting(null, $row)) {
                if ($res = $this->insert($row)) {
                    $this->rowInserted(null, $row);
                }
            }
        }
        return $res;
    }

    /**
     * Check field value
     *
     * @param object $fld Field object
     * @param object $value
     * @return bool
     */
    protected function checkValue($fld, $value)
    {
        if ($fld->DataType == DATATYPE_NUMBER && !is_numeric($value)) {
            return false;
        } elseif ($fld->DataType == DATATYPE_DATE && !CheckDate($value, $fld->formatPattern())) {
            return false;
        }
        return true;
    }

    // Load row
    protected function load($row)
    {
        $filter = $this->getRecordFilter($row);
        if (!$filter) {
            return null;
        }
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        return $conn->fetchAssociative($sql);
    }

    // Load advanced search
    public function loadAdvancedSearch()
    {
        $this->id->AdvancedSearch->load();
        $this->jabatan_id->AdvancedSearch->load();
        $this->pegawai->AdvancedSearch->load();
        $this->lembur->AdvancedSearch->load();
        $this->value_lembur->AdvancedSearch->load();
        $this->kehadiran->AdvancedSearch->load();
        $this->gapok->AdvancedSearch->load();
        $this->value_reward->AdvancedSearch->load();
        $this->value_inval->AdvancedSearch->load();
        $this->piket_count->AdvancedSearch->load();
        $this->value_piket->AdvancedSearch->load();
        $this->tugastambahan->AdvancedSearch->load();
        $this->tj_jabatan->AdvancedSearch->load();
        $this->sub_total->AdvancedSearch->load();
        $this->potongan->AdvancedSearch->load();
        $this->total->AdvancedSearch->load();
        $this->month->AdvancedSearch->load();
        $this->datetime->AdvancedSearch->load();
    }

    // Set up search options
    protected function setupSearchOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl(false);
        $this->SearchOptions = new ListOptions(["TagClassName" => "ew-search-option"]);

        // Search button
        $item = &$this->SearchOptions->add("searchtoggle");
        $searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-ew-action=\"search-toggle\" data-form=\"fgajisrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Button group for search
        $this->SearchOptions->UseDropDownButton = false;
        $this->SearchOptions->UseButtonGroup = true;
        $this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

        // Add group option item
        $item = &$this->SearchOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;

        // Hide search options
        if ($this->isExport() || $this->CurrentAction) {
            $this->SearchOptions->hideAllOptions();
        }
        if (!$Security->canSearch()) {
            $this->SearchOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
        }
    }

    // Check if any search fields
    public function hasSearchFields()
    {
        return true;
    }

    // Render search options
    protected function renderSearchOptions()
    {
        if (!$this->hasSearchFields() && $this->SearchOptions["searchtoggle"]) {
            $this->SearchOptions["searchtoggle"]->Visible = false;
        }
    }

    // Set up import options
    protected function setupImportOptions()
    {
        global $Security, $Language;

        // Import
        $item = &$this->ImportOptions->add("import");
        $item->Body = "<a class=\"ew-import-link ew-import\" role=\"button\" title=\"" . $Language->phrase("ImportText") . "\" data-caption=\"" . $Language->phrase("ImportText") . "\" data-ew-action=\"import\" data-hdr=\"" . $Language->phrase("ImportText") . "\">" . $Language->phrase("Import") . "</a>";
        $item->Visible = $Security->canImport();
        $this->ImportOptions->UseButtonGroup = true;
        $this->ImportOptions->UseDropDownButton = false;
        $this->ImportOptions->DropDownButtonPhrase = $Language->phrase("ButtonImport");

        // Add group option item
        $item = &$this->ImportOptions->addGroupOption();
        $item->Body = "";
        $item->Visible = false;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
        $Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, true);
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
            $pageNo = Get(Config("TABLE_PAGE_NO"));
            if ($pageNo !== null) { // Check for "pageno" parameter first
                $pageNo = ParseInteger($pageNo);
                if (is_numeric($pageNo)) {
                    $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                    if ($this->StartRecord <= 0) {
                        $this->StartRecord = 1;
                    } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                        $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                    }
                    $this->setStartRecordNumber($this->StartRecord);
                }
            } elseif ($startRec !== null && is_numeric($startRec)) { // Check for "start" parameter
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

    // Row Custom Action event
    public function rowCustomAction($action, $row)
    {
        // Return false to abort
        return true;
    }

    // Page Exporting event
    // $this->ExportDoc = export document object
    public function pageExporting()
    {
        //$this->ExportDoc->Text = "my header"; // Export header
        //return false; // Return false to skip default export and use Row_Export event
        return true; // Return true to use default export and skip Row_Export event
    }

    // Row Export event
    // $this->ExportDoc = export document object
    public function rowExport($rs)
    {
        //$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
    }

    // Page Exported event
    // $this->ExportDoc = export document object
    public function pageExported()
    {
        //$this->ExportDoc->Text .= "my footer"; // Export footer
        //Log($this->ExportDoc->Text);
    }

    // Page Importing event
    public function pageImporting($reader, &$options)
    {
        //var_dump($reader); // Import data reader
        //var_dump($options); // Show all options for importing
        //return false; // Return false to skip import
        return true;
    }

    // Row Import event
    public function rowImport(&$row, $cnt)
    {
        //Log($cnt); // Import record count
        //var_dump($row); // Import row
        //return false; // Return false to skip import
        return true;
    }

    // Page Imported event
    public function pageImported($reader, $results)
    {
        //var_dump($reader); // Import data reader
        //var_dump($results); // Import results
    }
}
