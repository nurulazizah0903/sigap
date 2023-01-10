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
$uangmuka_list = new uangmuka_list();

// Run the page
$uangmuka_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$uangmuka_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$uangmuka_list->isExport()) { ?>
<script>
var fuangmukalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fuangmukalist = currentForm = new ew.Form("fuangmukalist", "list");
	fuangmukalist.formKeyCountName = '<?php echo $uangmuka_list->FormKeyCountName ?>';
	loadjs.done("fuangmukalist");
});
var fuangmukalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fuangmukalistsrch = currentSearchForm = new ew.Form("fuangmukalistsrch");

	// Dynamic selection lists
	// Filters

	fuangmukalistsrch.filterList = <?php echo $uangmuka_list->getFilterList() ?>;
	loadjs.done("fuangmukalistsrch");
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
<?php if (!$uangmuka_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($uangmuka_list->TotalRecords > 0 && $uangmuka_list->ExportOptions->visible()) { ?>
<?php $uangmuka_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($uangmuka_list->ImportOptions->visible()) { ?>
<?php $uangmuka_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($uangmuka_list->SearchOptions->visible()) { ?>
<?php $uangmuka_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($uangmuka_list->FilterOptions->visible()) { ?>
<?php $uangmuka_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$uangmuka_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$uangmuka_list->isExport() && !$uangmuka->CurrentAction) { ?>
<form name="fuangmukalistsrch" id="fuangmukalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fuangmukalistsrch-search-panel" class="<?php echo $uangmuka_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="uangmuka">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $uangmuka_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($uangmuka_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($uangmuka_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $uangmuka_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($uangmuka_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($uangmuka_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($uangmuka_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($uangmuka_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $uangmuka_list->showPageHeader(); ?>
<?php
$uangmuka_list->showMessage();
?>
<?php if ($uangmuka_list->TotalRecords > 0 || $uangmuka->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($uangmuka_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> uangmuka">
<?php if (!$uangmuka_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$uangmuka_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $uangmuka_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $uangmuka_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fuangmukalist" id="fuangmukalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="uangmuka">
<div id="gmp_uangmuka" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($uangmuka_list->TotalRecords > 0 || $uangmuka_list->isGridEdit()) { ?>
<table id="tbl_uangmukalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$uangmuka->RowType = ROWTYPE_HEADER;

// Render list options
$uangmuka_list->renderListOptions();

// Render list options (header, left)
$uangmuka_list->ListOptions->render("header", "left");
?>
<?php if ($uangmuka_list->id->Visible) { // id ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $uangmuka_list->id->headerCellClass() ?>"><div id="elh_uangmuka_id" class="uangmuka_id"><div class="ew-table-header-caption"><?php echo $uangmuka_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $uangmuka_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->id) ?>', 1);"><div id="elh_uangmuka_id" class="uangmuka_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->tgl->Visible) { // tgl ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->tgl) == "") { ?>
		<th data-name="tgl" class="<?php echo $uangmuka_list->tgl->headerCellClass() ?>"><div id="elh_uangmuka_tgl" class="uangmuka_tgl"><div class="ew-table-header-caption"><?php echo $uangmuka_list->tgl->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl" class="<?php echo $uangmuka_list->tgl->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->tgl) ?>', 1);"><div id="elh_uangmuka_tgl" class="uangmuka_tgl">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->tgl->caption() ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->tgl->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->tgl->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->pembayar->Visible) { // pembayar ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->pembayar) == "") { ?>
		<th data-name="pembayar" class="<?php echo $uangmuka_list->pembayar->headerCellClass() ?>"><div id="elh_uangmuka_pembayar" class="uangmuka_pembayar"><div class="ew-table-header-caption"><?php echo $uangmuka_list->pembayar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pembayar" class="<?php echo $uangmuka_list->pembayar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->pembayar) ?>', 1);"><div id="elh_uangmuka_pembayar" class="uangmuka_pembayar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->pembayar->caption() ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->pembayar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->pembayar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->peruntukan->Visible) { // peruntukan ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->peruntukan) == "") { ?>
		<th data-name="peruntukan" class="<?php echo $uangmuka_list->peruntukan->headerCellClass() ?>"><div id="elh_uangmuka_peruntukan" class="uangmuka_peruntukan"><div class="ew-table-header-caption"><?php echo $uangmuka_list->peruntukan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="peruntukan" class="<?php echo $uangmuka_list->peruntukan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->peruntukan) ?>', 1);"><div id="elh_uangmuka_peruntukan" class="uangmuka_peruntukan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->peruntukan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->peruntukan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->peruntukan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->penerima->Visible) { // penerima ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->penerima) == "") { ?>
		<th data-name="penerima" class="<?php echo $uangmuka_list->penerima->headerCellClass() ?>"><div id="elh_uangmuka_penerima" class="uangmuka_penerima"><div class="ew-table-header-caption"><?php echo $uangmuka_list->penerima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="penerima" class="<?php echo $uangmuka_list->penerima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->penerima) ?>', 1);"><div id="elh_uangmuka_penerima" class="uangmuka_penerima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->penerima->caption() ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->penerima->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->penerima->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->rek_penerima->Visible) { // rek_penerima ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->rek_penerima) == "") { ?>
		<th data-name="rek_penerima" class="<?php echo $uangmuka_list->rek_penerima->headerCellClass() ?>"><div id="elh_uangmuka_rek_penerima" class="uangmuka_rek_penerima"><div class="ew-table-header-caption"><?php echo $uangmuka_list->rek_penerima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rek_penerima" class="<?php echo $uangmuka_list->rek_penerima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->rek_penerima) ?>', 1);"><div id="elh_uangmuka_rek_penerima" class="uangmuka_rek_penerima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->rek_penerima->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->rek_penerima->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->rek_penerima->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->tgl_terima->Visible) { // tgl_terima ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->tgl_terima) == "") { ?>
		<th data-name="tgl_terima" class="<?php echo $uangmuka_list->tgl_terima->headerCellClass() ?>"><div id="elh_uangmuka_tgl_terima" class="uangmuka_tgl_terima"><div class="ew-table-header-caption"><?php echo $uangmuka_list->tgl_terima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_terima" class="<?php echo $uangmuka_list->tgl_terima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->tgl_terima) ?>', 1);"><div id="elh_uangmuka_tgl_terima" class="uangmuka_tgl_terima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->tgl_terima->caption() ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->tgl_terima->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->tgl_terima->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->total_terima->Visible) { // total_terima ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->total_terima) == "") { ?>
		<th data-name="total_terima" class="<?php echo $uangmuka_list->total_terima->headerCellClass() ?>"><div id="elh_uangmuka_total_terima" class="uangmuka_total_terima"><div class="ew-table-header-caption"><?php echo $uangmuka_list->total_terima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_terima" class="<?php echo $uangmuka_list->total_terima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->total_terima) ?>', 1);"><div id="elh_uangmuka_total_terima" class="uangmuka_total_terima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->total_terima->caption() ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->total_terima->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->total_terima->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->tgl_tgjb->Visible) { // tgl_tgjb ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->tgl_tgjb) == "") { ?>
		<th data-name="tgl_tgjb" class="<?php echo $uangmuka_list->tgl_tgjb->headerCellClass() ?>"><div id="elh_uangmuka_tgl_tgjb" class="uangmuka_tgl_tgjb"><div class="ew-table-header-caption"><?php echo $uangmuka_list->tgl_tgjb->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_tgjb" class="<?php echo $uangmuka_list->tgl_tgjb->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->tgl_tgjb) ?>', 1);"><div id="elh_uangmuka_tgl_tgjb" class="uangmuka_tgl_tgjb">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->tgl_tgjb->caption() ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->tgl_tgjb->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->tgl_tgjb->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->jumlah_tgjb->Visible) { // jumlah_tgjb ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->jumlah_tgjb) == "") { ?>
		<th data-name="jumlah_tgjb" class="<?php echo $uangmuka_list->jumlah_tgjb->headerCellClass() ?>"><div id="elh_uangmuka_jumlah_tgjb" class="uangmuka_jumlah_tgjb"><div class="ew-table-header-caption"><?php echo $uangmuka_list->jumlah_tgjb->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah_tgjb" class="<?php echo $uangmuka_list->jumlah_tgjb->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->jumlah_tgjb) ?>', 1);"><div id="elh_uangmuka_jumlah_tgjb" class="uangmuka_jumlah_tgjb">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->jumlah_tgjb->caption() ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->jumlah_tgjb->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->jumlah_tgjb->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->jenis->Visible) { // jenis ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->jenis) == "") { ?>
		<th data-name="jenis" class="<?php echo $uangmuka_list->jenis->headerCellClass() ?>"><div id="elh_uangmuka_jenis" class="uangmuka_jenis"><div class="ew-table-header-caption"><?php echo $uangmuka_list->jenis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis" class="<?php echo $uangmuka_list->jenis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->jenis) ?>', 1);"><div id="elh_uangmuka_jenis" class="uangmuka_jenis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->jenis->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->jenis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->jenis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->bukti1->Visible) { // bukti1 ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->bukti1) == "") { ?>
		<th data-name="bukti1" class="<?php echo $uangmuka_list->bukti1->headerCellClass() ?>"><div id="elh_uangmuka_bukti1" class="uangmuka_bukti1"><div class="ew-table-header-caption"><?php echo $uangmuka_list->bukti1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bukti1" class="<?php echo $uangmuka_list->bukti1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->bukti1) ?>', 1);"><div id="elh_uangmuka_bukti1" class="uangmuka_bukti1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->bukti1->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->bukti1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->bukti1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->bukti2->Visible) { // bukti2 ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->bukti2) == "") { ?>
		<th data-name="bukti2" class="<?php echo $uangmuka_list->bukti2->headerCellClass() ?>"><div id="elh_uangmuka_bukti2" class="uangmuka_bukti2"><div class="ew-table-header-caption"><?php echo $uangmuka_list->bukti2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bukti2" class="<?php echo $uangmuka_list->bukti2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->bukti2) ?>', 1);"><div id="elh_uangmuka_bukti2" class="uangmuka_bukti2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->bukti2->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->bukti2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->bukti2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->bukti3->Visible) { // bukti3 ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->bukti3) == "") { ?>
		<th data-name="bukti3" class="<?php echo $uangmuka_list->bukti3->headerCellClass() ?>"><div id="elh_uangmuka_bukti3" class="uangmuka_bukti3"><div class="ew-table-header-caption"><?php echo $uangmuka_list->bukti3->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bukti3" class="<?php echo $uangmuka_list->bukti3->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->bukti3) ?>', 1);"><div id="elh_uangmuka_bukti3" class="uangmuka_bukti3">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->bukti3->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->bukti3->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->bukti3->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->bukti4->Visible) { // bukti4 ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->bukti4) == "") { ?>
		<th data-name="bukti4" class="<?php echo $uangmuka_list->bukti4->headerCellClass() ?>"><div id="elh_uangmuka_bukti4" class="uangmuka_bukti4"><div class="ew-table-header-caption"><?php echo $uangmuka_list->bukti4->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bukti4" class="<?php echo $uangmuka_list->bukti4->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->bukti4) ?>', 1);"><div id="elh_uangmuka_bukti4" class="uangmuka_bukti4">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->bukti4->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->bukti4->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->bukti4->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->disetujui->Visible) { // disetujui ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->disetujui) == "") { ?>
		<th data-name="disetujui" class="<?php echo $uangmuka_list->disetujui->headerCellClass() ?>"><div id="elh_uangmuka_disetujui" class="uangmuka_disetujui"><div class="ew-table-header-caption"><?php echo $uangmuka_list->disetujui->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="disetujui" class="<?php echo $uangmuka_list->disetujui->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->disetujui) ?>', 1);"><div id="elh_uangmuka_disetujui" class="uangmuka_disetujui">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->disetujui->caption() ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->disetujui->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->disetujui->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->status->Visible) { // status ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $uangmuka_list->status->headerCellClass() ?>"><div id="elh_uangmuka_status" class="uangmuka_status"><div class="ew-table-header-caption"><?php echo $uangmuka_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $uangmuka_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->status) ?>', 1);"><div id="elh_uangmuka_status" class="uangmuka_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->status->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($uangmuka_list->keterangan->Visible) { // keterangan ?>
	<?php if ($uangmuka_list->SortUrl($uangmuka_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $uangmuka_list->keterangan->headerCellClass() ?>"><div id="elh_uangmuka_keterangan" class="uangmuka_keterangan"><div class="ew-table-header-caption"><?php echo $uangmuka_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $uangmuka_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $uangmuka_list->SortUrl($uangmuka_list->keterangan) ?>', 1);"><div id="elh_uangmuka_keterangan" class="uangmuka_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $uangmuka_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($uangmuka_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($uangmuka_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$uangmuka_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($uangmuka_list->ExportAll && $uangmuka_list->isExport()) {
	$uangmuka_list->StopRecord = $uangmuka_list->TotalRecords;
} else {

	// Set the last record to display
	if ($uangmuka_list->TotalRecords > $uangmuka_list->StartRecord + $uangmuka_list->DisplayRecords - 1)
		$uangmuka_list->StopRecord = $uangmuka_list->StartRecord + $uangmuka_list->DisplayRecords - 1;
	else
		$uangmuka_list->StopRecord = $uangmuka_list->TotalRecords;
}
$uangmuka_list->RecordCount = $uangmuka_list->StartRecord - 1;
if ($uangmuka_list->Recordset && !$uangmuka_list->Recordset->EOF) {
	$uangmuka_list->Recordset->moveFirst();
	$selectLimit = $uangmuka_list->UseSelectLimit;
	if (!$selectLimit && $uangmuka_list->StartRecord > 1)
		$uangmuka_list->Recordset->move($uangmuka_list->StartRecord - 1);
} elseif (!$uangmuka->AllowAddDeleteRow && $uangmuka_list->StopRecord == 0) {
	$uangmuka_list->StopRecord = $uangmuka->GridAddRowCount;
}

// Initialize aggregate
$uangmuka->RowType = ROWTYPE_AGGREGATEINIT;
$uangmuka->resetAttributes();
$uangmuka_list->renderRow();
while ($uangmuka_list->RecordCount < $uangmuka_list->StopRecord) {
	$uangmuka_list->RecordCount++;
	if ($uangmuka_list->RecordCount >= $uangmuka_list->StartRecord) {
		$uangmuka_list->RowCount++;

		// Set up key count
		$uangmuka_list->KeyCount = $uangmuka_list->RowIndex;

		// Init row class and style
		$uangmuka->resetAttributes();
		$uangmuka->CssClass = "";
		if ($uangmuka_list->isGridAdd()) {
		} else {
			$uangmuka_list->loadRowValues($uangmuka_list->Recordset); // Load row values
		}
		$uangmuka->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$uangmuka->RowAttrs->merge(["data-rowindex" => $uangmuka_list->RowCount, "id" => "r" . $uangmuka_list->RowCount . "_uangmuka", "data-rowtype" => $uangmuka->RowType]);

		// Render row
		$uangmuka_list->renderRow();

		// Render list options
		$uangmuka_list->renderListOptions();
?>
	<tr <?php echo $uangmuka->rowAttributes() ?>>
<?php

// Render list options (body, left)
$uangmuka_list->ListOptions->render("body", "left", $uangmuka_list->RowCount);
?>
	<?php if ($uangmuka_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $uangmuka_list->id->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_id">
<span<?php echo $uangmuka_list->id->viewAttributes() ?>><?php echo $uangmuka_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->tgl->Visible) { // tgl ?>
		<td data-name="tgl" <?php echo $uangmuka_list->tgl->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_tgl">
<span<?php echo $uangmuka_list->tgl->viewAttributes() ?>><?php echo $uangmuka_list->tgl->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->pembayar->Visible) { // pembayar ?>
		<td data-name="pembayar" <?php echo $uangmuka_list->pembayar->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_pembayar">
<span<?php echo $uangmuka_list->pembayar->viewAttributes() ?>><?php echo $uangmuka_list->pembayar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->peruntukan->Visible) { // peruntukan ?>
		<td data-name="peruntukan" <?php echo $uangmuka_list->peruntukan->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_peruntukan">
<span<?php echo $uangmuka_list->peruntukan->viewAttributes() ?>><?php echo $uangmuka_list->peruntukan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->penerima->Visible) { // penerima ?>
		<td data-name="penerima" <?php echo $uangmuka_list->penerima->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_penerima">
<span<?php echo $uangmuka_list->penerima->viewAttributes() ?>><?php echo $uangmuka_list->penerima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->rek_penerima->Visible) { // rek_penerima ?>
		<td data-name="rek_penerima" <?php echo $uangmuka_list->rek_penerima->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_rek_penerima">
<span<?php echo $uangmuka_list->rek_penerima->viewAttributes() ?>><?php echo $uangmuka_list->rek_penerima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->tgl_terima->Visible) { // tgl_terima ?>
		<td data-name="tgl_terima" <?php echo $uangmuka_list->tgl_terima->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_tgl_terima">
<span<?php echo $uangmuka_list->tgl_terima->viewAttributes() ?>><?php echo $uangmuka_list->tgl_terima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->total_terima->Visible) { // total_terima ?>
		<td data-name="total_terima" <?php echo $uangmuka_list->total_terima->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_total_terima">
<span<?php echo $uangmuka_list->total_terima->viewAttributes() ?>><?php echo $uangmuka_list->total_terima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->tgl_tgjb->Visible) { // tgl_tgjb ?>
		<td data-name="tgl_tgjb" <?php echo $uangmuka_list->tgl_tgjb->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_tgl_tgjb">
<span<?php echo $uangmuka_list->tgl_tgjb->viewAttributes() ?>><?php echo $uangmuka_list->tgl_tgjb->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->jumlah_tgjb->Visible) { // jumlah_tgjb ?>
		<td data-name="jumlah_tgjb" <?php echo $uangmuka_list->jumlah_tgjb->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_jumlah_tgjb">
<span<?php echo $uangmuka_list->jumlah_tgjb->viewAttributes() ?>><?php echo $uangmuka_list->jumlah_tgjb->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->jenis->Visible) { // jenis ?>
		<td data-name="jenis" <?php echo $uangmuka_list->jenis->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_jenis">
<span<?php echo $uangmuka_list->jenis->viewAttributes() ?>><?php echo $uangmuka_list->jenis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->bukti1->Visible) { // bukti1 ?>
		<td data-name="bukti1" <?php echo $uangmuka_list->bukti1->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_bukti1">
<span<?php echo $uangmuka_list->bukti1->viewAttributes() ?>><?php echo GetFileViewTag($uangmuka_list->bukti1, $uangmuka_list->bukti1->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->bukti2->Visible) { // bukti2 ?>
		<td data-name="bukti2" <?php echo $uangmuka_list->bukti2->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_bukti2">
<span<?php echo $uangmuka_list->bukti2->viewAttributes() ?>><?php echo GetFileViewTag($uangmuka_list->bukti2, $uangmuka_list->bukti2->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->bukti3->Visible) { // bukti3 ?>
		<td data-name="bukti3" <?php echo $uangmuka_list->bukti3->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_bukti3">
<span<?php echo $uangmuka_list->bukti3->viewAttributes() ?>><?php echo GetFileViewTag($uangmuka_list->bukti3, $uangmuka_list->bukti3->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->bukti4->Visible) { // bukti4 ?>
		<td data-name="bukti4" <?php echo $uangmuka_list->bukti4->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_bukti4">
<span<?php echo $uangmuka_list->bukti4->viewAttributes() ?>><?php echo GetFileViewTag($uangmuka_list->bukti4, $uangmuka_list->bukti4->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->disetujui->Visible) { // disetujui ?>
		<td data-name="disetujui" <?php echo $uangmuka_list->disetujui->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_disetujui">
<span<?php echo $uangmuka_list->disetujui->viewAttributes() ?>><?php echo $uangmuka_list->disetujui->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $uangmuka_list->status->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_status">
<span<?php echo $uangmuka_list->status->viewAttributes() ?>><?php echo $uangmuka_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($uangmuka_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $uangmuka_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $uangmuka_list->RowCount ?>_uangmuka_keterangan">
<span<?php echo $uangmuka_list->keterangan->viewAttributes() ?>><?php echo $uangmuka_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$uangmuka_list->ListOptions->render("body", "right", $uangmuka_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$uangmuka_list->isGridAdd())
		$uangmuka_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$uangmuka->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($uangmuka_list->Recordset)
	$uangmuka_list->Recordset->Close();
?>
<?php if (!$uangmuka_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$uangmuka_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $uangmuka_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $uangmuka_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($uangmuka_list->TotalRecords == 0 && !$uangmuka->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $uangmuka_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$uangmuka_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$uangmuka_list->isExport()) { ?>
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
$uangmuka_list->terminate();
?>