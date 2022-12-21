<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PegawaiList extends Pegawai
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'pegawai';

    // Page object name
    public $PageObjName = "PegawaiList";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fpegawailist";
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

        // Table object (pegawai)
        if (!isset($GLOBALS["pegawai"]) || get_class($GLOBALS["pegawai"]) == PROJECT_NAMESPACE . "pegawai") {
            $GLOBALS["pegawai"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl(false);

        // Initialize URLs
        $this->AddUrl = "PegawaiAdd?" . Config("TABLE_SHOW_DETAIL") . "=";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "PegawaiDelete";
        $this->MultiUpdateUrl = "PegawaiUpdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'pegawai');
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
                $tbl = Container("pegawai");
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
		        $this->foto->OldUploadPath = "file_foto";
		        $this->foto->UploadPath = $this->foto->OldUploadPath;
		        $this->file_cv->OldUploadPath = "file_cv";
		        $this->file_cv->UploadPath = $this->file_cv->OldUploadPath;
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
        $this->id->Visible = false;
        $this->pid->Visible = false;
        $this->_username->setVisibility();
        $this->_password->setVisibility();
        $this->nip->setVisibility();
        $this->nama->setVisibility();
        $this->alamat->setVisibility();
        $this->_email->setVisibility();
        $this->wa->setVisibility();
        $this->hp->setVisibility();
        $this->tgllahir->setVisibility();
        $this->rekbank->setVisibility();
        $this->jenjang_id->setVisibility();
        $this->pendidikan->setVisibility();
        $this->jurusan->setVisibility();
        $this->agama->setVisibility();
        $this->jabatan->setVisibility();
        $this->jenkel->setVisibility();
        $this->mulai_bekerja->setVisibility();
        $this->status->setVisibility();
        $this->keterangan->setVisibility();
        $this->level->setVisibility();
        $this->aktif->setVisibility();
        $this->foto->setVisibility();
        $this->file_cv->setVisibility();
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
        $this->setupLookupOptions($this->jenjang_id);
        $this->setupLookupOptions($this->pendidikan);
        $this->setupLookupOptions($this->agama);
        $this->setupLookupOptions($this->jabatan);
        $this->setupLookupOptions($this->jenkel);
        $this->setupLookupOptions($this->level);

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

            // Get basic search values
            $this->loadBasicSearchValues();

            // Process filter list
            if ($this->processFilterList()) {
                $this->terminate();
                return;
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
        $filterList = Concat($filterList, $this->pid->AdvancedSearch->toJson(), ","); // Field pid
        $filterList = Concat($filterList, $this->_username->AdvancedSearch->toJson(), ","); // Field username
        $filterList = Concat($filterList, $this->_password->AdvancedSearch->toJson(), ","); // Field password
        $filterList = Concat($filterList, $this->nip->AdvancedSearch->toJson(), ","); // Field nip
        $filterList = Concat($filterList, $this->nama->AdvancedSearch->toJson(), ","); // Field nama
        $filterList = Concat($filterList, $this->alamat->AdvancedSearch->toJson(), ","); // Field alamat
        $filterList = Concat($filterList, $this->_email->AdvancedSearch->toJson(), ","); // Field email
        $filterList = Concat($filterList, $this->wa->AdvancedSearch->toJson(), ","); // Field wa
        $filterList = Concat($filterList, $this->hp->AdvancedSearch->toJson(), ","); // Field hp
        $filterList = Concat($filterList, $this->tgllahir->AdvancedSearch->toJson(), ","); // Field tgllahir
        $filterList = Concat($filterList, $this->rekbank->AdvancedSearch->toJson(), ","); // Field rekbank
        $filterList = Concat($filterList, $this->jenjang_id->AdvancedSearch->toJson(), ","); // Field jenjang_id
        $filterList = Concat($filterList, $this->pendidikan->AdvancedSearch->toJson(), ","); // Field pendidikan
        $filterList = Concat($filterList, $this->jurusan->AdvancedSearch->toJson(), ","); // Field jurusan
        $filterList = Concat($filterList, $this->agama->AdvancedSearch->toJson(), ","); // Field agama
        $filterList = Concat($filterList, $this->jabatan->AdvancedSearch->toJson(), ","); // Field jabatan
        $filterList = Concat($filterList, $this->jenkel->AdvancedSearch->toJson(), ","); // Field jenkel
        $filterList = Concat($filterList, $this->mulai_bekerja->AdvancedSearch->toJson(), ","); // Field mulai_bekerja
        $filterList = Concat($filterList, $this->status->AdvancedSearch->toJson(), ","); // Field status
        $filterList = Concat($filterList, $this->keterangan->AdvancedSearch->toJson(), ","); // Field keterangan
        $filterList = Concat($filterList, $this->level->AdvancedSearch->toJson(), ","); // Field level
        $filterList = Concat($filterList, $this->aktif->AdvancedSearch->toJson(), ","); // Field aktif
        $filterList = Concat($filterList, $this->foto->AdvancedSearch->toJson(), ","); // Field foto
        $filterList = Concat($filterList, $this->file_cv->AdvancedSearch->toJson(), ","); // Field file_cv
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
            $UserProfile->setSearchFilters(CurrentUserName(), "fpegawaisrch", $filters);
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

        // Field pid
        $this->pid->AdvancedSearch->SearchValue = @$filter["x_pid"];
        $this->pid->AdvancedSearch->SearchOperator = @$filter["z_pid"];
        $this->pid->AdvancedSearch->SearchCondition = @$filter["v_pid"];
        $this->pid->AdvancedSearch->SearchValue2 = @$filter["y_pid"];
        $this->pid->AdvancedSearch->SearchOperator2 = @$filter["w_pid"];
        $this->pid->AdvancedSearch->save();

        // Field username
        $this->_username->AdvancedSearch->SearchValue = @$filter["x__username"];
        $this->_username->AdvancedSearch->SearchOperator = @$filter["z__username"];
        $this->_username->AdvancedSearch->SearchCondition = @$filter["v__username"];
        $this->_username->AdvancedSearch->SearchValue2 = @$filter["y__username"];
        $this->_username->AdvancedSearch->SearchOperator2 = @$filter["w__username"];
        $this->_username->AdvancedSearch->save();

        // Field password
        $this->_password->AdvancedSearch->SearchValue = @$filter["x__password"];
        $this->_password->AdvancedSearch->SearchOperator = @$filter["z__password"];
        $this->_password->AdvancedSearch->SearchCondition = @$filter["v__password"];
        $this->_password->AdvancedSearch->SearchValue2 = @$filter["y__password"];
        $this->_password->AdvancedSearch->SearchOperator2 = @$filter["w__password"];
        $this->_password->AdvancedSearch->save();

        // Field nip
        $this->nip->AdvancedSearch->SearchValue = @$filter["x_nip"];
        $this->nip->AdvancedSearch->SearchOperator = @$filter["z_nip"];
        $this->nip->AdvancedSearch->SearchCondition = @$filter["v_nip"];
        $this->nip->AdvancedSearch->SearchValue2 = @$filter["y_nip"];
        $this->nip->AdvancedSearch->SearchOperator2 = @$filter["w_nip"];
        $this->nip->AdvancedSearch->save();

        // Field nama
        $this->nama->AdvancedSearch->SearchValue = @$filter["x_nama"];
        $this->nama->AdvancedSearch->SearchOperator = @$filter["z_nama"];
        $this->nama->AdvancedSearch->SearchCondition = @$filter["v_nama"];
        $this->nama->AdvancedSearch->SearchValue2 = @$filter["y_nama"];
        $this->nama->AdvancedSearch->SearchOperator2 = @$filter["w_nama"];
        $this->nama->AdvancedSearch->save();

        // Field alamat
        $this->alamat->AdvancedSearch->SearchValue = @$filter["x_alamat"];
        $this->alamat->AdvancedSearch->SearchOperator = @$filter["z_alamat"];
        $this->alamat->AdvancedSearch->SearchCondition = @$filter["v_alamat"];
        $this->alamat->AdvancedSearch->SearchValue2 = @$filter["y_alamat"];
        $this->alamat->AdvancedSearch->SearchOperator2 = @$filter["w_alamat"];
        $this->alamat->AdvancedSearch->save();

        // Field email
        $this->_email->AdvancedSearch->SearchValue = @$filter["x__email"];
        $this->_email->AdvancedSearch->SearchOperator = @$filter["z__email"];
        $this->_email->AdvancedSearch->SearchCondition = @$filter["v__email"];
        $this->_email->AdvancedSearch->SearchValue2 = @$filter["y__email"];
        $this->_email->AdvancedSearch->SearchOperator2 = @$filter["w__email"];
        $this->_email->AdvancedSearch->save();

        // Field wa
        $this->wa->AdvancedSearch->SearchValue = @$filter["x_wa"];
        $this->wa->AdvancedSearch->SearchOperator = @$filter["z_wa"];
        $this->wa->AdvancedSearch->SearchCondition = @$filter["v_wa"];
        $this->wa->AdvancedSearch->SearchValue2 = @$filter["y_wa"];
        $this->wa->AdvancedSearch->SearchOperator2 = @$filter["w_wa"];
        $this->wa->AdvancedSearch->save();

        // Field hp
        $this->hp->AdvancedSearch->SearchValue = @$filter["x_hp"];
        $this->hp->AdvancedSearch->SearchOperator = @$filter["z_hp"];
        $this->hp->AdvancedSearch->SearchCondition = @$filter["v_hp"];
        $this->hp->AdvancedSearch->SearchValue2 = @$filter["y_hp"];
        $this->hp->AdvancedSearch->SearchOperator2 = @$filter["w_hp"];
        $this->hp->AdvancedSearch->save();

        // Field tgllahir
        $this->tgllahir->AdvancedSearch->SearchValue = @$filter["x_tgllahir"];
        $this->tgllahir->AdvancedSearch->SearchOperator = @$filter["z_tgllahir"];
        $this->tgllahir->AdvancedSearch->SearchCondition = @$filter["v_tgllahir"];
        $this->tgllahir->AdvancedSearch->SearchValue2 = @$filter["y_tgllahir"];
        $this->tgllahir->AdvancedSearch->SearchOperator2 = @$filter["w_tgllahir"];
        $this->tgllahir->AdvancedSearch->save();

        // Field rekbank
        $this->rekbank->AdvancedSearch->SearchValue = @$filter["x_rekbank"];
        $this->rekbank->AdvancedSearch->SearchOperator = @$filter["z_rekbank"];
        $this->rekbank->AdvancedSearch->SearchCondition = @$filter["v_rekbank"];
        $this->rekbank->AdvancedSearch->SearchValue2 = @$filter["y_rekbank"];
        $this->rekbank->AdvancedSearch->SearchOperator2 = @$filter["w_rekbank"];
        $this->rekbank->AdvancedSearch->save();

        // Field jenjang_id
        $this->jenjang_id->AdvancedSearch->SearchValue = @$filter["x_jenjang_id"];
        $this->jenjang_id->AdvancedSearch->SearchOperator = @$filter["z_jenjang_id"];
        $this->jenjang_id->AdvancedSearch->SearchCondition = @$filter["v_jenjang_id"];
        $this->jenjang_id->AdvancedSearch->SearchValue2 = @$filter["y_jenjang_id"];
        $this->jenjang_id->AdvancedSearch->SearchOperator2 = @$filter["w_jenjang_id"];
        $this->jenjang_id->AdvancedSearch->save();

        // Field pendidikan
        $this->pendidikan->AdvancedSearch->SearchValue = @$filter["x_pendidikan"];
        $this->pendidikan->AdvancedSearch->SearchOperator = @$filter["z_pendidikan"];
        $this->pendidikan->AdvancedSearch->SearchCondition = @$filter["v_pendidikan"];
        $this->pendidikan->AdvancedSearch->SearchValue2 = @$filter["y_pendidikan"];
        $this->pendidikan->AdvancedSearch->SearchOperator2 = @$filter["w_pendidikan"];
        $this->pendidikan->AdvancedSearch->save();

        // Field jurusan
        $this->jurusan->AdvancedSearch->SearchValue = @$filter["x_jurusan"];
        $this->jurusan->AdvancedSearch->SearchOperator = @$filter["z_jurusan"];
        $this->jurusan->AdvancedSearch->SearchCondition = @$filter["v_jurusan"];
        $this->jurusan->AdvancedSearch->SearchValue2 = @$filter["y_jurusan"];
        $this->jurusan->AdvancedSearch->SearchOperator2 = @$filter["w_jurusan"];
        $this->jurusan->AdvancedSearch->save();

        // Field agama
        $this->agama->AdvancedSearch->SearchValue = @$filter["x_agama"];
        $this->agama->AdvancedSearch->SearchOperator = @$filter["z_agama"];
        $this->agama->AdvancedSearch->SearchCondition = @$filter["v_agama"];
        $this->agama->AdvancedSearch->SearchValue2 = @$filter["y_agama"];
        $this->agama->AdvancedSearch->SearchOperator2 = @$filter["w_agama"];
        $this->agama->AdvancedSearch->save();

        // Field jabatan
        $this->jabatan->AdvancedSearch->SearchValue = @$filter["x_jabatan"];
        $this->jabatan->AdvancedSearch->SearchOperator = @$filter["z_jabatan"];
        $this->jabatan->AdvancedSearch->SearchCondition = @$filter["v_jabatan"];
        $this->jabatan->AdvancedSearch->SearchValue2 = @$filter["y_jabatan"];
        $this->jabatan->AdvancedSearch->SearchOperator2 = @$filter["w_jabatan"];
        $this->jabatan->AdvancedSearch->save();

        // Field jenkel
        $this->jenkel->AdvancedSearch->SearchValue = @$filter["x_jenkel"];
        $this->jenkel->AdvancedSearch->SearchOperator = @$filter["z_jenkel"];
        $this->jenkel->AdvancedSearch->SearchCondition = @$filter["v_jenkel"];
        $this->jenkel->AdvancedSearch->SearchValue2 = @$filter["y_jenkel"];
        $this->jenkel->AdvancedSearch->SearchOperator2 = @$filter["w_jenkel"];
        $this->jenkel->AdvancedSearch->save();

        // Field mulai_bekerja
        $this->mulai_bekerja->AdvancedSearch->SearchValue = @$filter["x_mulai_bekerja"];
        $this->mulai_bekerja->AdvancedSearch->SearchOperator = @$filter["z_mulai_bekerja"];
        $this->mulai_bekerja->AdvancedSearch->SearchCondition = @$filter["v_mulai_bekerja"];
        $this->mulai_bekerja->AdvancedSearch->SearchValue2 = @$filter["y_mulai_bekerja"];
        $this->mulai_bekerja->AdvancedSearch->SearchOperator2 = @$filter["w_mulai_bekerja"];
        $this->mulai_bekerja->AdvancedSearch->save();

        // Field status
        $this->status->AdvancedSearch->SearchValue = @$filter["x_status"];
        $this->status->AdvancedSearch->SearchOperator = @$filter["z_status"];
        $this->status->AdvancedSearch->SearchCondition = @$filter["v_status"];
        $this->status->AdvancedSearch->SearchValue2 = @$filter["y_status"];
        $this->status->AdvancedSearch->SearchOperator2 = @$filter["w_status"];
        $this->status->AdvancedSearch->save();

        // Field keterangan
        $this->keterangan->AdvancedSearch->SearchValue = @$filter["x_keterangan"];
        $this->keterangan->AdvancedSearch->SearchOperator = @$filter["z_keterangan"];
        $this->keterangan->AdvancedSearch->SearchCondition = @$filter["v_keterangan"];
        $this->keterangan->AdvancedSearch->SearchValue2 = @$filter["y_keterangan"];
        $this->keterangan->AdvancedSearch->SearchOperator2 = @$filter["w_keterangan"];
        $this->keterangan->AdvancedSearch->save();

        // Field level
        $this->level->AdvancedSearch->SearchValue = @$filter["x_level"];
        $this->level->AdvancedSearch->SearchOperator = @$filter["z_level"];
        $this->level->AdvancedSearch->SearchCondition = @$filter["v_level"];
        $this->level->AdvancedSearch->SearchValue2 = @$filter["y_level"];
        $this->level->AdvancedSearch->SearchOperator2 = @$filter["w_level"];
        $this->level->AdvancedSearch->save();

        // Field aktif
        $this->aktif->AdvancedSearch->SearchValue = @$filter["x_aktif"];
        $this->aktif->AdvancedSearch->SearchOperator = @$filter["z_aktif"];
        $this->aktif->AdvancedSearch->SearchCondition = @$filter["v_aktif"];
        $this->aktif->AdvancedSearch->SearchValue2 = @$filter["y_aktif"];
        $this->aktif->AdvancedSearch->SearchOperator2 = @$filter["w_aktif"];
        $this->aktif->AdvancedSearch->save();

        // Field foto
        $this->foto->AdvancedSearch->SearchValue = @$filter["x_foto"];
        $this->foto->AdvancedSearch->SearchOperator = @$filter["z_foto"];
        $this->foto->AdvancedSearch->SearchCondition = @$filter["v_foto"];
        $this->foto->AdvancedSearch->SearchValue2 = @$filter["y_foto"];
        $this->foto->AdvancedSearch->SearchOperator2 = @$filter["w_foto"];
        $this->foto->AdvancedSearch->save();

        // Field file_cv
        $this->file_cv->AdvancedSearch->SearchValue = @$filter["x_file_cv"];
        $this->file_cv->AdvancedSearch->SearchOperator = @$filter["z_file_cv"];
        $this->file_cv->AdvancedSearch->SearchCondition = @$filter["v_file_cv"];
        $this->file_cv->AdvancedSearch->SearchValue2 = @$filter["y_file_cv"];
        $this->file_cv->AdvancedSearch->SearchOperator2 = @$filter["w_file_cv"];
        $this->file_cv->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
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
        $searchFlds[] = &$this->_username;
        $searchFlds[] = &$this->_password;
        $searchFlds[] = &$this->nama;
        $searchFlds[] = &$this->alamat;
        $searchFlds[] = &$this->_email;
        $searchFlds[] = &$this->wa;
        $searchFlds[] = &$this->hp;
        $searchFlds[] = &$this->rekbank;
        $searchFlds[] = &$this->pendidikan;
        $searchFlds[] = &$this->jurusan;
        $searchFlds[] = &$this->agama;
        $searchFlds[] = &$this->jabatan;
        $searchFlds[] = &$this->jenkel;
        $searchFlds[] = &$this->status;
        $searchFlds[] = &$this->keterangan;
        $searchFlds[] = &$this->foto;
        $searchFlds[] = &$this->file_cv;
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

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();
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
            $this->updateSort($this->_username); // username
            $this->updateSort($this->_password); // password
            $this->updateSort($this->nip); // nip
            $this->updateSort($this->nama); // nama
            $this->updateSort($this->alamat); // alamat
            $this->updateSort($this->_email); // email
            $this->updateSort($this->wa); // wa
            $this->updateSort($this->hp); // hp
            $this->updateSort($this->tgllahir); // tgllahir
            $this->updateSort($this->rekbank); // rekbank
            $this->updateSort($this->jenjang_id); // jenjang_id
            $this->updateSort($this->pendidikan); // pendidikan
            $this->updateSort($this->jurusan); // jurusan
            $this->updateSort($this->agama); // agama
            $this->updateSort($this->jabatan); // jabatan
            $this->updateSort($this->jenkel); // jenkel
            $this->updateSort($this->mulai_bekerja); // mulai_bekerja
            $this->updateSort($this->status); // status
            $this->updateSort($this->keterangan); // keterangan
            $this->updateSort($this->level); // level
            $this->updateSort($this->aktif); // aktif
            $this->updateSort($this->foto); // foto
            $this->updateSort($this->file_cv); // file_cv
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
                $this->pid->setSort("");
                $this->_username->setSort("");
                $this->_password->setSort("");
                $this->nip->setSort("");
                $this->nama->setSort("");
                $this->alamat->setSort("");
                $this->_email->setSort("");
                $this->wa->setSort("");
                $this->hp->setSort("");
                $this->tgllahir->setSort("");
                $this->rekbank->setSort("");
                $this->jenjang_id->setSort("");
                $this->pendidikan->setSort("");
                $this->jurusan->setSort("");
                $this->agama->setSort("");
                $this->jabatan->setSort("");
                $this->jenkel->setSort("");
                $this->mulai_bekerja->setSort("");
                $this->status->setSort("");
                $this->keterangan->setSort("");
                $this->level->setSort("");
                $this->aktif->setSort("");
                $this->foto->setSort("");
                $this->file_cv->setSort("");
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

        // "detail_peg_dokumen"
        $item = &$this->ListOptions->add("detail_peg_dokumen");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'peg_dokumen');
        $item->OnLeft = true;
        $item->ShowInButtonGroup = false;

        // "detail_peg_keluarga"
        $item = &$this->ListOptions->add("detail_peg_keluarga");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'peg_keluarga');
        $item->OnLeft = true;
        $item->ShowInButtonGroup = false;

        // "detail_peg_skill"
        $item = &$this->ListOptions->add("detail_peg_skill");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->allowList(CurrentProjectID() . 'peg_skill');
        $item->OnLeft = true;
        $item->ShowInButtonGroup = false;

        // Multiple details
        if ($this->ShowMultipleDetails) {
            $item = &$this->ListOptions->add("details");
            $item->CssClass = "text-nowrap";
            $item->Visible = $this->ShowMultipleDetails && $this->ListOptions->detailVisible();
            $item->OnLeft = true;
            $item->ShowInButtonGroup = false;
            $this->ListOptions->hideDetailItems();
        }

        // Set up detail pages
        $pages = new SubPages();
        $pages->add("peg_dokumen");
        $pages->add("peg_keluarga");
        $pages->add("peg_skill");
        $this->DetailPages = $pages;

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
                    $link = "<li><button type=\"button\" class=\"dropdown-item ew-action ew-list-action\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fpegawailist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button></li>";
                    if ($link != "") {
                        $links[] = $link;
                        if ($body == "") { // Setup first button
                            $body = "<button type=\"button\" class=\"btn btn-default ew-action ew-list-action\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" data-ew-action=\"submit\" form=\"fpegawailist\" data-key=\"" . $this->keyToJson(true) . "\"" . $listaction->toDataAttrs() . ">" . $icon . $listaction->Caption . "</button>";
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
        $detailViewTblVar = "";
        $detailCopyTblVar = "";
        $detailEditTblVar = "";

        // "detail_peg_dokumen"
        $opt = $this->ListOptions["detail_peg_dokumen"];
        if ($Security->allowList(CurrentProjectID() . 'peg_dokumen')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("peg_dokumen", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("PegDokumenList?" . Config("TABLE_SHOW_MASTER") . "=pegawai&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("PegDokumenGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailViewLink", null);
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=peg_dokumen");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "peg_dokumen";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailEditLink", null);
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=peg_dokumen");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "peg_dokumen";
            }
            if ($detailPage->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailCopyLink", null);
                $url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=peg_dokumen");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailCopyTblVar != "") {
                    $detailCopyTblVar .= ",";
                }
                $detailCopyTblVar .= "peg_dokumen";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-bs-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_peg_keluarga"
        $opt = $this->ListOptions["detail_peg_keluarga"];
        if ($Security->allowList(CurrentProjectID() . 'peg_keluarga')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("peg_keluarga", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("PegKeluargaList?" . Config("TABLE_SHOW_MASTER") . "=pegawai&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("PegKeluargaGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailViewLink", null);
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=peg_keluarga");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "peg_keluarga";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailEditLink", null);
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=peg_keluarga");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "peg_keluarga";
            }
            if ($detailPage->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailCopyLink", null);
                $url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=peg_keluarga");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailCopyTblVar != "") {
                    $detailCopyTblVar .= ",";
                }
                $detailCopyTblVar .= "peg_keluarga";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-bs-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }

        // "detail_peg_skill"
        $opt = $this->ListOptions["detail_peg_skill"];
        if ($Security->allowList(CurrentProjectID() . 'peg_skill')) {
            $body = $Language->phrase("DetailLink") . $Language->TablePhrase("peg_skill", "TblCaption");
            $body = "<a class=\"btn btn-default ew-row-link ew-detail\" data-action=\"list\" href=\"" . HtmlEncode("PegSkillList?" . Config("TABLE_SHOW_MASTER") . "=pegawai&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue) . "") . "\">" . $body . "</a>";
            $links = "";
            $detailPage = Container("PegSkillGrid");
            if ($detailPage->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailViewLink", null);
                $url = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=peg_skill");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailViewTblVar != "") {
                    $detailViewTblVar .= ",";
                }
                $detailViewTblVar .= "peg_skill";
            }
            if ($detailPage->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailEditLink", null);
                $url = $this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=peg_skill");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailEditTblVar != "") {
                    $detailEditTblVar .= ",";
                }
                $detailEditTblVar .= "peg_skill";
            }
            if ($detailPage->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailCopyLink", null);
                $url = $this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=peg_skill");
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode($url) . "\">" . $caption . "</a></li>";
                if ($detailCopyTblVar != "") {
                    $detailCopyTblVar .= ",";
                }
                $detailCopyTblVar .= "peg_skill";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-detail\" data-bs-toggle=\"dropdown\"></button>";
                $body .= "<ul class=\"dropdown-menu\">" . $links . "</ul>";
            }
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">" . $body . "</div>";
            $opt->Body = $body;
            if ($this->ShowMultipleDetails) {
                $opt->Visible = false;
            }
        }
        if ($this->ShowMultipleDetails) {
            $body = "<div class=\"btn-group btn-group-sm ew-btn-group\">";
            $links = "";
            if ($detailViewTblVar != "") {
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-view\" data-action=\"view\" data-caption=\"" . HtmlEncode($Language->phrase("MasterDetailViewLink", true)) . "\" href=\"" . HtmlEncode($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailViewTblVar)) . "\">" . $Language->phrase("MasterDetailViewLink", null) . "</a></li>";
            }
            if ($detailEditTblVar != "") {
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-edit\" data-action=\"edit\" data-caption=\"" . HtmlEncode($Language->phrase("MasterDetailEditLink", true)) . "\" href=\"" . HtmlEncode($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailEditTblVar)) . "\">" . $Language->phrase("MasterDetailEditLink", null) . "</a></li>";
            }
            if ($detailCopyTblVar != "") {
                $links .= "<li><a class=\"dropdown-item ew-row-link ew-detail-copy\" data-action=\"add\" data-caption=\"" . HtmlEncode($Language->phrase("MasterDetailCopyLink", true)) . "\" href=\"" . HtmlEncode($this->GetCopyUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailCopyTblVar)) . "\">" . $Language->phrase("MasterDetailCopyLink", null) . "</a></li>";
            }
            if ($links != "") {
                $body .= "<button class=\"dropdown-toggle btn btn-default ew-master-detail\" title=\"" . HtmlEncode($Language->phrase("MultipleMasterDetails", true)) . "\" data-bs-toggle=\"dropdown\">" . $Language->phrase("MultipleMasterDetails") . "</button>";
                $body .= "<ul class=\"dropdown-menu ew-menu\">" . $links . "</ul>";
            }
            $body .= "</div>";
            // Multiple details
            $opt = $this->ListOptions["details"];
            $opt->Body = $body;
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

        // Preview extension
        $links = "";
        $sqlwrk = "`pid`=" . AdjustSql($this->id->CurrentValue, $this->Dbid) . "";

        // Column "detail_peg_dokumen"
        if ($this->DetailPages && $this->DetailPages["peg_dokumen"] && $this->DetailPages["peg_dokumen"]->Visible && $Security->allowList(CurrentProjectID() . 'peg_dokumen')) {
            $link = "";
            $option = $this->ListOptions["detail_peg_dokumen"];
            $url = "PegDokumenPreview?t=pegawai&f=" . Encrypt($sqlwrk);
            $btngrp = "<div data-table=\"peg_dokumen\" data-url=\"" . $url . "\" class=\"ew-detail-btn-group d-none\">";
            if ($Security->allowList(CurrentProjectID() . 'pegawai')) {
                $label = $Language->TablePhrase("peg_dokumen", "TblCaption");
                $link = "<button class=\"nav-link\" data-bs-toggle=\"tab\" data-table=\"peg_dokumen\" data-url=\"" . $url . "\" type=\"button\" role=\"tab\" aria-selected=\"false\">" . $label . "</button>";
                $detaillnk = GetUrl("PegDokumenList?" . Config("TABLE_SHOW_MASTER") . "=pegawai&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue) . "");
                $title = $Language->TablePhrase("peg_dokumen", "TblCaption");
                $caption = $Language->phrase("MasterDetailListLink");
                $btngrp .= "<a href=\"#\" class=\"me-2\" title=\"" . $title . "\" data-ew-action=\"redirect\" data-url=\"" . HtmlEncode($detaillnk) . "\">" . $caption . "</a>";
            }
            $detailPageObj = Container("PegDokumenGrid");
            if ($detailPageObj->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = GetUrl($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=peg_dokumen"));
                $btngrp .= "<a href=\"#\" class=\"me-2\" title=\"" . HtmlTitle($caption) . "\" data-ew-action=\"redirect\" data-url=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = GetUrl($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=peg_dokumen"));
                $btngrp .= "<a href=\"#\" class=\"me-2\" title=\"" . HtmlTitle($caption) . "\" data-ew-action=\"redirect\" data-url=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailCopyLink");
                $url = GetUrl($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=peg_dokumen"));
                $btngrp .= "<a href=\"#\" class=\"me-2\" title=\"" . HtmlTitle($caption) . "\" data-ew-action=\"redirect\" data-url=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
            }
            $btngrp .= "</div>";
            if ($link != "") {
                $link = "<li class=\"nav-item\">" . $btngrp . $link . "</li>";  // Note: Place $btngrp before $link
                $links .= $link;
                $option->Body .= "<div class=\"ew-preview d-none\">" . $link . "</div>";
            }
        }
        $sqlwrk = "`pid`=" . AdjustSql($this->id->CurrentValue, $this->Dbid) . "";

        // Column "detail_peg_keluarga"
        if ($this->DetailPages && $this->DetailPages["peg_keluarga"] && $this->DetailPages["peg_keluarga"]->Visible && $Security->allowList(CurrentProjectID() . 'peg_keluarga')) {
            $link = "";
            $option = $this->ListOptions["detail_peg_keluarga"];
            $url = "PegKeluargaPreview?t=pegawai&f=" . Encrypt($sqlwrk);
            $btngrp = "<div data-table=\"peg_keluarga\" data-url=\"" . $url . "\" class=\"ew-detail-btn-group d-none\">";
            if ($Security->allowList(CurrentProjectID() . 'pegawai')) {
                $label = $Language->TablePhrase("peg_keluarga", "TblCaption");
                $link = "<button class=\"nav-link\" data-bs-toggle=\"tab\" data-table=\"peg_keluarga\" data-url=\"" . $url . "\" type=\"button\" role=\"tab\" aria-selected=\"false\">" . $label . "</button>";
                $detaillnk = GetUrl("PegKeluargaList?" . Config("TABLE_SHOW_MASTER") . "=pegawai&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue) . "");
                $title = $Language->TablePhrase("peg_keluarga", "TblCaption");
                $caption = $Language->phrase("MasterDetailListLink");
                $btngrp .= "<a href=\"#\" class=\"me-2\" title=\"" . $title . "\" data-ew-action=\"redirect\" data-url=\"" . HtmlEncode($detaillnk) . "\">" . $caption . "</a>";
            }
            $detailPageObj = Container("PegKeluargaGrid");
            if ($detailPageObj->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = GetUrl($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=peg_keluarga"));
                $btngrp .= "<a href=\"#\" class=\"me-2\" title=\"" . HtmlTitle($caption) . "\" data-ew-action=\"redirect\" data-url=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = GetUrl($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=peg_keluarga"));
                $btngrp .= "<a href=\"#\" class=\"me-2\" title=\"" . HtmlTitle($caption) . "\" data-ew-action=\"redirect\" data-url=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailCopyLink");
                $url = GetUrl($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=peg_keluarga"));
                $btngrp .= "<a href=\"#\" class=\"me-2\" title=\"" . HtmlTitle($caption) . "\" data-ew-action=\"redirect\" data-url=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
            }
            $btngrp .= "</div>";
            if ($link != "") {
                $link = "<li class=\"nav-item\">" . $btngrp . $link . "</li>";  // Note: Place $btngrp before $link
                $links .= $link;
                $option->Body .= "<div class=\"ew-preview d-none\">" . $link . "</div>";
            }
        }
        $sqlwrk = "`pid`=" . AdjustSql($this->id->CurrentValue, $this->Dbid) . "";

        // Column "detail_peg_skill"
        if ($this->DetailPages && $this->DetailPages["peg_skill"] && $this->DetailPages["peg_skill"]->Visible && $Security->allowList(CurrentProjectID() . 'peg_skill')) {
            $link = "";
            $option = $this->ListOptions["detail_peg_skill"];
            $url = "PegSkillPreview?t=pegawai&f=" . Encrypt($sqlwrk);
            $btngrp = "<div data-table=\"peg_skill\" data-url=\"" . $url . "\" class=\"ew-detail-btn-group d-none\">";
            if ($Security->allowList(CurrentProjectID() . 'pegawai')) {
                $label = $Language->TablePhrase("peg_skill", "TblCaption");
                $link = "<button class=\"nav-link\" data-bs-toggle=\"tab\" data-table=\"peg_skill\" data-url=\"" . $url . "\" type=\"button\" role=\"tab\" aria-selected=\"false\">" . $label . "</button>";
                $detaillnk = GetUrl("PegSkillList?" . Config("TABLE_SHOW_MASTER") . "=pegawai&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue) . "");
                $title = $Language->TablePhrase("peg_skill", "TblCaption");
                $caption = $Language->phrase("MasterDetailListLink");
                $btngrp .= "<a href=\"#\" class=\"me-2\" title=\"" . $title . "\" data-ew-action=\"redirect\" data-url=\"" . HtmlEncode($detaillnk) . "\">" . $caption . "</a>";
            }
            $detailPageObj = Container("PegSkillGrid");
            if ($detailPageObj->DetailView && $Security->canView() && $Security->allowView(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailViewLink");
                $url = GetUrl($this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=peg_skill"));
                $btngrp .= "<a href=\"#\" class=\"me-2\" title=\"" . HtmlTitle($caption) . "\" data-ew-action=\"redirect\" data-url=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailEdit && $Security->canEdit() && $Security->allowEdit(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailEditLink");
                $url = GetUrl($this->getEditUrl(Config("TABLE_SHOW_DETAIL") . "=peg_skill"));
                $btngrp .= "<a href=\"#\" class=\"me-2\" title=\"" . HtmlTitle($caption) . "\" data-ew-action=\"redirect\" data-url=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
            }
            if ($detailPageObj->DetailAdd && $Security->canAdd() && $Security->allowAdd(CurrentProjectID() . 'pegawai')) {
                $caption = $Language->phrase("MasterDetailCopyLink");
                $url = GetUrl($this->getCopyUrl(Config("TABLE_SHOW_DETAIL") . "=peg_skill"));
                $btngrp .= "<a href=\"#\" class=\"me-2\" title=\"" . HtmlTitle($caption) . "\" data-ew-action=\"redirect\" data-url=\"" . HtmlEncode($url) . "\">" . $caption . "</a>";
            }
            $btngrp .= "</div>";
            if ($link != "") {
                $link = "<li class=\"nav-item\">" . $btngrp . $link . "</li>";  // Note: Place $btngrp before $link
                $links .= $link;
                $option->Body .= "<div class=\"ew-preview d-none\">" . $link . "</div>";
            }
        }

        // Add row attributes for expandable row
        if ($this->RowType == ROWTYPE_VIEW) {
            $this->RowAttrs["data-widget"] = "expandable-table";
            $this->RowAttrs["aria-expanded"] = "false";
        }

        // Column "preview"
        $option = $this->ListOptions["preview"];
        if (!$option) { // Add preview column
            $option = &$this->ListOptions->add("preview");
            $option->OnLeft = true;
            if ($option->OnLeft) {
                $option->moveTo($this->ListOptions->itemPos("checkbox") + 1);
            } else {
                $option->moveTo($this->ListOptions->itemPos("checkbox"));
            }
            $option->Visible = !($this->isExport() || $this->isGridAdd() || $this->isGridEdit());
            $option->ShowInDropDown = false;
            $option->ShowInButtonGroup = false;
        }
        if ($option) {
            $option->CssStyle = "width: 1%;";
            $icon = "fas fa-caret-right"; // Right
            if (!$option->OnLeft) {
                $icon = preg_replace('/\\bright\\b/', "left", $icon);
            }
            if (IsRTL()) { // Reverse
                if (preg_match('/\\bleft\\b/', $icon)) {
                    $icon = preg_replace('/\\bleft\\b/', "right", $icon);
                } elseif (preg_match('/\\bright\\b/', $icon)) {
                    $icon = preg_replace('/\\bright\\b/', "left", $icon);
                }
            }
            $option->Body = "<i role=\"button\" class=\"ew-preview-btn expandable-table-caret ew-icon " . $icon . "\"></i>" .
                "<div class=\"ew-preview d-none\">" . $links . "</div>";
            if ($option->Visible) {
                $option->Visible = $links != "";
            }
        }

        // Column "details" (Multiple details)
        $option = $this->ListOptions["details"];
        if ($option) {
            $option->Body .= "<div class=\"ew-preview d-none\">" . $links . "</div>";
            if ($option->Visible) {
                $option->Visible = $links != "";
            }
        }
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
        $option = $options["detail"];
        $detailTableLink = "";
                $item = &$option->add("detailadd_peg_dokumen");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=peg_dokumen");
                $detailPage = Container("PegDokumenGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'pegawai') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "peg_dokumen";
                }
                $item = &$option->add("detailadd_peg_keluarga");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=peg_keluarga");
                $detailPage = Container("PegKeluargaGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'pegawai') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "peg_keluarga";
                }
                $item = &$option->add("detailadd_peg_skill");
                $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=peg_skill");
                $detailPage = Container("PegSkillGrid");
                $caption = $Language->phrase("Add") . "&nbsp;" . $this->tableCaption() . "/" . $detailPage->tableCaption();
                $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
                $item->Visible = ($detailPage->DetailAdd && $Security->allowAdd(CurrentProjectID() . 'pegawai') && $Security->canAdd());
                if ($item->Visible) {
                    if ($detailTableLink != "") {
                        $detailTableLink .= ",";
                    }
                    $detailTableLink .= "peg_skill";
                }

        // Add multiple details
        if ($this->ShowMultipleDetails) {
            $item = &$option->add("detailsadd");
            $url = $this->getAddUrl(Config("TABLE_SHOW_DETAIL") . "=" . $detailTableLink);
            $caption = $Language->phrase("AddMasterDetailLink");
            $item->Body = "<a class=\"ew-detail-add-group ew-detail-add\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"" . HtmlEncode(GetUrl($url)) . "\">" . $caption . "</a>";
            $item->Visible = $detailTableLink != "" && $Security->canAdd();
            // Hide single master/detail items
            $ar = explode(",", $detailTableLink);
            $cnt = count($ar);
            for ($i = 0; $i < $cnt; $i++) {
                if ($item = $option["detailadd_" . $ar[$i]]) {
                    $item->Visible = false;
                }
            }
        }
        $option = $options["action"];

        // Show column list for column visibility
        if ($this->UseColumnVisibility) {
            $option = $this->OtherOptions["column"];
            $item = &$option->addGroupOption();
            $item->Body = "";
            $item->Visible = $this->UseColumnVisibility;
            $option->add("username", $this->createColumnOption("username"));
            $option->add("password", $this->createColumnOption("password"));
            $option->add("nip", $this->createColumnOption("nip"));
            $option->add("nama", $this->createColumnOption("nama"));
            $option->add("alamat", $this->createColumnOption("alamat"));
            $option->add("email", $this->createColumnOption("email"));
            $option->add("wa", $this->createColumnOption("wa"));
            $option->add("hp", $this->createColumnOption("hp"));
            $option->add("tgllahir", $this->createColumnOption("tgllahir"));
            $option->add("rekbank", $this->createColumnOption("rekbank"));
            $option->add("jenjang_id", $this->createColumnOption("jenjang_id"));
            $option->add("pendidikan", $this->createColumnOption("pendidikan"));
            $option->add("jurusan", $this->createColumnOption("jurusan"));
            $option->add("agama", $this->createColumnOption("agama"));
            $option->add("jabatan", $this->createColumnOption("jabatan"));
            $option->add("jenkel", $this->createColumnOption("jenkel"));
            $option->add("mulai_bekerja", $this->createColumnOption("mulai_bekerja"));
            $option->add("status", $this->createColumnOption("status"));
            $option->add("keterangan", $this->createColumnOption("keterangan"));
            $option->add("level", $this->createColumnOption("level"));
            $option->add("aktif", $this->createColumnOption("aktif"));
            $option->add("foto", $this->createColumnOption("foto"));
            $option->add("file_cv", $this->createColumnOption("file_cv"));
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fpegawaisrch\" data-ew-action=\"none\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fpegawaisrch\" data-ew-action=\"none\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<button type="button" class="btn btn-default ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" data-ew-action="submit" form="fpegawailist"' . $listaction->toDataAttrs() . '>' . $icon . '</button>';
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
                    $user = GetUserInfo(Config("LOGIN_USERNAME_FIELD_NAME"), $row);
                    if ($userlist != "") {
                        $userlist .= ",";
                    }
                    $userlist .= $user;
                    if ($userAction == "resendregisteremail") {
                        $processed = false;
                    } elseif ($userAction == "resetconcurrentuser") {
                        $processed = false;
                    } elseif ($userAction == "resetloginretry") {
                        $processed = false;
                    } elseif ($userAction == "setpasswordexpired") {
                        $processed = false;
                    } elseif ($userAction == "resetusersecret") {
                        $processed = false;
                    } else {
                        $processed = $this->rowCustomAction($userAction, $row);
                     }
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
        $this->_username->setDbValue($row['username']);
        $this->_password->setDbValue($row['password']);
        $this->nip->setDbValue($row['nip']);
        $this->nama->setDbValue($row['nama']);
        $this->alamat->setDbValue($row['alamat']);
        $this->_email->setDbValue($row['email']);
        $this->wa->setDbValue($row['wa']);
        $this->hp->setDbValue($row['hp']);
        $this->tgllahir->setDbValue($row['tgllahir']);
        $this->rekbank->setDbValue($row['rekbank']);
        $this->jenjang_id->setDbValue($row['jenjang_id']);
        $this->pendidikan->setDbValue($row['pendidikan']);
        $this->jurusan->setDbValue($row['jurusan']);
        $this->agama->setDbValue($row['agama']);
        $this->jabatan->setDbValue($row['jabatan']);
        $this->jenkel->setDbValue($row['jenkel']);
        $this->mulai_bekerja->setDbValue($row['mulai_bekerja']);
        $this->status->setDbValue($row['status']);
        $this->keterangan->setDbValue($row['keterangan']);
        $this->level->setDbValue($row['level']);
        $this->aktif->setDbValue($row['aktif']);
        $this->foto->Upload->DbValue = $row['foto'];
        $this->foto->setDbValue($this->foto->Upload->DbValue);
        $this->file_cv->Upload->DbValue = $row['file_cv'];
        $this->file_cv->setDbValue($this->file_cv->Upload->DbValue);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['pid'] = $this->pid->DefaultValue;
        $row['username'] = $this->_username->DefaultValue;
        $row['password'] = $this->_password->DefaultValue;
        $row['nip'] = $this->nip->DefaultValue;
        $row['nama'] = $this->nama->DefaultValue;
        $row['alamat'] = $this->alamat->DefaultValue;
        $row['email'] = $this->_email->DefaultValue;
        $row['wa'] = $this->wa->DefaultValue;
        $row['hp'] = $this->hp->DefaultValue;
        $row['tgllahir'] = $this->tgllahir->DefaultValue;
        $row['rekbank'] = $this->rekbank->DefaultValue;
        $row['jenjang_id'] = $this->jenjang_id->DefaultValue;
        $row['pendidikan'] = $this->pendidikan->DefaultValue;
        $row['jurusan'] = $this->jurusan->DefaultValue;
        $row['agama'] = $this->agama->DefaultValue;
        $row['jabatan'] = $this->jabatan->DefaultValue;
        $row['jenkel'] = $this->jenkel->DefaultValue;
        $row['mulai_bekerja'] = $this->mulai_bekerja->DefaultValue;
        $row['status'] = $this->status->DefaultValue;
        $row['keterangan'] = $this->keterangan->DefaultValue;
        $row['level'] = $this->level->DefaultValue;
        $row['aktif'] = $this->aktif->DefaultValue;
        $row['foto'] = $this->foto->DefaultValue;
        $row['file_cv'] = $this->file_cv->DefaultValue;
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

        // pid

        // username

        // password

        // nip

        // nama

        // alamat

        // email

        // wa

        // hp

        // tgllahir

        // rekbank

        // jenjang_id

        // pendidikan

        // jurusan

        // agama

        // jabatan

        // jenkel

        // mulai_bekerja

        // status

        // keterangan

        // level

        // aktif

        // foto

        // file_cv

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // pid
            $this->pid->ViewValue = $this->pid->CurrentValue;
            $this->pid->ViewValue = FormatNumber($this->pid->ViewValue, $this->pid->formatPattern());
            $this->pid->ViewCustomAttributes = "";

            // username
            $this->_username->ViewValue = $this->_username->CurrentValue;
            $this->_username->ViewCustomAttributes = "";

            // password
            $this->_password->ViewValue = $this->_password->CurrentValue;
            $this->_password->ViewCustomAttributes = "";

            // nip
            $this->nip->ViewValue = $this->nip->CurrentValue;
            $this->nip->ViewCustomAttributes = "";

            // nama
            $this->nama->ViewValue = $this->nama->CurrentValue;
            $this->nama->ViewCustomAttributes = "";

            // alamat
            $this->alamat->ViewValue = $this->alamat->CurrentValue;
            $this->alamat->ViewCustomAttributes = "";

            // email
            $this->_email->ViewValue = $this->_email->CurrentValue;
            $this->_email->ViewCustomAttributes = "";

            // wa
            $this->wa->ViewValue = $this->wa->CurrentValue;
            $this->wa->ViewCustomAttributes = "";

            // hp
            $this->hp->ViewValue = $this->hp->CurrentValue;
            $this->hp->ViewCustomAttributes = "";

            // tgllahir
            $this->tgllahir->ViewValue = $this->tgllahir->CurrentValue;
            $this->tgllahir->ViewValue = FormatDateTime($this->tgllahir->ViewValue, $this->tgllahir->formatPattern());
            $this->tgllahir->ViewCustomAttributes = "";

            // rekbank
            $this->rekbank->ViewValue = $this->rekbank->CurrentValue;
            $this->rekbank->ViewCustomAttributes = "";

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

            // pendidikan
            $this->pendidikan->ViewValue = $this->pendidikan->CurrentValue;
            $curVal = strval($this->pendidikan->CurrentValue);
            if ($curVal != "") {
                $this->pendidikan->ViewValue = $this->pendidikan->lookupCacheOption($curVal);
                if ($this->pendidikan->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->pendidikan->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->pendidikan->Lookup->renderViewRow($rswrk[0]);
                        $this->pendidikan->ViewValue = $this->pendidikan->displayValue($arwrk);
                    } else {
                        $this->pendidikan->ViewValue = FormatNumber($this->pendidikan->CurrentValue, $this->pendidikan->formatPattern());
                    }
                }
            } else {
                $this->pendidikan->ViewValue = null;
            }
            $this->pendidikan->ViewCustomAttributes = "";

            // jurusan
            $this->jurusan->ViewValue = $this->jurusan->CurrentValue;
            $this->jurusan->ViewCustomAttributes = "";

            // agama
            $this->agama->ViewValue = $this->agama->CurrentValue;
            $curVal = strval($this->agama->CurrentValue);
            if ($curVal != "") {
                $this->agama->ViewValue = $this->agama->lookupCacheOption($curVal);
                if ($this->agama->ViewValue === null) { // Lookup from database
                    $filterWrk = "`name`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->agama->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->agama->Lookup->renderViewRow($rswrk[0]);
                        $this->agama->ViewValue = $this->agama->displayValue($arwrk);
                    } else {
                        $this->agama->ViewValue = $this->agama->CurrentValue;
                    }
                }
            } else {
                $this->agama->ViewValue = null;
            }
            $this->agama->ViewCustomAttributes = "";

            // jabatan
            $this->jabatan->ViewValue = $this->jabatan->CurrentValue;
            $curVal = strval($this->jabatan->CurrentValue);
            if ($curVal != "") {
                $this->jabatan->ViewValue = $this->jabatan->lookupCacheOption($curVal);
                if ($this->jabatan->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $sqlWrk = $this->jabatan->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->jabatan->Lookup->renderViewRow($rswrk[0]);
                        $this->jabatan->ViewValue = $this->jabatan->displayValue($arwrk);
                    } else {
                        $this->jabatan->ViewValue = FormatNumber($this->jabatan->CurrentValue, $this->jabatan->formatPattern());
                    }
                }
            } else {
                $this->jabatan->ViewValue = null;
            }
            $this->jabatan->ViewCustomAttributes = "";

            // jenkel
            $curVal = strval($this->jenkel->CurrentValue);
            if ($curVal != "") {
                $this->jenkel->ViewValue = $this->jenkel->lookupCacheOption($curVal);
                if ($this->jenkel->ViewValue === null) { // Lookup from database
                    $filterWrk = "`gen`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->jenkel->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $conn = Conn();
                    $config = $conn->getConfiguration();
                    $config->setResultCacheImpl($this->Cache);
                    $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->jenkel->Lookup->renderViewRow($rswrk[0]);
                        $this->jenkel->ViewValue = $this->jenkel->displayValue($arwrk);
                    } else {
                        $this->jenkel->ViewValue = $this->jenkel->CurrentValue;
                    }
                }
            } else {
                $this->jenkel->ViewValue = null;
            }
            $this->jenkel->ViewCustomAttributes = "";

            // mulai_bekerja
            $this->mulai_bekerja->ViewValue = $this->mulai_bekerja->CurrentValue;
            $this->mulai_bekerja->ViewValue = FormatDateTime($this->mulai_bekerja->ViewValue, $this->mulai_bekerja->formatPattern());
            $this->mulai_bekerja->ViewCustomAttributes = "";

            // status
            $this->status->ViewValue = $this->status->CurrentValue;
            $this->status->ViewCustomAttributes = "";

            // keterangan
            $this->keterangan->ViewValue = $this->keterangan->CurrentValue;
            $this->keterangan->ViewCustomAttributes = "";

            // level
            if ($Security->canAdmin()) { // System admin
                $curVal = strval($this->level->CurrentValue);
                if ($curVal != "") {
                    $this->level->ViewValue = $this->level->lookupCacheOption($curVal);
                    if ($this->level->ViewValue === null) { // Lookup from database
                        $filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                        $sqlWrk = $this->level->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                        $conn = Conn();
                        $config = $conn->getConfiguration();
                        $config->setResultCacheImpl($this->Cache);
                        $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                        $ari = count($rswrk);
                        if ($ari > 0) { // Lookup values found
                            $arwrk = $this->level->Lookup->renderViewRow($rswrk[0]);
                            $this->level->ViewValue = $this->level->displayValue($arwrk);
                        } else {
                            $this->level->ViewValue = FormatNumber($this->level->CurrentValue, $this->level->formatPattern());
                        }
                    }
                } else {
                    $this->level->ViewValue = null;
                }
            } else {
                $this->level->ViewValue = $Language->phrase("PasswordMask");
            }
            $this->level->ViewCustomAttributes = "";

            // aktif
            $this->aktif->ViewValue = $this->aktif->CurrentValue;
            $this->aktif->ViewValue = FormatNumber($this->aktif->ViewValue, $this->aktif->formatPattern());
            $this->aktif->ViewCustomAttributes = "";

            // foto
            $this->foto->UploadPath = "file_foto";
            if (!EmptyValue($this->foto->Upload->DbValue)) {
                $this->foto->ViewValue = $this->foto->Upload->DbValue;
            } else {
                $this->foto->ViewValue = "";
            }
            $this->foto->ViewCustomAttributes = "";

            // file_cv
            $this->file_cv->UploadPath = "file_cv";
            if (!EmptyValue($this->file_cv->Upload->DbValue)) {
                $this->file_cv->ViewValue = $this->file_cv->Upload->DbValue;
            } else {
                $this->file_cv->ViewValue = "";
            }
            $this->file_cv->ViewCustomAttributes = "";

            // username
            $this->_username->LinkCustomAttributes = "";
            $this->_username->HrefValue = "";
            $this->_username->TooltipValue = "";

            // password
            $this->_password->LinkCustomAttributes = "";
            $this->_password->HrefValue = "";
            $this->_password->TooltipValue = "";

            // nip
            $this->nip->LinkCustomAttributes = "";
            $this->nip->HrefValue = "";
            $this->nip->TooltipValue = "";

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";
            $this->nama->TooltipValue = "";

            // alamat
            $this->alamat->LinkCustomAttributes = "";
            $this->alamat->HrefValue = "";
            $this->alamat->TooltipValue = "";

            // email
            $this->_email->LinkCustomAttributes = "";
            $this->_email->HrefValue = "";
            $this->_email->TooltipValue = "";

            // wa
            $this->wa->LinkCustomAttributes = "";
            $this->wa->HrefValue = "";
            $this->wa->TooltipValue = "";

            // hp
            $this->hp->LinkCustomAttributes = "";
            $this->hp->HrefValue = "";
            $this->hp->TooltipValue = "";

            // tgllahir
            $this->tgllahir->LinkCustomAttributes = "";
            $this->tgllahir->HrefValue = "";
            $this->tgllahir->TooltipValue = "";

            // rekbank
            $this->rekbank->LinkCustomAttributes = "";
            $this->rekbank->HrefValue = "";
            $this->rekbank->TooltipValue = "";

            // jenjang_id
            $this->jenjang_id->LinkCustomAttributes = "";
            $this->jenjang_id->HrefValue = "";
            $this->jenjang_id->TooltipValue = "";

            // pendidikan
            $this->pendidikan->LinkCustomAttributes = "";
            $this->pendidikan->HrefValue = "";
            $this->pendidikan->TooltipValue = "";

            // jurusan
            $this->jurusan->LinkCustomAttributes = "";
            $this->jurusan->HrefValue = "";
            $this->jurusan->TooltipValue = "";

            // agama
            $this->agama->LinkCustomAttributes = "";
            $this->agama->HrefValue = "";
            $this->agama->TooltipValue = "";

            // jabatan
            $this->jabatan->LinkCustomAttributes = "";
            $this->jabatan->HrefValue = "";
            $this->jabatan->TooltipValue = "";

            // jenkel
            $this->jenkel->LinkCustomAttributes = "";
            $this->jenkel->HrefValue = "";
            $this->jenkel->TooltipValue = "";

            // mulai_bekerja
            $this->mulai_bekerja->LinkCustomAttributes = "";
            $this->mulai_bekerja->HrefValue = "";
            $this->mulai_bekerja->TooltipValue = "";

            // status
            $this->status->LinkCustomAttributes = "";
            $this->status->HrefValue = "";
            $this->status->TooltipValue = "";

            // keterangan
            $this->keterangan->LinkCustomAttributes = "";
            $this->keterangan->HrefValue = "";
            $this->keterangan->TooltipValue = "";

            // level
            $this->level->LinkCustomAttributes = "";
            $this->level->HrefValue = "";
            $this->level->TooltipValue = "";

            // aktif
            $this->aktif->LinkCustomAttributes = "";
            $this->aktif->HrefValue = "";
            $this->aktif->TooltipValue = "";

            // foto
            $this->foto->LinkCustomAttributes = "";
            $this->foto->HrefValue = "";
            $this->foto->ExportHrefValue = $this->foto->UploadPath . $this->foto->Upload->DbValue;
            $this->foto->TooltipValue = "";

            // file_cv
            $this->file_cv->LinkCustomAttributes = "";
            $this->file_cv->HrefValue = "";
            $this->file_cv->ExportHrefValue = $this->file_cv->UploadPath . $this->file_cv->Upload->DbValue;
            $this->file_cv->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-ew-action=\"search-toggle\" data-form=\"fpegawaisrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
                case "x_jenjang_id":
                    break;
                case "x_pendidikan":
                    break;
                case "x_agama":
                    break;
                case "x_jabatan":
                    break;
                case "x_jenkel":
                    break;
                case "x_level":
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
