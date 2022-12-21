<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for gaji
 */
class Gaji extends DbTable
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

    // Audit trail
    public $AuditTrailOnAdd = true;
    public $AuditTrailOnEdit = true;
    public $AuditTrailOnDelete = true;
    public $AuditTrailOnView = false;
    public $AuditTrailOnViewData = false;
    public $AuditTrailOnSearch = false;

    // Export
    public $ExportDoc;

    // Fields
    public $id;
    public $jabatan_id;
    public $pegawai;
    public $lembur;
    public $value_lembur;
    public $kehadiran;
    public $gapok;
    public $value_reward;
    public $value_inval;
    public $piket_count;
    public $value_piket;
    public $tugastambahan;
    public $tj_jabatan;
    public $sub_total;
    public $potongan;
    public $total;
    public $month;
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
        $this->TableVar = 'gaji';
        $this->TableName = 'gaji';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`gaji`";
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
            'gaji',
            'gaji',
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

        // jabatan_id
        $this->jabatan_id = new DbField(
            'gaji',
            'gaji',
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
        switch ($CurrentLanguage) {
            case "en-US":
                $this->jabatan_id->Lookup = new Lookup('jabatan_id', 'jabatan', false, 'id', ["nama_jabatan","","",""], [], [], [], [], [], [], '', '', "`nama_jabatan`");
                break;
            default:
                $this->jabatan_id->Lookup = new Lookup('jabatan_id', 'jabatan', false, 'id', ["nama_jabatan","","",""], [], [], [], [], [], [], '', '', "`nama_jabatan`");
                break;
        }
        $this->jabatan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jabatan_id'] = &$this->jabatan_id;

        // pegawai
        $this->pegawai = new DbField(
            'gaji',
            'gaji',
            'x_pegawai',
            'pegawai',
            '`pegawai`',
            '`pegawai`',
            200,
            50,
            -1,
            false,
            '`pegawai`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->pegawai->InputTextType = "text";
        switch ($CurrentLanguage) {
            case "en-US":
                $this->pegawai->Lookup = new Lookup('pegawai', 'pegawai', false, 'nip', ["nama","","",""], [], [], [], [], [], [], '', '', "`nama`");
                break;
            default:
                $this->pegawai->Lookup = new Lookup('pegawai', 'pegawai', false, 'nip', ["nama","","",""], [], [], [], [], [], [], '', '', "`nama`");
                break;
        }
        $this->Fields['pegawai'] = &$this->pegawai;

        // lembur
        $this->lembur = new DbField(
            'gaji',
            'gaji',
            'x_lembur',
            'lembur',
            '`lembur`',
            '`lembur`',
            3,
            11,
            -1,
            false,
            '`lembur`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->lembur->InputTextType = "text";
        $this->lembur->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['lembur'] = &$this->lembur;

        // value_lembur
        $this->value_lembur = new DbField(
            'gaji',
            'gaji',
            'x_value_lembur',
            'value_lembur',
            '`value_lembur`',
            '`value_lembur`',
            20,
            20,
            -1,
            false,
            '`value_lembur`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->value_lembur->InputTextType = "text";
        $this->value_lembur->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['value_lembur'] = &$this->value_lembur;

        // kehadiran
        $this->kehadiran = new DbField(
            'gaji',
            'gaji',
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

        // gapok
        $this->gapok = new DbField(
            'gaji',
            'gaji',
            'x_gapok',
            'gapok',
            '`gapok`',
            '`gapok`',
            20,
            20,
            -1,
            false,
            '`gapok`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->gapok->InputTextType = "text";
        $this->gapok->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['gapok'] = &$this->gapok;

        // value_reward
        $this->value_reward = new DbField(
            'gaji',
            'gaji',
            'x_value_reward',
            'value_reward',
            '`value_reward`',
            '`value_reward`',
            20,
            20,
            -1,
            false,
            '`value_reward`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->value_reward->InputTextType = "text";
        $this->value_reward->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['value_reward'] = &$this->value_reward;

        // value_inval
        $this->value_inval = new DbField(
            'gaji',
            'gaji',
            'x_value_inval',
            'value_inval',
            '`value_inval`',
            '`value_inval`',
            20,
            20,
            -1,
            false,
            '`value_inval`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->value_inval->InputTextType = "text";
        $this->value_inval->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['value_inval'] = &$this->value_inval;

        // piket_count
        $this->piket_count = new DbField(
            'gaji',
            'gaji',
            'x_piket_count',
            'piket_count',
            '`piket_count`',
            '`piket_count`',
            3,
            11,
            -1,
            false,
            '`piket_count`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->piket_count->InputTextType = "text";
        $this->piket_count->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['piket_count'] = &$this->piket_count;

        // value_piket
        $this->value_piket = new DbField(
            'gaji',
            'gaji',
            'x_value_piket',
            'value_piket',
            '`value_piket`',
            '`value_piket`',
            20,
            20,
            -1,
            false,
            '`value_piket`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->value_piket->InputTextType = "text";
        $this->value_piket->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['value_piket'] = &$this->value_piket;

        // tugastambahan
        $this->tugastambahan = new DbField(
            'gaji',
            'gaji',
            'x_tugastambahan',
            'tugastambahan',
            '`tugastambahan`',
            '`tugastambahan`',
            20,
            20,
            -1,
            false,
            '`tugastambahan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tugastambahan->InputTextType = "text";
        $this->tugastambahan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['tugastambahan'] = &$this->tugastambahan;

        // tj_jabatan
        $this->tj_jabatan = new DbField(
            'gaji',
            'gaji',
            'x_tj_jabatan',
            'tj_jabatan',
            '`tj_jabatan`',
            '`tj_jabatan`',
            20,
            20,
            -1,
            false,
            '`tj_jabatan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tj_jabatan->InputTextType = "text";
        $this->tj_jabatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['tj_jabatan'] = &$this->tj_jabatan;

        // sub_total
        $this->sub_total = new DbField(
            'gaji',
            'gaji',
            'x_sub_total',
            'sub_total',
            '`sub_total`',
            '`sub_total`',
            20,
            20,
            -1,
            false,
            '`sub_total`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->sub_total->InputTextType = "text";
        $this->sub_total->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['sub_total'] = &$this->sub_total;

        // potongan
        $this->potongan = new DbField(
            'gaji',
            'gaji',
            'x_potongan',
            'potongan',
            '`potongan`',
            '`potongan`',
            20,
            20,
            -1,
            false,
            '`potongan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->potongan->InputTextType = "text";
        $this->potongan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['potongan'] = &$this->potongan;

        // total
        $this->total = new DbField(
            'gaji',
            'gaji',
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

        // month
        $this->month = new DbField(
            'gaji',
            'gaji',
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
        $this->month->InputTextType = "month";
        $this->Fields['month'] = &$this->month;

        // datetime
        $this->datetime = new DbField(
            'gaji',
            'gaji',
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`gaji`";
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
            if ($this->AuditTrailOnAdd) {
                $this->writeAuditTrailOnAdd($rs);
            }
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
        if ($success && $this->AuditTrailOnEdit && $rsold) {
            $rsaudit = $rs;
            $fldname = 'id';
            if (!array_key_exists($fldname, $rsaudit)) {
                $rsaudit[$fldname] = $rsold[$fldname];
            }
            $this->writeAuditTrailOnEdit($rsold, $rsaudit);
        }
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
        if ($success && $this->AuditTrailOnDelete) {
            $this->writeAuditTrailOnDelete($rs);
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
        $this->jabatan_id->DbValue = $row['jabatan_id'];
        $this->pegawai->DbValue = $row['pegawai'];
        $this->lembur->DbValue = $row['lembur'];
        $this->value_lembur->DbValue = $row['value_lembur'];
        $this->kehadiran->DbValue = $row['kehadiran'];
        $this->gapok->DbValue = $row['gapok'];
        $this->value_reward->DbValue = $row['value_reward'];
        $this->value_inval->DbValue = $row['value_inval'];
        $this->piket_count->DbValue = $row['piket_count'];
        $this->value_piket->DbValue = $row['value_piket'];
        $this->tugastambahan->DbValue = $row['tugastambahan'];
        $this->tj_jabatan->DbValue = $row['tj_jabatan'];
        $this->sub_total->DbValue = $row['sub_total'];
        $this->potongan->DbValue = $row['potongan'];
        $this->total->DbValue = $row['total'];
        $this->month->DbValue = $row['month'];
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
        return $_SESSION[$name] ?? GetUrl("GajiList");
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
        if ($pageName == "GajiView") {
            return $Language->phrase("View");
        } elseif ($pageName == "GajiEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "GajiAdd") {
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
                return "GajiView";
            case Config("API_ADD_ACTION"):
                return "GajiAdd";
            case Config("API_EDIT_ACTION"):
                return "GajiEdit";
            case Config("API_DELETE_ACTION"):
                return "GajiDelete";
            case Config("API_LIST_ACTION"):
                return "GajiList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "GajiList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("GajiView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("GajiView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "GajiAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "GajiAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("GajiEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("GajiAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("GajiDelete", $this->getUrlParm());
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

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

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

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

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

        // jabatan_id
        $this->jabatan_id->setupEditAttributes();
        $this->jabatan_id->EditCustomAttributes = "";
        $this->jabatan_id->EditValue = $this->jabatan_id->CurrentValue;
        $this->jabatan_id->PlaceHolder = RemoveHtml($this->jabatan_id->caption());

        // pegawai
        $this->pegawai->setupEditAttributes();
        $this->pegawai->EditCustomAttributes = "";
        if (!$this->pegawai->Raw) {
            $this->pegawai->CurrentValue = HtmlDecode($this->pegawai->CurrentValue);
        }
        $this->pegawai->EditValue = $this->pegawai->CurrentValue;
        $this->pegawai->PlaceHolder = RemoveHtml($this->pegawai->caption());

        // lembur
        $this->lembur->setupEditAttributes();
        $this->lembur->EditCustomAttributes = "";
        $this->lembur->EditValue = $this->lembur->CurrentValue;
        $this->lembur->PlaceHolder = RemoveHtml($this->lembur->caption());
        if (strval($this->lembur->EditValue) != "" && is_numeric($this->lembur->EditValue)) {
            $this->lembur->EditValue = FormatNumber($this->lembur->EditValue, null);
        }

        // value_lembur
        $this->value_lembur->setupEditAttributes();
        $this->value_lembur->EditCustomAttributes = "";
        $this->value_lembur->EditValue = $this->value_lembur->CurrentValue;
        $this->value_lembur->PlaceHolder = RemoveHtml($this->value_lembur->caption());
        if (strval($this->value_lembur->EditValue) != "" && is_numeric($this->value_lembur->EditValue)) {
            $this->value_lembur->EditValue = FormatNumber($this->value_lembur->EditValue, null);
        }

        // kehadiran
        $this->kehadiran->setupEditAttributes();
        $this->kehadiran->EditCustomAttributes = "";
        $this->kehadiran->EditValue = $this->kehadiran->CurrentValue;
        $this->kehadiran->PlaceHolder = RemoveHtml($this->kehadiran->caption());
        if (strval($this->kehadiran->EditValue) != "" && is_numeric($this->kehadiran->EditValue)) {
            $this->kehadiran->EditValue = FormatNumber($this->kehadiran->EditValue, null);
        }

        // gapok
        $this->gapok->setupEditAttributes();
        $this->gapok->EditCustomAttributes = "";
        $this->gapok->EditValue = $this->gapok->CurrentValue;
        $this->gapok->PlaceHolder = RemoveHtml($this->gapok->caption());
        if (strval($this->gapok->EditValue) != "" && is_numeric($this->gapok->EditValue)) {
            $this->gapok->EditValue = FormatNumber($this->gapok->EditValue, null);
        }

        // value_reward
        $this->value_reward->setupEditAttributes();
        $this->value_reward->EditCustomAttributes = "";
        $this->value_reward->EditValue = $this->value_reward->CurrentValue;
        $this->value_reward->PlaceHolder = RemoveHtml($this->value_reward->caption());
        if (strval($this->value_reward->EditValue) != "" && is_numeric($this->value_reward->EditValue)) {
            $this->value_reward->EditValue = FormatNumber($this->value_reward->EditValue, null);
        }

        // value_inval
        $this->value_inval->setupEditAttributes();
        $this->value_inval->EditCustomAttributes = "";
        $this->value_inval->EditValue = $this->value_inval->CurrentValue;
        $this->value_inval->PlaceHolder = RemoveHtml($this->value_inval->caption());
        if (strval($this->value_inval->EditValue) != "" && is_numeric($this->value_inval->EditValue)) {
            $this->value_inval->EditValue = FormatNumber($this->value_inval->EditValue, null);
        }

        // piket_count
        $this->piket_count->setupEditAttributes();
        $this->piket_count->EditCustomAttributes = "";
        $this->piket_count->EditValue = $this->piket_count->CurrentValue;
        $this->piket_count->PlaceHolder = RemoveHtml($this->piket_count->caption());
        if (strval($this->piket_count->EditValue) != "" && is_numeric($this->piket_count->EditValue)) {
            $this->piket_count->EditValue = FormatNumber($this->piket_count->EditValue, null);
        }

        // value_piket
        $this->value_piket->setupEditAttributes();
        $this->value_piket->EditCustomAttributes = "";
        $this->value_piket->EditValue = $this->value_piket->CurrentValue;
        $this->value_piket->PlaceHolder = RemoveHtml($this->value_piket->caption());
        if (strval($this->value_piket->EditValue) != "" && is_numeric($this->value_piket->EditValue)) {
            $this->value_piket->EditValue = FormatNumber($this->value_piket->EditValue, null);
        }

        // tugastambahan
        $this->tugastambahan->setupEditAttributes();
        $this->tugastambahan->EditCustomAttributes = "";
        $this->tugastambahan->EditValue = $this->tugastambahan->CurrentValue;
        $this->tugastambahan->PlaceHolder = RemoveHtml($this->tugastambahan->caption());
        if (strval($this->tugastambahan->EditValue) != "" && is_numeric($this->tugastambahan->EditValue)) {
            $this->tugastambahan->EditValue = FormatNumber($this->tugastambahan->EditValue, null);
        }

        // tj_jabatan
        $this->tj_jabatan->setupEditAttributes();
        $this->tj_jabatan->EditCustomAttributes = "";
        $this->tj_jabatan->EditValue = $this->tj_jabatan->CurrentValue;
        $this->tj_jabatan->PlaceHolder = RemoveHtml($this->tj_jabatan->caption());
        if (strval($this->tj_jabatan->EditValue) != "" && is_numeric($this->tj_jabatan->EditValue)) {
            $this->tj_jabatan->EditValue = FormatNumber($this->tj_jabatan->EditValue, null);
        }

        // sub_total
        $this->sub_total->setupEditAttributes();
        $this->sub_total->EditCustomAttributes = "";
        $this->sub_total->EditValue = $this->sub_total->CurrentValue;
        $this->sub_total->PlaceHolder = RemoveHtml($this->sub_total->caption());
        if (strval($this->sub_total->EditValue) != "" && is_numeric($this->sub_total->EditValue)) {
            $this->sub_total->EditValue = FormatNumber($this->sub_total->EditValue, null);
        }

        // potongan
        $this->potongan->setupEditAttributes();
        $this->potongan->EditCustomAttributes = "";
        $this->potongan->EditValue = $this->potongan->CurrentValue;
        $this->potongan->PlaceHolder = RemoveHtml($this->potongan->caption());
        if (strval($this->potongan->EditValue) != "" && is_numeric($this->potongan->EditValue)) {
            $this->potongan->EditValue = FormatNumber($this->potongan->EditValue, null);
        }

        // total
        $this->total->setupEditAttributes();
        $this->total->EditCustomAttributes = "";
        $this->total->EditValue = $this->total->CurrentValue;
        $this->total->PlaceHolder = RemoveHtml($this->total->caption());
        if (strval($this->total->EditValue) != "" && is_numeric($this->total->EditValue)) {
            $this->total->EditValue = FormatNumber($this->total->EditValue, null);
        }

        // month
        $this->month->setupEditAttributes();
        $this->month->EditCustomAttributes = "";
        if (!$this->month->Raw) {
            $this->month->CurrentValue = HtmlDecode($this->month->CurrentValue);
        }
        $this->month->EditValue = $this->month->CurrentValue;
        $this->month->PlaceHolder = RemoveHtml($this->month->caption());

        // datetime

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
                    $doc->exportCaption($this->jabatan_id);
                    $doc->exportCaption($this->pegawai);
                    $doc->exportCaption($this->lembur);
                    $doc->exportCaption($this->value_lembur);
                    $doc->exportCaption($this->kehadiran);
                    $doc->exportCaption($this->gapok);
                    $doc->exportCaption($this->value_reward);
                    $doc->exportCaption($this->value_inval);
                    $doc->exportCaption($this->piket_count);
                    $doc->exportCaption($this->value_piket);
                    $doc->exportCaption($this->tugastambahan);
                    $doc->exportCaption($this->tj_jabatan);
                    $doc->exportCaption($this->sub_total);
                    $doc->exportCaption($this->potongan);
                    $doc->exportCaption($this->total);
                    $doc->exportCaption($this->month);
                    $doc->exportCaption($this->datetime);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->jabatan_id);
                    $doc->exportCaption($this->pegawai);
                    $doc->exportCaption($this->lembur);
                    $doc->exportCaption($this->value_lembur);
                    $doc->exportCaption($this->kehadiran);
                    $doc->exportCaption($this->gapok);
                    $doc->exportCaption($this->value_reward);
                    $doc->exportCaption($this->value_inval);
                    $doc->exportCaption($this->piket_count);
                    $doc->exportCaption($this->value_piket);
                    $doc->exportCaption($this->tugastambahan);
                    $doc->exportCaption($this->tj_jabatan);
                    $doc->exportCaption($this->sub_total);
                    $doc->exportCaption($this->potongan);
                    $doc->exportCaption($this->total);
                    $doc->exportCaption($this->month);
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
                        $doc->exportField($this->jabatan_id);
                        $doc->exportField($this->pegawai);
                        $doc->exportField($this->lembur);
                        $doc->exportField($this->value_lembur);
                        $doc->exportField($this->kehadiran);
                        $doc->exportField($this->gapok);
                        $doc->exportField($this->value_reward);
                        $doc->exportField($this->value_inval);
                        $doc->exportField($this->piket_count);
                        $doc->exportField($this->value_piket);
                        $doc->exportField($this->tugastambahan);
                        $doc->exportField($this->tj_jabatan);
                        $doc->exportField($this->sub_total);
                        $doc->exportField($this->potongan);
                        $doc->exportField($this->total);
                        $doc->exportField($this->month);
                        $doc->exportField($this->datetime);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->jabatan_id);
                        $doc->exportField($this->pegawai);
                        $doc->exportField($this->lembur);
                        $doc->exportField($this->value_lembur);
                        $doc->exportField($this->kehadiran);
                        $doc->exportField($this->gapok);
                        $doc->exportField($this->value_reward);
                        $doc->exportField($this->value_inval);
                        $doc->exportField($this->piket_count);
                        $doc->exportField($this->value_piket);
                        $doc->exportField($this->tugastambahan);
                        $doc->exportField($this->tj_jabatan);
                        $doc->exportField($this->sub_total);
                        $doc->exportField($this->potongan);
                        $doc->exportField($this->total);
                        $doc->exportField($this->month);
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

    // Write Audit Trail start/end for grid update
    public function writeAuditTrailDummy($typ)
    {
        $table = 'gaji';
        $usr = CurrentUserName();
        WriteAuditLog($usr, $typ, $table, "", "", "", "");
    }

    // Write Audit Trail (add page)
    public function writeAuditTrailOnAdd(&$rs)
    {
        global $Language;
        if (!$this->AuditTrailOnAdd) {
            return;
        }
        $table = 'gaji';

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rs['id'];

        // Write Audit Trail
        $usr = CurrentUserName();
        foreach (array_keys($rs) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && $this->Fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") {
                    $newvalue = $Language->phrase("PasswordMask"); // Password Field
                } elseif ($this->Fields[$fldname]->DataType == DATATYPE_MEMO) {
                    if (Config("AUDIT_TRAIL_TO_DATABASE")) {
                        $newvalue = $rs[$fldname];
                    } else {
                        $newvalue = "[MEMO]"; // Memo Field
                    }
                } elseif ($this->Fields[$fldname]->DataType == DATATYPE_XML) {
                    $newvalue = "[XML]"; // XML Field
                } else {
                    $newvalue = $rs[$fldname];
                }
                WriteAuditLog($usr, "A", $table, $fldname, $key, "", $newvalue);
            }
        }
    }

    // Write Audit Trail (edit page)
    public function writeAuditTrailOnEdit(&$rsold, &$rsnew)
    {
        global $Language;
        if (!$this->AuditTrailOnEdit) {
            return;
        }
        $table = 'gaji';

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rsold['id'];

        // Write Audit Trail
        $usr = CurrentUserName();
        foreach (array_keys($rsnew) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && array_key_exists($fldname, $rsold) && $this->Fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->DataType == DATATYPE_DATE) { // DateTime field
                    $modified = (FormatDateTime($rsold[$fldname], 0) != FormatDateTime($rsnew[$fldname], 0));
                } else {
                    $modified = !CompareValue($rsold[$fldname], $rsnew[$fldname]);
                }
                if ($modified) {
                    if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") { // Password Field
                        $oldvalue = $Language->phrase("PasswordMask");
                        $newvalue = $Language->phrase("PasswordMask");
                    } elseif ($this->Fields[$fldname]->DataType == DATATYPE_MEMO) { // Memo field
                        if (Config("AUDIT_TRAIL_TO_DATABASE")) {
                            $oldvalue = $rsold[$fldname];
                            $newvalue = $rsnew[$fldname];
                        } else {
                            $oldvalue = "[MEMO]";
                            $newvalue = "[MEMO]";
                        }
                    } elseif ($this->Fields[$fldname]->DataType == DATATYPE_XML) { // XML field
                        $oldvalue = "[XML]";
                        $newvalue = "[XML]";
                    } else {
                        $oldvalue = $rsold[$fldname];
                        $newvalue = $rsnew[$fldname];
                    }
                    WriteAuditLog($usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
                }
            }
        }
    }

    // Write Audit Trail (delete page)
    public function writeAuditTrailOnDelete(&$rs)
    {
        global $Language;
        if (!$this->AuditTrailOnDelete) {
            return;
        }
        $table = 'gaji';

        // Get key value
        $key = "";
        if ($key != "") {
            $key .= Config("COMPOSITE_KEY_SEPARATOR");
        }
        $key .= $rs['id'];

        // Write Audit Trail
        $curUser = CurrentUserName();
        foreach (array_keys($rs) as $fldname) {
            if (array_key_exists($fldname, $this->Fields) && $this->Fields[$fldname]->DataType != DATATYPE_BLOB) { // Ignore BLOB fields
                if ($this->Fields[$fldname]->HtmlTag == "PASSWORD") {
                    $oldvalue = $Language->phrase("PasswordMask"); // Password Field
                } elseif ($this->Fields[$fldname]->DataType == DATATYPE_MEMO) {
                    if (Config("AUDIT_TRAIL_TO_DATABASE")) {
                        $oldvalue = $rs[$fldname];
                    } else {
                        $oldvalue = "[MEMO]"; // Memo field
                    }
                } elseif ($this->Fields[$fldname]->DataType == DATATYPE_XML) {
                    $oldvalue = "[XML]"; // XML field
                } else {
                    $oldvalue = $rs[$fldname];
                }
                WriteAuditLog($curUser, "D", $table, $fldname, $key, $oldvalue, "");
            }
        }
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
                    // $querygaji = ExecuteRow("SELECT month FROM  gaji WHERE id");
                       //$querypotongan = ExecuteRow("SELECT * FROM  potongan WHERE gaji.pegawai = potongan.nama");
                        //$querypotongan = ExecuteRow("SELECT * FROM gaji JOIN potongan ON gaji.pegawai = potongan.nama WHERE gaji.month = potongan.month");
                       $querypotongan = ExecuteRow("SELECT * FROM potongan JOIN gaji ON  potongan.nama =  gaji.pegawai WHERE gaji.pegawai = potongan.nama");
                                if ($this->jabatan_id->CurrentValue == '1'){
                                    // 1 untuk jabatan HRD
                                    //$querypotongan = ExecuteRow("SELECT * FROM potongan INNER JOIN gaji ON potongan.nama = gaji.pegawai  WHERE potongan.month = gaji.month");
                                    $query2 = ExecuteRow("SELECT * FROM jabatan JOIN gajitunjangan ON jabatan.id = gajitunjangan.pidjabatan where gajitunjangan.pidjabatan='1'");
                                    $rsnew["value_lembur"] = $query2["lembur"];
                                    $rsnew["gapok"] = $query2["gapok"];
                                    $rsnew["value_inval"] = $query2["inval"];
                                    $rsnew["value_reward"] = $query2["reward"];
                                    $rsnew["value_piket"] = $query2["piket"];
                                    $rsnew["tj_jabatan"] = $query2["tj_jabatan"];
                                    $rsnew["tugastambahan"] = $query2["jam_lebih"];
                                    $rsnew["sub_total"] = ($rsnew["lembur"] * $query2["lembur"]) + ($rsnew["piket_count"] * $query3["piket"]) + $query2["inval"] + $query2["tunjangan_jabatan"] + $query2["jam_lebih"] + $query2["reward"] +  ($rsnew["kehadiran"] * $query2["gapok"]);
                                    $rsnew["potongan"] = $querypotongan["total"];
                                    $rsnew["total"] = $rsnew["sub_total"] - $rsnew["potongan"];
                                }else{
                                    //$querypotongan = ExecuteRow("SELECT * FROM potongan INNER JOIN gaji ON potongan.nama = gaji.pegawai  WHERE potongan.month = gaji.month");
                                    // 2 untuk jabatan HRD    
                                    $query3 = ExecuteRow("SELECT * FROM jabatan JOIN gajitunjangan ON jabatan.id = gajitunjangan.pidjabatan where gajitunjangan.pidjabatan='2'");
                                    $rsnew["value_lembur"] = $query3["lembur"];
                                    $rsnew["gapok"] = $query3["gapok"];
                                    $rsnew["value_inval"] = $query3["inval"];
                                    $rsnew["value_reward"] = $query3["reward"];
                                    $rsnew["value_piket"] = $query3["piket"];
                                    $rsnew["tj_jabatan"] = $query3["tunjangan_jabatan"];
                                    $rsnew["tugastambahan"] = $query3["jam_lebih"];
                                    $rsnew["sub_total"] = ($rsnew["lembur"] * $query3["lembur"]) + ($rsnew["piket_count"] * $query3["piket"]) + $query3["inval"] + $query3["tunjangan_jabatan"] + $query3["jam_lebih"] + $query3["reward"] +  ($rsnew["kehadiran"] * $query3["gapok"]);
                                    $rsnew["potongan"] = $querypotongan["total"];
                                    $rsnew["total"] = $rsnew["sub_total"] - $rsnew["potongan"];
                                }
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
        /*if ($this->jabatan_id->CurrentValue == '1'){
                    $wsquery2 = ExecuteRow("SELECT * FROM jabatan JOIN gajitunjangan ON jabatan.id = gajitunjangan.pidjabatan where gajitunjangan.pidjabatan='1'");
                    $this->total->ViewValue = ($this->lembur->CurrentValue * $wsquery2["lembur"]) + ($this->piket_count->CurrentValue * $wsquery2["piket"]) + $wsquery2["inval"] + $wsquery2["tunjangan_jabatan"] + $wsquery2["tugas_tambahan"] + $wsquery2["reward"] + ($this->kehadiran->CurrentValue * $wsquery2["gapok"]);
        }else{
                    $wsquery3 = ExecuteRow("SELECT * FROM jabatan JOIN gajitunjangan ON jabatan.id = gajitunjangan.pidjabatan where gajitunjangan.pidjabatan='2'");
                    $this->total->ViewValue = ($this->lembur->CurrentValue * $wsquery3["lembur"]) + ($this->piket_count->CurrentValue * $wsquery3["piket"]) + $wsquery3["inval"] + $wsquery3["tunjangan_jabatan"] + $wsquery3["tugas_tambahan"] + $wsquery3["reward"] +  ($this->kehadiran->CurrentValue * $wsquery3["gapok"]);
            }*/
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
