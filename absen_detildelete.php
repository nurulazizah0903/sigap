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
$absen_detil_delete = new absen_detil_delete();

// Run the page
$absen_detil_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$absen_detil_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fabsen_detildelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fabsen_detildelete = currentForm = new ew.Form("fabsen_detildelete", "delete");
	loadjs.done("fabsen_detildelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $absen_detil_delete->showPageHeader(); ?>
<?php
$absen_detil_delete->showMessage();
?>
<form name="fabsen_detildelete" id="fabsen_detildelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="absen_detil">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($absen_detil_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($absen_detil_delete->id->Visible) { // id ?>
		<th class="<?php echo $absen_detil_delete->id->headerCellClass() ?>"><span id="elh_absen_detil_id" class="absen_detil_id"><?php echo $absen_detil_delete->id->caption() ?></span></th>
<?php } ?>
<?php if ($absen_detil_delete->pid->Visible) { // pid ?>
		<th class="<?php echo $absen_detil_delete->pid->headerCellClass() ?>"><span id="elh_absen_detil_pid" class="absen_detil_pid"><?php echo $absen_detil_delete->pid->caption() ?></span></th>
<?php } ?>
<?php if ($absen_detil_delete->pegawai->Visible) { // pegawai ?>
		<th class="<?php echo $absen_detil_delete->pegawai->headerCellClass() ?>"><span id="elh_absen_detil_pegawai" class="absen_detil_pegawai"><?php echo $absen_detil_delete->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($absen_detil_delete->masuk->Visible) { // masuk ?>
		<th class="<?php echo $absen_detil_delete->masuk->headerCellClass() ?>"><span id="elh_absen_detil_masuk" class="absen_detil_masuk"><?php echo $absen_detil_delete->masuk->caption() ?></span></th>
<?php } ?>
<?php if ($absen_detil_delete->absen->Visible) { // absen ?>
		<th class="<?php echo $absen_detil_delete->absen->headerCellClass() ?>"><span id="elh_absen_detil_absen" class="absen_detil_absen"><?php echo $absen_detil_delete->absen->caption() ?></span></th>
<?php } ?>
<?php if ($absen_detil_delete->ijin->Visible) { // ijin ?>
		<th class="<?php echo $absen_detil_delete->ijin->headerCellClass() ?>"><span id="elh_absen_detil_ijin" class="absen_detil_ijin"><?php echo $absen_detil_delete->ijin->caption() ?></span></th>
<?php } ?>
<?php if ($absen_detil_delete->cuti->Visible) { // cuti ?>
		<th class="<?php echo $absen_detil_delete->cuti->headerCellClass() ?>"><span id="elh_absen_detil_cuti" class="absen_detil_cuti"><?php echo $absen_detil_delete->cuti->caption() ?></span></th>
<?php } ?>
<?php if ($absen_detil_delete->dinas_luar->Visible) { // dinas_luar ?>
		<th class="<?php echo $absen_detil_delete->dinas_luar->headerCellClass() ?>"><span id="elh_absen_detil_dinas_luar" class="absen_detil_dinas_luar"><?php echo $absen_detil_delete->dinas_luar->caption() ?></span></th>
<?php } ?>
<?php if ($absen_detil_delete->terlambat->Visible) { // terlambat ?>
		<th class="<?php echo $absen_detil_delete->terlambat->headerCellClass() ?>"><span id="elh_absen_detil_terlambat" class="absen_detil_terlambat"><?php echo $absen_detil_delete->terlambat->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$absen_detil_delete->RecordCount = 0;
$i = 0;
while (!$absen_detil_delete->Recordset->EOF) {
	$absen_detil_delete->RecordCount++;
	$absen_detil_delete->RowCount++;

	// Set row properties
	$absen_detil->resetAttributes();
	$absen_detil->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$absen_detil_delete->loadRowValues($absen_detil_delete->Recordset);

	// Render row
	$absen_detil_delete->renderRow();
?>
	<tr <?php echo $absen_detil->rowAttributes() ?>>
<?php if ($absen_detil_delete->id->Visible) { // id ?>
		<td <?php echo $absen_detil_delete->id->cellAttributes() ?>>
<span id="el<?php echo $absen_detil_delete->RowCount ?>_absen_detil_id" class="absen_detil_id">
<span<?php echo $absen_detil_delete->id->viewAttributes() ?>><?php echo $absen_detil_delete->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($absen_detil_delete->pid->Visible) { // pid ?>
		<td <?php echo $absen_detil_delete->pid->cellAttributes() ?>>
<span id="el<?php echo $absen_detil_delete->RowCount ?>_absen_detil_pid" class="absen_detil_pid">
<span<?php echo $absen_detil_delete->pid->viewAttributes() ?>><?php echo $absen_detil_delete->pid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($absen_detil_delete->pegawai->Visible) { // pegawai ?>
		<td <?php echo $absen_detil_delete->pegawai->cellAttributes() ?>>
<span id="el<?php echo $absen_detil_delete->RowCount ?>_absen_detil_pegawai" class="absen_detil_pegawai">
<span<?php echo $absen_detil_delete->pegawai->viewAttributes() ?>><?php echo $absen_detil_delete->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($absen_detil_delete->masuk->Visible) { // masuk ?>
		<td <?php echo $absen_detil_delete->masuk->cellAttributes() ?>>
<span id="el<?php echo $absen_detil_delete->RowCount ?>_absen_detil_masuk" class="absen_detil_masuk">
<span<?php echo $absen_detil_delete->masuk->viewAttributes() ?>><?php echo $absen_detil_delete->masuk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($absen_detil_delete->absen->Visible) { // absen ?>
		<td <?php echo $absen_detil_delete->absen->cellAttributes() ?>>
<span id="el<?php echo $absen_detil_delete->RowCount ?>_absen_detil_absen" class="absen_detil_absen">
<span<?php echo $absen_detil_delete->absen->viewAttributes() ?>><?php echo $absen_detil_delete->absen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($absen_detil_delete->ijin->Visible) { // ijin ?>
		<td <?php echo $absen_detil_delete->ijin->cellAttributes() ?>>
<span id="el<?php echo $absen_detil_delete->RowCount ?>_absen_detil_ijin" class="absen_detil_ijin">
<span<?php echo $absen_detil_delete->ijin->viewAttributes() ?>><?php echo $absen_detil_delete->ijin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($absen_detil_delete->cuti->Visible) { // cuti ?>
		<td <?php echo $absen_detil_delete->cuti->cellAttributes() ?>>
<span id="el<?php echo $absen_detil_delete->RowCount ?>_absen_detil_cuti" class="absen_detil_cuti">
<span<?php echo $absen_detil_delete->cuti->viewAttributes() ?>><?php echo $absen_detil_delete->cuti->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($absen_detil_delete->dinas_luar->Visible) { // dinas_luar ?>
		<td <?php echo $absen_detil_delete->dinas_luar->cellAttributes() ?>>
<span id="el<?php echo $absen_detil_delete->RowCount ?>_absen_detil_dinas_luar" class="absen_detil_dinas_luar">
<span<?php echo $absen_detil_delete->dinas_luar->viewAttributes() ?>><?php echo $absen_detil_delete->dinas_luar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($absen_detil_delete->terlambat->Visible) { // terlambat ?>
		<td <?php echo $absen_detil_delete->terlambat->cellAttributes() ?>>
<span id="el<?php echo $absen_detil_delete->RowCount ?>_absen_detil_terlambat" class="absen_detil_terlambat">
<span<?php echo $absen_detil_delete->terlambat->viewAttributes() ?>><?php echo $absen_detil_delete->terlambat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$absen_detil_delete->Recordset->moveNext();
}
$absen_detil_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $absen_detil_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$absen_detil_delete->showPageFooter();
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
$absen_detil_delete->terminate();
?>