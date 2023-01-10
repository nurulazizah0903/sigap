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
$absen_list = new absen_list();

// Run the page
$absen_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$absen_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$absen_list->isExport()) { ?>
<script>
var fabsenlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fabsenlist = currentForm = new ew.Form("fabsenlist", "list");
	fabsenlist.formKeyCountName = '<?php echo $absen_list->FormKeyCountName ?>';
	loadjs.done("fabsenlist");
});
var fabsenlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fabsenlistsrch = currentSearchForm = new ew.Form("fabsenlistsrch");

	// Dynamic selection lists
	// Filters

	fabsenlistsrch.filterList = <?php echo $absen_list->getFilterList() ?>;
	loadjs.done("fabsenlistsrch");
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
<?php if (!$absen_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($absen_list->TotalRecords > 0 && $absen_list->ExportOptions->visible()) { ?>
<?php $absen_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($absen_list->ImportOptions->visible()) { ?>
<?php $absen_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($absen_list->SearchOptions->visible()) { ?>
<?php $absen_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($absen_list->FilterOptions->visible()) { ?>
<?php $absen_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$absen_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$absen_list->isExport() && !$absen->CurrentAction) { ?>
<form name="fabsenlistsrch" id="fabsenlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fabsenlistsrch-search-panel" class="<?php echo $absen_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="absen">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $absen_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($absen_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($absen_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $absen_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($absen_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($absen_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($absen_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($absen_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $absen_list->showPageHeader(); ?>
<?php
$absen_list->showMessage();
?>
<?php if ($absen_list->TotalRecords > 0 || $absen->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($absen_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> absen">
<?php if (!$absen_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$absen_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $absen_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $absen_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fabsenlist" id="fabsenlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="absen">
<div id="gmp_absen" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($absen_list->TotalRecords > 0 || $absen_list->isGridEdit()) { ?>
<table id="tbl_absenlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$absen->RowType = ROWTYPE_HEADER;

// Render list options
$absen_list->renderListOptions();

// Render list options (header, left)
$absen_list->ListOptions->render("header", "left");
?>
<?php if ($absen_list->tahun->Visible) { // tahun ?>
	<?php if ($absen_list->SortUrl($absen_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $absen_list->tahun->headerCellClass() ?>"><div id="elh_absen_tahun" class="absen_tahun"><div class="ew-table-header-caption"><?php echo $absen_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $absen_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $absen_list->SortUrl($absen_list->tahun) ?>', 1);"><div id="elh_absen_tahun" class="absen_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $absen_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($absen_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($absen_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($absen_list->bulan->Visible) { // bulan ?>
	<?php if ($absen_list->SortUrl($absen_list->bulan) == "") { ?>
		<th data-name="bulan" class="<?php echo $absen_list->bulan->headerCellClass() ?>"><div id="elh_absen_bulan" class="absen_bulan"><div class="ew-table-header-caption"><?php echo $absen_list->bulan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bulan" class="<?php echo $absen_list->bulan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $absen_list->SortUrl($absen_list->bulan) ?>', 1);"><div id="elh_absen_bulan" class="absen_bulan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $absen_list->bulan->caption() ?></span><span class="ew-table-header-sort"><?php if ($absen_list->bulan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($absen_list->bulan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($absen_list->jumlah_hari_kerja->Visible) { // jumlah_hari_kerja ?>
	<?php if ($absen_list->SortUrl($absen_list->jumlah_hari_kerja) == "") { ?>
		<th data-name="jumlah_hari_kerja" class="<?php echo $absen_list->jumlah_hari_kerja->headerCellClass() ?>"><div id="elh_absen_jumlah_hari_kerja" class="absen_jumlah_hari_kerja"><div class="ew-table-header-caption"><?php echo $absen_list->jumlah_hari_kerja->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlah_hari_kerja" class="<?php echo $absen_list->jumlah_hari_kerja->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $absen_list->SortUrl($absen_list->jumlah_hari_kerja) ?>', 1);"><div id="elh_absen_jumlah_hari_kerja" class="absen_jumlah_hari_kerja">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $absen_list->jumlah_hari_kerja->caption() ?></span><span class="ew-table-header-sort"><?php if ($absen_list->jumlah_hari_kerja->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($absen_list->jumlah_hari_kerja->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($absen_list->datetime->Visible) { // datetime ?>
	<?php if ($absen_list->SortUrl($absen_list->datetime) == "") { ?>
		<th data-name="datetime" class="<?php echo $absen_list->datetime->headerCellClass() ?>"><div id="elh_absen_datetime" class="absen_datetime"><div class="ew-table-header-caption"><?php echo $absen_list->datetime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="datetime" class="<?php echo $absen_list->datetime->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $absen_list->SortUrl($absen_list->datetime) ?>', 1);"><div id="elh_absen_datetime" class="absen_datetime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $absen_list->datetime->caption() ?></span><span class="ew-table-header-sort"><?php if ($absen_list->datetime->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($absen_list->datetime->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($absen_list->createuser->Visible) { // createuser ?>
	<?php if ($absen_list->SortUrl($absen_list->createuser) == "") { ?>
		<th data-name="createuser" class="<?php echo $absen_list->createuser->headerCellClass() ?>"><div id="elh_absen_createuser" class="absen_createuser"><div class="ew-table-header-caption"><?php echo $absen_list->createuser->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createuser" class="<?php echo $absen_list->createuser->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $absen_list->SortUrl($absen_list->createuser) ?>', 1);"><div id="elh_absen_createuser" class="absen_createuser">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $absen_list->createuser->caption() ?></span><span class="ew-table-header-sort"><?php if ($absen_list->createuser->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($absen_list->createuser->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$absen_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($absen_list->ExportAll && $absen_list->isExport()) {
	$absen_list->StopRecord = $absen_list->TotalRecords;
} else {

	// Set the last record to display
	if ($absen_list->TotalRecords > $absen_list->StartRecord + $absen_list->DisplayRecords - 1)
		$absen_list->StopRecord = $absen_list->StartRecord + $absen_list->DisplayRecords - 1;
	else
		$absen_list->StopRecord = $absen_list->TotalRecords;
}
$absen_list->RecordCount = $absen_list->StartRecord - 1;
if ($absen_list->Recordset && !$absen_list->Recordset->EOF) {
	$absen_list->Recordset->moveFirst();
	$selectLimit = $absen_list->UseSelectLimit;
	if (!$selectLimit && $absen_list->StartRecord > 1)
		$absen_list->Recordset->move($absen_list->StartRecord - 1);
} elseif (!$absen->AllowAddDeleteRow && $absen_list->StopRecord == 0) {
	$absen_list->StopRecord = $absen->GridAddRowCount;
}

// Initialize aggregate
$absen->RowType = ROWTYPE_AGGREGATEINIT;
$absen->resetAttributes();
$absen_list->renderRow();
while ($absen_list->RecordCount < $absen_list->StopRecord) {
	$absen_list->RecordCount++;
	if ($absen_list->RecordCount >= $absen_list->StartRecord) {
		$absen_list->RowCount++;

		// Set up key count
		$absen_list->KeyCount = $absen_list->RowIndex;

		// Init row class and style
		$absen->resetAttributes();
		$absen->CssClass = "";
		if ($absen_list->isGridAdd()) {
		} else {
			$absen_list->loadRowValues($absen_list->Recordset); // Load row values
		}
		$absen->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$absen->RowAttrs->merge(["data-rowindex" => $absen_list->RowCount, "id" => "r" . $absen_list->RowCount . "_absen", "data-rowtype" => $absen->RowType]);

		// Render row
		$absen_list->renderRow();

		// Render list options
		$absen_list->renderListOptions();
?>
	<tr <?php echo $absen->rowAttributes() ?>>
<?php

// Render list options (body, left)
$absen_list->ListOptions->render("body", "left", $absen_list->RowCount);
?>
	<?php if ($absen_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $absen_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $absen_list->RowCount ?>_absen_tahun">
<span<?php echo $absen_list->tahun->viewAttributes() ?>><?php echo $absen_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($absen_list->bulan->Visible) { // bulan ?>
		<td data-name="bulan" <?php echo $absen_list->bulan->cellAttributes() ?>>
<span id="el<?php echo $absen_list->RowCount ?>_absen_bulan">
<span<?php echo $absen_list->bulan->viewAttributes() ?>><?php echo $absen_list->bulan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($absen_list->jumlah_hari_kerja->Visible) { // jumlah_hari_kerja ?>
		<td data-name="jumlah_hari_kerja" <?php echo $absen_list->jumlah_hari_kerja->cellAttributes() ?>>
<span id="el<?php echo $absen_list->RowCount ?>_absen_jumlah_hari_kerja">
<span<?php echo $absen_list->jumlah_hari_kerja->viewAttributes() ?>><?php echo $absen_list->jumlah_hari_kerja->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($absen_list->datetime->Visible) { // datetime ?>
		<td data-name="datetime" <?php echo $absen_list->datetime->cellAttributes() ?>>
<span id="el<?php echo $absen_list->RowCount ?>_absen_datetime">
<span<?php echo $absen_list->datetime->viewAttributes() ?>><?php echo $absen_list->datetime->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($absen_list->createuser->Visible) { // createuser ?>
		<td data-name="createuser" <?php echo $absen_list->createuser->cellAttributes() ?>>
<span id="el<?php echo $absen_list->RowCount ?>_absen_createuser">
<span<?php echo $absen_list->createuser->viewAttributes() ?>><?php echo $absen_list->createuser->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$absen_list->ListOptions->render("body", "right", $absen_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$absen_list->isGridAdd())
		$absen_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$absen->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($absen_list->Recordset)
	$absen_list->Recordset->Close();
?>
<?php if (!$absen_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$absen_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $absen_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $absen_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($absen_list->TotalRecords == 0 && !$absen->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $absen_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$absen_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$absen_list->isExport()) { ?>
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
$absen_list->terminate();
?>