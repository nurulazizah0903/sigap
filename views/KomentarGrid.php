<?php

namespace PHPMaker2022\sigap;

// Set up and run Grid object
$Grid = Container("KomentarGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var fkomentargrid;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkomentargrid = new ew.Form("fkomentargrid", "grid");
    fkomentargrid.formKeyCountName = "<?= $Grid->FormKeyCountName ?>";

    // Add fields
    var currentTable = <?= JsonEncode($Grid->toClientVar()) ?>;
    ew.deepAssign(ew.vars, { tables: { komentar: currentTable } });
    var fields = currentTable.fields;
    fkomentargrid.addFields([
        ["pegawai", [fields.pegawai.visible && fields.pegawai.required ? ew.Validators.required(fields.pegawai.caption) : null, ew.Validators.integer], fields.pegawai.isInvalid],
        ["komentar", [fields.komentar.visible && fields.komentar.required ? ew.Validators.required(fields.komentar.caption) : null], fields.komentar.isInvalid],
        ["gambar", [fields.gambar.visible && fields.gambar.required ? ew.Validators.fileRequired(fields.gambar.caption) : null], fields.gambar.isInvalid],
        ["video", [fields.video.visible && fields.video.required ? ew.Validators.fileRequired(fields.video.caption) : null], fields.video.isInvalid]
    ]);

    // Check empty row
    fkomentargrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm(),
            fields = [["pegawai",false],["komentar",false],["gambar",false],["video",false]];
        if (fields.some(field => ew.valueChanged(fobj, rowIndex, ...field)))
            return false;
        return true;
    }

    // Form_CustomValidate
    fkomentargrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkomentargrid.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fkomentargrid.lists.pegawai = <?= $Grid->pegawai->toClientList($Grid) ?>;
    loadjs.done("fkomentargrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> komentar">
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<?php } ?>
<div id="fkomentargrid" class="ew-form ew-list-form">
<div id="gmp_komentar" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_komentargrid" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
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
        <th data-name="pegawai" class="<?= $Grid->pegawai->headerCellClass() ?>"><div id="elh_komentar_pegawai" class="komentar_pegawai"><?= $Grid->renderFieldHeader($Grid->pegawai) ?></div></th>
