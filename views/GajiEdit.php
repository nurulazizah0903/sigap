<?php

namespace PHPMaker2022\sigap;

// Page object
$GajiEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gaji: currentTable } });
var currentForm, currentPageID;
var fgajiedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajiedit = new ew.Form("fgajiedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fgajiedit;

    // Add fields
    var fields = currentTable.fields;
    fgajiedit.addFields([
        ["jabatan_id", [fields.jabatan_id.visible && fields.jabatan_id.required ? ew.Validators.required(fields.jabatan_id.caption) : null, ew.Validators.integer], fields.jabatan_id.isInvalid],
        ["pegawai", [fields.pegawai.visible && fields.pegawai.required ? ew.Validators.required(fields.pegawai.caption) : null], fields.pegawai.isInvalid],
        ["lembur", [fields.lembur.visible && fields.lembur.required ? ew.Validators.required(fields.lembur.caption) : null, ew.Validators.integer], fields.lembur.isInvalid],
        ["value_lembur", [fields.value_lembur.visible && fields.value_lembur.required ? ew.Validators.required(fields.value_lembur.caption) : null, ew.Validators.integer], fields.value_lembur.isInvalid],
        ["kehadiran", [fields.kehadiran.visible && fields.kehadiran.required ? ew.Validators.required(fields.kehadiran.caption) : null, ew.Validators.integer], fields.kehadiran.isInvalid],
        ["gapok", [fields.gapok.visible && fields.gapok.required ? ew.Validators.required(fields.gapok.caption) : null, ew.Validators.integer], fields.gapok.isInvalid],
        ["value_reward", [fields.value_reward.visible && fields.value_reward.required ? ew.Validators.required(fields.value_reward.caption) : null, ew.Validators.integer], fields.value_reward.isInvalid],
        ["value_inval", [fields.value_inval.visible && fields.value_inval.required ? ew.Validators.required(fields.value_inval.caption) : null, ew.Validators.integer], fields.value_inval.isInvalid],
        ["piket_count", [fields.piket_count.visible && fields.piket_count.required ? ew.Validators.required(fields.piket_count.caption) : null, ew.Validators.integer], fields.piket_count.isInvalid],
        ["value_piket", [fields.value_piket.visible && fields.value_piket.required ? ew.Validators.required(fields.value_piket.caption) : null, ew.Validators.integer], fields.value_piket.isInvalid],
        ["tugastambahan", [fields.tugastambahan.visible && fields.tugastambahan.required ? ew.Validators.required(fields.tugastambahan.caption) : null, ew.Validators.integer], fields.tugastambahan.isInvalid],
        ["tj_jabatan", [fields.tj_jabatan.visible && fields.tj_jabatan.required ? ew.Validators.required(fields.tj_jabatan.caption) : null, ew.Validators.integer], fields.tj_jabatan.isInvalid],
        ["sub_total", [fields.sub_total.visible && fields.sub_total.required ? ew.Validators.required(fields.sub_total.caption) : null, ew.Validators.integer], fields.sub_total.isInvalid],
        ["potongan", [fields.potongan.visible && fields.potongan.required ? ew.Validators.required(fields.potongan.caption) : null, ew.Validators.integer], fields.potongan.isInvalid],
        ["total", [fields.total.visible && fields.total.required ? ew.Validators.required(fields.total.caption) : null, ew.Validators.integer], fields.total.isInvalid],
        ["month", [fields.month.visible && fields.month.required ? ew.Validators.required(fields.month.caption) : null], fields.month.isInvalid],
        ["datetime", [fields.datetime.visible && fields.datetime.required ? ew.Validators.required(fields.datetime.caption) : null], fields.datetime.isInvalid]
    ]);

    // Form_CustomValidate
    fgajiedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgajiedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fgajiedit.lists.jabatan_id = <?= $Page->jabatan_id->toClientList($Page) ?>;
    fgajiedit.lists.pegawai = <?= $Page->pegawai->toClientList($Page) ?>;
    loadjs.done("fgajiedit");
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
<form name="fgajiedit" id="fgajiedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gaji">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
    <div id="r_jabatan_id"<?= $Page->jabatan_id->rowAttributes() ?>>
        <label id="elh_gaji_jabatan_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jabatan_id->caption() ?><?= $Page->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el_gaji_jabatan_id">
    <select
        id="x_jabatan_id"
        name="x_jabatan_id"
        class="form-control ew-select<?= $Page->jabatan_id->isInvalidClass() ?>"
        data-select2-id="fgajiedit_x_jabatan_id"
        data-table="gaji"
        data-field="x_jabatan_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->jabatan_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->jabatan_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->jabatan_id->getPlaceHolder()) ?>"
        <?= $Page->jabatan_id->editAttributes() ?>>
        <?= $Page->jabatan_id->selectOptionListHtml("x_jabatan_id") ?>
    </select>
    <?= $Page->jabatan_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->jabatan_id->getErrorMessage() ?></div>
<?= $Page->jabatan_id->Lookup->getParamTag($Page, "p_x_jabatan_id") ?>
<script>
loadjs.ready("fgajiedit", function() {
    var options = { name: "x_jabatan_id", selectId: "fgajiedit_x_jabatan_id" };
    if (fgajiedit.lists.jabatan_id.lookupOptions.length) {
        options.data = { id: "x_jabatan_id", form: "fgajiedit" };
    } else {
        options.ajax = { id: "x_jabatan_id", form: "fgajiedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.gaji.fields.jabatan_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <div id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <label id="elh_gaji_pegawai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pegawai->caption() ?><?= $Page->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_gaji_pegawai">
    <select
        id="x_pegawai"
        name="x_pegawai"
        class="form-control ew-select<?= $Page->pegawai->isInvalidClass() ?>"
        data-select2-id="fgajiedit_x_pegawai"
        data-table="gaji"
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
loadjs.ready("fgajiedit", function() {
    var options = { name: "x_pegawai", selectId: "fgajiedit_x_pegawai" };
    if (fgajiedit.lists.pegawai.lookupOptions.length) {
        options.data = { id: "x_pegawai", form: "fgajiedit" };
    } else {
        options.ajax = { id: "x_pegawai", form: "fgajiedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.gaji.fields.pegawai.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lembur->Visible) { // lembur ?>
    <div id="r_lembur"<?= $Page->lembur->rowAttributes() ?>>
        <label id="elh_gaji_lembur" for="x_lembur" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lembur->caption() ?><?= $Page->lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lembur->cellAttributes() ?>>
<span id="el_gaji_lembur">
<input type="<?= $Page->lembur->getInputTextType() ?>" name="x_lembur" id="x_lembur" data-table="gaji" data-field="x_lembur" value="<?= $Page->lembur->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->lembur->getPlaceHolder()) ?>"<?= $Page->lembur->editAttributes() ?> aria-describedby="x_lembur_help">
<?= $Page->lembur->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lembur->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->value_lembur->Visible) { // value_lembur ?>
    <div id="r_value_lembur"<?= $Page->value_lembur->rowAttributes() ?>>
        <label id="elh_gaji_value_lembur" for="x_value_lembur" class="<?= $Page->LeftColumnClass ?>"><?= $Page->value_lembur->caption() ?><?= $Page->value_lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->value_lembur->cellAttributes() ?>>
<span id="el_gaji_value_lembur">
<input type="<?= $Page->value_lembur->getInputTextType() ?>" name="x_value_lembur" id="x_value_lembur" data-table="gaji" data-field="x_value_lembur" value="<?= $Page->value_lembur->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->value_lembur->getPlaceHolder()) ?>"<?= $Page->value_lembur->editAttributes() ?> aria-describedby="x_value_lembur_help">
<?= $Page->value_lembur->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->value_lembur->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kehadiran->Visible) { // kehadiran ?>
    <div id="r_kehadiran"<?= $Page->kehadiran->rowAttributes() ?>>
        <label id="elh_gaji_kehadiran" for="x_kehadiran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kehadiran->caption() ?><?= $Page->kehadiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->kehadiran->cellAttributes() ?>>
<span id="el_gaji_kehadiran">
<input type="<?= $Page->kehadiran->getInputTextType() ?>" name="x_kehadiran" id="x_kehadiran" data-table="gaji" data-field="x_kehadiran" value="<?= $Page->kehadiran->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->kehadiran->getPlaceHolder()) ?>"<?= $Page->kehadiran->editAttributes() ?> aria-describedby="x_kehadiran_help">
<?= $Page->kehadiran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kehadiran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gapok->Visible) { // gapok ?>
    <div id="r_gapok"<?= $Page->gapok->rowAttributes() ?>>
        <label id="elh_gaji_gapok" for="x_gapok" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gapok->caption() ?><?= $Page->gapok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gapok->cellAttributes() ?>>
<span id="el_gaji_gapok">
<input type="<?= $Page->gapok->getInputTextType() ?>" name="x_gapok" id="x_gapok" data-table="gaji" data-field="x_gapok" value="<?= $Page->gapok->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->gapok->getPlaceHolder()) ?>"<?= $Page->gapok->editAttributes() ?> aria-describedby="x_gapok_help">
<?= $Page->gapok->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gapok->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->value_reward->Visible) { // value_reward ?>
    <div id="r_value_reward"<?= $Page->value_reward->rowAttributes() ?>>
        <label id="elh_gaji_value_reward" for="x_value_reward" class="<?= $Page->LeftColumnClass ?>"><?= $Page->value_reward->caption() ?><?= $Page->value_reward->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->value_reward->cellAttributes() ?>>
<span id="el_gaji_value_reward">
<input type="<?= $Page->value_reward->getInputTextType() ?>" name="x_value_reward" id="x_value_reward" data-table="gaji" data-field="x_value_reward" value="<?= $Page->value_reward->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->value_reward->getPlaceHolder()) ?>"<?= $Page->value_reward->editAttributes() ?> aria-describedby="x_value_reward_help">
<?= $Page->value_reward->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->value_reward->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->value_inval->Visible) { // value_inval ?>
    <div id="r_value_inval"<?= $Page->value_inval->rowAttributes() ?>>
        <label id="elh_gaji_value_inval" for="x_value_inval" class="<?= $Page->LeftColumnClass ?>"><?= $Page->value_inval->caption() ?><?= $Page->value_inval->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->value_inval->cellAttributes() ?>>
<span id="el_gaji_value_inval">
<input type="<?= $Page->value_inval->getInputTextType() ?>" name="x_value_inval" id="x_value_inval" data-table="gaji" data-field="x_value_inval" value="<?= $Page->value_inval->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->value_inval->getPlaceHolder()) ?>"<?= $Page->value_inval->editAttributes() ?> aria-describedby="x_value_inval_help">
<?= $Page->value_inval->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->value_inval->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->piket_count->Visible) { // piket_count ?>
    <div id="r_piket_count"<?= $Page->piket_count->rowAttributes() ?>>
        <label id="elh_gaji_piket_count" for="x_piket_count" class="<?= $Page->LeftColumnClass ?>"><?= $Page->piket_count->caption() ?><?= $Page->piket_count->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->piket_count->cellAttributes() ?>>
<span id="el_gaji_piket_count">
<input type="<?= $Page->piket_count->getInputTextType() ?>" name="x_piket_count" id="x_piket_count" data-table="gaji" data-field="x_piket_count" value="<?= $Page->piket_count->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->piket_count->getPlaceHolder()) ?>"<?= $Page->piket_count->editAttributes() ?> aria-describedby="x_piket_count_help">
<?= $Page->piket_count->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->piket_count->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->value_piket->Visible) { // value_piket ?>
    <div id="r_value_piket"<?= $Page->value_piket->rowAttributes() ?>>
        <label id="elh_gaji_value_piket" for="x_value_piket" class="<?= $Page->LeftColumnClass ?>"><?= $Page->value_piket->caption() ?><?= $Page->value_piket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->value_piket->cellAttributes() ?>>
<span id="el_gaji_value_piket">
<input type="<?= $Page->value_piket->getInputTextType() ?>" name="x_value_piket" id="x_value_piket" data-table="gaji" data-field="x_value_piket" value="<?= $Page->value_piket->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->value_piket->getPlaceHolder()) ?>"<?= $Page->value_piket->editAttributes() ?> aria-describedby="x_value_piket_help">
<?= $Page->value_piket->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->value_piket->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tugastambahan->Visible) { // tugastambahan ?>
    <div id="r_tugastambahan"<?= $Page->tugastambahan->rowAttributes() ?>>
        <label id="elh_gaji_tugastambahan" for="x_tugastambahan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tugastambahan->caption() ?><?= $Page->tugastambahan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tugastambahan->cellAttributes() ?>>
<span id="el_gaji_tugastambahan">
<input type="<?= $Page->tugastambahan->getInputTextType() ?>" name="x_tugastambahan" id="x_tugastambahan" data-table="gaji" data-field="x_tugastambahan" value="<?= $Page->tugastambahan->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tugastambahan->getPlaceHolder()) ?>"<?= $Page->tugastambahan->editAttributes() ?> aria-describedby="x_tugastambahan_help">
<?= $Page->tugastambahan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tugastambahan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tj_jabatan->Visible) { // tj_jabatan ?>
    <div id="r_tj_jabatan"<?= $Page->tj_jabatan->rowAttributes() ?>>
        <label id="elh_gaji_tj_jabatan" for="x_tj_jabatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tj_jabatan->caption() ?><?= $Page->tj_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tj_jabatan->cellAttributes() ?>>
<span id="el_gaji_tj_jabatan">
<input type="<?= $Page->tj_jabatan->getInputTextType() ?>" name="x_tj_jabatan" id="x_tj_jabatan" data-table="gaji" data-field="x_tj_jabatan" value="<?= $Page->tj_jabatan->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tj_jabatan->getPlaceHolder()) ?>"<?= $Page->tj_jabatan->editAttributes() ?> aria-describedby="x_tj_jabatan_help">
<?= $Page->tj_jabatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tj_jabatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sub_total->Visible) { // sub_total ?>
    <div id="r_sub_total"<?= $Page->sub_total->rowAttributes() ?>>
        <label id="elh_gaji_sub_total" for="x_sub_total" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sub_total->caption() ?><?= $Page->sub_total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sub_total->cellAttributes() ?>>
<span id="el_gaji_sub_total">
<input type="<?= $Page->sub_total->getInputTextType() ?>" name="x_sub_total" id="x_sub_total" data-table="gaji" data-field="x_sub_total" value="<?= $Page->sub_total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->sub_total->getPlaceHolder()) ?>"<?= $Page->sub_total->editAttributes() ?> aria-describedby="x_sub_total_help">
<?= $Page->sub_total->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sub_total->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->potongan->Visible) { // potongan ?>
    <div id="r_potongan"<?= $Page->potongan->rowAttributes() ?>>
        <label id="elh_gaji_potongan" for="x_potongan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->potongan->caption() ?><?= $Page->potongan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->potongan->cellAttributes() ?>>
<span id="el_gaji_potongan">
<input type="<?= $Page->potongan->getInputTextType() ?>" name="x_potongan" id="x_potongan" data-table="gaji" data-field="x_potongan" value="<?= $Page->potongan->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->potongan->getPlaceHolder()) ?>"<?= $Page->potongan->editAttributes() ?> aria-describedby="x_potongan_help">
<?= $Page->potongan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->potongan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
    <div id="r_total"<?= $Page->total->rowAttributes() ?>>
        <label id="elh_gaji_total" for="x_total" class="<?= $Page->LeftColumnClass ?>"><?= $Page->total->caption() ?><?= $Page->total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->total->cellAttributes() ?>>
<span id="el_gaji_total">
<input type="<?= $Page->total->getInputTextType() ?>" name="x_total" id="x_total" data-table="gaji" data-field="x_total" value="<?= $Page->total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->total->getPlaceHolder()) ?>"<?= $Page->total->editAttributes() ?> aria-describedby="x_total_help">
<?= $Page->total->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->month->Visible) { // month ?>
    <div id="r_month"<?= $Page->month->rowAttributes() ?>>
        <label id="elh_gaji_month" for="x_month" class="<?= $Page->LeftColumnClass ?>"><?= $Page->month->caption() ?><?= $Page->month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->month->cellAttributes() ?>>
<span id="el_gaji_month">
<input type="<?= $Page->month->getInputTextType() ?>" name="x_month" id="x_month" data-table="gaji" data-field="x_month" value="<?= $Page->month->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->month->getPlaceHolder()) ?>"<?= $Page->month->editAttributes() ?> aria-describedby="x_month_help">
<?= $Page->month->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->month->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="gaji" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("gaji");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
