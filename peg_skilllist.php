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
$peg_skill_list = new peg_skill_list();

// Run the page
$peg_skill_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_skill_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$peg_skill_list->isExport()) { ?>
<script>
var fpeg_skilllist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpeg_skilllist = currentForm = new ew.Form("fpeg_skilllist", "list");
	fpeg_skilllist.formKeyCountName = '<?php echo $peg_skill_list->FormKeyCountName ?>';
	loadjs.done("fpeg_skilllist");
});
var fpeg_skilllistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpeg_skilllistsrch = currentSearchForm = new ew.Form("fpeg_skilllistsrch");

	// Dynamic selection lists
	// Filters

	fpeg_skilllistsrch.filterList = <?php echo $peg_skill_list->getFilterList() ?>;
	loadjs.done("fpeg_skilllistsrch");
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
<?php if (!$peg_skill_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($peg_skill_list->TotalRecords > 0 && $peg_skill_list->ExportOptions->visible()) { ?>
<?php $peg_skill_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($peg_skill_list->ImportOptions->visible()) { ?>
<?php $peg_skill_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($peg_skill_list->SearchOptions->visible()) { ?>
<?php $peg_skill_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($peg_skill_list->FilterOptions->visible()) { ?>
<?php $peg_skill_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$peg_skill_list->isExport() || Config("EXPORT_MASTER_RECORD") && $peg_skill_list->isExport("print")) { ?>
<?php
if ($peg_skill_list->DbMasterFilter != "" && $peg_skill->getCurrentMasterTable() == "pegawai") {
	if ($peg_skill_list->MasterRecordExists) {
		include_once "pegawaimaster.php";
	}
}
?>
<?php } ?>
<?php
$peg_skill_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$peg_skill_list->isExport() && !$peg_skill->CurrentAction) { ?>
<form name="fpeg_skilllistsrch" id="fpeg_skilllistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpeg_skilllistsrch-search-panel" class="<?php echo $peg_skill_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="peg_skill">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $peg_skill_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($peg_skill_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($peg_skill_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $peg_skill_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($peg_skill_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($peg_skill_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($peg_skill_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($peg_skill_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $peg_skill_list->showPageHeader(); ?>
<?php
$peg_skill_list->showMessage();
?>
<?php if ($peg_skill_list->TotalRecords > 0 || $peg_skill->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($peg_skill_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> peg_skill">
<?php if (!$peg_skill_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$peg_skill_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $peg_skill_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $peg_skill_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpeg_skilllist" id="fpeg_skilllist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="peg_skill">
<?php if ($peg_skill->getCurrentMasterTable() == "pegawai" && $peg_skill->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="pegawai">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($peg_skill_list->pid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_peg_skill" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($peg_skill_list->TotalRecords > 0 || $peg_skill_list->isGridEdit()) { ?>
<table id="tbl_peg_skilllist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$peg_skill->RowType = ROWTYPE_HEADER;

// Render list options
$peg_skill_list->renderListOptions();

// Render list options (header, left)
$peg_skill_list->ListOptions->render("header", "left");
?>
<?php if ($peg_skill_list->id->Visible) { // id ?>
	<?php if ($peg_skill_list->SortUrl($peg_skill_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $peg_skill_list->id->headerCellClass() ?>"><div id="elh_peg_skill_id" class="peg_skill_id"><div class="ew-table-header-caption"><?php echo $peg_skill_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $peg_skill_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_skill_list->SortUrl($peg_skill_list->id) ?>', 1);"><div id="elh_peg_skill_id" class="peg_skill_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_list->pid->Visible) { // pid ?>
	<?php if ($peg_skill_list->SortUrl($peg_skill_list->pid) == "") { ?>
		<th data-name="pid" class="<?php echo $peg_skill_list->pid->headerCellClass() ?>"><div id="elh_peg_skill_pid" class="peg_skill_pid"><div class="ew-table-header-caption"><?php echo $peg_skill_list->pid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid" class="<?php echo $peg_skill_list->pid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_skill_list->SortUrl($peg_skill_list->pid) ?>', 1);"><div id="elh_peg_skill_pid" class="peg_skill_pid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_list->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_list->pid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_list->pid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_list->keahlian->Visible) { // keahlian ?>
	<?php if ($peg_skill_list->SortUrl($peg_skill_list->keahlian) == "") { ?>
		<th data-name="keahlian" class="<?php echo $peg_skill_list->keahlian->headerCellClass() ?>"><div id="elh_peg_skill_keahlian" class="peg_skill_keahlian"><div class="ew-table-header-caption"><?php echo $peg_skill_list->keahlian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keahlian" class="<?php echo $peg_skill_list->keahlian->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_skill_list->SortUrl($peg_skill_list->keahlian) ?>', 1);"><div id="elh_peg_skill_keahlian" class="peg_skill_keahlian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_list->keahlian->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_list->keahlian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_list->keahlian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_list->tingkat->Visible) { // tingkat ?>
	<?php if ($peg_skill_list->SortUrl($peg_skill_list->tingkat) == "") { ?>
		<th data-name="tingkat" class="<?php echo $peg_skill_list->tingkat->headerCellClass() ?>"><div id="elh_peg_skill_tingkat" class="peg_skill_tingkat"><div class="ew-table-header-caption"><?php echo $peg_skill_list->tingkat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tingkat" class="<?php echo $peg_skill_list->tingkat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_skill_list->SortUrl($peg_skill_list->tingkat) ?>', 1);"><div id="elh_peg_skill_tingkat" class="peg_skill_tingkat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_list->tingkat->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_list->tingkat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_list->tingkat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_list->bukti->Visible) { // bukti ?>
	<?php if ($peg_skill_list->SortUrl($peg_skill_list->bukti) == "") { ?>
		<th data-name="bukti" class="<?php echo $peg_skill_list->bukti->headerCellClass() ?>"><div id="elh_peg_skill_bukti" class="peg_skill_bukti"><div class="ew-table-header-caption"><?php echo $peg_skill_list->bukti->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bukti" class="<?php echo $peg_skill_list->bukti->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_skill_list->SortUrl($peg_skill_list->bukti) ?>', 1);"><div id="elh_peg_skill_bukti" class="peg_skill_bukti">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_list->bukti->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_list->bukti->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_list->bukti->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_list->keterangan->Visible) { // keterangan ?>
	<?php if ($peg_skill_list->SortUrl($peg_skill_list->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $peg_skill_list->keterangan->headerCellClass() ?>"><div id="elh_peg_skill_keterangan" class="peg_skill_keterangan"><div class="ew-table-header-caption"><?php echo $peg_skill_list->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $peg_skill_list->keterangan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_skill_list->SortUrl($peg_skill_list->keterangan) ?>', 1);"><div id="elh_peg_skill_keterangan" class="peg_skill_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_list->keterangan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_list->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_list->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_list->c_date->Visible) { // c_date ?>
	<?php if ($peg_skill_list->SortUrl($peg_skill_list->c_date) == "") { ?>
		<th data-name="c_date" class="<?php echo $peg_skill_list->c_date->headerCellClass() ?>"><div id="elh_peg_skill_c_date" class="peg_skill_c_date"><div class="ew-table-header-caption"><?php echo $peg_skill_list->c_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="c_date" class="<?php echo $peg_skill_list->c_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_skill_list->SortUrl($peg_skill_list->c_date) ?>', 1);"><div id="elh_peg_skill_c_date" class="peg_skill_c_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_list->c_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_list->c_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_list->c_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_list->u_date->Visible) { // u_date ?>
	<?php if ($peg_skill_list->SortUrl($peg_skill_list->u_date) == "") { ?>
		<th data-name="u_date" class="<?php echo $peg_skill_list->u_date->headerCellClass() ?>"><div id="elh_peg_skill_u_date" class="peg_skill_u_date"><div class="ew-table-header-caption"><?php echo $peg_skill_list->u_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="u_date" class="<?php echo $peg_skill_list->u_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_skill_list->SortUrl($peg_skill_list->u_date) ?>', 1);"><div id="elh_peg_skill_u_date" class="peg_skill_u_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_list->u_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_list->u_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_list->u_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_list->c_by->Visible) { // c_by ?>
	<?php if ($peg_skill_list->SortUrl($peg_skill_list->c_by) == "") { ?>
		<th data-name="c_by" class="<?php echo $peg_skill_list->c_by->headerCellClass() ?>"><div id="elh_peg_skill_c_by" class="peg_skill_c_by"><div class="ew-table-header-caption"><?php echo $peg_skill_list->c_by->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="c_by" class="<?php echo $peg_skill_list->c_by->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_skill_list->SortUrl($peg_skill_list->c_by) ?>', 1);"><div id="elh_peg_skill_c_by" class="peg_skill_c_by">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_list->c_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_list->c_by->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_list->c_by->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_list->u_by->Visible) { // u_by ?>
	<?php if ($peg_skill_list->SortUrl($peg_skill_list->u_by) == "") { ?>
		<th data-name="u_by" class="<?php echo $peg_skill_list->u_by->headerCellClass() ?>"><div id="elh_peg_skill_u_by" class="peg_skill_u_by"><div class="ew-table-header-caption"><?php echo $peg_skill_list->u_by->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="u_by" class="<?php echo $peg_skill_list->u_by->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $peg_skill_list->SortUrl($peg_skill_list->u_by) ?>', 1);"><div id="elh_peg_skill_u_by" class="peg_skill_u_by">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_list->u_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_list->u_by->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_list->u_by->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$peg_skill_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($peg_skill_list->ExportAll && $peg_skill_list->isExport()) {
	$peg_skill_list->StopRecord = $peg_skill_list->TotalRecords;
} else {

	// Set the last record to display
	if ($peg_skill_list->TotalRecords > $peg_skill_list->StartRecord + $peg_skill_list->DisplayRecords - 1)
		$peg_skill_list->StopRecord = $peg_skill_list->StartRecord + $peg_skill_list->DisplayRecords - 1;
	else
		$peg_skill_list->StopRecord = $peg_skill_list->TotalRecords;
}
$peg_skill_list->RecordCount = $peg_skill_list->StartRecord - 1;
if ($peg_skill_list->Recordset && !$peg_skill_list->Recordset->EOF) {
	$peg_skill_list->Recordset->moveFirst();
	$selectLimit = $peg_skill_list->UseSelectLimit;
	if (!$selectLimit && $peg_skill_list->StartRecord > 1)
		$peg_skill_list->Recordset->move($peg_skill_list->StartRecord - 1);
} elseif (!$peg_skill->AllowAddDeleteRow && $peg_skill_list->StopRecord == 0) {
	$peg_skill_list->StopRecord = $peg_skill->GridAddRowCount;
}

// Initialize aggregate
$peg_skill->RowType = ROWTYPE_AGGREGATEINIT;
$peg_skill->resetAttributes();
$peg_skill_list->renderRow();
while ($peg_skill_list->RecordCount < $peg_skill_list->StopRecord) {
	$peg_skill_list->RecordCount++;
	if ($peg_skill_list->RecordCount >= $peg_skill_list->StartRecord) {
		$peg_skill_list->RowCount++;

		// Set up key count
		$peg_skill_list->KeyCount = $peg_skill_list->RowIndex;

		// Init row class and style
		$peg_skill->resetAttributes();
		$peg_skill->CssClass = "";
		if ($peg_skill_list->isGridAdd()) {
		} else {
			$peg_skill_list->loadRowValues($peg_skill_list->Recordset); // Load row values
		}
		$peg_skill->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$peg_skill->RowAttrs->merge(["data-rowindex" => $peg_skill_list->RowCount, "id" => "r" . $peg_skill_list->RowCount . "_peg_skill", "data-rowtype" => $peg_skill->RowType]);

		// Render row
		$peg_skill_list->renderRow();

		// Render list options
		$peg_skill_list->renderListOptions();
?>
	<tr <?php echo $peg_skill->rowAttributes() ?>>
<?php

// Render list options (body, left)
$peg_skill_list->ListOptions->render("body", "left", $peg_skill_list->RowCount);
?>
	<?php if ($peg_skill_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $peg_skill_list->id->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_list->RowCount ?>_peg_skill_id">
<span<?php echo $peg_skill_list->id->viewAttributes() ?>><?php echo $peg_skill_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_skill_list->pid->Visible) { // pid ?>
		<td data-name="pid" <?php echo $peg_skill_list->pid->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_list->RowCount ?>_peg_skill_pid">
<span<?php echo $peg_skill_list->pid->viewAttributes() ?>><?php echo $peg_skill_list->pid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_skill_list->keahlian->Visible) { // keahlian ?>
		<td data-name="keahlian" <?php echo $peg_skill_list->keahlian->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_list->RowCount ?>_peg_skill_keahlian">
<span<?php echo $peg_skill_list->keahlian->viewAttributes() ?>><?php echo $peg_skill_list->keahlian->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_skill_list->tingkat->Visible) { // tingkat ?>
		<td data-name="tingkat" <?php echo $peg_skill_list->tingkat->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_list->RowCount ?>_peg_skill_tingkat">
<span<?php echo $peg_skill_list->tingkat->viewAttributes() ?>><?php echo $peg_skill_list->tingkat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_skill_list->bukti->Visible) { // bukti ?>
		<td data-name="bukti" <?php echo $peg_skill_list->bukti->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_list->RowCount ?>_peg_skill_bukti">
<span<?php echo $peg_skill_list->bukti->viewAttributes() ?>><?php echo $peg_skill_list->bukti->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_skill_list->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $peg_skill_list->keterangan->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_list->RowCount ?>_peg_skill_keterangan">
<span<?php echo $peg_skill_list->keterangan->viewAttributes() ?>><?php echo $peg_skill_list->keterangan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_skill_list->c_date->Visible) { // c_date ?>
		<td data-name="c_date" <?php echo $peg_skill_list->c_date->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_list->RowCount ?>_peg_skill_c_date">
<span<?php echo $peg_skill_list->c_date->viewAttributes() ?>><?php echo $peg_skill_list->c_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_skill_list->u_date->Visible) { // u_date ?>
		<td data-name="u_date" <?php echo $peg_skill_list->u_date->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_list->RowCount ?>_peg_skill_u_date">
<span<?php echo $peg_skill_list->u_date->viewAttributes() ?>><?php echo $peg_skill_list->u_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_skill_list->c_by->Visible) { // c_by ?>
		<td data-name="c_by" <?php echo $peg_skill_list->c_by->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_list->RowCount ?>_peg_skill_c_by">
<span<?php echo $peg_skill_list->c_by->viewAttributes() ?>><?php echo $peg_skill_list->c_by->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($peg_skill_list->u_by->Visible) { // u_by ?>
		<td data-name="u_by" <?php echo $peg_skill_list->u_by->cellAttributes() ?>>
<span id="el<?php echo $peg_skill_list->RowCount ?>_peg_skill_u_by">
<span<?php echo $peg_skill_list->u_by->viewAttributes() ?>><?php echo $peg_skill_list->u_by->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$peg_skill_list->ListOptions->render("body", "right", $peg_skill_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$peg_skill_list->isGridAdd())
		$peg_skill_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$peg_skill->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($peg_skill_list->Recordset)
	$peg_skill_list->Recordset->Close();
?>
<?php if (!$peg_skill_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$peg_skill_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $peg_skill_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $peg_skill_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($peg_skill_list->TotalRecords == 0 && !$peg_skill->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $peg_skill_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$peg_skill_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$peg_skill_list->isExport()) { ?>
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
$peg_skill_list->terminate();
?>