<?php

namespace PHPMaker2022\sigap;

// Page object
$ReimburshList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { reimbursh: currentTable } });
var currentForm, currentPageID;
var freimburshlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    freimburshlist = new ew.Form("freimburshlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = freimburshlist;
    freimburshlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("freimburshlist");
});
var freimburshsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    freimburshsrch = new ew.Form("freimburshsrch", "list");
    currentSearchForm = freimburshsrch;

    // Dynamic selection lists

    // Filters
    freimburshsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("freimburshsrch");
});
</script>
<script>
ew.PREVIEW_SELECTOR = ".ew-preview-btn";
ew.PREVIEW_ROW = true;
ew.PREVIEW_SINGLE_ROW = false;
ew.ready("head", ew.PATH_BASE + "js/preview.min.js", "preview");
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="freimburshsrch" id="freimburshsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="freimburshsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="reimbursh">
<div class="ew-extended-search container-fluid">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="freimburshsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="freimburshsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="freimburshsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="freimburshsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> reimbursh">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
</div>
<?php } ?>
<form name="freimburshlist" id="freimburshlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="reimbursh">
<div id="gmp_reimbursh" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_reimburshlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
        <th data-name="pegawai" class="<?= $Page->pegawai->headerCellClass() ?>"><div id="elh_reimbursh_pegawai" class="reimbursh_pegawai"><?= $Page->renderFieldHeader($Page->pegawai) ?></div></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th data-name="nama" class="<?= $Page->nama->headerCellClass() ?>"><div id="elh_reimbursh_nama" class="reimbursh_nama"><?= $Page->renderFieldHeader($Page->nama) ?></div></th>
