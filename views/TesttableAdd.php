<?php

namespace PHPMaker2022\sigap;

// Page object
$TesttableAdd = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { testtable: currentTable } });
var currentForm, currentPageID;
var ftesttableadd;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftesttableadd = new ew.Form("ftesttableadd", "add");
    currentPageID = ew.PAGE_ID = "add";
    currentForm = ftesttableadd;

    // Add fields
    var fields = currentTable.fields;
    ftesttableadd.addFields([
        ["date", [fields.date.visible && fields.date.required ? ew.Validators.required(fields.date.caption) : null, ew.Validators.datetime(fields.date.clientFormatPattern)], fields.date.isInvalid],
        ["nojob", [fields.nojob.visible && fields.nojob.required ? ew.Validators.required(fields.nojob.caption) : null], fields.nojob.isInvalid],
        ["stuffingdate", [fields.stuffingdate.visible && fields.stuffingdate.required ? ew.Validators.required(fields.stuffingdate.caption) : null, ew.Validators.datetime(fields.stuffingdate.clientFormatPattern)], fields.stuffingdate.isInvalid],
        ["shipper", [fields.shipper.visible && fields.shipper.required ? ew.Validators.required(fields.shipper.caption) : null], fields.shipper.isInvalid],
        ["stuffingloc", [fields.stuffingloc.visible && fields.stuffingloc.required ? ew.Validators.required(fields.stuffingloc.caption) : null], fields.stuffingloc.isInvalid],
        ["party", [fields.party.visible && fields.party.required ? ew.Validators.required(fields.party.caption) : null], fields.party.isInvalid],
        ["typeparty", [fields.typeparty.visible && fields.typeparty.required ? ew.Validators.required(fields.typeparty.caption) : null], fields.typeparty.isInvalid],
        ["jumlahparty", [fields.jumlahparty.visible && fields.jumlahparty.required ? ew.Validators.required(fields.jumlahparty.caption) : null, ew.Validators.integer], fields.jumlahparty.isInvalid],
        ["shipping", [fields.shipping.visible && fields.shipping.required ? ew.Validators.required(fields.shipping.caption) : null], fields.shipping.isInvalid],
        ["bookingnumer", [fields.bookingnumer.visible && fields.bookingnumer.required ? ew.Validators.required(fields.bookingnumer.caption) : null], fields.bookingnumer.isInvalid],
        ["shippingline", [fields.shippingline.visible && fields.shippingline.required ? ew.Validators.required(fields.shippingline.caption) : null], fields.shippingline.isInvalid],
        ["port", [fields.port.visible && fields.port.required ? ew.Validators.required(fields.port.caption) : null], fields.port.isInvalid],
        ["surjal", [fields.surjal.visible && fields.surjal.required ? ew.Validators.required(fields.surjal.caption) : null], fields.surjal.isInvalid],
        ["nota", [fields.nota.visible && fields.nota.required ? ew.Validators.required(fields.nota.caption) : null], fields.nota.isInvalid],
        ["invoice", [fields.invoice.visible && fields.invoice.required ? ew.Validators.required(fields.invoice.caption) : null], fields.invoice.isInvalid]
    ]);

    // Form_CustomValidate
    ftesttableadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftesttableadd.validateRequired = ew.CLIENT_VALIDATE;

    // Dynamic selection lists
    loadjs.done("ftesttableadd");
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
<form name="ftesttableadd" id="ftesttableadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="testtable">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->date->Visible) { // date ?>
    <div id="r_date"<?= $Page->date->rowAttributes() ?>>
        <label id="elh_testtable_date" for="x_date" class="<?= $Page->LeftColumnClass ?>"><?= $Page->date->caption() ?><?= $Page->date->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->date->cellAttributes() ?>>
