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
$jenis_lembur_list = new jenis_lembur_list();

// Run the page
$jenis_lembur_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jenis_lembur_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$jenis_lembur_list->isExport()) { ?>
<script>
var fjenis_lemburlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fjenis_lemburlist = currentForm = new ew.Form("fjenis_lemburlist", "list");
	fjenis_lemburlist.formKeyCountName = '<?php echo $jenis_lembur_list->FormKeyCountName ?>';
	loadjs.done("fjenis_lemburlist");
});
var fjenis_lemburlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fjenis_lemburlistsrch = currentSearchForm = new ew.Form("fjenis_lemburlistsrch");

	// Dynamic selection lists
	// Filters

	fjenis_lemburlistsrch.filterList = <?php echo $jenis_lembur_list->getFilterList() ?>;
	loadjs.done("fjenis_lemburlistsrch");
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
<?php if (!$jenis_lembur_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($jenis_lembur_list->TotalRecords > 0 && $jenis_lembur_list->ExportOptions->visible()) { ?>
<?php $jenis_lembur_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($jenis_lembur_list->ImportOptions->visible()) { ?>
<?php $jenis_lembur_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($jenis_lembur_list->SearchOptions->visible()) { ?>
<?php $jenis_lembur_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($jenis_lembur_list->FilterOptions->visible()) { ?>
<?php $jenis_lembur_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$jenis_lembur_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$jenis_lembur_list->isExport() && !$jenis_lembur->CurrentAction) { ?>
<form name="fjenis_lemburlistsrch" id="fjenis_lemburlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fjenis_lemburlistsrch-search-panel" class="<?php echo $jenis_lembur_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="jenis_lembur">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $jenis_lembur_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($jenis_lembur_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($jenis_lembur_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $jenis_lembur_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($jenis_lembur_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($jenis_lembur_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($jenis_lembur_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($jenis_lembur_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $jenis_lembur_list->showPageHeader(); ?>
<?php
$jenis_lembur_list->showMessage();
?>
<?php if ($jenis_lembur_list->TotalRecords > 0 || $jenis_lembur->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($jenis_lembur_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> jenis_lembur">
<?php if (!$jenis_lembur_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$jenis_lembur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jenis_lembur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jenis_lembur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fjenis_lemburlist" id="fjenis_lemburlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="jenis_lembur">
<div id="gmp_jenis_lembur" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($jenis_lembur_list->TotalRecords > 0 || $jenis_lembur_list->isGridEdit()) { ?>
<table id="tbl_jenis_lemburlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$jenis_lembur->RowType = ROWTYPE_HEADER;

// Render list options
$jenis_lembur_list->renderListOptions();

// Render list options (header, left)
$jenis_lembur_list->ListOptions->render("header", "left");
?>
<?php if ($jenis_lembur_list->nama->Visible) { // nama ?>
	<?php if ($jenis_lembur_list->SortUrl($jenis_lembur_list->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $jenis_lembur_list->nama->headerCellClass() ?>"><div id="elh_jenis_lembur_nama" class="jenis_lembur_nama"><div class="ew-table-header-caption"><?php echo $jenis_lembur_list->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $jenis_lembur_list->nama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jenis_lembur_list->SortUrl($jenis_lembur_list->nama) ?>', 1);"><div id="elh_jenis_lembur_nama" class="jenis_lembur_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jenis_lembur_list->nama->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jenis_lembur_list->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jenis_lembur_list->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($jenis_lembur_list->aktif->Visible) { // aktif ?>
	<?php if ($jenis_lembur_list->SortUrl($jenis_lembur_list->aktif) == "") { ?>
		<th data-name="aktif" class="<?php echo $jenis_lembur_list->aktif->headerCellClass() ?>"><div id="elh_jenis_lembur_aktif" class="jenis_lembur_aktif"><div class="ew-table-header-caption"><?php echo $jenis_lembur_list->aktif->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="aktif" class="<?php echo $jenis_lembur_list->aktif->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $jenis_lembur_list->SortUrl($jenis_lembur_list->aktif) ?>', 1);"><div id="elh_jenis_lembur_aktif" class="jenis_lembur_aktif">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $jenis_lembur_list->aktif->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($jenis_lembur_list->aktif->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($jenis_lembur_list->aktif->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$jenis_lembur_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($jenis_lembur_list->ExportAll && $jenis_lembur_list->isExport()) {
	$jenis_lembur_list->StopRecord = $jenis_lembur_list->TotalRecords;
} else {

	// Set the last record to display
	if ($jenis_lembur_list->TotalRecords > $jenis_lembur_list->StartRecord + $jenis_lembur_list->DisplayRecords - 1)
		$jenis_lembur_list->StopRecord = $jenis_lembur_list->StartRecord + $jenis_lembur_list->DisplayRecords - 1;
	else
		$jenis_lembur_list->StopRecord = $jenis_lembur_list->TotalRecords;
}
$jenis_lembur_list->RecordCount = $jenis_lembur_list->StartRecord - 1;
if ($jenis_lembur_list->Recordset && !$jenis_lembur_list->Recordset->EOF) {
	$jenis_lembur_list->Recordset->moveFirst();
	$selectLimit = $jenis_lembur_list->UseSelectLimit;
	if (!$selectLimit && $jenis_lembur_list->StartRecord > 1)
		$jenis_lembur_list->Recordset->move($jenis_lembur_list->StartRecord - 1);
} elseif (!$jenis_lembur->AllowAddDeleteRow && $jenis_lembur_list->StopRecord == 0) {
	$jenis_lembur_list->StopRecord = $jenis_lembur->GridAddRowCount;
}

// Initialize aggregate
$jenis_lembur->RowType = ROWTYPE_AGGREGATEINIT;
$jenis_lembur->resetAttributes();
$jenis_lembur_list->renderRow();
while ($jenis_lembur_list->RecordCount < $jenis_lembur_list->StopRecord) {
	$jenis_lembur_list->RecordCount++;
	if ($jenis_lembur_list->RecordCount >= $jenis_lembur_list->StartRecord) {
		$jenis_lembur_list->RowCount++;

		// Set up key count
		$jenis_lembur_list->KeyCount = $jenis_lembur_list->RowIndex;

		// Init row class and style
		$jenis_lembur->resetAttributes();
		$jenis_lembur->CssClass = "";
		if ($jenis_lembur_list->isGridAdd()) {
		} else {
			$jenis_lembur_list->loadRowValues($jenis_lembur_list->Recordset); // Load row values
		}
		$jenis_lembur->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$jenis_lembur->RowAttrs->merge(["data-rowindex" => $jenis_lembur_list->RowCount, "id" => "r" . $jenis_lembur_list->RowCount . "_jenis_lembur", "data-rowtype" => $jenis_lembur->RowType]);

		// Render row
		$jenis_lembur_list->renderRow();

		// Render list options
		$jenis_lembur_list->renderListOptions();
?>
	<tr <?php echo $jenis_lembur->rowAttributes() ?>>
<?php

// Render list options (body, left)
$jenis_lembur_list->ListOptions->render("body", "left", $jenis_lembur_list->RowCount);
?>
	<?php if ($jenis_lembur_list->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $jenis_lembur_list->nama->cellAttributes() ?>>
<span id="el<?php echo $jenis_lembur_list->RowCount ?>_jenis_lembur_nama">
<span<?php echo $jenis_lembur_list->nama->viewAttributes() ?>><?php echo $jenis_lembur_list->nama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($jenis_lembur_list->aktif->Visible) { // aktif ?>
		<td data-name="aktif" <?php echo $jenis_lembur_list->aktif->cellAttributes() ?>>
<span id="el<?php echo $jenis_lembur_list->RowCount ?>_jenis_lembur_aktif">
<span<?php echo $jenis_lembur_list->aktif->viewAttributes() ?>><?php echo $jenis_lembur_list->aktif->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$jenis_lembur_list->ListOptions->render("body", "right", $jenis_lembur_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$jenis_lembur_list->isGridAdd())
		$jenis_lembur_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$jenis_lembur->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($jenis_lembur_list->Recordset)
	$jenis_lembur_list->Recordset->Close();
?>
<?php if (!$jenis_lembur_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$jenis_lembur_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $jenis_lembur_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $jenis_lembur_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($jenis_lembur_list->TotalRecords == 0 && !$jenis_lembur->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $jenis_lembur_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$jenis_lembur_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$jenis_lembur_list->isExport()) { ?>
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
$jenis_lembur_list->terminate();
?>