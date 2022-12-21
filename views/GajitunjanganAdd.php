<?php

namespace PHPMaker2022\sigap;

// Page object
$GajitunjanganAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gajitunjangan: currentTable } });
var currentForm, currentPageID;
var fgajitunjanganadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajitunjanganadd = new ew.Form("fgajitunjanganadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fgajitunjanganadd;

    // Add fields
    var fields = currentTable.fields;
    fgajitunjanganadd.addFields([
        ["gapok", [fields.gapok.visible && fields.gapok.required ? ew.Validators.required(fields.gapok.caption) : null, ew.Validators.integer], fields.gapok.isInvalid],
        ["value_kehadiran", [fields.value_kehadiran.visible && fields.value_kehadiran.required ? ew.Validators.required(fields.value_kehadiran.caption) : null, ew.Validators.integer], fields.value_kehadiran.isInvalid],
        ["tunjangan_jabatan", [fields.tunjangan_jabatan.visible && fields.tunjangan_jabatan.required ? ew.Validators.required(fields.tunjangan_jabatan.caption) : null, ew.Validators.integer], fields.tunjangan_jabatan.isInvalid],
        ["tunjangan_khusus", [fields.tunjangan_khusus.visible && fields.tunjangan_khusus.required ? ew.Validators.required(fields.tunjangan_khusus.caption) : null, ew.Validators.integer], fields.tunjangan_khusus.isInvalid],
        ["reward", [fields.reward.visible && fields.reward.required ? ew.Validators.required(fields.reward.caption) : null, ew.Validators.integer], fields.reward.isInvalid],
        ["lembur", [fields.lembur.visible && fields.lembur.required ? ew.Validators.required(fields.lembur.caption) : null, ew.Validators.integer], fields.lembur.isInvalid],
        ["piket", [fields.piket.visible && fields.piket.required ? ew.Validators.required(fields.piket.caption) : null, ew.Validators.integer], fields.piket.isInvalid],
        ["inval", [fields.inval.visible && fields.inval.required ? ew.Validators.required(fields.inval.caption) : null, ew.Validators.integer], fields.inval.isInvalid],
        ["jam_lebih", [fields.jam_lebih.visible && fields.jam_lebih.required ? ew.Validators.required(fields.jam_lebih.caption) : null, ew.Validators.integer], fields.jam_lebih.isInvalid],
        ["ekstrakuri", [fields.ekstrakuri.visible && fields.ekstrakuri.required ? ew.Validators.required(fields.ekstrakuri.caption) : null, ew.Validators.integer], fields.ekstrakuri.isInvalid]
    ]);

    // Form_CustomValidate
    fgajitunjanganadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgajitunjanganadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fgajitunjanganadd");
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
<form name="fgajitunjanganadd" id="fgajitunjanganadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gajitunjangan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "jabatan") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="jabatan">
<input type="hidden" name="fk_id" value="<?= HtmlEncode($Page->pidjabatan->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->gapok->Visible) { // gapok ?>
    <div id="r_gapok"<?= $Page->gapok->rowAttributes() ?>>
        <label id="elh_gajitunjangan_gapok" for="x_gapok" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gapok->caption() ?><?= $Page->gapok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gapok->cellAttributes() ?>>
<span id="el_gajitunjangan_gapok">
<input type="<?= $Page->gapok->getInputTextType() ?>" name="x_gapok" id="x_gapok" data-table="gajitunjangan" data-field="x_gapok" value="<?= $Page->gapok->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->gapok->getPlaceHolder()) ?>"<?= $Page->gapok->editAttributes() ?> aria-describedby="x_gapok_help">
<?= $Page->gapok->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gapok->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->value_kehadiran->Visible) { // value_kehadiran ?>
    <div id="r_value_kehadiran"<?= $Page->value_kehadiran->rowAttributes() ?>>
        <label id="elh_gajitunjangan_value_kehadiran" for="x_value_kehadiran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->value_kehadiran->caption() ?><?= $Page->value_kehadiran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->value_kehadiran->cellAttributes() ?>>
<span id="el_gajitunjangan_value_kehadiran">
<input type="<?= $Page->value_kehadiran->getInputTextType() ?>" name="x_value_kehadiran" id="x_value_kehadiran" data-table="gajitunjangan" data-field="x_value_kehadiran" value="<?= $Page->value_kehadiran->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->value_kehadiran->getPlaceHolder()) ?>"<?= $Page->value_kehadiran->editAttributes() ?> aria-describedby="x_value_kehadiran_help">
<?= $Page->value_kehadiran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->value_kehadiran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
    <div id="r_tunjangan_jabatan"<?= $Page->tunjangan_jabatan->rowAttributes() ?>>
        <label id="elh_gajitunjangan_tunjangan_jabatan" for="x_tunjangan_jabatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tunjangan_jabatan->caption() ?><?= $Page->tunjangan_jabatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tunjangan_jabatan->cellAttributes() ?>>
<span id="el_gajitunjangan_tunjangan_jabatan">
<input type="<?= $Page->tunjangan_jabatan->getInputTextType() ?>" name="x_tunjangan_jabatan" id="x_tunjangan_jabatan" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" value="<?= $Page->tunjangan_jabatan->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tunjangan_jabatan->getPlaceHolder()) ?>"<?= $Page->tunjangan_jabatan->editAttributes() ?> aria-describedby="x_tunjangan_jabatan_help">
<?= $Page->tunjangan_jabatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tunjangan_jabatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
    <div id="r_tunjangan_khusus"<?= $Page->tunjangan_khusus->rowAttributes() ?>>
        <label id="elh_gajitunjangan_tunjangan_khusus" for="x_tunjangan_khusus" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tunjangan_khusus->caption() ?><?= $Page->tunjangan_khusus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tunjangan_khusus->cellAttributes() ?>>