<?php } ?>
<?php if ($Grid->komentar->Visible) { // komentar ?>
        <th data-name="komentar" class="<?= $Grid->komentar->headerCellClass() ?>"><div id="elh_komentar_komentar" class="komentar_komentar"><?= $Grid->renderFieldHeader($Grid->komentar) ?></div></th>
<?php } ?>
<?php if ($Grid->gambar->Visible) { // gambar ?>
        <th data-name="gambar" class="<?= $Grid->gambar->headerCellClass() ?>"><div id="elh_komentar_gambar" class="komentar_gambar"><?= $Grid->renderFieldHeader($Grid->gambar) ?></div></th>
<?php } ?>
<?php if ($Grid->video->Visible) { // video ?>
        <th data-name="video" class="<?= $Grid->video->headerCellClass() ?>"><div id="elh_komentar_video" class="komentar_video"><?= $Grid->renderFieldHeader($Grid->video) ?></div></th>
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
            "id" => "r" . $Grid->RowCount . "_komentar",
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
<span id="el<?= $Grid->RowCount ?>_komentar_pegawai" class="el_komentar_pegawai">
    <select
        id="x<?= $Grid->RowIndex ?>_pegawai"
        name="x<?= $Grid->RowIndex ?>_pegawai"
        class="form-control ew-select<?= $Grid->pegawai->isInvalidClass() ?>"
        data-select2-id="fkomentargrid_x<?= $Grid->RowIndex ?>_pegawai"
        data-table="komentar"
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
loadjs.ready("fkomentargrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_pegawai", selectId: "fkomentargrid_x<?= $Grid->RowIndex ?>_pegawai" };
    if (fkomentargrid.lists.pegawai.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_pegawai", form: "fkomentargrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_pegawai", form: "fkomentargrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.komentar.fields.pegawai.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<input type="hidden" data-table="komentar" data-field="x_pegawai" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pegawai" id="o<?= $Grid->RowIndex ?>_pegawai" value="<?= HtmlEncode($Grid->pegawai->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_komentar_pegawai" class="el_komentar_pegawai">
    <select
        id="x<?= $Grid->RowIndex ?>_pegawai"
        name="x<?= $Grid->RowIndex ?>_pegawai"
        class="form-control ew-select<?= $Grid->pegawai->isInvalidClass() ?>"
        data-select2-id="fkomentargrid_x<?= $Grid->RowIndex ?>_pegawai"
        data-table="komentar"
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
loadjs.ready("fkomentargrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_pegawai", selectId: "fkomentargrid_x<?= $Grid->RowIndex ?>_pegawai" };
    if (fkomentargrid.lists.pegawai.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_pegawai", form: "fkomentargrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_pegawai", form: "fkomentargrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.komentar.fields.pegawai.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_komentar_pegawai" class="el_komentar_pegawai">
<span<?= $Grid->pegawai->viewAttributes() ?>>
<?= $Grid->pegawai->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="komentar" data-field="x_pegawai" data-hidden="1" name="fkomentargrid$x<?= $Grid->RowIndex ?>_pegawai" id="fkomentargrid$x<?= $Grid->RowIndex ?>_pegawai" value="<?= HtmlEncode($Grid->pegawai->FormValue) ?>">
<input type="hidden" data-table="komentar" data-field="x_pegawai" data-hidden="1" name="fkomentargrid$o<?= $Grid->RowIndex ?>_pegawai" id="fkomentargrid$o<?= $Grid->RowIndex ?>_pegawai" value="<?= HtmlEncode($Grid->pegawai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->komentar->Visible) { // komentar ?>
        <td data-name="komentar"<?= $Grid->komentar->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_komentar_komentar" class="el_komentar_komentar">
<textarea data-table="komentar" data-field="x_komentar" name="x<?= $Grid->RowIndex ?>_komentar" id="x<?= $Grid->RowIndex ?>_komentar" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->komentar->getPlaceHolder()) ?>"<?= $Grid->komentar->editAttributes() ?>><?= $Grid->komentar->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->komentar->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="komentar" data-field="x_komentar" data-hidden="1" name="o<?= $Grid->RowIndex ?>_komentar" id="o<?= $Grid->RowIndex ?>_komentar" value="<?= HtmlEncode($Grid->komentar->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_komentar_komentar" class="el_komentar_komentar">
<textarea data-table="komentar" data-field="x_komentar" name="x<?= $Grid->RowIndex ?>_komentar" id="x<?= $Grid->RowIndex ?>_komentar" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->komentar->getPlaceHolder()) ?>"<?= $Grid->komentar->editAttributes() ?>><?= $Grid->komentar->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->komentar->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_komentar_komentar" class="el_komentar_komentar">
<span<?= $Grid->komentar->viewAttributes() ?>>
<?= $Grid->komentar->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="komentar" data-field="x_komentar" data-hidden="1" name="fkomentargrid$x<?= $Grid->RowIndex ?>_komentar" id="fkomentargrid$x<?= $Grid->RowIndex ?>_komentar" value="<?= HtmlEncode($Grid->komentar->FormValue) ?>">
<input type="hidden" data-table="komentar" data-field="x_komentar" data-hidden="1" name="fkomentargrid$o<?= $Grid->RowIndex ?>_komentar" id="fkomentargrid$o<?= $Grid->RowIndex ?>_komentar" value="<?= HtmlEncode($Grid->komentar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->gambar->Visible) { // gambar ?>
        <td data-name="gambar"<?= $Grid->gambar->cellAttributes() ?>>
<?php if ($Grid->RowAction == "insert") { // Add record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_komentar_gambar" class="el_komentar_gambar">
<div id="fd_x<?= $Grid->RowIndex ?>_gambar" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Grid->gambar->title() ?>" data-table="komentar" data-field="x_gambar" name="x<?= $Grid->RowIndex ?>_gambar" id="x<?= $Grid->RowIndex ?>_gambar" lang="<?= CurrentLanguageID() ?>"<?= $Grid->gambar->editAttributes() ?><?= ($Grid->gambar->ReadOnly || $Grid->gambar->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Grid->gambar->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_gambar" id= "fn_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_gambar" id= "fa_x<?= $Grid->RowIndex ?>_gambar" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_gambar" id= "fs_x<?= $Grid->RowIndex ?>_gambar" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_gambar" id= "fx_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_gambar" id= "fm_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_gambar" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el$rowindex$_komentar_gambar" class="el_komentar_gambar">
<div id="fd_x<?= $Grid->RowIndex ?>_gambar">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->gambar->title() ?>" data-table="komentar" data-field="x_gambar" name="x<?= $Grid->RowIndex ?>_gambar" id="x<?= $Grid->RowIndex ?>_gambar" lang="<?= CurrentLanguageID() ?>"<?= $Grid->gambar->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->gambar->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_gambar" id= "fn_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_gambar" id= "fa_x<?= $Grid->RowIndex ?>_gambar" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_gambar" id= "fs_x<?= $Grid->RowIndex ?>_gambar" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_gambar" id= "fx_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_gambar" id= "fm_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_gambar" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<input type="hidden" data-table="komentar" data-field="x_gambar" data-hidden="1" name="o<?= $Grid->RowIndex ?>_gambar" id="o<?= $Grid->RowIndex ?>_gambar" value="<?= HtmlEncode($Grid->gambar->OldValue) ?>">
<?php } elseif ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_komentar_gambar" class="el_komentar_gambar">
<span<?= $Grid->gambar->viewAttributes() ?>>
<?= GetFileViewTag($Grid->gambar, $Grid->gambar->getViewValue(), false) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el<?= $Grid->RowCount ?>_komentar_gambar" class="el_komentar_gambar">
<div id="fd_x<?= $Grid->RowIndex ?>_gambar">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->gambar->title() ?>" data-table="komentar" data-field="x_gambar" name="x<?= $Grid->RowIndex ?>_gambar" id="x<?= $Grid->RowIndex ?>_gambar" lang="<?= CurrentLanguageID() ?>"<?= $Grid->gambar->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->gambar->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_gambar" id= "fn_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_gambar" id= "fa_x<?= $Grid->RowIndex ?>_gambar" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_gambar") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_gambar" id= "fs_x<?= $Grid->RowIndex ?>_gambar" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_gambar" id= "fx_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_gambar" id= "fm_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_gambar" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_komentar_gambar" class="el_komentar_gambar">
<div id="fd_x<?= $Grid->RowIndex ?>_gambar">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->gambar->title() ?>" data-table="komentar" data-field="x_gambar" name="x<?= $Grid->RowIndex ?>_gambar" id="x<?= $Grid->RowIndex ?>_gambar" lang="<?= CurrentLanguageID() ?>"<?= $Grid->gambar->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->gambar->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_gambar" id= "fn_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_gambar" id= "fa_x<?= $Grid->RowIndex ?>_gambar" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_gambar") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_gambar" id= "fs_x<?= $Grid->RowIndex ?>_gambar" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_gambar" id= "fx_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_gambar" id= "fm_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_gambar" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->video->Visible) { // video ?>
        <td data-name="video"<?= $Grid->video->cellAttributes() ?>>
<?php if ($Grid->RowAction == "insert") { // Add record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_komentar_video" class="el_komentar_video">
<div id="fd_x<?= $Grid->RowIndex ?>_video" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Grid->video->title() ?>" data-table="komentar" data-field="x_video" name="x<?= $Grid->RowIndex ?>_video" id="x<?= $Grid->RowIndex ?>_video" lang="<?= CurrentLanguageID() ?>"<?= $Grid->video->editAttributes() ?><?= ($Grid->video->ReadOnly || $Grid->video->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Grid->video->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_video" id= "fn_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_video" id= "fa_x<?= $Grid->RowIndex ?>_video" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_video" id= "fs_x<?= $Grid->RowIndex ?>_video" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_video" id= "fx_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_video" id= "fm_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_video" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el$rowindex$_komentar_video" class="el_komentar_video">
<div id="fd_x<?= $Grid->RowIndex ?>_video">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->video->title() ?>" data-table="komentar" data-field="x_video" name="x<?= $Grid->RowIndex ?>_video" id="x<?= $Grid->RowIndex ?>_video" lang="<?= CurrentLanguageID() ?>"<?= $Grid->video->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->video->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_video" id= "fn_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_video" id= "fa_x<?= $Grid->RowIndex ?>_video" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_video" id= "fs_x<?= $Grid->RowIndex ?>_video" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_video" id= "fx_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_video" id= "fm_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_video" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<input type="hidden" data-table="komentar" data-field="x_video" data-hidden="1" name="o<?= $Grid->RowIndex ?>_video" id="o<?= $Grid->RowIndex ?>_video" value="<?= HtmlEncode($Grid->video->OldValue) ?>">
<?php } elseif ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_komentar_video" class="el_komentar_video">
<span<?= $Grid->video->viewAttributes() ?>>
<?= GetFileViewTag($Grid->video, $Grid->video->getViewValue(), false) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<?php if (!$Grid->isConfirm()) { ?>
<span id="el<?= $Grid->RowCount ?>_komentar_video" class="el_komentar_video">
<div id="fd_x<?= $Grid->RowIndex ?>_video">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->video->title() ?>" data-table="komentar" data-field="x_video" name="x<?= $Grid->RowIndex ?>_video" id="x<?= $Grid->RowIndex ?>_video" lang="<?= CurrentLanguageID() ?>"<?= $Grid->video->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->video->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_video" id= "fn_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_video" id= "fa_x<?= $Grid->RowIndex ?>_video" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_video") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_video" id= "fs_x<?= $Grid->RowIndex ?>_video" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_video" id= "fx_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_video" id= "fm_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_video" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el<?= $Grid->RowCount ?>_komentar_video" class="el_komentar_video">
<div id="fd_x<?= $Grid->RowIndex ?>_video">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->video->title() ?>" data-table="komentar" data-field="x_video" name="x<?= $Grid->RowIndex ?>_video" id="x<?= $Grid->RowIndex ?>_video" lang="<?= CurrentLanguageID() ?>"<?= $Grid->video->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->video->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_video" id= "fn_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_video" id= "fa_x<?= $Grid->RowIndex ?>_video" value="<?= (Post("fa_x<?= $Grid->RowIndex ?>_video") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_video" id= "fs_x<?= $Grid->RowIndex ?>_video" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_video" id= "fx_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_video" id= "fm_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_video" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
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
loadjs.ready(["fkomentargrid","load"], () => fkomentargrid.updateLists(<?= $Grid->RowIndex ?>));
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
    $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_komentar", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_komentar_pegawai" class="el_komentar_pegawai">
    <select
        id="x<?= $Grid->RowIndex ?>_pegawai"
        name="x<?= $Grid->RowIndex ?>_pegawai"
        class="form-control ew-select<?= $Grid->pegawai->isInvalidClass() ?>"
        data-select2-id="fkomentargrid_x<?= $Grid->RowIndex ?>_pegawai"
        data-table="komentar"
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
loadjs.ready("fkomentargrid", function() {
    var options = { name: "x<?= $Grid->RowIndex ?>_pegawai", selectId: "fkomentargrid_x<?= $Grid->RowIndex ?>_pegawai" };
    if (fkomentargrid.lists.pegawai.lookupOptions.length) {
        options.data = { id: "x<?= $Grid->RowIndex ?>_pegawai", form: "fkomentargrid" };
    } else {
        options.ajax = { id: "x<?= $Grid->RowIndex ?>_pegawai", form: "fkomentargrid", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.komentar.fields.pegawai.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_komentar_pegawai" class="el_komentar_pegawai">
<span<?= $Grid->pegawai->viewAttributes() ?>>
<span class="form-control-plaintext"><?= $Grid->pegawai->getDisplayValue($Grid->pegawai->ViewValue) ?></span></span>
<input type="hidden" data-table="komentar" data-field="x_pegawai" data-hidden="1" name="x<?= $Grid->RowIndex ?>_pegawai" id="x<?= $Grid->RowIndex ?>_pegawai" value="<?= HtmlEncode($Grid->pegawai->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="komentar" data-field="x_pegawai" data-hidden="1" name="o<?= $Grid->RowIndex ?>_pegawai" id="o<?= $Grid->RowIndex ?>_pegawai" value="<?= HtmlEncode($Grid->pegawai->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->komentar->Visible) { // komentar ?>
        <td data-name="komentar">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_komentar_komentar" class="el_komentar_komentar">
<textarea data-table="komentar" data-field="x_komentar" name="x<?= $Grid->RowIndex ?>_komentar" id="x<?= $Grid->RowIndex ?>_komentar" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->komentar->getPlaceHolder()) ?>"<?= $Grid->komentar->editAttributes() ?>><?= $Grid->komentar->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->komentar->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_komentar_komentar" class="el_komentar_komentar">
<span<?= $Grid->komentar->viewAttributes() ?>>
<?= $Grid->komentar->ViewValue ?></span>
<input type="hidden" data-table="komentar" data-field="x_komentar" data-hidden="1" name="x<?= $Grid->RowIndex ?>_komentar" id="x<?= $Grid->RowIndex ?>_komentar" value="<?= HtmlEncode($Grid->komentar->FormValue) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="komentar" data-field="x_komentar" data-hidden="1" name="o<?= $Grid->RowIndex ?>_komentar" id="o<?= $Grid->RowIndex ?>_komentar" value="<?= HtmlEncode($Grid->komentar->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->gambar->Visible) { // gambar ?>
        <td data-name="gambar">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_komentar_gambar" class="el_komentar_gambar">
<div id="fd_x<?= $Grid->RowIndex ?>_gambar" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Grid->gambar->title() ?>" data-table="komentar" data-field="x_gambar" name="x<?= $Grid->RowIndex ?>_gambar" id="x<?= $Grid->RowIndex ?>_gambar" lang="<?= CurrentLanguageID() ?>"<?= $Grid->gambar->editAttributes() ?><?= ($Grid->gambar->ReadOnly || $Grid->gambar->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Grid->gambar->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_gambar" id= "fn_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_gambar" id= "fa_x<?= $Grid->RowIndex ?>_gambar" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_gambar" id= "fs_x<?= $Grid->RowIndex ?>_gambar" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_gambar" id= "fx_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_gambar" id= "fm_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_gambar" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el$rowindex$_komentar_gambar" class="el_komentar_gambar">
<div id="fd_x<?= $Grid->RowIndex ?>_gambar">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->gambar->title() ?>" data-table="komentar" data-field="x_gambar" name="x<?= $Grid->RowIndex ?>_gambar" id="x<?= $Grid->RowIndex ?>_gambar" lang="<?= CurrentLanguageID() ?>"<?= $Grid->gambar->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->gambar->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_gambar" id= "fn_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_gambar" id= "fa_x<?= $Grid->RowIndex ?>_gambar" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_gambar" id= "fs_x<?= $Grid->RowIndex ?>_gambar" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_gambar" id= "fx_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_gambar" id= "fm_x<?= $Grid->RowIndex ?>_gambar" value="<?= $Grid->gambar->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_gambar" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<input type="hidden" data-table="komentar" data-field="x_gambar" data-hidden="1" name="o<?= $Grid->RowIndex ?>_gambar" id="o<?= $Grid->RowIndex ?>_gambar" value="<?= HtmlEncode($Grid->gambar->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->video->Visible) { // video ?>
        <td data-name="video">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_komentar_video" class="el_komentar_video">
<div id="fd_x<?= $Grid->RowIndex ?>_video" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Grid->video->title() ?>" data-table="komentar" data-field="x_video" name="x<?= $Grid->RowIndex ?>_video" id="x<?= $Grid->RowIndex ?>_video" lang="<?= CurrentLanguageID() ?>"<?= $Grid->video->editAttributes() ?><?= ($Grid->video->ReadOnly || $Grid->video->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<div class="invalid-feedback"><?= $Grid->video->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_video" id= "fn_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_video" id= "fa_x<?= $Grid->RowIndex ?>_video" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_video" id= "fs_x<?= $Grid->RowIndex ?>_video" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_video" id= "fx_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_video" id= "fm_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_video" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } else { ?>
<span id="el$rowindex$_komentar_video" class="el_komentar_video">
<div id="fd_x<?= $Grid->RowIndex ?>_video">
    <input type="file" class="form-control ew-file-input d-none" title="<?= $Grid->video->title() ?>" data-table="komentar" data-field="x_video" name="x<?= $Grid->RowIndex ?>_video" id="x<?= $Grid->RowIndex ?>_video" lang="<?= CurrentLanguageID() ?>"<?= $Grid->video->editAttributes() ?>>
</div>
<div class="invalid-feedback"><?= $Grid->video->getErrorMessage() ?></div>
<input type="hidden" name="fn_x<?= $Grid->RowIndex ?>_video" id= "fn_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->Upload->FileName ?>">
<input type="hidden" name="fa_x<?= $Grid->RowIndex ?>_video" id= "fa_x<?= $Grid->RowIndex ?>_video" value="0">
<input type="hidden" name="fs_x<?= $Grid->RowIndex ?>_video" id= "fs_x<?= $Grid->RowIndex ?>_video" value="255">
<input type="hidden" name="fx_x<?= $Grid->RowIndex ?>_video" id= "fx_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?= $Grid->RowIndex ?>_video" id= "fm_x<?= $Grid->RowIndex ?>_video" value="<?= $Grid->video->UploadMaxFileSize ?>">
<table id="ft_x<?= $Grid->RowIndex ?>_video" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<input type="hidden" data-table="komentar" data-field="x_video" data-hidden="1" name="o<?= $Grid->RowIndex ?>_video" id="o<?= $Grid->RowIndex ?>_video" value="<?= HtmlEncode($Grid->video->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fkomentargrid","load"], () => fkomentargrid.updateLists(<?= $Grid->RowIndex ?>, true));
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
<input type="hidden" name="detailpage" value="fkomentargrid">
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
    ew.addEventHandlers("komentar");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
