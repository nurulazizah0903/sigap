<?php

namespace PHPMaker2022\sigap;

// Table
$pegawai = Container("pegawai");
?>
<?php if ($pegawai->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_pegawaimaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($pegawai->_username->Visible) { // username ?>
        <tr id="r__username"<?= $pegawai->_username->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->_username->caption() ?></td>
            <td<?= $pegawai->_username->cellAttributes() ?>>
<span id="el_pegawai__username">
<span<?= $pegawai->_username->viewAttributes() ?>>
<?= $pegawai->_username->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->_password->Visible) { // password ?>
        <tr id="r__password"<?= $pegawai->_password->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->_password->caption() ?></td>
            <td<?= $pegawai->_password->cellAttributes() ?>>
<span id="el_pegawai__password">
<span<?= $pegawai->_password->viewAttributes() ?>>
<?= $pegawai->_password->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->nip->Visible) { // nip ?>
        <tr id="r_nip"<?= $pegawai->nip->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->nip->caption() ?></td>
            <td<?= $pegawai->nip->cellAttributes() ?>>
<span id="el_pegawai_nip">
<span<?= $pegawai->nip->viewAttributes() ?>>
<?= $pegawai->nip->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->nama->Visible) { // nama ?>
        <tr id="r_nama"<?= $pegawai->nama->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->nama->caption() ?></td>
            <td<?= $pegawai->nama->cellAttributes() ?>>
<span id="el_pegawai_nama">
<span<?= $pegawai->nama->viewAttributes() ?>>
<?= $pegawai->nama->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->alamat->Visible) { // alamat ?>
        <tr id="r_alamat"<?= $pegawai->alamat->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->alamat->caption() ?></td>
            <td<?= $pegawai->alamat->cellAttributes() ?>>
<span id="el_pegawai_alamat">
<span<?= $pegawai->alamat->viewAttributes() ?>>
<?= $pegawai->alamat->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->_email->Visible) { // email ?>
        <tr id="r__email"<?= $pegawai->_email->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->_email->caption() ?></td>
            <td<?= $pegawai->_email->cellAttributes() ?>>
<span id="el_pegawai__email">
<span<?= $pegawai->_email->viewAttributes() ?>>
<?= $pegawai->_email->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->wa->Visible) { // wa ?>
        <tr id="r_wa"<?= $pegawai->wa->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->wa->caption() ?></td>
            <td<?= $pegawai->wa->cellAttributes() ?>>
<span id="el_pegawai_wa">
<span<?= $pegawai->wa->viewAttributes() ?>>
<?= $pegawai->wa->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->hp->Visible) { // hp ?>
        <tr id="r_hp"<?= $pegawai->hp->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->hp->caption() ?></td>
            <td<?= $pegawai->hp->cellAttributes() ?>>
<span id="el_pegawai_hp">
<span<?= $pegawai->hp->viewAttributes() ?>>
<?= $pegawai->hp->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->tgllahir->Visible) { // tgllahir ?>
        <tr id="r_tgllahir"<?= $pegawai->tgllahir->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->tgllahir->caption() ?></td>
            <td<?= $pegawai->tgllahir->cellAttributes() ?>>
<span id="el_pegawai_tgllahir">
<span<?= $pegawai->tgllahir->viewAttributes() ?>>
<?= $pegawai->tgllahir->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->rekbank->Visible) { // rekbank ?>
        <tr id="r_rekbank"<?= $pegawai->rekbank->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->rekbank->caption() ?></td>
            <td<?= $pegawai->rekbank->cellAttributes() ?>>
<span id="el_pegawai_rekbank">
<span<?= $pegawai->rekbank->viewAttributes() ?>>
<?= $pegawai->rekbank->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->jenjang_id->Visible) { // jenjang_id ?>
        <tr id="r_jenjang_id"<?= $pegawai->jenjang_id->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->jenjang_id->caption() ?></td>
            <td<?= $pegawai->jenjang_id->cellAttributes() ?>>
<span id="el_pegawai_jenjang_id">
<span<?= $pegawai->jenjang_id->viewAttributes() ?>>
<?= $pegawai->jenjang_id->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->pendidikan->Visible) { // pendidikan ?>
        <tr id="r_pendidikan"<?= $pegawai->pendidikan->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->pendidikan->caption() ?></td>
            <td<?= $pegawai->pendidikan->cellAttributes() ?>>
<span id="el_pegawai_pendidikan">
<span<?= $pegawai->pendidikan->viewAttributes() ?>>
<?= $pegawai->pendidikan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->jurusan->Visible) { // jurusan ?>
        <tr id="r_jurusan"<?= $pegawai->jurusan->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->jurusan->caption() ?></td>
            <td<?= $pegawai->jurusan->cellAttributes() ?>>
<span id="el_pegawai_jurusan">
<span<?= $pegawai->jurusan->viewAttributes() ?>>
<?= $pegawai->jurusan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->agama->Visible) { // agama ?>
        <tr id="r_agama"<?= $pegawai->agama->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->agama->caption() ?></td>
            <td<?= $pegawai->agama->cellAttributes() ?>>
<span id="el_pegawai_agama">
<span<?= $pegawai->agama->viewAttributes() ?>>
<?= $pegawai->agama->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->jabatan->Visible) { // jabatan ?>
        <tr id="r_jabatan"<?= $pegawai->jabatan->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->jabatan->caption() ?></td>
            <td<?= $pegawai->jabatan->cellAttributes() ?>>
<span id="el_pegawai_jabatan">
<span<?= $pegawai->jabatan->viewAttributes() ?>>
<?= $pegawai->jabatan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->jenkel->Visible) { // jenkel ?>
        <tr id="r_jenkel"<?= $pegawai->jenkel->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->jenkel->caption() ?></td>
            <td<?= $pegawai->jenkel->cellAttributes() ?>>
<span id="el_pegawai_jenkel">
<span<?= $pegawai->jenkel->viewAttributes() ?>>
<?= $pegawai->jenkel->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->mulai_bekerja->Visible) { // mulai_bekerja ?>
        <tr id="r_mulai_bekerja"<?= $pegawai->mulai_bekerja->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->mulai_bekerja->caption() ?></td>
            <td<?= $pegawai->mulai_bekerja->cellAttributes() ?>>
<span id="el_pegawai_mulai_bekerja">
<span<?= $pegawai->mulai_bekerja->viewAttributes() ?>>
<?= $pegawai->mulai_bekerja->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->status->Visible) { // status ?>
        <tr id="r_status"<?= $pegawai->status->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->status->caption() ?></td>
            <td<?= $pegawai->status->cellAttributes() ?>>
<span id="el_pegawai_status">
<span<?= $pegawai->status->viewAttributes() ?>>
<?= $pegawai->status->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->keterangan->Visible) { // keterangan ?>
        <tr id="r_keterangan"<?= $pegawai->keterangan->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->keterangan->caption() ?></td>
            <td<?= $pegawai->keterangan->cellAttributes() ?>>
<span id="el_pegawai_keterangan">
<span<?= $pegawai->keterangan->viewAttributes() ?>>
<?= $pegawai->keterangan->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->level->Visible) { // level ?>
        <tr id="r_level"<?= $pegawai->level->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->level->caption() ?></td>
            <td<?= $pegawai->level->cellAttributes() ?>>
<span id="el_pegawai_level">
<span<?= $pegawai->level->viewAttributes() ?>>
<?= $pegawai->level->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->aktif->Visible) { // aktif ?>
        <tr id="r_aktif"<?= $pegawai->aktif->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->aktif->caption() ?></td>
            <td<?= $pegawai->aktif->cellAttributes() ?>>
<span id="el_pegawai_aktif">
<span<?= $pegawai->aktif->viewAttributes() ?>>
<?= $pegawai->aktif->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->foto->Visible) { // foto ?>
        <tr id="r_foto"<?= $pegawai->foto->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->foto->caption() ?></td>
            <td<?= $pegawai->foto->cellAttributes() ?>>
<span id="el_pegawai_foto">
<span<?= $pegawai->foto->viewAttributes() ?>>
<?= GetFileViewTag($pegawai->foto, $pegawai->foto->getViewValue(), false) ?>
</span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($pegawai->file_cv->Visible) { // file_cv ?>
        <tr id="r_file_cv"<?= $pegawai->file_cv->rowAttributes() ?>>
            <td class="<?= $pegawai->TableLeftColumnClass ?>"><?= $pegawai->file_cv->caption() ?></td>
            <td<?= $pegawai->file_cv->cellAttributes() ?>>
<span id="el_pegawai_file_cv">
<span<?= $pegawai->file_cv->viewAttributes() ?>>
<?= GetFileViewTag($pegawai->file_cv, $pegawai->file_cv->getViewValue(), false) ?>
</span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
