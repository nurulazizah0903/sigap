<?php

namespace PHPMaker2022\sigap;

// Page object
$PegDokumenPreview = &$Page;
?>
<script>
ew.deepAssign(ew.vars, { tables: { peg_dokumen: <?= JsonEncode($Page->toClientVar()) ?> } });
</script>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid peg_dokumen"><!-- .card -->
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
<?php if ($Page->c_by->Visible) { // c_by ?>
    <?php if ($Page->SortUrl($Page->c_by) == "") { ?>
        <th class="<?= $Page->c_by->headerCellClass() ?>"><?= $Page->c_by->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->c_by->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->c_by->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->c_by->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->c_by->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->c_by->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->nama_dokumen->Visible) { // nama_dokumen ?>
    <?php if ($Page->SortUrl($Page->nama_dokumen) == "") { ?>
        <th class="<?= $Page->nama_dokumen->headerCellClass() ?>"><?= $Page->nama_dokumen->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->nama_dokumen->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->nama_dokumen->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->nama_dokumen->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->nama_dokumen->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->nama_dokumen->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->file_dokumen->Visible) { // file_dokumen ?>
    <?php if ($Page->SortUrl($Page->file_dokumen) == "") { ?>
        <th class="<?= $Page->file_dokumen->headerCellClass() ?>"><?= $Page->file_dokumen->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->file_dokumen->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->file_dokumen->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->file_dokumen->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->file_dokumen->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->file_dokumen->getSortIcon() ?></span>
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
<?php if ($Page->c_date->Visible) { // c_date ?>
    <?php if ($Page->SortUrl($Page->c_date) == "") { ?>
        <th class="<?= $Page->c_date->headerCellClass() ?>"><?= $Page->c_date->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->c_date->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->c_date->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->c_date->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->c_date->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->c_date->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->u_date->Visible) { // u_date ?>
    <?php if ($Page->SortUrl($Page->u_date) == "") { ?>
        <th class="<?= $Page->u_date->headerCellClass() ?>"><?= $Page->u_date->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->u_date->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->u_date->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->u_date->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->u_date->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->u_date->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
    <?php if ($Page->SortUrl($Page->u_by) == "") { ?>
        <th class="<?= $Page->u_by->headerCellClass() ?>"><?= $Page->u_by->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->u_by->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->u_by->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->u_by->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->u_by->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->u_by->getSortIcon() ?></span>
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
<?php if ($Page->c_by->Visible) { // c_by ?>
        <!-- c_by -->
        <td<?= $Page->c_by->cellAttributes() ?>>
<span<?= $Page->c_by->viewAttributes() ?>>
<?= $Page->c_by->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nama_dokumen->Visible) { // nama_dokumen ?>
        <!-- nama_dokumen -->
        <td<?= $Page->nama_dokumen->cellAttributes() ?>>
<span<?= $Page->nama_dokumen->viewAttributes() ?>>
<?= $Page->nama_dokumen->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->file_dokumen->Visible) { // file_dokumen ?>
        <!-- file_dokumen -->
        <td<?= $Page->file_dokumen->cellAttributes() ?>>
<span<?= $Page->file_dokumen->viewAttributes() ?>>
<?= GetFileViewTag($Page->file_dokumen, $Page->file_dokumen->getViewValue(), false) ?>
</span>
</td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <!-- keterangan -->
        <td<?= $Page->keterangan->cellAttributes() ?>>
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
        <!-- c_date -->
        <td<?= $Page->c_date->cellAttributes() ?>>
<span<?= $Page->c_date->viewAttributes() ?>>
<?= $Page->c_date->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->u_date->Visible) { // u_date ?>
        <!-- u_date -->
        <td<?= $Page->u_date->cellAttributes() ?>>
<span<?= $Page->u_date->viewAttributes() ?>>
<?= $Page->u_date->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
        <!-- u_by -->
        <td<?= $Page->u_by->cellAttributes() ?>>
<span<?= $Page->u_by->viewAttributes() ?>>
<?= $Page->u_by->getViewValue() ?></span>
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
