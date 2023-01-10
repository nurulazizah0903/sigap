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
$m_smk_list = new m_smk_list();

// Run the page
$m_smk_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$m_smk_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$m_smk_list->isExport()) { ?>
<script>
var fm_smklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fm_smklist = currentForm = new ew.Form("fm_smklist", "list");
	fm_smklist.formKeyCountName = '<?php echo $m_smk_list->FormKeyCountName ?>';
	loadjs.done("fm_smklist");
});
var fm_smklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fm_smklistsrch = currentSearchForm = new ew.Form("fm_smklistsrch");

	// Validate function for search
	fm_smklistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";
		elm = this.getElements("x" + infix + "_tahun");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_smk_list->tahun->errorMessage()) ?>");
		elm = this.getElements("x" + infix + "_bulan");
		if (elm && !ew.checkInteger(elm.value))
			return this.onError(elm, "<?php echo JsEncode($m_smk_list->bulan->errorMessage()) ?>");

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fm_smklistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fm_smklistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fm_smklistsrch.lists["x_bulan"] = <?php echo $m_smk_list->bulan->Lookup->toClientList($m_smk_list) ?>;
	fm_smklistsrch.lists["x_bulan"].options = <?php echo JsonEncode($m_smk_list->bulan->lookupOptions()) ?>;
	fm_smklistsrch.autoSuggests["x_bulan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	fm_smklistsrch.filterList = <?php echo $m_smk_list->getFilterList() ?>;
	loadjs.done("fm_smklistsrch");
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
<?php if (!$m_smk_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($m_smk_list->TotalRecords > 0 && $m_smk_list->ExportOptions->visible()) { ?>
<?php $m_smk_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($m_smk_list->ImportOptions->visible()) { ?>
<?php $m_smk_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($m_smk_list->SearchOptions->visible()) { ?>
<?php $m_smk_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($m_smk_list->FilterOptions->visible()) { ?>
<?php $m_smk_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$m_smk_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$m_smk_list->isExport() && !$m_smk->CurrentAction) { ?>
<form name="fm_smklistsrch" id="fm_smklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fm_smklistsrch-search-panel" class="<?php echo $m_smk_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="m_smk">
	<div class="ew-extended-search">
<?php

// Render search row
$m_smk->RowType = ROWTYPE_SEARCH;
$m_smk->resetAttributes();
$m_smk_list->renderRow();
?>
<?php if ($m_smk_list->tahun->Visible) { // tahun ?>
	<?php
		$m_smk_list->SearchColumnCount++;
		if (($m_smk_list->SearchColumnCount - 1) % $m_smk_list->SearchFieldsPerRow == 0) {
			$m_smk_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $m_smk_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_tahun" class="ew-cell form-group">
		<label for="x_tahun" class="ew-search-caption ew-label"><?php echo $m_smk_list->tahun->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_tahun" id="z_tahun" value="=">
</span>
		<span id="el_m_smk_tahun" class="ew-search-field">
<input type="text" data-table="m_smk" data-field="x_tahun" name="x_tahun" id="x_tahun" size="30" maxlength="5" placeholder="<?php echo HtmlEncode($m_smk_list->tahun->getPlaceHolder()) ?>" value="<?php echo $m_smk_list->tahun->EditValue ?>"<?php echo $m_smk_list->tahun->editAttributes() ?>>
</span>
	</div>
	<?php if ($m_smk_list->SearchColumnCount % $m_smk_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
<?php if ($m_smk_list->bulan->Visible) { // bulan ?>
	<?php
		$m_smk_list->SearchColumnCount++;
		if (($m_smk_list->SearchColumnCount - 1) % $m_smk_list->SearchFieldsPerRow == 0) {
			$m_smk_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $m_smk_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_bulan" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $m_smk_list->bulan->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("=") ?>
<input type="hidden" name="z_bulan" id="z_bulan" value="=">
</span>
		<span id="el_m_smk_bulan" class="ew-search-field">
<?php
$onchange = $m_smk_list->bulan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$m_smk_list->bulan->EditAttrs["onchange"] = "";
?>
<span id="as_x_bulan">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_bulan" id="sv_x_bulan" value="<?php echo RemoveHtml($m_smk_list->bulan->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($m_smk_list->bulan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($m_smk_list->bulan->getPlaceHolder()) ?>"<?php echo $m_smk_list->bulan->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($m_smk_list->bulan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_bulan',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($m_smk_list->bulan->ReadOnly || $m_smk_list->bulan->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="m_smk" data-field="x_bulan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $m_smk_list->bulan->displayValueSeparatorAttribute() ?>" name="x_bulan" id="x_bulan" value="<?php echo HtmlEncode($m_smk_list->bulan->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fm_smklistsrch"], function() {
	fm_smklistsrch.createAutoSuggest({"id":"x_bulan","forceSelect":false});
});
</script>
<?php echo $m_smk_list->bulan->Lookup->getParamTag($m_smk_list, "p_x_bulan") ?>
</span>
	</div>
	<?php if ($m_smk_list->SearchColumnCount % $m_smk_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($m_smk_list->SearchColumnCount % $m_smk_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $m_smk_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $m_smk_list->showPageHeader(); ?>
<?php
$m_smk_list->showMessage();
?>
<?php if ($m_smk_list->TotalRecords > 0 || $m_smk->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($m_smk_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> m_smk">
<?php if (!$m_smk_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$m_smk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_smk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_smk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fm_smklist" id="fm_smklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="m_smk">
<div id="gmp_m_smk" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($m_smk_list->TotalRecords > 0 || $m_smk_list->isGridEdit()) { ?>
<table id="tbl_m_smklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$m_smk->RowType = ROWTYPE_HEADER;

// Render list options
$m_smk_list->renderListOptions();

// Render list options (header, left)
$m_smk_list->ListOptions->render("header", "left");
?>
<?php if ($m_smk_list->createby->Visible) { // createby ?>
	<?php if ($m_smk_list->SortUrl($m_smk_list->createby) == "") { ?>
		<th data-name="createby" class="<?php echo $m_smk_list->createby->headerCellClass() ?>"><div id="elh_m_smk_createby" class="m_smk_createby"><div class="ew-table-header-caption"><?php echo $m_smk_list->createby->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="createby" class="<?php echo $m_smk_list->createby->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_smk_list->SortUrl($m_smk_list->createby) ?>', 1);"><div id="elh_m_smk_createby" class="m_smk_createby">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_smk_list->createby->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_smk_list->createby->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_smk_list->createby->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_smk_list->tahun->Visible) { // tahun ?>
	<?php if ($m_smk_list->SortUrl($m_smk_list->tahun) == "") { ?>
		<th data-name="tahun" class="<?php echo $m_smk_list->tahun->headerCellClass() ?>"><div id="elh_m_smk_tahun" class="m_smk_tahun"><div class="ew-table-header-caption"><?php echo $m_smk_list->tahun->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahun" class="<?php echo $m_smk_list->tahun->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_smk_list->SortUrl($m_smk_list->tahun) ?>', 1);"><div id="elh_m_smk_tahun" class="m_smk_tahun">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_smk_list->tahun->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_smk_list->tahun->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_smk_list->tahun->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($m_smk_list->bulan->Visible) { // bulan ?>
	<?php if ($m_smk_list->SortUrl($m_smk_list->bulan) == "") { ?>
		<th data-name="bulan" class="<?php echo $m_smk_list->bulan->headerCellClass() ?>"><div id="elh_m_smk_bulan" class="m_smk_bulan"><div class="ew-table-header-caption"><?php echo $m_smk_list->bulan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bulan" class="<?php echo $m_smk_list->bulan->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $m_smk_list->SortUrl($m_smk_list->bulan) ?>', 1);"><div id="elh_m_smk_bulan" class="m_smk_bulan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $m_smk_list->bulan->caption() ?></span><span class="ew-table-header-sort"><?php if ($m_smk_list->bulan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($m_smk_list->bulan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$m_smk_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($m_smk_list->ExportAll && $m_smk_list->isExport()) {
	$m_smk_list->StopRecord = $m_smk_list->TotalRecords;
} else {

	// Set the last record to display
	if ($m_smk_list->TotalRecords > $m_smk_list->StartRecord + $m_smk_list->DisplayRecords - 1)
		$m_smk_list->StopRecord = $m_smk_list->StartRecord + $m_smk_list->DisplayRecords - 1;
	else
		$m_smk_list->StopRecord = $m_smk_list->TotalRecords;
}
$m_smk_list->RecordCount = $m_smk_list->StartRecord - 1;
if ($m_smk_list->Recordset && !$m_smk_list->Recordset->EOF) {
	$m_smk_list->Recordset->moveFirst();
	$selectLimit = $m_smk_list->UseSelectLimit;
	if (!$selectLimit && $m_smk_list->StartRecord > 1)
		$m_smk_list->Recordset->move($m_smk_list->StartRecord - 1);
} elseif (!$m_smk->AllowAddDeleteRow && $m_smk_list->StopRecord == 0) {
	$m_smk_list->StopRecord = $m_smk->GridAddRowCount;
}

// Initialize aggregate
$m_smk->RowType = ROWTYPE_AGGREGATEINIT;
$m_smk->resetAttributes();
$m_smk_list->renderRow();
while ($m_smk_list->RecordCount < $m_smk_list->StopRecord) {
	$m_smk_list->RecordCount++;
	if ($m_smk_list->RecordCount >= $m_smk_list->StartRecord) {
		$m_smk_list->RowCount++;

		// Set up key count
		$m_smk_list->KeyCount = $m_smk_list->RowIndex;

		// Init row class and style
		$m_smk->resetAttributes();
		$m_smk->CssClass = "";
		if ($m_smk_list->isGridAdd()) {
		} else {
			$m_smk_list->loadRowValues($m_smk_list->Recordset); // Load row values
		}
		$m_smk->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$m_smk->RowAttrs->merge(["data-rowindex" => $m_smk_list->RowCount, "id" => "r" . $m_smk_list->RowCount . "_m_smk", "data-rowtype" => $m_smk->RowType]);

		// Render row
		$m_smk_list->renderRow();

		// Render list options
		$m_smk_list->renderListOptions();
?>
	<tr <?php echo $m_smk->rowAttributes() ?>>
<?php

// Render list options (body, left)
$m_smk_list->ListOptions->render("body", "left", $m_smk_list->RowCount);
?>
	<?php if ($m_smk_list->createby->Visible) { // createby ?>
		<td data-name="createby" <?php echo $m_smk_list->createby->cellAttributes() ?>>
<span id="el<?php echo $m_smk_list->RowCount ?>_m_smk_createby">
<span<?php echo $m_smk_list->createby->viewAttributes() ?>><?php echo $m_smk_list->createby->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_smk_list->tahun->Visible) { // tahun ?>
		<td data-name="tahun" <?php echo $m_smk_list->tahun->cellAttributes() ?>>
<span id="el<?php echo $m_smk_list->RowCount ?>_m_smk_tahun">
<span<?php echo $m_smk_list->tahun->viewAttributes() ?>><?php echo $m_smk_list->tahun->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($m_smk_list->bulan->Visible) { // bulan ?>
		<td data-name="bulan" <?php echo $m_smk_list->bulan->cellAttributes() ?>>
<span id="el<?php echo $m_smk_list->RowCount ?>_m_smk_bulan">
<span<?php echo $m_smk_list->bulan->viewAttributes() ?>><?php echo $m_smk_list->bulan->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$m_smk_list->ListOptions->render("body", "right", $m_smk_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$m_smk_list->isGridAdd())
		$m_smk_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$m_smk->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($m_smk_list->Recordset)
	$m_smk_list->Recordset->Close();
?>
<?php if (!$m_smk_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$m_smk_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $m_smk_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $m_smk_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($m_smk_list->TotalRecords == 0 && !$m_smk->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $m_smk_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$m_smk_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$m_smk_list->isExport()) { ?>
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
$m_smk_list->terminate();
?>