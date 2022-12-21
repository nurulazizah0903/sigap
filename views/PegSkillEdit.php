<?php

namespace PHPMaker2022\sigap;

// Page object
$PegSkillEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { peg_skill: currentTable } });
var currentForm, currentPageID;
var fpeg_skilledit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpeg_skilledit = new ew.Form("fpeg_skilledit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fpeg_skilledit;

    // Add fields
    var fields = currentTable.fields;
    fpeg_skilledit.addFields([
        ["c_by", [fields.c_by.visible && fields.c_by.required ? ew.Validators.required(fields.c_by.caption) : null], fields.c_by.isInvalid],
        ["keahlian", [fields.keahlian.visible && fields.keahlian.required ? ew.Validators.required(fields.keahlian.caption) : null], fields.keahlian.isInvalid],
        ["tingkat", [fields.tingkat.visible && fields.tingkat.required ? ew.Validators.required(fields.tingkat.caption) : null], fields.tingkat.isInvalid],
        ["keterangan", [fields.keterangan.visible && fields.keterangan.required ? ew.Validators.required(fields.keterangan.caption) : null], fields.keterangan.isInvalid],
        ["bukti", [fields.bukti.visible && fields.bukti.required ? ew.Validators.fileRequired(fields.bukti.caption) : null], fields.bukti.isInvalid],
        ["c_date", [fields.c_date.visible && fields.c_date.required ? ew.Validators.required(fields.c_date.caption) : null], fields.c_date.isInvalid],
        ["u_date", [fields.u_date.visible && fields.u_date.required ? ew.Validators.required(fields.u_date.caption) : null], fields.u_date.isInvalid],
        ["u_by", [fields.u_by.visible && fields.u_by.required ? ew.Validators.required(fields.u_by.caption) : null], fields.u_by.isInvalid]
    ]);

    // Form_CustomValidate
    fpeg_skilledit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fpeg_skilledit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fpeg_skilledit.lists.c_by = <?= $Page->c_by->toClientList($Page) ?>;
    fpeg_skilledit.lists.u_by = <?= $Page->u_by->toClientList($Page) ?>;
    loadjs.done("fpeg_skilledit");
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
<form name="fpeg_skilledit" id="fpeg_skilledit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="peg_skill">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "pegawai") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="pegawai">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->pid->getSessionValue()) ?>">
<?php } ?>
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->c_by->Visible) { // c_by ?>
    <div id="r_c_by"<?= $Page->c_by->rowAttributes() ?>>
        <label id="elh_peg_skill_c_by" for="x_c_by" class="<?= $Page->LeftColumnClass ?>"><?= $Page->c_by->caption() ?><?= $Page->c_by->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->c_by->cellAttributes() ?>>
<span id="el_peg_skill_c_by">
    <select
        id="x_c_by"
        name="x_c_by"
        class="form-select ew-select<?= $Page->c_by->isInvalidClass() ?>"
        data-select2-id="fpeg_skilledit_x_c_by"
        data-table="peg_skill"
        data-field="x_c_by"
        data-value-separator="<?= $Page->c_by->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->c_by->getPlaceHolder()) ?>"
        <?= $Page->c_by->editAttributes() ?>>
        <?= $Page->c_by->selectOptionListHtml("x_c_by") ?>
    </select>
    <?= $Page->c_by->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->c_by->getErrorMessage() ?></div>
<?= $Page->c_by->Lookup->getParamTag($Page, "p_x_c_by") ?>
<script>
loadjs.ready("fpeg_skilledit", function() {
    var options = { name: "x_c_by", selectId: "fpeg_skilledit_x_c_by" },
        el = document.querySelector("select[data-select2-id='" + options.selectId + "']");
    options.dropdownParent = el.closest("#ew-modal-dialog, #ew-add-opt-dialog");
    if (fpeg_skilledit.lists.c_by.lookupOptions.length) {
        options.data = { id: "x_c_by", form: "fpeg_skilledit" };
    } else {
        options.ajax = { id: "x_c_by", form: "fpeg_skilledit", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options.minimumResultsForSearch = Infinity;
    options = Object.assign({}, ew.selectOptions, options, ew.vars.tables.peg_skill.fields.c_by.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keahlian->Visible) { // keahlian ?>
    <div id="r_keahlian"<?= $Page->keahlian->rowAttributes() ?>>
        <label id="elh_peg_skill_keahlian" for="x_keahlian" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keahlian->caption() ?><?= $Page->keahlian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->keahlian->cellAttributes() ?>>
<span id="el_peg_skill_keahlian">
<input type="<?= $Page->keahlian->getInputTextType() ?>" name="x_keahlian" id="x_keahlian" data-table="peg_skill" data-field="x_keahlian" value="<?= $Page->keahlian->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->keahlian->getPlaceHolder()) ?>"<?= $Page->keahlian->editAttributes() ?> aria-describedby="x_keahlian_help">
<?= $Page->keahlian->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keahlian->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tingkat->Visible) { // tingkat ?>
    <div id="r_tingkat"<?= $Page->tingkat->rowAttributes() ?>>
        <label id="elh_peg_skill_tingkat" for="x_tingkat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tingkat->caption() ?><?= $Page->tingkat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tingkat->cellAttributes() ?>>
<span id="el_peg_skill_tingkat">
<input type="<?= $Page->tingkat->getInputTextType() ?>" name="x_tingkat" id="x_tingkat" data-table="peg_skill" data-field="x_tingkat" value="<?= $Page->tingkat->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->tingkat->getPlaceHolder()) ?>"<?= $Page->tingkat->editAttributes() ?> aria-describedby="x_tingkat_help">
<?= $Page->tingkat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tingkat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <div id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <label id="elh_peg_skill_keterangan" for="x_keterangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->keterangan->caption() ?><?= $Page->keterangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_peg_skill_keterangan">
<input type="<?= $Page->keterangan->getInputTextType() ?>" name="x_keterangan" id="x_keterangan" data-table="peg_skill" data-field="x_keterangan" value="<?= $Page->keterangan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->keterangan->getPlaceHolder()) ?>"<?= $Page->keterangan->editAttributes() ?> aria-describedby="x_keterangan_help">
<?= $Page->keterangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->keterangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bukti->Visible) { // bukti ?>
    <div id="r_bukti"<?= $Page->bukti->rowAttributes() ?>>
        <label id="elh_peg_skill_bukti" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bukti->caption() ?><?= $Page->bukti->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bukti->cellAttributes() ?>>
<span id="el_peg_skill_bukti">
<div id="fd_x_bukti" class="fileinput-button ew-file-drop-zone">
    <input type="file" class="form-control ew-file-input" title="<?= $Page->bukti->title() ?>" data-table="peg_skill" data-field="x_bukti" name="x_bukti" id="x_bukti" lang="<?= CurrentLanguageID() ?>"<?= $Page->bukti->editAttributes() ?> aria-describedby="x_bukti_help"<?= ($Page->bukti->ReadOnly || $Page->bukti->Disabled) ? " disabled" : "" ?>>
    <div class="text-muted ew-file-text"><?= $Language->phrase("ChooseFile") ?></div>
</div>
<?= $Page->bukti->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bukti->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_bukti" id= "fn_x_bukti" value="<?= $Page->bukti->Upload->FileName ?>">
<input type="hidden" name="fa_x_bukti" id= "fa_x_bukti" value="<?= (Post("fa_x_bukti") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_bukti" id= "fs_x_bukti" value="255">
<input type="hidden" name="fx_x_bukti" id= "fx_x_bukti" value="<?= $Page->bukti->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_bukti" id= "fm_x_bukti" value="<?= $Page->bukti->UploadMaxFileSize ?>">
<table id="ft_x_bukti" class="table table-sm float-start ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="peg_skill" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("peg_skill");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
