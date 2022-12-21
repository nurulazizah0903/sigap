<?php

namespace PHPMaker2022\sigap;

// Page object
$AbsenView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { absen: currentTable } });
var currentForm, currentPageID;
var fabsenview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fabsenview = new ew.Form("fabsenview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fabsenview;
    loadjs.done("fabsenview");
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
<form name="fabsenview" id="fabsenview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="absen">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_absen_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_absen_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pemeriksa->Visible) { // pemeriksa ?>
    <tr id="r_pemeriksa"<?= $Page->pemeriksa->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_absen_pemeriksa"><?= $Page->pemeriksa->caption() ?></span></td>
        <td data-name="pemeriksa"<?= $Page->pemeriksa->cellAttributes() ?>>
<span id="el_absen_pemeriksa">
<span<?= $Page->pemeriksa->viewAttributes() ?>>
<?= $Page->pemeriksa->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bulan->Visible) { // bulan ?>
    <tr id="r_bulan"<?= $Page->bulan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_absen_bulan"><?= $Page->bulan->caption() ?></span></td>
        <td data-name="bulan"<?= $Page->bulan->cellAttributes() ?>>
<span id="el_absen_bulan">
<span<?= $Page->bulan->viewAttributes() ?>>
<?= $Page->bulan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jumlah_hari_kerja->Visible) { // jumlah_hari_kerja ?>
    <tr id="r_jumlah_hari_kerja"<?= $Page->jumlah_hari_kerja->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_absen_jumlah_hari_kerja"><?= $Page->jumlah_hari_kerja->caption() ?></span></td>
        <td data-name="jumlah_hari_kerja"<?= $Page->jumlah_hari_kerja->cellAttributes() ?>>
<span id="el_absen_jumlah_hari_kerja">
<span<?= $Page->jumlah_hari_kerja->viewAttributes() ?>>
<?= $Page->jumlah_hari_kerja->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("absen_detil", explode(",", $Page->getCurrentDetailTable())) && $absen_detil->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("absen_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "AbsenDetilGrid.php" ?>
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
