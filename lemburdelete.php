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
$lembur_delete = new lembur_delete();

// Run the page
$lembur_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lembur_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var flemburdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	flemburdelete = currentForm = new ew.Form("flemburdelete", "delete");
	loadjs.done("flemburdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $lembur_delete->showPageHeader(); ?>
<?php
$lembur_delete->showMessage();
?>
<form name="flemburdelete" id="flemburdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lembur">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($lembur_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($lembur_delete->pegawai->Visible) { // pegawai ?>
		<th class="<?php echo $lembur_delete->pegawai->headerCellClass() ?>"><span id="elh_lembur_pegawai" class="lembur_pegawai"><?php echo $lembur_delete->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($lembur_delete->pm->Visible) { // pm ?>
		<th class="<?php echo $lembur_delete->pm->headerCellClass() ?>"><span id="elh_lembur_pm" class="lembur_pm"><?php echo $lembur_delete->pm->caption() ?></span></th>
<?php } ?>
<?php if ($lembur_delete->proyek->Visible) { // proyek ?>
		<th class="<?php echo $lembur_delete->proyek->headerCellClass() ?>"><span id="elh_lembur_proyek" class="lembur_proyek"><?php echo $lembur_delete->proyek->caption() ?></span></th>
<?php } ?>
<?php if ($lembur_delete->tgl->Visible) { // tgl ?>
		<th class="<?php echo $lembur_delete->tgl->headerCellClass() ?>"><span id="elh_lembur_tgl" class="lembur_tgl"><?php echo $lembur_delete->tgl->caption() ?></span></th>
<?php } ?>
<?php if ($lembur_delete->tgl_awal_lembur->Visible) { // tgl_awal_lembur ?>
		<th class="<?php echo $lembur_delete->tgl_awal_lembur->headerCellClass() ?>"><span id="elh_lembur_tgl_awal_lembur" class="lembur_tgl_awal_lembur"><?php echo $lembur_delete->tgl_awal_lembur->caption() ?></span></th>
<?php } ?>
<?php if ($lembur_delete->tgl_akhir_lembur->Visible) { // tgl_akhir_lembur ?>
		<th class="<?php echo $lembur_delete->tgl_akhir_lembur->headerCellClass() ?>"><span id="elh_lembur_tgl_akhir_lembur" class="lembur_tgl_akhir_lembur"><?php echo $lembur_delete->tgl_akhir_lembur->caption() ?></span></th>
<?php } ?>
<?php if ($lembur_delete->total_jam->Visible) { // total_jam ?>
		<th class="<?php echo $lembur_delete->total_jam->headerCellClass() ?>"><span id="elh_lembur_total_jam" class="lembur_total_jam"><?php echo $lembur_delete->total_jam->caption() ?></span></th>
<?php } ?>
<?php if ($lembur_delete->jenis->Visible) { // jenis ?>
		<th class="<?php echo $lembur_delete->jenis->headerCellClass() ?>"><span id="elh_lembur_jenis" class="lembur_jenis"><?php echo $lembur_delete->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($lembur_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $lembur_delete->keterangan->headerCellClass() ?>"><span id="elh_lembur_keterangan" class="lembur_keterangan"><?php echo $lembur_delete->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($lembur_delete->disetujui->Visible) { // disetujui ?>
		<th class="<?php echo $lembur_delete->disetujui->headerCellClass() ?>"><span id="elh_lembur_disetujui" class="lembur_disetujui"><?php echo $lembur_delete->disetujui->caption() ?></span></th>
<?php } ?>
<?php if ($lembur_delete->dokumen->Visible) { // dokumen ?>
		<th class="<?php echo $lembur_delete->dokumen->headerCellClass() ?>"><span id="elh_lembur_dokumen" class="lembur_dokumen"><?php echo $lembur_delete->dokumen->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$lembur_delete->RecordCount = 0;
$i = 0;
while (!$lembur_delete->Recordset->EOF) {
	$lembur_delete->RecordCount++;
	$lembur_delete->RowCount++;

	// Set row properties
	$lembur->resetAttributes();
	$lembur->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$lembur_delete->loadRowValues($lembur_delete->Recordset);

	// Render row
	$lembur_delete->renderRow();
?>
	<tr <?php echo $lembur->rowAttributes() ?>>
<?php if ($lembur_delete->pegawai->Visible) { // pegawai ?>
		<td <?php echo $lembur_delete->pegawai->cellAttributes() ?>>
<span id="el<?php echo $lembur_delete->RowCount ?>_lembur_pegawai" class="lembur_pegawai">
<span<?php echo $lembur_delete->pegawai->viewAttributes() ?>><?php echo $lembur_delete->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lembur_delete->pm->Visible) { // pm ?>
		<td <?php echo $lembur_delete->pm->cellAttributes() ?>>
<span id="el<?php echo $lembur_delete->RowCount ?>_lembur_pm" class="lembur_pm">
<span<?php echo $lembur_delete->pm->viewAttributes() ?>><?php echo $lembur_delete->pm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lembur_delete->proyek->Visible) { // proyek ?>
		<td <?php echo $lembur_delete->proyek->cellAttributes() ?>>
<span id="el<?php echo $lembur_delete->RowCount ?>_lembur_proyek" class="lembur_proyek">
<span<?php echo $lembur_delete->proyek->viewAttributes() ?>><?php echo $lembur_delete->proyek->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lembur_delete->tgl->Visible) { // tgl ?>
		<td <?php echo $lembur_delete->tgl->cellAttributes() ?>>
<span id="el<?php echo $lembur_delete->RowCount ?>_lembur_tgl" class="lembur_tgl">
<span<?php echo $lembur_delete->tgl->viewAttributes() ?>><?php echo $lembur_delete->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lembur_delete->tgl_awal_lembur->Visible) { // tgl_awal_lembur ?>
		<td <?php echo $lembur_delete->tgl_awal_lembur->cellAttributes() ?>>
<span id="el<?php echo $lembur_delete->RowCount ?>_lembur_tgl_awal_lembur" class="lembur_tgl_awal_lembur">
<span<?php echo $lembur_delete->tgl_awal_lembur->viewAttributes() ?>><?php echo $lembur_delete->tgl_awal_lembur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lembur_delete->tgl_akhir_lembur->Visible) { // tgl_akhir_lembur ?>
		<td <?php echo $lembur_delete->tgl_akhir_lembur->cellAttributes() ?>>
<span id="el<?php echo $lembur_delete->RowCount ?>_lembur_tgl_akhir_lembur" class="lembur_tgl_akhir_lembur">
<span<?php echo $lembur_delete->tgl_akhir_lembur->viewAttributes() ?>><?php echo $lembur_delete->tgl_akhir_lembur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lembur_delete->total_jam->Visible) { // total_jam ?>
		<td <?php echo $lembur_delete->total_jam->cellAttributes() ?>>
<span id="el<?php echo $lembur_delete->RowCount ?>_lembur_total_jam" class="lembur_total_jam">
<span<?php echo $lembur_delete->total_jam->viewAttributes() ?>><?php echo $lembur_delete->total_jam->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lembur_delete->jenis->Visible) { // jenis ?>
		<td <?php echo $lembur_delete->jenis->cellAttributes() ?>>
<span id="el<?php echo $lembur_delete->RowCount ?>_lembur_jenis" class="lembur_jenis">
<span<?php echo $lembur_delete->jenis->viewAttributes() ?>><?php echo $lembur_delete->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lembur_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $lembur_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $lembur_delete->RowCount ?>_lembur_keterangan" class="lembur_keterangan">
<span<?php echo $lembur_delete->keterangan->viewAttributes() ?>><?php echo $lembur_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lembur_delete->disetujui->Visible) { // disetujui ?>
		<td <?php echo $lembur_delete->disetujui->cellAttributes() ?>>
<span id="el<?php echo $lembur_delete->RowCount ?>_lembur_disetujui" class="lembur_disetujui">
<span<?php echo $lembur_delete->disetujui->viewAttributes() ?>><?php echo $lembur_delete->disetujui->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($lembur_delete->dokumen->Visible) { // dokumen ?>
		<td <?php echo $lembur_delete->dokumen->cellAttributes() ?>>
<span id="el<?php echo $lembur_delete->RowCount ?>_lembur_dokumen" class="lembur_dokumen">
<span<?php echo $lembur_delete->dokumen->viewAttributes() ?>><?php echo GetFileViewTag($lembur_delete->dokumen, $lembur_delete->dokumen->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$lembur_delete->Recordset->moveNext();
}
$lembur_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $lembur_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$lembur_delete->showPageFooter();
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
$lembur_delete->terminate();
?>