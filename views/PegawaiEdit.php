<?php

namespace PHPMaker2022\sigap;

// Page object
$PegawaiEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pegawai: currentTable } });
var currentForm, currentPageID;
var fpegawaiedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpegawaiedit = new ew.Form("fpegawaiedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fpegawaiedit;

    // Add fields
    var fields = currentTable.fields;
    fpegawaiedit.addFields([
        ["_username", [fields._username.visible && fields._username.required ? ew.Validators.required(fields._username.caption) : null], fields._username.isInvalid],
        ["_password", [fields._password.visible && fields._password.required ? ew.Validators.required(fields._password.caption) : null], fields._password.isInvalid],
        ["nip", [fields.nip.visible && fields.nip.required ? ew.Validators.required(fields.nip.caption) : null], fields.nip.isInvalid],
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["alamat", [fields.alamat.visible && fields.alamat.required ? ew.Validators.required(fields.alamat.caption) : null], fields.alamat.isInvalid],
        ["_email", [fields._email.visible && fields._email.required ? ew.Validators.required(fields._email.caption) : null], fields._email.isInvalid],
        ["wa", [fields.wa.visible && fields.wa.required ? ew.Validators.required(fields.wa.caption) : null], fields.wa.isInvalid],
        ["hp", [fields.hp.visible && fields.hp.required ? ew.Validators.required(fields.hp.caption) : null], fields.hp.isInvalid],
        ["tgllahir", [fields.tgllahir.visible && fields.tgllahir.required ? ew.Validators.required(fields.tgllahir.caption) : null, ew.Validators.datetime(fields.tgllahir.clientFormatPattern)], fields.tgllahir.isInvalid],
        ["rekbank", [fields.rekbank.visible && fields.rekbank.required ? ew.Validators.required(fields.rekbank.caption) : null], fields.rekbank.isInvalid],
        ["jenjang_id", [fields.jenjang_id.visible && fields.jenjang_id.required ? ew.Validators.required(fields.jenjang_id.caption) : null, ew.Validators.integer], fields.jenjang_id.isInvalid],
        ["pendidikan", [fields.pendidikan.visible && fields.pendidikan.required ? ew.Validators.required(fields.pendidikan.caption) : null, ew.Validators.integer], fields.pendidikan.isInvalid],
        ["jurusan", [fields.jurusan.visible && fields.jurusan.required ? ew.Validators.required(fields.jurusan.caption) : null], fields.jurusan.isInvalid],
        ["agama", [fields.agama.visible && fields.agama.required ? ew.Validators.required(fields.agama.caption) : null], fields.agama.isInvalid],
        ["jabatan", [fields.jabatan.visible && fields.jabatan.required ? ew.Validators.required(fields.jabatan.caption) : null, ew.Validators.integer], fields.jabatan.isInvalid],
        ["jenkel", [fields.jenkel.visible && fields.jenkel.required ? ew.Validators.required(fields.jenkel.caption) : null], fields.jenkel.isInvalid],
        ["mulai_bekerja", [fields.mulai_bekerja.visible && fields.mulai_bekerja.required ? ew.Validators.required(fields.mulai_bekerja.caption) : null, ew.Validators.datetime(fields.mulai_bekerja.clientFormatPattern)], fields.mulai_bekerja.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
        ["level", [fields.level.visible && fields.level.required ? ew.Validators.required(fields.level.caption) : null], fields.level.isInvalid],
        ["aktif", [fields.aktif.visible && fields.aktif.required ? ew.Validators.required(fields.aktif.caption) : null, ew.Validators.integer], fields.aktif.isInvalid],
        ["foto", [fields.foto.visible && fields.foto.required ? ew.Validators.fileRequired(fields.foto.caption) : null], fields.foto.isInvalid],
        ["file_cv", [fields.file_cv.visible && fields.file_cv.required ? ew.Validators.fileRequired(fields.file_cv.caption) : null], fields.file_cv.isInvalid]
    ]);

    // Form_CustomValidate
    fpegawaiedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpegawaiedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpegawaiedit.lists.jenjang_id = <?= $Page->jenjang_id->toClientList($Page) ?>;
    fpegawaiedit.lists.pendidikan = <?= $Page->pendidikan->toClientList($Page) ?>;
    fpegawaiedit.lists.agama = <?= $Page->agama->toClientList($Page) ?>;
    fpegawaiedit.lists.jabatan = <?= $Page->jabatan->toClientList($Page) ?>;
    fpegawaiedit.lists.jenkel = <?= $Page->jenkel->toClientList($Page) ?>;
    fpegawaiedit.lists.level = <?= $Page->level->toClientList($Page) ?>;
    loadjs.done("fpegawaiedit");
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
<form name="fpegawaiedit" id="fpegawaiedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pegawai">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->_username->Visible) { // username ?>
    <div id="r__username"<?= $Page->_username->rowAttributes() ?>>
        <label id="elh_pegawai__username" for="x__username" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_username->caption() ?><?= $Page->_username->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_username->cellAttributes() ?>>
<span id="el_pegawai__username">
<input type="<?= $Page->_username->getInputTextType() ?>" name="x__username" id="x__username" data-table="pegawai" data-field="x__username" value="<?= $Page->_username->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_username->getPlaceHolder()) ?>"<?= $Page->_username->editAttributes() ?> aria-describedby="x__username_help">
<?= $Page->_username->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_username->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <div id="r__password"<?= $Page->_password->rowAttributes() ?>>
        <label id="elh_pegawai__password" for="x__password" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_password->caption() ?><?= $Page->_password->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_password->cellAttributes() ?>>
<span id="el_pegawai__password">
<input type="<?= $Page->_password->getInputTextType() ?>" name="x__password" id="x__password" data-table="pegawai" data-field="x__password" value="<?= $Page->_password->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_password->getPlaceHolder()) ?>"<?= $Page->_password->editAttributes() ?> aria-describedby="x__password_help">
<?= $Page->_password->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_password->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
    <div id="r_nip"<?= $Page->nip->rowAttributes() ?>>
        <label id="elh_pegawai_nip" for="x_nip" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nip->caption() ?><?= $Page->nip->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nip->cellAttributes() ?>>
<span id="el_pegawai_nip">
<input type="<?= $Page->nip->getInputTextType() ?>" name="x_nip" id="x_nip" data-table="pegawai" data-field="x_nip" value="<?= $Page->nip->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nip->getPlaceHolder()) ?>"<?= $Page->nip->editAttributes() ?> aria-describedby="x_nip_help">
<?= $Page->nip->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nip->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <label id="elh_pegawai_nama" for="x_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama->cellAttributes() ?>>
<span id="el_pegawai_nama">
<input type="<?= $Page->nama->getInputTextType() ?>" name="x_nama" id="x_nama" data-table="pegawai" data-field="x_nama" value="<?= $Page->nama->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>"<?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
<?= $Page->nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
    <div id="r_alamat"<?= $Page->alamat->rowAttributes() ?>>
        <label id="elh_pegawai_alamat" for="x_alamat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->alamat->caption() ?><?= $Page->alamat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->alamat->cellAttributes() ?>>
<span id="el_pegawai_alamat">
<input type="<?= $Page->alamat->getInputTextType() ?>" name="x_alamat" id="x_alamat" data-table="pegawai" data-field="x_alamat" value="<?= $Page->alamat->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->alamat->getPlaceHolder()) ?>"<?= $Page->alamat->editAttributes() ?> aria-describedby="x_alamat_help">
<?= $Page->alamat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->alamat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <div id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <label id="elh_pegawai__email" for="x__email" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_email->caption() ?><?= $Page->_email->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->_email->cellAttributes() ?>>
<span id="el_pegawai__email">
<input type="<?= $Page->_email->getInputTextType() ?>" name="x__email" id="x__email" data-table="pegawai" data-field="x__email" value="<?= $Page->_email->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_email->getPlaceHolder()) ?>"<?= $Page->_email->editAttributes() ?> aria-describedby="x__email_help">
<?= $Page->_email->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_email->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->wa->Visible) { // wa ?>
    <div id="r_wa"<?= $Page->wa->rowAttributes() ?>>
        <label id="elh_pegawai_wa" for="x_wa" class="<?= $Page->LeftColumnClass ?>"><?= $Page->wa->caption() ?><?= $Page->wa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->wa->cellAttributes() ?>>
<span id="el_pegawai_wa">
<input type="<?= $Page->wa->getInputTextType() ?>" name="x_wa" id="x_wa" data-table="pegawai" data-field="x_wa" value="<?= $Page->wa->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->wa->getPlaceHolder()) ?>"<?= $Page->wa->editAttributes() ?> aria-describedby="x_wa_help">
<?= $Page->wa->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->wa->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->hp->Visible) { // hp ?>
    <div id="r_hp"<?= $Page->hp->rowAttributes() ?>>
        <label id="elh_pegawai_hp" for="x_hp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->hp->caption() ?><?= $Page->hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->hp->cellAttributes() ?>>
<span id="el_pegawai_hp">
<input type="<?= $Page->hp->getInputTextType() ?>" name="x_hp" id="x_hp" data-table="pegawai" data-field="x_hp" value="<?= $Page->hp->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->hp->getPlaceHolder()) ?>"<?= $Page->hp->editAttributes() ?> aria-describedby="x_hp_help">
<?= $Page->hp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->hp->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgllahir->Visible) { // tgllahir ?>
    <div id="r_tgllahir"<?= $Page->tgllahir->rowAttributes() ?>>
        <label id="elh_pegawai_tgllahir" for="x_tgllahir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgllahir->caption() ?><?= $Page->tgllahir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgllahir->cellAttributes() ?>>
<span id="el_pegawai_tgllahir">
<input type="<?= $Page->tgllahir->getInputTextType() ?>" name="x_tgllahir" id="x_tgllahir" data-table="pegawai" data-field="x_tgllahir" value="<?= $Page->tgllahir->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgllahir->getPlaceHolder()) ?>"<?= $Page->tgllahir->editAttributes() ?> aria-describedby="x_tgllahir_help">
<?= $Page->tgllahir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgllahir->getErrorMessage() ?></div>
<?php if (!$Page->tgllahir->ReadOnly && !$Page->tgllahir->Disabled && !isset($Page->tgllahir->EditAttrs["readonly"]) && !isset($Page->tgllahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpegawaiedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpegawaiedit", "x_tgllahir", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->rekbank->Visible) { // rekbank ?>
    <div id="r_rekbank"<?= $Page->rekbank->rowAttributes() ?>>
        <label id="elh_pegawai_rekbank" for="x_rekbank" class="<?= $Page->LeftColumnClass ?>"><?= $Page->rekbank->caption() ?><?= $Page->rekbank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->rekbank->cellAttributes() ?>>
<span id="el_pegawai_rekbank">
<input type="<?= $Page->rekbank->getInputTextType() ?>" name="x_rekbank" id="x_rekbank" data-table="pegawai" data-field="x_rekbank" value="<?= $Page->rekbank->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->rekbank->getPlaceHolder()) ?>"<?= $Page->rekbank->editAttributes() ?> aria-describedby="x_rekbank_help">
<?= $Page->rekbank->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->rekbank->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
    <div id="r_jenjang_id"<?= $Page->jenjang_id->rowAttributes() ?>>
        <label id="elh_pegawai_jenjang_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenjang_id->caption() ?><?= $Page->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el_pegawai_jenjang_id">
    <select
        id="x_jenjang_id"
        name="x_jenjang_id"
        class="form-control ew-select<?= $Page->jenjang_id->isInvalidClass() ?>"
        data-select2-id="fpegawaiedit_x_jenjang_id"
        data-table="pegawai"
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
loadjs.ready("fpegawaiedit", function() {
    var options = { name: "x_jenjang_id", selectId: "fpegawaiedit_x_jenjang_id" };
    if (fpegawaiedit.lists.jenjang_id.lookupOptions.length) {
        options.data = { id: "x_jenjang_id", form: "fpegawaiedit" };
    } else {
        options.ajax = { id: "x_jenjang_id", form: "fpegawaiedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.pegawai.fields.jenjang_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
    <div id="r_pendidikan"<?= $Page->pendidikan->rowAttributes() ?>>
        <label id="elh_pegawai_pendidikan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pendidikan->caption() ?><?= $Page->pendidikan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pendidikan->cellAttributes() ?>>
<span id="el_pegawai_pendidikan">
    <select
        id="x_pendidikan"
        name="x_pendidikan"
        class="form-control ew-select<?= $Page->pendidikan->isInvalidClass() ?>"
        data-select2-id="fpegawaiedit_x_pendidikan"
        data-table="pegawai"
        data-field="x_pendidikan"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->pendidikan->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->pendidikan->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->pendidikan->getPlaceHolder()) ?>"
        <?= $Page->pendidikan->editAttributes() ?>>
        <?= $Page->pendidikan->selectOptionListHtml("x_pendidikan") ?>
    </select>
    <?= $Page->pendidikan->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->pendidikan->getErrorMessage() ?></div>
<?= $Page->pendidikan->Lookup->getParamTag($Page, "p_x_pendidikan") ?>
<script>
loadjs.ready("fpegawaiedit", function() {
    var options = { name: "x_pendidikan", selectId: "fpegawaiedit_x_pendidikan" };
    if (fpegawaiedit.lists.pendidikan.lookupOptions.length) {
        options.data = { id: "x_pendidikan", form: "fpegawaiedit" };
    } else {
        options.ajax = { id: "x_pendidikan", form: "fpegawaiedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.pegawai.fields.pendidikan.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jurusan->Visible) { // jurusan ?>
    <div id="r_jurusan"<?= $Page->jurusan->rowAttributes() ?>>
        <label id="elh_pegawai_jurusan" for="x_jurusan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jurusan->caption() ?><?= $Page->jurusan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jurusan->cellAttributes() ?>>
<span id="el_pegawai_jurusan">
<input type="<?= $Page->jurusan->getInputTextType() ?>" name="x_jurusan" id="x_jurusan" data-table="pegawai" data-field="x_jurusan" value="<?= $Page->jurusan->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->jurusan->getPlaceHolder()) ?>"<?= $Page->jurusan->editAttributes() ?> aria-describedby="x_jurusan_help">
<?= $Page->jurusan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jurusan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
    <div id="r_agama"<?= $Page->agama->rowAttributes() ?>>
        <label id="elh_pegawai_agama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->agama->caption() ?><?= $Page->agama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->agama->cellAttributes() ?>>
<span id="el_pegawai_agama">
    <select
        id="x_agama"
        name="x_agama"
        class="form-control ew-select<?= $Page->agama->isInvalidClass() ?>"
        data-select2-id="fpegawaiedit_x_agama"
        data-table="pegawai"
        data-field="x_agama"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->agama->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->agama->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->agama->getPlaceHolder()) ?>"
        <?= $Page->agama->editAttributes() ?>>
        <?= $Page->agama->selectOptionListHtml("x_agama") ?>
    </select>
    <?= $Page->agama->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->agama->getErrorMessage() ?></div>
<?= $Page->agama->Lookup->getParamTag($Page, "p_x_agama") ?>
<script>
loadjs.ready("fpegawaiedit", function() {
    var options = { name: "x_agama", selectId: "fpegawaiedit_x_agama" };
    if (fpegawaiedit.lists.agama.lookupOptions.length) {
        options.data = { id: "x_agama", form: "fpegawaiedit" };
    } else {
        options.ajax = { id: "x_agama", form: "fpegawaiedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.pegawai.fields.agama.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
    <div id="r_jabatan"<?= $Page->jabatan->rowAttributes() ?>>
        <label id="elh_pegawai_jabatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jabatan->caption() ?><?= $Page->jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jabatan->cellAttributes() ?>>
<span id="el_pegawai_jabatan">
    <select
        id="x_jabatan"
        name="x_jabatan"
        class="form-control ew-select<?= $Page->jabatan->isInvalidClass() ?>"
        data-select2-id="fpegawaiedit_x_jabatan"
        data-table="pegawai"
        data-field="x_jabatan"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->jabatan->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->jabatan->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->jabatan->getPlaceHolder()) ?>"
        <?= $Page->jabatan->editAttributes() ?>>
        <?= $Page->jabatan->selectOptionListHtml("x_jabatan") ?>
    </select>
    <?= $Page->jabatan->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->jabatan->getErrorMessage() ?></div>
<?= $Page->jabatan->Lookup->getParamTag($Page, "p_x_jabatan") ?>
<script>
loadjs.ready("fpegawaiedit", function() {
    var options = { name: "x_jabatan", selectId: "fpegawaiedit_x_jabatan" };
    if (fpegawaiedit.lists.jabatan.lookupOptions.length) {
        options.data = { id: "x_jabatan", form: "fpegawaiedit" };
    } else {
        options.ajax = { id: "x_jabatan", form: "fpegawaiedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.pegawai.fields.jabatan.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenkel->Visible) { // jenkel ?>
    <div id="r_jenkel"<?= $Page->jenkel->rowAttributes() ?>>
        <label id="elh_pegawai_jenkel" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenkel->caption() ?><?= $Page->jenkel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenkel->cellAttributes() ?>>
<span id="el_pegawai_jenkel">
<template id="tp_x_jenkel">
    <div class="form-check">
        <input type="radio" class="form-check-input" data-table="pegawai" data-field="x_jenkel" name="x_jenkel" id="x_jenkel"<?= $Page->jenkel->editAttributes() ?>>
        <label class="form-check-label"></label>
    </div>
</template>
<div id="dsl_x_jenkel" class="ew-item-list"></div>
<selection-list hidden
    id="x_jenkel"
    name="x_jenkel"
    value="<?= HtmlEncode($Page->jenkel->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_jenkel"
    data-bs-target="dsl_x_jenkel"
    data-repeatcolumn="5"
    class="form-control<?= $Page->jenkel->isInvalidClass() ?>"
    data-table="pegawai"
    data-field="x_jenkel"
    data-value-separator="<?= $Page->jenkel->displayValueSeparatorAttribute() ?>"
    <?= $Page->jenkel->editAttributes() ?>></selection-list>
<?= $Page->jenkel->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenkel->getErrorMessage() ?></div>
<?= $Page->jenkel->Lookup->getParamTag($Page, "p_x_jenkel") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->mulai_bekerja->Visible) { // mulai_bekerja ?>
    <div id="r_mulai_bekerja"<?= $Page->mulai_bekerja->rowAttributes() ?>>
        <label id="elh_pegawai_mulai_bekerja" for="x_mulai_bekerja" class="<?= $Page->LeftColumnClass ?>"><?= $Page->mulai_bekerja->caption() ?><?= $Page->mulai_bekerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->mulai_bekerja->cellAttributes() ?>>
<span id="el_pegawai_mulai_bekerja">
<input type="<?= $Page->mulai_bekerja->getInputTextType() ?>" name="x_mulai_bekerja" id="x_mulai_bekerja" data-table="pegawai" data-field="x_mulai_bekerja" value="<?= $Page->mulai_bekerja->EditValue ?>" placeholder="<?= HtmlEncode($Page->mulai_bekerja->getPlaceHolder()) ?>"<?= $Page->mulai_bekerja->editAttributes() ?> aria-describedby="x_mulai_bekerja_help">
<?= $Page->mulai_bekerja->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->mulai_bekerja->getErrorMessage() ?></div>
<?php if (!$Page->mulai_bekerja->ReadOnly && !$Page->mulai_bekerja->Disabled && !isset($Page->mulai_bekerja->EditAttrs["readonly"]) && !isset($Page->mulai_bekerja->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpegawaiedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpegawaiedit", "x_mulai_bekerja", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_pegawai_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_pegawai_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="pegawai" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <div id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_pegawai_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_pegawai_keterangan">
<input type="<?= $Page->keterangan->getInputTextType() ?>" name="x_keterangan" id="x_keterangan" data-table="pegawai" data-field="x_keterangan" value="<?= $Page->keterangan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help">
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->level->Visible) { // level ?>
    <div id="r_level"<?= $Page->level->rowAttributes() ?>>
        <label id="elh_pegawai_level" for="x_level" class="<?= $Page->LeftColumnClass ?>"><?= $Page->level->caption() ?><?= $Page->level->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->level->cellAttributes() ?>>
<?php if (!$Security->isAdmin() && $Security->isLoggedIn()) { // Non system admin ?>
<span id="el_pegawai_level">
<span class="form-control-plaintext"><?= $Page->level->getDisplayValue($Page->level->EditValue) ?></span>
</span>
<?php } else { ?>
<span id="el_pegawai_level">
    <select
        id="x_level"
        name="x_level"
        class="form-select ew-select<?= $Page->level->isInvalidClass() ?>"
        data-select2-id="fpegawaiedit_x_level"
        data-table="pegawai"
        data-field="x_level"
        data-value-separator="<?= $Page->level->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->level->getPlaceHolder()) ?>"
        <?= $Page->level->editAttributes() ?>>
        <?= $Page->level->selectOptionListHtml("x_level") ?>
    </select>
    <?= $Page->level->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->level->getErrorMessage() ?></div>
<?= $Page->level->Lookup->getParamTag($Page, "p_x_level") ?>
<script>
loadjs.ready("fpegawaiedit", function() {
    var options = { name: "x_level", selectId: "fpegawaiedit_x_level" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpegawaiedit.lists.level.lookupOptions.length) {
        options.data = { id: "x_level", form: "fpegawaiedit" };
    } else {
        options.ajax = { id: "x_level", form: "fpegawaiedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.pegawai.fields.level.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
    <div id="r_aktif"<?= $Page->aktif->rowAttributes() ?>>
        <label id="elh_pegawai_aktif" for="x_aktif" class="<?= $Page->LeftColumnClass ?>"><?= $Page->aktif->caption() ?><?= $Page->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aktif->cellAttributes() ?>>
<span id="el_pegawai_aktif">
<input type="<?= $Page->aktif->getInputTextType() ?>" name="x_aktif" id="x_aktif" data-table="pegawai" data-field="x_aktif" value="<?= $Page->aktif->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->aktif->getPlaceHolder()) ?>"<?= $Page->aktif->editAttributes() ?> aria-describedby="x_aktif_help">
<?= $Page->aktif->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->aktif->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->foto->Visible) { // foto ?>
    <div id="r_foto"<?= $Page->foto->rowAttributes() ?>>
        <label id="elh_pegawai_foto" class="<?= $Page->LeftColumnClass ?>"><?= $Page->foto->caption() ?><?= $Page->foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->foto->cellAttributes() ?>>
<span id="el_pegawai_foto">
<div id="fd_x_foto" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->foto->title() ?>" data-table="pegawai" data-field="x_foto" name="x_foto" id="x_foto" lang="<?= CurrentLanguageID() ?>"<?= $Page->foto->editAttributes() ?> aria-describedby="x_foto_help"<?= ($Page->foto->ReadOnly || $Page->foto->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->foto->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->foto->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_foto" id= "fn_x_foto" value="<?= $Page->foto->Upload->FileName ?>">
<input type="hidden" name="fa_x_foto" id= "fa_x_foto" value="<?= (Post("fa_x_foto") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_foto" id= "fs_x_foto" value="255">
<input type="hidden" name="fx_x_foto" id= "fx_x_foto" value="<?= $Page->foto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_foto" id= "fm_x_foto" value="<?= $Page->foto->UploadMaxFileSize ?>">
<table id="ft_x_foto" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->file_cv->Visible) { // file_cv ?>
    <div id="r_file_cv"<?= $Page->file_cv->rowAttributes() ?>>
        <label id="elh_pegawai_file_cv" class="<?= $Page->LeftColumnClass ?>"><?= $Page->file_cv->caption() ?><?= $Page->file_cv->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->file_cv->cellAttributes() ?>>
<span id="el_pegawai_file_cv">
<div id="fd_x_file_cv" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->file_cv->title() ?>" data-table="pegawai" data-field="x_file_cv" name="x_file_cv" id="x_file_cv" lang="<?= CurrentLanguageID() ?>"<?= $Page->file_cv->editAttributes() ?> aria-describedby="x_file_cv_help"<?= ($Page->file_cv->ReadOnly || $Page->file_cv->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->file_cv->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->file_cv->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_file_cv" id= "fn_x_file_cv" value="<?= $Page->file_cv->Upload->FileName ?>">
<input type="hidden" name="fa_x_file_cv" id= "fa_x_file_cv" value="<?= (Post("fa_x_file_cv") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_file_cv" id= "fs_x_file_cv" value="255">
<input type="hidden" name="fx_x_file_cv" id= "fx_x_file_cv" value="<?= $Page->file_cv->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_file_cv" id= "fm_x_file_cv" value="<?= $Page->file_cv->UploadMaxFileSize ?>">
<table id="ft_x_file_cv" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="pegawai" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
<?php
    if (in_array("peg_dokumen", explode(",", $Page->getCurrentDetailTable())) && $peg_dokumen->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("peg_dokumen", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PegDokumenGrid.php" ?>
<?php } ?>
<?php
    if (in_array("peg_keluarga", explode(",", $Page->getCurrentDetailTable())) && $peg_keluarga->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("peg_keluarga", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PegKeluargaGrid.php" ?>
<?php } ?>
<?php
    if (in_array("peg_skill", explode(",", $Page->getCurrentDetailTable())) && $peg_skill->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("peg_skill", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PegSkillGrid.php" ?>
<?php } ?>
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
    ew.addEventHandlers("pegawai");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
