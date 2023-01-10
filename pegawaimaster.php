<?php
namespace PHPMaker2020\sigap;
?>
<?php if ($pegawai->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_pegawaimaster" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($pegawai->nip->Visible) { // nip ?>
		<tr id="r_nip">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->nip->caption() ?></td>
			<td <?php echo $pegawai->nip->cellAttributes() ?>>
<span id="el_pegawai_nip">
<span<?php echo $pegawai->nip->viewAttributes() ?>><?php echo $pegawai->nip->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->username->Visible) { // username ?>
		<tr id="r_username">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->username->caption() ?></td>
			<td <?php echo $pegawai->username->cellAttributes() ?>>
<span id="el_pegawai_username">
<span<?php echo $pegawai->username->viewAttributes() ?>><?php echo $pegawai->username->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->password->Visible) { // password ?>
		<tr id="r_password">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->password->caption() ?></td>
			<td <?php echo $pegawai->password->cellAttributes() ?>>
<span id="el_pegawai_password">
<span<?php echo $pegawai->password->viewAttributes() ?>><?php echo $pegawai->password->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->jenjang_id->Visible) { // jenjang_id ?>
		<tr id="r_jenjang_id">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->jenjang_id->caption() ?></td>
			<td <?php echo $pegawai->jenjang_id->cellAttributes() ?>>
<span id="el_pegawai_jenjang_id">
<span<?php echo $pegawai->jenjang_id->viewAttributes() ?>><?php echo $pegawai->jenjang_id->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->jabatan->Visible) { // jabatan ?>
		<tr id="r_jabatan">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->jabatan->caption() ?></td>
			<td <?php echo $pegawai->jabatan->cellAttributes() ?>>
<span id="el_pegawai_jabatan">
<span<?php echo $pegawai->jabatan->viewAttributes() ?>><?php echo $pegawai->jabatan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->periode_jabatan->Visible) { // periode_jabatan ?>
		<tr id="r_periode_jabatan">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->periode_jabatan->caption() ?></td>
			<td <?php echo $pegawai->periode_jabatan->cellAttributes() ?>>
<span id="el_pegawai_periode_jabatan">
<span<?php echo $pegawai->periode_jabatan->viewAttributes() ?>><?php echo $pegawai->periode_jabatan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->type->Visible) { // type ?>
		<tr id="r_type">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->type->caption() ?></td>
			<td <?php echo $pegawai->type->cellAttributes() ?>>
<span id="el_pegawai_type">
<span<?php echo $pegawai->type->viewAttributes() ?>><?php echo $pegawai->type->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->sertif->Visible) { // sertif ?>
		<tr id="r_sertif">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->sertif->caption() ?></td>
			<td <?php echo $pegawai->sertif->cellAttributes() ?>>
<span id="el_pegawai_sertif">
<span<?php echo $pegawai->sertif->viewAttributes() ?>><?php echo $pegawai->sertif->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->tambahan->Visible) { // tambahan ?>
		<tr id="r_tambahan">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->tambahan->caption() ?></td>
			<td <?php echo $pegawai->tambahan->cellAttributes() ?>>
<span id="el_pegawai_tambahan">
<span<?php echo $pegawai->tambahan->viewAttributes() ?>><?php echo $pegawai->tambahan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->lama_kerja->Visible) { // lama_kerja ?>
		<tr id="r_lama_kerja">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->lama_kerja->caption() ?></td>
			<td <?php echo $pegawai->lama_kerja->cellAttributes() ?>>
<span id="el_pegawai_lama_kerja">
<span<?php echo $pegawai->lama_kerja->viewAttributes() ?>><?php echo $pegawai->lama_kerja->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->nama->Visible) { // nama ?>
		<tr id="r_nama">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->nama->caption() ?></td>
			<td <?php echo $pegawai->nama->cellAttributes() ?>>
<span id="el_pegawai_nama">
<span<?php echo $pegawai->nama->viewAttributes() ?>><?php echo $pegawai->nama->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->alamat->Visible) { // alamat ?>
		<tr id="r_alamat">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->alamat->caption() ?></td>
			<td <?php echo $pegawai->alamat->cellAttributes() ?>>
<span id="el_pegawai_alamat">
<span<?php echo $pegawai->alamat->viewAttributes() ?>><?php echo $pegawai->alamat->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->_email->Visible) { // email ?>
		<tr id="r__email">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->_email->caption() ?></td>
			<td <?php echo $pegawai->_email->cellAttributes() ?>>
<span id="el_pegawai__email">
<span<?php echo $pegawai->_email->viewAttributes() ?>><?php echo $pegawai->_email->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->wa->Visible) { // wa ?>
		<tr id="r_wa">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->wa->caption() ?></td>
			<td <?php echo $pegawai->wa->cellAttributes() ?>>
<span id="el_pegawai_wa">
<span<?php echo $pegawai->wa->viewAttributes() ?>><?php echo $pegawai->wa->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->hp->Visible) { // hp ?>
		<tr id="r_hp">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->hp->caption() ?></td>
			<td <?php echo $pegawai->hp->cellAttributes() ?>>
<span id="el_pegawai_hp">
<span<?php echo $pegawai->hp->viewAttributes() ?>><?php echo $pegawai->hp->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->tgllahir->Visible) { // tgllahir ?>
		<tr id="r_tgllahir">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->tgllahir->caption() ?></td>
			<td <?php echo $pegawai->tgllahir->cellAttributes() ?>>
<span id="el_pegawai_tgllahir">
<span<?php echo $pegawai->tgllahir->viewAttributes() ?>><?php echo $pegawai->tgllahir->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->rekbank->Visible) { // rekbank ?>
		<tr id="r_rekbank">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->rekbank->caption() ?></td>
			<td <?php echo $pegawai->rekbank->cellAttributes() ?>>
<span id="el_pegawai_rekbank">
<span<?php echo $pegawai->rekbank->viewAttributes() ?>><?php echo $pegawai->rekbank->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->pendidikan->Visible) { // pendidikan ?>
		<tr id="r_pendidikan">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->pendidikan->caption() ?></td>
			<td <?php echo $pegawai->pendidikan->cellAttributes() ?>>
<span id="el_pegawai_pendidikan">
<span<?php echo $pegawai->pendidikan->viewAttributes() ?>><?php echo $pegawai->pendidikan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->jurusan->Visible) { // jurusan ?>
		<tr id="r_jurusan">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->jurusan->caption() ?></td>
			<td <?php echo $pegawai->jurusan->cellAttributes() ?>>
<span id="el_pegawai_jurusan">
<span<?php echo $pegawai->jurusan->viewAttributes() ?>><?php echo $pegawai->jurusan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->agama->Visible) { // agama ?>
		<tr id="r_agama">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->agama->caption() ?></td>
			<td <?php echo $pegawai->agama->cellAttributes() ?>>
<span id="el_pegawai_agama">
<span<?php echo $pegawai->agama->viewAttributes() ?>><?php echo $pegawai->agama->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->jenkel->Visible) { // jenkel ?>
		<tr id="r_jenkel">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->jenkel->caption() ?></td>
			<td <?php echo $pegawai->jenkel->cellAttributes() ?>>
<span id="el_pegawai_jenkel">
<span<?php echo $pegawai->jenkel->viewAttributes() ?>><?php echo $pegawai->jenkel->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->status->Visible) { // status ?>
		<tr id="r_status">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->status->caption() ?></td>
			<td <?php echo $pegawai->status->cellAttributes() ?>>
<span id="el_pegawai_status">
<span<?php echo $pegawai->status->viewAttributes() ?>><?php echo $pegawai->status->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->foto->Visible) { // foto ?>
		<tr id="r_foto">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->foto->caption() ?></td>
			<td <?php echo $pegawai->foto->cellAttributes() ?>>
<span id="el_pegawai_foto">
<span<?php echo $pegawai->foto->viewAttributes() ?>><?php echo GetFileViewTag($pegawai->foto, $pegawai->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->file_cv->Visible) { // file_cv ?>
		<tr id="r_file_cv">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->file_cv->caption() ?></td>
			<td <?php echo $pegawai->file_cv->cellAttributes() ?>>
<span id="el_pegawai_file_cv">
<span<?php echo $pegawai->file_cv->viewAttributes() ?>><?php echo GetFileViewTag($pegawai->file_cv, $pegawai->file_cv->getViewValue(), FALSE) ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->mulai_bekerja->Visible) { // mulai_bekerja ?>
		<tr id="r_mulai_bekerja">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->mulai_bekerja->caption() ?></td>
			<td <?php echo $pegawai->mulai_bekerja->cellAttributes() ?>>
<span id="el_pegawai_mulai_bekerja">
<span<?php echo $pegawai->mulai_bekerja->viewAttributes() ?>><?php echo $pegawai->mulai_bekerja->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->keterangan->Visible) { // keterangan ?>
		<tr id="r_keterangan">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->keterangan->caption() ?></td>
			<td <?php echo $pegawai->keterangan->cellAttributes() ?>>
<span id="el_pegawai_keterangan">
<span<?php echo $pegawai->keterangan->viewAttributes() ?>><?php echo $pegawai->keterangan->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->level->Visible) { // level ?>
		<tr id="r_level">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->level->caption() ?></td>
			<td <?php echo $pegawai->level->cellAttributes() ?>>
<span id="el_pegawai_level">
<span<?php echo $pegawai->level->viewAttributes() ?>><?php echo $pegawai->level->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->aktif->Visible) { // aktif ?>
		<tr id="r_aktif">
			<td class="<?php echo $pegawai->TableLeftColumnClass ?>"><?php echo $pegawai->aktif->caption() ?></td>
			<td <?php echo $pegawai->aktif->cellAttributes() ?>>
<span id="el_pegawai_aktif">
<span<?php echo $pegawai->aktif->viewAttributes() ?>><?php echo $pegawai->aktif->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>