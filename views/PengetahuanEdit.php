<?php

namespace PHPMaker2022\sigap;

// Page object
$PengetahuanEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pengetahuan: currentTable } });
var currentForm, currentPageID;
var fpengetahuanedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpengetahuanedit = new ew.Form("fpengetahuanedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fpengetahuanedit;

    // Add fields
    var fields = currentTable.fields;
    fpengetahuanedit.addFields([
        ["grup", [fields.grup.visible && fields.grup.required ? ew.Validators.required(fields.grup.caption) : null], fields.grup.isInvalid],
        ["judul", [fields.judul.visible && fields.judul.required ? ew.Validators.required(fields.judul.caption) : null], fields.judul.isInvalid],
        ["isi", [fields.isi.visible && fields.isi.required ? ew.Validators.required(fields.isi.caption) : null], fields.isi.isInvalid],
        ["sumber_url", [fields.sumber_url.visible && fields.sumber_url.required ? ew.Validators.required(fields.sumber_url.caption) : null], fields.sumber_url.isInvalid],
        ["visual", [fields.visual.visible && fields.visual.required ? ew.Validators.required(fields.visual.caption) : null], fields.visual.isInvalid],
        ["dokumen", [fields.dokumen.visible && fields.dokumen.required ? ew.Validators.fileRequired(fields.dokumen.caption) : null], fields.dokumen.isInvalid],
        ["c_by", [fields.c_by.visible && fields.c_by.required ? ew.Validators.required(fields.c_by.caption) : null], fields.c_by.isInvalid]
    ]);

    // Form_CustomValidate
    fpengetahuanedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpengetahuanedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpengetahuanedit.lists.grup = <?= $Page->grup->toClientList($Page) ?>;
    fpengetahuanedit.lists.c_by = <?= $Page->c_by->toClientList($Page) ?>;
    loadjs.done("fpengetahuanedit");
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
<form name="fpengetahuanedit" id="fpengetahuanedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pengetahuan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->grup->Visible) { // grup ?>
    <div id="r_grup"<?= $Page->grup->rowAttributes() ?>>
        <label id="elh_pengetahuan_grup" class="<?= $Page->LeftColumnClass ?>"><?= $Page->grup->caption() ?><?= $Page->grup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->grup->cellAttributes() ?>>
<span id="el_pengetahuan_grup">
    <select
        id="x_grup"
        name="x_grup"
        class="form-control ew-select<?= $Page->grup->isInvalidClass() ?>"
        data-select2-id="fpengetahuanedit_x_grup"
        data-table="pengetahuan"
        data-field="x_grup"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->grup->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->grup->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->grup->getPlaceHolder()) ?>"
        <?= $Page->grup->editAttributes() ?>>
        <?= $Page->grup->selectOptionListHtml("x_grup") ?>
    </select>
    <?= $Page->grup->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->grup->getErrorMessage() ?></div>
<?= $Page->grup->Lookup->getParamTag($Page, "p_x_grup") ?>
<script>
loadjs.ready("fpengetahuanedit", function() {
    var options = { name: "x_grup", selectId: "fpengetahuanedit_x_grup" };
    if (fpengetahuanedit.lists.grup.lookupOptions.length) {
        options.data = { id: "x_grup", form: "fpengetahuanedit" };
    } else {
        options.ajax = { id: "x_grup", form: "fpengetahuanedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.pengetahuan.fields.grup.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->judul->Visible) { // judul ?>
    <div id="r_judul"<?= $Page->judul->rowAttributes() ?>>
        <label id="elh_pengetahuan_judul" for="x_judul" class="<?= $Page->LeftColumnClass ?>"><?= $Page->judul->caption() ?><?= $Page->judul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->judul->cellAttributes() ?>>
<span id="el_pengetahuan_judul">
<textarea data-table="pengetahuan" data-field="x_judul" name="x_judul" id="x_judul" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->judul->getPlaceHolder()) ?>"<?= $Page->judul->editAttributes() ?> aria-describedby="x_judul_help"><?= $Page->judul->EditValue ?></textarea>
<?= $Page->judul->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->judul->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->isi->Visible) { // isi ?>
    <div id="r_isi"<?= $Page->isi->rowAttributes() ?>>
        <label id="elh_pengetahuan_isi" for="x_isi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->isi->caption() ?><?= $Page->isi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->isi->cellAttributes() ?>>
<span id="el_pengetahuan_isi">
<textarea data-table="pengetahuan" data-field="x_isi" name="x_isi" id="x_isi" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->isi->getPlaceHolder()) ?>"<?= $Page->isi->editAttributes() ?> aria-describedby="x_isi_help"><?= $Page->isi->EditValue ?></textarea>
<?= $Page->isi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->isi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sumber_url->Visible) { // sumber_url ?>
    <div id="r_sumber_url"<?= $Page->sumber_url->rowAttributes() ?>>
        <label id="elh_pengetahuan_sumber_url" for="x_sumber_url" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sumber_url->caption() ?><?= $Page->sumber_url->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sumber_url->cellAttributes() ?>>
<span id="el_pengetahuan_sumber_url">
<input type="<?= $Page->sumber_url->getInputTextType() ?>" name="x_sumber_url" id="x_sumber_url" data-table="pengetahuan" data-field="x_sumber_url" value="<?= $Page->sumber_url->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->sumber_url->getPlaceHolder()) ?>"<?= $Page->sumber_url->editAttributes() ?> aria-describedby="x_sumber_url_help">
<?= $Page->sumber_url->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sumber_url->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->visual->Visible) { // visual ?>
    <div id="r_visual"<?= $Page->visual->rowAttributes() ?>>
        <label id="elh_pengetahuan_visual" for="x_visual" class="<?= $Page->LeftColumnClass ?>"><?= $Page->visual->caption() ?><?= $Page->visual->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->visual->cellAttributes() ?>>
<span id="el_pengetahuan_visual">
<input type="<?= $Page->visual->getInputTextType() ?>" name="x_visual" id="x_visual" data-table="pengetahuan" data-field="x_visual" value="<?= $Page->visual->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->visual->getPlaceHolder()) ?>"<?= $Page->visual->editAttributes() ?> aria-describedby="x_visual_help">
<?= $Page->visual->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->visual->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
    <div id="r_dokumen"<?= $Page->dokumen->rowAttributes() ?>>
        <label id="elh_pengetahuan_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dokumen->caption() ?><?= $Page->dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dokumen->cellAttributes() ?>>
<span id="el_pengetahuan_dokumen">
<div id="fd_x_dokumen" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->dokumen->title() ?>" data-table="pengetahuan" data-field="x_dokumen" name="x_dokumen" id="x_dokumen" lang="<?= CurrentLanguageID() ?>"<?= $Page->dokumen->editAttributes() ?> aria-describedby="x_dokumen_help"<?= ($Page->dokumen->ReadOnly || $Page->dokumen->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->dokumen->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dokumen->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_dokumen" id= "fn_x_dokumen" value="<?= $Page->dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x_dokumen" id= "fa_x_dokumen" value="<?= (Post("fa_x_dokumen") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_dokumen" id= "fs_x_dokumen" value="255">
<input type="hidden" name="fx_x_dokumen" id= "fx_x_dokumen" value="<?= $Page->dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_dokumen" id= "fm_x_dokumen" value="<?= $Page->dokumen->UploadMaxFileSize ?>">
<table id="ft_x_dokumen" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="pengetahuan" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("pengetahuan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
