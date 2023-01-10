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
$absen_detil_view = new absen_detil_view();

// Run the page
$absen_detil_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$absen_detil_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$absen_detil_view->isExport()) { ?>
<script>
var fabsen_detilview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fabsen_detilview = currentForm = new ew.Form("fabsen_detilview", "view");
	loadjs.done("fabsen_detilview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$absen_detil_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $absen_detil_view->ExportOptions->render("body") ?>
<?php $absen_detil_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $absen_detil_view->showPageHeader(); ?>
<?php
$absen_detil_view->showMessage();
?>
<form name="fabsen_detilview" id="fabsen_detilview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="absen_detil">
<input type="hidden" name="modal" value="<?php echo (int)$absen_detil_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($absen_detil_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $absen_detil_view->TableLeftColumnClass ?>"><span id="elh_absen_detil_id"><?php echo $absen_detil_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $absen_detil_view->id->cellAttributes() ?>>
<span id="el_absen_detil_id">
<span<?php echo $absen_detil_view->id->viewAttributes() ?>><?php echo $absen_detil_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($absen_detil_view->pid->Visible) { // pid ?>
	<tr id="r_pid">
		<td class="<?php echo $absen_detil_view->TableLeftColumnClass ?>"><span id="elh_absen_detil_pid"><?php echo $absen_detil_view->pid->caption() ?></span></td>
		<td data-name="pid" <?php echo $absen_detil_view->pid->cellAttributes() ?>>
<span id="el_absen_detil_pid">
<span<?php echo $absen_detil_view->pid->viewAttributes() ?>><?php echo $absen_detil_view->pid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($absen_detil_view->pegawai->Visible) { // pegawai ?>
	<tr id="r_pegawai">
		<td class="<?php echo $absen_detil_view->TableLeftColumnClass ?>"><span id="elh_absen_detil_pegawai"><?php echo $absen_detil_view->pegawai->caption() ?></span></td>
		<td data-name="pegawai" <?php echo $absen_detil_view->pegawai->cellAttributes() ?>>
<span id="el_absen_detil_pegawai">
<span<?php echo $absen_detil_view->pegawai->viewAttributes() ?>><?php echo $absen_detil_view->pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($absen_detil_view->masuk->Visible) { // masuk ?>
	<tr id="r_masuk">
		<td class="<?php echo $absen_detil_view->TableLeftColumnClass ?>"><span id="elh_absen_detil_masuk"><?php echo $absen_detil_view->masuk->caption() ?></span></td>
		<td data-name="masuk" <?php echo $absen_detil_view->masuk->cellAttributes() ?>>
<span id="el_absen_detil_masuk">
<span<?php echo $absen_detil_view->masuk->viewAttributes() ?>><?php echo $absen_detil_view->masuk->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($absen_detil_view->absen->Visible) { // absen ?>
	<tr id="r_absen">
		<td class="<?php echo $absen_detil_view->TableLeftColumnClass ?>"><span id="elh_absen_detil_absen"><?php echo $absen_detil_view->absen->caption() ?></span></td>
		<td data-name="absen" <?php echo $absen_detil_view->absen->cellAttributes() ?>>
<span id="el_absen_detil_absen">
<span<?php echo $absen_detil_view->absen->viewAttributes() ?>><?php echo $absen_detil_view->absen->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($absen_detil_view->ijin->Visible) { // ijin ?>
	<tr id="r_ijin">
		<td class="<?php echo $absen_detil_view->TableLeftColumnClass ?>"><span id="elh_absen_detil_ijin"><?php echo $absen_detil_view->ijin->caption() ?></span></td>
		<td data-name="ijin" <?php echo $absen_detil_view->ijin->cellAttributes() ?>>
<span id="el_absen_detil_ijin">
<span<?php echo $absen_detil_view->ijin->viewAttributes() ?>><?php echo $absen_detil_view->ijin->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($absen_detil_view->cuti->Visible) { // cuti ?>
	<tr id="r_cuti">
		<td class="<?php echo $absen_detil_view->TableLeftColumnClass ?>"><span id="elh_absen_detil_cuti"><?php echo $absen_detil_view->cuti->caption() ?></span></td>
		<td data-name="cuti" <?php echo $absen_detil_view->cuti->cellAttributes() ?>>
<span id="el_absen_detil_cuti">
<span<?php echo $absen_detil_view->cuti->viewAttributes() ?>><?php echo $absen_detil_view->cuti->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($absen_detil_view->dinas_luar->Visible) { // dinas_luar ?>
	<tr id="r_dinas_luar">
		<td class="<?php echo $absen_detil_view->TableLeftColumnClass ?>"><span id="elh_absen_detil_dinas_luar"><?php echo $absen_detil_view->dinas_luar->caption() ?></span></td>
		<td data-name="dinas_luar" <?php echo $absen_detil_view->dinas_luar->cellAttributes() ?>>
<span id="el_absen_detil_dinas_luar">
<span<?php echo $absen_detil_view->dinas_luar->viewAttributes() ?>><?php echo $absen_detil_view->dinas_luar->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($absen_detil_view->terlambat->Visible) { // terlambat ?>
	<tr id="r_terlambat">
		<td class="<?php echo $absen_detil_view->TableLeftColumnClass ?>"><span id="elh_absen_detil_terlambat"><?php echo $absen_detil_view->terlambat->caption() ?></span></td>
		<td data-name="terlambat" <?php echo $absen_detil_view->terlambat->cellAttributes() ?>>
<span id="el_absen_detil_terlambat">
<span<?php echo $absen_detil_view->terlambat->viewAttributes() ?>><?php echo $absen_detil_view->terlambat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$absen_detil_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$absen_detil_view->isExport()) { ?>
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
$absen_detil_view->terminate();
?>