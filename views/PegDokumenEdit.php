<?php

namespace PHPMaker2022\sigap;

// Page object
$PegDokumenEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { peg_dokumen: currentTable } });
var currentForm, currentPageID;
var fpeg_dokumenedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpeg_dokumenedit = new ew.Form("fpeg_dokumenedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fpeg_dokumenedit;

    // Add fields
    var fields = currentTable.fields;
    fpeg_dokumenedit.addFields([
        ["c_by", [fields.c_by.visible && fields.c_by.required ? ew.Validators.required(fields.c_by.caption) : null, ew.Validators.integer], fields.c_by.isInvalid],
        ["nama_dokumen", [fields.nama_dokumen.visible && fields.nama_dokumen.required ? ew.Validators.required(fields.nama_dokumen.caption) : null], fields.nama_dokumen.isInvalid],
        ["file_dokumen", [fields.file_dokumen.visible && fields.file_dokumen.required ? ew.Validators.fileRequired(fields.file_dokumen.caption) : null], fields.file_dokumen.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
        ["c_date", [fields.c_date.visible && fields.c_date.required ? ew.Validators.required(fields.c_date.caption) : null], fields.c_date.isInvalid],
        ["u_date", [fields.u_date.visible && fields.u_date.required ? ew.Validators.required(fields.u_date.caption) : null], fields.u_date.isInvalid],
        ["u_by", [fields.u_by.visible && fields.u_by.required ? ew.Validators.required(fields.u_by.caption) : null], fields.u_by.isInvalid]
    ]);

    // Form_CustomValidate
    fpeg_dokumenedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpeg_dokumenedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpeg_dokumenedit.lists.c_by = <?= $Page->c_by->toClientList($Page) ?>;
    fpeg_dokumenedit.lists.u_by = <?= $Page->u_by->toClientList($Page) ?>;
    loadjs.done("fpeg_dokumenedit");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpeg_dokumenedit" id="fpeg_dokumenedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="peg_dokumen">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "pegawai") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="pegawai">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->c_by->Visible) { // c_by ?>
    <div id="r_c_by"<?= $Page->c_by->rowAttributes() ?>>
        <label id="elh_peg_dokumen_c_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->c_by->caption() ?><?= $Page->c_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->c_by->cellAttributes() ?>>
<span id="el_peg_dokumen_c_by">
<?php
$onchange = $Page->c_by->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->c_by->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Page->c_by->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_c_by" class="ew-auto-suggest">
    <input type="<?= $Page->c_by->getInputTextType() ?>" class="form-control" name="sv_x_c_by" id="sv_x_c_by" value="<?= RemoveHtml($Page->c_by->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Page->c_by->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->c_by->getPlaceHolder()) ?>"<?= $Page->c_by->editAttributes() ?> aria-describedby="x_c_by_help">
</span>
<selection-list hidden class="form-control" data-table="peg_dokumen" data-field="x_c_by" data-input="sv_x_c_by" data-value-separator="<?= $Page->c_by->displayValueSeparatorAttribute() ?>" name="x_c_by" id="x_c_by" value="<?= HtmlEncode($Page->c_by->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<?= $Page->c_by->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->c_by->getErrorMessage() ?></div>
<script>
loadjs.ready("fpeg_dokumenedit", function() {
    fpeg_dokumenedit.createAutoSuggest(Object.assign({"id":"x_c_by","forceSelect":false}, ew.vars.tables.peg_dokumen.fields.c_by.autoSuggestOptions));
});
</script>
<?= $Page->c_by->Lookup->getParamTag($Page, "p_x_c_by") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_dokumen->Visible) { // nama_dokumen ?>
    <div id="r_nama_dokumen"<?= $Page->nama_dokumen->rowAttributes() ?>>
        <label id="elh_peg_dokumen_nama_dokumen" for="x_nama_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_dokumen->caption() ?><?= $Page->nama_dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama_dokumen->cellAttributes() ?>>
<span id="el_peg_dokumen_nama_dokumen">
<input type="<?= $Page->nama_dokumen->getInputTextType() ?>" name="x_nama_dokumen" id="x_nama_dokumen" data-table="peg_dokumen" data-field="x_nama_dokumen" value="<?= $Page->nama_dokumen->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama_dokumen->getPlaceHolder()) ?>"<?= $Page->nama_dokumen->editAttributes() ?> aria-describedby="x_nama_dokumen_help">
<?= $Page->nama_dokumen->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_dokumen->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->file_dokumen->Visible) { // file_dokumen ?>
    <div id="r_file_dokumen"<?= $Page->file_dokumen->rowAttributes() ?>>
        <label id="elh_peg_dokumen_file_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->file_dokumen->caption() ?><?= $Page->file_dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->file_dokumen->cellAttributes() ?>>
<span id="el_peg_dokumen_file_dokumen">
<div id="fd_x_file_dokumen" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->file_dokumen->title() ?>" data-table="peg_dokumen" data-field="x_file_dokumen" name="x_file_dokumen" id="x_file_dokumen" lang="<?= CurrentLanguageID() ?>"<?= $Page->file_dokumen->editAttributes() ?> aria-describedby="x_file_dokumen_help"<?= ($Page->file_dokumen->ReadOnly || $Page->file_dokumen->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->file_dokumen->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->file_dokumen->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_file_dokumen" id= "fn_x_file_dokumen" value="<?= $Page->file_dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x_file_dokumen" id= "fa_x_file_dokumen" value="<?= (Post("fa_x_file_dokumen") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_file_dokumen" id= "fs_x_file_dokumen" value="255">
<input type="hidden" name="fx_x_file_dokumen" id= "fx_x_file_dokumen" value="<?= $Page->file_dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_file_dokumen" id= "fm_x_file_dokumen" value="<?= $Page->file_dokumen->UploadMaxFileSize ?>">
<table id="ft_x_file_dokumen" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <div id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_peg_dokumen_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_peg_dokumen_keterangan">
<input type="<?= $Page->keterangan->getInputTextType() ?>" name="x_keterangan" id="x_keterangan" data-table="peg_dokumen" data-field="x_keterangan" value="<?= $Page->keterangan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help">
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="peg_dokumen" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .row -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
