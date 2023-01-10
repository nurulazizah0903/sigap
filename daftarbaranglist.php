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
$daftarbarang_list = new daftarbarang_list();

// Run the page
$daftarbarang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$daftarbarang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$daftarbarang_list->isExport()) { ?>
<script>
var fdaftarbaranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdaftarbaranglist = currentForm = new ew.Form("fdaftarbaranglist", "list");
	fdaftarbaranglist.formKeyCountName = '<?php echo $daftarbarang_list->FormKeyCountName ?>';
	loadjs.done("fdaftarbaranglist");
});
var fdaftarbaranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdaftarbaranglistsrch = currentSearchForm = new ew.Form("fdaftarbaranglistsrch");

	// Dynamic selection lists
	// Filters

	fdaftarbaranglistsrch.filterList = <?php echo $daftarbarang_list->getFilterList() ?>;
	loadjs.done("fdaftarbaranglistsrch");
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
<?php if (!$daftarbarang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($daftarbarang_list->TotalRecords > 0 && $daftarbarang_list->ExportOptions->visible()) { ?>
<?php $daftarbarang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($daftarbarang_list->ImportOptions->visible()) { ?>
<?php $daftarbarang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($daftarbarang_list->SearchOptions->visible()) { ?>
<?php $daftarbarang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($daftarbarang_list->FilterOptions->visible()) { ?>
<?php $daftarbarang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$daftarbarang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$daftarbarang_list->isExport() && !$daftarbarang->CurrentAction) { ?>
<form name="fdaftarbaranglistsrch" id="fdaftarbaranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdaftarbaranglistsrch-search-panel" class="<?php echo $daftarbarang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="daftarbarang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $daftarbarang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($daftarbarang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($daftarbarang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $daftarbarang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($daftarbarang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($daftarbarang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($daftarbarang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($daftarbarang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $daftarbarang_list->showPageHeader(); ?>
<?php
$daftarbarang_list->showMessage();
?>
<?php if ($daftarbarang_list->TotalRecords > 0 || $daftarbarang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($daftarbarang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> daftarbarang">
<?php if (!$daftarbarang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$daftarbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $daftarbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $daftarbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdaftarbaranglist" id="fdaftarbaranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="daftarbarang">
<div id="gmp_daftarbarang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($daftarbarang_list->TotalRecords > 0 || $daftarbarang_list->isGridEdit()) { ?>
<table id="tbl_daftarbaranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$daftarbarang->RowType = ROWTYPE_HEADER;

// Render list options
$daftarbarang_list->renderListOptions();

// Render list options (header, left)
$daftarbarang_list->ListOptions->render("header", "left");
?>
<?php if ($daftarbarang_list->id->Visible) { // id ?>
	<?php if ($daftarbarang_list->SortUrl($daftarbarang_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $daftarbarang_list->id->headerCellClass() ?>"><div id="elh_daftarbarang_id" class="daftarbarang_id"><div class="ew-table-header-caption"><?php echo $daftarbarang_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $daftarbarang_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $daftarbarang_list->SortUrl($daftarbarang_list->id) ?>', 1);"><div id="elh_daftarbarang_id" class="daftarbarang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $daftarbarang_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($daftarbarang_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($daftarbarang_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($daftarbarang_list->pemegang->Visible) { // pemegang ?>
	<?php if ($daftarbarang_list->SortUrl($daftarbarang_list->pemegang) == "") { ?>
		<th data-name="pemegang" class="<?php echo $daftarbarang_list->pemegang->headerCellClass() ?>"><div id="elh_daftarbarang_pemegang" class="daftarbarang_pemegang"><div class="ew-table-header-caption"><?php echo $daftarbarang_list->pemegang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pemegang" class="<?php echo $daftarbarang_list->pemegang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $daftarbarang_list->SortUrl($daftarbarang_list->pemegang) ?>', 1);"><div id="elh_daftarbarang_pemegang" class="daftarbarang_pemegang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $daftarbarang_list->pemegang->caption() ?></span><span class="ew-table-header-sort"><?php if ($daftarbarang_list->pemegang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($daftarbarang_list->pemegang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($daftarbarang_list->nama->Visible) { // nama ?>
	<?php if ($daftarbarang_list->SortUrl($daftarbarang_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $daftarbarang_list->nama->headerCellClass() ?>"><div id="elh_daftarbarang_nama" class="daftarbarang_nama"><div class="ew-table-header-caption"><?php echo $daftarbarang_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $daftarbarang_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $daftarbarang_list->SortUrl($daftarbarang_list->nama) ?>', 1);"><div id="elh_daftarbarang_nama" class="daftarbarang_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $daftarbarang_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($daftarbarang_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($daftarbarang_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($daftarbarang_list->jenis->Visible) { // jenis ?>
	<?php if ($daftarbarang_list->SortUrl($daftarbarang_list->jenis) == "") { ?>
		<th data-name="jenis" class="<?php echo $daftarbarang_list->jenis->headerCellClass() ?>"><div id="elh_daftarbarang_jenis" class="daftarbarang_jenis"><div class="ew-table-header-caption"><?php echo $daftarbarang_list->jenis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis" class="<?php echo $daftarbarang_list->jenis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $daftarbarang_list->SortUrl($daftarbarang_list->jenis) ?>', 1);"><div id="elh_daftarbarang_jenis" class="daftarbarang_jenis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $daftarbarang_list->jenis->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($daftarbarang_list->jenis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($daftarbarang_list->jenis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($daftarbarang_list->sepsifikasi->Visible) { // sepsifikasi ?>
	<?php if ($daftarbarang_list->SortUrl($daftarbarang_list->sepsifikasi) == "") { ?>
		<th data-name="sepsifikasi" class="<?php echo $daftarbarang_list->sepsifikasi->headerCellClass() ?>"><div id="elh_daftarbarang_sepsifikasi" class="daftarbarang_sepsifikasi"><div class="ew-table-header-caption"><?php echo $daftarbarang_list->sepsifikasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sepsifikasi" class="<?php echo $daftarbarang_list->sepsifikasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $daftarbarang_list->SortUrl($daftarbarang_list->sepsifikasi) ?>', 1);"><div id="elh_daftarbarang_sepsifikasi" class="daftarbarang_sepsifikasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $daftarbarang_list->sepsifikasi->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($daftarbarang_list->sepsifikasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($daftarbarang_list->sepsifikasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($daftarbarang_list->tgl_terima->Visible) { // tgl_terima ?>
	<?php if ($daftarbarang_list->SortUrl($daftarbarang_list->tgl_terima) == "") { ?>
		<th data-name="tgl_terima" class="<?php echo $daftarbarang_list->tgl_terima->headerCellClass() ?>"><div id="elh_daftarbarang_tgl_terima" class="daftarbarang_tgl_terima"><div class="ew-table-header-caption"><?php echo $daftarbarang_list->tgl_terima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_terima" class="<?php echo $daftarbarang_list->tgl_terima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $daftarbarang_list->SortUrl($daftarbarang_list->tgl_terima) ?>', 1);"><div id="elh_daftarbarang_tgl_terima" class="daftarbarang_tgl_terima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $daftarbarang_list->tgl_terima->caption() ?></span><span class="ew-table-header-sort"><?php if ($daftarbarang_list->tgl_terima->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($daftarbarang_list->tgl_terima->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($daftarbarang_list->tgl_beli->Visible) { // tgl_beli ?>
	<?php if ($daftarbarang_list->SortUrl($daftarbarang_list->tgl_beli) == "") { ?>
		<th data-name="tgl_beli" class="<?php echo $daftarbarang_list->tgl_beli->headerCellClass() ?>"><div id="elh_daftarbarang_tgl_beli" class="daftarbarang_tgl_beli"><div class="ew-table-header-caption"><?php echo $daftarbarang_list->tgl_beli->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_beli" class="<?php echo $daftarbarang_list->tgl_beli->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $daftarbarang_list->SortUrl($daftarbarang_list->tgl_beli) ?>', 1);"><div id="elh_daftarbarang_tgl_beli" class="daftarbarang_tgl_beli">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $daftarbarang_list->tgl_beli->caption() ?></span><span class="ew-table-header-sort"><?php if ($daftarbarang_list->tgl_beli->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($daftarbarang_list->tgl_beli->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($daftarbarang_list->harga->Visible) { // harga ?>
	<?php if ($daftarbarang_list->SortUrl($daftarbarang_list->harga) == "") { ?>
		<th data-name="harga" class="<?php echo $daftarbarang_list->harga->headerCellClass() ?>"><div id="elh_daftarbarang_harga" class="daftarbarang_harga"><div class="ew-table-header-caption"><?php echo $daftarbarang_list->harga->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="harga" class="<?php echo $daftarbarang_list->harga->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $daftarbarang_list->SortUrl($daftarbarang_list->harga) ?>', 1);"><div id="elh_daftarbarang_harga" class="daftarbarang_harga">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $daftarbarang_list->harga->caption() ?></span><span class="ew-table-header-sort"><?php if ($daftarbarang_list->harga->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($daftarbarang_list->harga->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($daftarbarang_list->dokumen->Visible) { // dokumen ?>
	<?php if ($daftarbarang_list->SortUrl($daftarbarang_list->dokumen) == "") { ?>
		<th data-name="dokumen" class="<?php echo $daftarbarang_list->dokumen->headerCellClass() ?>"><div id="elh_daftarbarang_dokumen" class="daftarbarang_dokumen"><div class="ew-table-header-caption"><?php echo $daftarbarang_list->dokumen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dokumen" class="<?php echo $daftarbarang_list->dokumen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $daftarbarang_list->SortUrl($daftarbarang_list->dokumen) ?>', 1);"><div id="elh_daftarbarang_dokumen" class="daftarbarang_dokumen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $daftarbarang_list->dokumen->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($daftarbarang_list->dokumen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($daftarbarang_list->dokumen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($daftarbarang_list->foto->Visible) { // foto ?>
	<?php if ($daftarbarang_list->SortUrl($daftarbarang_list->foto) == "") { ?>
		<th data-name="foto" class="<?php echo $daftarbarang_list->foto->headerCellClass() ?>"><div id="elh_daftarbarang_foto" class="daftarbarang_foto"><div class="ew-table-header-caption"><?php echo $daftarbarang_list->foto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="foto" class="<?php echo $daftarbarang_list->foto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $daftarbarang_list->SortUrl($daftarbarang_list->foto) ?>', 1);"><div id="elh_daftarbarang_foto" class="daftarbarang_foto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $daftarbarang_list->foto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($daftarbarang_list->foto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($daftarbarang_list->foto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($daftarbarang_list->keterangan->Visible) { // keterangan ?>
	<?php if ($daftarbarang_list->SortUrl($daftarbarang_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $daftarbarang_list->keterangan->headerCellClass() ?>"><div id="elh_daftarbarang_keterangan" class="daftarbarang_keterangan"><div class="ew-table-header-caption"><?php echo $daftarbarang_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $daftarbarang_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $daftarbarang_list->SortUrl($daftarbarang_list->keterangan) ?>', 1);"><div id="elh_daftarbarang_keterangan" class="daftarbarang_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $daftarbarang_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($daftarbarang_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($daftarbarang_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($daftarbarang_list->deskripsi->Visible) { // deskripsi ?>
	<?php if ($daftarbarang_list->SortUrl($daftarbarang_list->deskripsi) == "") { ?>
		<th data-name="deskripsi" class="<?php echo $daftarbarang_list->deskripsi->headerCellClass() ?>"><div id="elh_daftarbarang_deskripsi" class="daftarbarang_deskripsi"><div class="ew-table-header-caption"><?php echo $daftarbarang_list->deskripsi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="deskripsi" class="<?php echo $daftarbarang_list->deskripsi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $daftarbarang_list->SortUrl($daftarbarang_list->deskripsi) ?>', 1);"><div id="elh_daftarbarang_deskripsi" class="daftarbarang_deskripsi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $daftarbarang_list->deskripsi->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($daftarbarang_list->deskripsi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($daftarbarang_list->deskripsi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($daftarbarang_list->status->Visible) { // status ?>
	<?php if ($daftarbarang_list->SortUrl($daftarbarang_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $daftarbarang_list->status->headerCellClass() ?>"><div id="elh_daftarbarang_status" class="daftarbarang_status"><div class="ew-table-header-caption"><?php echo $daftarbarang_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $daftarbarang_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $daftarbarang_list->SortUrl($daftarbarang_list->status) ?>', 1);"><div id="elh_daftarbarang_status" class="daftarbarang_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $daftarbarang_list->status->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($daftarbarang_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($daftarbarang_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$daftarbarang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($daftarbarang_list->ExportAll && $daftarbarang_list->isExport()) {
	$daftarbarang_list->StopRecord = $daftarbarang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($daftarbarang_list->TotalRecords > $daftarbarang_list->StartRecord + $daftarbarang_list->DisplayRecords - 1)
		$daftarbarang_list->StopRecord = $daftarbarang_list->StartRecord + $daftarbarang_list->DisplayRecords - 1;
	else
		$daftarbarang_list->StopRecord = $daftarbarang_list->TotalRecords;
}
$daftarbarang_list->RecordCount = $daftarbarang_list->StartRecord - 1;
if ($daftarbarang_list->Recordset && !$daftarbarang_list->Recordset->EOF) {
	$daftarbarang_list->Recordset->moveFirst();
	$selectLimit = $daftarbarang_list->UseSelectLimit;
	if (!$selectLimit && $daftarbarang_list->StartRecord > 1)
		$daftarbarang_list->Recordset->move($daftarbarang_list->StartRecord - 1);
} elseif (!$daftarbarang->AllowAddDeleteRow && $daftarbarang_list->StopRecord == 0) {
	$daftarbarang_list->StopRecord = $daftarbarang->GridAddRowCount;
}

// Initialize aggregate
$daftarbarang->RowType = ROWTYPE_AGGREGATEINIT;
$daftarbarang->resetAttributes();
$daftarbarang_list->renderRow();
while ($daftarbarang_list->RecordCount < $daftarbarang_list->StopRecord) {
	$daftarbarang_list->RecordCount++;
	if ($daftarbarang_list->RecordCount >= $daftarbarang_list->StartRecord) {
		$daftarbarang_list->RowCount++;

		// Set up key count
		$daftarbarang_list->KeyCount = $daftarbarang_list->RowIndex;

		// Init row class and style
		$daftarbarang->resetAttributes();
		$daftarbarang->CssClass = "";
		if ($daftarbarang_list->isGridAdd()) {
		} else {
			$daftarbarang_list->loadRowValues($daftarbarang_list->Recordset); // Load row values
		}
		$daftarbarang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$daftarbarang->RowAttrs->merge(["data-rowindex" => $daftarbarang_list->RowCount, "id" => "r" . $daftarbarang_list->RowCount . "_daftarbarang", "data-rowtype" => $daftarbarang->RowType]);

		// Render row
		$daftarbarang_list->renderRow();

		// Render list options
		$daftarbarang_list->renderListOptions();
?>
	<tr <?php echo $daftarbarang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$daftarbarang_list->ListOptions->render("body", "left", $daftarbarang_list->RowCount);
?>
	<?php if ($daftarbarang_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $daftarbarang_list->id->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_list->RowCount ?>_daftarbarang_id">
<span<?php echo $daftarbarang_list->id->viewAttributes() ?>><?php echo $daftarbarang_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($daftarbarang_list->pemegang->Visible) { // pemegang ?>
		<td data-name="pemegang" <?php echo $daftarbarang_list->pemegang->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_list->RowCount ?>_daftarbarang_pemegang">
<span<?php echo $daftarbarang_list->pemegang->viewAttributes() ?>><?php echo $daftarbarang_list->pemegang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($daftarbarang_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $daftarbarang_list->nama->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_list->RowCount ?>_daftarbarang_nama">
<span<?php echo $daftarbarang_list->nama->viewAttributes() ?>><?php echo $daftarbarang_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($daftarbarang_list->jenis->Visible) { // jenis ?>
		<td data-name="jenis" <?php echo $daftarbarang_list->jenis->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_list->RowCount ?>_daftarbarang_jenis">
<span<?php echo $daftarbarang_list->jenis->viewAttributes() ?>><?php echo $daftarbarang_list->jenis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($daftarbarang_list->sepsifikasi->Visible) { // sepsifikasi ?>
		<td data-name="sepsifikasi" <?php echo $daftarbarang_list->sepsifikasi->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_list->RowCount ?>_daftarbarang_sepsifikasi">
<span<?php echo $daftarbarang_list->sepsifikasi->viewAttributes() ?>><?php echo $daftarbarang_list->sepsifikasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($daftarbarang_list->tgl_terima->Visible) { // tgl_terima ?>
		<td data-name="tgl_terima" <?php echo $daftarbarang_list->tgl_terima->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_list->RowCount ?>_daftarbarang_tgl_terima">
<span<?php echo $daftarbarang_list->tgl_terima->viewAttributes() ?>><?php echo $daftarbarang_list->tgl_terima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($daftarbarang_list->tgl_beli->Visible) { // tgl_beli ?>
		<td data-name="tgl_beli" <?php echo $daftarbarang_list->tgl_beli->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_list->RowCount ?>_daftarbarang_tgl_beli">
<span<?php echo $daftarbarang_list->tgl_beli->viewAttributes() ?>><?php echo $daftarbarang_list->tgl_beli->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($daftarbarang_list->harga->Visible) { // harga ?>
		<td data-name="harga" <?php echo $daftarbarang_list->harga->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_list->RowCount ?>_daftarbarang_harga">
<span<?php echo $daftarbarang_list->harga->viewAttributes() ?>><?php echo $daftarbarang_list->harga->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($daftarbarang_list->dokumen->Visible) { // dokumen ?>
		<td data-name="dokumen" <?php echo $daftarbarang_list->dokumen->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_list->RowCount ?>_daftarbarang_dokumen">
<span<?php echo $daftarbarang_list->dokumen->viewAttributes() ?>><?php echo GetFileViewTag($daftarbarang_list->dokumen, $daftarbarang_list->dokumen->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($daftarbarang_list->foto->Visible) { // foto ?>
		<td data-name="foto" <?php echo $daftarbarang_list->foto->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_list->RowCount ?>_daftarbarang_foto">
<span<?php echo $daftarbarang_list->foto->viewAttributes() ?>><?php echo GetFileViewTag($daftarbarang_list->foto, $daftarbarang_list->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($daftarbarang_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $daftarbarang_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_list->RowCount ?>_daftarbarang_keterangan">
<span<?php echo $daftarbarang_list->keterangan->viewAttributes() ?>><?php echo $daftarbarang_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($daftarbarang_list->deskripsi->Visible) { // deskripsi ?>
		<td data-name="deskripsi" <?php echo $daftarbarang_list->deskripsi->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_list->RowCount ?>_daftarbarang_deskripsi">
<span<?php echo $daftarbarang_list->deskripsi->viewAttributes() ?>><?php echo $daftarbarang_list->deskripsi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($daftarbarang_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $daftarbarang_list->status->cellAttributes() ?>>
<span id="el<?php echo $daftarbarang_list->RowCount ?>_daftarbarang_status">
<span<?php echo $daftarbarang_list->status->viewAttributes() ?>><?php echo $daftarbarang_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$daftarbarang_list->ListOptions->render("body", "right", $daftarbarang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$daftarbarang_list->isGridAdd())
		$daftarbarang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$daftarbarang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($daftarbarang_list->Recordset)
	$daftarbarang_list->Recordset->Close();
?>
<?php if (!$daftarbarang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$daftarbarang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $daftarbarang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $daftarbarang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($daftarbarang_list->TotalRecords == 0 && !$daftarbarang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $daftarbarang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$daftarbarang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$daftarbarang_list->isExport()) { ?>
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
$daftarbarang_list->terminate();
?>