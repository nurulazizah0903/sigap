<?php

namespace PHPMaker2022\sigap;

// Page object
$GajiPokokDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gaji_pokok: currentTable } });
var currentForm, currentPageID;
var fgaji_pokokdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgaji_pokokdelete = new ew.Form("fgaji_pokokdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fgaji_pokokdelete;
    loadjs.done("fgaji_pokokdelete");
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
<form name="fgaji_pokokdelete" id="fgaji_pokokdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gaji_pokok">
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
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_gaji_pokok_id" class="gaji_pokok_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
        <th class="<?= $Page->jenjang_id->headerCellClass() ?>"><span id="elh_gaji_pokok_jenjang_id" class="gaji_pokok_jenjang_id"><?= $Page->jenjang_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ijazah_id->Visible) { // ijazah_id ?>
        <th class="<?= $Page->ijazah_id->headerCellClass() ?>"><span id="elh_gaji_pokok_ijazah_id" class="gaji_pokok_ijazah_id"><?= $Page->ijazah_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->lama_kerja->Visible) { // lama_kerja ?>
        <th class="<?= $Page->lama_kerja->headerCellClass() ?>"><span id="elh_gaji_pokok_lama_kerja" class="gaji_pokok_lama_kerja"><?= $Page->lama_kerja->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <th class="<?= $Page->jenis->headerCellClass() ?>"><span id="elh_gaji_pokok_jenis" class="gaji_pokok_jenis"><?= $Page->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->value->Visible) { // value ?>
        <th class="<?= $Page->value->headerCellClass() ?>"><span id="elh_gaji_pokok_value" class="gaji_pokok_value"><?= $Page->value->caption() ?></span></th>
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
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_pokok_id" class="el_gaji_pokok_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
        <td<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_pokok_jenjang_id" class="el_gaji_pokok_jenjang_id">
<span<?= $Page->jenjang_id->viewAttributes() ?>>
<?= $Page->jenjang_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ijazah_id->Visible) { // ijazah_id ?>
        <td<?= $Page->ijazah_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_pokok_ijazah_id" class="el_gaji_pokok_ijazah_id">
<span<?= $Page->ijazah_id->viewAttributes() ?>>
<?= $Page->ijazah_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->lama_kerja->Visible) { // lama_kerja ?>
        <td<?= $Page->lama_kerja->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_pokok_lama_kerja" class="el_gaji_pokok_lama_kerja">
<span<?= $Page->lama_kerja->viewAttributes() ?>>
<?= $Page->lama_kerja->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <td<?= $Page->jenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_pokok_jenis" class="el_gaji_pokok_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->value->Visible) { // value ?>
        <td<?= $Page->value->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_pokok_value" class="el_gaji_pokok_value">
<span<?= $Page->value->viewAttributes() ?>>
<?= $Page->value->getViewValue() ?></span>
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
