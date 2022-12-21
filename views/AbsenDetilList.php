<?php

namespace PHPMaker2022\sigap;

// Page object
$AbsenDetilList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { absen_detil: currentTable } });
var currentForm, currentPageID;
var fabsen_detillist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fabsen_detillist = new ew.Form("fabsen_detillist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fabsen_detillist;
    fabsen_detillist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fabsen_detillist");
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
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "absen") {
    if ($Page->MasterRecordExists) {
        include_once "views/AbsenMaster.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> absen_detil">
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
<form name="fabsen_detillist" id="fabsen_detillist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="absen_detil">
<?php if ($Page->getCurrentMasterTable() == "absen" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="absen">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->pid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_absen_detil" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_absen_detillist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="pegawai" class="<?= $Page->pegawai->headerCellClass() ?>"><div id="elh_absen_detil_pegawai" class="absen_detil_pegawai"><?= $Page->renderFieldHeader($Page->pegawai) ?></div></th>
<?php } ?>
<?php if ($Page->masuk->Visible) { // masuk ?>
        <th data-name="masuk" class="<?= $Page->masuk->headerCellClass() ?>"><div id="elh_absen_detil_masuk" class="absen_detil_masuk"><?= $Page->renderFieldHeader($Page->masuk) ?></div></th>
<?php } ?>
<?php if ($Page->absen->Visible) { // absen ?>
        <th data-name="absen" class="<?= $Page->absen->headerCellClass() ?>"><div id="elh_absen_detil_absen" class="absen_detil_absen"><?= $Page->renderFieldHeader($Page->absen) ?></div></th>
<?php } ?>
<?php if ($Page->ijin->Visible) { // ijin ?>
        <th data-name="ijin" class="<?= $Page->ijin->headerCellClass() ?>"><div id="elh_absen_detil_ijin" class="absen_detil_ijin"><?= $Page->renderFieldHeader($Page->ijin) ?></div></th>
<?php } ?>
<?php if ($Page->cuti->Visible) { // cuti ?>
        <th data-name="cuti" class="<?= $Page->cuti->headerCellClass() ?>"><div id="elh_absen_detil_cuti" class="absen_detil_cuti"><?= $Page->renderFieldHeader($Page->cuti) ?></div></th>
<?php } ?>
<?php if ($Page->dinas_luar->Visible) { // dinas_luar ?>
        <th data-name="dinas_luar" class="<?= $Page->dinas_luar->headerCellClass() ?>"><div id="elh_absen_detil_dinas_luar" class="absen_detil_dinas_luar"><?= $Page->renderFieldHeader($Page->dinas_luar) ?></div></th>
<?php } ?>
<?php if ($Page->terlambat->Visible) { // terlambat ?>
        <th data-name="terlambat" class="<?= $Page->terlambat->headerCellClass() ?>"><div id="elh_absen_detil_terlambat" class="absen_detil_terlambat"><?= $Page->renderFieldHeader($Page->terlambat) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_absen_detil",
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
<span id="el<?= $Page->RowCount ?>_absen_detil_pegawai" class="el_absen_detil_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->masuk->Visible) { // masuk ?>
        <td data-name="masuk"<?= $Page->masuk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_detil_masuk" class="el_absen_detil_masuk">
<span<?= $Page->masuk->viewAttributes() ?>>
<?= $Page->masuk->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->absen->Visible) { // absen ?>
        <td data-name="absen"<?= $Page->absen->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_detil_absen" class="el_absen_detil_absen">
<span<?= $Page->absen->viewAttributes() ?>>
<?= $Page->absen->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ijin->Visible) { // ijin ?>
        <td data-name="ijin"<?= $Page->ijin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_detil_ijin" class="el_absen_detil_ijin">
<span<?= $Page->ijin->viewAttributes() ?>>
<?= $Page->ijin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->cuti->Visible) { // cuti ?>
        <td data-name="cuti"<?= $Page->cuti->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_detil_cuti" class="el_absen_detil_cuti">
<span<?= $Page->cuti->viewAttributes() ?>>
<?= $Page->cuti->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->dinas_luar->Visible) { // dinas_luar ?>
        <td data-name="dinas_luar"<?= $Page->dinas_luar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_detil_dinas_luar" class="el_absen_detil_dinas_luar">
<span<?= $Page->dinas_luar->viewAttributes() ?>>
<?= $Page->dinas_luar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->terlambat->Visible) { // terlambat ?>
        <td data-name="terlambat"<?= $Page->terlambat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_absen_detil_terlambat" class="el_absen_detil_terlambat">
<span<?= $Page->terlambat->viewAttributes() ?>>
<?= $Page->terlambat->getViewValue() ?></span>
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
    ew.addEventHandlers("absen_detil");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
