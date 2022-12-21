<?php

namespace PHPMaker2022\sigap;

// Set up and run Grid object
$Grid = Container("PegDokumenGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fpeg_dokumengrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpeg_dokumengrid = new ew.Form("fpeg_dokumengrid", "grid");
    fpeg_dokumengrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { peg_dokumen: currentTable } });
    var fields = currentTable.fields;
    fpeg_dokumengrid.addFields([
        ["c_by", [fields.c_by.visible && fields.c_by.required ? ew.Validators.required(fields.c_by.caption) : null, ew.Validators.integer], fields.c_by.isInvalid],
        ["nama_dokumen", [fields.nama_dokumen.visible && fields.nama_dokumen.required ? ew.Validators.required(fields.nama_dokumen.caption) : null], fields.nama_dokumen.isInvalid],
        ["file_dokumen", [fields.file_dokumen.visible && fields.file_dokumen.required ? ew.Validators.fileRequired(fields.file_dokumen.caption) : null], fields.file_dokumen.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
        ["c_date", [fields.c_date.visible && fields.c_date.required ? ew.Validators.required(fields.c_date.caption) : null], fields.c_date.isInvalid],
        ["u_date", [fields.u_date.visible && fields.u_date.required ? ew.Validators.required(fields.u_date.caption) : null], fields.u_date.isInvalid],
        ["u_by", [fields.u_by.visible && fields.u_by.required ? ew.Validators.required(fields.u_by.caption) : null], fields.u_by.isInvalid]
    ]);

    // Check empty row
    fpeg_dokumengrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["c_by",false],["nama_dokumen",false],["file_dokumen",false],["keterangan",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fpeg_dokumengrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpeg_dokumengrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpeg_dokumengrid.lists.c_by = <?= $Grid->c_by->toClientList($Grid) ?>;
    fpeg_dokumengrid.lists.u_by = <?= $Grid->u_by->toClientList($Grid) ?>;
    loadjs.done("fpeg_dokumengrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> peg_dokumen">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<div id="fpeg_dokumengrid" class="ew-form ew-list-form">
<div id="gmp_peg_dokumen" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_peg_dokumengrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="c_by" class="<?= $Grid->c_by->headerCellClass() ?>"><div id="elh_peg_dokumen_c_by" class="peg_dokumen_c_by"><?= $Grid->renderFieldHeader($Grid->c_by) ?></div></th>
<?php } ?>
<?php if ($Grid->nama_dokumen->Visible) { // nama_dokumen ?>
        <th data-name="nama_dokumen" class="<?= $Grid->nama_dokumen->headerCellClass() ?>"><div id="elh_peg_dokumen_nama_dokumen" class="peg_dokumen_nama_dokumen"><?= $Grid->renderFieldHeader($Grid->nama_dokumen) ?></div></th>
<?php } ?>
<?php if ($Grid->file_dokumen->Visible) { // file_dokumen ?>
        <th data-name="file_dokumen" class="<?= $Grid->file_dokumen->headerCellClass() ?>"><div id="elh_peg_dokumen_file_dokumen" class="peg_dokumen_file_dokumen"><?= $Grid->renderFieldHeader($Grid->file_dokumen) ?></div></th>
<?php } ?>
<?php if ($Grid->keterangan->Visible) { // keterangan ?>
        <th data-name="keterangan" class="<?= $Grid->keterangan->headerCellClass() ?>"><div id="elh_peg_dokumen_keterangan" class="peg_dokumen_keterangan"><?= $Grid->renderFieldHeader($Grid->keterangan) ?></div></th>
<?php } ?>
<?php if ($Grid->c_date->Visible) { // c_date ?>
        <th data-name="c_date" class="<?= $Grid->c_date->headerCellClass() ?>"><div id="elh_peg_dokumen_c_date" class="peg_dokumen_c_date"><?= $Grid->renderFieldHeader($Grid->c_date) ?></div></th>
<?php } ?>
<?php if ($Grid->u_date->Visible) { // u_date ?>
        <th data-name="u_date" class="<?= $Grid->u_date->headerCellClass() ?>"><div id="elh_peg_dokumen_u_date" class="peg_dokumen_u_date"><?= $Grid->renderFieldHeader($Grid->u_date) ?></div></th>
<?php } ?>
<?php if ($Grid->u_by->Visible) { // u_by ?>
        <th data-name="u_by" class="<?= $Grid->u_by->headerCellClass() ?>"><div id="elh_peg_dokumen_u_by" class="peg_dokumen_u_by"><?= $Grid->renderFieldHeader($Grid->u_by) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_peg_dokumen",
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
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_c_by" class="el_peg_dokumen_c_by">
<?php
$onchange = $Grid->c_by->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->c_by->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Grid->c_by->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_c_by" class="ew-auto-suggest">
    <input type="<?= $Grid->c_by->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_c_by" id="sv_x<?= $Grid->RowIndex ?>_c_by" value="<?= RemoveHtml($Grid->c_by->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->c_by->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->c_by->getPlaceHolder()) ?>"<?= $Grid->c_by->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="peg_dokumen" data-field="x_c_by" data-input="sv_x<?= $Grid->RowIndex ?>_c_by" data-value-separator="<?= $Grid->c_by->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_c_by" id="x<?= $Grid->RowIndex ?>_c_by" value="<?= HtmlEncode($Grid->c_by->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->c_by->getErrorMessage() ?></div>
<script>
loadjs.ready("fpeg_dokumengrid", function() {
    fpeg_dokumengrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_c_by","forceSelect":false}, ew.vars.tables.peg_dokumen.fields.c_by.autoSuggestOptions));
});
</script>
<?= $Grid->c_by->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_c_by") ?>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_by" data-hidden="1" name="o<?= $Grid->RowIndex ?>_c_by" id="o<?= $Grid->RowIndex ?>_c_by" value="<?= HtmlEncode($Grid->c_by->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_c_by" class="el_peg_dokumen_c_by">
<?php
$onchange = $Grid->c_by->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->c_by->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Grid->c_by->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_c_by" class="ew-auto-suggest">
    <input type="<?= $Grid->c_by->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_c_by" id="sv_x<?= $Grid->RowIndex ?>_c_by" value="<?= RemoveHtml($Grid->c_by->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->c_by->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->c_by->getPlaceHolder()) ?>"<?= $Grid->c_by->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="peg_dokumen" data-field="x_c_by" data-input="sv_x<?= $Grid->RowIndex ?>_c_by" data-value-separator="<?= $Grid->c_by->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_c_by" id="x<?= $Grid->RowIndex ?>_c_by" value="<?= HtmlEncode($Grid->c_by->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->c_by->getErrorMessage() ?></div>
<script>
loadjs.ready("fpeg_dokumengrid", function() {
    fpeg_dokumengrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_c_by","forceSelect":false}, ew.vars.tables.peg_dokumen.fields.c_by.autoSuggestOptions));
});
</script>
<?= $Grid->c_by->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_c_by") ?>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_c_by" class="el_peg_dokumen_c_by">
<span<?= $Grid->c_by->viewAttributes() ?>>
<?= $Grid->c_by->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_by" data-hidden="1" name="fpeg_dokumengrid$x<?= $Grid->RowIndex ?>_c_by" id="fpeg_dokumengrid$x<?= $Grid->RowIndex ?>_c_by" value="<?= HtmlEncode($Grid->c_by->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_c_by" data-hidden="1" name="fpeg_dokumengrid$o<?= $Grid->RowIndex ?>_c_by" id="fpeg_dokumengrid$o<?= $Grid->RowIndex ?>_c_by" value="<?= HtmlEncode($Grid->c_by->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->nama_dokumen->Visible) { // nama_dokumen ?>
        <td data-name="nama_dokumen"<?= $Grid->nama_dokumen->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_nama_dokumen" class="el_peg_dokumen_nama_dokumen">
<input type="<?= $Grid->nama_dokumen->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama_dokumen" id="x<?= $Grid->RowIndex ?>_nama_dokumen" data-table="peg_dokumen" data-field="x_nama_dokumen" value="<?= $Grid->nama_dokumen->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama_dokumen->getPlaceHolder()) ?>"<?= $Grid->nama_dokumen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama_dokumen->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_nama_dokumen" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama_dokumen" id="o<?= $Grid->RowIndex ?>_nama_dokumen" value="<?= HtmlEncode($Grid->nama_dokumen->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_nama_dokumen" class="el_peg_dokumen_nama_dokumen">
<input type="<?= $Grid->nama_dokumen->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama_dokumen" id="x<?= $Grid->RowIndex ?>_nama_dokumen" data-table="peg_dokumen" data-field="x_nama_dokumen" value="<?= $Grid->nama_dokumen->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama_dokumen->getPlaceHolder()) ?>"<?= $Grid->nama_dokumen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama_dokumen->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_nama_dokumen" class="el_peg_dokumen_nama_dokumen">
<span<?= $Grid->nama_dokumen->viewAttributes() ?>>
<?= $Grid->nama_dokumen->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_nama_dokumen" data-hidden="1" name="fpeg_dokumengrid$x<?= $Grid->RowIndex ?>_nama_dokumen" id="fpeg_dokumengrid$x<?= $Grid->RowIndex ?>_nama_dokumen" value="<?= HtmlEncode($Grid->nama_dokumen->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_nama_dokumen" data-hidden="1" name="fpeg_dokumengrid$o<?= $Grid->RowIndex ?>_nama_dokumen" id="fpeg_dokumengrid$o<?= $Grid->RowIndex ?>_nama_dokumen" value="<?= HtmlEncode($Grid->nama_dokumen->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->file_dokumen->Visible) { // file_dokumen ?>
        <td data-name="file_dokumen"<?= $Grid->file_dokumen->cellAttributes() ?>>
<?php if ($Grid->RowAction == "insert") { // Add record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_dokumen_file_dokumen" class="el_peg_dokumen_file_dokumen">
<div id="fd_x<?= $Grid->RowIndex ?>_file_dokumen" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Grid->file_dokumen->title() ?>" data-table="peg_dokumen" data-field="x_file_dokumen" name="x<?= $Grid->RowIndex ?>_file_dokumen" id="x<?= $Grid->RowIndex ?>_file_dokumen" lang="<?= CurrentLanguageID() ?>"<?= $Grid->file_dokumen->editAttributes() ?><?= ($Grid->file_dokumen->ReadOnly || $Grid->file_dokumen->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Grid->file_dokumen->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fn_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fa_x<?= $Grid->RowIndex ?>_file_dokumen" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fs_x<?= $Grid->RowIndex ?>_file_dokumen" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fx_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fm_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_file_dokumen" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_file_dokumen" class="el_peg_dokumen_file_dokumen">
<div id="fd_x<?= $Grid->RowIndex ?>_file_dokumen">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->file_dokumen->title() ?>" data-table="peg_dokumen" data-field="x_file_dokumen" name="x<?= $Grid->RowIndex ?>_file_dokumen" id="x<?= $Grid->RowIndex ?>_file_dokumen" lang="<?= CurrentLanguageID() ?>"<?= $Grid->file_dokumen->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->file_dokumen->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fn_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fa_x<?= $Grid->RowIndex ?>_file_dokumen" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fs_x<?= $Grid->RowIndex ?>_file_dokumen" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fx_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fm_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_file_dokumen" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_file_dokumen" data-hidden="1" name="o<?= $Grid->RowIndex ?>_file_dokumen" id="o<?= $Grid->RowIndex ?>_file_dokumen" value="<?= HtmlEncode($Grid->file_dokumen->OldValue) ?>">
<?php } elseif ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_file_dokumen" class="el_peg_dokumen_file_dokumen">
<span<?= $Grid->file_dokumen->viewAttributes() ?>>
<?= GetFileViewTag($Grid->file_dokumen, $Grid->file_dokumen->getViewValue(), false) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_file_dokumen" class="el_peg_dokumen_file_dokumen">
<div id="fd_x<?= $Grid->RowIndex ?>_file_dokumen">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->file_dokumen->title() ?>" data-table="peg_dokumen" data-field="x_file_dokumen" name="x<?= $Grid->RowIndex ?>_file_dokumen" id="x<?= $Grid->RowIndex ?>_file_dokumen" lang="<?= CurrentLanguageID() ?>"<?= $Grid->file_dokumen->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->file_dokumen->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fn_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fa_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_file_dokumen") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fs_x<?= $Grid->RowIndex ?>_file_dokumen" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fx_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fm_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_file_dokumen" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_file_dokumen" class="el_peg_dokumen_file_dokumen">
<div id="fd_x<?= $Grid->RowIndex ?>_file_dokumen">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->file_dokumen->title() ?>" data-table="peg_dokumen" data-field="x_file_dokumen" name="x<?= $Grid->RowIndex ?>_file_dokumen" id="x<?= $Grid->RowIndex ?>_file_dokumen" lang="<?= CurrentLanguageID() ?>"<?= $Grid->file_dokumen->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->file_dokumen->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fn_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fa_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_file_dokumen") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fs_x<?= $Grid->RowIndex ?>_file_dokumen" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fx_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fm_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_file_dokumen" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->keterangan->Visible) { // keterangan ?>
        <td data-name="keterangan"<?= $Grid->keterangan->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_keterangan" class="el_peg_dokumen_keterangan">
<input type="<?= $Grid->keterangan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_keterangan" id="x<?= $Grid->RowIndex ?>_keterangan" data-table="peg_dokumen" data-field="x_keterangan" value="<?= $Grid->keterangan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->keterangan->getPlaceHolder()) ?>"<?= $Grid->keterangan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->keterangan->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_keterangan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_keterangan" id="o<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_keterangan" class="el_peg_dokumen_keterangan">
<input type="<?= $Grid->keterangan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_keterangan" id="x<?= $Grid->RowIndex ?>_keterangan" data-table="peg_dokumen" data-field="x_keterangan" value="<?= $Grid->keterangan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->keterangan->getPlaceHolder()) ?>"<?= $Grid->keterangan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->keterangan->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_keterangan" class="el_peg_dokumen_keterangan">
<span<?= $Grid->keterangan->viewAttributes() ?>>
<?= $Grid->keterangan->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_keterangan" data-hidden="1" name="fpeg_dokumengrid$x<?= $Grid->RowIndex ?>_keterangan" id="fpeg_dokumengrid$x<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_keterangan" data-hidden="1" name="fpeg_dokumengrid$o<?= $Grid->RowIndex ?>_keterangan" id="fpeg_dokumengrid$o<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->c_date->Visible) { // c_date ?>
        <td data-name="c_date"<?= $Grid->c_date->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_date" data-hidden="1" name="o<?= $Grid->RowIndex ?>_c_date" id="o<?= $Grid->RowIndex ?>_c_date" value="<?= HtmlEncode($Grid->c_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_c_date" class="el_peg_dokumen_c_date">
<span<?= $Grid->c_date->viewAttributes() ?>>
<?= $Grid->c_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_date" data-hidden="1" name="fpeg_dokumengrid$x<?= $Grid->RowIndex ?>_c_date" id="fpeg_dokumengrid$x<?= $Grid->RowIndex ?>_c_date" value="<?= HtmlEncode($Grid->c_date->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_c_date" data-hidden="1" name="fpeg_dokumengrid$o<?= $Grid->RowIndex ?>_c_date" id="fpeg_dokumengrid$o<?= $Grid->RowIndex ?>_c_date" value="<?= HtmlEncode($Grid->c_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->u_date->Visible) { // u_date ?>
        <td data-name="u_date"<?= $Grid->u_date->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_date" data-hidden="1" name="o<?= $Grid->RowIndex ?>_u_date" id="o<?= $Grid->RowIndex ?>_u_date" value="<?= HtmlEncode($Grid->u_date->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_u_date" class="el_peg_dokumen_u_date">
<span<?= $Grid->u_date->viewAttributes() ?>>
<?= $Grid->u_date->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_date" data-hidden="1" name="fpeg_dokumengrid$x<?= $Grid->RowIndex ?>_u_date" id="fpeg_dokumengrid$x<?= $Grid->RowIndex ?>_u_date" value="<?= HtmlEncode($Grid->u_date->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_u_date" data-hidden="1" name="fpeg_dokumengrid$o<?= $Grid->RowIndex ?>_u_date" id="fpeg_dokumengrid$o<?= $Grid->RowIndex ?>_u_date" value="<?= HtmlEncode($Grid->u_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->u_by->Visible) { // u_by ?>
        <td data-name="u_by"<?= $Grid->u_by->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_by" data-hidden="1" name="o<?= $Grid->RowIndex ?>_u_by" id="o<?= $Grid->RowIndex ?>_u_by" value="<?= HtmlEncode($Grid->u_by->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_peg_dokumen_u_by" class="el_peg_dokumen_u_by">
<span<?= $Grid->u_by->viewAttributes() ?>>
<?= $Grid->u_by->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_by" data-hidden="1" name="fpeg_dokumengrid$x<?= $Grid->RowIndex ?>_u_by" id="fpeg_dokumengrid$x<?= $Grid->RowIndex ?>_u_by" value="<?= HtmlEncode($Grid->u_by->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_u_by" data-hidden="1" name="fpeg_dokumengrid$o<?= $Grid->RowIndex ?>_u_by" id="fpeg_dokumengrid$o<?= $Grid->RowIndex ?>_u_by" value="<?= HtmlEncode($Grid->u_by->OldValue) ?>">
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
loadjs.ready(["fpeg_dokumengrid","load"], () => fpeg_dokumengrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_peg_dokumen", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_peg_dokumen_c_by" class="el_peg_dokumen_c_by">
<?php
$onchange = $Grid->c_by->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Grid->c_by->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Grid->c_by->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x<?= $Grid->RowIndex ?>_c_by" class="ew-auto-suggest">
    <input type="<?= $Grid->c_by->getInputTextType() ?>" class="form-control" name="sv_x<?= $Grid->RowIndex ?>_c_by" id="sv_x<?= $Grid->RowIndex ?>_c_by" value="<?= RemoveHtml($Grid->c_by->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Grid->c_by->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Grid->c_by->getPlaceHolder()) ?>"<?= $Grid->c_by->editAttributes() ?>>
</span>
<selection-list hidden class="form-control" data-table="peg_dokumen" data-field="x_c_by" data-input="sv_x<?= $Grid->RowIndex ?>_c_by" data-value-separator="<?= $Grid->c_by->displayValueSeparatorAttribute() ?>" name="x<?= $Grid->RowIndex ?>_c_by" id="x<?= $Grid->RowIndex ?>_c_by" value="<?= HtmlEncode($Grid->c_by->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<div class="invalid-feedback"><?= $Grid->c_by->getErrorMessage() ?></div>
<script>
loadjs.ready("fpeg_dokumengrid", function() {
    fpeg_dokumengrid.createAutoSuggest(Object.assign({"id":"x<?= $Grid->RowIndex ?>_c_by","forceSelect":false}, ew.vars.tables.peg_dokumen.fields.c_by.autoSuggestOptions));
});
</script>
<?= $Grid->c_by->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_c_by") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_c_by" class="el_peg_dokumen_c_by">
<span<?= $Grid->c_by->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->c_by->getDisplayValue($Grid->c_by->ViewValue) ?></span></span>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_by" data-hidden="1" name="x<?= $Grid->RowIndex ?>_c_by" id="x<?= $Grid->RowIndex ?>_c_by" value="<?= HtmlEncode($Grid->c_by->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_by" data-hidden="1" name="o<?= $Grid->RowIndex ?>_c_by" id="o<?= $Grid->RowIndex ?>_c_by" value="<?= HtmlEncode($Grid->c_by->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->nama_dokumen->Visible) { // nama_dokumen ?>
        <td data-name="nama_dokumen">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_dokumen_nama_dokumen" class="el_peg_dokumen_nama_dokumen">
<input type="<?= $Grid->nama_dokumen->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_nama_dokumen" id="x<?= $Grid->RowIndex ?>_nama_dokumen" data-table="peg_dokumen" data-field="x_nama_dokumen" value="<?= $Grid->nama_dokumen->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->nama_dokumen->getPlaceHolder()) ?>"<?= $Grid->nama_dokumen->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->nama_dokumen->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_nama_dokumen" class="el_peg_dokumen_nama_dokumen">
<span<?= $Grid->nama_dokumen->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->nama_dokumen->getDisplayValue($Grid->nama_dokumen->ViewValue))) ?>"></span>
<input type="hidden" data-table="peg_dokumen" data-field="x_nama_dokumen" data-hidden="1" name="x<?= $Grid->RowIndex ?>_nama_dokumen" id="x<?= $Grid->RowIndex ?>_nama_dokumen" value="<?= HtmlEncode($Grid->nama_dokumen->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_nama_dokumen" data-hidden="1" name="o<?= $Grid->RowIndex ?>_nama_dokumen" id="o<?= $Grid->RowIndex ?>_nama_dokumen" value="<?= HtmlEncode($Grid->nama_dokumen->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->file_dokumen->Visible) { // file_dokumen ?>
        <td data-name="file_dokumen">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_dokumen_file_dokumen" class="el_peg_dokumen_file_dokumen">
<div id="fd_x<?= $Grid->RowIndex ?>_file_dokumen" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Grid->file_dokumen->title() ?>" data-table="peg_dokumen" data-field="x_file_dokumen" name="x<?= $Grid->RowIndex ?>_file_dokumen" id="x<?= $Grid->RowIndex ?>_file_dokumen" lang="<?= CurrentLanguageID() ?>"<?= $Grid->file_dokumen->editAttributes() ?><?= ($Grid->file_dokumen->ReadOnly || $Grid->file_dokumen->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Grid->file_dokumen->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fn_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fa_x<?= $Grid->RowIndex ?>_file_dokumen" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fs_x<?= $Grid->RowIndex ?>_file_dokumen" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fx_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fm_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_file_dokumen" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_file_dokumen" class="el_peg_dokumen_file_dokumen">
<div id="fd_x<?= $Grid->RowIndex ?>_file_dokumen">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->file_dokumen->title() ?>" data-table="peg_dokumen" data-field="x_file_dokumen" name="x<?= $Grid->RowIndex ?>_file_dokumen" id="x<?= $Grid->RowIndex ?>_file_dokumen" lang="<?= CurrentLanguageID() ?>"<?= $Grid->file_dokumen->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->file_dokumen->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fn_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fa_x<?= $Grid->RowIndex ?>_file_dokumen" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fs_x<?= $Grid->RowIndex ?>_file_dokumen" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fx_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_file_dokumen" id= "fm_x<?= $Grid->RowIndex ?>_file_dokumen" value="<?= $Grid->file_dokumen->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_file_dokumen" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_file_dokumen" data-hidden="1" name="o<?= $Grid->RowIndex ?>_file_dokumen" id="o<?= $Grid->RowIndex ?>_file_dokumen" value="<?= HtmlEncode($Grid->file_dokumen->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->keterangan->Visible) { // keterangan ?>
        <td data-name="keterangan">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_peg_dokumen_keterangan" class="el_peg_dokumen_keterangan">
<input type="<?= $Grid->keterangan->getInputTextType() ?>" name="x<?= $Grid->RowIndex ?>_keterangan" id="x<?= $Grid->RowIndex ?>_keterangan" data-table="peg_dokumen" data-field="x_keterangan" value="<?= $Grid->keterangan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Grid->keterangan->getPlaceHolder()) ?>"<?= $Grid->keterangan->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->keterangan->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_keterangan" class="el_peg_dokumen_keterangan">
<span<?= $Grid->keterangan->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->keterangan->getDisplayValue($Grid->keterangan->ViewValue))) ?>"></span>
<input type="hidden" data-table="peg_dokumen" data-field="x_keterangan" data-hidden="1" name="x<?= $Grid->RowIndex ?>_keterangan" id="x<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_keterangan" data-hidden="1" name="o<?= $Grid->RowIndex ?>_keterangan" id="o<?= $Grid->RowIndex ?>_keterangan" value="<?= HtmlEncode($Grid->keterangan->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->c_date->Visible) { // c_date ?>
        <td data-name="c_date">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_c_date" class="el_peg_dokumen_c_date">
<span<?= $Grid->c_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->c_date->getDisplayValue($Grid->c_date->ViewValue))) ?>"></span>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_date" data-hidden="1" name="x<?= $Grid->RowIndex ?>_c_date" id="x<?= $Grid->RowIndex ?>_c_date" value="<?= HtmlEncode($Grid->c_date->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_date" data-hidden="1" name="o<?= $Grid->RowIndex ?>_c_date" id="o<?= $Grid->RowIndex ?>_c_date" value="<?= HtmlEncode($Grid->c_date->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->u_date->Visible) { // u_date ?>
        <td data-name="u_date">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_u_date" class="el_peg_dokumen_u_date">
<span<?= $Grid->u_date->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->u_date->getDisplayValue($Grid->u_date->ViewValue))) ?>"></span>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_date" data-hidden="1" name="x<?= $Grid->RowIndex ?>_u_date" id="x<?= $Grid->RowIndex ?>_u_date" value="<?= HtmlEncode($Grid->u_date->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_date" data-hidden="1" name="o<?= $Grid->RowIndex ?>_u_date" id="o<?= $Grid->RowIndex ?>_u_date" value="<?= HtmlEncode($Grid->u_date->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->u_by->Visible) { // u_by ?>
        <td data-name="u_by">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_u_by" class="el_peg_dokumen_u_by">
<span<?= $Grid->u_by->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->u_by->getDisplayValue($Grid->u_by->ViewValue) ?></span></span>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_by" data-hidden="1" name="x<?= $Grid->RowIndex ?>_u_by" id="x<?= $Grid->RowIndex ?>_u_by" value="<?= HtmlEncode($Grid->u_by->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_by" data-hidden="1" name="o<?= $Grid->RowIndex ?>_u_by" id="o<?= $Grid->RowIndex ?>_u_by" value="<?= HtmlEncode($Grid->u_by->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fpeg_dokumengrid","load"], () => fpeg_dokumengrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="fpeg_dokumengrid">
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
    ew.addEventHandlers("peg_dokumen");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
