<?php

namespace PHPMaker2022\sigap;

// Page object
$KomentarView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { komentar: currentTable } });
var currentForm, currentPageID;
var fkomentarview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkomentarview = new ew.Form("fkomentarview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fkomentarview;
    loadjs.done("fkomentarview");
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
<form name="fkomentarview" id="fkomentarview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="komentar">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_komentar_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_komentar_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pid->Visible) { // pid ?>
    <tr id="r_pid"<?= $Page->pid->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_komentar_pid"><?= $Page->pid->caption() ?></span></td>
        <td data-name="pid"<?= $Page->pid->cellAttributes() ?>>
<span id="el_komentar_pid">
<span<?= $Page->pid->viewAttributes() ?>>
<?= $Page->pid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <tr id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_komentar_pegawai"><?= $Page->pegawai->caption() ?></span></td>
        <td data-name="pegawai"<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_komentar_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->komentar->Visible) { // komentar ?>
    <tr id="r_komentar"<?= $Page->komentar->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_komentar_komentar"><?= $Page->komentar->caption() ?></span></td>
        <td data-name="komentar"<?= $Page->komentar->cellAttributes() ?>>
<span id="el_komentar_komentar">
<span<?= $Page->komentar->viewAttributes() ?>>
<?= $Page->komentar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gambar->Visible) { // gambar ?>
    <tr id="r_gambar"<?= $Page->gambar->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_komentar_gambar"><?= $Page->gambar->caption() ?></span></td>
        <td data-name="gambar"<?= $Page->gambar->cellAttributes() ?>>
<span id="el_komentar_gambar">
<span<?= $Page->gambar->viewAttributes() ?>>
<?= GetFileViewTag($Page->gambar, $Page->gambar->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->video->Visible) { // video ?>
    <tr id="r_video"<?= $Page->video->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_komentar_video"><?= $Page->video->caption() ?></span></td>
        <td data-name="video"<?= $Page->video->cellAttributes() ?>>
<span id="el_komentar_video">
<span<?= $Page->video->viewAttributes() ?>>
<?= GetFileViewTag($Page->video, $Page->video->getViewValue(), false) ?>
</span>
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
