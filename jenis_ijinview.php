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
$jenis_ijin_view = new jenis_ijin_view();

// Run the page
$jenis_ijin_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_ijin_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jenis_ijin_view->isExport()) { ?>
<script>
var fjenis_ijinview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fjenis_ijinview = currentForm = new ew.Form("fjenis_ijinview", "view");
	loadjs.done("fjenis_ijinview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$jenis_ijin_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $jenis_ijin_view->ExportOptions->render("body") ?>
<?php $jenis_ijin_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $jenis_ijin_view->showPageHeader(); ?>
<?php
$jenis_ijin_view->showMessage();
?>
<form name="fjenis_ijinview" id="fjenis_ijinview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_ijin">
<input type="hidden" name="modal" value="<?php echo (int)$jenis_ijin_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($jenis_ijin_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $jenis_ijin_view->TableLeftColumnClass ?>"><span id="elh_jenis_ijin_id"><?php echo $jenis_ijin_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $jenis_ijin_view->id->cellAttributes() ?>>
<span id="el_jenis_ijin_id">
<span<?php echo $jenis_ijin_view->id->viewAttributes() ?>><?php echo $jenis_ijin_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenis_ijin_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $jenis_ijin_view->TableLeftColumnClass ?>"><span id="elh_jenis_ijin_nama"><?php echo $jenis_ijin_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $jenis_ijin_view->nama->cellAttributes() ?>>
<span id="el_jenis_ijin_nama">
<span<?php echo $jenis_ijin_view->nama->viewAttributes() ?>><?php echo $jenis_ijin_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenis_ijin_view->aktif->Visible) { // aktif ?>
	<tr id="r_aktif">
		<td class="<?php echo $jenis_ijin_view->TableLeftColumnClass ?>"><span id="elh_jenis_ijin_aktif"><?php echo $jenis_ijin_view->aktif->caption() ?></span></td>
		<td data-name="aktif" <?php echo $jenis_ijin_view->aktif->cellAttributes() ?>>
<span id="el_jenis_ijin_aktif">
<span<?php echo $jenis_ijin_view->aktif->viewAttributes() ?>><?php echo $jenis_ijin_view->aktif->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenis_ijin_view->value->Visible) { // value ?>
	<tr id="r_value">
		<td class="<?php echo $jenis_ijin_view->TableLeftColumnClass ?>"><span id="elh_jenis_ijin_value"><?php echo $jenis_ijin_view->value->caption() ?></span></td>
		<td data-name="value" <?php echo $jenis_ijin_view->value->cellAttributes() ?>>
<span id="el_jenis_ijin_value">
<span<?php echo $jenis_ijin_view->value->viewAttributes() ?>><?php echo $jenis_ijin_view->value->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenis_ijin_view->valueperjam->Visible) { // valueperjam ?>
	<tr id="r_valueperjam">
		<td class="<?php echo $jenis_ijin_view->TableLeftColumnClass ?>"><span id="elh_jenis_ijin_valueperjam"><?php echo $jenis_ijin_view->valueperjam->caption() ?></span></td>
		<td data-name="valueperjam" <?php echo $jenis_ijin_view->valueperjam->cellAttributes() ?>>
<span id="el_jenis_ijin_valueperjam">
<span<?php echo $jenis_ijin_view->valueperjam->viewAttributes() ?>><?php echo $jenis_ijin_view->valueperjam->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenis_ijin_view->jabatan_id->Visible) { // jabatan_id ?>
	<tr id="r_jabatan_id">
		<td class="<?php echo $jenis_ijin_view->TableLeftColumnClass ?>"><span id="elh_jenis_ijin_jabatan_id"><?php echo $jenis_ijin_view->jabatan_id->caption() ?></span></td>
		<td data-name="jabatan_id" <?php echo $jenis_ijin_view->jabatan_id->cellAttributes() ?>>
<span id="el_jenis_ijin_jabatan_id">
<span<?php echo $jenis_ijin_view->jabatan_id->viewAttributes() ?>><?php echo $jenis_ijin_view->jabatan_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jenis_ijin_view->jenjang_id->Visible) { // jenjang_id ?>
	<tr id="r_jenjang_id">
		<td class="<?php echo $jenis_ijin_view->TableLeftColumnClass ?>"><span id="elh_jenis_ijin_jenjang_id"><?php echo $jenis_ijin_view->jenjang_id->caption() ?></span></td>
		<td data-name="jenjang_id" <?php echo $jenis_ijin_view->jenjang_id->cellAttributes() ?>>
<span id="el_jenis_ijin_jenjang_id">
<span<?php echo $jenis_ijin_view->jenjang_id->viewAttributes() ?>><?php echo $jenis_ijin_view->jenjang_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$jenis_ijin_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jenis_ijin_view->isExport()) { ?>
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
$jenis_ijin_view->terminate();
?>