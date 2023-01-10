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
$gajitk_list = new gajitk_list();

// Run the page
$gajitk_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitk_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajitk_list->isExport()) { ?>
<script>
var fgajitklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgajitklist = currentForm = new ew.Form("fgajitklist", "list");
	fgajitklist.formKeyCountName = '<?php echo $gajitk_list->FormKeyCountName ?>';
	loadjs.done("fgajitklist");
});
var fgajitklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fgajitklistsrch = currentSearchForm = new ew.Form("fgajitklistsrch");

	// Dynamic selection lists
	// Filters

	fgajitklistsrch.filterList = <?php echo $gajitk_list->getFilterList() ?>;
	loadjs.done("fgajitklistsrch");
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
<?php if (!$gajitk_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gajitk_list->TotalRecords > 0 && $gajitk_list->ExportOptions->visible()) { ?>
<?php $gajitk_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gajitk_list->ImportOptions->visible()) { ?>
<?php $gajitk_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($gajitk_list->SearchOptions->visible()) { ?>
<?php $gajitk_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($gajitk_list->FilterOptions->visible()) { ?>
<?php $gajitk_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$gajitk_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$gajitk_list->isExport() && !$gajitk->CurrentAction) { ?>
<form name="fgajitklistsrch" id="fgajitklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fgajitklistsrch-search-panel" class="<?php echo $gajitk_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="gajitk">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $gajitk_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($gajitk_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($gajitk_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $gajitk_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($gajitk_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($gajitk_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($gajitk_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($gajitk_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $gajitk_list->showPageHeader(); ?>
<?php
$gajitk_list->showMessage();
?>
<?php if ($gajitk_list->TotalRecords > 0 || $gajitk->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gajitk_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajitk">
<?php if (!$gajitk_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gajitk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajitk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajitk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgajitklist" id="fgajitklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajitk">
<div id="gmp_gajitk" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gajitk_list->TotalRecords > 0 || $gajitk_list->isGridEdit()) { ?>
<table id="tbl_gajitklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gajitk->RowType = ROWTYPE_HEADER;

// Render list options
$gajitk_list->renderListOptions();

// Render list options (header, left)
$gajitk_list->ListOptions->render("header", "left");
?>
<?php if ($gajitk_list->tahun->Visible) { // tahun ?>
	<?php if ($gajitk_list->SortUrl($gajitk_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $gajitk_list->tahun->headerCellClass() ?>"><div id="elh_gajitk_tahun" class="gajitk_tahun"><div class="ew-table-header-caption"><?php echo $gajitk_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $gajitk_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitk_list->SortUrl($gajitk_list->tahun) ?>', 1);"><div id="elh_gajitk_tahun" class="gajitk_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_list->bulan->Visible) { // bulan ?>
	<?php if ($gajitk_list->SortUrl($gajitk_list->bulan) == "") { ?>
		<th data-name="bulan" class="<?php echo $gajitk_list->bulan->headerCellClass() ?>"><div id="elh_gajitk_bulan" class="gajitk_bulan"><div class="ew-table-header-caption"><?php echo $gajitk_list->bulan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bulan" class="<?php echo $gajitk_list->bulan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitk_list->SortUrl($gajitk_list->bulan) ?>', 1);"><div id="elh_gajitk_bulan" class="gajitk_bulan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_list->bulan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_list->bulan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_list->bulan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_list->datetime->Visible) { // datetime ?>
	<?php if ($gajitk_list->SortUrl($gajitk_list->datetime) == "") { ?>
		<th data-name="datetime" class="<?php echo $gajitk_list->datetime->headerCellClass() ?>"><div id="elh_gajitk_datetime" class="gajitk_datetime"><div class="ew-table-header-caption"><?php echo $gajitk_list->datetime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="datetime" class="<?php echo $gajitk_list->datetime->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitk_list->SortUrl($gajitk_list->datetime) ?>', 1);"><div id="elh_gajitk_datetime" class="gajitk_datetime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_list->datetime->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_list->datetime->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_list->datetime->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_list->createby->Visible) { // createby ?>
	<?php if ($gajitk_list->SortUrl($gajitk_list->createby) == "") { ?>
		<th data-name="createby" class="<?php echo $gajitk_list->createby->headerCellClass() ?>"><div id="elh_gajitk_createby" class="gajitk_createby"><div class="ew-table-header-caption"><?php echo $gajitk_list->createby->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createby" class="<?php echo $gajitk_list->createby->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitk_list->SortUrl($gajitk_list->createby) ?>', 1);"><div id="elh_gajitk_createby" class="gajitk_createby">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_list->createby->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($gajitk_list->createby->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_list->createby->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajitk_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gajitk_list->ExportAll && $gajitk_list->isExport()) {
	$gajitk_list->StopRecord = $gajitk_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gajitk_list->TotalRecords > $gajitk_list->StartRecord + $gajitk_list->DisplayRecords - 1)
		$gajitk_list->StopRecord = $gajitk_list->StartRecord + $gajitk_list->DisplayRecords - 1;
	else
		$gajitk_list->StopRecord = $gajitk_list->TotalRecords;
}
$gajitk_list->RecordCount = $gajitk_list->StartRecord - 1;
if ($gajitk_list->Recordset && !$gajitk_list->Recordset->EOF) {
	$gajitk_list->Recordset->moveFirst();
	$selectLimit = $gajitk_list->UseSelectLimit;
	if (!$selectLimit && $gajitk_list->StartRecord > 1)
		$gajitk_list->Recordset->move($gajitk_list->StartRecord - 1);
} elseif (!$gajitk->AllowAddDeleteRow && $gajitk_list->StopRecord == 0) {
	$gajitk_list->StopRecord = $gajitk->GridAddRowCount;
}

// Initialize aggregate
$gajitk->RowType = ROWTYPE_AGGREGATEINIT;
$gajitk->resetAttributes();
$gajitk_list->renderRow();
while ($gajitk_list->RecordCount < $gajitk_list->StopRecord) {
	$gajitk_list->RecordCount++;
	if ($gajitk_list->RecordCount >= $gajitk_list->StartRecord) {
		$gajitk_list->RowCount++;

		// Set up key count
		$gajitk_list->KeyCount = $gajitk_list->RowIndex;

		// Init row class and style
		$gajitk->resetAttributes();
		$gajitk->CssClass = "";
		if ($gajitk_list->isGridAdd()) {
		} else {
			$gajitk_list->loadRowValues($gajitk_list->Recordset); // Load row values
		}
		$gajitk->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gajitk->RowAttrs->merge(["data-rowindex" => $gajitk_list->RowCount, "id" => "r" . $gajitk_list->RowCount . "_gajitk", "data-rowtype" => $gajitk->RowType]);

		// Render row
		$gajitk_list->renderRow();

		// Render list options
		$gajitk_list->renderListOptions();
?>
	<tr <?php echo $gajitk->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajitk_list->ListOptions->render("body", "left", $gajitk_list->RowCount);
?>
	<?php if ($gajitk_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $gajitk_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $gajitk_list->RowCount ?>_gajitk_tahun">
<span<?php echo $gajitk_list->tahun->viewAttributes() ?>><?php echo $gajitk_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajitk_list->bulan->Visible) { // bulan ?>
		<td data-name="bulan" <?php echo $gajitk_list->bulan->cellAttributes() ?>>
<span id="el<?php echo $gajitk_list->RowCount ?>_gajitk_bulan">
<span<?php echo $gajitk_list->bulan->viewAttributes() ?>><?php echo $gajitk_list->bulan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajitk_list->datetime->Visible) { // datetime ?>
		<td data-name="datetime" <?php echo $gajitk_list->datetime->cellAttributes() ?>>
<span id="el<?php echo $gajitk_list->RowCount ?>_gajitk_datetime">
<span<?php echo $gajitk_list->datetime->viewAttributes() ?>><?php echo $gajitk_list->datetime->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajitk_list->createby->Visible) { // createby ?>
		<td data-name="createby" <?php echo $gajitk_list->createby->cellAttributes() ?>>
<span id="el<?php echo $gajitk_list->RowCount ?>_gajitk_createby">
<span<?php echo $gajitk_list->createby->viewAttributes() ?>><?php echo $gajitk_list->createby->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajitk_list->ListOptions->render("body", "right", $gajitk_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gajitk_list->isGridAdd())
		$gajitk_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gajitk->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gajitk_list->Recordset)
	$gajitk_list->Recordset->Close();
?>
<?php if (!$gajitk_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gajitk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajitk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajitk_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gajitk_list->TotalRecords == 0 && !$gajitk->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gajitk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gajitk_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajitk_list->isExport()) { ?>
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
$gajitk_list->terminate();
?>