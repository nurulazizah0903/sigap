<?php

namespace PHPMaker2022\sigap;

// Page object
$GajiList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gaji: currentTable } });
var currentForm, currentPageID;
var fgajilist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajilist = new ew.Form("fgajilist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fgajilist;
    fgajilist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fgajilist");
});
var fgajisrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fgajisrch = new ew.Form("fgajisrch", "list");
    currentSearchForm = fgajisrch;

    // Add fields
    var fields = currentTable.fields;
    fgajisrch.addFields([
        ["jabatan_id", [], fields.jabatan_id.isInvalid],
        ["pegawai", [], fields.pegawai.isInvalid],
        ["lembur", [], fields.lembur.isInvalid],
        ["value_lembur", [], fields.value_lembur.isInvalid],
        ["kehadiran", [], fields.kehadiran.isInvalid],
        ["gapok", [], fields.gapok.isInvalid],
        ["value_reward", [], fields.value_reward.isInvalid],
        ["value_inval", [], fields.value_inval.isInvalid],
        ["piket_count", [], fields.piket_count.isInvalid],
        ["value_piket", [], fields.value_piket.isInvalid],
        ["tugastambahan", [], fields.tugastambahan.isInvalid],
        ["tj_jabatan", [], fields.tj_jabatan.isInvalid],
        ["sub_total", [], fields.sub_total.isInvalid],
        ["potongan", [], fields.potongan.isInvalid],
        ["total", [], fields.total.isInvalid],
        ["month", [], fields.month.isInvalid],
        ["datetime", [], fields.datetime.isInvalid]
    ]);

    // Validate form
    fgajisrch.validate = function () {
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
    fgajisrch.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgajisrch.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists

    // Filters
    fgajisrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fgajisrch");
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
<form name="fgajisrch" id="fgajisrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fgajisrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="gaji">
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
        <div id="el_gaji_month" class="ew-search-field">
<input type="<?= $Page->month->getInputTextType() ?>" name="x_month" id="x_month" data-table="gaji" data-field="x_month" value="<?= $Page->month->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->month->getPlaceHolder()) ?>"<?= $Page->month->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->month->getErrorMessage(false) ?></div>
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fgajisrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fgajisrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fgajisrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fgajisrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gaji">
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
<form name="fgajilist" id="fgajilist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gaji">
<div id="gmp_gaji" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_gajilist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <th data-name="jabatan_id" class="<?= $Page->jabatan_id->headerCellClass() ?>"><div id="elh_gaji_jabatan_id" class="gaji_jabatan_id"><?= $Page->renderFieldHeader($Page->jabatan_id) ?></div></th>
<?php } ?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
        <th data-name="pegawai" class="<?= $Page->pegawai->headerCellClass() ?>"><div id="elh_gaji_pegawai" class="gaji_pegawai"><?= $Page->renderFieldHeader($Page->pegawai) ?></div></th>
