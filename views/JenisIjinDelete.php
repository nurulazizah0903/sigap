<?php

namespace PHPMaker2022\sigap;

// Page object
$JenisIjinDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jenis_ijin: currentTable } });
var currentForm, currentPageID;
var fjenis_ijindelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjenis_ijindelete = new ew.Form("fjenis_ijindelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fjenis_ijindelete;
    loadjs.done("fjenis_ijindelete");
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
<form name="fjenis_ijindelete" id="fjenis_ijindelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jenis_ijin">
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
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
        <th class="<?= $Page->jenjang_id->headerCellClass() ?>"><span id="elh_jenis_ijin_jenjang_id" class="jenis_ijin_jenjang_id"><?= $Page->jenjang_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <th class="<?= $Page->jabatan_id->headerCellClass() ?>"><span id="elh_jenis_ijin_jabatan_id" class="jenis_ijin_jabatan_id"><?= $Page->jabatan_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><span id="elh_jenis_ijin_nama" class="jenis_ijin_nama"><?= $Page->nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
        <th class="<?= $Page->aktif->headerCellClass() ?>"><span id="elh_jenis_ijin_aktif" class="jenis_ijin_aktif"><?= $Page->aktif->caption() ?></span></th>
<?php } ?>
<?php if ($Page->value->Visible) { // value ?>
        <th class="<?= $Page->value->headerCellClass() ?>"><span id="elh_jenis_ijin_value" class="jenis_ijin_value"><?= $Page->value->caption() ?></span></th>
<?php } ?>
<?php if ($Page->valueperjam->Visible) { // valueperjam ?>
        <th class="<?= $Page->valueperjam->headerCellClass() ?>"><span id="elh_jenis_ijin_valueperjam" class="jenis_ijin_valueperjam"><?= $Page->valueperjam->caption() ?></span></th>
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
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
        <td<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jenis_ijin_jenjang_id" class="el_jenis_ijin_jenjang_id">
<span<?= $Page->jenjang_id->viewAttributes() ?>>
<?= $Page->jenjang_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <td<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jenis_ijin_jabatan_id" class="el_jenis_ijin_jabatan_id">
<span<?= $Page->jabatan_id->viewAttributes() ?>>
<?= $Page->jabatan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <td<?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jenis_ijin_nama" class="el_jenis_ijin_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
        <td<?= $Page->aktif->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jenis_ijin_aktif" class="el_jenis_ijin_aktif">
<span<?= $Page->aktif->viewAttributes() ?>>
<?= $Page->aktif->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->value->Visible) { // value ?>
        <td<?= $Page->value->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jenis_ijin_value" class="el_jenis_ijin_value">
<span<?= $Page->value->viewAttributes() ?>>
<?= $Page->value->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->valueperjam->Visible) { // valueperjam ?>
        <td<?= $Page->valueperjam->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jenis_ijin_valueperjam" class="el_jenis_ijin_valueperjam">
<span<?= $Page->valueperjam->viewAttributes() ?>>
<?= $Page->valueperjam->getViewValue() ?></span>
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
