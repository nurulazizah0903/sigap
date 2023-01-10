<?php namespace PHPMaker2020\sigap; ?>
<?php

/**
 * Table class for daftarbarang
 */
class daftarbarang extends DbTable
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
	public $pemegang;
	public $nama;
	public $jenis;
	public $sepsifikasi;
	public $tgl_terima;
	public $tgl_beli;
	public $harga;
	public $dokumen;
	public $foto;
	public $keterangan;
	public $deskripsi;
	public $status;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'daftarbarang';
		$this->TableName = 'daftarbarang';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`daftarbarang`";
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
		$this->id = new DbField('daftarbarang', 'daftarbarang', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// pemegang
		$this->pemegang = new DbField('daftarbarang', 'daftarbarang', 'x_pemegang', 'pemegang', '`pemegang`', '`pemegang`', 3, 11, -1, FALSE, '`pemegang`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pemegang->Sortable = TRUE; // Allow sort
		$this->pemegang->Lookup = new Lookup('pemegang', 'pegawai', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->pemegang->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pemegang'] = &$this->pemegang;

		// nama
		$this->nama = new DbField('daftarbarang', 'daftarbarang', 'x_nama', 'nama', '`nama`', '`nama`', 200, 255, -1, FALSE, '`nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nama->Sortable = TRUE; // Allow sort
		$this->fields['nama'] = &$this->nama;

		// jenis
		$this->jenis = new DbField('daftarbarang', 'daftarbarang', 'x_jenis', 'jenis', '`jenis`', '`jenis`', 200, 50, -1, FALSE, '`jenis`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenis->Sortable = TRUE; // Allow sort
		$this->fields['jenis'] = &$this->jenis;

		// sepsifikasi
		$this->sepsifikasi = new DbField('daftarbarang', 'daftarbarang', 'x_sepsifikasi', 'sepsifikasi', '`sepsifikasi`', '`sepsifikasi`', 200, 255, -1, FALSE, '`sepsifikasi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sepsifikasi->Sortable = TRUE; // Allow sort
		$this->fields['sepsifikasi'] = &$this->sepsifikasi;

		// tgl_terima
		$this->tgl_terima = new DbField('daftarbarang', 'daftarbarang', 'x_tgl_terima', 'tgl_terima', '`tgl_terima`', CastDateFieldForLike("`tgl_terima`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_terima`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_terima->Sortable = TRUE; // Allow sort
		$this->tgl_terima->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_terima'] = &$this->tgl_terima;

		// tgl_beli
		$this->tgl_beli = new DbField('daftarbarang', 'daftarbarang', 'x_tgl_beli', 'tgl_beli', '`tgl_beli`', CastDateFieldForLike("`tgl_beli`", 0, "DB"), 135, 19, 0, FALSE, '`tgl_beli`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_beli->Sortable = TRUE; // Allow sort
		$this->tgl_beli->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_beli'] = &$this->tgl_beli;

		// harga
		$this->harga = new DbField('daftarbarang', 'daftarbarang', 'x_harga', 'harga', '`harga`', '`harga`', 3, 11, -1, FALSE, '`harga`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->harga->Sortable = TRUE; // Allow sort
		$this->harga->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['harga'] = &$this->harga;

		// dokumen
		$this->dokumen = new DbField('daftarbarang', 'daftarbarang', 'x_dokumen', 'dokumen', '`dokumen`', '`dokumen`', 200, 255, -1, TRUE, '`dokumen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->dokumen->Sortable = TRUE; // Allow sort
		$this->fields['dokumen'] = &$this->dokumen;

		// foto
		$this->foto = new DbField('daftarbarang', 'daftarbarang', 'x_foto', 'foto', '`foto`', '`foto`', 200, 255, -1, TRUE, '`foto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->foto->Sortable = TRUE; // Allow sort
		$this->fields['foto'] = &$this->foto;

		// keterangan
		$this->keterangan = new DbField('daftarbarang', 'daftarbarang', 'x_keterangan', 'keterangan', '`keterangan`', '`keterangan`', 200, 255, -1, FALSE, '`keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keterangan->Sortable = TRUE; // Allow sort
		$this->fields['keterangan'] = &$this->keterangan;

		// deskripsi
		$this->deskripsi = new DbField('daftarbarang', 'daftarbarang', 'x_deskripsi', 'deskripsi', '`deskripsi`', '`deskripsi`', 200, 255, -1, FALSE, '`deskripsi`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->deskripsi->Sortable = TRUE; // Allow sort
		$this->fields['deskripsi'] = &$this->deskripsi;

		// status
		$this->status = new DbField('daftarbarang', 'daftarbarang', 'x_status', 'status', '`status`', '`status`', 200, 50, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status->Sortable = TRUE; // Allow sort
		$this->fields['status'] = &$this->status;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`daftarbarang`";
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
		$this->pemegang->DbValue = $row['pemegang'];
		$this->nama->DbValue = $row['nama'];
		$this->jenis->DbValue = $row['jenis'];
		$this->sepsifikasi->DbValue = $row['sepsifikasi'];
		$this->tgl_terima->DbValue = $row['tgl_terima'];
		$this->tgl_beli->DbValue = $row['tgl_beli'];
		$this->harga->DbValue = $row['harga'];
		$this->dokumen->Upload->DbValue = $row['dokumen'];
		$this->foto->Upload->DbValue = $row['foto'];
		$this->keterangan->DbValue = $row['keterangan'];
		$this->deskripsi->DbValue = $row['deskripsi'];
		$this->status->DbValue = $row['status'];
	}

	// Delete uploaded files
	public function deleteUploadedFiles($row)
	{
		$this->loadDbValues($row);
		$oldFiles = EmptyValue($row['dokumen']) ? [] : [$row['dokumen']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->dokumen->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->dokumen->oldPhysicalUploadPath() . $oldFile);
		}
		$oldFiles = EmptyValue($row['foto']) ? [] : [$row['foto']];
		foreach ($oldFiles as $oldFile) {
			if (file_exists($this->foto->oldPhysicalUploadPath() . $oldFile))
				@unlink($this->foto->oldPhysicalUploadPath() . $oldFile);
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
			return "daftarbaranglist.php";
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
		if ($pageName == "daftarbarangview.php")
			return $Language->phrase("View");
		elseif ($pageName == "daftarbarangedit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "daftarbarangadd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "daftarbaranglist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("daftarbarangview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("daftarbarangview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "daftarbarangadd.php?" . $this->getUrlParm($parm);
		else
			$url = "daftarbarangadd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("daftarbarangedit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("daftarbarangadd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("daftarbarangdelete.php", $this->getUrlParm());
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
		$this->pemegang->setDbValue($rs->fields('pemegang'));
		$this->nama->setDbValue($rs->fields('nama'));
		$this->jenis->setDbValue($rs->fields('jenis'));
		$this->sepsifikasi->setDbValue($rs->fields('sepsifikasi'));
		$this->tgl_terima->setDbValue($rs->fields('tgl_terima'));
		$this->tgl_beli->setDbValue($rs->fields('tgl_beli'));
		$this->harga->setDbValue($rs->fields('harga'));
		$this->dokumen->Upload->DbValue = $rs->fields('dokumen');
		$this->foto->Upload->DbValue = $rs->fields('foto');
		$this->keterangan->setDbValue($rs->fields('keterangan'));
		$this->deskripsi->setDbValue($rs->fields('deskripsi'));
		$this->status->setDbValue($rs->fields('status'));
	}

	// Render list row values
	public function renderListRow()
	{
		global $Security, $CurrentLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// Common render codes
		// id
		// pemegang
		// nama
		// jenis
		// sepsifikasi
		// tgl_terima
		// tgl_beli
		// harga
		// dokumen
		// foto
		// keterangan
		// deskripsi
		// status
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pemegang
		$this->pemegang->ViewValue = $this->pemegang->CurrentValue;
		$curVal = strval($this->pemegang->CurrentValue);
		if ($curVal != "") {
			$this->pemegang->ViewValue = $this->pemegang->lookupCacheOption($curVal);
			if ($this->pemegang->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->pemegang->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->pemegang->ViewValue = $this->pemegang->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->pemegang->ViewValue = $this->pemegang->CurrentValue;
				}
			}
		} else {
			$this->pemegang->ViewValue = NULL;
		}
		$this->pemegang->ViewCustomAttributes = "";

		// nama
		$this->nama->ViewValue = $this->nama->CurrentValue;
		$this->nama->ViewCustomAttributes = "";

		// jenis
		$this->jenis->ViewValue = $this->jenis->CurrentValue;
		$this->jenis->ViewCustomAttributes = "";

		// sepsifikasi
		$this->sepsifikasi->ViewValue = $this->sepsifikasi->CurrentValue;
		$this->sepsifikasi->ViewCustomAttributes = "";

		// tgl_terima
		$this->tgl_terima->ViewValue = $this->tgl_terima->CurrentValue;
		$this->tgl_terima->ViewValue = FormatDateTime($this->tgl_terima->ViewValue, 0);
		$this->tgl_terima->ViewCustomAttributes = "";

		// tgl_beli
		$this->tgl_beli->ViewValue = $this->tgl_beli->CurrentValue;
		$this->tgl_beli->ViewValue = FormatDateTime($this->tgl_beli->ViewValue, 0);
		$this->tgl_beli->ViewCustomAttributes = "";

		// harga
		$this->harga->ViewValue = $this->harga->CurrentValue;
		$this->harga->ViewValue = FormatNumber($this->harga->ViewValue, 0, -2, -2, -2);
		$this->harga->ViewCustomAttributes = "";

		// dokumen
		if (!EmptyValue($this->dokumen->Upload->DbValue)) {
			$this->dokumen->ViewValue = $this->dokumen->Upload->DbValue;
		} else {
			$this->dokumen->ViewValue = "";
		}
		$this->dokumen->ViewCustomAttributes = "";

		// foto
		if (!EmptyValue($this->foto->Upload->DbValue)) {
			$this->foto->ViewValue = $this->foto->Upload->DbValue;
		} else {
			$this->foto->ViewValue = "";
		}
		$this->foto->ViewCustomAttributes = "";

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->ViewCustomAttributes = "";

		// deskripsi
		$this->deskripsi->ViewValue = $this->deskripsi->CurrentValue;
		$this->deskripsi->ViewCustomAttributes = "";

		// status
		$this->status->ViewValue = $this->status->CurrentValue;
		$this->status->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// pemegang
		$this->pemegang->LinkCustomAttributes = "";
		$this->pemegang->HrefValue = "";
		$this->pemegang->TooltipValue = "";

		// nama
		$this->nama->LinkCustomAttributes = "";
		$this->nama->HrefValue = "";
		$this->nama->TooltipValue = "";

		// jenis
		$this->jenis->LinkCustomAttributes = "";
		$this->jenis->HrefValue = "";
		$this->jenis->TooltipValue = "";

		// sepsifikasi
		$this->sepsifikasi->LinkCustomAttributes = "";
		$this->sepsifikasi->HrefValue = "";
		$this->sepsifikasi->TooltipValue = "";

		// tgl_terima
		$this->tgl_terima->LinkCustomAttributes = "";
		$this->tgl_terima->HrefValue = "";
		$this->tgl_terima->TooltipValue = "";

		// tgl_beli
		$this->tgl_beli->LinkCustomAttributes = "";
		$this->tgl_beli->HrefValue = "";
		$this->tgl_beli->TooltipValue = "";

		// harga
		$this->harga->LinkCustomAttributes = "";
		$this->harga->HrefValue = "";
		$this->harga->TooltipValue = "";

		// dokumen
		$this->dokumen->LinkCustomAttributes = "";
		$this->dokumen->HrefValue = "";
		$this->dokumen->ExportHrefValue = $this->dokumen->UploadPath . $this->dokumen->Upload->DbValue;
		$this->dokumen->TooltipValue = "";

		// foto
		$this->foto->LinkCustomAttributes = "";
		$this->foto->HrefValue = "";
		$this->foto->ExportHrefValue = $this->foto->UploadPath . $this->foto->Upload->DbValue;
		$this->foto->TooltipValue = "";

		// keterangan
		$this->keterangan->LinkCustomAttributes = "";
		$this->keterangan->HrefValue = "";
		$this->keterangan->TooltipValue = "";

		// deskripsi
		$this->deskripsi->LinkCustomAttributes = "";
		$this->deskripsi->HrefValue = "";
		$this->deskripsi->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

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

		// pemegang
		$this->pemegang->EditAttrs["class"] = "form-control";
		$this->pemegang->EditCustomAttributes = "";
		$this->pemegang->EditValue = $this->pemegang->CurrentValue;
		$this->pemegang->PlaceHolder = RemoveHtml($this->pemegang->caption());

		// nama
		$this->nama->EditAttrs["class"] = "form-control";
		$this->nama->EditCustomAttributes = "";
		if (!$this->nama->Raw)
			$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
		$this->nama->EditValue = $this->nama->CurrentValue;
		$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

		// jenis
		$this->jenis->EditAttrs["class"] = "form-control";
		$this->jenis->EditCustomAttributes = "";
		if (!$this->jenis->Raw)
			$this->jenis->CurrentValue = HtmlDecode($this->jenis->CurrentValue);
		$this->jenis->EditValue = $this->jenis->CurrentValue;
		$this->jenis->PlaceHolder = RemoveHtml($this->jenis->caption());

		// sepsifikasi
		$this->sepsifikasi->EditAttrs["class"] = "form-control";
		$this->sepsifikasi->EditCustomAttributes = "";
		if (!$this->sepsifikasi->Raw)
			$this->sepsifikasi->CurrentValue = HtmlDecode($this->sepsifikasi->CurrentValue);
		$this->sepsifikasi->EditValue = $this->sepsifikasi->CurrentValue;
		$this->sepsifikasi->PlaceHolder = RemoveHtml($this->sepsifikasi->caption());

		// tgl_terima
		$this->tgl_terima->EditAttrs["class"] = "form-control";
		$this->tgl_terima->EditCustomAttributes = "";
		$this->tgl_terima->EditValue = FormatDateTime($this->tgl_terima->CurrentValue, 8);
		$this->tgl_terima->PlaceHolder = RemoveHtml($this->tgl_terima->caption());

		// tgl_beli
		$this->tgl_beli->EditAttrs["class"] = "form-control";
		$this->tgl_beli->EditCustomAttributes = "";
		$this->tgl_beli->EditValue = FormatDateTime($this->tgl_beli->CurrentValue, 8);
		$this->tgl_beli->PlaceHolder = RemoveHtml($this->tgl_beli->caption());

		// harga
		$this->harga->EditAttrs["class"] = "form-control";
		$this->harga->EditCustomAttributes = "";
		$this->harga->EditValue = $this->harga->CurrentValue;
		$this->harga->PlaceHolder = RemoveHtml($this->harga->caption());

		// dokumen
		$this->dokumen->EditAttrs["class"] = "form-control";
		$this->dokumen->EditCustomAttributes = "";
		if (!EmptyValue($this->dokumen->Upload->DbValue)) {
			$this->dokumen->EditValue = $this->dokumen->Upload->DbValue;
		} else {
			$this->dokumen->EditValue = "";
		}
		if (!EmptyValue($this->dokumen->CurrentValue))
				$this->dokumen->Upload->FileName = $this->dokumen->CurrentValue;

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

		// keterangan
		$this->keterangan->EditAttrs["class"] = "form-control";
		$this->keterangan->EditCustomAttributes = "";
		if (!$this->keterangan->Raw)
			$this->keterangan->CurrentValue = HtmlDecode($this->keterangan->CurrentValue);
		$this->keterangan->EditValue = $this->keterangan->CurrentValue;
		$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

		// deskripsi
		$this->deskripsi->EditAttrs["class"] = "form-control";
		$this->deskripsi->EditCustomAttributes = "";
		if (!$this->deskripsi->Raw)
			$this->deskripsi->CurrentValue = HtmlDecode($this->deskripsi->CurrentValue);
		$this->deskripsi->EditValue = $this->deskripsi->CurrentValue;
		$this->deskripsi->PlaceHolder = RemoveHtml($this->deskripsi->caption());

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";
		if (!$this->status->Raw)
			$this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
		$this->status->EditValue = $this->status->CurrentValue;
		$this->status->PlaceHolder = RemoveHtml($this->status->caption());

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
					$doc->exportCaption($this->pemegang);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->jenis);
					$doc->exportCaption($this->sepsifikasi);
					$doc->exportCaption($this->tgl_terima);
					$doc->exportCaption($this->tgl_beli);
					$doc->exportCaption($this->harga);
					$doc->exportCaption($this->dokumen);
					$doc->exportCaption($this->foto);
					$doc->exportCaption($this->keterangan);
					$doc->exportCaption($this->deskripsi);
					$doc->exportCaption($this->status);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->pemegang);
					$doc->exportCaption($this->nama);
					$doc->exportCaption($this->jenis);
					$doc->exportCaption($this->sepsifikasi);
					$doc->exportCaption($this->tgl_terima);
					$doc->exportCaption($this->tgl_beli);
					$doc->exportCaption($this->harga);
					$doc->exportCaption($this->dokumen);
					$doc->exportCaption($this->foto);
					$doc->exportCaption($this->keterangan);
					$doc->exportCaption($this->deskripsi);
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
						$doc->exportField($this->pemegang);
						$doc->exportField($this->nama);
						$doc->exportField($this->jenis);
						$doc->exportField($this->sepsifikasi);
						$doc->exportField($this->tgl_terima);
						$doc->exportField($this->tgl_beli);
						$doc->exportField($this->harga);
						$doc->exportField($this->dokumen);
						$doc->exportField($this->foto);
						$doc->exportField($this->keterangan);
						$doc->exportField($this->deskripsi);
						$doc->exportField($this->status);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->pemegang);
						$doc->exportField($this->nama);
						$doc->exportField($this->jenis);
						$doc->exportField($this->sepsifikasi);
						$doc->exportField($this->tgl_terima);
						$doc->exportField($this->tgl_beli);
						$doc->exportField($this->harga);
						$doc->exportField($this->dokumen);
						$doc->exportField($this->foto);
						$doc->exportField($this->keterangan);
						$doc->exportField($this->deskripsi);
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
		if ($fldparm == 'dokumen') {
			$fldName = "dokumen";
			$fileNameFld = "dokumen";
		} elseif ($fldparm == 'foto') {
			$fldName = "foto";
			$fileNameFld = "foto";
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