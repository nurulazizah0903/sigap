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
$gajisma_detil_list = new gajisma_detil_list();

// Run the page
$gajisma_detil_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajisma_detil_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajisma_detil_list->isExport()) { ?>
<script>
var fgajisma_detillist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgajisma_detillist = currentForm = new ew.Form("fgajisma_detillist", "list");
	fgajisma_detillist.formKeyCountName = '<?php echo $gajisma_detil_list->FormKeyCountName ?>';
	loadjs.done("fgajisma_detillist");
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
<?php if (!$gajisma_detil_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gajisma_detil_list->TotalRecords > 0 && $gajisma_detil_list->ExportOptions->visible()) { ?>
<?php $gajisma_detil_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gajisma_detil_list->ImportOptions->visible()) { ?>
<?php $gajisma_detil_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$gajisma_detil_list->isExport() || Config("EXPORT_MASTER_RECORD") && $gajisma_detil_list->isExport("print")) { ?>
<?php
if ($gajisma_detil_list->DbMasterFilter != "" && $gajisma_detil->getCurrentMasterTable() == "gajisma") {
	if ($gajisma_detil_list->MasterRecordExists) {
		include_once "gajismamaster.php";
	}
}
?>
<?php } ?>
<?php
$gajisma_detil_list->renderOtherOptions();
?>
<?php $gajisma_detil_list->showPageHeader(); ?>
<?php
$gajisma_detil_list->showMessage();
?>
<?php if ($gajisma_detil_list->TotalRecords > 0 || $gajisma_detil->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gajisma_detil_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajisma_detil">
<?php if (!$gajisma_detil_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gajisma_detil_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajisma_detil_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajisma_detil_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgajisma_detillist" id="fgajisma_detillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajisma_detil">
<?php if ($gajisma_detil->getCurrentMasterTable() == "gajisma" && $gajisma_detil->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="gajisma">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($gajisma_detil_list->pid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_gajisma_detil" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gajisma_detil_list->TotalRecords > 0 || $gajisma_detil_list->isGridEdit()) { ?>
<table id="tbl_gajisma_detillist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gajisma_detil->RowType = ROWTYPE_HEADER;

// Render list options
$gajisma_detil_list->renderListOptions();

// Render list options (header, left)
$gajisma_detil_list->ListOptions->render("header", "left");
?>
<?php if ($gajisma_detil_list->id->Visible) { // id ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $gajisma_detil_list->id->headerCellClass() ?>"><div id="elh_gajisma_detil_id" class="gajisma_detil_id"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $gajisma_detil_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->id) ?>', 1);"><div id="elh_gajisma_detil_id" class="gajisma_detil_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->pid->Visible) { // pid ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->pid) == "") { ?>
		<th data-name="pid" class="<?php echo $gajisma_detil_list->pid->headerCellClass() ?>"><div id="elh_gajisma_detil_pid" class="gajisma_detil_pid"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->pid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid" class="<?php echo $gajisma_detil_list->pid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->pid) ?>', 1);"><div id="elh_gajisma_detil_pid" class="gajisma_detil_pid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->pid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->pid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->pegawai_id->Visible) { // pegawai_id ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->pegawai_id) == "") { ?>
		<th data-name="pegawai_id" class="<?php echo $gajisma_detil_list->pegawai_id->headerCellClass() ?>"><div id="elh_gajisma_detil_pegawai_id" class="gajisma_detil_pegawai_id"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->pegawai_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai_id" class="<?php echo $gajisma_detil_list->pegawai_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->pegawai_id) ?>', 1);"><div id="elh_gajisma_detil_pegawai_id" class="gajisma_detil_pegawai_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->pegawai_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->pegawai_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->pegawai_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->jabatan_id) == "") { ?>
		<th data-name="jabatan_id" class="<?php echo $gajisma_detil_list->jabatan_id->headerCellClass() ?>"><div id="elh_gajisma_detil_jabatan_id" class="gajisma_detil_jabatan_id"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->jabatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan_id" class="<?php echo $gajisma_detil_list->jabatan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->jabatan_id) ?>', 1);"><div id="elh_gajisma_detil_jabatan_id" class="gajisma_detil_jabatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->jabatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->jabatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->masakerja->Visible) { // masakerja ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->masakerja) == "") { ?>
		<th data-name="masakerja" class="<?php echo $gajisma_detil_list->masakerja->headerCellClass() ?>"><div id="elh_gajisma_detil_masakerja" class="gajisma_detil_masakerja"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->masakerja->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masakerja" class="<?php echo $gajisma_detil_list->masakerja->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->masakerja) ?>', 1);"><div id="elh_gajisma_detil_masakerja" class="gajisma_detil_masakerja">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->masakerja->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->masakerja->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->masakerja->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->jumngajar->Visible) { // jumngajar ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->jumngajar) == "") { ?>
		<th data-name="jumngajar" class="<?php echo $gajisma_detil_list->jumngajar->headerCellClass() ?>"><div id="elh_gajisma_detil_jumngajar" class="gajisma_detil_jumngajar"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->jumngajar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumngajar" class="<?php echo $gajisma_detil_list->jumngajar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->jumngajar) ?>', 1);"><div id="elh_gajisma_detil_jumngajar" class="gajisma_detil_jumngajar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->jumngajar->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->jumngajar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->jumngajar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->ijin->Visible) { // ijin ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->ijin) == "") { ?>
		<th data-name="ijin" class="<?php echo $gajisma_detil_list->ijin->headerCellClass() ?>"><div id="elh_gajisma_detil_ijin" class="gajisma_detil_ijin"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->ijin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ijin" class="<?php echo $gajisma_detil_list->ijin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->ijin) ?>', 1);"><div id="elh_gajisma_detil_ijin" class="gajisma_detil_ijin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->ijin->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->ijin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->ijin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->tunjangan_wkosis) == "") { ?>
		<th data-name="tunjangan_wkosis" class="<?php echo $gajisma_detil_list->tunjangan_wkosis->headerCellClass() ?>"><div id="elh_gajisma_detil_tunjangan_wkosis" class="gajisma_detil_tunjangan_wkosis"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->tunjangan_wkosis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tunjangan_wkosis" class="<?php echo $gajisma_detil_list->tunjangan_wkosis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->tunjangan_wkosis) ?>', 1);"><div id="elh_gajisma_detil_tunjangan_wkosis" class="gajisma_detil_tunjangan_wkosis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->tunjangan_wkosis->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->tunjangan_wkosis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->tunjangan_wkosis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->nominal_baku->Visible) { // nominal_baku ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->nominal_baku) == "") { ?>
		<th data-name="nominal_baku" class="<?php echo $gajisma_detil_list->nominal_baku->headerCellClass() ?>"><div id="elh_gajisma_detil_nominal_baku" class="gajisma_detil_nominal_baku"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->nominal_baku->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nominal_baku" class="<?php echo $gajisma_detil_list->nominal_baku->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->nominal_baku) ?>', 1);"><div id="elh_gajisma_detil_nominal_baku" class="gajisma_detil_nominal_baku">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->nominal_baku->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->nominal_baku->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->nominal_baku->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->baku->Visible) { // baku ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->baku) == "") { ?>
		<th data-name="baku" class="<?php echo $gajisma_detil_list->baku->headerCellClass() ?>"><div id="elh_gajisma_detil_baku" class="gajisma_detil_baku"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->baku->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="baku" class="<?php echo $gajisma_detil_list->baku->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->baku) ?>', 1);"><div id="elh_gajisma_detil_baku" class="gajisma_detil_baku">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->baku->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->baku->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->baku->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->kehadiran->Visible) { // kehadiran ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->kehadiran) == "") { ?>
		<th data-name="kehadiran" class="<?php echo $gajisma_detil_list->kehadiran->headerCellClass() ?>"><div id="elh_gajisma_detil_kehadiran" class="gajisma_detil_kehadiran"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->kehadiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kehadiran" class="<?php echo $gajisma_detil_list->kehadiran->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->kehadiran) ?>', 1);"><div id="elh_gajisma_detil_kehadiran" class="gajisma_detil_kehadiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->kehadiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->kehadiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->prestasi->Visible) { // prestasi ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->prestasi) == "") { ?>
		<th data-name="prestasi" class="<?php echo $gajisma_detil_list->prestasi->headerCellClass() ?>"><div id="elh_gajisma_detil_prestasi" class="gajisma_detil_prestasi"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->prestasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prestasi" class="<?php echo $gajisma_detil_list->prestasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->prestasi) ?>', 1);"><div id="elh_gajisma_detil_prestasi" class="gajisma_detil_prestasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->prestasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->prestasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->prestasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->jumlahgaji->Visible) { // jumlahgaji ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->jumlahgaji) == "") { ?>
		<th data-name="jumlahgaji" class="<?php echo $gajisma_detil_list->jumlahgaji->headerCellClass() ?>"><div id="elh_gajisma_detil_jumlahgaji" class="gajisma_detil_jumlahgaji"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->jumlahgaji->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlahgaji" class="<?php echo $gajisma_detil_list->jumlahgaji->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->jumlahgaji) ?>', 1);"><div id="elh_gajisma_detil_jumlahgaji" class="gajisma_detil_jumlahgaji">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->jumlahgaji->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->jumlahgaji->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->jumlahgaji->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->jumgajitotal->Visible) { // jumgajitotal ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->jumgajitotal) == "") { ?>
		<th data-name="jumgajitotal" class="<?php echo $gajisma_detil_list->jumgajitotal->headerCellClass() ?>"><div id="elh_gajisma_detil_jumgajitotal" class="gajisma_detil_jumgajitotal"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->jumgajitotal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumgajitotal" class="<?php echo $gajisma_detil_list->jumgajitotal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->jumgajitotal) ?>', 1);"><div id="elh_gajisma_detil_jumgajitotal" class="gajisma_detil_jumgajitotal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->jumgajitotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->jumgajitotal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->jumgajitotal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->potongan1->Visible) { // potongan1 ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->potongan1) == "") { ?>
		<th data-name="potongan1" class="<?php echo $gajisma_detil_list->potongan1->headerCellClass() ?>"><div id="elh_gajisma_detil_potongan1" class="gajisma_detil_potongan1"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->potongan1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan1" class="<?php echo $gajisma_detil_list->potongan1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->potongan1) ?>', 1);"><div id="elh_gajisma_detil_potongan1" class="gajisma_detil_potongan1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->potongan1->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->potongan1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->potongan1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->potongan2->Visible) { // potongan2 ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->potongan2) == "") { ?>
		<th data-name="potongan2" class="<?php echo $gajisma_detil_list->potongan2->headerCellClass() ?>"><div id="elh_gajisma_detil_potongan2" class="gajisma_detil_potongan2"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->potongan2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan2" class="<?php echo $gajisma_detil_list->potongan2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->potongan2) ?>', 1);"><div id="elh_gajisma_detil_potongan2" class="gajisma_detil_potongan2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->potongan2->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->potongan2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->potongan2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_list->jumlahterima->Visible) { // jumlahterima ?>
	<?php if ($gajisma_detil_list->SortUrl($gajisma_detil_list->jumlahterima) == "") { ?>
		<th data-name="jumlahterima" class="<?php echo $gajisma_detil_list->jumlahterima->headerCellClass() ?>"><div id="elh_gajisma_detil_jumlahterima" class="gajisma_detil_jumlahterima"><div class="ew-table-header-caption"><?php echo $gajisma_detil_list->jumlahterima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlahterima" class="<?php echo $gajisma_detil_list->jumlahterima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisma_detil_list->SortUrl($gajisma_detil_list->jumlahterima) ?>', 1);"><div id="elh_gajisma_detil_jumlahterima" class="gajisma_detil_jumlahterima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_list->jumlahterima->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_list->jumlahterima->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_list->jumlahterima->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajisma_detil_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gajisma_detil_list->ExportAll && $gajisma_detil_list->isExport()) {
	$gajisma_detil_list->StopRecord = $gajisma_detil_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gajisma_detil_list->TotalRecords > $gajisma_detil_list->StartRecord + $gajisma_detil_list->DisplayRecords - 1)
		$gajisma_detil_list->StopRecord = $gajisma_detil_list->StartRecord + $gajisma_detil_list->DisplayRecords - 1;
	else
		$gajisma_detil_list->StopRecord = $gajisma_detil_list->TotalRecords;
}
$gajisma_detil_list->RecordCount = $gajisma_detil_list->StartRecord - 1;
if ($gajisma_detil_list->Recordset && !$gajisma_detil_list->Recordset->EOF) {
	$gajisma_detil_list->Recordset->moveFirst();
	$selectLimit = $gajisma_detil_list->UseSelectLimit;
	if (!$selectLimit && $gajisma_detil_list->StartRecord > 1)
		$gajisma_detil_list->Recordset->move($gajisma_detil_list->StartRecord - 1);
} elseif (!$gajisma_detil->AllowAddDeleteRow && $gajisma_detil_list->StopRecord == 0) {
	$gajisma_detil_list->StopRecord = $gajisma_detil->GridAddRowCount;
}

