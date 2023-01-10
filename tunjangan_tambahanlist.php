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
$tunjangan_tambahan_list = new tunjangan_tambahan_list();

// Run the page
$tunjangan_tambahan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tunjangan_tambahan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tunjangan_tambahan_list->isExport()) { ?>
<script>
var ftunjangan_tambahanlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftunjangan_tambahanlist = currentForm = new ew.Form("ftunjangan_tambahanlist", "list");
	ftunjangan_tambahanlist.formKeyCountName = '<?php echo $tunjangan_tambahan_list->FormKeyCountName ?>';
	loadjs.done("ftunjangan_tambahanlist");
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
<?php if (!$tunjangan_tambahan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tunjangan_tambahan_list->TotalRecords > 0 && $tunjangan_tambahan_list->ExportOptions->visible()) { ?>
<?php $tunjangan_tambahan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tunjangan_tambahan_list->ImportOptions->visible()) { ?>
<?php $tunjangan_tambahan_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tunjangan_tambahan_list->renderOtherOptions();
?>
<?php $tunjangan_tambahan_list->showPageHeader(); ?>
<?php
$tunjangan_tambahan_list->showMessage();
?>
<?php if ($tunjangan_tambahan_list->TotalRecords > 0 || $tunjangan_tambahan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tunjangan_tambahan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tunjangan_tambahan">
<?php if (!$tunjangan_tambahan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tunjangan_tambahan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tunjangan_tambahan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tunjangan_tambahan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftunjangan_tambahanlist" id="ftunjangan_tambahanlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tunjangan_tambahan">
<div id="gmp_tunjangan_tambahan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tunjangan_tambahan_list->TotalRecords > 0 || $tunjangan_tambahan_list->isGridEdit()) { ?>
<table id="tbl_tunjangan_tambahanlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tunjangan_tambahan->RowType = ROWTYPE_HEADER;

// Render list options
$tunjangan_tambahan_list->renderListOptions();

// Render list options (header, left)
$tunjangan_tambahan_list->ListOptions->render("header", "left");
?>
<?php if ($tunjangan_tambahan_list->jenjang->Visible) { // jenjang ?>
	<?php if ($tunjangan_tambahan_list->SortUrl($tunjangan_tambahan_list->jenjang) == "") { ?>
		<th data-name="jenjang" class="<?php echo $tunjangan_tambahan_list->jenjang->headerCellClass() ?>"><div id="elh_tunjangan_tambahan_jenjang" class="tunjangan_tambahan_jenjang"><div class="ew-table-header-caption"><?php echo $tunjangan_tambahan_list->jenjang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang" class="<?php echo $tunjangan_tambahan_list->jenjang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tunjangan_tambahan_list->SortUrl($tunjangan_tambahan_list->jenjang) ?>', 1);"><div id="elh_tunjangan_tambahan_jenjang" class="tunjangan_tambahan_jenjang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tunjangan_tambahan_list->jenjang->caption() ?></span><span class="ew-table-header-sort"><?php if ($tunjangan_tambahan_list->jenjang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tunjangan_tambahan_list->jenjang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tunjangan_tambahan_list->kualifikasi->Visible) { // kualifikasi ?>
	<?php if ($tunjangan_tambahan_list->SortUrl($tunjangan_tambahan_list->kualifikasi) == "") { ?>
		<th data-name="kualifikasi" class="<?php echo $tunjangan_tambahan_list->kualifikasi->headerCellClass() ?>"><div id="elh_tunjangan_tambahan_kualifikasi" class="tunjangan_tambahan_kualifikasi"><div class="ew-table-header-caption"><?php echo $tunjangan_tambahan_list->kualifikasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kualifikasi" class="<?php echo $tunjangan_tambahan_list->kualifikasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tunjangan_tambahan_list->SortUrl($tunjangan_tambahan_list->kualifikasi) ?>', 1);"><div id="elh_tunjangan_tambahan_kualifikasi" class="tunjangan_tambahan_kualifikasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tunjangan_tambahan_list->kualifikasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($tunjangan_tambahan_list->kualifikasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tunjangan_tambahan_list->kualifikasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tunjangan_tambahan_list->value->Visible) { // value ?>
	<?php if ($tunjangan_tambahan_list->SortUrl($tunjangan_tambahan_list->value) == "") { ?>
		<th data-name="value" class="<?php echo $tunjangan_tambahan_list->value->headerCellClass() ?>"><div id="elh_tunjangan_tambahan_value" class="tunjangan_tambahan_value"><div class="ew-table-header-caption"><?php echo $tunjangan_tambahan_list->value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value" class="<?php echo $tunjangan_tambahan_list->value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tunjangan_tambahan_list->SortUrl($tunjangan_tambahan_list->value) ?>', 1);"><div id="elh_tunjangan_tambahan_value" class="tunjangan_tambahan_value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tunjangan_tambahan_list->value->caption() ?></span><span class="ew-table-header-sort"><?php if ($tunjangan_tambahan_list->value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tunjangan_tambahan_list->value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tunjangan_tambahan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tunjangan_tambahan_list->ExportAll && $tunjangan_tambahan_list->isExport()) {
	$tunjangan_tambahan_list->StopRecord = $tunjangan_tambahan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tunjangan_tambahan_list->TotalRecords > $tunjangan_tambahan_list->StartRecord + $tunjangan_tambahan_list->DisplayRecords - 1)
		$tunjangan_tambahan_list->StopRecord = $tunjangan_tambahan_list->StartRecord + $tunjangan_tambahan_list->DisplayRecords - 1;
	else
		$tunjangan_tambahan_list->StopRecord = $tunjangan_tambahan_list->TotalRecords;
}
$tunjangan_tambahan_list->RecordCount = $tunjangan_tambahan_list->StartRecord - 1;
if ($tunjangan_tambahan_list->Recordset && !$tunjangan_tambahan_list->Recordset->EOF) {
	$tunjangan_tambahan_list->Recordset->moveFirst();
	$selectLimit = $tunjangan_tambahan_list->UseSelectLimit;
	if (!$selectLimit && $tunjangan_tambahan_list->StartRecord > 1)
		$tunjangan_tambahan_list->Recordset->move($tunjangan_tambahan_list->StartRecord - 1);
} elseif (!$tunjangan_tambahan->AllowAddDeleteRow && $tunjangan_tambahan_list->StopRecord == 0) {
	$tunjangan_tambahan_list->StopRecord = $tunjangan_tambahan->GridAddRowCount;
}

// Initialize aggregate
$tunjangan_tambahan->RowType = ROWTYPE_AGGREGATEINIT;
$tunjangan_tambahan->resetAttributes();
$tunjangan_tambahan_list->renderRow();
while ($tunjangan_tambahan_list->RecordCount < $tunjangan_tambahan_list->StopRecord) {
	$tunjangan_tambahan_list->RecordCount++;
	if ($tunjangan_tambahan_list->RecordCount >= $tunjangan_tambahan_list->StartRecord) {
		$tunjangan_tambahan_list->RowCount++;

		// Set up key count
		$tunjangan_tambahan_list->KeyCount = $tunjangan_tambahan_list->RowIndex;

		// Init row class and style
		$tunjangan_tambahan->resetAttributes();
		$tunjangan_tambahan->CssClass = "";
		if ($tunjangan_tambahan_list->isGridAdd()) {
		} else {
			$tunjangan_tambahan_list->loadRowValues($tunjangan_tambahan_list->Recordset); // Load row values
		}
		$tunjangan_tambahan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tunjangan_tambahan->RowAttrs->merge(["data-rowindex" => $tunjangan_tambahan_list->RowCount, "id" => "r" . $tunjangan_tambahan_list->RowCount . "_tunjangan_tambahan", "data-rowtype" => $tunjangan_tambahan->RowType]);

		// Render row
		$tunjangan_tambahan_list->renderRow();

		// Render list options
		$tunjangan_tambahan_list->renderListOptions();
?>
	<tr <?php echo $tunjangan_tambahan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tunjangan_tambahan_list->ListOptions->render("body", "left", $tunjangan_tambahan_list->RowCount);
?>
	<?php if ($tunjangan_tambahan_list->jenjang->Visible) { // jenjang ?>
		<td data-name="jenjang" <?php echo $tunjangan_tambahan_list->jenjang->cellAttributes() ?>>
<span id="el<?php echo $tunjangan_tambahan_list->RowCount ?>_tunjangan_tambahan_jenjang">
<span<?php echo $tunjangan_tambahan_list->jenjang->viewAttributes() ?>><?php echo $tunjangan_tambahan_list->jenjang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tunjangan_tambahan_list->kualifikasi->Visible) { // kualifikasi ?>
		<td data-name="kualifikasi" <?php echo $tunjangan_tambahan_list->kualifikasi->cellAttributes() ?>>
<span id="el<?php echo $tunjangan_tambahan_list->RowCount ?>_tunjangan_tambahan_kualifikasi">
<span<?php echo $tunjangan_tambahan_list->kualifikasi->viewAttributes() ?>><?php echo $tunjangan_tambahan_list->kualifikasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tunjangan_tambahan_list->value->Visible) { // value ?>
		<td data-name="value" <?php echo $tunjangan_tambahan_list->value->cellAttributes() ?>>
<span id="el<?php echo $tunjangan_tambahan_list->RowCount ?>_tunjangan_tambahan_value">
<span<?php echo $tunjangan_tambahan_list->value->viewAttributes() ?>><?php echo $tunjangan_tambahan_list->value->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tunjangan_tambahan_list->ListOptions->render("body", "right", $tunjangan_tambahan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tunjangan_tambahan_list->isGridAdd())
		$tunjangan_tambahan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tunjangan_tambahan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tunjangan_tambahan_list->Recordset)
	$tunjangan_tambahan_list->Recordset->Close();
?>
<?php if (!$tunjangan_tambahan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tunjangan_tambahan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tunjangan_tambahan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tunjangan_tambahan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tunjangan_tambahan_list->TotalRecords == 0 && !$tunjangan_tambahan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tunjangan_tambahan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tunjangan_tambahan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tunjangan_tambahan_list->isExport()) { ?>
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
$tunjangan_tambahan_list->terminate();
?>