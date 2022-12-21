<?php

namespace PHPMaker2022\sigap;

// Page object
$ReimburshDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { reimbursh: currentTable } });
var currentForm, currentPageID;
var freimburshdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    freimburshdelete = new ew.Form("freimburshdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = freimburshdelete;
    loadjs.done("freimburshdelete");
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
<form name="freimburshdelete" id="freimburshdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="reimbursh">
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
        <th class="<?= $Page->pegawai->headerCellClass() ?>"><span id="elh_reimbursh_pegawai" class="reimbursh_pegawai"><?= $Page->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><span id="elh_reimbursh_nama" class="reimbursh_nama"><?= $Page->nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl->Visible) { // tgl ?>
        <th class="<?= $Page->tgl->headerCellClass() ?>"><span id="elh_reimbursh_tgl" class="reimbursh_tgl"><?= $Page->tgl->caption() ?></span></th>
<?php } ?>
<?php if ($Page->total_pengajuan->Visible) { // total_pengajuan ?>
        <th class="<?= $Page->total_pengajuan->headerCellClass() ?>"><span id="elh_reimbursh_total_pengajuan" class="reimbursh_total_pengajuan"><?= $Page->total_pengajuan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_pengajuan->Visible) { // tgl_pengajuan ?>
        <th class="<?= $Page->tgl_pengajuan->headerCellClass() ?>"><span id="elh_reimbursh_tgl_pengajuan" class="reimbursh_tgl_pengajuan"><?= $Page->tgl_pengajuan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <th class="<?= $Page->jenis->headerCellClass() ?>"><span id="elh_reimbursh_jenis" class="reimbursh_jenis"><?= $Page->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rek_tujuan->Visible) { // rek_tujuan ?>
        <th class="<?= $Page->rek_tujuan->headerCellClass() ?>"><span id="elh_reimbursh_rek_tujuan" class="reimbursh_rek_tujuan"><?= $Page->rek_tujuan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
        <th class="<?= $Page->disetujui->headerCellClass() ?>"><span id="elh_reimbursh_disetujui" class="reimbursh_disetujui"><?= $Page->disetujui->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pembayar->Visible) { // pembayar ?>
        <th class="<?= $Page->pembayar->headerCellClass() ?>"><span id="elh_reimbursh_pembayar" class="reimbursh_pembayar"><?= $Page->pembayar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->terbayar->Visible) { // terbayar ?>
        <th class="<?= $Page->terbayar->headerCellClass() ?>"><span id="elh_reimbursh_terbayar" class="reimbursh_terbayar"><?= $Page->terbayar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_pembayaran->Visible) { // tgl_pembayaran ?>
        <th class="<?= $Page->tgl_pembayaran->headerCellClass() ?>"><span id="elh_reimbursh_tgl_pembayaran" class="reimbursh_tgl_pembayaran"><?= $Page->tgl_pembayaran->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jumlah_dibayar->Visible) { // jumlah_dibayar ?>
        <th class="<?= $Page->jumlah_dibayar->headerCellClass() ?>"><span id="elh_reimbursh_jumlah_dibayar" class="reimbursh_jumlah_dibayar"><?= $Page->jumlah_dibayar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bukti1->Visible) { // bukti1 ?>
        <th class="<?= $Page->bukti1->headerCellClass() ?>"><span id="elh_reimbursh_bukti1" class="reimbursh_bukti1"><?= $Page->bukti1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bukti2->Visible) { // bukti2 ?>
        <th class="<?= $Page->bukti2->headerCellClass() ?>"><span id="elh_reimbursh_bukti2" class="reimbursh_bukti2"><?= $Page->bukti2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bukti3->Visible) { // bukti3 ?>
        <th class="<?= $Page->bukti3->headerCellClass() ?>"><span id="elh_reimbursh_bukti3" class="reimbursh_bukti3"><?= $Page->bukti3->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bukti4->Visible) { // bukti4 ?>
        <th class="<?= $Page->bukti4->headerCellClass() ?>"><span id="elh_reimbursh_bukti4" class="reimbursh_bukti4"><?= $Page->bukti4->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_reimbursh_pegawai" class="el_reimbursh_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <td<?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_nama" class="el_reimbursh_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl->Visible) { // tgl ?>
        <td<?= $Page->tgl->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_tgl" class="el_reimbursh_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->total_pengajuan->Visible) { // total_pengajuan ?>
        <td<?= $Page->total_pengajuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_total_pengajuan" class="el_reimbursh_total_pengajuan">
<span<?= $Page->total_pengajuan->viewAttributes() ?>>
<?= $Page->total_pengajuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_pengajuan->Visible) { // tgl_pengajuan ?>
        <td<?= $Page->tgl_pengajuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_tgl_pengajuan" class="el_reimbursh_tgl_pengajuan">
<span<?= $Page->tgl_pengajuan->viewAttributes() ?>>
<?= $Page->tgl_pengajuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <td<?= $Page->jenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_jenis" class="el_reimbursh_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rek_tujuan->Visible) { // rek_tujuan ?>
        <td<?= $Page->rek_tujuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_rek_tujuan" class="el_reimbursh_rek_tujuan">
<span<?= $Page->rek_tujuan->viewAttributes() ?>>
<?= $Page->rek_tujuan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
        <td<?= $Page->disetujui->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_disetujui" class="el_reimbursh_disetujui">
<span<?= $Page->disetujui->viewAttributes() ?>>
<?= $Page->disetujui->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pembayar->Visible) { // pembayar ?>
        <td<?= $Page->pembayar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_pembayar" class="el_reimbursh_pembayar">
<span<?= $Page->pembayar->viewAttributes() ?>>
<?= $Page->pembayar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->terbayar->Visible) { // terbayar ?>
        <td<?= $Page->terbayar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_terbayar" class="el_reimbursh_terbayar">
<span<?= $Page->terbayar->viewAttributes() ?>>
<?= $Page->terbayar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_pembayaran->Visible) { // tgl_pembayaran ?>
        <td<?= $Page->tgl_pembayaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_tgl_pembayaran" class="el_reimbursh_tgl_pembayaran">
<span<?= $Page->tgl_pembayaran->viewAttributes() ?>>
<?= $Page->tgl_pembayaran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jumlah_dibayar->Visible) { // jumlah_dibayar ?>
        <td<?= $Page->jumlah_dibayar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_jumlah_dibayar" class="el_reimbursh_jumlah_dibayar">
<span<?= $Page->jumlah_dibayar->viewAttributes() ?>>
<?= $Page->jumlah_dibayar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bukti1->Visible) { // bukti1 ?>
        <td<?= $Page->bukti1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_bukti1" class="el_reimbursh_bukti1">
<span<?= $Page->bukti1->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti1, $Page->bukti1->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->bukti2->Visible) { // bukti2 ?>
        <td<?= $Page->bukti2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_bukti2" class="el_reimbursh_bukti2">
<span<?= $Page->bukti2->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti2, $Page->bukti2->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->bukti3->Visible) { // bukti3 ?>
        <td<?= $Page->bukti3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_bukti3" class="el_reimbursh_bukti3">
<span<?= $Page->bukti3->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti3, $Page->bukti3->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->bukti4->Visible) { // bukti4 ?>
        <td<?= $Page->bukti4->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_bukti4" class="el_reimbursh_bukti4">
<span<?= $Page->bukti4->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti4, $Page->bukti4->getViewValue(), false) ?>
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
