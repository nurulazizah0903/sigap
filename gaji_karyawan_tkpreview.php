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
$gaji_karyawan_tk_preview = new gaji_karyawan_tk_preview();

// Run the page
$gaji_karyawan_tk_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_karyawan_tk_preview->Page_Render();
?>
<?php $gaji_karyawan_tk_preview->showPageHeader(); ?>
<?php if ($gaji_karyawan_tk_preview->TotalRecords > 0) { ?>
<div class="card ew-grid gaji_karyawan_tk"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$gaji_karyawan_tk_preview->renderListOptions();

// Render list options (header, left)
$gaji_karyawan_tk_preview->ListOptions->render("header", "left");
?>
<?php if ($gaji_karyawan_tk_preview->pegawai->Visible) { // pegawai ?>
	<?php if ($gaji_karyawan_tk->SortUrl($gaji_karyawan_tk_preview->pegawai) == "") { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->pegawai->headerCellClass() ?>"><?php echo $gaji_karyawan_tk_preview->pegawai->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->pegawai->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_karyawan_tk_preview->pegawai->Name) ?>" data-sort-order="<?php echo $gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->pegawai->Name && $gaji_karyawan_tk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_tk_preview->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->pegawai->Name) { ?><?php if ($gaji_karyawan_tk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_tk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->jenjang_id->Visible) { // jenjang_id ?>
	<?php if ($gaji_karyawan_tk->SortUrl($gaji_karyawan_tk_preview->jenjang_id) == "") { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->jenjang_id->headerCellClass() ?>"><?php echo $gaji_karyawan_tk_preview->jenjang_id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->jenjang_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_karyawan_tk_preview->jenjang_id->Name) ?>" data-sort-order="<?php echo $gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->jenjang_id->Name && $gaji_karyawan_tk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_tk_preview->jenjang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->jenjang_id->Name) { ?><?php if ($gaji_karyawan_tk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_tk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($gaji_karyawan_tk->SortUrl($gaji_karyawan_tk_preview->jabatan_id) == "") { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->jabatan_id->headerCellClass() ?>"><?php echo $gaji_karyawan_tk_preview->jabatan_id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->jabatan_id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_karyawan_tk_preview->jabatan_id->Name) ?>" data-sort-order="<?php echo $gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->jabatan_id->Name && $gaji_karyawan_tk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_tk_preview->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->jabatan_id->Name) { ?><?php if ($gaji_karyawan_tk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_tk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->kehadiran->Visible) { // kehadiran ?>
	<?php if ($gaji_karyawan_tk->SortUrl($gaji_karyawan_tk_preview->kehadiran) == "") { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->kehadiran->headerCellClass() ?>"><?php echo $gaji_karyawan_tk_preview->kehadiran->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->kehadiran->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_karyawan_tk_preview->kehadiran->Name) ?>" data-sort-order="<?php echo $gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->kehadiran->Name && $gaji_karyawan_tk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_tk_preview->kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->kehadiran->Name) { ?><?php if ($gaji_karyawan_tk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_tk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->gapok->Visible) { // gapok ?>
	<?php if ($gaji_karyawan_tk->SortUrl($gaji_karyawan_tk_preview->gapok) == "") { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->gapok->headerCellClass() ?>"><?php echo $gaji_karyawan_tk_preview->gapok->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->gapok->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_karyawan_tk_preview->gapok->Name) ?>" data-sort-order="<?php echo $gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->gapok->Name && $gaji_karyawan_tk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_tk_preview->gapok->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->gapok->Name) { ?><?php if ($gaji_karyawan_tk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_tk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->value_reward->Visible) { // value_reward ?>
	<?php if ($gaji_karyawan_tk->SortUrl($gaji_karyawan_tk_preview->value_reward) == "") { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->value_reward->headerCellClass() ?>"><?php echo $gaji_karyawan_tk_preview->value_reward->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->value_reward->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_karyawan_tk_preview->value_reward->Name) ?>" data-sort-order="<?php echo $gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->value_reward->Name && $gaji_karyawan_tk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_tk_preview->value_reward->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->value_reward->Name) { ?><?php if ($gaji_karyawan_tk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_tk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->value_inval->Visible) { // value_inval ?>
	<?php if ($gaji_karyawan_tk->SortUrl($gaji_karyawan_tk_preview->value_inval) == "") { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->value_inval->headerCellClass() ?>"><?php echo $gaji_karyawan_tk_preview->value_inval->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->value_inval->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_karyawan_tk_preview->value_inval->Name) ?>" data-sort-order="<?php echo $gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->value_inval->Name && $gaji_karyawan_tk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_tk_preview->value_inval->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->value_inval->Name) { ?><?php if ($gaji_karyawan_tk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_tk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->sub_total->Visible) { // sub_total ?>
	<?php if ($gaji_karyawan_tk->SortUrl($gaji_karyawan_tk_preview->sub_total) == "") { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->sub_total->headerCellClass() ?>"><?php echo $gaji_karyawan_tk_preview->sub_total->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->sub_total->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_karyawan_tk_preview->sub_total->Name) ?>" data-sort-order="<?php echo $gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->sub_total->Name && $gaji_karyawan_tk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_tk_preview->sub_total->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->sub_total->Name) { ?><?php if ($gaji_karyawan_tk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_tk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->potongan->Visible) { // potongan ?>
	<?php if ($gaji_karyawan_tk->SortUrl($gaji_karyawan_tk_preview->potongan) == "") { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->potongan->headerCellClass() ?>"><?php echo $gaji_karyawan_tk_preview->potongan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->potongan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_karyawan_tk_preview->potongan->Name) ?>" data-sort-order="<?php echo $gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->potongan->Name && $gaji_karyawan_tk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_tk_preview->potongan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->potongan->Name) { ?><?php if ($gaji_karyawan_tk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_tk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->penyesuaian->Visible) { // penyesuaian ?>
	<?php if ($gaji_karyawan_tk->SortUrl($gaji_karyawan_tk_preview->penyesuaian) == "") { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->penyesuaian->headerCellClass() ?>"><?php echo $gaji_karyawan_tk_preview->penyesuaian->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->penyesuaian->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_karyawan_tk_preview->penyesuaian->Name) ?>" data-sort-order="<?php echo $gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->penyesuaian->Name && $gaji_karyawan_tk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_tk_preview->penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->penyesuaian->Name) { ?><?php if ($gaji_karyawan_tk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_tk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->total->Visible) { // total ?>
	<?php if ($gaji_karyawan_tk->SortUrl($gaji_karyawan_tk_preview->total) == "") { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->total->headerCellClass() ?>"><?php echo $gaji_karyawan_tk_preview->total->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->total->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_karyawan_tk_preview->total->Name) ?>" data-sort-order="<?php echo $gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->total->Name && $gaji_karyawan_tk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_tk_preview->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->total->Name) { ?><?php if ($gaji_karyawan_tk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_tk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->jp->Visible) { // jp ?>
	<?php if ($gaji_karyawan_tk->SortUrl($gaji_karyawan_tk_preview->jp) == "") { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->jp->headerCellClass() ?>"><?php echo $gaji_karyawan_tk_preview->jp->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gaji_karyawan_tk_preview->jp->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gaji_karyawan_tk_preview->jp->Name) ?>" data-sort-order="<?php echo $gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->jp->Name && $gaji_karyawan_tk_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_tk_preview->jp->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_tk_preview->SortField == $gaji_karyawan_tk_preview->jp->Name) { ?><?php if ($gaji_karyawan_tk_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_tk_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gaji_karyawan_tk_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$gaji_karyawan_tk_preview->RecCount = 0;
$gaji_karyawan_tk_preview->RowCount = 0;
while ($gaji_karyawan_tk_preview->Recordset && !$gaji_karyawan_tk_preview->Recordset->EOF) {

	// Init row class and style
	$gaji_karyawan_tk_preview->RecCount++;
	$gaji_karyawan_tk_preview->RowCount++;
	$gaji_karyawan_tk_preview->CssStyle = "";
	$gaji_karyawan_tk_preview->loadListRowValues($gaji_karyawan_tk_preview->Recordset);

	// Render row
	$gaji_karyawan_tk->RowType = ROWTYPE_PREVIEW; // Preview record
	$gaji_karyawan_tk_preview->resetAttributes();
	$gaji_karyawan_tk_preview->renderListRow();

	// Render list options
	$gaji_karyawan_tk_preview->renderListOptions();
?>
	<tr <?php echo $gaji_karyawan_tk->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gaji_karyawan_tk_preview->ListOptions->render("body", "left", $gaji_karyawan_tk_preview->RowCount);
?>
<?php if ($gaji_karyawan_tk_preview->pegawai->Visible) { // pegawai ?>
		<!-- pegawai -->
		<td<?php echo $gaji_karyawan_tk_preview->pegawai->cellAttributes() ?>>
<span<?php echo $gaji_karyawan_tk_preview->pegawai->viewAttributes() ?>><?php echo $gaji_karyawan_tk_preview->pegawai->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->jenjang_id->Visible) { // jenjang_id ?>
		<!-- jenjang_id -->
		<td<?php echo $gaji_karyawan_tk_preview->jenjang_id->cellAttributes() ?>>
<span<?php echo $gaji_karyawan_tk_preview->jenjang_id->viewAttributes() ?>><?php echo $gaji_karyawan_tk_preview->jenjang_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->jabatan_id->Visible) { // jabatan_id ?>
		<!-- jabatan_id -->
		<td<?php echo $gaji_karyawan_tk_preview->jabatan_id->cellAttributes() ?>>
<span<?php echo $gaji_karyawan_tk_preview->jabatan_id->viewAttributes() ?>><?php echo $gaji_karyawan_tk_preview->jabatan_id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->kehadiran->Visible) { // kehadiran ?>
		<!-- kehadiran -->
		<td<?php echo $gaji_karyawan_tk_preview->kehadiran->cellAttributes() ?>>
<span<?php echo $gaji_karyawan_tk_preview->kehadiran->viewAttributes() ?>><?php echo $gaji_karyawan_tk_preview->kehadiran->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->gapok->Visible) { // gapok ?>
		<!-- gapok -->
		<td<?php echo $gaji_karyawan_tk_preview->gapok->cellAttributes() ?>>
<span<?php echo $gaji_karyawan_tk_preview->gapok->viewAttributes() ?>><?php echo $gaji_karyawan_tk_preview->gapok->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->value_reward->Visible) { // value_reward ?>
		<!-- value_reward -->
		<td<?php echo $gaji_karyawan_tk_preview->value_reward->cellAttributes() ?>>
<span<?php echo $gaji_karyawan_tk_preview->value_reward->viewAttributes() ?>><?php echo $gaji_karyawan_tk_preview->value_reward->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->value_inval->Visible) { // value_inval ?>
		<!-- value_inval -->
		<td<?php echo $gaji_karyawan_tk_preview->value_inval->cellAttributes() ?>>
<span<?php echo $gaji_karyawan_tk_preview->value_inval->viewAttributes() ?>><?php echo $gaji_karyawan_tk_preview->value_inval->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->sub_total->Visible) { // sub_total ?>
		<!-- sub_total -->
		<td<?php echo $gaji_karyawan_tk_preview->sub_total->cellAttributes() ?>>
<span<?php echo $gaji_karyawan_tk_preview->sub_total->viewAttributes() ?>><?php echo $gaji_karyawan_tk_preview->sub_total->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->potongan->Visible) { // potongan ?>
		<!-- potongan -->
		<td<?php echo $gaji_karyawan_tk_preview->potongan->cellAttributes() ?>>
<span<?php echo $gaji_karyawan_tk_preview->potongan->viewAttributes() ?>><?php echo $gaji_karyawan_tk_preview->potongan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->penyesuaian->Visible) { // penyesuaian ?>
		<!-- penyesuaian -->
		<td<?php echo $gaji_karyawan_tk_preview->penyesuaian->cellAttributes() ?>>
<span<?php echo $gaji_karyawan_tk_preview->penyesuaian->viewAttributes() ?>><?php echo $gaji_karyawan_tk_preview->penyesuaian->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->total->Visible) { // total ?>
		<!-- total -->
		<td<?php echo $gaji_karyawan_tk_preview->total->cellAttributes() ?>>
<span<?php echo $gaji_karyawan_tk_preview->total->viewAttributes() ?>><?php echo $gaji_karyawan_tk_preview->total->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gaji_karyawan_tk_preview->jp->Visible) { // jp ?>
		<!-- jp -->
		<td<?php echo $gaji_karyawan_tk_preview->jp->cellAttributes() ?>>
<span<?php echo $gaji_karyawan_tk_preview->jp->viewAttributes() ?>><?php echo $gaji_karyawan_tk_preview->jp->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$gaji_karyawan_tk_preview->ListOptions->render("body", "right", $gaji_karyawan_tk_preview->RowCount);
?>
	</tr>
<?php
	$gaji_karyawan_tk_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $gaji_karyawan_tk_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($gaji_karyawan_tk_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($gaji_karyawan_tk_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$gaji_karyawan_tk_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($gaji_karyawan_tk_preview->Recordset)
	$gaji_karyawan_tk_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$gaji_karyawan_tk_preview->terminate();
?>