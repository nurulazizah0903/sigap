<?php namespace PHPMaker2020\sigap; ?>
<?php

/**
 * Table class for gajitunjangan
 */
class gajitunjangan extends DbTable
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
	public $pidjabatan;
	public $value_kehadiran;
	public $gapok;
	public $tunjangan_jabatan;
	public $reward;
	public $lembur;
	public $piket;
	public $inval;
	public $jam_lebih;
	public $tunjangan_khusus;
	public $ekstrakuri;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'gajitunjangan';
		$this->TableName = 'gajitunjangan';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`gajitunjangan`";
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
		$this->id = new DbField('gajitunjangan', 'gajitunjangan', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// pidjabatan
		$this->pidjabatan = new DbField('gajitunjangan', 'gajitunjangan', 'x_pidjabatan', 'pidjabatan', '`pidjabatan`', '`pidjabatan`', 3, 11, -1, FALSE, '`pidjabatan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pidjabatan->IsForeignKey = TRUE; // Foreign key field
		$this->pidjabatan->Sortable = TRUE; // Allow sort
		$this->pidjabatan->Lookup = new Lookup('pidjabatan', 'jabatan', FALSE, 'id', ["nama_jabatan","","",""], [], [], [], [], [], [], '', '');
		$this->pidjabatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pidjabatan'] = &$this->pidjabatan;

		// value_kehadiran
		$this->value_kehadiran = new DbField('gajitunjangan', 'gajitunjangan', 'x_value_kehadiran', 'value_kehadiran', '`value_kehadiran`', '`value_kehadiran`', 20, 20, -1, FALSE, '`value_kehadiran`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->value_kehadiran->Sortable = TRUE; // Allow sort
		$this->value_kehadiran->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['value_kehadiran'] = &$this->value_kehadiran;

		// gapok
		$this->gapok = new DbField('gajitunjangan', 'gajitunjangan', 'x_gapok', 'gapok', '`gapok`', '`gapok`', 3, 11, -1, FALSE, '`gapok`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->gapok->Sortable = TRUE; // Allow sort
		$this->gapok->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['gapok'] = &$this->gapok;

		// tunjangan_jabatan
		$this->tunjangan_jabatan = new DbField('gajitunjangan', 'gajitunjangan', 'x_tunjangan_jabatan', 'tunjangan_jabatan', '`tunjangan_jabatan`', '`tunjangan_jabatan`', 3, 11, -1, FALSE, '`tunjangan_jabatan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tunjangan_jabatan->Sortable = TRUE; // Allow sort
		$this->tunjangan_jabatan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tunjangan_jabatan'] = &$this->tunjangan_jabatan;

		// reward
		$this->reward = new DbField('gajitunjangan', 'gajitunjangan', 'x_reward', 'reward', '`reward`', '`reward`', 3, 11, -1, FALSE, '`reward`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->reward->Sortable = TRUE; // Allow sort
		$this->reward->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['reward'] = &$this->reward;

		// lembur
		$this->lembur = new DbField('gajitunjangan', 'gajitunjangan', 'x_lembur', 'lembur', '`lembur`', '`lembur`', 3, 11, -1, FALSE, '`lembur`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lembur->Sortable = TRUE; // Allow sort
		$this->lembur->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['lembur'] = &$this->lembur;

		// piket
		$this->piket = new DbField('gajitunjangan', 'gajitunjangan', 'x_piket', 'piket', '`piket`', '`piket`', 3, 11, -1, FALSE, '`piket`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->piket->Sortable = TRUE; // Allow sort
		$this->piket->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['piket'] = &$this->piket;

		// inval
		$this->inval = new DbField('gajitunjangan', 'gajitunjangan', 'x_inval', 'inval', '`inval`', '`inval`', 3, 11, -1, FALSE, '`inval`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->inval->Sortable = TRUE; // Allow sort
		$this->inval->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['inval'] = &$this->inval;

		// jam_lebih
		$this->jam_lebih = new DbField('gajitunjangan', 'gajitunjangan', 'x_jam_lebih', 'jam_lebih', '`jam_lebih`', '`jam_lebih`', 20, 20, -1, FALSE, '`jam_lebih`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jam_lebih->Sortable = TRUE; // Allow sort
		$this->jam_lebih->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jam_lebih'] = &$this->jam_lebih;

		// tunjangan_khusus
		$this->tunjangan_khusus = new DbField('gajitunjangan', 'gajitunjangan', 'x_tunjangan_khusus', 'tunjangan_khusus', '`tunjangan_khusus`', '`tunjangan_khusus`', 20, 20, -1, FALSE, '`tunjangan_khusus`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tunjangan_khusus->Sortable = TRUE; // Allow sort
		$this->tunjangan_khusus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['tunjangan_khusus'] = &$this->tunjangan_khusus;

		// ekstrakuri
		$this->ekstrakuri = new DbField('gajitunjangan', 'gajitunjangan', 'x_ekstrakuri', 'ekstrakuri', '`ekstrakuri`', '`ekstrakuri`', 20, 20, -1, FALSE, '`ekstrakuri`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ekstrakuri->Sortable = TRUE; // Allow sort
		$this->ekstrakuri->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['ekstrakuri'] = &$this->ekstrakuri;
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
		if ($this->getCurrentMasterTable() == "jabatan") {
			if ($this->pidjabatan->getSessionValue() != "")
				$masterFilter .= "`id`=" . QuotedValue($this->pidjabatan->getSessionValue(), DATATYPE_NUMBER, "DB");
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
		if ($this->getCurrentMasterTable() == "jabatan") {
			if ($this->pidjabatan->getSessionValue() != "")
				$detailFilter .= "`pidjabatan`=" . QuotedValue($this->pidjabatan->getSessionValue(), DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $detailFilter;
	}

	// Master filter
	public function sqlMasterFilter_jabatan()
	{
		return "`id`=@id@";
	}

	// Detail filter
	public function sqlDetailFilter_jabatan()
	{
		return "`pidjabatan`=@pidjabatan@";
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
		$this->pidjabatan->DbValue = $row['pidjabatan'];
		$this->value_kehadiran->DbValue = $row['value_kehadiran'];
		$this->gapok->DbValue = $row['gapok'];
		$this->tunjangan_jabatan->DbValue = $row['tunjangan_jabatan'];
		$this->reward->DbValue = $row['reward'];
		$this->lembur->DbValue = $row['lembur'];
		$this->piket->DbValue = $row['piket'];
		$this->inval->DbValue = $row['inval'];
		$this->jam_lebih->DbValue = $row['jam_lebih'];
		$this->tunjangan_khusus->DbValue = $row['tunjangan_khusus'];
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
			return "gajitunjanganlist.php";
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
		if ($pageName == "gajitunjanganview.php")
			return $Language->phrase("View");
		elseif ($pageName == "gajitunjanganedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "gajitunjanganadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "gajitunjanganlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("gajitunjanganview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("gajitunjanganview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "gajitunjanganadd.php?" . $this->getUrlParm($parm);
		else
			$url = "gajitunjanganadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("gajitunjanganedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("gajitunjanganadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("gajitunjangandelete.php", $this->getUrlParm());
	}

	// Add master url
	public function addMasterUrl($url)
	{
		if ($this->getCurrentMasterTable() == "jabatan" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
			$url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->pidjabatan->CurrentValue);
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
		$this->pidjabatan->setDbValue($rs->fields('pidjabatan'));
		$this->value_kehadiran->setDbValue($rs->fields('value_kehadiran'));
		$this->gapok->setDbValue($rs->fields('gapok'));
		$this->tunjangan_jabatan->setDbValue($rs->fields('tunjangan_jabatan'));
		$this->reward->setDbValue($rs->fields('reward'));
		$this->lembur->setDbValue($rs->fields('lembur'));
		$this->piket->setDbValue($rs->fields('piket'));
		$this->inval->setDbValue($rs->fields('inval'));
		$this->jam_lebih->setDbValue($rs->fields('jam_lebih'));
		$this->tunjangan_khusus->setDbValue($rs->fields('tunjangan_khusus'));
		$this->ekstrakuri->setDbValue($rs->fields('ekstrakuri'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// pidjabatan
		// value_kehadiran
		// gapok
		// tunjangan_jabatan
		// reward
		// lembur
		// piket
		// inval
		// jam_lebih
		// tunjangan_khusus
		// ekstrakuri
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pidjabatan
		$this->pidjabatan->ViewValue = $this->pidjabatan->CurrentValue;
		$curVal = strval($this->pidjabatan->CurrentValue);
		if ($curVal != "") {
			$this->pidjabatan->ViewValue = $this->pidjabatan->lookupCacheOption($curVal);
			if ($this->pidjabatan->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->pidjabatan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->pidjabatan->ViewValue = $this->pidjabatan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->pidjabatan->ViewValue = $this->pidjabatan->CurrentValue;
				}
			}
		} else {
			$this->pidjabatan->ViewValue = NULL;
		}
		$this->pidjabatan->ViewCustomAttributes = "";

		// value_kehadiran
		$this->value_kehadiran->ViewValue = $this->value_kehadiran->CurrentValue;
		$this->value_kehadiran->ViewValue = FormatNumber($this->value_kehadiran->ViewValue, 0, -2, -2, -2);
		$this->value_kehadiran->ViewCustomAttributes = "";

		// gapok
		$this->gapok->ViewValue = $this->gapok->CurrentValue;
		$this->gapok->ViewValue = FormatNumber($this->gapok->ViewValue, 0, -2, -2, -2);
		$this->gapok->ViewCustomAttributes = "";

		// tunjangan_jabatan
		$this->tunjangan_jabatan->ViewValue = $this->tunjangan_jabatan->CurrentValue;
		$this->tunjangan_jabatan->ViewValue = FormatNumber($this->tunjangan_jabatan->ViewValue, 0, -2, -2, -2);
		$this->tunjangan_jabatan->ViewCustomAttributes = "";

		// reward
		$this->reward->ViewValue = $this->reward->CurrentValue;
		$this->reward->ViewValue = FormatNumber($this->reward->ViewValue, 0, -2, -2, -2);
		$this->reward->ViewCustomAttributes = "";

		// lembur
		$this->lembur->ViewValue = $this->lembur->CurrentValue;
		$this->lembur->ViewValue = FormatNumber($this->lembur->ViewValue, 0, -2, -2, -2);
		$this->lembur->ViewCustomAttributes = "";

		// piket
		$this->piket->ViewValue = $this->piket->CurrentValue;
		$this->piket->ViewValue = FormatNumber($this->piket->ViewValue, 0, -2, -2, -2);
		$this->piket->ViewCustomAttributes = "";

		// inval
		$this->inval->ViewValue = $this->inval->CurrentValue;
		$this->inval->ViewValue = FormatNumber($this->inval->ViewValue, 0, -2, -2, -2);
		$this->inval->ViewCustomAttributes = "";

		// jam_lebih
		$this->jam_lebih->ViewValue = $this->jam_lebih->CurrentValue;
		$this->jam_lebih->ViewValue = FormatNumber($this->jam_lebih->ViewValue, 0, -2, -2, -2);
		$this->jam_lebih->ViewCustomAttributes = "";

		// tunjangan_khusus
		$this->tunjangan_khusus->ViewValue = $this->tunjangan_khusus->CurrentValue;
		$this->tunjangan_khusus->ViewValue = FormatNumber($this->tunjangan_khusus->ViewValue, 0, -2, -2, -2);
		$this->tunjangan_khusus->ViewCustomAttributes = "";

		// ekstrakuri
		$this->ekstrakuri->ViewValue = $this->ekstrakuri->CurrentValue;
		$this->ekstrakuri->ViewValue = FormatNumber($this->ekstrakuri->ViewValue, 0, -2, -2, -2);
		$this->ekstrakuri->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// pidjabatan
		$this->pidjabatan->LinkCustomAttributes = "";
		$this->pidjabatan->HrefValue = "";
		$this->pidjabatan->TooltipValue = "";

		// value_kehadiran
		$this->value_kehadiran->LinkCustomAttributes = "";
		$this->value_kehadiran->HrefValue = "";
		$this->value_kehadiran->TooltipValue = "";

		// gapok
		$this->gapok->LinkCustomAttributes = "";
		$this->gapok->HrefValue = "";
		$this->gapok->TooltipValue = "";

		// tunjangan_jabatan
		$this->tunjangan_jabatan->LinkCustomAttributes = "";
		$this->tunjangan_jabatan->HrefValue = "";
		$this->tunjangan_jabatan->TooltipValue = "";

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

		// tunjangan_khusus
		$this->tunjangan_khusus->LinkCustomAttributes = "";
		$this->tunjangan_khusus->HrefValue = "";
		$this->tunjangan_khusus->TooltipValue = "";

		// ekstrakuri
		$this->ekstrakuri->LinkCustomAttributes = "";
		$this->ekstrakuri->HrefValue = "";
		$this->ekstrakuri->TooltipValue = "";

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

		// pidjabatan
		$this->pidjabatan->EditAttrs["class"] = "form-control";
		$this->pidjabatan->EditCustomAttributes = "";
		$this->pidjabatan->EditValue = $this->pidjabatan->CurrentValue;
		$curVal = strval($this->pidjabatan->CurrentValue);
		if ($curVal != "") {
			$this->pidjabatan->EditValue = $this->pidjabatan->lookupCacheOption($curVal);
			if ($this->pidjabatan->EditValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->pidjabatan->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->pidjabatan->EditValue = $this->pidjabatan->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->pidjabatan->EditValue = $this->pidjabatan->CurrentValue;
				}
			}
		} else {
			$this->pidjabatan->EditValue = NULL;
		}
		$this->pidjabatan->ViewCustomAttributes = "";

		// value_kehadiran
		$this->value_kehadiran->EditAttrs["class"] = "form-control";
		$this->value_kehadiran->EditCustomAttributes = "";
		$this->value_kehadiran->EditValue = $this->value_kehadiran->CurrentValue;
		$this->value_kehadiran->PlaceHolder = RemoveHtml($this->value_kehadiran->caption());

		// gapok
		$this->gapok->EditAttrs["class"] = "form-control";
		$this->gapok->EditCustomAttributes = "";
		$this->gapok->EditValue = $this->gapok->CurrentValue;
		$this->gapok->PlaceHolder = RemoveHtml($this->gapok->caption());

		// tunjangan_jabatan
		$this->tunjangan_jabatan->EditAttrs["class"] = "form-control";
		$this->tunjangan_jabatan->EditCustomAttributes = "";
		$this->tunjangan_jabatan->EditValue = $this->tunjangan_jabatan->CurrentValue;
		$this->tunjangan_jabatan->PlaceHolder = RemoveHtml($this->tunjangan_jabatan->caption());

		// reward
		$this->reward->EditAttrs["class"] = "form-control";
		$this->reward->EditCustomAttributes = "";
		$this->reward->EditValue = $this->reward->CurrentValue;
		$this->reward->PlaceHolder = RemoveHtml($this->reward->caption());

		// lembur
		$this->lembur->EditAttrs["class"] = "form-control";
		$this->lembur->EditCustomAttributes = "";
		$this->lembur->EditValue = $this->lembur->CurrentValue;
		$this->lembur->PlaceHolder = RemoveHtml($this->lembur->caption());

		// piket
		$this->piket->EditAttrs["class"] = "form-control";
		$this->piket->EditCustomAttributes = "";
		$this->piket->EditValue = $this->piket->CurrentValue;
		$this->piket->PlaceHolder = RemoveHtml($this->piket->caption());

		// inval
		$this->inval->EditAttrs["class"] = "form-control";
		$this->inval->EditCustomAttributes = "";
		$this->inval->EditValue = $this->inval->CurrentValue;
		$this->inval->PlaceHolder = RemoveHtml($this->inval->caption());

		// jam_lebih
		$this->jam_lebih->EditAttrs["class"] = "form-control";
		$this->jam_lebih->EditCustomAttributes = "";
		$this->jam_lebih->EditValue = $this->jam_lebih->CurrentValue;
		$this->jam_lebih->PlaceHolder = RemoveHtml($this->jam_lebih->caption());

		// tunjangan_khusus
		$this->tunjangan_khusus->EditAttrs["class"] = "form-control";
		$this->tunjangan_khusus->EditCustomAttributes = "";
		$this->tunjangan_khusus->EditValue = $this->tunjangan_khusus->CurrentValue;
		$this->tunjangan_khusus->PlaceHolder = RemoveHtml($this->tunjangan_khusus->caption());

		// ekstrakuri
		$this->ekstrakuri->EditAttrs["class"] = "form-control";
		$this->ekstrakuri->EditCustomAttributes = "";
		$this->ekstrakuri->EditValue = $this->ekstrakuri->CurrentValue;
		$this->ekstrakuri->PlaceHolder = RemoveHtml($this->ekstrakuri->caption());

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
					$doc->exportCaption($this->pidjabatan);
					$doc->exportCaption($this->value_kehadiran);
					$doc->exportCaption($this->gapok);
					$doc->exportCaption($this->tunjangan_jabatan);
					$doc->exportCaption($this->reward);
					$doc->exportCaption($this->lembur);
					$doc->exportCaption($this->piket);
					$doc->exportCaption($this->inval);
					$doc->exportCaption($this->jam_lebih);
					$doc->exportCaption($this->tunjangan_khusus);
					$doc->exportCaption($this->ekstrakuri);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->pidjabatan);
					$doc->exportCaption($this->value_kehadiran);
					$doc->exportCaption($this->gapok);
					$doc->exportCaption($this->tunjangan_jabatan);
					$doc->exportCaption($this->reward);
					$doc->exportCaption($this->lembur);
					$doc->exportCaption($this->piket);
					$doc->exportCaption($this->inval);
					$doc->exportCaption($this->jam_lebih);
					$doc->exportCaption($this->tunjangan_khusus);
					$doc->exportCaption($this->ekstrakuri);
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
						$doc->exportField($this->pidjabatan);
						$doc->exportField($this->value_kehadiran);
						$doc->exportField($this->gapok);
						$doc->exportField($this->tunjangan_jabatan);
						$doc->exportField($this->reward);
						$doc->exportField($this->lembur);
						$doc->exportField($this->piket);
						$doc->exportField($this->inval);
						$doc->exportField($this->jam_lebih);
						$doc->exportField($this->tunjangan_khusus);
						$doc->exportField($this->ekstrakuri);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->pidjabatan);
						$doc->exportField($this->value_kehadiran);
						$doc->exportField($this->gapok);
						$doc->exportField($this->tunjangan_jabatan);
						$doc->exportField($this->reward);
						$doc->exportField($this->lembur);
						$doc->exportField($this->piket);
						$doc->exportField($this->inval);
						$doc->exportField($this->jam_lebih);
						$doc->exportField($this->tunjangan_khusus);
						$doc->exportField($this->ekstrakuri);
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