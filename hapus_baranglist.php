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
$hapus_barang_list = new hapus_barang_list();

// Run the page
$hapus_barang_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$hapus_barang_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$hapus_barang_list->isExport()) { ?>
<script>
var fhapus_baranglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fhapus_baranglist = currentForm = new ew.Form("fhapus_baranglist", "list");
	fhapus_baranglist.formKeyCountName = '<?php echo $hapus_barang_list->FormKeyCountName ?>';
	loadjs.done("fhapus_baranglist");
});
var fhapus_baranglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fhapus_baranglistsrch = currentSearchForm = new ew.Form("fhapus_baranglistsrch");

	// Dynamic selection lists
	// Filters

	fhapus_baranglistsrch.filterList = <?php echo $hapus_barang_list->getFilterList() ?>;
	loadjs.done("fhapus_baranglistsrch");
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
<?php if (!$hapus_barang_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($hapus_barang_list->TotalRecords > 0 && $hapus_barang_list->ExportOptions->visible()) { ?>
<?php $hapus_barang_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($hapus_barang_list->ImportOptions->visible()) { ?>
<?php $hapus_barang_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($hapus_barang_list->SearchOptions->visible()) { ?>
<?php $hapus_barang_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($hapus_barang_list->FilterOptions->visible()) { ?>
<?php $hapus_barang_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$hapus_barang_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$hapus_barang_list->isExport() && !$hapus_barang->CurrentAction) { ?>
<form name="fhapus_baranglistsrch" id="fhapus_baranglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fhapus_baranglistsrch-search-panel" class="<?php echo $hapus_barang_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="hapus_barang">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $hapus_barang_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($hapus_barang_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($hapus_barang_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $hapus_barang_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($hapus_barang_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($hapus_barang_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($hapus_barang_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($hapus_barang_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $hapus_barang_list->showPageHeader(); ?>
<?php
$hapus_barang_list->showMessage();
?>
<?php if ($hapus_barang_list->TotalRecords > 0 || $hapus_barang->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($hapus_barang_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> hapus_barang">
<?php if (!$hapus_barang_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$hapus_barang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $hapus_barang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $hapus_barang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fhapus_baranglist" id="fhapus_baranglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="hapus_barang">
<div id="gmp_hapus_barang" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($hapus_barang_list->TotalRecords > 0 || $hapus_barang_list->isGridEdit()) { ?>
<table id="tbl_hapus_baranglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$hapus_barang->RowType = ROWTYPE_HEADER;

// Render list options
$hapus_barang_list->renderListOptions();

// Render list options (header, left)
$hapus_barang_list->ListOptions->render("header", "left");
?>
<?php if ($hapus_barang_list->ID_Hapus->Visible) { // ID_Hapus ?>
	<?php if ($hapus_barang_list->SortUrl($hapus_barang_list->ID_Hapus) == "") { ?>
		<th data-name="ID_Hapus" class="<?php echo $hapus_barang_list->ID_Hapus->headerCellClass() ?>"><div id="elh_hapus_barang_ID_Hapus" class="hapus_barang_ID_Hapus"><div class="ew-table-header-caption"><?php echo $hapus_barang_list->ID_Hapus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID_Hapus" class="<?php echo $hapus_barang_list->ID_Hapus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $hapus_barang_list->SortUrl($hapus_barang_list->ID_Hapus) ?>', 1);"><div id="elh_hapus_barang_ID_Hapus" class="hapus_barang_ID_Hapus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $hapus_barang_list->ID_Hapus->caption() ?></span><span class="ew-table-header-sort"><?php if ($hapus_barang_list->ID_Hapus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($hapus_barang_list->ID_Hapus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($hapus_barang_list->Kode_Barang->Visible) { // Kode_Barang ?>
	<?php if ($hapus_barang_list->SortUrl($hapus_barang_list->Kode_Barang) == "") { ?>
		<th data-name="Kode_Barang" class="<?php echo $hapus_barang_list->Kode_Barang->headerCellClass() ?>"><div id="elh_hapus_barang_Kode_Barang" class="hapus_barang_Kode_Barang"><div class="ew-table-header-caption"><?php echo $hapus_barang_list->Kode_Barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Kode_Barang" class="<?php echo $hapus_barang_list->Kode_Barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $hapus_barang_list->SortUrl($hapus_barang_list->Kode_Barang) ?>', 1);"><div id="elh_hapus_barang_Kode_Barang" class="hapus_barang_Kode_Barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $hapus_barang_list->Kode_Barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($hapus_barang_list->Kode_Barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($hapus_barang_list->Kode_Barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($hapus_barang_list->Nama_Barang->Visible) { // Nama_Barang ?>
	<?php if ($hapus_barang_list->SortUrl($hapus_barang_list->Nama_Barang) == "") { ?>
		<th data-name="Nama_Barang" class="<?php echo $hapus_barang_list->Nama_Barang->headerCellClass() ?>"><div id="elh_hapus_barang_Nama_Barang" class="hapus_barang_Nama_Barang"><div class="ew-table-header-caption"><?php echo $hapus_barang_list->Nama_Barang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nama_Barang" class="<?php echo $hapus_barang_list->Nama_Barang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $hapus_barang_list->SortUrl($hapus_barang_list->Nama_Barang) ?>', 1);"><div id="elh_hapus_barang_Nama_Barang" class="hapus_barang_Nama_Barang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $hapus_barang_list->Nama_Barang->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($hapus_barang_list->Nama_Barang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($hapus_barang_list->Nama_Barang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$hapus_barang_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($hapus_barang_list->ExportAll && $hapus_barang_list->isExport()) {
	$hapus_barang_list->StopRecord = $hapus_barang_list->TotalRecords;
} else {

	// Set the last record to display
	if ($hapus_barang_list->TotalRecords > $hapus_barang_list->StartRecord + $hapus_barang_list->DisplayRecords - 1)
		$hapus_barang_list->StopRecord = $hapus_barang_list->StartRecord + $hapus_barang_list->DisplayRecords - 1;
	else
		$hapus_barang_list->StopRecord = $hapus_barang_list->TotalRecords;
}
$hapus_barang_list->RecordCount = $hapus_barang_list->StartRecord - 1;
if ($hapus_barang_list->Recordset && !$hapus_barang_list->Recordset->EOF) {
	$hapus_barang_list->Recordset->moveFirst();
	$selectLimit = $hapus_barang_list->UseSelectLimit;
	if (!$selectLimit && $hapus_barang_list->StartRecord > 1)
		$hapus_barang_list->Recordset->move($hapus_barang_list->StartRecord - 1);
} elseif (!$hapus_barang->AllowAddDeleteRow && $hapus_barang_list->StopRecord == 0) {
	$hapus_barang_list->StopRecord = $hapus_barang->GridAddRowCount;
}

// Initialize aggregate
$hapus_barang->RowType = ROWTYPE_AGGREGATEINIT;
$hapus_barang->resetAttributes();
$hapus_barang_list->renderRow();
while ($hapus_barang_list->RecordCount < $hapus_barang_list->StopRecord) {
	$hapus_barang_list->RecordCount++;
	if ($hapus_barang_list->RecordCount >= $hapus_barang_list->StartRecord) {
		$hapus_barang_list->RowCount++;

		// Set up key count
		$hapus_barang_list->KeyCount = $hapus_barang_list->RowIndex;

		// Init row class and style
		$hapus_barang->resetAttributes();
		$hapus_barang->CssClass = "";
		if ($hapus_barang_list->isGridAdd()) {
		} else {
			$hapus_barang_list->loadRowValues($hapus_barang_list->Recordset); // Load row values
		}
		$hapus_barang->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$hapus_barang->RowAttrs->merge(["data-rowindex" => $hapus_barang_list->RowCount, "id" => "r" . $hapus_barang_list->RowCount . "_hapus_barang", "data-rowtype" => $hapus_barang->RowType]);

		// Render row
		$hapus_barang_list->renderRow();

		// Render list options
		$hapus_barang_list->renderListOptions();
?>
	<tr <?php echo $hapus_barang->rowAttributes() ?>>
<?php

// Render list options (body, left)
$hapus_barang_list->ListOptions->render("body", "left", $hapus_barang_list->RowCount);
?>
	<?php if ($hapus_barang_list->ID_Hapus->Visible) { // ID_Hapus ?>
		<td data-name="ID_Hapus" <?php echo $hapus_barang_list->ID_Hapus->cellAttributes() ?>>
<span id="el<?php echo $hapus_barang_list->RowCount ?>_hapus_barang_ID_Hapus">
<span<?php echo $hapus_barang_list->ID_Hapus->viewAttributes() ?>><?php echo $hapus_barang_list->ID_Hapus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($hapus_barang_list->Kode_Barang->Visible) { // Kode_Barang ?>
		<td data-name="Kode_Barang" <?php echo $hapus_barang_list->Kode_Barang->cellAttributes() ?>>
<span id="el<?php echo $hapus_barang_list->RowCount ?>_hapus_barang_Kode_Barang">
<span<?php echo $hapus_barang_list->Kode_Barang->viewAttributes() ?>><?php echo $hapus_barang_list->Kode_Barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($hapus_barang_list->Nama_Barang->Visible) { // Nama_Barang ?>
		<td data-name="Nama_Barang" <?php echo $hapus_barang_list->Nama_Barang->cellAttributes() ?>>
<span id="el<?php echo $hapus_barang_list->RowCount ?>_hapus_barang_Nama_Barang">
<span<?php echo $hapus_barang_list->Nama_Barang->viewAttributes() ?>><?php echo $hapus_barang_list->Nama_Barang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$hapus_barang_list->ListOptions->render("body", "right", $hapus_barang_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$hapus_barang_list->isGridAdd())
		$hapus_barang_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$hapus_barang->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($hapus_barang_list->Recordset)
	$hapus_barang_list->Recordset->Close();
?>
<?php if (!$hapus_barang_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$hapus_barang_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $hapus_barang_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $hapus_barang_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($hapus_barang_list->TotalRecords == 0 && !$hapus_barang->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $hapus_barang_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$hapus_barang_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$hapus_barang_list->isExport()) { ?>
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
$hapus_barang_list->terminate();
?>