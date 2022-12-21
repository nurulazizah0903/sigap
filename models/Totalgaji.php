<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for totalgaji
 */
class Totalgaji extends DbTable
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
    public $nama;
    public $jabatan;
    public $valuejabatan;
    public $valuetunjangan;
    public $value_lembur;
    public $Column7;
    public $Column8;
    public $Column9;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'totalgaji';
        $this->TableName = 'totalgaji';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`totalgaji`";
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
            'totalgaji',
            'totalgaji',
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
            'TEXT'
        );
        $this->id->InputTextType = "text";
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // nama
        $this->nama = new DbField(
            'totalgaji',
            'totalgaji',
            'x_nama',
            'nama',
            '`nama`',
            '`nama`',
            3,
            11,
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
        $this->nama->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['nama'] = &$this->nama;

        // jabatan
        $this->jabatan = new DbField(
            'totalgaji',
            'totalgaji',
            'x_jabatan',
            'jabatan',
            '`jabatan`',
            '`jabatan`',
            3,
            11,
            -1,
            false,
            '`jabatan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->jabatan->InputTextType = "text";
        $this->jabatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jabatan'] = &$this->jabatan;

        // valuejabatan
        $this->valuejabatan = new DbField(
            'totalgaji',
            'totalgaji',
            'x_valuejabatan',
            'valuejabatan',
            '`valuejabatan`',
            '`valuejabatan`',
            20,
            20,
            -1,
            false,
            '`valuejabatan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->valuejabatan->InputTextType = "text";
        $this->valuejabatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['valuejabatan'] = &$this->valuejabatan;

        // valuetunjangan
        $this->valuetunjangan = new DbField(
            'totalgaji',
            'totalgaji',
            'x_valuetunjangan',
            'valuetunjangan',
            '`valuetunjangan`',
            '`valuetunjangan`',
            20,
            20,
            -1,
            false,
            '`valuetunjangan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->valuetunjangan->InputTextType = "text";
        $this->valuetunjangan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['valuetunjangan'] = &$this->valuetunjangan;

        // value_lembur
        $this->value_lembur = new DbField(
            'totalgaji',
            'totalgaji',
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

        // Column 7
        $this->Column7 = new DbField(
            'totalgaji',
            'totalgaji',
            'x_Column7',
            'Column 7',
            '`Column 7`',
            '`Column 7`',
            3,
            11,
            -1,
            false,
            '`Column 7`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->Column7->InputTextType = "text";
        $this->Column7->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Column 7'] = &$this->Column7;

        // Column 8
        $this->Column8 = new DbField(
            'totalgaji',
            'totalgaji',
            'x_Column8',
            'Column 8',
            '`Column 8`',
            '`Column 8`',
            3,
            11,
            -1,
            false,
            '`Column 8`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->Column8->InputTextType = "text";
        $this->Column8->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Column 8'] = &$this->Column8;

        // Column 9
        $this->Column9 = new DbField(
            'totalgaji',
            'totalgaji',
            'x_Column9',
            'Column 9',
            '`Column 9`',
            '`Column 9`',
            3,
            11,
            -1,
            false,
            '`Column 9`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->Column9->InputTextType = "text";
        $this->Column9->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['Column 9'] = &$this->Column9;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`totalgaji`";
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
        $this->nama->DbValue = $row['nama'];
        $this->jabatan->DbValue = $row['jabatan'];
        $this->valuejabatan->DbValue = $row['valuejabatan'];
        $this->valuetunjangan->DbValue = $row['valuetunjangan'];
        $this->value_lembur->DbValue = $row['value_lembur'];
        $this->Column7->DbValue = $row['Column 7'];
        $this->Column8->DbValue = $row['Column 8'];
        $this->Column9->DbValue = $row['Column 9'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
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
        return $_SESSION[$name] ?? GetUrl("TotalgajiList");
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
        if ($pageName == "TotalgajiView") {
            return $Language->phrase("View");
        } elseif ($pageName == "TotalgajiEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "TotalgajiAdd") {
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
                return "TotalgajiView";
            case Config("API_ADD_ACTION"):
                return "TotalgajiAdd";
            case Config("API_EDIT_ACTION"):
                return "TotalgajiEdit";
            case Config("API_DELETE_ACTION"):
                return "TotalgajiDelete";
            case Config("API_LIST_ACTION"):
                return "TotalgajiList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "TotalgajiList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("TotalgajiView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("TotalgajiView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "TotalgajiAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "TotalgajiAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("TotalgajiEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("TotalgajiAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("TotalgajiDelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
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
            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
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
        $this->nama->setDbValue($row['nama']);
        $this->jabatan->setDbValue($row['jabatan']);
        $this->valuejabatan->setDbValue($row['valuejabatan']);
        $this->valuetunjangan->setDbValue($row['valuetunjangan']);
        $this->value_lembur->setDbValue($row['value_lembur']);
        $this->Column7->setDbValue($row['Column 7']);
        $this->Column8->setDbValue($row['Column 8']);
        $this->Column9->setDbValue($row['Column 9']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // nama

        // jabatan

        // valuejabatan

        // valuetunjangan

        // value_lembur

        // Column 7

        // Column 8

        // Column 9

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewValue = FormatNumber($this->id->ViewValue, $this->id->formatPattern());
        $this->id->ViewCustomAttributes = "";

        // nama
        $this->nama->ViewValue = $this->nama->CurrentValue;
        $this->nama->ViewValue = FormatNumber($this->nama->ViewValue, $this->nama->formatPattern());
        $this->nama->ViewCustomAttributes = "";

        // jabatan
        $this->jabatan->ViewValue = $this->jabatan->CurrentValue;
        $this->jabatan->ViewValue = FormatNumber($this->jabatan->ViewValue, $this->jabatan->formatPattern());
        $this->jabatan->ViewCustomAttributes = "";

        // valuejabatan
        $this->valuejabatan->ViewValue = $this->valuejabatan->CurrentValue;
        $this->valuejabatan->ViewValue = FormatNumber($this->valuejabatan->ViewValue, $this->valuejabatan->formatPattern());
        $this->valuejabatan->ViewCustomAttributes = "";

        // valuetunjangan
        $this->valuetunjangan->ViewValue = $this->valuetunjangan->CurrentValue;
        $this->valuetunjangan->ViewValue = FormatNumber($this->valuetunjangan->ViewValue, $this->valuetunjangan->formatPattern());
        $this->valuetunjangan->ViewCustomAttributes = "";

        // value_lembur
        $this->value_lembur->ViewValue = $this->value_lembur->CurrentValue;
        $this->value_lembur->ViewValue = FormatNumber($this->value_lembur->ViewValue, $this->value_lembur->formatPattern());
        $this->value_lembur->ViewCustomAttributes = "";

        // Column 7
        $this->Column7->ViewValue = $this->Column7->CurrentValue;
        $this->Column7->ViewValue = FormatNumber($this->Column7->ViewValue, $this->Column7->formatPattern());
        $this->Column7->ViewCustomAttributes = "";

        // Column 8
        $this->Column8->ViewValue = $this->Column8->CurrentValue;
        $this->Column8->ViewValue = FormatNumber($this->Column8->ViewValue, $this->Column8->formatPattern());
        $this->Column8->ViewCustomAttributes = "";

        // Column 9
        $this->Column9->ViewValue = $this->Column9->CurrentValue;
        $this->Column9->ViewValue = FormatNumber($this->Column9->ViewValue, $this->Column9->formatPattern());
        $this->Column9->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // nama
        $this->nama->LinkCustomAttributes = "";
        $this->nama->HrefValue = "";
        $this->nama->TooltipValue = "";

        // jabatan
        $this->jabatan->LinkCustomAttributes = "";
        $this->jabatan->HrefValue = "";
        $this->jabatan->TooltipValue = "";

        // valuejabatan
        $this->valuejabatan->LinkCustomAttributes = "";
        $this->valuejabatan->HrefValue = "";
        $this->valuejabatan->TooltipValue = "";

        // valuetunjangan
        $this->valuetunjangan->LinkCustomAttributes = "";
        $this->valuetunjangan->HrefValue = "";
        $this->valuetunjangan->TooltipValue = "";

        // value_lembur
        $this->value_lembur->LinkCustomAttributes = "";
        $this->value_lembur->HrefValue = "";
        $this->value_lembur->TooltipValue = "";

        // Column 7
        $this->Column7->LinkCustomAttributes = "";
        $this->Column7->HrefValue = "";
        $this->Column7->TooltipValue = "";

        // Column 8
        $this->Column8->LinkCustomAttributes = "";
        $this->Column8->HrefValue = "";
        $this->Column8->TooltipValue = "";

        // Column 9
        $this->Column9->LinkCustomAttributes = "";
        $this->Column9->HrefValue = "";
        $this->Column9->TooltipValue = "";

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
        $this->id->PlaceHolder = RemoveHtml($this->id->caption());
        if (strval($this->id->EditValue) != "" && is_numeric($this->id->EditValue)) {
            $this->id->EditValue = FormatNumber($this->id->EditValue, null);
        }

        // nama
        $this->nama->setupEditAttributes();
        $this->nama->EditCustomAttributes = "";
        $this->nama->EditValue = $this->nama->CurrentValue;
        $this->nama->PlaceHolder = RemoveHtml($this->nama->caption());
        if (strval($this->nama->EditValue) != "" && is_numeric($this->nama->EditValue)) {
            $this->nama->EditValue = FormatNumber($this->nama->EditValue, null);
        }

        // jabatan
        $this->jabatan->setupEditAttributes();
        $this->jabatan->EditCustomAttributes = "";
        $this->jabatan->EditValue = $this->jabatan->CurrentValue;
        $this->jabatan->PlaceHolder = RemoveHtml($this->jabatan->caption());
        if (strval($this->jabatan->EditValue) != "" && is_numeric($this->jabatan->EditValue)) {
            $this->jabatan->EditValue = FormatNumber($this->jabatan->EditValue, null);
        }

        // valuejabatan
        $this->valuejabatan->setupEditAttributes();
        $this->valuejabatan->EditCustomAttributes = "";
        $this->valuejabatan->EditValue = $this->valuejabatan->CurrentValue;
        $this->valuejabatan->PlaceHolder = RemoveHtml($this->valuejabatan->caption());
        if (strval($this->valuejabatan->EditValue) != "" && is_numeric($this->valuejabatan->EditValue)) {
            $this->valuejabatan->EditValue = FormatNumber($this->valuejabatan->EditValue, null);
        }

        // valuetunjangan
        $this->valuetunjangan->setupEditAttributes();
        $this->valuetunjangan->EditCustomAttributes = "";
        $this->valuetunjangan->EditValue = $this->valuetunjangan->CurrentValue;
        $this->valuetunjangan->PlaceHolder = RemoveHtml($this->valuetunjangan->caption());
        if (strval($this->valuetunjangan->EditValue) != "" && is_numeric($this->valuetunjangan->EditValue)) {
            $this->valuetunjangan->EditValue = FormatNumber($this->valuetunjangan->EditValue, null);
        }

        // value_lembur
        $this->value_lembur->setupEditAttributes();
        $this->value_lembur->EditCustomAttributes = "";
        $this->value_lembur->EditValue = $this->value_lembur->CurrentValue;
        $this->value_lembur->PlaceHolder = RemoveHtml($this->value_lembur->caption());
        if (strval($this->value_lembur->EditValue) != "" && is_numeric($this->value_lembur->EditValue)) {
            $this->value_lembur->EditValue = FormatNumber($this->value_lembur->EditValue, null);
        }

        // Column 7
        $this->Column7->setupEditAttributes();
        $this->Column7->EditCustomAttributes = "";
        $this->Column7->EditValue = $this->Column7->CurrentValue;
        $this->Column7->PlaceHolder = RemoveHtml($this->Column7->caption());
        if (strval($this->Column7->EditValue) != "" && is_numeric($this->Column7->EditValue)) {
            $this->Column7->EditValue = FormatNumber($this->Column7->EditValue, null);
        }

        // Column 8
        $this->Column8->setupEditAttributes();
        $this->Column8->EditCustomAttributes = "";
        $this->Column8->EditValue = $this->Column8->CurrentValue;
        $this->Column8->PlaceHolder = RemoveHtml($this->Column8->caption());
        if (strval($this->Column8->EditValue) != "" && is_numeric($this->Column8->EditValue)) {
            $this->Column8->EditValue = FormatNumber($this->Column8->EditValue, null);
        }

        // Column 9
        $this->Column9->setupEditAttributes();
        $this->Column9->EditCustomAttributes = "";
        $this->Column9->EditValue = $this->Column9->CurrentValue;
        $this->Column9->PlaceHolder = RemoveHtml($this->Column9->caption());
        if (strval($this->Column9->EditValue) != "" && is_numeric($this->Column9->EditValue)) {
            $this->Column9->EditValue = FormatNumber($this->Column9->EditValue, null);
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
                    $doc->exportCaption($this->nama);
                    $doc->exportCaption($this->jabatan);
                    $doc->exportCaption($this->valuejabatan);
                    $doc->exportCaption($this->valuetunjangan);
                    $doc->exportCaption($this->value_lembur);
                    $doc->exportCaption($this->Column7);
                    $doc->exportCaption($this->Column8);
                    $doc->exportCaption($this->Column9);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->nama);
                    $doc->exportCaption($this->jabatan);
                    $doc->exportCaption($this->valuejabatan);
                    $doc->exportCaption($this->valuetunjangan);
                    $doc->exportCaption($this->value_lembur);
                    $doc->exportCaption($this->Column7);
                    $doc->exportCaption($this->Column8);
                    $doc->exportCaption($this->Column9);
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
                        $doc->exportField($this->nama);
                        $doc->exportField($this->jabatan);
                        $doc->exportField($this->valuejabatan);
                        $doc->exportField($this->valuetunjangan);
                        $doc->exportField($this->value_lembur);
                        $doc->exportField($this->Column7);
                        $doc->exportField($this->Column8);
                        $doc->exportField($this->Column9);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->nama);
                        $doc->exportField($this->jabatan);
                        $doc->exportField($this->valuejabatan);
                        $doc->exportField($this->valuetunjangan);
                        $doc->exportField($this->value_lembur);
                        $doc->exportField($this->Column7);
                        $doc->exportField($this->Column8);
                        $doc->exportField($this->Column9);
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
