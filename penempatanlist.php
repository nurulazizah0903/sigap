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
$penempatan_list = new penempatan_list();

// Run the page
$penempatan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$penempatan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$penempatan_list->isExport()) { ?>
<script>
var fpenempatanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpenempatanlist = currentForm = new ew.Form("fpenempatanlist", "list");
	fpenempatanlist.formKeyCountName = '<?php echo $penempatan_list->FormKeyCountName ?>';
	loadjs.done("fpenempatanlist");
});
var fpenempatanlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpenempatanlistsrch = currentSearchForm = new ew.Form("fpenempatanlistsrch");

	// Dynamic selection lists
	// Filters

	fpenempatanlistsrch.filterList = <?php echo $penempatan_list->getFilterList() ?>;
	loadjs.done("fpenempatanlistsrch");
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
<?php if (!$penempatan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($penempatan_list->TotalRecords > 0 && $penempatan_list->ExportOptions->visible()) { ?>
<?php $penempatan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($penempatan_list->ImportOptions->visible()) { ?>
<?php $penempatan_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($penempatan_list->SearchOptions->visible()) { ?>
<?php $penempatan_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($penempatan_list->FilterOptions->visible()) { ?>
<?php $penempatan_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$penempatan_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$penempatan_list->isExport() && !$penempatan->CurrentAction) { ?>
<form name="fpenempatanlistsrch" id="fpenempatanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpenempatanlistsrch-search-panel" class="<?php echo $penempatan_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="penempatan">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $penempatan_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($penempatan_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($penempatan_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $penempatan_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($penempatan_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($penempatan_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($penempatan_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($penempatan_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $penempatan_list->showPageHeader(); ?>
<?php
$penempatan_list->showMessage();
?>
<?php if ($penempatan_list->TotalRecords > 0 || $penempatan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($penempatan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> penempatan">
<?php if (!$penempatan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$penempatan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $penempatan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $penempatan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpenempatanlist" id="fpenempatanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="penempatan">
<div id="gmp_penempatan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($penempatan_list->TotalRecords > 0 || $penempatan_list->isGridEdit()) { ?>
<table id="tbl_penempatanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$penempatan->RowType = ROWTYPE_HEADER;

// Render list options
$penempatan_list->renderListOptions();

// Render list options (header, left)
$penempatan_list->ListOptions->render("header", "left");
?>
<?php if ($penempatan_list->pegawai->Visible) { // pegawai ?>
	<?php if ($penempatan_list->SortUrl($penempatan_list->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $penempatan_list->pegawai->headerCellClass() ?>"><div id="elh_penempatan_pegawai" class="penempatan_pegawai"><div class="ew-table-header-caption"><?php echo $penempatan_list->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $penempatan_list->pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penempatan_list->SortUrl($penempatan_list->pegawai) ?>', 1);"><div id="elh_penempatan_pegawai" class="penempatan_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penempatan_list->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($penempatan_list->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penempatan_list->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penempatan_list->project->Visible) { // project ?>
	<?php if ($penempatan_list->SortUrl($penempatan_list->project) == "") { ?>
		<th data-name="project" class="<?php echo $penempatan_list->project->headerCellClass() ?>"><div id="elh_penempatan_project" class="penempatan_project"><div class="ew-table-header-caption"><?php echo $penempatan_list->project->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="project" class="<?php echo $penempatan_list->project->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penempatan_list->SortUrl($penempatan_list->project) ?>', 1);"><div id="elh_penempatan_project" class="penempatan_project">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penempatan_list->project->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penempatan_list->project->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penempatan_list->project->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penempatan_list->jabatan->Visible) { // jabatan ?>
	<?php if ($penempatan_list->SortUrl($penempatan_list->jabatan) == "") { ?>
		<th data-name="jabatan" class="<?php echo $penempatan_list->jabatan->headerCellClass() ?>"><div id="elh_penempatan_jabatan" class="penempatan_jabatan"><div class="ew-table-header-caption"><?php echo $penempatan_list->jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan" class="<?php echo $penempatan_list->jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penempatan_list->SortUrl($penempatan_list->jabatan) ?>', 1);"><div id="elh_penempatan_jabatan" class="penempatan_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penempatan_list->jabatan->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($penempatan_list->jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penempatan_list->jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penempatan_list->tgl_mulai->Visible) { // tgl_mulai ?>
	<?php if ($penempatan_list->SortUrl($penempatan_list->tgl_mulai) == "") { ?>
		<th data-name="tgl_mulai" class="<?php echo $penempatan_list->tgl_mulai->headerCellClass() ?>"><div id="elh_penempatan_tgl_mulai" class="penempatan_tgl_mulai"><div class="ew-table-header-caption"><?php echo $penempatan_list->tgl_mulai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_mulai" class="<?php echo $penempatan_list->tgl_mulai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penempatan_list->SortUrl($penempatan_list->tgl_mulai) ?>', 1);"><div id="elh_penempatan_tgl_mulai" class="penempatan_tgl_mulai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penempatan_list->tgl_mulai->caption() ?></span><span class="ew-table-header-sort"><?php if ($penempatan_list->tgl_mulai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penempatan_list->tgl_mulai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($penempatan_list->tgl_akhir->Visible) { // tgl_akhir ?>
	<?php if ($penempatan_list->SortUrl($penempatan_list->tgl_akhir) == "") { ?>
		<th data-name="tgl_akhir" class="<?php echo $penempatan_list->tgl_akhir->headerCellClass() ?>"><div id="elh_penempatan_tgl_akhir" class="penempatan_tgl_akhir"><div class="ew-table-header-caption"><?php echo $penempatan_list->tgl_akhir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_akhir" class="<?php echo $penempatan_list->tgl_akhir->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $penempatan_list->SortUrl($penempatan_list->tgl_akhir) ?>', 1);"><div id="elh_penempatan_tgl_akhir" class="penempatan_tgl_akhir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $penempatan_list->tgl_akhir->caption() ?></span><span class="ew-table-header-sort"><?php if ($penempatan_list->tgl_akhir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($penempatan_list->tgl_akhir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$penempatan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($penempatan_list->ExportAll && $penempatan_list->isExport()) {
	$penempatan_list->StopRecord = $penempatan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($penempatan_list->TotalRecords > $penempatan_list->StartRecord + $penempatan_list->DisplayRecords - 1)
		$penempatan_list->StopRecord = $penempatan_list->StartRecord + $penempatan_list->DisplayRecords - 1;
	else
		$penempatan_list->StopRecord = $penempatan_list->TotalRecords;
}
$penempatan_list->RecordCount = $penempatan_list->StartRecord - 1;
if ($penempatan_list->Recordset && !$penempatan_list->Recordset->EOF) {
	$penempatan_list->Recordset->moveFirst();
	$selectLimit = $penempatan_list->UseSelectLimit;
	if (!$selectLimit && $penempatan_list->StartRecord > 1)
		$penempatan_list->Recordset->move($penempatan_list->StartRecord - 1);
} elseif (!$penempatan->AllowAddDeleteRow && $penempatan_list->StopRecord == 0) {
	$penempatan_list->StopRecord = $penempatan->GridAddRowCount;
}

// Initialize aggregate
$penempatan->RowType = ROWTYPE_AGGREGATEINIT;
$penempatan->resetAttributes();
$penempatan_list->renderRow();
while ($penempatan_list->RecordCount < $penempatan_list->StopRecord) {
	$penempatan_list->RecordCount++;
	if ($penempatan_list->RecordCount >= $penempatan_list->StartRecord) {
		$penempatan_list->RowCount++;

		// Set up key count
		$penempatan_list->KeyCount = $penempatan_list->RowIndex;

		// Init row class and style
		$penempatan->resetAttributes();
		$penempatan->CssClass = "";
		if ($penempatan_list->isGridAdd()) {
		} else {
			$penempatan_list->loadRowValues($penempatan_list->Recordset); // Load row values
		}
		$penempatan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$penempatan->RowAttrs->merge(["data-rowindex" => $penempatan_list->RowCount, "id" => "r" . $penempatan_list->RowCount . "_penempatan", "data-rowtype" => $penempatan->RowType]);

		// Render row
		$penempatan_list->renderRow();

		// Render list options
		$penempatan_list->renderListOptions();
?>
	<tr <?php echo $penempatan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$penempatan_list->ListOptions->render("body", "left", $penempatan_list->RowCount);
?>
	<?php if ($penempatan_list->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $penempatan_list->pegawai->cellAttributes() ?>>
<span id="el<?php echo $penempatan_list->RowCount ?>_penempatan_pegawai">
<span<?php echo $penempatan_list->pegawai->viewAttributes() ?>><?php echo $penempatan_list->pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penempatan_list->project->Visible) { // project ?>
		<td data-name="project" <?php echo $penempatan_list->project->cellAttributes() ?>>
<span id="el<?php echo $penempatan_list->RowCount ?>_penempatan_project">
<span<?php echo $penempatan_list->project->viewAttributes() ?>><?php echo $penempatan_list->project->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penempatan_list->jabatan->Visible) { // jabatan ?>
		<td data-name="jabatan" <?php echo $penempatan_list->jabatan->cellAttributes() ?>>
<span id="el<?php echo $penempatan_list->RowCount ?>_penempatan_jabatan">
<span<?php echo $penempatan_list->jabatan->viewAttributes() ?>><?php echo $penempatan_list->jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penempatan_list->tgl_mulai->Visible) { // tgl_mulai ?>
		<td data-name="tgl_mulai" <?php echo $penempatan_list->tgl_mulai->cellAttributes() ?>>
<span id="el<?php echo $penempatan_list->RowCount ?>_penempatan_tgl_mulai">
<span<?php echo $penempatan_list->tgl_mulai->viewAttributes() ?>><?php echo $penempatan_list->tgl_mulai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($penempatan_list->tgl_akhir->Visible) { // tgl_akhir ?>
		<td data-name="tgl_akhir" <?php echo $penempatan_list->tgl_akhir->cellAttributes() ?>>
<span id="el<?php echo $penempatan_list->RowCount ?>_penempatan_tgl_akhir">
<span<?php echo $penempatan_list->tgl_akhir->viewAttributes() ?>><?php echo $penempatan_list->tgl_akhir->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$penempatan_list->ListOptions->render("body", "right", $penempatan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$penempatan_list->isGridAdd())
		$penempatan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$penempatan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($penempatan_list->Recordset)
	$penempatan_list->Recordset->Close();
?>
<?php if (!$penempatan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$penempatan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $penempatan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $penempatan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($penempatan_list->TotalRecords == 0 && !$penempatan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $penempatan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$penempatan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$penempatan_list->isExport()) { ?>
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
$penempatan_list->terminate();
?>