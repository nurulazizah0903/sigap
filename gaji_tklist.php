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
$gaji_tk_list = new gaji_tk_list();

// Run the page
$gaji_tk_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_tk_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gaji_tk_list->isExport()) { ?>
<script>
var fgaji_tklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgaji_tklist = currentForm = new ew.Form("fgaji_tklist", "list");
	fgaji_tklist.formKeyCountName = '<?php echo $gaji_tk_list->FormKeyCountName ?>';
	loadjs.done("fgaji_tklist");
});
var fgaji_tklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fgaji_tklistsrch = currentSearchForm = new ew.Form("fgaji_tklistsrch");

	// Dynamic selection lists
	// Filters

	fgaji_tklistsrch.filterList = <?php echo $gaji_tk_list->getFilterList() ?>;
	loadjs.done("fgaji_tklistsrch");
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
	ew.PREVIEW_OVERLAY = true;
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
<?php if (!$gaji_tk_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gaji_tk_list->TotalRecords > 0 && $gaji_tk_list->ExportOptions->visible()) { ?>
<?php $gaji_tk_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gaji_tk_list->ImportOptions->visible()) { ?>
<?php $gaji_tk_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($gaji_tk_list->SearchOptions->visible()) { ?>
<?php $gaji_tk_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($gaji_tk_list->FilterOptions->visible()) { ?>
<?php $gaji_tk_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$gaji_tk_list->isExport() || Config("EXPORT_MASTER_RECORD") && $gaji_tk_list->isExport("print")) { ?>
<?php
if ($gaji_tk_list->DbMasterFilter != "" && $gaji_tk->getCurrentMasterTable() == "m_tk") {
	if ($gaji_tk_list->MasterRecordExists) {
		include_once "m_tkmaster.php";
	}
}
?>
<?php } ?>
<?php
$gaji_tk_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$gaji_tk_list->isExport() && !$gaji_tk->CurrentAction) { ?>
<form name="fgaji_tklistsrch" id="fgaji_tklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fgaji_tklistsrch-search-panel" class="<?php echo $gaji_tk_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="gaji_tk">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $gaji_tk_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($gaji_tk_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($gaji_tk_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $gaji_tk_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($gaji_tk_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($gaji_tk_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($gaji_tk_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($gaji_tk_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $gaji_tk_list->showPageHeader(); ?>
<?php
$gaji_tk_list->showMessage();
?>
<?php if ($gaji_tk_list->TotalRecords > 0 || $gaji_tk->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gaji_tk_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gaji_tk">
<?php if (!$gaji_tk_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gaji_tk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gaji_tk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gaji_tk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgaji_tklist" id="fgaji_tklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gaji_tk">
<?php if ($gaji_tk->getCurrentMasterTable() == "m_tk" && $gaji_tk->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="m_tk">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($gaji_tk_list->pid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_gaji_tk" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gaji_tk_list->TotalRecords > 0 || $gaji_tk_list->isGridEdit()) { ?>
<table id="tbl_gaji_tklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gaji_tk->RowType = ROWTYPE_HEADER;

// Render list options
$gaji_tk_list->renderListOptions();

// Render list options (header, left)
$gaji_tk_list->ListOptions->render("header", "left");
?>
<?php if ($gaji_tk_list->pegawai->Visible) { // pegawai ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $gaji_tk_list->pegawai->headerCellClass() ?>"><div id="elh_gaji_tk_pegawai" class="gaji_tk_pegawai"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $gaji_tk_list->pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->pegawai) ?>', 1);"><div id="elh_gaji_tk_pegawai" class="gaji_tk_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->jenjang_id->Visible) { // jenjang_id ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->jenjang_id) == "") { ?>
		<th data-name="jenjang_id" class="<?php echo $gaji_tk_list->jenjang_id->headerCellClass() ?>"><div id="elh_gaji_tk_jenjang_id" class="gaji_tk_jenjang_id"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->jenjang_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang_id" class="<?php echo $gaji_tk_list->jenjang_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->jenjang_id) ?>', 1);"><div id="elh_gaji_tk_jenjang_id" class="gaji_tk_jenjang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->jenjang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->jenjang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->jenjang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->jabatan_id) == "") { ?>
		<th data-name="jabatan_id" class="<?php echo $gaji_tk_list->jabatan_id->headerCellClass() ?>"><div id="elh_gaji_tk_jabatan_id" class="gaji_tk_jabatan_id"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->jabatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan_id" class="<?php echo $gaji_tk_list->jabatan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->jabatan_id) ?>', 1);"><div id="elh_gaji_tk_jabatan_id" class="gaji_tk_jabatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->jabatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->jabatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->type->Visible) { // type ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->type) == "") { ?>
		<th data-name="type" class="<?php echo $gaji_tk_list->type->headerCellClass() ?>"><div id="elh_gaji_tk_type" class="gaji_tk_type"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="type" class="<?php echo $gaji_tk_list->type->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->type) ?>', 1);"><div id="elh_gaji_tk_type" class="gaji_tk_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->type->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->lama_kerja->Visible) { // lama_kerja ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->lama_kerja) == "") { ?>
		<th data-name="lama_kerja" class="<?php echo $gaji_tk_list->lama_kerja->headerCellClass() ?>"><div id="elh_gaji_tk_lama_kerja" class="gaji_tk_lama_kerja"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->lama_kerja->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lama_kerja" class="<?php echo $gaji_tk_list->lama_kerja->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->lama_kerja) ?>', 1);"><div id="elh_gaji_tk_lama_kerja" class="gaji_tk_lama_kerja">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->lama_kerja->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->lama_kerja->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->lama_kerja->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->jenis_guru->Visible) { // jenis_guru ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->jenis_guru) == "") { ?>
		<th data-name="jenis_guru" class="<?php echo $gaji_tk_list->jenis_guru->headerCellClass() ?>"><div id="elh_gaji_tk_jenis_guru" class="gaji_tk_jenis_guru"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->jenis_guru->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_guru" class="<?php echo $gaji_tk_list->jenis_guru->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->jenis_guru) ?>', 1);"><div id="elh_gaji_tk_jenis_guru" class="gaji_tk_jenis_guru">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->jenis_guru->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->jenis_guru->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->jenis_guru->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->tambahan->Visible) { // tambahan ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->tambahan) == "") { ?>
		<th data-name="tambahan" class="<?php echo $gaji_tk_list->tambahan->headerCellClass() ?>"><div id="elh_gaji_tk_tambahan" class="gaji_tk_tambahan"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->tambahan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tambahan" class="<?php echo $gaji_tk_list->tambahan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->tambahan) ?>', 1);"><div id="elh_gaji_tk_tambahan" class="gaji_tk_tambahan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->tambahan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->tambahan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->tambahan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->periode->Visible) { // periode ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->periode) == "") { ?>
		<th data-name="periode" class="<?php echo $gaji_tk_list->periode->headerCellClass() ?>"><div id="elh_gaji_tk_periode" class="gaji_tk_periode"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->periode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="periode" class="<?php echo $gaji_tk_list->periode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->periode) ?>', 1);"><div id="elh_gaji_tk_periode" class="gaji_tk_periode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->periode->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->periode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->periode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->tunjangan_periode->Visible) { // tunjangan_periode ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->tunjangan_periode) == "") { ?>
		<th data-name="tunjangan_periode" class="<?php echo $gaji_tk_list->tunjangan_periode->headerCellClass() ?>"><div id="elh_gaji_tk_tunjangan_periode" class="gaji_tk_tunjangan_periode"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->tunjangan_periode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tunjangan_periode" class="<?php echo $gaji_tk_list->tunjangan_periode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->tunjangan_periode) ?>', 1);"><div id="elh_gaji_tk_tunjangan_periode" class="gaji_tk_tunjangan_periode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->tunjangan_periode->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->tunjangan_periode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->tunjangan_periode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->kehadiran->Visible) { // kehadiran ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->kehadiran) == "") { ?>
		<th data-name="kehadiran" class="<?php echo $gaji_tk_list->kehadiran->headerCellClass() ?>"><div id="elh_gaji_tk_kehadiran" class="gaji_tk_kehadiran"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->kehadiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kehadiran" class="<?php echo $gaji_tk_list->kehadiran->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->kehadiran) ?>', 1);"><div id="elh_gaji_tk_kehadiran" class="gaji_tk_kehadiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->kehadiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->kehadiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->value_kehadiran->Visible) { // value_kehadiran ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->value_kehadiran) == "") { ?>
		<th data-name="value_kehadiran" class="<?php echo $gaji_tk_list->value_kehadiran->headerCellClass() ?>"><div id="elh_gaji_tk_value_kehadiran" class="gaji_tk_value_kehadiran"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->value_kehadiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_kehadiran" class="<?php echo $gaji_tk_list->value_kehadiran->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->value_kehadiran) ?>', 1);"><div id="elh_gaji_tk_value_kehadiran" class="gaji_tk_value_kehadiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->value_kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->value_kehadiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->value_kehadiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->lembur->Visible) { // lembur ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->lembur) == "") { ?>
		<th data-name="lembur" class="<?php echo $gaji_tk_list->lembur->headerCellClass() ?>"><div id="elh_gaji_tk_lembur" class="gaji_tk_lembur"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->lembur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lembur" class="<?php echo $gaji_tk_list->lembur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->lembur) ?>', 1);"><div id="elh_gaji_tk_lembur" class="gaji_tk_lembur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->lembur->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->lembur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->lembur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->value_lembur->Visible) { // value_lembur ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->value_lembur) == "") { ?>
		<th data-name="value_lembur" class="<?php echo $gaji_tk_list->value_lembur->headerCellClass() ?>"><div id="elh_gaji_tk_value_lembur" class="gaji_tk_value_lembur"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->value_lembur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_lembur" class="<?php echo $gaji_tk_list->value_lembur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->value_lembur) ?>', 1);"><div id="elh_gaji_tk_value_lembur" class="gaji_tk_value_lembur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->value_lembur->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->value_lembur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->value_lembur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->jp->Visible) { // jp ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->jp) == "") { ?>
		<th data-name="jp" class="<?php echo $gaji_tk_list->jp->headerCellClass() ?>"><div id="elh_gaji_tk_jp" class="gaji_tk_jp"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->jp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jp" class="<?php echo $gaji_tk_list->jp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->jp) ?>', 1);"><div id="elh_gaji_tk_jp" class="gaji_tk_jp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->jp->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->jp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->jp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->gapok->Visible) { // gapok ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->gapok) == "") { ?>
		<th data-name="gapok" class="<?php echo $gaji_tk_list->gapok->headerCellClass() ?>"><div id="elh_gaji_tk_gapok" class="gaji_tk_gapok"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->gapok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gapok" class="<?php echo $gaji_tk_list->gapok->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->gapok) ?>', 1);"><div id="elh_gaji_tk_gapok" class="gaji_tk_gapok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->gapok->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->gapok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->gapok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->total_gapok->Visible) { // total_gapok ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->total_gapok) == "") { ?>
		<th data-name="total_gapok" class="<?php echo $gaji_tk_list->total_gapok->headerCellClass() ?>"><div id="elh_gaji_tk_total_gapok" class="gaji_tk_total_gapok"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->total_gapok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_gapok" class="<?php echo $gaji_tk_list->total_gapok->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->total_gapok) ?>', 1);"><div id="elh_gaji_tk_total_gapok" class="gaji_tk_total_gapok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->total_gapok->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->total_gapok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->total_gapok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->value_reward->Visible) { // value_reward ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->value_reward) == "") { ?>
		<th data-name="value_reward" class="<?php echo $gaji_tk_list->value_reward->headerCellClass() ?>"><div id="elh_gaji_tk_value_reward" class="gaji_tk_value_reward"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->value_reward->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_reward" class="<?php echo $gaji_tk_list->value_reward->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->value_reward) ?>', 1);"><div id="elh_gaji_tk_value_reward" class="gaji_tk_value_reward">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->value_reward->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->value_reward->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->value_reward->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->value_inval->Visible) { // value_inval ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->value_inval) == "") { ?>
		<th data-name="value_inval" class="<?php echo $gaji_tk_list->value_inval->headerCellClass() ?>"><div id="elh_gaji_tk_value_inval" class="gaji_tk_value_inval"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->value_inval->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_inval" class="<?php echo $gaji_tk_list->value_inval->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->value_inval) ?>', 1);"><div id="elh_gaji_tk_value_inval" class="gaji_tk_value_inval">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->value_inval->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->value_inval->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->value_inval->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->piket_count->Visible) { // piket_count ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->piket_count) == "") { ?>
		<th data-name="piket_count" class="<?php echo $gaji_tk_list->piket_count->headerCellClass() ?>"><div id="elh_gaji_tk_piket_count" class="gaji_tk_piket_count"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->piket_count->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="piket_count" class="<?php echo $gaji_tk_list->piket_count->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->piket_count) ?>', 1);"><div id="elh_gaji_tk_piket_count" class="gaji_tk_piket_count">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->piket_count->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->piket_count->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->piket_count->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->value_piket->Visible) { // value_piket ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->value_piket) == "") { ?>
		<th data-name="value_piket" class="<?php echo $gaji_tk_list->value_piket->headerCellClass() ?>"><div id="elh_gaji_tk_value_piket" class="gaji_tk_value_piket"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->value_piket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_piket" class="<?php echo $gaji_tk_list->value_piket->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->value_piket) ?>', 1);"><div id="elh_gaji_tk_value_piket" class="gaji_tk_value_piket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->value_piket->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->value_piket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->value_piket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->tugastambahan->Visible) { // tugastambahan ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->tugastambahan) == "") { ?>
		<th data-name="tugastambahan" class="<?php echo $gaji_tk_list->tugastambahan->headerCellClass() ?>"><div id="elh_gaji_tk_tugastambahan" class="gaji_tk_tugastambahan"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->tugastambahan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tugastambahan" class="<?php echo $gaji_tk_list->tugastambahan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->tugastambahan) ?>', 1);"><div id="elh_gaji_tk_tugastambahan" class="gaji_tk_tugastambahan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->tugastambahan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->tugastambahan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->tugastambahan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->tj_jabatan->Visible) { // tj_jabatan ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->tj_jabatan) == "") { ?>
		<th data-name="tj_jabatan" class="<?php echo $gaji_tk_list->tj_jabatan->headerCellClass() ?>"><div id="elh_gaji_tk_tj_jabatan" class="gaji_tk_tj_jabatan"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->tj_jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tj_jabatan" class="<?php echo $gaji_tk_list->tj_jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->tj_jabatan) ?>', 1);"><div id="elh_gaji_tk_tj_jabatan" class="gaji_tk_tj_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->tj_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->tj_jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->tj_jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->sub_total->Visible) { // sub_total ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->sub_total) == "") { ?>
		<th data-name="sub_total" class="<?php echo $gaji_tk_list->sub_total->headerCellClass() ?>"><div id="elh_gaji_tk_sub_total" class="gaji_tk_sub_total"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->sub_total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sub_total" class="<?php echo $gaji_tk_list->sub_total->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->sub_total) ?>', 1);"><div id="elh_gaji_tk_sub_total" class="gaji_tk_sub_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->sub_total->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->sub_total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->sub_total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->potongan->Visible) { // potongan ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->potongan) == "") { ?>
		<th data-name="potongan" class="<?php echo $gaji_tk_list->potongan->headerCellClass() ?>"><div id="elh_gaji_tk_potongan" class="gaji_tk_potongan"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->potongan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan" class="<?php echo $gaji_tk_list->potongan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->potongan) ?>', 1);"><div id="elh_gaji_tk_potongan" class="gaji_tk_potongan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->potongan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->potongan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->potongan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->penyesuaian->Visible) { // penyesuaian ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->penyesuaian) == "") { ?>
		<th data-name="penyesuaian" class="<?php echo $gaji_tk_list->penyesuaian->headerCellClass() ?>"><div id="elh_gaji_tk_penyesuaian" class="gaji_tk_penyesuaian"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="penyesuaian" class="<?php echo $gaji_tk_list->penyesuaian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->penyesuaian) ?>', 1);"><div id="elh_gaji_tk_penyesuaian" class="gaji_tk_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tk_list->total->Visible) { // total ?>
	<?php if ($gaji_tk_list->SortUrl($gaji_tk_list->total) == "") { ?>
		<th data-name="total" class="<?php echo $gaji_tk_list->total->headerCellClass() ?>"><div id="elh_gaji_tk_total" class="gaji_tk_total"><div class="ew-table-header-caption"><?php echo $gaji_tk_list->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $gaji_tk_list->total->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_tk_list->SortUrl($gaji_tk_list->total) ?>', 1);"><div id="elh_gaji_tk_total" class="gaji_tk_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tk_list->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tk_list->total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tk_list->total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gaji_tk_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gaji_tk_list->ExportAll && $gaji_tk_list->isExport()) {
	$gaji_tk_list->StopRecord = $gaji_tk_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gaji_tk_list->TotalRecords > $gaji_tk_list->StartRecord + $gaji_tk_list->DisplayRecords - 1)
		$gaji_tk_list->StopRecord = $gaji_tk_list->StartRecord + $gaji_tk_list->DisplayRecords - 1;
	else
		$gaji_tk_list->StopRecord = $gaji_tk_list->TotalRecords;
}
$gaji_tk_list->RecordCount = $gaji_tk_list->StartRecord - 1;
if ($gaji_tk_list->Recordset && !$gaji_tk_list->Recordset->EOF) {
	$gaji_tk_list->Recordset->moveFirst();
	$selectLimit = $gaji_tk_list->UseSelectLimit;
	if (!$selectLimit && $gaji_tk_list->StartRecord > 1)
		$gaji_tk_list->Recordset->move($gaji_tk_list->StartRecord - 1);
} elseif (!$gaji_tk->AllowAddDeleteRow && $gaji_tk_list->StopRecord == 0) {
	$gaji_tk_list->StopRecord = $gaji_tk->GridAddRowCount;
}

