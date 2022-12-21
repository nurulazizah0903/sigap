<?php

namespace PHPMaker2022\sigap;

// Set up and run Grid object
$Grid = Container("GajisdDetilGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fgajisd_detilgrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajisd_detilgrid = new ew.Form("fgajisd_detilgrid", "grid");
    fgajisd_detilgrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { gajisd_detil: currentTable } });
    var fields = currentTable.fields;
    fgajisd_detilgrid.addFields([
        ["pegawai_id", [fields.pegawai_id.visible && fields.pegawai_id.required ? ew.Validators.required(fields.pegawai_id.caption) : null, ew.Validators.integer], fields.pegawai_id.isInvalid],
        ["jabatan_id", [fields.jabatan_id.visible && fields.jabatan_id.required ? ew.Validators.required(fields.jabatan_id.caption) : null, ew.Validators.integer], fields.jabatan_id.isInvalid],
        ["masakerja", [fields.masakerja.visible && fields.masakerja.required ? ew.Validators.required(fields.masakerja.caption) : null, ew.Validators.integer], fields.masakerja.isInvalid],
        ["jumngajar", [fields.jumngajar.visible && fields.jumngajar.required ? ew.Validators.required(fields.jumngajar.caption) : null, ew.Validators.integer], fields.jumngajar.isInvalid],
        ["ijin", [fields.ijin.visible && fields.ijin.required ? ew.Validators.required(fields.ijin.caption) : null, ew.Validators.integer], fields.ijin.isInvalid],
        ["baku", [fields.baku.visible && fields.baku.required ? ew.Validators.required(fields.baku.caption) : null, ew.Validators.integer], fields.baku.isInvalid],
        ["kehadiran", [fields.kehadiran.visible && fields.kehadiran.required ? ew.Validators.required(fields.kehadiran.caption) : null, ew.Validators.integer], fields.kehadiran.isInvalid],
        ["prestasi", [fields.prestasi.visible && fields.prestasi.required ? ew.Validators.required(fields.prestasi.caption) : null, ew.Validators.integer], fields.prestasi.isInvalid],
        ["nominal_baku", [fields.nominal_baku.visible && fields.nominal_baku.required ? ew.Validators.required(fields.nominal_baku.caption) : null, ew.Validators.integer], fields.nominal_baku.isInvalid],
        ["jumlahterima", [fields.jumlahterima.visible && fields.jumlahterima.required ? ew.Validators.required(fields.jumlahterima.caption) : null, ew.Validators.integer], fields.jumlahterima.isInvalid],
        ["tunjangan_wkosis", [fields.tunjangan_wkosis.visible && fields.tunjangan_wkosis.required ? ew.Validators.required(fields.tunjangan_wkosis.caption) : null, ew.Validators.integer], fields.tunjangan_wkosis.isInvalid],
        ["potongan1", [fields.potongan1.visible && fields.potongan1.required ? ew.Validators.required(fields.potongan1.caption) : null, ew.Validators.integer], fields.potongan1.isInvalid],
        ["potongan2", [fields.potongan2.visible && fields.potongan2.required ? ew.Validators.required(fields.potongan2.caption) : null, ew.Validators.integer], fields.potongan2.isInvalid],
        ["jumlahgaji", [fields.jumlahgaji.visible && fields.jumlahgaji.required ? ew.Validators.required(fields.jumlahgaji.caption) : null, ew.Validators.integer], fields.jumlahgaji.isInvalid],
        ["jumgajitotal", [fields.jumgajitotal.visible && fields.jumgajitotal.required ? ew.Validators.required(fields.jumgajitotal.caption) : null, ew.Validators.integer], fields.jumgajitotal.isInvalid]
    ]);

    // Check empty row
    fgajisd_detilgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["pegawai_id",false],["jabatan_id",false],["masakerja",false],["jumngajar",false],["ijin",false],["baku",false],["kehadiran",false],["prestasi",false],["nominal_baku",false],["jumlahterima",false],["tunjangan_wkosis",false],["potongan1",false],["potongan2",false],["jumlahgaji",false],["jumgajitotal",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fgajisd_detilgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgajisd_detilgrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fgajisd_detilgrid.lists.pegawai_id = <?= $Grid->pegawai_id->toClientList($Grid) ?>;
    fgajisd_detilgrid.lists.jabatan_id = <?= $Grid->jabatan_id->toClientList($Grid) ?>;
    loadjs.done("fgajisd_detilgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajisd_detil">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<div id="fgajisd_detilgrid" class="ew-form ew-list-form">
<div id="gmp_gajisd_detil" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_gajisd_detilgrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->pegawai_id->Visible) { // pegawai_id ?>
        <th data-name="pegawai_id" class="<?= $Grid->pegawai_id->headerCellClass() ?>"><div id="elh_gajisd_detil_pegawai_id" class="gajisd_detil_pegawai_id"><?= $Grid->renderFieldHeader($Grid->pegawai_id) ?></div></th>
<?php } ?>
<?php if ($Grid->jabatan_id->Visible) { // jabatan_id ?>
        <th data-name="jabatan_id" class="<?= $Grid->jabatan_id->headerCellClass() ?>"><div id="elh_gajisd_detil_jabatan_id" class="gajisd_detil_jabatan_id"><?= $Grid->renderFieldHeader($Grid->jabatan_id) ?></div></th>
<?php } ?>
<?php if ($Grid->masakerja->Visible) { // masakerja ?>
        <th data-name="masakerja" class="<?= $Grid->masakerja->headerCellClass() ?>"><div id="elh_gajisd_detil_masakerja" class="gajisd_detil_masakerja"><?= $Grid->renderFieldHeader($Grid->masakerja) ?></div></th>
<?php } ?>
<?php if ($Grid->jumngajar->Visible) { // jumngajar ?>
        <th data-name="jumngajar" class="<?= $Grid->jumngajar->headerCellClass() ?>"><div id="elh_gajisd_detil_jumngajar" class="gajisd_detil_jumngajar"><?= $Grid->renderFieldHeader($Grid->jumngajar) ?></div></th>
<?php } ?>
<?php if ($Grid->ijin->Visible) { // ijin ?>
        <th data-name="ijin" class="<?= $Grid->ijin->headerCellClass() ?>"><div id="elh_gajisd_detil_ijin" class="gajisd_detil_ijin"><?= $Grid->renderFieldHeader($Grid->ijin) ?></div></th>
<?php } ?>
<?php if ($Grid->baku->Visible) { // baku ?>
        <th data-name="baku" class="<?= $Grid->baku->headerCellClass() ?>"><div id="elh_gajisd_detil_baku" class="gajisd_detil_baku"><?= $Grid->renderFieldHeader($Grid->baku) ?></div></th>
<?php } ?>
<?php if ($Grid->kehadiran->Visible) { // kehadiran ?>
        <th data-name="kehadiran" class="<?= $Grid->kehadiran->headerCellClass() ?>"><div id="elh_gajisd_detil_kehadiran" class="gajisd_detil_kehadiran"><?= $Grid->renderFieldHeader($Grid->kehadiran) ?></div></th>
<?php } ?>
<?php if ($Grid->prestasi->Visible) { // prestasi ?>
        <th data-name="prestasi" class="<?= $Grid->prestasi->headerCellClass() ?>"><div id="elh_gajisd_detil_prestasi" class="gajisd_detil_prestasi"><?= $Grid->renderFieldHeader($Grid->prestasi) ?></div></th>
<?php } ?>
<?php if ($Grid->nominal_baku->Visible) { // nominal_baku ?>
        <th data-name="nominal_baku" class="<?= $Grid->nominal_baku->headerCellClass() ?>"><div id="elh_gajisd_detil_nominal_baku" class="gajisd_detil_nominal_baku"><?= $Grid->renderFieldHeader($Grid->nominal_baku) ?></div></th>
<?php } ?>
<?php if ($Grid->jumlahterima->Visible) { // jumlahterima ?>
        <th data-name="jumlahterima" class="<?= $Grid->jumlahterima->headerCellClass() ?>"><div id="elh_gajisd_detil_jumlahterima" class="gajisd_detil_jumlahterima"><?= $Grid->renderFieldHeader($Grid->jumlahterima) ?></div></th>
<?php } ?>
<?php if ($Grid->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
        <th data-name="tunjangan_wkosis" class="<?= $Grid->tunjangan_wkosis->headerCellClass() ?>"><div id="elh_gajisd_detil_tunjangan_wkosis" class="gajisd_detil_tunjangan_wkosis"><?= $Grid->renderFieldHeader($Grid->tunjangan_wkosis) ?></div></th>
<?php } ?>
<?php if ($Grid->potongan1->Visible) { // potongan1 ?>
        <th data-name="potongan1" class="<?= $Grid->potongan1->headerCellClass() ?>"><div id="elh_gajisd_detil_potongan1" class="gajisd_detil_potongan1"><?= $Grid->renderFieldHeader($Grid->potongan1) ?></div></th>
<?php } ?>
<?php if ($Grid->potongan2->Visible) { // potongan2 ?>
        <th data-name="potongan2" class="<?= $Grid->potongan2->headerCellClass() ?>"><div id="elh_gajisd_detil_potongan2" class="gajisd_detil_potongan2"><?= $Grid->renderFieldHeader($Grid->potongan2) ?></div></th>
<?php } ?>
<?php if ($Grid->jumlahgaji->Visible) { // jumlahgaji ?>
        <th data-name="jumlahgaji" class="<?= $Grid->jumlahgaji->headerCellClass() ?>"><div id="elh_gajisd_detil_jumlahgaji" class="gajisd_detil_jumlahgaji"><?= $Grid->renderFieldHeader($Grid->jumlahgaji) ?></div></th>
<?php } ?>
<?php if ($Grid->jumgajitotal->Visible) { // jumgajitotal ?>
        <th data-name="jumgajitotal" class="<?= $Grid->jumgajitotal->headerCellClass() ?>"><div id="elh_gajisd_detil_jumgajitotal" class="gajisd_detil_jumgajitotal"><?= $Grid->renderFieldHeader($Grid->jumgajitotal) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
$Grid->StartRecord = 1;
$Grid->StopRecord = $Grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Grid->isConfirm() || $Grid->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Grid->FormKeyCountName) && ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm())) {
        $Grid->KeyCount = $CurrentForm->getValue($Grid->FormKeyCountName);
        $Grid->StopRecord = $Grid->StartRecord + $Grid->KeyCount - 1;
    }
}
$Grid->RecordCount = $Grid->StartRecord - 1;
if ($Grid->Recordset && !$Grid->Recordset->EOF) {
    // Nothing to do
} elseif ($Grid->isGridAdd() && !$Grid->AllowAddDeleteRow && $Grid->StopRecord == 0) {
    $Grid->StopRecord = $Grid->GridAddRowCount;
}

