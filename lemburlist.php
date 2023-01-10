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
$lembur_list = new lembur_list();

// Run the page
$lembur_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$lembur_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$lembur_list->isExport()) { ?>
<script>
var flemburlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	flemburlist = currentForm = new ew.Form("flemburlist", "list");
	flemburlist.formKeyCountName = '<?php echo $lembur_list->FormKeyCountName ?>';
	loadjs.done("flemburlist");
});
var flemburlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	flemburlistsrch = currentSearchForm = new ew.Form("flemburlistsrch");

	// Dynamic selection lists
	// Filters

	flemburlistsrch.filterList = <?php echo $lembur_list->getFilterList() ?>;
	loadjs.done("flemburlistsrch");
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
<?php if (!$lembur_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($lembur_list->TotalRecords > 0 && $lembur_list->ExportOptions->visible()) { ?>
<?php $lembur_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($lembur_list->ImportOptions->visible()) { ?>
<?php $lembur_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($lembur_list->SearchOptions->visible()) { ?>
<?php $lembur_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($lembur_list->FilterOptions->visible()) { ?>
<?php $lembur_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$lembur_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$lembur_list->isExport() && !$lembur->CurrentAction) { ?>
<form name="flemburlistsrch" id="flemburlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="flemburlistsrch-search-panel" class="<?php echo $lembur_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="lembur">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $lembur_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($lembur_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($lembur_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $lembur_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($lembur_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($lembur_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($lembur_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($lembur_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $lembur_list->showPageHeader(); ?>
<?php
$lembur_list->showMessage();
?>
<?php if ($lembur_list->TotalRecords > 0 || $lembur->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($lembur_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> lembur">
<?php if (!$lembur_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$lembur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $lembur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $lembur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="flemburlist" id="flemburlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="lembur">
<div id="gmp_lembur" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($lembur_list->TotalRecords > 0 || $lembur_list->isGridEdit()) { ?>
<table id="tbl_lemburlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$lembur->RowType = ROWTYPE_HEADER;

// Render list options
$lembur_list->renderListOptions();

// Render list options (header, left)
$lembur_list->ListOptions->render("header", "left");
?>
<?php if ($lembur_list->pegawai->Visible) { // pegawai ?>
	<?php if ($lembur_list->SortUrl($lembur_list->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $lembur_list->pegawai->headerCellClass() ?>"><div id="elh_lembur_pegawai" class="lembur_pegawai"><div class="ew-table-header-caption"><?php echo $lembur_list->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $lembur_list->pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lembur_list->SortUrl($lembur_list->pegawai) ?>', 1);"><div id="elh_lembur_pegawai" class="lembur_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lembur_list->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($lembur_list->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lembur_list->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lembur_list->pm->Visible) { // pm ?>
	<?php if ($lembur_list->SortUrl($lembur_list->pm) == "") { ?>
		<th data-name="pm" class="<?php echo $lembur_list->pm->headerCellClass() ?>"><div id="elh_lembur_pm" class="lembur_pm"><div class="ew-table-header-caption"><?php echo $lembur_list->pm->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pm" class="<?php echo $lembur_list->pm->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lembur_list->SortUrl($lembur_list->pm) ?>', 1);"><div id="elh_lembur_pm" class="lembur_pm">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lembur_list->pm->caption() ?></span><span class="ew-table-header-sort"><?php if ($lembur_list->pm->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lembur_list->pm->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lembur_list->proyek->Visible) { // proyek ?>
	<?php if ($lembur_list->SortUrl($lembur_list->proyek) == "") { ?>
		<th data-name="proyek" class="<?php echo $lembur_list->proyek->headerCellClass() ?>"><div id="elh_lembur_proyek" class="lembur_proyek"><div class="ew-table-header-caption"><?php echo $lembur_list->proyek->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="proyek" class="<?php echo $lembur_list->proyek->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lembur_list->SortUrl($lembur_list->proyek) ?>', 1);"><div id="elh_lembur_proyek" class="lembur_proyek">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lembur_list->proyek->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lembur_list->proyek->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lembur_list->proyek->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lembur_list->tgl->Visible) { // tgl ?>
	<?php if ($lembur_list->SortUrl($lembur_list->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $lembur_list->tgl->headerCellClass() ?>"><div id="elh_lembur_tgl" class="lembur_tgl"><div class="ew-table-header-caption"><?php echo $lembur_list->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $lembur_list->tgl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lembur_list->SortUrl($lembur_list->tgl) ?>', 1);"><div id="elh_lembur_tgl" class="lembur_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lembur_list->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($lembur_list->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lembur_list->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lembur_list->tgl_awal_lembur->Visible) { // tgl_awal_lembur ?>
	<?php if ($lembur_list->SortUrl($lembur_list->tgl_awal_lembur) == "") { ?>
		<th data-name="tgl_awal_lembur" class="<?php echo $lembur_list->tgl_awal_lembur->headerCellClass() ?>"><div id="elh_lembur_tgl_awal_lembur" class="lembur_tgl_awal_lembur"><div class="ew-table-header-caption"><?php echo $lembur_list->tgl_awal_lembur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_awal_lembur" class="<?php echo $lembur_list->tgl_awal_lembur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lembur_list->SortUrl($lembur_list->tgl_awal_lembur) ?>', 1);"><div id="elh_lembur_tgl_awal_lembur" class="lembur_tgl_awal_lembur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lembur_list->tgl_awal_lembur->caption() ?></span><span class="ew-table-header-sort"><?php if ($lembur_list->tgl_awal_lembur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lembur_list->tgl_awal_lembur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lembur_list->tgl_akhir_lembur->Visible) { // tgl_akhir_lembur ?>
	<?php if ($lembur_list->SortUrl($lembur_list->tgl_akhir_lembur) == "") { ?>
		<th data-name="tgl_akhir_lembur" class="<?php echo $lembur_list->tgl_akhir_lembur->headerCellClass() ?>"><div id="elh_lembur_tgl_akhir_lembur" class="lembur_tgl_akhir_lembur"><div class="ew-table-header-caption"><?php echo $lembur_list->tgl_akhir_lembur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_akhir_lembur" class="<?php echo $lembur_list->tgl_akhir_lembur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lembur_list->SortUrl($lembur_list->tgl_akhir_lembur) ?>', 1);"><div id="elh_lembur_tgl_akhir_lembur" class="lembur_tgl_akhir_lembur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lembur_list->tgl_akhir_lembur->caption() ?></span><span class="ew-table-header-sort"><?php if ($lembur_list->tgl_akhir_lembur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lembur_list->tgl_akhir_lembur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lembur_list->total_jam->Visible) { // total_jam ?>
	<?php if ($lembur_list->SortUrl($lembur_list->total_jam) == "") { ?>
		<th data-name="total_jam" class="<?php echo $lembur_list->total_jam->headerCellClass() ?>"><div id="elh_lembur_total_jam" class="lembur_total_jam"><div class="ew-table-header-caption"><?php echo $lembur_list->total_jam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_jam" class="<?php echo $lembur_list->total_jam->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lembur_list->SortUrl($lembur_list->total_jam) ?>', 1);"><div id="elh_lembur_total_jam" class="lembur_total_jam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lembur_list->total_jam->caption() ?></span><span class="ew-table-header-sort"><?php if ($lembur_list->total_jam->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lembur_list->total_jam->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lembur_list->jenis->Visible) { // jenis ?>
	<?php if ($lembur_list->SortUrl($lembur_list->jenis) == "") { ?>
		<th data-name="jenis" class="<?php echo $lembur_list->jenis->headerCellClass() ?>"><div id="elh_lembur_jenis" class="lembur_jenis"><div class="ew-table-header-caption"><?php echo $lembur_list->jenis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis" class="<?php echo $lembur_list->jenis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lembur_list->SortUrl($lembur_list->jenis) ?>', 1);"><div id="elh_lembur_jenis" class="lembur_jenis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lembur_list->jenis->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lembur_list->jenis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lembur_list->jenis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lembur_list->keterangan->Visible) { // keterangan ?>
	<?php if ($lembur_list->SortUrl($lembur_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $lembur_list->keterangan->headerCellClass() ?>"><div id="elh_lembur_keterangan" class="lembur_keterangan"><div class="ew-table-header-caption"><?php echo $lembur_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $lembur_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lembur_list->SortUrl($lembur_list->keterangan) ?>', 1);"><div id="elh_lembur_keterangan" class="lembur_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lembur_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lembur_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lembur_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lembur_list->disetujui->Visible) { // disetujui ?>
	<?php if ($lembur_list->SortUrl($lembur_list->disetujui) == "") { ?>
		<th data-name="disetujui" class="<?php echo $lembur_list->disetujui->headerCellClass() ?>"><div id="elh_lembur_disetujui" class="lembur_disetujui"><div class="ew-table-header-caption"><?php echo $lembur_list->disetujui->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disetujui" class="<?php echo $lembur_list->disetujui->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lembur_list->SortUrl($lembur_list->disetujui) ?>', 1);"><div id="elh_lembur_disetujui" class="lembur_disetujui">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lembur_list->disetujui->caption() ?></span><span class="ew-table-header-sort"><?php if ($lembur_list->disetujui->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lembur_list->disetujui->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($lembur_list->dokumen->Visible) { // dokumen ?>
	<?php if ($lembur_list->SortUrl($lembur_list->dokumen) == "") { ?>
		<th data-name="dokumen" class="<?php echo $lembur_list->dokumen->headerCellClass() ?>"><div id="elh_lembur_dokumen" class="lembur_dokumen"><div class="ew-table-header-caption"><?php echo $lembur_list->dokumen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dokumen" class="<?php echo $lembur_list->dokumen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $lembur_list->SortUrl($lembur_list->dokumen) ?>', 1);"><div id="elh_lembur_dokumen" class="lembur_dokumen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $lembur_list->dokumen->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($lembur_list->dokumen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($lembur_list->dokumen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$lembur_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($lembur_list->ExportAll && $lembur_list->isExport()) {
	$lembur_list->StopRecord = $lembur_list->TotalRecords;
} else {

	// Set the last record to display
	if ($lembur_list->TotalRecords > $lembur_list->StartRecord + $lembur_list->DisplayRecords - 1)
		$lembur_list->StopRecord = $lembur_list->StartRecord + $lembur_list->DisplayRecords - 1;
	else
		$lembur_list->StopRecord = $lembur_list->TotalRecords;
}
$lembur_list->RecordCount = $lembur_list->StartRecord - 1;
if ($lembur_list->Recordset && !$lembur_list->Recordset->EOF) {
	$lembur_list->Recordset->moveFirst();
	$selectLimit = $lembur_list->UseSelectLimit;
	if (!$selectLimit && $lembur_list->StartRecord > 1)
		$lembur_list->Recordset->move($lembur_list->StartRecord - 1);
} elseif (!$lembur->AllowAddDeleteRow && $lembur_list->StopRecord == 0) {
	$lembur_list->StopRecord = $lembur->GridAddRowCount;
}

// Initialize aggregate
$lembur->RowType = ROWTYPE_AGGREGATEINIT;
$lembur->resetAttributes();
$lembur_list->renderRow();
while ($lembur_list->RecordCount < $lembur_list->StopRecord) {
	$lembur_list->RecordCount++;
	if ($lembur_list->RecordCount >= $lembur_list->StartRecord) {
		$lembur_list->RowCount++;

		// Set up key count
		$lembur_list->KeyCount = $lembur_list->RowIndex;

		// Init row class and style
		$lembur->resetAttributes();
		$lembur->CssClass = "";
		if ($lembur_list->isGridAdd()) {
		} else {
			$lembur_list->loadRowValues($lembur_list->Recordset); // Load row values
		}
		$lembur->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$lembur->RowAttrs->merge(["data-rowindex" => $lembur_list->RowCount, "id" => "r" . $lembur_list->RowCount . "_lembur", "data-rowtype" => $lembur->RowType]);

		// Render row
		$lembur_list->renderRow();

		// Render list options
		$lembur_list->renderListOptions();
?>
	<tr <?php echo $lembur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$lembur_list->ListOptions->render("body", "left", $lembur_list->RowCount);
?>
	<?php if ($lembur_list->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $lembur_list->pegawai->cellAttributes() ?>>
<span id="el<?php echo $lembur_list->RowCount ?>_lembur_pegawai">
<span<?php echo $lembur_list->pegawai->viewAttributes() ?>><?php echo $lembur_list->pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lembur_list->pm->Visible) { // pm ?>
		<td data-name="pm" <?php echo $lembur_list->pm->cellAttributes() ?>>
<span id="el<?php echo $lembur_list->RowCount ?>_lembur_pm">
<span<?php echo $lembur_list->pm->viewAttributes() ?>><?php echo $lembur_list->pm->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lembur_list->proyek->Visible) { // proyek ?>
		<td data-name="proyek" <?php echo $lembur_list->proyek->cellAttributes() ?>>
<span id="el<?php echo $lembur_list->RowCount ?>_lembur_proyek">
<span<?php echo $lembur_list->proyek->viewAttributes() ?>><?php echo $lembur_list->proyek->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lembur_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $lembur_list->tgl->cellAttributes() ?>>
<span id="el<?php echo $lembur_list->RowCount ?>_lembur_tgl">
<span<?php echo $lembur_list->tgl->viewAttributes() ?>><?php echo $lembur_list->tgl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lembur_list->tgl_awal_lembur->Visible) { // tgl_awal_lembur ?>
		<td data-name="tgl_awal_lembur" <?php echo $lembur_list->tgl_awal_lembur->cellAttributes() ?>>
<span id="el<?php echo $lembur_list->RowCount ?>_lembur_tgl_awal_lembur">
<span<?php echo $lembur_list->tgl_awal_lembur->viewAttributes() ?>><?php echo $lembur_list->tgl_awal_lembur->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lembur_list->tgl_akhir_lembur->Visible) { // tgl_akhir_lembur ?>
		<td data-name="tgl_akhir_lembur" <?php echo $lembur_list->tgl_akhir_lembur->cellAttributes() ?>>
<span id="el<?php echo $lembur_list->RowCount ?>_lembur_tgl_akhir_lembur">
<span<?php echo $lembur_list->tgl_akhir_lembur->viewAttributes() ?>><?php echo $lembur_list->tgl_akhir_lembur->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lembur_list->total_jam->Visible) { // total_jam ?>
		<td data-name="total_jam" <?php echo $lembur_list->total_jam->cellAttributes() ?>>
<span id="el<?php echo $lembur_list->RowCount ?>_lembur_total_jam">
<span<?php echo $lembur_list->total_jam->viewAttributes() ?>><?php echo $lembur_list->total_jam->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lembur_list->jenis->Visible) { // jenis ?>
		<td data-name="jenis" <?php echo $lembur_list->jenis->cellAttributes() ?>>
<span id="el<?php echo $lembur_list->RowCount ?>_lembur_jenis">
<span<?php echo $lembur_list->jenis->viewAttributes() ?>><?php echo $lembur_list->jenis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lembur_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $lembur_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $lembur_list->RowCount ?>_lembur_keterangan">
<span<?php echo $lembur_list->keterangan->viewAttributes() ?>><?php echo $lembur_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lembur_list->disetujui->Visible) { // disetujui ?>
		<td data-name="disetujui" <?php echo $lembur_list->disetujui->cellAttributes() ?>>
<span id="el<?php echo $lembur_list->RowCount ?>_lembur_disetujui">
<span<?php echo $lembur_list->disetujui->viewAttributes() ?>><?php echo $lembur_list->disetujui->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($lembur_list->dokumen->Visible) { // dokumen ?>
		<td data-name="dokumen" <?php echo $lembur_list->dokumen->cellAttributes() ?>>
<span id="el<?php echo $lembur_list->RowCount ?>_lembur_dokumen">
<span<?php echo $lembur_list->dokumen->viewAttributes() ?>><?php echo GetFileViewTag($lembur_list->dokumen, $lembur_list->dokumen->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$lembur_list->ListOptions->render("body", "right", $lembur_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$lembur_list->isGridAdd())
		$lembur_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$lembur->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($lembur_list->Recordset)
	$lembur_list->Recordset->Close();
?>
<?php if (!$lembur_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$lembur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $lembur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $lembur_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($lembur_list->TotalRecords == 0 && !$lembur->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $lembur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$lembur_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$lembur_list->isExport()) { ?>
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
$lembur_list->terminate();
?>