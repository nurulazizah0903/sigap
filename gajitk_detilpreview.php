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
$gajitk_detil_preview = new gajitk_detil_preview();

// Run the page
$gajitk_detil_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitk_detil_preview->Page_Render();
?>
<?php $gajitk_detil_preview->showPageHeader(); ?>
<?php if ($gajitk_detil_preview->TotalRecords > 0) { ?>
<div class="card ew-grid gajitk_detil"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$gajitk_detil_preview->renderListOptions();

// Render list options (header, left)
$gajitk_detil_preview->ListOptions->render("header", "left");
?>
<?php if ($gajitk_detil_preview->pegawai_id->Visible) { // pegawai_id ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->pegawai_id) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->pegawai_id->headerCellClass() ?>"><?php echo $gajitk_detil_preview->pegawai_id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->pegawai_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->pegawai_id->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->pegawai_id->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->pegawai_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->pegawai_id->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->jabatan_id) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->jabatan_id->headerCellClass() ?>"><?php echo $gajitk_detil_preview->jabatan_id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->jabatan_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->jabatan_id->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->jabatan_id->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->jabatan_id->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->masakerja->Visible) { // masakerja ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->masakerja) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->masakerja->headerCellClass() ?>"><?php echo $gajitk_detil_preview->masakerja->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->masakerja->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->masakerja->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->masakerja->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->masakerja->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->masakerja->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->jumngajar->Visible) { // jumngajar ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->jumngajar) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->jumngajar->headerCellClass() ?>"><?php echo $gajitk_detil_preview->jumngajar->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->jumngajar->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->jumngajar->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->jumngajar->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->jumngajar->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->jumngajar->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->ijin->Visible) { // ijin ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->ijin) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->ijin->headerCellClass() ?>"><?php echo $gajitk_detil_preview->ijin->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->ijin->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->ijin->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->ijin->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->ijin->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->ijin->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->voucher->Visible) { // voucher ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->voucher) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->voucher->headerCellClass() ?>"><?php echo $gajitk_detil_preview->voucher->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->voucher->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->voucher->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->voucher->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->voucher->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->voucher->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->tunjangan_khusus) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->tunjangan_khusus->headerCellClass() ?>"><?php echo $gajitk_detil_preview->tunjangan_khusus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->tunjangan_khusus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->tunjangan_khusus->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->tunjangan_khusus->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->tunjangan_khusus->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->tunjangan_khusus->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->tunjangan_jabatan) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->tunjangan_jabatan->headerCellClass() ?>"><?php echo $gajitk_detil_preview->tunjangan_jabatan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->tunjangan_jabatan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->tunjangan_jabatan->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->tunjangan_jabatan->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->tunjangan_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->tunjangan_jabatan->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->baku->Visible) { // baku ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->baku) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->baku->headerCellClass() ?>"><?php echo $gajitk_detil_preview->baku->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->baku->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->baku->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->baku->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->baku->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->baku->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->kehadiran->Visible) { // kehadiran ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->kehadiran) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->kehadiran->headerCellClass() ?>"><?php echo $gajitk_detil_preview->kehadiran->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->kehadiran->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->kehadiran->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->kehadiran->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->kehadiran->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->prestasi->Visible) { // prestasi ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->prestasi) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->prestasi->headerCellClass() ?>"><?php echo $gajitk_detil_preview->prestasi->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->prestasi->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->prestasi->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->prestasi->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->prestasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->prestasi->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->jumlahgaji->Visible) { // jumlahgaji ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->jumlahgaji) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->jumlahgaji->headerCellClass() ?>"><?php echo $gajitk_detil_preview->jumlahgaji->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->jumlahgaji->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->jumlahgaji->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->jumlahgaji->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->jumlahgaji->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->jumlahgaji->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->jumgajitotal->Visible) { // jumgajitotal ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->jumgajitotal) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->jumgajitotal->headerCellClass() ?>"><?php echo $gajitk_detil_preview->jumgajitotal->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->jumgajitotal->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->jumgajitotal->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->jumgajitotal->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->jumgajitotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->jumgajitotal->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->potongan1->Visible) { // potongan1 ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->potongan1) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->potongan1->headerCellClass() ?>"><?php echo $gajitk_detil_preview->potongan1->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->potongan1->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->potongan1->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->potongan1->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->potongan1->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->potongan1->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->potongan2->Visible) { // potongan2 ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->potongan2) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->potongan2->headerCellClass() ?>"><?php echo $gajitk_detil_preview->potongan2->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->potongan2->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->potongan2->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->potongan2->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->potongan2->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->potongan2->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_preview->jumlahterima->Visible) { // jumlahterima ?>
	<?php if ($gajitk_detil->SortUrl($gajitk_detil_preview->jumlahterima) == "") { ?>
		<th class="<?php echo $gajitk_detil_preview->jumlahterima->headerCellClass() ?>"><?php echo $gajitk_detil_preview->jumlahterima->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitk_detil_preview->jumlahterima->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitk_detil_preview->jumlahterima->Name) ?>" data-sort-order="<?php echo $gajitk_detil_preview->SortField == $gajitk_detil_preview->jumlahterima->Name && $gajitk_detil_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_preview->jumlahterima->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_preview->SortField == $gajitk_detil_preview->jumlahterima->Name) { ?><?php if ($gajitk_detil_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajitk_detil_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$gajitk_detil_preview->RecCount = 0;
$gajitk_detil_preview->RowCount = 0;
while ($gajitk_detil_preview->Recordset && !$gajitk_detil_preview->Recordset->EOF) {

	// Init row class and style
	$gajitk_detil_preview->RecCount++;
	$gajitk_detil_preview->RowCount++;
	$gajitk_detil_preview->CssStyle = "";
	$gajitk_detil_preview->loadListRowValues($gajitk_detil_preview->Recordset);

	// Render row
	$gajitk_detil->RowType = ROWTYPE_PREVIEW; // Preview record
	$gajitk_detil_preview->resetAttributes();
	$gajitk_detil_preview->renderListRow();

	// Render list options
	$gajitk_detil_preview->renderListOptions();
?>
	<tr <?php echo $gajitk_detil->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajitk_detil_preview->ListOptions->render("body", "left", $gajitk_detil_preview->RowCount);
?>
<?php if ($gajitk_detil_preview->pegawai_id->Visible) { // pegawai_id ?>
		<!-- pegawai_id -->
		<td<?php echo $gajitk_detil_preview->pegawai_id->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->pegawai_id->viewAttributes() ?>><?php echo $gajitk_detil_preview->pegawai_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->jabatan_id->Visible) { // jabatan_id ?>
		<!-- jabatan_id -->
		<td<?php echo $gajitk_detil_preview->jabatan_id->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->jabatan_id->viewAttributes() ?>><?php echo $gajitk_detil_preview->jabatan_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->masakerja->Visible) { // masakerja ?>
		<!-- masakerja -->
		<td<?php echo $gajitk_detil_preview->masakerja->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->masakerja->viewAttributes() ?>><?php echo $gajitk_detil_preview->masakerja->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->jumngajar->Visible) { // jumngajar ?>
		<!-- jumngajar -->
		<td<?php echo $gajitk_detil_preview->jumngajar->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->jumngajar->viewAttributes() ?>><?php echo $gajitk_detil_preview->jumngajar->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->ijin->Visible) { // ijin ?>
		<!-- ijin -->
		<td<?php echo $gajitk_detil_preview->ijin->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->ijin->viewAttributes() ?>><?php echo $gajitk_detil_preview->ijin->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->voucher->Visible) { // voucher ?>
		<!-- voucher -->
		<td<?php echo $gajitk_detil_preview->voucher->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->voucher->viewAttributes() ?>><?php echo $gajitk_detil_preview->voucher->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
		<!-- tunjangan_khusus -->
		<td<?php echo $gajitk_detil_preview->tunjangan_khusus->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->tunjangan_khusus->viewAttributes() ?>><?php echo $gajitk_detil_preview->tunjangan_khusus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
		<!-- tunjangan_jabatan -->
		<td<?php echo $gajitk_detil_preview->tunjangan_jabatan->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->tunjangan_jabatan->viewAttributes() ?>><?php echo $gajitk_detil_preview->tunjangan_jabatan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->baku->Visible) { // baku ?>
		<!-- baku -->
		<td<?php echo $gajitk_detil_preview->baku->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->baku->viewAttributes() ?>><?php echo $gajitk_detil_preview->baku->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->kehadiran->Visible) { // kehadiran ?>
		<!-- kehadiran -->
		<td<?php echo $gajitk_detil_preview->kehadiran->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->kehadiran->viewAttributes() ?>><?php echo $gajitk_detil_preview->kehadiran->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->prestasi->Visible) { // prestasi ?>
		<!-- prestasi -->
		<td<?php echo $gajitk_detil_preview->prestasi->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->prestasi->viewAttributes() ?>><?php echo $gajitk_detil_preview->prestasi->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->jumlahgaji->Visible) { // jumlahgaji ?>
		<!-- jumlahgaji -->
		<td<?php echo $gajitk_detil_preview->jumlahgaji->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->jumlahgaji->viewAttributes() ?>><?php echo $gajitk_detil_preview->jumlahgaji->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->jumgajitotal->Visible) { // jumgajitotal ?>
		<!-- jumgajitotal -->
		<td<?php echo $gajitk_detil_preview->jumgajitotal->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->jumgajitotal->viewAttributes() ?>><?php echo $gajitk_detil_preview->jumgajitotal->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->potongan1->Visible) { // potongan1 ?>
		<!-- potongan1 -->
		<td<?php echo $gajitk_detil_preview->potongan1->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->potongan1->viewAttributes() ?>><?php echo $gajitk_detil_preview->potongan1->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->potongan2->Visible) { // potongan2 ?>
		<!-- potongan2 -->
		<td<?php echo $gajitk_detil_preview->potongan2->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->potongan2->viewAttributes() ?>><?php echo $gajitk_detil_preview->potongan2->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitk_detil_preview->jumlahterima->Visible) { // jumlahterima ?>
		<!-- jumlahterima -->
		<td<?php echo $gajitk_detil_preview->jumlahterima->cellAttributes() ?>>
<span<?php echo $gajitk_detil_preview->jumlahterima->viewAttributes() ?>><?php echo $gajitk_detil_preview->jumlahterima->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$gajitk_detil_preview->ListOptions->render("body", "right", $gajitk_detil_preview->RowCount);
?>
	</tr>
<?php
	$gajitk_detil_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $gajitk_detil_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($gajitk_detil_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($gajitk_detil_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$gajitk_detil_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($gajitk_detil_preview->Recordset)
	$gajitk_detil_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$gajitk_detil_preview->terminate();
?>