<?php } ?>
<?php if ($Page->lembur->Visible) { // lembur ?>
        <th data-name="lembur" class="<?= $Page->lembur->headerCellClass() ?>"><div id="elh_gaji_lembur" class="gaji_lembur"><?= $Page->renderFieldHeader($Page->lembur) ?></div></th>
<?php } ?>
<?php if ($Page->value_lembur->Visible) { // value_lembur ?>
        <th data-name="value_lembur" class="<?= $Page->value_lembur->headerCellClass() ?>"><div id="elh_gaji_value_lembur" class="gaji_value_lembur"><?= $Page->renderFieldHeader($Page->value_lembur) ?></div></th>
<?php } ?>
<?php if ($Page->kehadiran->Visible) { // kehadiran ?>
        <th data-name="kehadiran" class="<?= $Page->kehadiran->headerCellClass() ?>"><div id="elh_gaji_kehadiran" class="gaji_kehadiran"><?= $Page->renderFieldHeader($Page->kehadiran) ?></div></th>
<?php } ?>
<?php if ($Page->gapok->Visible) { // gapok ?>
        <th data-name="gapok" class="<?= $Page->gapok->headerCellClass() ?>"><div id="elh_gaji_gapok" class="gaji_gapok"><?= $Page->renderFieldHeader($Page->gapok) ?></div></th>
<?php } ?>
<?php if ($Page->value_reward->Visible) { // value_reward ?>
        <th data-name="value_reward" class="<?= $Page->value_reward->headerCellClass() ?>"><div id="elh_gaji_value_reward" class="gaji_value_reward"><?= $Page->renderFieldHeader($Page->value_reward) ?></div></th>
<?php } ?>
<?php if ($Page->value_inval->Visible) { // value_inval ?>
        <th data-name="value_inval" class="<?= $Page->value_inval->headerCellClass() ?>"><div id="elh_gaji_value_inval" class="gaji_value_inval"><?= $Page->renderFieldHeader($Page->value_inval) ?></div></th>
<?php } ?>
<?php if ($Page->piket_count->Visible) { // piket_count ?>
        <th data-name="piket_count" class="<?= $Page->piket_count->headerCellClass() ?>"><div id="elh_gaji_piket_count" class="gaji_piket_count"><?= $Page->renderFieldHeader($Page->piket_count) ?></div></th>
<?php } ?>
<?php if ($Page->value_piket->Visible) { // value_piket ?>
        <th data-name="value_piket" class="<?= $Page->value_piket->headerCellClass() ?>"><div id="elh_gaji_value_piket" class="gaji_value_piket"><?= $Page->renderFieldHeader($Page->value_piket) ?></div></th>
<?php } ?>
<?php if ($Page->tugastambahan->Visible) { // tugastambahan ?>
        <th data-name="tugastambahan" class="<?= $Page->tugastambahan->headerCellClass() ?>"><div id="elh_gaji_tugastambahan" class="gaji_tugastambahan"><?= $Page->renderFieldHeader($Page->tugastambahan) ?></div></th>
<?php } ?>
<?php if ($Page->tj_jabatan->Visible) { // tj_jabatan ?>
        <th data-name="tj_jabatan" class="<?= $Page->tj_jabatan->headerCellClass() ?>"><div id="elh_gaji_tj_jabatan" class="gaji_tj_jabatan"><?= $Page->renderFieldHeader($Page->tj_jabatan) ?></div></th>
<?php } ?>
<?php if ($Page->sub_total->Visible) { // sub_total ?>
        <th data-name="sub_total" class="<?= $Page->sub_total->headerCellClass() ?>"><div id="elh_gaji_sub_total" class="gaji_sub_total"><?= $Page->renderFieldHeader($Page->sub_total) ?></div></th>
<?php } ?>
<?php if ($Page->potongan->Visible) { // potongan ?>
        <th data-name="potongan" class="<?= $Page->potongan->headerCellClass() ?>"><div id="elh_gaji_potongan" class="gaji_potongan"><?= $Page->renderFieldHeader($Page->potongan) ?></div></th>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <th data-name="total" class="<?= $Page->total->headerCellClass() ?>"><div id="elh_gaji_total" class="gaji_total"><?= $Page->renderFieldHeader($Page->total) ?></div></th>
<?php } ?>
<?php if ($Page->month->Visible) { // month ?>
        <th data-name="month" class="<?= $Page->month->headerCellClass() ?>"><div id="elh_gaji_month" class="gaji_month"><?= $Page->renderFieldHeader($Page->month) ?></div></th>
<?php } ?>
<?php if ($Page->datetime->Visible) { // datetime ?>
        <th data-name="datetime" class="<?= $Page->datetime->headerCellClass() ?>"><div id="elh_gaji_datetime" class="gaji_datetime"><?= $Page->renderFieldHeader($Page->datetime) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_gaji",
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
    <?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <td data-name="jabatan_id"<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_jabatan_id" class="el_gaji_jabatan_id">
<span<?= $Page->jabatan_id->viewAttributes() ?>>
<?= $Page->jabatan_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pegawai->Visible) { // pegawai ?>
        <td data-name="pegawai"<?= $Page->pegawai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_pegawai" class="el_gaji_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->lembur->Visible) { // lembur ?>
        <td data-name="lembur"<?= $Page->lembur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_lembur" class="el_gaji_lembur">
<span<?= $Page->lembur->viewAttributes() ?>>
<?= $Page->lembur->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->value_lembur->Visible) { // value_lembur ?>
        <td data-name="value_lembur"<?= $Page->value_lembur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_value_lembur" class="el_gaji_value_lembur">
<span<?= $Page->value_lembur->viewAttributes() ?>>
<?= $Page->value_lembur->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kehadiran->Visible) { // kehadiran ?>
        <td data-name="kehadiran"<?= $Page->kehadiran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_kehadiran" class="el_gaji_kehadiran">
<span<?= $Page->kehadiran->viewAttributes() ?>>
<?= $Page->kehadiran->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->gapok->Visible) { // gapok ?>
        <td data-name="gapok"<?= $Page->gapok->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_gapok" class="el_gaji_gapok">
<span<?= $Page->gapok->viewAttributes() ?>>
<?= $Page->gapok->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->value_reward->Visible) { // value_reward ?>
        <td data-name="value_reward"<?= $Page->value_reward->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_value_reward" class="el_gaji_value_reward">
<span<?= $Page->value_reward->viewAttributes() ?>>
<?= $Page->value_reward->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->value_inval->Visible) { // value_inval ?>
        <td data-name="value_inval"<?= $Page->value_inval->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_value_inval" class="el_gaji_value_inval">
<span<?= $Page->value_inval->viewAttributes() ?>>
<?= $Page->value_inval->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->piket_count->Visible) { // piket_count ?>
        <td data-name="piket_count"<?= $Page->piket_count->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_piket_count" class="el_gaji_piket_count">
<span<?= $Page->piket_count->viewAttributes() ?>>
<?= $Page->piket_count->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->value_piket->Visible) { // value_piket ?>
        <td data-name="value_piket"<?= $Page->value_piket->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_value_piket" class="el_gaji_value_piket">
<span<?= $Page->value_piket->viewAttributes() ?>>
<?= $Page->value_piket->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tugastambahan->Visible) { // tugastambahan ?>
        <td data-name="tugastambahan"<?= $Page->tugastambahan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_tugastambahan" class="el_gaji_tugastambahan">
<span<?= $Page->tugastambahan->viewAttributes() ?>>
<?= $Page->tugastambahan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tj_jabatan->Visible) { // tj_jabatan ?>
        <td data-name="tj_jabatan"<?= $Page->tj_jabatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_tj_jabatan" class="el_gaji_tj_jabatan">
<span<?= $Page->tj_jabatan->viewAttributes() ?>>
<?= $Page->tj_jabatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sub_total->Visible) { // sub_total ?>
        <td data-name="sub_total"<?= $Page->sub_total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_sub_total" class="el_gaji_sub_total">
<span<?= $Page->sub_total->viewAttributes() ?>>
<?= $Page->sub_total->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->potongan->Visible) { // potongan ?>
        <td data-name="potongan"<?= $Page->potongan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_potongan" class="el_gaji_potongan">
<span<?= $Page->potongan->viewAttributes() ?>>
<?= $Page->potongan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->total->Visible) { // total ?>
        <td data-name="total"<?= $Page->total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_total" class="el_gaji_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->month->Visible) { // month ?>
        <td data-name="month"<?= $Page->month->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_month" class="el_gaji_month">
<span<?= $Page->month->viewAttributes() ?>>
<?= $Page->month->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->datetime->Visible) { // datetime ?>
        <td data-name="datetime"<?= $Page->datetime->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gaji_datetime" class="el_gaji_datetime">
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
    ew.addEventHandlers("gaji");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
