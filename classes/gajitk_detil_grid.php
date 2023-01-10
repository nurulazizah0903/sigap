<?php
namespace PHPMaker2020\sigap;

/**
 * Page class
 */
class gajitk_detil_grid extends gajitk_detil
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}";

	// Table name
	public $TableName = 'gajitk_detil';

	// Page object name
	public $PageObjName = "gajitk_detil_grid";

	// Grid form hidden field names
	public $FormName = "fgajitk_detilgrid";
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

		// Table object (gajitk_detil)
		if (!isset($GLOBALS["gajitk_detil"]) || get_class($GLOBALS["gajitk_detil"]) == PROJECT_NAMESPACE . "gajitk_detil") {
			$GLOBALS["gajitk_detil"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["gajitk_detil"];

		}
		$this->AddUrl = "gajitk_detiladd.php";

		// Table object (pegawai)
		if (!isset($GLOBALS['pegawai']))
			$GLOBALS['pegawai'] = new pegawai();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'gajitk_detil');

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
		global $gajitk_detil;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($gajitk_detil);
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
		$this->pegawai_id->setVisibility();
		$this->jabatan_id->setVisibility();
		$this->masakerja->setVisibility();
		$this->jumngajar->setVisibility();
		$this->ijin->setVisibility();
		$this->voucher->setVisibility();
		$this->tunjangan_khusus->setVisibility();
		$this->tunjangan_jabatan->setVisibility();
		$this->baku->setVisibility();
		$this->kehadiran->setVisibility();
		$this->prestasi->setVisibility();
		$this->jumlahgaji->setVisibility();
		$this->jumgajitotal->setVisibility();
		$this->potongan1->setVisibility();
		$this->potongan2->setVisibility();
		$this->jumlahterima->setVisibility();
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
		$this->setupLookupOptions($this->pegawai_id);
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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "gajitk") {
			global $gajitk;
			$rsmaster = $gajitk->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("gajitklist.php"); // Return to master page
			} else {
				$gajitk->loadListRowValues($rsmaster);
				$gajitk->RowType = ROWTYPE_MASTER; // Master row
				$gajitk->renderListRow();
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
		if ($CurrentForm->hasValue("x_pegawai_id") && $CurrentForm->hasValue("o_pegawai_id") && $this->pegawai_id->CurrentValue != $this->pegawai_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jabatan_id") && $CurrentForm->hasValue("o_jabatan_id") && $this->jabatan_id->CurrentValue != $this->jabatan_id->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_masakerja") && $CurrentForm->hasValue("o_masakerja") && $this->masakerja->CurrentValue != $this->masakerja->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jumngajar") && $CurrentForm->hasValue("o_jumngajar") && $this->jumngajar->CurrentValue != $this->jumngajar->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ijin") && $CurrentForm->hasValue("o_ijin") && $this->ijin->CurrentValue != $this->ijin->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_voucher") && $CurrentForm->hasValue("o_voucher") && $this->voucher->CurrentValue != $this->voucher->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tunjangan_khusus") && $CurrentForm->hasValue("o_tunjangan_khusus") && $this->tunjangan_khusus->CurrentValue != $this->tunjangan_khusus->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tunjangan_jabatan") && $CurrentForm->hasValue("o_tunjangan_jabatan") && $this->tunjangan_jabatan->CurrentValue != $this->tunjangan_jabatan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_baku") && $CurrentForm->hasValue("o_baku") && $this->baku->CurrentValue != $this->baku->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_kehadiran") && $CurrentForm->hasValue("o_kehadiran") && $this->kehadiran->CurrentValue != $this->kehadiran->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_prestasi") && $CurrentForm->hasValue("o_prestasi") && $this->prestasi->CurrentValue != $this->prestasi->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jumlahgaji") && $CurrentForm->hasValue("o_jumlahgaji") && $this->jumlahgaji->CurrentValue != $this->jumlahgaji->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jumgajitotal") && $CurrentForm->hasValue("o_jumgajitotal") && $this->jumgajitotal->CurrentValue != $this->jumgajitotal->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_potongan1") && $CurrentForm->hasValue("o_potongan1") && $this->potongan1->CurrentValue != $this->potongan1->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_potongan2") && $CurrentForm->hasValue("o_potongan2") && $this->potongan2->CurrentValue != $this->potongan2->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jumlahterima") && $CurrentForm->hasValue("o_jumlahterima") && $this->jumlahterima->CurrentValue != $this->jumlahterima->OldValue)
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
		$this->pegawai_id->CurrentValue = NULL;
		$this->pegawai_id->OldValue = $this->pegawai_id->CurrentValue;
		$this->jabatan_id->CurrentValue = NULL;
		$this->jabatan_id->OldValue = $this->jabatan_id->CurrentValue;
		$this->masakerja->CurrentValue = NULL;
		$this->masakerja->OldValue = $this->masakerja->CurrentValue;
		$this->jumngajar->CurrentValue = NULL;
		$this->jumngajar->OldValue = $this->jumngajar->CurrentValue;
		$this->ijin->CurrentValue = NULL;
		$this->ijin->OldValue = $this->ijin->CurrentValue;
		$this->voucher->CurrentValue = NULL;
		$this->voucher->OldValue = $this->voucher->CurrentValue;
		$this->tunjangan_khusus->CurrentValue = NULL;
		$this->tunjangan_khusus->OldValue = $this->tunjangan_khusus->CurrentValue;
		$this->tunjangan_jabatan->CurrentValue = NULL;
		$this->tunjangan_jabatan->OldValue = $this->tunjangan_jabatan->CurrentValue;
		$this->baku->CurrentValue = NULL;
		$this->baku->OldValue = $this->baku->CurrentValue;
		$this->kehadiran->CurrentValue = NULL;
		$this->kehadiran->OldValue = $this->kehadiran->CurrentValue;
		$this->prestasi->CurrentValue = NULL;
		$this->prestasi->OldValue = $this->prestasi->CurrentValue;
		$this->jumlahgaji->CurrentValue = NULL;
		$this->jumlahgaji->OldValue = $this->jumlahgaji->CurrentValue;
		$this->jumgajitotal->CurrentValue = NULL;
		$this->jumgajitotal->OldValue = $this->jumgajitotal->CurrentValue;
		$this->potongan1->CurrentValue = NULL;
		$this->potongan1->OldValue = $this->potongan1->CurrentValue;
		$this->potongan2->CurrentValue = NULL;
		$this->potongan2->OldValue = $this->potongan2->CurrentValue;
		$this->jumlahterima->CurrentValue = NULL;
		$this->jumlahterima->OldValue = $this->jumlahterima->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'pegawai_id' first before field var 'x_pegawai_id'
		$val = $CurrentForm->hasValue("pegawai_id") ? $CurrentForm->getValue("pegawai_id") : $CurrentForm->getValue("x_pegawai_id");
		if (!$this->pegawai_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pegawai_id->Visible = FALSE; // Disable update for API request
			else
				$this->pegawai_id->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_pegawai_id"))
			$this->pegawai_id->setOldValue($CurrentForm->getValue("o_pegawai_id"));

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

		// Check field name 'masakerja' first before field var 'x_masakerja'
		$val = $CurrentForm->hasValue("masakerja") ? $CurrentForm->getValue("masakerja") : $CurrentForm->getValue("x_masakerja");
		if (!$this->masakerja->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->masakerja->Visible = FALSE; // Disable update for API request
			else
				$this->masakerja->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_masakerja"))
			$this->masakerja->setOldValue($CurrentForm->getValue("o_masakerja"));

		// Check field name 'jumngajar' first before field var 'x_jumngajar'
		$val = $CurrentForm->hasValue("jumngajar") ? $CurrentForm->getValue("jumngajar") : $CurrentForm->getValue("x_jumngajar");
		if (!$this->jumngajar->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jumngajar->Visible = FALSE; // Disable update for API request
			else
				$this->jumngajar->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jumngajar"))
			$this->jumngajar->setOldValue($CurrentForm->getValue("o_jumngajar"));

		// Check field name 'ijin' first before field var 'x_ijin'
		$val = $CurrentForm->hasValue("ijin") ? $CurrentForm->getValue("ijin") : $CurrentForm->getValue("x_ijin");
		if (!$this->ijin->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ijin->Visible = FALSE; // Disable update for API request
			else
				$this->ijin->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ijin"))
			$this->ijin->setOldValue($CurrentForm->getValue("o_ijin"));

		// Check field name 'voucher' first before field var 'x_voucher'
		$val = $CurrentForm->hasValue("voucher") ? $CurrentForm->getValue("voucher") : $CurrentForm->getValue("x_voucher");
		if (!$this->voucher->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->voucher->Visible = FALSE; // Disable update for API request
			else
				$this->voucher->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_voucher"))
			$this->voucher->setOldValue($CurrentForm->getValue("o_voucher"));

		// Check field name 'tunjangan_khusus' first before field var 'x_tunjangan_khusus'
		$val = $CurrentForm->hasValue("tunjangan_khusus") ? $CurrentForm->getValue("tunjangan_khusus") : $CurrentForm->getValue("x_tunjangan_khusus");
		if (!$this->tunjangan_khusus->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tunjangan_khusus->Visible = FALSE; // Disable update for API request
			else
				$this->tunjangan_khusus->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tunjangan_khusus"))
			$this->tunjangan_khusus->setOldValue($CurrentForm->getValue("o_tunjangan_khusus"));

		// Check field name 'tunjangan_jabatan' first before field var 'x_tunjangan_jabatan'
		$val = $CurrentForm->hasValue("tunjangan_jabatan") ? $CurrentForm->getValue("tunjangan_jabatan") : $CurrentForm->getValue("x_tunjangan_jabatan");
		if (!$this->tunjangan_jabatan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tunjangan_jabatan->Visible = FALSE; // Disable update for API request
			else
				$this->tunjangan_jabatan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_tunjangan_jabatan"))
			$this->tunjangan_jabatan->setOldValue($CurrentForm->getValue("o_tunjangan_jabatan"));

		// Check field name 'baku' first before field var 'x_baku'
		$val = $CurrentForm->hasValue("baku") ? $CurrentForm->getValue("baku") : $CurrentForm->getValue("x_baku");
		if (!$this->baku->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->baku->Visible = FALSE; // Disable update for API request
			else
				$this->baku->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_baku"))
			$this->baku->setOldValue($CurrentForm->getValue("o_baku"));

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

		// Check field name 'prestasi' first before field var 'x_prestasi'
		$val = $CurrentForm->hasValue("prestasi") ? $CurrentForm->getValue("prestasi") : $CurrentForm->getValue("x_prestasi");
		if (!$this->prestasi->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->prestasi->Visible = FALSE; // Disable update for API request
			else
				$this->prestasi->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_prestasi"))
			$this->prestasi->setOldValue($CurrentForm->getValue("o_prestasi"));

		// Check field name 'jumlahgaji' first before field var 'x_jumlahgaji'
		$val = $CurrentForm->hasValue("jumlahgaji") ? $CurrentForm->getValue("jumlahgaji") : $CurrentForm->getValue("x_jumlahgaji");
		if (!$this->jumlahgaji->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jumlahgaji->Visible = FALSE; // Disable update for API request
			else
				$this->jumlahgaji->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jumlahgaji"))
			$this->jumlahgaji->setOldValue($CurrentForm->getValue("o_jumlahgaji"));

		// Check field name 'jumgajitotal' first before field var 'x_jumgajitotal'
		$val = $CurrentForm->hasValue("jumgajitotal") ? $CurrentForm->getValue("jumgajitotal") : $CurrentForm->getValue("x_jumgajitotal");
		if (!$this->jumgajitotal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jumgajitotal->Visible = FALSE; // Disable update for API request
			else
				$this->jumgajitotal->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jumgajitotal"))
			$this->jumgajitotal->setOldValue($CurrentForm->getValue("o_jumgajitotal"));

		// Check field name 'potongan1' first before field var 'x_potongan1'
		$val = $CurrentForm->hasValue("potongan1") ? $CurrentForm->getValue("potongan1") : $CurrentForm->getValue("x_potongan1");
		if (!$this->potongan1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->potongan1->Visible = FALSE; // Disable update for API request
			else
				$this->potongan1->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_potongan1"))
			$this->potongan1->setOldValue($CurrentForm->getValue("o_potongan1"));

		// Check field name 'potongan2' first before field var 'x_potongan2'
		$val = $CurrentForm->hasValue("potongan2") ? $CurrentForm->getValue("potongan2") : $CurrentForm->getValue("x_potongan2");
		if (!$this->potongan2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->potongan2->Visible = FALSE; // Disable update for API request
			else
				$this->potongan2->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_potongan2"))
			$this->potongan2->setOldValue($CurrentForm->getValue("o_potongan2"));

		// Check field name 'jumlahterima' first before field var 'x_jumlahterima'
		$val = $CurrentForm->hasValue("jumlahterima") ? $CurrentForm->getValue("jumlahterima") : $CurrentForm->getValue("x_jumlahterima");
		if (!$this->jumlahterima->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jumlahterima->Visible = FALSE; // Disable update for API request
			else
				$this->jumlahterima->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jumlahterima"))
			$this->jumlahterima->setOldValue($CurrentForm->getValue("o_jumlahterima"));

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
		$this->pegawai_id->CurrentValue = $this->pegawai_id->FormValue;
		$this->jabatan_id->CurrentValue = $this->jabatan_id->FormValue;
		$this->masakerja->CurrentValue = $this->masakerja->FormValue;
		$this->jumngajar->CurrentValue = $this->jumngajar->FormValue;
		$this->ijin->CurrentValue = $this->ijin->FormValue;
		$this->voucher->CurrentValue = $this->voucher->FormValue;
		$this->tunjangan_khusus->CurrentValue = $this->tunjangan_khusus->FormValue;
		$this->tunjangan_jabatan->CurrentValue = $this->tunjangan_jabatan->FormValue;
		$this->baku->CurrentValue = $this->baku->FormValue;
		$this->kehadiran->CurrentValue = $this->kehadiran->FormValue;
		$this->prestasi->CurrentValue = $this->prestasi->FormValue;
		$this->jumlahgaji->CurrentValue = $this->jumlahgaji->FormValue;
		$this->jumgajitotal->CurrentValue = $this->jumgajitotal->FormValue;
		$this->potongan1->CurrentValue = $this->potongan1->FormValue;
		$this->potongan2->CurrentValue = $this->potongan2->FormValue;
		$this->jumlahterima->CurrentValue = $this->jumlahterima->FormValue;
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
		$this->pegawai_id->setDbValue($row['pegawai_id']);
		$this->jabatan_id->setDbValue($row['jabatan_id']);
		$this->masakerja->setDbValue($row['masakerja']);
		$this->jumngajar->setDbValue($row['jumngajar']);
		$this->ijin->setDbValue($row['ijin']);
		$this->voucher->setDbValue($row['voucher']);
		$this->tunjangan_khusus->setDbValue($row['tunjangan_khusus']);
		$this->tunjangan_jabatan->setDbValue($row['tunjangan_jabatan']);
		$this->baku->setDbValue($row['baku']);
		$this->kehadiran->setDbValue($row['kehadiran']);
		$this->prestasi->setDbValue($row['prestasi']);
		$this->jumlahgaji->setDbValue($row['jumlahgaji']);
		$this->jumgajitotal->setDbValue($row['jumgajitotal']);
		$this->potongan1->setDbValue($row['potongan1']);
		$this->potongan2->setDbValue($row['potongan2']);
		$this->jumlahterima->setDbValue($row['jumlahterima']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['pid'] = $this->pid->CurrentValue;
		$row['pegawai_id'] = $this->pegawai_id->CurrentValue;
		$row['jabatan_id'] = $this->jabatan_id->CurrentValue;
		$row['masakerja'] = $this->masakerja->CurrentValue;
		$row['jumngajar'] = $this->jumngajar->CurrentValue;
		$row['ijin'] = $this->ijin->CurrentValue;
		$row['voucher'] = $this->voucher->CurrentValue;
		$row['tunjangan_khusus'] = $this->tunjangan_khusus->CurrentValue;
		$row['tunjangan_jabatan'] = $this->tunjangan_jabatan->CurrentValue;
		$row['baku'] = $this->baku->CurrentValue;
		$row['kehadiran'] = $this->kehadiran->CurrentValue;
		$row['prestasi'] = $this->prestasi->CurrentValue;
		$row['jumlahgaji'] = $this->jumlahgaji->CurrentValue;
		$row['jumgajitotal'] = $this->jumgajitotal->CurrentValue;
		$row['potongan1'] = $this->potongan1->CurrentValue;
		$row['potongan2'] = $this->potongan2->CurrentValue;
		$row['jumlahterima'] = $this->jumlahterima->CurrentValue;
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
		// pegawai_id
		// jabatan_id
		// masakerja
		// jumngajar
		// ijin
		// voucher
		// tunjangan_khusus
		// tunjangan_jabatan
		// baku
		// kehadiran
		// prestasi
		// jumlahgaji
		// jumgajitotal
		// potongan1
		// potongan2
		// jumlahterima

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// pid
			$this->pid->ViewValue = $this->pid->CurrentValue;
			$this->pid->ViewValue = FormatNumber($this->pid->ViewValue, 0, -2, -2, -2);
			$this->pid->ViewCustomAttributes = "";

			// pegawai_id
			$curVal = strval($this->pegawai_id->CurrentValue);
			if ($curVal != "") {
				$this->pegawai_id->ViewValue = $this->pegawai_id->lookupCacheOption($curVal);
				if ($this->pegawai_id->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
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

			// voucher
			$this->voucher->ViewValue = $this->voucher->CurrentValue;
			$this->voucher->ViewValue = FormatNumber($this->voucher->ViewValue, 0, -2, -2, -2);
			$this->voucher->ViewCustomAttributes = "";

			// tunjangan_khusus
			$this->tunjangan_khusus->ViewValue = $this->tunjangan_khusus->CurrentValue;
			$this->tunjangan_khusus->ViewValue = FormatNumber($this->tunjangan_khusus->ViewValue, 0, -2, -2, -2);
			$this->tunjangan_khusus->ViewCustomAttributes = "";

			// tunjangan_jabatan
			$this->tunjangan_jabatan->ViewValue = $this->tunjangan_jabatan->CurrentValue;
			$this->tunjangan_jabatan->ViewValue = FormatNumber($this->tunjangan_jabatan->ViewValue, 0, -2, -2, -2);
			$this->tunjangan_jabatan->ViewCustomAttributes = "";

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

			// voucher
			$this->voucher->LinkCustomAttributes = "";
			$this->voucher->HrefValue = "";
			$this->voucher->TooltipValue = "";

			// tunjangan_khusus
			$this->tunjangan_khusus->LinkCustomAttributes = "";
			$this->tunjangan_khusus->HrefValue = "";
			$this->tunjangan_khusus->TooltipValue = "";

			// tunjangan_jabatan
			$this->tunjangan_jabatan->LinkCustomAttributes = "";
			$this->tunjangan_jabatan->HrefValue = "";
			$this->tunjangan_jabatan->TooltipValue = "";

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// pegawai_id
			$this->pegawai_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->pegawai_id->CurrentValue));
			if ($curVal != "")
				$this->pegawai_id->ViewValue = $this->pegawai_id->lookupCacheOption($curVal);
			else
				$this->pegawai_id->ViewValue = $this->pegawai_id->Lookup !== NULL && is_array($this->pegawai_id->Lookup->Options) ? $curVal : NULL;
			if ($this->pegawai_id->ViewValue !== NULL) { // Load from cache
				$this->pegawai_id->EditValue = array_values($this->pegawai_id->Lookup->Options);
				if ($this->pegawai_id->ViewValue == "")
					$this->pegawai_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->pegawai_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->pegawai_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->pegawai_id->ViewValue = $this->pegawai_id->displayValue($arwrk);
				} else {
					$this->pegawai_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->pegawai_id->EditValue = $arwrk;
			}

			// jabatan_id
			$this->jabatan_id->EditAttrs["class"] = "form-control";
			$this->jabatan_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->jabatan_id->CurrentValue));
			if ($curVal != "")
				$this->jabatan_id->ViewValue = $this->jabatan_id->lookupCacheOption($curVal);
			else
				$this->jabatan_id->ViewValue = $this->jabatan_id->Lookup !== NULL && is_array($this->jabatan_id->Lookup->Options) ? $curVal : NULL;
			if ($this->jabatan_id->ViewValue !== NULL) { // Load from cache
				$this->jabatan_id->EditValue = array_values($this->jabatan_id->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->jabatan_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->jabatan_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->jabatan_id->EditValue = $arwrk;
			}

			// masakerja
			$this->masakerja->EditAttrs["class"] = "form-control";
			$this->masakerja->EditCustomAttributes = "";
			$this->masakerja->EditValue = HtmlEncode($this->masakerja->CurrentValue);
			$this->masakerja->PlaceHolder = RemoveHtml($this->masakerja->caption());

			// jumngajar
			$this->jumngajar->EditAttrs["class"] = "form-control";
			$this->jumngajar->EditCustomAttributes = "";
			$this->jumngajar->EditValue = HtmlEncode($this->jumngajar->CurrentValue);
			$this->jumngajar->PlaceHolder = RemoveHtml($this->jumngajar->caption());

			// ijin
			$this->ijin->EditAttrs["class"] = "form-control";
			$this->ijin->EditCustomAttributes = "";
			$this->ijin->EditValue = HtmlEncode($this->ijin->CurrentValue);
			$this->ijin->PlaceHolder = RemoveHtml($this->ijin->caption());

			// voucher
			$this->voucher->EditAttrs["class"] = "form-control";
			$this->voucher->EditCustomAttributes = "";
			$this->voucher->EditValue = HtmlEncode($this->voucher->CurrentValue);
			$this->voucher->PlaceHolder = RemoveHtml($this->voucher->caption());

			// tunjangan_khusus
			$this->tunjangan_khusus->EditAttrs["class"] = "form-control";
			$this->tunjangan_khusus->EditCustomAttributes = "";
			$this->tunjangan_khusus->EditValue = HtmlEncode($this->tunjangan_khusus->CurrentValue);
			$this->tunjangan_khusus->PlaceHolder = RemoveHtml($this->tunjangan_khusus->caption());

			// tunjangan_jabatan
			$this->tunjangan_jabatan->EditAttrs["class"] = "form-control";
			$this->tunjangan_jabatan->EditCustomAttributes = "";
			$this->tunjangan_jabatan->EditValue = HtmlEncode($this->tunjangan_jabatan->CurrentValue);
			$this->tunjangan_jabatan->PlaceHolder = RemoveHtml($this->tunjangan_jabatan->caption());

			// baku
			$this->baku->EditAttrs["class"] = "form-control";
			$this->baku->EditCustomAttributes = "";
			$this->baku->EditValue = HtmlEncode($this->baku->CurrentValue);
			$this->baku->PlaceHolder = RemoveHtml($this->baku->caption());

			// kehadiran
			$this->kehadiran->EditAttrs["class"] = "form-control";
			$this->kehadiran->EditCustomAttributes = "";
			$this->kehadiran->EditValue = HtmlEncode($this->kehadiran->CurrentValue);
			$this->kehadiran->PlaceHolder = RemoveHtml($this->kehadiran->caption());

			// prestasi
			$this->prestasi->EditAttrs["class"] = "form-control";
			$this->prestasi->EditCustomAttributes = "";
			$this->prestasi->EditValue = HtmlEncode($this->prestasi->CurrentValue);
			$this->prestasi->PlaceHolder = RemoveHtml($this->prestasi->caption());

			// jumlahgaji
			$this->jumlahgaji->EditAttrs["class"] = "form-control";
			$this->jumlahgaji->EditCustomAttributes = "";
			$this->jumlahgaji->EditValue = HtmlEncode($this->jumlahgaji->CurrentValue);
			$this->jumlahgaji->PlaceHolder = RemoveHtml($this->jumlahgaji->caption());

			// jumgajitotal
			$this->jumgajitotal->EditAttrs["class"] = "form-control";
			$this->jumgajitotal->EditCustomAttributes = "";
			$this->jumgajitotal->EditValue = HtmlEncode($this->jumgajitotal->CurrentValue);
			$this->jumgajitotal->PlaceHolder = RemoveHtml($this->jumgajitotal->caption());

			// potongan1
			$this->potongan1->EditAttrs["class"] = "form-control";
			$this->potongan1->EditCustomAttributes = "";
			$this->potongan1->EditValue = HtmlEncode($this->potongan1->CurrentValue);
			$this->potongan1->PlaceHolder = RemoveHtml($this->potongan1->caption());

			// potongan2
			$this->potongan2->EditAttrs["class"] = "form-control";
			$this->potongan2->EditCustomAttributes = "";
			$this->potongan2->EditValue = HtmlEncode($this->potongan2->CurrentValue);
			$this->potongan2->PlaceHolder = RemoveHtml($this->potongan2->caption());

			// jumlahterima
			$this->jumlahterima->EditAttrs["class"] = "form-control";
			$this->jumlahterima->EditCustomAttributes = "";
			$this->jumlahterima->EditValue = HtmlEncode($this->jumlahterima->CurrentValue);
			$this->jumlahterima->PlaceHolder = RemoveHtml($this->jumlahterima->caption());

			// Add refer script
			// pegawai_id

			$this->pegawai_id->LinkCustomAttributes = "";
			$this->pegawai_id->HrefValue = "";

			// jabatan_id
			$this->jabatan_id->LinkCustomAttributes = "";
			$this->jabatan_id->HrefValue = "";

			// masakerja
			$this->masakerja->LinkCustomAttributes = "";
			$this->masakerja->HrefValue = "";

			// jumngajar
			$this->jumngajar->LinkCustomAttributes = "";
			$this->jumngajar->HrefValue = "";

			// ijin
			$this->ijin->LinkCustomAttributes = "";
			$this->ijin->HrefValue = "";

			// voucher
			$this->voucher->LinkCustomAttributes = "";
			$this->voucher->HrefValue = "";

			// tunjangan_khusus
			$this->tunjangan_khusus->LinkCustomAttributes = "";
			$this->tunjangan_khusus->HrefValue = "";

			// tunjangan_jabatan
			$this->tunjangan_jabatan->LinkCustomAttributes = "";
			$this->tunjangan_jabatan->HrefValue = "";

			// baku
			$this->baku->LinkCustomAttributes = "";
			$this->baku->HrefValue = "";

			// kehadiran
			$this->kehadiran->LinkCustomAttributes = "";
			$this->kehadiran->HrefValue = "";

			// prestasi
			$this->prestasi->LinkCustomAttributes = "";
			$this->prestasi->HrefValue = "";

			// jumlahgaji
			$this->jumlahgaji->LinkCustomAttributes = "";
			$this->jumlahgaji->HrefValue = "";

			// jumgajitotal
			$this->jumgajitotal->LinkCustomAttributes = "";
			$this->jumgajitotal->HrefValue = "";

			// potongan1
			$this->potongan1->LinkCustomAttributes = "";
			$this->potongan1->HrefValue = "";

			// potongan2
			$this->potongan2->LinkCustomAttributes = "";
			$this->potongan2->HrefValue = "";

			// jumlahterima
			$this->jumlahterima->LinkCustomAttributes = "";
			$this->jumlahterima->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// pegawai_id
			$this->pegawai_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->pegawai_id->CurrentValue));
			if ($curVal != "")
				$this->pegawai_id->ViewValue = $this->pegawai_id->lookupCacheOption($curVal);
			else
				$this->pegawai_id->ViewValue = $this->pegawai_id->Lookup !== NULL && is_array($this->pegawai_id->Lookup->Options) ? $curVal : NULL;
			if ($this->pegawai_id->ViewValue !== NULL) { // Load from cache
				$this->pegawai_id->EditValue = array_values($this->pegawai_id->Lookup->Options);
				if ($this->pegawai_id->ViewValue == "")
					$this->pegawai_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->pegawai_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->pegawai_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->pegawai_id->ViewValue = $this->pegawai_id->displayValue($arwrk);
				} else {
					$this->pegawai_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->pegawai_id->EditValue = $arwrk;
			}

			// jabatan_id
			$this->jabatan_id->EditAttrs["class"] = "form-control";
			$this->jabatan_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->jabatan_id->CurrentValue));
			if ($curVal != "")
				$this->jabatan_id->ViewValue = $this->jabatan_id->lookupCacheOption($curVal);
			else
				$this->jabatan_id->ViewValue = $this->jabatan_id->Lookup !== NULL && is_array($this->jabatan_id->Lookup->Options) ? $curVal : NULL;
			if ($this->jabatan_id->ViewValue !== NULL) { // Load from cache
				$this->jabatan_id->EditValue = array_values($this->jabatan_id->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->jabatan_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->jabatan_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->jabatan_id->EditValue = $arwrk;
			}

			// masakerja
			$this->masakerja->EditAttrs["class"] = "form-control";
			$this->masakerja->EditCustomAttributes = "";
			$this->masakerja->EditValue = HtmlEncode($this->masakerja->CurrentValue);
			$this->masakerja->PlaceHolder = RemoveHtml($this->masakerja->caption());

			// jumngajar
			$this->jumngajar->EditAttrs["class"] = "form-control";
			$this->jumngajar->EditCustomAttributes = "";
			$this->jumngajar->EditValue = HtmlEncode($this->jumngajar->CurrentValue);
			$this->jumngajar->PlaceHolder = RemoveHtml($this->jumngajar->caption());

			// ijin
			$this->ijin->EditAttrs["class"] = "form-control";
			$this->ijin->EditCustomAttributes = "";
			$this->ijin->EditValue = HtmlEncode($this->ijin->CurrentValue);
			$this->ijin->PlaceHolder = RemoveHtml($this->ijin->caption());

			// voucher
			$this->voucher->EditAttrs["class"] = "form-control";
			$this->voucher->EditCustomAttributes = "";
			$this->voucher->EditValue = HtmlEncode($this->voucher->CurrentValue);
			$this->voucher->PlaceHolder = RemoveHtml($this->voucher->caption());

			// tunjangan_khusus
			$this->tunjangan_khusus->EditAttrs["class"] = "form-control";
			$this->tunjangan_khusus->EditCustomAttributes = "";
			$this->tunjangan_khusus->EditValue = HtmlEncode($this->tunjangan_khusus->CurrentValue);
			$this->tunjangan_khusus->PlaceHolder = RemoveHtml($this->tunjangan_khusus->caption());

			// tunjangan_jabatan
			$this->tunjangan_jabatan->EditAttrs["class"] = "form-control";
			$this->tunjangan_jabatan->EditCustomAttributes = "";
			$this->tunjangan_jabatan->EditValue = HtmlEncode($this->tunjangan_jabatan->CurrentValue);
			$this->tunjangan_jabatan->PlaceHolder = RemoveHtml($this->tunjangan_jabatan->caption());

			// baku
			$this->baku->EditAttrs["class"] = "form-control";
			$this->baku->EditCustomAttributes = "";
			$this->baku->EditValue = HtmlEncode($this->baku->CurrentValue);
			$this->baku->PlaceHolder = RemoveHtml($this->baku->caption());

			// kehadiran
			$this->kehadiran->EditAttrs["class"] = "form-control";
			$this->kehadiran->EditCustomAttributes = "";
			$this->kehadiran->EditValue = HtmlEncode($this->kehadiran->CurrentValue);
			$this->kehadiran->PlaceHolder = RemoveHtml($this->kehadiran->caption());

			// prestasi
			$this->prestasi->EditAttrs["class"] = "form-control";
			$this->prestasi->EditCustomAttributes = "";
			$this->prestasi->EditValue = HtmlEncode($this->prestasi->CurrentValue);
			$this->prestasi->PlaceHolder = RemoveHtml($this->prestasi->caption());

			// jumlahgaji
			$this->jumlahgaji->EditAttrs["class"] = "form-control";
			$this->jumlahgaji->EditCustomAttributes = "";
			$this->jumlahgaji->EditValue = HtmlEncode($this->jumlahgaji->CurrentValue);
			$this->jumlahgaji->PlaceHolder = RemoveHtml($this->jumlahgaji->caption());

			// jumgajitotal
			$this->jumgajitotal->EditAttrs["class"] = "form-control";
			$this->jumgajitotal->EditCustomAttributes = "";
			$this->jumgajitotal->EditValue = HtmlEncode($this->jumgajitotal->CurrentValue);
			$this->jumgajitotal->PlaceHolder = RemoveHtml($this->jumgajitotal->caption());

			// potongan1
			$this->potongan1->EditAttrs["class"] = "form-control";
			$this->potongan1->EditCustomAttributes = "";
			$this->potongan1->EditValue = HtmlEncode($this->potongan1->CurrentValue);
			$this->potongan1->PlaceHolder = RemoveHtml($this->potongan1->caption());

			// potongan2
			$this->potongan2->EditAttrs["class"] = "form-control";
			$this->potongan2->EditCustomAttributes = "";
			$this->potongan2->EditValue = HtmlEncode($this->potongan2->CurrentValue);
			$this->potongan2->PlaceHolder = RemoveHtml($this->potongan2->caption());

			// jumlahterima
			$this->jumlahterima->EditAttrs["class"] = "form-control";
			$this->jumlahterima->EditCustomAttributes = "";
			$this->jumlahterima->EditValue = HtmlEncode($this->jumlahterima->CurrentValue);
			$this->jumlahterima->PlaceHolder = RemoveHtml($this->jumlahterima->caption());

			// Edit refer script
			// pegawai_id

			$this->pegawai_id->LinkCustomAttributes = "";
			$this->pegawai_id->HrefValue = "";

			// jabatan_id
			$this->jabatan_id->LinkCustomAttributes = "";
			$this->jabatan_id->HrefValue = "";

			// masakerja
			$this->masakerja->LinkCustomAttributes = "";
			$this->masakerja->HrefValue = "";

			// jumngajar
			$this->jumngajar->LinkCustomAttributes = "";
			$this->jumngajar->HrefValue = "";

			// ijin
			$this->ijin->LinkCustomAttributes = "";
			$this->ijin->HrefValue = "";

			// voucher
			$this->voucher->LinkCustomAttributes = "";
			$this->voucher->HrefValue = "";

			// tunjangan_khusus
			$this->tunjangan_khusus->LinkCustomAttributes = "";
			$this->tunjangan_khusus->HrefValue = "";

			// tunjangan_jabatan
			$this->tunjangan_jabatan->LinkCustomAttributes = "";
			$this->tunjangan_jabatan->HrefValue = "";

			// baku
			$this->baku->LinkCustomAttributes = "";
			$this->baku->HrefValue = "";

			// kehadiran
			$this->kehadiran->LinkCustomAttributes = "";
			$this->kehadiran->HrefValue = "";

			// prestasi
			$this->prestasi->LinkCustomAttributes = "";
			$this->prestasi->HrefValue = "";

			// jumlahgaji
			$this->jumlahgaji->LinkCustomAttributes = "";
			$this->jumlahgaji->HrefValue = "";

			// jumgajitotal
			$this->jumgajitotal->LinkCustomAttributes = "";
			$this->jumgajitotal->HrefValue = "";

			// potongan1
			$this->potongan1->LinkCustomAttributes = "";
			$this->potongan1->HrefValue = "";

			// potongan2
			$this->potongan2->LinkCustomAttributes = "";
			$this->potongan2->HrefValue = "";

			// jumlahterima
			$this->jumlahterima->LinkCustomAttributes = "";
			$this->jumlahterima->HrefValue = "";
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
		if ($this->pegawai_id->Required) {
			if (!$this->pegawai_id->IsDetailKey && $this->pegawai_id->FormValue != NULL && $this->pegawai_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pegawai_id->caption(), $this->pegawai_id->RequiredErrorMessage));
			}
		}
		if ($this->jabatan_id->Required) {
			if (!$this->jabatan_id->IsDetailKey && $this->jabatan_id->FormValue != NULL && $this->jabatan_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jabatan_id->caption(), $this->jabatan_id->RequiredErrorMessage));
			}
		}
		if ($this->masakerja->Required) {
			if (!$this->masakerja->IsDetailKey && $this->masakerja->FormValue != NULL && $this->masakerja->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->masakerja->caption(), $this->masakerja->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->masakerja->FormValue)) {
			AddMessage($FormError, $this->masakerja->errorMessage());
		}
		if ($this->jumngajar->Required) {
			if (!$this->jumngajar->IsDetailKey && $this->jumngajar->FormValue != NULL && $this->jumngajar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jumngajar->caption(), $this->jumngajar->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jumngajar->FormValue)) {
			AddMessage($FormError, $this->jumngajar->errorMessage());
		}
		if ($this->ijin->Required) {
			if (!$this->ijin->IsDetailKey && $this->ijin->FormValue != NULL && $this->ijin->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ijin->caption(), $this->ijin->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ijin->FormValue)) {
			AddMessage($FormError, $this->ijin->errorMessage());
		}
		if ($this->voucher->Required) {
			if (!$this->voucher->IsDetailKey && $this->voucher->FormValue != NULL && $this->voucher->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->voucher->caption(), $this->voucher->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->voucher->FormValue)) {
			AddMessage($FormError, $this->voucher->errorMessage());
		}
		if ($this->tunjangan_khusus->Required) {
			if (!$this->tunjangan_khusus->IsDetailKey && $this->tunjangan_khusus->FormValue != NULL && $this->tunjangan_khusus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tunjangan_khusus->caption(), $this->tunjangan_khusus->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tunjangan_khusus->FormValue)) {
			AddMessage($FormError, $this->tunjangan_khusus->errorMessage());
		}
		if ($this->tunjangan_jabatan->Required) {
			if (!$this->tunjangan_jabatan->IsDetailKey && $this->tunjangan_jabatan->FormValue != NULL && $this->tunjangan_jabatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tunjangan_jabatan->caption(), $this->tunjangan_jabatan->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tunjangan_jabatan->FormValue)) {
			AddMessage($FormError, $this->tunjangan_jabatan->errorMessage());
		}
		if ($this->baku->Required) {
			if (!$this->baku->IsDetailKey && $this->baku->FormValue != NULL && $this->baku->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->baku->caption(), $this->baku->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->baku->FormValue)) {
			AddMessage($FormError, $this->baku->errorMessage());
		}
		if ($this->kehadiran->Required) {
			if (!$this->kehadiran->IsDetailKey && $this->kehadiran->FormValue != NULL && $this->kehadiran->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->kehadiran->caption(), $this->kehadiran->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->kehadiran->FormValue)) {
			AddMessage($FormError, $this->kehadiran->errorMessage());
		}
		if ($this->prestasi->Required) {
			if (!$this->prestasi->IsDetailKey && $this->prestasi->FormValue != NULL && $this->prestasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->prestasi->caption(), $this->prestasi->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->prestasi->FormValue)) {
			AddMessage($FormError, $this->prestasi->errorMessage());
		}
		if ($this->jumlahgaji->Required) {
			if (!$this->jumlahgaji->IsDetailKey && $this->jumlahgaji->FormValue != NULL && $this->jumlahgaji->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jumlahgaji->caption(), $this->jumlahgaji->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jumlahgaji->FormValue)) {
			AddMessage($FormError, $this->jumlahgaji->errorMessage());
		}
		if ($this->jumgajitotal->Required) {
			if (!$this->jumgajitotal->IsDetailKey && $this->jumgajitotal->FormValue != NULL && $this->jumgajitotal->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jumgajitotal->caption(), $this->jumgajitotal->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jumgajitotal->FormValue)) {
			AddMessage($FormError, $this->jumgajitotal->errorMessage());
		}
		if ($this->potongan1->Required) {
			if (!$this->potongan1->IsDetailKey && $this->potongan1->FormValue != NULL && $this->potongan1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->potongan1->caption(), $this->potongan1->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->potongan1->FormValue)) {
			AddMessage($FormError, $this->potongan1->errorMessage());
		}
		if ($this->potongan2->Required) {
			if (!$this->potongan2->IsDetailKey && $this->potongan2->FormValue != NULL && $this->potongan2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->potongan2->caption(), $this->potongan2->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->potongan2->FormValue)) {
			AddMessage($FormError, $this->potongan2->errorMessage());
		}
		if ($this->jumlahterima->Required) {
			if (!$this->jumlahterima->IsDetailKey && $this->jumlahterima->FormValue != NULL && $this->jumlahterima->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jumlahterima->caption(), $this->jumlahterima->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jumlahterima->FormValue)) {
			AddMessage($FormError, $this->jumlahterima->errorMessage());
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

			// pegawai_id
			$this->pegawai_id->setDbValueDef($rsnew, $this->pegawai_id->CurrentValue, NULL, $this->pegawai_id->ReadOnly);

			// jabatan_id
			$this->jabatan_id->setDbValueDef($rsnew, $this->jabatan_id->CurrentValue, NULL, $this->jabatan_id->ReadOnly);

			// masakerja
			$this->masakerja->setDbValueDef($rsnew, $this->masakerja->CurrentValue, NULL, $this->masakerja->ReadOnly);

			// jumngajar
			$this->jumngajar->setDbValueDef($rsnew, $this->jumngajar->CurrentValue, NULL, $this->jumngajar->ReadOnly);

			// ijin
			$this->ijin->setDbValueDef($rsnew, $this->ijin->CurrentValue, NULL, $this->ijin->ReadOnly);

			// voucher
			$this->voucher->setDbValueDef($rsnew, $this->voucher->CurrentValue, NULL, $this->voucher->ReadOnly);

			// tunjangan_khusus
			$this->tunjangan_khusus->setDbValueDef($rsnew, $this->tunjangan_khusus->CurrentValue, NULL, $this->tunjangan_khusus->ReadOnly);

			// tunjangan_jabatan
			$this->tunjangan_jabatan->setDbValueDef($rsnew, $this->tunjangan_jabatan->CurrentValue, NULL, $this->tunjangan_jabatan->ReadOnly);

			// baku
			$this->baku->setDbValueDef($rsnew, $this->baku->CurrentValue, NULL, $this->baku->ReadOnly);

			// kehadiran
			$this->kehadiran->setDbValueDef($rsnew, $this->kehadiran->CurrentValue, NULL, $this->kehadiran->ReadOnly);

			// prestasi
			$this->prestasi->setDbValueDef($rsnew, $this->prestasi->CurrentValue, NULL, $this->prestasi->ReadOnly);

			// jumlahgaji
			$this->jumlahgaji->setDbValueDef($rsnew, $this->jumlahgaji->CurrentValue, NULL, $this->jumlahgaji->ReadOnly);

			// jumgajitotal
			$this->jumgajitotal->setDbValueDef($rsnew, $this->jumgajitotal->CurrentValue, NULL, $this->jumgajitotal->ReadOnly);

			// potongan1
			$this->potongan1->setDbValueDef($rsnew, $this->potongan1->CurrentValue, NULL, $this->potongan1->ReadOnly);

			// potongan2
			$this->potongan2->setDbValueDef($rsnew, $this->potongan2->CurrentValue, NULL, $this->potongan2->ReadOnly);

			// jumlahterima
			$this->jumlahterima->setDbValueDef($rsnew, $this->jumlahterima->CurrentValue, NULL, $this->jumlahterima->ReadOnly);

			// Check referential integrity for master table 'gajitk'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_gajitk();
			$keyValue = isset($rsnew['pid']) ? $rsnew['pid'] : $rsold['pid'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["gajitk"]))
					$GLOBALS["gajitk"] = new gajitk();
				$rsmaster = $GLOBALS["gajitk"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "gajitk", $Language->phrase("RelatedRecordRequired"));
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
			if ($this->getCurrentMasterTable() == "gajitk") {
				$this->pid->CurrentValue = $this->pid->getSessionValue();
			}

		// Check referential integrity for master table 'gajitk_detil'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_gajitk();
		if ($this->pid->getSessionValue() != "") {
			$masterFilter = str_replace("@id@", AdjustSql($this->pid->getSessionValue(), "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["gajitk"]))
				$GLOBALS["gajitk"] = new gajitk();
			$rsmaster = $GLOBALS["gajitk"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "gajitk", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// pegawai_id
		$this->pegawai_id->setDbValueDef($rsnew, $this->pegawai_id->CurrentValue, NULL, FALSE);

		// jabatan_id
		$this->jabatan_id->setDbValueDef($rsnew, $this->jabatan_id->CurrentValue, NULL, FALSE);

		// masakerja
		$this->masakerja->setDbValueDef($rsnew, $this->masakerja->CurrentValue, NULL, FALSE);

		// jumngajar
		$this->jumngajar->setDbValueDef($rsnew, $this->jumngajar->CurrentValue, NULL, FALSE);

		// ijin
		$this->ijin->setDbValueDef($rsnew, $this->ijin->CurrentValue, NULL, FALSE);

		// voucher
		$this->voucher->setDbValueDef($rsnew, $this->voucher->CurrentValue, NULL, FALSE);

		// tunjangan_khusus
		$this->tunjangan_khusus->setDbValueDef($rsnew, $this->tunjangan_khusus->CurrentValue, NULL, FALSE);

		// tunjangan_jabatan
		$this->tunjangan_jabatan->setDbValueDef($rsnew, $this->tunjangan_jabatan->CurrentValue, NULL, FALSE);

		// baku
		$this->baku->setDbValueDef($rsnew, $this->baku->CurrentValue, NULL, FALSE);

		// kehadiran
		$this->kehadiran->setDbValueDef($rsnew, $this->kehadiran->CurrentValue, NULL, FALSE);

		// prestasi
		$this->prestasi->setDbValueDef($rsnew, $this->prestasi->CurrentValue, NULL, FALSE);

		// jumlahgaji
		$this->jumlahgaji->setDbValueDef($rsnew, $this->jumlahgaji->CurrentValue, NULL, FALSE);

		// jumgajitotal
		$this->jumgajitotal->setDbValueDef($rsnew, $this->jumgajitotal->CurrentValue, NULL, FALSE);

		// potongan1
		$this->potongan1->setDbValueDef($rsnew, $this->potongan1->CurrentValue, NULL, FALSE);

		// potongan2
		$this->potongan2->setDbValueDef($rsnew, $this->potongan2->CurrentValue, NULL, FALSE);

		// jumlahterima
		$this->jumlahterima->setDbValueDef($rsnew, $this->jumlahterima->CurrentValue, NULL, FALSE);

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
		if ($masterTblVar == "gajitk") {
			$this->pid->Visible = FALSE;
			if ($GLOBALS["gajitk"]->EventCancelled)
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
				case "x_pegawai_id":
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
						case "x_pegawai_id":
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