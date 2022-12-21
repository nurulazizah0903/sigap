<?php

namespace PHPMaker2022\sigap;

// Page object
$GajisdDetilPreview = &$Page;
?>
<script>
ew.deepAssign(ew.vars, { tables: { gajisd_detil: <?= JsonEncode($Page->toClientVar()) ?> } });
</script>
<?php $Page->showPageHeader(); ?>
<?php if ($Page->TotalRecords > 0) { ?>
<div class="card ew-grid gajisd_detil"><!-- .card -->
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
<?php if ($Page->pegawai_id->Visible) { // pegawai_id ?>
    <?php if ($Page->SortUrl($Page->pegawai_id) == "") { ?>
        <th class="<?= $Page->pegawai_id->headerCellClass() ?>"><?= $Page->pegawai_id->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->pegawai_id->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->pegawai_id->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->pegawai_id->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->pegawai_id->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->pegawai_id->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
    <?php if ($Page->SortUrl($Page->jabatan_id) == "") { ?>
        <th class="<?= $Page->jabatan_id->headerCellClass() ?>"><?= $Page->jabatan_id->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->jabatan_id->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->jabatan_id->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->jabatan_id->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->jabatan_id->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->jabatan_id->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->masakerja->Visible) { // masakerja ?>
    <?php if ($Page->SortUrl($Page->masakerja) == "") { ?>
        <th class="<?= $Page->masakerja->headerCellClass() ?>"><?= $Page->masakerja->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->masakerja->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->masakerja->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->masakerja->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->masakerja->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->masakerja->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->jumngajar->Visible) { // jumngajar ?>
    <?php if ($Page->SortUrl($Page->jumngajar) == "") { ?>
        <th class="<?= $Page->jumngajar->headerCellClass() ?>"><?= $Page->jumngajar->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->jumngajar->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->jumngajar->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->jumngajar->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->jumngajar->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->jumngajar->getSortIcon() ?></span>
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
<?php if ($Page->baku->Visible) { // baku ?>
    <?php if ($Page->SortUrl($Page->baku) == "") { ?>
        <th class="<?= $Page->baku->headerCellClass() ?>"><?= $Page->baku->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->baku->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->baku->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->baku->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->baku->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->baku->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->kehadiran->Visible) { // kehadiran ?>
    <?php if ($Page->SortUrl($Page->kehadiran) == "") { ?>
        <th class="<?= $Page->kehadiran->headerCellClass() ?>"><?= $Page->kehadiran->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->kehadiran->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->kehadiran->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->kehadiran->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->kehadiran->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->kehadiran->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->prestasi->Visible) { // prestasi ?>
    <?php if ($Page->SortUrl($Page->prestasi) == "") { ?>
        <th class="<?= $Page->prestasi->headerCellClass() ?>"><?= $Page->prestasi->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->prestasi->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->prestasi->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->prestasi->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->prestasi->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->prestasi->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->nominal_baku->Visible) { // nominal_baku ?>
    <?php if ($Page->SortUrl($Page->nominal_baku) == "") { ?>
        <th class="<?= $Page->nominal_baku->headerCellClass() ?>"><?= $Page->nominal_baku->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->nominal_baku->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->nominal_baku->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->nominal_baku->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->nominal_baku->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->nominal_baku->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->jumlahterima->Visible) { // jumlahterima ?>
    <?php if ($Page->SortUrl($Page->jumlahterima) == "") { ?>
        <th class="<?= $Page->jumlahterima->headerCellClass() ?>"><?= $Page->jumlahterima->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->jumlahterima->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->jumlahterima->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->jumlahterima->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->jumlahterima->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->jumlahterima->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
    <?php if ($Page->SortUrl($Page->tunjangan_wkosis) == "") { ?>
        <th class="<?= $Page->tunjangan_wkosis->headerCellClass() ?>"><?= $Page->tunjangan_wkosis->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->tunjangan_wkosis->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->tunjangan_wkosis->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->tunjangan_wkosis->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->tunjangan_wkosis->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->tunjangan_wkosis->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->potongan1->Visible) { // potongan1 ?>
    <?php if ($Page->SortUrl($Page->potongan1) == "") { ?>
        <th class="<?= $Page->potongan1->headerCellClass() ?>"><?= $Page->potongan1->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->potongan1->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->potongan1->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->potongan1->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->potongan1->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->potongan1->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->potongan2->Visible) { // potongan2 ?>
    <?php if ($Page->SortUrl($Page->potongan2) == "") { ?>
        <th class="<?= $Page->potongan2->headerCellClass() ?>"><?= $Page->potongan2->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->potongan2->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->potongan2->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->potongan2->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->potongan2->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->potongan2->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->jumlahgaji->Visible) { // jumlahgaji ?>
    <?php if ($Page->SortUrl($Page->jumlahgaji) == "") { ?>
        <th class="<?= $Page->jumlahgaji->headerCellClass() ?>"><?= $Page->jumlahgaji->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->jumlahgaji->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->jumlahgaji->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->jumlahgaji->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->jumlahgaji->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->jumlahgaji->getSortIcon() ?></span>
            </div>
        </th>
    <?php } ?>
<?php } ?>
<?php if ($Page->jumgajitotal->Visible) { // jumgajitotal ?>
    <?php if ($Page->SortUrl($Page->jumgajitotal) == "") { ?>
        <th class="<?= $Page->jumgajitotal->headerCellClass() ?>"><?= $Page->jumgajitotal->caption() ?></th>
    <?php } else { ?>
        <th class="<?= $Page->jumgajitotal->headerCellClass() ?>"><div role="button" data-sort="<?= HtmlEncode($Page->jumgajitotal->Name) ?>" data-sort-type="1" data-sort-order="<?= $Page->jumgajitotal->getNextSort() ?>">
            <div class="ew-table-header-btn">
                <span class="ew-table-header-caption"><?= $Page->jumgajitotal->caption() ?></span>
                <span class="ew-table-header-sort"><?= $Page->jumgajitotal->getSortIcon() ?></span>
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
<?php if ($Page->pegawai_id->Visible) { // pegawai_id ?>
        <!-- pegawai_id -->
        <td<?= $Page->pegawai_id->cellAttributes() ?>>
<span<?= $Page->pegawai_id->viewAttributes() ?>>
<?= $Page->pegawai_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <!-- jabatan_id -->
        <td<?= $Page->jabatan_id->cellAttributes() ?>>
<span<?= $Page->jabatan_id->viewAttributes() ?>>
<?= $Page->jabatan_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->masakerja->Visible) { // masakerja ?>
        <!-- masakerja -->
        <td<?= $Page->masakerja->cellAttributes() ?>>
<span<?= $Page->masakerja->viewAttributes() ?>>
<?= $Page->masakerja->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->jumngajar->Visible) { // jumngajar ?>
        <!-- jumngajar -->
        <td<?= $Page->jumngajar->cellAttributes() ?>>
<span<?= $Page->jumngajar->viewAttributes() ?>>
<?= $Page->jumngajar->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->ijin->Visible) { // ijin ?>
        <!-- ijin -->
        <td<?= $Page->ijin->cellAttributes() ?>>
<span<?= $Page->ijin->viewAttributes() ?>>
<?= $Page->ijin->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->baku->Visible) { // baku ?>
        <!-- baku -->
        <td<?= $Page->baku->cellAttributes() ?>>
<span<?= $Page->baku->viewAttributes() ?>>
<?= $Page->baku->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->kehadiran->Visible) { // kehadiran ?>
        <!-- kehadiran -->
        <td<?= $Page->kehadiran->cellAttributes() ?>>
<span<?= $Page->kehadiran->viewAttributes() ?>>
<?= $Page->kehadiran->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->prestasi->Visible) { // prestasi ?>
        <!-- prestasi -->
        <td<?= $Page->prestasi->cellAttributes() ?>>
<span<?= $Page->prestasi->viewAttributes() ?>>
<?= $Page->prestasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->nominal_baku->Visible) { // nominal_baku ?>
        <!-- nominal_baku -->
        <td<?= $Page->nominal_baku->cellAttributes() ?>>
<span<?= $Page->nominal_baku->viewAttributes() ?>>
<?= $Page->nominal_baku->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->jumlahterima->Visible) { // jumlahterima ?>
        <!-- jumlahterima -->
        <td<?= $Page->jumlahterima->cellAttributes() ?>>
<span<?= $Page->jumlahterima->viewAttributes() ?>>
<?= $Page->jumlahterima->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
        <!-- tunjangan_wkosis -->
        <td<?= $Page->tunjangan_wkosis->cellAttributes() ?>>
<span<?= $Page->tunjangan_wkosis->viewAttributes() ?>>
<?= $Page->tunjangan_wkosis->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->potongan1->Visible) { // potongan1 ?>
        <!-- potongan1 -->
        <td<?= $Page->potongan1->cellAttributes() ?>>
<span<?= $Page->potongan1->viewAttributes() ?>>
<?= $Page->potongan1->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->potongan2->Visible) { // potongan2 ?>
        <!-- potongan2 -->
        <td<?= $Page->potongan2->cellAttributes() ?>>
<span<?= $Page->potongan2->viewAttributes() ?>>
<?= $Page->potongan2->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->jumlahgaji->Visible) { // jumlahgaji ?>
        <!-- jumlahgaji -->
        <td<?= $Page->jumlahgaji->cellAttributes() ?>>
<span<?= $Page->jumlahgaji->viewAttributes() ?>>
<?= $Page->jumlahgaji->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Page->jumgajitotal->Visible) { // jumgajitotal ?>
        <!-- jumgajitotal -->
        <td<?= $Page->jumgajitotal->cellAttributes() ?>>
<span<?= $Page->jumgajitotal->viewAttributes() ?>>
<?= $Page->jumgajitotal->getViewValue() ?></span>
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
