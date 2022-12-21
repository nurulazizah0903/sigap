<?php

namespace PHPMaker2022\sigap;

// Page object
$AbsenDetilView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { absen_detil: currentTable } });
var currentForm, currentPageID;
var fabsen_detilview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fabsen_detilview = new ew.Form("fabsen_detilview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fabsen_detilview;
    loadjs.done("fabsen_detilview");
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
<form name="fabsen_detilview" id="fabsen_detilview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="absen_detil">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_absen_detil_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_absen_detil_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pid->Visible) { // pid ?>
    <tr id="r_pid"<?= $Page->pid->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_absen_detil_pid"><?= $Page->pid->caption() ?></span></td>
        <td data-name="pid"<?= $Page->pid->cellAttributes() ?>>
<span id="el_absen_detil_pid">
<span<?= $Page->pid->viewAttributes() ?>>
<?= $Page->pid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <tr id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_absen_detil_pegawai"><?= $Page->pegawai->caption() ?></span></td>
        <td data-name="pegawai"<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_absen_detil_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->masuk->Visible) { // masuk ?>
    <tr id="r_masuk"<?= $Page->masuk->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_absen_detil_masuk"><?= $Page->masuk->caption() ?></span></td>
        <td data-name="masuk"<?= $Page->masuk->cellAttributes() ?>>
<span id="el_absen_detil_masuk">
<span<?= $Page->masuk->viewAttributes() ?>>
<?= $Page->masuk->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->absen->Visible) { // absen ?>
    <tr id="r_absen"<?= $Page->absen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_absen_detil_absen"><?= $Page->absen->caption() ?></span></td>
        <td data-name="absen"<?= $Page->absen->cellAttributes() ?>>
<span id="el_absen_detil_absen">
<span<?= $Page->absen->viewAttributes() ?>>
<?= $Page->absen->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ijin->Visible) { // ijin ?>
    <tr id="r_ijin"<?= $Page->ijin->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_absen_detil_ijin"><?= $Page->ijin->caption() ?></span></td>
        <td data-name="ijin"<?= $Page->ijin->cellAttributes() ?>>
<span id="el_absen_detil_ijin">
<span<?= $Page->ijin->viewAttributes() ?>>
<?= $Page->ijin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->cuti->Visible) { // cuti ?>
    <tr id="r_cuti"<?= $Page->cuti->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_absen_detil_cuti"><?= $Page->cuti->caption() ?></span></td>
        <td data-name="cuti"<?= $Page->cuti->cellAttributes() ?>>
<span id="el_absen_detil_cuti">
<span<?= $Page->cuti->viewAttributes() ?>>
<?= $Page->cuti->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dinas_luar->Visible) { // dinas_luar ?>
    <tr id="r_dinas_luar"<?= $Page->dinas_luar->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_absen_detil_dinas_luar"><?= $Page->dinas_luar->caption() ?></span></td>
        <td data-name="dinas_luar"<?= $Page->dinas_luar->cellAttributes() ?>>
<span id="el_absen_detil_dinas_luar">
<span<?= $Page->dinas_luar->viewAttributes() ?>>
<?= $Page->dinas_luar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->terlambat->Visible) { // terlambat ?>
    <tr id="r_terlambat"<?= $Page->terlambat->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_absen_detil_terlambat"><?= $Page->terlambat->caption() ?></span></td>
        <td data-name="terlambat"<?= $Page->terlambat->cellAttributes() ?>>
<span id="el_absen_detil_terlambat">
<span<?= $Page->terlambat->viewAttributes() ?>>
<?= $Page->terlambat->getViewValue() ?></span>
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
