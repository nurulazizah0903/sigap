<?php

namespace PHPMaker2022\sigap;

// Page object
$PotonganSmpDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { potongan_smp: currentTable } });
var currentForm, currentPageID;
var fpotongan_smpdelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpotongan_smpdelete = new ew.Form("fpotongan_smpdelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fpotongan_smpdelete;
    loadjs.done("fpotongan_smpdelete");
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
<form name="fpotongan_smpdelete" id="fpotongan_smpdelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="potongan_smp">
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
<?php if ($Page->month->Visible) { // month ?>
        <th class="<?= $Page->month->headerCellClass() ?>"><span id="elh_potongan_smp_month" class="potongan_smp_month"><?= $Page->month->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
        <th class="<?= $Page->jenjang_id->headerCellClass() ?>"><span id="elh_potongan_smp_jenjang_id" class="potongan_smp_jenjang_id"><?= $Page->jenjang_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <th class="<?= $Page->jabatan_id->headerCellClass() ?>"><span id="elh_potongan_smp_jabatan_id" class="potongan_smp_jabatan_id"><?= $Page->jabatan_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><span id="elh_potongan_smp_nama" class="potongan_smp_nama"><?= $Page->nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->terlambat->Visible) { // terlambat ?>
        <th class="<?= $Page->terlambat->headerCellClass() ?>"><span id="elh_potongan_smp_terlambat" class="potongan_smp_terlambat"><?= $Page->terlambat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->value_terlambat->Visible) { // value_terlambat ?>
        <th class="<?= $Page->value_terlambat->headerCellClass() ?>"><span id="elh_potongan_smp_value_terlambat" class="potongan_smp_value_terlambat"><?= $Page->value_terlambat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->izin->Visible) { // izin ?>
        <th class="<?= $Page->izin->headerCellClass() ?>"><span id="elh_potongan_smp_izin" class="potongan_smp_izin"><?= $Page->izin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->value_izin->Visible) { // value_izin ?>
        <th class="<?= $Page->value_izin->headerCellClass() ?>"><span id="elh_potongan_smp_value_izin" class="potongan_smp_value_izin"><?= $Page->value_izin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->izinperjam->Visible) { // izinperjam ?>
        <th class="<?= $Page->izinperjam->headerCellClass() ?>"><span id="elh_potongan_smp_izinperjam" class="potongan_smp_izinperjam"><?= $Page->izinperjam->caption() ?></span></th>
<?php } ?>
<?php if ($Page->izinperjamvalue->Visible) { // izinperjamvalue ?>
        <th class="<?= $Page->izinperjamvalue->headerCellClass() ?>"><span id="elh_potongan_smp_izinperjamvalue" class="potongan_smp_izinperjamvalue"><?= $Page->izinperjamvalue->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sakit->Visible) { // sakit ?>
        <th class="<?= $Page->sakit->headerCellClass() ?>"><span id="elh_potongan_smp_sakit" class="potongan_smp_sakit"><?= $Page->sakit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->value_sakit->Visible) { // value_sakit ?>
        <th class="<?= $Page->value_sakit->headerCellClass() ?>"><span id="elh_potongan_smp_value_sakit" class="potongan_smp_value_sakit"><?= $Page->value_sakit->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sakitperjam->Visible) { // sakitperjam ?>
        <th class="<?= $Page->sakitperjam->headerCellClass() ?>"><span id="elh_potongan_smp_sakitperjam" class="potongan_smp_sakitperjam"><?= $Page->sakitperjam->caption() ?></span></th>
<?php } ?>
<?php if ($Page->sakitperjamvalue->Visible) { // sakitperjamvalue ?>
        <th class="<?= $Page->sakitperjamvalue->headerCellClass() ?>"><span id="elh_potongan_smp_sakitperjamvalue" class="potongan_smp_sakitperjamvalue"><?= $Page->sakitperjamvalue->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pulcep->Visible) { // pulcep ?>
        <th class="<?= $Page->pulcep->headerCellClass() ?>"><span id="elh_potongan_smp_pulcep" class="potongan_smp_pulcep"><?= $Page->pulcep->caption() ?></span></th>
<?php } ?>
<?php if ($Page->value_pulcep->Visible) { // value_pulcep ?>
        <th class="<?= $Page->value_pulcep->headerCellClass() ?>"><span id="elh_potongan_smp_value_pulcep" class="potongan_smp_value_pulcep"><?= $Page->value_pulcep->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tidakhadir->Visible) { // tidakhadir ?>
        <th class="<?= $Page->tidakhadir->headerCellClass() ?>"><span id="elh_potongan_smp_tidakhadir" class="potongan_smp_tidakhadir"><?= $Page->tidakhadir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->value_tidakhadir->Visible) { // value_tidakhadir ?>
        <th class="<?= $Page->value_tidakhadir->headerCellClass() ?>"><span id="elh_potongan_smp_value_tidakhadir" class="potongan_smp_value_tidakhadir"><?= $Page->value_tidakhadir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tidakhadirjam->Visible) { // tidakhadirjam ?>
        <th class="<?= $Page->tidakhadirjam->headerCellClass() ?>"><span id="elh_potongan_smp_tidakhadirjam" class="potongan_smp_tidakhadirjam"><?= $Page->tidakhadirjam->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tidakhadirjamvalue->Visible) { // tidakhadirjamvalue ?>
        <th class="<?= $Page->tidakhadirjamvalue->headerCellClass() ?>"><span id="elh_potongan_smp_tidakhadirjamvalue" class="potongan_smp_tidakhadirjamvalue"><?= $Page->tidakhadirjamvalue->caption() ?></span></th>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <th class="<?= $Page->total->headerCellClass() ?>"><span id="elh_potongan_smp_total" class="potongan_smp_total"><?= $Page->total->caption() ?></span></th>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
        <th class="<?= $Page->u_by->headerCellClass() ?>"><span id="elh_potongan_smp_u_by" class="potongan_smp_u_by"><?= $Page->u_by->caption() ?></span></th>
<?php } ?>
<?php if ($Page->datetime->Visible) { // datetime ?>
        <th class="<?= $Page->datetime->headerCellClass() ?>"><span id="elh_potongan_smp_datetime" class="potongan_smp_datetime"><?= $Page->datetime->caption() ?></span></th>
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
<?php if ($Page->month->Visible) { // month ?>
        <td<?= $Page->month->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_month" class="el_potongan_smp_month">
<span<?= $Page->month->viewAttributes() ?>>
<?= $Page->month->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
        <td<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_jenjang_id" class="el_potongan_smp_jenjang_id">
<span<?= $Page->jenjang_id->viewAttributes() ?>>
<?= $Page->jenjang_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <td<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_jabatan_id" class="el_potongan_smp_jabatan_id">
<span<?= $Page->jabatan_id->viewAttributes() ?>>
<?= $Page->jabatan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <td<?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_nama" class="el_potongan_smp_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->terlambat->Visible) { // terlambat ?>
        <td<?= $Page->terlambat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_terlambat" class="el_potongan_smp_terlambat">
<span<?= $Page->terlambat->viewAttributes() ?>>
<?= $Page->terlambat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->value_terlambat->Visible) { // value_terlambat ?>
        <td<?= $Page->value_terlambat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_value_terlambat" class="el_potongan_smp_value_terlambat">
<span<?= $Page->value_terlambat->viewAttributes() ?>>
<?= $Page->value_terlambat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->izin->Visible) { // izin ?>
        <td<?= $Page->izin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_izin" class="el_potongan_smp_izin">
<span<?= $Page->izin->viewAttributes() ?>>
<?= $Page->izin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->value_izin->Visible) { // value_izin ?>
        <td<?= $Page->value_izin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_value_izin" class="el_potongan_smp_value_izin">
<span<?= $Page->value_izin->viewAttributes() ?>>
<?= $Page->value_izin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->izinperjam->Visible) { // izinperjam ?>
        <td<?= $Page->izinperjam->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_izinperjam" class="el_potongan_smp_izinperjam">
<span<?= $Page->izinperjam->viewAttributes() ?>>
<?= $Page->izinperjam->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->izinperjamvalue->Visible) { // izinperjamvalue ?>
        <td<?= $Page->izinperjamvalue->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_izinperjamvalue" class="el_potongan_smp_izinperjamvalue">
<span<?= $Page->izinperjamvalue->viewAttributes() ?>>
<?= $Page->izinperjamvalue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sakit->Visible) { // sakit ?>
        <td<?= $Page->sakit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_sakit" class="el_potongan_smp_sakit">
<span<?= $Page->sakit->viewAttributes() ?>>
<?= $Page->sakit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->value_sakit->Visible) { // value_sakit ?>
        <td<?= $Page->value_sakit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_value_sakit" class="el_potongan_smp_value_sakit">
<span<?= $Page->value_sakit->viewAttributes() ?>>
<?= $Page->value_sakit->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sakitperjam->Visible) { // sakitperjam ?>
        <td<?= $Page->sakitperjam->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_sakitperjam" class="el_potongan_smp_sakitperjam">
<span<?= $Page->sakitperjam->viewAttributes() ?>>
<?= $Page->sakitperjam->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->sakitperjamvalue->Visible) { // sakitperjamvalue ?>
        <td<?= $Page->sakitperjamvalue->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_sakitperjamvalue" class="el_potongan_smp_sakitperjamvalue">
<span<?= $Page->sakitperjamvalue->viewAttributes() ?>>
<?= $Page->sakitperjamvalue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pulcep->Visible) { // pulcep ?>
        <td<?= $Page->pulcep->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_pulcep" class="el_potongan_smp_pulcep">
<span<?= $Page->pulcep->viewAttributes() ?>>
<?= $Page->pulcep->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->value_pulcep->Visible) { // value_pulcep ?>
        <td<?= $Page->value_pulcep->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_value_pulcep" class="el_potongan_smp_value_pulcep">
<span<?= $Page->value_pulcep->viewAttributes() ?>>
<?= $Page->value_pulcep->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tidakhadir->Visible) { // tidakhadir ?>
        <td<?= $Page->tidakhadir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_tidakhadir" class="el_potongan_smp_tidakhadir">
<span<?= $Page->tidakhadir->viewAttributes() ?>>
<?= $Page->tidakhadir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->value_tidakhadir->Visible) { // value_tidakhadir ?>
        <td<?= $Page->value_tidakhadir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_value_tidakhadir" class="el_potongan_smp_value_tidakhadir">
<span<?= $Page->value_tidakhadir->viewAttributes() ?>>
<?= $Page->value_tidakhadir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tidakhadirjam->Visible) { // tidakhadirjam ?>
        <td<?= $Page->tidakhadirjam->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_tidakhadirjam" class="el_potongan_smp_tidakhadirjam">
<span<?= $Page->tidakhadirjam->viewAttributes() ?>>
<?= $Page->tidakhadirjam->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tidakhadirjamvalue->Visible) { // tidakhadirjamvalue ?>
        <td<?= $Page->tidakhadirjamvalue->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_tidakhadirjamvalue" class="el_potongan_smp_tidakhadirjamvalue">
<span<?= $Page->tidakhadirjamvalue->viewAttributes() ?>>
<?= $Page->tidakhadirjamvalue->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
        <td<?= $Page->total->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_total" class="el_potongan_smp_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
        <td<?= $Page->u_by->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_u_by" class="el_potongan_smp_u_by">
<span<?= $Page->u_by->viewAttributes() ?>>
<?= $Page->u_by->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->datetime->Visible) { // datetime ?>
        <td<?= $Page->datetime->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_potongan_smp_datetime" class="el_potongan_smp_datetime">
<span<?= $Page->datetime->viewAttributes() ?>>
<?= $Page->datetime->getViewValue() ?></span>
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
