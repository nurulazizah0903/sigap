<?php

namespace PHPMaker2022\sigap;

// Page object
$BeritaEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { berita: currentTable } });
var currentForm, currentPageID;
var fberitaedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fberitaedit = new ew.Form("fberitaedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fberitaedit;

    // Add fields
    var fields = currentTable.fields;
    fberitaedit.addFields([
        ["grup", [fields.grup.visible && fields.grup.required ? ew.Validators.required(fields.grup.caption) : null], fields.grup.isInvalid],
        ["judul", [fields.judul.visible && fields.judul.required ? ew.Validators.required(fields.judul.caption) : null], fields.judul.isInvalid],
        ["c_by", [fields.c_by.visible && fields.c_by.required ? ew.Validators.required(fields.c_by.caption) : null], fields.c_by.isInvalid],
        ["c_date", [fields.c_date.visible && fields.c_date.required ? ew.Validators.required(fields.c_date.caption) : null], fields.c_date.isInvalid],
        ["aktif", [fields.aktif.visible && fields.aktif.required ? ew.Validators.required(fields.aktif.caption) : null, ew.Validators.integer], fields.aktif.isInvalid],
        ["video", [fields.video.visible && fields.video.required ? ew.Validators.fileRequired(fields.video.caption) : null], fields.video.isInvalid],
        ["berita", [fields.berita.visible && fields.berita.required ? ew.Validators.required(fields.berita.caption) : null], fields.berita.isInvalid],
        ["gambar", [fields.gambar.visible && fields.gambar.required ? ew.Validators.fileRequired(fields.gambar.caption) : null], fields.gambar.isInvalid]
    ]);

    // Form_CustomValidate
    fberitaedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fberitaedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fberitaedit.lists.grup = <?= $Page->grup->toClientList($Page) ?>;
    fberitaedit.lists.c_by = <?= $Page->c_by->toClientList($Page) ?>;
    loadjs.done("fberitaedit");
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
<form name="fberitaedit" id="fberitaedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="berita">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->grup->Visible) { // grup ?>
    <div id="r_grup"<?= $Page->grup->rowAttributes() ?>>
        <label id="elh_berita_grup" class="<?= $Page->LeftColumnClass ?>"><?= $Page->grup->caption() ?><?= $Page->grup->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->grup->cellAttributes() ?>>
<span id="el_berita_grup">
    <select
        id="x_grup"
        name="x_grup"
        class="form-control ew-select<?= $Page->grup->isInvalidClass() ?>"
        data-select2-id="fberitaedit_x_grup"
        data-table="berita"
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
loadjs.ready("fberitaedit", function() {
    var options = { name: "x_grup", selectId: "fberitaedit_x_grup" };
    if (fberitaedit.lists.grup.lookupOptions.length) {
        options.data = { id: "x_grup", form: "fberitaedit" };
    } else {
        options.ajax = { id: "x_grup", form: "fberitaedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.berita.fields.grup.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->judul->Visible) { // judul ?>
    <div id="r_judul"<?= $Page->judul->rowAttributes() ?>>
        <label id="elh_berita_judul" for="x_judul" class="<?= $Page->LeftColumnClass ?>"><?= $Page->judul->caption() ?><?= $Page->judul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->judul->cellAttributes() ?>>
<span id="el_berita_judul">
<input type="<?= $Page->judul->getInputTextType() ?>" name="x_judul" id="x_judul" data-table="berita" data-field="x_judul" value="<?= $Page->judul->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->judul->getPlaceHolder()) ?>"<?= $Page->judul->editAttributes() ?> aria-describedby="x_judul_help">
<?= $Page->judul->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->judul->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
    <div id="r_aktif"<?= $Page->aktif->rowAttributes() ?>>
        <label id="elh_berita_aktif" for="x_aktif" class="<?= $Page->LeftColumnClass ?>"><?= $Page->aktif->caption() ?><?= $Page->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aktif->cellAttributes() ?>>
<span id="el_berita_aktif">
<input type="<?= $Page->aktif->getInputTextType() ?>" name="x_aktif" id="x_aktif" data-table="berita" data-field="x_aktif" value="<?= $Page->aktif->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->aktif->getPlaceHolder()) ?>"<?= $Page->aktif->editAttributes() ?> aria-describedby="x_aktif_help">
<?= $Page->aktif->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->aktif->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->video->Visible) { // video ?>
    <div id="r_video"<?= $Page->video->rowAttributes() ?>>
        <label id="elh_berita_video" class="<?= $Page->LeftColumnClass ?>"><?= $Page->video->caption() ?><?= $Page->video->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->video->cellAttributes() ?>>
<span id="el_berita_video">
<div id="fd_x_video" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->video->title() ?>" data-table="berita" data-field="x_video" name="x_video" id="x_video" lang="<?= CurrentLanguageID() ?>"<?= $Page->video->editAttributes() ?> aria-describedby="x_video_help"<?= ($Page->video->ReadOnly || $Page->video->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->video->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->video->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_video" id= "fn_x_video" value="<?= $Page->video->Upload->FileName ?>">
<input type="hidden" name="fa_x_video" id= "fa_x_video" value="<?= (Post("fa_x_video") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_video" id= "fs_x_video" value="255">
<input type="hidden" name="fx_x_video" id= "fx_x_video" value="<?= $Page->video->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_video" id= "fm_x_video" value="<?= $Page->video->UploadMaxFileSize ?>">
<table id="ft_x_video" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->berita->Visible) { // berita ?>
    <div id="r_berita"<?= $Page->berita->rowAttributes() ?>>
        <label id="elh_berita_berita" for="x_berita" class="<?= $Page->LeftColumnClass ?>"><?= $Page->berita->caption() ?><?= $Page->berita->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->berita->cellAttributes() ?>>
<span id="el_berita_berita">
<textarea data-table="berita" data-field="x_berita" name="x_berita" id="x_berita" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->berita->getPlaceHolder()) ?>"<?= $Page->berita->editAttributes() ?> aria-describedby="x_berita_help"><?= $Page->berita->EditValue ?></textarea>
<?= $Page->berita->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->berita->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gambar->Visible) { // gambar ?>
    <div id="r_gambar"<?= $Page->gambar->rowAttributes() ?>>
        <label id="elh_berita_gambar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gambar->caption() ?><?= $Page->gambar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gambar->cellAttributes() ?>>
<span id="el_berita_gambar">
<div id="fd_x_gambar" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->gambar->title() ?>" data-table="berita" data-field="x_gambar" name="x_gambar" id="x_gambar" lang="<?= CurrentLanguageID() ?>"<?= $Page->gambar->editAttributes() ?> aria-describedby="x_gambar_help"<?= ($Page->gambar->ReadOnly || $Page->gambar->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->gambar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gambar->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_gambar" id= "fn_x_gambar" value="<?= $Page->gambar->Upload->FileName ?>">
<input type="hidden" name="fa_x_gambar" id= "fa_x_gambar" value="<?= (Post("fa_x_gambar") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_gambar" id= "fs_x_gambar" value="255">
<input type="hidden" name="fx_x_gambar" id= "fx_x_gambar" value="<?= $Page->gambar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_gambar" id= "fm_x_gambar" value="<?= $Page->gambar->UploadMaxFileSize ?>">
<table id="ft_x_gambar" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="berita" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
<?php
    if (in_array("komentar", explode(",", $Page->getCurrentDetailTable())) && $komentar->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("komentar", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "KomentarGrid.php" ?>
<?php } ?>
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
    ew.addEventHandlers("berita");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
