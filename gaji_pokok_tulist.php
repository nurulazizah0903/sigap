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
$gaji_pokok_tu_list = new gaji_pokok_tu_list();

// Run the page
$gaji_pokok_tu_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_pokok_tu_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gaji_pokok_tu_list->isExport()) { ?>
<script>
var fgaji_pokok_tulist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgaji_pokok_tulist = currentForm = new ew.Form("fgaji_pokok_tulist", "list");
	fgaji_pokok_tulist.formKeyCountName = '<?php echo $gaji_pokok_tu_list->FormKeyCountName ?>';
	loadjs.done("fgaji_pokok_tulist");
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
<?php if (!$gaji_pokok_tu_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gaji_pokok_tu_list->TotalRecords > 0 && $gaji_pokok_tu_list->ExportOptions->visible()) { ?>
<?php $gaji_pokok_tu_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gaji_pokok_tu_list->ImportOptions->visible()) { ?>
<?php $gaji_pokok_tu_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$gaji_pokok_tu_list->renderOtherOptions();
?>
<?php $gaji_pokok_tu_list->showPageHeader(); ?>
<?php
$gaji_pokok_tu_list->showMessage();
?>
<?php if ($gaji_pokok_tu_list->TotalRecords > 0 || $gaji_pokok_tu->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gaji_pokok_tu_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gaji_pokok_tu">
<?php if (!$gaji_pokok_tu_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gaji_pokok_tu_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gaji_pokok_tu_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gaji_pokok_tu_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgaji_pokok_tulist" id="fgaji_pokok_tulist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gaji_pokok_tu">
<div id="gmp_gaji_pokok_tu" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gaji_pokok_tu_list->TotalRecords > 0 || $gaji_pokok_tu_list->isGridEdit()) { ?>
<table id="tbl_gaji_pokok_tulist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gaji_pokok_tu->RowType = ROWTYPE_HEADER;

// Render list options
$gaji_pokok_tu_list->renderListOptions();

// Render list options (header, left)
$gaji_pokok_tu_list->ListOptions->render("header", "left");
?>
<?php if ($gaji_pokok_tu_list->jenjang_id->Visible) { // jenjang_id ?>
	<?php if ($gaji_pokok_tu_list->SortUrl($gaji_pokok_tu_list->jenjang_id) == "") { ?>
		<th data-name="jenjang_id" class="<?php echo $gaji_pokok_tu_list->jenjang_id->headerCellClass() ?>"><div id="elh_gaji_pokok_tu_jenjang_id" class="gaji_pokok_tu_jenjang_id"><div class="ew-table-header-caption"><?php echo $gaji_pokok_tu_list->jenjang_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang_id" class="<?php echo $gaji_pokok_tu_list->jenjang_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_pokok_tu_list->SortUrl($gaji_pokok_tu_list->jenjang_id) ?>', 1);"><div id="elh_gaji_pokok_tu_jenjang_id" class="gaji_pokok_tu_jenjang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_pokok_tu_list->jenjang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_pokok_tu_list->jenjang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_pokok_tu_list->jenjang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_pokok_tu_list->ijazah->Visible) { // ijazah ?>
	<?php if ($gaji_pokok_tu_list->SortUrl($gaji_pokok_tu_list->ijazah) == "") { ?>
		<th data-name="ijazah" class="<?php echo $gaji_pokok_tu_list->ijazah->headerCellClass() ?>"><div id="elh_gaji_pokok_tu_ijazah" class="gaji_pokok_tu_ijazah"><div class="ew-table-header-caption"><?php echo $gaji_pokok_tu_list->ijazah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ijazah" class="<?php echo $gaji_pokok_tu_list->ijazah->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_pokok_tu_list->SortUrl($gaji_pokok_tu_list->ijazah) ?>', 1);"><div id="elh_gaji_pokok_tu_ijazah" class="gaji_pokok_tu_ijazah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_pokok_tu_list->ijazah->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_pokok_tu_list->ijazah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_pokok_tu_list->ijazah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_pokok_tu_list->lama_kerja->Visible) { // lama_kerja ?>
	<?php if ($gaji_pokok_tu_list->SortUrl($gaji_pokok_tu_list->lama_kerja) == "") { ?>
		<th data-name="lama_kerja" class="<?php echo $gaji_pokok_tu_list->lama_kerja->headerCellClass() ?>"><div id="elh_gaji_pokok_tu_lama_kerja" class="gaji_pokok_tu_lama_kerja"><div class="ew-table-header-caption"><?php echo $gaji_pokok_tu_list->lama_kerja->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lama_kerja" class="<?php echo $gaji_pokok_tu_list->lama_kerja->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_pokok_tu_list->SortUrl($gaji_pokok_tu_list->lama_kerja) ?>', 1);"><div id="elh_gaji_pokok_tu_lama_kerja" class="gaji_pokok_tu_lama_kerja">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_pokok_tu_list->lama_kerja->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_pokok_tu_list->lama_kerja->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_pokok_tu_list->lama_kerja->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_pokok_tu_list->value->Visible) { // value ?>
	<?php if ($gaji_pokok_tu_list->SortUrl($gaji_pokok_tu_list->value) == "") { ?>
		<th data-name="value" class="<?php echo $gaji_pokok_tu_list->value->headerCellClass() ?>"><div id="elh_gaji_pokok_tu_value" class="gaji_pokok_tu_value"><div class="ew-table-header-caption"><?php echo $gaji_pokok_tu_list->value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value" class="<?php echo $gaji_pokok_tu_list->value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gaji_pokok_tu_list->SortUrl($gaji_pokok_tu_list->value) ?>', 1);"><div id="elh_gaji_pokok_tu_value" class="gaji_pokok_tu_value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_pokok_tu_list->value->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_pokok_tu_list->value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_pokok_tu_list->value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gaji_pokok_tu_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gaji_pokok_tu_list->ExportAll && $gaji_pokok_tu_list->isExport()) {
	$gaji_pokok_tu_list->StopRecord = $gaji_pokok_tu_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gaji_pokok_tu_list->TotalRecords > $gaji_pokok_tu_list->StartRecord + $gaji_pokok_tu_list->DisplayRecords - 1)
		$gaji_pokok_tu_list->StopRecord = $gaji_pokok_tu_list->StartRecord + $gaji_pokok_tu_list->DisplayRecords - 1;
	else
		$gaji_pokok_tu_list->StopRecord = $gaji_pokok_tu_list->TotalRecords;
}
$gaji_pokok_tu_list->RecordCount = $gaji_pokok_tu_list->StartRecord - 1;
if ($gaji_pokok_tu_list->Recordset && !$gaji_pokok_tu_list->Recordset->EOF) {
	$gaji_pokok_tu_list->Recordset->moveFirst();
	$selectLimit = $gaji_pokok_tu_list->UseSelectLimit;
	if (!$selectLimit && $gaji_pokok_tu_list->StartRecord > 1)
		$gaji_pokok_tu_list->Recordset->move($gaji_pokok_tu_list->StartRecord - 1);
} elseif (!$gaji_pokok_tu->AllowAddDeleteRow && $gaji_pokok_tu_list->StopRecord == 0) {
	$gaji_pokok_tu_list->StopRecord = $gaji_pokok_tu->GridAddRowCount;
}

// Initialize aggregate
$gaji_pokok_tu->RowType = ROWTYPE_AGGREGATEINIT;
$gaji_pokok_tu->resetAttributes();
$gaji_pokok_tu_list->renderRow();
while ($gaji_pokok_tu_list->RecordCount < $gaji_pokok_tu_list->StopRecord) {
	$gaji_pokok_tu_list->RecordCount++;
	if ($gaji_pokok_tu_list->RecordCount >= $gaji_pokok_tu_list->StartRecord) {
		$gaji_pokok_tu_list->RowCount++;

		// Set up key count
		$gaji_pokok_tu_list->KeyCount = $gaji_pokok_tu_list->RowIndex;

		// Init row class and style
		$gaji_pokok_tu->resetAttributes();
		$gaji_pokok_tu->CssClass = "";
		if ($gaji_pokok_tu_list->isGridAdd()) {
		} else {
			$gaji_pokok_tu_list->loadRowValues($gaji_pokok_tu_list->Recordset); // Load row values
		}
		$gaji_pokok_tu->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gaji_pokok_tu->RowAttrs->merge(["data-rowindex" => $gaji_pokok_tu_list->RowCount, "id" => "r" . $gaji_pokok_tu_list->RowCount . "_gaji_pokok_tu", "data-rowtype" => $gaji_pokok_tu->RowType]);

		// Render row
		$gaji_pokok_tu_list->renderRow();

		// Render list options
		$gaji_pokok_tu_list->renderListOptions();
?>
	<tr <?php echo $gaji_pokok_tu->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gaji_pokok_tu_list->ListOptions->render("body", "left", $gaji_pokok_tu_list->RowCount);
?>
	<?php if ($gaji_pokok_tu_list->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id" <?php echo $gaji_pokok_tu_list->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $gaji_pokok_tu_list->RowCount ?>_gaji_pokok_tu_jenjang_id">
<span<?php echo $gaji_pokok_tu_list->jenjang_id->viewAttributes() ?>><?php echo $gaji_pokok_tu_list->jenjang_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_pokok_tu_list->ijazah->Visible) { // ijazah ?>
		<td data-name="ijazah" <?php echo $gaji_pokok_tu_list->ijazah->cellAttributes() ?>>
<span id="el<?php echo $gaji_pokok_tu_list->RowCount ?>_gaji_pokok_tu_ijazah">
<span<?php echo $gaji_pokok_tu_list->ijazah->viewAttributes() ?>><?php echo $gaji_pokok_tu_list->ijazah->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_pokok_tu_list->lama_kerja->Visible) { // lama_kerja ?>
		<td data-name="lama_kerja" <?php echo $gaji_pokok_tu_list->lama_kerja->cellAttributes() ?>>
<span id="el<?php echo $gaji_pokok_tu_list->RowCount ?>_gaji_pokok_tu_lama_kerja">
<span<?php echo $gaji_pokok_tu_list->lama_kerja->viewAttributes() ?>><?php echo $gaji_pokok_tu_list->lama_kerja->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gaji_pokok_tu_list->value->Visible) { // value ?>
		<td data-name="value" <?php echo $gaji_pokok_tu_list->value->cellAttributes() ?>>
<span id="el<?php echo $gaji_pokok_tu_list->RowCount ?>_gaji_pokok_tu_value">
<span<?php echo $gaji_pokok_tu_list->value->viewAttributes() ?>><?php echo $gaji_pokok_tu_list->value->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gaji_pokok_tu_list->ListOptions->render("body", "right", $gaji_pokok_tu_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gaji_pokok_tu_list->isGridAdd())
		$gaji_pokok_tu_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gaji_pokok_tu->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gaji_pokok_tu_list->Recordset)
	$gaji_pokok_tu_list->Recordset->Close();
?>
<?php if (!$gaji_pokok_tu_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gaji_pokok_tu_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gaji_pokok_tu_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gaji_pokok_tu_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gaji_pokok_tu_list->TotalRecords == 0 && !$gaji_pokok_tu->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gaji_pokok_tu_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gaji_pokok_tu_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gaji_pokok_tu_list->isExport()) { ?>
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
$gaji_pokok_tu_list->terminate();
?>