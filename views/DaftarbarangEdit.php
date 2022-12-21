<?php

namespace PHPMaker2022\sigap;

// Page object
$DaftarbarangEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { daftarbarang: currentTable } });
var currentForm, currentPageID;
var fdaftarbarangedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fdaftarbarangedit = new ew.Form("fdaftarbarangedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fdaftarbarangedit;

    // Add fields
    var fields = currentTable.fields;
    fdaftarbarangedit.addFields([
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["jenis", [fields.jenis.visible && fields.jenis.required ? ew.Validators.required(fields.jenis.caption) : null], fields.jenis.isInvalid],
        ["sepsifikasi", [fields.sepsifikasi.visible && fields.sepsifikasi.required ? ew.Validators.required(fields.sepsifikasi.caption) : null], fields.sepsifikasi.isInvalid],
        ["deskripsi", [fields.deskripsi.visible && fields.deskripsi.required ? ew.Validators.required(fields.deskripsi.caption) : null], fields.deskripsi.isInvalid],
        ["tgl_terima", [fields.tgl_terima.visible && fields.tgl_terima.required ? ew.Validators.required(fields.tgl_terima.caption) : null, ew.Validators.datetime(fields.tgl_terima.clientFormatPattern)], fields.tgl_terima.isInvalid],
        ["tgl_beli", [fields.tgl_beli.visible && fields.tgl_beli.required ? ew.Validators.required(fields.tgl_beli.caption) : null, ew.Validators.datetime(fields.tgl_beli.clientFormatPattern)], fields.tgl_beli.isInvalid],
        ["harga", [fields.harga.visible && fields.harga.required ? ew.Validators.required(fields.harga.caption) : null, ew.Validators.integer], fields.harga.isInvalid],
        ["pemegang", [fields.pemegang.visible && fields.pemegang.required ? ew.Validators.required(fields.pemegang.caption) : null, ew.Validators.integer], fields.pemegang.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
        ["foto", [fields.foto.visible && fields.foto.required ? ew.Validators.fileRequired(fields.foto.caption) : null], fields.foto.isInvalid],
        ["dokumen", [fields.dokumen.visible && fields.dokumen.required ? ew.Validators.fileRequired(fields.dokumen.caption) : null], fields.dokumen.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid]
    ]);

    // Form_CustomValidate
    fdaftarbarangedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fdaftarbarangedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fdaftarbarangedit.lists.jenis = <?= $Page->jenis->toClientList($Page) ?>;
    fdaftarbarangedit.lists.pemegang = <?= $Page->pemegang->toClientList($Page) ?>;
    loadjs.done("fdaftarbarangedit");
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
<form name="fdaftarbarangedit" id="fdaftarbarangedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="daftarbarang">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <label id="elh_daftarbarang_nama" for="x_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama->cellAttributes() ?>>
<span id="el_daftarbarang_nama">
<input type="<?= $Page->nama->getInputTextType() ?>" name="x_nama" id="x_nama" data-table="daftarbarang" data-field="x_nama" value="<?= $Page->nama->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>"<?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
<?= $Page->nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <div id="r_jenis"<?= $Page->jenis->rowAttributes() ?>>
        <label id="elh_daftarbarang_jenis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis->caption() ?><?= $Page->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenis->cellAttributes() ?>>
<span id="el_daftarbarang_jenis">
    <select
        id="x_jenis"
        name="x_jenis"
        class="form-control ew-select<?= $Page->jenis->isInvalidClass() ?>"
        data-select2-id="fdaftarbarangedit_x_jenis"
        data-table="daftarbarang"
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
loadjs.ready("fdaftarbarangedit", function() {
    var options = { name: "x_jenis", selectId: "fdaftarbarangedit_x_jenis" };
    if (fdaftarbarangedit.lists.jenis.lookupOptions.length) {
        options.data = { id: "x_jenis", form: "fdaftarbarangedit" };
    } else {
        options.ajax = { id: "x_jenis", form: "fdaftarbarangedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.daftarbarang.fields.jenis.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->sepsifikasi->Visible) { // sepsifikasi ?>
    <div id="r_sepsifikasi"<?= $Page->sepsifikasi->rowAttributes() ?>>
        <label id="elh_daftarbarang_sepsifikasi" for="x_sepsifikasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->sepsifikasi->caption() ?><?= $Page->sepsifikasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->sepsifikasi->cellAttributes() ?>>
<span id="el_daftarbarang_sepsifikasi">
<input type="<?= $Page->sepsifikasi->getInputTextType() ?>" name="x_sepsifikasi" id="x_sepsifikasi" data-table="daftarbarang" data-field="x_sepsifikasi" value="<?= $Page->sepsifikasi->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->sepsifikasi->getPlaceHolder()) ?>"<?= $Page->sepsifikasi->editAttributes() ?> aria-describedby="x_sepsifikasi_help">
<?= $Page->sepsifikasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->sepsifikasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->deskripsi->Visible) { // deskripsi ?>
    <div id="r_deskripsi"<?= $Page->deskripsi->rowAttributes() ?>>
        <label id="elh_daftarbarang_deskripsi" for="x_deskripsi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->deskripsi->caption() ?><?= $Page->deskripsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->deskripsi->cellAttributes() ?>>
<span id="el_daftarbarang_deskripsi">
<input type="<?= $Page->deskripsi->getInputTextType() ?>" name="x_deskripsi" id="x_deskripsi" data-table="daftarbarang" data-field="x_deskripsi" value="<?= $Page->deskripsi->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->deskripsi->getPlaceHolder()) ?>"<?= $Page->deskripsi->editAttributes() ?> aria-describedby="x_deskripsi_help">
<?= $Page->deskripsi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->deskripsi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_terima->Visible) { // tgl_terima ?>
    <div id="r_tgl_terima"<?= $Page->tgl_terima->rowAttributes() ?>>
        <label id="elh_daftarbarang_tgl_terima" for="x_tgl_terima" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_terima->caption() ?><?= $Page->tgl_terima->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_terima->cellAttributes() ?>>
<span id="el_daftarbarang_tgl_terima">
<input type="<?= $Page->tgl_terima->getInputTextType() ?>" name="x_tgl_terima" id="x_tgl_terima" data-table="daftarbarang" data-field="x_tgl_terima" value="<?= $Page->tgl_terima->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_terima->getPlaceHolder()) ?>"<?= $Page->tgl_terima->editAttributes() ?> aria-describedby="x_tgl_terima_help">
<?= $Page->tgl_terima->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_terima->getErrorMessage() ?></div>
<?php if (!$Page->tgl_terima->ReadOnly && !$Page->tgl_terima->Disabled && !isset($Page->tgl_terima->EditAttrs["readonly"]) && !isset($Page->tgl_terima->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdaftarbarangedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdaftarbarangedit", "x_tgl_terima", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_beli->Visible) { // tgl_beli ?>
    <div id="r_tgl_beli"<?= $Page->tgl_beli->rowAttributes() ?>>
        <label id="elh_daftarbarang_tgl_beli" for="x_tgl_beli" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_beli->caption() ?><?= $Page->tgl_beli->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_beli->cellAttributes() ?>>
<span id="el_daftarbarang_tgl_beli">
<input type="<?= $Page->tgl_beli->getInputTextType() ?>" name="x_tgl_beli" id="x_tgl_beli" data-table="daftarbarang" data-field="x_tgl_beli" value="<?= $Page->tgl_beli->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_beli->getPlaceHolder()) ?>"<?= $Page->tgl_beli->editAttributes() ?> aria-describedby="x_tgl_beli_help">
<?= $Page->tgl_beli->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_beli->getErrorMessage() ?></div>
<?php if (!$Page->tgl_beli->ReadOnly && !$Page->tgl_beli->Disabled && !isset($Page->tgl_beli->EditAttrs["readonly"]) && !isset($Page->tgl_beli->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fdaftarbarangedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fdaftarbarangedit", "x_tgl_beli", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->harga->Visible) { // harga ?>
    <div id="r_harga"<?= $Page->harga->rowAttributes() ?>>
        <label id="elh_daftarbarang_harga" for="x_harga" class="<?= $Page->LeftColumnClass ?>"><?= $Page->harga->caption() ?><?= $Page->harga->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->harga->cellAttributes() ?>>
<span id="el_daftarbarang_harga">
<input type="<?= $Page->harga->getInputTextType() ?>" name="x_harga" id="x_harga" data-table="daftarbarang" data-field="x_harga" value="<?= $Page->harga->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->harga->getPlaceHolder()) ?>"<?= $Page->harga->editAttributes() ?> aria-describedby="x_harga_help">
<?= $Page->harga->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->harga->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pemegang->Visible) { // pemegang ?>
    <div id="r_pemegang"<?= $Page->pemegang->rowAttributes() ?>>
        <label id="elh_daftarbarang_pemegang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pemegang->caption() ?><?= $Page->pemegang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pemegang->cellAttributes() ?>>
<span id="el_daftarbarang_pemegang">
    <select
        id="x_pemegang"
        name="x_pemegang"
        class="form-control ew-select<?= $Page->pemegang->isInvalidClass() ?>"
        data-select2-id="fdaftarbarangedit_x_pemegang"
        data-table="daftarbarang"
        data-field="x_pemegang"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->pemegang->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->pemegang->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->pemegang->getPlaceHolder()) ?>"
        <?= $Page->pemegang->editAttributes() ?>>
        <?= $Page->pemegang->selectOptionListHtml("x_pemegang") ?>
    </select>
    <?= $Page->pemegang->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->pemegang->getErrorMessage() ?></div>
<?= $Page->pemegang->Lookup->getParamTag($Page, "p_x_pemegang") ?>
<script>
loadjs.ready("fdaftarbarangedit", function() {
    var options = { name: "x_pemegang", selectId: "fdaftarbarangedit_x_pemegang" };
    if (fdaftarbarangedit.lists.pemegang.lookupOptions.length) {
        options.data = { id: "x_pemegang", form: "fdaftarbarangedit" };
    } else {
        options.ajax = { id: "x_pemegang", form: "fdaftarbarangedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.daftarbarang.fields.pemegang.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <div id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_daftarbarang_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_daftarbarang_keterangan">
<input type="<?= $Page->keterangan->getInputTextType() ?>" name="x_keterangan" id="x_keterangan" data-table="daftarbarang" data-field="x_keterangan" value="<?= $Page->keterangan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help">
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->foto->Visible) { // foto ?>
    <div id="r_foto"<?= $Page->foto->rowAttributes() ?>>
        <label id="elh_daftarbarang_foto" class="<?= $Page->LeftColumnClass ?>"><?= $Page->foto->caption() ?><?= $Page->foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->foto->cellAttributes() ?>>
<span id="el_daftarbarang_foto">
<div id="fd_x_foto" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->foto->title() ?>" data-table="daftarbarang" data-field="x_foto" name="x_foto" id="x_foto" lang="<?= CurrentLanguageID() ?>"<?= $Page->foto->editAttributes() ?> aria-describedby="x_foto_help"<?= ($Page->foto->ReadOnly || $Page->foto->Disabled) ? " disabled" : "" ?>>
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
<?php if ($Page->dokumen->Visible) { // dokumen ?>
    <div id="r_dokumen"<?= $Page->dokumen->rowAttributes() ?>>
        <label id="elh_daftarbarang_dokumen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dokumen->caption() ?><?= $Page->dokumen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dokumen->cellAttributes() ?>>
<span id="el_daftarbarang_dokumen">
<div id="fd_x_dokumen" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->dokumen->title() ?>" data-table="daftarbarang" data-field="x_dokumen" name="x_dokumen" id="x_dokumen" lang="<?= CurrentLanguageID() ?>"<?= $Page->dokumen->editAttributes() ?> aria-describedby="x_dokumen_help"<?= ($Page->dokumen->ReadOnly || $Page->dokumen->Disabled) ? " disabled" : "" ?>>
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
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status"<?= $Page->status->rowAttributes() ?>>
        <label id="elh_daftarbarang_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->status->cellAttributes() ?>>
<span id="el_daftarbarang_status">
<input type="<?= $Page->status->getInputTextType() ?>" name="x_status" id="x_status" data-table="daftarbarang" data-field="x_status" value="<?= $Page->status->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="daftarbarang" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("daftarbarang");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
