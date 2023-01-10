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
$reimbursh_delete = new reimbursh_delete();

// Run the page
$reimbursh_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$reimbursh_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var freimburshdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	freimburshdelete = currentForm = new ew.Form("freimburshdelete", "delete");
	loadjs.done("freimburshdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $reimbursh_delete->showPageHeader(); ?>
<?php
$reimbursh_delete->showMessage();
?>
<form name="freimburshdelete" id="freimburshdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="reimbursh">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($reimbursh_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($reimbursh_delete->id->Visible) { // id ?>
		<th class="<?php echo $reimbursh_delete->id->headerCellClass() ?>"><span id="elh_reimbursh_id" class="reimbursh_id"><?php echo $reimbursh_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->pegawai->Visible) { // pegawai ?>
		<th class="<?php echo $reimbursh_delete->pegawai->headerCellClass() ?>"><span id="elh_reimbursh_pegawai" class="reimbursh_pegawai"><?php echo $reimbursh_delete->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $reimbursh_delete->nama->headerCellClass() ?>"><span id="elh_reimbursh_nama" class="reimbursh_nama"><?php echo $reimbursh_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->tgl->Visible) { // tgl ?>
		<th class="<?php echo $reimbursh_delete->tgl->headerCellClass() ?>"><span id="elh_reimbursh_tgl" class="reimbursh_tgl"><?php echo $reimbursh_delete->tgl->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->total_pengajuan->Visible) { // total_pengajuan ?>
		<th class="<?php echo $reimbursh_delete->total_pengajuan->headerCellClass() ?>"><span id="elh_reimbursh_total_pengajuan" class="reimbursh_total_pengajuan"><?php echo $reimbursh_delete->total_pengajuan->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->tgl_pengajuan->Visible) { // tgl_pengajuan ?>
		<th class="<?php echo $reimbursh_delete->tgl_pengajuan->headerCellClass() ?>"><span id="elh_reimbursh_tgl_pengajuan" class="reimbursh_tgl_pengajuan"><?php echo $reimbursh_delete->tgl_pengajuan->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->jenis->Visible) { // jenis ?>
		<th class="<?php echo $reimbursh_delete->jenis->headerCellClass() ?>"><span id="elh_reimbursh_jenis" class="reimbursh_jenis"><?php echo $reimbursh_delete->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->rek_tujuan->Visible) { // rek_tujuan ?>
		<th class="<?php echo $reimbursh_delete->rek_tujuan->headerCellClass() ?>"><span id="elh_reimbursh_rek_tujuan" class="reimbursh_rek_tujuan"><?php echo $reimbursh_delete->rek_tujuan->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->bukti1->Visible) { // bukti1 ?>
		<th class="<?php echo $reimbursh_delete->bukti1->headerCellClass() ?>"><span id="elh_reimbursh_bukti1" class="reimbursh_bukti1"><?php echo $reimbursh_delete->bukti1->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->bukti2->Visible) { // bukti2 ?>
		<th class="<?php echo $reimbursh_delete->bukti2->headerCellClass() ?>"><span id="elh_reimbursh_bukti2" class="reimbursh_bukti2"><?php echo $reimbursh_delete->bukti2->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->bukti3->Visible) { // bukti3 ?>
		<th class="<?php echo $reimbursh_delete->bukti3->headerCellClass() ?>"><span id="elh_reimbursh_bukti3" class="reimbursh_bukti3"><?php echo $reimbursh_delete->bukti3->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->bukti4->Visible) { // bukti4 ?>
		<th class="<?php echo $reimbursh_delete->bukti4->headerCellClass() ?>"><span id="elh_reimbursh_bukti4" class="reimbursh_bukti4"><?php echo $reimbursh_delete->bukti4->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->disetujui->Visible) { // disetujui ?>
		<th class="<?php echo $reimbursh_delete->disetujui->headerCellClass() ?>"><span id="elh_reimbursh_disetujui" class="reimbursh_disetujui"><?php echo $reimbursh_delete->disetujui->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->pembayar->Visible) { // pembayar ?>
		<th class="<?php echo $reimbursh_delete->pembayar->headerCellClass() ?>"><span id="elh_reimbursh_pembayar" class="reimbursh_pembayar"><?php echo $reimbursh_delete->pembayar->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->terbayar->Visible) { // terbayar ?>
		<th class="<?php echo $reimbursh_delete->terbayar->headerCellClass() ?>"><span id="elh_reimbursh_terbayar" class="reimbursh_terbayar"><?php echo $reimbursh_delete->terbayar->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->tgl_pembayaran->Visible) { // tgl_pembayaran ?>
		<th class="<?php echo $reimbursh_delete->tgl_pembayaran->headerCellClass() ?>"><span id="elh_reimbursh_tgl_pembayaran" class="reimbursh_tgl_pembayaran"><?php echo $reimbursh_delete->tgl_pembayaran->caption() ?></span></th>
<?php } ?>
<?php if ($reimbursh_delete->jumlah_dibayar->Visible) { // jumlah_dibayar ?>
		<th class="<?php echo $reimbursh_delete->jumlah_dibayar->headerCellClass() ?>"><span id="elh_reimbursh_jumlah_dibayar" class="reimbursh_jumlah_dibayar"><?php echo $reimbursh_delete->jumlah_dibayar->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$reimbursh_delete->RecordCount = 0;
$i = 0;
while (!$reimbursh_delete->Recordset->EOF) {
	$reimbursh_delete->RecordCount++;
	$reimbursh_delete->RowCount++;

	// Set row properties
	$reimbursh->resetAttributes();
	$reimbursh->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$reimbursh_delete->loadRowValues($reimbursh_delete->Recordset);

	// Render row
	$reimbursh_delete->renderRow();
?>
	<tr <?php echo $reimbursh->rowAttributes() ?>>
<?php if ($reimbursh_delete->id->Visible) { // id ?>
		<td <?php echo $reimbursh_delete->id->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_id" class="reimbursh_id">
<span<?php echo $reimbursh_delete->id->viewAttributes() ?>><?php echo $reimbursh_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->pegawai->Visible) { // pegawai ?>
		<td <?php echo $reimbursh_delete->pegawai->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_pegawai" class="reimbursh_pegawai">
<span<?php echo $reimbursh_delete->pegawai->viewAttributes() ?>><?php echo $reimbursh_delete->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->nama->Visible) { // nama ?>
		<td <?php echo $reimbursh_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_nama" class="reimbursh_nama">
<span<?php echo $reimbursh_delete->nama->viewAttributes() ?>><?php echo $reimbursh_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->tgl->Visible) { // tgl ?>
		<td <?php echo $reimbursh_delete->tgl->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_tgl" class="reimbursh_tgl">
<span<?php echo $reimbursh_delete->tgl->viewAttributes() ?>><?php echo $reimbursh_delete->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->total_pengajuan->Visible) { // total_pengajuan ?>
		<td <?php echo $reimbursh_delete->total_pengajuan->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_total_pengajuan" class="reimbursh_total_pengajuan">
<span<?php echo $reimbursh_delete->total_pengajuan->viewAttributes() ?>><?php echo $reimbursh_delete->total_pengajuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->tgl_pengajuan->Visible) { // tgl_pengajuan ?>
		<td <?php echo $reimbursh_delete->tgl_pengajuan->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_tgl_pengajuan" class="reimbursh_tgl_pengajuan">
<span<?php echo $reimbursh_delete->tgl_pengajuan->viewAttributes() ?>><?php echo $reimbursh_delete->tgl_pengajuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->jenis->Visible) { // jenis ?>
		<td <?php echo $reimbursh_delete->jenis->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_jenis" class="reimbursh_jenis">
<span<?php echo $reimbursh_delete->jenis->viewAttributes() ?>><?php echo $reimbursh_delete->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->rek_tujuan->Visible) { // rek_tujuan ?>
		<td <?php echo $reimbursh_delete->rek_tujuan->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_rek_tujuan" class="reimbursh_rek_tujuan">
<span<?php echo $reimbursh_delete->rek_tujuan->viewAttributes() ?>><?php echo $reimbursh_delete->rek_tujuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->bukti1->Visible) { // bukti1 ?>
		<td <?php echo $reimbursh_delete->bukti1->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_bukti1" class="reimbursh_bukti1">
<span<?php echo $reimbursh_delete->bukti1->viewAttributes() ?>><?php echo $reimbursh_delete->bukti1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->bukti2->Visible) { // bukti2 ?>
		<td <?php echo $reimbursh_delete->bukti2->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_bukti2" class="reimbursh_bukti2">
<span<?php echo $reimbursh_delete->bukti2->viewAttributes() ?>><?php echo $reimbursh_delete->bukti2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->bukti3->Visible) { // bukti3 ?>
		<td <?php echo $reimbursh_delete->bukti3->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_bukti3" class="reimbursh_bukti3">
<span<?php echo $reimbursh_delete->bukti3->viewAttributes() ?>><?php echo $reimbursh_delete->bukti3->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->bukti4->Visible) { // bukti4 ?>
		<td <?php echo $reimbursh_delete->bukti4->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_bukti4" class="reimbursh_bukti4">
<span<?php echo $reimbursh_delete->bukti4->viewAttributes() ?>><?php echo $reimbursh_delete->bukti4->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->disetujui->Visible) { // disetujui ?>
		<td <?php echo $reimbursh_delete->disetujui->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_disetujui" class="reimbursh_disetujui">
<span<?php echo $reimbursh_delete->disetujui->viewAttributes() ?>><?php echo $reimbursh_delete->disetujui->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->pembayar->Visible) { // pembayar ?>
		<td <?php echo $reimbursh_delete->pembayar->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_pembayar" class="reimbursh_pembayar">
<span<?php echo $reimbursh_delete->pembayar->viewAttributes() ?>><?php echo $reimbursh_delete->pembayar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->terbayar->Visible) { // terbayar ?>
		<td <?php echo $reimbursh_delete->terbayar->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_terbayar" class="reimbursh_terbayar">
<span<?php echo $reimbursh_delete->terbayar->viewAttributes() ?>><?php echo $reimbursh_delete->terbayar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->tgl_pembayaran->Visible) { // tgl_pembayaran ?>
		<td <?php echo $reimbursh_delete->tgl_pembayaran->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_tgl_pembayaran" class="reimbursh_tgl_pembayaran">
<span<?php echo $reimbursh_delete->tgl_pembayaran->viewAttributes() ?>><?php echo $reimbursh_delete->tgl_pembayaran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($reimbursh_delete->jumlah_dibayar->Visible) { // jumlah_dibayar ?>
		<td <?php echo $reimbursh_delete->jumlah_dibayar->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_delete->RowCount ?>_reimbursh_jumlah_dibayar" class="reimbursh_jumlah_dibayar">
<span<?php echo $reimbursh_delete->jumlah_dibayar->viewAttributes() ?>><?php echo $reimbursh_delete->jumlah_dibayar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$reimbursh_delete->Recordset->moveNext();
}
$reimbursh_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $reimbursh_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$reimbursh_delete->showPageFooter();
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
$reimbursh_delete->terminate();
?>