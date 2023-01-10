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
$daftarbarang_delete = new daftarbarang_delete();

// Run the page
$daftarbarang_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$daftarbarang_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fdaftarbarangdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fdaftarbarangdelete = currentForm = new ew.Form("fdaftarbarangdelete", "delete");
	loadjs.done("fdaftarbarangdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $daftarbarang_delete->showPageHeader(); ?>
<?php
$daftarbarang_delete->showMessage();
?>
<form name="fdaftarbarangdelete" id="fdaftarbarangdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="daftarbarang">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($daftarbarang_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($daftarbarang_delete->id->Visible) { // id ?>
		<th class="<?php echo $daftarbarang_delete->id->headerCellClass() ?>"><span id="elh_daftarbarang_id" class="daftarbarang_id"><?php echo $daftarbarang_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($daftarbarang_delete->pemegang->Visible) { // pemegang ?>
		<th class="<?php echo $daftarbarang_delete->pemegang->headerCellClass() ?>"><span id="elh_daftarbarang_pemegang" class="daftarbarang_pemegang"><?php echo $daftarbarang_delete->pemegang->caption() ?></span></th>
<?php } ?>
<?php if ($daftarbarang_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $daftarbarang_delete->nama->headerCellClass() ?>"><span id="elh_daftarbarang_nama" class="daftarbarang_nama"><?php echo $daftarbarang_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($daftarbarang_delete->jenis->Visible) { // jenis ?>
		<th class="<?php echo $daftarbarang_delete->jenis->headerCellClass() ?>"><span id="elh_daftarbarang_jenis" class="daftarbarang_jenis"><?php echo $daftarbarang_delete->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($daftarbarang_delete->sepsifikasi->Visible) { // sepsifikasi ?>
		<th class="<?php echo $daftarbarang_delete->sepsifikasi->headerCellClass() ?>"><span id="elh_daftarbarang_sepsifikasi" class="daftarbarang_sepsifikasi"><?php echo $daftarbarang_delete->sepsifikasi->caption() ?></span></th>
<?php } ?>
<?php if ($daftarbarang_delete->tgl_terima->Visible) { // tgl_terima ?>
		<th class="<?php echo $daftarbarang_delete->tgl_terima->headerCellClass() ?>"><span id="elh_daftarbarang_tgl_terima" class="daftarbarang_tgl_terima"><?php echo $daftarbarang_delete->tgl_terima->caption() ?></span></th>
<?php } ?>
<?php if ($daftarbarang_delete->tgl_beli->Visible) { // tgl_beli ?>
		<th class="<?php echo $daftarbarang_delete->tgl_beli->headerCellClass() ?>"><span id="elh_daftarbarang_tgl_beli" class="daftarbarang_tgl_beli"><?php echo $daftarbarang_delete->tgl_beli->caption() ?></span></th>
<?php } ?>
<?php if ($daftarbarang_delete->harga->Visible) { // harga ?>
		<th class="<?php echo $daftarbarang_delete->harga->headerCellClass() ?>"><span id="elh_daftarbarang_harga" class="daftarbarang_harga"><?php echo $daftarbarang_delete->harga->caption() ?></span></th>
<?php } ?>
<?php if ($daftarbarang_delete->dokumen->Visible) { // dokumen ?>
		<th class="<?php echo $daftarbarang_delete->dokumen->headerCellClass() ?>"><span id="elh_daftarbarang_dokumen" class="daftarbarang_dokumen"><?php echo $daftarbarang_delete->dokumen->caption() ?></span></th>
<?php } ?>
<?php if ($daftarbarang_delete->foto->Visible) { // foto ?>
		<th class="<?php echo $daftarbarang_delete->foto->headerCellClass() ?>"><span id="elh_daftarbarang_foto" class="daftarbarang_foto"><?php echo $daftarbarang_delete->foto->caption() ?></span></th>
<?php } ?>
<?php if ($daftarbarang_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $daftarbarang_delete->keterangan->headerCellClass() ?>"><span id="elh_daftarbarang_keterangan" class="daftarbarang_keterangan"><?php echo $daftarbarang_delete->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($daftarbarang_delete->deskripsi->Visible) { // deskripsi ?>
		<th class="<?php echo $daftarbarang_delete->deskripsi->headerCellClass() ?>"><span id="elh_daftarbarang_deskripsi" class="daftarbarang_deskripsi"><?php echo $daftarbarang_delete->deskripsi->caption() ?></span></th>
<?php } ?>
<?php if ($daftarbarang_delete->status->Visible) { // status ?>
		<th class="<?php echo $daftarbarang_delete->status->headerCellClass() ?>"><span id="elh_daftarbarang_status" class="daftarbarang_status"><?php echo $daftarbarang_delete->status->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$daftarbarang_delete->RecordCount = 0;
$i = 0;
while (!$daftarbarang_delete->Recordset->EOF) {
	$daftarbarang_delete->RecordCount++;
	$daftarbarang_delete->RowCount++;

	// Set row properties
	$daftarbarang->resetAttributes();
	$daftarbarang->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$daftarbarang_delete->loadRowValues($daftarbarang_delete->Recordset);

	// Render row
	$daftarbarang_delete->renderRow();
?>
	<tr <?php echo $daftarbarang->rowAttributes() ?>>
<?php if ($daftarbarang_delete->id->Visible) { // id ?>
		<td <?php echo $daftarbarang_delete->id->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_delete->RowCount ?>_daftarbarang_id" class="daftarbarang_id">
<span<?php echo $daftarbarang_delete->id->viewAttributes() ?>><?php echo $daftarbarang_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($daftarbarang_delete->pemegang->Visible) { // pemegang ?>
		<td <?php echo $daftarbarang_delete->pemegang->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_delete->RowCount ?>_daftarbarang_pemegang" class="daftarbarang_pemegang">
<span<?php echo $daftarbarang_delete->pemegang->viewAttributes() ?>><?php echo $daftarbarang_delete->pemegang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($daftarbarang_delete->nama->Visible) { // nama ?>
		<td <?php echo $daftarbarang_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_delete->RowCount ?>_daftarbarang_nama" class="daftarbarang_nama">
<span<?php echo $daftarbarang_delete->nama->viewAttributes() ?>><?php echo $daftarbarang_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($daftarbarang_delete->jenis->Visible) { // jenis ?>
		<td <?php echo $daftarbarang_delete->jenis->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_delete->RowCount ?>_daftarbarang_jenis" class="daftarbarang_jenis">
<span<?php echo $daftarbarang_delete->jenis->viewAttributes() ?>><?php echo $daftarbarang_delete->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($daftarbarang_delete->sepsifikasi->Visible) { // sepsifikasi ?>
		<td <?php echo $daftarbarang_delete->sepsifikasi->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_delete->RowCount ?>_daftarbarang_sepsifikasi" class="daftarbarang_sepsifikasi">
<span<?php echo $daftarbarang_delete->sepsifikasi->viewAttributes() ?>><?php echo $daftarbarang_delete->sepsifikasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($daftarbarang_delete->tgl_terima->Visible) { // tgl_terima ?>
		<td <?php echo $daftarbarang_delete->tgl_terima->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_delete->RowCount ?>_daftarbarang_tgl_terima" class="daftarbarang_tgl_terima">
<span<?php echo $daftarbarang_delete->tgl_terima->viewAttributes() ?>><?php echo $daftarbarang_delete->tgl_terima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($daftarbarang_delete->tgl_beli->Visible) { // tgl_beli ?>
		<td <?php echo $daftarbarang_delete->tgl_beli->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_delete->RowCount ?>_daftarbarang_tgl_beli" class="daftarbarang_tgl_beli">
<span<?php echo $daftarbarang_delete->tgl_beli->viewAttributes() ?>><?php echo $daftarbarang_delete->tgl_beli->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($daftarbarang_delete->harga->Visible) { // harga ?>
		<td <?php echo $daftarbarang_delete->harga->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_delete->RowCount ?>_daftarbarang_harga" class="daftarbarang_harga">
<span<?php echo $daftarbarang_delete->harga->viewAttributes() ?>><?php echo $daftarbarang_delete->harga->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($daftarbarang_delete->dokumen->Visible) { // dokumen ?>
		<td <?php echo $daftarbarang_delete->dokumen->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_delete->RowCount ?>_daftarbarang_dokumen" class="daftarbarang_dokumen">
<span<?php echo $daftarbarang_delete->dokumen->viewAttributes() ?>><?php echo GetFileViewTag($daftarbarang_delete->dokumen, $daftarbarang_delete->dokumen->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($daftarbarang_delete->foto->Visible) { // foto ?>
		<td <?php echo $daftarbarang_delete->foto->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_delete->RowCount ?>_daftarbarang_foto" class="daftarbarang_foto">
<span<?php echo $daftarbarang_delete->foto->viewAttributes() ?>><?php echo GetFileViewTag($daftarbarang_delete->foto, $daftarbarang_delete->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($daftarbarang_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $daftarbarang_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_delete->RowCount ?>_daftarbarang_keterangan" class="daftarbarang_keterangan">
<span<?php echo $daftarbarang_delete->keterangan->viewAttributes() ?>><?php echo $daftarbarang_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($daftarbarang_delete->deskripsi->Visible) { // deskripsi ?>
		<td <?php echo $daftarbarang_delete->deskripsi->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_delete->RowCount ?>_daftarbarang_deskripsi" class="daftarbarang_deskripsi">
<span<?php echo $daftarbarang_delete->deskripsi->viewAttributes() ?>><?php echo $daftarbarang_delete->deskripsi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($daftarbarang_delete->status->Visible) { // status ?>
		<td <?php echo $daftarbarang_delete->status->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_delete->RowCount ?>_daftarbarang_status" class="daftarbarang_status">
<span<?php echo $daftarbarang_delete->status->viewAttributes() ?>><?php echo $daftarbarang_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$daftarbarang_delete->Recordset->moveNext();
}
$daftarbarang_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $daftarbarang_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$daftarbarang_delete->showPageFooter();
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
$daftarbarang_delete->terminate();
?>