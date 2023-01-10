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
$setuju_list = new setuju_list();

// Run the page
$setuju_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$setuju_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$setuju_list->isExport()) { ?>
<script>
var fsetujulist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsetujulist = currentForm = new ew.Form("fsetujulist", "list");
	fsetujulist.formKeyCountName = '<?php echo $setuju_list->FormKeyCountName ?>';
	loadjs.done("fsetujulist");
});
var fsetujulistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsetujulistsrch = currentSearchForm = new ew.Form("fsetujulistsrch");

	// Dynamic selection lists
	// Filters

	fsetujulistsrch.filterList = <?php echo $setuju_list->getFilterList() ?>;
	loadjs.done("fsetujulistsrch");
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
<?php if (!$setuju_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($setuju_list->TotalRecords > 0 && $setuju_list->ExportOptions->visible()) { ?>
<?php $setuju_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($setuju_list->ImportOptions->visible()) { ?>
<?php $setuju_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($setuju_list->SearchOptions->visible()) { ?>
<?php $setuju_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($setuju_list->FilterOptions->visible()) { ?>
<?php $setuju_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$setuju_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$setuju_list->isExport() && !$setuju->CurrentAction) { ?>
<form name="fsetujulistsrch" id="fsetujulistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsetujulistsrch-search-panel" class="<?php echo $setuju_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="setuju">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $setuju_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($setuju_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($setuju_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $setuju_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($setuju_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($setuju_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($setuju_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($setuju_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $setuju_list->showPageHeader(); ?>
<?php
$setuju_list->showMessage();
?>
<?php if ($setuju_list->TotalRecords > 0 || $setuju->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($setuju_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> setuju">
<?php if (!$setuju_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$setuju_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $setuju_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $setuju_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsetujulist" id="fsetujulist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="setuju">
<div id="gmp_setuju" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($setuju_list->TotalRecords > 0 || $setuju_list->isGridEdit()) { ?>
<table id="tbl_setujulist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$setuju->RowType = ROWTYPE_HEADER;

// Render list options
$setuju_list->renderListOptions();

// Render list options (header, left)
$setuju_list->ListOptions->render("header", "left");
?>
<?php if ($setuju_list->name->Visible) { // name ?>
	<?php if ($setuju_list->SortUrl($setuju_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $setuju_list->name->headerCellClass() ?>"><div id="elh_setuju_name" class="setuju_name"><div class="ew-table-header-caption"><?php echo $setuju_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $setuju_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $setuju_list->SortUrl($setuju_list->name) ?>', 1);"><div id="elh_setuju_name" class="setuju_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $setuju_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($setuju_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($setuju_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$setuju_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($setuju_list->ExportAll && $setuju_list->isExport()) {
	$setuju_list->StopRecord = $setuju_list->TotalRecords;
} else {

	// Set the last record to display
	if ($setuju_list->TotalRecords > $setuju_list->StartRecord + $setuju_list->DisplayRecords - 1)
		$setuju_list->StopRecord = $setuju_list->StartRecord + $setuju_list->DisplayRecords - 1;
	else
		$setuju_list->StopRecord = $setuju_list->TotalRecords;
}
$setuju_list->RecordCount = $setuju_list->StartRecord - 1;
if ($setuju_list->Recordset && !$setuju_list->Recordset->EOF) {
	$setuju_list->Recordset->moveFirst();
	$selectLimit = $setuju_list->UseSelectLimit;
	if (!$selectLimit && $setuju_list->StartRecord > 1)
		$setuju_list->Recordset->move($setuju_list->StartRecord - 1);
} elseif (!$setuju->AllowAddDeleteRow && $setuju_list->StopRecord == 0) {
	$setuju_list->StopRecord = $setuju->GridAddRowCount;
}

// Initialize aggregate
$setuju->RowType = ROWTYPE_AGGREGATEINIT;
$setuju->resetAttributes();
$setuju_list->renderRow();
while ($setuju_list->RecordCount < $setuju_list->StopRecord) {
	$setuju_list->RecordCount++;
	if ($setuju_list->RecordCount >= $setuju_list->StartRecord) {
		$setuju_list->RowCount++;

		// Set up key count
		$setuju_list->KeyCount = $setuju_list->RowIndex;

		// Init row class and style
		$setuju->resetAttributes();
		$setuju->CssClass = "";
		if ($setuju_list->isGridAdd()) {
		} else {
			$setuju_list->loadRowValues($setuju_list->Recordset); // Load row values
		}
		$setuju->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$setuju->RowAttrs->merge(["data-rowindex" => $setuju_list->RowCount, "id" => "r" . $setuju_list->RowCount . "_setuju", "data-rowtype" => $setuju->RowType]);

		// Render row
		$setuju_list->renderRow();

		// Render list options
		$setuju_list->renderListOptions();
?>
	<tr <?php echo $setuju->rowAttributes() ?>>
<?php

// Render list options (body, left)
$setuju_list->ListOptions->render("body", "left", $setuju_list->RowCount);
?>
	<?php if ($setuju_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $setuju_list->name->cellAttributes() ?>>
<span id="el<?php echo $setuju_list->RowCount ?>_setuju_name">
<span<?php echo $setuju_list->name->viewAttributes() ?>><?php echo $setuju_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$setuju_list->ListOptions->render("body", "right", $setuju_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$setuju_list->isGridAdd())
		$setuju_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$setuju->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($setuju_list->Recordset)
	$setuju_list->Recordset->Close();
?>
<?php if (!$setuju_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$setuju_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $setuju_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $setuju_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($setuju_list->TotalRecords == 0 && !$setuju->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $setuju_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$setuju_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$setuju_list->isExport()) { ?>
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
$setuju_list->terminate();
?>