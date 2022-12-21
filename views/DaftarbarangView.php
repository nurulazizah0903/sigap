<?php

namespace PHPMaker2022\sigap;

// Page object
$DaftarbarangView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { daftarbarang: currentTable } });
var currentForm, currentPageID;
var fdaftarbarangview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdaftarbarangview = new ew.Form("fdaftarbarangview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fdaftarbarangview;
    loadjs.done("fdaftarbarangview");
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
<form name="fdaftarbarangview" id="fdaftarbarangview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="daftarbarang">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_daftarbarang_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_daftarbarang_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <tr id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_daftarbarang_nama"><?= $Page->nama->caption() ?></span></td>
        <td data-name="nama"<?= $Page->nama->cellAttributes() ?>>
<span id="el_daftarbarang_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <tr id="r_jenis"<?= $Page->jenis->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_daftarbarang_jenis"><?= $Page->jenis->caption() ?></span></td>
        <td data-name="jenis"<?= $Page->jenis->cellAttributes() ?>>
<span id="el_daftarbarang_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sepsifikasi->Visible) { // sepsifikasi ?>
    <tr id="r_sepsifikasi"<?= $Page->sepsifikasi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_daftarbarang_sepsifikasi"><?= $Page->sepsifikasi->caption() ?></span></td>
        <td data-name="sepsifikasi"<?= $Page->sepsifikasi->cellAttributes() ?>>
<span id="el_daftarbarang_sepsifikasi">
<span<?= $Page->sepsifikasi->viewAttributes() ?>>
<?= $Page->sepsifikasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <tr id="r_deskripsi"<?= $Page->deskripsi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_daftarbarang_deskripsi"><?= $Page->deskripsi->caption() ?></span></td>
        <td data-name="deskripsi"<?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_daftarbarang_deskripsi">
<span<?= $Page->deskripsi->viewAttributes() ?>>
<?= $Page->deskripsi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_terima->Visible) { // tgl_terima ?>
    <tr id="r_tgl_terima"<?= $Page->tgl_terima->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_daftarbarang_tgl_terima"><?= $Page->tgl_terima->caption() ?></span></td>
        <td data-name="tgl_terima"<?= $Page->tgl_terima->cellAttributes() ?>>
<span id="el_daftarbarang_tgl_terima">
<span<?= $Page->tgl_terima->viewAttributes() ?>>
<?= $Page->tgl_terima->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_beli->Visible) { // tgl_beli ?>
    <tr id="r_tgl_beli"<?= $Page->tgl_beli->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_daftarbarang_tgl_beli"><?= $Page->tgl_beli->caption() ?></span></td>
        <td data-name="tgl_beli"<?= $Page->tgl_beli->cellAttributes() ?>>
<span id="el_daftarbarang_tgl_beli">
<span<?= $Page->tgl_beli->viewAttributes() ?>>
<?= $Page->tgl_beli->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->harga->Visible) { // harga ?>
    <tr id="r_harga"<?= $Page->harga->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_daftarbarang_harga"><?= $Page->harga->caption() ?></span></td>
        <td data-name="harga"<?= $Page->harga->cellAttributes() ?>>
<span id="el_daftarbarang_harga">
<span<?= $Page->harga->viewAttributes() ?>>
<?= $Page->harga->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pemegang->Visible) { // pemegang ?>
    <tr id="r_pemegang"<?= $Page->pemegang->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_daftarbarang_pemegang"><?= $Page->pemegang->caption() ?></span></td>
        <td data-name="pemegang"<?= $Page->pemegang->cellAttributes() ?>>
<span id="el_daftarbarang_pemegang">
<span<?= $Page->pemegang->viewAttributes() ?>>
<?= $Page->pemegang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <tr id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_daftarbarang_keterangan"><?= $Page->keterangan->caption() ?></span></td>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_daftarbarang_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->foto->Visible) { // foto ?>
    <tr id="r_foto"<?= $Page->foto->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_daftarbarang_foto"><?= $Page->foto->caption() ?></span></td>
        <td data-name="foto"<?= $Page->foto->cellAttributes() ?>>
<span id="el_daftarbarang_foto">
<span<?= $Page->foto->viewAttributes() ?>>
<?= GetFileViewTag($Page->foto, $Page->foto->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
    <tr id="r_dokumen"<?= $Page->dokumen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_daftarbarang_dokumen"><?= $Page->dokumen->caption() ?></span></td>
        <td data-name="dokumen"<?= $Page->dokumen->cellAttributes() ?>>
<span id="el_daftarbarang_dokumen">
<span<?= $Page->dokumen->viewAttributes() ?>>
<?= GetFileViewTag($Page->dokumen, $Page->dokumen->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_daftarbarang_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_daftarbarang_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
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
