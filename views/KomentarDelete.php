<?php

namespace PHPMaker2022\sigap;

// Page object
$KomentarDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { komentar: currentTable } });
var currentForm, currentPageID;
var fkomentardelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkomentardelete = new ew.Form("fkomentardelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fkomentardelete;
    loadjs.done("fkomentardelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fkomentardelete" id="fkomentardelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="komentar">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->pegawai->Visible) { // pegawai ?>
        <th class="<?= $Page->pegawai->headerCellClass() ?>"><span id="elh_komentar_pegawai" class="komentar_pegawai"><?= $Page->pegawai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->komentar->Visible) { // komentar ?>
        <th class="<?= $Page->komentar->headerCellClass() ?>"><span id="elh_komentar_komentar" class="komentar_komentar"><?= $Page->komentar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gambar->Visible) { // gambar ?>
        <th class="<?= $Page->gambar->headerCellClass() ?>"><span id="elh_komentar_gambar" class="komentar_gambar"><?= $Page->gambar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->video->Visible) { // video ?>
        <th class="<?= $Page->video->headerCellClass() ?>"><span id="elh_komentar_video" class="komentar_video"><?= $Page->video->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
        <td<?= $Page->pegawai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_komentar_pegawai" class="el_komentar_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->komentar->Visible) { // komentar ?>
        <td<?= $Page->komentar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_komentar_komentar" class="el_komentar_komentar">
<span<?= $Page->komentar->viewAttributes() ?>>
<?= $Page->komentar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gambar->Visible) { // gambar ?>
        <td<?= $Page->gambar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_komentar_gambar" class="el_komentar_gambar">
<span<?= $Page->gambar->viewAttributes() ?>>
<?= GetFileViewTag($Page->gambar, $Page->gambar->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->video->Visible) { // video ?>
        <td<?= $Page->video->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_komentar_video" class="el_komentar_video">
<span<?= $Page->video->viewAttributes() ?>>
<?= GetFileViewTag($Page->video, $Page->video->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
