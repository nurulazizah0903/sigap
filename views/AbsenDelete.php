<?php

namespace PHPMaker2022\sigap;

// Page object
$AbsenDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { absen: currentTable } });
var currentForm, currentPageID;
var fabsendelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fabsendelete = new ew.Form("fabsendelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fabsendelete;
    loadjs.done("fabsendelete");
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
<form name="fabsendelete" id="fabsendelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="absen">
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
<?php if ($Page->pemeriksa->Visible) { // pemeriksa ?>
        <th class="<?= $Page->pemeriksa->headerCellClass() ?>"><span id="elh_absen_pemeriksa" class="absen_pemeriksa"><?= $Page->pemeriksa->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bulan->Visible) { // bulan ?>
        <th class="<?= $Page->bulan->headerCellClass() ?>"><span id="elh_absen_bulan" class="absen_bulan"><?= $Page->bulan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jumlah_hari_kerja->Visible) { // jumlah_hari_kerja ?>
        <th class="<?= $Page->jumlah_hari_kerja->headerCellClass() ?>"><span id="elh_absen_jumlah_hari_kerja" class="absen_jumlah_hari_kerja"><?= $Page->jumlah_hari_kerja->caption() ?></span></th>
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
<?php if ($Page->pemeriksa->Visible) { // pemeriksa ?>
        <td<?= $Page->pemeriksa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_pemeriksa" class="el_absen_pemeriksa">
<span<?= $Page->pemeriksa->viewAttributes() ?>>
<?= $Page->pemeriksa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bulan->Visible) { // bulan ?>
        <td<?= $Page->bulan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_bulan" class="el_absen_bulan">
<span<?= $Page->bulan->viewAttributes() ?>>
<?= $Page->bulan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jumlah_hari_kerja->Visible) { // jumlah_hari_kerja ?>
        <td<?= $Page->jumlah_hari_kerja->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_jumlah_hari_kerja" class="el_absen_jumlah_hari_kerja">
<span<?= $Page->jumlah_hari_kerja->viewAttributes() ?>>
<?= $Page->jumlah_hari_kerja->getViewValue() ?></span>
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
