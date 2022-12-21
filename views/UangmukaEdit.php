<?php

namespace PHPMaker2022\sigap;

// Page object
$UangmukaEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { uangmuka: currentTable } });
var currentForm, currentPageID;
var fuangmukaedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fuangmukaedit = new ew.Form("fuangmukaedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fuangmukaedit;

    // Add fields
    var fields = currentTable.fields;
    fuangmukaedit.addFields([
        ["tgl", [fields.tgl.visible && fields.tgl.required ? ew.Validators.required(fields.tgl.caption) : null, ew.Validators.datetime(fields.tgl.clientFormatPattern)], fields.tgl.isInvalid],
        ["pembayar", [fields.pembayar.visible && fields.pembayar.required ? ew.Validators.required(fields.pembayar.caption) : null], fields.pembayar.isInvalid],
        ["peruntukan", [fields.peruntukan.visible && fields.peruntukan.required ? ew.Validators.required(fields.peruntukan.caption) : null], fields.peruntukan.isInvalid],
        ["penerima", [fields.penerima.visible && fields.penerima.required ? ew.Validators.required(fields.penerima.caption) : null, ew.Validators.integer], fields.penerima.isInvalid],
        ["rek_penerima", [fields.rek_penerima.visible && fields.rek_penerima.required ? ew.Validators.required(fields.rek_penerima.caption) : null], fields.rek_penerima.isInvalid],
        ["tgl_terima", [fields.tgl_terima.visible && fields.tgl_terima.required ? ew.Validators.required(fields.tgl_terima.caption) : null, ew.Validators.datetime(fields.tgl_terima.clientFormatPattern)], fields.tgl_terima.isInvalid],
        ["total_terima", [fields.total_terima.visible && fields.total_terima.required ? ew.Validators.required(fields.total_terima.caption) : null, ew.Validators.integer], fields.total_terima.isInvalid],
        ["tgl_tgjb", [fields.tgl_tgjb.visible && fields.tgl_tgjb.required ? ew.Validators.required(fields.tgl_tgjb.caption) : null, ew.Validators.datetime(fields.tgl_tgjb.clientFormatPattern)], fields.tgl_tgjb.isInvalid],
        ["jumlah_tgjb", [fields.jumlah_tgjb.visible && fields.jumlah_tgjb.required ? ew.Validators.required(fields.jumlah_tgjb.caption) : null, ew.Validators.integer], fields.jumlah_tgjb.isInvalid],
        ["jenis", [fields.jenis.visible && fields.jenis.required ? ew.Validators.required(fields.jenis.caption) : null], fields.jenis.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
        ["bukti1", [fields.bukti1.visible && fields.bukti1.required ? ew.Validators.fileRequired(fields.bukti1.caption) : null], fields.bukti1.isInvalid],
        ["bukti2", [fields.bukti2.visible && fields.bukti2.required ? ew.Validators.fileRequired(fields.bukti2.caption) : null], fields.bukti2.isInvalid],
        ["bukti3", [fields.bukti3.visible && fields.bukti3.required ? ew.Validators.fileRequired(fields.bukti3.caption) : null], fields.bukti3.isInvalid],
        ["bukti4", [fields.bukti4.visible && fields.bukti4.required ? ew.Validators.fileRequired(fields.bukti4.caption) : null], fields.bukti4.isInvalid],
        ["disetujui", [fields.disetujui.visible && fields.disetujui.required ? ew.Validators.required(fields.disetujui.caption) : null], fields.disetujui.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
    ]);

    // Form_CustomValidate
    fuangmukaedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fuangmukaedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fuangmukaedit.lists.pembayar = <?= $Page->pembayar->toClientList($Page) ?>;
    fuangmukaedit.lists.penerima = <?= $Page->penerima->toClientList($Page) ?>;
    fuangmukaedit.lists.disetujui = <?= $Page->disetujui->toClientList($Page) ?>;
    loadjs.done("fuangmukaedit");
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
<form name="fuangmukaedit" id="fuangmukaedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="uangmuka">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->tgl->Visible) { // tgl ?>
    <div id="r_tgl"<?= $Page->tgl->rowAttributes() ?>>
        <label id="elh_uangmuka_tgl" for="x_tgl" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl->caption() ?><?= $Page->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl->cellAttributes() ?>>
<span id="el_uangmuka_tgl">
<input type="<?= $Page->tgl->getInputTextType() ?>" name="x_tgl" id="x_tgl" data-table="uangmuka" data-field="x_tgl" value="<?= $Page->tgl->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl->getPlaceHolder()) ?>"<?= $Page->tgl->editAttributes() ?> aria-describedby="x_tgl_help">
<?= $Page->tgl->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl->getErrorMessage() ?></div>
<?php if (!$Page->tgl->ReadOnly && !$Page->tgl->Disabled && !isset($Page->tgl->EditAttrs["readonly"]) && !isset($Page->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fuangmukaedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fuangmukaedit", "x_tgl", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pembayar->Visible) { // pembayar ?>
    <div id="r_pembayar"<?= $Page->pembayar->rowAttributes() ?>>
        <label id="elh_uangmuka_pembayar" for="x_pembayar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pembayar->caption() ?><?= $Page->pembayar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pembayar->cellAttributes() ?>>
<span id="el_uangmuka_pembayar">
    <select
        id="x_pembayar"
        name="x_pembayar"
        class="form-control ew-select<?= $Page->pembayar->isInvalidClass() ?>"
        data-select2-id="fuangmukaedit_x_pembayar"
        data-table="uangmuka"
        data-field="x_pembayar"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->pembayar->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->pembayar->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->pembayar->getPlaceHolder()) ?>"
        <?= $Page->pembayar->editAttributes() ?>>
        <?= $Page->pembayar->selectOptionListHtml("x_pembayar") ?>
    </select>
    <?= $Page->pembayar->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->pembayar->getErrorMessage() ?></div>
<?= $Page->pembayar->Lookup->getParamTag($Page, "p_x_pembayar") ?>
<script>
loadjs.ready("fuangmukaedit", function() {
    var options = { name: "x_pembayar", selectId: "fuangmukaedit_x_pembayar" };
    if (fuangmukaedit.lists.pembayar.lookupOptions.length) {
        options.data = { id: "x_pembayar", form: "fuangmukaedit" };
    } else {
        options.ajax = { id: "x_pembayar", form: "fuangmukaedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.uangmuka.fields.pembayar.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->peruntukan->Visible) { // peruntukan ?>
    <div id="r_peruntukan"<?= $Page->peruntukan->rowAttributes() ?>>
        <label id="elh_uangmuka_peruntukan" for="x_peruntukan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->peruntukan->caption() ?><?= $Page->peruntukan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->peruntukan->cellAttributes() ?>>
<span id="el_uangmuka_peruntukan">
<input type="<?= $Page->peruntukan->getInputTextType() ?>" name="x_peruntukan" id="x_peruntukan" data-table="uangmuka" data-field="x_peruntukan" value="<?= $Page->peruntukan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->peruntukan->getPlaceHolder()) ?>"<?= $Page->peruntukan->editAttributes() ?> aria-describedby="x_peruntukan_help">
<?= $Page->peruntukan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->peruntukan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->penerima->Visible) { // penerima ?>
    <div id="r_penerima"<?= $Page->penerima->rowAttributes() ?>>
        <label id="elh_uangmuka_penerima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->penerima->caption() ?><?= $Page->penerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->penerima->cellAttributes() ?>>
<span id="el_uangmuka_penerima">
    <select
        id="x_penerima"
        name="x_penerima"
        class="form-control ew-select<?= $Page->penerima->isInvalidClass() ?>"
        data-select2-id="fuangmukaedit_x_penerima"
        data-table="uangmuka"
        data-field="x_penerima"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->penerima->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->penerima->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->penerima->getPlaceHolder()) ?>"
        <?= $Page->penerima->editAttributes() ?>>
        <?= $Page->penerima->selectOptionListHtml("x_penerima") ?>
    </select>
    <?= $Page->penerima->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->penerima->getErrorMessage() ?></div>
<?= $Page->penerima->Lookup->getParamTag($Page, "p_x_penerima") ?>
<script>
loadjs.ready("fuangmukaedit", function() {
    var options = { name: "x_penerima", selectId: "fuangmukaedit_x_penerima" };
    if (fuangmukaedit.lists.penerima.lookupOptions.length) {
        options.data = { id: "x_penerima", form: "fuangmukaedit" };
    } else {
        options.ajax = { id: "x_penerima", form: "fuangmukaedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.uangmuka.fields.penerima.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rek_penerima->Visible) { // rek_penerima ?>
    <div id="r_rek_penerima"<?= $Page->rek_penerima->rowAttributes() ?>>
        <label id="elh_uangmuka_rek_penerima" for="x_rek_penerima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rek_penerima->caption() ?><?= $Page->rek_penerima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rek_penerima->cellAttributes() ?>>
<span id="el_uangmuka_rek_penerima">
<input type="<?= $Page->rek_penerima->getInputTextType() ?>" name="x_rek_penerima" id="x_rek_penerima" data-table="uangmuka" data-field="x_rek_penerima" value="<?= $Page->rek_penerima->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->rek_penerima->getPlaceHolder()) ?>"<?= $Page->rek_penerima->editAttributes() ?> aria-describedby="x_rek_penerima_help">
<?= $Page->rek_penerima->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rek_penerima->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_terima->Visible) { // tgl_terima ?>
    <div id="r_tgl_terima"<?= $Page->tgl_terima->rowAttributes() ?>>
        <label id="elh_uangmuka_tgl_terima" for="x_tgl_terima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_terima->caption() ?><?= $Page->tgl_terima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_terima->cellAttributes() ?>>
<span id="el_uangmuka_tgl_terima">
<input type="<?= $Page->tgl_terima->getInputTextType() ?>" name="x_tgl_terima" id="x_tgl_terima" data-table="uangmuka" data-field="x_tgl_terima" value="<?= $Page->tgl_terima->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_terima->getPlaceHolder()) ?>"<?= $Page->tgl_terima->editAttributes() ?> aria-describedby="x_tgl_terima_help">
<?= $Page->tgl_terima->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_terima->getErrorMessage() ?></div>
<?php if (!$Page->tgl_terima->ReadOnly && !$Page->tgl_terima->Disabled && !isset($Page->tgl_terima->EditAttrs["readonly"]) && !isset($Page->tgl_terima->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fuangmukaedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fuangmukaedit", "x_tgl_terima", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total_terima->Visible) { // total_terima ?>
    <div id="r_total_terima"<?= $Page->total_terima->rowAttributes() ?>>
        <label id="elh_uangmuka_total_terima" for="x_total_terima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->total_terima->caption() ?><?= $Page->total_terima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->total_terima->cellAttributes() ?>>
<span id="el_uangmuka_total_terima">
<input type="<?= $Page->total_terima->getInputTextType() ?>" name="x_total_terima" id="x_total_terima" data-table="uangmuka" data-field="x_total_terima" value="<?= $Page->total_terima->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->total_terima->getPlaceHolder()) ?>"<?= $Page->total_terima->editAttributes() ?> aria-describedby="x_total_terima_help">
<?= $Page->total_terima->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total_terima->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_tgjb->Visible) { // tgl_tgjb ?>
    <div id="r_tgl_tgjb"<?= $Page->tgl_tgjb->rowAttributes() ?>>
        <label id="elh_uangmuka_tgl_tgjb" for="x_tgl_tgjb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_tgjb->caption() ?><?= $Page->tgl_tgjb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_tgjb->cellAttributes() ?>>
<span id="el_uangmuka_tgl_tgjb">
<input type="<?= $Page->tgl_tgjb->getInputTextType() ?>" name="x_tgl_tgjb" id="x_tgl_tgjb" data-table="uangmuka" data-field="x_tgl_tgjb" value="<?= $Page->tgl_tgjb->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_tgjb->getPlaceHolder()) ?>"<?= $Page->tgl_tgjb->editAttributes() ?> aria-describedby="x_tgl_tgjb_help">
<?= $Page->tgl_tgjb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_tgjb->getErrorMessage() ?></div>
<?php if (!$Page->tgl_tgjb->ReadOnly && !$Page->tgl_tgjb->Disabled && !isset($Page->tgl_tgjb->EditAttrs["readonly"]) && !isset($Page->tgl_tgjb->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fuangmukaedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fuangmukaedit", "x_tgl_tgjb", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumlah_tgjb->Visible) { // jumlah_tgjb ?>
    <div id="r_jumlah_tgjb"<?= $Page->jumlah_tgjb->rowAttributes() ?>>
        <label id="elh_uangmuka_jumlah_tgjb" for="x_jumlah_tgjb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumlah_tgjb->caption() ?><?= $Page->jumlah_tgjb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jumlah_tgjb->cellAttributes() ?>>
<span id="el_uangmuka_jumlah_tgjb">
<input type="<?= $Page->jumlah_tgjb->getInputTextType() ?>" name="x_jumlah_tgjb" id="x_jumlah_tgjb" data-table="uangmuka" data-field="x_jumlah_tgjb" value="<?= $Page->jumlah_tgjb->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jumlah_tgjb->getPlaceHolder()) ?>"<?= $Page->jumlah_tgjb->editAttributes() ?> aria-describedby="x_jumlah_tgjb_help">
<?= $Page->jumlah_tgjb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumlah_tgjb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <div id="r_jenis"<?= $Page->jenis->rowAttributes() ?>>
        <label id="elh_uangmuka_jenis" for="x_jenis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis->caption() ?><?= $Page->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenis->cellAttributes() ?>>
<span id="el_uangmuka_jenis">
<input type="<?= $Page->jenis->getInputTextType() ?>" name="x_jenis" id="x_jenis" data-table="uangmuka" data-field="x_jenis" value="<?= $Page->jenis->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->jenis->getPlaceHolder()) ?>"<?= $Page->jenis->editAttributes() ?> aria-describedby="x_jenis_help">
<?= $Page->jenis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <div id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_uangmuka_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_uangmuka_keterangan">
<textarea data-table="uangmuka" data-field="x_keterangan" name="x_keterangan" id="x_keterangan" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help"><?= $Page->keterangan->EditValue ?></textarea>
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bukti1->Visible) { // bukti1 ?>
    <div id="r_bukti1"<?= $Page->bukti1->rowAttributes() ?>>
        <label id="elh_uangmuka_bukti1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bukti1->caption() ?><?= $Page->bukti1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bukti1->cellAttributes() ?>>
<span id="el_uangmuka_bukti1">
<div id="fd_x_bukti1" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->bukti1->title() ?>" data-table="uangmuka" data-field="x_bukti1" name="x_bukti1" id="x_bukti1" lang="<?= CurrentLanguageID() ?>"<?= $Page->bukti1->editAttributes() ?> aria-describedby="x_bukti1_help"<?= ($Page->bukti1->ReadOnly || $Page->bukti1->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->bukti1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bukti1->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_bukti1" id= "fn_x_bukti1" value="<?= $Page->bukti1->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti1" id= "fa_x_bukti1" value="<?= (Post("fa_x_bukti1") == "0") ? "0" : "1" ?>">
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
        <label id="elh_uangmuka_bukti2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bukti2->caption() ?><?= $Page->bukti2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bukti2->cellAttributes() ?>>
<span id="el_uangmuka_bukti2">
<div id="fd_x_bukti2" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->bukti2->title() ?>" data-table="uangmuka" data-field="x_bukti2" name="x_bukti2" id="x_bukti2" lang="<?= CurrentLanguageID() ?>"<?= $Page->bukti2->editAttributes() ?> aria-describedby="x_bukti2_help"<?= ($Page->bukti2->ReadOnly || $Page->bukti2->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->bukti2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bukti2->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_bukti2" id= "fn_x_bukti2" value="<?= $Page->bukti2->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti2" id= "fa_x_bukti2" value="<?= (Post("fa_x_bukti2") == "0") ? "0" : "1" ?>">
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
        <label id="elh_uangmuka_bukti3" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bukti3->caption() ?><?= $Page->bukti3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bukti3->cellAttributes() ?>>
<span id="el_uangmuka_bukti3">
<div id="fd_x_bukti3" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->bukti3->title() ?>" data-table="uangmuka" data-field="x_bukti3" name="x_bukti3" id="x_bukti3" lang="<?= CurrentLanguageID() ?>"<?= $Page->bukti3->editAttributes() ?> aria-describedby="x_bukti3_help"<?= ($Page->bukti3->ReadOnly || $Page->bukti3->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->bukti3->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bukti3->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_bukti3" id= "fn_x_bukti3" value="<?= $Page->bukti3->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti3" id= "fa_x_bukti3" value="<?= (Post("fa_x_bukti3") == "0") ? "0" : "1" ?>">
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
        <label id="elh_uangmuka_bukti4" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bukti4->caption() ?><?= $Page->bukti4->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bukti4->cellAttributes() ?>>
<span id="el_uangmuka_bukti4">
<div id="fd_x_bukti4" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->bukti4->title() ?>" data-table="uangmuka" data-field="x_bukti4" name="x_bukti4" id="x_bukti4" lang="<?= CurrentLanguageID() ?>"<?= $Page->bukti4->editAttributes() ?> aria-describedby="x_bukti4_help"<?= ($Page->bukti4->ReadOnly || $Page->bukti4->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->bukti4->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bukti4->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_bukti4" id= "fn_x_bukti4" value="<?= $Page->bukti4->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti4" id= "fa_x_bukti4" value="<?= (Post("fa_x_bukti4") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_bukti4" id= "fs_x_bukti4" value="255">
<input type="hidden" name="fx_x_bukti4" id= "fx_x_bukti4" value="<?= $Page->bukti4->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bukti4" id= "fm_x_bukti4" value="<?= $Page->bukti4->UploadMaxFileSize ?>">
<table id="ft_x_bukti4" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->disetujui->Visible) { // disetujui ?>
    <div id="r_disetujui"<?= $Page->disetujui->rowAttributes() ?>>
        <label id="elh_uangmuka_disetujui" class="<?= $Page->LeftColumnClass ?>"><?= $Page->disetujui->caption() ?><?= $Page->disetujui->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->disetujui->cellAttributes() ?>>
<span id="el_uangmuka_disetujui">
<template id="tp_x_disetujui">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="uangmuka" data-field="x_disetujui" name="x_disetujui" id="x_disetujui"<?= $Page->disetujui->editAttributes() ?>>
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
    data-table="uangmuka"
    data-field="x_disetujui"
    data-value-separator="<?= $Page->disetujui->displayValueSeparatorAttribute() ?>"
    <?= $Page->disetujui->editAttributes() ?>></selection-list>
<?= $Page->disetujui->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->disetujui->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_uangmuka_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_uangmuka_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="uangmuka" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="uangmuka" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("uangmuka");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
