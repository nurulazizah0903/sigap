<?php

namespace PHPMaker2022\sigap;

// Page object
$GajisdDetilDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { gajisd_detil: currentTable } });
var currentForm, currentPageID;
var fgajisd_detildelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fgajisd_detildelete = new ew.Form("fgajisd_detildelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fgajisd_detildelete;
    loadjs.done("fgajisd_detildelete");
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
<form name="fgajisd_detildelete" id="fgajisd_detildelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="gajisd_detil">
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
<?php if ($Page->pegawai_id->Visible) { // pegawai_id ?>
        <th class="<?= $Page->pegawai_id->headerCellClass() ?>"><span id="elh_gajisd_detil_pegawai_id" class="gajisd_detil_pegawai_id"><?= $Page->pegawai_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <th class="<?= $Page->jabatan_id->headerCellClass() ?>"><span id="elh_gajisd_detil_jabatan_id" class="gajisd_detil_jabatan_id"><?= $Page->jabatan_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->masakerja->Visible) { // masakerja ?>
        <th class="<?= $Page->masakerja->headerCellClass() ?>"><span id="elh_gajisd_detil_masakerja" class="gajisd_detil_masakerja"><?= $Page->masakerja->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jumngajar->Visible) { // jumngajar ?>
        <th class="<?= $Page->jumngajar->headerCellClass() ?>"><span id="elh_gajisd_detil_jumngajar" class="gajisd_detil_jumngajar"><?= $Page->jumngajar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ijin->Visible) { // ijin ?>
        <th class="<?= $Page->ijin->headerCellClass() ?>"><span id="elh_gajisd_detil_ijin" class="gajisd_detil_ijin"><?= $Page->ijin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->baku->Visible) { // baku ?>
        <th class="<?= $Page->baku->headerCellClass() ?>"><span id="elh_gajisd_detil_baku" class="gajisd_detil_baku"><?= $Page->baku->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kehadiran->Visible) { // kehadiran ?>
        <th class="<?= $Page->kehadiran->headerCellClass() ?>"><span id="elh_gajisd_detil_kehadiran" class="gajisd_detil_kehadiran"><?= $Page->kehadiran->caption() ?></span></th>
<?php } ?>
<?php if ($Page->prestasi->Visible) { // prestasi ?>
        <th class="<?= $Page->prestasi->headerCellClass() ?>"><span id="elh_gajisd_detil_prestasi" class="gajisd_detil_prestasi"><?= $Page->prestasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nominal_baku->Visible) { // nominal_baku ?>
        <th class="<?= $Page->nominal_baku->headerCellClass() ?>"><span id="elh_gajisd_detil_nominal_baku" class="gajisd_detil_nominal_baku"><?= $Page->nominal_baku->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jumlahterima->Visible) { // jumlahterima ?>
        <th class="<?= $Page->jumlahterima->headerCellClass() ?>"><span id="elh_gajisd_detil_jumlahterima" class="gajisd_detil_jumlahterima"><?= $Page->jumlahterima->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
        <th class="<?= $Page->tunjangan_wkosis->headerCellClass() ?>"><span id="elh_gajisd_detil_tunjangan_wkosis" class="gajisd_detil_tunjangan_wkosis"><?= $Page->tunjangan_wkosis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->potongan1->Visible) { // potongan1 ?>
        <th class="<?= $Page->potongan1->headerCellClass() ?>"><span id="elh_gajisd_detil_potongan1" class="gajisd_detil_potongan1"><?= $Page->potongan1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->potongan2->Visible) { // potongan2 ?>
        <th class="<?= $Page->potongan2->headerCellClass() ?>"><span id="elh_gajisd_detil_potongan2" class="gajisd_detil_potongan2"><?= $Page->potongan2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jumlahgaji->Visible) { // jumlahgaji ?>
        <th class="<?= $Page->jumlahgaji->headerCellClass() ?>"><span id="elh_gajisd_detil_jumlahgaji" class="gajisd_detil_jumlahgaji"><?= $Page->jumlahgaji->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jumgajitotal->Visible) { // jumgajitotal ?>
        <th class="<?= $Page->jumgajitotal->headerCellClass() ?>"><span id="elh_gajisd_detil_jumgajitotal" class="gajisd_detil_jumgajitotal"><?= $Page->jumgajitotal->caption() ?></span></th>
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
<?php if ($Page->pegawai_id->Visible) { // pegawai_id ?>
        <td<?= $Page->pegawai_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_pegawai_id" class="el_gajisd_detil_pegawai_id">
<span<?= $Page->pegawai_id->viewAttributes() ?>>
<?= $Page->pegawai_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jabatan_id->Visible) { // jabatan_id ?>
        <td<?= $Page->jabatan_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_jabatan_id" class="el_gajisd_detil_jabatan_id">
<span<?= $Page->jabatan_id->viewAttributes() ?>>
<?= $Page->jabatan_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->masakerja->Visible) { // masakerja ?>
        <td<?= $Page->masakerja->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_masakerja" class="el_gajisd_detil_masakerja">
<span<?= $Page->masakerja->viewAttributes() ?>>
<?= $Page->masakerja->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jumngajar->Visible) { // jumngajar ?>
        <td<?= $Page->jumngajar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_jumngajar" class="el_gajisd_detil_jumngajar">
<span<?= $Page->jumngajar->viewAttributes() ?>>
<?= $Page->jumngajar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ijin->Visible) { // ijin ?>
        <td<?= $Page->ijin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_ijin" class="el_gajisd_detil_ijin">
<span<?= $Page->ijin->viewAttributes() ?>>
<?= $Page->ijin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->baku->Visible) { // baku ?>
        <td<?= $Page->baku->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_baku" class="el_gajisd_detil_baku">
<span<?= $Page->baku->viewAttributes() ?>>
<?= $Page->baku->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kehadiran->Visible) { // kehadiran ?>
        <td<?= $Page->kehadiran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_kehadiran" class="el_gajisd_detil_kehadiran">
<span<?= $Page->kehadiran->viewAttributes() ?>>
<?= $Page->kehadiran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->prestasi->Visible) { // prestasi ?>
        <td<?= $Page->prestasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_prestasi" class="el_gajisd_detil_prestasi">
<span<?= $Page->prestasi->viewAttributes() ?>>
<?= $Page->prestasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nominal_baku->Visible) { // nominal_baku ?>
        <td<?= $Page->nominal_baku->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_nominal_baku" class="el_gajisd_detil_nominal_baku">
<span<?= $Page->nominal_baku->viewAttributes() ?>>
<?= $Page->nominal_baku->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jumlahterima->Visible) { // jumlahterima ?>
        <td<?= $Page->jumlahterima->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_jumlahterima" class="el_gajisd_detil_jumlahterima">
<span<?= $Page->jumlahterima->viewAttributes() ?>>
<?= $Page->jumlahterima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
        <td<?= $Page->tunjangan_wkosis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_tunjangan_wkosis" class="el_gajisd_detil_tunjangan_wkosis">
<span<?= $Page->tunjangan_wkosis->viewAttributes() ?>>
<?= $Page->tunjangan_wkosis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->potongan1->Visible) { // potongan1 ?>
        <td<?= $Page->potongan1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_potongan1" class="el_gajisd_detil_potongan1">
<span<?= $Page->potongan1->viewAttributes() ?>>
<?= $Page->potongan1->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->potongan2->Visible) { // potongan2 ?>
        <td<?= $Page->potongan2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_potongan2" class="el_gajisd_detil_potongan2">
<span<?= $Page->potongan2->viewAttributes() ?>>
<?= $Page->potongan2->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jumlahgaji->Visible) { // jumlahgaji ?>
        <td<?= $Page->jumlahgaji->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_jumlahgaji" class="el_gajisd_detil_jumlahgaji">
<span<?= $Page->jumlahgaji->viewAttributes() ?>>
<?= $Page->jumlahgaji->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jumgajitotal->Visible) { // jumgajitotal ?>
        <td<?= $Page->jumgajitotal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_gajisd_detil_jumgajitotal" class="el_gajisd_detil_jumgajitotal">
<span<?= $Page->jumgajitotal->viewAttributes() ?>>
<?= $Page->jumgajitotal->getViewValue() ?></span>
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
