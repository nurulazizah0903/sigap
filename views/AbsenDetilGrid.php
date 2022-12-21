<?php

namespace PHPMaker2022\sigap;

// Set up and run Grid object
$Grid = Container("AbsenDetilGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fabsen_detilgrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fabsen_detilgrid = new ew.Form("fabsen_detilgrid", "grid");
    fabsen_detilgrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { absen_detil: currentTable } });
    var fields = currentTable.fields;
    fabsen_detilgrid.addFields([
        ["pegawai", [fields.pegawai.visible && fields.pegawai.required ? ew.Validators.required(fields.pegawai.caption) : null, ew.Validators.integer], fields.pegawai.isInvalid],
        ["masuk", [fields.masuk.visible && fields.masuk.required ? ew.Validators.required(fields.masuk.caption) : null, ew.Validators.integer], fields.masuk.isInvalid],
        ["absen", [fields.absen.visible && fields.absen.required ? ew.Validators.required(fields.absen.caption) : null, ew.Validators.integer], fields.absen.isInvalid],
        ["ijin", [fields.ijin.visible && fields.ijin.required ? ew.Validators.required(fields.ijin.caption) : null, ew.Validators.integer], fields.ijin.isInvalid],
        ["cuti", [fields.cuti.visible && fields.cuti.required ? ew.Validators.required(fields.cuti.caption) : null, ew.Validators.integer], fields.cuti.isInvalid],
        ["dinas_luar", [fields.dinas_luar.visible && fields.dinas_luar.required ? ew.Validators.required(fields.dinas_luar.caption) : null, ew.Validators.integer], fields.dinas_luar.isInvalid],
        ["terlambat", [fields.terlambat.visible && fields.terlambat.required ? ew.Validators.required(fields.terlambat.caption) : null, ew.Validators.integer], fields.terlambat.isInvalid]
    ]);

    // Check empty row
    fabsen_detilgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["pegawai",false],["masuk",false],["absen",false],["ijin",false],["cuti",false],["dinas_luar",false],["terlambat",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fabsen_detilgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fabsen_detilgrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fabsen_detilgrid.lists.pegawai = <?= $Grid->pegawai->toClientList($Grid) ?>;
    loadjs.done("fabsen_detilgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> absen_detil">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<div id="fabsen_detilgrid" class="ew-form ew-list-form">
<div id="gmp_absen_detil" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_absen_detilgrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Grid->pegawai->Visible) { // pegawai ?>
        <th data-name="pegawai" class="<?= $Grid->pegawai->headerCellClass() ?>"><div id="elh_absen_detil_pegawai" class="absen_detil_pegawai"><?= $Grid->renderFieldHeader($Grid->pegawai) ?></div></th>
<?php } ?>
<?php if ($Grid->masuk->Visible) { // masuk ?>
        <th data-name="masuk" class="<?= $Grid->masuk->headerCellClass() ?>"><div id="elh_absen_detil_masuk" class="absen_detil_masuk"><?= $Grid->renderFieldHeader($Grid->masuk) ?></div></th>
<?php } ?>
<?php if ($Grid->absen->Visible) { // absen ?>
        <th data-name="absen" class="<?= $Grid->absen->headerCellClass() ?>"><div id="elh_absen_detil_absen" class="absen_detil_absen"><?= $Grid->renderFieldHeader($Grid->absen) ?></div></th>
<?php } ?>
<?php if ($Grid->ijin->Visible) { // ijin ?>
        <th data-name="ijin" class="<?= $Grid->ijin->headerCellClass() ?>"><div id="elh_absen_detil_ijin" class="absen_detil_ijin"><?= $Grid->renderFieldHeader($Grid->ijin) ?></div></th>
<?php } ?>
<?php if ($Grid->cuti->Visible) { // cuti ?>
        <th data-name="cuti" class="<?= $Grid->cuti->headerCellClass() ?>"><div id="elh_absen_detil_cuti" class="absen_detil_cuti"><?= $Grid->renderFieldHeader($Grid->cuti) ?></div></th>
<?php } ?>
<?php if ($Grid->dinas_luar->Visible) { // dinas_luar ?>
        <th data-name="dinas_luar" class="<?= $Grid->dinas_luar->headerCellClass() ?>"><div id="elh_absen_detil_dinas_luar" class="absen_detil_dinas_luar"><?= $Grid->renderFieldHeader($Grid->dinas_luar) ?></div></th>
<?php } ?>
<?php if ($Grid->terlambat->Visible) { // terlambat ?>
        <th data-name="terlambat" class="<?= $Grid->terlambat->headerCellClass() ?>"><div id="elh_absen_detil_terlambat" class="absen_detil_terlambat"><?= $Grid->renderFieldHeader($Grid->terlambat) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_absen_detil",
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
    <?php if ($Grid->pegawai->Visible) { // pegawai ?>
        <td data-name="pegawai"<?= $Grid->pegawai->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_pegawai" class="el_absen_detil_pegawai">
    <select
        id="x<?= $Grid->RowIndex ?>_pegawai"
        name="x<?= $Grid->RowIndex ?>_pegawai"
        class="form-control ew-select<?= $Grid->pegawai->isInvalidClass() ?>"
        data-select2-id="fabsen_detilgrid_x<?= $Grid->RowIndex ?>_pegawai"
        data-table="absen_detil"
        data-field="x_pegawai"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->pegawai->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->pegawai->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->pegawai->getPlaceHolder()) ?>"
        <?= $Grid->pegawai->editAttributes() ?>>
        <?= $Grid->pegawai->selectOptionListHtml("x{$Grid->RowIndex}_pegawai") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->pegawai->getErrorMessage() ?></div>
<?= $Grid->pegawai->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_pegawai") ?>
<script>
loadjs.ready("fabsen_detilgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_pegawai", selectId: "fabsen_detilgrid_x<?= $Grid->RowIndex ?>_pegawai" };
    if (fabsen_detilgrid.lists.pegawai.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_pegawai", form: "fabsen_detilgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_pegawai", form: "fabsen_detilgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.absen_detil.fields.pegawai.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_pegawai" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pegawai" id="o<?= $Grid->RowIndex ?>_pegawai" value="<?= HtmlEncode($Grid->pegawai->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_pegawai" class="el_absen_detil_pegawai">
    <select
        id="x<?= $Grid->RowIndex ?>_pegawai"
        name="x<?= $Grid->RowIndex ?>_pegawai"
        class="form-control ew-select<?= $Grid->pegawai->isInvalidClass() ?>"
        data-select2-id="fabsen_detilgrid_x<?= $Grid->RowIndex ?>_pegawai"
        data-table="absen_detil"
        data-field="x_pegawai"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->pegawai->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->pegawai->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->pegawai->getPlaceHolder()) ?>"
        <?= $Grid->pegawai->editAttributes() ?>>
        <?= $Grid->pegawai->selectOptionListHtml("x{$Grid->RowIndex}_pegawai") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->pegawai->getErrorMessage() ?></div>
<?= $Grid->pegawai->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_pegawai") ?>
<script>
loadjs.ready("fabsen_detilgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_pegawai", selectId: "fabsen_detilgrid_x<?= $Grid->RowIndex ?>_pegawai" };
    if (fabsen_detilgrid.lists.pegawai.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_pegawai", form: "fabsen_detilgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_pegawai", form: "fabsen_detilgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.absen_detil.fields.pegawai.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_pegawai" class="el_absen_detil_pegawai">
<span<?= $Grid->pegawai->viewAttributes() ?>>
<?= $Grid->pegawai->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_pegawai" data-hidden="1" name="fabsen_detilgrid$x<?= $Grid->RowIndex ?>_pegawai" id="fabsen_detilgrid$x<?= $Grid->RowIndex ?>_pegawai" value="<?= HtmlEncode($Grid->pegawai->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_pegawai" data-hidden="1" name="fabsen_detilgrid$o<?= $Grid->RowIndex ?>_pegawai" id="fabsen_detilgrid$o<?= $Grid->RowIndex ?>_pegawai" value="<?= HtmlEncode($Grid->pegawai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->masuk->Visible) { // masuk ?>
        <td data-name="masuk"<?= $Grid->masuk->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_masuk" class="el_absen_detil_masuk">
<input type="<?= $Grid->masuk->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_masuk" id="x<?= $Grid->RowIndex ?>_masuk" data-table="absen_detil" data-field="x_masuk" value="<?= $Grid->masuk->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->masuk->getPlaceHolder()) ?>"<?= $Grid->masuk->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->masuk->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_masuk" data-hidden="1" name="o<?= $Grid->RowIndex ?>_masuk" id="o<?= $Grid->RowIndex ?>_masuk" value="<?= HtmlEncode($Grid->masuk->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_masuk" class="el_absen_detil_masuk">
<input type="<?= $Grid->masuk->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_masuk" id="x<?= $Grid->RowIndex ?>_masuk" data-table="absen_detil" data-field="x_masuk" value="<?= $Grid->masuk->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->masuk->getPlaceHolder()) ?>"<?= $Grid->masuk->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->masuk->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_masuk" class="el_absen_detil_masuk">
<span<?= $Grid->masuk->viewAttributes() ?>>
<?= $Grid->masuk->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_masuk" data-hidden="1" name="fabsen_detilgrid$x<?= $Grid->RowIndex ?>_masuk" id="fabsen_detilgrid$x<?= $Grid->RowIndex ?>_masuk" value="<?= HtmlEncode($Grid->masuk->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_masuk" data-hidden="1" name="fabsen_detilgrid$o<?= $Grid->RowIndex ?>_masuk" id="fabsen_detilgrid$o<?= $Grid->RowIndex ?>_masuk" value="<?= HtmlEncode($Grid->masuk->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->absen->Visible) { // absen ?>
        <td data-name="absen"<?= $Grid->absen->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_absen" class="el_absen_detil_absen">
<input type="<?= $Grid->absen->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_absen" id="x<?= $Grid->RowIndex ?>_absen" data-table="absen_detil" data-field="x_absen" value="<?= $Grid->absen->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->absen->getPlaceHolder()) ?>"<?= $Grid->absen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->absen->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_absen" data-hidden="1" name="o<?= $Grid->RowIndex ?>_absen" id="o<?= $Grid->RowIndex ?>_absen" value="<?= HtmlEncode($Grid->absen->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_absen" class="el_absen_detil_absen">
<input type="<?= $Grid->absen->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_absen" id="x<?= $Grid->RowIndex ?>_absen" data-table="absen_detil" data-field="x_absen" value="<?= $Grid->absen->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->absen->getPlaceHolder()) ?>"<?= $Grid->absen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->absen->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_absen" class="el_absen_detil_absen">
<span<?= $Grid->absen->viewAttributes() ?>>
<?= $Grid->absen->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_absen" data-hidden="1" name="fabsen_detilgrid$x<?= $Grid->RowIndex ?>_absen" id="fabsen_detilgrid$x<?= $Grid->RowIndex ?>_absen" value="<?= HtmlEncode($Grid->absen->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_absen" data-hidden="1" name="fabsen_detilgrid$o<?= $Grid->RowIndex ?>_absen" id="fabsen_detilgrid$o<?= $Grid->RowIndex ?>_absen" value="<?= HtmlEncode($Grid->absen->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ijin->Visible) { // ijin ?>
        <td data-name="ijin"<?= $Grid->ijin->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_ijin" class="el_absen_detil_ijin">
<input type="<?= $Grid->ijin->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ijin" id="x<?= $Grid->RowIndex ?>_ijin" data-table="absen_detil" data-field="x_ijin" value="<?= $Grid->ijin->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->ijin->getPlaceHolder()) ?>"<?= $Grid->ijin->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ijin->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_ijin" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ijin" id="o<?= $Grid->RowIndex ?>_ijin" value="<?= HtmlEncode($Grid->ijin->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_ijin" class="el_absen_detil_ijin">
<input type="<?= $Grid->ijin->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ijin" id="x<?= $Grid->RowIndex ?>_ijin" data-table="absen_detil" data-field="x_ijin" value="<?= $Grid->ijin->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->ijin->getPlaceHolder()) ?>"<?= $Grid->ijin->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ijin->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_ijin" class="el_absen_detil_ijin">
<span<?= $Grid->ijin->viewAttributes() ?>>
<?= $Grid->ijin->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_ijin" data-hidden="1" name="fabsen_detilgrid$x<?= $Grid->RowIndex ?>_ijin" id="fabsen_detilgrid$x<?= $Grid->RowIndex ?>_ijin" value="<?= HtmlEncode($Grid->ijin->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_ijin" data-hidden="1" name="fabsen_detilgrid$o<?= $Grid->RowIndex ?>_ijin" id="fabsen_detilgrid$o<?= $Grid->RowIndex ?>_ijin" value="<?= HtmlEncode($Grid->ijin->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->cuti->Visible) { // cuti ?>
        <td data-name="cuti"<?= $Grid->cuti->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_cuti" class="el_absen_detil_cuti">
<input type="<?= $Grid->cuti->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_cuti" id="x<?= $Grid->RowIndex ?>_cuti" data-table="absen_detil" data-field="x_cuti" value="<?= $Grid->cuti->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->cuti->getPlaceHolder()) ?>"<?= $Grid->cuti->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->cuti->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_cuti" data-hidden="1" name="o<?= $Grid->RowIndex ?>_cuti" id="o<?= $Grid->RowIndex ?>_cuti" value="<?= HtmlEncode($Grid->cuti->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_cuti" class="el_absen_detil_cuti">
<input type="<?= $Grid->cuti->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_cuti" id="x<?= $Grid->RowIndex ?>_cuti" data-table="absen_detil" data-field="x_cuti" value="<?= $Grid->cuti->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->cuti->getPlaceHolder()) ?>"<?= $Grid->cuti->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->cuti->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_cuti" class="el_absen_detil_cuti">
<span<?= $Grid->cuti->viewAttributes() ?>>
<?= $Grid->cuti->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_cuti" data-hidden="1" name="fabsen_detilgrid$x<?= $Grid->RowIndex ?>_cuti" id="fabsen_detilgrid$x<?= $Grid->RowIndex ?>_cuti" value="<?= HtmlEncode($Grid->cuti->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_cuti" data-hidden="1" name="fabsen_detilgrid$o<?= $Grid->RowIndex ?>_cuti" id="fabsen_detilgrid$o<?= $Grid->RowIndex ?>_cuti" value="<?= HtmlEncode($Grid->cuti->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->dinas_luar->Visible) { // dinas_luar ?>
        <td data-name="dinas_luar"<?= $Grid->dinas_luar->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_dinas_luar" class="el_absen_detil_dinas_luar">
<input type="<?= $Grid->dinas_luar->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_dinas_luar" id="x<?= $Grid->RowIndex ?>_dinas_luar" data-table="absen_detil" data-field="x_dinas_luar" value="<?= $Grid->dinas_luar->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->dinas_luar->getPlaceHolder()) ?>"<?= $Grid->dinas_luar->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->dinas_luar->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_dinas_luar" data-hidden="1" name="o<?= $Grid->RowIndex ?>_dinas_luar" id="o<?= $Grid->RowIndex ?>_dinas_luar" value="<?= HtmlEncode($Grid->dinas_luar->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_dinas_luar" class="el_absen_detil_dinas_luar">
<input type="<?= $Grid->dinas_luar->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_dinas_luar" id="x<?= $Grid->RowIndex ?>_dinas_luar" data-table="absen_detil" data-field="x_dinas_luar" value="<?= $Grid->dinas_luar->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->dinas_luar->getPlaceHolder()) ?>"<?= $Grid->dinas_luar->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->dinas_luar->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_dinas_luar" class="el_absen_detil_dinas_luar">
<span<?= $Grid->dinas_luar->viewAttributes() ?>>
<?= $Grid->dinas_luar->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_dinas_luar" data-hidden="1" name="fabsen_detilgrid$x<?= $Grid->RowIndex ?>_dinas_luar" id="fabsen_detilgrid$x<?= $Grid->RowIndex ?>_dinas_luar" value="<?= HtmlEncode($Grid->dinas_luar->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_dinas_luar" data-hidden="1" name="fabsen_detilgrid$o<?= $Grid->RowIndex ?>_dinas_luar" id="fabsen_detilgrid$o<?= $Grid->RowIndex ?>_dinas_luar" value="<?= HtmlEncode($Grid->dinas_luar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->terlambat->Visible) { // terlambat ?>
        <td data-name="terlambat"<?= $Grid->terlambat->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_terlambat" class="el_absen_detil_terlambat">
<input type="<?= $Grid->terlambat->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_terlambat" id="x<?= $Grid->RowIndex ?>_terlambat" data-table="absen_detil" data-field="x_terlambat" value="<?= $Grid->terlambat->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->terlambat->getPlaceHolder()) ?>"<?= $Grid->terlambat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->terlambat->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_terlambat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_terlambat" id="o<?= $Grid->RowIndex ?>_terlambat" value="<?= HtmlEncode($Grid->terlambat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_terlambat" class="el_absen_detil_terlambat">
<input type="<?= $Grid->terlambat->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_terlambat" id="x<?= $Grid->RowIndex ?>_terlambat" data-table="absen_detil" data-field="x_terlambat" value="<?= $Grid->terlambat->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->terlambat->getPlaceHolder()) ?>"<?= $Grid->terlambat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->terlambat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_absen_detil_terlambat" class="el_absen_detil_terlambat">
<span<?= $Grid->terlambat->viewAttributes() ?>>
<?= $Grid->terlambat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_terlambat" data-hidden="1" name="fabsen_detilgrid$x<?= $Grid->RowIndex ?>_terlambat" id="fabsen_detilgrid$x<?= $Grid->RowIndex ?>_terlambat" value="<?= HtmlEncode($Grid->terlambat->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_terlambat" data-hidden="1" name="fabsen_detilgrid$o<?= $Grid->RowIndex ?>_terlambat" id="fabsen_detilgrid$o<?= $Grid->RowIndex ?>_terlambat" value="<?= HtmlEncode($Grid->terlambat->OldValue) ?>">
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
loadjs.ready(["fabsen_detilgrid","load"], () => fabsen_detilgrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_absen_detil", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->pegawai->Visible) { // pegawai ?>
        <td data-name="pegawai">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_pegawai" class="el_absen_detil_pegawai">
    <select
        id="x<?= $Grid->RowIndex ?>_pegawai"
        name="x<?= $Grid->RowIndex ?>_pegawai"
        class="form-control ew-select<?= $Grid->pegawai->isInvalidClass() ?>"
        data-select2-id="fabsen_detilgrid_x<?= $Grid->RowIndex ?>_pegawai"
        data-table="absen_detil"
        data-field="x_pegawai"
        data-caption="<?= HtmlEncode(RemoveHtml($Grid->pegawai->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Grid->pegawai->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->pegawai->getPlaceHolder()) ?>"
        <?= $Grid->pegawai->editAttributes() ?>>
        <?= $Grid->pegawai->selectOptionListHtml("x{$Grid->RowIndex}_pegawai") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->pegawai->getErrorMessage() ?></div>
<?= $Grid->pegawai->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_pegawai") ?>
<script>
loadjs.ready("fabsen_detilgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_pegawai", selectId: "fabsen_detilgrid_x<?= $Grid->RowIndex ?>_pegawai" };
    if (fabsen_detilgrid.lists.pegawai.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_pegawai", form: "fabsen_detilgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_pegawai", form: "fabsen_detilgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.absen_detil.fields.pegawai.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_pegawai" class="el_absen_detil_pegawai">
<span<?= $Grid->pegawai->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->pegawai->getDisplayValue($Grid->pegawai->ViewValue) ?></span></span>
<input type="hidden" data-table="absen_detil" data-field="x_pegawai" data-hidden="1" name="x<?= $Grid->RowIndex ?>_pegawai" id="x<?= $Grid->RowIndex ?>_pegawai" value="<?= HtmlEncode($Grid->pegawai->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_pegawai" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pegawai" id="o<?= $Grid->RowIndex ?>_pegawai" value="<?= HtmlEncode($Grid->pegawai->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->masuk->Visible) { // masuk ?>
        <td data-name="masuk">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_masuk" class="el_absen_detil_masuk">
<input type="<?= $Grid->masuk->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_masuk" id="x<?= $Grid->RowIndex ?>_masuk" data-table="absen_detil" data-field="x_masuk" value="<?= $Grid->masuk->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->masuk->getPlaceHolder()) ?>"<?= $Grid->masuk->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->masuk->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_masuk" class="el_absen_detil_masuk">
<span<?= $Grid->masuk->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->masuk->getDisplayValue($Grid->masuk->ViewValue))) ?>"></span>
<input type="hidden" data-table="absen_detil" data-field="x_masuk" data-hidden="1" name="x<?= $Grid->RowIndex ?>_masuk" id="x<?= $Grid->RowIndex ?>_masuk" value="<?= HtmlEncode($Grid->masuk->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_masuk" data-hidden="1" name="o<?= $Grid->RowIndex ?>_masuk" id="o<?= $Grid->RowIndex ?>_masuk" value="<?= HtmlEncode($Grid->masuk->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->absen->Visible) { // absen ?>
        <td data-name="absen">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_absen" class="el_absen_detil_absen">
<input type="<?= $Grid->absen->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_absen" id="x<?= $Grid->RowIndex ?>_absen" data-table="absen_detil" data-field="x_absen" value="<?= $Grid->absen->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->absen->getPlaceHolder()) ?>"<?= $Grid->absen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->absen->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_absen" class="el_absen_detil_absen">
<span<?= $Grid->absen->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->absen->getDisplayValue($Grid->absen->ViewValue))) ?>"></span>
<input type="hidden" data-table="absen_detil" data-field="x_absen" data-hidden="1" name="x<?= $Grid->RowIndex ?>_absen" id="x<?= $Grid->RowIndex ?>_absen" value="<?= HtmlEncode($Grid->absen->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_absen" data-hidden="1" name="o<?= $Grid->RowIndex ?>_absen" id="o<?= $Grid->RowIndex ?>_absen" value="<?= HtmlEncode($Grid->absen->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ijin->Visible) { // ijin ?>
        <td data-name="ijin">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_ijin" class="el_absen_detil_ijin">
<input type="<?= $Grid->ijin->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ijin" id="x<?= $Grid->RowIndex ?>_ijin" data-table="absen_detil" data-field="x_ijin" value="<?= $Grid->ijin->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->ijin->getPlaceHolder()) ?>"<?= $Grid->ijin->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ijin->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_ijin" class="el_absen_detil_ijin">
<span<?= $Grid->ijin->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ijin->getDisplayValue($Grid->ijin->ViewValue))) ?>"></span>
<input type="hidden" data-table="absen_detil" data-field="x_ijin" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ijin" id="x<?= $Grid->RowIndex ?>_ijin" value="<?= HtmlEncode($Grid->ijin->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_ijin" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ijin" id="o<?= $Grid->RowIndex ?>_ijin" value="<?= HtmlEncode($Grid->ijin->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->cuti->Visible) { // cuti ?>
        <td data-name="cuti">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_cuti" class="el_absen_detil_cuti">
<input type="<?= $Grid->cuti->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_cuti" id="x<?= $Grid->RowIndex ?>_cuti" data-table="absen_detil" data-field="x_cuti" value="<?= $Grid->cuti->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->cuti->getPlaceHolder()) ?>"<?= $Grid->cuti->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->cuti->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_cuti" class="el_absen_detil_cuti">
<span<?= $Grid->cuti->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->cuti->getDisplayValue($Grid->cuti->ViewValue))) ?>"></span>
<input type="hidden" data-table="absen_detil" data-field="x_cuti" data-hidden="1" name="x<?= $Grid->RowIndex ?>_cuti" id="x<?= $Grid->RowIndex ?>_cuti" value="<?= HtmlEncode($Grid->cuti->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_cuti" data-hidden="1" name="o<?= $Grid->RowIndex ?>_cuti" id="o<?= $Grid->RowIndex ?>_cuti" value="<?= HtmlEncode($Grid->cuti->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->dinas_luar->Visible) { // dinas_luar ?>
        <td data-name="dinas_luar">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_dinas_luar" class="el_absen_detil_dinas_luar">
<input type="<?= $Grid->dinas_luar->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_dinas_luar" id="x<?= $Grid->RowIndex ?>_dinas_luar" data-table="absen_detil" data-field="x_dinas_luar" value="<?= $Grid->dinas_luar->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->dinas_luar->getPlaceHolder()) ?>"<?= $Grid->dinas_luar->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->dinas_luar->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_dinas_luar" class="el_absen_detil_dinas_luar">
<span<?= $Grid->dinas_luar->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->dinas_luar->getDisplayValue($Grid->dinas_luar->ViewValue))) ?>"></span>
<input type="hidden" data-table="absen_detil" data-field="x_dinas_luar" data-hidden="1" name="x<?= $Grid->RowIndex ?>_dinas_luar" id="x<?= $Grid->RowIndex ?>_dinas_luar" value="<?= HtmlEncode($Grid->dinas_luar->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_dinas_luar" data-hidden="1" name="o<?= $Grid->RowIndex ?>_dinas_luar" id="o<?= $Grid->RowIndex ?>_dinas_luar" value="<?= HtmlEncode($Grid->dinas_luar->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->terlambat->Visible) { // terlambat ?>
        <td data-name="terlambat">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_terlambat" class="el_absen_detil_terlambat">
<input type="<?= $Grid->terlambat->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_terlambat" id="x<?= $Grid->RowIndex ?>_terlambat" data-table="absen_detil" data-field="x_terlambat" value="<?= $Grid->terlambat->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->terlambat->getPlaceHolder()) ?>"<?= $Grid->terlambat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->terlambat->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_terlambat" class="el_absen_detil_terlambat">
<span<?= $Grid->terlambat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->terlambat->getDisplayValue($Grid->terlambat->ViewValue))) ?>"></span>
<input type="hidden" data-table="absen_detil" data-field="x_terlambat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_terlambat" id="x<?= $Grid->RowIndex ?>_terlambat" value="<?= HtmlEncode($Grid->terlambat->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_terlambat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_terlambat" id="o<?= $Grid->RowIndex ?>_terlambat" value="<?= HtmlEncode($Grid->terlambat->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fabsen_detilgrid","load"], () => fabsen_detilgrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="fabsen_detilgrid">
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
    ew.addEventHandlers("absen_detil");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
