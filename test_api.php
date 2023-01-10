<?php
namespace PHPMaker2020\sigap;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$test_api = new test_api();

// Run the page
$test_api->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php"; ?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sigap2";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

$ch = curl_init(); 
		// set url 
		curl_setopt($ch, CURLOPT_URL, "36.93.52.108/siakad_demo/sma/api/employee");
		//return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
		$output = curl_exec($ch); 
		$res =json_decode($output);
		
		foreach($res as $data){
			$sql = "INSERT INTO pegawai (id,pid,nama,alamat,email,wa,hp,tgllahir,nip,rekbank,pendidikan,jurusan,agama,jenkel,status,foto,file_cv,jabatan,mulai_bekerja,keterangan,username,password,level,aktif,jenjang_id,type,sertif,lamakerja)
					VALUES (NULL, NULL, '".$data->nama."', '".$data->address."', NULL, '".$data->phone."', '".$data->phone."', NULL, '".$data->nip."', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL,'".$data->masa_kerja."')";

		if (mysqli_query($conn, $sql)) {
			} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}

		mysqli_close($conn);
?>

<?php if (Config("DEBUG")) echo GetDebugMessage(); ?>
<?php include_once "footer.php"; ?>
<?php
$test_api->terminate();
?>