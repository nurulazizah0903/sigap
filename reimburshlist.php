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
$reimbursh_list = new reimbursh_list();

// Run the page
$reimbursh_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$reimbursh_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$reimbursh_list->isExport()) { ?>
<script>
var freimburshlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	freimburshlist = currentForm = new ew.Form("freimburshlist", "list");
	freimburshlist.formKeyCountName = '<?php echo $reimbursh_list->FormKeyCountName ?>';
	loadjs.done("freimburshlist");
});
var freimburshlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	freimburshlistsrch = currentSearchForm = new ew.Form("freimburshlistsrch");

	// Dynamic selection lists
	// Filters

	freimburshlistsrch.filterList = <?php echo $reimbursh_list->getFilterList() ?>;
	loadjs.done("freimburshlistsrch");
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
<?php if (!$reimbursh_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($reimbursh_list->TotalRecords > 0 && $reimbursh_list->ExportOptions->visible()) { ?>
<?php $reimbursh_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($reimbursh_list->ImportOptions->visible()) { ?>
<?php $reimbursh_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($reimbursh_list->SearchOptions->visible()) { ?>
<?php $reimbursh_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($reimbursh_list->FilterOptions->visible()) { ?>
<?php $reimbursh_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$reimbursh_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$reimbursh_list->isExport() && !$reimbursh->CurrentAction) { ?>
<form name="freimburshlistsrch" id="freimburshlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="freimburshlistsrch-search-panel" class="<?php echo $reimbursh_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="reimbursh">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $reimbursh_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($reimbursh_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($reimbursh_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $reimbursh_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($reimbursh_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($reimbursh_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($reimbursh_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($reimbursh_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $reimbursh_list->showPageHeader(); ?>
<?php
$reimbursh_list->showMessage();
?>
<?php if ($reimbursh_list->TotalRecords > 0 || $reimbursh->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($reimbursh_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> reimbursh">
<?php if (!$reimbursh_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$reimbursh_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $reimbursh_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $reimbursh_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="freimburshlist" id="freimburshlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="reimbursh">
<div id="gmp_reimbursh" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($reimbursh_list->TotalRecords > 0 || $reimbursh_list->isGridEdit()) { ?>
<table id="tbl_reimburshlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$reimbursh->RowType = ROWTYPE_HEADER;

// Render list options
$reimbursh_list->renderListOptions();

// Render list options (header, left)
$reimbursh_list->ListOptions->render("header", "left");
?>
<?php if ($reimbursh_list->id->Visible) { // id ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $reimbursh_list->id->headerCellClass() ?>"><div id="elh_reimbursh_id" class="reimbursh_id"><div class="ew-table-header-caption"><?php echo $reimbursh_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $reimbursh_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->id) ?>', 1);"><div id="elh_reimbursh_id" class="reimbursh_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->pegawai->Visible) { // pegawai ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $reimbursh_list->pegawai->headerCellClass() ?>"><div id="elh_reimbursh_pegawai" class="reimbursh_pegawai"><div class="ew-table-header-caption"><?php echo $reimbursh_list->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $reimbursh_list->pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->pegawai) ?>', 1);"><div id="elh_reimbursh_pegawai" class="reimbursh_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->nama->Visible) { // nama ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $reimbursh_list->nama->headerCellClass() ?>"><div id="elh_reimbursh_nama" class="reimbursh_nama"><div class="ew-table-header-caption"><?php echo $reimbursh_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $reimbursh_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->nama) ?>', 1);"><div id="elh_reimbursh_nama" class="reimbursh_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->tgl->Visible) { // tgl ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $reimbursh_list->tgl->headerCellClass() ?>"><div id="elh_reimbursh_tgl" class="reimbursh_tgl"><div class="ew-table-header-caption"><?php echo $reimbursh_list->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $reimbursh_list->tgl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->tgl) ?>', 1);"><div id="elh_reimbursh_tgl" class="reimbursh_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->total_pengajuan->Visible) { // total_pengajuan ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->total_pengajuan) == "") { ?>
		<th data-name="total_pengajuan" class="<?php echo $reimbursh_list->total_pengajuan->headerCellClass() ?>"><div id="elh_reimbursh_total_pengajuan" class="reimbursh_total_pengajuan"><div class="ew-table-header-caption"><?php echo $reimbursh_list->total_pengajuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_pengajuan" class="<?php echo $reimbursh_list->total_pengajuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->total_pengajuan) ?>', 1);"><div id="elh_reimbursh_total_pengajuan" class="reimbursh_total_pengajuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->total_pengajuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->total_pengajuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->total_pengajuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->tgl_pengajuan->Visible) { // tgl_pengajuan ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->tgl_pengajuan) == "") { ?>
		<th data-name="tgl_pengajuan" class="<?php echo $reimbursh_list->tgl_pengajuan->headerCellClass() ?>"><div id="elh_reimbursh_tgl_pengajuan" class="reimbursh_tgl_pengajuan"><div class="ew-table-header-caption"><?php echo $reimbursh_list->tgl_pengajuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_pengajuan" class="<?php echo $reimbursh_list->tgl_pengajuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->tgl_pengajuan) ?>', 1);"><div id="elh_reimbursh_tgl_pengajuan" class="reimbursh_tgl_pengajuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->tgl_pengajuan->caption() ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->tgl_pengajuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->tgl_pengajuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->jenis->Visible) { // jenis ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->jenis) == "") { ?>
		<th data-name="jenis" class="<?php echo $reimbursh_list->jenis->headerCellClass() ?>"><div id="elh_reimbursh_jenis" class="reimbursh_jenis"><div class="ew-table-header-caption"><?php echo $reimbursh_list->jenis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis" class="<?php echo $reimbursh_list->jenis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->jenis) ?>', 1);"><div id="elh_reimbursh_jenis" class="reimbursh_jenis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->jenis->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->jenis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->jenis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->rek_tujuan->Visible) { // rek_tujuan ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->rek_tujuan) == "") { ?>
		<th data-name="rek_tujuan" class="<?php echo $reimbursh_list->rek_tujuan->headerCellClass() ?>"><div id="elh_reimbursh_rek_tujuan" class="reimbursh_rek_tujuan"><div class="ew-table-header-caption"><?php echo $reimbursh_list->rek_tujuan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rek_tujuan" class="<?php echo $reimbursh_list->rek_tujuan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->rek_tujuan) ?>', 1);"><div id="elh_reimbursh_rek_tujuan" class="reimbursh_rek_tujuan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->rek_tujuan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->rek_tujuan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->rek_tujuan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->bukti1->Visible) { // bukti1 ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->bukti1) == "") { ?>
		<th data-name="bukti1" class="<?php echo $reimbursh_list->bukti1->headerCellClass() ?>"><div id="elh_reimbursh_bukti1" class="reimbursh_bukti1"><div class="ew-table-header-caption"><?php echo $reimbursh_list->bukti1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bukti1" class="<?php echo $reimbursh_list->bukti1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->bukti1) ?>', 1);"><div id="elh_reimbursh_bukti1" class="reimbursh_bukti1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->bukti1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->bukti1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->bukti1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->bukti2->Visible) { // bukti2 ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->bukti2) == "") { ?>
		<th data-name="bukti2" class="<?php echo $reimbursh_list->bukti2->headerCellClass() ?>"><div id="elh_reimbursh_bukti2" class="reimbursh_bukti2"><div class="ew-table-header-caption"><?php echo $reimbursh_list->bukti2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bukti2" class="<?php echo $reimbursh_list->bukti2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->bukti2) ?>', 1);"><div id="elh_reimbursh_bukti2" class="reimbursh_bukti2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->bukti2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->bukti2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->bukti2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->bukti3->Visible) { // bukti3 ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->bukti3) == "") { ?>
		<th data-name="bukti3" class="<?php echo $reimbursh_list->bukti3->headerCellClass() ?>"><div id="elh_reimbursh_bukti3" class="reimbursh_bukti3"><div class="ew-table-header-caption"><?php echo $reimbursh_list->bukti3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bukti3" class="<?php echo $reimbursh_list->bukti3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->bukti3) ?>', 1);"><div id="elh_reimbursh_bukti3" class="reimbursh_bukti3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->bukti3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->bukti3->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->bukti3->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->bukti4->Visible) { // bukti4 ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->bukti4) == "") { ?>
		<th data-name="bukti4" class="<?php echo $reimbursh_list->bukti4->headerCellClass() ?>"><div id="elh_reimbursh_bukti4" class="reimbursh_bukti4"><div class="ew-table-header-caption"><?php echo $reimbursh_list->bukti4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bukti4" class="<?php echo $reimbursh_list->bukti4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->bukti4) ?>', 1);"><div id="elh_reimbursh_bukti4" class="reimbursh_bukti4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->bukti4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->bukti4->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->bukti4->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->disetujui->Visible) { // disetujui ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->disetujui) == "") { ?>
		<th data-name="disetujui" class="<?php echo $reimbursh_list->disetujui->headerCellClass() ?>"><div id="elh_reimbursh_disetujui" class="reimbursh_disetujui"><div class="ew-table-header-caption"><?php echo $reimbursh_list->disetujui->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disetujui" class="<?php echo $reimbursh_list->disetujui->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->disetujui) ?>', 1);"><div id="elh_reimbursh_disetujui" class="reimbursh_disetujui">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->disetujui->caption() ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->disetujui->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->disetujui->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->pembayar->Visible) { // pembayar ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->pembayar) == "") { ?>
		<th data-name="pembayar" class="<?php echo $reimbursh_list->pembayar->headerCellClass() ?>"><div id="elh_reimbursh_pembayar" class="reimbursh_pembayar"><div class="ew-table-header-caption"><?php echo $reimbursh_list->pembayar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pembayar" class="<?php echo $reimbursh_list->pembayar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->pembayar) ?>', 1);"><div id="elh_reimbursh_pembayar" class="reimbursh_pembayar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->pembayar->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->pembayar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->pembayar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->terbayar->Visible) { // terbayar ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->terbayar) == "") { ?>
		<th data-name="terbayar" class="<?php echo $reimbursh_list->terbayar->headerCellClass() ?>"><div id="elh_reimbursh_terbayar" class="reimbursh_terbayar"><div class="ew-table-header-caption"><?php echo $reimbursh_list->terbayar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="terbayar" class="<?php echo $reimbursh_list->terbayar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->terbayar) ?>', 1);"><div id="elh_reimbursh_terbayar" class="reimbursh_terbayar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->terbayar->caption() ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->terbayar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->terbayar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->tgl_pembayaran->Visible) { // tgl_pembayaran ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->tgl_pembayaran) == "") { ?>
		<th data-name="tgl_pembayaran" class="<?php echo $reimbursh_list->tgl_pembayaran->headerCellClass() ?>"><div id="elh_reimbursh_tgl_pembayaran" class="reimbursh_tgl_pembayaran"><div class="ew-table-header-caption"><?php echo $reimbursh_list->tgl_pembayaran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_pembayaran" class="<?php echo $reimbursh_list->tgl_pembayaran->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->tgl_pembayaran) ?>', 1);"><div id="elh_reimbursh_tgl_pembayaran" class="reimbursh_tgl_pembayaran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->tgl_pembayaran->caption() ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->tgl_pembayaran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->tgl_pembayaran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($reimbursh_list->jumlah_dibayar->Visible) { // jumlah_dibayar ?>
	<?php if ($reimbursh_list->SortUrl($reimbursh_list->jumlah_dibayar) == "") { ?>
		<th data-name="jumlah_dibayar" class="<?php echo $reimbursh_list->jumlah_dibayar->headerCellClass() ?>"><div id="elh_reimbursh_jumlah_dibayar" class="reimbursh_jumlah_dibayar"><div class="ew-table-header-caption"><?php echo $reimbursh_list->jumlah_dibayar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah_dibayar" class="<?php echo $reimbursh_list->jumlah_dibayar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $reimbursh_list->SortUrl($reimbursh_list->jumlah_dibayar) ?>', 1);"><div id="elh_reimbursh_jumlah_dibayar" class="reimbursh_jumlah_dibayar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $reimbursh_list->jumlah_dibayar->caption() ?></span><span class="ew-table-header-sort"><?php if ($reimbursh_list->jumlah_dibayar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($reimbursh_list->jumlah_dibayar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$reimbursh_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($reimbursh_list->ExportAll && $reimbursh_list->isExport()) {
	$reimbursh_list->StopRecord = $reimbursh_list->TotalRecords;
} else {

	// Set the last record to display
	if ($reimbursh_list->TotalRecords > $reimbursh_list->StartRecord + $reimbursh_list->DisplayRecords - 1)
		$reimbursh_list->StopRecord = $reimbursh_list->StartRecord + $reimbursh_list->DisplayRecords - 1;
	else
		$reimbursh_list->StopRecord = $reimbursh_list->TotalRecords;
}
$reimbursh_list->RecordCount = $reimbursh_list->StartRecord - 1;
if ($reimbursh_list->Recordset && !$reimbursh_list->Recordset->EOF) {
	$reimbursh_list->Recordset->moveFirst();
	$selectLimit = $reimbursh_list->UseSelectLimit;
	if (!$selectLimit && $reimbursh_list->StartRecord > 1)
		$reimbursh_list->Recordset->move($reimbursh_list->StartRecord - 1);
} elseif (!$reimbursh->AllowAddDeleteRow && $reimbursh_list->StopRecord == 0) {
	$reimbursh_list->StopRecord = $reimbursh->GridAddRowCount;
}

// Initialize aggregate
$reimbursh->RowType = ROWTYPE_AGGREGATEINIT;
$reimbursh->resetAttributes();
$reimbursh_list->renderRow();
while ($reimbursh_list->RecordCount < $reimbursh_list->StopRecord) {
	$reimbursh_list->RecordCount++;
	if ($reimbursh_list->RecordCount >= $reimbursh_list->StartRecord) {
		$reimbursh_list->RowCount++;

		// Set up key count
		$reimbursh_list->KeyCount = $reimbursh_list->RowIndex;

		// Init row class and style
		$reimbursh->resetAttributes();
		$reimbursh->CssClass = "";
		if ($reimbursh_list->isGridAdd()) {
		} else {
			$reimbursh_list->loadRowValues($reimbursh_list->Recordset); // Load row values
		}
		$reimbursh->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$reimbursh->RowAttrs->merge(["data-rowindex" => $reimbursh_list->RowCount, "id" => "r" . $reimbursh_list->RowCount . "_reimbursh", "data-rowtype" => $reimbursh->RowType]);

		// Render row
		$reimbursh_list->renderRow();

		// Render list options
		$reimbursh_list->renderListOptions();
?>
	<tr <?php echo $reimbursh->rowAttributes() ?>>
<?php

// Render list options (body, left)
$reimbursh_list->ListOptions->render("body", "left", $reimbursh_list->RowCount);
?>
	<?php if ($reimbursh_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $reimbursh_list->id->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_id">
<span<?php echo $reimbursh_list->id->viewAttributes() ?>><?php echo $reimbursh_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $reimbursh_list->pegawai->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_pegawai">
<span<?php echo $reimbursh_list->pegawai->viewAttributes() ?>><?php echo $reimbursh_list->pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $reimbursh_list->nama->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_nama">
<span<?php echo $reimbursh_list->nama->viewAttributes() ?>><?php echo $reimbursh_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $reimbursh_list->tgl->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_tgl">
<span<?php echo $reimbursh_list->tgl->viewAttributes() ?>><?php echo $reimbursh_list->tgl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->total_pengajuan->Visible) { // total_pengajuan ?>
		<td data-name="total_pengajuan" <?php echo $reimbursh_list->total_pengajuan->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_total_pengajuan">
<span<?php echo $reimbursh_list->total_pengajuan->viewAttributes() ?>><?php echo $reimbursh_list->total_pengajuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->tgl_pengajuan->Visible) { // tgl_pengajuan ?>
		<td data-name="tgl_pengajuan" <?php echo $reimbursh_list->tgl_pengajuan->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_tgl_pengajuan">
<span<?php echo $reimbursh_list->tgl_pengajuan->viewAttributes() ?>><?php echo $reimbursh_list->tgl_pengajuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->jenis->Visible) { // jenis ?>
		<td data-name="jenis" <?php echo $reimbursh_list->jenis->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_jenis">
<span<?php echo $reimbursh_list->jenis->viewAttributes() ?>><?php echo $reimbursh_list->jenis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->rek_tujuan->Visible) { // rek_tujuan ?>
		<td data-name="rek_tujuan" <?php echo $reimbursh_list->rek_tujuan->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_rek_tujuan">
<span<?php echo $reimbursh_list->rek_tujuan->viewAttributes() ?>><?php echo $reimbursh_list->rek_tujuan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->bukti1->Visible) { // bukti1 ?>
		<td data-name="bukti1" <?php echo $reimbursh_list->bukti1->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_bukti1">
<span<?php echo $reimbursh_list->bukti1->viewAttributes() ?>><?php echo $reimbursh_list->bukti1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->bukti2->Visible) { // bukti2 ?>
		<td data-name="bukti2" <?php echo $reimbursh_list->bukti2->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_bukti2">
<span<?php echo $reimbursh_list->bukti2->viewAttributes() ?>><?php echo $reimbursh_list->bukti2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->bukti3->Visible) { // bukti3 ?>
		<td data-name="bukti3" <?php echo $reimbursh_list->bukti3->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_bukti3">
<span<?php echo $reimbursh_list->bukti3->viewAttributes() ?>><?php echo $reimbursh_list->bukti3->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->bukti4->Visible) { // bukti4 ?>
		<td data-name="bukti4" <?php echo $reimbursh_list->bukti4->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_bukti4">
<span<?php echo $reimbursh_list->bukti4->viewAttributes() ?>><?php echo $reimbursh_list->bukti4->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->disetujui->Visible) { // disetujui ?>
		<td data-name="disetujui" <?php echo $reimbursh_list->disetujui->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_disetujui">
<span<?php echo $reimbursh_list->disetujui->viewAttributes() ?>><?php echo $reimbursh_list->disetujui->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->pembayar->Visible) { // pembayar ?>
		<td data-name="pembayar" <?php echo $reimbursh_list->pembayar->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_pembayar">
<span<?php echo $reimbursh_list->pembayar->viewAttributes() ?>><?php echo $reimbursh_list->pembayar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->terbayar->Visible) { // terbayar ?>
		<td data-name="terbayar" <?php echo $reimbursh_list->terbayar->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_terbayar">
<span<?php echo $reimbursh_list->terbayar->viewAttributes() ?>><?php echo $reimbursh_list->terbayar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->tgl_pembayaran->Visible) { // tgl_pembayaran ?>
		<td data-name="tgl_pembayaran" <?php echo $reimbursh_list->tgl_pembayaran->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_tgl_pembayaran">
<span<?php echo $reimbursh_list->tgl_pembayaran->viewAttributes() ?>><?php echo $reimbursh_list->tgl_pembayaran->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($reimbursh_list->jumlah_dibayar->Visible) { // jumlah_dibayar ?>
		<td data-name="jumlah_dibayar" <?php echo $reimbursh_list->jumlah_dibayar->cellAttributes() ?>>
<span id="el<?php echo $reimbursh_list->RowCount ?>_reimbursh_jumlah_dibayar">
<span<?php echo $reimbursh_list->jumlah_dibayar->viewAttributes() ?>><?php echo $reimbursh_list->jumlah_dibayar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$reimbursh_list->ListOptions->render("body", "right", $reimbursh_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$reimbursh_list->isGridAdd())
		$reimbursh_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$reimbursh->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($reimbursh_list->Recordset)
	$reimbursh_list->Recordset->Close();
?>
<?php if (!$reimbursh_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$reimbursh_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $reimbursh_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $reimbursh_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($reimbursh_list->TotalRecords == 0 && !$reimbursh->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $reimbursh_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$reimbursh_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$reimbursh_list->isExport()) { ?>
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
$reimbursh_list->terminate();
?>