<?php

namespace PHPMaker2022\sigap;

// Set up and run Grid object
$Grid = Container("PegKeluargaGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fpeg_keluargagrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpeg_keluargagrid = new ew.Form("fpeg_keluargagrid", "grid");
    fpeg_keluargagrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { peg_keluarga: currentTable } });
    var fields = currentTable.fields;
    fpeg_keluargagrid.addFields([
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["hp", [fields.hp.visible && fields.hp.required ? ew.Validators.required(fields.hp.caption) : null], fields.hp.isInvalid],
        ["hubungan", [fields.hubungan.visible && fields.hubungan.required ? ew.Validators.required(fields.hubungan.caption) : null], fields.hubungan.isInvalid],
        ["tgl_lahir", [fields.tgl_lahir.visible && fields.tgl_lahir.required ? ew.Validators.required(fields.tgl_lahir.caption) : null, ew.Validators.datetime(fields.tgl_lahir.clientFormatPattern)], fields.tgl_lahir.isInvalid],
        ["jen_kel", [fields.jen_kel.visible && fields.jen_kel.required ? ew.Validators.required(fields.jen_kel.caption) : null], fields.jen_kel.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid]
    ]);

    // Check empty row
    fpeg_keluargagrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["nama",false],["hp",false],["hubungan",false],["tgl_lahir",false],["jen_kel",false],["keterangan",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fpeg_keluargagrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpeg_keluargagrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpeg_keluargagrid.lists.jen_kel = <?= $Grid->jen_kel->toClientList($Grid) ?>;
    loadjs.done("fpeg_keluargagrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> peg_keluarga">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<div id="fpeg_keluargagrid" class="ew-form ew-list-form">
<div id="gmp_peg_keluarga" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_peg_keluargagrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
<?php if ($Grid->nama->Visible) { // nama ?>
        <th data-name="nama" class="<?= $Grid->nama->headerCellClass() ?>"><div id="elh_peg_keluarga_nama" class="peg_keluarga_nama"><?= $Grid->renderFieldHeader($Grid->nama) ?></div></th>
<?php } ?>
<?php if ($Grid->hp->Visible) { // hp ?>
        <th data-name="hp" class="<?= $Grid->hp->headerCellClass() ?>"><div id="elh_peg_keluarga_hp" class="peg_keluarga_hp"><?= $Grid->renderFieldHeader($Grid->hp) ?></div></th>
<?php } ?>
<?php if ($Grid->hubungan->Visible) { // hubungan ?>
        <th data-name="hubungan" class="<?= $Grid->hubungan->headerCellClass() ?>"><div id="elh_peg_keluarga_hubungan" class="peg_keluarga_hubungan"><?= $Grid->renderFieldHeader($Grid->hubungan) ?></div></th>
<?php } ?>
<?php if ($Grid->tgl_lahir->Visible) { // tgl_lahir ?>
        <th data-name="tgl_lahir" class="<?= $Grid->tgl_lahir->headerCellClass() ?>"><div id="elh_peg_keluarga_tgl_lahir" class="peg_keluarga_tgl_lahir"><?= $Grid->renderFieldHeader($Grid->tgl_lahir) ?></div></th>
<?php } ?>
<?php if ($Grid->jen_kel->Visible) { // jen_kel ?>
        <th data-name="jen_kel" class="<?= $Grid->jen_kel->headerCellClass() ?>"><div id="elh_peg_keluarga_jen_kel" class="peg_keluarga_jen_kel"><?= $Grid->renderFieldHeader($Grid->jen_kel) ?></div></th>
<?php } ?>
<?php if ($Grid->keterangan->Visible) { // keterangan ?>
        <th data-name="keterangan" class="<?= $Grid->keterangan->headerCellClass() ?>"><div id="elh_peg_keluarga_keterangan" class="peg_keluarga_keterangan"><?= $Grid->renderFieldHeader($Grid->keterangan) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_peg_keluarga",
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
    <?php if ($Grid->nama->Visible) { // nama ?>
        <td data-name="nama"<?= $Grid->nama->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_nama" class="el_peg_keluarga_nama">
<input type="<?= $Grid->nama->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" data-table="peg_keluarga" data-field="x_nama" value="<?= $Grid->nama->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_nama" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama" id="o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_nama" class="el_peg_keluarga_nama">
<input type="<?= $Grid->nama->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" data-table="peg_keluarga" data-field="x_nama" value="<?= $Grid->nama->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_nama" class="el_peg_keluarga_nama">
<span<?= $Grid->nama->viewAttributes() ?>>
<?= $Grid->nama->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_nama" data-hidden="1" name="fpeg_keluargagrid$x<?= $Grid->RowIndex ?>_nama" id="fpeg_keluargagrid$x<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_nama" data-hidden="1" name="fpeg_keluargagrid$o<?= $Grid->RowIndex ?>_nama" id="fpeg_keluargagrid$o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->hp->Visible) { // hp ?>
        <td data-name="hp"<?= $Grid->hp->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_hp" class="el_peg_keluarga_hp">
<input type="<?= $Grid->hp->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_hp" id="x<?= $Grid->RowIndex ?>_hp" data-table="peg_keluarga" data-field="x_hp" value="<?= $Grid->hp->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->hp->getPlaceHolder()) ?>"<?= $Grid->hp->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hp->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_hp" data-hidden="1" name="o<?= $Grid->RowIndex ?>_hp" id="o<?= $Grid->RowIndex ?>_hp" value="<?= HtmlEncode($Grid->hp->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_hp" class="el_peg_keluarga_hp">
<input type="<?= $Grid->hp->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_hp" id="x<?= $Grid->RowIndex ?>_hp" data-table="peg_keluarga" data-field="x_hp" value="<?= $Grid->hp->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->hp->getPlaceHolder()) ?>"<?= $Grid->hp->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hp->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_hp" class="el_peg_keluarga_hp">
<span<?= $Grid->hp->viewAttributes() ?>>
<?= $Grid->hp->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_hp" data-hidden="1" name="fpeg_keluargagrid$x<?= $Grid->RowIndex ?>_hp" id="fpeg_keluargagrid$x<?= $Grid->RowIndex ?>_hp" value="<?= HtmlEncode($Grid->hp->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_hp" data-hidden="1" name="fpeg_keluargagrid$o<?= $Grid->RowIndex ?>_hp" id="fpeg_keluargagrid$o<?= $Grid->RowIndex ?>_hp" value="<?= HtmlEncode($Grid->hp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->hubungan->Visible) { // hubungan ?>
        <td data-name="hubungan"<?= $Grid->hubungan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_hubungan" class="el_peg_keluarga_hubungan">
<input type="<?= $Grid->hubungan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_hubungan" id="x<?= $Grid->RowIndex ?>_hubungan" data-table="peg_keluarga" data-field="x_hubungan" value="<?= $Grid->hubungan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->hubungan->getPlaceHolder()) ?>"<?= $Grid->hubungan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hubungan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_hubungan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_hubungan" id="o<?= $Grid->RowIndex ?>_hubungan" value="<?= HtmlEncode($Grid->hubungan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_hubungan" class="el_peg_keluarga_hubungan">
<input type="<?= $Grid->hubungan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_hubungan" id="x<?= $Grid->RowIndex ?>_hubungan" data-table="peg_keluarga" data-field="x_hubungan" value="<?= $Grid->hubungan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->hubungan->getPlaceHolder()) ?>"<?= $Grid->hubungan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hubungan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_hubungan" class="el_peg_keluarga_hubungan">
<span<?= $Grid->hubungan->viewAttributes() ?>>
<?= $Grid->hubungan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_hubungan" data-hidden="1" name="fpeg_keluargagrid$x<?= $Grid->RowIndex ?>_hubungan" id="fpeg_keluargagrid$x<?= $Grid->RowIndex ?>_hubungan" value="<?= HtmlEncode($Grid->hubungan->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_hubungan" data-hidden="1" name="fpeg_keluargagrid$o<?= $Grid->RowIndex ?>_hubungan" id="fpeg_keluargagrid$o<?= $Grid->RowIndex ?>_hubungan" value="<?= HtmlEncode($Grid->hubungan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->tgl_lahir->Visible) { // tgl_lahir ?>
        <td data-name="tgl_lahir"<?= $Grid->tgl_lahir->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_tgl_lahir" class="el_peg_keluarga_tgl_lahir">
<input type="<?= $Grid->tgl_lahir->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tgl_lahir" id="x<?= $Grid->RowIndex ?>_tgl_lahir" data-table="peg_keluarga" data-field="x_tgl_lahir" value="<?= $Grid->tgl_lahir->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tgl_lahir->getPlaceHolder()) ?>"<?= $Grid->tgl_lahir->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tgl_lahir->getErrorMessage() ?></div>
<?php if (!$Grid->tgl_lahir->ReadOnly && !$Grid->tgl_lahir->Disabled && !isset($Grid->tgl_lahir->EditAttrs["readonly"]) && !isset($Grid->tgl_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_keluargagrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem()
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                }
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("fpeg_keluargagrid", "x<?= $Grid->RowIndex ?>_tgl_lahir", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_tgl_lahir" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_lahir" id="o<?= $Grid->RowIndex ?>_tgl_lahir" value="<?= HtmlEncode($Grid->tgl_lahir->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_tgl_lahir" class="el_peg_keluarga_tgl_lahir">
<input type="<?= $Grid->tgl_lahir->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tgl_lahir" id="x<?= $Grid->RowIndex ?>_tgl_lahir" data-table="peg_keluarga" data-field="x_tgl_lahir" value="<?= $Grid->tgl_lahir->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tgl_lahir->getPlaceHolder()) ?>"<?= $Grid->tgl_lahir->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tgl_lahir->getErrorMessage() ?></div>
<?php if (!$Grid->tgl_lahir->ReadOnly && !$Grid->tgl_lahir->Disabled && !isset($Grid->tgl_lahir->EditAttrs["readonly"]) && !isset($Grid->tgl_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_keluargagrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem()
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                }
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("fpeg_keluargagrid", "x<?= $Grid->RowIndex ?>_tgl_lahir", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_tgl_lahir" class="el_peg_keluarga_tgl_lahir">
<span<?= $Grid->tgl_lahir->viewAttributes() ?>>
<?= $Grid->tgl_lahir->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_tgl_lahir" data-hidden="1" name="fpeg_keluargagrid$x<?= $Grid->RowIndex ?>_tgl_lahir" id="fpeg_keluargagrid$x<?= $Grid->RowIndex ?>_tgl_lahir" value="<?= HtmlEncode($Grid->tgl_lahir->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_tgl_lahir" data-hidden="1" name="fpeg_keluargagrid$o<?= $Grid->RowIndex ?>_tgl_lahir" id="fpeg_keluargagrid$o<?= $Grid->RowIndex ?>_tgl_lahir" value="<?= HtmlEncode($Grid->tgl_lahir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->jen_kel->Visible) { // jen_kel ?>
        <td data-name="jen_kel"<?= $Grid->jen_kel->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_jen_kel" class="el_peg_keluarga_jen_kel">
<template id="tp_x<?= $Grid->RowIndex ?>_jen_kel">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="peg_keluarga" data-field="x_jen_kel" name="x<?= $Grid->RowIndex ?>_jen_kel" id="x<?= $Grid->RowIndex ?>_jen_kel"<?= $Grid->jen_kel->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_jen_kel" class="ew-item-list"></div>
<selection-list hidden
    id="x<?= $Grid->RowIndex ?>_jen_kel"
    name="x<?= $Grid->RowIndex ?>_jen_kel"
    value="<?= HtmlEncode($Grid->jen_kel->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_jen_kel"
    data-bs-target="dsl_x<?= $Grid->RowIndex ?>_jen_kel"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->jen_kel->isInvalidClass() ?>"
    data-table="peg_keluarga"
    data-field="x_jen_kel"
    data-value-separator="<?= $Grid->jen_kel->displayValueSeparatorAttribute() ?>"
    <?= $Grid->jen_kel->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->jen_kel->getErrorMessage() ?></div>
<?= $Grid->jen_kel->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_jen_kel") ?>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_jen_kel" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jen_kel" id="o<?= $Grid->RowIndex ?>_jen_kel" value="<?= HtmlEncode($Grid->jen_kel->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_jen_kel" class="el_peg_keluarga_jen_kel">
<template id="tp_x<?= $Grid->RowIndex ?>_jen_kel">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="peg_keluarga" data-field="x_jen_kel" name="x<?= $Grid->RowIndex ?>_jen_kel" id="x<?= $Grid->RowIndex ?>_jen_kel"<?= $Grid->jen_kel->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_jen_kel" class="ew-item-list"></div>
<selection-list hidden
    id="x<?= $Grid->RowIndex ?>_jen_kel"
    name="x<?= $Grid->RowIndex ?>_jen_kel"
    value="<?= HtmlEncode($Grid->jen_kel->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_jen_kel"
    data-bs-target="dsl_x<?= $Grid->RowIndex ?>_jen_kel"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->jen_kel->isInvalidClass() ?>"
    data-table="peg_keluarga"
    data-field="x_jen_kel"
    data-value-separator="<?= $Grid->jen_kel->displayValueSeparatorAttribute() ?>"
    <?= $Grid->jen_kel->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->jen_kel->getErrorMessage() ?></div>
<?= $Grid->jen_kel->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_jen_kel") ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_jen_kel" class="el_peg_keluarga_jen_kel">
<span<?= $Grid->jen_kel->viewAttributes() ?>>
<?= $Grid->jen_kel->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_jen_kel" data-hidden="1" name="fpeg_keluargagrid$x<?= $Grid->RowIndex ?>_jen_kel" id="fpeg_keluargagrid$x<?= $Grid->RowIndex ?>_jen_kel" value="<?= HtmlEncode($Grid->jen_kel->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_jen_kel" data-hidden="1" name="fpeg_keluargagrid$o<?= $Grid->RowIndex ?>_jen_kel" id="fpeg_keluargagrid$o<?= $Grid->RowIndex ?>_jen_kel" value="<?= HtmlEncode($Grid->jen_kel->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->keterangan->Visible) { // keterangan ?>
        <td data-name="keterangan"<?= $Grid->keterangan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_keterangan" class="el_peg_keluarga_keterangan">
<textarea data-table="peg_keluarga" data-field="x_keterangan" name="x<?= $Grid->RowIndex ?>_keterangan" id="x<?= $Grid->RowIndex ?>_keterangan" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->keterangan->getPlaceHolder()) ?>"<?= $Grid->keterangan->editAttributes() ?>><?= $Grid->keterangan->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->keterangan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_keterangan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_keterangan" id="o<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_keterangan" class="el_peg_keluarga_keterangan">
<textarea data-table="peg_keluarga" data-field="x_keterangan" name="x<?= $Grid->RowIndex ?>_keterangan" id="x<?= $Grid->RowIndex ?>_keterangan" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->keterangan->getPlaceHolder()) ?>"<?= $Grid->keterangan->editAttributes() ?>><?= $Grid->keterangan->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->keterangan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_keluarga_keterangan" class="el_peg_keluarga_keterangan">
<span<?= $Grid->keterangan->viewAttributes() ?>>
<?= $Grid->keterangan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_keterangan" data-hidden="1" name="fpeg_keluargagrid$x<?= $Grid->RowIndex ?>_keterangan" id="fpeg_keluargagrid$x<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_keterangan" data-hidden="1" name="fpeg_keluargagrid$o<?= $Grid->RowIndex ?>_keterangan" id="fpeg_keluargagrid$o<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->OldValue) ?>">
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
loadjs.ready(["fpeg_keluargagrid","load"], () => fpeg_keluargagrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_peg_keluarga", "data-rowtype" => ROWTYPE_ADD]);
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
    <?php if ($Grid->nama->Visible) { // nama ?>
        <td data-name="nama">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_keluarga_nama" class="el_peg_keluarga_nama">
<input type="<?= $Grid->nama->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" data-table="peg_keluarga" data-field="x_nama" value="<?= $Grid->nama->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama->getPlaceHolder()) ?>"<?= $Grid->nama->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_keluarga_nama" class="el_peg_keluarga_nama">
<span<?= $Grid->nama->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nama->getDisplayValue($Grid->nama->ViewValue))) ?>"></span>
<input type="hidden" data-table="peg_keluarga" data-field="x_nama" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nama" id="x<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_nama" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama" id="o<?= $Grid->RowIndex ?>_nama" value="<?= HtmlEncode($Grid->nama->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->hp->Visible) { // hp ?>
        <td data-name="hp">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_keluarga_hp" class="el_peg_keluarga_hp">
<input type="<?= $Grid->hp->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_hp" id="x<?= $Grid->RowIndex ?>_hp" data-table="peg_keluarga" data-field="x_hp" value="<?= $Grid->hp->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->hp->getPlaceHolder()) ?>"<?= $Grid->hp->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hp->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_keluarga_hp" class="el_peg_keluarga_hp">
<span<?= $Grid->hp->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->hp->getDisplayValue($Grid->hp->ViewValue))) ?>"></span>
<input type="hidden" data-table="peg_keluarga" data-field="x_hp" data-hidden="1" name="x<?= $Grid->RowIndex ?>_hp" id="x<?= $Grid->RowIndex ?>_hp" value="<?= HtmlEncode($Grid->hp->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_hp" data-hidden="1" name="o<?= $Grid->RowIndex ?>_hp" id="o<?= $Grid->RowIndex ?>_hp" value="<?= HtmlEncode($Grid->hp->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->hubungan->Visible) { // hubungan ?>
        <td data-name="hubungan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_keluarga_hubungan" class="el_peg_keluarga_hubungan">
<input type="<?= $Grid->hubungan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_hubungan" id="x<?= $Grid->RowIndex ?>_hubungan" data-table="peg_keluarga" data-field="x_hubungan" value="<?= $Grid->hubungan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->hubungan->getPlaceHolder()) ?>"<?= $Grid->hubungan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->hubungan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_keluarga_hubungan" class="el_peg_keluarga_hubungan">
<span<?= $Grid->hubungan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->hubungan->getDisplayValue($Grid->hubungan->ViewValue))) ?>"></span>
<input type="hidden" data-table="peg_keluarga" data-field="x_hubungan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_hubungan" id="x<?= $Grid->RowIndex ?>_hubungan" value="<?= HtmlEncode($Grid->hubungan->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_hubungan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_hubungan" id="o<?= $Grid->RowIndex ?>_hubungan" value="<?= HtmlEncode($Grid->hubungan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->tgl_lahir->Visible) { // tgl_lahir ?>
        <td data-name="tgl_lahir">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_keluarga_tgl_lahir" class="el_peg_keluarga_tgl_lahir">
<input type="<?= $Grid->tgl_lahir->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_tgl_lahir" id="x<?= $Grid->RowIndex ?>_tgl_lahir" data-table="peg_keluarga" data-field="x_tgl_lahir" value="<?= $Grid->tgl_lahir->EditValue ?>" placeholder="<?= HtmlEncode($Grid->tgl_lahir->getPlaceHolder()) ?>"<?= $Grid->tgl_lahir->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->tgl_lahir->getErrorMessage() ?></div>
<?php if (!$Grid->tgl_lahir->ReadOnly && !$Grid->tgl_lahir->Disabled && !isset($Grid->tgl_lahir->EditAttrs["readonly"]) && !isset($Grid->tgl_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_keluargagrid", "datetimepicker"], function () {
    let format = "<?= DateFormat(0) ?>",
        options = {
            localization: {
                locale: ew.LANGUAGE_ID + "-u-nu-" + ew.getNumberingSystem()
            },
            display: {
                icons: {
                    previous: ew.IS_RTL ? "fas fa-chevron-right" : "fas fa-chevron-left",
                    next: ew.IS_RTL ? "fas fa-chevron-left" : "fas fa-chevron-right"
                },
                components: {
                    hours: !!format.match(/h/i),
                    minutes: !!format.match(/m/),
                    seconds: !!format.match(/s/i),
                    useTwentyfourHour: !!format.match(/H/)
                }
            },
            meta: {
                format
            }
        };
    ew.createDateTimePicker("fpeg_keluargagrid", "x<?= $Grid->RowIndex ?>_tgl_lahir", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_keluarga_tgl_lahir" class="el_peg_keluarga_tgl_lahir">
<span<?= $Grid->tgl_lahir->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->tgl_lahir->getDisplayValue($Grid->tgl_lahir->ViewValue))) ?>"></span>
<input type="hidden" data-table="peg_keluarga" data-field="x_tgl_lahir" data-hidden="1" name="x<?= $Grid->RowIndex ?>_tgl_lahir" id="x<?= $Grid->RowIndex ?>_tgl_lahir" value="<?= HtmlEncode($Grid->tgl_lahir->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_tgl_lahir" data-hidden="1" name="o<?= $Grid->RowIndex ?>_tgl_lahir" id="o<?= $Grid->RowIndex ?>_tgl_lahir" value="<?= HtmlEncode($Grid->tgl_lahir->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->jen_kel->Visible) { // jen_kel ?>
        <td data-name="jen_kel">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_keluarga_jen_kel" class="el_peg_keluarga_jen_kel">
<template id="tp_x<?= $Grid->RowIndex ?>_jen_kel">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="peg_keluarga" data-field="x_jen_kel" name="x<?= $Grid->RowIndex ?>_jen_kel" id="x<?= $Grid->RowIndex ?>_jen_kel"<?= $Grid->jen_kel->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x<?= $Grid->RowIndex ?>_jen_kel" class="ew-item-list"></div>
<selection-list hidden
    id="x<?= $Grid->RowIndex ?>_jen_kel"
    name="x<?= $Grid->RowIndex ?>_jen_kel"
    value="<?= HtmlEncode($Grid->jen_kel->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x<?= $Grid->RowIndex ?>_jen_kel"
    data-bs-target="dsl_x<?= $Grid->RowIndex ?>_jen_kel"
    data-repeatcolumn="5"
    class="form-control<?= $Grid->jen_kel->isInvalidClass() ?>"
    data-table="peg_keluarga"
    data-field="x_jen_kel"
    data-value-separator="<?= $Grid->jen_kel->displayValueSeparatorAttribute() ?>"
    <?= $Grid->jen_kel->editAttributes() ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->jen_kel->getErrorMessage() ?></div>
<?= $Grid->jen_kel->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_jen_kel") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_keluarga_jen_kel" class="el_peg_keluarga_jen_kel">
<span<?= $Grid->jen_kel->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->jen_kel->getDisplayValue($Grid->jen_kel->ViewValue) ?></span></span>
<input type="hidden" data-table="peg_keluarga" data-field="x_jen_kel" data-hidden="1" name="x<?= $Grid->RowIndex ?>_jen_kel" id="x<?= $Grid->RowIndex ?>_jen_kel" value="<?= HtmlEncode($Grid->jen_kel->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_jen_kel" data-hidden="1" name="o<?= $Grid->RowIndex ?>_jen_kel" id="o<?= $Grid->RowIndex ?>_jen_kel" value="<?= HtmlEncode($Grid->jen_kel->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->keterangan->Visible) { // keterangan ?>
        <td data-name="keterangan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_keluarga_keterangan" class="el_peg_keluarga_keterangan">
<textarea data-table="peg_keluarga" data-field="x_keterangan" name="x<?= $Grid->RowIndex ?>_keterangan" id="x<?= $Grid->RowIndex ?>_keterangan" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->keterangan->getPlaceHolder()) ?>"<?= $Grid->keterangan->editAttributes() ?>><?= $Grid->keterangan->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->keterangan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_keluarga_keterangan" class="el_peg_keluarga_keterangan">
<span<?= $Grid->keterangan->viewAttributes() ?>>
<?= $Grid->keterangan->ViewValue ?></span>
<input type="hidden" data-table="peg_keluarga" data-field="x_keterangan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_keterangan" id="x<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_keterangan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_keterangan" id="o<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fpeg_keluargagrid","load"], () => fpeg_keluargagrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="fpeg_keluargagrid">
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
    ew.addEventHandlers("peg_keluarga");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
