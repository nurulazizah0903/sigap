<?php

namespace PHPMaker2022\sigap;

// Page object
$LemburView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { lembur: currentTable } });
var currentForm, currentPageID;
var flemburview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    flemburview = new ew.Form("flemburview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = flemburview;
    loadjs.done("flemburview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="flemburview" id="flemburview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="lembur">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lembur_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_lembur_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <tr id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lembur_pegawai"><?= $Page->pegawai->caption() ?></span></td>
        <td data-name="pegawai"<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_lembur_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->proyek->Visible) { // proyek ?>
    <tr id="r_proyek"<?= $Page->proyek->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lembur_proyek"><?= $Page->proyek->caption() ?></span></td>
        <td data-name="proyek"<?= $Page->proyek->cellAttributes() ?>>
<span id="el_lembur_proyek">
<span<?= $Page->proyek->viewAttributes() ?>>
<?= $Page->proyek->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pm->Visible) { // pm ?>
    <tr id="r_pm"<?= $Page->pm->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lembur_pm"><?= $Page->pm->caption() ?></span></td>
        <td data-name="pm"<?= $Page->pm->cellAttributes() ?>>
<span id="el_lembur_pm">
<span<?= $Page->pm->viewAttributes() ?>>
<?= $Page->pm->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl->Visible) { // tgl ?>
    <tr id="r_tgl"<?= $Page->tgl->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lembur_tgl"><?= $Page->tgl->caption() ?></span></td>
        <td data-name="tgl"<?= $Page->tgl->cellAttributes() ?>>
<span id="el_lembur_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_awal_lembur->Visible) { // tgl_awal_lembur ?>
    <tr id="r_tgl_awal_lembur"<?= $Page->tgl_awal_lembur->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lembur_tgl_awal_lembur"><?= $Page->tgl_awal_lembur->caption() ?></span></td>
        <td data-name="tgl_awal_lembur"<?= $Page->tgl_awal_lembur->cellAttributes() ?>>
<span id="el_lembur_tgl_awal_lembur">
<span<?= $Page->tgl_awal_lembur->viewAttributes() ?>>
<?= $Page->tgl_awal_lembur->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_akhir_lembur->Visible) { // tgl_akhir_lembur ?>
    <tr id="r_tgl_akhir_lembur"<?= $Page->tgl_akhir_lembur->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lembur_tgl_akhir_lembur"><?= $Page->tgl_akhir_lembur->caption() ?></span></td>
        <td data-name="tgl_akhir_lembur"<?= $Page->tgl_akhir_lembur->cellAttributes() ?>>
<span id="el_lembur_tgl_akhir_lembur">
<span<?= $Page->tgl_akhir_lembur->viewAttributes() ?>>
<?= $Page->tgl_akhir_lembur->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->total_jam->Visible) { // total_jam ?>
    <tr id="r_total_jam"<?= $Page->total_jam->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lembur_total_jam"><?= $Page->total_jam->caption() ?></span></td>
        <td data-name="total_jam"<?= $Page->total_jam->cellAttributes() ?>>
<span id="el_lembur_total_jam">
<span<?= $Page->total_jam->viewAttributes() ?>>
<?= $Page->total_jam->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <tr id="r_jenis"<?= $Page->jenis->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lembur_jenis"><?= $Page->jenis->caption() ?></span></td>
        <td data-name="jenis"<?= $Page->jenis->cellAttributes() ?>>
<span id="el_lembur_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <tr id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lembur_keterangan"><?= $Page->keterangan->caption() ?></span></td>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_lembur_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
    <tr id="r_disetujui"<?= $Page->disetujui->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lembur_disetujui"><?= $Page->disetujui->caption() ?></span></td>
        <td data-name="disetujui"<?= $Page->disetujui->cellAttributes() ?>>
<span id="el_lembur_disetujui">
<span<?= $Page->disetujui->viewAttributes() ?>>
<?= $Page->disetujui->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
    <tr id="r_dokumen"<?= $Page->dokumen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_lembur_dokumen"><?= $Page->dokumen->caption() ?></span></td>
        <td data-name="dokumen"<?= $Page->dokumen->cellAttributes() ?>>
<span id="el_lembur_dokumen">
<span<?= $Page->dokumen->viewAttributes() ?>>
<?= GetFileViewTag($Page->dokumen, $Page->dokumen->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
