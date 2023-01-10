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
$dinasluar_list = new dinasluar_list();

// Run the page
$dinasluar_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$dinasluar_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$dinasluar_list->isExport()) { ?>
<script>
var fdinasluarlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdinasluarlist = currentForm = new ew.Form("fdinasluarlist", "list");
	fdinasluarlist.formKeyCountName = '<?php echo $dinasluar_list->FormKeyCountName ?>';
	loadjs.done("fdinasluarlist");
});
var fdinasluarlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdinasluarlistsrch = currentSearchForm = new ew.Form("fdinasluarlistsrch");

	// Dynamic selection lists
	// Filters

	fdinasluarlistsrch.filterList = <?php echo $dinasluar_list->getFilterList() ?>;
	loadjs.done("fdinasluarlistsrch");
});
</script>
<style type="text/css">
.ew-table-preview-row { /* main table preview row color */
	background-color: #FFFFFF; /* preview row color */
}
.ew-table-preview-row .ew-grid {
	display: table;
}
</style>
<div id="ew-preview" class="d-none"><!-- preview -->
	<div class="ew-nav-tabs"><!-- .ew-nav-tabs -->
		<ul class="nav nav-tabs"></ul>
		<div class="tab-content"><!-- .tab-content -->
			<div class="tab-pane fade active show"></div>
		</div><!-- /.tab-content -->
	</div><!-- /.ew-nav-tabs -->
