<?php

namespace PHPMaker2022\sigap;

// Page object
$BulanEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { bulan: currentTable } });
var currentForm, currentPageID;
var fbulanedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fbulanedit = new ew.Form("fbulanedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fbulanedit;

    // Add fields
    var fields = currentTable.fields;
    fbulanedit.addFields([
        ["bulan", [fields.bulan.visible && fields.bulan.required ? ew.Validators.required(fields.bulan.caption) : null], fields.bulan.isInvalid],
        ["nourut", [fields.nourut.visible && fields.nourut.required ? ew.Validators.required(fields.nourut.caption) : null, ew.Validators.integer], fields.nourut.isInvalid]
    ]);

    // Form_CustomValidate
    fbulanedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbulanedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fbulanedit");
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
<form name="fbulanedit" id="fbulanedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bulan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->bulan->Visible) { // bulan ?>
    <div id="r_bulan"<?= $Page->bulan->rowAttributes() ?>>
        <label id="elh_bulan_bulan" for="x_bulan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bulan->caption() ?><?= $Page->bulan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bulan->cellAttributes() ?>>
<span id="el_bulan_bulan">
<input type="<?= $Page->bulan->getInputTextType() ?>" name="x_bulan" id="x_bulan" data-table="bulan" data-field="x_bulan" value="<?= $Page->bulan->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->bulan->getPlaceHolder()) ?>"<?= $Page->bulan->editAttributes() ?> aria-describedby="x_bulan_help">
<?= $Page->bulan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bulan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nourut->Visible) { // nourut ?>
    <div id="r_nourut"<?= $Page->nourut->rowAttributes() ?>>
        <label id="elh_bulan_nourut" for="x_nourut" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nourut->caption() ?><?= $Page->nourut->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nourut->cellAttributes() ?>>
<span id="el_bulan_nourut">
<input type="<?= $Page->nourut->getInputTextType() ?>" name="x_nourut" id="x_nourut" data-table="bulan" data-field="x_nourut" value="<?= $Page->nourut->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->nourut->getPlaceHolder()) ?>"<?= $Page->nourut->editAttributes() ?> aria-describedby="x_nourut_help">
<?= $Page->nourut->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nourut->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="bulan" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("bulan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
