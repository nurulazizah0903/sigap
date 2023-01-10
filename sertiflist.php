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
$sertif_list = new sertif_list();

// Run the page
$sertif_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$sertif_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$sertif_list->isExport()) { ?>
<script>
var fsertiflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fsertiflist = currentForm = new ew.Form("fsertiflist", "list");
	fsertiflist.formKeyCountName = '<?php echo $sertif_list->FormKeyCountName ?>';
	loadjs.done("fsertiflist");
});
var fsertiflistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fsertiflistsrch = currentSearchForm = new ew.Form("fsertiflistsrch");

	// Dynamic selection lists
	// Filters

	fsertiflistsrch.filterList = <?php echo $sertif_list->getFilterList() ?>;
	loadjs.done("fsertiflistsrch");
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
<?php if (!$sertif_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($sertif_list->TotalRecords > 0 && $sertif_list->ExportOptions->visible()) { ?>
<?php $sertif_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($sertif_list->ImportOptions->visible()) { ?>
<?php $sertif_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($sertif_list->SearchOptions->visible()) { ?>
<?php $sertif_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($sertif_list->FilterOptions->visible()) { ?>
<?php $sertif_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$sertif_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$sertif_list->isExport() && !$sertif->CurrentAction) { ?>
<form name="fsertiflistsrch" id="fsertiflistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fsertiflistsrch-search-panel" class="<?php echo $sertif_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="sertif">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $sertif_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($sertif_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($sertif_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $sertif_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($sertif_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($sertif_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($sertif_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($sertif_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $sertif_list->showPageHeader(); ?>
<?php
$sertif_list->showMessage();
?>
<?php if ($sertif_list->TotalRecords > 0 || $sertif->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($sertif_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> sertif">
<?php if (!$sertif_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$sertif_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sertif_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sertif_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fsertiflist" id="fsertiflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="sertif">
<div id="gmp_sertif" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($sertif_list->TotalRecords > 0 || $sertif_list->isGridEdit()) { ?>
<table id="tbl_sertiflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$sertif->RowType = ROWTYPE_HEADER;

// Render list options
$sertif_list->renderListOptions();

// Render list options (header, left)
$sertif_list->ListOptions->render("header", "left");
?>
<?php if ($sertif_list->name->Visible) { // name ?>
	<?php if ($sertif_list->SortUrl($sertif_list->name) == "") { ?>
		<th data-name="name" class="<?php echo $sertif_list->name->headerCellClass() ?>"><div id="elh_sertif_name" class="sertif_name"><div class="ew-table-header-caption"><?php echo $sertif_list->name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $sertif_list->name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $sertif_list->SortUrl($sertif_list->name) ?>', 1);"><div id="elh_sertif_name" class="sertif_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $sertif_list->name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($sertif_list->name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($sertif_list->name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$sertif_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($sertif_list->ExportAll && $sertif_list->isExport()) {
	$sertif_list->StopRecord = $sertif_list->TotalRecords;
} else {

	// Set the last record to display
	if ($sertif_list->TotalRecords > $sertif_list->StartRecord + $sertif_list->DisplayRecords - 1)
		$sertif_list->StopRecord = $sertif_list->StartRecord + $sertif_list->DisplayRecords - 1;
	else
		$sertif_list->StopRecord = $sertif_list->TotalRecords;
}
$sertif_list->RecordCount = $sertif_list->StartRecord - 1;
if ($sertif_list->Recordset && !$sertif_list->Recordset->EOF) {
	$sertif_list->Recordset->moveFirst();
	$selectLimit = $sertif_list->UseSelectLimit;
	if (!$selectLimit && $sertif_list->StartRecord > 1)
		$sertif_list->Recordset->move($sertif_list->StartRecord - 1);
} elseif (!$sertif->AllowAddDeleteRow && $sertif_list->StopRecord == 0) {
	$sertif_list->StopRecord = $sertif->GridAddRowCount;
}

// Initialize aggregate
$sertif->RowType = ROWTYPE_AGGREGATEINIT;
$sertif->resetAttributes();
$sertif_list->renderRow();
while ($sertif_list->RecordCount < $sertif_list->StopRecord) {
	$sertif_list->RecordCount++;
	if ($sertif_list->RecordCount >= $sertif_list->StartRecord) {
		$sertif_list->RowCount++;

		// Set up key count
		$sertif_list->KeyCount = $sertif_list->RowIndex;

		// Init row class and style
		$sertif->resetAttributes();
		$sertif->CssClass = "";
		if ($sertif_list->isGridAdd()) {
		} else {
			$sertif_list->loadRowValues($sertif_list->Recordset); // Load row values
		}
		$sertif->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$sertif->RowAttrs->merge(["data-rowindex" => $sertif_list->RowCount, "id" => "r" . $sertif_list->RowCount . "_sertif", "data-rowtype" => $sertif->RowType]);

		// Render row
		$sertif_list->renderRow();

		// Render list options
		$sertif_list->renderListOptions();
?>
	<tr <?php echo $sertif->rowAttributes() ?>>
<?php

// Render list options (body, left)
$sertif_list->ListOptions->render("body", "left", $sertif_list->RowCount);
?>
	<?php if ($sertif_list->name->Visible) { // name ?>
		<td data-name="name" <?php echo $sertif_list->name->cellAttributes() ?>>
<span id="el<?php echo $sertif_list->RowCount ?>_sertif_name">
<span<?php echo $sertif_list->name->viewAttributes() ?>><?php echo $sertif_list->name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$sertif_list->ListOptions->render("body", "right", $sertif_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$sertif_list->isGridAdd())
		$sertif_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$sertif->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($sertif_list->Recordset)
	$sertif_list->Recordset->Close();
?>
<?php if (!$sertif_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$sertif_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $sertif_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $sertif_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($sertif_list->TotalRecords == 0 && !$sertif->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $sertif_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$sertif_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$sertif_list->isExport()) { ?>
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
$sertif_list->terminate();
?>