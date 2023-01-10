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
$peg_dokumen_preview = new peg_dokumen_preview();

// Run the page
$peg_dokumen_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_dokumen_preview->Page_Render();
?>
<?php $peg_dokumen_preview->showPageHeader(); ?>
<?php if ($peg_dokumen_preview->TotalRecords > 0) { ?>
<div class="card ew-grid peg_dokumen"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$peg_dokumen_preview->renderListOptions();

// Render list options (header, left)
$peg_dokumen_preview->ListOptions->render("header", "left");
?>
<?php if ($peg_dokumen_preview->id->Visible) { // id ?>
	<?php if ($peg_dokumen->SortUrl($peg_dokumen_preview->id) == "") { ?>
		<th class="<?php echo $peg_dokumen_preview->id->headerCellClass() ?>"><?php echo $peg_dokumen_preview->id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_dokumen_preview->id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_dokumen_preview->id->Name) ?>" data-sort-order="<?php echo $peg_dokumen_preview->SortField == $peg_dokumen_preview->id->Name && $peg_dokumen_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_preview->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_preview->SortField == $peg_dokumen_preview->id->Name) { ?><?php if ($peg_dokumen_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_preview->pid->Visible) { // pid ?>
	<?php if ($peg_dokumen->SortUrl($peg_dokumen_preview->pid) == "") { ?>
		<th class="<?php echo $peg_dokumen_preview->pid->headerCellClass() ?>"><?php echo $peg_dokumen_preview->pid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_dokumen_preview->pid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_dokumen_preview->pid->Name) ?>" data-sort-order="<?php echo $peg_dokumen_preview->SortField == $peg_dokumen_preview->pid->Name && $peg_dokumen_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_preview->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_preview->SortField == $peg_dokumen_preview->pid->Name) { ?><?php if ($peg_dokumen_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_preview->nama_dokumen->Visible) { // nama_dokumen ?>
	<?php if ($peg_dokumen->SortUrl($peg_dokumen_preview->nama_dokumen) == "") { ?>
		<th class="<?php echo $peg_dokumen_preview->nama_dokumen->headerCellClass() ?>"><?php echo $peg_dokumen_preview->nama_dokumen->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_dokumen_preview->nama_dokumen->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_dokumen_preview->nama_dokumen->Name) ?>" data-sort-order="<?php echo $peg_dokumen_preview->SortField == $peg_dokumen_preview->nama_dokumen->Name && $peg_dokumen_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_preview->nama_dokumen->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_preview->SortField == $peg_dokumen_preview->nama_dokumen->Name) { ?><?php if ($peg_dokumen_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_preview->file_dokumen->Visible) { // file_dokumen ?>
	<?php if ($peg_dokumen->SortUrl($peg_dokumen_preview->file_dokumen) == "") { ?>
		<th class="<?php echo $peg_dokumen_preview->file_dokumen->headerCellClass() ?>"><?php echo $peg_dokumen_preview->file_dokumen->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_dokumen_preview->file_dokumen->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_dokumen_preview->file_dokumen->Name) ?>" data-sort-order="<?php echo $peg_dokumen_preview->SortField == $peg_dokumen_preview->file_dokumen->Name && $peg_dokumen_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_preview->file_dokumen->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_preview->SortField == $peg_dokumen_preview->file_dokumen->Name) { ?><?php if ($peg_dokumen_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_preview->keterangan->Visible) { // keterangan ?>
	<?php if ($peg_dokumen->SortUrl($peg_dokumen_preview->keterangan) == "") { ?>
		<th class="<?php echo $peg_dokumen_preview->keterangan->headerCellClass() ?>"><?php echo $peg_dokumen_preview->keterangan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_dokumen_preview->keterangan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_dokumen_preview->keterangan->Name) ?>" data-sort-order="<?php echo $peg_dokumen_preview->SortField == $peg_dokumen_preview->keterangan->Name && $peg_dokumen_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_preview->keterangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_preview->SortField == $peg_dokumen_preview->keterangan->Name) { ?><?php if ($peg_dokumen_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_preview->c_date->Visible) { // c_date ?>
	<?php if ($peg_dokumen->SortUrl($peg_dokumen_preview->c_date) == "") { ?>
		<th class="<?php echo $peg_dokumen_preview->c_date->headerCellClass() ?>"><?php echo $peg_dokumen_preview->c_date->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_dokumen_preview->c_date->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_dokumen_preview->c_date->Name) ?>" data-sort-order="<?php echo $peg_dokumen_preview->SortField == $peg_dokumen_preview->c_date->Name && $peg_dokumen_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_preview->c_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_preview->SortField == $peg_dokumen_preview->c_date->Name) { ?><?php if ($peg_dokumen_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_preview->u_date->Visible) { // u_date ?>
	<?php if ($peg_dokumen->SortUrl($peg_dokumen_preview->u_date) == "") { ?>
		<th class="<?php echo $peg_dokumen_preview->u_date->headerCellClass() ?>"><?php echo $peg_dokumen_preview->u_date->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_dokumen_preview->u_date->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_dokumen_preview->u_date->Name) ?>" data-sort-order="<?php echo $peg_dokumen_preview->SortField == $peg_dokumen_preview->u_date->Name && $peg_dokumen_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_preview->u_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_preview->SortField == $peg_dokumen_preview->u_date->Name) { ?><?php if ($peg_dokumen_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_preview->c_by->Visible) { // c_by ?>
	<?php if ($peg_dokumen->SortUrl($peg_dokumen_preview->c_by) == "") { ?>
		<th class="<?php echo $peg_dokumen_preview->c_by->headerCellClass() ?>"><?php echo $peg_dokumen_preview->c_by->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_dokumen_preview->c_by->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_dokumen_preview->c_by->Name) ?>" data-sort-order="<?php echo $peg_dokumen_preview->SortField == $peg_dokumen_preview->c_by->Name && $peg_dokumen_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_preview->c_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_preview->SortField == $peg_dokumen_preview->c_by->Name) { ?><?php if ($peg_dokumen_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_preview->u_by->Visible) { // u_by ?>
	<?php if ($peg_dokumen->SortUrl($peg_dokumen_preview->u_by) == "") { ?>
		<th class="<?php echo $peg_dokumen_preview->u_by->headerCellClass() ?>"><?php echo $peg_dokumen_preview->u_by->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_dokumen_preview->u_by->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_dokumen_preview->u_by->Name) ?>" data-sort-order="<?php echo $peg_dokumen_preview->SortField == $peg_dokumen_preview->u_by->Name && $peg_dokumen_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_preview->u_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_preview->SortField == $peg_dokumen_preview->u_by->Name) { ?><?php if ($peg_dokumen_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$peg_dokumen_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$peg_dokumen_preview->RecCount = 0;
$peg_dokumen_preview->RowCount = 0;
while ($peg_dokumen_preview->Recordset && !$peg_dokumen_preview->Recordset->EOF) {

	// Init row class and style
	$peg_dokumen_preview->RecCount++;
	$peg_dokumen_preview->RowCount++;
	$peg_dokumen_preview->CssStyle = "";
	$peg_dokumen_preview->loadListRowValues($peg_dokumen_preview->Recordset);

	// Render row
	$peg_dokumen->RowType = ROWTYPE_PREVIEW; // Preview record
	$peg_dokumen_preview->resetAttributes();
	$peg_dokumen_preview->renderListRow();

	// Render list options
	$peg_dokumen_preview->renderListOptions();
?>
	<tr <?php echo $peg_dokumen->rowAttributes() ?>>
<?php

// Render list options (body, left)
$peg_dokumen_preview->ListOptions->render("body", "left", $peg_dokumen_preview->RowCount);
?>
<?php if ($peg_dokumen_preview->id->Visible) { // id ?>
		<!-- id -->
		<td<?php echo $peg_dokumen_preview->id->cellAttributes() ?>>
<span<?php echo $peg_dokumen_preview->id->viewAttributes() ?>><?php echo $peg_dokumen_preview->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_dokumen_preview->pid->Visible) { // pid ?>
		<!-- pid -->
		<td<?php echo $peg_dokumen_preview->pid->cellAttributes() ?>>
<span<?php echo $peg_dokumen_preview->pid->viewAttributes() ?>><?php echo $peg_dokumen_preview->pid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_dokumen_preview->nama_dokumen->Visible) { // nama_dokumen ?>
		<!-- nama_dokumen -->
		<td<?php echo $peg_dokumen_preview->nama_dokumen->cellAttributes() ?>>
<span<?php echo $peg_dokumen_preview->nama_dokumen->viewAttributes() ?>><?php echo $peg_dokumen_preview->nama_dokumen->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_dokumen_preview->file_dokumen->Visible) { // file_dokumen ?>
		<!-- file_dokumen -->
		<td<?php echo $peg_dokumen_preview->file_dokumen->cellAttributes() ?>>
<span<?php echo $peg_dokumen_preview->file_dokumen->viewAttributes() ?>><?php echo $peg_dokumen_preview->file_dokumen->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_dokumen_preview->keterangan->Visible) { // keterangan ?>
		<!-- keterangan -->
		<td<?php echo $peg_dokumen_preview->keterangan->cellAttributes() ?>>
<span<?php echo $peg_dokumen_preview->keterangan->viewAttributes() ?>><?php echo $peg_dokumen_preview->keterangan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_dokumen_preview->c_date->Visible) { // c_date ?>
		<!-- c_date -->
		<td<?php echo $peg_dokumen_preview->c_date->cellAttributes() ?>>
<span<?php echo $peg_dokumen_preview->c_date->viewAttributes() ?>><?php echo $peg_dokumen_preview->c_date->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_dokumen_preview->u_date->Visible) { // u_date ?>
		<!-- u_date -->
		<td<?php echo $peg_dokumen_preview->u_date->cellAttributes() ?>>
<span<?php echo $peg_dokumen_preview->u_date->viewAttributes() ?>><?php echo $peg_dokumen_preview->u_date->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_dokumen_preview->c_by->Visible) { // c_by ?>
		<!-- c_by -->
		<td<?php echo $peg_dokumen_preview->c_by->cellAttributes() ?>>
<span<?php echo $peg_dokumen_preview->c_by->viewAttributes() ?>><?php echo $peg_dokumen_preview->c_by->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_dokumen_preview->u_by->Visible) { // u_by ?>
		<!-- u_by -->
		<td<?php echo $peg_dokumen_preview->u_by->cellAttributes() ?>>
<span<?php echo $peg_dokumen_preview->u_by->viewAttributes() ?>><?php echo $peg_dokumen_preview->u_by->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$peg_dokumen_preview->ListOptions->render("body", "right", $peg_dokumen_preview->RowCount);
?>
	</tr>
<?php
	$peg_dokumen_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $peg_dokumen_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($peg_dokumen_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($peg_dokumen_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$peg_dokumen_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($peg_dokumen_preview->Recordset)
	$peg_dokumen_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$peg_dokumen_preview->terminate();
?>