<?php

namespace PHPMaker2022\sigap;

// Page object
$DinasluarAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { dinasluar: currentTable } });
var currentForm, currentPageID;
var fdinasluaradd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdinasluaradd = new ew.Form("fdinasluaradd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fdinasluaradd;

    // Add fields
    var fields = currentTable.fields;
    fdinasluaradd.addFields([
        ["pegawai", [fields.pegawai.visible && fields.pegawai.required ? ew.Validators.required(fields.pegawai.caption) : null, ew.Validators.integer], fields.pegawai.isInvalid],
        ["pm", [fields.pm.visible && fields.pm.required ? ew.Validators.required(fields.pm.caption) : null, ew.Validators.integer], fields.pm.isInvalid],
        ["proyek", [fields.proyek.visible && fields.proyek.required ? ew.Validators.required(fields.proyek.caption) : null], fields.proyek.isInvalid],
        ["tgl", [fields.tgl.visible && fields.tgl.required ? ew.Validators.required(fields.tgl.caption) : null], fields.tgl.isInvalid],
        ["tgl_dl_awal", [fields.tgl_dl_awal.visible && fields.tgl_dl_awal.required ? ew.Validators.required(fields.tgl_dl_awal.caption) : null, ew.Validators.datetime(fields.tgl_dl_awal.clientFormatPattern)], fields.tgl_dl_awal.isInvalid],
        ["tgl_dl_akhir", [fields.tgl_dl_akhir.visible && fields.tgl_dl_akhir.required ? ew.Validators.required(fields.tgl_dl_akhir.caption) : null, ew.Validators.datetime(fields.tgl_dl_akhir.clientFormatPattern)], fields.tgl_dl_akhir.isInvalid],
        ["jenis", [fields.jenis.visible && fields.jenis.required ? ew.Validators.required(fields.jenis.caption) : null], fields.jenis.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
        ["disetujui", [fields.disetujui.visible && fields.disetujui.required ? ew.Validators.required(fields.disetujui.caption) : null], fields.disetujui.isInvalid],
        ["dokumen", [fields.dokumen.visible && fields.dokumen.required ? ew.Validators.fileRequired(fields.dokumen.caption) : null], fields.dokumen.isInvalid]
    ]);

    // Form_CustomValidate
    fdinasluaradd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdinasluaradd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fdinasluaradd.lists.pegawai = <?= $Page->pegawai->toClientList($Page) ?>;
    fdinasluaradd.lists.pm = <?= $Page->pm->toClientList($Page) ?>;
    fdinasluaradd.lists.proyek = <?= $Page->proyek->toClientList($Page) ?>;
    fdinasluaradd.lists.jenis = <?= $Page->jenis->toClientList($Page) ?>;
    fdinasluaradd.lists.disetujui = <?= $Page->disetujui->toClientList($Page) ?>;
    loadjs.done("fdinasluaradd");
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
<form name="fdinasluaradd" id="fdinasluaradd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="dinasluar">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <div id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <label id="elh_dinasluar_pegawai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pegawai->caption() ?><?= $Page->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_dinasluar_pegawai">
    <select
        id="x_pegawai"
        name="x_pegawai"
        class="form-control ew-select<?= $Page->pegawai->isInvalidClass() ?>"
        data-select2-id="fdinasluaradd_x_pegawai"
        data-table="dinasluar"
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
loadjs.ready("fdinasluaradd", function() {
    var options = { name: "x_pegawai", selectId: "fdinasluaradd_x_pegawai" };
    if (fdinasluaradd.lists.pegawai.lookupOptions.length) {
        options.data = { id: "x_pegawai", form: "fdinasluaradd" };
    } else {
        options.ajax = { id: "x_pegawai", form: "fdinasluaradd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.dinasluar.fields.pegawai.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pm->Visible) { // pm ?>
    <div id="r_pm"<?= $Page->pm->rowAttributes() ?>>
        <label id="elh_dinasluar_pm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pm->caption() ?><?= $Page->pm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pm->cellAttributes() ?>>
<span id="el_dinasluar_pm">
    <select
        id="x_pm"
        name="x_pm"
        class="form-control ew-select<?= $Page->pm->isInvalidClass() ?>"
        data-select2-id="fdinasluaradd_x_pm"
        data-table="dinasluar"
        data-field="x_pm"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->pm->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->pm->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->pm->getPlaceHolder()) ?>"
        <?= $Page->pm->editAttributes() ?>>
        <?= $Page->pm->selectOptionListHtml("x_pm") ?>
    </select>
    <?= $Page->pm->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->pm->getErrorMessage() ?></div>
<?= $Page->pm->Lookup->getParamTag($Page, "p_x_pm") ?>
<script>
loadjs.ready("fdinasluaradd", function() {
    var options = { name: "x_pm", selectId: "fdinasluaradd_x_pm" };
    if (fdinasluaradd.lists.pm.lookupOptions.length) {
        options.data = { id: "x_pm", form: "fdinasluaradd" };
    } else {
        options.ajax = { id: "x_pm", form: "fdinasluaradd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.dinasluar.fields.pm.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->proyek->Visible) { // proyek ?>
    <div id="r_proyek"<?= $Page->proyek->rowAttributes() ?>>
        <label id="elh_dinasluar_proyek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->proyek->caption() ?><?= $Page->proyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->proyek->cellAttributes() ?>>
<span id="el_dinasluar_proyek">
    <select
        id="x_proyek"
        name="x_proyek"
        class="form-control ew-select<?= $Page->proyek->isInvalidClass() ?>"
        data-select2-id="fdinasluaradd_x_proyek"
        data-table="dinasluar"
        data-field="x_proyek"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->proyek->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->proyek->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->proyek->getPlaceHolder()) ?>"
        <?= $Page->proyek->editAttributes() ?>>
        <?= $Page->proyek->selectOptionListHtml("x_proyek") ?>
    </select>
    <?= $Page->proyek->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->proyek->getErrorMessage() ?></div>
<?= $Page->proyek->Lookup->getParamTag($Page, "p_x_proyek") ?>
<script>
loadjs.ready("fdinasluaradd", function() {
    var options = { name: "x_proyek", selectId: "fdinasluaradd_x_proyek" };
    if (fdinasluaradd.lists.proyek.lookupOptions.length) {
        options.data = { id: "x_proyek", form: "fdinasluaradd" };
    } else {
        options.ajax = { id: "x_proyek", form: "fdinasluaradd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.dinasluar.fields.proyek.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_dl_awal->Visible) { // tgl_dl_awal ?>
    <div id="r_tgl_dl_awal"<?= $Page->tgl_dl_awal->rowAttributes() ?>>
        <label id="elh_dinasluar_tgl_dl_awal" for="x_tgl_dl_awal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_dl_awal->caption() ?><?= $Page->tgl_dl_awal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_dl_awal->cellAttributes() ?>>
<span id="el_dinasluar_tgl_dl_awal">
<input type="<?= $Page->tgl_dl_awal->getInputTextType() ?>" name="x_tgl_dl_awal" id="x_tgl_dl_awal" data-table="dinasluar" data-field="x_tgl_dl_awal" value="<?= $Page->tgl_dl_awal->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_dl_awal->getPlaceHolder()) ?>"<?= $Page->tgl_dl_awal->editAttributes() ?> aria-describedby="x_tgl_dl_awal_help">
<?= $Page->tgl_dl_awal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_dl_awal->getErrorMessage() ?></div>
<?php if (!$Page->tgl_dl_awal->ReadOnly && !$Page->tgl_dl_awal->Disabled && !isset($Page->tgl_dl_awal->EditAttrs["readonly"]) && !isset($Page->tgl_dl_awal->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdinasluaradd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdinasluaradd", "x_tgl_dl_awal", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_dl_akhir->Visible) { // tgl_dl_akhir ?>
    <div id="r_tgl_dl_akhir"<?= $Page->tgl_dl_akhir->rowAttributes() ?>>
        <label id="elh_dinasluar_tgl_dl_akhir" for="x_tgl_dl_akhir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_dl_akhir->caption() ?><?= $Page->tgl_dl_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_dl_akhir->cellAttributes() ?>>
<span id="el_dinasluar_tgl_dl_akhir">
<input type="<?= $Page->tgl_dl_akhir->getInputTextType() ?>" name="x_tgl_dl_akhir" id="x_tgl_dl_akhir" data-table="dinasluar" data-field="x_tgl_dl_akhir" value="<?= $Page->tgl_dl_akhir->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_dl_akhir->getPlaceHolder()) ?>"<?= $Page->tgl_dl_akhir->editAttributes() ?> aria-describedby="x_tgl_dl_akhir_help">
<?= $Page->tgl_dl_akhir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_dl_akhir->getErrorMessage() ?></div>
<?php if (!$Page->tgl_dl_akhir->ReadOnly && !$Page->tgl_dl_akhir->Disabled && !isset($Page->tgl_dl_akhir->EditAttrs["readonly"]) && !isset($Page->tgl_dl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdinasluaradd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdinasluaradd", "x_tgl_dl_akhir", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <div id="r_jenis"<?= $Page->jenis->rowAttributes() ?>>
        <label id="elh_dinasluar_jenis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis->caption() ?><?= $Page->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenis->cellAttributes() ?>>
<span id="el_dinasluar_jenis">
    <select
        id="x_jenis"
        name="x_jenis"
        class="form-control ew-select<?= $Page->jenis->isInvalidClass() ?>"
        data-select2-id="fdinasluaradd_x_jenis"
        data-table="dinasluar"
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
loadjs.ready("fdinasluaradd", function() {
    var options = { name: "x_jenis", selectId: "fdinasluaradd_x_jenis" };
    if (fdinasluaradd.lists.jenis.lookupOptions.length) {
        options.data = { id: "x_jenis", form: "fdinasluaradd" };
    } else {
        options.ajax = { id: "x_jenis", form: "fdinasluaradd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.dinasluar.fields.jenis.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <div id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_dinasluar_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_dinasluar_keterangan">
<input type="<?= $Page->keterangan->getInputTextType() ?>" name="x_keterangan" id="x_keterangan" data-table="dinasluar" data-field="x_keterangan" value="<?= $Page->keterangan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help">
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
    <div id="r_disetujui"<?= $Page->disetujui->rowAttributes() ?>>
        <label id="elh_dinasluar_disetujui" class="<?= $Page->LeftColumnClass ?>"><?= $Page->disetujui->caption() ?><?= $Page->disetujui->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->disetujui->cellAttributes() ?>>
<span id="el_dinasluar_disetujui">
<template id="tp_x_disetujui">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="dinasluar" data-field="x_disetujui" name="x_disetujui" id="x_disetujui"<?= $Page->disetujui->editAttributes() ?>>
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
    data-table="dinasluar"
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
        <label id="elh_dinasluar_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dokumen->caption() ?><?= $Page->dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dokumen->cellAttributes() ?>>
<span id="el_dinasluar_dokumen">
<div id="fd_x_dokumen" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->dokumen->title() ?>" data-table="dinasluar" data-field="x_dokumen" name="x_dokumen" id="x_dokumen" lang="<?= CurrentLanguageID() ?>"<?= $Page->dokumen->editAttributes() ?> aria-describedby="x_dokumen_help"<?= ($Page->dokumen->ReadOnly || $Page->dokumen->Disabled) ? " disabled" : "" ?>>
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
    ew.addEventHandlers("dinasluar");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
