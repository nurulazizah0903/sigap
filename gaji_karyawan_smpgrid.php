<?php
namespace PHPMaker2020\sigap;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($gaji_karyawan_smp_grid))
	$gaji_karyawan_smp_grid = new gaji_karyawan_smp_grid();

// Run the page
$gaji_karyawan_smp_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_karyawan_smp_grid->Page_Render();
?>
<?php if (!$gaji_karyawan_smp_grid->isExport()) { ?>
<script>
var fgaji_karyawan_smpgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fgaji_karyawan_smpgrid = new ew.Form("fgaji_karyawan_smpgrid", "grid");
	fgaji_karyawan_smpgrid.formKeyCountName = '<?php echo $gaji_karyawan_smp_grid->FormKeyCountName ?>';

	// Validate form
	fgaji_karyawan_smpgrid.validate = function() {
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
			<?php if ($gaji_karyawan_smp_grid->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_karyawan_smp_grid->pegawai->caption(), $gaji_karyawan_smp_grid->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gaji_karyawan_smp_grid->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_karyawan_smp_grid->jenjang_id->caption(), $gaji_karyawan_smp_grid->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_karyawan_smp_grid->jenjang_id->errorMessage()) ?>");
			<?php if ($gaji_karyawan_smp_grid->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_karyawan_smp_grid->jabatan_id->caption(), $gaji_karyawan_smp_grid->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_karyawan_smp_grid->jabatan_id->errorMessage()) ?>");
			<?php if ($gaji_karyawan_smp_grid->kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_karyawan_smp_grid->kehadiran->caption(), $gaji_karyawan_smp_grid->kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_karyawan_smp_grid->kehadiran->errorMessage()) ?>");
			<?php if ($gaji_karyawan_smp_grid->gapok->Required) { ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_karyawan_smp_grid->gapok->caption(), $gaji_karyawan_smp_grid->gapok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_karyawan_smp_grid->gapok->errorMessage()) ?>");
			<?php if ($gaji_karyawan_smp_grid->value_reward->Required) { ?>
				elm = this.getElements("x" + infix + "_value_reward");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_karyawan_smp_grid->value_reward->caption(), $gaji_karyawan_smp_grid->value_reward->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_reward");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_karyawan_smp_grid->value_reward->errorMessage()) ?>");
			<?php if ($gaji_karyawan_smp_grid->value_inval->Required) { ?>
				elm = this.getElements("x" + infix + "_value_inval");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_karyawan_smp_grid->value_inval->caption(), $gaji_karyawan_smp_grid->value_inval->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_inval");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_karyawan_smp_grid->value_inval->errorMessage()) ?>");
			<?php if ($gaji_karyawan_smp_grid->sub_total->Required) { ?>
				elm = this.getElements("x" + infix + "_sub_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_karyawan_smp_grid->sub_total->caption(), $gaji_karyawan_smp_grid->sub_total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sub_total");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_karyawan_smp_grid->sub_total->errorMessage()) ?>");
			<?php if ($gaji_karyawan_smp_grid->potongan->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_karyawan_smp_grid->potongan->caption(), $gaji_karyawan_smp_grid->potongan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_karyawan_smp_grid->potongan->errorMessage()) ?>");
			<?php if ($gaji_karyawan_smp_grid->penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_karyawan_smp_grid->penyesuaian->caption(), $gaji_karyawan_smp_grid->penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_penyesuaian");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_karyawan_smp_grid->penyesuaian->errorMessage()) ?>");
			<?php if ($gaji_karyawan_smp_grid->total->Required) { ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_karyawan_smp_grid->total->caption(), $gaji_karyawan_smp_grid->total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_karyawan_smp_grid->total->errorMessage()) ?>");
			<?php if ($gaji_karyawan_smp_grid->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_karyawan_smp_grid->pid->caption(), $gaji_karyawan_smp_grid->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_karyawan_smp_grid->pid->errorMessage()) ?>");
			<?php if ($gaji_karyawan_smp_grid->jp->Required) { ?>
				elm = this.getElements("x" + infix + "_jp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_karyawan_smp_grid->jp->caption(), $gaji_karyawan_smp_grid->jp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_karyawan_smp_grid->jp->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fgaji_karyawan_smpgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pegawai", false)) return false;
		if (ew.valueChanged(fobj, infix, "jenjang_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "jabatan_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "kehadiran", false)) return false;
		if (ew.valueChanged(fobj, infix, "gapok", false)) return false;
		if (ew.valueChanged(fobj, infix, "value_reward", false)) return false;
		if (ew.valueChanged(fobj, infix, "value_inval", false)) return false;
		if (ew.valueChanged(fobj, infix, "sub_total", false)) return false;
		if (ew.valueChanged(fobj, infix, "potongan", false)) return false;
		if (ew.valueChanged(fobj, infix, "penyesuaian", false)) return false;
		if (ew.valueChanged(fobj, infix, "total", false)) return false;
		if (ew.valueChanged(fobj, infix, "pid", false)) return false;
		if (ew.valueChanged(fobj, infix, "jp", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fgaji_karyawan_smpgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgaji_karyawan_smpgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgaji_karyawan_smpgrid.lists["x_pegawai"] = <?php echo $gaji_karyawan_smp_grid->pegawai->Lookup->toClientList($gaji_karyawan_smp_grid) ?>;
	fgaji_karyawan_smpgrid.lists["x_pegawai"].options = <?php echo JsonEncode($gaji_karyawan_smp_grid->pegawai->lookupOptions()) ?>;
	fgaji_karyawan_smpgrid.lists["x_jenjang_id"] = <?php echo $gaji_karyawan_smp_grid->jenjang_id->Lookup->toClientList($gaji_karyawan_smp_grid) ?>;
	fgaji_karyawan_smpgrid.lists["x_jenjang_id"].options = <?php echo JsonEncode($gaji_karyawan_smp_grid->jenjang_id->lookupOptions()) ?>;
	fgaji_karyawan_smpgrid.autoSuggests["x_jenjang_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_karyawan_smpgrid.lists["x_jabatan_id"] = <?php echo $gaji_karyawan_smp_grid->jabatan_id->Lookup->toClientList($gaji_karyawan_smp_grid) ?>;
	fgaji_karyawan_smpgrid.lists["x_jabatan_id"].options = <?php echo JsonEncode($gaji_karyawan_smp_grid->jabatan_id->lookupOptions()) ?>;
	fgaji_karyawan_smpgrid.autoSuggests["x_jabatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgaji_karyawan_smpgrid");
});
</script>
<?php } ?>
<?php
$gaji_karyawan_smp_grid->renderOtherOptions();
?>
<?php if ($gaji_karyawan_smp_grid->TotalRecords > 0 || $gaji_karyawan_smp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gaji_karyawan_smp_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gaji_karyawan_smp">
<?php if ($gaji_karyawan_smp_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $gaji_karyawan_smp_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fgaji_karyawan_smpgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_gaji_karyawan_smp" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_gaji_karyawan_smpgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gaji_karyawan_smp->RowType = ROWTYPE_HEADER;

// Render list options
$gaji_karyawan_smp_grid->renderListOptions();

// Render list options (header, left)
$gaji_karyawan_smp_grid->ListOptions->render("header", "left");
?>
<?php if ($gaji_karyawan_smp_grid->pegawai->Visible) { // pegawai ?>
	<?php if ($gaji_karyawan_smp_grid->SortUrl($gaji_karyawan_smp_grid->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $gaji_karyawan_smp_grid->pegawai->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_pegawai" class="gaji_karyawan_smp_pegawai"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $gaji_karyawan_smp_grid->pegawai->headerCellClass() ?>"><div><div id="elh_gaji_karyawan_smp_pegawai" class="gaji_karyawan_smp_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_grid->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_grid->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_grid->jenjang_id->Visible) { // jenjang_id ?>
	<?php if ($gaji_karyawan_smp_grid->SortUrl($gaji_karyawan_smp_grid->jenjang_id) == "") { ?>
		<th data-name="jenjang_id" class="<?php echo $gaji_karyawan_smp_grid->jenjang_id->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_jenjang_id" class="gaji_karyawan_smp_jenjang_id"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->jenjang_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang_id" class="<?php echo $gaji_karyawan_smp_grid->jenjang_id->headerCellClass() ?>"><div><div id="elh_gaji_karyawan_smp_jenjang_id" class="gaji_karyawan_smp_jenjang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->jenjang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_grid->jenjang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_grid->jenjang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_grid->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($gaji_karyawan_smp_grid->SortUrl($gaji_karyawan_smp_grid->jabatan_id) == "") { ?>
		<th data-name="jabatan_id" class="<?php echo $gaji_karyawan_smp_grid->jabatan_id->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_jabatan_id" class="gaji_karyawan_smp_jabatan_id"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->jabatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan_id" class="<?php echo $gaji_karyawan_smp_grid->jabatan_id->headerCellClass() ?>"><div><div id="elh_gaji_karyawan_smp_jabatan_id" class="gaji_karyawan_smp_jabatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_grid->jabatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_grid->jabatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_grid->kehadiran->Visible) { // kehadiran ?>
	<?php if ($gaji_karyawan_smp_grid->SortUrl($gaji_karyawan_smp_grid->kehadiran) == "") { ?>
		<th data-name="kehadiran" class="<?php echo $gaji_karyawan_smp_grid->kehadiran->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_kehadiran" class="gaji_karyawan_smp_kehadiran"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->kehadiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kehadiran" class="<?php echo $gaji_karyawan_smp_grid->kehadiran->headerCellClass() ?>"><div><div id="elh_gaji_karyawan_smp_kehadiran" class="gaji_karyawan_smp_kehadiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_grid->kehadiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_grid->kehadiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_grid->gapok->Visible) { // gapok ?>
	<?php if ($gaji_karyawan_smp_grid->SortUrl($gaji_karyawan_smp_grid->gapok) == "") { ?>
		<th data-name="gapok" class="<?php echo $gaji_karyawan_smp_grid->gapok->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_gapok" class="gaji_karyawan_smp_gapok"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->gapok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gapok" class="<?php echo $gaji_karyawan_smp_grid->gapok->headerCellClass() ?>"><div><div id="elh_gaji_karyawan_smp_gapok" class="gaji_karyawan_smp_gapok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->gapok->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_grid->gapok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_grid->gapok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_grid->value_reward->Visible) { // value_reward ?>
	<?php if ($gaji_karyawan_smp_grid->SortUrl($gaji_karyawan_smp_grid->value_reward) == "") { ?>
		<th data-name="value_reward" class="<?php echo $gaji_karyawan_smp_grid->value_reward->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_value_reward" class="gaji_karyawan_smp_value_reward"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->value_reward->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_reward" class="<?php echo $gaji_karyawan_smp_grid->value_reward->headerCellClass() ?>"><div><div id="elh_gaji_karyawan_smp_value_reward" class="gaji_karyawan_smp_value_reward">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->value_reward->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_grid->value_reward->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_grid->value_reward->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_grid->value_inval->Visible) { // value_inval ?>
	<?php if ($gaji_karyawan_smp_grid->SortUrl($gaji_karyawan_smp_grid->value_inval) == "") { ?>
		<th data-name="value_inval" class="<?php echo $gaji_karyawan_smp_grid->value_inval->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_value_inval" class="gaji_karyawan_smp_value_inval"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->value_inval->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_inval" class="<?php echo $gaji_karyawan_smp_grid->value_inval->headerCellClass() ?>"><div><div id="elh_gaji_karyawan_smp_value_inval" class="gaji_karyawan_smp_value_inval">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->value_inval->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_grid->value_inval->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_grid->value_inval->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_grid->sub_total->Visible) { // sub_total ?>
	<?php if ($gaji_karyawan_smp_grid->SortUrl($gaji_karyawan_smp_grid->sub_total) == "") { ?>
		<th data-name="sub_total" class="<?php echo $gaji_karyawan_smp_grid->sub_total->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_sub_total" class="gaji_karyawan_smp_sub_total"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->sub_total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sub_total" class="<?php echo $gaji_karyawan_smp_grid->sub_total->headerCellClass() ?>"><div><div id="elh_gaji_karyawan_smp_sub_total" class="gaji_karyawan_smp_sub_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->sub_total->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_grid->sub_total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_grid->sub_total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_grid->potongan->Visible) { // potongan ?>
	<?php if ($gaji_karyawan_smp_grid->SortUrl($gaji_karyawan_smp_grid->potongan) == "") { ?>
		<th data-name="potongan" class="<?php echo $gaji_karyawan_smp_grid->potongan->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_potongan" class="gaji_karyawan_smp_potongan"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->potongan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan" class="<?php echo $gaji_karyawan_smp_grid->potongan->headerCellClass() ?>"><div><div id="elh_gaji_karyawan_smp_potongan" class="gaji_karyawan_smp_potongan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->potongan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_grid->potongan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_grid->potongan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_grid->penyesuaian->Visible) { // penyesuaian ?>
	<?php if ($gaji_karyawan_smp_grid->SortUrl($gaji_karyawan_smp_grid->penyesuaian) == "") { ?>
		<th data-name="penyesuaian" class="<?php echo $gaji_karyawan_smp_grid->penyesuaian->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_penyesuaian" class="gaji_karyawan_smp_penyesuaian"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="penyesuaian" class="<?php echo $gaji_karyawan_smp_grid->penyesuaian->headerCellClass() ?>"><div><div id="elh_gaji_karyawan_smp_penyesuaian" class="gaji_karyawan_smp_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_grid->penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_grid->penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_grid->total->Visible) { // total ?>
	<?php if ($gaji_karyawan_smp_grid->SortUrl($gaji_karyawan_smp_grid->total) == "") { ?>
		<th data-name="total" class="<?php echo $gaji_karyawan_smp_grid->total->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_total" class="gaji_karyawan_smp_total"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $gaji_karyawan_smp_grid->total->headerCellClass() ?>"><div><div id="elh_gaji_karyawan_smp_total" class="gaji_karyawan_smp_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_grid->total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_grid->total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_grid->pid->Visible) { // pid ?>
	<?php if ($gaji_karyawan_smp_grid->SortUrl($gaji_karyawan_smp_grid->pid) == "") { ?>
		<th data-name="pid" class="<?php echo $gaji_karyawan_smp_grid->pid->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_pid" class="gaji_karyawan_smp_pid"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->pid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid" class="<?php echo $gaji_karyawan_smp_grid->pid->headerCellClass() ?>"><div><div id="elh_gaji_karyawan_smp_pid" class="gaji_karyawan_smp_pid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_grid->pid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_grid->pid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp_grid->jp->Visible) { // jp ?>
	<?php if ($gaji_karyawan_smp_grid->SortUrl($gaji_karyawan_smp_grid->jp) == "") { ?>
		<th data-name="jp" class="<?php echo $gaji_karyawan_smp_grid->jp->headerCellClass() ?>"><div id="elh_gaji_karyawan_smp_jp" class="gaji_karyawan_smp_jp"><div class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->jp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jp" class="<?php echo $gaji_karyawan_smp_grid->jp->headerCellClass() ?>"><div><div id="elh_gaji_karyawan_smp_jp" class="gaji_karyawan_smp_jp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_karyawan_smp_grid->jp->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_karyawan_smp_grid->jp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_karyawan_smp_grid->jp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gaji_karyawan_smp_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$gaji_karyawan_smp_grid->StartRecord = 1;
$gaji_karyawan_smp_grid->StopRecord = $gaji_karyawan_smp_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($gaji_karyawan_smp->isConfirm() || $gaji_karyawan_smp_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($gaji_karyawan_smp_grid->FormKeyCountName) && ($gaji_karyawan_smp_grid->isGridAdd() || $gaji_karyawan_smp_grid->isGridEdit() || $gaji_karyawan_smp->isConfirm())) {
		$gaji_karyawan_smp_grid->KeyCount = $CurrentForm->getValue($gaji_karyawan_smp_grid->FormKeyCountName);
		$gaji_karyawan_smp_grid->StopRecord = $gaji_karyawan_smp_grid->StartRecord + $gaji_karyawan_smp_grid->KeyCount - 1;
	}
}
$gaji_karyawan_smp_grid->RecordCount = $gaji_karyawan_smp_grid->StartRecord - 1;
if ($gaji_karyawan_smp_grid->Recordset && !$gaji_karyawan_smp_grid->Recordset->EOF) {
	$gaji_karyawan_smp_grid->Recordset->moveFirst();
	$selectLimit = $gaji_karyawan_smp_grid->UseSelectLimit;
	if (!$selectLimit && $gaji_karyawan_smp_grid->StartRecord > 1)
		$gaji_karyawan_smp_grid->Recordset->move($gaji_karyawan_smp_grid->StartRecord - 1);
} elseif (!$gaji_karyawan_smp->AllowAddDeleteRow && $gaji_karyawan_smp_grid->StopRecord == 0) {
	$gaji_karyawan_smp_grid->StopRecord = $gaji_karyawan_smp->GridAddRowCount;
}

// Initialize aggregate
$gaji_karyawan_smp->RowType = ROWTYPE_AGGREGATEINIT;
$gaji_karyawan_smp->resetAttributes();
$gaji_karyawan_smp_grid->renderRow();
if ($gaji_karyawan_smp_grid->isGridAdd())
	$gaji_karyawan_smp_grid->RowIndex = 0;
if ($gaji_karyawan_smp_grid->isGridEdit())
	$gaji_karyawan_smp_grid->RowIndex = 0;
while ($gaji_karyawan_smp_grid->RecordCount < $gaji_karyawan_smp_grid->StopRecord) {
	$gaji_karyawan_smp_grid->RecordCount++;
	if ($gaji_karyawan_smp_grid->RecordCount >= $gaji_karyawan_smp_grid->StartRecord) {
		$gaji_karyawan_smp_grid->RowCount++;
		if ($gaji_karyawan_smp_grid->isGridAdd() || $gaji_karyawan_smp_grid->isGridEdit() || $gaji_karyawan_smp->isConfirm()) {
			$gaji_karyawan_smp_grid->RowIndex++;
			$CurrentForm->Index = $gaji_karyawan_smp_grid->RowIndex;
			if ($CurrentForm->hasValue($gaji_karyawan_smp_grid->FormActionName) && ($gaji_karyawan_smp->isConfirm() || $gaji_karyawan_smp_grid->EventCancelled))
				$gaji_karyawan_smp_grid->RowAction = strval($CurrentForm->getValue($gaji_karyawan_smp_grid->FormActionName));
			elseif ($gaji_karyawan_smp_grid->isGridAdd())
				$gaji_karyawan_smp_grid->RowAction = "insert";
			else
				$gaji_karyawan_smp_grid->RowAction = "";
		}

		// Set up key count
		$gaji_karyawan_smp_grid->KeyCount = $gaji_karyawan_smp_grid->RowIndex;

		// Init row class and style
		$gaji_karyawan_smp->resetAttributes();
		$gaji_karyawan_smp->CssClass = "";
		if ($gaji_karyawan_smp_grid->isGridAdd()) {
			if ($gaji_karyawan_smp->CurrentMode == "copy") {
				$gaji_karyawan_smp_grid->loadRowValues($gaji_karyawan_smp_grid->Recordset); // Load row values
				$gaji_karyawan_smp_grid->setRecordKey($gaji_karyawan_smp_grid->RowOldKey, $gaji_karyawan_smp_grid->Recordset); // Set old record key
			} else {
				$gaji_karyawan_smp_grid->loadRowValues(); // Load default values
				$gaji_karyawan_smp_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$gaji_karyawan_smp_grid->loadRowValues($gaji_karyawan_smp_grid->Recordset); // Load row values
		}
		$gaji_karyawan_smp->RowType = ROWTYPE_VIEW; // Render view
		if ($gaji_karyawan_smp_grid->isGridAdd()) // Grid add
			$gaji_karyawan_smp->RowType = ROWTYPE_ADD; // Render add
		if ($gaji_karyawan_smp_grid->isGridAdd() && $gaji_karyawan_smp->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$gaji_karyawan_smp_grid->restoreCurrentRowFormValues($gaji_karyawan_smp_grid->RowIndex); // Restore form values
		if ($gaji_karyawan_smp_grid->isGridEdit()) { // Grid edit
			if ($gaji_karyawan_smp->EventCancelled)
				$gaji_karyawan_smp_grid->restoreCurrentRowFormValues($gaji_karyawan_smp_grid->RowIndex); // Restore form values
			if ($gaji_karyawan_smp_grid->RowAction == "insert")
				$gaji_karyawan_smp->RowType = ROWTYPE_ADD; // Render add
			else
				$gaji_karyawan_smp->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($gaji_karyawan_smp_grid->isGridEdit() && ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT || $gaji_karyawan_smp->RowType == ROWTYPE_ADD) && $gaji_karyawan_smp->EventCancelled) // Update failed
			$gaji_karyawan_smp_grid->restoreCurrentRowFormValues($gaji_karyawan_smp_grid->RowIndex); // Restore form values
		if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT) // Edit row
			$gaji_karyawan_smp_grid->EditRowCount++;
		if ($gaji_karyawan_smp->isConfirm()) // Confirm row
			$gaji_karyawan_smp_grid->restoreCurrentRowFormValues($gaji_karyawan_smp_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$gaji_karyawan_smp->RowAttrs->merge(["data-rowindex" => $gaji_karyawan_smp_grid->RowCount, "id" => "r" . $gaji_karyawan_smp_grid->RowCount . "_gaji_karyawan_smp", "data-rowtype" => $gaji_karyawan_smp->RowType]);

		// Render row
		$gaji_karyawan_smp_grid->renderRow();

		// Render list options
		$gaji_karyawan_smp_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($gaji_karyawan_smp_grid->RowAction != "delete" && $gaji_karyawan_smp_grid->RowAction != "insertdelete" && !($gaji_karyawan_smp_grid->RowAction == "insert" && $gaji_karyawan_smp->isConfirm() && $gaji_karyawan_smp_grid->emptyRow())) {
?>
	<tr <?php echo $gaji_karyawan_smp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gaji_karyawan_smp_grid->ListOptions->render("body", "left", $gaji_karyawan_smp_grid->RowCount);
?>
	<?php if ($gaji_karyawan_smp_grid->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $gaji_karyawan_smp_grid->pegawai->cellAttributes() ?>>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_pegawai" class="form-group">
<?php $gaji_karyawan_smp_grid->pegawai->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai"><?php echo EmptyValue(strval($gaji_karyawan_smp_grid->pegawai->ViewValue)) ? $Language->phrase("PleaseSelect") : $gaji_karyawan_smp_grid->pegawai->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gaji_karyawan_smp_grid->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gaji_karyawan_smp_grid->pegawai->ReadOnly || $gaji_karyawan_smp_grid->pegawai->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gaji_karyawan_smp_grid->pegawai->Lookup->getParamTag($gaji_karyawan_smp_grid, "p_x" . $gaji_karyawan_smp_grid->RowIndex . "_pegawai") ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gaji_karyawan_smp_grid->pegawai->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" value="<?php echo $gaji_karyawan_smp_grid->pegawai->CurrentValue ?>"<?php echo $gaji_karyawan_smp_grid->pegawai->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pegawai" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pegawai->OldValue) ?>">
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_pegawai" class="form-group">
<?php $gaji_karyawan_smp_grid->pegawai->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai"><?php echo EmptyValue(strval($gaji_karyawan_smp_grid->pegawai->ViewValue)) ? $Language->phrase("PleaseSelect") : $gaji_karyawan_smp_grid->pegawai->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gaji_karyawan_smp_grid->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gaji_karyawan_smp_grid->pegawai->ReadOnly || $gaji_karyawan_smp_grid->pegawai->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gaji_karyawan_smp_grid->pegawai->Lookup->getParamTag($gaji_karyawan_smp_grid, "p_x" . $gaji_karyawan_smp_grid->RowIndex . "_pegawai") ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gaji_karyawan_smp_grid->pegawai->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" value="<?php echo $gaji_karyawan_smp_grid->pegawai->CurrentValue ?>"<?php echo $gaji_karyawan_smp_grid->pegawai->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_pegawai">
<span<?php echo $gaji_karyawan_smp_grid->pegawai->viewAttributes() ?>><?php echo $gaji_karyawan_smp_grid->pegawai->getViewValue() ?></span>
</span>
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pegawai" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pegawai->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pegawai" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pegawai->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pegawai" name="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" id="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pegawai->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pegawai" name="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" id="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pegawai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_id" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_id" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_id" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_id" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT || $gaji_karyawan_smp->CurrentMode == "edit") { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_id" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_id" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id" <?php echo $gaji_karyawan_smp_grid->jenjang_id->cellAttributes() ?>>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_jenjang_id" class="form-group">
<?php
$onchange = $gaji_karyawan_smp_grid->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_karyawan_smp_grid->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" id="sv_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" value="<?php echo RemoveHtml($gaji_karyawan_smp_grid->jenjang_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->getPlaceHolder()) ?>"<?php echo $gaji_karyawan_smp_grid->jenjang_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jenjang_id" data-value-separator="<?php echo $gaji_karyawan_smp_grid->jenjang_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_karyawan_smpgrid"], function() {
	fgaji_karyawan_smpgrid.createAutoSuggest({"id":"x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id","forceSelect":false});
});
</script>
<?php echo $gaji_karyawan_smp_grid->jenjang_id->Lookup->getParamTag($gaji_karyawan_smp_grid, "p_x" . $gaji_karyawan_smp_grid->RowIndex . "_jenjang_id") ?>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jenjang_id" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->OldValue) ?>">
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_jenjang_id" class="form-group">
<?php
$onchange = $gaji_karyawan_smp_grid->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_karyawan_smp_grid->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" id="sv_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" value="<?php echo RemoveHtml($gaji_karyawan_smp_grid->jenjang_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->getPlaceHolder()) ?>"<?php echo $gaji_karyawan_smp_grid->jenjang_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jenjang_id" data-value-separator="<?php echo $gaji_karyawan_smp_grid->jenjang_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_karyawan_smpgrid"], function() {
	fgaji_karyawan_smpgrid.createAutoSuggest({"id":"x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id","forceSelect":false});
});
</script>
<?php echo $gaji_karyawan_smp_grid->jenjang_id->Lookup->getParamTag($gaji_karyawan_smp_grid, "p_x" . $gaji_karyawan_smp_grid->RowIndex . "_jenjang_id") ?>
</span>
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_jenjang_id">
<span<?php echo $gaji_karyawan_smp_grid->jenjang_id->viewAttributes() ?>><?php echo $gaji_karyawan_smp_grid->jenjang_id->getViewValue() ?></span>
</span>
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jenjang_id" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jenjang_id" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jenjang_id" name="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" id="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jenjang_id" name="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" id="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id" <?php echo $gaji_karyawan_smp_grid->jabatan_id->cellAttributes() ?>>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_jabatan_id" class="form-group">
<?php
$onchange = $gaji_karyawan_smp_grid->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_karyawan_smp_grid->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" id="sv_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" value="<?php echo RemoveHtml($gaji_karyawan_smp_grid->jabatan_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->getPlaceHolder()) ?>"<?php echo $gaji_karyawan_smp_grid->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jabatan_id" data-value-separator="<?php echo $gaji_karyawan_smp_grid->jabatan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_karyawan_smpgrid"], function() {
	fgaji_karyawan_smpgrid.createAutoSuggest({"id":"x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gaji_karyawan_smp_grid->jabatan_id->Lookup->getParamTag($gaji_karyawan_smp_grid, "p_x" . $gaji_karyawan_smp_grid->RowIndex . "_jabatan_id") ?>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jabatan_id" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->OldValue) ?>">
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_jabatan_id" class="form-group">
<?php
$onchange = $gaji_karyawan_smp_grid->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_karyawan_smp_grid->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" id="sv_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" value="<?php echo RemoveHtml($gaji_karyawan_smp_grid->jabatan_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->getPlaceHolder()) ?>"<?php echo $gaji_karyawan_smp_grid->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jabatan_id" data-value-separator="<?php echo $gaji_karyawan_smp_grid->jabatan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_karyawan_smpgrid"], function() {
	fgaji_karyawan_smpgrid.createAutoSuggest({"id":"x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gaji_karyawan_smp_grid->jabatan_id->Lookup->getParamTag($gaji_karyawan_smp_grid, "p_x" . $gaji_karyawan_smp_grid->RowIndex . "_jabatan_id") ?>
</span>
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_jabatan_id">
<span<?php echo $gaji_karyawan_smp_grid->jabatan_id->viewAttributes() ?>><?php echo $gaji_karyawan_smp_grid->jabatan_id->getViewValue() ?></span>
</span>
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jabatan_id" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jabatan_id" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jabatan_id" name="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" id="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jabatan_id" name="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" id="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran" <?php echo $gaji_karyawan_smp_grid->kehadiran->cellAttributes() ?>>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_kehadiran" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_kehadiran" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->kehadiran->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->kehadiran->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_kehadiran" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->kehadiran->OldValue) ?>">
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_kehadiran" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_kehadiran" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->kehadiran->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->kehadiran->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_kehadiran">
<span<?php echo $gaji_karyawan_smp_grid->kehadiran->viewAttributes() ?>><?php echo $gaji_karyawan_smp_grid->kehadiran->getViewValue() ?></span>
</span>
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_kehadiran" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->kehadiran->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_kehadiran" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->kehadiran->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_kehadiran" name="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" id="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->kehadiran->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_kehadiran" name="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" id="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->kehadiran->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->gapok->Visible) { // gapok ?>
		<td data-name="gapok" <?php echo $gaji_karyawan_smp_grid->gapok->cellAttributes() ?>>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_gapok" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_gapok" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->gapok->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->gapok->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_gapok" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->gapok->OldValue) ?>">
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_gapok" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_gapok" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->gapok->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->gapok->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_gapok">
<span<?php echo $gaji_karyawan_smp_grid->gapok->viewAttributes() ?>><?php echo $gaji_karyawan_smp_grid->gapok->getViewValue() ?></span>
</span>
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_gapok" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->gapok->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_gapok" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->gapok->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_gapok" name="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" id="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->gapok->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_gapok" name="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" id="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->gapok->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->value_reward->Visible) { // value_reward ?>
		<td data-name="value_reward" <?php echo $gaji_karyawan_smp_grid->value_reward->cellAttributes() ?>>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_value_reward" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_value_reward" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_reward->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->value_reward->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->value_reward->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_value_reward" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_reward->OldValue) ?>">
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_value_reward" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_value_reward" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_reward->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->value_reward->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->value_reward->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_value_reward">
<span<?php echo $gaji_karyawan_smp_grid->value_reward->viewAttributes() ?>><?php echo $gaji_karyawan_smp_grid->value_reward->getViewValue() ?></span>
</span>
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_value_reward" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_reward->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_value_reward" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_reward->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_value_reward" name="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" id="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_reward->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_value_reward" name="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" id="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_reward->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->value_inval->Visible) { // value_inval ?>
		<td data-name="value_inval" <?php echo $gaji_karyawan_smp_grid->value_inval->cellAttributes() ?>>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_value_inval" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_value_inval" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_inval->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->value_inval->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->value_inval->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_value_inval" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_inval->OldValue) ?>">
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_value_inval" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_value_inval" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_inval->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->value_inval->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->value_inval->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_value_inval">
<span<?php echo $gaji_karyawan_smp_grid->value_inval->viewAttributes() ?>><?php echo $gaji_karyawan_smp_grid->value_inval->getViewValue() ?></span>
</span>
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_value_inval" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_inval->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_value_inval" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_inval->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_value_inval" name="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" id="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_inval->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_value_inval" name="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" id="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_inval->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->sub_total->Visible) { // sub_total ?>
		<td data-name="sub_total" <?php echo $gaji_karyawan_smp_grid->sub_total->cellAttributes() ?>>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_sub_total" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_sub_total" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->sub_total->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->sub_total->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->sub_total->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_sub_total" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->sub_total->OldValue) ?>">
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_sub_total" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_sub_total" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->sub_total->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->sub_total->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->sub_total->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_sub_total">
<span<?php echo $gaji_karyawan_smp_grid->sub_total->viewAttributes() ?>><?php echo $gaji_karyawan_smp_grid->sub_total->getViewValue() ?></span>
</span>
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_sub_total" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->sub_total->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_sub_total" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->sub_total->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_sub_total" name="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" id="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->sub_total->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_sub_total" name="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" id="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->sub_total->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->potongan->Visible) { // potongan ?>
		<td data-name="potongan" <?php echo $gaji_karyawan_smp_grid->potongan->cellAttributes() ?>>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_potongan" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_potongan" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->potongan->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->potongan->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->potongan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_potongan" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->potongan->OldValue) ?>">
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_potongan" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_potongan" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->potongan->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->potongan->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->potongan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_potongan">
<span<?php echo $gaji_karyawan_smp_grid->potongan->viewAttributes() ?>><?php echo $gaji_karyawan_smp_grid->potongan->getViewValue() ?></span>
</span>
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_potongan" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->potongan->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_potongan" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->potongan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_potongan" name="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" id="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->potongan->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_potongan" name="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" id="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->potongan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->penyesuaian->Visible) { // penyesuaian ?>
		<td data-name="penyesuaian" <?php echo $gaji_karyawan_smp_grid->penyesuaian->cellAttributes() ?>>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_penyesuaian" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_penyesuaian" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->penyesuaian->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->penyesuaian->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->penyesuaian->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_penyesuaian" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->penyesuaian->OldValue) ?>">
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_penyesuaian" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_penyesuaian" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->penyesuaian->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->penyesuaian->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->penyesuaian->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_penyesuaian">
<span<?php echo $gaji_karyawan_smp_grid->penyesuaian->viewAttributes() ?>><?php echo $gaji_karyawan_smp_grid->penyesuaian->getViewValue() ?></span>
</span>
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_penyesuaian" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->penyesuaian->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_penyesuaian" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->penyesuaian->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_penyesuaian" name="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" id="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->penyesuaian->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_penyesuaian" name="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" id="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->penyesuaian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->total->Visible) { // total ?>
		<td data-name="total" <?php echo $gaji_karyawan_smp_grid->total->cellAttributes() ?>>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_total" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_total" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->total->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->total->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->total->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_total" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->total->OldValue) ?>">
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_total" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_total" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->total->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->total->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->total->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_total">
<span<?php echo $gaji_karyawan_smp_grid->total->viewAttributes() ?>><?php echo $gaji_karyawan_smp_grid->total->getViewValue() ?></span>
</span>
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_total" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->total->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_total" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->total->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_total" name="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" id="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->total->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_total" name="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" id="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->total->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->pid->Visible) { // pid ?>
		<td data-name="pid" <?php echo $gaji_karyawan_smp_grid->pid->cellAttributes() ?>>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($gaji_karyawan_smp_grid->pid->getSessionValue() != "") { ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_pid" class="form-group">
<span<?php echo $gaji_karyawan_smp_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_pid" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_pid" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pid->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->pid->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pid" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pid->OldValue) ?>">
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($gaji_karyawan_smp_grid->pid->getSessionValue() != "") { ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_pid" class="form-group">
<span<?php echo $gaji_karyawan_smp_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_pid" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_pid" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pid->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->pid->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_pid">
<span<?php echo $gaji_karyawan_smp_grid->pid->viewAttributes() ?>><?php echo $gaji_karyawan_smp_grid->pid->getViewValue() ?></span>
</span>
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pid" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pid->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pid" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pid" name="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" id="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pid->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pid" name="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" id="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->jp->Visible) { // jp ?>
		<td data-name="jp" <?php echo $gaji_karyawan_smp_grid->jp->cellAttributes() ?>>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_jp" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_jp" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jp->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->jp->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->jp->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jp" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jp->OldValue) ?>">
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_jp" class="form-group">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_jp" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jp->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->jp->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->jp->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_karyawan_smp_grid->RowCount ?>_gaji_karyawan_smp_jp">
<span<?php echo $gaji_karyawan_smp_grid->jp->viewAttributes() ?>><?php echo $gaji_karyawan_smp_grid->jp->getViewValue() ?></span>
</span>
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jp" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jp->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jp" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jp" name="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" id="fgaji_karyawan_smpgrid$x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jp->FormValue) ?>">
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jp" name="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" id="fgaji_karyawan_smpgrid$o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gaji_karyawan_smp_grid->ListOptions->render("body", "right", $gaji_karyawan_smp_grid->RowCount);
?>
	</tr>
<?php if ($gaji_karyawan_smp->RowType == ROWTYPE_ADD || $gaji_karyawan_smp->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fgaji_karyawan_smpgrid", "load"], function() {
	fgaji_karyawan_smpgrid.updateLists(<?php echo $gaji_karyawan_smp_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$gaji_karyawan_smp_grid->isGridAdd() || $gaji_karyawan_smp->CurrentMode == "copy")
		if (!$gaji_karyawan_smp_grid->Recordset->EOF)
			$gaji_karyawan_smp_grid->Recordset->moveNext();
}
?>
<?php
	if ($gaji_karyawan_smp->CurrentMode == "add" || $gaji_karyawan_smp->CurrentMode == "copy" || $gaji_karyawan_smp->CurrentMode == "edit") {
		$gaji_karyawan_smp_grid->RowIndex = '$rowindex$';
		$gaji_karyawan_smp_grid->loadRowValues();

		// Set row properties
		$gaji_karyawan_smp->resetAttributes();
		$gaji_karyawan_smp->RowAttrs->merge(["data-rowindex" => $gaji_karyawan_smp_grid->RowIndex, "id" => "r0_gaji_karyawan_smp", "data-rowtype" => ROWTYPE_ADD]);
		$gaji_karyawan_smp->RowAttrs->appendClass("ew-template");
		$gaji_karyawan_smp->RowType = ROWTYPE_ADD;

		// Render row
		$gaji_karyawan_smp_grid->renderRow();

		// Render list options
		$gaji_karyawan_smp_grid->renderListOptions();
		$gaji_karyawan_smp_grid->StartRowCount = 0;
?>
	<tr <?php echo $gaji_karyawan_smp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gaji_karyawan_smp_grid->ListOptions->render("body", "left", $gaji_karyawan_smp_grid->RowIndex);
?>
	<?php if ($gaji_karyawan_smp_grid->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai">
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<span id="el$rowindex$_gaji_karyawan_smp_pegawai" class="form-group gaji_karyawan_smp_pegawai">
<?php $gaji_karyawan_smp_grid->pegawai->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai"><?php echo EmptyValue(strval($gaji_karyawan_smp_grid->pegawai->ViewValue)) ? $Language->phrase("PleaseSelect") : $gaji_karyawan_smp_grid->pegawai->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gaji_karyawan_smp_grid->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gaji_karyawan_smp_grid->pegawai->ReadOnly || $gaji_karyawan_smp_grid->pegawai->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gaji_karyawan_smp_grid->pegawai->Lookup->getParamTag($gaji_karyawan_smp_grid, "p_x" . $gaji_karyawan_smp_grid->RowIndex . "_pegawai") ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gaji_karyawan_smp_grid->pegawai->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" value="<?php echo $gaji_karyawan_smp_grid->pegawai->CurrentValue ?>"<?php echo $gaji_karyawan_smp_grid->pegawai->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_karyawan_smp_pegawai" class="form-group gaji_karyawan_smp_pegawai">
<span<?php echo $gaji_karyawan_smp_grid->pegawai->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->pegawai->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pegawai" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pegawai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pegawai" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pegawai->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id">
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<span id="el$rowindex$_gaji_karyawan_smp_jenjang_id" class="form-group gaji_karyawan_smp_jenjang_id">
<?php
$onchange = $gaji_karyawan_smp_grid->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_karyawan_smp_grid->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" id="sv_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" value="<?php echo RemoveHtml($gaji_karyawan_smp_grid->jenjang_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->getPlaceHolder()) ?>"<?php echo $gaji_karyawan_smp_grid->jenjang_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jenjang_id" data-value-separator="<?php echo $gaji_karyawan_smp_grid->jenjang_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_karyawan_smpgrid"], function() {
	fgaji_karyawan_smpgrid.createAutoSuggest({"id":"x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id","forceSelect":false});
});
</script>
<?php echo $gaji_karyawan_smp_grid->jenjang_id->Lookup->getParamTag($gaji_karyawan_smp_grid, "p_x" . $gaji_karyawan_smp_grid->RowIndex . "_jenjang_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_karyawan_smp_jenjang_id" class="form-group gaji_karyawan_smp_jenjang_id">
<span<?php echo $gaji_karyawan_smp_grid->jenjang_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->jenjang_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jenjang_id" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jenjang_id" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jenjang_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id">
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<span id="el$rowindex$_gaji_karyawan_smp_jabatan_id" class="form-group gaji_karyawan_smp_jabatan_id">
<?php
$onchange = $gaji_karyawan_smp_grid->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_karyawan_smp_grid->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" id="sv_x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" value="<?php echo RemoveHtml($gaji_karyawan_smp_grid->jabatan_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->getPlaceHolder()) ?>"<?php echo $gaji_karyawan_smp_grid->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jabatan_id" data-value-separator="<?php echo $gaji_karyawan_smp_grid->jabatan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_karyawan_smpgrid"], function() {
	fgaji_karyawan_smpgrid.createAutoSuggest({"id":"x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gaji_karyawan_smp_grid->jabatan_id->Lookup->getParamTag($gaji_karyawan_smp_grid, "p_x" . $gaji_karyawan_smp_grid->RowIndex . "_jabatan_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_karyawan_smp_jabatan_id" class="form-group gaji_karyawan_smp_jabatan_id">
<span<?php echo $gaji_karyawan_smp_grid->jabatan_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->jabatan_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jabatan_id" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jabatan_id" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jabatan_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran">
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<span id="el$rowindex$_gaji_karyawan_smp_kehadiran" class="form-group gaji_karyawan_smp_kehadiran">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_kehadiran" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->kehadiran->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->kehadiran->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_karyawan_smp_kehadiran" class="form-group gaji_karyawan_smp_kehadiran">
<span<?php echo $gaji_karyawan_smp_grid->kehadiran->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->kehadiran->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_kehadiran" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->kehadiran->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_kehadiran" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->kehadiran->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->gapok->Visible) { // gapok ?>
		<td data-name="gapok">
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<span id="el$rowindex$_gaji_karyawan_smp_gapok" class="form-group gaji_karyawan_smp_gapok">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_gapok" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->gapok->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->gapok->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_karyawan_smp_gapok" class="form-group gaji_karyawan_smp_gapok">
<span<?php echo $gaji_karyawan_smp_grid->gapok->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->gapok->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_gapok" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->gapok->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_gapok" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->gapok->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->value_reward->Visible) { // value_reward ?>
		<td data-name="value_reward">
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<span id="el$rowindex$_gaji_karyawan_smp_value_reward" class="form-group gaji_karyawan_smp_value_reward">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_value_reward" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_reward->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->value_reward->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->value_reward->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_karyawan_smp_value_reward" class="form-group gaji_karyawan_smp_value_reward">
<span<?php echo $gaji_karyawan_smp_grid->value_reward->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->value_reward->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_value_reward" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_reward->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_value_reward" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_reward->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->value_inval->Visible) { // value_inval ?>
		<td data-name="value_inval">
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<span id="el$rowindex$_gaji_karyawan_smp_value_inval" class="form-group gaji_karyawan_smp_value_inval">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_value_inval" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_inval->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->value_inval->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->value_inval->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_karyawan_smp_value_inval" class="form-group gaji_karyawan_smp_value_inval">
<span<?php echo $gaji_karyawan_smp_grid->value_inval->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->value_inval->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_value_inval" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_inval->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_value_inval" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->value_inval->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->sub_total->Visible) { // sub_total ?>
		<td data-name="sub_total">
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<span id="el$rowindex$_gaji_karyawan_smp_sub_total" class="form-group gaji_karyawan_smp_sub_total">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_sub_total" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->sub_total->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->sub_total->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->sub_total->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_karyawan_smp_sub_total" class="form-group gaji_karyawan_smp_sub_total">
<span<?php echo $gaji_karyawan_smp_grid->sub_total->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->sub_total->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_sub_total" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->sub_total->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_sub_total" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->sub_total->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->potongan->Visible) { // potongan ?>
		<td data-name="potongan">
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<span id="el$rowindex$_gaji_karyawan_smp_potongan" class="form-group gaji_karyawan_smp_potongan">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_potongan" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->potongan->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->potongan->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->potongan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_karyawan_smp_potongan" class="form-group gaji_karyawan_smp_potongan">
<span<?php echo $gaji_karyawan_smp_grid->potongan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->potongan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_potongan" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->potongan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_potongan" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->potongan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->penyesuaian->Visible) { // penyesuaian ?>
		<td data-name="penyesuaian">
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<span id="el$rowindex$_gaji_karyawan_smp_penyesuaian" class="form-group gaji_karyawan_smp_penyesuaian">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_penyesuaian" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->penyesuaian->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->penyesuaian->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->penyesuaian->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_karyawan_smp_penyesuaian" class="form-group gaji_karyawan_smp_penyesuaian">
<span<?php echo $gaji_karyawan_smp_grid->penyesuaian->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->penyesuaian->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_penyesuaian" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->penyesuaian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_penyesuaian" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->penyesuaian->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->total->Visible) { // total ?>
		<td data-name="total">
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<span id="el$rowindex$_gaji_karyawan_smp_total" class="form-group gaji_karyawan_smp_total">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_total" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->total->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->total->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->total->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_karyawan_smp_total" class="form-group gaji_karyawan_smp_total">
<span<?php echo $gaji_karyawan_smp_grid->total->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->total->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_total" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->total->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_total" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->total->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->pid->Visible) { // pid ?>
		<td data-name="pid">
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<?php if ($gaji_karyawan_smp_grid->pid->getSessionValue() != "") { ?>
<span id="el$rowindex$_gaji_karyawan_smp_pid" class="form-group gaji_karyawan_smp_pid">
<span<?php echo $gaji_karyawan_smp_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_gaji_karyawan_smp_pid" class="form-group gaji_karyawan_smp_pid">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_pid" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pid->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->pid->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_gaji_karyawan_smp_pid" class="form-group gaji_karyawan_smp_pid">
<span<?php echo $gaji_karyawan_smp_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pid" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_pid" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->pid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_karyawan_smp_grid->jp->Visible) { // jp ?>
		<td data-name="jp">
<?php if (!$gaji_karyawan_smp->isConfirm()) { ?>
<span id="el$rowindex$_gaji_karyawan_smp_jp" class="form-group gaji_karyawan_smp_jp">
<input type="text" data-table="gaji_karyawan_smp" data-field="x_jp" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jp->getPlaceHolder()) ?>" value="<?php echo $gaji_karyawan_smp_grid->jp->EditValue ?>"<?php echo $gaji_karyawan_smp_grid->jp->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_karyawan_smp_jp" class="form-group gaji_karyawan_smp_jp">
<span<?php echo $gaji_karyawan_smp_grid->jp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_karyawan_smp_grid->jp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jp" name="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" id="x<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_karyawan_smp" data-field="x_jp" name="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" id="o<?php echo $gaji_karyawan_smp_grid->RowIndex ?>_jp" value="<?php echo HtmlEncode($gaji_karyawan_smp_grid->jp->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gaji_karyawan_smp_grid->ListOptions->render("body", "right", $gaji_karyawan_smp_grid->RowIndex);
?>
<script>
loadjs.ready(["fgaji_karyawan_smpgrid", "load"], function() {
	fgaji_karyawan_smpgrid.updateLists(<?php echo $gaji_karyawan_smp_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($gaji_karyawan_smp->CurrentMode == "add" || $gaji_karyawan_smp->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $gaji_karyawan_smp_grid->FormKeyCountName ?>" id="<?php echo $gaji_karyawan_smp_grid->FormKeyCountName ?>" value="<?php echo $gaji_karyawan_smp_grid->KeyCount ?>">
<?php echo $gaji_karyawan_smp_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($gaji_karyawan_smp->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $gaji_karyawan_smp_grid->FormKeyCountName ?>" id="<?php echo $gaji_karyawan_smp_grid->FormKeyCountName ?>" value="<?php echo $gaji_karyawan_smp_grid->KeyCount ?>">
<?php echo $gaji_karyawan_smp_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($gaji_karyawan_smp->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fgaji_karyawan_smpgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gaji_karyawan_smp_grid->Recordset)
	$gaji_karyawan_smp_grid->Recordset->Close();
?>
<?php if ($gaji_karyawan_smp_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $gaji_karyawan_smp_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gaji_karyawan_smp_grid->TotalRecords == 0 && !$gaji_karyawan_smp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gaji_karyawan_smp_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$gaji_karyawan_smp_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$gaji_karyawan_smp_grid->terminate();
?>