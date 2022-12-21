<?php

namespace PHPMaker2022\sigap;

// Page object
$UangmukaList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { uangmuka: currentTable } });
var currentForm, currentPageID;
var fuangmukalist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fuangmukalist = new ew.Form("fuangmukalist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fuangmukalist;
    fuangmukalist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fuangmukalist");
});
var fuangmukasrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fuangmukasrch = new ew.Form("fuangmukasrch", "list");
    currentSearchForm = fuangmukasrch;

    // Dynamic selection lists

    // Filters
    fuangmukasrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fuangmukasrch");
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
<form name="fuangmukasrch" id="fuangmukasrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fuangmukasrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="uangmuka">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fuangmukasrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fuangmukasrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fuangmukasrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fuangmukasrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> uangmuka">
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
<form name="fuangmukalist" id="fuangmukalist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="uangmuka">
<div id="gmp_uangmuka" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_uangmukalist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->tgl->Visible) { // tgl ?>
        <th data-name="tgl" class="<?= $Page->tgl->headerCellClass() ?>"><div id="elh_uangmuka_tgl" class="uangmuka_tgl"><?= $Page->renderFieldHeader($Page->tgl) ?></div></th>
<?php } ?>
<?php if ($Page->pembayar->Visible) { // pembayar ?>
        <th data-name="pembayar" class="<?= $Page->pembayar->headerCellClass() ?>"><div id="elh_uangmuka_pembayar" class="uangmuka_pembayar"><?= $Page->renderFieldHeader($Page->pembayar) ?></div></th>
<?php } ?>
<?php if ($Page->peruntukan->Visible) { // peruntukan ?>
        <th data-name="peruntukan" class="<?= $Page->peruntukan->headerCellClass() ?>"><div id="elh_uangmuka_peruntukan" class="uangmuka_peruntukan"><?= $Page->renderFieldHeader($Page->peruntukan) ?></div></th>
<?php } ?>
<?php if ($Page->penerima->Visible) { // penerima ?>
        <th data-name="penerima" class="<?= $Page->penerima->headerCellClass() ?>"><div id="elh_uangmuka_penerima" class="uangmuka_penerima"><?= $Page->renderFieldHeader($Page->penerima) ?></div></th>
<?php } ?>
<?php if ($Page->rek_penerima->Visible) { // rek_penerima ?>
        <th data-name="rek_penerima" class="<?= $Page->rek_penerima->headerCellClass() ?>"><div id="elh_uangmuka_rek_penerima" class="uangmuka_rek_penerima"><?= $Page->renderFieldHeader($Page->rek_penerima) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_terima->Visible) { // tgl_terima ?>
        <th data-name="tgl_terima" class="<?= $Page->tgl_terima->headerCellClass() ?>"><div id="elh_uangmuka_tgl_terima" class="uangmuka_tgl_terima"><?= $Page->renderFieldHeader($Page->tgl_terima) ?></div></th>
<?php } ?>
<?php if ($Page->total_terima->Visible) { // total_terima ?>
        <th data-name="total_terima" class="<?= $Page->total_terima->headerCellClass() ?>"><div id="elh_uangmuka_total_terima" class="uangmuka_total_terima"><?= $Page->renderFieldHeader($Page->total_terima) ?></div></th>
<?php } ?>
<?php if ($Page->tgl_tgjb->Visible) { // tgl_tgjb ?>
        <th data-name="tgl_tgjb" class="<?= $Page->tgl_tgjb->headerCellClass() ?>"><div id="elh_uangmuka_tgl_tgjb" class="uangmuka_tgl_tgjb"><?= $Page->renderFieldHeader($Page->tgl_tgjb) ?></div></th>
<?php } ?>
<?php if ($Page->jumlah_tgjb->Visible) { // jumlah_tgjb ?>
        <th data-name="jumlah_tgjb" class="<?= $Page->jumlah_tgjb->headerCellClass() ?>"><div id="elh_uangmuka_jumlah_tgjb" class="uangmuka_jumlah_tgjb"><?= $Page->renderFieldHeader($Page->jumlah_tgjb) ?></div></th>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
        <th data-name="jenis" class="<?= $Page->jenis->headerCellClass() ?>"><div id="elh_uangmuka_jenis" class="uangmuka_jenis"><?= $Page->renderFieldHeader($Page->jenis) ?></div></th>
<?php } ?>
<?php if ($Page->bukti1->Visible) { // bukti1 ?>
        <th data-name="bukti1" class="<?= $Page->bukti1->headerCellClass() ?>"><div id="elh_uangmuka_bukti1" class="uangmuka_bukti1"><?= $Page->renderFieldHeader($Page->bukti1) ?></div></th>
<?php } ?>
<?php if ($Page->bukti2->Visible) { // bukti2 ?>
        <th data-name="bukti2" class="<?= $Page->bukti2->headerCellClass() ?>"><div id="elh_uangmuka_bukti2" class="uangmuka_bukti2"><?= $Page->renderFieldHeader($Page->bukti2) ?></div></th>
<?php } ?>
<?php if ($Page->bukti3->Visible) { // bukti3 ?>
        <th data-name="bukti3" class="<?= $Page->bukti3->headerCellClass() ?>"><div id="elh_uangmuka_bukti3" class="uangmuka_bukti3"><?= $Page->renderFieldHeader($Page->bukti3) ?></div></th>
<?php } ?>
<?php if ($Page->bukti4->Visible) { // bukti4 ?>
        <th data-name="bukti4" class="<?= $Page->bukti4->headerCellClass() ?>"><div id="elh_uangmuka_bukti4" class="uangmuka_bukti4"><?= $Page->renderFieldHeader($Page->bukti4) ?></div></th>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
        <th data-name="disetujui" class="<?= $Page->disetujui->headerCellClass() ?>"><div id="elh_uangmuka_disetujui" class="uangmuka_disetujui"><?= $Page->renderFieldHeader($Page->disetujui) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_uangmuka_status" class="uangmuka_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_uangmuka",
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
    <?php if ($Page->tgl->Visible) { // tgl ?>
        <td data-name="tgl"<?= $Page->tgl->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_tgl" class="el_uangmuka_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pembayar->Visible) { // pembayar ?>
        <td data-name="pembayar"<?= $Page->pembayar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_pembayar" class="el_uangmuka_pembayar">
<span<?= $Page->pembayar->viewAttributes() ?>>
<?= $Page->pembayar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->peruntukan->Visible) { // peruntukan ?>
        <td data-name="peruntukan"<?= $Page->peruntukan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_peruntukan" class="el_uangmuka_peruntukan">
<span<?= $Page->peruntukan->viewAttributes() ?>>
<?= $Page->peruntukan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->penerima->Visible) { // penerima ?>
        <td data-name="penerima"<?= $Page->penerima->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_penerima" class="el_uangmuka_penerima">
<span<?= $Page->penerima->viewAttributes() ?>>
<?= $Page->penerima->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rek_penerima->Visible) { // rek_penerima ?>
        <td data-name="rek_penerima"<?= $Page->rek_penerima->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_rek_penerima" class="el_uangmuka_rek_penerima">
<span<?= $Page->rek_penerima->viewAttributes() ?>>
<?= $Page->rek_penerima->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_terima->Visible) { // tgl_terima ?>
        <td data-name="tgl_terima"<?= $Page->tgl_terima->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_tgl_terima" class="el_uangmuka_tgl_terima">
<span<?= $Page->tgl_terima->viewAttributes() ?>>
<?= $Page->tgl_terima->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total_terima->Visible) { // total_terima ?>
        <td data-name="total_terima"<?= $Page->total_terima->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_total_terima" class="el_uangmuka_total_terima">
<span<?= $Page->total_terima->viewAttributes() ?>>
<?= $Page->total_terima->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgl_tgjb->Visible) { // tgl_tgjb ?>
        <td data-name="tgl_tgjb"<?= $Page->tgl_tgjb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_tgl_tgjb" class="el_uangmuka_tgl_tgjb">
<span<?= $Page->tgl_tgjb->viewAttributes() ?>>
<?= $Page->tgl_tgjb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jumlah_tgjb->Visible) { // jumlah_tgjb ?>
        <td data-name="jumlah_tgjb"<?= $Page->jumlah_tgjb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_jumlah_tgjb" class="el_uangmuka_jumlah_tgjb">
<span<?= $Page->jumlah_tgjb->viewAttributes() ?>>
<?= $Page->jumlah_tgjb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jenis->Visible) { // jenis ?>
        <td data-name="jenis"<?= $Page->jenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_jenis" class="el_uangmuka_jenis">
<span<?= $Page->jenis->viewAttributes() ?>>
<?= $Page->jenis->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bukti1->Visible) { // bukti1 ?>
        <td data-name="bukti1"<?= $Page->bukti1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_bukti1" class="el_uangmuka_bukti1">
<span<?= $Page->bukti1->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti1, $Page->bukti1->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bukti2->Visible) { // bukti2 ?>
        <td data-name="bukti2"<?= $Page->bukti2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_bukti2" class="el_uangmuka_bukti2">
<span<?= $Page->bukti2->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti2, $Page->bukti2->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bukti3->Visible) { // bukti3 ?>
        <td data-name="bukti3"<?= $Page->bukti3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_bukti3" class="el_uangmuka_bukti3">
<span<?= $Page->bukti3->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti3, $Page->bukti3->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bukti4->Visible) { // bukti4 ?>
        <td data-name="bukti4"<?= $Page->bukti4->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_bukti4" class="el_uangmuka_bukti4">
<span<?= $Page->bukti4->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti4, $Page->bukti4->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->disetujui->Visible) { // disetujui ?>
        <td data-name="disetujui"<?= $Page->disetujui->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_disetujui" class="el_uangmuka_disetujui">
<span<?= $Page->disetujui->viewAttributes() ?>>
<?= $Page->disetujui->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_uangmuka_status" class="el_uangmuka_status">
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
    ew.addEventHandlers("uangmuka");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
