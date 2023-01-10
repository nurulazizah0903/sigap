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
$gajismp_detil_list = new gajismp_detil_list();

// Run the page
$gajismp_detil_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajismp_detil_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajismp_detil_list->isExport()) { ?>
<script>
var fgajismp_detillist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgajismp_detillist = currentForm = new ew.Form("fgajismp_detillist", "list");
	fgajismp_detillist.formKeyCountName = '<?php echo $gajismp_detil_list->FormKeyCountName ?>';
	loadjs.done("fgajismp_detillist");
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
<?php if (!$gajismp_detil_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gajismp_detil_list->TotalRecords > 0 && $gajismp_detil_list->ExportOptions->visible()) { ?>
<?php $gajismp_detil_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gajismp_detil_list->ImportOptions->visible()) { ?>
<?php $gajismp_detil_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$gajismp_detil_list->isExport() || Config("EXPORT_MASTER_RECORD") && $gajismp_detil_list->isExport("print")) { ?>
<?php
if ($gajismp_detil_list->DbMasterFilter != "" && $gajismp_detil->getCurrentMasterTable() == "gajismp") {
	if ($gajismp_detil_list->MasterRecordExists) {
		include_once "gajismpmaster.php";
	}
}
?>
<?php } ?>
<?php
$gajismp_detil_list->renderOtherOptions();
?>
<?php $gajismp_detil_list->showPageHeader(); ?>
<?php
$gajismp_detil_list->showMessage();
?>
<?php if ($gajismp_detil_list->TotalRecords > 0 || $gajismp_detil->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gajismp_detil_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajismp_detil">
<?php if (!$gajismp_detil_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gajismp_detil_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajismp_detil_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajismp_detil_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgajismp_detillist" id="fgajismp_detillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajismp_detil">
<?php if ($gajismp_detil->getCurrentMasterTable() == "gajismp" && $gajismp_detil->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="gajismp">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($gajismp_detil_list->pid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_gajismp_detil" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gajismp_detil_list->TotalRecords > 0 || $gajismp_detil_list->isGridEdit()) { ?>
<table id="tbl_gajismp_detillist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gajismp_detil->RowType = ROWTYPE_HEADER;

// Render list options
$gajismp_detil_list->renderListOptions();

// Render list options (header, left)
$gajismp_detil_list->ListOptions->render("header", "left");
?>
<?php if ($gajismp_detil_list->pegawai_id->Visible) { // pegawai_id ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->pegawai_id) == "") { ?>
		<th data-name="pegawai_id" class="<?php echo $gajismp_detil_list->pegawai_id->headerCellClass() ?>"><div id="elh_gajismp_detil_pegawai_id" class="gajismp_detil_pegawai_id"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->pegawai_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai_id" class="<?php echo $gajismp_detil_list->pegawai_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->pegawai_id) ?>', 1);"><div id="elh_gajismp_detil_pegawai_id" class="gajismp_detil_pegawai_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->pegawai_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->pegawai_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->pegawai_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_list->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->jabatan_id) == "") { ?>
		<th data-name="jabatan_id" class="<?php echo $gajismp_detil_list->jabatan_id->headerCellClass() ?>"><div id="elh_gajismp_detil_jabatan_id" class="gajismp_detil_jabatan_id"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->jabatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan_id" class="<?php echo $gajismp_detil_list->jabatan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->jabatan_id) ?>', 1);"><div id="elh_gajismp_detil_jabatan_id" class="gajismp_detil_jabatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->jabatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->jabatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_list->masakerja->Visible) { // masakerja ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->masakerja) == "") { ?>
		<th data-name="masakerja" class="<?php echo $gajismp_detil_list->masakerja->headerCellClass() ?>"><div id="elh_gajismp_detil_masakerja" class="gajismp_detil_masakerja"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->masakerja->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masakerja" class="<?php echo $gajismp_detil_list->masakerja->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->masakerja) ?>', 1);"><div id="elh_gajismp_detil_masakerja" class="gajismp_detil_masakerja">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->masakerja->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->masakerja->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->masakerja->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_list->jumngajar->Visible) { // jumngajar ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->jumngajar) == "") { ?>
		<th data-name="jumngajar" class="<?php echo $gajismp_detil_list->jumngajar->headerCellClass() ?>"><div id="elh_gajismp_detil_jumngajar" class="gajismp_detil_jumngajar"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->jumngajar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumngajar" class="<?php echo $gajismp_detil_list->jumngajar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->jumngajar) ?>', 1);"><div id="elh_gajismp_detil_jumngajar" class="gajismp_detil_jumngajar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->jumngajar->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->jumngajar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->jumngajar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_list->ijin->Visible) { // ijin ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->ijin) == "") { ?>
		<th data-name="ijin" class="<?php echo $gajismp_detil_list->ijin->headerCellClass() ?>"><div id="elh_gajismp_detil_ijin" class="gajismp_detil_ijin"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->ijin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ijin" class="<?php echo $gajismp_detil_list->ijin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->ijin) ?>', 1);"><div id="elh_gajismp_detil_ijin" class="gajismp_detil_ijin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->ijin->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->ijin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->ijin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_list->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->tunjangan_wkosis) == "") { ?>
		<th data-name="tunjangan_wkosis" class="<?php echo $gajismp_detil_list->tunjangan_wkosis->headerCellClass() ?>"><div id="elh_gajismp_detil_tunjangan_wkosis" class="gajismp_detil_tunjangan_wkosis"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->tunjangan_wkosis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tunjangan_wkosis" class="<?php echo $gajismp_detil_list->tunjangan_wkosis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->tunjangan_wkosis) ?>', 1);"><div id="elh_gajismp_detil_tunjangan_wkosis" class="gajismp_detil_tunjangan_wkosis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->tunjangan_wkosis->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->tunjangan_wkosis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->tunjangan_wkosis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_list->nominal_baku->Visible) { // nominal_baku ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->nominal_baku) == "") { ?>
		<th data-name="nominal_baku" class="<?php echo $gajismp_detil_list->nominal_baku->headerCellClass() ?>"><div id="elh_gajismp_detil_nominal_baku" class="gajismp_detil_nominal_baku"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->nominal_baku->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nominal_baku" class="<?php echo $gajismp_detil_list->nominal_baku->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->nominal_baku) ?>', 1);"><div id="elh_gajismp_detil_nominal_baku" class="gajismp_detil_nominal_baku">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->nominal_baku->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->nominal_baku->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->nominal_baku->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_list->baku->Visible) { // baku ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->baku) == "") { ?>
		<th data-name="baku" class="<?php echo $gajismp_detil_list->baku->headerCellClass() ?>"><div id="elh_gajismp_detil_baku" class="gajismp_detil_baku"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->baku->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="baku" class="<?php echo $gajismp_detil_list->baku->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->baku) ?>', 1);"><div id="elh_gajismp_detil_baku" class="gajismp_detil_baku">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->baku->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->baku->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->baku->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_list->kehadiran->Visible) { // kehadiran ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->kehadiran) == "") { ?>
		<th data-name="kehadiran" class="<?php echo $gajismp_detil_list->kehadiran->headerCellClass() ?>"><div id="elh_gajismp_detil_kehadiran" class="gajismp_detil_kehadiran"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->kehadiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kehadiran" class="<?php echo $gajismp_detil_list->kehadiran->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->kehadiran) ?>', 1);"><div id="elh_gajismp_detil_kehadiran" class="gajismp_detil_kehadiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->kehadiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->kehadiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_list->prestasi->Visible) { // prestasi ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->prestasi) == "") { ?>
		<th data-name="prestasi" class="<?php echo $gajismp_detil_list->prestasi->headerCellClass() ?>"><div id="elh_gajismp_detil_prestasi" class="gajismp_detil_prestasi"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->prestasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prestasi" class="<?php echo $gajismp_detil_list->prestasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->prestasi) ?>', 1);"><div id="elh_gajismp_detil_prestasi" class="gajismp_detil_prestasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->prestasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->prestasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->prestasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_list->jumlahgaji->Visible) { // jumlahgaji ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->jumlahgaji) == "") { ?>
		<th data-name="jumlahgaji" class="<?php echo $gajismp_detil_list->jumlahgaji->headerCellClass() ?>"><div id="elh_gajismp_detil_jumlahgaji" class="gajismp_detil_jumlahgaji"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->jumlahgaji->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlahgaji" class="<?php echo $gajismp_detil_list->jumlahgaji->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->jumlahgaji) ?>', 1);"><div id="elh_gajismp_detil_jumlahgaji" class="gajismp_detil_jumlahgaji">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->jumlahgaji->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->jumlahgaji->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->jumlahgaji->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_list->jumgajitotal->Visible) { // jumgajitotal ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->jumgajitotal) == "") { ?>
		<th data-name="jumgajitotal" class="<?php echo $gajismp_detil_list->jumgajitotal->headerCellClass() ?>"><div id="elh_gajismp_detil_jumgajitotal" class="gajismp_detil_jumgajitotal"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->jumgajitotal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumgajitotal" class="<?php echo $gajismp_detil_list->jumgajitotal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->jumgajitotal) ?>', 1);"><div id="elh_gajismp_detil_jumgajitotal" class="gajismp_detil_jumgajitotal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->jumgajitotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->jumgajitotal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->jumgajitotal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_list->potongan1->Visible) { // potongan1 ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->potongan1) == "") { ?>
		<th data-name="potongan1" class="<?php echo $gajismp_detil_list->potongan1->headerCellClass() ?>"><div id="elh_gajismp_detil_potongan1" class="gajismp_detil_potongan1"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->potongan1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan1" class="<?php echo $gajismp_detil_list->potongan1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->potongan1) ?>', 1);"><div id="elh_gajismp_detil_potongan1" class="gajismp_detil_potongan1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->potongan1->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->potongan1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->potongan1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_list->potongan2->Visible) { // potongan2 ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->potongan2) == "") { ?>
		<th data-name="potongan2" class="<?php echo $gajismp_detil_list->potongan2->headerCellClass() ?>"><div id="elh_gajismp_detil_potongan2" class="gajismp_detil_potongan2"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->potongan2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan2" class="<?php echo $gajismp_detil_list->potongan2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->potongan2) ?>', 1);"><div id="elh_gajismp_detil_potongan2" class="gajismp_detil_potongan2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->potongan2->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->potongan2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->potongan2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_list->jumlahterima->Visible) { // jumlahterima ?>
	<?php if ($gajismp_detil_list->SortUrl($gajismp_detil_list->jumlahterima) == "") { ?>
		<th data-name="jumlahterima" class="<?php echo $gajismp_detil_list->jumlahterima->headerCellClass() ?>"><div id="elh_gajismp_detil_jumlahterima" class="gajismp_detil_jumlahterima"><div class="ew-table-header-caption"><?php echo $gajismp_detil_list->jumlahterima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlahterima" class="<?php echo $gajismp_detil_list->jumlahterima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajismp_detil_list->SortUrl($gajismp_detil_list->jumlahterima) ?>', 1);"><div id="elh_gajismp_detil_jumlahterima" class="gajismp_detil_jumlahterima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_list->jumlahterima->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_list->jumlahterima->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_list->jumlahterima->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajismp_detil_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gajismp_detil_list->ExportAll && $gajismp_detil_list->isExport()) {
	$gajismp_detil_list->StopRecord = $gajismp_detil_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gajismp_detil_list->TotalRecords > $gajismp_detil_list->StartRecord + $gajismp_detil_list->DisplayRecords - 1)
		$gajismp_detil_list->StopRecord = $gajismp_detil_list->StartRecord + $gajismp_detil_list->DisplayRecords - 1;
	else
		$gajismp_detil_list->StopRecord = $gajismp_detil_list->TotalRecords;
}
$gajismp_detil_list->RecordCount = $gajismp_detil_list->StartRecord - 1;
if ($gajismp_detil_list->Recordset && !$gajismp_detil_list->Recordset->EOF) {
	$gajismp_detil_list->Recordset->moveFirst();
	$selectLimit = $gajismp_detil_list->UseSelectLimit;
	if (!$selectLimit && $gajismp_detil_list->StartRecord > 1)
		$gajismp_detil_list->Recordset->move($gajismp_detil_list->StartRecord - 1);
} elseif (!$gajismp_detil->AllowAddDeleteRow && $gajismp_detil_list->StopRecord == 0) {
	$gajismp_detil_list->StopRecord = $gajismp_detil->GridAddRowCount;
}

