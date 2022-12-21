<?php

namespace PHPMaker2022\sigap;

// Page object
$DaftarbarangList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { daftarbarang: currentTable } });
var currentForm, currentPageID;
var fdaftarbaranglist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdaftarbaranglist = new ew.Form("fdaftarbaranglist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fdaftarbaranglist;
    fdaftarbaranglist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fdaftarbaranglist");
});
var fdaftarbarangsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fdaftarbarangsrch = new ew.Form("fdaftarbarangsrch", "list");
    currentSearchForm = fdaftarbarangsrch;

    // Dynamic selection lists

    // Filters
    fdaftarbarangsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fdaftarbarangsrch");
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
<form name="fdaftarbarangsrch" id="fdaftarbarangsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fdaftarbarangsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="daftarbarang">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fdaftarbarangsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fdaftarbarangsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fdaftarbarangsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fdaftarbarangsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> daftarbarang">
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
<form name="fdaftarbaranglist" id="fdaftarbaranglist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="daftarbarang">
<div id="gmp_daftarbarang" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_daftarbaranglist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->nama->Visible) { // nama ?>
        <th data-name="nama" class="<?= $Page->nama->headerCellClass() ?>"><div id="elh_daftarbarang_nama" class="daftarbarang_nama"><?= $Page->renderFieldHeader($Page->nama) ?></div></th>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <th data-name="jenis" class="<?= $Page->jenis->headerCellClass() ?>"><div id="elh_daftarbarang_jenis" class="daftarbarang_jenis"><?= $Page->renderFieldHeader($Page->jenis) ?></div></th>
<?php } ?>
<?php if ($Page->sepsifikasi->Visible) { // sepsifikasi ?>
        <th data-name="sepsifikasi" class="<?= $Page->sepsifikasi->headerCellClass() ?>"><div id="elh_daftarbarang_sepsifikasi" class="daftarbarang_sepsifikasi"><?= $Page->renderFieldHeader($Page->sepsifikasi) ?></div></th>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
        <th data-name="deskripsi" class="<?= $Page->deskripsi->headerCellClass() ?>"><div id="elh_daftarbarang_deskripsi" class="daftarbarang_deskripsi"><?= $Page->renderFieldHeader($Page->deskripsi) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_terima->Visible) { // tgl_terima ?>
        <th data-name="tgl_terima" class="<?= $Page->tgl_terima->headerCellClass() ?>"><div id="elh_daftarbarang_tgl_terima" class="daftarbarang_tgl_terima"><?= $Page->renderFieldHeader($Page->tgl_terima) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_beli->Visible) { // tgl_beli ?>
        <th data-name="tgl_beli" class="<?= $Page->tgl_beli->headerCellClass() ?>"><div id="elh_daftarbarang_tgl_beli" class="daftarbarang_tgl_beli"><?= $Page->renderFieldHeader($Page->tgl_beli) ?></div></th>
<?php } ?>
<?php if ($Page->harga->Visible) { // harga ?>
        <th data-name="harga" class="<?= $Page->harga->headerCellClass() ?>"><div id="elh_daftarbarang_harga" class="daftarbarang_harga"><?= $Page->renderFieldHeader($Page->harga) ?></div></th>
<?php } ?>
<?php if ($Page->pemegang->Visible) { // pemegang ?>
        <th data-name="pemegang" class="<?= $Page->pemegang->headerCellClass() ?>"><div id="elh_daftarbarang_pemegang" class="daftarbarang_pemegang"><?= $Page->renderFieldHeader($Page->pemegang) ?></div></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th data-name="keterangan" class="<?= $Page->keterangan->headerCellClass() ?>"><div id="elh_daftarbarang_keterangan" class="daftarbarang_keterangan"><?= $Page->renderFieldHeader($Page->keterangan) ?></div></th>
<?php } ?>
<?php if ($Page->foto->Visible) { // foto ?>
        <th data-name="foto" class="<?= $Page->foto->headerCellClass() ?>"><div id="elh_daftarbarang_foto" class="daftarbarang_foto"><?= $Page->renderFieldHeader($Page->foto) ?></div></th>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
        <th data-name="dokumen" class="<?= $Page->dokumen->headerCellClass() ?>"><div id="elh_daftarbarang_dokumen" class="daftarbarang_dokumen"><?= $Page->renderFieldHeader($Page->dokumen) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_daftarbarang_status" class="daftarbarang_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_daftarbarang",
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
    <?php if ($Page->nama->Visible) { // nama ?>
        <td data-name="nama"<?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_nama" class="el_daftarbarang_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jenis->Visible) { // jenis ?>
        <td data-name="jenis"<?= $Page->jenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_jenis" class="el_daftarbarang_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sepsifikasi->Visible) { // sepsifikasi ?>
        <td data-name="sepsifikasi"<?= $Page->sepsifikasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_sepsifikasi" class="el_daftarbarang_sepsifikasi">
<span<?= $Page->sepsifikasi->viewAttributes() ?>>
<?= $Page->sepsifikasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->deskripsi->Visible) { // deskripsi ?>
        <td data-name="deskripsi"<?= $Page->deskripsi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_deskripsi" class="el_daftarbarang_deskripsi">
<span<?= $Page->deskripsi->viewAttributes() ?>>
<?= $Page->deskripsi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_terima->Visible) { // tgl_terima ?>
        <td data-name="tgl_terima"<?= $Page->tgl_terima->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_tgl_terima" class="el_daftarbarang_tgl_terima">
<span<?= $Page->tgl_terima->viewAttributes() ?>>
<?= $Page->tgl_terima->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_beli->Visible) { // tgl_beli ?>
        <td data-name="tgl_beli"<?= $Page->tgl_beli->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_tgl_beli" class="el_daftarbarang_tgl_beli">
<span<?= $Page->tgl_beli->viewAttributes() ?>>
<?= $Page->tgl_beli->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->harga->Visible) { // harga ?>
        <td data-name="harga"<?= $Page->harga->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_harga" class="el_daftarbarang_harga">
<span<?= $Page->harga->viewAttributes() ?>>
<?= $Page->harga->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pemegang->Visible) { // pemegang ?>
        <td data-name="pemegang"<?= $Page->pemegang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_pemegang" class="el_daftarbarang_pemegang">
<span<?= $Page->pemegang->viewAttributes() ?>>
<?= $Page->pemegang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_keterangan" class="el_daftarbarang_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->foto->Visible) { // foto ?>
        <td data-name="foto"<?= $Page->foto->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_foto" class="el_daftarbarang_foto">
<span<?= $Page->foto->viewAttributes() ?>>
<?= GetFileViewTag($Page->foto, $Page->foto->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dokumen->Visible) { // dokumen ?>
        <td data-name="dokumen"<?= $Page->dokumen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_dokumen" class="el_daftarbarang_dokumen">
<span<?= $Page->dokumen->viewAttributes() ?>>
<?= GetFileViewTag($Page->dokumen, $Page->dokumen->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_daftarbarang_status" class="el_daftarbarang_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
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
    ew.addEventHandlers("daftarbarang");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
