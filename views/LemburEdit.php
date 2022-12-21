<?php

namespace PHPMaker2022\sigap;

// Page object
$LemburEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { lembur: currentTable } });
var currentForm, currentPageID;
var flemburedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    flemburedit = new ew.Form("flemburedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = flemburedit;

    // Add fields
    var fields = currentTable.fields;
    flemburedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["pegawai", [fields.pegawai.visible && fields.pegawai.required ? ew.Validators.required(fields.pegawai.caption) : null, ew.Validators.integer], fields.pegawai.isInvalid],
        ["proyek", [fields.proyek.visible && fields.proyek.required ? ew.Validators.required(fields.proyek.caption) : null], fields.proyek.isInvalid],
        ["pm", [fields.pm.visible && fields.pm.required ? ew.Validators.required(fields.pm.caption) : null, ew.Validators.integer], fields.pm.isInvalid],
        ["tgl", [fields.tgl.visible && fields.tgl.required ? ew.Validators.required(fields.tgl.caption) : null], fields.tgl.isInvalid],
        ["tgl_awal_lembur", [fields.tgl_awal_lembur.visible && fields.tgl_awal_lembur.required ? ew.Validators.required(fields.tgl_awal_lembur.caption) : null, ew.Validators.datetime(fields.tgl_awal_lembur.clientFormatPattern)], fields.tgl_awal_lembur.isInvalid],
        ["tgl_akhir_lembur", [fields.tgl_akhir_lembur.visible && fields.tgl_akhir_lembur.required ? ew.Validators.required(fields.tgl_akhir_lembur.caption) : null, ew.Validators.datetime(fields.tgl_akhir_lembur.clientFormatPattern)], fields.tgl_akhir_lembur.isInvalid],
        ["total_jam", [fields.total_jam.visible && fields.total_jam.required ? ew.Validators.required(fields.total_jam.caption) : null, ew.Validators.integer], fields.total_jam.isInvalid],
        ["jenis", [fields.jenis.visible && fields.jenis.required ? ew.Validators.required(fields.jenis.caption) : null], fields.jenis.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
        ["disetujui", [fields.disetujui.visible && fields.disetujui.required ? ew.Validators.required(fields.disetujui.caption) : null], fields.disetujui.isInvalid],
        ["dokumen", [fields.dokumen.visible && fields.dokumen.required ? ew.Validators.fileRequired(fields.dokumen.caption) : null], fields.dokumen.isInvalid]
    ]);

    // Form_CustomValidate
    flemburedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    flemburedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    flemburedit.lists.pegawai = <?= $Page->pegawai->toClientList($Page) ?>;
    flemburedit.lists.proyek = <?= $Page->proyek->toClientList($Page) ?>;
    flemburedit.lists.pm = <?= $Page->pm->toClientList($Page) ?>;
    flemburedit.lists.jenis = <?= $Page->jenis->toClientList($Page) ?>;
    flemburedit.lists.disetujui = <?= $Page->disetujui->toClientList($Page) ?>;
    loadjs.done("flemburedit");
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
<form name="flemburedit" id="flemburedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="lembur">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_lembur_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_lembur_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="lembur" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <div id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <label id="elh_lembur_pegawai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pegawai->caption() ?><?= $Page->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_lembur_pegawai">
<?php
$onchange = $Page->pegawai->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->pegawai->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Page->pegawai->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_pegawai" class="ew-auto-suggest">
    <input type="<?= $Page->pegawai->getInputTextType() ?>" class="form-control" name="sv_x_pegawai" id="sv_x_pegawai" value="<?= RemoveHtml($Page->pegawai->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Page->pegawai->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->pegawai->getPlaceHolder()) ?>"<?= $Page->pegawai->editAttributes() ?> aria-describedby="x_pegawai_help">
