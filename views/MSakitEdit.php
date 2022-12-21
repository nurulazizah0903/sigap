<?php

namespace PHPMaker2022\sigap;

// Page object
$MSakitEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { m_sakit: currentTable } });
var currentForm, currentPageID;
var fm_sakitedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fm_sakitedit = new ew.Form("fm_sakitedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fm_sakitedit;

    // Add fields
    var fields = currentTable.fields;
    fm_sakitedit.addFields([
        ["jenjang_id", [fields.jenjang_id.visible && fields.jenjang_id.required ? ew.Validators.required(fields.jenjang_id.caption) : null, ew.Validators.integer], fields.jenjang_id.isInvalid],
        ["jabatan", [fields.jabatan.visible && fields.jabatan.required ? ew.Validators.required(fields.jabatan.caption) : null, ew.Validators.integer], fields.jabatan.isInvalid],
        ["perhari", [fields.perhari.visible && fields.perhari.required ? ew.Validators.required(fields.perhari.caption) : null, ew.Validators.integer], fields.perhari.isInvalid],
        ["perjam", [fields.perjam.visible && fields.perjam.required ? ew.Validators.required(fields.perjam.caption) : null, ew.Validators.integer], fields.perjam.isInvalid]
    ]);

    // Form_CustomValidate
    fm_sakitedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fm_sakitedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fm_sakitedit.lists.jenjang_id = <?= $Page->jenjang_id->toClientList($Page) ?>;
    fm_sakitedit.lists.jabatan = <?= $Page->jabatan->toClientList($Page) ?>;
    loadjs.done("fm_sakitedit");
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
<form name="fm_sakitedit" id="fm_sakitedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_sakit">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
    <div id="r_jenjang_id"<?= $Page->jenjang_id->rowAttributes() ?>>
        <label id="elh_m_sakit_jenjang_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenjang_id->caption() ?><?= $Page->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el_m_sakit_jenjang_id">
    <select
        id="x_jenjang_id"
        name="x_jenjang_id"
        class="form-control ew-select<?= $Page->jenjang_id->isInvalidClass() ?>"
        data-select2-id="fm_sakitedit_x_jenjang_id"
        data-table="m_sakit"
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
loadjs.ready("fm_sakitedit", function() {
    var options = { name: "x_jenjang_id", selectId: "fm_sakitedit_x_jenjang_id" };
    if (fm_sakitedit.lists.jenjang_id.lookupOptions.length) {
        options.data = { id: "x_jenjang_id", form: "fm_sakitedit" };
    } else {
        options.ajax = { id: "x_jenjang_id", form: "fm_sakitedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.m_sakit.fields.jenjang_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
    <div id="r_jabatan"<?= $Page->jabatan->rowAttributes() ?>>
        <label id="elh_m_sakit_jabatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jabatan->caption() ?><?= $Page->jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jabatan->cellAttributes() ?>>
<span id="el_m_sakit_jabatan">
    <select
        id="x_jabatan"
        name="x_jabatan"
        class="form-control ew-select<?= $Page->jabatan->isInvalidClass() ?>"
        data-select2-id="fm_sakitedit_x_jabatan"
        data-table="m_sakit"
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
loadjs.ready("fm_sakitedit", function() {
    var options = { name: "x_jabatan", selectId: "fm_sakitedit_x_jabatan" };
    if (fm_sakitedit.lists.jabatan.lookupOptions.length) {
        options.data = { id: "x_jabatan", form: "fm_sakitedit" };
    } else {
        options.ajax = { id: "x_jabatan", form: "fm_sakitedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.m_sakit.fields.jabatan.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->perhari->Visible) { // perhari ?>
    <div id="r_perhari"<?= $Page->perhari->rowAttributes() ?>>
        <label id="elh_m_sakit_perhari" for="x_perhari" class="<?= $Page->LeftColumnClass ?>"><?= $Page->perhari->caption() ?><?= $Page->perhari->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->perhari->cellAttributes() ?>>
<span id="el_m_sakit_perhari">
<input type="<?= $Page->perhari->getInputTextType() ?>" name="x_perhari" id="x_perhari" data-table="m_sakit" data-field="x_perhari" value="<?= $Page->perhari->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->perhari->getPlaceHolder()) ?>"<?= $Page->perhari->editAttributes() ?> aria-describedby="x_perhari_help">
<?= $Page->perhari->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->perhari->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->perjam->Visible) { // perjam ?>
    <div id="r_perjam"<?= $Page->perjam->rowAttributes() ?>>
        <label id="elh_m_sakit_perjam" for="x_perjam" class="<?= $Page->LeftColumnClass ?>"><?= $Page->perjam->caption() ?><?= $Page->perjam->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->perjam->cellAttributes() ?>>
<span id="el_m_sakit_perjam">
<input type="<?= $Page->perjam->getInputTextType() ?>" name="x_perjam" id="x_perjam" data-table="m_sakit" data-field="x_perjam" value="<?= $Page->perjam->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->perjam->getPlaceHolder()) ?>"<?= $Page->perjam->editAttributes() ?> aria-describedby="x_perjam_help">
<?= $Page->perjam->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->perjam->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="m_sakit" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("m_sakit");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