</div><!-- /preview -->
<script>
loadjs.ready("head", function() {
	ew.PREVIEW_PLACEMENT = ew.CSS_FLIP ? "left" : "right";
	ew.PREVIEW_SINGLE_ROW = false;
	ew.PREVIEW_OVERLAY = false;
	loadjs("js/ewpreview.js", "preview");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$dinasluar_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($dinasluar_list->TotalRecords > 0 && $dinasluar_list->ExportOptions->visible()) { ?>
<?php $dinasluar_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($dinasluar_list->ImportOptions->visible()) { ?>
<?php $dinasluar_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($dinasluar_list->SearchOptions->visible()) { ?>
<?php $dinasluar_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($dinasluar_list->FilterOptions->visible()) { ?>
<?php $dinasluar_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$dinasluar_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$dinasluar_list->isExport() && !$dinasluar->CurrentAction) { ?>
<form name="fdinasluarlistsrch" id="fdinasluarlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdinasluarlistsrch-search-panel" class="<?php echo $dinasluar_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="dinasluar">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $dinasluar_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($dinasluar_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($dinasluar_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $dinasluar_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($dinasluar_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($dinasluar_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($dinasluar_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($dinasluar_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $dinasluar_list->showPageHeader(); ?>
<?php
$dinasluar_list->showMessage();
?>
<?php if ($dinasluar_list->TotalRecords > 0 || $dinasluar->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($dinasluar_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> dinasluar">
<?php if (!$dinasluar_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$dinasluar_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $dinasluar_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $dinasluar_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdinasluarlist" id="fdinasluarlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="dinasluar">
<div id="gmp_dinasluar" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($dinasluar_list->TotalRecords > 0 || $dinasluar_list->isGridEdit()) { ?>
<table id="tbl_dinasluarlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$dinasluar->RowType = ROWTYPE_HEADER;

// Render list options
$dinasluar_list->renderListOptions();

// Render list options (header, left)
$dinasluar_list->ListOptions->render("header", "left");
?>
<?php if ($dinasluar_list->pegawai->Visible) { // pegawai ?>
	<?php if ($dinasluar_list->SortUrl($dinasluar_list->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $dinasluar_list->pegawai->headerCellClass() ?>"><div id="elh_dinasluar_pegawai" class="dinasluar_pegawai"><div class="ew-table-header-caption"><?php echo $dinasluar_list->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $dinasluar_list->pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dinasluar_list->SortUrl($dinasluar_list->pegawai) ?>', 1);"><div id="elh_dinasluar_pegawai" class="dinasluar_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dinasluar_list->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($dinasluar_list->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dinasluar_list->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dinasluar_list->pm->Visible) { // pm ?>
	<?php if ($dinasluar_list->SortUrl($dinasluar_list->pm) == "") { ?>
		<th data-name="pm" class="<?php echo $dinasluar_list->pm->headerCellClass() ?>"><div id="elh_dinasluar_pm" class="dinasluar_pm"><div class="ew-table-header-caption"><?php echo $dinasluar_list->pm->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pm" class="<?php echo $dinasluar_list->pm->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dinasluar_list->SortUrl($dinasluar_list->pm) ?>', 1);"><div id="elh_dinasluar_pm" class="dinasluar_pm">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dinasluar_list->pm->caption() ?></span><span class="ew-table-header-sort"><?php if ($dinasluar_list->pm->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dinasluar_list->pm->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dinasluar_list->proyek->Visible) { // proyek ?>
	<?php if ($dinasluar_list->SortUrl($dinasluar_list->proyek) == "") { ?>
		<th data-name="proyek" class="<?php echo $dinasluar_list->proyek->headerCellClass() ?>"><div id="elh_dinasluar_proyek" class="dinasluar_proyek"><div class="ew-table-header-caption"><?php echo $dinasluar_list->proyek->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="proyek" class="<?php echo $dinasluar_list->proyek->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dinasluar_list->SortUrl($dinasluar_list->proyek) ?>', 1);"><div id="elh_dinasluar_proyek" class="dinasluar_proyek">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dinasluar_list->proyek->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dinasluar_list->proyek->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dinasluar_list->proyek->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dinasluar_list->tgl->Visible) { // tgl ?>
	<?php if ($dinasluar_list->SortUrl($dinasluar_list->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $dinasluar_list->tgl->headerCellClass() ?>"><div id="elh_dinasluar_tgl" class="dinasluar_tgl"><div class="ew-table-header-caption"><?php echo $dinasluar_list->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $dinasluar_list->tgl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dinasluar_list->SortUrl($dinasluar_list->tgl) ?>', 1);"><div id="elh_dinasluar_tgl" class="dinasluar_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dinasluar_list->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($dinasluar_list->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dinasluar_list->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dinasluar_list->tgl_dl_awal->Visible) { // tgl_dl_awal ?>
	<?php if ($dinasluar_list->SortUrl($dinasluar_list->tgl_dl_awal) == "") { ?>
		<th data-name="tgl_dl_awal" class="<?php echo $dinasluar_list->tgl_dl_awal->headerCellClass() ?>"><div id="elh_dinasluar_tgl_dl_awal" class="dinasluar_tgl_dl_awal"><div class="ew-table-header-caption"><?php echo $dinasluar_list->tgl_dl_awal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_dl_awal" class="<?php echo $dinasluar_list->tgl_dl_awal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dinasluar_list->SortUrl($dinasluar_list->tgl_dl_awal) ?>', 1);"><div id="elh_dinasluar_tgl_dl_awal" class="dinasluar_tgl_dl_awal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dinasluar_list->tgl_dl_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($dinasluar_list->tgl_dl_awal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dinasluar_list->tgl_dl_awal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dinasluar_list->tgl_dl_akhir->Visible) { // tgl_dl_akhir ?>
	<?php if ($dinasluar_list->SortUrl($dinasluar_list->tgl_dl_akhir) == "") { ?>
		<th data-name="tgl_dl_akhir" class="<?php echo $dinasluar_list->tgl_dl_akhir->headerCellClass() ?>"><div id="elh_dinasluar_tgl_dl_akhir" class="dinasluar_tgl_dl_akhir"><div class="ew-table-header-caption"><?php echo $dinasluar_list->tgl_dl_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_dl_akhir" class="<?php echo $dinasluar_list->tgl_dl_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dinasluar_list->SortUrl($dinasluar_list->tgl_dl_akhir) ?>', 1);"><div id="elh_dinasluar_tgl_dl_akhir" class="dinasluar_tgl_dl_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dinasluar_list->tgl_dl_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($dinasluar_list->tgl_dl_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dinasluar_list->tgl_dl_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dinasluar_list->jenis->Visible) { // jenis ?>
	<?php if ($dinasluar_list->SortUrl($dinasluar_list->jenis) == "") { ?>
		<th data-name="jenis" class="<?php echo $dinasluar_list->jenis->headerCellClass() ?>"><div id="elh_dinasluar_jenis" class="dinasluar_jenis"><div class="ew-table-header-caption"><?php echo $dinasluar_list->jenis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis" class="<?php echo $dinasluar_list->jenis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dinasluar_list->SortUrl($dinasluar_list->jenis) ?>', 1);"><div id="elh_dinasluar_jenis" class="dinasluar_jenis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dinasluar_list->jenis->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dinasluar_list->jenis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dinasluar_list->jenis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dinasluar_list->keterangan->Visible) { // keterangan ?>
	<?php if ($dinasluar_list->SortUrl($dinasluar_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $dinasluar_list->keterangan->headerCellClass() ?>"><div id="elh_dinasluar_keterangan" class="dinasluar_keterangan"><div class="ew-table-header-caption"><?php echo $dinasluar_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $dinasluar_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dinasluar_list->SortUrl($dinasluar_list->keterangan) ?>', 1);"><div id="elh_dinasluar_keterangan" class="dinasluar_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dinasluar_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dinasluar_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dinasluar_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dinasluar_list->disetujui->Visible) { // disetujui ?>
	<?php if ($dinasluar_list->SortUrl($dinasluar_list->disetujui) == "") { ?>
		<th data-name="disetujui" class="<?php echo $dinasluar_list->disetujui->headerCellClass() ?>"><div id="elh_dinasluar_disetujui" class="dinasluar_disetujui"><div class="ew-table-header-caption"><?php echo $dinasluar_list->disetujui->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disetujui" class="<?php echo $dinasluar_list->disetujui->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dinasluar_list->SortUrl($dinasluar_list->disetujui) ?>', 1);"><div id="elh_dinasluar_disetujui" class="dinasluar_disetujui">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dinasluar_list->disetujui->caption() ?></span><span class="ew-table-header-sort"><?php if ($dinasluar_list->disetujui->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dinasluar_list->disetujui->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($dinasluar_list->dokumen->Visible) { // dokumen ?>
	<?php if ($dinasluar_list->SortUrl($dinasluar_list->dokumen) == "") { ?>
		<th data-name="dokumen" class="<?php echo $dinasluar_list->dokumen->headerCellClass() ?>"><div id="elh_dinasluar_dokumen" class="dinasluar_dokumen"><div class="ew-table-header-caption"><?php echo $dinasluar_list->dokumen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dokumen" class="<?php echo $dinasluar_list->dokumen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $dinasluar_list->SortUrl($dinasluar_list->dokumen) ?>', 1);"><div id="elh_dinasluar_dokumen" class="dinasluar_dokumen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $dinasluar_list->dokumen->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($dinasluar_list->dokumen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($dinasluar_list->dokumen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$dinasluar_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($dinasluar_list->ExportAll && $dinasluar_list->isExport()) {
	$dinasluar_list->StopRecord = $dinasluar_list->TotalRecords;
} else {

	// Set the last record to display
	if ($dinasluar_list->TotalRecords > $dinasluar_list->StartRecord + $dinasluar_list->DisplayRecords - 1)
		$dinasluar_list->StopRecord = $dinasluar_list->StartRecord + $dinasluar_list->DisplayRecords - 1;
	else
		$dinasluar_list->StopRecord = $dinasluar_list->TotalRecords;
}
$dinasluar_list->RecordCount = $dinasluar_list->StartRecord - 1;
if ($dinasluar_list->Recordset && !$dinasluar_list->Recordset->EOF) {
	$dinasluar_list->Recordset->moveFirst();
	$selectLimit = $dinasluar_list->UseSelectLimit;
	if (!$selectLimit && $dinasluar_list->StartRecord > 1)
		$dinasluar_list->Recordset->move($dinasluar_list->StartRecord - 1);
} elseif (!$dinasluar->AllowAddDeleteRow && $dinasluar_list->StopRecord == 0) {
	$dinasluar_list->StopRecord = $dinasluar->GridAddRowCount;
}

// Initialize aggregate
$dinasluar->RowType = ROWTYPE_AGGREGATEINIT;
$dinasluar->resetAttributes();
$dinasluar_list->renderRow();
while ($dinasluar_list->RecordCount < $dinasluar_list->StopRecord) {
	$dinasluar_list->RecordCount++;
	if ($dinasluar_list->RecordCount >= $dinasluar_list->StartRecord) {
		$dinasluar_list->RowCount++;

		// Set up key count
		$dinasluar_list->KeyCount = $dinasluar_list->RowIndex;

		// Init row class and style
		$dinasluar->resetAttributes();
		$dinasluar->CssClass = "";
		if ($dinasluar_list->isGridAdd()) {
		} else {
			$dinasluar_list->loadRowValues($dinasluar_list->Recordset); // Load row values
		}
		$dinasluar->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$dinasluar->RowAttrs->merge(["data-rowindex" => $dinasluar_list->RowCount, "id" => "r" . $dinasluar_list->RowCount . "_dinasluar", "data-rowtype" => $dinasluar->RowType]);

		// Render row
		$dinasluar_list->renderRow();

		// Render list options
		$dinasluar_list->renderListOptions();
?>
	<tr <?php echo $dinasluar->rowAttributes() ?>>
<?php

// Render list options (body, left)
$dinasluar_list->ListOptions->render("body", "left", $dinasluar_list->RowCount);
?>
	<?php if ($dinasluar_list->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $dinasluar_list->pegawai->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_list->RowCount ?>_dinasluar_pegawai">
<span<?php echo $dinasluar_list->pegawai->viewAttributes() ?>><?php echo $dinasluar_list->pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dinasluar_list->pm->Visible) { // pm ?>
		<td data-name="pm" <?php echo $dinasluar_list->pm->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_list->RowCount ?>_dinasluar_pm">
<span<?php echo $dinasluar_list->pm->viewAttributes() ?>><?php echo $dinasluar_list->pm->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dinasluar_list->proyek->Visible) { // proyek ?>
		<td data-name="proyek" <?php echo $dinasluar_list->proyek->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_list->RowCount ?>_dinasluar_proyek">
<span<?php echo $dinasluar_list->proyek->viewAttributes() ?>><?php echo $dinasluar_list->proyek->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dinasluar_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $dinasluar_list->tgl->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_list->RowCount ?>_dinasluar_tgl">
<span<?php echo $dinasluar_list->tgl->viewAttributes() ?>><?php echo $dinasluar_list->tgl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dinasluar_list->tgl_dl_awal->Visible) { // tgl_dl_awal ?>
		<td data-name="tgl_dl_awal" <?php echo $dinasluar_list->tgl_dl_awal->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_list->RowCount ?>_dinasluar_tgl_dl_awal">
<span<?php echo $dinasluar_list->tgl_dl_awal->viewAttributes() ?>><?php echo $dinasluar_list->tgl_dl_awal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dinasluar_list->tgl_dl_akhir->Visible) { // tgl_dl_akhir ?>
		<td data-name="tgl_dl_akhir" <?php echo $dinasluar_list->tgl_dl_akhir->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_list->RowCount ?>_dinasluar_tgl_dl_akhir">
<span<?php echo $dinasluar_list->tgl_dl_akhir->viewAttributes() ?>><?php echo $dinasluar_list->tgl_dl_akhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dinasluar_list->jenis->Visible) { // jenis ?>
		<td data-name="jenis" <?php echo $dinasluar_list->jenis->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_list->RowCount ?>_dinasluar_jenis">
<span<?php echo $dinasluar_list->jenis->viewAttributes() ?>><?php echo $dinasluar_list->jenis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dinasluar_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $dinasluar_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_list->RowCount ?>_dinasluar_keterangan">
<span<?php echo $dinasluar_list->keterangan->viewAttributes() ?>><?php echo $dinasluar_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dinasluar_list->disetujui->Visible) { // disetujui ?>
		<td data-name="disetujui" <?php echo $dinasluar_list->disetujui->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_list->RowCount ?>_dinasluar_disetujui">
<span<?php echo $dinasluar_list->disetujui->viewAttributes() ?>><?php echo $dinasluar_list->disetujui->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($dinasluar_list->dokumen->Visible) { // dokumen ?>
		<td data-name="dokumen" <?php echo $dinasluar_list->dokumen->cellAttributes() ?>>
<span id="el<?php echo $dinasluar_list->RowCount ?>_dinasluar_dokumen">
<span<?php echo $dinasluar_list->dokumen->viewAttributes() ?>><?php echo GetFileViewTag($dinasluar_list->dokumen, $dinasluar_list->dokumen->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$dinasluar_list->ListOptions->render("body", "right", $dinasluar_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$dinasluar_list->isGridAdd())
		$dinasluar_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$dinasluar->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($dinasluar_list->Recordset)
	$dinasluar_list->Recordset->Close();
?>
<?php if (!$dinasluar_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$dinasluar_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $dinasluar_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $dinasluar_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($dinasluar_list->TotalRecords == 0 && !$dinasluar->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $dinasluar_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$dinasluar_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$dinasluar_list->isExport()) { ?>
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
$dinasluar_list->terminate();
?>