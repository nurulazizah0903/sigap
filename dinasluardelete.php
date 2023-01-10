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
$dinasluar_delete = new dinasluar_delete();

// Run the page
$dinasluar_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dinasluar_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdinasluardelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdinasluardelete = currentForm = new ew.Form("fdinasluardelete", "delete");
	loadjs.done("fdinasluardelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $dinasluar_delete->showPageHeader(); ?>
<?php
$dinasluar_delete->showMessage();
?>
<form name="fdinasluardelete" id="fdinasluardelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dinasluar">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($dinasluar_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($dinasluar_delete->pegawai->Visible) { // pegawai ?>
		<th class="<?php echo $dinasluar_delete->pegawai->headerCellClass() ?>"><span id="elh_dinasluar_pegawai" class="dinasluar_pegawai"><?php echo $dinasluar_delete->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($dinasluar_delete->pm->Visible) { // pm ?>
		<th class="<?php echo $dinasluar_delete->pm->headerCellClass() ?>"><span id="elh_dinasluar_pm" class="dinasluar_pm"><?php echo $dinasluar_delete->pm->caption() ?></span></th>
<?php } ?>
<?php if ($dinasluar_delete->proyek->Visible) { // proyek ?>
		<th class="<?php echo $dinasluar_delete->proyek->headerCellClass() ?>"><span id="elh_dinasluar_proyek" class="dinasluar_proyek"><?php echo $dinasluar_delete->proyek->caption() ?></span></th>
<?php } ?>
<?php if ($dinasluar_delete->tgl->Visible) { // tgl ?>
		<th class="<?php echo $dinasluar_delete->tgl->headerCellClass() ?>"><span id="elh_dinasluar_tgl" class="dinasluar_tgl"><?php echo $dinasluar_delete->tgl->caption() ?></span></th>
<?php } ?>
<?php if ($dinasluar_delete->tgl_dl_awal->Visible) { // tgl_dl_awal ?>
		<th class="<?php echo $dinasluar_delete->tgl_dl_awal->headerCellClass() ?>"><span id="elh_dinasluar_tgl_dl_awal" class="dinasluar_tgl_dl_awal"><?php echo $dinasluar_delete->tgl_dl_awal->caption() ?></span></th>
<?php } ?>
<?php if ($dinasluar_delete->tgl_dl_akhir->Visible) { // tgl_dl_akhir ?>
		<th class="<?php echo $dinasluar_delete->tgl_dl_akhir->headerCellClass() ?>"><span id="elh_dinasluar_tgl_dl_akhir" class="dinasluar_tgl_dl_akhir"><?php echo $dinasluar_delete->tgl_dl_akhir->caption() ?></span></th>
<?php } ?>
<?php if ($dinasluar_delete->jenis->Visible) { // jenis ?>
		<th class="<?php echo $dinasluar_delete->jenis->headerCellClass() ?>"><span id="elh_dinasluar_jenis" class="dinasluar_jenis"><?php echo $dinasluar_delete->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($dinasluar_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $dinasluar_delete->keterangan->headerCellClass() ?>"><span id="elh_dinasluar_keterangan" class="dinasluar_keterangan"><?php echo $dinasluar_delete->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($dinasluar_delete->disetujui->Visible) { // disetujui ?>
		<th class="<?php echo $dinasluar_delete->disetujui->headerCellClass() ?>"><span id="elh_dinasluar_disetujui" class="dinasluar_disetujui"><?php echo $dinasluar_delete->disetujui->caption() ?></span></th>
<?php } ?>
<?php if ($dinasluar_delete->dokumen->Visible) { // dokumen ?>
		<th class="<?php echo $dinasluar_delete->dokumen->headerCellClass() ?>"><span id="elh_dinasluar_dokumen" class="dinasluar_dokumen"><?php echo $dinasluar_delete->dokumen->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$dinasluar_delete->RecordCount = 0;
$i = 0;
while (!$dinasluar_delete->Recordset->EOF) {
	$dinasluar_delete->RecordCount++;
	$dinasluar_delete->RowCount++;

	// Set row properties
	$dinasluar->resetAttributes();
	$dinasluar->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$dinasluar_delete->loadRowValues($dinasluar_delete->Recordset);

	// Render row
	$dinasluar_delete->renderRow();
?>
	<tr <?php echo $dinasluar->rowAttributes() ?>>
<?php if ($dinasluar_delete->pegawai->Visible) { // pegawai ?>
		<td <?php echo $dinasluar_delete->pegawai->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_delete->RowCount ?>_dinasluar_pegawai" class="dinasluar_pegawai">
<span<?php echo $dinasluar_delete->pegawai->viewAttributes() ?>><?php echo $dinasluar_delete->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dinasluar_delete->pm->Visible) { // pm ?>
		<td <?php echo $dinasluar_delete->pm->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_delete->RowCount ?>_dinasluar_pm" class="dinasluar_pm">
<span<?php echo $dinasluar_delete->pm->viewAttributes() ?>><?php echo $dinasluar_delete->pm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dinasluar_delete->proyek->Visible) { // proyek ?>
		<td <?php echo $dinasluar_delete->proyek->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_delete->RowCount ?>_dinasluar_proyek" class="dinasluar_proyek">
<span<?php echo $dinasluar_delete->proyek->viewAttributes() ?>><?php echo $dinasluar_delete->proyek->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dinasluar_delete->tgl->Visible) { // tgl ?>
		<td <?php echo $dinasluar_delete->tgl->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_delete->RowCount ?>_dinasluar_tgl" class="dinasluar_tgl">
<span<?php echo $dinasluar_delete->tgl->viewAttributes() ?>><?php echo $dinasluar_delete->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dinasluar_delete->tgl_dl_awal->Visible) { // tgl_dl_awal ?>
		<td <?php echo $dinasluar_delete->tgl_dl_awal->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_delete->RowCount ?>_dinasluar_tgl_dl_awal" class="dinasluar_tgl_dl_awal">
<span<?php echo $dinasluar_delete->tgl_dl_awal->viewAttributes() ?>><?php echo $dinasluar_delete->tgl_dl_awal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dinasluar_delete->tgl_dl_akhir->Visible) { // tgl_dl_akhir ?>
		<td <?php echo $dinasluar_delete->tgl_dl_akhir->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_delete->RowCount ?>_dinasluar_tgl_dl_akhir" class="dinasluar_tgl_dl_akhir">
<span<?php echo $dinasluar_delete->tgl_dl_akhir->viewAttributes() ?>><?php echo $dinasluar_delete->tgl_dl_akhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dinasluar_delete->jenis->Visible) { // jenis ?>
		<td <?php echo $dinasluar_delete->jenis->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_delete->RowCount ?>_dinasluar_jenis" class="dinasluar_jenis">
<span<?php echo $dinasluar_delete->jenis->viewAttributes() ?>><?php echo $dinasluar_delete->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dinasluar_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $dinasluar_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_delete->RowCount ?>_dinasluar_keterangan" class="dinasluar_keterangan">
<span<?php echo $dinasluar_delete->keterangan->viewAttributes() ?>><?php echo $dinasluar_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dinasluar_delete->disetujui->Visible) { // disetujui ?>
		<td <?php echo $dinasluar_delete->disetujui->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_delete->RowCount ?>_dinasluar_disetujui" class="dinasluar_disetujui">
<span<?php echo $dinasluar_delete->disetujui->viewAttributes() ?>><?php echo $dinasluar_delete->disetujui->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($dinasluar_delete->dokumen->Visible) { // dokumen ?>
		<td <?php echo $dinasluar_delete->dokumen->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_delete->RowCount ?>_dinasluar_dokumen" class="dinasluar_dokumen">
<span<?php echo $dinasluar_delete->dokumen->viewAttributes() ?>><?php echo GetFileViewTag($dinasluar_delete->dokumen, $dinasluar_delete->dokumen->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$dinasluar_delete->Recordset->moveNext();
}
$dinasluar_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $dinasluar_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$dinasluar_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$dinasluar_delete->terminate();
?>