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
$uangmuka_delete = new uangmuka_delete();

// Run the page
$uangmuka_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$uangmuka_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fuangmukadelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fuangmukadelete = currentForm = new ew.Form("fuangmukadelete", "delete");
	loadjs.done("fuangmukadelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $uangmuka_delete->showPageHeader(); ?>
<?php
$uangmuka_delete->showMessage();
?>
<form name="fuangmukadelete" id="fuangmukadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="uangmuka">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($uangmuka_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($uangmuka_delete->id->Visible) { // id ?>
		<th class="<?php echo $uangmuka_delete->id->headerCellClass() ?>"><span id="elh_uangmuka_id" class="uangmuka_id"><?php echo $uangmuka_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->tgl->Visible) { // tgl ?>
		<th class="<?php echo $uangmuka_delete->tgl->headerCellClass() ?>"><span id="elh_uangmuka_tgl" class="uangmuka_tgl"><?php echo $uangmuka_delete->tgl->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->pembayar->Visible) { // pembayar ?>
		<th class="<?php echo $uangmuka_delete->pembayar->headerCellClass() ?>"><span id="elh_uangmuka_pembayar" class="uangmuka_pembayar"><?php echo $uangmuka_delete->pembayar->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->peruntukan->Visible) { // peruntukan ?>
		<th class="<?php echo $uangmuka_delete->peruntukan->headerCellClass() ?>"><span id="elh_uangmuka_peruntukan" class="uangmuka_peruntukan"><?php echo $uangmuka_delete->peruntukan->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->penerima->Visible) { // penerima ?>
		<th class="<?php echo $uangmuka_delete->penerima->headerCellClass() ?>"><span id="elh_uangmuka_penerima" class="uangmuka_penerima"><?php echo $uangmuka_delete->penerima->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->rek_penerima->Visible) { // rek_penerima ?>
		<th class="<?php echo $uangmuka_delete->rek_penerima->headerCellClass() ?>"><span id="elh_uangmuka_rek_penerima" class="uangmuka_rek_penerima"><?php echo $uangmuka_delete->rek_penerima->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->tgl_terima->Visible) { // tgl_terima ?>
		<th class="<?php echo $uangmuka_delete->tgl_terima->headerCellClass() ?>"><span id="elh_uangmuka_tgl_terima" class="uangmuka_tgl_terima"><?php echo $uangmuka_delete->tgl_terima->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->total_terima->Visible) { // total_terima ?>
		<th class="<?php echo $uangmuka_delete->total_terima->headerCellClass() ?>"><span id="elh_uangmuka_total_terima" class="uangmuka_total_terima"><?php echo $uangmuka_delete->total_terima->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->tgl_tgjb->Visible) { // tgl_tgjb ?>
		<th class="<?php echo $uangmuka_delete->tgl_tgjb->headerCellClass() ?>"><span id="elh_uangmuka_tgl_tgjb" class="uangmuka_tgl_tgjb"><?php echo $uangmuka_delete->tgl_tgjb->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->jumlah_tgjb->Visible) { // jumlah_tgjb ?>
		<th class="<?php echo $uangmuka_delete->jumlah_tgjb->headerCellClass() ?>"><span id="elh_uangmuka_jumlah_tgjb" class="uangmuka_jumlah_tgjb"><?php echo $uangmuka_delete->jumlah_tgjb->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->jenis->Visible) { // jenis ?>
		<th class="<?php echo $uangmuka_delete->jenis->headerCellClass() ?>"><span id="elh_uangmuka_jenis" class="uangmuka_jenis"><?php echo $uangmuka_delete->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->bukti1->Visible) { // bukti1 ?>
		<th class="<?php echo $uangmuka_delete->bukti1->headerCellClass() ?>"><span id="elh_uangmuka_bukti1" class="uangmuka_bukti1"><?php echo $uangmuka_delete->bukti1->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->bukti2->Visible) { // bukti2 ?>
		<th class="<?php echo $uangmuka_delete->bukti2->headerCellClass() ?>"><span id="elh_uangmuka_bukti2" class="uangmuka_bukti2"><?php echo $uangmuka_delete->bukti2->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->bukti3->Visible) { // bukti3 ?>
		<th class="<?php echo $uangmuka_delete->bukti3->headerCellClass() ?>"><span id="elh_uangmuka_bukti3" class="uangmuka_bukti3"><?php echo $uangmuka_delete->bukti3->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->bukti4->Visible) { // bukti4 ?>
		<th class="<?php echo $uangmuka_delete->bukti4->headerCellClass() ?>"><span id="elh_uangmuka_bukti4" class="uangmuka_bukti4"><?php echo $uangmuka_delete->bukti4->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->disetujui->Visible) { // disetujui ?>
		<th class="<?php echo $uangmuka_delete->disetujui->headerCellClass() ?>"><span id="elh_uangmuka_disetujui" class="uangmuka_disetujui"><?php echo $uangmuka_delete->disetujui->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->status->Visible) { // status ?>
		<th class="<?php echo $uangmuka_delete->status->headerCellClass() ?>"><span id="elh_uangmuka_status" class="uangmuka_status"><?php echo $uangmuka_delete->status->caption() ?></span></th>
<?php } ?>
<?php if ($uangmuka_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $uangmuka_delete->keterangan->headerCellClass() ?>"><span id="elh_uangmuka_keterangan" class="uangmuka_keterangan"><?php echo $uangmuka_delete->keterangan->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$uangmuka_delete->RecordCount = 0;
$i = 0;
while (!$uangmuka_delete->Recordset->EOF) {
	$uangmuka_delete->RecordCount++;
	$uangmuka_delete->RowCount++;

	// Set row properties
	$uangmuka->resetAttributes();
	$uangmuka->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$uangmuka_delete->loadRowValues($uangmuka_delete->Recordset);

	// Render row
	$uangmuka_delete->renderRow();
?>
	<tr <?php echo $uangmuka->rowAttributes() ?>>
<?php if ($uangmuka_delete->id->Visible) { // id ?>
		<td <?php echo $uangmuka_delete->id->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_id" class="uangmuka_id">
<span<?php echo $uangmuka_delete->id->viewAttributes() ?>><?php echo $uangmuka_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->tgl->Visible) { // tgl ?>
		<td <?php echo $uangmuka_delete->tgl->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_tgl" class="uangmuka_tgl">
<span<?php echo $uangmuka_delete->tgl->viewAttributes() ?>><?php echo $uangmuka_delete->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->pembayar->Visible) { // pembayar ?>
		<td <?php echo $uangmuka_delete->pembayar->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_pembayar" class="uangmuka_pembayar">
<span<?php echo $uangmuka_delete->pembayar->viewAttributes() ?>><?php echo $uangmuka_delete->pembayar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->peruntukan->Visible) { // peruntukan ?>
		<td <?php echo $uangmuka_delete->peruntukan->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_peruntukan" class="uangmuka_peruntukan">
<span<?php echo $uangmuka_delete->peruntukan->viewAttributes() ?>><?php echo $uangmuka_delete->peruntukan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->penerima->Visible) { // penerima ?>
		<td <?php echo $uangmuka_delete->penerima->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_penerima" class="uangmuka_penerima">
<span<?php echo $uangmuka_delete->penerima->viewAttributes() ?>><?php echo $uangmuka_delete->penerima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->rek_penerima->Visible) { // rek_penerima ?>
		<td <?php echo $uangmuka_delete->rek_penerima->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_rek_penerima" class="uangmuka_rek_penerima">
<span<?php echo $uangmuka_delete->rek_penerima->viewAttributes() ?>><?php echo $uangmuka_delete->rek_penerima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->tgl_terima->Visible) { // tgl_terima ?>
		<td <?php echo $uangmuka_delete->tgl_terima->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_tgl_terima" class="uangmuka_tgl_terima">
<span<?php echo $uangmuka_delete->tgl_terima->viewAttributes() ?>><?php echo $uangmuka_delete->tgl_terima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->total_terima->Visible) { // total_terima ?>
		<td <?php echo $uangmuka_delete->total_terima->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_total_terima" class="uangmuka_total_terima">
<span<?php echo $uangmuka_delete->total_terima->viewAttributes() ?>><?php echo $uangmuka_delete->total_terima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->tgl_tgjb->Visible) { // tgl_tgjb ?>
		<td <?php echo $uangmuka_delete->tgl_tgjb->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_tgl_tgjb" class="uangmuka_tgl_tgjb">
<span<?php echo $uangmuka_delete->tgl_tgjb->viewAttributes() ?>><?php echo $uangmuka_delete->tgl_tgjb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->jumlah_tgjb->Visible) { // jumlah_tgjb ?>
		<td <?php echo $uangmuka_delete->jumlah_tgjb->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_jumlah_tgjb" class="uangmuka_jumlah_tgjb">
<span<?php echo $uangmuka_delete->jumlah_tgjb->viewAttributes() ?>><?php echo $uangmuka_delete->jumlah_tgjb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->jenis->Visible) { // jenis ?>
		<td <?php echo $uangmuka_delete->jenis->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_jenis" class="uangmuka_jenis">
<span<?php echo $uangmuka_delete->jenis->viewAttributes() ?>><?php echo $uangmuka_delete->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->bukti1->Visible) { // bukti1 ?>
		<td <?php echo $uangmuka_delete->bukti1->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_bukti1" class="uangmuka_bukti1">
<span<?php echo $uangmuka_delete->bukti1->viewAttributes() ?>><?php echo GetFileViewTag($uangmuka_delete->bukti1, $uangmuka_delete->bukti1->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->bukti2->Visible) { // bukti2 ?>
		<td <?php echo $uangmuka_delete->bukti2->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_bukti2" class="uangmuka_bukti2">
<span<?php echo $uangmuka_delete->bukti2->viewAttributes() ?>><?php echo GetFileViewTag($uangmuka_delete->bukti2, $uangmuka_delete->bukti2->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->bukti3->Visible) { // bukti3 ?>
		<td <?php echo $uangmuka_delete->bukti3->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_bukti3" class="uangmuka_bukti3">
<span<?php echo $uangmuka_delete->bukti3->viewAttributes() ?>><?php echo GetFileViewTag($uangmuka_delete->bukti3, $uangmuka_delete->bukti3->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->bukti4->Visible) { // bukti4 ?>
		<td <?php echo $uangmuka_delete->bukti4->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_bukti4" class="uangmuka_bukti4">
<span<?php echo $uangmuka_delete->bukti4->viewAttributes() ?>><?php echo GetFileViewTag($uangmuka_delete->bukti4, $uangmuka_delete->bukti4->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->disetujui->Visible) { // disetujui ?>
		<td <?php echo $uangmuka_delete->disetujui->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_disetujui" class="uangmuka_disetujui">
<span<?php echo $uangmuka_delete->disetujui->viewAttributes() ?>><?php echo $uangmuka_delete->disetujui->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->status->Visible) { // status ?>
		<td <?php echo $uangmuka_delete->status->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_status" class="uangmuka_status">
<span<?php echo $uangmuka_delete->status->viewAttributes() ?>><?php echo $uangmuka_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($uangmuka_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $uangmuka_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_delete->RowCount ?>_uangmuka_keterangan" class="uangmuka_keterangan">
<span<?php echo $uangmuka_delete->keterangan->viewAttributes() ?>><?php echo $uangmuka_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$uangmuka_delete->Recordset->moveNext();
}
$uangmuka_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $uangmuka_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$uangmuka_delete->showPageFooter();
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
$uangmuka_delete->terminate();
?>