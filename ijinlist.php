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
$ijin_list = new ijin_list();

// Run the page
$ijin_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ijin_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ijin_list->isExport()) { ?>
<script>
var fijinlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fijinlist = currentForm = new ew.Form("fijinlist", "list");
	fijinlist.formKeyCountName = '<?php echo $ijin_list->FormKeyCountName ?>';
	loadjs.done("fijinlist");
});
var fijinlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fijinlistsrch = currentSearchForm = new ew.Form("fijinlistsrch");

	// Dynamic selection lists
	// Filters

	fijinlistsrch.filterList = <?php echo $ijin_list->getFilterList() ?>;
	loadjs.done("fijinlistsrch");
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
<?php if (!$ijin_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ijin_list->TotalRecords > 0 && $ijin_list->ExportOptions->visible()) { ?>
<?php $ijin_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ijin_list->ImportOptions->visible()) { ?>
<?php $ijin_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ijin_list->SearchOptions->visible()) { ?>
<?php $ijin_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ijin_list->FilterOptions->visible()) { ?>
<?php $ijin_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ijin_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ijin_list->isExport() && !$ijin->CurrentAction) { ?>
<form name="fijinlistsrch" id="fijinlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fijinlistsrch-search-panel" class="<?php echo $ijin_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ijin">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ijin_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ijin_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ijin_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ijin_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ijin_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ijin_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ijin_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ijin_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ijin_list->showPageHeader(); ?>
<?php
$ijin_list->showMessage();
?>
<?php if ($ijin_list->TotalRecords > 0 || $ijin->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ijin_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ijin">
<?php if (!$ijin_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ijin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ijin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ijin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fijinlist" id="fijinlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ijin">
<div id="gmp_ijin" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ijin_list->TotalRecords > 0 || $ijin_list->isGridEdit()) { ?>
<table id="tbl_ijinlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ijin->RowType = ROWTYPE_HEADER;

// Render list options
$ijin_list->renderListOptions();

// Render list options (header, left)
$ijin_list->ListOptions->render("header", "left");
?>
<?php if ($ijin_list->id->Visible) { // id ?>
	<?php if ($ijin_list->SortUrl($ijin_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $ijin_list->id->headerCellClass() ?>"><div id="elh_ijin_id" class="ijin_id"><div class="ew-table-header-caption"><?php echo $ijin_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $ijin_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ijin_list->SortUrl($ijin_list->id) ?>', 1);"><div id="elh_ijin_id" class="ijin_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ijin_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($ijin_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ijin_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ijin_list->pegawai->Visible) { // pegawai ?>
	<?php if ($ijin_list->SortUrl($ijin_list->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $ijin_list->pegawai->headerCellClass() ?>"><div id="elh_ijin_pegawai" class="ijin_pegawai"><div class="ew-table-header-caption"><?php echo $ijin_list->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $ijin_list->pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ijin_list->SortUrl($ijin_list->pegawai) ?>', 1);"><div id="elh_ijin_pegawai" class="ijin_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ijin_list->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($ijin_list->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ijin_list->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ijin_list->tgl->Visible) { // tgl ?>
	<?php if ($ijin_list->SortUrl($ijin_list->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $ijin_list->tgl->headerCellClass() ?>"><div id="elh_ijin_tgl" class="ijin_tgl"><div class="ew-table-header-caption"><?php echo $ijin_list->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $ijin_list->tgl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ijin_list->SortUrl($ijin_list->tgl) ?>', 1);"><div id="elh_ijin_tgl" class="ijin_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ijin_list->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($ijin_list->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ijin_list->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ijin_list->tgl_ijin_awal->Visible) { // tgl_ijin_awal ?>
	<?php if ($ijin_list->SortUrl($ijin_list->tgl_ijin_awal) == "") { ?>
		<th data-name="tgl_ijin_awal" class="<?php echo $ijin_list->tgl_ijin_awal->headerCellClass() ?>"><div id="elh_ijin_tgl_ijin_awal" class="ijin_tgl_ijin_awal"><div class="ew-table-header-caption"><?php echo $ijin_list->tgl_ijin_awal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_ijin_awal" class="<?php echo $ijin_list->tgl_ijin_awal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ijin_list->SortUrl($ijin_list->tgl_ijin_awal) ?>', 1);"><div id="elh_ijin_tgl_ijin_awal" class="ijin_tgl_ijin_awal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ijin_list->tgl_ijin_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($ijin_list->tgl_ijin_awal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ijin_list->tgl_ijin_awal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ijin_list->tgl_ijin_akhir->Visible) { // tgl_ijin_akhir ?>
	<?php if ($ijin_list->SortUrl($ijin_list->tgl_ijin_akhir) == "") { ?>
		<th data-name="tgl_ijin_akhir" class="<?php echo $ijin_list->tgl_ijin_akhir->headerCellClass() ?>"><div id="elh_ijin_tgl_ijin_akhir" class="ijin_tgl_ijin_akhir"><div class="ew-table-header-caption"><?php echo $ijin_list->tgl_ijin_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_ijin_akhir" class="<?php echo $ijin_list->tgl_ijin_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ijin_list->SortUrl($ijin_list->tgl_ijin_akhir) ?>', 1);"><div id="elh_ijin_tgl_ijin_akhir" class="ijin_tgl_ijin_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ijin_list->tgl_ijin_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($ijin_list->tgl_ijin_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ijin_list->tgl_ijin_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ijin_list->jenis->Visible) { // jenis ?>
	<?php if ($ijin_list->SortUrl($ijin_list->jenis) == "") { ?>
		<th data-name="jenis" class="<?php echo $ijin_list->jenis->headerCellClass() ?>"><div id="elh_ijin_jenis" class="ijin_jenis"><div class="ew-table-header-caption"><?php echo $ijin_list->jenis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis" class="<?php echo $ijin_list->jenis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ijin_list->SortUrl($ijin_list->jenis) ?>', 1);"><div id="elh_ijin_jenis" class="ijin_jenis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ijin_list->jenis->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ijin_list->jenis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ijin_list->jenis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ijin_list->keterangan->Visible) { // keterangan ?>
	<?php if ($ijin_list->SortUrl($ijin_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $ijin_list->keterangan->headerCellClass() ?>"><div id="elh_ijin_keterangan" class="ijin_keterangan"><div class="ew-table-header-caption"><?php echo $ijin_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $ijin_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ijin_list->SortUrl($ijin_list->keterangan) ?>', 1);"><div id="elh_ijin_keterangan" class="ijin_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ijin_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ijin_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ijin_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ijin_list->disetujui->Visible) { // disetujui ?>
	<?php if ($ijin_list->SortUrl($ijin_list->disetujui) == "") { ?>
		<th data-name="disetujui" class="<?php echo $ijin_list->disetujui->headerCellClass() ?>"><div id="elh_ijin_disetujui" class="ijin_disetujui"><div class="ew-table-header-caption"><?php echo $ijin_list->disetujui->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disetujui" class="<?php echo $ijin_list->disetujui->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ijin_list->SortUrl($ijin_list->disetujui) ?>', 1);"><div id="elh_ijin_disetujui" class="ijin_disetujui">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ijin_list->disetujui->caption() ?></span><span class="ew-table-header-sort"><?php if ($ijin_list->disetujui->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ijin_list->disetujui->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ijin_list->dokumen->Visible) { // dokumen ?>
	<?php if ($ijin_list->SortUrl($ijin_list->dokumen) == "") { ?>
		<th data-name="dokumen" class="<?php echo $ijin_list->dokumen->headerCellClass() ?>"><div id="elh_ijin_dokumen" class="ijin_dokumen"><div class="ew-table-header-caption"><?php echo $ijin_list->dokumen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dokumen" class="<?php echo $ijin_list->dokumen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ijin_list->SortUrl($ijin_list->dokumen) ?>', 1);"><div id="elh_ijin_dokumen" class="ijin_dokumen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ijin_list->dokumen->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ijin_list->dokumen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ijin_list->dokumen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ijin_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ijin_list->ExportAll && $ijin_list->isExport()) {
	$ijin_list->StopRecord = $ijin_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ijin_list->TotalRecords > $ijin_list->StartRecord + $ijin_list->DisplayRecords - 1)
		$ijin_list->StopRecord = $ijin_list->StartRecord + $ijin_list->DisplayRecords - 1;
	else
		$ijin_list->StopRecord = $ijin_list->TotalRecords;
}
$ijin_list->RecordCount = $ijin_list->StartRecord - 1;
if ($ijin_list->Recordset && !$ijin_list->Recordset->EOF) {
	$ijin_list->Recordset->moveFirst();
	$selectLimit = $ijin_list->UseSelectLimit;
	if (!$selectLimit && $ijin_list->StartRecord > 1)
		$ijin_list->Recordset->move($ijin_list->StartRecord - 1);
} elseif (!$ijin->AllowAddDeleteRow && $ijin_list->StopRecord == 0) {
	$ijin_list->StopRecord = $ijin->GridAddRowCount;
}

// Initialize aggregate
$ijin->RowType = ROWTYPE_AGGREGATEINIT;
$ijin->resetAttributes();
$ijin_list->renderRow();
while ($ijin_list->RecordCount < $ijin_list->StopRecord) {
	$ijin_list->RecordCount++;
	if ($ijin_list->RecordCount >= $ijin_list->StartRecord) {
		$ijin_list->RowCount++;

		// Set up key count
		$ijin_list->KeyCount = $ijin_list->RowIndex;

		// Init row class and style
		$ijin->resetAttributes();
		$ijin->CssClass = "";
		if ($ijin_list->isGridAdd()) {
		} else {
			$ijin_list->loadRowValues($ijin_list->Recordset); // Load row values
		}
		$ijin->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ijin->RowAttrs->merge(["data-rowindex" => $ijin_list->RowCount, "id" => "r" . $ijin_list->RowCount . "_ijin", "data-rowtype" => $ijin->RowType]);

		// Render row
		$ijin_list->renderRow();

		// Render list options
		$ijin_list->renderListOptions();
?>
	<tr <?php echo $ijin->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ijin_list->ListOptions->render("body", "left", $ijin_list->RowCount);
?>
	<?php if ($ijin_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $ijin_list->id->cellAttributes() ?>>
<span id="el<?php echo $ijin_list->RowCount ?>_ijin_id">
<span<?php echo $ijin_list->id->viewAttributes() ?>><?php echo $ijin_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ijin_list->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $ijin_list->pegawai->cellAttributes() ?>>
<span id="el<?php echo $ijin_list->RowCount ?>_ijin_pegawai">
<span<?php echo $ijin_list->pegawai->viewAttributes() ?>><?php echo $ijin_list->pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ijin_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $ijin_list->tgl->cellAttributes() ?>>
<span id="el<?php echo $ijin_list->RowCount ?>_ijin_tgl">
<span<?php echo $ijin_list->tgl->viewAttributes() ?>><?php echo $ijin_list->tgl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ijin_list->tgl_ijin_awal->Visible) { // tgl_ijin_awal ?>
		<td data-name="tgl_ijin_awal" <?php echo $ijin_list->tgl_ijin_awal->cellAttributes() ?>>
<span id="el<?php echo $ijin_list->RowCount ?>_ijin_tgl_ijin_awal">
<span<?php echo $ijin_list->tgl_ijin_awal->viewAttributes() ?>><?php echo $ijin_list->tgl_ijin_awal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ijin_list->tgl_ijin_akhir->Visible) { // tgl_ijin_akhir ?>
		<td data-name="tgl_ijin_akhir" <?php echo $ijin_list->tgl_ijin_akhir->cellAttributes() ?>>
<span id="el<?php echo $ijin_list->RowCount ?>_ijin_tgl_ijin_akhir">
<span<?php echo $ijin_list->tgl_ijin_akhir->viewAttributes() ?>><?php echo $ijin_list->tgl_ijin_akhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ijin_list->jenis->Visible) { // jenis ?>
		<td data-name="jenis" <?php echo $ijin_list->jenis->cellAttributes() ?>>
<span id="el<?php echo $ijin_list->RowCount ?>_ijin_jenis">
<span<?php echo $ijin_list->jenis->viewAttributes() ?>><?php echo $ijin_list->jenis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ijin_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $ijin_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $ijin_list->RowCount ?>_ijin_keterangan">
<span<?php echo $ijin_list->keterangan->viewAttributes() ?>><?php echo $ijin_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ijin_list->disetujui->Visible) { // disetujui ?>
		<td data-name="disetujui" <?php echo $ijin_list->disetujui->cellAttributes() ?>>
<span id="el<?php echo $ijin_list->RowCount ?>_ijin_disetujui">
<span<?php echo $ijin_list->disetujui->viewAttributes() ?>><?php echo $ijin_list->disetujui->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ijin_list->dokumen->Visible) { // dokumen ?>
		<td data-name="dokumen" <?php echo $ijin_list->dokumen->cellAttributes() ?>>
<span id="el<?php echo $ijin_list->RowCount ?>_ijin_dokumen">
<span<?php echo $ijin_list->dokumen->viewAttributes() ?>><?php echo GetFileViewTag($ijin_list->dokumen, $ijin_list->dokumen->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ijin_list->ListOptions->render("body", "right", $ijin_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ijin_list->isGridAdd())
		$ijin_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ijin->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ijin_list->Recordset)
	$ijin_list->Recordset->Close();
?>
<?php if (!$ijin_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ijin_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ijin_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ijin_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ijin_list->TotalRecords == 0 && !$ijin->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ijin_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ijin_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ijin_list->isExport()) { ?>
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
$ijin_list->terminate();
?>