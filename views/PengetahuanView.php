<?php

namespace PHPMaker2022\sigap;

// Page object
$PengetahuanView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pengetahuan: currentTable } });
var currentForm, currentPageID;
var fpengetahuanview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpengetahuanview = new ew.Form("fpengetahuanview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fpengetahuanview;
    loadjs.done("fpengetahuanview");
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
<form name="fpengetahuanview" id="fpengetahuanview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pengetahuan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengetahuan_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_pengetahuan_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->grup->Visible) { // grup ?>
    <tr id="r_grup"<?= $Page->grup->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengetahuan_grup"><?= $Page->grup->caption() ?></span></td>
        <td data-name="grup"<?= $Page->grup->cellAttributes() ?>>
<span id="el_pengetahuan_grup">
<span<?= $Page->grup->viewAttributes() ?>>
<?= $Page->grup->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->judul->Visible) { // judul ?>
    <tr id="r_judul"<?= $Page->judul->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengetahuan_judul"><?= $Page->judul->caption() ?></span></td>
        <td data-name="judul"<?= $Page->judul->cellAttributes() ?>>
<span id="el_pengetahuan_judul">
<span<?= $Page->judul->viewAttributes() ?>>
<?= $Page->judul->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->isi->Visible) { // isi ?>
    <tr id="r_isi"<?= $Page->isi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengetahuan_isi"><?= $Page->isi->caption() ?></span></td>
        <td data-name="isi"<?= $Page->isi->cellAttributes() ?>>
<span id="el_pengetahuan_isi">
<span<?= $Page->isi->viewAttributes() ?>>
<?= $Page->isi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sumber_url->Visible) { // sumber_url ?>
    <tr id="r_sumber_url"<?= $Page->sumber_url->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengetahuan_sumber_url"><?= $Page->sumber_url->caption() ?></span></td>
        <td data-name="sumber_url"<?= $Page->sumber_url->cellAttributes() ?>>
<span id="el_pengetahuan_sumber_url">
<span<?= $Page->sumber_url->viewAttributes() ?>>
<?= $Page->sumber_url->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->visual->Visible) { // visual ?>
    <tr id="r_visual"<?= $Page->visual->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengetahuan_visual"><?= $Page->visual->caption() ?></span></td>
        <td data-name="visual"<?= $Page->visual->cellAttributes() ?>>
<span id="el_pengetahuan_visual">
<span<?= $Page->visual->viewAttributes() ?>>
<?= $Page->visual->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
    <tr id="r_dokumen"<?= $Page->dokumen->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengetahuan_dokumen"><?= $Page->dokumen->caption() ?></span></td>
        <td data-name="dokumen"<?= $Page->dokumen->cellAttributes() ?>>
<span id="el_pengetahuan_dokumen">
<span<?= $Page->dokumen->viewAttributes() ?>>
<?= GetFileViewTag($Page->dokumen, $Page->dokumen->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->c_by->Visible) { // c_by ?>
    <tr id="r_c_by"<?= $Page->c_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pengetahuan_c_by"><?= $Page->c_by->caption() ?></span></td>
        <td data-name="c_by"<?= $Page->c_by->cellAttributes() ?>>
<span id="el_pengetahuan_c_by">
<span<?= $Page->c_by->viewAttributes() ?>>
<?= $Page->c_by->getViewValue() ?></span>
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
