<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for potongan_smp
 */
class PotonganSmp extends DbTable
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
    public $month;
    public $jenjang_id;
    public $jabatan_id;
    public $nama;
    public $terlambat;
    public $value_terlambat;
    public $izin;
    public $value_izin;
    public $izinperjam;
    public $izinperjamvalue;
    public $sakit;
    public $value_sakit;
    public $sakitperjam;
    public $sakitperjamvalue;
    public $pulcep;
    public $value_pulcep;
    public $tidakhadir;
    public $value_tidakhadir;
    public $tidakhadirjam;
    public $tidakhadirjamvalue;
    public $total;
    public $u_by;
    public $datetime;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'potongan_smp';
        $this->TableName = 'potongan_smp';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`potongan_smp`";
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
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 1;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // id
        $this->id = new DbField(
            'potongan_smp',
            'potongan_smp',
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

        // month
        $this->month = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_month',
            'month',
            '`month`',
            '`month`',
            200,
            50,
            -1,
            false,
            '`month`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->month->InputTextType = "text";
        $this->Fields['month'] = &$this->month;

        // jenjang_id
        $this->jenjang_id = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_jenjang_id',
            'jenjang_id',
            '`jenjang_id`',
            '`jenjang_id`',
            3,
            11,
            -1,
            false,
            '`jenjang_id`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->jenjang_id->InputTextType = "text";
        $this->jenjang_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jenjang_id'] = &$this->jenjang_id;

        // jabatan_id
        $this->jabatan_id = new DbField(
            'potongan_smp',
            'potongan_smp',
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

        // nama
        $this->nama = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_nama',
            'nama',
            '`nama`',
            '`nama`',
            200,
            50,
            -1,
            false,
            '`nama`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->nama->InputTextType = "text";
        $this->Fields['nama'] = &$this->nama;

        // terlambat
        $this->terlambat = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_terlambat',
            'terlambat',
            '`terlambat`',
            '`terlambat`',
            3,
            11,
            -1,
            false,
            '`terlambat`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->terlambat->InputTextType = "text";
        $this->terlambat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['terlambat'] = &$this->terlambat;

        // value_terlambat
        $this->value_terlambat = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_value_terlambat',
            'value_terlambat',
            '`value_terlambat`',
            '`value_terlambat`',
            20,
            20,
            -1,
            false,
            '`value_terlambat`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->value_terlambat->InputTextType = "text";
        $this->value_terlambat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['value_terlambat'] = &$this->value_terlambat;

        // izin
        $this->izin = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_izin',
            'izin',
            '`izin`',
            '`izin`',
            3,
            11,
            -1,
            false,
            '`izin`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->izin->InputTextType = "text";
        $this->izin->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['izin'] = &$this->izin;

        // value_izin
        $this->value_izin = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_value_izin',
            'value_izin',
            '`value_izin`',
            '`value_izin`',
            20,
            20,
            -1,
            false,
            '`value_izin`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->value_izin->InputTextType = "text";
        $this->value_izin->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['value_izin'] = &$this->value_izin;

        // izinperjam
        $this->izinperjam = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_izinperjam',
            'izinperjam',
            '`izinperjam`',
            '`izinperjam`',
            3,
            11,
            -1,
            false,
            '`izinperjam`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->izinperjam->InputTextType = "text";
        $this->izinperjam->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['izinperjam'] = &$this->izinperjam;

        // izinperjamvalue
        $this->izinperjamvalue = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_izinperjamvalue',
            'izinperjamvalue',
            '`izinperjamvalue`',
            '`izinperjamvalue`',
            20,
            20,
            -1,
            false,
            '`izinperjamvalue`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->izinperjamvalue->InputTextType = "text";
        $this->izinperjamvalue->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['izinperjamvalue'] = &$this->izinperjamvalue;

        // sakit
        $this->sakit = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_sakit',
            'sakit',
            '`sakit`',
            '`sakit`',
            3,
            11,
            -1,
            false,
            '`sakit`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sakit->InputTextType = "text";
        $this->sakit->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['sakit'] = &$this->sakit;

        // value_sakit
        $this->value_sakit = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_value_sakit',
            'value_sakit',
            '`value_sakit`',
            '`value_sakit`',
            20,
            20,
            -1,
            false,
            '`value_sakit`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->value_sakit->InputTextType = "text";
        $this->value_sakit->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['value_sakit'] = &$this->value_sakit;

        // sakitperjam
        $this->sakitperjam = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_sakitperjam',
            'sakitperjam',
            '`sakitperjam`',
            '`sakitperjam`',
            3,
            11,
            -1,
            false,
            '`sakitperjam`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sakitperjam->InputTextType = "text";
        $this->sakitperjam->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['sakitperjam'] = &$this->sakitperjam;

        // sakitperjamvalue
        $this->sakitperjamvalue = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_sakitperjamvalue',
            'sakitperjamvalue',
            '`sakitperjamvalue`',
            '`sakitperjamvalue`',
            20,
            20,
            -1,
            false,
            '`sakitperjamvalue`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sakitperjamvalue->InputTextType = "text";
        $this->sakitperjamvalue->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['sakitperjamvalue'] = &$this->sakitperjamvalue;

        // pulcep
        $this->pulcep = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_pulcep',
            'pulcep',
            '`pulcep`',
            '`pulcep`',
            3,
            11,
            -1,
            false,
            '`pulcep`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->pulcep->InputTextType = "text";
        $this->pulcep->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['pulcep'] = &$this->pulcep;

        // value_pulcep
        $this->value_pulcep = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_value_pulcep',
            'value_pulcep',
            '`value_pulcep`',
            '`value_pulcep`',
            20,
            20,
            -1,
            false,
            '`value_pulcep`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->value_pulcep->InputTextType = "text";
        $this->value_pulcep->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['value_pulcep'] = &$this->value_pulcep;

        // tidakhadir
        $this->tidakhadir = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_tidakhadir',
            'tidakhadir',
            '`tidakhadir`',
            '`tidakhadir`',
            3,
            11,
            -1,
            false,
            '`tidakhadir`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tidakhadir->InputTextType = "text";
        $this->tidakhadir->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['tidakhadir'] = &$this->tidakhadir;

        // value_tidakhadir
        $this->value_tidakhadir = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_value_tidakhadir',
            'value_tidakhadir',
            '`value_tidakhadir`',
            '`value_tidakhadir`',
            20,
            20,
            -1,
            false,
            '`value_tidakhadir`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->value_tidakhadir->InputTextType = "text";
        $this->value_tidakhadir->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['value_tidakhadir'] = &$this->value_tidakhadir;

        // tidakhadirjam
        $this->tidakhadirjam = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_tidakhadirjam',
            'tidakhadirjam',
            '`tidakhadirjam`',
            '`tidakhadirjam`',
            3,
            11,
            -1,
            false,
            '`tidakhadirjam`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tidakhadirjam->InputTextType = "text";
        $this->tidakhadirjam->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['tidakhadirjam'] = &$this->tidakhadirjam;

        // tidakhadirjamvalue
        $this->tidakhadirjamvalue = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_tidakhadirjamvalue',
            'tidakhadirjamvalue',
            '`tidakhadirjamvalue`',
            '`tidakhadirjamvalue`',
            20,
            20,
            -1,
            false,
            '`tidakhadirjamvalue`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tidakhadirjamvalue->InputTextType = "text";
        $this->tidakhadirjamvalue->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['tidakhadirjamvalue'] = &$this->tidakhadirjamvalue;

        // total
        $this->total = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_total',
            'total',
            '`total`',
            '`total`',
            20,
            20,
            -1,
            false,
            '`total`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->total->InputTextType = "text";
        $this->total->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['total'] = &$this->total;

        // u_by
        $this->u_by = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_u_by',
            'u_by',
            '`u_by`',
            '`u_by`',
            3,
            11,
            -1,
            false,
            '`u_by`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->u_by->InputTextType = "text";
        $this->u_by->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['u_by'] = &$this->u_by;

        // datetime
        $this->datetime = new DbField(
            'potongan_smp',
            'potongan_smp',
            'x_datetime',
            'datetime',
            '`datetime`',
            CastDateFieldForLike("`datetime`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`datetime`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->datetime->InputTextType = "text";
        $this->datetime->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['datetime'] = &$this->datetime;

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

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`potongan_smp`";
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
        $this->month->DbValue = $row['month'];
        $this->jenjang_id->DbValue = $row['jenjang_id'];
        $this->jabatan_id->DbValue = $row['jabatan_id'];
        $this->nama->DbValue = $row['nama'];
        $this->terlambat->DbValue = $row['terlambat'];
        $this->value_terlambat->DbValue = $row['value_terlambat'];
        $this->izin->DbValue = $row['izin'];
        $this->value_izin->DbValue = $row['value_izin'];
        $this->izinperjam->DbValue = $row['izinperjam'];
        $this->izinperjamvalue->DbValue = $row['izinperjamvalue'];
        $this->sakit->DbValue = $row['sakit'];
        $this->value_sakit->DbValue = $row['value_sakit'];
        $this->sakitperjam->DbValue = $row['sakitperjam'];
        $this->sakitperjamvalue->DbValue = $row['sakitperjamvalue'];
        $this->pulcep->DbValue = $row['pulcep'];
        $this->value_pulcep->DbValue = $row['value_pulcep'];
        $this->tidakhadir->DbValue = $row['tidakhadir'];
        $this->value_tidakhadir->DbValue = $row['value_tidakhadir'];
        $this->tidakhadirjam->DbValue = $row['tidakhadirjam'];
        $this->tidakhadirjamvalue->DbValue = $row['tidakhadirjamvalue'];
        $this->total->DbValue = $row['total'];
        $this->u_by->DbValue = $row['u_by'];
        $this->datetime->DbValue = $row['datetime'];
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
        return $_SESSION[$name] ?? GetUrl("PotonganSmpList");
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
        if ($pageName == "PotonganSmpView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PotonganSmpEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PotonganSmpAdd") {
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
                return "PotonganSmpView";
            case Config("API_ADD_ACTION"):
                return "PotonganSmpAdd";
            case Config("API_EDIT_ACTION"):
                return "PotonganSmpEdit";
            case Config("API_DELETE_ACTION"):
                return "PotonganSmpDelete";
            case Config("API_LIST_ACTION"):
                return "PotonganSmpList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PotonganSmpList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PotonganSmpView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PotonganSmpView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PotonganSmpAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PotonganSmpAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("PotonganSmpEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("PotonganSmpAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("PotonganSmpDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
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
        $this->month->setDbValue($row['month']);
        $this->jenjang_id->setDbValue($row['jenjang_id']);
        $this->jabatan_id->setDbValue($row['jabatan_id']);
        $this->nama->setDbValue($row['nama']);
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

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // month

        // jenjang_id

        // jabatan_id

        // nama

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
        $this->u_by->ViewValue = FormatNumber($this->u_by->ViewValue, $this->u_by->formatPattern());
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

        // month
        $this->month->setupEditAttributes();
        $this->month->EditCustomAttributes = "";
        if (!$this->month->Raw) {
            $this->month->CurrentValue = HtmlDecode($this->month->CurrentValue);
        }
        $this->month->EditValue = $this->month->CurrentValue;
        $this->month->PlaceHolder = RemoveHtml($this->month->caption());

        // jenjang_id
        $this->jenjang_id->setupEditAttributes();
        $this->jenjang_id->EditCustomAttributes = "";
        $this->jenjang_id->EditValue = $this->jenjang_id->CurrentValue;
        $this->jenjang_id->PlaceHolder = RemoveHtml($this->jenjang_id->caption());
        if (strval($this->jenjang_id->EditValue) != "" && is_numeric($this->jenjang_id->EditValue)) {
            $this->jenjang_id->EditValue = FormatNumber($this->jenjang_id->EditValue, null);
        }

        // jabatan_id
        $this->jabatan_id->setupEditAttributes();
        $this->jabatan_id->EditCustomAttributes = "";
        $this->jabatan_id->EditValue = $this->jabatan_id->CurrentValue;
        $this->jabatan_id->PlaceHolder = RemoveHtml($this->jabatan_id->caption());
        if (strval($this->jabatan_id->EditValue) != "" && is_numeric($this->jabatan_id->EditValue)) {
            $this->jabatan_id->EditValue = FormatNumber($this->jabatan_id->EditValue, null);
        }

        // nama
        $this->nama->setupEditAttributes();
        $this->nama->EditCustomAttributes = "";
        if (!$this->nama->Raw) {
            $this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
        }
        $this->nama->EditValue = $this->nama->CurrentValue;
        $this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

        // terlambat
        $this->terlambat->setupEditAttributes();
        $this->terlambat->EditCustomAttributes = "";
        $this->terlambat->EditValue = $this->terlambat->CurrentValue;
        $this->terlambat->PlaceHolder = RemoveHtml($this->terlambat->caption());
        if (strval($this->terlambat->EditValue) != "" && is_numeric($this->terlambat->EditValue)) {
            $this->terlambat->EditValue = FormatNumber($this->terlambat->EditValue, null);
        }

        // value_terlambat
        $this->value_terlambat->setupEditAttributes();
        $this->value_terlambat->EditCustomAttributes = "";
        $this->value_terlambat->EditValue = $this->value_terlambat->CurrentValue;
        $this->value_terlambat->PlaceHolder = RemoveHtml($this->value_terlambat->caption());
        if (strval($this->value_terlambat->EditValue) != "" && is_numeric($this->value_terlambat->EditValue)) {
            $this->value_terlambat->EditValue = FormatNumber($this->value_terlambat->EditValue, null);
        }

        // izin
        $this->izin->setupEditAttributes();
        $this->izin->EditCustomAttributes = "";
        $this->izin->EditValue = $this->izin->CurrentValue;
        $this->izin->PlaceHolder = RemoveHtml($this->izin->caption());
        if (strval($this->izin->EditValue) != "" && is_numeric($this->izin->EditValue)) {
            $this->izin->EditValue = FormatNumber($this->izin->EditValue, null);
        }

        // value_izin
        $this->value_izin->setupEditAttributes();
        $this->value_izin->EditCustomAttributes = "";
        $this->value_izin->EditValue = $this->value_izin->CurrentValue;
        $this->value_izin->PlaceHolder = RemoveHtml($this->value_izin->caption());
        if (strval($this->value_izin->EditValue) != "" && is_numeric($this->value_izin->EditValue)) {
            $this->value_izin->EditValue = FormatNumber($this->value_izin->EditValue, null);
        }

        // izinperjam
        $this->izinperjam->setupEditAttributes();
        $this->izinperjam->EditCustomAttributes = "";
        $this->izinperjam->EditValue = $this->izinperjam->CurrentValue;
        $this->izinperjam->PlaceHolder = RemoveHtml($this->izinperjam->caption());
        if (strval($this->izinperjam->EditValue) != "" && is_numeric($this->izinperjam->EditValue)) {
            $this->izinperjam->EditValue = FormatNumber($this->izinperjam->EditValue, null);
        }

        // izinperjamvalue
        $this->izinperjamvalue->setupEditAttributes();
        $this->izinperjamvalue->EditCustomAttributes = "";
        $this->izinperjamvalue->EditValue = $this->izinperjamvalue->CurrentValue;
        $this->izinperjamvalue->PlaceHolder = RemoveHtml($this->izinperjamvalue->caption());
        if (strval($this->izinperjamvalue->EditValue) != "" && is_numeric($this->izinperjamvalue->EditValue)) {
            $this->izinperjamvalue->EditValue = FormatNumber($this->izinperjamvalue->EditValue, null);
        }

        // sakit
        $this->sakit->setupEditAttributes();
        $this->sakit->EditCustomAttributes = "";
        $this->sakit->EditValue = $this->sakit->CurrentValue;
        $this->sakit->PlaceHolder = RemoveHtml($this->sakit->caption());
        if (strval($this->sakit->EditValue) != "" && is_numeric($this->sakit->EditValue)) {
            $this->sakit->EditValue = FormatNumber($this->sakit->EditValue, null);
        }

        // value_sakit
        $this->value_sakit->setupEditAttributes();
        $this->value_sakit->EditCustomAttributes = "";
        $this->value_sakit->EditValue = $this->value_sakit->CurrentValue;
        $this->value_sakit->PlaceHolder = RemoveHtml($this->value_sakit->caption());
        if (strval($this->value_sakit->EditValue) != "" && is_numeric($this->value_sakit->EditValue)) {
            $this->value_sakit->EditValue = FormatNumber($this->value_sakit->EditValue, null);
        }

        // sakitperjam
        $this->sakitperjam->setupEditAttributes();
        $this->sakitperjam->EditCustomAttributes = "";
        $this->sakitperjam->EditValue = $this->sakitperjam->CurrentValue;
        $this->sakitperjam->PlaceHolder = RemoveHtml($this->sakitperjam->caption());
        if (strval($this->sakitperjam->EditValue) != "" && is_numeric($this->sakitperjam->EditValue)) {
            $this->sakitperjam->EditValue = FormatNumber($this->sakitperjam->EditValue, null);
        }

        // sakitperjamvalue
        $this->sakitperjamvalue->setupEditAttributes();
        $this->sakitperjamvalue->EditCustomAttributes = "";
        $this->sakitperjamvalue->EditValue = $this->sakitperjamvalue->CurrentValue;
        $this->sakitperjamvalue->PlaceHolder = RemoveHtml($this->sakitperjamvalue->caption());
        if (strval($this->sakitperjamvalue->EditValue) != "" && is_numeric($this->sakitperjamvalue->EditValue)) {
            $this->sakitperjamvalue->EditValue = FormatNumber($this->sakitperjamvalue->EditValue, null);
        }

        // pulcep
        $this->pulcep->setupEditAttributes();
        $this->pulcep->EditCustomAttributes = "";
        $this->pulcep->EditValue = $this->pulcep->CurrentValue;
        $this->pulcep->PlaceHolder = RemoveHtml($this->pulcep->caption());
        if (strval($this->pulcep->EditValue) != "" && is_numeric($this->pulcep->EditValue)) {
            $this->pulcep->EditValue = FormatNumber($this->pulcep->EditValue, null);
        }

        // value_pulcep
        $this->value_pulcep->setupEditAttributes();
        $this->value_pulcep->EditCustomAttributes = "";
        $this->value_pulcep->EditValue = $this->value_pulcep->CurrentValue;
        $this->value_pulcep->PlaceHolder = RemoveHtml($this->value_pulcep->caption());
        if (strval($this->value_pulcep->EditValue) != "" && is_numeric($this->value_pulcep->EditValue)) {
            $this->value_pulcep->EditValue = FormatNumber($this->value_pulcep->EditValue, null);
        }

        // tidakhadir
        $this->tidakhadir->setupEditAttributes();
        $this->tidakhadir->EditCustomAttributes = "";
        $this->tidakhadir->EditValue = $this->tidakhadir->CurrentValue;
        $this->tidakhadir->PlaceHolder = RemoveHtml($this->tidakhadir->caption());
        if (strval($this->tidakhadir->EditValue) != "" && is_numeric($this->tidakhadir->EditValue)) {
            $this->tidakhadir->EditValue = FormatNumber($this->tidakhadir->EditValue, null);
        }

        // value_tidakhadir
        $this->value_tidakhadir->setupEditAttributes();
        $this->value_tidakhadir->EditCustomAttributes = "";
        $this->value_tidakhadir->EditValue = $this->value_tidakhadir->CurrentValue;
        $this->value_tidakhadir->PlaceHolder = RemoveHtml($this->value_tidakhadir->caption());
        if (strval($this->value_tidakhadir->EditValue) != "" && is_numeric($this->value_tidakhadir->EditValue)) {
            $this->value_tidakhadir->EditValue = FormatNumber($this->value_tidakhadir->EditValue, null);
        }

        // tidakhadirjam
        $this->tidakhadirjam->setupEditAttributes();
        $this->tidakhadirjam->EditCustomAttributes = "";
        $this->tidakhadirjam->EditValue = $this->tidakhadirjam->CurrentValue;
        $this->tidakhadirjam->PlaceHolder = RemoveHtml($this->tidakhadirjam->caption());
        if (strval($this->tidakhadirjam->EditValue) != "" && is_numeric($this->tidakhadirjam->EditValue)) {
            $this->tidakhadirjam->EditValue = FormatNumber($this->tidakhadirjam->EditValue, null);
        }

        // tidakhadirjamvalue
        $this->tidakhadirjamvalue->setupEditAttributes();
        $this->tidakhadirjamvalue->EditCustomAttributes = "";
        $this->tidakhadirjamvalue->EditValue = $this->tidakhadirjamvalue->CurrentValue;
        $this->tidakhadirjamvalue->PlaceHolder = RemoveHtml($this->tidakhadirjamvalue->caption());
        if (strval($this->tidakhadirjamvalue->EditValue) != "" && is_numeric($this->tidakhadirjamvalue->EditValue)) {
            $this->tidakhadirjamvalue->EditValue = FormatNumber($this->tidakhadirjamvalue->EditValue, null);
        }

        // total
        $this->total->setupEditAttributes();
        $this->total->EditCustomAttributes = "";
        $this->total->EditValue = $this->total->CurrentValue;
        $this->total->PlaceHolder = RemoveHtml($this->total->caption());
        if (strval($this->total->EditValue) != "" && is_numeric($this->total->EditValue)) {
            $this->total->EditValue = FormatNumber($this->total->EditValue, null);
        }

        // u_by
        $this->u_by->setupEditAttributes();
        $this->u_by->EditCustomAttributes = "";
        $this->u_by->EditValue = $this->u_by->CurrentValue;
        $this->u_by->PlaceHolder = RemoveHtml($this->u_by->caption());
        if (strval($this->u_by->EditValue) != "" && is_numeric($this->u_by->EditValue)) {
            $this->u_by->EditValue = FormatNumber($this->u_by->EditValue, null);
        }

        // datetime
        $this->datetime->setupEditAttributes();
        $this->datetime->EditCustomAttributes = "";
        $this->datetime->EditValue = FormatDateTime($this->datetime->CurrentValue, $this->datetime->formatPattern());
        $this->datetime->PlaceHolder = RemoveHtml($this->datetime->caption());

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
                    $doc->exportCaption($this->month);
                    $doc->exportCaption($this->jenjang_id);
                    $doc->exportCaption($this->jabatan_id);
                    $doc->exportCaption($this->nama);
                    $doc->exportCaption($this->terlambat);
                    $doc->exportCaption($this->value_terlambat);
                    $doc->exportCaption($this->izin);
                    $doc->exportCaption($this->value_izin);
                    $doc->exportCaption($this->izinperjam);
                    $doc->exportCaption($this->izinperjamvalue);
                    $doc->exportCaption($this->sakit);
                    $doc->exportCaption($this->value_sakit);
                    $doc->exportCaption($this->sakitperjam);
                    $doc->exportCaption($this->sakitperjamvalue);
                    $doc->exportCaption($this->pulcep);
                    $doc->exportCaption($this->value_pulcep);
                    $doc->exportCaption($this->tidakhadir);
                    $doc->exportCaption($this->value_tidakhadir);
                    $doc->exportCaption($this->tidakhadirjam);
                    $doc->exportCaption($this->tidakhadirjamvalue);
                    $doc->exportCaption($this->total);
                    $doc->exportCaption($this->u_by);
                    $doc->exportCaption($this->datetime);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->month);
                    $doc->exportCaption($this->jenjang_id);
                    $doc->exportCaption($this->jabatan_id);
                    $doc->exportCaption($this->nama);
                    $doc->exportCaption($this->terlambat);
                    $doc->exportCaption($this->value_terlambat);
                    $doc->exportCaption($this->izin);
                    $doc->exportCaption($this->value_izin);
                    $doc->exportCaption($this->izinperjam);
                    $doc->exportCaption($this->izinperjamvalue);
                    $doc->exportCaption($this->sakit);
                    $doc->exportCaption($this->value_sakit);
                    $doc->exportCaption($this->sakitperjam);
                    $doc->exportCaption($this->sakitperjamvalue);
                    $doc->exportCaption($this->pulcep);
                    $doc->exportCaption($this->value_pulcep);
                    $doc->exportCaption($this->tidakhadir);
                    $doc->exportCaption($this->value_tidakhadir);
                    $doc->exportCaption($this->tidakhadirjam);
                    $doc->exportCaption($this->tidakhadirjamvalue);
                    $doc->exportCaption($this->total);
                    $doc->exportCaption($this->u_by);
                    $doc->exportCaption($this->datetime);
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
                        $doc->exportField($this->month);
                        $doc->exportField($this->jenjang_id);
                        $doc->exportField($this->jabatan_id);
                        $doc->exportField($this->nama);
                        $doc->exportField($this->terlambat);
                        $doc->exportField($this->value_terlambat);
                        $doc->exportField($this->izin);
                        $doc->exportField($this->value_izin);
                        $doc->exportField($this->izinperjam);
                        $doc->exportField($this->izinperjamvalue);
                        $doc->exportField($this->sakit);
                        $doc->exportField($this->value_sakit);
                        $doc->exportField($this->sakitperjam);
                        $doc->exportField($this->sakitperjamvalue);
                        $doc->exportField($this->pulcep);
                        $doc->exportField($this->value_pulcep);
                        $doc->exportField($this->tidakhadir);
                        $doc->exportField($this->value_tidakhadir);
                        $doc->exportField($this->tidakhadirjam);
                        $doc->exportField($this->tidakhadirjamvalue);
                        $doc->exportField($this->total);
                        $doc->exportField($this->u_by);
                        $doc->exportField($this->datetime);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->month);
                        $doc->exportField($this->jenjang_id);
                        $doc->exportField($this->jabatan_id);
                        $doc->exportField($this->nama);
                        $doc->exportField($this->terlambat);
                        $doc->exportField($this->value_terlambat);
                        $doc->exportField($this->izin);
                        $doc->exportField($this->value_izin);
                        $doc->exportField($this->izinperjam);
                        $doc->exportField($this->izinperjamvalue);
                        $doc->exportField($this->sakit);
                        $doc->exportField($this->value_sakit);
                        $doc->exportField($this->sakitperjam);
                        $doc->exportField($this->sakitperjamvalue);
                        $doc->exportField($this->pulcep);
                        $doc->exportField($this->value_pulcep);
                        $doc->exportField($this->tidakhadir);
                        $doc->exportField($this->value_tidakhadir);
                        $doc->exportField($this->tidakhadirjam);
                        $doc->exportField($this->tidakhadirjamvalue);
                        $doc->exportField($this->total);
                        $doc->exportField($this->u_by);
                        $doc->exportField($this->datetime);
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
