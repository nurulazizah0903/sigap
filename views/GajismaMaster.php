<?php

namespace PHPMaker2022\sigap;

// Table
$gajisma = Container("gajisma");
?>
<?php if ($gajisma->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_gajismamaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($gajisma->id->Visible) { // id ?>
        <tr id="r_id"<?= $gajisma->id->rowAttributes() ?>>
            <td class="<?= $gajisma->TableLeftColumnClass ?>"><?= $gajisma->id->caption() ?></td>
            <td<?= $gajisma->id->cellAttributes() ?>>
<span id="el_gajisma_id">
<span<?= $gajisma->id->viewAttributes() ?>>
<?= $gajisma->id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($gajisma->tahun->Visible) { // tahun ?>
        <tr id="r_tahun"<?= $gajisma->tahun->rowAttributes() ?>>
            <td class="<?= $gajisma->TableLeftColumnClass ?>"><?= $gajisma->tahun->caption() ?></td>
            <td<?= $gajisma->tahun->cellAttributes() ?>>
<span id="el_gajisma_tahun">
<span<?= $gajisma->tahun->viewAttributes() ?>>
<?= $gajisma->tahun->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($gajisma->bulan->Visible) { // bulan ?>
        <tr id="r_bulan"<?= $gajisma->bulan->rowAttributes() ?>>
            <td class="<?= $gajisma->TableLeftColumnClass ?>"><?= $gajisma->bulan->caption() ?></td>
            <td<?= $gajisma->bulan->cellAttributes() ?>>
<span id="el_gajisma_bulan">
<span<?= $gajisma->bulan->viewAttributes() ?>>
<?= $gajisma->bulan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($gajisma->tingkat->Visible) { // tingkat ?>
        <tr id="r_tingkat"<?= $gajisma->tingkat->rowAttributes() ?>>
            <td class="<?= $gajisma->TableLeftColumnClass ?>"><?= $gajisma->tingkat->caption() ?></td>
            <td<?= $gajisma->tingkat->cellAttributes() ?>>
<span id="el_gajisma_tingkat">
<span<?= $gajisma->tingkat->viewAttributes() ?>>
<?= $gajisma->tingkat->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
