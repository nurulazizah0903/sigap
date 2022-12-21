<?php

namespace PHPMaker2022\sigap;

// Page object
$JabatanView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jabatan: currentTable } });
var currentForm, currentPageID;
var fjabatanview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjabatanview = new ew.Form("fjabatanview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fjabatanview;
    loadjs.done("fjabatanview");
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
<form name="fjabatanview" id="fjabatanview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jabatan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jabatan_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_jabatan_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenjang->Visible) { // jenjang ?>
    <tr id="r_jenjang"<?= $Page->jenjang->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jabatan_jenjang"><?= $Page->jenjang->caption() ?></span></td>
        <td data-name="jenjang"<?= $Page->jenjang->cellAttributes() ?>>
<span id="el_jabatan_jenjang">
<span<?= $Page->jenjang->viewAttributes() ?>>
<?= $Page->jenjang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama_jabatan->Visible) { // nama_jabatan ?>
    <tr id="r_nama_jabatan"<?= $Page->nama_jabatan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jabatan_nama_jabatan"><?= $Page->nama_jabatan->caption() ?></span></td>
        <td data-name="nama_jabatan"<?= $Page->nama_jabatan->cellAttributes() ?>>
<span id="el_jabatan_nama_jabatan">
<span<?= $Page->nama_jabatan->viewAttributes() ?>>
<?= $Page->nama_jabatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <tr id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jabatan_keterangan"><?= $Page->keterangan->caption() ?></span></td>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_jabatan_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
    <tr id="r_c_date"<?= $Page->c_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jabatan_c_date"><?= $Page->c_date->caption() ?></span></td>
        <td data-name="c_date"<?= $Page->c_date->cellAttributes() ?>>
<span id="el_jabatan_c_date">
<span<?= $Page->c_date->viewAttributes() ?>>
<?= $Page->c_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->u_date->Visible) { // u_date ?>
    <tr id="r_u_date"<?= $Page->u_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jabatan_u_date"><?= $Page->u_date->caption() ?></span></td>
        <td data-name="u_date"<?= $Page->u_date->cellAttributes() ?>>
<span id="el_jabatan_u_date">
<span<?= $Page->u_date->viewAttributes() ?>>
<?= $Page->u_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->c_by->Visible) { // c_by ?>
    <tr id="r_c_by"<?= $Page->c_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jabatan_c_by"><?= $Page->c_by->caption() ?></span></td>
        <td data-name="c_by"<?= $Page->c_by->cellAttributes() ?>>
<span id="el_jabatan_c_by">
<span<?= $Page->c_by->viewAttributes() ?>>
<?= $Page->c_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
    <tr id="r_u_by"<?= $Page->u_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jabatan_u_by"><?= $Page->u_by->caption() ?></span></td>
        <td data-name="u_by"<?= $Page->u_by->cellAttributes() ?>>
<span id="el_jabatan_u_by">
<span<?= $Page->u_by->viewAttributes() ?>>
<?= $Page->u_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
    <tr id="r_aktif"<?= $Page->aktif->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jabatan_aktif"><?= $Page->aktif->caption() ?></span></td>
        <td data-name="aktif"<?= $Page->aktif->cellAttributes() ?>>
<span id="el_jabatan_aktif">
<span<?= $Page->aktif->viewAttributes() ?>>
<?= $Page->aktif->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("gajitunjangan", explode(",", $Page->getCurrentDetailTable())) && $gajitunjangan->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("gajitunjangan", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "GajitunjanganGrid.php" ?>
<?php } ?>
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
