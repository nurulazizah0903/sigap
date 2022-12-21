<?php

namespace PHPMaker2022\sigap;

// Page object
$GajismpDetilView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gajismp_detil: currentTable } });
var currentForm, currentPageID;
var fgajismp_detilview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajismp_detilview = new ew.Form("fgajismp_detilview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fgajismp_detilview;
    loadjs.done("fgajismp_detilview");
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
<form name="fgajismp_detilview" id="fgajismp_detilview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gajismp_detil">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_gajismp_detil_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pid->Visible) { // pid ?>
    <tr id="r_pid"<?= $Page->pid->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_pid"><?= $Page->pid->caption() ?></span></td>
        <td data-name="pid"<?= $Page->pid->cellAttributes() ?>>
<span id="el_gajismp_detil_pid">
<span<?= $Page->pid->viewAttributes() ?>>
<?= $Page->pid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pegawai_id->Visible) { // pegawai_id ?>
    <tr id="r_pegawai_id"<?= $Page->pegawai_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_pegawai_id"><?= $Page->pegawai_id->caption() ?></span></td>
        <td data-name="pegawai_id"<?= $Page->pegawai_id->cellAttributes() ?>>
<span id="el_gajismp_detil_pegawai_id">
<span<?= $Page->pegawai_id->viewAttributes() ?>>
<?= $Page->pegawai_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
    <tr id="r_jabatan_id"<?= $Page->jabatan_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_jabatan_id"><?= $Page->jabatan_id->caption() ?></span></td>
        <td data-name="jabatan_id"<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el_gajismp_detil_jabatan_id">
<span<?= $Page->jabatan_id->viewAttributes() ?>>
<?= $Page->jabatan_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->masakerja->Visible) { // masakerja ?>
    <tr id="r_masakerja"<?= $Page->masakerja->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_masakerja"><?= $Page->masakerja->caption() ?></span></td>
        <td data-name="masakerja"<?= $Page->masakerja->cellAttributes() ?>>
<span id="el_gajismp_detil_masakerja">
<span<?= $Page->masakerja->viewAttributes() ?>>
<?= $Page->masakerja->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jumngajar->Visible) { // jumngajar ?>
    <tr id="r_jumngajar"<?= $Page->jumngajar->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_jumngajar"><?= $Page->jumngajar->caption() ?></span></td>
        <td data-name="jumngajar"<?= $Page->jumngajar->cellAttributes() ?>>
<span id="el_gajismp_detil_jumngajar">
<span<?= $Page->jumngajar->viewAttributes() ?>>
<?= $Page->jumngajar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->ijin->Visible) { // ijin ?>
    <tr id="r_ijin"<?= $Page->ijin->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_ijin"><?= $Page->ijin->caption() ?></span></td>
        <td data-name="ijin"<?= $Page->ijin->cellAttributes() ?>>
<span id="el_gajismp_detil_ijin">
<span<?= $Page->ijin->viewAttributes() ?>>
<?= $Page->ijin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
    <tr id="r_tunjangan_wkosis"<?= $Page->tunjangan_wkosis->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_tunjangan_wkosis"><?= $Page->tunjangan_wkosis->caption() ?></span></td>
        <td data-name="tunjangan_wkosis"<?= $Page->tunjangan_wkosis->cellAttributes() ?>>
<span id="el_gajismp_detil_tunjangan_wkosis">
<span<?= $Page->tunjangan_wkosis->viewAttributes() ?>>
<?= $Page->tunjangan_wkosis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nominal_baku->Visible) { // nominal_baku ?>
    <tr id="r_nominal_baku"<?= $Page->nominal_baku->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_nominal_baku"><?= $Page->nominal_baku->caption() ?></span></td>
        <td data-name="nominal_baku"<?= $Page->nominal_baku->cellAttributes() ?>>
<span id="el_gajismp_detil_nominal_baku">
<span<?= $Page->nominal_baku->viewAttributes() ?>>
<?= $Page->nominal_baku->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->baku->Visible) { // baku ?>
    <tr id="r_baku"<?= $Page->baku->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_baku"><?= $Page->baku->caption() ?></span></td>
        <td data-name="baku"<?= $Page->baku->cellAttributes() ?>>
<span id="el_gajismp_detil_baku">
<span<?= $Page->baku->viewAttributes() ?>>
<?= $Page->baku->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kehadiran->Visible) { // kehadiran ?>
    <tr id="r_kehadiran"<?= $Page->kehadiran->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_kehadiran"><?= $Page->kehadiran->caption() ?></span></td>
        <td data-name="kehadiran"<?= $Page->kehadiran->cellAttributes() ?>>
<span id="el_gajismp_detil_kehadiran">
<span<?= $Page->kehadiran->viewAttributes() ?>>
<?= $Page->kehadiran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->prestasi->Visible) { // prestasi ?>
    <tr id="r_prestasi"<?= $Page->prestasi->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_prestasi"><?= $Page->prestasi->caption() ?></span></td>
        <td data-name="prestasi"<?= $Page->prestasi->cellAttributes() ?>>
<span id="el_gajismp_detil_prestasi">
<span<?= $Page->prestasi->viewAttributes() ?>>
<?= $Page->prestasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jumlahgaji->Visible) { // jumlahgaji ?>
    <tr id="r_jumlahgaji"<?= $Page->jumlahgaji->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_jumlahgaji"><?= $Page->jumlahgaji->caption() ?></span></td>
        <td data-name="jumlahgaji"<?= $Page->jumlahgaji->cellAttributes() ?>>
<span id="el_gajismp_detil_jumlahgaji">
<span<?= $Page->jumlahgaji->viewAttributes() ?>>
<?= $Page->jumlahgaji->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jumgajitotal->Visible) { // jumgajitotal ?>
    <tr id="r_jumgajitotal"<?= $Page->jumgajitotal->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_jumgajitotal"><?= $Page->jumgajitotal->caption() ?></span></td>
        <td data-name="jumgajitotal"<?= $Page->jumgajitotal->cellAttributes() ?>>
<span id="el_gajismp_detil_jumgajitotal">
<span<?= $Page->jumgajitotal->viewAttributes() ?>>
<?= $Page->jumgajitotal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->potongan1->Visible) { // potongan1 ?>
    <tr id="r_potongan1"<?= $Page->potongan1->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_potongan1"><?= $Page->potongan1->caption() ?></span></td>
        <td data-name="potongan1"<?= $Page->potongan1->cellAttributes() ?>>
<span id="el_gajismp_detil_potongan1">
<span<?= $Page->potongan1->viewAttributes() ?>>
<?= $Page->potongan1->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->potongan2->Visible) { // potongan2 ?>
    <tr id="r_potongan2"<?= $Page->potongan2->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_potongan2"><?= $Page->potongan2->caption() ?></span></td>
        <td data-name="potongan2"<?= $Page->potongan2->cellAttributes() ?>>
<span id="el_gajismp_detil_potongan2">
<span<?= $Page->potongan2->viewAttributes() ?>>
<?= $Page->potongan2->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jumlahterima->Visible) { // jumlahterima ?>
    <tr id="r_jumlahterima"<?= $Page->jumlahterima->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_gajismp_detil_jumlahterima"><?= $Page->jumlahterima->caption() ?></span></td>
        <td data-name="jumlahterima"<?= $Page->jumlahterima->cellAttributes() ?>>
<span id="el_gajismp_detil_jumlahterima">
<span<?= $Page->jumlahterima->viewAttributes() ?>>
<?= $Page->jumlahterima->getViewValue() ?></span>
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
