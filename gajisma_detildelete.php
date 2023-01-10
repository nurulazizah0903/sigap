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
$gajisma_detil_delete = new gajisma_detil_delete();

// Run the page
$gajisma_detil_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajisma_detil_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajisma_detildelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgajisma_detildelete = currentForm = new ew.Form("fgajisma_detildelete", "delete");
	loadjs.done("fgajisma_detildelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajisma_detil_delete->showPageHeader(); ?>
<?php
$gajisma_detil_delete->showMessage();
?>
<form name="fgajisma_detildelete" id="fgajisma_detildelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajisma_detil">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gajisma_detil_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gajisma_detil_delete->id->Visible) { // id ?>
		<th class="<?php echo $gajisma_detil_delete->id->headerCellClass() ?>"><span id="elh_gajisma_detil_id" class="gajisma_detil_id"><?php echo $gajisma_detil_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->pid->Visible) { // pid ?>
		<th class="<?php echo $gajisma_detil_delete->pid->headerCellClass() ?>"><span id="elh_gajisma_detil_pid" class="gajisma_detil_pid"><?php echo $gajisma_detil_delete->pid->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->pegawai_id->Visible) { // pegawai_id ?>
		<th class="<?php echo $gajisma_detil_delete->pegawai_id->headerCellClass() ?>"><span id="elh_gajisma_detil_pegawai_id" class="gajisma_detil_pegawai_id"><?php echo $gajisma_detil_delete->pegawai_id->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->jabatan_id->Visible) { // jabatan_id ?>
		<th class="<?php echo $gajisma_detil_delete->jabatan_id->headerCellClass() ?>"><span id="elh_gajisma_detil_jabatan_id" class="gajisma_detil_jabatan_id"><?php echo $gajisma_detil_delete->jabatan_id->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->masakerja->Visible) { // masakerja ?>
		<th class="<?php echo $gajisma_detil_delete->masakerja->headerCellClass() ?>"><span id="elh_gajisma_detil_masakerja" class="gajisma_detil_masakerja"><?php echo $gajisma_detil_delete->masakerja->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->jumngajar->Visible) { // jumngajar ?>
		<th class="<?php echo $gajisma_detil_delete->jumngajar->headerCellClass() ?>"><span id="elh_gajisma_detil_jumngajar" class="gajisma_detil_jumngajar"><?php echo $gajisma_detil_delete->jumngajar->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->ijin->Visible) { // ijin ?>
		<th class="<?php echo $gajisma_detil_delete->ijin->headerCellClass() ?>"><span id="elh_gajisma_detil_ijin" class="gajisma_detil_ijin"><?php echo $gajisma_detil_delete->ijin->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
		<th class="<?php echo $gajisma_detil_delete->tunjangan_wkosis->headerCellClass() ?>"><span id="elh_gajisma_detil_tunjangan_wkosis" class="gajisma_detil_tunjangan_wkosis"><?php echo $gajisma_detil_delete->tunjangan_wkosis->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->nominal_baku->Visible) { // nominal_baku ?>
		<th class="<?php echo $gajisma_detil_delete->nominal_baku->headerCellClass() ?>"><span id="elh_gajisma_detil_nominal_baku" class="gajisma_detil_nominal_baku"><?php echo $gajisma_detil_delete->nominal_baku->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->baku->Visible) { // baku ?>
		<th class="<?php echo $gajisma_detil_delete->baku->headerCellClass() ?>"><span id="elh_gajisma_detil_baku" class="gajisma_detil_baku"><?php echo $gajisma_detil_delete->baku->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->kehadiran->Visible) { // kehadiran ?>
		<th class="<?php echo $gajisma_detil_delete->kehadiran->headerCellClass() ?>"><span id="elh_gajisma_detil_kehadiran" class="gajisma_detil_kehadiran"><?php echo $gajisma_detil_delete->kehadiran->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->prestasi->Visible) { // prestasi ?>
		<th class="<?php echo $gajisma_detil_delete->prestasi->headerCellClass() ?>"><span id="elh_gajisma_detil_prestasi" class="gajisma_detil_prestasi"><?php echo $gajisma_detil_delete->prestasi->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->jumlahgaji->Visible) { // jumlahgaji ?>
		<th class="<?php echo $gajisma_detil_delete->jumlahgaji->headerCellClass() ?>"><span id="elh_gajisma_detil_jumlahgaji" class="gajisma_detil_jumlahgaji"><?php echo $gajisma_detil_delete->jumlahgaji->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->jumgajitotal->Visible) { // jumgajitotal ?>
		<th class="<?php echo $gajisma_detil_delete->jumgajitotal->headerCellClass() ?>"><span id="elh_gajisma_detil_jumgajitotal" class="gajisma_detil_jumgajitotal"><?php echo $gajisma_detil_delete->jumgajitotal->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->potongan1->Visible) { // potongan1 ?>
		<th class="<?php echo $gajisma_detil_delete->potongan1->headerCellClass() ?>"><span id="elh_gajisma_detil_potongan1" class="gajisma_detil_potongan1"><?php echo $gajisma_detil_delete->potongan1->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->potongan2->Visible) { // potongan2 ?>
		<th class="<?php echo $gajisma_detil_delete->potongan2->headerCellClass() ?>"><span id="elh_gajisma_detil_potongan2" class="gajisma_detil_potongan2"><?php echo $gajisma_detil_delete->potongan2->caption() ?></span></th>
<?php } ?>
<?php if ($gajisma_detil_delete->jumlahterima->Visible) { // jumlahterima ?>
		<th class="<?php echo $gajisma_detil_delete->jumlahterima->headerCellClass() ?>"><span id="elh_gajisma_detil_jumlahterima" class="gajisma_detil_jumlahterima"><?php echo $gajisma_detil_delete->jumlahterima->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gajisma_detil_delete->RecordCount = 0;
$i = 0;
while (!$gajisma_detil_delete->Recordset->EOF) {
	$gajisma_detil_delete->RecordCount++;
	$gajisma_detil_delete->RowCount++;

	// Set row properties
	$gajisma_detil->resetAttributes();
	$gajisma_detil->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gajisma_detil_delete->loadRowValues($gajisma_detil_delete->Recordset);

	// Render row
	$gajisma_detil_delete->renderRow();
?>
	<tr <?php echo $gajisma_detil->rowAttributes() ?>>
<?php if ($gajisma_detil_delete->id->Visible) { // id ?>
		<td <?php echo $gajisma_detil_delete->id->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_id" class="gajisma_detil_id">
<span<?php echo $gajisma_detil_delete->id->viewAttributes() ?>><?php echo $gajisma_detil_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->pid->Visible) { // pid ?>
		<td <?php echo $gajisma_detil_delete->pid->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_pid" class="gajisma_detil_pid">
<span<?php echo $gajisma_detil_delete->pid->viewAttributes() ?>><?php echo $gajisma_detil_delete->pid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->pegawai_id->Visible) { // pegawai_id ?>
		<td <?php echo $gajisma_detil_delete->pegawai_id->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_pegawai_id" class="gajisma_detil_pegawai_id">
<span<?php echo $gajisma_detil_delete->pegawai_id->viewAttributes() ?>><?php echo $gajisma_detil_delete->pegawai_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->jabatan_id->Visible) { // jabatan_id ?>
		<td <?php echo $gajisma_detil_delete->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_jabatan_id" class="gajisma_detil_jabatan_id">
<span<?php echo $gajisma_detil_delete->jabatan_id->viewAttributes() ?>><?php echo $gajisma_detil_delete->jabatan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->masakerja->Visible) { // masakerja ?>
		<td <?php echo $gajisma_detil_delete->masakerja->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_masakerja" class="gajisma_detil_masakerja">
<span<?php echo $gajisma_detil_delete->masakerja->viewAttributes() ?>><?php echo $gajisma_detil_delete->masakerja->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->jumngajar->Visible) { // jumngajar ?>
		<td <?php echo $gajisma_detil_delete->jumngajar->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_jumngajar" class="gajisma_detil_jumngajar">
<span<?php echo $gajisma_detil_delete->jumngajar->viewAttributes() ?>><?php echo $gajisma_detil_delete->jumngajar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->ijin->Visible) { // ijin ?>
		<td <?php echo $gajisma_detil_delete->ijin->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_ijin" class="gajisma_detil_ijin">
<span<?php echo $gajisma_detil_delete->ijin->viewAttributes() ?>><?php echo $gajisma_detil_delete->ijin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
		<td <?php echo $gajisma_detil_delete->tunjangan_wkosis->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_tunjangan_wkosis" class="gajisma_detil_tunjangan_wkosis">
<span<?php echo $gajisma_detil_delete->tunjangan_wkosis->viewAttributes() ?>><?php echo $gajisma_detil_delete->tunjangan_wkosis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->nominal_baku->Visible) { // nominal_baku ?>
		<td <?php echo $gajisma_detil_delete->nominal_baku->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_nominal_baku" class="gajisma_detil_nominal_baku">
<span<?php echo $gajisma_detil_delete->nominal_baku->viewAttributes() ?>><?php echo $gajisma_detil_delete->nominal_baku->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->baku->Visible) { // baku ?>
		<td <?php echo $gajisma_detil_delete->baku->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_baku" class="gajisma_detil_baku">
<span<?php echo $gajisma_detil_delete->baku->viewAttributes() ?>><?php echo $gajisma_detil_delete->baku->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->kehadiran->Visible) { // kehadiran ?>
		<td <?php echo $gajisma_detil_delete->kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_kehadiran" class="gajisma_detil_kehadiran">
<span<?php echo $gajisma_detil_delete->kehadiran->viewAttributes() ?>><?php echo $gajisma_detil_delete->kehadiran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->prestasi->Visible) { // prestasi ?>
		<td <?php echo $gajisma_detil_delete->prestasi->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_prestasi" class="gajisma_detil_prestasi">
<span<?php echo $gajisma_detil_delete->prestasi->viewAttributes() ?>><?php echo $gajisma_detil_delete->prestasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->jumlahgaji->Visible) { // jumlahgaji ?>
		<td <?php echo $gajisma_detil_delete->jumlahgaji->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_jumlahgaji" class="gajisma_detil_jumlahgaji">
<span<?php echo $gajisma_detil_delete->jumlahgaji->viewAttributes() ?>><?php echo $gajisma_detil_delete->jumlahgaji->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->jumgajitotal->Visible) { // jumgajitotal ?>
		<td <?php echo $gajisma_detil_delete->jumgajitotal->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_jumgajitotal" class="gajisma_detil_jumgajitotal">
<span<?php echo $gajisma_detil_delete->jumgajitotal->viewAttributes() ?>><?php echo $gajisma_detil_delete->jumgajitotal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->potongan1->Visible) { // potongan1 ?>
		<td <?php echo $gajisma_detil_delete->potongan1->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_potongan1" class="gajisma_detil_potongan1">
<span<?php echo $gajisma_detil_delete->potongan1->viewAttributes() ?>><?php echo $gajisma_detil_delete->potongan1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->potongan2->Visible) { // potongan2 ?>
		<td <?php echo $gajisma_detil_delete->potongan2->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_potongan2" class="gajisma_detil_potongan2">
<span<?php echo $gajisma_detil_delete->potongan2->viewAttributes() ?>><?php echo $gajisma_detil_delete->potongan2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajisma_detil_delete->jumlahterima->Visible) { // jumlahterima ?>
		<td <?php echo $gajisma_detil_delete->jumlahterima->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_delete->RowCount ?>_gajisma_detil_jumlahterima" class="gajisma_detil_jumlahterima">
<span<?php echo $gajisma_detil_delete->jumlahterima->viewAttributes() ?>><?php echo $gajisma_detil_delete->jumlahterima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gajisma_detil_delete->Recordset->moveNext();
}
$gajisma_detil_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajisma_detil_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gajisma_detil_delete->showPageFooter();
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
$gajisma_detil_delete->terminate();
?>