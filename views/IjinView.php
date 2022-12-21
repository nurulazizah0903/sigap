<?php

namespace PHPMaker2022\sigap;

// Page object
$IjinView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { ijin: currentTable } });
var currentForm, currentPageID;
var fijinview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fijinview = new ew.Form("fijinview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fijinview;
    loadjs.done("fijinview");
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
<form name="fijinview" id="fijinview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ijin">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ijin_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_ijin_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <tr id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ijin_pegawai"><?= $Page->pegawai->caption() ?></span></td>
        <td data-name="pegawai"<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_ijin_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl->Visible) { // tgl ?>
    <tr id="r_tgl"<?= $Page->tgl->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ijin_tgl"><?= $Page->tgl->caption() ?></span></td>
        <td data-name="tgl"<?= $Page->tgl->cellAttributes() ?>>
<span id="el_ijin_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_ijin_awal->Visible) { // tgl_ijin_awal ?>
    <tr id="r_tgl_ijin_awal"<?= $Page->tgl_ijin_awal->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ijin_tgl_ijin_awal"><?= $Page->tgl_ijin_awal->caption() ?></span></td>
        <td data-name="tgl_ijin_awal"<?= $Page->tgl_ijin_awal->cellAttributes() ?>>
<span id="el_ijin_tgl_ijin_awal">
<span<?= $Page->tgl_ijin_awal->viewAttributes() ?>>
<?= $Page->tgl_ijin_awal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_ijin_akhir->Visible) { // tgl_ijin_akhir ?>
    <tr id="r_tgl_ijin_akhir"<?= $Page->tgl_ijin_akhir->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ijin_tgl_ijin_akhir"><?= $Page->tgl_ijin_akhir->caption() ?></span></td>
        <td data-name="tgl_ijin_akhir"<?= $Page->tgl_ijin_akhir->cellAttributes() ?>>
<span id="el_ijin_tgl_ijin_akhir">
<span<?= $Page->tgl_ijin_akhir->viewAttributes() ?>>
<?= $Page->tgl_ijin_akhir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <tr id="r_jenis"<?= $Page->jenis->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ijin_jenis"><?= $Page->jenis->caption() ?></span></td>
        <td data-name="jenis"<?= $Page->jenis->cellAttributes() ?>>
<span id="el_ijin_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <tr id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ijin_keterangan"><?= $Page->keterangan->caption() ?></span></td>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_ijin_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
    <tr id="r_disetujui"<?= $Page->disetujui->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ijin_disetujui"><?= $Page->disetujui->caption() ?></span></td>
        <td data-name="disetujui"<?= $Page->disetujui->cellAttributes() ?>>
<span id="el_ijin_disetujui">
<span<?= $Page->disetujui->viewAttributes() ?>>
<?= $Page->disetujui->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
    <tr id="r_dokumen"<?= $Page->dokumen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_ijin_dokumen"><?= $Page->dokumen->caption() ?></span></td>
        <td data-name="dokumen"<?= $Page->dokumen->cellAttributes() ?>>
<span id="el_ijin_dokumen">
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
