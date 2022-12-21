<?php

namespace PHPMaker2022\sigap;

// Page object
$DaftarbarangDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { daftarbarang: currentTable } });
var currentForm, currentPageID;
var fdaftarbarangdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdaftarbarangdelete = new ew.Form("fdaftarbarangdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fdaftarbarangdelete;
    loadjs.done("fdaftarbarangdelete");
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
<form name="fdaftarbarangdelete" id="fdaftarbarangdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="daftarbarang">
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
        <th class="<?= $Page->nama->headerCellClass() ?>"><span id="elh_daftarbarang_nama" class="daftarbarang_nama"><?= $Page->nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <th class="<?= $Page->jenis->headerCellClass() ?>"><span id="elh_daftarbarang_jenis" class="daftarbarang_jenis"><?= $Page->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sepsifikasi->Visible) { // sepsifikasi ?>
        <th class="<?= $Page->sepsifikasi->headerCellClass() ?>"><span id="elh_daftarbarang_sepsifikasi" class="daftarbarang_sepsifikasi"><?= $Page->sepsifikasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
        <th class="<?= $Page->deskripsi->headerCellClass() ?>"><span id="elh_daftarbarang_deskripsi" class="daftarbarang_deskripsi"><?= $Page->deskripsi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_terima->Visible) { // tgl_terima ?>
        <th class="<?= $Page->tgl_terima->headerCellClass() ?>"><span id="elh_daftarbarang_tgl_terima" class="daftarbarang_tgl_terima"><?= $Page->tgl_terima->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_beli->Visible) { // tgl_beli ?>
        <th class="<?= $Page->tgl_beli->headerCellClass() ?>"><span id="elh_daftarbarang_tgl_beli" class="daftarbarang_tgl_beli"><?= $Page->tgl_beli->caption() ?></span></th>
<?php } ?>
<?php if ($Page->harga->Visible) { // harga ?>
        <th class="<?= $Page->harga->headerCellClass() ?>"><span id="elh_daftarbarang_harga" class="daftarbarang_harga"><?= $Page->harga->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pemegang->Visible) { // pemegang ?>
        <th class="<?= $Page->pemegang->headerCellClass() ?>"><span id="elh_daftarbarang_pemegang" class="daftarbarang_pemegang"><?= $Page->pemegang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th class="<?= $Page->keterangan->headerCellClass() ?>"><span id="elh_daftarbarang_keterangan" class="daftarbarang_keterangan"><?= $Page->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->foto->Visible) { // foto ?>
        <th class="<?= $Page->foto->headerCellClass() ?>"><span id="elh_daftarbarang_foto" class="daftarbarang_foto"><?= $Page->foto->caption() ?></span></th>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
        <th class="<?= $Page->dokumen->headerCellClass() ?>"><span id="elh_daftarbarang_dokumen" class="daftarbarang_dokumen"><?= $Page->dokumen->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_daftarbarang_status" class="daftarbarang_status"><?= $Page->status->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_daftarbarang_nama" class="el_daftarbarang_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <td<?= $Page->jenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_jenis" class="el_daftarbarang_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sepsifikasi->Visible) { // sepsifikasi ?>
        <td<?= $Page->sepsifikasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_sepsifikasi" class="el_daftarbarang_sepsifikasi">
<span<?= $Page->sepsifikasi->viewAttributes() ?>>
<?= $Page->sepsifikasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
        <td<?= $Page->deskripsi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_deskripsi" class="el_daftarbarang_deskripsi">
<span<?= $Page->deskripsi->viewAttributes() ?>>
<?= $Page->deskripsi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_terima->Visible) { // tgl_terima ?>
        <td<?= $Page->tgl_terima->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_tgl_terima" class="el_daftarbarang_tgl_terima">
<span<?= $Page->tgl_terima->viewAttributes() ?>>
<?= $Page->tgl_terima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_beli->Visible) { // tgl_beli ?>
        <td<?= $Page->tgl_beli->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_tgl_beli" class="el_daftarbarang_tgl_beli">
<span<?= $Page->tgl_beli->viewAttributes() ?>>
<?= $Page->tgl_beli->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->harga->Visible) { // harga ?>
        <td<?= $Page->harga->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_harga" class="el_daftarbarang_harga">
<span<?= $Page->harga->viewAttributes() ?>>
<?= $Page->harga->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pemegang->Visible) { // pemegang ?>
        <td<?= $Page->pemegang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_pemegang" class="el_daftarbarang_pemegang">
<span<?= $Page->pemegang->viewAttributes() ?>>
<?= $Page->pemegang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td<?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_keterangan" class="el_daftarbarang_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->foto->Visible) { // foto ?>
        <td<?= $Page->foto->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_foto" class="el_daftarbarang_foto">
<span<?= $Page->foto->viewAttributes() ?>>
<?= GetFileViewTag($Page->foto, $Page->foto->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
        <td<?= $Page->dokumen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_dokumen" class="el_daftarbarang_dokumen">
<span<?= $Page->dokumen->viewAttributes() ?>>
<?= GetFileViewTag($Page->dokumen, $Page->dokumen->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_status" class="el_daftarbarang_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
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
