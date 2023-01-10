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
$barang_list = new barang_list();

// Run the page
$barang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$barang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$barang_list->isExport()) { ?>
<script>
var fbaranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbaranglist = currentForm = new ew.Form("fbaranglist", "list");
	fbaranglist.formKeyCountName = '<?php echo $barang_list->FormKeyCountName ?>';
	loadjs.done("fbaranglist");
});
var fbaranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbaranglistsrch = currentSearchForm = new ew.Form("fbaranglistsrch");

	// Dynamic selection lists
	// Filters

	fbaranglistsrch.filterList = <?php echo $barang_list->getFilterList() ?>;
	loadjs.done("fbaranglistsrch");
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
<?php if (!$barang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($barang_list->TotalRecords > 0 && $barang_list->ExportOptions->visible()) { ?>
<?php $barang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($barang_list->ImportOptions->visible()) { ?>
<?php $barang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($barang_list->SearchOptions->visible()) { ?>
<?php $barang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($barang_list->FilterOptions->visible()) { ?>
<?php $barang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$barang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$barang_list->isExport() && !$barang->CurrentAction) { ?>
<form name="fbaranglistsrch" id="fbaranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbaranglistsrch-search-panel" class="<?php echo $barang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="barang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $barang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($barang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($barang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $barang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($barang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($barang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($barang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($barang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $barang_list->showPageHeader(); ?>
<?php
$barang_list->showMessage();
?>
<?php if ($barang_list->TotalRecords > 0 || $barang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($barang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> barang">
<?php if (!$barang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$barang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $barang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $barang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbaranglist" id="fbaranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="barang">
<div id="gmp_barang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($barang_list->TotalRecords > 0 || $barang_list->isGridEdit()) { ?>
<table id="tbl_baranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$barang->RowType = ROWTYPE_HEADER;

// Render list options
$barang_list->renderListOptions();

// Render list options (header, left)
$barang_list->ListOptions->render("header", "left");
?>
<?php if ($barang_list->Kode_Barang->Visible) { // Kode_Barang ?>
	<?php if ($barang_list->SortUrl($barang_list->Kode_Barang) == "") { ?>
		<th data-name="Kode_Barang" class="<?php echo $barang_list->Kode_Barang->headerCellClass() ?>"><div id="elh_barang_Kode_Barang" class="barang_Kode_Barang"><div class="ew-table-header-caption"><?php echo $barang_list->Kode_Barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Kode_Barang" class="<?php echo $barang_list->Kode_Barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $barang_list->SortUrl($barang_list->Kode_Barang) ?>', 1);"><div id="elh_barang_Kode_Barang" class="barang_Kode_Barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $barang_list->Kode_Barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($barang_list->Kode_Barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($barang_list->Kode_Barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($barang_list->Nama_Barang->Visible) { // Nama_Barang ?>
	<?php if ($barang_list->SortUrl($barang_list->Nama_Barang) == "") { ?>
		<th data-name="Nama_Barang" class="<?php echo $barang_list->Nama_Barang->headerCellClass() ?>"><div id="elh_barang_Nama_Barang" class="barang_Nama_Barang"><div class="ew-table-header-caption"><?php echo $barang_list->Nama_Barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nama_Barang" class="<?php echo $barang_list->Nama_Barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $barang_list->SortUrl($barang_list->Nama_Barang) ?>', 1);"><div id="elh_barang_Nama_Barang" class="barang_Nama_Barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $barang_list->Nama_Barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($barang_list->Nama_Barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($barang_list->Nama_Barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$barang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($barang_list->ExportAll && $barang_list->isExport()) {
	$barang_list->StopRecord = $barang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($barang_list->TotalRecords > $barang_list->StartRecord + $barang_list->DisplayRecords - 1)
		$barang_list->StopRecord = $barang_list->StartRecord + $barang_list->DisplayRecords - 1;
	else
		$barang_list->StopRecord = $barang_list->TotalRecords;
}
$barang_list->RecordCount = $barang_list->StartRecord - 1;
if ($barang_list->Recordset && !$barang_list->Recordset->EOF) {
	$barang_list->Recordset->moveFirst();
	$selectLimit = $barang_list->UseSelectLimit;
	if (!$selectLimit && $barang_list->StartRecord > 1)
		$barang_list->Recordset->move($barang_list->StartRecord - 1);
} elseif (!$barang->AllowAddDeleteRow && $barang_list->StopRecord == 0) {
	$barang_list->StopRecord = $barang->GridAddRowCount;
}

// Initialize aggregate
$barang->RowType = ROWTYPE_AGGREGATEINIT;
$barang->resetAttributes();
$barang_list->renderRow();
while ($barang_list->RecordCount < $barang_list->StopRecord) {
	$barang_list->RecordCount++;
	if ($barang_list->RecordCount >= $barang_list->StartRecord) {
		$barang_list->RowCount++;

		// Set up key count
		$barang_list->KeyCount = $barang_list->RowIndex;

		// Init row class and style
		$barang->resetAttributes();
		$barang->CssClass = "";
		if ($barang_list->isGridAdd()) {
		} else {
			$barang_list->loadRowValues($barang_list->Recordset); // Load row values
		}
		$barang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$barang->RowAttrs->merge(["data-rowindex" => $barang_list->RowCount, "id" => "r" . $barang_list->RowCount . "_barang", "data-rowtype" => $barang->RowType]);

		// Render row
		$barang_list->renderRow();

		// Render list options
		$barang_list->renderListOptions();
?>
	<tr <?php echo $barang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$barang_list->ListOptions->render("body", "left", $barang_list->RowCount);
?>
	<?php if ($barang_list->Kode_Barang->Visible) { // Kode_Barang ?>
		<td data-name="Kode_Barang" <?php echo $barang_list->Kode_Barang->cellAttributes() ?>>
<span id="el<?php echo $barang_list->RowCount ?>_barang_Kode_Barang">
<span<?php echo $barang_list->Kode_Barang->viewAttributes() ?>><?php echo $barang_list->Kode_Barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($barang_list->Nama_Barang->Visible) { // Nama_Barang ?>
		<td data-name="Nama_Barang" <?php echo $barang_list->Nama_Barang->cellAttributes() ?>>
<span id="el<?php echo $barang_list->RowCount ?>_barang_Nama_Barang">
<span<?php echo $barang_list->Nama_Barang->viewAttributes() ?>><?php echo $barang_list->Nama_Barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$barang_list->ListOptions->render("body", "right", $barang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$barang_list->isGridAdd())
		$barang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$barang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($barang_list->Recordset)
	$barang_list->Recordset->Close();
?>
<?php if (!$barang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$barang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $barang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $barang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($barang_list->TotalRecords == 0 && !$barang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $barang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$barang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$barang_list->isExport()) { ?>
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
$barang_list->terminate();
?>