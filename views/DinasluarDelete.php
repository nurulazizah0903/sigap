<?php

namespace PHPMaker2022\sigap;

// Page object
$DinasluarDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { dinasluar: currentTable } });
var currentForm, currentPageID;
var fdinasluardelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdinasluardelete = new ew.Form("fdinasluardelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fdinasluardelete;
    loadjs.done("fdinasluardelete");
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
<form name="fdinasluardelete" id="fdinasluardelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="dinasluar">
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
        <th class="<?= $Page->pegawai->headerCellClass() ?>"><span id="elh_dinasluar_pegawai" class="dinasluar_pegawai"><?= $Page->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pm->Visible) { // pm ?>
        <th class="<?= $Page->pm->headerCellClass() ?>"><span id="elh_dinasluar_pm" class="dinasluar_pm"><?= $Page->pm->caption() ?></span></th>
<?php } ?>
<?php if ($Page->proyek->Visible) { // proyek ?>
        <th class="<?= $Page->proyek->headerCellClass() ?>"><span id="elh_dinasluar_proyek" class="dinasluar_proyek"><?= $Page->proyek->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl->Visible) { // tgl ?>
        <th class="<?= $Page->tgl->headerCellClass() ?>"><span id="elh_dinasluar_tgl" class="dinasluar_tgl"><?= $Page->tgl->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_dl_awal->Visible) { // tgl_dl_awal ?>
        <th class="<?= $Page->tgl_dl_awal->headerCellClass() ?>"><span id="elh_dinasluar_tgl_dl_awal" class="dinasluar_tgl_dl_awal"><?= $Page->tgl_dl_awal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_dl_akhir->Visible) { // tgl_dl_akhir ?>
        <th class="<?= $Page->tgl_dl_akhir->headerCellClass() ?>"><span id="elh_dinasluar_tgl_dl_akhir" class="dinasluar_tgl_dl_akhir"><?= $Page->tgl_dl_akhir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <th class="<?= $Page->jenis->headerCellClass() ?>"><span id="elh_dinasluar_jenis" class="dinasluar_jenis"><?= $Page->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th class="<?= $Page->keterangan->headerCellClass() ?>"><span id="elh_dinasluar_keterangan" class="dinasluar_keterangan"><?= $Page->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
        <th class="<?= $Page->disetujui->headerCellClass() ?>"><span id="elh_dinasluar_disetujui" class="dinasluar_disetujui"><?= $Page->disetujui->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
        <th class="<?= $Page->dokumen->headerCellClass() ?>"><span id="elh_dinasluar_dokumen" class="dinasluar_dokumen"><?= $Page->dokumen->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_dinasluar_pegawai" class="el_dinasluar_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pm->Visible) { // pm ?>
        <td<?= $Page->pm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_dinasluar_pm" class="el_dinasluar_pm">
<span<?= $Page->pm->viewAttributes() ?>>
<?= $Page->pm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->proyek->Visible) { // proyek ?>
        <td<?= $Page->proyek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_dinasluar_proyek" class="el_dinasluar_proyek">
<span<?= $Page->proyek->viewAttributes() ?>>
<?= $Page->proyek->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl->Visible) { // tgl ?>
        <td<?= $Page->tgl->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_dinasluar_tgl" class="el_dinasluar_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_dl_awal->Visible) { // tgl_dl_awal ?>
        <td<?= $Page->tgl_dl_awal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_dinasluar_tgl_dl_awal" class="el_dinasluar_tgl_dl_awal">
<span<?= $Page->tgl_dl_awal->viewAttributes() ?>>
<?= $Page->tgl_dl_awal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_dl_akhir->Visible) { // tgl_dl_akhir ?>
        <td<?= $Page->tgl_dl_akhir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_dinasluar_tgl_dl_akhir" class="el_dinasluar_tgl_dl_akhir">
<span<?= $Page->tgl_dl_akhir->viewAttributes() ?>>
<?= $Page->tgl_dl_akhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <td<?= $Page->jenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_dinasluar_jenis" class="el_dinasluar_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td<?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_dinasluar_keterangan" class="el_dinasluar_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
        <td<?= $Page->disetujui->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_dinasluar_disetujui" class="el_dinasluar_disetujui">
<span<?= $Page->disetujui->viewAttributes() ?>>
<?= $Page->disetujui->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
        <td<?= $Page->dokumen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_dinasluar_dokumen" class="el_dinasluar_dokumen">
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
