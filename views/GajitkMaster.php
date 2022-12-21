<?php

namespace PHPMaker2022\sigap;

// Table
$gajitk = Container("gajitk");
?>
<?php if ($gajitk->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_gajitkmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($gajitk->tahun->Visible) { // tahun ?>
        <tr id="r_tahun"<?= $gajitk->tahun->rowAttributes() ?>>
            <td class="<?= $gajitk->TableLeftColumnClass ?>"><?= $gajitk->tahun->caption() ?></td>
            <td<?= $gajitk->tahun->cellAttributes() ?>>
<span id="el_gajitk_tahun">
<span<?= $gajitk->tahun->viewAttributes() ?>>
<?= $gajitk->tahun->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($gajitk->bulan->Visible) { // bulan ?>
        <tr id="r_bulan"<?= $gajitk->bulan->rowAttributes() ?>>
            <td class="<?= $gajitk->TableLeftColumnClass ?>"><?= $gajitk->bulan->caption() ?></td>
            <td<?= $gajitk->bulan->cellAttributes() ?>>
<span id="el_gajitk_bulan">
<span<?= $gajitk->bulan->viewAttributes() ?>>
<?= $gajitk->bulan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($gajitk->tingkat->Visible) { // tingkat ?>
        <tr id="r_tingkat"<?= $gajitk->tingkat->rowAttributes() ?>>
            <td class="<?= $gajitk->TableLeftColumnClass ?>"><?= $gajitk->tingkat->caption() ?></td>
            <td<?= $gajitk->tingkat->cellAttributes() ?>>
<span id="el_gajitk_tingkat">
<span<?= $gajitk->tingkat->viewAttributes() ?>>
<?= $gajitk->tingkat->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