</span>
<selection-list hidden class="form-control" data-table="lembur" data-field="x_pegawai" data-input="sv_x_pegawai" data-value-separator="<?= $Page->pegawai->displayValueSeparatorAttribute() ?>" name="x_pegawai" id="x_pegawai" value="<?= HtmlEncode($Page->pegawai->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<?= $Page->pegawai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pegawai->getErrorMessage() ?></div>
<script>
loadjs.ready("flemburedit", function() {
    flemburedit.createAutoSuggest(Object.assign({"id":"x_pegawai","forceSelect":false}, ew.vars.tables.lembur.fields.pegawai.autoSuggestOptions));
});
</script>
<?= $Page->pegawai->Lookup->getParamTag($Page, "p_x_pegawai") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->proyek->Visible) { // proyek ?>
    <div id="r_proyek"<?= $Page->proyek->rowAttributes() ?>>
        <label id="elh_lembur_proyek" class="<?= $Page->LeftColumnClass ?>"><?= $Page->proyek->caption() ?><?= $Page->proyek->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->proyek->cellAttributes() ?>>
<span id="el_lembur_proyek">
    <select
        id="x_proyek"
        name="x_proyek"
        class="form-control ew-select<?= $Page->proyek->isInvalidClass() ?>"
        data-select2-id="flemburedit_x_proyek"
        data-table="lembur"
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
loadjs.ready("flemburedit", function() {
    var options = { name: "x_proyek", selectId: "flemburedit_x_proyek" };
    if (flemburedit.lists.proyek.lookupOptions.length) {
        options.data = { id: "x_proyek", form: "flemburedit" };
    } else {
        options.ajax = { id: "x_proyek", form: "flemburedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.lembur.fields.proyek.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pm->Visible) { // pm ?>
    <div id="r_pm"<?= $Page->pm->rowAttributes() ?>>
        <label id="elh_lembur_pm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pm->caption() ?><?= $Page->pm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pm->cellAttributes() ?>>
<span id="el_lembur_pm">
    <select
        id="x_pm"
        name="x_pm"
        class="form-control ew-select<?= $Page->pm->isInvalidClass() ?>"
        data-select2-id="flemburedit_x_pm"
        data-table="lembur"
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
loadjs.ready("flemburedit", function() {
    var options = { name: "x_pm", selectId: "flemburedit_x_pm" };
    if (flemburedit.lists.pm.lookupOptions.length) {
        options.data = { id: "x_pm", form: "flemburedit" };
    } else {
        options.ajax = { id: "x_pm", form: "flemburedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.lembur.fields.pm.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_awal_lembur->Visible) { // tgl_awal_lembur ?>
    <div id="r_tgl_awal_lembur"<?= $Page->tgl_awal_lembur->rowAttributes() ?>>
        <label id="elh_lembur_tgl_awal_lembur" for="x_tgl_awal_lembur" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_awal_lembur->caption() ?><?= $Page->tgl_awal_lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_awal_lembur->cellAttributes() ?>>
<span id="el_lembur_tgl_awal_lembur">
<input type="<?= $Page->tgl_awal_lembur->getInputTextType() ?>" name="x_tgl_awal_lembur" id="x_tgl_awal_lembur" data-table="lembur" data-field="x_tgl_awal_lembur" value="<?= $Page->tgl_awal_lembur->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_awal_lembur->getPlaceHolder()) ?>"<?= $Page->tgl_awal_lembur->editAttributes() ?> aria-describedby="x_tgl_awal_lembur_help">
<?= $Page->tgl_awal_lembur->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_awal_lembur->getErrorMessage() ?></div>
<?php if (!$Page->tgl_awal_lembur->ReadOnly && !$Page->tgl_awal_lembur->Disabled && !isset($Page->tgl_awal_lembur->EditAttrs["readonly"]) && !isset($Page->tgl_awal_lembur->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["flemburedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("flemburedit", "x_tgl_awal_lembur", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_akhir_lembur->Visible) { // tgl_akhir_lembur ?>
    <div id="r_tgl_akhir_lembur"<?= $Page->tgl_akhir_lembur->rowAttributes() ?>>
        <label id="elh_lembur_tgl_akhir_lembur" for="x_tgl_akhir_lembur" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_akhir_lembur->caption() ?><?= $Page->tgl_akhir_lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_akhir_lembur->cellAttributes() ?>>
<span id="el_lembur_tgl_akhir_lembur">
<input type="<?= $Page->tgl_akhir_lembur->getInputTextType() ?>" name="x_tgl_akhir_lembur" id="x_tgl_akhir_lembur" data-table="lembur" data-field="x_tgl_akhir_lembur" value="<?= $Page->tgl_akhir_lembur->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_akhir_lembur->getPlaceHolder()) ?>"<?= $Page->tgl_akhir_lembur->editAttributes() ?> aria-describedby="x_tgl_akhir_lembur_help">
<?= $Page->tgl_akhir_lembur->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_akhir_lembur->getErrorMessage() ?></div>
<?php if (!$Page->tgl_akhir_lembur->ReadOnly && !$Page->tgl_akhir_lembur->Disabled && !isset($Page->tgl_akhir_lembur->EditAttrs["readonly"]) && !isset($Page->tgl_akhir_lembur->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["flemburedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("flemburedit", "x_tgl_akhir_lembur", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total_jam->Visible) { // total_jam ?>
    <div id="r_total_jam"<?= $Page->total_jam->rowAttributes() ?>>
        <label id="elh_lembur_total_jam" for="x_total_jam" class="<?= $Page->LeftColumnClass ?>"><?= $Page->total_jam->caption() ?><?= $Page->total_jam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->total_jam->cellAttributes() ?>>
<span id="el_lembur_total_jam">
<input type="<?= $Page->total_jam->getInputTextType() ?>" name="x_total_jam" id="x_total_jam" data-table="lembur" data-field="x_total_jam" value="<?= $Page->total_jam->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->total_jam->getPlaceHolder()) ?>"<?= $Page->total_jam->editAttributes() ?> aria-describedby="x_total_jam_help">
<?= $Page->total_jam->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total_jam->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <div id="r_jenis"<?= $Page->jenis->rowAttributes() ?>>
        <label id="elh_lembur_jenis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis->caption() ?><?= $Page->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenis->cellAttributes() ?>>
<span id="el_lembur_jenis">
    <select
        id="x_jenis"
        name="x_jenis"
        class="form-control ew-select<?= $Page->jenis->isInvalidClass() ?>"
        data-select2-id="flemburedit_x_jenis"
        data-table="lembur"
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
loadjs.ready("flemburedit", function() {
    var options = { name: "x_jenis", selectId: "flemburedit_x_jenis" };
    if (flemburedit.lists.jenis.lookupOptions.length) {
        options.data = { id: "x_jenis", form: "flemburedit" };
    } else {
        options.ajax = { id: "x_jenis", form: "flemburedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.lembur.fields.jenis.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <div id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_lembur_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_lembur_keterangan">
<input type="<?= $Page->keterangan->getInputTextType() ?>" name="x_keterangan" id="x_keterangan" data-table="lembur" data-field="x_keterangan" value="<?= $Page->keterangan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help">
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
    <div id="r_disetujui"<?= $Page->disetujui->rowAttributes() ?>>
        <label id="elh_lembur_disetujui" class="<?= $Page->LeftColumnClass ?>"><?= $Page->disetujui->caption() ?><?= $Page->disetujui->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->disetujui->cellAttributes() ?>>
<span id="el_lembur_disetujui">
<template id="tp_x_disetujui">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="lembur" data-field="x_disetujui" name="x_disetujui" id="x_disetujui"<?= $Page->disetujui->editAttributes() ?>>
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
    data-table="lembur"
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
        <label id="elh_lembur_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dokumen->caption() ?><?= $Page->dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dokumen->cellAttributes() ?>>
<span id="el_lembur_dokumen">
<div id="fd_x_dokumen" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->dokumen->title() ?>" data-table="lembur" data-field="x_dokumen" name="x_dokumen" id="x_dokumen" lang="<?= CurrentLanguageID() ?>"<?= $Page->dokumen->editAttributes() ?> aria-describedby="x_dokumen_help"<?= ($Page->dokumen->ReadOnly || $Page->dokumen->Disabled) ? " disabled" : "" ?>>
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
    ew.addEventHandlers("lembur");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
