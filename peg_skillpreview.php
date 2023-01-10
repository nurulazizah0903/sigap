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
$peg_skill_preview = new peg_skill_preview();

// Run the page
$peg_skill_preview->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_skill_preview->Page_Render();
?>
<?php $peg_skill_preview->showPageHeader(); ?>
<?php if ($peg_skill_preview->TotalRecords > 0) { ?>
<div class="card ew-grid peg_skill"><!-- .card -->
<div class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel ew-preview-middle-panel"><!-- .table-responsive -->
<table class="table ew-table ew-preview-table"><!-- .table -->
	<thead><!-- Table header -->
		<tr class="ew-table-header">
<?php

// Render list options
$peg_skill_preview->renderListOptions();

// Render list options (header, left)
$peg_skill_preview->ListOptions->render("header", "left");
?>
<?php if ($peg_skill_preview->id->Visible) { // id ?>
	<?php if ($peg_skill->SortUrl($peg_skill_preview->id) == "") { ?>
		<th class="<?php echo $peg_skill_preview->id->headerCellClass() ?>"><?php echo $peg_skill_preview->id->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_skill_preview->id->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_skill_preview->id->Name) ?>" data-sort-order="<?php echo $peg_skill_preview->SortField == $peg_skill_preview->id->Name && $peg_skill_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_preview->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_preview->SortField == $peg_skill_preview->id->Name) { ?><?php if ($peg_skill_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_preview->pid->Visible) { // pid ?>
	<?php if ($peg_skill->SortUrl($peg_skill_preview->pid) == "") { ?>
		<th class="<?php echo $peg_skill_preview->pid->headerCellClass() ?>"><?php echo $peg_skill_preview->pid->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_skill_preview->pid->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_skill_preview->pid->Name) ?>" data-sort-order="<?php echo $peg_skill_preview->SortField == $peg_skill_preview->pid->Name && $peg_skill_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_preview->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_preview->SortField == $peg_skill_preview->pid->Name) { ?><?php if ($peg_skill_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_preview->keahlian->Visible) { // keahlian ?>
	<?php if ($peg_skill->SortUrl($peg_skill_preview->keahlian) == "") { ?>
		<th class="<?php echo $peg_skill_preview->keahlian->headerCellClass() ?>"><?php echo $peg_skill_preview->keahlian->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_skill_preview->keahlian->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_skill_preview->keahlian->Name) ?>" data-sort-order="<?php echo $peg_skill_preview->SortField == $peg_skill_preview->keahlian->Name && $peg_skill_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_preview->keahlian->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_preview->SortField == $peg_skill_preview->keahlian->Name) { ?><?php if ($peg_skill_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_preview->tingkat->Visible) { // tingkat ?>
	<?php if ($peg_skill->SortUrl($peg_skill_preview->tingkat) == "") { ?>
		<th class="<?php echo $peg_skill_preview->tingkat->headerCellClass() ?>"><?php echo $peg_skill_preview->tingkat->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_skill_preview->tingkat->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_skill_preview->tingkat->Name) ?>" data-sort-order="<?php echo $peg_skill_preview->SortField == $peg_skill_preview->tingkat->Name && $peg_skill_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_preview->tingkat->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_preview->SortField == $peg_skill_preview->tingkat->Name) { ?><?php if ($peg_skill_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_preview->bukti->Visible) { // bukti ?>
	<?php if ($peg_skill->SortUrl($peg_skill_preview->bukti) == "") { ?>
		<th class="<?php echo $peg_skill_preview->bukti->headerCellClass() ?>"><?php echo $peg_skill_preview->bukti->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_skill_preview->bukti->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_skill_preview->bukti->Name) ?>" data-sort-order="<?php echo $peg_skill_preview->SortField == $peg_skill_preview->bukti->Name && $peg_skill_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_preview->bukti->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_preview->SortField == $peg_skill_preview->bukti->Name) { ?><?php if ($peg_skill_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_preview->keterangan->Visible) { // keterangan ?>
	<?php if ($peg_skill->SortUrl($peg_skill_preview->keterangan) == "") { ?>
		<th class="<?php echo $peg_skill_preview->keterangan->headerCellClass() ?>"><?php echo $peg_skill_preview->keterangan->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_skill_preview->keterangan->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_skill_preview->keterangan->Name) ?>" data-sort-order="<?php echo $peg_skill_preview->SortField == $peg_skill_preview->keterangan->Name && $peg_skill_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_preview->keterangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_preview->SortField == $peg_skill_preview->keterangan->Name) { ?><?php if ($peg_skill_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_preview->c_date->Visible) { // c_date ?>
	<?php if ($peg_skill->SortUrl($peg_skill_preview->c_date) == "") { ?>
		<th class="<?php echo $peg_skill_preview->c_date->headerCellClass() ?>"><?php echo $peg_skill_preview->c_date->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_skill_preview->c_date->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_skill_preview->c_date->Name) ?>" data-sort-order="<?php echo $peg_skill_preview->SortField == $peg_skill_preview->c_date->Name && $peg_skill_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_preview->c_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_preview->SortField == $peg_skill_preview->c_date->Name) { ?><?php if ($peg_skill_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_preview->u_date->Visible) { // u_date ?>
	<?php if ($peg_skill->SortUrl($peg_skill_preview->u_date) == "") { ?>
		<th class="<?php echo $peg_skill_preview->u_date->headerCellClass() ?>"><?php echo $peg_skill_preview->u_date->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_skill_preview->u_date->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_skill_preview->u_date->Name) ?>" data-sort-order="<?php echo $peg_skill_preview->SortField == $peg_skill_preview->u_date->Name && $peg_skill_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_preview->u_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_preview->SortField == $peg_skill_preview->u_date->Name) { ?><?php if ($peg_skill_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_preview->c_by->Visible) { // c_by ?>
	<?php if ($peg_skill->SortUrl($peg_skill_preview->c_by) == "") { ?>
		<th class="<?php echo $peg_skill_preview->c_by->headerCellClass() ?>"><?php echo $peg_skill_preview->c_by->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_skill_preview->c_by->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_skill_preview->c_by->Name) ?>" data-sort-order="<?php echo $peg_skill_preview->SortField == $peg_skill_preview->c_by->Name && $peg_skill_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_preview->c_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_preview->SortField == $peg_skill_preview->c_by->Name) { ?><?php if ($peg_skill_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_preview->u_by->Visible) { // u_by ?>
	<?php if ($peg_skill->SortUrl($peg_skill_preview->u_by) == "") { ?>
		<th class="<?php echo $peg_skill_preview->u_by->headerCellClass() ?>"><?php echo $peg_skill_preview->u_by->caption() ?></th>
	<?php } else { ?>
		<th class="<?php echo $peg_skill_preview->u_by->headerCellClass() ?>"><div class="ew-pointer" data-sort="<?php echo HtmlEncode($peg_skill_preview->u_by->Name) ?>" data-sort-order="<?php echo $peg_skill_preview->SortField == $peg_skill_preview->u_by->Name && $peg_skill_preview->SortOrder == "ASC" ? "DESC" : "ASC" ?>">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_preview->u_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_preview->SortField == $peg_skill_preview->u_by->Name) { ?><?php if ($peg_skill_preview->SortOrder == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_preview->SortOrder == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?><?php } ?></span>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$peg_skill_preview->ListOptions->render("header", "right");
?>
		</tr>
	</thead>
	<tbody><!-- Table body -->
<?php
$peg_skill_preview->RecCount = 0;
$peg_skill_preview->RowCount = 0;
while ($peg_skill_preview->Recordset && !$peg_skill_preview->Recordset->EOF) {

	// Init row class and style
	$peg_skill_preview->RecCount++;
	$peg_skill_preview->RowCount++;
	$peg_skill_preview->CssStyle = "";
	$peg_skill_preview->loadListRowValues($peg_skill_preview->Recordset);

	// Render row
	$peg_skill->RowType = ROWTYPE_PREVIEW; // Preview record
	$peg_skill_preview->resetAttributes();
	$peg_skill_preview->renderListRow();

	// Render list options
	$peg_skill_preview->renderListOptions();
?>
	<tr <?php echo $peg_skill->rowAttributes() ?>>
<?php

// Render list options (body, left)
$peg_skill_preview->ListOptions->render("body", "left", $peg_skill_preview->RowCount);
?>
<?php if ($peg_skill_preview->id->Visible) { // id ?>
		<!-- id -->
		<td<?php echo $peg_skill_preview->id->cellAttributes() ?>>
<span<?php echo $peg_skill_preview->id->viewAttributes() ?>><?php echo $peg_skill_preview->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_skill_preview->pid->Visible) { // pid ?>
		<!-- pid -->
		<td<?php echo $peg_skill_preview->pid->cellAttributes() ?>>
<span<?php echo $peg_skill_preview->pid->viewAttributes() ?>><?php echo $peg_skill_preview->pid->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_skill_preview->keahlian->Visible) { // keahlian ?>
		<!-- keahlian -->
		<td<?php echo $peg_skill_preview->keahlian->cellAttributes() ?>>
<span<?php echo $peg_skill_preview->keahlian->viewAttributes() ?>><?php echo $peg_skill_preview->keahlian->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_skill_preview->tingkat->Visible) { // tingkat ?>
		<!-- tingkat -->
		<td<?php echo $peg_skill_preview->tingkat->cellAttributes() ?>>
<span<?php echo $peg_skill_preview->tingkat->viewAttributes() ?>><?php echo $peg_skill_preview->tingkat->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_skill_preview->bukti->Visible) { // bukti ?>
		<!-- bukti -->
		<td<?php echo $peg_skill_preview->bukti->cellAttributes() ?>>
<span<?php echo $peg_skill_preview->bukti->viewAttributes() ?>><?php echo $peg_skill_preview->bukti->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_skill_preview->keterangan->Visible) { // keterangan ?>
		<!-- keterangan -->
		<td<?php echo $peg_skill_preview->keterangan->cellAttributes() ?>>
<span<?php echo $peg_skill_preview->keterangan->viewAttributes() ?>><?php echo $peg_skill_preview->keterangan->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_skill_preview->c_date->Visible) { // c_date ?>
		<!-- c_date -->
		<td<?php echo $peg_skill_preview->c_date->cellAttributes() ?>>
<span<?php echo $peg_skill_preview->c_date->viewAttributes() ?>><?php echo $peg_skill_preview->c_date->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_skill_preview->u_date->Visible) { // u_date ?>
		<!-- u_date -->
		<td<?php echo $peg_skill_preview->u_date->cellAttributes() ?>>
<span<?php echo $peg_skill_preview->u_date->viewAttributes() ?>><?php echo $peg_skill_preview->u_date->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_skill_preview->c_by->Visible) { // c_by ?>
		<!-- c_by -->
		<td<?php echo $peg_skill_preview->c_by->cellAttributes() ?>>
<span<?php echo $peg_skill_preview->c_by->viewAttributes() ?>><?php echo $peg_skill_preview->c_by->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($peg_skill_preview->u_by->Visible) { // u_by ?>
		<!-- u_by -->
		<td<?php echo $peg_skill_preview->u_by->cellAttributes() ?>>
<span<?php echo $peg_skill_preview->u_by->viewAttributes() ?>><?php echo $peg_skill_preview->u_by->getViewValue() ?></span>
</td>
<?php } ?>
<?php

// Render list options (body, right)
$peg_skill_preview->ListOptions->render("body", "right", $peg_skill_preview->RowCount);
?>
	</tr>
<?php
	$peg_skill_preview->Recordset->MoveNext();
} // while
?>
	</tbody>
</table><!-- /.table -->
</div><!-- /.table-responsive -->
<div class="card-footer ew-grid-lower-panel ew-preview-lower-panel"><!-- .card-footer -->
<?php echo $peg_skill_preview->Pager->render() ?>
<?php } else { // No record ?>
<div class="card no-border">
<div class="ew-detail-count"><?php echo $Language->phrase("NoRecord") ?></div>
<?php } ?>
<div class="ew-preview-other-options">
<?php
	foreach ($peg_skill_preview->OtherOptions as $option)
		$option->render("body");
?>
</div>
<?php if ($peg_skill_preview->TotalRecords > 0) { ?>
<div class="clearfix"></div>
</div><!-- /.card-footer -->
<?php } ?>
</div><!-- /.card -->
<?php
$peg_skill_preview->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php
if ($peg_skill_preview->Recordset)
	$peg_skill_preview->Recordset->Close();

// Output
$content = ob_get_contents();
ob_end_clean();
echo ConvertToUtf8($content);
?>
<?php
$peg_skill_preview->terminate();
?>