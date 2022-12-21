<?php

namespace PHPMaker2022\sigap;

// Page object
$PotonganSdView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { potongan_sd: currentTable } });
var currentForm, currentPageID;
var fpotongan_sdview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpotongan_sdview = new ew.Form("fpotongan_sdview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fpotongan_sdview;
    loadjs.done("fpotongan_sdview");
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
<form name="fpotongan_sdview" id="fpotongan_sdview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="potongan_sd">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_potongan_sd_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->month->Visible) { // month ?>
    <tr id="r_month"<?= $Page->month->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_month"><?= $Page->month->caption() ?></span></td>
        <td data-name="month"<?= $Page->month->cellAttributes() ?>>
<span id="el_potongan_sd_month">
<span<?= $Page->month->viewAttributes() ?>>
<?= $Page->month->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
    <tr id="r_jenjang_id"<?= $Page->jenjang_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_jenjang_id"><?= $Page->jenjang_id->caption() ?></span></td>
        <td data-name="jenjang_id"<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el_potongan_sd_jenjang_id">
<span<?= $Page->jenjang_id->viewAttributes() ?>>
<?= $Page->jenjang_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
    <tr id="r_jabatan_id"<?= $Page->jabatan_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_jabatan_id"><?= $Page->jabatan_id->caption() ?></span></td>
        <td data-name="jabatan_id"<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el_potongan_sd_jabatan_id">
<span<?= $Page->jabatan_id->viewAttributes() ?>>
<?= $Page->jabatan_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <tr id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_nama"><?= $Page->nama->caption() ?></span></td>
        <td data-name="nama"<?= $Page->nama->cellAttributes() ?>>
<span id="el_potongan_sd_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->terlambat->Visible) { // terlambat ?>
    <tr id="r_terlambat"<?= $Page->terlambat->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_terlambat"><?= $Page->terlambat->caption() ?></span></td>
        <td data-name="terlambat"<?= $Page->terlambat->cellAttributes() ?>>
<span id="el_potongan_sd_terlambat">
<span<?= $Page->terlambat->viewAttributes() ?>>
<?= $Page->terlambat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->value_terlambat->Visible) { // value_terlambat ?>
    <tr id="r_value_terlambat"<?= $Page->value_terlambat->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_value_terlambat"><?= $Page->value_terlambat->caption() ?></span></td>
        <td data-name="value_terlambat"<?= $Page->value_terlambat->cellAttributes() ?>>
<span id="el_potongan_sd_value_terlambat">
<span<?= $Page->value_terlambat->viewAttributes() ?>>
<?= $Page->value_terlambat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->izin->Visible) { // izin ?>
    <tr id="r_izin"<?= $Page->izin->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_izin"><?= $Page->izin->caption() ?></span></td>
        <td data-name="izin"<?= $Page->izin->cellAttributes() ?>>
<span id="el_potongan_sd_izin">
<span<?= $Page->izin->viewAttributes() ?>>
<?= $Page->izin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->value_izin->Visible) { // value_izin ?>
    <tr id="r_value_izin"<?= $Page->value_izin->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_value_izin"><?= $Page->value_izin->caption() ?></span></td>
        <td data-name="value_izin"<?= $Page->value_izin->cellAttributes() ?>>
<span id="el_potongan_sd_value_izin">
<span<?= $Page->value_izin->viewAttributes() ?>>
<?= $Page->value_izin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sakit->Visible) { // sakit ?>
    <tr id="r_sakit"<?= $Page->sakit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_sakit"><?= $Page->sakit->caption() ?></span></td>
        <td data-name="sakit"<?= $Page->sakit->cellAttributes() ?>>
<span id="el_potongan_sd_sakit">
<span<?= $Page->sakit->viewAttributes() ?>>
<?= $Page->sakit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->value_sakit->Visible) { // value_sakit ?>
    <tr id="r_value_sakit"<?= $Page->value_sakit->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_value_sakit"><?= $Page->value_sakit->caption() ?></span></td>
        <td data-name="value_sakit"<?= $Page->value_sakit->cellAttributes() ?>>
<span id="el_potongan_sd_value_sakit">
<span<?= $Page->value_sakit->viewAttributes() ?>>
<?= $Page->value_sakit->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sakitperjam->Visible) { // sakitperjam ?>
    <tr id="r_sakitperjam"<?= $Page->sakitperjam->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_sakitperjam"><?= $Page->sakitperjam->caption() ?></span></td>
        <td data-name="sakitperjam"<?= $Page->sakitperjam->cellAttributes() ?>>
<span id="el_potongan_sd_sakitperjam">
<span<?= $Page->sakitperjam->viewAttributes() ?>>
<?= $Page->sakitperjam->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sakitperjamvalue->Visible) { // sakitperjamvalue ?>
    <tr id="r_sakitperjamvalue"<?= $Page->sakitperjamvalue->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_sakitperjamvalue"><?= $Page->sakitperjamvalue->caption() ?></span></td>
        <td data-name="sakitperjamvalue"<?= $Page->sakitperjamvalue->cellAttributes() ?>>
<span id="el_potongan_sd_sakitperjamvalue">
<span<?= $Page->sakitperjamvalue->viewAttributes() ?>>
<?= $Page->sakitperjamvalue->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pulcep->Visible) { // pulcep ?>
    <tr id="r_pulcep"<?= $Page->pulcep->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_pulcep"><?= $Page->pulcep->caption() ?></span></td>
        <td data-name="pulcep"<?= $Page->pulcep->cellAttributes() ?>>
<span id="el_potongan_sd_pulcep">
<span<?= $Page->pulcep->viewAttributes() ?>>
<?= $Page->pulcep->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->value_pulcep->Visible) { // value_pulcep ?>
    <tr id="r_value_pulcep"<?= $Page->value_pulcep->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_value_pulcep"><?= $Page->value_pulcep->caption() ?></span></td>
        <td data-name="value_pulcep"<?= $Page->value_pulcep->cellAttributes() ?>>
<span id="el_potongan_sd_value_pulcep">
<span<?= $Page->value_pulcep->viewAttributes() ?>>
<?= $Page->value_pulcep->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tidakhadir->Visible) { // tidakhadir ?>
    <tr id="r_tidakhadir"<?= $Page->tidakhadir->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_tidakhadir"><?= $Page->tidakhadir->caption() ?></span></td>
        <td data-name="tidakhadir"<?= $Page->tidakhadir->cellAttributes() ?>>
<span id="el_potongan_sd_tidakhadir">
<span<?= $Page->tidakhadir->viewAttributes() ?>>
<?= $Page->tidakhadir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->value_tidakhadir->Visible) { // value_tidakhadir ?>
    <tr id="r_value_tidakhadir"<?= $Page->value_tidakhadir->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_value_tidakhadir"><?= $Page->value_tidakhadir->caption() ?></span></td>
        <td data-name="value_tidakhadir"<?= $Page->value_tidakhadir->cellAttributes() ?>>
<span id="el_potongan_sd_value_tidakhadir">
<span<?= $Page->value_tidakhadir->viewAttributes() ?>>
<?= $Page->value_tidakhadir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tidakhadirjam->Visible) { // tidakhadirjam ?>
    <tr id="r_tidakhadirjam"<?= $Page->tidakhadirjam->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_tidakhadirjam"><?= $Page->tidakhadirjam->caption() ?></span></td>
        <td data-name="tidakhadirjam"<?= $Page->tidakhadirjam->cellAttributes() ?>>
<span id="el_potongan_sd_tidakhadirjam">
<span<?= $Page->tidakhadirjam->viewAttributes() ?>>
<?= $Page->tidakhadirjam->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tidakhadirjamvalue->Visible) { // tidakhadirjamvalue ?>
    <tr id="r_tidakhadirjamvalue"<?= $Page->tidakhadirjamvalue->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_tidakhadirjamvalue"><?= $Page->tidakhadirjamvalue->caption() ?></span></td>
        <td data-name="tidakhadirjamvalue"<?= $Page->tidakhadirjamvalue->cellAttributes() ?>>
<span id="el_potongan_sd_tidakhadirjamvalue">
<span<?= $Page->tidakhadirjamvalue->viewAttributes() ?>>
<?= $Page->tidakhadirjamvalue->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->izinperjam->Visible) { // izinperjam ?>
    <tr id="r_izinperjam"<?= $Page->izinperjam->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_izinperjam"><?= $Page->izinperjam->caption() ?></span></td>
        <td data-name="izinperjam"<?= $Page->izinperjam->cellAttributes() ?>>
<span id="el_potongan_sd_izinperjam">
<span<?= $Page->izinperjam->viewAttributes() ?>>
<?= $Page->izinperjam->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->izinperjamvalue->Visible) { // izinperjamvalue ?>
    <tr id="r_izinperjamvalue"<?= $Page->izinperjamvalue->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_izinperjamvalue"><?= $Page->izinperjamvalue->caption() ?></span></td>
        <td data-name="izinperjamvalue"<?= $Page->izinperjamvalue->cellAttributes() ?>>
<span id="el_potongan_sd_izinperjamvalue">
<span<?= $Page->izinperjamvalue->viewAttributes() ?>>
<?= $Page->izinperjamvalue->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
    <tr id="r_total"<?= $Page->total->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_total"><?= $Page->total->caption() ?></span></td>
        <td data-name="total"<?= $Page->total->cellAttributes() ?>>
<span id="el_potongan_sd_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->u_by->Visible) { // u_by ?>
    <tr id="r_u_by"<?= $Page->u_by->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_u_by"><?= $Page->u_by->caption() ?></span></td>
        <td data-name="u_by"<?= $Page->u_by->cellAttributes() ?>>
<span id="el_potongan_sd_u_by">
<span<?= $Page->u_by->viewAttributes() ?>>
<?= $Page->u_by->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->datetime->Visible) { // datetime ?>
    <tr id="r_datetime"<?= $Page->datetime->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_potongan_sd_datetime"><?= $Page->datetime->caption() ?></span></td>
        <td data-name="datetime"<?= $Page->datetime->cellAttributes() ?>>
<span id="el_potongan_sd_datetime">
<span<?= $Page->datetime->viewAttributes() ?>>
<?= $Page->datetime->getViewValue() ?></span>
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
