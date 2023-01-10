<?php
namespace PHPMaker2020\sigap;
?>
<?php if ($berita->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_beritamaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($berita->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="<?php echo $berita->TableLeftColumnClass ?>"><?php echo $berita->id->caption() ?></td>
			<td <?php echo $berita->id->cellAttributes() ?>>
<span id="el_berita_id">
<span<?php echo $berita->id->viewAttributes() ?>><?php echo $berita->id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($berita->grup->Visible) { // grup ?>
		<tr id="r_grup">
			<td class="<?php echo $berita->TableLeftColumnClass ?>"><?php echo $berita->grup->caption() ?></td>
			<td <?php echo $berita->grup->cellAttributes() ?>>
<span id="el_berita_grup">
<span<?php echo $berita->grup->viewAttributes() ?>><?php echo $berita->grup->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($berita->judul->Visible) { // judul ?>
		<tr id="r_judul">
			<td class="<?php echo $berita->TableLeftColumnClass ?>"><?php echo $berita->judul->caption() ?></td>
			<td <?php echo $berita->judul->cellAttributes() ?>>
<span id="el_berita_judul">
<span<?php echo $berita->judul->viewAttributes() ?>><?php echo $berita->judul->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($berita->gambar->Visible) { // gambar ?>
		<tr id="r_gambar">
			<td class="<?php echo $berita->TableLeftColumnClass ?>"><?php echo $berita->gambar->caption() ?></td>
			<td <?php echo $berita->gambar->cellAttributes() ?>>
<span id="el_berita_gambar">
<span<?php echo $berita->gambar->viewAttributes() ?>><?php echo $berita->gambar->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($berita->video->Visible) { // video ?>
		<tr id="r_video">
			<td class="<?php echo $berita->TableLeftColumnClass ?>"><?php echo $berita->video->caption() ?></td>
			<td <?php echo $berita->video->cellAttributes() ?>>
<span id="el_berita_video">
<span<?php echo $berita->video->viewAttributes() ?>><?php echo $berita->video->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($berita->c_by->Visible) { // c_by ?>
		<tr id="r_c_by">
			<td class="<?php echo $berita->TableLeftColumnClass ?>"><?php echo $berita->c_by->caption() ?></td>
			<td <?php echo $berita->c_by->cellAttributes() ?>>
<span id="el_berita_c_by">
<span<?php echo $berita->c_by->viewAttributes() ?>><?php echo $berita->c_by->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($berita->c_date->Visible) { // c_date ?>
		<tr id="r_c_date">
			<td class="<?php echo $berita->TableLeftColumnClass ?>"><?php echo $berita->c_date->caption() ?></td>
			<td <?php echo $berita->c_date->cellAttributes() ?>>
<span id="el_berita_c_date">
<span<?php echo $berita->c_date->viewAttributes() ?>><?php echo $berita->c_date->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($berita->aktif->Visible) { // aktif ?>
		<tr id="r_aktif">
			<td class="<?php echo $berita->TableLeftColumnClass ?>"><?php echo $berita->aktif->caption() ?></td>
			<td <?php echo $berita->aktif->cellAttributes() ?>>
<span id="el_berita_aktif">
<span<?php echo $berita->aktif->viewAttributes() ?>><?php echo $berita->aktif->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>