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
$ijazah_list = new ijazah_list();

// Run the page
$ijazah_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ijazah_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ijazah_list->isExport()) { ?>
<script>
var fijazahlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fijazahlist = currentForm = new ew.Form("fijazahlist", "list");
	fijazahlist.formKeyCountName = '<?php echo $ijazah_list->FormKeyCountName ?>';
	loadjs.done("fijazahlist");
});
var fijazahlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fijazahlistsrch = currentSearchForm = new ew.Form("fijazahlistsrch");

	// Dynamic selection lists
	// Filters

	fijazahlistsrch.filterList = <?php echo $ijazah_list->getFilterList() ?>;
	loadjs.done("fijazahlistsrch");
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
<?php if (!$ijazah_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ijazah_list->TotalRecords > 0 && $ijazah_list->ExportOptions->visible()) { ?>
<?php $ijazah_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ijazah_list->ImportOptions->visible()) { ?>
<?php $ijazah_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ijazah_list->SearchOptions->visible()) { ?>
<?php $ijazah_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ijazah_list->FilterOptions->visible()) { ?>
<?php $ijazah_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ijazah_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ijazah_list->isExport() && !$ijazah->CurrentAction) { ?>
<form name="fijazahlistsrch" id="fijazahlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fijazahlistsrch-search-panel" class="<?php echo $ijazah_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ijazah">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ijazah_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ijazah_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ijazah_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ijazah_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ijazah_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ijazah_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ijazah_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ijazah_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ijazah_list->showPageHeader(); ?>
<?php
$ijazah_list->showMessage();
?>
<?php if ($ijazah_list->TotalRecords > 0 || $ijazah->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ijazah_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ijazah">
<?php if (!$ijazah_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ijazah_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ijazah_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ijazah_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fijazahlist" id="fijazahlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ijazah">
<div id="gmp_ijazah" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ijazah_list->TotalRecords > 0 || $ijazah_list->isGridEdit()) { ?>
<table id="tbl_ijazahlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ijazah->RowType = ROWTYPE_HEADER;

// Render list options
$ijazah_list->renderListOptions();

// Render list options (header, left)
$ijazah_list->ListOptions->render("header", "left");
?>
<?php if ($ijazah_list->name->Visible) { // name ?>
	<?php if ($ijazah_list->SortUrl($ijazah_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $ijazah_list->name->headerCellClass() ?>"><div id="elh_ijazah_name" class="ijazah_name"><div class="ew-table-header-caption"><?php echo $ijazah_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $ijazah_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ijazah_list->SortUrl($ijazah_list->name) ?>', 1);"><div id="elh_ijazah_name" class="ijazah_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ijazah_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ijazah_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ijazah_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ijazah_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ijazah_list->ExportAll && $ijazah_list->isExport()) {
	$ijazah_list->StopRecord = $ijazah_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ijazah_list->TotalRecords > $ijazah_list->StartRecord + $ijazah_list->DisplayRecords - 1)
		$ijazah_list->StopRecord = $ijazah_list->StartRecord + $ijazah_list->DisplayRecords - 1;
	else
		$ijazah_list->StopRecord = $ijazah_list->TotalRecords;
}
$ijazah_list->RecordCount = $ijazah_list->StartRecord - 1;
if ($ijazah_list->Recordset && !$ijazah_list->Recordset->EOF) {
	$ijazah_list->Recordset->moveFirst();
	$selectLimit = $ijazah_list->UseSelectLimit;
	if (!$selectLimit && $ijazah_list->StartRecord > 1)
		$ijazah_list->Recordset->move($ijazah_list->StartRecord - 1);
} elseif (!$ijazah->AllowAddDeleteRow && $ijazah_list->StopRecord == 0) {
	$ijazah_list->StopRecord = $ijazah->GridAddRowCount;
}

// Initialize aggregate
$ijazah->RowType = ROWTYPE_AGGREGATEINIT;
$ijazah->resetAttributes();
$ijazah_list->renderRow();
while ($ijazah_list->RecordCount < $ijazah_list->StopRecord) {
	$ijazah_list->RecordCount++;
	if ($ijazah_list->RecordCount >= $ijazah_list->StartRecord) {
		$ijazah_list->RowCount++;

		// Set up key count
		$ijazah_list->KeyCount = $ijazah_list->RowIndex;

		// Init row class and style
		$ijazah->resetAttributes();
		$ijazah->CssClass = "";
		if ($ijazah_list->isGridAdd()) {
		} else {
			$ijazah_list->loadRowValues($ijazah_list->Recordset); // Load row values
		}
		$ijazah->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ijazah->RowAttrs->merge(["data-rowindex" => $ijazah_list->RowCount, "id" => "r" . $ijazah_list->RowCount . "_ijazah", "data-rowtype" => $ijazah->RowType]);

		// Render row
		$ijazah_list->renderRow();

		// Render list options
		$ijazah_list->renderListOptions();
?>
	<tr <?php echo $ijazah->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ijazah_list->ListOptions->render("body", "left", $ijazah_list->RowCount);
?>
	<?php if ($ijazah_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $ijazah_list->name->cellAttributes() ?>>
<span id="el<?php echo $ijazah_list->RowCount ?>_ijazah_name">
<span<?php echo $ijazah_list->name->viewAttributes() ?>><?php echo $ijazah_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ijazah_list->ListOptions->render("body", "right", $ijazah_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ijazah_list->isGridAdd())
		$ijazah_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ijazah->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ijazah_list->Recordset)
	$ijazah_list->Recordset->Close();
?>
<?php if (!$ijazah_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ijazah_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ijazah_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ijazah_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ijazah_list->TotalRecords == 0 && !$ijazah->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ijazah_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ijazah_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ijazah_list->isExport()) { ?>
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
$ijazah_list->terminate();
?>