<?php
namespace PHPMaker2020\sigap;

/**
 * Page class
 */
class uangmuka_edit extends uangmuka
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}";

	// Table name
	public $TableName = 'uangmuka';

	// Page object name
	public $PageObjName = "uangmuka_edit";

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

		// Table object (uangmuka)
		if (!isset($GLOBALS["uangmuka"]) || get_class($GLOBALS["uangmuka"]) == PROJECT_NAMESPACE . "uangmuka") {
			$GLOBALS["uangmuka"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["uangmuka"];
		}

		// Table object (pegawai)
		if (!isset($GLOBALS['pegawai']))
			$GLOBALS['pegawai'] = new pegawai();

		// Page ID (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility only)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'uangmuka');

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
		global $uangmuka;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
			if (class_exists($class)) {
				$doc = new $class($uangmuka);
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
					if ($pageName == "uangmukaview.php")
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
					$this->terminate(GetUrl("uangmukalist.php"));
				else
					$this->terminate(GetUrl("login.php"));
				return;
			}
		}

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id->setVisibility();
		$this->tgl->setVisibility();
		$this->pembayar->setVisibility();
		$this->peruntukan->setVisibility();
		$this->penerima->setVisibility();
		$this->rek_penerima->setVisibility();
		$this->tgl_terima->setVisibility();
		$this->total_terima->setVisibility();
		$this->tgl_tgjb->setVisibility();
		$this->jumlah_tgjb->setVisibility();
		$this->jenis->setVisibility();
		$this->bukti1->setVisibility();
		$this->bukti2->setVisibility();
		$this->bukti3->setVisibility();
		$this->bukti4->setVisibility();
		$this->disetujui->setVisibility();
		$this->status->setVisibility();
		$this->keterangan->setVisibility();
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
		if (!$Security->canEdit()) {
			$this->setFailureMessage(DeniedMessage()); // No permission
			$this->terminate("uangmukalist.php");
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
					$this->terminate("uangmukalist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "uangmukalist.php")
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
		$this->bukti1->Upload->Index = $CurrentForm->Index;
		$this->bukti1->Upload->uploadFile();
		$this->bukti1->CurrentValue = $this->bukti1->Upload->FileName;
		$this->bukti2->Upload->Index = $CurrentForm->Index;
		$this->bukti2->Upload->uploadFile();
		$this->bukti2->CurrentValue = $this->bukti2->Upload->FileName;
		$this->bukti3->Upload->Index = $CurrentForm->Index;
		$this->bukti3->Upload->uploadFile();
		$this->bukti3->CurrentValue = $this->bukti3->Upload->FileName;
		$this->bukti4->Upload->Index = $CurrentForm->Index;
		$this->bukti4->Upload->uploadFile();
		$this->bukti4->CurrentValue = $this->bukti4->Upload->FileName;
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

		// Check field name 'tgl' first before field var 'x_tgl'
		$val = $CurrentForm->hasValue("tgl") ? $CurrentForm->getValue("tgl") : $CurrentForm->getValue("x_tgl");
		if (!$this->tgl->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl->Visible = FALSE; // Disable update for API request
			else
				$this->tgl->setFormValue($val);
			$this->tgl->CurrentValue = UnFormatDateTime($this->tgl->CurrentValue, 0);
		}

		// Check field name 'pembayar' first before field var 'x_pembayar'
		$val = $CurrentForm->hasValue("pembayar") ? $CurrentForm->getValue("pembayar") : $CurrentForm->getValue("x_pembayar");
		if (!$this->pembayar->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->pembayar->Visible = FALSE; // Disable update for API request
			else
				$this->pembayar->setFormValue($val);
		}

		// Check field name 'peruntukan' first before field var 'x_peruntukan'
		$val = $CurrentForm->hasValue("peruntukan") ? $CurrentForm->getValue("peruntukan") : $CurrentForm->getValue("x_peruntukan");
		if (!$this->peruntukan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->peruntukan->Visible = FALSE; // Disable update for API request
			else
				$this->peruntukan->setFormValue($val);
		}

		// Check field name 'penerima' first before field var 'x_penerima'
		$val = $CurrentForm->hasValue("penerima") ? $CurrentForm->getValue("penerima") : $CurrentForm->getValue("x_penerima");
		if (!$this->penerima->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->penerima->Visible = FALSE; // Disable update for API request
			else
				$this->penerima->setFormValue($val);
		}

		// Check field name 'rek_penerima' first before field var 'x_rek_penerima'
		$val = $CurrentForm->hasValue("rek_penerima") ? $CurrentForm->getValue("rek_penerima") : $CurrentForm->getValue("x_rek_penerima");
		if (!$this->rek_penerima->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->rek_penerima->Visible = FALSE; // Disable update for API request
			else
				$this->rek_penerima->setFormValue($val);
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

		// Check field name 'total_terima' first before field var 'x_total_terima'
		$val = $CurrentForm->hasValue("total_terima") ? $CurrentForm->getValue("total_terima") : $CurrentForm->getValue("x_total_terima");
		if (!$this->total_terima->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->total_terima->Visible = FALSE; // Disable update for API request
			else
				$this->total_terima->setFormValue($val);
		}

		// Check field name 'tgl_tgjb' first before field var 'x_tgl_tgjb'
		$val = $CurrentForm->hasValue("tgl_tgjb") ? $CurrentForm->getValue("tgl_tgjb") : $CurrentForm->getValue("x_tgl_tgjb");
		if (!$this->tgl_tgjb->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tgl_tgjb->Visible = FALSE; // Disable update for API request
			else
				$this->tgl_tgjb->setFormValue($val);
			$this->tgl_tgjb->CurrentValue = UnFormatDateTime($this->tgl_tgjb->CurrentValue, 0);
		}

		// Check field name 'jumlah_tgjb' first before field var 'x_jumlah_tgjb'
		$val = $CurrentForm->hasValue("jumlah_tgjb") ? $CurrentForm->getValue("jumlah_tgjb") : $CurrentForm->getValue("x_jumlah_tgjb");
		if (!$this->jumlah_tgjb->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jumlah_tgjb->Visible = FALSE; // Disable update for API request
			else
				$this->jumlah_tgjb->setFormValue($val);
		}

		// Check field name 'jenis' first before field var 'x_jenis'
		$val = $CurrentForm->hasValue("jenis") ? $CurrentForm->getValue("jenis") : $CurrentForm->getValue("x_jenis");
		if (!$this->jenis->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->jenis->Visible = FALSE; // Disable update for API request
			else
				$this->jenis->setFormValue($val);
		}

		// Check field name 'disetujui' first before field var 'x_disetujui'
		$val = $CurrentForm->hasValue("disetujui") ? $CurrentForm->getValue("disetujui") : $CurrentForm->getValue("x_disetujui");
		if (!$this->disetujui->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->disetujui->Visible = FALSE; // Disable update for API request
			else
				$this->disetujui->setFormValue($val);
		}

		// Check field name 'status' first before field var 'x_status'
		$val = $CurrentForm->hasValue("status") ? $CurrentForm->getValue("status") : $CurrentForm->getValue("x_status");
		if (!$this->status->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->status->Visible = FALSE; // Disable update for API request
			else
				$this->status->setFormValue($val);
		}

		// Check field name 'keterangan' first before field var 'x_keterangan'
		$val = $CurrentForm->hasValue("keterangan") ? $CurrentForm->getValue("keterangan") : $CurrentForm->getValue("x_keterangan");
		if (!$this->keterangan->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->keterangan->Visible = FALSE; // Disable update for API request
			else
				$this->keterangan->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->tgl->CurrentValue = $this->tgl->FormValue;
		$this->tgl->CurrentValue = UnFormatDateTime($this->tgl->CurrentValue, 0);
		$this->pembayar->CurrentValue = $this->pembayar->FormValue;
		$this->peruntukan->CurrentValue = $this->peruntukan->FormValue;
		$this->penerima->CurrentValue = $this->penerima->FormValue;
		$this->rek_penerima->CurrentValue = $this->rek_penerima->FormValue;
		$this->tgl_terima->CurrentValue = $this->tgl_terima->FormValue;
		$this->tgl_terima->CurrentValue = UnFormatDateTime($this->tgl_terima->CurrentValue, 0);
		$this->total_terima->CurrentValue = $this->total_terima->FormValue;
		$this->tgl_tgjb->CurrentValue = $this->tgl_tgjb->FormValue;
		$this->tgl_tgjb->CurrentValue = UnFormatDateTime($this->tgl_tgjb->CurrentValue, 0);
		$this->jumlah_tgjb->CurrentValue = $this->jumlah_tgjb->FormValue;
		$this->jenis->CurrentValue = $this->jenis->FormValue;
		$this->disetujui->CurrentValue = $this->disetujui->FormValue;
		$this->status->CurrentValue = $this->status->FormValue;
		$this->keterangan->CurrentValue = $this->keterangan->FormValue;
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
		$this->tgl->setDbValue($row['tgl']);
		$this->pembayar->setDbValue($row['pembayar']);
		$this->peruntukan->setDbValue($row['peruntukan']);
		$this->penerima->setDbValue($row['penerima']);
		$this->rek_penerima->setDbValue($row['rek_penerima']);
		$this->tgl_terima->setDbValue($row['tgl_terima']);
		$this->total_terima->setDbValue($row['total_terima']);
		$this->tgl_tgjb->setDbValue($row['tgl_tgjb']);
		$this->jumlah_tgjb->setDbValue($row['jumlah_tgjb']);
		$this->jenis->setDbValue($row['jenis']);
		$this->bukti1->Upload->DbValue = $row['bukti1'];
		$this->bukti1->setDbValue($this->bukti1->Upload->DbValue);
		$this->bukti2->Upload->DbValue = $row['bukti2'];
		$this->bukti2->setDbValue($this->bukti2->Upload->DbValue);
		$this->bukti3->Upload->DbValue = $row['bukti3'];
		$this->bukti3->setDbValue($this->bukti3->Upload->DbValue);
		$this->bukti4->Upload->DbValue = $row['bukti4'];
		$this->bukti4->setDbValue($this->bukti4->Upload->DbValue);
		$this->disetujui->setDbValue($row['disetujui']);
		$this->status->setDbValue($row['status']);
		$this->keterangan->setDbValue($row['keterangan']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id'] = NULL;
		$row['tgl'] = NULL;
		$row['pembayar'] = NULL;
		$row['peruntukan'] = NULL;
		$row['penerima'] = NULL;
		$row['rek_penerima'] = NULL;
		$row['tgl_terima'] = NULL;
		$row['total_terima'] = NULL;
		$row['tgl_tgjb'] = NULL;
		$row['jumlah_tgjb'] = NULL;
		$row['jenis'] = NULL;
		$row['bukti1'] = NULL;
		$row['bukti2'] = NULL;
		$row['bukti3'] = NULL;
		$row['bukti4'] = NULL;
		$row['disetujui'] = NULL;
		$row['status'] = NULL;
		$row['keterangan'] = NULL;
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
		// tgl
		// pembayar
		// peruntukan
		// penerima
		// rek_penerima
		// tgl_terima
		// total_terima
		// tgl_tgjb
		// jumlah_tgjb
		// jenis
		// bukti1
		// bukti2
		// bukti3
		// bukti4
		// disetujui
		// status
		// keterangan

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id
			$this->id->ViewValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// tgl
			$this->tgl->ViewValue = $this->tgl->CurrentValue;
			$this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, 0);
			$this->tgl->ViewCustomAttributes = "";

			// pembayar
			$this->pembayar->ViewValue = $this->pembayar->CurrentValue;
			$this->pembayar->ViewValue = FormatNumber($this->pembayar->ViewValue, 0, -2, -2, -2);
			$this->pembayar->ViewCustomAttributes = "";

			// peruntukan
			$this->peruntukan->ViewValue = $this->peruntukan->CurrentValue;
			$this->peruntukan->ViewCustomAttributes = "";

			// penerima
			$this->penerima->ViewValue = $this->penerima->CurrentValue;
			$this->penerima->ViewValue = FormatNumber($this->penerima->ViewValue, 0, -2, -2, -2);
			$this->penerima->ViewCustomAttributes = "";

			// rek_penerima
			$this->rek_penerima->ViewValue = $this->rek_penerima->CurrentValue;
			$this->rek_penerima->ViewCustomAttributes = "";

			// tgl_terima
			$this->tgl_terima->ViewValue = $this->tgl_terima->CurrentValue;
			$this->tgl_terima->ViewValue = FormatDateTime($this->tgl_terima->ViewValue, 0);
			$this->tgl_terima->ViewCustomAttributes = "";

			// total_terima
			$this->total_terima->ViewValue = $this->total_terima->CurrentValue;
			$this->total_terima->ViewValue = FormatNumber($this->total_terima->ViewValue, 0, -2, -2, -2);
			$this->total_terima->ViewCustomAttributes = "";

			// tgl_tgjb
			$this->tgl_tgjb->ViewValue = $this->tgl_tgjb->CurrentValue;
			$this->tgl_tgjb->ViewValue = FormatDateTime($this->tgl_tgjb->ViewValue, 0);
			$this->tgl_tgjb->ViewCustomAttributes = "";

			// jumlah_tgjb
			$this->jumlah_tgjb->ViewValue = $this->jumlah_tgjb->CurrentValue;
			$this->jumlah_tgjb->ViewValue = FormatNumber($this->jumlah_tgjb->ViewValue, 0, -2, -2, -2);
			$this->jumlah_tgjb->ViewCustomAttributes = "";

			// jenis
			$this->jenis->ViewValue = $this->jenis->CurrentValue;
			$this->jenis->ViewCustomAttributes = "";

			// bukti1
			if (!EmptyValue($this->bukti1->Upload->DbValue)) {
				$this->bukti1->ViewValue = $this->bukti1->Upload->DbValue;
			} else {
				$this->bukti1->ViewValue = "";
			}
			$this->bukti1->ViewCustomAttributes = "";

			// bukti2
			if (!EmptyValue($this->bukti2->Upload->DbValue)) {
				$this->bukti2->ViewValue = $this->bukti2->Upload->DbValue;
			} else {
				$this->bukti2->ViewValue = "";
			}
			$this->bukti2->ViewCustomAttributes = "";

			// bukti3
			if (!EmptyValue($this->bukti3->Upload->DbValue)) {
				$this->bukti3->ViewValue = $this->bukti3->Upload->DbValue;
			} else {
				$this->bukti3->ViewValue = "";
			}
			$this->bukti3->ViewCustomAttributes = "";

			// bukti4
			if (!EmptyValue($this->bukti4->Upload->DbValue)) {
				$this->bukti4->ViewValue = $this->bukti4->Upload->DbValue;
			} else {
				$this->bukti4->ViewValue = "";
			}
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

			// status
			$this->status->ViewValue = $this->status->CurrentValue;
			$this->status->ViewCustomAttributes = "";

			// keterangan
			$this->keterangan->ViewValue = $this->keterangan->CurrentValue;
			$this->keterangan->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// tgl
			$this->tgl->LinkCustomAttributes = "";
			$this->tgl->HrefValue = "";
			$this->tgl->TooltipValue = "";

			// pembayar
			$this->pembayar->LinkCustomAttributes = "";
			$this->pembayar->HrefValue = "";
			$this->pembayar->TooltipValue = "";

			// peruntukan
			$this->peruntukan->LinkCustomAttributes = "";
			$this->peruntukan->HrefValue = "";
			$this->peruntukan->TooltipValue = "";

			// penerima
			$this->penerima->LinkCustomAttributes = "";
			$this->penerima->HrefValue = "";
			$this->penerima->TooltipValue = "";

			// rek_penerima
			$this->rek_penerima->LinkCustomAttributes = "";
			$this->rek_penerima->HrefValue = "";
			$this->rek_penerima->TooltipValue = "";

			// tgl_terima
			$this->tgl_terima->LinkCustomAttributes = "";
			$this->tgl_terima->HrefValue = "";
			$this->tgl_terima->TooltipValue = "";

			// total_terima
			$this->total_terima->LinkCustomAttributes = "";
			$this->total_terima->HrefValue = "";
			$this->total_terima->TooltipValue = "";

			// tgl_tgjb
			$this->tgl_tgjb->LinkCustomAttributes = "";
			$this->tgl_tgjb->HrefValue = "";
			$this->tgl_tgjb->TooltipValue = "";

			// jumlah_tgjb
			$this->jumlah_tgjb->LinkCustomAttributes = "";
			$this->jumlah_tgjb->HrefValue = "";
			$this->jumlah_tgjb->TooltipValue = "";

			// jenis
			$this->jenis->LinkCustomAttributes = "";
			$this->jenis->HrefValue = "";
			$this->jenis->TooltipValue = "";

			// bukti1
			$this->bukti1->LinkCustomAttributes = "";
			$this->bukti1->HrefValue = "";
			$this->bukti1->ExportHrefValue = $this->bukti1->UploadPath . $this->bukti1->Upload->DbValue;
			$this->bukti1->TooltipValue = "";

			// bukti2
			$this->bukti2->LinkCustomAttributes = "";
			$this->bukti2->HrefValue = "";
			$this->bukti2->ExportHrefValue = $this->bukti2->UploadPath . $this->bukti2->Upload->DbValue;
			$this->bukti2->TooltipValue = "";

			// bukti3
			$this->bukti3->LinkCustomAttributes = "";
			$this->bukti3->HrefValue = "";
			$this->bukti3->ExportHrefValue = $this->bukti3->UploadPath . $this->bukti3->Upload->DbValue;
			$this->bukti3->TooltipValue = "";

			// bukti4
			$this->bukti4->LinkCustomAttributes = "";
			$this->bukti4->HrefValue = "";
			$this->bukti4->ExportHrefValue = $this->bukti4->UploadPath . $this->bukti4->Upload->DbValue;
			$this->bukti4->TooltipValue = "";

			// disetujui
			$this->disetujui->LinkCustomAttributes = "";
			$this->disetujui->HrefValue = "";
			$this->disetujui->TooltipValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";
			$this->keterangan->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// tgl
			$this->tgl->EditAttrs["class"] = "form-control";
			$this->tgl->EditCustomAttributes = "";
			$this->tgl->EditValue = HtmlEncode(FormatDateTime($this->tgl->CurrentValue, 8));
			$this->tgl->PlaceHolder = RemoveHtml($this->tgl->caption());

			// pembayar
			$this->pembayar->EditAttrs["class"] = "form-control";
			$this->pembayar->EditCustomAttributes = "";
			$this->pembayar->EditValue = HtmlEncode($this->pembayar->CurrentValue);
			$this->pembayar->PlaceHolder = RemoveHtml($this->pembayar->caption());

			// peruntukan
			$this->peruntukan->EditAttrs["class"] = "form-control";
			$this->peruntukan->EditCustomAttributes = "";
			if (!$this->peruntukan->Raw)
				$this->peruntukan->CurrentValue = HtmlDecode($this->peruntukan->CurrentValue);
			$this->peruntukan->EditValue = HtmlEncode($this->peruntukan->CurrentValue);
			$this->peruntukan->PlaceHolder = RemoveHtml($this->peruntukan->caption());

			// penerima
			$this->penerima->EditAttrs["class"] = "form-control";
			$this->penerima->EditCustomAttributes = "";
			$this->penerima->EditValue = HtmlEncode($this->penerima->CurrentValue);
			$this->penerima->PlaceHolder = RemoveHtml($this->penerima->caption());

			// rek_penerima
			$this->rek_penerima->EditAttrs["class"] = "form-control";
			$this->rek_penerima->EditCustomAttributes = "";
			if (!$this->rek_penerima->Raw)
				$this->rek_penerima->CurrentValue = HtmlDecode($this->rek_penerima->CurrentValue);
			$this->rek_penerima->EditValue = HtmlEncode($this->rek_penerima->CurrentValue);
			$this->rek_penerima->PlaceHolder = RemoveHtml($this->rek_penerima->caption());

			// tgl_terima
			$this->tgl_terima->EditAttrs["class"] = "form-control";
			$this->tgl_terima->EditCustomAttributes = "";
			$this->tgl_terima->EditValue = HtmlEncode(FormatDateTime($this->tgl_terima->CurrentValue, 8));
			$this->tgl_terima->PlaceHolder = RemoveHtml($this->tgl_terima->caption());

			// total_terima
			$this->total_terima->EditAttrs["class"] = "form-control";
			$this->total_terima->EditCustomAttributes = "";
			$this->total_terima->EditValue = HtmlEncode($this->total_terima->CurrentValue);
			$this->total_terima->PlaceHolder = RemoveHtml($this->total_terima->caption());

			// tgl_tgjb
			$this->tgl_tgjb->EditAttrs["class"] = "form-control";
			$this->tgl_tgjb->EditCustomAttributes = "";
			$this->tgl_tgjb->EditValue = HtmlEncode(FormatDateTime($this->tgl_tgjb->CurrentValue, 8));
			$this->tgl_tgjb->PlaceHolder = RemoveHtml($this->tgl_tgjb->caption());

			// jumlah_tgjb
			$this->jumlah_tgjb->EditAttrs["class"] = "form-control";
			$this->jumlah_tgjb->EditCustomAttributes = "";
			$this->jumlah_tgjb->EditValue = HtmlEncode($this->jumlah_tgjb->CurrentValue);
			$this->jumlah_tgjb->PlaceHolder = RemoveHtml($this->jumlah_tgjb->caption());

			// jenis
			$this->jenis->EditAttrs["class"] = "form-control";
			$this->jenis->EditCustomAttributes = "";
			if (!$this->jenis->Raw)
				$this->jenis->CurrentValue = HtmlDecode($this->jenis->CurrentValue);
			$this->jenis->EditValue = HtmlEncode($this->jenis->CurrentValue);
			$this->jenis->PlaceHolder = RemoveHtml($this->jenis->caption());

			// bukti1
			$this->bukti1->EditAttrs["class"] = "form-control";
			$this->bukti1->EditCustomAttributes = "";
			if (!EmptyValue($this->bukti1->Upload->DbValue)) {
				$this->bukti1->EditValue = $this->bukti1->Upload->DbValue;
			} else {
				$this->bukti1->EditValue = "";
			}
			if (!EmptyValue($this->bukti1->CurrentValue))
					$this->bukti1->Upload->FileName = $this->bukti1->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->bukti1);

			// bukti2
			$this->bukti2->EditAttrs["class"] = "form-control";
			$this->bukti2->EditCustomAttributes = "";
			if (!EmptyValue($this->bukti2->Upload->DbValue)) {
				$this->bukti2->EditValue = $this->bukti2->Upload->DbValue;
			} else {
				$this->bukti2->EditValue = "";
			}
			if (!EmptyValue($this->bukti2->CurrentValue))
					$this->bukti2->Upload->FileName = $this->bukti2->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->bukti2);

			// bukti3
			$this->bukti3->EditAttrs["class"] = "form-control";
			$this->bukti3->EditCustomAttributes = "";
			if (!EmptyValue($this->bukti3->Upload->DbValue)) {
				$this->bukti3->EditValue = $this->bukti3->Upload->DbValue;
			} else {
				$this->bukti3->EditValue = "";
			}
			if (!EmptyValue($this->bukti3->CurrentValue))
					$this->bukti3->Upload->FileName = $this->bukti3->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->bukti3);

			// bukti4
			$this->bukti4->EditAttrs["class"] = "form-control";
			$this->bukti4->EditCustomAttributes = "";
			if (!EmptyValue($this->bukti4->Upload->DbValue)) {
				$this->bukti4->EditValue = $this->bukti4->Upload->DbValue;
			} else {
				$this->bukti4->EditValue = "";
			}
			if (!EmptyValue($this->bukti4->CurrentValue))
					$this->bukti4->Upload->FileName = $this->bukti4->CurrentValue;
			if ($this->isShow())
				RenderUploadField($this->bukti4);

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

			// status
			$this->status->EditAttrs["class"] = "form-control";
			$this->status->EditCustomAttributes = "";
			if (!$this->status->Raw)
				$this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
			$this->status->EditValue = HtmlEncode($this->status->CurrentValue);
			$this->status->PlaceHolder = RemoveHtml($this->status->caption());

			// keterangan
			$this->keterangan->EditAttrs["class"] = "form-control";
			$this->keterangan->EditCustomAttributes = "";
			$this->keterangan->EditValue = HtmlEncode($this->keterangan->CurrentValue);
			$this->keterangan->PlaceHolder = RemoveHtml($this->keterangan->caption());

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// tgl
			$this->tgl->LinkCustomAttributes = "";
			$this->tgl->HrefValue = "";

			// pembayar
			$this->pembayar->LinkCustomAttributes = "";
			$this->pembayar->HrefValue = "";

			// peruntukan
			$this->peruntukan->LinkCustomAttributes = "";
			$this->peruntukan->HrefValue = "";

			// penerima
			$this->penerima->LinkCustomAttributes = "";
			$this->penerima->HrefValue = "";

			// rek_penerima
			$this->rek_penerima->LinkCustomAttributes = "";
			$this->rek_penerima->HrefValue = "";

			// tgl_terima
			$this->tgl_terima->LinkCustomAttributes = "";
			$this->tgl_terima->HrefValue = "";

			// total_terima
			$this->total_terima->LinkCustomAttributes = "";
			$this->total_terima->HrefValue = "";

			// tgl_tgjb
			$this->tgl_tgjb->LinkCustomAttributes = "";
			$this->tgl_tgjb->HrefValue = "";

			// jumlah_tgjb
			$this->jumlah_tgjb->LinkCustomAttributes = "";
			$this->jumlah_tgjb->HrefValue = "";

			// jenis
			$this->jenis->LinkCustomAttributes = "";
			$this->jenis->HrefValue = "";

			// bukti1
			$this->bukti1->LinkCustomAttributes = "";
			$this->bukti1->HrefValue = "";
			$this->bukti1->ExportHrefValue = $this->bukti1->UploadPath . $this->bukti1->Upload->DbValue;

			// bukti2
			$this->bukti2->LinkCustomAttributes = "";
			$this->bukti2->HrefValue = "";
			$this->bukti2->ExportHrefValue = $this->bukti2->UploadPath . $this->bukti2->Upload->DbValue;

			// bukti3
			$this->bukti3->LinkCustomAttributes = "";
			$this->bukti3->HrefValue = "";
			$this->bukti3->ExportHrefValue = $this->bukti3->UploadPath . $this->bukti3->Upload->DbValue;

			// bukti4
			$this->bukti4->LinkCustomAttributes = "";
			$this->bukti4->HrefValue = "";
			$this->bukti4->ExportHrefValue = $this->bukti4->UploadPath . $this->bukti4->Upload->DbValue;

			// disetujui
			$this->disetujui->LinkCustomAttributes = "";
			$this->disetujui->HrefValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";

			// keterangan
			$this->keterangan->LinkCustomAttributes = "";
			$this->keterangan->HrefValue = "";
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
		if ($this->tgl->Required) {
			if (!$this->tgl->IsDetailKey && $this->tgl->FormValue != NULL && $this->tgl->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl->caption(), $this->tgl->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl->FormValue)) {
			AddMessage($FormError, $this->tgl->errorMessage());
		}
		if ($this->pembayar->Required) {
			if (!$this->pembayar->IsDetailKey && $this->pembayar->FormValue != NULL && $this->pembayar->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->pembayar->caption(), $this->pembayar->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->pembayar->FormValue)) {
			AddMessage($FormError, $this->pembayar->errorMessage());
		}
		if ($this->peruntukan->Required) {
			if (!$this->peruntukan->IsDetailKey && $this->peruntukan->FormValue != NULL && $this->peruntukan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->peruntukan->caption(), $this->peruntukan->RequiredErrorMessage));
			}
		}
		if ($this->penerima->Required) {
			if (!$this->penerima->IsDetailKey && $this->penerima->FormValue != NULL && $this->penerima->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->penerima->caption(), $this->penerima->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->penerima->FormValue)) {
			AddMessage($FormError, $this->penerima->errorMessage());
		}
		if ($this->rek_penerima->Required) {
			if (!$this->rek_penerima->IsDetailKey && $this->rek_penerima->FormValue != NULL && $this->rek_penerima->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->rek_penerima->caption(), $this->rek_penerima->RequiredErrorMessage));
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
		if ($this->total_terima->Required) {
			if (!$this->total_terima->IsDetailKey && $this->total_terima->FormValue != NULL && $this->total_terima->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->total_terima->caption(), $this->total_terima->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->total_terima->FormValue)) {
			AddMessage($FormError, $this->total_terima->errorMessage());
		}
		if ($this->tgl_tgjb->Required) {
			if (!$this->tgl_tgjb->IsDetailKey && $this->tgl_tgjb->FormValue != NULL && $this->tgl_tgjb->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tgl_tgjb->caption(), $this->tgl_tgjb->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->tgl_tgjb->FormValue)) {
			AddMessage($FormError, $this->tgl_tgjb->errorMessage());
		}
		if ($this->jumlah_tgjb->Required) {
			if (!$this->jumlah_tgjb->IsDetailKey && $this->jumlah_tgjb->FormValue != NULL && $this->jumlah_tgjb->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jumlah_tgjb->caption(), $this->jumlah_tgjb->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->jumlah_tgjb->FormValue)) {
			AddMessage($FormError, $this->jumlah_tgjb->errorMessage());
		}
		if ($this->jenis->Required) {
			if (!$this->jenis->IsDetailKey && $this->jenis->FormValue != NULL && $this->jenis->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->jenis->caption(), $this->jenis->RequiredErrorMessage));
			}
		}
		if ($this->bukti1->Required) {
			if ($this->bukti1->Upload->FileName == "" && !$this->bukti1->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->bukti1->caption(), $this->bukti1->RequiredErrorMessage));
			}
		}
		if ($this->bukti2->Required) {
			if ($this->bukti2->Upload->FileName == "" && !$this->bukti2->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->bukti2->caption(), $this->bukti2->RequiredErrorMessage));
			}
		}
		if ($this->bukti3->Required) {
			if ($this->bukti3->Upload->FileName == "" && !$this->bukti3->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->bukti3->caption(), $this->bukti3->RequiredErrorMessage));
			}
		}
		if ($this->bukti4->Required) {
			if ($this->bukti4->Upload->FileName == "" && !$this->bukti4->Upload->KeepFile) {
				AddMessage($FormError, str_replace("%s", $this->bukti4->caption(), $this->bukti4->RequiredErrorMessage));
			}
		}
		if ($this->disetujui->Required) {
			if ($this->disetujui->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->disetujui->caption(), $this->disetujui->RequiredErrorMessage));
			}
		}
		if ($this->status->Required) {
			if (!$this->status->IsDetailKey && $this->status->FormValue != NULL && $this->status->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->status->caption(), $this->status->RequiredErrorMessage));
			}
		}
		if ($this->keterangan->Required) {
			if (!$this->keterangan->IsDetailKey && $this->keterangan->FormValue != NULL && $this->keterangan->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->keterangan->caption(), $this->keterangan->RequiredErrorMessage));
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

			// tgl
			$this->tgl->setDbValueDef($rsnew, UnFormatDateTime($this->tgl->CurrentValue, 0), NULL, $this->tgl->ReadOnly);

			// pembayar
			$this->pembayar->setDbValueDef($rsnew, $this->pembayar->CurrentValue, NULL, $this->pembayar->ReadOnly);

			// peruntukan
			$this->peruntukan->setDbValueDef($rsnew, $this->peruntukan->CurrentValue, NULL, $this->peruntukan->ReadOnly);

			// penerima
			$this->penerima->setDbValueDef($rsnew, $this->penerima->CurrentValue, NULL, $this->penerima->ReadOnly);

			// rek_penerima
			$this->rek_penerima->setDbValueDef($rsnew, $this->rek_penerima->CurrentValue, NULL, $this->rek_penerima->ReadOnly);

			// tgl_terima
			$this->tgl_terima->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_terima->CurrentValue, 0), NULL, $this->tgl_terima->ReadOnly);

			// total_terima
			$this->total_terima->setDbValueDef($rsnew, $this->total_terima->CurrentValue, NULL, $this->total_terima->ReadOnly);

			// tgl_tgjb
			$this->tgl_tgjb->setDbValueDef($rsnew, UnFormatDateTime($this->tgl_tgjb->CurrentValue, 0), NULL, $this->tgl_tgjb->ReadOnly);

			// jumlah_tgjb
			$this->jumlah_tgjb->setDbValueDef($rsnew, $this->jumlah_tgjb->CurrentValue, NULL, $this->jumlah_tgjb->ReadOnly);

			// jenis
			$this->jenis->setDbValueDef($rsnew, $this->jenis->CurrentValue, NULL, $this->jenis->ReadOnly);

			// bukti1
			if ($this->bukti1->Visible && !$this->bukti1->ReadOnly && !$this->bukti1->Upload->KeepFile) {
				$this->bukti1->Upload->DbValue = $rsold['bukti1']; // Get original value
				if ($this->bukti1->Upload->FileName == "") {
					$rsnew['bukti1'] = NULL;
				} else {
					$rsnew['bukti1'] = $this->bukti1->Upload->FileName;
				}
			}

			// bukti2
			if ($this->bukti2->Visible && !$this->bukti2->ReadOnly && !$this->bukti2->Upload->KeepFile) {
				$this->bukti2->Upload->DbValue = $rsold['bukti2']; // Get original value
				if ($this->bukti2->Upload->FileName == "") {
					$rsnew['bukti2'] = NULL;
				} else {
					$rsnew['bukti2'] = $this->bukti2->Upload->FileName;
				}
			}

			// bukti3
			if ($this->bukti3->Visible && !$this->bukti3->ReadOnly && !$this->bukti3->Upload->KeepFile) {
				$this->bukti3->Upload->DbValue = $rsold['bukti3']; // Get original value
				if ($this->bukti3->Upload->FileName == "") {
					$rsnew['bukti3'] = NULL;
				} else {
					$rsnew['bukti3'] = $this->bukti3->Upload->FileName;
				}
			}

			// bukti4
			if ($this->bukti4->Visible && !$this->bukti4->ReadOnly && !$this->bukti4->Upload->KeepFile) {
				$this->bukti4->Upload->DbValue = $rsold['bukti4']; // Get original value
				if ($this->bukti4->Upload->FileName == "") {
					$rsnew['bukti4'] = NULL;
				} else {
					$rsnew['bukti4'] = $this->bukti4->Upload->FileName;
				}
			}

			// disetujui
			$this->disetujui->setDbValueDef($rsnew, $this->disetujui->CurrentValue, NULL, $this->disetujui->ReadOnly);

			// status
			$this->status->setDbValueDef($rsnew, $this->status->CurrentValue, NULL, $this->status->ReadOnly);

			// keterangan
			$this->keterangan->setDbValueDef($rsnew, $this->keterangan->CurrentValue, NULL, $this->keterangan->ReadOnly);
			if ($this->bukti1->Visible && !$this->bukti1->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->bukti1->Upload->DbValue) ? [] : [$this->bukti1->htmlDecode($this->bukti1->Upload->DbValue)];
				if (!EmptyValue($this->bukti1->Upload->FileName)) {
					$newFiles = [$this->bukti1->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->bukti1, $this->bukti1->Upload->Index);
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
								$file1 = UniqueFilename($this->bukti1->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->bukti1->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->bukti1->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->bukti1->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->bukti1->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->bukti1->setDbValueDef($rsnew, $this->bukti1->Upload->FileName, NULL, $this->bukti1->ReadOnly);
				}
			}
			if ($this->bukti2->Visible && !$this->bukti2->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->bukti2->Upload->DbValue) ? [] : [$this->bukti2->htmlDecode($this->bukti2->Upload->DbValue)];
				if (!EmptyValue($this->bukti2->Upload->FileName)) {
					$newFiles = [$this->bukti2->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->bukti2, $this->bukti2->Upload->Index);
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
								$file1 = UniqueFilename($this->bukti2->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->bukti2->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->bukti2->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->bukti2->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->bukti2->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->bukti2->setDbValueDef($rsnew, $this->bukti2->Upload->FileName, NULL, $this->bukti2->ReadOnly);
				}
			}
			if ($this->bukti3->Visible && !$this->bukti3->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->bukti3->Upload->DbValue) ? [] : [$this->bukti3->htmlDecode($this->bukti3->Upload->DbValue)];
				if (!EmptyValue($this->bukti3->Upload->FileName)) {
					$newFiles = [$this->bukti3->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->bukti3, $this->bukti3->Upload->Index);
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
								$file1 = UniqueFilename($this->bukti3->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->bukti3->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->bukti3->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->bukti3->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->bukti3->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->bukti3->setDbValueDef($rsnew, $this->bukti3->Upload->FileName, NULL, $this->bukti3->ReadOnly);
				}
			}
			if ($this->bukti4->Visible && !$this->bukti4->Upload->KeepFile) {
				$oldFiles = EmptyValue($this->bukti4->Upload->DbValue) ? [] : [$this->bukti4->htmlDecode($this->bukti4->Upload->DbValue)];
				if (!EmptyValue($this->bukti4->Upload->FileName)) {
					$newFiles = [$this->bukti4->Upload->FileName];
					$NewFileCount = count($newFiles);
					for ($i = 0; $i < $NewFileCount; $i++) {
						if ($newFiles[$i] != "") {
							$file = $newFiles[$i];
							$tempPath = UploadTempPath($this->bukti4, $this->bukti4->Upload->Index);
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
								$file1 = UniqueFilename($this->bukti4->physicalUploadPath(), $file); // Get new file name
								if ($file1 != $file) { // Rename temp file
									while (file_exists($tempPath . $file1) || file_exists($this->bukti4->physicalUploadPath() . $file1)) // Make sure no file name clash
										$file1 = UniqueFilename($this->bukti4->physicalUploadPath(), $file1, TRUE); // Use indexed name
									rename($tempPath . $file, $tempPath . $file1);
									$newFiles[$i] = $file1;
								}
							}
						}
					}
					$this->bukti4->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
					$this->bukti4->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
					$this->bukti4->setDbValueDef($rsnew, $this->bukti4->Upload->FileName, NULL, $this->bukti4->ReadOnly);
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
					if ($this->bukti1->Visible && !$this->bukti1->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->bukti1->Upload->DbValue) ? [] : [$this->bukti1->htmlDecode($this->bukti1->Upload->DbValue)];
						if (!EmptyValue($this->bukti1->Upload->FileName)) {
							$newFiles = [$this->bukti1->Upload->FileName];
							$newFiles2 = [$this->bukti1->htmlDecode($rsnew['bukti1'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->bukti1, $this->bukti1->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->bukti1->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->bukti1->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->bukti2->Visible && !$this->bukti2->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->bukti2->Upload->DbValue) ? [] : [$this->bukti2->htmlDecode($this->bukti2->Upload->DbValue)];
						if (!EmptyValue($this->bukti2->Upload->FileName)) {
							$newFiles = [$this->bukti2->Upload->FileName];
							$newFiles2 = [$this->bukti2->htmlDecode($rsnew['bukti2'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->bukti2, $this->bukti2->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->bukti2->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->bukti2->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->bukti3->Visible && !$this->bukti3->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->bukti3->Upload->DbValue) ? [] : [$this->bukti3->htmlDecode($this->bukti3->Upload->DbValue)];
						if (!EmptyValue($this->bukti3->Upload->FileName)) {
							$newFiles = [$this->bukti3->Upload->FileName];
							$newFiles2 = [$this->bukti3->htmlDecode($rsnew['bukti3'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->bukti3, $this->bukti3->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->bukti3->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->bukti3->oldPhysicalUploadPath() . $oldFile);
							}
						}
					}
					if ($this->bukti4->Visible && !$this->bukti4->Upload->KeepFile) {
						$oldFiles = EmptyValue($this->bukti4->Upload->DbValue) ? [] : [$this->bukti4->htmlDecode($this->bukti4->Upload->DbValue)];
						if (!EmptyValue($this->bukti4->Upload->FileName)) {
							$newFiles = [$this->bukti4->Upload->FileName];
							$newFiles2 = [$this->bukti4->htmlDecode($rsnew['bukti4'])];
							$newFileCount = count($newFiles);
							for ($i = 0; $i < $newFileCount; $i++) {
								if ($newFiles[$i] != "") {
									$file = UploadTempPath($this->bukti4, $this->bukti4->Upload->Index) . $newFiles[$i];
									if (file_exists($file)) {
										if (@$newFiles2[$i] != "") // Use correct file name
											$newFiles[$i] = $newFiles2[$i];
										if (!$this->bukti4->Upload->SaveToFile($newFiles[$i], TRUE, $i)) { // Just replace
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
									@unlink($this->bukti4->oldPhysicalUploadPath() . $oldFile);
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

			// bukti1
			CleanUploadTempPath($this->bukti1, $this->bukti1->Upload->Index);

			// bukti2
			CleanUploadTempPath($this->bukti2, $this->bukti2->Upload->Index);

			// bukti3
			CleanUploadTempPath($this->bukti3, $this->bukti3->Upload->Index);

			// bukti4
			CleanUploadTempPath($this->bukti4, $this->bukti4->Upload->Index);
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("uangmukalist.php"), "", $this->TableVar, TRUE);
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