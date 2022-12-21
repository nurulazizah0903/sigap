<?php

namespace PHPMaker2022\sigap;

// Page object
$GajiPokokEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gaji_pokok: currentTable } });
var currentForm, currentPageID;
var fgaji_pokokedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgaji_pokokedit = new ew.Form("fgaji_pokokedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fgaji_pokokedit;

    // Add fields
    var fields = currentTable.fields;
    fgaji_pokokedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["jenjang_id", [fields.jenjang_id.visible && fields.jenjang_id.required ? ew.Validators.required(fields.jenjang_id.caption) : null, ew.Validators.integer], fields.jenjang_id.isInvalid],
        ["ijazah_id", [fields.ijazah_id.visible && fields.ijazah_id.required ? ew.Validators.required(fields.ijazah_id.caption) : null, ew.Validators.integer], fields.ijazah_id.isInvalid],
        ["lama_kerja", [fields.lama_kerja.visible && fields.lama_kerja.required ? ew.Validators.required(fields.lama_kerja.caption) : null, ew.Validators.integer], fields.lama_kerja.isInvalid],
        ["jenis", [fields.jenis.visible && fields.jenis.required ? ew.Validators.required(fields.jenis.caption) : null], fields.jenis.isInvalid],
        ["value", [fields.value.visible && fields.value.required ? ew.Validators.required(fields.value.caption) : null, ew.Validators.integer], fields.value.isInvalid]
    ]);

    // Form_CustomValidate
    fgaji_pokokedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgaji_pokokedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fgaji_pokokedit.lists.jenjang_id = <?= $Page->jenjang_id->toClientList($Page) ?>;
    fgaji_pokokedit.lists.ijazah_id = <?= $Page->ijazah_id->toClientList($Page) ?>;
    fgaji_pokokedit.lists.jenis = <?= $Page->jenis->toClientList($Page) ?>;
    loadjs.done("fgaji_pokokedit");
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
<form name="fgaji_pokokedit" id="fgaji_pokokedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gaji_pokok">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id"<?= $Page->id->rowAttributes() ?>>
        <label id="elh_gaji_pokok_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->id->cellAttributes() ?>>
