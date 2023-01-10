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
$tambahan_tugas_list = new tambahan_tugas_list();

// Run the page
$tambahan_tugas_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tambahan_tugas_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tambahan_tugas_list->isExport()) { ?>
<script>
var ftambahan_tugaslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftambahan_tugaslist = currentForm = new ew.Form("ftambahan_tugaslist", "list");
	ftambahan_tugaslist.formKeyCountName = '<?php echo $tambahan_tugas_list->FormKeyCountName ?>';
	loadjs.done("ftambahan_tugaslist");
});
var ftambahan_tugaslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftambahan_tugaslistsrch = currentSearchForm = new ew.Form("ftambahan_tugaslistsrch");

	// Dynamic selection lists
	// Filters

	ftambahan_tugaslistsrch.filterList = <?php echo $tambahan_tugas_list->getFilterList() ?>;
	loadjs.done("ftambahan_tugaslistsrch");
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
<?php if (!$tambahan_tugas_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tambahan_tugas_list->TotalRecords > 0 && $tambahan_tugas_list->ExportOptions->visible()) { ?>
<?php $tambahan_tugas_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tambahan_tugas_list->ImportOptions->visible()) { ?>
<?php $tambahan_tugas_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tambahan_tugas_list->SearchOptions->visible()) { ?>
<?php $tambahan_tugas_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tambahan_tugas_list->FilterOptions->visible()) { ?>
<?php $tambahan_tugas_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tambahan_tugas_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tambahan_tugas_list->isExport() && !$tambahan_tugas->CurrentAction) { ?>
<form name="ftambahan_tugaslistsrch" id="ftambahan_tugaslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftambahan_tugaslistsrch-search-panel" class="<?php echo $tambahan_tugas_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tambahan_tugas">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tambahan_tugas_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tambahan_tugas_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tambahan_tugas_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tambahan_tugas_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tambahan_tugas_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tambahan_tugas_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tambahan_tugas_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tambahan_tugas_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tambahan_tugas_list->showPageHeader(); ?>
<?php
$tambahan_tugas_list->showMessage();
?>
<?php if ($tambahan_tugas_list->TotalRecords > 0 || $tambahan_tugas->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tambahan_tugas_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tambahan_tugas">
<?php if (!$tambahan_tugas_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tambahan_tugas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tambahan_tugas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tambahan_tugas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftambahan_tugaslist" id="ftambahan_tugaslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tambahan_tugas">
<div id="gmp_tambahan_tugas" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tambahan_tugas_list->TotalRecords > 0 || $tambahan_tugas_list->isGridEdit()) { ?>
<table id="tbl_tambahan_tugaslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tambahan_tugas->RowType = ROWTYPE_HEADER;

// Render list options
$tambahan_tugas_list->renderListOptions();

// Render list options (header, left)
$tambahan_tugas_list->ListOptions->render("header", "left");
?>
<?php if ($tambahan_tugas_list->name->Visible) { // name ?>
	<?php if ($tambahan_tugas_list->SortUrl($tambahan_tugas_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $tambahan_tugas_list->name->headerCellClass() ?>"><div id="elh_tambahan_tugas_name" class="tambahan_tugas_name"><div class="ew-table-header-caption"><?php echo $tambahan_tugas_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $tambahan_tugas_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tambahan_tugas_list->SortUrl($tambahan_tugas_list->name) ?>', 1);"><div id="elh_tambahan_tugas_name" class="tambahan_tugas_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tambahan_tugas_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tambahan_tugas_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tambahan_tugas_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tambahan_tugas_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tambahan_tugas_list->ExportAll && $tambahan_tugas_list->isExport()) {
	$tambahan_tugas_list->StopRecord = $tambahan_tugas_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tambahan_tugas_list->TotalRecords > $tambahan_tugas_list->StartRecord + $tambahan_tugas_list->DisplayRecords - 1)
		$tambahan_tugas_list->StopRecord = $tambahan_tugas_list->StartRecord + $tambahan_tugas_list->DisplayRecords - 1;
	else
		$tambahan_tugas_list->StopRecord = $tambahan_tugas_list->TotalRecords;
}
$tambahan_tugas_list->RecordCount = $tambahan_tugas_list->StartRecord - 1;
if ($tambahan_tugas_list->Recordset && !$tambahan_tugas_list->Recordset->EOF) {
	$tambahan_tugas_list->Recordset->moveFirst();
	$selectLimit = $tambahan_tugas_list->UseSelectLimit;
	if (!$selectLimit && $tambahan_tugas_list->StartRecord > 1)
		$tambahan_tugas_list->Recordset->move($tambahan_tugas_list->StartRecord - 1);
} elseif (!$tambahan_tugas->AllowAddDeleteRow && $tambahan_tugas_list->StopRecord == 0) {
	$tambahan_tugas_list->StopRecord = $tambahan_tugas->GridAddRowCount;
}

// Initialize aggregate
$tambahan_tugas->RowType = ROWTYPE_AGGREGATEINIT;
$tambahan_tugas->resetAttributes();
$tambahan_tugas_list->renderRow();
while ($tambahan_tugas_list->RecordCount < $tambahan_tugas_list->StopRecord) {
	$tambahan_tugas_list->RecordCount++;
	if ($tambahan_tugas_list->RecordCount >= $tambahan_tugas_list->StartRecord) {
		$tambahan_tugas_list->RowCount++;

		// Set up key count
		$tambahan_tugas_list->KeyCount = $tambahan_tugas_list->RowIndex;

		// Init row class and style
		$tambahan_tugas->resetAttributes();
		$tambahan_tugas->CssClass = "";
		if ($tambahan_tugas_list->isGridAdd()) {
		} else {
			$tambahan_tugas_list->loadRowValues($tambahan_tugas_list->Recordset); // Load row values
		}
		$tambahan_tugas->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tambahan_tugas->RowAttrs->merge(["data-rowindex" => $tambahan_tugas_list->RowCount, "id" => "r" . $tambahan_tugas_list->RowCount . "_tambahan_tugas", "data-rowtype" => $tambahan_tugas->RowType]);

		// Render row
		$tambahan_tugas_list->renderRow();

		// Render list options
		$tambahan_tugas_list->renderListOptions();
?>
	<tr <?php echo $tambahan_tugas->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tambahan_tugas_list->ListOptions->render("body", "left", $tambahan_tugas_list->RowCount);
?>
	<?php if ($tambahan_tugas_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $tambahan_tugas_list->name->cellAttributes() ?>>
<span id="el<?php echo $tambahan_tugas_list->RowCount ?>_tambahan_tugas_name">
<span<?php echo $tambahan_tugas_list->name->viewAttributes() ?>><?php echo $tambahan_tugas_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tambahan_tugas_list->ListOptions->render("body", "right", $tambahan_tugas_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tambahan_tugas_list->isGridAdd())
		$tambahan_tugas_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tambahan_tugas->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tambahan_tugas_list->Recordset)
	$tambahan_tugas_list->Recordset->Close();
?>
<?php if (!$tambahan_tugas_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tambahan_tugas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tambahan_tugas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tambahan_tugas_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tambahan_tugas_list->TotalRecords == 0 && !$tambahan_tugas->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tambahan_tugas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tambahan_tugas_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tambahan_tugas_list->isExport()) { ?>
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
$tambahan_tugas_list->terminate();
?>