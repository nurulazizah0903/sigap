<?php
namespace PHPMaker2020\sigap;

/**
 * Page class
 */
class jabatan_add extends jabatan
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}";

	// Table name
	public $TableName = 'jabatan';

	// Page object name
	public $PageObjName = "jabatan_add";

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

		// Table object (jabatan)
		if (!isset($GLOBALS["jabatan"]) || get_class($GLOBALS["jabatan"]) == PROJECT_NAMESPACE . "jabatan") {
			$GLOBALS["jabatan"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["jabatan"];
		}

		// Table object (pegawai)
		if (!isset($GLOBALS['pegawai']))
			$GLOBALS['pegawai'] = new pegawai();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'jabatan');

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
		global $jabatan;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($jabatan);
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
					if ($pageName == "jabatanview.php")
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
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRecord;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

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
			if (!$Security->canAdd()) {
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
			if (!$Security->canAdd()) {
				$Security->saveLastUrl();
				$this->setFailureMessage(DeniedMessage()); // Set no permission
				if ($Security->canList())
					$this->terminate(GetUrl("jabatanlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->nama_jabatan->setVisibility();
		$this->type_jabatan->setVisibility();
		$this->jenjang->setVisibility();
		$this->type_guru->setVisibility();
		$this->keterangan->setVisibility();
		$this->c_by->setVisibility();
		$this->c_date->setVisibility();
		$this->u_by->setVisibility();
		$this->u_date->setVisibility();
		$this->aktif->setVisibility();
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
		$this->setupLookupOptions($this->type_jabatan);
		$this->setupLookupOptions($this->jenjang);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("jabatanlist.php");
			return;
		}

		// Check modal
		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("id") !== NULL) {
				$this->id->setQueryStringValue(Get("id"));
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Set up detail parameters
		$this->setupDetailParms();

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("jabatanlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->setupDetailParms();
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() != "") // Master/detail add
						$returnUrl = $this->getDetailUrl();
					else
						$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "jabatanlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "jabatanview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values

					// Set up detail parameters
					$this->setupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
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
		$this->nama_jabatan->CurrentValue = NULL;
		$this->nama_jabatan->OldValue = $this->nama_jabatan->CurrentValue;
		$this->type_jabatan->CurrentValue = NULL;
		$this->type_jabatan->OldValue = $this->type_jabatan->CurrentValue;
		$this->jenjang->CurrentValue = NULL;
		$this->jenjang->OldValue = $this->jenjang->CurrentValue;
		$this->type_guru->CurrentValue = NULL;
		$this->type_guru->OldValue = $this->type_guru->CurrentValue;
		$this->keterangan->CurrentValue = NULL;
		$this->keterangan->OldValue = $this->keterangan->CurrentValue;
		$this->c_by->CurrentValue = NULL;
		$this->c_by->OldValue = $this->c_by->CurrentValue;
		$this->c_date->CurrentValue = NULL;
		$this->c_date->OldValue = $this->c_date->CurrentValue;
		$this->u_by->CurrentValue = NULL;
		$this->u_by->OldValue = $this->u_by->CurrentValue;
		$this->u_date->CurrentValue = NULL;
		$this->u_date->OldValue = $this->u_date->CurrentValue;
		$this->aktif->CurrentValue = NULL;
		$this->aktif->OldValue = $this->aktif->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'nama_jabatan' first before field var 'x_nama_jabatan'
		$val = $CurrentForm->hasValue("nama_jabatan") ? $CurrentForm->getValue("nama_jabatan") : $CurrentForm->getValue("x_nama_jabatan");
		if (!$this->nama_jabatan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nama_jabatan->Visible = FALSE; // Disable update for API request
			else
				$this->nama_jabatan->setFormValue($val);
		}

		// Check field name 'type_jabatan' first before field var 'x_type_jabatan'
		$val = $CurrentForm->hasValue("type_jabatan") ? $CurrentForm->getValue("type_jabatan") : $CurrentForm->getValue("x_type_jabatan");
		if (!$this->type_jabatan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->type_jabatan->Visible = FALSE; // Disable update for API request
			else
				$this->type_jabatan->setFormValue($val);
		}

		// Check field name 'jenjang' first before field var 'x_jenjang'
		$val = $CurrentForm->hasValue("jenjang") ? $CurrentForm->getValue("jenjang") : $CurrentForm->getValue("x_jenjang");
		if (!$this->jenjang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jenjang->Visible = FALSE; // Disable update for API request
			else
				$this->jenjang->setFormValue($val);
		}

		// Check field name 'type_guru' first before field var 'x_type_guru'
		$val = $CurrentForm->hasValue("type_guru") ? $CurrentForm->getValue("type_guru") : $CurrentForm->getValue("x_type_guru");
		if (!$this->type_guru->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->type_guru->Visible = FALSE; // Disable update for API request
			else
				$this->type_guru->setFormValue($val);
		}

		// Check field name 'keterangan' first before field var 'x_keterangan'
		$val = $CurrentForm->hasValue("keterangan") ? $CurrentForm->getValue("keterangan") : $CurrentForm->getValue("x_keterangan");
		if (!$this->keterangan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keterangan->Visible = FALSE; // Disable update for API request
			else
				$this->keterangan->setFormValue($val);
		}

		// Check field name 'c_by' first before field var 'x_c_by'
		$val = $CurrentForm->hasValue("c_by") ? $CurrentForm->getValue("c_by") : $CurrentForm->getValue("x_c_by");
		if (!$this->c_by->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->c_by->Visible = FALSE; // Disable update for API request
			else
				$this->c_by->setFormValue($val);
		}

		// Check field name 'c_date' first before field var 'x_c_date'
		$val = $CurrentForm->hasValue("c_date") ? $CurrentForm->getValue("c_date") : $CurrentForm->getValue("x_c_date");
		if (!$this->c_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->c_date->Visible = FALSE; // Disable update for API request
			else
				$this->c_date->setFormValue($val);
			$this->c_date->CurrentValue = UnFormatDateTime($this->c_date->CurrentValue, 0);
		}

		// Check field name 'u_by' first before field var 'x_u_by'
		$val = $CurrentForm->hasValue("u_by") ? $CurrentForm->getValue("u_by") : $CurrentForm->getValue("x_u_by");
		if (!$this->u_by->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->u_by->Visible = FALSE; // Disable update for API request
			else
				$this->u_by->setFormValue($val);
		}

		// Check field name 'u_date' first before field var 'x_u_date'
		$val = $CurrentForm->hasValue("u_date") ? $CurrentForm->getValue("u_date") : $CurrentForm->getValue("x_u_date");
		if (!$this->u_date->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->u_date->Visible = FALSE; // Disable update for API request
			else
				$this->u_date->setFormValue($val);
			$this->u_date->CurrentValue = UnFormatDateTime($this->u_date->CurrentValue, 0);
		}

		// Check field name 'aktif' first before field var 'x_aktif'
		$val = $CurrentForm->hasValue("aktif") ? $CurrentForm->getValue("aktif") : $CurrentForm->getValue("x_aktif");
		if (!$this->aktif->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->aktif->Visible = FALSE; // Disable update for API request
			else
				$this->aktif->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->nama_jabatan->CurrentValue = $this->nama_jabatan->FormValue;
		$this->type_jabatan->CurrentValue = $this->type_jabatan->FormValue;
		$this->jenjang->CurrentValue = $this->jenjang->FormValue;
		$this->type_guru->CurrentValue = $this->type_guru->FormValue;
		$this->keterangan->CurrentValue = $this->keterangan->FormValue;
		$this->c_by->CurrentValue = $this->c_by->FormValue;
		$this->c_date->CurrentValue = $this->c_date->FormValue;
		$this->c_date->CurrentValue = UnFormatDateTime($this->c_date->CurrentValue, 0);
		$this->u_by->CurrentValue = $this->u_by->FormValue;
		$this->u_date->CurrentValue = $this->u_date->FormValue;
		$this->u_date->CurrentValue = UnFormatDateTime($this->u_date->CurrentValue, 0);
		$this->aktif->CurrentValue = $this->aktif->FormValue;
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
		$this->nama_jabatan->setDbValue($row['nama_jabatan']);
		$this->type_jabatan->setDbValue($row['type_jabatan']);
		$this->jenjang->setDbValue($row['jenjang']);
		$this->type_guru->setDbValue($row['type_guru']);
		$this->keterangan->setDbValue($row['keterangan']);
		$this->c_by->setDbValue($row['c_by']);
		$this->c_date->setDbValue($row['c_date']);
		$this->u_by->setDbValue($row['u_by']);
		$this->u_date->setDbValue($row['u_date']);
		$this->aktif->setDbValue($row['aktif']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['nama_jabatan'] = $this->nama_jabatan->CurrentValue;
		$row['type_jabatan'] = $this->type_jabatan->CurrentValue;
		$row['jenjang'] = $this->jenjang->CurrentValue;
		$row['type_guru'] = $this->type_guru->CurrentValue;
		$row['keterangan'] = $this->keterangan->CurrentValue;
		$row['c_by'] = $this->c_by->CurrentValue;
		$row['c_date'] = $this->c_date->CurrentValue;
		$row['u_by'] = $this->u_by->CurrentValue;
		$row['u_date'] = $this->u_date->CurrentValue;
		$row['aktif'] = $this->aktif->CurrentValue;
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
		// nama_jabatan
		// type_jabatan
		// jenjang
		// type_guru
		// keterangan
		// c_by
		// c_date
		// u_by
		// u_date
		// aktif

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// nama_jabatan
			$this->nama_jabatan->ViewValue = $this->nama_jabatan->CurrentValue;
			$this->nama_jabatan->ViewCustomAttributes = "";

			// type_jabatan
			$curVal = strval($this->type_jabatan->CurrentValue);
			if ($curVal != "") {
				$this->type_jabatan->ViewValue = $this->type_jabatan->lookupCacheOption($curVal);
				if ($this->type_jabatan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->type_jabatan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->type_jabatan->ViewValue = $this->type_jabatan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->type_jabatan->ViewValue = $this->type_jabatan->CurrentValue;
					}
				}
			} else {
				$this->type_jabatan->ViewValue = NULL;
			}
			$this->type_jabatan->ViewCustomAttributes = "";

			// jenjang
			$curVal = strval($this->jenjang->CurrentValue);
			if ($curVal != "") {
				$this->jenjang->ViewValue = $this->jenjang->lookupCacheOption($curVal);
				if ($this->jenjang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`nourut`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->jenjang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->jenjang->ViewValue = $this->jenjang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jenjang->ViewValue = $this->jenjang->CurrentValue;
					}
				}
			} else {
				$this->jenjang->ViewValue = NULL;
			}
			$this->jenjang->ViewCustomAttributes = "";

			// type_guru
			$this->type_guru->ViewValue = $this->type_guru->CurrentValue;
			$this->type_guru->ViewValue = FormatNumber($this->type_guru->ViewValue, 0, -2, -2, -2);
			$this->type_guru->ViewCustomAttributes = "";

			// keterangan
			$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
			$this->keterangan->ViewCustomAttributes = "";

			// c_by
			$this->c_by->ViewValue = $this->c_by->CurrentValue;
			$this->c_by->ViewValue = FormatNumber($this->c_by->ViewValue, 0, -2, -2, -2);
			$this->c_by->ViewCustomAttributes = "";

			// c_date
			$this->c_date->ViewValue = $this->c_date->CurrentValue;
			$this->c_date->ViewValue = FormatDateTime($this->c_date->ViewValue, 0);
			$this->c_date->ViewCustomAttributes = "";

			// u_by
			$this->u_by->ViewValue = $this->u_by->CurrentValue;
			$this->u_by->ViewValue = FormatNumber($this->u_by->ViewValue, 0, -2, -2, -2);
			$this->u_by->ViewCustomAttributes = "";

			// u_date
			$this->u_date->ViewValue = $this->u_date->CurrentValue;
			$this->u_date->ViewValue = FormatDateTime($this->u_date->ViewValue, 0);
			$this->u_date->ViewCustomAttributes = "";

			// aktif
			$this->aktif->ViewValue = $this->aktif->CurrentValue;
			$this->aktif->ViewValue = FormatNumber($this->aktif->ViewValue, 0, -2, -2, -2);
			$this->aktif->ViewCustomAttributes = "";

			// nama_jabatan
			$this->nama_jabatan->LinkCustomAttributes = "";
			$this->nama_jabatan->HrefValue = "";
			$this->nama_jabatan->TooltipValue = "";

			// type_jabatan
			$this->type_jabatan->LinkCustomAttributes = "";
			$this->type_jabatan->HrefValue = "";
			$this->type_jabatan->TooltipValue = "";

			// jenjang
			$this->jenjang->LinkCustomAttributes = "";
			$this->jenjang->HrefValue = "";
			$this->jenjang->TooltipValue = "";

			// type_guru
			$this->type_guru->LinkCustomAttributes = "";
			$this->type_guru->HrefValue = "";
			$this->type_guru->TooltipValue = "";

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";
			$this->keterangan->TooltipValue = "";

			// c_by
			$this->c_by->LinkCustomAttributes = "";
			$this->c_by->HrefValue = "";
			$this->c_by->TooltipValue = "";

			// c_date
			$this->c_date->LinkCustomAttributes = "";
			$this->c_date->HrefValue = "";
			$this->c_date->TooltipValue = "";

			// u_by
			$this->u_by->LinkCustomAttributes = "";
			$this->u_by->HrefValue = "";
			$this->u_by->TooltipValue = "";

			// u_date
			$this->u_date->LinkCustomAttributes = "";
			$this->u_date->HrefValue = "";
			$this->u_date->TooltipValue = "";

			// aktif
			$this->aktif->LinkCustomAttributes = "";
			$this->aktif->HrefValue = "";
			$this->aktif->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// nama_jabatan
			$this->nama_jabatan->EditAttrs["class"] = "form-control";
			$this->nama_jabatan->EditCustomAttributes = "";
			if (!$this->nama_jabatan->Raw)
				$this->nama_jabatan->CurrentValue = HtmlDecode($this->nama_jabatan->CurrentValue);
			$this->nama_jabatan->EditValue = HtmlEncode($this->nama_jabatan->CurrentValue);
			$this->nama_jabatan->PlaceHolder = RemoveHtml($this->nama_jabatan->caption());

			// type_jabatan
			$this->type_jabatan->EditCustomAttributes = "";
			$curVal = trim(strval($this->type_jabatan->CurrentValue));
			if ($curVal != "")
				$this->type_jabatan->ViewValue = $this->type_jabatan->lookupCacheOption($curVal);
			else
				$this->type_jabatan->ViewValue = $this->type_jabatan->Lookup !== NULL && is_array($this->type_jabatan->Lookup->Options) ? $curVal : NULL;
			if ($this->type_jabatan->ViewValue !== NULL) { // Load from cache
				$this->type_jabatan->EditValue = array_values($this->type_jabatan->Lookup->Options);
				if ($this->type_jabatan->ViewValue == "")
					$this->type_jabatan->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->type_jabatan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->type_jabatan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->type_jabatan->ViewValue = $this->type_jabatan->displayValue($arwrk);
				} else {
					$this->type_jabatan->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->type_jabatan->EditValue = $arwrk;
			}

			// jenjang
			$this->jenjang->EditCustomAttributes = "";
			$curVal = trim(strval($this->jenjang->CurrentValue));
			if ($curVal != "")
				$this->jenjang->ViewValue = $this->jenjang->lookupCacheOption($curVal);
			else
				$this->jenjang->ViewValue = $this->jenjang->Lookup !== NULL && is_array($this->jenjang->Lookup->Options) ? $curVal : NULL;
			if ($this->jenjang->ViewValue !== NULL) { // Load from cache
				$this->jenjang->EditValue = array_values($this->jenjang->Lookup->Options);
				if ($this->jenjang->ViewValue == "")
					$this->jenjang->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`nourut`" . SearchString("=", $this->jenjang->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->jenjang->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->jenjang->ViewValue = $this->jenjang->displayValue($arwrk);
				} else {
					$this->jenjang->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->jenjang->EditValue = $arwrk;
			}

			// type_guru
			$this->type_guru->EditAttrs["class"] = "form-control";
			$this->type_guru->EditCustomAttributes = "";
			$this->type_guru->EditValue = HtmlEncode($this->type_guru->CurrentValue);
			$this->type_guru->PlaceHolder = RemoveHtml($this->type_guru->caption());

			// keterangan
			$this->keterangan->EditAttrs["class"] = "form-control";
			$this->keterangan->EditCustomAttributes = "";
			if (!$this->keterangan->Raw)
				$this->keterangan->CurrentValue = HtmlDecode($this->keterangan->CurrentValue);
			$this->keterangan->EditValue = HtmlEncode($this->keterangan->CurrentValue);
			$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

			// c_by
			$this->c_by->EditAttrs["class"] = "form-control";
			$this->c_by->EditCustomAttributes = "";
			$this->c_by->EditValue = HtmlEncode($this->c_by->CurrentValue);
			$this->c_by->PlaceHolder = RemoveHtml($this->c_by->caption());

			// c_date
			$this->c_date->EditAttrs["class"] = "form-control";
			$this->c_date->EditCustomAttributes = "";
			$this->c_date->EditValue = HtmlEncode(FormatDateTime($this->c_date->CurrentValue, 8));
			$this->c_date->PlaceHolder = RemoveHtml($this->c_date->caption());

			// u_by
			$this->u_by->EditAttrs["class"] = "form-control";
			$this->u_by->EditCustomAttributes = "";
			$this->u_by->EditValue = HtmlEncode($this->u_by->CurrentValue);
			$this->u_by->PlaceHolder = RemoveHtml($this->u_by->caption());

			// u_date
			$this->u_date->EditAttrs["class"] = "form-control";
			$this->u_date->EditCustomAttributes = "";
			$this->u_date->EditValue = HtmlEncode(FormatDateTime($this->u_date->CurrentValue, 8));
			$this->u_date->PlaceHolder = RemoveHtml($this->u_date->caption());

			// aktif
			$this->aktif->EditAttrs["class"] = "form-control";
			$this->aktif->EditCustomAttributes = "";
			$this->aktif->EditValue = HtmlEncode($this->aktif->CurrentValue);
			$this->aktif->PlaceHolder = RemoveHtml($this->aktif->caption());

			// Add refer script
			// nama_jabatan

			$this->nama_jabatan->LinkCustomAttributes = "";
			$this->nama_jabatan->HrefValue = "";

			// type_jabatan
			$this->type_jabatan->LinkCustomAttributes = "";
			$this->type_jabatan->HrefValue = "";

			// jenjang
			$this->jenjang->LinkCustomAttributes = "";
			$this->jenjang->HrefValue = "";

			// type_guru
			$this->type_guru->LinkCustomAttributes = "";
			$this->type_guru->HrefValue = "";

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";

			// c_by
			$this->c_by->LinkCustomAttributes = "";
			$this->c_by->HrefValue = "";

			// c_date
			$this->c_date->LinkCustomAttributes = "";
			$this->c_date->HrefValue = "";

			// u_by
			$this->u_by->LinkCustomAttributes = "";
			$this->u_by->HrefValue = "";

			// u_date
			$this->u_date->LinkCustomAttributes = "";
			$this->u_date->HrefValue = "";

			// aktif
			$this->aktif->LinkCustomAttributes = "";
			$this->aktif->HrefValue = "";
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
		if ($this->nama_jabatan->Required) {
			if (!$this->nama_jabatan->IsDetailKey && $this->nama_jabatan->FormValue != NULL && $this->nama_jabatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama_jabatan->caption(), $this->nama_jabatan->RequiredErrorMessage));
			}
		}
		if ($this->type_jabatan->Required) {
			if (!$this->type_jabatan->IsDetailKey && $this->type_jabatan->FormValue != NULL && $this->type_jabatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->type_jabatan->caption(), $this->type_jabatan->RequiredErrorMessage));
			}
		}
		if ($this->jenjang->Required) {
			if (!$this->jenjang->IsDetailKey && $this->jenjang->FormValue != NULL && $this->jenjang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenjang->caption(), $this->jenjang->RequiredErrorMessage));
			}
		}
		if ($this->type_guru->Required) {
			if (!$this->type_guru->IsDetailKey && $this->type_guru->FormValue != NULL && $this->type_guru->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->type_guru->caption(), $this->type_guru->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->type_guru->FormValue)) {
			AddMessage($FormError, $this->type_guru->errorMessage());
		}
		if ($this->keterangan->Required) {
			if (!$this->keterangan->IsDetailKey && $this->keterangan->FormValue != NULL && $this->keterangan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keterangan->caption(), $this->keterangan->RequiredErrorMessage));
			}
		}
		if ($this->c_by->Required) {
			if (!$this->c_by->IsDetailKey && $this->c_by->FormValue != NULL && $this->c_by->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->c_by->caption(), $this->c_by->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->c_by->FormValue)) {
			AddMessage($FormError, $this->c_by->errorMessage());
		}
		if ($this->c_date->Required) {
			if (!$this->c_date->IsDetailKey && $this->c_date->FormValue != NULL && $this->c_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->c_date->caption(), $this->c_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->c_date->FormValue)) {
			AddMessage($FormError, $this->c_date->errorMessage());
		}
		if ($this->u_by->Required) {
			if (!$this->u_by->IsDetailKey && $this->u_by->FormValue != NULL && $this->u_by->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->u_by->caption(), $this->u_by->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->u_by->FormValue)) {
			AddMessage($FormError, $this->u_by->errorMessage());
		}
		if ($this->u_date->Required) {
			if (!$this->u_date->IsDetailKey && $this->u_date->FormValue != NULL && $this->u_date->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->u_date->caption(), $this->u_date->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->u_date->FormValue)) {
			AddMessage($FormError, $this->u_date->errorMessage());
		}
		if ($this->aktif->Required) {
			if (!$this->aktif->IsDetailKey && $this->aktif->FormValue != NULL && $this->aktif->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->aktif->caption(), $this->aktif->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->aktif->FormValue)) {
			AddMessage($FormError, $this->aktif->errorMessage());
		}

		// Validate detail grid
		$detailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("gajitunjangan", $detailTblVar) && $GLOBALS["gajitunjangan"]->DetailAdd) {
			if (!isset($GLOBALS["gajitunjangan_grid"]))
				$GLOBALS["gajitunjangan_grid"] = new gajitunjangan_grid(); // Get detail page object
			$GLOBALS["gajitunjangan_grid"]->validateGridForm();
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

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = $this->getConnection();

		// Begin transaction
		if ($this->getCurrentDetailTable() != "")
			$conn->beginTrans();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// nama_jabatan
		$this->nama_jabatan->setDbValueDef($rsnew, $this->nama_jabatan->CurrentValue, NULL, FALSE);

		// type_jabatan
		$this->type_jabatan->setDbValueDef($rsnew, $this->type_jabatan->CurrentValue, NULL, FALSE);

		// jenjang
		$this->jenjang->setDbValueDef($rsnew, $this->jenjang->CurrentValue, NULL, FALSE);

		// type_guru
		$this->type_guru->setDbValueDef($rsnew, $this->type_guru->CurrentValue, NULL, FALSE);

		// keterangan
		$this->keterangan->setDbValueDef($rsnew, $this->keterangan->CurrentValue, NULL, FALSE);

		// c_by
		$this->c_by->setDbValueDef($rsnew, $this->c_by->CurrentValue, NULL, FALSE);

		// c_date
		$this->c_date->setDbValueDef($rsnew, UnFormatDateTime($this->c_date->CurrentValue, 0), NULL, FALSE);

		// u_by
		$this->u_by->setDbValueDef($rsnew, $this->u_by->CurrentValue, NULL, FALSE);

		// u_date
		$this->u_date->setDbValueDef($rsnew, UnFormatDateTime($this->u_date->CurrentValue, 0), NULL, FALSE);

		// aktif
		$this->aktif->setDbValueDef($rsnew, $this->aktif->CurrentValue, NULL, FALSE);

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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("gajitunjangan", $detailTblVar) && $GLOBALS["gajitunjangan"]->DetailAdd) {
				$GLOBALS["gajitunjangan"]->pidjabatan->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["gajitunjangan_grid"]))
					$GLOBALS["gajitunjangan_grid"] = new gajitunjangan_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "gajitunjangan"); // Load user level of detail table
				$addRow = $GLOBALS["gajitunjangan_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["gajitunjangan"]->pidjabatan->setSessionValue(""); // Clear master key if insert failed
				}
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() != "") {
			if ($addRow) {
				$conn->commitTrans(); // Commit transaction
			} else {
				$conn->rollbackTrans(); // Rollback transaction
			}
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

	// Set up detail parms based on QueryString
	protected function setupDetailParms()
	{

		// Get the keys for master table
		$detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
		if ($detailTblVar !== NULL) {
			$this->setCurrentDetailTable($detailTblVar);
		} else {
			$detailTblVar = $this->getCurrentDetailTable();
		}
		if ($detailTblVar != "") {
			$detailTblVar = explode(",", $detailTblVar);
			if (in_array("gajitunjangan", $detailTblVar)) {
				if (!isset($GLOBALS["gajitunjangan_grid"]))
					$GLOBALS["gajitunjangan_grid"] = new gajitunjangan_grid();
				if ($GLOBALS["gajitunjangan_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["gajitunjangan_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["gajitunjangan_grid"]->CurrentMode = "add";
					$GLOBALS["gajitunjangan_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["gajitunjangan_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["gajitunjangan_grid"]->setStartRecordNumber(1);
					$GLOBALS["gajitunjangan_grid"]->pidjabatan->IsDetailKey = TRUE;
					$GLOBALS["gajitunjangan_grid"]->pidjabatan->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["gajitunjangan_grid"]->pidjabatan->setSessionValue($GLOBALS["gajitunjangan_grid"]->pidjabatan->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("jabatanlist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
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
				case "x_type_jabatan":
					break;
				case "x_jenjang":
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
						case "x_type_jabatan":
							break;
						case "x_jenjang":
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
} // End class
?>