<?php namespace PHPMaker2020\sigap; ?>
<?php

/**
 * Table class for dinasluar
 */
class dinasluar extends DbTable
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
	public $pm;
	public $proyek;
	public $tgl;
	public $tgl_dl_awal;
	public $tgl_dl_akhir;
	public $jenis;
	public $keterangan;
	public $disetujui;
	public $dokumen;

	// Constructor
	public function __construct()
	{
		global $Language, $CurrentLanguage;
		parent::__construct();

		// Language object
		if (!isset($Language))
			$Language = new Language();
		$this->TableVar = 'dinasluar';
		$this->TableName = 'dinasluar';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`dinasluar`";
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
		$this->id = new DbField('dinasluar', 'dinasluar', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->IsAutoIncrement = TRUE; // Autoincrement field
		$this->id->IsPrimaryKey = TRUE; // Primary key field
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// pegawai
		$this->pegawai = new DbField('dinasluar', 'dinasluar', 'x_pegawai', 'pegawai', '`pegawai`', '`pegawai`', 3, 11, -1, FALSE, '`pegawai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->pegawai->Sortable = TRUE; // Allow sort
		$this->pegawai->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->pegawai->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->pegawai->Lookup = new Lookup('pegawai', 'pegawai', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->pegawai->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pegawai'] = &$this->pegawai;

		// pm
		$this->pm = new DbField('dinasluar', 'dinasluar', 'x_pm', 'pm', '`pm`', '`pm`', 3, 11, -1, FALSE, '`pm`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->pm->Sortable = TRUE; // Allow sort
		$this->pm->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->pm->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->pm->Lookup = new Lookup('pm', 'pegawai', FALSE, 'id', ["nama","","",""], [], [], [], [], [], [], '', '');
		$this->pm->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
		$this->fields['pm'] = &$this->pm;

		// proyek
		$this->proyek = new DbField('dinasluar', 'dinasluar', 'x_proyek', 'proyek', '`proyek`', '`proyek`', 200, 255, -1, FALSE, '`proyek`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->proyek->Sortable = TRUE; // Allow sort
		$this->fields['proyek'] = &$this->proyek;

		// tgl
		$this->tgl = new DbField('dinasluar', 'dinasluar', 'x_tgl', 'tgl', '`tgl`', CastDateFieldForLike("`tgl`", 0, "DB"), 135, 19, 0, FALSE, '`tgl`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl->Sortable = TRUE; // Allow sort
		$this->tgl->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl'] = &$this->tgl;

		// tgl_dl_awal
		$this->tgl_dl_awal = new DbField('dinasluar', 'dinasluar', 'x_tgl_dl_awal', 'tgl_dl_awal', '`tgl_dl_awal`', CastDateFieldForLike("`tgl_dl_awal`", 0, "DB"), 133, 10, 0, FALSE, '`tgl_dl_awal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_dl_awal->Sortable = TRUE; // Allow sort
		$this->tgl_dl_awal->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_dl_awal'] = &$this->tgl_dl_awal;

		// tgl_dl_akhir
		$this->tgl_dl_akhir = new DbField('dinasluar', 'dinasluar', 'x_tgl_dl_akhir', 'tgl_dl_akhir', '`tgl_dl_akhir`', CastDateFieldForLike("`tgl_dl_akhir`", 0, "DB"), 133, 10, 0, FALSE, '`tgl_dl_akhir`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->tgl_dl_akhir->Sortable = TRUE; // Allow sort
		$this->tgl_dl_akhir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
		$this->fields['tgl_dl_akhir'] = &$this->tgl_dl_akhir;

		// jenis
		$this->jenis = new DbField('dinasluar', 'dinasluar', 'x_jenis', 'jenis', '`jenis`', '`jenis`', 200, 255, -1, FALSE, '`jenis`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->jenis->Sortable = TRUE; // Allow sort
		$this->fields['jenis'] = &$this->jenis;

		// keterangan
		$this->keterangan = new DbField('dinasluar', 'dinasluar', 'x_keterangan', 'keterangan', '`keterangan`', '`keterangan`', 200, 255, -1, FALSE, '`keterangan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->keterangan->Sortable = TRUE; // Allow sort
		$this->fields['keterangan'] = &$this->keterangan;

		// disetujui
		$this->disetujui = new DbField('dinasluar', 'dinasluar', 'x_disetujui', 'disetujui', '`disetujui`', '`disetujui`', 200, 5, -1, FALSE, '`disetujui`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->disetujui->Sortable = TRUE; // Allow sort
		$this->disetujui->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->disetujui->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
		$this->disetujui->Lookup = new Lookup('disetujui', 'dinasluar', FALSE, '', ["","","",""], [], [], [], [], [], [], '', '');
		$this->disetujui->OptionCount = 2;
		$this->fields['disetujui'] = &$this->disetujui;

		// dokumen
		$this->dokumen = new DbField('dinasluar', 'dinasluar', 'x_dokumen', 'dokumen', '`dokumen`', '`dokumen`', 200, 255, -1, TRUE, '`dokumen`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->dokumen->Sortable = TRUE; // Allow sort
		$this->fields['dokumen'] = &$this->dokumen;
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
		return ($this->SqlFrom != "") ? $this->SqlFrom : "`dinasluar`";
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
		$this->pm->DbValue = $row['pm'];
		$this->proyek->DbValue = $row['proyek'];
		$this->tgl->DbValue = $row['tgl'];
		$this->tgl_dl_awal->DbValue = $row['tgl_dl_awal'];
		$this->tgl_dl_akhir->DbValue = $row['tgl_dl_akhir'];
		$this->jenis->DbValue = $row['jenis'];
		$this->keterangan->DbValue = $row['keterangan'];
		$this->disetujui->DbValue = $row['disetujui'];
		$this->dokumen->Upload->DbValue = $row['dokumen'];
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
			return "dinasluarlist.php";
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
		if ($pageName == "dinasluarview.php")
			return $Language->phrase("View");
		elseif ($pageName == "dinasluaredit.php")
			return $Language->phrase("Edit");
		elseif ($pageName == "dinasluaradd.php")
			return $Language->phrase("Add");
		else
			return "";
	}

	// List URL
	public function getListUrl()
	{
		return "dinasluarlist.php";
	}

	// View URL
	public function getViewUrl($parm = "")
	{
		if ($parm != "")
			$url = $this->keyUrl("dinasluarview.php", $this->getUrlParm($parm));
		else
			$url = $this->keyUrl("dinasluarview.php", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
		return $this->addMasterUrl($url);
	}

	// Add URL
	public function getAddUrl($parm = "")
	{
		if ($parm != "")
			$url = "dinasluaradd.php?" . $this->getUrlParm($parm);
		else
			$url = "dinasluaradd.php";
		return $this->addMasterUrl($url);
	}

	// Edit URL
	public function getEditUrl($parm = "")
	{
		$url = $this->keyUrl("dinasluaredit.php", $this->getUrlParm($parm));
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
		$url = $this->keyUrl("dinasluaradd.php", $this->getUrlParm($parm));
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
		return $this->keyUrl("dinasluardelete.php", $this->getUrlParm());
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
		$this->pm->setDbValue($rs->fields('pm'));
		$this->proyek->setDbValue($rs->fields('proyek'));
		$this->tgl->setDbValue($rs->fields('tgl'));
		$this->tgl_dl_awal->setDbValue($rs->fields('tgl_dl_awal'));
		$this->tgl_dl_akhir->setDbValue($rs->fields('tgl_dl_akhir'));
		$this->jenis->setDbValue($rs->fields('jenis'));
		$this->keterangan->setDbValue($rs->fields('keterangan'));
		$this->disetujui->setDbValue($rs->fields('disetujui'));
		$this->dokumen->Upload->DbValue = $rs->fields('dokumen');
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
		// pm
		// proyek
		// tgl
		// tgl_dl_awal
		// tgl_dl_akhir
		// jenis
		// keterangan
		// disetujui
		// dokumen
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pegawai
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

		// pm
		$curVal = strval($this->pm->CurrentValue);
		if ($curVal != "") {
			$this->pm->ViewValue = $this->pm->lookupCacheOption($curVal);
			if ($this->pm->ViewValue === NULL) { // Lookup from database
				$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
				$sqlWrk = $this->pm->Lookup->getSql(FALSE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = $rswrk->fields('df');
					$this->pm->ViewValue = $this->pm->displayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->pm->ViewValue = $this->pm->CurrentValue;
				}
			}
		} else {
			$this->pm->ViewValue = NULL;
		}
		$this->pm->ViewCustomAttributes = "";

		// proyek
		$this->proyek->ViewValue = $this->proyek->CurrentValue;
		$this->proyek->ViewCustomAttributes = "";

		// tgl
		$this->tgl->ViewValue = $this->tgl->CurrentValue;
		$this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, 0);
		$this->tgl->ViewCustomAttributes = "";

		// tgl_dl_awal
		$this->tgl_dl_awal->ViewValue = $this->tgl_dl_awal->CurrentValue;
		$this->tgl_dl_awal->ViewValue = FormatDateTime($this->tgl_dl_awal->ViewValue, 0);
		$this->tgl_dl_awal->ViewCustomAttributes = "";

		// tgl_dl_akhir
		$this->tgl_dl_akhir->ViewValue = $this->tgl_dl_akhir->CurrentValue;
		$this->tgl_dl_akhir->ViewValue = FormatDateTime($this->tgl_dl_akhir->ViewValue, 0);
		$this->tgl_dl_akhir->ViewCustomAttributes = "";

		// jenis
		$this->jenis->ViewValue = $this->jenis->CurrentValue;
		$this->jenis->ViewCustomAttributes = "";

		// keterangan
		$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
		$this->keterangan->ViewCustomAttributes = "";

		// disetujui
		if (strval($this->disetujui->CurrentValue) != "") {
			$this->disetujui->ViewValue = $this->disetujui->optionCaption($this->disetujui->CurrentValue);
		} else {
			$this->disetujui->ViewValue = NULL;
		}
		$this->disetujui->ViewCustomAttributes = "";

		// dokumen
		if (!EmptyValue($this->dokumen->Upload->DbValue)) {
			$this->dokumen->ViewValue = $this->dokumen->Upload->DbValue;
		} else {
			$this->dokumen->ViewValue = "";
		}
		$this->dokumen->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// pegawai
		$this->pegawai->LinkCustomAttributes = "";
		$this->pegawai->HrefValue = "";
		$this->pegawai->TooltipValue = "";

		// pm
		$this->pm->LinkCustomAttributes = "";
		$this->pm->HrefValue = "";
		$this->pm->TooltipValue = "";

		// proyek
		$this->proyek->LinkCustomAttributes = "";
		$this->proyek->HrefValue = "";
		$this->proyek->TooltipValue = "";

		// tgl
		$this->tgl->LinkCustomAttributes = "";
		$this->tgl->HrefValue = "";
		$this->tgl->TooltipValue = "";

		// tgl_dl_awal
		$this->tgl_dl_awal->LinkCustomAttributes = "";
		$this->tgl_dl_awal->HrefValue = "";
		$this->tgl_dl_awal->TooltipValue = "";

		// tgl_dl_akhir
		$this->tgl_dl_akhir->LinkCustomAttributes = "";
		$this->tgl_dl_akhir->HrefValue = "";
		$this->tgl_dl_akhir->TooltipValue = "";

		// jenis
		$this->jenis->LinkCustomAttributes = "";
		$this->jenis->HrefValue = "";
		$this->jenis->TooltipValue = "";

		// keterangan
		$this->keterangan->LinkCustomAttributes = "";
		$this->keterangan->HrefValue = "";
		$this->keterangan->TooltipValue = "";

		// disetujui
		$this->disetujui->LinkCustomAttributes = "";
		$this->disetujui->HrefValue = "";
		$this->disetujui->TooltipValue = "";

		// dokumen
		$this->dokumen->LinkCustomAttributes = "";
		$this->dokumen->HrefValue = "";
		$this->dokumen->ExportHrefValue = $this->dokumen->UploadPath . $this->dokumen->Upload->DbValue;
		$this->dokumen->TooltipValue = "";

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

		// pm
		$this->pm->EditAttrs["class"] = "form-control";
		$this->pm->EditCustomAttributes = "";

		// proyek
		$this->proyek->EditAttrs["class"] = "form-control";
		$this->proyek->EditCustomAttributes = "";
		if (!$this->proyek->Raw)
			$this->proyek->CurrentValue = HtmlDecode($this->proyek->CurrentValue);
		$this->proyek->EditValue = $this->proyek->CurrentValue;
		$this->proyek->PlaceHolder = RemoveHtml($this->proyek->caption());

		// tgl
		// tgl_dl_awal

		$this->tgl_dl_awal->EditAttrs["class"] = "form-control";
		$this->tgl_dl_awal->EditCustomAttributes = "";
		$this->tgl_dl_awal->EditValue = FormatDateTime($this->tgl_dl_awal->CurrentValue, 8);
		$this->tgl_dl_awal->PlaceHolder = RemoveHtml($this->tgl_dl_awal->caption());

		// tgl_dl_akhir
		$this->tgl_dl_akhir->EditAttrs["class"] = "form-control";
		$this->tgl_dl_akhir->EditCustomAttributes = "";
		$this->tgl_dl_akhir->EditValue = FormatDateTime($this->tgl_dl_akhir->CurrentValue, 8);
		$this->tgl_dl_akhir->PlaceHolder = RemoveHtml($this->tgl_dl_akhir->caption());

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
		if (!$this->keterangan->Raw)
			$this->keterangan->CurrentValue = HtmlDecode($this->keterangan->CurrentValue);
		$this->keterangan->EditValue = $this->keterangan->CurrentValue;
		$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

		// disetujui
		$this->disetujui->EditAttrs["class"] = "form-control";
		$this->disetujui->EditCustomAttributes = "";
		$this->disetujui->EditValue = $this->disetujui->options(TRUE);

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
					$doc->exportCaption($this->pm);
					$doc->exportCaption($this->proyek);
					$doc->exportCaption($this->tgl);
					$doc->exportCaption($this->tgl_dl_awal);
					$doc->exportCaption($this->tgl_dl_akhir);
					$doc->exportCaption($this->jenis);
					$doc->exportCaption($this->keterangan);
					$doc->exportCaption($this->disetujui);
					$doc->exportCaption($this->dokumen);
				} else {
					$doc->exportCaption($this->id);
					$doc->exportCaption($this->pegawai);
					$doc->exportCaption($this->pm);
					$doc->exportCaption($this->proyek);
					$doc->exportCaption($this->tgl);
					$doc->exportCaption($this->tgl_dl_awal);
					$doc->exportCaption($this->tgl_dl_akhir);
					$doc->exportCaption($this->jenis);
					$doc->exportCaption($this->keterangan);
					$doc->exportCaption($this->disetujui);
					$doc->exportCaption($this->dokumen);
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
						$doc->exportField($this->pm);
						$doc->exportField($this->proyek);
						$doc->exportField($this->tgl);
						$doc->exportField($this->tgl_dl_awal);
						$doc->exportField($this->tgl_dl_akhir);
						$doc->exportField($this->jenis);
						$doc->exportField($this->keterangan);
						$doc->exportField($this->disetujui);
						$doc->exportField($this->dokumen);
					} else {
						$doc->exportField($this->id);
						$doc->exportField($this->pegawai);
						$doc->exportField($this->pm);
						$doc->exportField($this->proyek);
						$doc->exportField($this->tgl);
						$doc->exportField($this->tgl_dl_awal);
						$doc->exportField($this->tgl_dl_akhir);
						$doc->exportField($this->jenis);
						$doc->exportField($this->keterangan);
						$doc->exportField($this->disetujui);
						$doc->exportField($this->dokumen);
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