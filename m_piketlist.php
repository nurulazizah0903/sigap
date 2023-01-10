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
$m_piket_list = new m_piket_list();

// Run the page
$m_piket_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_piket_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_piket_list->isExport()) { ?>
<script>
var fm_piketlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_piketlist = currentForm = new ew.Form("fm_piketlist", "list");
	fm_piketlist.formKeyCountName = '<?php echo $m_piket_list->FormKeyCountName ?>';
	loadjs.done("fm_piketlist");
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
<?php if (!$m_piket_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_piket_list->TotalRecords > 0 && $m_piket_list->ExportOptions->visible()) { ?>
<?php $m_piket_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_piket_list->ImportOptions->visible()) { ?>
<?php $m_piket_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_piket_list->renderOtherOptions();
?>
<?php $m_piket_list->showPageHeader(); ?>
<?php
$m_piket_list->showMessage();
?>
<?php if ($m_piket_list->TotalRecords > 0 || $m_piket->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_piket_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_piket">
<?php if (!$m_piket_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_piket_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_piket_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_piket_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_piketlist" id="fm_piketlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_piket">
<div id="gmp_m_piket" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_piket_list->TotalRecords > 0 || $m_piket_list->isGridEdit()) { ?>
<table id="tbl_m_piketlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_piket->RowType = ROWTYPE_HEADER;

// Render list options
$m_piket_list->renderListOptions();

// Render list options (header, left)
$m_piket_list->ListOptions->render("header", "left");
?>
<?php if ($m_piket_list->jenjang->Visible) { // jenjang ?>
	<?php if ($m_piket_list->SortUrl($m_piket_list->jenjang) == "") { ?>
		<th data-name="jenjang" class="<?php echo $m_piket_list->jenjang->headerCellClass() ?>"><div id="elh_m_piket_jenjang" class="m_piket_jenjang"><div class="ew-table-header-caption"><?php echo $m_piket_list->jenjang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang" class="<?php echo $m_piket_list->jenjang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_piket_list->SortUrl($m_piket_list->jenjang) ?>', 1);"><div id="elh_m_piket_jenjang" class="m_piket_jenjang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_piket_list->jenjang->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_piket_list->jenjang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_piket_list->jenjang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_piket_list->type_jabatan->Visible) { // type_jabatan ?>
	<?php if ($m_piket_list->SortUrl($m_piket_list->type_jabatan) == "") { ?>
		<th data-name="type_jabatan" class="<?php echo $m_piket_list->type_jabatan->headerCellClass() ?>"><div id="elh_m_piket_type_jabatan" class="m_piket_type_jabatan"><div class="ew-table-header-caption"><?php echo $m_piket_list->type_jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="type_jabatan" class="<?php echo $m_piket_list->type_jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_piket_list->SortUrl($m_piket_list->type_jabatan) ?>', 1);"><div id="elh_m_piket_type_jabatan" class="m_piket_type_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_piket_list->type_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_piket_list->type_jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_piket_list->type_jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_piket_list->jenis_sertif->Visible) { // jenis_sertif ?>
	<?php if ($m_piket_list->SortUrl($m_piket_list->jenis_sertif) == "") { ?>
		<th data-name="jenis_sertif" class="<?php echo $m_piket_list->jenis_sertif->headerCellClass() ?>"><div id="elh_m_piket_jenis_sertif" class="m_piket_jenis_sertif"><div class="ew-table-header-caption"><?php echo $m_piket_list->jenis_sertif->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_sertif" class="<?php echo $m_piket_list->jenis_sertif->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_piket_list->SortUrl($m_piket_list->jenis_sertif) ?>', 1);"><div id="elh_m_piket_jenis_sertif" class="m_piket_jenis_sertif">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_piket_list->jenis_sertif->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_piket_list->jenis_sertif->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_piket_list->jenis_sertif->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_piket_list->value->Visible) { // value ?>
	<?php if ($m_piket_list->SortUrl($m_piket_list->value) == "") { ?>
		<th data-name="value" class="<?php echo $m_piket_list->value->headerCellClass() ?>"><div id="elh_m_piket_value" class="m_piket_value"><div class="ew-table-header-caption"><?php echo $m_piket_list->value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value" class="<?php echo $m_piket_list->value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_piket_list->SortUrl($m_piket_list->value) ?>', 1);"><div id="elh_m_piket_value" class="m_piket_value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_piket_list->value->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_piket_list->value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_piket_list->value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_piket_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_piket_list->ExportAll && $m_piket_list->isExport()) {
	$m_piket_list->StopRecord = $m_piket_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_piket_list->TotalRecords > $m_piket_list->StartRecord + $m_piket_list->DisplayRecords - 1)
		$m_piket_list->StopRecord = $m_piket_list->StartRecord + $m_piket_list->DisplayRecords - 1;
	else
		$m_piket_list->StopRecord = $m_piket_list->TotalRecords;
}
$m_piket_list->RecordCount = $m_piket_list->StartRecord - 1;
if ($m_piket_list->Recordset && !$m_piket_list->Recordset->EOF) {
	$m_piket_list->Recordset->moveFirst();
	$selectLimit = $m_piket_list->UseSelectLimit;
	if (!$selectLimit && $m_piket_list->StartRecord > 1)
		$m_piket_list->Recordset->move($m_piket_list->StartRecord - 1);
} elseif (!$m_piket->AllowAddDeleteRow && $m_piket_list->StopRecord == 0) {
	$m_piket_list->StopRecord = $m_piket->GridAddRowCount;
}

// Initialize aggregate
$m_piket->RowType = ROWTYPE_AGGREGATEINIT;
$m_piket->resetAttributes();
$m_piket_list->renderRow();
while ($m_piket_list->RecordCount < $m_piket_list->StopRecord) {
	$m_piket_list->RecordCount++;
	if ($m_piket_list->RecordCount >= $m_piket_list->StartRecord) {
		$m_piket_list->RowCount++;

		// Set up key count
		$m_piket_list->KeyCount = $m_piket_list->RowIndex;

		// Init row class and style
		$m_piket->resetAttributes();
		$m_piket->CssClass = "";
		if ($m_piket_list->isGridAdd()) {
		} else {
			$m_piket_list->loadRowValues($m_piket_list->Recordset); // Load row values
		}
		$m_piket->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_piket->RowAttrs->merge(["data-rowindex" => $m_piket_list->RowCount, "id" => "r" . $m_piket_list->RowCount . "_m_piket", "data-rowtype" => $m_piket->RowType]);

		// Render row
		$m_piket_list->renderRow();

		// Render list options
		$m_piket_list->renderListOptions();
?>
	<tr <?php echo $m_piket->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_piket_list->ListOptions->render("body", "left", $m_piket_list->RowCount);
?>
	<?php if ($m_piket_list->jenjang->Visible) { // jenjang ?>
		<td data-name="jenjang" <?php echo $m_piket_list->jenjang->cellAttributes() ?>>
<span id="el<?php echo $m_piket_list->RowCount ?>_m_piket_jenjang">
<span<?php echo $m_piket_list->jenjang->viewAttributes() ?>><?php echo $m_piket_list->jenjang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_piket_list->type_jabatan->Visible) { // type_jabatan ?>
		<td data-name="type_jabatan" <?php echo $m_piket_list->type_jabatan->cellAttributes() ?>>
<span id="el<?php echo $m_piket_list->RowCount ?>_m_piket_type_jabatan">
<span<?php echo $m_piket_list->type_jabatan->viewAttributes() ?>><?php echo $m_piket_list->type_jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_piket_list->jenis_sertif->Visible) { // jenis_sertif ?>
		<td data-name="jenis_sertif" <?php echo $m_piket_list->jenis_sertif->cellAttributes() ?>>
<span id="el<?php echo $m_piket_list->RowCount ?>_m_piket_jenis_sertif">
<span<?php echo $m_piket_list->jenis_sertif->viewAttributes() ?>><?php echo $m_piket_list->jenis_sertif->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_piket_list->value->Visible) { // value ?>
		<td data-name="value" <?php echo $m_piket_list->value->cellAttributes() ?>>
<span id="el<?php echo $m_piket_list->RowCount ?>_m_piket_value">
<span<?php echo $m_piket_list->value->viewAttributes() ?>><?php echo $m_piket_list->value->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_piket_list->ListOptions->render("body", "right", $m_piket_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_piket_list->isGridAdd())
		$m_piket_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_piket->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_piket_list->Recordset)
	$m_piket_list->Recordset->Close();
?>
<?php if (!$m_piket_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_piket_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_piket_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_piket_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_piket_list->TotalRecords == 0 && !$m_piket->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_piket_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_piket_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_piket_list->isExport()) { ?>
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
$m_piket_list->terminate();
?>