<?php

namespace PHPMaker2022\sigap;

// Page object
$LemburDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { lembur: currentTable } });
var currentForm, currentPageID;
var flemburdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    flemburdelete = new ew.Form("flemburdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = flemburdelete;
    loadjs.done("flemburdelete");
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
<form name="flemburdelete" id="flemburdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="lembur">
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
        <th class="<?= $Page->pegawai->headerCellClass() ?>"><span id="elh_lembur_pegawai" class="lembur_pegawai"><?= $Page->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->proyek->Visible) { // proyek ?>
        <th class="<?= $Page->proyek->headerCellClass() ?>"><span id="elh_lembur_proyek" class="lembur_proyek"><?= $Page->proyek->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pm->Visible) { // pm ?>
        <th class="<?= $Page->pm->headerCellClass() ?>"><span id="elh_lembur_pm" class="lembur_pm"><?= $Page->pm->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl->Visible) { // tgl ?>
        <th class="<?= $Page->tgl->headerCellClass() ?>"><span id="elh_lembur_tgl" class="lembur_tgl"><?= $Page->tgl->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_awal_lembur->Visible) { // tgl_awal_lembur ?>
        <th class="<?= $Page->tgl_awal_lembur->headerCellClass() ?>"><span id="elh_lembur_tgl_awal_lembur" class="lembur_tgl_awal_lembur"><?= $Page->tgl_awal_lembur->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_akhir_lembur->Visible) { // tgl_akhir_lembur ?>
        <th class="<?= $Page->tgl_akhir_lembur->headerCellClass() ?>"><span id="elh_lembur_tgl_akhir_lembur" class="lembur_tgl_akhir_lembur"><?= $Page->tgl_akhir_lembur->caption() ?></span></th>
<?php } ?>
<?php if ($Page->total_jam->Visible) { // total_jam ?>
        <th class="<?= $Page->total_jam->headerCellClass() ?>"><span id="elh_lembur_total_jam" class="lembur_total_jam"><?= $Page->total_jam->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <th class="<?= $Page->jenis->headerCellClass() ?>"><span id="elh_lembur_jenis" class="lembur_jenis"><?= $Page->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th class="<?= $Page->keterangan->headerCellClass() ?>"><span id="elh_lembur_keterangan" class="lembur_keterangan"><?= $Page->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
        <th class="<?= $Page->disetujui->headerCellClass() ?>"><span id="elh_lembur_disetujui" class="lembur_disetujui"><?= $Page->disetujui->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
        <th class="<?= $Page->dokumen->headerCellClass() ?>"><span id="elh_lembur_dokumen" class="lembur_dokumen"><?= $Page->dokumen->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_lembur_pegawai" class="el_lembur_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->proyek->Visible) { // proyek ?>
        <td<?= $Page->proyek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_lembur_proyek" class="el_lembur_proyek">
<span<?= $Page->proyek->viewAttributes() ?>>
<?= $Page->proyek->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pm->Visible) { // pm ?>
        <td<?= $Page->pm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_lembur_pm" class="el_lembur_pm">
<span<?= $Page->pm->viewAttributes() ?>>
<?= $Page->pm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl->Visible) { // tgl ?>
        <td<?= $Page->tgl->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_lembur_tgl" class="el_lembur_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_awal_lembur->Visible) { // tgl_awal_lembur ?>
        <td<?= $Page->tgl_awal_lembur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_lembur_tgl_awal_lembur" class="el_lembur_tgl_awal_lembur">
<span<?= $Page->tgl_awal_lembur->viewAttributes() ?>>
<?= $Page->tgl_awal_lembur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_akhir_lembur->Visible) { // tgl_akhir_lembur ?>
        <td<?= $Page->tgl_akhir_lembur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_lembur_tgl_akhir_lembur" class="el_lembur_tgl_akhir_lembur">
<span<?= $Page->tgl_akhir_lembur->viewAttributes() ?>>
<?= $Page->tgl_akhir_lembur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->total_jam->Visible) { // total_jam ?>
        <td<?= $Page->total_jam->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_lembur_total_jam" class="el_lembur_total_jam">
<span<?= $Page->total_jam->viewAttributes() ?>>
<?= $Page->total_jam->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <td<?= $Page->jenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_lembur_jenis" class="el_lembur_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td<?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_lembur_keterangan" class="el_lembur_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
        <td<?= $Page->disetujui->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_lembur_disetujui" class="el_lembur_disetujui">
<span<?= $Page->disetujui->viewAttributes() ?>>
<?= $Page->disetujui->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
        <td<?= $Page->dokumen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_lembur_dokumen" class="el_lembur_dokumen">
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
