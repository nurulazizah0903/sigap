<?php
namespace PHPMaker2020\sigap;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$pegawai_view = new pegawai_view();

// Run the page
$pegawai_view->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pegawai_view->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pegawai_view->isExport()) { ?>
<script>
var fpegawaiview, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "view";
	fpegawaiview = currentForm = new ew.Form("fpegawaiview", "view");
	loadjs.done("fpegawaiview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$pegawai_view->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $pegawai_view->ExportOptions->render("body") ?>
<?php $pegawai_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $pegawai_view->showPageHeader(); ?>
<?php
$pegawai_view->showMessage();
?>
<form name="fpegawaiview" id="fpegawaiview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pegawai">
<input type="hidden" name="modal" value="<?php echo (int)$pegawai_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($pegawai_view->id->Visible) { // id ?>
	<tr id="r_id">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_id"><?php echo $pegawai_view->id->caption() ?></span></td>
		<td data-name="id" <?php echo $pegawai_view->id->cellAttributes() ?>>
<span id="el_pegawai_id">
<span<?php echo $pegawai_view->id->viewAttributes() ?>><?php echo $pegawai_view->id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->pid->Visible) { // pid ?>
	<tr id="r_pid">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_pid"><?php echo $pegawai_view->pid->caption() ?></span></td>
		<td data-name="pid" <?php echo $pegawai_view->pid->cellAttributes() ?>>
<span id="el_pegawai_pid">
<span<?php echo $pegawai_view->pid->viewAttributes() ?>><?php echo $pegawai_view->pid->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->nip->Visible) { // nip ?>
	<tr id="r_nip">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_nip"><?php echo $pegawai_view->nip->caption() ?></span></td>
		<td data-name="nip" <?php echo $pegawai_view->nip->cellAttributes() ?>>
<span id="el_pegawai_nip">
<span<?php echo $pegawai_view->nip->viewAttributes() ?>><?php echo $pegawai_view->nip->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->username->Visible) { // username ?>
	<tr id="r_username">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_username"><?php echo $pegawai_view->username->caption() ?></span></td>
		<td data-name="username" <?php echo $pegawai_view->username->cellAttributes() ?>>
<span id="el_pegawai_username">
<span<?php echo $pegawai_view->username->viewAttributes() ?>><?php echo $pegawai_view->username->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->password->Visible) { // password ?>
	<tr id="r_password">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_password"><?php echo $pegawai_view->password->caption() ?></span></td>
		<td data-name="password" <?php echo $pegawai_view->password->cellAttributes() ?>>
<span id="el_pegawai_password">
<span<?php echo $pegawai_view->password->viewAttributes() ?>><?php echo $pegawai_view->password->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->jenjang_id->Visible) { // jenjang_id ?>
	<tr id="r_jenjang_id">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_jenjang_id"><?php echo $pegawai_view->jenjang_id->caption() ?></span></td>
		<td data-name="jenjang_id" <?php echo $pegawai_view->jenjang_id->cellAttributes() ?>>
<span id="el_pegawai_jenjang_id">
<span<?php echo $pegawai_view->jenjang_id->viewAttributes() ?>><?php echo $pegawai_view->jenjang_id->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->jabatan->Visible) { // jabatan ?>
	<tr id="r_jabatan">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_jabatan"><?php echo $pegawai_view->jabatan->caption() ?></span></td>
		<td data-name="jabatan" <?php echo $pegawai_view->jabatan->cellAttributes() ?>>
<span id="el_pegawai_jabatan">
<span<?php echo $pegawai_view->jabatan->viewAttributes() ?>><?php echo $pegawai_view->jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->periode_jabatan->Visible) { // periode_jabatan ?>
	<tr id="r_periode_jabatan">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_periode_jabatan"><?php echo $pegawai_view->periode_jabatan->caption() ?></span></td>
		<td data-name="periode_jabatan" <?php echo $pegawai_view->periode_jabatan->cellAttributes() ?>>
<span id="el_pegawai_periode_jabatan">
<span<?php echo $pegawai_view->periode_jabatan->viewAttributes() ?>><?php echo $pegawai_view->periode_jabatan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->type->Visible) { // type ?>
	<tr id="r_type">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_type"><?php echo $pegawai_view->type->caption() ?></span></td>
		<td data-name="type" <?php echo $pegawai_view->type->cellAttributes() ?>>
<span id="el_pegawai_type">
<span<?php echo $pegawai_view->type->viewAttributes() ?>><?php echo $pegawai_view->type->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->sertif->Visible) { // sertif ?>
	<tr id="r_sertif">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_sertif"><?php echo $pegawai_view->sertif->caption() ?></span></td>
		<td data-name="sertif" <?php echo $pegawai_view->sertif->cellAttributes() ?>>
<span id="el_pegawai_sertif">
<span<?php echo $pegawai_view->sertif->viewAttributes() ?>><?php echo $pegawai_view->sertif->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->tambahan->Visible) { // tambahan ?>
	<tr id="r_tambahan">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_tambahan"><?php echo $pegawai_view->tambahan->caption() ?></span></td>
		<td data-name="tambahan" <?php echo $pegawai_view->tambahan->cellAttributes() ?>>
<span id="el_pegawai_tambahan">
<span<?php echo $pegawai_view->tambahan->viewAttributes() ?>><?php echo $pegawai_view->tambahan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->lama_kerja->Visible) { // lama_kerja ?>
	<tr id="r_lama_kerja">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_lama_kerja"><?php echo $pegawai_view->lama_kerja->caption() ?></span></td>
		<td data-name="lama_kerja" <?php echo $pegawai_view->lama_kerja->cellAttributes() ?>>
<span id="el_pegawai_lama_kerja">
<span<?php echo $pegawai_view->lama_kerja->viewAttributes() ?>><?php echo $pegawai_view->lama_kerja->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->nama->Visible) { // nama ?>
	<tr id="r_nama">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_nama"><?php echo $pegawai_view->nama->caption() ?></span></td>
		<td data-name="nama" <?php echo $pegawai_view->nama->cellAttributes() ?>>
<span id="el_pegawai_nama">
<span<?php echo $pegawai_view->nama->viewAttributes() ?>><?php echo $pegawai_view->nama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->alamat->Visible) { // alamat ?>
	<tr id="r_alamat">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_alamat"><?php echo $pegawai_view->alamat->caption() ?></span></td>
		<td data-name="alamat" <?php echo $pegawai_view->alamat->cellAttributes() ?>>
<span id="el_pegawai_alamat">
<span<?php echo $pegawai_view->alamat->viewAttributes() ?>><?php echo $pegawai_view->alamat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai__email"><?php echo $pegawai_view->_email->caption() ?></span></td>
		<td data-name="_email" <?php echo $pegawai_view->_email->cellAttributes() ?>>
<span id="el_pegawai__email">
<span<?php echo $pegawai_view->_email->viewAttributes() ?>><?php echo $pegawai_view->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->wa->Visible) { // wa ?>
	<tr id="r_wa">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_wa"><?php echo $pegawai_view->wa->caption() ?></span></td>
		<td data-name="wa" <?php echo $pegawai_view->wa->cellAttributes() ?>>
<span id="el_pegawai_wa">
<span<?php echo $pegawai_view->wa->viewAttributes() ?>><?php echo $pegawai_view->wa->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->hp->Visible) { // hp ?>
	<tr id="r_hp">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_hp"><?php echo $pegawai_view->hp->caption() ?></span></td>
		<td data-name="hp" <?php echo $pegawai_view->hp->cellAttributes() ?>>
<span id="el_pegawai_hp">
<span<?php echo $pegawai_view->hp->viewAttributes() ?>><?php echo $pegawai_view->hp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->tgllahir->Visible) { // tgllahir ?>
	<tr id="r_tgllahir">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_tgllahir"><?php echo $pegawai_view->tgllahir->caption() ?></span></td>
		<td data-name="tgllahir" <?php echo $pegawai_view->tgllahir->cellAttributes() ?>>
<span id="el_pegawai_tgllahir">
<span<?php echo $pegawai_view->tgllahir->viewAttributes() ?>><?php echo $pegawai_view->tgllahir->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->rekbank->Visible) { // rekbank ?>
	<tr id="r_rekbank">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_rekbank"><?php echo $pegawai_view->rekbank->caption() ?></span></td>
		<td data-name="rekbank" <?php echo $pegawai_view->rekbank->cellAttributes() ?>>
<span id="el_pegawai_rekbank">
<span<?php echo $pegawai_view->rekbank->viewAttributes() ?>><?php echo $pegawai_view->rekbank->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->pendidikan->Visible) { // pendidikan ?>
	<tr id="r_pendidikan">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_pendidikan"><?php echo $pegawai_view->pendidikan->caption() ?></span></td>
		<td data-name="pendidikan" <?php echo $pegawai_view->pendidikan->cellAttributes() ?>>
<span id="el_pegawai_pendidikan">
<span<?php echo $pegawai_view->pendidikan->viewAttributes() ?>><?php echo $pegawai_view->pendidikan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->jurusan->Visible) { // jurusan ?>
	<tr id="r_jurusan">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_jurusan"><?php echo $pegawai_view->jurusan->caption() ?></span></td>
		<td data-name="jurusan" <?php echo $pegawai_view->jurusan->cellAttributes() ?>>
<span id="el_pegawai_jurusan">
<span<?php echo $pegawai_view->jurusan->viewAttributes() ?>><?php echo $pegawai_view->jurusan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->agama->Visible) { // agama ?>
	<tr id="r_agama">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_agama"><?php echo $pegawai_view->agama->caption() ?></span></td>
		<td data-name="agama" <?php echo $pegawai_view->agama->cellAttributes() ?>>
<span id="el_pegawai_agama">
<span<?php echo $pegawai_view->agama->viewAttributes() ?>><?php echo $pegawai_view->agama->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->jenkel->Visible) { // jenkel ?>
	<tr id="r_jenkel">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_jenkel"><?php echo $pegawai_view->jenkel->caption() ?></span></td>
		<td data-name="jenkel" <?php echo $pegawai_view->jenkel->cellAttributes() ?>>
<span id="el_pegawai_jenkel">
<span<?php echo $pegawai_view->jenkel->viewAttributes() ?>><?php echo $pegawai_view->jenkel->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->status->Visible) { // status ?>
	<tr id="r_status">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_status"><?php echo $pegawai_view->status->caption() ?></span></td>
		<td data-name="status" <?php echo $pegawai_view->status->cellAttributes() ?>>
<span id="el_pegawai_status">
<span<?php echo $pegawai_view->status->viewAttributes() ?>><?php echo $pegawai_view->status->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->foto->Visible) { // foto ?>
	<tr id="r_foto">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_foto"><?php echo $pegawai_view->foto->caption() ?></span></td>
		<td data-name="foto" <?php echo $pegawai_view->foto->cellAttributes() ?>>
<span id="el_pegawai_foto">
<span<?php echo $pegawai_view->foto->viewAttributes() ?>><?php echo GetFileViewTag($pegawai_view->foto, $pegawai_view->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->file_cv->Visible) { // file_cv ?>
	<tr id="r_file_cv">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_file_cv"><?php echo $pegawai_view->file_cv->caption() ?></span></td>
		<td data-name="file_cv" <?php echo $pegawai_view->file_cv->cellAttributes() ?>>
<span id="el_pegawai_file_cv">
<span<?php echo $pegawai_view->file_cv->viewAttributes() ?>><?php echo GetFileViewTag($pegawai_view->file_cv, $pegawai_view->file_cv->getViewValue(), FALSE) ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->mulai_bekerja->Visible) { // mulai_bekerja ?>
	<tr id="r_mulai_bekerja">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_mulai_bekerja"><?php echo $pegawai_view->mulai_bekerja->caption() ?></span></td>
		<td data-name="mulai_bekerja" <?php echo $pegawai_view->mulai_bekerja->cellAttributes() ?>>
<span id="el_pegawai_mulai_bekerja">
<span<?php echo $pegawai_view->mulai_bekerja->viewAttributes() ?>><?php echo $pegawai_view->mulai_bekerja->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->keterangan->Visible) { // keterangan ?>
	<tr id="r_keterangan">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_keterangan"><?php echo $pegawai_view->keterangan->caption() ?></span></td>
		<td data-name="keterangan" <?php echo $pegawai_view->keterangan->cellAttributes() ?>>
<span id="el_pegawai_keterangan">
<span<?php echo $pegawai_view->keterangan->viewAttributes() ?>><?php echo $pegawai_view->keterangan->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->level->Visible) { // level ?>
	<tr id="r_level">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_level"><?php echo $pegawai_view->level->caption() ?></span></td>
		<td data-name="level" <?php echo $pegawai_view->level->cellAttributes() ?>>
<span id="el_pegawai_level">
<span<?php echo $pegawai_view->level->viewAttributes() ?>><?php echo $pegawai_view->level->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_view->aktif->Visible) { // aktif ?>
	<tr id="r_aktif">
		<td class="<?php echo $pegawai_view->TableLeftColumnClass ?>"><span id="elh_pegawai_aktif"><?php echo $pegawai_view->aktif->caption() ?></span></td>
		<td data-name="aktif" <?php echo $pegawai_view->aktif->cellAttributes() ?>>
<span id="el_pegawai_aktif">
<span<?php echo $pegawai_view->aktif->viewAttributes() ?>><?php echo $pegawai_view->aktif->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
<?php
	if (in_array("peg_skill", explode(",", $pegawai->getCurrentDetailTable())) && $peg_skill->DetailView) {
?>
<?php if ($pegawai->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("peg_skill", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "peg_skillgrid.php" ?>
<?php } ?>
<?php
	if (in_array("peg_keluarga", explode(",", $pegawai->getCurrentDetailTable())) && $peg_keluarga->DetailView) {
?>
<?php if ($pegawai->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("peg_keluarga", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "peg_keluargagrid.php" ?>
<?php } ?>
<?php
	if (in_array("peg_dokumen", explode(",", $pegawai->getCurrentDetailTable())) && $peg_dokumen->DetailView) {
?>
<?php if ($pegawai->getCurrentDetailTable() != "") { ?>
<h4 class="ew-detail-caption"><?php echo $Language->tablePhrase("peg_dokumen", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "peg_dokumengrid.php" ?>
<?php } ?>
</form>
<?php
$pegawai_view->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pegawai_view->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$pegawai_view->terminate();
?>