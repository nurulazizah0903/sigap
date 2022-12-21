<?php

namespace PHPMaker2022\sigap;

// Page object
$PotonganAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { potongan: currentTable } });
var currentForm, currentPageID;
var fpotonganadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpotonganadd = new ew.Form("fpotonganadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fpotonganadd;

    // Add fields
    var fields = currentTable.fields;
    fpotonganadd.addFields([
        ["month", [fields.month.visible && fields.month.required ? ew.Validators.required(fields.month.caption) : null], fields.month.isInvalid],
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["jenjang_id", [fields.jenjang_id.visible && fields.jenjang_id.required ? ew.Validators.required(fields.jenjang_id.caption) : null, ew.Validators.integer], fields.jenjang_id.isInvalid],
        ["jabatan_id", [fields.jabatan_id.visible && fields.jabatan_id.required ? ew.Validators.required(fields.jabatan_id.caption) : null, ew.Validators.integer], fields.jabatan_id.isInvalid],
        ["terlambat", [fields.terlambat.visible && fields.terlambat.required ? ew.Validators.required(fields.terlambat.caption) : null, ew.Validators.integer], fields.terlambat.isInvalid],
        ["izin", [fields.izin.visible && fields.izin.required ? ew.Validators.required(fields.izin.caption) : null, ew.Validators.integer], fields.izin.isInvalid],
        ["izinperjam", [fields.izinperjam.visible && fields.izinperjam.required ? ew.Validators.required(fields.izinperjam.caption) : null, ew.Validators.integer], fields.izinperjam.isInvalid],
        ["izinperjamvalue", [fields.izinperjamvalue.visible && fields.izinperjamvalue.required ? ew.Validators.required(fields.izinperjamvalue.caption) : null, ew.Validators.integer], fields.izinperjamvalue.isInvalid],
        ["sakit", [fields.sakit.visible && fields.sakit.required ? ew.Validators.required(fields.sakit.caption) : null, ew.Validators.integer], fields.sakit.isInvalid],
        ["sakitperjam", [fields.sakitperjam.visible && fields.sakitperjam.required ? ew.Validators.required(fields.sakitperjam.caption) : null, ew.Validators.integer], fields.sakitperjam.isInvalid],
        ["sakitperjamvalue", [fields.sakitperjamvalue.visible && fields.sakitperjamvalue.required ? ew.Validators.required(fields.sakitperjamvalue.caption) : null, ew.Validators.integer], fields.sakitperjamvalue.isInvalid],
        ["pulcep", [fields.pulcep.visible && fields.pulcep.required ? ew.Validators.required(fields.pulcep.caption) : null, ew.Validators.integer], fields.pulcep.isInvalid],
        ["tidakhadir", [fields.tidakhadir.visible && fields.tidakhadir.required ? ew.Validators.required(fields.tidakhadir.caption) : null, ew.Validators.integer], fields.tidakhadir.isInvalid],
        ["tidakhadirjam", [fields.tidakhadirjam.visible && fields.tidakhadirjam.required ? ew.Validators.required(fields.tidakhadirjam.caption) : null, ew.Validators.integer], fields.tidakhadirjam.isInvalid],
        ["u_by", [fields.u_by.visible && fields.u_by.required ? ew.Validators.required(fields.u_by.caption) : null], fields.u_by.isInvalid],
        ["datetime", [fields.datetime.visible && fields.datetime.required ? ew.Validators.required(fields.datetime.caption) : null], fields.datetime.isInvalid]
    ]);

    // Form_CustomValidate
    fpotonganadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpotonganadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpotonganadd.lists.nama = <?= $Page->nama->toClientList($Page) ?>;
    fpotonganadd.lists.jenjang_id = <?= $Page->jenjang_id->toClientList($Page) ?>;
    fpotonganadd.lists.jabatan_id = <?= $Page->jabatan_id->toClientList($Page) ?>;
    fpotonganadd.lists.u_by = <?= $Page->u_by->toClientList($Page) ?>;
    loadjs.done("fpotonganadd");
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
<form name="fpotonganadd" id="fpotonganadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="potongan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->month->Visible) { // month ?>
    <div id="r_month"<?= $Page->month->rowAttributes() ?>>
        <label id="elh_potongan_month" for="x_month" class="<?= $Page->LeftColumnClass ?>"><?= $Page->month->caption() ?><?= $Page->month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->month->cellAttributes() ?>>
<span id="el_potongan_month">
<input type="<?= $Page->month->getInputTextType() ?>" name="x_month" id="x_month" data-table="potongan" data-field="x_month" value="<?= $Page->month->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->month->getPlaceHolder()) ?>"<?= $Page->month->editAttributes() ?> aria-describedby="x_month_help">
<?= $Page->month->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->month->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <label id="elh_potongan_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama->cellAttributes() ?>>
<span id="el_potongan_nama">
<?php $Page->nama->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
    <select
        id="x_nama"
        name="x_nama"
        class="form-control ew-select<?= $Page->nama->isInvalidClass() ?>"
        data-select2-id="fpotonganadd_x_nama"
        data-table="potongan"
        data-field="x_nama"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->nama->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->nama->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>"
        <?= $Page->nama->editAttributes() ?>>
        <?= $Page->nama->selectOptionListHtml("x_nama") ?>
    </select>
    <?= $Page->nama->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
<?= $Page->nama->Lookup->getParamTag($Page, "p_x_nama") ?>
<script>
loadjs.ready("fpotonganadd", function() {
    var options = { name: "x_nama", selectId: "fpotonganadd_x_nama" };
    if (fpotonganadd.lists.nama.lookupOptions.length) {
        options.data = { id: "x_nama", form: "fpotonganadd" };
    } else {
        options.ajax = { id: "x_nama", form: "fpotonganadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.potongan.fields.nama.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
    <div id="r_jenjang_id"<?= $Page->jenjang_id->rowAttributes() ?>>
        <label id="elh_potongan_jenjang_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenjang_id->caption() ?><?= $Page->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el_potongan_jenjang_id">
    <select
        id="x_jenjang_id"
        name="x_jenjang_id"
        class="form-control ew-select<?= $Page->jenjang_id->isInvalidClass() ?>"
        data-select2-id="fpotonganadd_x_jenjang_id"
        data-table="potongan"
        data-field="x_jenjang_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->jenjang_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->jenjang_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->jenjang_id->getPlaceHolder()) ?>"
        <?= $Page->jenjang_id->editAttributes() ?>>
        <?= $Page->jenjang_id->selectOptionListHtml("x_jenjang_id") ?>
    </select>
    <?= $Page->jenjang_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->jenjang_id->getErrorMessage() ?></div>
<?= $Page->jenjang_id->Lookup->getParamTag($Page, "p_x_jenjang_id") ?>
<script>
loadjs.ready("fpotonganadd", function() {
    var options = { name: "x_jenjang_id", selectId: "fpotonganadd_x_jenjang_id" };
    if (fpotonganadd.lists.jenjang_id.lookupOptions.length) {
        options.data = { id: "x_jenjang_id", form: "fpotonganadd" };
    } else {
        options.ajax = { id: "x_jenjang_id", form: "fpotonganadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.potongan.fields.jenjang_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
    <div id="r_jabatan_id"<?= $Page->jabatan_id->rowAttributes() ?>>
        <label id="elh_potongan_jabatan_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jabatan_id->caption() ?><?= $Page->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el_potongan_jabatan_id">
    <select
        id="x_jabatan_id"
        name="x_jabatan_id"
        class="form-control ew-select<?= $Page->jabatan_id->isInvalidClass() ?>"
        data-select2-id="fpotonganadd_x_jabatan_id"
        data-table="potongan"
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
loadjs.ready("fpotonganadd", function() {
    var options = { name: "x_jabatan_id", selectId: "fpotonganadd_x_jabatan_id" };
    if (fpotonganadd.lists.jabatan_id.lookupOptions.length) {
        options.data = { id: "x_jabatan_id", form: "fpotonganadd" };
    } else {
        options.ajax = { id: "x_jabatan_id", form: "fpotonganadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.potongan.fields.jabatan_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->terlambat->Visible) { // terlambat ?>
    <div id="r_terlambat"<?= $Page->terlambat->rowAttributes() ?>>
        <label id="elh_potongan_terlambat" for="x_terlambat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->terlambat->caption() ?><?= $Page->terlambat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->terlambat->cellAttributes() ?>>
<span id="el_potongan_terlambat">
<input type="<?= $Page->terlambat->getInputTextType() ?>" name="x_terlambat" id="x_terlambat" data-table="potongan" data-field="x_terlambat" value="<?= $Page->terlambat->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->terlambat->getPlaceHolder()) ?>"<?= $Page->terlambat->editAttributes() ?> aria-describedby="x_terlambat_help">
<?= $Page->terlambat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->terlambat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->izin->Visible) { // izin ?>
    <div id="r_izin"<?= $Page->izin->rowAttributes() ?>>
        <label id="elh_potongan_izin" for="x_izin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->izin->caption() ?><?= $Page->izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->izin->cellAttributes() ?>>
<span id="el_potongan_izin">
<input type="<?= $Page->izin->getInputTextType() ?>" name="x_izin" id="x_izin" data-table="potongan" data-field="x_izin" value="<?= $Page->izin->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->izin->getPlaceHolder()) ?>"<?= $Page->izin->editAttributes() ?> aria-describedby="x_izin_help">
<?= $Page->izin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->izin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->izinperjam->Visible) { // izinperjam ?>
    <div id="r_izinperjam"<?= $Page->izinperjam->rowAttributes() ?>>
        <label id="elh_potongan_izinperjam" for="x_izinperjam" class="<?= $Page->LeftColumnClass ?>"><?= $Page->izinperjam->caption() ?><?= $Page->izinperjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->izinperjam->cellAttributes() ?>>
<span id="el_potongan_izinperjam">
<input type="<?= $Page->izinperjam->getInputTextType() ?>" name="x_izinperjam" id="x_izinperjam" data-table="potongan" data-field="x_izinperjam" value="<?= $Page->izinperjam->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->izinperjam->getPlaceHolder()) ?>"<?= $Page->izinperjam->editAttributes() ?> aria-describedby="x_izinperjam_help">
<?= $Page->izinperjam->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->izinperjam->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->izinperjamvalue->Visible) { // izinperjamvalue ?>
    <div id="r_izinperjamvalue"<?= $Page->izinperjamvalue->rowAttributes() ?>>
        <label id="elh_potongan_izinperjamvalue" for="x_izinperjamvalue" class="<?= $Page->LeftColumnClass ?>"><?= $Page->izinperjamvalue->caption() ?><?= $Page->izinperjamvalue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->izinperjamvalue->cellAttributes() ?>>
<span id="el_potongan_izinperjamvalue">
<input type="<?= $Page->izinperjamvalue->getInputTextType() ?>" name="x_izinperjamvalue" id="x_izinperjamvalue" data-table="potongan" data-field="x_izinperjamvalue" value="<?= $Page->izinperjamvalue->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->izinperjamvalue->getPlaceHolder()) ?>"<?= $Page->izinperjamvalue->editAttributes() ?> aria-describedby="x_izinperjamvalue_help">
<?= $Page->izinperjamvalue->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->izinperjamvalue->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sakit->Visible) { // sakit ?>
    <div id="r_sakit"<?= $Page->sakit->rowAttributes() ?>>
        <label id="elh_potongan_sakit" for="x_sakit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sakit->caption() ?><?= $Page->sakit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sakit->cellAttributes() ?>>
<span id="el_potongan_sakit">
<input type="<?= $Page->sakit->getInputTextType() ?>" name="x_sakit" id="x_sakit" data-table="potongan" data-field="x_sakit" value="<?= $Page->sakit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->sakit->getPlaceHolder()) ?>"<?= $Page->sakit->editAttributes() ?> aria-describedby="x_sakit_help">
<?= $Page->sakit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sakit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sakitperjam->Visible) { // sakitperjam ?>
    <div id="r_sakitperjam"<?= $Page->sakitperjam->rowAttributes() ?>>
        <label id="elh_potongan_sakitperjam" for="x_sakitperjam" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sakitperjam->caption() ?><?= $Page->sakitperjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sakitperjam->cellAttributes() ?>>
<span id="el_potongan_sakitperjam">
<input type="<?= $Page->sakitperjam->getInputTextType() ?>" name="x_sakitperjam" id="x_sakitperjam" data-table="potongan" data-field="x_sakitperjam" value="<?= $Page->sakitperjam->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->sakitperjam->getPlaceHolder()) ?>"<?= $Page->sakitperjam->editAttributes() ?> aria-describedby="x_sakitperjam_help">
<?= $Page->sakitperjam->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sakitperjam->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sakitperjamvalue->Visible) { // sakitperjamvalue ?>
    <div id="r_sakitperjamvalue"<?= $Page->sakitperjamvalue->rowAttributes() ?>>
        <label id="elh_potongan_sakitperjamvalue" for="x_sakitperjamvalue" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sakitperjamvalue->caption() ?><?= $Page->sakitperjamvalue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sakitperjamvalue->cellAttributes() ?>>
<span id="el_potongan_sakitperjamvalue">
<input type="<?= $Page->sakitperjamvalue->getInputTextType() ?>" name="x_sakitperjamvalue" id="x_sakitperjamvalue" data-table="potongan" data-field="x_sakitperjamvalue" value="<?= $Page->sakitperjamvalue->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->sakitperjamvalue->getPlaceHolder()) ?>"<?= $Page->sakitperjamvalue->editAttributes() ?> aria-describedby="x_sakitperjamvalue_help">
<?= $Page->sakitperjamvalue->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sakitperjamvalue->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pulcep->Visible) { // pulcep ?>
    <div id="r_pulcep"<?= $Page->pulcep->rowAttributes() ?>>
        <label id="elh_potongan_pulcep" for="x_pulcep" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pulcep->caption() ?><?= $Page->pulcep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pulcep->cellAttributes() ?>>
<span id="el_potongan_pulcep">
<input type="<?= $Page->pulcep->getInputTextType() ?>" name="x_pulcep" id="x_pulcep" data-table="potongan" data-field="x_pulcep" value="<?= $Page->pulcep->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pulcep->getPlaceHolder()) ?>"<?= $Page->pulcep->editAttributes() ?> aria-describedby="x_pulcep_help">
<?= $Page->pulcep->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pulcep->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tidakhadir->Visible) { // tidakhadir ?>
    <div id="r_tidakhadir"<?= $Page->tidakhadir->rowAttributes() ?>>
        <label id="elh_potongan_tidakhadir" for="x_tidakhadir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tidakhadir->caption() ?><?= $Page->tidakhadir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tidakhadir->cellAttributes() ?>>
<span id="el_potongan_tidakhadir">
<input type="<?= $Page->tidakhadir->getInputTextType() ?>" name="x_tidakhadir" id="x_tidakhadir" data-table="potongan" data-field="x_tidakhadir" value="<?= $Page->tidakhadir->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tidakhadir->getPlaceHolder()) ?>"<?= $Page->tidakhadir->editAttributes() ?> aria-describedby="x_tidakhadir_help">
<?= $Page->tidakhadir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tidakhadir->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tidakhadirjam->Visible) { // tidakhadirjam ?>
    <div id="r_tidakhadirjam"<?= $Page->tidakhadirjam->rowAttributes() ?>>
        <label id="elh_potongan_tidakhadirjam" for="x_tidakhadirjam" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tidakhadirjam->caption() ?><?= $Page->tidakhadirjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tidakhadirjam->cellAttributes() ?>>
<span id="el_potongan_tidakhadirjam">
<input type="<?= $Page->tidakhadirjam->getInputTextType() ?>" name="x_tidakhadirjam" id="x_tidakhadirjam" data-table="potongan" data-field="x_tidakhadirjam" value="<?= $Page->tidakhadirjam->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tidakhadirjam->getPlaceHolder()) ?>"<?= $Page->tidakhadirjam->editAttributes() ?> aria-describedby="x_tidakhadirjam_help">
<?= $Page->tidakhadirjam->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tidakhadirjam->getErrorMessage() ?></div>
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
    ew.addEventHandlers("potongan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
