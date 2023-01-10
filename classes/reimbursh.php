<?php namespace PHPMaker2020\sigap; ?>
<?php

/**
 * Table class for reimbursh
 */
class reimbursh extends DbTable
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
	public $pegawai;
	public $nama;
	public $tgl;
	public $total_pengajuan;
	public $tgl_pengajuan;
	public $jenis;
	public $keterangan;
	public $rek_tujuan;
	public $bukti1;
	public $bukti2;
	public $bukti3;
	public $bukti4;
	public $disetujui;
	public $pembayar;
	public $terbayar;
	public $tgl_pembayaran;
	public $jumlah_dibayar;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'reimbursh';
		$this->TableName = 'reimbursh';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`reimbursh`";
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
		$this->id = new DbField('reimbursh', 'reimbursh', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// pegawai
		$this->pegawai = new DbField('reimbursh', 'reimbursh', 'x_pegawai', 'pegawai', '`pegawai`', '`pegawai`', 3, 11, -1, FALSE, '`pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pegawai->Sortable = TRUE; // Allow sort
		$this->pegawai->Lookup = new Lookup('pegawai', 'pegawai', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->pegawai->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pegawai'] = &$this->pegawai;

		// nama
		$this->nama = new DbField('reimbursh', 'reimbursh', 'x_nama', 'nama', '`nama`', '`nama`', 200, 255, -1, FALSE, '`nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama->Sortable = TRUE; // Allow sort
		$this->fields['nama'] = &$this->nama;

		// tgl
		$this->tgl = new DbField('reimbursh', 'reimbursh', 'x_tgl', 'tgl', '`tgl`', CastDateFieldForLike("`tgl`", 0, "DB"), 135, 19, 0, FALSE, '`tgl`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl->Sortable = TRUE; // Allow sort
		$this->tgl->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl'] = &$this->tgl;

		// total_pengajuan
		$this->total_pengajuan = new DbField('reimbursh', 'reimbursh', 'x_total_pengajuan', 'total_pengajuan', '`total_pengajuan`', '`total_pengajuan`', 3, 255, -1, FALSE, '`total_pengajuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->total_pengajuan->Sortable = TRUE; // Allow sort
		$this->total_pengajuan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['total_pengajuan'] = &$this->total_pengajuan;

		// tgl_pengajuan
		$this->tgl_pengajuan = new DbField('reimbursh', 'reimbursh', 'x_tgl_pengajuan', 'tgl_pengajuan', '`tgl_pengajuan`', CastDateFieldForLike("`tgl_pengajuan`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_pengajuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_pengajuan->Sortable = TRUE; // Allow sort
		$this->tgl_pengajuan->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_pengajuan'] = &$this->tgl_pengajuan;

		// jenis
		$this->jenis = new DbField('reimbursh', 'reimbursh', 'x_jenis', 'jenis', '`jenis`', '`jenis`', 200, 255, -1, FALSE, '`jenis`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenis->Sortable = TRUE; // Allow sort
		$this->fields['jenis'] = &$this->jenis;

		// keterangan
		$this->keterangan = new DbField('reimbursh', 'reimbursh', 'x_keterangan', 'keterangan', '`keterangan`', '`keterangan`', 201, 500, -1, FALSE, '`keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->keterangan->Sortable = TRUE; // Allow sort
		$this->fields['keterangan'] = &$this->keterangan;

		// rek_tujuan
		$this->rek_tujuan = new DbField('reimbursh', 'reimbursh', 'x_rek_tujuan', 'rek_tujuan', '`rek_tujuan`', '`rek_tujuan`', 200, 255, -1, FALSE, '`rek_tujuan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->rek_tujuan->Sortable = TRUE; // Allow sort
		$this->fields['rek_tujuan'] = &$this->rek_tujuan;

		// bukti1
		$this->bukti1 = new DbField('reimbursh', 'reimbursh', 'x_bukti1', 'bukti1', '`bukti1`', '`bukti1`', 200, 255, -1, FALSE, '`bukti1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bukti1->Sortable = TRUE; // Allow sort
		$this->fields['bukti1'] = &$this->bukti1;

		// bukti2
		$this->bukti2 = new DbField('reimbursh', 'reimbursh', 'x_bukti2', 'bukti2', '`bukti2`', '`bukti2`', 200, 255, -1, FALSE, '`bukti2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bukti2->Sortable = TRUE; // Allow sort
		$this->fields['bukti2'] = &$this->bukti2;

		// bukti3
		$this->bukti3 = new DbField('reimbursh', 'reimbursh', 'x_bukti3', 'bukti3', '`bukti3`', '`bukti3`', 200, 255, -1, FALSE, '`bukti3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bukti3->Sortable = TRUE; // Allow sort
		$this->fields['bukti3'] = &$this->bukti3;

		// bukti4
		$this->bukti4 = new DbField('reimbursh', 'reimbursh', 'x_bukti4', 'bukti4', '`bukti4`', '`bukti4`', 200, 255, -1, FALSE, '`bukti4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->bukti4->Sortable = TRUE; // Allow sort
		$this->fields['bukti4'] = &$this->bukti4;

		// disetujui
		$this->disetujui = new DbField('reimbursh', 'reimbursh', 'x_disetujui', 'disetujui', '`disetujui`', '`disetujui`', 200, 5, -1, FALSE, '`disetujui`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->disetujui->Sortable = TRUE; // Allow sort
		$this->disetujui->Lookup = new Lookup('disetujui', 'setuju', FALSE, 'name', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->fields['disetujui'] = &$this->disetujui;

		// pembayar
		$this->pembayar = new DbField('reimbursh', 'reimbursh', 'x_pembayar', 'pembayar', '`pembayar`', '`pembayar`', 200, 255, -1, FALSE, '`pembayar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pembayar->Sortable = TRUE; // Allow sort
		$this->fields['pembayar'] = &$this->pembayar;

		// terbayar
		$this->terbayar = new DbField('reimbursh', 'reimbursh', 'x_terbayar', 'terbayar', '`terbayar`', '`terbayar`', 200, 5, -1, FALSE, '`terbayar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->terbayar->Sortable = TRUE; // Allow sort
		$this->terbayar->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->terbayar->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->terbayar->Lookup = new Lookup('terbayar', 'setuju', FALSE, 'name', ["name","","",""], [], [], [], [], [], [], '', '');
		$this->fields['terbayar'] = &$this->terbayar;

		// tgl_pembayaran
		$this->tgl_pembayaran = new DbField('reimbursh', 'reimbursh', 'x_tgl_pembayaran', 'tgl_pembayaran', '`tgl_pembayaran`', CastDateFieldForLike("`tgl_pembayaran`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_pembayaran`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_pembayaran->Sortable = TRUE; // Allow sort
		$this->tgl_pembayaran->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_pembayaran'] = &$this->tgl_pembayaran;

		// jumlah_dibayar
		$this->jumlah_dibayar = new DbField('reimbursh', 'reimbursh', 'x_jumlah_dibayar', 'jumlah_dibayar', '`jumlah_dibayar`', '`jumlah_dibayar`', 3, 255, -1, FALSE, '`jumlah_dibayar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jumlah_dibayar->Sortable = TRUE; // Allow sort
		$this->jumlah_dibayar->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['jumlah_dibayar'] = &$this->jumlah_dibayar;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`reimbursh`";
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
		$this->pegawai->DbValue = $row['pegawai'];
		$this->nama->DbValue = $row['nama'];
		$this->tgl->DbValue = $row['tgl'];
		$this->total_pengajuan->DbValue = $row['total_pengajuan'];
		$this->tgl_pengajuan->DbValue = $row['tgl_pengajuan'];
		$this->jenis->DbValue = $row['jenis'];
		$this->keterangan->DbValue = $row['keterangan'];
		$this->rek_tujuan->DbValue = $row['rek_tujuan'];
		$this->bukti1->DbValue = $row['bukti1'];
		$this->bukti2->DbValue = $row['bukti2'];
		$this->bukti3->DbValue = $row['bukti3'];
		$this->bukti4->DbValue = $row['bukti4'];
		$this->disetujui->DbValue = $row['disetujui'];
		$this->pembayar->DbValue = $row['pembayar'];
		$this->terbayar->DbValue = $row['terbayar'];
		$this->tgl_pembayaran->DbValue = $row['tgl_pembayaran'];
		$this->jumlah_dibayar->DbValue = $row['jumlah_dibayar'];
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
			return "reimburshlist.php";
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
		if ($pageName == "reimburshview.php")
			return $Language->phrase("View");
		elseif ($pageName == "reimburshedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "reimburshadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "reimburshlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("reimburshview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("reimburshview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "reimburshadd.php?" . $this->getUrlParm($parm);
		else
			$url = "reimburshadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("reimburshedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("reimburshadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("reimburshdelete.php", $this->getUrlParm());
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
		$this->pegawai->setDbValue($rs->fields('pegawai'));
		$this->nama->setDbValue($rs->fields('nama'));
		$this->tgl->setDbValue($rs->fields('tgl'));
		$this->total_pengajuan->setDbValue($rs->fields('total_pengajuan'));
		$this->tgl_pengajuan->setDbValue($rs->fields('tgl_pengajuan'));
		$this->jenis->setDbValue($rs->fields('jenis'));
		$this->keterangan->setDbValue($rs->fields('keterangan'));
		$this->rek_tujuan->setDbValue($rs->fields('rek_tujuan'));
		$this->bukti1->setDbValue($rs->fields('bukti1'));
		$this->bukti2->setDbValue($rs->fields('bukti2'));
		$this->bukti3->setDbValue($rs->fields('bukti3'));
		$this->bukti4->setDbValue($rs->fields('bukti4'));
		$this->disetujui->setDbValue($rs->fields('disetujui'));
		$this->pembayar->setDbValue($rs->fields('pembayar'));
		$this->terbayar->setDbValue($rs->fields('terbayar'));
		$this->tgl_pembayaran->setDbValue($rs->fields('tgl_pembayaran'));
		$this->jumlah_dibayar->setDbValue($rs->fields('jumlah_dibayar'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// pegawai
		// nama
		// tgl
		// total_pengajuan
		// tgl_pengajuan
		// jenis
		// keterangan
		// rek_tujuan
		// bukti1
		// bukti2
		// bukti3
		// bukti4
		// disetujui
		// pembayar
		// terbayar
		// tgl_pembayaran
		// jumlah_dibayar
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pegawai
		$this->pegawai->ViewValue = $this->pegawai->CurrentValue;
		$curVal = strval($this->pegawai->CurrentValue);
		if ($curVal != "") {
			$this->pegawai->ViewValue = $this->pegawai->lookupCacheOption($curVal);
			if ($this->pegawai->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
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

		// nama
		$this->nama->ViewValue = $this->nama->CurrentValue;
		$this->nama->ViewCustomAttributes = "";

		// tgl
		$this->tgl->ViewValue = $this->tgl->CurrentValue;
		$this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, 0);
		$this->tgl->ViewCustomAttributes = "";

		// total_pengajuan
		$this->total_pengajuan->ViewValue = $this->total_pengajuan->CurrentValue;
		$this->total_pengajuan->ViewValue = FormatNumber($this->total_pengajuan->ViewValue, 0, -2, -2, -2);
		$this->total_pengajuan->ViewCustomAttributes = "";

		// tgl_pengajuan
		$this->tgl_pengajuan->ViewValue = $this->tgl_pengajuan->CurrentValue;
		$this->tgl_pengajuan->ViewValue = FormatDateTime($this->tgl_pengajuan->ViewValue, 0);
		$this->tgl_pengajuan->ViewCustomAttributes = "";

		// jenis
		$this->jenis->ViewValue = $this->jenis->CurrentValue;
		$this->jenis->ViewCustomAttributes = "";

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->ViewCustomAttributes = "";

		// rek_tujuan
		$this->rek_tujuan->ViewValue = $this->rek_tujuan->CurrentValue;
		$this->rek_tujuan->ViewCustomAttributes = "";

		// bukti1
		$this->bukti1->ViewValue = $this->bukti1->CurrentValue;
		$this->bukti1->ViewCustomAttributes = "";

		// bukti2
		$this->bukti2->ViewValue = $this->bukti2->CurrentValue;
		$this->bukti2->ViewCustomAttributes = "";

		// bukti3
		$this->bukti3->ViewValue = $this->bukti3->CurrentValue;
		$this->bukti3->ViewCustomAttributes = "";

		// bukti4
		$this->bukti4->ViewValue = $this->bukti4->CurrentValue;
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

		// pembayar
		$this->pembayar->ViewValue = $this->pembayar->CurrentValue;
		$this->pembayar->ViewCustomAttributes = "";

		// terbayar
		$curVal = strval($this->terbayar->CurrentValue);
		if ($curVal != "") {
			$this->terbayar->ViewValue = $this->terbayar->lookupCacheOption($curVal);
			if ($this->terbayar->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`name`" . SearchString("=", $curVal, DATATYPE_STRING, "");
				$sqlWrk = $this->terbayar->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->terbayar->ViewValue = $this->terbayar->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->terbayar->ViewValue = $this->terbayar->CurrentValue;
				}
			}
		} else {
			$this->terbayar->ViewValue = NULL;
		}
		$this->terbayar->ViewCustomAttributes = "";

		// tgl_pembayaran
		$this->tgl_pembayaran->ViewValue = $this->tgl_pembayaran->CurrentValue;
		$this->tgl_pembayaran->ViewValue = FormatDateTime($this->tgl_pembayaran->ViewValue, 0);
		$this->tgl_pembayaran->ViewCustomAttributes = "";

		// jumlah_dibayar
		$this->jumlah_dibayar->ViewValue = $this->jumlah_dibayar->CurrentValue;
		$this->jumlah_dibayar->ViewValue = FormatNumber($this->jumlah_dibayar->ViewValue, 0, -2, -2, -2);
		$this->jumlah_dibayar->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// pegawai
		$this->pegawai->LinkCustomAttributes = "";
		$this->pegawai->HrefValue = "";
		$this->pegawai->TooltipValue = "";

		// nama
		$this->nama->LinkCustomAttributes = "";
		$this->nama->HrefValue = "";
		$this->nama->TooltipValue = "";

		// tgl
		$this->tgl->LinkCustomAttributes = "";
		$this->tgl->HrefValue = "";
		$this->tgl->TooltipValue = "";

		// total_pengajuan
		$this->total_pengajuan->LinkCustomAttributes = "";
		$this->total_pengajuan->HrefValue = "";
		$this->total_pengajuan->TooltipValue = "";

		// tgl_pengajuan
		$this->tgl_pengajuan->LinkCustomAttributes = "";
		$this->tgl_pengajuan->HrefValue = "";
		$this->tgl_pengajuan->TooltipValue = "";

		// jenis
		$this->jenis->LinkCustomAttributes = "";
		$this->jenis->HrefValue = "";
		$this->jenis->TooltipValue = "";

		// keterangan
		$this->keterangan->LinkCustomAttributes = "";
		$this->keterangan->HrefValue = "";
		$this->keterangan->TooltipValue = "";

		// rek_tujuan
		$this->rek_tujuan->LinkCustomAttributes = "";
		$this->rek_tujuan->HrefValue = "";
		$this->rek_tujuan->TooltipValue = "";

		// bukti1
		$this->bukti1->LinkCustomAttributes = "";
		$this->bukti1->HrefValue = "";
		$this->bukti1->TooltipValue = "";

		// bukti2
		$this->bukti2->LinkCustomAttributes = "";
		$this->bukti2->HrefValue = "";
		$this->bukti2->TooltipValue = "";

		// bukti3
		$this->bukti3->LinkCustomAttributes = "";
		$this->bukti3->HrefValue = "";
		$this->bukti3->TooltipValue = "";

		// bukti4
		$this->bukti4->LinkCustomAttributes = "";
		$this->bukti4->HrefValue = "";
		$this->bukti4->TooltipValue = "";

		// disetujui
		$this->disetujui->LinkCustomAttributes = "";
		$this->disetujui->HrefValue = "";
		$this->disetujui->TooltipValue = "";

		// pembayar
		$this->pembayar->LinkCustomAttributes = "";
		$this->pembayar->HrefValue = "";
		$this->pembayar->TooltipValue = "";

		// terbayar
		$this->terbayar->LinkCustomAttributes = "";
		$this->terbayar->HrefValue = "";
		$this->terbayar->TooltipValue = "";

		// tgl_pembayaran
		$this->tgl_pembayaran->LinkCustomAttributes = "";
		$this->tgl_pembayaran->HrefValue = "";
		$this->tgl_pembayaran->TooltipValue = "";

		// jumlah_dibayar
		$this->jumlah_dibayar->LinkCustomAttributes = "";
		$this->jumlah_dibayar->HrefValue = "";
		$this->jumlah_dibayar->TooltipValue = "";

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

		// pegawai
		$this->pegawai->EditAttrs["class"] = "form-control";
		$this->pegawai->EditCustomAttributes = "";
		$this->pegawai->EditValue = $this->pegawai->CurrentValue;
		$this->pegawai->PlaceHolder = RemoveHtml($this->pegawai->caption());

		// nama
		$this->nama->EditAttrs["class"] = "form-control";
		$this->nama->EditCustomAttributes = "";
		if (!$this->nama->Raw)
			$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
		$this->nama->EditValue = $this->nama->CurrentValue;
		$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

		// tgl
		// total_pengajuan

		$this->total_pengajuan->EditAttrs["class"] = "form-control";
		$this->total_pengajuan->EditCustomAttributes = "";
		$this->total_pengajuan->EditValue = $this->total_pengajuan->CurrentValue;
		$this->total_pengajuan->PlaceHolder = RemoveHtml($this->total_pengajuan->caption());

		// tgl_pengajuan
		$this->tgl_pengajuan->EditAttrs["class"] = "form-control";
		$this->tgl_pengajuan->EditCustomAttributes = "";
		$this->tgl_pengajuan->EditValue = FormatDateTime($this->tgl_pengajuan->CurrentValue, 8);
		$this->tgl_pengajuan->PlaceHolder = RemoveHtml($this->tgl_pengajuan->caption());

		// jenis
		$this->jenis->EditAttrs["class"] = "form-control";
		$this->jenis->EditCustomAttributes = "";
		if (!$this->jenis->Raw)
			$this->jenis->CurrentValue = HtmlDecode($this->jenis->CurrentValue);
		$this->jenis->EditValue = $this->jenis->CurrentValue;
		$this->jenis->PlaceHolder = RemoveHtml($this->jenis->caption());

		// keterangan
		$this->keterangan->EditAttrs["class"] = "form-control";
		$this->keterangan->EditCustomAttributes = "";
		$this->keterangan->EditValue = $this->keterangan->CurrentValue;
		$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

		// rek_tujuan
		$this->rek_tujuan->EditAttrs["class"] = "form-control";
		$this->rek_tujuan->EditCustomAttributes = "";
		if (!$this->rek_tujuan->Raw)
			$this->rek_tujuan->CurrentValue = HtmlDecode($this->rek_tujuan->CurrentValue);
		$this->rek_tujuan->EditValue = $this->rek_tujuan->CurrentValue;
		$this->rek_tujuan->PlaceHolder = RemoveHtml($this->rek_tujuan->caption());

		// bukti1
		$this->bukti1->EditAttrs["class"] = "form-control";
		$this->bukti1->EditCustomAttributes = "";
		if (!$this->bukti1->Raw)
			$this->bukti1->CurrentValue = HtmlDecode($this->bukti1->CurrentValue);
		$this->bukti1->EditValue = $this->bukti1->CurrentValue;
		$this->bukti1->PlaceHolder = RemoveHtml($this->bukti1->caption());

		// bukti2
		$this->bukti2->EditAttrs["class"] = "form-control";
		$this->bukti2->EditCustomAttributes = "";
		if (!$this->bukti2->Raw)
			$this->bukti2->CurrentValue = HtmlDecode($this->bukti2->CurrentValue);
		$this->bukti2->EditValue = $this->bukti2->CurrentValue;
		$this->bukti2->PlaceHolder = RemoveHtml($this->bukti2->caption());

		// bukti3
		$this->bukti3->EditAttrs["class"] = "form-control";
		$this->bukti3->EditCustomAttributes = "";
		if (!$this->bukti3->Raw)
			$this->bukti3->CurrentValue = HtmlDecode($this->bukti3->CurrentValue);
		$this->bukti3->EditValue = $this->bukti3->CurrentValue;
		$this->bukti3->PlaceHolder = RemoveHtml($this->bukti3->caption());

		// bukti4
		$this->bukti4->EditAttrs["class"] = "form-control";
		$this->bukti4->EditCustomAttributes = "";
		if (!$this->bukti4->Raw)
			$this->bukti4->CurrentValue = HtmlDecode($this->bukti4->CurrentValue);
		$this->bukti4->EditValue = $this->bukti4->CurrentValue;
		$this->bukti4->PlaceHolder = RemoveHtml($this->bukti4->caption());

		// disetujui
		$this->disetujui->EditCustomAttributes = "";

		// pembayar
		$this->pembayar->EditAttrs["class"] = "form-control";
		$this->pembayar->EditCustomAttributes = "";
		if (!$this->pembayar->Raw)
			$this->pembayar->CurrentValue = HtmlDecode($this->pembayar->CurrentValue);
		$this->pembayar->EditValue = $this->pembayar->CurrentValue;
		$this->pembayar->PlaceHolder = RemoveHtml($this->pembayar->caption());

		// terbayar
		$this->terbayar->EditAttrs["class"] = "form-control";
		$this->terbayar->EditCustomAttributes = "";

		// tgl_pembayaran
		$this->tgl_pembayaran->EditAttrs["class"] = "form-control";
		$this->tgl_pembayaran->EditCustomAttributes = "";
		$this->tgl_pembayaran->EditValue = FormatDateTime($this->tgl_pembayaran->CurrentValue, 8);
		$this->tgl_pembayaran->PlaceHolder = RemoveHtml($this->tgl_pembayaran->caption());

		// jumlah_dibayar
		$this->jumlah_dibayar->EditAttrs["class"] = "form-control";
		$this->jumlah_dibayar->EditCustomAttributes = "";
		$this->jumlah_dibayar->EditValue = $this->jumlah_dibayar->CurrentValue;
		$this->jumlah_dibayar->PlaceHolder = RemoveHtml($this->jumlah_dibayar->caption());

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
					$doc->exportCaption($this->pegawai);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->tgl);
					$doc->exportCaption($this->total_pengajuan);
					$doc->exportCaption($this->tgl_pengajuan);
					$doc->exportCaption($this->jenis);
					$doc->exportCaption($this->keterangan);
					$doc->exportCaption($this->rek_tujuan);
					$doc->exportCaption($this->bukti1);
					$doc->exportCaption($this->bukti2);
					$doc->exportCaption($this->bukti3);
					$doc->exportCaption($this->bukti4);
					$doc->exportCaption($this->disetujui);
					$doc->exportCaption($this->pembayar);
					$doc->exportCaption($this->terbayar);
					$doc->exportCaption($this->tgl_pembayaran);
					$doc->exportCaption($this->jumlah_dibayar);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->pegawai);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->tgl);
					$doc->exportCaption($this->total_pengajuan);
					$doc->exportCaption($this->tgl_pengajuan);
					$doc->exportCaption($this->jenis);
					$doc->exportCaption($this->rek_tujuan);
					$doc->exportCaption($this->bukti1);
					$doc->exportCaption($this->bukti2);
					$doc->exportCaption($this->bukti3);
					$doc->exportCaption($this->bukti4);
					$doc->exportCaption($this->disetujui);
					$doc->exportCaption($this->pembayar);
					$doc->exportCaption($this->terbayar);
					$doc->exportCaption($this->tgl_pembayaran);
					$doc->exportCaption($this->jumlah_dibayar);
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
						$doc->exportField($this->pegawai);
						$doc->exportField($this->nama);
						$doc->exportField($this->tgl);
						$doc->exportField($this->total_pengajuan);
						$doc->exportField($this->tgl_pengajuan);
						$doc->exportField($this->jenis);
						$doc->exportField($this->keterangan);
						$doc->exportField($this->rek_tujuan);
						$doc->exportField($this->bukti1);
						$doc->exportField($this->bukti2);
						$doc->exportField($this->bukti3);
						$doc->exportField($this->bukti4);
						$doc->exportField($this->disetujui);
						$doc->exportField($this->pembayar);
						$doc->exportField($this->terbayar);
						$doc->exportField($this->tgl_pembayaran);
						$doc->exportField($this->jumlah_dibayar);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->pegawai);
						$doc->exportField($this->nama);
						$doc->exportField($this->tgl);
						$doc->exportField($this->total_pengajuan);
						$doc->exportField($this->tgl_pengajuan);
						$doc->exportField($this->jenis);
						$doc->exportField($this->rek_tujuan);
						$doc->exportField($this->bukti1);
						$doc->exportField($this->bukti2);
						$doc->exportField($this->bukti3);
						$doc->exportField($this->bukti4);
						$doc->exportField($this->disetujui);
						$doc->exportField($this->pembayar);
						$doc->exportField($this->terbayar);
						$doc->exportField($this->tgl_pembayaran);
						$doc->exportField($this->jumlah_dibayar);
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