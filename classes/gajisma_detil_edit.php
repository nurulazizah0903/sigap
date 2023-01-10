<?php
namespace PHPMaker2020\sigap;

/**
 * Page class
 */
class gajisma_detil_edit extends gajisma_detil
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}";

	// Table name
	public $TableName = 'gajisma_detil';

	// Page object name
	public $PageObjName = "gajisma_detil_edit";

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
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (gajisma_detil)
		if (!isset($GLOBALS["gajisma_detil"]) || get_class($GLOBALS["gajisma_detil"]) == PROJECT_NAMESPACE . "gajisma_detil") {
			$GLOBALS["gajisma_detil"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["gajisma_detil"];
		}

		// Table object (gajisma)
		if (!isset($GLOBALS['gajisma']))
			$GLOBALS['gajisma'] = new gajisma();

		// Table object (pegawai)
		if (!isset($GLOBALS['pegawai']))
			$GLOBALS['pegawai'] = new pegawai();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'gajisma_detil');

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
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages, $DashboardReport;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $gajisma_detil;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($gajisma_detil);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

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

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = ["url" => $url, "modal" => "1"];
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "gajisma_detilview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// User profile
		$UserProfile = new UserProfile();

		// Security
		if (ValidApiRequest()) { // API request
			$this->setupApiSecurity(); // Set up API Security
			if (!$Security->canEdit()) {
				SetStatus(401); // Unauthorized
				return;
			}
		} else {
			$Security = new AdvancedSecurity();
			if (!$Security->isLoggedIn())
				$Security->autoLogin();
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loading();
			$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName);
			if ($Security->isLoggedIn())
				$Security->TablePermission_Loaded();
			if (!$Security->canEdit()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("gajisma_detillist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->setVisibility();
		$this->pid->setVisibility();
		$this->pegawai_id->setVisibility();
		$this->jabatan_id->setVisibility();
		$this->masakerja->setVisibility();
		$this->jumngajar->setVisibility();
		$this->ijin->setVisibility();
		$this->tunjangan_wkosis->setVisibility();
		$this->nominal_baku->setVisibility();
		$this->baku->setVisibility();
		$this->kehadiran->setVisibility();
		$this->prestasi->setVisibility();
		$this->jumlahgaji->setVisibility();
		$this->jumgajitotal->setVisibility();
		$this->potongan1->setVisibility();
		$this->potongan2->setVisibility();
		$this->jumlahterima->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

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

		// Set up lookup cache
		$this->setupLookupOptions($this->pegawai_id);
		$this->setupLookupOptions($this->jabatan_id);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("gajisma_detillist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {

			// Load key values
			$loaded = TRUE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->id->setOldValue($this->id->QueryStringValue);
			} elseif (Key(0) !== NULL) {
				$this->id->setQueryStringValue(Key(0));
				$this->id->setOldValue($this->id->QueryStringValue);
			} elseif (Post("id") !== NULL) {
				$this->id->setFormValue(Post("id"));
				$this->id->setOldValue($this->id->FormValue);
			} elseif (Route(2) !== NULL) {
				$this->id->setQueryStringValue(Route(2));
				$this->id->setOldValue($this->id->QueryStringValue);
			} else {
				$loaded = FALSE; // Unable to load key
			}

			// Load record
			if ($loaded)
				$loaded = $this->loadRow();
			if (!$loaded) {
				$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
				$this->terminate();
				return;
			}
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} else {
			if (Post("action") !== NULL) {
				$this->CurrentAction = Post("action"); // Get action code
				if (!$this->isShow()) // Not reload record, handle as postback
					$postBack = TRUE;

				// Load key from Form
				if ($CurrentForm->hasValue("x_id")) {
					$this->id->setFormValue($CurrentForm->getValue("x_id"));
				}
			} else {
				$this->CurrentAction = "show"; // Default action is display

				// Load key from QueryString / Route
				$loadByQuery = FALSE;
				if (Get("id") !== NULL) {
					$this->id->setQueryStringValue(Get("id"));
					$loadByQuery = TRUE;
				} elseif (Route(2) !== NULL) {
					$this->id->setQueryStringValue(Route(2));
					$loadByQuery = TRUE;
				} else {
					$this->id->CurrentValue = NULL;
				}
			}

			// Set up master detail parameters
			$this->setupMasterParms();

			// Load current record
			$loaded = $this->loadRow();
		}

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("gajisma_detillist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "gajisma_detillist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);

		// Check field name 'pid' first before field var 'x_pid'
		$val = $CurrentForm->hasValue("pid") ? $CurrentForm->getValue("pid") : $CurrentForm->getValue("x_pid");
		if (!$this->pid->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pid->Visible = FALSE; // Disable update for API request
			else
				$this->pid->setFormValue($val);
		}

		// Check field name 'pegawai_id' first before field var 'x_pegawai_id'
		$val = $CurrentForm->hasValue("pegawai_id") ? $CurrentForm->getValue("pegawai_id") : $CurrentForm->getValue("x_pegawai_id");
		if (!$this->pegawai_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pegawai_id->Visible = FALSE; // Disable update for API request
			else
				$this->pegawai_id->setFormValue($val);
		}

		// Check field name 'jabatan_id' first before field var 'x_jabatan_id'
		$val = $CurrentForm->hasValue("jabatan_id") ? $CurrentForm->getValue("jabatan_id") : $CurrentForm->getValue("x_jabatan_id");
		if (!$this->jabatan_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jabatan_id->Visible = FALSE; // Disable update for API request
			else
				$this->jabatan_id->setFormValue($val);
		}

		// Check field name 'masakerja' first before field var 'x_masakerja'
		$val = $CurrentForm->hasValue("masakerja") ? $CurrentForm->getValue("masakerja") : $CurrentForm->getValue("x_masakerja");
		if (!$this->masakerja->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->masakerja->Visible = FALSE; // Disable update for API request
			else
				$this->masakerja->setFormValue($val);
		}

		// Check field name 'jumngajar' first before field var 'x_jumngajar'
		$val = $CurrentForm->hasValue("jumngajar") ? $CurrentForm->getValue("jumngajar") : $CurrentForm->getValue("x_jumngajar");
		if (!$this->jumngajar->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jumngajar->Visible = FALSE; // Disable update for API request
			else
				$this->jumngajar->setFormValue($val);
		}

		// Check field name 'ijin' first before field var 'x_ijin'
		$val = $CurrentForm->hasValue("ijin") ? $CurrentForm->getValue("ijin") : $CurrentForm->getValue("x_ijin");
		if (!$this->ijin->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ijin->Visible = FALSE; // Disable update for API request
			else
				$this->ijin->setFormValue($val);
		}

		// Check field name 'tunjangan_wkosis' first before field var 'x_tunjangan_wkosis'
		$val = $CurrentForm->hasValue("tunjangan_wkosis") ? $CurrentForm->getValue("tunjangan_wkosis") : $CurrentForm->getValue("x_tunjangan_wkosis");
		if (!$this->tunjangan_wkosis->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tunjangan_wkosis->Visible = FALSE; // Disable update for API request
			else
				$this->tunjangan_wkosis->setFormValue($val);
		}

		// Check field name 'nominal_baku' first before field var 'x_nominal_baku'
		$val = $CurrentForm->hasValue("nominal_baku") ? $CurrentForm->getValue("nominal_baku") : $CurrentForm->getValue("x_nominal_baku");
		if (!$this->nominal_baku->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nominal_baku->Visible = FALSE; // Disable update for API request
			else
				$this->nominal_baku->setFormValue($val);
		}

		// Check field name 'baku' first before field var 'x_baku'
		$val = $CurrentForm->hasValue("baku") ? $CurrentForm->getValue("baku") : $CurrentForm->getValue("x_baku");
		if (!$this->baku->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->baku->Visible = FALSE; // Disable update for API request
			else
				$this->baku->setFormValue($val);
		}

		// Check field name 'kehadiran' first before field var 'x_kehadiran'
		$val = $CurrentForm->hasValue("kehadiran") ? $CurrentForm->getValue("kehadiran") : $CurrentForm->getValue("x_kehadiran");
		if (!$this->kehadiran->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->kehadiran->Visible = FALSE; // Disable update for API request
			else
				$this->kehadiran->setFormValue($val);
		}

		// Check field name 'prestasi' first before field var 'x_prestasi'
		$val = $CurrentForm->hasValue("prestasi") ? $CurrentForm->getValue("prestasi") : $CurrentForm->getValue("x_prestasi");
		if (!$this->prestasi->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->prestasi->Visible = FALSE; // Disable update for API request
			else
				$this->prestasi->setFormValue($val);
		}

		// Check field name 'jumlahgaji' first before field var 'x_jumlahgaji'
		$val = $CurrentForm->hasValue("jumlahgaji") ? $CurrentForm->getValue("jumlahgaji") : $CurrentForm->getValue("x_jumlahgaji");
		if (!$this->jumlahgaji->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jumlahgaji->Visible = FALSE; // Disable update for API request
			else
				$this->jumlahgaji->setFormValue($val);
		}

		// Check field name 'jumgajitotal' first before field var 'x_jumgajitotal'
		$val = $CurrentForm->hasValue("jumgajitotal") ? $CurrentForm->getValue("jumgajitotal") : $CurrentForm->getValue("x_jumgajitotal");
		if (!$this->jumgajitotal->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jumgajitotal->Visible = FALSE; // Disable update for API request
			else
				$this->jumgajitotal->setFormValue($val);
		}

		// Check field name 'potongan1' first before field var 'x_potongan1'
		$val = $CurrentForm->hasValue("potongan1") ? $CurrentForm->getValue("potongan1") : $CurrentForm->getValue("x_potongan1");
		if (!$this->potongan1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->potongan1->Visible = FALSE; // Disable update for API request
			else
				$this->potongan1->setFormValue($val);
		}

		// Check field name 'potongan2' first before field var 'x_potongan2'
		$val = $CurrentForm->hasValue("potongan2") ? $CurrentForm->getValue("potongan2") : $CurrentForm->getValue("x_potongan2");
		if (!$this->potongan2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->potongan2->Visible = FALSE; // Disable update for API request
			else
				$this->potongan2->setFormValue($val);
		}

		// Check field name 'jumlahterima' first before field var 'x_jumlahterima'
		$val = $CurrentForm->hasValue("jumlahterima") ? $CurrentForm->getValue("jumlahterima") : $CurrentForm->getValue("x_jumlahterima");
		if (!$this->jumlahterima->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jumlahterima->Visible = FALSE; // Disable update for API request
			else
				$this->jumlahterima->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->pid->CurrentValue = $this->pid->FormValue;
		$this->pegawai_id->CurrentValue = $this->pegawai_id->FormValue;
		$this->jabatan_id->CurrentValue = $this->jabatan_id->FormValue;
		$this->masakerja->CurrentValue = $this->masakerja->FormValue;
		$this->jumngajar->CurrentValue = $this->jumngajar->FormValue;
		$this->ijin->CurrentValue = $this->ijin->FormValue;
		$this->tunjangan_wkosis->CurrentValue = $this->tunjangan_wkosis->FormValue;
		$this->nominal_baku->CurrentValue = $this->nominal_baku->FormValue;
		$this->baku->CurrentValue = $this->baku->FormValue;
		$this->kehadiran->CurrentValue = $this->kehadiran->FormValue;
		$this->prestasi->CurrentValue = $this->prestasi->FormValue;
		$this->jumlahgaji->CurrentValue = $this->jumlahgaji->FormValue;
		$this->jumgajitotal->CurrentValue = $this->jumgajitotal->FormValue;
		$this->potongan1->CurrentValue = $this->potongan1->FormValue;
		$this->potongan2->CurrentValue = $this->potongan2->FormValue;
		$this->jumlahterima->CurrentValue = $this->jumlahterima->FormValue;
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
		$this->tunjangan_wkosis->setDbValue($row['tunjangan_wkosis']);
		$this->nominal_baku->setDbValue($row['nominal_baku']);
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
		$row = [];
		$row['id'] = NULL;
		$row['pid'] = NULL;
		$row['pegawai_id'] = NULL;
		$row['jabatan_id'] = NULL;
		$row['masakerja'] = NULL;
		$row['jumngajar'] = NULL;
		$row['ijin'] = NULL;
		$row['tunjangan_wkosis'] = NULL;
		$row['nominal_baku'] = NULL;
		$row['baku'] = NULL;
		$row['kehadiran'] = NULL;
		$row['prestasi'] = NULL;
		$row['jumlahgaji'] = NULL;
		$row['jumgajitotal'] = NULL;
		$row['potongan1'] = NULL;
		$row['potongan2'] = NULL;
		$row['jumlahterima'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id")) != "")
			$this->id->OldValue = $this->getKey("id"); // id
		else
			$validKey = FALSE;

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
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

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
				$this->pid->EditValue = HtmlEncode($this->pid->CurrentValue);
				$this->pid->PlaceHolder = RemoveHtml($this->pid->caption());
			}

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
					$filterWrk = "`nip`" . SearchString("=", $this->pegawai_id->CurrentValue, DATATYPE_STRING, "");
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

			// tunjangan_wkosis
			$this->tunjangan_wkosis->EditAttrs["class"] = "form-control";
			$this->tunjangan_wkosis->EditCustomAttributes = "";
			$this->tunjangan_wkosis->EditValue = HtmlEncode($this->tunjangan_wkosis->CurrentValue);
			$this->tunjangan_wkosis->PlaceHolder = RemoveHtml($this->tunjangan_wkosis->caption());

			// nominal_baku
			$this->nominal_baku->EditAttrs["class"] = "form-control";
			$this->nominal_baku->EditCustomAttributes = "";
			$this->nominal_baku->EditValue = HtmlEncode($this->nominal_baku->CurrentValue);
			$this->nominal_baku->PlaceHolder = RemoveHtml($this->nominal_baku->caption());

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
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// pid
			$this->pid->LinkCustomAttributes = "";
			$this->pid->HrefValue = "";

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

			// tunjangan_wkosis
			$this->tunjangan_wkosis->LinkCustomAttributes = "";
			$this->tunjangan_wkosis->HrefValue = "";

			// nominal_baku
			$this->nominal_baku->LinkCustomAttributes = "";
			$this->nominal_baku->HrefValue = "";

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

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!Config("SERVER_VALIDATE"))
			return ($FormError == "");
		if ($this->id->Required) {
			if (!$this->id->IsDetailKey && $this->id->FormValue != NULL && $this->id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
			}
		}
		if ($this->pid->Required) {
			if (!$this->pid->IsDetailKey && $this->pid->FormValue != NULL && $this->pid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pid->caption(), $this->pid->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->pid->FormValue)) {
			AddMessage($FormError, $this->pid->errorMessage());
		}
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
		if ($this->tunjangan_wkosis->Required) {
			if (!$this->tunjangan_wkosis->IsDetailKey && $this->tunjangan_wkosis->FormValue != NULL && $this->tunjangan_wkosis->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tunjangan_wkosis->caption(), $this->tunjangan_wkosis->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->tunjangan_wkosis->FormValue)) {
			AddMessage($FormError, $this->tunjangan_wkosis->errorMessage());
		}
		if ($this->nominal_baku->Required) {
			if (!$this->nominal_baku->IsDetailKey && $this->nominal_baku->FormValue != NULL && $this->nominal_baku->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nominal_baku->caption(), $this->nominal_baku->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->nominal_baku->FormValue)) {
			AddMessage($FormError, $this->nominal_baku->errorMessage());
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

			// pid
			$this->pid->setDbValueDef($rsnew, $this->pid->CurrentValue, NULL, $this->pid->ReadOnly);

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

			// tunjangan_wkosis
			$this->tunjangan_wkosis->setDbValueDef($rsnew, $this->tunjangan_wkosis->CurrentValue, NULL, $this->tunjangan_wkosis->ReadOnly);

			// nominal_baku
			$this->nominal_baku->setDbValueDef($rsnew, $this->nominal_baku->CurrentValue, NULL, $this->nominal_baku->ReadOnly);

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

			// Check referential integrity for master table 'gajisma'
			$validMasterRecord = TRUE;
			$masterFilter = $this->sqlMasterFilter_gajisma();
			$keyValue = isset($rsnew['pid']) ? $rsnew['pid'] : $rsold['pid'];
			if (strval($keyValue) != "") {
				$masterFilter = str_replace("@id@", AdjustSql($keyValue), $masterFilter);
			} else {
				$validMasterRecord = FALSE;
			}
			if ($validMasterRecord) {
				if (!isset($GLOBALS["gajisma"]))
					$GLOBALS["gajisma"] = new gajisma();
				$rsmaster = $GLOBALS["gajisma"]->loadRs($masterFilter);
				$validMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->close();
			}
			if (!$validMasterRecord) {
				$relatedRecordMsg = str_replace("%t", "gajisma", $Language->phrase("RelatedRecordRequired"));
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

	// Set up master/detail based on QueryString
	protected function setupMasterParms()
	{
		$validMaster = FALSE;

		// Get the keys for master table
		if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "gajisma") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("pid"))) !== NULL) {
					$GLOBALS["gajisma"]->id->setQueryStringValue($parm);
					$this->pid->setQueryStringValue($GLOBALS["gajisma"]->id->QueryStringValue);
					$this->pid->setSessionValue($this->pid->QueryStringValue);
					if (!is_numeric($GLOBALS["gajisma"]->id->QueryStringValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		} elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== NULL) {
			$masterTblVar = $master;
			if ($masterTblVar == "") {
				$validMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($masterTblVar == "gajisma") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("pid"))) !== NULL) {
					$GLOBALS["gajisma"]->id->setFormValue($parm);
					$this->pid->setFormValue($GLOBALS["gajisma"]->id->FormValue);
					$this->pid->setSessionValue($this->pid->FormValue);
					if (!is_numeric($GLOBALS["gajisma"]->id->FormValue))
						$validMaster = FALSE;
				} else {
					$validMaster = FALSE;
				}
			}
		}
		if ($validMaster) {

			// Save current master table
			$this->setCurrentMasterTable($masterTblVar);
			$this->setSessionWhere($this->getDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->isAddOrEdit()) {
				$this->StartRecord = 1;
				$this->setStartRecordNumber($this->StartRecord);
			}

			// Clear previous master key from Session
			if ($masterTblVar != "gajisma") {
				if ($this->pid->CurrentValue == "")
					$this->pid->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("gajisma_detillist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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

	// Set up starting record parameters
	public function setupStartRecord()
	{
		if ($this->DisplayRecords == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			$startRec = Get(Config("TABLE_START_REC"));
			$pageNo = Get(Config("TABLE_PAGE_NO"));
			if ($pageNo !== NULL) { // Check for "pageno" parameter first
				if (is_numeric($pageNo)) {
					$this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
					if ($this->StartRecord <= 0) {
						$this->StartRecord = 1;
					} elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1) {
						$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1;
					}
					$this->setStartRecordNumber($this->StartRecord);
				}
			} elseif ($startRec !== NULL) { // Check for "start" parameter
				$this->StartRecord = $startRec;
				$this->setStartRecordNumber($this->StartRecord);
			}
		}
		$this->StartRecord = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
			$this->StartRecord = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRecord);
		} elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
			$this->StartRecord = (int)(($this->TotalRecords - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRecord);
		} elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
			$this->StartRecord = (int)(($this->StartRecord - 1)/$this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRecord);
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
} // End class
?>