// Initialize aggregate
$Grid->RowType = ROWTYPE_AGGREGATEINIT;
$Grid->resetAttributes();
$Grid->renderRow();
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->RowCount++;
        if ($Grid->isAdd() || $Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm()) {
            $Grid->RowIndex++;
            $CurrentForm->Index = $Grid->RowIndex;
            if ($CurrentForm->hasValue($Grid->FormActionName) && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                $Grid->RowAction = strval($CurrentForm->getValue($Grid->FormActionName));
            } elseif ($Grid->isGridAdd()) {
                $Grid->RowAction = "insert";
            } else {
                $Grid->RowAction = "";
            }
        }

        // Set up key count
        $Grid->KeyCount = $Grid->RowIndex;

        // Init row class and style
        $Grid->resetAttributes();
        $Grid->CssClass = "";
        if ($Grid->isGridAdd()) {
            if ($Grid->CurrentMode == "copy") {
                $Grid->loadRowValues($Grid->Recordset); // Load row values
                $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
            } else {
                $Grid->loadRowValues(); // Load default values
                $Grid->OldKey = "";
            }
        } else {
            $Grid->loadRowValues($Grid->Recordset); // Load row values
            $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
        }
        $Grid->setKey($Grid->OldKey);
        $Grid->RowType = ROWTYPE_VIEW; // Render view
        if ($Grid->isGridAdd()) { // Grid add
            $Grid->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Grid->isGridAdd() && $Grid->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->isGridEdit()) { // Grid edit
            if ($Grid->EventCancelled) {
                $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
            }
            if ($Grid->RowAction == "insert") {
                $Grid->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Grid->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Grid->isGridEdit() && ($Grid->RowType == ROWTYPE_EDIT || $Grid->RowType == ROWTYPE_ADD) && $Grid->EventCancelled) { // Update failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->RowType == ROWTYPE_EDIT) { // Edit row
            $Grid->EditRowCount++;
        }
        if ($Grid->isConfirm()) { // Confirm row
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }

        // Set up row attributes
        $Grid->RowAttrs->merge([
            "data-rowindex" => $Grid->RowCount,
            "id" => "r" . $Grid->RowCount . "_gajisd_detil",
            "data-rowtype" => $Grid->RowType,
            "class" => ($Grid->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Grid->isAdd() && $Grid->RowType == ROWTYPE_ADD || $Grid->isEdit() && $Grid->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Grid->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();

        // Skip delete row / empty row for confirm page
        if (
            $Page->RowAction != "delete" &&
            $Page->RowAction != "insertdelete" &&
            !($Page->RowAction == "insert" && $Page->isConfirm() && $Page->emptyRow())
        ) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->pegawai_id->Visible) { // pegawai_id ?>
        <td data-name="pegawai_id"<?= $Grid->pegawai_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_pegawai_id" class="el_gajisd_detil_pegawai_id">
<?php $Grid->pegawai_id->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_pegawai_id"
        name="x<?= $Grid->RowIndex ?>_pegawai_id"
        class="form-control ew-select<?= $Grid->pegawai_id->isInvalidClass() ?>"
        data-select2-id="fgajisd_detilgrid_x<?= $Grid->RowIndex ?>_pegawai_id"
        data-table="gajisd_detil"
        data-field="x_pegawai_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->pegawai_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->pegawai_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->pegawai_id->getPlaceHolder()) ?>"
        <?= $Grid->pegawai_id->editAttributes() ?>>
        <?= $Grid->pegawai_id->selectOptionListHtml("x{$Grid->RowIndex}_pegawai_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->pegawai_id->getErrorMessage() ?></div>
<?= $Grid->pegawai_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_pegawai_id") ?>
<script>
loadjs.ready("fgajisd_detilgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_pegawai_id", selectId: "fgajisd_detilgrid_x<?= $Grid->RowIndex ?>_pegawai_id" };
    if (fgajisd_detilgrid.lists.pegawai_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_pegawai_id", form: "fgajisd_detilgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_pegawai_id", form: "fgajisd_detilgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.gajisd_detil.fields.pegawai_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_pegawai_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pegawai_id" id="o<?= $Grid->RowIndex ?>_pegawai_id" value="<?= HtmlEncode($Grid->pegawai_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_pegawai_id" class="el_gajisd_detil_pegawai_id">
<?php $Grid->pegawai_id->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_pegawai_id"
        name="x<?= $Grid->RowIndex ?>_pegawai_id"
        class="form-control ew-select<?= $Grid->pegawai_id->isInvalidClass() ?>"
        data-select2-id="fgajisd_detilgrid_x<?= $Grid->RowIndex ?>_pegawai_id"
        data-table="gajisd_detil"
        data-field="x_pegawai_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->pegawai_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->pegawai_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->pegawai_id->getPlaceHolder()) ?>"
        <?= $Grid->pegawai_id->editAttributes() ?>>
        <?= $Grid->pegawai_id->selectOptionListHtml("x{$Grid->RowIndex}_pegawai_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->pegawai_id->getErrorMessage() ?></div>
<?= $Grid->pegawai_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_pegawai_id") ?>
<script>
loadjs.ready("fgajisd_detilgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_pegawai_id", selectId: "fgajisd_detilgrid_x<?= $Grid->RowIndex ?>_pegawai_id" };
    if (fgajisd_detilgrid.lists.pegawai_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_pegawai_id", form: "fgajisd_detilgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_pegawai_id", form: "fgajisd_detilgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.gajisd_detil.fields.pegawai_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_pegawai_id" class="el_gajisd_detil_pegawai_id">
<span<?= $Grid->pegawai_id->viewAttributes() ?>>
<?= $Grid->pegawai_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_pegawai_id" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_pegawai_id" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_pegawai_id" value="<?= HtmlEncode($Grid->pegawai_id->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_pegawai_id" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_pegawai_id" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_pegawai_id" value="<?= HtmlEncode($Grid->pegawai_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jabatan_id->Visible) { // jabatan_id ?>
        <td data-name="jabatan_id"<?= $Grid->jabatan_id->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jabatan_id" class="el_gajisd_detil_jabatan_id">
<?php
$onchange = $Grid->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->jabatan_id->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Grid->jabatan_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_jabatan_id" class="ew-auto-suggest">
    <input type="<?= $Grid->jabatan_id->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_jabatan_id" id="sv_x<?= $Grid->RowIndex ?>_jabatan_id" value="<?= RemoveHtml($Grid->jabatan_id->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->jabatan_id->getPlaceHolder()) ?>"<?= $Grid->jabatan_id->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="gajisd_detil" data-field="x_jabatan_id" data-input="sv_x<?= $Grid->RowIndex ?>_jabatan_id" data-value-separator="<?= $Grid->jabatan_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_jabatan_id" id="x<?= $Grid->RowIndex ?>_jabatan_id" value="<?= HtmlEncode($Grid->jabatan_id->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->jabatan_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fgajisd_detilgrid", function() {
    fgajisd_detilgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_jabatan_id","forceSelect":false}, ew.vars.tables.gajisd_detil.fields.jabatan_id.autoSuggestOptions));
});
</script>
<?= $Grid->jabatan_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_jabatan_id") ?>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_jabatan_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jabatan_id" id="o<?= $Grid->RowIndex ?>_jabatan_id" value="<?= HtmlEncode($Grid->jabatan_id->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jabatan_id" class="el_gajisd_detil_jabatan_id">
<?php
$onchange = $Grid->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->jabatan_id->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Grid->jabatan_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_jabatan_id" class="ew-auto-suggest">
    <input type="<?= $Grid->jabatan_id->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_jabatan_id" id="sv_x<?= $Grid->RowIndex ?>_jabatan_id" value="<?= RemoveHtml($Grid->jabatan_id->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->jabatan_id->getPlaceHolder()) ?>"<?= $Grid->jabatan_id->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="gajisd_detil" data-field="x_jabatan_id" data-input="sv_x<?= $Grid->RowIndex ?>_jabatan_id" data-value-separator="<?= $Grid->jabatan_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_jabatan_id" id="x<?= $Grid->RowIndex ?>_jabatan_id" value="<?= HtmlEncode($Grid->jabatan_id->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->jabatan_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fgajisd_detilgrid", function() {
    fgajisd_detilgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_jabatan_id","forceSelect":false}, ew.vars.tables.gajisd_detil.fields.jabatan_id.autoSuggestOptions));
});
</script>
<?= $Grid->jabatan_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_jabatan_id") ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jabatan_id" class="el_gajisd_detil_jabatan_id">
<span<?= $Grid->jabatan_id->viewAttributes() ?>>
<?= $Grid->jabatan_id->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_jabatan_id" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_jabatan_id" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_jabatan_id" value="<?= HtmlEncode($Grid->jabatan_id->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_jabatan_id" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_jabatan_id" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_jabatan_id" value="<?= HtmlEncode($Grid->jabatan_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->masakerja->Visible) { // masakerja ?>
        <td data-name="masakerja"<?= $Grid->masakerja->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_masakerja" class="el_gajisd_detil_masakerja">
<input type="<?= $Grid->masakerja->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_masakerja" id="x<?= $Grid->RowIndex ?>_masakerja" data-table="gajisd_detil" data-field="x_masakerja" value="<?= $Grid->masakerja->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->masakerja->getPlaceHolder()) ?>"<?= $Grid->masakerja->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->masakerja->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_masakerja" data-hidden="1" name="o<?= $Grid->RowIndex ?>_masakerja" id="o<?= $Grid->RowIndex ?>_masakerja" value="<?= HtmlEncode($Grid->masakerja->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_masakerja" class="el_gajisd_detil_masakerja">
<input type="<?= $Grid->masakerja->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_masakerja" id="x<?= $Grid->RowIndex ?>_masakerja" data-table="gajisd_detil" data-field="x_masakerja" value="<?= $Grid->masakerja->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->masakerja->getPlaceHolder()) ?>"<?= $Grid->masakerja->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->masakerja->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_masakerja" class="el_gajisd_detil_masakerja">
<span<?= $Grid->masakerja->viewAttributes() ?>>
<?= $Grid->masakerja->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_masakerja" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_masakerja" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_masakerja" value="<?= HtmlEncode($Grid->masakerja->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_masakerja" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_masakerja" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_masakerja" value="<?= HtmlEncode($Grid->masakerja->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jumngajar->Visible) { // jumngajar ?>
        <td data-name="jumngajar"<?= $Grid->jumngajar->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jumngajar" class="el_gajisd_detil_jumngajar">
<input type="<?= $Grid->jumngajar->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jumngajar" id="x<?= $Grid->RowIndex ?>_jumngajar" data-table="gajisd_detil" data-field="x_jumngajar" value="<?= $Grid->jumngajar->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jumngajar->getPlaceHolder()) ?>"<?= $Grid->jumngajar->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumngajar->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumngajar" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jumngajar" id="o<?= $Grid->RowIndex ?>_jumngajar" value="<?= HtmlEncode($Grid->jumngajar->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jumngajar" class="el_gajisd_detil_jumngajar">
<input type="<?= $Grid->jumngajar->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jumngajar" id="x<?= $Grid->RowIndex ?>_jumngajar" data-table="gajisd_detil" data-field="x_jumngajar" value="<?= $Grid->jumngajar->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jumngajar->getPlaceHolder()) ?>"<?= $Grid->jumngajar->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumngajar->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jumngajar" class="el_gajisd_detil_jumngajar">
<span<?= $Grid->jumngajar->viewAttributes() ?>>
<?= $Grid->jumngajar->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumngajar" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_jumngajar" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_jumngajar" value="<?= HtmlEncode($Grid->jumngajar->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_jumngajar" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_jumngajar" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_jumngajar" value="<?= HtmlEncode($Grid->jumngajar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ijin->Visible) { // ijin ?>
        <td data-name="ijin"<?= $Grid->ijin->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_ijin" class="el_gajisd_detil_ijin">
<input type="<?= $Grid->ijin->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ijin" id="x<?= $Grid->RowIndex ?>_ijin" data-table="gajisd_detil" data-field="x_ijin" value="<?= $Grid->ijin->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->ijin->getPlaceHolder()) ?>"<?= $Grid->ijin->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ijin->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_ijin" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ijin" id="o<?= $Grid->RowIndex ?>_ijin" value="<?= HtmlEncode($Grid->ijin->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_ijin" class="el_gajisd_detil_ijin">
<input type="<?= $Grid->ijin->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ijin" id="x<?= $Grid->RowIndex ?>_ijin" data-table="gajisd_detil" data-field="x_ijin" value="<?= $Grid->ijin->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->ijin->getPlaceHolder()) ?>"<?= $Grid->ijin->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ijin->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_ijin" class="el_gajisd_detil_ijin">
<span<?= $Grid->ijin->viewAttributes() ?>>
<?= $Grid->ijin->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_ijin" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_ijin" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_ijin" value="<?= HtmlEncode($Grid->ijin->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_ijin" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_ijin" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_ijin" value="<?= HtmlEncode($Grid->ijin->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->baku->Visible) { // baku ?>
        <td data-name="baku"<?= $Grid->baku->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_baku" class="el_gajisd_detil_baku">
<input type="<?= $Grid->baku->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_baku" id="x<?= $Grid->RowIndex ?>_baku" data-table="gajisd_detil" data-field="x_baku" value="<?= $Grid->baku->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->baku->getPlaceHolder()) ?>"<?= $Grid->baku->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->baku->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_baku" data-hidden="1" name="o<?= $Grid->RowIndex ?>_baku" id="o<?= $Grid->RowIndex ?>_baku" value="<?= HtmlEncode($Grid->baku->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_baku" class="el_gajisd_detil_baku">
<input type="<?= $Grid->baku->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_baku" id="x<?= $Grid->RowIndex ?>_baku" data-table="gajisd_detil" data-field="x_baku" value="<?= $Grid->baku->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->baku->getPlaceHolder()) ?>"<?= $Grid->baku->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->baku->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_baku" class="el_gajisd_detil_baku">
<span<?= $Grid->baku->viewAttributes() ?>>
<?= $Grid->baku->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_baku" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_baku" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_baku" value="<?= HtmlEncode($Grid->baku->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_baku" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_baku" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_baku" value="<?= HtmlEncode($Grid->baku->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->kehadiran->Visible) { // kehadiran ?>
        <td data-name="kehadiran"<?= $Grid->kehadiran->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_kehadiran" class="el_gajisd_detil_kehadiran">
<input type="<?= $Grid->kehadiran->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_kehadiran" id="x<?= $Grid->RowIndex ?>_kehadiran" data-table="gajisd_detil" data-field="x_kehadiran" value="<?= $Grid->kehadiran->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->kehadiran->getPlaceHolder()) ?>"<?= $Grid->kehadiran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kehadiran->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_kehadiran" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kehadiran" id="o<?= $Grid->RowIndex ?>_kehadiran" value="<?= HtmlEncode($Grid->kehadiran->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_kehadiran" class="el_gajisd_detil_kehadiran">
<input type="<?= $Grid->kehadiran->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_kehadiran" id="x<?= $Grid->RowIndex ?>_kehadiran" data-table="gajisd_detil" data-field="x_kehadiran" value="<?= $Grid->kehadiran->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->kehadiran->getPlaceHolder()) ?>"<?= $Grid->kehadiran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kehadiran->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_kehadiran" class="el_gajisd_detil_kehadiran">
<span<?= $Grid->kehadiran->viewAttributes() ?>>
<?= $Grid->kehadiran->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_kehadiran" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_kehadiran" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_kehadiran" value="<?= HtmlEncode($Grid->kehadiran->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_kehadiran" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_kehadiran" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_kehadiran" value="<?= HtmlEncode($Grid->kehadiran->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->prestasi->Visible) { // prestasi ?>
        <td data-name="prestasi"<?= $Grid->prestasi->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_prestasi" class="el_gajisd_detil_prestasi">
<input type="<?= $Grid->prestasi->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_prestasi" id="x<?= $Grid->RowIndex ?>_prestasi" data-table="gajisd_detil" data-field="x_prestasi" value="<?= $Grid->prestasi->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->prestasi->getPlaceHolder()) ?>"<?= $Grid->prestasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->prestasi->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_prestasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_prestasi" id="o<?= $Grid->RowIndex ?>_prestasi" value="<?= HtmlEncode($Grid->prestasi->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_prestasi" class="el_gajisd_detil_prestasi">
<input type="<?= $Grid->prestasi->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_prestasi" id="x<?= $Grid->RowIndex ?>_prestasi" data-table="gajisd_detil" data-field="x_prestasi" value="<?= $Grid->prestasi->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->prestasi->getPlaceHolder()) ?>"<?= $Grid->prestasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->prestasi->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_prestasi" class="el_gajisd_detil_prestasi">
<span<?= $Grid->prestasi->viewAttributes() ?>>
<?= $Grid->prestasi->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_prestasi" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_prestasi" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_prestasi" value="<?= HtmlEncode($Grid->prestasi->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_prestasi" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_prestasi" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_prestasi" value="<?= HtmlEncode($Grid->prestasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nominal_baku->Visible) { // nominal_baku ?>
        <td data-name="nominal_baku"<?= $Grid->nominal_baku->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_nominal_baku" class="el_gajisd_detil_nominal_baku">
<input type="<?= $Grid->nominal_baku->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nominal_baku" id="x<?= $Grid->RowIndex ?>_nominal_baku" data-table="gajisd_detil" data-field="x_nominal_baku" value="<?= $Grid->nominal_baku->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->nominal_baku->getPlaceHolder()) ?>"<?= $Grid->nominal_baku->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nominal_baku->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_nominal_baku" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nominal_baku" id="o<?= $Grid->RowIndex ?>_nominal_baku" value="<?= HtmlEncode($Grid->nominal_baku->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_nominal_baku" class="el_gajisd_detil_nominal_baku">
<input type="<?= $Grid->nominal_baku->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nominal_baku" id="x<?= $Grid->RowIndex ?>_nominal_baku" data-table="gajisd_detil" data-field="x_nominal_baku" value="<?= $Grid->nominal_baku->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->nominal_baku->getPlaceHolder()) ?>"<?= $Grid->nominal_baku->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nominal_baku->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_nominal_baku" class="el_gajisd_detil_nominal_baku">
<span<?= $Grid->nominal_baku->viewAttributes() ?>>
<?= $Grid->nominal_baku->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_nominal_baku" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_nominal_baku" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_nominal_baku" value="<?= HtmlEncode($Grid->nominal_baku->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_nominal_baku" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_nominal_baku" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_nominal_baku" value="<?= HtmlEncode($Grid->nominal_baku->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jumlahterima->Visible) { // jumlahterima ?>
        <td data-name="jumlahterima"<?= $Grid->jumlahterima->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jumlahterima" class="el_gajisd_detil_jumlahterima">
<input type="<?= $Grid->jumlahterima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jumlahterima" id="x<?= $Grid->RowIndex ?>_jumlahterima" data-table="gajisd_detil" data-field="x_jumlahterima" value="<?= $Grid->jumlahterima->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jumlahterima->getPlaceHolder()) ?>"<?= $Grid->jumlahterima->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumlahterima->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumlahterima" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jumlahterima" id="o<?= $Grid->RowIndex ?>_jumlahterima" value="<?= HtmlEncode($Grid->jumlahterima->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jumlahterima" class="el_gajisd_detil_jumlahterima">
<input type="<?= $Grid->jumlahterima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jumlahterima" id="x<?= $Grid->RowIndex ?>_jumlahterima" data-table="gajisd_detil" data-field="x_jumlahterima" value="<?= $Grid->jumlahterima->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jumlahterima->getPlaceHolder()) ?>"<?= $Grid->jumlahterima->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumlahterima->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jumlahterima" class="el_gajisd_detil_jumlahterima">
<span<?= $Grid->jumlahterima->viewAttributes() ?>>
<?= $Grid->jumlahterima->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumlahterima" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_jumlahterima" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_jumlahterima" value="<?= HtmlEncode($Grid->jumlahterima->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_jumlahterima" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_jumlahterima" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_jumlahterima" value="<?= HtmlEncode($Grid->jumlahterima->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
        <td data-name="tunjangan_wkosis"<?= $Grid->tunjangan_wkosis->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_tunjangan_wkosis" class="el_gajisd_detil_tunjangan_wkosis">
<input type="<?= $Grid->tunjangan_wkosis->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tunjangan_wkosis" id="x<?= $Grid->RowIndex ?>_tunjangan_wkosis" data-table="gajisd_detil" data-field="x_tunjangan_wkosis" value="<?= $Grid->tunjangan_wkosis->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->tunjangan_wkosis->getPlaceHolder()) ?>"<?= $Grid->tunjangan_wkosis->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tunjangan_wkosis->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_tunjangan_wkosis" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tunjangan_wkosis" id="o<?= $Grid->RowIndex ?>_tunjangan_wkosis" value="<?= HtmlEncode($Grid->tunjangan_wkosis->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_tunjangan_wkosis" class="el_gajisd_detil_tunjangan_wkosis">
<input type="<?= $Grid->tunjangan_wkosis->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tunjangan_wkosis" id="x<?= $Grid->RowIndex ?>_tunjangan_wkosis" data-table="gajisd_detil" data-field="x_tunjangan_wkosis" value="<?= $Grid->tunjangan_wkosis->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->tunjangan_wkosis->getPlaceHolder()) ?>"<?= $Grid->tunjangan_wkosis->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tunjangan_wkosis->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_tunjangan_wkosis" class="el_gajisd_detil_tunjangan_wkosis">
<span<?= $Grid->tunjangan_wkosis->viewAttributes() ?>>
<?= $Grid->tunjangan_wkosis->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_tunjangan_wkosis" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_tunjangan_wkosis" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_tunjangan_wkosis" value="<?= HtmlEncode($Grid->tunjangan_wkosis->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_tunjangan_wkosis" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_tunjangan_wkosis" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_tunjangan_wkosis" value="<?= HtmlEncode($Grid->tunjangan_wkosis->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->potongan1->Visible) { // potongan1 ?>
        <td data-name="potongan1"<?= $Grid->potongan1->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_potongan1" class="el_gajisd_detil_potongan1">
<input type="<?= $Grid->potongan1->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_potongan1" id="x<?= $Grid->RowIndex ?>_potongan1" data-table="gajisd_detil" data-field="x_potongan1" value="<?= $Grid->potongan1->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->potongan1->getPlaceHolder()) ?>"<?= $Grid->potongan1->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->potongan1->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_potongan1" data-hidden="1" name="o<?= $Grid->RowIndex ?>_potongan1" id="o<?= $Grid->RowIndex ?>_potongan1" value="<?= HtmlEncode($Grid->potongan1->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_potongan1" class="el_gajisd_detil_potongan1">
<input type="<?= $Grid->potongan1->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_potongan1" id="x<?= $Grid->RowIndex ?>_potongan1" data-table="gajisd_detil" data-field="x_potongan1" value="<?= $Grid->potongan1->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->potongan1->getPlaceHolder()) ?>"<?= $Grid->potongan1->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->potongan1->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_potongan1" class="el_gajisd_detil_potongan1">
<span<?= $Grid->potongan1->viewAttributes() ?>>
<?= $Grid->potongan1->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_potongan1" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_potongan1" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_potongan1" value="<?= HtmlEncode($Grid->potongan1->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_potongan1" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_potongan1" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_potongan1" value="<?= HtmlEncode($Grid->potongan1->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->potongan2->Visible) { // potongan2 ?>
        <td data-name="potongan2"<?= $Grid->potongan2->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_potongan2" class="el_gajisd_detil_potongan2">
<input type="<?= $Grid->potongan2->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_potongan2" id="x<?= $Grid->RowIndex ?>_potongan2" data-table="gajisd_detil" data-field="x_potongan2" value="<?= $Grid->potongan2->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->potongan2->getPlaceHolder()) ?>"<?= $Grid->potongan2->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->potongan2->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_potongan2" data-hidden="1" name="o<?= $Grid->RowIndex ?>_potongan2" id="o<?= $Grid->RowIndex ?>_potongan2" value="<?= HtmlEncode($Grid->potongan2->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_potongan2" class="el_gajisd_detil_potongan2">
<input type="<?= $Grid->potongan2->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_potongan2" id="x<?= $Grid->RowIndex ?>_potongan2" data-table="gajisd_detil" data-field="x_potongan2" value="<?= $Grid->potongan2->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->potongan2->getPlaceHolder()) ?>"<?= $Grid->potongan2->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->potongan2->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_potongan2" class="el_gajisd_detil_potongan2">
<span<?= $Grid->potongan2->viewAttributes() ?>>
<?= $Grid->potongan2->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_potongan2" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_potongan2" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_potongan2" value="<?= HtmlEncode($Grid->potongan2->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_potongan2" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_potongan2" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_potongan2" value="<?= HtmlEncode($Grid->potongan2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jumlahgaji->Visible) { // jumlahgaji ?>
        <td data-name="jumlahgaji"<?= $Grid->jumlahgaji->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jumlahgaji" class="el_gajisd_detil_jumlahgaji">
<input type="<?= $Grid->jumlahgaji->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jumlahgaji" id="x<?= $Grid->RowIndex ?>_jumlahgaji" data-table="gajisd_detil" data-field="x_jumlahgaji" value="<?= $Grid->jumlahgaji->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jumlahgaji->getPlaceHolder()) ?>"<?= $Grid->jumlahgaji->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumlahgaji->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumlahgaji" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jumlahgaji" id="o<?= $Grid->RowIndex ?>_jumlahgaji" value="<?= HtmlEncode($Grid->jumlahgaji->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jumlahgaji" class="el_gajisd_detil_jumlahgaji">
<input type="<?= $Grid->jumlahgaji->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jumlahgaji" id="x<?= $Grid->RowIndex ?>_jumlahgaji" data-table="gajisd_detil" data-field="x_jumlahgaji" value="<?= $Grid->jumlahgaji->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jumlahgaji->getPlaceHolder()) ?>"<?= $Grid->jumlahgaji->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumlahgaji->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jumlahgaji" class="el_gajisd_detil_jumlahgaji">
<span<?= $Grid->jumlahgaji->viewAttributes() ?>>
<?= $Grid->jumlahgaji->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumlahgaji" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_jumlahgaji" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_jumlahgaji" value="<?= HtmlEncode($Grid->jumlahgaji->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_jumlahgaji" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_jumlahgaji" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_jumlahgaji" value="<?= HtmlEncode($Grid->jumlahgaji->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jumgajitotal->Visible) { // jumgajitotal ?>
        <td data-name="jumgajitotal"<?= $Grid->jumgajitotal->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jumgajitotal" class="el_gajisd_detil_jumgajitotal">
<input type="<?= $Grid->jumgajitotal->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jumgajitotal" id="x<?= $Grid->RowIndex ?>_jumgajitotal" data-table="gajisd_detil" data-field="x_jumgajitotal" value="<?= $Grid->jumgajitotal->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jumgajitotal->getPlaceHolder()) ?>"<?= $Grid->jumgajitotal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumgajitotal->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumgajitotal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jumgajitotal" id="o<?= $Grid->RowIndex ?>_jumgajitotal" value="<?= HtmlEncode($Grid->jumgajitotal->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jumgajitotal" class="el_gajisd_detil_jumgajitotal">
<input type="<?= $Grid->jumgajitotal->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jumgajitotal" id="x<?= $Grid->RowIndex ?>_jumgajitotal" data-table="gajisd_detil" data-field="x_jumgajitotal" value="<?= $Grid->jumgajitotal->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jumgajitotal->getPlaceHolder()) ?>"<?= $Grid->jumgajitotal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumgajitotal->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajisd_detil_jumgajitotal" class="el_gajisd_detil_jumgajitotal">
<span<?= $Grid->jumgajitotal->viewAttributes() ?>>
<?= $Grid->jumgajitotal->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumgajitotal" data-hidden="1" name="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_jumgajitotal" id="fgajisd_detilgrid$x<?= $Grid->RowIndex ?>_jumgajitotal" value="<?= HtmlEncode($Grid->jumgajitotal->FormValue) ?>">
<input type="hidden" data-table="gajisd_detil" data-field="x_jumgajitotal" data-hidden="1" name="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_jumgajitotal" id="fgajisd_detilgrid$o<?= $Grid->RowIndex ?>_jumgajitotal" value="<?= HtmlEncode($Grid->jumgajitotal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fgajisd_detilgrid","load"], () => fgajisd_detilgrid.updateLists(<?= $Grid->RowIndex ?>));
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy")
        if (!$Grid->Recordset->EOF) {
            $Grid->Recordset->moveNext();
        }
}
?>
<?php
if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy" || $Grid->CurrentMode == "edit") {
    $Grid->RowIndex = '$rowindex$';
    $Grid->loadRowValues();

    // Set row properties
    $Grid->resetAttributes();
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_gajisd_detil", "data-rowtype" => ROWTYPE_ADD]);
    $Grid->RowAttrs->appendClass("ew-template");

    // Reset previous form error if any
    $Grid->resetFormError();

    // Render row
    $Grid->RowType = ROWTYPE_ADD;
    $Grid->renderRow();

    // Render list options
    $Grid->renderListOptions();
    $Grid->StartRowCount = 0;
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowIndex);
?>
    <?php if ($Grid->pegawai_id->Visible) { // pegawai_id ?>
        <td data-name="pegawai_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_pegawai_id" class="el_gajisd_detil_pegawai_id">
<?php $Grid->pegawai_id->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_pegawai_id"
        name="x<?= $Grid->RowIndex ?>_pegawai_id"
        class="form-control ew-select<?= $Grid->pegawai_id->isInvalidClass() ?>"
        data-select2-id="fgajisd_detilgrid_x<?= $Grid->RowIndex ?>_pegawai_id"
        data-table="gajisd_detil"
        data-field="x_pegawai_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->pegawai_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->pegawai_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->pegawai_id->getPlaceHolder()) ?>"
        <?= $Grid->pegawai_id->editAttributes() ?>>
        <?= $Grid->pegawai_id->selectOptionListHtml("x{$Grid->RowIndex}_pegawai_id") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->pegawai_id->getErrorMessage() ?></div>
<?= $Grid->pegawai_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_pegawai_id") ?>
<script>
loadjs.ready("fgajisd_detilgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_pegawai_id", selectId: "fgajisd_detilgrid_x<?= $Grid->RowIndex ?>_pegawai_id" };
    if (fgajisd_detilgrid.lists.pegawai_id.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_pegawai_id", form: "fgajisd_detilgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_pegawai_id", form: "fgajisd_detilgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.gajisd_detil.fields.pegawai_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_pegawai_id" class="el_gajisd_detil_pegawai_id">
<span<?= $Grid->pegawai_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->pegawai_id->getDisplayValue($Grid->pegawai_id->ViewValue) ?></span></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_pegawai_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_pegawai_id" id="x<?= $Grid->RowIndex ?>_pegawai_id" value="<?= HtmlEncode($Grid->pegawai_id->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_pegawai_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pegawai_id" id="o<?= $Grid->RowIndex ?>_pegawai_id" value="<?= HtmlEncode($Grid->pegawai_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jabatan_id->Visible) { // jabatan_id ?>
        <td data-name="jabatan_id">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_jabatan_id" class="el_gajisd_detil_jabatan_id">
<?php
$onchange = $Grid->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->jabatan_id->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Grid->jabatan_id->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_jabatan_id" class="ew-auto-suggest">
    <input type="<?= $Grid->jabatan_id->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_jabatan_id" id="sv_x<?= $Grid->RowIndex ?>_jabatan_id" value="<?= RemoveHtml($Grid->jabatan_id->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->jabatan_id->getPlaceHolder()) ?>"<?= $Grid->jabatan_id->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="gajisd_detil" data-field="x_jabatan_id" data-input="sv_x<?= $Grid->RowIndex ?>_jabatan_id" data-value-separator="<?= $Grid->jabatan_id->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_jabatan_id" id="x<?= $Grid->RowIndex ?>_jabatan_id" value="<?= HtmlEncode($Grid->jabatan_id->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->jabatan_id->getErrorMessage() ?></div>
<script>
loadjs.ready("fgajisd_detilgrid", function() {
    fgajisd_detilgrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_jabatan_id","forceSelect":false}, ew.vars.tables.gajisd_detil.fields.jabatan_id.autoSuggestOptions));
});
</script>
<?= $Grid->jabatan_id->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_jabatan_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_jabatan_id" class="el_gajisd_detil_jabatan_id">
<span<?= $Grid->jabatan_id->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->jabatan_id->getDisplayValue($Grid->jabatan_id->ViewValue) ?></span></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_jabatan_id" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jabatan_id" id="x<?= $Grid->RowIndex ?>_jabatan_id" value="<?= HtmlEncode($Grid->jabatan_id->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_jabatan_id" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jabatan_id" id="o<?= $Grid->RowIndex ?>_jabatan_id" value="<?= HtmlEncode($Grid->jabatan_id->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->masakerja->Visible) { // masakerja ?>
        <td data-name="masakerja">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_masakerja" class="el_gajisd_detil_masakerja">
<input type="<?= $Grid->masakerja->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_masakerja" id="x<?= $Grid->RowIndex ?>_masakerja" data-table="gajisd_detil" data-field="x_masakerja" value="<?= $Grid->masakerja->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->masakerja->getPlaceHolder()) ?>"<?= $Grid->masakerja->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->masakerja->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_masakerja" class="el_gajisd_detil_masakerja">
<span<?= $Grid->masakerja->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->masakerja->getDisplayValue($Grid->masakerja->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_masakerja" data-hidden="1" name="x<?= $Grid->RowIndex ?>_masakerja" id="x<?= $Grid->RowIndex ?>_masakerja" value="<?= HtmlEncode($Grid->masakerja->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_masakerja" data-hidden="1" name="o<?= $Grid->RowIndex ?>_masakerja" id="o<?= $Grid->RowIndex ?>_masakerja" value="<?= HtmlEncode($Grid->masakerja->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jumngajar->Visible) { // jumngajar ?>
        <td data-name="jumngajar">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_jumngajar" class="el_gajisd_detil_jumngajar">
<input type="<?= $Grid->jumngajar->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jumngajar" id="x<?= $Grid->RowIndex ?>_jumngajar" data-table="gajisd_detil" data-field="x_jumngajar" value="<?= $Grid->jumngajar->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jumngajar->getPlaceHolder()) ?>"<?= $Grid->jumngajar->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumngajar->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_jumngajar" class="el_gajisd_detil_jumngajar">
<span<?= $Grid->jumngajar->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jumngajar->getDisplayValue($Grid->jumngajar->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumngajar" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jumngajar" id="x<?= $Grid->RowIndex ?>_jumngajar" value="<?= HtmlEncode($Grid->jumngajar->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumngajar" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jumngajar" id="o<?= $Grid->RowIndex ?>_jumngajar" value="<?= HtmlEncode($Grid->jumngajar->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ijin->Visible) { // ijin ?>
        <td data-name="ijin">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_ijin" class="el_gajisd_detil_ijin">
<input type="<?= $Grid->ijin->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ijin" id="x<?= $Grid->RowIndex ?>_ijin" data-table="gajisd_detil" data-field="x_ijin" value="<?= $Grid->ijin->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->ijin->getPlaceHolder()) ?>"<?= $Grid->ijin->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ijin->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_ijin" class="el_gajisd_detil_ijin">
<span<?= $Grid->ijin->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ijin->getDisplayValue($Grid->ijin->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_ijin" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ijin" id="x<?= $Grid->RowIndex ?>_ijin" value="<?= HtmlEncode($Grid->ijin->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_ijin" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ijin" id="o<?= $Grid->RowIndex ?>_ijin" value="<?= HtmlEncode($Grid->ijin->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->baku->Visible) { // baku ?>
        <td data-name="baku">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_baku" class="el_gajisd_detil_baku">
<input type="<?= $Grid->baku->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_baku" id="x<?= $Grid->RowIndex ?>_baku" data-table="gajisd_detil" data-field="x_baku" value="<?= $Grid->baku->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->baku->getPlaceHolder()) ?>"<?= $Grid->baku->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->baku->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_baku" class="el_gajisd_detil_baku">
<span<?= $Grid->baku->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->baku->getDisplayValue($Grid->baku->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_baku" data-hidden="1" name="x<?= $Grid->RowIndex ?>_baku" id="x<?= $Grid->RowIndex ?>_baku" value="<?= HtmlEncode($Grid->baku->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_baku" data-hidden="1" name="o<?= $Grid->RowIndex ?>_baku" id="o<?= $Grid->RowIndex ?>_baku" value="<?= HtmlEncode($Grid->baku->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->kehadiran->Visible) { // kehadiran ?>
        <td data-name="kehadiran">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_kehadiran" class="el_gajisd_detil_kehadiran">
<input type="<?= $Grid->kehadiran->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_kehadiran" id="x<?= $Grid->RowIndex ?>_kehadiran" data-table="gajisd_detil" data-field="x_kehadiran" value="<?= $Grid->kehadiran->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->kehadiran->getPlaceHolder()) ?>"<?= $Grid->kehadiran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->kehadiran->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_kehadiran" class="el_gajisd_detil_kehadiran">
<span<?= $Grid->kehadiran->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->kehadiran->getDisplayValue($Grid->kehadiran->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_kehadiran" data-hidden="1" name="x<?= $Grid->RowIndex ?>_kehadiran" id="x<?= $Grid->RowIndex ?>_kehadiran" value="<?= HtmlEncode($Grid->kehadiran->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_kehadiran" data-hidden="1" name="o<?= $Grid->RowIndex ?>_kehadiran" id="o<?= $Grid->RowIndex ?>_kehadiran" value="<?= HtmlEncode($Grid->kehadiran->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->prestasi->Visible) { // prestasi ?>
        <td data-name="prestasi">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_prestasi" class="el_gajisd_detil_prestasi">
<input type="<?= $Grid->prestasi->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_prestasi" id="x<?= $Grid->RowIndex ?>_prestasi" data-table="gajisd_detil" data-field="x_prestasi" value="<?= $Grid->prestasi->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->prestasi->getPlaceHolder()) ?>"<?= $Grid->prestasi->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->prestasi->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_prestasi" class="el_gajisd_detil_prestasi">
<span<?= $Grid->prestasi->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->prestasi->getDisplayValue($Grid->prestasi->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_prestasi" data-hidden="1" name="x<?= $Grid->RowIndex ?>_prestasi" id="x<?= $Grid->RowIndex ?>_prestasi" value="<?= HtmlEncode($Grid->prestasi->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_prestasi" data-hidden="1" name="o<?= $Grid->RowIndex ?>_prestasi" id="o<?= $Grid->RowIndex ?>_prestasi" value="<?= HtmlEncode($Grid->prestasi->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nominal_baku->Visible) { // nominal_baku ?>
        <td data-name="nominal_baku">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_nominal_baku" class="el_gajisd_detil_nominal_baku">
<input type="<?= $Grid->nominal_baku->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nominal_baku" id="x<?= $Grid->RowIndex ?>_nominal_baku" data-table="gajisd_detil" data-field="x_nominal_baku" value="<?= $Grid->nominal_baku->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->nominal_baku->getPlaceHolder()) ?>"<?= $Grid->nominal_baku->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nominal_baku->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_nominal_baku" class="el_gajisd_detil_nominal_baku">
<span<?= $Grid->nominal_baku->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nominal_baku->getDisplayValue($Grid->nominal_baku->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_nominal_baku" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nominal_baku" id="x<?= $Grid->RowIndex ?>_nominal_baku" value="<?= HtmlEncode($Grid->nominal_baku->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_nominal_baku" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nominal_baku" id="o<?= $Grid->RowIndex ?>_nominal_baku" value="<?= HtmlEncode($Grid->nominal_baku->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jumlahterima->Visible) { // jumlahterima ?>
        <td data-name="jumlahterima">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_jumlahterima" class="el_gajisd_detil_jumlahterima">
<input type="<?= $Grid->jumlahterima->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jumlahterima" id="x<?= $Grid->RowIndex ?>_jumlahterima" data-table="gajisd_detil" data-field="x_jumlahterima" value="<?= $Grid->jumlahterima->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jumlahterima->getPlaceHolder()) ?>"<?= $Grid->jumlahterima->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumlahterima->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_jumlahterima" class="el_gajisd_detil_jumlahterima">
<span<?= $Grid->jumlahterima->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jumlahterima->getDisplayValue($Grid->jumlahterima->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumlahterima" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jumlahterima" id="x<?= $Grid->RowIndex ?>_jumlahterima" value="<?= HtmlEncode($Grid->jumlahterima->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumlahterima" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jumlahterima" id="o<?= $Grid->RowIndex ?>_jumlahterima" value="<?= HtmlEncode($Grid->jumlahterima->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
        <td data-name="tunjangan_wkosis">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_tunjangan_wkosis" class="el_gajisd_detil_tunjangan_wkosis">
<input type="<?= $Grid->tunjangan_wkosis->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tunjangan_wkosis" id="x<?= $Grid->RowIndex ?>_tunjangan_wkosis" data-table="gajisd_detil" data-field="x_tunjangan_wkosis" value="<?= $Grid->tunjangan_wkosis->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->tunjangan_wkosis->getPlaceHolder()) ?>"<?= $Grid->tunjangan_wkosis->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tunjangan_wkosis->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_tunjangan_wkosis" class="el_gajisd_detil_tunjangan_wkosis">
<span<?= $Grid->tunjangan_wkosis->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tunjangan_wkosis->getDisplayValue($Grid->tunjangan_wkosis->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_tunjangan_wkosis" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tunjangan_wkosis" id="x<?= $Grid->RowIndex ?>_tunjangan_wkosis" value="<?= HtmlEncode($Grid->tunjangan_wkosis->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_tunjangan_wkosis" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tunjangan_wkosis" id="o<?= $Grid->RowIndex ?>_tunjangan_wkosis" value="<?= HtmlEncode($Grid->tunjangan_wkosis->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->potongan1->Visible) { // potongan1 ?>
        <td data-name="potongan1">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_potongan1" class="el_gajisd_detil_potongan1">
<input type="<?= $Grid->potongan1->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_potongan1" id="x<?= $Grid->RowIndex ?>_potongan1" data-table="gajisd_detil" data-field="x_potongan1" value="<?= $Grid->potongan1->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->potongan1->getPlaceHolder()) ?>"<?= $Grid->potongan1->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->potongan1->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_potongan1" class="el_gajisd_detil_potongan1">
<span<?= $Grid->potongan1->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->potongan1->getDisplayValue($Grid->potongan1->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_potongan1" data-hidden="1" name="x<?= $Grid->RowIndex ?>_potongan1" id="x<?= $Grid->RowIndex ?>_potongan1" value="<?= HtmlEncode($Grid->potongan1->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_potongan1" data-hidden="1" name="o<?= $Grid->RowIndex ?>_potongan1" id="o<?= $Grid->RowIndex ?>_potongan1" value="<?= HtmlEncode($Grid->potongan1->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->potongan2->Visible) { // potongan2 ?>
        <td data-name="potongan2">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_potongan2" class="el_gajisd_detil_potongan2">
<input type="<?= $Grid->potongan2->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_potongan2" id="x<?= $Grid->RowIndex ?>_potongan2" data-table="gajisd_detil" data-field="x_potongan2" value="<?= $Grid->potongan2->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->potongan2->getPlaceHolder()) ?>"<?= $Grid->potongan2->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->potongan2->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_potongan2" class="el_gajisd_detil_potongan2">
<span<?= $Grid->potongan2->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->potongan2->getDisplayValue($Grid->potongan2->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_potongan2" data-hidden="1" name="x<?= $Grid->RowIndex ?>_potongan2" id="x<?= $Grid->RowIndex ?>_potongan2" value="<?= HtmlEncode($Grid->potongan2->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_potongan2" data-hidden="1" name="o<?= $Grid->RowIndex ?>_potongan2" id="o<?= $Grid->RowIndex ?>_potongan2" value="<?= HtmlEncode($Grid->potongan2->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jumlahgaji->Visible) { // jumlahgaji ?>
        <td data-name="jumlahgaji">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_jumlahgaji" class="el_gajisd_detil_jumlahgaji">
<input type="<?= $Grid->jumlahgaji->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jumlahgaji" id="x<?= $Grid->RowIndex ?>_jumlahgaji" data-table="gajisd_detil" data-field="x_jumlahgaji" value="<?= $Grid->jumlahgaji->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jumlahgaji->getPlaceHolder()) ?>"<?= $Grid->jumlahgaji->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumlahgaji->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_jumlahgaji" class="el_gajisd_detil_jumlahgaji">
<span<?= $Grid->jumlahgaji->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jumlahgaji->getDisplayValue($Grid->jumlahgaji->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumlahgaji" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jumlahgaji" id="x<?= $Grid->RowIndex ?>_jumlahgaji" value="<?= HtmlEncode($Grid->jumlahgaji->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumlahgaji" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jumlahgaji" id="o<?= $Grid->RowIndex ?>_jumlahgaji" value="<?= HtmlEncode($Grid->jumlahgaji->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jumgajitotal->Visible) { // jumgajitotal ?>
        <td data-name="jumgajitotal">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajisd_detil_jumgajitotal" class="el_gajisd_detil_jumgajitotal">
<input type="<?= $Grid->jumgajitotal->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jumgajitotal" id="x<?= $Grid->RowIndex ?>_jumgajitotal" data-table="gajisd_detil" data-field="x_jumgajitotal" value="<?= $Grid->jumgajitotal->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jumgajitotal->getPlaceHolder()) ?>"<?= $Grid->jumgajitotal->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jumgajitotal->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisd_detil_jumgajitotal" class="el_gajisd_detil_jumgajitotal">
<span<?= $Grid->jumgajitotal->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jumgajitotal->getDisplayValue($Grid->jumgajitotal->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumgajitotal" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jumgajitotal" id="x<?= $Grid->RowIndex ?>_jumgajitotal" value="<?= HtmlEncode($Grid->jumgajitotal->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajisd_detil" data-field="x_jumgajitotal" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jumgajitotal" id="o<?= $Grid->RowIndex ?>_jumgajitotal" value="<?= HtmlEncode($Grid->jumgajitotal->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fgajisd_detilgrid","load"], () => fgajisd_detilgrid.updateLists(<?= $Grid->RowIndex ?>, true));
</script>
    </tr>
<?php
}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fgajisd_detilgrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php if (!$Grid->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("gajisd_detil");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
