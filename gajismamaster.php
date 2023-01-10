<?php
namespace PHPMaker2020\sigap;
?>
<?php if ($gajisma->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_gajismamaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($gajisma->tahun->Visible) { // tahun ?>
		<tr id="r_tahun">
			<td class="<?php echo $gajisma->TableLeftColumnClass ?>"><?php echo $gajisma->tahun->caption() ?></td>
			<td <?php echo $gajisma->tahun->cellAttributes() ?>>
<span id="el_gajisma_tahun">
<span<?php echo $gajisma->tahun->viewAttributes() ?>><?php echo $gajisma->tahun->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajisma->bulan->Visible) { // bulan ?>
		<tr id="r_bulan">
			<td class="<?php echo $gajisma->TableLeftColumnClass ?>"><?php echo $gajisma->bulan->caption() ?></td>
			<td <?php echo $gajisma->bulan->cellAttributes() ?>>
<span id="el_gajisma_bulan">
<span<?php echo $gajisma->bulan->viewAttributes() ?>><?php echo $gajisma->bulan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajisma->datetime->Visible) { // datetime ?>
		<tr id="r_datetime">
			<td class="<?php echo $gajisma->TableLeftColumnClass ?>"><?php echo $gajisma->datetime->caption() ?></td>
			<td <?php echo $gajisma->datetime->cellAttributes() ?>>
<span id="el_gajisma_datetime">
<span<?php echo $gajisma->datetime->viewAttributes() ?>><?php echo $gajisma->datetime->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajisma->createby->Visible) { // createby ?>
		<tr id="r_createby">
			<td class="<?php echo $gajisma->TableLeftColumnClass ?>"><?php echo $gajisma->createby->caption() ?></td>
			<td <?php echo $gajisma->createby->cellAttributes() ?>>
<span id="el_gajisma_createby">
<span<?php echo $gajisma->createby->viewAttributes() ?>><?php echo $gajisma->createby->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>