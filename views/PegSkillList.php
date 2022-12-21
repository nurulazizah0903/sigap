<?php

namespace PHPMaker2022\sigap;

// Page object
$PegSkillList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { peg_skill: currentTable } });
var currentForm, currentPageID;
var fpeg_skilllist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpeg_skilllist = new ew.Form("fpeg_skilllist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fpeg_skilllist;
    fpeg_skilllist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fpeg_skilllist");
});
var fpeg_skillsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fpeg_skillsrch = new ew.Form("fpeg_skillsrch", "list");
    currentSearchForm = fpeg_skillsrch;

    // Dynamic selection lists

    // Filters
    fpeg_skillsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpeg_skillsrch");
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
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "pegawai") {
    if ($Page->MasterRecordExists) {
        include_once "views/PegawaiMaster.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="fpeg_skillsrch" id="fpeg_skillsrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpeg_skillsrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="peg_skill">
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
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fpeg_skillsrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fpeg_skillsrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fpeg_skillsrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fpeg_skillsrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> peg_skill">
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
<form name="fpeg_skilllist" id="fpeg_skilllist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="peg_skill">
<?php if ($Page->getCurrentMasterTable() == "pegawai" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="pegawai">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->pid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_peg_skill" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_peg_skilllist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->c_by->Visible) { // c_by ?>
        <th data-name="c_by" class="<?= $Page->c_by->headerCellClass() ?>"><div id="elh_peg_skill_c_by" class="peg_skill_c_by"><?= $Page->renderFieldHeader($Page->c_by) ?></div></th>
<?php } ?>
<?php if ($Page->keahlian->Visible) { // keahlian ?>
        <th data-name="keahlian" class="<?= $Page->keahlian->headerCellClass() ?>"><div id="elh_peg_skill_keahlian" class="peg_skill_keahlian"><?= $Page->renderFieldHeader($Page->keahlian) ?></div></th>
<?php } ?>
<?php if ($Page->tingkat->Visible) { // tingkat ?>
        <th data-name="tingkat" class="<?= $Page->tingkat->headerCellClass() ?>"><div id="elh_peg_skill_tingkat" class="peg_skill_tingkat"><?= $Page->renderFieldHeader($Page->tingkat) ?></div></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th data-name="keterangan" class="<?= $Page->keterangan->headerCellClass() ?>"><div id="elh_peg_skill_keterangan" class="peg_skill_keterangan"><?= $Page->renderFieldHeader($Page->keterangan) ?></div></th>
<?php } ?>
<?php if ($Page->bukti->Visible) { // bukti ?>
        <th data-name="bukti" class="<?= $Page->bukti->headerCellClass() ?>"><div id="elh_peg_skill_bukti" class="peg_skill_bukti"><?= $Page->renderFieldHeader($Page->bukti) ?></div></th>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
        <th data-name="c_date" class="<?= $Page->c_date->headerCellClass() ?>"><div id="elh_peg_skill_c_date" class="peg_skill_c_date"><?= $Page->renderFieldHeader($Page->c_date) ?></div></th>
<?php } ?>
<?php if ($Page->u_date->Visible) { // u_date ?>
        <th data-name="u_date" class="<?= $Page->u_date->headerCellClass() ?>"><div id="elh_peg_skill_u_date" class="peg_skill_u_date"><?= $Page->renderFieldHeader($Page->u_date) ?></div></th>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
        <th data-name="u_by" class="<?= $Page->u_by->headerCellClass() ?>"><div id="elh_peg_skill_u_by" class="peg_skill_u_by"><?= $Page->renderFieldHeader($Page->u_by) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_peg_skill",
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
    <?php if ($Page->c_by->Visible) { // c_by ?>
        <td data-name="c_by"<?= $Page->c_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_c_by" class="el_peg_skill_c_by">
<span<?= $Page->c_by->viewAttributes() ?>>
<?= $Page->c_by->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->keahlian->Visible) { // keahlian ?>
        <td data-name="keahlian"<?= $Page->keahlian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_keahlian" class="el_peg_skill_keahlian">
<span<?= $Page->keahlian->viewAttributes() ?>>
<?= $Page->keahlian->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tingkat->Visible) { // tingkat ?>
        <td data-name="tingkat"<?= $Page->tingkat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_tingkat" class="el_peg_skill_tingkat">
<span<?= $Page->tingkat->viewAttributes() ?>>
<?= $Page->tingkat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_keterangan" class="el_peg_skill_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bukti->Visible) { // bukti ?>
        <td data-name="bukti"<?= $Page->bukti->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_bukti" class="el_peg_skill_bukti">
<span<?= $Page->bukti->viewAttributes() ?>>
<?= GetFileViewTag($Page->bukti, $Page->bukti->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->c_date->Visible) { // c_date ?>
        <td data-name="c_date"<?= $Page->c_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_c_date" class="el_peg_skill_c_date">
<span<?= $Page->c_date->viewAttributes() ?>>
<?= $Page->c_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->u_date->Visible) { // u_date ?>
        <td data-name="u_date"<?= $Page->u_date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_u_date" class="el_peg_skill_u_date">
<span<?= $Page->u_date->viewAttributes() ?>>
<?= $Page->u_date->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->u_by->Visible) { // u_by ?>
        <td data-name="u_by"<?= $Page->u_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_peg_skill_u_by" class="el_peg_skill_u_by">
<span<?= $Page->u_by->viewAttributes() ?>>
<?= $Page->u_by->getViewValue() ?></span>
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
    ew.addEventHandlers("peg_skill");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
