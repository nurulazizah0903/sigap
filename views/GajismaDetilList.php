<?php

namespace PHPMaker2022\sigap;

// Page object
$GajismaDetilList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gajisma_detil: currentTable } });
var currentForm, currentPageID;
var fgajisma_detillist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajisma_detillist = new ew.Form("fgajisma_detillist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fgajisma_detillist;
    fgajisma_detillist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fgajisma_detillist");
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
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "gajisma") {
    if ($Page->MasterRecordExists) {
        include_once "views/GajismaMaster.php";
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajisma_detil">
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
<form name="fgajisma_detillist" id="fgajisma_detillist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gajisma_detil">
<?php if ($Page->getCurrentMasterTable() == "gajisma" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="gajisma">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->pid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_gajisma_detil" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_gajisma_detillist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Page->pegawai_id->Visible) { // pegawai_id ?>
        <th data-name="pegawai_id" class="<?= $Page->pegawai_id->headerCellClass() ?>"><div id="elh_gajisma_detil_pegawai_id" class="gajisma_detil_pegawai_id"><?= $Page->renderFieldHeader($Page->pegawai_id) ?></div></th>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <th data-name="jabatan_id" class="<?= $Page->jabatan_id->headerCellClass() ?>"><div id="elh_gajisma_detil_jabatan_id" class="gajisma_detil_jabatan_id"><?= $Page->renderFieldHeader($Page->jabatan_id) ?></div></th>
<?php } ?>
<?php if ($Page->masakerja->Visible) { // masakerja ?>
        <th data-name="masakerja" class="<?= $Page->masakerja->headerCellClass() ?>"><div id="elh_gajisma_detil_masakerja" class="gajisma_detil_masakerja"><?= $Page->renderFieldHeader($Page->masakerja) ?></div></th>
<?php } ?>
<?php if ($Page->jumngajar->Visible) { // jumngajar ?>
        <th data-name="jumngajar" class="<?= $Page->jumngajar->headerCellClass() ?>"><div id="elh_gajisma_detil_jumngajar" class="gajisma_detil_jumngajar"><?= $Page->renderFieldHeader($Page->jumngajar) ?></div></th>
<?php } ?>
<?php if ($Page->ijin->Visible) { // ijin ?>
        <th data-name="ijin" class="<?= $Page->ijin->headerCellClass() ?>"><div id="elh_gajisma_detil_ijin" class="gajisma_detil_ijin"><?= $Page->renderFieldHeader($Page->ijin) ?></div></th>
<?php } ?>
<?php if ($Page->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
        <th data-name="tunjangan_wkosis" class="<?= $Page->tunjangan_wkosis->headerCellClass() ?>"><div id="elh_gajisma_detil_tunjangan_wkosis" class="gajisma_detil_tunjangan_wkosis"><?= $Page->renderFieldHeader($Page->tunjangan_wkosis) ?></div></th>
<?php } ?>
<?php if ($Page->nominal_baku->Visible) { // nominal_baku ?>
        <th data-name="nominal_baku" class="<?= $Page->nominal_baku->headerCellClass() ?>"><div id="elh_gajisma_detil_nominal_baku" class="gajisma_detil_nominal_baku"><?= $Page->renderFieldHeader($Page->nominal_baku) ?></div></th>
<?php } ?>
<?php if ($Page->baku->Visible) { // baku ?>
        <th data-name="baku" class="<?= $Page->baku->headerCellClass() ?>"><div id="elh_gajisma_detil_baku" class="gajisma_detil_baku"><?= $Page->renderFieldHeader($Page->baku) ?></div></th>
<?php } ?>
<?php if ($Page->kehadiran->Visible) { // kehadiran ?>
        <th data-name="kehadiran" class="<?= $Page->kehadiran->headerCellClass() ?>"><div id="elh_gajisma_detil_kehadiran" class="gajisma_detil_kehadiran"><?= $Page->renderFieldHeader($Page->kehadiran) ?></div></th>
<?php } ?>
<?php if ($Page->prestasi->Visible) { // prestasi ?>
        <th data-name="prestasi" class="<?= $Page->prestasi->headerCellClass() ?>"><div id="elh_gajisma_detil_prestasi" class="gajisma_detil_prestasi"><?= $Page->renderFieldHeader($Page->prestasi) ?></div></th>
<?php } ?>
<?php if ($Page->jumlahgaji->Visible) { // jumlahgaji ?>
        <th data-name="jumlahgaji" class="<?= $Page->jumlahgaji->headerCellClass() ?>"><div id="elh_gajisma_detil_jumlahgaji" class="gajisma_detil_jumlahgaji"><?= $Page->renderFieldHeader($Page->jumlahgaji) ?></div></th>
<?php } ?>
<?php if ($Page->jumgajitotal->Visible) { // jumgajitotal ?>
        <th data-name="jumgajitotal" class="<?= $Page->jumgajitotal->headerCellClass() ?>"><div id="elh_gajisma_detil_jumgajitotal" class="gajisma_detil_jumgajitotal"><?= $Page->renderFieldHeader($Page->jumgajitotal) ?></div></th>
<?php } ?>
<?php if ($Page->potongan1->Visible) { // potongan1 ?>
        <th data-name="potongan1" class="<?= $Page->potongan1->headerCellClass() ?>"><div id="elh_gajisma_detil_potongan1" class="gajisma_detil_potongan1"><?= $Page->renderFieldHeader($Page->potongan1) ?></div></th>
<?php } ?>
<?php if ($Page->potongan2->Visible) { // potongan2 ?>
        <th data-name="potongan2" class="<?= $Page->potongan2->headerCellClass() ?>"><div id="elh_gajisma_detil_potongan2" class="gajisma_detil_potongan2"><?= $Page->renderFieldHeader($Page->potongan2) ?></div></th>
<?php } ?>
<?php if ($Page->jumlahterima->Visible) { // jumlahterima ?>
        <th data-name="jumlahterima" class="<?= $Page->jumlahterima->headerCellClass() ?>"><div id="elh_gajisma_detil_jumlahterima" class="gajisma_detil_jumlahterima"><?= $Page->renderFieldHeader($Page->jumlahterima) ?></div></th>
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
            "id" => "r" . $Page->RowCount . "_gajisma_detil",
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
    <?php if ($Page->pegawai_id->Visible) { // pegawai_id ?>
        <td data-name="pegawai_id"<?= $Page->pegawai_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_pegawai_id" class="el_gajisma_detil_pegawai_id">
<span<?= $Page->pegawai_id->viewAttributes() ?>>
<?= $Page->pegawai_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <td data-name="jabatan_id"<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_jabatan_id" class="el_gajisma_detil_jabatan_id">
<span<?= $Page->jabatan_id->viewAttributes() ?>>
<?= $Page->jabatan_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->masakerja->Visible) { // masakerja ?>
        <td data-name="masakerja"<?= $Page->masakerja->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_masakerja" class="el_gajisma_detil_masakerja">
<span<?= $Page->masakerja->viewAttributes() ?>>
<?= $Page->masakerja->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jumngajar->Visible) { // jumngajar ?>
        <td data-name="jumngajar"<?= $Page->jumngajar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_jumngajar" class="el_gajisma_detil_jumngajar">
<span<?= $Page->jumngajar->viewAttributes() ?>>
<?= $Page->jumngajar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->ijin->Visible) { // ijin ?>
        <td data-name="ijin"<?= $Page->ijin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_ijin" class="el_gajisma_detil_ijin">
<span<?= $Page->ijin->viewAttributes() ?>>
<?= $Page->ijin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
        <td data-name="tunjangan_wkosis"<?= $Page->tunjangan_wkosis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_tunjangan_wkosis" class="el_gajisma_detil_tunjangan_wkosis">
<span<?= $Page->tunjangan_wkosis->viewAttributes() ?>>
<?= $Page->tunjangan_wkosis->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nominal_baku->Visible) { // nominal_baku ?>
        <td data-name="nominal_baku"<?= $Page->nominal_baku->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_nominal_baku" class="el_gajisma_detil_nominal_baku">
<span<?= $Page->nominal_baku->viewAttributes() ?>>
<?= $Page->nominal_baku->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->baku->Visible) { // baku ?>
        <td data-name="baku"<?= $Page->baku->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_baku" class="el_gajisma_detil_baku">
<span<?= $Page->baku->viewAttributes() ?>>
<?= $Page->baku->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kehadiran->Visible) { // kehadiran ?>
        <td data-name="kehadiran"<?= $Page->kehadiran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_kehadiran" class="el_gajisma_detil_kehadiran">
<span<?= $Page->kehadiran->viewAttributes() ?>>
<?= $Page->kehadiran->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->prestasi->Visible) { // prestasi ?>
        <td data-name="prestasi"<?= $Page->prestasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_prestasi" class="el_gajisma_detil_prestasi">
<span<?= $Page->prestasi->viewAttributes() ?>>
<?= $Page->prestasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jumlahgaji->Visible) { // jumlahgaji ?>
        <td data-name="jumlahgaji"<?= $Page->jumlahgaji->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_jumlahgaji" class="el_gajisma_detil_jumlahgaji">
<span<?= $Page->jumlahgaji->viewAttributes() ?>>
<?= $Page->jumlahgaji->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jumgajitotal->Visible) { // jumgajitotal ?>
        <td data-name="jumgajitotal"<?= $Page->jumgajitotal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_jumgajitotal" class="el_gajisma_detil_jumgajitotal">
<span<?= $Page->jumgajitotal->viewAttributes() ?>>
<?= $Page->jumgajitotal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->potongan1->Visible) { // potongan1 ?>
        <td data-name="potongan1"<?= $Page->potongan1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_potongan1" class="el_gajisma_detil_potongan1">
<span<?= $Page->potongan1->viewAttributes() ?>>
<?= $Page->potongan1->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->potongan2->Visible) { // potongan2 ?>
        <td data-name="potongan2"<?= $Page->potongan2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_potongan2" class="el_gajisma_detil_potongan2">
<span<?= $Page->potongan2->viewAttributes() ?>>
<?= $Page->potongan2->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jumlahterima->Visible) { // jumlahterima ?>
        <td data-name="jumlahterima"<?= $Page->jumlahterima->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisma_detil_jumlahterima" class="el_gajisma_detil_jumlahterima">
<span<?= $Page->jumlahterima->viewAttributes() ?>>
<?= $Page->jumlahterima->getViewValue() ?></span>
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
    ew.addEventHandlers("gajisma_detil");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
