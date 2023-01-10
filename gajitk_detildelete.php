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
$gajitk_detil_delete = new gajitk_detil_delete();

// Run the page
$gajitk_detil_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitk_detil_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajitk_detildelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgajitk_detildelete = currentForm = new ew.Form("fgajitk_detildelete", "delete");
	loadjs.done("fgajitk_detildelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajitk_detil_delete->showPageHeader(); ?>
<?php
$gajitk_detil_delete->showMessage();
?>
<form name="fgajitk_detildelete" id="fgajitk_detildelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajitk_detil">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gajitk_detil_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gajitk_detil_delete->pegawai_id->Visible) { // pegawai_id ?>
		<th class="<?php echo $gajitk_detil_delete->pegawai_id->headerCellClass() ?>"><span id="elh_gajitk_detil_pegawai_id" class="gajitk_detil_pegawai_id"><?php echo $gajitk_detil_delete->pegawai_id->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->jabatan_id->Visible) { // jabatan_id ?>
		<th class="<?php echo $gajitk_detil_delete->jabatan_id->headerCellClass() ?>"><span id="elh_gajitk_detil_jabatan_id" class="gajitk_detil_jabatan_id"><?php echo $gajitk_detil_delete->jabatan_id->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->masakerja->Visible) { // masakerja ?>
		<th class="<?php echo $gajitk_detil_delete->masakerja->headerCellClass() ?>"><span id="elh_gajitk_detil_masakerja" class="gajitk_detil_masakerja"><?php echo $gajitk_detil_delete->masakerja->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->jumngajar->Visible) { // jumngajar ?>
		<th class="<?php echo $gajitk_detil_delete->jumngajar->headerCellClass() ?>"><span id="elh_gajitk_detil_jumngajar" class="gajitk_detil_jumngajar"><?php echo $gajitk_detil_delete->jumngajar->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->ijin->Visible) { // ijin ?>
		<th class="<?php echo $gajitk_detil_delete->ijin->headerCellClass() ?>"><span id="elh_gajitk_detil_ijin" class="gajitk_detil_ijin"><?php echo $gajitk_detil_delete->ijin->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->voucher->Visible) { // voucher ?>
		<th class="<?php echo $gajitk_detil_delete->voucher->headerCellClass() ?>"><span id="elh_gajitk_detil_voucher" class="gajitk_detil_voucher"><?php echo $gajitk_detil_delete->voucher->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
		<th class="<?php echo $gajitk_detil_delete->tunjangan_khusus->headerCellClass() ?>"><span id="elh_gajitk_detil_tunjangan_khusus" class="gajitk_detil_tunjangan_khusus"><?php echo $gajitk_detil_delete->tunjangan_khusus->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
		<th class="<?php echo $gajitk_detil_delete->tunjangan_jabatan->headerCellClass() ?>"><span id="elh_gajitk_detil_tunjangan_jabatan" class="gajitk_detil_tunjangan_jabatan"><?php echo $gajitk_detil_delete->tunjangan_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->baku->Visible) { // baku ?>
		<th class="<?php echo $gajitk_detil_delete->baku->headerCellClass() ?>"><span id="elh_gajitk_detil_baku" class="gajitk_detil_baku"><?php echo $gajitk_detil_delete->baku->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->kehadiran->Visible) { // kehadiran ?>
		<th class="<?php echo $gajitk_detil_delete->kehadiran->headerCellClass() ?>"><span id="elh_gajitk_detil_kehadiran" class="gajitk_detil_kehadiran"><?php echo $gajitk_detil_delete->kehadiran->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->prestasi->Visible) { // prestasi ?>
		<th class="<?php echo $gajitk_detil_delete->prestasi->headerCellClass() ?>"><span id="elh_gajitk_detil_prestasi" class="gajitk_detil_prestasi"><?php echo $gajitk_detil_delete->prestasi->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->jumlahgaji->Visible) { // jumlahgaji ?>
		<th class="<?php echo $gajitk_detil_delete->jumlahgaji->headerCellClass() ?>"><span id="elh_gajitk_detil_jumlahgaji" class="gajitk_detil_jumlahgaji"><?php echo $gajitk_detil_delete->jumlahgaji->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->jumgajitotal->Visible) { // jumgajitotal ?>
		<th class="<?php echo $gajitk_detil_delete->jumgajitotal->headerCellClass() ?>"><span id="elh_gajitk_detil_jumgajitotal" class="gajitk_detil_jumgajitotal"><?php echo $gajitk_detil_delete->jumgajitotal->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->potongan1->Visible) { // potongan1 ?>
		<th class="<?php echo $gajitk_detil_delete->potongan1->headerCellClass() ?>"><span id="elh_gajitk_detil_potongan1" class="gajitk_detil_potongan1"><?php echo $gajitk_detil_delete->potongan1->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->potongan2->Visible) { // potongan2 ?>
		<th class="<?php echo $gajitk_detil_delete->potongan2->headerCellClass() ?>"><span id="elh_gajitk_detil_potongan2" class="gajitk_detil_potongan2"><?php echo $gajitk_detil_delete->potongan2->caption() ?></span></th>
<?php } ?>
<?php if ($gajitk_detil_delete->jumlahterima->Visible) { // jumlahterima ?>
		<th class="<?php echo $gajitk_detil_delete->jumlahterima->headerCellClass() ?>"><span id="elh_gajitk_detil_jumlahterima" class="gajitk_detil_jumlahterima"><?php echo $gajitk_detil_delete->jumlahterima->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gajitk_detil_delete->RecordCount = 0;
$i = 0;
while (!$gajitk_detil_delete->Recordset->EOF) {
	$gajitk_detil_delete->RecordCount++;
	$gajitk_detil_delete->RowCount++;

	// Set row properties
	$gajitk_detil->resetAttributes();
	$gajitk_detil->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gajitk_detil_delete->loadRowValues($gajitk_detil_delete->Recordset);

	// Render row
	$gajitk_detil_delete->renderRow();
?>
	<tr <?php echo $gajitk_detil->rowAttributes() ?>>
<?php if ($gajitk_detil_delete->pegawai_id->Visible) { // pegawai_id ?>
		<td <?php echo $gajitk_detil_delete->pegawai_id->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_pegawai_id" class="gajitk_detil_pegawai_id">
<span<?php echo $gajitk_detil_delete->pegawai_id->viewAttributes() ?>><?php echo $gajitk_detil_delete->pegawai_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->jabatan_id->Visible) { // jabatan_id ?>
		<td <?php echo $gajitk_detil_delete->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_jabatan_id" class="gajitk_detil_jabatan_id">
<span<?php echo $gajitk_detil_delete->jabatan_id->viewAttributes() ?>><?php echo $gajitk_detil_delete->jabatan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->masakerja->Visible) { // masakerja ?>
		<td <?php echo $gajitk_detil_delete->masakerja->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_masakerja" class="gajitk_detil_masakerja">
<span<?php echo $gajitk_detil_delete->masakerja->viewAttributes() ?>><?php echo $gajitk_detil_delete->masakerja->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->jumngajar->Visible) { // jumngajar ?>
		<td <?php echo $gajitk_detil_delete->jumngajar->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_jumngajar" class="gajitk_detil_jumngajar">
<span<?php echo $gajitk_detil_delete->jumngajar->viewAttributes() ?>><?php echo $gajitk_detil_delete->jumngajar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->ijin->Visible) { // ijin ?>
		<td <?php echo $gajitk_detil_delete->ijin->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_ijin" class="gajitk_detil_ijin">
<span<?php echo $gajitk_detil_delete->ijin->viewAttributes() ?>><?php echo $gajitk_detil_delete->ijin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->voucher->Visible) { // voucher ?>
		<td <?php echo $gajitk_detil_delete->voucher->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_voucher" class="gajitk_detil_voucher">
<span<?php echo $gajitk_detil_delete->voucher->viewAttributes() ?>><?php echo $gajitk_detil_delete->voucher->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
		<td <?php echo $gajitk_detil_delete->tunjangan_khusus->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_tunjangan_khusus" class="gajitk_detil_tunjangan_khusus">
<span<?php echo $gajitk_detil_delete->tunjangan_khusus->viewAttributes() ?>><?php echo $gajitk_detil_delete->tunjangan_khusus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
		<td <?php echo $gajitk_detil_delete->tunjangan_jabatan->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_tunjangan_jabatan" class="gajitk_detil_tunjangan_jabatan">
<span<?php echo $gajitk_detil_delete->tunjangan_jabatan->viewAttributes() ?>><?php echo $gajitk_detil_delete->tunjangan_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->baku->Visible) { // baku ?>
		<td <?php echo $gajitk_detil_delete->baku->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_baku" class="gajitk_detil_baku">
<span<?php echo $gajitk_detil_delete->baku->viewAttributes() ?>><?php echo $gajitk_detil_delete->baku->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->kehadiran->Visible) { // kehadiran ?>
		<td <?php echo $gajitk_detil_delete->kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_kehadiran" class="gajitk_detil_kehadiran">
<span<?php echo $gajitk_detil_delete->kehadiran->viewAttributes() ?>><?php echo $gajitk_detil_delete->kehadiran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->prestasi->Visible) { // prestasi ?>
		<td <?php echo $gajitk_detil_delete->prestasi->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_prestasi" class="gajitk_detil_prestasi">
<span<?php echo $gajitk_detil_delete->prestasi->viewAttributes() ?>><?php echo $gajitk_detil_delete->prestasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->jumlahgaji->Visible) { // jumlahgaji ?>
		<td <?php echo $gajitk_detil_delete->jumlahgaji->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_jumlahgaji" class="gajitk_detil_jumlahgaji">
<span<?php echo $gajitk_detil_delete->jumlahgaji->viewAttributes() ?>><?php echo $gajitk_detil_delete->jumlahgaji->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->jumgajitotal->Visible) { // jumgajitotal ?>
		<td <?php echo $gajitk_detil_delete->jumgajitotal->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_jumgajitotal" class="gajitk_detil_jumgajitotal">
<span<?php echo $gajitk_detil_delete->jumgajitotal->viewAttributes() ?>><?php echo $gajitk_detil_delete->jumgajitotal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->potongan1->Visible) { // potongan1 ?>
		<td <?php echo $gajitk_detil_delete->potongan1->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_potongan1" class="gajitk_detil_potongan1">
<span<?php echo $gajitk_detil_delete->potongan1->viewAttributes() ?>><?php echo $gajitk_detil_delete->potongan1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->potongan2->Visible) { // potongan2 ?>
		<td <?php echo $gajitk_detil_delete->potongan2->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_potongan2" class="gajitk_detil_potongan2">
<span<?php echo $gajitk_detil_delete->potongan2->viewAttributes() ?>><?php echo $gajitk_detil_delete->potongan2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitk_detil_delete->jumlahterima->Visible) { // jumlahterima ?>
		<td <?php echo $gajitk_detil_delete->jumlahterima->cellAttributes() ?>>
<span id="el<?php echo $gajitk_detil_delete->RowCount ?>_gajitk_detil_jumlahterima" class="gajitk_detil_jumlahterima">
<span<?php echo $gajitk_detil_delete->jumlahterima->viewAttributes() ?>><?php echo $gajitk_detil_delete->jumlahterima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gajitk_detil_delete->Recordset->moveNext();
}
$gajitk_detil_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajitk_detil_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gajitk_detil_delete->showPageFooter();
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
$gajitk_detil_delete->terminate();
?>