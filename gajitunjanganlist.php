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
$gajitunjangan_list = new gajitunjangan_list();

// Run the page
$gajitunjangan_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitunjangan_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajitunjangan_list->isExport()) { ?>
<script>
var fgajitunjanganlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgajitunjanganlist = currentForm = new ew.Form("fgajitunjanganlist", "list");
	fgajitunjanganlist.formKeyCountName = '<?php echo $gajitunjangan_list->FormKeyCountName ?>';
	loadjs.done("fgajitunjanganlist");
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
<?php if (!$gajitunjangan_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gajitunjangan_list->TotalRecords > 0 && $gajitunjangan_list->ExportOptions->visible()) { ?>
<?php $gajitunjangan_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gajitunjangan_list->ImportOptions->visible()) { ?>
<?php $gajitunjangan_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$gajitunjangan_list->isExport() || Config("EXPORT_MASTER_RECORD") && $gajitunjangan_list->isExport("print")) { ?>
<?php
if ($gajitunjangan_list->DbMasterFilter != "" && $gajitunjangan->getCurrentMasterTable() == "jabatan") {
	if ($gajitunjangan_list->MasterRecordExists) {
		include_once "jabatanmaster.php";
	}
}
?>
<?php } ?>
<?php
$gajitunjangan_list->renderOtherOptions();
?>
<?php $gajitunjangan_list->showPageHeader(); ?>
<?php
$gajitunjangan_list->showMessage();
?>
<?php if ($gajitunjangan_list->TotalRecords > 0 || $gajitunjangan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gajitunjangan_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajitunjangan">
<?php if (!$gajitunjangan_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gajitunjangan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajitunjangan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajitunjangan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgajitunjanganlist" id="fgajitunjanganlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajitunjangan">
<?php if ($gajitunjangan->getCurrentMasterTable() == "jabatan" && $gajitunjangan->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="jabatan">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($gajitunjangan_list->pidjabatan->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_gajitunjangan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gajitunjangan_list->TotalRecords > 0 || $gajitunjangan_list->isGridEdit()) { ?>
<table id="tbl_gajitunjanganlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gajitunjangan->RowType = ROWTYPE_HEADER;

// Render list options
$gajitunjangan_list->renderListOptions();

// Render list options (header, left)
$gajitunjangan_list->ListOptions->render("header", "left");
?>
<?php if ($gajitunjangan_list->pidjabatan->Visible) { // pidjabatan ?>
	<?php if ($gajitunjangan_list->SortUrl($gajitunjangan_list->pidjabatan) == "") { ?>
		<th data-name="pidjabatan" class="<?php echo $gajitunjangan_list->pidjabatan->headerCellClass() ?>"><div id="elh_gajitunjangan_pidjabatan" class="gajitunjangan_pidjabatan"><div class="ew-table-header-caption"><?php echo $gajitunjangan_list->pidjabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pidjabatan" class="<?php echo $gajitunjangan_list->pidjabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitunjangan_list->SortUrl($gajitunjangan_list->pidjabatan) ?>', 1);"><div id="elh_gajitunjangan_pidjabatan" class="gajitunjangan_pidjabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_list->pidjabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_list->pidjabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_list->pidjabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_list->value_kehadiran->Visible) { // value_kehadiran ?>
	<?php if ($gajitunjangan_list->SortUrl($gajitunjangan_list->value_kehadiran) == "") { ?>
		<th data-name="value_kehadiran" class="<?php echo $gajitunjangan_list->value_kehadiran->headerCellClass() ?>"><div id="elh_gajitunjangan_value_kehadiran" class="gajitunjangan_value_kehadiran"><div class="ew-table-header-caption"><?php echo $gajitunjangan_list->value_kehadiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_kehadiran" class="<?php echo $gajitunjangan_list->value_kehadiran->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitunjangan_list->SortUrl($gajitunjangan_list->value_kehadiran) ?>', 1);"><div id="elh_gajitunjangan_value_kehadiran" class="gajitunjangan_value_kehadiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_list->value_kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_list->value_kehadiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_list->value_kehadiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_list->gapok->Visible) { // gapok ?>
	<?php if ($gajitunjangan_list->SortUrl($gajitunjangan_list->gapok) == "") { ?>
		<th data-name="gapok" class="<?php echo $gajitunjangan_list->gapok->headerCellClass() ?>"><div id="elh_gajitunjangan_gapok" class="gajitunjangan_gapok"><div class="ew-table-header-caption"><?php echo $gajitunjangan_list->gapok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gapok" class="<?php echo $gajitunjangan_list->gapok->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitunjangan_list->SortUrl($gajitunjangan_list->gapok) ?>', 1);"><div id="elh_gajitunjangan_gapok" class="gajitunjangan_gapok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_list->gapok->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_list->gapok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_list->gapok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_list->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
	<?php if ($gajitunjangan_list->SortUrl($gajitunjangan_list->tunjangan_jabatan) == "") { ?>
		<th data-name="tunjangan_jabatan" class="<?php echo $gajitunjangan_list->tunjangan_jabatan->headerCellClass() ?>"><div id="elh_gajitunjangan_tunjangan_jabatan" class="gajitunjangan_tunjangan_jabatan"><div class="ew-table-header-caption"><?php echo $gajitunjangan_list->tunjangan_jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tunjangan_jabatan" class="<?php echo $gajitunjangan_list->tunjangan_jabatan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitunjangan_list->SortUrl($gajitunjangan_list->tunjangan_jabatan) ?>', 1);"><div id="elh_gajitunjangan_tunjangan_jabatan" class="gajitunjangan_tunjangan_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_list->tunjangan_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_list->tunjangan_jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_list->tunjangan_jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_list->reward->Visible) { // reward ?>
	<?php if ($gajitunjangan_list->SortUrl($gajitunjangan_list->reward) == "") { ?>
		<th data-name="reward" class="<?php echo $gajitunjangan_list->reward->headerCellClass() ?>"><div id="elh_gajitunjangan_reward" class="gajitunjangan_reward"><div class="ew-table-header-caption"><?php echo $gajitunjangan_list->reward->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="reward" class="<?php echo $gajitunjangan_list->reward->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitunjangan_list->SortUrl($gajitunjangan_list->reward) ?>', 1);"><div id="elh_gajitunjangan_reward" class="gajitunjangan_reward">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_list->reward->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_list->reward->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_list->reward->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_list->lembur->Visible) { // lembur ?>
	<?php if ($gajitunjangan_list->SortUrl($gajitunjangan_list->lembur) == "") { ?>
		<th data-name="lembur" class="<?php echo $gajitunjangan_list->lembur->headerCellClass() ?>"><div id="elh_gajitunjangan_lembur" class="gajitunjangan_lembur"><div class="ew-table-header-caption"><?php echo $gajitunjangan_list->lembur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lembur" class="<?php echo $gajitunjangan_list->lembur->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitunjangan_list->SortUrl($gajitunjangan_list->lembur) ?>', 1);"><div id="elh_gajitunjangan_lembur" class="gajitunjangan_lembur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_list->lembur->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_list->lembur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_list->lembur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_list->piket->Visible) { // piket ?>
	<?php if ($gajitunjangan_list->SortUrl($gajitunjangan_list->piket) == "") { ?>
		<th data-name="piket" class="<?php echo $gajitunjangan_list->piket->headerCellClass() ?>"><div id="elh_gajitunjangan_piket" class="gajitunjangan_piket"><div class="ew-table-header-caption"><?php echo $gajitunjangan_list->piket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="piket" class="<?php echo $gajitunjangan_list->piket->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitunjangan_list->SortUrl($gajitunjangan_list->piket) ?>', 1);"><div id="elh_gajitunjangan_piket" class="gajitunjangan_piket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_list->piket->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_list->piket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_list->piket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_list->inval->Visible) { // inval ?>
	<?php if ($gajitunjangan_list->SortUrl($gajitunjangan_list->inval) == "") { ?>
		<th data-name="inval" class="<?php echo $gajitunjangan_list->inval->headerCellClass() ?>"><div id="elh_gajitunjangan_inval" class="gajitunjangan_inval"><div class="ew-table-header-caption"><?php echo $gajitunjangan_list->inval->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inval" class="<?php echo $gajitunjangan_list->inval->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitunjangan_list->SortUrl($gajitunjangan_list->inval) ?>', 1);"><div id="elh_gajitunjangan_inval" class="gajitunjangan_inval">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_list->inval->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_list->inval->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_list->inval->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_list->jam_lebih->Visible) { // jam_lebih ?>
	<?php if ($gajitunjangan_list->SortUrl($gajitunjangan_list->jam_lebih) == "") { ?>
		<th data-name="jam_lebih" class="<?php echo $gajitunjangan_list->jam_lebih->headerCellClass() ?>"><div id="elh_gajitunjangan_jam_lebih" class="gajitunjangan_jam_lebih"><div class="ew-table-header-caption"><?php echo $gajitunjangan_list->jam_lebih->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jam_lebih" class="<?php echo $gajitunjangan_list->jam_lebih->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitunjangan_list->SortUrl($gajitunjangan_list->jam_lebih) ?>', 1);"><div id="elh_gajitunjangan_jam_lebih" class="gajitunjangan_jam_lebih">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_list->jam_lebih->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_list->jam_lebih->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_list->jam_lebih->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_list->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
	<?php if ($gajitunjangan_list->SortUrl($gajitunjangan_list->tunjangan_khusus) == "") { ?>
		<th data-name="tunjangan_khusus" class="<?php echo $gajitunjangan_list->tunjangan_khusus->headerCellClass() ?>"><div id="elh_gajitunjangan_tunjangan_khusus" class="gajitunjangan_tunjangan_khusus"><div class="ew-table-header-caption"><?php echo $gajitunjangan_list->tunjangan_khusus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tunjangan_khusus" class="<?php echo $gajitunjangan_list->tunjangan_khusus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitunjangan_list->SortUrl($gajitunjangan_list->tunjangan_khusus) ?>', 1);"><div id="elh_gajitunjangan_tunjangan_khusus" class="gajitunjangan_tunjangan_khusus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_list->tunjangan_khusus->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_list->tunjangan_khusus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_list->tunjangan_khusus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_list->ekstrakuri->Visible) { // ekstrakuri ?>
	<?php if ($gajitunjangan_list->SortUrl($gajitunjangan_list->ekstrakuri) == "") { ?>
		<th data-name="ekstrakuri" class="<?php echo $gajitunjangan_list->ekstrakuri->headerCellClass() ?>"><div id="elh_gajitunjangan_ekstrakuri" class="gajitunjangan_ekstrakuri"><div class="ew-table-header-caption"><?php echo $gajitunjangan_list->ekstrakuri->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ekstrakuri" class="<?php echo $gajitunjangan_list->ekstrakuri->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajitunjangan_list->SortUrl($gajitunjangan_list->ekstrakuri) ?>', 1);"><div id="elh_gajitunjangan_ekstrakuri" class="gajitunjangan_ekstrakuri">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_list->ekstrakuri->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_list->ekstrakuri->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_list->ekstrakuri->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajitunjangan_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gajitunjangan_list->ExportAll && $gajitunjangan_list->isExport()) {
	$gajitunjangan_list->StopRecord = $gajitunjangan_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gajitunjangan_list->TotalRecords > $gajitunjangan_list->StartRecord + $gajitunjangan_list->DisplayRecords - 1)
		$gajitunjangan_list->StopRecord = $gajitunjangan_list->StartRecord + $gajitunjangan_list->DisplayRecords - 1;
	else
		$gajitunjangan_list->StopRecord = $gajitunjangan_list->TotalRecords;
}
$gajitunjangan_list->RecordCount = $gajitunjangan_list->StartRecord - 1;
if ($gajitunjangan_list->Recordset && !$gajitunjangan_list->Recordset->EOF) {
	$gajitunjangan_list->Recordset->moveFirst();
	$selectLimit = $gajitunjangan_list->UseSelectLimit;
	if (!$selectLimit && $gajitunjangan_list->StartRecord > 1)
		$gajitunjangan_list->Recordset->move($gajitunjangan_list->StartRecord - 1);
} elseif (!$gajitunjangan->AllowAddDeleteRow && $gajitunjangan_list->StopRecord == 0) {
	$gajitunjangan_list->StopRecord = $gajitunjangan->GridAddRowCount;
}

// Initialize aggregate
$gajitunjangan->RowType = ROWTYPE_AGGREGATEINIT;
$gajitunjangan->resetAttributes();
$gajitunjangan_list->renderRow();
while ($gajitunjangan_list->RecordCount < $gajitunjangan_list->StopRecord) {
	$gajitunjangan_list->RecordCount++;
	if ($gajitunjangan_list->RecordCount >= $gajitunjangan_list->StartRecord) {
		$gajitunjangan_list->RowCount++;

		// Set up key count
		$gajitunjangan_list->KeyCount = $gajitunjangan_list->RowIndex;

		// Init row class and style
		$gajitunjangan->resetAttributes();
		$gajitunjangan->CssClass = "";
		if ($gajitunjangan_list->isGridAdd()) {
		} else {
			$gajitunjangan_list->loadRowValues($gajitunjangan_list->Recordset); // Load row values
		}
		$gajitunjangan->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gajitunjangan->RowAttrs->merge(["data-rowindex" => $gajitunjangan_list->RowCount, "id" => "r" . $gajitunjangan_list->RowCount . "_gajitunjangan", "data-rowtype" => $gajitunjangan->RowType]);

		// Render row
		$gajitunjangan_list->renderRow();

		// Render list options
		$gajitunjangan_list->renderListOptions();
?>
	<tr <?php echo $gajitunjangan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajitunjangan_list->ListOptions->render("body", "left", $gajitunjangan_list->RowCount);
?>
	<?php if ($gajitunjangan_list->pidjabatan->Visible) { // pidjabatan ?>
		<td data-name="pidjabatan" <?php echo $gajitunjangan_list->pidjabatan->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_list->RowCount ?>_gajitunjangan_pidjabatan">
<span<?php echo $gajitunjangan_list->pidjabatan->viewAttributes() ?>><?php echo $gajitunjangan_list->pidjabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_list->value_kehadiran->Visible) { // value_kehadiran ?>
		<td data-name="value_kehadiran" <?php echo $gajitunjangan_list->value_kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_list->RowCount ?>_gajitunjangan_value_kehadiran">
<span<?php echo $gajitunjangan_list->value_kehadiran->viewAttributes() ?>><?php echo $gajitunjangan_list->value_kehadiran->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_list->gapok->Visible) { // gapok ?>
		<td data-name="gapok" <?php echo $gajitunjangan_list->gapok->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_list->RowCount ?>_gajitunjangan_gapok">
<span<?php echo $gajitunjangan_list->gapok->viewAttributes() ?>><?php echo $gajitunjangan_list->gapok->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_list->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
		<td data-name="tunjangan_jabatan" <?php echo $gajitunjangan_list->tunjangan_jabatan->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_list->RowCount ?>_gajitunjangan_tunjangan_jabatan">
<span<?php echo $gajitunjangan_list->tunjangan_jabatan->viewAttributes() ?>><?php echo $gajitunjangan_list->tunjangan_jabatan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_list->reward->Visible) { // reward ?>
		<td data-name="reward" <?php echo $gajitunjangan_list->reward->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_list->RowCount ?>_gajitunjangan_reward">
<span<?php echo $gajitunjangan_list->reward->viewAttributes() ?>><?php echo $gajitunjangan_list->reward->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_list->lembur->Visible) { // lembur ?>
		<td data-name="lembur" <?php echo $gajitunjangan_list->lembur->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_list->RowCount ?>_gajitunjangan_lembur">
<span<?php echo $gajitunjangan_list->lembur->viewAttributes() ?>><?php echo $gajitunjangan_list->lembur->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_list->piket->Visible) { // piket ?>
		<td data-name="piket" <?php echo $gajitunjangan_list->piket->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_list->RowCount ?>_gajitunjangan_piket">
<span<?php echo $gajitunjangan_list->piket->viewAttributes() ?>><?php echo $gajitunjangan_list->piket->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_list->inval->Visible) { // inval ?>
		<td data-name="inval" <?php echo $gajitunjangan_list->inval->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_list->RowCount ?>_gajitunjangan_inval">
<span<?php echo $gajitunjangan_list->inval->viewAttributes() ?>><?php echo $gajitunjangan_list->inval->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_list->jam_lebih->Visible) { // jam_lebih ?>
		<td data-name="jam_lebih" <?php echo $gajitunjangan_list->jam_lebih->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_list->RowCount ?>_gajitunjangan_jam_lebih">
<span<?php echo $gajitunjangan_list->jam_lebih->viewAttributes() ?>><?php echo $gajitunjangan_list->jam_lebih->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_list->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
		<td data-name="tunjangan_khusus" <?php echo $gajitunjangan_list->tunjangan_khusus->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_list->RowCount ?>_gajitunjangan_tunjangan_khusus">
<span<?php echo $gajitunjangan_list->tunjangan_khusus->viewAttributes() ?>><?php echo $gajitunjangan_list->tunjangan_khusus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_list->ekstrakuri->Visible) { // ekstrakuri ?>
		<td data-name="ekstrakuri" <?php echo $gajitunjangan_list->ekstrakuri->cellAttributes() ?>>
<span id="el<?php echo $gajitunjangan_list->RowCount ?>_gajitunjangan_ekstrakuri">
<span<?php echo $gajitunjangan_list->ekstrakuri->viewAttributes() ?>><?php echo $gajitunjangan_list->ekstrakuri->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajitunjangan_list->ListOptions->render("body", "right", $gajitunjangan_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gajitunjangan_list->isGridAdd())
		$gajitunjangan_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gajitunjangan->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gajitunjangan_list->Recordset)
	$gajitunjangan_list->Recordset->Close();
?>
<?php if (!$gajitunjangan_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gajitunjangan_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajitunjangan_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajitunjangan_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gajitunjangan_list->TotalRecords == 0 && !$gajitunjangan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gajitunjangan_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gajitunjangan_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajitunjangan_list->isExport()) { ?>
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
$gajitunjangan_list->terminate();
?>