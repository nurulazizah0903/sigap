<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class GajitunjanganGrid extends Gajitunjangan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "grid";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'gajitunjangan';

    // Page object name
    public $PageObjName = "GajitunjanganGrid";

    // View file path
    public $View = null;

    // Title
    public $Title = null; // Title for <title> tag

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fgajitunjangangrid";
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

        // Table object (gajitunjangan)
        if (!isset($GLOBALS["gajitunjangan"]) || get_class($GLOBALS["gajitunjangan"]) == PROJECT_NAMESPACE . "gajitunjangan") {
            $GLOBALS["gajitunjangan"] = &$this;
        }
        $this->AddUrl = "GajitunjanganAdd";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'gajitunjangan');
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
                $tbl = Container("gajitunjangan");
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
        $this->pidjabatan->Visible = false;
        $this->gapok->setVisibility();
        $this->value_kehadiran->setVisibility();
        $this->tunjangan_jabatan->setVisibility();
        $this->tunjangan_khusus->setVisibility();
        $this->reward->setVisibility();
        $this->lembur->setVisibility();
        $this->piket->setVisibility();
        $this->inval->setVisibility();
        $this->jam_lebih->setVisibility();
        $this->ekstrakuri->setVisibility();
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
        if ($this->CurrentMode != "add" && $this->DbMasterFilter != "" && $this->getCurrentMasterTable() == "jabatan") {
            $masterTbl = Container("jabatan");
            $rsmaster = $masterTbl->loadRs($this->DbMasterFilter)->fetchAssociative();
            $this->MasterRecordExists = $rsmaster !== false;
            if (!$this->MasterRecordExists) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
                $this->terminate("JabatanList"); // Return to master page
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
            $CurrentForm->hasValue("x_gapok") &&
            $CurrentForm->hasValue("o_gapok") &&
            $this->gapok->CurrentValue != $this->gapok->DefaultValue &&
            !($this->gapok->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->gapok->CurrentValue == $this->gapok->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_value_kehadiran") &&
            $CurrentForm->hasValue("o_value_kehadiran") &&
            $this->value_kehadiran->CurrentValue != $this->value_kehadiran->DefaultValue &&
            !($this->value_kehadiran->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->value_kehadiran->CurrentValue == $this->value_kehadiran->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_tunjangan_jabatan") &&
            $CurrentForm->hasValue("o_tunjangan_jabatan") &&
            $this->tunjangan_jabatan->CurrentValue != $this->tunjangan_jabatan->DefaultValue &&
            !($this->tunjangan_jabatan->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->tunjangan_jabatan->CurrentValue == $this->tunjangan_jabatan->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_tunjangan_khusus") &&
            $CurrentForm->hasValue("o_tunjangan_khusus") &&
            $this->tunjangan_khusus->CurrentValue != $this->tunjangan_khusus->DefaultValue &&
            !($this->tunjangan_khusus->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->tunjangan_khusus->CurrentValue == $this->tunjangan_khusus->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_reward") &&
            $CurrentForm->hasValue("o_reward") &&
            $this->reward->CurrentValue != $this->reward->DefaultValue &&
            !($this->reward->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->reward->CurrentValue == $this->reward->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_lembur") &&
            $CurrentForm->hasValue("o_lembur") &&
            $this->lembur->CurrentValue != $this->lembur->DefaultValue &&
            !($this->lembur->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->lembur->CurrentValue == $this->lembur->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_piket") &&
            $CurrentForm->hasValue("o_piket") &&
            $this->piket->CurrentValue != $this->piket->DefaultValue &&
            !($this->piket->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->piket->CurrentValue == $this->piket->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_inval") &&
            $CurrentForm->hasValue("o_inval") &&
            $this->inval->CurrentValue != $this->inval->DefaultValue &&
            !($this->inval->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->inval->CurrentValue == $this->inval->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_jam_lebih") &&
            $CurrentForm->hasValue("o_jam_lebih") &&
            $this->jam_lebih->CurrentValue != $this->jam_lebih->DefaultValue &&
            !($this->jam_lebih->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->jam_lebih->CurrentValue == $this->jam_lebih->getSessionValue())
        ) {
            return false;
        }
        if (
            $CurrentForm->hasValue("x_ekstrakuri") &&
            $CurrentForm->hasValue("o_ekstrakuri") &&
            $this->ekstrakuri->CurrentValue != $this->ekstrakuri->DefaultValue &&
            !($this->ekstrakuri->IsForeignKey && $this->getCurrentMasterTable() != "" &&
            $this->ekstrakuri->CurrentValue == $this->ekstrakuri->getSessionValue())
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
        $this->gapok->clearErrorMessage();
        $this->value_kehadiran->clearErrorMessage();
        $this->tunjangan_jabatan->clearErrorMessage();
        $this->tunjangan_khusus->clearErrorMessage();
        $this->reward->clearErrorMessage();
        $this->lembur->clearErrorMessage();
        $this->piket->clearErrorMessage();
        $this->inval->clearErrorMessage();
        $this->jam_lebih->clearErrorMessage();
        $this->ekstrakuri->clearErrorMessage();
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
                        $this->pidjabatan->setSessionValue("");
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

        // Check field name 'gapok' first before field var 'x_gapok'
        $val = $CurrentForm->hasValue("gapok") ? $CurrentForm->getValue("gapok") : $CurrentForm->getValue("x_gapok");
        if (!$this->gapok->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gapok->Visible = false; // Disable update for API request
            } else {
                $this->gapok->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_gapok")) {
            $this->gapok->setOldValue($CurrentForm->getValue("o_gapok"));
        }

        // Check field name 'value_kehadiran' first before field var 'x_value_kehadiran'
        $val = $CurrentForm->hasValue("value_kehadiran") ? $CurrentForm->getValue("value_kehadiran") : $CurrentForm->getValue("x_value_kehadiran");
        if (!$this->value_kehadiran->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->value_kehadiran->Visible = false; // Disable update for API request
            } else {
                $this->value_kehadiran->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_value_kehadiran")) {
            $this->value_kehadiran->setOldValue($CurrentForm->getValue("o_value_kehadiran"));
        }

        // Check field name 'tunjangan_jabatan' first before field var 'x_tunjangan_jabatan'
        $val = $CurrentForm->hasValue("tunjangan_jabatan") ? $CurrentForm->getValue("tunjangan_jabatan") : $CurrentForm->getValue("x_tunjangan_jabatan");
        if (!$this->tunjangan_jabatan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tunjangan_jabatan->Visible = false; // Disable update for API request
            } else {
                $this->tunjangan_jabatan->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_tunjangan_jabatan")) {
            $this->tunjangan_jabatan->setOldValue($CurrentForm->getValue("o_tunjangan_jabatan"));
        }

        // Check field name 'tunjangan_khusus' first before field var 'x_tunjangan_khusus'
        $val = $CurrentForm->hasValue("tunjangan_khusus") ? $CurrentForm->getValue("tunjangan_khusus") : $CurrentForm->getValue("x_tunjangan_khusus");
        if (!$this->tunjangan_khusus->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tunjangan_khusus->Visible = false; // Disable update for API request
            } else {
                $this->tunjangan_khusus->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_tunjangan_khusus")) {
            $this->tunjangan_khusus->setOldValue($CurrentForm->getValue("o_tunjangan_khusus"));
        }

        // Check field name 'reward' first before field var 'x_reward'
        $val = $CurrentForm->hasValue("reward") ? $CurrentForm->getValue("reward") : $CurrentForm->getValue("x_reward");
        if (!$this->reward->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->reward->Visible = false; // Disable update for API request
            } else {
                $this->reward->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_reward")) {
            $this->reward->setOldValue($CurrentForm->getValue("o_reward"));
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
        if ($CurrentForm->hasValue("o_lembur")) {
            $this->lembur->setOldValue($CurrentForm->getValue("o_lembur"));
        }

        // Check field name 'piket' first before field var 'x_piket'
        $val = $CurrentForm->hasValue("piket") ? $CurrentForm->getValue("piket") : $CurrentForm->getValue("x_piket");
        if (!$this->piket->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->piket->Visible = false; // Disable update for API request
            } else {
                $this->piket->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_piket")) {
            $this->piket->setOldValue($CurrentForm->getValue("o_piket"));
        }

        // Check field name 'inval' first before field var 'x_inval'
        $val = $CurrentForm->hasValue("inval") ? $CurrentForm->getValue("inval") : $CurrentForm->getValue("x_inval");
        if (!$this->inval->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->inval->Visible = false; // Disable update for API request
            } else {
                $this->inval->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_inval")) {
            $this->inval->setOldValue($CurrentForm->getValue("o_inval"));
        }

        // Check field name 'jam_lebih' first before field var 'x_jam_lebih'
        $val = $CurrentForm->hasValue("jam_lebih") ? $CurrentForm->getValue("jam_lebih") : $CurrentForm->getValue("x_jam_lebih");
        if (!$this->jam_lebih->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->jam_lebih->Visible = false; // Disable update for API request
            } else {
                $this->jam_lebih->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_jam_lebih")) {
            $this->jam_lebih->setOldValue($CurrentForm->getValue("o_jam_lebih"));
        }

        // Check field name 'ekstrakuri' first before field var 'x_ekstrakuri'
        $val = $CurrentForm->hasValue("ekstrakuri") ? $CurrentForm->getValue("ekstrakuri") : $CurrentForm->getValue("x_ekstrakuri");
        if (!$this->ekstrakuri->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ekstrakuri->Visible = false; // Disable update for API request
            } else {
                $this->ekstrakuri->setFormValue($val, true, $validate);
            }
        }
        if ($CurrentForm->hasValue("o_ekstrakuri")) {
            $this->ekstrakuri->setOldValue($CurrentForm->getValue("o_ekstrakuri"));
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
        $this->gapok->CurrentValue = $this->gapok->FormValue;
        $this->value_kehadiran->CurrentValue = $this->value_kehadiran->FormValue;
        $this->tunjangan_jabatan->CurrentValue = $this->tunjangan_jabatan->FormValue;
        $this->tunjangan_khusus->CurrentValue = $this->tunjangan_khusus->FormValue;
        $this->reward->CurrentValue = $this->reward->FormValue;
        $this->lembur->CurrentValue = $this->lembur->FormValue;
        $this->piket->CurrentValue = $this->piket->FormValue;
        $this->inval->CurrentValue = $this->inval->FormValue;
        $this->jam_lebih->CurrentValue = $this->jam_lebih->FormValue;
        $this->ekstrakuri->CurrentValue = $this->ekstrakuri->FormValue;
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
        $this->pidjabatan->setDbValue($row['pidjabatan']);
        $this->gapok->setDbValue($row['gapok']);
        $this->value_kehadiran->setDbValue($row['value_kehadiran']);
        $this->tunjangan_jabatan->setDbValue($row['tunjangan_jabatan']);
        $this->tunjangan_khusus->setDbValue($row['tunjangan_khusus']);
        $this->reward->setDbValue($row['reward']);
        $this->lembur->setDbValue($row['lembur']);
        $this->piket->setDbValue($row['piket']);
        $this->inval->setDbValue($row['inval']);
        $this->jam_lebih->setDbValue($row['jam_lebih']);
        $this->ekstrakuri->setDbValue($row['ekstrakuri']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['pidjabatan'] = $this->pidjabatan->DefaultValue;
        $row['gapok'] = $this->gapok->DefaultValue;
        $row['value_kehadiran'] = $this->value_kehadiran->DefaultValue;
        $row['tunjangan_jabatan'] = $this->tunjangan_jabatan->DefaultValue;
        $row['tunjangan_khusus'] = $this->tunjangan_khusus->DefaultValue;
        $row['reward'] = $this->reward->DefaultValue;
        $row['lembur'] = $this->lembur->DefaultValue;
        $row['piket'] = $this->piket->DefaultValue;
        $row['inval'] = $this->inval->DefaultValue;
        $row['jam_lebih'] = $this->jam_lebih->DefaultValue;
        $row['ekstrakuri'] = $this->ekstrakuri->DefaultValue;
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

        // pidjabatan

        // gapok

        // value_kehadiran

        // tunjangan_jabatan

        // tunjangan_khusus

        // reward

        // lembur

        // piket

        // inval

        // jam_lebih

        // ekstrakuri

        // View row
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // pidjabatan
            $this->pidjabatan->ViewValue = $this->pidjabatan->CurrentValue;
            $this->pidjabatan->ViewValue = FormatNumber($this->pidjabatan->ViewValue, $this->pidjabatan->formatPattern());
            $this->pidjabatan->ViewCustomAttributes = "";

            // gapok
            $this->gapok->ViewValue = $this->gapok->CurrentValue;
            $this->gapok->ViewValue = FormatNumber($this->gapok->ViewValue, $this->gapok->formatPattern());
            $this->gapok->ViewCustomAttributes = "";

            // value_kehadiran
            $this->value_kehadiran->ViewValue = $this->value_kehadiran->CurrentValue;
            $this->value_kehadiran->ViewValue = FormatNumber($this->value_kehadiran->ViewValue, $this->value_kehadiran->formatPattern());
            $this->value_kehadiran->ViewCustomAttributes = "";

            // tunjangan_jabatan
            $this->tunjangan_jabatan->ViewValue = $this->tunjangan_jabatan->CurrentValue;
            $this->tunjangan_jabatan->ViewValue = FormatNumber($this->tunjangan_jabatan->ViewValue, $this->tunjangan_jabatan->formatPattern());
            $this->tunjangan_jabatan->ViewCustomAttributes = "";

            // tunjangan_khusus
            $this->tunjangan_khusus->ViewValue = $this->tunjangan_khusus->CurrentValue;
            $this->tunjangan_khusus->ViewValue = FormatNumber($this->tunjangan_khusus->ViewValue, $this->tunjangan_khusus->formatPattern());
            $this->tunjangan_khusus->ViewCustomAttributes = "";

            // reward
            $this->reward->ViewValue = $this->reward->CurrentValue;
            $this->reward->ViewValue = FormatNumber($this->reward->ViewValue, $this->reward->formatPattern());
            $this->reward->ViewCustomAttributes = "";

            // lembur
            $this->lembur->ViewValue = $this->lembur->CurrentValue;
            $this->lembur->ViewValue = FormatNumber($this->lembur->ViewValue, $this->lembur->formatPattern());
            $this->lembur->ViewCustomAttributes = "";

            // piket
            $this->piket->ViewValue = $this->piket->CurrentValue;
            $this->piket->ViewValue = FormatNumber($this->piket->ViewValue, $this->piket->formatPattern());
            $this->piket->ViewCustomAttributes = "";

            // inval
            $this->inval->ViewValue = $this->inval->CurrentValue;
            $this->inval->ViewValue = FormatNumber($this->inval->ViewValue, $this->inval->formatPattern());
            $this->inval->ViewCustomAttributes = "";

            // jam_lebih
            $this->jam_lebih->ViewValue = $this->jam_lebih->CurrentValue;
            $this->jam_lebih->ViewValue = FormatNumber($this->jam_lebih->ViewValue, $this->jam_lebih->formatPattern());
            $this->jam_lebih->ViewCustomAttributes = "";

            // ekstrakuri
            $this->ekstrakuri->ViewValue = $this->ekstrakuri->CurrentValue;
            $this->ekstrakuri->ViewValue = FormatNumber($this->ekstrakuri->ViewValue, $this->ekstrakuri->formatPattern());
            $this->ekstrakuri->ViewCustomAttributes = "";

            // gapok
            $this->gapok->LinkCustomAttributes = "";
            $this->gapok->HrefValue = "";
            $this->gapok->TooltipValue = "";

            // value_kehadiran
            $this->value_kehadiran->LinkCustomAttributes = "";
            $this->value_kehadiran->HrefValue = "";
            $this->value_kehadiran->TooltipValue = "";

            // tunjangan_jabatan
            $this->tunjangan_jabatan->LinkCustomAttributes = "";
            $this->tunjangan_jabatan->HrefValue = "";
            $this->tunjangan_jabatan->TooltipValue = "";

            // tunjangan_khusus
            $this->tunjangan_khusus->LinkCustomAttributes = "";
            $this->tunjangan_khusus->HrefValue = "";
            $this->tunjangan_khusus->TooltipValue = "";

            // reward
            $this->reward->LinkCustomAttributes = "";
            $this->reward->HrefValue = "";
            $this->reward->TooltipValue = "";

            // lembur
            $this->lembur->LinkCustomAttributes = "";
            $this->lembur->HrefValue = "";
            $this->lembur->TooltipValue = "";

            // piket
            $this->piket->LinkCustomAttributes = "";
            $this->piket->HrefValue = "";
            $this->piket->TooltipValue = "";

            // inval
            $this->inval->LinkCustomAttributes = "";
            $this->inval->HrefValue = "";
            $this->inval->TooltipValue = "";

            // jam_lebih
            $this->jam_lebih->LinkCustomAttributes = "";
            $this->jam_lebih->HrefValue = "";
            $this->jam_lebih->TooltipValue = "";

            // ekstrakuri
            $this->ekstrakuri->LinkCustomAttributes = "";
            $this->ekstrakuri->HrefValue = "";
            $this->ekstrakuri->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // gapok
            $this->gapok->setupEditAttributes();
            $this->gapok->EditCustomAttributes = "";
            $this->gapok->EditValue = HtmlEncode($this->gapok->CurrentValue);
            $this->gapok->PlaceHolder = RemoveHtml($this->gapok->caption());
            if (strval($this->gapok->EditValue) != "" && is_numeric($this->gapok->EditValue)) {
                $this->gapok->EditValue = FormatNumber($this->gapok->EditValue, null);
                $this->gapok->OldValue = $this->gapok->EditValue;
            }

            // value_kehadiran
            $this->value_kehadiran->setupEditAttributes();
            $this->value_kehadiran->EditCustomAttributes = "";
            $this->value_kehadiran->EditValue = HtmlEncode($this->value_kehadiran->CurrentValue);
            $this->value_kehadiran->PlaceHolder = RemoveHtml($this->value_kehadiran->caption());
            if (strval($this->value_kehadiran->EditValue) != "" && is_numeric($this->value_kehadiran->EditValue)) {
                $this->value_kehadiran->EditValue = FormatNumber($this->value_kehadiran->EditValue, null);
                $this->value_kehadiran->OldValue = $this->value_kehadiran->EditValue;
            }

            // tunjangan_jabatan
            $this->tunjangan_jabatan->setupEditAttributes();
            $this->tunjangan_jabatan->EditCustomAttributes = "";
            $this->tunjangan_jabatan->EditValue = HtmlEncode($this->tunjangan_jabatan->CurrentValue);
            $this->tunjangan_jabatan->PlaceHolder = RemoveHtml($this->tunjangan_jabatan->caption());
            if (strval($this->tunjangan_jabatan->EditValue) != "" && is_numeric($this->tunjangan_jabatan->EditValue)) {
                $this->tunjangan_jabatan->EditValue = FormatNumber($this->tunjangan_jabatan->EditValue, null);
                $this->tunjangan_jabatan->OldValue = $this->tunjangan_jabatan->EditValue;
            }

            // tunjangan_khusus
            $this->tunjangan_khusus->setupEditAttributes();
            $this->tunjangan_khusus->EditCustomAttributes = "";
            $this->tunjangan_khusus->EditValue = HtmlEncode($this->tunjangan_khusus->CurrentValue);
            $this->tunjangan_khusus->PlaceHolder = RemoveHtml($this->tunjangan_khusus->caption());
            if (strval($this->tunjangan_khusus->EditValue) != "" && is_numeric($this->tunjangan_khusus->EditValue)) {
                $this->tunjangan_khusus->EditValue = FormatNumber($this->tunjangan_khusus->EditValue, null);
                $this->tunjangan_khusus->OldValue = $this->tunjangan_khusus->EditValue;
            }

            // reward
            $this->reward->setupEditAttributes();
            $this->reward->EditCustomAttributes = "";
            $this->reward->EditValue = HtmlEncode($this->reward->CurrentValue);
            $this->reward->PlaceHolder = RemoveHtml($this->reward->caption());
            if (strval($this->reward->EditValue) != "" && is_numeric($this->reward->EditValue)) {
                $this->reward->EditValue = FormatNumber($this->reward->EditValue, null);
                $this->reward->OldValue = $this->reward->EditValue;
            }

            // lembur
            $this->lembur->setupEditAttributes();
            $this->lembur->EditCustomAttributes = "";
            $this->lembur->EditValue = HtmlEncode($this->lembur->CurrentValue);
            $this->lembur->PlaceHolder = RemoveHtml($this->lembur->caption());
            if (strval($this->lembur->EditValue) != "" && is_numeric($this->lembur->EditValue)) {
                $this->lembur->EditValue = FormatNumber($this->lembur->EditValue, null);
                $this->lembur->OldValue = $this->lembur->EditValue;
            }

            // piket
            $this->piket->setupEditAttributes();
            $this->piket->EditCustomAttributes = "";
            $this->piket->EditValue = HtmlEncode($this->piket->CurrentValue);
            $this->piket->PlaceHolder = RemoveHtml($this->piket->caption());
            if (strval($this->piket->EditValue) != "" && is_numeric($this->piket->EditValue)) {
                $this->piket->EditValue = FormatNumber($this->piket->EditValue, null);
                $this->piket->OldValue = $this->piket->EditValue;
            }

            // inval
            $this->inval->setupEditAttributes();
            $this->inval->EditCustomAttributes = "";
            $this->inval->EditValue = HtmlEncode($this->inval->CurrentValue);
            $this->inval->PlaceHolder = RemoveHtml($this->inval->caption());
            if (strval($this->inval->EditValue) != "" && is_numeric($this->inval->EditValue)) {
                $this->inval->EditValue = FormatNumber($this->inval->EditValue, null);
                $this->inval->OldValue = $this->inval->EditValue;
            }

            // jam_lebih
            $this->jam_lebih->setupEditAttributes();
            $this->jam_lebih->EditCustomAttributes = "";
            $this->jam_lebih->EditValue = HtmlEncode($this->jam_lebih->CurrentValue);
            $this->jam_lebih->PlaceHolder = RemoveHtml($this->jam_lebih->caption());
            if (strval($this->jam_lebih->EditValue) != "" && is_numeric($this->jam_lebih->EditValue)) {
                $this->jam_lebih->EditValue = FormatNumber($this->jam_lebih->EditValue, null);
                $this->jam_lebih->OldValue = $this->jam_lebih->EditValue;
            }

            // ekstrakuri
            $this->ekstrakuri->setupEditAttributes();
            $this->ekstrakuri->EditCustomAttributes = "";
            $this->ekstrakuri->EditValue = HtmlEncode($this->ekstrakuri->CurrentValue);
            $this->ekstrakuri->PlaceHolder = RemoveHtml($this->ekstrakuri->caption());
            if (strval($this->ekstrakuri->EditValue) != "" && is_numeric($this->ekstrakuri->EditValue)) {
                $this->ekstrakuri->EditValue = FormatNumber($this->ekstrakuri->EditValue, null);
                $this->ekstrakuri->OldValue = $this->ekstrakuri->EditValue;
            }

            // Add refer script

            // gapok
            $this->gapok->LinkCustomAttributes = "";
            $this->gapok->HrefValue = "";

            // value_kehadiran
            $this->value_kehadiran->LinkCustomAttributes = "";
            $this->value_kehadiran->HrefValue = "";

            // tunjangan_jabatan
            $this->tunjangan_jabatan->LinkCustomAttributes = "";
            $this->tunjangan_jabatan->HrefValue = "";

            // tunjangan_khusus
            $this->tunjangan_khusus->LinkCustomAttributes = "";
            $this->tunjangan_khusus->HrefValue = "";

            // reward
            $this->reward->LinkCustomAttributes = "";
            $this->reward->HrefValue = "";

            // lembur
            $this->lembur->LinkCustomAttributes = "";
            $this->lembur->HrefValue = "";

            // piket
            $this->piket->LinkCustomAttributes = "";
            $this->piket->HrefValue = "";

            // inval
            $this->inval->LinkCustomAttributes = "";
            $this->inval->HrefValue = "";

            // jam_lebih
            $this->jam_lebih->LinkCustomAttributes = "";
            $this->jam_lebih->HrefValue = "";

            // ekstrakuri
            $this->ekstrakuri->LinkCustomAttributes = "";
            $this->ekstrakuri->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // gapok
            $this->gapok->setupEditAttributes();
            $this->gapok->EditCustomAttributes = "";
            $this->gapok->EditValue = HtmlEncode($this->gapok->CurrentValue);
            $this->gapok->PlaceHolder = RemoveHtml($this->gapok->caption());
            if (strval($this->gapok->EditValue) != "" && is_numeric($this->gapok->EditValue)) {
                $this->gapok->EditValue = FormatNumber($this->gapok->EditValue, null);
                $this->gapok->OldValue = $this->gapok->EditValue;
            }

            // value_kehadiran
            $this->value_kehadiran->setupEditAttributes();
            $this->value_kehadiran->EditCustomAttributes = "";
            $this->value_kehadiran->EditValue = HtmlEncode($this->value_kehadiran->CurrentValue);
            $this->value_kehadiran->PlaceHolder = RemoveHtml($this->value_kehadiran->caption());
            if (strval($this->value_kehadiran->EditValue) != "" && is_numeric($this->value_kehadiran->EditValue)) {
                $this->value_kehadiran->EditValue = FormatNumber($this->value_kehadiran->EditValue, null);
                $this->value_kehadiran->OldValue = $this->value_kehadiran->EditValue;
            }

            // tunjangan_jabatan
            $this->tunjangan_jabatan->setupEditAttributes();
            $this->tunjangan_jabatan->EditCustomAttributes = "";
            $this->tunjangan_jabatan->EditValue = HtmlEncode($this->tunjangan_jabatan->CurrentValue);
            $this->tunjangan_jabatan->PlaceHolder = RemoveHtml($this->tunjangan_jabatan->caption());
            if (strval($this->tunjangan_jabatan->EditValue) != "" && is_numeric($this->tunjangan_jabatan->EditValue)) {
                $this->tunjangan_jabatan->EditValue = FormatNumber($this->tunjangan_jabatan->EditValue, null);
                $this->tunjangan_jabatan->OldValue = $this->tunjangan_jabatan->EditValue;
            }

            // tunjangan_khusus
            $this->tunjangan_khusus->setupEditAttributes();
            $this->tunjangan_khusus->EditCustomAttributes = "";
            $this->tunjangan_khusus->EditValue = HtmlEncode($this->tunjangan_khusus->CurrentValue);
            $this->tunjangan_khusus->PlaceHolder = RemoveHtml($this->tunjangan_khusus->caption());
            if (strval($this->tunjangan_khusus->EditValue) != "" && is_numeric($this->tunjangan_khusus->EditValue)) {
                $this->tunjangan_khusus->EditValue = FormatNumber($this->tunjangan_khusus->EditValue, null);
                $this->tunjangan_khusus->OldValue = $this->tunjangan_khusus->EditValue;
            }

            // reward
            $this->reward->setupEditAttributes();
            $this->reward->EditCustomAttributes = "";
            $this->reward->EditValue = HtmlEncode($this->reward->CurrentValue);
            $this->reward->PlaceHolder = RemoveHtml($this->reward->caption());
            if (strval($this->reward->EditValue) != "" && is_numeric($this->reward->EditValue)) {
                $this->reward->EditValue = FormatNumber($this->reward->EditValue, null);
                $this->reward->OldValue = $this->reward->EditValue;
            }

            // lembur
            $this->lembur->setupEditAttributes();
            $this->lembur->EditCustomAttributes = "";
            $this->lembur->EditValue = HtmlEncode($this->lembur->CurrentValue);
            $this->lembur->PlaceHolder = RemoveHtml($this->lembur->caption());
            if (strval($this->lembur->EditValue) != "" && is_numeric($this->lembur->EditValue)) {
                $this->lembur->EditValue = FormatNumber($this->lembur->EditValue, null);
                $this->lembur->OldValue = $this->lembur->EditValue;
            }

            // piket
            $this->piket->setupEditAttributes();
            $this->piket->EditCustomAttributes = "";
            $this->piket->EditValue = HtmlEncode($this->piket->CurrentValue);
            $this->piket->PlaceHolder = RemoveHtml($this->piket->caption());
            if (strval($this->piket->EditValue) != "" && is_numeric($this->piket->EditValue)) {
                $this->piket->EditValue = FormatNumber($this->piket->EditValue, null);
                $this->piket->OldValue = $this->piket->EditValue;
            }

            // inval
            $this->inval->setupEditAttributes();
            $this->inval->EditCustomAttributes = "";
            $this->inval->EditValue = HtmlEncode($this->inval->CurrentValue);
            $this->inval->PlaceHolder = RemoveHtml($this->inval->caption());
            if (strval($this->inval->EditValue) != "" && is_numeric($this->inval->EditValue)) {
                $this->inval->EditValue = FormatNumber($this->inval->EditValue, null);
                $this->inval->OldValue = $this->inval->EditValue;
            }

            // jam_lebih
            $this->jam_lebih->setupEditAttributes();
            $this->jam_lebih->EditCustomAttributes = "";
            $this->jam_lebih->EditValue = HtmlEncode($this->jam_lebih->CurrentValue);
            $this->jam_lebih->PlaceHolder = RemoveHtml($this->jam_lebih->caption());
            if (strval($this->jam_lebih->EditValue) != "" && is_numeric($this->jam_lebih->EditValue)) {
                $this->jam_lebih->EditValue = FormatNumber($this->jam_lebih->EditValue, null);
                $this->jam_lebih->OldValue = $this->jam_lebih->EditValue;
            }

            // ekstrakuri
            $this->ekstrakuri->setupEditAttributes();
            $this->ekstrakuri->EditCustomAttributes = "";
            $this->ekstrakuri->EditValue = HtmlEncode($this->ekstrakuri->CurrentValue);
            $this->ekstrakuri->PlaceHolder = RemoveHtml($this->ekstrakuri->caption());
            if (strval($this->ekstrakuri->EditValue) != "" && is_numeric($this->ekstrakuri->EditValue)) {
                $this->ekstrakuri->EditValue = FormatNumber($this->ekstrakuri->EditValue, null);
                $this->ekstrakuri->OldValue = $this->ekstrakuri->EditValue;
            }

            // Edit refer script

            // gapok
            $this->gapok->LinkCustomAttributes = "";
            $this->gapok->HrefValue = "";

            // value_kehadiran
            $this->value_kehadiran->LinkCustomAttributes = "";
            $this->value_kehadiran->HrefValue = "";

            // tunjangan_jabatan
            $this->tunjangan_jabatan->LinkCustomAttributes = "";
            $this->tunjangan_jabatan->HrefValue = "";

            // tunjangan_khusus
            $this->tunjangan_khusus->LinkCustomAttributes = "";
            $this->tunjangan_khusus->HrefValue = "";

            // reward
            $this->reward->LinkCustomAttributes = "";
            $this->reward->HrefValue = "";

            // lembur
            $this->lembur->LinkCustomAttributes = "";
            $this->lembur->HrefValue = "";

            // piket
            $this->piket->LinkCustomAttributes = "";
            $this->piket->HrefValue = "";

            // inval
            $this->inval->LinkCustomAttributes = "";
            $this->inval->HrefValue = "";

            // jam_lebih
            $this->jam_lebih->LinkCustomAttributes = "";
            $this->jam_lebih->HrefValue = "";

            // ekstrakuri
            $this->ekstrakuri->LinkCustomAttributes = "";
            $this->ekstrakuri->HrefValue = "";
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
        if ($this->gapok->Required) {
            if (!$this->gapok->IsDetailKey && EmptyValue($this->gapok->FormValue)) {
                $this->gapok->addErrorMessage(str_replace("%s", $this->gapok->caption(), $this->gapok->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->gapok->FormValue)) {
            $this->gapok->addErrorMessage($this->gapok->getErrorMessage(false));
        }
        if ($this->value_kehadiran->Required) {
            if (!$this->value_kehadiran->IsDetailKey && EmptyValue($this->value_kehadiran->FormValue)) {
                $this->value_kehadiran->addErrorMessage(str_replace("%s", $this->value_kehadiran->caption(), $this->value_kehadiran->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->value_kehadiran->FormValue)) {
            $this->value_kehadiran->addErrorMessage($this->value_kehadiran->getErrorMessage(false));
        }
        if ($this->tunjangan_jabatan->Required) {
            if (!$this->tunjangan_jabatan->IsDetailKey && EmptyValue($this->tunjangan_jabatan->FormValue)) {
                $this->tunjangan_jabatan->addErrorMessage(str_replace("%s", $this->tunjangan_jabatan->caption(), $this->tunjangan_jabatan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->tunjangan_jabatan->FormValue)) {
            $this->tunjangan_jabatan->addErrorMessage($this->tunjangan_jabatan->getErrorMessage(false));
        }
        if ($this->tunjangan_khusus->Required) {
            if (!$this->tunjangan_khusus->IsDetailKey && EmptyValue($this->tunjangan_khusus->FormValue)) {
                $this->tunjangan_khusus->addErrorMessage(str_replace("%s", $this->tunjangan_khusus->caption(), $this->tunjangan_khusus->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->tunjangan_khusus->FormValue)) {
            $this->tunjangan_khusus->addErrorMessage($this->tunjangan_khusus->getErrorMessage(false));
        }
        if ($this->reward->Required) {
            if (!$this->reward->IsDetailKey && EmptyValue($this->reward->FormValue)) {
                $this->reward->addErrorMessage(str_replace("%s", $this->reward->caption(), $this->reward->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->reward->FormValue)) {
            $this->reward->addErrorMessage($this->reward->getErrorMessage(false));
        }
        if ($this->lembur->Required) {
            if (!$this->lembur->IsDetailKey && EmptyValue($this->lembur->FormValue)) {
                $this->lembur->addErrorMessage(str_replace("%s", $this->lembur->caption(), $this->lembur->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->lembur->FormValue)) {
            $this->lembur->addErrorMessage($this->lembur->getErrorMessage(false));
        }
        if ($this->piket->Required) {
            if (!$this->piket->IsDetailKey && EmptyValue($this->piket->FormValue)) {
                $this->piket->addErrorMessage(str_replace("%s", $this->piket->caption(), $this->piket->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->piket->FormValue)) {
            $this->piket->addErrorMessage($this->piket->getErrorMessage(false));
        }
        if ($this->inval->Required) {
            if (!$this->inval->IsDetailKey && EmptyValue($this->inval->FormValue)) {
                $this->inval->addErrorMessage(str_replace("%s", $this->inval->caption(), $this->inval->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->inval->FormValue)) {
            $this->inval->addErrorMessage($this->inval->getErrorMessage(false));
        }
        if ($this->jam_lebih->Required) {
            if (!$this->jam_lebih->IsDetailKey && EmptyValue($this->jam_lebih->FormValue)) {
                $this->jam_lebih->addErrorMessage(str_replace("%s", $this->jam_lebih->caption(), $this->jam_lebih->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->jam_lebih->FormValue)) {
            $this->jam_lebih->addErrorMessage($this->jam_lebih->getErrorMessage(false));
        }
        if ($this->ekstrakuri->Required) {
            if (!$this->ekstrakuri->IsDetailKey && EmptyValue($this->ekstrakuri->FormValue)) {
                $this->ekstrakuri->addErrorMessage(str_replace("%s", $this->ekstrakuri->caption(), $this->ekstrakuri->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->ekstrakuri->FormValue)) {
            $this->ekstrakuri->addErrorMessage($this->ekstrakuri->getErrorMessage(false));
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

        // gapok
        $this->gapok->setDbValueDef($rsnew, $this->gapok->CurrentValue, null, $this->gapok->ReadOnly);

        // value_kehadiran
        $this->value_kehadiran->setDbValueDef($rsnew, $this->value_kehadiran->CurrentValue, null, $this->value_kehadiran->ReadOnly);

        // tunjangan_jabatan
        $this->tunjangan_jabatan->setDbValueDef($rsnew, $this->tunjangan_jabatan->CurrentValue, null, $this->tunjangan_jabatan->ReadOnly);

        // tunjangan_khusus
        $this->tunjangan_khusus->setDbValueDef($rsnew, $this->tunjangan_khusus->CurrentValue, null, $this->tunjangan_khusus->ReadOnly);

        // reward
        $this->reward->setDbValueDef($rsnew, $this->reward->CurrentValue, null, $this->reward->ReadOnly);

        // lembur
        $this->lembur->setDbValueDef($rsnew, $this->lembur->CurrentValue, null, $this->lembur->ReadOnly);

        // piket
        $this->piket->setDbValueDef($rsnew, $this->piket->CurrentValue, null, $this->piket->ReadOnly);

        // inval
        $this->inval->setDbValueDef($rsnew, $this->inval->CurrentValue, null, $this->inval->ReadOnly);

        // jam_lebih
        $this->jam_lebih->setDbValueDef($rsnew, $this->jam_lebih->CurrentValue, null, $this->jam_lebih->ReadOnly);

        // ekstrakuri
        $this->ekstrakuri->setDbValueDef($rsnew, $this->ekstrakuri->CurrentValue, null, $this->ekstrakuri->ReadOnly);

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check referential integrity for master table 'jabatan'
        $detailKeys = [];
        $keyValue = $rsnew['pidjabatan'] ?? $rsold['pidjabatan'];
        $detailKeys['pidjabatan'] = $keyValue;
        $masterTable = Container("jabatan");
        $masterFilter = $this->getMasterFilter($masterTable, $detailKeys);
        if (!EmptyValue($masterFilter)) {
            $rsmaster = $masterTable->loadRs($masterFilter)->fetch();
            $validMasterRecord = $rsmaster !== false;
        } else { // Allow null value if not required field
            $validMasterRecord = $masterFilter === null;
        }
        if (!$validMasterRecord) {
            $relatedRecordMsg = str_replace("%t", "jabatan", $Language->phrase("RelatedRecordRequired"));
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
        if ($this->getCurrentMasterTable() == "jabatan") {
            $this->pidjabatan->CurrentValue = $this->pidjabatan->getSessionValue();
        }

        // Set new row
        $rsnew = [];

        // gapok
        $this->gapok->setDbValueDef($rsnew, $this->gapok->CurrentValue, null, false);

        // value_kehadiran
        $this->value_kehadiran->setDbValueDef($rsnew, $this->value_kehadiran->CurrentValue, null, false);

        // tunjangan_jabatan
        $this->tunjangan_jabatan->setDbValueDef($rsnew, $this->tunjangan_jabatan->CurrentValue, null, false);

        // tunjangan_khusus
        $this->tunjangan_khusus->setDbValueDef($rsnew, $this->tunjangan_khusus->CurrentValue, null, false);

        // reward
        $this->reward->setDbValueDef($rsnew, $this->reward->CurrentValue, null, false);

        // lembur
        $this->lembur->setDbValueDef($rsnew, $this->lembur->CurrentValue, null, false);

        // piket
        $this->piket->setDbValueDef($rsnew, $this->piket->CurrentValue, null, false);

        // inval
        $this->inval->setDbValueDef($rsnew, $this->inval->CurrentValue, null, false);

        // jam_lebih
        $this->jam_lebih->setDbValueDef($rsnew, $this->jam_lebih->CurrentValue, null, false);

        // ekstrakuri
        $this->ekstrakuri->setDbValueDef($rsnew, $this->ekstrakuri->CurrentValue, null, false);

        // pidjabatan
        if ($this->pidjabatan->getSessionValue() != "") {
            $rsnew['pidjabatan'] = $this->pidjabatan->getSessionValue();
        }

        // Update current values
        $this->setCurrentValues($rsnew);

        // Check referential integrity for master table 'gajitunjangan'
        $validMasterRecord = true;
        $detailKeys = [];
        $detailKeys["pidjabatan"] = $this->pidjabatan->getSessionValue();
        $masterTable = Container("jabatan");
        $masterFilter = $this->getMasterFilter($masterTable, $detailKeys);
        if (!EmptyValue($masterFilter)) {
            $rsmaster = $masterTable->loadRs($masterFilter)->fetch();
            $validMasterRecord = $rsmaster !== false;
        } else { // Allow null value if not required field
            $validMasterRecord = $masterFilter === null;
        }
        if (!$validMasterRecord) {
            $relatedRecordMsg = str_replace("%t", "jabatan", $Language->phrase("RelatedRecordRequired"));
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
        if ($masterTblVar == "jabatan") {
            $masterTbl = Container("jabatan");
            $this->pidjabatan->Visible = false;
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
