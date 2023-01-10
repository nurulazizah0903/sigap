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
$peg_keluarga_list = new peg_keluarga_list();

// Run the page
$peg_keluarga_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_keluarga_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$peg_keluarga_list->isExport()) { ?>
<script>
var fpeg_keluargalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpeg_keluargalist = currentForm = new ew.Form("fpeg_keluargalist", "list");
	fpeg_keluargalist.formKeyCountName = '<?php echo $peg_keluarga_list->FormKeyCountName ?>';
	loadjs.done("fpeg_keluargalist");
});
var fpeg_keluargalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpeg_keluargalistsrch = currentSearchForm = new ew.Form("fpeg_keluargalistsrch");

	// Dynamic selection lists
	// Filters

	fpeg_keluargalistsrch.filterList = <?php echo $peg_keluarga_list->getFilterList() ?>;
	loadjs.done("fpeg_keluargalistsrch");
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
<?php if (!$peg_keluarga_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($peg_keluarga_list->TotalRecords > 0 && $peg_keluarga_list->ExportOptions->visible()) { ?>
<?php $peg_keluarga_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($peg_keluarga_list->ImportOptions->visible()) { ?>
<?php $peg_keluarga_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($peg_keluarga_list->SearchOptions->visible()) { ?>
<?php $peg_keluarga_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($peg_keluarga_list->FilterOptions->visible()) { ?>
<?php $peg_keluarga_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$peg_keluarga_list->isExport() || Config("EXPORT_MASTER_RECORD") && $peg_keluarga_list->isExport("print")) { ?>
<?php
if ($peg_keluarga_list->DbMasterFilter != "" && $peg_keluarga->getCurrentMasterTable() == "pegawai") {
	if ($peg_keluarga_list->MasterRecordExists) {
		include_once "pegawaimaster.php";
	}
}
?>
<?php } ?>
<?php
$peg_keluarga_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$peg_keluarga_list->isExport() && !$peg_keluarga->CurrentAction) { ?>
<form name="fpeg_keluargalistsrch" id="fpeg_keluargalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpeg_keluargalistsrch-search-panel" class="<?php echo $peg_keluarga_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="peg_keluarga">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $peg_keluarga_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($peg_keluarga_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($peg_keluarga_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $peg_keluarga_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($peg_keluarga_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($peg_keluarga_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($peg_keluarga_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($peg_keluarga_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $peg_keluarga_list->showPageHeader(); ?>
<?php
$peg_keluarga_list->showMessage();
?>
<?php if ($peg_keluarga_list->TotalRecords > 0 || $peg_keluarga->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($peg_keluarga_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> peg_keluarga">
<?php if (!$peg_keluarga_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$peg_keluarga_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $peg_keluarga_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $peg_keluarga_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpeg_keluargalist" id="fpeg_keluargalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="peg_keluarga">
<?php if ($peg_keluarga->getCurrentMasterTable() == "pegawai" && $peg_keluarga->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="pegawai">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($peg_keluarga_list->pid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_peg_keluarga" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($peg_keluarga_list->TotalRecords > 0 || $peg_keluarga_list->isGridEdit()) { ?>
<table id="tbl_peg_keluargalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$peg_keluarga->RowType = ROWTYPE_HEADER;

// Render list options
$peg_keluarga_list->renderListOptions();

// Render list options (header, left)
$peg_keluarga_list->ListOptions->render("header", "left");
?>
<?php if ($peg_keluarga_list->id->Visible) { // id ?>
	<?php if ($peg_keluarga_list->SortUrl($peg_keluarga_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $peg_keluarga_list->id->headerCellClass() ?>"><div id="elh_peg_keluarga_id" class="peg_keluarga_id"><div class="ew-table-header-caption"><?php echo $peg_keluarga_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $peg_keluarga_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_keluarga_list->SortUrl($peg_keluarga_list->id) ?>', 1);"><div id="elh_peg_keluarga_id" class="peg_keluarga_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_list->pid->Visible) { // pid ?>
	<?php if ($peg_keluarga_list->SortUrl($peg_keluarga_list->pid) == "") { ?>
		<th data-name="pid" class="<?php echo $peg_keluarga_list->pid->headerCellClass() ?>"><div id="elh_peg_keluarga_pid" class="peg_keluarga_pid"><div class="ew-table-header-caption"><?php echo $peg_keluarga_list->pid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid" class="<?php echo $peg_keluarga_list->pid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_keluarga_list->SortUrl($peg_keluarga_list->pid) ?>', 1);"><div id="elh_peg_keluarga_pid" class="peg_keluarga_pid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_list->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_list->pid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_list->pid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_list->nama->Visible) { // nama ?>
	<?php if ($peg_keluarga_list->SortUrl($peg_keluarga_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $peg_keluarga_list->nama->headerCellClass() ?>"><div id="elh_peg_keluarga_nama" class="peg_keluarga_nama"><div class="ew-table-header-caption"><?php echo $peg_keluarga_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $peg_keluarga_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_keluarga_list->SortUrl($peg_keluarga_list->nama) ?>', 1);"><div id="elh_peg_keluarga_nama" class="peg_keluarga_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_list->hp->Visible) { // hp ?>
	<?php if ($peg_keluarga_list->SortUrl($peg_keluarga_list->hp) == "") { ?>
		<th data-name="hp" class="<?php echo $peg_keluarga_list->hp->headerCellClass() ?>"><div id="elh_peg_keluarga_hp" class="peg_keluarga_hp"><div class="ew-table-header-caption"><?php echo $peg_keluarga_list->hp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hp" class="<?php echo $peg_keluarga_list->hp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_keluarga_list->SortUrl($peg_keluarga_list->hp) ?>', 1);"><div id="elh_peg_keluarga_hp" class="peg_keluarga_hp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_list->hp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_list->hp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_list->hp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_list->hubungan->Visible) { // hubungan ?>
	<?php if ($peg_keluarga_list->SortUrl($peg_keluarga_list->hubungan) == "") { ?>
		<th data-name="hubungan" class="<?php echo $peg_keluarga_list->hubungan->headerCellClass() ?>"><div id="elh_peg_keluarga_hubungan" class="peg_keluarga_hubungan"><div class="ew-table-header-caption"><?php echo $peg_keluarga_list->hubungan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hubungan" class="<?php echo $peg_keluarga_list->hubungan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_keluarga_list->SortUrl($peg_keluarga_list->hubungan) ?>', 1);"><div id="elh_peg_keluarga_hubungan" class="peg_keluarga_hubungan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_list->hubungan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_list->hubungan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_list->hubungan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_list->tgl_lahir->Visible) { // tgl_lahir ?>
	<?php if ($peg_keluarga_list->SortUrl($peg_keluarga_list->tgl_lahir) == "") { ?>
		<th data-name="tgl_lahir" class="<?php echo $peg_keluarga_list->tgl_lahir->headerCellClass() ?>"><div id="elh_peg_keluarga_tgl_lahir" class="peg_keluarga_tgl_lahir"><div class="ew-table-header-caption"><?php echo $peg_keluarga_list->tgl_lahir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_lahir" class="<?php echo $peg_keluarga_list->tgl_lahir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_keluarga_list->SortUrl($peg_keluarga_list->tgl_lahir) ?>', 1);"><div id="elh_peg_keluarga_tgl_lahir" class="peg_keluarga_tgl_lahir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_list->tgl_lahir->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_list->tgl_lahir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_list->tgl_lahir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_list->jen_kel->Visible) { // jen_kel ?>
	<?php if ($peg_keluarga_list->SortUrl($peg_keluarga_list->jen_kel) == "") { ?>
		<th data-name="jen_kel" class="<?php echo $peg_keluarga_list->jen_kel->headerCellClass() ?>"><div id="elh_peg_keluarga_jen_kel" class="peg_keluarga_jen_kel"><div class="ew-table-header-caption"><?php echo $peg_keluarga_list->jen_kel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jen_kel" class="<?php echo $peg_keluarga_list->jen_kel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_keluarga_list->SortUrl($peg_keluarga_list->jen_kel) ?>', 1);"><div id="elh_peg_keluarga_jen_kel" class="peg_keluarga_jen_kel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_list->jen_kel->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_list->jen_kel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_list->jen_kel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$peg_keluarga_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($peg_keluarga_list->ExportAll && $peg_keluarga_list->isExport()) {
	$peg_keluarga_list->StopRecord = $peg_keluarga_list->TotalRecords;
} else {

	// Set the last record to display
	if ($peg_keluarga_list->TotalRecords > $peg_keluarga_list->StartRecord + $peg_keluarga_list->DisplayRecords - 1)
		$peg_keluarga_list->StopRecord = $peg_keluarga_list->StartRecord + $peg_keluarga_list->DisplayRecords - 1;
	else
		$peg_keluarga_list->StopRecord = $peg_keluarga_list->TotalRecords;
}
$peg_keluarga_list->RecordCount = $peg_keluarga_list->StartRecord - 1;
if ($peg_keluarga_list->Recordset && !$peg_keluarga_list->Recordset->EOF) {
	$peg_keluarga_list->Recordset->moveFirst();
	$selectLimit = $peg_keluarga_list->UseSelectLimit;
	if (!$selectLimit && $peg_keluarga_list->StartRecord > 1)
		$peg_keluarga_list->Recordset->move($peg_keluarga_list->StartRecord - 1);
} elseif (!$peg_keluarga->AllowAddDeleteRow && $peg_keluarga_list->StopRecord == 0) {
	$peg_keluarga_list->StopRecord = $peg_keluarga->GridAddRowCount;
}

// Initialize aggregate
$peg_keluarga->RowType = ROWTYPE_AGGREGATEINIT;
$peg_keluarga->resetAttributes();
$peg_keluarga_list->renderRow();
while ($peg_keluarga_list->RecordCount < $peg_keluarga_list->StopRecord) {
	$peg_keluarga_list->RecordCount++;
	if ($peg_keluarga_list->RecordCount >= $peg_keluarga_list->StartRecord) {
		$peg_keluarga_list->RowCount++;

		// Set up key count
		$peg_keluarga_list->KeyCount = $peg_keluarga_list->RowIndex;

		// Init row class and style
		$peg_keluarga->resetAttributes();
		$peg_keluarga->CssClass = "";
		if ($peg_keluarga_list->isGridAdd()) {
		} else {
			$peg_keluarga_list->loadRowValues($peg_keluarga_list->Recordset); // Load row values
		}
		$peg_keluarga->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$peg_keluarga->RowAttrs->merge(["data-rowindex" => $peg_keluarga_list->RowCount, "id" => "r" . $peg_keluarga_list->RowCount . "_peg_keluarga", "data-rowtype" => $peg_keluarga->RowType]);

		// Render row
		$peg_keluarga_list->renderRow();

		// Render list options
		$peg_keluarga_list->renderListOptions();
?>
	<tr <?php echo $peg_keluarga->rowAttributes() ?>>
<?php

// Render list options (body, left)
$peg_keluarga_list->ListOptions->render("body", "left", $peg_keluarga_list->RowCount);
?>
	<?php if ($peg_keluarga_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $peg_keluarga_list->id->cellAttributes() ?>>
<span id="el<?php echo $peg_keluarga_list->RowCount ?>_peg_keluarga_id">
<span<?php echo $peg_keluarga_list->id->viewAttributes() ?>><?php echo $peg_keluarga_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_keluarga_list->pid->Visible) { // pid ?>
		<td data-name="pid" <?php echo $peg_keluarga_list->pid->cellAttributes() ?>>
<span id="el<?php echo $peg_keluarga_list->RowCount ?>_peg_keluarga_pid">
<span<?php echo $peg_keluarga_list->pid->viewAttributes() ?>><?php echo $peg_keluarga_list->pid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_keluarga_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $peg_keluarga_list->nama->cellAttributes() ?>>
<span id="el<?php echo $peg_keluarga_list->RowCount ?>_peg_keluarga_nama">
<span<?php echo $peg_keluarga_list->nama->viewAttributes() ?>><?php echo $peg_keluarga_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_keluarga_list->hp->Visible) { // hp ?>
		<td data-name="hp" <?php echo $peg_keluarga_list->hp->cellAttributes() ?>>
<span id="el<?php echo $peg_keluarga_list->RowCount ?>_peg_keluarga_hp">
<span<?php echo $peg_keluarga_list->hp->viewAttributes() ?>><?php echo $peg_keluarga_list->hp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_keluarga_list->hubungan->Visible) { // hubungan ?>
		<td data-name="hubungan" <?php echo $peg_keluarga_list->hubungan->cellAttributes() ?>>
<span id="el<?php echo $peg_keluarga_list->RowCount ?>_peg_keluarga_hubungan">
<span<?php echo $peg_keluarga_list->hubungan->viewAttributes() ?>><?php echo $peg_keluarga_list->hubungan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_keluarga_list->tgl_lahir->Visible) { // tgl_lahir ?>
		<td data-name="tgl_lahir" <?php echo $peg_keluarga_list->tgl_lahir->cellAttributes() ?>>
<span id="el<?php echo $peg_keluarga_list->RowCount ?>_peg_keluarga_tgl_lahir">
<span<?php echo $peg_keluarga_list->tgl_lahir->viewAttributes() ?>><?php echo $peg_keluarga_list->tgl_lahir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_keluarga_list->jen_kel->Visible) { // jen_kel ?>
		<td data-name="jen_kel" <?php echo $peg_keluarga_list->jen_kel->cellAttributes() ?>>
<span id="el<?php echo $peg_keluarga_list->RowCount ?>_peg_keluarga_jen_kel">
<span<?php echo $peg_keluarga_list->jen_kel->viewAttributes() ?>><?php echo $peg_keluarga_list->jen_kel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$peg_keluarga_list->ListOptions->render("body", "right", $peg_keluarga_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$peg_keluarga_list->isGridAdd())
		$peg_keluarga_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$peg_keluarga->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($peg_keluarga_list->Recordset)
	$peg_keluarga_list->Recordset->Close();
?>
<?php if (!$peg_keluarga_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$peg_keluarga_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $peg_keluarga_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $peg_keluarga_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($peg_keluarga_list->TotalRecords == 0 && !$peg_keluarga->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $peg_keluarga_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$peg_keluarga_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$peg_keluarga_list->isExport()) { ?>
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
$peg_keluarga_list->terminate();
?>