// Initialize aggregate
$gajisma_detil->RowType = ROWTYPE_AGGREGATEINIT;
$gajisma_detil->resetAttributes();
$gajisma_detil_list->renderRow();
while ($gajisma_detil_list->RecordCount < $gajisma_detil_list->StopRecord) {
	$gajisma_detil_list->RecordCount++;
	if ($gajisma_detil_list->RecordCount >= $gajisma_detil_list->StartRecord) {
		$gajisma_detil_list->RowCount++;

		// Set up key count
		$gajisma_detil_list->KeyCount = $gajisma_detil_list->RowIndex;

		// Init row class and style
		$gajisma_detil->resetAttributes();
		$gajisma_detil->CssClass = "";
		if ($gajisma_detil_list->isGridAdd()) {
		} else {
			$gajisma_detil_list->loadRowValues($gajisma_detil_list->Recordset); // Load row values
		}
		$gajisma_detil->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gajisma_detil->RowAttrs->merge(["data-rowindex" => $gajisma_detil_list->RowCount, "id" => "r" . $gajisma_detil_list->RowCount . "_gajisma_detil", "data-rowtype" => $gajisma_detil->RowType]);

		// Render row
		$gajisma_detil_list->renderRow();

		// Render list options
		$gajisma_detil_list->renderListOptions();
?>
	<tr <?php echo $gajisma_detil->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajisma_detil_list->ListOptions->render("body", "left", $gajisma_detil_list->RowCount);
?>
	<?php if ($gajisma_detil_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $gajisma_detil_list->id->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_id">
<span<?php echo $gajisma_detil_list->id->viewAttributes() ?>><?php echo $gajisma_detil_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->pid->Visible) { // pid ?>
		<td data-name="pid" <?php echo $gajisma_detil_list->pid->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_pid">
<span<?php echo $gajisma_detil_list->pid->viewAttributes() ?>><?php echo $gajisma_detil_list->pid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->pegawai_id->Visible) { // pegawai_id ?>
		<td data-name="pegawai_id" <?php echo $gajisma_detil_list->pegawai_id->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_pegawai_id">
<span<?php echo $gajisma_detil_list->pegawai_id->viewAttributes() ?>><?php echo $gajisma_detil_list->pegawai_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id" <?php echo $gajisma_detil_list->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_jabatan_id">
<span<?php echo $gajisma_detil_list->jabatan_id->viewAttributes() ?>><?php echo $gajisma_detil_list->jabatan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->masakerja->Visible) { // masakerja ?>
		<td data-name="masakerja" <?php echo $gajisma_detil_list->masakerja->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_masakerja">
<span<?php echo $gajisma_detil_list->masakerja->viewAttributes() ?>><?php echo $gajisma_detil_list->masakerja->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->jumngajar->Visible) { // jumngajar ?>
		<td data-name="jumngajar" <?php echo $gajisma_detil_list->jumngajar->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_jumngajar">
<span<?php echo $gajisma_detil_list->jumngajar->viewAttributes() ?>><?php echo $gajisma_detil_list->jumngajar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->ijin->Visible) { // ijin ?>
		<td data-name="ijin" <?php echo $gajisma_detil_list->ijin->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_ijin">
<span<?php echo $gajisma_detil_list->ijin->viewAttributes() ?>><?php echo $gajisma_detil_list->ijin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
		<td data-name="tunjangan_wkosis" <?php echo $gajisma_detil_list->tunjangan_wkosis->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_tunjangan_wkosis">
<span<?php echo $gajisma_detil_list->tunjangan_wkosis->viewAttributes() ?>><?php echo $gajisma_detil_list->tunjangan_wkosis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->nominal_baku->Visible) { // nominal_baku ?>
		<td data-name="nominal_baku" <?php echo $gajisma_detil_list->nominal_baku->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_nominal_baku">
<span<?php echo $gajisma_detil_list->nominal_baku->viewAttributes() ?>><?php echo $gajisma_detil_list->nominal_baku->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->baku->Visible) { // baku ?>
		<td data-name="baku" <?php echo $gajisma_detil_list->baku->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_baku">
<span<?php echo $gajisma_detil_list->baku->viewAttributes() ?>><?php echo $gajisma_detil_list->baku->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran" <?php echo $gajisma_detil_list->kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_kehadiran">
<span<?php echo $gajisma_detil_list->kehadiran->viewAttributes() ?>><?php echo $gajisma_detil_list->kehadiran->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->prestasi->Visible) { // prestasi ?>
		<td data-name="prestasi" <?php echo $gajisma_detil_list->prestasi->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_prestasi">
<span<?php echo $gajisma_detil_list->prestasi->viewAttributes() ?>><?php echo $gajisma_detil_list->prestasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->jumlahgaji->Visible) { // jumlahgaji ?>
		<td data-name="jumlahgaji" <?php echo $gajisma_detil_list->jumlahgaji->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_jumlahgaji">
<span<?php echo $gajisma_detil_list->jumlahgaji->viewAttributes() ?>><?php echo $gajisma_detil_list->jumlahgaji->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->jumgajitotal->Visible) { // jumgajitotal ?>
		<td data-name="jumgajitotal" <?php echo $gajisma_detil_list->jumgajitotal->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_jumgajitotal">
<span<?php echo $gajisma_detil_list->jumgajitotal->viewAttributes() ?>><?php echo $gajisma_detil_list->jumgajitotal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->potongan1->Visible) { // potongan1 ?>
		<td data-name="potongan1" <?php echo $gajisma_detil_list->potongan1->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_potongan1">
<span<?php echo $gajisma_detil_list->potongan1->viewAttributes() ?>><?php echo $gajisma_detil_list->potongan1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->potongan2->Visible) { // potongan2 ?>
		<td data-name="potongan2" <?php echo $gajisma_detil_list->potongan2->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_potongan2">
<span<?php echo $gajisma_detil_list->potongan2->viewAttributes() ?>><?php echo $gajisma_detil_list->potongan2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_list->jumlahterima->Visible) { // jumlahterima ?>
		<td data-name="jumlahterima" <?php echo $gajisma_detil_list->jumlahterima->cellAttributes() ?>>
<span id="el<?php echo $gajisma_detil_list->RowCount ?>_gajisma_detil_jumlahterima">
<span<?php echo $gajisma_detil_list->jumlahterima->viewAttributes() ?>><?php echo $gajisma_detil_list->jumlahterima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajisma_detil_list->ListOptions->render("body", "right", $gajisma_detil_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gajisma_detil_list->isGridAdd())
		$gajisma_detil_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gajisma_detil->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gajisma_detil_list->Recordset)
	$gajisma_detil_list->Recordset->Close();
?>
<?php if (!$gajisma_detil_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gajisma_detil_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajisma_detil_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajisma_detil_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gajisma_detil_list->TotalRecords == 0 && !$gajisma_detil->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gajisma_detil_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gajisma_detil_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajisma_detil_list->isExport()) { ?>
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
$gajisma_detil_list->terminate();
?>