<?php

namespace PHPMaker2022\sigap;

// Page object
$PegawaiList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentTable = <?= JsonEncode($Page->toClientVar()) ?>;
ew.deepAssign(ew.vars, { tables: { pegawai: currentTable } });
var currentForm, currentPageID;
var fpegawailist;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object
    fpegawailist = new ew.Form("fpegawailist", "list");
    currentPageID = ew.PAGE_ID = "list";
    currentForm = fpegawailist;
    fpegawailist.formKeyCountName = "<?= $Page->FormKeyCountName ?>";
    loadjs.done("fpegawailist");
});
var fpegawaisrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready(["wrapper", "head"], function () {
    var $ = jQuery;
    // Form object for search
    fpegawaisrch = new ew.Form("fpegawaisrch", "list");
    currentSearchForm = fpegawaisrch;

    // Dynamic selection lists

    // Filters
    fpegawaisrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fpegawaisrch");
});
</script>
<script>
ew.PREVIEW_SELECTOR = ".ew-preview-btn";
ew.PREVIEW_ROW = true;
ew.PREVIEW_SINGLE_ROW = false;
ew.ready("head", ew.PATH_BASE + "js/preview.min.js", "preview");
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction && $Page->hasSearchFields()) { ?>
<form name="fpegawaisrch" id="fpegawaisrch" class="ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fpegawaisrch_search_panel" class="mb-2 mb-sm-0 <?= $Page->SearchPanelClass ?>"><!-- .ew-search-panel -->
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pegawai">
<div class="ew-extended-search container-fluid">
<div class="row mb-0">
    <div class="col-sm-auto px-0 pe-sm-2">
        <div class="ew-basic-search input-group">
            <input type="search" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control ew-basic-search-keyword" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>" aria-label="<?= HtmlEncode($Language->phrase("Search")) ?>">
            <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" class="ew-basic-search-type" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
            <button type="button" data-bs-toggle="dropdown" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false">
                <span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span>
            </button>
            <div class="dropdown-menu dropdown-menu-end">
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "" ? " active" : "" ?>" form="fpegawaisrch" data-ew-action="search-type"><?= $Language->phrase("QuickSearchAuto") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "=" ? " active" : "" ?>" form="fpegawaisrch" data-ew-action="search-type" data-search-type="="><?= $Language->phrase("QuickSearchExact") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "AND" ? " active" : "" ?>" form="fpegawaisrch" data-ew-action="search-type" data-search-type="AND"><?= $Language->phrase("QuickSearchAll") ?></button>
                <button type="button" class="dropdown-item<?= $Page->BasicSearch->getType() == "OR" ? " active" : "" ?>" form="fpegawaisrch" data-ew-action="search-type" data-search-type="OR"><?= $Language->phrase("QuickSearchAny") ?></button>
            </div>
        </div>
    </div>
    <div class="col-sm-auto mb-3">
        <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
    </div>
</div>
</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pegawai">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
</div>
<?php } ?>
<form name="fpegawailist" id="fpegawailist" class="ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="pegawai">
<div id="gmp_pegawai" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_pegawailist" class="table table-bordered table-hover table-sm ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->_username->Visible) { // username ?>
        <th data-name="_username" class="<?= $Page->_username->headerCellClass() ?>"><div id="elh_pegawai__username" class="pegawai__username"><?= $Page->renderFieldHeader($Page->_username) ?></div></th>
<?php } ?>
<?php if ($Page->_password->Visible) { // password ?>
        <th data-name="_password" class="<?= $Page->_password->headerCellClass() ?>"><div id="elh_pegawai__password" class="pegawai__password"><?= $Page->renderFieldHeader($Page->_password) ?></div></th>
<?php } ?>
<?php if ($Page->nip->Visible) { // nip ?>
        <th data-name="nip" class="<?= $Page->nip->headerCellClass() ?>"><div id="elh_pegawai_nip" class="pegawai_nip"><?= $Page->renderFieldHeader($Page->nip) ?></div></th>
<?php } ?>
<?php if ($Page->nama->Visible) { // nama ?>
        <th data-name="nama" class="<?= $Page->nama->headerCellClass() ?>"><div id="elh_pegawai_nama" class="pegawai_nama"><?= $Page->renderFieldHeader($Page->nama) ?></div></th>
<?php } ?>
<?php if ($Page->alamat->Visible) { // alamat ?>
        <th data-name="alamat" class="<?= $Page->alamat->headerCellClass() ?>"><div id="elh_pegawai_alamat" class="pegawai_alamat"><?= $Page->renderFieldHeader($Page->alamat) ?></div></th>
<?php } ?>
<?php if ($Page->_email->Visible) { // email ?>
        <th data-name="_email" class="<?= $Page->_email->headerCellClass() ?>"><div id="elh_pegawai__email" class="pegawai__email"><?= $Page->renderFieldHeader($Page->_email) ?></div></th>
<?php } ?>
<?php if ($Page->wa->Visible) { // wa ?>
        <th data-name="wa" class="<?= $Page->wa->headerCellClass() ?>"><div id="elh_pegawai_wa" class="pegawai_wa"><?= $Page->renderFieldHeader($Page->wa) ?></div></th>
<?php } ?>
<?php if ($Page->hp->Visible) { // hp ?>
        <th data-name="hp" class="<?= $Page->hp->headerCellClass() ?>"><div id="elh_pegawai_hp" class="pegawai_hp"><?= $Page->renderFieldHeader($Page->hp) ?></div></th>
<?php } ?>
<?php if ($Page->tgllahir->Visible) { // tgllahir ?>
        <th data-name="tgllahir" class="<?= $Page->tgllahir->headerCellClass() ?>"><div id="elh_pegawai_tgllahir" class="pegawai_tgllahir"><?= $Page->renderFieldHeader($Page->tgllahir) ?></div></th>
<?php } ?>
<?php if ($Page->rekbank->Visible) { // rekbank ?>
        <th data-name="rekbank" class="<?= $Page->rekbank->headerCellClass() ?>"><div id="elh_pegawai_rekbank" class="pegawai_rekbank"><?= $Page->renderFieldHeader($Page->rekbank) ?></div></th>
<?php } ?>
<?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
        <th data-name="jenjang_id" class="<?= $Page->jenjang_id->headerCellClass() ?>"><div id="elh_pegawai_jenjang_id" class="pegawai_jenjang_id"><?= $Page->renderFieldHeader($Page->jenjang_id) ?></div></th>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <th data-name="pendidikan" class="<?= $Page->pendidikan->headerCellClass() ?>"><div id="elh_pegawai_pendidikan" class="pegawai_pendidikan"><?= $Page->renderFieldHeader($Page->pendidikan) ?></div></th>
