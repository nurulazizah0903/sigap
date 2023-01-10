<?php
namespace PHPMaker2020\sigap;
?>
<?php if ($gajisd->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_gajisdmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($gajisd->tahun->Visible) { // tahun ?>
		<tr id="r_tahun">
			<td class="<?php echo $gajisd->TableLeftColumnClass ?>"><?php echo $gajisd->tahun->caption() ?></td>
			<td <?php echo $gajisd->tahun->cellAttributes() ?>>
<span id="el_gajisd_tahun">
<span<?php echo $gajisd->tahun->viewAttributes() ?>><?php echo $gajisd->tahun->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajisd->bulan->Visible) { // bulan ?>
		<tr id="r_bulan">
			<td class="<?php echo $gajisd->TableLeftColumnClass ?>"><?php echo $gajisd->bulan->caption() ?></td>
			<td <?php echo $gajisd->bulan->cellAttributes() ?>>
<span id="el_gajisd_bulan">
<span<?php echo $gajisd->bulan->viewAttributes() ?>><?php echo $gajisd->bulan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajisd->datetime->Visible) { // datetime ?>
		<tr id="r_datetime">
			<td class="<?php echo $gajisd->TableLeftColumnClass ?>"><?php echo $gajisd->datetime->caption() ?></td>
			<td <?php echo $gajisd->datetime->cellAttributes() ?>>
<span id="el_gajisd_datetime">
<span<?php echo $gajisd->datetime->viewAttributes() ?>><?php echo $gajisd->datetime->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($gajisd->createby->Visible) { // createby ?>
		<tr id="r_createby">
			<td class="<?php echo $gajisd->TableLeftColumnClass ?>"><?php echo $gajisd->createby->caption() ?></td>
			<td <?php echo $gajisd->createby->cellAttributes() ?>>
<span id="el_gajisd_createby">
<span<?php echo $gajisd->createby->viewAttributes() ?>><?php echo $gajisd->createby->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>