// Initialize aggregate
$gaji_tk->RowType = ROWTYPE_AGGREGATEINIT;
$gaji_tk->resetAttributes();
$gaji_tk_list->renderRow();
while ($gaji_tk_list->RecordCount < $gaji_tk_list->StopRecord) {
	$gaji_tk_list->RecordCount++;
	if ($gaji_tk_list->RecordCount >= $gaji_tk_list->StartRecord) {
		$gaji_tk_list->RowCount++;

		// Set up key count
		$gaji_tk_list->KeyCount = $gaji_tk_list->RowIndex;

		// Init row class and style
		$gaji_tk->resetAttributes();
		$gaji_tk->CssClass = "";
		if ($gaji_tk_list->isGridAdd()) {
		} else {
			$gaji_tk_list->loadRowValues($gaji_tk_list->Recordset); // Load row values
		}
		$gaji_tk->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gaji_tk->RowAttrs->merge(["data-rowindex" => $gaji_tk_list->RowCount, "id" => "r" . $gaji_tk_list->RowCount . "_gaji_tk", "data-rowtype" => $gaji_tk->RowType]);

		// Render row
		$gaji_tk_list->renderRow();

		// Render list options
		$gaji_tk_list->renderListOptions();
?>
	<tr <?php echo $gaji_tk->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gaji_tk_list->ListOptions->render("body", "left", $gaji_tk_list->RowCount);
?>
	<?php if ($gaji_tk_list->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $gaji_tk_list->pegawai->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_pegawai">
<span<?php echo $gaji_tk_list->pegawai->viewAttributes() ?>><?php echo $gaji_tk_list->pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id" <?php echo $gaji_tk_list->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_jenjang_id">
<span<?php echo $gaji_tk_list->jenjang_id->viewAttributes() ?>><?php echo $gaji_tk_list->jenjang_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id" <?php echo $gaji_tk_list->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_jabatan_id">
<span<?php echo $gaji_tk_list->jabatan_id->viewAttributes() ?>><?php echo $gaji_tk_list->jabatan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->type->Visible) { // type ?>
		<td data-name="type" <?php echo $gaji_tk_list->type->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_type">
<span<?php echo $gaji_tk_list->type->viewAttributes() ?>><?php echo $gaji_tk_list->type->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->lama_kerja->Visible) { // lama_kerja ?>
		<td data-name="lama_kerja" <?php echo $gaji_tk_list->lama_kerja->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_lama_kerja">
<span<?php echo $gaji_tk_list->lama_kerja->viewAttributes() ?>><?php echo $gaji_tk_list->lama_kerja->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->jenis_guru->Visible) { // jenis_guru ?>
		<td data-name="jenis_guru" <?php echo $gaji_tk_list->jenis_guru->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_jenis_guru">
<span<?php echo $gaji_tk_list->jenis_guru->viewAttributes() ?>><?php echo $gaji_tk_list->jenis_guru->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->tambahan->Visible) { // tambahan ?>
		<td data-name="tambahan" <?php echo $gaji_tk_list->tambahan->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_tambahan">
<span<?php echo $gaji_tk_list->tambahan->viewAttributes() ?>><?php echo $gaji_tk_list->tambahan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->periode->Visible) { // periode ?>
		<td data-name="periode" <?php echo $gaji_tk_list->periode->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_periode">
<span<?php echo $gaji_tk_list->periode->viewAttributes() ?>><?php echo $gaji_tk_list->periode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->tunjangan_periode->Visible) { // tunjangan_periode ?>
		<td data-name="tunjangan_periode" <?php echo $gaji_tk_list->tunjangan_periode->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_tunjangan_periode">
<span<?php echo $gaji_tk_list->tunjangan_periode->viewAttributes() ?>><?php echo $gaji_tk_list->tunjangan_periode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran" <?php echo $gaji_tk_list->kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_kehadiran">
<span<?php echo $gaji_tk_list->kehadiran->viewAttributes() ?>><?php echo $gaji_tk_list->kehadiran->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->value_kehadiran->Visible) { // value_kehadiran ?>
		<td data-name="value_kehadiran" <?php echo $gaji_tk_list->value_kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_value_kehadiran">
<span<?php echo $gaji_tk_list->value_kehadiran->viewAttributes() ?>><?php echo $gaji_tk_list->value_kehadiran->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->lembur->Visible) { // lembur ?>
		<td data-name="lembur" <?php echo $gaji_tk_list->lembur->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_lembur">
<span<?php echo $gaji_tk_list->lembur->viewAttributes() ?>><?php echo $gaji_tk_list->lembur->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->value_lembur->Visible) { // value_lembur ?>
		<td data-name="value_lembur" <?php echo $gaji_tk_list->value_lembur->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_value_lembur">
<span<?php echo $gaji_tk_list->value_lembur->viewAttributes() ?>><?php echo $gaji_tk_list->value_lembur->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->jp->Visible) { // jp ?>
		<td data-name="jp" <?php echo $gaji_tk_list->jp->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_jp">
<span<?php echo $gaji_tk_list->jp->viewAttributes() ?>><?php echo $gaji_tk_list->jp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->gapok->Visible) { // gapok ?>
		<td data-name="gapok" <?php echo $gaji_tk_list->gapok->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_gapok">
<span<?php echo $gaji_tk_list->gapok->viewAttributes() ?>><?php echo $gaji_tk_list->gapok->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->total_gapok->Visible) { // total_gapok ?>
		<td data-name="total_gapok" <?php echo $gaji_tk_list->total_gapok->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_total_gapok">
<span<?php echo $gaji_tk_list->total_gapok->viewAttributes() ?>><?php echo $gaji_tk_list->total_gapok->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->value_reward->Visible) { // value_reward ?>
		<td data-name="value_reward" <?php echo $gaji_tk_list->value_reward->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_value_reward">
<span<?php echo $gaji_tk_list->value_reward->viewAttributes() ?>><?php echo $gaji_tk_list->value_reward->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->value_inval->Visible) { // value_inval ?>
		<td data-name="value_inval" <?php echo $gaji_tk_list->value_inval->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_value_inval">
<span<?php echo $gaji_tk_list->value_inval->viewAttributes() ?>><?php echo $gaji_tk_list->value_inval->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->piket_count->Visible) { // piket_count ?>
		<td data-name="piket_count" <?php echo $gaji_tk_list->piket_count->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_piket_count">
<span<?php echo $gaji_tk_list->piket_count->viewAttributes() ?>><?php echo $gaji_tk_list->piket_count->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->value_piket->Visible) { // value_piket ?>
		<td data-name="value_piket" <?php echo $gaji_tk_list->value_piket->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_value_piket">
<span<?php echo $gaji_tk_list->value_piket->viewAttributes() ?>><?php echo $gaji_tk_list->value_piket->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->tugastambahan->Visible) { // tugastambahan ?>
		<td data-name="tugastambahan" <?php echo $gaji_tk_list->tugastambahan->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_tugastambahan">
<span<?php echo $gaji_tk_list->tugastambahan->viewAttributes() ?>><?php echo $gaji_tk_list->tugastambahan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->tj_jabatan->Visible) { // tj_jabatan ?>
		<td data-name="tj_jabatan" <?php echo $gaji_tk_list->tj_jabatan->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_tj_jabatan">
<span<?php echo $gaji_tk_list->tj_jabatan->viewAttributes() ?>><?php echo $gaji_tk_list->tj_jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->sub_total->Visible) { // sub_total ?>
		<td data-name="sub_total" <?php echo $gaji_tk_list->sub_total->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_sub_total">
<span<?php echo $gaji_tk_list->sub_total->viewAttributes() ?>><?php echo $gaji_tk_list->sub_total->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->potongan->Visible) { // potongan ?>
		<td data-name="potongan" <?php echo $gaji_tk_list->potongan->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_potongan">
<span<?php echo $gaji_tk_list->potongan->viewAttributes() ?>><?php echo $gaji_tk_list->potongan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->penyesuaian->Visible) { // penyesuaian ?>
		<td data-name="penyesuaian" <?php echo $gaji_tk_list->penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_penyesuaian">
<span<?php echo $gaji_tk_list->penyesuaian->viewAttributes() ?>><?php echo $gaji_tk_list->penyesuaian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_tk_list->total->Visible) { // total ?>
		<td data-name="total" <?php echo $gaji_tk_list->total->cellAttributes() ?>>
<span id="el<?php echo $gaji_tk_list->RowCount ?>_gaji_tk_total">
<span<?php echo $gaji_tk_list->total->viewAttributes() ?>><?php echo $gaji_tk_list->total->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gaji_tk_list->ListOptions->render("body", "right", $gaji_tk_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gaji_tk_list->isGridAdd())
		$gaji_tk_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gaji_tk->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gaji_tk_list->Recordset)
	$gaji_tk_list->Recordset->Close();
?>
<?php if (!$gaji_tk_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gaji_tk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gaji_tk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gaji_tk_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gaji_tk_list->TotalRecords == 0 && !$gaji_tk->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gaji_tk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gaji_tk_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gaji_tk_list->isExport()) { ?>
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
$gaji_tk_list->terminate();
?>