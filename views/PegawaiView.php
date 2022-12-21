<?php

namespace PHPMaker2022\sigap;

// Page object
$PegawaiView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pegawai: currentTable } });
var currentForm, currentPageID;
var fpegawaiview;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpegawaiview = new ew.Form("fpegawaiview", "view");
    currentPageID = ew.PAGE_ID = "view";
    currentForm = fpegawaiview;
    loadjs.done("fpegawaiview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpegawaiview" id="fpegawaiview" class="ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pegawai">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-bordered table-hover table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id"<?= $Page->id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id"<?= $Page->id->cellAttributes() ?>>
<span id="el_pegawai_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pid->Visible) { // pid ?>
    <tr id="r_pid"<?= $Page->pid->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_pid"><?= $Page->pid->caption() ?></span></td>
        <td data-name="pid"<?= $Page->pid->cellAttributes() ?>>
<span id="el_pegawai_pid">
<span<?= $Page->pid->viewAttributes() ?>>
<?= $Page->pid->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_username->Visible) { // username ?>
    <tr id="r__username"<?= $Page->_username->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai__username"><?= $Page->_username->caption() ?></span></td>
        <td data-name="_username"<?= $Page->_username->cellAttributes() ?>>
<span id="el_pegawai__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
    <tr id="r__password"<?= $Page->_password->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai__password"><?= $Page->_password->caption() ?></span></td>
        <td data-name="_password"<?= $Page->_password->cellAttributes() ?>>
<span id="el_pegawai__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
    <tr id="r_nip"<?= $Page->nip->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_nip"><?= $Page->nip->caption() ?></span></td>
        <td data-name="nip"<?= $Page->nip->cellAttributes() ?>>
<span id="el_pegawai_nip">
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
    <tr id="r_nama"<?= $Page->nama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_nama"><?= $Page->nama->caption() ?></span></td>
        <td data-name="nama"<?= $Page->nama->cellAttributes() ?>>
<span id="el_pegawai_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
    <tr id="r_alamat"<?= $Page->alamat->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_alamat"><?= $Page->alamat->caption() ?></span></td>
        <td data-name="alamat"<?= $Page->alamat->cellAttributes() ?>>
<span id="el_pegawai_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
    <tr id="r__email"<?= $Page->_email->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai__email"><?= $Page->_email->caption() ?></span></td>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el_pegawai__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->wa->Visible) { // wa ?>
    <tr id="r_wa"<?= $Page->wa->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_wa"><?= $Page->wa->caption() ?></span></td>
        <td data-name="wa"<?= $Page->wa->cellAttributes() ?>>
<span id="el_pegawai_wa">
<span<?= $Page->wa->viewAttributes() ?>>
<?= $Page->wa->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->hp->Visible) { // hp ?>
    <tr id="r_hp"<?= $Page->hp->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_hp"><?= $Page->hp->caption() ?></span></td>
        <td data-name="hp"<?= $Page->hp->cellAttributes() ?>>
<span id="el_pegawai_hp">
<span<?= $Page->hp->viewAttributes() ?>>
<?= $Page->hp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tgllahir->Visible) { // tgllahir ?>
    <tr id="r_tgllahir"<?= $Page->tgllahir->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_tgllahir"><?= $Page->tgllahir->caption() ?></span></td>
        <td data-name="tgllahir"<?= $Page->tgllahir->cellAttributes() ?>>
<span id="el_pegawai_tgllahir">
<span<?= $Page->tgllahir->viewAttributes() ?>>
<?= $Page->tgllahir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->rekbank->Visible) { // rekbank ?>
    <tr id="r_rekbank"<?= $Page->rekbank->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_rekbank"><?= $Page->rekbank->caption() ?></span></td>
        <td data-name="rekbank"<?= $Page->rekbank->cellAttributes() ?>>
<span id="el_pegawai_rekbank">
<span<?= $Page->rekbank->viewAttributes() ?>>
<?= $Page->rekbank->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
    <tr id="r_jenjang_id"<?= $Page->jenjang_id->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_jenjang_id"><?= $Page->jenjang_id->caption() ?></span></td>
        <td data-name="jenjang_id"<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el_pegawai_jenjang_id">
<span<?= $Page->jenjang_id->viewAttributes() ?>>
<?= $Page->jenjang_id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
    <tr id="r_pendidikan"<?= $Page->pendidikan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_pendidikan"><?= $Page->pendidikan->caption() ?></span></td>
        <td data-name="pendidikan"<?= $Page->pendidikan->cellAttributes() ?>>
<span id="el_pegawai_pendidikan">
<span<?= $Page->pendidikan->viewAttributes() ?>>
<?= $Page->pendidikan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jurusan->Visible) { // jurusan ?>
    <tr id="r_jurusan"<?= $Page->jurusan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_jurusan"><?= $Page->jurusan->caption() ?></span></td>
        <td data-name="jurusan"<?= $Page->jurusan->cellAttributes() ?>>
<span id="el_pegawai_jurusan">
<span<?= $Page->jurusan->viewAttributes() ?>>
<?= $Page->jurusan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
    <tr id="r_agama"<?= $Page->agama->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_agama"><?= $Page->agama->caption() ?></span></td>
        <td data-name="agama"<?= $Page->agama->cellAttributes() ?>>
<span id="el_pegawai_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
    <tr id="r_jabatan"<?= $Page->jabatan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_jabatan"><?= $Page->jabatan->caption() ?></span></td>
        <td data-name="jabatan"<?= $Page->jabatan->cellAttributes() ?>>
<span id="el_pegawai_jabatan">
<span<?= $Page->jabatan->viewAttributes() ?>>
<?= $Page->jabatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenkel->Visible) { // jenkel ?>
    <tr id="r_jenkel"<?= $Page->jenkel->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_jenkel"><?= $Page->jenkel->caption() ?></span></td>
        <td data-name="jenkel"<?= $Page->jenkel->cellAttributes() ?>>
<span id="el_pegawai_jenkel">
<span<?= $Page->jenkel->viewAttributes() ?>>
<?= $Page->jenkel->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->mulai_bekerja->Visible) { // mulai_bekerja ?>
    <tr id="r_mulai_bekerja"<?= $Page->mulai_bekerja->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_mulai_bekerja"><?= $Page->mulai_bekerja->caption() ?></span></td>
        <td data-name="mulai_bekerja"<?= $Page->mulai_bekerja->cellAttributes() ?>>
<span id="el_pegawai_mulai_bekerja">
<span<?= $Page->mulai_bekerja->viewAttributes() ?>>
<?= $Page->mulai_bekerja->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status"<?= $Page->status->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el_pegawai_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
    <tr id="r_keterangan"<?= $Page->keterangan->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_keterangan"><?= $Page->keterangan->caption() ?></span></td>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el_pegawai_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->level->Visible) { // level ?>
    <tr id="r_level"<?= $Page->level->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_level"><?= $Page->level->caption() ?></span></td>
        <td data-name="level"<?= $Page->level->cellAttributes() ?>>
<span id="el_pegawai_level">
<span<?= $Page->level->viewAttributes() ?>>
<?= $Page->level->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
    <tr id="r_aktif"<?= $Page->aktif->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_aktif"><?= $Page->aktif->caption() ?></span></td>
        <td data-name="aktif"<?= $Page->aktif->cellAttributes() ?>>
<span id="el_pegawai_aktif">
<span<?= $Page->aktif->viewAttributes() ?>>
<?= $Page->aktif->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->foto->Visible) { // foto ?>
    <tr id="r_foto"<?= $Page->foto->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_foto"><?= $Page->foto->caption() ?></span></td>
        <td data-name="foto"<?= $Page->foto->cellAttributes() ?>>
<span id="el_pegawai_foto">
<span<?= $Page->foto->viewAttributes() ?>>
<?= GetFileViewTag($Page->foto, $Page->foto->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->file_cv->Visible) { // file_cv ?>
    <tr id="r_file_cv"<?= $Page->file_cv->rowAttributes() ?>>
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_pegawai_file_cv"><?= $Page->file_cv->caption() ?></span></td>
        <td data-name="file_cv"<?= $Page->file_cv->cellAttributes() ?>>
<span id="el_pegawai_file_cv">
<span<?= $Page->file_cv->viewAttributes() ?>>
<?= GetFileViewTag($Page->file_cv, $Page->file_cv->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php
    if (in_array("peg_dokumen", explode(",", $Page->getCurrentDetailTable())) && $peg_dokumen->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("peg_dokumen", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PegDokumenGrid.php" ?>
<?php } ?>
<?php
    if (in_array("peg_keluarga", explode(",", $Page->getCurrentDetailTable())) && $peg_keluarga->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("peg_keluarga", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PegKeluargaGrid.php" ?>
<?php } ?>
<?php
    if (in_array("peg_skill", explode(",", $Page->getCurrentDetailTable())) && $peg_skill->DetailView) {
?>
<?php if ($Page->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?= $Language->tablePhrase("peg_skill", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "PegSkillGrid.php" ?>
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
