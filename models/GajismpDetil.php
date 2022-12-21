<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for gajismp_detil
 */
class GajismpDetil extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $id;
    public $pid;
    public $pegawai_id;
    public $jabatan_id;
    public $masakerja;
    public $jumngajar;
    public $ijin;
    public $tunjangan_wkosis;
    public $nominal_baku;
    public $baku;
    public $kehadiran;
    public $prestasi;
    public $jumlahgaji;
    public $jumgajitotal;
    public $potongan1;
    public $potongan2;
    public $jumlahterima;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'gajismp_detil';
        $this->TableName = 'gajismp_detil';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`gajismp_detil`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_DEFAULT; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = \PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4; // Page size (PhpSpreadsheet only)
        $this->ExportWordVersion = 12; // Word version (PHPWord only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordPageSize = "A4"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = true; // Allow detail add
        $this->DetailEdit = true; // Allow detail edit
        $this->DetailView = true; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 1;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // id
        $this->id = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_id',
            'id',
            '`id`',
            '`id`',
            3,
            11,
            -1,
            false,
            '`id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'NO'
        );
        $this->id->InputTextType = "text";
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // pid
        $this->pid = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_pid',
            'pid',
            '`pid`',
            '`pid`',
            3,
            11,
            -1,
            false,
            '`pid`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->pid->InputTextType = "text";
        $this->pid->IsForeignKey = true; // Foreign key field
        $this->pid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['pid'] = &$this->pid;

        // pegawai_id
        $this->pegawai_id = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_pegawai_id',
            'pegawai_id',
            '`pegawai_id`',
            '`pegawai_id`',
            3,
            11,
            -1,
            false,
            '`pegawai_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->pegawai_id->InputTextType = "text";
        $this->pegawai_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['pegawai_id'] = &$this->pegawai_id;

        // jabatan_id
        $this->jabatan_id = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_jabatan_id',
            'jabatan_id',
            '`jabatan_id`',
            '`jabatan_id`',
            3,
            11,
            -1,
            false,
            '`jabatan_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->jabatan_id->InputTextType = "text";
        $this->jabatan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jabatan_id'] = &$this->jabatan_id;

        // masakerja
        $this->masakerja = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_masakerja',
            'masakerja',
            '`masakerja`',
            '`masakerja`',
            2,
            6,
            -1,
            false,
            '`masakerja`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->masakerja->InputTextType = "text";
        $this->masakerja->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['masakerja'] = &$this->masakerja;

        // jumngajar
        $this->jumngajar = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_jumngajar',
            'jumngajar',
            '`jumngajar`',
            '`jumngajar`',
            2,
            6,
            -1,
            false,
            '`jumngajar`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->jumngajar->InputTextType = "text";
        $this->jumngajar->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jumngajar'] = &$this->jumngajar;

        // ijin
        $this->ijin = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_ijin',
            'ijin',
            '`ijin`',
            '`ijin`',
            2,
            6,
            -1,
            false,
            '`ijin`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->ijin->InputTextType = "text";
        $this->ijin->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['ijin'] = &$this->ijin;

        // tunjangan_wkosis
        $this->tunjangan_wkosis = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_tunjangan_wkosis',
            'tunjangan_wkosis',
            '`tunjangan_wkosis`',
            '`tunjangan_wkosis`',
            3,
            11,
            -1,
            false,
            '`tunjangan_wkosis`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tunjangan_wkosis->InputTextType = "text";
        $this->tunjangan_wkosis->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['tunjangan_wkosis'] = &$this->tunjangan_wkosis;

        // nominal_baku
        $this->nominal_baku = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_nominal_baku',
            'nominal_baku',
            '`nominal_baku`',
            '`nominal_baku`',
            3,
            11,
            -1,
            false,
            '`nominal_baku`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->nominal_baku->InputTextType = "text";
        $this->nominal_baku->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['nominal_baku'] = &$this->nominal_baku;

        // baku
        $this->baku = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_baku',
            'baku',
            '`baku`',
            '`baku`',
            3,
            11,
            -1,
            false,
            '`baku`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->baku->InputTextType = "text";
        $this->baku->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['baku'] = &$this->baku;

        // kehadiran
        $this->kehadiran = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_kehadiran',
            'kehadiran',
            '`kehadiran`',
            '`kehadiran`',
            3,
            11,
            -1,
            false,
            '`kehadiran`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->kehadiran->InputTextType = "text";
        $this->kehadiran->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['kehadiran'] = &$this->kehadiran;

        // prestasi
        $this->prestasi = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_prestasi',
            'prestasi',
            '`prestasi`',
            '`prestasi`',
            3,
            11,
            -1,
            false,
            '`prestasi`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->prestasi->InputTextType = "text";
        $this->prestasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['prestasi'] = &$this->prestasi;

        // jumlahgaji
        $this->jumlahgaji = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_jumlahgaji',
            'jumlahgaji',
            '`jumlahgaji`',
            '`jumlahgaji`',
            3,
            11,
            -1,
            false,
            '`jumlahgaji`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->jumlahgaji->InputTextType = "text";
        $this->jumlahgaji->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jumlahgaji'] = &$this->jumlahgaji;

        // jumgajitotal
        $this->jumgajitotal = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_jumgajitotal',
            'jumgajitotal',
            '`jumgajitotal`',
            '`jumgajitotal`',
            3,
            11,
            -1,
            false,
            '`jumgajitotal`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->jumgajitotal->InputTextType = "text";
        $this->jumgajitotal->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jumgajitotal'] = &$this->jumgajitotal;

        // potongan1
        $this->potongan1 = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_potongan1',
            'potongan1',
            '`potongan1`',
            '`potongan1`',
            3,
            11,
            -1,
            false,
            '`potongan1`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->potongan1->InputTextType = "text";
        $this->potongan1->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['potongan1'] = &$this->potongan1;

        // potongan2
        $this->potongan2 = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_potongan2',
            'potongan2',
            '`potongan2`',
            '`potongan2`',
            3,
            11,
            -1,
            false,
            '`potongan2`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->potongan2->InputTextType = "text";
        $this->potongan2->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['potongan2'] = &$this->potongan2;

        // jumlahterima
        $this->jumlahterima = new DbField(
            'gajismp_detil',
            'gajismp_detil',
            'x_jumlahterima',
            'jumlahterima',
            '`jumlahterima`',
            '`jumlahterima`',
            3,
            11,
            -1,
            false,
            '`jumlahterima`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->jumlahterima->InputTextType = "text";
        $this->jumlahterima->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jumlahterima'] = &$this->jumlahterima;

        // Add Doctrine Cache
        $this->Cache = new ArrayCache();
        $this->CacheProfile = new \Doctrine\DBAL\Cache\QueryCacheProfile(0, $this->TableVar);
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        }
    }

    // Update field sort
    public function updateFieldSort()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        $flds = GetSortFields($orderBy);
        foreach ($this->Fields as $field) {
            $fldSort = "";
            foreach ($flds as $fld) {
                if ($fld[0] == $field->Expression || $fld[0] == $field->VirtualExpression) {
                    $fldSort = $fld[1];
                }
            }
            $field->setSort($fldSort);
        }
    }

    // Current master table name
    public function getCurrentMasterTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE"));
    }

    public function setCurrentMasterTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
    }

    // Get master WHERE clause from session values
    public function getMasterFilterFromSession()
    {
        // Master filter
        $masterFilter = "";
        if ($this->getCurrentMasterTable() == "gajismp") {
            if ($this->pid->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("`id`", $this->pid->getSessionValue(), DATATYPE_NUMBER, "DB");
            } else {
                return "";
            }
        }
        return $masterFilter;
    }

    // Get detail WHERE clause from session values
    public function getDetailFilterFromSession()
    {
        // Detail filter
        $detailFilter = "";
        if ($this->getCurrentMasterTable() == "gajismp") {
            if ($this->pid->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("`pid`", $this->pid->getSessionValue(), DATATYPE_NUMBER, "DB");
            } else {
                return "";
            }
        }
        return $detailFilter;
    }

    /**
     * Get master filter
     *
     * @param object $masterTable Master Table
     * @param array $keys Detail Keys
     * @return mixed NULL is returned if all keys are empty, Empty string is returned if some keys are empty and is required
     */
    public function getMasterFilter($masterTable, $keys)
    {
        $validKeys = true;
        switch ($masterTable->TableVar) {
            case "gajismp":
                $key = $keys["pid"] ?? "";
                if (EmptyValue($key)) {
                    if ($masterTable->id->Required) { // Required field and empty value
                        return ""; // Return empty filter
                    }
                    $validKeys = false;
                } elseif (!$validKeys) { // Already has empty key
                    return ""; // Return empty filter
                }
                if ($validKeys) {
                    return "`id`=" . QuotedValue($keys["pid"], $masterTable->id->DataType, $masterTable->Dbid);
                }
                break;
        }
        return null; // All null values and no required fields
    }

    // Get detail filter
    public function getDetailFilter($masterTable)
    {
        switch ($masterTable->TableVar) {
            case "gajismp":
                return "`pid`=" . QuotedValue($masterTable->id->DbValue, $this->pid->DataType, $this->Dbid);
        }
        return "";
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`gajismp_detil`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "";
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter, $id = "")
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            case "lookup":
                return (($allow & 256) == 256);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $cnt = $conn->fetchOne($sqlwrk);
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    public function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
            // Get insert id if necessary
            $this->id->setDbValue($conn->lastInsertId());
            $rs['id'] = $this->id->DbValue;
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    public function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
            if (array_key_exists('id', $rs)) {
                AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
            }
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->id->DbValue = $row['id'];
        $this->pid->DbValue = $row['pid'];
        $this->pegawai_id->DbValue = $row['pegawai_id'];
        $this->jabatan_id->DbValue = $row['jabatan_id'];
        $this->masakerja->DbValue = $row['masakerja'];
        $this->jumngajar->DbValue = $row['jumngajar'];
        $this->ijin->DbValue = $row['ijin'];
        $this->tunjangan_wkosis->DbValue = $row['tunjangan_wkosis'];
        $this->nominal_baku->DbValue = $row['nominal_baku'];
        $this->baku->DbValue = $row['baku'];
        $this->kehadiran->DbValue = $row['kehadiran'];
        $this->prestasi->DbValue = $row['prestasi'];
        $this->jumlahgaji->DbValue = $row['jumlahgaji'];
        $this->jumgajitotal->DbValue = $row['jumgajitotal'];
        $this->potongan1->DbValue = $row['potongan1'];
        $this->potongan2->DbValue = $row['potongan2'];
        $this->jumlahterima->DbValue = $row['jumlahterima'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id` = @id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id->CurrentValue : $this->id->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->id->CurrentValue = $keys[0];
            } else {
                $this->id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id', $row) ? $row['id'] : null;
        } else {
            $val = $this->id->OldValue !== null ? $this->id->OldValue : $this->id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("GajismpDetilList");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "GajismpDetilView") {
            return $Language->phrase("View");
        } elseif ($pageName == "GajismpDetilEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "GajismpDetilAdd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "GajismpDetilView";
            case Config("API_ADD_ACTION"):
                return "GajismpDetilAdd";
            case Config("API_EDIT_ACTION"):
                return "GajismpDetilEdit";
            case Config("API_DELETE_ACTION"):
                return "GajismpDetilDelete";
            case Config("API_LIST_ACTION"):
                return "GajismpDetilList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "GajismpDetilList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("GajismpDetilView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("GajismpDetilView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "GajismpDetilAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "GajismpDetilAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("GajismpDetilEdit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("GajismpDetilAdd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("GajismpDetilDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        if ($this->getCurrentMasterTable() == "gajismp" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_id", $this->pid->CurrentValue);
        }
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "\"id\":" . JsonEncode($this->id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id->CurrentValue !== null) {
            $url .= "/" . $this->encodeKeyValue($this->id->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderFieldHeader($fld)
    {
        global $Security, $Language;
        $sortUrl = "";
        $attrs = "";
        if ($fld->Sortable) {
            $sortUrl = $this->sortUrl($fld);
            $attrs = ' role="button" data-sort-url="' . $sortUrl . '" data-sort-type="1"';
        }
        $html = '<div class="ew-table-header-caption"' . $attrs . '>' . $fld->caption() . '</div>';
        if ($sortUrl) {
            $html .= '<div class="ew-table-header-sort">' . $fld->getSortIcon() . '</div>';
        }
        if ($fld->UseFilter && $Security->canSearch()) {
            $html .= '<div class="ew-filter-dropdown-btn" data-ew-action="filter" data-table="' . $fld->TableVar . '" data-field="' . $fld->FieldVar .
                '"><div class="ew-table-header-filter" role="button" aria-haspopup="true">' . $Language->phrase("Filter") . '</div></div>';
        }
        $html = '<div class="ew-table-header-btn">' . $html . '</div>';
        if ($this->UseCustomTemplate) {
            $scriptId = str_replace("{id}", $fld->TableVar . "_" . $fld->Param, "tpc_{id}");
            $html = '<template id="' . $scriptId . '">' . $html . '</template>';
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            if (($keyValue = Param("id") ?? Route("id")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                if (!is_numeric($key)) {
                    continue;
                }
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            if ($setCurrent) {
                $this->id->CurrentValue = $key;
            } else {
                $this->id->OldValue = $key;
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        return $conn->executeQuery($sql);
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
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

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

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

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // pid
        $this->pid->ViewValue = $this->pid->CurrentValue;
        $this->pid->ViewValue = FormatNumber($this->pid->ViewValue, $this->pid->formatPattern());
        $this->pid->ViewCustomAttributes = "";

        // pegawai_id
        $this->pegawai_id->ViewValue = $this->pegawai_id->CurrentValue;
        $this->pegawai_id->ViewValue = FormatNumber($this->pegawai_id->ViewValue, $this->pegawai_id->formatPattern());
        $this->pegawai_id->ViewCustomAttributes = "";

        // jabatan_id
        $this->jabatan_id->ViewValue = $this->jabatan_id->CurrentValue;
        $this->jabatan_id->ViewValue = FormatNumber($this->jabatan_id->ViewValue, $this->jabatan_id->formatPattern());
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

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // pid
        $this->pid->LinkCustomAttributes = "";
        $this->pid->HrefValue = "";
        $this->pid->TooltipValue = "";

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

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // id
        $this->id->setupEditAttributes();
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // pid
        $this->pid->setupEditAttributes();
        $this->pid->EditCustomAttributes = "";
        if ($this->pid->getSessionValue() != "") {
            $this->pid->CurrentValue = GetForeignKeyValue($this->pid->getSessionValue());
            $this->pid->ViewValue = $this->pid->CurrentValue;
            $this->pid->ViewValue = FormatNumber($this->pid->ViewValue, $this->pid->formatPattern());
            $this->pid->ViewCustomAttributes = "";
        } else {
            $this->pid->EditValue = $this->pid->CurrentValue;
            $this->pid->PlaceHolder = RemoveHtml($this->pid->caption());
            if (strval($this->pid->EditValue) != "" && is_numeric($this->pid->EditValue)) {
                $this->pid->EditValue = FormatNumber($this->pid->EditValue, null);
            }
        }

        // pegawai_id
        $this->pegawai_id->setupEditAttributes();
        $this->pegawai_id->EditCustomAttributes = "";
        $this->pegawai_id->EditValue = $this->pegawai_id->CurrentValue;
        $this->pegawai_id->PlaceHolder = RemoveHtml($this->pegawai_id->caption());
        if (strval($this->pegawai_id->EditValue) != "" && is_numeric($this->pegawai_id->EditValue)) {
            $this->pegawai_id->EditValue = FormatNumber($this->pegawai_id->EditValue, null);
        }

        // jabatan_id
        $this->jabatan_id->setupEditAttributes();
        $this->jabatan_id->EditCustomAttributes = "";
        $this->jabatan_id->EditValue = $this->jabatan_id->CurrentValue;
        $this->jabatan_id->PlaceHolder = RemoveHtml($this->jabatan_id->caption());
        if (strval($this->jabatan_id->EditValue) != "" && is_numeric($this->jabatan_id->EditValue)) {
            $this->jabatan_id->EditValue = FormatNumber($this->jabatan_id->EditValue, null);
        }

        // masakerja
        $this->masakerja->setupEditAttributes();
        $this->masakerja->EditCustomAttributes = "";
        $this->masakerja->EditValue = $this->masakerja->CurrentValue;
        $this->masakerja->PlaceHolder = RemoveHtml($this->masakerja->caption());
        if (strval($this->masakerja->EditValue) != "" && is_numeric($this->masakerja->EditValue)) {
            $this->masakerja->EditValue = FormatNumber($this->masakerja->EditValue, null);
        }

        // jumngajar
        $this->jumngajar->setupEditAttributes();
        $this->jumngajar->EditCustomAttributes = "";
        $this->jumngajar->EditValue = $this->jumngajar->CurrentValue;
        $this->jumngajar->PlaceHolder = RemoveHtml($this->jumngajar->caption());
        if (strval($this->jumngajar->EditValue) != "" && is_numeric($this->jumngajar->EditValue)) {
            $this->jumngajar->EditValue = FormatNumber($this->jumngajar->EditValue, null);
        }

        // ijin
        $this->ijin->setupEditAttributes();
        $this->ijin->EditCustomAttributes = "";
        $this->ijin->EditValue = $this->ijin->CurrentValue;
        $this->ijin->PlaceHolder = RemoveHtml($this->ijin->caption());
        if (strval($this->ijin->EditValue) != "" && is_numeric($this->ijin->EditValue)) {
            $this->ijin->EditValue = FormatNumber($this->ijin->EditValue, null);
        }

        // tunjangan_wkosis
        $this->tunjangan_wkosis->setupEditAttributes();
        $this->tunjangan_wkosis->EditCustomAttributes = "";
        $this->tunjangan_wkosis->EditValue = $this->tunjangan_wkosis->CurrentValue;
        $this->tunjangan_wkosis->PlaceHolder = RemoveHtml($this->tunjangan_wkosis->caption());
        if (strval($this->tunjangan_wkosis->EditValue) != "" && is_numeric($this->tunjangan_wkosis->EditValue)) {
            $this->tunjangan_wkosis->EditValue = FormatNumber($this->tunjangan_wkosis->EditValue, null);
        }

        // nominal_baku
        $this->nominal_baku->setupEditAttributes();
        $this->nominal_baku->EditCustomAttributes = "";
        $this->nominal_baku->EditValue = $this->nominal_baku->CurrentValue;
        $this->nominal_baku->PlaceHolder = RemoveHtml($this->nominal_baku->caption());
        if (strval($this->nominal_baku->EditValue) != "" && is_numeric($this->nominal_baku->EditValue)) {
            $this->nominal_baku->EditValue = FormatNumber($this->nominal_baku->EditValue, null);
        }

        // baku
        $this->baku->setupEditAttributes();
        $this->baku->EditCustomAttributes = "";
        $this->baku->EditValue = $this->baku->CurrentValue;
        $this->baku->PlaceHolder = RemoveHtml($this->baku->caption());
        if (strval($this->baku->EditValue) != "" && is_numeric($this->baku->EditValue)) {
            $this->baku->EditValue = FormatNumber($this->baku->EditValue, null);
        }

        // kehadiran
        $this->kehadiran->setupEditAttributes();
        $this->kehadiran->EditCustomAttributes = "";
        $this->kehadiran->EditValue = $this->kehadiran->CurrentValue;
        $this->kehadiran->PlaceHolder = RemoveHtml($this->kehadiran->caption());
        if (strval($this->kehadiran->EditValue) != "" && is_numeric($this->kehadiran->EditValue)) {
            $this->kehadiran->EditValue = FormatNumber($this->kehadiran->EditValue, null);
        }

        // prestasi
        $this->prestasi->setupEditAttributes();
        $this->prestasi->EditCustomAttributes = "";
        $this->prestasi->EditValue = $this->prestasi->CurrentValue;
        $this->prestasi->PlaceHolder = RemoveHtml($this->prestasi->caption());
        if (strval($this->prestasi->EditValue) != "" && is_numeric($this->prestasi->EditValue)) {
            $this->prestasi->EditValue = FormatNumber($this->prestasi->EditValue, null);
        }

        // jumlahgaji
        $this->jumlahgaji->setupEditAttributes();
        $this->jumlahgaji->EditCustomAttributes = "";
        $this->jumlahgaji->EditValue = $this->jumlahgaji->CurrentValue;
        $this->jumlahgaji->PlaceHolder = RemoveHtml($this->jumlahgaji->caption());
        if (strval($this->jumlahgaji->EditValue) != "" && is_numeric($this->jumlahgaji->EditValue)) {
            $this->jumlahgaji->EditValue = FormatNumber($this->jumlahgaji->EditValue, null);
        }

        // jumgajitotal
        $this->jumgajitotal->setupEditAttributes();
        $this->jumgajitotal->EditCustomAttributes = "";
        $this->jumgajitotal->EditValue = $this->jumgajitotal->CurrentValue;
        $this->jumgajitotal->PlaceHolder = RemoveHtml($this->jumgajitotal->caption());
        if (strval($this->jumgajitotal->EditValue) != "" && is_numeric($this->jumgajitotal->EditValue)) {
            $this->jumgajitotal->EditValue = FormatNumber($this->jumgajitotal->EditValue, null);
        }

        // potongan1
        $this->potongan1->setupEditAttributes();
        $this->potongan1->EditCustomAttributes = "";
        $this->potongan1->EditValue = $this->potongan1->CurrentValue;
        $this->potongan1->PlaceHolder = RemoveHtml($this->potongan1->caption());
        if (strval($this->potongan1->EditValue) != "" && is_numeric($this->potongan1->EditValue)) {
            $this->potongan1->EditValue = FormatNumber($this->potongan1->EditValue, null);
        }

        // potongan2
        $this->potongan2->setupEditAttributes();
        $this->potongan2->EditCustomAttributes = "";
        $this->potongan2->EditValue = $this->potongan2->CurrentValue;
        $this->potongan2->PlaceHolder = RemoveHtml($this->potongan2->caption());
        if (strval($this->potongan2->EditValue) != "" && is_numeric($this->potongan2->EditValue)) {
            $this->potongan2->EditValue = FormatNumber($this->potongan2->EditValue, null);
        }

        // jumlahterima
        $this->jumlahterima->setupEditAttributes();
        $this->jumlahterima->EditCustomAttributes = "";
        $this->jumlahterima->EditValue = $this->jumlahterima->CurrentValue;
        $this->jumlahterima->PlaceHolder = RemoveHtml($this->jumlahterima->caption());
        if (strval($this->jumlahterima->EditValue) != "" && is_numeric($this->jumlahterima->EditValue)) {
            $this->jumlahterima->EditValue = FormatNumber($this->jumlahterima->EditValue, null);
        }

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->pid);
                    $doc->exportCaption($this->pegawai_id);
                    $doc->exportCaption($this->jabatan_id);
                    $doc->exportCaption($this->masakerja);
                    $doc->exportCaption($this->jumngajar);
                    $doc->exportCaption($this->ijin);
                    $doc->exportCaption($this->tunjangan_wkosis);
                    $doc->exportCaption($this->nominal_baku);
                    $doc->exportCaption($this->baku);
                    $doc->exportCaption($this->kehadiran);
                    $doc->exportCaption($this->prestasi);
                    $doc->exportCaption($this->jumlahgaji);
                    $doc->exportCaption($this->jumgajitotal);
                    $doc->exportCaption($this->potongan1);
                    $doc->exportCaption($this->potongan2);
                    $doc->exportCaption($this->jumlahterima);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->pid);
                    $doc->exportCaption($this->pegawai_id);
                    $doc->exportCaption($this->jabatan_id);
                    $doc->exportCaption($this->masakerja);
                    $doc->exportCaption($this->jumngajar);
                    $doc->exportCaption($this->ijin);
                    $doc->exportCaption($this->tunjangan_wkosis);
                    $doc->exportCaption($this->nominal_baku);
                    $doc->exportCaption($this->baku);
                    $doc->exportCaption($this->kehadiran);
                    $doc->exportCaption($this->prestasi);
                    $doc->exportCaption($this->jumlahgaji);
                    $doc->exportCaption($this->jumgajitotal);
                    $doc->exportCaption($this->potongan1);
                    $doc->exportCaption($this->potongan2);
                    $doc->exportCaption($this->jumlahterima);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->id);
                        $doc->exportField($this->pid);
                        $doc->exportField($this->pegawai_id);
                        $doc->exportField($this->jabatan_id);
                        $doc->exportField($this->masakerja);
                        $doc->exportField($this->jumngajar);
                        $doc->exportField($this->ijin);
                        $doc->exportField($this->tunjangan_wkosis);
                        $doc->exportField($this->nominal_baku);
                        $doc->exportField($this->baku);
                        $doc->exportField($this->kehadiran);
                        $doc->exportField($this->prestasi);
                        $doc->exportField($this->jumlahgaji);
                        $doc->exportField($this->jumgajitotal);
                        $doc->exportField($this->potongan1);
                        $doc->exportField($this->potongan2);
                        $doc->exportField($this->jumlahterima);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->pid);
                        $doc->exportField($this->pegawai_id);
                        $doc->exportField($this->jabatan_id);
                        $doc->exportField($this->masakerja);
                        $doc->exportField($this->jumngajar);
                        $doc->exportField($this->ijin);
                        $doc->exportField($this->tunjangan_wkosis);
                        $doc->exportField($this->nominal_baku);
                        $doc->exportField($this->baku);
                        $doc->exportField($this->kehadiran);
                        $doc->exportField($this->prestasi);
                        $doc->exportField($this->jumlahgaji);
                        $doc->exportField($this->jumgajitotal);
                        $doc->exportField($this->potongan1);
                        $doc->exportField($this->potongan2);
                        $doc->exportField($this->jumlahterima);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->ExportDoc = &$doc;
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        global $DownloadFileName;

        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email, $args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
