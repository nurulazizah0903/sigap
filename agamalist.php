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
$agama_list = new agama_list();

// Run the page
$agama_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$agama_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$agama_list->isExport()) { ?>
<script>
var fagamalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fagamalist = currentForm = new ew.Form("fagamalist", "list");
	fagamalist.formKeyCountName = '<?php echo $agama_list->FormKeyCountName ?>';
	loadjs.done("fagamalist");
});
var fagamalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fagamalistsrch = currentSearchForm = new ew.Form("fagamalistsrch");

	// Dynamic selection lists
	// Filters

	fagamalistsrch.filterList = <?php echo $agama_list->getFilterList() ?>;
	loadjs.done("fagamalistsrch");
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
<?php if (!$agama_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($agama_list->TotalRecords > 0 && $agama_list->ExportOptions->visible()) { ?>
<?php $agama_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($agama_list->ImportOptions->visible()) { ?>
<?php $agama_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($agama_list->SearchOptions->visible()) { ?>
<?php $agama_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($agama_list->FilterOptions->visible()) { ?>
<?php $agama_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$agama_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$agama_list->isExport() && !$agama->CurrentAction) { ?>
<form name="fagamalistsrch" id="fagamalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fagamalistsrch-search-panel" class="<?php echo $agama_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="agama">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $agama_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($agama_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($agama_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $agama_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($agama_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($agama_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($agama_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($agama_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $agama_list->showPageHeader(); ?>
<?php
$agama_list->showMessage();
?>
<?php if ($agama_list->TotalRecords > 0 || $agama->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($agama_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> agama">
<?php if (!$agama_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$agama_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $agama_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $agama_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fagamalist" id="fagamalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="agama">
<div id="gmp_agama" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($agama_list->TotalRecords > 0 || $agama_list->isGridEdit()) { ?>
<table id="tbl_agamalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$agama->RowType = ROWTYPE_HEADER;

// Render list options
$agama_list->renderListOptions();

// Render list options (header, left)
$agama_list->ListOptions->render("header", "left");
?>
<?php if ($agama_list->id->Visible) { // id ?>
	<?php if ($agama_list->SortUrl($agama_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $agama_list->id->headerCellClass() ?>"><div id="elh_agama_id" class="agama_id"><div class="ew-table-header-caption"><?php echo $agama_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $agama_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agama_list->SortUrl($agama_list->id) ?>', 1);"><div id="elh_agama_id" class="agama_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agama_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($agama_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agama_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($agama_list->name->Visible) { // name ?>
	<?php if ($agama_list->SortUrl($agama_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $agama_list->name->headerCellClass() ?>"><div id="elh_agama_name" class="agama_name"><div class="ew-table-header-caption"><?php echo $agama_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $agama_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $agama_list->SortUrl($agama_list->name) ?>', 1);"><div id="elh_agama_name" class="agama_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $agama_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($agama_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($agama_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$agama_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($agama_list->ExportAll && $agama_list->isExport()) {
	$agama_list->StopRecord = $agama_list->TotalRecords;
} else {

	// Set the last record to display
	if ($agama_list->TotalRecords > $agama_list->StartRecord + $agama_list->DisplayRecords - 1)
		$agama_list->StopRecord = $agama_list->StartRecord + $agama_list->DisplayRecords - 1;
	else
		$agama_list->StopRecord = $agama_list->TotalRecords;
}
$agama_list->RecordCount = $agama_list->StartRecord - 1;
if ($agama_list->Recordset && !$agama_list->Recordset->EOF) {
	$agama_list->Recordset->moveFirst();
	$selectLimit = $agama_list->UseSelectLimit;
	if (!$selectLimit && $agama_list->StartRecord > 1)
		$agama_list->Recordset->move($agama_list->StartRecord - 1);
} elseif (!$agama->AllowAddDeleteRow && $agama_list->StopRecord == 0) {
	$agama_list->StopRecord = $agama->GridAddRowCount;
}

// Initialize aggregate
$agama->RowType = ROWTYPE_AGGREGATEINIT;
$agama->resetAttributes();
$agama_list->renderRow();
while ($agama_list->RecordCount < $agama_list->StopRecord) {
	$agama_list->RecordCount++;
	if ($agama_list->RecordCount >= $agama_list->StartRecord) {
		$agama_list->RowCount++;

		// Set up key count
		$agama_list->KeyCount = $agama_list->RowIndex;

		// Init row class and style
		$agama->resetAttributes();
		$agama->CssClass = "";
		if ($agama_list->isGridAdd()) {
		} else {
			$agama_list->loadRowValues($agama_list->Recordset); // Load row values
		}
		$agama->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$agama->RowAttrs->merge(["data-rowindex" => $agama_list->RowCount, "id" => "r" . $agama_list->RowCount . "_agama", "data-rowtype" => $agama->RowType]);

		// Render row
		$agama_list->renderRow();

		// Render list options
		$agama_list->renderListOptions();
?>
	<tr <?php echo $agama->rowAttributes() ?>>
<?php

// Render list options (body, left)
$agama_list->ListOptions->render("body", "left", $agama_list->RowCount);
?>
	<?php if ($agama_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $agama_list->id->cellAttributes() ?>>
<span id="el<?php echo $agama_list->RowCount ?>_agama_id">
<span<?php echo $agama_list->id->viewAttributes() ?>><?php echo $agama_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($agama_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $agama_list->name->cellAttributes() ?>>
<span id="el<?php echo $agama_list->RowCount ?>_agama_name">
<span<?php echo $agama_list->name->viewAttributes() ?>><?php echo $agama_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$agama_list->ListOptions->render("body", "right", $agama_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$agama_list->isGridAdd())
		$agama_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$agama->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($agama_list->Recordset)
	$agama_list->Recordset->Close();
?>
<?php if (!$agama_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$agama_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $agama_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $agama_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($agama_list->TotalRecords == 0 && !$agama->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $agama_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$agama_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$agama_list->isExport()) { ?>
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
$agama_list->terminate();
?>