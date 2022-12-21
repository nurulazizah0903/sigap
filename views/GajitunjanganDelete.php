<?php

namespace PHPMaker2022\sigap;

// Page object
$GajitunjanganDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gajitunjangan: currentTable } });
var currentForm, currentPageID;
var fgajitunjangandelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajitunjangandelete = new ew.Form("fgajitunjangandelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fgajitunjangandelete;
    loadjs.done("fgajitunjangandelete");
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
<form name="fgajitunjangandelete" id="fgajitunjangandelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gajitunjangan">
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
<?php if ($Page->gapok->Visible) { // gapok ?>
        <th class="<?= $Page->gapok->headerCellClass() ?>"><span id="elh_gajitunjangan_gapok" class="gajitunjangan_gapok"><?= $Page->gapok->caption() ?></span></th>
<?php } ?>
<?php if ($Page->value_kehadiran->Visible) { // value_kehadiran ?>
        <th class="<?= $Page->value_kehadiran->headerCellClass() ?>"><span id="elh_gajitunjangan_value_kehadiran" class="gajitunjangan_value_kehadiran"><?= $Page->value_kehadiran->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
        <th class="<?= $Page->tunjangan_jabatan->headerCellClass() ?>"><span id="elh_gajitunjangan_tunjangan_jabatan" class="gajitunjangan_tunjangan_jabatan"><?= $Page->tunjangan_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
        <th class="<?= $Page->tunjangan_khusus->headerCellClass() ?>"><span id="elh_gajitunjangan_tunjangan_khusus" class="gajitunjangan_tunjangan_khusus"><?= $Page->tunjangan_khusus->caption() ?></span></th>
<?php } ?>
<?php if ($Page->reward->Visible) { // reward ?>
        <th class="<?= $Page->reward->headerCellClass() ?>"><span id="elh_gajitunjangan_reward" class="gajitunjangan_reward"><?= $Page->reward->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lembur->Visible) { // lembur ?>
        <th class="<?= $Page->lembur->headerCellClass() ?>"><span id="elh_gajitunjangan_lembur" class="gajitunjangan_lembur"><?= $Page->lembur->caption() ?></span></th>
<?php } ?>
<?php if ($Page->piket->Visible) { // piket ?>
        <th class="<?= $Page->piket->headerCellClass() ?>"><span id="elh_gajitunjangan_piket" class="gajitunjangan_piket"><?= $Page->piket->caption() ?></span></th>
<?php } ?>
<?php if ($Page->inval->Visible) { // inval ?>
        <th class="<?= $Page->inval->headerCellClass() ?>"><span id="elh_gajitunjangan_inval" class="gajitunjangan_inval"><?= $Page->inval->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jam_lebih->Visible) { // jam_lebih ?>
        <th class="<?= $Page->jam_lebih->headerCellClass() ?>"><span id="elh_gajitunjangan_jam_lebih" class="gajitunjangan_jam_lebih"><?= $Page->jam_lebih->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ekstrakuri->Visible) { // ekstrakuri ?>
        <th class="<?= $Page->ekstrakuri->headerCellClass() ?>"><span id="elh_gajitunjangan_ekstrakuri" class="gajitunjangan_ekstrakuri"><?= $Page->ekstrakuri->caption() ?></span></th>
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
<?php if ($Page->gapok->Visible) { // gapok ?>
        <td<?= $Page->gapok->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajitunjangan_gapok" class="el_gajitunjangan_gapok">
<span<?= $Page->gapok->viewAttributes() ?>>
<?= $Page->gapok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->value_kehadiran->Visible) { // value_kehadiran ?>
        <td<?= $Page->value_kehadiran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajitunjangan_value_kehadiran" class="el_gajitunjangan_value_kehadiran">
<span<?= $Page->value_kehadiran->viewAttributes() ?>>
<?= $Page->value_kehadiran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
        <td<?= $Page->tunjangan_jabatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajitunjangan_tunjangan_jabatan" class="el_gajitunjangan_tunjangan_jabatan">
<span<?= $Page->tunjangan_jabatan->viewAttributes() ?>>
<?= $Page->tunjangan_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
        <td<?= $Page->tunjangan_khusus->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajitunjangan_tunjangan_khusus" class="el_gajitunjangan_tunjangan_khusus">
<span<?= $Page->tunjangan_khusus->viewAttributes() ?>>
<?= $Page->tunjangan_khusus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->reward->Visible) { // reward ?>
        <td<?= $Page->reward->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajitunjangan_reward" class="el_gajitunjangan_reward">
<span<?= $Page->reward->viewAttributes() ?>>
<?= $Page->reward->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lembur->Visible) { // lembur ?>
        <td<?= $Page->lembur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajitunjangan_lembur" class="el_gajitunjangan_lembur">
<span<?= $Page->lembur->viewAttributes() ?>>
<?= $Page->lembur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->piket->Visible) { // piket ?>
        <td<?= $Page->piket->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajitunjangan_piket" class="el_gajitunjangan_piket">
<span<?= $Page->piket->viewAttributes() ?>>
<?= $Page->piket->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->inval->Visible) { // inval ?>
        <td<?= $Page->inval->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajitunjangan_inval" class="el_gajitunjangan_inval">
<span<?= $Page->inval->viewAttributes() ?>>
<?= $Page->inval->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jam_lebih->Visible) { // jam_lebih ?>
        <td<?= $Page->jam_lebih->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajitunjangan_jam_lebih" class="el_gajitunjangan_jam_lebih">
<span<?= $Page->jam_lebih->viewAttributes() ?>>
<?= $Page->jam_lebih->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ekstrakuri->Visible) { // ekstrakuri ?>
        <td<?= $Page->ekstrakuri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajitunjangan_ekstrakuri" class="el_gajitunjangan_ekstrakuri">
<span<?= $Page->ekstrakuri->viewAttributes() ?>>
<?= $Page->ekstrakuri->getViewValue() ?></span>
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
