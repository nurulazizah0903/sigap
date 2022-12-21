<?php

namespace PHPMaker2022\sigap;

// Page object
$PenempatanView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { penempatan: currentTable } });
var currentForm, currentPageID;
var fpenempatanview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpenempatanview = new ew.Form("fpenempatanview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fpenempatanview;
    loadjs.done("fpenempatanview");
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
<form name="fpenempatanview" id="fpenempatanview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penempatan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penempatan_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_penempatan_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <tr id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penempatan_pegawai"><?= $Page->pegawai->caption() ?></span></td>
        <td data-name="pegawai"<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_penempatan_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->project->Visible) { // project ?>
    <tr id="r_project"<?= $Page->project->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penempatan_project"><?= $Page->project->caption() ?></span></td>
        <td data-name="project"<?= $Page->project->cellAttributes() ?>>
<span id="el_penempatan_project">
<span<?= $Page->project->viewAttributes() ?>>
<?= $Page->project->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
    <tr id="r_jabatan"<?= $Page->jabatan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penempatan_jabatan"><?= $Page->jabatan->caption() ?></span></td>
        <td data-name="jabatan"<?= $Page->jabatan->cellAttributes() ?>>
<span id="el_penempatan_jabatan">
<span<?= $Page->jabatan->viewAttributes() ?>>
<?= $Page->jabatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_mulai->Visible) { // tgl_mulai ?>
    <tr id="r_tgl_mulai"<?= $Page->tgl_mulai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penempatan_tgl_mulai"><?= $Page->tgl_mulai->caption() ?></span></td>
        <td data-name="tgl_mulai"<?= $Page->tgl_mulai->cellAttributes() ?>>
<span id="el_penempatan_tgl_mulai">
<span<?= $Page->tgl_mulai->viewAttributes() ?>>
<?= $Page->tgl_mulai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgl_akhir->Visible) { // tgl_akhir ?>
    <tr id="r_tgl_akhir"<?= $Page->tgl_akhir->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_penempatan_tgl_akhir"><?= $Page->tgl_akhir->caption() ?></span></td>
        <td data-name="tgl_akhir"<?= $Page->tgl_akhir->cellAttributes() ?>>
<span id="el_penempatan_tgl_akhir">
<span<?= $Page->tgl_akhir->viewAttributes() ?>>
<?= $Page->tgl_akhir->getViewValue() ?></span>
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
