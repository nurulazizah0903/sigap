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
$berita_list = new berita_list();

// Run the page
$berita_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$berita_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$berita_list->isExport()) { ?>
<script>
var fberitalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fberitalist = currentForm = new ew.Form("fberitalist", "list");
	fberitalist.formKeyCountName = '<?php echo $berita_list->FormKeyCountName ?>';
	loadjs.done("fberitalist");
});
var fberitalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fberitalistsrch = currentSearchForm = new ew.Form("fberitalistsrch");

	// Dynamic selection lists
	// Filters

	fberitalistsrch.filterList = <?php echo $berita_list->getFilterList() ?>;
	loadjs.done("fberitalistsrch");
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
<?php if (!$berita_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($berita_list->TotalRecords > 0 && $berita_list->ExportOptions->visible()) { ?>
<?php $berita_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($berita_list->ImportOptions->visible()) { ?>
<?php $berita_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($berita_list->SearchOptions->visible()) { ?>
<?php $berita_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($berita_list->FilterOptions->visible()) { ?>
<?php $berita_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$berita_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$berita_list->isExport() && !$berita->CurrentAction) { ?>
<form name="fberitalistsrch" id="fberitalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fberitalistsrch-search-panel" class="<?php echo $berita_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="berita">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $berita_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($berita_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($berita_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $berita_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($berita_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($berita_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($berita_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($berita_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $berita_list->showPageHeader(); ?>
<?php
$berita_list->showMessage();
?>
<?php if ($berita_list->TotalRecords > 0 || $berita->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($berita_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> berita">
<?php if (!$berita_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$berita_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $berita_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $berita_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fberitalist" id="fberitalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="berita">
<div id="gmp_berita" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($berita_list->TotalRecords > 0 || $berita_list->isGridEdit()) { ?>
<table id="tbl_beritalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$berita->RowType = ROWTYPE_HEADER;

// Render list options
$berita_list->renderListOptions();

// Render list options (header, left)
$berita_list->ListOptions->render("header", "left");
?>
<?php if ($berita_list->id->Visible) { // id ?>
	<?php if ($berita_list->SortUrl($berita_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $berita_list->id->headerCellClass() ?>"><div id="elh_berita_id" class="berita_id"><div class="ew-table-header-caption"><?php echo $berita_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $berita_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $berita_list->SortUrl($berita_list->id) ?>', 1);"><div id="elh_berita_id" class="berita_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $berita_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($berita_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($berita_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($berita_list->grup->Visible) { // grup ?>
	<?php if ($berita_list->SortUrl($berita_list->grup) == "") { ?>
		<th data-name="grup" class="<?php echo $berita_list->grup->headerCellClass() ?>"><div id="elh_berita_grup" class="berita_grup"><div class="ew-table-header-caption"><?php echo $berita_list->grup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="grup" class="<?php echo $berita_list->grup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $berita_list->SortUrl($berita_list->grup) ?>', 1);"><div id="elh_berita_grup" class="berita_grup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $berita_list->grup->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($berita_list->grup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($berita_list->grup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($berita_list->judul->Visible) { // judul ?>
	<?php if ($berita_list->SortUrl($berita_list->judul) == "") { ?>
		<th data-name="judul" class="<?php echo $berita_list->judul->headerCellClass() ?>"><div id="elh_berita_judul" class="berita_judul"><div class="ew-table-header-caption"><?php echo $berita_list->judul->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="judul" class="<?php echo $berita_list->judul->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $berita_list->SortUrl($berita_list->judul) ?>', 1);"><div id="elh_berita_judul" class="berita_judul">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $berita_list->judul->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($berita_list->judul->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($berita_list->judul->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($berita_list->gambar->Visible) { // gambar ?>
	<?php if ($berita_list->SortUrl($berita_list->gambar) == "") { ?>
		<th data-name="gambar" class="<?php echo $berita_list->gambar->headerCellClass() ?>"><div id="elh_berita_gambar" class="berita_gambar"><div class="ew-table-header-caption"><?php echo $berita_list->gambar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gambar" class="<?php echo $berita_list->gambar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $berita_list->SortUrl($berita_list->gambar) ?>', 1);"><div id="elh_berita_gambar" class="berita_gambar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $berita_list->gambar->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($berita_list->gambar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($berita_list->gambar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($berita_list->video->Visible) { // video ?>
	<?php if ($berita_list->SortUrl($berita_list->video) == "") { ?>
		<th data-name="video" class="<?php echo $berita_list->video->headerCellClass() ?>"><div id="elh_berita_video" class="berita_video"><div class="ew-table-header-caption"><?php echo $berita_list->video->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="video" class="<?php echo $berita_list->video->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $berita_list->SortUrl($berita_list->video) ?>', 1);"><div id="elh_berita_video" class="berita_video">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $berita_list->video->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($berita_list->video->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($berita_list->video->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($berita_list->c_by->Visible) { // c_by ?>
	<?php if ($berita_list->SortUrl($berita_list->c_by) == "") { ?>
		<th data-name="c_by" class="<?php echo $berita_list->c_by->headerCellClass() ?>"><div id="elh_berita_c_by" class="berita_c_by"><div class="ew-table-header-caption"><?php echo $berita_list->c_by->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="c_by" class="<?php echo $berita_list->c_by->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $berita_list->SortUrl($berita_list->c_by) ?>', 1);"><div id="elh_berita_c_by" class="berita_c_by">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $berita_list->c_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($berita_list->c_by->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($berita_list->c_by->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($berita_list->c_date->Visible) { // c_date ?>
	<?php if ($berita_list->SortUrl($berita_list->c_date) == "") { ?>
		<th data-name="c_date" class="<?php echo $berita_list->c_date->headerCellClass() ?>"><div id="elh_berita_c_date" class="berita_c_date"><div class="ew-table-header-caption"><?php echo $berita_list->c_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="c_date" class="<?php echo $berita_list->c_date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $berita_list->SortUrl($berita_list->c_date) ?>', 1);"><div id="elh_berita_c_date" class="berita_c_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $berita_list->c_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($berita_list->c_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($berita_list->c_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($berita_list->aktif->Visible) { // aktif ?>
	<?php if ($berita_list->SortUrl($berita_list->aktif) == "") { ?>
		<th data-name="aktif" class="<?php echo $berita_list->aktif->headerCellClass() ?>"><div id="elh_berita_aktif" class="berita_aktif"><div class="ew-table-header-caption"><?php echo $berita_list->aktif->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="aktif" class="<?php echo $berita_list->aktif->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $berita_list->SortUrl($berita_list->aktif) ?>', 1);"><div id="elh_berita_aktif" class="berita_aktif">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $berita_list->aktif->caption() ?></span><span class="ew-table-header-sort"><?php if ($berita_list->aktif->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($berita_list->aktif->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$berita_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($berita_list->ExportAll && $berita_list->isExport()) {
	$berita_list->StopRecord = $berita_list->TotalRecords;
} else {

	// Set the last record to display
	if ($berita_list->TotalRecords > $berita_list->StartRecord + $berita_list->DisplayRecords - 1)
		$berita_list->StopRecord = $berita_list->StartRecord + $berita_list->DisplayRecords - 1;
	else
		$berita_list->StopRecord = $berita_list->TotalRecords;
}
$berita_list->RecordCount = $berita_list->StartRecord - 1;
if ($berita_list->Recordset && !$berita_list->Recordset->EOF) {
	$berita_list->Recordset->moveFirst();
	$selectLimit = $berita_list->UseSelectLimit;
	if (!$selectLimit && $berita_list->StartRecord > 1)
		$berita_list->Recordset->move($berita_list->StartRecord - 1);
} elseif (!$berita->AllowAddDeleteRow && $berita_list->StopRecord == 0) {
	$berita_list->StopRecord = $berita->GridAddRowCount;
}

// Initialize aggregate
$berita->RowType = ROWTYPE_AGGREGATEINIT;
$berita->resetAttributes();
$berita_list->renderRow();
while ($berita_list->RecordCount < $berita_list->StopRecord) {
	$berita_list->RecordCount++;
	if ($berita_list->RecordCount >= $berita_list->StartRecord) {
		$berita_list->RowCount++;

		// Set up key count
		$berita_list->KeyCount = $berita_list->RowIndex;

		// Init row class and style
		$berita->resetAttributes();
		$berita->CssClass = "";
		if ($berita_list->isGridAdd()) {
		} else {
			$berita_list->loadRowValues($berita_list->Recordset); // Load row values
		}
		$berita->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$berita->RowAttrs->merge(["data-rowindex" => $berita_list->RowCount, "id" => "r" . $berita_list->RowCount . "_berita", "data-rowtype" => $berita->RowType]);

		// Render row
		$berita_list->renderRow();

		// Render list options
		$berita_list->renderListOptions();
?>
	<tr <?php echo $berita->rowAttributes() ?>>
<?php

// Render list options (body, left)
$berita_list->ListOptions->render("body", "left", $berita_list->RowCount);
?>
	<?php if ($berita_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $berita_list->id->cellAttributes() ?>>
<span id="el<?php echo $berita_list->RowCount ?>_berita_id">
<span<?php echo $berita_list->id->viewAttributes() ?>><?php echo $berita_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($berita_list->grup->Visible) { // grup ?>
		<td data-name="grup" <?php echo $berita_list->grup->cellAttributes() ?>>
<span id="el<?php echo $berita_list->RowCount ?>_berita_grup">
<span<?php echo $berita_list->grup->viewAttributes() ?>><?php echo $berita_list->grup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($berita_list->judul->Visible) { // judul ?>
		<td data-name="judul" <?php echo $berita_list->judul->cellAttributes() ?>>
<span id="el<?php echo $berita_list->RowCount ?>_berita_judul">
<span<?php echo $berita_list->judul->viewAttributes() ?>><?php echo $berita_list->judul->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($berita_list->gambar->Visible) { // gambar ?>
		<td data-name="gambar" <?php echo $berita_list->gambar->cellAttributes() ?>>
<span id="el<?php echo $berita_list->RowCount ?>_berita_gambar">
<span<?php echo $berita_list->gambar->viewAttributes() ?>><?php echo $berita_list->gambar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($berita_list->video->Visible) { // video ?>
		<td data-name="video" <?php echo $berita_list->video->cellAttributes() ?>>
<span id="el<?php echo $berita_list->RowCount ?>_berita_video">
<span<?php echo $berita_list->video->viewAttributes() ?>><?php echo $berita_list->video->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($berita_list->c_by->Visible) { // c_by ?>
		<td data-name="c_by" <?php echo $berita_list->c_by->cellAttributes() ?>>
<span id="el<?php echo $berita_list->RowCount ?>_berita_c_by">
<span<?php echo $berita_list->c_by->viewAttributes() ?>><?php echo $berita_list->c_by->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($berita_list->c_date->Visible) { // c_date ?>
		<td data-name="c_date" <?php echo $berita_list->c_date->cellAttributes() ?>>
<span id="el<?php echo $berita_list->RowCount ?>_berita_c_date">
<span<?php echo $berita_list->c_date->viewAttributes() ?>><?php echo $berita_list->c_date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($berita_list->aktif->Visible) { // aktif ?>
		<td data-name="aktif" <?php echo $berita_list->aktif->cellAttributes() ?>>
<span id="el<?php echo $berita_list->RowCount ?>_berita_aktif">
<span<?php echo $berita_list->aktif->viewAttributes() ?>><?php echo $berita_list->aktif->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$berita_list->ListOptions->render("body", "right", $berita_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$berita_list->isGridAdd())
		$berita_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$berita->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($berita_list->Recordset)
	$berita_list->Recordset->Close();
?>
<?php if (!$berita_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$berita_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $berita_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $berita_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($berita_list->TotalRecords == 0 && !$berita->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $berita_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$berita_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$berita_list->isExport()) { ?>
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
$berita_list->terminate();
?>