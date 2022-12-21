<?php

namespace PHPMaker2022\sigap;

// Page object
$GajitunjanganPreview = &$Page;
?>
<script>
ew.deepAssign(ew.vars, { tables: { gajitunjangan: <?= JsonEncode($Page->toClientVar()) ?> } });
</script>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid gajitunjangan"><!-- .card -->
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
<?php if ($Page->gapok->Visible) { // gapok ?>
    <?php if ($Page->SortUrl($Page->gapok) == "") { ?>
        <th class="<?= $Page->gapok->headerCellClass() ?>"><?= $Page->gapok->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->gapok->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->gapok->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->gapok->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->gapok->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->gapok->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->value_kehadiran->Visible) { // value_kehadiran ?>
    <?php if ($Page->SortUrl($Page->value_kehadiran) == "") { ?>
        <th class="<?= $Page->value_kehadiran->headerCellClass() ?>"><?= $Page->value_kehadiran->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->value_kehadiran->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->value_kehadiran->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->value_kehadiran->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->value_kehadiran->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->value_kehadiran->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
    <?php if ($Page->SortUrl($Page->tunjangan_jabatan) == "") { ?>
        <th class="<?= $Page->tunjangan_jabatan->headerCellClass() ?>"><?= $Page->tunjangan_jabatan->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tunjangan_jabatan->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->tunjangan_jabatan->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->tunjangan_jabatan->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->tunjangan_jabatan->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->tunjangan_jabatan->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
    <?php if ($Page->SortUrl($Page->tunjangan_khusus) == "") { ?>
        <th class="<?= $Page->tunjangan_khusus->headerCellClass() ?>"><?= $Page->tunjangan_khusus->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tunjangan_khusus->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->tunjangan_khusus->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->tunjangan_khusus->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->tunjangan_khusus->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->tunjangan_khusus->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->reward->Visible) { // reward ?>
    <?php if ($Page->SortUrl($Page->reward) == "") { ?>
        <th class="<?= $Page->reward->headerCellClass() ?>"><?= $Page->reward->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->reward->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->reward->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->reward->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->reward->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->reward->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->lembur->Visible) { // lembur ?>
    <?php if ($Page->SortUrl($Page->lembur) == "") { ?>
        <th class="<?= $Page->lembur->headerCellClass() ?>"><?= $Page->lembur->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->lembur->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->lembur->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->lembur->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->lembur->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->lembur->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->piket->Visible) { // piket ?>
    <?php if ($Page->SortUrl($Page->piket) == "") { ?>
        <th class="<?= $Page->piket->headerCellClass() ?>"><?= $Page->piket->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->piket->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->piket->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->piket->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->piket->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->piket->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->inval->Visible) { // inval ?>
    <?php if ($Page->SortUrl($Page->inval) == "") { ?>
        <th class="<?= $Page->inval->headerCellClass() ?>"><?= $Page->inval->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->inval->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->inval->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->inval->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->inval->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->inval->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->jam_lebih->Visible) { // jam_lebih ?>
    <?php if ($Page->SortUrl($Page->jam_lebih) == "") { ?>
        <th class="<?= $Page->jam_lebih->headerCellClass() ?>"><?= $Page->jam_lebih->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->jam_lebih->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->jam_lebih->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->jam_lebih->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->jam_lebih->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->jam_lebih->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->ekstrakuri->Visible) { // ekstrakuri ?>
    <?php if ($Page->SortUrl($Page->ekstrakuri) == "") { ?>
        <th class="<?= $Page->ekstrakuri->headerCellClass() ?>"><?= $Page->ekstrakuri->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->ekstrakuri->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->ekstrakuri->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->ekstrakuri->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->ekstrakuri->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->ekstrakuri->getSortIcon() ?></span>
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
<?php if ($Page->gapok->Visible) { // gapok ?>
        <!-- gapok -->
        <td<?= $Page->gapok->cellAttributes() ?>>
<span<?= $Page->gapok->viewAttributes() ?>>
<?= $Page->gapok->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->value_kehadiran->Visible) { // value_kehadiran ?>
        <!-- value_kehadiran -->
        <td<?= $Page->value_kehadiran->cellAttributes() ?>>
<span<?= $Page->value_kehadiran->viewAttributes() ?>>
<?= $Page->value_kehadiran->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
        <!-- tunjangan_jabatan -->
        <td<?= $Page->tunjangan_jabatan->cellAttributes() ?>>
<span<?= $Page->tunjangan_jabatan->viewAttributes() ?>>
<?= $Page->tunjangan_jabatan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
        <!-- tunjangan_khusus -->
        <td<?= $Page->tunjangan_khusus->cellAttributes() ?>>
<span<?= $Page->tunjangan_khusus->viewAttributes() ?>>
<?= $Page->tunjangan_khusus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->reward->Visible) { // reward ?>
        <!-- reward -->
        <td<?= $Page->reward->cellAttributes() ?>>
<span<?= $Page->reward->viewAttributes() ?>>
<?= $Page->reward->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->lembur->Visible) { // lembur ?>
        <!-- lembur -->
        <td<?= $Page->lembur->cellAttributes() ?>>
<span<?= $Page->lembur->viewAttributes() ?>>
<?= $Page->lembur->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->piket->Visible) { // piket ?>
        <!-- piket -->
        <td<?= $Page->piket->cellAttributes() ?>>
<span<?= $Page->piket->viewAttributes() ?>>
<?= $Page->piket->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->inval->Visible) { // inval ?>
        <!-- inval -->
        <td<?= $Page->inval->cellAttributes() ?>>
<span<?= $Page->inval->viewAttributes() ?>>
<?= $Page->inval->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->jam_lebih->Visible) { // jam_lebih ?>
        <!-- jam_lebih -->
        <td<?= $Page->jam_lebih->cellAttributes() ?>>
<span<?= $Page->jam_lebih->viewAttributes() ?>>
<?= $Page->jam_lebih->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ekstrakuri->Visible) { // ekstrakuri ?>
        <!-- ekstrakuri -->
        <td<?= $Page->ekstrakuri->cellAttributes() ?>>
<span<?= $Page->ekstrakuri->viewAttributes() ?>>
<?= $Page->ekstrakuri->getViewValue() ?></span>
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
