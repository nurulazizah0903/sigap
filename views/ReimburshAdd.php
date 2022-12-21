<?php

namespace PHPMaker2022\sigap;

// Page object
$ReimburshAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { reimbursh: currentTable } });
var currentForm, currentPageID;
var freimburshadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    freimburshadd = new ew.Form("freimburshadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = freimburshadd;

    // Add fields
    var fields = currentTable.fields;
    freimburshadd.addFields([
        ["pegawai", [fields.pegawai.visible && fields.pegawai.required ? ew.Validators.required(fields.pegawai.caption) : null, ew.Validators.integer], fields.pegawai.isInvalid],
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["tgl", [fields.tgl.visible && fields.tgl.required ? ew.Validators.required(fields.tgl.caption) : null], fields.tgl.isInvalid],
        ["total_pengajuan", [fields.total_pengajuan.visible && fields.total_pengajuan.required ? ew.Validators.required(fields.total_pengajuan.caption) : null, ew.Validators.integer], fields.total_pengajuan.isInvalid],
        ["tgl_pengajuan", [fields.tgl_pengajuan.visible && fields.tgl_pengajuan.required ? ew.Validators.required(fields.tgl_pengajuan.caption) : null, ew.Validators.datetime(fields.tgl_pengajuan.clientFormatPattern)], fields.tgl_pengajuan.isInvalid],
        ["jenis", [fields.jenis.visible && fields.jenis.required ? ew.Validators.required(fields.jenis.caption) : null], fields.jenis.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
        ["rek_tujuan", [fields.rek_tujuan.visible && fields.rek_tujuan.required ? ew.Validators.required(fields.rek_tujuan.caption) : null], fields.rek_tujuan.isInvalid],
        ["disetujui", [fields.disetujui.visible && fields.disetujui.required ? ew.Validators.required(fields.disetujui.caption) : null], fields.disetujui.isInvalid],
        ["pembayar", [fields.pembayar.visible && fields.pembayar.required ? ew.Validators.required(fields.pembayar.caption) : null], fields.pembayar.isInvalid],
        ["terbayar", [fields.terbayar.visible && fields.terbayar.required ? ew.Validators.required(fields.terbayar.caption) : null], fields.terbayar.isInvalid],
        ["tgl_pembayaran", [fields.tgl_pembayaran.visible && fields.tgl_pembayaran.required ? ew.Validators.required(fields.tgl_pembayaran.caption) : null, ew.Validators.datetime(fields.tgl_pembayaran.clientFormatPattern)], fields.tgl_pembayaran.isInvalid],
        ["jumlah_dibayar", [fields.jumlah_dibayar.visible && fields.jumlah_dibayar.required ? ew.Validators.required(fields.jumlah_dibayar.caption) : null, ew.Validators.integer], fields.jumlah_dibayar.isInvalid],
        ["bukti1", [fields.bukti1.visible && fields.bukti1.required ? ew.Validators.fileRequired(fields.bukti1.caption) : null], fields.bukti1.isInvalid],
        ["bukti2", [fields.bukti2.visible && fields.bukti2.required ? ew.Validators.fileRequired(fields.bukti2.caption) : null], fields.bukti2.isInvalid],
        ["bukti3", [fields.bukti3.visible && fields.bukti3.required ? ew.Validators.fileRequired(fields.bukti3.caption) : null], fields.bukti3.isInvalid],
        ["bukti4", [fields.bukti4.visible && fields.bukti4.required ? ew.Validators.fileRequired(fields.bukti4.caption) : null], fields.bukti4.isInvalid]
    ]);

    // Form_CustomValidate
    freimburshadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    freimburshadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    freimburshadd.lists.pegawai = <?= $Page->pegawai->toClientList($Page) ?>;
    freimburshadd.lists.disetujui = <?= $Page->disetujui->toClientList($Page) ?>;
    loadjs.done("freimburshadd");
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
<form name="freimburshadd" id="freimburshadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="reimbursh">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <div id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <label id="elh_reimbursh_pegawai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pegawai->caption() ?><?= $Page->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_reimbursh_pegawai">
    <select
        id="x_pegawai"
        name="x_pegawai"
        class="form-control ew-select<?= $Page->pegawai->isInvalidClass() ?>"
        data-select2-id="freimburshadd_x_pegawai"
        data-table="reimbursh"
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
loadjs.ready("freimburshadd", function() {
    var options = { name: "x_pegawai", selectId: "freimburshadd_x_pegawai" };
    if (freimburshadd.lists.pegawai.lookupOptions.length) {
        options.data = { id: "x_pegawai", form: "freimburshadd" };
    } else {
        options.ajax = { id: "x_pegawai", form: "freimburshadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.reimbursh.fields.pegawai.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <label id="elh_reimbursh_nama" for="x_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama->cellAttributes() ?>>
<span id="el_reimbursh_nama">
<input type="<?= $Page->nama->getInputTextType() ?>" name="x_nama" id="x_nama" data-table="reimbursh" data-field="x_nama" value="<?= $Page->nama->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>"<?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
<?= $Page->nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total_pengajuan->Visible) { // total_pengajuan ?>
    <div id="r_total_pengajuan"<?= $Page->total_pengajuan->rowAttributes() ?>>
        <label id="elh_reimbursh_total_pengajuan" for="x_total_pengajuan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->total_pengajuan->caption() ?><?= $Page->total_pengajuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->total_pengajuan->cellAttributes() ?>>
<span id="el_reimbursh_total_pengajuan">
<input type="<?= $Page->total_pengajuan->getInputTextType() ?>" name="x_total_pengajuan" id="x_total_pengajuan" data-table="reimbursh" data-field="x_total_pengajuan" value="<?= $Page->total_pengajuan->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->total_pengajuan->getPlaceHolder()) ?>"<?= $Page->total_pengajuan->editAttributes() ?> aria-describedby="x_total_pengajuan_help">
<?= $Page->total_pengajuan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total_pengajuan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_pengajuan->Visible) { // tgl_pengajuan ?>
    <div id="r_tgl_pengajuan"<?= $Page->tgl_pengajuan->rowAttributes() ?>>
        <label id="elh_reimbursh_tgl_pengajuan" for="x_tgl_pengajuan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_pengajuan->caption() ?><?= $Page->tgl_pengajuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_pengajuan->cellAttributes() ?>>
<span id="el_reimbursh_tgl_pengajuan">
<input type="<?= $Page->tgl_pengajuan->getInputTextType() ?>" name="x_tgl_pengajuan" id="x_tgl_pengajuan" data-table="reimbursh" data-field="x_tgl_pengajuan" value="<?= $Page->tgl_pengajuan->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_pengajuan->getPlaceHolder()) ?>"<?= $Page->tgl_pengajuan->editAttributes() ?> aria-describedby="x_tgl_pengajuan_help">
<?= $Page->tgl_pengajuan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_pengajuan->getErrorMessage() ?></div>
<?php if (!$Page->tgl_pengajuan->ReadOnly && !$Page->tgl_pengajuan->Disabled && !isset($Page->tgl_pengajuan->EditAttrs["readonly"]) && !isset($Page->tgl_pengajuan->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freimburshadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("freimburshadd", "x_tgl_pengajuan", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <div id="r_jenis"<?= $Page->jenis->rowAttributes() ?>>
        <label id="elh_reimbursh_jenis" for="x_jenis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis->caption() ?><?= $Page->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenis->cellAttributes() ?>>
<span id="el_reimbursh_jenis">
<input type="<?= $Page->jenis->getInputTextType() ?>" name="x_jenis" id="x_jenis" data-table="reimbursh" data-field="x_jenis" value="<?= $Page->jenis->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->jenis->getPlaceHolder()) ?>"<?= $Page->jenis->editAttributes() ?> aria-describedby="x_jenis_help">
<?= $Page->jenis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <div id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_reimbursh_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_reimbursh_keterangan">
<textarea data-table="reimbursh" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help"><?= $Page->keterangan->EditValue ?></textarea>
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rek_tujuan->Visible) { // rek_tujuan ?>
    <div id="r_rek_tujuan"<?= $Page->rek_tujuan->rowAttributes() ?>>
        <label id="elh_reimbursh_rek_tujuan" for="x_rek_tujuan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rek_tujuan->caption() ?><?= $Page->rek_tujuan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rek_tujuan->cellAttributes() ?>>
<span id="el_reimbursh_rek_tujuan">
<input type="<?= $Page->rek_tujuan->getInputTextType() ?>" name="x_rek_tujuan" id="x_rek_tujuan" data-table="reimbursh" data-field="x_rek_tujuan" value="<?= $Page->rek_tujuan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->rek_tujuan->getPlaceHolder()) ?>"<?= $Page->rek_tujuan->editAttributes() ?> aria-describedby="x_rek_tujuan_help">
<?= $Page->rek_tujuan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rek_tujuan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
    <div id="r_disetujui"<?= $Page->disetujui->rowAttributes() ?>>
        <label id="elh_reimbursh_disetujui" class="<?= $Page->LeftColumnClass ?>"><?= $Page->disetujui->caption() ?><?= $Page->disetujui->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->disetujui->cellAttributes() ?>>
<span id="el_reimbursh_disetujui">
<template id="tp_x_disetujui">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="reimbursh" data-field="x_disetujui" name="x_disetujui" id="x_disetujui"<?= $Page->disetujui->editAttributes() ?>>
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
    data-table="reimbursh"
    data-field="x_disetujui"
    data-value-separator="<?= $Page->disetujui->displayValueSeparatorAttribute() ?>"
    <?= $Page->disetujui->editAttributes() ?>></selection-list>
<?= $Page->disetujui->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->disetujui->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pembayar->Visible) { // pembayar ?>
    <div id="r_pembayar"<?= $Page->pembayar->rowAttributes() ?>>
        <label id="elh_reimbursh_pembayar" for="x_pembayar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pembayar->caption() ?><?= $Page->pembayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pembayar->cellAttributes() ?>>
<span id="el_reimbursh_pembayar">
<input type="<?= $Page->pembayar->getInputTextType() ?>" name="x_pembayar" id="x_pembayar" data-table="reimbursh" data-field="x_pembayar" value="<?= $Page->pembayar->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->pembayar->getPlaceHolder()) ?>"<?= $Page->pembayar->editAttributes() ?> aria-describedby="x_pembayar_help">
<?= $Page->pembayar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pembayar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->terbayar->Visible) { // terbayar ?>
    <div id="r_terbayar"<?= $Page->terbayar->rowAttributes() ?>>
        <label id="elh_reimbursh_terbayar" for="x_terbayar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->terbayar->caption() ?><?= $Page->terbayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->terbayar->cellAttributes() ?>>
<span id="el_reimbursh_terbayar">
<input type="<?= $Page->terbayar->getInputTextType() ?>" name="x_terbayar" id="x_terbayar" data-table="reimbursh" data-field="x_terbayar" value="<?= $Page->terbayar->EditValue ?>" size="30" maxlength="5" placeholder="<?= HtmlEncode($Page->terbayar->getPlaceHolder()) ?>"<?= $Page->terbayar->editAttributes() ?> aria-describedby="x_terbayar_help">
<?= $Page->terbayar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->terbayar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_pembayaran->Visible) { // tgl_pembayaran ?>
    <div id="r_tgl_pembayaran"<?= $Page->tgl_pembayaran->rowAttributes() ?>>
        <label id="elh_reimbursh_tgl_pembayaran" for="x_tgl_pembayaran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_pembayaran->caption() ?><?= $Page->tgl_pembayaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_pembayaran->cellAttributes() ?>>
<span id="el_reimbursh_tgl_pembayaran">
<input type="<?= $Page->tgl_pembayaran->getInputTextType() ?>" name="x_tgl_pembayaran" id="x_tgl_pembayaran" data-table="reimbursh" data-field="x_tgl_pembayaran" value="<?= $Page->tgl_pembayaran->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_pembayaran->getPlaceHolder()) ?>"<?= $Page->tgl_pembayaran->editAttributes() ?> aria-describedby="x_tgl_pembayaran_help">
<?= $Page->tgl_pembayaran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_pembayaran->getErrorMessage() ?></div>
<?php if (!$Page->tgl_pembayaran->ReadOnly && !$Page->tgl_pembayaran->Disabled && !isset($Page->tgl_pembayaran->EditAttrs["readonly"]) && !isset($Page->tgl_pembayaran->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["freimburshadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("freimburshadd", "x_tgl_pembayaran", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumlah_dibayar->Visible) { // jumlah_dibayar ?>
    <div id="r_jumlah_dibayar"<?= $Page->jumlah_dibayar->rowAttributes() ?>>
        <label id="elh_reimbursh_jumlah_dibayar" for="x_jumlah_dibayar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumlah_dibayar->caption() ?><?= $Page->jumlah_dibayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jumlah_dibayar->cellAttributes() ?>>
<span id="el_reimbursh_jumlah_dibayar">
<input type="<?= $Page->jumlah_dibayar->getInputTextType() ?>" name="x_jumlah_dibayar" id="x_jumlah_dibayar" data-table="reimbursh" data-field="x_jumlah_dibayar" value="<?= $Page->jumlah_dibayar->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jumlah_dibayar->getPlaceHolder()) ?>"<?= $Page->jumlah_dibayar->editAttributes() ?> aria-describedby="x_jumlah_dibayar_help">
<?= $Page->jumlah_dibayar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumlah_dibayar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bukti1->Visible) { // bukti1 ?>
    <div id="r_bukti1"<?= $Page->bukti1->rowAttributes() ?>>
        <label id="elh_reimbursh_bukti1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bukti1->caption() ?><?= $Page->bukti1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bukti1->cellAttributes() ?>>
<span id="el_reimbursh_bukti1">
<div id="fd_x_bukti1" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->bukti1->title() ?>" data-table="reimbursh" data-field="x_bukti1" name="x_bukti1" id="x_bukti1" lang="<?= CurrentLanguageID() ?>"<?= $Page->bukti1->editAttributes() ?> aria-describedby="x_bukti1_help"<?= ($Page->bukti1->ReadOnly || $Page->bukti1->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->bukti1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bukti1->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_bukti1" id= "fn_x_bukti1" value="<?= $Page->bukti1->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti1" id= "fa_x_bukti1" value="0">
<input type="hidden" name="fs_x_bukti1" id= "fs_x_bukti1" value="255">
<input type="hidden" name="fx_x_bukti1" id= "fx_x_bukti1" value="<?= $Page->bukti1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bukti1" id= "fm_x_bukti1" value="<?= $Page->bukti1->UploadMaxFileSize ?>">
<table id="ft_x_bukti1" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bukti2->Visible) { // bukti2 ?>
    <div id="r_bukti2"<?= $Page->bukti2->rowAttributes() ?>>
        <label id="elh_reimbursh_bukti2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bukti2->caption() ?><?= $Page->bukti2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bukti2->cellAttributes() ?>>
<span id="el_reimbursh_bukti2">
<div id="fd_x_bukti2" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->bukti2->title() ?>" data-table="reimbursh" data-field="x_bukti2" name="x_bukti2" id="x_bukti2" lang="<?= CurrentLanguageID() ?>"<?= $Page->bukti2->editAttributes() ?> aria-describedby="x_bukti2_help"<?= ($Page->bukti2->ReadOnly || $Page->bukti2->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->bukti2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bukti2->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_bukti2" id= "fn_x_bukti2" value="<?= $Page->bukti2->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti2" id= "fa_x_bukti2" value="0">
<input type="hidden" name="fs_x_bukti2" id= "fs_x_bukti2" value="255">
<input type="hidden" name="fx_x_bukti2" id= "fx_x_bukti2" value="<?= $Page->bukti2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bukti2" id= "fm_x_bukti2" value="<?= $Page->bukti2->UploadMaxFileSize ?>">
<table id="ft_x_bukti2" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bukti3->Visible) { // bukti3 ?>
    <div id="r_bukti3"<?= $Page->bukti3->rowAttributes() ?>>
        <label id="elh_reimbursh_bukti3" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bukti3->caption() ?><?= $Page->bukti3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bukti3->cellAttributes() ?>>
<span id="el_reimbursh_bukti3">
<div id="fd_x_bukti3" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->bukti3->title() ?>" data-table="reimbursh" data-field="x_bukti3" name="x_bukti3" id="x_bukti3" lang="<?= CurrentLanguageID() ?>"<?= $Page->bukti3->editAttributes() ?> aria-describedby="x_bukti3_help"<?= ($Page->bukti3->ReadOnly || $Page->bukti3->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->bukti3->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bukti3->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_bukti3" id= "fn_x_bukti3" value="<?= $Page->bukti3->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti3" id= "fa_x_bukti3" value="0">
<input type="hidden" name="fs_x_bukti3" id= "fs_x_bukti3" value="255">
<input type="hidden" name="fx_x_bukti3" id= "fx_x_bukti3" value="<?= $Page->bukti3->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bukti3" id= "fm_x_bukti3" value="<?= $Page->bukti3->UploadMaxFileSize ?>">
<table id="ft_x_bukti3" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bukti4->Visible) { // bukti4 ?>
    <div id="r_bukti4"<?= $Page->bukti4->rowAttributes() ?>>
        <label id="elh_reimbursh_bukti4" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bukti4->caption() ?><?= $Page->bukti4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bukti4->cellAttributes() ?>>
<span id="el_reimbursh_bukti4">
<div id="fd_x_bukti4" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->bukti4->title() ?>" data-table="reimbursh" data-field="x_bukti4" name="x_bukti4" id="x_bukti4" lang="<?= CurrentLanguageID() ?>"<?= $Page->bukti4->editAttributes() ?> aria-describedby="x_bukti4_help"<?= ($Page->bukti4->ReadOnly || $Page->bukti4->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->bukti4->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bukti4->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_bukti4" id= "fn_x_bukti4" value="<?= $Page->bukti4->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti4" id= "fa_x_bukti4" value="0">
<input type="hidden" name="fs_x_bukti4" id= "fs_x_bukti4" value="255">
<input type="hidden" name="fx_x_bukti4" id= "fx_x_bukti4" value="<?= $Page->bukti4->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bukti4" id= "fm_x_bukti4" value="<?= $Page->bukti4->UploadMaxFileSize ?>">
<table id="ft_x_bukti4" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
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
    ew.addEventHandlers("reimbursh");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
