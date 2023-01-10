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
$absen_view = new absen_view();

// Run the page
$absen_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$absen_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$absen_view->isExport()) { ?>
<script>
var fabsenview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fabsenview = currentForm = new ew.Form("fabsenview", "view");
	loadjs.done("fabsenview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$absen_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $absen_view->ExportOptions->render("body") ?>
<?php $absen_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $absen_view->showPageHeader(); ?>
<?php
$absen_view->showMessage();
?>
<form name="fabsenview" id="fabsenview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="absen">
<input type="hidden" name="modal" value="<?php echo (int)$absen_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($absen_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $absen_view->TableLeftColumnClass ?>"><span id="elh_absen_id"><?php echo $absen_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $absen_view->id->cellAttributes() ?>>
<span id="el_absen_id">
<span<?php echo $absen_view->id->viewAttributes() ?>><?php echo $absen_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($absen_view->tahun->Visible) { // tahun ?>
	<tr id="r_tahun">
		<td class="<?php echo $absen_view->TableLeftColumnClass ?>"><span id="elh_absen_tahun"><?php echo $absen_view->tahun->caption() ?></span></td>
		<td data-name="tahun" <?php echo $absen_view->tahun->cellAttributes() ?>>
<span id="el_absen_tahun">
<span<?php echo $absen_view->tahun->viewAttributes() ?>><?php echo $absen_view->tahun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($absen_view->bulan->Visible) { // bulan ?>
	<tr id="r_bulan">
		<td class="<?php echo $absen_view->TableLeftColumnClass ?>"><span id="elh_absen_bulan"><?php echo $absen_view->bulan->caption() ?></span></td>
		<td data-name="bulan" <?php echo $absen_view->bulan->cellAttributes() ?>>
<span id="el_absen_bulan">
<span<?php echo $absen_view->bulan->viewAttributes() ?>><?php echo $absen_view->bulan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($absen_view->jumlah_hari_kerja->Visible) { // jumlah_hari_kerja ?>
	<tr id="r_jumlah_hari_kerja">
		<td class="<?php echo $absen_view->TableLeftColumnClass ?>"><span id="elh_absen_jumlah_hari_kerja"><?php echo $absen_view->jumlah_hari_kerja->caption() ?></span></td>
		<td data-name="jumlah_hari_kerja" <?php echo $absen_view->jumlah_hari_kerja->cellAttributes() ?>>
<span id="el_absen_jumlah_hari_kerja">
<span<?php echo $absen_view->jumlah_hari_kerja->viewAttributes() ?>><?php echo $absen_view->jumlah_hari_kerja->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($absen_view->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td class="<?php echo $absen_view->TableLeftColumnClass ?>"><span id="elh_absen_datetime"><?php echo $absen_view->datetime->caption() ?></span></td>
		<td data-name="datetime" <?php echo $absen_view->datetime->cellAttributes() ?>>
<span id="el_absen_datetime">
<span<?php echo $absen_view->datetime->viewAttributes() ?>><?php echo $absen_view->datetime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($absen_view->createuser->Visible) { // createuser ?>
	<tr id="r_createuser">
		<td class="<?php echo $absen_view->TableLeftColumnClass ?>"><span id="elh_absen_createuser"><?php echo $absen_view->createuser->caption() ?></span></td>
		<td data-name="createuser" <?php echo $absen_view->createuser->cellAttributes() ?>>
<span id="el_absen_createuser">
<span<?php echo $absen_view->createuser->viewAttributes() ?>><?php echo $absen_view->createuser->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("absen_detil", explode(",", $absen->getCurrentDetailTable())) && $absen_detil->DetailView) {
?>
<?php if ($absen->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("absen_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "absen_detilgrid.php" ?>
<?php } ?>
</form>
<?php
$absen_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$absen_view->isExport()) { ?>
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
$absen_view->terminate();
?>