<?php

namespace PHPMaker2022\sigap;

// Page object
$PegawaiDelete = &$Page;
?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pegawai: currentTable } });
var currentForm, currentPageID;
var fpegawaidelete;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpegawaidelete = new ew.Form("fpegawaidelete", "delete");
    currentPageID = ew.PAGE_ID = "delete";
    currentForm = fpegawaidelete;
    loadjs.done("fpegawaidelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fpegawaidelete" id="fpegawaidelete" class="ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pegawai">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table table-bordered table-hover table-sm ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->_username->Visible) { // username ?>
        <th class="<?= $Page->_username->headerCellClass() ?>"><span id="elh_pegawai__username" class="pegawai__username"><?= $Page->_username->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <th class="<?= $Page->_password->headerCellClass() ?>"><span id="elh_pegawai__password" class="pegawai__password"><?= $Page->_password->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <th class="<?= $Page->nip->headerCellClass() ?>"><span id="elh_pegawai_nip" class="pegawai_nip"><?= $Page->nip->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th class="<?= $Page->nama->headerCellClass() ?>"><span id="elh_pegawai_nama" class="pegawai_nama"><?= $Page->nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <th class="<?= $Page->alamat->headerCellClass() ?>"><span id="elh_pegawai_alamat" class="pegawai_alamat"><?= $Page->alamat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th class="<?= $Page->_email->headerCellClass() ?>"><span id="elh_pegawai__email" class="pegawai__email"><?= $Page->_email->caption() ?></span></th>
<?php } ?>
<?php if ($Page->wa->Visible) { // wa ?>
        <th class="<?= $Page->wa->headerCellClass() ?>"><span id="elh_pegawai_wa" class="pegawai_wa"><?= $Page->wa->caption() ?></span></th>
<?php } ?>
<?php if ($Page->hp->Visible) { // hp ?>
        <th class="<?= $Page->hp->headerCellClass() ?>"><span id="elh_pegawai_hp" class="pegawai_hp"><?= $Page->hp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tgllahir->Visible) { // tgllahir ?>
        <th class="<?= $Page->tgllahir->headerCellClass() ?>"><span id="elh_pegawai_tgllahir" class="pegawai_tgllahir"><?= $Page->tgllahir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->rekbank->Visible) { // rekbank ?>
        <th class="<?= $Page->rekbank->headerCellClass() ?>"><span id="elh_pegawai_rekbank" class="pegawai_rekbank"><?= $Page->rekbank->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
        <th class="<?= $Page->jenjang_id->headerCellClass() ?>"><span id="elh_pegawai_jenjang_id" class="pegawai_jenjang_id"><?= $Page->jenjang_id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <th class="<?= $Page->pendidikan->headerCellClass() ?>"><span id="elh_pegawai_pendidikan" class="pegawai_pendidikan"><?= $Page->pendidikan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jurusan->Visible) { // jurusan ?>
        <th class="<?= $Page->jurusan->headerCellClass() ?>"><span id="elh_pegawai_jurusan" class="pegawai_jurusan"><?= $Page->jurusan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
        <th class="<?= $Page->agama->headerCellClass() ?>"><span id="elh_pegawai_agama" class="pegawai_agama"><?= $Page->agama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
        <th class="<?= $Page->jabatan->headerCellClass() ?>"><span id="elh_pegawai_jabatan" class="pegawai_jabatan"><?= $Page->jabatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenkel->Visible) { // jenkel ?>
        <th class="<?= $Page->jenkel->headerCellClass() ?>"><span id="elh_pegawai_jenkel" class="pegawai_jenkel"><?= $Page->jenkel->caption() ?></span></th>
<?php } ?>
<?php if ($Page->mulai_bekerja->Visible) { // mulai_bekerja ?>
        <th class="<?= $Page->mulai_bekerja->headerCellClass() ?>"><span id="elh_pegawai_mulai_bekerja" class="pegawai_mulai_bekerja"><?= $Page->mulai_bekerja->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_pegawai_status" class="pegawai_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th class="<?= $Page->keterangan->headerCellClass() ?>"><span id="elh_pegawai_keterangan" class="pegawai_keterangan"><?= $Page->keterangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->level->Visible) { // level ?>
        <th class="<?= $Page->level->headerCellClass() ?>"><span id="elh_pegawai_level" class="pegawai_level"><?= $Page->level->caption() ?></span></th>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
        <th class="<?= $Page->aktif->headerCellClass() ?>"><span id="elh_pegawai_aktif" class="pegawai_aktif"><?= $Page->aktif->caption() ?></span></th>
<?php } ?>
<?php if ($Page->foto->Visible) { // foto ?>
        <th class="<?= $Page->foto->headerCellClass() ?>"><span id="elh_pegawai_foto" class="pegawai_foto"><?= $Page->foto->caption() ?></span></th>
<?php } ?>
<?php if ($Page->file_cv->Visible) { // file_cv ?>
        <th class="<?= $Page->file_cv->headerCellClass() ?>"><span id="elh_pegawai_file_cv" class="pegawai_file_cv"><?= $Page->file_cv->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->_username->Visible) { // username ?>
        <td<?= $Page->_username->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai__username" class="el_pegawai__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <td<?= $Page->_password->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai__password" class="el_pegawai__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <td<?= $Page->nip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_nip" class="el_pegawai_nip">
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <td<?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_nama" class="el_pegawai_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <td<?= $Page->alamat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_alamat" class="el_pegawai_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <td<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai__email" class="el_pegawai__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->wa->Visible) { // wa ?>
        <td<?= $Page->wa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_wa" class="el_pegawai_wa">
<span<?= $Page->wa->viewAttributes() ?>>
<?= $Page->wa->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->hp->Visible) { // hp ?>
        <td<?= $Page->hp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_hp" class="el_pegawai_hp">
<span<?= $Page->hp->viewAttributes() ?>>
<?= $Page->hp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tgllahir->Visible) { // tgllahir ?>
        <td<?= $Page->tgllahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_tgllahir" class="el_pegawai_tgllahir">
<span<?= $Page->tgllahir->viewAttributes() ?>>
<?= $Page->tgllahir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->rekbank->Visible) { // rekbank ?>
        <td<?= $Page->rekbank->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_rekbank" class="el_pegawai_rekbank">
<span<?= $Page->rekbank->viewAttributes() ?>>
<?= $Page->rekbank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
        <td<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_jenjang_id" class="el_pegawai_jenjang_id">
<span<?= $Page->jenjang_id->viewAttributes() ?>>
<?= $Page->jenjang_id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <td<?= $Page->pendidikan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_pendidikan" class="el_pegawai_pendidikan">
<span<?= $Page->pendidikan->viewAttributes() ?>>
<?= $Page->pendidikan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jurusan->Visible) { // jurusan ?>
        <td<?= $Page->jurusan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_jurusan" class="el_pegawai_jurusan">
<span<?= $Page->jurusan->viewAttributes() ?>>
<?= $Page->jurusan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
        <td<?= $Page->agama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_agama" class="el_pegawai_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
        <td<?= $Page->jabatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_jabatan" class="el_pegawai_jabatan">
<span<?= $Page->jabatan->viewAttributes() ?>>
<?= $Page->jabatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenkel->Visible) { // jenkel ?>
        <td<?= $Page->jenkel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_jenkel" class="el_pegawai_jenkel">
<span<?= $Page->jenkel->viewAttributes() ?>>
<?= $Page->jenkel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->mulai_bekerja->Visible) { // mulai_bekerja ?>
        <td<?= $Page->mulai_bekerja->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_mulai_bekerja" class="el_pegawai_mulai_bekerja">
<span<?= $Page->mulai_bekerja->viewAttributes() ?>>
<?= $Page->mulai_bekerja->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_status" class="el_pegawai_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td<?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_keterangan" class="el_pegawai_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->level->Visible) { // level ?>
        <td<?= $Page->level->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_level" class="el_pegawai_level">
<span<?= $Page->level->viewAttributes() ?>>
<?= $Page->level->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
        <td<?= $Page->aktif->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_aktif" class="el_pegawai_aktif">
<span<?= $Page->aktif->viewAttributes() ?>>
<?= $Page->aktif->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->foto->Visible) { // foto ?>
        <td<?= $Page->foto->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_foto" class="el_pegawai_foto">
<span<?= $Page->foto->viewAttributes() ?>>
<?= GetFileViewTag($Page->foto, $Page->foto->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->file_cv->Visible) { // file_cv ?>
        <td<?= $Page->file_cv->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_file_cv" class="el_pegawai_file_cv">
<span<?= $Page->file_cv->viewAttributes() ?>>
<?= GetFileViewTag($Page->file_cv, $Page->file_cv->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
