<?php
namespace PHPMaker2020\sigap;

/**
 * Page class
 */
class pegawai_add extends pegawai
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}";

	// Table name
	public $TableName = 'pegawai';

	// Page object name
	public $PageObjName = "pegawai_add";

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

		// Table object (pegawai)
		if (!isset($GLOBALS["pegawai"]) || get_class($GLOBALS["pegawai"]) == PROJECT_NAMESPACE . "pegawai") {
			$GLOBALS["pegawai"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["pegawai"];
		}

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'pegawai');

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
		global $pegawai;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($pegawai);
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
					if ($pageName == "pegawaiview.php")
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
					$this->terminate(GetUrl("pegawailist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->Visible = FALSE;
		$this->pid->setVisibility();
		$this->nip->setVisibility();
		$this->username->setVisibility();
		$this->password->setVisibility();
		$this->jenjang_id->setVisibility();
		$this->jabatan->setVisibility();
		$this->periode_jabatan->setVisibility();
		$this->type->setVisibility();
		$this->sertif->setVisibility();
		$this->tambahan->setVisibility();
		$this->lama_kerja->setVisibility();
		$this->nama->setVisibility();
		$this->alamat->setVisibility();
		$this->_email->setVisibility();
		$this->wa->setVisibility();
		$this->hp->setVisibility();
		$this->tgllahir->setVisibility();
		$this->rekbank->setVisibility();
		$this->pendidikan->setVisibility();
		$this->jurusan->setVisibility();
		$this->agama->setVisibility();
		$this->jenkel->setVisibility();
		$this->status->setVisibility();
		$this->foto->setVisibility();
		$this->file_cv->setVisibility();
		$this->mulai_bekerja->setVisibility();
		$this->keterangan->setVisibility();
		$this->level->setVisibility();
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
		$this->setupLookupOptions($this->jenjang_id);
		$this->setupLookupOptions($this->jabatan);
		$this->setupLookupOptions($this->type);
		$this->setupLookupOptions($this->sertif);
		$this->setupLookupOptions($this->tambahan);
		$this->setupLookupOptions($this->pendidikan);
		$this->setupLookupOptions($this->agama);
		$this->setupLookupOptions($this->jenkel);
		$this->setupLookupOptions($this->level);

		// Check permission
		if (!$Security->canAdd()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("pegawailist.php");
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
					$this->terminate("pegawailist.php"); // No matching record, return to list
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
					if (GetPageName($returnUrl) == "pegawailist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "pegawaiview.php")
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
		$this->foto->Upload->Index = $CurrentForm->Index;
		$this->foto->Upload->uploadFile();
		$this->foto->CurrentValue = $this->foto->Upload->FileName;
		$this->file_cv->Upload->Index = $CurrentForm->Index;
		$this->file_cv->Upload->uploadFile();
		$this->file_cv->CurrentValue = $this->file_cv->Upload->FileName;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->pid->CurrentValue = NULL;
		$this->pid->OldValue = $this->pid->CurrentValue;
		$this->nip->CurrentValue = NULL;
		$this->nip->OldValue = $this->nip->CurrentValue;
		$this->username->CurrentValue = NULL;
		$this->username->OldValue = $this->username->CurrentValue;
		$this->password->CurrentValue = NULL;
		$this->password->OldValue = $this->password->CurrentValue;
		$this->jenjang_id->CurrentValue = NULL;
		$this->jenjang_id->OldValue = $this->jenjang_id->CurrentValue;
		$this->jabatan->CurrentValue = NULL;
		$this->jabatan->OldValue = $this->jabatan->CurrentValue;
		$this->periode_jabatan->CurrentValue = NULL;
		$this->periode_jabatan->OldValue = $this->periode_jabatan->CurrentValue;
		$this->type->CurrentValue = NULL;
		$this->type->OldValue = $this->type->CurrentValue;
		$this->sertif->CurrentValue = NULL;
		$this->sertif->OldValue = $this->sertif->CurrentValue;
		$this->tambahan->CurrentValue = NULL;
		$this->tambahan->OldValue = $this->tambahan->CurrentValue;
		$this->lama_kerja->CurrentValue = NULL;
		$this->lama_kerja->OldValue = $this->lama_kerja->CurrentValue;
		$this->nama->CurrentValue = NULL;
		$this->nama->OldValue = $this->nama->CurrentValue;
		$this->alamat->CurrentValue = NULL;
		$this->alamat->OldValue = $this->alamat->CurrentValue;
		$this->_email->CurrentValue = NULL;
		$this->_email->OldValue = $this->_email->CurrentValue;
		$this->wa->CurrentValue = NULL;
		$this->wa->OldValue = $this->wa->CurrentValue;
		$this->hp->CurrentValue = NULL;
		$this->hp->OldValue = $this->hp->CurrentValue;
		$this->tgllahir->CurrentValue = NULL;
		$this->tgllahir->OldValue = $this->tgllahir->CurrentValue;
		$this->rekbank->CurrentValue = NULL;
		$this->rekbank->OldValue = $this->rekbank->CurrentValue;
		$this->pendidikan->CurrentValue = NULL;
		$this->pendidikan->OldValue = $this->pendidikan->CurrentValue;
		$this->jurusan->CurrentValue = NULL;
		$this->jurusan->OldValue = $this->jurusan->CurrentValue;
		$this->agama->CurrentValue = NULL;
		$this->agama->OldValue = $this->agama->CurrentValue;
		$this->jenkel->CurrentValue = NULL;
		$this->jenkel->OldValue = $this->jenkel->CurrentValue;
		$this->status->CurrentValue = NULL;
		$this->status->OldValue = $this->status->CurrentValue;
		$this->foto->Upload->DbValue = NULL;
		$this->foto->OldValue = $this->foto->Upload->DbValue;
		$this->foto->CurrentValue = NULL; // Clear file related field
		$this->file_cv->Upload->DbValue = NULL;
		$this->file_cv->OldValue = $this->file_cv->Upload->DbValue;
		$this->file_cv->CurrentValue = NULL; // Clear file related field
		$this->mulai_bekerja->CurrentValue = NULL;
		$this->mulai_bekerja->OldValue = $this->mulai_bekerja->CurrentValue;
		$this->keterangan->CurrentValue = NULL;
		$this->keterangan->OldValue = $this->keterangan->CurrentValue;
		$this->level->CurrentValue = 1;
		$this->aktif->CurrentValue = 1;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'pid' first before field var 'x_pid'
		$val = $CurrentForm->hasValue("pid") ? $CurrentForm->getValue("pid") : $CurrentForm->getValue("x_pid");
		if (!$this->pid->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pid->Visible = FALSE; // Disable update for API request
			else
				$this->pid->setFormValue($val);
		}

		// Check field name 'nip' first before field var 'x_nip'
		$val = $CurrentForm->hasValue("nip") ? $CurrentForm->getValue("nip") : $CurrentForm->getValue("x_nip");
		if (!$this->nip->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nip->Visible = FALSE; // Disable update for API request
			else
				$this->nip->setFormValue($val);
		}

		// Check field name 'username' first before field var 'x_username'
		$val = $CurrentForm->hasValue("username") ? $CurrentForm->getValue("username") : $CurrentForm->getValue("x_username");
		if (!$this->username->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->username->Visible = FALSE; // Disable update for API request
			else
				$this->username->setFormValue($val);
		}

		// Check field name 'password' first before field var 'x_password'
		$val = $CurrentForm->hasValue("password") ? $CurrentForm->getValue("password") : $CurrentForm->getValue("x_password");
		if (!$this->password->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->password->Visible = FALSE; // Disable update for API request
			else
				if (Config("ENCRYPTED_PASSWORD")) // Encrypted password, use raw value
					$this->password->setRawFormValue($val);
				else
					$this->password->setFormValue($val);
		}

		// Check field name 'jenjang_id' first before field var 'x_jenjang_id'
		$val = $CurrentForm->hasValue("jenjang_id") ? $CurrentForm->getValue("jenjang_id") : $CurrentForm->getValue("x_jenjang_id");
		if (!$this->jenjang_id->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jenjang_id->Visible = FALSE; // Disable update for API request
			else
				$this->jenjang_id->setFormValue($val);
		}

		// Check field name 'jabatan' first before field var 'x_jabatan'
		$val = $CurrentForm->hasValue("jabatan") ? $CurrentForm->getValue("jabatan") : $CurrentForm->getValue("x_jabatan");
		if (!$this->jabatan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jabatan->Visible = FALSE; // Disable update for API request
			else
				$this->jabatan->setFormValue($val);
		}

		// Check field name 'periode_jabatan' first before field var 'x_periode_jabatan'
		$val = $CurrentForm->hasValue("periode_jabatan") ? $CurrentForm->getValue("periode_jabatan") : $CurrentForm->getValue("x_periode_jabatan");
		if (!$this->periode_jabatan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->periode_jabatan->Visible = FALSE; // Disable update for API request
			else
				$this->periode_jabatan->setFormValue($val);
		}

		// Check field name 'type' first before field var 'x_type'
		$val = $CurrentForm->hasValue("type") ? $CurrentForm->getValue("type") : $CurrentForm->getValue("x_type");
		if (!$this->type->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->type->Visible = FALSE; // Disable update for API request
			else
				$this->type->setFormValue($val);
		}

		// Check field name 'sertif' first before field var 'x_sertif'
		$val = $CurrentForm->hasValue("sertif") ? $CurrentForm->getValue("sertif") : $CurrentForm->getValue("x_sertif");
		if (!$this->sertif->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->sertif->Visible = FALSE; // Disable update for API request
			else
				$this->sertif->setFormValue($val);
		}

		// Check field name 'tambahan' first before field var 'x_tambahan'
		$val = $CurrentForm->hasValue("tambahan") ? $CurrentForm->getValue("tambahan") : $CurrentForm->getValue("x_tambahan");
		if (!$this->tambahan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tambahan->Visible = FALSE; // Disable update for API request
			else
				$this->tambahan->setFormValue($val);
		}

		// Check field name 'lama_kerja' first before field var 'x_lama_kerja'
		$val = $CurrentForm->hasValue("lama_kerja") ? $CurrentForm->getValue("lama_kerja") : $CurrentForm->getValue("x_lama_kerja");
		if (!$this->lama_kerja->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->lama_kerja->Visible = FALSE; // Disable update for API request
			else
				$this->lama_kerja->setFormValue($val);
		}

		// Check field name 'nama' first before field var 'x_nama'
		$val = $CurrentForm->hasValue("nama") ? $CurrentForm->getValue("nama") : $CurrentForm->getValue("x_nama");
		if (!$this->nama->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nama->Visible = FALSE; // Disable update for API request
			else
				$this->nama->setFormValue($val);
		}

		// Check field name 'alamat' first before field var 'x_alamat'
		$val = $CurrentForm->hasValue("alamat") ? $CurrentForm->getValue("alamat") : $CurrentForm->getValue("x_alamat");
		if (!$this->alamat->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->alamat->Visible = FALSE; // Disable update for API request
			else
				$this->alamat->setFormValue($val);
		}

		// Check field name 'email' first before field var 'x__email'
		$val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
		if (!$this->_email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_email->Visible = FALSE; // Disable update for API request
			else
				$this->_email->setFormValue($val);
		}

		// Check field name 'wa' first before field var 'x_wa'
		$val = $CurrentForm->hasValue("wa") ? $CurrentForm->getValue("wa") : $CurrentForm->getValue("x_wa");
		if (!$this->wa->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->wa->Visible = FALSE; // Disable update for API request
			else
				$this->wa->setFormValue($val);
		}

		// Check field name 'hp' first before field var 'x_hp'
		$val = $CurrentForm->hasValue("hp") ? $CurrentForm->getValue("hp") : $CurrentForm->getValue("x_hp");
		if (!$this->hp->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->hp->Visible = FALSE; // Disable update for API request
			else
				$this->hp->setFormValue($val);
		}

		// Check field name 'tgllahir' first before field var 'x_tgllahir'
		$val = $CurrentForm->hasValue("tgllahir") ? $CurrentForm->getValue("tgllahir") : $CurrentForm->getValue("x_tgllahir");
		if (!$this->tgllahir->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgllahir->Visible = FALSE; // Disable update for API request
			else
				$this->tgllahir->setFormValue($val);
			$this->tgllahir->CurrentValue = UnFormatDateTime($this->tgllahir->CurrentValue, 0);
		}

		// Check field name 'rekbank' first before field var 'x_rekbank'
		$val = $CurrentForm->hasValue("rekbank") ? $CurrentForm->getValue("rekbank") : $CurrentForm->getValue("x_rekbank");
		if (!$this->rekbank->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->rekbank->Visible = FALSE; // Disable update for API request
			else
				$this->rekbank->setFormValue($val);
		}

		// Check field name 'pendidikan' first before field var 'x_pendidikan'
		$val = $CurrentForm->hasValue("pendidikan") ? $CurrentForm->getValue("pendidikan") : $CurrentForm->getValue("x_pendidikan");
		if (!$this->pendidikan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pendidikan->Visible = FALSE; // Disable update for API request
			else
				$this->pendidikan->setFormValue($val);
		}

		// Check field name 'jurusan' first before field var 'x_jurusan'
		$val = $CurrentForm->hasValue("jurusan") ? $CurrentForm->getValue("jurusan") : $CurrentForm->getValue("x_jurusan");
		if (!$this->jurusan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jurusan->Visible = FALSE; // Disable update for API request
			else
				$this->jurusan->setFormValue($val);
		}

		// Check field name 'agama' first before field var 'x_agama'
		$val = $CurrentForm->hasValue("agama") ? $CurrentForm->getValue("agama") : $CurrentForm->getValue("x_agama");
		if (!$this->agama->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->agama->Visible = FALSE; // Disable update for API request
			else
				$this->agama->setFormValue($val);
		}

		// Check field name 'jenkel' first before field var 'x_jenkel'
		$val = $CurrentForm->hasValue("jenkel") ? $CurrentForm->getValue("jenkel") : $CurrentForm->getValue("x_jenkel");
		if (!$this->jenkel->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jenkel->Visible = FALSE; // Disable update for API request
			else
				$this->jenkel->setFormValue($val);
		}

		// Check field name 'status' first before field var 'x_status'
		$val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
		if (!$this->status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->status->Visible = FALSE; // Disable update for API request
			else
				$this->status->setFormValue($val);
		}

		// Check field name 'mulai_bekerja' first before field var 'x_mulai_bekerja'
		$val = $CurrentForm->hasValue("mulai_bekerja") ? $CurrentForm->getValue("mulai_bekerja") : $CurrentForm->getValue("x_mulai_bekerja");
		if (!$this->mulai_bekerja->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->mulai_bekerja->Visible = FALSE; // Disable update for API request
			else
				$this->mulai_bekerja->setFormValue($val);
			$this->mulai_bekerja->CurrentValue = UnFormatDateTime($this->mulai_bekerja->CurrentValue, 0);
		}

		// Check field name 'keterangan' first before field var 'x_keterangan'
		$val = $CurrentForm->hasValue("keterangan") ? $CurrentForm->getValue("keterangan") : $CurrentForm->getValue("x_keterangan");
		if (!$this->keterangan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keterangan->Visible = FALSE; // Disable update for API request
			else
				$this->keterangan->setFormValue($val);
		}

		// Check field name 'level' first before field var 'x_level'
		$val = $CurrentForm->hasValue("level") ? $CurrentForm->getValue("level") : $CurrentForm->getValue("x_level");
		if (!$this->level->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->level->Visible = FALSE; // Disable update for API request
			else
				$this->level->setFormValue($val);
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
		$this->pid->CurrentValue = $this->pid->FormValue;
		$this->nip->CurrentValue = $this->nip->FormValue;
		$this->username->CurrentValue = $this->username->FormValue;
		$this->password->CurrentValue = $this->password->FormValue;
		$this->jenjang_id->CurrentValue = $this->jenjang_id->FormValue;
		$this->jabatan->CurrentValue = $this->jabatan->FormValue;
		$this->periode_jabatan->CurrentValue = $this->periode_jabatan->FormValue;
		$this->type->CurrentValue = $this->type->FormValue;
		$this->sertif->CurrentValue = $this->sertif->FormValue;
		$this->tambahan->CurrentValue = $this->tambahan->FormValue;
		$this->lama_kerja->CurrentValue = $this->lama_kerja->FormValue;
		$this->nama->CurrentValue = $this->nama->FormValue;
		$this->alamat->CurrentValue = $this->alamat->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->wa->CurrentValue = $this->wa->FormValue;
		$this->hp->CurrentValue = $this->hp->FormValue;
		$this->tgllahir->CurrentValue = $this->tgllahir->FormValue;
		$this->tgllahir->CurrentValue = UnFormatDateTime($this->tgllahir->CurrentValue, 0);
		$this->rekbank->CurrentValue = $this->rekbank->FormValue;
		$this->pendidikan->CurrentValue = $this->pendidikan->FormValue;
		$this->jurusan->CurrentValue = $this->jurusan->FormValue;
		$this->agama->CurrentValue = $this->agama->FormValue;
		$this->jenkel->CurrentValue = $this->jenkel->FormValue;
		$this->status->CurrentValue = $this->status->FormValue;
		$this->mulai_bekerja->CurrentValue = $this->mulai_bekerja->FormValue;
		$this->mulai_bekerja->CurrentValue = UnFormatDateTime($this->mulai_bekerja->CurrentValue, 0);
		$this->keterangan->CurrentValue = $this->keterangan->FormValue;
		$this->level->CurrentValue = $this->level->FormValue;
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
		$this->pid->setDbValue($row['pid']);
		$this->nip->setDbValue($row['nip']);
		$this->username->setDbValue($row['username']);
		$this->password->setDbValue($row['password']);
		$this->jenjang_id->setDbValue($row['jenjang_id']);
		$this->jabatan->setDbValue($row['jabatan']);
		$this->periode_jabatan->setDbValue($row['periode_jabatan']);
		$this->type->setDbValue($row['type']);
		$this->sertif->setDbValue($row['sertif']);
		$this->tambahan->setDbValue($row['tambahan']);
		$this->lama_kerja->setDbValue($row['lama_kerja']);
		$this->nama->setDbValue($row['nama']);
		$this->alamat->setDbValue($row['alamat']);
		$this->_email->setDbValue($row['email']);
		$this->wa->setDbValue($row['wa']);
		$this->hp->setDbValue($row['hp']);
		$this->tgllahir->setDbValue($row['tgllahir']);
		$this->rekbank->setDbValue($row['rekbank']);
		$this->pendidikan->setDbValue($row['pendidikan']);
		$this->jurusan->setDbValue($row['jurusan']);
		$this->agama->setDbValue($row['agama']);
		$this->jenkel->setDbValue($row['jenkel']);
		$this->status->setDbValue($row['status']);
		$this->foto->Upload->DbValue = $row['foto'];
		$this->foto->setDbValue($this->foto->Upload->DbValue);
		$this->file_cv->Upload->DbValue = $row['file_cv'];
		$this->file_cv->setDbValue($this->file_cv->Upload->DbValue);
		$this->mulai_bekerja->setDbValue($row['mulai_bekerja']);
		$this->keterangan->setDbValue($row['keterangan']);
		$this->level->setDbValue($row['level']);
		$this->aktif->setDbValue($row['aktif']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id'] = $this->id->CurrentValue;
		$row['pid'] = $this->pid->CurrentValue;
		$row['nip'] = $this->nip->CurrentValue;
		$row['username'] = $this->username->CurrentValue;
		$row['password'] = $this->password->CurrentValue;
		$row['jenjang_id'] = $this->jenjang_id->CurrentValue;
		$row['jabatan'] = $this->jabatan->CurrentValue;
		$row['periode_jabatan'] = $this->periode_jabatan->CurrentValue;
		$row['type'] = $this->type->CurrentValue;
		$row['sertif'] = $this->sertif->CurrentValue;
		$row['tambahan'] = $this->tambahan->CurrentValue;
		$row['lama_kerja'] = $this->lama_kerja->CurrentValue;
		$row['nama'] = $this->nama->CurrentValue;
		$row['alamat'] = $this->alamat->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		$row['wa'] = $this->wa->CurrentValue;
		$row['hp'] = $this->hp->CurrentValue;
		$row['tgllahir'] = $this->tgllahir->CurrentValue;
		$row['rekbank'] = $this->rekbank->CurrentValue;
		$row['pendidikan'] = $this->pendidikan->CurrentValue;
		$row['jurusan'] = $this->jurusan->CurrentValue;
		$row['agama'] = $this->agama->CurrentValue;
		$row['jenkel'] = $this->jenkel->CurrentValue;
		$row['status'] = $this->status->CurrentValue;
		$row['foto'] = $this->foto->Upload->DbValue;
		$row['file_cv'] = $this->file_cv->Upload->DbValue;
		$row['mulai_bekerja'] = $this->mulai_bekerja->CurrentValue;
		$row['keterangan'] = $this->keterangan->CurrentValue;
		$row['level'] = $this->level->CurrentValue;
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
		// pid
		// nip
		// username
		// password
		// jenjang_id
		// jabatan
		// periode_jabatan
		// type
		// sertif
		// tambahan
		// lama_kerja
		// nama
		// alamat
		// email
		// wa
		// hp
		// tgllahir
		// rekbank
		// pendidikan
		// jurusan
		// agama
		// jenkel
		// status
		// foto
		// file_cv
		// mulai_bekerja
		// keterangan
		// level
		// aktif

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// pid
			$this->pid->ViewValue = $this->pid->CurrentValue;
			$this->pid->ViewValue = FormatNumber($this->pid->ViewValue, 0, -2, -2, -2);
			$this->pid->ViewCustomAttributes = "";

			// nip
			$this->nip->ViewValue = $this->nip->CurrentValue;
			$this->nip->ViewCustomAttributes = "";

			// username
			$this->username->ViewValue = $this->username->CurrentValue;
			$this->username->ViewCustomAttributes = "";

			// password
			$this->password->ViewValue = $this->password->CurrentValue;
			$this->password->ViewCustomAttributes = "";

			// jenjang_id
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

			// jabatan
			$curVal = strval($this->jabatan->CurrentValue);
			if ($curVal != "") {
				$this->jabatan->ViewValue = $this->jabatan->lookupCacheOption($curVal);
				if ($this->jabatan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->jabatan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->jabatan->ViewValue = $this->jabatan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jabatan->ViewValue = $this->jabatan->CurrentValue;
					}
				}
			} else {
				$this->jabatan->ViewValue = NULL;
			}
			$this->jabatan->ViewCustomAttributes = "";

			// periode_jabatan
			$this->periode_jabatan->ViewValue = $this->periode_jabatan->CurrentValue;
			$this->periode_jabatan->ViewValue = FormatNumber($this->periode_jabatan->ViewValue, 0, -2, -2, -2);
			$this->periode_jabatan->ViewCustomAttributes = "";

			// type
			$this->type->ViewValue = $this->type->CurrentValue;
			$curVal = strval($this->type->CurrentValue);
			if ($curVal != "") {
				$this->type->ViewValue = $this->type->lookupCacheOption($curVal);
				if ($this->type->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->type->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->type->ViewValue = $this->type->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->type->ViewValue = $this->type->CurrentValue;
					}
				}
			} else {
				$this->type->ViewValue = NULL;
			}
			$this->type->ViewCustomAttributes = "";

			// sertif
			$curVal = strval($this->sertif->CurrentValue);
			if ($curVal != "") {
				$this->sertif->ViewValue = $this->sertif->lookupCacheOption($curVal);
				if ($this->sertif->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->sertif->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->sertif->ViewValue = $this->sertif->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->sertif->ViewValue = $this->sertif->CurrentValue;
					}
				}
			} else {
				$this->sertif->ViewValue = NULL;
			}
			$this->sertif->ViewCustomAttributes = "";

			// tambahan
			$curVal = strval($this->tambahan->CurrentValue);
			if ($curVal != "") {
				$this->tambahan->ViewValue = $this->tambahan->lookupCacheOption($curVal);
				if ($this->tambahan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->tambahan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->tambahan->ViewValue = $this->tambahan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->tambahan->ViewValue = $this->tambahan->CurrentValue;
					}
				}
			} else {
				$this->tambahan->ViewValue = NULL;
			}
			$this->tambahan->ViewCustomAttributes = "";

			// lama_kerja
			$this->lama_kerja->ViewValue = $this->lama_kerja->CurrentValue;
			$this->lama_kerja->ViewValue = FormatNumber($this->lama_kerja->ViewValue, 0, -2, -2, -2);
			$this->lama_kerja->ViewCustomAttributes = "";

			// nama
			$this->nama->ViewValue = $this->nama->CurrentValue;
			$this->nama->ViewCustomAttributes = "";

			// alamat
			$this->alamat->ViewValue = $this->alamat->CurrentValue;
			$this->alamat->ViewCustomAttributes = "";

			// email
			$this->_email->ViewValue = $this->_email->CurrentValue;
			$this->_email->ViewCustomAttributes = "";

			// wa
			$this->wa->ViewValue = $this->wa->CurrentValue;
			$this->wa->ViewCustomAttributes = "";

			// hp
			$this->hp->ViewValue = $this->hp->CurrentValue;
			$this->hp->ViewCustomAttributes = "";

			// tgllahir
			$this->tgllahir->ViewValue = $this->tgllahir->CurrentValue;
			$this->tgllahir->ViewValue = FormatDateTime($this->tgllahir->ViewValue, 0);
			$this->tgllahir->ViewCustomAttributes = "";

			// rekbank
			$this->rekbank->ViewValue = $this->rekbank->CurrentValue;
			$this->rekbank->ViewCustomAttributes = "";

			// pendidikan
			$curVal = strval($this->pendidikan->CurrentValue);
			if ($curVal != "") {
				$this->pendidikan->ViewValue = $this->pendidikan->lookupCacheOption($curVal);
				if ($this->pendidikan->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->pendidikan->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->pendidikan->ViewValue = $this->pendidikan->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->pendidikan->ViewValue = $this->pendidikan->CurrentValue;
					}
				}
			} else {
				$this->pendidikan->ViewValue = NULL;
			}
			$this->pendidikan->ViewCustomAttributes = "";

			// jurusan
			$this->jurusan->ViewValue = $this->jurusan->CurrentValue;
			$this->jurusan->ViewCustomAttributes = "";

			// agama
			$curVal = strval($this->agama->CurrentValue);
			if ($curVal != "") {
				$this->agama->ViewValue = $this->agama->lookupCacheOption($curVal);
				if ($this->agama->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`name`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->agama->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->agama->ViewValue = $this->agama->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->agama->ViewValue = $this->agama->CurrentValue;
					}
				}
			} else {
				$this->agama->ViewValue = NULL;
			}
			$this->agama->ViewCustomAttributes = "";

			// jenkel
			$curVal = strval($this->jenkel->CurrentValue);
			if ($curVal != "") {
				$this->jenkel->ViewValue = $this->jenkel->lookupCacheOption($curVal);
				if ($this->jenkel->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`gen`" . SearchString("=", $curVal, DATATYPE_STRING, "");
					$sqlWrk = $this->jenkel->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->jenkel->ViewValue = $this->jenkel->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->jenkel->ViewValue = $this->jenkel->CurrentValue;
					}
				}
			} else {
				$this->jenkel->ViewValue = NULL;
			}
			$this->jenkel->ViewCustomAttributes = "";

			// status
			$this->status->ViewValue = $this->status->CurrentValue;
			$this->status->ViewCustomAttributes = "";

			// foto
			if (!EmptyValue($this->foto->Upload->DbValue)) {
				$this->foto->ViewValue = $this->foto->Upload->DbValue;
			} else {
				$this->foto->ViewValue = "";
			}
			$this->foto->ViewCustomAttributes = "";

			// file_cv
			if (!EmptyValue($this->file_cv->Upload->DbValue)) {
				$this->file_cv->ViewValue = $this->file_cv->Upload->DbValue;
			} else {
				$this->file_cv->ViewValue = "";
			}
			$this->file_cv->ViewCustomAttributes = "";

			// mulai_bekerja
			$this->mulai_bekerja->ViewValue = $this->mulai_bekerja->CurrentValue;
			$this->mulai_bekerja->ViewValue = FormatDateTime($this->mulai_bekerja->ViewValue, 0);
			$this->mulai_bekerja->ViewCustomAttributes = "";

			// keterangan
			$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
			$this->keterangan->ViewCustomAttributes = "";

			// level
			if ($Security->canAdmin()) { // System admin
				$curVal = strval($this->level->CurrentValue);
				if ($curVal != "") {
					$this->level->ViewValue = $this->level->lookupCacheOption($curVal);
					if ($this->level->ViewValue === NULL) { // Lookup from database
						$filterWrk = "`userlevelid`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
						$sqlWrk = $this->level->Lookup->getSql(FALSE, $filterWrk, '', $this);
						$rswrk = Conn()->execute($sqlWrk);
						if ($rswrk && !$rswrk->EOF) { // Lookup values found
							$arwrk = [];
							$arwrk[1] = $rswrk->fields('df');
							$this->level->ViewValue = $this->level->displayValue($arwrk);
							$rswrk->Close();
						} else {
							$this->level->ViewValue = $this->level->CurrentValue;
						}
					}
				} else {
					$this->level->ViewValue = NULL;
				}
			} else {
				$this->level->ViewValue = $Language->phrase("PasswordMask");
			}
			$this->level->ViewCustomAttributes = "";

			// aktif
			$this->aktif->ViewValue = $this->aktif->CurrentValue;
			$this->aktif->ViewValue = FormatNumber($this->aktif->ViewValue, 0, -2, -2, -2);
			$this->aktif->ViewCustomAttributes = "";

			// pid
			$this->pid->LinkCustomAttributes = "";
			$this->pid->HrefValue = "";
			$this->pid->TooltipValue = "";

			// nip
			$this->nip->LinkCustomAttributes = "";
			$this->nip->HrefValue = "";
			$this->nip->TooltipValue = "";

			// username
			$this->username->LinkCustomAttributes = "";
			$this->username->HrefValue = "";
			$this->username->TooltipValue = "";

			// password
			$this->password->LinkCustomAttributes = "";
			$this->password->HrefValue = "";
			$this->password->TooltipValue = "";

			// jenjang_id
			$this->jenjang_id->LinkCustomAttributes = "";
			$this->jenjang_id->HrefValue = "";
			$this->jenjang_id->TooltipValue = "";

			// jabatan
			$this->jabatan->LinkCustomAttributes = "";
			$this->jabatan->HrefValue = "";
			$this->jabatan->TooltipValue = "";

			// periode_jabatan
			$this->periode_jabatan->LinkCustomAttributes = "";
			$this->periode_jabatan->HrefValue = "";
			$this->periode_jabatan->TooltipValue = "";

			// type
			$this->type->LinkCustomAttributes = "";
			$this->type->HrefValue = "";
			$this->type->TooltipValue = "";

			// sertif
			$this->sertif->LinkCustomAttributes = "";
			$this->sertif->HrefValue = "";
			$this->sertif->TooltipValue = "";

			// tambahan
			$this->tambahan->LinkCustomAttributes = "";
			$this->tambahan->HrefValue = "";
			$this->tambahan->TooltipValue = "";

			// lama_kerja
			$this->lama_kerja->LinkCustomAttributes = "";
			$this->lama_kerja->HrefValue = "";
			$this->lama_kerja->TooltipValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";
			$this->nama->TooltipValue = "";

			// alamat
			$this->alamat->LinkCustomAttributes = "";
			$this->alamat->HrefValue = "";
			$this->alamat->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// wa
			$this->wa->LinkCustomAttributes = "";
			$this->wa->HrefValue = "";
			$this->wa->TooltipValue = "";

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";
			$this->hp->TooltipValue = "";

			// tgllahir
			$this->tgllahir->LinkCustomAttributes = "";
			$this->tgllahir->HrefValue = "";
			$this->tgllahir->TooltipValue = "";

			// rekbank
			$this->rekbank->LinkCustomAttributes = "";
			$this->rekbank->HrefValue = "";
			$this->rekbank->TooltipValue = "";

			// pendidikan
			$this->pendidikan->LinkCustomAttributes = "";
			$this->pendidikan->HrefValue = "";
			$this->pendidikan->TooltipValue = "";

			// jurusan
			$this->jurusan->LinkCustomAttributes = "";
			$this->jurusan->HrefValue = "";
			$this->jurusan->TooltipValue = "";

			// agama
			$this->agama->LinkCustomAttributes = "";
			$this->agama->HrefValue = "";
			$this->agama->TooltipValue = "";

			// jenkel
			$this->jenkel->LinkCustomAttributes = "";
			$this->jenkel->HrefValue = "";
			$this->jenkel->TooltipValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";

			// foto
			$this->foto->LinkCustomAttributes = "";
			$this->foto->HrefValue = "";
			$this->foto->ExportHrefValue = $this->foto->UploadPath . $this->foto->Upload->DbValue;
			$this->foto->TooltipValue = "";

			// file_cv
			$this->file_cv->LinkCustomAttributes = "";
			$this->file_cv->HrefValue = "";
			$this->file_cv->ExportHrefValue = $this->file_cv->UploadPath . $this->file_cv->Upload->DbValue;
			$this->file_cv->TooltipValue = "";

			// mulai_bekerja
			$this->mulai_bekerja->LinkCustomAttributes = "";
			$this->mulai_bekerja->HrefValue = "";
			$this->mulai_bekerja->TooltipValue = "";

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";
			$this->keterangan->TooltipValue = "";

			// level
			$this->level->LinkCustomAttributes = "";
			$this->level->HrefValue = "";
			$this->level->TooltipValue = "";

			// aktif
			$this->aktif->LinkCustomAttributes = "";
			$this->aktif->HrefValue = "";
			$this->aktif->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// pid
			$this->pid->EditAttrs["class"] = "form-control";
			$this->pid->EditCustomAttributes = "";
			$this->pid->EditValue = HtmlEncode($this->pid->CurrentValue);
			$this->pid->PlaceHolder = RemoveHtml($this->pid->caption());

			// nip
			$this->nip->EditAttrs["class"] = "form-control";
			$this->nip->EditCustomAttributes = "";
			if (!$this->nip->Raw)
				$this->nip->CurrentValue = HtmlDecode($this->nip->CurrentValue);
			$this->nip->EditValue = HtmlEncode($this->nip->CurrentValue);
			$this->nip->PlaceHolder = RemoveHtml($this->nip->caption());

			// username
			$this->username->EditAttrs["class"] = "form-control";
			$this->username->EditCustomAttributes = "";
			if (!$this->username->Raw)
				$this->username->CurrentValue = HtmlDecode($this->username->CurrentValue);
			$this->username->EditValue = HtmlEncode($this->username->CurrentValue);
			$this->username->PlaceHolder = RemoveHtml($this->username->caption());

			// password
			$this->password->EditAttrs["class"] = "form-control";
			$this->password->EditCustomAttributes = "";
			if (!$this->password->Raw)
				$this->password->CurrentValue = HtmlDecode($this->password->CurrentValue);
			$this->password->EditValue = HtmlEncode($this->password->CurrentValue);
			$this->password->PlaceHolder = RemoveHtml($this->password->caption());

			// jenjang_id
			$this->jenjang_id->EditCustomAttributes = "";
			$curVal = trim(strval($this->jenjang_id->CurrentValue));
			if ($curVal != "")
				$this->jenjang_id->ViewValue = $this->jenjang_id->lookupCacheOption($curVal);
			else
				$this->jenjang_id->ViewValue = $this->jenjang_id->Lookup !== NULL && is_array($this->jenjang_id->Lookup->Options) ? $curVal : NULL;
			if ($this->jenjang_id->ViewValue !== NULL) { // Load from cache
				$this->jenjang_id->EditValue = array_values($this->jenjang_id->Lookup->Options);
				if ($this->jenjang_id->ViewValue == "")
					$this->jenjang_id->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`nourut`" . SearchString("=", $this->jenjang_id->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->jenjang_id->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->jenjang_id->ViewValue = $this->jenjang_id->displayValue($arwrk);
				} else {
					$this->jenjang_id->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->jenjang_id->EditValue = $arwrk;
			}

			// jabatan
			$this->jabatan->EditCustomAttributes = "";
			$curVal = trim(strval($this->jabatan->CurrentValue));
			if ($curVal != "")
				$this->jabatan->ViewValue = $this->jabatan->lookupCacheOption($curVal);
			else
				$this->jabatan->ViewValue = $this->jabatan->Lookup !== NULL && is_array($this->jabatan->Lookup->Options) ? $curVal : NULL;
			if ($this->jabatan->ViewValue !== NULL) { // Load from cache
				$this->jabatan->EditValue = array_values($this->jabatan->Lookup->Options);
				if ($this->jabatan->ViewValue == "")
					$this->jabatan->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->jabatan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->jabatan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->jabatan->ViewValue = $this->jabatan->displayValue($arwrk);
				} else {
					$this->jabatan->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->jabatan->EditValue = $arwrk;
			}

			// periode_jabatan
			$this->periode_jabatan->EditAttrs["class"] = "form-control";
			$this->periode_jabatan->EditCustomAttributes = "";
			$this->periode_jabatan->EditValue = HtmlEncode($this->periode_jabatan->CurrentValue);
			$this->periode_jabatan->PlaceHolder = RemoveHtml($this->periode_jabatan->caption());

			// type
			$this->type->EditAttrs["class"] = "form-control";
			$this->type->EditCustomAttributes = "";
			$this->type->EditValue = HtmlEncode($this->type->CurrentValue);
			$curVal = strval($this->type->CurrentValue);
			if ($curVal != "") {
				$this->type->EditValue = $this->type->lookupCacheOption($curVal);
				if ($this->type->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->type->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->type->EditValue = $this->type->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->type->EditValue = HtmlEncode($this->type->CurrentValue);
					}
				}
			} else {
				$this->type->EditValue = NULL;
			}
			$this->type->PlaceHolder = RemoveHtml($this->type->caption());

			// sertif
			$this->sertif->EditCustomAttributes = "";
			$curVal = trim(strval($this->sertif->CurrentValue));
			if ($curVal != "")
				$this->sertif->ViewValue = $this->sertif->lookupCacheOption($curVal);
			else
				$this->sertif->ViewValue = $this->sertif->Lookup !== NULL && is_array($this->sertif->Lookup->Options) ? $curVal : NULL;
			if ($this->sertif->ViewValue !== NULL) { // Load from cache
				$this->sertif->EditValue = array_values($this->sertif->Lookup->Options);
				if ($this->sertif->ViewValue == "")
					$this->sertif->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->sertif->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->sertif->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->sertif->ViewValue = $this->sertif->displayValue($arwrk);
				} else {
					$this->sertif->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->sertif->EditValue = $arwrk;
			}

			// tambahan
			$this->tambahan->EditCustomAttributes = "";
			$curVal = trim(strval($this->tambahan->CurrentValue));
			if ($curVal != "")
				$this->tambahan->ViewValue = $this->tambahan->lookupCacheOption($curVal);
			else
				$this->tambahan->ViewValue = $this->tambahan->Lookup !== NULL && is_array($this->tambahan->Lookup->Options) ? $curVal : NULL;
			if ($this->tambahan->ViewValue !== NULL) { // Load from cache
				$this->tambahan->EditValue = array_values($this->tambahan->Lookup->Options);
				if ($this->tambahan->ViewValue == "")
					$this->tambahan->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->tambahan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->tambahan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->tambahan->ViewValue = $this->tambahan->displayValue($arwrk);
				} else {
					$this->tambahan->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->tambahan->EditValue = $arwrk;
			}

			// lama_kerja
			$this->lama_kerja->EditAttrs["class"] = "form-control";
			$this->lama_kerja->EditCustomAttributes = "";
			$this->lama_kerja->EditValue = HtmlEncode($this->lama_kerja->CurrentValue);
			$this->lama_kerja->PlaceHolder = RemoveHtml($this->lama_kerja->caption());

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
			$this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// alamat
			$this->alamat->EditAttrs["class"] = "form-control";
			$this->alamat->EditCustomAttributes = "";
			if (!$this->alamat->Raw)
				$this->alamat->CurrentValue = HtmlDecode($this->alamat->CurrentValue);
			$this->alamat->EditValue = HtmlEncode($this->alamat->CurrentValue);
			$this->alamat->PlaceHolder = RemoveHtml($this->alamat->caption());

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			if (!$this->_email->Raw)
				$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
			$this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

			// wa
			$this->wa->EditAttrs["class"] = "form-control";
			$this->wa->EditCustomAttributes = "";
			if (!$this->wa->Raw)
				$this->wa->CurrentValue = HtmlDecode($this->wa->CurrentValue);
			$this->wa->EditValue = HtmlEncode($this->wa->CurrentValue);
			$this->wa->PlaceHolder = RemoveHtml($this->wa->caption());

			// hp
			$this->hp->EditAttrs["class"] = "form-control";
			$this->hp->EditCustomAttributes = "";
			if (!$this->hp->Raw)
				$this->hp->CurrentValue = HtmlDecode($this->hp->CurrentValue);
			$this->hp->EditValue = HtmlEncode($this->hp->CurrentValue);
			$this->hp->PlaceHolder = RemoveHtml($this->hp->caption());

			// tgllahir
			$this->tgllahir->EditAttrs["class"] = "form-control";
			$this->tgllahir->EditCustomAttributes = "";
			$this->tgllahir->EditValue = HtmlEncode(FormatDateTime($this->tgllahir->CurrentValue, 8));
			$this->tgllahir->PlaceHolder = RemoveHtml($this->tgllahir->caption());

			// rekbank
			$this->rekbank->EditAttrs["class"] = "form-control";
			$this->rekbank->EditCustomAttributes = "";
			if (!$this->rekbank->Raw)
				$this->rekbank->CurrentValue = HtmlDecode($this->rekbank->CurrentValue);
			$this->rekbank->EditValue = HtmlEncode($this->rekbank->CurrentValue);
			$this->rekbank->PlaceHolder = RemoveHtml($this->rekbank->caption());

			// pendidikan
			$this->pendidikan->EditCustomAttributes = "";
			$curVal = trim(strval($this->pendidikan->CurrentValue));
			if ($curVal != "")
				$this->pendidikan->ViewValue = $this->pendidikan->lookupCacheOption($curVal);
			else
				$this->pendidikan->ViewValue = $this->pendidikan->Lookup !== NULL && is_array($this->pendidikan->Lookup->Options) ? $curVal : NULL;
			if ($this->pendidikan->ViewValue !== NULL) { // Load from cache
				$this->pendidikan->EditValue = array_values($this->pendidikan->Lookup->Options);
				if ($this->pendidikan->ViewValue == "")
					$this->pendidikan->ViewValue = $Language->phrase("PleaseSelect");
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`id`" . SearchString("=", $this->pendidikan->CurrentValue, DATATYPE_NUMBER, "");
				}
				$sqlWrk = $this->pendidikan->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = [];
					$arwrk[1] = HtmlEncode($rswrk->fields('df'));
					$this->pendidikan->ViewValue = $this->pendidikan->displayValue($arwrk);
				} else {
					$this->pendidikan->ViewValue = $Language->phrase("PleaseSelect");
				}
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->pendidikan->EditValue = $arwrk;
			}

			// jurusan
			$this->jurusan->EditAttrs["class"] = "form-control";
			$this->jurusan->EditCustomAttributes = "";
			if (!$this->jurusan->Raw)
				$this->jurusan->CurrentValue = HtmlDecode($this->jurusan->CurrentValue);
			$this->jurusan->EditValue = HtmlEncode($this->jurusan->CurrentValue);
			$this->jurusan->PlaceHolder = RemoveHtml($this->jurusan->caption());

			// agama
			$this->agama->EditAttrs["class"] = "form-control";
			$this->agama->EditCustomAttributes = "";
			$curVal = trim(strval($this->agama->CurrentValue));
			if ($curVal != "")
				$this->agama->ViewValue = $this->agama->lookupCacheOption($curVal);
			else
				$this->agama->ViewValue = $this->agama->Lookup !== NULL && is_array($this->agama->Lookup->Options) ? $curVal : NULL;
			if ($this->agama->ViewValue !== NULL) { // Load from cache
				$this->agama->EditValue = array_values($this->agama->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`name`" . SearchString("=", $this->agama->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->agama->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->agama->EditValue = $arwrk;
			}

			// jenkel
			$this->jenkel->EditCustomAttributes = "";
			$curVal = trim(strval($this->jenkel->CurrentValue));
			if ($curVal != "")
				$this->jenkel->ViewValue = $this->jenkel->lookupCacheOption($curVal);
			else
				$this->jenkel->ViewValue = $this->jenkel->Lookup !== NULL && is_array($this->jenkel->Lookup->Options) ? $curVal : NULL;
			if ($this->jenkel->ViewValue !== NULL) { // Load from cache
				$this->jenkel->EditValue = array_values($this->jenkel->Lookup->Options);
			} else { // Lookup from database
				if ($curVal == "") {
					$filterWrk = "0=1";
				} else {
					$filterWrk = "`gen`" . SearchString("=", $this->jenkel->CurrentValue, DATATYPE_STRING, "");
				}
				$sqlWrk = $this->jenkel->Lookup->getSql(TRUE, $filterWrk, '', $this);
				$rswrk = Conn()->execute($sqlWrk);
				$arwrk = $rswrk ? $rswrk->getRows() : [];
				if ($rswrk)
					$rswrk->close();
				$this->jenkel->EditValue = $arwrk;
			}

			// status
			$this->status->EditAttrs["class"] = "form-control";
			$this->status->EditCustomAttributes = "";
			if (!$this->status->Raw)
				$this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
			$this->status->EditValue = HtmlEncode($this->status->CurrentValue);
			$this->status->PlaceHolder = RemoveHtml($this->status->caption());

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
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->foto);

			// file_cv
			$this->file_cv->EditAttrs["class"] = "form-control";
			$this->file_cv->EditCustomAttributes = "";
			if (!EmptyValue($this->file_cv->Upload->DbValue)) {
				$this->file_cv->EditValue = $this->file_cv->Upload->DbValue;
			} else {
				$this->file_cv->EditValue = "";
			}
			if (!EmptyValue($this->file_cv->CurrentValue))
					$this->file_cv->Upload->FileName = $this->file_cv->CurrentValue;
			if ($this->isShow() || $this->isCopy())
				RenderUploadField($this->file_cv);

			// mulai_bekerja
			$this->mulai_bekerja->EditAttrs["class"] = "form-control";
			$this->mulai_bekerja->EditCustomAttributes = "";
			$this->mulai_bekerja->EditValue = HtmlEncode(FormatDateTime($this->mulai_bekerja->CurrentValue, 8));
			$this->mulai_bekerja->PlaceHolder = RemoveHtml($this->mulai_bekerja->caption());

			// keterangan
			$this->keterangan->EditAttrs["class"] = "form-control";
			$this->keterangan->EditCustomAttributes = "";
			if (!$this->keterangan->Raw)
				$this->keterangan->CurrentValue = HtmlDecode($this->keterangan->CurrentValue);
			$this->keterangan->EditValue = HtmlEncode($this->keterangan->CurrentValue);
			$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

			// level
			$this->level->EditAttrs["class"] = "form-control";
			$this->level->EditCustomAttributes = "";
			if (!$Security->canAdmin()) { // System admin
				$this->level->EditValue = $Language->phrase("PasswordMask");
			} else {
				$curVal = trim(strval($this->level->CurrentValue));
				if ($curVal != "")
					$this->level->ViewValue = $this->level->lookupCacheOption($curVal);
				else
					$this->level->ViewValue = $this->level->Lookup !== NULL && is_array($this->level->Lookup->Options) ? $curVal : NULL;
				if ($this->level->ViewValue !== NULL) { // Load from cache
					$this->level->EditValue = array_values($this->level->Lookup->Options);
				} else { // Lookup from database
					if ($curVal == "") {
						$filterWrk = "0=1";
					} else {
						$filterWrk = "`userlevelid`" . SearchString("=", $this->level->CurrentValue, DATATYPE_NUMBER, "");
					}
					$sqlWrk = $this->level->Lookup->getSql(TRUE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					$arwrk = $rswrk ? $rswrk->getRows() : [];
					if ($rswrk)
						$rswrk->close();
					$this->level->EditValue = $arwrk;
				}
			}

			// aktif
			$this->aktif->EditAttrs["class"] = "form-control";
			$this->aktif->EditCustomAttributes = "";
			$this->aktif->EditValue = HtmlEncode($this->aktif->CurrentValue);
			$this->aktif->PlaceHolder = RemoveHtml($this->aktif->caption());

			// Add refer script
			// pid

			$this->pid->LinkCustomAttributes = "";
			$this->pid->HrefValue = "";

			// nip
			$this->nip->LinkCustomAttributes = "";
			$this->nip->HrefValue = "";

			// username
			$this->username->LinkCustomAttributes = "";
			$this->username->HrefValue = "";

			// password
			$this->password->LinkCustomAttributes = "";
			$this->password->HrefValue = "";

			// jenjang_id
			$this->jenjang_id->LinkCustomAttributes = "";
			$this->jenjang_id->HrefValue = "";

			// jabatan
			$this->jabatan->LinkCustomAttributes = "";
			$this->jabatan->HrefValue = "";

			// periode_jabatan
			$this->periode_jabatan->LinkCustomAttributes = "";
			$this->periode_jabatan->HrefValue = "";

			// type
			$this->type->LinkCustomAttributes = "";
			$this->type->HrefValue = "";

			// sertif
			$this->sertif->LinkCustomAttributes = "";
			$this->sertif->HrefValue = "";

			// tambahan
			$this->tambahan->LinkCustomAttributes = "";
			$this->tambahan->HrefValue = "";

			// lama_kerja
			$this->lama_kerja->LinkCustomAttributes = "";
			$this->lama_kerja->HrefValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";

			// alamat
			$this->alamat->LinkCustomAttributes = "";
			$this->alamat->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// wa
			$this->wa->LinkCustomAttributes = "";
			$this->wa->HrefValue = "";

			// hp
			$this->hp->LinkCustomAttributes = "";
			$this->hp->HrefValue = "";

			// tgllahir
			$this->tgllahir->LinkCustomAttributes = "";
			$this->tgllahir->HrefValue = "";

			// rekbank
			$this->rekbank->LinkCustomAttributes = "";
			$this->rekbank->HrefValue = "";

			// pendidikan
			$this->pendidikan->LinkCustomAttributes = "";
			$this->pendidikan->HrefValue = "";

			// jurusan
			$this->jurusan->LinkCustomAttributes = "";
			$this->jurusan->HrefValue = "";

			// agama
			$this->agama->LinkCustomAttributes = "";
			$this->agama->HrefValue = "";

			// jenkel
			$this->jenkel->LinkCustomAttributes = "";
			$this->jenkel->HrefValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";

			// foto
			$this->foto->LinkCustomAttributes = "";
			$this->foto->HrefValue = "";
			$this->foto->ExportHrefValue = $this->foto->UploadPath . $this->foto->Upload->DbValue;

			// file_cv
			$this->file_cv->LinkCustomAttributes = "";
			$this->file_cv->HrefValue = "";
			$this->file_cv->ExportHrefValue = $this->file_cv->UploadPath . $this->file_cv->Upload->DbValue;

			// mulai_bekerja
			$this->mulai_bekerja->LinkCustomAttributes = "";
			$this->mulai_bekerja->HrefValue = "";

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";

			// level
			$this->level->LinkCustomAttributes = "";
			$this->level->HrefValue = "";

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
		if ($this->pid->Required) {
			if (!$this->pid->IsDetailKey && $this->pid->FormValue != NULL && $this->pid->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pid->caption(), $this->pid->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->pid->FormValue)) {
			AddMessage($FormError, $this->pid->errorMessage());
		}
		if ($this->nip->Required) {
			if (!$this->nip->IsDetailKey && $this->nip->FormValue != NULL && $this->nip->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nip->caption(), $this->nip->RequiredErrorMessage));
			}
		}
		if ($this->username->Required) {
			if (!$this->username->IsDetailKey && $this->username->FormValue != NULL && $this->username->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->username->caption(), $this->username->RequiredErrorMessage));
			}
		}
		if ($this->password->Required) {
			if (!$this->password->IsDetailKey && $this->password->FormValue != NULL && $this->password->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->password->caption(), $this->password->RequiredErrorMessage));
			}
		}
		if ($this->jenjang_id->Required) {
			if (!$this->jenjang_id->IsDetailKey && $this->jenjang_id->FormValue != NULL && $this->jenjang_id->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenjang_id->caption(), $this->jenjang_id->RequiredErrorMessage));
			}
		}
		if ($this->jabatan->Required) {
			if (!$this->jabatan->IsDetailKey && $this->jabatan->FormValue != NULL && $this->jabatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jabatan->caption(), $this->jabatan->RequiredErrorMessage));
			}
		}
		if ($this->periode_jabatan->Required) {
			if (!$this->periode_jabatan->IsDetailKey && $this->periode_jabatan->FormValue != NULL && $this->periode_jabatan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->periode_jabatan->caption(), $this->periode_jabatan->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->periode_jabatan->FormValue)) {
			AddMessage($FormError, $this->periode_jabatan->errorMessage());
		}
		if ($this->type->Required) {
			if (!$this->type->IsDetailKey && $this->type->FormValue != NULL && $this->type->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->type->caption(), $this->type->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->type->FormValue)) {
			AddMessage($FormError, $this->type->errorMessage());
		}
		if ($this->sertif->Required) {
			if (!$this->sertif->IsDetailKey && $this->sertif->FormValue != NULL && $this->sertif->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sertif->caption(), $this->sertif->RequiredErrorMessage));
			}
		}
		if ($this->tambahan->Required) {
			if (!$this->tambahan->IsDetailKey && $this->tambahan->FormValue != NULL && $this->tambahan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tambahan->caption(), $this->tambahan->RequiredErrorMessage));
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
		if ($this->nama->Required) {
			if (!$this->nama->IsDetailKey && $this->nama->FormValue != NULL && $this->nama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
			}
		}
		if ($this->alamat->Required) {
			if (!$this->alamat->IsDetailKey && $this->alamat->FormValue != NULL && $this->alamat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->alamat->caption(), $this->alamat->RequiredErrorMessage));
			}
		}
		if ($this->_email->Required) {
			if (!$this->_email->IsDetailKey && $this->_email->FormValue != NULL && $this->_email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
			}
		}
		if ($this->wa->Required) {
			if (!$this->wa->IsDetailKey && $this->wa->FormValue != NULL && $this->wa->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->wa->caption(), $this->wa->RequiredErrorMessage));
			}
		}
		if ($this->hp->Required) {
			if (!$this->hp->IsDetailKey && $this->hp->FormValue != NULL && $this->hp->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->hp->caption(), $this->hp->RequiredErrorMessage));
			}
		}
		if ($this->tgllahir->Required) {
			if (!$this->tgllahir->IsDetailKey && $this->tgllahir->FormValue != NULL && $this->tgllahir->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgllahir->caption(), $this->tgllahir->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgllahir->FormValue)) {
			AddMessage($FormError, $this->tgllahir->errorMessage());
		}
		if ($this->rekbank->Required) {
			if (!$this->rekbank->IsDetailKey && $this->rekbank->FormValue != NULL && $this->rekbank->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->rekbank->caption(), $this->rekbank->RequiredErrorMessage));
			}
		}
		if ($this->pendidikan->Required) {
			if (!$this->pendidikan->IsDetailKey && $this->pendidikan->FormValue != NULL && $this->pendidikan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pendidikan->caption(), $this->pendidikan->RequiredErrorMessage));
			}
		}
		if ($this->jurusan->Required) {
			if (!$this->jurusan->IsDetailKey && $this->jurusan->FormValue != NULL && $this->jurusan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jurusan->caption(), $this->jurusan->RequiredErrorMessage));
			}
		}
		if ($this->agama->Required) {
			if (!$this->agama->IsDetailKey && $this->agama->FormValue != NULL && $this->agama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->agama->caption(), $this->agama->RequiredErrorMessage));
			}
		}
		if ($this->jenkel->Required) {
			if ($this->jenkel->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenkel->caption(), $this->jenkel->RequiredErrorMessage));
			}
		}
		if ($this->status->Required) {
			if (!$this->status->IsDetailKey && $this->status->FormValue != NULL && $this->status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
			}
		}
		if ($this->foto->Required) {
			if ($this->foto->Upload->FileName == "" && !$this->foto->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->foto->caption(), $this->foto->RequiredErrorMessage));
			}
		}
		if ($this->file_cv->Required) {
			if ($this->file_cv->Upload->FileName == "" && !$this->file_cv->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->file_cv->caption(), $this->file_cv->RequiredErrorMessage));
			}
		}
		if ($this->mulai_bekerja->Required) {
			if (!$this->mulai_bekerja->IsDetailKey && $this->mulai_bekerja->FormValue != NULL && $this->mulai_bekerja->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->mulai_bekerja->caption(), $this->mulai_bekerja->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->mulai_bekerja->FormValue)) {
			AddMessage($FormError, $this->mulai_bekerja->errorMessage());
		}
		if ($this->keterangan->Required) {
			if (!$this->keterangan->IsDetailKey && $this->keterangan->FormValue != NULL && $this->keterangan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keterangan->caption(), $this->keterangan->RequiredErrorMessage));
			}
		}
		if ($this->level->Required) {
			if (!$this->level->IsDetailKey && $this->level->FormValue != NULL && $this->level->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->level->caption(), $this->level->RequiredErrorMessage));
			}
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
		if (in_array("peg_skill", $detailTblVar) && $GLOBALS["peg_skill"]->DetailAdd) {
			if (!isset($GLOBALS["peg_skill_grid"]))
				$GLOBALS["peg_skill_grid"] = new peg_skill_grid(); // Get detail page object
			$GLOBALS["peg_skill_grid"]->validateGridForm();
		}
		if (in_array("peg_keluarga", $detailTblVar) && $GLOBALS["peg_keluarga"]->DetailAdd) {
			if (!isset($GLOBALS["peg_keluarga_grid"]))
				$GLOBALS["peg_keluarga_grid"] = new peg_keluarga_grid(); // Get detail page object
			$GLOBALS["peg_keluarga_grid"]->validateGridForm();
		}
		if (in_array("peg_dokumen", $detailTblVar) && $GLOBALS["peg_dokumen"]->DetailAdd) {
			if (!isset($GLOBALS["peg_dokumen_grid"]))
				$GLOBALS["peg_dokumen_grid"] = new peg_dokumen_grid(); // Get detail page object
			$GLOBALS["peg_dokumen_grid"]->validateGridForm();
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

		// pid
		$this->pid->setDbValueDef($rsnew, $this->pid->CurrentValue, NULL, FALSE);

		// nip
		$this->nip->setDbValueDef($rsnew, $this->nip->CurrentValue, NULL, FALSE);

		// username
		$this->username->setDbValueDef($rsnew, $this->username->CurrentValue, NULL, FALSE);

		// password
		$this->password->setDbValueDef($rsnew, $this->password->CurrentValue, NULL, FALSE);

		// jenjang_id
		$this->jenjang_id->setDbValueDef($rsnew, $this->jenjang_id->CurrentValue, NULL, FALSE);

		// jabatan
		$this->jabatan->setDbValueDef($rsnew, $this->jabatan->CurrentValue, NULL, FALSE);

		// periode_jabatan
		$this->periode_jabatan->setDbValueDef($rsnew, $this->periode_jabatan->CurrentValue, NULL, FALSE);

		// type
		$this->type->setDbValueDef($rsnew, $this->type->CurrentValue, NULL, FALSE);

		// sertif
		$this->sertif->setDbValueDef($rsnew, $this->sertif->CurrentValue, NULL, FALSE);

		// tambahan
		$this->tambahan->setDbValueDef($rsnew, $this->tambahan->CurrentValue, NULL, FALSE);

		// lama_kerja
		$this->lama_kerja->setDbValueDef($rsnew, $this->lama_kerja->CurrentValue, NULL, FALSE);

		// nama
		$this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, NULL, FALSE);

		// alamat
		$this->alamat->setDbValueDef($rsnew, $this->alamat->CurrentValue, NULL, FALSE);

		// email
		$this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, NULL, FALSE);

		// wa
		$this->wa->setDbValueDef($rsnew, $this->wa->CurrentValue, NULL, FALSE);

		// hp
		$this->hp->setDbValueDef($rsnew, $this->hp->CurrentValue, NULL, FALSE);

		// tgllahir
		$this->tgllahir->setDbValueDef($rsnew, UnFormatDateTime($this->tgllahir->CurrentValue, 0), NULL, FALSE);

		// rekbank
		$this->rekbank->setDbValueDef($rsnew, $this->rekbank->CurrentValue, NULL, FALSE);

		// pendidikan
		$this->pendidikan->setDbValueDef($rsnew, $this->pendidikan->CurrentValue, NULL, FALSE);

		// jurusan
		$this->jurusan->setDbValueDef($rsnew, $this->jurusan->CurrentValue, NULL, FALSE);

		// agama
		$this->agama->setDbValueDef($rsnew, $this->agama->CurrentValue, NULL, FALSE);

		// jenkel
		$this->jenkel->setDbValueDef($rsnew, $this->jenkel->CurrentValue, NULL, FALSE);

		// status
		$this->status->setDbValueDef($rsnew, $this->status->CurrentValue, NULL, FALSE);

		// foto
		if ($this->foto->Visible && !$this->foto->Upload->KeepFile) {
			$this->foto->Upload->DbValue = ""; // No need to delete old file
			if ($this->foto->Upload->FileName == "") {
				$rsnew['foto'] = NULL;
			} else {
				$rsnew['foto'] = $this->foto->Upload->FileName;
			}
		}

		// file_cv
		if ($this->file_cv->Visible && !$this->file_cv->Upload->KeepFile) {
			$this->file_cv->Upload->DbValue = ""; // No need to delete old file
			if ($this->file_cv->Upload->FileName == "") {
				$rsnew['file_cv'] = NULL;
			} else {
				$rsnew['file_cv'] = $this->file_cv->Upload->FileName;
			}
		}

		// mulai_bekerja
		$this->mulai_bekerja->setDbValueDef($rsnew, UnFormatDateTime($this->mulai_bekerja->CurrentValue, 0), NULL, FALSE);

		// keterangan
		$this->keterangan->setDbValueDef($rsnew, $this->keterangan->CurrentValue, NULL, FALSE);

		// level
		
		if ($Security->canAdmin()) { // System admin
			
			$this->level->setDbValueDef($rsnew, $this->level->CurrentValue, NULL, strval($this->level->CurrentValue) == "");
			
		}
		

		// aktif
		$this->aktif->setDbValueDef($rsnew, $this->aktif->CurrentValue, NULL, strval($this->aktif->CurrentValue) == "");
		if ($this->foto->Visible && !$this->foto->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->foto->Upload->DbValue) ? [] : [$this->foto->htmlDecode($this->foto->Upload->DbValue)];
			if (!EmptyValue($this->foto->Upload->FileName)) {
				$newFiles = [$this->foto->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->foto, $this->foto->Upload->Index);
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
							$file1 = UniqueFilename($this->foto->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->foto->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->foto->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->foto->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->foto->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->foto->setDbValueDef($rsnew, $this->foto->Upload->FileName, NULL, FALSE);
			}
		}
		if ($this->file_cv->Visible && !$this->file_cv->Upload->KeepFile) {
			$oldFiles = EmptyValue($this->file_cv->Upload->DbValue) ? [] : [$this->file_cv->htmlDecode($this->file_cv->Upload->DbValue)];
			if (!EmptyValue($this->file_cv->Upload->FileName)) {
				$newFiles = [$this->file_cv->Upload->FileName];
				$NewFileCount = count($newFiles);
				for ($i = 0; $i < $NewFileCount; $i++) {
					if ($newFiles[$i] != "") {
						$file = $newFiles[$i];
						$tempPath = UploadTempPath($this->file_cv, $this->file_cv->Upload->Index);
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
							$file1 = UniqueFilename($this->file_cv->physicalUploadPath(), $file); // Get new file name
							if ($file1 != $file) { // Rename temp file
								while (file_exists($tempPath . $file1) || file_exists($this->file_cv->physicalUploadPath() . $file1)) // Make sure no file name clash
									$file1 = UniqueFilename($this->file_cv->physicalUploadPath(), $file1, TRUE); // Use indexed name
								rename($tempPath . $file, $tempPath . $file1);
								$newFiles[$i] = $file1;
							}
						}
					}
				}
				$this->file_cv->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
				$this->file_cv->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
				$this->file_cv->setDbValueDef($rsnew, $this->file_cv->Upload->FileName, NULL, FALSE);
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
				if ($this->foto->Visible && !$this->foto->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->foto->Upload->DbValue) ? [] : [$this->foto->htmlDecode($this->foto->Upload->DbValue)];
					if (!EmptyValue($this->foto->Upload->FileName)) {
						$newFiles = [$this->foto->Upload->FileName];
						$newFiles2 = [$this->foto->htmlDecode($rsnew['foto'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->foto, $this->foto->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->foto->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->foto->oldPhysicalUploadPath() . $oldFile);
						}
					}
				}
				if ($this->file_cv->Visible && !$this->file_cv->Upload->KeepFile) {
					$oldFiles = EmptyValue($this->file_cv->Upload->DbValue) ? [] : [$this->file_cv->htmlDecode($this->file_cv->Upload->DbValue)];
					if (!EmptyValue($this->file_cv->Upload->FileName)) {
						$newFiles = [$this->file_cv->Upload->FileName];
						$newFiles2 = [$this->file_cv->htmlDecode($rsnew['file_cv'])];
						$newFileCount = count($newFiles);
						for ($i = 0; $i < $newFileCount; $i++) {
							if ($newFiles[$i] != "") {
								$file = UploadTempPath($this->file_cv, $this->file_cv->Upload->Index) . $newFiles[$i];
								if (file_exists($file)) {
									if (@$newFiles2[$i] != "") // Use correct file name
										$newFiles[$i] = $newFiles2[$i];
									if (!$this->file_cv->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
								@unlink($this->file_cv->oldPhysicalUploadPath() . $oldFile);
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

		// Add detail records
		if ($addRow) {
			$detailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("peg_skill", $detailTblVar) && $GLOBALS["peg_skill"]->DetailAdd) {
				$GLOBALS["peg_skill"]->pid->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["peg_skill_grid"]))
					$GLOBALS["peg_skill_grid"] = new peg_skill_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "peg_skill"); // Load user level of detail table
				$addRow = $GLOBALS["peg_skill_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["peg_skill"]->pid->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("peg_keluarga", $detailTblVar) && $GLOBALS["peg_keluarga"]->DetailAdd) {
				$GLOBALS["peg_keluarga"]->pid->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["peg_keluarga_grid"]))
					$GLOBALS["peg_keluarga_grid"] = new peg_keluarga_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "peg_keluarga"); // Load user level of detail table
				$addRow = $GLOBALS["peg_keluarga_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["peg_keluarga"]->pid->setSessionValue(""); // Clear master key if insert failed
				}
			}
			if (in_array("peg_dokumen", $detailTblVar) && $GLOBALS["peg_dokumen"]->DetailAdd) {
				$GLOBALS["peg_dokumen"]->pid->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["peg_dokumen_grid"]))
					$GLOBALS["peg_dokumen_grid"] = new peg_dokumen_grid(); // Get detail page object
				$Security->loadCurrentUserLevel($this->ProjectID . "peg_dokumen"); // Load user level of detail table
				$addRow = $GLOBALS["peg_dokumen_grid"]->gridInsert();
				$Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$addRow) {
					$GLOBALS["peg_dokumen"]->pid->setSessionValue(""); // Clear master key if insert failed
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

			// foto
			CleanUploadTempPath($this->foto, $this->foto->Upload->Index);

			// file_cv
			CleanUploadTempPath($this->file_cv, $this->file_cv->Upload->Index);
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
			if (in_array("peg_skill", $detailTblVar)) {
				if (!isset($GLOBALS["peg_skill_grid"]))
					$GLOBALS["peg_skill_grid"] = new peg_skill_grid();
				if ($GLOBALS["peg_skill_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["peg_skill_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["peg_skill_grid"]->CurrentMode = "add";
					$GLOBALS["peg_skill_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["peg_skill_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["peg_skill_grid"]->setStartRecordNumber(1);
					$GLOBALS["peg_skill_grid"]->pid->IsDetailKey = TRUE;
					$GLOBALS["peg_skill_grid"]->pid->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["peg_skill_grid"]->pid->setSessionValue($GLOBALS["peg_skill_grid"]->pid->CurrentValue);
				}
			}
			if (in_array("peg_keluarga", $detailTblVar)) {
				if (!isset($GLOBALS["peg_keluarga_grid"]))
					$GLOBALS["peg_keluarga_grid"] = new peg_keluarga_grid();
				if ($GLOBALS["peg_keluarga_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["peg_keluarga_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["peg_keluarga_grid"]->CurrentMode = "add";
					$GLOBALS["peg_keluarga_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["peg_keluarga_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["peg_keluarga_grid"]->setStartRecordNumber(1);
					$GLOBALS["peg_keluarga_grid"]->pid->IsDetailKey = TRUE;
					$GLOBALS["peg_keluarga_grid"]->pid->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["peg_keluarga_grid"]->pid->setSessionValue($GLOBALS["peg_keluarga_grid"]->pid->CurrentValue);
				}
			}
			if (in_array("peg_dokumen", $detailTblVar)) {
				if (!isset($GLOBALS["peg_dokumen_grid"]))
					$GLOBALS["peg_dokumen_grid"] = new peg_dokumen_grid();
				if ($GLOBALS["peg_dokumen_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["peg_dokumen_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["peg_dokumen_grid"]->CurrentMode = "add";
					$GLOBALS["peg_dokumen_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["peg_dokumen_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["peg_dokumen_grid"]->setStartRecordNumber(1);
					$GLOBALS["peg_dokumen_grid"]->pid->IsDetailKey = TRUE;
					$GLOBALS["peg_dokumen_grid"]->pid->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["peg_dokumen_grid"]->pid->setSessionValue($GLOBALS["peg_dokumen_grid"]->pid->CurrentValue);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("pegawailist.php"), "", $this->TableVar, TRUE);
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
				case "x_jenjang_id":
					break;
				case "x_jabatan":
					break;
				case "x_type":
					break;
				case "x_sertif":
					break;
				case "x_tambahan":
					break;
				case "x_pendidikan":
					break;
				case "x_agama":
					break;
				case "x_jenkel":
					break;
				case "x_level":
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
						case "x_jenjang_id":
							break;
						case "x_jabatan":
							break;
						case "x_type":
							break;
						case "x_sertif":
							break;
						case "x_tambahan":
							break;
						case "x_pendidikan":
							break;
						case "x_agama":
							break;
						case "x_jenkel":
							break;
						case "x_level":
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

		//echo "Page ";
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