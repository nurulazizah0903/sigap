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
$gender_list = new gender_list();

// Run the page
$gender_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gender_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gender_list->isExport()) { ?>
<script>
var fgenderlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgenderlist = currentForm = new ew.Form("fgenderlist", "list");
	fgenderlist.formKeyCountName = '<?php echo $gender_list->FormKeyCountName ?>';
	loadjs.done("fgenderlist");
});
var fgenderlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fgenderlistsrch = currentSearchForm = new ew.Form("fgenderlistsrch");

	// Dynamic selection lists
	// Filters

	fgenderlistsrch.filterList = <?php echo $gender_list->getFilterList() ?>;
	loadjs.done("fgenderlistsrch");
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
<?php if (!$gender_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gender_list->TotalRecords > 0 && $gender_list->ExportOptions->visible()) { ?>
<?php $gender_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gender_list->ImportOptions->visible()) { ?>
<?php $gender_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($gender_list->SearchOptions->visible()) { ?>
<?php $gender_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($gender_list->FilterOptions->visible()) { ?>
<?php $gender_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$gender_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$gender_list->isExport() && !$gender->CurrentAction) { ?>
<form name="fgenderlistsrch" id="fgenderlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fgenderlistsrch-search-panel" class="<?php echo $gender_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="gender">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $gender_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($gender_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($gender_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $gender_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($gender_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($gender_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($gender_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($gender_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $gender_list->showPageHeader(); ?>
<?php
$gender_list->showMessage();
?>
<?php if ($gender_list->TotalRecords > 0 || $gender->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gender_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gender">
<?php if (!$gender_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gender_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gender_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gender_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgenderlist" id="fgenderlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gender">
<div id="gmp_gender" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gender_list->TotalRecords > 0 || $gender_list->isGridEdit()) { ?>
<table id="tbl_genderlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gender->RowType = ROWTYPE_HEADER;

// Render list options
$gender_list->renderListOptions();

// Render list options (header, left)
$gender_list->ListOptions->render("header", "left");
?>
<?php if ($gender_list->id->Visible) { // id ?>
	<?php if ($gender_list->SortUrl($gender_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $gender_list->id->headerCellClass() ?>"><div id="elh_gender_id" class="gender_id"><div class="ew-table-header-caption"><?php echo $gender_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $gender_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gender_list->SortUrl($gender_list->id) ?>', 1);"><div id="elh_gender_id" class="gender_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gender_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gender_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gender_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gender_list->gen->Visible) { // gen ?>
	<?php if ($gender_list->SortUrl($gender_list->gen) == "") { ?>
		<th data-name="gen" class="<?php echo $gender_list->gen->headerCellClass() ?>"><div id="elh_gender_gen" class="gender_gen"><div class="ew-table-header-caption"><?php echo $gender_list->gen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gen" class="<?php echo $gender_list->gen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gender_list->SortUrl($gender_list->gen) ?>', 1);"><div id="elh_gender_gen" class="gender_gen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gender_list->gen->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($gender_list->gen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gender_list->gen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gender_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gender_list->ExportAll && $gender_list->isExport()) {
	$gender_list->StopRecord = $gender_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gender_list->TotalRecords > $gender_list->StartRecord + $gender_list->DisplayRecords - 1)
		$gender_list->StopRecord = $gender_list->StartRecord + $gender_list->DisplayRecords - 1;
	else
		$gender_list->StopRecord = $gender_list->TotalRecords;
}
$gender_list->RecordCount = $gender_list->StartRecord - 1;
if ($gender_list->Recordset && !$gender_list->Recordset->EOF) {
	$gender_list->Recordset->moveFirst();
	$selectLimit = $gender_list->UseSelectLimit;
	if (!$selectLimit && $gender_list->StartRecord > 1)
		$gender_list->Recordset->move($gender_list->StartRecord - 1);
} elseif (!$gender->AllowAddDeleteRow && $gender_list->StopRecord == 0) {
	$gender_list->StopRecord = $gender->GridAddRowCount;
}

// Initialize aggregate
$gender->RowType = ROWTYPE_AGGREGATEINIT;
$gender->resetAttributes();
$gender_list->renderRow();
while ($gender_list->RecordCount < $gender_list->StopRecord) {
	$gender_list->RecordCount++;
	if ($gender_list->RecordCount >= $gender_list->StartRecord) {
		$gender_list->RowCount++;

		// Set up key count
		$gender_list->KeyCount = $gender_list->RowIndex;

		// Init row class and style
		$gender->resetAttributes();
		$gender->CssClass = "";
		if ($gender_list->isGridAdd()) {
		} else {
			$gender_list->loadRowValues($gender_list->Recordset); // Load row values
		}
		$gender->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gender->RowAttrs->merge(["data-rowindex" => $gender_list->RowCount, "id" => "r" . $gender_list->RowCount . "_gender", "data-rowtype" => $gender->RowType]);

		// Render row
		$gender_list->renderRow();

		// Render list options
		$gender_list->renderListOptions();
?>
	<tr <?php echo $gender->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gender_list->ListOptions->render("body", "left", $gender_list->RowCount);
?>
	<?php if ($gender_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $gender_list->id->cellAttributes() ?>>
<span id="el<?php echo $gender_list->RowCount ?>_gender_id">
<span<?php echo $gender_list->id->viewAttributes() ?>><?php echo $gender_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gender_list->gen->Visible) { // gen ?>
		<td data-name="gen" <?php echo $gender_list->gen->cellAttributes() ?>>
<span id="el<?php echo $gender_list->RowCount ?>_gender_gen">
<span<?php echo $gender_list->gen->viewAttributes() ?>><?php echo $gender_list->gen->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gender_list->ListOptions->render("body", "right", $gender_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gender_list->isGridAdd())
		$gender_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gender->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gender_list->Recordset)
	$gender_list->Recordset->Close();
?>
<?php if (!$gender_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gender_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gender_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gender_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gender_list->TotalRecords == 0 && !$gender->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gender_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gender_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gender_list->isExport()) { ?>
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
$gender_list->terminate();
?>