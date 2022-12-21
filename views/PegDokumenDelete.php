<?php

namespace PHPMaker2022\sigap;

// Page object
$PegDokumenDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { peg_dokumen: currentTable } });
var currentForm, currentPageID;
var fpeg_dokumendelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpeg_dokumendelete = new ew.Form("fpeg_dokumendelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fpeg_dokumendelete;
    loadjs.done("fpeg_dokumendelete");
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
<form name="fpeg_dokumendelete" id="fpeg_dokumendelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="peg_dokumen">
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
<?php if ($Page->c_by->Visible) { // c_by ?>
        <th class="<?= $Page->c_by->headerCellClass() ?>"><span id="elh_peg_dokumen_c_by" class="peg_dokumen_c_by"><?= $Page->c_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama_dokumen->Visible) { // nama_dokumen ?>
        <th class="<?= $Page->nama_dokumen->headerCellClass() ?>"><span id="elh_peg_dokumen_nama_dokumen" class="peg_dokumen_nama_dokumen"><?= $Page->nama_dokumen->caption() ?></span></th>
<?php } ?>
<?php if ($Page->file_dokumen->Visible) { // file_dokumen ?>
        <th class="<?= $Page->file_dokumen->headerCellClass() ?>"><span id="elh_peg_dokumen_file_dokumen" class="peg_dokumen_file_dokumen"><?= $Page->file_dokumen->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th class="<?= $Page->keterangan->headerCellClass() ?>"><span id="elh_peg_dokumen_keterangan" class="peg_dokumen_keterangan"><?= $Page->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
        <th class="<?= $Page->c_date->headerCellClass() ?>"><span id="elh_peg_dokumen_c_date" class="peg_dokumen_c_date"><?= $Page->c_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->u_date->Visible) { // u_date ?>
        <th class="<?= $Page->u_date->headerCellClass() ?>"><span id="elh_peg_dokumen_u_date" class="peg_dokumen_u_date"><?= $Page->u_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
        <th class="<?= $Page->u_by->headerCellClass() ?>"><span id="elh_peg_dokumen_u_by" class="peg_dokumen_u_by"><?= $Page->u_by->caption() ?></span></th>
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
<?php if ($Page->c_by->Visible) { // c_by ?>
        <td<?= $Page->c_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_dokumen_c_by" class="el_peg_dokumen_c_by">
<span<?= $Page->c_by->viewAttributes() ?>>
<?= $Page->c_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama_dokumen->Visible) { // nama_dokumen ?>
        <td<?= $Page->nama_dokumen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_dokumen_nama_dokumen" class="el_peg_dokumen_nama_dokumen">
<span<?= $Page->nama_dokumen->viewAttributes() ?>>
<?= $Page->nama_dokumen->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->file_dokumen->Visible) { // file_dokumen ?>
        <td<?= $Page->file_dokumen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_dokumen_file_dokumen" class="el_peg_dokumen_file_dokumen">
<span<?= $Page->file_dokumen->viewAttributes() ?>>
<?= GetFileViewTag($Page->file_dokumen, $Page->file_dokumen->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td<?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_dokumen_keterangan" class="el_peg_dokumen_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
        <td<?= $Page->c_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_dokumen_c_date" class="el_peg_dokumen_c_date">
<span<?= $Page->c_date->viewAttributes() ?>>
<?= $Page->c_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->u_date->Visible) { // u_date ?>
        <td<?= $Page->u_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_dokumen_u_date" class="el_peg_dokumen_u_date">
<span<?= $Page->u_date->viewAttributes() ?>>
<?= $Page->u_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
        <td<?= $Page->u_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_dokumen_u_by" class="el_peg_dokumen_u_by">
<span<?= $Page->u_by->viewAttributes() ?>>
<?= $Page->u_by->getViewValue() ?></span>
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
