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
$gajisd_detil_list = new gajisd_detil_list();

// Run the page
$gajisd_detil_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajisd_detil_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$gajisd_detil_list->isExport()) { ?>
<script>
var fgajisd_detillist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgajisd_detillist = currentForm = new ew.Form("fgajisd_detillist", "list");
	fgajisd_detillist.formKeyCountName = '<?php echo $gajisd_detil_list->FormKeyCountName ?>';
	loadjs.done("fgajisd_detillist");
});
var fgajisd_detillistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fgajisd_detillistsrch = currentSearchForm = new ew.Form("fgajisd_detillistsrch");

	// Validate function for search
	fgajisd_detillistsrch.validate = function(fobj) {
		if (!this.validateRequired)
			return true; // Ignore validation
		fobj = fobj || this._form;
		var infix = "";

		// Call Form_CustomValidate event
		if (!this.Form_CustomValidate(fobj))
			return false;
		return true;
	}

	// Form_CustomValidate
	fgajisd_detillistsrch.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgajisd_detillistsrch.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgajisd_detillistsrch.lists["x_pegawai_id"] = <?php echo $gajisd_detil_list->pegawai_id->Lookup->toClientList($gajisd_detil_list) ?>;
	fgajisd_detillistsrch.lists["x_pegawai_id"].options = <?php echo JsonEncode($gajisd_detil_list->pegawai_id->lookupOptions()) ?>;
	fgajisd_detillistsrch.autoSuggests["x_pegawai_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;

	// Filters
	fgajisd_detillistsrch.filterList = <?php echo $gajisd_detil_list->getFilterList() ?>;
	loadjs.done("fgajisd_detillistsrch");
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
<?php if (!$gajisd_detil_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($gajisd_detil_list->TotalRecords > 0 && $gajisd_detil_list->ExportOptions->visible()) { ?>
<?php $gajisd_detil_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($gajisd_detil_list->ImportOptions->visible()) { ?>
<?php $gajisd_detil_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($gajisd_detil_list->SearchOptions->visible()) { ?>
<?php $gajisd_detil_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($gajisd_detil_list->FilterOptions->visible()) { ?>
<?php $gajisd_detil_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$gajisd_detil_list->isExport() || Config("EXPORT_MASTER_RECORD") && $gajisd_detil_list->isExport("print")) { ?>
<?php
if ($gajisd_detil_list->DbMasterFilter != "" && $gajisd_detil->getCurrentMasterTable() == "gajisd") {
	if ($gajisd_detil_list->MasterRecordExists) {
		include_once "gajisdmaster.php";
	}
}
?>
<?php } ?>
<?php
$gajisd_detil_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$gajisd_detil_list->isExport() && !$gajisd_detil->CurrentAction) { ?>
<form name="fgajisd_detillistsrch" id="fgajisd_detillistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fgajisd_detillistsrch-search-panel" class="<?php echo $gajisd_detil_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="gajisd_detil">
	<div class="ew-extended-search">
<?php

// Render search row
$gajisd_detil->RowType = ROWTYPE_SEARCH;
$gajisd_detil->resetAttributes();
$gajisd_detil_list->renderRow();
?>
<?php if ($gajisd_detil_list->pegawai_id->Visible) { // pegawai_id ?>
	<?php
		$gajisd_detil_list->SearchColumnCount++;
		if (($gajisd_detil_list->SearchColumnCount - 1) % $gajisd_detil_list->SearchFieldsPerRow == 0) {
			$gajisd_detil_list->SearchRowCount++;
	?>
<div id="xsr_<?php echo $gajisd_detil_list->SearchRowCount ?>" class="ew-row d-sm-flex">
	<?php
		}
	 ?>
	<div id="xsc_pegawai_id" class="ew-cell form-group">
		<label class="ew-search-caption ew-label"><?php echo $gajisd_detil_list->pegawai_id->caption() ?></label>
		<span class="ew-search-operator">
<?php echo $Language->phrase("LIKE") ?>
<input type="hidden" name="z_pegawai_id" id="z_pegawai_id" value="LIKE">
</span>
		<span id="el_gajisd_detil_pegawai_id" class="ew-search-field">
<?php
$onchange = $gajisd_detil_list->pegawai_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gajisd_detil_list->pegawai_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_pegawai_id">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x_pegawai_id" id="sv_x_pegawai_id" value="<?php echo RemoveHtml($gajisd_detil_list->pegawai_id->EditValue) ?>" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($gajisd_detil_list->pegawai_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gajisd_detil_list->pegawai_id->getPlaceHolder()) ?>"<?php echo $gajisd_detil_list->pegawai_id->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajisd_detil_list->pegawai_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x_pegawai_id',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($gajisd_detil_list->pegawai_id->ReadOnly || $gajisd_detil_list->pegawai_id->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="gajisd_detil" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajisd_detil_list->pegawai_id->displayValueSeparatorAttribute() ?>" name="x_pegawai_id" id="x_pegawai_id" value="<?php echo HtmlEncode($gajisd_detil_list->pegawai_id->AdvancedSearch->SearchValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgajisd_detillistsrch"], function() {
	fgajisd_detillistsrch.createAutoSuggest({"id":"x_pegawai_id","forceSelect":false});
});
</script>
<?php echo $gajisd_detil_list->pegawai_id->Lookup->getParamTag($gajisd_detil_list, "p_x_pegawai_id") ?>
</span>
	</div>
	<?php if ($gajisd_detil_list->SearchColumnCount % $gajisd_detil_list->SearchFieldsPerRow == 0) { ?>
</div>
	<?php } ?>
<?php } ?>
	<?php if ($gajisd_detil_list->SearchColumnCount % $gajisd_detil_list->SearchFieldsPerRow > 0) { ?>
</div>
	<?php } ?>
<div id="xsr_<?php echo $gajisd_detil_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $gajisd_detil_list->showPageHeader(); ?>
<?php
$gajisd_detil_list->showMessage();
?>
<?php if ($gajisd_detil_list->TotalRecords > 0 || $gajisd_detil->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gajisd_detil_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajisd_detil">
<?php if (!$gajisd_detil_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$gajisd_detil_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajisd_detil_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajisd_detil_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgajisd_detillist" id="fgajisd_detillist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="gajisd_detil">
<?php if ($gajisd_detil->getCurrentMasterTable() == "gajisd" && $gajisd_detil->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="gajisd">
<input type="hidden" name="fk_id" value="<?php echo HtmlEncode($gajisd_detil_list->pid->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_gajisd_detil" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($gajisd_detil_list->TotalRecords > 0 || $gajisd_detil_list->isGridEdit()) { ?>
<table id="tbl_gajisd_detillist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gajisd_detil->RowType = ROWTYPE_HEADER;

// Render list options
$gajisd_detil_list->renderListOptions();

// Render list options (header, left)
$gajisd_detil_list->ListOptions->render("header", "left");
?>
<?php if ($gajisd_detil_list->pegawai_id->Visible) { // pegawai_id ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->pegawai_id) == "") { ?>
		<th data-name="pegawai_id" class="<?php echo $gajisd_detil_list->pegawai_id->headerCellClass() ?>"><div id="elh_gajisd_detil_pegawai_id" class="gajisd_detil_pegawai_id"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->pegawai_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai_id" class="<?php echo $gajisd_detil_list->pegawai_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->pegawai_id) ?>', 1);"><div id="elh_gajisd_detil_pegawai_id" class="gajisd_detil_pegawai_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->pegawai_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->pegawai_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->pegawai_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_detil_list->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->jabatan_id) == "") { ?>
		<th data-name="jabatan_id" class="<?php echo $gajisd_detil_list->jabatan_id->headerCellClass() ?>"><div id="elh_gajisd_detil_jabatan_id" class="gajisd_detil_jabatan_id"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->jabatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan_id" class="<?php echo $gajisd_detil_list->jabatan_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->jabatan_id) ?>', 1);"><div id="elh_gajisd_detil_jabatan_id" class="gajisd_detil_jabatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->jabatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->jabatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_detil_list->masakerja->Visible) { // masakerja ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->masakerja) == "") { ?>
		<th data-name="masakerja" class="<?php echo $gajisd_detil_list->masakerja->headerCellClass() ?>"><div id="elh_gajisd_detil_masakerja" class="gajisd_detil_masakerja"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->masakerja->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masakerja" class="<?php echo $gajisd_detil_list->masakerja->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->masakerja) ?>', 1);"><div id="elh_gajisd_detil_masakerja" class="gajisd_detil_masakerja">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->masakerja->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->masakerja->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->masakerja->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_detil_list->jumngajar->Visible) { // jumngajar ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->jumngajar) == "") { ?>
		<th data-name="jumngajar" class="<?php echo $gajisd_detil_list->jumngajar->headerCellClass() ?>"><div id="elh_gajisd_detil_jumngajar" class="gajisd_detil_jumngajar"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->jumngajar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumngajar" class="<?php echo $gajisd_detil_list->jumngajar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->jumngajar) ?>', 1);"><div id="elh_gajisd_detil_jumngajar" class="gajisd_detil_jumngajar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->jumngajar->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->jumngajar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->jumngajar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_detil_list->ijin->Visible) { // ijin ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->ijin) == "") { ?>
		<th data-name="ijin" class="<?php echo $gajisd_detil_list->ijin->headerCellClass() ?>"><div id="elh_gajisd_detil_ijin" class="gajisd_detil_ijin"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->ijin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ijin" class="<?php echo $gajisd_detil_list->ijin->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->ijin) ?>', 1);"><div id="elh_gajisd_detil_ijin" class="gajisd_detil_ijin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->ijin->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->ijin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->ijin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_detil_list->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->tunjangan_wkosis) == "") { ?>
		<th data-name="tunjangan_wkosis" class="<?php echo $gajisd_detil_list->tunjangan_wkosis->headerCellClass() ?>"><div id="elh_gajisd_detil_tunjangan_wkosis" class="gajisd_detil_tunjangan_wkosis"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->tunjangan_wkosis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tunjangan_wkosis" class="<?php echo $gajisd_detil_list->tunjangan_wkosis->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->tunjangan_wkosis) ?>', 1);"><div id="elh_gajisd_detil_tunjangan_wkosis" class="gajisd_detil_tunjangan_wkosis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->tunjangan_wkosis->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->tunjangan_wkosis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->tunjangan_wkosis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_detil_list->nominal_baku->Visible) { // nominal_baku ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->nominal_baku) == "") { ?>
		<th data-name="nominal_baku" class="<?php echo $gajisd_detil_list->nominal_baku->headerCellClass() ?>"><div id="elh_gajisd_detil_nominal_baku" class="gajisd_detil_nominal_baku"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->nominal_baku->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nominal_baku" class="<?php echo $gajisd_detil_list->nominal_baku->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->nominal_baku) ?>', 1);"><div id="elh_gajisd_detil_nominal_baku" class="gajisd_detil_nominal_baku">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->nominal_baku->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->nominal_baku->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->nominal_baku->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_detil_list->baku->Visible) { // baku ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->baku) == "") { ?>
		<th data-name="baku" class="<?php echo $gajisd_detil_list->baku->headerCellClass() ?>"><div id="elh_gajisd_detil_baku" class="gajisd_detil_baku"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->baku->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="baku" class="<?php echo $gajisd_detil_list->baku->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->baku) ?>', 1);"><div id="elh_gajisd_detil_baku" class="gajisd_detil_baku">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->baku->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->baku->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->baku->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_detil_list->kehadiran->Visible) { // kehadiran ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->kehadiran) == "") { ?>
		<th data-name="kehadiran" class="<?php echo $gajisd_detil_list->kehadiran->headerCellClass() ?>"><div id="elh_gajisd_detil_kehadiran" class="gajisd_detil_kehadiran"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->kehadiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kehadiran" class="<?php echo $gajisd_detil_list->kehadiran->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->kehadiran) ?>', 1);"><div id="elh_gajisd_detil_kehadiran" class="gajisd_detil_kehadiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->kehadiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->kehadiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_detil_list->prestasi->Visible) { // prestasi ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->prestasi) == "") { ?>
		<th data-name="prestasi" class="<?php echo $gajisd_detil_list->prestasi->headerCellClass() ?>"><div id="elh_gajisd_detil_prestasi" class="gajisd_detil_prestasi"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->prestasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prestasi" class="<?php echo $gajisd_detil_list->prestasi->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->prestasi) ?>', 1);"><div id="elh_gajisd_detil_prestasi" class="gajisd_detil_prestasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->prestasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->prestasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->prestasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_detil_list->jumlahgaji->Visible) { // jumlahgaji ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->jumlahgaji) == "") { ?>
		<th data-name="jumlahgaji" class="<?php echo $gajisd_detil_list->jumlahgaji->headerCellClass() ?>"><div id="elh_gajisd_detil_jumlahgaji" class="gajisd_detil_jumlahgaji"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->jumlahgaji->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlahgaji" class="<?php echo $gajisd_detil_list->jumlahgaji->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->jumlahgaji) ?>', 1);"><div id="elh_gajisd_detil_jumlahgaji" class="gajisd_detil_jumlahgaji">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->jumlahgaji->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->jumlahgaji->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->jumlahgaji->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_detil_list->jumgajitotal->Visible) { // jumgajitotal ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->jumgajitotal) == "") { ?>
		<th data-name="jumgajitotal" class="<?php echo $gajisd_detil_list->jumgajitotal->headerCellClass() ?>"><div id="elh_gajisd_detil_jumgajitotal" class="gajisd_detil_jumgajitotal"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->jumgajitotal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumgajitotal" class="<?php echo $gajisd_detil_list->jumgajitotal->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->jumgajitotal) ?>', 1);"><div id="elh_gajisd_detil_jumgajitotal" class="gajisd_detil_jumgajitotal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->jumgajitotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->jumgajitotal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->jumgajitotal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_detil_list->potongan1->Visible) { // potongan1 ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->potongan1) == "") { ?>
		<th data-name="potongan1" class="<?php echo $gajisd_detil_list->potongan1->headerCellClass() ?>"><div id="elh_gajisd_detil_potongan1" class="gajisd_detil_potongan1"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->potongan1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan1" class="<?php echo $gajisd_detil_list->potongan1->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->potongan1) ?>', 1);"><div id="elh_gajisd_detil_potongan1" class="gajisd_detil_potongan1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->potongan1->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->potongan1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->potongan1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_detil_list->potongan2->Visible) { // potongan2 ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->potongan2) == "") { ?>
		<th data-name="potongan2" class="<?php echo $gajisd_detil_list->potongan2->headerCellClass() ?>"><div id="elh_gajisd_detil_potongan2" class="gajisd_detil_potongan2"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->potongan2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan2" class="<?php echo $gajisd_detil_list->potongan2->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->potongan2) ?>', 1);"><div id="elh_gajisd_detil_potongan2" class="gajisd_detil_potongan2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->potongan2->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->potongan2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->potongan2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisd_detil_list->jumlahterima->Visible) { // jumlahterima ?>
	<?php if ($gajisd_detil_list->SortUrl($gajisd_detil_list->jumlahterima) == "") { ?>
		<th data-name="jumlahterima" class="<?php echo $gajisd_detil_list->jumlahterima->headerCellClass() ?>"><div id="elh_gajisd_detil_jumlahterima" class="gajisd_detil_jumlahterima"><div class="ew-table-header-caption"><?php echo $gajisd_detil_list->jumlahterima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlahterima" class="<?php echo $gajisd_detil_list->jumlahterima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $gajisd_detil_list->SortUrl($gajisd_detil_list->jumlahterima) ?>', 1);"><div id="elh_gajisd_detil_jumlahterima" class="gajisd_detil_jumlahterima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisd_detil_list->jumlahterima->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisd_detil_list->jumlahterima->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisd_detil_list->jumlahterima->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajisd_detil_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($gajisd_detil_list->ExportAll && $gajisd_detil_list->isExport()) {
	$gajisd_detil_list->StopRecord = $gajisd_detil_list->TotalRecords;
} else {

	// Set the last record to display
	if ($gajisd_detil_list->TotalRecords > $gajisd_detil_list->StartRecord + $gajisd_detil_list->DisplayRecords - 1)
		$gajisd_detil_list->StopRecord = $gajisd_detil_list->StartRecord + $gajisd_detil_list->DisplayRecords - 1;
	else
		$gajisd_detil_list->StopRecord = $gajisd_detil_list->TotalRecords;
}
$gajisd_detil_list->RecordCount = $gajisd_detil_list->StartRecord - 1;
if ($gajisd_detil_list->Recordset && !$gajisd_detil_list->Recordset->EOF) {
	$gajisd_detil_list->Recordset->moveFirst();
	$selectLimit = $gajisd_detil_list->UseSelectLimit;
	if (!$selectLimit && $gajisd_detil_list->StartRecord > 1)
		$gajisd_detil_list->Recordset->move($gajisd_detil_list->StartRecord - 1);
} elseif (!$gajisd_detil->AllowAddDeleteRow && $gajisd_detil_list->StopRecord == 0) {
	$gajisd_detil_list->StopRecord = $gajisd_detil->GridAddRowCount;
}

