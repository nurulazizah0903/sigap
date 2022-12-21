<?php

namespace PHPMaker2022\sigap;

// Table
$gajismk = Container("gajismk");
?>
<?php if ($gajismk->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_gajismkmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($gajismk->id->Visible) { // id ?>
        <tr id="r_id"<?= $gajismk->id->rowAttributes() ?>>
            <td class="<?= $gajismk->TableLeftColumnClass ?>"><?= $gajismk->id->caption() ?></td>
            <td<?= $gajismk->id->cellAttributes() ?>>
<span id="el_gajismk_id">
<span<?= $gajismk->id->viewAttributes() ?>>
<?= $gajismk->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($gajismk->tahun->Visible) { // tahun ?>
        <tr id="r_tahun"<?= $gajismk->tahun->rowAttributes() ?>>
            <td class="<?= $gajismk->TableLeftColumnClass ?>"><?= $gajismk->tahun->caption() ?></td>
            <td<?= $gajismk->tahun->cellAttributes() ?>>
<span id="el_gajismk_tahun">
<span<?= $gajismk->tahun->viewAttributes() ?>>
<?= $gajismk->tahun->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($gajismk->bulan->Visible) { // bulan ?>
        <tr id="r_bulan"<?= $gajismk->bulan->rowAttributes() ?>>
            <td class="<?= $gajismk->TableLeftColumnClass ?>"><?= $gajismk->bulan->caption() ?></td>
            <td<?= $gajismk->bulan->cellAttributes() ?>>
<span id="el_gajismk_bulan">
<span<?= $gajismk->bulan->viewAttributes() ?>>
<?= $gajismk->bulan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($gajismk->tingkat->Visible) { // tingkat ?>
        <tr id="r_tingkat"<?= $gajismk->tingkat->rowAttributes() ?>>
            <td class="<?= $gajismk->TableLeftColumnClass ?>"><?= $gajismk->tingkat->caption() ?></td>
            <td<?= $gajismk->tingkat->cellAttributes() ?>>
<span id="el_gajismk_tingkat">
<span<?= $gajismk->tingkat->viewAttributes() ?>>
<?= $gajismk->tingkat->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
