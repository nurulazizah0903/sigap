<?php

namespace PHPMaker2022\sigap;

// Page object
$GajiView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gaji: currentTable } });
var currentForm, currentPageID;
var fgajiview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajiview = new ew.Form("fgajiview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fgajiview;
    loadjs.done("fgajiview");
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
<form name="fgajiview" id="fgajiview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gaji">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_gaji_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
    <tr id="r_jabatan_id"<?= $Page->jabatan_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_jabatan_id"><?= $Page->jabatan_id->caption() ?></span></td>
        <td data-name="jabatan_id"<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el_gaji_jabatan_id">
<span<?= $Page->jabatan_id->viewAttributes() ?>>
<?= $Page->jabatan_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pegawai->Visible) { // pegawai ?>
    <tr id="r_pegawai"<?= $Page->pegawai->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_pegawai"><?= $Page->pegawai->caption() ?></span></td>
        <td data-name="pegawai"<?= $Page->pegawai->cellAttributes() ?>>
<span id="el_gaji_pegawai">
<span<?= $Page->pegawai->viewAttributes() ?>>
<?= $Page->pegawai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lembur->Visible) { // lembur ?>
    <tr id="r_lembur"<?= $Page->lembur->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_lembur"><?= $Page->lembur->caption() ?></span></td>
        <td data-name="lembur"<?= $Page->lembur->cellAttributes() ?>>
<span id="el_gaji_lembur">
<span<?= $Page->lembur->viewAttributes() ?>>
<?= $Page->lembur->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->value_lembur->Visible) { // value_lembur ?>
    <tr id="r_value_lembur"<?= $Page->value_lembur->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_value_lembur"><?= $Page->value_lembur->caption() ?></span></td>
        <td data-name="value_lembur"<?= $Page->value_lembur->cellAttributes() ?>>
<span id="el_gaji_value_lembur">
<span<?= $Page->value_lembur->viewAttributes() ?>>
<?= $Page->value_lembur->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kehadiran->Visible) { // kehadiran ?>
    <tr id="r_kehadiran"<?= $Page->kehadiran->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_kehadiran"><?= $Page->kehadiran->caption() ?></span></td>
        <td data-name="kehadiran"<?= $Page->kehadiran->cellAttributes() ?>>
<span id="el_gaji_kehadiran">
<span<?= $Page->kehadiran->viewAttributes() ?>>
<?= $Page->kehadiran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gapok->Visible) { // gapok ?>
    <tr id="r_gapok"<?= $Page->gapok->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_gapok"><?= $Page->gapok->caption() ?></span></td>
        <td data-name="gapok"<?= $Page->gapok->cellAttributes() ?>>
<span id="el_gaji_gapok">
<span<?= $Page->gapok->viewAttributes() ?>>
<?= $Page->gapok->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->value_reward->Visible) { // value_reward ?>
    <tr id="r_value_reward"<?= $Page->value_reward->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_value_reward"><?= $Page->value_reward->caption() ?></span></td>
        <td data-name="value_reward"<?= $Page->value_reward->cellAttributes() ?>>
<span id="el_gaji_value_reward">
<span<?= $Page->value_reward->viewAttributes() ?>>
<?= $Page->value_reward->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->value_inval->Visible) { // value_inval ?>
    <tr id="r_value_inval"<?= $Page->value_inval->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_value_inval"><?= $Page->value_inval->caption() ?></span></td>
        <td data-name="value_inval"<?= $Page->value_inval->cellAttributes() ?>>
<span id="el_gaji_value_inval">
<span<?= $Page->value_inval->viewAttributes() ?>>
<?= $Page->value_inval->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->piket_count->Visible) { // piket_count ?>
    <tr id="r_piket_count"<?= $Page->piket_count->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_piket_count"><?= $Page->piket_count->caption() ?></span></td>
        <td data-name="piket_count"<?= $Page->piket_count->cellAttributes() ?>>
<span id="el_gaji_piket_count">
<span<?= $Page->piket_count->viewAttributes() ?>>
<?= $Page->piket_count->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->value_piket->Visible) { // value_piket ?>
    <tr id="r_value_piket"<?= $Page->value_piket->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_value_piket"><?= $Page->value_piket->caption() ?></span></td>
        <td data-name="value_piket"<?= $Page->value_piket->cellAttributes() ?>>
<span id="el_gaji_value_piket">
<span<?= $Page->value_piket->viewAttributes() ?>>
<?= $Page->value_piket->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tugastambahan->Visible) { // tugastambahan ?>
    <tr id="r_tugastambahan"<?= $Page->tugastambahan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_tugastambahan"><?= $Page->tugastambahan->caption() ?></span></td>
        <td data-name="tugastambahan"<?= $Page->tugastambahan->cellAttributes() ?>>
<span id="el_gaji_tugastambahan">
<span<?= $Page->tugastambahan->viewAttributes() ?>>
<?= $Page->tugastambahan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tj_jabatan->Visible) { // tj_jabatan ?>
    <tr id="r_tj_jabatan"<?= $Page->tj_jabatan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_tj_jabatan"><?= $Page->tj_jabatan->caption() ?></span></td>
        <td data-name="tj_jabatan"<?= $Page->tj_jabatan->cellAttributes() ?>>
<span id="el_gaji_tj_jabatan">
<span<?= $Page->tj_jabatan->viewAttributes() ?>>
<?= $Page->tj_jabatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->sub_total->Visible) { // sub_total ?>
    <tr id="r_sub_total"<?= $Page->sub_total->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_sub_total"><?= $Page->sub_total->caption() ?></span></td>
        <td data-name="sub_total"<?= $Page->sub_total->cellAttributes() ?>>
<span id="el_gaji_sub_total">
<span<?= $Page->sub_total->viewAttributes() ?>>
<?= $Page->sub_total->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->potongan->Visible) { // potongan ?>
    <tr id="r_potongan"<?= $Page->potongan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_potongan"><?= $Page->potongan->caption() ?></span></td>
        <td data-name="potongan"<?= $Page->potongan->cellAttributes() ?>>
<span id="el_gaji_potongan">
<span<?= $Page->potongan->viewAttributes() ?>>
<?= $Page->potongan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->total->Visible) { // total ?>
    <tr id="r_total"<?= $Page->total->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_total"><?= $Page->total->caption() ?></span></td>
        <td data-name="total"<?= $Page->total->cellAttributes() ?>>
<span id="el_gaji_total">
<span<?= $Page->total->viewAttributes() ?>>
<?= $Page->total->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->month->Visible) { // month ?>
    <tr id="r_month"<?= $Page->month->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_month"><?= $Page->month->caption() ?></span></td>
        <td data-name="month"<?= $Page->month->cellAttributes() ?>>
<span id="el_gaji_month">
<span<?= $Page->month->viewAttributes() ?>>
<?= $Page->month->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->datetime->Visible) { // datetime ?>
    <tr id="r_datetime"<?= $Page->datetime->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gaji_datetime"><?= $Page->datetime->caption() ?></span></td>
        <td data-name="datetime"<?= $Page->datetime->cellAttributes() ?>>
<span id="el_gaji_datetime">
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
