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
$gaji_karyawan_smp_delete = new gaji_karyawan_smp_delete();

// Run the page
$gaji_karyawan_smp_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_karyawan_smp_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgaji_karyawan_smpdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgaji_karyawan_smpdelete = currentForm = new ew.Form("fgaji_karyawan_smpdelete", "delete");
	loadjs.done("fgaji_karyawan_smpdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gaji_karyawan_smp_delete->showPageHeader(); ?>
<?php
$gaji_karyawan_smp_delete->showMessage();
?>
<form name="fgaji_karyawan_smpdelete" id="fgaji_karyawan_smpdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gaji_karyawan_smp">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gaji_karyawan_smp_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gaji_karyawan_smp_delete->pegawai->Visible) { // pegawai ?>
		<th class="<?php echo $gaji_karyawan_smp_delete->pegawai->headerCellClass() ?>"><span id="elh_gaji_karyawan_smp_pegawai" class="gaji_karyawan_smp_pegawai"><?php echo $gaji_karyawan_smp_delete->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->jenjang_id->Visible) { // jenjang_id ?>
		<th class="<?php echo $gaji_karyawan_smp_delete->jenjang_id->headerCellClass() ?>"><span id="elh_gaji_karyawan_smp_jenjang_id" class="gaji_karyawan_smp_jenjang_id"><?php echo $gaji_karyawan_smp_delete->jenjang_id->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->jabatan_id->Visible) { // jabatan_id ?>
		<th class="<?php echo $gaji_karyawan_smp_delete->jabatan_id->headerCellClass() ?>"><span id="elh_gaji_karyawan_smp_jabatan_id" class="gaji_karyawan_smp_jabatan_id"><?php echo $gaji_karyawan_smp_delete->jabatan_id->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->kehadiran->Visible) { // kehadiran ?>
		<th class="<?php echo $gaji_karyawan_smp_delete->kehadiran->headerCellClass() ?>"><span id="elh_gaji_karyawan_smp_kehadiran" class="gaji_karyawan_smp_kehadiran"><?php echo $gaji_karyawan_smp_delete->kehadiran->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->gapok->Visible) { // gapok ?>
		<th class="<?php echo $gaji_karyawan_smp_delete->gapok->headerCellClass() ?>"><span id="elh_gaji_karyawan_smp_gapok" class="gaji_karyawan_smp_gapok"><?php echo $gaji_karyawan_smp_delete->gapok->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->value_reward->Visible) { // value_reward ?>
		<th class="<?php echo $gaji_karyawan_smp_delete->value_reward->headerCellClass() ?>"><span id="elh_gaji_karyawan_smp_value_reward" class="gaji_karyawan_smp_value_reward"><?php echo $gaji_karyawan_smp_delete->value_reward->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->value_inval->Visible) { // value_inval ?>
		<th class="<?php echo $gaji_karyawan_smp_delete->value_inval->headerCellClass() ?>"><span id="elh_gaji_karyawan_smp_value_inval" class="gaji_karyawan_smp_value_inval"><?php echo $gaji_karyawan_smp_delete->value_inval->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->sub_total->Visible) { // sub_total ?>
		<th class="<?php echo $gaji_karyawan_smp_delete->sub_total->headerCellClass() ?>"><span id="elh_gaji_karyawan_smp_sub_total" class="gaji_karyawan_smp_sub_total"><?php echo $gaji_karyawan_smp_delete->sub_total->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->potongan->Visible) { // potongan ?>
		<th class="<?php echo $gaji_karyawan_smp_delete->potongan->headerCellClass() ?>"><span id="elh_gaji_karyawan_smp_potongan" class="gaji_karyawan_smp_potongan"><?php echo $gaji_karyawan_smp_delete->potongan->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->penyesuaian->Visible) { // penyesuaian ?>
		<th class="<?php echo $gaji_karyawan_smp_delete->penyesuaian->headerCellClass() ?>"><span id="elh_gaji_karyawan_smp_penyesuaian" class="gaji_karyawan_smp_penyesuaian"><?php echo $gaji_karyawan_smp_delete->penyesuaian->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->total->Visible) { // total ?>
		<th class="<?php echo $gaji_karyawan_smp_delete->total->headerCellClass() ?>"><span id="elh_gaji_karyawan_smp_total" class="gaji_karyawan_smp_total"><?php echo $gaji_karyawan_smp_delete->total->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->pid->Visible) { // pid ?>
		<th class="<?php echo $gaji_karyawan_smp_delete->pid->headerCellClass() ?>"><span id="elh_gaji_karyawan_smp_pid" class="gaji_karyawan_smp_pid"><?php echo $gaji_karyawan_smp_delete->pid->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->jp->Visible) { // jp ?>
		<th class="<?php echo $gaji_karyawan_smp_delete->jp->headerCellClass() ?>"><span id="elh_gaji_karyawan_smp_jp" class="gaji_karyawan_smp_jp"><?php echo $gaji_karyawan_smp_delete->jp->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gaji_karyawan_smp_delete->RecordCount = 0;
$i = 0;
while (!$gaji_karyawan_smp_delete->Recordset->EOF) {
	$gaji_karyawan_smp_delete->RecordCount++;
	$gaji_karyawan_smp_delete->RowCount++;

	// Set row properties
	$gaji_karyawan_smp->resetAttributes();
	$gaji_karyawan_smp->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gaji_karyawan_smp_delete->loadRowValues($gaji_karyawan_smp_delete->Recordset);

	// Render row
	$gaji_karyawan_smp_delete->renderRow();
?>
	<tr <?php echo $gaji_karyawan_smp->rowAttributes() ?>>
<?php if ($gaji_karyawan_smp_delete->pegawai->Visible) { // pegawai ?>
		<td <?php echo $gaji_karyawan_smp_delete->pegawai->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_delete->RowCount ?>_gaji_karyawan_smp_pegawai" class="gaji_karyawan_smp_pegawai">
<span<?php echo $gaji_karyawan_smp_delete->pegawai->viewAttributes() ?>><?php echo $gaji_karyawan_smp_delete->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->jenjang_id->Visible) { // jenjang_id ?>
		<td <?php echo $gaji_karyawan_smp_delete->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_delete->RowCount ?>_gaji_karyawan_smp_jenjang_id" class="gaji_karyawan_smp_jenjang_id">
<span<?php echo $gaji_karyawan_smp_delete->jenjang_id->viewAttributes() ?>><?php echo $gaji_karyawan_smp_delete->jenjang_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->jabatan_id->Visible) { // jabatan_id ?>
		<td <?php echo $gaji_karyawan_smp_delete->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_delete->RowCount ?>_gaji_karyawan_smp_jabatan_id" class="gaji_karyawan_smp_jabatan_id">
<span<?php echo $gaji_karyawan_smp_delete->jabatan_id->viewAttributes() ?>><?php echo $gaji_karyawan_smp_delete->jabatan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->kehadiran->Visible) { // kehadiran ?>
		<td <?php echo $gaji_karyawan_smp_delete->kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_delete->RowCount ?>_gaji_karyawan_smp_kehadiran" class="gaji_karyawan_smp_kehadiran">
<span<?php echo $gaji_karyawan_smp_delete->kehadiran->viewAttributes() ?>><?php echo $gaji_karyawan_smp_delete->kehadiran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->gapok->Visible) { // gapok ?>
		<td <?php echo $gaji_karyawan_smp_delete->gapok->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_delete->RowCount ?>_gaji_karyawan_smp_gapok" class="gaji_karyawan_smp_gapok">
<span<?php echo $gaji_karyawan_smp_delete->gapok->viewAttributes() ?>><?php echo $gaji_karyawan_smp_delete->gapok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->value_reward->Visible) { // value_reward ?>
		<td <?php echo $gaji_karyawan_smp_delete->value_reward->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_delete->RowCount ?>_gaji_karyawan_smp_value_reward" class="gaji_karyawan_smp_value_reward">
<span<?php echo $gaji_karyawan_smp_delete->value_reward->viewAttributes() ?>><?php echo $gaji_karyawan_smp_delete->value_reward->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->value_inval->Visible) { // value_inval ?>
		<td <?php echo $gaji_karyawan_smp_delete->value_inval->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_delete->RowCount ?>_gaji_karyawan_smp_value_inval" class="gaji_karyawan_smp_value_inval">
<span<?php echo $gaji_karyawan_smp_delete->value_inval->viewAttributes() ?>><?php echo $gaji_karyawan_smp_delete->value_inval->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->sub_total->Visible) { // sub_total ?>
		<td <?php echo $gaji_karyawan_smp_delete->sub_total->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_delete->RowCount ?>_gaji_karyawan_smp_sub_total" class="gaji_karyawan_smp_sub_total">
<span<?php echo $gaji_karyawan_smp_delete->sub_total->viewAttributes() ?>><?php echo $gaji_karyawan_smp_delete->sub_total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->potongan->Visible) { // potongan ?>
		<td <?php echo $gaji_karyawan_smp_delete->potongan->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_delete->RowCount ?>_gaji_karyawan_smp_potongan" class="gaji_karyawan_smp_potongan">
<span<?php echo $gaji_karyawan_smp_delete->potongan->viewAttributes() ?>><?php echo $gaji_karyawan_smp_delete->potongan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->penyesuaian->Visible) { // penyesuaian ?>
		<td <?php echo $gaji_karyawan_smp_delete->penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_delete->RowCount ?>_gaji_karyawan_smp_penyesuaian" class="gaji_karyawan_smp_penyesuaian">
<span<?php echo $gaji_karyawan_smp_delete->penyesuaian->viewAttributes() ?>><?php echo $gaji_karyawan_smp_delete->penyesuaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->total->Visible) { // total ?>
		<td <?php echo $gaji_karyawan_smp_delete->total->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_delete->RowCount ?>_gaji_karyawan_smp_total" class="gaji_karyawan_smp_total">
<span<?php echo $gaji_karyawan_smp_delete->total->viewAttributes() ?>><?php echo $gaji_karyawan_smp_delete->total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->pid->Visible) { // pid ?>
		<td <?php echo $gaji_karyawan_smp_delete->pid->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_delete->RowCount ?>_gaji_karyawan_smp_pid" class="gaji_karyawan_smp_pid">
<span<?php echo $gaji_karyawan_smp_delete->pid->viewAttributes() ?>><?php echo $gaji_karyawan_smp_delete->pid->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_smp_delete->jp->Visible) { // jp ?>
		<td <?php echo $gaji_karyawan_smp_delete->jp->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_delete->RowCount ?>_gaji_karyawan_smp_jp" class="gaji_karyawan_smp_jp">
<span<?php echo $gaji_karyawan_smp_delete->jp->viewAttributes() ?>><?php echo $gaji_karyawan_smp_delete->jp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gaji_karyawan_smp_delete->Recordset->moveNext();
}
$gaji_karyawan_smp_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gaji_karyawan_smp_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gaji_karyawan_smp_delete->showPageFooter();
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
$gaji_karyawan_smp_delete->terminate();
?>