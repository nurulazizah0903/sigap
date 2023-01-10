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
$jenis_guru_list = new jenis_guru_list();

// Run the page
$jenis_guru_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_guru_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jenis_guru_list->isExport()) { ?>
<script>
var fjenis_gurulist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fjenis_gurulist = currentForm = new ew.Form("fjenis_gurulist", "list");
	fjenis_gurulist.formKeyCountName = '<?php echo $jenis_guru_list->FormKeyCountName ?>';
	loadjs.done("fjenis_gurulist");
});
var fjenis_gurulistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fjenis_gurulistsrch = currentSearchForm = new ew.Form("fjenis_gurulistsrch");

	// Dynamic selection lists
	// Filters

	fjenis_gurulistsrch.filterList = <?php echo $jenis_guru_list->getFilterList() ?>;
	loadjs.done("fjenis_gurulistsrch");
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
<?php if (!$jenis_guru_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($jenis_guru_list->TotalRecords > 0 && $jenis_guru_list->ExportOptions->visible()) { ?>
<?php $jenis_guru_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($jenis_guru_list->ImportOptions->visible()) { ?>
<?php $jenis_guru_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($jenis_guru_list->SearchOptions->visible()) { ?>
<?php $jenis_guru_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($jenis_guru_list->FilterOptions->visible()) { ?>
<?php $jenis_guru_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$jenis_guru_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$jenis_guru_list->isExport() && !$jenis_guru->CurrentAction) { ?>
<form name="fjenis_gurulistsrch" id="fjenis_gurulistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fjenis_gurulistsrch-search-panel" class="<?php echo $jenis_guru_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="jenis_guru">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $jenis_guru_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($jenis_guru_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($jenis_guru_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $jenis_guru_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($jenis_guru_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($jenis_guru_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($jenis_guru_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($jenis_guru_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $jenis_guru_list->showPageHeader(); ?>
<?php
$jenis_guru_list->showMessage();
?>
<?php if ($jenis_guru_list->TotalRecords > 0 || $jenis_guru->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($jenis_guru_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> jenis_guru">
<?php if (!$jenis_guru_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$jenis_guru_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jenis_guru_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jenis_guru_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fjenis_gurulist" id="fjenis_gurulist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_guru">
<div id="gmp_jenis_guru" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($jenis_guru_list->TotalRecords > 0 || $jenis_guru_list->isGridEdit()) { ?>
<table id="tbl_jenis_gurulist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$jenis_guru->RowType = ROWTYPE_HEADER;

// Render list options
$jenis_guru_list->renderListOptions();

// Render list options (header, left)
$jenis_guru_list->ListOptions->render("header", "left");
?>
<?php if ($jenis_guru_list->name->Visible) { // name ?>
	<?php if ($jenis_guru_list->SortUrl($jenis_guru_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $jenis_guru_list->name->headerCellClass() ?>"><div id="elh_jenis_guru_name" class="jenis_guru_name"><div class="ew-table-header-caption"><?php echo $jenis_guru_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $jenis_guru_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jenis_guru_list->SortUrl($jenis_guru_list->name) ?>', 1);"><div id="elh_jenis_guru_name" class="jenis_guru_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jenis_guru_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jenis_guru_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jenis_guru_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$jenis_guru_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($jenis_guru_list->ExportAll && $jenis_guru_list->isExport()) {
	$jenis_guru_list->StopRecord = $jenis_guru_list->TotalRecords;
} else {

	// Set the last record to display
	if ($jenis_guru_list->TotalRecords > $jenis_guru_list->StartRecord + $jenis_guru_list->DisplayRecords - 1)
		$jenis_guru_list->StopRecord = $jenis_guru_list->StartRecord + $jenis_guru_list->DisplayRecords - 1;
	else
		$jenis_guru_list->StopRecord = $jenis_guru_list->TotalRecords;
}
$jenis_guru_list->RecordCount = $jenis_guru_list->StartRecord - 1;
if ($jenis_guru_list->Recordset && !$jenis_guru_list->Recordset->EOF) {
	$jenis_guru_list->Recordset->moveFirst();
	$selectLimit = $jenis_guru_list->UseSelectLimit;
	if (!$selectLimit && $jenis_guru_list->StartRecord > 1)
		$jenis_guru_list->Recordset->move($jenis_guru_list->StartRecord - 1);
} elseif (!$jenis_guru->AllowAddDeleteRow && $jenis_guru_list->StopRecord == 0) {
	$jenis_guru_list->StopRecord = $jenis_guru->GridAddRowCount;
}

// Initialize aggregate
$jenis_guru->RowType = ROWTYPE_AGGREGATEINIT;
$jenis_guru->resetAttributes();
$jenis_guru_list->renderRow();
while ($jenis_guru_list->RecordCount < $jenis_guru_list->StopRecord) {
	$jenis_guru_list->RecordCount++;
	if ($jenis_guru_list->RecordCount >= $jenis_guru_list->StartRecord) {
		$jenis_guru_list->RowCount++;

		// Set up key count
		$jenis_guru_list->KeyCount = $jenis_guru_list->RowIndex;

		// Init row class and style
		$jenis_guru->resetAttributes();
		$jenis_guru->CssClass = "";
		if ($jenis_guru_list->isGridAdd()) {
		} else {
			$jenis_guru_list->loadRowValues($jenis_guru_list->Recordset); // Load row values
		}
		$jenis_guru->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$jenis_guru->RowAttrs->merge(["data-rowindex" => $jenis_guru_list->RowCount, "id" => "r" . $jenis_guru_list->RowCount . "_jenis_guru", "data-rowtype" => $jenis_guru->RowType]);

		// Render row
		$jenis_guru_list->renderRow();

		// Render list options
		$jenis_guru_list->renderListOptions();
?>
	<tr <?php echo $jenis_guru->rowAttributes() ?>>
<?php

// Render list options (body, left)
$jenis_guru_list->ListOptions->render("body", "left", $jenis_guru_list->RowCount);
?>
	<?php if ($jenis_guru_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $jenis_guru_list->name->cellAttributes() ?>>
<span id="el<?php echo $jenis_guru_list->RowCount ?>_jenis_guru_name">
<span<?php echo $jenis_guru_list->name->viewAttributes() ?>><?php echo $jenis_guru_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$jenis_guru_list->ListOptions->render("body", "right", $jenis_guru_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$jenis_guru_list->isGridAdd())
		$jenis_guru_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$jenis_guru->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($jenis_guru_list->Recordset)
	$jenis_guru_list->Recordset->Close();
?>
<?php if (!$jenis_guru_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$jenis_guru_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jenis_guru_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jenis_guru_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($jenis_guru_list->TotalRecords == 0 && !$jenis_guru->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $jenis_guru_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$jenis_guru_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jenis_guru_list->isExport()) { ?>
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
$jenis_guru_list->terminate();
?>