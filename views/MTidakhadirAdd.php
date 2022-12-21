<?php

namespace PHPMaker2022\sigap;

// Page object
$MTidakhadirAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { m_tidakhadir: currentTable } });
var currentForm, currentPageID;
var fm_tidakhadiradd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fm_tidakhadiradd = new ew.Form("fm_tidakhadiradd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fm_tidakhadiradd;

    // Add fields
    var fields = currentTable.fields;
    fm_tidakhadiradd.addFields([
        ["jenjang_id", [fields.jenjang_id.visible && fields.jenjang_id.required ? ew.Validators.required(fields.jenjang_id.caption) : null, ew.Validators.integer], fields.jenjang_id.isInvalid],
        ["jabatan_id", [fields.jabatan_id.visible && fields.jabatan_id.required ? ew.Validators.required(fields.jabatan_id.caption) : null, ew.Validators.integer], fields.jabatan_id.isInvalid],
        ["value", [fields.value.visible && fields.value.required ? ew.Validators.required(fields.value.caption) : null, ew.Validators.integer], fields.value.isInvalid],
        ["perjam_value", [fields.perjam_value.visible && fields.perjam_value.required ? ew.Validators.required(fields.perjam_value.caption) : null, ew.Validators.integer], fields.perjam_value.isInvalid]
    ]);

    // Form_CustomValidate
    fm_tidakhadiradd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fm_tidakhadiradd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fm_tidakhadiradd.lists.jenjang_id = <?= $Page->jenjang_id->toClientList($Page) ?>;
    fm_tidakhadiradd.lists.jabatan_id = <?= $Page->jabatan_id->toClientList($Page) ?>;
    loadjs.done("fm_tidakhadiradd");
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
<form name="fm_tidakhadiradd" id="fm_tidakhadiradd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="m_tidakhadir">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
    <div id="r_jenjang_id"<?= $Page->jenjang_id->rowAttributes() ?>>
        <label id="elh_m_tidakhadir_jenjang_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenjang_id->caption() ?><?= $Page->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el_m_tidakhadir_jenjang_id">
    <select
        id="x_jenjang_id"
        name="x_jenjang_id"
        class="form-control ew-select<?= $Page->jenjang_id->isInvalidClass() ?>"
        data-select2-id="fm_tidakhadiradd_x_jenjang_id"
        data-table="m_tidakhadir"
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
loadjs.ready("fm_tidakhadiradd", function() {
    var options = { name: "x_jenjang_id", selectId: "fm_tidakhadiradd_x_jenjang_id" };
    if (fm_tidakhadiradd.lists.jenjang_id.lookupOptions.length) {
        options.data = { id: "x_jenjang_id", form: "fm_tidakhadiradd" };
    } else {
        options.ajax = { id: "x_jenjang_id", form: "fm_tidakhadiradd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.m_tidakhadir.fields.jenjang_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
    <div id="r_jabatan_id"<?= $Page->jabatan_id->rowAttributes() ?>>
        <label id="elh_m_tidakhadir_jabatan_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jabatan_id->caption() ?><?= $Page->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el_m_tidakhadir_jabatan_id">
    <select
        id="x_jabatan_id"
        name="x_jabatan_id"
        class="form-control ew-select<?= $Page->jabatan_id->isInvalidClass() ?>"
        data-select2-id="fm_tidakhadiradd_x_jabatan_id"
        data-table="m_tidakhadir"
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
loadjs.ready("fm_tidakhadiradd", function() {
    var options = { name: "x_jabatan_id", selectId: "fm_tidakhadiradd_x_jabatan_id" };
    if (fm_tidakhadiradd.lists.jabatan_id.lookupOptions.length) {
        options.data = { id: "x_jabatan_id", form: "fm_tidakhadiradd" };
    } else {
        options.ajax = { id: "x_jabatan_id", form: "fm_tidakhadiradd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.m_tidakhadir.fields.jabatan_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->value->Visible) { // value ?>
    <div id="r_value"<?= $Page->value->rowAttributes() ?>>
        <label id="elh_m_tidakhadir_value" for="x_value" class="<?= $Page->LeftColumnClass ?>"><?= $Page->value->caption() ?><?= $Page->value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->value->cellAttributes() ?>>
<span id="el_m_tidakhadir_value">
<input type="<?= $Page->value->getInputTextType() ?>" name="x_value" id="x_value" data-table="m_tidakhadir" data-field="x_value" value="<?= $Page->value->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->value->getPlaceHolder()) ?>"<?= $Page->value->editAttributes() ?> aria-describedby="x_value_help">
<?= $Page->value->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->value->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->perjam_value->Visible) { // perjam_value ?>
    <div id="r_perjam_value"<?= $Page->perjam_value->rowAttributes() ?>>
        <label id="elh_m_tidakhadir_perjam_value" for="x_perjam_value" class="<?= $Page->LeftColumnClass ?>"><?= $Page->perjam_value->caption() ?><?= $Page->perjam_value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->perjam_value->cellAttributes() ?>>
<span id="el_m_tidakhadir_perjam_value">
<input type="<?= $Page->perjam_value->getInputTextType() ?>" name="x_perjam_value" id="x_perjam_value" data-table="m_tidakhadir" data-field="x_perjam_value" value="<?= $Page->perjam_value->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->perjam_value->getPlaceHolder()) ?>"<?= $Page->perjam_value->editAttributes() ?> aria-describedby="x_perjam_value_help">
<?= $Page->perjam_value->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->perjam_value->getErrorMessage() ?></div>
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
    ew.addEventHandlers("m_tidakhadir");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
