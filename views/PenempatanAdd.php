<?php

namespace PHPMaker2022\sigap;

// Page object
$PenempatanAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { penempatan: currentTable } });
var currentForm, currentPageID;
var fpenempatanadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpenempatanadd = new ew.Form("fpenempatanadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fpenempatanadd;

    // Add fields
    var fields = currentTable.fields;
    fpenempatanadd.addFields([
        ["pegawai", [fields.pegawai.visible && fields.pegawai.required ? ew.Validators.required(fields.pegawai.caption) : null, ew.Validators.integer], fields.pegawai.isInvalid],
        ["project", [fields.project.visible && fields.project.required ? ew.Validators.required(fields.project.caption) : null], fields.project.isInvalid],
        ["jabatan", [fields.jabatan.visible && fields.jabatan.required ? ew.Validators.required(fields.jabatan.caption) : null], fields.jabatan.isInvalid],
        ["tgl_mulai", [fields.tgl_mulai.visible && fields.tgl_mulai.required ? ew.Validators.required(fields.tgl_mulai.caption) : null, ew.Validators.datetime(fields.tgl_mulai.clientFormatPattern)], fields.tgl_mulai.isInvalid],
        ["tgl_akhir", [fields.tgl_akhir.visible && fields.tgl_akhir.required ? ew.Validators.required(fields.tgl_akhir.caption) : null, ew.Validators.datetime(fields.tgl_akhir.clientFormatPattern)], fields.tgl_akhir.isInvalid]
    ]);

    // Form_CustomValidate
    fpenempatanadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpenempatanadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpenempatanadd.lists.pegawai = <?= $Page->pegawai->toClientList($Page) ?>;
    fpenempatanadd.lists.project = <?= $Page->project->toClientList($Page) ?>;
    fpenempatanadd.lists.jabatan = <?= $Page->jabatan->toClientList($Page) ?>;
    loadjs.done("fpenempatanadd");
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
<form name="fpenempatanadd" id="fpenempatanadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="penempatan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <div id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <label id="elh_penempatan_pegawai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pegawai->caption() ?><?= $Page->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_penempatan_pegawai">
    <select
        id="x_pegawai"
        name="x_pegawai"
        class="form-control ew-select<?= $Page->pegawai->isInvalidClass() ?>"
        data-select2-id="fpenempatanadd_x_pegawai"
        data-table="penempatan"
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
loadjs.ready("fpenempatanadd", function() {
    var options = { name: "x_pegawai", selectId: "fpenempatanadd_x_pegawai" };
    if (fpenempatanadd.lists.pegawai.lookupOptions.length) {
        options.data = { id: "x_pegawai", form: "fpenempatanadd" };
    } else {
        options.ajax = { id: "x_pegawai", form: "fpenempatanadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.penempatan.fields.pegawai.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->project->Visible) { // project ?>
    <div id="r_project"<?= $Page->project->rowAttributes() ?>>
        <label id="elh_penempatan_project" class="<?= $Page->LeftColumnClass ?>"><?= $Page->project->caption() ?><?= $Page->project->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->project->cellAttributes() ?>>
<span id="el_penempatan_project">
    <select
        id="x_project"
        name="x_project"
        class="form-control ew-select<?= $Page->project->isInvalidClass() ?>"
        data-select2-id="fpenempatanadd_x_project"
        data-table="penempatan"
        data-field="x_project"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->project->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->project->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->project->getPlaceHolder()) ?>"
        <?= $Page->project->editAttributes() ?>>
        <?= $Page->project->selectOptionListHtml("x_project") ?>
    </select>
    <?= $Page->project->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->project->getErrorMessage() ?></div>
<?= $Page->project->Lookup->getParamTag($Page, "p_x_project") ?>
<script>
loadjs.ready("fpenempatanadd", function() {
    var options = { name: "x_project", selectId: "fpenempatanadd_x_project" };
    if (fpenempatanadd.lists.project.lookupOptions.length) {
        options.data = { id: "x_project", form: "fpenempatanadd" };
    } else {
        options.ajax = { id: "x_project", form: "fpenempatanadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.penempatan.fields.project.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
    <div id="r_jabatan"<?= $Page->jabatan->rowAttributes() ?>>
        <label id="elh_penempatan_jabatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jabatan->caption() ?><?= $Page->jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jabatan->cellAttributes() ?>>
<span id="el_penempatan_jabatan">
    <select
        id="x_jabatan"
        name="x_jabatan"
        class="form-control ew-select<?= $Page->jabatan->isInvalidClass() ?>"
        data-select2-id="fpenempatanadd_x_jabatan"
        data-table="penempatan"
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
loadjs.ready("fpenempatanadd", function() {
    var options = { name: "x_jabatan", selectId: "fpenempatanadd_x_jabatan" };
    if (fpenempatanadd.lists.jabatan.lookupOptions.length) {
        options.data = { id: "x_jabatan", form: "fpenempatanadd" };
    } else {
        options.ajax = { id: "x_jabatan", form: "fpenempatanadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.penempatan.fields.jabatan.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_mulai->Visible) { // tgl_mulai ?>
    <div id="r_tgl_mulai"<?= $Page->tgl_mulai->rowAttributes() ?>>
        <label id="elh_penempatan_tgl_mulai" for="x_tgl_mulai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_mulai->caption() ?><?= $Page->tgl_mulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_mulai->cellAttributes() ?>>
<span id="el_penempatan_tgl_mulai">
<input type="<?= $Page->tgl_mulai->getInputTextType() ?>" name="x_tgl_mulai" id="x_tgl_mulai" data-table="penempatan" data-field="x_tgl_mulai" value="<?= $Page->tgl_mulai->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_mulai->getPlaceHolder()) ?>"<?= $Page->tgl_mulai->editAttributes() ?> aria-describedby="x_tgl_mulai_help">
<?= $Page->tgl_mulai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_mulai->getErrorMessage() ?></div>
<?php if (!$Page->tgl_mulai->ReadOnly && !$Page->tgl_mulai->Disabled && !isset($Page->tgl_mulai->EditAttrs["readonly"]) && !isset($Page->tgl_mulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenempatanadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpenempatanadd", "x_tgl_mulai", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tgl_akhir->Visible) { // tgl_akhir ?>
    <div id="r_tgl_akhir"<?= $Page->tgl_akhir->rowAttributes() ?>>
        <label id="elh_penempatan_tgl_akhir" for="x_tgl_akhir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl_akhir->caption() ?><?= $Page->tgl_akhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tgl_akhir->cellAttributes() ?>>
<span id="el_penempatan_tgl_akhir">
<input type="<?= $Page->tgl_akhir->getInputTextType() ?>" name="x_tgl_akhir" id="x_tgl_akhir" data-table="penempatan" data-field="x_tgl_akhir" value="<?= $Page->tgl_akhir->EditValue ?>" placeholder="<?= HtmlEncode($Page->tgl_akhir->getPlaceHolder()) ?>"<?= $Page->tgl_akhir->editAttributes() ?> aria-describedby="x_tgl_akhir_help">
<?= $Page->tgl_akhir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl_akhir->getErrorMessage() ?></div>
<?php if (!$Page->tgl_akhir->ReadOnly && !$Page->tgl_akhir->Disabled && !isset($Page->tgl_akhir->EditAttrs["readonly"]) && !isset($Page->tgl_akhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpenempatanadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("fpenempatanadd", "x_tgl_akhir", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
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
    ew.addEventHandlers("penempatan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
