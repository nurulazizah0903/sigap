<?php

namespace PHPMaker2022\sigap;

// Set up and run Grid object
$Grid = Container("GajitunjanganGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fgajitunjangangrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajitunjangangrid = new ew.Form("fgajitunjangangrid", "grid");
    fgajitunjangangrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { gajitunjangan: currentTable } });
    var fields = currentTable.fields;
    fgajitunjangangrid.addFields([
        ["gapok", [fields.gapok.visible && fields.gapok.required ? ew.Validators.required(fields.gapok.caption) : null, ew.Validators.integer], fields.gapok.isInvalid],
        ["value_kehadiran", [fields.value_kehadiran.visible && fields.value_kehadiran.required ? ew.Validators.required(fields.value_kehadiran.caption) : null, ew.Validators.integer], fields.value_kehadiran.isInvalid],
        ["tunjangan_jabatan", [fields.tunjangan_jabatan.visible && fields.tunjangan_jabatan.required ? ew.Validators.required(fields.tunjangan_jabatan.caption) : null, ew.Validators.integer], fields.tunjangan_jabatan.isInvalid],
        ["tunjangan_khusus", [fields.tunjangan_khusus.visible && fields.tunjangan_khusus.required ? ew.Validators.required(fields.tunjangan_khusus.caption) : null, ew.Validators.integer], fields.tunjangan_khusus.isInvalid],
        ["reward", [fields.reward.visible && fields.reward.required ? ew.Validators.required(fields.reward.caption) : null, ew.Validators.integer], fields.reward.isInvalid],
        ["lembur", [fields.lembur.visible && fields.lembur.required ? ew.Validators.required(fields.lembur.caption) : null, ew.Validators.integer], fields.lembur.isInvalid],
        ["piket", [fields.piket.visible && fields.piket.required ? ew.Validators.required(fields.piket.caption) : null, ew.Validators.integer], fields.piket.isInvalid],
        ["inval", [fields.inval.visible && fields.inval.required ? ew.Validators.required(fields.inval.caption) : null, ew.Validators.integer], fields.inval.isInvalid],
        ["jam_lebih", [fields.jam_lebih.visible && fields.jam_lebih.required ? ew.Validators.required(fields.jam_lebih.caption) : null, ew.Validators.integer], fields.jam_lebih.isInvalid],
        ["ekstrakuri", [fields.ekstrakuri.visible && fields.ekstrakuri.required ? ew.Validators.required(fields.ekstrakuri.caption) : null, ew.Validators.integer], fields.ekstrakuri.isInvalid]
    ]);

    // Check empty row
    fgajitunjangangrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["gapok",false],["value_kehadiran",false],["tunjangan_jabatan",false],["tunjangan_khusus",false],["reward",false],["lembur",false],["piket",false],["inval",false],["jam_lebih",false],["ekstrakuri",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fgajitunjangangrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgajitunjangangrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fgajitunjangangrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajitunjangan">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<div id="fgajitunjangangrid" class="ew-form ew-list-form">
<div id="gmp_gajitunjangan" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_gajitunjangangrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Grid->gapok->Visible) { // gapok ?>
        <th data-name="gapok" class="<?= $Grid->gapok->headerCellClass() ?>"><div id="elh_gajitunjangan_gapok" class="gajitunjangan_gapok"><?= $Grid->renderFieldHeader($Grid->gapok) ?></div></th>
<?php } ?>
<?php if ($Grid->value_kehadiran->Visible) { // value_kehadiran ?>
        <th data-name="value_kehadiran" class="<?= $Grid->value_kehadiran->headerCellClass() ?>"><div id="elh_gajitunjangan_value_kehadiran" class="gajitunjangan_value_kehadiran"><?= $Grid->renderFieldHeader($Grid->value_kehadiran) ?></div></th>
<?php } ?>
<?php if ($Grid->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
        <th data-name="tunjangan_jabatan" class="<?= $Grid->tunjangan_jabatan->headerCellClass() ?>"><div id="elh_gajitunjangan_tunjangan_jabatan" class="gajitunjangan_tunjangan_jabatan"><?= $Grid->renderFieldHeader($Grid->tunjangan_jabatan) ?></div></th>
<?php } ?>
<?php if ($Grid->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
        <th data-name="tunjangan_khusus" class="<?= $Grid->tunjangan_khusus->headerCellClass() ?>"><div id="elh_gajitunjangan_tunjangan_khusus" class="gajitunjangan_tunjangan_khusus"><?= $Grid->renderFieldHeader($Grid->tunjangan_khusus) ?></div></th>
<?php } ?>
<?php if ($Grid->reward->Visible) { // reward ?>
        <th data-name="reward" class="<?= $Grid->reward->headerCellClass() ?>"><div id="elh_gajitunjangan_reward" class="gajitunjangan_reward"><?= $Grid->renderFieldHeader($Grid->reward) ?></div></th>
<?php } ?>
<?php if ($Grid->lembur->Visible) { // lembur ?>
        <th data-name="lembur" class="<?= $Grid->lembur->headerCellClass() ?>"><div id="elh_gajitunjangan_lembur" class="gajitunjangan_lembur"><?= $Grid->renderFieldHeader($Grid->lembur) ?></div></th>
<?php } ?>
<?php if ($Grid->piket->Visible) { // piket ?>
        <th data-name="piket" class="<?= $Grid->piket->headerCellClass() ?>"><div id="elh_gajitunjangan_piket" class="gajitunjangan_piket"><?= $Grid->renderFieldHeader($Grid->piket) ?></div></th>
<?php } ?>
<?php if ($Grid->inval->Visible) { // inval ?>
        <th data-name="inval" class="<?= $Grid->inval->headerCellClass() ?>"><div id="elh_gajitunjangan_inval" class="gajitunjangan_inval"><?= $Grid->renderFieldHeader($Grid->inval) ?></div></th>
<?php } ?>
<?php if ($Grid->jam_lebih->Visible) { // jam_lebih ?>
        <th data-name="jam_lebih" class="<?= $Grid->jam_lebih->headerCellClass() ?>"><div id="elh_gajitunjangan_jam_lebih" class="gajitunjangan_jam_lebih"><?= $Grid->renderFieldHeader($Grid->jam_lebih) ?></div></th>
<?php } ?>
<?php if ($Grid->ekstrakuri->Visible) { // ekstrakuri ?>
        <th data-name="ekstrakuri" class="<?= $Grid->ekstrakuri->headerCellClass() ?>"><div id="elh_gajitunjangan_ekstrakuri" class="gajitunjangan_ekstrakuri"><?= $Grid->renderFieldHeader($Grid->ekstrakuri) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_gajitunjangan",
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
    <?php if ($Grid->gapok->Visible) { // gapok ?>
        <td data-name="gapok"<?= $Grid->gapok->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_gapok" class="el_gajitunjangan_gapok">
<input type="<?= $Grid->gapok->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_gapok" id="x<?= $Grid->RowIndex ?>_gapok" data-table="gajitunjangan" data-field="x_gapok" value="<?= $Grid->gapok->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->gapok->getPlaceHolder()) ?>"<?= $Grid->gapok->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->gapok->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_gapok" data-hidden="1" name="o<?= $Grid->RowIndex ?>_gapok" id="o<?= $Grid->RowIndex ?>_gapok" value="<?= HtmlEncode($Grid->gapok->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_gapok" class="el_gajitunjangan_gapok">
<input type="<?= $Grid->gapok->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_gapok" id="x<?= $Grid->RowIndex ?>_gapok" data-table="gajitunjangan" data-field="x_gapok" value="<?= $Grid->gapok->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->gapok->getPlaceHolder()) ?>"<?= $Grid->gapok->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->gapok->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_gapok" class="el_gajitunjangan_gapok">
<span<?= $Grid->gapok->viewAttributes() ?>>
<?= $Grid->gapok->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_gapok" data-hidden="1" name="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_gapok" id="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_gapok" value="<?= HtmlEncode($Grid->gapok->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_gapok" data-hidden="1" name="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_gapok" id="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_gapok" value="<?= HtmlEncode($Grid->gapok->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->value_kehadiran->Visible) { // value_kehadiran ?>
        <td data-name="value_kehadiran"<?= $Grid->value_kehadiran->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_value_kehadiran" class="el_gajitunjangan_value_kehadiran">
<input type="<?= $Grid->value_kehadiran->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_value_kehadiran" id="x<?= $Grid->RowIndex ?>_value_kehadiran" data-table="gajitunjangan" data-field="x_value_kehadiran" value="<?= $Grid->value_kehadiran->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->value_kehadiran->getPlaceHolder()) ?>"<?= $Grid->value_kehadiran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->value_kehadiran->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_value_kehadiran" data-hidden="1" name="o<?= $Grid->RowIndex ?>_value_kehadiran" id="o<?= $Grid->RowIndex ?>_value_kehadiran" value="<?= HtmlEncode($Grid->value_kehadiran->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_value_kehadiran" class="el_gajitunjangan_value_kehadiran">
<input type="<?= $Grid->value_kehadiran->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_value_kehadiran" id="x<?= $Grid->RowIndex ?>_value_kehadiran" data-table="gajitunjangan" data-field="x_value_kehadiran" value="<?= $Grid->value_kehadiran->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->value_kehadiran->getPlaceHolder()) ?>"<?= $Grid->value_kehadiran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->value_kehadiran->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_value_kehadiran" class="el_gajitunjangan_value_kehadiran">
<span<?= $Grid->value_kehadiran->viewAttributes() ?>>
<?= $Grid->value_kehadiran->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_value_kehadiran" data-hidden="1" name="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_value_kehadiran" id="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_value_kehadiran" value="<?= HtmlEncode($Grid->value_kehadiran->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_value_kehadiran" data-hidden="1" name="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_value_kehadiran" id="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_value_kehadiran" value="<?= HtmlEncode($Grid->value_kehadiran->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
        <td data-name="tunjangan_jabatan"<?= $Grid->tunjangan_jabatan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_tunjangan_jabatan" class="el_gajitunjangan_tunjangan_jabatan">
<input type="<?= $Grid->tunjangan_jabatan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tunjangan_jabatan" id="x<?= $Grid->RowIndex ?>_tunjangan_jabatan" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" value="<?= $Grid->tunjangan_jabatan->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->tunjangan_jabatan->getPlaceHolder()) ?>"<?= $Grid->tunjangan_jabatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tunjangan_jabatan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tunjangan_jabatan" id="o<?= $Grid->RowIndex ?>_tunjangan_jabatan" value="<?= HtmlEncode($Grid->tunjangan_jabatan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_tunjangan_jabatan" class="el_gajitunjangan_tunjangan_jabatan">
<input type="<?= $Grid->tunjangan_jabatan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tunjangan_jabatan" id="x<?= $Grid->RowIndex ?>_tunjangan_jabatan" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" value="<?= $Grid->tunjangan_jabatan->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->tunjangan_jabatan->getPlaceHolder()) ?>"<?= $Grid->tunjangan_jabatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tunjangan_jabatan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_tunjangan_jabatan" class="el_gajitunjangan_tunjangan_jabatan">
<span<?= $Grid->tunjangan_jabatan->viewAttributes() ?>>
<?= $Grid->tunjangan_jabatan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" data-hidden="1" name="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_tunjangan_jabatan" id="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_tunjangan_jabatan" value="<?= HtmlEncode($Grid->tunjangan_jabatan->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" data-hidden="1" name="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_tunjangan_jabatan" id="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_tunjangan_jabatan" value="<?= HtmlEncode($Grid->tunjangan_jabatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
        <td data-name="tunjangan_khusus"<?= $Grid->tunjangan_khusus->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_tunjangan_khusus" class="el_gajitunjangan_tunjangan_khusus">
<input type="<?= $Grid->tunjangan_khusus->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tunjangan_khusus" id="x<?= $Grid->RowIndex ?>_tunjangan_khusus" data-table="gajitunjangan" data-field="x_tunjangan_khusus" value="<?= $Grid->tunjangan_khusus->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->tunjangan_khusus->getPlaceHolder()) ?>"<?= $Grid->tunjangan_khusus->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tunjangan_khusus->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_khusus" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tunjangan_khusus" id="o<?= $Grid->RowIndex ?>_tunjangan_khusus" value="<?= HtmlEncode($Grid->tunjangan_khusus->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_tunjangan_khusus" class="el_gajitunjangan_tunjangan_khusus">
<input type="<?= $Grid->tunjangan_khusus->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tunjangan_khusus" id="x<?= $Grid->RowIndex ?>_tunjangan_khusus" data-table="gajitunjangan" data-field="x_tunjangan_khusus" value="<?= $Grid->tunjangan_khusus->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->tunjangan_khusus->getPlaceHolder()) ?>"<?= $Grid->tunjangan_khusus->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tunjangan_khusus->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_tunjangan_khusus" class="el_gajitunjangan_tunjangan_khusus">
<span<?= $Grid->tunjangan_khusus->viewAttributes() ?>>
<?= $Grid->tunjangan_khusus->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_khusus" data-hidden="1" name="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_tunjangan_khusus" id="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_tunjangan_khusus" value="<?= HtmlEncode($Grid->tunjangan_khusus->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_khusus" data-hidden="1" name="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_tunjangan_khusus" id="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_tunjangan_khusus" value="<?= HtmlEncode($Grid->tunjangan_khusus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->reward->Visible) { // reward ?>
        <td data-name="reward"<?= $Grid->reward->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_reward" class="el_gajitunjangan_reward">
<input type="<?= $Grid->reward->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_reward" id="x<?= $Grid->RowIndex ?>_reward" data-table="gajitunjangan" data-field="x_reward" value="<?= $Grid->reward->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->reward->getPlaceHolder()) ?>"<?= $Grid->reward->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->reward->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_reward" data-hidden="1" name="o<?= $Grid->RowIndex ?>_reward" id="o<?= $Grid->RowIndex ?>_reward" value="<?= HtmlEncode($Grid->reward->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_reward" class="el_gajitunjangan_reward">
<input type="<?= $Grid->reward->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_reward" id="x<?= $Grid->RowIndex ?>_reward" data-table="gajitunjangan" data-field="x_reward" value="<?= $Grid->reward->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->reward->getPlaceHolder()) ?>"<?= $Grid->reward->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->reward->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_reward" class="el_gajitunjangan_reward">
<span<?= $Grid->reward->viewAttributes() ?>>
<?= $Grid->reward->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_reward" data-hidden="1" name="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_reward" id="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_reward" value="<?= HtmlEncode($Grid->reward->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_reward" data-hidden="1" name="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_reward" id="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_reward" value="<?= HtmlEncode($Grid->reward->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->lembur->Visible) { // lembur ?>
        <td data-name="lembur"<?= $Grid->lembur->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_lembur" class="el_gajitunjangan_lembur">
<input type="<?= $Grid->lembur->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_lembur" id="x<?= $Grid->RowIndex ?>_lembur" data-table="gajitunjangan" data-field="x_lembur" value="<?= $Grid->lembur->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->lembur->getPlaceHolder()) ?>"<?= $Grid->lembur->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lembur->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_lembur" data-hidden="1" name="o<?= $Grid->RowIndex ?>_lembur" id="o<?= $Grid->RowIndex ?>_lembur" value="<?= HtmlEncode($Grid->lembur->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_lembur" class="el_gajitunjangan_lembur">
<input type="<?= $Grid->lembur->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_lembur" id="x<?= $Grid->RowIndex ?>_lembur" data-table="gajitunjangan" data-field="x_lembur" value="<?= $Grid->lembur->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->lembur->getPlaceHolder()) ?>"<?= $Grid->lembur->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lembur->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_lembur" class="el_gajitunjangan_lembur">
<span<?= $Grid->lembur->viewAttributes() ?>>
<?= $Grid->lembur->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_lembur" data-hidden="1" name="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_lembur" id="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_lembur" value="<?= HtmlEncode($Grid->lembur->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_lembur" data-hidden="1" name="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_lembur" id="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_lembur" value="<?= HtmlEncode($Grid->lembur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->piket->Visible) { // piket ?>
        <td data-name="piket"<?= $Grid->piket->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_piket" class="el_gajitunjangan_piket">
<input type="<?= $Grid->piket->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_piket" id="x<?= $Grid->RowIndex ?>_piket" data-table="gajitunjangan" data-field="x_piket" value="<?= $Grid->piket->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->piket->getPlaceHolder()) ?>"<?= $Grid->piket->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->piket->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_piket" data-hidden="1" name="o<?= $Grid->RowIndex ?>_piket" id="o<?= $Grid->RowIndex ?>_piket" value="<?= HtmlEncode($Grid->piket->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_piket" class="el_gajitunjangan_piket">
<input type="<?= $Grid->piket->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_piket" id="x<?= $Grid->RowIndex ?>_piket" data-table="gajitunjangan" data-field="x_piket" value="<?= $Grid->piket->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->piket->getPlaceHolder()) ?>"<?= $Grid->piket->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->piket->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_piket" class="el_gajitunjangan_piket">
<span<?= $Grid->piket->viewAttributes() ?>>
<?= $Grid->piket->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_piket" data-hidden="1" name="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_piket" id="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_piket" value="<?= HtmlEncode($Grid->piket->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_piket" data-hidden="1" name="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_piket" id="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_piket" value="<?= HtmlEncode($Grid->piket->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->inval->Visible) { // inval ?>
        <td data-name="inval"<?= $Grid->inval->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_inval" class="el_gajitunjangan_inval">
<input type="<?= $Grid->inval->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_inval" id="x<?= $Grid->RowIndex ?>_inval" data-table="gajitunjangan" data-field="x_inval" value="<?= $Grid->inval->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->inval->getPlaceHolder()) ?>"<?= $Grid->inval->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->inval->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_inval" data-hidden="1" name="o<?= $Grid->RowIndex ?>_inval" id="o<?= $Grid->RowIndex ?>_inval" value="<?= HtmlEncode($Grid->inval->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_inval" class="el_gajitunjangan_inval">
<input type="<?= $Grid->inval->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_inval" id="x<?= $Grid->RowIndex ?>_inval" data-table="gajitunjangan" data-field="x_inval" value="<?= $Grid->inval->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->inval->getPlaceHolder()) ?>"<?= $Grid->inval->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->inval->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_inval" class="el_gajitunjangan_inval">
<span<?= $Grid->inval->viewAttributes() ?>>
<?= $Grid->inval->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_inval" data-hidden="1" name="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_inval" id="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_inval" value="<?= HtmlEncode($Grid->inval->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_inval" data-hidden="1" name="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_inval" id="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_inval" value="<?= HtmlEncode($Grid->inval->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jam_lebih->Visible) { // jam_lebih ?>
        <td data-name="jam_lebih"<?= $Grid->jam_lebih->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_jam_lebih" class="el_gajitunjangan_jam_lebih">
<input type="<?= $Grid->jam_lebih->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jam_lebih" id="x<?= $Grid->RowIndex ?>_jam_lebih" data-table="gajitunjangan" data-field="x_jam_lebih" value="<?= $Grid->jam_lebih->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jam_lebih->getPlaceHolder()) ?>"<?= $Grid->jam_lebih->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jam_lebih->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_jam_lebih" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jam_lebih" id="o<?= $Grid->RowIndex ?>_jam_lebih" value="<?= HtmlEncode($Grid->jam_lebih->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_jam_lebih" class="el_gajitunjangan_jam_lebih">
<input type="<?= $Grid->jam_lebih->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jam_lebih" id="x<?= $Grid->RowIndex ?>_jam_lebih" data-table="gajitunjangan" data-field="x_jam_lebih" value="<?= $Grid->jam_lebih->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jam_lebih->getPlaceHolder()) ?>"<?= $Grid->jam_lebih->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jam_lebih->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_jam_lebih" class="el_gajitunjangan_jam_lebih">
<span<?= $Grid->jam_lebih->viewAttributes() ?>>
<?= $Grid->jam_lebih->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_jam_lebih" data-hidden="1" name="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_jam_lebih" id="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_jam_lebih" value="<?= HtmlEncode($Grid->jam_lebih->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_jam_lebih" data-hidden="1" name="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_jam_lebih" id="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_jam_lebih" value="<?= HtmlEncode($Grid->jam_lebih->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ekstrakuri->Visible) { // ekstrakuri ?>
        <td data-name="ekstrakuri"<?= $Grid->ekstrakuri->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_ekstrakuri" class="el_gajitunjangan_ekstrakuri">
<input type="<?= $Grid->ekstrakuri->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ekstrakuri" id="x<?= $Grid->RowIndex ?>_ekstrakuri" data-table="gajitunjangan" data-field="x_ekstrakuri" value="<?= $Grid->ekstrakuri->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->ekstrakuri->getPlaceHolder()) ?>"<?= $Grid->ekstrakuri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ekstrakuri->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_ekstrakuri" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ekstrakuri" id="o<?= $Grid->RowIndex ?>_ekstrakuri" value="<?= HtmlEncode($Grid->ekstrakuri->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_ekstrakuri" class="el_gajitunjangan_ekstrakuri">
<input type="<?= $Grid->ekstrakuri->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ekstrakuri" id="x<?= $Grid->RowIndex ?>_ekstrakuri" data-table="gajitunjangan" data-field="x_ekstrakuri" value="<?= $Grid->ekstrakuri->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->ekstrakuri->getPlaceHolder()) ?>"<?= $Grid->ekstrakuri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ekstrakuri->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_gajitunjangan_ekstrakuri" class="el_gajitunjangan_ekstrakuri">
<span<?= $Grid->ekstrakuri->viewAttributes() ?>>
<?= $Grid->ekstrakuri->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_ekstrakuri" data-hidden="1" name="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_ekstrakuri" id="fgajitunjangangrid$x<?= $Grid->RowIndex ?>_ekstrakuri" value="<?= HtmlEncode($Grid->ekstrakuri->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_ekstrakuri" data-hidden="1" name="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_ekstrakuri" id="fgajitunjangangrid$o<?= $Grid->RowIndex ?>_ekstrakuri" value="<?= HtmlEncode($Grid->ekstrakuri->OldValue) ?>">
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
loadjs.ready(["fgajitunjangangrid","load"], () => fgajitunjangangrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_gajitunjangan", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->gapok->Visible) { // gapok ?>
        <td data-name="gapok">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_gapok" class="el_gajitunjangan_gapok">
<input type="<?= $Grid->gapok->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_gapok" id="x<?= $Grid->RowIndex ?>_gapok" data-table="gajitunjangan" data-field="x_gapok" value="<?= $Grid->gapok->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->gapok->getPlaceHolder()) ?>"<?= $Grid->gapok->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->gapok->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_gapok" class="el_gajitunjangan_gapok">
<span<?= $Grid->gapok->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->gapok->getDisplayValue($Grid->gapok->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajitunjangan" data-field="x_gapok" data-hidden="1" name="x<?= $Grid->RowIndex ?>_gapok" id="x<?= $Grid->RowIndex ?>_gapok" value="<?= HtmlEncode($Grid->gapok->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_gapok" data-hidden="1" name="o<?= $Grid->RowIndex ?>_gapok" id="o<?= $Grid->RowIndex ?>_gapok" value="<?= HtmlEncode($Grid->gapok->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->value_kehadiran->Visible) { // value_kehadiran ?>
        <td data-name="value_kehadiran">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_value_kehadiran" class="el_gajitunjangan_value_kehadiran">
<input type="<?= $Grid->value_kehadiran->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_value_kehadiran" id="x<?= $Grid->RowIndex ?>_value_kehadiran" data-table="gajitunjangan" data-field="x_value_kehadiran" value="<?= $Grid->value_kehadiran->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->value_kehadiran->getPlaceHolder()) ?>"<?= $Grid->value_kehadiran->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->value_kehadiran->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_value_kehadiran" class="el_gajitunjangan_value_kehadiran">
<span<?= $Grid->value_kehadiran->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->value_kehadiran->getDisplayValue($Grid->value_kehadiran->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajitunjangan" data-field="x_value_kehadiran" data-hidden="1" name="x<?= $Grid->RowIndex ?>_value_kehadiran" id="x<?= $Grid->RowIndex ?>_value_kehadiran" value="<?= HtmlEncode($Grid->value_kehadiran->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_value_kehadiran" data-hidden="1" name="o<?= $Grid->RowIndex ?>_value_kehadiran" id="o<?= $Grid->RowIndex ?>_value_kehadiran" value="<?= HtmlEncode($Grid->value_kehadiran->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
        <td data-name="tunjangan_jabatan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_tunjangan_jabatan" class="el_gajitunjangan_tunjangan_jabatan">
<input type="<?= $Grid->tunjangan_jabatan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tunjangan_jabatan" id="x<?= $Grid->RowIndex ?>_tunjangan_jabatan" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" value="<?= $Grid->tunjangan_jabatan->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->tunjangan_jabatan->getPlaceHolder()) ?>"<?= $Grid->tunjangan_jabatan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tunjangan_jabatan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_tunjangan_jabatan" class="el_gajitunjangan_tunjangan_jabatan">
<span<?= $Grid->tunjangan_jabatan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tunjangan_jabatan->getDisplayValue($Grid->tunjangan_jabatan->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tunjangan_jabatan" id="x<?= $Grid->RowIndex ?>_tunjangan_jabatan" value="<?= HtmlEncode($Grid->tunjangan_jabatan->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tunjangan_jabatan" id="o<?= $Grid->RowIndex ?>_tunjangan_jabatan" value="<?= HtmlEncode($Grid->tunjangan_jabatan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
        <td data-name="tunjangan_khusus">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_tunjangan_khusus" class="el_gajitunjangan_tunjangan_khusus">
<input type="<?= $Grid->tunjangan_khusus->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tunjangan_khusus" id="x<?= $Grid->RowIndex ?>_tunjangan_khusus" data-table="gajitunjangan" data-field="x_tunjangan_khusus" value="<?= $Grid->tunjangan_khusus->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->tunjangan_khusus->getPlaceHolder()) ?>"<?= $Grid->tunjangan_khusus->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tunjangan_khusus->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_tunjangan_khusus" class="el_gajitunjangan_tunjangan_khusus">
<span<?= $Grid->tunjangan_khusus->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tunjangan_khusus->getDisplayValue($Grid->tunjangan_khusus->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_khusus" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tunjangan_khusus" id="x<?= $Grid->RowIndex ?>_tunjangan_khusus" value="<?= HtmlEncode($Grid->tunjangan_khusus->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_khusus" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tunjangan_khusus" id="o<?= $Grid->RowIndex ?>_tunjangan_khusus" value="<?= HtmlEncode($Grid->tunjangan_khusus->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->reward->Visible) { // reward ?>
        <td data-name="reward">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_reward" class="el_gajitunjangan_reward">
<input type="<?= $Grid->reward->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_reward" id="x<?= $Grid->RowIndex ?>_reward" data-table="gajitunjangan" data-field="x_reward" value="<?= $Grid->reward->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->reward->getPlaceHolder()) ?>"<?= $Grid->reward->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->reward->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_reward" class="el_gajitunjangan_reward">
<span<?= $Grid->reward->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->reward->getDisplayValue($Grid->reward->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajitunjangan" data-field="x_reward" data-hidden="1" name="x<?= $Grid->RowIndex ?>_reward" id="x<?= $Grid->RowIndex ?>_reward" value="<?= HtmlEncode($Grid->reward->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_reward" data-hidden="1" name="o<?= $Grid->RowIndex ?>_reward" id="o<?= $Grid->RowIndex ?>_reward" value="<?= HtmlEncode($Grid->reward->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->lembur->Visible) { // lembur ?>
        <td data-name="lembur">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_lembur" class="el_gajitunjangan_lembur">
<input type="<?= $Grid->lembur->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_lembur" id="x<?= $Grid->RowIndex ?>_lembur" data-table="gajitunjangan" data-field="x_lembur" value="<?= $Grid->lembur->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->lembur->getPlaceHolder()) ?>"<?= $Grid->lembur->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->lembur->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_lembur" class="el_gajitunjangan_lembur">
<span<?= $Grid->lembur->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->lembur->getDisplayValue($Grid->lembur->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajitunjangan" data-field="x_lembur" data-hidden="1" name="x<?= $Grid->RowIndex ?>_lembur" id="x<?= $Grid->RowIndex ?>_lembur" value="<?= HtmlEncode($Grid->lembur->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_lembur" data-hidden="1" name="o<?= $Grid->RowIndex ?>_lembur" id="o<?= $Grid->RowIndex ?>_lembur" value="<?= HtmlEncode($Grid->lembur->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->piket->Visible) { // piket ?>
        <td data-name="piket">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_piket" class="el_gajitunjangan_piket">
<input type="<?= $Grid->piket->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_piket" id="x<?= $Grid->RowIndex ?>_piket" data-table="gajitunjangan" data-field="x_piket" value="<?= $Grid->piket->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->piket->getPlaceHolder()) ?>"<?= $Grid->piket->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->piket->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_piket" class="el_gajitunjangan_piket">
<span<?= $Grid->piket->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->piket->getDisplayValue($Grid->piket->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajitunjangan" data-field="x_piket" data-hidden="1" name="x<?= $Grid->RowIndex ?>_piket" id="x<?= $Grid->RowIndex ?>_piket" value="<?= HtmlEncode($Grid->piket->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_piket" data-hidden="1" name="o<?= $Grid->RowIndex ?>_piket" id="o<?= $Grid->RowIndex ?>_piket" value="<?= HtmlEncode($Grid->piket->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->inval->Visible) { // inval ?>
        <td data-name="inval">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_inval" class="el_gajitunjangan_inval">
<input type="<?= $Grid->inval->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_inval" id="x<?= $Grid->RowIndex ?>_inval" data-table="gajitunjangan" data-field="x_inval" value="<?= $Grid->inval->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->inval->getPlaceHolder()) ?>"<?= $Grid->inval->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->inval->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_inval" class="el_gajitunjangan_inval">
<span<?= $Grid->inval->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->inval->getDisplayValue($Grid->inval->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajitunjangan" data-field="x_inval" data-hidden="1" name="x<?= $Grid->RowIndex ?>_inval" id="x<?= $Grid->RowIndex ?>_inval" value="<?= HtmlEncode($Grid->inval->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_inval" data-hidden="1" name="o<?= $Grid->RowIndex ?>_inval" id="o<?= $Grid->RowIndex ?>_inval" value="<?= HtmlEncode($Grid->inval->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jam_lebih->Visible) { // jam_lebih ?>
        <td data-name="jam_lebih">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_jam_lebih" class="el_gajitunjangan_jam_lebih">
<input type="<?= $Grid->jam_lebih->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_jam_lebih" id="x<?= $Grid->RowIndex ?>_jam_lebih" data-table="gajitunjangan" data-field="x_jam_lebih" value="<?= $Grid->jam_lebih->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->jam_lebih->getPlaceHolder()) ?>"<?= $Grid->jam_lebih->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->jam_lebih->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_jam_lebih" class="el_gajitunjangan_jam_lebih">
<span<?= $Grid->jam_lebih->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->jam_lebih->getDisplayValue($Grid->jam_lebih->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajitunjangan" data-field="x_jam_lebih" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jam_lebih" id="x<?= $Grid->RowIndex ?>_jam_lebih" value="<?= HtmlEncode($Grid->jam_lebih->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_jam_lebih" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jam_lebih" id="o<?= $Grid->RowIndex ?>_jam_lebih" value="<?= HtmlEncode($Grid->jam_lebih->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ekstrakuri->Visible) { // ekstrakuri ?>
        <td data-name="ekstrakuri">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_ekstrakuri" class="el_gajitunjangan_ekstrakuri">
<input type="<?= $Grid->ekstrakuri->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_ekstrakuri" id="x<?= $Grid->RowIndex ?>_ekstrakuri" data-table="gajitunjangan" data-field="x_ekstrakuri" value="<?= $Grid->ekstrakuri->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Grid->ekstrakuri->getPlaceHolder()) ?>"<?= $Grid->ekstrakuri->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ekstrakuri->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_ekstrakuri" class="el_gajitunjangan_ekstrakuri">
<span<?= $Grid->ekstrakuri->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ekstrakuri->getDisplayValue($Grid->ekstrakuri->ViewValue))) ?>"></span>
<input type="hidden" data-table="gajitunjangan" data-field="x_ekstrakuri" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ekstrakuri" id="x<?= $Grid->RowIndex ?>_ekstrakuri" value="<?= HtmlEncode($Grid->ekstrakuri->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_ekstrakuri" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ekstrakuri" id="o<?= $Grid->RowIndex ?>_ekstrakuri" value="<?= HtmlEncode($Grid->ekstrakuri->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fgajitunjangangrid","load"], () => fgajitunjangangrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="fgajitunjangangrid">
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
    ew.addEventHandlers("gajitunjangan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
