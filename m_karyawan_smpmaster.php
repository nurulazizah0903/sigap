<?php
namespace PHPMaker2020\sigap;
?>
<?php if ($m_karyawan_smp->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_m_karyawan_smpmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($m_karyawan_smp->createby->Visible) { // createby ?>
		<tr id="r_createby">
			<td class="<?php echo $m_karyawan_smp->TableLeftColumnClass ?>"><?php echo $m_karyawan_smp->createby->caption() ?></td>
			<td <?php echo $m_karyawan_smp->createby->cellAttributes() ?>>
<span id="el_m_karyawan_smp_createby">
<span<?php echo $m_karyawan_smp->createby->viewAttributes() ?>><?php echo $m_karyawan_smp->createby->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($m_karyawan_smp->tahun->Visible) { // tahun ?>
		<tr id="r_tahun">
			<td class="<?php echo $m_karyawan_smp->TableLeftColumnClass ?>"><?php echo $m_karyawan_smp->tahun->caption() ?></td>
			<td <?php echo $m_karyawan_smp->tahun->cellAttributes() ?>>
<span id="el_m_karyawan_smp_tahun">
<span<?php echo $m_karyawan_smp->tahun->viewAttributes() ?>><?php echo $m_karyawan_smp->tahun->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($m_karyawan_smp->bulan->Visible) { // bulan ?>
		<tr id="r_bulan">
			<td class="<?php echo $m_karyawan_smp->TableLeftColumnClass ?>"><?php echo $m_karyawan_smp->bulan->caption() ?></td>
			<td <?php echo $m_karyawan_smp->bulan->cellAttributes() ?>>
<span id="el_m_karyawan_smp_bulan">
<span<?php echo $m_karyawan_smp->bulan->viewAttributes() ?>><?php echo $m_karyawan_smp->bulan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>