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
$pengetahuan_list = new pengetahuan_list();

// Run the page
$pengetahuan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pengetahuan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pengetahuan_list->isExport()) { ?>
<script>
var fpengetahuanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpengetahuanlist = currentForm = new ew.Form("fpengetahuanlist", "list");
	fpengetahuanlist.formKeyCountName = '<?php echo $pengetahuan_list->FormKeyCountName ?>';
	loadjs.done("fpengetahuanlist");
});
var fpengetahuanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpengetahuanlistsrch = currentSearchForm = new ew.Form("fpengetahuanlistsrch");

	// Dynamic selection lists
	// Filters

	fpengetahuanlistsrch.filterList = <?php echo $pengetahuan_list->getFilterList() ?>;
	loadjs.done("fpengetahuanlistsrch");
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
<?php if (!$pengetahuan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($pengetahuan_list->TotalRecords > 0 && $pengetahuan_list->ExportOptions->visible()) { ?>
<?php $pengetahuan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($pengetahuan_list->ImportOptions->visible()) { ?>
<?php $pengetahuan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($pengetahuan_list->SearchOptions->visible()) { ?>
<?php $pengetahuan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($pengetahuan_list->FilterOptions->visible()) { ?>
<?php $pengetahuan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$pengetahuan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$pengetahuan_list->isExport() && !$pengetahuan->CurrentAction) { ?>
<form name="fpengetahuanlistsrch" id="fpengetahuanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpengetahuanlistsrch-search-panel" class="<?php echo $pengetahuan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pengetahuan">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $pengetahuan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($pengetahuan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($pengetahuan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $pengetahuan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($pengetahuan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($pengetahuan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($pengetahuan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($pengetahuan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $pengetahuan_list->showPageHeader(); ?>
<?php
$pengetahuan_list->showMessage();
?>
<?php if ($pengetahuan_list->TotalRecords > 0 || $pengetahuan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pengetahuan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pengetahuan">
<?php if (!$pengetahuan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$pengetahuan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pengetahuan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pengetahuan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpengetahuanlist" id="fpengetahuanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pengetahuan">
<div id="gmp_pengetahuan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($pengetahuan_list->TotalRecords > 0 || $pengetahuan_list->isGridEdit()) { ?>
<table id="tbl_pengetahuanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pengetahuan->RowType = ROWTYPE_HEADER;

// Render list options
$pengetahuan_list->renderListOptions();

// Render list options (header, left)
$pengetahuan_list->ListOptions->render("header", "left");
?>
<?php if ($pengetahuan_list->id->Visible) { // id ?>
	<?php if ($pengetahuan_list->SortUrl($pengetahuan_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $pengetahuan_list->id->headerCellClass() ?>"><div id="elh_pengetahuan_id" class="pengetahuan_id"><div class="ew-table-header-caption"><?php echo $pengetahuan_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $pengetahuan_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pengetahuan_list->SortUrl($pengetahuan_list->id) ?>', 1);"><div id="elh_pengetahuan_id" class="pengetahuan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pengetahuan_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($pengetahuan_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pengetahuan_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pengetahuan_list->grup->Visible) { // grup ?>
	<?php if ($pengetahuan_list->SortUrl($pengetahuan_list->grup) == "") { ?>
		<th data-name="grup" class="<?php echo $pengetahuan_list->grup->headerCellClass() ?>"><div id="elh_pengetahuan_grup" class="pengetahuan_grup"><div class="ew-table-header-caption"><?php echo $pengetahuan_list->grup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="grup" class="<?php echo $pengetahuan_list->grup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pengetahuan_list->SortUrl($pengetahuan_list->grup) ?>', 1);"><div id="elh_pengetahuan_grup" class="pengetahuan_grup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pengetahuan_list->grup->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pengetahuan_list->grup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pengetahuan_list->grup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pengetahuan_list->sumber_url->Visible) { // sumber_url ?>
	<?php if ($pengetahuan_list->SortUrl($pengetahuan_list->sumber_url) == "") { ?>
		<th data-name="sumber_url" class="<?php echo $pengetahuan_list->sumber_url->headerCellClass() ?>"><div id="elh_pengetahuan_sumber_url" class="pengetahuan_sumber_url"><div class="ew-table-header-caption"><?php echo $pengetahuan_list->sumber_url->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sumber_url" class="<?php echo $pengetahuan_list->sumber_url->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pengetahuan_list->SortUrl($pengetahuan_list->sumber_url) ?>', 1);"><div id="elh_pengetahuan_sumber_url" class="pengetahuan_sumber_url">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pengetahuan_list->sumber_url->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pengetahuan_list->sumber_url->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pengetahuan_list->sumber_url->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pengetahuan_list->dokumen->Visible) { // dokumen ?>
	<?php if ($pengetahuan_list->SortUrl($pengetahuan_list->dokumen) == "") { ?>
		<th data-name="dokumen" class="<?php echo $pengetahuan_list->dokumen->headerCellClass() ?>"><div id="elh_pengetahuan_dokumen" class="pengetahuan_dokumen"><div class="ew-table-header-caption"><?php echo $pengetahuan_list->dokumen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dokumen" class="<?php echo $pengetahuan_list->dokumen->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pengetahuan_list->SortUrl($pengetahuan_list->dokumen) ?>', 1);"><div id="elh_pengetahuan_dokumen" class="pengetahuan_dokumen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pengetahuan_list->dokumen->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pengetahuan_list->dokumen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pengetahuan_list->dokumen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pengetahuan_list->visual->Visible) { // visual ?>
	<?php if ($pengetahuan_list->SortUrl($pengetahuan_list->visual) == "") { ?>
		<th data-name="visual" class="<?php echo $pengetahuan_list->visual->headerCellClass() ?>"><div id="elh_pengetahuan_visual" class="pengetahuan_visual"><div class="ew-table-header-caption"><?php echo $pengetahuan_list->visual->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="visual" class="<?php echo $pengetahuan_list->visual->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pengetahuan_list->SortUrl($pengetahuan_list->visual) ?>', 1);"><div id="elh_pengetahuan_visual" class="pengetahuan_visual">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pengetahuan_list->visual->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pengetahuan_list->visual->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pengetahuan_list->visual->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pengetahuan_list->c_by->Visible) { // c_by ?>
	<?php if ($pengetahuan_list->SortUrl($pengetahuan_list->c_by) == "") { ?>
		<th data-name="c_by" class="<?php echo $pengetahuan_list->c_by->headerCellClass() ?>"><div id="elh_pengetahuan_c_by" class="pengetahuan_c_by"><div class="ew-table-header-caption"><?php echo $pengetahuan_list->c_by->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="c_by" class="<?php echo $pengetahuan_list->c_by->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pengetahuan_list->SortUrl($pengetahuan_list->c_by) ?>', 1);"><div id="elh_pengetahuan_c_by" class="pengetahuan_c_by">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pengetahuan_list->c_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($pengetahuan_list->c_by->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pengetahuan_list->c_by->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pengetahuan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pengetahuan_list->ExportAll && $pengetahuan_list->isExport()) {
	$pengetahuan_list->StopRecord = $pengetahuan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($pengetahuan_list->TotalRecords > $pengetahuan_list->StartRecord + $pengetahuan_list->DisplayRecords - 1)
		$pengetahuan_list->StopRecord = $pengetahuan_list->StartRecord + $pengetahuan_list->DisplayRecords - 1;
	else
		$pengetahuan_list->StopRecord = $pengetahuan_list->TotalRecords;
}
$pengetahuan_list->RecordCount = $pengetahuan_list->StartRecord - 1;
if ($pengetahuan_list->Recordset && !$pengetahuan_list->Recordset->EOF) {
	$pengetahuan_list->Recordset->moveFirst();
	$selectLimit = $pengetahuan_list->UseSelectLimit;
	if (!$selectLimit && $pengetahuan_list->StartRecord > 1)
		$pengetahuan_list->Recordset->move($pengetahuan_list->StartRecord - 1);
} elseif (!$pengetahuan->AllowAddDeleteRow && $pengetahuan_list->StopRecord == 0) {
	$pengetahuan_list->StopRecord = $pengetahuan->GridAddRowCount;
}

// Initialize aggregate
$pengetahuan->RowType = ROWTYPE_AGGREGATEINIT;
$pengetahuan->resetAttributes();
$pengetahuan_list->renderRow();
while ($pengetahuan_list->RecordCount < $pengetahuan_list->StopRecord) {
	$pengetahuan_list->RecordCount++;
	if ($pengetahuan_list->RecordCount >= $pengetahuan_list->StartRecord) {
		$pengetahuan_list->RowCount++;

		// Set up key count
		$pengetahuan_list->KeyCount = $pengetahuan_list->RowIndex;

		// Init row class and style
		$pengetahuan->resetAttributes();
		$pengetahuan->CssClass = "";
		if ($pengetahuan_list->isGridAdd()) {
		} else {
			$pengetahuan_list->loadRowValues($pengetahuan_list->Recordset); // Load row values
		}
		$pengetahuan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pengetahuan->RowAttrs->merge(["data-rowindex" => $pengetahuan_list->RowCount, "id" => "r" . $pengetahuan_list->RowCount . "_pengetahuan", "data-rowtype" => $pengetahuan->RowType]);

		// Render row
		$pengetahuan_list->renderRow();

		// Render list options
		$pengetahuan_list->renderListOptions();
?>
	<tr <?php echo $pengetahuan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pengetahuan_list->ListOptions->render("body", "left", $pengetahuan_list->RowCount);
?>
	<?php if ($pengetahuan_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $pengetahuan_list->id->cellAttributes() ?>>
<span id="el<?php echo $pengetahuan_list->RowCount ?>_pengetahuan_id">
<span<?php echo $pengetahuan_list->id->viewAttributes() ?>><?php echo $pengetahuan_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pengetahuan_list->grup->Visible) { // grup ?>
		<td data-name="grup" <?php echo $pengetahuan_list->grup->cellAttributes() ?>>
<span id="el<?php echo $pengetahuan_list->RowCount ?>_pengetahuan_grup">
<span<?php echo $pengetahuan_list->grup->viewAttributes() ?>><?php echo $pengetahuan_list->grup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pengetahuan_list->sumber_url->Visible) { // sumber_url ?>
		<td data-name="sumber_url" <?php echo $pengetahuan_list->sumber_url->cellAttributes() ?>>
<span id="el<?php echo $pengetahuan_list->RowCount ?>_pengetahuan_sumber_url">
<span<?php echo $pengetahuan_list->sumber_url->viewAttributes() ?>><?php echo $pengetahuan_list->sumber_url->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pengetahuan_list->dokumen->Visible) { // dokumen ?>
		<td data-name="dokumen" <?php echo $pengetahuan_list->dokumen->cellAttributes() ?>>
<span id="el<?php echo $pengetahuan_list->RowCount ?>_pengetahuan_dokumen">
<span<?php echo $pengetahuan_list->dokumen->viewAttributes() ?>><?php echo $pengetahuan_list->dokumen->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pengetahuan_list->visual->Visible) { // visual ?>
		<td data-name="visual" <?php echo $pengetahuan_list->visual->cellAttributes() ?>>
<span id="el<?php echo $pengetahuan_list->RowCount ?>_pengetahuan_visual">
<span<?php echo $pengetahuan_list->visual->viewAttributes() ?>><?php echo $pengetahuan_list->visual->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pengetahuan_list->c_by->Visible) { // c_by ?>
		<td data-name="c_by" <?php echo $pengetahuan_list->c_by->cellAttributes() ?>>
<span id="el<?php echo $pengetahuan_list->RowCount ?>_pengetahuan_c_by">
<span<?php echo $pengetahuan_list->c_by->viewAttributes() ?>><?php echo $pengetahuan_list->c_by->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pengetahuan_list->ListOptions->render("body", "right", $pengetahuan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$pengetahuan_list->isGridAdd())
		$pengetahuan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$pengetahuan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pengetahuan_list->Recordset)
	$pengetahuan_list->Recordset->Close();
?>
<?php if (!$pengetahuan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$pengetahuan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pengetahuan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pengetahuan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pengetahuan_list->TotalRecords == 0 && !$pengetahuan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pengetahuan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$pengetahuan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pengetahuan_list->isExport()) { ?>
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
$pengetahuan_list->terminate();
?>