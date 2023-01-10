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
$gajisma_list = new gajisma_list();

// Run the page
$gajisma_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajisma_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajisma_list->isExport()) { ?>
<script>
var fgajismalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgajismalist = currentForm = new ew.Form("fgajismalist", "list");
	fgajismalist.formKeyCountName = '<?php echo $gajisma_list->FormKeyCountName ?>';
	loadjs.done("fgajismalist");
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
<?php if (!$gajisma_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gajisma_list->TotalRecords > 0 && $gajisma_list->ExportOptions->visible()) { ?>
<?php $gajisma_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gajisma_list->ImportOptions->visible()) { ?>
<?php $gajisma_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$gajisma_list->renderOtherOptions();
?>
<?php $gajisma_list->showPageHeader(); ?>
<?php
$gajisma_list->showMessage();
?>
<?php if ($gajisma_list->TotalRecords > 0 || $gajisma->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gajisma_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajisma">
<?php if (!$gajisma_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gajisma_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajisma_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajisma_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgajismalist" id="fgajismalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajisma">
<div id="gmp_gajisma" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gajisma_list->TotalRecords > 0 || $gajisma_list->isGridEdit()) { ?>
<table id="tbl_gajismalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gajisma->RowType = ROWTYPE_HEADER;

// Render list options
$gajisma_list->renderListOptions();

// Render list options (header, left)
$gajisma_list->ListOptions->render("header", "left");
?>
<?php if ($gajisma_list->tahun->Visible) { // tahun ?>
	<?php if ($gajisma_list->SortUrl($gajisma_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $gajisma_list->tahun->headerCellClass() ?>"><div id="elh_gajisma_tahun" class="gajisma_tahun"><div class="ew-table-header-caption"><?php echo $gajisma_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $gajisma_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_list->SortUrl($gajisma_list->tahun) ?>', 1);"><div id="elh_gajisma_tahun" class="gajisma_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_list->bulan->Visible) { // bulan ?>
	<?php if ($gajisma_list->SortUrl($gajisma_list->bulan) == "") { ?>
		<th data-name="bulan" class="<?php echo $gajisma_list->bulan->headerCellClass() ?>"><div id="elh_gajisma_bulan" class="gajisma_bulan"><div class="ew-table-header-caption"><?php echo $gajisma_list->bulan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bulan" class="<?php echo $gajisma_list->bulan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_list->SortUrl($gajisma_list->bulan) ?>', 1);"><div id="elh_gajisma_bulan" class="gajisma_bulan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_list->bulan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_list->bulan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_list->bulan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_list->datetime->Visible) { // datetime ?>
	<?php if ($gajisma_list->SortUrl($gajisma_list->datetime) == "") { ?>
		<th data-name="datetime" class="<?php echo $gajisma_list->datetime->headerCellClass() ?>"><div id="elh_gajisma_datetime" class="gajisma_datetime"><div class="ew-table-header-caption"><?php echo $gajisma_list->datetime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="datetime" class="<?php echo $gajisma_list->datetime->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_list->SortUrl($gajisma_list->datetime) ?>', 1);"><div id="elh_gajisma_datetime" class="gajisma_datetime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_list->datetime->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_list->datetime->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_list->datetime->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_list->createby->Visible) { // createby ?>
	<?php if ($gajisma_list->SortUrl($gajisma_list->createby) == "") { ?>
		<th data-name="createby" class="<?php echo $gajisma_list->createby->headerCellClass() ?>"><div id="elh_gajisma_createby" class="gajisma_createby"><div class="ew-table-header-caption"><?php echo $gajisma_list->createby->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createby" class="<?php echo $gajisma_list->createby->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_list->SortUrl($gajisma_list->createby) ?>', 1);"><div id="elh_gajisma_createby" class="gajisma_createby">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_list->createby->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_list->createby->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_list->createby->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajisma_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gajisma_list->ExportAll && $gajisma_list->isExport()) {
	$gajisma_list->StopRecord = $gajisma_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gajisma_list->TotalRecords > $gajisma_list->StartRecord + $gajisma_list->DisplayRecords - 1)
		$gajisma_list->StopRecord = $gajisma_list->StartRecord + $gajisma_list->DisplayRecords - 1;
	else
		$gajisma_list->StopRecord = $gajisma_list->TotalRecords;
}
$gajisma_list->RecordCount = $gajisma_list->StartRecord - 1;
if ($gajisma_list->Recordset && !$gajisma_list->Recordset->EOF) {
	$gajisma_list->Recordset->moveFirst();
	$selectLimit = $gajisma_list->UseSelectLimit;
	if (!$selectLimit && $gajisma_list->StartRecord > 1)
		$gajisma_list->Recordset->move($gajisma_list->StartRecord - 1);
} elseif (!$gajisma->AllowAddDeleteRow && $gajisma_list->StopRecord == 0) {
	$gajisma_list->StopRecord = $gajisma->GridAddRowCount;
}

// Initialize aggregate
$gajisma->RowType = ROWTYPE_AGGREGATEINIT;
$gajisma->resetAttributes();
$gajisma_list->renderRow();
while ($gajisma_list->RecordCount < $gajisma_list->StopRecord) {
	$gajisma_list->RecordCount++;
	if ($gajisma_list->RecordCount >= $gajisma_list->StartRecord) {
		$gajisma_list->RowCount++;

		// Set up key count
		$gajisma_list->KeyCount = $gajisma_list->RowIndex;

		// Init row class and style
		$gajisma->resetAttributes();
		$gajisma->CssClass = "";
		if ($gajisma_list->isGridAdd()) {
		} else {
			$gajisma_list->loadRowValues($gajisma_list->Recordset); // Load row values
		}
		$gajisma->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gajisma->RowAttrs->merge(["data-rowindex" => $gajisma_list->RowCount, "id" => "r" . $gajisma_list->RowCount . "_gajisma", "data-rowtype" => $gajisma->RowType]);

		// Render row
		$gajisma_list->renderRow();

		// Render list options
		$gajisma_list->renderListOptions();
?>
	<tr <?php echo $gajisma->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajisma_list->ListOptions->render("body", "left", $gajisma_list->RowCount);
?>
	<?php if ($gajisma_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $gajisma_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $gajisma_list->RowCount ?>_gajisma_tahun">
<span<?php echo $gajisma_list->tahun->viewAttributes() ?>><?php echo $gajisma_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_list->bulan->Visible) { // bulan ?>
		<td data-name="bulan" <?php echo $gajisma_list->bulan->cellAttributes() ?>>
<span id="el<?php echo $gajisma_list->RowCount ?>_gajisma_bulan">
<span<?php echo $gajisma_list->bulan->viewAttributes() ?>><?php echo $gajisma_list->bulan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_list->datetime->Visible) { // datetime ?>
		<td data-name="datetime" <?php echo $gajisma_list->datetime->cellAttributes() ?>>
<span id="el<?php echo $gajisma_list->RowCount ?>_gajisma_datetime">
<span<?php echo $gajisma_list->datetime->viewAttributes() ?>><?php echo $gajisma_list->datetime->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_list->createby->Visible) { // createby ?>
		<td data-name="createby" <?php echo $gajisma_list->createby->cellAttributes() ?>>
<span id="el<?php echo $gajisma_list->RowCount ?>_gajisma_createby">
<span<?php echo $gajisma_list->createby->viewAttributes() ?>><?php echo $gajisma_list->createby->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajisma_list->ListOptions->render("body", "right", $gajisma_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gajisma_list->isGridAdd())
		$gajisma_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gajisma->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gajisma_list->Recordset)
	$gajisma_list->Recordset->Close();
?>
<?php if (!$gajisma_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gajisma_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajisma_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajisma_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gajisma_list->TotalRecords == 0 && !$gajisma->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gajisma_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gajisma_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajisma_list->isExport()) { ?>
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
$gajisma_list->terminate();
?>