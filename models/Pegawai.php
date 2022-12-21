<?php

namespace PHPMaker2022\sigap;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\FetchMode;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * Table class for pegawai
 */
class Pegawai extends DbTable
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
    public $_username;
    public $_password;
    public $nip;
    public $nama;
    public $alamat;
    public $_email;
    public $wa;
    public $hp;
    public $tgllahir;
    public $rekbank;
    public $jenjang_id;
    public $pendidikan;
    public $jurusan;
    public $agama;
    public $jabatan;
    public $jenkel;
    public $mulai_bekerja;
    public $status;
    public $keterangan;
    public $level;
    public $aktif;
    public $foto;
    public $file_cv;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage, $CurrentLocale;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'pegawai';
        $this->TableName = 'pegawai';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`pegawai`";
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
            'pegawai',
            'pegawai',
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
        $this->id->IsForeignKey = true; // Foreign key field
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['id'] = &$this->id;

        // pid
        $this->pid = new DbField(
            'pegawai',
            'pegawai',
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
        $this->pid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['pid'] = &$this->pid;

        // username
        $this->_username = new DbField(
            'pegawai',
            'pegawai',
            'x__username',
            'username',
            '`username`',
            '`username`',
            200,
            255,
            -1,
            false,
            '`username`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_username->InputTextType = "text";
        $this->_username->Required = true; // Required field
        $this->Fields['username'] = &$this->_username;

        // password
        $this->_password = new DbField(
            'pegawai',
            'pegawai',
            'x__password',
            'password',
            '`password`',
            '`password`',
            200,
            255,
            -1,
            false,
            '`password`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_password->InputTextType = "text";
        if (Config("ENCRYPTED_PASSWORD")) {
            $this->_password->Raw = true;
        }
        $this->_password->Required = true; // Required field
        $this->Fields['password'] = &$this->_password;

        // nip
        $this->nip = new DbField(
            'pegawai',
            'pegawai',
            'x_nip',
            'nip',
            '`nip`',
            '`nip`',
            200,
            50,
            -1,
            false,
            '`nip`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->nip->InputTextType = "text";
        $this->Fields['nip'] = &$this->nip;

        // nama
        $this->nama = new DbField(
            'pegawai',
            'pegawai',
            'x_nama',
            'nama',
            '`nama`',
            '`nama`',
            200,
            255,
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

        // alamat
        $this->alamat = new DbField(
            'pegawai',
            'pegawai',
            'x_alamat',
            'alamat',
            '`alamat`',
            '`alamat`',
            200,
            255,
            -1,
            false,
            '`alamat`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->alamat->InputTextType = "text";
        $this->Fields['alamat'] = &$this->alamat;

        // email
        $this->_email = new DbField(
            'pegawai',
            'pegawai',
            'x__email',
            'email',
            '`email`',
            '`email`',
            200,
            255,
            -1,
            false,
            '`email`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->_email->InputTextType = "email";
        $this->Fields['email'] = &$this->_email;

        // wa
        $this->wa = new DbField(
            'pegawai',
            'pegawai',
            'x_wa',
            'wa',
            '`wa`',
            '`wa`',
            200,
            255,
            -1,
            false,
            '`wa`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->wa->InputTextType = "text";
        $this->Fields['wa'] = &$this->wa;

        // hp
        $this->hp = new DbField(
            'pegawai',
            'pegawai',
            'x_hp',
            'hp',
            '`hp`',
            '`hp`',
            200,
            255,
            -1,
            false,
            '`hp`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->hp->InputTextType = "text";
        $this->Fields['hp'] = &$this->hp;

        // tgllahir
        $this->tgllahir = new DbField(
            'pegawai',
            'pegawai',
            'x_tgllahir',
            'tgllahir',
            '`tgllahir`',
            CastDateFieldForLike("`tgllahir`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`tgllahir`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->tgllahir->InputTextType = "text";
        $this->tgllahir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['tgllahir'] = &$this->tgllahir;

        // rekbank
        $this->rekbank = new DbField(
            'pegawai',
            'pegawai',
            'x_rekbank',
            'rekbank',
            '`rekbank`',
            '`rekbank`',
            200,
            255,
            -1,
            false,
            '`rekbank`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->rekbank->InputTextType = "text";
        $this->Fields['rekbank'] = &$this->rekbank;

        // jenjang_id
        $this->jenjang_id = new DbField(
            'pegawai',
            'pegawai',
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
        switch ($CurrentLanguage) {
            case "en-US":
                $this->jenjang_id->Lookup = new Lookup('jenjang_id', 'tpendidikan', false, 'id', ["name","","",""], [], [], [], [], [], [], '', '', "`name`");
                break;
            default:
                $this->jenjang_id->Lookup = new Lookup('jenjang_id', 'tpendidikan', false, 'id', ["name","","",""], [], [], [], [], [], [], '', '', "`name`");
                break;
        }
        $this->jenjang_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jenjang_id'] = &$this->jenjang_id;

        // pendidikan
        $this->pendidikan = new DbField(
            'pegawai',
            'pegawai',
            'x_pendidikan',
            'pendidikan',
            '`pendidikan`',
            '`pendidikan`',
            3,
            11,
            -1,
            false,
            '`pendidikan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->pendidikan->InputTextType = "text";
        switch ($CurrentLanguage) {
            case "en-US":
                $this->pendidikan->Lookup = new Lookup('pendidikan', 'tpendidikan', false, 'id', ["name","","",""], [], [], [], [], [], [], '', '', "`name`");
                break;
            default:
                $this->pendidikan->Lookup = new Lookup('pendidikan', 'tpendidikan', false, 'id', ["name","","",""], [], [], [], [], [], [], '', '', "`name`");
                break;
        }
        $this->pendidikan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['pendidikan'] = &$this->pendidikan;

        // jurusan
        $this->jurusan = new DbField(
            'pegawai',
            'pegawai',
            'x_jurusan',
            'jurusan',
            '`jurusan`',
            '`jurusan`',
            200,
            50,
            -1,
            false,
            '`jurusan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->jurusan->InputTextType = "text";
        $this->Fields['jurusan'] = &$this->jurusan;

        // agama
        $this->agama = new DbField(
            'pegawai',
            'pegawai',
            'x_agama',
            'agama',
            '`agama`',
            '`agama`',
            200,
            20,
            -1,
            false,
            '`agama`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->agama->InputTextType = "text";
        switch ($CurrentLanguage) {
            case "en-US":
                $this->agama->Lookup = new Lookup('agama', 'agama', false, 'name', ["name","","",""], [], [], [], [], [], [], '', '', "`name`");
                break;
            default:
                $this->agama->Lookup = new Lookup('agama', 'agama', false, 'name', ["name","","",""], [], [], [], [], [], [], '', '', "`name`");
                break;
        }
        $this->Fields['agama'] = &$this->agama;

        // jabatan
        $this->jabatan = new DbField(
            'pegawai',
            'pegawai',
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
        switch ($CurrentLanguage) {
            case "en-US":
                $this->jabatan->Lookup = new Lookup('jabatan', 'jabatan', false, 'id', ["nama_jabatan","","",""], [], [], [], [], [], [], '', '', "`nama_jabatan`");
                break;
            default:
                $this->jabatan->Lookup = new Lookup('jabatan', 'jabatan', false, 'id', ["nama_jabatan","","",""], [], [], [], [], [], [], '', '', "`nama_jabatan`");
                break;
        }
        $this->jabatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['jabatan'] = &$this->jabatan;

        // jenkel
        $this->jenkel = new DbField(
            'pegawai',
            'pegawai',
            'x_jenkel',
            'jenkel',
            '`jenkel`',
            '`jenkel`',
            200,
            20,
            -1,
            false,
            '`jenkel`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'RADIO'
        );
        $this->jenkel->InputTextType = "text";
        switch ($CurrentLanguage) {
            case "en-US":
                $this->jenkel->Lookup = new Lookup('jenkel', 'gender', false, 'gen', ["gen","","",""], [], [], [], [], [], [], '', '', "`gen`");
                break;
            default:
                $this->jenkel->Lookup = new Lookup('jenkel', 'gender', false, 'gen', ["gen","","",""], [], [], [], [], [], [], '', '', "`gen`");
                break;
        }
        $this->Fields['jenkel'] = &$this->jenkel;

        // mulai_bekerja
        $this->mulai_bekerja = new DbField(
            'pegawai',
            'pegawai',
            'x_mulai_bekerja',
            'mulai_bekerja',
            '`mulai_bekerja`',
            CastDateFieldForLike("`mulai_bekerja`", 0, "DB"),
            133,
            10,
            0,
            false,
            '`mulai_bekerja`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->mulai_bekerja->InputTextType = "text";
        $this->mulai_bekerja->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->Fields['mulai_bekerja'] = &$this->mulai_bekerja;

        // status
        $this->status = new DbField(
            'pegawai',
            'pegawai',
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

        // keterangan
        $this->keterangan = new DbField(
            'pegawai',
            'pegawai',
            'x_keterangan',
            'keterangan',
            '`keterangan`',
            '`keterangan`',
            200,
            255,
            -1,
            false,
            '`keterangan`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->keterangan->InputTextType = "text";
        $this->Fields['keterangan'] = &$this->keterangan;

        // level
        $this->level = new DbField(
            'pegawai',
            'pegawai',
            'x_level',
            'level',
            '`level`',
            '`level`',
            3,
            11,
            -1,
            false,
            '`level`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'SELECT'
        );
        $this->level->InputTextType = "text";
        $this->level->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->level->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        switch ($CurrentLanguage) {
            case "en-US":
                $this->level->Lookup = new Lookup('level', 'userlevels', false, 'userlevelid', ["userlevelname","","",""], [], [], [], [], [], [], '', '', "`userlevelname`");
                break;
            default:
                $this->level->Lookup = new Lookup('level', 'userlevels', false, 'userlevelid', ["userlevelname","","",""], [], [], [], [], [], [], '', '', "`userlevelname`");
                break;
        }
        $this->level->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['level'] = &$this->level;

        // aktif
        $this->aktif = new DbField(
            'pegawai',
            'pegawai',
            'x_aktif',
            'aktif',
            '`aktif`',
            '`aktif`',
            16,
            4,
            -1,
            false,
            '`aktif`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'TEXT'
        );
        $this->aktif->InputTextType = "text";
        $this->aktif->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Fields['aktif'] = &$this->aktif;

        // foto
        $this->foto = new DbField(
            'pegawai',
            'pegawai',
            'x_foto',
            'foto',
            '`foto`',
            '`foto`',
            200,
            255,
            -1,
            true,
            '`foto`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'FILE'
        );
        $this->foto->InputTextType = "text";
        $this->foto->UploadPath = "file_foto";
        $this->Fields['foto'] = &$this->foto;

        // file_cv
        $this->file_cv = new DbField(
            'pegawai',
            'pegawai',
            'x_file_cv',
            'file_cv',
            '`file_cv`',
            '`file_cv`',
            200,
            255,
            -1,
            true,
            '`file_cv`',
            false,
            false,
            false,
            'FORMATTED TEXT',
            'FILE'
        );
        $this->file_cv->InputTextType = "text";
        $this->file_cv->UploadPath = "file_cv";
        $this->Fields['file_cv'] = &$this->file_cv;

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

    // Current detail table name
    public function getCurrentDetailTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE"));
    }

    public function setCurrentDetailTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
    }

    // Get detail url
    public function getDetailUrl()
    {
        // Detail url
        $detailUrl = "";
        if ($this->getCurrentDetailTable() == "peg_dokumen") {
            $detailUrl = Container("peg_dokumen")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "peg_keluarga") {
            $detailUrl = Container("peg_keluarga")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "peg_skill") {
            $detailUrl = Container("peg_skill")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_id", $this->id->CurrentValue);
        }
        if ($detailUrl == "") {
            $detailUrl = "PegawaiList";
        }
        return $detailUrl;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`pegawai`";
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
            if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                $value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
            if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                if ($value == $this->Fields[$name]->OldValue) { // No need to update hashed password if not changed
                    continue;
                }
                $value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
        // Cascade Update detail table 'peg_dokumen'
        $cascadeUpdate = false;
        $rscascade = [];
        if ($rsold && (isset($rs['id']) && $rsold['id'] != $rs['id'])) { // Update detail field 'pid'
            $cascadeUpdate = true;
            $rscascade['pid'] = $rs['id'];
        }
        if ($cascadeUpdate) {
            $rswrk = Container("peg_dokumen")->loadRs("`pid` = " . QuotedValue($rsold['id'], DATATYPE_NUMBER, 'DB'))->fetchAllAssociative();
            foreach ($rswrk as $rsdtlold) {
                $rskey = [];
                $fldname = 'id';
                $rskey[$fldname] = $rsdtlold[$fldname];
                $rsdtlnew = array_merge($rsdtlold, $rscascade);
                // Call Row_Updating event
                $success = Container("peg_dokumen")->rowUpdating($rsdtlold, $rsdtlnew);
                if ($success) {
                    $success = Container("peg_dokumen")->update($rscascade, $rskey, $rsdtlold);
                }
                if (!$success) {
                    return false;
                }
                // Call Row_Updated event
                Container("peg_dokumen")->rowUpdated($rsdtlold, $rsdtlnew);
            }
        }

        // Cascade Update detail table 'peg_keluarga'
        $cascadeUpdate = false;
        $rscascade = [];
        if ($rsold && (isset($rs['id']) && $rsold['id'] != $rs['id'])) { // Update detail field 'pid'
            $cascadeUpdate = true;
            $rscascade['pid'] = $rs['id'];
        }
        if ($cascadeUpdate) {
            $rswrk = Container("peg_keluarga")->loadRs("`pid` = " . QuotedValue($rsold['id'], DATATYPE_NUMBER, 'DB'))->fetchAllAssociative();
            foreach ($rswrk as $rsdtlold) {
                $rskey = [];
                $fldname = 'id';
                $rskey[$fldname] = $rsdtlold[$fldname];
                $rsdtlnew = array_merge($rsdtlold, $rscascade);
                // Call Row_Updating event
                $success = Container("peg_keluarga")->rowUpdating($rsdtlold, $rsdtlnew);
                if ($success) {
                    $success = Container("peg_keluarga")->update($rscascade, $rskey, $rsdtlold);
                }
                if (!$success) {
                    return false;
                }
                // Call Row_Updated event
                Container("peg_keluarga")->rowUpdated($rsdtlold, $rsdtlnew);
            }
        }

        // Cascade Update detail table 'peg_skill'
        $cascadeUpdate = false;
        $rscascade = [];
        if ($rsold && (isset($rs['id']) && $rsold['id'] != $rs['id'])) { // Update detail field 'pid'
            $cascadeUpdate = true;
            $rscascade['pid'] = $rs['id'];
        }
        if ($cascadeUpdate) {
            $rswrk = Container("peg_skill")->loadRs("`pid` = " . QuotedValue($rsold['id'], DATATYPE_NUMBER, 'DB'))->fetchAllAssociative();
            foreach ($rswrk as $rsdtlold) {
                $rskey = [];
                $fldname = 'id';
                $rskey[$fldname] = $rsdtlold[$fldname];
                $rsdtlnew = array_merge($rsdtlold, $rscascade);
                // Call Row_Updating event
                $success = Container("peg_skill")->rowUpdating($rsdtlold, $rsdtlnew);
                if ($success) {
                    $success = Container("peg_skill")->update($rscascade, $rskey, $rsdtlold);
                }
                if (!$success) {
                    return false;
                }
                // Call Row_Updated event
                Container("peg_skill")->rowUpdated($rsdtlold, $rsdtlnew);
            }
        }

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

        // Cascade delete detail table 'peg_dokumen'
        $dtlrows = Container("peg_dokumen")->loadRs("`pid` = " . QuotedValue($rs['id'], DATATYPE_NUMBER, "DB"))->fetchAllAssociative();
        // Call Row Deleting event
        foreach ($dtlrows as $dtlrow) {
            $success = Container("peg_dokumen")->rowDeleting($dtlrow);
            if (!$success) {
                break;
            }
        }
        if ($success) {
            foreach ($dtlrows as $dtlrow) {
                $success = Container("peg_dokumen")->delete($dtlrow); // Delete
                if (!$success) {
                    break;
                }
            }
        }
        // Call Row Deleted event
        if ($success) {
            foreach ($dtlrows as $dtlrow) {
                Container("peg_dokumen")->rowDeleted($dtlrow);
            }
        }

        // Cascade delete detail table 'peg_keluarga'
        $dtlrows = Container("peg_keluarga")->loadRs("`pid` = " . QuotedValue($rs['id'], DATATYPE_NUMBER, "DB"))->fetchAllAssociative();
        // Call Row Deleting event
        foreach ($dtlrows as $dtlrow) {
            $success = Container("peg_keluarga")->rowDeleting($dtlrow);
            if (!$success) {
                break;
            }
        }
        if ($success) {
            foreach ($dtlrows as $dtlrow) {
                $success = Container("peg_keluarga")->delete($dtlrow); // Delete
                if (!$success) {
                    break;
                }
            }
        }
        // Call Row Deleted event
        if ($success) {
            foreach ($dtlrows as $dtlrow) {
                Container("peg_keluarga")->rowDeleted($dtlrow);
            }
        }

        // Cascade delete detail table 'peg_skill'
        $dtlrows = Container("peg_skill")->loadRs("`pid` = " . QuotedValue($rs['id'], DATATYPE_NUMBER, "DB"))->fetchAllAssociative();
        // Call Row Deleting event
        foreach ($dtlrows as $dtlrow) {
            $success = Container("peg_skill")->rowDeleting($dtlrow);
            if (!$success) {
                break;
            }
        }
        if ($success) {
            foreach ($dtlrows as $dtlrow) {
                $success = Container("peg_skill")->delete($dtlrow); // Delete
                if (!$success) {
                    break;
                }
            }
        }
        // Call Row Deleted event
        if ($success) {
            foreach ($dtlrows as $dtlrow) {
                Container("peg_skill")->rowDeleted($dtlrow);
            }
        }
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
        $this->_username->DbValue = $row['username'];
        $this->_password->DbValue = $row['password'];
        $this->nip->DbValue = $row['nip'];
        $this->nama->DbValue = $row['nama'];
        $this->alamat->DbValue = $row['alamat'];
        $this->_email->DbValue = $row['email'];
        $this->wa->DbValue = $row['wa'];
        $this->hp->DbValue = $row['hp'];
        $this->tgllahir->DbValue = $row['tgllahir'];
        $this->rekbank->DbValue = $row['rekbank'];
        $this->jenjang_id->DbValue = $row['jenjang_id'];
        $this->pendidikan->DbValue = $row['pendidikan'];
        $this->jurusan->DbValue = $row['jurusan'];
        $this->agama->DbValue = $row['agama'];
        $this->jabatan->DbValue = $row['jabatan'];
        $this->jenkel->DbValue = $row['jenkel'];
        $this->mulai_bekerja->DbValue = $row['mulai_bekerja'];
        $this->status->DbValue = $row['status'];
        $this->keterangan->DbValue = $row['keterangan'];
        $this->level->DbValue = $row['level'];
        $this->aktif->DbValue = $row['aktif'];
        $this->foto->Upload->DbValue = $row['foto'];
        $this->file_cv->Upload->DbValue = $row['file_cv'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
        $this->foto->OldUploadPath = "file_foto";
        $oldFiles = EmptyValue($row['foto']) ? [] : [$row['foto']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->foto->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->foto->oldPhysicalUploadPath() . $oldFile);
            }
        }
        $this->file_cv->OldUploadPath = "file_cv";
        $oldFiles = EmptyValue($row['file_cv']) ? [] : [$row['file_cv']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->file_cv->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->file_cv->oldPhysicalUploadPath() . $oldFile);
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
        return $_SESSION[$name] ?? GetUrl("PegawaiList");
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
        if ($pageName == "PegawaiView") {
            return $Language->phrase("View");
        } elseif ($pageName == "PegawaiEdit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "PegawaiAdd") {
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
                return "PegawaiView";
            case Config("API_ADD_ACTION"):
                return "PegawaiAdd";
            case Config("API_EDIT_ACTION"):
                return "PegawaiEdit";
            case Config("API_DELETE_ACTION"):
                return "PegawaiDelete";
            case Config("API_LIST_ACTION"):
                return "PegawaiList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "PegawaiList";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PegawaiView", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PegawaiView", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "PegawaiAdd?" . $this->getUrlParm($parm);
        } else {
            $url = "PegawaiAdd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("PegawaiEdit", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PegawaiEdit", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
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
        if ($parm != "") {
            $url = $this->keyUrl("PegawaiAdd", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("PegawaiAdd", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
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
        return $this->keyUrl("PegawaiDelete", $this->getUrlParm());
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
        $this->file_cv->Upload->DbValue = $row['file_cv'];
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

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // pid
        $this->pid->LinkCustomAttributes = "";
        $this->pid->HrefValue = "";
        $this->pid->TooltipValue = "";

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
        $this->pid->EditValue = $this->pid->CurrentValue;
        $this->pid->PlaceHolder = RemoveHtml($this->pid->caption());
        if (strval($this->pid->EditValue) != "" && is_numeric($this->pid->EditValue)) {
            $this->pid->EditValue = FormatNumber($this->pid->EditValue, null);
        }

        // username
        $this->_username->setupEditAttributes();
        $this->_username->EditCustomAttributes = "";
        if (!$this->_username->Raw) {
            $this->_username->CurrentValue = HtmlDecode($this->_username->CurrentValue);
        }
        $this->_username->EditValue = $this->_username->CurrentValue;
        $this->_username->PlaceHolder = RemoveHtml($this->_username->caption());

        // password
        $this->_password->setupEditAttributes();
        $this->_password->EditCustomAttributes = "";
        if (!$this->_password->Raw) {
            $this->_password->CurrentValue = HtmlDecode($this->_password->CurrentValue);
        }
        $this->_password->EditValue = $this->_password->CurrentValue;
        $this->_password->PlaceHolder = RemoveHtml($this->_password->caption());

        // nip
        $this->nip->setupEditAttributes();
        $this->nip->EditCustomAttributes = "";
        if (!$this->nip->Raw) {
            $this->nip->CurrentValue = HtmlDecode($this->nip->CurrentValue);
        }
        $this->nip->EditValue = $this->nip->CurrentValue;
        $this->nip->PlaceHolder = RemoveHtml($this->nip->caption());

        // nama
        $this->nama->setupEditAttributes();
        $this->nama->EditCustomAttributes = "";
        if (!$this->nama->Raw) {
            $this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
        }
        $this->nama->EditValue = $this->nama->CurrentValue;
        $this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

        // alamat
        $this->alamat->setupEditAttributes();
        $this->alamat->EditCustomAttributes = "";
        if (!$this->alamat->Raw) {
            $this->alamat->CurrentValue = HtmlDecode($this->alamat->CurrentValue);
        }
        $this->alamat->EditValue = $this->alamat->CurrentValue;
        $this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

        // email
        $this->_email->setupEditAttributes();
        $this->_email->EditCustomAttributes = "";
        if (!$this->_email->Raw) {
            $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
        }
        $this->_email->EditValue = $this->_email->CurrentValue;
        $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

        // wa
        $this->wa->setupEditAttributes();
        $this->wa->EditCustomAttributes = "";
        if (!$this->wa->Raw) {
            $this->wa->CurrentValue = HtmlDecode($this->wa->CurrentValue);
        }
        $this->wa->EditValue = $this->wa->CurrentValue;
        $this->wa->PlaceHolder = RemoveHtml($this->wa->caption());

        // hp
        $this->hp->setupEditAttributes();
        $this->hp->EditCustomAttributes = "";
        if (!$this->hp->Raw) {
            $this->hp->CurrentValue = HtmlDecode($this->hp->CurrentValue);
        }
        $this->hp->EditValue = $this->hp->CurrentValue;
        $this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

        // tgllahir
        $this->tgllahir->setupEditAttributes();
        $this->tgllahir->EditCustomAttributes = "";
        $this->tgllahir->EditValue = FormatDateTime($this->tgllahir->CurrentValue, $this->tgllahir->formatPattern());
        $this->tgllahir->PlaceHolder = RemoveHtml($this->tgllahir->caption());

        // rekbank
        $this->rekbank->setupEditAttributes();
        $this->rekbank->EditCustomAttributes = "";
        if (!$this->rekbank->Raw) {
            $this->rekbank->CurrentValue = HtmlDecode($this->rekbank->CurrentValue);
        }
        $this->rekbank->EditValue = $this->rekbank->CurrentValue;
        $this->rekbank->PlaceHolder = RemoveHtml($this->rekbank->caption());

        // jenjang_id
        $this->jenjang_id->setupEditAttributes();
        $this->jenjang_id->EditCustomAttributes = "";
        $this->jenjang_id->EditValue = $this->jenjang_id->CurrentValue;
        $this->jenjang_id->PlaceHolder = RemoveHtml($this->jenjang_id->caption());

        // pendidikan
        $this->pendidikan->setupEditAttributes();
        $this->pendidikan->EditCustomAttributes = "";
        $this->pendidikan->EditValue = $this->pendidikan->CurrentValue;
        $this->pendidikan->PlaceHolder = RemoveHtml($this->pendidikan->caption());

        // jurusan
        $this->jurusan->setupEditAttributes();
        $this->jurusan->EditCustomAttributes = "";
        if (!$this->jurusan->Raw) {
            $this->jurusan->CurrentValue = HtmlDecode($this->jurusan->CurrentValue);
        }
        $this->jurusan->EditValue = $this->jurusan->CurrentValue;
        $this->jurusan->PlaceHolder = RemoveHtml($this->jurusan->caption());

        // agama
        $this->agama->setupEditAttributes();
        $this->agama->EditCustomAttributes = "";
        if (!$this->agama->Raw) {
            $this->agama->CurrentValue = HtmlDecode($this->agama->CurrentValue);
        }
        $this->agama->EditValue = $this->agama->CurrentValue;
        $this->agama->PlaceHolder = RemoveHtml($this->agama->caption());

        // jabatan
        $this->jabatan->setupEditAttributes();
        $this->jabatan->EditCustomAttributes = "";
        $this->jabatan->EditValue = $this->jabatan->CurrentValue;
        $this->jabatan->PlaceHolder = RemoveHtml($this->jabatan->caption());

        // jenkel
        $this->jenkel->EditCustomAttributes = "";
        $this->jenkel->PlaceHolder = RemoveHtml($this->jenkel->caption());

        // mulai_bekerja
        $this->mulai_bekerja->setupEditAttributes();
        $this->mulai_bekerja->EditCustomAttributes = "";
        $this->mulai_bekerja->EditValue = FormatDateTime($this->mulai_bekerja->CurrentValue, $this->mulai_bekerja->formatPattern());
        $this->mulai_bekerja->PlaceHolder = RemoveHtml($this->mulai_bekerja->caption());

        // status
        $this->status->setupEditAttributes();
        $this->status->EditCustomAttributes = "";
        if (!$this->status->Raw) {
            $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
        }
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // keterangan
        $this->keterangan->setupEditAttributes();
        $this->keterangan->EditCustomAttributes = "";
        if (!$this->keterangan->Raw) {
            $this->keterangan->CurrentValue = HtmlDecode($this->keterangan->CurrentValue);
        }
        $this->keterangan->EditValue = $this->keterangan->CurrentValue;
        $this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

        // level
        $this->level->setupEditAttributes();
        $this->level->EditCustomAttributes = "";
        if (!$Security->canAdmin()) { // System admin
            $this->level->EditValue = $Language->phrase("PasswordMask");
        } else {
            $this->level->PlaceHolder = RemoveHtml($this->level->caption());
        }

        // aktif
        $this->aktif->setupEditAttributes();
        $this->aktif->EditCustomAttributes = "";
        $this->aktif->EditValue = $this->aktif->CurrentValue;
        $this->aktif->PlaceHolder = RemoveHtml($this->aktif->caption());
        if (strval($this->aktif->EditValue) != "" && is_numeric($this->aktif->EditValue)) {
            $this->aktif->EditValue = FormatNumber($this->aktif->EditValue, null);
        }

        // foto
        $this->foto->setupEditAttributes();
        $this->foto->EditCustomAttributes = "";
        $this->foto->UploadPath = "file_foto";
        if (!EmptyValue($this->foto->Upload->DbValue)) {
            $this->foto->EditValue = $this->foto->Upload->DbValue;
        } else {
            $this->foto->EditValue = "";
        }
        if (!EmptyValue($this->foto->CurrentValue)) {
            $this->foto->Upload->FileName = $this->foto->CurrentValue;
        }

        // file_cv
        $this->file_cv->setupEditAttributes();
        $this->file_cv->EditCustomAttributes = "";
        $this->file_cv->UploadPath = "file_cv";
        if (!EmptyValue($this->file_cv->Upload->DbValue)) {
            $this->file_cv->EditValue = $this->file_cv->Upload->DbValue;
        } else {
            $this->file_cv->EditValue = "";
        }
        if (!EmptyValue($this->file_cv->CurrentValue)) {
            $this->file_cv->Upload->FileName = $this->file_cv->CurrentValue;
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
                    $doc->exportCaption($this->_username);
                    $doc->exportCaption($this->_password);
                    $doc->exportCaption($this->nip);
                    $doc->exportCaption($this->nama);
                    $doc->exportCaption($this->alamat);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->wa);
                    $doc->exportCaption($this->hp);
                    $doc->exportCaption($this->tgllahir);
                    $doc->exportCaption($this->rekbank);
                    $doc->exportCaption($this->jenjang_id);
                    $doc->exportCaption($this->pendidikan);
                    $doc->exportCaption($this->jurusan);
                    $doc->exportCaption($this->agama);
                    $doc->exportCaption($this->jabatan);
                    $doc->exportCaption($this->jenkel);
                    $doc->exportCaption($this->mulai_bekerja);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->keterangan);
                    $doc->exportCaption($this->level);
                    $doc->exportCaption($this->aktif);
                    $doc->exportCaption($this->foto);
                    $doc->exportCaption($this->file_cv);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->pid);
                    $doc->exportCaption($this->_username);
                    $doc->exportCaption($this->_password);
                    $doc->exportCaption($this->nip);
                    $doc->exportCaption($this->nama);
                    $doc->exportCaption($this->alamat);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->wa);
                    $doc->exportCaption($this->hp);
                    $doc->exportCaption($this->tgllahir);
                    $doc->exportCaption($this->rekbank);
                    $doc->exportCaption($this->jenjang_id);
                    $doc->exportCaption($this->pendidikan);
                    $doc->exportCaption($this->jurusan);
                    $doc->exportCaption($this->agama);
                    $doc->exportCaption($this->jabatan);
                    $doc->exportCaption($this->jenkel);
                    $doc->exportCaption($this->mulai_bekerja);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->keterangan);
                    $doc->exportCaption($this->level);
                    $doc->exportCaption($this->aktif);
                    $doc->exportCaption($this->foto);
                    $doc->exportCaption($this->file_cv);
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
                        $doc->exportField($this->_username);
                        $doc->exportField($this->_password);
                        $doc->exportField($this->nip);
                        $doc->exportField($this->nama);
                        $doc->exportField($this->alamat);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->wa);
                        $doc->exportField($this->hp);
                        $doc->exportField($this->tgllahir);
                        $doc->exportField($this->rekbank);
                        $doc->exportField($this->jenjang_id);
                        $doc->exportField($this->pendidikan);
                        $doc->exportField($this->jurusan);
                        $doc->exportField($this->agama);
                        $doc->exportField($this->jabatan);
                        $doc->exportField($this->jenkel);
                        $doc->exportField($this->mulai_bekerja);
                        $doc->exportField($this->status);
                        $doc->exportField($this->keterangan);
                        $doc->exportField($this->level);
                        $doc->exportField($this->aktif);
                        $doc->exportField($this->foto);
                        $doc->exportField($this->file_cv);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->pid);
                        $doc->exportField($this->_username);
                        $doc->exportField($this->_password);
                        $doc->exportField($this->nip);
                        $doc->exportField($this->nama);
                        $doc->exportField($this->alamat);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->wa);
                        $doc->exportField($this->hp);
                        $doc->exportField($this->tgllahir);
                        $doc->exportField($this->rekbank);
                        $doc->exportField($this->jenjang_id);
                        $doc->exportField($this->pendidikan);
                        $doc->exportField($this->jurusan);
                        $doc->exportField($this->agama);
                        $doc->exportField($this->jabatan);
                        $doc->exportField($this->jenkel);
                        $doc->exportField($this->mulai_bekerja);
                        $doc->exportField($this->status);
                        $doc->exportField($this->keterangan);
                        $doc->exportField($this->level);
                        $doc->exportField($this->aktif);
                        $doc->exportField($this->foto);
                        $doc->exportField($this->file_cv);
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
        if ($fldparm == 'foto') {
            $fldName = "foto";
            $fileNameFld = "foto";
        } elseif ($fldparm == 'file_cv') {
            $fldName = "file_cv";
            $fileNameFld = "file_cv";
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
