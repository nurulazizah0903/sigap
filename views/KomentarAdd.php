<?php

namespace PHPMaker2022\sigap;

// Page object
$KomentarAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { komentar: currentTable } });
var currentForm, currentPageID;
var fkomentaradd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fkomentaradd = new ew.Form("fkomentaradd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fkomentaradd;

    // Add fields
    var fields = currentTable.fields;
    fkomentaradd.addFields([
        ["pegawai", [fields.pegawai.visible && fields.pegawai.required ? ew.Validators.required(fields.pegawai.caption) : null, ew.Validators.integer], fields.pegawai.isInvalid],
        ["komentar", [fields.komentar.visible && fields.komentar.required ? ew.Validators.required(fields.komentar.caption) : null], fields.komentar.isInvalid],
        ["gambar", [fields.gambar.visible && fields.gambar.required ? ew.Validators.fileRequired(fields.gambar.caption) : null], fields.gambar.isInvalid],
        ["video", [fields.video.visible && fields.video.required ? ew.Validators.fileRequired(fields.video.caption) : null], fields.video.isInvalid]
    ]);

    // Form_CustomValidate
    fkomentaradd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkomentaradd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fkomentaradd.lists.pegawai = <?= $Page->pegawai->toClientList($Page) ?>;
    loadjs.done("fkomentaradd");
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
<form name="fkomentaradd" id="fkomentaradd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="komentar">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "berita") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="berita">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <div id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <label id="elh_komentar_pegawai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pegawai->caption() ?><?= $Page->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_komentar_pegawai">
    <select
        id="x_pegawai"
        name="x_pegawai"
        class="form-control ew-select<?= $Page->pegawai->isInvalidClass() ?>"
        data-select2-id="fkomentaradd_x_pegawai"
        data-table="komentar"
        data-field="x_pegawai"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->pegawai->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->pegawai->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->pegawai->getPlaceHolder()) ?>"
        <?= $Page->pegawai->editAttributes() ?>>
        <?= $Page->pegawai->selectOptionListHtml("x_pegawai") ?>
    </select>
    <?= $Page->pegawai->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->pegawai->getErrorMessage() ?></div>
<?= $Page->pegawai->Lookup->getParamTag($Page, "p_x_pegawai") ?>
<script>
loadjs.ready("fkomentaradd", function() {
    var options = { name: "x_pegawai", selectId: "fkomentaradd_x_pegawai" };
    if (fkomentaradd.lists.pegawai.lookupOptions.length) {
        options.data = { id: "x_pegawai", form: "fkomentaradd" };
    } else {
        options.ajax = { id: "x_pegawai", form: "fkomentaradd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.komentar.fields.pegawai.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->komentar->Visible) { // komentar ?>
    <div id="r_komentar"<?= $Page->komentar->rowAttributes() ?>>
        <label id="elh_komentar_komentar" for="x_komentar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->komentar->caption() ?><?= $Page->komentar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->komentar->cellAttributes() ?>>
<span id="el_komentar_komentar">
<textarea data-table="komentar" data-field="x_komentar" name="x_komentar" id="x_komentar" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->komentar->getPlaceHolder()) ?>"<?= $Page->komentar->editAttributes() ?> aria-describedby="x_komentar_help"><?= $Page->komentar->EditValue ?></textarea>
<?= $Page->komentar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->komentar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gambar->Visible) { // gambar ?>
    <div id="r_gambar"<?= $Page->gambar->rowAttributes() ?>>
        <label id="elh_komentar_gambar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gambar->caption() ?><?= $Page->gambar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gambar->cellAttributes() ?>>
<span id="el_komentar_gambar">
<div id="fd_x_gambar" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->gambar->title() ?>" data-table="komentar" data-field="x_gambar" name="x_gambar" id="x_gambar" lang="<?= CurrentLanguageID() ?>"<?= $Page->gambar->editAttributes() ?> aria-describedby="x_gambar_help"<?= ($Page->gambar->ReadOnly || $Page->gambar->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->gambar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gambar->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_gambar" id= "fn_x_gambar" value="<?= $Page->gambar->Upload->FileName ?>">
<input type="hidden" name="fa_x_gambar" id= "fa_x_gambar" value="0">
<input type="hidden" name="fs_x_gambar" id= "fs_x_gambar" value="255">
<input type="hidden" name="fx_x_gambar" id= "fx_x_gambar" value="<?= $Page->gambar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_gambar" id= "fm_x_gambar" value="<?= $Page->gambar->UploadMaxFileSize ?>">
<table id="ft_x_gambar" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->video->Visible) { // video ?>
    <div id="r_video"<?= $Page->video->rowAttributes() ?>>
        <label id="elh_komentar_video" class="<?= $Page->LeftColumnClass ?>"><?= $Page->video->caption() ?><?= $Page->video->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->video->cellAttributes() ?>>
<span id="el_komentar_video">
<div id="fd_x_video" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->video->title() ?>" data-table="komentar" data-field="x_video" name="x_video" id="x_video" lang="<?= CurrentLanguageID() ?>"<?= $Page->video->editAttributes() ?> aria-describedby="x_video_help"<?= ($Page->video->ReadOnly || $Page->video->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->video->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->video->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_video" id= "fn_x_video" value="<?= $Page->video->Upload->FileName ?>">
<input type="hidden" name="fa_x_video" id= "fa_x_video" value="0">
<input type="hidden" name="fs_x_video" id= "fs_x_video" value="255">
<input type="hidden" name="fx_x_video" id= "fx_x_video" value="<?= $Page->video->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_video" id= "fm_x_video" value="<?= $Page->video->UploadMaxFileSize ?>">
<table id="ft_x_video" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <?php if (strval($Page->pid->getSessionValue() ?? "") != "") { ?>
    <input type="hidden" name="x_pid" id="x_pid" value="<?= HtmlEncode(strval($Page->pid->getSessionValue() ?? "")) ?>">
    <?php } ?>
<?php if (!$Page->IsModal) { ?>
<div class="row"><!-- buttons .row -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
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
    ew.addEventHandlers("komentar");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
