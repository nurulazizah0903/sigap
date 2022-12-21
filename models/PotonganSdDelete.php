<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PotonganSdDelete extends PotonganSd
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'potongan_sd';

    // Page object name
    public $PageObjName = "PotonganSdDelete";

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

        // Table object (potongan_sd)
        if (!isset($GLOBALS["potongan_sd"]) || get_class($GLOBALS["potongan_sd"]) == PROJECT_NAMESPACE . "potongan_sd") {
            $GLOBALS["potongan_sd"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'potongan_sd');
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
                $tbl = Container("potongan_sd");
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
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $TotalRecords = 0;
    public $RecordCount;
    public $RecKeys = [];
    public $StartRowCount = 1;
    public $RowCount = 0;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

        // Use layout
        $this->UseLayout = $this->UseLayout && ConvertToBool(Param("layout", true));
        $this->CurrentAction = Param("action"); // Set up current action
        $this->id->setVisibility();
        $this->month->setVisibility();
        $this->jenjang_id->setVisibility();
        $this->jabatan_id->setVisibility();
        $this->nama->setVisibility();
        $this->terlambat->setVisibility();
        $this->value_terlambat->setVisibility();
        $this->izin->setVisibility();
        $this->value_izin->setVisibility();
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
        $this->izinperjam->setVisibility();
        $this->izinperjamvalue->setVisibility();
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

        // Set up lookup cache
        $this->setupLookupOptions($this->u_by);

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("PotonganSdList"); // Prevent SQL injection, return to list
            return;
        }

        // Set up filter (WHERE Clause)
        $this->CurrentFilter = $filter;

        // Get action
        if (IsApi()) {
            $this->CurrentAction = "delete"; // Delete record directly
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action");
        } elseif (Get("action") == "1") {
            $this->CurrentAction = "delete"; // Delete record directly
        } else {
            $this->CurrentAction = "show"; // Display record
        }
        if ($this->isDelete()) {
            $this->SendEmail = true; // Send email on delete success
            if ($this->deleteRows()) { // Delete rows
                if ($this->getSuccessMessage() == "") {
                    $this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
                }
                if (IsApi()) {
                    $this->terminate(true);
                    return;
                } else {
                    $this->terminate($this->getReturnUrl()); // Return to caller
                    return;
                }
            } else { // Delete failed
                if (IsApi()) {
                    $this->terminate();
                    return;
                }
                $this->CurrentAction = "show"; // Display record
            }
        }
        if ($this->isShow()) { // Load records for display
            if ($this->Recordset = $this->loadRecordset()) {
                $this->TotalRecords = $this->Recordset->recordCount(); // Get record count
            }
            if ($this->TotalRecords <= 0) { // No record found, exit
                if ($this->Recordset) {
                    $this->Recordset->close();
                }
                $this->terminate("PotonganSdList"); // Return to list
                return;
            }
        }

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
        $this->jenjang_id->setDbValue($row['jenjang_id']);
        $this->jabatan_id->setDbValue($row['jabatan_id']);
        $this->nama->setDbValue($row['nama']);
        $this->terlambat->setDbValue($row['terlambat']);
        $this->value_terlambat->setDbValue($row['value_terlambat']);
        $this->izin->setDbValue($row['izin']);
        $this->value_izin->setDbValue($row['value_izin']);
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
        $this->izinperjam->setDbValue($row['izinperjam']);
        $this->izinperjamvalue->setDbValue($row['izinperjamvalue']);
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
        $row['jenjang_id'] = $this->jenjang_id->DefaultValue;
        $row['jabatan_id'] = $this->jabatan_id->DefaultValue;
        $row['nama'] = $this->nama->DefaultValue;
        $row['terlambat'] = $this->terlambat->DefaultValue;
        $row['value_terlambat'] = $this->value_terlambat->DefaultValue;
        $row['izin'] = $this->izin->DefaultValue;
        $row['value_izin'] = $this->value_izin->DefaultValue;
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
        $row['izinperjam'] = $this->izinperjam->DefaultValue;
        $row['izinperjamvalue'] = $this->izinperjamvalue->DefaultValue;
        $row['total'] = $this->total->DefaultValue;
        $row['u_by'] = $this->u_by->DefaultValue;
        $row['datetime'] = $this->datetime->DefaultValue;
        return $row;
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

        // month

        // jenjang_id

        // jabatan_id

        // nama

        // terlambat

        // value_terlambat

        // izin

        // value_izin

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

        // izinperjam

        // izinperjamvalue

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

            // jenjang_id
            $this->jenjang_id->ViewValue = $this->jenjang_id->CurrentValue;
            $this->jenjang_id->ViewValue = FormatNumber($this->jenjang_id->ViewValue, $this->jenjang_id->formatPattern());
            $this->jenjang_id->ViewCustomAttributes = "";

            // jabatan_id
            $this->jabatan_id->ViewValue = $this->jabatan_id->CurrentValue;
            $this->jabatan_id->ViewValue = FormatNumber($this->jabatan_id->ViewValue, $this->jabatan_id->formatPattern());
            $this->jabatan_id->ViewCustomAttributes = "";

            // nama
            $this->nama->ViewValue = $this->nama->CurrentValue;
            $this->nama->ViewCustomAttributes = "";

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

            // izinperjam
            $this->izinperjam->ViewValue = $this->izinperjam->CurrentValue;
            $this->izinperjam->ViewValue = FormatNumber($this->izinperjam->ViewValue, $this->izinperjam->formatPattern());
            $this->izinperjam->ViewCustomAttributes = "";

            // izinperjamvalue
            $this->izinperjamvalue->ViewValue = $this->izinperjamvalue->CurrentValue;
            $this->izinperjamvalue->ViewValue = FormatNumber($this->izinperjamvalue->ViewValue, $this->izinperjamvalue->formatPattern());
            $this->izinperjamvalue->ViewCustomAttributes = "";

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

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // month
            $this->month->LinkCustomAttributes = "";
            $this->month->HrefValue = "";
            $this->month->TooltipValue = "";

            // jenjang_id
            $this->jenjang_id->LinkCustomAttributes = "";
            $this->jenjang_id->HrefValue = "";
            $this->jenjang_id->TooltipValue = "";

            // jabatan_id
            $this->jabatan_id->LinkCustomAttributes = "";
            $this->jabatan_id->HrefValue = "";
            $this->jabatan_id->TooltipValue = "";

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";
            $this->nama->TooltipValue = "";

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

            // izinperjam
            $this->izinperjam->LinkCustomAttributes = "";
            $this->izinperjam->HrefValue = "";
            $this->izinperjam->TooltipValue = "";

            // izinperjamvalue
            $this->izinperjamvalue->LinkCustomAttributes = "";
            $this->izinperjamvalue->HrefValue = "";
            $this->izinperjamvalue->TooltipValue = "";

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
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
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
        if ($this->UseTransaction) {
            $conn->beginTransaction();
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
        if ($deleteRows) {
            if ($this->UseTransaction) { // Commit transaction
                $conn->commit();
            }

            // Set warning message if delete some records failed
            if (count($failKeys) > 0) {
                $this->setWarningMessage(str_replace("%k", explode(", ", $failKeys), $Language->phrase("DeleteSomeRecordsFailed")));
            }
        } else {
            if ($this->UseTransaction) { // Rollback transaction
                $conn->rollback();
            }
        }

        // Write JSON for API request
        if (IsApi() && $deleteRows) {
            $row = $this->getRecordsFromRecordset($rsold);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $deleteRows;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PotonganSdList"), "", $this->TableVar, true);
        $pageId = "delete";
        $Breadcrumb->add("delete", $pageId, $url);
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
}
