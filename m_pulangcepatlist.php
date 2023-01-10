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
$m_pulangcepat_list = new m_pulangcepat_list();

// Run the page
$m_pulangcepat_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_pulangcepat_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_pulangcepat_list->isExport()) { ?>
<script>
var fm_pulangcepatlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_pulangcepatlist = currentForm = new ew.Form("fm_pulangcepatlist", "list");
	fm_pulangcepatlist.formKeyCountName = '<?php echo $m_pulangcepat_list->FormKeyCountName ?>';
	loadjs.done("fm_pulangcepatlist");
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
<?php if (!$m_pulangcepat_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_pulangcepat_list->TotalRecords > 0 && $m_pulangcepat_list->ExportOptions->visible()) { ?>
<?php $m_pulangcepat_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_pulangcepat_list->ImportOptions->visible()) { ?>
<?php $m_pulangcepat_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_pulangcepat_list->renderOtherOptions();
?>
<?php $m_pulangcepat_list->showPageHeader(); ?>
<?php
$m_pulangcepat_list->showMessage();
?>
<?php if ($m_pulangcepat_list->TotalRecords > 0 || $m_pulangcepat->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_pulangcepat_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_pulangcepat">
<?php if (!$m_pulangcepat_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_pulangcepat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_pulangcepat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_pulangcepat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_pulangcepatlist" id="fm_pulangcepatlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_pulangcepat">
<div id="gmp_m_pulangcepat" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_pulangcepat_list->TotalRecords > 0 || $m_pulangcepat_list->isGridEdit()) { ?>
<table id="tbl_m_pulangcepatlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_pulangcepat->RowType = ROWTYPE_HEADER;

// Render list options
$m_pulangcepat_list->renderListOptions();

// Render list options (header, left)
$m_pulangcepat_list->ListOptions->render("header", "left");
?>
<?php if ($m_pulangcepat_list->id->Visible) { // id ?>
	<?php if ($m_pulangcepat_list->SortUrl($m_pulangcepat_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $m_pulangcepat_list->id->headerCellClass() ?>"><div id="elh_m_pulangcepat_id" class="m_pulangcepat_id"><div class="ew-table-header-caption"><?php echo $m_pulangcepat_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $m_pulangcepat_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pulangcepat_list->SortUrl($m_pulangcepat_list->id) ?>', 1);"><div id="elh_m_pulangcepat_id" class="m_pulangcepat_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pulangcepat_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_pulangcepat_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pulangcepat_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pulangcepat_list->jenjang_id->Visible) { // jenjang_id ?>
	<?php if ($m_pulangcepat_list->SortUrl($m_pulangcepat_list->jenjang_id) == "") { ?>
		<th data-name="jenjang_id" class="<?php echo $m_pulangcepat_list->jenjang_id->headerCellClass() ?>"><div id="elh_m_pulangcepat_jenjang_id" class="m_pulangcepat_jenjang_id"><div class="ew-table-header-caption"><?php echo $m_pulangcepat_list->jenjang_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang_id" class="<?php echo $m_pulangcepat_list->jenjang_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pulangcepat_list->SortUrl($m_pulangcepat_list->jenjang_id) ?>', 1);"><div id="elh_m_pulangcepat_jenjang_id" class="m_pulangcepat_jenjang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pulangcepat_list->jenjang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_pulangcepat_list->jenjang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pulangcepat_list->jenjang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pulangcepat_list->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($m_pulangcepat_list->SortUrl($m_pulangcepat_list->jabatan_id) == "") { ?>
		<th data-name="jabatan_id" class="<?php echo $m_pulangcepat_list->jabatan_id->headerCellClass() ?>"><div id="elh_m_pulangcepat_jabatan_id" class="m_pulangcepat_jabatan_id"><div class="ew-table-header-caption"><?php echo $m_pulangcepat_list->jabatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan_id" class="<?php echo $m_pulangcepat_list->jabatan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pulangcepat_list->SortUrl($m_pulangcepat_list->jabatan_id) ?>', 1);"><div id="elh_m_pulangcepat_jabatan_id" class="m_pulangcepat_jabatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pulangcepat_list->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_pulangcepat_list->jabatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pulangcepat_list->jabatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pulangcepat_list->perjam->Visible) { // perjam ?>
	<?php if ($m_pulangcepat_list->SortUrl($m_pulangcepat_list->perjam) == "") { ?>
		<th data-name="perjam" class="<?php echo $m_pulangcepat_list->perjam->headerCellClass() ?>"><div id="elh_m_pulangcepat_perjam" class="m_pulangcepat_perjam"><div class="ew-table-header-caption"><?php echo $m_pulangcepat_list->perjam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="perjam" class="<?php echo $m_pulangcepat_list->perjam->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pulangcepat_list->SortUrl($m_pulangcepat_list->perjam) ?>', 1);"><div id="elh_m_pulangcepat_perjam" class="m_pulangcepat_perjam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pulangcepat_list->perjam->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_pulangcepat_list->perjam->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pulangcepat_list->perjam->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_pulangcepat_list->perhari->Visible) { // perhari ?>
	<?php if ($m_pulangcepat_list->SortUrl($m_pulangcepat_list->perhari) == "") { ?>
		<th data-name="perhari" class="<?php echo $m_pulangcepat_list->perhari->headerCellClass() ?>"><div id="elh_m_pulangcepat_perhari" class="m_pulangcepat_perhari"><div class="ew-table-header-caption"><?php echo $m_pulangcepat_list->perhari->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="perhari" class="<?php echo $m_pulangcepat_list->perhari->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_pulangcepat_list->SortUrl($m_pulangcepat_list->perhari) ?>', 1);"><div id="elh_m_pulangcepat_perhari" class="m_pulangcepat_perhari">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_pulangcepat_list->perhari->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_pulangcepat_list->perhari->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_pulangcepat_list->perhari->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_pulangcepat_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_pulangcepat_list->ExportAll && $m_pulangcepat_list->isExport()) {
	$m_pulangcepat_list->StopRecord = $m_pulangcepat_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_pulangcepat_list->TotalRecords > $m_pulangcepat_list->StartRecord + $m_pulangcepat_list->DisplayRecords - 1)
		$m_pulangcepat_list->StopRecord = $m_pulangcepat_list->StartRecord + $m_pulangcepat_list->DisplayRecords - 1;
	else
		$m_pulangcepat_list->StopRecord = $m_pulangcepat_list->TotalRecords;
}
$m_pulangcepat_list->RecordCount = $m_pulangcepat_list->StartRecord - 1;
if ($m_pulangcepat_list->Recordset && !$m_pulangcepat_list->Recordset->EOF) {
	$m_pulangcepat_list->Recordset->moveFirst();
	$selectLimit = $m_pulangcepat_list->UseSelectLimit;
	if (!$selectLimit && $m_pulangcepat_list->StartRecord > 1)
		$m_pulangcepat_list->Recordset->move($m_pulangcepat_list->StartRecord - 1);
} elseif (!$m_pulangcepat->AllowAddDeleteRow && $m_pulangcepat_list->StopRecord == 0) {
	$m_pulangcepat_list->StopRecord = $m_pulangcepat->GridAddRowCount;
}

// Initialize aggregate
$m_pulangcepat->RowType = ROWTYPE_AGGREGATEINIT;
$m_pulangcepat->resetAttributes();
$m_pulangcepat_list->renderRow();
while ($m_pulangcepat_list->RecordCount < $m_pulangcepat_list->StopRecord) {
	$m_pulangcepat_list->RecordCount++;
	if ($m_pulangcepat_list->RecordCount >= $m_pulangcepat_list->StartRecord) {
		$m_pulangcepat_list->RowCount++;

		// Set up key count
		$m_pulangcepat_list->KeyCount = $m_pulangcepat_list->RowIndex;

		// Init row class and style
		$m_pulangcepat->resetAttributes();
		$m_pulangcepat->CssClass = "";
		if ($m_pulangcepat_list->isGridAdd()) {
		} else {
			$m_pulangcepat_list->loadRowValues($m_pulangcepat_list->Recordset); // Load row values
		}
		$m_pulangcepat->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_pulangcepat->RowAttrs->merge(["data-rowindex" => $m_pulangcepat_list->RowCount, "id" => "r" . $m_pulangcepat_list->RowCount . "_m_pulangcepat", "data-rowtype" => $m_pulangcepat->RowType]);

		// Render row
		$m_pulangcepat_list->renderRow();

		// Render list options
		$m_pulangcepat_list->renderListOptions();
?>
	<tr <?php echo $m_pulangcepat->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_pulangcepat_list->ListOptions->render("body", "left", $m_pulangcepat_list->RowCount);
?>
	<?php if ($m_pulangcepat_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $m_pulangcepat_list->id->cellAttributes() ?>>
<span id="el<?php echo $m_pulangcepat_list->RowCount ?>_m_pulangcepat_id">
<span<?php echo $m_pulangcepat_list->id->viewAttributes() ?>><?php echo $m_pulangcepat_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pulangcepat_list->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id" <?php echo $m_pulangcepat_list->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $m_pulangcepat_list->RowCount ?>_m_pulangcepat_jenjang_id">
<span<?php echo $m_pulangcepat_list->jenjang_id->viewAttributes() ?>><?php echo $m_pulangcepat_list->jenjang_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pulangcepat_list->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id" <?php echo $m_pulangcepat_list->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $m_pulangcepat_list->RowCount ?>_m_pulangcepat_jabatan_id">
<span<?php echo $m_pulangcepat_list->jabatan_id->viewAttributes() ?>><?php echo $m_pulangcepat_list->jabatan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pulangcepat_list->perjam->Visible) { // perjam ?>
		<td data-name="perjam" <?php echo $m_pulangcepat_list->perjam->cellAttributes() ?>>
<span id="el<?php echo $m_pulangcepat_list->RowCount ?>_m_pulangcepat_perjam">
<span<?php echo $m_pulangcepat_list->perjam->viewAttributes() ?>><?php echo $m_pulangcepat_list->perjam->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_pulangcepat_list->perhari->Visible) { // perhari ?>
		<td data-name="perhari" <?php echo $m_pulangcepat_list->perhari->cellAttributes() ?>>
<span id="el<?php echo $m_pulangcepat_list->RowCount ?>_m_pulangcepat_perhari">
<span<?php echo $m_pulangcepat_list->perhari->viewAttributes() ?>><?php echo $m_pulangcepat_list->perhari->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_pulangcepat_list->ListOptions->render("body", "right", $m_pulangcepat_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_pulangcepat_list->isGridAdd())
		$m_pulangcepat_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_pulangcepat->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_pulangcepat_list->Recordset)
	$m_pulangcepat_list->Recordset->Close();
?>
<?php if (!$m_pulangcepat_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_pulangcepat_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_pulangcepat_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_pulangcepat_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_pulangcepat_list->TotalRecords == 0 && !$m_pulangcepat->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_pulangcepat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_pulangcepat_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_pulangcepat_list->isExport()) { ?>
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
$m_pulangcepat_list->terminate();
?>