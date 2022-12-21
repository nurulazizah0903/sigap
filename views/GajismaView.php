<?php

namespace PHPMaker2022\sigap;

// Page object
$GajismaView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gajisma: currentTable } });
var currentForm, currentPageID;
var fgajismaview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajismaview = new ew.Form("fgajismaview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fgajismaview;
    loadjs.done("fgajismaview");
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
<form name="fgajismaview" id="fgajismaview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gajisma">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajisma_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_gajisma_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tahun->Visible) { // tahun ?>
    <tr id="r_tahun"<?= $Page->tahun->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajisma_tahun"><?= $Page->tahun->caption() ?></span></td>
        <td data-name="tahun"<?= $Page->tahun->cellAttributes() ?>>
<span id="el_gajisma_tahun">
<span<?= $Page->tahun->viewAttributes() ?>>
<?= $Page->tahun->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bulan->Visible) { // bulan ?>
    <tr id="r_bulan"<?= $Page->bulan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajisma_bulan"><?= $Page->bulan->caption() ?></span></td>
        <td data-name="bulan"<?= $Page->bulan->cellAttributes() ?>>
<span id="el_gajisma_bulan">
<span<?= $Page->bulan->viewAttributes() ?>>
<?= $Page->bulan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tingkat->Visible) { // tingkat ?>
    <tr id="r_tingkat"<?= $Page->tingkat->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajisma_tingkat"><?= $Page->tingkat->caption() ?></span></td>
        <td data-name="tingkat"<?= $Page->tingkat->cellAttributes() ?>>
<span id="el_gajisma_tingkat">
<span<?= $Page->tingkat->viewAttributes() ?>>
<?= $Page->tingkat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("gajisma_detil", explode(",", $Page->getCurrentDetailTable())) && $gajisma_detil->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("gajisma_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "GajismaDetilGrid.php" ?>
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
