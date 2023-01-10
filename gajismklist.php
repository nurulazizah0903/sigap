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
$gajismk_list = new gajismk_list();

// Run the page
$gajismk_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajismk_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajismk_list->isExport()) { ?>
<script>
var fgajismklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgajismklist = currentForm = new ew.Form("fgajismklist", "list");
	fgajismklist.formKeyCountName = '<?php echo $gajismk_list->FormKeyCountName ?>';
	loadjs.done("fgajismklist");
});
var fgajismklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fgajismklistsrch = currentSearchForm = new ew.Form("fgajismklistsrch");

	// Dynamic selection lists
	// Filters

	fgajismklistsrch.filterList = <?php echo $gajismk_list->getFilterList() ?>;
	loadjs.done("fgajismklistsrch");
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
<?php if (!$gajismk_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gajismk_list->TotalRecords > 0 && $gajismk_list->ExportOptions->visible()) { ?>
<?php $gajismk_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gajismk_list->ImportOptions->visible()) { ?>
<?php $gajismk_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($gajismk_list->SearchOptions->visible()) { ?>
<?php $gajismk_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($gajismk_list->FilterOptions->visible()) { ?>
<?php $gajismk_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$gajismk_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$gajismk_list->isExport() && !$gajismk->CurrentAction) { ?>
<form name="fgajismklistsrch" id="fgajismklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fgajismklistsrch-search-panel" class="<?php echo $gajismk_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="gajismk">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $gajismk_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($gajismk_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($gajismk_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $gajismk_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($gajismk_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($gajismk_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($gajismk_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($gajismk_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $gajismk_list->showPageHeader(); ?>
<?php
$gajismk_list->showMessage();
?>
<?php if ($gajismk_list->TotalRecords > 0 || $gajismk->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gajismk_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajismk">
<?php if (!$gajismk_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gajismk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajismk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajismk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgajismklist" id="fgajismklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajismk">
<div id="gmp_gajismk" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gajismk_list->TotalRecords > 0 || $gajismk_list->isGridEdit()) { ?>
<table id="tbl_gajismklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gajismk->RowType = ROWTYPE_HEADER;

// Render list options
$gajismk_list->renderListOptions();

// Render list options (header, left)
$gajismk_list->ListOptions->render("header", "left");
?>
<?php if ($gajismk_list->tahun->Visible) { // tahun ?>
	<?php if ($gajismk_list->SortUrl($gajismk_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $gajismk_list->tahun->headerCellClass() ?>"><div id="elh_gajismk_tahun" class="gajismk_tahun"><div class="ew-table-header-caption"><?php echo $gajismk_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $gajismk_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismk_list->SortUrl($gajismk_list->tahun) ?>', 1);"><div id="elh_gajismk_tahun" class="gajismk_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismk_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismk_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismk_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismk_list->bulan->Visible) { // bulan ?>
	<?php if ($gajismk_list->SortUrl($gajismk_list->bulan) == "") { ?>
		<th data-name="bulan" class="<?php echo $gajismk_list->bulan->headerCellClass() ?>"><div id="elh_gajismk_bulan" class="gajismk_bulan"><div class="ew-table-header-caption"><?php echo $gajismk_list->bulan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bulan" class="<?php echo $gajismk_list->bulan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismk_list->SortUrl($gajismk_list->bulan) ?>', 1);"><div id="elh_gajismk_bulan" class="gajismk_bulan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismk_list->bulan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismk_list->bulan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismk_list->bulan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismk_list->datetime->Visible) { // datetime ?>
	<?php if ($gajismk_list->SortUrl($gajismk_list->datetime) == "") { ?>
		<th data-name="datetime" class="<?php echo $gajismk_list->datetime->headerCellClass() ?>"><div id="elh_gajismk_datetime" class="gajismk_datetime"><div class="ew-table-header-caption"><?php echo $gajismk_list->datetime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="datetime" class="<?php echo $gajismk_list->datetime->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismk_list->SortUrl($gajismk_list->datetime) ?>', 1);"><div id="elh_gajismk_datetime" class="gajismk_datetime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismk_list->datetime->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismk_list->datetime->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismk_list->datetime->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismk_list->createby->Visible) { // createby ?>
	<?php if ($gajismk_list->SortUrl($gajismk_list->createby) == "") { ?>
		<th data-name="createby" class="<?php echo $gajismk_list->createby->headerCellClass() ?>"><div id="elh_gajismk_createby" class="gajismk_createby"><div class="ew-table-header-caption"><?php echo $gajismk_list->createby->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createby" class="<?php echo $gajismk_list->createby->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismk_list->SortUrl($gajismk_list->createby) ?>', 1);"><div id="elh_gajismk_createby" class="gajismk_createby">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismk_list->createby->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($gajismk_list->createby->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismk_list->createby->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajismk_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gajismk_list->ExportAll && $gajismk_list->isExport()) {
	$gajismk_list->StopRecord = $gajismk_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gajismk_list->TotalRecords > $gajismk_list->StartRecord + $gajismk_list->DisplayRecords - 1)
		$gajismk_list->StopRecord = $gajismk_list->StartRecord + $gajismk_list->DisplayRecords - 1;
	else
		$gajismk_list->StopRecord = $gajismk_list->TotalRecords;
}
$gajismk_list->RecordCount = $gajismk_list->StartRecord - 1;
if ($gajismk_list->Recordset && !$gajismk_list->Recordset->EOF) {
	$gajismk_list->Recordset->moveFirst();
	$selectLimit = $gajismk_list->UseSelectLimit;
	if (!$selectLimit && $gajismk_list->StartRecord > 1)
		$gajismk_list->Recordset->move($gajismk_list->StartRecord - 1);
} elseif (!$gajismk->AllowAddDeleteRow && $gajismk_list->StopRecord == 0) {
	$gajismk_list->StopRecord = $gajismk->GridAddRowCount;
}

// Initialize aggregate
$gajismk->RowType = ROWTYPE_AGGREGATEINIT;
$gajismk->resetAttributes();
$gajismk_list->renderRow();
while ($gajismk_list->RecordCount < $gajismk_list->StopRecord) {
	$gajismk_list->RecordCount++;
	if ($gajismk_list->RecordCount >= $gajismk_list->StartRecord) {
		$gajismk_list->RowCount++;

		// Set up key count
		$gajismk_list->KeyCount = $gajismk_list->RowIndex;

		// Init row class and style
		$gajismk->resetAttributes();
		$gajismk->CssClass = "";
		if ($gajismk_list->isGridAdd()) {
		} else {
			$gajismk_list->loadRowValues($gajismk_list->Recordset); // Load row values
		}
		$gajismk->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gajismk->RowAttrs->merge(["data-rowindex" => $gajismk_list->RowCount, "id" => "r" . $gajismk_list->RowCount . "_gajismk", "data-rowtype" => $gajismk->RowType]);

		// Render row
		$gajismk_list->renderRow();

		// Render list options
		$gajismk_list->renderListOptions();
?>
	<tr <?php echo $gajismk->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajismk_list->ListOptions->render("body", "left", $gajismk_list->RowCount);
?>
	<?php if ($gajismk_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $gajismk_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $gajismk_list->RowCount ?>_gajismk_tahun">
<span<?php echo $gajismk_list->tahun->viewAttributes() ?>><?php echo $gajismk_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismk_list->bulan->Visible) { // bulan ?>
		<td data-name="bulan" <?php echo $gajismk_list->bulan->cellAttributes() ?>>
<span id="el<?php echo $gajismk_list->RowCount ?>_gajismk_bulan">
<span<?php echo $gajismk_list->bulan->viewAttributes() ?>><?php echo $gajismk_list->bulan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismk_list->datetime->Visible) { // datetime ?>
		<td data-name="datetime" <?php echo $gajismk_list->datetime->cellAttributes() ?>>
<span id="el<?php echo $gajismk_list->RowCount ?>_gajismk_datetime">
<span<?php echo $gajismk_list->datetime->viewAttributes() ?>><?php echo $gajismk_list->datetime->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismk_list->createby->Visible) { // createby ?>
		<td data-name="createby" <?php echo $gajismk_list->createby->cellAttributes() ?>>
<span id="el<?php echo $gajismk_list->RowCount ?>_gajismk_createby">
<span<?php echo $gajismk_list->createby->viewAttributes() ?>><?php echo $gajismk_list->createby->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajismk_list->ListOptions->render("body", "right", $gajismk_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gajismk_list->isGridAdd())
		$gajismk_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gajismk->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gajismk_list->Recordset)
	$gajismk_list->Recordset->Close();
?>
<?php if (!$gajismk_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gajismk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajismk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajismk_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gajismk_list->TotalRecords == 0 && !$gajismk->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gajismk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gajismk_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajismk_list->isExport()) { ?>
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
$gajismk_list->terminate();
?>