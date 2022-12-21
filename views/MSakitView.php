<?php

namespace PHPMaker2022\sigap;

// Page object
$MSakitView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { m_sakit: currentTable } });
var currentForm, currentPageID;
var fm_sakitview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fm_sakitview = new ew.Form("fm_sakitview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fm_sakitview;
    loadjs.done("fm_sakitview");
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
<form name="fm_sakitview" id="fm_sakitview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_sakit">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_sakit_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_m_sakit_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
    <tr id="r_jenjang_id"<?= $Page->jenjang_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_sakit_jenjang_id"><?= $Page->jenjang_id->caption() ?></span></td>
        <td data-name="jenjang_id"<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el_m_sakit_jenjang_id">
<span<?= $Page->jenjang_id->viewAttributes() ?>>
<?= $Page->jenjang_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
    <tr id="r_jabatan"<?= $Page->jabatan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_sakit_jabatan"><?= $Page->jabatan->caption() ?></span></td>
        <td data-name="jabatan"<?= $Page->jabatan->cellAttributes() ?>>
<span id="el_m_sakit_jabatan">
<span<?= $Page->jabatan->viewAttributes() ?>>
<?= $Page->jabatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->perhari->Visible) { // perhari ?>
    <tr id="r_perhari"<?= $Page->perhari->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_sakit_perhari"><?= $Page->perhari->caption() ?></span></td>
        <td data-name="perhari"<?= $Page->perhari->cellAttributes() ?>>
<span id="el_m_sakit_perhari">
<span<?= $Page->perhari->viewAttributes() ?>>
<?= $Page->perhari->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->perjam->Visible) { // perjam ?>
    <tr id="r_perjam"<?= $Page->perjam->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_m_sakit_perjam"><?= $Page->perjam->caption() ?></span></td>
        <td data-name="perjam"<?= $Page->perjam->cellAttributes() ?>>
<span id="el_m_sakit_perjam">
<span<?= $Page->perjam->viewAttributes() ?>>
<?= $Page->perjam->getViewValue() ?></span>
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
