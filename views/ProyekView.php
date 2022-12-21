<?php

namespace PHPMaker2022\sigap;

// Page object
$ProyekView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { proyek: currentTable } });
var currentForm, currentPageID;
var fproyekview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fproyekview = new ew.Form("fproyekview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fproyekview;
    loadjs.done("fproyekview");
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
<form name="fproyekview" id="fproyekview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="proyek">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_proyek_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_proyek_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->klien->Visible) { // klien ?>
    <tr id="r_klien"<?= $Page->klien->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_proyek_klien"><?= $Page->klien->caption() ?></span></td>
        <td data-name="klien"<?= $Page->klien->cellAttributes() ?>>
<span id="el_proyek_klien">
<span<?= $Page->klien->viewAttributes() ?>>
<?= $Page->klien->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->proyek->Visible) { // proyek ?>
    <tr id="r_proyek"<?= $Page->proyek->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_proyek_proyek"><?= $Page->proyek->caption() ?></span></td>
        <td data-name="proyek"<?= $Page->proyek->cellAttributes() ?>>
<span id="el_proyek_proyek">
<span<?= $Page->proyek->viewAttributes() ?>>
<?= $Page->proyek->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_awal->Visible) { // tgl_awal ?>
    <tr id="r_tgl_awal"<?= $Page->tgl_awal->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_proyek_tgl_awal"><?= $Page->tgl_awal->caption() ?></span></td>
        <td data-name="tgl_awal"<?= $Page->tgl_awal->cellAttributes() ?>>
<span id="el_proyek_tgl_awal">
<span<?= $Page->tgl_awal->viewAttributes() ?>>
<?= $Page->tgl_awal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_akhir->Visible) { // tgl_akhir ?>
    <tr id="r_tgl_akhir"<?= $Page->tgl_akhir->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_proyek_tgl_akhir"><?= $Page->tgl_akhir->caption() ?></span></td>
        <td data-name="tgl_akhir"<?= $Page->tgl_akhir->cellAttributes() ?>>
<span id="el_proyek_tgl_akhir">
<span<?= $Page->tgl_akhir->viewAttributes() ?>>
<?= $Page->tgl_akhir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->file_proyek->Visible) { // file_proyek ?>
    <tr id="r_file_proyek"<?= $Page->file_proyek->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_proyek_file_proyek"><?= $Page->file_proyek->caption() ?></span></td>
        <td data-name="file_proyek"<?= $Page->file_proyek->cellAttributes() ?>>
<span id="el_proyek_file_proyek">
<span<?= $Page->file_proyek->viewAttributes() ?>>
<?= GetFileViewTag($Page->file_proyek, $Page->file_proyek->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
    <tr id="r_aktif"<?= $Page->aktif->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_proyek_aktif"><?= $Page->aktif->caption() ?></span></td>
        <td data-name="aktif"<?= $Page->aktif->cellAttributes() ?>>
<span id="el_proyek_aktif">
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
