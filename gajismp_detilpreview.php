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
WriteHeader(FALSE, "utf-8");

// Create page object
$gajismp_detil_preview = new gajismp_detil_preview();

// Run the page
$gajismp_detil_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajismp_detil_preview->Page_Render();
?>
<?php $gajismp_detil_preview->showPageHeader(); ?>
<?php if ($gajismp_detil_preview->TotalRecords > 0) { ?>
<div class="card ew-grid gajismp_detil"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$gajismp_detil_preview->renderListOptions();

// Render list options (header, left)
$gajismp_detil_preview->ListOptions->render("header", "left");
?>
<?php if ($gajismp_detil_preview->pegawai_id->Visible) { // pegawai_id ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->pegawai_id) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->pegawai_id->headerCellClass() ?>"><?php echo $gajismp_detil_preview->pegawai_id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->pegawai_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->pegawai_id->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->pegawai_id->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->pegawai_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->pegawai_id->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_preview->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->jabatan_id) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->jabatan_id->headerCellClass() ?>"><?php echo $gajismp_detil_preview->jabatan_id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->jabatan_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->jabatan_id->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->jabatan_id->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->jabatan_id->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_preview->masakerja->Visible) { // masakerja ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->masakerja) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->masakerja->headerCellClass() ?>"><?php echo $gajismp_detil_preview->masakerja->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->masakerja->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->masakerja->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->masakerja->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->masakerja->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->masakerja->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_preview->jumngajar->Visible) { // jumngajar ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->jumngajar) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->jumngajar->headerCellClass() ?>"><?php echo $gajismp_detil_preview->jumngajar->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->jumngajar->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->jumngajar->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->jumngajar->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->jumngajar->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->jumngajar->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_preview->ijin->Visible) { // ijin ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->ijin) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->ijin->headerCellClass() ?>"><?php echo $gajismp_detil_preview->ijin->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->ijin->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->ijin->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->ijin->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->ijin->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->ijin->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_preview->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->tunjangan_wkosis) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->tunjangan_wkosis->headerCellClass() ?>"><?php echo $gajismp_detil_preview->tunjangan_wkosis->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->tunjangan_wkosis->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->tunjangan_wkosis->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->tunjangan_wkosis->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->tunjangan_wkosis->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->tunjangan_wkosis->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_preview->nominal_baku->Visible) { // nominal_baku ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->nominal_baku) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->nominal_baku->headerCellClass() ?>"><?php echo $gajismp_detil_preview->nominal_baku->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->nominal_baku->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->nominal_baku->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->nominal_baku->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->nominal_baku->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->nominal_baku->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_preview->baku->Visible) { // baku ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->baku) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->baku->headerCellClass() ?>"><?php echo $gajismp_detil_preview->baku->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->baku->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->baku->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->baku->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->baku->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->baku->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_preview->kehadiran->Visible) { // kehadiran ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->kehadiran) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->kehadiran->headerCellClass() ?>"><?php echo $gajismp_detil_preview->kehadiran->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->kehadiran->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->kehadiran->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->kehadiran->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->kehadiran->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_preview->prestasi->Visible) { // prestasi ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->prestasi) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->prestasi->headerCellClass() ?>"><?php echo $gajismp_detil_preview->prestasi->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->prestasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->prestasi->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->prestasi->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->prestasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->prestasi->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_preview->jumlahgaji->Visible) { // jumlahgaji ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->jumlahgaji) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->jumlahgaji->headerCellClass() ?>"><?php echo $gajismp_detil_preview->jumlahgaji->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->jumlahgaji->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->jumlahgaji->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->jumlahgaji->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->jumlahgaji->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->jumlahgaji->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_preview->jumgajitotal->Visible) { // jumgajitotal ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->jumgajitotal) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->jumgajitotal->headerCellClass() ?>"><?php echo $gajismp_detil_preview->jumgajitotal->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->jumgajitotal->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->jumgajitotal->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->jumgajitotal->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->jumgajitotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->jumgajitotal->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_preview->potongan1->Visible) { // potongan1 ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->potongan1) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->potongan1->headerCellClass() ?>"><?php echo $gajismp_detil_preview->potongan1->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->potongan1->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->potongan1->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->potongan1->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->potongan1->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->potongan1->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_preview->potongan2->Visible) { // potongan2 ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->potongan2) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->potongan2->headerCellClass() ?>"><?php echo $gajismp_detil_preview->potongan2->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->potongan2->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->potongan2->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->potongan2->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->potongan2->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->potongan2->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajismp_detil_preview->jumlahterima->Visible) { // jumlahterima ?>
	<?php if ($gajismp_detil->SortUrl($gajismp_detil_preview->jumlahterima) == "") { ?>
		<th class="<?php echo $gajismp_detil_preview->jumlahterima->headerCellClass() ?>"><?php echo $gajismp_detil_preview->jumlahterima->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajismp_detil_preview->jumlahterima->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajismp_detil_preview->jumlahterima->Name) ?>" data-sort-order="<?php echo $gajismp_detil_preview->SortField == $gajismp_detil_preview->jumlahterima->Name && $gajismp_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajismp_detil_preview->jumlahterima->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajismp_detil_preview->SortField == $gajismp_detil_preview->jumlahterima->Name) { ?><?php if ($gajismp_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajismp_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajismp_detil_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$gajismp_detil_preview->RecCount = 0;
$gajismp_detil_preview->RowCount = 0;
while ($gajismp_detil_preview->Recordset && !$gajismp_detil_preview->Recordset->EOF) {

	// Init row class and style
	$gajismp_detil_preview->RecCount++;
	$gajismp_detil_preview->RowCount++;
	$gajismp_detil_preview->CssStyle = "";
	$gajismp_detil_preview->loadListRowValues($gajismp_detil_preview->Recordset);

	// Render row
	$gajismp_detil->RowType = ROWTYPE_PREVIEW; // Preview record
	$gajismp_detil_preview->resetAttributes();
	$gajismp_detil_preview->renderListRow();

	// Render list options
	$gajismp_detil_preview->renderListOptions();
?>
	<tr <?php echo $gajismp_detil->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajismp_detil_preview->ListOptions->render("body", "left", $gajismp_detil_preview->RowCount);
?>
<?php if ($gajismp_detil_preview->pegawai_id->Visible) { // pegawai_id ?>
		<!-- pegawai_id -->
		<td<?php echo $gajismp_detil_preview->pegawai_id->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->pegawai_id->viewAttributes() ?>><?php echo $gajismp_detil_preview->pegawai_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajismp_detil_preview->jabatan_id->Visible) { // jabatan_id ?>
		<!-- jabatan_id -->
		<td<?php echo $gajismp_detil_preview->jabatan_id->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->jabatan_id->viewAttributes() ?>><?php echo $gajismp_detil_preview->jabatan_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajismp_detil_preview->masakerja->Visible) { // masakerja ?>
		<!-- masakerja -->
		<td<?php echo $gajismp_detil_preview->masakerja->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->masakerja->viewAttributes() ?>><?php echo $gajismp_detil_preview->masakerja->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajismp_detil_preview->jumngajar->Visible) { // jumngajar ?>
		<!-- jumngajar -->
		<td<?php echo $gajismp_detil_preview->jumngajar->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->jumngajar->viewAttributes() ?>><?php echo $gajismp_detil_preview->jumngajar->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajismp_detil_preview->ijin->Visible) { // ijin ?>
		<!-- ijin -->
		<td<?php echo $gajismp_detil_preview->ijin->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->ijin->viewAttributes() ?>><?php echo $gajismp_detil_preview->ijin->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajismp_detil_preview->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
		<!-- tunjangan_wkosis -->
		<td<?php echo $gajismp_detil_preview->tunjangan_wkosis->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->tunjangan_wkosis->viewAttributes() ?>><?php echo $gajismp_detil_preview->tunjangan_wkosis->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajismp_detil_preview->nominal_baku->Visible) { // nominal_baku ?>
		<!-- nominal_baku -->
		<td<?php echo $gajismp_detil_preview->nominal_baku->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->nominal_baku->viewAttributes() ?>><?php echo $gajismp_detil_preview->nominal_baku->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajismp_detil_preview->baku->Visible) { // baku ?>
		<!-- baku -->
		<td<?php echo $gajismp_detil_preview->baku->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->baku->viewAttributes() ?>><?php echo $gajismp_detil_preview->baku->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajismp_detil_preview->kehadiran->Visible) { // kehadiran ?>
		<!-- kehadiran -->
		<td<?php echo $gajismp_detil_preview->kehadiran->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->kehadiran->viewAttributes() ?>><?php echo $gajismp_detil_preview->kehadiran->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajismp_detil_preview->prestasi->Visible) { // prestasi ?>
		<!-- prestasi -->
		<td<?php echo $gajismp_detil_preview->prestasi->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->prestasi->viewAttributes() ?>><?php echo $gajismp_detil_preview->prestasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajismp_detil_preview->jumlahgaji->Visible) { // jumlahgaji ?>
		<!-- jumlahgaji -->
		<td<?php echo $gajismp_detil_preview->jumlahgaji->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->jumlahgaji->viewAttributes() ?>><?php echo $gajismp_detil_preview->jumlahgaji->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajismp_detil_preview->jumgajitotal->Visible) { // jumgajitotal ?>
		<!-- jumgajitotal -->
		<td<?php echo $gajismp_detil_preview->jumgajitotal->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->jumgajitotal->viewAttributes() ?>><?php echo $gajismp_detil_preview->jumgajitotal->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajismp_detil_preview->potongan1->Visible) { // potongan1 ?>
		<!-- potongan1 -->
		<td<?php echo $gajismp_detil_preview->potongan1->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->potongan1->viewAttributes() ?>><?php echo $gajismp_detil_preview->potongan1->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajismp_detil_preview->potongan2->Visible) { // potongan2 ?>
		<!-- potongan2 -->
		<td<?php echo $gajismp_detil_preview->potongan2->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->potongan2->viewAttributes() ?>><?php echo $gajismp_detil_preview->potongan2->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajismp_detil_preview->jumlahterima->Visible) { // jumlahterima ?>
		<!-- jumlahterima -->
		<td<?php echo $gajismp_detil_preview->jumlahterima->cellAttributes() ?>>
<span<?php echo $gajismp_detil_preview->jumlahterima->viewAttributes() ?>><?php echo $gajismp_detil_preview->jumlahterima->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$gajismp_detil_preview->ListOptions->render("body", "right", $gajismp_detil_preview->RowCount);
?>
	</tr>
<?php
	$gajismp_detil_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $gajismp_detil_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($gajismp_detil_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($gajismp_detil_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$gajismp_detil_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($gajismp_detil_preview->Recordset)
	$gajismp_detil_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$gajismp_detil_preview->terminate();
?>