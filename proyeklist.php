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
$proyek_list = new proyek_list();

// Run the page
$proyek_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proyek_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$proyek_list->isExport()) { ?>
<script>
var fproyeklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproyeklist = currentForm = new ew.Form("fproyeklist", "list");
	fproyeklist.formKeyCountName = '<?php echo $proyek_list->FormKeyCountName ?>';
	loadjs.done("fproyeklist");
});
var fproyeklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproyeklistsrch = currentSearchForm = new ew.Form("fproyeklistsrch");

	// Dynamic selection lists
	// Filters

	fproyeklistsrch.filterList = <?php echo $proyek_list->getFilterList() ?>;
	loadjs.done("fproyeklistsrch");
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
<?php if (!$proyek_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($proyek_list->TotalRecords > 0 && $proyek_list->ExportOptions->visible()) { ?>
<?php $proyek_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($proyek_list->ImportOptions->visible()) { ?>
<?php $proyek_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($proyek_list->SearchOptions->visible()) { ?>
<?php $proyek_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($proyek_list->FilterOptions->visible()) { ?>
<?php $proyek_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$proyek_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$proyek_list->isExport() && !$proyek->CurrentAction) { ?>
<form name="fproyeklistsrch" id="fproyeklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproyeklistsrch-search-panel" class="<?php echo $proyek_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="proyek">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $proyek_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($proyek_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($proyek_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $proyek_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($proyek_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($proyek_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($proyek_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($proyek_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $proyek_list->showPageHeader(); ?>
<?php
$proyek_list->showMessage();
?>
<?php if ($proyek_list->TotalRecords > 0 || $proyek->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($proyek_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> proyek">
<?php if (!$proyek_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$proyek_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $proyek_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $proyek_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproyeklist" id="fproyeklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proyek">
<div id="gmp_proyek" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($proyek_list->TotalRecords > 0 || $proyek_list->isGridEdit()) { ?>
<table id="tbl_proyeklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$proyek->RowType = ROWTYPE_HEADER;

// Render list options
$proyek_list->renderListOptions();

// Render list options (header, left)
$proyek_list->ListOptions->render("header", "left");
?>
<?php if ($proyek_list->id->Visible) { // id ?>
	<?php if ($proyek_list->SortUrl($proyek_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $proyek_list->id->headerCellClass() ?>"><div id="elh_proyek_id" class="proyek_id"><div class="ew-table-header-caption"><?php echo $proyek_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $proyek_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $proyek_list->SortUrl($proyek_list->id) ?>', 1);"><div id="elh_proyek_id" class="proyek_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proyek_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($proyek_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($proyek_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proyek_list->klien->Visible) { // klien ?>
	<?php if ($proyek_list->SortUrl($proyek_list->klien) == "") { ?>
		<th data-name="klien" class="<?php echo $proyek_list->klien->headerCellClass() ?>"><div id="elh_proyek_klien" class="proyek_klien"><div class="ew-table-header-caption"><?php echo $proyek_list->klien->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="klien" class="<?php echo $proyek_list->klien->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $proyek_list->SortUrl($proyek_list->klien) ?>', 1);"><div id="elh_proyek_klien" class="proyek_klien">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proyek_list->klien->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proyek_list->klien->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($proyek_list->klien->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proyek_list->proyek->Visible) { // proyek ?>
	<?php if ($proyek_list->SortUrl($proyek_list->proyek) == "") { ?>
		<th data-name="proyek" class="<?php echo $proyek_list->proyek->headerCellClass() ?>"><div id="elh_proyek_proyek" class="proyek_proyek"><div class="ew-table-header-caption"><?php echo $proyek_list->proyek->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="proyek" class="<?php echo $proyek_list->proyek->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $proyek_list->SortUrl($proyek_list->proyek) ?>', 1);"><div id="elh_proyek_proyek" class="proyek_proyek">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proyek_list->proyek->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proyek_list->proyek->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($proyek_list->proyek->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proyek_list->tgl_awal->Visible) { // tgl_awal ?>
	<?php if ($proyek_list->SortUrl($proyek_list->tgl_awal) == "") { ?>
		<th data-name="tgl_awal" class="<?php echo $proyek_list->tgl_awal->headerCellClass() ?>"><div id="elh_proyek_tgl_awal" class="proyek_tgl_awal"><div class="ew-table-header-caption"><?php echo $proyek_list->tgl_awal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_awal" class="<?php echo $proyek_list->tgl_awal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $proyek_list->SortUrl($proyek_list->tgl_awal) ?>', 1);"><div id="elh_proyek_tgl_awal" class="proyek_tgl_awal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proyek_list->tgl_awal->caption() ?></span><span class="ew-table-header-sort"><?php if ($proyek_list->tgl_awal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($proyek_list->tgl_awal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proyek_list->tgl_akhir->Visible) { // tgl_akhir ?>
	<?php if ($proyek_list->SortUrl($proyek_list->tgl_akhir) == "") { ?>
		<th data-name="tgl_akhir" class="<?php echo $proyek_list->tgl_akhir->headerCellClass() ?>"><div id="elh_proyek_tgl_akhir" class="proyek_tgl_akhir"><div class="ew-table-header-caption"><?php echo $proyek_list->tgl_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_akhir" class="<?php echo $proyek_list->tgl_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $proyek_list->SortUrl($proyek_list->tgl_akhir) ?>', 1);"><div id="elh_proyek_tgl_akhir" class="proyek_tgl_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proyek_list->tgl_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($proyek_list->tgl_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($proyek_list->tgl_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proyek_list->file_proyek->Visible) { // file_proyek ?>
	<?php if ($proyek_list->SortUrl($proyek_list->file_proyek) == "") { ?>
		<th data-name="file_proyek" class="<?php echo $proyek_list->file_proyek->headerCellClass() ?>"><div id="elh_proyek_file_proyek" class="proyek_file_proyek"><div class="ew-table-header-caption"><?php echo $proyek_list->file_proyek->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="file_proyek" class="<?php echo $proyek_list->file_proyek->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $proyek_list->SortUrl($proyek_list->file_proyek) ?>', 1);"><div id="elh_proyek_file_proyek" class="proyek_file_proyek">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proyek_list->file_proyek->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proyek_list->file_proyek->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($proyek_list->file_proyek->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proyek_list->aktif->Visible) { // aktif ?>
	<?php if ($proyek_list->SortUrl($proyek_list->aktif) == "") { ?>
		<th data-name="aktif" class="<?php echo $proyek_list->aktif->headerCellClass() ?>"><div id="elh_proyek_aktif" class="proyek_aktif"><div class="ew-table-header-caption"><?php echo $proyek_list->aktif->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="aktif" class="<?php echo $proyek_list->aktif->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $proyek_list->SortUrl($proyek_list->aktif) ?>', 1);"><div id="elh_proyek_aktif" class="proyek_aktif">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proyek_list->aktif->caption() ?></span><span class="ew-table-header-sort"><?php if ($proyek_list->aktif->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($proyek_list->aktif->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$proyek_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($proyek_list->ExportAll && $proyek_list->isExport()) {
	$proyek_list->StopRecord = $proyek_list->TotalRecords;
} else {

	// Set the last record to display
	if ($proyek_list->TotalRecords > $proyek_list->StartRecord + $proyek_list->DisplayRecords - 1)
		$proyek_list->StopRecord = $proyek_list->StartRecord + $proyek_list->DisplayRecords - 1;
	else
		$proyek_list->StopRecord = $proyek_list->TotalRecords;
}
$proyek_list->RecordCount = $proyek_list->StartRecord - 1;
if ($proyek_list->Recordset && !$proyek_list->Recordset->EOF) {
	$proyek_list->Recordset->moveFirst();
	$selectLimit = $proyek_list->UseSelectLimit;
	if (!$selectLimit && $proyek_list->StartRecord > 1)
		$proyek_list->Recordset->move($proyek_list->StartRecord - 1);
} elseif (!$proyek->AllowAddDeleteRow && $proyek_list->StopRecord == 0) {
	$proyek_list->StopRecord = $proyek->GridAddRowCount;
}

// Initialize aggregate
$proyek->RowType = ROWTYPE_AGGREGATEINIT;
$proyek->resetAttributes();
$proyek_list->renderRow();
while ($proyek_list->RecordCount < $proyek_list->StopRecord) {
	$proyek_list->RecordCount++;
	if ($proyek_list->RecordCount >= $proyek_list->StartRecord) {
		$proyek_list->RowCount++;

		// Set up key count
		$proyek_list->KeyCount = $proyek_list->RowIndex;

		// Init row class and style
		$proyek->resetAttributes();
		$proyek->CssClass = "";
		if ($proyek_list->isGridAdd()) {
		} else {
			$proyek_list->loadRowValues($proyek_list->Recordset); // Load row values
		}
		$proyek->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$proyek->RowAttrs->merge(["data-rowindex" => $proyek_list->RowCount, "id" => "r" . $proyek_list->RowCount . "_proyek", "data-rowtype" => $proyek->RowType]);

		// Render row
		$proyek_list->renderRow();

		// Render list options
		$proyek_list->renderListOptions();
?>
	<tr <?php echo $proyek->rowAttributes() ?>>
<?php

// Render list options (body, left)
$proyek_list->ListOptions->render("body", "left", $proyek_list->RowCount);
?>
	<?php if ($proyek_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $proyek_list->id->cellAttributes() ?>>
<span id="el<?php echo $proyek_list->RowCount ?>_proyek_id">
<span<?php echo $proyek_list->id->viewAttributes() ?>><?php echo $proyek_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proyek_list->klien->Visible) { // klien ?>
		<td data-name="klien" <?php echo $proyek_list->klien->cellAttributes() ?>>
<span id="el<?php echo $proyek_list->RowCount ?>_proyek_klien">
<span<?php echo $proyek_list->klien->viewAttributes() ?>><?php echo $proyek_list->klien->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proyek_list->proyek->Visible) { // proyek ?>
		<td data-name="proyek" <?php echo $proyek_list->proyek->cellAttributes() ?>>
<span id="el<?php echo $proyek_list->RowCount ?>_proyek_proyek">
<span<?php echo $proyek_list->proyek->viewAttributes() ?>><?php echo $proyek_list->proyek->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proyek_list->tgl_awal->Visible) { // tgl_awal ?>
		<td data-name="tgl_awal" <?php echo $proyek_list->tgl_awal->cellAttributes() ?>>
<span id="el<?php echo $proyek_list->RowCount ?>_proyek_tgl_awal">
<span<?php echo $proyek_list->tgl_awal->viewAttributes() ?>><?php echo $proyek_list->tgl_awal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proyek_list->tgl_akhir->Visible) { // tgl_akhir ?>
		<td data-name="tgl_akhir" <?php echo $proyek_list->tgl_akhir->cellAttributes() ?>>
<span id="el<?php echo $proyek_list->RowCount ?>_proyek_tgl_akhir">
<span<?php echo $proyek_list->tgl_akhir->viewAttributes() ?>><?php echo $proyek_list->tgl_akhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proyek_list->file_proyek->Visible) { // file_proyek ?>
		<td data-name="file_proyek" <?php echo $proyek_list->file_proyek->cellAttributes() ?>>
<span id="el<?php echo $proyek_list->RowCount ?>_proyek_file_proyek">
<span<?php echo $proyek_list->file_proyek->viewAttributes() ?>><?php echo GetFileViewTag($proyek_list->file_proyek, $proyek_list->file_proyek->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proyek_list->aktif->Visible) { // aktif ?>
		<td data-name="aktif" <?php echo $proyek_list->aktif->cellAttributes() ?>>
<span id="el<?php echo $proyek_list->RowCount ?>_proyek_aktif">
<span<?php echo $proyek_list->aktif->viewAttributes() ?>><?php echo $proyek_list->aktif->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$proyek_list->ListOptions->render("body", "right", $proyek_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$proyek_list->isGridAdd())
		$proyek_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$proyek->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($proyek_list->Recordset)
	$proyek_list->Recordset->Close();
?>
<?php if (!$proyek_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$proyek_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $proyek_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $proyek_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($proyek_list->TotalRecords == 0 && !$proyek->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $proyek_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$proyek_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$proyek_list->isExport()) { ?>
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
$proyek_list->terminate();
?>