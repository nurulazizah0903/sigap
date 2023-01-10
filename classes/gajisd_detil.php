<?php namespace PHPMaker2020\sigap; ?>
<?php

/**
 * Table class for gajisd_detil
 */
class gajisd_detil extends DbTable
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

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'gajisd_detil';
		$this->TableName = 'gajisd_detil';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`gajisd_detil`";
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
		$this->id = new DbField('gajisd_detil', 'gajisd_detil', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// pid
		$this->pid = new DbField('gajisd_detil', 'gajisd_detil', 'x_pid', 'pid', '`pid`', '`pid`', 3, 11, -1, FALSE, '`pid`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pid->IsForeignKey = TRUE; // Foreign key field
		$this->pid->Sortable = TRUE; // Allow sort
		$this->pid->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pid'] = &$this->pid;

		// pegawai_id
		$this->pegawai_id = new DbField('gajisd_detil', 'gajisd_detil', 'x_pegawai_id', 'pegawai_id', '`pegawai_id`', '`pegawai_id`', 200, 50, -1, FALSE, '`pegawai_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pegawai_id->Sortable = TRUE; // Allow sort
		$this->pegawai_id->Lookup = new Lookup('pegawai_id', 'pegawai', FALSE, 'nip', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->fields['pegawai_id'] = &$this->pegawai_id;

		// jabatan_id
		$this->jabatan_id = new DbField('gajisd_detil', 'gajisd_detil', 'x_jabatan_id', 'jabatan_id', '`jabatan_id`', '`jabatan_id`', 3, 11, -1, FALSE, '`jabatan_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jabatan_id->Sortable = TRUE; // Allow sort
		$this->jabatan_id->Lookup = new Lookup('jabatan_id', 'jabatan', FALSE, 'id', ["nama_jabatan","","",""], [], [], [], [], [], [], '', '');
		$this->jabatan_id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jabatan_id'] = &$this->jabatan_id;

		// masakerja
		$this->masakerja = new DbField('gajisd_detil', 'gajisd_detil', 'x_masakerja', 'masakerja', '`masakerja`', '`masakerja`', 2, 6, -1, FALSE, '`masakerja`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->masakerja->Sortable = TRUE; // Allow sort
		$this->masakerja->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['masakerja'] = &$this->masakerja;

		// jumngajar
		$this->jumngajar = new DbField('gajisd_detil', 'gajisd_detil', 'x_jumngajar', 'jumngajar', '`jumngajar`', '`jumngajar`', 2, 6, -1, FALSE, '`jumngajar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumngajar->Sortable = TRUE; // Allow sort
		$this->jumngajar->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jumngajar'] = &$this->jumngajar;

		// ijin
		$this->ijin = new DbField('gajisd_detil', 'gajisd_detil', 'x_ijin', 'ijin', '`ijin`', '`ijin`', 2, 6, -1, FALSE, '`ijin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ijin->Sortable = TRUE; // Allow sort
		$this->ijin->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ijin'] = &$this->ijin;

		// tunjangan_wkosis
		$this->tunjangan_wkosis = new DbField('gajisd_detil', 'gajisd_detil', 'x_tunjangan_wkosis', 'tunjangan_wkosis', '`tunjangan_wkosis`', '`tunjangan_wkosis`', 3, 11, -1, FALSE, '`tunjangan_wkosis`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tunjangan_wkosis->Sortable = TRUE; // Allow sort
		$this->tunjangan_wkosis->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tunjangan_wkosis'] = &$this->tunjangan_wkosis;

		// nominal_baku
		$this->nominal_baku = new DbField('gajisd_detil', 'gajisd_detil', 'x_nominal_baku', 'nominal_baku', '`nominal_baku`', '`nominal_baku`', 3, 11, -1, FALSE, '`nominal_baku`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nominal_baku->Sortable = TRUE; // Allow sort
		$this->nominal_baku->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['nominal_baku'] = &$this->nominal_baku;

		// baku
		$this->baku = new DbField('gajisd_detil', 'gajisd_detil', 'x_baku', 'baku', '`baku`', '`baku`', 3, 11, -1, FALSE, '`baku`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->baku->Sortable = TRUE; // Allow sort
		$this->baku->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['baku'] = &$this->baku;

		// kehadiran
		$this->kehadiran = new DbField('gajisd_detil', 'gajisd_detil', 'x_kehadiran', 'kehadiran', '`kehadiran`', '`kehadiran`', 3, 11, -1, FALSE, '`kehadiran`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kehadiran->Sortable = TRUE; // Allow sort
		$this->kehadiran->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['kehadiran'] = &$this->kehadiran;

		// prestasi
		$this->prestasi = new DbField('gajisd_detil', 'gajisd_detil', 'x_prestasi', 'prestasi', '`prestasi`', '`prestasi`', 3, 11, -1, FALSE, '`prestasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->prestasi->Sortable = TRUE; // Allow sort
		$this->prestasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['prestasi'] = &$this->prestasi;

		// jumlahgaji
		$this->jumlahgaji = new DbField('gajisd_detil', 'gajisd_detil', 'x_jumlahgaji', 'jumlahgaji', '`jumlahgaji`', '`jumlahgaji`', 3, 11, -1, FALSE, '`jumlahgaji`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumlahgaji->Sortable = TRUE; // Allow sort
		$this->jumlahgaji->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jumlahgaji'] = &$this->jumlahgaji;

		// jumgajitotal
		$this->jumgajitotal = new DbField('gajisd_detil', 'gajisd_detil', 'x_jumgajitotal', 'jumgajitotal', '`jumgajitotal`', '`jumgajitotal`', 3, 11, -1, FALSE, '`jumgajitotal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumgajitotal->Sortable = TRUE; // Allow sort
		$this->jumgajitotal->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jumgajitotal'] = &$this->jumgajitotal;

		// potongan1
		$this->potongan1 = new DbField('gajisd_detil', 'gajisd_detil', 'x_potongan1', 'potongan1', '`potongan1`', '`potongan1`', 3, 11, -1, FALSE, '`potongan1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->potongan1->Sortable = TRUE; // Allow sort
		$this->potongan1->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['potongan1'] = &$this->potongan1;

		// potongan2
		$this->potongan2 = new DbField('gajisd_detil', 'gajisd_detil', 'x_potongan2', 'potongan2', '`potongan2`', '`potongan2`', 3, 11, -1, FALSE, '`potongan2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->potongan2->Sortable = TRUE; // Allow sort
		$this->potongan2->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['potongan2'] = &$this->potongan2;

		// jumlahterima
		$this->jumlahterima = new DbField('gajisd_detil', 'gajisd_detil', 'x_jumlahterima', 'jumlahterima', '`jumlahterima`', '`jumlahterima`', 3, 11, -1, FALSE, '`jumlahterima`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumlahterima->Sortable = TRUE; // Allow sort
		$this->jumlahterima->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jumlahterima'] = &$this->jumlahterima;
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
		if ($this->getCurrentMasterTable() == "gajisd") {
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
		if ($this->getCurrentMasterTable() == "gajisd") {
			if ($this->pid->getSessionValue() != "")
				$detailFilter .= "`pid`=" . QuotedValue($this->pid->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_gajisd()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_gajisd()
	{
		return "`pid`=@pid@";
	}

	// Table level SQL
	public function getSqlFrom() // From
	{
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`gajisd_detil`";
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
			return "gajisd_detillist.php";
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
		if ($pageName == "gajisd_detilview.php")
			return $Language->phrase("View");
		elseif ($pageName == "gajisd_detiledit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "gajisd_detiladd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "gajisd_detillist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("gajisd_detilview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("gajisd_detilview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "gajisd_detiladd.php?" . $this->getUrlParm($parm);
		else
			$url = "gajisd_detiladd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("gajisd_detiledit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("gajisd_detiladd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("gajisd_detildelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "gajisd" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
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
		$this->pegawai_id->setDbValue($rs->fields('pegawai_id'));
		$this->jabatan_id->setDbValue($rs->fields('jabatan_id'));
		$this->masakerja->setDbValue($rs->fields('masakerja'));
		$this->jumngajar->setDbValue($rs->fields('jumngajar'));
		$this->ijin->setDbValue($rs->fields('ijin'));
		$this->tunjangan_wkosis->setDbValue($rs->fields('tunjangan_wkosis'));
		$this->nominal_baku->setDbValue($rs->fields('nominal_baku'));
		$this->baku->setDbValue($rs->fields('baku'));
		$this->kehadiran->setDbValue($rs->fields('kehadiran'));
		$this->prestasi->setDbValue($rs->fields('prestasi'));
		$this->jumlahgaji->setDbValue($rs->fields('jumlahgaji'));
		$this->jumgajitotal->setDbValue($rs->fields('jumgajitotal'));
		$this->potongan1->setDbValue($rs->fields('potongan1'));
		$this->potongan2->setDbValue($rs->fields('potongan2'));
		$this->jumlahterima->setDbValue($rs->fields('jumlahterima'));
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
		$this->pid->ViewValue = FormatNumber($this->pid->ViewValue, 0, -2, -2, -2);
		$this->pid->ViewCustomAttributes = "";

		// pegawai_id
		$this->pegawai_id->ViewValue = $this->pegawai_id->CurrentValue;
		$curVal = strval($this->pegawai_id->CurrentValue);
		if ($curVal != "") {
			$this->pegawai_id->ViewValue = $this->pegawai_id->lookupCacheOption($curVal);
			if ($this->pegawai_id->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`nip`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->pegawai_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->pegawai_id->ViewValue = $this->pegawai_id->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->pegawai_id->ViewValue = $this->pegawai_id->CurrentValue;
				}
			}
		} else {
			$this->pegawai_id->ViewValue = NULL;
		}
		$this->pegawai_id->ViewCustomAttributes = "";

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

		// masakerja
		$this->masakerja->ViewValue = $this->masakerja->CurrentValue;
		$this->masakerja->ViewValue = FormatNumber($this->masakerja->ViewValue, 0, -2, -2, -2);
		$this->masakerja->ViewCustomAttributes = "";

		// jumngajar
		$this->jumngajar->ViewValue = $this->jumngajar->CurrentValue;
		$this->jumngajar->ViewValue = FormatNumber($this->jumngajar->ViewValue, 0, -2, -2, -2);
		$this->jumngajar->ViewCustomAttributes = "";

		// ijin
		$this->ijin->ViewValue = $this->ijin->CurrentValue;
		$this->ijin->ViewValue = FormatNumber($this->ijin->ViewValue, 0, -2, -2, -2);
		$this->ijin->ViewCustomAttributes = "";

		// tunjangan_wkosis
		$this->tunjangan_wkosis->ViewValue = $this->tunjangan_wkosis->CurrentValue;
		$this->tunjangan_wkosis->ViewValue = FormatNumber($this->tunjangan_wkosis->ViewValue, 0, -2, -2, -2);
		$this->tunjangan_wkosis->ViewCustomAttributes = "";

		// nominal_baku
		$this->nominal_baku->ViewValue = $this->nominal_baku->CurrentValue;
		$this->nominal_baku->ViewValue = FormatNumber($this->nominal_baku->ViewValue, 0, -2, -2, -2);
		$this->nominal_baku->ViewCustomAttributes = "";

		// baku
		$this->baku->ViewValue = $this->baku->CurrentValue;
		$this->baku->ViewValue = FormatNumber($this->baku->ViewValue, 0, -2, -2, -2);
		$this->baku->ViewCustomAttributes = "";

		// kehadiran
		$this->kehadiran->ViewValue = $this->kehadiran->CurrentValue;
		$this->kehadiran->ViewValue = FormatNumber($this->kehadiran->ViewValue, 0, -2, -2, -2);
		$this->kehadiran->ViewCustomAttributes = "";

		// prestasi
		$this->prestasi->ViewValue = $this->prestasi->CurrentValue;
		$this->prestasi->ViewValue = FormatNumber($this->prestasi->ViewValue, 0, -2, -2, -2);
		$this->prestasi->ViewCustomAttributes = "";

		// jumlahgaji
		$this->jumlahgaji->ViewValue = $this->jumlahgaji->CurrentValue;
		$this->jumlahgaji->ViewValue = FormatNumber($this->jumlahgaji->ViewValue, 0, -2, -2, -2);
		$this->jumlahgaji->ViewCustomAttributes = "";

		// jumgajitotal
		$this->jumgajitotal->ViewValue = $this->jumgajitotal->CurrentValue;
		$this->jumgajitotal->ViewValue = FormatNumber($this->jumgajitotal->ViewValue, 0, -2, -2, -2);
		$this->jumgajitotal->ViewCustomAttributes = "";

		// potongan1
		$this->potongan1->ViewValue = $this->potongan1->CurrentValue;
		$this->potongan1->ViewValue = FormatNumber($this->potongan1->ViewValue, 0, -2, -2, -2);
		$this->potongan1->ViewCustomAttributes = "";

		// potongan2
		$this->potongan2->ViewValue = $this->potongan2->CurrentValue;
		$this->potongan2->ViewValue = FormatNumber($this->potongan2->ViewValue, 0, -2, -2, -2);
		$this->potongan2->ViewCustomAttributes = "";

		// jumlahterima
		$this->jumlahterima->ViewValue = $this->jumlahterima->CurrentValue;
		$this->jumlahterima->ViewValue = FormatNumber($this->jumlahterima->ViewValue, 0, -2, -2, -2);
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

		// pegawai_id
		$this->pegawai_id->EditAttrs["class"] = "form-control";
		$this->pegawai_id->EditCustomAttributes = "";
		if (!$this->pegawai_id->Raw)
			$this->pegawai_id->CurrentValue = HtmlDecode($this->pegawai_id->CurrentValue);
		$this->pegawai_id->EditValue = $this->pegawai_id->CurrentValue;
		$this->pegawai_id->PlaceHolder = RemoveHtml($this->pegawai_id->caption());

		// jabatan_id
		$this->jabatan_id->EditAttrs["class"] = "form-control";
		$this->jabatan_id->EditCustomAttributes = "";
		$this->jabatan_id->EditValue = $this->jabatan_id->CurrentValue;
		$this->jabatan_id->PlaceHolder = RemoveHtml($this->jabatan_id->caption());

		// masakerja
		$this->masakerja->EditAttrs["class"] = "form-control";
		$this->masakerja->EditCustomAttributes = "";
		$this->masakerja->EditValue = $this->masakerja->CurrentValue;
		$this->masakerja->PlaceHolder = RemoveHtml($this->masakerja->caption());

		// jumngajar
		$this->jumngajar->EditAttrs["class"] = "form-control";
		$this->jumngajar->EditCustomAttributes = "";
		$this->jumngajar->EditValue = $this->jumngajar->CurrentValue;
		$this->jumngajar->PlaceHolder = RemoveHtml($this->jumngajar->caption());

		// ijin
		$this->ijin->EditAttrs["class"] = "form-control";
		$this->ijin->EditCustomAttributes = "";
		$this->ijin->EditValue = $this->ijin->CurrentValue;
		$this->ijin->PlaceHolder = RemoveHtml($this->ijin->caption());

		// tunjangan_wkosis
		$this->tunjangan_wkosis->EditAttrs["class"] = "form-control";
		$this->tunjangan_wkosis->EditCustomAttributes = "";
		$this->tunjangan_wkosis->EditValue = $this->tunjangan_wkosis->CurrentValue;
		$this->tunjangan_wkosis->PlaceHolder = RemoveHtml($this->tunjangan_wkosis->caption());

		// nominal_baku
		$this->nominal_baku->EditAttrs["class"] = "form-control";
		$this->nominal_baku->EditCustomAttributes = "";
		$this->nominal_baku->EditValue = $this->nominal_baku->CurrentValue;
		$this->nominal_baku->PlaceHolder = RemoveHtml($this->nominal_baku->caption());

		// baku
		$this->baku->EditAttrs["class"] = "form-control";
		$this->baku->EditCustomAttributes = "";
		$this->baku->EditValue = $this->baku->CurrentValue;
		$this->baku->PlaceHolder = RemoveHtml($this->baku->caption());

		// kehadiran
		$this->kehadiran->EditAttrs["class"] = "form-control";
		$this->kehadiran->EditCustomAttributes = "";
		$this->kehadiran->EditValue = $this->kehadiran->CurrentValue;
		$this->kehadiran->PlaceHolder = RemoveHtml($this->kehadiran->caption());

		// prestasi
		$this->prestasi->EditAttrs["class"] = "form-control";
		$this->prestasi->EditCustomAttributes = "";
		$this->prestasi->EditValue = $this->prestasi->CurrentValue;
		$this->prestasi->PlaceHolder = RemoveHtml($this->prestasi->caption());

		// jumlahgaji
		$this->jumlahgaji->EditAttrs["class"] = "form-control";
		$this->jumlahgaji->EditCustomAttributes = "";
		$this->jumlahgaji->EditValue = $this->jumlahgaji->CurrentValue;
		$this->jumlahgaji->PlaceHolder = RemoveHtml($this->jumlahgaji->caption());

		// jumgajitotal
		$this->jumgajitotal->EditAttrs["class"] = "form-control";
		$this->jumgajitotal->EditCustomAttributes = "";
		$this->jumgajitotal->EditValue = $this->jumgajitotal->CurrentValue;
		$this->jumgajitotal->PlaceHolder = RemoveHtml($this->jumgajitotal->caption());

		// potongan1
		$this->potongan1->EditAttrs["class"] = "form-control";
		$this->potongan1->EditCustomAttributes = "";
		$this->potongan1->EditValue = $this->potongan1->CurrentValue;
		$this->potongan1->PlaceHolder = RemoveHtml($this->potongan1->caption());

		// potongan2
		$this->potongan2->EditAttrs["class"] = "form-control";
		$this->potongan2->EditCustomAttributes = "";
		$this->potongan2->EditValue = $this->potongan2->CurrentValue;
		$this->potongan2->PlaceHolder = RemoveHtml($this->potongan2->caption());

		// jumlahterima
		$this->jumlahterima->EditAttrs["class"] = "form-control";
		$this->jumlahterima->EditCustomAttributes = "";
		$this->jumlahterima->EditValue = $this->jumlahterima->CurrentValue;
		$this->jumlahterima->PlaceHolder = RemoveHtml($this->jumlahterima->caption());

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
		//$rsnew["pegawai_id"] = ExecuteRows("SELECT nip FROM pegawai");

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
		//$rsnew["pegawai_id"] = ExecuteRows("SELECT nip FROM pegawai");  

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
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>);

		if (CurrentPageID() == "add") {

				//$this->Kode_Barang->EditValue = $_SESSION["Kode_Barang"];
				//$test = ExecuteRow("SELECT * FROM pegawai");
		$this->pegawai_id->EditValue = ExecuteScalar("SELECT id FROM pegawai");
        $this->pegawai_id->ReadOnly = TRUE;
        //$this->Nama_Barang->ReadOnly = TRUE;
    }
}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>