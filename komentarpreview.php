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
$komentar_preview = new komentar_preview();

// Run the page
$komentar_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$komentar_preview->Page_Render();
?>
<?php $komentar_preview->showPageHeader(); ?>
<?php if ($komentar_preview->TotalRecords > 0) { ?>
<div class="card ew-grid komentar"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$komentar_preview->renderListOptions();

// Render list options (header, left)
$komentar_preview->ListOptions->render("header", "left");
?>
<?php if ($komentar_preview->id->Visible) { // id ?>
	<?php if ($komentar->SortUrl($komentar_preview->id) == "") { ?>
		<th class="<?php echo $komentar_preview->id->headerCellClass() ?>"><?php echo $komentar_preview->id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $komentar_preview->id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($komentar_preview->id->Name) ?>" data-sort-order="<?php echo $komentar_preview->SortField == $komentar_preview->id->Name && $komentar_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_preview->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($komentar_preview->SortField == $komentar_preview->id->Name) { ?><?php if ($komentar_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($komentar_preview->pid->Visible) { // pid ?>
	<?php if ($komentar->SortUrl($komentar_preview->pid) == "") { ?>
		<th class="<?php echo $komentar_preview->pid->headerCellClass() ?>"><?php echo $komentar_preview->pid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $komentar_preview->pid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($komentar_preview->pid->Name) ?>" data-sort-order="<?php echo $komentar_preview->SortField == $komentar_preview->pid->Name && $komentar_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_preview->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($komentar_preview->SortField == $komentar_preview->pid->Name) { ?><?php if ($komentar_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($komentar_preview->gambar->Visible) { // gambar ?>
	<?php if ($komentar->SortUrl($komentar_preview->gambar) == "") { ?>
		<th class="<?php echo $komentar_preview->gambar->headerCellClass() ?>"><?php echo $komentar_preview->gambar->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $komentar_preview->gambar->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($komentar_preview->gambar->Name) ?>" data-sort-order="<?php echo $komentar_preview->SortField == $komentar_preview->gambar->Name && $komentar_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_preview->gambar->caption() ?></span><span class="ew-table-header-sort"><?php if ($komentar_preview->SortField == $komentar_preview->gambar->Name) { ?><?php if ($komentar_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($komentar_preview->video->Visible) { // video ?>
	<?php if ($komentar->SortUrl($komentar_preview->video) == "") { ?>
		<th class="<?php echo $komentar_preview->video->headerCellClass() ?>"><?php echo $komentar_preview->video->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $komentar_preview->video->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($komentar_preview->video->Name) ?>" data-sort-order="<?php echo $komentar_preview->SortField == $komentar_preview->video->Name && $komentar_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_preview->video->caption() ?></span><span class="ew-table-header-sort"><?php if ($komentar_preview->SortField == $komentar_preview->video->Name) { ?><?php if ($komentar_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($komentar_preview->pegawai->Visible) { // pegawai ?>
	<?php if ($komentar->SortUrl($komentar_preview->pegawai) == "") { ?>
		<th class="<?php echo $komentar_preview->pegawai->headerCellClass() ?>"><?php echo $komentar_preview->pegawai->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $komentar_preview->pegawai->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($komentar_preview->pegawai->Name) ?>" data-sort-order="<?php echo $komentar_preview->SortField == $komentar_preview->pegawai->Name && $komentar_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $komentar_preview->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($komentar_preview->SortField == $komentar_preview->pegawai->Name) { ?><?php if ($komentar_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($komentar_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$komentar_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$komentar_preview->RecCount = 0;
$komentar_preview->RowCount = 0;
while ($komentar_preview->Recordset && !$komentar_preview->Recordset->EOF) {

	// Init row class and style
	$komentar_preview->RecCount++;
	$komentar_preview->RowCount++;
	$komentar_preview->CssStyle = "";
	$komentar_preview->loadListRowValues($komentar_preview->Recordset);

	// Render row
	$komentar->RowType = ROWTYPE_PREVIEW; // Preview record
	$komentar_preview->resetAttributes();
	$komentar_preview->renderListRow();

	// Render list options
	$komentar_preview->renderListOptions();
?>
	<tr <?php echo $komentar->rowAttributes() ?>>
<?php

// Render list options (body, left)
$komentar_preview->ListOptions->render("body", "left", $komentar_preview->RowCount);
?>
<?php if ($komentar_preview->id->Visible) { // id ?>
		<!-- id -->
		<td<?php echo $komentar_preview->id->cellAttributes() ?>>
<span<?php echo $komentar_preview->id->viewAttributes() ?>><?php echo $komentar_preview->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($komentar_preview->pid->Visible) { // pid ?>
		<!-- pid -->
		<td<?php echo $komentar_preview->pid->cellAttributes() ?>>
<span<?php echo $komentar_preview->pid->viewAttributes() ?>><?php echo $komentar_preview->pid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($komentar_preview->gambar->Visible) { // gambar ?>
		<!-- gambar -->
		<td<?php echo $komentar_preview->gambar->cellAttributes() ?>>
<span<?php echo $komentar_preview->gambar->viewAttributes() ?>><?php echo $komentar_preview->gambar->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($komentar_preview->video->Visible) { // video ?>
		<!-- video -->
		<td<?php echo $komentar_preview->video->cellAttributes() ?>>
<span<?php echo $komentar_preview->video->viewAttributes() ?>><?php echo $komentar_preview->video->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($komentar_preview->pegawai->Visible) { // pegawai ?>
		<!-- pegawai -->
		<td<?php echo $komentar_preview->pegawai->cellAttributes() ?>>
<span<?php echo $komentar_preview->pegawai->viewAttributes() ?>><?php echo $komentar_preview->pegawai->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$komentar_preview->ListOptions->render("body", "right", $komentar_preview->RowCount);
?>
	</tr>
<?php
	$komentar_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $komentar_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($komentar_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($komentar_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$komentar_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($komentar_preview->Recordset)
	$komentar_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$komentar_preview->terminate();
?>