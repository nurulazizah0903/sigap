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
$gajisd_list = new gajisd_list();

// Run the page
$gajisd_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajisd_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajisd_list->isExport()) { ?>
<script>
var fgajisdlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgajisdlist = currentForm = new ew.Form("fgajisdlist", "list");
	fgajisdlist.formKeyCountName = '<?php echo $gajisd_list->FormKeyCountName ?>';
	loadjs.done("fgajisdlist");
});
var fgajisdlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fgajisdlistsrch = currentSearchForm = new ew.Form("fgajisdlistsrch");

	// Dynamic selection lists
	// Filters

	fgajisdlistsrch.filterList = <?php echo $gajisd_list->getFilterList() ?>;
	loadjs.done("fgajisdlistsrch");
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
<?php if (!$gajisd_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gajisd_list->TotalRecords > 0 && $gajisd_list->ExportOptions->visible()) { ?>
<?php $gajisd_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gajisd_list->ImportOptions->visible()) { ?>
<?php $gajisd_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($gajisd_list->SearchOptions->visible()) { ?>
<?php $gajisd_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($gajisd_list->FilterOptions->visible()) { ?>
<?php $gajisd_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$gajisd_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$gajisd_list->isExport() && !$gajisd->CurrentAction) { ?>
<form name="fgajisdlistsrch" id="fgajisdlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fgajisdlistsrch-search-panel" class="<?php echo $gajisd_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="gajisd">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $gajisd_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($gajisd_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($gajisd_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $gajisd_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($gajisd_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($gajisd_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($gajisd_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($gajisd_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $gajisd_list->showPageHeader(); ?>
<?php
$gajisd_list->showMessage();
?>
<?php if ($gajisd_list->TotalRecords > 0 || $gajisd->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gajisd_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajisd">
<?php if (!$gajisd_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gajisd_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajisd_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajisd_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgajisdlist" id="fgajisdlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajisd">
<div id="gmp_gajisd" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gajisd_list->TotalRecords > 0 || $gajisd_list->isGridEdit()) { ?>
<table id="tbl_gajisdlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gajisd->RowType = ROWTYPE_HEADER;

// Render list options
$gajisd_list->renderListOptions();

// Render list options (header, left)
$gajisd_list->ListOptions->render("header", "left");
?>
<?php if ($gajisd_list->tahun->Visible) { // tahun ?>
	<?php if ($gajisd_list->SortUrl($gajisd_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $gajisd_list->tahun->headerCellClass() ?>"><div id="elh_gajisd_tahun" class="gajisd_tahun"><div class="ew-table-header-caption"><?php echo $gajisd_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $gajisd_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_list->SortUrl($gajisd_list->tahun) ?>', 1);"><div id="elh_gajisd_tahun" class="gajisd_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_list->bulan->Visible) { // bulan ?>
	<?php if ($gajisd_list->SortUrl($gajisd_list->bulan) == "") { ?>
		<th data-name="bulan" class="<?php echo $gajisd_list->bulan->headerCellClass() ?>"><div id="elh_gajisd_bulan" class="gajisd_bulan"><div class="ew-table-header-caption"><?php echo $gajisd_list->bulan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bulan" class="<?php echo $gajisd_list->bulan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_list->SortUrl($gajisd_list->bulan) ?>', 1);"><div id="elh_gajisd_bulan" class="gajisd_bulan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_list->bulan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_list->bulan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_list->bulan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_list->datetime->Visible) { // datetime ?>
	<?php if ($gajisd_list->SortUrl($gajisd_list->datetime) == "") { ?>
		<th data-name="datetime" class="<?php echo $gajisd_list->datetime->headerCellClass() ?>"><div id="elh_gajisd_datetime" class="gajisd_datetime"><div class="ew-table-header-caption"><?php echo $gajisd_list->datetime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="datetime" class="<?php echo $gajisd_list->datetime->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_list->SortUrl($gajisd_list->datetime) ?>', 1);"><div id="elh_gajisd_datetime" class="gajisd_datetime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_list->datetime->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_list->datetime->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_list->datetime->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_list->createby->Visible) { // createby ?>
	<?php if ($gajisd_list->SortUrl($gajisd_list->createby) == "") { ?>
		<th data-name="createby" class="<?php echo $gajisd_list->createby->headerCellClass() ?>"><div id="elh_gajisd_createby" class="gajisd_createby"><div class="ew-table-header-caption"><?php echo $gajisd_list->createby->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createby" class="<?php echo $gajisd_list->createby->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_list->SortUrl($gajisd_list->createby) ?>', 1);"><div id="elh_gajisd_createby" class="gajisd_createby">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_list->createby->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($gajisd_list->createby->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_list->createby->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajisd_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gajisd_list->ExportAll && $gajisd_list->isExport()) {
	$gajisd_list->StopRecord = $gajisd_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gajisd_list->TotalRecords > $gajisd_list->StartRecord + $gajisd_list->DisplayRecords - 1)
		$gajisd_list->StopRecord = $gajisd_list->StartRecord + $gajisd_list->DisplayRecords - 1;
	else
		$gajisd_list->StopRecord = $gajisd_list->TotalRecords;
}
$gajisd_list->RecordCount = $gajisd_list->StartRecord - 1;
if ($gajisd_list->Recordset && !$gajisd_list->Recordset->EOF) {
	$gajisd_list->Recordset->moveFirst();
	$selectLimit = $gajisd_list->UseSelectLimit;
	if (!$selectLimit && $gajisd_list->StartRecord > 1)
		$gajisd_list->Recordset->move($gajisd_list->StartRecord - 1);
} elseif (!$gajisd->AllowAddDeleteRow && $gajisd_list->StopRecord == 0) {
	$gajisd_list->StopRecord = $gajisd->GridAddRowCount;
}

// Initialize aggregate
$gajisd->RowType = ROWTYPE_AGGREGATEINIT;
$gajisd->resetAttributes();
$gajisd_list->renderRow();
while ($gajisd_list->RecordCount < $gajisd_list->StopRecord) {
	$gajisd_list->RecordCount++;
	if ($gajisd_list->RecordCount >= $gajisd_list->StartRecord) {
		$gajisd_list->RowCount++;

		// Set up key count
		$gajisd_list->KeyCount = $gajisd_list->RowIndex;

		// Init row class and style
		$gajisd->resetAttributes();
		$gajisd->CssClass = "";
		if ($gajisd_list->isGridAdd()) {
		} else {
			$gajisd_list->loadRowValues($gajisd_list->Recordset); // Load row values
		}
		$gajisd->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gajisd->RowAttrs->merge(["data-rowindex" => $gajisd_list->RowCount, "id" => "r" . $gajisd_list->RowCount . "_gajisd", "data-rowtype" => $gajisd->RowType]);

		// Render row
		$gajisd_list->renderRow();

		// Render list options
		$gajisd_list->renderListOptions();
?>
	<tr <?php echo $gajisd->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajisd_list->ListOptions->render("body", "left", $gajisd_list->RowCount);
?>
	<?php if ($gajisd_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $gajisd_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $gajisd_list->RowCount ?>_gajisd_tahun">
<span<?php echo $gajisd_list->tahun->viewAttributes() ?>><?php echo $gajisd_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_list->bulan->Visible) { // bulan ?>
		<td data-name="bulan" <?php echo $gajisd_list->bulan->cellAttributes() ?>>
<span id="el<?php echo $gajisd_list->RowCount ?>_gajisd_bulan">
<span<?php echo $gajisd_list->bulan->viewAttributes() ?>><?php echo $gajisd_list->bulan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_list->datetime->Visible) { // datetime ?>
		<td data-name="datetime" <?php echo $gajisd_list->datetime->cellAttributes() ?>>
<span id="el<?php echo $gajisd_list->RowCount ?>_gajisd_datetime">
<span<?php echo $gajisd_list->datetime->viewAttributes() ?>><?php echo $gajisd_list->datetime->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_list->createby->Visible) { // createby ?>
		<td data-name="createby" <?php echo $gajisd_list->createby->cellAttributes() ?>>
<span id="el<?php echo $gajisd_list->RowCount ?>_gajisd_createby">
<span<?php echo $gajisd_list->createby->viewAttributes() ?>><?php echo $gajisd_list->createby->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajisd_list->ListOptions->render("body", "right", $gajisd_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gajisd_list->isGridAdd())
		$gajisd_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gajisd->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gajisd_list->Recordset)
	$gajisd_list->Recordset->Close();
?>
<?php if (!$gajisd_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gajisd_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajisd_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajisd_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gajisd_list->TotalRecords == 0 && !$gajisd->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gajisd_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gajisd_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajisd_list->isExport()) { ?>
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
$gajisd_list->terminate();
?>