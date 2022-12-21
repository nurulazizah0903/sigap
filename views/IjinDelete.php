<?php

namespace PHPMaker2022\sigap;

// Page object
$IjinDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { ijin: currentTable } });
var currentForm, currentPageID;
var fijindelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fijindelete = new ew.Form("fijindelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fijindelete;
    loadjs.done("fijindelete");
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
<form name="fijindelete" id="fijindelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ijin">
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
        <th class="<?= $Page->pegawai->headerCellClass() ?>"><span id="elh_ijin_pegawai" class="ijin_pegawai"><?= $Page->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl->Visible) { // tgl ?>
        <th class="<?= $Page->tgl->headerCellClass() ?>"><span id="elh_ijin_tgl" class="ijin_tgl"><?= $Page->tgl->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_ijin_awal->Visible) { // tgl_ijin_awal ?>
        <th class="<?= $Page->tgl_ijin_awal->headerCellClass() ?>"><span id="elh_ijin_tgl_ijin_awal" class="ijin_tgl_ijin_awal"><?= $Page->tgl_ijin_awal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_ijin_akhir->Visible) { // tgl_ijin_akhir ?>
        <th class="<?= $Page->tgl_ijin_akhir->headerCellClass() ?>"><span id="elh_ijin_tgl_ijin_akhir" class="ijin_tgl_ijin_akhir"><?= $Page->tgl_ijin_akhir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <th class="<?= $Page->jenis->headerCellClass() ?>"><span id="elh_ijin_jenis" class="ijin_jenis"><?= $Page->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th class="<?= $Page->keterangan->headerCellClass() ?>"><span id="elh_ijin_keterangan" class="ijin_keterangan"><?= $Page->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
        <th class="<?= $Page->disetujui->headerCellClass() ?>"><span id="elh_ijin_disetujui" class="ijin_disetujui"><?= $Page->disetujui->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
        <th class="<?= $Page->dokumen->headerCellClass() ?>"><span id="elh_ijin_dokumen" class="ijin_dokumen"><?= $Page->dokumen->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_ijin_pegawai" class="el_ijin_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl->Visible) { // tgl ?>
        <td<?= $Page->tgl->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ijin_tgl" class="el_ijin_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_ijin_awal->Visible) { // tgl_ijin_awal ?>
        <td<?= $Page->tgl_ijin_awal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ijin_tgl_ijin_awal" class="el_ijin_tgl_ijin_awal">
<span<?= $Page->tgl_ijin_awal->viewAttributes() ?>>
<?= $Page->tgl_ijin_awal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_ijin_akhir->Visible) { // tgl_ijin_akhir ?>
        <td<?= $Page->tgl_ijin_akhir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ijin_tgl_ijin_akhir" class="el_ijin_tgl_ijin_akhir">
<span<?= $Page->tgl_ijin_akhir->viewAttributes() ?>>
<?= $Page->tgl_ijin_akhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <td<?= $Page->jenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ijin_jenis" class="el_ijin_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td<?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ijin_keterangan" class="el_ijin_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
        <td<?= $Page->disetujui->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ijin_disetujui" class="el_ijin_disetujui">
<span<?= $Page->disetujui->viewAttributes() ?>>
<?= $Page->disetujui->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
        <td<?= $Page->dokumen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_ijin_dokumen" class="el_ijin_dokumen">
<span<?= $Page->dokumen->viewAttributes() ?>>
<?= GetFileViewTag($Page->dokumen, $Page->dokumen->getViewValue(), false) ?>
</span>
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
