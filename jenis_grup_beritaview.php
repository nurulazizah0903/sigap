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
$jenis_grup_berita_view = new jenis_grup_berita_view();

// Run the page
$jenis_grup_berita_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_grup_berita_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jenis_grup_berita_view->isExport()) { ?>
<script>
var fjenis_grup_beritaview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fjenis_grup_beritaview = currentForm = new ew.Form("fjenis_grup_beritaview", "view");
	loadjs.done("fjenis_grup_beritaview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$jenis_grup_berita_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $jenis_grup_berita_view->ExportOptions->render("body") ?>
<?php $jenis_grup_berita_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $jenis_grup_berita_view->showPageHeader(); ?>
<?php
$jenis_grup_berita_view->showMessage();
?>
<form name="fjenis_grup_beritaview" id="fjenis_grup_beritaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_grup_berita">
<input type="hidden" name="modal" value="<?php echo (int)$jenis_grup_berita_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($jenis_grup_berita_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $jenis_grup_berita_view->TableLeftColumnClass ?>"><span id="elh_jenis_grup_berita_id"><?php echo $jenis_grup_berita_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $jenis_grup_berita_view->id->cellAttributes() ?>>
<span id="el_jenis_grup_berita_id">
<span<?php echo $jenis_grup_berita_view->id->viewAttributes() ?>><?php echo $jenis_grup_berita_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenis_grup_berita_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $jenis_grup_berita_view->TableLeftColumnClass ?>"><span id="elh_jenis_grup_berita_nama"><?php echo $jenis_grup_berita_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $jenis_grup_berita_view->nama->cellAttributes() ?>>
<span id="el_jenis_grup_berita_nama">
<span<?php echo $jenis_grup_berita_view->nama->viewAttributes() ?>><?php echo $jenis_grup_berita_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenis_grup_berita_view->aktif->Visible) { // aktif ?>
	<tr id="r_aktif">
		<td class="<?php echo $jenis_grup_berita_view->TableLeftColumnClass ?>"><span id="elh_jenis_grup_berita_aktif"><?php echo $jenis_grup_berita_view->aktif->caption() ?></span></td>
		<td data-name="aktif" <?php echo $jenis_grup_berita_view->aktif->cellAttributes() ?>>
<span id="el_jenis_grup_berita_aktif">
<span<?php echo $jenis_grup_berita_view->aktif->viewAttributes() ?>><?php echo $jenis_grup_berita_view->aktif->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$jenis_grup_berita_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jenis_grup_berita_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$jenis_grup_berita_view->terminate();
?>