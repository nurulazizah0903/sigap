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
$m_kehadiran_list = new m_kehadiran_list();

// Run the page
$m_kehadiran_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_kehadiran_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_kehadiran_list->isExport()) { ?>
<script>
var fm_kehadiranlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_kehadiranlist = currentForm = new ew.Form("fm_kehadiranlist", "list");
	fm_kehadiranlist.formKeyCountName = '<?php echo $m_kehadiran_list->FormKeyCountName ?>';
	loadjs.done("fm_kehadiranlist");
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
<?php if (!$m_kehadiran_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_kehadiran_list->TotalRecords > 0 && $m_kehadiran_list->ExportOptions->visible()) { ?>
<?php $m_kehadiran_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_kehadiran_list->ImportOptions->visible()) { ?>
<?php $m_kehadiran_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_kehadiran_list->renderOtherOptions();
?>
<?php $m_kehadiran_list->showPageHeader(); ?>
<?php
$m_kehadiran_list->showMessage();
?>
<?php if ($m_kehadiran_list->TotalRecords > 0 || $m_kehadiran->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_kehadiran_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_kehadiran">
<?php if (!$m_kehadiran_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_kehadiran_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_kehadiran_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_kehadiran_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_kehadiranlist" id="fm_kehadiranlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_kehadiran">
<div id="gmp_m_kehadiran" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_kehadiran_list->TotalRecords > 0 || $m_kehadiran_list->isGridEdit()) { ?>
<table id="tbl_m_kehadiranlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_kehadiran->RowType = ROWTYPE_HEADER;

// Render list options
$m_kehadiran_list->renderListOptions();

// Render list options (header, left)
$m_kehadiran_list->ListOptions->render("header", "left");
?>
<?php if ($m_kehadiran_list->jenjang->Visible) { // jenjang ?>
	<?php if ($m_kehadiran_list->SortUrl($m_kehadiran_list->jenjang) == "") { ?>
		<th data-name="jenjang" class="<?php echo $m_kehadiran_list->jenjang->headerCellClass() ?>"><div id="elh_m_kehadiran_jenjang" class="m_kehadiran_jenjang"><div class="ew-table-header-caption"><?php echo $m_kehadiran_list->jenjang->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang" class="<?php echo $m_kehadiran_list->jenjang->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kehadiran_list->SortUrl($m_kehadiran_list->jenjang) ?>', 1);"><div id="elh_m_kehadiran_jenjang" class="m_kehadiran_jenjang">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kehadiran_list->jenjang->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_kehadiran_list->jenjang->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kehadiran_list->jenjang->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_kehadiran_list->jenis_jabatan->Visible) { // jenis_jabatan ?>
	<?php if ($m_kehadiran_list->SortUrl($m_kehadiran_list->jenis_jabatan) == "") { ?>
		<th data-name="jenis_jabatan" class="<?php echo $m_kehadiran_list->jenis_jabatan->headerCellClass() ?>"><div id="elh_m_kehadiran_jenis_jabatan" class="m_kehadiran_jenis_jabatan"><div class="ew-table-header-caption"><?php echo $m_kehadiran_list->jenis_jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_jabatan" class="<?php echo $m_kehadiran_list->jenis_jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kehadiran_list->SortUrl($m_kehadiran_list->jenis_jabatan) ?>', 1);"><div id="elh_m_kehadiran_jenis_jabatan" class="m_kehadiran_jenis_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kehadiran_list->jenis_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_kehadiran_list->jenis_jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kehadiran_list->jenis_jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_kehadiran_list->jabatan->Visible) { // jabatan ?>
	<?php if ($m_kehadiran_list->SortUrl($m_kehadiran_list->jabatan) == "") { ?>
		<th data-name="jabatan" class="<?php echo $m_kehadiran_list->jabatan->headerCellClass() ?>"><div id="elh_m_kehadiran_jabatan" class="m_kehadiran_jabatan"><div class="ew-table-header-caption"><?php echo $m_kehadiran_list->jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan" class="<?php echo $m_kehadiran_list->jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kehadiran_list->SortUrl($m_kehadiran_list->jabatan) ?>', 1);"><div id="elh_m_kehadiran_jabatan" class="m_kehadiran_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kehadiran_list->jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_kehadiran_list->jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kehadiran_list->jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_kehadiran_list->sertif->Visible) { // sertif ?>
	<?php if ($m_kehadiran_list->SortUrl($m_kehadiran_list->sertif) == "") { ?>
		<th data-name="sertif" class="<?php echo $m_kehadiran_list->sertif->headerCellClass() ?>"><div id="elh_m_kehadiran_sertif" class="m_kehadiran_sertif"><div class="ew-table-header-caption"><?php echo $m_kehadiran_list->sertif->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sertif" class="<?php echo $m_kehadiran_list->sertif->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kehadiran_list->SortUrl($m_kehadiran_list->sertif) ?>', 1);"><div id="elh_m_kehadiran_sertif" class="m_kehadiran_sertif">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kehadiran_list->sertif->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_kehadiran_list->sertif->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kehadiran_list->sertif->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_kehadiran_list->value->Visible) { // value ?>
	<?php if ($m_kehadiran_list->SortUrl($m_kehadiran_list->value) == "") { ?>
		<th data-name="value" class="<?php echo $m_kehadiran_list->value->headerCellClass() ?>"><div id="elh_m_kehadiran_value" class="m_kehadiran_value"><div class="ew-table-header-caption"><?php echo $m_kehadiran_list->value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value" class="<?php echo $m_kehadiran_list->value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_kehadiran_list->SortUrl($m_kehadiran_list->value) ?>', 1);"><div id="elh_m_kehadiran_value" class="m_kehadiran_value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_kehadiran_list->value->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_kehadiran_list->value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_kehadiran_list->value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_kehadiran_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_kehadiran_list->ExportAll && $m_kehadiran_list->isExport()) {
	$m_kehadiran_list->StopRecord = $m_kehadiran_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_kehadiran_list->TotalRecords > $m_kehadiran_list->StartRecord + $m_kehadiran_list->DisplayRecords - 1)
		$m_kehadiran_list->StopRecord = $m_kehadiran_list->StartRecord + $m_kehadiran_list->DisplayRecords - 1;
	else
		$m_kehadiran_list->StopRecord = $m_kehadiran_list->TotalRecords;
}
$m_kehadiran_list->RecordCount = $m_kehadiran_list->StartRecord - 1;
if ($m_kehadiran_list->Recordset && !$m_kehadiran_list->Recordset->EOF) {
	$m_kehadiran_list->Recordset->moveFirst();
	$selectLimit = $m_kehadiran_list->UseSelectLimit;
	if (!$selectLimit && $m_kehadiran_list->StartRecord > 1)
		$m_kehadiran_list->Recordset->move($m_kehadiran_list->StartRecord - 1);
} elseif (!$m_kehadiran->AllowAddDeleteRow && $m_kehadiran_list->StopRecord == 0) {
	$m_kehadiran_list->StopRecord = $m_kehadiran->GridAddRowCount;
}

// Initialize aggregate
$m_kehadiran->RowType = ROWTYPE_AGGREGATEINIT;
$m_kehadiran->resetAttributes();
$m_kehadiran_list->renderRow();
while ($m_kehadiran_list->RecordCount < $m_kehadiran_list->StopRecord) {
	$m_kehadiran_list->RecordCount++;
	if ($m_kehadiran_list->RecordCount >= $m_kehadiran_list->StartRecord) {
		$m_kehadiran_list->RowCount++;

		// Set up key count
		$m_kehadiran_list->KeyCount = $m_kehadiran_list->RowIndex;

		// Init row class and style
		$m_kehadiran->resetAttributes();
		$m_kehadiran->CssClass = "";
		if ($m_kehadiran_list->isGridAdd()) {
		} else {
			$m_kehadiran_list->loadRowValues($m_kehadiran_list->Recordset); // Load row values
		}
		$m_kehadiran->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_kehadiran->RowAttrs->merge(["data-rowindex" => $m_kehadiran_list->RowCount, "id" => "r" . $m_kehadiran_list->RowCount . "_m_kehadiran", "data-rowtype" => $m_kehadiran->RowType]);

		// Render row
		$m_kehadiran_list->renderRow();

		// Render list options
		$m_kehadiran_list->renderListOptions();
?>
	<tr <?php echo $m_kehadiran->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_kehadiran_list->ListOptions->render("body", "left", $m_kehadiran_list->RowCount);
?>
	<?php if ($m_kehadiran_list->jenjang->Visible) { // jenjang ?>
		<td data-name="jenjang" <?php echo $m_kehadiran_list->jenjang->cellAttributes() ?>>
<span id="el<?php echo $m_kehadiran_list->RowCount ?>_m_kehadiran_jenjang">
<span<?php echo $m_kehadiran_list->jenjang->viewAttributes() ?>><?php echo $m_kehadiran_list->jenjang->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_kehadiran_list->jenis_jabatan->Visible) { // jenis_jabatan ?>
		<td data-name="jenis_jabatan" <?php echo $m_kehadiran_list->jenis_jabatan->cellAttributes() ?>>
<span id="el<?php echo $m_kehadiran_list->RowCount ?>_m_kehadiran_jenis_jabatan">
<span<?php echo $m_kehadiran_list->jenis_jabatan->viewAttributes() ?>><?php echo $m_kehadiran_list->jenis_jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_kehadiran_list->jabatan->Visible) { // jabatan ?>
		<td data-name="jabatan" <?php echo $m_kehadiran_list->jabatan->cellAttributes() ?>>
<span id="el<?php echo $m_kehadiran_list->RowCount ?>_m_kehadiran_jabatan">
<span<?php echo $m_kehadiran_list->jabatan->viewAttributes() ?>><?php echo $m_kehadiran_list->jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_kehadiran_list->sertif->Visible) { // sertif ?>
		<td data-name="sertif" <?php echo $m_kehadiran_list->sertif->cellAttributes() ?>>
<span id="el<?php echo $m_kehadiran_list->RowCount ?>_m_kehadiran_sertif">
<span<?php echo $m_kehadiran_list->sertif->viewAttributes() ?>><?php echo $m_kehadiran_list->sertif->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_kehadiran_list->value->Visible) { // value ?>
		<td data-name="value" <?php echo $m_kehadiran_list->value->cellAttributes() ?>>
<span id="el<?php echo $m_kehadiran_list->RowCount ?>_m_kehadiran_value">
<span<?php echo $m_kehadiran_list->value->viewAttributes() ?>><?php echo $m_kehadiran_list->value->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_kehadiran_list->ListOptions->render("body", "right", $m_kehadiran_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_kehadiran_list->isGridAdd())
		$m_kehadiran_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_kehadiran->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_kehadiran_list->Recordset)
	$m_kehadiran_list->Recordset->Close();
?>
<?php if (!$m_kehadiran_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_kehadiran_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_kehadiran_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_kehadiran_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_kehadiran_list->TotalRecords == 0 && !$m_kehadiran->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_kehadiran_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_kehadiran_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_kehadiran_list->isExport()) { ?>
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
$m_kehadiran_list->terminate();
?>