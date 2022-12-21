<?php

namespace PHPMaker2022\sigap;

// Page object
$TesttableList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { testtable: currentTable } });
var currentForm, currentPageID;
var ftesttablelist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftesttablelist = new ew.Form("ftesttablelist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = ftesttablelist;
    ftesttablelist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("ftesttablelist");
});
var ftesttablesrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    ftesttablesrch = new ew.Form("ftesttablesrch", "list");
    currentSearchForm = ftesttablesrch;

    // Dynamic selection lists

    // Filters
    ftesttablesrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("ftesttablesrch");
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
<form name="ftesttablesrch" id="ftesttablesrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="ftesttablesrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="testtable">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="ftesttablesrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="ftesttablesrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="ftesttablesrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="ftesttablesrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> testtable">
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
<form name="ftesttablelist" id="ftesttablelist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="testtable">
<div id="gmp_testtable" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_testtablelist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_testtable_id" class="testtable_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <th data-name="date" class="<?= $Page->date->headerCellClass() ?>"><div id="elh_testtable_date" class="testtable_date"><?= $Page->renderFieldHeader($Page->date) ?></div></th>
<?php } ?>
<?php if ($Page->nojob->Visible) { // nojob ?>
        <th data-name="nojob" class="<?= $Page->nojob->headerCellClass() ?>"><div id="elh_testtable_nojob" class="testtable_nojob"><?= $Page->renderFieldHeader($Page->nojob) ?></div></th>
<?php } ?>
<?php if ($Page->stuffingdate->Visible) { // stuffingdate ?>
        <th data-name="stuffingdate" class="<?= $Page->stuffingdate->headerCellClass() ?>"><div id="elh_testtable_stuffingdate" class="testtable_stuffingdate"><?= $Page->renderFieldHeader($Page->stuffingdate) ?></div></th>
<?php } ?>
<?php if ($Page->shipper->Visible) { // shipper ?>
        <th data-name="shipper" class="<?= $Page->shipper->headerCellClass() ?>"><div id="elh_testtable_shipper" class="testtable_shipper"><?= $Page->renderFieldHeader($Page->shipper) ?></div></th>
<?php } ?>
<?php if ($Page->stuffingloc->Visible) { // stuffingloc ?>
        <th data-name="stuffingloc" class="<?= $Page->stuffingloc->headerCellClass() ?>"><div id="elh_testtable_stuffingloc" class="testtable_stuffingloc"><?= $Page->renderFieldHeader($Page->stuffingloc) ?></div></th>
<?php } ?>
<?php if ($Page->party->Visible) { // party ?>
        <th data-name="party" class="<?= $Page->party->headerCellClass() ?>"><div id="elh_testtable_party" class="testtable_party"><?= $Page->renderFieldHeader($Page->party) ?></div></th>
<?php } ?>
<?php if ($Page->typeparty->Visible) { // typeparty ?>
        <th data-name="typeparty" class="<?= $Page->typeparty->headerCellClass() ?>"><div id="elh_testtable_typeparty" class="testtable_typeparty"><?= $Page->renderFieldHeader($Page->typeparty) ?></div></th>
<?php } ?>
<?php if ($Page->jumlahparty->Visible) { // jumlahparty ?>
        <th data-name="jumlahparty" class="<?= $Page->jumlahparty->headerCellClass() ?>"><div id="elh_testtable_jumlahparty" class="testtable_jumlahparty"><?= $Page->renderFieldHeader($Page->jumlahparty) ?></div></th>
<?php } ?>
<?php if ($Page->shipping->Visible) { // shipping ?>
        <th data-name="shipping" class="<?= $Page->shipping->headerCellClass() ?>"><div id="elh_testtable_shipping" class="testtable_shipping"><?= $Page->renderFieldHeader($Page->shipping) ?></div></th>
<?php } ?>
<?php if ($Page->bookingnumer->Visible) { // bookingnumer ?>
        <th data-name="bookingnumer" class="<?= $Page->bookingnumer->headerCellClass() ?>"><div id="elh_testtable_bookingnumer" class="testtable_bookingnumer"><?= $Page->renderFieldHeader($Page->bookingnumer) ?></div></th>
<?php } ?>
<?php if ($Page->shippingline->Visible) { // shippingline ?>
        <th data-name="shippingline" class="<?= $Page->shippingline->headerCellClass() ?>"><div id="elh_testtable_shippingline" class="testtable_shippingline"><?= $Page->renderFieldHeader($Page->shippingline) ?></div></th>
<?php } ?>
<?php if ($Page->port->Visible) { // port ?>
        <th data-name="port" class="<?= $Page->port->headerCellClass() ?>"><div id="elh_testtable_port" class="testtable_port"><?= $Page->renderFieldHeader($Page->port) ?></div></th>
<?php } ?>
<?php if ($Page->surjal->Visible) { // surjal ?>
        <th data-name="surjal" class="<?= $Page->surjal->headerCellClass() ?>"><div id="elh_testtable_surjal" class="testtable_surjal"><?= $Page->renderFieldHeader($Page->surjal) ?></div></th>
<?php } ?>
<?php if ($Page->nota->Visible) { // nota ?>
        <th data-name="nota" class="<?= $Page->nota->headerCellClass() ?>"><div id="elh_testtable_nota" class="testtable_nota"><?= $Page->renderFieldHeader($Page->nota) ?></div></th>
<?php } ?>
<?php if ($Page->invoice->Visible) { // invoice ?>
        <th data-name="invoice" class="<?= $Page->invoice->headerCellClass() ?>"><div id="elh_testtable_invoice" class="testtable_invoice"><?= $Page->renderFieldHeader($Page->invoice) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_testtable",
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
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_id" class="el_testtable_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->date->Visible) { // date ?>
        <td data-name="date"<?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_date" class="el_testtable_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nojob->Visible) { // nojob ?>
        <td data-name="nojob"<?= $Page->nojob->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_nojob" class="el_testtable_nojob">
<span<?= $Page->nojob->viewAttributes() ?>>
<?= $Page->nojob->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->stuffingdate->Visible) { // stuffingdate ?>
        <td data-name="stuffingdate"<?= $Page->stuffingdate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_stuffingdate" class="el_testtable_stuffingdate">
<span<?= $Page->stuffingdate->viewAttributes() ?>>
<?= $Page->stuffingdate->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->shipper->Visible) { // shipper ?>
        <td data-name="shipper"<?= $Page->shipper->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_shipper" class="el_testtable_shipper">
<span<?= $Page->shipper->viewAttributes() ?>>
<?= $Page->shipper->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->stuffingloc->Visible) { // stuffingloc ?>
        <td data-name="stuffingloc"<?= $Page->stuffingloc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_stuffingloc" class="el_testtable_stuffingloc">
<span<?= $Page->stuffingloc->viewAttributes() ?>>
<?= $Page->stuffingloc->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->party->Visible) { // party ?>
        <td data-name="party"<?= $Page->party->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_party" class="el_testtable_party">
<span<?= $Page->party->viewAttributes() ?>>
<?= $Page->party->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->typeparty->Visible) { // typeparty ?>
        <td data-name="typeparty"<?= $Page->typeparty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_typeparty" class="el_testtable_typeparty">
<span<?= $Page->typeparty->viewAttributes() ?>>
<?= $Page->typeparty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jumlahparty->Visible) { // jumlahparty ?>
        <td data-name="jumlahparty"<?= $Page->jumlahparty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_jumlahparty" class="el_testtable_jumlahparty">
<span<?= $Page->jumlahparty->viewAttributes() ?>>
<?= $Page->jumlahparty->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->shipping->Visible) { // shipping ?>
        <td data-name="shipping"<?= $Page->shipping->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_shipping" class="el_testtable_shipping">
<span<?= $Page->shipping->viewAttributes() ?>>
<?= $Page->shipping->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bookingnumer->Visible) { // bookingnumer ?>
        <td data-name="bookingnumer"<?= $Page->bookingnumer->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_bookingnumer" class="el_testtable_bookingnumer">
<span<?= $Page->bookingnumer->viewAttributes() ?>>
<?= $Page->bookingnumer->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->shippingline->Visible) { // shippingline ?>
        <td data-name="shippingline"<?= $Page->shippingline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_shippingline" class="el_testtable_shippingline">
<span<?= $Page->shippingline->viewAttributes() ?>>
<?= $Page->shippingline->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->port->Visible) { // port ?>
        <td data-name="port"<?= $Page->port->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_port" class="el_testtable_port">
<span<?= $Page->port->viewAttributes() ?>>
<?= $Page->port->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->surjal->Visible) { // surjal ?>
        <td data-name="surjal"<?= $Page->surjal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_surjal" class="el_testtable_surjal">
<span<?= $Page->surjal->viewAttributes() ?>>
<?= $Page->surjal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nota->Visible) { // nota ?>
        <td data-name="nota"<?= $Page->nota->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_nota" class="el_testtable_nota">
<span<?= $Page->nota->viewAttributes() ?>>
<?= $Page->nota->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->invoice->Visible) { // invoice ?>
        <td data-name="invoice"<?= $Page->invoice->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_invoice" class="el_testtable_invoice">
<span<?= $Page->invoice->viewAttributes() ?>>
<?= $Page->invoice->getViewValue() ?></span>
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
    ew.addEventHandlers("testtable");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
