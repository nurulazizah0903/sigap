<?php

namespace PHPMaker2022\sigap;

// Page object
$KomentarPreview = &$Page;
?>
<script>
ew.deepAssign(ew.vars, { tables: { komentar: <?= JsonEncode($Page->toClientVar()) ?> } });
</script>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid komentar"><!-- .card -->
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table table-bordered table-hover table-sm ew-table ew-preview-table"><!-- .table -->
    <thead><!-- Table header -->
        <tr class="ew-table-header">
<?php
// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <?php if ($Page->SortUrl($Page->pegawai) == "") { ?>
        <th class="<?= $Page->pegawai->headerCellClass() ?>"><?= $Page->pegawai->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->pegawai->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->pegawai->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->pegawai->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->pegawai->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->pegawai->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->komentar->Visible) { // komentar ?>
    <?php if ($Page->SortUrl($Page->komentar) == "") { ?>
        <th class="<?= $Page->komentar->headerCellClass() ?>"><?= $Page->komentar->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->komentar->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->komentar->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->komentar->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->komentar->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->komentar->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->gambar->Visible) { // gambar ?>
    <?php if ($Page->SortUrl($Page->gambar) == "") { ?>
        <th class="<?= $Page->gambar->headerCellClass() ?>"><?= $Page->gambar->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->gambar->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->gambar->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->gambar->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->gambar->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->gambar->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->video->Visible) { // video ?>
    <?php if ($Page->SortUrl($Page->video) == "") { ?>
        <th class="<?= $Page->video->headerCellClass() ?>"><?= $Page->video->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->video->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->video->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->video->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->video->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->video->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
        </tr>
    </thead>
    <tbody><!-- Table body -->
<?php
$Page->RecCount = 0;
$Page->RowCount = 0;
while ($Page->Recordset && !$Page->Recordset->EOF) {
    // Init row class and style
    $Page->RecCount++;
    $Page->RowCount++;
    $Page->CssStyle = "";
    $Page->loadListRowValues($Page->Recordset);

    // Render row
    $Page->RowType = ROWTYPE_PREVIEW; // Preview record
    $Page->resetAttributes();
    $Page->renderListRow();

    // Render list options
    $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
        <!-- pegawai -->
        <td<?= $Page->pegawai->cellAttributes() ?>>
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->komentar->Visible) { // komentar ?>
        <!-- komentar -->
        <td<?= $Page->komentar->cellAttributes() ?>>
<span<?= $Page->komentar->viewAttributes() ?>>
<?= $Page->komentar->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->gambar->Visible) { // gambar ?>
        <!-- gambar -->
        <td<?= $Page->gambar->cellAttributes() ?>>
<span<?= $Page->gambar->viewAttributes() ?>>
<?= GetFileViewTag($Page->gambar, $Page->gambar->getViewValue(), false) ?>
</span>
</td>
<?php } ?>
<?php if ($Page->video->Visible) { // video ?>
        <!-- video -->
        <td<?= $Page->video->cellAttributes() ?>>
<span<?= $Page->video->viewAttributes() ?>>
<?= GetFileViewTag($Page->video, $Page->video->getViewValue(), false) ?>
</span>
</td>
<?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    $Page->Recordset->moveNext();
} // while
?>
    </tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?= $Page->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?= $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
    foreach ($Page->OtherOptions as $option)
        $option->render("body");
?>
</div>
<?php if ($Page->TotalRecords > 0) { ?>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
