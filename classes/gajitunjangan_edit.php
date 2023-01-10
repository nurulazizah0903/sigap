<?php
namespace PHPMaker2020\sigap;

/**
 * Page class
 */
class gajitunjangan_edit extends gajitunjangan
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}";

	// Table name
	public $TableName = 'gajitunjangan';

	// Page object name
	public $PageObjName = "gajitunjangan_edit";

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

		// Table object (gajitunjangan)
		if (!isset($GLOBALS["gajitunjangan"]) || get_class($GLOBALS["gajitunjangan"]) == PROJECT_NAMESPACE . "gajitunjangan") {
			$GLOBALS["gajitunjangan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["gajitunjangan"];
		}

		// Table object (jabatan)
		if (!isset($GLOBALS['jabatan']))
			$GLOBALS['jabatan'] = new jabatan();

		// Table object (pegawai)
		if (!isset($GLOBALS['pegawai']))
			$GLOBALS['pegawai'] = new pegawai();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

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
					if ($pageName == "gajitunjanganview.php")
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
					$this->terminate(GetUrl("gajitunjanganlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
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
		$this->setupLookupOptions($this->pidjabatan);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("gajitunjanganlist.php");
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
					$this->terminate("gajitunjanganlist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "gajitunjanganlist.php")
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

		// Check field name 'pidjabatan' first before field var 'x_pidjabatan'
		$val = $CurrentForm->hasValue("pidjabatan") ? $CurrentForm->getValue("pidjabatan") : $CurrentForm->getValue("x_pidjabatan");
		if (!$this->pidjabatan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pidjabatan->Visible = FALSE; // Disable update for API request
			else
				$this->pidjabatan->setFormValue($val);
		}

		// Check field name 'value_kehadiran' first before field var 'x_value_kehadiran'
		$val = $CurrentForm->hasValue("value_kehadiran") ? $CurrentForm->getValue("value_kehadiran") : $CurrentForm->getValue("x_value_kehadiran");
		if (!$this->value_kehadiran->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->value_kehadiran->Visible = FALSE; // Disable update for API request
			else
				$this->value_kehadiran->setFormValue($val);
		}

		// Check field name 'gapok' first before field var 'x_gapok'
		$val = $CurrentForm->hasValue("gapok") ? $CurrentForm->getValue("gapok") : $CurrentForm->getValue("x_gapok");
		if (!$this->gapok->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->gapok->Visible = FALSE; // Disable update for API request
			else
				$this->gapok->setFormValue($val);
		}

		// Check field name 'tunjangan_jabatan' first before field var 'x_tunjangan_jabatan'
		$val = $CurrentForm->hasValue("tunjangan_jabatan") ? $CurrentForm->getValue("tunjangan_jabatan") : $CurrentForm->getValue("x_tunjangan_jabatan");
		if (!$this->tunjangan_jabatan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tunjangan_jabatan->Visible = FALSE; // Disable update for API request
			else
				$this->tunjangan_jabatan->setFormValue($val);
		}

		// Check field name 'reward' first before field var 'x_reward'
		$val = $CurrentForm->hasValue("reward") ? $CurrentForm->getValue("reward") : $CurrentForm->getValue("x_reward");
		if (!$this->reward->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->reward->Visible = FALSE; // Disable update for API request
			else
				$this->reward->setFormValue($val);
		}

		// Check field name 'lembur' first before field var 'x_lembur'
		$val = $CurrentForm->hasValue("lembur") ? $CurrentForm->getValue("lembur") : $CurrentForm->getValue("x_lembur");
		if (!$this->lembur->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->lembur->Visible = FALSE; // Disable update for API request
			else
				$this->lembur->setFormValue($val);
		}

		// Check field name 'piket' first before field var 'x_piket'
		$val = $CurrentForm->hasValue("piket") ? $CurrentForm->getValue("piket") : $CurrentForm->getValue("x_piket");
		if (!$this->piket->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->piket->Visible = FALSE; // Disable update for API request
			else
				$this->piket->setFormValue($val);
		}

		// Check field name 'inval' first before field var 'x_inval'
		$val = $CurrentForm->hasValue("inval") ? $CurrentForm->getValue("inval") : $CurrentForm->getValue("x_inval");
		if (!$this->inval->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->inval->Visible = FALSE; // Disable update for API request
			else
				$this->inval->setFormValue($val);
		}

		// Check field name 'jam_lebih' first before field var 'x_jam_lebih'
		$val = $CurrentForm->hasValue("jam_lebih") ? $CurrentForm->getValue("jam_lebih") : $CurrentForm->getValue("x_jam_lebih");
		if (!$this->jam_lebih->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jam_lebih->Visible = FALSE; // Disable update for API request
			else
				$this->jam_lebih->setFormValue($val);
		}

		// Check field name 'tunjangan_khusus' first before field var 'x_tunjangan_khusus'
		$val = $CurrentForm->hasValue("tunjangan_khusus") ? $CurrentForm->getValue("tunjangan_khusus") : $CurrentForm->getValue("x_tunjangan_khusus");
		if (!$this->tunjangan_khusus->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tunjangan_khusus->Visible = FALSE; // Disable update for API request
			else
				$this->tunjangan_khusus->setFormValue($val);
		}

		// Check field name 'ekstrakuri' first before field var 'x_ekstrakuri'
		$val = $CurrentForm->hasValue("ekstrakuri") ? $CurrentForm->getValue("ekstrakuri") : $CurrentForm->getValue("x_ekstrakuri");
		if (!$this->ekstrakuri->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->ekstrakuri->Visible = FALSE; // Disable update for API request
			else
				$this->ekstrakuri->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
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
		$row = [];
		$row['id'] = NULL;
		$row['pidjabatan'] = NULL;
		$row['value_kehadiran'] = NULL;
		$row['gapok'] = NULL;
		$row['tunjangan_jabatan'] = NULL;
		$row['reward'] = NULL;
		$row['lembur'] = NULL;
		$row['piket'] = NULL;
		$row['inval'] = NULL;
		$row['jam_lebih'] = NULL;
		$row['tunjangan_khusus'] = NULL;
		$row['ekstrakuri'] = NULL;
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

		// Initialize form error message
		$FormError = "";

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
			if ($masterTblVar == "jabatan") {
				$validMaster = TRUE;
				if (($parm = Get("fk_id", Get("pidjabatan"))) !== NULL) {
					$GLOBALS["jabatan"]->id->setQueryStringValue($parm);
					$this->pidjabatan->setQueryStringValue($GLOBALS["jabatan"]->id->QueryStringValue);
					$this->pidjabatan->setSessionValue($this->pidjabatan->QueryStringValue);
					if (!is_numeric($GLOBALS["jabatan"]->id->QueryStringValue))
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
			if ($masterTblVar == "jabatan") {
				$validMaster = TRUE;
				if (($parm = Post("fk_id", Post("pidjabatan"))) !== NULL) {
					$GLOBALS["jabatan"]->id->setFormValue($parm);
					$this->pidjabatan->setFormValue($GLOBALS["jabatan"]->id->FormValue);
					$this->pidjabatan->setSessionValue($this->pidjabatan->FormValue);
					if (!is_numeric($GLOBALS["jabatan"]->id->FormValue))
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
			if ($masterTblVar != "jabatan") {
				if ($this->pidjabatan->CurrentValue == "")
					$this->pidjabatan->setSessionValue("");
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("gajitunjanganlist.php"), "", $this->TableVar, TRUE);
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