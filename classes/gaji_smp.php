<?php namespace PHPMaker2020\sigap; ?>
<?php

/**
 * Table class for gaji_smp
 */
class gaji_smp extends DbTable
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
	public $datetime;
	public $by;
	public $month;
	public $pegawai;
	public $jenjang_id;
	public $jabatan_id;
	public $lama_kerja;
	public $type;
	public $jenis_guru;
	public $tambahan;
	public $periode;
	public $tunjangan_periode;
	public $kehadiran;
	public $value_kehadiran;
	public $lembur;
	public $value_lembur;
	public $jp;
	public $gapok;
	public $total_gapok;
	public $value_reward;
	public $value_inval;
	public $piket_count;
	public $value_piket;
	public $tugastambahan;
	public $tj_jabatan;
	public $sub_total;
	public $potongan;
	public $penyesuaian;
	public $total;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'gaji_smp';
		$this->TableName = 'gaji_smp';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`gaji_smp`";
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
		$this->id = new DbField('gaji_smp', 'gaji_smp', 'x_id', 'id', '`id`', '`id`', 3, 10, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// pid
		$this->pid = new DbField('gaji_smp', 'gaji_smp', 'x_pid', 'pid', '`pid`', '`pid`', 3, 11, -1, FALSE, '`pid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pid->IsForeignKey = TRUE; // Foreign key field
		$this->pid->Sortable = TRUE; // Allow sort
		$this->pid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pid'] = &$this->pid;

		// datetime
		$this->datetime = new DbField('gaji_smp', 'gaji_smp', 'x_datetime', 'datetime', '`datetime`', CastDateFieldForLike("`datetime`", 0, "DB"), 135, 19, 0, FALSE, '`datetime`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->datetime->Sortable = TRUE; // Allow sort
		$this->datetime->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['datetime'] = &$this->datetime;

		// by
		$this->by = new DbField('gaji_smp', 'gaji_smp', 'x_by', 'by', '`by`', '`by`', 3, 11, -1, FALSE, '`by`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->by->Sortable = TRUE; // Allow sort
		$this->by->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->by->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->by->Lookup = new Lookup('by', 'pegawai', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->by->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['by'] = &$this->by;

		// month
		$this->month = new DbField('gaji_smp', 'gaji_smp', 'x_month', 'month', '`month`', CastDateFieldForLike("`month`", 0, "DB"), 133, 10, 0, FALSE, '`month`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->month->Sortable = TRUE; // Allow sort
		$this->month->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['month'] = &$this->month;

		// pegawai
		$this->pegawai = new DbField('gaji_smp', 'gaji_smp', 'x_pegawai', 'pegawai', '`pegawai`', '`pegawai`', 200, 50, -1, FALSE, '`pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->pegawai->Sortable = TRUE; // Allow sort
		$this->pegawai->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->pegawai->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->pegawai->Lookup = new Lookup('pegawai', 'pegawai', FALSE, 'nip', ["nama","","",""], [], [], [], [], ["jenjang_id","jabatan"], ["x_jenjang_id","x_jabatan_id"], '', '');
		$this->fields['pegawai'] = &$this->pegawai;

		// jenjang_id
		$this->jenjang_id = new DbField('gaji_smp', 'gaji_smp', 'x_jenjang_id', 'jenjang_id', '`jenjang_id`', '`jenjang_id`', 3, 10, -1, FALSE, '`jenjang_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenjang_id->Sortable = TRUE; // Allow sort
		$this->jenjang_id->Lookup = new Lookup('jenjang_id', 'tpendidikan', FALSE, 'nourut', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->jenjang_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenjang_id'] = &$this->jenjang_id;

		// jabatan_id
		$this->jabatan_id = new DbField('gaji_smp', 'gaji_smp', 'x_jabatan_id', 'jabatan_id', '`jabatan_id`', '`jabatan_id`', 3, 10, -1, FALSE, '`jabatan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jabatan_id->Sortable = TRUE; // Allow sort
		$this->jabatan_id->Lookup = new Lookup('jabatan_id', 'jabatan', FALSE, 'id', ["nama_jabatan","","",""], [], [], [], [], [], [], '', '');
		$this->jabatan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jabatan_id'] = &$this->jabatan_id;

		// lama_kerja
		$this->lama_kerja = new DbField('gaji_smp', 'gaji_smp', 'x_lama_kerja', 'lama_kerja', '`lama_kerja`', '`lama_kerja`', 3, 11, -1, FALSE, '`lama_kerja`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lama_kerja->Sortable = TRUE; // Allow sort
		$this->lama_kerja->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['lama_kerja'] = &$this->lama_kerja;

		// type
		$this->type = new DbField('gaji_smp', 'gaji_smp', 'x_type', 'type', '`type`', '`type`', 3, 11, -1, FALSE, '`type`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->type->Sortable = TRUE; // Allow sort
		$this->type->Lookup = new Lookup('type', 'jenis_jabatan', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->type->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['type'] = &$this->type;

		// jenis_guru
		$this->jenis_guru = new DbField('gaji_smp', 'gaji_smp', 'x_jenis_guru', 'jenis_guru', '`jenis_guru`', '`jenis_guru`', 3, 11, -1, FALSE, '`jenis_guru`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenis_guru->Sortable = TRUE; // Allow sort
		$this->jenis_guru->Lookup = new Lookup('jenis_guru', 'sertif', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->jenis_guru->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jenis_guru'] = &$this->jenis_guru;

		// tambahan
		$this->tambahan = new DbField('gaji_smp', 'gaji_smp', 'x_tambahan', 'tambahan', '`tambahan`', '`tambahan`', 3, 11, -1, FALSE, '`tambahan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tambahan->Sortable = TRUE; // Allow sort
		$this->tambahan->Lookup = new Lookup('tambahan', 'tambahan_tugas', FALSE, 'id', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->tambahan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tambahan'] = &$this->tambahan;

		// periode
		$this->periode = new DbField('gaji_smp', 'gaji_smp', 'x_periode', 'periode', '`periode`', '`periode`', 3, 11, -1, FALSE, '`periode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->periode->Sortable = TRUE; // Allow sort
		$this->periode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['periode'] = &$this->periode;

		// tunjangan_periode
		$this->tunjangan_periode = new DbField('gaji_smp', 'gaji_smp', 'x_tunjangan_periode', 'tunjangan_periode', '`tunjangan_periode`', '`tunjangan_periode`', 20, 20, -1, FALSE, '`tunjangan_periode`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tunjangan_periode->Sortable = TRUE; // Allow sort
		$this->tunjangan_periode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tunjangan_periode'] = &$this->tunjangan_periode;

		// kehadiran
		$this->kehadiran = new DbField('gaji_smp', 'gaji_smp', 'x_kehadiran', 'kehadiran', '`kehadiran`', '`kehadiran`', 3, 10, -1, FALSE, '`kehadiran`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kehadiran->Sortable = TRUE; // Allow sort
		$this->kehadiran->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kehadiran'] = &$this->kehadiran;

		// value_kehadiran
		$this->value_kehadiran = new DbField('gaji_smp', 'gaji_smp', 'x_value_kehadiran', 'value_kehadiran', '`value_kehadiran`', '`value_kehadiran`', 20, 20, -1, FALSE, '`value_kehadiran`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->value_kehadiran->Sortable = TRUE; // Allow sort
		$this->value_kehadiran->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['value_kehadiran'] = &$this->value_kehadiran;

		// lembur
		$this->lembur = new DbField('gaji_smp', 'gaji_smp', 'x_lembur', 'lembur', '`lembur`', '`lembur`', 3, 10, -1, FALSE, '`lembur`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lembur->Sortable = TRUE; // Allow sort
		$this->lembur->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['lembur'] = &$this->lembur;

		// value_lembur
		$this->value_lembur = new DbField('gaji_smp', 'gaji_smp', 'x_value_lembur', 'value_lembur', '`value_lembur`', '`value_lembur`', 20, 19, -1, FALSE, '`value_lembur`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->value_lembur->Sortable = TRUE; // Allow sort
		$this->value_lembur->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['value_lembur'] = &$this->value_lembur;

		// jp
		$this->jp = new DbField('gaji_smp', 'gaji_smp', 'x_jp', 'jp', '`jp`', '`jp`', 3, 11, -1, FALSE, '`jp`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jp->Sortable = TRUE; // Allow sort
		$this->jp->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jp'] = &$this->jp;

		// gapok
		$this->gapok = new DbField('gaji_smp', 'gaji_smp', 'x_gapok', 'gapok', '`gapok`', '`gapok`', 20, 19, -1, FALSE, '`gapok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->gapok->Sortable = TRUE; // Allow sort
		$this->gapok->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['gapok'] = &$this->gapok;

		// total_gapok
		$this->total_gapok = new DbField('gaji_smp', 'gaji_smp', 'x_total_gapok', 'total_gapok', '`total_gapok`', '`total_gapok`', 20, 20, -1, FALSE, '`total_gapok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_gapok->Sortable = TRUE; // Allow sort
		$this->total_gapok->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['total_gapok'] = &$this->total_gapok;

		// value_reward
		$this->value_reward = new DbField('gaji_smp', 'gaji_smp', 'x_value_reward', 'value_reward', '`value_reward`', '`value_reward`', 20, 19, -1, FALSE, '`value_reward`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->value_reward->Sortable = TRUE; // Allow sort
		$this->value_reward->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['value_reward'] = &$this->value_reward;

		// value_inval
		$this->value_inval = new DbField('gaji_smp', 'gaji_smp', 'x_value_inval', 'value_inval', '`value_inval`', '`value_inval`', 20, 19, -1, FALSE, '`value_inval`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->value_inval->Sortable = TRUE; // Allow sort
		$this->value_inval->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['value_inval'] = &$this->value_inval;

		// piket_count
		$this->piket_count = new DbField('gaji_smp', 'gaji_smp', 'x_piket_count', 'piket_count', '`piket_count`', '`piket_count`', 3, 10, -1, FALSE, '`piket_count`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->piket_count->Sortable = TRUE; // Allow sort
		$this->piket_count->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['piket_count'] = &$this->piket_count;

		// value_piket
		$this->value_piket = new DbField('gaji_smp', 'gaji_smp', 'x_value_piket', 'value_piket', '`value_piket`', '`value_piket`', 20, 19, -1, FALSE, '`value_piket`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->value_piket->Sortable = TRUE; // Allow sort
		$this->value_piket->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['value_piket'] = &$this->value_piket;

		// tugastambahan
		$this->tugastambahan = new DbField('gaji_smp', 'gaji_smp', 'x_tugastambahan', 'tugastambahan', '`tugastambahan`', '`tugastambahan`', 20, 19, -1, FALSE, '`tugastambahan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tugastambahan->Sortable = TRUE; // Allow sort
		$this->tugastambahan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tugastambahan'] = &$this->tugastambahan;

		// tj_jabatan
		$this->tj_jabatan = new DbField('gaji_smp', 'gaji_smp', 'x_tj_jabatan', 'tj_jabatan', '`tj_jabatan`', '`tj_jabatan`', 20, 19, -1, FALSE, '`tj_jabatan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tj_jabatan->Sortable = TRUE; // Allow sort
		$this->tj_jabatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tj_jabatan'] = &$this->tj_jabatan;

		// sub_total
		$this->sub_total = new DbField('gaji_smp', 'gaji_smp', 'x_sub_total', 'sub_total', '`sub_total`', '`sub_total`', 20, 19, -1, FALSE, '`sub_total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sub_total->Sortable = TRUE; // Allow sort
		$this->sub_total->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['sub_total'] = &$this->sub_total;

		// potongan
		$this->potongan = new DbField('gaji_smp', 'gaji_smp', 'x_potongan', 'potongan', '`potongan`', '`potongan`', 20, 19, -1, FALSE, '`potongan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->potongan->Sortable = TRUE; // Allow sort
		$this->potongan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['potongan'] = &$this->potongan;

		// penyesuaian
		$this->penyesuaian = new DbField('gaji_smp', 'gaji_smp', 'x_penyesuaian', 'penyesuaian', '`penyesuaian`', '`penyesuaian`', 20, 19, -1, FALSE, '`penyesuaian`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->penyesuaian->Sortable = TRUE; // Allow sort
		$this->penyesuaian->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['penyesuaian'] = &$this->penyesuaian;

		// total
		$this->total = new DbField('gaji_smp', 'gaji_smp', 'x_total', 'total', '`total`', '`total`', 20, 19, -1, FALSE, '`total`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total->Sortable = TRUE; // Allow sort
		$this->total->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['total'] = &$this->total;
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

	// Current master table name
	public function getCurrentMasterTable()
	{
		return @$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")];
	}
	public function setCurrentMasterTable($v)
	{
		$_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
	}

	// Session master WHERE clause
	public function getMasterFilter()
	{

		// Master filter
		$masterFilter = "";
		if ($this->getCurrentMasterTable() == "m_smp") {
			if ($this->pid->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->pid->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $masterFilter;
	}

	// Session detail WHERE clause
	public function getDetailFilter()
	{

		// Detail filter
		$detailFilter = "";
		if ($this->getCurrentMasterTable() == "m_smp") {
			if ($this->pid->getSessionValue() != "")
				$detailFilter .= "`pid`=" . QuotedValue($this->pid->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_m_smp()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_m_smp()
	{
		return "`pid`=@pid@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`gaji_smp`";
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
		return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : "`month` DESC";
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
		$this->datetime->DbValue = $row['datetime'];
		$this->by->DbValue = $row['by'];
		$this->month->DbValue = $row['month'];
		$this->pegawai->DbValue = $row['pegawai'];
		$this->jenjang_id->DbValue = $row['jenjang_id'];
		$this->jabatan_id->DbValue = $row['jabatan_id'];
		$this->lama_kerja->DbValue = $row['lama_kerja'];
		$this->type->DbValue = $row['type'];
		$this->jenis_guru->DbValue = $row['jenis_guru'];
		$this->tambahan->DbValue = $row['tambahan'];
		$this->periode->DbValue = $row['periode'];
		$this->tunjangan_periode->DbValue = $row['tunjangan_periode'];
		$this->kehadiran->DbValue = $row['kehadiran'];
		$this->value_kehadiran->DbValue = $row['value_kehadiran'];
		$this->lembur->DbValue = $row['lembur'];
		$this->value_lembur->DbValue = $row['value_lembur'];
		$this->jp->DbValue = $row['jp'];
		$this->gapok->DbValue = $row['gapok'];
		$this->total_gapok->DbValue = $row['total_gapok'];
		$this->value_reward->DbValue = $row['value_reward'];
		$this->value_inval->DbValue = $row['value_inval'];
		$this->piket_count->DbValue = $row['piket_count'];
		$this->value_piket->DbValue = $row['value_piket'];
		$this->tugastambahan->DbValue = $row['tugastambahan'];
		$this->tj_jabatan->DbValue = $row['tj_jabatan'];
		$this->sub_total->DbValue = $row['sub_total'];
		$this->potongan->DbValue = $row['potongan'];
		$this->penyesuaian->DbValue = $row['penyesuaian'];
		$this->total->DbValue = $row['total'];
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
			return "gaji_smplist.php";
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
		if ($pageName == "gaji_smpview.php")
			return $Language->phrase("View");
		elseif ($pageName == "gaji_smpedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "gaji_smpadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "gaji_smplist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("gaji_smpview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("gaji_smpview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "gaji_smpadd.php?" . $this->getUrlParm($parm);
		else
			$url = "gaji_smpadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("gaji_smpedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("gaji_smpadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("gaji_smpdelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "m_smp" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->pid->CurrentValue);
		}
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
		$this->datetime->setDbValue($rs->fields('datetime'));
		$this->by->setDbValue($rs->fields('by'));
		$this->month->setDbValue($rs->fields('month'));
		$this->pegawai->setDbValue($rs->fields('pegawai'));
		$this->jenjang_id->setDbValue($rs->fields('jenjang_id'));
		$this->jabatan_id->setDbValue($rs->fields('jabatan_id'));
		$this->lama_kerja->setDbValue($rs->fields('lama_kerja'));
		$this->type->setDbValue($rs->fields('type'));
		$this->jenis_guru->setDbValue($rs->fields('jenis_guru'));
		$this->tambahan->setDbValue($rs->fields('tambahan'));
		$this->periode->setDbValue($rs->fields('periode'));
		$this->tunjangan_periode->setDbValue($rs->fields('tunjangan_periode'));
		$this->kehadiran->setDbValue($rs->fields('kehadiran'));
		$this->value_kehadiran->setDbValue($rs->fields('value_kehadiran'));
		$this->lembur->setDbValue($rs->fields('lembur'));
		$this->value_lembur->setDbValue($rs->fields('value_lembur'));
		$this->jp->setDbValue($rs->fields('jp'));
		$this->gapok->setDbValue($rs->fields('gapok'));
		$this->total_gapok->setDbValue($rs->fields('total_gapok'));
		$this->value_reward->setDbValue($rs->fields('value_reward'));
		$this->value_inval->setDbValue($rs->fields('value_inval'));
		$this->piket_count->setDbValue($rs->fields('piket_count'));
		$this->value_piket->setDbValue($rs->fields('value_piket'));
		$this->tugastambahan->setDbValue($rs->fields('tugastambahan'));
		$this->tj_jabatan->setDbValue($rs->fields('tj_jabatan'));
		$this->sub_total->setDbValue($rs->fields('sub_total'));
		$this->potongan->setDbValue($rs->fields('potongan'));
		$this->penyesuaian->setDbValue($rs->fields('penyesuaian'));
		$this->total->setDbValue($rs->fields('total'));
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
		// datetime
		// by
		// month
		// pegawai
		// jenjang_id
		// jabatan_id
		// lama_kerja
		// type
		// jenis_guru
		// tambahan
		// periode
		// tunjangan_periode
		// kehadiran
		// value_kehadiran
		// lembur
		// value_lembur
		// jp
		// gapok
		// total_gapok
		// value_reward
		// value_inval
		// piket_count
		// value_piket
		// tugastambahan
		// tj_jabatan
		// sub_total
		// potongan
		// penyesuaian
		// total
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pid
		$this->pid->ViewValue = $this->pid->CurrentValue;
		$this->pid->ViewValue = FormatNumber($this->pid->ViewValue, 0, -2, -2, -2);
		$this->pid->ViewCustomAttributes = "";

		// datetime
		$this->datetime->ViewValue = $this->datetime->CurrentValue;
		$this->datetime->ViewValue = FormatDateTime($this->datetime->ViewValue, 0);
		$this->datetime->ViewCustomAttributes = "";

		// by
		$curVal = strval($this->by->CurrentValue);
		if ($curVal != "") {
			$this->by->ViewValue = $this->by->lookupCacheOption($curVal);
			if ($this->by->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->by->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->by->ViewValue = $this->by->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->by->ViewValue = $this->by->CurrentValue;
				}
			}
		} else {
			$this->by->ViewValue = NULL;
		}
		$this->by->ViewCustomAttributes = "";

		// month
		$this->month->ViewValue = $this->month->CurrentValue;
		$this->month->ViewValue = FormatDateTime($this->month->ViewValue, 0);
		$this->month->ViewCustomAttributes = "";

		// pegawai
		$curVal = strval($this->pegawai->CurrentValue);
		if ($curVal != "") {
			$this->pegawai->ViewValue = $this->pegawai->lookupCacheOption($curVal);
			if ($this->pegawai->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`nip`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->pegawai->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->pegawai->ViewValue = $this->pegawai->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->pegawai->ViewValue = $this->pegawai->CurrentValue;
				}
			}
		} else {
			$this->pegawai->ViewValue = NULL;
		}
		$this->pegawai->ViewCustomAttributes = "";

		// jenjang_id
		$this->jenjang_id->ViewValue = $this->jenjang_id->CurrentValue;
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

		// jabatan_id
		$this->jabatan_id->ViewValue = $this->jabatan_id->CurrentValue;
		$curVal = strval($this->jabatan_id->CurrentValue);
		if ($curVal != "") {
			$this->jabatan_id->ViewValue = $this->jabatan_id->lookupCacheOption($curVal);
			if ($this->jabatan_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->jabatan_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->jabatan_id->ViewValue = $this->jabatan_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->jabatan_id->ViewValue = $this->jabatan_id->CurrentValue;
				}
			}
		} else {
			$this->jabatan_id->ViewValue = NULL;
		}
		$this->jabatan_id->ViewCustomAttributes = "";

		// lama_kerja
		$this->lama_kerja->ViewValue = $this->lama_kerja->CurrentValue;
		$this->lama_kerja->ViewValue = FormatNumber($this->lama_kerja->ViewValue, 0, -2, -2, -2);
		$this->lama_kerja->ViewCustomAttributes = "";

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

		// jenis_guru
		$this->jenis_guru->ViewValue = $this->jenis_guru->CurrentValue;
		$curVal = strval($this->jenis_guru->CurrentValue);
		if ($curVal != "") {
			$this->jenis_guru->ViewValue = $this->jenis_guru->lookupCacheOption($curVal);
			if ($this->jenis_guru->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->jenis_guru->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->jenis_guru->ViewValue = $this->jenis_guru->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->jenis_guru->ViewValue = $this->jenis_guru->CurrentValue;
				}
			}
		} else {
			$this->jenis_guru->ViewValue = NULL;
		}
		$this->jenis_guru->ViewCustomAttributes = "";

		// tambahan
		$this->tambahan->ViewValue = $this->tambahan->CurrentValue;
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

		// periode
		$this->periode->ViewValue = $this->periode->CurrentValue;
		$this->periode->ViewValue = FormatNumber($this->periode->ViewValue, 0, -2, -2, -2);
		$this->periode->ViewCustomAttributes = "";

		// tunjangan_periode
		$this->tunjangan_periode->ViewValue = $this->tunjangan_periode->CurrentValue;
		$this->tunjangan_periode->ViewValue = FormatNumber($this->tunjangan_periode->ViewValue, 0, -2, -2, -2);
		$this->tunjangan_periode->ViewCustomAttributes = "";

		// kehadiran
		$this->kehadiran->ViewValue = $this->kehadiran->CurrentValue;
		$this->kehadiran->ViewValue = FormatNumber($this->kehadiran->ViewValue, 0, -2, -2, -2);
		$this->kehadiran->ViewCustomAttributes = "";

		// value_kehadiran
		$this->value_kehadiran->ViewValue = $this->value_kehadiran->CurrentValue;
		$this->value_kehadiran->ViewValue = FormatNumber($this->value_kehadiran->ViewValue, 0, -2, -2, -2);
		$this->value_kehadiran->ViewCustomAttributes = "";

		// lembur
		$this->lembur->ViewValue = $this->lembur->CurrentValue;
		$this->lembur->ViewValue = FormatNumber($this->lembur->ViewValue, 0, -2, -2, -2);
		$this->lembur->ViewCustomAttributes = "";

		// value_lembur
		$this->value_lembur->ViewValue = $this->value_lembur->CurrentValue;
		$this->value_lembur->ViewValue = FormatNumber($this->value_lembur->ViewValue, 0, -2, -2, -2);
		$this->value_lembur->ViewCustomAttributes = "";

		// jp
		$this->jp->ViewValue = $this->jp->CurrentValue;
		$this->jp->ViewValue = FormatNumber($this->jp->ViewValue, 0, -2, -2, -2);
		$this->jp->ViewCustomAttributes = "";

		// gapok
		$this->gapok->ViewValue = $this->gapok->CurrentValue;
		$this->gapok->ViewValue = FormatNumber($this->gapok->ViewValue, 0, -2, -2, -2);
		$this->gapok->ViewCustomAttributes = "";

		// total_gapok
		$this->total_gapok->ViewValue = $this->total_gapok->CurrentValue;
		$this->total_gapok->ViewValue = FormatNumber($this->total_gapok->ViewValue, 0, -2, -2, -2);
		$this->total_gapok->ViewCustomAttributes = "";

		// value_reward
		$this->value_reward->ViewValue = $this->value_reward->CurrentValue;
		$this->value_reward->ViewValue = FormatNumber($this->value_reward->ViewValue, 0, -2, -2, -2);
		$this->value_reward->ViewCustomAttributes = "";

		// value_inval
		$this->value_inval->ViewValue = $this->value_inval->CurrentValue;
		$this->value_inval->ViewValue = FormatNumber($this->value_inval->ViewValue, 0, -2, -2, -2);
		$this->value_inval->ViewCustomAttributes = "";

		// piket_count
		$this->piket_count->ViewValue = $this->piket_count->CurrentValue;
		$this->piket_count->ViewValue = FormatNumber($this->piket_count->ViewValue, 0, -2, -2, -2);
		$this->piket_count->ViewCustomAttributes = "";

		// value_piket
		$this->value_piket->ViewValue = $this->value_piket->CurrentValue;
		$this->value_piket->ViewValue = FormatNumber($this->value_piket->ViewValue, 0, -2, -2, -2);
		$this->value_piket->ViewCustomAttributes = "";

		// tugastambahan
		$this->tugastambahan->ViewValue = $this->tugastambahan->CurrentValue;
		$this->tugastambahan->ViewValue = FormatNumber($this->tugastambahan->ViewValue, 0, -2, -2, -2);
		$this->tugastambahan->ViewCustomAttributes = "";

		// tj_jabatan
		$this->tj_jabatan->ViewValue = $this->tj_jabatan->CurrentValue;
		$this->tj_jabatan->ViewValue = FormatNumber($this->tj_jabatan->ViewValue, 0, -2, -2, -2);
		$this->tj_jabatan->ViewCustomAttributes = "";

		// sub_total
		$this->sub_total->ViewValue = $this->sub_total->CurrentValue;
		$this->sub_total->ViewValue = FormatNumber($this->sub_total->ViewValue, 0, -2, -2, -2);
		$this->sub_total->ViewCustomAttributes = "";

		// potongan
		$this->potongan->ViewValue = $this->potongan->CurrentValue;
		$this->potongan->ViewValue = FormatNumber($this->potongan->ViewValue, 0, -2, -2, -2);
		$this->potongan->ViewCustomAttributes = "";

		// penyesuaian
		$this->penyesuaian->ViewValue = $this->penyesuaian->CurrentValue;
		$this->penyesuaian->ViewValue = FormatNumber($this->penyesuaian->ViewValue, 0, -2, -2, -2);
		$this->penyesuaian->ViewCustomAttributes = "";

		// total
		$this->total->ViewValue = $this->total->CurrentValue;
		$this->total->ViewValue = FormatNumber($this->total->ViewValue, 0, -2, -2, -2);
		$this->total->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// pid
		$this->pid->LinkCustomAttributes = "";
		$this->pid->HrefValue = "";
		$this->pid->TooltipValue = "";

		// datetime
		$this->datetime->LinkCustomAttributes = "";
		$this->datetime->HrefValue = "";
		$this->datetime->TooltipValue = "";

		// by
		$this->by->LinkCustomAttributes = "";
		$this->by->HrefValue = "";
		$this->by->TooltipValue = "";

		// month
		$this->month->LinkCustomAttributes = "";
		$this->month->HrefValue = "";
		$this->month->TooltipValue = "";

		// pegawai
		$this->pegawai->LinkCustomAttributes = "";
		$this->pegawai->HrefValue = "";
		$this->pegawai->TooltipValue = "";

		// jenjang_id
		$this->jenjang_id->LinkCustomAttributes = "";
		$this->jenjang_id->HrefValue = "";
		$this->jenjang_id->TooltipValue = "";

		// jabatan_id
		$this->jabatan_id->LinkCustomAttributes = "";
		$this->jabatan_id->HrefValue = "";
		$this->jabatan_id->TooltipValue = "";

		// lama_kerja
		$this->lama_kerja->LinkCustomAttributes = "";
		$this->lama_kerja->HrefValue = "";
		$this->lama_kerja->TooltipValue = "";

		// type
		$this->type->LinkCustomAttributes = "";
		$this->type->HrefValue = "";
		$this->type->TooltipValue = "";

		// jenis_guru
		$this->jenis_guru->LinkCustomAttributes = "";
		$this->jenis_guru->HrefValue = "";
		$this->jenis_guru->TooltipValue = "";

		// tambahan
		$this->tambahan->LinkCustomAttributes = "";
		$this->tambahan->HrefValue = "";
		$this->tambahan->TooltipValue = "";

		// periode
		$this->periode->LinkCustomAttributes = "";
		$this->periode->HrefValue = "";
		$this->periode->TooltipValue = "";

		// tunjangan_periode
		$this->tunjangan_periode->LinkCustomAttributes = "";
		$this->tunjangan_periode->HrefValue = "";
		$this->tunjangan_periode->TooltipValue = "";

		// kehadiran
		$this->kehadiran->LinkCustomAttributes = "";
		$this->kehadiran->HrefValue = "";
		$this->kehadiran->TooltipValue = "";

		// value_kehadiran
		$this->value_kehadiran->LinkCustomAttributes = "";
		$this->value_kehadiran->HrefValue = "";
		$this->value_kehadiran->TooltipValue = "";

		// lembur
		$this->lembur->LinkCustomAttributes = "";
		$this->lembur->HrefValue = "";
		$this->lembur->TooltipValue = "";

		// value_lembur
		$this->value_lembur->LinkCustomAttributes = "";
		$this->value_lembur->HrefValue = "";
		$this->value_lembur->TooltipValue = "";

		// jp
		$this->jp->LinkCustomAttributes = "";
		$this->jp->HrefValue = "";
		$this->jp->TooltipValue = "";

		// gapok
		$this->gapok->LinkCustomAttributes = "";
		$this->gapok->HrefValue = "";
		$this->gapok->TooltipValue = "";

		// total_gapok
		$this->total_gapok->LinkCustomAttributes = "";
		$this->total_gapok->HrefValue = "";
		$this->total_gapok->TooltipValue = "";

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

		// penyesuaian
		$this->penyesuaian->LinkCustomAttributes = "";
		$this->penyesuaian->HrefValue = "";
		$this->penyesuaian->TooltipValue = "";

		// total
		$this->total->LinkCustomAttributes = "";
		$this->total->HrefValue = "";
		$this->total->TooltipValue = "";

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
		if ($this->pid->getSessionValue() != "") {
			$this->pid->CurrentValue = $this->pid->getSessionValue();
			$this->pid->ViewValue = $this->pid->CurrentValue;
			$this->pid->ViewValue = FormatNumber($this->pid->ViewValue, 0, -2, -2, -2);
			$this->pid->ViewCustomAttributes = "";
		} else {
			$this->pid->EditValue = $this->pid->CurrentValue;
			$this->pid->PlaceHolder = RemoveHtml($this->pid->caption());
		}

		// datetime
		// by
		// month

		$this->month->EditAttrs["class"] = "form-control";
		$this->month->EditCustomAttributes = "";
		$this->month->EditValue = FormatDateTime($this->month->CurrentValue, 8);
		$this->month->PlaceHolder = RemoveHtml($this->month->caption());

		// pegawai
		$this->pegawai->EditAttrs["class"] = "form-control";
		$this->pegawai->EditCustomAttributes = "";

		// jenjang_id
		$this->jenjang_id->EditAttrs["class"] = "form-control";
		$this->jenjang_id->EditCustomAttributes = "";
		$this->jenjang_id->EditValue = $this->jenjang_id->CurrentValue;
		$this->jenjang_id->PlaceHolder = RemoveHtml($this->jenjang_id->caption());

		// jabatan_id
		$this->jabatan_id->EditAttrs["class"] = "form-control";
		$this->jabatan_id->EditCustomAttributes = "";
		$this->jabatan_id->EditValue = $this->jabatan_id->CurrentValue;
		$this->jabatan_id->PlaceHolder = RemoveHtml($this->jabatan_id->caption());

		// lama_kerja
		$this->lama_kerja->EditAttrs["class"] = "form-control";
		$this->lama_kerja->EditCustomAttributes = "";
		$this->lama_kerja->EditValue = $this->lama_kerja->CurrentValue;
		$this->lama_kerja->PlaceHolder = RemoveHtml($this->lama_kerja->caption());

		// type
		$this->type->EditAttrs["class"] = "form-control";
		$this->type->EditCustomAttributes = "";
		$this->type->EditValue = $this->type->CurrentValue;
		$this->type->PlaceHolder = RemoveHtml($this->type->caption());

		// jenis_guru
		$this->jenis_guru->EditAttrs["class"] = "form-control";
		$this->jenis_guru->EditCustomAttributes = "";
		$this->jenis_guru->EditValue = $this->jenis_guru->CurrentValue;
		$this->jenis_guru->PlaceHolder = RemoveHtml($this->jenis_guru->caption());

		// tambahan
		$this->tambahan->EditAttrs["class"] = "form-control";
		$this->tambahan->EditCustomAttributes = "";
		$this->tambahan->EditValue = $this->tambahan->CurrentValue;
		$this->tambahan->PlaceHolder = RemoveHtml($this->tambahan->caption());

		// periode
		$this->periode->EditAttrs["class"] = "form-control";
		$this->periode->EditCustomAttributes = "";
		$this->periode->EditValue = $this->periode->CurrentValue;
		$this->periode->PlaceHolder = RemoveHtml($this->periode->caption());

		// tunjangan_periode
		$this->tunjangan_periode->EditAttrs["class"] = "form-control";
		$this->tunjangan_periode->EditCustomAttributes = "";
		$this->tunjangan_periode->EditValue = $this->tunjangan_periode->CurrentValue;
		$this->tunjangan_periode->PlaceHolder = RemoveHtml($this->tunjangan_periode->caption());

		// kehadiran
		$this->kehadiran->EditAttrs["class"] = "form-control";
		$this->kehadiran->EditCustomAttributes = "";
		$this->kehadiran->EditValue = $this->kehadiran->CurrentValue;
		$this->kehadiran->PlaceHolder = RemoveHtml($this->kehadiran->caption());

		// value_kehadiran
		$this->value_kehadiran->EditAttrs["class"] = "form-control";
		$this->value_kehadiran->EditCustomAttributes = "";
		$this->value_kehadiran->EditValue = $this->value_kehadiran->CurrentValue;
		$this->value_kehadiran->PlaceHolder = RemoveHtml($this->value_kehadiran->caption());

		// lembur
		$this->lembur->EditAttrs["class"] = "form-control";
		$this->lembur->EditCustomAttributes = "";
		$this->lembur->EditValue = $this->lembur->CurrentValue;
		$this->lembur->PlaceHolder = RemoveHtml($this->lembur->caption());

		// value_lembur
		$this->value_lembur->EditAttrs["class"] = "form-control";
		$this->value_lembur->EditCustomAttributes = "";
		$this->value_lembur->EditValue = $this->value_lembur->CurrentValue;
		$this->value_lembur->PlaceHolder = RemoveHtml($this->value_lembur->caption());

		// jp
		$this->jp->EditAttrs["class"] = "form-control";
		$this->jp->EditCustomAttributes = "";
		$this->jp->EditValue = $this->jp->CurrentValue;
		$this->jp->PlaceHolder = RemoveHtml($this->jp->caption());

		// gapok
		$this->gapok->EditAttrs["class"] = "form-control";
		$this->gapok->EditCustomAttributes = "";
		$this->gapok->EditValue = $this->gapok->CurrentValue;
		$this->gapok->PlaceHolder = RemoveHtml($this->gapok->caption());

		// total_gapok
		$this->total_gapok->EditAttrs["class"] = "form-control";
		$this->total_gapok->EditCustomAttributes = "";
		$this->total_gapok->EditValue = $this->total_gapok->CurrentValue;
		$this->total_gapok->PlaceHolder = RemoveHtml($this->total_gapok->caption());

		// value_reward
		$this->value_reward->EditAttrs["class"] = "form-control";
		$this->value_reward->EditCustomAttributes = "";
		$this->value_reward->EditValue = $this->value_reward->CurrentValue;
		$this->value_reward->PlaceHolder = RemoveHtml($this->value_reward->caption());

		// value_inval
		$this->value_inval->EditAttrs["class"] = "form-control";
		$this->value_inval->EditCustomAttributes = "";
		$this->value_inval->EditValue = $this->value_inval->CurrentValue;
		$this->value_inval->PlaceHolder = RemoveHtml($this->value_inval->caption());

		// piket_count
		$this->piket_count->EditAttrs["class"] = "form-control";
		$this->piket_count->EditCustomAttributes = "";
		$this->piket_count->EditValue = $this->piket_count->CurrentValue;
		$this->piket_count->PlaceHolder = RemoveHtml($this->piket_count->caption());

		// value_piket
		$this->value_piket->EditAttrs["class"] = "form-control";
		$this->value_piket->EditCustomAttributes = "";
		$this->value_piket->EditValue = $this->value_piket->CurrentValue;
		$this->value_piket->PlaceHolder = RemoveHtml($this->value_piket->caption());

		// tugastambahan
		$this->tugastambahan->EditAttrs["class"] = "form-control";
		$this->tugastambahan->EditCustomAttributes = "";
		$this->tugastambahan->EditValue = $this->tugastambahan->CurrentValue;
		$this->tugastambahan->PlaceHolder = RemoveHtml($this->tugastambahan->caption());

		// tj_jabatan
		$this->tj_jabatan->EditAttrs["class"] = "form-control";
		$this->tj_jabatan->EditCustomAttributes = "";
		$this->tj_jabatan->EditValue = $this->tj_jabatan->CurrentValue;
		$this->tj_jabatan->PlaceHolder = RemoveHtml($this->tj_jabatan->caption());

		// sub_total
		$this->sub_total->EditAttrs["class"] = "form-control";
		$this->sub_total->EditCustomAttributes = "";
		$this->sub_total->EditValue = $this->sub_total->CurrentValue;
		$this->sub_total->PlaceHolder = RemoveHtml($this->sub_total->caption());

		// potongan
		$this->potongan->EditAttrs["class"] = "form-control";
		$this->potongan->EditCustomAttributes = "";
		$this->potongan->EditValue = $this->potongan->CurrentValue;
		$this->potongan->PlaceHolder = RemoveHtml($this->potongan->caption());

		// penyesuaian
		$this->penyesuaian->EditAttrs["class"] = "form-control";
		$this->penyesuaian->EditCustomAttributes = "";
		$this->penyesuaian->EditValue = $this->penyesuaian->CurrentValue;
		$this->penyesuaian->PlaceHolder = RemoveHtml($this->penyesuaian->caption());

		// total
		$this->total->EditAttrs["class"] = "form-control";
		$this->total->EditCustomAttributes = "";
		$this->total->EditValue = $this->total->CurrentValue;
		$this->total->PlaceHolder = RemoveHtml($this->total->caption());

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
					$doc->exportCaption($this->datetime);
					$doc->exportCaption($this->by);
					$doc->exportCaption($this->month);
					$doc->exportCaption($this->pegawai);
					$doc->exportCaption($this->jenjang_id);
					$doc->exportCaption($this->jabatan_id);
					$doc->exportCaption($this->lama_kerja);
					$doc->exportCaption($this->type);
					$doc->exportCaption($this->jenis_guru);
					$doc->exportCaption($this->tambahan);
					$doc->exportCaption($this->periode);
					$doc->exportCaption($this->tunjangan_periode);
					$doc->exportCaption($this->kehadiran);
					$doc->exportCaption($this->value_kehadiran);
					$doc->exportCaption($this->lembur);
					$doc->exportCaption($this->value_lembur);
					$doc->exportCaption($this->jp);
					$doc->exportCaption($this->gapok);
					$doc->exportCaption($this->total_gapok);
					$doc->exportCaption($this->value_reward);
					$doc->exportCaption($this->value_inval);
					$doc->exportCaption($this->piket_count);
					$doc->exportCaption($this->value_piket);
					$doc->exportCaption($this->tugastambahan);
					$doc->exportCaption($this->tj_jabatan);
					$doc->exportCaption($this->sub_total);
					$doc->exportCaption($this->potongan);
					$doc->exportCaption($this->penyesuaian);
					$doc->exportCaption($this->total);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->pid);
					$doc->exportCaption($this->datetime);
					$doc->exportCaption($this->by);
					$doc->exportCaption($this->month);
					$doc->exportCaption($this->pegawai);
					$doc->exportCaption($this->jenjang_id);
					$doc->exportCaption($this->jabatan_id);
					$doc->exportCaption($this->lama_kerja);
					$doc->exportCaption($this->type);
					$doc->exportCaption($this->jenis_guru);
					$doc->exportCaption($this->tambahan);
					$doc->exportCaption($this->periode);
					$doc->exportCaption($this->tunjangan_periode);
					$doc->exportCaption($this->kehadiran);
					$doc->exportCaption($this->value_kehadiran);
					$doc->exportCaption($this->lembur);
					$doc->exportCaption($this->value_lembur);
					$doc->exportCaption($this->jp);
					$doc->exportCaption($this->gapok);
					$doc->exportCaption($this->total_gapok);
					$doc->exportCaption($this->value_reward);
					$doc->exportCaption($this->value_inval);
					$doc->exportCaption($this->piket_count);
					$doc->exportCaption($this->value_piket);
					$doc->exportCaption($this->tugastambahan);
					$doc->exportCaption($this->tj_jabatan);
					$doc->exportCaption($this->sub_total);
					$doc->exportCaption($this->potongan);
					$doc->exportCaption($this->penyesuaian);
					$doc->exportCaption($this->total);
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
						$doc->exportField($this->datetime);
						$doc->exportField($this->by);
						$doc->exportField($this->month);
						$doc->exportField($this->pegawai);
						$doc->exportField($this->jenjang_id);
						$doc->exportField($this->jabatan_id);
						$doc->exportField($this->lama_kerja);
						$doc->exportField($this->type);
						$doc->exportField($this->jenis_guru);
						$doc->exportField($this->tambahan);
						$doc->exportField($this->periode);
						$doc->exportField($this->tunjangan_periode);
						$doc->exportField($this->kehadiran);
						$doc->exportField($this->value_kehadiran);
						$doc->exportField($this->lembur);
						$doc->exportField($this->value_lembur);
						$doc->exportField($this->jp);
						$doc->exportField($this->gapok);
						$doc->exportField($this->total_gapok);
						$doc->exportField($this->value_reward);
						$doc->exportField($this->value_inval);
						$doc->exportField($this->piket_count);
						$doc->exportField($this->value_piket);
						$doc->exportField($this->tugastambahan);
						$doc->exportField($this->tj_jabatan);
						$doc->exportField($this->sub_total);
						$doc->exportField($this->potongan);
						$doc->exportField($this->penyesuaian);
						$doc->exportField($this->total);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->pid);
						$doc->exportField($this->datetime);
						$doc->exportField($this->by);
						$doc->exportField($this->month);
						$doc->exportField($this->pegawai);
						$doc->exportField($this->jenjang_id);
						$doc->exportField($this->jabatan_id);
						$doc->exportField($this->lama_kerja);
						$doc->exportField($this->type);
						$doc->exportField($this->jenis_guru);
						$doc->exportField($this->tambahan);
						$doc->exportField($this->periode);
						$doc->exportField($this->tunjangan_periode);
						$doc->exportField($this->kehadiran);
						$doc->exportField($this->value_kehadiran);
						$doc->exportField($this->lembur);
						$doc->exportField($this->value_lembur);
						$doc->exportField($this->jp);
						$doc->exportField($this->gapok);
						$doc->exportField($this->total_gapok);
						$doc->exportField($this->value_reward);
						$doc->exportField($this->value_inval);
						$doc->exportField($this->piket_count);
						$doc->exportField($this->value_piket);
						$doc->exportField($this->tugastambahan);
						$doc->exportField($this->tj_jabatan);
						$doc->exportField($this->sub_total);
						$doc->exportField($this->potongan);
						$doc->exportField($this->penyesuaian);
						$doc->exportField($this->total);
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

		// No binary fields
		return FALSE;
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here
		if(CurrentUserLevel() != '-1'){
			$nip = CurrentUserInfo("nip");
			if($nip != '' OR $nip != FALSE) {
				AddFilter($filter, "pegawai = $nip");
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

			$querypotongan = ExecuteRow("SELECT * FROM potongan_sma ORDER BY id DESC");
											   if ($this->jenis_guru->CurrentValue == '1'){

												   // 1 untuk jabatan HRD
												   //$querypotongan = ExecuteRow("SELECT * FROM potongan INNER JOIN gaji ON potongan.nama = gaji.pegawai  WHERE potongan.month = gaji.month");
												   //$gapo = ExecuteRow("SELECT * FROM jabatan JOIN gajitunjangan ON jabatan.id = gajitunjangan.pidjabatan where gajitunjangan.pidjabatan='1'");

												$piket= ExecuteRow("select * from m_piket where jenjang='4' and jenis_sertif ='1'");
												$kehadiran= ExecuteRow("Select * from m_kehadiran where jenjang='4' AND jenis_jabatan='1' AND sertif='1'");	
												$query2 = ExecuteRow("SELECT * FROM jabatan JOIN gajitunjangan ON jabatan.id = gajitunjangan.pidjabatan where gajitunjangan.pidjabatan='9'");
												if ($this->tambahan->CurrentValue == '2'){
													$tunjanagan_tambahan=ExecuteRow("select * from tunjangan_tambahan where jenjang='1' AND kualifikasi='2'");
												}else if ($this->tambahan->CurrentValue == '3'){
													$tunjanagan_tambahan=ExecuteRow("select * from tunjangan_tambahan where jenjang='1' AND kualifikasi='3'");		
												}else if ($this->tambahan->CurrentValue == '4'){
													$tunjanagan_tambahan=ExecuteRow("select * from tunjangan_tambahan where jenjang='1' AND kualifikasi='4'");	
												}else if ($this->tambahan->CurrentValue == '5'){
													$tunjanagan_tambahan=ExecuteRow("select * from tunjangan_tambahan where jenjang='1' AND kualifikasi='5'");	
												}else if ($this->tambahan->CurrentValue == '6'){
													$tunjanagan_tambahan=ExecuteRow("select * from tunjangan_tambahan where jenjang='1' AND kualifikasi='6'");
												}
												if($this->jabatan_id->CurrentValue == '5'){
													if ($this->periode->CurrentValue == '1'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='1'");
													}else if ($this->periode->CurrentValue == '2'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='2'");		
													}else if ($this->periode->CurrentValue == '3'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='3'");	
													}else if ($this->periode->CurrentValue == '4'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='4'");	
													}else if ($this->periode->CurrentValue == '5'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='5'");
													}else if ($this->periode->CurrentValue == '6'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='6'");
													}else if ($this->periode->CurrentValue == '7'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='7'");
													}else if ($this->periode->CurrentValue == '8'){
														$tunjanagan_tambahan=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='8'");
													}else if ($this->periode->CurrentValue == '9'){
														$tunjanagan_tambahan=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='9'");
													}else if ($this->periode->CurrentValue == '10'){
														$tunjanagan_tambahan=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='10'");
													}
													}else if($this->jabatan_id->CurrentValue == '15'){
														if ($this->periode->CurrentValue == '1'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='1'");
													}else if ($this->periode->CurrentValue == '2'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='2'");		
													}else if ($this->periode->CurrentValue == '3'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='3'");	
													}else if ($this->periode->CurrentValue == '4'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='4'");	
													}else if ($this->periode->CurrentValue == '5'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='5'");
													}else if ($this->periode->CurrentValue == '6'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='6'");
													}else if ($this->periode->CurrentValue == '7'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='7'");
													}else if ($this->periode->CurrentValue == '8'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='8'");
													}else if ($this->periode->CurrentValue == '9'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='9'");
													}else if ($this->periode->CurrentValue == '10'){
														$tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='10'");
													}   
													}  
														if ($this->lama_kerja->CurrentValue >= '0' || $this->periode->CurrentValue <= '1'){
														$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE jenjang_id='1' AND value='1500'");
														}else if ($this->lama_kerja->CurrentValue >= '2' || $this->periode->CurrentValue <= '4'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE jenjang_id='1' AND value='2500'");		
														}else if ($this->lama_kerja->CurrentValue >= '5' || $this->periode->CurrentValue <= '7'){
														$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE jenjang_id='1' AND value='3000'");	
														}else if ($this->lama_kerja->CurrentValue >= '8' || $this->periode->CurrentValue <= '10'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE jenjang_id='1' AND value='3500'");	
														}else if ($this->lama_kerja->CurrentValue >= '11' || $this->periode->CurrentValue <= '13'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='4000'");
														}else if ($this->lama_kerja->CurrentValue >= '14' || $this->periode->CurrentValue <= '16'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='4500'");
														}else if ($this->lama_kerja->CurrentValue >= '17' || $this->periode->CurrentValue <= '19'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='5000'");
														}else if ($this->lama_kerja->CurrentValue >= '20' || $this->periode->CurrentValue <= '22'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='5500'");
														}else if ($this->lama_kerja->CurrentValue >= '23' || $this->periode->CurrentValue <= '25'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='6000'");
														}else if ($this->lama_kerja->CurrentValue >= '26' || $this->periode->CurrentValue <= '28'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='6500'");
														}else if ($this->lama_kerja->CurrentValue >= '29' || $this->periode->CurrentValue <= '31'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='7000'");
														}else if ($this->lama_kerja->CurrentValue >= '32' || $this->periode->CurrentValue <= '34'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE jenjang_id='1' AND value='7500'");
														}else if ($this->lama_kerja->CurrentValue >= '35' || $this->periode->CurrentValue <= '37'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='8000'");
														}else if ($this->lama_kerja->CurrentValue >= '38' || $this->periode->CurrentValue <= '40'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='8500'");
														}else if ($this->lama_kerja->CurrentValue >= '41' || $this->periode->CurrentValue <= '43'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='9000'");
														}else if ($this->lama_kerja->CurrentValue >= '44' || $this->periode->CurrentValue <= '46'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='9500'");
														}else if ($this->lama_kerja->CurrentValue >= '47' || $this->periode->CurrentValue <= '49'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='10000'");
														}else if ($this->lama_kerja->CurrentValue == '50'){
															$gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='10000'");
														}
												$rsnew["gapok"] = $gaji_pokok["value"];													
												$rsnew["tunjangan_periode"] = $tunjangan_berkala["value"];
												$rsnew["value_lembur"] = $query2["lembur"];
												$rsnew["tugastambahan"] = $tunjanagan_tambahan["value"];
												   $rsnew["value_inval"] = $query2["inval"];
												   $rsnew["value_reward"] = $query2["reward"];
												   $rsnew["value_piket"] = $piket["value"];
												   $rsnew["value_kehadiran"] = $kehadiran["value"];
												   $rsnew["tj_jabatan"] = $query2["tj_jabatan"];
												   $rsnew["total_gapok"] = $rsnew["jp"] * $rsnew["gapok"];
													$rsnew["sub_total"] = $rsnew["total_gapok"] + $rsnew["tugastambahan"]+($rsnew["kehadiran"] * $rsnew["value_kehadiran"])+($rsnew["lembur"] * $query2["lembur"]) + ($rsnew["piket_count"] * $piket["value"]) + $query2["inval"] + $query2["tunjangan_jabatan"] + $query2["jam_lebih"] + $query2["reward"] ;
												   $rsnew["potongan"] = $querypotongan["totalpotongan"];
												   $rsnew["total"] = $rsnew["sub_total"] - $rsnew["potongan"] + $rsnew["penyesuaian"];
											   }else{

												   //$querypotongan = ExecuteRow("SELECT * FROM potongan INNER JOIN gaji ON potongan.nama = gaji.pegawai  WHERE potongan.month = gaji.month");
												   // 2 untuk jabatan HRD    

												   $piket= ExecuteRow("select * from m_piket where jenjang='4' and jenis_sertif ='2'");	
												   $kehadiran= ExecuteRow("Select * from m_kehadiran where jenjang='4' AND jenis_jabatan='1' AND sertif='2'");	
												   $query2 = ExecuteRow("SELECT * FROM jabatan JOIN gajitunjangan ON jabatan.id = gajitunjangan.pidjabatan where gajitunjangan.pidjabatan='9'");
												   if ($this->tambahan->CurrentValue == '2'){
													   $tunjanagan_tambahan=ExecuteRow("select * from tunjangan_tambahan where jenjang='1' AND kualifikasi='2'");
												   }else if ($this->tambahan->CurrentValue == '3'){
													   $tunjanagan_tambahan=ExecuteRow("select * from tunjangan_tambahan where jenjang='1' AND kualifikasi='3'");		
												   }else if ($this->tambahan->CurrentValue == '4'){
													   $tunjanagan_tambahan=ExecuteRow("select * from tunjangan_tambahan where jenjang='1' AND kualifikasi='4'");	
												   }else if ($this->tambahan->CurrentValue == '5'){
													   $tunjanagan_tambahan=ExecuteRow("select * from tunjangan_tambahan where jenjang='1' AND kualifikasi='5'");	
												   }else if ($this->tambahan->CurrentValue == '6'){
													   $tunjanagan_tambahan=ExecuteRow("select * from tunjangan_tambahan where jenjang='1' AND kualifikasi='6'");
												   }
												   if($this->jabatan_id->CurrentValue == '5'){
													   if ($this->periode->CurrentValue == '1'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='1'");
													   }else if ($this->periode->CurrentValue == '2'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='2'");		
													   }else if ($this->periode->CurrentValue == '3'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='3'");	
													   }else if ($this->periode->CurrentValue == '4'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='4'");	
													   }else if ($this->periode->CurrentValue == '5'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='5'");
													   }else if ($this->periode->CurrentValue == '6'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='6'");
													   }else if ($this->periode->CurrentValue == '7'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='7'");
													   }else if ($this->periode->CurrentValue == '8'){
														   $tunjanagan_tambahan=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='8'");
													   }else if ($this->periode->CurrentValue == '9'){
														   $tunjanagan_tambahan=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='9'");
													   }else if ($this->periode->CurrentValue == '10'){
														   $tunjanagan_tambahan=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='5' AND lama='10'");
													   }
													   }else if($this->jabatan_id->CurrentValue == '15'){
														   if ($this->periode->CurrentValue == '1'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='1'");
													   }else if ($this->periode->CurrentValue == '2'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='2'");		
													   }else if ($this->periode->CurrentValue == '3'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='3'");	
													   }else if ($this->periode->CurrentValue == '4'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='4'");	
													   }else if ($this->periode->CurrentValue == '5'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='5'");
													   }else if ($this->periode->CurrentValue == '6'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='6'");
													   }else if ($this->periode->CurrentValue == '7'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='7'");
													   }else if ($this->periode->CurrentValue == '8'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='8'");
													   }else if ($this->periode->CurrentValue == '9'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='9'");
													   }else if ($this->periode->CurrentValue == '10'){
														   $tunjangan_berkala=ExecuteRow("SELECT * FROM tunjangan_berkala WHERE jenjang='1' AND kualifikasi ='15' AND lama='10'");
													   }   
													   }  
														   if ($this->lama_kerja->CurrentValue >= '0' || $this->periode->CurrentValue <= '1'){
														   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE jenjang_id='1' AND value='1500'");
														   }else if ($this->lama_kerja->CurrentValue >= '2' || $this->periode->CurrentValue <= '4'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE jenjang_id='1' AND value='2500'");		
														   }else if ($this->lama_kerja->CurrentValue >= '5' || $this->periode->CurrentValue <= '7'){
														   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE jenjang_id='1' AND value='3000'");	
														   }else if ($this->lama_kerja->CurrentValue >= '8' || $this->periode->CurrentValue <= '10'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE jenjang_id='1' AND value='3500'");	
														   }else if ($this->lama_kerja->CurrentValue >= '11' || $this->periode->CurrentValue <= '13'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='4000'");
														   }else if ($this->lama_kerja->CurrentValue >= '14' || $this->periode->CurrentValue <= '16'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='4500'");
														   }else if ($this->lama_kerja->CurrentValue >= '17' || $this->periode->CurrentValue <= '19'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='5000'");
														   }else if ($this->lama_kerja->CurrentValue >= '20' || $this->periode->CurrentValue <= '22'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='5500'");
														   }else if ($this->lama_kerja->CurrentValue >= '23' || $this->periode->CurrentValue <= '25'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='6000'");
														   }else if ($this->lama_kerja->CurrentValue >= '26' || $this->periode->CurrentValue <= '28'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='6500'");
														   }else if ($this->lama_kerja->CurrentValue >= '29' || $this->periode->CurrentValue <= '31'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='7000'");
														   }else if ($this->lama_kerja->CurrentValue >= '32' || $this->periode->CurrentValue <= '34'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE jenjang_id='1' AND value='7500'");
														   }else if ($this->lama_kerja->CurrentValue >= '35' || $this->periode->CurrentValue <= '37'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='8000'");
														   }else if ($this->lama_kerja->CurrentValue >= '38' || $this->periode->CurrentValue <= '40'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='8500'");
														   }else if ($this->lama_kerja->CurrentValue >= '41' || $this->periode->CurrentValue <= '43'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='9000'");
														   }else if ($this->lama_kerja->CurrentValue >= '44' || $this->periode->CurrentValue <= '46'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='9500'");
														   }else if ($this->lama_kerja->CurrentValue >= '47' || $this->periode->CurrentValue <= '49'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='10000'");
														   }else if ($this->lama_kerja->CurrentValue == '50'){
															   $gaji_pokok=ExecuteRow("SELECT * FROM gaji_pokok WHERE value='10000'");
														   }
												   $rsnew["gapok"] = $gaji_pokok["value"];													
												   $rsnew["tunjangan_periode"] = $tunjangan_berkala["value"];
												   $rsnew["value_lembur"] = $query2["lembur"];
												   $rsnew["tugastambahan"] = $tunjanagan_tambahan["value"];
													  $rsnew["value_inval"] = $query2["inval"];
													  $rsnew["value_reward"] = $query2["reward"];
													  $rsnew["value_piket"] = $piket["value"];
													  $rsnew["value_kehadiran"] = $kehadiran["value"];
													  $rsnew["tj_jabatan"] = $query2["tj_jabatan"];
													  $rsnew["total_gapok"] = $rsnew["jp"] * $rsnew["gapok"];
													$rsnew["sub_total"] = $rsnew["total_gapok"] + $rsnew["tugastambahan"]+($rsnew["kehadiran"] * $rsnew["value_kehadiran"])+($rsnew["lembur"] * $query2["lembur"]) + ($rsnew["piket_count"] * $piket["value"]) + $query2["inval"] + $query2["tunjangan_jabatan"] + $query2["jam_lebih"] + $query2["reward"] ;
													  $rsnew["potongan"] = $querypotongan["totalpotongan"];
													  $rsnew["total"] = $rsnew["sub_total"] - $rsnew["potongan"] + $rsnew["penyesuaian"];
											   }
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
			if (CurrentPageID() == "add") {

				//$("#r_value_lembur").hide();
				//$("#r_value_lembur").hide();

				$this->value_lembur->Visible = FALSE;
				$this->value_piket->Visible = FALSE;
				$this->tj_jabatan->Visible = FALSE;
				$this->total->Visible = FALSE;
				$this->gapok->Visible = FALSE;
				$this->sub_total->Visible = FALSE;
				$this->potongan->Visible = FALSE;
				$this->value_inval->Visible = FALSE;
				$this->jabatan_id->ReadOnly = true;
				$this->jenjang_id->ReadOnly = true;
				$this->type->ReadOnly = true;
				$this->jenis_guru->ReadOnly = true;
				$this->tambahan->ReadOnly = true;
				$this->lama_kerja->ReadOnly = true;
				$this->periode->ReadOnly = true;
				$this->gapok->ReadOnly = true;
				$this->value_kehadiran->Visible = false;
				$this->tugastambahan->Visible = false;
				$this->tunjangan_periode->Visible = false;
				$this->total_gapok->Visible = false;
				$id_user = ExecuteRows("SELECT * FROM pegawai where jenjang_id ='3' AND `type`= '1'");
					foreach($id_user as $row){

					//$this->pegawai->CurrentValue ='';
					$this->pegawai->CurrentValue = $row['nip'];
					$this->jabatan_id->CurrentValue = $row['jabatan'];
					$this->jenjang_id->CurrentValue = $row['jenjang_id'];
					$this->type->CurrentValue = $row['type'];
					$this->jenis_guru->CurrentValue = $row['sertif'];
					$this->tambahan->CurrentValue = $row['tambahan'];
					$this->periode->CurrentValue = $row['periode_jabatan'];
					$this->lama_kerja->CurrentValue = $row['lama_kerja'];
				}
			}
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