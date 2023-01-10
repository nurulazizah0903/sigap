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
$peg_dokumen_list = new peg_dokumen_list();

// Run the page
$peg_dokumen_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_dokumen_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$peg_dokumen_list->isExport()) { ?>
<script>
var fpeg_dokumenlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpeg_dokumenlist = currentForm = new ew.Form("fpeg_dokumenlist", "list");
	fpeg_dokumenlist.formKeyCountName = '<?php echo $peg_dokumen_list->FormKeyCountName ?>';
	loadjs.done("fpeg_dokumenlist");
});
var fpeg_dokumenlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpeg_dokumenlistsrch = currentSearchForm = new ew.Form("fpeg_dokumenlistsrch");

	// Dynamic selection lists
	// Filters

	fpeg_dokumenlistsrch.filterList = <?php echo $peg_dokumen_list->getFilterList() ?>;
	loadjs.done("fpeg_dokumenlistsrch");
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
<?php if (!$peg_dokumen_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($peg_dokumen_list->TotalRecords > 0 && $peg_dokumen_list->ExportOptions->visible()) { ?>
<?php $peg_dokumen_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($peg_dokumen_list->ImportOptions->visible()) { ?>
<?php $peg_dokumen_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($peg_dokumen_list->SearchOptions->visible()) { ?>
<?php $peg_dokumen_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($peg_dokumen_list->FilterOptions->visible()) { ?>
<?php $peg_dokumen_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$peg_dokumen_list->isExport() || Config("EXPORT_MASTER_RECORD") && $peg_dokumen_list->isExport("print")) { ?>
<?php
if ($peg_dokumen_list->DbMasterFilter != "" && $peg_dokumen->getCurrentMasterTable() == "pegawai") {
	if ($peg_dokumen_list->MasterRecordExists) {
		include_once "pegawaimaster.php";
	}
}
?>
<?php } ?>
<?php
$peg_dokumen_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$peg_dokumen_list->isExport() && !$peg_dokumen->CurrentAction) { ?>
<form name="fpeg_dokumenlistsrch" id="fpeg_dokumenlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpeg_dokumenlistsrch-search-panel" class="<?php echo $peg_dokumen_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="peg_dokumen">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $peg_dokumen_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($peg_dokumen_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($peg_dokumen_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $peg_dokumen_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($peg_dokumen_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($peg_dokumen_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($peg_dokumen_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($peg_dokumen_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $peg_dokumen_list->showPageHeader(); ?>
<?php
$peg_dokumen_list->showMessage();
?>
<?php if ($peg_dokumen_list->TotalRecords > 0 || $peg_dokumen->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($peg_dokumen_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> peg_dokumen">
<?php if (!$peg_dokumen_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$peg_dokumen_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $peg_dokumen_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $peg_dokumen_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpeg_dokumenlist" id="fpeg_dokumenlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="peg_dokumen">
<?php if ($peg_dokumen->getCurrentMasterTable() == "pegawai" && $peg_dokumen->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="pegawai">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($peg_dokumen_list->pid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_peg_dokumen" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($peg_dokumen_list->TotalRecords > 0 || $peg_dokumen_list->isGridEdit()) { ?>
<table id="tbl_peg_dokumenlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$peg_dokumen->RowType = ROWTYPE_HEADER;

// Render list options
$peg_dokumen_list->renderListOptions();

// Render list options (header, left)
$peg_dokumen_list->ListOptions->render("header", "left");
?>
<?php if ($peg_dokumen_list->id->Visible) { // id ?>
	<?php if ($peg_dokumen_list->SortUrl($peg_dokumen_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $peg_dokumen_list->id->headerCellClass() ?>"><div id="elh_peg_dokumen_id" class="peg_dokumen_id"><div class="ew-table-header-caption"><?php echo $peg_dokumen_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $peg_dokumen_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_dokumen_list->SortUrl($peg_dokumen_list->id) ?>', 1);"><div id="elh_peg_dokumen_id" class="peg_dokumen_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_list->pid->Visible) { // pid ?>
	<?php if ($peg_dokumen_list->SortUrl($peg_dokumen_list->pid) == "") { ?>
		<th data-name="pid" class="<?php echo $peg_dokumen_list->pid->headerCellClass() ?>"><div id="elh_peg_dokumen_pid" class="peg_dokumen_pid"><div class="ew-table-header-caption"><?php echo $peg_dokumen_list->pid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid" class="<?php echo $peg_dokumen_list->pid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_dokumen_list->SortUrl($peg_dokumen_list->pid) ?>', 1);"><div id="elh_peg_dokumen_pid" class="peg_dokumen_pid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_list->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_list->pid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_list->pid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_list->nama_dokumen->Visible) { // nama_dokumen ?>
	<?php if ($peg_dokumen_list->SortUrl($peg_dokumen_list->nama_dokumen) == "") { ?>
		<th data-name="nama_dokumen" class="<?php echo $peg_dokumen_list->nama_dokumen->headerCellClass() ?>"><div id="elh_peg_dokumen_nama_dokumen" class="peg_dokumen_nama_dokumen"><div class="ew-table-header-caption"><?php echo $peg_dokumen_list->nama_dokumen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_dokumen" class="<?php echo $peg_dokumen_list->nama_dokumen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_dokumen_list->SortUrl($peg_dokumen_list->nama_dokumen) ?>', 1);"><div id="elh_peg_dokumen_nama_dokumen" class="peg_dokumen_nama_dokumen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_list->nama_dokumen->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_list->nama_dokumen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_list->nama_dokumen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_list->file_dokumen->Visible) { // file_dokumen ?>
	<?php if ($peg_dokumen_list->SortUrl($peg_dokumen_list->file_dokumen) == "") { ?>
		<th data-name="file_dokumen" class="<?php echo $peg_dokumen_list->file_dokumen->headerCellClass() ?>"><div id="elh_peg_dokumen_file_dokumen" class="peg_dokumen_file_dokumen"><div class="ew-table-header-caption"><?php echo $peg_dokumen_list->file_dokumen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="file_dokumen" class="<?php echo $peg_dokumen_list->file_dokumen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_dokumen_list->SortUrl($peg_dokumen_list->file_dokumen) ?>', 1);"><div id="elh_peg_dokumen_file_dokumen" class="peg_dokumen_file_dokumen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_list->file_dokumen->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_list->file_dokumen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_list->file_dokumen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_list->keterangan->Visible) { // keterangan ?>
	<?php if ($peg_dokumen_list->SortUrl($peg_dokumen_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $peg_dokumen_list->keterangan->headerCellClass() ?>"><div id="elh_peg_dokumen_keterangan" class="peg_dokumen_keterangan"><div class="ew-table-header-caption"><?php echo $peg_dokumen_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $peg_dokumen_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_dokumen_list->SortUrl($peg_dokumen_list->keterangan) ?>', 1);"><div id="elh_peg_dokumen_keterangan" class="peg_dokumen_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_list->c_date->Visible) { // c_date ?>
	<?php if ($peg_dokumen_list->SortUrl($peg_dokumen_list->c_date) == "") { ?>
		<th data-name="c_date" class="<?php echo $peg_dokumen_list->c_date->headerCellClass() ?>"><div id="elh_peg_dokumen_c_date" class="peg_dokumen_c_date"><div class="ew-table-header-caption"><?php echo $peg_dokumen_list->c_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="c_date" class="<?php echo $peg_dokumen_list->c_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_dokumen_list->SortUrl($peg_dokumen_list->c_date) ?>', 1);"><div id="elh_peg_dokumen_c_date" class="peg_dokumen_c_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_list->c_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_list->c_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_list->c_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_list->u_date->Visible) { // u_date ?>
	<?php if ($peg_dokumen_list->SortUrl($peg_dokumen_list->u_date) == "") { ?>
		<th data-name="u_date" class="<?php echo $peg_dokumen_list->u_date->headerCellClass() ?>"><div id="elh_peg_dokumen_u_date" class="peg_dokumen_u_date"><div class="ew-table-header-caption"><?php echo $peg_dokumen_list->u_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="u_date" class="<?php echo $peg_dokumen_list->u_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_dokumen_list->SortUrl($peg_dokumen_list->u_date) ?>', 1);"><div id="elh_peg_dokumen_u_date" class="peg_dokumen_u_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_list->u_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_list->u_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_list->u_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_list->c_by->Visible) { // c_by ?>
	<?php if ($peg_dokumen_list->SortUrl($peg_dokumen_list->c_by) == "") { ?>
		<th data-name="c_by" class="<?php echo $peg_dokumen_list->c_by->headerCellClass() ?>"><div id="elh_peg_dokumen_c_by" class="peg_dokumen_c_by"><div class="ew-table-header-caption"><?php echo $peg_dokumen_list->c_by->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="c_by" class="<?php echo $peg_dokumen_list->c_by->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_dokumen_list->SortUrl($peg_dokumen_list->c_by) ?>', 1);"><div id="elh_peg_dokumen_c_by" class="peg_dokumen_c_by">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_list->c_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_list->c_by->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_list->c_by->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_list->u_by->Visible) { // u_by ?>
	<?php if ($peg_dokumen_list->SortUrl($peg_dokumen_list->u_by) == "") { ?>
		<th data-name="u_by" class="<?php echo $peg_dokumen_list->u_by->headerCellClass() ?>"><div id="elh_peg_dokumen_u_by" class="peg_dokumen_u_by"><div class="ew-table-header-caption"><?php echo $peg_dokumen_list->u_by->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="u_by" class="<?php echo $peg_dokumen_list->u_by->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_dokumen_list->SortUrl($peg_dokumen_list->u_by) ?>', 1);"><div id="elh_peg_dokumen_u_by" class="peg_dokumen_u_by">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_list->u_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_list->u_by->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_list->u_by->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$peg_dokumen_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($peg_dokumen_list->ExportAll && $peg_dokumen_list->isExport()) {
	$peg_dokumen_list->StopRecord = $peg_dokumen_list->TotalRecords;
} else {

	// Set the last record to display
	if ($peg_dokumen_list->TotalRecords > $peg_dokumen_list->StartRecord + $peg_dokumen_list->DisplayRecords - 1)
		$peg_dokumen_list->StopRecord = $peg_dokumen_list->StartRecord + $peg_dokumen_list->DisplayRecords - 1;
	else
		$peg_dokumen_list->StopRecord = $peg_dokumen_list->TotalRecords;
}
$peg_dokumen_list->RecordCount = $peg_dokumen_list->StartRecord - 1;
if ($peg_dokumen_list->Recordset && !$peg_dokumen_list->Recordset->EOF) {
	$peg_dokumen_list->Recordset->moveFirst();
	$selectLimit = $peg_dokumen_list->UseSelectLimit;
	if (!$selectLimit && $peg_dokumen_list->StartRecord > 1)
		$peg_dokumen_list->Recordset->move($peg_dokumen_list->StartRecord - 1);
} elseif (!$peg_dokumen->AllowAddDeleteRow && $peg_dokumen_list->StopRecord == 0) {
	$peg_dokumen_list->StopRecord = $peg_dokumen->GridAddRowCount;
}

// Initialize aggregate
$peg_dokumen->RowType = ROWTYPE_AGGREGATEINIT;
$peg_dokumen->resetAttributes();
$peg_dokumen_list->renderRow();
while ($peg_dokumen_list->RecordCount < $peg_dokumen_list->StopRecord) {
	$peg_dokumen_list->RecordCount++;
	if ($peg_dokumen_list->RecordCount >= $peg_dokumen_list->StartRecord) {
		$peg_dokumen_list->RowCount++;

		// Set up key count
		$peg_dokumen_list->KeyCount = $peg_dokumen_list->RowIndex;

		// Init row class and style
		$peg_dokumen->resetAttributes();
		$peg_dokumen->CssClass = "";
		if ($peg_dokumen_list->isGridAdd()) {
		} else {
			$peg_dokumen_list->loadRowValues($peg_dokumen_list->Recordset); // Load row values
		}
		$peg_dokumen->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$peg_dokumen->RowAttrs->merge(["data-rowindex" => $peg_dokumen_list->RowCount, "id" => "r" . $peg_dokumen_list->RowCount . "_peg_dokumen", "data-rowtype" => $peg_dokumen->RowType]);

		// Render row
		$peg_dokumen_list->renderRow();

		// Render list options
		$peg_dokumen_list->renderListOptions();
?>
	<tr <?php echo $peg_dokumen->rowAttributes() ?>>
<?php

// Render list options (body, left)
$peg_dokumen_list->ListOptions->render("body", "left", $peg_dokumen_list->RowCount);
?>
	<?php if ($peg_dokumen_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $peg_dokumen_list->id->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_list->RowCount ?>_peg_dokumen_id">
<span<?php echo $peg_dokumen_list->id->viewAttributes() ?>><?php echo $peg_dokumen_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_list->pid->Visible) { // pid ?>
		<td data-name="pid" <?php echo $peg_dokumen_list->pid->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_list->RowCount ?>_peg_dokumen_pid">
<span<?php echo $peg_dokumen_list->pid->viewAttributes() ?>><?php echo $peg_dokumen_list->pid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_list->nama_dokumen->Visible) { // nama_dokumen ?>
		<td data-name="nama_dokumen" <?php echo $peg_dokumen_list->nama_dokumen->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_list->RowCount ?>_peg_dokumen_nama_dokumen">
<span<?php echo $peg_dokumen_list->nama_dokumen->viewAttributes() ?>><?php echo $peg_dokumen_list->nama_dokumen->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_list->file_dokumen->Visible) { // file_dokumen ?>
		<td data-name="file_dokumen" <?php echo $peg_dokumen_list->file_dokumen->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_list->RowCount ?>_peg_dokumen_file_dokumen">
<span<?php echo $peg_dokumen_list->file_dokumen->viewAttributes() ?>><?php echo $peg_dokumen_list->file_dokumen->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $peg_dokumen_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_list->RowCount ?>_peg_dokumen_keterangan">
<span<?php echo $peg_dokumen_list->keterangan->viewAttributes() ?>><?php echo $peg_dokumen_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_list->c_date->Visible) { // c_date ?>
		<td data-name="c_date" <?php echo $peg_dokumen_list->c_date->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_list->RowCount ?>_peg_dokumen_c_date">
<span<?php echo $peg_dokumen_list->c_date->viewAttributes() ?>><?php echo $peg_dokumen_list->c_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_list->u_date->Visible) { // u_date ?>
		<td data-name="u_date" <?php echo $peg_dokumen_list->u_date->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_list->RowCount ?>_peg_dokumen_u_date">
<span<?php echo $peg_dokumen_list->u_date->viewAttributes() ?>><?php echo $peg_dokumen_list->u_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_list->c_by->Visible) { // c_by ?>
		<td data-name="c_by" <?php echo $peg_dokumen_list->c_by->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_list->RowCount ?>_peg_dokumen_c_by">
<span<?php echo $peg_dokumen_list->c_by->viewAttributes() ?>><?php echo $peg_dokumen_list->c_by->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_list->u_by->Visible) { // u_by ?>
		<td data-name="u_by" <?php echo $peg_dokumen_list->u_by->cellAttributes() ?>>
<span id="el<?php echo $peg_dokumen_list->RowCount ?>_peg_dokumen_u_by">
<span<?php echo $peg_dokumen_list->u_by->viewAttributes() ?>><?php echo $peg_dokumen_list->u_by->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$peg_dokumen_list->ListOptions->render("body", "right", $peg_dokumen_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$peg_dokumen_list->isGridAdd())
		$peg_dokumen_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$peg_dokumen->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($peg_dokumen_list->Recordset)
	$peg_dokumen_list->Recordset->Close();
?>
<?php if (!$peg_dokumen_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$peg_dokumen_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $peg_dokumen_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $peg_dokumen_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($peg_dokumen_list->TotalRecords == 0 && !$peg_dokumen->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $peg_dokumen_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$peg_dokumen_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$peg_dokumen_list->isExport()) { ?>
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
$peg_dokumen_list->terminate();
?>