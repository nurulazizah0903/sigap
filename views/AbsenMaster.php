<?php

namespace PHPMaker2022\sigap;

// Table
$absen = Container("absen");
?>
<?php if ($absen->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_absenmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($absen->pemeriksa->Visible) { // pemeriksa ?>
        <tr id="r_pemeriksa"<?= $absen->pemeriksa->rowAttributes() ?>>
            <td class="<?= $absen->TableLeftColumnClass ?>"><?= $absen->pemeriksa->caption() ?></td>
            <td<?= $absen->pemeriksa->cellAttributes() ?>>
<span id="el_absen_pemeriksa">
<span<?= $absen->pemeriksa->viewAttributes() ?>>
<?= $absen->pemeriksa->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($absen->bulan->Visible) { // bulan ?>
        <tr id="r_bulan"<?= $absen->bulan->rowAttributes() ?>>
            <td class="<?= $absen->TableLeftColumnClass ?>"><?= $absen->bulan->caption() ?></td>
            <td<?= $absen->bulan->cellAttributes() ?>>
<span id="el_absen_bulan">
<span<?= $absen->bulan->viewAttributes() ?>>
<?= $absen->bulan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($absen->jumlah_hari_kerja->Visible) { // jumlah_hari_kerja ?>
        <tr id="r_jumlah_hari_kerja"<?= $absen->jumlah_hari_kerja->rowAttributes() ?>>
            <td class="<?= $absen->TableLeftColumnClass ?>"><?= $absen->jumlah_hari_kerja->caption() ?></td>
            <td<?= $absen->jumlah_hari_kerja->cellAttributes() ?>>
<span id="el_absen_jumlah_hari_kerja">
<span<?= $absen->jumlah_hari_kerja->viewAttributes() ?>>
<?= $absen->jumlah_hari_kerja->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
