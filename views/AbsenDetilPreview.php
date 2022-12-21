<?php

namespace PHPMaker2022\sigap;

// Page object
$AbsenDetilPreview = &$Page;
?>
<script>
ew.deepAssign(ew.vars, { tables: { absen_detil: <?= JsonEncode($Page->toClientVar()) ?> } });
</script>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid absen_detil"><!-- .card -->
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
<?php if ($Page->masuk->Visible) { // masuk ?>
    <?php if ($Page->SortUrl($Page->masuk) == "") { ?>
        <th class="<?= $Page->masuk->headerCellClass() ?>"><?= $Page->masuk->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->masuk->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->masuk->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->masuk->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->masuk->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->masuk->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->absen->Visible) { // absen ?>
    <?php if ($Page->SortUrl($Page->absen) == "") { ?>
        <th class="<?= $Page->absen->headerCellClass() ?>"><?= $Page->absen->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->absen->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->absen->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->absen->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->absen->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->absen->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ijin->Visible) { // ijin ?>
    <?php if ($Page->SortUrl($Page->ijin) == "") { ?>
        <th class="<?= $Page->ijin->headerCellClass() ?>"><?= $Page->ijin->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ijin->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->ijin->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->ijin->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->ijin->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->ijin->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->cuti->Visible) { // cuti ?>
    <?php if ($Page->SortUrl($Page->cuti) == "") { ?>
        <th class="<?= $Page->cuti->headerCellClass() ?>"><?= $Page->cuti->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->cuti->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->cuti->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->cuti->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->cuti->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->cuti->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->dinas_luar->Visible) { // dinas_luar ?>
    <?php if ($Page->SortUrl($Page->dinas_luar) == "") { ?>
        <th class="<?= $Page->dinas_luar->headerCellClass() ?>"><?= $Page->dinas_luar->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->dinas_luar->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->dinas_luar->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->dinas_luar->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->dinas_luar->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->dinas_luar->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->terlambat->Visible) { // terlambat ?>
    <?php if ($Page->SortUrl($Page->terlambat) == "") { ?>
        <th class="<?= $Page->terlambat->headerCellClass() ?>"><?= $Page->terlambat->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->terlambat->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->terlambat->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->terlambat->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->terlambat->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->terlambat->getSortIcon() ?></span>
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
<?php if ($Page->masuk->Visible) { // masuk ?>
        <!-- masuk -->
        <td<?= $Page->masuk->cellAttributes() ?>>
<span<?= $Page->masuk->viewAttributes() ?>>
<?= $Page->masuk->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->absen->Visible) { // absen ?>
        <!-- absen -->
        <td<?= $Page->absen->cellAttributes() ?>>
<span<?= $Page->absen->viewAttributes() ?>>
<?= $Page->absen->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ijin->Visible) { // ijin ?>
        <!-- ijin -->
        <td<?= $Page->ijin->cellAttributes() ?>>
<span<?= $Page->ijin->viewAttributes() ?>>
<?= $Page->ijin->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->cuti->Visible) { // cuti ?>
        <!-- cuti -->
        <td<?= $Page->cuti->cellAttributes() ?>>
<span<?= $Page->cuti->viewAttributes() ?>>
<?= $Page->cuti->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->dinas_luar->Visible) { // dinas_luar ?>
        <!-- dinas_luar -->
        <td<?= $Page->dinas_luar->cellAttributes() ?>>
<span<?= $Page->dinas_luar->viewAttributes() ?>>
<?= $Page->dinas_luar->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->terlambat->Visible) { // terlambat ?>
        <!-- terlambat -->
        <td<?= $Page->terlambat->cellAttributes() ?>>
<span<?= $Page->terlambat->viewAttributes() ?>>
<?= $Page->terlambat->getViewValue() ?></span>
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
