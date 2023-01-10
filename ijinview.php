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
$ijin_view = new ijin_view();

// Run the page
$ijin_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ijin_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ijin_view->isExport()) { ?>
<script>
var fijinview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fijinview = currentForm = new ew.Form("fijinview", "view");
	loadjs.done("fijinview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$ijin_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $ijin_view->ExportOptions->render("body") ?>
<?php $ijin_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $ijin_view->showPageHeader(); ?>
<?php
$ijin_view->showMessage();
?>
<form name="fijinview" id="fijinview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ijin">
<input type="hidden" name="modal" value="<?php echo (int)$ijin_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($ijin_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $ijin_view->TableLeftColumnClass ?>"><span id="elh_ijin_id"><?php echo $ijin_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $ijin_view->id->cellAttributes() ?>>
<span id="el_ijin_id">
<span<?php echo $ijin_view->id->viewAttributes() ?>><?php echo $ijin_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ijin_view->pegawai->Visible) { // pegawai ?>
	<tr id="r_pegawai">
		<td class="<?php echo $ijin_view->TableLeftColumnClass ?>"><span id="elh_ijin_pegawai"><?php echo $ijin_view->pegawai->caption() ?></span></td>
		<td data-name="pegawai" <?php echo $ijin_view->pegawai->cellAttributes() ?>>
<span id="el_ijin_pegawai">
<span<?php echo $ijin_view->pegawai->viewAttributes() ?>><?php echo $ijin_view->pegawai->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ijin_view->tgl->Visible) { // tgl ?>
	<tr id="r_tgl">
		<td class="<?php echo $ijin_view->TableLeftColumnClass ?>"><span id="elh_ijin_tgl"><?php echo $ijin_view->tgl->caption() ?></span></td>
		<td data-name="tgl" <?php echo $ijin_view->tgl->cellAttributes() ?>>
<span id="el_ijin_tgl">
<span<?php echo $ijin_view->tgl->viewAttributes() ?>><?php echo $ijin_view->tgl->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ijin_view->tgl_ijin_awal->Visible) { // tgl_ijin_awal ?>
	<tr id="r_tgl_ijin_awal">
		<td class="<?php echo $ijin_view->TableLeftColumnClass ?>"><span id="elh_ijin_tgl_ijin_awal"><?php echo $ijin_view->tgl_ijin_awal->caption() ?></span></td>
		<td data-name="tgl_ijin_awal" <?php echo $ijin_view->tgl_ijin_awal->cellAttributes() ?>>
<span id="el_ijin_tgl_ijin_awal">
<span<?php echo $ijin_view->tgl_ijin_awal->viewAttributes() ?>><?php echo $ijin_view->tgl_ijin_awal->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ijin_view->tgl_ijin_akhir->Visible) { // tgl_ijin_akhir ?>
	<tr id="r_tgl_ijin_akhir">
		<td class="<?php echo $ijin_view->TableLeftColumnClass ?>"><span id="elh_ijin_tgl_ijin_akhir"><?php echo $ijin_view->tgl_ijin_akhir->caption() ?></span></td>
		<td data-name="tgl_ijin_akhir" <?php echo $ijin_view->tgl_ijin_akhir->cellAttributes() ?>>
<span id="el_ijin_tgl_ijin_akhir">
<span<?php echo $ijin_view->tgl_ijin_akhir->viewAttributes() ?>><?php echo $ijin_view->tgl_ijin_akhir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ijin_view->jenis->Visible) { // jenis ?>
	<tr id="r_jenis">
		<td class="<?php echo $ijin_view->TableLeftColumnClass ?>"><span id="elh_ijin_jenis"><?php echo $ijin_view->jenis->caption() ?></span></td>
		<td data-name="jenis" <?php echo $ijin_view->jenis->cellAttributes() ?>>
<span id="el_ijin_jenis">
<span<?php echo $ijin_view->jenis->viewAttributes() ?>><?php echo $ijin_view->jenis->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ijin_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $ijin_view->TableLeftColumnClass ?>"><span id="elh_ijin_keterangan"><?php echo $ijin_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $ijin_view->keterangan->cellAttributes() ?>>
<span id="el_ijin_keterangan">
<span<?php echo $ijin_view->keterangan->viewAttributes() ?>><?php echo $ijin_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ijin_view->disetujui->Visible) { // disetujui ?>
	<tr id="r_disetujui">
		<td class="<?php echo $ijin_view->TableLeftColumnClass ?>"><span id="elh_ijin_disetujui"><?php echo $ijin_view->disetujui->caption() ?></span></td>
		<td data-name="disetujui" <?php echo $ijin_view->disetujui->cellAttributes() ?>>
<span id="el_ijin_disetujui">
<span<?php echo $ijin_view->disetujui->viewAttributes() ?>><?php echo $ijin_view->disetujui->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($ijin_view->dokumen->Visible) { // dokumen ?>
	<tr id="r_dokumen">
		<td class="<?php echo $ijin_view->TableLeftColumnClass ?>"><span id="elh_ijin_dokumen"><?php echo $ijin_view->dokumen->caption() ?></span></td>
		<td data-name="dokumen" <?php echo $ijin_view->dokumen->cellAttributes() ?>>
<span id="el_ijin_dokumen">
<span<?php echo $ijin_view->dokumen->viewAttributes() ?>><?php echo GetFileViewTag($ijin_view->dokumen, $ijin_view->dokumen->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$ijin_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ijin_view->isExport()) { ?>
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
$ijin_view->terminate();
?>