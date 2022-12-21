<?php

namespace PHPMaker2022\sigap;

// Page object
$BeritaDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { berita: currentTable } });
var currentForm, currentPageID;
var fberitadelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fberitadelete = new ew.Form("fberitadelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fberitadelete;
    loadjs.done("fberitadelete");
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
<form name="fberitadelete" id="fberitadelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="berita">
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
<?php if ($Page->grup->Visible) { // grup ?>
        <th class="<?= $Page->grup->headerCellClass() ?>"><span id="elh_berita_grup" class="berita_grup"><?= $Page->grup->caption() ?></span></th>
<?php } ?>
<?php if ($Page->judul->Visible) { // judul ?>
        <th class="<?= $Page->judul->headerCellClass() ?>"><span id="elh_berita_judul" class="berita_judul"><?= $Page->judul->caption() ?></span></th>
<?php } ?>
<?php if ($Page->c_by->Visible) { // c_by ?>
        <th class="<?= $Page->c_by->headerCellClass() ?>"><span id="elh_berita_c_by" class="berita_c_by"><?= $Page->c_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
        <th class="<?= $Page->c_date->headerCellClass() ?>"><span id="elh_berita_c_date" class="berita_c_date"><?= $Page->c_date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
        <th class="<?= $Page->aktif->headerCellClass() ?>"><span id="elh_berita_aktif" class="berita_aktif"><?= $Page->aktif->caption() ?></span></th>
<?php } ?>
<?php if ($Page->video->Visible) { // video ?>
        <th class="<?= $Page->video->headerCellClass() ?>"><span id="elh_berita_video" class="berita_video"><?= $Page->video->caption() ?></span></th>
<?php } ?>
<?php if ($Page->berita->Visible) { // berita ?>
        <th class="<?= $Page->berita->headerCellClass() ?>"><span id="elh_berita_berita" class="berita_berita"><?= $Page->berita->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gambar->Visible) { // gambar ?>
        <th class="<?= $Page->gambar->headerCellClass() ?>"><span id="elh_berita_gambar" class="berita_gambar"><?= $Page->gambar->caption() ?></span></th>
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
<?php if ($Page->grup->Visible) { // grup ?>
        <td<?= $Page->grup->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_berita_grup" class="el_berita_grup">
<span<?= $Page->grup->viewAttributes() ?>>
<?= $Page->grup->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->judul->Visible) { // judul ?>
        <td<?= $Page->judul->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_berita_judul" class="el_berita_judul">
<span<?= $Page->judul->viewAttributes() ?>>
<?= $Page->judul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->c_by->Visible) { // c_by ?>
        <td<?= $Page->c_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_berita_c_by" class="el_berita_c_by">
<span<?= $Page->c_by->viewAttributes() ?>>
<?= $Page->c_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
        <td<?= $Page->c_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_berita_c_date" class="el_berita_c_date">
<span<?= $Page->c_date->viewAttributes() ?>>
<?= $Page->c_date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
        <td<?= $Page->aktif->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_berita_aktif" class="el_berita_aktif">
<span<?= $Page->aktif->viewAttributes() ?>>
<?= $Page->aktif->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->video->Visible) { // video ?>
        <td<?= $Page->video->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_berita_video" class="el_berita_video">
<span<?= $Page->video->viewAttributes() ?>>
<?= GetFileViewTag($Page->video, $Page->video->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->berita->Visible) { // berita ?>
        <td<?= $Page->berita->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_berita_berita" class="el_berita_berita">
<span<?= $Page->berita->viewAttributes() ?>>
<?= $Page->berita->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gambar->Visible) { // gambar ?>
        <td<?= $Page->gambar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_berita_gambar" class="el_berita_gambar">
<span<?= $Page->gambar->viewAttributes() ?>>
<?= GetFileViewTag($Page->gambar, $Page->gambar->getViewValue(), false) ?>
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
