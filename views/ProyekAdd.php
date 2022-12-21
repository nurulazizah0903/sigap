<?php

namespace PHPMaker2022\sigap;

// Page object
$ProyekAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { proyek: currentTable } });
var currentForm, currentPageID;
var fproyekadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fproyekadd = new ew.Form("fproyekadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fproyekadd;

    // Add fields
    var fields = currentTable.fields;
    fproyekadd.addFields([
        ["klien", [fields.klien.visible && fields.klien.required ? ew.Validators.required(fields.klien.caption) : null], fields.klien.isInvalid],
        ["proyek", [fields.proyek.visible && fields.proyek.required ? ew.Validators.required(fields.proyek.caption) : null], fields.proyek.isInvalid],
        ["tgl_awal", [fields.tgl_awal.visible && fields.tgl_awal.required ? ew.Validators.required(fields.tgl_awal.caption) : null, ew.Validators.datetime(fields.tgl_awal.clientFormatPattern)], fields.tgl_awal.isInvalid],
        ["tgl_akhir", [fields.tgl_akhir.visible && fields.tgl_akhir.required ? ew.Validators.required(fields.tgl_akhir.caption) : null, ew.Validators.datetime(fields.tgl_akhir.clientFormatPattern)], fields.tgl_akhir.isInvalid],
        ["file_proyek", [fields.file_proyek.visible && fields.file_proyek.required ? ew.Validators.fileRequired(fields.file_proyek.caption) : null], fields.file_proyek.isInvalid],
        ["aktif", [fields.aktif.visible && fields.aktif.required ? ew.Validators.required(fields.aktif.caption) : null, ew.Validators.integer], fields.aktif.isInvalid]
    ]);

    // Form_CustomValidate
    fproyekadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fproyekadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fproyekadd");
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
<form name="fproyekadd" id="fproyekadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="proyek">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->klien->Visible) { // klien ?>
    <div id="r_klien"<?= $Page->klien->rowAttributes() ?>>
        <label id="elh_proyek_klien" for="x_klien" class="<?= $Page->LeftColumnClass ?>"><?= $Page->klien->caption() ?><?= $Page->klien->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->klien->cellAttributes() ?>>
<span id="el_proyek_klien">
<input type="<?= $Page->klien->getInputTextType() ?>" name="x_klien" id="x_klien" data-table="proyek" data-field="x_klien" value="<?= $Page->klien->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->klien->getPlaceHolder()) ?>"<?= $Page->klien->editAttributes() ?> aria-describedby="x_klien_help">
<?= $Page->klien->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->klien->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->proyek->Visible) { // proyek ?>
    <div id="r_proyek"<?= $Page->proyek->rowAttributes() ?>>
        <label id="elh_proyek_proyek" for="x_proyek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->proyek->caption() ?><?= $Page->proyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->proyek->cellAttributes() ?>>
<span id="el_proyek_proyek">
<input type="<?= $Page->proyek->getInputTextType() ?>" name="x_proyek" id="x_proyek" data-table="proyek" data-field="x_proyek" value="<?= $Page->proyek->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->proyek->getPlaceHolder()) ?>"<?= $Page->proyek->editAttributes() ?> aria-describedby="x_proyek_help">
<?= $Page->proyek->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->proyek->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_awal->Visible) { // tgl_awal ?>
    <div id="r_tgl_awal"<?= $Page->tgl_awal->rowAttributes() ?>>
        <label id="elh_proyek_tgl_awal" for="x_tgl_awal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_awal->caption() ?><?= $Page->tgl_awal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_awal->cellAttributes() ?>>
<span id="el_proyek_tgl_awal">
<input type="<?= $Page->tgl_awal->getInputTextType() ?>" name="x_tgl_awal" id="x_tgl_awal" data-table="proyek" data-field="x_tgl_awal" value="<?= $Page->tgl_awal->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_awal->getPlaceHolder()) ?>"<?= $Page->tgl_awal->editAttributes() ?> aria-describedby="x_tgl_awal_help">
<?= $Page->tgl_awal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_awal->getErrorMessage() ?></div>
<?php if (!$Page->tgl_awal->ReadOnly && !$Page->tgl_awal->Disabled && !isset($Page->tgl_awal->EditAttrs["readonly"]) && !isset($Page->tgl_awal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproyekadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fproyekadd", "x_tgl_awal", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_akhir->Visible) { // tgl_akhir ?>
    <div id="r_tgl_akhir"<?= $Page->tgl_akhir->rowAttributes() ?>>
        <label id="elh_proyek_tgl_akhir" for="x_tgl_akhir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_akhir->caption() ?><?= $Page->tgl_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_akhir->cellAttributes() ?>>
<span id="el_proyek_tgl_akhir">
<input type="<?= $Page->tgl_akhir->getInputTextType() ?>" name="x_tgl_akhir" id="x_tgl_akhir" data-table="proyek" data-field="x_tgl_akhir" value="<?= $Page->tgl_akhir->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_akhir->getPlaceHolder()) ?>"<?= $Page->tgl_akhir->editAttributes() ?> aria-describedby="x_tgl_akhir_help">
<?= $Page->tgl_akhir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_akhir->getErrorMessage() ?></div>
<?php if (!$Page->tgl_akhir->ReadOnly && !$Page->tgl_akhir->Disabled && !isset($Page->tgl_akhir->EditAttrs["readonly"]) && !isset($Page->tgl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fproyekadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fproyekadd", "x_tgl_akhir", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->file_proyek->Visible) { // file_proyek ?>
    <div id="r_file_proyek"<?= $Page->file_proyek->rowAttributes() ?>>
        <label id="elh_proyek_file_proyek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->file_proyek->caption() ?><?= $Page->file_proyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->file_proyek->cellAttributes() ?>>
<span id="el_proyek_file_proyek">
<div id="fd_x_file_proyek" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->file_proyek->title() ?>" data-table="proyek" data-field="x_file_proyek" name="x_file_proyek" id="x_file_proyek" lang="<?= CurrentLanguageID() ?>"<?= $Page->file_proyek->editAttributes() ?> aria-describedby="x_file_proyek_help"<?= ($Page->file_proyek->ReadOnly || $Page->file_proyek->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->file_proyek->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->file_proyek->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_file_proyek" id= "fn_x_file_proyek" value="<?= $Page->file_proyek->Upload->FileName ?>">
<input type="hidden" name="fa_x_file_proyek" id= "fa_x_file_proyek" value="0">
<input type="hidden" name="fs_x_file_proyek" id= "fs_x_file_proyek" value="255">
<input type="hidden" name="fx_x_file_proyek" id= "fx_x_file_proyek" value="<?= $Page->file_proyek->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_file_proyek" id= "fm_x_file_proyek" value="<?= $Page->file_proyek->UploadMaxFileSize ?>">
<table id="ft_x_file_proyek" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
    <div id="r_aktif"<?= $Page->aktif->rowAttributes() ?>>
        <label id="elh_proyek_aktif" for="x_aktif" class="<?= $Page->LeftColumnClass ?>"><?= $Page->aktif->caption() ?><?= $Page->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aktif->cellAttributes() ?>>
<span id="el_proyek_aktif">
<input type="<?= $Page->aktif->getInputTextType() ?>" name="x_aktif" id="x_aktif" data-table="proyek" data-field="x_aktif" value="<?= $Page->aktif->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->aktif->getPlaceHolder()) ?>"<?= $Page->aktif->editAttributes() ?> aria-describedby="x_aktif_help">
<?= $Page->aktif->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->aktif->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
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
    ew.addEventHandlers("proyek");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
