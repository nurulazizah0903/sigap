<?php
namespace PHPMaker2020\sigap;
?>
<?php if ($jabatan->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_jabatanmaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($jabatan->nama_jabatan->Visible) { // nama_jabatan ?>
		<tr id="r_nama_jabatan">
			<td class="<?php echo $jabatan->TableLeftColumnClass ?>"><?php echo $jabatan->nama_jabatan->caption() ?></td>
			<td <?php echo $jabatan->nama_jabatan->cellAttributes() ?>>
<span id="el_jabatan_nama_jabatan">
<span<?php echo $jabatan->nama_jabatan->viewAttributes() ?>><?php echo $jabatan->nama_jabatan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jabatan->type_jabatan->Visible) { // type_jabatan ?>
		<tr id="r_type_jabatan">
			<td class="<?php echo $jabatan->TableLeftColumnClass ?>"><?php echo $jabatan->type_jabatan->caption() ?></td>
			<td <?php echo $jabatan->type_jabatan->cellAttributes() ?>>
<span id="el_jabatan_type_jabatan">
<span<?php echo $jabatan->type_jabatan->viewAttributes() ?>><?php echo $jabatan->type_jabatan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jabatan->jenjang->Visible) { // jenjang ?>
		<tr id="r_jenjang">
			<td class="<?php echo $jabatan->TableLeftColumnClass ?>"><?php echo $jabatan->jenjang->caption() ?></td>
			<td <?php echo $jabatan->jenjang->cellAttributes() ?>>
<span id="el_jabatan_jenjang">
<span<?php echo $jabatan->jenjang->viewAttributes() ?>><?php echo $jabatan->jenjang->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jabatan->type_guru->Visible) { // type_guru ?>
		<tr id="r_type_guru">
			<td class="<?php echo $jabatan->TableLeftColumnClass ?>"><?php echo $jabatan->type_guru->caption() ?></td>
			<td <?php echo $jabatan->type_guru->cellAttributes() ?>>
<span id="el_jabatan_type_guru">
<span<?php echo $jabatan->type_guru->viewAttributes() ?>><?php echo $jabatan->type_guru->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jabatan->keterangan->Visible) { // keterangan ?>
		<tr id="r_keterangan">
			<td class="<?php echo $jabatan->TableLeftColumnClass ?>"><?php echo $jabatan->keterangan->caption() ?></td>
			<td <?php echo $jabatan->keterangan->cellAttributes() ?>>
<span id="el_jabatan_keterangan">
<span<?php echo $jabatan->keterangan->viewAttributes() ?>><?php echo $jabatan->keterangan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jabatan->c_by->Visible) { // c_by ?>
		<tr id="r_c_by">
			<td class="<?php echo $jabatan->TableLeftColumnClass ?>"><?php echo $jabatan->c_by->caption() ?></td>
			<td <?php echo $jabatan->c_by->cellAttributes() ?>>
<span id="el_jabatan_c_by">
<span<?php echo $jabatan->c_by->viewAttributes() ?>><?php echo $jabatan->c_by->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jabatan->c_date->Visible) { // c_date ?>
		<tr id="r_c_date">
			<td class="<?php echo $jabatan->TableLeftColumnClass ?>"><?php echo $jabatan->c_date->caption() ?></td>
			<td <?php echo $jabatan->c_date->cellAttributes() ?>>
<span id="el_jabatan_c_date">
<span<?php echo $jabatan->c_date->viewAttributes() ?>><?php echo $jabatan->c_date->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jabatan->u_by->Visible) { // u_by ?>
		<tr id="r_u_by">
			<td class="<?php echo $jabatan->TableLeftColumnClass ?>"><?php echo $jabatan->u_by->caption() ?></td>
			<td <?php echo $jabatan->u_by->cellAttributes() ?>>
<span id="el_jabatan_u_by">
<span<?php echo $jabatan->u_by->viewAttributes() ?>><?php echo $jabatan->u_by->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jabatan->u_date->Visible) { // u_date ?>
		<tr id="r_u_date">
			<td class="<?php echo $jabatan->TableLeftColumnClass ?>"><?php echo $jabatan->u_date->caption() ?></td>
			<td <?php echo $jabatan->u_date->cellAttributes() ?>>
<span id="el_jabatan_u_date">
<span<?php echo $jabatan->u_date->viewAttributes() ?>><?php echo $jabatan->u_date->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jabatan->aktif->Visible) { // aktif ?>
		<tr id="r_aktif">
			<td class="<?php echo $jabatan->TableLeftColumnClass ?>"><?php echo $jabatan->aktif->caption() ?></td>
			<td <?php echo $jabatan->aktif->cellAttributes() ?>>
<span id="el_jabatan_aktif">
<span<?php echo $jabatan->aktif->viewAttributes() ?>><?php echo $jabatan->aktif->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>