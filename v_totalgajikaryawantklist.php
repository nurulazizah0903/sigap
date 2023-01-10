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
$v_totalgajikaryawantk_list = new v_totalgajikaryawantk_list();

// Run the page
$v_totalgajikaryawantk_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_totalgajikaryawantk_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$v_totalgajikaryawantk_list->isExport()) { ?>
<script>
var fv_totalgajikaryawantklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fv_totalgajikaryawantklist = currentForm = new ew.Form("fv_totalgajikaryawantklist", "list");
	fv_totalgajikaryawantklist.formKeyCountName = '<?php echo $v_totalgajikaryawantk_list->FormKeyCountName ?>';
	loadjs.done("fv_totalgajikaryawantklist");
});
var fv_totalgajikaryawantklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fv_totalgajikaryawantklistsrch = currentSearchForm = new ew.Form("fv_totalgajikaryawantklistsrch");

	// Validate function for search
	fv_totalgajikaryawantklistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tahun");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($v_totalgajikaryawantk_list->tahun->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fv_totalgajikaryawantklistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fv_totalgajikaryawantklistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fv_totalgajikaryawantklistsrch.lists["x_bulan"] = <?php echo $v_totalgajikaryawantk_list->bulan->Lookup->toClientList($v_totalgajikaryawantk_list) ?>;
	fv_totalgajikaryawantklistsrch.lists["x_bulan"].options = <?php echo JsonEncode($v_totalgajikaryawantk_list->bulan->lookupOptions()) ?>;

	// Filters
	fv_totalgajikaryawantklistsrch.filterList = <?php echo $v_totalgajikaryawantk_list->getFilterList() ?>;
	loadjs.done("fv_totalgajikaryawantklistsrch");
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
<?php if (!$v_totalgajikaryawantk_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_totalgajikaryawantk_list->TotalRecords > 0 && $v_totalgajikaryawantk_list->ExportOptions->visible()) { ?>
<?php $v_totalgajikaryawantk_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_totalgajikaryawantk_list->ImportOptions->visible()) { ?>
<?php $v_totalgajikaryawantk_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($v_totalgajikaryawantk_list->SearchOptions->visible()) { ?>
<?php $v_totalgajikaryawantk_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($v_totalgajikaryawantk_list->FilterOptions->visible()) { ?>
<?php $v_totalgajikaryawantk_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_totalgajikaryawantk_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$v_totalgajikaryawantk_list->isExport() && !$v_totalgajikaryawantk->CurrentAction) { ?>
<form name="fv_totalgajikaryawantklistsrch" id="fv_totalgajikaryawantklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fv_totalgajikaryawantklistsrch-search-panel" class="<?php echo $v_totalgajikaryawantk_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_totalgajikaryawantk">
	<div class="ew-extended-search">
<?php

// Render search row
$v_totalgajikaryawantk->RowType = ROWTYPE_SEARCH;
$v_totalgajikaryawantk->resetAttributes();
$v_totalgajikaryawantk_list->renderRow();
?>
<?php if ($v_totalgajikaryawantk_list->bulan->Visible) { // bulan ?>
	<?php
		$v_totalgajikaryawantk_list->SearchColumnCount++;
		if (($v_totalgajikaryawantk_list->SearchColumnCount - 1) % $v_totalgajikaryawantk_list->SearchFieldsPerRow == 0) {
			$v_totalgajikaryawantk_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $v_totalgajikaryawantk_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_bulan" class="ew-cell form-group">
		<label for="x_bulan" class="ew-search-caption ew-label"><?php echo $v_totalgajikaryawantk_list->bulan->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_bulan" id="z_bulan" value="=">
</span>
		<span id="el_v_totalgajikaryawantk_bulan" class="ew-search-field">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x_bulan"><?php echo EmptyValue(strval($v_totalgajikaryawantk_list->bulan->AdvancedSearch->ViewValue)) ? $Language->phrase("PleaseSelect") : $v_totalgajikaryawantk_list->bulan->AdvancedSearch->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($v_totalgajikaryawantk_list->bulan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($v_totalgajikaryawantk_list->bulan->ReadOnly || $v_totalgajikaryawantk_list->bulan->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x_bulan',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $v_totalgajikaryawantk_list->bulan->Lookup->getParamTag($v_totalgajikaryawantk_list, "p_x_bulan") ?>
<input type="hidden" data-table="v_totalgajikaryawantk" data-field="x_bulan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $v_totalgajikaryawantk_list->bulan->displayValueSeparatorAttribute() ?>" name="x_bulan" id="x_bulan" value="<?php echo $v_totalgajikaryawantk_list->bulan->AdvancedSearch->SearchValue ?>"<?php echo $v_totalgajikaryawantk_list->bulan->editAttributes() ?>>
</span>
	</div>
	<?php if ($v_totalgajikaryawantk_list->SearchColumnCount % $v_totalgajikaryawantk_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($v_totalgajikaryawantk_list->tahun->Visible) { // tahun ?>
	<?php
		$v_totalgajikaryawantk_list->SearchColumnCount++;
		if (($v_totalgajikaryawantk_list->SearchColumnCount - 1) % $v_totalgajikaryawantk_list->SearchFieldsPerRow == 0) {
			$v_totalgajikaryawantk_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $v_totalgajikaryawantk_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun" class="ew-cell form-group">
		<label for="x_tahun" class="ew-search-caption ew-label"><?php echo $v_totalgajikaryawantk_list->tahun->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun" id="z_tahun" value="=">
</span>
		<span id="el_v_totalgajikaryawantk_tahun" class="ew-search-field">
<input type="text" data-table="v_totalgajikaryawantk" data-field="x_tahun" name="x_tahun" id="x_tahun" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($v_totalgajikaryawantk_list->tahun->getPlaceHolder()) ?>" value="<?php echo $v_totalgajikaryawantk_list->tahun->EditValue ?>"<?php echo $v_totalgajikaryawantk_list->tahun->editAttributes() ?>>
</span>
	</div>
	<?php if ($v_totalgajikaryawantk_list->SearchColumnCount % $v_totalgajikaryawantk_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($v_totalgajikaryawantk_list->SearchColumnCount % $v_totalgajikaryawantk_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $v_totalgajikaryawantk_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($v_totalgajikaryawantk_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($v_totalgajikaryawantk_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $v_totalgajikaryawantk_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($v_totalgajikaryawantk_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($v_totalgajikaryawantk_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($v_totalgajikaryawantk_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($v_totalgajikaryawantk_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $v_totalgajikaryawantk_list->showPageHeader(); ?>
<?php
$v_totalgajikaryawantk_list->showMessage();
?>
<?php if ($v_totalgajikaryawantk_list->TotalRecords > 0 || $v_totalgajikaryawantk->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_totalgajikaryawantk_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_totalgajikaryawantk">
<?php if (!$v_totalgajikaryawantk_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$v_totalgajikaryawantk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_totalgajikaryawantk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_totalgajikaryawantk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fv_totalgajikaryawantklist" id="fv_totalgajikaryawantklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_totalgajikaryawantk">
<div id="gmp_v_totalgajikaryawantk" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($v_totalgajikaryawantk_list->TotalRecords > 0 || $v_totalgajikaryawantk_list->isGridEdit()) { ?>
<table id="tbl_v_totalgajikaryawantklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_totalgajikaryawantk->RowType = ROWTYPE_HEADER;

// Render list options
$v_totalgajikaryawantk_list->renderListOptions();

// Render list options (header, left)
$v_totalgajikaryawantk_list->ListOptions->render("header", "left");
?>
<?php if ($v_totalgajikaryawantk_list->bulan->Visible) { // bulan ?>
	<?php if ($v_totalgajikaryawantk_list->SortUrl($v_totalgajikaryawantk_list->bulan) == "") { ?>
		<th data-name="bulan" class="<?php echo $v_totalgajikaryawantk_list->bulan->headerCellClass() ?>"><div id="elh_v_totalgajikaryawantk_bulan" class="v_totalgajikaryawantk_bulan"><div class="ew-table-header-caption"><?php echo $v_totalgajikaryawantk_list->bulan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bulan" class="<?php echo $v_totalgajikaryawantk_list->bulan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_totalgajikaryawantk_list->SortUrl($v_totalgajikaryawantk_list->bulan) ?>', 1);"><div id="elh_v_totalgajikaryawantk_bulan" class="v_totalgajikaryawantk_bulan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_totalgajikaryawantk_list->bulan->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_totalgajikaryawantk_list->bulan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_totalgajikaryawantk_list->bulan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_totalgajikaryawantk_list->tahun->Visible) { // tahun ?>
	<?php if ($v_totalgajikaryawantk_list->SortUrl($v_totalgajikaryawantk_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $v_totalgajikaryawantk_list->tahun->headerCellClass() ?>"><div id="elh_v_totalgajikaryawantk_tahun" class="v_totalgajikaryawantk_tahun"><div class="ew-table-header-caption"><?php echo $v_totalgajikaryawantk_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $v_totalgajikaryawantk_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_totalgajikaryawantk_list->SortUrl($v_totalgajikaryawantk_list->tahun) ?>', 1);"><div id="elh_v_totalgajikaryawantk_tahun" class="v_totalgajikaryawantk_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_totalgajikaryawantk_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_totalgajikaryawantk_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_totalgajikaryawantk_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_totalgajikaryawantk_list->pegawai->Visible) { // pegawai ?>
	<?php if ($v_totalgajikaryawantk_list->SortUrl($v_totalgajikaryawantk_list->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $v_totalgajikaryawantk_list->pegawai->headerCellClass() ?>"><div id="elh_v_totalgajikaryawantk_pegawai" class="v_totalgajikaryawantk_pegawai"><div class="ew-table-header-caption"><?php echo $v_totalgajikaryawantk_list->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $v_totalgajikaryawantk_list->pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_totalgajikaryawantk_list->SortUrl($v_totalgajikaryawantk_list->pegawai) ?>', 1);"><div id="elh_v_totalgajikaryawantk_pegawai" class="v_totalgajikaryawantk_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_totalgajikaryawantk_list->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_totalgajikaryawantk_list->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_totalgajikaryawantk_list->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_totalgajikaryawantk_list->total->Visible) { // total ?>
	<?php if ($v_totalgajikaryawantk_list->SortUrl($v_totalgajikaryawantk_list->total) == "") { ?>
		<th data-name="total" class="<?php echo $v_totalgajikaryawantk_list->total->headerCellClass() ?>"><div id="elh_v_totalgajikaryawantk_total" class="v_totalgajikaryawantk_total"><div class="ew-table-header-caption"><?php echo $v_totalgajikaryawantk_list->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $v_totalgajikaryawantk_list->total->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_totalgajikaryawantk_list->SortUrl($v_totalgajikaryawantk_list->total) ?>', 1);"><div id="elh_v_totalgajikaryawantk_total" class="v_totalgajikaryawantk_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_totalgajikaryawantk_list->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_totalgajikaryawantk_list->total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_totalgajikaryawantk_list->total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_totalgajikaryawantk_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_totalgajikaryawantk_list->ExportAll && $v_totalgajikaryawantk_list->isExport()) {
	$v_totalgajikaryawantk_list->StopRecord = $v_totalgajikaryawantk_list->TotalRecords;
} else {

	// Set the last record to display
	if ($v_totalgajikaryawantk_list->TotalRecords > $v_totalgajikaryawantk_list->StartRecord + $v_totalgajikaryawantk_list->DisplayRecords - 1)
		$v_totalgajikaryawantk_list->StopRecord = $v_totalgajikaryawantk_list->StartRecord + $v_totalgajikaryawantk_list->DisplayRecords - 1;
	else
		$v_totalgajikaryawantk_list->StopRecord = $v_totalgajikaryawantk_list->TotalRecords;
}
$v_totalgajikaryawantk_list->RecordCount = $v_totalgajikaryawantk_list->StartRecord - 1;
if ($v_totalgajikaryawantk_list->Recordset && !$v_totalgajikaryawantk_list->Recordset->EOF) {
	$v_totalgajikaryawantk_list->Recordset->moveFirst();
	$selectLimit = $v_totalgajikaryawantk_list->UseSelectLimit;
	if (!$selectLimit && $v_totalgajikaryawantk_list->StartRecord > 1)
		$v_totalgajikaryawantk_list->Recordset->move($v_totalgajikaryawantk_list->StartRecord - 1);
} elseif (!$v_totalgajikaryawantk->AllowAddDeleteRow && $v_totalgajikaryawantk_list->StopRecord == 0) {
	$v_totalgajikaryawantk_list->StopRecord = $v_totalgajikaryawantk->GridAddRowCount;
}

// Initialize aggregate
$v_totalgajikaryawantk->RowType = ROWTYPE_AGGREGATEINIT;
$v_totalgajikaryawantk->resetAttributes();
$v_totalgajikaryawantk_list->renderRow();
while ($v_totalgajikaryawantk_list->RecordCount < $v_totalgajikaryawantk_list->StopRecord) {
	$v_totalgajikaryawantk_list->RecordCount++;
	if ($v_totalgajikaryawantk_list->RecordCount >= $v_totalgajikaryawantk_list->StartRecord) {
		$v_totalgajikaryawantk_list->RowCount++;

		// Set up key count
		$v_totalgajikaryawantk_list->KeyCount = $v_totalgajikaryawantk_list->RowIndex;

		// Init row class and style
		$v_totalgajikaryawantk->resetAttributes();
		$v_totalgajikaryawantk->CssClass = "";
		if ($v_totalgajikaryawantk_list->isGridAdd()) {
		} else {
			$v_totalgajikaryawantk_list->loadRowValues($v_totalgajikaryawantk_list->Recordset); // Load row values
		}
		$v_totalgajikaryawantk->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_totalgajikaryawantk->RowAttrs->merge(["data-rowindex" => $v_totalgajikaryawantk_list->RowCount, "id" => "r" . $v_totalgajikaryawantk_list->RowCount . "_v_totalgajikaryawantk", "data-rowtype" => $v_totalgajikaryawantk->RowType]);

		// Render row
		$v_totalgajikaryawantk_list->renderRow();

		// Render list options
		$v_totalgajikaryawantk_list->renderListOptions();
?>
	<tr <?php echo $v_totalgajikaryawantk->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_totalgajikaryawantk_list->ListOptions->render("body", "left", $v_totalgajikaryawantk_list->RowCount);
?>
	<?php if ($v_totalgajikaryawantk_list->bulan->Visible) { // bulan ?>
		<td data-name="bulan" <?php echo $v_totalgajikaryawantk_list->bulan->cellAttributes() ?>>
<span id="el<?php echo $v_totalgajikaryawantk_list->RowCount ?>_v_totalgajikaryawantk_bulan">
<span<?php echo $v_totalgajikaryawantk_list->bulan->viewAttributes() ?>><?php echo $v_totalgajikaryawantk_list->bulan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_totalgajikaryawantk_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $v_totalgajikaryawantk_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $v_totalgajikaryawantk_list->RowCount ?>_v_totalgajikaryawantk_tahun">
<span<?php echo $v_totalgajikaryawantk_list->tahun->viewAttributes() ?>><?php echo $v_totalgajikaryawantk_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_totalgajikaryawantk_list->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $v_totalgajikaryawantk_list->pegawai->cellAttributes() ?>>
<span id="el<?php echo $v_totalgajikaryawantk_list->RowCount ?>_v_totalgajikaryawantk_pegawai">
<span<?php echo $v_totalgajikaryawantk_list->pegawai->viewAttributes() ?>><?php echo $v_totalgajikaryawantk_list->pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_totalgajikaryawantk_list->total->Visible) { // total ?>
		<td data-name="total" <?php echo $v_totalgajikaryawantk_list->total->cellAttributes() ?>>
<span id="el<?php echo $v_totalgajikaryawantk_list->RowCount ?>_v_totalgajikaryawantk_total">
<span<?php echo $v_totalgajikaryawantk_list->total->viewAttributes() ?>><?php echo $v_totalgajikaryawantk_list->total->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_totalgajikaryawantk_list->ListOptions->render("body", "right", $v_totalgajikaryawantk_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$v_totalgajikaryawantk_list->isGridAdd())
		$v_totalgajikaryawantk_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$v_totalgajikaryawantk->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_totalgajikaryawantk_list->Recordset)
	$v_totalgajikaryawantk_list->Recordset->Close();
?>
<?php if (!$v_totalgajikaryawantk_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_totalgajikaryawantk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_totalgajikaryawantk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_totalgajikaryawantk_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_totalgajikaryawantk_list->TotalRecords == 0 && !$v_totalgajikaryawantk->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_totalgajikaryawantk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_totalgajikaryawantk_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$v_totalgajikaryawantk_list->isExport()) { ?>
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
$v_totalgajikaryawantk_list->terminate();
?>