<?php

namespace PHPMaker2022\sigap;

// Page object
$PengetahuanDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pengetahuan: currentTable } });
var currentForm, currentPageID;
var fpengetahuandelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpengetahuandelete = new ew.Form("fpengetahuandelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fpengetahuandelete;
    loadjs.done("fpengetahuandelete");
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
<form name="fpengetahuandelete" id="fpengetahuandelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pengetahuan">
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
<?php if ($Page->grup->Visible) { // grup ?>
        <th class="<?= $Page->grup->headerCellClass() ?>"><span id="elh_pengetahuan_grup" class="pengetahuan_grup"><?= $Page->grup->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sumber_url->Visible) { // sumber_url ?>
        <th class="<?= $Page->sumber_url->headerCellClass() ?>"><span id="elh_pengetahuan_sumber_url" class="pengetahuan_sumber_url"><?= $Page->sumber_url->caption() ?></span></th>
<?php } ?>
<?php if ($Page->visual->Visible) { // visual ?>
        <th class="<?= $Page->visual->headerCellClass() ?>"><span id="elh_pengetahuan_visual" class="pengetahuan_visual"><?= $Page->visual->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
        <th class="<?= $Page->dokumen->headerCellClass() ?>"><span id="elh_pengetahuan_dokumen" class="pengetahuan_dokumen"><?= $Page->dokumen->caption() ?></span></th>
<?php } ?>
<?php if ($Page->c_by->Visible) { // c_by ?>
        <th class="<?= $Page->c_by->headerCellClass() ?>"><span id="elh_pengetahuan_c_by" class="pengetahuan_c_by"><?= $Page->c_by->caption() ?></span></th>
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
<?php if ($Page->grup->Visible) { // grup ?>
        <td<?= $Page->grup->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pengetahuan_grup" class="el_pengetahuan_grup">
<span<?= $Page->grup->viewAttributes() ?>>
<?= $Page->grup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sumber_url->Visible) { // sumber_url ?>
        <td<?= $Page->sumber_url->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pengetahuan_sumber_url" class="el_pengetahuan_sumber_url">
<span<?= $Page->sumber_url->viewAttributes() ?>>
<?= $Page->sumber_url->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->visual->Visible) { // visual ?>
        <td<?= $Page->visual->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pengetahuan_visual" class="el_pengetahuan_visual">
<span<?= $Page->visual->viewAttributes() ?>>
<?= $Page->visual->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
        <td<?= $Page->dokumen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pengetahuan_dokumen" class="el_pengetahuan_dokumen">
<span<?= $Page->dokumen->viewAttributes() ?>>
<?= GetFileViewTag($Page->dokumen, $Page->dokumen->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->c_by->Visible) { // c_by ?>
        <td<?= $Page->c_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pengetahuan_c_by" class="el_pengetahuan_c_by">
<span<?= $Page->c_by->viewAttributes() ?>>
<?= $Page->c_by->getViewValue() ?></span>
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
