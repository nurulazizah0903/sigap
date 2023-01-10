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
$gaji_tu_smk_preview = new gaji_tu_smk_preview();

// Run the page
$gaji_tu_smk_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_tu_smk_preview->Page_Render();
?>
<?php $gaji_tu_smk_preview->showPageHeader(); ?>
<?php if ($gaji_tu_smk_preview->TotalRecords > 0) { ?>
<div class="card ew-grid gaji_tu_smk"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$gaji_tu_smk_preview->renderListOptions();

// Render list options (header, left)
$gaji_tu_smk_preview->ListOptions->render("header", "left");
?>
<?php if ($gaji_tu_smk_preview->pegawai->Visible) { // pegawai ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->pegawai) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->pegawai->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->pegawai->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->pegawai->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->pegawai->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->pegawai->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->pegawai->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->jenjang_id->Visible) { // jenjang_id ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->jenjang_id) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->jenjang_id->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->jenjang_id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->jenjang_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->jenjang_id->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->jenjang_id->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->jenjang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->jenjang_id->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->jabatan_id) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->jabatan_id->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->jabatan_id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->jabatan_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->jabatan_id->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->jabatan_id->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->jabatan_id->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->kehadiran->Visible) { // kehadiran ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->kehadiran) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->kehadiran->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->kehadiran->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->kehadiran->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->kehadiran->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->kehadiran->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->kehadiran->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->gapok->Visible) { // gapok ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->gapok) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->gapok->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->gapok->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->gapok->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->gapok->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->gapok->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->gapok->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->gapok->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->lembur->Visible) { // lembur ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->lembur) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->lembur->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->lembur->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->lembur->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->lembur->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->lembur->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->lembur->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->lembur->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->value_lembur->Visible) { // value_lembur ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->value_lembur) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->value_lembur->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->value_lembur->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->value_lembur->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->value_lembur->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->value_lembur->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->value_lembur->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->value_lembur->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->value_reward->Visible) { // value_reward ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->value_reward) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->value_reward->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->value_reward->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->value_reward->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->value_reward->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->value_reward->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->value_reward->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->value_reward->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->value_inval->Visible) { // value_inval ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->value_inval) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->value_inval->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->value_inval->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->value_inval->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->value_inval->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->value_inval->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->value_inval->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->value_inval->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->piket_count->Visible) { // piket_count ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->piket_count) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->piket_count->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->piket_count->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->piket_count->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->piket_count->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->piket_count->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->piket_count->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->piket_count->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->value_piket->Visible) { // value_piket ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->value_piket) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->value_piket->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->value_piket->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->value_piket->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->value_piket->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->value_piket->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->value_piket->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->value_piket->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->tugastambahan->Visible) { // tugastambahan ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->tugastambahan) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->tugastambahan->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->tugastambahan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->tugastambahan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->tugastambahan->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->tugastambahan->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->tugastambahan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->tugastambahan->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->tj_jabatan->Visible) { // tj_jabatan ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->tj_jabatan) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->tj_jabatan->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->tj_jabatan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->tj_jabatan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->tj_jabatan->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->tj_jabatan->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->tj_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->tj_jabatan->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->potongan->Visible) { // potongan ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->potongan) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->potongan->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->potongan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->potongan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->potongan->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->potongan->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->potongan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->potongan->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->sub_total->Visible) { // sub_total ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->sub_total) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->sub_total->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->sub_total->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->sub_total->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->sub_total->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->sub_total->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->sub_total->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->sub_total->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->penyesuaian->Visible) { // penyesuaian ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->penyesuaian) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->penyesuaian->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->penyesuaian->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->penyesuaian->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->penyesuaian->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->penyesuaian->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->penyesuaian->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->total->Visible) { // total ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->total) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->total->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->total->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->total->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->total->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->total->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->total->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->jp->Visible) { // jp ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->jp) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->jp->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->jp->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->jp->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->jp->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->jp->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->jp->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->jp->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->ijasah->Visible) { // ijasah ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->ijasah) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->ijasah->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->ijasah->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->ijasah->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->ijasah->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->ijasah->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->ijasah->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->ijasah->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->tunjangan2->Visible) { // tunjangan2 ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->tunjangan2) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->tunjangan2->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->tunjangan2->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->tunjangan2->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->tunjangan2->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->tunjangan2->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->tunjangan2->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->tunjangan2->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->tambahan->Visible) { // tambahan ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->tambahan) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->tambahan->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->tambahan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->tambahan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->tambahan->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->tambahan->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->tambahan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->tambahan->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_smk_preview->type_jabatan->Visible) { // type_jabatan ?>
	<?php if ($gaji_tu_smk->SortUrl($gaji_tu_smk_preview->type_jabatan) == "") { ?>
		<th class="<?php echo $gaji_tu_smk_preview->type_jabatan->headerCellClass() ?>"><?php echo $gaji_tu_smk_preview->type_jabatan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_tu_smk_preview->type_jabatan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_tu_smk_preview->type_jabatan->Name) ?>" data-sort-order="<?php echo $gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->type_jabatan->Name && $gaji_tu_smk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_smk_preview->type_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_smk_preview->SortField == $gaji_tu_smk_preview->type_jabatan->Name) { ?><?php if ($gaji_tu_smk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_smk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gaji_tu_smk_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$gaji_tu_smk_preview->RecCount = 0;
$gaji_tu_smk_preview->RowCount = 0;
while ($gaji_tu_smk_preview->Recordset && !$gaji_tu_smk_preview->Recordset->EOF) {

	// Init row class and style
	$gaji_tu_smk_preview->RecCount++;
	$gaji_tu_smk_preview->RowCount++;
	$gaji_tu_smk_preview->CssStyle = "";
	$gaji_tu_smk_preview->loadListRowValues($gaji_tu_smk_preview->Recordset);

	// Render row
	$gaji_tu_smk->RowType = ROWTYPE_PREVIEW; // Preview record
	$gaji_tu_smk_preview->resetAttributes();
	$gaji_tu_smk_preview->renderListRow();

	// Render list options
	$gaji_tu_smk_preview->renderListOptions();
?>
	<tr <?php echo $gaji_tu_smk->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gaji_tu_smk_preview->ListOptions->render("body", "left", $gaji_tu_smk_preview->RowCount);
?>
<?php if ($gaji_tu_smk_preview->pegawai->Visible) { // pegawai ?>
		<!-- pegawai -->
		<td<?php echo $gaji_tu_smk_preview->pegawai->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->pegawai->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->pegawai->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->jenjang_id->Visible) { // jenjang_id ?>
		<!-- jenjang_id -->
		<td<?php echo $gaji_tu_smk_preview->jenjang_id->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->jenjang_id->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->jenjang_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->jabatan_id->Visible) { // jabatan_id ?>
		<!-- jabatan_id -->
		<td<?php echo $gaji_tu_smk_preview->jabatan_id->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->jabatan_id->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->jabatan_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->kehadiran->Visible) { // kehadiran ?>
		<!-- kehadiran -->
		<td<?php echo $gaji_tu_smk_preview->kehadiran->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->kehadiran->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->kehadiran->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->gapok->Visible) { // gapok ?>
		<!-- gapok -->
		<td<?php echo $gaji_tu_smk_preview->gapok->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->gapok->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->gapok->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->lembur->Visible) { // lembur ?>
		<!-- lembur -->
		<td<?php echo $gaji_tu_smk_preview->lembur->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->lembur->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->lembur->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->value_lembur->Visible) { // value_lembur ?>
		<!-- value_lembur -->
		<td<?php echo $gaji_tu_smk_preview->value_lembur->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->value_lembur->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->value_lembur->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->value_reward->Visible) { // value_reward ?>
		<!-- value_reward -->
		<td<?php echo $gaji_tu_smk_preview->value_reward->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->value_reward->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->value_reward->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->value_inval->Visible) { // value_inval ?>
		<!-- value_inval -->
		<td<?php echo $gaji_tu_smk_preview->value_inval->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->value_inval->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->value_inval->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->piket_count->Visible) { // piket_count ?>
		<!-- piket_count -->
		<td<?php echo $gaji_tu_smk_preview->piket_count->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->piket_count->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->piket_count->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->value_piket->Visible) { // value_piket ?>
		<!-- value_piket -->
		<td<?php echo $gaji_tu_smk_preview->value_piket->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->value_piket->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->value_piket->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->tugastambahan->Visible) { // tugastambahan ?>
		<!-- tugastambahan -->
		<td<?php echo $gaji_tu_smk_preview->tugastambahan->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->tugastambahan->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->tugastambahan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->tj_jabatan->Visible) { // tj_jabatan ?>
		<!-- tj_jabatan -->
		<td<?php echo $gaji_tu_smk_preview->tj_jabatan->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->tj_jabatan->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->tj_jabatan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->potongan->Visible) { // potongan ?>
		<!-- potongan -->
		<td<?php echo $gaji_tu_smk_preview->potongan->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->potongan->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->potongan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->sub_total->Visible) { // sub_total ?>
		<!-- sub_total -->
		<td<?php echo $gaji_tu_smk_preview->sub_total->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->sub_total->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->sub_total->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->penyesuaian->Visible) { // penyesuaian ?>
		<!-- penyesuaian -->
		<td<?php echo $gaji_tu_smk_preview->penyesuaian->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->penyesuaian->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->penyesuaian->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->total->Visible) { // total ?>
		<!-- total -->
		<td<?php echo $gaji_tu_smk_preview->total->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->total->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->total->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->jp->Visible) { // jp ?>
		<!-- jp -->
		<td<?php echo $gaji_tu_smk_preview->jp->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->jp->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->jp->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->ijasah->Visible) { // ijasah ?>
		<!-- ijasah -->
		<td<?php echo $gaji_tu_smk_preview->ijasah->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->ijasah->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->ijasah->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->tunjangan2->Visible) { // tunjangan2 ?>
		<!-- tunjangan2 -->
		<td<?php echo $gaji_tu_smk_preview->tunjangan2->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->tunjangan2->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->tunjangan2->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->tambahan->Visible) { // tambahan ?>
		<!-- tambahan -->
		<td<?php echo $gaji_tu_smk_preview->tambahan->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->tambahan->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->tambahan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_tu_smk_preview->type_jabatan->Visible) { // type_jabatan ?>
		<!-- type_jabatan -->
		<td<?php echo $gaji_tu_smk_preview->type_jabatan->cellAttributes() ?>>
<span<?php echo $gaji_tu_smk_preview->type_jabatan->viewAttributes() ?>><?php echo $gaji_tu_smk_preview->type_jabatan->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$gaji_tu_smk_preview->ListOptions->render("body", "right", $gaji_tu_smk_preview->RowCount);
?>
	</tr>
<?php
	$gaji_tu_smk_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $gaji_tu_smk_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($gaji_tu_smk_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($gaji_tu_smk_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$gaji_tu_smk_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($gaji_tu_smk_preview->Recordset)
	$gaji_tu_smk_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$gaji_tu_smk_preview->terminate();
?>