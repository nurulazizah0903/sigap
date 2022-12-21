<?php

namespace PHPMaker2022\sigap;

// Page object
$GenderEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gender: currentTable } });
var currentForm, currentPageID;
var fgenderedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgenderedit = new ew.Form("fgenderedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fgenderedit;

    // Add fields
    var fields = currentTable.fields;
    fgenderedit.addFields([
        ["gen", [fields.gen.visible && fields.gen.required ? ew.Validators.required(fields.gen.caption) : null], fields.gen.isInvalid]
    ]);

    // Form_CustomValidate
    fgenderedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgenderedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("fgenderedit");
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
<form name="fgenderedit" id="fgenderedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gender">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->gen->Visible) { // gen ?>
    <div id="r_gen"<?= $Page->gen->rowAttributes() ?>>
        <label id="elh_gender_gen" for="x_gen" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gen->caption() ?><?= $Page->gen->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->gen->cellAttributes() ?>>
<span id="el_gender_gen">
<input type="<?= $Page->gen->getInputTextType() ?>" name="x_gen" id="x_gen" data-table="gender" data-field="x_gen" value="<?= $Page->gen->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->gen->getPlaceHolder()) ?>"<?= $Page->gen->editAttributes() ?> aria-describedby="x_gen_help">
<?= $Page->gen->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gen->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="gender" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("gender");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
