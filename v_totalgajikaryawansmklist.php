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
$v_totalgajikaryawansmk_list = new v_totalgajikaryawansmk_list();

// Run the page
$v_totalgajikaryawansmk_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v_totalgajikaryawansmk_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$v_totalgajikaryawansmk_list->isExport()) { ?>
<script>
var fv_totalgajikaryawansmklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fv_totalgajikaryawansmklist = currentForm = new ew.Form("fv_totalgajikaryawansmklist", "list");
	fv_totalgajikaryawansmklist.formKeyCountName = '<?php echo $v_totalgajikaryawansmk_list->FormKeyCountName ?>';
	loadjs.done("fv_totalgajikaryawansmklist");
});
var fv_totalgajikaryawansmklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fv_totalgajikaryawansmklistsrch = currentSearchForm = new ew.Form("fv_totalgajikaryawansmklistsrch");

	// Validate function for search
	fv_totalgajikaryawansmklistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_bulan");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($v_totalgajikaryawansmk_list->bulan->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_tahun");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($v_totalgajikaryawansmk_list->tahun->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fv_totalgajikaryawansmklistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fv_totalgajikaryawansmklistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	// Filters

	fv_totalgajikaryawansmklistsrch.filterList = <?php echo $v_totalgajikaryawansmk_list->getFilterList() ?>;
	loadjs.done("fv_totalgajikaryawansmklistsrch");
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
<?php if (!$v_totalgajikaryawansmk_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($v_totalgajikaryawansmk_list->TotalRecords > 0 && $v_totalgajikaryawansmk_list->ExportOptions->visible()) { ?>
<?php $v_totalgajikaryawansmk_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($v_totalgajikaryawansmk_list->ImportOptions->visible()) { ?>
<?php $v_totalgajikaryawansmk_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($v_totalgajikaryawansmk_list->SearchOptions->visible()) { ?>
<?php $v_totalgajikaryawansmk_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($v_totalgajikaryawansmk_list->FilterOptions->visible()) { ?>
<?php $v_totalgajikaryawansmk_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$v_totalgajikaryawansmk_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$v_totalgajikaryawansmk_list->isExport() && !$v_totalgajikaryawansmk->CurrentAction) { ?>
<form name="fv_totalgajikaryawansmklistsrch" id="fv_totalgajikaryawansmklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fv_totalgajikaryawansmklistsrch-search-panel" class="<?php echo $v_totalgajikaryawansmk_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v_totalgajikaryawansmk">
	<div class="ew-extended-search">
<?php

// Render search row
$v_totalgajikaryawansmk->RowType = ROWTYPE_SEARCH;
$v_totalgajikaryawansmk->resetAttributes();
$v_totalgajikaryawansmk_list->renderRow();
?>
<?php if ($v_totalgajikaryawansmk_list->bulan->Visible) { // bulan ?>
	<?php
		$v_totalgajikaryawansmk_list->SearchColumnCount++;
		if (($v_totalgajikaryawansmk_list->SearchColumnCount - 1) % $v_totalgajikaryawansmk_list->SearchFieldsPerRow == 0) {
			$v_totalgajikaryawansmk_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $v_totalgajikaryawansmk_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_bulan" class="ew-cell form-group">
		<label for="x_bulan" class="ew-search-caption ew-label"><?php echo $v_totalgajikaryawansmk_list->bulan->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_bulan" id="z_bulan" value="=">
</span>
		<span id="el_v_totalgajikaryawansmk_bulan" class="ew-search-field">
<input type="text" data-table="v_totalgajikaryawansmk" data-field="x_bulan" name="x_bulan" id="x_bulan" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($v_totalgajikaryawansmk_list->bulan->getPlaceHolder()) ?>" value="<?php echo $v_totalgajikaryawansmk_list->bulan->EditValue ?>"<?php echo $v_totalgajikaryawansmk_list->bulan->editAttributes() ?>>
</span>
	</div>
	<?php if ($v_totalgajikaryawansmk_list->SearchColumnCount % $v_totalgajikaryawansmk_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($v_totalgajikaryawansmk_list->tahun->Visible) { // tahun ?>
	<?php
		$v_totalgajikaryawansmk_list->SearchColumnCount++;
		if (($v_totalgajikaryawansmk_list->SearchColumnCount - 1) % $v_totalgajikaryawansmk_list->SearchFieldsPerRow == 0) {
			$v_totalgajikaryawansmk_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $v_totalgajikaryawansmk_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun" class="ew-cell form-group">
		<label for="x_tahun" class="ew-search-caption ew-label"><?php echo $v_totalgajikaryawansmk_list->tahun->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun" id="z_tahun" value="=">
</span>
		<span id="el_v_totalgajikaryawansmk_tahun" class="ew-search-field">
<input type="text" data-table="v_totalgajikaryawansmk" data-field="x_tahun" name="x_tahun" id="x_tahun" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($v_totalgajikaryawansmk_list->tahun->getPlaceHolder()) ?>" value="<?php echo $v_totalgajikaryawansmk_list->tahun->EditValue ?>"<?php echo $v_totalgajikaryawansmk_list->tahun->editAttributes() ?>>
</span>
	</div>
	<?php if ($v_totalgajikaryawansmk_list->SearchColumnCount % $v_totalgajikaryawansmk_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($v_totalgajikaryawansmk_list->SearchColumnCount % $v_totalgajikaryawansmk_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $v_totalgajikaryawansmk_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($v_totalgajikaryawansmk_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($v_totalgajikaryawansmk_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $v_totalgajikaryawansmk_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($v_totalgajikaryawansmk_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($v_totalgajikaryawansmk_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($v_totalgajikaryawansmk_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($v_totalgajikaryawansmk_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $v_totalgajikaryawansmk_list->showPageHeader(); ?>
<?php
$v_totalgajikaryawansmk_list->showMessage();
?>
<?php if ($v_totalgajikaryawansmk_list->TotalRecords > 0 || $v_totalgajikaryawansmk->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($v_totalgajikaryawansmk_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> v_totalgajikaryawansmk">
<?php if (!$v_totalgajikaryawansmk_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$v_totalgajikaryawansmk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_totalgajikaryawansmk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_totalgajikaryawansmk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fv_totalgajikaryawansmklist" id="fv_totalgajikaryawansmklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v_totalgajikaryawansmk">
<div id="gmp_v_totalgajikaryawansmk" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($v_totalgajikaryawansmk_list->TotalRecords > 0 || $v_totalgajikaryawansmk_list->isGridEdit()) { ?>
<table id="tbl_v_totalgajikaryawansmklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$v_totalgajikaryawansmk->RowType = ROWTYPE_HEADER;

// Render list options
$v_totalgajikaryawansmk_list->renderListOptions();

// Render list options (header, left)
$v_totalgajikaryawansmk_list->ListOptions->render("header", "left");
?>
<?php if ($v_totalgajikaryawansmk_list->bulan->Visible) { // bulan ?>
	<?php if ($v_totalgajikaryawansmk_list->SortUrl($v_totalgajikaryawansmk_list->bulan) == "") { ?>
		<th data-name="bulan" class="<?php echo $v_totalgajikaryawansmk_list->bulan->headerCellClass() ?>"><div id="elh_v_totalgajikaryawansmk_bulan" class="v_totalgajikaryawansmk_bulan"><div class="ew-table-header-caption"><?php echo $v_totalgajikaryawansmk_list->bulan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bulan" class="<?php echo $v_totalgajikaryawansmk_list->bulan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_totalgajikaryawansmk_list->SortUrl($v_totalgajikaryawansmk_list->bulan) ?>', 1);"><div id="elh_v_totalgajikaryawansmk_bulan" class="v_totalgajikaryawansmk_bulan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_totalgajikaryawansmk_list->bulan->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_totalgajikaryawansmk_list->bulan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_totalgajikaryawansmk_list->bulan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_totalgajikaryawansmk_list->tahun->Visible) { // tahun ?>
	<?php if ($v_totalgajikaryawansmk_list->SortUrl($v_totalgajikaryawansmk_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $v_totalgajikaryawansmk_list->tahun->headerCellClass() ?>"><div id="elh_v_totalgajikaryawansmk_tahun" class="v_totalgajikaryawansmk_tahun"><div class="ew-table-header-caption"><?php echo $v_totalgajikaryawansmk_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $v_totalgajikaryawansmk_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_totalgajikaryawansmk_list->SortUrl($v_totalgajikaryawansmk_list->tahun) ?>', 1);"><div id="elh_v_totalgajikaryawansmk_tahun" class="v_totalgajikaryawansmk_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_totalgajikaryawansmk_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_totalgajikaryawansmk_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_totalgajikaryawansmk_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_totalgajikaryawansmk_list->pegawai->Visible) { // pegawai ?>
	<?php if ($v_totalgajikaryawansmk_list->SortUrl($v_totalgajikaryawansmk_list->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $v_totalgajikaryawansmk_list->pegawai->headerCellClass() ?>"><div id="elh_v_totalgajikaryawansmk_pegawai" class="v_totalgajikaryawansmk_pegawai"><div class="ew-table-header-caption"><?php echo $v_totalgajikaryawansmk_list->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $v_totalgajikaryawansmk_list->pegawai->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_totalgajikaryawansmk_list->SortUrl($v_totalgajikaryawansmk_list->pegawai) ?>', 1);"><div id="elh_v_totalgajikaryawansmk_pegawai" class="v_totalgajikaryawansmk_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_totalgajikaryawansmk_list->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_totalgajikaryawansmk_list->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_totalgajikaryawansmk_list->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($v_totalgajikaryawansmk_list->total->Visible) { // total ?>
	<?php if ($v_totalgajikaryawansmk_list->SortUrl($v_totalgajikaryawansmk_list->total) == "") { ?>
		<th data-name="total" class="<?php echo $v_totalgajikaryawansmk_list->total->headerCellClass() ?>"><div id="elh_v_totalgajikaryawansmk_total" class="v_totalgajikaryawansmk_total"><div class="ew-table-header-caption"><?php echo $v_totalgajikaryawansmk_list->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $v_totalgajikaryawansmk_list->total->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $v_totalgajikaryawansmk_list->SortUrl($v_totalgajikaryawansmk_list->total) ?>', 1);"><div id="elh_v_totalgajikaryawansmk_total" class="v_totalgajikaryawansmk_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $v_totalgajikaryawansmk_list->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($v_totalgajikaryawansmk_list->total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($v_totalgajikaryawansmk_list->total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$v_totalgajikaryawansmk_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v_totalgajikaryawansmk_list->ExportAll && $v_totalgajikaryawansmk_list->isExport()) {
	$v_totalgajikaryawansmk_list->StopRecord = $v_totalgajikaryawansmk_list->TotalRecords;
} else {

	// Set the last record to display
	if ($v_totalgajikaryawansmk_list->TotalRecords > $v_totalgajikaryawansmk_list->StartRecord + $v_totalgajikaryawansmk_list->DisplayRecords - 1)
		$v_totalgajikaryawansmk_list->StopRecord = $v_totalgajikaryawansmk_list->StartRecord + $v_totalgajikaryawansmk_list->DisplayRecords - 1;
	else
		$v_totalgajikaryawansmk_list->StopRecord = $v_totalgajikaryawansmk_list->TotalRecords;
}
$v_totalgajikaryawansmk_list->RecordCount = $v_totalgajikaryawansmk_list->StartRecord - 1;
if ($v_totalgajikaryawansmk_list->Recordset && !$v_totalgajikaryawansmk_list->Recordset->EOF) {
	$v_totalgajikaryawansmk_list->Recordset->moveFirst();
	$selectLimit = $v_totalgajikaryawansmk_list->UseSelectLimit;
	if (!$selectLimit && $v_totalgajikaryawansmk_list->StartRecord > 1)
		$v_totalgajikaryawansmk_list->Recordset->move($v_totalgajikaryawansmk_list->StartRecord - 1);
} elseif (!$v_totalgajikaryawansmk->AllowAddDeleteRow && $v_totalgajikaryawansmk_list->StopRecord == 0) {
	$v_totalgajikaryawansmk_list->StopRecord = $v_totalgajikaryawansmk->GridAddRowCount;
}

// Initialize aggregate
$v_totalgajikaryawansmk->RowType = ROWTYPE_AGGREGATEINIT;
$v_totalgajikaryawansmk->resetAttributes();
$v_totalgajikaryawansmk_list->renderRow();
while ($v_totalgajikaryawansmk_list->RecordCount < $v_totalgajikaryawansmk_list->StopRecord) {
	$v_totalgajikaryawansmk_list->RecordCount++;
	if ($v_totalgajikaryawansmk_list->RecordCount >= $v_totalgajikaryawansmk_list->StartRecord) {
		$v_totalgajikaryawansmk_list->RowCount++;

		// Set up key count
		$v_totalgajikaryawansmk_list->KeyCount = $v_totalgajikaryawansmk_list->RowIndex;

		// Init row class and style
		$v_totalgajikaryawansmk->resetAttributes();
		$v_totalgajikaryawansmk->CssClass = "";
		if ($v_totalgajikaryawansmk_list->isGridAdd()) {
		} else {
			$v_totalgajikaryawansmk_list->loadRowValues($v_totalgajikaryawansmk_list->Recordset); // Load row values
		}
		$v_totalgajikaryawansmk->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v_totalgajikaryawansmk->RowAttrs->merge(["data-rowindex" => $v_totalgajikaryawansmk_list->RowCount, "id" => "r" . $v_totalgajikaryawansmk_list->RowCount . "_v_totalgajikaryawansmk", "data-rowtype" => $v_totalgajikaryawansmk->RowType]);

		// Render row
		$v_totalgajikaryawansmk_list->renderRow();

		// Render list options
		$v_totalgajikaryawansmk_list->renderListOptions();
?>
	<tr <?php echo $v_totalgajikaryawansmk->rowAttributes() ?>>
<?php

// Render list options (body, left)
$v_totalgajikaryawansmk_list->ListOptions->render("body", "left", $v_totalgajikaryawansmk_list->RowCount);
?>
	<?php if ($v_totalgajikaryawansmk_list->bulan->Visible) { // bulan ?>
		<td data-name="bulan" <?php echo $v_totalgajikaryawansmk_list->bulan->cellAttributes() ?>>
<span id="el<?php echo $v_totalgajikaryawansmk_list->RowCount ?>_v_totalgajikaryawansmk_bulan">
<span<?php echo $v_totalgajikaryawansmk_list->bulan->viewAttributes() ?>><?php echo $v_totalgajikaryawansmk_list->bulan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_totalgajikaryawansmk_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $v_totalgajikaryawansmk_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $v_totalgajikaryawansmk_list->RowCount ?>_v_totalgajikaryawansmk_tahun">
<span<?php echo $v_totalgajikaryawansmk_list->tahun->viewAttributes() ?>><?php echo $v_totalgajikaryawansmk_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_totalgajikaryawansmk_list->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $v_totalgajikaryawansmk_list->pegawai->cellAttributes() ?>>
<span id="el<?php echo $v_totalgajikaryawansmk_list->RowCount ?>_v_totalgajikaryawansmk_pegawai">
<span<?php echo $v_totalgajikaryawansmk_list->pegawai->viewAttributes() ?>><?php echo $v_totalgajikaryawansmk_list->pegawai->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v_totalgajikaryawansmk_list->total->Visible) { // total ?>
		<td data-name="total" <?php echo $v_totalgajikaryawansmk_list->total->cellAttributes() ?>>
<span id="el<?php echo $v_totalgajikaryawansmk_list->RowCount ?>_v_totalgajikaryawansmk_total">
<span<?php echo $v_totalgajikaryawansmk_list->total->viewAttributes() ?>><?php echo $v_totalgajikaryawansmk_list->total->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v_totalgajikaryawansmk_list->ListOptions->render("body", "right", $v_totalgajikaryawansmk_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$v_totalgajikaryawansmk_list->isGridAdd())
		$v_totalgajikaryawansmk_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$v_totalgajikaryawansmk->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($v_totalgajikaryawansmk_list->Recordset)
	$v_totalgajikaryawansmk_list->Recordset->Close();
?>
<?php if (!$v_totalgajikaryawansmk_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$v_totalgajikaryawansmk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $v_totalgajikaryawansmk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $v_totalgajikaryawansmk_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($v_totalgajikaryawansmk_list->TotalRecords == 0 && !$v_totalgajikaryawansmk->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $v_totalgajikaryawansmk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$v_totalgajikaryawansmk_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$v_totalgajikaryawansmk_list->isExport()) { ?>
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
$v_totalgajikaryawansmk_list->terminate();
?>