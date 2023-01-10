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
$gaji_karyawan_smp_list = new gaji_karyawan_smp_list();

// Run the page
$gaji_karyawan_smp_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_karyawan_smp_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gaji_karyawan_smp_list->isExport()) { ?>
<script>
var fgaji_karyawan_smplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgaji_karyawan_smplist = currentForm = new ew.Form("fgaji_karyawan_smplist", "list");
	fgaji_karyawan_smplist.formKeyCountName = '<?php echo $gaji_karyawan_smp_list->FormKeyCountName ?>';
	loadjs.done("fgaji_karyawan_smplist");
});
var fgaji_karyawan_smplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fgaji_karyawan_smplistsrch = currentSearchForm = new ew.Form("fgaji_karyawan_smplistsrch");

	// Dynamic selection lists
	// Filters

	fgaji_karyawan_smplistsrch.filterList = <?php echo $gaji_karyawan_smp_list->getFilterList() ?>;
	loadjs.done("fgaji_karyawan_smplistsrch");
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
<?php if (!$gaji_karyawan_smp_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gaji_karyawan_smp_list->TotalRecords > 0 && $gaji_karyawan_smp_list->ExportOptions->visible()) { ?>
<?php $gaji_karyawan_smp_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->ImportOptions->visible()) { ?>
<?php $gaji_karyawan_smp_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->SearchOptions->visible()) { ?>
<?php $gaji_karyawan_smp_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->FilterOptions->visible()) { ?>
<?php $gaji_karyawan_smp_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$gaji_karyawan_smp_list->isExport() || Config("EXPORT_MASTER_RECORD") && $gaji_karyawan_smp_list->isExport("print")) { ?>
<?php
if ($gaji_karyawan_smp_list->DbMasterFilter != "" && $gaji_karyawan_smp->getCurrentMasterTable() == "m_karyawan_smp") {
	if ($gaji_karyawan_smp_list->MasterRecordExists) {
		include_once "m_karyawan_smpmaster.php";
	}
}
?>
<?php } ?>
<?php
$gaji_karyawan_smp_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$gaji_karyawan_smp_list->isExport() && !$gaji_karyawan_smp->CurrentAction) { ?>
<form name="fgaji_karyawan_smplistsrch" id="fgaji_karyawan_smplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fgaji_karyawan_smplistsrch-search-panel" class="<?php echo $gaji_karyawan_smp_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="gaji_karyawan_smp">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $gaji_karyawan_smp_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($gaji_karyawan_smp_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($gaji_karyawan_smp_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $gaji_karyawan_smp_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($gaji_karyawan_smp_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($gaji_karyawan_smp_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($gaji_karyawan_smp_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($gaji_karyawan_smp_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $gaji_karyawan_smp_list->showPageHeader(); ?>
<?php
$gaji_karyawan_smp_list->showMessage();
?>
<?php if ($gaji_karyawan_smp_list->TotalRecords > 0 || $gaji_karyawan_smp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gaji_karyawan_smp_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gaji_karyawan_smp">
<?php if (!$gaji_karyawan_smp_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gaji_karyawan_smp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gaji_karyawan_smp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gaji_karyawan_smp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgaji_karyawan_smplist" id="fgaji_karyawan_smplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gaji_karyawan_smp">
<?php if ($gaji_karyawan_smp->getCurrentMasterTable() == "m_karyawan_smp" && $gaji_karyawan_smp->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="m_karyawan_smp">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_list->pid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_gaji_karyawan_smp" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gaji_karyawan_smp_list->TotalRecords > 0 || $gaji_karyawan_smp_list->isGridEdit()) { ?>
<table id="tbl_gaji_karyawan_smplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gaji_karyawan_smp->RowType = ROWTYPE_HEADER;

// Render list options
$gaji_karyawan_smp_list->renderListOptions();

// Render list options (header, left)
$gaji_karyawan_smp_list->ListOptions->render("header", "left");
?>
<?php if ($gaji_karyawan_smp_list->pegawai->Visible) { // pegawai ?>
	<?php if ($gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $gaji_karyawan_smp_list->pegawai->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_pegawai" class="gaji_karyawan_smp_pegawai"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $gaji_karyawan_smp_list->pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->pegawai) ?>', 1);"><div id="elh_gaji_karyawan_smp_pegawai" class="gaji_karyawan_smp_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_list->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_list->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->jenjang_id->Visible) { // jenjang_id ?>
	<?php if ($gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->jenjang_id) == "") { ?>
		<th data-name="jenjang_id" class="<?php echo $gaji_karyawan_smp_list->jenjang_id->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_jenjang_id" class="gaji_karyawan_smp_jenjang_id"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->jenjang_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang_id" class="<?php echo $gaji_karyawan_smp_list->jenjang_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->jenjang_id) ?>', 1);"><div id="elh_gaji_karyawan_smp_jenjang_id" class="gaji_karyawan_smp_jenjang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->jenjang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_list->jenjang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_list->jenjang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->jabatan_id) == "") { ?>
		<th data-name="jabatan_id" class="<?php echo $gaji_karyawan_smp_list->jabatan_id->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_jabatan_id" class="gaji_karyawan_smp_jabatan_id"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->jabatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan_id" class="<?php echo $gaji_karyawan_smp_list->jabatan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->jabatan_id) ?>', 1);"><div id="elh_gaji_karyawan_smp_jabatan_id" class="gaji_karyawan_smp_jabatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_list->jabatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_list->jabatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->kehadiran->Visible) { // kehadiran ?>
	<?php if ($gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->kehadiran) == "") { ?>
		<th data-name="kehadiran" class="<?php echo $gaji_karyawan_smp_list->kehadiran->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_kehadiran" class="gaji_karyawan_smp_kehadiran"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->kehadiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kehadiran" class="<?php echo $gaji_karyawan_smp_list->kehadiran->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->kehadiran) ?>', 1);"><div id="elh_gaji_karyawan_smp_kehadiran" class="gaji_karyawan_smp_kehadiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_list->kehadiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_list->kehadiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->gapok->Visible) { // gapok ?>
	<?php if ($gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->gapok) == "") { ?>
		<th data-name="gapok" class="<?php echo $gaji_karyawan_smp_list->gapok->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_gapok" class="gaji_karyawan_smp_gapok"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->gapok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gapok" class="<?php echo $gaji_karyawan_smp_list->gapok->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->gapok) ?>', 1);"><div id="elh_gaji_karyawan_smp_gapok" class="gaji_karyawan_smp_gapok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->gapok->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_list->gapok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_list->gapok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->value_reward->Visible) { // value_reward ?>
	<?php if ($gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->value_reward) == "") { ?>
		<th data-name="value_reward" class="<?php echo $gaji_karyawan_smp_list->value_reward->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_value_reward" class="gaji_karyawan_smp_value_reward"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->value_reward->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_reward" class="<?php echo $gaji_karyawan_smp_list->value_reward->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->value_reward) ?>', 1);"><div id="elh_gaji_karyawan_smp_value_reward" class="gaji_karyawan_smp_value_reward">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->value_reward->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_list->value_reward->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_list->value_reward->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->value_inval->Visible) { // value_inval ?>
	<?php if ($gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->value_inval) == "") { ?>
		<th data-name="value_inval" class="<?php echo $gaji_karyawan_smp_list->value_inval->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_value_inval" class="gaji_karyawan_smp_value_inval"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->value_inval->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_inval" class="<?php echo $gaji_karyawan_smp_list->value_inval->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->value_inval) ?>', 1);"><div id="elh_gaji_karyawan_smp_value_inval" class="gaji_karyawan_smp_value_inval">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->value_inval->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_list->value_inval->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_list->value_inval->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->sub_total->Visible) { // sub_total ?>
	<?php if ($gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->sub_total) == "") { ?>
		<th data-name="sub_total" class="<?php echo $gaji_karyawan_smp_list->sub_total->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_sub_total" class="gaji_karyawan_smp_sub_total"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->sub_total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sub_total" class="<?php echo $gaji_karyawan_smp_list->sub_total->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->sub_total) ?>', 1);"><div id="elh_gaji_karyawan_smp_sub_total" class="gaji_karyawan_smp_sub_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->sub_total->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_list->sub_total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_list->sub_total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->potongan->Visible) { // potongan ?>
	<?php if ($gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->potongan) == "") { ?>
		<th data-name="potongan" class="<?php echo $gaji_karyawan_smp_list->potongan->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_potongan" class="gaji_karyawan_smp_potongan"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->potongan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan" class="<?php echo $gaji_karyawan_smp_list->potongan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->potongan) ?>', 1);"><div id="elh_gaji_karyawan_smp_potongan" class="gaji_karyawan_smp_potongan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->potongan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_list->potongan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_list->potongan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->penyesuaian->Visible) { // penyesuaian ?>
	<?php if ($gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->penyesuaian) == "") { ?>
		<th data-name="penyesuaian" class="<?php echo $gaji_karyawan_smp_list->penyesuaian->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_penyesuaian" class="gaji_karyawan_smp_penyesuaian"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="penyesuaian" class="<?php echo $gaji_karyawan_smp_list->penyesuaian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->penyesuaian) ?>', 1);"><div id="elh_gaji_karyawan_smp_penyesuaian" class="gaji_karyawan_smp_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_list->penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_list->penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->total->Visible) { // total ?>
	<?php if ($gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->total) == "") { ?>
		<th data-name="total" class="<?php echo $gaji_karyawan_smp_list->total->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_total" class="gaji_karyawan_smp_total"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $gaji_karyawan_smp_list->total->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->total) ?>', 1);"><div id="elh_gaji_karyawan_smp_total" class="gaji_karyawan_smp_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_list->total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_list->total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->pid->Visible) { // pid ?>
	<?php if ($gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->pid) == "") { ?>
		<th data-name="pid" class="<?php echo $gaji_karyawan_smp_list->pid->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_pid" class="gaji_karyawan_smp_pid"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->pid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid" class="<?php echo $gaji_karyawan_smp_list->pid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->pid) ?>', 1);"><div id="elh_gaji_karyawan_smp_pid" class="gaji_karyawan_smp_pid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_list->pid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_list->pid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_list->jp->Visible) { // jp ?>
	<?php if ($gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->jp) == "") { ?>
		<th data-name="jp" class="<?php echo $gaji_karyawan_smp_list->jp->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_jp" class="gaji_karyawan_smp_jp"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->jp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jp" class="<?php echo $gaji_karyawan_smp_list->jp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_karyawan_smp_list->SortUrl($gaji_karyawan_smp_list->jp) ?>', 1);"><div id="elh_gaji_karyawan_smp_jp" class="gaji_karyawan_smp_jp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_list->jp->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_list->jp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_list->jp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gaji_karyawan_smp_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gaji_karyawan_smp_list->ExportAll && $gaji_karyawan_smp_list->isExport()) {
	$gaji_karyawan_smp_list->StopRecord = $gaji_karyawan_smp_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gaji_karyawan_smp_list->TotalRecords > $gaji_karyawan_smp_list->StartRecord + $gaji_karyawan_smp_list->DisplayRecords - 1)
		$gaji_karyawan_smp_list->StopRecord = $gaji_karyawan_smp_list->StartRecord + $gaji_karyawan_smp_list->DisplayRecords - 1;
	else
		$gaji_karyawan_smp_list->StopRecord = $gaji_karyawan_smp_list->TotalRecords;
}
$gaji_karyawan_smp_list->RecordCount = $gaji_karyawan_smp_list->StartRecord - 1;
if ($gaji_karyawan_smp_list->Recordset && !$gaji_karyawan_smp_list->Recordset->EOF) {
	$gaji_karyawan_smp_list->Recordset->moveFirst();
	$selectLimit = $gaji_karyawan_smp_list->UseSelectLimit;
	if (!$selectLimit && $gaji_karyawan_smp_list->StartRecord > 1)
		$gaji_karyawan_smp_list->Recordset->move($gaji_karyawan_smp_list->StartRecord - 1);
} elseif (!$gaji_karyawan_smp->AllowAddDeleteRow && $gaji_karyawan_smp_list->StopRecord == 0) {
	$gaji_karyawan_smp_list->StopRecord = $gaji_karyawan_smp->GridAddRowCount;
}

