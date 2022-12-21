<?php

namespace PHPMaker2022\sigap;

// Page object
$PegDokumenView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { peg_dokumen: currentTable } });
var currentForm, currentPageID;
var fpeg_dokumenview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpeg_dokumenview = new ew.Form("fpeg_dokumenview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fpeg_dokumenview;
    loadjs.done("fpeg_dokumenview");
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
<form name="fpeg_dokumenview" id="fpeg_dokumenview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="peg_dokumen">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_peg_dokumen_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pid->Visible) { // pid ?>
    <tr id="r_pid"<?= $Page->pid->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_pid"><?= $Page->pid->caption() ?></span></td>
        <td data-name="pid"<?= $Page->pid->cellAttributes() ?>>
<span id="el_peg_dokumen_pid">
<span<?= $Page->pid->viewAttributes() ?>>
<?= $Page->pid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->c_by->Visible) { // c_by ?>
    <tr id="r_c_by"<?= $Page->c_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_c_by"><?= $Page->c_by->caption() ?></span></td>
        <td data-name="c_by"<?= $Page->c_by->cellAttributes() ?>>
<span id="el_peg_dokumen_c_by">
<span<?= $Page->c_by->viewAttributes() ?>>
<?= $Page->c_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_dokumen->Visible) { // nama_dokumen ?>
    <tr id="r_nama_dokumen"<?= $Page->nama_dokumen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_nama_dokumen"><?= $Page->nama_dokumen->caption() ?></span></td>
        <td data-name="nama_dokumen"<?= $Page->nama_dokumen->cellAttributes() ?>>
<span id="el_peg_dokumen_nama_dokumen">
<span<?= $Page->nama_dokumen->viewAttributes() ?>>
<?= $Page->nama_dokumen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->file_dokumen->Visible) { // file_dokumen ?>
    <tr id="r_file_dokumen"<?= $Page->file_dokumen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_file_dokumen"><?= $Page->file_dokumen->caption() ?></span></td>
        <td data-name="file_dokumen"<?= $Page->file_dokumen->cellAttributes() ?>>
<span id="el_peg_dokumen_file_dokumen">
<span<?= $Page->file_dokumen->viewAttributes() ?>>
<?= GetFileViewTag($Page->file_dokumen, $Page->file_dokumen->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <tr id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_keterangan"><?= $Page->keterangan->caption() ?></span></td>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_peg_dokumen_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
    <tr id="r_c_date"<?= $Page->c_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_c_date"><?= $Page->c_date->caption() ?></span></td>
        <td data-name="c_date"<?= $Page->c_date->cellAttributes() ?>>
<span id="el_peg_dokumen_c_date">
<span<?= $Page->c_date->viewAttributes() ?>>
<?= $Page->c_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->u_date->Visible) { // u_date ?>
    <tr id="r_u_date"<?= $Page->u_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_u_date"><?= $Page->u_date->caption() ?></span></td>
        <td data-name="u_date"<?= $Page->u_date->cellAttributes() ?>>
<span id="el_peg_dokumen_u_date">
<span<?= $Page->u_date->viewAttributes() ?>>
<?= $Page->u_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
    <tr id="r_u_by"<?= $Page->u_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_dokumen_u_by"><?= $Page->u_by->caption() ?></span></td>
        <td data-name="u_by"<?= $Page->u_by->cellAttributes() ?>>
<span id="el_peg_dokumen_u_by">
<span<?= $Page->u_by->viewAttributes() ?>>
<?= $Page->u_by->getViewValue() ?></span>
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
