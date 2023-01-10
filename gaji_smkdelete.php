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
$gaji_smk_delete = new gaji_smk_delete();

// Run the page
$gaji_smk_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_smk_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fgaji_smkdelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fgaji_smkdelete = currentForm = new ew.Form("fgaji_smkdelete", "delete");
	loadjs.done("fgaji_smkdelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $gaji_smk_delete->showPageHeader(); ?>
<?php
$gaji_smk_delete->showMessage();
?>
<form name="fgaji_smkdelete" id="fgaji_smkdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gaji_smk">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($gaji_smk_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($gaji_smk_delete->pegawai->Visible) { // pegawai ?>
		<th class="<?php echo $gaji_smk_delete->pegawai->headerCellClass() ?>"><span id="elh_gaji_smk_pegawai" class="gaji_smk_pegawai"><?php echo $gaji_smk_delete->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->jenjang_id->Visible) { // jenjang_id ?>
		<th class="<?php echo $gaji_smk_delete->jenjang_id->headerCellClass() ?>"><span id="elh_gaji_smk_jenjang_id" class="gaji_smk_jenjang_id"><?php echo $gaji_smk_delete->jenjang_id->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->jabatan_id->Visible) { // jabatan_id ?>
		<th class="<?php echo $gaji_smk_delete->jabatan_id->headerCellClass() ?>"><span id="elh_gaji_smk_jabatan_id" class="gaji_smk_jabatan_id"><?php echo $gaji_smk_delete->jabatan_id->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->lama_kerja->Visible) { // lama_kerja ?>
		<th class="<?php echo $gaji_smk_delete->lama_kerja->headerCellClass() ?>"><span id="elh_gaji_smk_lama_kerja" class="gaji_smk_lama_kerja"><?php echo $gaji_smk_delete->lama_kerja->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->type->Visible) { // type ?>
		<th class="<?php echo $gaji_smk_delete->type->headerCellClass() ?>"><span id="elh_gaji_smk_type" class="gaji_smk_type"><?php echo $gaji_smk_delete->type->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->jenis_guru->Visible) { // jenis_guru ?>
		<th class="<?php echo $gaji_smk_delete->jenis_guru->headerCellClass() ?>"><span id="elh_gaji_smk_jenis_guru" class="gaji_smk_jenis_guru"><?php echo $gaji_smk_delete->jenis_guru->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->tambahan->Visible) { // tambahan ?>
		<th class="<?php echo $gaji_smk_delete->tambahan->headerCellClass() ?>"><span id="elh_gaji_smk_tambahan" class="gaji_smk_tambahan"><?php echo $gaji_smk_delete->tambahan->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->periode->Visible) { // periode ?>
		<th class="<?php echo $gaji_smk_delete->periode->headerCellClass() ?>"><span id="elh_gaji_smk_periode" class="gaji_smk_periode"><?php echo $gaji_smk_delete->periode->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->tunjangan_periode->Visible) { // tunjangan_periode ?>
		<th class="<?php echo $gaji_smk_delete->tunjangan_periode->headerCellClass() ?>"><span id="elh_gaji_smk_tunjangan_periode" class="gaji_smk_tunjangan_periode"><?php echo $gaji_smk_delete->tunjangan_periode->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->kehadiran->Visible) { // kehadiran ?>
		<th class="<?php echo $gaji_smk_delete->kehadiran->headerCellClass() ?>"><span id="elh_gaji_smk_kehadiran" class="gaji_smk_kehadiran"><?php echo $gaji_smk_delete->kehadiran->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->value_kehadiran->Visible) { // value_kehadiran ?>
		<th class="<?php echo $gaji_smk_delete->value_kehadiran->headerCellClass() ?>"><span id="elh_gaji_smk_value_kehadiran" class="gaji_smk_value_kehadiran"><?php echo $gaji_smk_delete->value_kehadiran->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->lembur->Visible) { // lembur ?>
		<th class="<?php echo $gaji_smk_delete->lembur->headerCellClass() ?>"><span id="elh_gaji_smk_lembur" class="gaji_smk_lembur"><?php echo $gaji_smk_delete->lembur->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->value_lembur->Visible) { // value_lembur ?>
		<th class="<?php echo $gaji_smk_delete->value_lembur->headerCellClass() ?>"><span id="elh_gaji_smk_value_lembur" class="gaji_smk_value_lembur"><?php echo $gaji_smk_delete->value_lembur->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->jp->Visible) { // jp ?>
		<th class="<?php echo $gaji_smk_delete->jp->headerCellClass() ?>"><span id="elh_gaji_smk_jp" class="gaji_smk_jp"><?php echo $gaji_smk_delete->jp->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->gapok->Visible) { // gapok ?>
		<th class="<?php echo $gaji_smk_delete->gapok->headerCellClass() ?>"><span id="elh_gaji_smk_gapok" class="gaji_smk_gapok"><?php echo $gaji_smk_delete->gapok->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->total_gapok->Visible) { // total_gapok ?>
		<th class="<?php echo $gaji_smk_delete->total_gapok->headerCellClass() ?>"><span id="elh_gaji_smk_total_gapok" class="gaji_smk_total_gapok"><?php echo $gaji_smk_delete->total_gapok->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->value_reward->Visible) { // value_reward ?>
		<th class="<?php echo $gaji_smk_delete->value_reward->headerCellClass() ?>"><span id="elh_gaji_smk_value_reward" class="gaji_smk_value_reward"><?php echo $gaji_smk_delete->value_reward->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->value_inval->Visible) { // value_inval ?>
		<th class="<?php echo $gaji_smk_delete->value_inval->headerCellClass() ?>"><span id="elh_gaji_smk_value_inval" class="gaji_smk_value_inval"><?php echo $gaji_smk_delete->value_inval->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->piket_count->Visible) { // piket_count ?>
		<th class="<?php echo $gaji_smk_delete->piket_count->headerCellClass() ?>"><span id="elh_gaji_smk_piket_count" class="gaji_smk_piket_count"><?php echo $gaji_smk_delete->piket_count->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->value_piket->Visible) { // value_piket ?>
		<th class="<?php echo $gaji_smk_delete->value_piket->headerCellClass() ?>"><span id="elh_gaji_smk_value_piket" class="gaji_smk_value_piket"><?php echo $gaji_smk_delete->value_piket->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->tugastambahan->Visible) { // tugastambahan ?>
		<th class="<?php echo $gaji_smk_delete->tugastambahan->headerCellClass() ?>"><span id="elh_gaji_smk_tugastambahan" class="gaji_smk_tugastambahan"><?php echo $gaji_smk_delete->tugastambahan->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->tj_jabatan->Visible) { // tj_jabatan ?>
		<th class="<?php echo $gaji_smk_delete->tj_jabatan->headerCellClass() ?>"><span id="elh_gaji_smk_tj_jabatan" class="gaji_smk_tj_jabatan"><?php echo $gaji_smk_delete->tj_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->sub_total->Visible) { // sub_total ?>
		<th class="<?php echo $gaji_smk_delete->sub_total->headerCellClass() ?>"><span id="elh_gaji_smk_sub_total" class="gaji_smk_sub_total"><?php echo $gaji_smk_delete->sub_total->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->potongan->Visible) { // potongan ?>
		<th class="<?php echo $gaji_smk_delete->potongan->headerCellClass() ?>"><span id="elh_gaji_smk_potongan" class="gaji_smk_potongan"><?php echo $gaji_smk_delete->potongan->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->penyesuaian->Visible) { // penyesuaian ?>
		<th class="<?php echo $gaji_smk_delete->penyesuaian->headerCellClass() ?>"><span id="elh_gaji_smk_penyesuaian" class="gaji_smk_penyesuaian"><?php echo $gaji_smk_delete->penyesuaian->caption() ?></span></th>
<?php } ?>
<?php if ($gaji_smk_delete->total->Visible) { // total ?>
		<th class="<?php echo $gaji_smk_delete->total->headerCellClass() ?>"><span id="elh_gaji_smk_total" class="gaji_smk_total"><?php echo $gaji_smk_delete->total->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$gaji_smk_delete->RecordCount = 0;
$i = 0;
while (!$gaji_smk_delete->Recordset->EOF) {
	$gaji_smk_delete->RecordCount++;
	$gaji_smk_delete->RowCount++;

	// Set row properties
	$gaji_smk->resetAttributes();
	$gaji_smk->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$gaji_smk_delete->loadRowValues($gaji_smk_delete->Recordset);

	// Render row
	$gaji_smk_delete->renderRow();
?>
	<tr <?php echo $gaji_smk->rowAttributes() ?>>
<?php if ($gaji_smk_delete->pegawai->Visible) { // pegawai ?>
		<td <?php echo $gaji_smk_delete->pegawai->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_pegawai" class="gaji_smk_pegawai">
<span<?php echo $gaji_smk_delete->pegawai->viewAttributes() ?>><?php echo $gaji_smk_delete->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->jenjang_id->Visible) { // jenjang_id ?>
		<td <?php echo $gaji_smk_delete->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_jenjang_id" class="gaji_smk_jenjang_id">
<span<?php echo $gaji_smk_delete->jenjang_id->viewAttributes() ?>><?php echo $gaji_smk_delete->jenjang_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->jabatan_id->Visible) { // jabatan_id ?>
		<td <?php echo $gaji_smk_delete->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_jabatan_id" class="gaji_smk_jabatan_id">
<span<?php echo $gaji_smk_delete->jabatan_id->viewAttributes() ?>><?php echo $gaji_smk_delete->jabatan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->lama_kerja->Visible) { // lama_kerja ?>
		<td <?php echo $gaji_smk_delete->lama_kerja->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_lama_kerja" class="gaji_smk_lama_kerja">
<span<?php echo $gaji_smk_delete->lama_kerja->viewAttributes() ?>><?php echo $gaji_smk_delete->lama_kerja->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->type->Visible) { // type ?>
		<td <?php echo $gaji_smk_delete->type->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_type" class="gaji_smk_type">
<span<?php echo $gaji_smk_delete->type->viewAttributes() ?>><?php echo $gaji_smk_delete->type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->jenis_guru->Visible) { // jenis_guru ?>
		<td <?php echo $gaji_smk_delete->jenis_guru->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_jenis_guru" class="gaji_smk_jenis_guru">
<span<?php echo $gaji_smk_delete->jenis_guru->viewAttributes() ?>><?php echo $gaji_smk_delete->jenis_guru->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->tambahan->Visible) { // tambahan ?>
		<td <?php echo $gaji_smk_delete->tambahan->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_tambahan" class="gaji_smk_tambahan">
<span<?php echo $gaji_smk_delete->tambahan->viewAttributes() ?>><?php echo $gaji_smk_delete->tambahan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->periode->Visible) { // periode ?>
		<td <?php echo $gaji_smk_delete->periode->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_periode" class="gaji_smk_periode">
<span<?php echo $gaji_smk_delete->periode->viewAttributes() ?>><?php echo $gaji_smk_delete->periode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->tunjangan_periode->Visible) { // tunjangan_periode ?>
		<td <?php echo $gaji_smk_delete->tunjangan_periode->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_tunjangan_periode" class="gaji_smk_tunjangan_periode">
<span<?php echo $gaji_smk_delete->tunjangan_periode->viewAttributes() ?>><?php echo $gaji_smk_delete->tunjangan_periode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->kehadiran->Visible) { // kehadiran ?>
		<td <?php echo $gaji_smk_delete->kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_kehadiran" class="gaji_smk_kehadiran">
<span<?php echo $gaji_smk_delete->kehadiran->viewAttributes() ?>><?php echo $gaji_smk_delete->kehadiran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->value_kehadiran->Visible) { // value_kehadiran ?>
		<td <?php echo $gaji_smk_delete->value_kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_value_kehadiran" class="gaji_smk_value_kehadiran">
<span<?php echo $gaji_smk_delete->value_kehadiran->viewAttributes() ?>><?php echo $gaji_smk_delete->value_kehadiran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->lembur->Visible) { // lembur ?>
		<td <?php echo $gaji_smk_delete->lembur->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_lembur" class="gaji_smk_lembur">
<span<?php echo $gaji_smk_delete->lembur->viewAttributes() ?>><?php echo $gaji_smk_delete->lembur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->value_lembur->Visible) { // value_lembur ?>
		<td <?php echo $gaji_smk_delete->value_lembur->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_value_lembur" class="gaji_smk_value_lembur">
<span<?php echo $gaji_smk_delete->value_lembur->viewAttributes() ?>><?php echo $gaji_smk_delete->value_lembur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->jp->Visible) { // jp ?>
		<td <?php echo $gaji_smk_delete->jp->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_jp" class="gaji_smk_jp">
<span<?php echo $gaji_smk_delete->jp->viewAttributes() ?>><?php echo $gaji_smk_delete->jp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->gapok->Visible) { // gapok ?>
		<td <?php echo $gaji_smk_delete->gapok->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_gapok" class="gaji_smk_gapok">
<span<?php echo $gaji_smk_delete->gapok->viewAttributes() ?>><?php echo $gaji_smk_delete->gapok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->total_gapok->Visible) { // total_gapok ?>
		<td <?php echo $gaji_smk_delete->total_gapok->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_total_gapok" class="gaji_smk_total_gapok">
<span<?php echo $gaji_smk_delete->total_gapok->viewAttributes() ?>><?php echo $gaji_smk_delete->total_gapok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->value_reward->Visible) { // value_reward ?>
		<td <?php echo $gaji_smk_delete->value_reward->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_value_reward" class="gaji_smk_value_reward">
<span<?php echo $gaji_smk_delete->value_reward->viewAttributes() ?>><?php echo $gaji_smk_delete->value_reward->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->value_inval->Visible) { // value_inval ?>
		<td <?php echo $gaji_smk_delete->value_inval->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_value_inval" class="gaji_smk_value_inval">
<span<?php echo $gaji_smk_delete->value_inval->viewAttributes() ?>><?php echo $gaji_smk_delete->value_inval->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->piket_count->Visible) { // piket_count ?>
		<td <?php echo $gaji_smk_delete->piket_count->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_piket_count" class="gaji_smk_piket_count">
<span<?php echo $gaji_smk_delete->piket_count->viewAttributes() ?>><?php echo $gaji_smk_delete->piket_count->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->value_piket->Visible) { // value_piket ?>
		<td <?php echo $gaji_smk_delete->value_piket->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_value_piket" class="gaji_smk_value_piket">
<span<?php echo $gaji_smk_delete->value_piket->viewAttributes() ?>><?php echo $gaji_smk_delete->value_piket->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->tugastambahan->Visible) { // tugastambahan ?>
		<td <?php echo $gaji_smk_delete->tugastambahan->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_tugastambahan" class="gaji_smk_tugastambahan">
<span<?php echo $gaji_smk_delete->tugastambahan->viewAttributes() ?>><?php echo $gaji_smk_delete->tugastambahan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->tj_jabatan->Visible) { // tj_jabatan ?>
		<td <?php echo $gaji_smk_delete->tj_jabatan->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_tj_jabatan" class="gaji_smk_tj_jabatan">
<span<?php echo $gaji_smk_delete->tj_jabatan->viewAttributes() ?>><?php echo $gaji_smk_delete->tj_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->sub_total->Visible) { // sub_total ?>
		<td <?php echo $gaji_smk_delete->sub_total->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_sub_total" class="gaji_smk_sub_total">
<span<?php echo $gaji_smk_delete->sub_total->viewAttributes() ?>><?php echo $gaji_smk_delete->sub_total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->potongan->Visible) { // potongan ?>
		<td <?php echo $gaji_smk_delete->potongan->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_potongan" class="gaji_smk_potongan">
<span<?php echo $gaji_smk_delete->potongan->viewAttributes() ?>><?php echo $gaji_smk_delete->potongan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->penyesuaian->Visible) { // penyesuaian ?>
		<td <?php echo $gaji_smk_delete->penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_penyesuaian" class="gaji_smk_penyesuaian">
<span<?php echo $gaji_smk_delete->penyesuaian->viewAttributes() ?>><?php echo $gaji_smk_delete->penyesuaian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($gaji_smk_delete->total->Visible) { // total ?>
		<td <?php echo $gaji_smk_delete->total->cellAttributes() ?>>
<span id="el<?php echo $gaji_smk_delete->RowCount ?>_gaji_smk_total" class="gaji_smk_total">
<span<?php echo $gaji_smk_delete->total->viewAttributes() ?>><?php echo $gaji_smk_delete->total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$gaji_smk_delete->Recordset->moveNext();
}
$gaji_smk_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $gaji_smk_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$gaji_smk_delete->showPageFooter();
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
$gaji_smk_delete->terminate();
?>