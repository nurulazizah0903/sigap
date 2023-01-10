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
$m_karyawan_smp_view = new m_karyawan_smp_view();

// Run the page
$m_karyawan_smp_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_karyawan_smp_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_karyawan_smp_view->isExport()) { ?>
<script>
var fm_karyawan_smpview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fm_karyawan_smpview = currentForm = new ew.Form("fm_karyawan_smpview", "view");
	loadjs.done("fm_karyawan_smpview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$m_karyawan_smp_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $m_karyawan_smp_view->ExportOptions->render("body") ?>
<?php $m_karyawan_smp_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $m_karyawan_smp_view->showPageHeader(); ?>
<?php
$m_karyawan_smp_view->showMessage();
?>
<form name="fm_karyawan_smpview" id="fm_karyawan_smpview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_karyawan_smp">
<input type="hidden" name="modal" value="<?php echo (int)$m_karyawan_smp_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($m_karyawan_smp_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $m_karyawan_smp_view->TableLeftColumnClass ?>"><span id="elh_m_karyawan_smp_id"><?php echo $m_karyawan_smp_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $m_karyawan_smp_view->id->cellAttributes() ?>>
<span id="el_m_karyawan_smp_id">
<span<?php echo $m_karyawan_smp_view->id->viewAttributes() ?>><?php echo $m_karyawan_smp_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_karyawan_smp_view->datetime->Visible) { // datetime ?>
	<tr id="r_datetime">
		<td class="<?php echo $m_karyawan_smp_view->TableLeftColumnClass ?>"><span id="elh_m_karyawan_smp_datetime"><?php echo $m_karyawan_smp_view->datetime->caption() ?></span></td>
		<td data-name="datetime" <?php echo $m_karyawan_smp_view->datetime->cellAttributes() ?>>
<span id="el_m_karyawan_smp_datetime">
<span<?php echo $m_karyawan_smp_view->datetime->viewAttributes() ?>><?php echo $m_karyawan_smp_view->datetime->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_karyawan_smp_view->createby->Visible) { // createby ?>
	<tr id="r_createby">
		<td class="<?php echo $m_karyawan_smp_view->TableLeftColumnClass ?>"><span id="elh_m_karyawan_smp_createby"><?php echo $m_karyawan_smp_view->createby->caption() ?></span></td>
		<td data-name="createby" <?php echo $m_karyawan_smp_view->createby->cellAttributes() ?>>
<span id="el_m_karyawan_smp_createby">
<span<?php echo $m_karyawan_smp_view->createby->viewAttributes() ?>><?php echo $m_karyawan_smp_view->createby->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_karyawan_smp_view->tahun->Visible) { // tahun ?>
	<tr id="r_tahun">
		<td class="<?php echo $m_karyawan_smp_view->TableLeftColumnClass ?>"><span id="elh_m_karyawan_smp_tahun"><?php echo $m_karyawan_smp_view->tahun->caption() ?></span></td>
		<td data-name="tahun" <?php echo $m_karyawan_smp_view->tahun->cellAttributes() ?>>
<span id="el_m_karyawan_smp_tahun">
<span<?php echo $m_karyawan_smp_view->tahun->viewAttributes() ?>><?php echo $m_karyawan_smp_view->tahun->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($m_karyawan_smp_view->bulan->Visible) { // bulan ?>
	<tr id="r_bulan">
		<td class="<?php echo $m_karyawan_smp_view->TableLeftColumnClass ?>"><span id="elh_m_karyawan_smp_bulan"><?php echo $m_karyawan_smp_view->bulan->caption() ?></span></td>
		<td data-name="bulan" <?php echo $m_karyawan_smp_view->bulan->cellAttributes() ?>>
<span id="el_m_karyawan_smp_bulan">
<span<?php echo $m_karyawan_smp_view->bulan->viewAttributes() ?>><?php echo $m_karyawan_smp_view->bulan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("gaji_karyawan_smp", explode(",", $m_karyawan_smp->getCurrentDetailTable())) && $gaji_karyawan_smp->DetailView) {
?>
<?php if ($m_karyawan_smp->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gaji_karyawan_smp", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gaji_karyawan_smpgrid.php" ?>
<?php } ?>
</form>
<?php
$m_karyawan_smp_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_karyawan_smp_view->isExport()) { ?>
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
$m_karyawan_smp_view->terminate();
?>