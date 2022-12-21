<?php

namespace PHPMaker2022\sigap;

// Page object
$JabatanDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jabatan: currentTable } });
var currentForm, currentPageID;
var fjabatandelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjabatandelete = new ew.Form("fjabatandelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fjabatandelete;
    loadjs.done("fjabatandelete");
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
<form name="fjabatandelete" id="fjabatandelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jabatan">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_jabatan_id" class="jabatan_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenjang->Visible) { // jenjang ?>
        <th class="<?= $Page->jenjang->headerCellClass() ?>"><span id="elh_jabatan_jenjang" class="jabatan_jenjang"><?= $Page->jenjang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_jabatan->Visible) { // nama_jabatan ?>
        <th class="<?= $Page->nama_jabatan->headerCellClass() ?>"><span id="elh_jabatan_nama_jabatan" class="jabatan_nama_jabatan"><?= $Page->nama_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th class="<?= $Page->keterangan->headerCellClass() ?>"><span id="elh_jabatan_keterangan" class="jabatan_keterangan"><?= $Page->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
        <th class="<?= $Page->c_date->headerCellClass() ?>"><span id="elh_jabatan_c_date" class="jabatan_c_date"><?= $Page->c_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->u_date->Visible) { // u_date ?>
        <th class="<?= $Page->u_date->headerCellClass() ?>"><span id="elh_jabatan_u_date" class="jabatan_u_date"><?= $Page->u_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->c_by->Visible) { // c_by ?>
        <th class="<?= $Page->c_by->headerCellClass() ?>"><span id="elh_jabatan_c_by" class="jabatan_c_by"><?= $Page->c_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
        <th class="<?= $Page->u_by->headerCellClass() ?>"><span id="elh_jabatan_u_by" class="jabatan_u_by"><?= $Page->u_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
        <th class="<?= $Page->aktif->headerCellClass() ?>"><span id="elh_jabatan_aktif" class="jabatan_aktif"><?= $Page->aktif->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_jabatan_id" class="el_jabatan_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenjang->Visible) { // jenjang ?>
        <td<?= $Page->jenjang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jabatan_jenjang" class="el_jabatan_jenjang">
<span<?= $Page->jenjang->viewAttributes() ?>>
<?= $Page->jenjang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_jabatan->Visible) { // nama_jabatan ?>
        <td<?= $Page->nama_jabatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jabatan_nama_jabatan" class="el_jabatan_nama_jabatan">
<span<?= $Page->nama_jabatan->viewAttributes() ?>>
<?= $Page->nama_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td<?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jabatan_keterangan" class="el_jabatan_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
        <td<?= $Page->c_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jabatan_c_date" class="el_jabatan_c_date">
<span<?= $Page->c_date->viewAttributes() ?>>
<?= $Page->c_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->u_date->Visible) { // u_date ?>
        <td<?= $Page->u_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jabatan_u_date" class="el_jabatan_u_date">
<span<?= $Page->u_date->viewAttributes() ?>>
<?= $Page->u_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->c_by->Visible) { // c_by ?>
        <td<?= $Page->c_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jabatan_c_by" class="el_jabatan_c_by">
<span<?= $Page->c_by->viewAttributes() ?>>
<?= $Page->c_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
        <td<?= $Page->u_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jabatan_u_by" class="el_jabatan_u_by">
<span<?= $Page->u_by->viewAttributes() ?>>
<?= $Page->u_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
        <td<?= $Page->aktif->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_jabatan_aktif" class="el_jabatan_aktif">
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
