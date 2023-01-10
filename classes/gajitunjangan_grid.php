<?php
namespace PHPMaker2020\sigap;

/**
 * Page class
 */
class gajitunjangan_grid extends gajitunjangan
{

	// Page ID
	public $PageID = "grid";

	// Project ID
	public $ProjectID = "{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}";

	// Table name
	public $TableName = 'gajitunjangan';

	// Page object name
	public $PageObjName = "gajitunjangan_grid";

	// Grid form hidden field names
	public $FormName = "fgajitunjangangrid";
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

		// Table object (gajitunjangan)
		if (!isset($GLOBALS["gajitunjangan"]) || get_class($GLOBALS["gajitunjangan"]) == PROJECT_NAMESPACE . "gajitunjangan") {
			$GLOBALS["gajitunjangan"] = &$this;

			// $GLOBALS["MasterTable"] = &$GLOBALS["Table"];
			// if (!isset($GLOBALS["Table"]))
			// 	$GLOBALS["Table"] = &$GLOBALS["gajitunjangan"];

		}
		$this->AddUrl = "gajitunjanganadd.php";

		// Table object (pegawai)
		if (!isset($GLOBALS['pegawai']))
			$GLOBALS['pegawai'] = new pegawai();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'grid');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'gajitunjangan');

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
		global $gajitunjangan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($gajitunjangan);
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
		$this->pidjabatan->setVisibility();
		$this->value_kehadiran->setVisibility();
		$this->gapok->setVisibility();
		$this->tunjangan_jabatan->setVisibility();
		$this->reward->setVisibility();
		$this->lembur->setVisibility();
		$this->piket->setVisibility();
		$this->inval->setVisibility();
		$this->jam_lebih->setVisibility();
		$this->tunjangan_khusus->setVisibility();
		$this->ekstrakuri->setVisibility();
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
		$this->setupLookupOptions($this->pidjabatan);

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
		if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "jabatan") {
			global $jabatan;
			$rsmaster = $jabatan->loadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
				$this->terminate("jabatanlist.php"); // Return to master page
			} else {
				$jabatan->loadListRowValues($rsmaster);
				$jabatan->RowType = ROWTYPE_MASTER; // Master row
				$jabatan->renderListRow();
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
		if ($CurrentForm->hasValue("x_pidjabatan") && $CurrentForm->hasValue("o_pidjabatan") && $this->pidjabatan->CurrentValue != $this->pidjabatan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_value_kehadiran") && $CurrentForm->hasValue("o_value_kehadiran") && $this->value_kehadiran->CurrentValue != $this->value_kehadiran->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_gapok") && $CurrentForm->hasValue("o_gapok") && $this->gapok->CurrentValue != $this->gapok->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tunjangan_jabatan") && $CurrentForm->hasValue("o_tunjangan_jabatan") && $this->tunjangan_jabatan->CurrentValue != $this->tunjangan_jabatan->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_reward") && $CurrentForm->hasValue("o_reward") && $this->reward->CurrentValue != $this->reward->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_lembur") && $CurrentForm->hasValue("o_lembur") && $this->lembur->CurrentValue != $this->lembur->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_piket") && $CurrentForm->hasValue("o_piket") && $this->piket->CurrentValue != $this->piket->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_inval") && $CurrentForm->hasValue("o_inval") && $this->inval->CurrentValue != $this->inval->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_jam_lebih") && $CurrentForm->hasValue("o_jam_lebih") && $this->jam_lebih->CurrentValue != $this->jam_lebih->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_tunjangan_khusus") && $CurrentForm->hasValue("o_tunjangan_khusus") && $this->tunjangan_khusus->CurrentValue != $this->tunjangan_khusus->OldValue)
			return FALSE;
		if ($CurrentForm->hasValue("x_ekstrakuri") && $CurrentForm->hasValue("o_ekstrakuri") && $this->ekstrakuri->CurrentValue != $this->ekstrakuri->OldValue)
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
				$this->pidjabatan->setSessionValue("");
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
		$this->pidjabatan->CurrentValue = NULL;
		$this->pidjabatan->OldValue = $this->pidjabatan->CurrentValue;
		$this->value_kehadiran->CurrentValue = NULL;
		$this->value_kehadiran->OldValue = $this->value_kehadiran->CurrentValue;
		$this->gapok->CurrentValue = NULL;
		$this->gapok->OldValue = $this->gapok->CurrentValue;
		$this->tunjangan_jabatan->CurrentValue = NULL;
		$this->tunjangan_jabatan->OldValue = $this->tunjangan_jabatan->CurrentValue;
		$this->reward->CurrentValue = NULL;
		$this->reward->OldValue = $this->reward->CurrentValue;
		$this->lembur->CurrentValue = NULL;
		$this->lembur->OldValue = $this->lembur->CurrentValue;
		$this->piket->CurrentValue = NULL;
		$this->piket->OldValue = $this->piket->CurrentValue;
		$this->inval->CurrentValue = NULL;
		$this->inval->OldValue = $this->inval->CurrentValue;
		$this->jam_lebih->CurrentValue = NULL;
		$this->jam_lebih->OldValue = $this->jam_lebih->CurrentValue;
		$this->tunjangan_khusus->CurrentValue = NULL;
		$this->tunjangan_khusus->OldValue = $this->tunjangan_khusus->CurrentValue;
		$this->ekstrakuri->CurrentValue = NULL;
		$this->ekstrakuri->OldValue = $this->ekstrakuri->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$CurrentForm->FormName = $this->FormName;

		// Check field name 'pidjabatan' first before field var 'x_pidjabatan'
		$val = $CurrentForm->hasValue("pidjabatan") ? $CurrentForm->getValue("pidjabatan") : $CurrentForm->getValue("x_pidjabatan");
		if (!$this->pidjabatan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pidjabatan->Visible = FALSE; // Disable update for API request
			else
				$this->pidjabatan->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_pidjabatan"))
			$this->pidjabatan->setOldValue($CurrentForm->getValue("o_pidjabatan"));

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

		// Check field name 'reward' first before field var 'x_reward'
		$val = $CurrentForm->hasValue("reward") ? $CurrentForm->getValue("reward") : $CurrentForm->getValue("x_reward");
		if (!$this->reward->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->reward->Visible = FALSE; // Disable update for API request
			else
				$this->reward->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_reward"))
			$this->reward->setOldValue($CurrentForm->getValue("o_reward"));

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

		// Check field name 'piket' first before field var 'x_piket'
		$val = $CurrentForm->hasValue("piket") ? $CurrentForm->getValue("piket") : $CurrentForm->getValue("x_piket");
		if (!$this->piket->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->piket->Visible = FALSE; // Disable update for API request
			else
				$this->piket->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_piket"))
			$this->piket->setOldValue($CurrentForm->getValue("o_piket"));

		// Check field name 'inval' first before field var 'x_inval'
		$val = $CurrentForm->hasValue("inval") ? $CurrentForm->getValue("inval") : $CurrentForm->getValue("x_inval");
		if (!$this->inval->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->inval->Visible = FALSE; // Disable update for API request
			else
				$this->inval->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_inval"))
			$this->inval->setOldValue($CurrentForm->getValue("o_inval"));

		// Check field name 'jam_lebih' first before field var 'x_jam_lebih'
		$val = $CurrentForm->hasValue("jam_lebih") ? $CurrentForm->getValue("jam_lebih") : $CurrentForm->getValue("x_jam_lebih");
		if (!$this->jam_lebih->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jam_lebih->Visible = FALSE; // Disable update for API request
			else
				$this->jam_lebih->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_jam_lebih"))
			$this->jam_lebih->setOldValue($CurrentForm->getValue("o_jam_lebih"));

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

		// Check field name 'ekstrakuri' first before field var 'x_ekstrakuri'
		$val = $CurrentForm->hasValue("ekstrakuri") ? $CurrentForm->getValue("ekstrakuri") : $CurrentForm->getValue("x_ekstrakuri");
		if (!$this->ekstrakuri->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ekstrakuri->Visible = FALSE; // Disable update for API request
			else
				$this->ekstrakuri->setFormValue($val);
		}
		if ($CurrentForm->hasValue("o_ekstrakuri"))
			$this->ekstrakuri->setOldValue($CurrentForm->getValue("o_ekstrakuri"));

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
		$this->pidjabatan->CurrentValue = $this->pidjabatan->FormValue;
		$this->value_kehadiran->CurrentValue = $this->value_kehadiran->FormValue;
		$this->gapok->CurrentValue = $this->gapok->FormValue;
		$this->tunjangan_jabatan->CurrentValue = $this->tunjangan_jabatan->FormValue;
		$this->reward->CurrentValue = $this->reward->FormValue;
		$this->lembur->CurrentValue = $this->lembur->FormValue;
		$this->piket->CurrentValue = $this->piket->FormValue;
		$this->inval->CurrentValue = $this->inval->FormValue;
		$this->jam_lebih->CurrentValue = $this->jam_lebih->FormValue;
		$this->tunjangan_khusus->CurrentValue = $this->tunjangan_khusus->FormValue;
		$this->ekstrakuri->CurrentValue = $this->ekstrakuri->FormValue;
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
		$this->pidjabatan->setDbValue($row['pidjabatan']);
		$this->value_kehadiran->setDbValue($row['value_kehadiran']);
		$this->gapok->setDbValue($row['gapok']);
		$this->tunjangan_jabatan->setDbValue($row['tunjangan_jabatan']);
		$this->reward->setDbValue($row['reward']);
		$this->lembur->setDbValue($row['lembur']);
		$this->piket->setDbValue($row['piket']);
		$this->inval->setDbValue($row['inval']);
		$this->jam_lebih->setDbValue($row['jam_lebih']);
		$this->tunjangan_khusus->setDbValue($row['tunjangan_khusus']);
		$this->ekstrakuri->setDbValue($row['ekstrakuri']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['pidjabatan'] = $this->pidjabatan->CurrentValue;
		$row['value_kehadiran'] = $this->value_kehadiran->CurrentValue;
		$row['gapok'] = $this->gapok->CurrentValue;
		$row['tunjangan_jabatan'] = $this->tunjangan_jabatan->CurrentValue;
		$row['reward'] = $this->reward->CurrentValue;
		$row['lembur'] = $this->lembur->CurrentValue;
		$row['piket'] = $this->piket->CurrentValue;
		$row['inval'] = $this->inval->CurrentValue;
		$row['jam_lebih'] = $this->jam_lebih->CurrentValue;
		$row['tunjangan_khusus'] = $this->tunjangan_khusus->CurrentValue;
		$row['ekstrakuri'] = $this->ekstrakuri->CurrentValue;
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// pidjabatan
			$this->pidjabatan->EditAttrs["class"] = "form-control";
			$this->pidjabatan->EditCustomAttributes = "";
			if ($this->pidjabatan->getSessionValue() != "") {
				$this->pidjabatan->CurrentValue = $this->pidjabatan->getSessionValue();
				$this->pidjabatan->OldValue = $this->pidjabatan->CurrentValue;
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
			} else {
				$this->pidjabatan->EditValue = HtmlEncode($this->pidjabatan->CurrentValue);
				$curVal = strval($this->pidjabatan->CurrentValue);
				if ($curVal != "") {
					$this->pidjabatan->EditValue = $this->pidjabatan->lookupCacheOption($curVal);
					if ($this->pidjabatan->EditValue === NULL) { // Lookup from database
						$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->pidjabatan->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = HtmlEncode($rswrk->fields('df'));
							$this->pidjabatan->EditValue = $this->pidjabatan->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->pidjabatan->EditValue = HtmlEncode($this->pidjabatan->CurrentValue);
						}
					}
				} else {
					$this->pidjabatan->EditValue = NULL;
				}
				$this->pidjabatan->PlaceHolder = RemoveHtml($this->pidjabatan->caption());
			}

			// value_kehadiran
			$this->value_kehadiran->EditAttrs["class"] = "form-control";
			$this->value_kehadiran->EditCustomAttributes = "";
			$this->value_kehadiran->EditValue = HtmlEncode($this->value_kehadiran->CurrentValue);
			$this->value_kehadiran->PlaceHolder = RemoveHtml($this->value_kehadiran->caption());

			// gapok
			$this->gapok->EditAttrs["class"] = "form-control";
			$this->gapok->EditCustomAttributes = "";
			$this->gapok->EditValue = HtmlEncode($this->gapok->CurrentValue);
			$this->gapok->PlaceHolder = RemoveHtml($this->gapok->caption());

			// tunjangan_jabatan
			$this->tunjangan_jabatan->EditAttrs["class"] = "form-control";
			$this->tunjangan_jabatan->EditCustomAttributes = "";
			$this->tunjangan_jabatan->EditValue = HtmlEncode($this->tunjangan_jabatan->CurrentValue);
			$this->tunjangan_jabatan->PlaceHolder = RemoveHtml($this->tunjangan_jabatan->caption());

			// reward
			$this->reward->EditAttrs["class"] = "form-control";
			$this->reward->EditCustomAttributes = "";
			$this->reward->EditValue = HtmlEncode($this->reward->CurrentValue);
			$this->reward->PlaceHolder = RemoveHtml($this->reward->caption());

			// lembur
			$this->lembur->EditAttrs["class"] = "form-control";
			$this->lembur->EditCustomAttributes = "";
			$this->lembur->EditValue = HtmlEncode($this->lembur->CurrentValue);
			$this->lembur->PlaceHolder = RemoveHtml($this->lembur->caption());

			// piket
			$this->piket->EditAttrs["class"] = "form-control";
			$this->piket->EditCustomAttributes = "";
			$this->piket->EditValue = HtmlEncode($this->piket->CurrentValue);
			$this->piket->PlaceHolder = RemoveHtml($this->piket->caption());

			// inval
			$this->inval->EditAttrs["class"] = "form-control";
			$this->inval->EditCustomAttributes = "";
			$this->inval->EditValue = HtmlEncode($this->inval->CurrentValue);
			$this->inval->PlaceHolder = RemoveHtml($this->inval->caption());

			// jam_lebih
			$this->jam_lebih->EditAttrs["class"] = "form-control";
			$this->jam_lebih->EditCustomAttributes = "";
			$this->jam_lebih->EditValue = HtmlEncode($this->jam_lebih->CurrentValue);
			$this->jam_lebih->PlaceHolder = RemoveHtml($this->jam_lebih->caption());

			// tunjangan_khusus
			$this->tunjangan_khusus->EditAttrs["class"] = "form-control";
			$this->tunjangan_khusus->EditCustomAttributes = "";
			$this->tunjangan_khusus->EditValue = HtmlEncode($this->tunjangan_khusus->CurrentValue);
			$this->tunjangan_khusus->PlaceHolder = RemoveHtml($this->tunjangan_khusus->caption());

			// ekstrakuri
			$this->ekstrakuri->EditAttrs["class"] = "form-control";
			$this->ekstrakuri->EditCustomAttributes = "";
			$this->ekstrakuri->EditValue = HtmlEncode($this->ekstrakuri->CurrentValue);
			$this->ekstrakuri->PlaceHolder = RemoveHtml($this->ekstrakuri->caption());

			// Add refer script
			// pidjabatan

			$this->pidjabatan->LinkCustomAttributes = "";
			$this->pidjabatan->HrefValue = "";

			// value_kehadiran
			$this->value_kehadiran->LinkCustomAttributes = "";
			$this->value_kehadiran->HrefValue = "";

			// gapok
			$this->gapok->LinkCustomAttributes = "";
			$this->gapok->HrefValue = "";

			// tunjangan_jabatan
			$this->tunjangan_jabatan->LinkCustomAttributes = "";
			$this->tunjangan_jabatan->HrefValue = "";

			// reward
			$this->reward->LinkCustomAttributes = "";
			$this->reward->HrefValue = "";

			// lembur
			$this->lembur->LinkCustomAttributes = "";
			$this->lembur->HrefValue = "";

			// piket
			$this->piket->LinkCustomAttributes = "";
			$this->piket->HrefValue = "";

			// inval
			$this->inval->LinkCustomAttributes = "";
			$this->inval->HrefValue = "";

			// jam_lebih
			$this->jam_lebih->LinkCustomAttributes = "";
			$this->jam_lebih->HrefValue = "";

			// tunjangan_khusus
			$this->tunjangan_khusus->LinkCustomAttributes = "";
			$this->tunjangan_khusus->HrefValue = "";

			// ekstrakuri
			$this->ekstrakuri->LinkCustomAttributes = "";
			$this->ekstrakuri->HrefValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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
			$this->value_kehadiran->EditValue = HtmlEncode($this->value_kehadiran->CurrentValue);
			$this->value_kehadiran->PlaceHolder = RemoveHtml($this->value_kehadiran->caption());

			// gapok
			$this->gapok->EditAttrs["class"] = "form-control";
			$this->gapok->EditCustomAttributes = "";
			$this->gapok->EditValue = HtmlEncode($this->gapok->CurrentValue);
			$this->gapok->PlaceHolder = RemoveHtml($this->gapok->caption());

			// tunjangan_jabatan
			$this->tunjangan_jabatan->EditAttrs["class"] = "form-control";
			$this->tunjangan_jabatan->EditCustomAttributes = "";
			$this->tunjangan_jabatan->EditValue = HtmlEncode($this->tunjangan_jabatan->CurrentValue);
			$this->tunjangan_jabatan->PlaceHolder = RemoveHtml($this->tunjangan_jabatan->caption());

			// reward
			$this->reward->EditAttrs["class"] = "form-control";
			$this->reward->EditCustomAttributes = "";
			$this->reward->EditValue = HtmlEncode($this->reward->CurrentValue);
			$this->reward->PlaceHolder = RemoveHtml($this->reward->caption());

			// lembur
			$this->lembur->EditAttrs["class"] = "form-control";
			$this->lembur->EditCustomAttributes = "";
			$this->lembur->EditValue = HtmlEncode($this->lembur->CurrentValue);
			$this->lembur->PlaceHolder = RemoveHtml($this->lembur->caption());

			// piket
			$this->piket->EditAttrs["class"] = "form-control";
			$this->piket->EditCustomAttributes = "";
			$this->piket->EditValue = HtmlEncode($this->piket->CurrentValue);
			$this->piket->PlaceHolder = RemoveHtml($this->piket->caption());

			// inval
			$this->inval->EditAttrs["class"] = "form-control";
			$this->inval->EditCustomAttributes = "";
			$this->inval->EditValue = HtmlEncode($this->inval->CurrentValue);
			$this->inval->PlaceHolder = RemoveHtml($this->inval->caption());

			// jam_lebih
			$this->jam_lebih->EditAttrs["class"] = "form-control";
			$this->jam_lebih->EditCustomAttributes = "";
			$this->jam_lebih->EditValue = HtmlEncode($this->jam_lebih->CurrentValue);
			$this->jam_lebih->PlaceHolder = RemoveHtml($this->jam_lebih->caption());

			// tunjangan_khusus
			$this->tunjangan_khusus->EditAttrs["class"] = "form-control";
			$this->tunjangan_khusus->EditCustomAttributes = "";
			$this->tunjangan_khusus->EditValue = HtmlEncode($this->tunjangan_khusus->CurrentValue);
			$this->tunjangan_khusus->PlaceHolder = RemoveHtml($this->tunjangan_khusus->caption());

			// ekstrakuri
			$this->ekstrakuri->EditAttrs["class"] = "form-control";
			$this->ekstrakuri->EditCustomAttributes = "";
			$this->ekstrakuri->EditValue = HtmlEncode($this->ekstrakuri->CurrentValue);
			$this->ekstrakuri->PlaceHolder = RemoveHtml($this->ekstrakuri->caption());

			// Edit refer script
			// pidjabatan

			$this->pidjabatan->LinkCustomAttributes = "";
			$this->pidjabatan->HrefValue = "";
			$this->pidjabatan->TooltipValue = "";

			// value_kehadiran
			$this->value_kehadiran->LinkCustomAttributes = "";
			$this->value_kehadiran->HrefValue = "";

			// gapok
			$this->gapok->LinkCustomAttributes = "";
			$this->gapok->HrefValue = "";

			// tunjangan_jabatan
			$this->tunjangan_jabatan->LinkCustomAttributes = "";
			$this->tunjangan_jabatan->HrefValue = "";

			// reward
			$this->reward->LinkCustomAttributes = "";
			$this->reward->HrefValue = "";

			// lembur
			$this->lembur->LinkCustomAttributes = "";
			$this->lembur->HrefValue = "";

			// piket
			$this->piket->LinkCustomAttributes = "";
			$this->piket->HrefValue = "";

			// inval
			$this->inval->LinkCustomAttributes = "";
			$this->inval->HrefValue = "";

			// jam_lebih
			$this->jam_lebih->LinkCustomAttributes = "";
			$this->jam_lebih->HrefValue = "";

			// tunjangan_khusus
			$this->tunjangan_khusus->LinkCustomAttributes = "";
			$this->tunjangan_khusus->HrefValue = "";

			// ekstrakuri
			$this->ekstrakuri->LinkCustomAttributes = "";
			$this->ekstrakuri->HrefValue = "";
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
		if ($this->pidjabatan->Required) {
			if (!$this->pidjabatan->IsDetailKey && $this->pidjabatan->FormValue != NULL && $this->pidjabatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pidjabatan->caption(), $this->pidjabatan->RequiredErrorMessage));
			}
		}
		if ($this->value_kehadiran->Required) {
			if (!$this->value_kehadiran->IsDetailKey && $this->value_kehadiran->FormValue != NULL && $this->value_kehadiran->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->value_kehadiran->caption(), $this->value_kehadiran->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->value_kehadiran->FormValue)) {
			AddMessage($FormError, $this->value_kehadiran->errorMessage());
		}
		if ($this->gapok->Required) {
			if (!$this->gapok->IsDetailKey && $this->gapok->FormValue != NULL && $this->gapok->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->gapok->caption(), $this->gapok->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->gapok->FormValue)) {
			AddMessage($FormError, $this->gapok->errorMessage());
		}
		if ($this->tunjangan_jabatan->Required) {
			if (!$this->tunjangan_jabatan->IsDetailKey && $this->tunjangan_jabatan->FormValue != NULL && $this->tunjangan_jabatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tunjangan_jabatan->caption(), $this->tunjangan_jabatan->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tunjangan_jabatan->FormValue)) {
			AddMessage($FormError, $this->tunjangan_jabatan->errorMessage());
		}
		if ($this->reward->Required) {
			if (!$this->reward->IsDetailKey && $this->reward->FormValue != NULL && $this->reward->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->reward->caption(), $this->reward->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->reward->FormValue)) {
			AddMessage($FormError, $this->reward->errorMessage());
		}
		if ($this->lembur->Required) {
			if (!$this->lembur->IsDetailKey && $this->lembur->FormValue != NULL && $this->lembur->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->lembur->caption(), $this->lembur->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->lembur->FormValue)) {
			AddMessage($FormError, $this->lembur->errorMessage());
		}
		if ($this->piket->Required) {
			if (!$this->piket->IsDetailKey && $this->piket->FormValue != NULL && $this->piket->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->piket->caption(), $this->piket->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->piket->FormValue)) {
			AddMessage($FormError, $this->piket->errorMessage());
		}
		if ($this->inval->Required) {
			if (!$this->inval->IsDetailKey && $this->inval->FormValue != NULL && $this->inval->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->inval->caption(), $this->inval->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->inval->FormValue)) {
			AddMessage($FormError, $this->inval->errorMessage());
		}
		if ($this->jam_lebih->Required) {
			if (!$this->jam_lebih->IsDetailKey && $this->jam_lebih->FormValue != NULL && $this->jam_lebih->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jam_lebih->caption(), $this->jam_lebih->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jam_lebih->FormValue)) {
			AddMessage($FormError, $this->jam_lebih->errorMessage());
		}
		if ($this->tunjangan_khusus->Required) {
			if (!$this->tunjangan_khusus->IsDetailKey && $this->tunjangan_khusus->FormValue != NULL && $this->tunjangan_khusus->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tunjangan_khusus->caption(), $this->tunjangan_khusus->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tunjangan_khusus->FormValue)) {
			AddMessage($FormError, $this->tunjangan_khusus->errorMessage());
		}
		if ($this->ekstrakuri->Required) {
			if (!$this->ekstrakuri->IsDetailKey && $this->ekstrakuri->FormValue != NULL && $this->ekstrakuri->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->ekstrakuri->caption(), $this->ekstrakuri->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->ekstrakuri->FormValue)) {
			AddMessage($FormError, $this->ekstrakuri->errorMessage());
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

			// value_kehadiran
			$this->value_kehadiran->setDbValueDef($rsnew, $this->value_kehadiran->CurrentValue, NULL, $this->value_kehadiran->ReadOnly);

			// gapok
			$this->gapok->setDbValueDef($rsnew, $this->gapok->CurrentValue, NULL, $this->gapok->ReadOnly);

			// tunjangan_jabatan
			$this->tunjangan_jabatan->setDbValueDef($rsnew, $this->tunjangan_jabatan->CurrentValue, NULL, $this->tunjangan_jabatan->ReadOnly);

			// reward
			$this->reward->setDbValueDef($rsnew, $this->reward->CurrentValue, NULL, $this->reward->ReadOnly);

			// lembur
			$this->lembur->setDbValueDef($rsnew, $this->lembur->CurrentValue, NULL, $this->lembur->ReadOnly);

			// piket
			$this->piket->setDbValueDef($rsnew, $this->piket->CurrentValue, NULL, $this->piket->ReadOnly);

			// inval
			$this->inval->setDbValueDef($rsnew, $this->inval->CurrentValue, NULL, $this->inval->ReadOnly);

			// jam_lebih
			$this->jam_lebih->setDbValueDef($rsnew, $this->jam_lebih->CurrentValue, NULL, $this->jam_lebih->ReadOnly);

			// tunjangan_khusus
			$this->tunjangan_khusus->setDbValueDef($rsnew, $this->tunjangan_khusus->CurrentValue, NULL, $this->tunjangan_khusus->ReadOnly);

			// ekstrakuri
			$this->ekstrakuri->setDbValueDef($rsnew, $this->ekstrakuri->CurrentValue, NULL, $this->ekstrakuri->ReadOnly);

			// Check referential integrity for master table 'jabatan'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_jabatan();
			$keyValue = isset($rsnew['pidjabatan']) ? $rsnew['pidjabatan'] : $rsold['pidjabatan'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["jabatan"]))
					$GLOBALS["jabatan"] = new jabatan();
				$rsmaster = $GLOBALS["jabatan"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "jabatan", $Language->phrase("RelatedRecordRequired"));
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
			if ($this->getCurrentMasterTable() == "jabatan") {
				$this->pidjabatan->CurrentValue = $this->pidjabatan->getSessionValue();
			}

		// Check referential integrity for master table 'gajitunjangan'
		$validMasterRecord = TRUE;
		$masterFilter = $this->sqlMasterFilter_jabatan();
		if (strval($this->pidjabatan->CurrentValue) != "") {
			$masterFilter = str_replace("@id@", AdjustSql($this->pidjabatan->CurrentValue, "DB"), $masterFilter);
		} else {
			$validMasterRecord = FALSE;
		}
		if ($validMasterRecord) {
			if (!isset($GLOBALS["jabatan"]))
				$GLOBALS["jabatan"] = new jabatan();
			$rsmaster = $GLOBALS["jabatan"]->loadRs($masterFilter);
			$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->close();
		}
		if (!$validMasterRecord) {
			$relatedRecordMsg = str_replace("%t", "jabatan", $Language->phrase("RelatedRecordRequired"));
			$this->setFailureMessage($relatedRecordMsg);
			return FALSE;
		}
		$conn = $this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// pidjabatan
		$this->pidjabatan->setDbValueDef($rsnew, $this->pidjabatan->CurrentValue, NULL, FALSE);

		// value_kehadiran
		$this->value_kehadiran->setDbValueDef($rsnew, $this->value_kehadiran->CurrentValue, NULL, FALSE);

		// gapok
		$this->gapok->setDbValueDef($rsnew, $this->gapok->CurrentValue, NULL, FALSE);

		// tunjangan_jabatan
		$this->tunjangan_jabatan->setDbValueDef($rsnew, $this->tunjangan_jabatan->CurrentValue, NULL, FALSE);

		// reward
		$this->reward->setDbValueDef($rsnew, $this->reward->CurrentValue, NULL, FALSE);

		// lembur
		$this->lembur->setDbValueDef($rsnew, $this->lembur->CurrentValue, NULL, FALSE);

		// piket
		$this->piket->setDbValueDef($rsnew, $this->piket->CurrentValue, NULL, FALSE);

		// inval
		$this->inval->setDbValueDef($rsnew, $this->inval->CurrentValue, NULL, FALSE);

		// jam_lebih
		$this->jam_lebih->setDbValueDef($rsnew, $this->jam_lebih->CurrentValue, NULL, FALSE);

		// tunjangan_khusus
		$this->tunjangan_khusus->setDbValueDef($rsnew, $this->tunjangan_khusus->CurrentValue, NULL, FALSE);

		// ekstrakuri
		$this->ekstrakuri->setDbValueDef($rsnew, $this->ekstrakuri->CurrentValue, NULL, FALSE);

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
		if ($masterTblVar == "jabatan") {
			$this->pidjabatan->Visible = FALSE;
			if ($GLOBALS["jabatan"]->EventCancelled)
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
				case "x_pidjabatan":
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
						case "x_pidjabatan":
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