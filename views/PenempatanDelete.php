<?php

namespace PHPMaker2022\sigap;

// Page object
$PenempatanDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { penempatan: currentTable } });
var currentForm, currentPageID;
var fpenempatandelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpenempatandelete = new ew.Form("fpenempatandelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fpenempatandelete;
    loadjs.done("fpenempatandelete");
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
<form name="fpenempatandelete" id="fpenempatandelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penempatan">
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
        <th class="<?= $Page->pegawai->headerCellClass() ?>"><span id="elh_penempatan_pegawai" class="penempatan_pegawai"><?= $Page->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->project->Visible) { // project ?>
        <th class="<?= $Page->project->headerCellClass() ?>"><span id="elh_penempatan_project" class="penempatan_project"><?= $Page->project->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
        <th class="<?= $Page->jabatan->headerCellClass() ?>"><span id="elh_penempatan_jabatan" class="penempatan_jabatan"><?= $Page->jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_mulai->Visible) { // tgl_mulai ?>
        <th class="<?= $Page->tgl_mulai->headerCellClass() ?>"><span id="elh_penempatan_tgl_mulai" class="penempatan_tgl_mulai"><?= $Page->tgl_mulai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_akhir->Visible) { // tgl_akhir ?>
        <th class="<?= $Page->tgl_akhir->headerCellClass() ?>"><span id="elh_penempatan_tgl_akhir" class="penempatan_tgl_akhir"><?= $Page->tgl_akhir->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_penempatan_pegawai" class="el_penempatan_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->project->Visible) { // project ?>
        <td<?= $Page->project->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penempatan_project" class="el_penempatan_project">
<span<?= $Page->project->viewAttributes() ?>>
<?= $Page->project->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
        <td<?= $Page->jabatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penempatan_jabatan" class="el_penempatan_jabatan">
<span<?= $Page->jabatan->viewAttributes() ?>>
<?= $Page->jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_mulai->Visible) { // tgl_mulai ?>
        <td<?= $Page->tgl_mulai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penempatan_tgl_mulai" class="el_penempatan_tgl_mulai">
<span<?= $Page->tgl_mulai->viewAttributes() ?>>
<?= $Page->tgl_mulai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_akhir->Visible) { // tgl_akhir ?>
        <td<?= $Page->tgl_akhir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_penempatan_tgl_akhir" class="el_penempatan_tgl_akhir">
<span<?= $Page->tgl_akhir->viewAttributes() ?>>
<?= $Page->tgl_akhir->getViewValue() ?></span>
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
