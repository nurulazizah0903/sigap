<?php
namespace PHPMaker2020\sigap;

/**
 * Page class
 */
class daftarbarang_edit extends daftarbarang
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}";

	// Table name
	public $TableName = 'daftarbarang';

	// Page object name
	public $PageObjName = "daftarbarang_edit";

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

		// Table object (daftarbarang)
		if (!isset($GLOBALS["daftarbarang"]) || get_class($GLOBALS["daftarbarang"]) == PROJECT_NAMESPACE . "daftarbarang") {
			$GLOBALS["daftarbarang"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["daftarbarang"];
		}

		// Table object (pegawai)
		if (!isset($GLOBALS['pegawai']))
			$GLOBALS['pegawai'] = new pegawai();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'daftarbarang');

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
		global $daftarbarang;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($daftarbarang);
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
					if ($pageName == "daftarbarangview.php")
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
					$this->terminate(GetUrl("daftarbaranglist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->setVisibility();
		$this->pemegang->setVisibility();
		$this->nama->setVisibility();
		$this->jenis->setVisibility();
		$this->sepsifikasi->setVisibility();
		$this->tgl_terima->setVisibility();
		$this->tgl_beli->setVisibility();
		$this->harga->setVisibility();
		$this->dokumen->setVisibility();
		$this->foto->setVisibility();
		$this->keterangan->setVisibility();
		$this->deskripsi->setVisibility();
		$this->status->setVisibility();
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
		$this->setupLookupOptions($this->pemegang);

		// Check permission
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("daftarbaranglist.php");
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
					$this->terminate("daftarbaranglist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "daftarbaranglist.php")
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
		$this->dokumen->Upload->Index = $CurrentForm->Index;
		$this->dokumen->Upload->uploadFile();
		$this->dokumen->CurrentValue = $this->dokumen->Upload->FileName;
		$this->foto->Upload->Index = $CurrentForm->Index;
		$this->foto->Upload->uploadFile();
		$this->foto->CurrentValue = $this->foto->Upload->FileName;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;
		$this->getUploadFiles(); // Get upload files

		// Check field name 'id' first before field var 'x_id'
		$val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
		if (!$this->id->IsDetailKey)
			$this->id->setFormValue($val);

		// Check field name 'pemegang' first before field var 'x_pemegang'
		$val = $CurrentForm->hasValue("pemegang") ? $CurrentForm->getValue("pemegang") : $CurrentForm->getValue("x_pemegang");
		if (!$this->pemegang->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pemegang->Visible = FALSE; // Disable update for API request
			else
				$this->pemegang->setFormValue($val);
		}

		// Check field name 'nama' first before field var 'x_nama'
		$val = $CurrentForm->hasValue("nama") ? $CurrentForm->getValue("nama") : $CurrentForm->getValue("x_nama");
		if (!$this->nama->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nama->Visible = FALSE; // Disable update for API request
			else
				$this->nama->setFormValue($val);
		}

		// Check field name 'jenis' first before field var 'x_jenis'
		$val = $CurrentForm->hasValue("jenis") ? $CurrentForm->getValue("jenis") : $CurrentForm->getValue("x_jenis");
		if (!$this->jenis->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jenis->Visible = FALSE; // Disable update for API request
			else
				$this->jenis->setFormValue($val);
		}

		// Check field name 'sepsifikasi' first before field var 'x_sepsifikasi'
		$val = $CurrentForm->hasValue("sepsifikasi") ? $CurrentForm->getValue("sepsifikasi") : $CurrentForm->getValue("x_sepsifikasi");
		if (!$this->sepsifikasi->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->sepsifikasi->Visible = FALSE; // Disable update for API request
			else
				$this->sepsifikasi->setFormValue($val);
		}

		// Check field name 'tgl_terima' first before field var 'x_tgl_terima'
		$val = $CurrentForm->hasValue("tgl_terima") ? $CurrentForm->getValue("tgl_terima") : $CurrentForm->getValue("x_tgl_terima");
		if (!$this->tgl_terima->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl_terima->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_terima->setFormValue($val);
			$this->tgl_terima->CurrentValue = UnFormatDateTime($this->tgl_terima->CurrentValue, 0);
		}

		// Check field name 'tgl_beli' first before field var 'x_tgl_beli'
		$val = $CurrentForm->hasValue("tgl_beli") ? $CurrentForm->getValue("tgl_beli") : $CurrentForm->getValue("x_tgl_beli");
		if (!$this->tgl_beli->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl_beli->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_beli->setFormValue($val);
			$this->tgl_beli->CurrentValue = UnFormatDateTime($this->tgl_beli->CurrentValue, 0);
		}

		// Check field name 'harga' first before field var 'x_harga'
		$val = $CurrentForm->hasValue("harga") ? $CurrentForm->getValue("harga") : $CurrentForm->getValue("x_harga");
		if (!$this->harga->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->harga->Visible = FALSE; // Disable update for API request
			else
				$this->harga->setFormValue($val);
		}

		// Check field name 'keterangan' first before field var 'x_keterangan'
		$val = $CurrentForm->hasValue("keterangan") ? $CurrentForm->getValue("keterangan") : $CurrentForm->getValue("x_keterangan");
		if (!$this->keterangan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keterangan->Visible = FALSE; // Disable update for API request
			else
				$this->keterangan->setFormValue($val);
		}

		// Check field name 'deskripsi' first before field var 'x_deskripsi'
		$val = $CurrentForm->hasValue("deskripsi") ? $CurrentForm->getValue("deskripsi") : $CurrentForm->getValue("x_deskripsi");
		if (!$this->deskripsi->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->deskripsi->Visible = FALSE; // Disable update for API request
			else
				$this->deskripsi->setFormValue($val);
		}

		// Check field name 'status' first before field var 'x_status'
		$val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
		if (!$this->status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->status->Visible = FALSE; // Disable update for API request
			else
				$this->status->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->pemegang->CurrentValue = $this->pemegang->FormValue;
		$this->nama->CurrentValue = $this->nama->FormValue;
		$this->jenis->CurrentValue = $this->jenis->FormValue;
		$this->sepsifikasi->CurrentValue = $this->sepsifikasi->FormValue;
		$this->tgl_terima->CurrentValue = $this->tgl_terima->FormValue;
		$this->tgl_terima->CurrentValue = UnFormatDateTime($this->tgl_terima->CurrentValue, 0);
		$this->tgl_beli->CurrentValue = $this->tgl_beli->FormValue;
		$this->tgl_beli->CurrentValue = UnFormatDateTime($this->tgl_beli->CurrentValue, 0);
		$this->harga->CurrentValue = $this->harga->FormValue;
		$this->keterangan->CurrentValue = $this->keterangan->FormValue;
		$this->deskripsi->CurrentValue = $this->deskripsi->FormValue;
		$this->status->CurrentValue = $this->status->FormValue;
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
		$this->pemegang->setDbValue($row['pemegang']);
		$this->nama->setDbValue($row['nama']);
		$this->jenis->setDbValue($row['jenis']);
		$this->sepsifikasi->setDbValue($row['sepsifikasi']);
		$this->tgl_terima->setDbValue($row['tgl_terima']);
		$this->tgl_beli->setDbValue($row['tgl_beli']);
		$this->harga->setDbValue($row['harga']);
		$this->dokumen->Upload->DbValue = $row['dokumen'];
		$this->dokumen->setDbValue($this->dokumen->Upload->DbValue);
		$this->foto->Upload->DbValue = $row['foto'];
		$this->foto->setDbValue($this->foto->Upload->DbValue);
		$this->keterangan->setDbValue($row['keterangan']);
		$this->deskripsi->setDbValue($row['deskripsi']);
		$this->status->setDbValue($row['status']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['pemegang'] = NULL;
		$row['nama'] = NULL;
		$row['jenis'] = NULL;
		$row['sepsifikasi'] = NULL;
		$row['tgl_terima'] = NULL;
		$row['tgl_beli'] = NULL;
		$row['harga'] = NULL;
		$row['dokumen'] = NULL;
		$row['foto'] = NULL;
		$row['keterangan'] = NULL;
		$row['deskripsi'] = NULL;
		$row['status'] = NULL;
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
		// pemegang
		// nama
		// jenis
		// sepsifikasi
		// tgl_terima
		// tgl_beli
		// harga
		// dokumen
		// foto
		// keterangan
		// deskripsi
		// status

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// pemegang
			$this->pemegang->ViewValue = $this->pemegang->CurrentValue;
			$curVal = strval($this->pemegang->CurrentValue);
			if ($curVal != "") {
				$this->pemegang->ViewValue = $this->pemegang->lookupCacheOption($curVal);
				if ($this->pemegang->ViewValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->pemegang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = $rswrk->fields('df');
						$this->pemegang->ViewValue = $this->pemegang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->pemegang->ViewValue = $this->pemegang->CurrentValue;
					}
				}
			} else {
				$this->pemegang->ViewValue = NULL;
			}
			$this->pemegang->ViewCustomAttributes = "";

			// nama
			$this->nama->ViewValue = $this->nama->CurrentValue;
			$this->nama->ViewCustomAttributes = "";

			// jenis
			$this->jenis->ViewValue = $this->jenis->CurrentValue;
			$this->jenis->ViewCustomAttributes = "";

			// sepsifikasi
			$this->sepsifikasi->ViewValue = $this->sepsifikasi->CurrentValue;
			$this->sepsifikasi->ViewCustomAttributes = "";

			// tgl_terima
			$this->tgl_terima->ViewValue = $this->tgl_terima->CurrentValue;
			$this->tgl_terima->ViewValue = FormatDateTime($this->tgl_terima->ViewValue, 0);
			$this->tgl_terima->ViewCustomAttributes = "";

			// tgl_beli
			$this->tgl_beli->ViewValue = $this->tgl_beli->CurrentValue;
			$this->tgl_beli->ViewValue = FormatDateTime($this->tgl_beli->ViewValue, 0);
			$this->tgl_beli->ViewCustomAttributes = "";

			// harga
			$this->harga->ViewValue = $this->harga->CurrentValue;
			$this->harga->ViewValue = FormatNumber($this->harga->ViewValue, 0, -2, -2, -2);
			$this->harga->ViewCustomAttributes = "";

			// dokumen
			if (!EmptyValue($this->dokumen->Upload->DbValue)) {
				$this->dokumen->ViewValue = $this->dokumen->Upload->DbValue;
			} else {
				$this->dokumen->ViewValue = "";
			}
			$this->dokumen->ViewCustomAttributes = "";

			// foto
			if (!EmptyValue($this->foto->Upload->DbValue)) {
				$this->foto->ViewValue = $this->foto->Upload->DbValue;
			} else {
				$this->foto->ViewValue = "";
			}
			$this->foto->ViewCustomAttributes = "";

			// keterangan
			$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
			$this->keterangan->ViewCustomAttributes = "";

			// deskripsi
			$this->deskripsi->ViewValue = $this->deskripsi->CurrentValue;
			$this->deskripsi->ViewCustomAttributes = "";

			// status
			$this->status->ViewValue = $this->status->CurrentValue;
			$this->status->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// pemegang
			$this->pemegang->LinkCustomAttributes = "";
			$this->pemegang->HrefValue = "";
			$this->pemegang->TooltipValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";
			$this->nama->TooltipValue = "";

			// jenis
			$this->jenis->LinkCustomAttributes = "";
			$this->jenis->HrefValue = "";
			$this->jenis->TooltipValue = "";

			// sepsifikasi
			$this->sepsifikasi->LinkCustomAttributes = "";
			$this->sepsifikasi->HrefValue = "";
			$this->sepsifikasi->TooltipValue = "";

			// tgl_terima
			$this->tgl_terima->LinkCustomAttributes = "";
			$this->tgl_terima->HrefValue = "";
			$this->tgl_terima->TooltipValue = "";

			// tgl_beli
			$this->tgl_beli->LinkCustomAttributes = "";
			$this->tgl_beli->HrefValue = "";
			$this->tgl_beli->TooltipValue = "";

			// harga
			$this->harga->LinkCustomAttributes = "";
			$this->harga->HrefValue = "";
			$this->harga->TooltipValue = "";

			// dokumen
			$this->dokumen->LinkCustomAttributes = "";
			$this->dokumen->HrefValue = "";
			$this->dokumen->ExportHrefValue = $this->dokumen->UploadPath . $this->dokumen->Upload->DbValue;
			$this->dokumen->TooltipValue = "";

			// foto
			$this->foto->LinkCustomAttributes = "";
			$this->foto->HrefValue = "";
			$this->foto->ExportHrefValue = $this->foto->UploadPath . $this->foto->Upload->DbValue;
			$this->foto->TooltipValue = "";

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";
			$this->keterangan->TooltipValue = "";

			// deskripsi
			$this->deskripsi->LinkCustomAttributes = "";
			$this->deskripsi->HrefValue = "";
			$this->deskripsi->TooltipValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// pemegang
			$this->pemegang->EditAttrs["class"] = "form-control";
			$this->pemegang->EditCustomAttributes = "";
			$this->pemegang->EditValue = HtmlEncode($this->pemegang->CurrentValue);
			$curVal = strval($this->pemegang->CurrentValue);
			if ($curVal != "") {
				$this->pemegang->EditValue = $this->pemegang->lookupCacheOption($curVal);
				if ($this->pemegang->EditValue === NULL) { // Lookup from database
					$filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
					$sqlWrk = $this->pemegang->Lookup->getSql(FALSE, $filterWrk, '', $this);
					$rswrk = Conn()->execute($sqlWrk);
					if ($rswrk && !$rswrk->EOF) { // Lookup values found
						$arwrk = [];
						$arwrk[1] = HtmlEncode($rswrk->fields('df'));
						$this->pemegang->EditValue = $this->pemegang->displayValue($arwrk);
						$rswrk->Close();
					} else {
						$this->pemegang->EditValue = HtmlEncode($this->pemegang->CurrentValue);
					}
				}
			} else {
				$this->pemegang->EditValue = NULL;
			}
			$this->pemegang->PlaceHolder = RemoveHtml($this->pemegang->caption());

			// nama
			$this->nama->EditAttrs["class"] = "form-control";
			$this->nama->EditCustomAttributes = "";
			if (!$this->nama->Raw)
				$this->nama->CurrentValue = HtmlDecode($this->nama->CurrentValue);
			$this->nama->EditValue = HtmlEncode($this->nama->CurrentValue);
			$this->nama->PlaceHolder = RemoveHtml($this->nama->caption());

			// jenis
			$this->jenis->EditAttrs["class"] = "form-control";
			$this->jenis->EditCustomAttributes = "";
			if (!$this->jenis->Raw)
				$this->jenis->CurrentValue = HtmlDecode($this->jenis->CurrentValue);
			$this->jenis->EditValue = HtmlEncode($this->jenis->CurrentValue);
			$this->jenis->PlaceHolder = RemoveHtml($this->jenis->caption());

			// sepsifikasi
			$this->sepsifikasi->EditAttrs["class"] = "form-control";
			$this->sepsifikasi->EditCustomAttributes = "";
			if (!$this->sepsifikasi->Raw)
				$this->sepsifikasi->CurrentValue = HtmlDecode($this->sepsifikasi->CurrentValue);
			$this->sepsifikasi->EditValue = HtmlEncode($this->sepsifikasi->CurrentValue);
			$this->sepsifikasi->PlaceHolder = RemoveHtml($this->sepsifikasi->caption());

			// tgl_terima
			$this->tgl_terima->EditAttrs["class"] = "form-control";
			$this->tgl_terima->EditCustomAttributes = "";
			$this->tgl_terima->EditValue = HtmlEncode(FormatDateTime($this->tgl_terima->CurrentValue, 8));
			$this->tgl_terima->PlaceHolder = RemoveHtml($this->tgl_terima->caption());

			// tgl_beli
			$this->tgl_beli->EditAttrs["class"] = "form-control";
			$this->tgl_beli->EditCustomAttributes = "";
			$this->tgl_beli->EditValue = HtmlEncode(FormatDateTime($this->tgl_beli->CurrentValue, 8));
			$this->tgl_beli->PlaceHolder = RemoveHtml($this->tgl_beli->caption());

			// harga
			$this->harga->EditAttrs["class"] = "form-control";
			$this->harga->EditCustomAttributes = "";
			$this->harga->EditValue = HtmlEncode($this->harga->CurrentValue);
			$this->harga->PlaceHolder = RemoveHtml($this->harga->caption());

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
			if ($this->isShow())
				RenderUploadField($this->dokumen);

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
			if ($this->isShow())
				RenderUploadField($this->foto);

			// keterangan
			$this->keterangan->EditAttrs["class"] = "form-control";
			$this->keterangan->EditCustomAttributes = "";
			if (!$this->keterangan->Raw)
				$this->keterangan->CurrentValue = HtmlDecode($this->keterangan->CurrentValue);
			$this->keterangan->EditValue = HtmlEncode($this->keterangan->CurrentValue);
			$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

			// deskripsi
			$this->deskripsi->EditAttrs["class"] = "form-control";
			$this->deskripsi->EditCustomAttributes = "";
			if (!$this->deskripsi->Raw)
				$this->deskripsi->CurrentValue = HtmlDecode($this->deskripsi->CurrentValue);
			$this->deskripsi->EditValue = HtmlEncode($this->deskripsi->CurrentValue);
			$this->deskripsi->PlaceHolder = RemoveHtml($this->deskripsi->caption());

			// status
			$this->status->EditAttrs["class"] = "form-control";
			$this->status->EditCustomAttributes = "";
			if (!$this->status->Raw)
				$this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
			$this->status->EditValue = HtmlEncode($this->status->CurrentValue);
			$this->status->PlaceHolder = RemoveHtml($this->status->caption());

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// pemegang
			$this->pemegang->LinkCustomAttributes = "";
			$this->pemegang->HrefValue = "";

			// nama
			$this->nama->LinkCustomAttributes = "";
			$this->nama->HrefValue = "";

			// jenis
			$this->jenis->LinkCustomAttributes = "";
			$this->jenis->HrefValue = "";

			// sepsifikasi
			$this->sepsifikasi->LinkCustomAttributes = "";
			$this->sepsifikasi->HrefValue = "";

			// tgl_terima
			$this->tgl_terima->LinkCustomAttributes = "";
			$this->tgl_terima->HrefValue = "";

			// tgl_beli
			$this->tgl_beli->LinkCustomAttributes = "";
			$this->tgl_beli->HrefValue = "";

			// harga
			$this->harga->LinkCustomAttributes = "";
			$this->harga->HrefValue = "";

			// dokumen
			$this->dokumen->LinkCustomAttributes = "";
			$this->dokumen->HrefValue = "";
			$this->dokumen->ExportHrefValue = $this->dokumen->UploadPath . $this->dokumen->Upload->DbValue;

			// foto
			$this->foto->LinkCustomAttributes = "";
			$this->foto->HrefValue = "";
			$this->foto->ExportHrefValue = $this->foto->UploadPath . $this->foto->Upload->DbValue;

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";

			// deskripsi
			$this->deskripsi->LinkCustomAttributes = "";
			$this->deskripsi->HrefValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
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
		if ($this->pemegang->Required) {
			if (!$this->pemegang->IsDetailKey && $this->pemegang->FormValue != NULL && $this->pemegang->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pemegang->caption(), $this->pemegang->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->pemegang->FormValue)) {
			AddMessage($FormError, $this->pemegang->errorMessage());
		}
		if ($this->nama->Required) {
			if (!$this->nama->IsDetailKey && $this->nama->FormValue != NULL && $this->nama->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nama->caption(), $this->nama->RequiredErrorMessage));
			}
		}
		if ($this->jenis->Required) {
			if (!$this->jenis->IsDetailKey && $this->jenis->FormValue != NULL && $this->jenis->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenis->caption(), $this->jenis->RequiredErrorMessage));
			}
		}
		if ($this->sepsifikasi->Required) {
			if (!$this->sepsifikasi->IsDetailKey && $this->sepsifikasi->FormValue != NULL && $this->sepsifikasi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->sepsifikasi->caption(), $this->sepsifikasi->RequiredErrorMessage));
			}
		}
		if ($this->tgl_terima->Required) {
			if (!$this->tgl_terima->IsDetailKey && $this->tgl_terima->FormValue != NULL && $this->tgl_terima->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_terima->caption(), $this->tgl_terima->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_terima->FormValue)) {
			AddMessage($FormError, $this->tgl_terima->errorMessage());
		}
		if ($this->tgl_beli->Required) {
			if (!$this->tgl_beli->IsDetailKey && $this->tgl_beli->FormValue != NULL && $this->tgl_beli->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_beli->caption(), $this->tgl_beli->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_beli->FormValue)) {
			AddMessage($FormError, $this->tgl_beli->errorMessage());
		}
		if ($this->harga->Required) {
			if (!$this->harga->IsDetailKey && $this->harga->FormValue != NULL && $this->harga->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->harga->caption(), $this->harga->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->harga->FormValue)) {
			AddMessage($FormError, $this->harga->errorMessage());
		}
		if ($this->dokumen->Required) {
			if ($this->dokumen->Upload->FileName == "" && !$this->dokumen->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->dokumen->caption(), $this->dokumen->RequiredErrorMessage));
			}
		}
		if ($this->foto->Required) {
			if ($this->foto->Upload->FileName == "" && !$this->foto->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->foto->caption(), $this->foto->RequiredErrorMessage));
			}
		}
		if ($this->keterangan->Required) {
			if (!$this->keterangan->IsDetailKey && $this->keterangan->FormValue != NULL && $this->keterangan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keterangan->caption(), $this->keterangan->RequiredErrorMessage));
			}
		}
		if ($this->deskripsi->Required) {
			if (!$this->deskripsi->IsDetailKey && $this->deskripsi->FormValue != NULL && $this->deskripsi->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->deskripsi->caption(), $this->deskripsi->RequiredErrorMessage));
			}
		}
		if ($this->status->Required) {
			if (!$this->status->IsDetailKey && $this->status->FormValue != NULL && $this->status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
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

			// pemegang
			$this->pemegang->setDbValueDef($rsnew, $this->pemegang->CurrentValue, NULL, $this->pemegang->ReadOnly);

			// nama
			$this->nama->setDbValueDef($rsnew, $this->nama->CurrentValue, NULL, $this->nama->ReadOnly);

			// jenis
			$this->jenis->setDbValueDef($rsnew, $this->jenis->CurrentValue, NULL, $this->jenis->ReadOnly);

			// sepsifikasi
			$this->sepsifikasi->setDbValueDef($rsnew, $this->sepsifikasi->CurrentValue, NULL, $this->sepsifikasi->ReadOnly);

			// tgl_terima
			$this->tgl_terima->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_terima->CurrentValue, 0), NULL, $this->tgl_terima->ReadOnly);

			// tgl_beli
			$this->tgl_beli->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_beli->CurrentValue, 0), NULL, $this->tgl_beli->ReadOnly);

			// harga
			$this->harga->setDbValueDef($rsnew, $this->harga->CurrentValue, NULL, $this->harga->ReadOnly);

			// dokumen
			if ($this->dokumen->Visible && !$this->dokumen->ReadOnly && !$this->dokumen->Upload->KeepFile) {
				$this->dokumen->Upload->DbValue = $rsold['dokumen']; // Get original value
				if ($this->dokumen->Upload->FileName == "") {
					$rsnew['dokumen'] = NULL;
				} else {
					$rsnew['dokumen'] = $this->dokumen->Upload->FileName;
				}
			}

			// foto
			if ($this->foto->Visible && !$this->foto->ReadOnly && !$this->foto->Upload->KeepFile) {
				$this->foto->Upload->DbValue = $rsold['foto']; // Get original value
				if ($this->foto->Upload->FileName == "") {
					$rsnew['foto'] = NULL;
				} else {
					$rsnew['foto'] = $this->foto->Upload->FileName;
				}
			}

			// keterangan
			$this->keterangan->setDbValueDef($rsnew, $this->keterangan->CurrentValue, NULL, $this->keterangan->ReadOnly);

			// deskripsi
			$this->deskripsi->setDbValueDef($rsnew, $this->deskripsi->CurrentValue, NULL, $this->deskripsi->ReadOnly);

			// status
			$this->status->setDbValueDef($rsnew, $this->status->CurrentValue, NULL, $this->status->ReadOnly);
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
					$this->dokumen->setDbValueDef($rsnew, $this->dokumen->Upload->FileName, NULL, $this->dokumen->ReadOnly);
				}
			}
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
					$this->foto->setDbValueDef($rsnew, $this->foto->Upload->FileName, NULL, $this->foto->ReadOnly);
				}
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

			// dokumen
			CleanUploadTempPath($this->dokumen, $this->dokumen->Upload->Index);

			// foto
			CleanUploadTempPath($this->foto, $this->foto->Upload->Index);
		}

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("daftarbaranglist.php"), "", $this->TableVar, TRUE);
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
				case "x_pemegang":
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
						case "x_pemegang":
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