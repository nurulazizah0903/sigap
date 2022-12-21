<?php

namespace PHPMaker2022\sigap;

// Page object
$AbsenDetilAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { absen_detil: currentTable } });
var currentForm, currentPageID;
var fabsen_detiladd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fabsen_detiladd = new ew.Form("fabsen_detiladd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fabsen_detiladd;

    // Add fields
    var fields = currentTable.fields;
    fabsen_detiladd.addFields([
        ["pid", [fields.pid.visible && fields.pid.required ? ew.Validators.required(fields.pid.caption) : null, ew.Validators.integer], fields.pid.isInvalid],
        ["pegawai", [fields.pegawai.visible && fields.pegawai.required ? ew.Validators.required(fields.pegawai.caption) : null, ew.Validators.integer], fields.pegawai.isInvalid],
        ["masuk", [fields.masuk.visible && fields.masuk.required ? ew.Validators.required(fields.masuk.caption) : null, ew.Validators.integer], fields.masuk.isInvalid],
        ["absen", [fields.absen.visible && fields.absen.required ? ew.Validators.required(fields.absen.caption) : null, ew.Validators.integer], fields.absen.isInvalid],
        ["ijin", [fields.ijin.visible && fields.ijin.required ? ew.Validators.required(fields.ijin.caption) : null, ew.Validators.integer], fields.ijin.isInvalid],
        ["cuti", [fields.cuti.visible && fields.cuti.required ? ew.Validators.required(fields.cuti.caption) : null, ew.Validators.integer], fields.cuti.isInvalid],
        ["dinas_luar", [fields.dinas_luar.visible && fields.dinas_luar.required ? ew.Validators.required(fields.dinas_luar.caption) : null, ew.Validators.integer], fields.dinas_luar.isInvalid],
        ["terlambat", [fields.terlambat.visible && fields.terlambat.required ? ew.Validators.required(fields.terlambat.caption) : null, ew.Validators.integer], fields.terlambat.isInvalid]
    ]);

    // Form_CustomValidate
    fabsen_detiladd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fabsen_detiladd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fabsen_detiladd.lists.pegawai = <?= $Page->pegawai->toClientList($Page) ?>;
    loadjs.done("fabsen_detiladd");
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
<form name="fabsen_detiladd" id="fabsen_detiladd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="absen_detil">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "absen") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="absen">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->pid->Visible) { // pid ?>
    <div id="r_pid"<?= $Page->pid->rowAttributes() ?>>
        <label id="elh_absen_detil_pid" for="x_pid" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pid->caption() ?><?= $Page->pid->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pid->cellAttributes() ?>>
<?php if ($Page->pid->getSessionValue() != "") { ?>
<span<?= $Page->pid->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->pid->getDisplayValue($Page->pid->ViewValue))) ?>"></span>
<input type="hidden" id="x_pid" name="x_pid" value="<?= HtmlEncode($Page->pid->CurrentValue) ?>" data-hidden="1">
<?php } else { ?>
<span id="el_absen_detil_pid">
<input type="<?= $Page->pid->getInputTextType() ?>" name="x_pid" id="x_pid" data-table="absen_detil" data-field="x_pid" value="<?= $Page->pid->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->pid->getPlaceHolder()) ?>"<?= $Page->pid->editAttributes() ?> aria-describedby="x_pid_help">
<?= $Page->pid->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pid->getErrorMessage() ?></div>
</span>
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <div id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <label id="elh_absen_detil_pegawai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pegawai->caption() ?><?= $Page->pegawai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_absen_detil_pegawai">
    <select
        id="x_pegawai"
        name="x_pegawai"
        class="form-control ew-select<?= $Page->pegawai->isInvalidClass() ?>"
        data-select2-id="fabsen_detiladd_x_pegawai"
        data-table="absen_detil"
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
loadjs.ready("fabsen_detiladd", function() {
    var options = { name: "x_pegawai", selectId: "fabsen_detiladd_x_pegawai" };
    if (fabsen_detiladd.lists.pegawai.lookupOptions.length) {
        options.data = { id: "x_pegawai", form: "fabsen_detiladd" };
    } else {
        options.ajax = { id: "x_pegawai", form: "fabsen_detiladd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.absen_detil.fields.pegawai.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->masuk->Visible) { // masuk ?>
    <div id="r_masuk"<?= $Page->masuk->rowAttributes() ?>>
        <label id="elh_absen_detil_masuk" for="x_masuk" class="<?= $Page->LeftColumnClass ?>"><?= $Page->masuk->caption() ?><?= $Page->masuk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->masuk->cellAttributes() ?>>
<span id="el_absen_detil_masuk">
<input type="<?= $Page->masuk->getInputTextType() ?>" name="x_masuk" id="x_masuk" data-table="absen_detil" data-field="x_masuk" value="<?= $Page->masuk->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->masuk->getPlaceHolder()) ?>"<?= $Page->masuk->editAttributes() ?> aria-describedby="x_masuk_help">
<?= $Page->masuk->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->masuk->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->absen->Visible) { // absen ?>
    <div id="r_absen"<?= $Page->absen->rowAttributes() ?>>
        <label id="elh_absen_detil_absen" for="x_absen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->absen->caption() ?><?= $Page->absen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->absen->cellAttributes() ?>>
<span id="el_absen_detil_absen">
<input type="<?= $Page->absen->getInputTextType() ?>" name="x_absen" id="x_absen" data-table="absen_detil" data-field="x_absen" value="<?= $Page->absen->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->absen->getPlaceHolder()) ?>"<?= $Page->absen->editAttributes() ?> aria-describedby="x_absen_help">
<?= $Page->absen->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->absen->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ijin->Visible) { // ijin ?>
    <div id="r_ijin"<?= $Page->ijin->rowAttributes() ?>>
        <label id="elh_absen_detil_ijin" for="x_ijin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ijin->caption() ?><?= $Page->ijin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ijin->cellAttributes() ?>>
<span id="el_absen_detil_ijin">
<input type="<?= $Page->ijin->getInputTextType() ?>" name="x_ijin" id="x_ijin" data-table="absen_detil" data-field="x_ijin" value="<?= $Page->ijin->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->ijin->getPlaceHolder()) ?>"<?= $Page->ijin->editAttributes() ?> aria-describedby="x_ijin_help">
<?= $Page->ijin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ijin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->cuti->Visible) { // cuti ?>
    <div id="r_cuti"<?= $Page->cuti->rowAttributes() ?>>
        <label id="elh_absen_detil_cuti" for="x_cuti" class="<?= $Page->LeftColumnClass ?>"><?= $Page->cuti->caption() ?><?= $Page->cuti->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->cuti->cellAttributes() ?>>
<span id="el_absen_detil_cuti">
<input type="<?= $Page->cuti->getInputTextType() ?>" name="x_cuti" id="x_cuti" data-table="absen_detil" data-field="x_cuti" value="<?= $Page->cuti->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->cuti->getPlaceHolder()) ?>"<?= $Page->cuti->editAttributes() ?> aria-describedby="x_cuti_help">
<?= $Page->cuti->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->cuti->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->dinas_luar->Visible) { // dinas_luar ?>
    <div id="r_dinas_luar"<?= $Page->dinas_luar->rowAttributes() ?>>
        <label id="elh_absen_detil_dinas_luar" for="x_dinas_luar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->dinas_luar->caption() ?><?= $Page->dinas_luar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->dinas_luar->cellAttributes() ?>>
<span id="el_absen_detil_dinas_luar">
<input type="<?= $Page->dinas_luar->getInputTextType() ?>" name="x_dinas_luar" id="x_dinas_luar" data-table="absen_detil" data-field="x_dinas_luar" value="<?= $Page->dinas_luar->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->dinas_luar->getPlaceHolder()) ?>"<?= $Page->dinas_luar->editAttributes() ?> aria-describedby="x_dinas_luar_help">
<?= $Page->dinas_luar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->dinas_luar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->terlambat->Visible) { // terlambat ?>
    <div id="r_terlambat"<?= $Page->terlambat->rowAttributes() ?>>
        <label id="elh_absen_detil_terlambat" for="x_terlambat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->terlambat->caption() ?><?= $Page->terlambat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->terlambat->cellAttributes() ?>>
<span id="el_absen_detil_terlambat">
<input type="<?= $Page->terlambat->getInputTextType() ?>" name="x_terlambat" id="x_terlambat" data-table="absen_detil" data-field="x_terlambat" value="<?= $Page->terlambat->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->terlambat->getPlaceHolder()) ?>"<?= $Page->terlambat->editAttributes() ?> aria-describedby="x_terlambat_help">
<?= $Page->terlambat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->terlambat->getErrorMessage() ?></div>
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
    ew.addEventHandlers("absen_detil");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
