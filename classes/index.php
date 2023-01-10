<?php
namespace PHPMaker2020\sigap;

/**
 * Class for index
 */
class index
{

	// Project ID
	public $ProjectID = "{3C64794E-EF73-47B1-9AB0-F3ADB03E5E03}";

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

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken;

	// Constructor
	public function __construct() {
		$this->CheckToken = Config("CHECK_TOKEN");
	}

	// Terminate page
	public function terminate($url = "")
	{

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Page Redirecting event
		$this->Page_Redirecting($url);

		// Go to URL if specified
		if ($url != "") {
			SaveDebugMessage();
			AddHeader("Location", $url);
		}
		exit();
	}

	//
	// Page run
	//

	public function run()
	{
		global $Language, $UserProfile, $Security, $Breadcrumb;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// User profile
		$UserProfile = new UserProfile();

		// Security object
		$Security = new AdvancedSecurity();
		if (!$Security->isLoggedIn())
			$Security->autoLogin();
		$Security->loadUserLevel(); // Load User Level

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Breadcrumb
		$Breadcrumb = new Breadcrumb();

		// If session expired, show session expired message
		if (Get("expired") == "1")
			$this->setFailureMessage($Language->phrase("SessionExpired"));
		if (!$Security->isLoggedIn())
			$Security->autoLogin();
		$Security->loadUserLevel(); // Load User Level
		if ($Security->allowList(CurrentProjectID() . 'pegawai'))
			$this->terminate("pegawailist.php"); // Exit and go to default page
		if ($Security->allowList(CurrentProjectID() . 'absen'))
			$this->terminate("absenlist.php");
		if ($Security->allowList(CurrentProjectID() . 'absen_detil'))
			$this->terminate("absen_detillist.php");
		if ($Security->allowList(CurrentProjectID() . 'agama'))
			$this->terminate("agamalist.php");
		if ($Security->allowList(CurrentProjectID() . 'audittrail'))
			$this->terminate("audittraillist.php");
		if ($Security->allowList(CurrentProjectID() . 'barang'))
			$this->terminate("baranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'barangnew'))
			$this->terminate("barangnewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'berita'))
			$this->terminate("beritalist.php");
		if ($Security->allowList(CurrentProjectID() . 'bulan'))
			$this->terminate("bulanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'daftarbarang'))
			$this->terminate("daftarbaranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'dinasluar'))
			$this->terminate("dinasluarlist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji'))
			$this->terminate("gajilist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_karyawan_sd'))
			$this->terminate("gaji_karyawan_sdlist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_karyawan_sma'))
			$this->terminate("gaji_karyawan_smalist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_karyawan_smk'))
			$this->terminate("gaji_karyawan_smklist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_karyawan_smp'))
			$this->terminate("gaji_karyawan_smplist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_karyawan_tk'))
			$this->terminate("gaji_karyawan_tklist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_pokok'))
			$this->terminate("gaji_pokoklist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_sma'))
			$this->terminate("gaji_smalist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_smk'))
			$this->terminate("gaji_smklist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_smp'))
			$this->terminate("gaji_smplist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_tk'))
			$this->terminate("gaji_tklist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_tu_sd'))
			$this->terminate("gaji_tu_sdlist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_tu_sma'))
			$this->terminate("gaji_tu_smalist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_tu_smk'))
			$this->terminate("gaji_tu_smklist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_tu_smp'))
			$this->terminate("gaji_tu_smplist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_tu_tk'))
			$this->terminate("gaji_tu_tklist.php");
		if ($Security->allowList(CurrentProjectID() . 'gajisd'))
			$this->terminate("gajisdlist.php");
		if ($Security->allowList(CurrentProjectID() . 'gajisd_detil'))
			$this->terminate("gajisd_detillist.php");
		if ($Security->allowList(CurrentProjectID() . 'gajisma'))
			$this->terminate("gajismalist.php");
		if ($Security->allowList(CurrentProjectID() . 'gajisma_detil'))
			$this->terminate("gajisma_detillist.php");
		if ($Security->allowList(CurrentProjectID() . 'gajismk'))
			$this->terminate("gajismklist.php");
		if ($Security->allowList(CurrentProjectID() . 'gajismk_detil'))
			$this->terminate("gajismk_detillist.php");
		if ($Security->allowList(CurrentProjectID() . 'gajismp'))
			$this->terminate("gajismplist.php");
		if ($Security->allowList(CurrentProjectID() . 'gajismp_detil'))
			$this->terminate("gajismp_detillist.php");
		if ($Security->allowList(CurrentProjectID() . 'gajitk'))
			$this->terminate("gajitklist.php");
		if ($Security->allowList(CurrentProjectID() . 'gajitk_detil'))
			$this->terminate("gajitk_detillist.php");
		if ($Security->allowList(CurrentProjectID() . 'gajitunjangan'))
			$this->terminate("gajitunjanganlist.php");
		if ($Security->allowList(CurrentProjectID() . 'gender'))
			$this->terminate("genderlist.php");
		if ($Security->allowList(CurrentProjectID() . 'hapus_barang'))
			$this->terminate("hapus_baranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'hapus_barangnew'))
			$this->terminate("hapus_barangnewlist.php");
		if ($Security->allowList(CurrentProjectID() . 'ijazah'))
			$this->terminate("ijazahlist.php");
		if ($Security->allowList(CurrentProjectID() . 'ijin'))
			$this->terminate("ijinlist.php");
		if ($Security->allowList(CurrentProjectID() . 'jabatan'))
			$this->terminate("jabatanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'jenis_barang'))
			$this->terminate("jenis_baranglist.php");
		if ($Security->allowList(CurrentProjectID() . 'jenis_dinasluar'))
			$this->terminate("jenis_dinasluarlist.php");
		if ($Security->allowList(CurrentProjectID() . 'jenis_grup_berita'))
			$this->terminate("jenis_grup_beritalist.php");
		if ($Security->allowList(CurrentProjectID() . 'jenis_grup_ilmu'))
			$this->terminate("jenis_grup_ilmulist.php");
		if ($Security->allowList(CurrentProjectID() . 'jenis_ijin'))
			$this->terminate("jenis_ijinlist.php");
		if ($Security->allowList(CurrentProjectID() . 'jenis_lembur'))
			$this->terminate("jenis_lemburlist.php");
		if ($Security->allowList(CurrentProjectID() . 'komentar'))
			$this->terminate("komentarlist.php");
		if ($Security->allowList(CurrentProjectID() . 'lembur'))
			$this->terminate("lemburlist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_karyawan_sd'))
			$this->terminate("m_karyawan_sdlist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_karyawan_sma'))
			$this->terminate("m_karyawan_smalist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_karyawan_smk'))
			$this->terminate("m_karyawan_smklist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_karyawan_smp'))
			$this->terminate("m_karyawan_smplist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_karyawan_tk'))
			$this->terminate("m_karyawan_tklist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_pulangcepat'))
			$this->terminate("m_pulangcepatlist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_sakit'))
			$this->terminate("m_sakitlist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_sd'))
			$this->terminate("m_sdlist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_sma'))
			$this->terminate("m_smalist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_smk'))
			$this->terminate("m_smklist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_smp'))
			$this->terminate("m_smplist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_tidakhadir'))
			$this->terminate("m_tidakhadirlist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_tk'))
			$this->terminate("m_tklist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_tu_sd'))
			$this->terminate("m_tu_sdlist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_tu_sma'))
			$this->terminate("m_tu_smalist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_tu_smk'))
			$this->terminate("m_tu_smklist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_tu_smp'))
			$this->terminate("m_tu_smplist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_tu_tk'))
			$this->terminate("m_tu_tklist.php");
		if ($Security->allowList(CurrentProjectID() . 'mpendidikan'))
			$this->terminate("mpendidikanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'peg_dokumen'))
			$this->terminate("peg_dokumenlist.php");
		if ($Security->allowList(CurrentProjectID() . 'peg_keluarga'))
			$this->terminate("peg_keluargalist.php");
		if ($Security->allowList(CurrentProjectID() . 'peg_skill'))
			$this->terminate("peg_skilllist.php");
		if ($Security->allowList(CurrentProjectID() . 'penempatan'))
			$this->terminate("penempatanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'pengetahuan'))
			$this->terminate("pengetahuanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'potongan_sd'))
			$this->terminate("potongan_sdlist.php");
		if ($Security->allowList(CurrentProjectID() . 'potongan_sma'))
			$this->terminate("potongan_smalist.php");
		if ($Security->allowList(CurrentProjectID() . 'potongan_smk'))
			$this->terminate("potongan_smklist.php");
		if ($Security->allowList(CurrentProjectID() . 'potongan_smp'))
			$this->terminate("potongan_smplist.php");
		if ($Security->allowList(CurrentProjectID() . 'potongan_tk'))
			$this->terminate("potongan_tklist.php");
		if ($Security->allowList(CurrentProjectID() . 'proyek'))
			$this->terminate("proyeklist.php");
		if ($Security->allowList(CurrentProjectID() . 'reimbursh'))
			$this->terminate("reimburshlist.php");
		if ($Security->allowList(CurrentProjectID() . 'setuju'))
			$this->terminate("setujulist.php");
		if ($Security->allowList(CurrentProjectID() . 'terlambat'))
			$this->terminate("terlambatlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tpendidikan'))
			$this->terminate("tpendidikanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'uangmuka'))
			$this->terminate("uangmukalist.php");
		if ($Security->allowList(CurrentProjectID() . 'userlevelpermissions'))
			$this->terminate("userlevelpermissionslist.php");
		if ($Security->allowList(CurrentProjectID() . 'userlevels'))
			$this->terminate("userlevelslist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgaji'))
			$this->terminate("v_totalgajilist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgajikaryawan'))
			$this->terminate("v_totalgajikaryawanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgajikaryawansma'))
			$this->terminate("v_totalgajikaryawansmalist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgajikaryawansmk'))
			$this->terminate("v_totalgajikaryawansmklist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgajikaryawansmp'))
			$this->terminate("v_totalgajikaryawansmplist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgajikaryawantk'))
			$this->terminate("v_totalgajikaryawantklist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgajisma'))
			$this->terminate("v_totalgajismalist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgajismk'))
			$this->terminate("v_totalgajismklist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgajismp'))
			$this->terminate("v_totalgajismplist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgajitk'))
			$this->terminate("v_totalgajitklist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgajitu'))
			$this->terminate("v_totalgajitulist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgajitusma'))
			$this->terminate("v_totalgajitusmalist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgajitusmk'))
			$this->terminate("v_totalgajitusmklist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgajitusmp'))
			$this->terminate("v_totalgajitusmplist.php");
		if ($Security->allowList(CurrentProjectID() . 'v_totalgajitutk'))
			$this->terminate("v_totalgajitutklist.php");
		if ($Security->allowList(CurrentProjectID() . 'tunjangan_tambahan'))
			$this->terminate("tunjangan_tambahanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'jenis_jabatan'))
			$this->terminate("jenis_jabatanlist.php");
		if ($Security->allowList(CurrentProjectID() . 'tunjangan_berkala'))
			$this->terminate("tunjangan_berkalalist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_kehadiran'))
			$this->terminate("m_kehadiranlist.php");
		if ($Security->allowList(CurrentProjectID() . 'gaji_pokok_tu'))
			$this->terminate("gaji_pokok_tulist.php");
		if ($Security->allowList(CurrentProjectID() . 'sertif'))
			$this->terminate("sertiflist.php");
		if ($Security->allowList(CurrentProjectID() . 'tambahan_tugas'))
			$this->terminate("tambahan_tugaslist.php");
		if ($Security->allowList(CurrentProjectID() . 'm_piket'))
			$this->terminate("m_piketlist.php");
		if ($Security->allowList(CurrentProjectID() . 'test_api.php'))
			$this->terminate("test_api.php");
		if ($Security->isLoggedIn()) {
			$this->setFailureMessage(DeniedMessage() . "<br><br><a href=\"logout.php\">" . $Language->phrase("BackToLogin") . "</a>");
		} else {
			$this->terminate("login.php"); // Exit and go to login page
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
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}
}
?>