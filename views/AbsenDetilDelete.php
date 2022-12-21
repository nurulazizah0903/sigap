<?php

namespace PHPMaker2022\sigap;

// Page object
$AbsenDetilDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { absen_detil: currentTable } });
var currentForm, currentPageID;
var fabsen_detildelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fabsen_detildelete = new ew.Form("fabsen_detildelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fabsen_detildelete;
    loadjs.done("fabsen_detildelete");
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
<form name="fabsen_detildelete" id="fabsen_detildelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="absen_detil">
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
<?php if ($Page->pegawai->Visible) { // pegawai ?>
        <th class="<?= $Page->pegawai->headerCellClass() ?>"><span id="elh_absen_detil_pegawai" class="absen_detil_pegawai"><?= $Page->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->masuk->Visible) { // masuk ?>
        <th class="<?= $Page->masuk->headerCellClass() ?>"><span id="elh_absen_detil_masuk" class="absen_detil_masuk"><?= $Page->masuk->caption() ?></span></th>
<?php } ?>
<?php if ($Page->absen->Visible) { // absen ?>
        <th class="<?= $Page->absen->headerCellClass() ?>"><span id="elh_absen_detil_absen" class="absen_detil_absen"><?= $Page->absen->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ijin->Visible) { // ijin ?>
        <th class="<?= $Page->ijin->headerCellClass() ?>"><span id="elh_absen_detil_ijin" class="absen_detil_ijin"><?= $Page->ijin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->cuti->Visible) { // cuti ?>
        <th class="<?= $Page->cuti->headerCellClass() ?>"><span id="elh_absen_detil_cuti" class="absen_detil_cuti"><?= $Page->cuti->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dinas_luar->Visible) { // dinas_luar ?>
        <th class="<?= $Page->dinas_luar->headerCellClass() ?>"><span id="elh_absen_detil_dinas_luar" class="absen_detil_dinas_luar"><?= $Page->dinas_luar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->terlambat->Visible) { // terlambat ?>
        <th class="<?= $Page->terlambat->headerCellClass() ?>"><span id="elh_absen_detil_terlambat" class="absen_detil_terlambat"><?= $Page->terlambat->caption() ?></span></th>
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
<?php if ($Page->pegawai->Visible) { // pegawai ?>
        <td<?= $Page->pegawai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_detil_pegawai" class="el_absen_detil_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->masuk->Visible) { // masuk ?>
        <td<?= $Page->masuk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_detil_masuk" class="el_absen_detil_masuk">
<span<?= $Page->masuk->viewAttributes() ?>>
<?= $Page->masuk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->absen->Visible) { // absen ?>
        <td<?= $Page->absen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_detil_absen" class="el_absen_detil_absen">
<span<?= $Page->absen->viewAttributes() ?>>
<?= $Page->absen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ijin->Visible) { // ijin ?>
        <td<?= $Page->ijin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_detil_ijin" class="el_absen_detil_ijin">
<span<?= $Page->ijin->viewAttributes() ?>>
<?= $Page->ijin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->cuti->Visible) { // cuti ?>
        <td<?= $Page->cuti->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_detil_cuti" class="el_absen_detil_cuti">
<span<?= $Page->cuti->viewAttributes() ?>>
<?= $Page->cuti->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dinas_luar->Visible) { // dinas_luar ?>
        <td<?= $Page->dinas_luar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_detil_dinas_luar" class="el_absen_detil_dinas_luar">
<span<?= $Page->dinas_luar->viewAttributes() ?>>
<?= $Page->dinas_luar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->terlambat->Visible) { // terlambat ?>
        <td<?= $Page->terlambat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_detil_terlambat" class="el_absen_detil_terlambat">
<span<?= $Page->terlambat->viewAttributes() ?>>
<?= $Page->terlambat->getViewValue() ?></span>
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
