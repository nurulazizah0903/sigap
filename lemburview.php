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
$lembur_view = new lembur_view();

// Run the page
$lembur_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lembur_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$lembur_view->isExport()) { ?>
<script>
var flemburview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	flemburview = currentForm = new ew.Form("flemburview", "view");
	loadjs.done("flemburview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$lembur_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $lembur_view->ExportOptions->render("body") ?>
<?php $lembur_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $lembur_view->showPageHeader(); ?>
<?php
$lembur_view->showMessage();
?>
<form name="flemburview" id="flemburview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lembur">
<input type="hidden" name="modal" value="<?php echo (int)$lembur_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($lembur_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $lembur_view->TableLeftColumnClass ?>"><span id="elh_lembur_id"><?php echo $lembur_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $lembur_view->id->cellAttributes() ?>>
<span id="el_lembur_id">
<span<?php echo $lembur_view->id->viewAttributes() ?>><?php echo $lembur_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lembur_view->pegawai->Visible) { // pegawai ?>
	<tr id="r_pegawai">
		<td class="<?php echo $lembur_view->TableLeftColumnClass ?>"><span id="elh_lembur_pegawai"><?php echo $lembur_view->pegawai->caption() ?></span></td>
		<td data-name="pegawai" <?php echo $lembur_view->pegawai->cellAttributes() ?>>
<span id="el_lembur_pegawai">
<span<?php echo $lembur_view->pegawai->viewAttributes() ?>><?php echo $lembur_view->pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lembur_view->pm->Visible) { // pm ?>
	<tr id="r_pm">
		<td class="<?php echo $lembur_view->TableLeftColumnClass ?>"><span id="elh_lembur_pm"><?php echo $lembur_view->pm->caption() ?></span></td>
		<td data-name="pm" <?php echo $lembur_view->pm->cellAttributes() ?>>
<span id="el_lembur_pm">
<span<?php echo $lembur_view->pm->viewAttributes() ?>><?php echo $lembur_view->pm->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lembur_view->proyek->Visible) { // proyek ?>
	<tr id="r_proyek">
		<td class="<?php echo $lembur_view->TableLeftColumnClass ?>"><span id="elh_lembur_proyek"><?php echo $lembur_view->proyek->caption() ?></span></td>
		<td data-name="proyek" <?php echo $lembur_view->proyek->cellAttributes() ?>>
<span id="el_lembur_proyek">
<span<?php echo $lembur_view->proyek->viewAttributes() ?>><?php echo $lembur_view->proyek->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lembur_view->tgl->Visible) { // tgl ?>
	<tr id="r_tgl">
		<td class="<?php echo $lembur_view->TableLeftColumnClass ?>"><span id="elh_lembur_tgl"><?php echo $lembur_view->tgl->caption() ?></span></td>
		<td data-name="tgl" <?php echo $lembur_view->tgl->cellAttributes() ?>>
<span id="el_lembur_tgl">
<span<?php echo $lembur_view->tgl->viewAttributes() ?>><?php echo $lembur_view->tgl->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lembur_view->tgl_awal_lembur->Visible) { // tgl_awal_lembur ?>
	<tr id="r_tgl_awal_lembur">
		<td class="<?php echo $lembur_view->TableLeftColumnClass ?>"><span id="elh_lembur_tgl_awal_lembur"><?php echo $lembur_view->tgl_awal_lembur->caption() ?></span></td>
		<td data-name="tgl_awal_lembur" <?php echo $lembur_view->tgl_awal_lembur->cellAttributes() ?>>
<span id="el_lembur_tgl_awal_lembur">
<span<?php echo $lembur_view->tgl_awal_lembur->viewAttributes() ?>><?php echo $lembur_view->tgl_awal_lembur->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lembur_view->tgl_akhir_lembur->Visible) { // tgl_akhir_lembur ?>
	<tr id="r_tgl_akhir_lembur">
		<td class="<?php echo $lembur_view->TableLeftColumnClass ?>"><span id="elh_lembur_tgl_akhir_lembur"><?php echo $lembur_view->tgl_akhir_lembur->caption() ?></span></td>
		<td data-name="tgl_akhir_lembur" <?php echo $lembur_view->tgl_akhir_lembur->cellAttributes() ?>>
<span id="el_lembur_tgl_akhir_lembur">
<span<?php echo $lembur_view->tgl_akhir_lembur->viewAttributes() ?>><?php echo $lembur_view->tgl_akhir_lembur->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lembur_view->total_jam->Visible) { // total_jam ?>
	<tr id="r_total_jam">
		<td class="<?php echo $lembur_view->TableLeftColumnClass ?>"><span id="elh_lembur_total_jam"><?php echo $lembur_view->total_jam->caption() ?></span></td>
		<td data-name="total_jam" <?php echo $lembur_view->total_jam->cellAttributes() ?>>
<span id="el_lembur_total_jam">
<span<?php echo $lembur_view->total_jam->viewAttributes() ?>><?php echo $lembur_view->total_jam->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lembur_view->jenis->Visible) { // jenis ?>
	<tr id="r_jenis">
		<td class="<?php echo $lembur_view->TableLeftColumnClass ?>"><span id="elh_lembur_jenis"><?php echo $lembur_view->jenis->caption() ?></span></td>
		<td data-name="jenis" <?php echo $lembur_view->jenis->cellAttributes() ?>>
<span id="el_lembur_jenis">
<span<?php echo $lembur_view->jenis->viewAttributes() ?>><?php echo $lembur_view->jenis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lembur_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $lembur_view->TableLeftColumnClass ?>"><span id="elh_lembur_keterangan"><?php echo $lembur_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $lembur_view->keterangan->cellAttributes() ?>>
<span id="el_lembur_keterangan">
<span<?php echo $lembur_view->keterangan->viewAttributes() ?>><?php echo $lembur_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lembur_view->disetujui->Visible) { // disetujui ?>
	<tr id="r_disetujui">
		<td class="<?php echo $lembur_view->TableLeftColumnClass ?>"><span id="elh_lembur_disetujui"><?php echo $lembur_view->disetujui->caption() ?></span></td>
		<td data-name="disetujui" <?php echo $lembur_view->disetujui->cellAttributes() ?>>
<span id="el_lembur_disetujui">
<span<?php echo $lembur_view->disetujui->viewAttributes() ?>><?php echo $lembur_view->disetujui->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($lembur_view->dokumen->Visible) { // dokumen ?>
	<tr id="r_dokumen">
		<td class="<?php echo $lembur_view->TableLeftColumnClass ?>"><span id="elh_lembur_dokumen"><?php echo $lembur_view->dokumen->caption() ?></span></td>
		<td data-name="dokumen" <?php echo $lembur_view->dokumen->cellAttributes() ?>>
<span id="el_lembur_dokumen">
<span<?php echo $lembur_view->dokumen->viewAttributes() ?>><?php echo GetFileViewTag($lembur_view->dokumen, $lembur_view->dokumen->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$lembur_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$lembur_view->isExport()) { ?>
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
$lembur_view->terminate();
?>