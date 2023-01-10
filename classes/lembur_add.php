<?php
namespace PHPMaker2020\sigap;

/**
 * Page class
 */
class lembur_add extends lembur
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}";

	// Table name
	public $TableName = 'lembur';

	// Page object name
	public $PageObjName = "lembur_add";

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

		// Table object (lembur)
		if (!isset($GLOBALS["lembur"]) || get_class($GLOBALS["lembur"]) == PROJECT_NAMESPACE . "lembur") {
			$GLOBALS["lembur"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["lembur"];
		}

		// Table object (pegawai)
		if (!isset($GLOBALS['pegawai']))
			$GLOBALS['pegawai'] = new pegawai();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'lembur');

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
		global $lembur;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($lembur);
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
					if ($pageName == "lemburview.php")
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
					$this->terminate(GetUrl("lemburlist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->pegawai->setVisibility();
		$this->pm->setVisibility();
		$this->proyek->setVisibility();
		$this->tgl->setVisibility();
		$this->tgl_awal_lembur->setVisibility();
		$this->tgl_akhir_lembur->setVisibility();
		$this->total_jam->setVisibility();
		$this->jenis->setVisibility();
		$this->keterangan->setVisibility();
		$this->disetujui->setVisibility();
		$this->dokumen->setVisibility();
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
		$this->setupLookupOptions($this->disetujui);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("lemburlist.php");
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
					$this->terminate("lemburlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "lemburlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "lemburview.php")
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
		$this->dokumen->Upload->Index = $CurrentForm->Index;
		$this->dokumen->Upload->uploadFile();
		$this->dokumen->CurrentValue = $this->dokumen->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->pegawai->CurrentValue = NULL;
		$this->pegawai->OldValue = $this->pegawai->CurrentValue;
		$this->pm->CurrentValue = NULL;
		$this->pm->OldValue = $this->pm->CurrentValue;
		$this->proyek->CurrentValue = NULL;
		$this->proyek->OldValue = $this->proyek->CurrentValue;
		$this->tgl->CurrentValue = NULL;
		$this->tgl->OldValue = $this->tgl->CurrentValue;
		$this->tgl_awal_lembur->CurrentValue = NULL;
		$this->tgl_awal_lembur->OldValue = $this->tgl_awal_lembur->CurrentValue;
		$this->tgl_akhir_lembur->CurrentValue = NULL;
		$this->tgl_akhir_lembur->OldValue = $this->tgl_akhir_lembur->CurrentValue;
		$this->total_jam->CurrentValue = NULL;
		$this->total_jam->OldValue = $this->total_jam->CurrentValue;
		$this->jenis->CurrentValue = NULL;
		$this->jenis->OldValue = $this->jenis->CurrentValue;
		$this->keterangan->CurrentValue = NULL;
		$this->keterangan->OldValue = $this->keterangan->CurrentValue;
		$this->disetujui->CurrentValue = NULL;
		$this->disetujui->OldValue = $this->disetujui->CurrentValue;
		$this->dokumen->Upload->DbValue = NULL;
		$this->dokumen->OldValue = $this->dokumen->Upload->DbValue;
		$this->dokumen->CurrentValue = NULL; // Clear file related field
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'pegawai' first before field var 'x_pegawai'
		$val = $CurrentForm->hasValue("pegawai") ? $CurrentForm->getValue("pegawai") : $CurrentForm->getValue("x_pegawai");
		if (!$this->pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->pegawai->setFormValue($val);
		}

		// Check field name 'pm' first before field var 'x_pm'
		$val = $CurrentForm->hasValue("pm") ? $CurrentForm->getValue("pm") : $CurrentForm->getValue("x_pm");
		if (!$this->pm->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pm->Visible = FALSE; // Disable update for API request
			else
				$this->pm->setFormValue($val);
		}

		// Check field name 'proyek' first before field var 'x_proyek'
		$val = $CurrentForm->hasValue("proyek") ? $CurrentForm->getValue("proyek") : $CurrentForm->getValue("x_proyek");
		if (!$this->proyek->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->proyek->Visible = FALSE; // Disable update for API request
			else
				$this->proyek->setFormValue($val);
		}

		// Check field name 'tgl' first before field var 'x_tgl'
		$val = $CurrentForm->hasValue("tgl") ? $CurrentForm->getValue("tgl") : $CurrentForm->getValue("x_tgl");
		if (!$this->tgl->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl->Visible = FALSE; // Disable update for API request
			else
				$this->tgl->setFormValue($val);
			$this->tgl->CurrentValue = UnFormatDateTime($this->tgl->CurrentValue, 0);
		}

		// Check field name 'tgl_awal_lembur' first before field var 'x_tgl_awal_lembur'
		$val = $CurrentForm->hasValue("tgl_awal_lembur") ? $CurrentForm->getValue("tgl_awal_lembur") : $CurrentForm->getValue("x_tgl_awal_lembur");
		if (!$this->tgl_awal_lembur->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl_awal_lembur->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_awal_lembur->setFormValue($val);
			$this->tgl_awal_lembur->CurrentValue = UnFormatDateTime($this->tgl_awal_lembur->CurrentValue, 0);
		}

		// Check field name 'tgl_akhir_lembur' first before field var 'x_tgl_akhir_lembur'
		$val = $CurrentForm->hasValue("tgl_akhir_lembur") ? $CurrentForm->getValue("tgl_akhir_lembur") : $CurrentForm->getValue("x_tgl_akhir_lembur");
		if (!$this->tgl_akhir_lembur->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl_akhir_lembur->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_akhir_lembur->setFormValue($val);
			$this->tgl_akhir_lembur->CurrentValue = UnFormatDateTime($this->tgl_akhir_lembur->CurrentValue, 0);
		}

		// Check field name 'total_jam' first before field var 'x_total_jam'
		$val = $CurrentForm->hasValue("total_jam") ? $CurrentForm->getValue("total_jam") : $CurrentForm->getValue("x_total_jam");
		if (!$this->total_jam->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->total_jam->Visible = FALSE; // Disable update for API request
			else
				$this->total_jam->setFormValue($val);
		}

		// Check field name 'jenis' first before field var 'x_jenis'
		$val = $CurrentForm->hasValue("jenis") ? $CurrentForm->getValue("jenis") : $CurrentForm->getValue("x_jenis");
		if (!$this->jenis->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jenis->Visible = FALSE; // Disable update for API request
			else
				$this->jenis->setFormValue($val);
		}

		// Check field name 'keterangan' first before field var 'x_keterangan'
		$val = $CurrentForm->hasValue("keterangan") ? $CurrentForm->getValue("keterangan") : $CurrentForm->getValue("x_keterangan");
		if (!$this->keterangan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keterangan->Visible = FALSE; // Disable update for API request
			else
				$this->keterangan->setFormValue($val);
		}

		// Check field name 'disetujui' first before field var 'x_disetujui'
		$val = $CurrentForm->hasValue("disetujui") ? $CurrentForm->getValue("disetujui") : $CurrentForm->getValue("x_disetujui");
		if (!$this->disetujui->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->disetujui->Visible = FALSE; // Disable update for API request
			else
				$this->disetujui->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->pegawai->CurrentValue = $this->pegawai->FormValue;
		$this->pm->CurrentValue = $this->pm->FormValue;
		$this->proyek->CurrentValue = $this->proyek->FormValue;
		$this->tgl->CurrentValue = $this->tgl->FormValue;
		$this->tgl->CurrentValue = UnFormatDateTime($this->tgl->CurrentValue, 0);
		$this->tgl_awal_lembur->CurrentValue = $this->tgl_awal_lembur->FormValue;
		$this->tgl_awal_lembur->CurrentValue = UnFormatDateTime($this->tgl_awal_lembur->CurrentValue, 0);
		$this->tgl_akhir_lembur->CurrentValue = $this->tgl_akhir_lembur->FormValue;
		$this->tgl_akhir_lembur->CurrentValue = UnFormatDateTime($this->tgl_akhir_lembur->CurrentValue, 0);
		$this->total_jam->CurrentValue = $this->total_jam->FormValue;
		$this->jenis->CurrentValue = $this->jenis->FormValue;
		$this->keterangan->CurrentValue = $this->keterangan->FormValue;
		$this->disetujui->CurrentValue = $this->disetujui->FormValue;
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
		$this->pegawai->setDbValue($row['pegawai']);
		$this->pm->setDbValue($row['pm']);
		$this->proyek->setDbValue($row['proyek']);
		$this->tgl->setDbValue($row['tgl']);
		$this->tgl_awal_lembur->setDbValue($row['tgl_awal_lembur']);
		$this->tgl_akhir_lembur->setDbValue($row['tgl_akhir_lembur']);
		$this->total_jam->setDbValue($row['total_jam']);
		$this->jenis->setDbValue($row['jenis']);
		$this->keterangan->setDbValue($row['keterangan']);
		$this->disetujui->setDbValue($row['disetujui']);
		$this->dokumen->Upload->DbValue = $row['dokumen'];
		$this->dokumen->setDbValue($this->dokumen->Upload->DbValue);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['pegawai'] = $this->pegawai->CurrentValue;
		$row['pm'] = $this->pm->CurrentValue;
		$row['proyek'] = $this->proyek->CurrentValue;
		$row['tgl'] = $this->tgl->CurrentValue;
		$row['tgl_awal_lembur'] = $this->tgl_awal_lembur->CurrentValue;
		$row['tgl_akhir_lembur'] = $this->tgl_akhir_lembur->CurrentValue;
		$row['total_jam'] = $this->total_jam->CurrentValue;
		$row['jenis'] = $this->jenis->CurrentValue;
		$row['keterangan'] = $this->keterangan->CurrentValue;
		$row['disetujui'] = $this->disetujui->CurrentValue;
		$row['dokumen'] = $this->dokumen->Upload->DbValue;
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
		// pegawai
		// pm
		// proyek
		// tgl
		// tgl_awal_lembur
		// tgl_akhir_lembur
		// total_jam
		// jenis
		// keterangan
		// disetujui
		// dokumen

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// pegawai
			$this->pegawai->ViewValue = $this->pegawai->CurrentValue;
			$this->pegawai->ViewValue = FormatNumber($this->pegawai->ViewValue, 0, -2, -2, -2);
			$this->pegawai->ViewCustomAttributes = "";

			// pm
			$this->pm->ViewValue = $this->pm->CurrentValue;
			$this->pm->ViewValue = FormatNumber($this->pm->ViewValue, 0, -2, -2, -2);
			$this->pm->ViewCustomAttributes = "";

			// proyek
			$this->proyek->ViewValue = $this->proyek->CurrentValue;
			$this->proyek->ViewCustomAttributes = "";

			// tgl
			$this->tgl->ViewValue = $this->tgl->CurrentValue;
			$this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, 0);
			$this->tgl->ViewCustomAttributes = "";

			// tgl_awal_lembur
			$this->tgl_awal_lembur->ViewValue = $this->tgl_awal_lembur->CurrentValue;
			$this->tgl_awal_lembur->ViewValue = FormatDateTime($this->tgl_awal_lembur->ViewValue, 0);
			$this->tgl_awal_lembur->ViewCustomAttributes = "";

			// tgl_akhir_lembur
			$this->tgl_akhir_lembur->ViewValue = $this->tgl_akhir_lembur->CurrentValue;
			$this->tgl_akhir_lembur->ViewValue = FormatDateTime($this->tgl_akhir_lembur->ViewValue, 0);
			$this->tgl_akhir_lembur->ViewCustomAttributes = "";

			// total_jam
			$this->total_jam->ViewValue = $this->total_jam->CurrentValue;
			$this->total_jam->ViewValue = FormatNumber($this->total_jam->ViewValue, 0, -2, -2, -2);
			$this->total_jam->ViewCustomAttributes = "";

			// jenis
			$this->jenis->ViewValue = $this->jenis->CurrentValue;
			$this->jenis->ViewCustomAttributes = "";

			// keterangan
			$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
			$this->keterangan->ViewCustomAttributes = "";

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

			// dokumen
			if (!EmptyValue($this->dokumen->Upload->DbValue)) {
				$this->dokumen->ViewValue = $this->dokumen->Upload->DbValue;
			} else {
				$this->dokumen->ViewValue = "";
			}
			$this->dokumen->ViewCustomAttributes = "";

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

			// tgl_awal_lembur
			$this->tgl_awal_lembur->LinkCustomAttributes = "";
			$this->tgl_awal_lembur->HrefValue = "";
			$this->tgl_awal_lembur->TooltipValue = "";

			// tgl_akhir_lembur
			$this->tgl_akhir_lembur->LinkCustomAttributes = "";
			$this->tgl_akhir_lembur->HrefValue = "";
			$this->tgl_akhir_lembur->TooltipValue = "";

			// total_jam
			$this->total_jam->LinkCustomAttributes = "";
			$this->total_jam->HrefValue = "";
			$this->total_jam->TooltipValue = "";

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// pegawai
			$this->pegawai->EditAttrs["class"] = "form-control";
			$this->pegawai->EditCustomAttributes = "";
			$this->pegawai->EditValue = HtmlEncode($this->pegawai->CurrentValue);
			$this->pegawai->PlaceHolder = RemoveHtml($this->pegawai->caption());

			// pm
			$this->pm->EditAttrs["class"] = "form-control";
			$this->pm->EditCustomAttributes = "";
			$this->pm->EditValue = HtmlEncode($this->pm->CurrentValue);
			$this->pm->PlaceHolder = RemoveHtml($this->pm->caption());

			// proyek
			$this->proyek->EditAttrs["class"] = "form-control";
			$this->proyek->EditCustomAttributes = "";
			if (!$this->proyek->Raw)
				$this->proyek->CurrentValue = HtmlDecode($this->proyek->CurrentValue);
			$this->proyek->EditValue = HtmlEncode($this->proyek->CurrentValue);
			$this->proyek->PlaceHolder = RemoveHtml($this->proyek->caption());

			// tgl
			$this->tgl->EditAttrs["class"] = "form-control";
			$this->tgl->EditCustomAttributes = "";
			$this->tgl->EditValue = HtmlEncode(FormatDateTime($this->tgl->CurrentValue, 8));
			$this->tgl->PlaceHolder = RemoveHtml($this->tgl->caption());

			// tgl_awal_lembur
			$this->tgl_awal_lembur->EditAttrs["class"] = "form-control";
			$this->tgl_awal_lembur->EditCustomAttributes = "";
			$this->tgl_awal_lembur->EditValue = HtmlEncode(FormatDateTime($this->tgl_awal_lembur->CurrentValue, 8));
			$this->tgl_awal_lembur->PlaceHolder = RemoveHtml($this->tgl_awal_lembur->caption());

			// tgl_akhir_lembur
			$this->tgl_akhir_lembur->EditAttrs["class"] = "form-control";
			$this->tgl_akhir_lembur->EditCustomAttributes = "";
			$this->tgl_akhir_lembur->EditValue = HtmlEncode(FormatDateTime($this->tgl_akhir_lembur->CurrentValue, 8));
			$this->tgl_akhir_lembur->PlaceHolder = RemoveHtml($this->tgl_akhir_lembur->caption());

			// total_jam
			$this->total_jam->EditAttrs["class"] = "form-control";
			$this->total_jam->EditCustomAttributes = "";
			$this->total_jam->EditValue = HtmlEncode($this->total_jam->CurrentValue);
			$this->total_jam->PlaceHolder = RemoveHtml($this->total_jam->caption());

			// jenis
			$this->jenis->EditAttrs["class"] = "form-control";
			$this->jenis->EditCustomAttributes = "";
			if (!$this->jenis->Raw)
				$this->jenis->CurrentValue = HtmlDecode($this->jenis->CurrentValue);
			$this->jenis->EditValue = HtmlEncode($this->jenis->CurrentValue);
			$this->jenis->PlaceHolder = RemoveHtml($this->jenis->caption());

			// keterangan
			$this->keterangan->EditAttrs["class"] = "form-control";
			$this->keterangan->EditCustomAttributes = "";
			if (!$this->keterangan->Raw)
				$this->keterangan->CurrentValue = HtmlDecode($this->keterangan->CurrentValue);
			$this->keterangan->EditValue = HtmlEncode($this->keterangan->CurrentValue);
			$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

			// disetujui
			$this->disetujui->EditCustomAttributes = "";
			$curVal = trim(strval($this->disetujui->CurrentValue));
			if ($curVal != "")
				$this->disetujui->ViewValue = $this->disetujui->lookupCacheOption($curVal);
			else
				$this->disetujui->ViewValue = $this->disetujui->Lookup !== NULL && is_array($this->disetujui->Lookup->Options) ? $curVal : NULL;
			if ($this->disetujui->ViewValue !== NULL) { // Load from cache
				$this->disetujui->EditValue = array_values($this->disetujui->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`name`" . SearchString("=", $this->disetujui->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->disetujui->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->disetujui->EditValue = $arwrk;
			}

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
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->dokumen);

			// Add refer script
			// pegawai

			$this->pegawai->LinkCustomAttributes = "";
			$this->pegawai->HrefValue = "";

			// pm
			$this->pm->LinkCustomAttributes = "";
			$this->pm->HrefValue = "";

			// proyek
			$this->proyek->LinkCustomAttributes = "";
			$this->proyek->HrefValue = "";

			// tgl
			$this->tgl->LinkCustomAttributes = "";
			$this->tgl->HrefValue = "";

			// tgl_awal_lembur
			$this->tgl_awal_lembur->LinkCustomAttributes = "";
			$this->tgl_awal_lembur->HrefValue = "";

			// tgl_akhir_lembur
			$this->tgl_akhir_lembur->LinkCustomAttributes = "";
			$this->tgl_akhir_lembur->HrefValue = "";

			// total_jam
			$this->total_jam->LinkCustomAttributes = "";
			$this->total_jam->HrefValue = "";

			// jenis
			$this->jenis->LinkCustomAttributes = "";
			$this->jenis->HrefValue = "";

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";

			// disetujui
			$this->disetujui->LinkCustomAttributes = "";
			$this->disetujui->HrefValue = "";

			// dokumen
			$this->dokumen->LinkCustomAttributes = "";
			$this->dokumen->HrefValue = "";
			$this->dokumen->ExportHrefValue = $this->dokumen->UploadPath . $this->dokumen->Upload->DbValue;
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
		if ($this->pegawai->Required) {
			if (!$this->pegawai->IsDetailKey && $this->pegawai->FormValue != NULL && $this->pegawai->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pegawai->caption(), $this->pegawai->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->pegawai->FormValue)) {
			AddMessage($FormError, $this->pegawai->errorMessage());
		}
		if ($this->pm->Required) {
			if (!$this->pm->IsDetailKey && $this->pm->FormValue != NULL && $this->pm->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pm->caption(), $this->pm->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->pm->FormValue)) {
			AddMessage($FormError, $this->pm->errorMessage());
		}
		if ($this->proyek->Required) {
			if (!$this->proyek->IsDetailKey && $this->proyek->FormValue != NULL && $this->proyek->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->proyek->caption(), $this->proyek->RequiredErrorMessage));
			}
		}
		if ($this->tgl->Required) {
			if (!$this->tgl->IsDetailKey && $this->tgl->FormValue != NULL && $this->tgl->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl->caption(), $this->tgl->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl->FormValue)) {
			AddMessage($FormError, $this->tgl->errorMessage());
		}
		if ($this->tgl_awal_lembur->Required) {
			if (!$this->tgl_awal_lembur->IsDetailKey && $this->tgl_awal_lembur->FormValue != NULL && $this->tgl_awal_lembur->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_awal_lembur->caption(), $this->tgl_awal_lembur->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_awal_lembur->FormValue)) {
			AddMessage($FormError, $this->tgl_awal_lembur->errorMessage());
		}
		if ($this->tgl_akhir_lembur->Required) {
			if (!$this->tgl_akhir_lembur->IsDetailKey && $this->tgl_akhir_lembur->FormValue != NULL && $this->tgl_akhir_lembur->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_akhir_lembur->caption(), $this->tgl_akhir_lembur->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_akhir_lembur->FormValue)) {
			AddMessage($FormError, $this->tgl_akhir_lembur->errorMessage());
		}
		if ($this->total_jam->Required) {
			if (!$this->total_jam->IsDetailKey && $this->total_jam->FormValue != NULL && $this->total_jam->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->total_jam->caption(), $this->total_jam->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->total_jam->FormValue)) {
			AddMessage($FormError, $this->total_jam->errorMessage());
		}
		if ($this->jenis->Required) {
			if (!$this->jenis->IsDetailKey && $this->jenis->FormValue != NULL && $this->jenis->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenis->caption(), $this->jenis->RequiredErrorMessage));
			}
		}
		if ($this->keterangan->Required) {
			if (!$this->keterangan->IsDetailKey && $this->keterangan->FormValue != NULL && $this->keterangan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keterangan->caption(), $this->keterangan->RequiredErrorMessage));
			}
		}
		if ($this->disetujui->Required) {
			if ($this->disetujui->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->disetujui->caption(), $this->disetujui->RequiredErrorMessage));
			}
		}
		if ($this->dokumen->Required) {
			if ($this->dokumen->Upload->FileName == "" && !$this->dokumen->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->dokumen->caption(), $this->dokumen->RequiredErrorMessage));
			}
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

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// pegawai
		$this->pegawai->setDbValueDef($rsnew, $this->pegawai->CurrentValue, NULL, FALSE);

		// pm
		$this->pm->setDbValueDef($rsnew, $this->pm->CurrentValue, NULL, FALSE);

		// proyek
		$this->proyek->setDbValueDef($rsnew, $this->proyek->CurrentValue, NULL, FALSE);

		// tgl
		$this->tgl->setDbValueDef($rsnew, UnFormatDateTime($this->tgl->CurrentValue, 0), NULL, FALSE);

		// tgl_awal_lembur
		$this->tgl_awal_lembur->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_awal_lembur->CurrentValue, 0), NULL, FALSE);

		// tgl_akhir_lembur
		$this->tgl_akhir_lembur->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_akhir_lembur->CurrentValue, 0), NULL, FALSE);

		// total_jam
		$this->total_jam->setDbValueDef($rsnew, $this->total_jam->CurrentValue, NULL, FALSE);

		// jenis
		$this->jenis->setDbValueDef($rsnew, $this->jenis->CurrentValue, NULL, FALSE);

		// keterangan
		$this->keterangan->setDbValueDef($rsnew, $this->keterangan->CurrentValue, NULL, FALSE);

		// disetujui
		$this->disetujui->setDbValueDef($rsnew, $this->disetujui->CurrentValue, NULL, FALSE);

		// dokumen
		if ($this->dokumen->Visible && !$this->dokumen->Upload->KeepFile) {
			$this->dokumen->Upload->DbValue = ""; // No need to delete old file
			if ($this->dokumen->Upload->FileName == "") {
				$rsnew['dokumen'] = NULL;
			} else {
				$rsnew['dokumen'] = $this->dokumen->Upload->FileName;
			}
		}
		if ($this->dokumen->Visible && !$this->dokumen->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->dokumen->Upload->DbValue) ? [] : [$this->dokumen->htmlDecode($this->dokumen->Upload->DbValue)];
			if (!EmptyValue($this->dokumen->Upload->FileName)) {
				$newFiles = [$this->dokumen->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->dokumen, $this->dokumen->Upload->Index);
						if (file_exists($tempPath . $file)) {
							if (Config("DELETE_UPLOADED_FILES")) {
								$oldFileFound = FALSE;
								$oldFileCount = count($oldFiles);
								for ($j = 0; $j < $oldFileCount; $j++) {
									$oldFile = $oldFiles[$j];
									if ($oldFile == $file) { // Old file found, no need to delete anymore
										array_splice($oldFiles, $j, 1);
										$oldFileFound = TRUE;
										break;
									}
								}
								if ($oldFileFound) // No need to check if file exists further
									continue;
							}
							$file1 = UniqueFilename($this->dokumen->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->dokumen->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->dokumen->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->dokumen->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->dokumen->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->dokumen->setDbValueDef($rsnew, $this->dokumen->Upload->FileName, NULL, FALSE);
			}
		}

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);
		if ($insertRow) {
			$conn->raiseErrorFn = Config("ERROR_FUNC");
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = "";
			if ($addRow) {
				if ($this->dokumen->Visible && !$this->dokumen->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->dokumen->Upload->DbValue) ? [] : [$this->dokumen->htmlDecode($this->dokumen->Upload->DbValue)];
					if (!EmptyValue($this->dokumen->Upload->FileName)) {
						$newFiles = [$this->dokumen->Upload->FileName];
						$newFiles2 = [$this->dokumen->htmlDecode($rsnew['dokumen'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->dokumen, $this->dokumen->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->dokumen->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
										$this->setFailureMessage($Language->phrase("UploadErrMsg7"));
										return FALSE;
									}
								}
							}
						}
					} else {
						$newFiles = [];
					}
					if (Config("DELETE_UPLOADED_FILES")) {
						foreach ($oldFiles as $oldFile) {
							if ($oldFile != "" && !in_array($oldFile, $newFiles))
								@unlink($this->dokumen->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
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

			// dokumen
			CleanUploadTempPath($this->dokumen, $this->dokumen->Upload->Index);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("lemburlist.php"), "", $this->TableVar, TRUE);
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
				case "x_disetujui":
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
						case "x_disetujui":
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