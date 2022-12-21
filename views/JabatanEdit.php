<?php

namespace PHPMaker2022\sigap;

// Page object
$JabatanEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { jabatan: currentTable } });
var currentForm, currentPageID;
var fjabatanedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fjabatanedit = new ew.Form("fjabatanedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fjabatanedit;

    // Add fields
    var fields = currentTable.fields;
    fjabatanedit.addFields([
        ["jenjang", [fields.jenjang.visible && fields.jenjang.required ? ew.Validators.required(fields.jenjang.caption) : null, ew.Validators.integer], fields.jenjang.isInvalid],
        ["nama_jabatan", [fields.nama_jabatan.visible && fields.nama_jabatan.required ? ew.Validators.required(fields.nama_jabatan.caption) : null], fields.nama_jabatan.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
        ["c_date", [fields.c_date.visible && fields.c_date.required ? ew.Validators.required(fields.c_date.caption) : null, ew.Validators.datetime(fields.c_date.clientFormatPattern)], fields.c_date.isInvalid],
        ["u_date", [fields.u_date.visible && fields.u_date.required ? ew.Validators.required(fields.u_date.caption) : null], fields.u_date.isInvalid],
        ["c_by", [fields.c_by.visible && fields.c_by.required ? ew.Validators.required(fields.c_by.caption) : null, ew.Validators.integer], fields.c_by.isInvalid],
        ["u_by", [fields.u_by.visible && fields.u_by.required ? ew.Validators.required(fields.u_by.caption) : null], fields.u_by.isInvalid],
        ["aktif", [fields.aktif.visible && fields.aktif.required ? ew.Validators.required(fields.aktif.caption) : null, ew.Validators.integer], fields.aktif.isInvalid]
    ]);

    // Form_CustomValidate
    fjabatanedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fjabatanedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fjabatanedit.lists.jenjang = <?= $Page->jenjang->toClientList($Page) ?>;
    fjabatanedit.lists.c_by = <?= $Page->c_by->toClientList($Page) ?>;
    loadjs.done("fjabatanedit");
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
<form name="fjabatanedit" id="fjabatanedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="jabatan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->jenjang->Visible) { // jenjang ?>
    <div id="r_jenjang"<?= $Page->jenjang->rowAttributes() ?>>
        <label id="elh_jabatan_jenjang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenjang->caption() ?><?= $Page->jenjang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jenjang->cellAttributes() ?>>
<span id="el_jabatan_jenjang">
    <select
        id="x_jenjang"
        name="x_jenjang"
        class="form-control ew-select<?= $Page->jenjang->isInvalidClass() ?>"
        data-select2-id="fjabatanedit_x_jenjang"
        data-table="jabatan"
        data-field="x_jenjang"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->jenjang->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->jenjang->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->jenjang->getPlaceHolder()) ?>"
        <?= $Page->jenjang->editAttributes() ?>>
        <?= $Page->jenjang->selectOptionListHtml("x_jenjang") ?>
    </select>
    <?= $Page->jenjang->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->jenjang->getErrorMessage() ?></div>
<?= $Page->jenjang->Lookup->getParamTag($Page, "p_x_jenjang") ?>
<script>
loadjs.ready("fjabatanedit", function() {
    var options = { name: "x_jenjang", selectId: "fjabatanedit_x_jenjang" };
    if (fjabatanedit.lists.jenjang.lookupOptions.length) {
        options.data = { id: "x_jenjang", form: "fjabatanedit" };
    } else {
        options.ajax = { id: "x_jenjang", form: "fjabatanedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.jabatan.fields.jenjang.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nama_jabatan->Visible) { // nama_jabatan ?>
    <div id="r_nama_jabatan"<?= $Page->nama_jabatan->rowAttributes() ?>>
        <label id="elh_jabatan_nama_jabatan" for="x_nama_jabatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nama_jabatan->caption() ?><?= $Page->nama_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nama_jabatan->cellAttributes() ?>>
<span id="el_jabatan_nama_jabatan">
<input type="<?= $Page->nama_jabatan->getInputTextType() ?>" name="x_nama_jabatan" id="x_nama_jabatan" data-table="jabatan" data-field="x_nama_jabatan" value="<?= $Page->nama_jabatan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->nama_jabatan->getPlaceHolder()) ?>"<?= $Page->nama_jabatan->editAttributes() ?> aria-describedby="x_nama_jabatan_help">
<?= $Page->nama_jabatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nama_jabatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <div id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_jabatan_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_jabatan_keterangan">
<input type="<?= $Page->keterangan->getInputTextType() ?>" name="x_keterangan" id="x_keterangan" data-table="jabatan" data-field="x_keterangan" value="<?= $Page->keterangan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help">
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->c_date->Visible) { // c_date ?>
    <div id="r_c_date"<?= $Page->c_date->rowAttributes() ?>>
        <label id="elh_jabatan_c_date" for="x_c_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->c_date->caption() ?><?= $Page->c_date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->c_date->cellAttributes() ?>>
<span id="el_jabatan_c_date">
<input type="<?= $Page->c_date->getInputTextType() ?>" name="x_c_date" id="x_c_date" data-table="jabatan" data-field="x_c_date" value="<?= $Page->c_date->EditValue ?>" placeholder="<?= HtmlEncode($Page->c_date->getPlaceHolder()) ?>"<?= $Page->c_date->editAttributes() ?> aria-describedby="x_c_date_help">
<?= $Page->c_date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->c_date->getErrorMessage() ?></div>
<?php if (!$Page->c_date->ReadOnly && !$Page->c_date->Disabled && !isset($Page->c_date->EditAttrs["readonly"]) && !isset($Page->c_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fjabatanedit", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fjabatanedit", "x_c_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->c_by->Visible) { // c_by ?>
    <div id="r_c_by"<?= $Page->c_by->rowAttributes() ?>>
        <label id="elh_jabatan_c_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->c_by->caption() ?><?= $Page->c_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->c_by->cellAttributes() ?>>
<span id="el_jabatan_c_by">
    <select
        id="x_c_by"
        name="x_c_by"
        class="form-control ew-select<?= $Page->c_by->isInvalidClass() ?>"
        data-select2-id="fjabatanedit_x_c_by"
        data-table="jabatan"
        data-field="x_c_by"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->c_by->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->c_by->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->c_by->getPlaceHolder()) ?>"
        <?= $Page->c_by->editAttributes() ?>>
        <?= $Page->c_by->selectOptionListHtml("x_c_by") ?>
    </select>
    <?= $Page->c_by->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->c_by->getErrorMessage() ?></div>
<?= $Page->c_by->Lookup->getParamTag($Page, "p_x_c_by") ?>
<script>
loadjs.ready("fjabatanedit", function() {
    var options = { name: "x_c_by", selectId: "fjabatanedit_x_c_by" };
    if (fjabatanedit.lists.c_by.lookupOptions.length) {
        options.data = { id: "x_c_by", form: "fjabatanedit" };
    } else {
        options.ajax = { id: "x_c_by", form: "fjabatanedit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.jabatan.fields.c_by.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
    <div id="r_aktif"<?= $Page->aktif->rowAttributes() ?>>
        <label id="elh_jabatan_aktif" for="x_aktif" class="<?= $Page->LeftColumnClass ?>"><?= $Page->aktif->caption() ?><?= $Page->aktif->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->aktif->cellAttributes() ?>>
<span id="el_jabatan_aktif">
<input type="<?= $Page->aktif->getInputTextType() ?>" name="x_aktif" id="x_aktif" data-table="jabatan" data-field="x_aktif" value="<?= $Page->aktif->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->aktif->getPlaceHolder()) ?>"<?= $Page->aktif->editAttributes() ?> aria-describedby="x_aktif_help">
<?= $Page->aktif->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->aktif->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="jabatan" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
<?php
    if (in_array("gajitunjangan", explode(",", $Page->getCurrentDetailTable())) && $gajitunjangan->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("gajitunjangan", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "GajitunjanganGrid.php" ?>
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
    ew.addEventHandlers("jabatan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
