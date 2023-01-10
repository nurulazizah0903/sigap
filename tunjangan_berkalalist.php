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
$tunjangan_berkala_list = new tunjangan_berkala_list();

// Run the page
$tunjangan_berkala_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tunjangan_berkala_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tunjangan_berkala_list->isExport()) { ?>
<script>
var ftunjangan_berkalalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftunjangan_berkalalist = currentForm = new ew.Form("ftunjangan_berkalalist", "list");
	ftunjangan_berkalalist.formKeyCountName = '<?php echo $tunjangan_berkala_list->FormKeyCountName ?>';
	loadjs.done("ftunjangan_berkalalist");
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
<?php if (!$tunjangan_berkala_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tunjangan_berkala_list->TotalRecords > 0 && $tunjangan_berkala_list->ExportOptions->visible()) { ?>
<?php $tunjangan_berkala_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tunjangan_berkala_list->ImportOptions->visible()) { ?>
<?php $tunjangan_berkala_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tunjangan_berkala_list->renderOtherOptions();
?>
<?php $tunjangan_berkala_list->showPageHeader(); ?>
<?php
$tunjangan_berkala_list->showMessage();
?>
<?php if ($tunjangan_berkala_list->TotalRecords > 0 || $tunjangan_berkala->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tunjangan_berkala_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tunjangan_berkala">
<?php if (!$tunjangan_berkala_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tunjangan_berkala_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tunjangan_berkala_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tunjangan_berkala_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftunjangan_berkalalist" id="ftunjangan_berkalalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tunjangan_berkala">
<div id="gmp_tunjangan_berkala" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tunjangan_berkala_list->TotalRecords > 0 || $tunjangan_berkala_list->isGridEdit()) { ?>
<table id="tbl_tunjangan_berkalalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tunjangan_berkala->RowType = ROWTYPE_HEADER;

// Render list options
$tunjangan_berkala_list->renderListOptions();

// Render list options (header, left)
$tunjangan_berkala_list->ListOptions->render("header", "left");
?>
<?php if ($tunjangan_berkala_list->jenjang->Visible) { // jenjang ?>
	<?php if ($tunjangan_berkala_list->SortUrl($tunjangan_berkala_list->jenjang) == "") { ?>
		<th data-name="jenjang" class="<?php echo $tunjangan_berkala_list->jenjang->headerCellClass() ?>"><div id="elh_tunjangan_berkala_jenjang" class="tunjangan_berkala_jenjang"><div class="ew-table-header-caption"><?php echo $tunjangan_berkala_list->jenjang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang" class="<?php echo $tunjangan_berkala_list->jenjang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tunjangan_berkala_list->SortUrl($tunjangan_berkala_list->jenjang) ?>', 1);"><div id="elh_tunjangan_berkala_jenjang" class="tunjangan_berkala_jenjang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tunjangan_berkala_list->jenjang->caption() ?></span><span class="ew-table-header-sort"><?php if ($tunjangan_berkala_list->jenjang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tunjangan_berkala_list->jenjang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tunjangan_berkala_list->kualifikasi->Visible) { // kualifikasi ?>
	<?php if ($tunjangan_berkala_list->SortUrl($tunjangan_berkala_list->kualifikasi) == "") { ?>
		<th data-name="kualifikasi" class="<?php echo $tunjangan_berkala_list->kualifikasi->headerCellClass() ?>"><div id="elh_tunjangan_berkala_kualifikasi" class="tunjangan_berkala_kualifikasi"><div class="ew-table-header-caption"><?php echo $tunjangan_berkala_list->kualifikasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kualifikasi" class="<?php echo $tunjangan_berkala_list->kualifikasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tunjangan_berkala_list->SortUrl($tunjangan_berkala_list->kualifikasi) ?>', 1);"><div id="elh_tunjangan_berkala_kualifikasi" class="tunjangan_berkala_kualifikasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tunjangan_berkala_list->kualifikasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($tunjangan_berkala_list->kualifikasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tunjangan_berkala_list->kualifikasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tunjangan_berkala_list->lama->Visible) { // lama ?>
	<?php if ($tunjangan_berkala_list->SortUrl($tunjangan_berkala_list->lama) == "") { ?>
		<th data-name="lama" class="<?php echo $tunjangan_berkala_list->lama->headerCellClass() ?>"><div id="elh_tunjangan_berkala_lama" class="tunjangan_berkala_lama"><div class="ew-table-header-caption"><?php echo $tunjangan_berkala_list->lama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lama" class="<?php echo $tunjangan_berkala_list->lama->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tunjangan_berkala_list->SortUrl($tunjangan_berkala_list->lama) ?>', 1);"><div id="elh_tunjangan_berkala_lama" class="tunjangan_berkala_lama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tunjangan_berkala_list->lama->caption() ?></span><span class="ew-table-header-sort"><?php if ($tunjangan_berkala_list->lama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tunjangan_berkala_list->lama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tunjangan_berkala_list->value->Visible) { // value ?>
	<?php if ($tunjangan_berkala_list->SortUrl($tunjangan_berkala_list->value) == "") { ?>
		<th data-name="value" class="<?php echo $tunjangan_berkala_list->value->headerCellClass() ?>"><div id="elh_tunjangan_berkala_value" class="tunjangan_berkala_value"><div class="ew-table-header-caption"><?php echo $tunjangan_berkala_list->value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value" class="<?php echo $tunjangan_berkala_list->value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tunjangan_berkala_list->SortUrl($tunjangan_berkala_list->value) ?>', 1);"><div id="elh_tunjangan_berkala_value" class="tunjangan_berkala_value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tunjangan_berkala_list->value->caption() ?></span><span class="ew-table-header-sort"><?php if ($tunjangan_berkala_list->value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tunjangan_berkala_list->value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tunjangan_berkala_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tunjangan_berkala_list->ExportAll && $tunjangan_berkala_list->isExport()) {
	$tunjangan_berkala_list->StopRecord = $tunjangan_berkala_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tunjangan_berkala_list->TotalRecords > $tunjangan_berkala_list->StartRecord + $tunjangan_berkala_list->DisplayRecords - 1)
		$tunjangan_berkala_list->StopRecord = $tunjangan_berkala_list->StartRecord + $tunjangan_berkala_list->DisplayRecords - 1;
	else
		$tunjangan_berkala_list->StopRecord = $tunjangan_berkala_list->TotalRecords;
}
$tunjangan_berkala_list->RecordCount = $tunjangan_berkala_list->StartRecord - 1;
if ($tunjangan_berkala_list->Recordset && !$tunjangan_berkala_list->Recordset->EOF) {
	$tunjangan_berkala_list->Recordset->moveFirst();
	$selectLimit = $tunjangan_berkala_list->UseSelectLimit;
	if (!$selectLimit && $tunjangan_berkala_list->StartRecord > 1)
		$tunjangan_berkala_list->Recordset->move($tunjangan_berkala_list->StartRecord - 1);
} elseif (!$tunjangan_berkala->AllowAddDeleteRow && $tunjangan_berkala_list->StopRecord == 0) {
	$tunjangan_berkala_list->StopRecord = $tunjangan_berkala->GridAddRowCount;
}

// Initialize aggregate
$tunjangan_berkala->RowType = ROWTYPE_AGGREGATEINIT;
$tunjangan_berkala->resetAttributes();
$tunjangan_berkala_list->renderRow();
while ($tunjangan_berkala_list->RecordCount < $tunjangan_berkala_list->StopRecord) {
	$tunjangan_berkala_list->RecordCount++;
	if ($tunjangan_berkala_list->RecordCount >= $tunjangan_berkala_list->StartRecord) {
		$tunjangan_berkala_list->RowCount++;

		// Set up key count
		$tunjangan_berkala_list->KeyCount = $tunjangan_berkala_list->RowIndex;

		// Init row class and style
		$tunjangan_berkala->resetAttributes();
		$tunjangan_berkala->CssClass = "";
		if ($tunjangan_berkala_list->isGridAdd()) {
		} else {
			$tunjangan_berkala_list->loadRowValues($tunjangan_berkala_list->Recordset); // Load row values
		}
		$tunjangan_berkala->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tunjangan_berkala->RowAttrs->merge(["data-rowindex" => $tunjangan_berkala_list->RowCount, "id" => "r" . $tunjangan_berkala_list->RowCount . "_tunjangan_berkala", "data-rowtype" => $tunjangan_berkala->RowType]);

		// Render row
		$tunjangan_berkala_list->renderRow();

		// Render list options
		$tunjangan_berkala_list->renderListOptions();
?>
	<tr <?php echo $tunjangan_berkala->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tunjangan_berkala_list->ListOptions->render("body", "left", $tunjangan_berkala_list->RowCount);
?>
	<?php if ($tunjangan_berkala_list->jenjang->Visible) { // jenjang ?>
		<td data-name="jenjang" <?php echo $tunjangan_berkala_list->jenjang->cellAttributes() ?>>
<span id="el<?php echo $tunjangan_berkala_list->RowCount ?>_tunjangan_berkala_jenjang">
<span<?php echo $tunjangan_berkala_list->jenjang->viewAttributes() ?>><?php echo $tunjangan_berkala_list->jenjang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tunjangan_berkala_list->kualifikasi->Visible) { // kualifikasi ?>
		<td data-name="kualifikasi" <?php echo $tunjangan_berkala_list->kualifikasi->cellAttributes() ?>>
<span id="el<?php echo $tunjangan_berkala_list->RowCount ?>_tunjangan_berkala_kualifikasi">
<span<?php echo $tunjangan_berkala_list->kualifikasi->viewAttributes() ?>><?php echo $tunjangan_berkala_list->kualifikasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tunjangan_berkala_list->lama->Visible) { // lama ?>
		<td data-name="lama" <?php echo $tunjangan_berkala_list->lama->cellAttributes() ?>>
<span id="el<?php echo $tunjangan_berkala_list->RowCount ?>_tunjangan_berkala_lama">
<span<?php echo $tunjangan_berkala_list->lama->viewAttributes() ?>><?php echo $tunjangan_berkala_list->lama->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tunjangan_berkala_list->value->Visible) { // value ?>
		<td data-name="value" <?php echo $tunjangan_berkala_list->value->cellAttributes() ?>>
<span id="el<?php echo $tunjangan_berkala_list->RowCount ?>_tunjangan_berkala_value">
<span<?php echo $tunjangan_berkala_list->value->viewAttributes() ?>><?php echo $tunjangan_berkala_list->value->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tunjangan_berkala_list->ListOptions->render("body", "right", $tunjangan_berkala_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tunjangan_berkala_list->isGridAdd())
		$tunjangan_berkala_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tunjangan_berkala->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tunjangan_berkala_list->Recordset)
	$tunjangan_berkala_list->Recordset->Close();
?>
<?php if (!$tunjangan_berkala_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tunjangan_berkala_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tunjangan_berkala_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tunjangan_berkala_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tunjangan_berkala_list->TotalRecords == 0 && !$tunjangan_berkala->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tunjangan_berkala_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tunjangan_berkala_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tunjangan_berkala_list->isExport()) { ?>
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
$tunjangan_berkala_list->terminate();
?>