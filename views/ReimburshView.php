<?php

namespace PHPMaker2022\sigap;

// Page object
$ReimburshView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { reimbursh: currentTable } });
var currentForm, currentPageID;
var freimburshview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    freimburshview = new ew.Form("freimburshview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = freimburshview;
    loadjs.done("freimburshview");
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
<form name="freimburshview" id="freimburshview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="reimbursh">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_reimbursh_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <tr id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_pegawai"><?= $Page->pegawai->caption() ?></span></td>
        <td data-name="pegawai"<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_reimbursh_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <tr id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_nama"><?= $Page->nama->caption() ?></span></td>
        <td data-name="nama"<?= $Page->nama->cellAttributes() ?>>
<span id="el_reimbursh_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl->Visible) { // tgl ?>
    <tr id="r_tgl"<?= $Page->tgl->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_tgl"><?= $Page->tgl->caption() ?></span></td>
        <td data-name="tgl"<?= $Page->tgl->cellAttributes() ?>>
<span id="el_reimbursh_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->total_pengajuan->Visible) { // total_pengajuan ?>
    <tr id="r_total_pengajuan"<?= $Page->total_pengajuan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_total_pengajuan"><?= $Page->total_pengajuan->caption() ?></span></td>
        <td data-name="total_pengajuan"<?= $Page->total_pengajuan->cellAttributes() ?>>
<span id="el_reimbursh_total_pengajuan">
<span<?= $Page->total_pengajuan->viewAttributes() ?>>
<?= $Page->total_pengajuan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_pengajuan->Visible) { // tgl_pengajuan ?>
    <tr id="r_tgl_pengajuan"<?= $Page->tgl_pengajuan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_tgl_pengajuan"><?= $Page->tgl_pengajuan->caption() ?></span></td>
        <td data-name="tgl_pengajuan"<?= $Page->tgl_pengajuan->cellAttributes() ?>>
<span id="el_reimbursh_tgl_pengajuan">
<span<?= $Page->tgl_pengajuan->viewAttributes() ?>>
<?= $Page->tgl_pengajuan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <tr id="r_jenis"<?= $Page->jenis->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_jenis"><?= $Page->jenis->caption() ?></span></td>
        <td data-name="jenis"<?= $Page->jenis->cellAttributes() ?>>
<span id="el_reimbursh_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <tr id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_keterangan"><?= $Page->keterangan->caption() ?></span></td>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_reimbursh_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rek_tujuan->Visible) { // rek_tujuan ?>
    <tr id="r_rek_tujuan"<?= $Page->rek_tujuan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_rek_tujuan"><?= $Page->rek_tujuan->caption() ?></span></td>
        <td data-name="rek_tujuan"<?= $Page->rek_tujuan->cellAttributes() ?>>
<span id="el_reimbursh_rek_tujuan">
<span<?= $Page->rek_tujuan->viewAttributes() ?>>
<?= $Page->rek_tujuan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
    <tr id="r_disetujui"<?= $Page->disetujui->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_disetujui"><?= $Page->disetujui->caption() ?></span></td>
        <td data-name="disetujui"<?= $Page->disetujui->cellAttributes() ?>>
<span id="el_reimbursh_disetujui">
<span<?= $Page->disetujui->viewAttributes() ?>>
<?= $Page->disetujui->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pembayar->Visible) { // pembayar ?>
    <tr id="r_pembayar"<?= $Page->pembayar->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_pembayar"><?= $Page->pembayar->caption() ?></span></td>
        <td data-name="pembayar"<?= $Page->pembayar->cellAttributes() ?>>
<span id="el_reimbursh_pembayar">
<span<?= $Page->pembayar->viewAttributes() ?>>
<?= $Page->pembayar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->terbayar->Visible) { // terbayar ?>
    <tr id="r_terbayar"<?= $Page->terbayar->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_terbayar"><?= $Page->terbayar->caption() ?></span></td>
        <td data-name="terbayar"<?= $Page->terbayar->cellAttributes() ?>>
<span id="el_reimbursh_terbayar">
<span<?= $Page->terbayar->viewAttributes() ?>>
<?= $Page->terbayar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_pembayaran->Visible) { // tgl_pembayaran ?>
    <tr id="r_tgl_pembayaran"<?= $Page->tgl_pembayaran->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_tgl_pembayaran"><?= $Page->tgl_pembayaran->caption() ?></span></td>
        <td data-name="tgl_pembayaran"<?= $Page->tgl_pembayaran->cellAttributes() ?>>
<span id="el_reimbursh_tgl_pembayaran">
<span<?= $Page->tgl_pembayaran->viewAttributes() ?>>
<?= $Page->tgl_pembayaran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jumlah_dibayar->Visible) { // jumlah_dibayar ?>
    <tr id="r_jumlah_dibayar"<?= $Page->jumlah_dibayar->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_jumlah_dibayar"><?= $Page->jumlah_dibayar->caption() ?></span></td>
        <td data-name="jumlah_dibayar"<?= $Page->jumlah_dibayar->cellAttributes() ?>>
<span id="el_reimbursh_jumlah_dibayar">
<span<?= $Page->jumlah_dibayar->viewAttributes() ?>>
<?= $Page->jumlah_dibayar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bukti1->Visible) { // bukti1 ?>
    <tr id="r_bukti1"<?= $Page->bukti1->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_bukti1"><?= $Page->bukti1->caption() ?></span></td>
        <td data-name="bukti1"<?= $Page->bukti1->cellAttributes() ?>>
<span id="el_reimbursh_bukti1">
<span<?= $Page->bukti1->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti1, $Page->bukti1->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bukti2->Visible) { // bukti2 ?>
    <tr id="r_bukti2"<?= $Page->bukti2->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_bukti2"><?= $Page->bukti2->caption() ?></span></td>
        <td data-name="bukti2"<?= $Page->bukti2->cellAttributes() ?>>
<span id="el_reimbursh_bukti2">
<span<?= $Page->bukti2->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti2, $Page->bukti2->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bukti3->Visible) { // bukti3 ?>
    <tr id="r_bukti3"<?= $Page->bukti3->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_bukti3"><?= $Page->bukti3->caption() ?></span></td>
        <td data-name="bukti3"<?= $Page->bukti3->cellAttributes() ?>>
<span id="el_reimbursh_bukti3">
<span<?= $Page->bukti3->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti3, $Page->bukti3->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bukti4->Visible) { // bukti4 ?>
    <tr id="r_bukti4"<?= $Page->bukti4->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_reimbursh_bukti4"><?= $Page->bukti4->caption() ?></span></td>
        <td data-name="bukti4"<?= $Page->bukti4->cellAttributes() ?>>
<span id="el_reimbursh_bukti4">
<span<?= $Page->bukti4->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti4, $Page->bukti4->getViewValue(), false) ?>
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