<span id="el_gajitunjangan_tunjangan_khusus">
<input type="<?= $Page->tunjangan_khusus->getInputTextType() ?>" name="x_tunjangan_khusus" id="x_tunjangan_khusus" data-table="gajitunjangan" data-field="x_tunjangan_khusus" value="<?= $Page->tunjangan_khusus->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tunjangan_khusus->getPlaceHolder()) ?>"<?= $Page->tunjangan_khusus->editAttributes() ?> aria-describedby="x_tunjangan_khusus_help">
<?= $Page->tunjangan_khusus->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tunjangan_khusus->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->reward->Visible) { // reward ?>
    <div id="r_reward"<?= $Page->reward->rowAttributes() ?>>
        <label id="elh_gajitunjangan_reward" for="x_reward" class="<?= $Page->LeftColumnClass ?>"><?= $Page->reward->caption() ?><?= $Page->reward->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->reward->cellAttributes() ?>>
<span id="el_gajitunjangan_reward">
<input type="<?= $Page->reward->getInputTextType() ?>" name="x_reward" id="x_reward" data-table="gajitunjangan" data-field="x_reward" value="<?= $Page->reward->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->reward->getPlaceHolder()) ?>"<?= $Page->reward->editAttributes() ?> aria-describedby="x_reward_help">
<?= $Page->reward->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->reward->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->lembur->Visible) { // lembur ?>
    <div id="r_lembur"<?= $Page->lembur->rowAttributes() ?>>
        <label id="elh_gajitunjangan_lembur" for="x_lembur" class="<?= $Page->LeftColumnClass ?>"><?= $Page->lembur->caption() ?><?= $Page->lembur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->lembur->cellAttributes() ?>>
<span id="el_gajitunjangan_lembur">
<input type="<?= $Page->lembur->getInputTextType() ?>" name="x_lembur" id="x_lembur" data-table="gajitunjangan" data-field="x_lembur" value="<?= $Page->lembur->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->lembur->getPlaceHolder()) ?>"<?= $Page->lembur->editAttributes() ?> aria-describedby="x_lembur_help">
<?= $Page->lembur->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->lembur->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->piket->Visible) { // piket ?>
    <div id="r_piket"<?= $Page->piket->rowAttributes() ?>>
        <label id="elh_gajitunjangan_piket" for="x_piket" class="<?= $Page->LeftColumnClass ?>"><?= $Page->piket->caption() ?><?= $Page->piket->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->piket->cellAttributes() ?>>
<span id="el_gajitunjangan_piket">
<input type="<?= $Page->piket->getInputTextType() ?>" name="x_piket" id="x_piket" data-table="gajitunjangan" data-field="x_piket" value="<?= $Page->piket->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->piket->getPlaceHolder()) ?>"<?= $Page->piket->editAttributes() ?> aria-describedby="x_piket_help">
<?= $Page->piket->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->piket->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->inval->Visible) { // inval ?>
    <div id="r_inval"<?= $Page->inval->rowAttributes() ?>>
        <label id="elh_gajitunjangan_inval" for="x_inval" class="<?= $Page->LeftColumnClass ?>"><?= $Page->inval->caption() ?><?= $Page->inval->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->inval->cellAttributes() ?>>
<span id="el_gajitunjangan_inval">
<input type="<?= $Page->inval->getInputTextType() ?>" name="x_inval" id="x_inval" data-table="gajitunjangan" data-field="x_inval" value="<?= $Page->inval->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->inval->getPlaceHolder()) ?>"<?= $Page->inval->editAttributes() ?> aria-describedby="x_inval_help">
<?= $Page->inval->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->inval->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jam_lebih->Visible) { // jam_lebih ?>
    <div id="r_jam_lebih"<?= $Page->jam_lebih->rowAttributes() ?>>
        <label id="elh_gajitunjangan_jam_lebih" for="x_jam_lebih" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jam_lebih->caption() ?><?= $Page->jam_lebih->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jam_lebih->cellAttributes() ?>>
<span id="el_gajitunjangan_jam_lebih">
<input type="<?= $Page->jam_lebih->getInputTextType() ?>" name="x_jam_lebih" id="x_jam_lebih" data-table="gajitunjangan" data-field="x_jam_lebih" value="<?= $Page->jam_lebih->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jam_lebih->getPlaceHolder()) ?>"<?= $Page->jam_lebih->editAttributes() ?> aria-describedby="x_jam_lebih_help">
<?= $Page->jam_lebih->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jam_lebih->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ekstrakuri->Visible) { // ekstrakuri ?>
    <div id="r_ekstrakuri"<?= $Page->ekstrakuri->rowAttributes() ?>>
        <label id="elh_gajitunjangan_ekstrakuri" for="x_ekstrakuri" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ekstrakuri->caption() ?><?= $Page->ekstrakuri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->ekstrakuri->cellAttributes() ?>>
<span id="el_gajitunjangan_ekstrakuri">
<input type="<?= $Page->ekstrakuri->getInputTextType() ?>" name="x_ekstrakuri" id="x_ekstrakuri" data-table="gajitunjangan" data-field="x_ekstrakuri" value="<?= $Page->ekstrakuri->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->ekstrakuri->getPlaceHolder()) ?>"<?= $Page->ekstrakuri->editAttributes() ?> aria-describedby="x_ekstrakuri_help">
<?= $Page->ekstrakuri->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ekstrakuri->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <?php if (strval($Page->pidjabatan->getSessionValue() ?? "") != "") { ?>
    <input type="hidden" name="x_pidjabatan" id="x_pidjabatan" value="<?= HtmlEncode(strval($Page->pidjabatan->getSessionValue() ?? "")) ?>">
    <?php } ?>
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
    ew.addEventHandlers("gajitunjangan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
