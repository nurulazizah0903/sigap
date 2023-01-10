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
$tpendidikan_list = new tpendidikan_list();

// Run the page
$tpendidikan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tpendidikan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tpendidikan_list->isExport()) { ?>
<script>
var ftpendidikanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftpendidikanlist = currentForm = new ew.Form("ftpendidikanlist", "list");
	ftpendidikanlist.formKeyCountName = '<?php echo $tpendidikan_list->FormKeyCountName ?>';
	loadjs.done("ftpendidikanlist");
});
var ftpendidikanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftpendidikanlistsrch = currentSearchForm = new ew.Form("ftpendidikanlistsrch");

	// Dynamic selection lists
	// Filters

	ftpendidikanlistsrch.filterList = <?php echo $tpendidikan_list->getFilterList() ?>;
	loadjs.done("ftpendidikanlistsrch");
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
<?php if (!$tpendidikan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tpendidikan_list->TotalRecords > 0 && $tpendidikan_list->ExportOptions->visible()) { ?>
<?php $tpendidikan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tpendidikan_list->ImportOptions->visible()) { ?>
<?php $tpendidikan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tpendidikan_list->SearchOptions->visible()) { ?>
<?php $tpendidikan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tpendidikan_list->FilterOptions->visible()) { ?>
<?php $tpendidikan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tpendidikan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tpendidikan_list->isExport() && !$tpendidikan->CurrentAction) { ?>
<form name="ftpendidikanlistsrch" id="ftpendidikanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftpendidikanlistsrch-search-panel" class="<?php echo $tpendidikan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tpendidikan">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tpendidikan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tpendidikan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tpendidikan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tpendidikan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tpendidikan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tpendidikan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tpendidikan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tpendidikan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tpendidikan_list->showPageHeader(); ?>
<?php
$tpendidikan_list->showMessage();
?>
<?php if ($tpendidikan_list->TotalRecords > 0 || $tpendidikan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tpendidikan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tpendidikan">
<?php if (!$tpendidikan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tpendidikan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tpendidikan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tpendidikan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftpendidikanlist" id="ftpendidikanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tpendidikan">
<div id="gmp_tpendidikan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tpendidikan_list->TotalRecords > 0 || $tpendidikan_list->isGridEdit()) { ?>
<table id="tbl_tpendidikanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tpendidikan->RowType = ROWTYPE_HEADER;

// Render list options
$tpendidikan_list->renderListOptions();

// Render list options (header, left)
$tpendidikan_list->ListOptions->render("header", "left");
?>
<?php if ($tpendidikan_list->nourut->Visible) { // nourut ?>
	<?php if ($tpendidikan_list->SortUrl($tpendidikan_list->nourut) == "") { ?>
		<th data-name="nourut" class="<?php echo $tpendidikan_list->nourut->headerCellClass() ?>"><div id="elh_tpendidikan_nourut" class="tpendidikan_nourut"><div class="ew-table-header-caption"><?php echo $tpendidikan_list->nourut->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nourut" class="<?php echo $tpendidikan_list->nourut->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tpendidikan_list->SortUrl($tpendidikan_list->nourut) ?>', 1);"><div id="elh_tpendidikan_nourut" class="tpendidikan_nourut">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tpendidikan_list->nourut->caption() ?></span><span class="ew-table-header-sort"><?php if ($tpendidikan_list->nourut->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tpendidikan_list->nourut->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tpendidikan_list->name->Visible) { // name ?>
	<?php if ($tpendidikan_list->SortUrl($tpendidikan_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $tpendidikan_list->name->headerCellClass() ?>"><div id="elh_tpendidikan_name" class="tpendidikan_name"><div class="ew-table-header-caption"><?php echo $tpendidikan_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $tpendidikan_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tpendidikan_list->SortUrl($tpendidikan_list->name) ?>', 1);"><div id="elh_tpendidikan_name" class="tpendidikan_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tpendidikan_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tpendidikan_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tpendidikan_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tpendidikan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tpendidikan_list->ExportAll && $tpendidikan_list->isExport()) {
	$tpendidikan_list->StopRecord = $tpendidikan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tpendidikan_list->TotalRecords > $tpendidikan_list->StartRecord + $tpendidikan_list->DisplayRecords - 1)
		$tpendidikan_list->StopRecord = $tpendidikan_list->StartRecord + $tpendidikan_list->DisplayRecords - 1;
	else
		$tpendidikan_list->StopRecord = $tpendidikan_list->TotalRecords;
}
$tpendidikan_list->RecordCount = $tpendidikan_list->StartRecord - 1;
if ($tpendidikan_list->Recordset && !$tpendidikan_list->Recordset->EOF) {
	$tpendidikan_list->Recordset->moveFirst();
	$selectLimit = $tpendidikan_list->UseSelectLimit;
	if (!$selectLimit && $tpendidikan_list->StartRecord > 1)
		$tpendidikan_list->Recordset->move($tpendidikan_list->StartRecord - 1);
} elseif (!$tpendidikan->AllowAddDeleteRow && $tpendidikan_list->StopRecord == 0) {
	$tpendidikan_list->StopRecord = $tpendidikan->GridAddRowCount;
}

// Initialize aggregate
$tpendidikan->RowType = ROWTYPE_AGGREGATEINIT;
$tpendidikan->resetAttributes();
$tpendidikan_list->renderRow();
while ($tpendidikan_list->RecordCount < $tpendidikan_list->StopRecord) {
	$tpendidikan_list->RecordCount++;
	if ($tpendidikan_list->RecordCount >= $tpendidikan_list->StartRecord) {
		$tpendidikan_list->RowCount++;

		// Set up key count
		$tpendidikan_list->KeyCount = $tpendidikan_list->RowIndex;

		// Init row class and style
		$tpendidikan->resetAttributes();
		$tpendidikan->CssClass = "";
		if ($tpendidikan_list->isGridAdd()) {
		} else {
			$tpendidikan_list->loadRowValues($tpendidikan_list->Recordset); // Load row values
		}
		$tpendidikan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tpendidikan->RowAttrs->merge(["data-rowindex" => $tpendidikan_list->RowCount, "id" => "r" . $tpendidikan_list->RowCount . "_tpendidikan", "data-rowtype" => $tpendidikan->RowType]);

		// Render row
		$tpendidikan_list->renderRow();

		// Render list options
		$tpendidikan_list->renderListOptions();
?>
	<tr <?php echo $tpendidikan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tpendidikan_list->ListOptions->render("body", "left", $tpendidikan_list->RowCount);
?>
	<?php if ($tpendidikan_list->nourut->Visible) { // nourut ?>
		<td data-name="nourut" <?php echo $tpendidikan_list->nourut->cellAttributes() ?>>
<span id="el<?php echo $tpendidikan_list->RowCount ?>_tpendidikan_nourut">
<span<?php echo $tpendidikan_list->nourut->viewAttributes() ?>><?php echo $tpendidikan_list->nourut->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tpendidikan_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $tpendidikan_list->name->cellAttributes() ?>>
<span id="el<?php echo $tpendidikan_list->RowCount ?>_tpendidikan_name">
<span<?php echo $tpendidikan_list->name->viewAttributes() ?>><?php echo $tpendidikan_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tpendidikan_list->ListOptions->render("body", "right", $tpendidikan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tpendidikan_list->isGridAdd())
		$tpendidikan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tpendidikan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tpendidikan_list->Recordset)
	$tpendidikan_list->Recordset->Close();
?>
<?php if (!$tpendidikan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tpendidikan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tpendidikan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tpendidikan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tpendidikan_list->TotalRecords == 0 && !$tpendidikan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tpendidikan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tpendidikan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tpendidikan_list->isExport()) { ?>
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
$tpendidikan_list->terminate();
?>