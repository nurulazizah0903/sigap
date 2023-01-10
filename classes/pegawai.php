<?php namespace PHPMaker2020\sigap; ?>
<?php

/**
 * Table class for pegawai
 */
class pegawai extends DbTable
{
	protected $SqlFrom = "";
	protected $SqlSelect = "";
	protected $SqlSelectList = "";
	protected $SqlWhere = "";
	protected $SqlGroupBy = "";
	protected $SqlHaving = "";
	protected $SqlOrderBy = "";
	public $UseSessionForListSql = TRUE;

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
	public $nip;
	public $username;
	public $password;
	public $jenjang_id;
	public $jabatan;
	public $periode_jabatan;
	public $type;
	public $sertif;
	public $tambahan;
	public $lama_kerja;
	public $nama;
	public $alamat;
	public $_email;
	public $wa;
	public $hp;
	public $tgllahir;
	public $rekbank;
	public $pendidikan;
	public $jurusan;
	public $agama;
	public $jenkel;
	public $status;
	public $foto;
	public $file_cv;
	public $mulai_bekerja;
	public $keterangan;
	public $level;
	public $aktif;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'pegawai';
		$this->TableName = 'pegawai';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`pegawai`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('pegawai', 'pegawai', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->IsForeignKey = TRUE; // Foreign key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// pid
		$this->pid = new DbField('pegawai', 'pegawai', 'x_pid', 'pid', '`pid`', '`pid`', 3, 11, -1, FALSE, '`pid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pid->Sortable = TRUE; // Allow sort
		$this->pid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pid'] = &$this->pid;

		// nip
		$this->nip = new DbField('pegawai', 'pegawai', 'x_nip', 'nip', '`nip`', '`nip`', 200, 50, -1, FALSE, '`nip`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nip->Sortable = TRUE; // Allow sort
		$this->fields['nip'] = &$this->nip;

		// username
		$this->username = new DbField('pegawai', 'pegawai', 'x_username', 'username', '`username`', '`username`', 200, 255, -1, FALSE, '`username`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->username->Required = TRUE; // Required field
		$this->username->Sortable = TRUE; // Allow sort
		$this->fields['username'] = &$this->username;

		// password
		$this->password = new DbField('pegawai', 'pegawai', 'x_password', 'password', '`password`', '`password`', 200, 255, -1, FALSE, '`password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->password->Required = TRUE; // Required field
		$this->password->Sortable = TRUE; // Allow sort
		$this->fields['password'] = &$this->password;

		// jenjang_id
		$this->jenjang_id = new DbField('pegawai', 'pegawai', 'x_jenjang_id', 'jenjang_id', '`jenjang_id`', '`jenjang_id`', 3, 11, -1, FALSE, '`jenjang_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jenjang_id->Sortable = TRUE; // Allow sort
		$this->jenjang_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jenjang_id->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jenjang_id->Lookup = new Lookup('jenjang_id', 'tpendidikan', FALSE, 'nourut', ["name","","",""], [], [], [], [], [], [], '`nourut` ASC', '');
		$this->jenjang_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenjang_id'] = &$this->jenjang_id;

		// jabatan
		$this->jabatan = new DbField('pegawai', 'pegawai', 'x_jabatan', 'jabatan', '`jabatan`', '`jabatan`', 3, 11, -1, FALSE, '`jabatan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->jabatan->Sortable = TRUE; // Allow sort
		$this->jabatan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->jabatan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->jabatan->Lookup = new Lookup('jabatan', 'jabatan', FALSE, 'id', ["nama_jabatan","","",""], [], [], [], [], ["type_jabatan"], ["x_type"], '', '');
		$this->jabatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jabatan'] = &$this->jabatan;

		// periode_jabatan
		$this->periode_jabatan = new DbField('pegawai', 'pegawai', 'x_periode_jabatan', 'periode_jabatan', '`periode_jabatan`', '`periode_jabatan`', 3, 11, -1, FALSE, '`periode_jabatan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->periode_jabatan->Sortable = TRUE; // Allow sort
		$this->periode_jabatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['periode_jabatan'] = &$this->periode_jabatan;

		// type
		$this->type = new DbField('pegawai', 'pegawai', 'x_type', 'type', '`type`', '`type`', 3, 11, -1, FALSE, '`type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->type->Sortable = TRUE; // Allow sort
		$this->type->Lookup = new Lookup('type', 'jenis_jabatan', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->type->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['type'] = &$this->type;

		// sertif
		$this->sertif = new DbField('pegawai', 'pegawai', 'x_sertif', 'sertif', '`sertif`', '`sertif`', 3, 11, -1, FALSE, '`sertif`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->sertif->Sortable = TRUE; // Allow sort
		$this->sertif->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->sertif->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->sertif->Lookup = new Lookup('sertif', 'sertif', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->sertif->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sertif'] = &$this->sertif;

		// tambahan
		$this->tambahan = new DbField('pegawai', 'pegawai', 'x_tambahan', 'tambahan', '`tambahan`', '`tambahan`', 3, 11, -1, FALSE, '`tambahan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tambahan->Sortable = TRUE; // Allow sort
		$this->tambahan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tambahan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->tambahan->Lookup = new Lookup('tambahan', 'tambahan_tugas', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->tambahan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tambahan'] = &$this->tambahan;

		// lama_kerja
		$this->lama_kerja = new DbField('pegawai', 'pegawai', 'x_lama_kerja', 'lama_kerja', '`lama_kerja`', '`lama_kerja`', 3, 11, -1, FALSE, '`lama_kerja`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lama_kerja->Sortable = TRUE; // Allow sort
		$this->lama_kerja->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['lama_kerja'] = &$this->lama_kerja;

		// nama
		$this->nama = new DbField('pegawai', 'pegawai', 'x_nama', 'nama', '`nama`', '`nama`', 200, 255, -1, FALSE, '`nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama->Sortable = TRUE; // Allow sort
		$this->fields['nama'] = &$this->nama;

		// alamat
		$this->alamat = new DbField('pegawai', 'pegawai', 'x_alamat', 'alamat', '`alamat`', '`alamat`', 200, 255, -1, FALSE, '`alamat`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->alamat->Sortable = TRUE; // Allow sort
		$this->fields['alamat'] = &$this->alamat;

		// email
		$this->_email = new DbField('pegawai', 'pegawai', 'x__email', 'email', '`email`', '`email`', 200, 255, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Sortable = TRUE; // Allow sort
		$this->fields['email'] = &$this->_email;

		// wa
		$this->wa = new DbField('pegawai', 'pegawai', 'x_wa', 'wa', '`wa`', '`wa`', 200, 255, -1, FALSE, '`wa`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->wa->Sortable = TRUE; // Allow sort
		$this->fields['wa'] = &$this->wa;

		// hp
		$this->hp = new DbField('pegawai', 'pegawai', 'x_hp', 'hp', '`hp`', '`hp`', 200, 255, -1, FALSE, '`hp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->hp->Sortable = TRUE; // Allow sort
		$this->fields['hp'] = &$this->hp;

		// tgllahir
		$this->tgllahir = new DbField('pegawai', 'pegawai', 'x_tgllahir', 'tgllahir', '`tgllahir`', CastDateFieldForLike("`tgllahir`", 0, "DB"), 133, 10, 0, FALSE, '`tgllahir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgllahir->Sortable = TRUE; // Allow sort
		$this->tgllahir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgllahir'] = &$this->tgllahir;

		// rekbank
		$this->rekbank = new DbField('pegawai', 'pegawai', 'x_rekbank', 'rekbank', '`rekbank`', '`rekbank`', 200, 255, -1, FALSE, '`rekbank`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rekbank->Sortable = TRUE; // Allow sort
		$this->fields['rekbank'] = &$this->rekbank;

		// pendidikan
		$this->pendidikan = new DbField('pegawai', 'pegawai', 'x_pendidikan', 'pendidikan', '`pendidikan`', '`pendidikan`', 3, 11, -1, FALSE, '`pendidikan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->pendidikan->Sortable = TRUE; // Allow sort
		$this->pendidikan->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->pendidikan->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->pendidikan->Lookup = new Lookup('pendidikan', 'mpendidikan', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '`id` ASC', '');
		$this->fields['pendidikan'] = &$this->pendidikan;

		// jurusan
		$this->jurusan = new DbField('pegawai', 'pegawai', 'x_jurusan', 'jurusan', '`jurusan`', '`jurusan`', 200, 50, -1, FALSE, '`jurusan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jurusan->Sortable = TRUE; // Allow sort
		$this->fields['jurusan'] = &$this->jurusan;

		// agama
		$this->agama = new DbField('pegawai', 'pegawai', 'x_agama', 'agama', '`agama`', '`agama`', 200, 20, -1, FALSE, '`agama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->agama->Sortable = TRUE; // Allow sort
		$this->agama->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->agama->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->agama->Lookup = new Lookup('agama', 'agama', FALSE, 'name', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->fields['agama'] = &$this->agama;

		// jenkel
		$this->jenkel = new DbField('pegawai', 'pegawai', 'x_jenkel', 'jenkel', '`jenkel`', '`jenkel`', 200, 20, -1, FALSE, '`jenkel`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->jenkel->Sortable = TRUE; // Allow sort
		$this->jenkel->Lookup = new Lookup('jenkel', 'gender', FALSE, 'gen', ["gen","","",""], [], [], [], [], [], [], '', '');
		$this->fields['jenkel'] = &$this->jenkel;

		// status
		$this->status = new DbField('pegawai', 'pegawai', 'x_status', 'status', '`status`', '`status`', 200, 20, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status->Sortable = TRUE; // Allow sort
		$this->fields['status'] = &$this->status;

		// foto
		$this->foto = new DbField('pegawai', 'pegawai', 'x_foto', 'foto', '`foto`', '`foto`', 200, 255, -1, TRUE, '`foto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->foto->Sortable = TRUE; // Allow sort
		$this->fields['foto'] = &$this->foto;

		// file_cv
		$this->file_cv = new DbField('pegawai', 'pegawai', 'x_file_cv', 'file_cv', '`file_cv`', '`file_cv`', 200, 255, -1, TRUE, '`file_cv`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->file_cv->Sortable = TRUE; // Allow sort
		$this->fields['file_cv'] = &$this->file_cv;

		// mulai_bekerja
		$this->mulai_bekerja = new DbField('pegawai', 'pegawai', 'x_mulai_bekerja', 'mulai_bekerja', '`mulai_bekerja`', CastDateFieldForLike("`mulai_bekerja`", 0, "DB"), 133, 10, 0, FALSE, '`mulai_bekerja`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->mulai_bekerja->Sortable = TRUE; // Allow sort
		$this->mulai_bekerja->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['mulai_bekerja'] = &$this->mulai_bekerja;

		// keterangan
		$this->keterangan = new DbField('pegawai', 'pegawai', 'x_keterangan', 'keterangan', '`keterangan`', '`keterangan`', 200, 255, -1, FALSE, '`keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keterangan->Sortable = TRUE; // Allow sort
		$this->fields['keterangan'] = &$this->keterangan;

		// level
		$this->level = new DbField('pegawai', 'pegawai', 'x_level', 'level', '`level`', '`level`', 3, 11, -1, FALSE, '`level`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->level->Sortable = TRUE; // Allow sort
		$this->level->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->level->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->level->Lookup = new Lookup('level', 'userlevels', FALSE, 'userlevelid', ["userlevelname","","",""], [], [], [], [], [], [], '', '');
		$this->level->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['level'] = &$this->level;

		// aktif
		$this->aktif = new DbField('pegawai', 'pegawai', 'x_aktif', 'aktif', '`aktif`', '`aktif`', 16, 4, -1, FALSE, '`aktif`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->aktif->Sortable = TRUE; // Allow sort
		$this->aktif->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['aktif'] = &$this->aktif;
	}

	// Field Visibility
	public function getFieldVisibility($fldParm)
	{
		global $Security;
		return $this->$fldParm->Visible; // Returns original value
	}

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function setLeftColumnClass($class)
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
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$thisSort = $this->CurrentOrderType;
			} else {
				$thisSort = ($lastSort == "ASC") ? "DESC" : "ASC";
			}
			$fld->setSort($thisSort);
			$this->setSessionOrderBy($sortField . " " . $thisSort); // Save to Session
		} else {
			$fld->setSort("");
		}
	}

	// Current detail table name
	public function getCurrentDetailTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")];
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
		if ($this->getCurrentDetailTable() == "peg_skill") {
			$detailUrl = $GLOBALS["peg_skill"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "peg_keluarga") {
			$detailUrl = $GLOBALS["peg_keluarga"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($this->getCurrentDetailTable() == "peg_dokumen") {
			$detailUrl = $GLOBALS["peg_dokumen"]->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
			$detailUrl .= "&fk_id=" . urlencode($this->id->CurrentValue);
		}
		if ($detailUrl == "")
			$detailUrl = "pegawailist.php";
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
		return ($this->SqlSelect != "") ? $this->SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
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
		$this->TableFilter = "";
		AddFilter($where, $this->TableFilter);
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
			case "changepwd":
			case "forgotpwd":
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

	// Get recordset
	public function getRecordset($sql, $rowcnt = -1, $offset = -1)
	{
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->selectLimit($sql, $rowcnt, $offset);
		$conn->raiseErrorFn = "";
		return $rs;
	}

	// Get record count
	public function getRecordCount($sql, $c = NULL)
	{
		$cnt = -1;
		$rs = NULL;
		$sql = preg_replace('/\/\*BeginOrderBy\*\/[\s\S]+\/\*EndOrderBy\*\//', "", $sql); // Remove ORDER BY clause (MSSQL)
		$pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';

		// Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
			preg_match($pattern, $sql) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sql) &&
			!preg_match('/^\s*select\s+distinct\s+/i', $sql) && !preg_match('/\s+order\s+by\s+/i', $sql)) {
			$sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sql);
		} else {
			$sqlwrk = "SELECT COUNT(*) FROM (" . $sql . ") COUNT_TABLE";
		}
		$conn = $c ?: $this->getConnection();
		if ($rs = $conn->execute($sqlwrk)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->close();
			}
			return (int)$cnt;
		}

		// Unable to get count, get record count directly
		if ($rs = $conn->execute($sql)) {
			$cnt = $rs->RecordCount();
			$rs->close();
			return (int)$cnt;
		}
		return $cnt;
	}

	// Get SQL
	public function getSql($where, $orderBy = "")
	{
		return BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderBy);
	}

	// Table SQL
	public function getCurrentSql()
	{
		$filter = $this->CurrentFilter;
		$filter = $this->applyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->getSql($filter, $sort);
	}

	// Table SQL with List page filter
	public function getListSql()
	{
		$filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
		AddFilter($filter, $this->CurrentFilter);
		$filter = $this->applyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->getSqlSelect();
		$sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
		return BuildSelectSql($select, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $filter, $sort);
	}

	// Get ORDER BY clause
	public function getOrderBy()
	{
		$sort = $this->getSessionOrderBy();
		return BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sort);
	}

	// Get record count based on filter (for detail record count in master table pages)
	public function loadRecordCount($filter)
	{
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
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
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->getRecordCount($sql);
		return $cnt;
	}

	// INSERT statement
	protected function insertSql(&$rs)
	{
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom)
				continue;
			if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME"))
				$value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
			$names .= $this->fields[$name]->Expression . ",";
			$values .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " (" . $names . ") VALUES (" . $values . ")";
	}

	// Insert
	public function insert(&$rs)
	{
		$conn = $this->getConnection();
		$success = $conn->execute($this->insertSql($rs));
		if ($success) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->insert_ID());
			$rs['id'] = $this->id->DbValue;
		}
		return $success;
	}

	// UPDATE statement
	protected function updateSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->IsCustom || $this->fields[$name]->IsAutoIncrement)
				continue;
			if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
				if ($value == $this->fields[$name]->OldValue) // No need to update hashed password if not changed
					continue;
				$value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
			}
			$sql .= $this->fields[$name]->Expression . "=";
			$sql .= QuotedValue($value, $this->fields[$name]->DataType, $this->Dbid) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	public function update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE)
	{
		$conn = $this->getConnection();

		// Cascade Update detail table 'peg_skill'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['id']) && $rsold['id'] != $rs['id'])) { // Update detail field 'pid'
			$cascadeUpdate = TRUE;
			$rscascade['pid'] = $rs['id'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["peg_skill"]))
				$GLOBALS["peg_skill"] = new peg_skill();
			$rswrk = $GLOBALS["peg_skill"]->loadRs("`pid` = " . QuotedValue($rsold['id'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'id';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["peg_skill"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["peg_skill"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["peg_skill"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 'peg_keluarga'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['id']) && $rsold['id'] != $rs['id'])) { // Update detail field 'pid'
			$cascadeUpdate = TRUE;
			$rscascade['pid'] = $rs['id'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["peg_keluarga"]))
				$GLOBALS["peg_keluarga"] = new peg_keluarga();
			$rswrk = $GLOBALS["peg_keluarga"]->loadRs("`pid` = " . QuotedValue($rsold['id'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'id';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["peg_keluarga"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["peg_keluarga"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["peg_keluarga"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}

		// Cascade Update detail table 'peg_dokumen'
		$cascadeUpdate = FALSE;
		$rscascade = [];
		if ($rsold && (isset($rs['id']) && $rsold['id'] != $rs['id'])) { // Update detail field 'pid'
			$cascadeUpdate = TRUE;
			$rscascade['pid'] = $rs['id'];
		}
		if ($cascadeUpdate) {
			if (!isset($GLOBALS["peg_dokumen"]))
				$GLOBALS["peg_dokumen"] = new peg_dokumen();
			$rswrk = $GLOBALS["peg_dokumen"]->loadRs("`pid` = " . QuotedValue($rsold['id'], DATATYPE_NUMBER, 'DB'));
			while ($rswrk && !$rswrk->EOF) {
				$rskey = [];
				$fldname = 'id';
				$rskey[$fldname] = $rswrk->fields[$fldname];
				$rsdtlold = &$rswrk->fields;
				$rsdtlnew = array_merge($rsdtlold, $rscascade);

				// Call Row_Updating event
				$success = $GLOBALS["peg_dokumen"]->Row_Updating($rsdtlold, $rsdtlnew);
				if ($success)
					$success = $GLOBALS["peg_dokumen"]->update($rscascade, $rskey, $rswrk->fields);
				if (!$success)
					return FALSE;

				// Call Row_Updated event
				$GLOBALS["peg_dokumen"]->Row_Updated($rsdtlold, $rsdtlnew);
				$rswrk->moveNext();
			}
		}
		$success = $conn->execute($this->updateSql($rs, $where, $curfilter));
		return $success;
	}

	// DELETE statement
	protected function deleteSql(&$rs, $where = "", $curfilter = TRUE)
	{
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->arrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		AddFilter($filter, $where);
		if ($filter != "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	public function delete(&$rs, $where = "", $curfilter = FALSE)
	{
		$success = TRUE;
		$conn = $this->getConnection();

		// Cascade delete detail table 'peg_skill'
		if (!isset($GLOBALS["peg_skill"]))
			$GLOBALS["peg_skill"] = new peg_skill();
		$rscascade = $GLOBALS["peg_skill"]->loadRs("`pid` = " . QuotedValue($rs['id'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["peg_skill"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["peg_skill"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["peg_skill"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 'peg_keluarga'
		if (!isset($GLOBALS["peg_keluarga"]))
			$GLOBALS["peg_keluarga"] = new peg_keluarga();
		$rscascade = $GLOBALS["peg_keluarga"]->loadRs("`pid` = " . QuotedValue($rs['id'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["peg_keluarga"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["peg_keluarga"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["peg_keluarga"]->Row_Deleted($dtlrow);
		}

		// Cascade delete detail table 'peg_dokumen'
		if (!isset($GLOBALS["peg_dokumen"]))
			$GLOBALS["peg_dokumen"] = new peg_dokumen();
		$rscascade = $GLOBALS["peg_dokumen"]->loadRs("`pid` = " . QuotedValue($rs['id'], DATATYPE_NUMBER, "DB"));
		$dtlrows = ($rscascade) ? $rscascade->getRows() : [];

		// Call Row Deleting event
		foreach ($dtlrows as $dtlrow) {
			$success = $GLOBALS["peg_dokumen"]->Row_Deleting($dtlrow);
			if (!$success)
				break;
		}
		if ($success) {
			foreach ($dtlrows as $dtlrow) {
				$success = $GLOBALS["peg_dokumen"]->delete($dtlrow); // Delete
				if (!$success)
					break;
			}
		}

		// Call Row Deleted event
		if ($success) {
			foreach ($dtlrows as $dtlrow)
				$GLOBALS["peg_dokumen"]->Row_Deleted($dtlrow);
		}
		if ($success)
			$success = $conn->execute($this->deleteSql($rs, $where, $curfilter));
		return $success;
	}

	// Load DbValue from recordset or array
	protected function loadDbValues(&$rs)
	{
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->pid->DbValue = $row['pid'];
		$this->nip->DbValue = $row['nip'];
		$this->username->DbValue = $row['username'];
		$this->password->DbValue = $row['password'];
		$this->jenjang_id->DbValue = $row['jenjang_id'];
		$this->jabatan->DbValue = $row['jabatan'];
		$this->periode_jabatan->DbValue = $row['periode_jabatan'];
		$this->type->DbValue = $row['type'];
		$this->sertif->DbValue = $row['sertif'];
		$this->tambahan->DbValue = $row['tambahan'];
		$this->lama_kerja->DbValue = $row['lama_kerja'];
		$this->nama->DbValue = $row['nama'];
		$this->alamat->DbValue = $row['alamat'];
		$this->_email->DbValue = $row['email'];
		$this->wa->DbValue = $row['wa'];
		$this->hp->DbValue = $row['hp'];
		$this->tgllahir->DbValue = $row['tgllahir'];
		$this->rekbank->DbValue = $row['rekbank'];
		$this->pendidikan->DbValue = $row['pendidikan'];
		$this->jurusan->DbValue = $row['jurusan'];
		$this->agama->DbValue = $row['agama'];
		$this->jenkel->DbValue = $row['jenkel'];
		$this->status->DbValue = $row['status'];
		$this->foto->Upload->DbValue = $row['foto'];
		$this->file_cv->Upload->DbValue = $row['file_cv'];
		$this->mulai_bekerja->DbValue = $row['mulai_bekerja'];
		$this->keterangan->DbValue = $row['keterangan'];
		$this->level->DbValue = $row['level'];
		$this->aktif->DbValue = $row['aktif'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['foto']) ? [] : [$row['foto']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->foto->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->foto->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['file_cv']) ? [] : [$row['file_cv']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->file_cv->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->file_cv->oldPhysicalUploadPath() . $oldFile);
		}
	}

	// Record filter WHERE clause
	protected function sqlKeyFilter()
	{
		return "`id` = @id@";
	}

	// Get record filter
	public function getRecordFilter($row = NULL)
	{
		$keyFilter = $this->sqlKeyFilter();
		if (is_array($row))
			$val = array_key_exists('id', $row) ? $row['id'] : NULL;
		else
			$val = $this->id->OldValue !== NULL ? $this->id->OldValue : $this->id->CurrentValue;
		if (!is_numeric($val))
			return "0=1"; // Invalid key
		if ($val == NULL)
			return "0=1"; // Invalid key
		else
			$keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
		return $keyFilter;
	}

	// Return page URL
	public function getReturnUrl()
	{
		$name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");

		// Get referer URL automatically
		if (ServerVar("HTTP_REFERER") != "" && ReferPageName() != CurrentPageName() && ReferPageName() != "login.php") // Referer not same page or login page
			$_SESSION[$name] = ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] != "") {
			return $_SESSION[$name];
		} else {
			return "pegawailist.php";
		}
	}
	public function setReturnUrl($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
	}

	// Get modal caption
	public function getModalCaption($pageName)
	{
		global $Language;
		if ($pageName == "pegawaiview.php")
			return $Language->phrase("View");
		elseif ($pageName == "pegawaiedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "pegawaiadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "pegawailist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("pegawaiview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("pegawaiview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "pegawaiadd.php?" . $this->getUrlParm($parm);
		else
			$url = "pegawaiadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("pegawaiedit.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("pegawaiedit.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		if ($parm != "")
			$url = $this->keyUrl("pegawaiadd.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("pegawaiadd.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
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
		return $this->keyUrl("pegawaidelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		return $url;
	}
	public function keyToJson($htmlEncode = FALSE)
	{
		$json = "";
		$json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
		$json = "{" . $json . "}";
		if ($htmlEncode)
			$json = HtmlEncode($json);
		return $json;
	}

	// Add key value to URL
	public function keyUrl($url, $parm = "")
	{
		$url = $url . "?";
		if ($parm != "")
			$url .= $parm . "&";
		if ($this->id->CurrentValue != NULL) {
			$url .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
		}
		return $url;
	}

	// Sort URL
	public function sortUrl(&$fld)
	{
		if ($this->CurrentAction || $this->isExport() ||
			in_array($fld->Type, [128, 204, 205])) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->reverseSort());
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
		if (Param("key_m") !== NULL) {
			$arKeys = Param("key_m");
			$cnt = count($arKeys);
		} else {
			if (Param("id") !== NULL)
				$arKeys[] = Param("id");
			elseif (IsApi() && Key(0) !== NULL)
				$arKeys[] = Key(0);
			elseif (IsApi() && Route(2) !== NULL)
				$arKeys[] = Route(2);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = [];
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get filter from record keys
	public function getFilterFromRecordKeys($setCurrent = TRUE)
	{
		$arKeys = $this->getRecordKeys();
		$keyFilter = "";
		foreach ($arKeys as $key) {
			if ($keyFilter != "") $keyFilter .= " OR ";
			if ($setCurrent)
				$this->id->CurrentValue = $key;
			else
				$this->id->OldValue = $key;
			$keyFilter .= "(" . $this->getRecordFilter() . ")";
		}
		return $keyFilter;
	}

	// Load rows based on filter
	public function &loadRs($filter)
	{

		// Set up filter (WHERE Clause)
		$sql = $this->getSql($filter);
		$conn = $this->getConnection();
		$rs = $conn->execute($sql);
		return $rs;
	}

	// Load row values from recordset
	public function loadListRowValues(&$rs)
	{
		$this->id->setDbValue($rs->fields('id'));
		$this->pid->setDbValue($rs->fields('pid'));
		$this->nip->setDbValue($rs->fields('nip'));
		$this->username->setDbValue($rs->fields('username'));
		$this->password->setDbValue($rs->fields('password'));
		$this->jenjang_id->setDbValue($rs->fields('jenjang_id'));
		$this->jabatan->setDbValue($rs->fields('jabatan'));
		$this->periode_jabatan->setDbValue($rs->fields('periode_jabatan'));
		$this->type->setDbValue($rs->fields('type'));
		$this->sertif->setDbValue($rs->fields('sertif'));
		$this->tambahan->setDbValue($rs->fields('tambahan'));
		$this->lama_kerja->setDbValue($rs->fields('lama_kerja'));
		$this->nama->setDbValue($rs->fields('nama'));
		$this->alamat->setDbValue($rs->fields('alamat'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->wa->setDbValue($rs->fields('wa'));
		$this->hp->setDbValue($rs->fields('hp'));
		$this->tgllahir->setDbValue($rs->fields('tgllahir'));
		$this->rekbank->setDbValue($rs->fields('rekbank'));
		$this->pendidikan->setDbValue($rs->fields('pendidikan'));
		$this->jurusan->setDbValue($rs->fields('jurusan'));
		$this->agama->setDbValue($rs->fields('agama'));
		$this->jenkel->setDbValue($rs->fields('jenkel'));
		$this->status->setDbValue($rs->fields('status'));
		$this->foto->Upload->DbValue = $rs->fields('foto');
		$this->file_cv->Upload->DbValue = $rs->fields('file_cv');
		$this->mulai_bekerja->setDbValue($rs->fields('mulai_bekerja'));
		$this->keterangan->setDbValue($rs->fields('keterangan'));
		$this->level->setDbValue($rs->fields('level'));
		$this->aktif->setDbValue($rs->fields('aktif'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// pid
		// nip
		// username
		// password
		// jenjang_id
		// jabatan
		// periode_jabatan
		// type
		// sertif
		// tambahan
		// lama_kerja
		// nama
		// alamat
		// email
		// wa
		// hp
		// tgllahir
		// rekbank
		// pendidikan
		// jurusan
		// agama
		// jenkel
		// status
		// foto
		// file_cv
		// mulai_bekerja
		// keterangan
		// level
		// aktif
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pid
		$this->pid->ViewValue = $this->pid->CurrentValue;
		$this->pid->ViewValue = FormatNumber($this->pid->ViewValue, 0, -2, -2, -2);
		$this->pid->ViewCustomAttributes = "";

		// nip
		$this->nip->ViewValue = $this->nip->CurrentValue;
		$this->nip->ViewCustomAttributes = "";

		// username
		$this->username->ViewValue = $this->username->CurrentValue;
		$this->username->ViewCustomAttributes = "";

		// password
		$this->password->ViewValue = $this->password->CurrentValue;
		$this->password->ViewCustomAttributes = "";

		// jenjang_id
		$curVal = strval($this->jenjang_id->CurrentValue);
		if ($curVal != "") {
			$this->jenjang_id->ViewValue = $this->jenjang_id->lookupCacheOption($curVal);
			if ($this->jenjang_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`nourut`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->jenjang_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->jenjang_id->ViewValue = $this->jenjang_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->jenjang_id->ViewValue = $this->jenjang_id->CurrentValue;
				}
			}
		} else {
			$this->jenjang_id->ViewValue = NULL;
		}
		$this->jenjang_id->ViewCustomAttributes = "";

		// jabatan
		$curVal = strval($this->jabatan->CurrentValue);
		if ($curVal != "") {
			$this->jabatan->ViewValue = $this->jabatan->lookupCacheOption($curVal);
			if ($this->jabatan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->jabatan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->jabatan->ViewValue = $this->jabatan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->jabatan->ViewValue = $this->jabatan->CurrentValue;
				}
			}
		} else {
			$this->jabatan->ViewValue = NULL;
		}
		$this->jabatan->ViewCustomAttributes = "";

		// periode_jabatan
		$this->periode_jabatan->ViewValue = $this->periode_jabatan->CurrentValue;
		$this->periode_jabatan->ViewValue = FormatNumber($this->periode_jabatan->ViewValue, 0, -2, -2, -2);
		$this->periode_jabatan->ViewCustomAttributes = "";

		// type
		$this->type->ViewValue = $this->type->CurrentValue;
		$curVal = strval($this->type->CurrentValue);
		if ($curVal != "") {
			$this->type->ViewValue = $this->type->lookupCacheOption($curVal);
			if ($this->type->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->type->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->type->ViewValue = $this->type->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->type->ViewValue = $this->type->CurrentValue;
				}
			}
		} else {
			$this->type->ViewValue = NULL;
		}
		$this->type->ViewCustomAttributes = "";

		// sertif
		$curVal = strval($this->sertif->CurrentValue);
		if ($curVal != "") {
			$this->sertif->ViewValue = $this->sertif->lookupCacheOption($curVal);
			if ($this->sertif->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->sertif->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->sertif->ViewValue = $this->sertif->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->sertif->ViewValue = $this->sertif->CurrentValue;
				}
			}
		} else {
			$this->sertif->ViewValue = NULL;
		}
		$this->sertif->ViewCustomAttributes = "";

		// tambahan
		$curVal = strval($this->tambahan->CurrentValue);
		if ($curVal != "") {
			$this->tambahan->ViewValue = $this->tambahan->lookupCacheOption($curVal);
			if ($this->tambahan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->tambahan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->tambahan->ViewValue = $this->tambahan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->tambahan->ViewValue = $this->tambahan->CurrentValue;
				}
			}
		} else {
			$this->tambahan->ViewValue = NULL;
		}
		$this->tambahan->ViewCustomAttributes = "";

		// lama_kerja
		$this->lama_kerja->ViewValue = $this->lama_kerja->CurrentValue;
		$this->lama_kerja->ViewValue = FormatNumber($this->lama_kerja->ViewValue, 0, -2, -2, -2);
		$this->lama_kerja->ViewCustomAttributes = "";

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
		$this->tgllahir->ViewValue = FormatDateTime($this->tgllahir->ViewValue, 0);
		$this->tgllahir->ViewCustomAttributes = "";

		// rekbank
		$this->rekbank->ViewValue = $this->rekbank->CurrentValue;
		$this->rekbank->ViewCustomAttributes = "";

		// pendidikan
		$curVal = strval($this->pendidikan->CurrentValue);
		if ($curVal != "") {
			$this->pendidikan->ViewValue = $this->pendidikan->lookupCacheOption($curVal);
			if ($this->pendidikan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->pendidikan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->pendidikan->ViewValue = $this->pendidikan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->pendidikan->ViewValue = $this->pendidikan->CurrentValue;
				}
			}
		} else {
			$this->pendidikan->ViewValue = NULL;
		}
		$this->pendidikan->ViewCustomAttributes = "";

		// jurusan
		$this->jurusan->ViewValue = $this->jurusan->CurrentValue;
		$this->jurusan->ViewCustomAttributes = "";

		// agama
		$curVal = strval($this->agama->CurrentValue);
		if ($curVal != "") {
			$this->agama->ViewValue = $this->agama->lookupCacheOption($curVal);
			if ($this->agama->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`name`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->agama->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->agama->ViewValue = $this->agama->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->agama->ViewValue = $this->agama->CurrentValue;
				}
			}
		} else {
			$this->agama->ViewValue = NULL;
		}
		$this->agama->ViewCustomAttributes = "";

		// jenkel
		$curVal = strval($this->jenkel->CurrentValue);
		if ($curVal != "") {
			$this->jenkel->ViewValue = $this->jenkel->lookupCacheOption($curVal);
			if ($this->jenkel->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`gen`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->jenkel->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->jenkel->ViewValue = $this->jenkel->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->jenkel->ViewValue = $this->jenkel->CurrentValue;
				}
			}
		} else {
			$this->jenkel->ViewValue = NULL;
		}
		$this->jenkel->ViewCustomAttributes = "";

		// status
		$this->status->ViewValue = $this->status->CurrentValue;
		$this->status->ViewCustomAttributes = "";

		// foto
		if (!EmptyValue($this->foto->Upload->DbValue)) {
			$this->foto->ViewValue = $this->foto->Upload->DbValue;
		} else {
			$this->foto->ViewValue = "";
		}
		$this->foto->ViewCustomAttributes = "";

		// file_cv
		if (!EmptyValue($this->file_cv->Upload->DbValue)) {
			$this->file_cv->ViewValue = $this->file_cv->Upload->DbValue;
		} else {
			$this->file_cv->ViewValue = "";
		}
		$this->file_cv->ViewCustomAttributes = "";

		// mulai_bekerja
		$this->mulai_bekerja->ViewValue = $this->mulai_bekerja->CurrentValue;
		$this->mulai_bekerja->ViewValue = FormatDateTime($this->mulai_bekerja->ViewValue, 0);
		$this->mulai_bekerja->ViewCustomAttributes = "";

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->ViewCustomAttributes = "";

		// level
		if ($Security->canAdmin()) { // System admin
			$curVal = strval($this->level->CurrentValue);
			if ($curVal != "") {
				$this->level->ViewValue = $this->level->lookupCacheOption($curVal);
				if ($this->level->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->level->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->level->ViewValue = $this->level->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->level->ViewValue = $this->level->CurrentValue;
					}
				}
			} else {
				$this->level->ViewValue = NULL;
			}
		} else {
			$this->level->ViewValue = $Language->phrase("PasswordMask");
		}
		$this->level->ViewCustomAttributes = "";

		// aktif
		$this->aktif->ViewValue = $this->aktif->CurrentValue;
		$this->aktif->ViewValue = FormatNumber($this->aktif->ViewValue, 0, -2, -2, -2);
		$this->aktif->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// pid
		$this->pid->LinkCustomAttributes = "";
		$this->pid->HrefValue = "";
		$this->pid->TooltipValue = "";

		// nip
		$this->nip->LinkCustomAttributes = "";
		$this->nip->HrefValue = "";
		$this->nip->TooltipValue = "";

		// username
		$this->username->LinkCustomAttributes = "";
		$this->username->HrefValue = "";
		$this->username->TooltipValue = "";

		// password
		$this->password->LinkCustomAttributes = "";
		$this->password->HrefValue = "";
		$this->password->TooltipValue = "";

		// jenjang_id
		$this->jenjang_id->LinkCustomAttributes = "";
		$this->jenjang_id->HrefValue = "";
		$this->jenjang_id->TooltipValue = "";

		// jabatan
		$this->jabatan->LinkCustomAttributes = "";
		$this->jabatan->HrefValue = "";
		$this->jabatan->TooltipValue = "";

		// periode_jabatan
		$this->periode_jabatan->LinkCustomAttributes = "";
		$this->periode_jabatan->HrefValue = "";
		$this->periode_jabatan->TooltipValue = "";

		// type
		$this->type->LinkCustomAttributes = "";
		$this->type->HrefValue = "";
		$this->type->TooltipValue = "";

		// sertif
		$this->sertif->LinkCustomAttributes = "";
		$this->sertif->HrefValue = "";
		$this->sertif->TooltipValue = "";

		// tambahan
		$this->tambahan->LinkCustomAttributes = "";
		$this->tambahan->HrefValue = "";
		$this->tambahan->TooltipValue = "";

		// lama_kerja
		$this->lama_kerja->LinkCustomAttributes = "";
		$this->lama_kerja->HrefValue = "";
		$this->lama_kerja->TooltipValue = "";

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

		// jenkel
		$this->jenkel->LinkCustomAttributes = "";
		$this->jenkel->HrefValue = "";
		$this->jenkel->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

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

		// mulai_bekerja
		$this->mulai_bekerja->LinkCustomAttributes = "";
		$this->mulai_bekerja->HrefValue = "";
		$this->mulai_bekerja->TooltipValue = "";

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

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->customTemplateFieldValues();
	}

	// Render edit row values
	public function renderEditRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pid
		$this->pid->EditAttrs["class"] = "form-control";
		$this->pid->EditCustomAttributes = "";
		$this->pid->EditValue = $this->pid->CurrentValue;
		$this->pid->PlaceHolder = RemoveHtml($this->pid->caption());

		// nip
		$this->nip->EditAttrs["class"] = "form-control";
		$this->nip->EditCustomAttributes = "";
		if (!$this->nip->Raw)
			$this->nip->CurrentValue = HtmlDecode($this->nip->CurrentValue);
		$this->nip->EditValue = $this->nip->CurrentValue;
		$this->nip->PlaceHolder = RemoveHtml($this->nip->caption());

		// username
		$this->username->EditAttrs["class"] = "form-control";
		$this->username->EditCustomAttributes = "";
		if (!$this->username->Raw)
			$this->username->CurrentValue = HtmlDecode($this->username->CurrentValue);
		$this->username->EditValue = $this->username->CurrentValue;
		$this->username->PlaceHolder = RemoveHtml($this->username->caption());

		// password
		$this->password->EditAttrs["class"] = "form-control";
		$this->password->EditCustomAttributes = "";
		if (!$this->password->Raw)
			$this->password->CurrentValue = HtmlDecode($this->password->CurrentValue);
		$this->password->EditValue = $this->password->CurrentValue;
		$this->password->PlaceHolder = RemoveHtml($this->password->caption());

		// jenjang_id
		$this->jenjang_id->EditAttrs["class"] = "form-control";
		$this->jenjang_id->EditCustomAttributes = "";

		// jabatan
		$this->jabatan->EditAttrs["class"] = "form-control";
		$this->jabatan->EditCustomAttributes = "";

		// periode_jabatan
		$this->periode_jabatan->EditAttrs["class"] = "form-control";
		$this->periode_jabatan->EditCustomAttributes = "";
		$this->periode_jabatan->EditValue = $this->periode_jabatan->CurrentValue;
		$this->periode_jabatan->PlaceHolder = RemoveHtml($this->periode_jabatan->caption());

		// type
		$this->type->EditAttrs["class"] = "form-control";
		$this->type->EditCustomAttributes = "";
		$this->type->EditValue = $this->type->CurrentValue;
		$this->type->PlaceHolder = RemoveHtml($this->type->caption());

		// sertif
		$this->sertif->EditAttrs["class"] = "form-control";
		$this->sertif->EditCustomAttributes = "";

		// tambahan
		$this->tambahan->EditAttrs["class"] = "form-control";
		$this->tambahan->EditCustomAttributes = "";

		// lama_kerja
		$this->lama_kerja->EditAttrs["class"] = "form-control";
		$this->lama_kerja->EditCustomAttributes = "";
		$this->lama_kerja->EditValue = $this->lama_kerja->CurrentValue;
		$this->lama_kerja->PlaceHolder = RemoveHtml($this->lama_kerja->caption());

		// nama
		$this->nama->EditAttrs["class"] = "form-control";
		$this->nama->EditCustomAttributes = "";
		if (!$this->nama->Raw)
			$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
		$this->nama->EditValue = $this->nama->CurrentValue;
		$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

		// alamat
		$this->alamat->EditAttrs["class"] = "form-control";
		$this->alamat->EditCustomAttributes = "";
		if (!$this->alamat->Raw)
			$this->alamat->CurrentValue = HtmlDecode($this->alamat->CurrentValue);
		$this->alamat->EditValue = $this->alamat->CurrentValue;
		$this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

		// email
		$this->_email->EditAttrs["class"] = "form-control";
		$this->_email->EditCustomAttributes = "";
		if (!$this->_email->Raw)
			$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
		$this->_email->EditValue = $this->_email->CurrentValue;
		$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

		// wa
		$this->wa->EditAttrs["class"] = "form-control";
		$this->wa->EditCustomAttributes = "";
		if (!$this->wa->Raw)
			$this->wa->CurrentValue = HtmlDecode($this->wa->CurrentValue);
		$this->wa->EditValue = $this->wa->CurrentValue;
		$this->wa->PlaceHolder = RemoveHtml($this->wa->caption());

		// hp
		$this->hp->EditAttrs["class"] = "form-control";
		$this->hp->EditCustomAttributes = "";
		if (!$this->hp->Raw)
			$this->hp->CurrentValue = HtmlDecode($this->hp->CurrentValue);
		$this->hp->EditValue = $this->hp->CurrentValue;
		$this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

		// tgllahir
		$this->tgllahir->EditAttrs["class"] = "form-control";
		$this->tgllahir->EditCustomAttributes = "";
		$this->tgllahir->EditValue = FormatDateTime($this->tgllahir->CurrentValue, 8);
		$this->tgllahir->PlaceHolder = RemoveHtml($this->tgllahir->caption());

		// rekbank
		$this->rekbank->EditAttrs["class"] = "form-control";
		$this->rekbank->EditCustomAttributes = "";
		if (!$this->rekbank->Raw)
			$this->rekbank->CurrentValue = HtmlDecode($this->rekbank->CurrentValue);
		$this->rekbank->EditValue = $this->rekbank->CurrentValue;
		$this->rekbank->PlaceHolder = RemoveHtml($this->rekbank->caption());

		// pendidikan
		$this->pendidikan->EditAttrs["class"] = "form-control";
		$this->pendidikan->EditCustomAttributes = "";

		// jurusan
		$this->jurusan->EditAttrs["class"] = "form-control";
		$this->jurusan->EditCustomAttributes = "";
		if (!$this->jurusan->Raw)
			$this->jurusan->CurrentValue = HtmlDecode($this->jurusan->CurrentValue);
		$this->jurusan->EditValue = $this->jurusan->CurrentValue;
		$this->jurusan->PlaceHolder = RemoveHtml($this->jurusan->caption());

		// agama
		$this->agama->EditAttrs["class"] = "form-control";
		$this->agama->EditCustomAttributes = "";

		// jenkel
		$this->jenkel->EditCustomAttributes = "";

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";
		if (!$this->status->Raw)
			$this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
		$this->status->EditValue = $this->status->CurrentValue;
		$this->status->PlaceHolder = RemoveHtml($this->status->caption());

		// foto
		$this->foto->EditAttrs["class"] = "form-control";
		$this->foto->EditCustomAttributes = "";
		if (!EmptyValue($this->foto->Upload->DbValue)) {
			$this->foto->EditValue = $this->foto->Upload->DbValue;
		} else {
			$this->foto->EditValue = "";
		}
		if (!EmptyValue($this->foto->CurrentValue))
				$this->foto->Upload->FileName = $this->foto->CurrentValue;

		// file_cv
		$this->file_cv->EditAttrs["class"] = "form-control";
		$this->file_cv->EditCustomAttributes = "";
		if (!EmptyValue($this->file_cv->Upload->DbValue)) {
			$this->file_cv->EditValue = $this->file_cv->Upload->DbValue;
		} else {
			$this->file_cv->EditValue = "";
		}
		if (!EmptyValue($this->file_cv->CurrentValue))
				$this->file_cv->Upload->FileName = $this->file_cv->CurrentValue;

		// mulai_bekerja
		$this->mulai_bekerja->EditAttrs["class"] = "form-control";
		$this->mulai_bekerja->EditCustomAttributes = "";
		$this->mulai_bekerja->EditValue = FormatDateTime($this->mulai_bekerja->CurrentValue, 8);
		$this->mulai_bekerja->PlaceHolder = RemoveHtml($this->mulai_bekerja->caption());

		// keterangan
		$this->keterangan->EditAttrs["class"] = "form-control";
		$this->keterangan->EditCustomAttributes = "";
		if (!$this->keterangan->Raw)
			$this->keterangan->CurrentValue = HtmlDecode($this->keterangan->CurrentValue);
		$this->keterangan->EditValue = $this->keterangan->CurrentValue;
		$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

		// level
		$this->level->EditAttrs["class"] = "form-control";
		$this->level->EditCustomAttributes = "";
		if (!$Security->canAdmin()) { // System admin
			$this->level->EditValue = $Language->phrase("PasswordMask");
		} else {
		}

		// aktif
		$this->aktif->EditAttrs["class"] = "form-control";
		$this->aktif->EditCustomAttributes = "";
		$this->aktif->EditValue = $this->aktif->CurrentValue;
		$this->aktif->PlaceHolder = RemoveHtml($this->aktif->caption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	public function aggregateListRowValues()
	{
	}

	// Aggregate list row (for rendering)
	public function aggregateListRow()
	{

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
	{
		if (!$recordset || !$doc)
			return;
		if (!$doc->ExportCustom) {

			// Write header
			$doc->exportTableHeader();
			if ($doc->Horizontal) { // Horizontal format, write header
				$doc->beginExportRow();
				if ($exportPageType == "view") {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->pid);
					$doc->exportCaption($this->nip);
					$doc->exportCaption($this->username);
					$doc->exportCaption($this->password);
					$doc->exportCaption($this->jenjang_id);
					$doc->exportCaption($this->jabatan);
					$doc->exportCaption($this->periode_jabatan);
					$doc->exportCaption($this->type);
					$doc->exportCaption($this->sertif);
					$doc->exportCaption($this->tambahan);
					$doc->exportCaption($this->lama_kerja);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->alamat);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->wa);
					$doc->exportCaption($this->hp);
					$doc->exportCaption($this->tgllahir);
					$doc->exportCaption($this->rekbank);
					$doc->exportCaption($this->pendidikan);
					$doc->exportCaption($this->jurusan);
					$doc->exportCaption($this->agama);
					$doc->exportCaption($this->jenkel);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->foto);
					$doc->exportCaption($this->file_cv);
					$doc->exportCaption($this->mulai_bekerja);
					$doc->exportCaption($this->keterangan);
					$doc->exportCaption($this->level);
					$doc->exportCaption($this->aktif);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->pid);
					$doc->exportCaption($this->nip);
					$doc->exportCaption($this->username);
					$doc->exportCaption($this->password);
					$doc->exportCaption($this->jenjang_id);
					$doc->exportCaption($this->jabatan);
					$doc->exportCaption($this->periode_jabatan);
					$doc->exportCaption($this->type);
					$doc->exportCaption($this->sertif);
					$doc->exportCaption($this->tambahan);
					$doc->exportCaption($this->lama_kerja);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->alamat);
					$doc->exportCaption($this->_email);
					$doc->exportCaption($this->wa);
					$doc->exportCaption($this->hp);
					$doc->exportCaption($this->tgllahir);
					$doc->exportCaption($this->rekbank);
					$doc->exportCaption($this->pendidikan);
					$doc->exportCaption($this->jurusan);
					$doc->exportCaption($this->agama);
					$doc->exportCaption($this->jenkel);
					$doc->exportCaption($this->status);
					$doc->exportCaption($this->foto);
					$doc->exportCaption($this->file_cv);
					$doc->exportCaption($this->mulai_bekerja);
					$doc->exportCaption($this->keterangan);
					$doc->exportCaption($this->level);
					$doc->exportCaption($this->aktif);
				}
				$doc->endExportRow();
			}
		}

		// Move to first record
		$recCnt = $startRec - 1;
		if (!$recordset->EOF) {
			$recordset->moveFirst();
			if ($startRec > 1)
				$recordset->move($startRec - 1);
		}
		while (!$recordset->EOF && $recCnt < $stopRec) {
			$recCnt++;
			if ($recCnt >= $startRec) {
				$rowCnt = $recCnt - $startRec + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0)
						$doc->exportPageBreak();
				}
				$this->loadListRowValues($recordset);

				// Render row
				$this->RowType = ROWTYPE_VIEW; // Render view
				$this->resetAttributes();
				$this->renderListRow();
				if (!$doc->ExportCustom) {
					$doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
					if ($exportPageType == "view") {
						$doc->exportField($this->id);
						$doc->exportField($this->pid);
						$doc->exportField($this->nip);
						$doc->exportField($this->username);
						$doc->exportField($this->password);
						$doc->exportField($this->jenjang_id);
						$doc->exportField($this->jabatan);
						$doc->exportField($this->periode_jabatan);
						$doc->exportField($this->type);
						$doc->exportField($this->sertif);
						$doc->exportField($this->tambahan);
						$doc->exportField($this->lama_kerja);
						$doc->exportField($this->nama);
						$doc->exportField($this->alamat);
						$doc->exportField($this->_email);
						$doc->exportField($this->wa);
						$doc->exportField($this->hp);
						$doc->exportField($this->tgllahir);
						$doc->exportField($this->rekbank);
						$doc->exportField($this->pendidikan);
						$doc->exportField($this->jurusan);
						$doc->exportField($this->agama);
						$doc->exportField($this->jenkel);
						$doc->exportField($this->status);
						$doc->exportField($this->foto);
						$doc->exportField($this->file_cv);
						$doc->exportField($this->mulai_bekerja);
						$doc->exportField($this->keterangan);
						$doc->exportField($this->level);
						$doc->exportField($this->aktif);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->pid);
						$doc->exportField($this->nip);
						$doc->exportField($this->username);
						$doc->exportField($this->password);
						$doc->exportField($this->jenjang_id);
						$doc->exportField($this->jabatan);
						$doc->exportField($this->periode_jabatan);
						$doc->exportField($this->type);
						$doc->exportField($this->sertif);
						$doc->exportField($this->tambahan);
						$doc->exportField($this->lama_kerja);
						$doc->exportField($this->nama);
						$doc->exportField($this->alamat);
						$doc->exportField($this->_email);
						$doc->exportField($this->wa);
						$doc->exportField($this->hp);
						$doc->exportField($this->tgllahir);
						$doc->exportField($this->rekbank);
						$doc->exportField($this->pendidikan);
						$doc->exportField($this->jurusan);
						$doc->exportField($this->agama);
						$doc->exportField($this->jenkel);
						$doc->exportField($this->status);
						$doc->exportField($this->foto);
						$doc->exportField($this->file_cv);
						$doc->exportField($this->mulai_bekerja);
						$doc->exportField($this->keterangan);
						$doc->exportField($this->level);
						$doc->exportField($this->aktif);
					}
					$doc->endExportRow($rowCnt);
				}
			}

			// Call Row Export server event
			if ($doc->ExportCustom)
				$this->Row_Export($recordset->fields);
			$recordset->moveNext();
		}
		if (!$doc->ExportCustom) {
			$doc->exportTableFooter();
		}
	}

	// Get file data
	public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0)
	{
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
			return FALSE; // Incorrect field
		}

		// Set up key values
		$ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($ar) == 1) {
			$this->id->CurrentValue = $ar[0];
		} else {
			return FALSE; // Incorrect key
		}

		// Set up filter (WHERE Clause)
		$filter = $this->getRecordFilter();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$dbtype = GetConnectionType($this->Dbid);
		if (($rs = $conn->execute($sql)) && !$rs->EOF) {
			$val = $rs->fields($fldName);
			if (!EmptyValue($val)) {
				$fld = $this->fields[$fldName];

				// Binary data
				if ($fld->DataType == DATATYPE_BLOB) {
					if ($dbtype != "MYSQL") {
						if (is_array($val) || is_object($val)) // Byte array
							$val = BytesToString($val);
					}
					if ($resize)
						ResizeBinary($val, $width, $height);

					// Write file type
					if ($fileTypeFld != "" && !EmptyValue($rs->fields($fileTypeFld))) {
						AddHeader("Content-type", $rs->fields($fileTypeFld));
					} else {
						AddHeader("Content-type", ContentType($val));
					}

					// Write file name
					$downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
					if ($fileNameFld != "" && !EmptyValue($rs->fields($fileNameFld))) {
						$fileName = $rs->fields($fileNameFld);
						$pathinfo = pathinfo($fileName);
						$ext = strtolower(@$pathinfo["extension"]);
						$isPdf = SameText($ext, "pdf");
						if ($downloadPdf || !$isPdf) // Skip header if not download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					} else {
						$ext = ContentExtension($val);
						$isPdf = SameText($ext, ".pdf");
						if ($isPdf && $downloadPdf) // Add header if download PDF
							AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
					}

					// Write file data
					if (StartsString("PK", $val) && ContainsString($val, "[Content_Types].xml") &&
						ContainsString($val, "_rels") && ContainsString($val, "docProps")) { // Fix Office 2007 documents
						if (!EndsString("\0\0\0", $val)) // Not ends with 3 or 4 \0
							$val .= "\0\0\0\0";
					}

					// Clear any debug message
					if (ob_get_length())
						ob_end_clean();

					// Write binary data
					Write($val);

				// Upload to folder
				} else {
					if ($fld->UploadMultiple)
						$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
					else
						$files = [$val];
					$data = [];
					$ar = [];
					foreach ($files as $file) {
						if (!EmptyValue($file))
							$ar[$file] = FullUrl($fld->hrefPath() . $file);
					}
					$data[$fld->Param] = $ar;
					WriteJson($data);
				}
			}
			$rs->close();
			return TRUE;
		}
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
					if(CurrentUserLevel() != '-1'){
				$nip = CurrentUserInfo("nip");
				if($nip != '' OR $nip != FALSE) {
					AddFilter($filter, "nip = $nip");
				}
				}
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending($email, &$args) {

		//var_dump($email); var_dump($args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
		$this->type->ReadOnly = true;
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>