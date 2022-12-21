<?php

namespace PHPMaker2022\sigap;

// Set up and run Grid object
$Grid = Container("PegSkillGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fpeg_skillgrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpeg_skillgrid = new ew.Form("fpeg_skillgrid", "grid");
    fpeg_skillgrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { peg_skill: currentTable } });
    var fields = currentTable.fields;
    fpeg_skillgrid.addFields([
        ["c_by", [fields.c_by.visible && fields.c_by.required ? ew.Validators.required(fields.c_by.caption) : null], fields.c_by.isInvalid],
        ["keahlian", [fields.keahlian.visible && fields.keahlian.required ? ew.Validators.required(fields.keahlian.caption) : null], fields.keahlian.isInvalid],
        ["tingkat", [fields.tingkat.visible && fields.tingkat.required ? ew.Validators.required(fields.tingkat.caption) : null], fields.tingkat.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
        ["bukti", [fields.bukti.visible && fields.bukti.required ? ew.Validators.fileRequired(fields.bukti.caption) : null], fields.bukti.isInvalid],
        ["c_date", [fields.c_date.visible && fields.c_date.required ? ew.Validators.required(fields.c_date.caption) : null], fields.c_date.isInvalid],
        ["u_date", [fields.u_date.visible && fields.u_date.required ? ew.Validators.required(fields.u_date.caption) : null], fields.u_date.isInvalid],
        ["u_by", [fields.u_by.visible && fields.u_by.required ? ew.Validators.required(fields.u_by.caption) : null], fields.u_by.isInvalid]
    ]);

    // Check empty row
    fpeg_skillgrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["c_by",false],["keahlian",false],["tingkat",false],["keterangan",false],["bukti",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fpeg_skillgrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpeg_skillgrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpeg_skillgrid.lists.c_by = <?= $Grid->c_by->toClientList($Grid) ?>;
    fpeg_skillgrid.lists.u_by = <?= $Grid->u_by->toClientList($Grid) ?>;
    loadjs.done("fpeg_skillgrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> peg_skill">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<div id="fpeg_skillgrid" class="ew-form ew-list-form">
<div id="gmp_peg_skill" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_peg_skillgrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Grid->c_by->Visible) { // c_by ?>
        <th data-name="c_by" class="<?= $Grid->c_by->headerCellClass() ?>"><div id="elh_peg_skill_c_by" class="peg_skill_c_by"><?= $Grid->renderFieldHeader($Grid->c_by) ?></div></th>
<?php } ?>
<?php if ($Grid->keahlian->Visible) { // keahlian ?>
        <th data-name="keahlian" class="<?= $Grid->keahlian->headerCellClass() ?>"><div id="elh_peg_skill_keahlian" class="peg_skill_keahlian"><?= $Grid->renderFieldHeader($Grid->keahlian) ?></div></th>
<?php } ?>
<?php if ($Grid->tingkat->Visible) { // tingkat ?>
        <th data-name="tingkat" class="<?= $Grid->tingkat->headerCellClass() ?>"><div id="elh_peg_skill_tingkat" class="peg_skill_tingkat"><?= $Grid->renderFieldHeader($Grid->tingkat) ?></div></th>
<?php } ?>
<?php if ($Grid->keterangan->Visible) { // keterangan ?>
        <th data-name="keterangan" class="<?= $Grid->keterangan->headerCellClass() ?>"><div id="elh_peg_skill_keterangan" class="peg_skill_keterangan"><?= $Grid->renderFieldHeader($Grid->keterangan) ?></div></th>
<?php } ?>
<?php if ($Grid->bukti->Visible) { // bukti ?>
        <th data-name="bukti" class="<?= $Grid->bukti->headerCellClass() ?>"><div id="elh_peg_skill_bukti" class="peg_skill_bukti"><?= $Grid->renderFieldHeader($Grid->bukti) ?></div></th>
<?php } ?>
<?php if ($Grid->c_date->Visible) { // c_date ?>
        <th data-name="c_date" class="<?= $Grid->c_date->headerCellClass() ?>"><div id="elh_peg_skill_c_date" class="peg_skill_c_date"><?= $Grid->renderFieldHeader($Grid->c_date) ?></div></th>
<?php } ?>
<?php if ($Grid->u_date->Visible) { // u_date ?>
        <th data-name="u_date" class="<?= $Grid->u_date->headerCellClass() ?>"><div id="elh_peg_skill_u_date" class="peg_skill_u_date"><?= $Grid->renderFieldHeader($Grid->u_date) ?></div></th>
<?php } ?>
<?php if ($Grid->u_by->Visible) { // u_by ?>
        <th data-name="u_by" class="<?= $Grid->u_by->headerCellClass() ?>"><div id="elh_peg_skill_u_by" class="peg_skill_u_by"><?= $Grid->renderFieldHeader($Grid->u_by) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_peg_skill",
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
    <?php if ($Grid->c_by->Visible) { // c_by ?>
        <td data-name="c_by"<?= $Grid->c_by->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_c_by" class="el_peg_skill_c_by">
    <select
        id="x<?= $Grid->RowIndex ?>_c_by"
        name="x<?= $Grid->RowIndex ?>_c_by"
        class="form-select ew-select<?= $Grid->c_by->isInvalidClass() ?>"
        data-select2-id="fpeg_skillgrid_x<?= $Grid->RowIndex ?>_c_by"
        data-table="peg_skill"
        data-field="x_c_by"
        data-value-separator="<?= $Grid->c_by->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->c_by->getPlaceHolder()) ?>"
        <?= $Grid->c_by->editAttributes() ?>>
        <?= $Grid->c_by->selectOptionListHtml("x{$Grid->RowIndex}_c_by") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->c_by->getErrorMessage() ?></div>
<?= $Grid->c_by->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_c_by") ?>
<script>
loadjs.ready("fpeg_skillgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_c_by", selectId: "fpeg_skillgrid_x<?= $Grid->RowIndex ?>_c_by" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpeg_skillgrid.lists.c_by.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_c_by", form: "fpeg_skillgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_c_by", form: "fpeg_skillgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.peg_skill.fields.c_by.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_c_by" data-hidden="1" name="o<?= $Grid->RowIndex ?>_c_by" id="o<?= $Grid->RowIndex ?>_c_by" value="<?= HtmlEncode($Grid->c_by->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_c_by" class="el_peg_skill_c_by">
    <select
        id="x<?= $Grid->RowIndex ?>_c_by"
        name="x<?= $Grid->RowIndex ?>_c_by"
        class="form-select ew-select<?= $Grid->c_by->isInvalidClass() ?>"
        data-select2-id="fpeg_skillgrid_x<?= $Grid->RowIndex ?>_c_by"
        data-table="peg_skill"
        data-field="x_c_by"
        data-value-separator="<?= $Grid->c_by->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->c_by->getPlaceHolder()) ?>"
        <?= $Grid->c_by->editAttributes() ?>>
        <?= $Grid->c_by->selectOptionListHtml("x{$Grid->RowIndex}_c_by") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->c_by->getErrorMessage() ?></div>
<?= $Grid->c_by->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_c_by") ?>
<script>
loadjs.ready("fpeg_skillgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_c_by", selectId: "fpeg_skillgrid_x<?= $Grid->RowIndex ?>_c_by" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpeg_skillgrid.lists.c_by.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_c_by", form: "fpeg_skillgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_c_by", form: "fpeg_skillgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.peg_skill.fields.c_by.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_c_by" class="el_peg_skill_c_by">
<span<?= $Grid->c_by->viewAttributes() ?>>
<?= $Grid->c_by->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_c_by" data-hidden="1" name="fpeg_skillgrid$x<?= $Grid->RowIndex ?>_c_by" id="fpeg_skillgrid$x<?= $Grid->RowIndex ?>_c_by" value="<?= HtmlEncode($Grid->c_by->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_c_by" data-hidden="1" name="fpeg_skillgrid$o<?= $Grid->RowIndex ?>_c_by" id="fpeg_skillgrid$o<?= $Grid->RowIndex ?>_c_by" value="<?= HtmlEncode($Grid->c_by->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->keahlian->Visible) { // keahlian ?>
        <td data-name="keahlian"<?= $Grid->keahlian->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_keahlian" class="el_peg_skill_keahlian">
<input type="<?= $Grid->keahlian->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_keahlian" id="x<?= $Grid->RowIndex ?>_keahlian" data-table="peg_skill" data-field="x_keahlian" value="<?= $Grid->keahlian->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->keahlian->getPlaceHolder()) ?>"<?= $Grid->keahlian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->keahlian->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_keahlian" data-hidden="1" name="o<?= $Grid->RowIndex ?>_keahlian" id="o<?= $Grid->RowIndex ?>_keahlian" value="<?= HtmlEncode($Grid->keahlian->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_keahlian" class="el_peg_skill_keahlian">
<input type="<?= $Grid->keahlian->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_keahlian" id="x<?= $Grid->RowIndex ?>_keahlian" data-table="peg_skill" data-field="x_keahlian" value="<?= $Grid->keahlian->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->keahlian->getPlaceHolder()) ?>"<?= $Grid->keahlian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->keahlian->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_keahlian" class="el_peg_skill_keahlian">
<span<?= $Grid->keahlian->viewAttributes() ?>>
<?= $Grid->keahlian->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_keahlian" data-hidden="1" name="fpeg_skillgrid$x<?= $Grid->RowIndex ?>_keahlian" id="fpeg_skillgrid$x<?= $Grid->RowIndex ?>_keahlian" value="<?= HtmlEncode($Grid->keahlian->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_keahlian" data-hidden="1" name="fpeg_skillgrid$o<?= $Grid->RowIndex ?>_keahlian" id="fpeg_skillgrid$o<?= $Grid->RowIndex ?>_keahlian" value="<?= HtmlEncode($Grid->keahlian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tingkat->Visible) { // tingkat ?>
        <td data-name="tingkat"<?= $Grid->tingkat->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_tingkat" class="el_peg_skill_tingkat">
<input type="<?= $Grid->tingkat->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tingkat" id="x<?= $Grid->RowIndex ?>_tingkat" data-table="peg_skill" data-field="x_tingkat" value="<?= $Grid->tingkat->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->tingkat->getPlaceHolder()) ?>"<?= $Grid->tingkat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tingkat->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_tingkat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tingkat" id="o<?= $Grid->RowIndex ?>_tingkat" value="<?= HtmlEncode($Grid->tingkat->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_tingkat" class="el_peg_skill_tingkat">
<input type="<?= $Grid->tingkat->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tingkat" id="x<?= $Grid->RowIndex ?>_tingkat" data-table="peg_skill" data-field="x_tingkat" value="<?= $Grid->tingkat->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->tingkat->getPlaceHolder()) ?>"<?= $Grid->tingkat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tingkat->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_tingkat" class="el_peg_skill_tingkat">
<span<?= $Grid->tingkat->viewAttributes() ?>>
<?= $Grid->tingkat->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_tingkat" data-hidden="1" name="fpeg_skillgrid$x<?= $Grid->RowIndex ?>_tingkat" id="fpeg_skillgrid$x<?= $Grid->RowIndex ?>_tingkat" value="<?= HtmlEncode($Grid->tingkat->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_tingkat" data-hidden="1" name="fpeg_skillgrid$o<?= $Grid->RowIndex ?>_tingkat" id="fpeg_skillgrid$o<?= $Grid->RowIndex ?>_tingkat" value="<?= HtmlEncode($Grid->tingkat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->keterangan->Visible) { // keterangan ?>
        <td data-name="keterangan"<?= $Grid->keterangan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_keterangan" class="el_peg_skill_keterangan">
<input type="<?= $Grid->keterangan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_keterangan" id="x<?= $Grid->RowIndex ?>_keterangan" data-table="peg_skill" data-field="x_keterangan" value="<?= $Grid->keterangan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->keterangan->getPlaceHolder()) ?>"<?= $Grid->keterangan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->keterangan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_keterangan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_keterangan" id="o<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_keterangan" class="el_peg_skill_keterangan">
<input type="<?= $Grid->keterangan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_keterangan" id="x<?= $Grid->RowIndex ?>_keterangan" data-table="peg_skill" data-field="x_keterangan" value="<?= $Grid->keterangan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->keterangan->getPlaceHolder()) ?>"<?= $Grid->keterangan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->keterangan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_keterangan" class="el_peg_skill_keterangan">
<span<?= $Grid->keterangan->viewAttributes() ?>>
<?= $Grid->keterangan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_keterangan" data-hidden="1" name="fpeg_skillgrid$x<?= $Grid->RowIndex ?>_keterangan" id="fpeg_skillgrid$x<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_keterangan" data-hidden="1" name="fpeg_skillgrid$o<?= $Grid->RowIndex ?>_keterangan" id="fpeg_skillgrid$o<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->bukti->Visible) { // bukti ?>
        <td data-name="bukti"<?= $Grid->bukti->cellAttributes() ?>>
<?php if ($Grid->RowAction == "insert") { // Add record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_bukti" class="el_peg_skill_bukti">
<div id="fd_x<?= $Grid->RowIndex ?>_bukti" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Grid->bukti->title() ?>" data-table="peg_skill" data-field="x_bukti" name="x<?= $Grid->RowIndex ?>_bukti" id="x<?= $Grid->RowIndex ?>_bukti" lang="<?= CurrentLanguageID() ?>"<?= $Grid->bukti->editAttributes() ?><?= ($Grid->bukti->ReadOnly || $Grid->bukti->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Grid->bukti->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_bukti" id= "fn_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_bukti" id= "fa_x<?= $Grid->RowIndex ?>_bukti" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_bukti" id= "fs_x<?= $Grid->RowIndex ?>_bukti" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_bukti" id= "fx_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_bukti" id= "fm_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_bukti" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_bukti" class="el_peg_skill_bukti">
<div id="fd_x<?= $Grid->RowIndex ?>_bukti">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->bukti->title() ?>" data-table="peg_skill" data-field="x_bukti" name="x<?= $Grid->RowIndex ?>_bukti" id="x<?= $Grid->RowIndex ?>_bukti" lang="<?= CurrentLanguageID() ?>"<?= $Grid->bukti->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->bukti->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_bukti" id= "fn_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_bukti" id= "fa_x<?= $Grid->RowIndex ?>_bukti" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_bukti" id= "fs_x<?= $Grid->RowIndex ?>_bukti" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_bukti" id= "fx_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_bukti" id= "fm_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_bukti" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_bukti" data-hidden="1" name="o<?= $Grid->RowIndex ?>_bukti" id="o<?= $Grid->RowIndex ?>_bukti" value="<?= HtmlEncode($Grid->bukti->OldValue) ?>">
<?php } elseif ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_bukti" class="el_peg_skill_bukti">
<span<?= $Grid->bukti->viewAttributes() ?>>
<?= GetFileViewTag($Grid->bukti, $Grid->bukti->getViewValue(), false) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_bukti" class="el_peg_skill_bukti">
<div id="fd_x<?= $Grid->RowIndex ?>_bukti">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->bukti->title() ?>" data-table="peg_skill" data-field="x_bukti" name="x<?= $Grid->RowIndex ?>_bukti" id="x<?= $Grid->RowIndex ?>_bukti" lang="<?= CurrentLanguageID() ?>"<?= $Grid->bukti->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->bukti->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_bukti" id= "fn_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_bukti" id= "fa_x<?= $Grid->RowIndex ?>_bukti" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_bukti") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_bukti" id= "fs_x<?= $Grid->RowIndex ?>_bukti" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_bukti" id= "fx_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_bukti" id= "fm_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_bukti" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_bukti" class="el_peg_skill_bukti">
<div id="fd_x<?= $Grid->RowIndex ?>_bukti">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->bukti->title() ?>" data-table="peg_skill" data-field="x_bukti" name="x<?= $Grid->RowIndex ?>_bukti" id="x<?= $Grid->RowIndex ?>_bukti" lang="<?= CurrentLanguageID() ?>"<?= $Grid->bukti->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->bukti->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_bukti" id= "fn_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_bukti" id= "fa_x<?= $Grid->RowIndex ?>_bukti" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_bukti") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_bukti" id= "fs_x<?= $Grid->RowIndex ?>_bukti" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_bukti" id= "fx_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_bukti" id= "fm_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_bukti" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->c_date->Visible) { // c_date ?>
        <td data-name="c_date"<?= $Grid->c_date->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="peg_skill" data-field="x_c_date" data-hidden="1" name="o<?= $Grid->RowIndex ?>_c_date" id="o<?= $Grid->RowIndex ?>_c_date" value="<?= HtmlEncode($Grid->c_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_c_date" class="el_peg_skill_c_date">
<span<?= $Grid->c_date->viewAttributes() ?>>
<?= $Grid->c_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_c_date" data-hidden="1" name="fpeg_skillgrid$x<?= $Grid->RowIndex ?>_c_date" id="fpeg_skillgrid$x<?= $Grid->RowIndex ?>_c_date" value="<?= HtmlEncode($Grid->c_date->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_c_date" data-hidden="1" name="fpeg_skillgrid$o<?= $Grid->RowIndex ?>_c_date" id="fpeg_skillgrid$o<?= $Grid->RowIndex ?>_c_date" value="<?= HtmlEncode($Grid->c_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->u_date->Visible) { // u_date ?>
        <td data-name="u_date"<?= $Grid->u_date->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="peg_skill" data-field="x_u_date" data-hidden="1" name="o<?= $Grid->RowIndex ?>_u_date" id="o<?= $Grid->RowIndex ?>_u_date" value="<?= HtmlEncode($Grid->u_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_u_date" class="el_peg_skill_u_date">
<span<?= $Grid->u_date->viewAttributes() ?>>
<?= $Grid->u_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_u_date" data-hidden="1" name="fpeg_skillgrid$x<?= $Grid->RowIndex ?>_u_date" id="fpeg_skillgrid$x<?= $Grid->RowIndex ?>_u_date" value="<?= HtmlEncode($Grid->u_date->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_u_date" data-hidden="1" name="fpeg_skillgrid$o<?= $Grid->RowIndex ?>_u_date" id="fpeg_skillgrid$o<?= $Grid->RowIndex ?>_u_date" value="<?= HtmlEncode($Grid->u_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->u_by->Visible) { // u_by ?>
        <td data-name="u_by"<?= $Grid->u_by->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="peg_skill" data-field="x_u_by" data-hidden="1" name="o<?= $Grid->RowIndex ?>_u_by" id="o<?= $Grid->RowIndex ?>_u_by" value="<?= HtmlEncode($Grid->u_by->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_skill_u_by" class="el_peg_skill_u_by">
<span<?= $Grid->u_by->viewAttributes() ?>>
<?= $Grid->u_by->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_u_by" data-hidden="1" name="fpeg_skillgrid$x<?= $Grid->RowIndex ?>_u_by" id="fpeg_skillgrid$x<?= $Grid->RowIndex ?>_u_by" value="<?= HtmlEncode($Grid->u_by->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_u_by" data-hidden="1" name="fpeg_skillgrid$o<?= $Grid->RowIndex ?>_u_by" id="fpeg_skillgrid$o<?= $Grid->RowIndex ?>_u_by" value="<?= HtmlEncode($Grid->u_by->OldValue) ?>">
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
loadjs.ready(["fpeg_skillgrid","load"], () => fpeg_skillgrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_peg_skill", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->c_by->Visible) { // c_by ?>
        <td data-name="c_by">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_c_by" class="el_peg_skill_c_by">
    <select
        id="x<?= $Grid->RowIndex ?>_c_by"
        name="x<?= $Grid->RowIndex ?>_c_by"
        class="form-select ew-select<?= $Grid->c_by->isInvalidClass() ?>"
        data-select2-id="fpeg_skillgrid_x<?= $Grid->RowIndex ?>_c_by"
        data-table="peg_skill"
        data-field="x_c_by"
        data-value-separator="<?= $Grid->c_by->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->c_by->getPlaceHolder()) ?>"
        <?= $Grid->c_by->editAttributes() ?>>
        <?= $Grid->c_by->selectOptionListHtml("x{$Grid->RowIndex}_c_by") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->c_by->getErrorMessage() ?></div>
<?= $Grid->c_by->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_c_by") ?>
<script>
loadjs.ready("fpeg_skillgrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_c_by", selectId: "fpeg_skillgrid_x<?= $Grid->RowIndex ?>_c_by" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpeg_skillgrid.lists.c_by.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_c_by", form: "fpeg_skillgrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_c_by", form: "fpeg_skillgrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.peg_skill.fields.c_by.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_c_by" class="el_peg_skill_c_by">
<span<?= $Grid->c_by->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->c_by->getDisplayValue($Grid->c_by->ViewValue) ?></span></span>
<input type="hidden" data-table="peg_skill" data-field="x_c_by" data-hidden="1" name="x<?= $Grid->RowIndex ?>_c_by" id="x<?= $Grid->RowIndex ?>_c_by" value="<?= HtmlEncode($Grid->c_by->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_c_by" data-hidden="1" name="o<?= $Grid->RowIndex ?>_c_by" id="o<?= $Grid->RowIndex ?>_c_by" value="<?= HtmlEncode($Grid->c_by->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->keahlian->Visible) { // keahlian ?>
        <td data-name="keahlian">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_keahlian" class="el_peg_skill_keahlian">
<input type="<?= $Grid->keahlian->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_keahlian" id="x<?= $Grid->RowIndex ?>_keahlian" data-table="peg_skill" data-field="x_keahlian" value="<?= $Grid->keahlian->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->keahlian->getPlaceHolder()) ?>"<?= $Grid->keahlian->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->keahlian->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_keahlian" class="el_peg_skill_keahlian">
<span<?= $Grid->keahlian->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->keahlian->getDisplayValue($Grid->keahlian->ViewValue))) ?>"></span>
<input type="hidden" data-table="peg_skill" data-field="x_keahlian" data-hidden="1" name="x<?= $Grid->RowIndex ?>_keahlian" id="x<?= $Grid->RowIndex ?>_keahlian" value="<?= HtmlEncode($Grid->keahlian->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_keahlian" data-hidden="1" name="o<?= $Grid->RowIndex ?>_keahlian" id="o<?= $Grid->RowIndex ?>_keahlian" value="<?= HtmlEncode($Grid->keahlian->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tingkat->Visible) { // tingkat ?>
        <td data-name="tingkat">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_tingkat" class="el_peg_skill_tingkat">
<input type="<?= $Grid->tingkat->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tingkat" id="x<?= $Grid->RowIndex ?>_tingkat" data-table="peg_skill" data-field="x_tingkat" value="<?= $Grid->tingkat->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->tingkat->getPlaceHolder()) ?>"<?= $Grid->tingkat->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tingkat->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_tingkat" class="el_peg_skill_tingkat">
<span<?= $Grid->tingkat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tingkat->getDisplayValue($Grid->tingkat->ViewValue))) ?>"></span>
<input type="hidden" data-table="peg_skill" data-field="x_tingkat" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tingkat" id="x<?= $Grid->RowIndex ?>_tingkat" value="<?= HtmlEncode($Grid->tingkat->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_tingkat" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tingkat" id="o<?= $Grid->RowIndex ?>_tingkat" value="<?= HtmlEncode($Grid->tingkat->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->keterangan->Visible) { // keterangan ?>
        <td data-name="keterangan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_keterangan" class="el_peg_skill_keterangan">
<input type="<?= $Grid->keterangan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_keterangan" id="x<?= $Grid->RowIndex ?>_keterangan" data-table="peg_skill" data-field="x_keterangan" value="<?= $Grid->keterangan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->keterangan->getPlaceHolder()) ?>"<?= $Grid->keterangan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->keterangan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_keterangan" class="el_peg_skill_keterangan">
<span<?= $Grid->keterangan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->keterangan->getDisplayValue($Grid->keterangan->ViewValue))) ?>"></span>
<input type="hidden" data-table="peg_skill" data-field="x_keterangan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_keterangan" id="x<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_keterangan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_keterangan" id="o<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->bukti->Visible) { // bukti ?>
        <td data-name="bukti">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_bukti" class="el_peg_skill_bukti">
<div id="fd_x<?= $Grid->RowIndex ?>_bukti" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Grid->bukti->title() ?>" data-table="peg_skill" data-field="x_bukti" name="x<?= $Grid->RowIndex ?>_bukti" id="x<?= $Grid->RowIndex ?>_bukti" lang="<?= CurrentLanguageID() ?>"<?= $Grid->bukti->editAttributes() ?><?= ($Grid->bukti->ReadOnly || $Grid->bukti->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Grid->bukti->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_bukti" id= "fn_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_bukti" id= "fa_x<?= $Grid->RowIndex ?>_bukti" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_bukti" id= "fs_x<?= $Grid->RowIndex ?>_bukti" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_bukti" id= "fx_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_bukti" id= "fm_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_bukti" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_bukti" class="el_peg_skill_bukti">
<div id="fd_x<?= $Grid->RowIndex ?>_bukti">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->bukti->title() ?>" data-table="peg_skill" data-field="x_bukti" name="x<?= $Grid->RowIndex ?>_bukti" id="x<?= $Grid->RowIndex ?>_bukti" lang="<?= CurrentLanguageID() ?>"<?= $Grid->bukti->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->bukti->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_bukti" id= "fn_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_bukti" id= "fa_x<?= $Grid->RowIndex ?>_bukti" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_bukti" id= "fs_x<?= $Grid->RowIndex ?>_bukti" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_bukti" id= "fx_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_bukti" id= "fm_x<?= $Grid->RowIndex ?>_bukti" value="<?= $Grid->bukti->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_bukti" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_bukti" data-hidden="1" name="o<?= $Grid->RowIndex ?>_bukti" id="o<?= $Grid->RowIndex ?>_bukti" value="<?= HtmlEncode($Grid->bukti->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->c_date->Visible) { // c_date ?>
        <td data-name="c_date">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_c_date" class="el_peg_skill_c_date">
<span<?= $Grid->c_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->c_date->getDisplayValue($Grid->c_date->ViewValue))) ?>"></span>
<input type="hidden" data-table="peg_skill" data-field="x_c_date" data-hidden="1" name="x<?= $Grid->RowIndex ?>_c_date" id="x<?= $Grid->RowIndex ?>_c_date" value="<?= HtmlEncode($Grid->c_date->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_c_date" data-hidden="1" name="o<?= $Grid->RowIndex ?>_c_date" id="o<?= $Grid->RowIndex ?>_c_date" value="<?= HtmlEncode($Grid->c_date->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->u_date->Visible) { // u_date ?>
        <td data-name="u_date">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_u_date" class="el_peg_skill_u_date">
<span<?= $Grid->u_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->u_date->getDisplayValue($Grid->u_date->ViewValue))) ?>"></span>
<input type="hidden" data-table="peg_skill" data-field="x_u_date" data-hidden="1" name="x<?= $Grid->RowIndex ?>_u_date" id="x<?= $Grid->RowIndex ?>_u_date" value="<?= HtmlEncode($Grid->u_date->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_u_date" data-hidden="1" name="o<?= $Grid->RowIndex ?>_u_date" id="o<?= $Grid->RowIndex ?>_u_date" value="<?= HtmlEncode($Grid->u_date->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->u_by->Visible) { // u_by ?>
        <td data-name="u_by">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_u_by" class="el_peg_skill_u_by">
<span<?= $Grid->u_by->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->u_by->getDisplayValue($Grid->u_by->ViewValue) ?></span></span>
<input type="hidden" data-table="peg_skill" data-field="x_u_by" data-hidden="1" name="x<?= $Grid->RowIndex ?>_u_by" id="x<?= $Grid->RowIndex ?>_u_by" value="<?= HtmlEncode($Grid->u_by->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_u_by" data-hidden="1" name="o<?= $Grid->RowIndex ?>_u_by" id="o<?= $Grid->RowIndex ?>_u_by" value="<?= HtmlEncode($Grid->u_by->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fpeg_skillgrid","load"], () => fpeg_skillgrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="fpeg_skillgrid">
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
    ew.addEventHandlers("peg_skill");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
