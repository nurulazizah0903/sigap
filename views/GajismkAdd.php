<?php

namespace PHPMaker2022\sigap;

// Page object
$GajismkAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gajismk: currentTable } });
var currentForm, currentPageID;
var fgajismkadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajismkadd = new ew.Form("fgajismkadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fgajismkadd;

    // Add fields
    var fields = currentTable.fields;
    fgajismkadd.addFields([
        ["tahun", [fields.tahun.visible && fields.tahun.required ? ew.Validators.required(fields.tahun.caption) : null, ew.Validators.integer], fields.tahun.isInvalid],
        ["bulan", [fields.bulan.visible && fields.bulan.required ? ew.Validators.required(fields.bulan.caption) : null, ew.Validators.integer], fields.bulan.isInvalid],
        ["tingkat", [fields.tingkat.visible && fields.tingkat.required ? ew.Validators.required(fields.tingkat.caption) : null], fields.tingkat.isInvalid]
    ]);

    // Form_CustomValidate
    fgajismkadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgajismkadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fgajismkadd.lists.bulan = <?= $Page->bulan->toClientList($Page) ?>;
    loadjs.done("fgajismkadd");
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
<form name="fgajismkadd" id="fgajismkadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gajismk">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->tahun->Visible) { // tahun ?>
    <div id="r_tahun"<?= $Page->tahun->rowAttributes() ?>>
        <label id="elh_gajismk_tahun" for="x_tahun" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tahun->caption() ?><?= $Page->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tahun->cellAttributes() ?>>
<span id="el_gajismk_tahun">
<input type="<?= $Page->tahun->getInputTextType() ?>" name="x_tahun" id="x_tahun" data-table="gajismk" data-field="x_tahun" value="<?= $Page->tahun->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tahun->getPlaceHolder()) ?>"<?= $Page->tahun->editAttributes() ?> aria-describedby="x_tahun_help">
<?= $Page->tahun->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tahun->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bulan->Visible) { // bulan ?>
    <div id="r_bulan"<?= $Page->bulan->rowAttributes() ?>>
        <label id="elh_gajismk_bulan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bulan->caption() ?><?= $Page->bulan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bulan->cellAttributes() ?>>
<span id="el_gajismk_bulan">
    <select
        id="x_bulan"
        name="x_bulan"
        class="form-control ew-select<?= $Page->bulan->isInvalidClass() ?>"
        data-select2-id="fgajismkadd_x_bulan"
        data-table="gajismk"
        data-field="x_bulan"
        data-caption="<?= HtmlEncode(RemoveHtml($Page->bulan->caption())) ?>"
        data-modal-lookup="true"
        data-value-separator="<?= $Page->bulan->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->bulan->getPlaceHolder()) ?>"
        <?= $Page->bulan->editAttributes() ?>>
        <?= $Page->bulan->selectOptionListHtml("x_bulan") ?>
    </select>
    <?= $Page->bulan->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->bulan->getErrorMessage() ?></div>
<?= $Page->bulan->Lookup->getParamTag($Page, "p_x_bulan") ?>
<script>
loadjs.ready("fgajismkadd", function() {
    var options = { name: "x_bulan", selectId: "fgajismkadd_x_bulan" };
    if (fgajismkadd.lists.bulan.lookupOptions.length) {
        options.data = { id: "x_bulan", form: "fgajismkadd" };
    } else {
        options.ajax = { id: "x_bulan", form: "fgajismkadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.gajismk.fields.bulan.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tingkat->Visible) { // tingkat ?>
    <div id="r_tingkat"<?= $Page->tingkat->rowAttributes() ?>>
        <label id="elh_gajismk_tingkat" for="x_tingkat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tingkat->caption() ?><?= $Page->tingkat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tingkat->cellAttributes() ?>>
<span id="el_gajismk_tingkat">
<input type="<?= $Page->tingkat->getInputTextType() ?>" name="x_tingkat" id="x_tingkat" data-table="gajismk" data-field="x_tingkat" value="<?= $Page->tingkat->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->tingkat->getPlaceHolder()) ?>"<?= $Page->tingkat->editAttributes() ?> aria-describedby="x_tingkat_help">
<?= $Page->tingkat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tingkat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("gajismk_detil", explode(",", $Page->getCurrentDetailTable())) && $gajismk_detil->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("gajismk_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "GajismkDetilGrid.php" ?>
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
    ew.addEventHandlers("gajismk");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
