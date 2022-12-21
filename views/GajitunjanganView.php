<?php

namespace PHPMaker2022\sigap;

// Page object
$GajitunjanganView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gajitunjangan: currentTable } });
var currentForm, currentPageID;
var fgajitunjanganview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajitunjanganview = new ew.Form("fgajitunjanganview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fgajitunjanganview;
    loadjs.done("fgajitunjanganview");
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
<form name="fgajitunjanganview" id="fgajitunjanganview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gajitunjangan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_gajitunjangan_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pidjabatan->Visible) { // pidjabatan ?>
    <tr id="r_pidjabatan"<?= $Page->pidjabatan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_pidjabatan"><?= $Page->pidjabatan->caption() ?></span></td>
        <td data-name="pidjabatan"<?= $Page->pidjabatan->cellAttributes() ?>>
<span id="el_gajitunjangan_pidjabatan">
<span<?= $Page->pidjabatan->viewAttributes() ?>>
<?= $Page->pidjabatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gapok->Visible) { // gapok ?>
    <tr id="r_gapok"<?= $Page->gapok->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_gapok"><?= $Page->gapok->caption() ?></span></td>
        <td data-name="gapok"<?= $Page->gapok->cellAttributes() ?>>
<span id="el_gajitunjangan_gapok">
<span<?= $Page->gapok->viewAttributes() ?>>
<?= $Page->gapok->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->value_kehadiran->Visible) { // value_kehadiran ?>
    <tr id="r_value_kehadiran"<?= $Page->value_kehadiran->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_value_kehadiran"><?= $Page->value_kehadiran->caption() ?></span></td>
        <td data-name="value_kehadiran"<?= $Page->value_kehadiran->cellAttributes() ?>>
<span id="el_gajitunjangan_value_kehadiran">
<span<?= $Page->value_kehadiran->viewAttributes() ?>>
<?= $Page->value_kehadiran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
    <tr id="r_tunjangan_jabatan"<?= $Page->tunjangan_jabatan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_tunjangan_jabatan"><?= $Page->tunjangan_jabatan->caption() ?></span></td>
        <td data-name="tunjangan_jabatan"<?= $Page->tunjangan_jabatan->cellAttributes() ?>>
<span id="el_gajitunjangan_tunjangan_jabatan">
<span<?= $Page->tunjangan_jabatan->viewAttributes() ?>>
<?= $Page->tunjangan_jabatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
    <tr id="r_tunjangan_khusus"<?= $Page->tunjangan_khusus->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_tunjangan_khusus"><?= $Page->tunjangan_khusus->caption() ?></span></td>
        <td data-name="tunjangan_khusus"<?= $Page->tunjangan_khusus->cellAttributes() ?>>
<span id="el_gajitunjangan_tunjangan_khusus">
<span<?= $Page->tunjangan_khusus->viewAttributes() ?>>
<?= $Page->tunjangan_khusus->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->reward->Visible) { // reward ?>
    <tr id="r_reward"<?= $Page->reward->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_reward"><?= $Page->reward->caption() ?></span></td>
        <td data-name="reward"<?= $Page->reward->cellAttributes() ?>>
<span id="el_gajitunjangan_reward">
<span<?= $Page->reward->viewAttributes() ?>>
<?= $Page->reward->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->lembur->Visible) { // lembur ?>
    <tr id="r_lembur"<?= $Page->lembur->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_lembur"><?= $Page->lembur->caption() ?></span></td>
        <td data-name="lembur"<?= $Page->lembur->cellAttributes() ?>>
<span id="el_gajitunjangan_lembur">
<span<?= $Page->lembur->viewAttributes() ?>>
<?= $Page->lembur->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->piket->Visible) { // piket ?>
    <tr id="r_piket"<?= $Page->piket->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_piket"><?= $Page->piket->caption() ?></span></td>
        <td data-name="piket"<?= $Page->piket->cellAttributes() ?>>
<span id="el_gajitunjangan_piket">
<span<?= $Page->piket->viewAttributes() ?>>
<?= $Page->piket->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->inval->Visible) { // inval ?>
    <tr id="r_inval"<?= $Page->inval->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_inval"><?= $Page->inval->caption() ?></span></td>
        <td data-name="inval"<?= $Page->inval->cellAttributes() ?>>
<span id="el_gajitunjangan_inval">
<span<?= $Page->inval->viewAttributes() ?>>
<?= $Page->inval->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jam_lebih->Visible) { // jam_lebih ?>
    <tr id="r_jam_lebih"<?= $Page->jam_lebih->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_jam_lebih"><?= $Page->jam_lebih->caption() ?></span></td>
        <td data-name="jam_lebih"<?= $Page->jam_lebih->cellAttributes() ?>>
<span id="el_gajitunjangan_jam_lebih">
<span<?= $Page->jam_lebih->viewAttributes() ?>>
<?= $Page->jam_lebih->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ekstrakuri->Visible) { // ekstrakuri ?>
    <tr id="r_ekstrakuri"<?= $Page->ekstrakuri->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajitunjangan_ekstrakuri"><?= $Page->ekstrakuri->caption() ?></span></td>
        <td data-name="ekstrakuri"<?= $Page->ekstrakuri->cellAttributes() ?>>
<span id="el_gajitunjangan_ekstrakuri">
<span<?= $Page->ekstrakuri->viewAttributes() ?>>
<?= $Page->ekstrakuri->getViewValue() ?></span>
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
