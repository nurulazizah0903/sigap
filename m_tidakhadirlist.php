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
$m_tidakhadir_list = new m_tidakhadir_list();

// Run the page
$m_tidakhadir_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_tidakhadir_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_tidakhadir_list->isExport()) { ?>
<script>
var fm_tidakhadirlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_tidakhadirlist = currentForm = new ew.Form("fm_tidakhadirlist", "list");
	fm_tidakhadirlist.formKeyCountName = '<?php echo $m_tidakhadir_list->FormKeyCountName ?>';
	loadjs.done("fm_tidakhadirlist");
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
<?php if (!$m_tidakhadir_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_tidakhadir_list->TotalRecords > 0 && $m_tidakhadir_list->ExportOptions->visible()) { ?>
<?php $m_tidakhadir_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_tidakhadir_list->ImportOptions->visible()) { ?>
<?php $m_tidakhadir_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_tidakhadir_list->renderOtherOptions();
?>
<?php $m_tidakhadir_list->showPageHeader(); ?>
<?php
$m_tidakhadir_list->showMessage();
?>
<?php if ($m_tidakhadir_list->TotalRecords > 0 || $m_tidakhadir->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_tidakhadir_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_tidakhadir">
<?php if (!$m_tidakhadir_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_tidakhadir_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_tidakhadir_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_tidakhadir_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_tidakhadirlist" id="fm_tidakhadirlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_tidakhadir">
<div id="gmp_m_tidakhadir" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_tidakhadir_list->TotalRecords > 0 || $m_tidakhadir_list->isGridEdit()) { ?>
<table id="tbl_m_tidakhadirlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_tidakhadir->RowType = ROWTYPE_HEADER;

// Render list options
$m_tidakhadir_list->renderListOptions();

// Render list options (header, left)
$m_tidakhadir_list->ListOptions->render("header", "left");
?>
<?php if ($m_tidakhadir_list->id->Visible) { // id ?>
	<?php if ($m_tidakhadir_list->SortUrl($m_tidakhadir_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $m_tidakhadir_list->id->headerCellClass() ?>"><div id="elh_m_tidakhadir_id" class="m_tidakhadir_id"><div class="ew-table-header-caption"><?php echo $m_tidakhadir_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $m_tidakhadir_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_tidakhadir_list->SortUrl($m_tidakhadir_list->id) ?>', 1);"><div id="elh_m_tidakhadir_id" class="m_tidakhadir_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_tidakhadir_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_tidakhadir_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_tidakhadir_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_tidakhadir_list->jenjang_id->Visible) { // jenjang_id ?>
	<?php if ($m_tidakhadir_list->SortUrl($m_tidakhadir_list->jenjang_id) == "") { ?>
		<th data-name="jenjang_id" class="<?php echo $m_tidakhadir_list->jenjang_id->headerCellClass() ?>"><div id="elh_m_tidakhadir_jenjang_id" class="m_tidakhadir_jenjang_id"><div class="ew-table-header-caption"><?php echo $m_tidakhadir_list->jenjang_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang_id" class="<?php echo $m_tidakhadir_list->jenjang_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_tidakhadir_list->SortUrl($m_tidakhadir_list->jenjang_id) ?>', 1);"><div id="elh_m_tidakhadir_jenjang_id" class="m_tidakhadir_jenjang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_tidakhadir_list->jenjang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_tidakhadir_list->jenjang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_tidakhadir_list->jenjang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_tidakhadir_list->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($m_tidakhadir_list->SortUrl($m_tidakhadir_list->jabatan_id) == "") { ?>
		<th data-name="jabatan_id" class="<?php echo $m_tidakhadir_list->jabatan_id->headerCellClass() ?>"><div id="elh_m_tidakhadir_jabatan_id" class="m_tidakhadir_jabatan_id"><div class="ew-table-header-caption"><?php echo $m_tidakhadir_list->jabatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan_id" class="<?php echo $m_tidakhadir_list->jabatan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_tidakhadir_list->SortUrl($m_tidakhadir_list->jabatan_id) ?>', 1);"><div id="elh_m_tidakhadir_jabatan_id" class="m_tidakhadir_jabatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_tidakhadir_list->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_tidakhadir_list->jabatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_tidakhadir_list->jabatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_tidakhadir_list->value->Visible) { // value ?>
	<?php if ($m_tidakhadir_list->SortUrl($m_tidakhadir_list->value) == "") { ?>
		<th data-name="value" class="<?php echo $m_tidakhadir_list->value->headerCellClass() ?>"><div id="elh_m_tidakhadir_value" class="m_tidakhadir_value"><div class="ew-table-header-caption"><?php echo $m_tidakhadir_list->value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value" class="<?php echo $m_tidakhadir_list->value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_tidakhadir_list->SortUrl($m_tidakhadir_list->value) ?>', 1);"><div id="elh_m_tidakhadir_value" class="m_tidakhadir_value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_tidakhadir_list->value->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_tidakhadir_list->value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_tidakhadir_list->value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_tidakhadir_list->perjam_value->Visible) { // perjam_value ?>
	<?php if ($m_tidakhadir_list->SortUrl($m_tidakhadir_list->perjam_value) == "") { ?>
		<th data-name="perjam_value" class="<?php echo $m_tidakhadir_list->perjam_value->headerCellClass() ?>"><div id="elh_m_tidakhadir_perjam_value" class="m_tidakhadir_perjam_value"><div class="ew-table-header-caption"><?php echo $m_tidakhadir_list->perjam_value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="perjam_value" class="<?php echo $m_tidakhadir_list->perjam_value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_tidakhadir_list->SortUrl($m_tidakhadir_list->perjam_value) ?>', 1);"><div id="elh_m_tidakhadir_perjam_value" class="m_tidakhadir_perjam_value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_tidakhadir_list->perjam_value->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_tidakhadir_list->perjam_value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_tidakhadir_list->perjam_value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_tidakhadir_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_tidakhadir_list->ExportAll && $m_tidakhadir_list->isExport()) {
	$m_tidakhadir_list->StopRecord = $m_tidakhadir_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_tidakhadir_list->TotalRecords > $m_tidakhadir_list->StartRecord + $m_tidakhadir_list->DisplayRecords - 1)
		$m_tidakhadir_list->StopRecord = $m_tidakhadir_list->StartRecord + $m_tidakhadir_list->DisplayRecords - 1;
	else
		$m_tidakhadir_list->StopRecord = $m_tidakhadir_list->TotalRecords;
}
$m_tidakhadir_list->RecordCount = $m_tidakhadir_list->StartRecord - 1;
if ($m_tidakhadir_list->Recordset && !$m_tidakhadir_list->Recordset->EOF) {
	$m_tidakhadir_list->Recordset->moveFirst();
	$selectLimit = $m_tidakhadir_list->UseSelectLimit;
	if (!$selectLimit && $m_tidakhadir_list->StartRecord > 1)
		$m_tidakhadir_list->Recordset->move($m_tidakhadir_list->StartRecord - 1);
} elseif (!$m_tidakhadir->AllowAddDeleteRow && $m_tidakhadir_list->StopRecord == 0) {
	$m_tidakhadir_list->StopRecord = $m_tidakhadir->GridAddRowCount;
}

// Initialize aggregate
$m_tidakhadir->RowType = ROWTYPE_AGGREGATEINIT;
$m_tidakhadir->resetAttributes();
$m_tidakhadir_list->renderRow();
while ($m_tidakhadir_list->RecordCount < $m_tidakhadir_list->StopRecord) {
	$m_tidakhadir_list->RecordCount++;
	if ($m_tidakhadir_list->RecordCount >= $m_tidakhadir_list->StartRecord) {
		$m_tidakhadir_list->RowCount++;

		// Set up key count
		$m_tidakhadir_list->KeyCount = $m_tidakhadir_list->RowIndex;

		// Init row class and style
		$m_tidakhadir->resetAttributes();
		$m_tidakhadir->CssClass = "";
		if ($m_tidakhadir_list->isGridAdd()) {
		} else {
			$m_tidakhadir_list->loadRowValues($m_tidakhadir_list->Recordset); // Load row values
		}
		$m_tidakhadir->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_tidakhadir->RowAttrs->merge(["data-rowindex" => $m_tidakhadir_list->RowCount, "id" => "r" . $m_tidakhadir_list->RowCount . "_m_tidakhadir", "data-rowtype" => $m_tidakhadir->RowType]);

		// Render row
		$m_tidakhadir_list->renderRow();

		// Render list options
		$m_tidakhadir_list->renderListOptions();
?>
	<tr <?php echo $m_tidakhadir->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_tidakhadir_list->ListOptions->render("body", "left", $m_tidakhadir_list->RowCount);
?>
	<?php if ($m_tidakhadir_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $m_tidakhadir_list->id->cellAttributes() ?>>
<span id="el<?php echo $m_tidakhadir_list->RowCount ?>_m_tidakhadir_id">
<span<?php echo $m_tidakhadir_list->id->viewAttributes() ?>><?php echo $m_tidakhadir_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_tidakhadir_list->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id" <?php echo $m_tidakhadir_list->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $m_tidakhadir_list->RowCount ?>_m_tidakhadir_jenjang_id">
<span<?php echo $m_tidakhadir_list->jenjang_id->viewAttributes() ?>><?php echo $m_tidakhadir_list->jenjang_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_tidakhadir_list->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id" <?php echo $m_tidakhadir_list->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $m_tidakhadir_list->RowCount ?>_m_tidakhadir_jabatan_id">
<span<?php echo $m_tidakhadir_list->jabatan_id->viewAttributes() ?>><?php echo $m_tidakhadir_list->jabatan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_tidakhadir_list->value->Visible) { // value ?>
		<td data-name="value" <?php echo $m_tidakhadir_list->value->cellAttributes() ?>>
<span id="el<?php echo $m_tidakhadir_list->RowCount ?>_m_tidakhadir_value">
<span<?php echo $m_tidakhadir_list->value->viewAttributes() ?>><?php echo $m_tidakhadir_list->value->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_tidakhadir_list->perjam_value->Visible) { // perjam_value ?>
		<td data-name="perjam_value" <?php echo $m_tidakhadir_list->perjam_value->cellAttributes() ?>>
<span id="el<?php echo $m_tidakhadir_list->RowCount ?>_m_tidakhadir_perjam_value">
<span<?php echo $m_tidakhadir_list->perjam_value->viewAttributes() ?>><?php echo $m_tidakhadir_list->perjam_value->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_tidakhadir_list->ListOptions->render("body", "right", $m_tidakhadir_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_tidakhadir_list->isGridAdd())
		$m_tidakhadir_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_tidakhadir->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_tidakhadir_list->Recordset)
	$m_tidakhadir_list->Recordset->Close();
?>
<?php if (!$m_tidakhadir_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_tidakhadir_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_tidakhadir_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_tidakhadir_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_tidakhadir_list->TotalRecords == 0 && !$m_tidakhadir->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_tidakhadir_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_tidakhadir_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_tidakhadir_list->isExport()) { ?>
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
$m_tidakhadir_list->terminate();
?>