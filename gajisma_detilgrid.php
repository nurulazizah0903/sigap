<?php
namespace PHPMaker2020\sigap;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($gajisma_detil_grid))
	$gajisma_detil_grid = new gajisma_detil_grid();

// Run the page
$gajisma_detil_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajisma_detil_grid->Page_Render();
?>
<?php if (!$gajisma_detil_grid->isExport()) { ?>
<script>
var fgajisma_detilgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fgajisma_detilgrid = new ew.Form("fgajisma_detilgrid", "grid");
	fgajisma_detilgrid.formKeyCountName = '<?php echo $gajisma_detil_grid->FormKeyCountName ?>';

	// Validate form
	fgajisma_detilgrid.validate = function() {
		if (!this.validateRequired)
			return true; // Ignore validation
		var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
		if ($fobj.find("#confirm").val() == "confirm")
			return true;
		var elm, felm, uelm, addcnt = 0;
		var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
		var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
		var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
		var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
		for (var i = startcnt; i <= rowcnt; i++) {
			var infix = ($k[0]) ? String(i) : "";
			$fobj.data("rowindex", infix);
			var checkrow = (gridinsert) ? !this.emptyRow(infix) : true;
			if (checkrow) {
				addcnt++;
			<?php if ($gajisma_detil_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->id->caption(), $gajisma_detil_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajisma_detil_grid->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->pid->caption(), $gajisma_detil_grid->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_detil_grid->pid->errorMessage()) ?>");
			<?php if ($gajisma_detil_grid->pegawai_id->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->pegawai_id->caption(), $gajisma_detil_grid->pegawai_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajisma_detil_grid->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->jabatan_id->caption(), $gajisma_detil_grid->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajisma_detil_grid->masakerja->Required) { ?>
				elm = this.getElements("x" + infix + "_masakerja");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->masakerja->caption(), $gajisma_detil_grid->masakerja->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masakerja");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_detil_grid->masakerja->errorMessage()) ?>");
			<?php if ($gajisma_detil_grid->jumngajar->Required) { ?>
				elm = this.getElements("x" + infix + "_jumngajar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->jumngajar->caption(), $gajisma_detil_grid->jumngajar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumngajar");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_detil_grid->jumngajar->errorMessage()) ?>");
			<?php if ($gajisma_detil_grid->ijin->Required) { ?>
				elm = this.getElements("x" + infix + "_ijin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->ijin->caption(), $gajisma_detil_grid->ijin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ijin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_detil_grid->ijin->errorMessage()) ?>");
			<?php if ($gajisma_detil_grid->tunjangan_wkosis->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_wkosis");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->tunjangan_wkosis->caption(), $gajisma_detil_grid->tunjangan_wkosis->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_wkosis");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_detil_grid->tunjangan_wkosis->errorMessage()) ?>");
			<?php if ($gajisma_detil_grid->nominal_baku->Required) { ?>
				elm = this.getElements("x" + infix + "_nominal_baku");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->nominal_baku->caption(), $gajisma_detil_grid->nominal_baku->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_nominal_baku");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_detil_grid->nominal_baku->errorMessage()) ?>");
			<?php if ($gajisma_detil_grid->baku->Required) { ?>
				elm = this.getElements("x" + infix + "_baku");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->baku->caption(), $gajisma_detil_grid->baku->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_baku");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_detil_grid->baku->errorMessage()) ?>");
			<?php if ($gajisma_detil_grid->kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->kehadiran->caption(), $gajisma_detil_grid->kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_detil_grid->kehadiran->errorMessage()) ?>");
			<?php if ($gajisma_detil_grid->prestasi->Required) { ?>
				elm = this.getElements("x" + infix + "_prestasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->prestasi->caption(), $gajisma_detil_grid->prestasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_prestasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_detil_grid->prestasi->errorMessage()) ?>");
			<?php if ($gajisma_detil_grid->jumlahgaji->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlahgaji");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->jumlahgaji->caption(), $gajisma_detil_grid->jumlahgaji->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlahgaji");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_detil_grid->jumlahgaji->errorMessage()) ?>");
			<?php if ($gajisma_detil_grid->jumgajitotal->Required) { ?>
				elm = this.getElements("x" + infix + "_jumgajitotal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->jumgajitotal->caption(), $gajisma_detil_grid->jumgajitotal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumgajitotal");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_detil_grid->jumgajitotal->errorMessage()) ?>");
			<?php if ($gajisma_detil_grid->potongan1->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->potongan1->caption(), $gajisma_detil_grid->potongan1->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan1");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_detil_grid->potongan1->errorMessage()) ?>");
			<?php if ($gajisma_detil_grid->potongan2->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->potongan2->caption(), $gajisma_detil_grid->potongan2->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan2");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_detil_grid->potongan2->errorMessage()) ?>");
			<?php if ($gajisma_detil_grid->jumlahterima->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlahterima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajisma_detil_grid->jumlahterima->caption(), $gajisma_detil_grid->jumlahterima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlahterima");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajisma_detil_grid->jumlahterima->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fgajisma_detilgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pid", false)) return false;
		if (ew.valueChanged(fobj, infix, "pegawai_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "jabatan_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "masakerja", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumngajar", false)) return false;
		if (ew.valueChanged(fobj, infix, "ijin", false)) return false;
		if (ew.valueChanged(fobj, infix, "tunjangan_wkosis", false)) return false;
		if (ew.valueChanged(fobj, infix, "nominal_baku", false)) return false;
		if (ew.valueChanged(fobj, infix, "baku", false)) return false;
		if (ew.valueChanged(fobj, infix, "kehadiran", false)) return false;
		if (ew.valueChanged(fobj, infix, "prestasi", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumlahgaji", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumgajitotal", false)) return false;
		if (ew.valueChanged(fobj, infix, "potongan1", false)) return false;
		if (ew.valueChanged(fobj, infix, "potongan2", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumlahterima", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fgajisma_detilgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgajisma_detilgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgajisma_detilgrid.lists["x_pegawai_id"] = <?php echo $gajisma_detil_grid->pegawai_id->Lookup->toClientList($gajisma_detil_grid) ?>;
	fgajisma_detilgrid.lists["x_pegawai_id"].options = <?php echo JsonEncode($gajisma_detil_grid->pegawai_id->lookupOptions()) ?>;
	fgajisma_detilgrid.lists["x_jabatan_id"] = <?php echo $gajisma_detil_grid->jabatan_id->Lookup->toClientList($gajisma_detil_grid) ?>;
	fgajisma_detilgrid.lists["x_jabatan_id"].options = <?php echo JsonEncode($gajisma_detil_grid->jabatan_id->lookupOptions()) ?>;
	fgajisma_detilgrid.autoSuggests["x_jabatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgajisma_detilgrid");
});
</script>
<?php } ?>
<?php
$gajisma_detil_grid->renderOtherOptions();
?>
<?php if ($gajisma_detil_grid->TotalRecords > 0 || $gajisma_detil->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gajisma_detil_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajisma_detil">
<?php if ($gajisma_detil_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $gajisma_detil_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fgajisma_detilgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_gajisma_detil" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_gajisma_detilgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gajisma_detil->RowType = ROWTYPE_HEADER;

// Render list options
$gajisma_detil_grid->renderListOptions();

// Render list options (header, left)
$gajisma_detil_grid->ListOptions->render("header", "left");
?>
<?php if ($gajisma_detil_grid->id->Visible) { // id ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $gajisma_detil_grid->id->headerCellClass() ?>"><div id="elh_gajisma_detil_id" class="gajisma_detil_id"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $gajisma_detil_grid->id->headerCellClass() ?>"><div><div id="elh_gajisma_detil_id" class="gajisma_detil_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->pid->Visible) { // pid ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->pid) == "") { ?>
		<th data-name="pid" class="<?php echo $gajisma_detil_grid->pid->headerCellClass() ?>"><div id="elh_gajisma_detil_pid" class="gajisma_detil_pid"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->pid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid" class="<?php echo $gajisma_detil_grid->pid->headerCellClass() ?>"><div><div id="elh_gajisma_detil_pid" class="gajisma_detil_pid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->pid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->pid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->pegawai_id->Visible) { // pegawai_id ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->pegawai_id) == "") { ?>
		<th data-name="pegawai_id" class="<?php echo $gajisma_detil_grid->pegawai_id->headerCellClass() ?>"><div id="elh_gajisma_detil_pegawai_id" class="gajisma_detil_pegawai_id"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->pegawai_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai_id" class="<?php echo $gajisma_detil_grid->pegawai_id->headerCellClass() ?>"><div><div id="elh_gajisma_detil_pegawai_id" class="gajisma_detil_pegawai_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->pegawai_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->pegawai_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->pegawai_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->jabatan_id) == "") { ?>
		<th data-name="jabatan_id" class="<?php echo $gajisma_detil_grid->jabatan_id->headerCellClass() ?>"><div id="elh_gajisma_detil_jabatan_id" class="gajisma_detil_jabatan_id"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->jabatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan_id" class="<?php echo $gajisma_detil_grid->jabatan_id->headerCellClass() ?>"><div><div id="elh_gajisma_detil_jabatan_id" class="gajisma_detil_jabatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->jabatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->jabatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->masakerja->Visible) { // masakerja ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->masakerja) == "") { ?>
		<th data-name="masakerja" class="<?php echo $gajisma_detil_grid->masakerja->headerCellClass() ?>"><div id="elh_gajisma_detil_masakerja" class="gajisma_detil_masakerja"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->masakerja->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masakerja" class="<?php echo $gajisma_detil_grid->masakerja->headerCellClass() ?>"><div><div id="elh_gajisma_detil_masakerja" class="gajisma_detil_masakerja">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->masakerja->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->masakerja->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->masakerja->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->jumngajar->Visible) { // jumngajar ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->jumngajar) == "") { ?>
		<th data-name="jumngajar" class="<?php echo $gajisma_detil_grid->jumngajar->headerCellClass() ?>"><div id="elh_gajisma_detil_jumngajar" class="gajisma_detil_jumngajar"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->jumngajar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumngajar" class="<?php echo $gajisma_detil_grid->jumngajar->headerCellClass() ?>"><div><div id="elh_gajisma_detil_jumngajar" class="gajisma_detil_jumngajar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->jumngajar->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->jumngajar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->jumngajar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->ijin->Visible) { // ijin ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->ijin) == "") { ?>
		<th data-name="ijin" class="<?php echo $gajisma_detil_grid->ijin->headerCellClass() ?>"><div id="elh_gajisma_detil_ijin" class="gajisma_detil_ijin"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->ijin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ijin" class="<?php echo $gajisma_detil_grid->ijin->headerCellClass() ?>"><div><div id="elh_gajisma_detil_ijin" class="gajisma_detil_ijin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->ijin->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->ijin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->ijin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->tunjangan_wkosis) == "") { ?>
		<th data-name="tunjangan_wkosis" class="<?php echo $gajisma_detil_grid->tunjangan_wkosis->headerCellClass() ?>"><div id="elh_gajisma_detil_tunjangan_wkosis" class="gajisma_detil_tunjangan_wkosis"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->tunjangan_wkosis->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tunjangan_wkosis" class="<?php echo $gajisma_detil_grid->tunjangan_wkosis->headerCellClass() ?>"><div><div id="elh_gajisma_detil_tunjangan_wkosis" class="gajisma_detil_tunjangan_wkosis">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->tunjangan_wkosis->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->tunjangan_wkosis->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->tunjangan_wkosis->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->nominal_baku->Visible) { // nominal_baku ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->nominal_baku) == "") { ?>
		<th data-name="nominal_baku" class="<?php echo $gajisma_detil_grid->nominal_baku->headerCellClass() ?>"><div id="elh_gajisma_detil_nominal_baku" class="gajisma_detil_nominal_baku"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->nominal_baku->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nominal_baku" class="<?php echo $gajisma_detil_grid->nominal_baku->headerCellClass() ?>"><div><div id="elh_gajisma_detil_nominal_baku" class="gajisma_detil_nominal_baku">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->nominal_baku->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->nominal_baku->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->nominal_baku->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->baku->Visible) { // baku ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->baku) == "") { ?>
		<th data-name="baku" class="<?php echo $gajisma_detil_grid->baku->headerCellClass() ?>"><div id="elh_gajisma_detil_baku" class="gajisma_detil_baku"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->baku->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="baku" class="<?php echo $gajisma_detil_grid->baku->headerCellClass() ?>"><div><div id="elh_gajisma_detil_baku" class="gajisma_detil_baku">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->baku->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->baku->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->baku->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->kehadiran->Visible) { // kehadiran ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->kehadiran) == "") { ?>
		<th data-name="kehadiran" class="<?php echo $gajisma_detil_grid->kehadiran->headerCellClass() ?>"><div id="elh_gajisma_detil_kehadiran" class="gajisma_detil_kehadiran"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->kehadiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kehadiran" class="<?php echo $gajisma_detil_grid->kehadiran->headerCellClass() ?>"><div><div id="elh_gajisma_detil_kehadiran" class="gajisma_detil_kehadiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->kehadiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->kehadiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->prestasi->Visible) { // prestasi ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->prestasi) == "") { ?>
		<th data-name="prestasi" class="<?php echo $gajisma_detil_grid->prestasi->headerCellClass() ?>"><div id="elh_gajisma_detil_prestasi" class="gajisma_detil_prestasi"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->prestasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prestasi" class="<?php echo $gajisma_detil_grid->prestasi->headerCellClass() ?>"><div><div id="elh_gajisma_detil_prestasi" class="gajisma_detil_prestasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->prestasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->prestasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->prestasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->jumlahgaji->Visible) { // jumlahgaji ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->jumlahgaji) == "") { ?>
		<th data-name="jumlahgaji" class="<?php echo $gajisma_detil_grid->jumlahgaji->headerCellClass() ?>"><div id="elh_gajisma_detil_jumlahgaji" class="gajisma_detil_jumlahgaji"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->jumlahgaji->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlahgaji" class="<?php echo $gajisma_detil_grid->jumlahgaji->headerCellClass() ?>"><div><div id="elh_gajisma_detil_jumlahgaji" class="gajisma_detil_jumlahgaji">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->jumlahgaji->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->jumlahgaji->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->jumlahgaji->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->jumgajitotal->Visible) { // jumgajitotal ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->jumgajitotal) == "") { ?>
		<th data-name="jumgajitotal" class="<?php echo $gajisma_detil_grid->jumgajitotal->headerCellClass() ?>"><div id="elh_gajisma_detil_jumgajitotal" class="gajisma_detil_jumgajitotal"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->jumgajitotal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumgajitotal" class="<?php echo $gajisma_detil_grid->jumgajitotal->headerCellClass() ?>"><div><div id="elh_gajisma_detil_jumgajitotal" class="gajisma_detil_jumgajitotal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->jumgajitotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->jumgajitotal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->jumgajitotal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->potongan1->Visible) { // potongan1 ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->potongan1) == "") { ?>
		<th data-name="potongan1" class="<?php echo $gajisma_detil_grid->potongan1->headerCellClass() ?>"><div id="elh_gajisma_detil_potongan1" class="gajisma_detil_potongan1"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->potongan1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan1" class="<?php echo $gajisma_detil_grid->potongan1->headerCellClass() ?>"><div><div id="elh_gajisma_detil_potongan1" class="gajisma_detil_potongan1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->potongan1->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->potongan1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->potongan1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->potongan2->Visible) { // potongan2 ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->potongan2) == "") { ?>
		<th data-name="potongan2" class="<?php echo $gajisma_detil_grid->potongan2->headerCellClass() ?>"><div id="elh_gajisma_detil_potongan2" class="gajisma_detil_potongan2"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->potongan2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan2" class="<?php echo $gajisma_detil_grid->potongan2->headerCellClass() ?>"><div><div id="elh_gajisma_detil_potongan2" class="gajisma_detil_potongan2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->potongan2->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->potongan2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->potongan2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajisma_detil_grid->jumlahterima->Visible) { // jumlahterima ?>
	<?php if ($gajisma_detil_grid->SortUrl($gajisma_detil_grid->jumlahterima) == "") { ?>
		<th data-name="jumlahterima" class="<?php echo $gajisma_detil_grid->jumlahterima->headerCellClass() ?>"><div id="elh_gajisma_detil_jumlahterima" class="gajisma_detil_jumlahterima"><div class="ew-table-header-caption"><?php echo $gajisma_detil_grid->jumlahterima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlahterima" class="<?php echo $gajisma_detil_grid->jumlahterima->headerCellClass() ?>"><div><div id="elh_gajisma_detil_jumlahterima" class="gajisma_detil_jumlahterima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajisma_detil_grid->jumlahterima->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajisma_detil_grid->jumlahterima->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajisma_detil_grid->jumlahterima->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajisma_detil_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$gajisma_detil_grid->StartRecord = 1;
$gajisma_detil_grid->StopRecord = $gajisma_detil_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($gajisma_detil->isConfirm() || $gajisma_detil_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($gajisma_detil_grid->FormKeyCountName) && ($gajisma_detil_grid->isGridAdd() || $gajisma_detil_grid->isGridEdit() || $gajisma_detil->isConfirm())) {
		$gajisma_detil_grid->KeyCount = $CurrentForm->getValue($gajisma_detil_grid->FormKeyCountName);
		$gajisma_detil_grid->StopRecord = $gajisma_detil_grid->StartRecord + $gajisma_detil_grid->KeyCount - 1;
	}
}
$gajisma_detil_grid->RecordCount = $gajisma_detil_grid->StartRecord - 1;
if ($gajisma_detil_grid->Recordset && !$gajisma_detil_grid->Recordset->EOF) {
	$gajisma_detil_grid->Recordset->moveFirst();
	$selectLimit = $gajisma_detil_grid->UseSelectLimit;
	if (!$selectLimit && $gajisma_detil_grid->StartRecord > 1)
		$gajisma_detil_grid->Recordset->move($gajisma_detil_grid->StartRecord - 1);
} elseif (!$gajisma_detil->AllowAddDeleteRow && $gajisma_detil_grid->StopRecord == 0) {
	$gajisma_detil_grid->StopRecord = $gajisma_detil->GridAddRowCount;
}

// Initialize aggregate
$gajisma_detil->RowType = ROWTYPE_AGGREGATEINIT;
$gajisma_detil->resetAttributes();
$gajisma_detil_grid->renderRow();
if ($gajisma_detil_grid->isGridAdd())
	$gajisma_detil_grid->RowIndex = 0;
if ($gajisma_detil_grid->isGridEdit())
	$gajisma_detil_grid->RowIndex = 0;
while ($gajisma_detil_grid->RecordCount < $gajisma_detil_grid->StopRecord) {
	$gajisma_detil_grid->RecordCount++;
	if ($gajisma_detil_grid->RecordCount >= $gajisma_detil_grid->StartRecord) {
		$gajisma_detil_grid->RowCount++;
		if ($gajisma_detil_grid->isGridAdd() || $gajisma_detil_grid->isGridEdit() || $gajisma_detil->isConfirm()) {
			$gajisma_detil_grid->RowIndex++;
			$CurrentForm->Index = $gajisma_detil_grid->RowIndex;
			if ($CurrentForm->hasValue($gajisma_detil_grid->FormActionName) && ($gajisma_detil->isConfirm() || $gajisma_detil_grid->EventCancelled))
				$gajisma_detil_grid->RowAction = strval($CurrentForm->getValue($gajisma_detil_grid->FormActionName));
			elseif ($gajisma_detil_grid->isGridAdd())
				$gajisma_detil_grid->RowAction = "insert";
			else
				$gajisma_detil_grid->RowAction = "";
		}

		// Set up key count
		$gajisma_detil_grid->KeyCount = $gajisma_detil_grid->RowIndex;

		// Init row class and style
		$gajisma_detil->resetAttributes();
		$gajisma_detil->CssClass = "";
		if ($gajisma_detil_grid->isGridAdd()) {
			if ($gajisma_detil->CurrentMode == "copy") {
				$gajisma_detil_grid->loadRowValues($gajisma_detil_grid->Recordset); // Load row values
				$gajisma_detil_grid->setRecordKey($gajisma_detil_grid->RowOldKey, $gajisma_detil_grid->Recordset); // Set old record key
			} else {
				$gajisma_detil_grid->loadRowValues(); // Load default values
				$gajisma_detil_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$gajisma_detil_grid->loadRowValues($gajisma_detil_grid->Recordset); // Load row values
		}
		$gajisma_detil->RowType = ROWTYPE_VIEW; // Render view
		if ($gajisma_detil_grid->isGridAdd()) // Grid add
			$gajisma_detil->RowType = ROWTYPE_ADD; // Render add
		if ($gajisma_detil_grid->isGridAdd() && $gajisma_detil->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$gajisma_detil_grid->restoreCurrentRowFormValues($gajisma_detil_grid->RowIndex); // Restore form values
		if ($gajisma_detil_grid->isGridEdit()) { // Grid edit
			if ($gajisma_detil->EventCancelled)
				$gajisma_detil_grid->restoreCurrentRowFormValues($gajisma_detil_grid->RowIndex); // Restore form values
			if ($gajisma_detil_grid->RowAction == "insert")
				$gajisma_detil->RowType = ROWTYPE_ADD; // Render add
			else
				$gajisma_detil->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($gajisma_detil_grid->isGridEdit() && ($gajisma_detil->RowType == ROWTYPE_EDIT || $gajisma_detil->RowType == ROWTYPE_ADD) && $gajisma_detil->EventCancelled) // Update failed
			$gajisma_detil_grid->restoreCurrentRowFormValues($gajisma_detil_grid->RowIndex); // Restore form values
		if ($gajisma_detil->RowType == ROWTYPE_EDIT) // Edit row
			$gajisma_detil_grid->EditRowCount++;
		if ($gajisma_detil->isConfirm()) // Confirm row
			$gajisma_detil_grid->restoreCurrentRowFormValues($gajisma_detil_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$gajisma_detil->RowAttrs->merge(["data-rowindex" => $gajisma_detil_grid->RowCount, "id" => "r" . $gajisma_detil_grid->RowCount . "_gajisma_detil", "data-rowtype" => $gajisma_detil->RowType]);

		// Render row
		$gajisma_detil_grid->renderRow();

		// Render list options
		$gajisma_detil_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($gajisma_detil_grid->RowAction != "delete" && $gajisma_detil_grid->RowAction != "insertdelete" && !($gajisma_detil_grid->RowAction == "insert" && $gajisma_detil->isConfirm() && $gajisma_detil_grid->emptyRow())) {
?>
	<tr <?php echo $gajisma_detil->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajisma_detil_grid->ListOptions->render("body", "left", $gajisma_detil_grid->RowCount);
?>
	<?php if ($gajisma_detil_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $gajisma_detil_grid->id->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_id" class="form-group"></span>
<input type="hidden" data-table="gajisma_detil" data-field="x_id" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_id" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gajisma_detil_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_id" class="form-group">
<span<?php echo $gajisma_detil_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_id" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_id" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gajisma_detil_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_id">
<span<?php echo $gajisma_detil_grid->id->viewAttributes() ?>><?php echo $gajisma_detil_grid->id->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_id" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_id" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gajisma_detil_grid->id->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_id" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_id" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gajisma_detil_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_id" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_id" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gajisma_detil_grid->id->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_id" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_id" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gajisma_detil_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->pid->Visible) { // pid ?>
		<td data-name="pid" <?php echo $gajisma_detil_grid->pid->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($gajisma_detil_grid->pid->getSessionValue() != "") { ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_pid" class="form-group">
<span<?php echo $gajisma_detil_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gajisma_detil_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_pid" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_pid" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->pid->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->pid->EditValue ?>"<?php echo $gajisma_detil_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_pid" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_pid" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gajisma_detil_grid->pid->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($gajisma_detil_grid->pid->getSessionValue() != "") { ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_pid" class="form-group">
<span<?php echo $gajisma_detil_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gajisma_detil_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_pid" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_pid" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->pid->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->pid->EditValue ?>"<?php echo $gajisma_detil_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_pid">
<span<?php echo $gajisma_detil_grid->pid->viewAttributes() ?>><?php echo $gajisma_detil_grid->pid->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_pid" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gajisma_detil_grid->pid->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_pid" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_pid" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gajisma_detil_grid->pid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_pid" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gajisma_detil_grid->pid->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_pid" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_pid" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gajisma_detil_grid->pid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->pegawai_id->Visible) { // pegawai_id ?>
		<td data-name="pegawai_id" <?php echo $gajisma_detil_grid->pegawai_id->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_pegawai_id" class="form-group">
<?php $gajisma_detil_grid->pegawai_id->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id"><?php echo EmptyValue(strval($gajisma_detil_grid->pegawai_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $gajisma_detil_grid->pegawai_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajisma_detil_grid->pegawai_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gajisma_detil_grid->pegawai_id->ReadOnly || $gajisma_detil_grid->pegawai_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gajisma_detil_grid->pegawai_id->Lookup->getParamTag($gajisma_detil_grid, "p_x" . $gajisma_detil_grid->RowIndex . "_pegawai_id") ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajisma_detil_grid->pegawai_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo $gajisma_detil_grid->pegawai_id->CurrentValue ?>"<?php echo $gajisma_detil_grid->pegawai_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_pegawai_id" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo HtmlEncode($gajisma_detil_grid->pegawai_id->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_pegawai_id" class="form-group">
<?php $gajisma_detil_grid->pegawai_id->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id"><?php echo EmptyValue(strval($gajisma_detil_grid->pegawai_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $gajisma_detil_grid->pegawai_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajisma_detil_grid->pegawai_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gajisma_detil_grid->pegawai_id->ReadOnly || $gajisma_detil_grid->pegawai_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gajisma_detil_grid->pegawai_id->Lookup->getParamTag($gajisma_detil_grid, "p_x" . $gajisma_detil_grid->RowIndex . "_pegawai_id") ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajisma_detil_grid->pegawai_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo $gajisma_detil_grid->pegawai_id->CurrentValue ?>"<?php echo $gajisma_detil_grid->pegawai_id->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_pegawai_id">
<span<?php echo $gajisma_detil_grid->pegawai_id->viewAttributes() ?>><?php echo $gajisma_detil_grid->pegawai_id->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_pegawai_id" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo HtmlEncode($gajisma_detil_grid->pegawai_id->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_pegawai_id" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo HtmlEncode($gajisma_detil_grid->pegawai_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_pegawai_id" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo HtmlEncode($gajisma_detil_grid->pegawai_id->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_pegawai_id" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo HtmlEncode($gajisma_detil_grid->pegawai_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id" <?php echo $gajisma_detil_grid->jabatan_id->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jabatan_id" class="form-group">
<?php
$onchange = $gajisma_detil_grid->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gajisma_detil_grid->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" id="sv_x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo RemoveHtml($gajisma_detil_grid->jabatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->getPlaceHolder()) ?>"<?php echo $gajisma_detil_grid->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_jabatan_id" data-value-separator="<?php echo $gajisma_detil_grid->jabatan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgajisma_detilgrid"], function() {
	fgajisma_detilgrid.createAutoSuggest({"id":"x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gajisma_detil_grid->jabatan_id->Lookup->getParamTag($gajisma_detil_grid, "p_x" . $gajisma_detil_grid->RowIndex . "_jabatan_id") ?>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_jabatan_id" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jabatan_id" class="form-group">
<?php
$onchange = $gajisma_detil_grid->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gajisma_detil_grid->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" id="sv_x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo RemoveHtml($gajisma_detil_grid->jabatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->getPlaceHolder()) ?>"<?php echo $gajisma_detil_grid->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_jabatan_id" data-value-separator="<?php echo $gajisma_detil_grid->jabatan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgajisma_detilgrid"], function() {
	fgajisma_detilgrid.createAutoSuggest({"id":"x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gajisma_detil_grid->jabatan_id->Lookup->getParamTag($gajisma_detil_grid, "p_x" . $gajisma_detil_grid->RowIndex . "_jabatan_id") ?>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jabatan_id">
<span<?php echo $gajisma_detil_grid->jabatan_id->viewAttributes() ?>><?php echo $gajisma_detil_grid->jabatan_id->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jabatan_id" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_jabatan_id" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jabatan_id" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_jabatan_id" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->masakerja->Visible) { // masakerja ?>
		<td data-name="masakerja" <?php echo $gajisma_detil_grid->masakerja->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_masakerja" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_masakerja" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->masakerja->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->masakerja->EditValue ?>"<?php echo $gajisma_detil_grid->masakerja->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_masakerja" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" value="<?php echo HtmlEncode($gajisma_detil_grid->masakerja->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_masakerja" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_masakerja" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->masakerja->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->masakerja->EditValue ?>"<?php echo $gajisma_detil_grid->masakerja->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_masakerja">
<span<?php echo $gajisma_detil_grid->masakerja->viewAttributes() ?>><?php echo $gajisma_detil_grid->masakerja->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_masakerja" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" value="<?php echo HtmlEncode($gajisma_detil_grid->masakerja->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_masakerja" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" value="<?php echo HtmlEncode($gajisma_detil_grid->masakerja->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_masakerja" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" value="<?php echo HtmlEncode($gajisma_detil_grid->masakerja->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_masakerja" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" value="<?php echo HtmlEncode($gajisma_detil_grid->masakerja->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->jumngajar->Visible) { // jumngajar ?>
		<td data-name="jumngajar" <?php echo $gajisma_detil_grid->jumngajar->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jumngajar" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_jumngajar" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jumngajar->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->jumngajar->EditValue ?>"<?php echo $gajisma_detil_grid->jumngajar->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumngajar" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" value="<?php echo HtmlEncode($gajisma_detil_grid->jumngajar->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jumngajar" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_jumngajar" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jumngajar->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->jumngajar->EditValue ?>"<?php echo $gajisma_detil_grid->jumngajar->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jumngajar">
<span<?php echo $gajisma_detil_grid->jumngajar->viewAttributes() ?>><?php echo $gajisma_detil_grid->jumngajar->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumngajar" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" value="<?php echo HtmlEncode($gajisma_detil_grid->jumngajar->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_jumngajar" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" value="<?php echo HtmlEncode($gajisma_detil_grid->jumngajar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumngajar" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" value="<?php echo HtmlEncode($gajisma_detil_grid->jumngajar->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_jumngajar" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" value="<?php echo HtmlEncode($gajisma_detil_grid->jumngajar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->ijin->Visible) { // ijin ?>
		<td data-name="ijin" <?php echo $gajisma_detil_grid->ijin->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_ijin" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_ijin" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->ijin->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->ijin->EditValue ?>"<?php echo $gajisma_detil_grid->ijin->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_ijin" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($gajisma_detil_grid->ijin->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_ijin" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_ijin" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->ijin->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->ijin->EditValue ?>"<?php echo $gajisma_detil_grid->ijin->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_ijin">
<span<?php echo $gajisma_detil_grid->ijin->viewAttributes() ?>><?php echo $gajisma_detil_grid->ijin->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_ijin" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($gajisma_detil_grid->ijin->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_ijin" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($gajisma_detil_grid->ijin->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_ijin" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($gajisma_detil_grid->ijin->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_ijin" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($gajisma_detil_grid->ijin->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
		<td data-name="tunjangan_wkosis" <?php echo $gajisma_detil_grid->tunjangan_wkosis->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_tunjangan_wkosis" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_tunjangan_wkosis" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->tunjangan_wkosis->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->tunjangan_wkosis->EditValue ?>"<?php echo $gajisma_detil_grid->tunjangan_wkosis->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_tunjangan_wkosis" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" value="<?php echo HtmlEncode($gajisma_detil_grid->tunjangan_wkosis->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_tunjangan_wkosis" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_tunjangan_wkosis" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->tunjangan_wkosis->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->tunjangan_wkosis->EditValue ?>"<?php echo $gajisma_detil_grid->tunjangan_wkosis->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_tunjangan_wkosis">
<span<?php echo $gajisma_detil_grid->tunjangan_wkosis->viewAttributes() ?>><?php echo $gajisma_detil_grid->tunjangan_wkosis->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_tunjangan_wkosis" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" value="<?php echo HtmlEncode($gajisma_detil_grid->tunjangan_wkosis->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_tunjangan_wkosis" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" value="<?php echo HtmlEncode($gajisma_detil_grid->tunjangan_wkosis->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_tunjangan_wkosis" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" value="<?php echo HtmlEncode($gajisma_detil_grid->tunjangan_wkosis->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_tunjangan_wkosis" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" value="<?php echo HtmlEncode($gajisma_detil_grid->tunjangan_wkosis->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->nominal_baku->Visible) { // nominal_baku ?>
		<td data-name="nominal_baku" <?php echo $gajisma_detil_grid->nominal_baku->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_nominal_baku" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_nominal_baku" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->nominal_baku->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->nominal_baku->EditValue ?>"<?php echo $gajisma_detil_grid->nominal_baku->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_nominal_baku" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" value="<?php echo HtmlEncode($gajisma_detil_grid->nominal_baku->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_nominal_baku" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_nominal_baku" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->nominal_baku->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->nominal_baku->EditValue ?>"<?php echo $gajisma_detil_grid->nominal_baku->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_nominal_baku">
<span<?php echo $gajisma_detil_grid->nominal_baku->viewAttributes() ?>><?php echo $gajisma_detil_grid->nominal_baku->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_nominal_baku" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" value="<?php echo HtmlEncode($gajisma_detil_grid->nominal_baku->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_nominal_baku" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" value="<?php echo HtmlEncode($gajisma_detil_grid->nominal_baku->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_nominal_baku" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" value="<?php echo HtmlEncode($gajisma_detil_grid->nominal_baku->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_nominal_baku" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" value="<?php echo HtmlEncode($gajisma_detil_grid->nominal_baku->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->baku->Visible) { // baku ?>
		<td data-name="baku" <?php echo $gajisma_detil_grid->baku->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_baku" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_baku" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_baku" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_baku" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->baku->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->baku->EditValue ?>"<?php echo $gajisma_detil_grid->baku->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_baku" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_baku" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_baku" value="<?php echo HtmlEncode($gajisma_detil_grid->baku->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_baku" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_baku" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_baku" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_baku" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->baku->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->baku->EditValue ?>"<?php echo $gajisma_detil_grid->baku->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_baku">
<span<?php echo $gajisma_detil_grid->baku->viewAttributes() ?>><?php echo $gajisma_detil_grid->baku->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_baku" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_baku" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_baku" value="<?php echo HtmlEncode($gajisma_detil_grid->baku->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_baku" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_baku" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_baku" value="<?php echo HtmlEncode($gajisma_detil_grid->baku->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_baku" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_baku" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_baku" value="<?php echo HtmlEncode($gajisma_detil_grid->baku->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_baku" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_baku" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_baku" value="<?php echo HtmlEncode($gajisma_detil_grid->baku->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran" <?php echo $gajisma_detil_grid->kehadiran->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_kehadiran" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_kehadiran" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->kehadiran->EditValue ?>"<?php echo $gajisma_detil_grid->kehadiran->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_kehadiran" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gajisma_detil_grid->kehadiran->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_kehadiran" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_kehadiran" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->kehadiran->EditValue ?>"<?php echo $gajisma_detil_grid->kehadiran->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_kehadiran">
<span<?php echo $gajisma_detil_grid->kehadiran->viewAttributes() ?>><?php echo $gajisma_detil_grid->kehadiran->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_kehadiran" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gajisma_detil_grid->kehadiran->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_kehadiran" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gajisma_detil_grid->kehadiran->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_kehadiran" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gajisma_detil_grid->kehadiran->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_kehadiran" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gajisma_detil_grid->kehadiran->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->prestasi->Visible) { // prestasi ?>
		<td data-name="prestasi" <?php echo $gajisma_detil_grid->prestasi->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_prestasi" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_prestasi" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->prestasi->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->prestasi->EditValue ?>"<?php echo $gajisma_detil_grid->prestasi->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_prestasi" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" value="<?php echo HtmlEncode($gajisma_detil_grid->prestasi->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_prestasi" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_prestasi" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->prestasi->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->prestasi->EditValue ?>"<?php echo $gajisma_detil_grid->prestasi->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_prestasi">
<span<?php echo $gajisma_detil_grid->prestasi->viewAttributes() ?>><?php echo $gajisma_detil_grid->prestasi->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_prestasi" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" value="<?php echo HtmlEncode($gajisma_detil_grid->prestasi->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_prestasi" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" value="<?php echo HtmlEncode($gajisma_detil_grid->prestasi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_prestasi" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" value="<?php echo HtmlEncode($gajisma_detil_grid->prestasi->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_prestasi" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" value="<?php echo HtmlEncode($gajisma_detil_grid->prestasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->jumlahgaji->Visible) { // jumlahgaji ?>
		<td data-name="jumlahgaji" <?php echo $gajisma_detil_grid->jumlahgaji->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jumlahgaji" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_jumlahgaji" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jumlahgaji->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->jumlahgaji->EditValue ?>"<?php echo $gajisma_detil_grid->jumlahgaji->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumlahgaji" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" value="<?php echo HtmlEncode($gajisma_detil_grid->jumlahgaji->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jumlahgaji" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_jumlahgaji" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jumlahgaji->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->jumlahgaji->EditValue ?>"<?php echo $gajisma_detil_grid->jumlahgaji->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jumlahgaji">
<span<?php echo $gajisma_detil_grid->jumlahgaji->viewAttributes() ?>><?php echo $gajisma_detil_grid->jumlahgaji->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumlahgaji" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" value="<?php echo HtmlEncode($gajisma_detil_grid->jumlahgaji->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_jumlahgaji" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" value="<?php echo HtmlEncode($gajisma_detil_grid->jumlahgaji->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumlahgaji" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" value="<?php echo HtmlEncode($gajisma_detil_grid->jumlahgaji->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_jumlahgaji" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" value="<?php echo HtmlEncode($gajisma_detil_grid->jumlahgaji->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->jumgajitotal->Visible) { // jumgajitotal ?>
		<td data-name="jumgajitotal" <?php echo $gajisma_detil_grid->jumgajitotal->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jumgajitotal" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_jumgajitotal" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jumgajitotal->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->jumgajitotal->EditValue ?>"<?php echo $gajisma_detil_grid->jumgajitotal->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumgajitotal" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" value="<?php echo HtmlEncode($gajisma_detil_grid->jumgajitotal->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jumgajitotal" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_jumgajitotal" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jumgajitotal->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->jumgajitotal->EditValue ?>"<?php echo $gajisma_detil_grid->jumgajitotal->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jumgajitotal">
<span<?php echo $gajisma_detil_grid->jumgajitotal->viewAttributes() ?>><?php echo $gajisma_detil_grid->jumgajitotal->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumgajitotal" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" value="<?php echo HtmlEncode($gajisma_detil_grid->jumgajitotal->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_jumgajitotal" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" value="<?php echo HtmlEncode($gajisma_detil_grid->jumgajitotal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumgajitotal" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" value="<?php echo HtmlEncode($gajisma_detil_grid->jumgajitotal->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_jumgajitotal" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" value="<?php echo HtmlEncode($gajisma_detil_grid->jumgajitotal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->potongan1->Visible) { // potongan1 ?>
		<td data-name="potongan1" <?php echo $gajisma_detil_grid->potongan1->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_potongan1" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_potongan1" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->potongan1->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->potongan1->EditValue ?>"<?php echo $gajisma_detil_grid->potongan1->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_potongan1" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" value="<?php echo HtmlEncode($gajisma_detil_grid->potongan1->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_potongan1" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_potongan1" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->potongan1->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->potongan1->EditValue ?>"<?php echo $gajisma_detil_grid->potongan1->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_potongan1">
<span<?php echo $gajisma_detil_grid->potongan1->viewAttributes() ?>><?php echo $gajisma_detil_grid->potongan1->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_potongan1" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" value="<?php echo HtmlEncode($gajisma_detil_grid->potongan1->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_potongan1" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" value="<?php echo HtmlEncode($gajisma_detil_grid->potongan1->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_potongan1" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" value="<?php echo HtmlEncode($gajisma_detil_grid->potongan1->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_potongan1" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" value="<?php echo HtmlEncode($gajisma_detil_grid->potongan1->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->potongan2->Visible) { // potongan2 ?>
		<td data-name="potongan2" <?php echo $gajisma_detil_grid->potongan2->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_potongan2" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_potongan2" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->potongan2->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->potongan2->EditValue ?>"<?php echo $gajisma_detil_grid->potongan2->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_potongan2" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" value="<?php echo HtmlEncode($gajisma_detil_grid->potongan2->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_potongan2" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_potongan2" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->potongan2->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->potongan2->EditValue ?>"<?php echo $gajisma_detil_grid->potongan2->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_potongan2">
<span<?php echo $gajisma_detil_grid->potongan2->viewAttributes() ?>><?php echo $gajisma_detil_grid->potongan2->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_potongan2" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" value="<?php echo HtmlEncode($gajisma_detil_grid->potongan2->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_potongan2" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" value="<?php echo HtmlEncode($gajisma_detil_grid->potongan2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_potongan2" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" value="<?php echo HtmlEncode($gajisma_detil_grid->potongan2->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_potongan2" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" value="<?php echo HtmlEncode($gajisma_detil_grid->potongan2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->jumlahterima->Visible) { // jumlahterima ?>
		<td data-name="jumlahterima" <?php echo $gajisma_detil_grid->jumlahterima->cellAttributes() ?>>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jumlahterima" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_jumlahterima" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jumlahterima->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->jumlahterima->EditValue ?>"<?php echo $gajisma_detil_grid->jumlahterima->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumlahterima" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" value="<?php echo HtmlEncode($gajisma_detil_grid->jumlahterima->OldValue) ?>">
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jumlahterima" class="form-group">
<input type="text" data-table="gajisma_detil" data-field="x_jumlahterima" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jumlahterima->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->jumlahterima->EditValue ?>"<?php echo $gajisma_detil_grid->jumlahterima->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajisma_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajisma_detil_grid->RowCount ?>_gajisma_detil_jumlahterima">
<span<?php echo $gajisma_detil_grid->jumlahterima->viewAttributes() ?>><?php echo $gajisma_detil_grid->jumlahterima->getViewValue() ?></span>
</span>
<?php if (!$gajisma_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumlahterima" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" value="<?php echo HtmlEncode($gajisma_detil_grid->jumlahterima->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_jumlahterima" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" value="<?php echo HtmlEncode($gajisma_detil_grid->jumlahterima->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumlahterima" name="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" id="fgajisma_detilgrid$x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" value="<?php echo HtmlEncode($gajisma_detil_grid->jumlahterima->FormValue) ?>">
<input type="hidden" data-table="gajisma_detil" data-field="x_jumlahterima" name="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" id="fgajisma_detilgrid$o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" value="<?php echo HtmlEncode($gajisma_detil_grid->jumlahterima->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajisma_detil_grid->ListOptions->render("body", "right", $gajisma_detil_grid->RowCount);
?>
	</tr>
<?php if ($gajisma_detil->RowType == ROWTYPE_ADD || $gajisma_detil->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fgajisma_detilgrid", "load"], function() {
	fgajisma_detilgrid.updateLists(<?php echo $gajisma_detil_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$gajisma_detil_grid->isGridAdd() || $gajisma_detil->CurrentMode == "copy")
		if (!$gajisma_detil_grid->Recordset->EOF)
			$gajisma_detil_grid->Recordset->moveNext();
}
?>
<?php
	if ($gajisma_detil->CurrentMode == "add" || $gajisma_detil->CurrentMode == "copy" || $gajisma_detil->CurrentMode == "edit") {
		$gajisma_detil_grid->RowIndex = '$rowindex$';
		$gajisma_detil_grid->loadRowValues();

		// Set row properties
		$gajisma_detil->resetAttributes();
		$gajisma_detil->RowAttrs->merge(["data-rowindex" => $gajisma_detil_grid->RowIndex, "id" => "r0_gajisma_detil", "data-rowtype" => ROWTYPE_ADD]);
		$gajisma_detil->RowAttrs->appendClass("ew-template");
		$gajisma_detil->RowType = ROWTYPE_ADD;

		// Render row
		$gajisma_detil_grid->renderRow();

		// Render list options
		$gajisma_detil_grid->renderListOptions();
		$gajisma_detil_grid->StartRowCount = 0;
?>
	<tr <?php echo $gajisma_detil->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajisma_detil_grid->ListOptions->render("body", "left", $gajisma_detil_grid->RowIndex);
?>
	<?php if ($gajisma_detil_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_id" class="form-group gajisma_detil_id"></span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_id" class="form-group gajisma_detil_id">
<span<?php echo $gajisma_detil_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_id" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_id" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gajisma_detil_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_id" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_id" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gajisma_detil_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->pid->Visible) { // pid ?>
		<td data-name="pid">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<?php if ($gajisma_detil_grid->pid->getSessionValue() != "") { ?>
<span id="el$rowindex$_gajisma_detil_pid" class="form-group gajisma_detil_pid">
<span<?php echo $gajisma_detil_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gajisma_detil_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_pid" class="form-group gajisma_detil_pid">
<input type="text" data-table="gajisma_detil" data-field="x_pid" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->pid->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->pid->EditValue ?>"<?php echo $gajisma_detil_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_pid" class="form-group gajisma_detil_pid">
<span<?php echo $gajisma_detil_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_pid" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gajisma_detil_grid->pid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_pid" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_pid" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gajisma_detil_grid->pid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->pegawai_id->Visible) { // pegawai_id ?>
		<td data-name="pegawai_id">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_pegawai_id" class="form-group gajisma_detil_pegawai_id">
<?php $gajisma_detil_grid->pegawai_id->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id"><?php echo EmptyValue(strval($gajisma_detil_grid->pegawai_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $gajisma_detil_grid->pegawai_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajisma_detil_grid->pegawai_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gajisma_detil_grid->pegawai_id->ReadOnly || $gajisma_detil_grid->pegawai_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gajisma_detil_grid->pegawai_id->Lookup->getParamTag($gajisma_detil_grid, "p_x" . $gajisma_detil_grid->RowIndex . "_pegawai_id") ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajisma_detil_grid->pegawai_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo $gajisma_detil_grid->pegawai_id->CurrentValue ?>"<?php echo $gajisma_detil_grid->pegawai_id->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_pegawai_id" class="form-group gajisma_detil_pegawai_id">
<span<?php echo $gajisma_detil_grid->pegawai_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->pegawai_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_pegawai_id" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo HtmlEncode($gajisma_detil_grid->pegawai_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_pegawai_id" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo HtmlEncode($gajisma_detil_grid->pegawai_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_jabatan_id" class="form-group gajisma_detil_jabatan_id">
<?php
$onchange = $gajisma_detil_grid->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gajisma_detil_grid->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" id="sv_x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo RemoveHtml($gajisma_detil_grid->jabatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->getPlaceHolder()) ?>"<?php echo $gajisma_detil_grid->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_jabatan_id" data-value-separator="<?php echo $gajisma_detil_grid->jabatan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgajisma_detilgrid"], function() {
	fgajisma_detilgrid.createAutoSuggest({"id":"x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gajisma_detil_grid->jabatan_id->Lookup->getParamTag($gajisma_detil_grid, "p_x" . $gajisma_detil_grid->RowIndex . "_jabatan_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_jabatan_id" class="form-group gajisma_detil_jabatan_id">
<span<?php echo $gajisma_detil_grid->jabatan_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->jabatan_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_jabatan_id" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jabatan_id" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajisma_detil_grid->jabatan_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->masakerja->Visible) { // masakerja ?>
		<td data-name="masakerja">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_masakerja" class="form-group gajisma_detil_masakerja">
<input type="text" data-table="gajisma_detil" data-field="x_masakerja" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->masakerja->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->masakerja->EditValue ?>"<?php echo $gajisma_detil_grid->masakerja->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_masakerja" class="form-group gajisma_detil_masakerja">
<span<?php echo $gajisma_detil_grid->masakerja->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->masakerja->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_masakerja" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" value="<?php echo HtmlEncode($gajisma_detil_grid->masakerja->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_masakerja" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_masakerja" value="<?php echo HtmlEncode($gajisma_detil_grid->masakerja->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->jumngajar->Visible) { // jumngajar ?>
		<td data-name="jumngajar">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_jumngajar" class="form-group gajisma_detil_jumngajar">
<input type="text" data-table="gajisma_detil" data-field="x_jumngajar" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jumngajar->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->jumngajar->EditValue ?>"<?php echo $gajisma_detil_grid->jumngajar->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_jumngajar" class="form-group gajisma_detil_jumngajar">
<span<?php echo $gajisma_detil_grid->jumngajar->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->jumngajar->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumngajar" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" value="<?php echo HtmlEncode($gajisma_detil_grid->jumngajar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumngajar" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumngajar" value="<?php echo HtmlEncode($gajisma_detil_grid->jumngajar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->ijin->Visible) { // ijin ?>
		<td data-name="ijin">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_ijin" class="form-group gajisma_detil_ijin">
<input type="text" data-table="gajisma_detil" data-field="x_ijin" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->ijin->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->ijin->EditValue ?>"<?php echo $gajisma_detil_grid->ijin->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_ijin" class="form-group gajisma_detil_ijin">
<span<?php echo $gajisma_detil_grid->ijin->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->ijin->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_ijin" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($gajisma_detil_grid->ijin->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_ijin" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($gajisma_detil_grid->ijin->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->tunjangan_wkosis->Visible) { // tunjangan_wkosis ?>
		<td data-name="tunjangan_wkosis">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_tunjangan_wkosis" class="form-group gajisma_detil_tunjangan_wkosis">
<input type="text" data-table="gajisma_detil" data-field="x_tunjangan_wkosis" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->tunjangan_wkosis->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->tunjangan_wkosis->EditValue ?>"<?php echo $gajisma_detil_grid->tunjangan_wkosis->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_tunjangan_wkosis" class="form-group gajisma_detil_tunjangan_wkosis">
<span<?php echo $gajisma_detil_grid->tunjangan_wkosis->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->tunjangan_wkosis->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_tunjangan_wkosis" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" value="<?php echo HtmlEncode($gajisma_detil_grid->tunjangan_wkosis->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_tunjangan_wkosis" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_tunjangan_wkosis" value="<?php echo HtmlEncode($gajisma_detil_grid->tunjangan_wkosis->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->nominal_baku->Visible) { // nominal_baku ?>
		<td data-name="nominal_baku">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_nominal_baku" class="form-group gajisma_detil_nominal_baku">
<input type="text" data-table="gajisma_detil" data-field="x_nominal_baku" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->nominal_baku->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->nominal_baku->EditValue ?>"<?php echo $gajisma_detil_grid->nominal_baku->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_nominal_baku" class="form-group gajisma_detil_nominal_baku">
<span<?php echo $gajisma_detil_grid->nominal_baku->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->nominal_baku->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_nominal_baku" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" value="<?php echo HtmlEncode($gajisma_detil_grid->nominal_baku->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_nominal_baku" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_nominal_baku" value="<?php echo HtmlEncode($gajisma_detil_grid->nominal_baku->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->baku->Visible) { // baku ?>
		<td data-name="baku">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_baku" class="form-group gajisma_detil_baku">
<input type="text" data-table="gajisma_detil" data-field="x_baku" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_baku" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_baku" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->baku->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->baku->EditValue ?>"<?php echo $gajisma_detil_grid->baku->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_baku" class="form-group gajisma_detil_baku">
<span<?php echo $gajisma_detil_grid->baku->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->baku->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_baku" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_baku" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_baku" value="<?php echo HtmlEncode($gajisma_detil_grid->baku->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_baku" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_baku" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_baku" value="<?php echo HtmlEncode($gajisma_detil_grid->baku->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_kehadiran" class="form-group gajisma_detil_kehadiran">
<input type="text" data-table="gajisma_detil" data-field="x_kehadiran" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->kehadiran->EditValue ?>"<?php echo $gajisma_detil_grid->kehadiran->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_kehadiran" class="form-group gajisma_detil_kehadiran">
<span<?php echo $gajisma_detil_grid->kehadiran->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->kehadiran->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_kehadiran" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gajisma_detil_grid->kehadiran->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_kehadiran" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gajisma_detil_grid->kehadiran->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->prestasi->Visible) { // prestasi ?>
		<td data-name="prestasi">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_prestasi" class="form-group gajisma_detil_prestasi">
<input type="text" data-table="gajisma_detil" data-field="x_prestasi" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->prestasi->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->prestasi->EditValue ?>"<?php echo $gajisma_detil_grid->prestasi->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_prestasi" class="form-group gajisma_detil_prestasi">
<span<?php echo $gajisma_detil_grid->prestasi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->prestasi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_prestasi" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" value="<?php echo HtmlEncode($gajisma_detil_grid->prestasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_prestasi" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_prestasi" value="<?php echo HtmlEncode($gajisma_detil_grid->prestasi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->jumlahgaji->Visible) { // jumlahgaji ?>
		<td data-name="jumlahgaji">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_jumlahgaji" class="form-group gajisma_detil_jumlahgaji">
<input type="text" data-table="gajisma_detil" data-field="x_jumlahgaji" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jumlahgaji->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->jumlahgaji->EditValue ?>"<?php echo $gajisma_detil_grid->jumlahgaji->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_jumlahgaji" class="form-group gajisma_detil_jumlahgaji">
<span<?php echo $gajisma_detil_grid->jumlahgaji->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->jumlahgaji->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumlahgaji" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" value="<?php echo HtmlEncode($gajisma_detil_grid->jumlahgaji->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumlahgaji" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahgaji" value="<?php echo HtmlEncode($gajisma_detil_grid->jumlahgaji->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->jumgajitotal->Visible) { // jumgajitotal ?>
		<td data-name="jumgajitotal">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_jumgajitotal" class="form-group gajisma_detil_jumgajitotal">
<input type="text" data-table="gajisma_detil" data-field="x_jumgajitotal" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jumgajitotal->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->jumgajitotal->EditValue ?>"<?php echo $gajisma_detil_grid->jumgajitotal->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_jumgajitotal" class="form-group gajisma_detil_jumgajitotal">
<span<?php echo $gajisma_detil_grid->jumgajitotal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->jumgajitotal->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumgajitotal" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" value="<?php echo HtmlEncode($gajisma_detil_grid->jumgajitotal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumgajitotal" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumgajitotal" value="<?php echo HtmlEncode($gajisma_detil_grid->jumgajitotal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->potongan1->Visible) { // potongan1 ?>
		<td data-name="potongan1">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_potongan1" class="form-group gajisma_detil_potongan1">
<input type="text" data-table="gajisma_detil" data-field="x_potongan1" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->potongan1->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->potongan1->EditValue ?>"<?php echo $gajisma_detil_grid->potongan1->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_potongan1" class="form-group gajisma_detil_potongan1">
<span<?php echo $gajisma_detil_grid->potongan1->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->potongan1->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_potongan1" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" value="<?php echo HtmlEncode($gajisma_detil_grid->potongan1->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_potongan1" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan1" value="<?php echo HtmlEncode($gajisma_detil_grid->potongan1->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->potongan2->Visible) { // potongan2 ?>
		<td data-name="potongan2">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_potongan2" class="form-group gajisma_detil_potongan2">
<input type="text" data-table="gajisma_detil" data-field="x_potongan2" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->potongan2->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->potongan2->EditValue ?>"<?php echo $gajisma_detil_grid->potongan2->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_potongan2" class="form-group gajisma_detil_potongan2">
<span<?php echo $gajisma_detil_grid->potongan2->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->potongan2->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_potongan2" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" value="<?php echo HtmlEncode($gajisma_detil_grid->potongan2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_potongan2" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_potongan2" value="<?php echo HtmlEncode($gajisma_detil_grid->potongan2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajisma_detil_grid->jumlahterima->Visible) { // jumlahterima ?>
		<td data-name="jumlahterima">
<?php if (!$gajisma_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajisma_detil_jumlahterima" class="form-group gajisma_detil_jumlahterima">
<input type="text" data-table="gajisma_detil" data-field="x_jumlahterima" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajisma_detil_grid->jumlahterima->getPlaceHolder()) ?>" value="<?php echo $gajisma_detil_grid->jumlahterima->EditValue ?>"<?php echo $gajisma_detil_grid->jumlahterima->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajisma_detil_jumlahterima" class="form-group gajisma_detil_jumlahterima">
<span<?php echo $gajisma_detil_grid->jumlahterima->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajisma_detil_grid->jumlahterima->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumlahterima" name="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" id="x<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" value="<?php echo HtmlEncode($gajisma_detil_grid->jumlahterima->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajisma_detil" data-field="x_jumlahterima" name="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" id="o<?php echo $gajisma_detil_grid->RowIndex ?>_jumlahterima" value="<?php echo HtmlEncode($gajisma_detil_grid->jumlahterima->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajisma_detil_grid->ListOptions->render("body", "right", $gajisma_detil_grid->RowIndex);
?>
<script>
loadjs.ready(["fgajisma_detilgrid", "load"], function() {
	fgajisma_detilgrid.updateLists(<?php echo $gajisma_detil_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($gajisma_detil->CurrentMode == "add" || $gajisma_detil->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $gajisma_detil_grid->FormKeyCountName ?>" id="<?php echo $gajisma_detil_grid->FormKeyCountName ?>" value="<?php echo $gajisma_detil_grid->KeyCount ?>">
<?php echo $gajisma_detil_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($gajisma_detil->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $gajisma_detil_grid->FormKeyCountName ?>" id="<?php echo $gajisma_detil_grid->FormKeyCountName ?>" value="<?php echo $gajisma_detil_grid->KeyCount ?>">
<?php echo $gajisma_detil_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($gajisma_detil->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fgajisma_detilgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gajisma_detil_grid->Recordset)
	$gajisma_detil_grid->Recordset->Close();
?>
<?php if ($gajisma_detil_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $gajisma_detil_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gajisma_detil_grid->TotalRecords == 0 && !$gajisma_detil->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gajisma_detil_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$gajisma_detil_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$gajisma_detil_grid->terminate();
?>