// Initialize aggregate
$gaji_karyawan_smp->RowType = ROWTYPE_AGGREGATEINIT;
$gaji_karyawan_smp->resetAttributes();
$gaji_karyawan_smp_list->renderRow();
while ($gaji_karyawan_smp_list->RecordCount < $gaji_karyawan_smp_list->StopRecord) {
	$gaji_karyawan_smp_list->RecordCount++;
	if ($gaji_karyawan_smp_list->RecordCount >= $gaji_karyawan_smp_list->StartRecord) {
		$gaji_karyawan_smp_list->RowCount++;

		// Set up key count
		$gaji_karyawan_smp_list->KeyCount = $gaji_karyawan_smp_list->RowIndex;

		// Init row class and style
		$gaji_karyawan_smp->resetAttributes();
		$gaji_karyawan_smp->CssClass = "";
		if ($gaji_karyawan_smp_list->isGridAdd()) {
		} else {
			$gaji_karyawan_smp_list->loadRowValues($gaji_karyawan_smp_list->Recordset); // Load row values
		}
		$gaji_karyawan_smp->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gaji_karyawan_smp->RowAttrs->merge(["data-rowindex" => $gaji_karyawan_smp_list->RowCount, "id" => "r" . $gaji_karyawan_smp_list->RowCount . "_gaji_karyawan_smp", "data-rowtype" => $gaji_karyawan_smp->RowType]);

		// Render row
		$gaji_karyawan_smp_list->renderRow();

		// Render list options
		$gaji_karyawan_smp_list->renderListOptions();
?>
	<tr <?php echo $gaji_karyawan_smp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gaji_karyawan_smp_list->ListOptions->render("body", "left", $gaji_karyawan_smp_list->RowCount);
?>
	<?php if ($gaji_karyawan_smp_list->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $gaji_karyawan_smp_list->pegawai->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_list->RowCount ?>_gaji_karyawan_smp_pegawai">
<span<?php echo $gaji_karyawan_smp_list->pegawai->viewAttributes() ?>><?php echo $gaji_karyawan_smp_list->pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_list->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id" <?php echo $gaji_karyawan_smp_list->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_list->RowCount ?>_gaji_karyawan_smp_jenjang_id">
<span<?php echo $gaji_karyawan_smp_list->jenjang_id->viewAttributes() ?>><?php echo $gaji_karyawan_smp_list->jenjang_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_list->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id" <?php echo $gaji_karyawan_smp_list->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_list->RowCount ?>_gaji_karyawan_smp_jabatan_id">
<span<?php echo $gaji_karyawan_smp_list->jabatan_id->viewAttributes() ?>><?php echo $gaji_karyawan_smp_list->jabatan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_list->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran" <?php echo $gaji_karyawan_smp_list->kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_list->RowCount ?>_gaji_karyawan_smp_kehadiran">
<span<?php echo $gaji_karyawan_smp_list->kehadiran->viewAttributes() ?>><?php echo $gaji_karyawan_smp_list->kehadiran->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_list->gapok->Visible) { // gapok ?>
		<td data-name="gapok" <?php echo $gaji_karyawan_smp_list->gapok->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_list->RowCount ?>_gaji_karyawan_smp_gapok">
<span<?php echo $gaji_karyawan_smp_list->gapok->viewAttributes() ?>><?php echo $gaji_karyawan_smp_list->gapok->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_list->value_reward->Visible) { // value_reward ?>
		<td data-name="value_reward" <?php echo $gaji_karyawan_smp_list->value_reward->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_list->RowCount ?>_gaji_karyawan_smp_value_reward">
<span<?php echo $gaji_karyawan_smp_list->value_reward->viewAttributes() ?>><?php echo $gaji_karyawan_smp_list->value_reward->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_list->value_inval->Visible) { // value_inval ?>
		<td data-name="value_inval" <?php echo $gaji_karyawan_smp_list->value_inval->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_list->RowCount ?>_gaji_karyawan_smp_value_inval">
<span<?php echo $gaji_karyawan_smp_list->value_inval->viewAttributes() ?>><?php echo $gaji_karyawan_smp_list->value_inval->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_list->sub_total->Visible) { // sub_total ?>
		<td data-name="sub_total" <?php echo $gaji_karyawan_smp_list->sub_total->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_list->RowCount ?>_gaji_karyawan_smp_sub_total">
<span<?php echo $gaji_karyawan_smp_list->sub_total->viewAttributes() ?>><?php echo $gaji_karyawan_smp_list->sub_total->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_list->potongan->Visible) { // potongan ?>
		<td data-name="potongan" <?php echo $gaji_karyawan_smp_list->potongan->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_list->RowCount ?>_gaji_karyawan_smp_potongan">
<span<?php echo $gaji_karyawan_smp_list->potongan->viewAttributes() ?>><?php echo $gaji_karyawan_smp_list->potongan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_list->penyesuaian->Visible) { // penyesuaian ?>
		<td data-name="penyesuaian" <?php echo $gaji_karyawan_smp_list->penyesuaian->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_list->RowCount ?>_gaji_karyawan_smp_penyesuaian">
<span<?php echo $gaji_karyawan_smp_list->penyesuaian->viewAttributes() ?>><?php echo $gaji_karyawan_smp_list->penyesuaian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_list->total->Visible) { // total ?>
		<td data-name="total" <?php echo $gaji_karyawan_smp_list->total->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_list->RowCount ?>_gaji_karyawan_smp_total">
<span<?php echo $gaji_karyawan_smp_list->total->viewAttributes() ?>><?php echo $gaji_karyawan_smp_list->total->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_list->pid->Visible) { // pid ?>
		<td data-name="pid" <?php echo $gaji_karyawan_smp_list->pid->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_list->RowCount ?>_gaji_karyawan_smp_pid">
<span<?php echo $gaji_karyawan_smp_list->pid->viewAttributes() ?>><?php echo $gaji_karyawan_smp_list->pid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_list->jp->Visible) { // jp ?>
		<td data-name="jp" <?php echo $gaji_karyawan_smp_list->jp->cellAttributes() ?>>
<span id="el<?php echo $gaji_karyawan_smp_list->RowCount ?>_gaji_karyawan_smp_jp">
<span<?php echo $gaji_karyawan_smp_list->jp->viewAttributes() ?>><?php echo $gaji_karyawan_smp_list->jp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gaji_karyawan_smp_list->ListOptions->render("body", "right", $gaji_karyawan_smp_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gaji_karyawan_smp_list->isGridAdd())
		$gaji_karyawan_smp_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gaji_karyawan_smp->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gaji_karyawan_smp_list->Recordset)
	$gaji_karyawan_smp_list->Recordset->Close();
?>
<?php if (!$gaji_karyawan_smp_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gaji_karyawan_smp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gaji_karyawan_smp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gaji_karyawan_smp_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gaji_karyawan_smp_list->TotalRecords == 0 && !$gaji_karyawan_smp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gaji_karyawan_smp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gaji_karyawan_smp_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gaji_karyawan_smp_list->isExport()) { ?>
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
$gaji_karyawan_smp_list->terminate();
?>