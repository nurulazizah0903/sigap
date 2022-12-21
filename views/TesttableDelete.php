<?php

namespace PHPMaker2022\sigap;

// Page object
$TesttableDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { testtable: currentTable } });
var currentForm, currentPageID;
var ftesttabledelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    ftesttabledelete = new ew.Form("ftesttabledelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = ftesttabledelete;
    loadjs.done("ftesttabledelete");
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
<form name="ftesttabledelete" id="ftesttabledelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="testtable">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_testtable_id" class="testtable_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <th class="<?= $Page->date->headerCellClass() ?>"><span id="elh_testtable_date" class="testtable_date"><?= $Page->date->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nojob->Visible) { // nojob ?>
        <th class="<?= $Page->nojob->headerCellClass() ?>"><span id="elh_testtable_nojob" class="testtable_nojob"><?= $Page->nojob->caption() ?></span></th>
<?php } ?>
<?php if ($Page->stuffingdate->Visible) { // stuffingdate ?>
        <th class="<?= $Page->stuffingdate->headerCellClass() ?>"><span id="elh_testtable_stuffingdate" class="testtable_stuffingdate"><?= $Page->stuffingdate->caption() ?></span></th>
<?php } ?>
<?php if ($Page->shipper->Visible) { // shipper ?>
        <th class="<?= $Page->shipper->headerCellClass() ?>"><span id="elh_testtable_shipper" class="testtable_shipper"><?= $Page->shipper->caption() ?></span></th>
<?php } ?>
<?php if ($Page->stuffingloc->Visible) { // stuffingloc ?>
        <th class="<?= $Page->stuffingloc->headerCellClass() ?>"><span id="elh_testtable_stuffingloc" class="testtable_stuffingloc"><?= $Page->stuffingloc->caption() ?></span></th>
<?php } ?>
<?php if ($Page->party->Visible) { // party ?>
        <th class="<?= $Page->party->headerCellClass() ?>"><span id="elh_testtable_party" class="testtable_party"><?= $Page->party->caption() ?></span></th>
<?php } ?>
<?php if ($Page->typeparty->Visible) { // typeparty ?>
        <th class="<?= $Page->typeparty->headerCellClass() ?>"><span id="elh_testtable_typeparty" class="testtable_typeparty"><?= $Page->typeparty->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jumlahparty->Visible) { // jumlahparty ?>
        <th class="<?= $Page->jumlahparty->headerCellClass() ?>"><span id="elh_testtable_jumlahparty" class="testtable_jumlahparty"><?= $Page->jumlahparty->caption() ?></span></th>
<?php } ?>
<?php if ($Page->shipping->Visible) { // shipping ?>
        <th class="<?= $Page->shipping->headerCellClass() ?>"><span id="elh_testtable_shipping" class="testtable_shipping"><?= $Page->shipping->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bookingnumer->Visible) { // bookingnumer ?>
        <th class="<?= $Page->bookingnumer->headerCellClass() ?>"><span id="elh_testtable_bookingnumer" class="testtable_bookingnumer"><?= $Page->bookingnumer->caption() ?></span></th>
<?php } ?>
<?php if ($Page->shippingline->Visible) { // shippingline ?>
        <th class="<?= $Page->shippingline->headerCellClass() ?>"><span id="elh_testtable_shippingline" class="testtable_shippingline"><?= $Page->shippingline->caption() ?></span></th>
<?php } ?>
<?php if ($Page->port->Visible) { // port ?>
        <th class="<?= $Page->port->headerCellClass() ?>"><span id="elh_testtable_port" class="testtable_port"><?= $Page->port->caption() ?></span></th>
<?php } ?>
<?php if ($Page->surjal->Visible) { // surjal ?>
        <th class="<?= $Page->surjal->headerCellClass() ?>"><span id="elh_testtable_surjal" class="testtable_surjal"><?= $Page->surjal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nota->Visible) { // nota ?>
        <th class="<?= $Page->nota->headerCellClass() ?>"><span id="elh_testtable_nota" class="testtable_nota"><?= $Page->nota->caption() ?></span></th>
<?php } ?>
<?php if ($Page->invoice->Visible) { // invoice ?>
        <th class="<?= $Page->invoice->headerCellClass() ?>"><span id="elh_testtable_invoice" class="testtable_invoice"><?= $Page->invoice->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td<?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_id" class="el_testtable_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->date->Visible) { // date ?>
        <td<?= $Page->date->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_date" class="el_testtable_date">
<span<?= $Page->date->viewAttributes() ?>>
<?= $Page->date->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nojob->Visible) { // nojob ?>
        <td<?= $Page->nojob->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_nojob" class="el_testtable_nojob">
<span<?= $Page->nojob->viewAttributes() ?>>
<?= $Page->nojob->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->stuffingdate->Visible) { // stuffingdate ?>
        <td<?= $Page->stuffingdate->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_stuffingdate" class="el_testtable_stuffingdate">
<span<?= $Page->stuffingdate->viewAttributes() ?>>
<?= $Page->stuffingdate->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->shipper->Visible) { // shipper ?>
        <td<?= $Page->shipper->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_shipper" class="el_testtable_shipper">
<span<?= $Page->shipper->viewAttributes() ?>>
<?= $Page->shipper->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->stuffingloc->Visible) { // stuffingloc ?>
        <td<?= $Page->stuffingloc->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_stuffingloc" class="el_testtable_stuffingloc">
<span<?= $Page->stuffingloc->viewAttributes() ?>>
<?= $Page->stuffingloc->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->party->Visible) { // party ?>
        <td<?= $Page->party->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_party" class="el_testtable_party">
<span<?= $Page->party->viewAttributes() ?>>
<?= $Page->party->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->typeparty->Visible) { // typeparty ?>
        <td<?= $Page->typeparty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_typeparty" class="el_testtable_typeparty">
<span<?= $Page->typeparty->viewAttributes() ?>>
<?= $Page->typeparty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jumlahparty->Visible) { // jumlahparty ?>
        <td<?= $Page->jumlahparty->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_jumlahparty" class="el_testtable_jumlahparty">
<span<?= $Page->jumlahparty->viewAttributes() ?>>
<?= $Page->jumlahparty->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->shipping->Visible) { // shipping ?>
        <td<?= $Page->shipping->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_shipping" class="el_testtable_shipping">
<span<?= $Page->shipping->viewAttributes() ?>>
<?= $Page->shipping->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bookingnumer->Visible) { // bookingnumer ?>
        <td<?= $Page->bookingnumer->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_bookingnumer" class="el_testtable_bookingnumer">
<span<?= $Page->bookingnumer->viewAttributes() ?>>
<?= $Page->bookingnumer->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->shippingline->Visible) { // shippingline ?>
        <td<?= $Page->shippingline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_shippingline" class="el_testtable_shippingline">
<span<?= $Page->shippingline->viewAttributes() ?>>
<?= $Page->shippingline->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->port->Visible) { // port ?>
        <td<?= $Page->port->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_port" class="el_testtable_port">
<span<?= $Page->port->viewAttributes() ?>>
<?= $Page->port->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->surjal->Visible) { // surjal ?>
        <td<?= $Page->surjal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_surjal" class="el_testtable_surjal">
<span<?= $Page->surjal->viewAttributes() ?>>
<?= $Page->surjal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nota->Visible) { // nota ?>
        <td<?= $Page->nota->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_nota" class="el_testtable_nota">
<span<?= $Page->nota->viewAttributes() ?>>
<?= $Page->nota->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->invoice->Visible) { // invoice ?>
        <td<?= $Page->invoice->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_testtable_invoice" class="el_testtable_invoice">
<span<?= $Page->invoice->viewAttributes() ?>>
<?= $Page->invoice->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
