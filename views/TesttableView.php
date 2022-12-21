<?php

namespace PHPMaker2022\sigap;

// Page object
$TesttableView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { testtable: currentTable } });
var currentForm, currentPageID;
var ftesttableview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftesttableview = new ew.Form("ftesttableview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = ftesttableview;
    loadjs.done("ftesttableview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftesttableview" id="ftesttableview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="testtable">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_testtable_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
    <tr id="r_date"<?= $Page->date->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_date"><?= $Page->date->caption() ?></span></td>
        <td data-name="date"<?= $Page->date->cellAttributes() ?>>
<span id="el_testtable_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nojob->Visible) { // nojob ?>
    <tr id="r_nojob"<?= $Page->nojob->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_nojob"><?= $Page->nojob->caption() ?></span></td>
        <td data-name="nojob"<?= $Page->nojob->cellAttributes() ?>>
<span id="el_testtable_nojob">
<span<?= $Page->nojob->viewAttributes() ?>>
<?= $Page->nojob->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->stuffingdate->Visible) { // stuffingdate ?>
    <tr id="r_stuffingdate"<?= $Page->stuffingdate->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_stuffingdate"><?= $Page->stuffingdate->caption() ?></span></td>
        <td data-name="stuffingdate"<?= $Page->stuffingdate->cellAttributes() ?>>
<span id="el_testtable_stuffingdate">
<span<?= $Page->stuffingdate->viewAttributes() ?>>
<?= $Page->stuffingdate->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->shipper->Visible) { // shipper ?>
    <tr id="r_shipper"<?= $Page->shipper->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_shipper"><?= $Page->shipper->caption() ?></span></td>
        <td data-name="shipper"<?= $Page->shipper->cellAttributes() ?>>
<span id="el_testtable_shipper">
<span<?= $Page->shipper->viewAttributes() ?>>
<?= $Page->shipper->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->stuffingloc->Visible) { // stuffingloc ?>
    <tr id="r_stuffingloc"<?= $Page->stuffingloc->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_stuffingloc"><?= $Page->stuffingloc->caption() ?></span></td>
        <td data-name="stuffingloc"<?= $Page->stuffingloc->cellAttributes() ?>>
<span id="el_testtable_stuffingloc">
<span<?= $Page->stuffingloc->viewAttributes() ?>>
<?= $Page->stuffingloc->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->party->Visible) { // party ?>
    <tr id="r_party"<?= $Page->party->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_party"><?= $Page->party->caption() ?></span></td>
        <td data-name="party"<?= $Page->party->cellAttributes() ?>>
<span id="el_testtable_party">
<span<?= $Page->party->viewAttributes() ?>>
<?= $Page->party->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->typeparty->Visible) { // typeparty ?>
    <tr id="r_typeparty"<?= $Page->typeparty->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_typeparty"><?= $Page->typeparty->caption() ?></span></td>
        <td data-name="typeparty"<?= $Page->typeparty->cellAttributes() ?>>
<span id="el_testtable_typeparty">
<span<?= $Page->typeparty->viewAttributes() ?>>
<?= $Page->typeparty->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jumlahparty->Visible) { // jumlahparty ?>
    <tr id="r_jumlahparty"<?= $Page->jumlahparty->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_jumlahparty"><?= $Page->jumlahparty->caption() ?></span></td>
        <td data-name="jumlahparty"<?= $Page->jumlahparty->cellAttributes() ?>>
<span id="el_testtable_jumlahparty">
<span<?= $Page->jumlahparty->viewAttributes() ?>>
<?= $Page->jumlahparty->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->shipping->Visible) { // shipping ?>
    <tr id="r_shipping"<?= $Page->shipping->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_shipping"><?= $Page->shipping->caption() ?></span></td>
        <td data-name="shipping"<?= $Page->shipping->cellAttributes() ?>>
<span id="el_testtable_shipping">
<span<?= $Page->shipping->viewAttributes() ?>>
<?= $Page->shipping->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bookingnumer->Visible) { // bookingnumer ?>
    <tr id="r_bookingnumer"<?= $Page->bookingnumer->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_bookingnumer"><?= $Page->bookingnumer->caption() ?></span></td>
        <td data-name="bookingnumer"<?= $Page->bookingnumer->cellAttributes() ?>>
<span id="el_testtable_bookingnumer">
<span<?= $Page->bookingnumer->viewAttributes() ?>>
<?= $Page->bookingnumer->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->shippingline->Visible) { // shippingline ?>
    <tr id="r_shippingline"<?= $Page->shippingline->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_shippingline"><?= $Page->shippingline->caption() ?></span></td>
        <td data-name="shippingline"<?= $Page->shippingline->cellAttributes() ?>>
<span id="el_testtable_shippingline">
<span<?= $Page->shippingline->viewAttributes() ?>>
<?= $Page->shippingline->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->port->Visible) { // port ?>
    <tr id="r_port"<?= $Page->port->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_port"><?= $Page->port->caption() ?></span></td>
        <td data-name="port"<?= $Page->port->cellAttributes() ?>>
<span id="el_testtable_port">
<span<?= $Page->port->viewAttributes() ?>>
<?= $Page->port->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->surjal->Visible) { // surjal ?>
    <tr id="r_surjal"<?= $Page->surjal->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_surjal"><?= $Page->surjal->caption() ?></span></td>
        <td data-name="surjal"<?= $Page->surjal->cellAttributes() ?>>
<span id="el_testtable_surjal">
<span<?= $Page->surjal->viewAttributes() ?>>
<?= $Page->surjal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nota->Visible) { // nota ?>
    <tr id="r_nota"<?= $Page->nota->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_nota"><?= $Page->nota->caption() ?></span></td>
        <td data-name="nota"<?= $Page->nota->cellAttributes() ?>>
<span id="el_testtable_nota">
<span<?= $Page->nota->viewAttributes() ?>>
<?= $Page->nota->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->invoice->Visible) { // invoice ?>
    <tr id="r_invoice"<?= $Page->invoice->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_testtable_invoice"><?= $Page->invoice->caption() ?></span></td>
        <td data-name="invoice"<?= $Page->invoice->cellAttributes() ?>>
<span id="el_testtable_invoice">
<span<?= $Page->invoice->viewAttributes() ?>>
<?= $Page->invoice->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
