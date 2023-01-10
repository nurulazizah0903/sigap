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
$jabatan_view = new jabatan_view();

// Run the page
$jabatan_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jabatan_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jabatan_view->isExport()) { ?>
<script>
var fjabatanview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fjabatanview = currentForm = new ew.Form("fjabatanview", "view");
	loadjs.done("fjabatanview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$jabatan_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $jabatan_view->ExportOptions->render("body") ?>
<?php $jabatan_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $jabatan_view->showPageHeader(); ?>
<?php
$jabatan_view->showMessage();
?>
<form name="fjabatanview" id="fjabatanview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jabatan">
<input type="hidden" name="modal" value="<?php echo (int)$jabatan_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($jabatan_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $jabatan_view->TableLeftColumnClass ?>"><span id="elh_jabatan_id"><?php echo $jabatan_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $jabatan_view->id->cellAttributes() ?>>
<span id="el_jabatan_id">
<span<?php echo $jabatan_view->id->viewAttributes() ?>><?php echo $jabatan_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jabatan_view->nama_jabatan->Visible) { // nama_jabatan ?>
	<tr id="r_nama_jabatan">
		<td class="<?php echo $jabatan_view->TableLeftColumnClass ?>"><span id="elh_jabatan_nama_jabatan"><?php echo $jabatan_view->nama_jabatan->caption() ?></span></td>
		<td data-name="nama_jabatan" <?php echo $jabatan_view->nama_jabatan->cellAttributes() ?>>
<span id="el_jabatan_nama_jabatan">
<span<?php echo $jabatan_view->nama_jabatan->viewAttributes() ?>><?php echo $jabatan_view->nama_jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jabatan_view->type_jabatan->Visible) { // type_jabatan ?>
	<tr id="r_type_jabatan">
		<td class="<?php echo $jabatan_view->TableLeftColumnClass ?>"><span id="elh_jabatan_type_jabatan"><?php echo $jabatan_view->type_jabatan->caption() ?></span></td>
		<td data-name="type_jabatan" <?php echo $jabatan_view->type_jabatan->cellAttributes() ?>>
<span id="el_jabatan_type_jabatan">
<span<?php echo $jabatan_view->type_jabatan->viewAttributes() ?>><?php echo $jabatan_view->type_jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jabatan_view->jenjang->Visible) { // jenjang ?>
	<tr id="r_jenjang">
		<td class="<?php echo $jabatan_view->TableLeftColumnClass ?>"><span id="elh_jabatan_jenjang"><?php echo $jabatan_view->jenjang->caption() ?></span></td>
		<td data-name="jenjang" <?php echo $jabatan_view->jenjang->cellAttributes() ?>>
<span id="el_jabatan_jenjang">
<span<?php echo $jabatan_view->jenjang->viewAttributes() ?>><?php echo $jabatan_view->jenjang->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jabatan_view->type_guru->Visible) { // type_guru ?>
	<tr id="r_type_guru">
		<td class="<?php echo $jabatan_view->TableLeftColumnClass ?>"><span id="elh_jabatan_type_guru"><?php echo $jabatan_view->type_guru->caption() ?></span></td>
		<td data-name="type_guru" <?php echo $jabatan_view->type_guru->cellAttributes() ?>>
<span id="el_jabatan_type_guru">
<span<?php echo $jabatan_view->type_guru->viewAttributes() ?>><?php echo $jabatan_view->type_guru->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jabatan_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $jabatan_view->TableLeftColumnClass ?>"><span id="elh_jabatan_keterangan"><?php echo $jabatan_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $jabatan_view->keterangan->cellAttributes() ?>>
<span id="el_jabatan_keterangan">
<span<?php echo $jabatan_view->keterangan->viewAttributes() ?>><?php echo $jabatan_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jabatan_view->c_by->Visible) { // c_by ?>
	<tr id="r_c_by">
		<td class="<?php echo $jabatan_view->TableLeftColumnClass ?>"><span id="elh_jabatan_c_by"><?php echo $jabatan_view->c_by->caption() ?></span></td>
		<td data-name="c_by" <?php echo $jabatan_view->c_by->cellAttributes() ?>>
<span id="el_jabatan_c_by">
<span<?php echo $jabatan_view->c_by->viewAttributes() ?>><?php echo $jabatan_view->c_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jabatan_view->c_date->Visible) { // c_date ?>
	<tr id="r_c_date">
		<td class="<?php echo $jabatan_view->TableLeftColumnClass ?>"><span id="elh_jabatan_c_date"><?php echo $jabatan_view->c_date->caption() ?></span></td>
		<td data-name="c_date" <?php echo $jabatan_view->c_date->cellAttributes() ?>>
<span id="el_jabatan_c_date">
<span<?php echo $jabatan_view->c_date->viewAttributes() ?>><?php echo $jabatan_view->c_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jabatan_view->u_by->Visible) { // u_by ?>
	<tr id="r_u_by">
		<td class="<?php echo $jabatan_view->TableLeftColumnClass ?>"><span id="elh_jabatan_u_by"><?php echo $jabatan_view->u_by->caption() ?></span></td>
		<td data-name="u_by" <?php echo $jabatan_view->u_by->cellAttributes() ?>>
<span id="el_jabatan_u_by">
<span<?php echo $jabatan_view->u_by->viewAttributes() ?>><?php echo $jabatan_view->u_by->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jabatan_view->u_date->Visible) { // u_date ?>
	<tr id="r_u_date">
		<td class="<?php echo $jabatan_view->TableLeftColumnClass ?>"><span id="elh_jabatan_u_date"><?php echo $jabatan_view->u_date->caption() ?></span></td>
		<td data-name="u_date" <?php echo $jabatan_view->u_date->cellAttributes() ?>>
<span id="el_jabatan_u_date">
<span<?php echo $jabatan_view->u_date->viewAttributes() ?>><?php echo $jabatan_view->u_date->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($jabatan_view->aktif->Visible) { // aktif ?>
	<tr id="r_aktif">
		<td class="<?php echo $jabatan_view->TableLeftColumnClass ?>"><span id="elh_jabatan_aktif"><?php echo $jabatan_view->aktif->caption() ?></span></td>
		<td data-name="aktif" <?php echo $jabatan_view->aktif->cellAttributes() ?>>
<span id="el_jabatan_aktif">
<span<?php echo $jabatan_view->aktif->viewAttributes() ?>><?php echo $jabatan_view->aktif->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("gajitunjangan", explode(",", $jabatan->getCurrentDetailTable())) && $gajitunjangan->DetailView) {
?>
<?php if ($jabatan->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("gajitunjangan", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "gajitunjangangrid.php" ?>
<?php } ?>
</form>
<?php
$jabatan_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jabatan_view->isExport()) { ?>
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
$jabatan_view->terminate();
?>