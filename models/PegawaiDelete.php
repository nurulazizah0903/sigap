<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class PegawaiDelete extends Pegawai
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'pegawai';

    // Page object name
    public $PageObjName = "PegawaiDelete";

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

        // Table object (pegawai)
        if (!isset($GLOBALS["pegawai"]) || get_class($GLOBALS["pegawai"]) == PROJECT_NAMESPACE . "pegawai") {
            $GLOBALS["pegawai"] = &$this;
        }

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

        // Set up lookup cache
        $this->setupLookupOptions($this->jenjang_id);
        $this->setupLookupOptions($this->pendidikan);
        $this->setupLookupOptions($this->agama);
        $this->setupLookupOptions($this->jabatan);
        $this->setupLookupOptions($this->jenkel);
        $this->setupLookupOptions($this->level);

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("PegawaiList"); // Prevent SQL injection, return to list
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
                $this->terminate("PegawaiList"); // Return to list
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

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("PegawaiList"), "", $this->TableVar, true);
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
