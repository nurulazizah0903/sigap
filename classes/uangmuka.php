<?php namespace PHPMaker2020\sigap; ?>
<?php

/**
 * Table class for uangmuka
 */
class uangmuka extends DbTable
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
	public $bukti1;
	public $bukti2;
	public $bukti3;
	public $bukti4;
	public $disetujui;
	public $status;
	public $keterangan;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'uangmuka';
		$this->TableName = 'uangmuka';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`uangmuka`";
		$this->Dbid = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
		$this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
		$this->BasicSearch = new BasicSearch($this->TableVar);

		// id
		$this->id = new DbField('uangmuka', 'uangmuka', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// tgl
		$this->tgl = new DbField('uangmuka', 'uangmuka', 'x_tgl', 'tgl', '`tgl`', CastDateFieldForLike("`tgl`", 0, "DB"), 135, 19, 0, FALSE, '`tgl`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl->Sortable = TRUE; // Allow sort
		$this->tgl->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl'] = &$this->tgl;

		// pembayar
		$this->pembayar = new DbField('uangmuka', 'uangmuka', 'x_pembayar', 'pembayar', '`pembayar`', '`pembayar`', 3, 11, -1, FALSE, '`pembayar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pembayar->Sortable = TRUE; // Allow sort
		$this->pembayar->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pembayar'] = &$this->pembayar;

		// peruntukan
		$this->peruntukan = new DbField('uangmuka', 'uangmuka', 'x_peruntukan', 'peruntukan', '`peruntukan`', '`peruntukan`', 200, 255, -1, FALSE, '`peruntukan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->peruntukan->Sortable = TRUE; // Allow sort
		$this->fields['peruntukan'] = &$this->peruntukan;

		// penerima
		$this->penerima = new DbField('uangmuka', 'uangmuka', 'x_penerima', 'penerima', '`penerima`', '`penerima`', 3, 11, -1, FALSE, '`penerima`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->penerima->Sortable = TRUE; // Allow sort
		$this->penerima->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['penerima'] = &$this->penerima;

		// rek_penerima
		$this->rek_penerima = new DbField('uangmuka', 'uangmuka', 'x_rek_penerima', 'rek_penerima', '`rek_penerima`', '`rek_penerima`', 200, 255, -1, FALSE, '`rek_penerima`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rek_penerima->Sortable = TRUE; // Allow sort
		$this->fields['rek_penerima'] = &$this->rek_penerima;

		// tgl_terima
		$this->tgl_terima = new DbField('uangmuka', 'uangmuka', 'x_tgl_terima', 'tgl_terima', '`tgl_terima`', CastDateFieldForLike("`tgl_terima`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_terima`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_terima->Sortable = TRUE; // Allow sort
		$this->tgl_terima->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_terima'] = &$this->tgl_terima;

		// total_terima
		$this->total_terima = new DbField('uangmuka', 'uangmuka', 'x_total_terima', 'total_terima', '`total_terima`', '`total_terima`', 3, 255, -1, FALSE, '`total_terima`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_terima->Sortable = TRUE; // Allow sort
		$this->total_terima->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['total_terima'] = &$this->total_terima;

		// tgl_tgjb
		$this->tgl_tgjb = new DbField('uangmuka', 'uangmuka', 'x_tgl_tgjb', 'tgl_tgjb', '`tgl_tgjb`', CastDateFieldForLike("`tgl_tgjb`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_tgjb`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_tgjb->Sortable = TRUE; // Allow sort
		$this->tgl_tgjb->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_tgjb'] = &$this->tgl_tgjb;

		// jumlah_tgjb
		$this->jumlah_tgjb = new DbField('uangmuka', 'uangmuka', 'x_jumlah_tgjb', 'jumlah_tgjb', '`jumlah_tgjb`', '`jumlah_tgjb`', 3, 255, -1, FALSE, '`jumlah_tgjb`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumlah_tgjb->Sortable = TRUE; // Allow sort
		$this->jumlah_tgjb->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jumlah_tgjb'] = &$this->jumlah_tgjb;

		// jenis
		$this->jenis = new DbField('uangmuka', 'uangmuka', 'x_jenis', 'jenis', '`jenis`', '`jenis`', 200, 255, -1, FALSE, '`jenis`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenis->Sortable = TRUE; // Allow sort
		$this->fields['jenis'] = &$this->jenis;

		// bukti1
		$this->bukti1 = new DbField('uangmuka', 'uangmuka', 'x_bukti1', 'bukti1', '`bukti1`', '`bukti1`', 200, 255, -1, TRUE, '`bukti1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->bukti1->Sortable = TRUE; // Allow sort
		$this->fields['bukti1'] = &$this->bukti1;

		// bukti2
		$this->bukti2 = new DbField('uangmuka', 'uangmuka', 'x_bukti2', 'bukti2', '`bukti2`', '`bukti2`', 200, 255, -1, TRUE, '`bukti2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->bukti2->Sortable = TRUE; // Allow sort
		$this->fields['bukti2'] = &$this->bukti2;

		// bukti3
		$this->bukti3 = new DbField('uangmuka', 'uangmuka', 'x_bukti3', 'bukti3', '`bukti3`', '`bukti3`', 200, 255, -1, TRUE, '`bukti3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->bukti3->Sortable = TRUE; // Allow sort
		$this->fields['bukti3'] = &$this->bukti3;

		// bukti4
		$this->bukti4 = new DbField('uangmuka', 'uangmuka', 'x_bukti4', 'bukti4', '`bukti4`', '`bukti4`', 200, 255, -1, TRUE, '`bukti4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->bukti4->Sortable = TRUE; // Allow sort
		$this->fields['bukti4'] = &$this->bukti4;

		// disetujui
		$this->disetujui = new DbField('uangmuka', 'uangmuka', 'x_disetujui', 'disetujui', '`disetujui`', '`disetujui`', 200, 5, -1, FALSE, '`disetujui`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->disetujui->Sortable = TRUE; // Allow sort
		$this->disetujui->Lookup = new Lookup('disetujui', 'setuju', FALSE, 'name', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->fields['disetujui'] = &$this->disetujui;

		// status
		$this->status = new DbField('uangmuka', 'uangmuka', 'x_status', 'status', '`status`', '`status`', 200, 20, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status->Sortable = TRUE; // Allow sort
		$this->fields['status'] = &$this->status;

		// keterangan
		$this->keterangan = new DbField('uangmuka', 'uangmuka', 'x_keterangan', 'keterangan', '`keterangan`', '`keterangan`', 201, 500, -1, FALSE, '`keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keterangan->Sortable = TRUE; // Allow sort
		$this->fields['keterangan'] = &$this->keterangan;
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
		$this->bukti1->Upload->DbValue = $row['bukti1'];
		$this->bukti2->Upload->DbValue = $row['bukti2'];
		$this->bukti3->Upload->DbValue = $row['bukti3'];
		$this->bukti4->Upload->DbValue = $row['bukti4'];
		$this->disetujui->DbValue = $row['disetujui'];
		$this->status->DbValue = $row['status'];
		$this->keterangan->DbValue = $row['keterangan'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['bukti1']) ? [] : [$row['bukti1']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->bukti1->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->bukti1->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['bukti2']) ? [] : [$row['bukti2']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->bukti2->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->bukti2->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['bukti3']) ? [] : [$row['bukti3']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->bukti3->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->bukti3->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['bukti4']) ? [] : [$row['bukti4']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->bukti4->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->bukti4->oldPhysicalUploadPath() . $oldFile);
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
			return "uangmukalist.php";
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
		if ($pageName == "uangmukaview.php")
			return $Language->phrase("View");
		elseif ($pageName == "uangmukaedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "uangmukaadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "uangmukalist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("uangmukaview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("uangmukaview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "uangmukaadd.php?" . $this->getUrlParm($parm);
		else
			$url = "uangmukaadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("uangmukaedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("uangmukaadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("uangmukadelete.php", $this->getUrlParm());
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
		$this->tgl->setDbValue($rs->fields('tgl'));
		$this->pembayar->setDbValue($rs->fields('pembayar'));
		$this->peruntukan->setDbValue($rs->fields('peruntukan'));
		$this->penerima->setDbValue($rs->fields('penerima'));
		$this->rek_penerima->setDbValue($rs->fields('rek_penerima'));
		$this->tgl_terima->setDbValue($rs->fields('tgl_terima'));
		$this->total_terima->setDbValue($rs->fields('total_terima'));
		$this->tgl_tgjb->setDbValue($rs->fields('tgl_tgjb'));
		$this->jumlah_tgjb->setDbValue($rs->fields('jumlah_tgjb'));
		$this->jenis->setDbValue($rs->fields('jenis'));
		$this->bukti1->Upload->DbValue = $rs->fields('bukti1');
		$this->bukti2->Upload->DbValue = $rs->fields('bukti2');
		$this->bukti3->Upload->DbValue = $rs->fields('bukti3');
		$this->bukti4->Upload->DbValue = $rs->fields('bukti4');
		$this->disetujui->setDbValue($rs->fields('disetujui'));
		$this->status->setDbValue($rs->fields('status'));
		$this->keterangan->setDbValue($rs->fields('keterangan'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

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
		// bukti1
		// bukti2
		// bukti3
		// bukti4
		// disetujui
		// status
		// keterangan
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// tgl
		$this->tgl->ViewValue = $this->tgl->CurrentValue;
		$this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, 0);
		$this->tgl->ViewCustomAttributes = "";

		// pembayar
		$this->pembayar->ViewValue = $this->pembayar->CurrentValue;
		$this->pembayar->ViewValue = FormatNumber($this->pembayar->ViewValue, 0, -2, -2, -2);
		$this->pembayar->ViewCustomAttributes = "";

		// peruntukan
		$this->peruntukan->ViewValue = $this->peruntukan->CurrentValue;
		$this->peruntukan->ViewCustomAttributes = "";

		// penerima
		$this->penerima->ViewValue = $this->penerima->CurrentValue;
		$this->penerima->ViewValue = FormatNumber($this->penerima->ViewValue, 0, -2, -2, -2);
		$this->penerima->ViewCustomAttributes = "";

		// rek_penerima
		$this->rek_penerima->ViewValue = $this->rek_penerima->CurrentValue;
		$this->rek_penerima->ViewCustomAttributes = "";

		// tgl_terima
		$this->tgl_terima->ViewValue = $this->tgl_terima->CurrentValue;
		$this->tgl_terima->ViewValue = FormatDateTime($this->tgl_terima->ViewValue, 0);
		$this->tgl_terima->ViewCustomAttributes = "";

		// total_terima
		$this->total_terima->ViewValue = $this->total_terima->CurrentValue;
		$this->total_terima->ViewValue = FormatNumber($this->total_terima->ViewValue, 0, -2, -2, -2);
		$this->total_terima->ViewCustomAttributes = "";

		// tgl_tgjb
		$this->tgl_tgjb->ViewValue = $this->tgl_tgjb->CurrentValue;
		$this->tgl_tgjb->ViewValue = FormatDateTime($this->tgl_tgjb->ViewValue, 0);
		$this->tgl_tgjb->ViewCustomAttributes = "";

		// jumlah_tgjb
		$this->jumlah_tgjb->ViewValue = $this->jumlah_tgjb->CurrentValue;
		$this->jumlah_tgjb->ViewValue = FormatNumber($this->jumlah_tgjb->ViewValue, 0, -2, -2, -2);
		$this->jumlah_tgjb->ViewCustomAttributes = "";

		// jenis
		$this->jenis->ViewValue = $this->jenis->CurrentValue;
		$this->jenis->ViewCustomAttributes = "";

		// bukti1
		if (!EmptyValue($this->bukti1->Upload->DbValue)) {
			$this->bukti1->ViewValue = $this->bukti1->Upload->DbValue;
		} else {
			$this->bukti1->ViewValue = "";
		}
		$this->bukti1->ViewCustomAttributes = "";

		// bukti2
		if (!EmptyValue($this->bukti2->Upload->DbValue)) {
			$this->bukti2->ViewValue = $this->bukti2->Upload->DbValue;
		} else {
			$this->bukti2->ViewValue = "";
		}
		$this->bukti2->ViewCustomAttributes = "";

		// bukti3
		if (!EmptyValue($this->bukti3->Upload->DbValue)) {
			$this->bukti3->ViewValue = $this->bukti3->Upload->DbValue;
		} else {
			$this->bukti3->ViewValue = "";
		}
		$this->bukti3->ViewCustomAttributes = "";

		// bukti4
		if (!EmptyValue($this->bukti4->Upload->DbValue)) {
			$this->bukti4->ViewValue = $this->bukti4->Upload->DbValue;
		} else {
			$this->bukti4->ViewValue = "";
		}
		$this->bukti4->ViewCustomAttributes = "";

		// disetujui
		$curVal = strval($this->disetujui->CurrentValue);
		if ($curVal != "") {
			$this->disetujui->ViewValue = $this->disetujui->lookupCacheOption($curVal);
			if ($this->disetujui->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`name`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->disetujui->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->disetujui->ViewValue = $this->disetujui->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->disetujui->ViewValue = $this->disetujui->CurrentValue;
				}
			}
		} else {
			$this->disetujui->ViewValue = NULL;
		}
		$this->disetujui->ViewCustomAttributes = "";

		// status
		$this->status->ViewValue = $this->status->CurrentValue;
		$this->status->ViewCustomAttributes = "";

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->ViewCustomAttributes = "";

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

		// keterangan
		$this->keterangan->LinkCustomAttributes = "";
		$this->keterangan->HrefValue = "";
		$this->keterangan->TooltipValue = "";

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

		// tgl
		$this->tgl->EditAttrs["class"] = "form-control";
		$this->tgl->EditCustomAttributes = "";
		$this->tgl->EditValue = FormatDateTime($this->tgl->CurrentValue, 8);
		$this->tgl->PlaceHolder = RemoveHtml($this->tgl->caption());

		// pembayar
		$this->pembayar->EditAttrs["class"] = "form-control";
		$this->pembayar->EditCustomAttributes = "";
		$this->pembayar->EditValue = $this->pembayar->CurrentValue;
		$this->pembayar->PlaceHolder = RemoveHtml($this->pembayar->caption());

		// peruntukan
		$this->peruntukan->EditAttrs["class"] = "form-control";
		$this->peruntukan->EditCustomAttributes = "";
		if (!$this->peruntukan->Raw)
			$this->peruntukan->CurrentValue = HtmlDecode($this->peruntukan->CurrentValue);
		$this->peruntukan->EditValue = $this->peruntukan->CurrentValue;
		$this->peruntukan->PlaceHolder = RemoveHtml($this->peruntukan->caption());

		// penerima
		$this->penerima->EditAttrs["class"] = "form-control";
		$this->penerima->EditCustomAttributes = "";
		$this->penerima->EditValue = $this->penerima->CurrentValue;
		$this->penerima->PlaceHolder = RemoveHtml($this->penerima->caption());

		// rek_penerima
		$this->rek_penerima->EditAttrs["class"] = "form-control";
		$this->rek_penerima->EditCustomAttributes = "";
		if (!$this->rek_penerima->Raw)
			$this->rek_penerima->CurrentValue = HtmlDecode($this->rek_penerima->CurrentValue);
		$this->rek_penerima->EditValue = $this->rek_penerima->CurrentValue;
		$this->rek_penerima->PlaceHolder = RemoveHtml($this->rek_penerima->caption());

		// tgl_terima
		$this->tgl_terima->EditAttrs["class"] = "form-control";
		$this->tgl_terima->EditCustomAttributes = "";
		$this->tgl_terima->EditValue = FormatDateTime($this->tgl_terima->CurrentValue, 8);
		$this->tgl_terima->PlaceHolder = RemoveHtml($this->tgl_terima->caption());

		// total_terima
		$this->total_terima->EditAttrs["class"] = "form-control";
		$this->total_terima->EditCustomAttributes = "";
		$this->total_terima->EditValue = $this->total_terima->CurrentValue;
		$this->total_terima->PlaceHolder = RemoveHtml($this->total_terima->caption());

		// tgl_tgjb
		$this->tgl_tgjb->EditAttrs["class"] = "form-control";
		$this->tgl_tgjb->EditCustomAttributes = "";
		$this->tgl_tgjb->EditValue = FormatDateTime($this->tgl_tgjb->CurrentValue, 8);
		$this->tgl_tgjb->PlaceHolder = RemoveHtml($this->tgl_tgjb->caption());

		// jumlah_tgjb
		$this->jumlah_tgjb->EditAttrs["class"] = "form-control";
		$this->jumlah_tgjb->EditCustomAttributes = "";
		$this->jumlah_tgjb->EditValue = $this->jumlah_tgjb->CurrentValue;
		$this->jumlah_tgjb->PlaceHolder = RemoveHtml($this->jumlah_tgjb->caption());

		// jenis
		$this->jenis->EditAttrs["class"] = "form-control";
		$this->jenis->EditCustomAttributes = "";
		if (!$this->jenis->Raw)
			$this->jenis->CurrentValue = HtmlDecode($this->jenis->CurrentValue);
		$this->jenis->EditValue = $this->jenis->CurrentValue;
		$this->jenis->PlaceHolder = RemoveHtml($this->jenis->caption());

		// bukti1
		$this->bukti1->EditAttrs["class"] = "form-control";
		$this->bukti1->EditCustomAttributes = "";
		if (!EmptyValue($this->bukti1->Upload->DbValue)) {
			$this->bukti1->EditValue = $this->bukti1->Upload->DbValue;
		} else {
			$this->bukti1->EditValue = "";
		}
		if (!EmptyValue($this->bukti1->CurrentValue))
				$this->bukti1->Upload->FileName = $this->bukti1->CurrentValue;

		// bukti2
		$this->bukti2->EditAttrs["class"] = "form-control";
		$this->bukti2->EditCustomAttributes = "";
		if (!EmptyValue($this->bukti2->Upload->DbValue)) {
			$this->bukti2->EditValue = $this->bukti2->Upload->DbValue;
		} else {
			$this->bukti2->EditValue = "";
		}
		if (!EmptyValue($this->bukti2->CurrentValue))
				$this->bukti2->Upload->FileName = $this->bukti2->CurrentValue;

		// bukti3
		$this->bukti3->EditAttrs["class"] = "form-control";
		$this->bukti3->EditCustomAttributes = "";
		if (!EmptyValue($this->bukti3->Upload->DbValue)) {
			$this->bukti3->EditValue = $this->bukti3->Upload->DbValue;
		} else {
			$this->bukti3->EditValue = "";
		}
		if (!EmptyValue($this->bukti3->CurrentValue))
				$this->bukti3->Upload->FileName = $this->bukti3->CurrentValue;

		// bukti4
		$this->bukti4->EditAttrs["class"] = "form-control";
		$this->bukti4->EditCustomAttributes = "";
		if (!EmptyValue($this->bukti4->Upload->DbValue)) {
			$this->bukti4->EditValue = $this->bukti4->Upload->DbValue;
		} else {
			$this->bukti4->EditValue = "";
		}
		if (!EmptyValue($this->bukti4->CurrentValue))
				$this->bukti4->Upload->FileName = $this->bukti4->CurrentValue;

		// disetujui
		$this->disetujui->EditCustomAttributes = "";

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";
		if (!$this->status->Raw)
			$this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
		$this->status->EditValue = $this->status->CurrentValue;
		$this->status->PlaceHolder = RemoveHtml($this->status->caption());

		// keterangan
		$this->keterangan->EditAttrs["class"] = "form-control";
		$this->keterangan->EditCustomAttributes = "";
		$this->keterangan->EditValue = $this->keterangan->CurrentValue;
		$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

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
					$doc->exportCaption($this->keterangan);
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
						$doc->exportField($this->keterangan);
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