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
$mpendidikan_list = new mpendidikan_list();

// Run the page
$mpendidikan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$mpendidikan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$mpendidikan_list->isExport()) { ?>
<script>
var fmpendidikanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmpendidikanlist = currentForm = new ew.Form("fmpendidikanlist", "list");
	fmpendidikanlist.formKeyCountName = '<?php echo $mpendidikan_list->FormKeyCountName ?>';
	loadjs.done("fmpendidikanlist");
});
var fmpendidikanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmpendidikanlistsrch = currentSearchForm = new ew.Form("fmpendidikanlistsrch");

	// Dynamic selection lists
	// Filters

	fmpendidikanlistsrch.filterList = <?php echo $mpendidikan_list->getFilterList() ?>;
	loadjs.done("fmpendidikanlistsrch");
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
<?php if (!$mpendidikan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($mpendidikan_list->TotalRecords > 0 && $mpendidikan_list->ExportOptions->visible()) { ?>
<?php $mpendidikan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($mpendidikan_list->ImportOptions->visible()) { ?>
<?php $mpendidikan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($mpendidikan_list->SearchOptions->visible()) { ?>
<?php $mpendidikan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($mpendidikan_list->FilterOptions->visible()) { ?>
<?php $mpendidikan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$mpendidikan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$mpendidikan_list->isExport() && !$mpendidikan->CurrentAction) { ?>
<form name="fmpendidikanlistsrch" id="fmpendidikanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmpendidikanlistsrch-search-panel" class="<?php echo $mpendidikan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="mpendidikan">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $mpendidikan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($mpendidikan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($mpendidikan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $mpendidikan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($mpendidikan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($mpendidikan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($mpendidikan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($mpendidikan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $mpendidikan_list->showPageHeader(); ?>
<?php
$mpendidikan_list->showMessage();
?>
<?php if ($mpendidikan_list->TotalRecords > 0 || $mpendidikan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($mpendidikan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> mpendidikan">
<?php if (!$mpendidikan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$mpendidikan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $mpendidikan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $mpendidikan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmpendidikanlist" id="fmpendidikanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="mpendidikan">
<div id="gmp_mpendidikan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($mpendidikan_list->TotalRecords > 0 || $mpendidikan_list->isGridEdit()) { ?>
<table id="tbl_mpendidikanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$mpendidikan->RowType = ROWTYPE_HEADER;

// Render list options
$mpendidikan_list->renderListOptions();

// Render list options (header, left)
$mpendidikan_list->ListOptions->render("header", "left");
?>
<?php if ($mpendidikan_list->name->Visible) { // name ?>
	<?php if ($mpendidikan_list->SortUrl($mpendidikan_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $mpendidikan_list->name->headerCellClass() ?>"><div id="elh_mpendidikan_name" class="mpendidikan_name"><div class="ew-table-header-caption"><?php echo $mpendidikan_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $mpendidikan_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $mpendidikan_list->SortUrl($mpendidikan_list->name) ?>', 1);"><div id="elh_mpendidikan_name" class="mpendidikan_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $mpendidikan_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($mpendidikan_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($mpendidikan_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$mpendidikan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($mpendidikan_list->ExportAll && $mpendidikan_list->isExport()) {
	$mpendidikan_list->StopRecord = $mpendidikan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($mpendidikan_list->TotalRecords > $mpendidikan_list->StartRecord + $mpendidikan_list->DisplayRecords - 1)
		$mpendidikan_list->StopRecord = $mpendidikan_list->StartRecord + $mpendidikan_list->DisplayRecords - 1;
	else
		$mpendidikan_list->StopRecord = $mpendidikan_list->TotalRecords;
}
$mpendidikan_list->RecordCount = $mpendidikan_list->StartRecord - 1;
if ($mpendidikan_list->Recordset && !$mpendidikan_list->Recordset->EOF) {
	$mpendidikan_list->Recordset->moveFirst();
	$selectLimit = $mpendidikan_list->UseSelectLimit;
	if (!$selectLimit && $mpendidikan_list->StartRecord > 1)
		$mpendidikan_list->Recordset->move($mpendidikan_list->StartRecord - 1);
} elseif (!$mpendidikan->AllowAddDeleteRow && $mpendidikan_list->StopRecord == 0) {
	$mpendidikan_list->StopRecord = $mpendidikan->GridAddRowCount;
}

// Initialize aggregate
$mpendidikan->RowType = ROWTYPE_AGGREGATEINIT;
$mpendidikan->resetAttributes();
$mpendidikan_list->renderRow();
while ($mpendidikan_list->RecordCount < $mpendidikan_list->StopRecord) {
	$mpendidikan_list->RecordCount++;
	if ($mpendidikan_list->RecordCount >= $mpendidikan_list->StartRecord) {
		$mpendidikan_list->RowCount++;

		// Set up key count
		$mpendidikan_list->KeyCount = $mpendidikan_list->RowIndex;

		// Init row class and style
		$mpendidikan->resetAttributes();
		$mpendidikan->CssClass = "";
		if ($mpendidikan_list->isGridAdd()) {
		} else {
			$mpendidikan_list->loadRowValues($mpendidikan_list->Recordset); // Load row values
		}
		$mpendidikan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$mpendidikan->RowAttrs->merge(["data-rowindex" => $mpendidikan_list->RowCount, "id" => "r" . $mpendidikan_list->RowCount . "_mpendidikan", "data-rowtype" => $mpendidikan->RowType]);

		// Render row
		$mpendidikan_list->renderRow();

		// Render list options
		$mpendidikan_list->renderListOptions();
?>
	<tr <?php echo $mpendidikan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$mpendidikan_list->ListOptions->render("body", "left", $mpendidikan_list->RowCount);
?>
	<?php if ($mpendidikan_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $mpendidikan_list->name->cellAttributes() ?>>
<span id="el<?php echo $mpendidikan_list->RowCount ?>_mpendidikan_name">
<span<?php echo $mpendidikan_list->name->viewAttributes() ?>><?php echo $mpendidikan_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$mpendidikan_list->ListOptions->render("body", "right", $mpendidikan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$mpendidikan_list->isGridAdd())
		$mpendidikan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$mpendidikan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($mpendidikan_list->Recordset)
	$mpendidikan_list->Recordset->Close();
?>
<?php if (!$mpendidikan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$mpendidikan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $mpendidikan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $mpendidikan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($mpendidikan_list->TotalRecords == 0 && !$mpendidikan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $mpendidikan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$mpendidikan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$mpendidikan_list->isExport()) { ?>
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
$mpendidikan_list->terminate();
?>