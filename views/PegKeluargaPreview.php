<?php

namespace PHPMaker2022\sigap;

// Page object
$PegKeluargaPreview = &$Page;
?>
<script>
ew.deepAssign(ew.vars, { tables: { peg_keluarga: <?= JsonEncode($Page->toClientVar()) ?> } });
</script>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid peg_keluarga"><!-- .card -->
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
<?php if ($Page->nama->Visible) { // nama ?>
    <?php if ($Page->SortUrl($Page->nama) == "") { ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><?= $Page->nama->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->nama->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->nama->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->nama->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->nama->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->hp->Visible) { // hp ?>
    <?php if ($Page->SortUrl($Page->hp) == "") { ?>
        <th class="<?= $Page->hp->headerCellClass() ?>"><?= $Page->hp->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->hp->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->hp->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->hp->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->hp->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->hp->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->hubungan->Visible) { // hubungan ?>
    <?php if ($Page->SortUrl($Page->hubungan) == "") { ?>
        <th class="<?= $Page->hubungan->headerCellClass() ?>"><?= $Page->hubungan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->hubungan->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->hubungan->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->hubungan->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->hubungan->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->hubungan->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tgl_lahir->Visible) { // tgl_lahir ?>
    <?php if ($Page->SortUrl($Page->tgl_lahir) == "") { ?>
        <th class="<?= $Page->tgl_lahir->headerCellClass() ?>"><?= $Page->tgl_lahir->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tgl_lahir->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->tgl_lahir->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->tgl_lahir->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->tgl_lahir->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->tgl_lahir->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->jen_kel->Visible) { // jen_kel ?>
    <?php if ($Page->SortUrl($Page->jen_kel) == "") { ?>
        <th class="<?= $Page->jen_kel->headerCellClass() ?>"><?= $Page->jen_kel->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->jen_kel->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->jen_kel->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->jen_kel->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->jen_kel->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->jen_kel->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <?php if ($Page->SortUrl($Page->keterangan) == "") { ?>
        <th class="<?= $Page->keterangan->headerCellClass() ?>"><?= $Page->keterangan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->keterangan->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->keterangan->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->keterangan->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->keterangan->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->keterangan->getSortIcon() ?></span>
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
<?php if ($Page->nama->Visible) { // nama ?>
        <!-- nama -->
        <td<?= $Page->nama->cellAttributes() ?>>
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->hp->Visible) { // hp ?>
        <!-- hp -->
        <td<?= $Page->hp->cellAttributes() ?>>
<span<?= $Page->hp->viewAttributes() ?>>
<?= $Page->hp->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->hubungan->Visible) { // hubungan ?>
        <!-- hubungan -->
        <td<?= $Page->hubungan->cellAttributes() ?>>
<span<?= $Page->hubungan->viewAttributes() ?>>
<?= $Page->hubungan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tgl_lahir->Visible) { // tgl_lahir ?>
        <!-- tgl_lahir -->
        <td<?= $Page->tgl_lahir->cellAttributes() ?>>
<span<?= $Page->tgl_lahir->viewAttributes() ?>>
<?= $Page->tgl_lahir->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->jen_kel->Visible) { // jen_kel ?>
        <!-- jen_kel -->
        <td<?= $Page->jen_kel->cellAttributes() ?>>
<span<?= $Page->jen_kel->viewAttributes() ?>>
<?= $Page->jen_kel->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <!-- keterangan -->
        <td<?= $Page->keterangan->cellAttributes() ?>>
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
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