<?php } ?>
<?php if ($Page->jurusan->Visible) { // jurusan ?>
        <th data-name="jurusan" class="<?= $Page->jurusan->headerCellClass() ?>"><div id="elh_pegawai_jurusan" class="pegawai_jurusan"><?= $Page->renderFieldHeader($Page->jurusan) ?></div></th>
<?php } ?>
<?php if ($Page->agama->Visible) { // agama ?>
        <th data-name="agama" class="<?= $Page->agama->headerCellClass() ?>"><div id="elh_pegawai_agama" class="pegawai_agama"><?= $Page->renderFieldHeader($Page->agama) ?></div></th>
<?php } ?>
<?php if ($Page->jabatan->Visible) { // jabatan ?>
        <th data-name="jabatan" class="<?= $Page->jabatan->headerCellClass() ?>"><div id="elh_pegawai_jabatan" class="pegawai_jabatan"><?= $Page->renderFieldHeader($Page->jabatan) ?></div></th>
<?php } ?>
<?php if ($Page->jenkel->Visible) { // jenkel ?>
        <th data-name="jenkel" class="<?= $Page->jenkel->headerCellClass() ?>"><div id="elh_pegawai_jenkel" class="pegawai_jenkel"><?= $Page->renderFieldHeader($Page->jenkel) ?></div></th>
<?php } ?>
<?php if ($Page->mulai_bekerja->Visible) { // mulai_bekerja ?>
        <th data-name="mulai_bekerja" class="<?= $Page->mulai_bekerja->headerCellClass() ?>"><div id="elh_pegawai_mulai_bekerja" class="pegawai_mulai_bekerja"><?= $Page->renderFieldHeader($Page->mulai_bekerja) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_pegawai_status" class="pegawai_status"><?= $Page->renderFieldHeader($Page->status) ?></div></th>
<?php } ?>
<?php if ($Page->keterangan->Visible) { // keterangan ?>
        <th data-name="keterangan" class="<?= $Page->keterangan->headerCellClass() ?>"><div id="elh_pegawai_keterangan" class="pegawai_keterangan"><?= $Page->renderFieldHeader($Page->keterangan) ?></div></th>
<?php } ?>
<?php if ($Page->level->Visible) { // level ?>
        <th data-name="level" class="<?= $Page->level->headerCellClass() ?>"><div id="elh_pegawai_level" class="pegawai_level"><?= $Page->renderFieldHeader($Page->level) ?></div></th>
<?php } ?>
<?php if ($Page->aktif->Visible) { // aktif ?>
        <th data-name="aktif" class="<?= $Page->aktif->headerCellClass() ?>"><div id="elh_pegawai_aktif" class="pegawai_aktif"><?= $Page->renderFieldHeader($Page->aktif) ?></div></th>
<?php } ?>
<?php if ($Page->foto->Visible) { // foto ?>
        <th data-name="foto" class="<?= $Page->foto->headerCellClass() ?>"><div id="elh_pegawai_foto" class="pegawai_foto"><?= $Page->renderFieldHeader($Page->foto) ?></div></th>
<?php } ?>
<?php if ($Page->file_cv->Visible) { // file_cv ?>
        <th data-name="file_cv" class="<?= $Page->file_cv->headerCellClass() ?>"><div id="elh_pegawai_file_cv" class="pegawai_file_cv"><?= $Page->renderFieldHeader($Page->file_cv) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif ($Page->isGridAdd() && !$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row attributes
        $Page->RowAttrs->merge([
            "data-rowindex" => $Page->RowCount,
            "id" => "r" . $Page->RowCount . "_pegawai",
            "data-rowtype" => $Page->RowType,
            "class" => ($Page->RowCount % 2 != 1) ? "ew-table-alt-row" : "",
        ]);
        if ($Page->isAdd() && $Page->RowType == ROWTYPE_ADD || $Page->isEdit() && $Page->RowType == ROWTYPE_EDIT) { // Inline-Add/Edit row
            $Page->RowAttrs->appendClass("table-active");
        }

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->_username->Visible) { // username ?>
        <td data-name="_username"<?= $Page->_username->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai__username" class="el_pegawai__username">
<span<?= $Page->_username->viewAttributes() ?>>
<?= $Page->_username->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_password->Visible) { // password ?>
        <td data-name="_password"<?= $Page->_password->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai__password" class="el_pegawai__password">
<span<?= $Page->_password->viewAttributes() ?>>
<?= $Page->_password->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nip->Visible) { // nip ?>
        <td data-name="nip"<?= $Page->nip->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_nip" class="el_pegawai_nip">
<span<?= $Page->nip->viewAttributes() ?>>
<?= $Page->nip->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama->Visible) { // nama ?>
        <td data-name="nama"<?= $Page->nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_nama" class="el_pegawai_nama">
<span<?= $Page->nama->viewAttributes() ?>>
<?= $Page->nama->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->alamat->Visible) { // alamat ?>
        <td data-name="alamat"<?= $Page->alamat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_alamat" class="el_pegawai_alamat">
<span<?= $Page->alamat->viewAttributes() ?>>
<?= $Page->alamat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->_email->Visible) { // email ?>
        <td data-name="_email"<?= $Page->_email->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai__email" class="el_pegawai__email">
<span<?= $Page->_email->viewAttributes() ?>>
<?= $Page->_email->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->wa->Visible) { // wa ?>
        <td data-name="wa"<?= $Page->wa->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_wa" class="el_pegawai_wa">
<span<?= $Page->wa->viewAttributes() ?>>
<?= $Page->wa->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->hp->Visible) { // hp ?>
        <td data-name="hp"<?= $Page->hp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_hp" class="el_pegawai_hp">
<span<?= $Page->hp->viewAttributes() ?>>
<?= $Page->hp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tgllahir->Visible) { // tgllahir ?>
        <td data-name="tgllahir"<?= $Page->tgllahir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_tgllahir" class="el_pegawai_tgllahir">
<span<?= $Page->tgllahir->viewAttributes() ?>>
<?= $Page->tgllahir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->rekbank->Visible) { // rekbank ?>
        <td data-name="rekbank"<?= $Page->rekbank->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_rekbank" class="el_pegawai_rekbank">
<span<?= $Page->rekbank->viewAttributes() ?>>
<?= $Page->rekbank->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jenjang_id->Visible) { // jenjang_id ?>
        <td data-name="jenjang_id"<?= $Page->jenjang_id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_jenjang_id" class="el_pegawai_jenjang_id">
<span<?= $Page->jenjang_id->viewAttributes() ?>>
<?= $Page->jenjang_id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <td data-name="pendidikan"<?= $Page->pendidikan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_pendidikan" class="el_pegawai_pendidikan">
<span<?= $Page->pendidikan->viewAttributes() ?>>
<?= $Page->pendidikan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jurusan->Visible) { // jurusan ?>
        <td data-name="jurusan"<?= $Page->jurusan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_jurusan" class="el_pegawai_jurusan">
<span<?= $Page->jurusan->viewAttributes() ?>>
<?= $Page->jurusan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->agama->Visible) { // agama ?>
        <td data-name="agama"<?= $Page->agama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_agama" class="el_pegawai_agama">
<span<?= $Page->agama->viewAttributes() ?>>
<?= $Page->agama->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jabatan->Visible) { // jabatan ?>
        <td data-name="jabatan"<?= $Page->jabatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_jabatan" class="el_pegawai_jabatan">
<span<?= $Page->jabatan->viewAttributes() ?>>
<?= $Page->jabatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jenkel->Visible) { // jenkel ?>
        <td data-name="jenkel"<?= $Page->jenkel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_jenkel" class="el_pegawai_jenkel">
<span<?= $Page->jenkel->viewAttributes() ?>>
<?= $Page->jenkel->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->mulai_bekerja->Visible) { // mulai_bekerja ?>
        <td data-name="mulai_bekerja"<?= $Page->mulai_bekerja->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_mulai_bekerja" class="el_pegawai_mulai_bekerja">
<span<?= $Page->mulai_bekerja->viewAttributes() ?>>
<?= $Page->mulai_bekerja->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status"<?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_status" class="el_pegawai_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->keterangan->Visible) { // keterangan ?>
        <td data-name="keterangan"<?= $Page->keterangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_keterangan" class="el_pegawai_keterangan">
<span<?= $Page->keterangan->viewAttributes() ?>>
<?= $Page->keterangan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->level->Visible) { // level ?>
        <td data-name="level"<?= $Page->level->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_level" class="el_pegawai_level">
<span<?= $Page->level->viewAttributes() ?>>
<?= $Page->level->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->aktif->Visible) { // aktif ?>
        <td data-name="aktif"<?= $Page->aktif->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_aktif" class="el_pegawai_aktif">
<span<?= $Page->aktif->viewAttributes() ?>>
<?= $Page->aktif->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->foto->Visible) { // foto ?>
        <td data-name="foto"<?= $Page->foto->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_foto" class="el_pegawai_foto">
<span<?= $Page->foto->viewAttributes() ?>>
<?= GetFileViewTag($Page->foto, $Page->foto->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->file_cv->Visible) { // file_cv ?>
        <td data-name="file_cv"<?= $Page->file_cv->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_pegawai_file_cv" class="el_pegawai_file_cv">
<span<?= $Page->file_cv->viewAttributes() ?>>
<?= GetFileViewTag($Page->file_cv, $Page->file_cv->getViewValue(), false) ?>
</span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } else { ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("pegawai");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
