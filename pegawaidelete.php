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
$pegawai_delete = new pegawai_delete();

// Run the page
$pegawai_delete->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pegawai_delete->Page_Render();
?>
<?php include_once "header.php"; ?>
<script>
var fpegawaidelete, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "delete";
	fpegawaidelete = currentForm = new ew.Form("fpegawaidelete", "delete");
	loadjs.done("fpegawaidelete");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php $pegawai_delete->showPageHeader(); ?>
<?php
$pegawai_delete->showMessage();
?>
<form name="fpegawaidelete" id="fpegawaidelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pegawai">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($pegawai_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($pegawai_delete->nip->Visible) { // nip ?>
		<th class="<?php echo $pegawai_delete->nip->headerCellClass() ?>"><span id="elh_pegawai_nip" class="pegawai_nip"><?php echo $pegawai_delete->nip->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->username->Visible) { // username ?>
		<th class="<?php echo $pegawai_delete->username->headerCellClass() ?>"><span id="elh_pegawai_username" class="pegawai_username"><?php echo $pegawai_delete->username->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->password->Visible) { // password ?>
		<th class="<?php echo $pegawai_delete->password->headerCellClass() ?>"><span id="elh_pegawai_password" class="pegawai_password"><?php echo $pegawai_delete->password->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->jenjang_id->Visible) { // jenjang_id ?>
		<th class="<?php echo $pegawai_delete->jenjang_id->headerCellClass() ?>"><span id="elh_pegawai_jenjang_id" class="pegawai_jenjang_id"><?php echo $pegawai_delete->jenjang_id->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->jabatan->Visible) { // jabatan ?>
		<th class="<?php echo $pegawai_delete->jabatan->headerCellClass() ?>"><span id="elh_pegawai_jabatan" class="pegawai_jabatan"><?php echo $pegawai_delete->jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->periode_jabatan->Visible) { // periode_jabatan ?>
		<th class="<?php echo $pegawai_delete->periode_jabatan->headerCellClass() ?>"><span id="elh_pegawai_periode_jabatan" class="pegawai_periode_jabatan"><?php echo $pegawai_delete->periode_jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->type->Visible) { // type ?>
		<th class="<?php echo $pegawai_delete->type->headerCellClass() ?>"><span id="elh_pegawai_type" class="pegawai_type"><?php echo $pegawai_delete->type->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->sertif->Visible) { // sertif ?>
		<th class="<?php echo $pegawai_delete->sertif->headerCellClass() ?>"><span id="elh_pegawai_sertif" class="pegawai_sertif"><?php echo $pegawai_delete->sertif->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->tambahan->Visible) { // tambahan ?>
		<th class="<?php echo $pegawai_delete->tambahan->headerCellClass() ?>"><span id="elh_pegawai_tambahan" class="pegawai_tambahan"><?php echo $pegawai_delete->tambahan->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->lama_kerja->Visible) { // lama_kerja ?>
		<th class="<?php echo $pegawai_delete->lama_kerja->headerCellClass() ?>"><span id="elh_pegawai_lama_kerja" class="pegawai_lama_kerja"><?php echo $pegawai_delete->lama_kerja->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->nama->Visible) { // nama ?>
		<th class="<?php echo $pegawai_delete->nama->headerCellClass() ?>"><span id="elh_pegawai_nama" class="pegawai_nama"><?php echo $pegawai_delete->nama->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->alamat->Visible) { // alamat ?>
		<th class="<?php echo $pegawai_delete->alamat->headerCellClass() ?>"><span id="elh_pegawai_alamat" class="pegawai_alamat"><?php echo $pegawai_delete->alamat->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->_email->Visible) { // email ?>
		<th class="<?php echo $pegawai_delete->_email->headerCellClass() ?>"><span id="elh_pegawai__email" class="pegawai__email"><?php echo $pegawai_delete->_email->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->wa->Visible) { // wa ?>
		<th class="<?php echo $pegawai_delete->wa->headerCellClass() ?>"><span id="elh_pegawai_wa" class="pegawai_wa"><?php echo $pegawai_delete->wa->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->hp->Visible) { // hp ?>
		<th class="<?php echo $pegawai_delete->hp->headerCellClass() ?>"><span id="elh_pegawai_hp" class="pegawai_hp"><?php echo $pegawai_delete->hp->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->tgllahir->Visible) { // tgllahir ?>
		<th class="<?php echo $pegawai_delete->tgllahir->headerCellClass() ?>"><span id="elh_pegawai_tgllahir" class="pegawai_tgllahir"><?php echo $pegawai_delete->tgllahir->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->rekbank->Visible) { // rekbank ?>
		<th class="<?php echo $pegawai_delete->rekbank->headerCellClass() ?>"><span id="elh_pegawai_rekbank" class="pegawai_rekbank"><?php echo $pegawai_delete->rekbank->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->pendidikan->Visible) { // pendidikan ?>
		<th class="<?php echo $pegawai_delete->pendidikan->headerCellClass() ?>"><span id="elh_pegawai_pendidikan" class="pegawai_pendidikan"><?php echo $pegawai_delete->pendidikan->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->jurusan->Visible) { // jurusan ?>
		<th class="<?php echo $pegawai_delete->jurusan->headerCellClass() ?>"><span id="elh_pegawai_jurusan" class="pegawai_jurusan"><?php echo $pegawai_delete->jurusan->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->agama->Visible) { // agama ?>
		<th class="<?php echo $pegawai_delete->agama->headerCellClass() ?>"><span id="elh_pegawai_agama" class="pegawai_agama"><?php echo $pegawai_delete->agama->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->jenkel->Visible) { // jenkel ?>
		<th class="<?php echo $pegawai_delete->jenkel->headerCellClass() ?>"><span id="elh_pegawai_jenkel" class="pegawai_jenkel"><?php echo $pegawai_delete->jenkel->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->status->Visible) { // status ?>
		<th class="<?php echo $pegawai_delete->status->headerCellClass() ?>"><span id="elh_pegawai_status" class="pegawai_status"><?php echo $pegawai_delete->status->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->foto->Visible) { // foto ?>
		<th class="<?php echo $pegawai_delete->foto->headerCellClass() ?>"><span id="elh_pegawai_foto" class="pegawai_foto"><?php echo $pegawai_delete->foto->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->file_cv->Visible) { // file_cv ?>
		<th class="<?php echo $pegawai_delete->file_cv->headerCellClass() ?>"><span id="elh_pegawai_file_cv" class="pegawai_file_cv"><?php echo $pegawai_delete->file_cv->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->mulai_bekerja->Visible) { // mulai_bekerja ?>
		<th class="<?php echo $pegawai_delete->mulai_bekerja->headerCellClass() ?>"><span id="elh_pegawai_mulai_bekerja" class="pegawai_mulai_bekerja"><?php echo $pegawai_delete->mulai_bekerja->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->keterangan->Visible) { // keterangan ?>
		<th class="<?php echo $pegawai_delete->keterangan->headerCellClass() ?>"><span id="elh_pegawai_keterangan" class="pegawai_keterangan"><?php echo $pegawai_delete->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->level->Visible) { // level ?>
		<th class="<?php echo $pegawai_delete->level->headerCellClass() ?>"><span id="elh_pegawai_level" class="pegawai_level"><?php echo $pegawai_delete->level->caption() ?></span></th>
<?php } ?>
<?php if ($pegawai_delete->aktif->Visible) { // aktif ?>
		<th class="<?php echo $pegawai_delete->aktif->headerCellClass() ?>"><span id="elh_pegawai_aktif" class="pegawai_aktif"><?php echo $pegawai_delete->aktif->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$pegawai_delete->RecordCount = 0;
$i = 0;
while (!$pegawai_delete->Recordset->EOF) {
	$pegawai_delete->RecordCount++;
	$pegawai_delete->RowCount++;

	// Set row properties
	$pegawai->resetAttributes();
	$pegawai->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$pegawai_delete->loadRowValues($pegawai_delete->Recordset);

	// Render row
	$pegawai_delete->renderRow();
?>
	<tr <?php echo $pegawai->rowAttributes() ?>>
<?php if ($pegawai_delete->nip->Visible) { // nip ?>
		<td <?php echo $pegawai_delete->nip->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_nip" class="pegawai_nip">
<span<?php echo $pegawai_delete->nip->viewAttributes() ?>><?php echo $pegawai_delete->nip->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->username->Visible) { // username ?>
		<td <?php echo $pegawai_delete->username->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_username" class="pegawai_username">
<span<?php echo $pegawai_delete->username->viewAttributes() ?>><?php echo $pegawai_delete->username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->password->Visible) { // password ?>
		<td <?php echo $pegawai_delete->password->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_password" class="pegawai_password">
<span<?php echo $pegawai_delete->password->viewAttributes() ?>><?php echo $pegawai_delete->password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->jenjang_id->Visible) { // jenjang_id ?>
		<td <?php echo $pegawai_delete->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_jenjang_id" class="pegawai_jenjang_id">
<span<?php echo $pegawai_delete->jenjang_id->viewAttributes() ?>><?php echo $pegawai_delete->jenjang_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->jabatan->Visible) { // jabatan ?>
		<td <?php echo $pegawai_delete->jabatan->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_jabatan" class="pegawai_jabatan">
<span<?php echo $pegawai_delete->jabatan->viewAttributes() ?>><?php echo $pegawai_delete->jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->periode_jabatan->Visible) { // periode_jabatan ?>
		<td <?php echo $pegawai_delete->periode_jabatan->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_periode_jabatan" class="pegawai_periode_jabatan">
<span<?php echo $pegawai_delete->periode_jabatan->viewAttributes() ?>><?php echo $pegawai_delete->periode_jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->type->Visible) { // type ?>
		<td <?php echo $pegawai_delete->type->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_type" class="pegawai_type">
<span<?php echo $pegawai_delete->type->viewAttributes() ?>><?php echo $pegawai_delete->type->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->sertif->Visible) { // sertif ?>
		<td <?php echo $pegawai_delete->sertif->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_sertif" class="pegawai_sertif">
<span<?php echo $pegawai_delete->sertif->viewAttributes() ?>><?php echo $pegawai_delete->sertif->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->tambahan->Visible) { // tambahan ?>
		<td <?php echo $pegawai_delete->tambahan->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_tambahan" class="pegawai_tambahan">
<span<?php echo $pegawai_delete->tambahan->viewAttributes() ?>><?php echo $pegawai_delete->tambahan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->lama_kerja->Visible) { // lama_kerja ?>
		<td <?php echo $pegawai_delete->lama_kerja->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_lama_kerja" class="pegawai_lama_kerja">
<span<?php echo $pegawai_delete->lama_kerja->viewAttributes() ?>><?php echo $pegawai_delete->lama_kerja->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->nama->Visible) { // nama ?>
		<td <?php echo $pegawai_delete->nama->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_nama" class="pegawai_nama">
<span<?php echo $pegawai_delete->nama->viewAttributes() ?>><?php echo $pegawai_delete->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->alamat->Visible) { // alamat ?>
		<td <?php echo $pegawai_delete->alamat->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_alamat" class="pegawai_alamat">
<span<?php echo $pegawai_delete->alamat->viewAttributes() ?>><?php echo $pegawai_delete->alamat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->_email->Visible) { // email ?>
		<td <?php echo $pegawai_delete->_email->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai__email" class="pegawai__email">
<span<?php echo $pegawai_delete->_email->viewAttributes() ?>><?php echo $pegawai_delete->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->wa->Visible) { // wa ?>
		<td <?php echo $pegawai_delete->wa->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_wa" class="pegawai_wa">
<span<?php echo $pegawai_delete->wa->viewAttributes() ?>><?php echo $pegawai_delete->wa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->hp->Visible) { // hp ?>
		<td <?php echo $pegawai_delete->hp->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_hp" class="pegawai_hp">
<span<?php echo $pegawai_delete->hp->viewAttributes() ?>><?php echo $pegawai_delete->hp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->tgllahir->Visible) { // tgllahir ?>
		<td <?php echo $pegawai_delete->tgllahir->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_tgllahir" class="pegawai_tgllahir">
<span<?php echo $pegawai_delete->tgllahir->viewAttributes() ?>><?php echo $pegawai_delete->tgllahir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->rekbank->Visible) { // rekbank ?>
		<td <?php echo $pegawai_delete->rekbank->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_rekbank" class="pegawai_rekbank">
<span<?php echo $pegawai_delete->rekbank->viewAttributes() ?>><?php echo $pegawai_delete->rekbank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->pendidikan->Visible) { // pendidikan ?>
		<td <?php echo $pegawai_delete->pendidikan->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_pendidikan" class="pegawai_pendidikan">
<span<?php echo $pegawai_delete->pendidikan->viewAttributes() ?>><?php echo $pegawai_delete->pendidikan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->jurusan->Visible) { // jurusan ?>
		<td <?php echo $pegawai_delete->jurusan->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_jurusan" class="pegawai_jurusan">
<span<?php echo $pegawai_delete->jurusan->viewAttributes() ?>><?php echo $pegawai_delete->jurusan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->agama->Visible) { // agama ?>
		<td <?php echo $pegawai_delete->agama->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_agama" class="pegawai_agama">
<span<?php echo $pegawai_delete->agama->viewAttributes() ?>><?php echo $pegawai_delete->agama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->jenkel->Visible) { // jenkel ?>
		<td <?php echo $pegawai_delete->jenkel->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_jenkel" class="pegawai_jenkel">
<span<?php echo $pegawai_delete->jenkel->viewAttributes() ?>><?php echo $pegawai_delete->jenkel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->status->Visible) { // status ?>
		<td <?php echo $pegawai_delete->status->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_status" class="pegawai_status">
<span<?php echo $pegawai_delete->status->viewAttributes() ?>><?php echo $pegawai_delete->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->foto->Visible) { // foto ?>
		<td <?php echo $pegawai_delete->foto->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_foto" class="pegawai_foto">
<span<?php echo $pegawai_delete->foto->viewAttributes() ?>><?php echo GetFileViewTag($pegawai_delete->foto, $pegawai_delete->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->file_cv->Visible) { // file_cv ?>
		<td <?php echo $pegawai_delete->file_cv->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_file_cv" class="pegawai_file_cv">
<span<?php echo $pegawai_delete->file_cv->viewAttributes() ?>><?php echo GetFileViewTag($pegawai_delete->file_cv, $pegawai_delete->file_cv->getViewValue(), FALSE) ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->mulai_bekerja->Visible) { // mulai_bekerja ?>
		<td <?php echo $pegawai_delete->mulai_bekerja->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_mulai_bekerja" class="pegawai_mulai_bekerja">
<span<?php echo $pegawai_delete->mulai_bekerja->viewAttributes() ?>><?php echo $pegawai_delete->mulai_bekerja->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->keterangan->Visible) { // keterangan ?>
		<td <?php echo $pegawai_delete->keterangan->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_keterangan" class="pegawai_keterangan">
<span<?php echo $pegawai_delete->keterangan->viewAttributes() ?>><?php echo $pegawai_delete->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->level->Visible) { // level ?>
		<td <?php echo $pegawai_delete->level->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_level" class="pegawai_level">
<span<?php echo $pegawai_delete->level->viewAttributes() ?>><?php echo $pegawai_delete->level->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pegawai_delete->aktif->Visible) { // aktif ?>
		<td <?php echo $pegawai_delete->aktif->cellAttributes() ?>>
<span id="el<?php echo $pegawai_delete->RowCount ?>_pegawai_aktif" class="pegawai_aktif">
<span<?php echo $pegawai_delete->aktif->viewAttributes() ?>><?php echo $pegawai_delete->aktif->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$pegawai_delete->Recordset->moveNext();
}
$pegawai_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pegawai_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$pegawai_delete->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php include_once "footer.php"; ?>
<?php
$pegawai_delete->terminate();
?>