// Initialize aggregate
$gajisd_detil->RowType = ROWTYPE_AGGREGATEINIT;
$gajisd_detil->resetAttributes();
$gajisd_detil_list->renderRow();
while ($gajisd_detil_list->RecordCount < $gajisd_detil_list->StopRecord) {
	$gajisd_detil_list->RecordCount++;
	if ($gajisd_detil_list->RecordCount >= $gajisd_detil_list->StartRecord) {
		$gajisd_detil_list->RowCount++;

		// Set up key count
		$gajisd_detil_list->KeyCount = $gajisd_detil_list->RowIndex;

		// Init row class and style
		$gajisd_detil->resetAttributes();
		$gajisd_detil->CssClass = "";
		if ($gajisd_detil_list->isGridAdd()) {
		} else {
			$gajisd_detil_list->loadRowValues($gajisd_detil_list->Recordset); // Load row values
		}
		$gajisd_detil->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$gajisd_detil->RowAttrs->merge(["data-rowindex" => $gajisd_detil_list->RowCount, "id" => "r" . $gajisd_detil_list->RowCount . "_gajisd_detil", "data-rowtype" => $gajisd_detil->RowType]);

		// Render row
		$gajisd_detil_list->renderRow();

		// Render list options
		$gajisd_detil_list->renderListOptions();
?>
	<tr <?php echo $gajisd_detil->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajisd_detil_list->ListOptions->render("body", "left", $gajisd_detil_list->RowCount);
?>
	<?php if ($gajisd_detil_list->pegawai_id->Visible) { // pegawai_id ?>
		<td data-name="pegawai_id" <?php echo $gajisd_detil_list->pegawai_id->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_pegawai_id">
<span<?php echo $gajisd_detil_list->pegawai_id->viewAttributes() ?>><?php echo $gajisd_detil_list->pegawai_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_detil_list->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id" <?php echo $gajisd_detil_list->jabatan_id->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_jabatan_id">
<span<?php echo $gajisd_detil_list->jabatan_id->viewAttributes() ?>><?php echo $gajisd_detil_list->jabatan_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_detil_list->masakerja->Visible) { // masakerja ?>
		<td data-name="masakerja" <?php echo $gajisd_detil_list->masakerja->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_masakerja">
<span<?php echo $gajisd_detil_list->masakerja->viewAttributes() ?>><?php echo $gajisd_detil_list->masakerja->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_detil_list->jumngajar->Visible) { // jumngajar ?>
		<td data-name="jumngajar" <?php echo $gajisd_detil_list->jumngajar->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_jumngajar">
<span<?php echo $gajisd_detil_list->jumngajar->viewAttributes() ?>><?php echo $gajisd_detil_list->jumngajar->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_detil_list->ijin->Visible) { // ijin ?>
		<td data-name="ijin" <?php echo $gajisd_detil_list->ijin->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_ijin">
<span<?php echo $gajisd_detil_list->ijin->viewAttributes() ?>><?php echo $gajisd_detil_list->ijin->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_detil_list->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
		<td data-name="tunjangan_wkosis" <?php echo $gajisd_detil_list->tunjangan_wkosis->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_tunjangan_wkosis">
<span<?php echo $gajisd_detil_list->tunjangan_wkosis->viewAttributes() ?>><?php echo $gajisd_detil_list->tunjangan_wkosis->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_detil_list->nominal_baku->Visible) { // nominal_baku ?>
		<td data-name="nominal_baku" <?php echo $gajisd_detil_list->nominal_baku->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_nominal_baku">
<span<?php echo $gajisd_detil_list->nominal_baku->viewAttributes() ?>><?php echo $gajisd_detil_list->nominal_baku->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_detil_list->baku->Visible) { // baku ?>
		<td data-name="baku" <?php echo $gajisd_detil_list->baku->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_baku">
<span<?php echo $gajisd_detil_list->baku->viewAttributes() ?>><?php echo $gajisd_detil_list->baku->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_detil_list->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran" <?php echo $gajisd_detil_list->kehadiran->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_kehadiran">
<span<?php echo $gajisd_detil_list->kehadiran->viewAttributes() ?>><?php echo $gajisd_detil_list->kehadiran->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_detil_list->prestasi->Visible) { // prestasi ?>
		<td data-name="prestasi" <?php echo $gajisd_detil_list->prestasi->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_prestasi">
<span<?php echo $gajisd_detil_list->prestasi->viewAttributes() ?>><?php echo $gajisd_detil_list->prestasi->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_detil_list->jumlahgaji->Visible) { // jumlahgaji ?>
		<td data-name="jumlahgaji" <?php echo $gajisd_detil_list->jumlahgaji->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_jumlahgaji">
<span<?php echo $gajisd_detil_list->jumlahgaji->viewAttributes() ?>><?php echo $gajisd_detil_list->jumlahgaji->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_detil_list->jumgajitotal->Visible) { // jumgajitotal ?>
		<td data-name="jumgajitotal" <?php echo $gajisd_detil_list->jumgajitotal->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_jumgajitotal">
<span<?php echo $gajisd_detil_list->jumgajitotal->viewAttributes() ?>><?php echo $gajisd_detil_list->jumgajitotal->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_detil_list->potongan1->Visible) { // potongan1 ?>
		<td data-name="potongan1" <?php echo $gajisd_detil_list->potongan1->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_potongan1">
<span<?php echo $gajisd_detil_list->potongan1->viewAttributes() ?>><?php echo $gajisd_detil_list->potongan1->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_detil_list->potongan2->Visible) { // potongan2 ?>
		<td data-name="potongan2" <?php echo $gajisd_detil_list->potongan2->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_potongan2">
<span<?php echo $gajisd_detil_list->potongan2->viewAttributes() ?>><?php echo $gajisd_detil_list->potongan2->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($gajisd_detil_list->jumlahterima->Visible) { // jumlahterima ?>
		<td data-name="jumlahterima" <?php echo $gajisd_detil_list->jumlahterima->cellAttributes() ?>>
<span id="el<?php echo $gajisd_detil_list->RowCount ?>_gajisd_detil_jumlahterima">
<span<?php echo $gajisd_detil_list->jumlahterima->viewAttributes() ?>><?php echo $gajisd_detil_list->jumlahterima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajisd_detil_list->ListOptions->render("body", "right", $gajisd_detil_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$gajisd_detil_list->isGridAdd())
		$gajisd_detil_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$gajisd_detil->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gajisd_detil_list->Recordset)
	$gajisd_detil_list->Recordset->Close();
?>
<?php if (!$gajisd_detil_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$gajisd_detil_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $gajisd_detil_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $gajisd_detil_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gajisd_detil_list->TotalRecords == 0 && !$gajisd_detil->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gajisd_detil_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$gajisd_detil_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$gajisd_detil_list->isExport()) { ?>
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
$gajisd_detil_list->terminate();
?>