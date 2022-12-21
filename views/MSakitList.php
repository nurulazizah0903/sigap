<?php

namespace PHPMaker2022\sigap;

// Page object
$MSakitList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { m_sakit: currentTable } });
var currentForm, currentPageID;
var fm_sakitlist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fm_sakitlist = new ew.Form("fm_sakitlist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fm_sakitlist;
    fm_sakitlist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fm_sakitlist");
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
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_sakit">
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
<form name="fm_sakitlist" id="fm_sakitlist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_sakit">
<div id="gmp_m_sakit" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_m_sakitlist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
        <th data-name="jenjang_id" class="<?= $Page->jenjang_id->headerCellClass() ?>"><div id="elh_m_sakit_jenjang_id" class="m_sakit_jenjang_id"><?= $Page->renderFieldHeader($Page->jenjang_id) ?></div></th>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
        <th data-name="jabatan" class="<?= $Page->jabatan->headerCellClass() ?>"><div id="elh_m_sakit_jabatan" class="m_sakit_jabatan"><?= $Page->renderFieldHeader($Page->jabatan) ?></div></th>
<?php } ?>
<?php if ($Page->perhari->Visible) { // perhari ?>
        <th data-name="perhari" class="<?= $Page->perhari->headerCellClass() ?>"><div id="elh_m_sakit_perhari" class="m_sakit_perhari"><?= $Page->renderFieldHeader($Page->perhari) ?></div></th>
<?php } ?>
<?php if ($Page->perjam->Visible) { // perjam ?>
        <th data-name="perjam" class="<?= $Page->perjam->headerCellClass() ?>"><div id="elh_m_sakit_perjam" class="m_sakit_perjam"><?= $Page->renderFieldHeader($Page->perjam) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_m_sakit",
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
    <?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
        <td data-name="jenjang_id"<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_sakit_jenjang_id" class="el_m_sakit_jenjang_id">
<span<?= $Page->jenjang_id->viewAttributes() ?>>
<?= $Page->jenjang_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jabatan->Visible) { // jabatan ?>
        <td data-name="jabatan"<?= $Page->jabatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_sakit_jabatan" class="el_m_sakit_jabatan">
<span<?= $Page->jabatan->viewAttributes() ?>>
<?= $Page->jabatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->perhari->Visible) { // perhari ?>
        <td data-name="perhari"<?= $Page->perhari->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_sakit_perhari" class="el_m_sakit_perhari">
<span<?= $Page->perhari->viewAttributes() ?>>
<?= $Page->perhari->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->perjam->Visible) { // perjam ?>
        <td data-name="perjam"<?= $Page->perjam->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_m_sakit_perjam" class="el_m_sakit_perjam">
<span<?= $Page->perjam->viewAttributes() ?>>
<?= $Page->perjam->getViewValue() ?></span>
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
    ew.addEventHandlers("m_sakit");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
