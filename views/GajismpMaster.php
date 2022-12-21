<?php

namespace PHPMaker2022\sigap;

// Table
$gajismp = Container("gajismp");
?>
<?php if ($gajismp->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_gajismpmaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($gajismp->id->Visible) { // id ?>
        <tr id="r_id"<?= $gajismp->id->rowAttributes() ?>>
            <td class="<?= $gajismp->TableLeftColumnClass ?>"><?= $gajismp->id->caption() ?></td>
            <td<?= $gajismp->id->cellAttributes() ?>>
<span id="el_gajismp_id">
<span<?= $gajismp->id->viewAttributes() ?>>
<?= $gajismp->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($gajismp->tahun->Visible) { // tahun ?>
        <tr id="r_tahun"<?= $gajismp->tahun->rowAttributes() ?>>
            <td class="<?= $gajismp->TableLeftColumnClass ?>"><?= $gajismp->tahun->caption() ?></td>
            <td<?= $gajismp->tahun->cellAttributes() ?>>
<span id="el_gajismp_tahun">
<span<?= $gajismp->tahun->viewAttributes() ?>>
<?= $gajismp->tahun->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($gajismp->bulan->Visible) { // bulan ?>
        <tr id="r_bulan"<?= $gajismp->bulan->rowAttributes() ?>>
            <td class="<?= $gajismp->TableLeftColumnClass ?>"><?= $gajismp->bulan->caption() ?></td>
            <td<?= $gajismp->bulan->cellAttributes() ?>>
<span id="el_gajismp_bulan">
<span<?= $gajismp->bulan->viewAttributes() ?>>
<?= $gajismp->bulan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($gajismp->tingkat->Visible) { // tingkat ?>
        <tr id="r_tingkat"<?= $gajismp->tingkat->rowAttributes() ?>>
            <td class="<?= $gajismp->TableLeftColumnClass ?>"><?= $gajismp->tingkat->caption() ?></td>
            <td<?= $gajismp->tingkat->cellAttributes() ?>>
<span id="el_gajismp_tingkat">
<span<?= $gajismp->tingkat->viewAttributes() ?>>
<?= $gajismp->tingkat->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