<span id="el_testtable_date">
<input type="<?= $Page->date->getInputTextType() ?>" name="x_date" id="x_date" data-table="testtable" data-field="x_date" value="<?= $Page->date->EditValue ?>" placeholder="<?= HtmlEncode($Page->date->getPlaceHolder()) ?>"<?= $Page->date->editAttributes() ?> aria-describedby="x_date_help">
<?= $Page->date->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->date->getErrorMessage() ?></div>
<?php if (!$Page->date->ReadOnly && !$Page->date->Disabled && !isset($Page->date->EditAttrs["readonly"]) && !isset($Page->date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftesttableadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftesttableadd", "x_date", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nojob->Visible) { // nojob ?>
    <div id="r_nojob"<?= $Page->nojob->rowAttributes() ?>>
        <label id="elh_testtable_nojob" for="x_nojob" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nojob->caption() ?><?= $Page->nojob->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nojob->cellAttributes() ?>>
<span id="el_testtable_nojob">
<input type="<?= $Page->nojob->getInputTextType() ?>" name="x_nojob" id="x_nojob" data-table="testtable" data-field="x_nojob" value="<?= $Page->nojob->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nojob->getPlaceHolder()) ?>"<?= $Page->nojob->editAttributes() ?> aria-describedby="x_nojob_help">
<?= $Page->nojob->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nojob->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->stuffingdate->Visible) { // stuffingdate ?>
    <div id="r_stuffingdate"<?= $Page->stuffingdate->rowAttributes() ?>>
        <label id="elh_testtable_stuffingdate" for="x_stuffingdate" class="<?= $Page->LeftColumnClass ?>"><?= $Page->stuffingdate->caption() ?><?= $Page->stuffingdate->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->stuffingdate->cellAttributes() ?>>
<span id="el_testtable_stuffingdate">
<input type="<?= $Page->stuffingdate->getInputTextType() ?>" name="x_stuffingdate" id="x_stuffingdate" data-table="testtable" data-field="x_stuffingdate" value="<?= $Page->stuffingdate->EditValue ?>" placeholder="<?= HtmlEncode($Page->stuffingdate->getPlaceHolder()) ?>"<?= $Page->stuffingdate->editAttributes() ?> aria-describedby="x_stuffingdate_help">
<?= $Page->stuffingdate->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->stuffingdate->getErrorMessage() ?></div>
<?php if (!$Page->stuffingdate->ReadOnly && !$Page->stuffingdate->Disabled && !isset($Page->stuffingdate->EditAttrs["readonly"]) && !isset($Page->stuffingdate->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["ftesttableadd", "datetimepicker"], function () {
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
    ew.createDateTimePicker("ftesttableadd", "x_stuffingdate", ew.deepAssign({"useCurrent":false}, options));
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->shipper->Visible) { // shipper ?>
    <div id="r_shipper"<?= $Page->shipper->rowAttributes() ?>>
        <label id="elh_testtable_shipper" for="x_shipper" class="<?= $Page->LeftColumnClass ?>"><?= $Page->shipper->caption() ?><?= $Page->shipper->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->shipper->cellAttributes() ?>>
<span id="el_testtable_shipper">
<input type="<?= $Page->shipper->getInputTextType() ?>" name="x_shipper" id="x_shipper" data-table="testtable" data-field="x_shipper" value="<?= $Page->shipper->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->shipper->getPlaceHolder()) ?>"<?= $Page->shipper->editAttributes() ?> aria-describedby="x_shipper_help">
<?= $Page->shipper->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->shipper->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->stuffingloc->Visible) { // stuffingloc ?>
    <div id="r_stuffingloc"<?= $Page->stuffingloc->rowAttributes() ?>>
        <label id="elh_testtable_stuffingloc" for="x_stuffingloc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->stuffingloc->caption() ?><?= $Page->stuffingloc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->stuffingloc->cellAttributes() ?>>
<span id="el_testtable_stuffingloc">
<input type="<?= $Page->stuffingloc->getInputTextType() ?>" name="x_stuffingloc" id="x_stuffingloc" data-table="testtable" data-field="x_stuffingloc" value="<?= $Page->stuffingloc->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->stuffingloc->getPlaceHolder()) ?>"<?= $Page->stuffingloc->editAttributes() ?> aria-describedby="x_stuffingloc_help">
<?= $Page->stuffingloc->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->stuffingloc->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->party->Visible) { // party ?>
    <div id="r_party"<?= $Page->party->rowAttributes() ?>>
        <label id="elh_testtable_party" for="x_party" class="<?= $Page->LeftColumnClass ?>"><?= $Page->party->caption() ?><?= $Page->party->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->party->cellAttributes() ?>>
<span id="el_testtable_party">
<input type="<?= $Page->party->getInputTextType() ?>" name="x_party" id="x_party" data-table="testtable" data-field="x_party" value="<?= $Page->party->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->party->getPlaceHolder()) ?>"<?= $Page->party->editAttributes() ?> aria-describedby="x_party_help">
<?= $Page->party->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->party->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->typeparty->Visible) { // typeparty ?>
    <div id="r_typeparty"<?= $Page->typeparty->rowAttributes() ?>>
        <label id="elh_testtable_typeparty" for="x_typeparty" class="<?= $Page->LeftColumnClass ?>"><?= $Page->typeparty->caption() ?><?= $Page->typeparty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->typeparty->cellAttributes() ?>>
<span id="el_testtable_typeparty">
<input type="<?= $Page->typeparty->getInputTextType() ?>" name="x_typeparty" id="x_typeparty" data-table="testtable" data-field="x_typeparty" value="<?= $Page->typeparty->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->typeparty->getPlaceHolder()) ?>"<?= $Page->typeparty->editAttributes() ?> aria-describedby="x_typeparty_help">
<?= $Page->typeparty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->typeparty->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jumlahparty->Visible) { // jumlahparty ?>
    <div id="r_jumlahparty"<?= $Page->jumlahparty->rowAttributes() ?>>
        <label id="elh_testtable_jumlahparty" for="x_jumlahparty" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jumlahparty->caption() ?><?= $Page->jumlahparty->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->jumlahparty->cellAttributes() ?>>
<span id="el_testtable_jumlahparty">
<input type="<?= $Page->jumlahparty->getInputTextType() ?>" name="x_jumlahparty" id="x_jumlahparty" data-table="testtable" data-field="x_jumlahparty" value="<?= $Page->jumlahparty->EditValue ?>" size="30" placeholder="<?= HtmlEncode($Page->jumlahparty->getPlaceHolder()) ?>"<?= $Page->jumlahparty->editAttributes() ?> aria-describedby="x_jumlahparty_help">
<?= $Page->jumlahparty->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jumlahparty->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->shipping->Visible) { // shipping ?>
    <div id="r_shipping"<?= $Page->shipping->rowAttributes() ?>>
        <label id="elh_testtable_shipping" for="x_shipping" class="<?= $Page->LeftColumnClass ?>"><?= $Page->shipping->caption() ?><?= $Page->shipping->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->shipping->cellAttributes() ?>>
<span id="el_testtable_shipping">
<input type="<?= $Page->shipping->getInputTextType() ?>" name="x_shipping" id="x_shipping" data-table="testtable" data-field="x_shipping" value="<?= $Page->shipping->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->shipping->getPlaceHolder()) ?>"<?= $Page->shipping->editAttributes() ?> aria-describedby="x_shipping_help">
<?= $Page->shipping->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->shipping->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bookingnumer->Visible) { // bookingnumer ?>
    <div id="r_bookingnumer"<?= $Page->bookingnumer->rowAttributes() ?>>
        <label id="elh_testtable_bookingnumer" for="x_bookingnumer" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bookingnumer->caption() ?><?= $Page->bookingnumer->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->bookingnumer->cellAttributes() ?>>
<span id="el_testtable_bookingnumer">
<input type="<?= $Page->bookingnumer->getInputTextType() ?>" name="x_bookingnumer" id="x_bookingnumer" data-table="testtable" data-field="x_bookingnumer" value="<?= $Page->bookingnumer->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->bookingnumer->getPlaceHolder()) ?>"<?= $Page->bookingnumer->editAttributes() ?> aria-describedby="x_bookingnumer_help">
<?= $Page->bookingnumer->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bookingnumer->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->shippingline->Visible) { // shippingline ?>
    <div id="r_shippingline"<?= $Page->shippingline->rowAttributes() ?>>
        <label id="elh_testtable_shippingline" for="x_shippingline" class="<?= $Page->LeftColumnClass ?>"><?= $Page->shippingline->caption() ?><?= $Page->shippingline->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->shippingline->cellAttributes() ?>>
<span id="el_testtable_shippingline">
<input type="<?= $Page->shippingline->getInputTextType() ?>" name="x_shippingline" id="x_shippingline" data-table="testtable" data-field="x_shippingline" value="<?= $Page->shippingline->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->shippingline->getPlaceHolder()) ?>"<?= $Page->shippingline->editAttributes() ?> aria-describedby="x_shippingline_help">
<?= $Page->shippingline->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->shippingline->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->port->Visible) { // port ?>
    <div id="r_port"<?= $Page->port->rowAttributes() ?>>
        <label id="elh_testtable_port" for="x_port" class="<?= $Page->LeftColumnClass ?>"><?= $Page->port->caption() ?><?= $Page->port->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->port->cellAttributes() ?>>
<span id="el_testtable_port">
<input type="<?= $Page->port->getInputTextType() ?>" name="x_port" id="x_port" data-table="testtable" data-field="x_port" value="<?= $Page->port->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->port->getPlaceHolder()) ?>"<?= $Page->port->editAttributes() ?> aria-describedby="x_port_help">
<?= $Page->port->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->port->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->surjal->Visible) { // surjal ?>
    <div id="r_surjal"<?= $Page->surjal->rowAttributes() ?>>
        <label id="elh_testtable_surjal" for="x_surjal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->surjal->caption() ?><?= $Page->surjal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->surjal->cellAttributes() ?>>
<span id="el_testtable_surjal">
<input type="<?= $Page->surjal->getInputTextType() ?>" name="x_surjal" id="x_surjal" data-table="testtable" data-field="x_surjal" value="<?= $Page->surjal->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->surjal->getPlaceHolder()) ?>"<?= $Page->surjal->editAttributes() ?> aria-describedby="x_surjal_help">
<?= $Page->surjal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->surjal->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nota->Visible) { // nota ?>
    <div id="r_nota"<?= $Page->nota->rowAttributes() ?>>
        <label id="elh_testtable_nota" for="x_nota" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nota->caption() ?><?= $Page->nota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->nota->cellAttributes() ?>>
<span id="el_testtable_nota">
<input type="<?= $Page->nota->getInputTextType() ?>" name="x_nota" id="x_nota" data-table="testtable" data-field="x_nota" value="<?= $Page->nota->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->nota->getPlaceHolder()) ?>"<?= $Page->nota->editAttributes() ?> aria-describedby="x_nota_help">
<?= $Page->nota->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nota->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->invoice->Visible) { // invoice ?>
    <div id="r_invoice"<?= $Page->invoice->rowAttributes() ?>>
        <label id="elh_testtable_invoice" for="x_invoice" class="<?= $Page->LeftColumnClass ?>"><?= $Page->invoice->caption() ?><?= $Page->invoice->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div<?= $Page->invoice->cellAttributes() ?>>
<span id="el_testtable_invoice">
<input type="<?= $Page->invoice->getInputTextType() ?>" name="x_invoice" id="x_invoice" data-table="testtable" data-field="x_invoice" value="<?= $Page->invoice->EditValue ?>" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->invoice->getPlaceHolder()) ?>"<?= $Page->invoice->editAttributes() ?> aria-describedby="x_invoice_help">
<?= $Page->invoice->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->invoice->getErrorMessage() ?></div>
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
    ew.addEventHandlers("testtable");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
