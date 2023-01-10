<?php
namespace PHPMaker2020\sigap;
?>
<?php if ($absen->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_absenmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($absen->tahun->Visible) { // tahun ?>
		<tr id="r_tahun">
			<td class="<?php echo $absen->TableLeftColumnClass ?>"><?php echo $absen->tahun->caption() ?></td>
			<td <?php echo $absen->tahun->cellAttributes() ?>>
<span id="el_absen_tahun">
<span<?php echo $absen->tahun->viewAttributes() ?>><?php echo $absen->tahun->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($absen->bulan->Visible) { // bulan ?>
		<tr id="r_bulan">
			<td class="<?php echo $absen->TableLeftColumnClass ?>"><?php echo $absen->bulan->caption() ?></td>
			<td <?php echo $absen->bulan->cellAttributes() ?>>
<span id="el_absen_bulan">
<span<?php echo $absen->bulan->viewAttributes() ?>><?php echo $absen->bulan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($absen->jumlah_hari_kerja->Visible) { // jumlah_hari_kerja ?>
		<tr id="r_jumlah_hari_kerja">
			<td class="<?php echo $absen->TableLeftColumnClass ?>"><?php echo $absen->jumlah_hari_kerja->caption() ?></td>
			<td <?php echo $absen->jumlah_hari_kerja->cellAttributes() ?>>
<span id="el_absen_jumlah_hari_kerja">
<span<?php echo $absen->jumlah_hari_kerja->viewAttributes() ?>><?php echo $absen->jumlah_hari_kerja->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($absen->datetime->Visible) { // datetime ?>
		<tr id="r_datetime">
			<td class="<?php echo $absen->TableLeftColumnClass ?>"><?php echo $absen->datetime->caption() ?></td>
			<td <?php echo $absen->datetime->cellAttributes() ?>>
<span id="el_absen_datetime">
<span<?php echo $absen->datetime->viewAttributes() ?>><?php echo $absen->datetime->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($absen->createuser->Visible) { // createuser ?>
		<tr id="r_createuser">
			<td class="<?php echo $absen->TableLeftColumnClass ?>"><?php echo $absen->createuser->caption() ?></td>
			<td <?php echo $absen->createuser->cellAttributes() ?>>
<span id="el_absen_createuser">
<span<?php echo $absen->createuser->viewAttributes() ?>><?php echo $absen->createuser->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>