<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for testtable
 */
class Testtable extends DbTable
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
    public $date;
    public $nojob;
    public $stuffingdate;
    public $shipper;
    public $stuffingloc;
    public $party;
    public $typeparty;
    public $jumlahparty;
    public $shipping;
    public $bookingnumer;
    public $shippingline;
    public $port;
    public $surjal;
    public $nota;
    public $invoice;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'testtable';
        $this->TableName = 'testtable';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`testtable`";
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
            'testtable',
            'testtable',
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

        // date
        $this->date = new DbField(
            'testtable',
            'testtable',
            'x_date',
            'date',
            '`date`',
            CastDateFieldForLike("`date`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`date`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->date->InputTextType = "text";
        $this->date->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['date'] = &$this->date;

        // nojob
        $this->nojob = new DbField(
            'testtable',
            'testtable',
            'x_nojob',
            'nojob',
            '`nojob`',
            '`nojob`',
            200,
            50,
            -1,
            false,
            '`nojob`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->nojob->InputTextType = "text";
        $this->Fields['nojob'] = &$this->nojob;

        // stuffingdate
        $this->stuffingdate = new DbField(
            'testtable',
            'testtable',
            'x_stuffingdate',
            'stuffingdate',
            '`stuffingdate`',
            CastDateFieldForLike("`stuffingdate`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`stuffingdate`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->stuffingdate->InputTextType = "text";
        $this->stuffingdate->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['stuffingdate'] = &$this->stuffingdate;

        // shipper
        $this->shipper = new DbField(
            'testtable',
            'testtable',
            'x_shipper',
            'shipper',
            '`shipper`',
            '`shipper`',
            200,
            50,
            -1,
            false,
            '`shipper`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->shipper->InputTextType = "text";
        $this->Fields['shipper'] = &$this->shipper;

        // stuffingloc
        $this->stuffingloc = new DbField(
            'testtable',
            'testtable',
            'x_stuffingloc',
            'stuffingloc',
            '`stuffingloc`',
            '`stuffingloc`',
            200,
            50,
            -1,
            false,
            '`stuffingloc`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->stuffingloc->InputTextType = "text";
        $this->Fields['stuffingloc'] = &$this->stuffingloc;

        // party
        $this->party = new DbField(
            'testtable',
            'testtable',
            'x_party',
            'party',
            '`party`',
            '`party`',
            200,
            50,
            -1,
            false,
            '`party`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->party->InputTextType = "text";
        $this->Fields['party'] = &$this->party;

        // typeparty
        $this->typeparty = new DbField(
            'testtable',
            'testtable',
            'x_typeparty',
            'typeparty',
            '`typeparty`',
            '`typeparty`',
            200,
            50,
            -1,
            false,
            '`typeparty`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->typeparty->InputTextType = "text";
        $this->Fields['typeparty'] = &$this->typeparty;

        // jumlahparty
        $this->jumlahparty = new DbField(
            'testtable',
            'testtable',
            'x_jumlahparty',
            'jumlahparty',
            '`jumlahparty`',
            '`jumlahparty`',
            3,
            11,
            -1,
            false,
            '`jumlahparty`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->jumlahparty->InputTextType = "text";
        $this->jumlahparty->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jumlahparty'] = &$this->jumlahparty;

        // shipping
        $this->shipping = new DbField(
            'testtable',
            'testtable',
            'x_shipping',
            'shipping',
            '`shipping`',
            '`shipping`',
            200,
            50,
            -1,
            false,
            '`shipping`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->shipping->InputTextType = "text";
        $this->Fields['shipping'] = &$this->shipping;

        // bookingnumer
        $this->bookingnumer = new DbField(
            'testtable',
            'testtable',
            'x_bookingnumer',
            'bookingnumer',
            '`bookingnumer`',
            '`bookingnumer`',
            200,
            50,
            -1,
            false,
            '`bookingnumer`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->bookingnumer->InputTextType = "text";
        $this->Fields['bookingnumer'] = &$this->bookingnumer;

        // shippingline
        $this->shippingline = new DbField(
            'testtable',
            'testtable',
            'x_shippingline',
            'shippingline',
            '`shippingline`',
            '`shippingline`',
            200,
            50,
            -1,
            false,
            '`shippingline`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->shippingline->InputTextType = "text";
        $this->Fields['shippingline'] = &$this->shippingline;

        // port
        $this->port = new DbField(
            'testtable',
            'testtable',
            'x_port',
            'port',
            '`port`',
            '`port`',
            200,
            50,
            -1,
            false,
            '`port`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->port->InputTextType = "text";
        $this->Fields['port'] = &$this->port;

        // surjal
        $this->surjal = new DbField(
            'testtable',
            'testtable',
            'x_surjal',
            'surjal',
            '`surjal`',
            '`surjal`',
            200,
            50,
            -1,
            false,
            '`surjal`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->surjal->InputTextType = "text";
        $this->Fields['surjal'] = &$this->surjal;

        // nota
        $this->nota = new DbField(
            'testtable',
            'testtable',
            'x_nota',
            'nota',
            '`nota`',
            '`nota`',
            200,
            50,
            -1,
            false,
            '`nota`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->nota->InputTextType = "text";
        $this->Fields['nota'] = &$this->nota;

        // invoice
        $this->invoice = new DbField(
            'testtable',
            'testtable',
            'x_invoice',
            'invoice',
            '`invoice`',
            '`invoice`',
            200,
            50,
            -1,
            false,
            '`invoice`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->invoice->InputTextType = "text";
        $this->Fields['invoice'] = &$this->invoice;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`testtable`";
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
        $this->date->DbValue = $row['date'];
        $this->nojob->DbValue = $row['nojob'];
        $this->stuffingdate->DbValue = $row['stuffingdate'];
        $this->shipper->DbValue = $row['shipper'];
        $this->stuffingloc->DbValue = $row['stuffingloc'];
        $this->party->DbValue = $row['party'];
        $this->typeparty->DbValue = $row['typeparty'];
        $this->jumlahparty->DbValue = $row['jumlahparty'];
        $this->shipping->DbValue = $row['shipping'];
        $this->bookingnumer->DbValue = $row['bookingnumer'];
        $this->shippingline->DbValue = $row['shippingline'];
        $this->port->DbValue = $row['port'];
        $this->surjal->DbValue = $row['surjal'];
        $this->nota->DbValue = $row['nota'];
        $this->invoice->DbValue = $row['invoice'];
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
        return $_SESSION[$name] ?? GetUrl("TesttableList");
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
        if ($pageName == "TesttableView") {
            return $Language->phrase("View");
        } elseif ($pageName == "TesttableEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "TesttableAdd") {
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
                return "TesttableView";
            case Config("API_ADD_ACTION"):
                return "TesttableAdd";
            case Config("API_EDIT_ACTION"):
                return "TesttableEdit";
            case Config("API_DELETE_ACTION"):
                return "TesttableDelete";
            case Config("API_LIST_ACTION"):
                return "TesttableList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "TesttableList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("TesttableView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("TesttableView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "TesttableAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "TesttableAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("TesttableEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("TesttableAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("TesttableDelete", $this->getUrlParm());
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
        $this->date->setDbValue($row['date']);
        $this->nojob->setDbValue($row['nojob']);
        $this->stuffingdate->setDbValue($row['stuffingdate']);
        $this->shipper->setDbValue($row['shipper']);
        $this->stuffingloc->setDbValue($row['stuffingloc']);
        $this->party->setDbValue($row['party']);
        $this->typeparty->setDbValue($row['typeparty']);
        $this->jumlahparty->setDbValue($row['jumlahparty']);
        $this->shipping->setDbValue($row['shipping']);
        $this->bookingnumer->setDbValue($row['bookingnumer']);
        $this->shippingline->setDbValue($row['shippingline']);
        $this->port->setDbValue($row['port']);
        $this->surjal->setDbValue($row['surjal']);
        $this->nota->setDbValue($row['nota']);
        $this->invoice->setDbValue($row['invoice']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // date

        // nojob

        // stuffingdate

        // shipper

        // stuffingloc

        // party

        // typeparty

        // jumlahparty

        // shipping

        // bookingnumer

        // shippingline

        // port

        // surjal

        // nota

        // invoice

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // date
        $this->date->ViewValue = $this->date->CurrentValue;
        $this->date->ViewValue = FormatDateTime($this->date->ViewValue, $this->date->formatPattern());
        $this->date->ViewCustomAttributes = "";

        // nojob
        $this->nojob->ViewValue = $this->nojob->CurrentValue;
        $this->nojob->ViewCustomAttributes = "";

        // stuffingdate
        $this->stuffingdate->ViewValue = $this->stuffingdate->CurrentValue;
        $this->stuffingdate->ViewValue = FormatDateTime($this->stuffingdate->ViewValue, $this->stuffingdate->formatPattern());
        $this->stuffingdate->ViewCustomAttributes = "";

        // shipper
        $this->shipper->ViewValue = $this->shipper->CurrentValue;
        $this->shipper->ViewCustomAttributes = "";

        // stuffingloc
        $this->stuffingloc->ViewValue = $this->stuffingloc->CurrentValue;
        $this->stuffingloc->ViewCustomAttributes = "";

        // party
        $this->party->ViewValue = $this->party->CurrentValue;
        $this->party->ViewCustomAttributes = "";

        // typeparty
        $this->typeparty->ViewValue = $this->typeparty->CurrentValue;
        $this->typeparty->ViewCustomAttributes = "";

        // jumlahparty
        $this->jumlahparty->ViewValue = $this->jumlahparty->CurrentValue;
        $this->jumlahparty->ViewValue = FormatNumber($this->jumlahparty->ViewValue, $this->jumlahparty->formatPattern());
        $this->jumlahparty->ViewCustomAttributes = "";

        // shipping
        $this->shipping->ViewValue = $this->shipping->CurrentValue;
        $this->shipping->ViewCustomAttributes = "";

        // bookingnumer
        $this->bookingnumer->ViewValue = $this->bookingnumer->CurrentValue;
        $this->bookingnumer->ViewCustomAttributes = "";

        // shippingline
        $this->shippingline->ViewValue = $this->shippingline->CurrentValue;
        $this->shippingline->ViewCustomAttributes = "";

        // port
        $this->port->ViewValue = $this->port->CurrentValue;
        $this->port->ViewCustomAttributes = "";

        // surjal
        $this->surjal->ViewValue = $this->surjal->CurrentValue;
        $this->surjal->ViewCustomAttributes = "";

        // nota
        $this->nota->ViewValue = $this->nota->CurrentValue;
        $this->nota->ViewCustomAttributes = "";

        // invoice
        $this->invoice->ViewValue = $this->invoice->CurrentValue;
        $this->invoice->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // date
        $this->date->LinkCustomAttributes = "";
        $this->date->HrefValue = "";
        $this->date->TooltipValue = "";

        // nojob
        $this->nojob->LinkCustomAttributes = "";
        $this->nojob->HrefValue = "";
        $this->nojob->TooltipValue = "";

        // stuffingdate
        $this->stuffingdate->LinkCustomAttributes = "";
        $this->stuffingdate->HrefValue = "";
        $this->stuffingdate->TooltipValue = "";

        // shipper
        $this->shipper->LinkCustomAttributes = "";
        $this->shipper->HrefValue = "";
        $this->shipper->TooltipValue = "";

        // stuffingloc
        $this->stuffingloc->LinkCustomAttributes = "";
        $this->stuffingloc->HrefValue = "";
        $this->stuffingloc->TooltipValue = "";

        // party
        $this->party->LinkCustomAttributes = "";
        $this->party->HrefValue = "";
        $this->party->TooltipValue = "";

        // typeparty
        $this->typeparty->LinkCustomAttributes = "";
        $this->typeparty->HrefValue = "";
        $this->typeparty->TooltipValue = "";

        // jumlahparty
        $this->jumlahparty->LinkCustomAttributes = "";
        $this->jumlahparty->HrefValue = "";
        $this->jumlahparty->TooltipValue = "";

        // shipping
        $this->shipping->LinkCustomAttributes = "";
        $this->shipping->HrefValue = "";
        $this->shipping->TooltipValue = "";

        // bookingnumer
        $this->bookingnumer->LinkCustomAttributes = "";
        $this->bookingnumer->HrefValue = "";
        $this->bookingnumer->TooltipValue = "";

        // shippingline
        $this->shippingline->LinkCustomAttributes = "";
        $this->shippingline->HrefValue = "";
        $this->shippingline->TooltipValue = "";

        // port
        $this->port->LinkCustomAttributes = "";
        $this->port->HrefValue = "";
        $this->port->TooltipValue = "";

        // surjal
        $this->surjal->LinkCustomAttributes = "";
        $this->surjal->HrefValue = "";
        $this->surjal->TooltipValue = "";

        // nota
        $this->nota->LinkCustomAttributes = "";
        $this->nota->HrefValue = "";
        $this->nota->TooltipValue = "";

        // invoice
        $this->invoice->LinkCustomAttributes = "";
        $this->invoice->HrefValue = "";
        $this->invoice->TooltipValue = "";

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

        // date
        $this->date->setupEditAttributes();
        $this->date->EditCustomAttributes = "";
        $this->date->EditValue = FormatDateTime($this->date->CurrentValue, $this->date->formatPattern());
        $this->date->PlaceHolder = RemoveHtml($this->date->caption());

        // nojob
        $this->nojob->setupEditAttributes();
        $this->nojob->EditCustomAttributes = "";
        if (!$this->nojob->Raw) {
            $this->nojob->CurrentValue = HtmlDecode($this->nojob->CurrentValue);
        }
        $this->nojob->EditValue = $this->nojob->CurrentValue;
        $this->nojob->PlaceHolder = RemoveHtml($this->nojob->caption());

        // stuffingdate
        $this->stuffingdate->setupEditAttributes();
        $this->stuffingdate->EditCustomAttributes = "";
        $this->stuffingdate->EditValue = FormatDateTime($this->stuffingdate->CurrentValue, $this->stuffingdate->formatPattern());
        $this->stuffingdate->PlaceHolder = RemoveHtml($this->stuffingdate->caption());

        // shipper
        $this->shipper->setupEditAttributes();
        $this->shipper->EditCustomAttributes = "";
        if (!$this->shipper->Raw) {
            $this->shipper->CurrentValue = HtmlDecode($this->shipper->CurrentValue);
        }
        $this->shipper->EditValue = $this->shipper->CurrentValue;
        $this->shipper->PlaceHolder = RemoveHtml($this->shipper->caption());

        // stuffingloc
        $this->stuffingloc->setupEditAttributes();
        $this->stuffingloc->EditCustomAttributes = "";
        if (!$this->stuffingloc->Raw) {
            $this->stuffingloc->CurrentValue = HtmlDecode($this->stuffingloc->CurrentValue);
        }
        $this->stuffingloc->EditValue = $this->stuffingloc->CurrentValue;
        $this->stuffingloc->PlaceHolder = RemoveHtml($this->stuffingloc->caption());

        // party
        $this->party->setupEditAttributes();
        $this->party->EditCustomAttributes = "";
        if (!$this->party->Raw) {
            $this->party->CurrentValue = HtmlDecode($this->party->CurrentValue);
        }
        $this->party->EditValue = $this->party->CurrentValue;
        $this->party->PlaceHolder = RemoveHtml($this->party->caption());

        // typeparty
        $this->typeparty->setupEditAttributes();
        $this->typeparty->EditCustomAttributes = "";
        if (!$this->typeparty->Raw) {
            $this->typeparty->CurrentValue = HtmlDecode($this->typeparty->CurrentValue);
        }
        $this->typeparty->EditValue = $this->typeparty->CurrentValue;
        $this->typeparty->PlaceHolder = RemoveHtml($this->typeparty->caption());

        // jumlahparty
        $this->jumlahparty->setupEditAttributes();
        $this->jumlahparty->EditCustomAttributes = "";
        $this->jumlahparty->EditValue = $this->jumlahparty->CurrentValue;
        $this->jumlahparty->PlaceHolder = RemoveHtml($this->jumlahparty->caption());
        if (strval($this->jumlahparty->EditValue) != "" && is_numeric($this->jumlahparty->EditValue)) {
            $this->jumlahparty->EditValue = FormatNumber($this->jumlahparty->EditValue, null);
        }

        // shipping
        $this->shipping->setupEditAttributes();
        $this->shipping->EditCustomAttributes = "";
        if (!$this->shipping->Raw) {
            $this->shipping->CurrentValue = HtmlDecode($this->shipping->CurrentValue);
        }
        $this->shipping->EditValue = $this->shipping->CurrentValue;
        $this->shipping->PlaceHolder = RemoveHtml($this->shipping->caption());

        // bookingnumer
        $this->bookingnumer->setupEditAttributes();
        $this->bookingnumer->EditCustomAttributes = "";
        if (!$this->bookingnumer->Raw) {
            $this->bookingnumer->CurrentValue = HtmlDecode($this->bookingnumer->CurrentValue);
        }
        $this->bookingnumer->EditValue = $this->bookingnumer->CurrentValue;
        $this->bookingnumer->PlaceHolder = RemoveHtml($this->bookingnumer->caption());

        // shippingline
        $this->shippingline->setupEditAttributes();
        $this->shippingline->EditCustomAttributes = "";
        if (!$this->shippingline->Raw) {
            $this->shippingline->CurrentValue = HtmlDecode($this->shippingline->CurrentValue);
        }
        $this->shippingline->EditValue = $this->shippingline->CurrentValue;
        $this->shippingline->PlaceHolder = RemoveHtml($this->shippingline->caption());

        // port
        $this->port->setupEditAttributes();
        $this->port->EditCustomAttributes = "";
        if (!$this->port->Raw) {
            $this->port->CurrentValue = HtmlDecode($this->port->CurrentValue);
        }
        $this->port->EditValue = $this->port->CurrentValue;
        $this->port->PlaceHolder = RemoveHtml($this->port->caption());

        // surjal
        $this->surjal->setupEditAttributes();
        $this->surjal->EditCustomAttributes = "";
        if (!$this->surjal->Raw) {
            $this->surjal->CurrentValue = HtmlDecode($this->surjal->CurrentValue);
        }
        $this->surjal->EditValue = $this->surjal->CurrentValue;
        $this->surjal->PlaceHolder = RemoveHtml($this->surjal->caption());

        // nota
        $this->nota->setupEditAttributes();
        $this->nota->EditCustomAttributes = "";
        if (!$this->nota->Raw) {
            $this->nota->CurrentValue = HtmlDecode($this->nota->CurrentValue);
        }
        $this->nota->EditValue = $this->nota->CurrentValue;
        $this->nota->PlaceHolder = RemoveHtml($this->nota->caption());

        // invoice
        $this->invoice->setupEditAttributes();
        $this->invoice->EditCustomAttributes = "";
        if (!$this->invoice->Raw) {
            $this->invoice->CurrentValue = HtmlDecode($this->invoice->CurrentValue);
        }
        $this->invoice->EditValue = $this->invoice->CurrentValue;
        $this->invoice->PlaceHolder = RemoveHtml($this->invoice->caption());

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
                    $doc->exportCaption($this->date);
                    $doc->exportCaption($this->nojob);
                    $doc->exportCaption($this->stuffingdate);
                    $doc->exportCaption($this->shipper);
                    $doc->exportCaption($this->stuffingloc);
                    $doc->exportCaption($this->party);
                    $doc->exportCaption($this->typeparty);
                    $doc->exportCaption($this->jumlahparty);
                    $doc->exportCaption($this->shipping);
                    $doc->exportCaption($this->bookingnumer);
                    $doc->exportCaption($this->shippingline);
                    $doc->exportCaption($this->port);
                    $doc->exportCaption($this->surjal);
                    $doc->exportCaption($this->nota);
                    $doc->exportCaption($this->invoice);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->date);
                    $doc->exportCaption($this->nojob);
                    $doc->exportCaption($this->stuffingdate);
                    $doc->exportCaption($this->shipper);
                    $doc->exportCaption($this->stuffingloc);
                    $doc->exportCaption($this->party);
                    $doc->exportCaption($this->typeparty);
                    $doc->exportCaption($this->jumlahparty);
                    $doc->exportCaption($this->shipping);
                    $doc->exportCaption($this->bookingnumer);
                    $doc->exportCaption($this->shippingline);
                    $doc->exportCaption($this->port);
                    $doc->exportCaption($this->surjal);
                    $doc->exportCaption($this->nota);
                    $doc->exportCaption($this->invoice);
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
                        $doc->exportField($this->date);
                        $doc->exportField($this->nojob);
                        $doc->exportField($this->stuffingdate);
                        $doc->exportField($this->shipper);
                        $doc->exportField($this->stuffingloc);
                        $doc->exportField($this->party);
                        $doc->exportField($this->typeparty);
                        $doc->exportField($this->jumlahparty);
                        $doc->exportField($this->shipping);
                        $doc->exportField($this->bookingnumer);
                        $doc->exportField($this->shippingline);
                        $doc->exportField($this->port);
                        $doc->exportField($this->surjal);
                        $doc->exportField($this->nota);
                        $doc->exportField($this->invoice);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->date);
                        $doc->exportField($this->nojob);
                        $doc->exportField($this->stuffingdate);
                        $doc->exportField($this->shipper);
                        $doc->exportField($this->stuffingloc);
                        $doc->exportField($this->party);
                        $doc->exportField($this->typeparty);
                        $doc->exportField($this->jumlahparty);
                        $doc->exportField($this->shipping);
                        $doc->exportField($this->bookingnumer);
                        $doc->exportField($this->shippingline);
                        $doc->exportField($this->port);
                        $doc->exportField($this->surjal);
                        $doc->exportField($this->nota);
                        $doc->exportField($this->invoice);
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
