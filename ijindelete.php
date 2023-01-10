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
$ijin_delete = new ijin_delete();

// Run the page
$ijin_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ijin_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fijindelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fijindelete = currentForm = new ew.Form("fijindelete", "delete");
	loadjs.done("fijindelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $ijin_delete->showPageHeader(); ?>
<?php
$ijin_delete->showMessage();
?>
<form name="fijindelete" id="fijindelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ijin">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($ijin_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($ijin_delete->id->Visible) { // id ?>
		<th class="<?php echo $ijin_delete->id->headerCellClass() ?>"><span id="elh_ijin_id" class="ijin_id"><?php echo $ijin_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($ijin_delete->pegawai->Visible) { // pegawai ?>
		<th class="<?php echo $ijin_delete->pegawai->headerCellClass() ?>"><span id="elh_ijin_pegawai" class="ijin_pegawai"><?php echo $ijin_delete->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($ijin_delete->tgl->Visible) { // tgl ?>
		<th class="<?php echo $ijin_delete->tgl->headerCellClass() ?>"><span id="elh_ijin_tgl" class="ijin_tgl"><?php echo $ijin_delete->tgl->caption() ?></span></th>
<?php } ?>
<?php if ($ijin_delete->tgl_ijin_awal->Visible) { // tgl_ijin_awal ?>
		<th class="<?php echo $ijin_delete->tgl_ijin_awal->headerCellClass() ?>"><span id="elh_ijin_tgl_ijin_awal" class="ijin_tgl_ijin_awal"><?php echo $ijin_delete->tgl_ijin_awal->caption() ?></span></th>
<?php } ?>
<?php if ($ijin_delete->tgl_ijin_akhir->Visible) { // tgl_ijin_akhir ?>
		<th class="<?php echo $ijin_delete->tgl_ijin_akhir->headerCellClass() ?>"><span id="elh_ijin_tgl_ijin_akhir" class="ijin_tgl_ijin_akhir"><?php echo $ijin_delete->tgl_ijin_akhir->caption() ?></span></th>
<?php } ?>
<?php if ($ijin_delete->jenis->Visible) { // jenis ?>
		<th class="<?php echo $ijin_delete->jenis->headerCellClass() ?>"><span id="elh_ijin_jenis" class="ijin_jenis"><?php echo $ijin_delete->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($ijin_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $ijin_delete->keterangan->headerCellClass() ?>"><span id="elh_ijin_keterangan" class="ijin_keterangan"><?php echo $ijin_delete->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($ijin_delete->disetujui->Visible) { // disetujui ?>
		<th class="<?php echo $ijin_delete->disetujui->headerCellClass() ?>"><span id="elh_ijin_disetujui" class="ijin_disetujui"><?php echo $ijin_delete->disetujui->caption() ?></span></th>
<?php } ?>
<?php if ($ijin_delete->dokumen->Visible) { // dokumen ?>
		<th class="<?php echo $ijin_delete->dokumen->headerCellClass() ?>"><span id="elh_ijin_dokumen" class="ijin_dokumen"><?php echo $ijin_delete->dokumen->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$ijin_delete->RecordCount = 0;
$i = 0;
while (!$ijin_delete->Recordset->EOF) {
	$ijin_delete->RecordCount++;
	$ijin_delete->RowCount++;

	// Set row properties
	$ijin->resetAttributes();
	$ijin->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$ijin_delete->loadRowValues($ijin_delete->Recordset);

	// Render row
	$ijin_delete->renderRow();
?>
	<tr <?php echo $ijin->rowAttributes() ?>>
<?php if ($ijin_delete->id->Visible) { // id ?>
		<td <?php echo $ijin_delete->id->cellAttributes() ?>>
<span id="el<?php echo $ijin_delete->RowCount ?>_ijin_id" class="ijin_id">
<span<?php echo $ijin_delete->id->viewAttributes() ?>><?php echo $ijin_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ijin_delete->pegawai->Visible) { // pegawai ?>
		<td <?php echo $ijin_delete->pegawai->cellAttributes() ?>>
<span id="el<?php echo $ijin_delete->RowCount ?>_ijin_pegawai" class="ijin_pegawai">
<span<?php echo $ijin_delete->pegawai->viewAttributes() ?>><?php echo $ijin_delete->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ijin_delete->tgl->Visible) { // tgl ?>
		<td <?php echo $ijin_delete->tgl->cellAttributes() ?>>
<span id="el<?php echo $ijin_delete->RowCount ?>_ijin_tgl" class="ijin_tgl">
<span<?php echo $ijin_delete->tgl->viewAttributes() ?>><?php echo $ijin_delete->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ijin_delete->tgl_ijin_awal->Visible) { // tgl_ijin_awal ?>
		<td <?php echo $ijin_delete->tgl_ijin_awal->cellAttributes() ?>>
<span id="el<?php echo $ijin_delete->RowCount ?>_ijin_tgl_ijin_awal" class="ijin_tgl_ijin_awal">
<span<?php echo $ijin_delete->tgl_ijin_awal->viewAttributes() ?>><?php echo $ijin_delete->tgl_ijin_awal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ijin_delete->tgl_ijin_akhir->Visible) { // tgl_ijin_akhir ?>
		<td <?php echo $ijin_delete->tgl_ijin_akhir->cellAttributes() ?>>
<span id="el<?php echo $ijin_delete->RowCount ?>_ijin_tgl_ijin_akhir" class="ijin_tgl_ijin_akhir">
<span<?php echo $ijin_delete->tgl_ijin_akhir->viewAttributes() ?>><?php echo $ijin_delete->tgl_ijin_akhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ijin_delete->jenis->Visible) { // jenis ?>
		<td <?php echo $ijin_delete->jenis->cellAttributes() ?>>
<span id="el<?php echo $ijin_delete->RowCount ?>_ijin_jenis" class="ijin_jenis">
<span<?php echo $ijin_delete->jenis->viewAttributes() ?>><?php echo $ijin_delete->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ijin_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $ijin_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $ijin_delete->RowCount ?>_ijin_keterangan" class="ijin_keterangan">
<span<?php echo $ijin_delete->keterangan->viewAttributes() ?>><?php echo $ijin_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ijin_delete->disetujui->Visible) { // disetujui ?>
		<td <?php echo $ijin_delete->disetujui->cellAttributes() ?>>
<span id="el<?php echo $ijin_delete->RowCount ?>_ijin_disetujui" class="ijin_disetujui">
<span<?php echo $ijin_delete->disetujui->viewAttributes() ?>><?php echo $ijin_delete->disetujui->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($ijin_delete->dokumen->Visible) { // dokumen ?>
		<td <?php echo $ijin_delete->dokumen->cellAttributes() ?>>
<span id="el<?php echo $ijin_delete->RowCount ?>_ijin_dokumen" class="ijin_dokumen">
<span<?php echo $ijin_delete->dokumen->viewAttributes() ?>><?php echo GetFileViewTag($ijin_delete->dokumen, $ijin_delete->dokumen->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$ijin_delete->Recordset->moveNext();
}
$ijin_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $ijin_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$ijin_delete->showPageFooter();
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
$ijin_delete->terminate();
?>