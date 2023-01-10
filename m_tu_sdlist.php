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
$m_tu_sd_list = new m_tu_sd_list();

// Run the page
$m_tu_sd_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_tu_sd_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_tu_sd_list->isExport()) { ?>
<script>
var fm_tu_sdlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_tu_sdlist = currentForm = new ew.Form("fm_tu_sdlist", "list");
	fm_tu_sdlist.formKeyCountName = '<?php echo $m_tu_sd_list->FormKeyCountName ?>';
	loadjs.done("fm_tu_sdlist");
});
var fm_tu_sdlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_tu_sdlistsrch = currentSearchForm = new ew.Form("fm_tu_sdlistsrch");

	// Validate function for search
	fm_tu_sdlistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tahun");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_tu_sd_list->tahun->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fm_tu_sdlistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_tu_sdlistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_tu_sdlistsrch.lists["x_bulan"] = <?php echo $m_tu_sd_list->bulan->Lookup->toClientList($m_tu_sd_list) ?>;
	fm_tu_sdlistsrch.lists["x_bulan"].options = <?php echo JsonEncode($m_tu_sd_list->bulan->lookupOptions()) ?>;

	// Filters
	fm_tu_sdlistsrch.filterList = <?php echo $m_tu_sd_list->getFilterList() ?>;
	loadjs.done("fm_tu_sdlistsrch");
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
<?php if (!$m_tu_sd_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_tu_sd_list->TotalRecords > 0 && $m_tu_sd_list->ExportOptions->visible()) { ?>
<?php $m_tu_sd_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_tu_sd_list->ImportOptions->visible()) { ?>
<?php $m_tu_sd_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_tu_sd_list->SearchOptions->visible()) { ?>
<?php $m_tu_sd_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_tu_sd_list->FilterOptions->visible()) { ?>
<?php $m_tu_sd_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_tu_sd_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_tu_sd_list->isExport() && !$m_tu_sd->CurrentAction) { ?>
<form name="fm_tu_sdlistsrch" id="fm_tu_sdlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_tu_sdlistsrch-search-panel" class="<?php echo $m_tu_sd_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_tu_sd">
	<div class="ew-extended-search">
<?php

// Render search row
$m_tu_sd->RowType = ROWTYPE_SEARCH;
$m_tu_sd->resetAttributes();
$m_tu_sd_list->renderRow();
?>
<?php if ($m_tu_sd_list->tahun->Visible) { // tahun ?>
	<?php
		$m_tu_sd_list->SearchColumnCount++;
		if (($m_tu_sd_list->SearchColumnCount - 1) % $m_tu_sd_list->SearchFieldsPerRow == 0) {
			$m_tu_sd_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $m_tu_sd_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun" class="ew-cell form-group">
		<label for="x_tahun" class="ew-search-caption ew-label"><?php echo $m_tu_sd_list->tahun->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun" id="z_tahun" value="=">
</span>
		<span id="el_m_tu_sd_tahun" class="ew-search-field">
<input type="text" data-table="m_tu_sd" data-field="x_tahun" name="x_tahun" id="x_tahun" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($m_tu_sd_list->tahun->getPlaceHolder()) ?>" value="<?php echo $m_tu_sd_list->tahun->EditValue ?>"<?php echo $m_tu_sd_list->tahun->editAttributes() ?>>
</span>
	</div>
	<?php if ($m_tu_sd_list->SearchColumnCount % $m_tu_sd_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($m_tu_sd_list->bulan->Visible) { // bulan ?>
	<?php
		$m_tu_sd_list->SearchColumnCount++;
		if (($m_tu_sd_list->SearchColumnCount - 1) % $m_tu_sd_list->SearchFieldsPerRow == 0) {
			$m_tu_sd_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $m_tu_sd_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_bulan" class="ew-cell form-group">
		<label for="x_bulan" class="ew-search-caption ew-label"><?php echo $m_tu_sd_list->bulan->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_bulan" id="z_bulan" value="=">
</span>
		<span id="el_m_tu_sd_bulan" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_bulan"><?php echo EmptyValue(strval($m_tu_sd_list->bulan->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $m_tu_sd_list->bulan->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_tu_sd_list->bulan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($m_tu_sd_list->bulan->ReadOnly || $m_tu_sd_list->bulan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_bulan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $m_tu_sd_list->bulan->Lookup->getParamTag($m_tu_sd_list, "p_x_bulan") ?>
<input type="hidden" data-table="m_tu_sd" data-field="x_bulan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_tu_sd_list->bulan->displayValueSeparatorAttribute() ?>" name="x_bulan" id="x_bulan" value="<?php echo $m_tu_sd_list->bulan->AdvancedSearch->SearchValue ?>"<?php echo $m_tu_sd_list->bulan->editAttributes() ?>>
</span>
	</div>
	<?php if ($m_tu_sd_list->SearchColumnCount % $m_tu_sd_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($m_tu_sd_list->SearchColumnCount % $m_tu_sd_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $m_tu_sd_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_tu_sd_list->showPageHeader(); ?>
<?php
$m_tu_sd_list->showMessage();
?>
<?php if ($m_tu_sd_list->TotalRecords > 0 || $m_tu_sd->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_tu_sd_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_tu_sd">
<?php if (!$m_tu_sd_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_tu_sd_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_tu_sd_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_tu_sd_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_tu_sdlist" id="fm_tu_sdlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_tu_sd">
<div id="gmp_m_tu_sd" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_tu_sd_list->TotalRecords > 0 || $m_tu_sd_list->isGridEdit()) { ?>
<table id="tbl_m_tu_sdlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_tu_sd->RowType = ROWTYPE_HEADER;

// Render list options
$m_tu_sd_list->renderListOptions();

// Render list options (header, left)
$m_tu_sd_list->ListOptions->render("header", "left");
?>
<?php if ($m_tu_sd_list->createby->Visible) { // createby ?>
	<?php if ($m_tu_sd_list->SortUrl($m_tu_sd_list->createby) == "") { ?>
		<th data-name="createby" class="<?php echo $m_tu_sd_list->createby->headerCellClass() ?>"><div id="elh_m_tu_sd_createby" class="m_tu_sd_createby"><div class="ew-table-header-caption"><?php echo $m_tu_sd_list->createby->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createby" class="<?php echo $m_tu_sd_list->createby->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_tu_sd_list->SortUrl($m_tu_sd_list->createby) ?>', 1);"><div id="elh_m_tu_sd_createby" class="m_tu_sd_createby">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_tu_sd_list->createby->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_tu_sd_list->createby->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_tu_sd_list->createby->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_tu_sd_list->tahun->Visible) { // tahun ?>
	<?php if ($m_tu_sd_list->SortUrl($m_tu_sd_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $m_tu_sd_list->tahun->headerCellClass() ?>"><div id="elh_m_tu_sd_tahun" class="m_tu_sd_tahun"><div class="ew-table-header-caption"><?php echo $m_tu_sd_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $m_tu_sd_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_tu_sd_list->SortUrl($m_tu_sd_list->tahun) ?>', 1);"><div id="elh_m_tu_sd_tahun" class="m_tu_sd_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_tu_sd_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_tu_sd_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_tu_sd_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_tu_sd_list->bulan->Visible) { // bulan ?>
	<?php if ($m_tu_sd_list->SortUrl($m_tu_sd_list->bulan) == "") { ?>
		<th data-name="bulan" class="<?php echo $m_tu_sd_list->bulan->headerCellClass() ?>"><div id="elh_m_tu_sd_bulan" class="m_tu_sd_bulan"><div class="ew-table-header-caption"><?php echo $m_tu_sd_list->bulan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bulan" class="<?php echo $m_tu_sd_list->bulan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_tu_sd_list->SortUrl($m_tu_sd_list->bulan) ?>', 1);"><div id="elh_m_tu_sd_bulan" class="m_tu_sd_bulan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_tu_sd_list->bulan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_tu_sd_list->bulan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_tu_sd_list->bulan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_tu_sd_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_tu_sd_list->ExportAll && $m_tu_sd_list->isExport()) {
	$m_tu_sd_list->StopRecord = $m_tu_sd_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_tu_sd_list->TotalRecords > $m_tu_sd_list->StartRecord + $m_tu_sd_list->DisplayRecords - 1)
		$m_tu_sd_list->StopRecord = $m_tu_sd_list->StartRecord + $m_tu_sd_list->DisplayRecords - 1;
	else
		$m_tu_sd_list->StopRecord = $m_tu_sd_list->TotalRecords;
}
$m_tu_sd_list->RecordCount = $m_tu_sd_list->StartRecord - 1;
if ($m_tu_sd_list->Recordset && !$m_tu_sd_list->Recordset->EOF) {
	$m_tu_sd_list->Recordset->moveFirst();
	$selectLimit = $m_tu_sd_list->UseSelectLimit;
	if (!$selectLimit && $m_tu_sd_list->StartRecord > 1)
		$m_tu_sd_list->Recordset->move($m_tu_sd_list->StartRecord - 1);
} elseif (!$m_tu_sd->AllowAddDeleteRow && $m_tu_sd_list->StopRecord == 0) {
	$m_tu_sd_list->StopRecord = $m_tu_sd->GridAddRowCount;
}

// Initialize aggregate
$m_tu_sd->RowType = ROWTYPE_AGGREGATEINIT;
$m_tu_sd->resetAttributes();
$m_tu_sd_list->renderRow();
while ($m_tu_sd_list->RecordCount < $m_tu_sd_list->StopRecord) {
	$m_tu_sd_list->RecordCount++;
	if ($m_tu_sd_list->RecordCount >= $m_tu_sd_list->StartRecord) {
		$m_tu_sd_list->RowCount++;

		// Set up key count
		$m_tu_sd_list->KeyCount = $m_tu_sd_list->RowIndex;

		// Init row class and style
		$m_tu_sd->resetAttributes();
		$m_tu_sd->CssClass = "";
		if ($m_tu_sd_list->isGridAdd()) {
		} else {
			$m_tu_sd_list->loadRowValues($m_tu_sd_list->Recordset); // Load row values
		}
		$m_tu_sd->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_tu_sd->RowAttrs->merge(["data-rowindex" => $m_tu_sd_list->RowCount, "id" => "r" . $m_tu_sd_list->RowCount . "_m_tu_sd", "data-rowtype" => $m_tu_sd->RowType]);

		// Render row
		$m_tu_sd_list->renderRow();

		// Render list options
		$m_tu_sd_list->renderListOptions();
?>
	<tr <?php echo $m_tu_sd->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_tu_sd_list->ListOptions->render("body", "left", $m_tu_sd_list->RowCount);
?>
	<?php if ($m_tu_sd_list->createby->Visible) { // createby ?>
		<td data-name="createby" <?php echo $m_tu_sd_list->createby->cellAttributes() ?>>
<span id="el<?php echo $m_tu_sd_list->RowCount ?>_m_tu_sd_createby">
<span<?php echo $m_tu_sd_list->createby->viewAttributes() ?>><?php echo $m_tu_sd_list->createby->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_tu_sd_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $m_tu_sd_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $m_tu_sd_list->RowCount ?>_m_tu_sd_tahun">
<span<?php echo $m_tu_sd_list->tahun->viewAttributes() ?>><?php echo $m_tu_sd_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_tu_sd_list->bulan->Visible) { // bulan ?>
		<td data-name="bulan" <?php echo $m_tu_sd_list->bulan->cellAttributes() ?>>
<span id="el<?php echo $m_tu_sd_list->RowCount ?>_m_tu_sd_bulan">
<span<?php echo $m_tu_sd_list->bulan->viewAttributes() ?>><?php echo $m_tu_sd_list->bulan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_tu_sd_list->ListOptions->render("body", "right", $m_tu_sd_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_tu_sd_list->isGridAdd())
		$m_tu_sd_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_tu_sd->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_tu_sd_list->Recordset)
	$m_tu_sd_list->Recordset->Close();
?>
<?php if (!$m_tu_sd_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_tu_sd_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_tu_sd_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_tu_sd_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_tu_sd_list->TotalRecords == 0 && !$m_tu_sd->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_tu_sd_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_tu_sd_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_tu_sd_list->isExport()) { ?>
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
$m_tu_sd_list->terminate();
?>