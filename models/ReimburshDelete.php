<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Page class
 */
class ReimburshDelete extends Reimbursh
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'reimbursh';

    // Page object name
    public $PageObjName = "ReimburshDelete";

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

        // Table object (reimbursh)
        if (!isset($GLOBALS["reimbursh"]) || get_class($GLOBALS["reimbursh"]) == PROJECT_NAMESPACE . "reimbursh") {
            $GLOBALS["reimbursh"] = &$this;
        }

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'reimbursh');
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
                $tbl = Container("reimbursh");
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
		        $this->bukti1->OldUploadPath = "file_reimburshbukti1";
		        $this->bukti1->UploadPath = $this->bukti1->OldUploadPath;
		        $this->bukti2->OldUploadPath = "file_reimburshbukti2";
		        $this->bukti2->UploadPath = $this->bukti2->OldUploadPath;
		        $this->bukti3->OldUploadPath = "file_reimburshbukti3";
		        $this->bukti3->UploadPath = $this->bukti3->OldUploadPath;
		        $this->bukti4->OldUploadPath = "file_reimburshbukti4";
		        $this->bukti4->UploadPath = $this->bukti4->OldUploadPath;
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
        $this->pegawai->setVisibility();
        $this->nama->setVisibility();
        $this->tgl->setVisibility();
        $this->total_pengajuan->setVisibility();
        $this->tgl_pengajuan->setVisibility();
        $this->jenis->setVisibility();
        $this->keterangan->Visible = false;
        $this->rek_tujuan->setVisibility();
        $this->disetujui->setVisibility();
        $this->pembayar->setVisibility();
        $this->terbayar->setVisibility();
        $this->tgl_pembayaran->setVisibility();
        $this->jumlah_dibayar->setVisibility();
        $this->bukti1->setVisibility();
        $this->bukti2->setVisibility();
        $this->bukti3->setVisibility();
        $this->bukti4->setVisibility();
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
        $this->setupLookupOptions($this->disetujui);

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("ReimburshList"); // Prevent SQL injection, return to list
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
                $this->terminate("ReimburshList"); // Return to list
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
        $this->pegawai->setDbValue($row['pegawai']);
        $this->nama->setDbValue($row['nama']);
        $this->tgl->setDbValue($row['tgl']);
        $this->total_pengajuan->setDbValue($row['total_pengajuan']);
        $this->tgl_pengajuan->setDbValue($row['tgl_pengajuan']);
        $this->jenis->setDbValue($row['jenis']);
        $this->keterangan->setDbValue($row['keterangan']);
        $this->rek_tujuan->setDbValue($row['rek_tujuan']);
        $this->disetujui->setDbValue($row['disetujui']);
        $this->pembayar->setDbValue($row['pembayar']);
        $this->terbayar->setDbValue($row['terbayar']);
        $this->tgl_pembayaran->setDbValue($row['tgl_pembayaran']);
        $this->jumlah_dibayar->setDbValue($row['jumlah_dibayar']);
        $this->bukti1->Upload->DbValue = $row['bukti1'];
        $this->bukti1->setDbValue($this->bukti1->Upload->DbValue);
        $this->bukti2->Upload->DbValue = $row['bukti2'];
        $this->bukti2->setDbValue($this->bukti2->Upload->DbValue);
        $this->bukti3->Upload->DbValue = $row['bukti3'];
        $this->bukti3->setDbValue($this->bukti3->Upload->DbValue);
        $this->bukti4->Upload->DbValue = $row['bukti4'];
        $this->bukti4->setDbValue($this->bukti4->Upload->DbValue);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = $this->id->DefaultValue;
        $row['pegawai'] = $this->pegawai->DefaultValue;
        $row['nama'] = $this->nama->DefaultValue;
        $row['tgl'] = $this->tgl->DefaultValue;
        $row['total_pengajuan'] = $this->total_pengajuan->DefaultValue;
        $row['tgl_pengajuan'] = $this->tgl_pengajuan->DefaultValue;
        $row['jenis'] = $this->jenis->DefaultValue;
        $row['keterangan'] = $this->keterangan->DefaultValue;
        $row['rek_tujuan'] = $this->rek_tujuan->DefaultValue;
        $row['disetujui'] = $this->disetujui->DefaultValue;
        $row['pembayar'] = $this->pembayar->DefaultValue;
        $row['terbayar'] = $this->terbayar->DefaultValue;
        $row['tgl_pembayaran'] = $this->tgl_pembayaran->DefaultValue;
        $row['jumlah_dibayar'] = $this->jumlah_dibayar->DefaultValue;
        $row['bukti1'] = $this->bukti1->DefaultValue;
        $row['bukti2'] = $this->bukti2->DefaultValue;
        $row['bukti3'] = $this->bukti3->DefaultValue;
        $row['bukti4'] = $this->bukti4->DefaultValue;
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

        // pegawai

        // nama

        // tgl

        // total_pengajuan

        // tgl_pengajuan

        // jenis

        // keterangan

        // rek_tujuan

        // disetujui

        // pembayar

        // terbayar

        // tgl_pembayaran

        // jumlah_dibayar

        // bukti1

        // bukti2

        // bukti3

        // bukti4

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

            // nama
            $this->nama->ViewValue = $this->nama->CurrentValue;
            $this->nama->ViewCustomAttributes = "";

            // tgl
            $this->tgl->ViewValue = $this->tgl->CurrentValue;
            $this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, $this->tgl->formatPattern());
            $this->tgl->ViewCustomAttributes = "";

            // total_pengajuan
            $this->total_pengajuan->ViewValue = $this->total_pengajuan->CurrentValue;
            $this->total_pengajuan->ViewValue = FormatNumber($this->total_pengajuan->ViewValue, $this->total_pengajuan->formatPattern());
            $this->total_pengajuan->ViewCustomAttributes = "";

            // tgl_pengajuan
            $this->tgl_pengajuan->ViewValue = $this->tgl_pengajuan->CurrentValue;
            $this->tgl_pengajuan->ViewValue = FormatDateTime($this->tgl_pengajuan->ViewValue, $this->tgl_pengajuan->formatPattern());
            $this->tgl_pengajuan->ViewCustomAttributes = "";

            // jenis
            $this->jenis->ViewValue = $this->jenis->CurrentValue;
            $this->jenis->ViewCustomAttributes = "";

            // rek_tujuan
            $this->rek_tujuan->ViewValue = $this->rek_tujuan->CurrentValue;
            $this->rek_tujuan->ViewCustomAttributes = "";

            // disetujui
            if (strval($this->disetujui->CurrentValue) != "") {
                $this->disetujui->ViewValue = $this->disetujui->optionCaption($this->disetujui->CurrentValue);
            } else {
                $this->disetujui->ViewValue = null;
            }
            $this->disetujui->ViewCustomAttributes = "";

            // pembayar
            $this->pembayar->ViewValue = $this->pembayar->CurrentValue;
            $this->pembayar->ViewCustomAttributes = "";

            // terbayar
            $this->terbayar->ViewValue = $this->terbayar->CurrentValue;
            $this->terbayar->ViewCustomAttributes = "";

            // tgl_pembayaran
            $this->tgl_pembayaran->ViewValue = $this->tgl_pembayaran->CurrentValue;
            $this->tgl_pembayaran->ViewValue = FormatDateTime($this->tgl_pembayaran->ViewValue, $this->tgl_pembayaran->formatPattern());
            $this->tgl_pembayaran->ViewCustomAttributes = "";

            // jumlah_dibayar
            $this->jumlah_dibayar->ViewValue = $this->jumlah_dibayar->CurrentValue;
            $this->jumlah_dibayar->ViewValue = FormatNumber($this->jumlah_dibayar->ViewValue, $this->jumlah_dibayar->formatPattern());
            $this->jumlah_dibayar->ViewCustomAttributes = "";

            // bukti1
            $this->bukti1->UploadPath = "file_reimburshbukti1";
            if (!EmptyValue($this->bukti1->Upload->DbValue)) {
                $this->bukti1->ViewValue = $this->bukti1->Upload->DbValue;
            } else {
                $this->bukti1->ViewValue = "";
            }
            $this->bukti1->ViewCustomAttributes = "";

            // bukti2
            $this->bukti2->UploadPath = "file_reimburshbukti2";
            if (!EmptyValue($this->bukti2->Upload->DbValue)) {
                $this->bukti2->ViewValue = $this->bukti2->Upload->DbValue;
            } else {
                $this->bukti2->ViewValue = "";
            }
            $this->bukti2->ViewCustomAttributes = "";

            // bukti3
            $this->bukti3->UploadPath = "file_reimburshbukti3";
            if (!EmptyValue($this->bukti3->Upload->DbValue)) {
                $this->bukti3->ViewValue = $this->bukti3->Upload->DbValue;
            } else {
                $this->bukti3->ViewValue = "";
            }
            $this->bukti3->ViewCustomAttributes = "";

            // bukti4
            $this->bukti4->UploadPath = "file_reimburshbukti4";
            if (!EmptyValue($this->bukti4->Upload->DbValue)) {
                $this->bukti4->ViewValue = $this->bukti4->Upload->DbValue;
            } else {
                $this->bukti4->ViewValue = "";
            }
            $this->bukti4->ViewCustomAttributes = "";

            // pegawai
            $this->pegawai->LinkCustomAttributes = "";
            $this->pegawai->HrefValue = "";
            $this->pegawai->TooltipValue = "";

            // nama
            $this->nama->LinkCustomAttributes = "";
            $this->nama->HrefValue = "";
            $this->nama->TooltipValue = "";

            // tgl
            $this->tgl->LinkCustomAttributes = "";
            $this->tgl->HrefValue = "";
            $this->tgl->TooltipValue = "";

            // total_pengajuan
            $this->total_pengajuan->LinkCustomAttributes = "";
            $this->total_pengajuan->HrefValue = "";
            $this->total_pengajuan->TooltipValue = "";

            // tgl_pengajuan
            $this->tgl_pengajuan->LinkCustomAttributes = "";
            $this->tgl_pengajuan->HrefValue = "";
            $this->tgl_pengajuan->TooltipValue = "";

            // jenis
            $this->jenis->LinkCustomAttributes = "";
            $this->jenis->HrefValue = "";
            $this->jenis->TooltipValue = "";

            // rek_tujuan
            $this->rek_tujuan->LinkCustomAttributes = "";
            $this->rek_tujuan->HrefValue = "";
            $this->rek_tujuan->TooltipValue = "";

            // disetujui
            $this->disetujui->LinkCustomAttributes = "";
            $this->disetujui->HrefValue = "";
            $this->disetujui->TooltipValue = "";

            // pembayar
            $this->pembayar->LinkCustomAttributes = "";
            $this->pembayar->HrefValue = "";
            $this->pembayar->TooltipValue = "";

            // terbayar
            $this->terbayar->LinkCustomAttributes = "";
            $this->terbayar->HrefValue = "";
            $this->terbayar->TooltipValue = "";

            // tgl_pembayaran
            $this->tgl_pembayaran->LinkCustomAttributes = "";
            $this->tgl_pembayaran->HrefValue = "";
            $this->tgl_pembayaran->TooltipValue = "";

            // jumlah_dibayar
            $this->jumlah_dibayar->LinkCustomAttributes = "";
            $this->jumlah_dibayar->HrefValue = "";
            $this->jumlah_dibayar->TooltipValue = "";

            // bukti1
            $this->bukti1->LinkCustomAttributes = "";
            $this->bukti1->HrefValue = "";
            $this->bukti1->ExportHrefValue = $this->bukti1->UploadPath . $this->bukti1->Upload->DbValue;
            $this->bukti1->TooltipValue = "";

            // bukti2
            $this->bukti2->LinkCustomAttributes = "";
            $this->bukti2->HrefValue = "";
            $this->bukti2->ExportHrefValue = $this->bukti2->UploadPath . $this->bukti2->Upload->DbValue;
            $this->bukti2->TooltipValue = "";

            // bukti3
            $this->bukti3->LinkCustomAttributes = "";
            $this->bukti3->HrefValue = "";
            $this->bukti3->ExportHrefValue = $this->bukti3->UploadPath . $this->bukti3->Upload->DbValue;
            $this->bukti3->TooltipValue = "";

            // bukti4
            $this->bukti4->LinkCustomAttributes = "";
            $this->bukti4->HrefValue = "";
            $this->bukti4->ExportHrefValue = $this->bukti4->UploadPath . $this->bukti4->Upload->DbValue;
            $this->bukti4->TooltipValue = "";
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("ReimburshList"), "", $this->TableVar, true);
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
                case "x_pegawai":
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
