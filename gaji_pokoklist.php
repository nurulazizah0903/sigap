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
$gaji_pokok_list = new gaji_pokok_list();

// Run the page
$gaji_pokok_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_pokok_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gaji_pokok_list->isExport()) { ?>
<script>
var fgaji_pokoklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgaji_pokoklist = currentForm = new ew.Form("fgaji_pokoklist", "list");
	fgaji_pokoklist.formKeyCountName = '<?php echo $gaji_pokok_list->FormKeyCountName ?>';
	loadjs.done("fgaji_pokoklist");
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
<?php if (!$gaji_pokok_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gaji_pokok_list->TotalRecords > 0 && $gaji_pokok_list->ExportOptions->visible()) { ?>
<?php $gaji_pokok_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gaji_pokok_list->ImportOptions->visible()) { ?>
<?php $gaji_pokok_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$gaji_pokok_list->renderOtherOptions();
?>
<?php $gaji_pokok_list->showPageHeader(); ?>
<?php
$gaji_pokok_list->showMessage();
?>
<?php if ($gaji_pokok_list->TotalRecords > 0 || $gaji_pokok->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gaji_pokok_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gaji_pokok">
<?php if (!$gaji_pokok_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gaji_pokok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gaji_pokok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gaji_pokok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgaji_pokoklist" id="fgaji_pokoklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gaji_pokok">
<div id="gmp_gaji_pokok" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gaji_pokok_list->TotalRecords > 0 || $gaji_pokok_list->isGridEdit()) { ?>
<table id="tbl_gaji_pokoklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gaji_pokok->RowType = ROWTYPE_HEADER;

// Render list options
$gaji_pokok_list->renderListOptions();

// Render list options (header, left)
$gaji_pokok_list->ListOptions->render("header", "left");
?>
<?php if ($gaji_pokok_list->jenjang_id->Visible) { // jenjang_id ?>
	<?php if ($gaji_pokok_list->SortUrl($gaji_pokok_list->jenjang_id) == "") { ?>
		<th data-name="jenjang_id" class="<?php echo $gaji_pokok_list->jenjang_id->headerCellClass() ?>"><div id="elh_gaji_pokok_jenjang_id" class="gaji_pokok_jenjang_id"><div class="ew-table-header-caption"><?php echo $gaji_pokok_list->jenjang_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang_id" class="<?php echo $gaji_pokok_list->jenjang_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_pokok_list->SortUrl($gaji_pokok_list->jenjang_id) ?>', 1);"><div id="elh_gaji_pokok_jenjang_id" class="gaji_pokok_jenjang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_pokok_list->jenjang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_pokok_list->jenjang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_pokok_list->jenjang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_pokok_list->lama_kerja->Visible) { // lama_kerja ?>
	<?php if ($gaji_pokok_list->SortUrl($gaji_pokok_list->lama_kerja) == "") { ?>
		<th data-name="lama_kerja" class="<?php echo $gaji_pokok_list->lama_kerja->headerCellClass() ?>"><div id="elh_gaji_pokok_lama_kerja" class="gaji_pokok_lama_kerja"><div class="ew-table-header-caption"><?php echo $gaji_pokok_list->lama_kerja->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lama_kerja" class="<?php echo $gaji_pokok_list->lama_kerja->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_pokok_list->SortUrl($gaji_pokok_list->lama_kerja) ?>', 1);"><div id="elh_gaji_pokok_lama_kerja" class="gaji_pokok_lama_kerja">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_pokok_list->lama_kerja->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_pokok_list->lama_kerja->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_pokok_list->lama_kerja->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_pokok_list->value->Visible) { // value ?>
	<?php if ($gaji_pokok_list->SortUrl($gaji_pokok_list->value) == "") { ?>
		<th data-name="value" class="<?php echo $gaji_pokok_list->value->headerCellClass() ?>"><div id="elh_gaji_pokok_value" class="gaji_pokok_value"><div class="ew-table-header-caption"><?php echo $gaji_pokok_list->value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value" class="<?php echo $gaji_pokok_list->value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_pokok_list->SortUrl($gaji_pokok_list->value) ?>', 1);"><div id="elh_gaji_pokok_value" class="gaji_pokok_value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_pokok_list->value->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_pokok_list->value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_pokok_list->value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gaji_pokok_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gaji_pokok_list->ExportAll && $gaji_pokok_list->isExport()) {
	$gaji_pokok_list->StopRecord = $gaji_pokok_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gaji_pokok_list->TotalRecords > $gaji_pokok_list->StartRecord + $gaji_pokok_list->DisplayRecords - 1)
		$gaji_pokok_list->StopRecord = $gaji_pokok_list->StartRecord + $gaji_pokok_list->DisplayRecords - 1;
	else
		$gaji_pokok_list->StopRecord = $gaji_pokok_list->TotalRecords;
}
$gaji_pokok_list->RecordCount = $gaji_pokok_list->StartRecord - 1;
if ($gaji_pokok_list->Recordset && !$gaji_pokok_list->Recordset->EOF) {
	$gaji_pokok_list->Recordset->moveFirst();
	$selectLimit = $gaji_pokok_list->UseSelectLimit;
	if (!$selectLimit && $gaji_pokok_list->StartRecord > 1)
		$gaji_pokok_list->Recordset->move($gaji_pokok_list->StartRecord - 1);
} elseif (!$gaji_pokok->AllowAddDeleteRow && $gaji_pokok_list->StopRecord == 0) {
	$gaji_pokok_list->StopRecord = $gaji_pokok->GridAddRowCount;
}

// Initialize aggregate
$gaji_pokok->RowType = ROWTYPE_AGGREGATEINIT;
$gaji_pokok->resetAttributes();
$gaji_pokok_list->renderRow();
while ($gaji_pokok_list->RecordCount < $gaji_pokok_list->StopRecord) {
	$gaji_pokok_list->RecordCount++;
	if ($gaji_pokok_list->RecordCount >= $gaji_pokok_list->StartRecord) {
		$gaji_pokok_list->RowCount++;

		// Set up key count
		$gaji_pokok_list->KeyCount = $gaji_pokok_list->RowIndex;

		// Init row class and style
		$gaji_pokok->resetAttributes();
		$gaji_pokok->CssClass = "";
		if ($gaji_pokok_list->isGridAdd()) {
		} else {
			$gaji_pokok_list->loadRowValues($gaji_pokok_list->Recordset); // Load row values
		}
		$gaji_pokok->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gaji_pokok->RowAttrs->merge(["data-rowindex" => $gaji_pokok_list->RowCount, "id" => "r" . $gaji_pokok_list->RowCount . "_gaji_pokok", "data-rowtype" => $gaji_pokok->RowType]);

		// Render row
		$gaji_pokok_list->renderRow();

		// Render list options
		$gaji_pokok_list->renderListOptions();
?>
	<tr <?php echo $gaji_pokok->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gaji_pokok_list->ListOptions->render("body", "left", $gaji_pokok_list->RowCount);
?>
	<?php if ($gaji_pokok_list->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id" <?php echo $gaji_pokok_list->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $gaji_pokok_list->RowCount ?>_gaji_pokok_jenjang_id">
<span<?php echo $gaji_pokok_list->jenjang_id->viewAttributes() ?>><?php echo $gaji_pokok_list->jenjang_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_pokok_list->lama_kerja->Visible) { // lama_kerja ?>
		<td data-name="lama_kerja" <?php echo $gaji_pokok_list->lama_kerja->cellAttributes() ?>>
<span id="el<?php echo $gaji_pokok_list->RowCount ?>_gaji_pokok_lama_kerja">
<span<?php echo $gaji_pokok_list->lama_kerja->viewAttributes() ?>><?php echo $gaji_pokok_list->lama_kerja->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_pokok_list->value->Visible) { // value ?>
		<td data-name="value" <?php echo $gaji_pokok_list->value->cellAttributes() ?>>
<span id="el<?php echo $gaji_pokok_list->RowCount ?>_gaji_pokok_value">
<span<?php echo $gaji_pokok_list->value->viewAttributes() ?>><?php echo $gaji_pokok_list->value->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gaji_pokok_list->ListOptions->render("body", "right", $gaji_pokok_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gaji_pokok_list->isGridAdd())
		$gaji_pokok_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gaji_pokok->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gaji_pokok_list->Recordset)
	$gaji_pokok_list->Recordset->Close();
?>
<?php if (!$gaji_pokok_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gaji_pokok_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gaji_pokok_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gaji_pokok_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gaji_pokok_list->TotalRecords == 0 && !$gaji_pokok->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gaji_pokok_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gaji_pokok_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gaji_pokok_list->isExport()) { ?>
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
$gaji_pokok_list->terminate();
?>