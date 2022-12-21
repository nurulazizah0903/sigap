<?php

namespace PHPMaker2022\sigap;

// Page object
$IjinAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { ijin: currentTable } });
var currentForm, currentPageID;
var fijinadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fijinadd = new ew.Form("fijinadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fijinadd;

    // Add fields
    var fields = currentTable.fields;
    fijinadd.addFields([
        ["pegawai", [fields.pegawai.visible && fields.pegawai.required ? ew.Validators.required(fields.pegawai.caption) : null, ew.Validators.integer], fields.pegawai.isInvalid],
        ["tgl", [fields.tgl.visible && fields.tgl.required ? ew.Validators.required(fields.tgl.caption) : null], fields.tgl.isInvalid],
        ["tgl_ijin_awal", [fields.tgl_ijin_awal.visible && fields.tgl_ijin_awal.required ? ew.Validators.required(fields.tgl_ijin_awal.caption) : null, ew.Validators.datetime(fields.tgl_ijin_awal.clientFormatPattern)], fields.tgl_ijin_awal.isInvalid],
        ["tgl_ijin_akhir", [fields.tgl_ijin_akhir.visible && fields.tgl_ijin_akhir.required ? ew.Validators.required(fields.tgl_ijin_akhir.caption) : null, ew.Validators.datetime(fields.tgl_ijin_akhir.clientFormatPattern)], fields.tgl_ijin_akhir.isInvalid],
        ["jenis", [fields.jenis.visible && fields.jenis.required ? ew.Validators.required(fields.jenis.caption) : null], fields.jenis.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
        ["disetujui", [fields.disetujui.visible && fields.disetujui.required ? ew.Validators.required(fields.disetujui.caption) : null], fields.disetujui.isInvalid],
        ["dokumen", [fields.dokumen.visible && fields.dokumen.required ? ew.Validators.fileRequired(fields.dokumen.caption) : null], fields.dokumen.isInvalid]
    ]);

    // Form_CustomValidate
    fijinadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fijinadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fijinadd.lists.pegawai = <?= $Page->pegawai->toClientList($Page) ?>;
    fijinadd.lists.jenis = <?= $Page->jenis->toClientList($Page) ?>;
    fijinadd.lists.disetujui = <?= $Page->disetujui->toClientList($Page) ?>;
    loadjs.done("fijinadd");
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
<form name="fijinadd" id="fijinadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="ijin">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <div id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <label id="elh_ijin_pegawai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pegawai->caption() ?><?= $Page->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_ijin_pegawai">
    <select
        id="x_pegawai"
        name="x_pegawai"
        class="form-control ew-select<?= $Page->pegawai->isInvalidClass() ?>"
        data-select2-id="fijinadd_x_pegawai"
        data-table="ijin"
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
loadjs.ready("fijinadd", function() {
    var options = { name: "x_pegawai", selectId: "fijinadd_x_pegawai" };
    if (fijinadd.lists.pegawai.lookupOptions.length) {
        options.data = { id: "x_pegawai", form: "fijinadd" };
    } else {
        options.ajax = { id: "x_pegawai", form: "fijinadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.ijin.fields.pegawai.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_ijin_awal->Visible) { // tgl_ijin_awal ?>
    <div id="r_tgl_ijin_awal"<?= $Page->tgl_ijin_awal->rowAttributes() ?>>
        <label id="elh_ijin_tgl_ijin_awal" for="x_tgl_ijin_awal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_ijin_awal->caption() ?><?= $Page->tgl_ijin_awal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_ijin_awal->cellAttributes() ?>>
<span id="el_ijin_tgl_ijin_awal">
<input type="<?= $Page->tgl_ijin_awal->getInputTextType() ?>" name="x_tgl_ijin_awal" id="x_tgl_ijin_awal" data-table="ijin" data-field="x_tgl_ijin_awal" value="<?= $Page->tgl_ijin_awal->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_ijin_awal->getPlaceHolder()) ?>"<?= $Page->tgl_ijin_awal->editAttributes() ?> aria-describedby="x_tgl_ijin_awal_help">
<?= $Page->tgl_ijin_awal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_ijin_awal->getErrorMessage() ?></div>
<?php if (!$Page->tgl_ijin_awal->ReadOnly && !$Page->tgl_ijin_awal->Disabled && !isset($Page->tgl_ijin_awal->EditAttrs["readonly"]) && !isset($Page->tgl_ijin_awal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fijinadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fijinadd", "x_tgl_ijin_awal", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_ijin_akhir->Visible) { // tgl_ijin_akhir ?>
    <div id="r_tgl_ijin_akhir"<?= $Page->tgl_ijin_akhir->rowAttributes() ?>>
        <label id="elh_ijin_tgl_ijin_akhir" for="x_tgl_ijin_akhir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_ijin_akhir->caption() ?><?= $Page->tgl_ijin_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_ijin_akhir->cellAttributes() ?>>
<span id="el_ijin_tgl_ijin_akhir">
<input type="<?= $Page->tgl_ijin_akhir->getInputTextType() ?>" name="x_tgl_ijin_akhir" id="x_tgl_ijin_akhir" data-table="ijin" data-field="x_tgl_ijin_akhir" value="<?= $Page->tgl_ijin_akhir->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_ijin_akhir->getPlaceHolder()) ?>"<?= $Page->tgl_ijin_akhir->editAttributes() ?> aria-describedby="x_tgl_ijin_akhir_help">
<?= $Page->tgl_ijin_akhir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_ijin_akhir->getErrorMessage() ?></div>
<?php if (!$Page->tgl_ijin_akhir->ReadOnly && !$Page->tgl_ijin_akhir->Disabled && !isset($Page->tgl_ijin_akhir->EditAttrs["readonly"]) && !isset($Page->tgl_ijin_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fijinadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fijinadd", "x_tgl_ijin_akhir", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <div id="r_jenis"<?= $Page->jenis->rowAttributes() ?>>
        <label id="elh_ijin_jenis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis->caption() ?><?= $Page->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenis->cellAttributes() ?>>
<span id="el_ijin_jenis">
    <select
        id="x_jenis"
        name="x_jenis"
        class="form-control ew-select<?= $Page->jenis->isInvalidClass() ?>"
        data-select2-id="fijinadd_x_jenis"
        data-table="ijin"
        data-field="x_jenis"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->jenis->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->jenis->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->jenis->getPlaceHolder()) ?>"
        <?= $Page->jenis->editAttributes() ?>>
        <?= $Page->jenis->selectOptionListHtml("x_jenis") ?>
    </select>
    <?= $Page->jenis->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->jenis->getErrorMessage() ?></div>
<?= $Page->jenis->Lookup->getParamTag($Page, "p_x_jenis") ?>
<script>
loadjs.ready("fijinadd", function() {
    var options = { name: "x_jenis", selectId: "fijinadd_x_jenis" };
    if (fijinadd.lists.jenis.lookupOptions.length) {
        options.data = { id: "x_jenis", form: "fijinadd" };
    } else {
        options.ajax = { id: "x_jenis", form: "fijinadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.ijin.fields.jenis.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <div id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_ijin_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_ijin_keterangan">
<input type="<?= $Page->keterangan->getInputTextType() ?>" name="x_keterangan" id="x_keterangan" data-table="ijin" data-field="x_keterangan" value="<?= $Page->keterangan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help">
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
    <div id="r_disetujui"<?= $Page->disetujui->rowAttributes() ?>>
        <label id="elh_ijin_disetujui" class="<?= $Page->LeftColumnClass ?>"><?= $Page->disetujui->caption() ?><?= $Page->disetujui->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->disetujui->cellAttributes() ?>>
<span id="el_ijin_disetujui">
<template id="tp_x_disetujui">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="ijin" data-field="x_disetujui" name="x_disetujui" id="x_disetujui"<?= $Page->disetujui->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_disetujui" class="ew-item-list"></div>
<selection-list hidden
    id="x_disetujui"
    name="x_disetujui"
    value="<?= HtmlEncode($Page->disetujui->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_disetujui"
    data-bs-target="dsl_x_disetujui"
    data-repeatcolumn="5"
    class="form-control<?= $Page->disetujui->isInvalidClass() ?>"
    data-table="ijin"
    data-field="x_disetujui"
    data-value-separator="<?= $Page->disetujui->displayValueSeparatorAttribute() ?>"
    <?= $Page->disetujui->editAttributes() ?>></selection-list>
<?= $Page->disetujui->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->disetujui->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dokumen->Visible) { // dokumen ?>
    <div id="r_dokumen"<?= $Page->dokumen->rowAttributes() ?>>
        <label id="elh_ijin_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dokumen->caption() ?><?= $Page->dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dokumen->cellAttributes() ?>>
<span id="el_ijin_dokumen">
<div id="fd_x_dokumen" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->dokumen->title() ?>" data-table="ijin" data-field="x_dokumen" name="x_dokumen" id="x_dokumen" lang="<?= CurrentLanguageID() ?>"<?= $Page->dokumen->editAttributes() ?> aria-describedby="x_dokumen_help"<?= ($Page->dokumen->ReadOnly || $Page->dokumen->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->dokumen->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dokumen->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_dokumen" id= "fn_x_dokumen" value="<?= $Page->dokumen->Upload->FileName ?>">
<input type="hidden" name="fa_x_dokumen" id= "fa_x_dokumen" value="0">
<input type="hidden" name="fs_x_dokumen" id= "fs_x_dokumen" value="255">
<input type="hidden" name="fx_x_dokumen" id= "fx_x_dokumen" value="<?= $Page->dokumen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_dokumen" id= "fm_x_dokumen" value="<?= $Page->dokumen->UploadMaxFileSize ?>">
<table id="ft_x_dokumen" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
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
    ew.addEventHandlers("ijin");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
