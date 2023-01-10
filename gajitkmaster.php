<?php
namespace PHPMaker2020\sigap;
?>
<?php if ($gajitk->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_gajitkmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($gajitk->tahun->Visible) { // tahun ?>
		<tr id="r_tahun">
			<td class="<?php echo $gajitk->TableLeftColumnClass ?>"><?php echo $gajitk->tahun->caption() ?></td>
			<td <?php echo $gajitk->tahun->cellAttributes() ?>>
<span id="el_gajitk_tahun">
<span<?php echo $gajitk->tahun->viewAttributes() ?>><?php echo $gajitk->tahun->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajitk->bulan->Visible) { // bulan ?>
		<tr id="r_bulan">
			<td class="<?php echo $gajitk->TableLeftColumnClass ?>"><?php echo $gajitk->bulan->caption() ?></td>
			<td <?php echo $gajitk->bulan->cellAttributes() ?>>
<span id="el_gajitk_bulan">
<span<?php echo $gajitk->bulan->viewAttributes() ?>><?php echo $gajitk->bulan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajitk->datetime->Visible) { // datetime ?>
		<tr id="r_datetime">
			<td class="<?php echo $gajitk->TableLeftColumnClass ?>"><?php echo $gajitk->datetime->caption() ?></td>
			<td <?php echo $gajitk->datetime->cellAttributes() ?>>
<span id="el_gajitk_datetime">
<span<?php echo $gajitk->datetime->viewAttributes() ?>><?php echo $gajitk->datetime->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajitk->createby->Visible) { // createby ?>
		<tr id="r_createby">
			<td class="<?php echo $gajitk->TableLeftColumnClass ?>"><?php echo $gajitk->createby->caption() ?></td>
			<td <?php echo $gajitk->createby->cellAttributes() ?>>
<span id="el_gajitk_createby">
<span<?php echo $gajitk->createby->viewAttributes() ?>><?php echo $gajitk->createby->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>