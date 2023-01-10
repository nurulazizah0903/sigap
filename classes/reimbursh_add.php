<?php
namespace PHPMaker2020\sigap;

/**
 * Page class
 */
class reimbursh_add extends reimbursh
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}";

	// Table name
	public $TableName = 'reimbursh';

	// Page object name
	public $PageObjName = "reimbursh_add";

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

		// Table object (reimbursh)
		if (!isset($GLOBALS["reimbursh"]) || get_class($GLOBALS["reimbursh"]) == PROJECT_NAMESPACE . "reimbursh") {
			$GLOBALS["reimbursh"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["reimbursh"];
		}

		// Table object (pegawai)
		if (!isset($GLOBALS['pegawai']))
			$GLOBALS['pegawai'] = new pegawai();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'reimbursh');

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
		global $reimbursh;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($reimbursh);
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
					if ($pageName == "reimburshview.php")
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
					$this->terminate(GetUrl("reimburshlist.php"));
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
		$this->nama->setVisibility();
		$this->tgl->setVisibility();
		$this->total_pengajuan->setVisibility();
		$this->tgl_pengajuan->setVisibility();
		$this->jenis->setVisibility();
		$this->keterangan->setVisibility();
		$this->rek_tujuan->setVisibility();
		$this->bukti1->setVisibility();
		$this->bukti2->setVisibility();
		$this->bukti3->setVisibility();
		$this->bukti4->setVisibility();
		$this->disetujui->setVisibility();
		$this->pembayar->setVisibility();
		$this->terbayar->setVisibility();
		$this->tgl_pembayaran->setVisibility();
		$this->jumlah_dibayar->setVisibility();
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
		$this->setupLookupOptions($this->pegawai);
		$this->setupLookupOptions($this->disetujui);
		$this->setupLookupOptions($this->terbayar);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("reimburshlist.php");
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
					$this->terminate("reimburshlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "reimburshlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "reimburshview.php")
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
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->pegawai->CurrentValue = NULL;
		$this->pegawai->OldValue = $this->pegawai->CurrentValue;
		$this->nama->CurrentValue = NULL;
		$this->nama->OldValue = $this->nama->CurrentValue;
		$this->tgl->CurrentValue = NULL;
		$this->tgl->OldValue = $this->tgl->CurrentValue;
		$this->total_pengajuan->CurrentValue = NULL;
		$this->total_pengajuan->OldValue = $this->total_pengajuan->CurrentValue;
		$this->tgl_pengajuan->CurrentValue = NULL;
		$this->tgl_pengajuan->OldValue = $this->tgl_pengajuan->CurrentValue;
		$this->jenis->CurrentValue = NULL;
		$this->jenis->OldValue = $this->jenis->CurrentValue;
		$this->keterangan->CurrentValue = NULL;
		$this->keterangan->OldValue = $this->keterangan->CurrentValue;
		$this->rek_tujuan->CurrentValue = NULL;
		$this->rek_tujuan->OldValue = $this->rek_tujuan->CurrentValue;
		$this->bukti1->CurrentValue = NULL;
		$this->bukti1->OldValue = $this->bukti1->CurrentValue;
		$this->bukti2->CurrentValue = NULL;
		$this->bukti2->OldValue = $this->bukti2->CurrentValue;
		$this->bukti3->CurrentValue = NULL;
		$this->bukti3->OldValue = $this->bukti3->CurrentValue;
		$this->bukti4->CurrentValue = NULL;
		$this->bukti4->OldValue = $this->bukti4->CurrentValue;
		$this->disetujui->CurrentValue = NULL;
		$this->disetujui->OldValue = $this->disetujui->CurrentValue;
		$this->pembayar->CurrentValue = NULL;
		$this->pembayar->OldValue = $this->pembayar->CurrentValue;
		$this->terbayar->CurrentValue = NULL;
		$this->terbayar->OldValue = $this->terbayar->CurrentValue;
		$this->tgl_pembayaran->CurrentValue = NULL;
		$this->tgl_pembayaran->OldValue = $this->tgl_pembayaran->CurrentValue;
		$this->jumlah_dibayar->CurrentValue = NULL;
		$this->jumlah_dibayar->OldValue = $this->jumlah_dibayar->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'pegawai' first before field var 'x_pegawai'
		$val = $CurrentForm->hasValue("pegawai") ? $CurrentForm->getValue("pegawai") : $CurrentForm->getValue("x_pegawai");
		if (!$this->pegawai->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pegawai->Visible = FALSE; // Disable update for API request
			else
				$this->pegawai->setFormValue($val);
		}

		// Check field name 'nama' first before field var 'x_nama'
		$val = $CurrentForm->hasValue("nama") ? $CurrentForm->getValue("nama") : $CurrentForm->getValue("x_nama");
		if (!$this->nama->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nama->Visible = FALSE; // Disable update for API request
			else
				$this->nama->setFormValue($val);
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

		// Check field name 'total_pengajuan' first before field var 'x_total_pengajuan'
		$val = $CurrentForm->hasValue("total_pengajuan") ? $CurrentForm->getValue("total_pengajuan") : $CurrentForm->getValue("x_total_pengajuan");
		if (!$this->total_pengajuan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->total_pengajuan->Visible = FALSE; // Disable update for API request
			else
				$this->total_pengajuan->setFormValue($val);
		}

		// Check field name 'tgl_pengajuan' first before field var 'x_tgl_pengajuan'
		$val = $CurrentForm->hasValue("tgl_pengajuan") ? $CurrentForm->getValue("tgl_pengajuan") : $CurrentForm->getValue("x_tgl_pengajuan");
		if (!$this->tgl_pengajuan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl_pengajuan->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_pengajuan->setFormValue($val);
			$this->tgl_pengajuan->CurrentValue = UnFormatDateTime($this->tgl_pengajuan->CurrentValue, 0);
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

		// Check field name 'rek_tujuan' first before field var 'x_rek_tujuan'
		$val = $CurrentForm->hasValue("rek_tujuan") ? $CurrentForm->getValue("rek_tujuan") : $CurrentForm->getValue("x_rek_tujuan");
		if (!$this->rek_tujuan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->rek_tujuan->Visible = FALSE; // Disable update for API request
			else
				$this->rek_tujuan->setFormValue($val);
		}

		// Check field name 'bukti1' first before field var 'x_bukti1'
		$val = $CurrentForm->hasValue("bukti1") ? $CurrentForm->getValue("bukti1") : $CurrentForm->getValue("x_bukti1");
		if (!$this->bukti1->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->bukti1->Visible = FALSE; // Disable update for API request
			else
				$this->bukti1->setFormValue($val);
		}

		// Check field name 'bukti2' first before field var 'x_bukti2'
		$val = $CurrentForm->hasValue("bukti2") ? $CurrentForm->getValue("bukti2") : $CurrentForm->getValue("x_bukti2");
		if (!$this->bukti2->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->bukti2->Visible = FALSE; // Disable update for API request
			else
				$this->bukti2->setFormValue($val);
		}

		// Check field name 'bukti3' first before field var 'x_bukti3'
		$val = $CurrentForm->hasValue("bukti3") ? $CurrentForm->getValue("bukti3") : $CurrentForm->getValue("x_bukti3");
		if (!$this->bukti3->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->bukti3->Visible = FALSE; // Disable update for API request
			else
				$this->bukti3->setFormValue($val);
		}

		// Check field name 'bukti4' first before field var 'x_bukti4'
		$val = $CurrentForm->hasValue("bukti4") ? $CurrentForm->getValue("bukti4") : $CurrentForm->getValue("x_bukti4");
		if (!$this->bukti4->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->bukti4->Visible = FALSE; // Disable update for API request
			else
				$this->bukti4->setFormValue($val);
		}

		// Check field name 'disetujui' first before field var 'x_disetujui'
		$val = $CurrentForm->hasValue("disetujui") ? $CurrentForm->getValue("disetujui") : $CurrentForm->getValue("x_disetujui");
		if (!$this->disetujui->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->disetujui->Visible = FALSE; // Disable update for API request
			else
				$this->disetujui->setFormValue($val);
		}

		// Check field name 'pembayar' first before field var 'x_pembayar'
		$val = $CurrentForm->hasValue("pembayar") ? $CurrentForm->getValue("pembayar") : $CurrentForm->getValue("x_pembayar");
		if (!$this->pembayar->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pembayar->Visible = FALSE; // Disable update for API request
			else
				$this->pembayar->setFormValue($val);
		}

		// Check field name 'terbayar' first before field var 'x_terbayar'
		$val = $CurrentForm->hasValue("terbayar") ? $CurrentForm->getValue("terbayar") : $CurrentForm->getValue("x_terbayar");
		if (!$this->terbayar->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->terbayar->Visible = FALSE; // Disable update for API request
			else
				$this->terbayar->setFormValue($val);
		}

		// Check field name 'tgl_pembayaran' first before field var 'x_tgl_pembayaran'
		$val = $CurrentForm->hasValue("tgl_pembayaran") ? $CurrentForm->getValue("tgl_pembayaran") : $CurrentForm->getValue("x_tgl_pembayaran");
		if (!$this->tgl_pembayaran->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl_pembayaran->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_pembayaran->setFormValue($val);
			$this->tgl_pembayaran->CurrentValue = UnFormatDateTime($this->tgl_pembayaran->CurrentValue, 0);
		}

		// Check field name 'jumlah_dibayar' first before field var 'x_jumlah_dibayar'
		$val = $CurrentForm->hasValue("jumlah_dibayar") ? $CurrentForm->getValue("jumlah_dibayar") : $CurrentForm->getValue("x_jumlah_dibayar");
		if (!$this->jumlah_dibayar->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jumlah_dibayar->Visible = FALSE; // Disable update for API request
			else
				$this->jumlah_dibayar->setFormValue($val);
		}

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->pegawai->CurrentValue = $this->pegawai->FormValue;
		$this->nama->CurrentValue = $this->nama->FormValue;
		$this->tgl->CurrentValue = $this->tgl->FormValue;
		$this->tgl->CurrentValue = UnFormatDateTime($this->tgl->CurrentValue, 0);
		$this->total_pengajuan->CurrentValue = $this->total_pengajuan->FormValue;
		$this->tgl_pengajuan->CurrentValue = $this->tgl_pengajuan->FormValue;
		$this->tgl_pengajuan->CurrentValue = UnFormatDateTime($this->tgl_pengajuan->CurrentValue, 0);
		$this->jenis->CurrentValue = $this->jenis->FormValue;
		$this->keterangan->CurrentValue = $this->keterangan->FormValue;
		$this->rek_tujuan->CurrentValue = $this->rek_tujuan->FormValue;
		$this->bukti1->CurrentValue = $this->bukti1->FormValue;
		$this->bukti2->CurrentValue = $this->bukti2->FormValue;
		$this->bukti3->CurrentValue = $this->bukti3->FormValue;
		$this->bukti4->CurrentValue = $this->bukti4->FormValue;
		$this->disetujui->CurrentValue = $this->disetujui->FormValue;
		$this->pembayar->CurrentValue = $this->pembayar->FormValue;
		$this->terbayar->CurrentValue = $this->terbayar->FormValue;
		$this->tgl_pembayaran->CurrentValue = $this->tgl_pembayaran->FormValue;
		$this->tgl_pembayaran->CurrentValue = UnFormatDateTime($this->tgl_pembayaran->CurrentValue, 0);
		$this->jumlah_dibayar->CurrentValue = $this->jumlah_dibayar->FormValue;
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
		$this->nama->setDbValue($row['nama']);
		$this->tgl->setDbValue($row['tgl']);
		$this->total_pengajuan->setDbValue($row['total_pengajuan']);
		$this->tgl_pengajuan->setDbValue($row['tgl_pengajuan']);
		$this->jenis->setDbValue($row['jenis']);
		$this->keterangan->setDbValue($row['keterangan']);
		$this->rek_tujuan->setDbValue($row['rek_tujuan']);
		$this->bukti1->setDbValue($row['bukti1']);
		$this->bukti2->setDbValue($row['bukti2']);
		$this->bukti3->setDbValue($row['bukti3']);
		$this->bukti4->setDbValue($row['bukti4']);
		$this->disetujui->setDbValue($row['disetujui']);
		$this->pembayar->setDbValue($row['pembayar']);
		$this->terbayar->setDbValue($row['terbayar']);
		$this->tgl_pembayaran->setDbValue($row['tgl_pembayaran']);
		$this->jumlah_dibayar->setDbValue($row['jumlah_dibayar']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['pegawai'] = $this->pegawai->CurrentValue;
		$row['nama'] = $this->nama->CurrentValue;
		$row['tgl'] = $this->tgl->CurrentValue;
		$row['total_pengajuan'] = $this->total_pengajuan->CurrentValue;
		$row['tgl_pengajuan'] = $this->tgl_pengajuan->CurrentValue;
		$row['jenis'] = $this->jenis->CurrentValue;
		$row['keterangan'] = $this->keterangan->CurrentValue;
		$row['rek_tujuan'] = $this->rek_tujuan->CurrentValue;
		$row['bukti1'] = $this->bukti1->CurrentValue;
		$row['bukti2'] = $this->bukti2->CurrentValue;
		$row['bukti3'] = $this->bukti3->CurrentValue;
		$row['bukti4'] = $this->bukti4->CurrentValue;
		$row['disetujui'] = $this->disetujui->CurrentValue;
		$row['pembayar'] = $this->pembayar->CurrentValue;
		$row['terbayar'] = $this->terbayar->CurrentValue;
		$row['tgl_pembayaran'] = $this->tgl_pembayaran->CurrentValue;
		$row['jumlah_dibayar'] = $this->jumlah_dibayar->CurrentValue;
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

		if ($this->RowType == ROWTYPE_VIEW) { // View row

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
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// pegawai
			$this->pegawai->EditAttrs["class"] = "form-control";
			$this->pegawai->EditCustomAttributes = "";
			$this->pegawai->EditValue = HtmlEncode($this->pegawai->CurrentValue);
			$curVal = strval($this->pegawai->CurrentValue);
			if ($curVal != "") {
				$this->pegawai->EditValue = $this->pegawai->lookupCacheOption($curVal);
				if ($this->pegawai->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->pegawai->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->pegawai->EditValue = $this->pegawai->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->pegawai->EditValue = HtmlEncode($this->pegawai->CurrentValue);
					}
				}
			} else {
				$this->pegawai->EditValue = NULL;
			}
			$this->pegawai->PlaceHolder = RemoveHtml($this->pegawai->caption());

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
			$this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// tgl
			// total_pengajuan

			$this->total_pengajuan->EditAttrs["class"] = "form-control";
			$this->total_pengajuan->EditCustomAttributes = "";
			$this->total_pengajuan->EditValue = HtmlEncode($this->total_pengajuan->CurrentValue);
			$this->total_pengajuan->PlaceHolder = RemoveHtml($this->total_pengajuan->caption());

			// tgl_pengajuan
			$this->tgl_pengajuan->EditAttrs["class"] = "form-control";
			$this->tgl_pengajuan->EditCustomAttributes = "";
			$this->tgl_pengajuan->EditValue = HtmlEncode(FormatDateTime($this->tgl_pengajuan->CurrentValue, 8));
			$this->tgl_pengajuan->PlaceHolder = RemoveHtml($this->tgl_pengajuan->caption());

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
			$this->keterangan->EditValue = HtmlEncode($this->keterangan->CurrentValue);
			$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

			// rek_tujuan
			$this->rek_tujuan->EditAttrs["class"] = "form-control";
			$this->rek_tujuan->EditCustomAttributes = "";
			if (!$this->rek_tujuan->Raw)
				$this->rek_tujuan->CurrentValue = HtmlDecode($this->rek_tujuan->CurrentValue);
			$this->rek_tujuan->EditValue = HtmlEncode($this->rek_tujuan->CurrentValue);
			$this->rek_tujuan->PlaceHolder = RemoveHtml($this->rek_tujuan->caption());

			// bukti1
			$this->bukti1->EditAttrs["class"] = "form-control";
			$this->bukti1->EditCustomAttributes = "";
			if (!$this->bukti1->Raw)
				$this->bukti1->CurrentValue = HtmlDecode($this->bukti1->CurrentValue);
			$this->bukti1->EditValue = HtmlEncode($this->bukti1->CurrentValue);
			$this->bukti1->PlaceHolder = RemoveHtml($this->bukti1->caption());

			// bukti2
			$this->bukti2->EditAttrs["class"] = "form-control";
			$this->bukti2->EditCustomAttributes = "";
			if (!$this->bukti2->Raw)
				$this->bukti2->CurrentValue = HtmlDecode($this->bukti2->CurrentValue);
			$this->bukti2->EditValue = HtmlEncode($this->bukti2->CurrentValue);
			$this->bukti2->PlaceHolder = RemoveHtml($this->bukti2->caption());

			// bukti3
			$this->bukti3->EditAttrs["class"] = "form-control";
			$this->bukti3->EditCustomAttributes = "";
			if (!$this->bukti3->Raw)
				$this->bukti3->CurrentValue = HtmlDecode($this->bukti3->CurrentValue);
			$this->bukti3->EditValue = HtmlEncode($this->bukti3->CurrentValue);
			$this->bukti3->PlaceHolder = RemoveHtml($this->bukti3->caption());

			// bukti4
			$this->bukti4->EditAttrs["class"] = "form-control";
			$this->bukti4->EditCustomAttributes = "";
			if (!$this->bukti4->Raw)
				$this->bukti4->CurrentValue = HtmlDecode($this->bukti4->CurrentValue);
			$this->bukti4->EditValue = HtmlEncode($this->bukti4->CurrentValue);
			$this->bukti4->PlaceHolder = RemoveHtml($this->bukti4->caption());

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

			// pembayar
			$this->pembayar->EditAttrs["class"] = "form-control";
			$this->pembayar->EditCustomAttributes = "";
			if (!$this->pembayar->Raw)
				$this->pembayar->CurrentValue = HtmlDecode($this->pembayar->CurrentValue);
			$this->pembayar->EditValue = HtmlEncode($this->pembayar->CurrentValue);
			$this->pembayar->PlaceHolder = RemoveHtml($this->pembayar->caption());

			// terbayar
			$this->terbayar->EditAttrs["class"] = "form-control";
			$this->terbayar->EditCustomAttributes = "";
			$curVal = trim(strval($this->terbayar->CurrentValue));
			if ($curVal != "")
				$this->terbayar->ViewValue = $this->terbayar->lookupCacheOption($curVal);
			else
				$this->terbayar->ViewValue = $this->terbayar->Lookup !== NULL && is_array($this->terbayar->Lookup->Options) ? $curVal : NULL;
			if ($this->terbayar->ViewValue !== NULL) { // Load from cache
				$this->terbayar->EditValue = array_values($this->terbayar->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`name`" . SearchString("=", $this->terbayar->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->terbayar->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->terbayar->EditValue = $arwrk;
			}

			// tgl_pembayaran
			$this->tgl_pembayaran->EditAttrs["class"] = "form-control";
			$this->tgl_pembayaran->EditCustomAttributes = "";
			$this->tgl_pembayaran->EditValue = HtmlEncode(FormatDateTime($this->tgl_pembayaran->CurrentValue, 8));
			$this->tgl_pembayaran->PlaceHolder = RemoveHtml($this->tgl_pembayaran->caption());

			// jumlah_dibayar
			$this->jumlah_dibayar->EditAttrs["class"] = "form-control";
			$this->jumlah_dibayar->EditCustomAttributes = "";
			$this->jumlah_dibayar->EditValue = HtmlEncode($this->jumlah_dibayar->CurrentValue);
			$this->jumlah_dibayar->PlaceHolder = RemoveHtml($this->jumlah_dibayar->caption());

			// Add refer script
			// pegawai

			$this->pegawai->LinkCustomAttributes = "";
			$this->pegawai->HrefValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";

			// tgl
			$this->tgl->LinkCustomAttributes = "";
			$this->tgl->HrefValue = "";

			// total_pengajuan
			$this->total_pengajuan->LinkCustomAttributes = "";
			$this->total_pengajuan->HrefValue = "";

			// tgl_pengajuan
			$this->tgl_pengajuan->LinkCustomAttributes = "";
			$this->tgl_pengajuan->HrefValue = "";

			// jenis
			$this->jenis->LinkCustomAttributes = "";
			$this->jenis->HrefValue = "";

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";

			// rek_tujuan
			$this->rek_tujuan->LinkCustomAttributes = "";
			$this->rek_tujuan->HrefValue = "";

			// bukti1
			$this->bukti1->LinkCustomAttributes = "";
			$this->bukti1->HrefValue = "";

			// bukti2
			$this->bukti2->LinkCustomAttributes = "";
			$this->bukti2->HrefValue = "";

			// bukti3
			$this->bukti3->LinkCustomAttributes = "";
			$this->bukti3->HrefValue = "";

			// bukti4
			$this->bukti4->LinkCustomAttributes = "";
			$this->bukti4->HrefValue = "";

			// disetujui
			$this->disetujui->LinkCustomAttributes = "";
			$this->disetujui->HrefValue = "";

			// pembayar
			$this->pembayar->LinkCustomAttributes = "";
			$this->pembayar->HrefValue = "";

			// terbayar
			$this->terbayar->LinkCustomAttributes = "";
			$this->terbayar->HrefValue = "";

			// tgl_pembayaran
			$this->tgl_pembayaran->LinkCustomAttributes = "";
			$this->tgl_pembayaran->HrefValue = "";

			// jumlah_dibayar
			$this->jumlah_dibayar->LinkCustomAttributes = "";
			$this->jumlah_dibayar->HrefValue = "";
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
		if ($this->nama->Required) {
			if (!$this->nama->IsDetailKey && $this->nama->FormValue != NULL && $this->nama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
			}
		}
		if ($this->tgl->Required) {
			if (!$this->tgl->IsDetailKey && $this->tgl->FormValue != NULL && $this->tgl->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl->caption(), $this->tgl->RequiredErrorMessage));
			}
		}
		if ($this->total_pengajuan->Required) {
			if (!$this->total_pengajuan->IsDetailKey && $this->total_pengajuan->FormValue != NULL && $this->total_pengajuan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->total_pengajuan->caption(), $this->total_pengajuan->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->total_pengajuan->FormValue)) {
			AddMessage($FormError, $this->total_pengajuan->errorMessage());
		}
		if ($this->tgl_pengajuan->Required) {
			if (!$this->tgl_pengajuan->IsDetailKey && $this->tgl_pengajuan->FormValue != NULL && $this->tgl_pengajuan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_pengajuan->caption(), $this->tgl_pengajuan->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_pengajuan->FormValue)) {
			AddMessage($FormError, $this->tgl_pengajuan->errorMessage());
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
		if ($this->rek_tujuan->Required) {
			if (!$this->rek_tujuan->IsDetailKey && $this->rek_tujuan->FormValue != NULL && $this->rek_tujuan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->rek_tujuan->caption(), $this->rek_tujuan->RequiredErrorMessage));
			}
		}
		if ($this->bukti1->Required) {
			if (!$this->bukti1->IsDetailKey && $this->bukti1->FormValue != NULL && $this->bukti1->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->bukti1->caption(), $this->bukti1->RequiredErrorMessage));
			}
		}
		if ($this->bukti2->Required) {
			if (!$this->bukti2->IsDetailKey && $this->bukti2->FormValue != NULL && $this->bukti2->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->bukti2->caption(), $this->bukti2->RequiredErrorMessage));
			}
		}
		if ($this->bukti3->Required) {
			if (!$this->bukti3->IsDetailKey && $this->bukti3->FormValue != NULL && $this->bukti3->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->bukti3->caption(), $this->bukti3->RequiredErrorMessage));
			}
		}
		if ($this->bukti4->Required) {
			if (!$this->bukti4->IsDetailKey && $this->bukti4->FormValue != NULL && $this->bukti4->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->bukti4->caption(), $this->bukti4->RequiredErrorMessage));
			}
		}
		if ($this->disetujui->Required) {
			if ($this->disetujui->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->disetujui->caption(), $this->disetujui->RequiredErrorMessage));
			}
		}
		if ($this->pembayar->Required) {
			if (!$this->pembayar->IsDetailKey && $this->pembayar->FormValue != NULL && $this->pembayar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pembayar->caption(), $this->pembayar->RequiredErrorMessage));
			}
		}
		if ($this->terbayar->Required) {
			if (!$this->terbayar->IsDetailKey && $this->terbayar->FormValue != NULL && $this->terbayar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->terbayar->caption(), $this->terbayar->RequiredErrorMessage));
			}
		}
		if ($this->tgl_pembayaran->Required) {
			if (!$this->tgl_pembayaran->IsDetailKey && $this->tgl_pembayaran->FormValue != NULL && $this->tgl_pembayaran->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_pembayaran->caption(), $this->tgl_pembayaran->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_pembayaran->FormValue)) {
			AddMessage($FormError, $this->tgl_pembayaran->errorMessage());
		}
		if ($this->jumlah_dibayar->Required) {
			if (!$this->jumlah_dibayar->IsDetailKey && $this->jumlah_dibayar->FormValue != NULL && $this->jumlah_dibayar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jumlah_dibayar->caption(), $this->jumlah_dibayar->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jumlah_dibayar->FormValue)) {
			AddMessage($FormError, $this->jumlah_dibayar->errorMessage());
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

		// nama
		$this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, NULL, FALSE);

		// tgl
		$this->tgl->CurrentValue = CurrentDateTime();
		$this->tgl->setDbValueDef($rsnew, $this->tgl->CurrentValue, NULL);

		// total_pengajuan
		$this->total_pengajuan->setDbValueDef($rsnew, $this->total_pengajuan->CurrentValue, NULL, FALSE);

		// tgl_pengajuan
		$this->tgl_pengajuan->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_pengajuan->CurrentValue, 0), NULL, FALSE);

		// jenis
		$this->jenis->setDbValueDef($rsnew, $this->jenis->CurrentValue, NULL, FALSE);

		// keterangan
		$this->keterangan->setDbValueDef($rsnew, $this->keterangan->CurrentValue, NULL, FALSE);

		// rek_tujuan
		$this->rek_tujuan->setDbValueDef($rsnew, $this->rek_tujuan->CurrentValue, NULL, FALSE);

		// bukti1
		$this->bukti1->setDbValueDef($rsnew, $this->bukti1->CurrentValue, NULL, FALSE);

		// bukti2
		$this->bukti2->setDbValueDef($rsnew, $this->bukti2->CurrentValue, NULL, FALSE);

		// bukti3
		$this->bukti3->setDbValueDef($rsnew, $this->bukti3->CurrentValue, NULL, FALSE);

		// bukti4
		$this->bukti4->setDbValueDef($rsnew, $this->bukti4->CurrentValue, NULL, FALSE);

		// disetujui
		$this->disetujui->setDbValueDef($rsnew, $this->disetujui->CurrentValue, NULL, FALSE);

		// pembayar
		$this->pembayar->setDbValueDef($rsnew, $this->pembayar->CurrentValue, NULL, FALSE);

		// terbayar
		$this->terbayar->setDbValueDef($rsnew, $this->terbayar->CurrentValue, NULL, FALSE);

		// tgl_pembayaran
		$this->tgl_pembayaran->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_pembayaran->CurrentValue, 0), NULL, FALSE);

		// jumlah_dibayar
		$this->jumlah_dibayar->setDbValueDef($rsnew, $this->jumlah_dibayar->CurrentValue, NULL, FALSE);

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

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("reimburshlist.php"), "", $this->TableVar, TRUE);
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
				case "x_pegawai":
					break;
				case "x_disetujui":
					break;
				case "x_terbayar":
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
						case "x_disetujui":
							break;
						case "x_terbayar":
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