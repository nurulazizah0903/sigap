<?php

namespace PHPMaker2022\sigap;

// Page object
$BeritaView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { berita: currentTable } });
var currentForm, currentPageID;
var fberitaview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fberitaview = new ew.Form("fberitaview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fberitaview;
    loadjs.done("fberitaview");
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
<form name="fberitaview" id="fberitaview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="berita">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_berita_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_berita_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->grup->Visible) { // grup ?>
    <tr id="r_grup"<?= $Page->grup->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_berita_grup"><?= $Page->grup->caption() ?></span></td>
        <td data-name="grup"<?= $Page->grup->cellAttributes() ?>>
<span id="el_berita_grup">
<span<?= $Page->grup->viewAttributes() ?>>
<?= $Page->grup->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->judul->Visible) { // judul ?>
    <tr id="r_judul"<?= $Page->judul->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_berita_judul"><?= $Page->judul->caption() ?></span></td>
        <td data-name="judul"<?= $Page->judul->cellAttributes() ?>>
<span id="el_berita_judul">
<span<?= $Page->judul->viewAttributes() ?>>
<?= $Page->judul->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->c_by->Visible) { // c_by ?>
    <tr id="r_c_by"<?= $Page->c_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_berita_c_by"><?= $Page->c_by->caption() ?></span></td>
        <td data-name="c_by"<?= $Page->c_by->cellAttributes() ?>>
<span id="el_berita_c_by">
<span<?= $Page->c_by->viewAttributes() ?>>
<?= $Page->c_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
    <tr id="r_c_date"<?= $Page->c_date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_berita_c_date"><?= $Page->c_date->caption() ?></span></td>
        <td data-name="c_date"<?= $Page->c_date->cellAttributes() ?>>
<span id="el_berita_c_date">
<span<?= $Page->c_date->viewAttributes() ?>>
<?= $Page->c_date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
    <tr id="r_aktif"<?= $Page->aktif->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_berita_aktif"><?= $Page->aktif->caption() ?></span></td>
        <td data-name="aktif"<?= $Page->aktif->cellAttributes() ?>>
<span id="el_berita_aktif">
<span<?= $Page->aktif->viewAttributes() ?>>
<?= $Page->aktif->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->video->Visible) { // video ?>
    <tr id="r_video"<?= $Page->video->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_berita_video"><?= $Page->video->caption() ?></span></td>
        <td data-name="video"<?= $Page->video->cellAttributes() ?>>
<span id="el_berita_video">
<span<?= $Page->video->viewAttributes() ?>>
<?= GetFileViewTag($Page->video, $Page->video->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->berita->Visible) { // berita ?>
    <tr id="r_berita"<?= $Page->berita->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_berita_berita"><?= $Page->berita->caption() ?></span></td>
        <td data-name="berita"<?= $Page->berita->cellAttributes() ?>>
<span id="el_berita_berita">
<span<?= $Page->berita->viewAttributes() ?>>
<?= $Page->berita->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gambar->Visible) { // gambar ?>
    <tr id="r_gambar"<?= $Page->gambar->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_berita_gambar"><?= $Page->gambar->caption() ?></span></td>
        <td data-name="gambar"<?= $Page->gambar->cellAttributes() ?>>
<span id="el_berita_gambar">
<span<?= $Page->gambar->viewAttributes() ?>>
<?= GetFileViewTag($Page->gambar, $Page->gambar->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("komentar", explode(",", $Page->getCurrentDetailTable())) && $komentar->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("komentar", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "KomentarGrid.php" ?>
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
