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
$gajitunjangan_preview = new gajitunjangan_preview();

// Run the page
$gajitunjangan_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitunjangan_preview->Page_Render();
?>
<?php $gajitunjangan_preview->showPageHeader(); ?>
<?php if ($gajitunjangan_preview->TotalRecords > 0) { ?>
<div class="card ew-grid gajitunjangan"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$gajitunjangan_preview->renderListOptions();

// Render list options (header, left)
$gajitunjangan_preview->ListOptions->render("header", "left");
?>
<?php if ($gajitunjangan_preview->pidjabatan->Visible) { // pidjabatan ?>
	<?php if ($gajitunjangan->SortUrl($gajitunjangan_preview->pidjabatan) == "") { ?>
		<th class="<?php echo $gajitunjangan_preview->pidjabatan->headerCellClass() ?>"><?php echo $gajitunjangan_preview->pidjabatan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitunjangan_preview->pidjabatan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitunjangan_preview->pidjabatan->Name) ?>" data-sort-order="<?php echo $gajitunjangan_preview->SortField == $gajitunjangan_preview->pidjabatan->Name && $gajitunjangan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_preview->pidjabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_preview->SortField == $gajitunjangan_preview->pidjabatan->Name) { ?><?php if ($gajitunjangan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_preview->value_kehadiran->Visible) { // value_kehadiran ?>
	<?php if ($gajitunjangan->SortUrl($gajitunjangan_preview->value_kehadiran) == "") { ?>
		<th class="<?php echo $gajitunjangan_preview->value_kehadiran->headerCellClass() ?>"><?php echo $gajitunjangan_preview->value_kehadiran->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitunjangan_preview->value_kehadiran->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitunjangan_preview->value_kehadiran->Name) ?>" data-sort-order="<?php echo $gajitunjangan_preview->SortField == $gajitunjangan_preview->value_kehadiran->Name && $gajitunjangan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_preview->value_kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_preview->SortField == $gajitunjangan_preview->value_kehadiran->Name) { ?><?php if ($gajitunjangan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_preview->gapok->Visible) { // gapok ?>
	<?php if ($gajitunjangan->SortUrl($gajitunjangan_preview->gapok) == "") { ?>
		<th class="<?php echo $gajitunjangan_preview->gapok->headerCellClass() ?>"><?php echo $gajitunjangan_preview->gapok->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitunjangan_preview->gapok->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitunjangan_preview->gapok->Name) ?>" data-sort-order="<?php echo $gajitunjangan_preview->SortField == $gajitunjangan_preview->gapok->Name && $gajitunjangan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_preview->gapok->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_preview->SortField == $gajitunjangan_preview->gapok->Name) { ?><?php if ($gajitunjangan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_preview->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
	<?php if ($gajitunjangan->SortUrl($gajitunjangan_preview->tunjangan_jabatan) == "") { ?>
		<th class="<?php echo $gajitunjangan_preview->tunjangan_jabatan->headerCellClass() ?>"><?php echo $gajitunjangan_preview->tunjangan_jabatan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitunjangan_preview->tunjangan_jabatan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitunjangan_preview->tunjangan_jabatan->Name) ?>" data-sort-order="<?php echo $gajitunjangan_preview->SortField == $gajitunjangan_preview->tunjangan_jabatan->Name && $gajitunjangan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_preview->tunjangan_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_preview->SortField == $gajitunjangan_preview->tunjangan_jabatan->Name) { ?><?php if ($gajitunjangan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_preview->reward->Visible) { // reward ?>
	<?php if ($gajitunjangan->SortUrl($gajitunjangan_preview->reward) == "") { ?>
		<th class="<?php echo $gajitunjangan_preview->reward->headerCellClass() ?>"><?php echo $gajitunjangan_preview->reward->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitunjangan_preview->reward->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitunjangan_preview->reward->Name) ?>" data-sort-order="<?php echo $gajitunjangan_preview->SortField == $gajitunjangan_preview->reward->Name && $gajitunjangan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_preview->reward->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_preview->SortField == $gajitunjangan_preview->reward->Name) { ?><?php if ($gajitunjangan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_preview->lembur->Visible) { // lembur ?>
	<?php if ($gajitunjangan->SortUrl($gajitunjangan_preview->lembur) == "") { ?>
		<th class="<?php echo $gajitunjangan_preview->lembur->headerCellClass() ?>"><?php echo $gajitunjangan_preview->lembur->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitunjangan_preview->lembur->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitunjangan_preview->lembur->Name) ?>" data-sort-order="<?php echo $gajitunjangan_preview->SortField == $gajitunjangan_preview->lembur->Name && $gajitunjangan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_preview->lembur->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_preview->SortField == $gajitunjangan_preview->lembur->Name) { ?><?php if ($gajitunjangan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_preview->piket->Visible) { // piket ?>
	<?php if ($gajitunjangan->SortUrl($gajitunjangan_preview->piket) == "") { ?>
		<th class="<?php echo $gajitunjangan_preview->piket->headerCellClass() ?>"><?php echo $gajitunjangan_preview->piket->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitunjangan_preview->piket->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitunjangan_preview->piket->Name) ?>" data-sort-order="<?php echo $gajitunjangan_preview->SortField == $gajitunjangan_preview->piket->Name && $gajitunjangan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_preview->piket->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_preview->SortField == $gajitunjangan_preview->piket->Name) { ?><?php if ($gajitunjangan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_preview->inval->Visible) { // inval ?>
	<?php if ($gajitunjangan->SortUrl($gajitunjangan_preview->inval) == "") { ?>
		<th class="<?php echo $gajitunjangan_preview->inval->headerCellClass() ?>"><?php echo $gajitunjangan_preview->inval->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitunjangan_preview->inval->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitunjangan_preview->inval->Name) ?>" data-sort-order="<?php echo $gajitunjangan_preview->SortField == $gajitunjangan_preview->inval->Name && $gajitunjangan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_preview->inval->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_preview->SortField == $gajitunjangan_preview->inval->Name) { ?><?php if ($gajitunjangan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_preview->jam_lebih->Visible) { // jam_lebih ?>
	<?php if ($gajitunjangan->SortUrl($gajitunjangan_preview->jam_lebih) == "") { ?>
		<th class="<?php echo $gajitunjangan_preview->jam_lebih->headerCellClass() ?>"><?php echo $gajitunjangan_preview->jam_lebih->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitunjangan_preview->jam_lebih->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitunjangan_preview->jam_lebih->Name) ?>" data-sort-order="<?php echo $gajitunjangan_preview->SortField == $gajitunjangan_preview->jam_lebih->Name && $gajitunjangan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_preview->jam_lebih->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_preview->SortField == $gajitunjangan_preview->jam_lebih->Name) { ?><?php if ($gajitunjangan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_preview->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
	<?php if ($gajitunjangan->SortUrl($gajitunjangan_preview->tunjangan_khusus) == "") { ?>
		<th class="<?php echo $gajitunjangan_preview->tunjangan_khusus->headerCellClass() ?>"><?php echo $gajitunjangan_preview->tunjangan_khusus->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitunjangan_preview->tunjangan_khusus->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitunjangan_preview->tunjangan_khusus->Name) ?>" data-sort-order="<?php echo $gajitunjangan_preview->SortField == $gajitunjangan_preview->tunjangan_khusus->Name && $gajitunjangan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_preview->tunjangan_khusus->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_preview->SortField == $gajitunjangan_preview->tunjangan_khusus->Name) { ?><?php if ($gajitunjangan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_preview->ekstrakuri->Visible) { // ekstrakuri ?>
	<?php if ($gajitunjangan->SortUrl($gajitunjangan_preview->ekstrakuri) == "") { ?>
		<th class="<?php echo $gajitunjangan_preview->ekstrakuri->headerCellClass() ?>"><?php echo $gajitunjangan_preview->ekstrakuri->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $gajitunjangan_preview->ekstrakuri->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($gajitunjangan_preview->ekstrakuri->Name) ?>" data-sort-order="<?php echo $gajitunjangan_preview->SortField == $gajitunjangan_preview->ekstrakuri->Name && $gajitunjangan_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_preview->ekstrakuri->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_preview->SortField == $gajitunjangan_preview->ekstrakuri->Name) { ?><?php if ($gajitunjangan_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajitunjangan_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$gajitunjangan_preview->RecCount = 0;
$gajitunjangan_preview->RowCount = 0;
while ($gajitunjangan_preview->Recordset && !$gajitunjangan_preview->Recordset->EOF) {

	// Init row class and style
	$gajitunjangan_preview->RecCount++;
	$gajitunjangan_preview->RowCount++;
	$gajitunjangan_preview->CssStyle = "";
	$gajitunjangan_preview->loadListRowValues($gajitunjangan_preview->Recordset);

	// Render row
	$gajitunjangan->RowType = ROWTYPE_PREVIEW; // Preview record
	$gajitunjangan_preview->resetAttributes();
	$gajitunjangan_preview->renderListRow();

	// Render list options
	$gajitunjangan_preview->renderListOptions();
?>
	<tr <?php echo $gajitunjangan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajitunjangan_preview->ListOptions->render("body", "left", $gajitunjangan_preview->RowCount);
?>
<?php if ($gajitunjangan_preview->pidjabatan->Visible) { // pidjabatan ?>
		<!-- pidjabatan -->
		<td<?php echo $gajitunjangan_preview->pidjabatan->cellAttributes() ?>>
<span<?php echo $gajitunjangan_preview->pidjabatan->viewAttributes() ?>><?php echo $gajitunjangan_preview->pidjabatan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitunjangan_preview->value_kehadiran->Visible) { // value_kehadiran ?>
		<!-- value_kehadiran -->
		<td<?php echo $gajitunjangan_preview->value_kehadiran->cellAttributes() ?>>
<span<?php echo $gajitunjangan_preview->value_kehadiran->viewAttributes() ?>><?php echo $gajitunjangan_preview->value_kehadiran->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitunjangan_preview->gapok->Visible) { // gapok ?>
		<!-- gapok -->
		<td<?php echo $gajitunjangan_preview->gapok->cellAttributes() ?>>
<span<?php echo $gajitunjangan_preview->gapok->viewAttributes() ?>><?php echo $gajitunjangan_preview->gapok->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitunjangan_preview->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
		<!-- tunjangan_jabatan -->
		<td<?php echo $gajitunjangan_preview->tunjangan_jabatan->cellAttributes() ?>>
<span<?php echo $gajitunjangan_preview->tunjangan_jabatan->viewAttributes() ?>><?php echo $gajitunjangan_preview->tunjangan_jabatan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitunjangan_preview->reward->Visible) { // reward ?>
		<!-- reward -->
		<td<?php echo $gajitunjangan_preview->reward->cellAttributes() ?>>
<span<?php echo $gajitunjangan_preview->reward->viewAttributes() ?>><?php echo $gajitunjangan_preview->reward->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitunjangan_preview->lembur->Visible) { // lembur ?>
		<!-- lembur -->
		<td<?php echo $gajitunjangan_preview->lembur->cellAttributes() ?>>
<span<?php echo $gajitunjangan_preview->lembur->viewAttributes() ?>><?php echo $gajitunjangan_preview->lembur->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitunjangan_preview->piket->Visible) { // piket ?>
		<!-- piket -->
		<td<?php echo $gajitunjangan_preview->piket->cellAttributes() ?>>
<span<?php echo $gajitunjangan_preview->piket->viewAttributes() ?>><?php echo $gajitunjangan_preview->piket->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitunjangan_preview->inval->Visible) { // inval ?>
		<!-- inval -->
		<td<?php echo $gajitunjangan_preview->inval->cellAttributes() ?>>
<span<?php echo $gajitunjangan_preview->inval->viewAttributes() ?>><?php echo $gajitunjangan_preview->inval->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitunjangan_preview->jam_lebih->Visible) { // jam_lebih ?>
		<!-- jam_lebih -->
		<td<?php echo $gajitunjangan_preview->jam_lebih->cellAttributes() ?>>
<span<?php echo $gajitunjangan_preview->jam_lebih->viewAttributes() ?>><?php echo $gajitunjangan_preview->jam_lebih->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitunjangan_preview->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
		<!-- tunjangan_khusus -->
		<td<?php echo $gajitunjangan_preview->tunjangan_khusus->cellAttributes() ?>>
<span<?php echo $gajitunjangan_preview->tunjangan_khusus->viewAttributes() ?>><?php echo $gajitunjangan_preview->tunjangan_khusus->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($gajitunjangan_preview->ekstrakuri->Visible) { // ekstrakuri ?>
		<!-- ekstrakuri -->
		<td<?php echo $gajitunjangan_preview->ekstrakuri->cellAttributes() ?>>
<span<?php echo $gajitunjangan_preview->ekstrakuri->viewAttributes() ?>><?php echo $gajitunjangan_preview->ekstrakuri->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$gajitunjangan_preview->ListOptions->render("body", "right", $gajitunjangan_preview->RowCount);
?>
	</tr>
<?php
	$gajitunjangan_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $gajitunjangan_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($gajitunjangan_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($gajitunjangan_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$gajitunjangan_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($gajitunjangan_preview->Recordset)
	$gajitunjangan_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$gajitunjangan_preview->terminate();
?>