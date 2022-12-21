<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for uangmuka
 */
class Uangmuka extends DbTable
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
    public $tgl;
    public $pembayar;
    public $peruntukan;
    public $penerima;
    public $rek_penerima;
    public $tgl_terima;
    public $total_terima;
    public $tgl_tgjb;
    public $jumlah_tgjb;
    public $jenis;
    public $keterangan;
    public $bukti1;
    public $bukti2;
    public $bukti3;
    public $bukti4;
    public $disetujui;
    public $status;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'uangmuka';
        $this->TableName = 'uangmuka';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`uangmuka`";
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
            'uangmuka',
            'uangmuka',
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

        // tgl
        $this->tgl = new DbField(
            'uangmuka',
            'uangmuka',
            'x_tgl',
            'tgl',
            '`tgl`',
            CastDateFieldForLike("`tgl`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`tgl`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tgl->InputTextType = "text";
        $this->tgl->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['tgl'] = &$this->tgl;

        // pembayar
        $this->pembayar = new DbField(
            'uangmuka',
            'uangmuka',
            'x_pembayar',
            'pembayar',
            '`pembayar`',
            '`pembayar`',
            3,
            11,
            -1,
            false,
            '`pembayar`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->pembayar->InputTextType = "text";
        $this->pembayar->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->pembayar->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->pembayar->Lookup = new Lookup('pembayar', 'pegawai', false, 'id', ["nama","","",""], [], [], [], [], [], [], '', '', "`nama`");
                break;
            default:
                $this->pembayar->Lookup = new Lookup('pembayar', 'pegawai', false, 'id', ["nama","","",""], [], [], [], [], [], [], '', '', "`nama`");
                break;
        }
        $this->pembayar->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['pembayar'] = &$this->pembayar;

        // peruntukan
        $this->peruntukan = new DbField(
            'uangmuka',
            'uangmuka',
            'x_peruntukan',
            'peruntukan',
            '`peruntukan`',
            '`peruntukan`',
            200,
            255,
            -1,
            false,
            '`peruntukan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->peruntukan->InputTextType = "text";
        $this->Fields['peruntukan'] = &$this->peruntukan;

        // penerima
        $this->penerima = new DbField(
            'uangmuka',
            'uangmuka',
            'x_penerima',
            'penerima',
            '`penerima`',
            '`penerima`',
            3,
            11,
            -1,
            false,
            '`penerima`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->penerima->InputTextType = "text";
        switch ($CurrentLanguage) {
            case "en-US":
                $this->penerima->Lookup = new Lookup('penerima', 'pegawai', false, 'id', ["nama","","",""], [], [], [], [], [], [], '', '', "`nama`");
                break;
            default:
                $this->penerima->Lookup = new Lookup('penerima', 'pegawai', false, 'id', ["nama","","",""], [], [], [], [], [], [], '', '', "`nama`");
                break;
        }
        $this->penerima->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['penerima'] = &$this->penerima;

        // rek_penerima
        $this->rek_penerima = new DbField(
            'uangmuka',
            'uangmuka',
            'x_rek_penerima',
            'rek_penerima',
            '`rek_penerima`',
            '`rek_penerima`',
            200,
            255,
            -1,
            false,
            '`rek_penerima`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->rek_penerima->InputTextType = "text";
        $this->Fields['rek_penerima'] = &$this->rek_penerima;

        // tgl_terima
        $this->tgl_terima = new DbField(
            'uangmuka',
            'uangmuka',
            'x_tgl_terima',
            'tgl_terima',
            '`tgl_terima`',
            CastDateFieldForLike("`tgl_terima`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`tgl_terima`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tgl_terima->InputTextType = "text";
        $this->tgl_terima->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['tgl_terima'] = &$this->tgl_terima;

        // total_terima
        $this->total_terima = new DbField(
            'uangmuka',
            'uangmuka',
            'x_total_terima',
            'total_terima',
            '`total_terima`',
            '`total_terima`',
            3,
            255,
            -1,
            false,
            '`total_terima`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->total_terima->InputTextType = "text";
        $this->total_terima->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['total_terima'] = &$this->total_terima;

        // tgl_tgjb
        $this->tgl_tgjb = new DbField(
            'uangmuka',
            'uangmuka',
            'x_tgl_tgjb',
            'tgl_tgjb',
            '`tgl_tgjb`',
            CastDateFieldForLike("`tgl_tgjb`", 0, "DB"),
            135,
            19,
            0,
            false,
            '`tgl_tgjb`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tgl_tgjb->InputTextType = "text";
        $this->tgl_tgjb->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['tgl_tgjb'] = &$this->tgl_tgjb;

        // jumlah_tgjb
        $this->jumlah_tgjb = new DbField(
            'uangmuka',
            'uangmuka',
            'x_jumlah_tgjb',
            'jumlah_tgjb',
            '`jumlah_tgjb`',
            '`jumlah_tgjb`',
            3,
            255,
            -1,
            false,
            '`jumlah_tgjb`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->jumlah_tgjb->InputTextType = "text";
        $this->jumlah_tgjb->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jumlah_tgjb'] = &$this->jumlah_tgjb;

        // jenis
        $this->jenis = new DbField(
            'uangmuka',
            'uangmuka',
            'x_jenis',
            'jenis',
            '`jenis`',
            '`jenis`',
            200,
            255,
            -1,
            false,
            '`jenis`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->jenis->InputTextType = "text";
        $this->Fields['jenis'] = &$this->jenis;

        // keterangan
        $this->keterangan = new DbField(
            'uangmuka',
            'uangmuka',
            'x_keterangan',
            'keterangan',
            '`keterangan`',
            '`keterangan`',
            201,
            500,
            -1,
            false,
            '`keterangan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXTAREA'
        );
        $this->keterangan->InputTextType = "text";
        $this->Fields['keterangan'] = &$this->keterangan;

        // bukti1
        $this->bukti1 = new DbField(
            'uangmuka',
            'uangmuka',
            'x_bukti1',
            'bukti1',
            '`bukti1`',
            '`bukti1`',
            200,
            255,
            -1,
            true,
            '`bukti1`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'FILE'
        );
        $this->bukti1->InputTextType = "text";
        $this->bukti1->UploadPath = "uangmuka_bukti1";
        $this->Fields['bukti1'] = &$this->bukti1;

        // bukti2
        $this->bukti2 = new DbField(
            'uangmuka',
            'uangmuka',
            'x_bukti2',
            'bukti2',
            '`bukti2`',
            '`bukti2`',
            200,
            255,
            -1,
            true,
            '`bukti2`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'FILE'
        );
        $this->bukti2->InputTextType = "text";
        $this->bukti2->UploadPath = "uangmuka_bukti2";
        $this->Fields['bukti2'] = &$this->bukti2;

        // bukti3
        $this->bukti3 = new DbField(
            'uangmuka',
            'uangmuka',
            'x_bukti3',
            'bukti3',
            '`bukti3`',
            '`bukti3`',
            200,
            255,
            -1,
            true,
            '`bukti3`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'FILE'
        );
        $this->bukti3->InputTextType = "text";
        $this->bukti3->UploadPath = "uangmuka_bukti3";
        $this->Fields['bukti3'] = &$this->bukti3;

        // bukti4
        $this->bukti4 = new DbField(
            'uangmuka',
            'uangmuka',
            'x_bukti4',
            'bukti4',
            '`bukti4`',
            '`bukti4`',
            200,
            255,
            -1,
            true,
            '`bukti4`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'FILE'
        );
        $this->bukti4->InputTextType = "text";
        $this->bukti4->UploadPath = "uangmuka_bukti4";
        $this->Fields['bukti4'] = &$this->bukti4;

        // disetujui
        $this->disetujui = new DbField(
            'uangmuka',
            'uangmuka',
            'x_disetujui',
            'disetujui',
            '`disetujui`',
            '`disetujui`',
            200,
            5,
            -1,
            false,
            '`disetujui`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'RADIO'
        );
        $this->disetujui->InputTextType = "text";
        switch ($CurrentLanguage) {
            case "en-US":
                $this->disetujui->Lookup = new Lookup('disetujui', 'uangmuka', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
                break;
            default:
                $this->disetujui->Lookup = new Lookup('disetujui', 'uangmuka', false, '', ["","","",""], [], [], [], [], [], [], '', '', "");
                break;
        }
        $this->disetujui->OptionCount = 2;
        $this->Fields['disetujui'] = &$this->disetujui;

        // status
        $this->status = new DbField(
            'uangmuka',
            'uangmuka',
            'x_status',
            'status',
            '`status`',
            '`status`',
            200,
            20,
            -1,
            false,
            '`status`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->status->InputTextType = "text";
        $this->Fields['status'] = &$this->status;

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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`uangmuka`";
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
        $this->tgl->DbValue = $row['tgl'];
        $this->pembayar->DbValue = $row['pembayar'];
        $this->peruntukan->DbValue = $row['peruntukan'];
        $this->penerima->DbValue = $row['penerima'];
        $this->rek_penerima->DbValue = $row['rek_penerima'];
        $this->tgl_terima->DbValue = $row['tgl_terima'];
        $this->total_terima->DbValue = $row['total_terima'];
        $this->tgl_tgjb->DbValue = $row['tgl_tgjb'];
        $this->jumlah_tgjb->DbValue = $row['jumlah_tgjb'];
        $this->jenis->DbValue = $row['jenis'];
        $this->keterangan->DbValue = $row['keterangan'];
        $this->bukti1->Upload->DbValue = $row['bukti1'];
        $this->bukti2->Upload->DbValue = $row['bukti2'];
        $this->bukti3->Upload->DbValue = $row['bukti3'];
        $this->bukti4->Upload->DbValue = $row['bukti4'];
        $this->disetujui->DbValue = $row['disetujui'];
        $this->status->DbValue = $row['status'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
        $this->bukti1->OldUploadPath = "uangmuka_bukti1";
        $oldFiles = EmptyValue($row['bukti1']) ? [] : [$row['bukti1']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->bukti1->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->bukti1->oldPhysicalUploadPath() . $oldFile);
            }
        }
        $this->bukti2->OldUploadPath = "uangmuka_bukti2";
        $oldFiles = EmptyValue($row['bukti2']) ? [] : [$row['bukti2']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->bukti2->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->bukti2->oldPhysicalUploadPath() . $oldFile);
            }
        }
        $this->bukti3->OldUploadPath = "uangmuka_bukti3";
        $oldFiles = EmptyValue($row['bukti3']) ? [] : [$row['bukti3']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->bukti3->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->bukti3->oldPhysicalUploadPath() . $oldFile);
            }
        }
        $this->bukti4->OldUploadPath = "uangmuka_bukti4";
        $oldFiles = EmptyValue($row['bukti4']) ? [] : [$row['bukti4']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->bukti4->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->bukti4->oldPhysicalUploadPath() . $oldFile);
            }
        }
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
        return $_SESSION[$name] ?? GetUrl("UangmukaList");
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
        if ($pageName == "UangmukaView") {
            return $Language->phrase("View");
        } elseif ($pageName == "UangmukaEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "UangmukaAdd") {
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
                return "UangmukaView";
            case Config("API_ADD_ACTION"):
                return "UangmukaAdd";
            case Config("API_EDIT_ACTION"):
                return "UangmukaEdit";
            case Config("API_DELETE_ACTION"):
                return "UangmukaDelete";
            case Config("API_LIST_ACTION"):
                return "UangmukaList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "UangmukaList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("UangmukaView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("UangmukaView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "UangmukaAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "UangmukaAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("UangmukaEdit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("UangmukaAdd", $this->getUrlParm($parm));
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
        return $this->keyUrl("UangmukaDelete", $this->getUrlParm());
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
        $this->tgl->setDbValue($row['tgl']);
        $this->pembayar->setDbValue($row['pembayar']);
        $this->peruntukan->setDbValue($row['peruntukan']);
        $this->penerima->setDbValue($row['penerima']);
        $this->rek_penerima->setDbValue($row['rek_penerima']);
        $this->tgl_terima->setDbValue($row['tgl_terima']);
        $this->total_terima->setDbValue($row['total_terima']);
        $this->tgl_tgjb->setDbValue($row['tgl_tgjb']);
        $this->jumlah_tgjb->setDbValue($row['jumlah_tgjb']);
        $this->jenis->setDbValue($row['jenis']);
        $this->keterangan->setDbValue($row['keterangan']);
        $this->bukti1->Upload->DbValue = $row['bukti1'];
        $this->bukti2->Upload->DbValue = $row['bukti2'];
        $this->bukti3->Upload->DbValue = $row['bukti3'];
        $this->bukti4->Upload->DbValue = $row['bukti4'];
        $this->disetujui->setDbValue($row['disetujui']);
        $this->status->setDbValue($row['status']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // tgl

        // pembayar

        // peruntukan

        // penerima

        // rek_penerima

        // tgl_terima

        // total_terima

        // tgl_tgjb

        // jumlah_tgjb

        // jenis

        // keterangan

        // bukti1

        // bukti2

        // bukti3

        // bukti4

        // disetujui

        // status

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // tgl
        $this->tgl->ViewValue = $this->tgl->CurrentValue;
        $this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, $this->tgl->formatPattern());
        $this->tgl->ViewCustomAttributes = "";

        // pembayar
        $curVal = strval($this->pembayar->CurrentValue);
        if ($curVal != "") {
            $this->pembayar->ViewValue = $this->pembayar->lookupCacheOption($curVal);
            if ($this->pembayar->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->pembayar->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->pembayar->Lookup->renderViewRow($rswrk[0]);
                    $this->pembayar->ViewValue = $this->pembayar->displayValue($arwrk);
                } else {
                    $this->pembayar->ViewValue = FormatNumber($this->pembayar->CurrentValue, $this->pembayar->formatPattern());
                }
            }
        } else {
            $this->pembayar->ViewValue = null;
        }
        $this->pembayar->ViewCustomAttributes = "";

        // peruntukan
        $this->peruntukan->ViewValue = $this->peruntukan->CurrentValue;
        $this->peruntukan->ViewCustomAttributes = "";

        // penerima
        $this->penerima->ViewValue = $this->penerima->CurrentValue;
        $curVal = strval($this->penerima->CurrentValue);
        if ($curVal != "") {
            $this->penerima->ViewValue = $this->penerima->lookupCacheOption($curVal);
            if ($this->penerima->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $sqlWrk = $this->penerima->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $conn = Conn();
                $config = $conn->getConfiguration();
                $config->setResultCacheImpl($this->Cache);
                $rswrk = $conn->executeCacheQuery($sqlWrk, [], [], $this->CacheProfile)->fetchAll();
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->penerima->Lookup->renderViewRow($rswrk[0]);
                    $this->penerima->ViewValue = $this->penerima->displayValue($arwrk);
                } else {
                    $this->penerima->ViewValue = FormatNumber($this->penerima->CurrentValue, $this->penerima->formatPattern());
                }
            }
        } else {
            $this->penerima->ViewValue = null;
        }
        $this->penerima->ViewCustomAttributes = "";

        // rek_penerima
        $this->rek_penerima->ViewValue = $this->rek_penerima->CurrentValue;
        $this->rek_penerima->ViewCustomAttributes = "";

        // tgl_terima
        $this->tgl_terima->ViewValue = $this->tgl_terima->CurrentValue;
        $this->tgl_terima->ViewValue = FormatDateTime($this->tgl_terima->ViewValue, $this->tgl_terima->formatPattern());
        $this->tgl_terima->ViewCustomAttributes = "";

        // total_terima
        $this->total_terima->ViewValue = $this->total_terima->CurrentValue;
        $this->total_terima->ViewValue = FormatNumber($this->total_terima->ViewValue, $this->total_terima->formatPattern());
        $this->total_terima->ViewCustomAttributes = "";

        // tgl_tgjb
        $this->tgl_tgjb->ViewValue = $this->tgl_tgjb->CurrentValue;
        $this->tgl_tgjb->ViewValue = FormatDateTime($this->tgl_tgjb->ViewValue, $this->tgl_tgjb->formatPattern());
        $this->tgl_tgjb->ViewCustomAttributes = "";

        // jumlah_tgjb
        $this->jumlah_tgjb->ViewValue = $this->jumlah_tgjb->CurrentValue;
        $this->jumlah_tgjb->ViewValue = FormatNumber($this->jumlah_tgjb->ViewValue, $this->jumlah_tgjb->formatPattern());
        $this->jumlah_tgjb->ViewCustomAttributes = "";

        // jenis
        $this->jenis->ViewValue = $this->jenis->CurrentValue;
        $this->jenis->ViewCustomAttributes = "";

        // keterangan
        $this->keterangan->ViewValue = $this->keterangan->CurrentValue;
        $this->keterangan->ViewCustomAttributes = "";

        // bukti1
        $this->bukti1->UploadPath = "uangmuka_bukti1";
        if (!EmptyValue($this->bukti1->Upload->DbValue)) {
            $this->bukti1->ViewValue = $this->bukti1->Upload->DbValue;
        } else {
            $this->bukti1->ViewValue = "";
        }
        $this->bukti1->ViewCustomAttributes = "";

        // bukti2
        $this->bukti2->UploadPath = "uangmuka_bukti2";
        if (!EmptyValue($this->bukti2->Upload->DbValue)) {
            $this->bukti2->ViewValue = $this->bukti2->Upload->DbValue;
        } else {
            $this->bukti2->ViewValue = "";
        }
        $this->bukti2->ViewCustomAttributes = "";

        // bukti3
        $this->bukti3->UploadPath = "uangmuka_bukti3";
        if (!EmptyValue($this->bukti3->Upload->DbValue)) {
            $this->bukti3->ViewValue = $this->bukti3->Upload->DbValue;
        } else {
            $this->bukti3->ViewValue = "";
        }
        $this->bukti3->ViewCustomAttributes = "";

        // bukti4
        $this->bukti4->UploadPath = "uangmuka_bukti4";
        if (!EmptyValue($this->bukti4->Upload->DbValue)) {
            $this->bukti4->ViewValue = $this->bukti4->Upload->DbValue;
        } else {
            $this->bukti4->ViewValue = "";
        }
        $this->bukti4->ViewCustomAttributes = "";

        // disetujui
        if (strval($this->disetujui->CurrentValue) != "") {
            $this->disetujui->ViewValue = $this->disetujui->optionCaption($this->disetujui->CurrentValue);
        } else {
            $this->disetujui->ViewValue = null;
        }
        $this->disetujui->ViewCustomAttributes = "";

        // status
        $this->status->ViewValue = $this->status->CurrentValue;
        $this->status->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // tgl
        $this->tgl->LinkCustomAttributes = "";
        $this->tgl->HrefValue = "";
        $this->tgl->TooltipValue = "";

        // pembayar
        $this->pembayar->LinkCustomAttributes = "";
        $this->pembayar->HrefValue = "";
        $this->pembayar->TooltipValue = "";

        // peruntukan
        $this->peruntukan->LinkCustomAttributes = "";
        $this->peruntukan->HrefValue = "";
        $this->peruntukan->TooltipValue = "";

        // penerima
        $this->penerima->LinkCustomAttributes = "";
        $this->penerima->HrefValue = "";
        $this->penerima->TooltipValue = "";

        // rek_penerima
        $this->rek_penerima->LinkCustomAttributes = "";
        $this->rek_penerima->HrefValue = "";
        $this->rek_penerima->TooltipValue = "";

        // tgl_terima
        $this->tgl_terima->LinkCustomAttributes = "";
        $this->tgl_terima->HrefValue = "";
        $this->tgl_terima->TooltipValue = "";

        // total_terima
        $this->total_terima->LinkCustomAttributes = "";
        $this->total_terima->HrefValue = "";
        $this->total_terima->TooltipValue = "";

        // tgl_tgjb
        $this->tgl_tgjb->LinkCustomAttributes = "";
        $this->tgl_tgjb->HrefValue = "";
        $this->tgl_tgjb->TooltipValue = "";

        // jumlah_tgjb
        $this->jumlah_tgjb->LinkCustomAttributes = "";
        $this->jumlah_tgjb->HrefValue = "";
        $this->jumlah_tgjb->TooltipValue = "";

        // jenis
        $this->jenis->LinkCustomAttributes = "";
        $this->jenis->HrefValue = "";
        $this->jenis->TooltipValue = "";

        // keterangan
        $this->keterangan->LinkCustomAttributes = "";
        $this->keterangan->HrefValue = "";
        $this->keterangan->TooltipValue = "";

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

        // disetujui
        $this->disetujui->LinkCustomAttributes = "";
        $this->disetujui->HrefValue = "";
        $this->disetujui->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

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

        // tgl
        $this->tgl->setupEditAttributes();
        $this->tgl->EditCustomAttributes = "";
        $this->tgl->EditValue = FormatDateTime($this->tgl->CurrentValue, $this->tgl->formatPattern());
        $this->tgl->PlaceHolder = RemoveHtml($this->tgl->caption());

        // pembayar
        $this->pembayar->setupEditAttributes();
        $this->pembayar->EditCustomAttributes = "";
        $this->pembayar->PlaceHolder = RemoveHtml($this->pembayar->caption());

        // peruntukan
        $this->peruntukan->setupEditAttributes();
        $this->peruntukan->EditCustomAttributes = "";
        if (!$this->peruntukan->Raw) {
            $this->peruntukan->CurrentValue = HtmlDecode($this->peruntukan->CurrentValue);
        }
        $this->peruntukan->EditValue = $this->peruntukan->CurrentValue;
        $this->peruntukan->PlaceHolder = RemoveHtml($this->peruntukan->caption());

        // penerima
        $this->penerima->setupEditAttributes();
        $this->penerima->EditCustomAttributes = "";
        $this->penerima->EditValue = $this->penerima->CurrentValue;
        $this->penerima->PlaceHolder = RemoveHtml($this->penerima->caption());

        // rek_penerima
        $this->rek_penerima->setupEditAttributes();
        $this->rek_penerima->EditCustomAttributes = "";
        if (!$this->rek_penerima->Raw) {
            $this->rek_penerima->CurrentValue = HtmlDecode($this->rek_penerima->CurrentValue);
        }
        $this->rek_penerima->EditValue = $this->rek_penerima->CurrentValue;
        $this->rek_penerima->PlaceHolder = RemoveHtml($this->rek_penerima->caption());

        // tgl_terima
        $this->tgl_terima->setupEditAttributes();
        $this->tgl_terima->EditCustomAttributes = "";
        $this->tgl_terima->EditValue = FormatDateTime($this->tgl_terima->CurrentValue, $this->tgl_terima->formatPattern());
        $this->tgl_terima->PlaceHolder = RemoveHtml($this->tgl_terima->caption());

        // total_terima
        $this->total_terima->setupEditAttributes();
        $this->total_terima->EditCustomAttributes = "";
        $this->total_terima->EditValue = $this->total_terima->CurrentValue;
        $this->total_terima->PlaceHolder = RemoveHtml($this->total_terima->caption());
        if (strval($this->total_terima->EditValue) != "" && is_numeric($this->total_terima->EditValue)) {
            $this->total_terima->EditValue = FormatNumber($this->total_terima->EditValue, null);
        }

        // tgl_tgjb
        $this->tgl_tgjb->setupEditAttributes();
        $this->tgl_tgjb->EditCustomAttributes = "";
        $this->tgl_tgjb->EditValue = FormatDateTime($this->tgl_tgjb->CurrentValue, $this->tgl_tgjb->formatPattern());
        $this->tgl_tgjb->PlaceHolder = RemoveHtml($this->tgl_tgjb->caption());

        // jumlah_tgjb
        $this->jumlah_tgjb->setupEditAttributes();
        $this->jumlah_tgjb->EditCustomAttributes = "";
        $this->jumlah_tgjb->EditValue = $this->jumlah_tgjb->CurrentValue;
        $this->jumlah_tgjb->PlaceHolder = RemoveHtml($this->jumlah_tgjb->caption());
        if (strval($this->jumlah_tgjb->EditValue) != "" && is_numeric($this->jumlah_tgjb->EditValue)) {
            $this->jumlah_tgjb->EditValue = FormatNumber($this->jumlah_tgjb->EditValue, null);
        }

        // jenis
        $this->jenis->setupEditAttributes();
        $this->jenis->EditCustomAttributes = "";
        if (!$this->jenis->Raw) {
            $this->jenis->CurrentValue = HtmlDecode($this->jenis->CurrentValue);
        }
        $this->jenis->EditValue = $this->jenis->CurrentValue;
        $this->jenis->PlaceHolder = RemoveHtml($this->jenis->caption());

        // keterangan
        $this->keterangan->setupEditAttributes();
        $this->keterangan->EditCustomAttributes = "";
        $this->keterangan->EditValue = $this->keterangan->CurrentValue;
        $this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

        // bukti1
        $this->bukti1->setupEditAttributes();
        $this->bukti1->EditCustomAttributes = "";
        $this->bukti1->UploadPath = "uangmuka_bukti1";
        if (!EmptyValue($this->bukti1->Upload->DbValue)) {
            $this->bukti1->EditValue = $this->bukti1->Upload->DbValue;
        } else {
            $this->bukti1->EditValue = "";
        }
        if (!EmptyValue($this->bukti1->CurrentValue)) {
            $this->bukti1->Upload->FileName = $this->bukti1->CurrentValue;
        }

        // bukti2
        $this->bukti2->setupEditAttributes();
        $this->bukti2->EditCustomAttributes = "";
        $this->bukti2->UploadPath = "uangmuka_bukti2";
        if (!EmptyValue($this->bukti2->Upload->DbValue)) {
            $this->bukti2->EditValue = $this->bukti2->Upload->DbValue;
        } else {
            $this->bukti2->EditValue = "";
        }
        if (!EmptyValue($this->bukti2->CurrentValue)) {
            $this->bukti2->Upload->FileName = $this->bukti2->CurrentValue;
        }

        // bukti3
        $this->bukti3->setupEditAttributes();
        $this->bukti3->EditCustomAttributes = "";
        $this->bukti3->UploadPath = "uangmuka_bukti3";
        if (!EmptyValue($this->bukti3->Upload->DbValue)) {
            $this->bukti3->EditValue = $this->bukti3->Upload->DbValue;
        } else {
            $this->bukti3->EditValue = "";
        }
        if (!EmptyValue($this->bukti3->CurrentValue)) {
            $this->bukti3->Upload->FileName = $this->bukti3->CurrentValue;
        }

        // bukti4
        $this->bukti4->setupEditAttributes();
        $this->bukti4->EditCustomAttributes = "";
        $this->bukti4->UploadPath = "uangmuka_bukti4";
        if (!EmptyValue($this->bukti4->Upload->DbValue)) {
            $this->bukti4->EditValue = $this->bukti4->Upload->DbValue;
        } else {
            $this->bukti4->EditValue = "";
        }
        if (!EmptyValue($this->bukti4->CurrentValue)) {
            $this->bukti4->Upload->FileName = $this->bukti4->CurrentValue;
        }

        // disetujui
        $this->disetujui->EditCustomAttributes = "";
        $this->disetujui->EditValue = $this->disetujui->options(false);
        $this->disetujui->PlaceHolder = RemoveHtml($this->disetujui->caption());

        // status
        $this->status->setupEditAttributes();
        $this->status->EditCustomAttributes = "";
        if (!$this->status->Raw) {
            $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
        }
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

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
                    $doc->exportCaption($this->tgl);
                    $doc->exportCaption($this->pembayar);
                    $doc->exportCaption($this->peruntukan);
                    $doc->exportCaption($this->penerima);
                    $doc->exportCaption($this->rek_penerima);
                    $doc->exportCaption($this->tgl_terima);
                    $doc->exportCaption($this->total_terima);
                    $doc->exportCaption($this->tgl_tgjb);
                    $doc->exportCaption($this->jumlah_tgjb);
                    $doc->exportCaption($this->jenis);
                    $doc->exportCaption($this->keterangan);
                    $doc->exportCaption($this->bukti1);
                    $doc->exportCaption($this->bukti2);
                    $doc->exportCaption($this->bukti3);
                    $doc->exportCaption($this->bukti4);
                    $doc->exportCaption($this->disetujui);
                    $doc->exportCaption($this->status);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->tgl);
                    $doc->exportCaption($this->pembayar);
                    $doc->exportCaption($this->peruntukan);
                    $doc->exportCaption($this->penerima);
                    $doc->exportCaption($this->rek_penerima);
                    $doc->exportCaption($this->tgl_terima);
                    $doc->exportCaption($this->total_terima);
                    $doc->exportCaption($this->tgl_tgjb);
                    $doc->exportCaption($this->jumlah_tgjb);
                    $doc->exportCaption($this->jenis);
                    $doc->exportCaption($this->bukti1);
                    $doc->exportCaption($this->bukti2);
                    $doc->exportCaption($this->bukti3);
                    $doc->exportCaption($this->bukti4);
                    $doc->exportCaption($this->disetujui);
                    $doc->exportCaption($this->status);
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
                        $doc->exportField($this->tgl);
                        $doc->exportField($this->pembayar);
                        $doc->exportField($this->peruntukan);
                        $doc->exportField($this->penerima);
                        $doc->exportField($this->rek_penerima);
                        $doc->exportField($this->tgl_terima);
                        $doc->exportField($this->total_terima);
                        $doc->exportField($this->tgl_tgjb);
                        $doc->exportField($this->jumlah_tgjb);
                        $doc->exportField($this->jenis);
                        $doc->exportField($this->keterangan);
                        $doc->exportField($this->bukti1);
                        $doc->exportField($this->bukti2);
                        $doc->exportField($this->bukti3);
                        $doc->exportField($this->bukti4);
                        $doc->exportField($this->disetujui);
                        $doc->exportField($this->status);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->tgl);
                        $doc->exportField($this->pembayar);
                        $doc->exportField($this->peruntukan);
                        $doc->exportField($this->penerima);
                        $doc->exportField($this->rek_penerima);
                        $doc->exportField($this->tgl_terima);
                        $doc->exportField($this->total_terima);
                        $doc->exportField($this->tgl_tgjb);
                        $doc->exportField($this->jumlah_tgjb);
                        $doc->exportField($this->jenis);
                        $doc->exportField($this->bukti1);
                        $doc->exportField($this->bukti2);
                        $doc->exportField($this->bukti3);
                        $doc->exportField($this->bukti4);
                        $doc->exportField($this->disetujui);
                        $doc->exportField($this->status);
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
        $width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
        $height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

        // Set up field name / file name field / file type field
        $fldName = "";
        $fileNameFld = "";
        $fileTypeFld = "";
        if ($fldparm == 'bukti1') {
            $fldName = "bukti1";
            $fileNameFld = "bukti1";
        } elseif ($fldparm == 'bukti2') {
            $fldName = "bukti2";
            $fileNameFld = "bukti2";
        } elseif ($fldparm == 'bukti3') {
            $fldName = "bukti3";
            $fileNameFld = "bukti3";
        } elseif ($fldparm == 'bukti4') {
            $fldName = "bukti4";
            $fileNameFld = "bukti4";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 1) {
            $this->id->CurrentValue = $ar[0];
        } else {
            return false; // Incorrect key
        }

        // Set up filter (WHERE Clause)
        $filter = $this->getRecordFilter();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $dbtype = GetConnectionType($this->Dbid);
        if ($row = $conn->fetchAssociative($sql)) {
            $val = $row[$fldName];
            if (!EmptyValue($val)) {
                $fld = $this->Fields[$fldName];

                // Binary data
                if ($fld->DataType == DATATYPE_BLOB) {
                    if ($dbtype != "MYSQL") {
                        if (is_resource($val) && get_resource_type($val) == "stream") { // Byte array
                            $val = stream_get_contents($val);
                        }
                    }
                    if ($resize) {
                        ResizeBinary($val, $width, $height, $plugins);
                    }

                    // Write file type
                    if ($fileTypeFld != "" && !EmptyValue($row[$fileTypeFld])) {
                        AddHeader("Content-type", $row[$fileTypeFld]);
                    } else {
                        AddHeader("Content-type", ContentType($val));
                    }

                    // Write file name
                    $downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
                    if ($fileNameFld != "" && !EmptyValue($row[$fileNameFld])) {
                        $fileName = $row[$fileNameFld];
                        $pathinfo = pathinfo($fileName);
                        $ext = strtolower(@$pathinfo["extension"]);
                        $isPdf = SameText($ext, "pdf");
                        if ($downloadPdf || !$isPdf) { // Skip header if not download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    } else {
                        $ext = ContentExtension($val);
                        $isPdf = SameText($ext, ".pdf");
                        if ($isPdf && $downloadPdf) { // Add header if download PDF
                            AddHeader("Content-Disposition", "attachment" . ($DownloadFileName ? "; filename=\"" . $DownloadFileName . "\"" : ""));
                        }
                    }

                    // Write file data
                    if (
                        StartsString("PK", $val) &&
                        ContainsString($val, "[Content_Types].xml") &&
                        ContainsString($val, "_rels") &&
                        ContainsString($val, "docProps")
                    ) { // Fix Office 2007 documents
                        if (!EndsString("\0\0\0", $val)) { // Not ends with 3 or 4 \0
                            $val .= "\0\0\0\0";
                        }
                    }

                    // Clear any debug message
                    if (ob_get_length()) {
                        ob_end_clean();
                    }

                    // Write binary data
                    Write($val);

                // Upload to folder
                } else {
                    if ($fld->UploadMultiple) {
                        $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                    } else {
                        $files = [$val];
                    }
                    $data = [];
                    $ar = [];
                    foreach ($files as $file) {
                        if (!EmptyValue($file)) {
                            if (Config("ENCRYPT_FILE_PATH")) {
                                $ar[$file] = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $this->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                            } else {
                                $ar[$file] = FullUrl($fld->hrefPath() . $file);
                            }
                        }
                    }
                    $data[$fld->Param] = $ar;
                    WriteJson($data);
                }
            }
            return true;
        }
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
