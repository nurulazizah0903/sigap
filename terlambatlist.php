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
$terlambat_list = new terlambat_list();

// Run the page
$terlambat_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$terlambat_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$terlambat_list->isExport()) { ?>
<script>
var fterlambatlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fterlambatlist = currentForm = new ew.Form("fterlambatlist", "list");
	fterlambatlist.formKeyCountName = '<?php echo $terlambat_list->FormKeyCountName ?>';
	loadjs.done("fterlambatlist");
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
<?php if (!$terlambat_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($terlambat_list->TotalRecords > 0 && $terlambat_list->ExportOptions->visible()) { ?>
<?php $terlambat_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($terlambat_list->ImportOptions->visible()) { ?>
<?php $terlambat_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$terlambat_list->renderOtherOptions();
?>
<?php $terlambat_list->showPageHeader(); ?>
<?php
$terlambat_list->showMessage();
?>
<?php if ($terlambat_list->TotalRecords > 0 || $terlambat->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($terlambat_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> terlambat">
<?php if (!$terlambat_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$terlambat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $terlambat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $terlambat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fterlambatlist" id="fterlambatlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="terlambat">
<div id="gmp_terlambat" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($terlambat_list->TotalRecords > 0 || $terlambat_list->isGridEdit()) { ?>
<table id="tbl_terlambatlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$terlambat->RowType = ROWTYPE_HEADER;

// Render list options
$terlambat_list->renderListOptions();

// Render list options (header, left)
$terlambat_list->ListOptions->render("header", "left");
?>
<?php if ($terlambat_list->jenjang_id->Visible) { // jenjang_id ?>
	<?php if ($terlambat_list->SortUrl($terlambat_list->jenjang_id) == "") { ?>
		<th data-name="jenjang_id" class="<?php echo $terlambat_list->jenjang_id->headerCellClass() ?>"><div id="elh_terlambat_jenjang_id" class="terlambat_jenjang_id"><div class="ew-table-header-caption"><?php echo $terlambat_list->jenjang_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang_id" class="<?php echo $terlambat_list->jenjang_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terlambat_list->SortUrl($terlambat_list->jenjang_id) ?>', 1);"><div id="elh_terlambat_jenjang_id" class="terlambat_jenjang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terlambat_list->jenjang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($terlambat_list->jenjang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terlambat_list->jenjang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terlambat_list->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($terlambat_list->SortUrl($terlambat_list->jabatan_id) == "") { ?>
		<th data-name="jabatan_id" class="<?php echo $terlambat_list->jabatan_id->headerCellClass() ?>"><div id="elh_terlambat_jabatan_id" class="terlambat_jabatan_id"><div class="ew-table-header-caption"><?php echo $terlambat_list->jabatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan_id" class="<?php echo $terlambat_list->jabatan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terlambat_list->SortUrl($terlambat_list->jabatan_id) ?>', 1);"><div id="elh_terlambat_jabatan_id" class="terlambat_jabatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terlambat_list->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($terlambat_list->jabatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terlambat_list->jabatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($terlambat_list->value->Visible) { // value ?>
	<?php if ($terlambat_list->SortUrl($terlambat_list->value) == "") { ?>
		<th data-name="value" class="<?php echo $terlambat_list->value->headerCellClass() ?>"><div id="elh_terlambat_value" class="terlambat_value"><div class="ew-table-header-caption"><?php echo $terlambat_list->value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value" class="<?php echo $terlambat_list->value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $terlambat_list->SortUrl($terlambat_list->value) ?>', 1);"><div id="elh_terlambat_value" class="terlambat_value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $terlambat_list->value->caption() ?></span><span class="ew-table-header-sort"><?php if ($terlambat_list->value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($terlambat_list->value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$terlambat_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($terlambat_list->ExportAll && $terlambat_list->isExport()) {
	$terlambat_list->StopRecord = $terlambat_list->TotalRecords;
} else {

	// Set the last record to display
	if ($terlambat_list->TotalRecords > $terlambat_list->StartRecord + $terlambat_list->DisplayRecords - 1)
		$terlambat_list->StopRecord = $terlambat_list->StartRecord + $terlambat_list->DisplayRecords - 1;
	else
		$terlambat_list->StopRecord = $terlambat_list->TotalRecords;
}
$terlambat_list->RecordCount = $terlambat_list->StartRecord - 1;
if ($terlambat_list->Recordset && !$terlambat_list->Recordset->EOF) {
	$terlambat_list->Recordset->moveFirst();
	$selectLimit = $terlambat_list->UseSelectLimit;
	if (!$selectLimit && $terlambat_list->StartRecord > 1)
		$terlambat_list->Recordset->move($terlambat_list->StartRecord - 1);
} elseif (!$terlambat->AllowAddDeleteRow && $terlambat_list->StopRecord == 0) {
	$terlambat_list->StopRecord = $terlambat->GridAddRowCount;
}

// Initialize aggregate
$terlambat->RowType = ROWTYPE_AGGREGATEINIT;
$terlambat->resetAttributes();
$terlambat_list->renderRow();
while ($terlambat_list->RecordCount < $terlambat_list->StopRecord) {
	$terlambat_list->RecordCount++;
	if ($terlambat_list->RecordCount >= $terlambat_list->StartRecord) {
		$terlambat_list->RowCount++;

		// Set up key count
		$terlambat_list->KeyCount = $terlambat_list->RowIndex;

		// Init row class and style
		$terlambat->resetAttributes();
		$terlambat->CssClass = "";
		if ($terlambat_list->isGridAdd()) {
		} else {
			$terlambat_list->loadRowValues($terlambat_list->Recordset); // Load row values
		}
		$terlambat->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$terlambat->RowAttrs->merge(["data-rowindex" => $terlambat_list->RowCount, "id" => "r" . $terlambat_list->RowCount . "_terlambat", "data-rowtype" => $terlambat->RowType]);

		// Render row
		$terlambat_list->renderRow();

		// Render list options
		$terlambat_list->renderListOptions();
?>
	<tr <?php echo $terlambat->rowAttributes() ?>>
<?php

// Render list options (body, left)
$terlambat_list->ListOptions->render("body", "left", $terlambat_list->RowCount);
?>
	<?php if ($terlambat_list->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id" <?php echo $terlambat_list->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $terlambat_list->RowCount ?>_terlambat_jenjang_id">
<span<?php echo $terlambat_list->jenjang_id->viewAttributes() ?>><?php echo $terlambat_list->jenjang_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terlambat_list->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id" <?php echo $terlambat_list->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $terlambat_list->RowCount ?>_terlambat_jabatan_id">
<span<?php echo $terlambat_list->jabatan_id->viewAttributes() ?>><?php echo $terlambat_list->jabatan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($terlambat_list->value->Visible) { // value ?>
		<td data-name="value" <?php echo $terlambat_list->value->cellAttributes() ?>>
<span id="el<?php echo $terlambat_list->RowCount ?>_terlambat_value">
<span<?php echo $terlambat_list->value->viewAttributes() ?>><?php echo $terlambat_list->value->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$terlambat_list->ListOptions->render("body", "right", $terlambat_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$terlambat_list->isGridAdd())
		$terlambat_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$terlambat->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($terlambat_list->Recordset)
	$terlambat_list->Recordset->Close();
?>
<?php if (!$terlambat_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$terlambat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $terlambat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $terlambat_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($terlambat_list->TotalRecords == 0 && !$terlambat->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $terlambat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$terlambat_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$terlambat_list->isExport()) { ?>
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
$terlambat_list->terminate();
?>