<?php

namespace PHPMaker2022\sigap;

// Page object
$UangmukaView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { uangmuka: currentTable } });
var currentForm, currentPageID;
var fuangmukaview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fuangmukaview = new ew.Form("fuangmukaview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fuangmukaview;
    loadjs.done("fuangmukaview");
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
<form name="fuangmukaview" id="fuangmukaview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="uangmuka">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_uangmuka_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl->Visible) { // tgl ?>
    <tr id="r_tgl"<?= $Page->tgl->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_tgl"><?= $Page->tgl->caption() ?></span></td>
        <td data-name="tgl"<?= $Page->tgl->cellAttributes() ?>>
<span id="el_uangmuka_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pembayar->Visible) { // pembayar ?>
    <tr id="r_pembayar"<?= $Page->pembayar->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_pembayar"><?= $Page->pembayar->caption() ?></span></td>
        <td data-name="pembayar"<?= $Page->pembayar->cellAttributes() ?>>
<span id="el_uangmuka_pembayar">
<span<?= $Page->pembayar->viewAttributes() ?>>
<?= $Page->pembayar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->peruntukan->Visible) { // peruntukan ?>
    <tr id="r_peruntukan"<?= $Page->peruntukan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_peruntukan"><?= $Page->peruntukan->caption() ?></span></td>
        <td data-name="peruntukan"<?= $Page->peruntukan->cellAttributes() ?>>
<span id="el_uangmuka_peruntukan">
<span<?= $Page->peruntukan->viewAttributes() ?>>
<?= $Page->peruntukan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->penerima->Visible) { // penerima ?>
    <tr id="r_penerima"<?= $Page->penerima->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_penerima"><?= $Page->penerima->caption() ?></span></td>
        <td data-name="penerima"<?= $Page->penerima->cellAttributes() ?>>
<span id="el_uangmuka_penerima">
<span<?= $Page->penerima->viewAttributes() ?>>
<?= $Page->penerima->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rek_penerima->Visible) { // rek_penerima ?>
    <tr id="r_rek_penerima"<?= $Page->rek_penerima->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_rek_penerima"><?= $Page->rek_penerima->caption() ?></span></td>
        <td data-name="rek_penerima"<?= $Page->rek_penerima->cellAttributes() ?>>
<span id="el_uangmuka_rek_penerima">
<span<?= $Page->rek_penerima->viewAttributes() ?>>
<?= $Page->rek_penerima->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_terima->Visible) { // tgl_terima ?>
    <tr id="r_tgl_terima"<?= $Page->tgl_terima->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_tgl_terima"><?= $Page->tgl_terima->caption() ?></span></td>
        <td data-name="tgl_terima"<?= $Page->tgl_terima->cellAttributes() ?>>
<span id="el_uangmuka_tgl_terima">
<span<?= $Page->tgl_terima->viewAttributes() ?>>
<?= $Page->tgl_terima->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->total_terima->Visible) { // total_terima ?>
    <tr id="r_total_terima"<?= $Page->total_terima->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_total_terima"><?= $Page->total_terima->caption() ?></span></td>
        <td data-name="total_terima"<?= $Page->total_terima->cellAttributes() ?>>
<span id="el_uangmuka_total_terima">
<span<?= $Page->total_terima->viewAttributes() ?>>
<?= $Page->total_terima->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_tgjb->Visible) { // tgl_tgjb ?>
    <tr id="r_tgl_tgjb"<?= $Page->tgl_tgjb->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_tgl_tgjb"><?= $Page->tgl_tgjb->caption() ?></span></td>
        <td data-name="tgl_tgjb"<?= $Page->tgl_tgjb->cellAttributes() ?>>
<span id="el_uangmuka_tgl_tgjb">
<span<?= $Page->tgl_tgjb->viewAttributes() ?>>
<?= $Page->tgl_tgjb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jumlah_tgjb->Visible) { // jumlah_tgjb ?>
    <tr id="r_jumlah_tgjb"<?= $Page->jumlah_tgjb->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_jumlah_tgjb"><?= $Page->jumlah_tgjb->caption() ?></span></td>
        <td data-name="jumlah_tgjb"<?= $Page->jumlah_tgjb->cellAttributes() ?>>
<span id="el_uangmuka_jumlah_tgjb">
<span<?= $Page->jumlah_tgjb->viewAttributes() ?>>
<?= $Page->jumlah_tgjb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <tr id="r_jenis"<?= $Page->jenis->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_jenis"><?= $Page->jenis->caption() ?></span></td>
        <td data-name="jenis"<?= $Page->jenis->cellAttributes() ?>>
<span id="el_uangmuka_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <tr id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_keterangan"><?= $Page->keterangan->caption() ?></span></td>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_uangmuka_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bukti1->Visible) { // bukti1 ?>
    <tr id="r_bukti1"<?= $Page->bukti1->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_bukti1"><?= $Page->bukti1->caption() ?></span></td>
        <td data-name="bukti1"<?= $Page->bukti1->cellAttributes() ?>>
<span id="el_uangmuka_bukti1">
<span<?= $Page->bukti1->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti1, $Page->bukti1->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bukti2->Visible) { // bukti2 ?>
    <tr id="r_bukti2"<?= $Page->bukti2->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_bukti2"><?= $Page->bukti2->caption() ?></span></td>
        <td data-name="bukti2"<?= $Page->bukti2->cellAttributes() ?>>
<span id="el_uangmuka_bukti2">
<span<?= $Page->bukti2->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti2, $Page->bukti2->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bukti3->Visible) { // bukti3 ?>
    <tr id="r_bukti3"<?= $Page->bukti3->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_bukti3"><?= $Page->bukti3->caption() ?></span></td>
        <td data-name="bukti3"<?= $Page->bukti3->cellAttributes() ?>>
<span id="el_uangmuka_bukti3">
<span<?= $Page->bukti3->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti3, $Page->bukti3->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bukti4->Visible) { // bukti4 ?>
    <tr id="r_bukti4"<?= $Page->bukti4->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_bukti4"><?= $Page->bukti4->caption() ?></span></td>
        <td data-name="bukti4"<?= $Page->bukti4->cellAttributes() ?>>
<span id="el_uangmuka_bukti4">
<span<?= $Page->bukti4->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti4, $Page->bukti4->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
    <tr id="r_disetujui"<?= $Page->disetujui->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_disetujui"><?= $Page->disetujui->caption() ?></span></td>
        <td data-name="disetujui"<?= $Page->disetujui->cellAttributes() ?>>
<span id="el_uangmuka_disetujui">
<span<?= $Page->disetujui->viewAttributes() ?>>
<?= $Page->disetujui->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_uangmuka_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_uangmuka_status">
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
