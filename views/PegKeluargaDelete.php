<?php

namespace PHPMaker2022\sigap;

// Page object
$PegKeluargaDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { peg_keluarga: currentTable } });
var currentForm, currentPageID;
var fpeg_keluargadelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpeg_keluargadelete = new ew.Form("fpeg_keluargadelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fpeg_keluargadelete;
    loadjs.done("fpeg_keluargadelete");
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
<form name="fpeg_keluargadelete" id="fpeg_keluargadelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="peg_keluarga">
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
<?php if ($Page->nama->Visible) { // nama ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><span id="elh_peg_keluarga_nama" class="peg_keluarga_nama"><?= $Page->nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->hp->Visible) { // hp ?>
        <th class="<?= $Page->hp->headerCellClass() ?>"><span id="elh_peg_keluarga_hp" class="peg_keluarga_hp"><?= $Page->hp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->hubungan->Visible) { // hubungan ?>
        <th class="<?= $Page->hubungan->headerCellClass() ?>"><span id="elh_peg_keluarga_hubungan" class="peg_keluarga_hubungan"><?= $Page->hubungan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_lahir->Visible) { // tgl_lahir ?>
        <th class="<?= $Page->tgl_lahir->headerCellClass() ?>"><span id="elh_peg_keluarga_tgl_lahir" class="peg_keluarga_tgl_lahir"><?= $Page->tgl_lahir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jen_kel->Visible) { // jen_kel ?>
        <th class="<?= $Page->jen_kel->headerCellClass() ?>"><span id="elh_peg_keluarga_jen_kel" class="peg_keluarga_jen_kel"><?= $Page->jen_kel->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th class="<?= $Page->keterangan->headerCellClass() ?>"><span id="elh_peg_keluarga_keterangan" class="peg_keluarga_keterangan"><?= $Page->keterangan->caption() ?></span></th>
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
<?php if ($Page->nama->Visible) { // nama ?>
        <td<?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_keluarga_nama" class="el_peg_keluarga_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->hp->Visible) { // hp ?>
        <td<?= $Page->hp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_keluarga_hp" class="el_peg_keluarga_hp">
<span<?= $Page->hp->viewAttributes() ?>>
<?= $Page->hp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->hubungan->Visible) { // hubungan ?>
        <td<?= $Page->hubungan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_keluarga_hubungan" class="el_peg_keluarga_hubungan">
<span<?= $Page->hubungan->viewAttributes() ?>>
<?= $Page->hubungan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_lahir->Visible) { // tgl_lahir ?>
        <td<?= $Page->tgl_lahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_keluarga_tgl_lahir" class="el_peg_keluarga_tgl_lahir">
<span<?= $Page->tgl_lahir->viewAttributes() ?>>
<?= $Page->tgl_lahir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jen_kel->Visible) { // jen_kel ?>
        <td<?= $Page->jen_kel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_keluarga_jen_kel" class="el_peg_keluarga_jen_kel">
<span<?= $Page->jen_kel->viewAttributes() ?>>
<?= $Page->jen_kel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td<?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_keluarga_keterangan" class="el_peg_keluarga_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
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
