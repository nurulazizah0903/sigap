<?php
namespace PHPMaker2020\sigap;
?>
<?php if ($m_sma->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_m_smamaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($m_sma->createby->Visible) { // createby ?>
		<tr id="r_createby">
			<td class="<?php echo $m_sma->TableLeftColumnClass ?>"><?php echo $m_sma->createby->caption() ?></td>
			<td <?php echo $m_sma->createby->cellAttributes() ?>>
<span id="el_m_sma_createby">
<span<?php echo $m_sma->createby->viewAttributes() ?>><?php echo $m_sma->createby->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($m_sma->tahun->Visible) { // tahun ?>
		<tr id="r_tahun">
			<td class="<?php echo $m_sma->TableLeftColumnClass ?>"><?php echo $m_sma->tahun->caption() ?></td>
			<td <?php echo $m_sma->tahun->cellAttributes() ?>>
<span id="el_m_sma_tahun">
<span<?php echo $m_sma->tahun->viewAttributes() ?>><?php echo $m_sma->tahun->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($m_sma->bulan->Visible) { // bulan ?>
		<tr id="r_bulan">
			<td class="<?php echo $m_sma->TableLeftColumnClass ?>"><?php echo $m_sma->bulan->caption() ?></td>
			<td <?php echo $m_sma->bulan->cellAttributes() ?>>
<span id="el_m_sma_bulan">
<span<?php echo $m_sma->bulan->viewAttributes() ?>><?php echo $m_sma->bulan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>