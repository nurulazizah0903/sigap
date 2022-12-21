<?php

namespace PHPMaker2022\sigap;

// Page object
$PegKeluargaView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { peg_keluarga: currentTable } });
var currentForm, currentPageID;
var fpeg_keluargaview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpeg_keluargaview = new ew.Form("fpeg_keluargaview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fpeg_keluargaview;
    loadjs.done("fpeg_keluargaview");
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
<form name="fpeg_keluargaview" id="fpeg_keluargaview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="peg_keluarga">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_peg_keluarga_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pid->Visible) { // pid ?>
    <tr id="r_pid"<?= $Page->pid->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_pid"><?= $Page->pid->caption() ?></span></td>
        <td data-name="pid"<?= $Page->pid->cellAttributes() ?>>
<span id="el_peg_keluarga_pid">
<span<?= $Page->pid->viewAttributes() ?>>
<?= $Page->pid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <tr id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_nama"><?= $Page->nama->caption() ?></span></td>
        <td data-name="nama"<?= $Page->nama->cellAttributes() ?>>
<span id="el_peg_keluarga_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hp->Visible) { // hp ?>
    <tr id="r_hp"<?= $Page->hp->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_hp"><?= $Page->hp->caption() ?></span></td>
        <td data-name="hp"<?= $Page->hp->cellAttributes() ?>>
<span id="el_peg_keluarga_hp">
<span<?= $Page->hp->viewAttributes() ?>>
<?= $Page->hp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hubungan->Visible) { // hubungan ?>
    <tr id="r_hubungan"<?= $Page->hubungan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_hubungan"><?= $Page->hubungan->caption() ?></span></td>
        <td data-name="hubungan"<?= $Page->hubungan->cellAttributes() ?>>
<span id="el_peg_keluarga_hubungan">
<span<?= $Page->hubungan->viewAttributes() ?>>
<?= $Page->hubungan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_lahir->Visible) { // tgl_lahir ?>
    <tr id="r_tgl_lahir"<?= $Page->tgl_lahir->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_tgl_lahir"><?= $Page->tgl_lahir->caption() ?></span></td>
        <td data-name="tgl_lahir"<?= $Page->tgl_lahir->cellAttributes() ?>>
<span id="el_peg_keluarga_tgl_lahir">
<span<?= $Page->tgl_lahir->viewAttributes() ?>>
<?= $Page->tgl_lahir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jen_kel->Visible) { // jen_kel ?>
    <tr id="r_jen_kel"<?= $Page->jen_kel->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_jen_kel"><?= $Page->jen_kel->caption() ?></span></td>
        <td data-name="jen_kel"<?= $Page->jen_kel->cellAttributes() ?>>
<span id="el_peg_keluarga_jen_kel">
<span<?= $Page->jen_kel->viewAttributes() ?>>
<?= $Page->jen_kel->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <tr id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_peg_keluarga_keterangan"><?= $Page->keterangan->caption() ?></span></td>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_peg_keluarga_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
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
