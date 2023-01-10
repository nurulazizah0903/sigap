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
$bulan_list = new bulan_list();

// Run the page
$bulan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bulan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bulan_list->isExport()) { ?>
<script>
var fbulanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbulanlist = currentForm = new ew.Form("fbulanlist", "list");
	fbulanlist.formKeyCountName = '<?php echo $bulan_list->FormKeyCountName ?>';
	loadjs.done("fbulanlist");
});
var fbulanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbulanlistsrch = currentSearchForm = new ew.Form("fbulanlistsrch");

	// Dynamic selection lists
	// Filters

	fbulanlistsrch.filterList = <?php echo $bulan_list->getFilterList() ?>;
	loadjs.done("fbulanlistsrch");
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
<?php if (!$bulan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($bulan_list->TotalRecords > 0 && $bulan_list->ExportOptions->visible()) { ?>
<?php $bulan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($bulan_list->ImportOptions->visible()) { ?>
<?php $bulan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($bulan_list->SearchOptions->visible()) { ?>
<?php $bulan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($bulan_list->FilterOptions->visible()) { ?>
<?php $bulan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$bulan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$bulan_list->isExport() && !$bulan->CurrentAction) { ?>
<form name="fbulanlistsrch" id="fbulanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbulanlistsrch-search-panel" class="<?php echo $bulan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="bulan">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $bulan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($bulan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($bulan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $bulan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($bulan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($bulan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($bulan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($bulan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $bulan_list->showPageHeader(); ?>
<?php
$bulan_list->showMessage();
?>
<?php if ($bulan_list->TotalRecords > 0 || $bulan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($bulan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bulan">
<?php if (!$bulan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$bulan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bulan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bulan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbulanlist" id="fbulanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bulan">
<div id="gmp_bulan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($bulan_list->TotalRecords > 0 || $bulan_list->isGridEdit()) { ?>
<table id="tbl_bulanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$bulan->RowType = ROWTYPE_HEADER;

// Render list options
$bulan_list->renderListOptions();

// Render list options (header, left)
$bulan_list->ListOptions->render("header", "left");
?>
<?php if ($bulan_list->id->Visible) { // id ?>
	<?php if ($bulan_list->SortUrl($bulan_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $bulan_list->id->headerCellClass() ?>"><div id="elh_bulan_id" class="bulan_id"><div class="ew-table-header-caption"><?php echo $bulan_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $bulan_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bulan_list->SortUrl($bulan_list->id) ?>', 1);"><div id="elh_bulan_id" class="bulan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bulan_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($bulan_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bulan_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bulan_list->nourut->Visible) { // nourut ?>
	<?php if ($bulan_list->SortUrl($bulan_list->nourut) == "") { ?>
		<th data-name="nourut" class="<?php echo $bulan_list->nourut->headerCellClass() ?>"><div id="elh_bulan_nourut" class="bulan_nourut"><div class="ew-table-header-caption"><?php echo $bulan_list->nourut->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nourut" class="<?php echo $bulan_list->nourut->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bulan_list->SortUrl($bulan_list->nourut) ?>', 1);"><div id="elh_bulan_nourut" class="bulan_nourut">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bulan_list->nourut->caption() ?></span><span class="ew-table-header-sort"><?php if ($bulan_list->nourut->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bulan_list->nourut->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bulan_list->bulan->Visible) { // bulan ?>
	<?php if ($bulan_list->SortUrl($bulan_list->bulan) == "") { ?>
		<th data-name="bulan" class="<?php echo $bulan_list->bulan->headerCellClass() ?>"><div id="elh_bulan_bulan" class="bulan_bulan"><div class="ew-table-header-caption"><?php echo $bulan_list->bulan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bulan" class="<?php echo $bulan_list->bulan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bulan_list->SortUrl($bulan_list->bulan) ?>', 1);"><div id="elh_bulan_bulan" class="bulan_bulan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bulan_list->bulan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bulan_list->bulan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bulan_list->bulan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bulan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($bulan_list->ExportAll && $bulan_list->isExport()) {
	$bulan_list->StopRecord = $bulan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($bulan_list->TotalRecords > $bulan_list->StartRecord + $bulan_list->DisplayRecords - 1)
		$bulan_list->StopRecord = $bulan_list->StartRecord + $bulan_list->DisplayRecords - 1;
	else
		$bulan_list->StopRecord = $bulan_list->TotalRecords;
}
$bulan_list->RecordCount = $bulan_list->StartRecord - 1;
if ($bulan_list->Recordset && !$bulan_list->Recordset->EOF) {
	$bulan_list->Recordset->moveFirst();
	$selectLimit = $bulan_list->UseSelectLimit;
	if (!$selectLimit && $bulan_list->StartRecord > 1)
		$bulan_list->Recordset->move($bulan_list->StartRecord - 1);
} elseif (!$bulan->AllowAddDeleteRow && $bulan_list->StopRecord == 0) {
	$bulan_list->StopRecord = $bulan->GridAddRowCount;
}

// Initialize aggregate
$bulan->RowType = ROWTYPE_AGGREGATEINIT;
$bulan->resetAttributes();
$bulan_list->renderRow();
while ($bulan_list->RecordCount < $bulan_list->StopRecord) {
	$bulan_list->RecordCount++;
	if ($bulan_list->RecordCount >= $bulan_list->StartRecord) {
		$bulan_list->RowCount++;

		// Set up key count
		$bulan_list->KeyCount = $bulan_list->RowIndex;

		// Init row class and style
		$bulan->resetAttributes();
		$bulan->CssClass = "";
		if ($bulan_list->isGridAdd()) {
		} else {
			$bulan_list->loadRowValues($bulan_list->Recordset); // Load row values
		}
		$bulan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$bulan->RowAttrs->merge(["data-rowindex" => $bulan_list->RowCount, "id" => "r" . $bulan_list->RowCount . "_bulan", "data-rowtype" => $bulan->RowType]);

		// Render row
		$bulan_list->renderRow();

		// Render list options
		$bulan_list->renderListOptions();
?>
	<tr <?php echo $bulan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bulan_list->ListOptions->render("body", "left", $bulan_list->RowCount);
?>
	<?php if ($bulan_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $bulan_list->id->cellAttributes() ?>>
<span id="el<?php echo $bulan_list->RowCount ?>_bulan_id">
<span<?php echo $bulan_list->id->viewAttributes() ?>><?php echo $bulan_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bulan_list->nourut->Visible) { // nourut ?>
		<td data-name="nourut" <?php echo $bulan_list->nourut->cellAttributes() ?>>
<span id="el<?php echo $bulan_list->RowCount ?>_bulan_nourut">
<span<?php echo $bulan_list->nourut->viewAttributes() ?>><?php echo $bulan_list->nourut->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bulan_list->bulan->Visible) { // bulan ?>
		<td data-name="bulan" <?php echo $bulan_list->bulan->cellAttributes() ?>>
<span id="el<?php echo $bulan_list->RowCount ?>_bulan_bulan">
<span<?php echo $bulan_list->bulan->viewAttributes() ?>><?php echo $bulan_list->bulan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bulan_list->ListOptions->render("body", "right", $bulan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$bulan_list->isGridAdd())
		$bulan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$bulan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($bulan_list->Recordset)
	$bulan_list->Recordset->Close();
?>
<?php if (!$bulan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$bulan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bulan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bulan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($bulan_list->TotalRecords == 0 && !$bulan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $bulan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$bulan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bulan_list->isExport()) { ?>
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
$bulan_list->terminate();
?>