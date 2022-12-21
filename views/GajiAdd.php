<?php

namespace PHPMaker2022\sigap;

// Page object
$GajiAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gaji: currentTable } });
var currentForm, currentPageID;
var fgajiadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajiadd = new ew.Form("fgajiadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fgajiadd;

    // Add fields
    var fields = currentTable.fields;
    fgajiadd.addFields([
        ["jabatan_id", [fields.jabatan_id.visible && fields.jabatan_id.required ? ew.Validators.required(fields.jabatan_id.caption) : null, ew.Validators.integer], fields.jabatan_id.isInvalid],
        ["pegawai", [fields.pegawai.visible && fields.pegawai.required ? ew.Validators.required(fields.pegawai.caption) : null], fields.pegawai.isInvalid],
        ["lembur", [fields.lembur.visible && fields.lembur.required ? ew.Validators.required(fields.lembur.caption) : null, ew.Validators.integer], fields.lembur.isInvalid],
        ["kehadiran", [fields.kehadiran.visible && fields.kehadiran.required ? ew.Validators.required(fields.kehadiran.caption) : null, ew.Validators.integer], fields.kehadiran.isInvalid],
        ["piket_count", [fields.piket_count.visible && fields.piket_count.required ? ew.Validators.required(fields.piket_count.caption) : null, ew.Validators.integer], fields.piket_count.isInvalid],
        ["month", [fields.month.visible && fields.month.required ? ew.Validators.required(fields.month.caption) : null], fields.month.isInvalid],
        ["datetime", [fields.datetime.visible && fields.datetime.required ? ew.Validators.required(fields.datetime.caption) : null], fields.datetime.isInvalid]
    ]);

    // Form_CustomValidate
    fgajiadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgajiadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fgajiadd.lists.jabatan_id = <?= $Page->jabatan_id->toClientList($Page) ?>;
    fgajiadd.lists.pegawai = <?= $Page->pegawai->toClientList($Page) ?>;
    loadjs.done("fgajiadd");
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
<form name="fgajiadd" id="fgajiadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gaji">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
    <div id="r_jabatan_id"<?= $Page->jabatan_id->rowAttributes() ?>>
        <label id="elh_gaji_jabatan_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jabatan_id->caption() ?><?= $Page->jabatan_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el_gaji_jabatan_id">
    <select
        id="x_jabatan_id"
        name="x_jabatan_id"
        class="form-control ew-select<?= $Page->jabatan_id->isInvalidClass() ?>"
        data-select2-id="fgajiadd_x_jabatan_id"
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
loadjs.ready("fgajiadd", function() {
    var options = { name: "x_jabatan_id", selectId: "fgajiadd_x_jabatan_id" };
    if (fgajiadd.lists.jabatan_id.lookupOptions.length) {
        options.data = { id: "x_jabatan_id", form: "fgajiadd" };
    } else {
        options.ajax = { id: "x_jabatan_id", form: "fgajiadd", limit: ew.LOOKUP_PAGE_SIZE };
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
        data-select2-id="fgajiadd_x_pegawai"
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
loadjs.ready("fgajiadd", function() {
    var options = { name: "x_pegawai", selectId: "fgajiadd_x_pegawai" };
    if (fgajiadd.lists.pegawai.lookupOptions.length) {
        options.data = { id: "x_pegawai", form: "fgajiadd" };
    } else {
        options.ajax = { id: "x_pegawai", form: "fgajiadd", limit: ew.LOOKUP_PAGE_SIZE };
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
    ew.addEventHandlers("gaji");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
