<?php

namespace PHPMaker2022\sigap;

// Page object
$GajiDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gaji: currentTable } });
var currentForm, currentPageID;
var fgajidelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajidelete = new ew.Form("fgajidelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fgajidelete;
    loadjs.done("fgajidelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fgajidelete" id="fgajidelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gaji">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <th class="<?= $Page->jabatan_id->headerCellClass() ?>"><span id="elh_gaji_jabatan_id" class="gaji_jabatan_id"><?= $Page->jabatan_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
        <th class="<?= $Page->pegawai->headerCellClass() ?>"><span id="elh_gaji_pegawai" class="gaji_pegawai"><?= $Page->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lembur->Visible) { // lembur ?>
        <th class="<?= $Page->lembur->headerCellClass() ?>"><span id="elh_gaji_lembur" class="gaji_lembur"><?= $Page->lembur->caption() ?></span></th>
<?php } ?>
<?php if ($Page->value_lembur->Visible) { // value_lembur ?>
        <th class="<?= $Page->value_lembur->headerCellClass() ?>"><span id="elh_gaji_value_lembur" class="gaji_value_lembur"><?= $Page->value_lembur->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kehadiran->Visible) { // kehadiran ?>
        <th class="<?= $Page->kehadiran->headerCellClass() ?>"><span id="elh_gaji_kehadiran" class="gaji_kehadiran"><?= $Page->kehadiran->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gapok->Visible) { // gapok ?>
        <th class="<?= $Page->gapok->headerCellClass() ?>"><span id="elh_gaji_gapok" class="gaji_gapok"><?= $Page->gapok->caption() ?></span></th>
<?php } ?>
<?php if ($Page->value_reward->Visible) { // value_reward ?>
        <th class="<?= $Page->value_reward->headerCellClass() ?>"><span id="elh_gaji_value_reward" class="gaji_value_reward"><?= $Page->value_reward->caption() ?></span></th>
<?php } ?>
<?php if ($Page->value_inval->Visible) { // value_inval ?>
        <th class="<?= $Page->value_inval->headerCellClass() ?>"><span id="elh_gaji_value_inval" class="gaji_value_inval"><?= $Page->value_inval->caption() ?></span></th>
<?php } ?>
<?php if ($Page->piket_count->Visible) { // piket_count ?>
        <th class="<?= $Page->piket_count->headerCellClass() ?>"><span id="elh_gaji_piket_count" class="gaji_piket_count"><?= $Page->piket_count->caption() ?></span></th>
<?php } ?>
<?php if ($Page->value_piket->Visible) { // value_piket ?>
        <th class="<?= $Page->value_piket->headerCellClass() ?>"><span id="elh_gaji_value_piket" class="gaji_value_piket"><?= $Page->value_piket->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tugastambahan->Visible) { // tugastambahan ?>
        <th class="<?= $Page->tugastambahan->headerCellClass() ?>"><span id="elh_gaji_tugastambahan" class="gaji_tugastambahan"><?= $Page->tugastambahan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tj_jabatan->Visible) { // tj_jabatan ?>
        <th class="<?= $Page->tj_jabatan->headerCellClass() ?>"><span id="elh_gaji_tj_jabatan" class="gaji_tj_jabatan"><?= $Page->tj_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sub_total->Visible) { // sub_total ?>
        <th class="<?= $Page->sub_total->headerCellClass() ?>"><span id="elh_gaji_sub_total" class="gaji_sub_total"><?= $Page->sub_total->caption() ?></span></th>
<?php } ?>
<?php if ($Page->potongan->Visible) { // potongan ?>
        <th class="<?= $Page->potongan->headerCellClass() ?>"><span id="elh_gaji_potongan" class="gaji_potongan"><?= $Page->potongan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <th class="<?= $Page->total->headerCellClass() ?>"><span id="elh_gaji_total" class="gaji_total"><?= $Page->total->caption() ?></span></th>
<?php } ?>
<?php if ($Page->month->Visible) { // month ?>
        <th class="<?= $Page->month->headerCellClass() ?>"><span id="elh_gaji_month" class="gaji_month"><?= $Page->month->caption() ?></span></th>
<?php } ?>
<?php if ($Page->datetime->Visible) { // datetime ?>
        <th class="<?= $Page->datetime->headerCellClass() ?>"><span id="elh_gaji_datetime" class="gaji_datetime"><?= $Page->datetime->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <td<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_jabatan_id" class="el_gaji_jabatan_id">
<span<?= $Page->jabatan_id->viewAttributes() ?>>
<?= $Page->jabatan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
        <td<?= $Page->pegawai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_pegawai" class="el_gaji_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lembur->Visible) { // lembur ?>
        <td<?= $Page->lembur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_lembur" class="el_gaji_lembur">
<span<?= $Page->lembur->viewAttributes() ?>>
<?= $Page->lembur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->value_lembur->Visible) { // value_lembur ?>
        <td<?= $Page->value_lembur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_value_lembur" class="el_gaji_value_lembur">
<span<?= $Page->value_lembur->viewAttributes() ?>>
<?= $Page->value_lembur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kehadiran->Visible) { // kehadiran ?>
        <td<?= $Page->kehadiran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_kehadiran" class="el_gaji_kehadiran">
<span<?= $Page->kehadiran->viewAttributes() ?>>
<?= $Page->kehadiran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gapok->Visible) { // gapok ?>
        <td<?= $Page->gapok->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_gapok" class="el_gaji_gapok">
<span<?= $Page->gapok->viewAttributes() ?>>
<?= $Page->gapok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->value_reward->Visible) { // value_reward ?>
        <td<?= $Page->value_reward->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_value_reward" class="el_gaji_value_reward">
<span<?= $Page->value_reward->viewAttributes() ?>>
<?= $Page->value_reward->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->value_inval->Visible) { // value_inval ?>
        <td<?= $Page->value_inval->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_value_inval" class="el_gaji_value_inval">
<span<?= $Page->value_inval->viewAttributes() ?>>
<?= $Page->value_inval->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->piket_count->Visible) { // piket_count ?>
        <td<?= $Page->piket_count->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_piket_count" class="el_gaji_piket_count">
<span<?= $Page->piket_count->viewAttributes() ?>>
<?= $Page->piket_count->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->value_piket->Visible) { // value_piket ?>
        <td<?= $Page->value_piket->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_value_piket" class="el_gaji_value_piket">
<span<?= $Page->value_piket->viewAttributes() ?>>
<?= $Page->value_piket->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tugastambahan->Visible) { // tugastambahan ?>
        <td<?= $Page->tugastambahan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_tugastambahan" class="el_gaji_tugastambahan">
<span<?= $Page->tugastambahan->viewAttributes() ?>>
<?= $Page->tugastambahan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tj_jabatan->Visible) { // tj_jabatan ?>
        <td<?= $Page->tj_jabatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_tj_jabatan" class="el_gaji_tj_jabatan">
<span<?= $Page->tj_jabatan->viewAttributes() ?>>
<?= $Page->tj_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sub_total->Visible) { // sub_total ?>
        <td<?= $Page->sub_total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_sub_total" class="el_gaji_sub_total">
<span<?= $Page->sub_total->viewAttributes() ?>>
<?= $Page->sub_total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->potongan->Visible) { // potongan ?>
        <td<?= $Page->potongan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_potongan" class="el_gaji_potongan">
<span<?= $Page->potongan->viewAttributes() ?>>
<?= $Page->potongan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <td<?= $Page->total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_total" class="el_gaji_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->month->Visible) { // month ?>
        <td<?= $Page->month->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_month" class="el_gaji_month">
<span<?= $Page->month->viewAttributes() ?>>
<?= $Page->month->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->datetime->Visible) { // datetime ?>
        <td<?= $Page->datetime->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_datetime" class="el_gaji_datetime">
<span<?= $Page->datetime->viewAttributes() ?>>
<?= $Page->datetime->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
