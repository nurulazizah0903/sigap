<?php

namespace PHPMaker2022\sigap;

// Table
$gajisd = Container("gajisd");
?>
<?php if ($gajisd->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_gajisdmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($gajisd->tahun->Visible) { // tahun ?>
        <tr id="r_tahun"<?= $gajisd->tahun->rowAttributes() ?>>
            <td class="<?= $gajisd->TableLeftColumnClass ?>"><?= $gajisd->tahun->caption() ?></td>
            <td<?= $gajisd->tahun->cellAttributes() ?>>
<span id="el_gajisd_tahun">
<span<?= $gajisd->tahun->viewAttributes() ?>>
<?= $gajisd->tahun->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($gajisd->bulan->Visible) { // bulan ?>
        <tr id="r_bulan"<?= $gajisd->bulan->rowAttributes() ?>>
            <td class="<?= $gajisd->TableLeftColumnClass ?>"><?= $gajisd->bulan->caption() ?></td>
            <td<?= $gajisd->bulan->cellAttributes() ?>>
<span id="el_gajisd_bulan">
<span<?= $gajisd->bulan->viewAttributes() ?>>
<?= $gajisd->bulan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($gajisd->tingkat->Visible) { // tingkat ?>
        <tr id="r_tingkat"<?= $gajisd->tingkat->rowAttributes() ?>>
            <td class="<?= $gajisd->TableLeftColumnClass ?>"><?= $gajisd->tingkat->caption() ?></td>
            <td<?= $gajisd->tingkat->cellAttributes() ?>>
<span id="el_gajisd_tingkat">
<span<?= $gajisd->tingkat->viewAttributes() ?>>
<?= $gajisd->tingkat->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
