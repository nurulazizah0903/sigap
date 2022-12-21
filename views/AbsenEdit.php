<?php

namespace PHPMaker2022\sigap;

// Page object
$AbsenEdit = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { absen: currentTable } });
var currentForm, currentPageID;
var fabsenedit;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fabsenedit = new ew.Form("fabsenedit", "edit");
    currentPageID = ew.PAGE_ID = "edit";
    currentForm = fabsenedit;

    // Add fields
    var fields = currentTable.fields;
    fabsenedit.addFields([
        ["pemeriksa", [fields.pemeriksa.visible && fields.pemeriksa.required ? ew.Validators.required(fields.pemeriksa.caption) : null, ew.Validators.integer], fields.pemeriksa.isInvalid],
        ["bulan", [fields.bulan.visible && fields.bulan.required ? ew.Validators.required(fields.bulan.caption) : null], fields.bulan.isInvalid],
        ["jumlah_hari_kerja", [fields.jumlah_hari_kerja.visible && fields.jumlah_hari_kerja.required ? ew.Validators.required(fields.jumlah_hari_kerja.caption) : null, ew.Validators.integer], fields.jumlah_hari_kerja.isInvalid]
    ]);

    // Form_CustomValidate
    fabsenedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fabsenedit.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    fabsenedit.lists.pemeriksa = <?= $Page->pemeriksa->toClientList($Page) ?>;
    loadjs.done("fabsenedit");
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
<form name="fabsenedit" id="fabsenedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="absen">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->pemeriksa->Visible) { // pemeriksa ?>
    <div id="r_pemeriksa"<?= $Page->pemeriksa->rowAttributes() ?>>
        <label id="elh_absen_pemeriksa" class="<?= $Page->LeftColumnClass ?>"><?= $Page->pemeriksa->caption() ?><?= $Page->pemeriksa->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->pemeriksa->cellAttributes() ?>>
<span id="el_absen_pemeriksa">
<?php
$onchange = $Page->pemeriksa->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$Page->pemeriksa->EditAttrs["onchange"] = "";
if (IsRTL()) {
    $Page->pemeriksa->EditAttrs["dir"] = "rtl";
}
?>
<span id="as_x_pemeriksa" class="ew-auto-suggest">
    <input type="<?= $Page->pemeriksa->getInputTextType() ?>" class="form-control" name="sv_x_pemeriksa" id="sv_x_pemeriksa" value="<?= RemoveHtml($Page->pemeriksa->EditValue) ?>" size="30" placeholder="<?= HtmlEncode($Page->pemeriksa->getPlaceHolder()) ?>" data-placeholder="<?= HtmlEncode($Page->pemeriksa->getPlaceHolder()) ?>"<?= $Page->pemeriksa->editAttributes() ?> aria-describedby="x_pemeriksa_help">
</span>
<selection-list hidden class="form-control" data-table="absen" data-field="x_pemeriksa" data-input="sv_x_pemeriksa" data-value-separator="<?= $Page->pemeriksa->displayValueSeparatorAttribute() ?>" name="x_pemeriksa" id="x_pemeriksa" value="<?= HtmlEncode($Page->pemeriksa->CurrentValue) ?>"<?= $onchange ?>></selection-list>
<?= $Page->pemeriksa->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->pemeriksa->getErrorMessage() ?></div>
<script>
loadjs.ready("fabsenedit", function() {
    fabsenedit.createAutoSuggest(Object.assign({"id":"x_pemeriksa","forceSelect":false}, ew.vars.tables.absen.fields.pemeriksa.autoSuggestOptions));
});
</script>
<?= $Page->pemeriksa->Lookup->getParamTag($Page, "p_x_pemeriksa") ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bulan->Visible) { // bulan ?>
    <div id="r_bulan"<?= $Page->bulan->rowAttributes() ?>>
        <label id="elh_absen_bulan" for="x_bulan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bulan->caption() ?><?= $Page->bulan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bulan->cellAttributes() ?>>
<span id="el_absen_bulan">
<input type="<?= $Page->bulan->getInputTextType() ?>" name="x_bulan" id="x_bulan" data-table="absen" data-field="x_bulan" value="<?= $Page->bulan->EditValue ?>" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->bulan->getPlaceHolder()) ?>"<?= $Page->bulan->editAttributes() ?> aria-describedby="x_bulan_help">
<?= $Page->bulan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bulan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumlah_hari_kerja->Visible) { // jumlah_hari_kerja ?>
    <div id="r_jumlah_hari_kerja"<?= $Page->jumlah_hari_kerja->rowAttributes() ?>>
        <label id="elh_absen_jumlah_hari_kerja" for="x_jumlah_hari_kerja" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumlah_hari_kerja->caption() ?><?= $Page->jumlah_hari_kerja->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jumlah_hari_kerja->cellAttributes() ?>>
<span id="el_absen_jumlah_hari_kerja">
<input type="<?= $Page->jumlah_hari_kerja->getInputTextType() ?>" name="x_jumlah_hari_kerja" id="x_jumlah_hari_kerja" data-table="absen" data-field="x_jumlah_hari_kerja" value="<?= $Page->jumlah_hari_kerja->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jumlah_hari_kerja->getPlaceHolder()) ?>"<?= $Page->jumlah_hari_kerja->editAttributes() ?> aria-describedby="x_jumlah_hari_kerja_help">
<?= $Page->jumlah_hari_kerja->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumlah_hari_kerja->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="absen" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
<?php
    if (in_array("absen_detil", explode(",", $Page->getCurrentDetailTable())) && $absen_detil->DetailEdit) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("absen_detil", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "AbsenDetilGrid.php" ?>
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
    ew.addEventHandlers("absen");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
