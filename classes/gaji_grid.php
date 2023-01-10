<?php
namespace PHPMaker2020\sigap;

/**
 * Page class
 */
class gaji_grid extends gaji
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}";

	// Table name
	public $TableName = 'gaji';

	// Page object name
	public $PageObjName = "gaji_grid";

	// Grid form hidden field names
	public $FormName = "fgajigrid";
	public $FormActionName = "k_action";
	public $FormKeyName = "k_key";
	public $FormOldKeyName = "k_oldkey";
	public $FormBlankRowName = "k_blankrow";
	public $FormKeyCountName = "key_count";

	// Page URLs
	public $AddUrl;
	public $EditUrl;
	public $CopyUrl;
	public $DeleteUrl;
	public $ViewUrl;
	public $ListUrl;

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading != "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading != "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		$url = CurrentPageName() . "?";
		if ($this->UseTokenInUrl)
			$url .= "t=" . $this->TableVar . "&"; // Add page token
		return $url;
	}

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = TRUE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message != "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fas fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage != "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fas fa-exclamation"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage != "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fas fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage != "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fas fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = [];

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message != "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage != "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage != "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage != "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header != "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer != "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(Config("TOKEN_NAME")) === NULL)
			return FALSE;
		$fn = Config("CHECK_TOKEN_FUNC");
		if (is_callable($fn))
			return $fn(Post(Config("TOKEN_NAME")), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = Config("CREATE_TOKEN_FUNC"); // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $DashboardReport;
		global $UserTable;

		// Check token
		$this->CheckToken = Config("CHECK_TOKEN");

		// Initialize
		$this->FormActionName .= "_" . $this->FormName;
		$this->FormKeyName .= "_" . $this->FormName;
		$this->FormOldKeyName .= "_" . $this->FormName;
		$this->FormBlankRowName .= "_" . $this->FormName;
		$this->FormKeyCountName .= "_" . $this->FormName;
		$GLOBALS["Grid"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (gaji)
		if (!isset($GLOBALS["gaji"]) || get_class($GLOBALS["gaji"]) == PROJECT_NAMESPACE . "gaji") {
			$GLOBALS["gaji"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["gaji"];

		}
		$this->AddUrl = "gajiadd.php";

		// Table object (pegawai)
		if (!isset($GLOBALS['pegawai']))
			$GLOBALS['pegawai'] = new pegawai();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'gaji');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = $this->getConnection();

		// User table object (pegawai)
		$UserTable = $UserTable ?: new pegawai();

		// List options
		$this->ListOptions = new ListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Other options
		if (!$this->OtherOptions)
			$this->OtherOptions = new ListOptionsArray();
		$this->OtherOptions["addedit"] = new ListOptions("div");
		$this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Export
		global $gaji;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($gaji);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}

//		$GLOBALS["Table"] = &$GLOBALS["MasterTable"];
		unset($GLOBALS["Grid"]);
		if ($url === "")
			return;
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url != "") {
			if (!Config("DEBUG") && ob_get_length())
				ob_end_clean();
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = [];
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = [];
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									Config("API_FIELD_NAME") . "=" . $fld->Param . "&" .
									Config("API_KEY_NAME") . "=" . rawurlencode($this->getRecordKeyValue($ar)))); //*** need to add this? API may not be in the same folder
								$row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
								$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
									Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
									"fn=" . Encrypt($fld->physicalUploadPath() . $val)));
								$row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
							} else { // Multiple files
								$files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
								$ar = [];
								foreach ($files as $file) {
									$url = FullUrl(GetApiUrl(Config("API_FILE_ACTION"),
										Config("API_OBJECT_NAME") . "=" . $fld->TableVar . "&" .
										"fn=" . Encrypt($fld->physicalUploadPath() . $file)));
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
		if ($this->isAdd() || $this->isCopy() || $this->isGridAdd())
			$this->id->Visible = FALSE;
		if ($this->isAddOrEdit())
			$this->datetime->Visible = FALSE;
	}

	// Lookup data
	public function lookup()
	{
		global $Language, $Security;
		if (!isset($Language))
			$Language = new Language(Config("LANGUAGE_FOLDER"), Post("language", ""));

		// Set up API request
		if (!ValidApiRequest())
			return FALSE;
		$this->setupApiSecurity();

		// Get lookup object
		$fieldName = Post("field");
		if (!array_key_exists($fieldName, $this->fields))
			return FALSE;
		$lookupField = $this->fields[$fieldName];
		$lookup = $lookupField->Lookup;
		if ($lookup === NULL)
			return FALSE;
		$tbl = $lookup->getTable();
		if (!$Security->allowLookup(Config("PROJECT_ID") . $tbl->TableName)) // Lookup permission
			return FALSE;

		// Get lookup parameters
		$lookupType = Post("ajax", "unknown");
		$pageSize = -1;
		$offset = -1;
		$searchValue = "";
		if (SameText($lookupType, "modal")) {
			$searchValue = Post("sv", "");
			$pageSize = Post("recperpage", 10);
			$offset = Post("start", 0);
		} elseif (SameText($lookupType, "autosuggest")) {
			$searchValue = Param("q", "");
			$pageSize = Param("n", -1);
			$pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
			if ($pageSize <= 0)
				$pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
			$start = Param("start", -1);
			$start = is_numeric($start) ? (int)$start : -1;
			$page = Param("page", -1);
			$page = is_numeric($page) ? (int)$page : -1;
			$offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
		}
		$userSelect = Decrypt(Post("s", ""));
		$userFilter = Decrypt(Post("f", ""));
		$userOrderBy = Decrypt(Post("o", ""));
		$keys = Post("keys");
		$lookup->LookupType = $lookupType; // Lookup type
		if ($keys !== NULL) { // Selected records from modal
			if (is_array($keys))
				$keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
			$lookup->FilterFields = []; // Skip parent fields if any
			$lookup->FilterValues[] = $keys; // Lookup values
			$pageSize = -1; // Show all records
		} else { // Lookup values
			$lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
		}
		$cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
		for ($i = 1; $i <= $cnt; $i++)
			$lookup->FilterValues[] = Post("v" . $i, "");
		$lookup->SearchValue = $searchValue;
		$lookup->PageSize = $pageSize;
		$lookup->Offset = $offset;
		if ($userSelect != "")
			$lookup->UserSelect = $userSelect;
		if ($userFilter != "")
			$lookup->UserFilter = $userFilter;
		if ($userOrderBy != "")
			$lookup->UserOrderBy = $userOrderBy;
		$lookup->toJson($this); // Use settings from current page
	}

	// Set up API security
	public function setupApiSecurity()
	{
		global $Security;

		// Setup security for API request
		if ($Security->isLoggedIn()) $Security->TablePermission_Loading();
		$Security->loadCurrentUserLevel(Config("PROJECT_ID") . $this->TableName);
		if ($Security->isLoggedIn()) $Security->TablePermission_Loaded();
	}

	// Class variables
	public $ListOptions; // List options
	public $ExportOptions; // Export options
	public $SearchOptions; // Search options
	public $OtherOptions; // Other options
	public $FilterOptions; // Filter options
	public $ImportOptions; // Import options
	public $ListActions; // List actions
	public $SelectedCount = 0;
	public $SelectedIndex = 0;
	public $ShowOtherOptions = FALSE;
	public $DisplayRecords = 20;
	public $StartRecord;
	public $StopRecord;
	public $TotalRecords = 0;
	public $RecordRange = 10;
	public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
	public $DefaultSearchWhere = ""; // Default search WHERE clause
	public $SearchWhere = ""; // Search WHERE clause
	public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
	public $SearchRowCount = 0; // For extended search
	public $SearchColumnCount = 0; // For extended search
	public $SearchFieldsPerRow = 1; // For extended search
	public $RecordCount = 0; // Record count
	public $EditRowCount;
	public $StartRowCount = 1;
	public $RowCount = 0;
	public $Attrs = []; // Row attributes and cell attributes
	public $RowIndex = 0; // Row index
	public $KeyCount = 0; // Key count
	public $RowAction = ""; // Row action
	public $RowOldKey = ""; // Row old key (for copy)
	public $MultiColumnClass = "col-sm";
	public $MultiColumnEditClass = "w-100";
	public $DbMasterFilter = ""; // Master filter
	public $DbDetailFilter = ""; // Detail filter
	public $MasterRecordExists;
	public $MultiSelectKey;
	public $Command;
	public $RestoreSearch = FALSE;
	public $DetailPages;
	public $OldRecordset;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SearchError;

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canList()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				$this->terminate(GetUrl("index.php"));
				return;
			}
		}

		// Get grid add count
		$gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->setupListOptions();
		$this->id->Visible = FALSE;
		$this->pid->Visible = FALSE;
		$this->datetime->Visible = FALSE;
		$this->pegawai->setVisibility();
		$this->jenjang_id->setVisibility();
		$this->jabatan_id->setVisibility();
		$this->month->Visible = FALSE;
		$this->lama_kerja->setVisibility();
		$this->type->setVisibility();
		$this->jenis_guru->setVisibility();
		$this->tambahan->setVisibility();
		$this->periode->setVisibility();
		$this->tunjangan_periode->setVisibility();
		$this->kehadiran->setVisibility();
		$this->value_kehadiran->setVisibility();
		$this->jp->setVisibility();
		$this->gapok->setVisibility();
		$this->total_gapok->setVisibility();
		$this->lembur->setVisibility();
		$this->value_lembur->setVisibility();
		$this->value_reward->setVisibility();
		$this->value_inval->setVisibility();
		$this->piket_count->setVisibility();
		$this->value_piket->setVisibility();
		$this->tugastambahan->setVisibility();
		$this->tj_jabatan->setVisibility();
		$this->sub_total->setVisibility();
		$this->potongan->setVisibility();
		$this->penyesuaian->setVisibility();
		$this->total->setVisibility();
		$this->hideFieldsForAddEdit();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up master detail parameters
		$this->setupMasterParms();

		// Setup other options
		$this->setupOtherOptions();

		// Set up lookup cache
		$this->setupLookupOptions($this->pegawai);
		$this->setupLookupOptions($this->jenjang_id);
		$this->setupLookupOptions($this->jabatan_id);

		// Search filters
		$srchAdvanced = ""; // Advanced search filter
		$srchBasic = ""; // Basic search filter
		$filter = "";

		// Get command
		$this->Command = strtolower(Get("cmd"));
		if ($this->isPageRequest()) { // Validate request

			// Set up records per page
			$this->setupDisplayRecords();

			// Handle reset command
			$this->resetCmd();

			// Hide list options
			if ($this->isExport()) {
				$this->ListOptions->hideAllOptions(["sequence"]);
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->isGridAdd() || $this->isGridEdit()) {
				$this->ListOptions->hideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->isGridAdd() || $this->isGridEdit()) {
					$item = $this->ListOptions["griddelete"];
					if ($item)
						$item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->setupSortOrder();
		}

		// Restore display records
		if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
			$this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecords = 20; // Load default
			$this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
		}

		// Load Sorting Order
		if ($this->Command != "json")
			$this->loadSortOrder();

		// Build filter
		$filter = "";
		if (!$Security->canList())
			$filter = "(0=1)"; // Filter all records

		// Restore master/detail filter
		$this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
		AddFilter($filter, $this->DbDetailFilter);
		AddFilter($filter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "m_sd") {
			global $m_sd;
			$rsmaster = $m_sd->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("m_sdlist.php"); // Return to master page
			} else {
				$m_sd->loadListRowValues($rsmaster);
				$m_sd->RowType = ROWTYPE_MASTER; // Master row
				$m_sd->renderListRow();
				$rsmaster->close();
			}
		}

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSql = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $filter;
		} else {
			$this->setSessionWhere($filter);
			$this->CurrentFilter = "";
		}
		if ($this->isGridAdd()) {
			if ($this->CurrentMode == "copy") {
				$selectLimit = $this->UseSelectLimit;
				if ($selectLimit) {
					$this->TotalRecords = $this->listRecordCount();
					$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
				} else {
					if ($this->Recordset = $this->loadRecordset())
						$this->TotalRecords = $this->Recordset->RecordCount();
				}
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->TotalRecords;
			} else {
				$this->CurrentFilter = "0=1";
				$this->StartRecord = 1;
				$this->DisplayRecords = $this->GridAddRowCount;
			}
			$this->TotalRecords = $this->DisplayRecords;
			$this->StopRecord = $this->DisplayRecords;
		} else {
			$selectLimit = $this->UseSelectLimit;
			if ($selectLimit) {
				$this->TotalRecords = $this->listRecordCount();
			} else {
				if ($this->Recordset = $this->loadRecordset())
					$this->TotalRecords = $this->Recordset->RecordCount();
			}
			$this->StartRecord = 1;
			$this->DisplayRecords = $this->TotalRecords; // Display all records
			if ($selectLimit)
				$this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
		}

		// Normal return
		if (IsApi()) {
			$rows = $this->getRecordsFromRecordset($this->Recordset);
			$this->Recordset->close();
			WriteJson(["success" => TRUE, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
			$this->terminate(TRUE);
		}

		// Set up pager
		$this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);
	}

	// Set up number of records displayed per page
	protected function setupDisplayRecords()
	{
		$wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
		if ($wrk != "") {
			if (is_numeric($wrk)) {
				$this->DisplayRecords = (int)$wrk;
			} else {
				if (SameText($wrk, "all")) { // Display all records
					$this->DisplayRecords = -1;
				} else {
					$this->DisplayRecords = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecords); // Save to Session

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Exit inline mode
	protected function clearInlineMode()
	{
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	protected function gridAddMode()
	{
		$this->CurrentAction = "gridadd";
		$_SESSION[SESSION_INLINE_MODE] = "gridadd";
		$this->hideFieldsForAddEdit();
	}

	// Switch to Grid Edit mode
	protected function gridEditMode()
	{
		$this->CurrentAction = "gridedit";
		$_SESSION[SESSION_INLINE_MODE] = "gridedit";
		$this->hideFieldsForAddEdit();
	}

	// Perform update to grid
	public function gridUpdate()
	{
		global $Language, $CurrentForm, $FormError;
		$gridUpdate = TRUE;

		// Get old recordset
		$this->CurrentFilter = $this->buildKeyFilter();
		if ($this->CurrentFilter == "")
			$this->CurrentFilter = "0=1";
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		if ($rs = $conn->execute($sql)) {
			$rsold = $rs->getRows();
			$rs->close();
		}

		// Call Grid Updating event
		if (!$this->Grid_Updating($rsold)) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
			return FALSE;
		}
		$key = "";

		// Update row index and get row key
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Update all rows based on key
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
			$CurrentForm->Index = $rowindex;
			$rowkey = strval($CurrentForm->getValue($this->FormKeyName));
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));

			// Load all values and keys
			if ($rowaction != "insertdelete") { // Skip insert then deleted rows
				$this->loadFormValues(); // Get form values
				if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
					$gridUpdate = $this->setupKeyValues($rowkey); // Set up key values
				} else {
					$gridUpdate = TRUE;
				}

				// Skip empty row
				if ($rowaction == "insert" && $this->emptyRow()) {

					// No action required
				// Validate form and insert/update/delete record

				} elseif ($gridUpdate) {
					if ($rowaction == "delete") {
						$this->CurrentFilter = $this->getRecordFilter();
						$gridUpdate = $this->deleteRows(); // Delete this row
					} else if (!$this->validateForm()) {
						$gridUpdate = FALSE; // Form error, reset action
						$this->setFailureMessage($FormError);
					} else {
						if ($rowaction == "insert") {
							$gridUpdate = $this->addRow(); // Insert this row
						} else {
							if ($rowkey != "") {
								$this->SendEmail = FALSE; // Do not send email on update success
								$gridUpdate = $this->editRow(); // Update this row
							}
						} // End update
					}
				}
				if ($gridUpdate) {
					if ($key != "")
						$key .= ", ";
					$key .= $rowkey;
				} else {
					break;
				}
			}
		}
		if ($gridUpdate) {

			// Get new recordset
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Updated event
			$this->Grid_Updated($rsold, $rsnew);
			$this->clearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
		}
		return $gridUpdate;
	}

	// Build filter for all keys
	protected function buildKeyFilter()
	{
		global $CurrentForm;
		$wrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$CurrentForm->Index = $rowindex;
		$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		while ($thisKey != "") {
			if ($this->setupKeyValues($thisKey)) {
				$filter = $this->getRecordFilter();
				if ($wrkFilter != "")
					$wrkFilter .= " OR ";
				$wrkFilter .= $filter;
			} else {
				$wrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$CurrentForm->Index = $rowindex;
			$thisKey = strval($CurrentForm->getValue($this->FormKeyName));
		}
		return $wrkFilter;
	}

	// Set up key values
	protected function setupKeyValues($key)
	{
		$arKeyFlds = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
		if (count($arKeyFlds) >= 1) {
			$this->id->setOldValue($arKeyFlds[0]);
			if (!is_numeric($this->id->OldValue))
				return FALSE;
		}
		return TRUE;
	}

	// Perform Grid Add
	public function gridInsert()
	{
		global $Language, $CurrentForm, $FormError;
		$rowindex = 1;
		$gridInsert = FALSE;
		$conn = $this->getConnection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
			return FALSE;
		}

		// Init key filter
		$wrkfilter = "";
		$addcnt = 0;
		$key = "";

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "" && $rowaction != "insert")
				continue; // Skip
			if ($rowaction == "insert") {
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
				$this->loadOldRecord(); // Load old record
			}
			$this->loadFormValues(); // Get form values
			if (!$this->emptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->validateForm()) {
					$gridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($FormError);
				} else {
					$gridInsert = $this->addRow($this->OldRecordset); // Insert this row
				}
				if ($gridInsert) {
					if ($key != "")
						$key .= Config("COMPOSITE_KEY_SEPARATOR");
					$key .= $this->id->CurrentValue;

					// Add filter for this record
					$filter = $this->getRecordFilter();
					if ($wrkfilter != "")
						$wrkfilter .= " OR ";
					$wrkfilter .= $filter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->clearInlineMode(); // Clear grid add mode and return
			return TRUE;
		}
		if ($gridInsert) {

			// Get new recordset
			$this->CurrentFilter = $wrkfilter;
			$sql = $this->getCurrentSql();
			if ($rs = $conn->execute($sql)) {
				$rsnew = $rs->getRows();
				$rs->close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			$this->clearInlineMode(); // Clear grid add mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
		}
		return $gridInsert;
	}

	// Check if empty row
	public function emptyRow()
	{
		global $CurrentForm;
		if ($CurrentForm->hasValue("x_pegawai") && $CurrentForm->hasValue("o_pegawai") && $this->pegawai->CurrentValue != $this->pegawai->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jenjang_id") && $CurrentForm->hasValue("o_jenjang_id") && $this->jenjang_id->CurrentValue != $this->jenjang_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jabatan_id") && $CurrentForm->hasValue("o_jabatan_id") && $this->jabatan_id->CurrentValue != $this->jabatan_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_lama_kerja") && $CurrentForm->hasValue("o_lama_kerja") && $this->lama_kerja->CurrentValue != $this->lama_kerja->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_type") && $CurrentForm->hasValue("o_type") && $this->type->CurrentValue != $this->type->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jenis_guru") && $CurrentForm->hasValue("o_jenis_guru") && $this->jenis_guru->CurrentValue != $this->jenis_guru->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tambahan") && $CurrentForm->hasValue("o_tambahan") && $this->tambahan->CurrentValue != $this->tambahan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_periode") && $CurrentForm->hasValue("o_periode") && $this->periode->CurrentValue != $this->periode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tunjangan_periode") && $CurrentForm->hasValue("o_tunjangan_periode") && $this->tunjangan_periode->CurrentValue != $this->tunjangan_periode->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kehadiran") && $CurrentForm->hasValue("o_kehadiran") && $this->kehadiran->CurrentValue != $this->kehadiran->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_value_kehadiran") && $CurrentForm->hasValue("o_value_kehadiran") && $this->value_kehadiran->CurrentValue != $this->value_kehadiran->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jp") && $CurrentForm->hasValue("o_jp") && $this->jp->CurrentValue != $this->jp->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_gapok") && $CurrentForm->hasValue("o_gapok") && $this->gapok->CurrentValue != $this->gapok->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_total_gapok") && $CurrentForm->hasValue("o_total_gapok") && $this->total_gapok->CurrentValue != $this->total_gapok->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_lembur") && $CurrentForm->hasValue("o_lembur") && $this->lembur->CurrentValue != $this->lembur->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_value_lembur") && $CurrentForm->hasValue("o_value_lembur") && $this->value_lembur->CurrentValue != $this->value_lembur->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_value_reward") && $CurrentForm->hasValue("o_value_reward") && $this->value_reward->CurrentValue != $this->value_reward->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_value_inval") && $CurrentForm->hasValue("o_value_inval") && $this->value_inval->CurrentValue != $this->value_inval->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_piket_count") && $CurrentForm->hasValue("o_piket_count") && $this->piket_count->CurrentValue != $this->piket_count->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_value_piket") && $CurrentForm->hasValue("o_value_piket") && $this->value_piket->CurrentValue != $this->value_piket->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tugastambahan") && $CurrentForm->hasValue("o_tugastambahan") && $this->tugastambahan->CurrentValue != $this->tugastambahan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tj_jabatan") && $CurrentForm->hasValue("o_tj_jabatan") && $this->tj_jabatan->CurrentValue != $this->tj_jabatan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_sub_total") && $CurrentForm->hasValue("o_sub_total") && $this->sub_total->CurrentValue != $this->sub_total->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_potongan") && $CurrentForm->hasValue("o_potongan") && $this->potongan->CurrentValue != $this->potongan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_penyesuaian") && $CurrentForm->hasValue("o_penyesuaian") && $this->penyesuaian->CurrentValue != $this->penyesuaian->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_total") && $CurrentForm->hasValue("o_total") && $this->total->CurrentValue != $this->total->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	public function validateGridForm()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else if (!$this->validateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	public function getGridFormValues()
	{
		global $CurrentForm;

		// Get row count
		$CurrentForm->Index = -1;
		$rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = [];

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$CurrentForm->Index = $rowindex;
			$rowaction = strval($CurrentForm->getValue($this->FormActionName));
			if ($rowaction != "delete" && $rowaction != "insertdelete") {
				$this->loadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->emptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->getFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	public function restoreCurrentRowFormValues($idx)
	{
		global $CurrentForm;

		// Get row based on current index
		$CurrentForm->Index = $idx;
		$this->loadFormValues(); // Load form values
	}

	// Set up sort parameters
	protected function setupSortOrder()
	{

		// Check for "order" parameter
		if (Get("order") !== NULL) {
			$this->CurrentOrder = Get("order");
			$this->CurrentOrderType = Get("ordertype", "");
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	protected function loadSortOrder()
	{
		$orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($orderBy == "") {
			if ($this->getSqlOrderBy() != "") {
				$orderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($orderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)

	protected function resetCmd()
	{

		// Check if reset command
		if (StartsString("reset", $this->Command)) {

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->pid->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$orderBy = "";
				$this->setSessionOrderBy($orderBy);
			}

			// Reset start position
			$this->StartRecord = 1;
			$this->setStartRecordNumber($this->StartRecord);
		}
	}

	// Set up list options
	protected function setupListOptions()
	{
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

		// Add group option item
		$item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canView();
		$item->OnLeft = TRUE;

		// "edit"
		$item = &$this->ListOptions->add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$item = &$this->ListOptions->add("copy");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canAdd();
		$item->OnLeft = TRUE;

		// "delete"
		$item = &$this->ListOptions->add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->canDelete();
		$item->OnLeft = TRUE;

		// "sequence"
		$item = &$this->ListOptions->add("sequence");
		$item->CssClass = "text-nowrap";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;

		//$this->ListOptions->ButtonClass = ""; // Class for button group
		// Call ListOptions_Load event

		$this->ListOptions_Load();
		$item = $this->ListOptions[$this->ListOptions->GroupOptionName];
		$item->Visible = $this->ListOptions->groupOptionVisible();
	}

	// Render list options
	public function renderListOptions()
	{
		global $Security, $Language, $CurrentForm;
		$this->ListOptions->loadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode != "view") {
			$CurrentForm->Index = $this->RowIndex;
			$actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$keyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
			if ($CurrentForm->hasValue($this->FormOldKeyName))
				$this->RowOldKey = strval($CurrentForm->getValue($this->FormOldKeyName));
			if ($this->RowOldKey != "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($this->RowOldKey) . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $CurrentForm->getValue($this->FormKeyName);
				$this->setupKeyValues($rowkey);

				// Reload hidden key for delete
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . HtmlEncode($rowkey) . "\">";
			}
			if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
		}

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
				$options = &$this->ListOptions;
				$options->UseButtonGroup = TRUE; // Use button group for grid delete button
				$opt = $options["griddelete"];
				if (!$Security->canDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$opt->Body = "&nbsp;";
				} else {
					$opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
				}
			}
		}

		// "sequence"
		$opt = $this->ListOptions["sequence"];
		$opt->Body = FormatSequenceNumber($this->RecordCount);
		if ($this->CurrentMode == "view") { // View mode

		// "view"
		$opt = $this->ListOptions["view"];
		$viewcaption = HtmlTitle($Language->phrase("ViewLink"));
		if ($Security->canView()) {
			$opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode($this->ViewUrl) . "\">" . $Language->phrase("ViewLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "edit"
		$opt = $this->ListOptions["edit"];
		$editcaption = HtmlTitle($Language->phrase("EditLink"));
		if ($Security->canEdit()) {
			$opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode($this->EditUrl) . "\">" . $Language->phrase("EditLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "copy"
		$opt = $this->ListOptions["copy"];
		$copycaption = HtmlTitle($Language->phrase("CopyLink"));
		if ($Security->canAdd()) {
			$opt->Body = "<a class=\"ew-row-link ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode($this->CopyUrl) . "\">" . $Language->phrase("CopyLink") . "</a>";
		} else {
			$opt->Body = "";
		}

		// "delete"
		$opt = $this->ListOptions["delete"];
		if ($Security->canDelete())
			$opt->Body = "<a class=\"ew-row-link ew-delete\"" . "" . " title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" href=\"" . HtmlEncode($this->DeleteUrl) . "\">" . $Language->phrase("DeleteLink") . "</a>";
		else
			$opt->Body = "";
		} // End View mode
		if ($this->CurrentMode == "edit" && is_numeric($this->RowIndex) && $this->RowAction != "delete") {
			$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $keyName . "\" id=\"" . $keyName . "\" value=\"" . $this->id->CurrentValue . "\">";
		}
		$this->renderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set record key
	public function setRecordKey(&$key, $rs)
	{
		$key = "";
		if ($key != "")
			$key .= Config("COMPOSITE_KEY_SEPARATOR");
		$key .= $rs->fields('id');
	}

	// Set up other options
	protected function setupOtherOptions()
	{
		global $Language, $Security;
		$option = $this->OtherOptions["addedit"];
		$option->UseDropDownButton = FALSE;
		$option->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
		$option->UseButtonGroup = TRUE;

		//$option->ButtonClass = ""; // Class for button group
		$item = &$option->add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Add
		if ($this->CurrentMode == "view") { // Check view mode
			$item = &$option->add("add");
			$addcaption = HtmlTitle($Language->phrase("AddLink"));
			$this->AddUrl = $this->getAddUrl();
			$item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode($this->AddUrl) . "\">" . $Language->phrase("AddLink") . "</a>";
			$item->Visible = $this->AddUrl != "" && $Security->canAdd();
		}
	}

	// Render other options
	public function renderOtherOptions()
	{
		global $Language, $Security;
		$options = &$this->OtherOptions;
		if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && !$this->isConfirm()) { // Check add/copy/edit mode
			if ($this->AllowAddDeleteRow) {
				$option = $options["addedit"];
				$option->UseDropDownButton = FALSE;
				$item = &$option->add("addblankrow");
				$item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
				$item->Visible = $Security->canAdd();
				$this->ShowOtherOptions = $item->Visible;
			}
		}
		if ($this->CurrentMode == "view") { // Check view mode
			$option = $options["addedit"];
			$item = $option["add"];
			$this->ShowOtherOptions = $item && $item->Visible;
		}
	}

// Set up list options (extended codes)
	protected function setupListOptionsExt()
	{

		// Hide detail items for dropdown if necessary
		$this->ListOptions->hideDetailItemsForDropDown();
	}

// Render list options (extended codes)
	protected function renderListOptionsExt()
	{
		global $Security, $Language;
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->pid->CurrentValue = NULL;
		$this->pid->OldValue = $this->pid->CurrentValue;
		$this->datetime->CurrentValue = NULL;
		$this->datetime->OldValue = $this->datetime->CurrentValue;
		$this->pegawai->CurrentValue = NULL;
		$this->pegawai->OldValue = $this->pegawai->CurrentValue;
		$this->jenjang_id->CurrentValue = NULL;
		$this->jenjang_id->OldValue = $this->jenjang_id->CurrentValue;
		$this->jabatan_id->CurrentValue = NULL;
		$this->jabatan_id->OldValue = $this->jabatan_id->CurrentValue;
		$this->month->CurrentValue = NULL;
		$this->month->OldValue = $this->month->CurrentValue;
		$this->lama_kerja->CurrentValue = NULL;
		$this->lama_kerja->OldValue = $this->lama_kerja->CurrentValue;
		$this->type->CurrentValue = NULL;
		$this->type->OldValue = $this->type->CurrentValue;
		$this->jenis_guru->CurrentValue = NULL;
		$this->jenis_guru->OldValue = $this->jenis_guru->CurrentValue;
		$this->tambahan->CurrentValue = NULL;
		$this->tambahan->OldValue = $this->tambahan->CurrentValue;
		$this->periode->CurrentValue = NULL;
		$this->periode->OldValue = $this->periode->CurrentValue;
		$this->tunjangan_periode->CurrentValue = NULL;
		$this->tunjangan_periode->OldValue = $this->tunjangan_periode->CurrentValue;
		$this->kehadiran->CurrentValue = NULL;
		$this->kehadiran->OldValue = $this->kehadiran->CurrentValue;
		$this->value_kehadiran->CurrentValue = NULL;
		$this->value_kehadiran->OldValue = $this->value_kehadiran->CurrentValue;
		$this->jp->CurrentValue = NULL;
		$this->jp->OldValue = $this->jp->CurrentValue;
		$this->gapok->CurrentValue = NULL;
		$this->gapok->OldValue = $this->gapok->CurrentValue;
		$this->total_gapok->CurrentValue = NULL;
		$this->total_gapok->OldValue = $this->total_gapok->CurrentValue;
		$this->lembur->CurrentValue = NULL;
		$this->lembur->OldValue = $this->lembur->CurrentValue;
		$this->value_lembur->CurrentValue = NULL;
		$this->value_lembur->OldValue = $this->value_lembur->CurrentValue;
		$this->value_reward->CurrentValue = NULL;
		$this->value_reward->OldValue = $this->value_reward->CurrentValue;
		$this->value_inval->CurrentValue = NULL;
		$this->value_inval->OldValue = $this->value_inval->CurrentValue;
		$this->piket_count->CurrentValue = NULL;
		$this->piket_count->OldValue = $this->piket_count->CurrentValue;
		$this->value_piket->CurrentValue = NULL;
		$this->value_piket->OldValue = $this->value_piket->CurrentValue;
		$this->tugastambahan->CurrentValue = NULL;
		$this->tugastambahan->OldValue = $this->tugastambahan->CurrentValue;
		$this->tj_jabatan->CurrentValue = NULL;
		$this->tj_jabatan->OldValue = $this->tj_jabatan->CurrentValue;
		$this->sub_total->CurrentValue = NULL;
		$this->sub_total->OldValue = $this->sub_total->CurrentValue;
		$this->potongan->CurrentValue = NULL;
		$this->potongan->OldValue = $this->potongan->CurrentValue;
		$this->penyesuaian->CurrentValue = NULL;
		$this->penyesuaian->OldValue = $this->penyesuaian->CurrentValue;
		$this->total->CurrentValue = NULL;
		$this->total->OldValue = $this->total->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'pegawai' first before field var 'x_pegawai'
		$val = $CurrentForm->hasValue("pegawai") ? $CurrentForm->getValue("pegawai") : $CurrentForm->getValue("x_pegawai");
		if (!$this->pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->pegawai->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_pegawai"))
			$this->pegawai->setOldValue($CurrentForm->getValue("o_pegawai"));

		// Check field name 'jenjang_id' first before field var 'x_jenjang_id'
		$val = $CurrentForm->hasValue("jenjang_id") ? $CurrentForm->getValue("jenjang_id") : $CurrentForm->getValue("x_jenjang_id");
		if (!$this->jenjang_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jenjang_id->Visible = FALSE; // Disable update for API request
			else
				$this->jenjang_id->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jenjang_id"))
			$this->jenjang_id->setOldValue($CurrentForm->getValue("o_jenjang_id"));

		// Check field name 'jabatan_id' first before field var 'x_jabatan_id'
		$val = $CurrentForm->hasValue("jabatan_id") ? $CurrentForm->getValue("jabatan_id") : $CurrentForm->getValue("x_jabatan_id");
		if (!$this->jabatan_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jabatan_id->Visible = FALSE; // Disable update for API request
			else
				$this->jabatan_id->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jabatan_id"))
			$this->jabatan_id->setOldValue($CurrentForm->getValue("o_jabatan_id"));

		// Check field name 'lama_kerja' first before field var 'x_lama_kerja'
		$val = $CurrentForm->hasValue("lama_kerja") ? $CurrentForm->getValue("lama_kerja") : $CurrentForm->getValue("x_lama_kerja");
		if (!$this->lama_kerja->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->lama_kerja->Visible = FALSE; // Disable update for API request
			else
				$this->lama_kerja->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_lama_kerja"))
			$this->lama_kerja->setOldValue($CurrentForm->getValue("o_lama_kerja"));

		// Check field name 'type' first before field var 'x_type'
		$val = $CurrentForm->hasValue("type") ? $CurrentForm->getValue("type") : $CurrentForm->getValue("x_type");
		if (!$this->type->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->type->Visible = FALSE; // Disable update for API request
			else
				$this->type->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_type"))
			$this->type->setOldValue($CurrentForm->getValue("o_type"));

		// Check field name 'jenis_guru' first before field var 'x_jenis_guru'
		$val = $CurrentForm->hasValue("jenis_guru") ? $CurrentForm->getValue("jenis_guru") : $CurrentForm->getValue("x_jenis_guru");
		if (!$this->jenis_guru->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jenis_guru->Visible = FALSE; // Disable update for API request
			else
				$this->jenis_guru->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jenis_guru"))
			$this->jenis_guru->setOldValue($CurrentForm->getValue("o_jenis_guru"));

		// Check field name 'tambahan' first before field var 'x_tambahan'
		$val = $CurrentForm->hasValue("tambahan") ? $CurrentForm->getValue("tambahan") : $CurrentForm->getValue("x_tambahan");
		if (!$this->tambahan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tambahan->Visible = FALSE; // Disable update for API request
			else
				$this->tambahan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tambahan"))
			$this->tambahan->setOldValue($CurrentForm->getValue("o_tambahan"));

		// Check field name 'periode' first before field var 'x_periode'
		$val = $CurrentForm->hasValue("periode") ? $CurrentForm->getValue("periode") : $CurrentForm->getValue("x_periode");
		if (!$this->periode->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->periode->Visible = FALSE; // Disable update for API request
			else
				$this->periode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_periode"))
			$this->periode->setOldValue($CurrentForm->getValue("o_periode"));

		// Check field name 'tunjangan_periode' first before field var 'x_tunjangan_periode'
		$val = $CurrentForm->hasValue("tunjangan_periode") ? $CurrentForm->getValue("tunjangan_periode") : $CurrentForm->getValue("x_tunjangan_periode");
		if (!$this->tunjangan_periode->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tunjangan_periode->Visible = FALSE; // Disable update for API request
			else
				$this->tunjangan_periode->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tunjangan_periode"))
			$this->tunjangan_periode->setOldValue($CurrentForm->getValue("o_tunjangan_periode"));

		// Check field name 'kehadiran' first before field var 'x_kehadiran'
		$val = $CurrentForm->hasValue("kehadiran") ? $CurrentForm->getValue("kehadiran") : $CurrentForm->getValue("x_kehadiran");
		if (!$this->kehadiran->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kehadiran->Visible = FALSE; // Disable update for API request
			else
				$this->kehadiran->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_kehadiran"))
			$this->kehadiran->setOldValue($CurrentForm->getValue("o_kehadiran"));

		// Check field name 'value_kehadiran' first before field var 'x_value_kehadiran'
		$val = $CurrentForm->hasValue("value_kehadiran") ? $CurrentForm->getValue("value_kehadiran") : $CurrentForm->getValue("x_value_kehadiran");
		if (!$this->value_kehadiran->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->value_kehadiran->Visible = FALSE; // Disable update for API request
			else
				$this->value_kehadiran->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_value_kehadiran"))
			$this->value_kehadiran->setOldValue($CurrentForm->getValue("o_value_kehadiran"));

		// Check field name 'jp' first before field var 'x_jp'
		$val = $CurrentForm->hasValue("jp") ? $CurrentForm->getValue("jp") : $CurrentForm->getValue("x_jp");
		if (!$this->jp->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jp->Visible = FALSE; // Disable update for API request
			else
				$this->jp->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jp"))
			$this->jp->setOldValue($CurrentForm->getValue("o_jp"));

		// Check field name 'gapok' first before field var 'x_gapok'
		$val = $CurrentForm->hasValue("gapok") ? $CurrentForm->getValue("gapok") : $CurrentForm->getValue("x_gapok");
		if (!$this->gapok->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->gapok->Visible = FALSE; // Disable update for API request
			else
				$this->gapok->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_gapok"))
			$this->gapok->setOldValue($CurrentForm->getValue("o_gapok"));

		// Check field name 'total_gapok' first before field var 'x_total_gapok'
		$val = $CurrentForm->hasValue("total_gapok") ? $CurrentForm->getValue("total_gapok") : $CurrentForm->getValue("x_total_gapok");
		if (!$this->total_gapok->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->total_gapok->Visible = FALSE; // Disable update for API request
			else
				$this->total_gapok->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_total_gapok"))
			$this->total_gapok->setOldValue($CurrentForm->getValue("o_total_gapok"));

		// Check field name 'lembur' first before field var 'x_lembur'
		$val = $CurrentForm->hasValue("lembur") ? $CurrentForm->getValue("lembur") : $CurrentForm->getValue("x_lembur");
		if (!$this->lembur->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->lembur->Visible = FALSE; // Disable update for API request
			else
				$this->lembur->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_lembur"))
			$this->lembur->setOldValue($CurrentForm->getValue("o_lembur"));

		// Check field name 'value_lembur' first before field var 'x_value_lembur'
		$val = $CurrentForm->hasValue("value_lembur") ? $CurrentForm->getValue("value_lembur") : $CurrentForm->getValue("x_value_lembur");
		if (!$this->value_lembur->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->value_lembur->Visible = FALSE; // Disable update for API request
			else
				$this->value_lembur->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_value_lembur"))
			$this->value_lembur->setOldValue($CurrentForm->getValue("o_value_lembur"));

		// Check field name 'value_reward' first before field var 'x_value_reward'
		$val = $CurrentForm->hasValue("value_reward") ? $CurrentForm->getValue("value_reward") : $CurrentForm->getValue("x_value_reward");
		if (!$this->value_reward->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->value_reward->Visible = FALSE; // Disable update for API request
			else
				$this->value_reward->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_value_reward"))
			$this->value_reward->setOldValue($CurrentForm->getValue("o_value_reward"));

		// Check field name 'value_inval' first before field var 'x_value_inval'
		$val = $CurrentForm->hasValue("value_inval") ? $CurrentForm->getValue("value_inval") : $CurrentForm->getValue("x_value_inval");
		if (!$this->value_inval->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->value_inval->Visible = FALSE; // Disable update for API request
			else
				$this->value_inval->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_value_inval"))
			$this->value_inval->setOldValue($CurrentForm->getValue("o_value_inval"));

		// Check field name 'piket_count' first before field var 'x_piket_count'
		$val = $CurrentForm->hasValue("piket_count") ? $CurrentForm->getValue("piket_count") : $CurrentForm->getValue("x_piket_count");
		if (!$this->piket_count->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->piket_count->Visible = FALSE; // Disable update for API request
			else
				$this->piket_count->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_piket_count"))
			$this->piket_count->setOldValue($CurrentForm->getValue("o_piket_count"));

		// Check field name 'value_piket' first before field var 'x_value_piket'
		$val = $CurrentForm->hasValue("value_piket") ? $CurrentForm->getValue("value_piket") : $CurrentForm->getValue("x_value_piket");
		if (!$this->value_piket->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->value_piket->Visible = FALSE; // Disable update for API request
			else
				$this->value_piket->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_value_piket"))
			$this->value_piket->setOldValue($CurrentForm->getValue("o_value_piket"));

		// Check field name 'tugastambahan' first before field var 'x_tugastambahan'
		$val = $CurrentForm->hasValue("tugastambahan") ? $CurrentForm->getValue("tugastambahan") : $CurrentForm->getValue("x_tugastambahan");
		if (!$this->tugastambahan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tugastambahan->Visible = FALSE; // Disable update for API request
			else
				$this->tugastambahan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tugastambahan"))
			$this->tugastambahan->setOldValue($CurrentForm->getValue("o_tugastambahan"));

		// Check field name 'tj_jabatan' first before field var 'x_tj_jabatan'
		$val = $CurrentForm->hasValue("tj_jabatan") ? $CurrentForm->getValue("tj_jabatan") : $CurrentForm->getValue("x_tj_jabatan");
		if (!$this->tj_jabatan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tj_jabatan->Visible = FALSE; // Disable update for API request
			else
				$this->tj_jabatan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tj_jabatan"))
			$this->tj_jabatan->setOldValue($CurrentForm->getValue("o_tj_jabatan"));

		// Check field name 'sub_total' first before field var 'x_sub_total'
		$val = $CurrentForm->hasValue("sub_total") ? $CurrentForm->getValue("sub_total") : $CurrentForm->getValue("x_sub_total");
		if (!$this->sub_total->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->sub_total->Visible = FALSE; // Disable update for API request
			else
				$this->sub_total->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_sub_total"))
			$this->sub_total->setOldValue($CurrentForm->getValue("o_sub_total"));

		// Check field name 'potongan' first before field var 'x_potongan'
		$val = $CurrentForm->hasValue("potongan") ? $CurrentForm->getValue("potongan") : $CurrentForm->getValue("x_potongan");
		if (!$this->potongan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->potongan->Visible = FALSE; // Disable update for API request
			else
				$this->potongan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_potongan"))
			$this->potongan->setOldValue($CurrentForm->getValue("o_potongan"));

		// Check field name 'penyesuaian' first before field var 'x_penyesuaian'
		$val = $CurrentForm->hasValue("penyesuaian") ? $CurrentForm->getValue("penyesuaian") : $CurrentForm->getValue("x_penyesuaian");
		if (!$this->penyesuaian->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->penyesuaian->Visible = FALSE; // Disable update for API request
			else
				$this->penyesuaian->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_penyesuaian"))
			$this->penyesuaian->setOldValue($CurrentForm->getValue("o_penyesuaian"));

		// Check field name 'total' first before field var 'x_total'
		$val = $CurrentForm->hasValue("total") ? $CurrentForm->getValue("total") : $CurrentForm->getValue("x_total");
		if (!$this->total->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->total->Visible = FALSE; // Disable update for API request
			else
				$this->total->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_total"))
			$this->total->setOldValue($CurrentForm->getValue("o_total"));

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey && !$this->isGridAdd() && !$this->isAdd())
			$this->id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		if (!$this->isGridAdd() && !$this->isAdd())
			$this->id->CurrentValue = $this->id->FormValue;
		$this->pegawai->CurrentValue = $this->pegawai->FormValue;
		$this->jenjang_id->CurrentValue = $this->jenjang_id->FormValue;
		$this->jabatan_id->CurrentValue = $this->jabatan_id->FormValue;
		$this->lama_kerja->CurrentValue = $this->lama_kerja->FormValue;
		$this->type->CurrentValue = $this->type->FormValue;
		$this->jenis_guru->CurrentValue = $this->jenis_guru->FormValue;
		$this->tambahan->CurrentValue = $this->tambahan->FormValue;
		$this->periode->CurrentValue = $this->periode->FormValue;
		$this->tunjangan_periode->CurrentValue = $this->tunjangan_periode->FormValue;
		$this->kehadiran->CurrentValue = $this->kehadiran->FormValue;
		$this->value_kehadiran->CurrentValue = $this->value_kehadiran->FormValue;
		$this->jp->CurrentValue = $this->jp->FormValue;
		$this->gapok->CurrentValue = $this->gapok->FormValue;
		$this->total_gapok->CurrentValue = $this->total_gapok->FormValue;
		$this->lembur->CurrentValue = $this->lembur->FormValue;
		$this->value_lembur->CurrentValue = $this->value_lembur->FormValue;
		$this->value_reward->CurrentValue = $this->value_reward->FormValue;
		$this->value_inval->CurrentValue = $this->value_inval->FormValue;
		$this->piket_count->CurrentValue = $this->piket_count->FormValue;
		$this->value_piket->CurrentValue = $this->value_piket->FormValue;
		$this->tugastambahan->CurrentValue = $this->tugastambahan->FormValue;
		$this->tj_jabatan->CurrentValue = $this->tj_jabatan->FormValue;
		$this->sub_total->CurrentValue = $this->sub_total->FormValue;
		$this->potongan->CurrentValue = $this->potongan->FormValue;
		$this->penyesuaian->CurrentValue = $this->penyesuaian->FormValue;
		$this->total->CurrentValue = $this->total->FormValue;
	}

	// Load recordset
	public function loadRecordset($offset = -1, $rowcnt = -1)
	{

		// Load List page SQL
		$sql = $this->getListSql();
		$conn = $this->getConnection();

		// Load recordset
		$dbtype = GetConnectionType($this->Dbid);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			if ($dbtype == "MSSQL") {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset, ["_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())]);
			} else {
				$rs = $conn->selectLimit($sql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = "";
		} else {
			$rs = LoadRecordset($sql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->pid->setDbValue($row['pid']);
		$this->datetime->setDbValue($row['datetime']);
		$this->pegawai->setDbValue($row['pegawai']);
		$this->jenjang_id->setDbValue($row['jenjang_id']);
		$this->jabatan_id->setDbValue($row['jabatan_id']);
		$this->month->setDbValue($row['month']);
		$this->lama_kerja->setDbValue($row['lama_kerja']);
		$this->type->setDbValue($row['type']);
		$this->jenis_guru->setDbValue($row['jenis_guru']);
		$this->tambahan->setDbValue($row['tambahan']);
		$this->periode->setDbValue($row['periode']);
		$this->tunjangan_periode->setDbValue($row['tunjangan_periode']);
		$this->kehadiran->setDbValue($row['kehadiran']);
		$this->value_kehadiran->setDbValue($row['value_kehadiran']);
		$this->jp->setDbValue($row['jp']);
		$this->gapok->setDbValue($row['gapok']);
		$this->total_gapok->setDbValue($row['total_gapok']);
		$this->lembur->setDbValue($row['lembur']);
		$this->value_lembur->setDbValue($row['value_lembur']);
		$this->value_reward->setDbValue($row['value_reward']);
		$this->value_inval->setDbValue($row['value_inval']);
		$this->piket_count->setDbValue($row['piket_count']);
		$this->value_piket->setDbValue($row['value_piket']);
		$this->tugastambahan->setDbValue($row['tugastambahan']);
		$this->tj_jabatan->setDbValue($row['tj_jabatan']);
		$this->sub_total->setDbValue($row['sub_total']);
		$this->potongan->setDbValue($row['potongan']);
		$this->penyesuaian->setDbValue($row['penyesuaian']);
		$this->total->setDbValue($row['total']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['pid'] = $this->pid->CurrentValue;
		$row['datetime'] = $this->datetime->CurrentValue;
		$row['pegawai'] = $this->pegawai->CurrentValue;
		$row['jenjang_id'] = $this->jenjang_id->CurrentValue;
		$row['jabatan_id'] = $this->jabatan_id->CurrentValue;
		$row['month'] = $this->month->CurrentValue;
		$row['lama_kerja'] = $this->lama_kerja->CurrentValue;
		$row['type'] = $this->type->CurrentValue;
		$row['jenis_guru'] = $this->jenis_guru->CurrentValue;
		$row['tambahan'] = $this->tambahan->CurrentValue;
		$row['periode'] = $this->periode->CurrentValue;
		$row['tunjangan_periode'] = $this->tunjangan_periode->CurrentValue;
		$row['kehadiran'] = $this->kehadiran->CurrentValue;
		$row['value_kehadiran'] = $this->value_kehadiran->CurrentValue;
		$row['jp'] = $this->jp->CurrentValue;
		$row['gapok'] = $this->gapok->CurrentValue;
		$row['total_gapok'] = $this->total_gapok->CurrentValue;
		$row['lembur'] = $this->lembur->CurrentValue;
		$row['value_lembur'] = $this->value_lembur->CurrentValue;
		$row['value_reward'] = $this->value_reward->CurrentValue;
		$row['value_inval'] = $this->value_inval->CurrentValue;
		$row['piket_count'] = $this->piket_count->CurrentValue;
		$row['value_piket'] = $this->value_piket->CurrentValue;
		$row['tugastambahan'] = $this->tugastambahan->CurrentValue;
		$row['tj_jabatan'] = $this->tj_jabatan->CurrentValue;
		$row['sub_total'] = $this->sub_total->CurrentValue;
		$row['potongan'] = $this->potongan->CurrentValue;
		$row['penyesuaian'] = $this->penyesuaian->CurrentValue;
		$row['total'] = $this->total->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		$keys = [$this->RowOldKey];
		$cnt = count($keys);
		if ($cnt >= 1) {
			if (strval($keys[0]) != "")
				$this->id->OldValue = strval($keys[0]); // id
			else
				$validKey = FALSE;
		} else {
			$validKey = FALSE;
		}

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = $this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->getViewUrl();
		$this->EditUrl = $this->getEditUrl();
		$this->CopyUrl = $this->getCopyUrl();
		$this->DeleteUrl = $this->getDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// pid
		// datetime
		// pegawai
		// jenjang_id
		// jabatan_id
		// month
		// lama_kerja
		// type
		// jenis_guru
		// tambahan
		// periode
		// tunjangan_periode
		// kehadiran
		// value_kehadiran
		// jp
		// gapok
		// total_gapok
		// lembur
		// value_lembur
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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

			// month
			$this->month->ViewValue = $this->month->CurrentValue;
			$this->month->ViewValue = FormatDateTime($this->month->ViewValue, 0);
			$this->month->ViewCustomAttributes = "";

			// lama_kerja
			$this->lama_kerja->ViewValue = $this->lama_kerja->CurrentValue;
			$this->lama_kerja->ViewValue = FormatNumber($this->lama_kerja->ViewValue, 0, -2, -2, -2);
			$this->lama_kerja->ViewCustomAttributes = "";

			// type
			$this->type->ViewValue = $this->type->CurrentValue;
			$this->type->ViewValue = FormatNumber($this->type->ViewValue, 0, -2, -2, -2);
			$this->type->ViewCustomAttributes = "";

			// jenis_guru
			$this->jenis_guru->ViewValue = $this->jenis_guru->CurrentValue;
			$this->jenis_guru->ViewValue = FormatNumber($this->jenis_guru->ViewValue, 0, -2, -2, -2);
			$this->jenis_guru->ViewCustomAttributes = "";

			// tambahan
			$this->tambahan->ViewValue = $this->tambahan->CurrentValue;
			$this->tambahan->ViewValue = FormatNumber($this->tambahan->ViewValue, 0, -2, -2, -2);
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

			// lembur
			$this->lembur->ViewValue = $this->lembur->CurrentValue;
			$this->lembur->ViewValue = FormatNumber($this->lembur->ViewValue, 0, -2, -2, -2);
			$this->lembur->ViewCustomAttributes = "";

			// value_lembur
			$this->value_lembur->ViewValue = $this->value_lembur->CurrentValue;
			$this->value_lembur->ViewValue = FormatNumber($this->value_lembur->ViewValue, 0, -2, -2, -2);
			$this->value_lembur->ViewCustomAttributes = "";

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

			// lembur
			$this->lembur->LinkCustomAttributes = "";
			$this->lembur->HrefValue = "";
			$this->lembur->TooltipValue = "";

			// value_lembur
			$this->value_lembur->LinkCustomAttributes = "";
			$this->value_lembur->HrefValue = "";
			$this->value_lembur->TooltipValue = "";

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// pegawai
			$this->pegawai->EditCustomAttributes = "";
			$curVal = trim(strval($this->pegawai->CurrentValue));
			if ($curVal != "")
				$this->pegawai->ViewValue = $this->pegawai->lookupCacheOption($curVal);
			else
				$this->pegawai->ViewValue = $this->pegawai->Lookup !== NULL && is_array($this->pegawai->Lookup->Options) ? $curVal : NULL;
			if ($this->pegawai->ViewValue !== NULL) { // Load from cache
				$this->pegawai->EditValue = array_values($this->pegawai->Lookup->Options);
				if ($this->pegawai->ViewValue == "")
					$this->pegawai->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`nip`" . SearchString("=", $this->pegawai->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->pegawai->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->pegawai->ViewValue = $this->pegawai->displayValue($arwrk);
				} else {
					$this->pegawai->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->pegawai->EditValue = $arwrk;
			}

			// jenjang_id
			$this->jenjang_id->EditAttrs["class"] = "form-control";
			$this->jenjang_id->EditCustomAttributes = "";
			$this->jenjang_id->EditValue = HtmlEncode($this->jenjang_id->CurrentValue);
			$curVal = strval($this->jenjang_id->CurrentValue);
			if ($curVal != "") {
				$this->jenjang_id->EditValue = $this->jenjang_id->lookupCacheOption($curVal);
				if ($this->jenjang_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`nourut`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->jenjang_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->jenjang_id->EditValue = $this->jenjang_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jenjang_id->EditValue = HtmlEncode($this->jenjang_id->CurrentValue);
					}
				}
			} else {
				$this->jenjang_id->EditValue = NULL;
			}
			$this->jenjang_id->PlaceHolder = RemoveHtml($this->jenjang_id->caption());

			// jabatan_id
			$this->jabatan_id->EditAttrs["class"] = "form-control";
			$this->jabatan_id->EditCustomAttributes = "";
			$this->jabatan_id->EditValue = HtmlEncode($this->jabatan_id->CurrentValue);
			$curVal = strval($this->jabatan_id->CurrentValue);
			if ($curVal != "") {
				$this->jabatan_id->EditValue = $this->jabatan_id->lookupCacheOption($curVal);
				if ($this->jabatan_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->jabatan_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->jabatan_id->EditValue = $this->jabatan_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jabatan_id->EditValue = HtmlEncode($this->jabatan_id->CurrentValue);
					}
				}
			} else {
				$this->jabatan_id->EditValue = NULL;
			}
			$this->jabatan_id->PlaceHolder = RemoveHtml($this->jabatan_id->caption());

			// lama_kerja
			$this->lama_kerja->EditAttrs["class"] = "form-control";
			$this->lama_kerja->EditCustomAttributes = "";
			$this->lama_kerja->EditValue = HtmlEncode($this->lama_kerja->CurrentValue);
			$this->lama_kerja->PlaceHolder = RemoveHtml($this->lama_kerja->caption());

			// type
			$this->type->EditAttrs["class"] = "form-control";
			$this->type->EditCustomAttributes = "";
			$this->type->EditValue = HtmlEncode($this->type->CurrentValue);
			$this->type->PlaceHolder = RemoveHtml($this->type->caption());

			// jenis_guru
			$this->jenis_guru->EditAttrs["class"] = "form-control";
			$this->jenis_guru->EditCustomAttributes = "";
			$this->jenis_guru->EditValue = HtmlEncode($this->jenis_guru->CurrentValue);
			$this->jenis_guru->PlaceHolder = RemoveHtml($this->jenis_guru->caption());

			// tambahan
			$this->tambahan->EditAttrs["class"] = "form-control";
			$this->tambahan->EditCustomAttributes = "";
			$this->tambahan->EditValue = HtmlEncode($this->tambahan->CurrentValue);
			$this->tambahan->PlaceHolder = RemoveHtml($this->tambahan->caption());

			// periode
			$this->periode->EditAttrs["class"] = "form-control";
			$this->periode->EditCustomAttributes = "";
			$this->periode->EditValue = HtmlEncode($this->periode->CurrentValue);
			$this->periode->PlaceHolder = RemoveHtml($this->periode->caption());

			// tunjangan_periode
			$this->tunjangan_periode->EditAttrs["class"] = "form-control";
			$this->tunjangan_periode->EditCustomAttributes = "";
			$this->tunjangan_periode->EditValue = HtmlEncode($this->tunjangan_periode->CurrentValue);
			$this->tunjangan_periode->PlaceHolder = RemoveHtml($this->tunjangan_periode->caption());

			// kehadiran
			$this->kehadiran->EditAttrs["class"] = "form-control";
			$this->kehadiran->EditCustomAttributes = "";
			$this->kehadiran->EditValue = HtmlEncode($this->kehadiran->CurrentValue);
			$this->kehadiran->PlaceHolder = RemoveHtml($this->kehadiran->caption());

			// value_kehadiran
			$this->value_kehadiran->EditAttrs["class"] = "form-control";
			$this->value_kehadiran->EditCustomAttributes = "";
			$this->value_kehadiran->EditValue = HtmlEncode($this->value_kehadiran->CurrentValue);
			$this->value_kehadiran->PlaceHolder = RemoveHtml($this->value_kehadiran->caption());

			// jp
			$this->jp->EditAttrs["class"] = "form-control";
			$this->jp->EditCustomAttributes = "";
			$this->jp->EditValue = HtmlEncode($this->jp->CurrentValue);
			$this->jp->PlaceHolder = RemoveHtml($this->jp->caption());

			// gapok
			$this->gapok->EditAttrs["class"] = "form-control";
			$this->gapok->EditCustomAttributes = "";
			$this->gapok->EditValue = HtmlEncode($this->gapok->CurrentValue);
			$this->gapok->PlaceHolder = RemoveHtml($this->gapok->caption());

			// total_gapok
			$this->total_gapok->EditAttrs["class"] = "form-control";
			$this->total_gapok->EditCustomAttributes = "";
			$this->total_gapok->EditValue = HtmlEncode($this->total_gapok->CurrentValue);
			$this->total_gapok->PlaceHolder = RemoveHtml($this->total_gapok->caption());

			// lembur
			$this->lembur->EditAttrs["class"] = "form-control";
			$this->lembur->EditCustomAttributes = "";
			$this->lembur->EditValue = HtmlEncode($this->lembur->CurrentValue);
			$this->lembur->PlaceHolder = RemoveHtml($this->lembur->caption());

			// value_lembur
			$this->value_lembur->EditAttrs["class"] = "form-control";
			$this->value_lembur->EditCustomAttributes = "";
			$this->value_lembur->EditValue = HtmlEncode($this->value_lembur->CurrentValue);
			$this->value_lembur->PlaceHolder = RemoveHtml($this->value_lembur->caption());

			// value_reward
			$this->value_reward->EditAttrs["class"] = "form-control";
			$this->value_reward->EditCustomAttributes = "";
			$this->value_reward->EditValue = HtmlEncode($this->value_reward->CurrentValue);
			$this->value_reward->PlaceHolder = RemoveHtml($this->value_reward->caption());

			// value_inval
			$this->value_inval->EditAttrs["class"] = "form-control";
			$this->value_inval->EditCustomAttributes = "";
			$this->value_inval->EditValue = HtmlEncode($this->value_inval->CurrentValue);
			$this->value_inval->PlaceHolder = RemoveHtml($this->value_inval->caption());

			// piket_count
			$this->piket_count->EditAttrs["class"] = "form-control";
			$this->piket_count->EditCustomAttributes = "";
			$this->piket_count->EditValue = HtmlEncode($this->piket_count->CurrentValue);
			$this->piket_count->PlaceHolder = RemoveHtml($this->piket_count->caption());

			// value_piket
			$this->value_piket->EditAttrs["class"] = "form-control";
			$this->value_piket->EditCustomAttributes = "";
			$this->value_piket->EditValue = HtmlEncode($this->value_piket->CurrentValue);
			$this->value_piket->PlaceHolder = RemoveHtml($this->value_piket->caption());

			// tugastambahan
			$this->tugastambahan->EditAttrs["class"] = "form-control";
			$this->tugastambahan->EditCustomAttributes = "";
			$this->tugastambahan->EditValue = HtmlEncode($this->tugastambahan->CurrentValue);
			$this->tugastambahan->PlaceHolder = RemoveHtml($this->tugastambahan->caption());

			// tj_jabatan
			$this->tj_jabatan->EditAttrs["class"] = "form-control";
			$this->tj_jabatan->EditCustomAttributes = "";
			$this->tj_jabatan->EditValue = HtmlEncode($this->tj_jabatan->CurrentValue);
			$this->tj_jabatan->PlaceHolder = RemoveHtml($this->tj_jabatan->caption());

			// sub_total
			$this->sub_total->EditAttrs["class"] = "form-control";
			$this->sub_total->EditCustomAttributes = "";
			$this->sub_total->EditValue = HtmlEncode($this->sub_total->CurrentValue);
			$this->sub_total->PlaceHolder = RemoveHtml($this->sub_total->caption());

			// potongan
			$this->potongan->EditAttrs["class"] = "form-control";
			$this->potongan->EditCustomAttributes = "";
			$this->potongan->EditValue = HtmlEncode($this->potongan->CurrentValue);
			$this->potongan->PlaceHolder = RemoveHtml($this->potongan->caption());

			// penyesuaian
			$this->penyesuaian->EditAttrs["class"] = "form-control";
			$this->penyesuaian->EditCustomAttributes = "";
			$this->penyesuaian->EditValue = HtmlEncode($this->penyesuaian->CurrentValue);
			$this->penyesuaian->PlaceHolder = RemoveHtml($this->penyesuaian->caption());

			// total
			$this->total->EditAttrs["class"] = "form-control";
			$this->total->EditCustomAttributes = "";
			$this->total->EditValue = HtmlEncode($this->total->CurrentValue);
			$this->total->PlaceHolder = RemoveHtml($this->total->caption());

			// Add refer script
			// pegawai

			$this->pegawai->LinkCustomAttributes = "";
			$this->pegawai->HrefValue = "";

			// jenjang_id
			$this->jenjang_id->LinkCustomAttributes = "";
			$this->jenjang_id->HrefValue = "";

			// jabatan_id
			$this->jabatan_id->LinkCustomAttributes = "";
			$this->jabatan_id->HrefValue = "";

			// lama_kerja
			$this->lama_kerja->LinkCustomAttributes = "";
			$this->lama_kerja->HrefValue = "";

			// type
			$this->type->LinkCustomAttributes = "";
			$this->type->HrefValue = "";

			// jenis_guru
			$this->jenis_guru->LinkCustomAttributes = "";
			$this->jenis_guru->HrefValue = "";

			// tambahan
			$this->tambahan->LinkCustomAttributes = "";
			$this->tambahan->HrefValue = "";

			// periode
			$this->periode->LinkCustomAttributes = "";
			$this->periode->HrefValue = "";

			// tunjangan_periode
			$this->tunjangan_periode->LinkCustomAttributes = "";
			$this->tunjangan_periode->HrefValue = "";

			// kehadiran
			$this->kehadiran->LinkCustomAttributes = "";
			$this->kehadiran->HrefValue = "";

			// value_kehadiran
			$this->value_kehadiran->LinkCustomAttributes = "";
			$this->value_kehadiran->HrefValue = "";

			// jp
			$this->jp->LinkCustomAttributes = "";
			$this->jp->HrefValue = "";

			// gapok
			$this->gapok->LinkCustomAttributes = "";
			$this->gapok->HrefValue = "";

			// total_gapok
			$this->total_gapok->LinkCustomAttributes = "";
			$this->total_gapok->HrefValue = "";

			// lembur
			$this->lembur->LinkCustomAttributes = "";
			$this->lembur->HrefValue = "";

			// value_lembur
			$this->value_lembur->LinkCustomAttributes = "";
			$this->value_lembur->HrefValue = "";

			// value_reward
			$this->value_reward->LinkCustomAttributes = "";
			$this->value_reward->HrefValue = "";

			// value_inval
			$this->value_inval->LinkCustomAttributes = "";
			$this->value_inval->HrefValue = "";

			// piket_count
			$this->piket_count->LinkCustomAttributes = "";
			$this->piket_count->HrefValue = "";

			// value_piket
			$this->value_piket->LinkCustomAttributes = "";
			$this->value_piket->HrefValue = "";

			// tugastambahan
			$this->tugastambahan->LinkCustomAttributes = "";
			$this->tugastambahan->HrefValue = "";

			// tj_jabatan
			$this->tj_jabatan->LinkCustomAttributes = "";
			$this->tj_jabatan->HrefValue = "";

			// sub_total
			$this->sub_total->LinkCustomAttributes = "";
			$this->sub_total->HrefValue = "";

			// potongan
			$this->potongan->LinkCustomAttributes = "";
			$this->potongan->HrefValue = "";

			// penyesuaian
			$this->penyesuaian->LinkCustomAttributes = "";
			$this->penyesuaian->HrefValue = "";

			// total
			$this->total->LinkCustomAttributes = "";
			$this->total->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// pegawai
			$this->pegawai->EditCustomAttributes = "";
			$curVal = trim(strval($this->pegawai->CurrentValue));
			if ($curVal != "")
				$this->pegawai->ViewValue = $this->pegawai->lookupCacheOption($curVal);
			else
				$this->pegawai->ViewValue = $this->pegawai->Lookup !== NULL && is_array($this->pegawai->Lookup->Options) ? $curVal : NULL;
			if ($this->pegawai->ViewValue !== NULL) { // Load from cache
				$this->pegawai->EditValue = array_values($this->pegawai->Lookup->Options);
				if ($this->pegawai->ViewValue == "")
					$this->pegawai->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`nip`" . SearchString("=", $this->pegawai->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->pegawai->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->pegawai->ViewValue = $this->pegawai->displayValue($arwrk);
				} else {
					$this->pegawai->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->pegawai->EditValue = $arwrk;
			}

			// jenjang_id
			$this->jenjang_id->EditAttrs["class"] = "form-control";
			$this->jenjang_id->EditCustomAttributes = "";
			$this->jenjang_id->EditValue = $this->jenjang_id->CurrentValue;
			$curVal = strval($this->jenjang_id->CurrentValue);
			if ($curVal != "") {
				$this->jenjang_id->EditValue = $this->jenjang_id->lookupCacheOption($curVal);
				if ($this->jenjang_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`nourut`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->jenjang_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->jenjang_id->EditValue = $this->jenjang_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jenjang_id->EditValue = $this->jenjang_id->CurrentValue;
					}
				}
			} else {
				$this->jenjang_id->EditValue = NULL;
			}
			$this->jenjang_id->ViewCustomAttributes = "";

			// jabatan_id
			$this->jabatan_id->EditAttrs["class"] = "form-control";
			$this->jabatan_id->EditCustomAttributes = "";
			$this->jabatan_id->EditValue = $this->jabatan_id->CurrentValue;
			$curVal = strval($this->jabatan_id->CurrentValue);
			if ($curVal != "") {
				$this->jabatan_id->EditValue = $this->jabatan_id->lookupCacheOption($curVal);
				if ($this->jabatan_id->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->jabatan_id->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->jabatan_id->EditValue = $this->jabatan_id->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jabatan_id->EditValue = $this->jabatan_id->CurrentValue;
					}
				}
			} else {
				$this->jabatan_id->EditValue = NULL;
			}
			$this->jabatan_id->ViewCustomAttributes = "";

			// lama_kerja
			$this->lama_kerja->EditAttrs["class"] = "form-control";
			$this->lama_kerja->EditCustomAttributes = "";
			$this->lama_kerja->EditValue = HtmlEncode($this->lama_kerja->CurrentValue);
			$this->lama_kerja->PlaceHolder = RemoveHtml($this->lama_kerja->caption());

			// type
			$this->type->EditAttrs["class"] = "form-control";
			$this->type->EditCustomAttributes = "";
			$this->type->EditValue = HtmlEncode($this->type->CurrentValue);
			$this->type->PlaceHolder = RemoveHtml($this->type->caption());

			// jenis_guru
			$this->jenis_guru->EditAttrs["class"] = "form-control";
			$this->jenis_guru->EditCustomAttributes = "";
			$this->jenis_guru->EditValue = HtmlEncode($this->jenis_guru->CurrentValue);
			$this->jenis_guru->PlaceHolder = RemoveHtml($this->jenis_guru->caption());

			// tambahan
			$this->tambahan->EditAttrs["class"] = "form-control";
			$this->tambahan->EditCustomAttributes = "";
			$this->tambahan->EditValue = HtmlEncode($this->tambahan->CurrentValue);
			$this->tambahan->PlaceHolder = RemoveHtml($this->tambahan->caption());

			// periode
			$this->periode->EditAttrs["class"] = "form-control";
			$this->periode->EditCustomAttributes = "";
			$this->periode->EditValue = HtmlEncode($this->periode->CurrentValue);
			$this->periode->PlaceHolder = RemoveHtml($this->periode->caption());

			// tunjangan_periode
			$this->tunjangan_periode->EditAttrs["class"] = "form-control";
			$this->tunjangan_periode->EditCustomAttributes = "";
			$this->tunjangan_periode->EditValue = HtmlEncode($this->tunjangan_periode->CurrentValue);
			$this->tunjangan_periode->PlaceHolder = RemoveHtml($this->tunjangan_periode->caption());

			// kehadiran
			$this->kehadiran->EditAttrs["class"] = "form-control";
			$this->kehadiran->EditCustomAttributes = "";
			$this->kehadiran->EditValue = HtmlEncode($this->kehadiran->CurrentValue);
			$this->kehadiran->PlaceHolder = RemoveHtml($this->kehadiran->caption());

			// value_kehadiran
			$this->value_kehadiran->EditAttrs["class"] = "form-control";
			$this->value_kehadiran->EditCustomAttributes = "";
			$this->value_kehadiran->EditValue = HtmlEncode($this->value_kehadiran->CurrentValue);
			$this->value_kehadiran->PlaceHolder = RemoveHtml($this->value_kehadiran->caption());

			// jp
			$this->jp->EditAttrs["class"] = "form-control";
			$this->jp->EditCustomAttributes = "";
			$this->jp->EditValue = HtmlEncode($this->jp->CurrentValue);
			$this->jp->PlaceHolder = RemoveHtml($this->jp->caption());

			// gapok
			$this->gapok->EditAttrs["class"] = "form-control";
			$this->gapok->EditCustomAttributes = "";
			$this->gapok->EditValue = HtmlEncode($this->gapok->CurrentValue);
			$this->gapok->PlaceHolder = RemoveHtml($this->gapok->caption());

			// total_gapok
			$this->total_gapok->EditAttrs["class"] = "form-control";
			$this->total_gapok->EditCustomAttributes = "";
			$this->total_gapok->EditValue = HtmlEncode($this->total_gapok->CurrentValue);
			$this->total_gapok->PlaceHolder = RemoveHtml($this->total_gapok->caption());

			// lembur
			$this->lembur->EditAttrs["class"] = "form-control";
			$this->lembur->EditCustomAttributes = "";
			$this->lembur->EditValue = HtmlEncode($this->lembur->CurrentValue);
			$this->lembur->PlaceHolder = RemoveHtml($this->lembur->caption());

			// value_lembur
			$this->value_lembur->EditAttrs["class"] = "form-control";
			$this->value_lembur->EditCustomAttributes = "";
			$this->value_lembur->EditValue = HtmlEncode($this->value_lembur->CurrentValue);
			$this->value_lembur->PlaceHolder = RemoveHtml($this->value_lembur->caption());

			// value_reward
			$this->value_reward->EditAttrs["class"] = "form-control";
			$this->value_reward->EditCustomAttributes = "";
			$this->value_reward->EditValue = HtmlEncode($this->value_reward->CurrentValue);
			$this->value_reward->PlaceHolder = RemoveHtml($this->value_reward->caption());

			// value_inval
			$this->value_inval->EditAttrs["class"] = "form-control";
			$this->value_inval->EditCustomAttributes = "";
			$this->value_inval->EditValue = HtmlEncode($this->value_inval->CurrentValue);
			$this->value_inval->PlaceHolder = RemoveHtml($this->value_inval->caption());

			// piket_count
			$this->piket_count->EditAttrs["class"] = "form-control";
			$this->piket_count->EditCustomAttributes = "";
			$this->piket_count->EditValue = HtmlEncode($this->piket_count->CurrentValue);
			$this->piket_count->PlaceHolder = RemoveHtml($this->piket_count->caption());

			// value_piket
			$this->value_piket->EditAttrs["class"] = "form-control";
			$this->value_piket->EditCustomAttributes = "";
			$this->value_piket->EditValue = HtmlEncode($this->value_piket->CurrentValue);
			$this->value_piket->PlaceHolder = RemoveHtml($this->value_piket->caption());

			// tugastambahan
			$this->tugastambahan->EditAttrs["class"] = "form-control";
			$this->tugastambahan->EditCustomAttributes = "";
			$this->tugastambahan->EditValue = HtmlEncode($this->tugastambahan->CurrentValue);
			$this->tugastambahan->PlaceHolder = RemoveHtml($this->tugastambahan->caption());

			// tj_jabatan
			$this->tj_jabatan->EditAttrs["class"] = "form-control";
			$this->tj_jabatan->EditCustomAttributes = "";
			$this->tj_jabatan->EditValue = HtmlEncode($this->tj_jabatan->CurrentValue);
			$this->tj_jabatan->PlaceHolder = RemoveHtml($this->tj_jabatan->caption());

			// sub_total
			$this->sub_total->EditAttrs["class"] = "form-control";
			$this->sub_total->EditCustomAttributes = "";
			$this->sub_total->EditValue = HtmlEncode($this->sub_total->CurrentValue);
			$this->sub_total->PlaceHolder = RemoveHtml($this->sub_total->caption());

			// potongan
			$this->potongan->EditAttrs["class"] = "form-control";
			$this->potongan->EditCustomAttributes = "";
			$this->potongan->EditValue = HtmlEncode($this->potongan->CurrentValue);
			$this->potongan->PlaceHolder = RemoveHtml($this->potongan->caption());

			// penyesuaian
			$this->penyesuaian->EditAttrs["class"] = "form-control";
			$this->penyesuaian->EditCustomAttributes = "";
			$this->penyesuaian->EditValue = HtmlEncode($this->penyesuaian->CurrentValue);
			$this->penyesuaian->PlaceHolder = RemoveHtml($this->penyesuaian->caption());

			// total
			$this->total->EditAttrs["class"] = "form-control";
			$this->total->EditCustomAttributes = "";
			$this->total->EditValue = HtmlEncode($this->total->CurrentValue);
			$this->total->PlaceHolder = RemoveHtml($this->total->caption());

			// Edit refer script
			// pegawai

			$this->pegawai->LinkCustomAttributes = "";
			$this->pegawai->HrefValue = "";

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

			// type
			$this->type->LinkCustomAttributes = "";
			$this->type->HrefValue = "";

			// jenis_guru
			$this->jenis_guru->LinkCustomAttributes = "";
			$this->jenis_guru->HrefValue = "";

			// tambahan
			$this->tambahan->LinkCustomAttributes = "";
			$this->tambahan->HrefValue = "";

			// periode
			$this->periode->LinkCustomAttributes = "";
			$this->periode->HrefValue = "";

			// tunjangan_periode
			$this->tunjangan_periode->LinkCustomAttributes = "";
			$this->tunjangan_periode->HrefValue = "";

			// kehadiran
			$this->kehadiran->LinkCustomAttributes = "";
			$this->kehadiran->HrefValue = "";

			// value_kehadiran
			$this->value_kehadiran->LinkCustomAttributes = "";
			$this->value_kehadiran->HrefValue = "";

			// jp
			$this->jp->LinkCustomAttributes = "";
			$this->jp->HrefValue = "";

			// gapok
			$this->gapok->LinkCustomAttributes = "";
			$this->gapok->HrefValue = "";

			// total_gapok
			$this->total_gapok->LinkCustomAttributes = "";
			$this->total_gapok->HrefValue = "";

			// lembur
			$this->lembur->LinkCustomAttributes = "";
			$this->lembur->HrefValue = "";

			// value_lembur
			$this->value_lembur->LinkCustomAttributes = "";
			$this->value_lembur->HrefValue = "";

			// value_reward
			$this->value_reward->LinkCustomAttributes = "";
			$this->value_reward->HrefValue = "";

			// value_inval
			$this->value_inval->LinkCustomAttributes = "";
			$this->value_inval->HrefValue = "";

			// piket_count
			$this->piket_count->LinkCustomAttributes = "";
			$this->piket_count->HrefValue = "";

			// value_piket
			$this->value_piket->LinkCustomAttributes = "";
			$this->value_piket->HrefValue = "";

			// tugastambahan
			$this->tugastambahan->LinkCustomAttributes = "";
			$this->tugastambahan->HrefValue = "";

			// tj_jabatan
			$this->tj_jabatan->LinkCustomAttributes = "";
			$this->tj_jabatan->HrefValue = "";

			// sub_total
			$this->sub_total->LinkCustomAttributes = "";
			$this->sub_total->HrefValue = "";

			// potongan
			$this->potongan->LinkCustomAttributes = "";
			$this->potongan->HrefValue = "";

			// penyesuaian
			$this->penyesuaian->LinkCustomAttributes = "";
			$this->penyesuaian->HrefValue = "";

			// total
			$this->total->LinkCustomAttributes = "";
			$this->total->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType != ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->pegawai->Required) {
			if (!$this->pegawai->IsDetailKey && $this->pegawai->FormValue != NULL && $this->pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pegawai->caption(), $this->pegawai->RequiredErrorMessage));
			}
		}
		if ($this->jenjang_id->Required) {
			if (!$this->jenjang_id->IsDetailKey && $this->jenjang_id->FormValue != NULL && $this->jenjang_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenjang_id->caption(), $this->jenjang_id->RequiredErrorMessage));
			}
		}
		if ($this->jabatan_id->Required) {
			if (!$this->jabatan_id->IsDetailKey && $this->jabatan_id->FormValue != NULL && $this->jabatan_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jabatan_id->caption(), $this->jabatan_id->RequiredErrorMessage));
			}
		}
		if ($this->lama_kerja->Required) {
			if (!$this->lama_kerja->IsDetailKey && $this->lama_kerja->FormValue != NULL && $this->lama_kerja->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->lama_kerja->caption(), $this->lama_kerja->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->lama_kerja->FormValue)) {
			AddMessage($FormError, $this->lama_kerja->errorMessage());
		}
		if ($this->type->Required) {
			if (!$this->type->IsDetailKey && $this->type->FormValue != NULL && $this->type->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->type->caption(), $this->type->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->type->FormValue)) {
			AddMessage($FormError, $this->type->errorMessage());
		}
		if ($this->jenis_guru->Required) {
			if (!$this->jenis_guru->IsDetailKey && $this->jenis_guru->FormValue != NULL && $this->jenis_guru->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenis_guru->caption(), $this->jenis_guru->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jenis_guru->FormValue)) {
			AddMessage($FormError, $this->jenis_guru->errorMessage());
		}
		if ($this->tambahan->Required) {
			if (!$this->tambahan->IsDetailKey && $this->tambahan->FormValue != NULL && $this->tambahan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tambahan->caption(), $this->tambahan->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tambahan->FormValue)) {
			AddMessage($FormError, $this->tambahan->errorMessage());
		}
		if ($this->periode->Required) {
			if (!$this->periode->IsDetailKey && $this->periode->FormValue != NULL && $this->periode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->periode->caption(), $this->periode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->periode->FormValue)) {
			AddMessage($FormError, $this->periode->errorMessage());
		}
		if ($this->tunjangan_periode->Required) {
			if (!$this->tunjangan_periode->IsDetailKey && $this->tunjangan_periode->FormValue != NULL && $this->tunjangan_periode->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tunjangan_periode->caption(), $this->tunjangan_periode->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tunjangan_periode->FormValue)) {
			AddMessage($FormError, $this->tunjangan_periode->errorMessage());
		}
		if ($this->kehadiran->Required) {
			if (!$this->kehadiran->IsDetailKey && $this->kehadiran->FormValue != NULL && $this->kehadiran->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kehadiran->caption(), $this->kehadiran->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->kehadiran->FormValue)) {
			AddMessage($FormError, $this->kehadiran->errorMessage());
		}
		if ($this->value_kehadiran->Required) {
			if (!$this->value_kehadiran->IsDetailKey && $this->value_kehadiran->FormValue != NULL && $this->value_kehadiran->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->value_kehadiran->caption(), $this->value_kehadiran->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->value_kehadiran->FormValue)) {
			AddMessage($FormError, $this->value_kehadiran->errorMessage());
		}
		if ($this->jp->Required) {
			if (!$this->jp->IsDetailKey && $this->jp->FormValue != NULL && $this->jp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jp->caption(), $this->jp->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jp->FormValue)) {
			AddMessage($FormError, $this->jp->errorMessage());
		}
		if ($this->gapok->Required) {
			if (!$this->gapok->IsDetailKey && $this->gapok->FormValue != NULL && $this->gapok->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->gapok->caption(), $this->gapok->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->gapok->FormValue)) {
			AddMessage($FormError, $this->gapok->errorMessage());
		}
		if ($this->total_gapok->Required) {
			if (!$this->total_gapok->IsDetailKey && $this->total_gapok->FormValue != NULL && $this->total_gapok->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->total_gapok->caption(), $this->total_gapok->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->total_gapok->FormValue)) {
			AddMessage($FormError, $this->total_gapok->errorMessage());
		}
		if ($this->lembur->Required) {
			if (!$this->lembur->IsDetailKey && $this->lembur->FormValue != NULL && $this->lembur->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->lembur->caption(), $this->lembur->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->lembur->FormValue)) {
			AddMessage($FormError, $this->lembur->errorMessage());
		}
		if ($this->value_lembur->Required) {
			if (!$this->value_lembur->IsDetailKey && $this->value_lembur->FormValue != NULL && $this->value_lembur->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->value_lembur->caption(), $this->value_lembur->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->value_lembur->FormValue)) {
			AddMessage($FormError, $this->value_lembur->errorMessage());
		}
		if ($this->value_reward->Required) {
			if (!$this->value_reward->IsDetailKey && $this->value_reward->FormValue != NULL && $this->value_reward->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->value_reward->caption(), $this->value_reward->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->value_reward->FormValue)) {
			AddMessage($FormError, $this->value_reward->errorMessage());
		}
		if ($this->value_inval->Required) {
			if (!$this->value_inval->IsDetailKey && $this->value_inval->FormValue != NULL && $this->value_inval->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->value_inval->caption(), $this->value_inval->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->value_inval->FormValue)) {
			AddMessage($FormError, $this->value_inval->errorMessage());
		}
		if ($this->piket_count->Required) {
			if (!$this->piket_count->IsDetailKey && $this->piket_count->FormValue != NULL && $this->piket_count->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->piket_count->caption(), $this->piket_count->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->piket_count->FormValue)) {
			AddMessage($FormError, $this->piket_count->errorMessage());
		}
		if ($this->value_piket->Required) {
			if (!$this->value_piket->IsDetailKey && $this->value_piket->FormValue != NULL && $this->value_piket->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->value_piket->caption(), $this->value_piket->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->value_piket->FormValue)) {
			AddMessage($FormError, $this->value_piket->errorMessage());
		}
		if ($this->tugastambahan->Required) {
			if (!$this->tugastambahan->IsDetailKey && $this->tugastambahan->FormValue != NULL && $this->tugastambahan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tugastambahan->caption(), $this->tugastambahan->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tugastambahan->FormValue)) {
			AddMessage($FormError, $this->tugastambahan->errorMessage());
		}
		if ($this->tj_jabatan->Required) {
			if (!$this->tj_jabatan->IsDetailKey && $this->tj_jabatan->FormValue != NULL && $this->tj_jabatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tj_jabatan->caption(), $this->tj_jabatan->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tj_jabatan->FormValue)) {
			AddMessage($FormError, $this->tj_jabatan->errorMessage());
		}
		if ($this->sub_total->Required) {
			if (!$this->sub_total->IsDetailKey && $this->sub_total->FormValue != NULL && $this->sub_total->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sub_total->caption(), $this->sub_total->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->sub_total->FormValue)) {
			AddMessage($FormError, $this->sub_total->errorMessage());
		}
		if ($this->potongan->Required) {
			if (!$this->potongan->IsDetailKey && $this->potongan->FormValue != NULL && $this->potongan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->potongan->caption(), $this->potongan->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->potongan->FormValue)) {
			AddMessage($FormError, $this->potongan->errorMessage());
		}
		if ($this->penyesuaian->Required) {
			if (!$this->penyesuaian->IsDetailKey && $this->penyesuaian->FormValue != NULL && $this->penyesuaian->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->penyesuaian->caption(), $this->penyesuaian->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->penyesuaian->FormValue)) {
			AddMessage($FormError, $this->penyesuaian->errorMessage());
		}
		if ($this->total->Required) {
			if (!$this->total->IsDetailKey && $this->total->FormValue != NULL && $this->total->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->total->caption(), $this->total->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->total->FormValue)) {
			AddMessage($FormError, $this->total->errorMessage());
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError != "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Delete records based on current filter
	protected function deleteRows()
	{
		global $Language, $Security;
		if (!$Security->canDelete()) {
			$this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$deleteRows = TRUE;
		$sql = $this->getCurrentSql();
		$conn = $this->getConnection();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
			$rs->close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->getRows() : [];

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->close();

		// Call row deleting event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$deleteRows = $this->Row_Deleting($row);
				if (!$deleteRows)
					break;
			}
		}
		if ($deleteRows) {
			$key = "";
			foreach ($rsold as $row) {
				$thisKey = "";
				if ($thisKey != "")
					$thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
				$thisKey .= $row['id'];
				if (Config("DELETE_UPLOADED_FILES")) // Delete old files
					$this->deleteUploadedFiles($row);
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				$deleteRows = $this->delete($row); // Delete
				$conn->raiseErrorFn = "";
				if ($deleteRows === FALSE)
					break;
				if ($key != "")
					$key .= ", ";
				$key .= $thisKey;
			}
		}
		if (!$deleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("DeleteCancelled"));
			}
		}

		// Call Row Deleted event
		if ($deleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}

		// Write JSON for API request (Support single row only)
		if (IsApi() && $deleteRows) {
			$row = $this->getRecordsFromRecordset($rsold, TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $deleteRows;
	}

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$oldKeyFilter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($oldKeyFilter);
		$conn = $this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = Config("ERROR_FUNC");
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = "";
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// pegawai
			$this->pegawai->setDbValueDef($rsnew, $this->pegawai->CurrentValue, NULL, $this->pegawai->ReadOnly);

			// lama_kerja
			$this->lama_kerja->setDbValueDef($rsnew, $this->lama_kerja->CurrentValue, NULL, $this->lama_kerja->ReadOnly);

			// type
			$this->type->setDbValueDef($rsnew, $this->type->CurrentValue, NULL, $this->type->ReadOnly);

			// jenis_guru
			$this->jenis_guru->setDbValueDef($rsnew, $this->jenis_guru->CurrentValue, NULL, $this->jenis_guru->ReadOnly);

			// tambahan
			$this->tambahan->setDbValueDef($rsnew, $this->tambahan->CurrentValue, NULL, $this->tambahan->ReadOnly);

			// periode
			$this->periode->setDbValueDef($rsnew, $this->periode->CurrentValue, NULL, $this->periode->ReadOnly);

			// tunjangan_periode
			$this->tunjangan_periode->setDbValueDef($rsnew, $this->tunjangan_periode->CurrentValue, NULL, $this->tunjangan_periode->ReadOnly);

			// kehadiran
			$this->kehadiran->setDbValueDef($rsnew, $this->kehadiran->CurrentValue, NULL, $this->kehadiran->ReadOnly);

			// value_kehadiran
			$this->value_kehadiran->setDbValueDef($rsnew, $this->value_kehadiran->CurrentValue, NULL, $this->value_kehadiran->ReadOnly);

			// jp
			$this->jp->setDbValueDef($rsnew, $this->jp->CurrentValue, NULL, $this->jp->ReadOnly);

			// gapok
			$this->gapok->setDbValueDef($rsnew, $this->gapok->CurrentValue, NULL, $this->gapok->ReadOnly);

			// total_gapok
			$this->total_gapok->setDbValueDef($rsnew, $this->total_gapok->CurrentValue, NULL, $this->total_gapok->ReadOnly);

			// lembur
			$this->lembur->setDbValueDef($rsnew, $this->lembur->CurrentValue, NULL, $this->lembur->ReadOnly);

			// value_lembur
			$this->value_lembur->setDbValueDef($rsnew, $this->value_lembur->CurrentValue, NULL, $this->value_lembur->ReadOnly);

			// value_reward
			$this->value_reward->setDbValueDef($rsnew, $this->value_reward->CurrentValue, NULL, $this->value_reward->ReadOnly);

			// value_inval
			$this->value_inval->setDbValueDef($rsnew, $this->value_inval->CurrentValue, NULL, $this->value_inval->ReadOnly);

			// piket_count
			$this->piket_count->setDbValueDef($rsnew, $this->piket_count->CurrentValue, NULL, $this->piket_count->ReadOnly);

			// value_piket
			$this->value_piket->setDbValueDef($rsnew, $this->value_piket->CurrentValue, NULL, $this->value_piket->ReadOnly);

			// tugastambahan
			$this->tugastambahan->setDbValueDef($rsnew, $this->tugastambahan->CurrentValue, NULL, $this->tugastambahan->ReadOnly);

			// tj_jabatan
			$this->tj_jabatan->setDbValueDef($rsnew, $this->tj_jabatan->CurrentValue, NULL, $this->tj_jabatan->ReadOnly);

			// sub_total
			$this->sub_total->setDbValueDef($rsnew, $this->sub_total->CurrentValue, NULL, $this->sub_total->ReadOnly);

			// potongan
			$this->potongan->setDbValueDef($rsnew, $this->potongan->CurrentValue, NULL, $this->potongan->ReadOnly);

			// penyesuaian
			$this->penyesuaian->setDbValueDef($rsnew, $this->penyesuaian->CurrentValue, NULL, $this->penyesuaian->ReadOnly);

			// total
			$this->total->setDbValueDef($rsnew, $this->total->CurrentValue, NULL, $this->total->ReadOnly);

			// Check referential integrity for master table 'm_sd'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_m_sd();
			$keyValue = isset($rsnew['pid']) ? $rsnew['pid'] : $rsold['pid'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["m_sd"]))
					$GLOBALS["m_sd"] = new m_sd();
				$rsmaster = $GLOBALS["m_sd"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "m_sd", $Language->phrase("RelatedRecordRequired"));
				$this->setFailureMessage($relatedRecordMsg);
				$rs->close();
				return FALSE;
			}

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);

			// Check for duplicate key when key changed
			if ($updateRow) {
				$newKeyFilter = $this->getRecordFilter($rsnew);
				if ($newKeyFilter != $oldKeyFilter) {
					$rsChk = $this->loadRs($newKeyFilter);
					if ($rsChk && !$rsChk->EOF) {
						$keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
						$this->setFailureMessage($keyErrMsg);
						$rsChk->close();
						$updateRow = FALSE;
					}
				}
			}
			if ($updateRow) {
				$conn->raiseErrorFn = Config("ERROR_FUNC");
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = "";
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage != "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Clean upload path if any
		if ($editRow) {
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;

		// Set up foreign key field value from Session
			if ($this->getCurrentMasterTable() == "m_sd") {
				$this->pid->CurrentValue = $this->pid->getSessionValue();
			}

		// Check referential integrity for master table 'gaji'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_m_sd();
		if ($this->pid->getSessionValue() != "") {
			$masterFilter = str_replace("@id@", AdjustSql($this->pid->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["m_sd"]))
				$GLOBALS["m_sd"] = new m_sd();
			$rsmaster = $GLOBALS["m_sd"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "m_sd", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// pegawai
		$this->pegawai->setDbValueDef($rsnew, $this->pegawai->CurrentValue, NULL, FALSE);

		// jenjang_id
		$this->jenjang_id->setDbValueDef($rsnew, $this->jenjang_id->CurrentValue, NULL, FALSE);

		// jabatan_id
		$this->jabatan_id->setDbValueDef($rsnew, $this->jabatan_id->CurrentValue, NULL, FALSE);

		// lama_kerja
		$this->lama_kerja->setDbValueDef($rsnew, $this->lama_kerja->CurrentValue, NULL, FALSE);

		// type
		$this->type->setDbValueDef($rsnew, $this->type->CurrentValue, NULL, FALSE);

		// jenis_guru
		$this->jenis_guru->setDbValueDef($rsnew, $this->jenis_guru->CurrentValue, NULL, FALSE);

		// tambahan
		$this->tambahan->setDbValueDef($rsnew, $this->tambahan->CurrentValue, NULL, FALSE);

		// periode
		$this->periode->setDbValueDef($rsnew, $this->periode->CurrentValue, NULL, FALSE);

		// tunjangan_periode
		$this->tunjangan_periode->setDbValueDef($rsnew, $this->tunjangan_periode->CurrentValue, NULL, FALSE);

		// kehadiran
		$this->kehadiran->setDbValueDef($rsnew, $this->kehadiran->CurrentValue, NULL, FALSE);

		// value_kehadiran
		$this->value_kehadiran->setDbValueDef($rsnew, $this->value_kehadiran->CurrentValue, NULL, FALSE);

		// jp
		$this->jp->setDbValueDef($rsnew, $this->jp->CurrentValue, NULL, FALSE);

		// gapok
		$this->gapok->setDbValueDef($rsnew, $this->gapok->CurrentValue, NULL, FALSE);

		// total_gapok
		$this->total_gapok->setDbValueDef($rsnew, $this->total_gapok->CurrentValue, NULL, FALSE);

		// lembur
		$this->lembur->setDbValueDef($rsnew, $this->lembur->CurrentValue, NULL, FALSE);

		// value_lembur
		$this->value_lembur->setDbValueDef($rsnew, $this->value_lembur->CurrentValue, NULL, FALSE);

		// value_reward
		$this->value_reward->setDbValueDef($rsnew, $this->value_reward->CurrentValue, NULL, FALSE);

		// value_inval
		$this->value_inval->setDbValueDef($rsnew, $this->value_inval->CurrentValue, NULL, FALSE);

		// piket_count
		$this->piket_count->setDbValueDef($rsnew, $this->piket_count->CurrentValue, NULL, FALSE);

		// value_piket
		$this->value_piket->setDbValueDef($rsnew, $this->value_piket->CurrentValue, NULL, FALSE);

		// tugastambahan
		$this->tugastambahan->setDbValueDef($rsnew, $this->tugastambahan->CurrentValue, NULL, FALSE);

		// tj_jabatan
		$this->tj_jabatan->setDbValueDef($rsnew, $this->tj_jabatan->CurrentValue, NULL, FALSE);

		// sub_total
		$this->sub_total->setDbValueDef($rsnew, $this->sub_total->CurrentValue, NULL, FALSE);

		// potongan
		$this->potongan->setDbValueDef($rsnew, $this->potongan->CurrentValue, NULL, FALSE);

		// penyesuaian
		$this->penyesuaian->setDbValueDef($rsnew, $this->penyesuaian->CurrentValue, NULL, FALSE);

		// total
		$this->total->setDbValueDef($rsnew, $this->total->CurrentValue, NULL, FALSE);

		// pid
		if ($this->pid->getSessionValue() != "") {
			$rsnew['pid'] = $this->pid->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage != "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Clean upload path if any
		if ($addRow) {
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{

		// Hide foreign keys
		$masterTblVar = $this->getCurrentMasterTable();
		if ($masterTblVar == "m_sd") {
			$this->pid->Visible = FALSE;
			if ($GLOBALS["m_sd"]->EventCancelled)
				$this->EventCancelled = TRUE;
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// Get default connection and filter
			$conn = $this->getConnection();
			$lookupFilter = "";

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL and connection
			switch ($fld->FieldVar) {
				case "x_pegawai":
					break;
				case "x_jenjang_id":
					break;
				case "x_jabatan_id":
					break;
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
				$totalCnt = $this->getRecordCount($sql, $conn);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
						case "x_pegawai":
							break;
						case "x_jenjang_id":
							break;
						case "x_jabatan_id":
							break;
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
		//list

		$counttu = ExecuteRow("SELECT COUNT(*) AS jmlh FROM pegawai WHERE jenjang_id='2' AND `type`= '1';");
		$this->GridAddRowCount = $counttu['jmlh'];
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions["new"]->Body = "xxx";

	}
} // End class
?>