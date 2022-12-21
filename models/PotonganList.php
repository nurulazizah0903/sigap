<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PotonganList extends Potongan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'potongan';

    // Page object name
    public $PageObjName = "PotonganList";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fpotonganlist";
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

        // Table object (potongan)
        if (!isset($GLOBALS["potongan"]) || get_class($GLOBALS["potongan"]) == PROJECT_NAMESPACE . "potongan") {
            $GLOBALS["potongan"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl(false);

        // Initialize URLs
        $this->AddUrl = "PotonganAdd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "PotonganDelete";
        $this->MultiUpdateUrl = "PotonganUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'potongan');
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
                $tbl = Container("potongan");
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
            $this->u_by->Visible = false;
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
        $this->month->setVisibility();
        $this->nama->setVisibility();
        $this->jenjang_id->setVisibility();
        $this->jabatan_id->setVisibility();
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

        // Setup other options
        $this->setupOtherOptions();

        // Set up custom action (compatible with old version)
        foreach ($this->CustomActions as $name => $action) {
            $this->ListActions->add($name, $action);
        }

        // Set up lookup cache
        $this->setupLookupOptions($this->nama);
        $this->setupLookupOptions($this->jenjang_id);
        $this->setupLookupOptions($this->jabatan_id);
        $this->setupLookupOptions($this->u_by);

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
        $filterList = Concat($filterList, $this->month->AdvancedSearch->toJson(), ","); // Field month
        $filterList = Concat($filterList, $this->nama->AdvancedSearch->toJson(), ","); // Field nama
        $filterList = Concat($filterList, $this->jenjang_id->AdvancedSearch->toJson(), ","); // Field jenjang_id
        $filterList = Concat($filterList, $this->jabatan_id->AdvancedSearch->toJson(), ","); // Field jabatan_id
        $filterList = Concat($filterList, $this->terlambat->AdvancedSearch->toJson(), ","); // Field terlambat
        $filterList = Concat($filterList, $this->value_terlambat->AdvancedSearch->toJson(), ","); // Field value_terlambat
        $filterList = Concat($filterList, $this->izin->AdvancedSearch->toJson(), ","); // Field izin
        $filterList = Concat($filterList, $this->value_izin->AdvancedSearch->toJson(), ","); // Field value_izin
        $filterList = Concat($filterList, $this->izinperjam->AdvancedSearch->toJson(), ","); // Field izinperjam
        $filterList = Concat($filterList, $this->izinperjamvalue->AdvancedSearch->toJson(), ","); // Field izinperjamvalue
        $filterList = Concat($filterList, $this->sakit->AdvancedSearch->toJson(), ","); // Field sakit
        $filterList = Concat($filterList, $this->value_sakit->AdvancedSearch->toJson(), ","); // Field value_sakit
        $filterList = Concat($filterList, $this->sakitperjam->AdvancedSearch->toJson(), ","); // Field sakitperjam
        $filterList = Concat($filterList, $this->sakitperjamvalue->AdvancedSearch->toJson(), ","); // Field sakitperjamvalue
        $filterList = Concat($filterList, $this->pulcep->AdvancedSearch->toJson(), ","); // Field pulcep
        $filterList = Concat($filterList, $this->value_pulcep->AdvancedSearch->toJson(), ","); // Field value_pulcep
        $filterList = Concat($filterList, $this->tidakhadir->AdvancedSearch->toJson(), ","); // Field tidakhadir
        $filterList = Concat($filterList, $this->value_tidakhadir->AdvancedSearch->toJson(), ","); // Field value_tidakhadir
        $filterList = Concat($filterList, $this->tidakhadirjam->AdvancedSearch->toJson(), ","); // Field tidakhadirjam
        $filterList = Concat($filterList, $this->tidakhadirjamvalue->AdvancedSearch->toJson(), ","); // Field tidakhadirjamvalue
        $filterList = Concat($filterList, $this->total->AdvancedSearch->toJson(), ","); // Field total
        $filterList = Concat($filterList, $this->u_by->AdvancedSearch->toJson(), ","); // Field u_by
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
            $UserProfile->setSearchFilters(CurrentUserName(), "fpotongansrch", $filters);
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

        // Field month
        $this->month->AdvancedSearch->SearchValue = @$filter["x_month"];
        $this->month->AdvancedSearch->SearchOperator = @$filter["z_month"];
        $this->month->AdvancedSearch->SearchCondition = @$filter["v_month"];
        $this->month->AdvancedSearch->SearchValue2 = @$filter["y_month"];
        $this->month->AdvancedSearch->SearchOperator2 = @$filter["w_month"];
        $this->month->AdvancedSearch->save();

        // Field nama
        $this->nama->AdvancedSearch->SearchValue = @$filter["x_nama"];
        $this->nama->AdvancedSearch->SearchOperator = @$filter["z_nama"];
        $this->nama->AdvancedSearch->SearchCondition = @$filter["v_nama"];
        $this->nama->AdvancedSearch->SearchValue2 = @$filter["y_nama"];
        $this->nama->AdvancedSearch->SearchOperator2 = @$filter["w_nama"];
        $this->nama->AdvancedSearch->save();

        // Field jenjang_id
        $this->jenjang_id->AdvancedSearch->SearchValue = @$filter["x_jenjang_id"];
        $this->jenjang_id->AdvancedSearch->SearchOperator = @$filter["z_jenjang_id"];
        $this->jenjang_id->AdvancedSearch->SearchCondition = @$filter["v_jenjang_id"];
        $this->jenjang_id->AdvancedSearch->SearchValue2 = @$filter["y_jenjang_id"];
        $this->jenjang_id->AdvancedSearch->SearchOperator2 = @$filter["w_jenjang_id"];
        $this->jenjang_id->AdvancedSearch->save();

        // Field jabatan_id
        $this->jabatan_id->AdvancedSearch->SearchValue = @$filter["x_jabatan_id"];
        $this->jabatan_id->AdvancedSearch->SearchOperator = @$filter["z_jabatan_id"];
        $this->jabatan_id->AdvancedSearch->SearchCondition = @$filter["v_jabatan_id"];
        $this->jabatan_id->AdvancedSearch->SearchValue2 = @$filter["y_jabatan_id"];
        $this->jabatan_id->AdvancedSearch->SearchOperator2 = @$filter["w_jabatan_id"];
        $this->jabatan_id->AdvancedSearch->save();

        // Field terlambat
        $this->terlambat->AdvancedSearch->SearchValue = @$filter["x_terlambat"];
        $this->terlambat->AdvancedSearch->SearchOperator = @$filter["z_terlambat"];
        $this->terlambat->AdvancedSearch->SearchCondition = @$filter["v_terlambat"];
        $this->terlambat->AdvancedSearch->SearchValue2 = @$filter["y_terlambat"];
        $this->terlambat->AdvancedSearch->SearchOperator2 = @$filter["w_terlambat"];
        $this->terlambat->AdvancedSearch->save();

        // Field value_terlambat
        $this->value_terlambat->AdvancedSearch->SearchValue = @$filter["x_value_terlambat"];
        $this->value_terlambat->AdvancedSearch->SearchOperator = @$filter["z_value_terlambat"];
        $this->value_terlambat->AdvancedSearch->SearchCondition = @$filter["v_value_terlambat"];
        $this->value_terlambat->AdvancedSearch->SearchValue2 = @$filter["y_value_terlambat"];
        $this->value_terlambat->AdvancedSearch->SearchOperator2 = @$filter["w_value_terlambat"];
        $this->value_terlambat->AdvancedSearch->save();

        // Field izin
        $this->izin->AdvancedSearch->SearchValue = @$filter["x_izin"];
        $this->izin->AdvancedSearch->SearchOperator = @$filter["z_izin"];
        $this->izin->AdvancedSearch->SearchCondition = @$filter["v_izin"];
        $this->izin->AdvancedSearch->SearchValue2 = @$filter["y_izin"];
        $this->izin->AdvancedSearch->SearchOperator2 = @$filter["w_izin"];
        $this->izin->AdvancedSearch->save();

        // Field value_izin
        $this->value_izin->AdvancedSearch->SearchValue = @$filter["x_value_izin"];
        $this->value_izin->AdvancedSearch->SearchOperator = @$filter["z_value_izin"];
        $this->value_izin->AdvancedSearch->SearchCondition = @$filter["v_value_izin"];
        $this->value_izin->AdvancedSearch->SearchValue2 = @$filter["y_value_izin"];
        $this->value_izin->AdvancedSearch->SearchOperator2 = @$filter["w_value_izin"];
        $this->value_izin->AdvancedSearch->save();

        // Field izinperjam
        $this->izinperjam->AdvancedSearch->SearchValue = @$filter["x_izinperjam"];
        $this->izinperjam->AdvancedSearch->SearchOperator = @$filter["z_izinperjam"];
        $this->izinperjam->AdvancedSearch->SearchCondition = @$filter["v_izinperjam"];
        $this->izinperjam->AdvancedSearch->SearchValue2 = @$filter["y_izinperjam"];
        $this->izinperjam->AdvancedSearch->SearchOperator2 = @$filter["w_izinperjam"];
        $this->izinperjam->AdvancedSearch->save();

        // Field izinperjamvalue
        $this->izinperjamvalue->AdvancedSearch->SearchValue = @$filter["x_izinperjamvalue"];
        $this->izinperjamvalue->AdvancedSearch->SearchOperator = @$filter["z_izinperjamvalue"];
        $this->izinperjamvalue->AdvancedSearch->SearchCondition = @$filter["v_izinperjamvalue"];
        $this->izinperjamvalue->AdvancedSearch->SearchValue2 = @$filter["y_izinperjamvalue"];
        $this->izinperjamvalue->AdvancedSearch->SearchOperator2 = @$filter["w_izinperjamvalue"];
        $this->izinperjamvalue->AdvancedSearch->save();

        // Field sakit
        $this->sakit->AdvancedSearch->SearchValue = @$filter["x_sakit"];
        $this->sakit->AdvancedSearch->SearchOperator = @$filter["z_sakit"];
        $this->sakit->AdvancedSearch->SearchCondition = @$filter["v_sakit"];
        $this->sakit->AdvancedSearch->SearchValue2 = @$filter["y_sakit"];
        $this->sakit->AdvancedSearch->SearchOperator2 = @$filter["w_sakit"];
        $this->sakit->AdvancedSearch->save();

        // Field value_sakit
        $this->value_sakit->AdvancedSearch->SearchValue = @$filter["x_value_sakit"];
        $this->value_sakit->AdvancedSearch->SearchOperator = @$filter["z_value_sakit"];
        $this->value_sakit->AdvancedSearch->SearchCondition = @$filter["v_value_sakit"];
        $this->value_sakit->AdvancedSearch->SearchValue2 = @$filter["y_value_sakit"];
        $this->value_sakit->AdvancedSearch->SearchOperator2 = @$filter["w_value_sakit"];
        $this->value_sakit->AdvancedSearch->save();

        // Field sakitperjam
        $this->sakitperjam->AdvancedSearch->SearchValue = @$filter["x_sakitperjam"];
        $this->sakitperjam->AdvancedSearch->SearchOperator = @$filter["z_sakitperjam"];
        $this->sakitperjam->AdvancedSearch->SearchCondition = @$filter["v_sakitperjam"];
        $this->sakitperjam->AdvancedSearch->SearchValue2 = @$filter["y_sakitperjam"];
        $this->sakitperjam->AdvancedSearch->SearchOperator2 = @$filter["w_sakitperjam"];
        $this->sakitperjam->AdvancedSearch->save();

        // Field sakitperjamvalue
        $this->sakitperjamvalue->AdvancedSearch->SearchValue = @$filter["x_sakitperjamvalue"];
        $this->sakitperjamvalue->AdvancedSearch->SearchOperator = @$filter["z_sakitperjamvalue"];
        $this->sakitperjamvalue->AdvancedSearch->SearchCondition = @$filter["v_sakitperjamvalue"];
        $this->sakitperjamvalue->AdvancedSearch->SearchValue2 = @$filter["y_sakitperjamvalue"];
        $this->sakitperjamvalue->AdvancedSearch->SearchOperator2 = @$filter["w_sakitperjamvalue"];
        $this->sakitperjamvalue->AdvancedSearch->save();

        // Field pulcep
        $this->pulcep->AdvancedSearch->SearchValue = @$filter["x_pulcep"];
        $this->pulcep->AdvancedSearch->SearchOperator = @$filter["z_pulcep"];
        $this->pulcep->AdvancedSearch->SearchCondition = @$filter["v_pulcep"];
        $this->pulcep->AdvancedSearch->SearchValue2 = @$filter["y_pulcep"];
        $this->pulcep->AdvancedSearch->SearchOperator2 = @$filter["w_pulcep"];
        $this->pulcep->AdvancedSearch->save();

        // Field value_pulcep
        $this->value_pulcep->AdvancedSearch->SearchValue = @$filter["x_value_pulcep"];
        $this->value_pulcep->AdvancedSearch->SearchOperator = @$filter["z_value_pulcep"];
        $this->value_pulcep->AdvancedSearch->SearchCondition = @$filter["v_value_pulcep"];
        $this->value_pulcep->AdvancedSearch->SearchValue2 = @$filter["y_value_pulcep"];
        $this->value_pulcep->AdvancedSearch->SearchOperator2 = @$filter["w_value_pulcep"];
        $this->value_pulcep->AdvancedSearch->save();

        // Field tidakhadir
        $this->tidakhadir->AdvancedSearch->SearchValue = @$filter["x_tidakhadir"];
        $this->tidakhadir->AdvancedSearch->SearchOperator = @$filter["z_tidakhadir"];
        $this->tidakhadir->AdvancedSearch->SearchCondition = @$filter["v_tidakhadir"];
        $this->tidakhadir->AdvancedSearch->SearchValue2 = @$filter["y_tidakhadir"];
        $this->tidakhadir->AdvancedSearch->SearchOperator2 = @$filter["w_tidakhadir"];
        $this->tidakhadir->AdvancedSearch->save();

        // Field value_tidakhadir
        $this->value_tidakhadir->AdvancedSearch->SearchValue = @$filter["x_value_tidakhadir"];
        $this->value_tidakhadir->AdvancedSearch->SearchOperator = @$filter["z_value_tidakhadir"];
        $this->value_tidakhadir->AdvancedSearch->SearchCondition = @$filter["v_value_tidakhadir"];
        $this->value_tidakhadir->AdvancedSearch->SearchValue2 = @$filter["y_value_tidakhadir"];
        $this->value_tidakhadir->AdvancedSearch->SearchOperator2 = @$filter["w_value_tidakhadir"];
        $this->value_tidakhadir->AdvancedSearch->save();

        // Field tidakhadirjam
        $this->tidakhadirjam->AdvancedSearch->SearchValue = @$filter["x_tidakhadirjam"];
        $this->tidakhadirjam->AdvancedSearch->SearchOperator = @$filter["z_tidakhadirjam"];
        $this->tidakhadirjam->AdvancedSearch->SearchCondition = @$filter["v_tidakhadirjam"];
        $this->tidakhadirjam->AdvancedSearch->SearchValue2 = @$filter["y_tidakhadirjam"];
        $this->tidakhadirjam->AdvancedSearch->SearchOperator2 = @$filter["w_tidakhadirjam"];
        $this->tidakhadirjam->AdvancedSearch->save();

        // Field tidakhadirjamvalue
        $this->tidakhadirjamvalue->AdvancedSearch->SearchValue = @$filter["x_tidakhadirjamvalue"];
        $this->tidakhadirjamvalue->AdvancedSearch->SearchOperator = @$filter["z_tidakhadirjamvalue"];
        $this->tidakhadirjamvalue->AdvancedSearch->SearchCondition = @$filter["v_tidakhadirjamvalue"];
        $this->tidakhadirjamvalue->AdvancedSearch->SearchValue2 = @$filter["y_tidakhadirjamvalue"];
        $this->tidakhadirjamvalue->AdvancedSearch->SearchOperator2 = @$filter["w_tidakhadirjamvalue"];
        $this->tidakhadirjamvalue->AdvancedSearch->save();

        // Field total
        $this->total->AdvancedSearch->SearchValue = @$filter["x_total"];
        $this->total->AdvancedSearch->SearchOperator = @$filter["z_total"];
        $this->total->AdvancedSearch->SearchCondition = @$filter["v_total"];
        $this->total->AdvancedSearch->SearchValue2 = @$filter["y_total"];
        $this->total->AdvancedSearch->SearchOperator2 = @$filter["w_total"];
        $this->total->AdvancedSearch->save();

        // Field u_by
        $this->u_by->AdvancedSearch->SearchValue = @$filter["x_u_by"];
        $this->u_by->AdvancedSearch->SearchOperator = @$filter["z_u_by"];
        $this->u_by->AdvancedSearch->SearchCondition = @$filter["v_u_by"];
        $this->u_by->AdvancedSearch->SearchValue2 = @$filter["y_u_by"];
        $this->u_by->AdvancedSearch->SearchOperator2 = @$filter["w_u_by"];
        $this->u_by->AdvancedSearch->save();

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
        $this->buildSearchSql($where, $this->month, $default, false); // month
        $this->buildSearchSql($where, $this->nama, $default, false); // nama
        $this->buildSearchSql($where, $this->jenjang_id, $default, false); // jenjang_id
        $this->buildSearchSql($where, $this->jabatan_id, $default, false); // jabatan_id
        $this->buildSearchSql($where, $this->terlambat, $default, false); // terlambat
        $this->buildSearchSql($where, $this->value_terlambat, $default, false); // value_terlambat
        $this->buildSearchSql($where, $this->izin, $default, false); // izin
        $this->buildSearchSql($where, $this->value_izin, $default, false); // value_izin
        $this->buildSearchSql($where, $this->izinperjam, $default, false); // izinperjam
        $this->buildSearchSql($where, $this->izinperjamvalue, $default, false); // izinperjamvalue
        $this->buildSearchSql($where, $this->sakit, $default, false); // sakit
        $this->buildSearchSql($where, $this->value_sakit, $default, false); // value_sakit
        $this->buildSearchSql($where, $this->sakitperjam, $default, false); // sakitperjam
        $this->buildSearchSql($where, $this->sakitperjamvalue, $default, false); // sakitperjamvalue
        $this->buildSearchSql($where, $this->pulcep, $default, false); // pulcep
        $this->buildSearchSql($where, $this->value_pulcep, $default, false); // value_pulcep
        $this->buildSearchSql($where, $this->tidakhadir, $default, false); // tidakhadir
        $this->buildSearchSql($where, $this->value_tidakhadir, $default, false); // value_tidakhadir
        $this->buildSearchSql($where, $this->tidakhadirjam, $default, false); // tidakhadirjam
        $this->buildSearchSql($where, $this->tidakhadirjamvalue, $default, false); // tidakhadirjamvalue
        $this->buildSearchSql($where, $this->total, $default, false); // total
        $this->buildSearchSql($where, $this->u_by, $default, false); // u_by
        $this->buildSearchSql($where, $this->datetime, $default, false); // datetime

        // Set up search parm
        if (!$default && $where != "" && in_array($this->Command, ["", "reset", "resetall"])) {
            $this->Command = "search";
        }
        if (!$default && $this->Command == "search") {
            $this->id->AdvancedSearch->save(); // id
            $this->month->AdvancedSearch->save(); // month
            $this->nama->AdvancedSearch->save(); // nama
            $this->jenjang_id->AdvancedSearch->save(); // jenjang_id
            $this->jabatan_id->AdvancedSearch->save(); // jabatan_id
            $this->terlambat->AdvancedSearch->save(); // terlambat
            $this->value_terlambat->AdvancedSearch->save(); // value_terlambat
            $this->izin->AdvancedSearch->save(); // izin
            $this->value_izin->AdvancedSearch->save(); // value_izin
            $this->izinperjam->AdvancedSearch->save(); // izinperjam
            $this->izinperjamvalue->AdvancedSearch->save(); // izinperjamvalue
            $this->sakit->AdvancedSearch->save(); // sakit
            $this->value_sakit->AdvancedSearch->save(); // value_sakit
            $this->sakitperjam->AdvancedSearch->save(); // sakitperjam
            $this->sakitperjamvalue->AdvancedSearch->save(); // sakitperjamvalue
            $this->pulcep->AdvancedSearch->save(); // pulcep
            $this->value_pulcep->AdvancedSearch->save(); // value_pulcep
            $this->tidakhadir->AdvancedSearch->save(); // tidakhadir
            $this->value_tidakhadir->AdvancedSearch->save(); // value_tidakhadir
            $this->tidakhadirjam->AdvancedSearch->save(); // tidakhadirjam
            $this->tidakhadirjamvalue->AdvancedSearch->save(); // tidakhadirjamvalue
            $this->total->AdvancedSearch->save(); // total
            $this->u_by->AdvancedSearch->save(); // u_by
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
        if ($this->month->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->nama->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->jenjang_id->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->jabatan_id->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->terlambat->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->value_terlambat->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->izin->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->value_izin->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->izinperjam->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->izinperjamvalue->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->sakit->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->value_sakit->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->sakitperjam->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->sakitperjamvalue->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->pulcep->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->value_pulcep->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->tidakhadir->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->value_tidakhadir->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->tidakhadirjam->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->tidakhadirjamvalue->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->total->AdvancedSearch->issetSession()) {
            return true;
        }
        if ($this->u_by->AdvancedSearch->issetSession()) {
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
        $this->month->AdvancedSearch->unsetSession();
        $this->nama->AdvancedSearch->unsetSession();
        $this->jenjang_id->AdvancedSearch->unsetSession();
        $this->jabatan_id->AdvancedSearch->unsetSession();
        $this->terlambat->AdvancedSearch->unsetSession();
        $this->value_terlambat->AdvancedSearch->unsetSession();
        $this->izin->AdvancedSearch->unsetSession();
        $this->value_izin->AdvancedSearch->unsetSession();
        $this->izinperjam->AdvancedSearch->unsetSession();
        $this->izinperjamvalue->AdvancedSearch->unsetSession();
        $this->sakit->AdvancedSearch->unsetSession();
        $this->value_sakit->AdvancedSearch->unsetSession();
        $this->sakitperjam->AdvancedSearch->unsetSession();
        $this->sakitperjamvalue->AdvancedSearch->unsetSession();
        $this->pulcep->AdvancedSearch->unsetSession();
        $this->value_pulcep->AdvancedSearch->unsetSession();
        $this->tidakhadir->AdvancedSearch->unsetSession();
        $this->value_tidakhadir->AdvancedSearch->unsetSession();
        $this->tidakhadirjam->AdvancedSearch->unsetSession();
        $this->tidakhadirjamvalue->AdvancedSearch->unsetSession();
        $this->total->AdvancedSearch->unsetSession();
        $this->u_by->AdvancedSearch->unsetSession();
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
        $this->month->AdvancedSearch->load();
        $this->nama->AdvancedSearch->load();
        $this->jenjang_id->AdvancedSearch->load();
        $this->jabatan_id->AdvancedSearch->load();
        $this->terlambat->AdvancedSearch->load();
        $this->value_terlambat->AdvancedSearch->load();
        $this->izin->AdvancedSearch->load();
        $this->value_izin->AdvancedSearch->load();
        $this->izinperjam->AdvancedSearch->load();
        $this->izinperjamvalue->AdvancedSearch->load();
        $this->sakit->AdvancedSearch->load();
        $this->value_sakit->AdvancedSearch->load();
        $this->sakitperjam->AdvancedSearch->load();
        $this->sakitperjamvalue->AdvancedSearch->load();
        $this->pulcep->AdvancedSearch->load();
        $this->value_pulcep->AdvancedSearch->load();
        $this->tidakhadir->AdvancedSearch->load();
        $this->value_tidakhadir->AdvancedSearch->load();
        $this->tidakhadirjam->AdvancedSearch->load();
        $this->tidakhadirjamvalue->AdvancedSearch->load();
        $this->total->AdvancedSearch->load();
        $this->u_by->AdvancedSearch->load();
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
            $this->updateSort($this->month); // month
            $this->updateSort($this->nama); // nama
            $this->updateSort($this->jenjang_id); // jenjang_id
            $this->updateSort($this->jabatan_id); // jabatan_id
            $this->updateSort($this->terlambat); // terlambat
            $this->updateSort($this->value_terlambat); // value_terlambat
            $this->updateSort($this->izin); // izin
            $this->updateSort($this->value_izin); // value_izin
            $this->updateSort($this->izinperjam); // izinperjam
            $this->updateSort($this->izinperjamvalue); // izinperjamvalue
            $this->updateSort($this->sakit); // sakit
            $this->updateSort($this->value_sakit); // value_sakit
            $this->updateSort($this->sakitperjam); // sakitperjam
            $this->updateSort($this->sakitperjamvalue); // sakitperjamvalue
            $this->updateSort($this->pulcep); // pulcep
            $this->updateSort($this->value_pulcep); // value_pulcep
            $this->updateSort($this->tidakhadir); // tidakhadir
            $this->updateSort($this->value_tidakhadir); // value_tidakhadir
            $this->updateSort($this->tidakhadirjam); // tidakhadirjam
            $this->updateSort($this->tidakhadirjamvalue); // tidakhadirjamvalue
            $this->updateSort($this->total); // total
            $this->updateSort($this->u_by); // u_by
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
                $this->month->setSort("");
                $this->nama->setSort("");
                $this->jenjang_id->setSort("");
                $this->jabatan_id->setSort("");
                $this->terlambat->setSort("");
                $this->value_terlambat->setSort("");
                $this->izin->setSort("");
                $this->value_izin->setSort("");
                $this->izinperjam->setSort("");
                $this->izinperjamvalue->setSort("");
                $this->sakit->setSort("");
                $this->value_sakit->setSort("");
                $this->sakitperjam->setSort("");
                $this->sakitperjamvalue->setSort("");
                $this->pulcep->setSort("");
                $this->value_pulcep->setSort("");
                $this->tidakhadir->setSort("");
                $this->value_tidakhadir->setSort("");
                $this->tidakhadirjam->setSort("");
                $this->tidakhadirjamvalue->setSort("");
                $this->total->setSort("");
                $this->u_by->setSort("");
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
                    $link = "<li><button type=\"button\" class=\"dropdown-item ew-action ew-list-action\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fpotonganlist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button></li>";
                    if ($link != "") {
                        $links[] = $link;
                        if ($body == "") { // Setup first button
                            $body = "<button type=\"button\" class=\"btn btn-default ew-action ew-list-action\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fpotonganlist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button>";
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
            $option->add("month", $this->createColumnOption("month"));
            $option->add("nama", $this->createColumnOption("nama"));
            $option->add("jenjang_id", $this->createColumnOption("jenjang_id"));
            $option->add("jabatan_id", $this->createColumnOption("jabatan_id"));
            $option->add("terlambat", $this->createColumnOption("terlambat"));
            $option->add("value_terlambat", $this->createColumnOption("value_terlambat"));
            $option->add("izin", $this->createColumnOption("izin"));
            $option->add("value_izin", $this->createColumnOption("value_izin"));
            $option->add("izinperjam", $this->createColumnOption("izinperjam"));
            $option->add("izinperjamvalue", $this->createColumnOption("izinperjamvalue"));
            $option->add("sakit", $this->createColumnOption("sakit"));
            $option->add("value_sakit", $this->createColumnOption("value_sakit"));
            $option->add("sakitperjam", $this->createColumnOption("sakitperjam"));
            $option->add("sakitperjamvalue", $this->createColumnOption("sakitperjamvalue"));
            $option->add("pulcep", $this->createColumnOption("pulcep"));
            $option->add("value_pulcep", $this->createColumnOption("value_pulcep"));
            $option->add("tidakhadir", $this->createColumnOption("tidakhadir"));
            $option->add("value_tidakhadir", $this->createColumnOption("value_tidakhadir"));
            $option->add("tidakhadirjam", $this->createColumnOption("tidakhadirjam"));
            $option->add("tidakhadirjamvalue", $this->createColumnOption("tidakhadirjamvalue"));
            $option->add("total", $this->createColumnOption("total"));
            $option->add("u_by", $this->createColumnOption("u_by"));
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fpotongansrch\" data-ew-action=\"none\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fpotongansrch\" data-ew-action=\"none\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<button type="button" class="btn btn-default ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" data-ew-action="submit" form="fpotonganlist"' . $listaction->toDataAttrs() . '>' . $icon . '</button>';
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

        // month
        if ($this->month->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->month->AdvancedSearch->SearchValue != "" || $this->month->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // nama
        if ($this->nama->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->nama->AdvancedSearch->SearchValue != "" || $this->nama->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // jenjang_id
        if ($this->jenjang_id->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->jenjang_id->AdvancedSearch->SearchValue != "" || $this->jenjang_id->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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

        // terlambat
        if ($this->terlambat->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->terlambat->AdvancedSearch->SearchValue != "" || $this->terlambat->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // value_terlambat
        if ($this->value_terlambat->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->value_terlambat->AdvancedSearch->SearchValue != "" || $this->value_terlambat->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // izin
        if ($this->izin->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->izin->AdvancedSearch->SearchValue != "" || $this->izin->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // value_izin
        if ($this->value_izin->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->value_izin->AdvancedSearch->SearchValue != "" || $this->value_izin->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // izinperjam
        if ($this->izinperjam->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->izinperjam->AdvancedSearch->SearchValue != "" || $this->izinperjam->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // izinperjamvalue
        if ($this->izinperjamvalue->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->izinperjamvalue->AdvancedSearch->SearchValue != "" || $this->izinperjamvalue->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // sakit
        if ($this->sakit->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->sakit->AdvancedSearch->SearchValue != "" || $this->sakit->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // value_sakit
        if ($this->value_sakit->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->value_sakit->AdvancedSearch->SearchValue != "" || $this->value_sakit->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // sakitperjam
        if ($this->sakitperjam->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->sakitperjam->AdvancedSearch->SearchValue != "" || $this->sakitperjam->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // sakitperjamvalue
        if ($this->sakitperjamvalue->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->sakitperjamvalue->AdvancedSearch->SearchValue != "" || $this->sakitperjamvalue->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // pulcep
        if ($this->pulcep->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->pulcep->AdvancedSearch->SearchValue != "" || $this->pulcep->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // value_pulcep
        if ($this->value_pulcep->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->value_pulcep->AdvancedSearch->SearchValue != "" || $this->value_pulcep->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // tidakhadir
        if ($this->tidakhadir->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->tidakhadir->AdvancedSearch->SearchValue != "" || $this->tidakhadir->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // value_tidakhadir
        if ($this->value_tidakhadir->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->value_tidakhadir->AdvancedSearch->SearchValue != "" || $this->value_tidakhadir->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // tidakhadirjam
        if ($this->tidakhadirjam->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->tidakhadirjam->AdvancedSearch->SearchValue != "" || $this->tidakhadirjam->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
                $this->Command = "search";
            }
        }

        // tidakhadirjamvalue
        if ($this->tidakhadirjamvalue->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->tidakhadirjamvalue->AdvancedSearch->SearchValue != "" || $this->tidakhadirjamvalue->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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

        // u_by
        if ($this->u_by->AdvancedSearch->get()) {
            $hasValue = true;
            if (($this->u_by->AdvancedSearch->SearchValue != "" || $this->u_by->AdvancedSearch->SearchValue2 != "") && $this->Command == "") {
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
        $this->month->setDbValue($row['month']);
        $this->nama->setDbValue($row['nama']);
        $this->jenjang_id->setDbValue($row['jenjang_id']);
        $this->jabatan_id->setDbValue($row['jabatan_id']);
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
        $row['nama'] = $this->nama->DefaultValue;
        $row['jenjang_id'] = $this->jenjang_id->DefaultValue;
        $row['jabatan_id'] = $this->jabatan_id->DefaultValue;
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

        // month

        // nama

        // jenjang_id

        // jabatan_id

        // terlambat

        // value_terlambat

        // izin

        // value_izin

        // izinperjam

        // izinperjamvalue

        // sakit

        // value_sakit

        // sakitperjam

        // sakitperjamvalue

        // pulcep

        // value_pulcep

        // tidakhadir

        // value_tidakhadir

        // tidakhadirjam

        // tidakhadirjamvalue

        // total

        // u_by

        // datetime

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // month
            $this->month->ViewValue = $this->month->CurrentValue;
            $this->month->ViewCustomAttributes = "";

            // nama
            $this->nama->ViewValue = $this->nama->CurrentValue;
            $curVal = strval($this->nama->CurrentValue);
            if ($curVal != "") {
                $this->nama->ViewValue = $this->nama->lookupCacheOption($curVal);
                if ($this->nama->ViewValue === null) { // Lookup from database
                    $filterWrk = "`nip`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->nama->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->nama->Lookup->renderViewRow($rswrk[0]);
                        $this->nama->ViewValue = $this->nama->displayValue($arwrk);
                    } else {
                        $this->nama->ViewValue = $this->nama->CurrentValue;
                    }
                }
            } else {
                $this->nama->ViewValue = null;
            }
            $this->nama->ViewCustomAttributes = "";

            // jenjang_id
            $this->jenjang_id->ViewValue = $this->jenjang_id->CurrentValue;
            $curVal = strval($this->jenjang_id->CurrentValue);
            if ($curVal != "") {
                $this->jenjang_id->ViewValue = $this->jenjang_id->lookupCacheOption($curVal);
                if ($this->jenjang_id->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->jenjang_id->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->jenjang_id->Lookup->renderViewRow($rswrk[0]);
                        $this->jenjang_id->ViewValue = $this->jenjang_id->displayValue($arwrk);
                    } else {
                        $this->jenjang_id->ViewValue = FormatNumber($this->jenjang_id->CurrentValue, $this->jenjang_id->formatPattern());
                    }
                }
            } else {
                $this->jenjang_id->ViewValue = null;
            }
            $this->jenjang_id->ViewCustomAttributes = "";

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
            $curVal = strval($this->u_by->CurrentValue);
            if ($curVal != "") {
                $this->u_by->ViewValue = $this->u_by->lookupCacheOption($curVal);
                if ($this->u_by->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->u_by->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->u_by->Lookup->renderViewRow($rswrk[0]);
                        $this->u_by->ViewValue = $this->u_by->displayValue($arwrk);
                    } else {
                        $this->u_by->ViewValue = FormatNumber($this->u_by->CurrentValue, $this->u_by->formatPattern());
                    }
                }
            } else {
                $this->u_by->ViewValue = null;
            }
            $this->u_by->ViewCustomAttributes = "";

            // datetime
            $this->datetime->ViewValue = $this->datetime->CurrentValue;
            $this->datetime->ViewValue = FormatDateTime($this->datetime->ViewValue, $this->datetime->formatPattern());
            $this->datetime->ViewCustomAttributes = "";

            // month
            $this->month->LinkCustomAttributes = "";
            $this->month->HrefValue = "";
            $this->month->TooltipValue = "";

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";
            $this->nama->TooltipValue = "";

            // jenjang_id
            $this->jenjang_id->LinkCustomAttributes = "";
            $this->jenjang_id->HrefValue = "";
            $this->jenjang_id->TooltipValue = "";

            // jabatan_id
            $this->jabatan_id->LinkCustomAttributes = "";
            $this->jabatan_id->HrefValue = "";
            $this->jabatan_id->TooltipValue = "";

            // terlambat
            $this->terlambat->LinkCustomAttributes = "";
            $this->terlambat->HrefValue = "";
            $this->terlambat->TooltipValue = "";

            // value_terlambat
            $this->value_terlambat->LinkCustomAttributes = "";
            $this->value_terlambat->HrefValue = "";
            $this->value_terlambat->TooltipValue = "";

            // izin
            $this->izin->LinkCustomAttributes = "";
            $this->izin->HrefValue = "";
            $this->izin->TooltipValue = "";

            // value_izin
            $this->value_izin->LinkCustomAttributes = "";
            $this->value_izin->HrefValue = "";
            $this->value_izin->TooltipValue = "";

            // izinperjam
            $this->izinperjam->LinkCustomAttributes = "";
            $this->izinperjam->HrefValue = "";
            $this->izinperjam->TooltipValue = "";

            // izinperjamvalue
            $this->izinperjamvalue->LinkCustomAttributes = "";
            $this->izinperjamvalue->HrefValue = "";
            $this->izinperjamvalue->TooltipValue = "";

            // sakit
            $this->sakit->LinkCustomAttributes = "";
            $this->sakit->HrefValue = "";
            $this->sakit->TooltipValue = "";

            // value_sakit
            $this->value_sakit->LinkCustomAttributes = "";
            $this->value_sakit->HrefValue = "";
            $this->value_sakit->TooltipValue = "";

            // sakitperjam
            $this->sakitperjam->LinkCustomAttributes = "";
            $this->sakitperjam->HrefValue = "";
            $this->sakitperjam->TooltipValue = "";

            // sakitperjamvalue
            $this->sakitperjamvalue->LinkCustomAttributes = "";
            $this->sakitperjamvalue->HrefValue = "";
            $this->sakitperjamvalue->TooltipValue = "";

            // pulcep
            $this->pulcep->LinkCustomAttributes = "";
            $this->pulcep->HrefValue = "";
            $this->pulcep->TooltipValue = "";

            // value_pulcep
            $this->value_pulcep->LinkCustomAttributes = "";
            $this->value_pulcep->HrefValue = "";
            $this->value_pulcep->TooltipValue = "";

            // tidakhadir
            $this->tidakhadir->LinkCustomAttributes = "";
            $this->tidakhadir->HrefValue = "";
            $this->tidakhadir->TooltipValue = "";

            // value_tidakhadir
            $this->value_tidakhadir->LinkCustomAttributes = "";
            $this->value_tidakhadir->HrefValue = "";
            $this->value_tidakhadir->TooltipValue = "";

            // tidakhadirjam
            $this->tidakhadirjam->LinkCustomAttributes = "";
            $this->tidakhadirjam->HrefValue = "";
            $this->tidakhadirjam->TooltipValue = "";

            // tidakhadirjamvalue
            $this->tidakhadirjamvalue->LinkCustomAttributes = "";
            $this->tidakhadirjamvalue->HrefValue = "";
            $this->tidakhadirjamvalue->TooltipValue = "";

            // total
            $this->total->LinkCustomAttributes = "";
            $this->total->HrefValue = "";
            $this->total->TooltipValue = "";

            // u_by
            $this->u_by->LinkCustomAttributes = "";
            $this->u_by->HrefValue = "";
            $this->u_by->TooltipValue = "";

            // datetime
            $this->datetime->LinkCustomAttributes = "";
            $this->datetime->HrefValue = "";
            $this->datetime->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_SEARCH) {
            // month
            $this->month->setupEditAttributes();
            $this->month->EditCustomAttributes = "";
            if (!$this->month->Raw) {
                $this->month->AdvancedSearch->SearchValue = HtmlDecode($this->month->AdvancedSearch->SearchValue);
            }
            $this->month->EditValue = HtmlEncode($this->month->AdvancedSearch->SearchValue);
            $this->month->PlaceHolder = RemoveHtml($this->month->caption());

            // nama
            $this->nama->setupEditAttributes();
            $this->nama->EditCustomAttributes = "";
            if (!$this->nama->Raw) {
                $this->nama->AdvancedSearch->SearchValue = HtmlDecode($this->nama->AdvancedSearch->SearchValue);
            }
            $this->nama->EditValue = HtmlEncode($this->nama->AdvancedSearch->SearchValue);
            $curVal = strval($this->nama->AdvancedSearch->SearchValue);
            if ($curVal != "") {
                $this->nama->EditValue = $this->nama->lookupCacheOption($curVal);
                if ($this->nama->EditValue === null) { // Lookup from database
                    $filterWrk = "`nip`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->nama->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->nama->Lookup->renderViewRow($rswrk[0]);
                        $this->nama->EditValue = $this->nama->displayValue($arwrk);
                    } else {
                        $this->nama->EditValue = HtmlEncode($this->nama->AdvancedSearch->SearchValue);
                    }
                }
            } else {
                $this->nama->EditValue = null;
            }
            $this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

            // jenjang_id
            $this->jenjang_id->setupEditAttributes();
            $this->jenjang_id->EditCustomAttributes = "";
            $this->jenjang_id->EditValue = HtmlEncode($this->jenjang_id->AdvancedSearch->SearchValue);
            $this->jenjang_id->PlaceHolder = RemoveHtml($this->jenjang_id->caption());

            // jabatan_id
            $this->jabatan_id->setupEditAttributes();
            $this->jabatan_id->EditCustomAttributes = "";
            $this->jabatan_id->EditValue = HtmlEncode($this->jabatan_id->AdvancedSearch->SearchValue);
            $this->jabatan_id->PlaceHolder = RemoveHtml($this->jabatan_id->caption());

            // terlambat
            $this->terlambat->setupEditAttributes();
            $this->terlambat->EditCustomAttributes = "";
            $this->terlambat->EditValue = HtmlEncode($this->terlambat->AdvancedSearch->SearchValue);
            $this->terlambat->PlaceHolder = RemoveHtml($this->terlambat->caption());

            // value_terlambat
            $this->value_terlambat->setupEditAttributes();
            $this->value_terlambat->EditCustomAttributes = "";
            $this->value_terlambat->EditValue = HtmlEncode($this->value_terlambat->AdvancedSearch->SearchValue);
            $this->value_terlambat->PlaceHolder = RemoveHtml($this->value_terlambat->caption());

            // izin
            $this->izin->setupEditAttributes();
            $this->izin->EditCustomAttributes = "";
            $this->izin->EditValue = HtmlEncode($this->izin->AdvancedSearch->SearchValue);
            $this->izin->PlaceHolder = RemoveHtml($this->izin->caption());

            // value_izin
            $this->value_izin->setupEditAttributes();
            $this->value_izin->EditCustomAttributes = "";
            $this->value_izin->EditValue = HtmlEncode($this->value_izin->AdvancedSearch->SearchValue);
            $this->value_izin->PlaceHolder = RemoveHtml($this->value_izin->caption());

            // izinperjam
            $this->izinperjam->setupEditAttributes();
            $this->izinperjam->EditCustomAttributes = "";
            $this->izinperjam->EditValue = HtmlEncode($this->izinperjam->AdvancedSearch->SearchValue);
            $this->izinperjam->PlaceHolder = RemoveHtml($this->izinperjam->caption());

            // izinperjamvalue
            $this->izinperjamvalue->setupEditAttributes();
            $this->izinperjamvalue->EditCustomAttributes = "";
            $this->izinperjamvalue->EditValue = HtmlEncode($this->izinperjamvalue->AdvancedSearch->SearchValue);
            $this->izinperjamvalue->PlaceHolder = RemoveHtml($this->izinperjamvalue->caption());

            // sakit
            $this->sakit->setupEditAttributes();
            $this->sakit->EditCustomAttributes = "";
            $this->sakit->EditValue = HtmlEncode($this->sakit->AdvancedSearch->SearchValue);
            $this->sakit->PlaceHolder = RemoveHtml($this->sakit->caption());

            // value_sakit
            $this->value_sakit->setupEditAttributes();
            $this->value_sakit->EditCustomAttributes = "";
            $this->value_sakit->EditValue = HtmlEncode($this->value_sakit->AdvancedSearch->SearchValue);
            $this->value_sakit->PlaceHolder = RemoveHtml($this->value_sakit->caption());

            // sakitperjam
            $this->sakitperjam->setupEditAttributes();
            $this->sakitperjam->EditCustomAttributes = "";
            $this->sakitperjam->EditValue = HtmlEncode($this->sakitperjam->AdvancedSearch->SearchValue);
            $this->sakitperjam->PlaceHolder = RemoveHtml($this->sakitperjam->caption());

            // sakitperjamvalue
            $this->sakitperjamvalue->setupEditAttributes();
            $this->sakitperjamvalue->EditCustomAttributes = "";
            $this->sakitperjamvalue->EditValue = HtmlEncode($this->sakitperjamvalue->AdvancedSearch->SearchValue);
            $this->sakitperjamvalue->PlaceHolder = RemoveHtml($this->sakitperjamvalue->caption());

            // pulcep
            $this->pulcep->setupEditAttributes();
            $this->pulcep->EditCustomAttributes = "";
            $this->pulcep->EditValue = HtmlEncode($this->pulcep->AdvancedSearch->SearchValue);
            $this->pulcep->PlaceHolder = RemoveHtml($this->pulcep->caption());

            // value_pulcep
            $this->value_pulcep->setupEditAttributes();
            $this->value_pulcep->EditCustomAttributes = "";
            $this->value_pulcep->EditValue = HtmlEncode($this->value_pulcep->AdvancedSearch->SearchValue);
            $this->value_pulcep->PlaceHolder = RemoveHtml($this->value_pulcep->caption());

            // tidakhadir
            $this->tidakhadir->setupEditAttributes();
            $this->tidakhadir->EditCustomAttributes = "";
            $this->tidakhadir->EditValue = HtmlEncode($this->tidakhadir->AdvancedSearch->SearchValue);
            $this->tidakhadir->PlaceHolder = RemoveHtml($this->tidakhadir->caption());

            // value_tidakhadir
            $this->value_tidakhadir->setupEditAttributes();
            $this->value_tidakhadir->EditCustomAttributes = "";
            $this->value_tidakhadir->EditValue = HtmlEncode($this->value_tidakhadir->AdvancedSearch->SearchValue);
            $this->value_tidakhadir->PlaceHolder = RemoveHtml($this->value_tidakhadir->caption());

            // tidakhadirjam
            $this->tidakhadirjam->setupEditAttributes();
            $this->tidakhadirjam->EditCustomAttributes = "";
            $this->tidakhadirjam->EditValue = HtmlEncode($this->tidakhadirjam->AdvancedSearch->SearchValue);
            $this->tidakhadirjam->PlaceHolder = RemoveHtml($this->tidakhadirjam->caption());

            // tidakhadirjamvalue
            $this->tidakhadirjamvalue->setupEditAttributes();
            $this->tidakhadirjamvalue->EditCustomAttributes = "";
            $this->tidakhadirjamvalue->EditValue = HtmlEncode($this->tidakhadirjamvalue->AdvancedSearch->SearchValue);
            $this->tidakhadirjamvalue->PlaceHolder = RemoveHtml($this->tidakhadirjamvalue->caption());

            // total
            $this->total->setupEditAttributes();
            $this->total->EditCustomAttributes = "";
            $this->total->EditValue = HtmlEncode($this->total->AdvancedSearch->SearchValue);
            $this->total->PlaceHolder = RemoveHtml($this->total->caption());

            // u_by
            $this->u_by->setupEditAttributes();
            $this->u_by->EditCustomAttributes = "";
            $this->u_by->EditValue = HtmlEncode($this->u_by->AdvancedSearch->SearchValue);
            $this->u_by->PlaceHolder = RemoveHtml($this->u_by->caption());

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
        $this->month->AdvancedSearch->load();
        $this->nama->AdvancedSearch->load();
        $this->jenjang_id->AdvancedSearch->load();
        $this->jabatan_id->AdvancedSearch->load();
        $this->terlambat->AdvancedSearch->load();
        $this->value_terlambat->AdvancedSearch->load();
        $this->izin->AdvancedSearch->load();
        $this->value_izin->AdvancedSearch->load();
        $this->izinperjam->AdvancedSearch->load();
        $this->izinperjamvalue->AdvancedSearch->load();
        $this->sakit->AdvancedSearch->load();
        $this->value_sakit->AdvancedSearch->load();
        $this->sakitperjam->AdvancedSearch->load();
        $this->sakitperjamvalue->AdvancedSearch->load();
        $this->pulcep->AdvancedSearch->load();
        $this->value_pulcep->AdvancedSearch->load();
        $this->tidakhadir->AdvancedSearch->load();
        $this->value_tidakhadir->AdvancedSearch->load();
        $this->tidakhadirjam->AdvancedSearch->load();
        $this->tidakhadirjamvalue->AdvancedSearch->load();
        $this->total->AdvancedSearch->load();
        $this->u_by->AdvancedSearch->load();
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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-ew-action=\"search-toggle\" data-form=\"fpotongansrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
                case "x_nama":
                    break;
                case "x_jenjang_id":
                    break;
                case "x_jabatan_id":
                    break;
                case "x_u_by":
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