<?php } ?>
<?php if ($Page->tgl->Visible) { // tgl ?>
        <th data-name="tgl" class="<?= $Page->tgl->headerCellClass() ?>"><div id="elh_reimbursh_tgl" class="reimbursh_tgl"><?= $Page->renderFieldHeader($Page->tgl) ?></div></th>
<?php } ?>
<?php if ($Page->total_pengajuan->Visible) { // total_pengajuan ?>
        <th data-name="total_pengajuan" class="<?= $Page->total_pengajuan->headerCellClass() ?>"><div id="elh_reimbursh_total_pengajuan" class="reimbursh_total_pengajuan"><?= $Page->renderFieldHeader($Page->total_pengajuan) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_pengajuan->Visible) { // tgl_pengajuan ?>
        <th data-name="tgl_pengajuan" class="<?= $Page->tgl_pengajuan->headerCellClass() ?>"><div id="elh_reimbursh_tgl_pengajuan" class="reimbursh_tgl_pengajuan"><?= $Page->renderFieldHeader($Page->tgl_pengajuan) ?></div></th>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <th data-name="jenis" class="<?= $Page->jenis->headerCellClass() ?>"><div id="elh_reimbursh_jenis" class="reimbursh_jenis"><?= $Page->renderFieldHeader($Page->jenis) ?></div></th>
<?php } ?>
<?php if ($Page->rek_tujuan->Visible) { // rek_tujuan ?>
        <th data-name="rek_tujuan" class="<?= $Page->rek_tujuan->headerCellClass() ?>"><div id="elh_reimbursh_rek_tujuan" class="reimbursh_rek_tujuan"><?= $Page->renderFieldHeader($Page->rek_tujuan) ?></div></th>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
        <th data-name="disetujui" class="<?= $Page->disetujui->headerCellClass() ?>"><div id="elh_reimbursh_disetujui" class="reimbursh_disetujui"><?= $Page->renderFieldHeader($Page->disetujui) ?></div></th>
<?php } ?>
<?php if ($Page->pembayar->Visible) { // pembayar ?>
        <th data-name="pembayar" class="<?= $Page->pembayar->headerCellClass() ?>"><div id="elh_reimbursh_pembayar" class="reimbursh_pembayar"><?= $Page->renderFieldHeader($Page->pembayar) ?></div></th>
<?php } ?>
<?php if ($Page->terbayar->Visible) { // terbayar ?>
        <th data-name="terbayar" class="<?= $Page->terbayar->headerCellClass() ?>"><div id="elh_reimbursh_terbayar" class="reimbursh_terbayar"><?= $Page->renderFieldHeader($Page->terbayar) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_pembayaran->Visible) { // tgl_pembayaran ?>
        <th data-name="tgl_pembayaran" class="<?= $Page->tgl_pembayaran->headerCellClass() ?>"><div id="elh_reimbursh_tgl_pembayaran" class="reimbursh_tgl_pembayaran"><?= $Page->renderFieldHeader($Page->tgl_pembayaran) ?></div></th>
<?php } ?>
<?php if ($Page->jumlah_dibayar->Visible) { // jumlah_dibayar ?>
        <th data-name="jumlah_dibayar" class="<?= $Page->jumlah_dibayar->headerCellClass() ?>"><div id="elh_reimbursh_jumlah_dibayar" class="reimbursh_jumlah_dibayar"><?= $Page->renderFieldHeader($Page->jumlah_dibayar) ?></div></th>
<?php } ?>
<?php if ($Page->bukti1->Visible) { // bukti1 ?>
        <th data-name="bukti1" class="<?= $Page->bukti1->headerCellClass() ?>"><div id="elh_reimbursh_bukti1" class="reimbursh_bukti1"><?= $Page->renderFieldHeader($Page->bukti1) ?></div></th>
<?php } ?>
<?php if ($Page->bukti2->Visible) { // bukti2 ?>
        <th data-name="bukti2" class="<?= $Page->bukti2->headerCellClass() ?>"><div id="elh_reimbursh_bukti2" class="reimbursh_bukti2"><?= $Page->renderFieldHeader($Page->bukti2) ?></div></th>
<?php } ?>
<?php if ($Page->bukti3->Visible) { // bukti3 ?>
        <th data-name="bukti3" class="<?= $Page->bukti3->headerCellClass() ?>"><div id="elh_reimbursh_bukti3" class="reimbursh_bukti3"><?= $Page->renderFieldHeader($Page->bukti3) ?></div></th>
<?php } ?>
<?php if ($Page->bukti4->Visible) { // bukti4 ?>
        <th data-name="bukti4" class="<?= $Page->bukti4->headerCellClass() ?>"><div id="elh_reimbursh_bukti4" class="reimbursh_bukti4"><?= $Page->renderFieldHeader($Page->bukti4) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif ($Page->isGridAdd() && !$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_reimbursh",
            "data-rowtype" => $Page->RowType,
            "class" => ($Page->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Page->isAdd() && $Page->RowType == ROWTYPE_ADD || $Page->isEdit() && $Page->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Page->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->pegawai->Visible) { // pegawai ?>
        <td data-name="pegawai"<?= $Page->pegawai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_pegawai" class="el_reimbursh_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama->Visible) { // nama ?>
        <td data-name="nama"<?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_nama" class="el_reimbursh_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl->Visible) { // tgl ?>
        <td data-name="tgl"<?= $Page->tgl->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_tgl" class="el_reimbursh_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total_pengajuan->Visible) { // total_pengajuan ?>
        <td data-name="total_pengajuan"<?= $Page->total_pengajuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_total_pengajuan" class="el_reimbursh_total_pengajuan">
<span<?= $Page->total_pengajuan->viewAttributes() ?>>
<?= $Page->total_pengajuan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_pengajuan->Visible) { // tgl_pengajuan ?>
        <td data-name="tgl_pengajuan"<?= $Page->tgl_pengajuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_tgl_pengajuan" class="el_reimbursh_tgl_pengajuan">
<span<?= $Page->tgl_pengajuan->viewAttributes() ?>>
<?= $Page->tgl_pengajuan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jenis->Visible) { // jenis ?>
        <td data-name="jenis"<?= $Page->jenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_jenis" class="el_reimbursh_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rek_tujuan->Visible) { // rek_tujuan ?>
        <td data-name="rek_tujuan"<?= $Page->rek_tujuan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_rek_tujuan" class="el_reimbursh_rek_tujuan">
<span<?= $Page->rek_tujuan->viewAttributes() ?>>
<?= $Page->rek_tujuan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->disetujui->Visible) { // disetujui ?>
        <td data-name="disetujui"<?= $Page->disetujui->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_disetujui" class="el_reimbursh_disetujui">
<span<?= $Page->disetujui->viewAttributes() ?>>
<?= $Page->disetujui->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pembayar->Visible) { // pembayar ?>
        <td data-name="pembayar"<?= $Page->pembayar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_pembayar" class="el_reimbursh_pembayar">
<span<?= $Page->pembayar->viewAttributes() ?>>
<?= $Page->pembayar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->terbayar->Visible) { // terbayar ?>
        <td data-name="terbayar"<?= $Page->terbayar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_terbayar" class="el_reimbursh_terbayar">
<span<?= $Page->terbayar->viewAttributes() ?>>
<?= $Page->terbayar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_pembayaran->Visible) { // tgl_pembayaran ?>
        <td data-name="tgl_pembayaran"<?= $Page->tgl_pembayaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_tgl_pembayaran" class="el_reimbursh_tgl_pembayaran">
<span<?= $Page->tgl_pembayaran->viewAttributes() ?>>
<?= $Page->tgl_pembayaran->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jumlah_dibayar->Visible) { // jumlah_dibayar ?>
        <td data-name="jumlah_dibayar"<?= $Page->jumlah_dibayar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_jumlah_dibayar" class="el_reimbursh_jumlah_dibayar">
<span<?= $Page->jumlah_dibayar->viewAttributes() ?>>
<?= $Page->jumlah_dibayar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bukti1->Visible) { // bukti1 ?>
        <td data-name="bukti1"<?= $Page->bukti1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_bukti1" class="el_reimbursh_bukti1">
<span<?= $Page->bukti1->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti1, $Page->bukti1->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bukti2->Visible) { // bukti2 ?>
        <td data-name="bukti2"<?= $Page->bukti2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_bukti2" class="el_reimbursh_bukti2">
<span<?= $Page->bukti2->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti2, $Page->bukti2->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bukti3->Visible) { // bukti3 ?>
        <td data-name="bukti3"<?= $Page->bukti3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_bukti3" class="el_reimbursh_bukti3">
<span<?= $Page->bukti3->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti3, $Page->bukti3->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bukti4->Visible) { // bukti4 ?>
        <td data-name="bukti4"<?= $Page->bukti4->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_reimbursh_bukti4" class="el_reimbursh_bukti4">
<span<?= $Page->bukti4->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti4, $Page->bukti4->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("reimbursh");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
