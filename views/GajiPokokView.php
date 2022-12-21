<?php

namespace PHPMaker2022\sigap;

// Page object
$GajiPokokView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gaji_pokok: currentTable } });
var currentForm, currentPageID;
var fgaji_pokokview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgaji_pokokview = new ew.Form("fgaji_pokokview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fgaji_pokokview;
    loadjs.done("fgaji_pokokview");
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
<form name="fgaji_pokokview" id="fgaji_pokokview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gaji_pokok">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_pokok_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_gaji_pokok_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
    <tr id="r_jenjang_id"<?= $Page->jenjang_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_pokok_jenjang_id"><?= $Page->jenjang_id->caption() ?></span></td>
        <td data-name="jenjang_id"<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el_gaji_pokok_jenjang_id">
<span<?= $Page->jenjang_id->viewAttributes() ?>>
<?= $Page->jenjang_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ijazah_id->Visible) { // ijazah_id ?>
    <tr id="r_ijazah_id"<?= $Page->ijazah_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_pokok_ijazah_id"><?= $Page->ijazah_id->caption() ?></span></td>
        <td data-name="ijazah_id"<?= $Page->ijazah_id->cellAttributes() ?>>
<span id="el_gaji_pokok_ijazah_id">
<span<?= $Page->ijazah_id->viewAttributes() ?>>
<?= $Page->ijazah_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lama_kerja->Visible) { // lama_kerja ?>
    <tr id="r_lama_kerja"<?= $Page->lama_kerja->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_pokok_lama_kerja"><?= $Page->lama_kerja->caption() ?></span></td>
        <td data-name="lama_kerja"<?= $Page->lama_kerja->cellAttributes() ?>>
<span id="el_gaji_pokok_lama_kerja">
<span<?= $Page->lama_kerja->viewAttributes() ?>>
<?= $Page->lama_kerja->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <tr id="r_jenis"<?= $Page->jenis->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_pokok_jenis"><?= $Page->jenis->caption() ?></span></td>
        <td data-name="jenis"<?= $Page->jenis->cellAttributes() ?>>
<span id="el_gaji_pokok_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->value->Visible) { // value ?>
    <tr id="r_value"<?= $Page->value->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_pokok_value"><?= $Page->value->caption() ?></span></td>
        <td data-name="value"<?= $Page->value->cellAttributes() ?>>
<span id="el_gaji_pokok_value">
<span<?= $Page->value->viewAttributes() ?>>
<?= $Page->value->getViewValue() ?></span>
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
