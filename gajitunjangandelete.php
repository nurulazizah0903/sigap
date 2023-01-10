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
$gajitunjangan_delete = new gajitunjangan_delete();

// Run the page
$gajitunjangan_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitunjangan_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajitunjangandelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgajitunjangandelete = currentForm = new ew.Form("fgajitunjangandelete", "delete");
	loadjs.done("fgajitunjangandelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gajitunjangan_delete->showPageHeader(); ?>
<?php
$gajitunjangan_delete->showMessage();
?>
<form name="fgajitunjangandelete" id="fgajitunjangandelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajitunjangan">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gajitunjangan_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gajitunjangan_delete->pidjabatan->Visible) { // pidjabatan ?>
		<th class="<?php echo $gajitunjangan_delete->pidjabatan->headerCellClass() ?>"><span id="elh_gajitunjangan_pidjabatan" class="gajitunjangan_pidjabatan"><?php echo $gajitunjangan_delete->pidjabatan->caption() ?></span></th>
<?php } ?>
<?php if ($gajitunjangan_delete->value_kehadiran->Visible) { // value_kehadiran ?>
		<th class="<?php echo $gajitunjangan_delete->value_kehadiran->headerCellClass() ?>"><span id="elh_gajitunjangan_value_kehadiran" class="gajitunjangan_value_kehadiran"><?php echo $gajitunjangan_delete->value_kehadiran->caption() ?></span></th>
<?php } ?>
<?php if ($gajitunjangan_delete->gapok->Visible) { // gapok ?>
		<th class="<?php echo $gajitunjangan_delete->gapok->headerCellClass() ?>"><span id="elh_gajitunjangan_gapok" class="gajitunjangan_gapok"><?php echo $gajitunjangan_delete->gapok->caption() ?></span></th>
<?php } ?>
<?php if ($gajitunjangan_delete->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
		<th class="<?php echo $gajitunjangan_delete->tunjangan_jabatan->headerCellClass() ?>"><span id="elh_gajitunjangan_tunjangan_jabatan" class="gajitunjangan_tunjangan_jabatan"><?php echo $gajitunjangan_delete->tunjangan_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($gajitunjangan_delete->reward->Visible) { // reward ?>
		<th class="<?php echo $gajitunjangan_delete->reward->headerCellClass() ?>"><span id="elh_gajitunjangan_reward" class="gajitunjangan_reward"><?php echo $gajitunjangan_delete->reward->caption() ?></span></th>
<?php } ?>
<?php if ($gajitunjangan_delete->lembur->Visible) { // lembur ?>
		<th class="<?php echo $gajitunjangan_delete->lembur->headerCellClass() ?>"><span id="elh_gajitunjangan_lembur" class="gajitunjangan_lembur"><?php echo $gajitunjangan_delete->lembur->caption() ?></span></th>
<?php } ?>
<?php if ($gajitunjangan_delete->piket->Visible) { // piket ?>
		<th class="<?php echo $gajitunjangan_delete->piket->headerCellClass() ?>"><span id="elh_gajitunjangan_piket" class="gajitunjangan_piket"><?php echo $gajitunjangan_delete->piket->caption() ?></span></th>
<?php } ?>
<?php if ($gajitunjangan_delete->inval->Visible) { // inval ?>
		<th class="<?php echo $gajitunjangan_delete->inval->headerCellClass() ?>"><span id="elh_gajitunjangan_inval" class="gajitunjangan_inval"><?php echo $gajitunjangan_delete->inval->caption() ?></span></th>
<?php } ?>
<?php if ($gajitunjangan_delete->jam_lebih->Visible) { // jam_lebih ?>
		<th class="<?php echo $gajitunjangan_delete->jam_lebih->headerCellClass() ?>"><span id="elh_gajitunjangan_jam_lebih" class="gajitunjangan_jam_lebih"><?php echo $gajitunjangan_delete->jam_lebih->caption() ?></span></th>
<?php } ?>
<?php if ($gajitunjangan_delete->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
		<th class="<?php echo $gajitunjangan_delete->tunjangan_khusus->headerCellClass() ?>"><span id="elh_gajitunjangan_tunjangan_khusus" class="gajitunjangan_tunjangan_khusus"><?php echo $gajitunjangan_delete->tunjangan_khusus->caption() ?></span></th>
<?php } ?>
<?php if ($gajitunjangan_delete->ekstrakuri->Visible) { // ekstrakuri ?>
		<th class="<?php echo $gajitunjangan_delete->ekstrakuri->headerCellClass() ?>"><span id="elh_gajitunjangan_ekstrakuri" class="gajitunjangan_ekstrakuri"><?php echo $gajitunjangan_delete->ekstrakuri->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gajitunjangan_delete->RecordCount = 0;
$i = 0;
while (!$gajitunjangan_delete->Recordset->EOF) {
	$gajitunjangan_delete->RecordCount++;
	$gajitunjangan_delete->RowCount++;

	// Set row properties
	$gajitunjangan->resetAttributes();
	$gajitunjangan->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gajitunjangan_delete->loadRowValues($gajitunjangan_delete->Recordset);

	// Render row
	$gajitunjangan_delete->renderRow();
?>
	<tr <?php echo $gajitunjangan->rowAttributes() ?>>
<?php if ($gajitunjangan_delete->pidjabatan->Visible) { // pidjabatan ?>
		<td <?php echo $gajitunjangan_delete->pidjabatan->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_delete->RowCount ?>_gajitunjangan_pidjabatan" class="gajitunjangan_pidjabatan">
<span<?php echo $gajitunjangan_delete->pidjabatan->viewAttributes() ?>><?php echo $gajitunjangan_delete->pidjabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitunjangan_delete->value_kehadiran->Visible) { // value_kehadiran ?>
		<td <?php echo $gajitunjangan_delete->value_kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_delete->RowCount ?>_gajitunjangan_value_kehadiran" class="gajitunjangan_value_kehadiran">
<span<?php echo $gajitunjangan_delete->value_kehadiran->viewAttributes() ?>><?php echo $gajitunjangan_delete->value_kehadiran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitunjangan_delete->gapok->Visible) { // gapok ?>
		<td <?php echo $gajitunjangan_delete->gapok->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_delete->RowCount ?>_gajitunjangan_gapok" class="gajitunjangan_gapok">
<span<?php echo $gajitunjangan_delete->gapok->viewAttributes() ?>><?php echo $gajitunjangan_delete->gapok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitunjangan_delete->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
		<td <?php echo $gajitunjangan_delete->tunjangan_jabatan->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_delete->RowCount ?>_gajitunjangan_tunjangan_jabatan" class="gajitunjangan_tunjangan_jabatan">
<span<?php echo $gajitunjangan_delete->tunjangan_jabatan->viewAttributes() ?>><?php echo $gajitunjangan_delete->tunjangan_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitunjangan_delete->reward->Visible) { // reward ?>
		<td <?php echo $gajitunjangan_delete->reward->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_delete->RowCount ?>_gajitunjangan_reward" class="gajitunjangan_reward">
<span<?php echo $gajitunjangan_delete->reward->viewAttributes() ?>><?php echo $gajitunjangan_delete->reward->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitunjangan_delete->lembur->Visible) { // lembur ?>
		<td <?php echo $gajitunjangan_delete->lembur->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_delete->RowCount ?>_gajitunjangan_lembur" class="gajitunjangan_lembur">
<span<?php echo $gajitunjangan_delete->lembur->viewAttributes() ?>><?php echo $gajitunjangan_delete->lembur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitunjangan_delete->piket->Visible) { // piket ?>
		<td <?php echo $gajitunjangan_delete->piket->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_delete->RowCount ?>_gajitunjangan_piket" class="gajitunjangan_piket">
<span<?php echo $gajitunjangan_delete->piket->viewAttributes() ?>><?php echo $gajitunjangan_delete->piket->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitunjangan_delete->inval->Visible) { // inval ?>
		<td <?php echo $gajitunjangan_delete->inval->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_delete->RowCount ?>_gajitunjangan_inval" class="gajitunjangan_inval">
<span<?php echo $gajitunjangan_delete->inval->viewAttributes() ?>><?php echo $gajitunjangan_delete->inval->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitunjangan_delete->jam_lebih->Visible) { // jam_lebih ?>
		<td <?php echo $gajitunjangan_delete->jam_lebih->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_delete->RowCount ?>_gajitunjangan_jam_lebih" class="gajitunjangan_jam_lebih">
<span<?php echo $gajitunjangan_delete->jam_lebih->viewAttributes() ?>><?php echo $gajitunjangan_delete->jam_lebih->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitunjangan_delete->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
		<td <?php echo $gajitunjangan_delete->tunjangan_khusus->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_delete->RowCount ?>_gajitunjangan_tunjangan_khusus" class="gajitunjangan_tunjangan_khusus">
<span<?php echo $gajitunjangan_delete->tunjangan_khusus->viewAttributes() ?>><?php echo $gajitunjangan_delete->tunjangan_khusus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gajitunjangan_delete->ekstrakuri->Visible) { // ekstrakuri ?>
		<td <?php echo $gajitunjangan_delete->ekstrakuri->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_delete->RowCount ?>_gajitunjangan_ekstrakuri" class="gajitunjangan_ekstrakuri">
<span<?php echo $gajitunjangan_delete->ekstrakuri->viewAttributes() ?>><?php echo $gajitunjangan_delete->ekstrakuri->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gajitunjangan_delete->Recordset->moveNext();
}
$gajitunjangan_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gajitunjangan_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gajitunjangan_delete->showPageFooter();
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
$gajitunjangan_delete->terminate();
?>