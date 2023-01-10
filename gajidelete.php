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
$gaji_delete = new gaji_delete();

// Run the page
$gaji_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgajidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgajidelete = currentForm = new ew.Form("fgajidelete", "delete");
	loadjs.done("fgajidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gaji_delete->showPageHeader(); ?>
<?php
$gaji_delete->showMessage();
?>
<form name="fgajidelete" id="fgajidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gaji">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gaji_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gaji_delete->pegawai->Visible) { // pegawai ?>
		<th class="<?php echo $gaji_delete->pegawai->headerCellClass() ?>"><span id="elh_gaji_pegawai" class="gaji_pegawai"><?php echo $gaji_delete->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->jenjang_id->Visible) { // jenjang_id ?>
		<th class="<?php echo $gaji_delete->jenjang_id->headerCellClass() ?>"><span id="elh_gaji_jenjang_id" class="gaji_jenjang_id"><?php echo $gaji_delete->jenjang_id->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->jabatan_id->Visible) { // jabatan_id ?>
		<th class="<?php echo $gaji_delete->jabatan_id->headerCellClass() ?>"><span id="elh_gaji_jabatan_id" class="gaji_jabatan_id"><?php echo $gaji_delete->jabatan_id->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->lama_kerja->Visible) { // lama_kerja ?>
		<th class="<?php echo $gaji_delete->lama_kerja->headerCellClass() ?>"><span id="elh_gaji_lama_kerja" class="gaji_lama_kerja"><?php echo $gaji_delete->lama_kerja->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->type->Visible) { // type ?>
		<th class="<?php echo $gaji_delete->type->headerCellClass() ?>"><span id="elh_gaji_type" class="gaji_type"><?php echo $gaji_delete->type->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->jenis_guru->Visible) { // jenis_guru ?>
		<th class="<?php echo $gaji_delete->jenis_guru->headerCellClass() ?>"><span id="elh_gaji_jenis_guru" class="gaji_jenis_guru"><?php echo $gaji_delete->jenis_guru->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->tambahan->Visible) { // tambahan ?>
		<th class="<?php echo $gaji_delete->tambahan->headerCellClass() ?>"><span id="elh_gaji_tambahan" class="gaji_tambahan"><?php echo $gaji_delete->tambahan->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->periode->Visible) { // periode ?>
		<th class="<?php echo $gaji_delete->periode->headerCellClass() ?>"><span id="elh_gaji_periode" class="gaji_periode"><?php echo $gaji_delete->periode->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->tunjangan_periode->Visible) { // tunjangan_periode ?>
		<th class="<?php echo $gaji_delete->tunjangan_periode->headerCellClass() ?>"><span id="elh_gaji_tunjangan_periode" class="gaji_tunjangan_periode"><?php echo $gaji_delete->tunjangan_periode->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->kehadiran->Visible) { // kehadiran ?>
		<th class="<?php echo $gaji_delete->kehadiran->headerCellClass() ?>"><span id="elh_gaji_kehadiran" class="gaji_kehadiran"><?php echo $gaji_delete->kehadiran->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->value_kehadiran->Visible) { // value_kehadiran ?>
		<th class="<?php echo $gaji_delete->value_kehadiran->headerCellClass() ?>"><span id="elh_gaji_value_kehadiran" class="gaji_value_kehadiran"><?php echo $gaji_delete->value_kehadiran->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->jp->Visible) { // jp ?>
		<th class="<?php echo $gaji_delete->jp->headerCellClass() ?>"><span id="elh_gaji_jp" class="gaji_jp"><?php echo $gaji_delete->jp->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->gapok->Visible) { // gapok ?>
		<th class="<?php echo $gaji_delete->gapok->headerCellClass() ?>"><span id="elh_gaji_gapok" class="gaji_gapok"><?php echo $gaji_delete->gapok->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->total_gapok->Visible) { // total_gapok ?>
		<th class="<?php echo $gaji_delete->total_gapok->headerCellClass() ?>"><span id="elh_gaji_total_gapok" class="gaji_total_gapok"><?php echo $gaji_delete->total_gapok->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->lembur->Visible) { // lembur ?>
		<th class="<?php echo $gaji_delete->lembur->headerCellClass() ?>"><span id="elh_gaji_lembur" class="gaji_lembur"><?php echo $gaji_delete->lembur->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->value_lembur->Visible) { // value_lembur ?>
		<th class="<?php echo $gaji_delete->value_lembur->headerCellClass() ?>"><span id="elh_gaji_value_lembur" class="gaji_value_lembur"><?php echo $gaji_delete->value_lembur->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->value_reward->Visible) { // value_reward ?>
		<th class="<?php echo $gaji_delete->value_reward->headerCellClass() ?>"><span id="elh_gaji_value_reward" class="gaji_value_reward"><?php echo $gaji_delete->value_reward->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->value_inval->Visible) { // value_inval ?>
		<th class="<?php echo $gaji_delete->value_inval->headerCellClass() ?>"><span id="elh_gaji_value_inval" class="gaji_value_inval"><?php echo $gaji_delete->value_inval->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->piket_count->Visible) { // piket_count ?>
		<th class="<?php echo $gaji_delete->piket_count->headerCellClass() ?>"><span id="elh_gaji_piket_count" class="gaji_piket_count"><?php echo $gaji_delete->piket_count->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->value_piket->Visible) { // value_piket ?>
		<th class="<?php echo $gaji_delete->value_piket->headerCellClass() ?>"><span id="elh_gaji_value_piket" class="gaji_value_piket"><?php echo $gaji_delete->value_piket->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->tugastambahan->Visible) { // tugastambahan ?>
		<th class="<?php echo $gaji_delete->tugastambahan->headerCellClass() ?>"><span id="elh_gaji_tugastambahan" class="gaji_tugastambahan"><?php echo $gaji_delete->tugastambahan->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->tj_jabatan->Visible) { // tj_jabatan ?>
		<th class="<?php echo $gaji_delete->tj_jabatan->headerCellClass() ?>"><span id="elh_gaji_tj_jabatan" class="gaji_tj_jabatan"><?php echo $gaji_delete->tj_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->sub_total->Visible) { // sub_total ?>
		<th class="<?php echo $gaji_delete->sub_total->headerCellClass() ?>"><span id="elh_gaji_sub_total" class="gaji_sub_total"><?php echo $gaji_delete->sub_total->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->potongan->Visible) { // potongan ?>
		<th class="<?php echo $gaji_delete->potongan->headerCellClass() ?>"><span id="elh_gaji_potongan" class="gaji_potongan"><?php echo $gaji_delete->potongan->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->penyesuaian->Visible) { // penyesuaian ?>
		<th class="<?php echo $gaji_delete->penyesuaian->headerCellClass() ?>"><span id="elh_gaji_penyesuaian" class="gaji_penyesuaian"><?php echo $gaji_delete->penyesuaian->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_delete->total->Visible) { // total ?>
		<th class="<?php echo $gaji_delete->total->headerCellClass() ?>"><span id="elh_gaji_total" class="gaji_total"><?php echo $gaji_delete->total->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gaji_delete->RecordCount = 0;
$i = 0;
while (!$gaji_delete->Recordset->EOF) {
	$gaji_delete->RecordCount++;
	$gaji_delete->RowCount++;

	// Set row properties
	$gaji->resetAttributes();
	$gaji->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gaji_delete->loadRowValues($gaji_delete->Recordset);

	// Render row
	$gaji_delete->renderRow();
?>
	<tr <?php echo $gaji->rowAttributes() ?>>
<?php if ($gaji_delete->pegawai->Visible) { // pegawai ?>
		<td <?php echo $gaji_delete->pegawai->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_pegawai" class="gaji_pegawai">
<span<?php echo $gaji_delete->pegawai->viewAttributes() ?>><?php echo $gaji_delete->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->jenjang_id->Visible) { // jenjang_id ?>
		<td <?php echo $gaji_delete->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_jenjang_id" class="gaji_jenjang_id">
<span<?php echo $gaji_delete->jenjang_id->viewAttributes() ?>><?php echo $gaji_delete->jenjang_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->jabatan_id->Visible) { // jabatan_id ?>
		<td <?php echo $gaji_delete->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_jabatan_id" class="gaji_jabatan_id">
<span<?php echo $gaji_delete->jabatan_id->viewAttributes() ?>><?php echo $gaji_delete->jabatan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->lama_kerja->Visible) { // lama_kerja ?>
		<td <?php echo $gaji_delete->lama_kerja->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_lama_kerja" class="gaji_lama_kerja">
<span<?php echo $gaji_delete->lama_kerja->viewAttributes() ?>><?php echo $gaji_delete->lama_kerja->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->type->Visible) { // type ?>
		<td <?php echo $gaji_delete->type->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_type" class="gaji_type">
<span<?php echo $gaji_delete->type->viewAttributes() ?>><?php echo $gaji_delete->type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->jenis_guru->Visible) { // jenis_guru ?>
		<td <?php echo $gaji_delete->jenis_guru->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_jenis_guru" class="gaji_jenis_guru">
<span<?php echo $gaji_delete->jenis_guru->viewAttributes() ?>><?php echo $gaji_delete->jenis_guru->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->tambahan->Visible) { // tambahan ?>
		<td <?php echo $gaji_delete->tambahan->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_tambahan" class="gaji_tambahan">
<span<?php echo $gaji_delete->tambahan->viewAttributes() ?>><?php echo $gaji_delete->tambahan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->periode->Visible) { // periode ?>
		<td <?php echo $gaji_delete->periode->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_periode" class="gaji_periode">
<span<?php echo $gaji_delete->periode->viewAttributes() ?>><?php echo $gaji_delete->periode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->tunjangan_periode->Visible) { // tunjangan_periode ?>
		<td <?php echo $gaji_delete->tunjangan_periode->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_tunjangan_periode" class="gaji_tunjangan_periode">
<span<?php echo $gaji_delete->tunjangan_periode->viewAttributes() ?>><?php echo $gaji_delete->tunjangan_periode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->kehadiran->Visible) { // kehadiran ?>
		<td <?php echo $gaji_delete->kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_kehadiran" class="gaji_kehadiran">
<span<?php echo $gaji_delete->kehadiran->viewAttributes() ?>><?php echo $gaji_delete->kehadiran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->value_kehadiran->Visible) { // value_kehadiran ?>
		<td <?php echo $gaji_delete->value_kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_value_kehadiran" class="gaji_value_kehadiran">
<span<?php echo $gaji_delete->value_kehadiran->viewAttributes() ?>><?php echo $gaji_delete->value_kehadiran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->jp->Visible) { // jp ?>
		<td <?php echo $gaji_delete->jp->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_jp" class="gaji_jp">
<span<?php echo $gaji_delete->jp->viewAttributes() ?>><?php echo $gaji_delete->jp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->gapok->Visible) { // gapok ?>
		<td <?php echo $gaji_delete->gapok->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_gapok" class="gaji_gapok">
<span<?php echo $gaji_delete->gapok->viewAttributes() ?>><?php echo $gaji_delete->gapok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->total_gapok->Visible) { // total_gapok ?>
		<td <?php echo $gaji_delete->total_gapok->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_total_gapok" class="gaji_total_gapok">
<span<?php echo $gaji_delete->total_gapok->viewAttributes() ?>><?php echo $gaji_delete->total_gapok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->lembur->Visible) { // lembur ?>
		<td <?php echo $gaji_delete->lembur->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_lembur" class="gaji_lembur">
<span<?php echo $gaji_delete->lembur->viewAttributes() ?>><?php echo $gaji_delete->lembur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->value_lembur->Visible) { // value_lembur ?>
		<td <?php echo $gaji_delete->value_lembur->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_value_lembur" class="gaji_value_lembur">
<span<?php echo $gaji_delete->value_lembur->viewAttributes() ?>><?php echo $gaji_delete->value_lembur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->value_reward->Visible) { // value_reward ?>
		<td <?php echo $gaji_delete->value_reward->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_value_reward" class="gaji_value_reward">
<span<?php echo $gaji_delete->value_reward->viewAttributes() ?>><?php echo $gaji_delete->value_reward->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->value_inval->Visible) { // value_inval ?>
		<td <?php echo $gaji_delete->value_inval->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_value_inval" class="gaji_value_inval">
<span<?php echo $gaji_delete->value_inval->viewAttributes() ?>><?php echo $gaji_delete->value_inval->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->piket_count->Visible) { // piket_count ?>
		<td <?php echo $gaji_delete->piket_count->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_piket_count" class="gaji_piket_count">
<span<?php echo $gaji_delete->piket_count->viewAttributes() ?>><?php echo $gaji_delete->piket_count->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->value_piket->Visible) { // value_piket ?>
		<td <?php echo $gaji_delete->value_piket->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_value_piket" class="gaji_value_piket">
<span<?php echo $gaji_delete->value_piket->viewAttributes() ?>><?php echo $gaji_delete->value_piket->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->tugastambahan->Visible) { // tugastambahan ?>
		<td <?php echo $gaji_delete->tugastambahan->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_tugastambahan" class="gaji_tugastambahan">
<span<?php echo $gaji_delete->tugastambahan->viewAttributes() ?>><?php echo $gaji_delete->tugastambahan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->tj_jabatan->Visible) { // tj_jabatan ?>
		<td <?php echo $gaji_delete->tj_jabatan->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_tj_jabatan" class="gaji_tj_jabatan">
<span<?php echo $gaji_delete->tj_jabatan->viewAttributes() ?>><?php echo $gaji_delete->tj_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->sub_total->Visible) { // sub_total ?>
		<td <?php echo $gaji_delete->sub_total->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_sub_total" class="gaji_sub_total">
<span<?php echo $gaji_delete->sub_total->viewAttributes() ?>><?php echo $gaji_delete->sub_total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->potongan->Visible) { // potongan ?>
		<td <?php echo $gaji_delete->potongan->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_potongan" class="gaji_potongan">
<span<?php echo $gaji_delete->potongan->viewAttributes() ?>><?php echo $gaji_delete->potongan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->penyesuaian->Visible) { // penyesuaian ?>
		<td <?php echo $gaji_delete->penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_penyesuaian" class="gaji_penyesuaian">
<span<?php echo $gaji_delete->penyesuaian->viewAttributes() ?>><?php echo $gaji_delete->penyesuaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_delete->total->Visible) { // total ?>
		<td <?php echo $gaji_delete->total->cellAttributes() ?>>
<span id="el<?php echo $gaji_delete->RowCount ?>_gaji_total" class="gaji_total">
<span<?php echo $gaji_delete->total->viewAttributes() ?>><?php echo $gaji_delete->total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gaji_delete->Recordset->moveNext();
}
$gaji_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gaji_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gaji_delete->showPageFooter();
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
$gaji_delete->terminate();
?>