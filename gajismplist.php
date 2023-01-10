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
$gajismp_list = new gajismp_list();

// Run the page
$gajismp_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajismp_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajismp_list->isExport()) { ?>
<script>
var fgajismplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgajismplist = currentForm = new ew.Form("fgajismplist", "list");
	fgajismplist.formKeyCountName = '<?php echo $gajismp_list->FormKeyCountName ?>';
	loadjs.done("fgajismplist");
});
var fgajismplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fgajismplistsrch = currentSearchForm = new ew.Form("fgajismplistsrch");

	// Dynamic selection lists
	// Filters

	fgajismplistsrch.filterList = <?php echo $gajismp_list->getFilterList() ?>;
	loadjs.done("fgajismplistsrch");
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
<?php if (!$gajismp_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gajismp_list->TotalRecords > 0 && $gajismp_list->ExportOptions->visible()) { ?>
<?php $gajismp_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gajismp_list->ImportOptions->visible()) { ?>
<?php $gajismp_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($gajismp_list->SearchOptions->visible()) { ?>
<?php $gajismp_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($gajismp_list->FilterOptions->visible()) { ?>
<?php $gajismp_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$gajismp_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$gajismp_list->isExport() && !$gajismp->CurrentAction) { ?>
<form name="fgajismplistsrch" id="fgajismplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fgajismplistsrch-search-panel" class="<?php echo $gajismp_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="gajismp">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $gajismp_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($gajismp_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($gajismp_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $gajismp_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($gajismp_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($gajismp_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($gajismp_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($gajismp_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $gajismp_list->showPageHeader(); ?>
<?php
$gajismp_list->showMessage();
?>
<?php if ($gajismp_list->TotalRecords > 0 || $gajismp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gajismp_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajismp">
<?php if (!$gajismp_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gajismp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajismp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajismp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgajismplist" id="fgajismplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajismp">
<div id="gmp_gajismp" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gajismp_list->TotalRecords > 0 || $gajismp_list->isGridEdit()) { ?>
<table id="tbl_gajismplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gajismp->RowType = ROWTYPE_HEADER;

// Render list options
$gajismp_list->renderListOptions();

// Render list options (header, left)
$gajismp_list->ListOptions->render("header", "left");
?>
<?php if ($gajismp_list->tahun->Visible) { // tahun ?>
	<?php if ($gajismp_list->SortUrl($gajismp_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $gajismp_list->tahun->headerCellClass() ?>"><div id="elh_gajismp_tahun" class="gajismp_tahun"><div class="ew-table-header-caption"><?php echo $gajismp_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $gajismp_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_list->SortUrl($gajismp_list->tahun) ?>', 1);"><div id="elh_gajismp_tahun" class="gajismp_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_list->bulan->Visible) { // bulan ?>
	<?php if ($gajismp_list->SortUrl($gajismp_list->bulan) == "") { ?>
		<th data-name="bulan" class="<?php echo $gajismp_list->bulan->headerCellClass() ?>"><div id="elh_gajismp_bulan" class="gajismp_bulan"><div class="ew-table-header-caption"><?php echo $gajismp_list->bulan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bulan" class="<?php echo $gajismp_list->bulan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_list->SortUrl($gajismp_list->bulan) ?>', 1);"><div id="elh_gajismp_bulan" class="gajismp_bulan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_list->bulan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_list->bulan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_list->bulan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_list->datetime->Visible) { // datetime ?>
	<?php if ($gajismp_list->SortUrl($gajismp_list->datetime) == "") { ?>
		<th data-name="datetime" class="<?php echo $gajismp_list->datetime->headerCellClass() ?>"><div id="elh_gajismp_datetime" class="gajismp_datetime"><div class="ew-table-header-caption"><?php echo $gajismp_list->datetime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="datetime" class="<?php echo $gajismp_list->datetime->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_list->SortUrl($gajismp_list->datetime) ?>', 1);"><div id="elh_gajismp_datetime" class="gajismp_datetime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_list->datetime->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_list->datetime->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_list->datetime->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_list->createby->Visible) { // createby ?>
	<?php if ($gajismp_list->SortUrl($gajismp_list->createby) == "") { ?>
		<th data-name="createby" class="<?php echo $gajismp_list->createby->headerCellClass() ?>"><div id="elh_gajismp_createby" class="gajismp_createby"><div class="ew-table-header-caption"><?php echo $gajismp_list->createby->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createby" class="<?php echo $gajismp_list->createby->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_list->SortUrl($gajismp_list->createby) ?>', 1);"><div id="elh_gajismp_createby" class="gajismp_createby">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_list->createby->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($gajismp_list->createby->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_list->createby->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajismp_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gajismp_list->ExportAll && $gajismp_list->isExport()) {
	$gajismp_list->StopRecord = $gajismp_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gajismp_list->TotalRecords > $gajismp_list->StartRecord + $gajismp_list->DisplayRecords - 1)
		$gajismp_list->StopRecord = $gajismp_list->StartRecord + $gajismp_list->DisplayRecords - 1;
	else
		$gajismp_list->StopRecord = $gajismp_list->TotalRecords;
}
$gajismp_list->RecordCount = $gajismp_list->StartRecord - 1;
if ($gajismp_list->Recordset && !$gajismp_list->Recordset->EOF) {
	$gajismp_list->Recordset->moveFirst();
	$selectLimit = $gajismp_list->UseSelectLimit;
	if (!$selectLimit && $gajismp_list->StartRecord > 1)
		$gajismp_list->Recordset->move($gajismp_list->StartRecord - 1);
} elseif (!$gajismp->AllowAddDeleteRow && $gajismp_list->StopRecord == 0) {
	$gajismp_list->StopRecord = $gajismp->GridAddRowCount;
}

// Initialize aggregate
$gajismp->RowType = ROWTYPE_AGGREGATEINIT;
$gajismp->resetAttributes();
$gajismp_list->renderRow();
while ($gajismp_list->RecordCount < $gajismp_list->StopRecord) {
	$gajismp_list->RecordCount++;
	if ($gajismp_list->RecordCount >= $gajismp_list->StartRecord) {
		$gajismp_list->RowCount++;

		// Set up key count
		$gajismp_list->KeyCount = $gajismp_list->RowIndex;

		// Init row class and style
		$gajismp->resetAttributes();
		$gajismp->CssClass = "";
		if ($gajismp_list->isGridAdd()) {
		} else {
			$gajismp_list->loadRowValues($gajismp_list->Recordset); // Load row values
		}
		$gajismp->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gajismp->RowAttrs->merge(["data-rowindex" => $gajismp_list->RowCount, "id" => "r" . $gajismp_list->RowCount . "_gajismp", "data-rowtype" => $gajismp->RowType]);

		// Render row
		$gajismp_list->renderRow();

		// Render list options
		$gajismp_list->renderListOptions();
?>
	<tr <?php echo $gajismp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajismp_list->ListOptions->render("body", "left", $gajismp_list->RowCount);
?>
	<?php if ($gajismp_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $gajismp_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $gajismp_list->RowCount ?>_gajismp_tahun">
<span<?php echo $gajismp_list->tahun->viewAttributes() ?>><?php echo $gajismp_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_list->bulan->Visible) { // bulan ?>
		<td data-name="bulan" <?php echo $gajismp_list->bulan->cellAttributes() ?>>
<span id="el<?php echo $gajismp_list->RowCount ?>_gajismp_bulan">
<span<?php echo $gajismp_list->bulan->viewAttributes() ?>><?php echo $gajismp_list->bulan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_list->datetime->Visible) { // datetime ?>
		<td data-name="datetime" <?php echo $gajismp_list->datetime->cellAttributes() ?>>
<span id="el<?php echo $gajismp_list->RowCount ?>_gajismp_datetime">
<span<?php echo $gajismp_list->datetime->viewAttributes() ?>><?php echo $gajismp_list->datetime->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_list->createby->Visible) { // createby ?>
		<td data-name="createby" <?php echo $gajismp_list->createby->cellAttributes() ?>>
<span id="el<?php echo $gajismp_list->RowCount ?>_gajismp_createby">
<span<?php echo $gajismp_list->createby->viewAttributes() ?>><?php echo $gajismp_list->createby->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajismp_list->ListOptions->render("body", "right", $gajismp_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gajismp_list->isGridAdd())
		$gajismp_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gajismp->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gajismp_list->Recordset)
	$gajismp_list->Recordset->Close();
?>
<?php if (!$gajismp_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gajismp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajismp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajismp_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gajismp_list->TotalRecords == 0 && !$gajismp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gajismp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gajismp_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajismp_list->isExport()) { ?>
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
$gajismp_list->terminate();
?>