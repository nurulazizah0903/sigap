<?php
namespace PHPMaker2020\sigap;
?>
<?php if ($m_sd->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_m_sdmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($m_sd->createby->Visible) { // createby ?>
		<tr id="r_createby">
			<td class="<?php echo $m_sd->TableLeftColumnClass ?>"><?php echo $m_sd->createby->caption() ?></td>
			<td <?php echo $m_sd->createby->cellAttributes() ?>>
<span id="el_m_sd_createby">
<span<?php echo $m_sd->createby->viewAttributes() ?>><?php echo $m_sd->createby->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($m_sd->tahun->Visible) { // tahun ?>
		<tr id="r_tahun">
			<td class="<?php echo $m_sd->TableLeftColumnClass ?>"><?php echo $m_sd->tahun->caption() ?></td>
			<td <?php echo $m_sd->tahun->cellAttributes() ?>>
<span id="el_m_sd_tahun">
<span<?php echo $m_sd->tahun->viewAttributes() ?>><?php echo $m_sd->tahun->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($m_sd->bulan->Visible) { // bulan ?>
		<tr id="r_bulan">
			<td class="<?php echo $m_sd->TableLeftColumnClass ?>"><?php echo $m_sd->bulan->caption() ?></td>
			<td <?php echo $m_sd->bulan->cellAttributes() ?>>
<span id="el_m_sd_bulan">
<span<?php echo $m_sd->bulan->viewAttributes() ?>><?php echo $m_sd->bulan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>