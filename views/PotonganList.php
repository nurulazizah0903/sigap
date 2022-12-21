<?php

namespace PHPMaker2022\sigap;

// Page object
$PotonganList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { potongan: currentTable } });
var currentForm, currentPageID;
var fpotonganlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpotonganlist = new ew.Form("fpotonganlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fpotonganlist;
    fpotonganlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fpotonganlist");
});
var fpotongansrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fpotongansrch = new ew.Form("fpotongansrch", "list");
    currentSearchForm = fpotongansrch;

    // Add fields
    var fields = currentTable.fields;
    fpotongansrch.addFields([
        ["month", [], fields.month.isInvalid],
        ["nama", [], fields.nama.isInvalid],
        ["jenjang_id", [], fields.jenjang_id.isInvalid],
        ["jabatan_id", [], fields.jabatan_id.isInvalid],
        ["terlambat", [], fields.terlambat.isInvalid],
        ["value_terlambat", [], fields.value_terlambat.isInvalid],
        ["izin", [], fields.izin.isInvalid],
        ["value_izin", [], fields.value_izin.isInvalid],
        ["izinperjam", [], fields.izinperjam.isInvalid],
        ["izinperjamvalue", [], fields.izinperjamvalue.isInvalid],
        ["sakit", [], fields.sakit.isInvalid],
        ["value_sakit", [], fields.value_sakit.isInvalid],
        ["sakitperjam", [], fields.sakitperjam.isInvalid],
        ["sakitperjamvalue", [], fields.sakitperjamvalue.isInvalid],
        ["pulcep", [], fields.pulcep.isInvalid],
        ["value_pulcep", [], fields.value_pulcep.isInvalid],
        ["tidakhadir", [], fields.tidakhadir.isInvalid],
        ["value_tidakhadir", [], fields.value_tidakhadir.isInvalid],
        ["tidakhadirjam", [], fields.tidakhadirjam.isInvalid],
        ["tidakhadirjamvalue", [], fields.tidakhadirjamvalue.isInvalid],
        ["total", [], fields.total.isInvalid],
        ["u_by", [], fields.u_by.isInvalid],
        ["datetime", [], fields.datetime.isInvalid]
    ]);

    // Validate form
    fpotongansrch.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm();

        // Validate fields
        if (!this.validateFields())
            return false;

        // Call Form_CustomValidate event
        if (!this.customValidate(fobj)) {
            this.focus();
            return false;
        }
        return true;
    }

    // Form_CustomValidate
    fpotongansrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpotongansrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpotongansrch.lists.nama = <?= $Page->nama->toClientList($Page) ?>;

    // Filters
    fpotongansrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpotongansrch");
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
<form name="fpotongansrch" id="fpotongansrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpotongansrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="potongan">
<div class="ew-extended-search container-fluid">
<div class="row mb-0<?= ($Page->SearchFieldsPerRow > 0) ? " row-cols-sm-" . $Page->SearchFieldsPerRow : "" ?>">
<?php
// Render search row
$Page->RowType = ROWTYPE_SEARCH;
$Page->resetAttributes();
$Page->renderRow();
?>
<?php if ($Page->month->Visible) { // month ?>
<?php
if (!$Page->month->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_month" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->month->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label for="x_month" class="ew-search-caption ew-label"><?= $Page->month->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_month" id="z_month" value="LIKE">
</div>
        </div>
        <div id="el_potongan_month" class="ew-search-field">
<input type="<?= $Page->month->getInputTextType() ?>" name="x_month" id="x_month" data-table="potongan" data-field="x_month" value="<?= $Page->month->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->month->getPlaceHolder()) ?>"<?= $Page->month->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->month->getErrorMessage(false) ?></div>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
<?php
if (!$Page->nama->UseFilter) {
    $Page->SearchColumnCount++;
}
?>
    <div id="xs_nama" class="col-sm-auto d-sm-flex mb-3 px-0 pe-sm-2<?= $Page->nama->UseFilter ? " ew-filter-field" : "" ?>">
        <div class="d-flex my-1 my-sm-0">
            <label class="ew-search-caption ew-label"><?= $Page->nama->caption() ?></label>
            <div class="ew-search-operator">
<?= $Language->phrase("LIKE") ?>
<input type="hidden" name="z_nama" id="z_nama" value="LIKE">
</div>
        </div>
        <div id="el_potongan_nama" class="ew-search-field">
    <select
        id="x_nama"
        name="x_nama"
        class="form-control ew-select<?= $Page->nama->isInvalidClass() ?>"
        data-select2-id="fpotongansrch_x_nama"
        data-table="potongan"
        data-field="x_nama"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->nama->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->nama->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>"
        <?= $Page->nama->editAttributes() ?>>
        <?= $Page->nama->selectOptionListHtml("x_nama") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->nama->getErrorMessage(false) ?></div>
<?= $Page->nama->Lookup->getParamTag($Page, "p_x_nama") ?>
<script>
loadjs.ready("fpotongansrch", function() {
    var options = { name: "x_nama", selectId: "fpotongansrch_x_nama" };
    if (fpotongansrch.lists.nama.lookupOptions.length) {
        options.data = { id: "x_nama", form: "fpotongansrch" };
    } else {
        options.ajax = { id: "x_nama", form: "fpotongansrch", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.potongan.fields.nama.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</div>
        <div class="d-flex my-1 my-sm-0">
        </div><!-- /.ew-search-field -->
    </div><!-- /.col-sm-auto -->
<?php } ?>
</div><!-- /.row -->
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fpotongansrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fpotongansrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fpotongansrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fpotongansrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> potongan">
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
<form name="fpotonganlist" id="fpotonganlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="potongan">
<div id="gmp_potongan" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_potonganlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->month->Visible) { // month ?>
        <th data-name="month" class="<?= $Page->month->headerCellClass() ?>"><div id="elh_potongan_month" class="potongan_month"><?= $Page->renderFieldHeader($Page->month) ?></div></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th data-name="nama" class="<?= $Page->nama->headerCellClass() ?>"><div id="elh_potongan_nama" class="potongan_nama"><?= $Page->renderFieldHeader($Page->nama) ?></div></th>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
        <th data-name="jenjang_id" class="<?= $Page->jenjang_id->headerCellClass() ?>"><div id="elh_potongan_jenjang_id" class="potongan_jenjang_id"><?= $Page->renderFieldHeader($Page->jenjang_id) ?></div></th>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <th data-name="jabatan_id" class="<?= $Page->jabatan_id->headerCellClass() ?>"><div id="elh_potongan_jabatan_id" class="potongan_jabatan_id"><?= $Page->renderFieldHeader($Page->jabatan_id) ?></div></th>
<?php } ?>
<?php if ($Page->terlambat->Visible) { // terlambat ?>
        <th data-name="terlambat" class="<?= $Page->terlambat->headerCellClass() ?>"><div id="elh_potongan_terlambat" class="potongan_terlambat"><?= $Page->renderFieldHeader($Page->terlambat) ?></div></th>
<?php } ?>
<?php if ($Page->value_terlambat->Visible) { // value_terlambat ?>
        <th data-name="value_terlambat" class="<?= $Page->value_terlambat->headerCellClass() ?>"><div id="elh_potongan_value_terlambat" class="potongan_value_terlambat"><?= $Page->renderFieldHeader($Page->value_terlambat) ?></div></th>
<?php } ?>
<?php if ($Page->izin->Visible) { // izin ?>
        <th data-name="izin" class="<?= $Page->izin->headerCellClass() ?>"><div id="elh_potongan_izin" class="potongan_izin"><?= $Page->renderFieldHeader($Page->izin) ?></div></th>
<?php } ?>
<?php if ($Page->value_izin->Visible) { // value_izin ?>
        <th data-name="value_izin" class="<?= $Page->value_izin->headerCellClass() ?>"><div id="elh_potongan_value_izin" class="potongan_value_izin"><?= $Page->renderFieldHeader($Page->value_izin) ?></div></th>
<?php } ?>
<?php if ($Page->izinperjam->Visible) { // izinperjam ?>
        <th data-name="izinperjam" class="<?= $Page->izinperjam->headerCellClass() ?>"><div id="elh_potongan_izinperjam" class="potongan_izinperjam"><?= $Page->renderFieldHeader($Page->izinperjam) ?></div></th>
<?php } ?>
<?php if ($Page->izinperjamvalue->Visible) { // izinperjamvalue ?>
        <th data-name="izinperjamvalue" class="<?= $Page->izinperjamvalue->headerCellClass() ?>"><div id="elh_potongan_izinperjamvalue" class="potongan_izinperjamvalue"><?= $Page->renderFieldHeader($Page->izinperjamvalue) ?></div></th>
<?php } ?>
<?php if ($Page->sakit->Visible) { // sakit ?>
        <th data-name="sakit" class="<?= $Page->sakit->headerCellClass() ?>"><div id="elh_potongan_sakit" class="potongan_sakit"><?= $Page->renderFieldHeader($Page->sakit) ?></div></th>
<?php } ?>
<?php if ($Page->value_sakit->Visible) { // value_sakit ?>
        <th data-name="value_sakit" class="<?= $Page->value_sakit->headerCellClass() ?>"><div id="elh_potongan_value_sakit" class="potongan_value_sakit"><?= $Page->renderFieldHeader($Page->value_sakit) ?></div></th>
<?php } ?>
<?php if ($Page->sakitperjam->Visible) { // sakitperjam ?>
        <th data-name="sakitperjam" class="<?= $Page->sakitperjam->headerCellClass() ?>"><div id="elh_potongan_sakitperjam" class="potongan_sakitperjam"><?= $Page->renderFieldHeader($Page->sakitperjam) ?></div></th>
<?php } ?>
<?php if ($Page->sakitperjamvalue->Visible) { // sakitperjamvalue ?>
        <th data-name="sakitperjamvalue" class="<?= $Page->sakitperjamvalue->headerCellClass() ?>"><div id="elh_potongan_sakitperjamvalue" class="potongan_sakitperjamvalue"><?= $Page->renderFieldHeader($Page->sakitperjamvalue) ?></div></th>
<?php } ?>
<?php if ($Page->pulcep->Visible) { // pulcep ?>
        <th data-name="pulcep" class="<?= $Page->pulcep->headerCellClass() ?>"><div id="elh_potongan_pulcep" class="potongan_pulcep"><?= $Page->renderFieldHeader($Page->pulcep) ?></div></th>
<?php } ?>
<?php if ($Page->value_pulcep->Visible) { // value_pulcep ?>
        <th data-name="value_pulcep" class="<?= $Page->value_pulcep->headerCellClass() ?>"><div id="elh_potongan_value_pulcep" class="potongan_value_pulcep"><?= $Page->renderFieldHeader($Page->value_pulcep) ?></div></th>
<?php } ?>
<?php if ($Page->tidakhadir->Visible) { // tidakhadir ?>
        <th data-name="tidakhadir" class="<?= $Page->tidakhadir->headerCellClass() ?>"><div id="elh_potongan_tidakhadir" class="potongan_tidakhadir"><?= $Page->renderFieldHeader($Page->tidakhadir) ?></div></th>
<?php } ?>
<?php if ($Page->value_tidakhadir->Visible) { // value_tidakhadir ?>
        <th data-name="value_tidakhadir" class="<?= $Page->value_tidakhadir->headerCellClass() ?>"><div id="elh_potongan_value_tidakhadir" class="potongan_value_tidakhadir"><?= $Page->renderFieldHeader($Page->value_tidakhadir) ?></div></th>
<?php } ?>
<?php if ($Page->tidakhadirjam->Visible) { // tidakhadirjam ?>
        <th data-name="tidakhadirjam" class="<?= $Page->tidakhadirjam->headerCellClass() ?>"><div id="elh_potongan_tidakhadirjam" class="potongan_tidakhadirjam"><?= $Page->renderFieldHeader($Page->tidakhadirjam) ?></div></th>
<?php } ?>
<?php if ($Page->tidakhadirjamvalue->Visible) { // tidakhadirjamvalue ?>
        <th data-name="tidakhadirjamvalue" class="<?= $Page->tidakhadirjamvalue->headerCellClass() ?>"><div id="elh_potongan_tidakhadirjamvalue" class="potongan_tidakhadirjamvalue"><?= $Page->renderFieldHeader($Page->tidakhadirjamvalue) ?></div></th>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <th data-name="total" class="<?= $Page->total->headerCellClass() ?>"><div id="elh_potongan_total" class="potongan_total"><?= $Page->renderFieldHeader($Page->total) ?></div></th>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
        <th data-name="u_by" class="<?= $Page->u_by->headerCellClass() ?>"><div id="elh_potongan_u_by" class="potongan_u_by"><?= $Page->renderFieldHeader($Page->u_by) ?></div></th>
<?php } ?>
<?php if ($Page->datetime->Visible) { // datetime ?>
        <th data-name="datetime" class="<?= $Page->datetime->headerCellClass() ?>"><div id="elh_potongan_datetime" class="potongan_datetime"><?= $Page->renderFieldHeader($Page->datetime) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_potongan",
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
    <?php if ($Page->month->Visible) { // month ?>
        <td data-name="month"<?= $Page->month->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_month" class="el_potongan_month">
<span<?= $Page->month->viewAttributes() ?>>
<?= $Page->month->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama->Visible) { // nama ?>
        <td data-name="nama"<?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_nama" class="el_potongan_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
        <td data-name="jenjang_id"<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_jenjang_id" class="el_potongan_jenjang_id">
<span<?= $Page->jenjang_id->viewAttributes() ?>>
<?= $Page->jenjang_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <td data-name="jabatan_id"<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_jabatan_id" class="el_potongan_jabatan_id">
<span<?= $Page->jabatan_id->viewAttributes() ?>>
<?= $Page->jabatan_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->terlambat->Visible) { // terlambat ?>
        <td data-name="terlambat"<?= $Page->terlambat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_terlambat" class="el_potongan_terlambat">
<span<?= $Page->terlambat->viewAttributes() ?>>
<?= $Page->terlambat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->value_terlambat->Visible) { // value_terlambat ?>
        <td data-name="value_terlambat"<?= $Page->value_terlambat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_value_terlambat" class="el_potongan_value_terlambat">
<span<?= $Page->value_terlambat->viewAttributes() ?>>
<?= $Page->value_terlambat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->izin->Visible) { // izin ?>
        <td data-name="izin"<?= $Page->izin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_izin" class="el_potongan_izin">
<span<?= $Page->izin->viewAttributes() ?>>
<?= $Page->izin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->value_izin->Visible) { // value_izin ?>
        <td data-name="value_izin"<?= $Page->value_izin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_value_izin" class="el_potongan_value_izin">
<span<?= $Page->value_izin->viewAttributes() ?>>
<?= $Page->value_izin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->izinperjam->Visible) { // izinperjam ?>
        <td data-name="izinperjam"<?= $Page->izinperjam->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_izinperjam" class="el_potongan_izinperjam">
<span<?= $Page->izinperjam->viewAttributes() ?>>
<?= $Page->izinperjam->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->izinperjamvalue->Visible) { // izinperjamvalue ?>
        <td data-name="izinperjamvalue"<?= $Page->izinperjamvalue->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_izinperjamvalue" class="el_potongan_izinperjamvalue">
<span<?= $Page->izinperjamvalue->viewAttributes() ?>>
<?= $Page->izinperjamvalue->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sakit->Visible) { // sakit ?>
        <td data-name="sakit"<?= $Page->sakit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_sakit" class="el_potongan_sakit">
<span<?= $Page->sakit->viewAttributes() ?>>
<?= $Page->sakit->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->value_sakit->Visible) { // value_sakit ?>
        <td data-name="value_sakit"<?= $Page->value_sakit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_value_sakit" class="el_potongan_value_sakit">
<span<?= $Page->value_sakit->viewAttributes() ?>>
<?= $Page->value_sakit->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sakitperjam->Visible) { // sakitperjam ?>
        <td data-name="sakitperjam"<?= $Page->sakitperjam->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_sakitperjam" class="el_potongan_sakitperjam">
<span<?= $Page->sakitperjam->viewAttributes() ?>>
<?= $Page->sakitperjam->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sakitperjamvalue->Visible) { // sakitperjamvalue ?>
        <td data-name="sakitperjamvalue"<?= $Page->sakitperjamvalue->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_sakitperjamvalue" class="el_potongan_sakitperjamvalue">
<span<?= $Page->sakitperjamvalue->viewAttributes() ?>>
<?= $Page->sakitperjamvalue->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pulcep->Visible) { // pulcep ?>
        <td data-name="pulcep"<?= $Page->pulcep->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_pulcep" class="el_potongan_pulcep">
<span<?= $Page->pulcep->viewAttributes() ?>>
<?= $Page->pulcep->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->value_pulcep->Visible) { // value_pulcep ?>
        <td data-name="value_pulcep"<?= $Page->value_pulcep->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_value_pulcep" class="el_potongan_value_pulcep">
<span<?= $Page->value_pulcep->viewAttributes() ?>>
<?= $Page->value_pulcep->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tidakhadir->Visible) { // tidakhadir ?>
        <td data-name="tidakhadir"<?= $Page->tidakhadir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_tidakhadir" class="el_potongan_tidakhadir">
<span<?= $Page->tidakhadir->viewAttributes() ?>>
<?= $Page->tidakhadir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->value_tidakhadir->Visible) { // value_tidakhadir ?>
        <td data-name="value_tidakhadir"<?= $Page->value_tidakhadir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_value_tidakhadir" class="el_potongan_value_tidakhadir">
<span<?= $Page->value_tidakhadir->viewAttributes() ?>>
<?= $Page->value_tidakhadir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tidakhadirjam->Visible) { // tidakhadirjam ?>
        <td data-name="tidakhadirjam"<?= $Page->tidakhadirjam->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_tidakhadirjam" class="el_potongan_tidakhadirjam">
<span<?= $Page->tidakhadirjam->viewAttributes() ?>>
<?= $Page->tidakhadirjam->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tidakhadirjamvalue->Visible) { // tidakhadirjamvalue ?>
        <td data-name="tidakhadirjamvalue"<?= $Page->tidakhadirjamvalue->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_tidakhadirjamvalue" class="el_potongan_tidakhadirjamvalue">
<span<?= $Page->tidakhadirjamvalue->viewAttributes() ?>>
<?= $Page->tidakhadirjamvalue->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total->Visible) { // total ?>
        <td data-name="total"<?= $Page->total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_total" class="el_potongan_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->u_by->Visible) { // u_by ?>
        <td data-name="u_by"<?= $Page->u_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_u_by" class="el_potongan_u_by">
<span<?= $Page->u_by->viewAttributes() ?>>
<?= $Page->u_by->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->datetime->Visible) { // datetime ?>
        <td data-name="datetime"<?= $Page->datetime->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_datetime" class="el_potongan_datetime">
<span<?= $Page->datetime->viewAttributes() ?>>
<?= $Page->datetime->getViewValue() ?></span>
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
    ew.addEventHandlers("potongan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
