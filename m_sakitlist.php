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
$m_sakit_list = new m_sakit_list();

// Run the page
$m_sakit_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_sakit_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_sakit_list->isExport()) { ?>
<script>
var fm_sakitlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_sakitlist = currentForm = new ew.Form("fm_sakitlist", "list");
	fm_sakitlist.formKeyCountName = '<?php echo $m_sakit_list->FormKeyCountName ?>';
	loadjs.done("fm_sakitlist");
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
<?php if (!$m_sakit_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_sakit_list->TotalRecords > 0 && $m_sakit_list->ExportOptions->visible()) { ?>
<?php $m_sakit_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_sakit_list->ImportOptions->visible()) { ?>
<?php $m_sakit_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_sakit_list->renderOtherOptions();
?>
<?php $m_sakit_list->showPageHeader(); ?>
<?php
$m_sakit_list->showMessage();
?>
<?php if ($m_sakit_list->TotalRecords > 0 || $m_sakit->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_sakit_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_sakit">
<?php if (!$m_sakit_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_sakit_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_sakit_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_sakit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_sakitlist" id="fm_sakitlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_sakit">
<div id="gmp_m_sakit" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_sakit_list->TotalRecords > 0 || $m_sakit_list->isGridEdit()) { ?>
<table id="tbl_m_sakitlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_sakit->RowType = ROWTYPE_HEADER;

// Render list options
$m_sakit_list->renderListOptions();

// Render list options (header, left)
$m_sakit_list->ListOptions->render("header", "left");
?>
<?php if ($m_sakit_list->jenjang_id->Visible) { // jenjang_id ?>
	<?php if ($m_sakit_list->SortUrl($m_sakit_list->jenjang_id) == "") { ?>
		<th data-name="jenjang_id" class="<?php echo $m_sakit_list->jenjang_id->headerCellClass() ?>"><div id="elh_m_sakit_jenjang_id" class="m_sakit_jenjang_id"><div class="ew-table-header-caption"><?php echo $m_sakit_list->jenjang_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang_id" class="<?php echo $m_sakit_list->jenjang_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_sakit_list->SortUrl($m_sakit_list->jenjang_id) ?>', 1);"><div id="elh_m_sakit_jenjang_id" class="m_sakit_jenjang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_sakit_list->jenjang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_sakit_list->jenjang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_sakit_list->jenjang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_sakit_list->jabatan->Visible) { // jabatan ?>
	<?php if ($m_sakit_list->SortUrl($m_sakit_list->jabatan) == "") { ?>
		<th data-name="jabatan" class="<?php echo $m_sakit_list->jabatan->headerCellClass() ?>"><div id="elh_m_sakit_jabatan" class="m_sakit_jabatan"><div class="ew-table-header-caption"><?php echo $m_sakit_list->jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan" class="<?php echo $m_sakit_list->jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_sakit_list->SortUrl($m_sakit_list->jabatan) ?>', 1);"><div id="elh_m_sakit_jabatan" class="m_sakit_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_sakit_list->jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_sakit_list->jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_sakit_list->jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_sakit_list->perhari->Visible) { // perhari ?>
	<?php if ($m_sakit_list->SortUrl($m_sakit_list->perhari) == "") { ?>
		<th data-name="perhari" class="<?php echo $m_sakit_list->perhari->headerCellClass() ?>"><div id="elh_m_sakit_perhari" class="m_sakit_perhari"><div class="ew-table-header-caption"><?php echo $m_sakit_list->perhari->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="perhari" class="<?php echo $m_sakit_list->perhari->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_sakit_list->SortUrl($m_sakit_list->perhari) ?>', 1);"><div id="elh_m_sakit_perhari" class="m_sakit_perhari">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_sakit_list->perhari->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_sakit_list->perhari->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_sakit_list->perhari->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_sakit_list->perjam->Visible) { // perjam ?>
	<?php if ($m_sakit_list->SortUrl($m_sakit_list->perjam) == "") { ?>
		<th data-name="perjam" class="<?php echo $m_sakit_list->perjam->headerCellClass() ?>"><div id="elh_m_sakit_perjam" class="m_sakit_perjam"><div class="ew-table-header-caption"><?php echo $m_sakit_list->perjam->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="perjam" class="<?php echo $m_sakit_list->perjam->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_sakit_list->SortUrl($m_sakit_list->perjam) ?>', 1);"><div id="elh_m_sakit_perjam" class="m_sakit_perjam">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_sakit_list->perjam->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_sakit_list->perjam->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_sakit_list->perjam->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_sakit_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_sakit_list->ExportAll && $m_sakit_list->isExport()) {
	$m_sakit_list->StopRecord = $m_sakit_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_sakit_list->TotalRecords > $m_sakit_list->StartRecord + $m_sakit_list->DisplayRecords - 1)
		$m_sakit_list->StopRecord = $m_sakit_list->StartRecord + $m_sakit_list->DisplayRecords - 1;
	else
		$m_sakit_list->StopRecord = $m_sakit_list->TotalRecords;
}
$m_sakit_list->RecordCount = $m_sakit_list->StartRecord - 1;
if ($m_sakit_list->Recordset && !$m_sakit_list->Recordset->EOF) {
	$m_sakit_list->Recordset->moveFirst();
	$selectLimit = $m_sakit_list->UseSelectLimit;
	if (!$selectLimit && $m_sakit_list->StartRecord > 1)
		$m_sakit_list->Recordset->move($m_sakit_list->StartRecord - 1);
} elseif (!$m_sakit->AllowAddDeleteRow && $m_sakit_list->StopRecord == 0) {
	$m_sakit_list->StopRecord = $m_sakit->GridAddRowCount;
}

// Initialize aggregate
$m_sakit->RowType = ROWTYPE_AGGREGATEINIT;
$m_sakit->resetAttributes();
$m_sakit_list->renderRow();
while ($m_sakit_list->RecordCount < $m_sakit_list->StopRecord) {
	$m_sakit_list->RecordCount++;
	if ($m_sakit_list->RecordCount >= $m_sakit_list->StartRecord) {
		$m_sakit_list->RowCount++;

		// Set up key count
		$m_sakit_list->KeyCount = $m_sakit_list->RowIndex;

		// Init row class and style
		$m_sakit->resetAttributes();
		$m_sakit->CssClass = "";
		if ($m_sakit_list->isGridAdd()) {
		} else {
			$m_sakit_list->loadRowValues($m_sakit_list->Recordset); // Load row values
		}
		$m_sakit->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_sakit->RowAttrs->merge(["data-rowindex" => $m_sakit_list->RowCount, "id" => "r" . $m_sakit_list->RowCount . "_m_sakit", "data-rowtype" => $m_sakit->RowType]);

		// Render row
		$m_sakit_list->renderRow();

		// Render list options
		$m_sakit_list->renderListOptions();
?>
	<tr <?php echo $m_sakit->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_sakit_list->ListOptions->render("body", "left", $m_sakit_list->RowCount);
?>
	<?php if ($m_sakit_list->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id" <?php echo $m_sakit_list->jenjang_id->cellAttributes() ?>>
<span id="el<?php echo $m_sakit_list->RowCount ?>_m_sakit_jenjang_id">
<span<?php echo $m_sakit_list->jenjang_id->viewAttributes() ?>><?php echo $m_sakit_list->jenjang_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_sakit_list->jabatan->Visible) { // jabatan ?>
		<td data-name="jabatan" <?php echo $m_sakit_list->jabatan->cellAttributes() ?>>
<span id="el<?php echo $m_sakit_list->RowCount ?>_m_sakit_jabatan">
<span<?php echo $m_sakit_list->jabatan->viewAttributes() ?>><?php echo $m_sakit_list->jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_sakit_list->perhari->Visible) { // perhari ?>
		<td data-name="perhari" <?php echo $m_sakit_list->perhari->cellAttributes() ?>>
<span id="el<?php echo $m_sakit_list->RowCount ?>_m_sakit_perhari">
<span<?php echo $m_sakit_list->perhari->viewAttributes() ?>><?php echo $m_sakit_list->perhari->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_sakit_list->perjam->Visible) { // perjam ?>
		<td data-name="perjam" <?php echo $m_sakit_list->perjam->cellAttributes() ?>>
<span id="el<?php echo $m_sakit_list->RowCount ?>_m_sakit_perjam">
<span<?php echo $m_sakit_list->perjam->viewAttributes() ?>><?php echo $m_sakit_list->perjam->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_sakit_list->ListOptions->render("body", "right", $m_sakit_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_sakit_list->isGridAdd())
		$m_sakit_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_sakit->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_sakit_list->Recordset)
	$m_sakit_list->Recordset->Close();
?>
<?php if (!$m_sakit_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_sakit_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_sakit_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_sakit_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_sakit_list->TotalRecords == 0 && !$m_sakit->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_sakit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_sakit_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_sakit_list->isExport()) { ?>
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
$m_sakit_list->terminate();
?>