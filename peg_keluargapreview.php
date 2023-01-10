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
$peg_keluarga_preview = new peg_keluarga_preview();

// Run the page
$peg_keluarga_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_keluarga_preview->Page_Render();
?>
<?php $peg_keluarga_preview->showPageHeader(); ?>
<?php if ($peg_keluarga_preview->TotalRecords > 0) { ?>
<div class="card ew-grid peg_keluarga"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$peg_keluarga_preview->renderListOptions();

// Render list options (header, left)
$peg_keluarga_preview->ListOptions->render("header", "left");
?>
<?php if ($peg_keluarga_preview->id->Visible) { // id ?>
	<?php if ($peg_keluarga->SortUrl($peg_keluarga_preview->id) == "") { ?>
		<th class="<?php echo $peg_keluarga_preview->id->headerCellClass() ?>"><?php echo $peg_keluarga_preview->id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_keluarga_preview->id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_keluarga_preview->id->Name) ?>" data-sort-order="<?php echo $peg_keluarga_preview->SortField == $peg_keluarga_preview->id->Name && $peg_keluarga_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_preview->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_preview->SortField == $peg_keluarga_preview->id->Name) { ?><?php if ($peg_keluarga_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_preview->pid->Visible) { // pid ?>
	<?php if ($peg_keluarga->SortUrl($peg_keluarga_preview->pid) == "") { ?>
		<th class="<?php echo $peg_keluarga_preview->pid->headerCellClass() ?>"><?php echo $peg_keluarga_preview->pid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_keluarga_preview->pid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_keluarga_preview->pid->Name) ?>" data-sort-order="<?php echo $peg_keluarga_preview->SortField == $peg_keluarga_preview->pid->Name && $peg_keluarga_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_preview->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_preview->SortField == $peg_keluarga_preview->pid->Name) { ?><?php if ($peg_keluarga_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_preview->nama->Visible) { // nama ?>
	<?php if ($peg_keluarga->SortUrl($peg_keluarga_preview->nama) == "") { ?>
		<th class="<?php echo $peg_keluarga_preview->nama->headerCellClass() ?>"><?php echo $peg_keluarga_preview->nama->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_keluarga_preview->nama->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_keluarga_preview->nama->Name) ?>" data-sort-order="<?php echo $peg_keluarga_preview->SortField == $peg_keluarga_preview->nama->Name && $peg_keluarga_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_preview->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_preview->SortField == $peg_keluarga_preview->nama->Name) { ?><?php if ($peg_keluarga_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_preview->hp->Visible) { // hp ?>
	<?php if ($peg_keluarga->SortUrl($peg_keluarga_preview->hp) == "") { ?>
		<th class="<?php echo $peg_keluarga_preview->hp->headerCellClass() ?>"><?php echo $peg_keluarga_preview->hp->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_keluarga_preview->hp->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_keluarga_preview->hp->Name) ?>" data-sort-order="<?php echo $peg_keluarga_preview->SortField == $peg_keluarga_preview->hp->Name && $peg_keluarga_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_preview->hp->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_preview->SortField == $peg_keluarga_preview->hp->Name) { ?><?php if ($peg_keluarga_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_preview->hubungan->Visible) { // hubungan ?>
	<?php if ($peg_keluarga->SortUrl($peg_keluarga_preview->hubungan) == "") { ?>
		<th class="<?php echo $peg_keluarga_preview->hubungan->headerCellClass() ?>"><?php echo $peg_keluarga_preview->hubungan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_keluarga_preview->hubungan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_keluarga_preview->hubungan->Name) ?>" data-sort-order="<?php echo $peg_keluarga_preview->SortField == $peg_keluarga_preview->hubungan->Name && $peg_keluarga_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_preview->hubungan->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_preview->SortField == $peg_keluarga_preview->hubungan->Name) { ?><?php if ($peg_keluarga_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_preview->tgl_lahir->Visible) { // tgl_lahir ?>
	<?php if ($peg_keluarga->SortUrl($peg_keluarga_preview->tgl_lahir) == "") { ?>
		<th class="<?php echo $peg_keluarga_preview->tgl_lahir->headerCellClass() ?>"><?php echo $peg_keluarga_preview->tgl_lahir->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_keluarga_preview->tgl_lahir->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_keluarga_preview->tgl_lahir->Name) ?>" data-sort-order="<?php echo $peg_keluarga_preview->SortField == $peg_keluarga_preview->tgl_lahir->Name && $peg_keluarga_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_preview->tgl_lahir->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_preview->SortField == $peg_keluarga_preview->tgl_lahir->Name) { ?><?php if ($peg_keluarga_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_preview->jen_kel->Visible) { // jen_kel ?>
	<?php if ($peg_keluarga->SortUrl($peg_keluarga_preview->jen_kel) == "") { ?>
		<th class="<?php echo $peg_keluarga_preview->jen_kel->headerCellClass() ?>"><?php echo $peg_keluarga_preview->jen_kel->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_keluarga_preview->jen_kel->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_keluarga_preview->jen_kel->Name) ?>" data-sort-order="<?php echo $peg_keluarga_preview->SortField == $peg_keluarga_preview->jen_kel->Name && $peg_keluarga_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_preview->jen_kel->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_preview->SortField == $peg_keluarga_preview->jen_kel->Name) { ?><?php if ($peg_keluarga_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$peg_keluarga_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$peg_keluarga_preview->RecCount = 0;
$peg_keluarga_preview->RowCount = 0;
while ($peg_keluarga_preview->Recordset && !$peg_keluarga_preview->Recordset->EOF) {

	// Init row class and style
	$peg_keluarga_preview->RecCount++;
	$peg_keluarga_preview->RowCount++;
	$peg_keluarga_preview->CssStyle = "";
	$peg_keluarga_preview->loadListRowValues($peg_keluarga_preview->Recordset);

	// Render row
	$peg_keluarga->RowType = ROWTYPE_PREVIEW; // Preview record
	$peg_keluarga_preview->resetAttributes();
	$peg_keluarga_preview->renderListRow();

	// Render list options
	$peg_keluarga_preview->renderListOptions();
?>
	<tr <?php echo $peg_keluarga->rowAttributes() ?>>
<?php

// Render list options (body, left)
$peg_keluarga_preview->ListOptions->render("body", "left", $peg_keluarga_preview->RowCount);
?>
<?php if ($peg_keluarga_preview->id->Visible) { // id ?>
		<!-- id -->
		<td<?php echo $peg_keluarga_preview->id->cellAttributes() ?>>
<span<?php echo $peg_keluarga_preview->id->viewAttributes() ?>><?php echo $peg_keluarga_preview->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_keluarga_preview->pid->Visible) { // pid ?>
		<!-- pid -->
		<td<?php echo $peg_keluarga_preview->pid->cellAttributes() ?>>
<span<?php echo $peg_keluarga_preview->pid->viewAttributes() ?>><?php echo $peg_keluarga_preview->pid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_keluarga_preview->nama->Visible) { // nama ?>
		<!-- nama -->
		<td<?php echo $peg_keluarga_preview->nama->cellAttributes() ?>>
<span<?php echo $peg_keluarga_preview->nama->viewAttributes() ?>><?php echo $peg_keluarga_preview->nama->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_keluarga_preview->hp->Visible) { // hp ?>
		<!-- hp -->
		<td<?php echo $peg_keluarga_preview->hp->cellAttributes() ?>>
<span<?php echo $peg_keluarga_preview->hp->viewAttributes() ?>><?php echo $peg_keluarga_preview->hp->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_keluarga_preview->hubungan->Visible) { // hubungan ?>
		<!-- hubungan -->
		<td<?php echo $peg_keluarga_preview->hubungan->cellAttributes() ?>>
<span<?php echo $peg_keluarga_preview->hubungan->viewAttributes() ?>><?php echo $peg_keluarga_preview->hubungan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_keluarga_preview->tgl_lahir->Visible) { // tgl_lahir ?>
		<!-- tgl_lahir -->
		<td<?php echo $peg_keluarga_preview->tgl_lahir->cellAttributes() ?>>
<span<?php echo $peg_keluarga_preview->tgl_lahir->viewAttributes() ?>><?php echo $peg_keluarga_preview->tgl_lahir->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_keluarga_preview->jen_kel->Visible) { // jen_kel ?>
		<!-- jen_kel -->
		<td<?php echo $peg_keluarga_preview->jen_kel->cellAttributes() ?>>
<span<?php echo $peg_keluarga_preview->jen_kel->viewAttributes() ?>><?php echo $peg_keluarga_preview->jen_kel->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$peg_keluarga_preview->ListOptions->render("body", "right", $peg_keluarga_preview->RowCount);
?>
	</tr>
<?php
	$peg_keluarga_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $peg_keluarga_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($peg_keluarga_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($peg_keluarga_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$peg_keluarga_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($peg_keluarga_preview->Recordset)
	$peg_keluarga_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$peg_keluarga_preview->terminate();
?>