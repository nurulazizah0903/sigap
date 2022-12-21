<?php

namespace PHPMaker2022\sigap;

// Page object
$JenisIjinEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jenis_ijin: currentTable } });
var currentForm, currentPageID;
var fjenis_ijinedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjenis_ijinedit = new ew.Form("fjenis_ijinedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fjenis_ijinedit;

    // Add fields
    var fields = currentTable.fields;
    fjenis_ijinedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["jenjang_id", [fields.jenjang_id.visible && fields.jenjang_id.required ? ew.Validators.required(fields.jenjang_id.caption) : null, ew.Validators.integer], fields.jenjang_id.isInvalid],
        ["jabatan_id", [fields.jabatan_id.visible && fields.jabatan_id.required ? ew.Validators.required(fields.jabatan_id.caption) : null, ew.Validators.integer], fields.jabatan_id.isInvalid],
        ["nama", [fields.nama.visible && fields.nama.required ? ew.Validators.required(fields.nama.caption) : null], fields.nama.isInvalid],
        ["aktif", [fields.aktif.visible && fields.aktif.required ? ew.Validators.required(fields.aktif.caption) : null], fields.aktif.isInvalid],
        ["value", [fields.value.visible && fields.value.required ? ew.Validators.required(fields.value.caption) : null, ew.Validators.integer], fields.value.isInvalid],
        ["valueperjam", [fields.valueperjam.visible && fields.valueperjam.required ? ew.Validators.required(fields.valueperjam.caption) : null, ew.Validators.integer], fields.valueperjam.isInvalid]
    ]);

    // Form_CustomValidate
    fjenis_ijinedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fjenis_ijinedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fjenis_ijinedit.lists.jenjang_id = <?= $Page->jenjang_id->toClientList($Page) ?>;
    fjenis_ijinedit.lists.jabatan_id = <?= $Page->jabatan_id->toClientList($Page) ?>;
    loadjs.done("fjenis_ijinedit");
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
<form name="fjenis_ijinedit" id="fjenis_ijinedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jenis_ijin">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_jenis_ijin_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_jenis_ijin_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="jenis_ijin" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
    <div id="r_jenjang_id"<?= $Page->jenjang_id->rowAttributes() ?>>
        <label id="elh_jenis_ijin_jenjang_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenjang_id->caption() ?><?= $Page->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el_jenis_ijin_jenjang_id">
    <select
        id="x_jenjang_id"
        name="x_jenjang_id"
        class="form-control ew-select<?= $Page->jenjang_id->isInvalidClass() ?>"
        data-select2-id="fjenis_ijinedit_x_jenjang_id"
        data-table="jenis_ijin"
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
loadjs.ready("fjenis_ijinedit", function() {
    var options = { name: "x_jenjang_id", selectId: "fjenis_ijinedit_x_jenjang_id" };
    if (fjenis_ijinedit.lists.jenjang_id.lookupOptions.length) {
        options.data = { id: "x_jenjang_id", form: "fjenis_ijinedit" };
    } else {
        options.ajax = { id: "x_jenjang_id", form: "fjenis_ijinedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.jenis_ijin.fields.jenjang_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
    <div id="r_jabatan_id"<?= $Page->jabatan_id->rowAttributes() ?>>
        <label id="elh_jenis_ijin_jabatan_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jabatan_id->caption() ?><?= $Page->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el_jenis_ijin_jabatan_id">
    <select
        id="x_jabatan_id"
        name="x_jabatan_id"
        class="form-control ew-select<?= $Page->jabatan_id->isInvalidClass() ?>"
        data-select2-id="fjenis_ijinedit_x_jabatan_id"
        data-table="jenis_ijin"
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
loadjs.ready("fjenis_ijinedit", function() {
    var options = { name: "x_jabatan_id", selectId: "fjenis_ijinedit_x_jabatan_id" };
    if (fjenis_ijinedit.lists.jabatan_id.lookupOptions.length) {
        options.data = { id: "x_jabatan_id", form: "fjenis_ijinedit" };
    } else {
        options.ajax = { id: "x_jabatan_id", form: "fjenis_ijinedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.jenis_ijin.fields.jabatan_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <div id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <label id="elh_jenis_ijin_nama" for="x_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama->caption() ?><?= $Page->nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama->cellAttributes() ?>>
<span id="el_jenis_ijin_nama">
<input type="<?= $Page->nama->getInputTextType() ?>" name="x_nama" id="x_nama" data-table="jenis_ijin" data-field="x_nama" value="<?= $Page->nama->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama->getPlaceHolder()) ?>"<?= $Page->nama->editAttributes() ?> aria-describedby="x_nama_help">
<?= $Page->nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
    <div id="r_aktif"<?= $Page->aktif->rowAttributes() ?>>
        <label id="elh_jenis_ijin_aktif" for="x_aktif" class="<?= $Page->LeftColumnClass ?>"><?= $Page->aktif->caption() ?><?= $Page->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aktif->cellAttributes() ?>>
<span id="el_jenis_ijin_aktif">
<input type="<?= $Page->aktif->getInputTextType() ?>" name="x_aktif" id="x_aktif" data-table="jenis_ijin" data-field="x_aktif" value="<?= $Page->aktif->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->aktif->getPlaceHolder()) ?>"<?= $Page->aktif->editAttributes() ?> aria-describedby="x_aktif_help">
<?= $Page->aktif->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->aktif->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->value->Visible) { // value ?>
    <div id="r_value"<?= $Page->value->rowAttributes() ?>>
        <label id="elh_jenis_ijin_value" for="x_value" class="<?= $Page->LeftColumnClass ?>"><?= $Page->value->caption() ?><?= $Page->value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->value->cellAttributes() ?>>
<span id="el_jenis_ijin_value">
<input type="<?= $Page->value->getInputTextType() ?>" name="x_value" id="x_value" data-table="jenis_ijin" data-field="x_value" value="<?= $Page->value->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->value->getPlaceHolder()) ?>"<?= $Page->value->editAttributes() ?> aria-describedby="x_value_help">
<?= $Page->value->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->value->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->valueperjam->Visible) { // valueperjam ?>
    <div id="r_valueperjam"<?= $Page->valueperjam->rowAttributes() ?>>
        <label id="elh_jenis_ijin_valueperjam" for="x_valueperjam" class="<?= $Page->LeftColumnClass ?>"><?= $Page->valueperjam->caption() ?><?= $Page->valueperjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->valueperjam->cellAttributes() ?>>
<span id="el_jenis_ijin_valueperjam">
<input type="<?= $Page->valueperjam->getInputTextType() ?>" name="x_valueperjam" id="x_valueperjam" data-table="jenis_ijin" data-field="x_valueperjam" value="<?= $Page->valueperjam->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->valueperjam->getPlaceHolder()) ?>"<?= $Page->valueperjam->editAttributes() ?> aria-describedby="x_valueperjam_help">
<?= $Page->valueperjam->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->valueperjam->getErrorMessage() ?></div>
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
    ew.addEventHandlers("jenis_ijin");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
