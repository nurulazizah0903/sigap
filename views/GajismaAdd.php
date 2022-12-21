<?php

namespace PHPMaker2022\sigap;

// Page object
$GajismaAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gajisma: currentTable } });
var currentForm, currentPageID;
var fgajismaadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajismaadd = new ew.Form("fgajismaadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fgajismaadd;

    // Add fields
    var fields = currentTable.fields;
    fgajismaadd.addFields([
        ["tahun", [fields.tahun.visible && fields.tahun.required ? ew.Validators.required(fields.tahun.caption) : null, ew.Validators.integer], fields.tahun.isInvalid],
        ["bulan", [fields.bulan.visible && fields.bulan.required ? ew.Validators.required(fields.bulan.caption) : null, ew.Validators.integer], fields.bulan.isInvalid],
        ["tingkat", [fields.tingkat.visible && fields.tingkat.required ? ew.Validators.required(fields.tingkat.caption) : null], fields.tingkat.isInvalid]
    ]);

    // Form_CustomValidate
    fgajismaadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgajismaadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fgajismaadd.lists.bulan = <?= $Page->bulan->toClientList($Page) ?>;
    loadjs.done("fgajismaadd");
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
<form name="fgajismaadd" id="fgajismaadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gajisma">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->tahun->Visible) { // tahun ?>
    <div id="r_tahun"<?= $Page->tahun->rowAttributes() ?>>
        <label id="elh_gajisma_tahun" for="x_tahun" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tahun->caption() ?><?= $Page->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tahun->cellAttributes() ?>>
<span id="el_gajisma_tahun">
<input type="<?= $Page->tahun->getInputTextType() ?>" name="x_tahun" id="x_tahun" data-table="gajisma" data-field="x_tahun" value="<?= $Page->tahun->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tahun->getPlaceHolder()) ?>"<?= $Page->tahun->editAttributes() ?> aria-describedby="x_tahun_help">
<?= $Page->tahun->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tahun->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bulan->Visible) { // bulan ?>
    <div id="r_bulan"<?= $Page->bulan->rowAttributes() ?>>
        <label id="elh_gajisma_bulan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bulan->caption() ?><?= $Page->bulan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bulan->cellAttributes() ?>>
<span id="el_gajisma_bulan">
    <select
        id="x_bulan"
        name="x_bulan"
        class="form-control ew-select<?= $Page->bulan->isInvalidClass() ?>"
        data-select2-id="fgajismaadd_x_bulan"
        data-table="gajisma"
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
loadjs.ready("fgajismaadd", function() {
    var options = { name: "x_bulan", selectId: "fgajismaadd_x_bulan" };
    if (fgajismaadd.lists.bulan.lookupOptions.length) {
        options.data = { id: "x_bulan", form: "fgajismaadd" };
    } else {
        options.ajax = { id: "x_bulan", form: "fgajismaadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.gajisma.fields.bulan.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tingkat->Visible) { // tingkat ?>
    <div id="r_tingkat"<?= $Page->tingkat->rowAttributes() ?>>
        <label id="elh_gajisma_tingkat" for="x_tingkat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tingkat->caption() ?><?= $Page->tingkat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tingkat->cellAttributes() ?>>
<span id="el_gajisma_tingkat">
<input type="<?= $Page->tingkat->getInputTextType() ?>" name="x_tingkat" id="x_tingkat" data-table="gajisma" data-field="x_tingkat" value="<?= $Page->tingkat->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->tingkat->getPlaceHolder()) ?>"<?= $Page->tingkat->editAttributes() ?> aria-describedby="x_tingkat_help">
<?= $Page->tingkat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tingkat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("gajisma_detil", explode(",", $Page->getCurrentDetailTable())) && $gajisma_detil->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("gajisma_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "GajismaDetilGrid.php" ?>
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
    ew.addEventHandlers("gajisma");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