<span id="el_gaji_pokok_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
<input type="hidden" data-table="gaji_pokok" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
    <div id="r_jenjang_id"<?= $Page->jenjang_id->rowAttributes() ?>>
        <label id="elh_gaji_pokok_jenjang_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenjang_id->caption() ?><?= $Page->jenjang_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el_gaji_pokok_jenjang_id">
    <select
        id="x_jenjang_id"
        name="x_jenjang_id"
        class="form-control ew-select<?= $Page->jenjang_id->isInvalidClass() ?>"
        data-select2-id="fgaji_pokokedit_x_jenjang_id"
        data-table="gaji_pokok"
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
loadjs.ready("fgaji_pokokedit", function() {
    var options = { name: "x_jenjang_id", selectId: "fgaji_pokokedit_x_jenjang_id" };
    if (fgaji_pokokedit.lists.jenjang_id.lookupOptions.length) {
        options.data = { id: "x_jenjang_id", form: "fgaji_pokokedit" };
    } else {
        options.ajax = { id: "x_jenjang_id", form: "fgaji_pokokedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.gaji_pokok.fields.jenjang_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ijazah_id->Visible) { // ijazah_id ?>
    <div id="r_ijazah_id"<?= $Page->ijazah_id->rowAttributes() ?>>
        <label id="elh_gaji_pokok_ijazah_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ijazah_id->caption() ?><?= $Page->ijazah_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ijazah_id->cellAttributes() ?>>
<span id="el_gaji_pokok_ijazah_id">
    <select
        id="x_ijazah_id"
        name="x_ijazah_id"
        class="form-control ew-select<?= $Page->ijazah_id->isInvalidClass() ?>"
        data-select2-id="fgaji_pokokedit_x_ijazah_id"
        data-table="gaji_pokok"
        data-field="x_ijazah_id"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->ijazah_id->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->ijazah_id->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->ijazah_id->getPlaceHolder()) ?>"
        <?= $Page->ijazah_id->editAttributes() ?>>
        <?= $Page->ijazah_id->selectOptionListHtml("x_ijazah_id") ?>
    </select>
    <?= $Page->ijazah_id->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->ijazah_id->getErrorMessage() ?></div>
<?= $Page->ijazah_id->Lookup->getParamTag($Page, "p_x_ijazah_id") ?>
<script>
loadjs.ready("fgaji_pokokedit", function() {
    var options = { name: "x_ijazah_id", selectId: "fgaji_pokokedit_x_ijazah_id" };
    if (fgaji_pokokedit.lists.ijazah_id.lookupOptions.length) {
        options.data = { id: "x_ijazah_id", form: "fgaji_pokokedit" };
    } else {
        options.ajax = { id: "x_ijazah_id", form: "fgaji_pokokedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.gaji_pokok.fields.ijazah_id.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lama_kerja->Visible) { // lama_kerja ?>
    <div id="r_lama_kerja"<?= $Page->lama_kerja->rowAttributes() ?>>
        <label id="elh_gaji_pokok_lama_kerja" for="x_lama_kerja" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lama_kerja->caption() ?><?= $Page->lama_kerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lama_kerja->cellAttributes() ?>>
<span id="el_gaji_pokok_lama_kerja">
<input type="<?= $Page->lama_kerja->getInputTextType() ?>" name="x_lama_kerja" id="x_lama_kerja" data-table="gaji_pokok" data-field="x_lama_kerja" value="<?= $Page->lama_kerja->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->lama_kerja->getPlaceHolder()) ?>"<?= $Page->lama_kerja->editAttributes() ?> aria-describedby="x_lama_kerja_help">
<?= $Page->lama_kerja->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lama_kerja->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis->Visible) { // jenis ?>
    <div id="r_jenis"<?= $Page->jenis->rowAttributes() ?>>
        <label id="elh_gaji_pokok_jenis" for="x_jenis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis->caption() ?><?= $Page->jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenis->cellAttributes() ?>>
<span id="el_gaji_pokok_jenis">
    <select
        id="x_jenis"
        name="x_jenis"
        class="form-select ew-select<?= $Page->jenis->isInvalidClass() ?>"
        data-select2-id="fgaji_pokokedit_x_jenis"
        data-table="gaji_pokok"
        data-field="x_jenis"
        data-value-separator="<?= $Page->jenis->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->jenis->getPlaceHolder()) ?>"
        <?= $Page->jenis->editAttributes() ?>>
        <?= $Page->jenis->selectOptionListHtml("x_jenis") ?>
    </select>
    <?= $Page->jenis->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->jenis->getErrorMessage() ?></div>
<script>
loadjs.ready("fgaji_pokokedit", function() {
    var options = { name: "x_jenis", selectId: "fgaji_pokokedit_x_jenis" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fgaji_pokokedit.lists.jenis.lookupOptions.length) {
        options.data = { id: "x_jenis", form: "fgaji_pokokedit" };
    } else {
        options.ajax = { id: "x_jenis", form: "fgaji_pokokedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.gaji_pokok.fields.jenis.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->value->Visible) { // value ?>
    <div id="r_value"<?= $Page->value->rowAttributes() ?>>
        <label id="elh_gaji_pokok_value" for="x_value" class="<?= $Page->LeftColumnClass ?>"><?= $Page->value->caption() ?><?= $Page->value->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->value->cellAttributes() ?>>
<span id="el_gaji_pokok_value">
<input type="<?= $Page->value->getInputTextType() ?>" name="x_value" id="x_value" data-table="gaji_pokok" data-field="x_value" value="<?= $Page->value->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->value->getPlaceHolder()) ?>"<?= $Page->value->editAttributes() ?> aria-describedby="x_value_help">
<?= $Page->value->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->value->getErrorMessage() ?></div>
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
    ew.addEventHandlers("gaji_pokok");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
