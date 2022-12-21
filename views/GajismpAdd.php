<?php

namespace PHPMaker2022\sigap;

// Page object
$GajismpAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gajismp: currentTable } });
var currentForm, currentPageID;
var fgajismpadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajismpadd = new ew.Form("fgajismpadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = fgajismpadd;

    // Add fields
    var fields = currentTable.fields;
    fgajismpadd.addFields([
        ["tahun", [fields.tahun.visible && fields.tahun.required ? ew.Validators.required(fields.tahun.caption) : null, ew.Validators.integer], fields.tahun.isInvalid],
        ["bulan", [fields.bulan.visible && fields.bulan.required ? ew.Validators.required(fields.bulan.caption) : null, ew.Validators.integer], fields.bulan.isInvalid],
        ["tingkat", [fields.tingkat.visible && fields.tingkat.required ? ew.Validators.required(fields.tingkat.caption) : null], fields.tingkat.isInvalid]
    ]);

    // Form_CustomValidate
    fgajismpadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fgajismpadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fgajismpadd.lists.bulan = <?= $Page->bulan->toClientList($Page) ?>;
    loadjs.done("fgajismpadd");
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
<form name="fgajismpadd" id="fgajismpadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gajismp">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->tahun->Visible) { // tahun ?>
    <div id="r_tahun"<?= $Page->tahun->rowAttributes() ?>>
        <label id="elh_gajismp_tahun" for="x_tahun" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tahun->caption() ?><?= $Page->tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tahun->cellAttributes() ?>>
<span id="el_gajismp_tahun">
<input type="<?= $Page->tahun->getInputTextType() ?>" name="x_tahun" id="x_tahun" data-table="gajismp" data-field="x_tahun" value="<?= $Page->tahun->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->tahun->getPlaceHolder()) ?>"<?= $Page->tahun->editAttributes() ?> aria-describedby="x_tahun_help">
<?= $Page->tahun->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tahun->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bulan->Visible) { // bulan ?>
    <div id="r_bulan"<?= $Page->bulan->rowAttributes() ?>>
        <label id="elh_gajismp_bulan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bulan->caption() ?><?= $Page->bulan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bulan->cellAttributes() ?>>
<span id="el_gajismp_bulan">
    <select
        id="x_bulan"
        name="x_bulan"
        class="form-control ew-select<?= $Page->bulan->isInvalidClass() ?>"
        data-select2-id="fgajismpadd_x_bulan"
        data-table="gajismp"
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
loadjs.ready("fgajismpadd", function() {
    var options = { name: "x_bulan", selectId: "fgajismpadd_x_bulan" };
    if (fgajismpadd.lists.bulan.lookupOptions.length) {
        options.data = { id: "x_bulan", form: "fgajismpadd" };
    } else {
        options.ajax = { id: "x_bulan", form: "fgajismpadd", limit: ew.LOOKUP_PAGE_SIZE };
    }
    options = Object.assign({}, ew.modalLookupOptions, options, ew.vars.tables.gajismp.fields.bulan.modalLookupOptions);
    ew.createModalLookup(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tingkat->Visible) { // tingkat ?>
    <div id="r_tingkat"<?= $Page->tingkat->rowAttributes() ?>>
        <label id="elh_gajismp_tingkat" for="x_tingkat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tingkat->caption() ?><?= $Page->tingkat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->tingkat->cellAttributes() ?>>
<span id="el_gajismp_tingkat">
<input type="<?= $Page->tingkat->getInputTextType() ?>" name="x_tingkat" id="x_tingkat" data-table="gajismp" data-field="x_tingkat" value="<?= $Page->tingkat->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->tingkat->getPlaceHolder()) ?>"<?= $Page->tingkat->editAttributes() ?> aria-describedby="x_tingkat_help">
<?= $Page->tingkat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tingkat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php
    if (in_array("gajismp_detil", explode(",", $Page->getCurrentDetailTable())) && $gajismp_detil->DetailAdd) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("gajismp_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "GajismpDetilGrid.php" ?>
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
    ew.addEventHandlers("gajismp");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
