<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for gajitunjangan
 */
class Gajitunjangan extends DbTable
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
    public $pidjabatan;
    public $gapok;
    public $value_kehadiran;
    public $tunjangan_jabatan;
    public $tunjangan_khusus;
    public $reward;
    public $lembur;
    public $piket;
    public $inval;
    public $jam_lebih;
    public $ekstrakuri;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'gajitunjangan';
        $this->TableName = 'gajitunjangan';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`gajitunjangan`";
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
            'gajitunjangan',
            'gajitunjangan',
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

        // pidjabatan
        $this->pidjabatan = new DbField(
            'gajitunjangan',
            'gajitunjangan',
            'x_pidjabatan',
            'pidjabatan',
            '`pidjabatan`',
            '`pidjabatan`',
            3,
            11,
            -1,
            false,
            '`pidjabatan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->pidjabatan->InputTextType = "text";
        $this->pidjabatan->IsForeignKey = true; // Foreign key field
        $this->pidjabatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['pidjabatan'] = &$this->pidjabatan;

        // gapok
        $this->gapok = new DbField(
            'gajitunjangan',
            'gajitunjangan',
            'x_gapok',
            'gapok',
            '`gapok`',
            '`gapok`',
            3,
            11,
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

        // value_kehadiran
        $this->value_kehadiran = new DbField(
            'gajitunjangan',
            'gajitunjangan',
            'x_value_kehadiran',
            'value_kehadiran',
            '`value_kehadiran`',
            '`value_kehadiran`',
            20,
            20,
            -1,
            false,
            '`value_kehadiran`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->value_kehadiran->InputTextType = "text";
        $this->value_kehadiran->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['value_kehadiran'] = &$this->value_kehadiran;

        // tunjangan_jabatan
        $this->tunjangan_jabatan = new DbField(
            'gajitunjangan',
            'gajitunjangan',
            'x_tunjangan_jabatan',
            'tunjangan_jabatan',
            '`tunjangan_jabatan`',
            '`tunjangan_jabatan`',
            3,
            11,
            -1,
            false,
            '`tunjangan_jabatan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tunjangan_jabatan->InputTextType = "text";
        $this->tunjangan_jabatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['tunjangan_jabatan'] = &$this->tunjangan_jabatan;

        // tunjangan_khusus
        $this->tunjangan_khusus = new DbField(
            'gajitunjangan',
            'gajitunjangan',
            'x_tunjangan_khusus',
            'tunjangan_khusus',
            '`tunjangan_khusus`',
            '`tunjangan_khusus`',
            20,
            20,
            -1,
            false,
            '`tunjangan_khusus`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tunjangan_khusus->InputTextType = "text";
        $this->tunjangan_khusus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['tunjangan_khusus'] = &$this->tunjangan_khusus;

        // reward
        $this->reward = new DbField(
            'gajitunjangan',
            'gajitunjangan',
            'x_reward',
            'reward',
            '`reward`',
            '`reward`',
            3,
            11,
            -1,
            false,
            '`reward`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->reward->InputTextType = "text";
        $this->reward->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['reward'] = &$this->reward;

        // lembur
        $this->lembur = new DbField(
            'gajitunjangan',
            'gajitunjangan',
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

        // piket
        $this->piket = new DbField(
            'gajitunjangan',
            'gajitunjangan',
            'x_piket',
            'piket',
            '`piket`',
            '`piket`',
            3,
            11,
            -1,
            false,
            '`piket`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->piket->InputTextType = "text";
        $this->piket->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['piket'] = &$this->piket;

        // inval
        $this->inval = new DbField(
            'gajitunjangan',
            'gajitunjangan',
            'x_inval',
            'inval',
            '`inval`',
            '`inval`',
            3,
            11,
            -1,
            false,
            '`inval`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->inval->InputTextType = "text";
        $this->inval->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['inval'] = &$this->inval;

        // jam_lebih
        $this->jam_lebih = new DbField(
            'gajitunjangan',
            'gajitunjangan',
            'x_jam_lebih',
            'jam_lebih',
            '`jam_lebih`',
            '`jam_lebih`',
            20,
            20,
            -1,
            false,
            '`jam_lebih`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->jam_lebih->InputTextType = "text";
        $this->jam_lebih->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jam_lebih'] = &$this->jam_lebih;

        // ekstrakuri
        $this->ekstrakuri = new DbField(
            'gajitunjangan',
            'gajitunjangan',
            'x_ekstrakuri',
            'ekstrakuri',
            '`ekstrakuri`',
            '`ekstrakuri`',
            20,
            20,
            -1,
            false,
            '`ekstrakuri`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->ekstrakuri->InputTextType = "text";
        $this->ekstrakuri->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['ekstrakuri'] = &$this->ekstrakuri;

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
        if ($this->getCurrentMasterTable() == "jabatan") {
            if ($this->pidjabatan->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("`id`", $this->pidjabatan->getSessionValue(), DATATYPE_NUMBER, "DB");
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
        if ($this->getCurrentMasterTable() == "jabatan") {
            if ($this->pidjabatan->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("`pidjabatan`", $this->pidjabatan->getSessionValue(), DATATYPE_NUMBER, "DB");
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
            case "jabatan":
                $key = $keys["pidjabatan"] ?? "";
                if (EmptyValue($key)) {
                    if ($masterTable->id->Required) { // Required field and empty value
                        return ""; // Return empty filter
                    }
                    $validKeys = false;
                } elseif (!$validKeys) { // Already has empty key
                    return ""; // Return empty filter
                }
                if ($validKeys) {
                    return "`id`=" . QuotedValue($keys["pidjabatan"], $masterTable->id->DataType, $masterTable->Dbid);
                }
                break;
        }
        return null; // All null values and no required fields
    }

    // Get detail filter
    public function getDetailFilter($masterTable)
    {
        switch ($masterTable->TableVar) {
            case "jabatan":
                return "`pidjabatan`=" . QuotedValue($masterTable->id->DbValue, $this->pidjabatan->DataType, $this->Dbid);
        }
        return "";
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`gajitunjangan`";
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
        $this->pidjabatan->DbValue = $row['pidjabatan'];
        $this->gapok->DbValue = $row['gapok'];
        $this->value_kehadiran->DbValue = $row['value_kehadiran'];
        $this->tunjangan_jabatan->DbValue = $row['tunjangan_jabatan'];
        $this->tunjangan_khusus->DbValue = $row['tunjangan_khusus'];
        $this->reward->DbValue = $row['reward'];
        $this->lembur->DbValue = $row['lembur'];
        $this->piket->DbValue = $row['piket'];
        $this->inval->DbValue = $row['inval'];
        $this->jam_lebih->DbValue = $row['jam_lebih'];
        $this->ekstrakuri->DbValue = $row['ekstrakuri'];
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
        return $_SESSION[$name] ?? GetUrl("GajitunjanganList");
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
        if ($pageName == "GajitunjanganView") {
            return $Language->phrase("View");
        } elseif ($pageName == "GajitunjanganEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "GajitunjanganAdd") {
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
                return "GajitunjanganView";
            case Config("API_ADD_ACTION"):
                return "GajitunjanganAdd";
            case Config("API_EDIT_ACTION"):
                return "GajitunjanganEdit";
            case Config("API_DELETE_ACTION"):
                return "GajitunjanganDelete";
            case Config("API_LIST_ACTION"):
                return "GajitunjanganList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "GajitunjanganList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("GajitunjanganView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("GajitunjanganView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "GajitunjanganAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "GajitunjanganAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("GajitunjanganEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("GajitunjanganAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("GajitunjanganDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        if ($this->getCurrentMasterTable() == "jabatan" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_id", $this->pidjabatan->CurrentValue);
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

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

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

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // pidjabatan
        $this->pidjabatan->LinkCustomAttributes = "";
        $this->pidjabatan->HrefValue = "";
        $this->pidjabatan->TooltipValue = "";

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

        // pidjabatan
        $this->pidjabatan->setupEditAttributes();
        $this->pidjabatan->EditCustomAttributes = "";
        if ($this->pidjabatan->getSessionValue() != "") {
            $this->pidjabatan->CurrentValue = GetForeignKeyValue($this->pidjabatan->getSessionValue());
            $this->pidjabatan->ViewValue = $this->pidjabatan->CurrentValue;
            $this->pidjabatan->ViewValue = FormatNumber($this->pidjabatan->ViewValue, $this->pidjabatan->formatPattern());
            $this->pidjabatan->ViewCustomAttributes = "";
        } else {
            $this->pidjabatan->EditValue = $this->pidjabatan->CurrentValue;
            $this->pidjabatan->PlaceHolder = RemoveHtml($this->pidjabatan->caption());
            if (strval($this->pidjabatan->EditValue) != "" && is_numeric($this->pidjabatan->EditValue)) {
                $this->pidjabatan->EditValue = FormatNumber($this->pidjabatan->EditValue, null);
            }
        }

        // gapok
        $this->gapok->setupEditAttributes();
        $this->gapok->EditCustomAttributes = "";
        $this->gapok->EditValue = $this->gapok->CurrentValue;
        $this->gapok->PlaceHolder = RemoveHtml($this->gapok->caption());
        if (strval($this->gapok->EditValue) != "" && is_numeric($this->gapok->EditValue)) {
            $this->gapok->EditValue = FormatNumber($this->gapok->EditValue, null);
        }

        // value_kehadiran
        $this->value_kehadiran->setupEditAttributes();
        $this->value_kehadiran->EditCustomAttributes = "";
        $this->value_kehadiran->EditValue = $this->value_kehadiran->CurrentValue;
        $this->value_kehadiran->PlaceHolder = RemoveHtml($this->value_kehadiran->caption());
        if (strval($this->value_kehadiran->EditValue) != "" && is_numeric($this->value_kehadiran->EditValue)) {
            $this->value_kehadiran->EditValue = FormatNumber($this->value_kehadiran->EditValue, null);
        }

        // tunjangan_jabatan
        $this->tunjangan_jabatan->setupEditAttributes();
        $this->tunjangan_jabatan->EditCustomAttributes = "";
        $this->tunjangan_jabatan->EditValue = $this->tunjangan_jabatan->CurrentValue;
        $this->tunjangan_jabatan->PlaceHolder = RemoveHtml($this->tunjangan_jabatan->caption());
        if (strval($this->tunjangan_jabatan->EditValue) != "" && is_numeric($this->tunjangan_jabatan->EditValue)) {
            $this->tunjangan_jabatan->EditValue = FormatNumber($this->tunjangan_jabatan->EditValue, null);
        }

        // tunjangan_khusus
        $this->tunjangan_khusus->setupEditAttributes();
        $this->tunjangan_khusus->EditCustomAttributes = "";
        $this->tunjangan_khusus->EditValue = $this->tunjangan_khusus->CurrentValue;
        $this->tunjangan_khusus->PlaceHolder = RemoveHtml($this->tunjangan_khusus->caption());
        if (strval($this->tunjangan_khusus->EditValue) != "" && is_numeric($this->tunjangan_khusus->EditValue)) {
            $this->tunjangan_khusus->EditValue = FormatNumber($this->tunjangan_khusus->EditValue, null);
        }

        // reward
        $this->reward->setupEditAttributes();
        $this->reward->EditCustomAttributes = "";
        $this->reward->EditValue = $this->reward->CurrentValue;
        $this->reward->PlaceHolder = RemoveHtml($this->reward->caption());
        if (strval($this->reward->EditValue) != "" && is_numeric($this->reward->EditValue)) {
            $this->reward->EditValue = FormatNumber($this->reward->EditValue, null);
        }

        // lembur
        $this->lembur->setupEditAttributes();
        $this->lembur->EditCustomAttributes = "";
        $this->lembur->EditValue = $this->lembur->CurrentValue;
        $this->lembur->PlaceHolder = RemoveHtml($this->lembur->caption());
        if (strval($this->lembur->EditValue) != "" && is_numeric($this->lembur->EditValue)) {
            $this->lembur->EditValue = FormatNumber($this->lembur->EditValue, null);
        }

        // piket
        $this->piket->setupEditAttributes();
        $this->piket->EditCustomAttributes = "";
        $this->piket->EditValue = $this->piket->CurrentValue;
        $this->piket->PlaceHolder = RemoveHtml($this->piket->caption());
        if (strval($this->piket->EditValue) != "" && is_numeric($this->piket->EditValue)) {
            $this->piket->EditValue = FormatNumber($this->piket->EditValue, null);
        }

        // inval
        $this->inval->setupEditAttributes();
        $this->inval->EditCustomAttributes = "";
        $this->inval->EditValue = $this->inval->CurrentValue;
        $this->inval->PlaceHolder = RemoveHtml($this->inval->caption());
        if (strval($this->inval->EditValue) != "" && is_numeric($this->inval->EditValue)) {
            $this->inval->EditValue = FormatNumber($this->inval->EditValue, null);
        }

        // jam_lebih
        $this->jam_lebih->setupEditAttributes();
        $this->jam_lebih->EditCustomAttributes = "";
        $this->jam_lebih->EditValue = $this->jam_lebih->CurrentValue;
        $this->jam_lebih->PlaceHolder = RemoveHtml($this->jam_lebih->caption());
        if (strval($this->jam_lebih->EditValue) != "" && is_numeric($this->jam_lebih->EditValue)) {
            $this->jam_lebih->EditValue = FormatNumber($this->jam_lebih->EditValue, null);
        }

        // ekstrakuri
        $this->ekstrakuri->setupEditAttributes();
        $this->ekstrakuri->EditCustomAttributes = "";
        $this->ekstrakuri->EditValue = $this->ekstrakuri->CurrentValue;
        $this->ekstrakuri->PlaceHolder = RemoveHtml($this->ekstrakuri->caption());
        if (strval($this->ekstrakuri->EditValue) != "" && is_numeric($this->ekstrakuri->EditValue)) {
            $this->ekstrakuri->EditValue = FormatNumber($this->ekstrakuri->EditValue, null);
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
                    $doc->exportCaption($this->pidjabatan);
                    $doc->exportCaption($this->gapok);
                    $doc->exportCaption($this->value_kehadiran);
                    $doc->exportCaption($this->tunjangan_jabatan);
                    $doc->exportCaption($this->tunjangan_khusus);
                    $doc->exportCaption($this->reward);
                    $doc->exportCaption($this->lembur);
                    $doc->exportCaption($this->piket);
                    $doc->exportCaption($this->inval);
                    $doc->exportCaption($this->jam_lebih);
                    $doc->exportCaption($this->ekstrakuri);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->pidjabatan);
                    $doc->exportCaption($this->gapok);
                    $doc->exportCaption($this->value_kehadiran);
                    $doc->exportCaption($this->tunjangan_jabatan);
                    $doc->exportCaption($this->tunjangan_khusus);
                    $doc->exportCaption($this->reward);
                    $doc->exportCaption($this->lembur);
                    $doc->exportCaption($this->piket);
                    $doc->exportCaption($this->inval);
                    $doc->exportCaption($this->jam_lebih);
                    $doc->exportCaption($this->ekstrakuri);
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
                        $doc->exportField($this->pidjabatan);
                        $doc->exportField($this->gapok);
                        $doc->exportField($this->value_kehadiran);
                        $doc->exportField($this->tunjangan_jabatan);
                        $doc->exportField($this->tunjangan_khusus);
                        $doc->exportField($this->reward);
                        $doc->exportField($this->lembur);
                        $doc->exportField($this->piket);
                        $doc->exportField($this->inval);
                        $doc->exportField($this->jam_lebih);
                        $doc->exportField($this->ekstrakuri);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->pidjabatan);
                        $doc->exportField($this->gapok);
                        $doc->exportField($this->value_kehadiran);
                        $doc->exportField($this->tunjangan_jabatan);
                        $doc->exportField($this->tunjangan_khusus);
                        $doc->exportField($this->reward);
                        $doc->exportField($this->lembur);
                        $doc->exportField($this->piket);
                        $doc->exportField($this->inval);
                        $doc->exportField($this->jam_lebih);
                        $doc->exportField($this->ekstrakuri);
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
