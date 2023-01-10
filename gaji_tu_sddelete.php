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
$gaji_tu_sd_delete = new gaji_tu_sd_delete();

// Run the page
$gaji_tu_sd_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_tu_sd_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgaji_tu_sddelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgaji_tu_sddelete = currentForm = new ew.Form("fgaji_tu_sddelete", "delete");
	loadjs.done("fgaji_tu_sddelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gaji_tu_sd_delete->showPageHeader(); ?>
<?php
$gaji_tu_sd_delete->showMessage();
?>
<form name="fgaji_tu_sddelete" id="fgaji_tu_sddelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gaji_tu_sd">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gaji_tu_sd_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gaji_tu_sd_delete->pegawai->Visible) { // pegawai ?>
		<th class="<?php echo $gaji_tu_sd_delete->pegawai->headerCellClass() ?>"><span id="elh_gaji_tu_sd_pegawai" class="gaji_tu_sd_pegawai"><?php echo $gaji_tu_sd_delete->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->jenjang_id->Visible) { // jenjang_id ?>
		<th class="<?php echo $gaji_tu_sd_delete->jenjang_id->headerCellClass() ?>"><span id="elh_gaji_tu_sd_jenjang_id" class="gaji_tu_sd_jenjang_id"><?php echo $gaji_tu_sd_delete->jenjang_id->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->jabatan_id->Visible) { // jabatan_id ?>
		<th class="<?php echo $gaji_tu_sd_delete->jabatan_id->headerCellClass() ?>"><span id="elh_gaji_tu_sd_jabatan_id" class="gaji_tu_sd_jabatan_id"><?php echo $gaji_tu_sd_delete->jabatan_id->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->type_jabatan->Visible) { // type_jabatan ?>
		<th class="<?php echo $gaji_tu_sd_delete->type_jabatan->headerCellClass() ?>"><span id="elh_gaji_tu_sd_type_jabatan" class="gaji_tu_sd_type_jabatan"><?php echo $gaji_tu_sd_delete->type_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->tambahan->Visible) { // tambahan ?>
		<th class="<?php echo $gaji_tu_sd_delete->tambahan->headerCellClass() ?>"><span id="elh_gaji_tu_sd_tambahan" class="gaji_tu_sd_tambahan"><?php echo $gaji_tu_sd_delete->tambahan->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->gapok->Visible) { // gapok ?>
		<th class="<?php echo $gaji_tu_sd_delete->gapok->headerCellClass() ?>"><span id="elh_gaji_tu_sd_gapok" class="gaji_tu_sd_gapok"><?php echo $gaji_tu_sd_delete->gapok->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->ijasah->Visible) { // ijasah ?>
		<th class="<?php echo $gaji_tu_sd_delete->ijasah->headerCellClass() ?>"><span id="elh_gaji_tu_sd_ijasah" class="gaji_tu_sd_ijasah"><?php echo $gaji_tu_sd_delete->ijasah->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->kehadiran->Visible) { // kehadiran ?>
		<th class="<?php echo $gaji_tu_sd_delete->kehadiran->headerCellClass() ?>"><span id="elh_gaji_tu_sd_kehadiran" class="gaji_tu_sd_kehadiran"><?php echo $gaji_tu_sd_delete->kehadiran->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->lembur->Visible) { // lembur ?>
		<th class="<?php echo $gaji_tu_sd_delete->lembur->headerCellClass() ?>"><span id="elh_gaji_tu_sd_lembur" class="gaji_tu_sd_lembur"><?php echo $gaji_tu_sd_delete->lembur->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->value_lembur->Visible) { // value_lembur ?>
		<th class="<?php echo $gaji_tu_sd_delete->value_lembur->headerCellClass() ?>"><span id="elh_gaji_tu_sd_value_lembur" class="gaji_tu_sd_value_lembur"><?php echo $gaji_tu_sd_delete->value_lembur->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->value_reward->Visible) { // value_reward ?>
		<th class="<?php echo $gaji_tu_sd_delete->value_reward->headerCellClass() ?>"><span id="elh_gaji_tu_sd_value_reward" class="gaji_tu_sd_value_reward"><?php echo $gaji_tu_sd_delete->value_reward->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->value_inval->Visible) { // value_inval ?>
		<th class="<?php echo $gaji_tu_sd_delete->value_inval->headerCellClass() ?>"><span id="elh_gaji_tu_sd_value_inval" class="gaji_tu_sd_value_inval"><?php echo $gaji_tu_sd_delete->value_inval->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->piket_count->Visible) { // piket_count ?>
		<th class="<?php echo $gaji_tu_sd_delete->piket_count->headerCellClass() ?>"><span id="elh_gaji_tu_sd_piket_count" class="gaji_tu_sd_piket_count"><?php echo $gaji_tu_sd_delete->piket_count->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->value_piket->Visible) { // value_piket ?>
		<th class="<?php echo $gaji_tu_sd_delete->value_piket->headerCellClass() ?>"><span id="elh_gaji_tu_sd_value_piket" class="gaji_tu_sd_value_piket"><?php echo $gaji_tu_sd_delete->value_piket->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->tugastambahan->Visible) { // tugastambahan ?>
		<th class="<?php echo $gaji_tu_sd_delete->tugastambahan->headerCellClass() ?>"><span id="elh_gaji_tu_sd_tugastambahan" class="gaji_tu_sd_tugastambahan"><?php echo $gaji_tu_sd_delete->tugastambahan->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->tj_jabatan->Visible) { // tj_jabatan ?>
		<th class="<?php echo $gaji_tu_sd_delete->tj_jabatan->headerCellClass() ?>"><span id="elh_gaji_tu_sd_tj_jabatan" class="gaji_tu_sd_tj_jabatan"><?php echo $gaji_tu_sd_delete->tj_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->tunjangan2->Visible) { // tunjangan2 ?>
		<th class="<?php echo $gaji_tu_sd_delete->tunjangan2->headerCellClass() ?>"><span id="elh_gaji_tu_sd_tunjangan2" class="gaji_tu_sd_tunjangan2"><?php echo $gaji_tu_sd_delete->tunjangan2->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->potongan->Visible) { // potongan ?>
		<th class="<?php echo $gaji_tu_sd_delete->potongan->headerCellClass() ?>"><span id="elh_gaji_tu_sd_potongan" class="gaji_tu_sd_potongan"><?php echo $gaji_tu_sd_delete->potongan->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->sub_total->Visible) { // sub_total ?>
		<th class="<?php echo $gaji_tu_sd_delete->sub_total->headerCellClass() ?>"><span id="elh_gaji_tu_sd_sub_total" class="gaji_tu_sd_sub_total"><?php echo $gaji_tu_sd_delete->sub_total->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->penyesuaian->Visible) { // penyesuaian ?>
		<th class="<?php echo $gaji_tu_sd_delete->penyesuaian->headerCellClass() ?>"><span id="elh_gaji_tu_sd_penyesuaian" class="gaji_tu_sd_penyesuaian"><?php echo $gaji_tu_sd_delete->penyesuaian->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_tu_sd_delete->total->Visible) { // total ?>
		<th class="<?php echo $gaji_tu_sd_delete->total->headerCellClass() ?>"><span id="elh_gaji_tu_sd_total" class="gaji_tu_sd_total"><?php echo $gaji_tu_sd_delete->total->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gaji_tu_sd_delete->RecordCount = 0;
$i = 0;
while (!$gaji_tu_sd_delete->Recordset->EOF) {
	$gaji_tu_sd_delete->RecordCount++;
	$gaji_tu_sd_delete->RowCount++;

	// Set row properties
	$gaji_tu_sd->resetAttributes();
	$gaji_tu_sd->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gaji_tu_sd_delete->loadRowValues($gaji_tu_sd_delete->Recordset);

	// Render row
	$gaji_tu_sd_delete->renderRow();
?>
	<tr <?php echo $gaji_tu_sd->rowAttributes() ?>>
<?php if ($gaji_tu_sd_delete->pegawai->Visible) { // pegawai ?>
		<td <?php echo $gaji_tu_sd_delete->pegawai->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_pegawai" class="gaji_tu_sd_pegawai">
<span<?php echo $gaji_tu_sd_delete->pegawai->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->jenjang_id->Visible) { // jenjang_id ?>
		<td <?php echo $gaji_tu_sd_delete->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_jenjang_id" class="gaji_tu_sd_jenjang_id">
<span<?php echo $gaji_tu_sd_delete->jenjang_id->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->jenjang_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->jabatan_id->Visible) { // jabatan_id ?>
		<td <?php echo $gaji_tu_sd_delete->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_jabatan_id" class="gaji_tu_sd_jabatan_id">
<span<?php echo $gaji_tu_sd_delete->jabatan_id->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->jabatan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->type_jabatan->Visible) { // type_jabatan ?>
		<td <?php echo $gaji_tu_sd_delete->type_jabatan->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_type_jabatan" class="gaji_tu_sd_type_jabatan">
<span<?php echo $gaji_tu_sd_delete->type_jabatan->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->type_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->tambahan->Visible) { // tambahan ?>
		<td <?php echo $gaji_tu_sd_delete->tambahan->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_tambahan" class="gaji_tu_sd_tambahan">
<span<?php echo $gaji_tu_sd_delete->tambahan->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->tambahan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->gapok->Visible) { // gapok ?>
		<td <?php echo $gaji_tu_sd_delete->gapok->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_gapok" class="gaji_tu_sd_gapok">
<span<?php echo $gaji_tu_sd_delete->gapok->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->gapok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->ijasah->Visible) { // ijasah ?>
		<td <?php echo $gaji_tu_sd_delete->ijasah->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_ijasah" class="gaji_tu_sd_ijasah">
<span<?php echo $gaji_tu_sd_delete->ijasah->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->ijasah->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->kehadiran->Visible) { // kehadiran ?>
		<td <?php echo $gaji_tu_sd_delete->kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_kehadiran" class="gaji_tu_sd_kehadiran">
<span<?php echo $gaji_tu_sd_delete->kehadiran->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->kehadiran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->lembur->Visible) { // lembur ?>
		<td <?php echo $gaji_tu_sd_delete->lembur->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_lembur" class="gaji_tu_sd_lembur">
<span<?php echo $gaji_tu_sd_delete->lembur->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->lembur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->value_lembur->Visible) { // value_lembur ?>
		<td <?php echo $gaji_tu_sd_delete->value_lembur->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_value_lembur" class="gaji_tu_sd_value_lembur">
<span<?php echo $gaji_tu_sd_delete->value_lembur->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->value_lembur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->value_reward->Visible) { // value_reward ?>
		<td <?php echo $gaji_tu_sd_delete->value_reward->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_value_reward" class="gaji_tu_sd_value_reward">
<span<?php echo $gaji_tu_sd_delete->value_reward->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->value_reward->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->value_inval->Visible) { // value_inval ?>
		<td <?php echo $gaji_tu_sd_delete->value_inval->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_value_inval" class="gaji_tu_sd_value_inval">
<span<?php echo $gaji_tu_sd_delete->value_inval->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->value_inval->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->piket_count->Visible) { // piket_count ?>
		<td <?php echo $gaji_tu_sd_delete->piket_count->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_piket_count" class="gaji_tu_sd_piket_count">
<span<?php echo $gaji_tu_sd_delete->piket_count->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->piket_count->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->value_piket->Visible) { // value_piket ?>
		<td <?php echo $gaji_tu_sd_delete->value_piket->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_value_piket" class="gaji_tu_sd_value_piket">
<span<?php echo $gaji_tu_sd_delete->value_piket->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->value_piket->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->tugastambahan->Visible) { // tugastambahan ?>
		<td <?php echo $gaji_tu_sd_delete->tugastambahan->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_tugastambahan" class="gaji_tu_sd_tugastambahan">
<span<?php echo $gaji_tu_sd_delete->tugastambahan->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->tugastambahan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->tj_jabatan->Visible) { // tj_jabatan ?>
		<td <?php echo $gaji_tu_sd_delete->tj_jabatan->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_tj_jabatan" class="gaji_tu_sd_tj_jabatan">
<span<?php echo $gaji_tu_sd_delete->tj_jabatan->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->tj_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->tunjangan2->Visible) { // tunjangan2 ?>
		<td <?php echo $gaji_tu_sd_delete->tunjangan2->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_tunjangan2" class="gaji_tu_sd_tunjangan2">
<span<?php echo $gaji_tu_sd_delete->tunjangan2->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->tunjangan2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->potongan->Visible) { // potongan ?>
		<td <?php echo $gaji_tu_sd_delete->potongan->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_potongan" class="gaji_tu_sd_potongan">
<span<?php echo $gaji_tu_sd_delete->potongan->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->potongan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->sub_total->Visible) { // sub_total ?>
		<td <?php echo $gaji_tu_sd_delete->sub_total->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_sub_total" class="gaji_tu_sd_sub_total">
<span<?php echo $gaji_tu_sd_delete->sub_total->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->sub_total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->penyesuaian->Visible) { // penyesuaian ?>
		<td <?php echo $gaji_tu_sd_delete->penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_penyesuaian" class="gaji_tu_sd_penyesuaian">
<span<?php echo $gaji_tu_sd_delete->penyesuaian->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->penyesuaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_tu_sd_delete->total->Visible) { // total ?>
		<td <?php echo $gaji_tu_sd_delete->total->cellAttributes() ?>>
<span id="el<?php echo $gaji_tu_sd_delete->RowCount ?>_gaji_tu_sd_total" class="gaji_tu_sd_total">
<span<?php echo $gaji_tu_sd_delete->total->viewAttributes() ?>><?php echo $gaji_tu_sd_delete->total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gaji_tu_sd_delete->Recordset->moveNext();
}
$gaji_tu_sd_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gaji_tu_sd_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gaji_tu_sd_delete->showPageFooter();
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
$gaji_tu_sd_delete->terminate();
?>