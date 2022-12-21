<?php

namespace PHPMaker2022\sigap;

// Page object
$ProyekDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { proyek: currentTable } });
var currentForm, currentPageID;
var fproyekdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fproyekdelete = new ew.Form("fproyekdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fproyekdelete;
    loadjs.done("fproyekdelete");
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
<form name="fproyekdelete" id="fproyekdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="proyek">
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
<?php if ($Page->klien->Visible) { // klien ?>
        <th class="<?= $Page->klien->headerCellClass() ?>"><span id="elh_proyek_klien" class="proyek_klien"><?= $Page->klien->caption() ?></span></th>
<?php } ?>
<?php if ($Page->proyek->Visible) { // proyek ?>
        <th class="<?= $Page->proyek->headerCellClass() ?>"><span id="elh_proyek_proyek" class="proyek_proyek"><?= $Page->proyek->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_awal->Visible) { // tgl_awal ?>
        <th class="<?= $Page->tgl_awal->headerCellClass() ?>"><span id="elh_proyek_tgl_awal" class="proyek_tgl_awal"><?= $Page->tgl_awal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_akhir->Visible) { // tgl_akhir ?>
        <th class="<?= $Page->tgl_akhir->headerCellClass() ?>"><span id="elh_proyek_tgl_akhir" class="proyek_tgl_akhir"><?= $Page->tgl_akhir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->file_proyek->Visible) { // file_proyek ?>
        <th class="<?= $Page->file_proyek->headerCellClass() ?>"><span id="elh_proyek_file_proyek" class="proyek_file_proyek"><?= $Page->file_proyek->caption() ?></span></th>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
        <th class="<?= $Page->aktif->headerCellClass() ?>"><span id="elh_proyek_aktif" class="proyek_aktif"><?= $Page->aktif->caption() ?></span></th>
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
<?php if ($Page->klien->Visible) { // klien ?>
        <td<?= $Page->klien->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_klien" class="el_proyek_klien">
<span<?= $Page->klien->viewAttributes() ?>>
<?= $Page->klien->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->proyek->Visible) { // proyek ?>
        <td<?= $Page->proyek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_proyek" class="el_proyek_proyek">
<span<?= $Page->proyek->viewAttributes() ?>>
<?= $Page->proyek->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_awal->Visible) { // tgl_awal ?>
        <td<?= $Page->tgl_awal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_tgl_awal" class="el_proyek_tgl_awal">
<span<?= $Page->tgl_awal->viewAttributes() ?>>
<?= $Page->tgl_awal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_akhir->Visible) { // tgl_akhir ?>
        <td<?= $Page->tgl_akhir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_tgl_akhir" class="el_proyek_tgl_akhir">
<span<?= $Page->tgl_akhir->viewAttributes() ?>>
<?= $Page->tgl_akhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->file_proyek->Visible) { // file_proyek ?>
        <td<?= $Page->file_proyek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_file_proyek" class="el_proyek_file_proyek">
<span<?= $Page->file_proyek->viewAttributes() ?>>
<?= GetFileViewTag($Page->file_proyek, $Page->file_proyek->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
        <td<?= $Page->aktif->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_aktif" class="el_proyek_aktif">
<span<?= $Page->aktif->viewAttributes() ?>>
<?= $Page->aktif->getViewValue() ?></span>
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
