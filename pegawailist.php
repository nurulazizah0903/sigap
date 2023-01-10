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
$pegawai_list = new pegawai_list();

// Run the page
$pegawai_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pegawai_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pegawai_list->isExport()) { ?>
<script>
var fpegawailist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpegawailist = currentForm = new ew.Form("fpegawailist", "list");
	fpegawailist.formKeyCountName = '<?php echo $pegawai_list->FormKeyCountName ?>';
	loadjs.done("fpegawailist");
});
var fpegawailistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpegawailistsrch = currentSearchForm = new ew.Form("fpegawailistsrch");

	// Dynamic selection lists
	// Filters

	fpegawailistsrch.filterList = <?php echo $pegawai_list->getFilterList() ?>;
	loadjs.done("fpegawailistsrch");
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
<?php if (!$pegawai_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($pegawai_list->TotalRecords > 0 && $pegawai_list->ExportOptions->visible()) { ?>
<?php $pegawai_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($pegawai_list->ImportOptions->visible()) { ?>
<?php $pegawai_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($pegawai_list->SearchOptions->visible()) { ?>
<?php $pegawai_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($pegawai_list->FilterOptions->visible()) { ?>
<?php $pegawai_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$pegawai_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$pegawai_list->isExport() && !$pegawai->CurrentAction) { ?>
<form name="fpegawailistsrch" id="fpegawailistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpegawailistsrch-search-panel" class="<?php echo $pegawai_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pegawai">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $pegawai_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($pegawai_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($pegawai_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $pegawai_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($pegawai_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($pegawai_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($pegawai_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($pegawai_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $pegawai_list->showPageHeader(); ?>
<?php
$pegawai_list->showMessage();
?>
<?php if ($pegawai_list->TotalRecords > 0 || $pegawai->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pegawai_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pegawai">
<?php if (!$pegawai_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$pegawai_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pegawai_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pegawai_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpegawailist" id="fpegawailist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pegawai">
<div id="gmp_pegawai" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($pegawai_list->TotalRecords > 0 || $pegawai_list->isGridEdit()) { ?>
<table id="tbl_pegawailist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pegawai->RowType = ROWTYPE_HEADER;

// Render list options
$pegawai_list->renderListOptions();

// Render list options (header, left)
$pegawai_list->ListOptions->render("header", "left");
?>
<?php if ($pegawai_list->nip->Visible) { // nip ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->nip) == "") { ?>
		<th data-name="nip" class="<?php echo $pegawai_list->nip->headerCellClass() ?>"><div id="elh_pegawai_nip" class="pegawai_nip"><div class="ew-table-header-caption"><?php echo $pegawai_list->nip->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nip" class="<?php echo $pegawai_list->nip->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->nip) ?>', 1);"><div id="elh_pegawai_nip" class="pegawai_nip">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->nip->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->nip->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->nip->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->username->Visible) { // username ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->username) == "") { ?>
		<th data-name="username" class="<?php echo $pegawai_list->username->headerCellClass() ?>"><div id="elh_pegawai_username" class="pegawai_username"><div class="ew-table-header-caption"><?php echo $pegawai_list->username->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="username" class="<?php echo $pegawai_list->username->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->username) ?>', 1);"><div id="elh_pegawai_username" class="pegawai_username">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->username->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->username->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->username->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->password->Visible) { // password ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->password) == "") { ?>
		<th data-name="password" class="<?php echo $pegawai_list->password->headerCellClass() ?>"><div id="elh_pegawai_password" class="pegawai_password"><div class="ew-table-header-caption"><?php echo $pegawai_list->password->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="password" class="<?php echo $pegawai_list->password->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->password) ?>', 1);"><div id="elh_pegawai_password" class="pegawai_password">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->password->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->password->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->password->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->jenjang_id->Visible) { // jenjang_id ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->jenjang_id) == "") { ?>
		<th data-name="jenjang_id" class="<?php echo $pegawai_list->jenjang_id->headerCellClass() ?>"><div id="elh_pegawai_jenjang_id" class="pegawai_jenjang_id"><div class="ew-table-header-caption"><?php echo $pegawai_list->jenjang_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang_id" class="<?php echo $pegawai_list->jenjang_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->jenjang_id) ?>', 1);"><div id="elh_pegawai_jenjang_id" class="pegawai_jenjang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->jenjang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->jenjang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->jenjang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->jabatan->Visible) { // jabatan ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->jabatan) == "") { ?>
		<th data-name="jabatan" class="<?php echo $pegawai_list->jabatan->headerCellClass() ?>"><div id="elh_pegawai_jabatan" class="pegawai_jabatan"><div class="ew-table-header-caption"><?php echo $pegawai_list->jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan" class="<?php echo $pegawai_list->jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->jabatan) ?>', 1);"><div id="elh_pegawai_jabatan" class="pegawai_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->periode_jabatan->Visible) { // periode_jabatan ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->periode_jabatan) == "") { ?>
		<th data-name="periode_jabatan" class="<?php echo $pegawai_list->periode_jabatan->headerCellClass() ?>"><div id="elh_pegawai_periode_jabatan" class="pegawai_periode_jabatan"><div class="ew-table-header-caption"><?php echo $pegawai_list->periode_jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="periode_jabatan" class="<?php echo $pegawai_list->periode_jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->periode_jabatan) ?>', 1);"><div id="elh_pegawai_periode_jabatan" class="pegawai_periode_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->periode_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->periode_jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->periode_jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->type->Visible) { // type ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->type) == "") { ?>
		<th data-name="type" class="<?php echo $pegawai_list->type->headerCellClass() ?>"><div id="elh_pegawai_type" class="pegawai_type"><div class="ew-table-header-caption"><?php echo $pegawai_list->type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="type" class="<?php echo $pegawai_list->type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->type) ?>', 1);"><div id="elh_pegawai_type" class="pegawai_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->type->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->sertif->Visible) { // sertif ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->sertif) == "") { ?>
		<th data-name="sertif" class="<?php echo $pegawai_list->sertif->headerCellClass() ?>"><div id="elh_pegawai_sertif" class="pegawai_sertif"><div class="ew-table-header-caption"><?php echo $pegawai_list->sertif->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sertif" class="<?php echo $pegawai_list->sertif->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->sertif) ?>', 1);"><div id="elh_pegawai_sertif" class="pegawai_sertif">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->sertif->caption() ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->sertif->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->sertif->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->tambahan->Visible) { // tambahan ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->tambahan) == "") { ?>
		<th data-name="tambahan" class="<?php echo $pegawai_list->tambahan->headerCellClass() ?>"><div id="elh_pegawai_tambahan" class="pegawai_tambahan"><div class="ew-table-header-caption"><?php echo $pegawai_list->tambahan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tambahan" class="<?php echo $pegawai_list->tambahan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->tambahan) ?>', 1);"><div id="elh_pegawai_tambahan" class="pegawai_tambahan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->tambahan->caption() ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->tambahan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->tambahan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->lama_kerja->Visible) { // lama_kerja ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->lama_kerja) == "") { ?>
		<th data-name="lama_kerja" class="<?php echo $pegawai_list->lama_kerja->headerCellClass() ?>"><div id="elh_pegawai_lama_kerja" class="pegawai_lama_kerja"><div class="ew-table-header-caption"><?php echo $pegawai_list->lama_kerja->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lama_kerja" class="<?php echo $pegawai_list->lama_kerja->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->lama_kerja) ?>', 1);"><div id="elh_pegawai_lama_kerja" class="pegawai_lama_kerja">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->lama_kerja->caption() ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->lama_kerja->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->lama_kerja->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->nama->Visible) { // nama ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $pegawai_list->nama->headerCellClass() ?>"><div id="elh_pegawai_nama" class="pegawai_nama"><div class="ew-table-header-caption"><?php echo $pegawai_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $pegawai_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->nama) ?>', 1);"><div id="elh_pegawai_nama" class="pegawai_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->alamat->Visible) { // alamat ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->alamat) == "") { ?>
		<th data-name="alamat" class="<?php echo $pegawai_list->alamat->headerCellClass() ?>"><div id="elh_pegawai_alamat" class="pegawai_alamat"><div class="ew-table-header-caption"><?php echo $pegawai_list->alamat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="alamat" class="<?php echo $pegawai_list->alamat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->alamat) ?>', 1);"><div id="elh_pegawai_alamat" class="pegawai_alamat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->alamat->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->alamat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->alamat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->_email->Visible) { // email ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $pegawai_list->_email->headerCellClass() ?>"><div id="elh_pegawai__email" class="pegawai__email"><div class="ew-table-header-caption"><?php echo $pegawai_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $pegawai_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->_email) ?>', 1);"><div id="elh_pegawai__email" class="pegawai__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->wa->Visible) { // wa ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->wa) == "") { ?>
		<th data-name="wa" class="<?php echo $pegawai_list->wa->headerCellClass() ?>"><div id="elh_pegawai_wa" class="pegawai_wa"><div class="ew-table-header-caption"><?php echo $pegawai_list->wa->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="wa" class="<?php echo $pegawai_list->wa->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->wa) ?>', 1);"><div id="elh_pegawai_wa" class="pegawai_wa">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->wa->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->wa->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->wa->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->hp->Visible) { // hp ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->hp) == "") { ?>
		<th data-name="hp" class="<?php echo $pegawai_list->hp->headerCellClass() ?>"><div id="elh_pegawai_hp" class="pegawai_hp"><div class="ew-table-header-caption"><?php echo $pegawai_list->hp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hp" class="<?php echo $pegawai_list->hp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->hp) ?>', 1);"><div id="elh_pegawai_hp" class="pegawai_hp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->hp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->hp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->hp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->tgllahir->Visible) { // tgllahir ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->tgllahir) == "") { ?>
		<th data-name="tgllahir" class="<?php echo $pegawai_list->tgllahir->headerCellClass() ?>"><div id="elh_pegawai_tgllahir" class="pegawai_tgllahir"><div class="ew-table-header-caption"><?php echo $pegawai_list->tgllahir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgllahir" class="<?php echo $pegawai_list->tgllahir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->tgllahir) ?>', 1);"><div id="elh_pegawai_tgllahir" class="pegawai_tgllahir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->tgllahir->caption() ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->tgllahir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->tgllahir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->rekbank->Visible) { // rekbank ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->rekbank) == "") { ?>
		<th data-name="rekbank" class="<?php echo $pegawai_list->rekbank->headerCellClass() ?>"><div id="elh_pegawai_rekbank" class="pegawai_rekbank"><div class="ew-table-header-caption"><?php echo $pegawai_list->rekbank->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rekbank" class="<?php echo $pegawai_list->rekbank->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->rekbank) ?>', 1);"><div id="elh_pegawai_rekbank" class="pegawai_rekbank">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->rekbank->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->rekbank->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->rekbank->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->pendidikan->Visible) { // pendidikan ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->pendidikan) == "") { ?>
		<th data-name="pendidikan" class="<?php echo $pegawai_list->pendidikan->headerCellClass() ?>"><div id="elh_pegawai_pendidikan" class="pegawai_pendidikan"><div class="ew-table-header-caption"><?php echo $pegawai_list->pendidikan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pendidikan" class="<?php echo $pegawai_list->pendidikan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->pendidikan) ?>', 1);"><div id="elh_pegawai_pendidikan" class="pegawai_pendidikan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->pendidikan->caption() ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->pendidikan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->pendidikan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->jurusan->Visible) { // jurusan ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->jurusan) == "") { ?>
		<th data-name="jurusan" class="<?php echo $pegawai_list->jurusan->headerCellClass() ?>"><div id="elh_pegawai_jurusan" class="pegawai_jurusan"><div class="ew-table-header-caption"><?php echo $pegawai_list->jurusan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jurusan" class="<?php echo $pegawai_list->jurusan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->jurusan) ?>', 1);"><div id="elh_pegawai_jurusan" class="pegawai_jurusan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->jurusan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->jurusan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->jurusan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->agama->Visible) { // agama ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->agama) == "") { ?>
		<th data-name="agama" class="<?php echo $pegawai_list->agama->headerCellClass() ?>"><div id="elh_pegawai_agama" class="pegawai_agama"><div class="ew-table-header-caption"><?php echo $pegawai_list->agama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="agama" class="<?php echo $pegawai_list->agama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->agama) ?>', 1);"><div id="elh_pegawai_agama" class="pegawai_agama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->agama->caption() ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->agama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->agama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->jenkel->Visible) { // jenkel ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->jenkel) == "") { ?>
		<th data-name="jenkel" class="<?php echo $pegawai_list->jenkel->headerCellClass() ?>"><div id="elh_pegawai_jenkel" class="pegawai_jenkel"><div class="ew-table-header-caption"><?php echo $pegawai_list->jenkel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenkel" class="<?php echo $pegawai_list->jenkel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->jenkel) ?>', 1);"><div id="elh_pegawai_jenkel" class="pegawai_jenkel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->jenkel->caption() ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->jenkel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->jenkel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->status->Visible) { // status ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $pegawai_list->status->headerCellClass() ?>"><div id="elh_pegawai_status" class="pegawai_status"><div class="ew-table-header-caption"><?php echo $pegawai_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $pegawai_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->status) ?>', 1);"><div id="elh_pegawai_status" class="pegawai_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->status->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->foto->Visible) { // foto ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->foto) == "") { ?>
		<th data-name="foto" class="<?php echo $pegawai_list->foto->headerCellClass() ?>"><div id="elh_pegawai_foto" class="pegawai_foto"><div class="ew-table-header-caption"><?php echo $pegawai_list->foto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="foto" class="<?php echo $pegawai_list->foto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->foto) ?>', 1);"><div id="elh_pegawai_foto" class="pegawai_foto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->foto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->foto->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->foto->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->file_cv->Visible) { // file_cv ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->file_cv) == "") { ?>
		<th data-name="file_cv" class="<?php echo $pegawai_list->file_cv->headerCellClass() ?>"><div id="elh_pegawai_file_cv" class="pegawai_file_cv"><div class="ew-table-header-caption"><?php echo $pegawai_list->file_cv->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="file_cv" class="<?php echo $pegawai_list->file_cv->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->file_cv) ?>', 1);"><div id="elh_pegawai_file_cv" class="pegawai_file_cv">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->file_cv->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->file_cv->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->file_cv->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->mulai_bekerja->Visible) { // mulai_bekerja ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->mulai_bekerja) == "") { ?>
		<th data-name="mulai_bekerja" class="<?php echo $pegawai_list->mulai_bekerja->headerCellClass() ?>"><div id="elh_pegawai_mulai_bekerja" class="pegawai_mulai_bekerja"><div class="ew-table-header-caption"><?php echo $pegawai_list->mulai_bekerja->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="mulai_bekerja" class="<?php echo $pegawai_list->mulai_bekerja->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->mulai_bekerja) ?>', 1);"><div id="elh_pegawai_mulai_bekerja" class="pegawai_mulai_bekerja">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->mulai_bekerja->caption() ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->mulai_bekerja->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->mulai_bekerja->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->keterangan->Visible) { // keterangan ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $pegawai_list->keterangan->headerCellClass() ?>"><div id="elh_pegawai_keterangan" class="pegawai_keterangan"><div class="ew-table-header-caption"><?php echo $pegawai_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $pegawai_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->keterangan) ?>', 1);"><div id="elh_pegawai_keterangan" class="pegawai_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->level->Visible) { // level ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->level) == "") { ?>
		<th data-name="level" class="<?php echo $pegawai_list->level->headerCellClass() ?>"><div id="elh_pegawai_level" class="pegawai_level"><div class="ew-table-header-caption"><?php echo $pegawai_list->level->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="level" class="<?php echo $pegawai_list->level->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->level) ?>', 1);"><div id="elh_pegawai_level" class="pegawai_level">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->level->caption() ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->level->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->level->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pegawai_list->aktif->Visible) { // aktif ?>
	<?php if ($pegawai_list->SortUrl($pegawai_list->aktif) == "") { ?>
		<th data-name="aktif" class="<?php echo $pegawai_list->aktif->headerCellClass() ?>"><div id="elh_pegawai_aktif" class="pegawai_aktif"><div class="ew-table-header-caption"><?php echo $pegawai_list->aktif->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="aktif" class="<?php echo $pegawai_list->aktif->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pegawai_list->SortUrl($pegawai_list->aktif) ?>', 1);"><div id="elh_pegawai_aktif" class="pegawai_aktif">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pegawai_list->aktif->caption() ?></span><span class="ew-table-header-sort"><?php if ($pegawai_list->aktif->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pegawai_list->aktif->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pegawai_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pegawai_list->ExportAll && $pegawai_list->isExport()) {
	$pegawai_list->StopRecord = $pegawai_list->TotalRecords;
} else {

	// Set the last record to display
	if ($pegawai_list->TotalRecords > $pegawai_list->StartRecord + $pegawai_list->DisplayRecords - 1)
		$pegawai_list->StopRecord = $pegawai_list->StartRecord + $pegawai_list->DisplayRecords - 1;
	else
		$pegawai_list->StopRecord = $pegawai_list->TotalRecords;
}
$pegawai_list->RecordCount = $pegawai_list->StartRecord - 1;
if ($pegawai_list->Recordset && !$pegawai_list->Recordset->EOF) {
	$pegawai_list->Recordset->moveFirst();
	$selectLimit = $pegawai_list->UseSelectLimit;
	if (!$selectLimit && $pegawai_list->StartRecord > 1)
		$pegawai_list->Recordset->move($pegawai_list->StartRecord - 1);
} elseif (!$pegawai->AllowAddDeleteRow && $pegawai_list->StopRecord == 0) {
	$pegawai_list->StopRecord = $pegawai->GridAddRowCount;
}

// Initialize aggregate
$pegawai->RowType = ROWTYPE_AGGREGATEINIT;
$pegawai->resetAttributes();
$pegawai_list->renderRow();
while ($pegawai_list->RecordCount < $pegawai_list->StopRecord) {
	$pegawai_list->RecordCount++;
	if ($pegawai_list->RecordCount >= $pegawai_list->StartRecord) {
		$pegawai_list->RowCount++;

		// Set up key count
		$pegawai_list->KeyCount = $pegawai_list->RowIndex;

		// Init row class and style
		$pegawai->resetAttributes();
		$pegawai->CssClass = "";
		if ($pegawai_list->isGridAdd()) {
		} else {
			$pegawai_list->loadRowValues($pegawai_list->Recordset); // Load row values
		}
		$pegawai->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pegawai->RowAttrs->merge(["data-rowindex" => $pegawai_list->RowCount, "id" => "r" . $pegawai_list->RowCount . "_pegawai", "data-rowtype" => $pegawai->RowType]);

		// Render row
		$pegawai_list->renderRow();

		// Render list options
		$pegawai_list->renderListOptions();
?>
	<tr <?php echo $pegawai->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pegawai_list->ListOptions->render("body", "left", $pegawai_list->RowCount);
?>
	<?php if ($pegawai_list->nip->Visible) { // nip ?>
		<td data-name="nip" <?php echo $pegawai_list->nip->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_nip">
<span<?php echo $pegawai_list->nip->viewAttributes() ?>><?php echo $pegawai_list->nip->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->username->Visible) { // username ?>
		<td data-name="username" <?php echo $pegawai_list->username->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_username">
<span<?php echo $pegawai_list->username->viewAttributes() ?>><?php echo $pegawai_list->username->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->password->Visible) { // password ?>
		<td data-name="password" <?php echo $pegawai_list->password->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_password">
<span<?php echo $pegawai_list->password->viewAttributes() ?>><?php echo $pegawai_list->password->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id" <?php echo $pegawai_list->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_jenjang_id">
<span<?php echo $pegawai_list->jenjang_id->viewAttributes() ?>><?php echo $pegawai_list->jenjang_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->jabatan->Visible) { // jabatan ?>
		<td data-name="jabatan" <?php echo $pegawai_list->jabatan->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_jabatan">
<span<?php echo $pegawai_list->jabatan->viewAttributes() ?>><?php echo $pegawai_list->jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->periode_jabatan->Visible) { // periode_jabatan ?>
		<td data-name="periode_jabatan" <?php echo $pegawai_list->periode_jabatan->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_periode_jabatan">
<span<?php echo $pegawai_list->periode_jabatan->viewAttributes() ?>><?php echo $pegawai_list->periode_jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->type->Visible) { // type ?>
		<td data-name="type" <?php echo $pegawai_list->type->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_type">
<span<?php echo $pegawai_list->type->viewAttributes() ?>><?php echo $pegawai_list->type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->sertif->Visible) { // sertif ?>
		<td data-name="sertif" <?php echo $pegawai_list->sertif->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_sertif">
<span<?php echo $pegawai_list->sertif->viewAttributes() ?>><?php echo $pegawai_list->sertif->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->tambahan->Visible) { // tambahan ?>
		<td data-name="tambahan" <?php echo $pegawai_list->tambahan->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_tambahan">
<span<?php echo $pegawai_list->tambahan->viewAttributes() ?>><?php echo $pegawai_list->tambahan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->lama_kerja->Visible) { // lama_kerja ?>
		<td data-name="lama_kerja" <?php echo $pegawai_list->lama_kerja->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_lama_kerja">
<span<?php echo $pegawai_list->lama_kerja->viewAttributes() ?>><?php echo $pegawai_list->lama_kerja->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $pegawai_list->nama->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_nama">
<span<?php echo $pegawai_list->nama->viewAttributes() ?>><?php echo $pegawai_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->alamat->Visible) { // alamat ?>
		<td data-name="alamat" <?php echo $pegawai_list->alamat->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_alamat">
<span<?php echo $pegawai_list->alamat->viewAttributes() ?>><?php echo $pegawai_list->alamat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $pegawai_list->_email->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai__email">
<span<?php echo $pegawai_list->_email->viewAttributes() ?>><?php echo $pegawai_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->wa->Visible) { // wa ?>
		<td data-name="wa" <?php echo $pegawai_list->wa->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_wa">
<span<?php echo $pegawai_list->wa->viewAttributes() ?>><?php echo $pegawai_list->wa->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->hp->Visible) { // hp ?>
		<td data-name="hp" <?php echo $pegawai_list->hp->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_hp">
<span<?php echo $pegawai_list->hp->viewAttributes() ?>><?php echo $pegawai_list->hp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->tgllahir->Visible) { // tgllahir ?>
		<td data-name="tgllahir" <?php echo $pegawai_list->tgllahir->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_tgllahir">
<span<?php echo $pegawai_list->tgllahir->viewAttributes() ?>><?php echo $pegawai_list->tgllahir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->rekbank->Visible) { // rekbank ?>
		<td data-name="rekbank" <?php echo $pegawai_list->rekbank->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_rekbank">
<span<?php echo $pegawai_list->rekbank->viewAttributes() ?>><?php echo $pegawai_list->rekbank->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->pendidikan->Visible) { // pendidikan ?>
		<td data-name="pendidikan" <?php echo $pegawai_list->pendidikan->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_pendidikan">
<span<?php echo $pegawai_list->pendidikan->viewAttributes() ?>><?php echo $pegawai_list->pendidikan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->jurusan->Visible) { // jurusan ?>
		<td data-name="jurusan" <?php echo $pegawai_list->jurusan->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_jurusan">
<span<?php echo $pegawai_list->jurusan->viewAttributes() ?>><?php echo $pegawai_list->jurusan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->agama->Visible) { // agama ?>
		<td data-name="agama" <?php echo $pegawai_list->agama->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_agama">
<span<?php echo $pegawai_list->agama->viewAttributes() ?>><?php echo $pegawai_list->agama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->jenkel->Visible) { // jenkel ?>
		<td data-name="jenkel" <?php echo $pegawai_list->jenkel->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_jenkel">
<span<?php echo $pegawai_list->jenkel->viewAttributes() ?>><?php echo $pegawai_list->jenkel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $pegawai_list->status->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_status">
<span<?php echo $pegawai_list->status->viewAttributes() ?>><?php echo $pegawai_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->foto->Visible) { // foto ?>
		<td data-name="foto" <?php echo $pegawai_list->foto->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_foto">
<span<?php echo $pegawai_list->foto->viewAttributes() ?>><?php echo GetFileViewTag($pegawai_list->foto, $pegawai_list->foto->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->file_cv->Visible) { // file_cv ?>
		<td data-name="file_cv" <?php echo $pegawai_list->file_cv->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_file_cv">
<span<?php echo $pegawai_list->file_cv->viewAttributes() ?>><?php echo GetFileViewTag($pegawai_list->file_cv, $pegawai_list->file_cv->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->mulai_bekerja->Visible) { // mulai_bekerja ?>
		<td data-name="mulai_bekerja" <?php echo $pegawai_list->mulai_bekerja->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_mulai_bekerja">
<span<?php echo $pegawai_list->mulai_bekerja->viewAttributes() ?>><?php echo $pegawai_list->mulai_bekerja->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $pegawai_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_keterangan">
<span<?php echo $pegawai_list->keterangan->viewAttributes() ?>><?php echo $pegawai_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->level->Visible) { // level ?>
		<td data-name="level" <?php echo $pegawai_list->level->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_level">
<span<?php echo $pegawai_list->level->viewAttributes() ?>><?php echo $pegawai_list->level->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_list->aktif->Visible) { // aktif ?>
		<td data-name="aktif" <?php echo $pegawai_list->aktif->cellAttributes() ?>>
<span id="el<?php echo $pegawai_list->RowCount ?>_pegawai_aktif">
<span<?php echo $pegawai_list->aktif->viewAttributes() ?>><?php echo $pegawai_list->aktif->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pegawai_list->ListOptions->render("body", "right", $pegawai_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$pegawai_list->isGridAdd())
		$pegawai_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$pegawai->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pegawai_list->Recordset)
	$pegawai_list->Recordset->Close();
?>
<?php if (!$pegawai_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$pegawai_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pegawai_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pegawai_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pegawai_list->TotalRecords == 0 && !$pegawai->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pegawai_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$pegawai_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pegawai_list->isExport()) { ?>
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
$pegawai_list->terminate();
?>