<?php
namespace PHPMaker2020\sigap;
?>
<?php if ($gajismk->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_gajismkmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($gajismk->tahun->Visible) { // tahun ?>
		<tr id="r_tahun">
			<td class="<?php echo $gajismk->TableLeftColumnClass ?>"><?php echo $gajismk->tahun->caption() ?></td>
			<td <?php echo $gajismk->tahun->cellAttributes() ?>>
<span id="el_gajismk_tahun">
<span<?php echo $gajismk->tahun->viewAttributes() ?>><?php echo $gajismk->tahun->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajismk->bulan->Visible) { // bulan ?>
		<tr id="r_bulan">
			<td class="<?php echo $gajismk->TableLeftColumnClass ?>"><?php echo $gajismk->bulan->caption() ?></td>
			<td <?php echo $gajismk->bulan->cellAttributes() ?>>
<span id="el_gajismk_bulan">
<span<?php echo $gajismk->bulan->viewAttributes() ?>><?php echo $gajismk->bulan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajismk->datetime->Visible) { // datetime ?>
		<tr id="r_datetime">
			<td class="<?php echo $gajismk->TableLeftColumnClass ?>"><?php echo $gajismk->datetime->caption() ?></td>
			<td <?php echo $gajismk->datetime->cellAttributes() ?>>
<span id="el_gajismk_datetime">
<span<?php echo $gajismk->datetime->viewAttributes() ?>><?php echo $gajismk->datetime->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajismk->createby->Visible) { // createby ?>
		<tr id="r_createby">
			<td class="<?php echo $gajismk->TableLeftColumnClass ?>"><?php echo $gajismk->createby->caption() ?></td>
			<td <?php echo $gajismk->createby->cellAttributes() ?>>
<span id="el_gajismk_createby">
<span<?php echo $gajismk->createby->viewAttributes() ?>><?php echo $gajismk->createby->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>