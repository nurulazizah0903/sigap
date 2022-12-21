<?php

namespace PHPMaker2022\sigap;

// Page object
$JenisGrupIlmuView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jenis_grup_ilmu: currentTable } });
var currentForm, currentPageID;
var fjenis_grup_ilmuview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjenis_grup_ilmuview = new ew.Form("fjenis_grup_ilmuview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fjenis_grup_ilmuview;
    loadjs.done("fjenis_grup_ilmuview");
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
<form name="fjenis_grup_ilmuview" id="fjenis_grup_ilmuview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jenis_grup_ilmu">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jenis_grup_ilmu_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_jenis_grup_ilmu_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <tr id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jenis_grup_ilmu_nama"><?= $Page->nama->caption() ?></span></td>
        <td data-name="nama"<?= $Page->nama->cellAttributes() ?>>
<span id="el_jenis_grup_ilmu_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
    <tr id="r_aktif"<?= $Page->aktif->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_jenis_grup_ilmu_aktif"><?= $Page->aktif->caption() ?></span></td>
        <td data-name="aktif"<?= $Page->aktif->cellAttributes() ?>>
<span id="el_jenis_grup_ilmu_aktif">
<span<?= $Page->aktif->viewAttributes() ?>>
<?= $Page->aktif->getViewValue() ?></span>
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
