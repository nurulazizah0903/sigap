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
$dinasluar_view = new dinasluar_view();

// Run the page
$dinasluar_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dinasluar_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$dinasluar_view->isExport()) { ?>
<script>
var fdinasluarview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fdinasluarview = currentForm = new ew.Form("fdinasluarview", "view");
	loadjs.done("fdinasluarview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$dinasluar_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $dinasluar_view->ExportOptions->render("body") ?>
<?php $dinasluar_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $dinasluar_view->showPageHeader(); ?>
<?php
$dinasluar_view->showMessage();
?>
<form name="fdinasluarview" id="fdinasluarview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dinasluar">
<input type="hidden" name="modal" value="<?php echo (int)$dinasluar_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($dinasluar_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $dinasluar_view->TableLeftColumnClass ?>"><span id="elh_dinasluar_id"><?php echo $dinasluar_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $dinasluar_view->id->cellAttributes() ?>>
<span id="el_dinasluar_id">
<span<?php echo $dinasluar_view->id->viewAttributes() ?>><?php echo $dinasluar_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dinasluar_view->pegawai->Visible) { // pegawai ?>
	<tr id="r_pegawai">
		<td class="<?php echo $dinasluar_view->TableLeftColumnClass ?>"><span id="elh_dinasluar_pegawai"><?php echo $dinasluar_view->pegawai->caption() ?></span></td>
		<td data-name="pegawai" <?php echo $dinasluar_view->pegawai->cellAttributes() ?>>
<span id="el_dinasluar_pegawai">
<span<?php echo $dinasluar_view->pegawai->viewAttributes() ?>><?php echo $dinasluar_view->pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dinasluar_view->pm->Visible) { // pm ?>
	<tr id="r_pm">
		<td class="<?php echo $dinasluar_view->TableLeftColumnClass ?>"><span id="elh_dinasluar_pm"><?php echo $dinasluar_view->pm->caption() ?></span></td>
		<td data-name="pm" <?php echo $dinasluar_view->pm->cellAttributes() ?>>
<span id="el_dinasluar_pm">
<span<?php echo $dinasluar_view->pm->viewAttributes() ?>><?php echo $dinasluar_view->pm->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dinasluar_view->proyek->Visible) { // proyek ?>
	<tr id="r_proyek">
		<td class="<?php echo $dinasluar_view->TableLeftColumnClass ?>"><span id="elh_dinasluar_proyek"><?php echo $dinasluar_view->proyek->caption() ?></span></td>
		<td data-name="proyek" <?php echo $dinasluar_view->proyek->cellAttributes() ?>>
<span id="el_dinasluar_proyek">
<span<?php echo $dinasluar_view->proyek->viewAttributes() ?>><?php echo $dinasluar_view->proyek->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dinasluar_view->tgl->Visible) { // tgl ?>
	<tr id="r_tgl">
		<td class="<?php echo $dinasluar_view->TableLeftColumnClass ?>"><span id="elh_dinasluar_tgl"><?php echo $dinasluar_view->tgl->caption() ?></span></td>
		<td data-name="tgl" <?php echo $dinasluar_view->tgl->cellAttributes() ?>>
<span id="el_dinasluar_tgl">
<span<?php echo $dinasluar_view->tgl->viewAttributes() ?>><?php echo $dinasluar_view->tgl->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dinasluar_view->tgl_dl_awal->Visible) { // tgl_dl_awal ?>
	<tr id="r_tgl_dl_awal">
		<td class="<?php echo $dinasluar_view->TableLeftColumnClass ?>"><span id="elh_dinasluar_tgl_dl_awal"><?php echo $dinasluar_view->tgl_dl_awal->caption() ?></span></td>
		<td data-name="tgl_dl_awal" <?php echo $dinasluar_view->tgl_dl_awal->cellAttributes() ?>>
<span id="el_dinasluar_tgl_dl_awal">
<span<?php echo $dinasluar_view->tgl_dl_awal->viewAttributes() ?>><?php echo $dinasluar_view->tgl_dl_awal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dinasluar_view->tgl_dl_akhir->Visible) { // tgl_dl_akhir ?>
	<tr id="r_tgl_dl_akhir">
		<td class="<?php echo $dinasluar_view->TableLeftColumnClass ?>"><span id="elh_dinasluar_tgl_dl_akhir"><?php echo $dinasluar_view->tgl_dl_akhir->caption() ?></span></td>
		<td data-name="tgl_dl_akhir" <?php echo $dinasluar_view->tgl_dl_akhir->cellAttributes() ?>>
<span id="el_dinasluar_tgl_dl_akhir">
<span<?php echo $dinasluar_view->tgl_dl_akhir->viewAttributes() ?>><?php echo $dinasluar_view->tgl_dl_akhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dinasluar_view->jenis->Visible) { // jenis ?>
	<tr id="r_jenis">
		<td class="<?php echo $dinasluar_view->TableLeftColumnClass ?>"><span id="elh_dinasluar_jenis"><?php echo $dinasluar_view->jenis->caption() ?></span></td>
		<td data-name="jenis" <?php echo $dinasluar_view->jenis->cellAttributes() ?>>
<span id="el_dinasluar_jenis">
<span<?php echo $dinasluar_view->jenis->viewAttributes() ?>><?php echo $dinasluar_view->jenis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dinasluar_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $dinasluar_view->TableLeftColumnClass ?>"><span id="elh_dinasluar_keterangan"><?php echo $dinasluar_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $dinasluar_view->keterangan->cellAttributes() ?>>
<span id="el_dinasluar_keterangan">
<span<?php echo $dinasluar_view->keterangan->viewAttributes() ?>><?php echo $dinasluar_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dinasluar_view->disetujui->Visible) { // disetujui ?>
	<tr id="r_disetujui">
		<td class="<?php echo $dinasluar_view->TableLeftColumnClass ?>"><span id="elh_dinasluar_disetujui"><?php echo $dinasluar_view->disetujui->caption() ?></span></td>
		<td data-name="disetujui" <?php echo $dinasluar_view->disetujui->cellAttributes() ?>>
<span id="el_dinasluar_disetujui">
<span<?php echo $dinasluar_view->disetujui->viewAttributes() ?>><?php echo $dinasluar_view->disetujui->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($dinasluar_view->dokumen->Visible) { // dokumen ?>
	<tr id="r_dokumen">
		<td class="<?php echo $dinasluar_view->TableLeftColumnClass ?>"><span id="elh_dinasluar_dokumen"><?php echo $dinasluar_view->dokumen->caption() ?></span></td>
		<td data-name="dokumen" <?php echo $dinasluar_view->dokumen->cellAttributes() ?>>
<span id="el_dinasluar_dokumen">
<span<?php echo $dinasluar_view->dokumen->viewAttributes() ?>><?php echo GetFileViewTag($dinasluar_view->dokumen, $dinasluar_view->dokumen->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$dinasluar_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$dinasluar_view->isExport()) { ?>
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
$dinasluar_view->terminate();
?>