// Initialize aggregate
$gajismp_detil->RowType = ROWTYPE_AGGREGATEINIT;
$gajismp_detil->resetAttributes();
$gajismp_detil_list->renderRow();
while ($gajismp_detil_list->RecordCount < $gajismp_detil_list->StopRecord) {
	$gajismp_detil_list->RecordCount++;
	if ($gajismp_detil_list->RecordCount >= $gajismp_detil_list->StartRecord) {
		$gajismp_detil_list->RowCount++;

		// Set up key count
		$gajismp_detil_list->KeyCount = $gajismp_detil_list->RowIndex;

		// Init row class and style
		$gajismp_detil->resetAttributes();
		$gajismp_detil->CssClass = "";
		if ($gajismp_detil_list->isGridAdd()) {
		} else {
			$gajismp_detil_list->loadRowValues($gajismp_detil_list->Recordset); // Load row values
		}
		$gajismp_detil->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gajismp_detil->RowAttrs->merge(["data-rowindex" => $gajismp_detil_list->RowCount, "id" => "r" . $gajismp_detil_list->RowCount . "_gajismp_detil", "data-rowtype" => $gajismp_detil->RowType]);

		// Render row
		$gajismp_detil_list->renderRow();

		// Render list options
		$gajismp_detil_list->renderListOptions();
?>
	<tr <?php echo $gajismp_detil->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajismp_detil_list->ListOptions->render("body", "left", $gajismp_detil_list->RowCount);
?>
	<?php if ($gajismp_detil_list->pegawai_id->Visible) { // pegawai_id ?>
		<td data-name="pegawai_id" <?php echo $gajismp_detil_list->pegawai_id->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_pegawai_id">
<span<?php echo $gajismp_detil_list->pegawai_id->viewAttributes() ?>><?php echo $gajismp_detil_list->pegawai_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_detil_list->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id" <?php echo $gajismp_detil_list->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_jabatan_id">
<span<?php echo $gajismp_detil_list->jabatan_id->viewAttributes() ?>><?php echo $gajismp_detil_list->jabatan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_detil_list->masakerja->Visible) { // masakerja ?>
		<td data-name="masakerja" <?php echo $gajismp_detil_list->masakerja->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_masakerja">
<span<?php echo $gajismp_detil_list->masakerja->viewAttributes() ?>><?php echo $gajismp_detil_list->masakerja->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_detil_list->jumngajar->Visible) { // jumngajar ?>
		<td data-name="jumngajar" <?php echo $gajismp_detil_list->jumngajar->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_jumngajar">
<span<?php echo $gajismp_detil_list->jumngajar->viewAttributes() ?>><?php echo $gajismp_detil_list->jumngajar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_detil_list->ijin->Visible) { // ijin ?>
		<td data-name="ijin" <?php echo $gajismp_detil_list->ijin->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_ijin">
<span<?php echo $gajismp_detil_list->ijin->viewAttributes() ?>><?php echo $gajismp_detil_list->ijin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_detil_list->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
		<td data-name="tunjangan_wkosis" <?php echo $gajismp_detil_list->tunjangan_wkosis->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_tunjangan_wkosis">
<span<?php echo $gajismp_detil_list->tunjangan_wkosis->viewAttributes() ?>><?php echo $gajismp_detil_list->tunjangan_wkosis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_detil_list->nominal_baku->Visible) { // nominal_baku ?>
		<td data-name="nominal_baku" <?php echo $gajismp_detil_list->nominal_baku->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_nominal_baku">
<span<?php echo $gajismp_detil_list->nominal_baku->viewAttributes() ?>><?php echo $gajismp_detil_list->nominal_baku->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_detil_list->baku->Visible) { // baku ?>
		<td data-name="baku" <?php echo $gajismp_detil_list->baku->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_baku">
<span<?php echo $gajismp_detil_list->baku->viewAttributes() ?>><?php echo $gajismp_detil_list->baku->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_detil_list->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran" <?php echo $gajismp_detil_list->kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_kehadiran">
<span<?php echo $gajismp_detil_list->kehadiran->viewAttributes() ?>><?php echo $gajismp_detil_list->kehadiran->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_detil_list->prestasi->Visible) { // prestasi ?>
		<td data-name="prestasi" <?php echo $gajismp_detil_list->prestasi->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_prestasi">
<span<?php echo $gajismp_detil_list->prestasi->viewAttributes() ?>><?php echo $gajismp_detil_list->prestasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_detil_list->jumlahgaji->Visible) { // jumlahgaji ?>
		<td data-name="jumlahgaji" <?php echo $gajismp_detil_list->jumlahgaji->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_jumlahgaji">
<span<?php echo $gajismp_detil_list->jumlahgaji->viewAttributes() ?>><?php echo $gajismp_detil_list->jumlahgaji->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_detil_list->jumgajitotal->Visible) { // jumgajitotal ?>
		<td data-name="jumgajitotal" <?php echo $gajismp_detil_list->jumgajitotal->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_jumgajitotal">
<span<?php echo $gajismp_detil_list->jumgajitotal->viewAttributes() ?>><?php echo $gajismp_detil_list->jumgajitotal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_detil_list->potongan1->Visible) { // potongan1 ?>
		<td data-name="potongan1" <?php echo $gajismp_detil_list->potongan1->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_potongan1">
<span<?php echo $gajismp_detil_list->potongan1->viewAttributes() ?>><?php echo $gajismp_detil_list->potongan1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_detil_list->potongan2->Visible) { // potongan2 ?>
		<td data-name="potongan2" <?php echo $gajismp_detil_list->potongan2->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_potongan2">
<span<?php echo $gajismp_detil_list->potongan2->viewAttributes() ?>><?php echo $gajismp_detil_list->potongan2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajismp_detil_list->jumlahterima->Visible) { // jumlahterima ?>
		<td data-name="jumlahterima" <?php echo $gajismp_detil_list->jumlahterima->cellAttributes() ?>>
<span id="el<?php echo $gajismp_detil_list->RowCount ?>_gajismp_detil_jumlahterima">
<span<?php echo $gajismp_detil_list->jumlahterima->viewAttributes() ?>><?php echo $gajismp_detil_list->jumlahterima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajismp_detil_list->ListOptions->render("body", "right", $gajismp_detil_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gajismp_detil_list->isGridAdd())
		$gajismp_detil_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gajismp_detil->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gajismp_detil_list->Recordset)
	$gajismp_detil_list->Recordset->Close();
?>
<?php if (!$gajismp_detil_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gajismp_detil_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajismp_detil_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajismp_detil_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gajismp_detil_list->TotalRecords == 0 && !$gajismp_detil->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gajismp_detil_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gajismp_detil_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajismp_detil_list->isExport()) { ?>
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
$gajismp_detil_list->terminate();
?>