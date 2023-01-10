<?php
namespace PHPMaker2020\sigap;
?>
<?php if ($gajismp->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_gajismpmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($gajismp->tahun->Visible) { // tahun ?>
		<tr id="r_tahun">
			<td class="<?php echo $gajismp->TableLeftColumnClass ?>"><?php echo $gajismp->tahun->caption() ?></td>
			<td <?php echo $gajismp->tahun->cellAttributes() ?>>
<span id="el_gajismp_tahun">
<span<?php echo $gajismp->tahun->viewAttributes() ?>><?php echo $gajismp->tahun->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajismp->bulan->Visible) { // bulan ?>
		<tr id="r_bulan">
			<td class="<?php echo $gajismp->TableLeftColumnClass ?>"><?php echo $gajismp->bulan->caption() ?></td>
			<td <?php echo $gajismp->bulan->cellAttributes() ?>>
<span id="el_gajismp_bulan">
<span<?php echo $gajismp->bulan->viewAttributes() ?>><?php echo $gajismp->bulan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajismp->datetime->Visible) { // datetime ?>
		<tr id="r_datetime">
			<td class="<?php echo $gajismp->TableLeftColumnClass ?>"><?php echo $gajismp->datetime->caption() ?></td>
			<td <?php echo $gajismp->datetime->cellAttributes() ?>>
<span id="el_gajismp_datetime">
<span<?php echo $gajismp->datetime->viewAttributes() ?>><?php echo $gajismp->datetime->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajismp->createby->Visible) { // createby ?>
		<tr id="r_createby">
			<td class="<?php echo $gajismp->TableLeftColumnClass ?>"><?php echo $gajismp->createby->caption() ?></td>
			<td <?php echo $gajismp->createby->cellAttributes() ?>>
<span id="el_gajismp_createby">
<span<?php echo $gajismp->createby->viewAttributes() ?>><?php echo $gajismp->createby->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>