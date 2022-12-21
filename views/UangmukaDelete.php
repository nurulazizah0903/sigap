<?php

namespace PHPMaker2022\sigap;

// Page object
$UangmukaDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { uangmuka: currentTable } });
var currentForm, currentPageID;
var fuangmukadelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fuangmukadelete = new ew.Form("fuangmukadelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fuangmukadelete;
    loadjs.done("fuangmukadelete");
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
<form name="fuangmukadelete" id="fuangmukadelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="uangmuka">
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
<?php if ($Page->tgl->Visible) { // tgl ?>
        <th class="<?= $Page->tgl->headerCellClass() ?>"><span id="elh_uangmuka_tgl" class="uangmuka_tgl"><?= $Page->tgl->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pembayar->Visible) { // pembayar ?>
        <th class="<?= $Page->pembayar->headerCellClass() ?>"><span id="elh_uangmuka_pembayar" class="uangmuka_pembayar"><?= $Page->pembayar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->peruntukan->Visible) { // peruntukan ?>
        <th class="<?= $Page->peruntukan->headerCellClass() ?>"><span id="elh_uangmuka_peruntukan" class="uangmuka_peruntukan"><?= $Page->peruntukan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->penerima->Visible) { // penerima ?>
        <th class="<?= $Page->penerima->headerCellClass() ?>"><span id="elh_uangmuka_penerima" class="uangmuka_penerima"><?= $Page->penerima->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rek_penerima->Visible) { // rek_penerima ?>
        <th class="<?= $Page->rek_penerima->headerCellClass() ?>"><span id="elh_uangmuka_rek_penerima" class="uangmuka_rek_penerima"><?= $Page->rek_penerima->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_terima->Visible) { // tgl_terima ?>
        <th class="<?= $Page->tgl_terima->headerCellClass() ?>"><span id="elh_uangmuka_tgl_terima" class="uangmuka_tgl_terima"><?= $Page->tgl_terima->caption() ?></span></th>
<?php } ?>
<?php if ($Page->total_terima->Visible) { // total_terima ?>
        <th class="<?= $Page->total_terima->headerCellClass() ?>"><span id="elh_uangmuka_total_terima" class="uangmuka_total_terima"><?= $Page->total_terima->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgl_tgjb->Visible) { // tgl_tgjb ?>
        <th class="<?= $Page->tgl_tgjb->headerCellClass() ?>"><span id="elh_uangmuka_tgl_tgjb" class="uangmuka_tgl_tgjb"><?= $Page->tgl_tgjb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jumlah_tgjb->Visible) { // jumlah_tgjb ?>
        <th class="<?= $Page->jumlah_tgjb->headerCellClass() ?>"><span id="elh_uangmuka_jumlah_tgjb" class="uangmuka_jumlah_tgjb"><?= $Page->jumlah_tgjb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <th class="<?= $Page->jenis->headerCellClass() ?>"><span id="elh_uangmuka_jenis" class="uangmuka_jenis"><?= $Page->jenis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bukti1->Visible) { // bukti1 ?>
        <th class="<?= $Page->bukti1->headerCellClass() ?>"><span id="elh_uangmuka_bukti1" class="uangmuka_bukti1"><?= $Page->bukti1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bukti2->Visible) { // bukti2 ?>
        <th class="<?= $Page->bukti2->headerCellClass() ?>"><span id="elh_uangmuka_bukti2" class="uangmuka_bukti2"><?= $Page->bukti2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bukti3->Visible) { // bukti3 ?>
        <th class="<?= $Page->bukti3->headerCellClass() ?>"><span id="elh_uangmuka_bukti3" class="uangmuka_bukti3"><?= $Page->bukti3->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bukti4->Visible) { // bukti4 ?>
        <th class="<?= $Page->bukti4->headerCellClass() ?>"><span id="elh_uangmuka_bukti4" class="uangmuka_bukti4"><?= $Page->bukti4->caption() ?></span></th>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
        <th class="<?= $Page->disetujui->headerCellClass() ?>"><span id="elh_uangmuka_disetujui" class="uangmuka_disetujui"><?= $Page->disetujui->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_uangmuka_status" class="uangmuka_status"><?= $Page->status->caption() ?></span></th>
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
<?php if ($Page->tgl->Visible) { // tgl ?>
        <td<?= $Page->tgl->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_tgl" class="el_uangmuka_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pembayar->Visible) { // pembayar ?>
        <td<?= $Page->pembayar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_pembayar" class="el_uangmuka_pembayar">
<span<?= $Page->pembayar->viewAttributes() ?>>
<?= $Page->pembayar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->peruntukan->Visible) { // peruntukan ?>
        <td<?= $Page->peruntukan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_peruntukan" class="el_uangmuka_peruntukan">
<span<?= $Page->peruntukan->viewAttributes() ?>>
<?= $Page->peruntukan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->penerima->Visible) { // penerima ?>
        <td<?= $Page->penerima->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_penerima" class="el_uangmuka_penerima">
<span<?= $Page->penerima->viewAttributes() ?>>
<?= $Page->penerima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rek_penerima->Visible) { // rek_penerima ?>
        <td<?= $Page->rek_penerima->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_rek_penerima" class="el_uangmuka_rek_penerima">
<span<?= $Page->rek_penerima->viewAttributes() ?>>
<?= $Page->rek_penerima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_terima->Visible) { // tgl_terima ?>
        <td<?= $Page->tgl_terima->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_tgl_terima" class="el_uangmuka_tgl_terima">
<span<?= $Page->tgl_terima->viewAttributes() ?>>
<?= $Page->tgl_terima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->total_terima->Visible) { // total_terima ?>
        <td<?= $Page->total_terima->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_total_terima" class="el_uangmuka_total_terima">
<span<?= $Page->total_terima->viewAttributes() ?>>
<?= $Page->total_terima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgl_tgjb->Visible) { // tgl_tgjb ?>
        <td<?= $Page->tgl_tgjb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_tgl_tgjb" class="el_uangmuka_tgl_tgjb">
<span<?= $Page->tgl_tgjb->viewAttributes() ?>>
<?= $Page->tgl_tgjb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jumlah_tgjb->Visible) { // jumlah_tgjb ?>
        <td<?= $Page->jumlah_tgjb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_jumlah_tgjb" class="el_uangmuka_jumlah_tgjb">
<span<?= $Page->jumlah_tgjb->viewAttributes() ?>>
<?= $Page->jumlah_tgjb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <td<?= $Page->jenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_jenis" class="el_uangmuka_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bukti1->Visible) { // bukti1 ?>
        <td<?= $Page->bukti1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_bukti1" class="el_uangmuka_bukti1">
<span<?= $Page->bukti1->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti1, $Page->bukti1->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->bukti2->Visible) { // bukti2 ?>
        <td<?= $Page->bukti2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_bukti2" class="el_uangmuka_bukti2">
<span<?= $Page->bukti2->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti2, $Page->bukti2->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->bukti3->Visible) { // bukti3 ?>
        <td<?= $Page->bukti3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_bukti3" class="el_uangmuka_bukti3">
<span<?= $Page->bukti3->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti3, $Page->bukti3->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->bukti4->Visible) { // bukti4 ?>
        <td<?= $Page->bukti4->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_bukti4" class="el_uangmuka_bukti4">
<span<?= $Page->bukti4->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti4, $Page->bukti4->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
        <td<?= $Page->disetujui->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_disetujui" class="el_uangmuka_disetujui">
<span<?= $Page->disetujui->viewAttributes() ?>>
<?= $Page->disetujui->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_status" class="el_uangmuka_status">
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
