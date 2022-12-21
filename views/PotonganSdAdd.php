<?php

namespace PHPMaker2022\sigap;

// Page object
$PotonganSdAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { potongan_sd: currentTable } });
var currentForm, currentPageID;
var fpotongan_sdadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpotongan_sdadd = new ew.Form("fpotongan_sdadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fpotongan_sdadd;

    // Add fields
    var fields = currentTable.fields;
    fpotongan_sdadd.addFields([
        ["month", [fields.month.visible && fields.month.required ? ew.Validators.required(fields.month.caption) : null], fields.month.isInvalid],
        ["jenjang_id", [fields.jenjang_id.visible && fields.jenjang_id.required ? ew.Validators.required(fields.jenjang_id.caption) : null, ew.Validators.integer], fields.jenjang_id.isInvalid],
        ["jabatan_id", [fields.jabatan_id.visible && fields.jabatan_id.required ? ew.Validators.required(fields.jabatan_id.caption) : null, ew.Validators.integer], fields.jabatan_id.isInvalid],
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["terlambat", [fields.terlambat.visible && fields.terlambat.required ? ew.Validators.required(fields.terlambat.caption) : null, ew.Validators.integer], fields.terlambat.isInvalid],
        ["value_terlambat", [fields.value_terlambat.visible && fields.value_terlambat.required ? ew.Validators.required(fields.value_terlambat.caption) : null, ew.Validators.integer], fields.value_terlambat.isInvalid],
        ["izin", [fields.izin.visible && fields.izin.required ? ew.Validators.required(fields.izin.caption) : null, ew.Validators.integer], fields.izin.isInvalid],
        ["value_izin", [fields.value_izin.visible && fields.value_izin.required ? ew.Validators.required(fields.value_izin.caption) : null, ew.Validators.integer], fields.value_izin.isInvalid],
        ["sakit", [fields.sakit.visible && fields.sakit.required ? ew.Validators.required(fields.sakit.caption) : null, ew.Validators.integer], fields.sakit.isInvalid],
        ["value_sakit", [fields.value_sakit.visible && fields.value_sakit.required ? ew.Validators.required(fields.value_sakit.caption) : null, ew.Validators.integer], fields.value_sakit.isInvalid],
        ["sakitperjam", [fields.sakitperjam.visible && fields.sakitperjam.required ? ew.Validators.required(fields.sakitperjam.caption) : null, ew.Validators.integer], fields.sakitperjam.isInvalid],
        ["sakitperjamvalue", [fields.sakitperjamvalue.visible && fields.sakitperjamvalue.required ? ew.Validators.required(fields.sakitperjamvalue.caption) : null, ew.Validators.integer], fields.sakitperjamvalue.isInvalid],
        ["pulcep", [fields.pulcep.visible && fields.pulcep.required ? ew.Validators.required(fields.pulcep.caption) : null, ew.Validators.integer], fields.pulcep.isInvalid],
        ["value_pulcep", [fields.value_pulcep.visible && fields.value_pulcep.required ? ew.Validators.required(fields.value_pulcep.caption) : null, ew.Validators.integer], fields.value_pulcep.isInvalid],
        ["tidakhadir", [fields.tidakhadir.visible && fields.tidakhadir.required ? ew.Validators.required(fields.tidakhadir.caption) : null, ew.Validators.integer], fields.tidakhadir.isInvalid],
        ["value_tidakhadir", [fields.value_tidakhadir.visible && fields.value_tidakhadir.required ? ew.Validators.required(fields.value_tidakhadir.caption) : null, ew.Validators.integer], fields.value_tidakhadir.isInvalid],
        ["tidakhadirjam", [fields.tidakhadirjam.visible && fields.tidakhadirjam.required ? ew.Validators.required(fields.tidakhadirjam.caption) : null, ew.Validators.integer], fields.tidakhadirjam.isInvalid],
        ["tidakhadirjamvalue", [fields.tidakhadirjamvalue.visible && fields.tidakhadirjamvalue.required ? ew.Validators.required(fields.tidakhadirjamvalue.caption) : null, ew.Validators.integer], fields.tidakhadirjamvalue.isInvalid],
        ["izinperjam", [fields.izinperjam.visible && fields.izinperjam.required ? ew.Validators.required(fields.izinperjam.caption) : null, ew.Validators.integer], fields.izinperjam.isInvalid],
        ["izinperjamvalue", [fields.izinperjamvalue.visible && fields.izinperjamvalue.required ? ew.Validators.required(fields.izinperjamvalue.caption) : null, ew.Validators.integer], fields.izinperjamvalue.isInvalid],
        ["total", [fields.total.visible && fields.total.required ? ew.Validators.required(fields.total.caption) : null, ew.Validators.integer], fields.total.isInvalid],
        ["u_by", [fields.u_by.visible && fields.u_by.required ? ew.Validators.required(fields.u_by.caption) : null], fields.u_by.isInvalid],
        ["datetime", [fields.datetime.visible && fields.datetime.required ? ew.Validators.required(fields.datetime.caption) : null], fields.datetime.isInvalid]
    ]);

    // Form_CustomValidate
    fpotongan_sdadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpotongan_sdadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpotongan_sdadd.lists.u_by = <?= $Page->u_by->toClientList($Page) ?>;
    loadjs.done("fpotongan_sdadd");
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
<form name="fpotongan_sdadd" id="fpotongan_sdadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="potongan_sd">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->month->Visible) { // month ?>
    <div id="r_month"<?= $Page->month->rowAttributes() ?>>
        <label id="elh_potongan_sd_month" for="x_month" class="<?= $Page->LeftColumnClass ?>"><?= $Page->month->caption() ?><?= $Page->month->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->month->cellAttributes() ?>>
<span id="el_potongan_sd_month">
<input type="<?= $Page->month->getInputTextType() ?>" name="x_month" id="x_month" data-table="potongan_sd" data-field="x_month" value="<?= $Page->month->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->month->getPlaceHolder()) ?>"<?= $Page->month->editAttributes() ?> aria-describedby="x_month_help">
<?= $Page->month->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->month->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
    <div id="r_jenjang_id"<?= $Page->jenjang_id->rowAttributes() ?>>
        <label id="elh_potongan_sd_jenjang_id" for="x_jenjang_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenjang_id->caption() ?><?= $Page->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el_potongan_sd_jenjang_id">
<input type="<?= $Page->jenjang_id->getInputTextType() ?>" name="x_jenjang_id" id="x_jenjang_id" data-table="potongan_sd" data-field="x_jenjang_id" value="<?= $Page->jenjang_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jenjang_id->getPlaceHolder()) ?>"<?= $Page->jenjang_id->editAttributes() ?> aria-describedby="x_jenjang_id_help">
<?= $Page->jenjang_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenjang_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
    <div id="r_jabatan_id"<?= $Page->jabatan_id->rowAttributes() ?>>
        <label id="elh_potongan_sd_jabatan_id" for="x_jabatan_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jabatan_id->caption() ?><?= $Page->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el_potongan_sd_jabatan_id">
<input type="<?= $Page->jabatan_id->getInputTextType() ?>" name="x_jabatan_id" id="x_jabatan_id" data-table="potongan_sd" data-field="x_jabatan_id" value="<?= $Page->jabatan_id->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jabatan_id->getPlaceHolder()) ?>"<?= $Page->jabatan_id->editAttributes() ?> aria-describedby="x_jabatan_id_help">
<?= $Page->jabatan_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jabatan_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <label id="elh_potongan_sd_nama" for="x_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama->cellAttributes() ?>>
<span id="el_potongan_sd_nama">
<input type="<?= $Page->nama->getInputTextType() ?>" name="x_nama" id="x_nama" data-table="potongan_sd" data-field="x_nama" value="<?= $Page->nama->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>"<?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
<?= $Page->nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->terlambat->Visible) { // terlambat ?>
    <div id="r_terlambat"<?= $Page->terlambat->rowAttributes() ?>>
        <label id="elh_potongan_sd_terlambat" for="x_terlambat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->terlambat->caption() ?><?= $Page->terlambat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->terlambat->cellAttributes() ?>>
<span id="el_potongan_sd_terlambat">
<input type="<?= $Page->terlambat->getInputTextType() ?>" name="x_terlambat" id="x_terlambat" data-table="potongan_sd" data-field="x_terlambat" value="<?= $Page->terlambat->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->terlambat->getPlaceHolder()) ?>"<?= $Page->terlambat->editAttributes() ?> aria-describedby="x_terlambat_help">
<?= $Page->terlambat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->terlambat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->value_terlambat->Visible) { // value_terlambat ?>
    <div id="r_value_terlambat"<?= $Page->value_terlambat->rowAttributes() ?>>
        <label id="elh_potongan_sd_value_terlambat" for="x_value_terlambat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->value_terlambat->caption() ?><?= $Page->value_terlambat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->value_terlambat->cellAttributes() ?>>
<span id="el_potongan_sd_value_terlambat">
<input type="<?= $Page->value_terlambat->getInputTextType() ?>" name="x_value_terlambat" id="x_value_terlambat" data-table="potongan_sd" data-field="x_value_terlambat" value="<?= $Page->value_terlambat->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->value_terlambat->getPlaceHolder()) ?>"<?= $Page->value_terlambat->editAttributes() ?> aria-describedby="x_value_terlambat_help">
<?= $Page->value_terlambat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->value_terlambat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->izin->Visible) { // izin ?>
    <div id="r_izin"<?= $Page->izin->rowAttributes() ?>>
        <label id="elh_potongan_sd_izin" for="x_izin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->izin->caption() ?><?= $Page->izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->izin->cellAttributes() ?>>
<span id="el_potongan_sd_izin">
<input type="<?= $Page->izin->getInputTextType() ?>" name="x_izin" id="x_izin" data-table="potongan_sd" data-field="x_izin" value="<?= $Page->izin->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->izin->getPlaceHolder()) ?>"<?= $Page->izin->editAttributes() ?> aria-describedby="x_izin_help">
<?= $Page->izin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->izin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->value_izin->Visible) { // value_izin ?>
    <div id="r_value_izin"<?= $Page->value_izin->rowAttributes() ?>>
        <label id="elh_potongan_sd_value_izin" for="x_value_izin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->value_izin->caption() ?><?= $Page->value_izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->value_izin->cellAttributes() ?>>
<span id="el_potongan_sd_value_izin">
<input type="<?= $Page->value_izin->getInputTextType() ?>" name="x_value_izin" id="x_value_izin" data-table="potongan_sd" data-field="x_value_izin" value="<?= $Page->value_izin->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->value_izin->getPlaceHolder()) ?>"<?= $Page->value_izin->editAttributes() ?> aria-describedby="x_value_izin_help">
<?= $Page->value_izin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->value_izin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sakit->Visible) { // sakit ?>
    <div id="r_sakit"<?= $Page->sakit->rowAttributes() ?>>
        <label id="elh_potongan_sd_sakit" for="x_sakit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sakit->caption() ?><?= $Page->sakit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sakit->cellAttributes() ?>>
<span id="el_potongan_sd_sakit">
<input type="<?= $Page->sakit->getInputTextType() ?>" name="x_sakit" id="x_sakit" data-table="potongan_sd" data-field="x_sakit" value="<?= $Page->sakit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->sakit->getPlaceHolder()) ?>"<?= $Page->sakit->editAttributes() ?> aria-describedby="x_sakit_help">
<?= $Page->sakit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sakit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->value_sakit->Visible) { // value_sakit ?>
    <div id="r_value_sakit"<?= $Page->value_sakit->rowAttributes() ?>>
        <label id="elh_potongan_sd_value_sakit" for="x_value_sakit" class="<?= $Page->LeftColumnClass ?>"><?= $Page->value_sakit->caption() ?><?= $Page->value_sakit->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->value_sakit->cellAttributes() ?>>
<span id="el_potongan_sd_value_sakit">
<input type="<?= $Page->value_sakit->getInputTextType() ?>" name="x_value_sakit" id="x_value_sakit" data-table="potongan_sd" data-field="x_value_sakit" value="<?= $Page->value_sakit->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->value_sakit->getPlaceHolder()) ?>"<?= $Page->value_sakit->editAttributes() ?> aria-describedby="x_value_sakit_help">
<?= $Page->value_sakit->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->value_sakit->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sakitperjam->Visible) { // sakitperjam ?>
    <div id="r_sakitperjam"<?= $Page->sakitperjam->rowAttributes() ?>>
        <label id="elh_potongan_sd_sakitperjam" for="x_sakitperjam" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sakitperjam->caption() ?><?= $Page->sakitperjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sakitperjam->cellAttributes() ?>>
<span id="el_potongan_sd_sakitperjam">
<input type="<?= $Page->sakitperjam->getInputTextType() ?>" name="x_sakitperjam" id="x_sakitperjam" data-table="potongan_sd" data-field="x_sakitperjam" value="<?= $Page->sakitperjam->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->sakitperjam->getPlaceHolder()) ?>"<?= $Page->sakitperjam->editAttributes() ?> aria-describedby="x_sakitperjam_help">
<?= $Page->sakitperjam->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sakitperjam->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sakitperjamvalue->Visible) { // sakitperjamvalue ?>
    <div id="r_sakitperjamvalue"<?= $Page->sakitperjamvalue->rowAttributes() ?>>
        <label id="elh_potongan_sd_sakitperjamvalue" for="x_sakitperjamvalue" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sakitperjamvalue->caption() ?><?= $Page->sakitperjamvalue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sakitperjamvalue->cellAttributes() ?>>
<span id="el_potongan_sd_sakitperjamvalue">
<input type="<?= $Page->sakitperjamvalue->getInputTextType() ?>" name="x_sakitperjamvalue" id="x_sakitperjamvalue" data-table="potongan_sd" data-field="x_sakitperjamvalue" value="<?= $Page->sakitperjamvalue->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->sakitperjamvalue->getPlaceHolder()) ?>"<?= $Page->sakitperjamvalue->editAttributes() ?> aria-describedby="x_sakitperjamvalue_help">
<?= $Page->sakitperjamvalue->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sakitperjamvalue->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pulcep->Visible) { // pulcep ?>
    <div id="r_pulcep"<?= $Page->pulcep->rowAttributes() ?>>
        <label id="elh_potongan_sd_pulcep" for="x_pulcep" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pulcep->caption() ?><?= $Page->pulcep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pulcep->cellAttributes() ?>>
<span id="el_potongan_sd_pulcep">
<input type="<?= $Page->pulcep->getInputTextType() ?>" name="x_pulcep" id="x_pulcep" data-table="potongan_sd" data-field="x_pulcep" value="<?= $Page->pulcep->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pulcep->getPlaceHolder()) ?>"<?= $Page->pulcep->editAttributes() ?> aria-describedby="x_pulcep_help">
<?= $Page->pulcep->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pulcep->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->value_pulcep->Visible) { // value_pulcep ?>
    <div id="r_value_pulcep"<?= $Page->value_pulcep->rowAttributes() ?>>
        <label id="elh_potongan_sd_value_pulcep" for="x_value_pulcep" class="<?= $Page->LeftColumnClass ?>"><?= $Page->value_pulcep->caption() ?><?= $Page->value_pulcep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->value_pulcep->cellAttributes() ?>>
<span id="el_potongan_sd_value_pulcep">
<input type="<?= $Page->value_pulcep->getInputTextType() ?>" name="x_value_pulcep" id="x_value_pulcep" data-table="potongan_sd" data-field="x_value_pulcep" value="<?= $Page->value_pulcep->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->value_pulcep->getPlaceHolder()) ?>"<?= $Page->value_pulcep->editAttributes() ?> aria-describedby="x_value_pulcep_help">
<?= $Page->value_pulcep->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->value_pulcep->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tidakhadir->Visible) { // tidakhadir ?>
    <div id="r_tidakhadir"<?= $Page->tidakhadir->rowAttributes() ?>>
        <label id="elh_potongan_sd_tidakhadir" for="x_tidakhadir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tidakhadir->caption() ?><?= $Page->tidakhadir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tidakhadir->cellAttributes() ?>>
<span id="el_potongan_sd_tidakhadir">
<input type="<?= $Page->tidakhadir->getInputTextType() ?>" name="x_tidakhadir" id="x_tidakhadir" data-table="potongan_sd" data-field="x_tidakhadir" value="<?= $Page->tidakhadir->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tidakhadir->getPlaceHolder()) ?>"<?= $Page->tidakhadir->editAttributes() ?> aria-describedby="x_tidakhadir_help">
<?= $Page->tidakhadir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tidakhadir->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->value_tidakhadir->Visible) { // value_tidakhadir ?>
    <div id="r_value_tidakhadir"<?= $Page->value_tidakhadir->rowAttributes() ?>>
        <label id="elh_potongan_sd_value_tidakhadir" for="x_value_tidakhadir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->value_tidakhadir->caption() ?><?= $Page->value_tidakhadir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->value_tidakhadir->cellAttributes() ?>>
<span id="el_potongan_sd_value_tidakhadir">
<input type="<?= $Page->value_tidakhadir->getInputTextType() ?>" name="x_value_tidakhadir" id="x_value_tidakhadir" data-table="potongan_sd" data-field="x_value_tidakhadir" value="<?= $Page->value_tidakhadir->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->value_tidakhadir->getPlaceHolder()) ?>"<?= $Page->value_tidakhadir->editAttributes() ?> aria-describedby="x_value_tidakhadir_help">
<?= $Page->value_tidakhadir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->value_tidakhadir->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tidakhadirjam->Visible) { // tidakhadirjam ?>
    <div id="r_tidakhadirjam"<?= $Page->tidakhadirjam->rowAttributes() ?>>
        <label id="elh_potongan_sd_tidakhadirjam" for="x_tidakhadirjam" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tidakhadirjam->caption() ?><?= $Page->tidakhadirjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tidakhadirjam->cellAttributes() ?>>
<span id="el_potongan_sd_tidakhadirjam">
<input type="<?= $Page->tidakhadirjam->getInputTextType() ?>" name="x_tidakhadirjam" id="x_tidakhadirjam" data-table="potongan_sd" data-field="x_tidakhadirjam" value="<?= $Page->tidakhadirjam->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tidakhadirjam->getPlaceHolder()) ?>"<?= $Page->tidakhadirjam->editAttributes() ?> aria-describedby="x_tidakhadirjam_help">
<?= $Page->tidakhadirjam->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tidakhadirjam->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tidakhadirjamvalue->Visible) { // tidakhadirjamvalue ?>
    <div id="r_tidakhadirjamvalue"<?= $Page->tidakhadirjamvalue->rowAttributes() ?>>
        <label id="elh_potongan_sd_tidakhadirjamvalue" for="x_tidakhadirjamvalue" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tidakhadirjamvalue->caption() ?><?= $Page->tidakhadirjamvalue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tidakhadirjamvalue->cellAttributes() ?>>
<span id="el_potongan_sd_tidakhadirjamvalue">
<input type="<?= $Page->tidakhadirjamvalue->getInputTextType() ?>" name="x_tidakhadirjamvalue" id="x_tidakhadirjamvalue" data-table="potongan_sd" data-field="x_tidakhadirjamvalue" value="<?= $Page->tidakhadirjamvalue->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tidakhadirjamvalue->getPlaceHolder()) ?>"<?= $Page->tidakhadirjamvalue->editAttributes() ?> aria-describedby="x_tidakhadirjamvalue_help">
<?= $Page->tidakhadirjamvalue->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tidakhadirjamvalue->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->izinperjam->Visible) { // izinperjam ?>
    <div id="r_izinperjam"<?= $Page->izinperjam->rowAttributes() ?>>
        <label id="elh_potongan_sd_izinperjam" for="x_izinperjam" class="<?= $Page->LeftColumnClass ?>"><?= $Page->izinperjam->caption() ?><?= $Page->izinperjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->izinperjam->cellAttributes() ?>>
<span id="el_potongan_sd_izinperjam">
<input type="<?= $Page->izinperjam->getInputTextType() ?>" name="x_izinperjam" id="x_izinperjam" data-table="potongan_sd" data-field="x_izinperjam" value="<?= $Page->izinperjam->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->izinperjam->getPlaceHolder()) ?>"<?= $Page->izinperjam->editAttributes() ?> aria-describedby="x_izinperjam_help">
<?= $Page->izinperjam->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->izinperjam->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->izinperjamvalue->Visible) { // izinperjamvalue ?>
    <div id="r_izinperjamvalue"<?= $Page->izinperjamvalue->rowAttributes() ?>>
        <label id="elh_potongan_sd_izinperjamvalue" for="x_izinperjamvalue" class="<?= $Page->LeftColumnClass ?>"><?= $Page->izinperjamvalue->caption() ?><?= $Page->izinperjamvalue->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->izinperjamvalue->cellAttributes() ?>>
<span id="el_potongan_sd_izinperjamvalue">
<input type="<?= $Page->izinperjamvalue->getInputTextType() ?>" name="x_izinperjamvalue" id="x_izinperjamvalue" data-table="potongan_sd" data-field="x_izinperjamvalue" value="<?= $Page->izinperjamvalue->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->izinperjamvalue->getPlaceHolder()) ?>"<?= $Page->izinperjamvalue->editAttributes() ?> aria-describedby="x_izinperjamvalue_help">
<?= $Page->izinperjamvalue->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->izinperjamvalue->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
    <div id="r_total"<?= $Page->total->rowAttributes() ?>>
        <label id="elh_potongan_sd_total" for="x_total" class="<?= $Page->LeftColumnClass ?>"><?= $Page->total->caption() ?><?= $Page->total->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->total->cellAttributes() ?>>
<span id="el_potongan_sd_total">
<input type="<?= $Page->total->getInputTextType() ?>" name="x_total" id="x_total" data-table="potongan_sd" data-field="x_total" value="<?= $Page->total->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->total->getPlaceHolder()) ?>"<?= $Page->total->editAttributes() ?> aria-describedby="x_total_help">
<?= $Page->total->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->total->getErrorMessage() ?></div>
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
    ew.addEventHandlers("potongan_sd");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
