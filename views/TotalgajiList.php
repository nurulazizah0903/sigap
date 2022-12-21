<?php

namespace PHPMaker2022\sigap;

// Page object
$TotalgajiList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { totalgaji: currentTable } });
var currentForm, currentPageID;
var ftotalgajilist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftotalgajilist = new ew.Form("ftotalgajilist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = ftotalgajilist;
    ftotalgajilist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("ftotalgajilist");
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> totalgaji">
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
<form name="ftotalgajilist" id="ftotalgajilist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="totalgaji">
<div id="gmp_totalgaji" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_totalgajilist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_totalgaji_id" class="totalgaji_id"><?= $Page->renderFieldHeader($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th data-name="nama" class="<?= $Page->nama->headerCellClass() ?>"><div id="elh_totalgaji_nama" class="totalgaji_nama"><?= $Page->renderFieldHeader($Page->nama) ?></div></th>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
        <th data-name="jabatan" class="<?= $Page->jabatan->headerCellClass() ?>"><div id="elh_totalgaji_jabatan" class="totalgaji_jabatan"><?= $Page->renderFieldHeader($Page->jabatan) ?></div></th>
<?php } ?>
<?php if ($Page->valuejabatan->Visible) { // valuejabatan ?>
        <th data-name="valuejabatan" class="<?= $Page->valuejabatan->headerCellClass() ?>"><div id="elh_totalgaji_valuejabatan" class="totalgaji_valuejabatan"><?= $Page->renderFieldHeader($Page->valuejabatan) ?></div></th>
<?php } ?>
<?php if ($Page->valuetunjangan->Visible) { // valuetunjangan ?>
        <th data-name="valuetunjangan" class="<?= $Page->valuetunjangan->headerCellClass() ?>"><div id="elh_totalgaji_valuetunjangan" class="totalgaji_valuetunjangan"><?= $Page->renderFieldHeader($Page->valuetunjangan) ?></div></th>
<?php } ?>
<?php if ($Page->value_lembur->Visible) { // value_lembur ?>
        <th data-name="value_lembur" class="<?= $Page->value_lembur->headerCellClass() ?>"><div id="elh_totalgaji_value_lembur" class="totalgaji_value_lembur"><?= $Page->renderFieldHeader($Page->value_lembur) ?></div></th>
<?php } ?>
<?php if ($Page->Column7->Visible) { // Column 7 ?>
        <th data-name="Column7" class="<?= $Page->Column7->headerCellClass() ?>"><div id="elh_totalgaji_Column7" class="totalgaji_Column7"><?= $Page->renderFieldHeader($Page->Column7) ?></div></th>
<?php } ?>
<?php if ($Page->Column8->Visible) { // Column 8 ?>
        <th data-name="Column8" class="<?= $Page->Column8->headerCellClass() ?>"><div id="elh_totalgaji_Column8" class="totalgaji_Column8"><?= $Page->renderFieldHeader($Page->Column8) ?></div></th>
<?php } ?>
<?php if ($Page->Column9->Visible) { // Column 9 ?>
        <th data-name="Column9" class="<?= $Page->Column9->headerCellClass() ?>"><div id="elh_totalgaji_Column9" class="totalgaji_Column9"><?= $Page->renderFieldHeader($Page->Column9) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_totalgaji",
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
<span id="el<?= $Page->RowCount ?>_totalgaji_id" class="el_totalgaji_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama->Visible) { // nama ?>
        <td data-name="nama"<?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_totalgaji_nama" class="el_totalgaji_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jabatan->Visible) { // jabatan ?>
        <td data-name="jabatan"<?= $Page->jabatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_totalgaji_jabatan" class="el_totalgaji_jabatan">
<span<?= $Page->jabatan->viewAttributes() ?>>
<?= $Page->jabatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->valuejabatan->Visible) { // valuejabatan ?>
        <td data-name="valuejabatan"<?= $Page->valuejabatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_totalgaji_valuejabatan" class="el_totalgaji_valuejabatan">
<span<?= $Page->valuejabatan->viewAttributes() ?>>
<?= $Page->valuejabatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->valuetunjangan->Visible) { // valuetunjangan ?>
        <td data-name="valuetunjangan"<?= $Page->valuetunjangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_totalgaji_valuetunjangan" class="el_totalgaji_valuetunjangan">
<span<?= $Page->valuetunjangan->viewAttributes() ?>>
<?= $Page->valuetunjangan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->value_lembur->Visible) { // value_lembur ?>
        <td data-name="value_lembur"<?= $Page->value_lembur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_totalgaji_value_lembur" class="el_totalgaji_value_lembur">
<span<?= $Page->value_lembur->viewAttributes() ?>>
<?= $Page->value_lembur->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Column7->Visible) { // Column 7 ?>
        <td data-name="Column7"<?= $Page->Column7->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_totalgaji_Column7" class="el_totalgaji_Column7">
<span<?= $Page->Column7->viewAttributes() ?>>
<?= $Page->Column7->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Column8->Visible) { // Column 8 ?>
        <td data-name="Column8"<?= $Page->Column8->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_totalgaji_Column8" class="el_totalgaji_Column8">
<span<?= $Page->Column8->viewAttributes() ?>>
<?= $Page->Column8->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->Column9->Visible) { // Column 9 ?>
        <td data-name="Column9"<?= $Page->Column9->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_totalgaji_Column9" class="el_totalgaji_Column9">
<span<?= $Page->Column9->viewAttributes() ?>>
<?= $Page->Column9->getViewValue() ?></span>
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
    ew.addEventHandlers("totalgaji");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
