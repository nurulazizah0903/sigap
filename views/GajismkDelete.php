<?php

namespace PHPMaker2022\sigap;

// Page object
$GajismkDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gajismk: currentTable } });
var currentForm, currentPageID;
var fgajismkdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajismkdelete = new ew.Form("fgajismkdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fgajismkdelete;
    loadjs.done("fgajismkdelete");
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
<form name="fgajismkdelete" id="fgajismkdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gajismk">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_gajismk_id" class="gajismk_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tahun->Visible) { // tahun ?>
        <th class="<?= $Page->tahun->headerCellClass() ?>"><span id="elh_gajismk_tahun" class="gajismk_tahun"><?= $Page->tahun->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bulan->Visible) { // bulan ?>
        <th class="<?= $Page->bulan->headerCellClass() ?>"><span id="elh_gajismk_bulan" class="gajismk_bulan"><?= $Page->bulan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tingkat->Visible) { // tingkat ?>
        <th class="<?= $Page->tingkat->headerCellClass() ?>"><span id="elh_gajismk_tingkat" class="gajismk_tingkat"><?= $Page->tingkat->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_gajismk_id" class="el_gajismk_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tahun->Visible) { // tahun ?>
        <td<?= $Page->tahun->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajismk_tahun" class="el_gajismk_tahun">
<span<?= $Page->tahun->viewAttributes() ?>>
<?= $Page->tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bulan->Visible) { // bulan ?>
        <td<?= $Page->bulan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajismk_bulan" class="el_gajismk_bulan">
<span<?= $Page->bulan->viewAttributes() ?>>
<?= $Page->bulan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tingkat->Visible) { // tingkat ?>
        <td<?= $Page->tingkat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajismk_tingkat" class="el_gajismk_tingkat">
<span<?= $Page->tingkat->viewAttributes() ?>>
<?= $Page->tingkat->getViewValue() ?></span>
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
