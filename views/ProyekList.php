<?php

namespace PHPMaker2022\sigap;

// Page object
$ProyekList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { proyek: currentTable } });
var currentForm, currentPageID;
var fproyeklist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fproyeklist = new ew.Form("fproyeklist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fproyeklist;
    fproyeklist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fproyeklist");
});
var fproyeksrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fproyeksrch = new ew.Form("fproyeksrch", "list");
    currentSearchForm = fproyeksrch;

    // Dynamic selection lists

    // Filters
    fproyeksrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fproyeksrch");
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
<form name="fproyeksrch" id="fproyeksrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fproyeksrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="proyek">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fproyeksrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fproyeksrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fproyeksrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fproyeksrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> proyek">
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
<form name="fproyeklist" id="fproyeklist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="proyek">
<div id="gmp_proyek" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_proyeklist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->klien->Visible) { // klien ?>
        <th data-name="klien" class="<?= $Page->klien->headerCellClass() ?>"><div id="elh_proyek_klien" class="proyek_klien"><?= $Page->renderFieldHeader($Page->klien) ?></div></th>
<?php } ?>
<?php if ($Page->proyek->Visible) { // proyek ?>
        <th data-name="proyek" class="<?= $Page->proyek->headerCellClass() ?>"><div id="elh_proyek_proyek" class="proyek_proyek"><?= $Page->renderFieldHeader($Page->proyek) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_awal->Visible) { // tgl_awal ?>
        <th data-name="tgl_awal" class="<?= $Page->tgl_awal->headerCellClass() ?>"><div id="elh_proyek_tgl_awal" class="proyek_tgl_awal"><?= $Page->renderFieldHeader($Page->tgl_awal) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_akhir->Visible) { // tgl_akhir ?>
        <th data-name="tgl_akhir" class="<?= $Page->tgl_akhir->headerCellClass() ?>"><div id="elh_proyek_tgl_akhir" class="proyek_tgl_akhir"><?= $Page->renderFieldHeader($Page->tgl_akhir) ?></div></th>
<?php } ?>
<?php if ($Page->file_proyek->Visible) { // file_proyek ?>
        <th data-name="file_proyek" class="<?= $Page->file_proyek->headerCellClass() ?>"><div id="elh_proyek_file_proyek" class="proyek_file_proyek"><?= $Page->renderFieldHeader($Page->file_proyek) ?></div></th>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
        <th data-name="aktif" class="<?= $Page->aktif->headerCellClass() ?>"><div id="elh_proyek_aktif" class="proyek_aktif"><?= $Page->renderFieldHeader($Page->aktif) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_proyek",
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
    <?php if ($Page->klien->Visible) { // klien ?>
        <td data-name="klien"<?= $Page->klien->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_klien" class="el_proyek_klien">
<span<?= $Page->klien->viewAttributes() ?>>
<?= $Page->klien->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->proyek->Visible) { // proyek ?>
        <td data-name="proyek"<?= $Page->proyek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_proyek" class="el_proyek_proyek">
<span<?= $Page->proyek->viewAttributes() ?>>
<?= $Page->proyek->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_awal->Visible) { // tgl_awal ?>
        <td data-name="tgl_awal"<?= $Page->tgl_awal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_tgl_awal" class="el_proyek_tgl_awal">
<span<?= $Page->tgl_awal->viewAttributes() ?>>
<?= $Page->tgl_awal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_akhir->Visible) { // tgl_akhir ?>
        <td data-name="tgl_akhir"<?= $Page->tgl_akhir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_tgl_akhir" class="el_proyek_tgl_akhir">
<span<?= $Page->tgl_akhir->viewAttributes() ?>>
<?= $Page->tgl_akhir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->file_proyek->Visible) { // file_proyek ?>
        <td data-name="file_proyek"<?= $Page->file_proyek->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_file_proyek" class="el_proyek_file_proyek">
<span<?= $Page->file_proyek->viewAttributes() ?>>
<?= GetFileViewTag($Page->file_proyek, $Page->file_proyek->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->aktif->Visible) { // aktif ?>
        <td data-name="aktif"<?= $Page->aktif->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_proyek_aktif" class="el_proyek_aktif">
<span<?= $Page->aktif->viewAttributes() ?>>
<?= $Page->aktif->getViewValue() ?></span>
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
    ew.addEventHandlers("proyek");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
