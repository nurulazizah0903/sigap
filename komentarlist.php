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
$komentar_list = new komentar_list();

// Run the page
$komentar_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$komentar_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$komentar_list->isExport()) { ?>
<script>
var fkomentarlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fkomentarlist = currentForm = new ew.Form("fkomentarlist", "list");
	fkomentarlist.formKeyCountName = '<?php echo $komentar_list->FormKeyCountName ?>';
	loadjs.done("fkomentarlist");
});
var fkomentarlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fkomentarlistsrch = currentSearchForm = new ew.Form("fkomentarlistsrch");

	// Dynamic selection lists
	// Filters

	fkomentarlistsrch.filterList = <?php echo $komentar_list->getFilterList() ?>;
	loadjs.done("fkomentarlistsrch");
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
<?php if (!$komentar_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($komentar_list->TotalRecords > 0 && $komentar_list->ExportOptions->visible()) { ?>
<?php $komentar_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($komentar_list->ImportOptions->visible()) { ?>
<?php $komentar_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($komentar_list->SearchOptions->visible()) { ?>
<?php $komentar_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($komentar_list->FilterOptions->visible()) { ?>
<?php $komentar_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$komentar_list->isExport() || Config("EXPORT_MASTER_RECORD") && $komentar_list->isExport("print")) { ?>
<?php
if ($komentar_list->DbMasterFilter != "" && $komentar->getCurrentMasterTable() == "berita") {
	if ($komentar_list->MasterRecordExists) {
		include_once "beritamaster.php";
	}
}
?>
<?php } ?>
<?php
$komentar_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$komentar_list->isExport() && !$komentar->CurrentAction) { ?>
<form name="fkomentarlistsrch" id="fkomentarlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fkomentarlistsrch-search-panel" class="<?php echo $komentar_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="komentar">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $komentar_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($komentar_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($komentar_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $komentar_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($komentar_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($komentar_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($komentar_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($komentar_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $komentar_list->showPageHeader(); ?>
<?php
$komentar_list->showMessage();
?>
<?php if ($komentar_list->TotalRecords > 0 || $komentar->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($komentar_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> komentar">
<?php if (!$komentar_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$komentar_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $komentar_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $komentar_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fkomentarlist" id="fkomentarlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="komentar">
<?php if ($komentar->getCurrentMasterTable() == "berita" && $komentar->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="berita">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($komentar_list->pid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_komentar" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($komentar_list->TotalRecords > 0 || $komentar_list->isGridEdit()) { ?>
<table id="tbl_komentarlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$komentar->RowType = ROWTYPE_HEADER;

// Render list options
$komentar_list->renderListOptions();

// Render list options (header, left)
$komentar_list->ListOptions->render("header", "left");
?>
<?php if ($komentar_list->id->Visible) { // id ?>
	<?php if ($komentar_list->SortUrl($komentar_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $komentar_list->id->headerCellClass() ?>"><div id="elh_komentar_id" class="komentar_id"><div class="ew-table-header-caption"><?php echo $komentar_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $komentar_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $komentar_list->SortUrl($komentar_list->id) ?>', 1);"><div id="elh_komentar_id" class="komentar_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($komentar_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($komentar_list->pid->Visible) { // pid ?>
	<?php if ($komentar_list->SortUrl($komentar_list->pid) == "") { ?>
		<th data-name="pid" class="<?php echo $komentar_list->pid->headerCellClass() ?>"><div id="elh_komentar_pid" class="komentar_pid"><div class="ew-table-header-caption"><?php echo $komentar_list->pid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid" class="<?php echo $komentar_list->pid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $komentar_list->SortUrl($komentar_list->pid) ?>', 1);"><div id="elh_komentar_pid" class="komentar_pid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_list->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($komentar_list->pid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_list->pid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($komentar_list->gambar->Visible) { // gambar ?>
	<?php if ($komentar_list->SortUrl($komentar_list->gambar) == "") { ?>
		<th data-name="gambar" class="<?php echo $komentar_list->gambar->headerCellClass() ?>"><div id="elh_komentar_gambar" class="komentar_gambar"><div class="ew-table-header-caption"><?php echo $komentar_list->gambar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gambar" class="<?php echo $komentar_list->gambar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $komentar_list->SortUrl($komentar_list->gambar) ?>', 1);"><div id="elh_komentar_gambar" class="komentar_gambar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_list->gambar->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($komentar_list->gambar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_list->gambar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($komentar_list->video->Visible) { // video ?>
	<?php if ($komentar_list->SortUrl($komentar_list->video) == "") { ?>
		<th data-name="video" class="<?php echo $komentar_list->video->headerCellClass() ?>"><div id="elh_komentar_video" class="komentar_video"><div class="ew-table-header-caption"><?php echo $komentar_list->video->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="video" class="<?php echo $komentar_list->video->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $komentar_list->SortUrl($komentar_list->video) ?>', 1);"><div id="elh_komentar_video" class="komentar_video">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_list->video->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($komentar_list->video->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_list->video->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($komentar_list->pegawai->Visible) { // pegawai ?>
	<?php if ($komentar_list->SortUrl($komentar_list->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $komentar_list->pegawai->headerCellClass() ?>"><div id="elh_komentar_pegawai" class="komentar_pegawai"><div class="ew-table-header-caption"><?php echo $komentar_list->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $komentar_list->pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $komentar_list->SortUrl($komentar_list->pegawai) ?>', 1);"><div id="elh_komentar_pegawai" class="komentar_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_list->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($komentar_list->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_list->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$komentar_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($komentar_list->ExportAll && $komentar_list->isExport()) {
	$komentar_list->StopRecord = $komentar_list->TotalRecords;
} else {

	// Set the last record to display
	if ($komentar_list->TotalRecords > $komentar_list->StartRecord + $komentar_list->DisplayRecords - 1)
		$komentar_list->StopRecord = $komentar_list->StartRecord + $komentar_list->DisplayRecords - 1;
	else
		$komentar_list->StopRecord = $komentar_list->TotalRecords;
}
$komentar_list->RecordCount = $komentar_list->StartRecord - 1;
if ($komentar_list->Recordset && !$komentar_list->Recordset->EOF) {
	$komentar_list->Recordset->moveFirst();
	$selectLimit = $komentar_list->UseSelectLimit;
	if (!$selectLimit && $komentar_list->StartRecord > 1)
		$komentar_list->Recordset->move($komentar_list->StartRecord - 1);
} elseif (!$komentar->AllowAddDeleteRow && $komentar_list->StopRecord == 0) {
	$komentar_list->StopRecord = $komentar->GridAddRowCount;
}

// Initialize aggregate
$komentar->RowType = ROWTYPE_AGGREGATEINIT;
$komentar->resetAttributes();
$komentar_list->renderRow();
while ($komentar_list->RecordCount < $komentar_list->StopRecord) {
	$komentar_list->RecordCount++;
	if ($komentar_list->RecordCount >= $komentar_list->StartRecord) {
		$komentar_list->RowCount++;

		// Set up key count
		$komentar_list->KeyCount = $komentar_list->RowIndex;

		// Init row class and style
		$komentar->resetAttributes();
		$komentar->CssClass = "";
		if ($komentar_list->isGridAdd()) {
		} else {
			$komentar_list->loadRowValues($komentar_list->Recordset); // Load row values
		}
		$komentar->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$komentar->RowAttrs->merge(["data-rowindex" => $komentar_list->RowCount, "id" => "r" . $komentar_list->RowCount . "_komentar", "data-rowtype" => $komentar->RowType]);

		// Render row
		$komentar_list->renderRow();

		// Render list options
		$komentar_list->renderListOptions();
?>
	<tr <?php echo $komentar->rowAttributes() ?>>
<?php

// Render list options (body, left)
$komentar_list->ListOptions->render("body", "left", $komentar_list->RowCount);
?>
	<?php if ($komentar_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $komentar_list->id->cellAttributes() ?>>
<span id="el<?php echo $komentar_list->RowCount ?>_komentar_id">
<span<?php echo $komentar_list->id->viewAttributes() ?>><?php echo $komentar_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($komentar_list->pid->Visible) { // pid ?>
		<td data-name="pid" <?php echo $komentar_list->pid->cellAttributes() ?>>
<span id="el<?php echo $komentar_list->RowCount ?>_komentar_pid">
<span<?php echo $komentar_list->pid->viewAttributes() ?>><?php echo $komentar_list->pid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($komentar_list->gambar->Visible) { // gambar ?>
		<td data-name="gambar" <?php echo $komentar_list->gambar->cellAttributes() ?>>
<span id="el<?php echo $komentar_list->RowCount ?>_komentar_gambar">
<span<?php echo $komentar_list->gambar->viewAttributes() ?>><?php echo $komentar_list->gambar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($komentar_list->video->Visible) { // video ?>
		<td data-name="video" <?php echo $komentar_list->video->cellAttributes() ?>>
<span id="el<?php echo $komentar_list->RowCount ?>_komentar_video">
<span<?php echo $komentar_list->video->viewAttributes() ?>><?php echo $komentar_list->video->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($komentar_list->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $komentar_list->pegawai->cellAttributes() ?>>
<span id="el<?php echo $komentar_list->RowCount ?>_komentar_pegawai">
<span<?php echo $komentar_list->pegawai->viewAttributes() ?>><?php echo $komentar_list->pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$komentar_list->ListOptions->render("body", "right", $komentar_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$komentar_list->isGridAdd())
		$komentar_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$komentar->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($komentar_list->Recordset)
	$komentar_list->Recordset->Close();
?>
<?php if (!$komentar_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$komentar_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $komentar_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $komentar_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($komentar_list->TotalRecords == 0 && !$komentar->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $komentar_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$komentar_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$komentar_list->isExport()) { ?>
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
$komentar_list->terminate();
?>