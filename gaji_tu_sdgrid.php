<?php
namespace PHPMaker2020\sigap;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($gaji_tu_sd_grid))
	$gaji_tu_sd_grid = new gaji_tu_sd_grid();

// Run the page
$gaji_tu_sd_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_tu_sd_grid->Page_Render();
?>
<?php if (!$gaji_tu_sd_grid->isExport()) { ?>
<script>
var fgaji_tu_sdgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fgaji_tu_sdgrid = new ew.Form("fgaji_tu_sdgrid", "grid");
	fgaji_tu_sdgrid.formKeyCountName = '<?php echo $gaji_tu_sd_grid->FormKeyCountName ?>';

	// Validate form
	fgaji_tu_sdgrid.validate = function() {
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
			<?php if ($gaji_tu_sd_grid->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->pegawai->caption(), $gaji_tu_sd_grid->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gaji_tu_sd_grid->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->jenjang_id->caption(), $gaji_tu_sd_grid->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->jenjang_id->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->jabatan_id->caption(), $gaji_tu_sd_grid->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->jabatan_id->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->type_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_type_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->type_jabatan->caption(), $gaji_tu_sd_grid->type_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_type_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->type_jabatan->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->tambahan->Required) { ?>
				elm = this.getElements("x" + infix + "_tambahan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->tambahan->caption(), $gaji_tu_sd_grid->tambahan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tambahan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->tambahan->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->gapok->Required) { ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->gapok->caption(), $gaji_tu_sd_grid->gapok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->gapok->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->ijasah->Required) { ?>
				elm = this.getElements("x" + infix + "_ijasah");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->ijasah->caption(), $gaji_tu_sd_grid->ijasah->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ijasah");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->ijasah->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->kehadiran->caption(), $gaji_tu_sd_grid->kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->kehadiran->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->lembur->caption(), $gaji_tu_sd_grid->lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->lembur->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->value_lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_value_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->value_lembur->caption(), $gaji_tu_sd_grid->value_lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_lembur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->value_lembur->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->value_reward->Required) { ?>
				elm = this.getElements("x" + infix + "_value_reward");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->value_reward->caption(), $gaji_tu_sd_grid->value_reward->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_reward");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->value_reward->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->value_inval->Required) { ?>
				elm = this.getElements("x" + infix + "_value_inval");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->value_inval->caption(), $gaji_tu_sd_grid->value_inval->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_inval");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->value_inval->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->piket_count->Required) { ?>
				elm = this.getElements("x" + infix + "_piket_count");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->piket_count->caption(), $gaji_tu_sd_grid->piket_count->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_piket_count");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->piket_count->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->value_piket->Required) { ?>
				elm = this.getElements("x" + infix + "_value_piket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->value_piket->caption(), $gaji_tu_sd_grid->value_piket->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_piket");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->value_piket->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->tugastambahan->Required) { ?>
				elm = this.getElements("x" + infix + "_tugastambahan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->tugastambahan->caption(), $gaji_tu_sd_grid->tugastambahan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tugastambahan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->tugastambahan->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->tj_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_tj_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->tj_jabatan->caption(), $gaji_tu_sd_grid->tj_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tj_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->tj_jabatan->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->tunjangan2->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->tunjangan2->caption(), $gaji_tu_sd_grid->tunjangan2->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan2");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->tunjangan2->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->potongan->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->potongan->caption(), $gaji_tu_sd_grid->potongan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->potongan->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->sub_total->Required) { ?>
				elm = this.getElements("x" + infix + "_sub_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->sub_total->caption(), $gaji_tu_sd_grid->sub_total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sub_total");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->sub_total->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->penyesuaian->caption(), $gaji_tu_sd_grid->penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_penyesuaian");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->penyesuaian->errorMessage()) ?>");
			<?php if ($gaji_tu_sd_grid->total->Required) { ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_tu_sd_grid->total->caption(), $gaji_tu_sd_grid->total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_tu_sd_grid->total->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fgaji_tu_sdgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pegawai", false)) return false;
		if (ew.valueChanged(fobj, infix, "jenjang_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "jabatan_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "type_jabatan", false)) return false;
		if (ew.valueChanged(fobj, infix, "tambahan", false)) return false;
		if (ew.valueChanged(fobj, infix, "gapok", false)) return false;
		if (ew.valueChanged(fobj, infix, "ijasah", false)) return false;
		if (ew.valueChanged(fobj, infix, "kehadiran", false)) return false;
		if (ew.valueChanged(fobj, infix, "lembur", false)) return false;
		if (ew.valueChanged(fobj, infix, "value_lembur", false)) return false;
		if (ew.valueChanged(fobj, infix, "value_reward", false)) return false;
		if (ew.valueChanged(fobj, infix, "value_inval", false)) return false;
		if (ew.valueChanged(fobj, infix, "piket_count", false)) return false;
		if (ew.valueChanged(fobj, infix, "value_piket", false)) return false;
		if (ew.valueChanged(fobj, infix, "tugastambahan", false)) return false;
		if (ew.valueChanged(fobj, infix, "tj_jabatan", false)) return false;
		if (ew.valueChanged(fobj, infix, "tunjangan2", false)) return false;
		if (ew.valueChanged(fobj, infix, "potongan", false)) return false;
		if (ew.valueChanged(fobj, infix, "sub_total", false)) return false;
		if (ew.valueChanged(fobj, infix, "penyesuaian", false)) return false;
		if (ew.valueChanged(fobj, infix, "total", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fgaji_tu_sdgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgaji_tu_sdgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgaji_tu_sdgrid.lists["x_pegawai"] = <?php echo $gaji_tu_sd_grid->pegawai->Lookup->toClientList($gaji_tu_sd_grid) ?>;
	fgaji_tu_sdgrid.lists["x_pegawai"].options = <?php echo JsonEncode($gaji_tu_sd_grid->pegawai->lookupOptions()) ?>;
	fgaji_tu_sdgrid.lists["x_jenjang_id"] = <?php echo $gaji_tu_sd_grid->jenjang_id->Lookup->toClientList($gaji_tu_sd_grid) ?>;
	fgaji_tu_sdgrid.lists["x_jenjang_id"].options = <?php echo JsonEncode($gaji_tu_sd_grid->jenjang_id->lookupOptions()) ?>;
	fgaji_tu_sdgrid.autoSuggests["x_jenjang_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_tu_sdgrid.lists["x_jabatan_id"] = <?php echo $gaji_tu_sd_grid->jabatan_id->Lookup->toClientList($gaji_tu_sd_grid) ?>;
	fgaji_tu_sdgrid.lists["x_jabatan_id"].options = <?php echo JsonEncode($gaji_tu_sd_grid->jabatan_id->lookupOptions()) ?>;
	fgaji_tu_sdgrid.autoSuggests["x_jabatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_tu_sdgrid.lists["x_type_jabatan"] = <?php echo $gaji_tu_sd_grid->type_jabatan->Lookup->toClientList($gaji_tu_sd_grid) ?>;
	fgaji_tu_sdgrid.lists["x_type_jabatan"].options = <?php echo JsonEncode($gaji_tu_sd_grid->type_jabatan->lookupOptions()) ?>;
	fgaji_tu_sdgrid.autoSuggests["x_type_jabatan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgaji_tu_sdgrid.lists["x_tambahan"] = <?php echo $gaji_tu_sd_grid->tambahan->Lookup->toClientList($gaji_tu_sd_grid) ?>;
	fgaji_tu_sdgrid.lists["x_tambahan"].options = <?php echo JsonEncode($gaji_tu_sd_grid->tambahan->lookupOptions()) ?>;
	fgaji_tu_sdgrid.autoSuggests["x_tambahan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgaji_tu_sdgrid");
});
</script>
<?php } ?>
<?php
$gaji_tu_sd_grid->renderOtherOptions();
?>
<?php if ($gaji_tu_sd_grid->TotalRecords > 0 || $gaji_tu_sd->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gaji_tu_sd_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gaji_tu_sd">
<?php if ($gaji_tu_sd_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $gaji_tu_sd_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fgaji_tu_sdgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_gaji_tu_sd" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_gaji_tu_sdgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gaji_tu_sd->RowType = ROWTYPE_HEADER;

// Render list options
$gaji_tu_sd_grid->renderListOptions();

// Render list options (header, left)
$gaji_tu_sd_grid->ListOptions->render("header", "left");
?>
<?php if ($gaji_tu_sd_grid->pegawai->Visible) { // pegawai ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $gaji_tu_sd_grid->pegawai->headerCellClass() ?>"><div id="elh_gaji_tu_sd_pegawai" class="gaji_tu_sd_pegawai"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $gaji_tu_sd_grid->pegawai->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_pegawai" class="gaji_tu_sd_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->jenjang_id->Visible) { // jenjang_id ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->jenjang_id) == "") { ?>
		<th data-name="jenjang_id" class="<?php echo $gaji_tu_sd_grid->jenjang_id->headerCellClass() ?>"><div id="elh_gaji_tu_sd_jenjang_id" class="gaji_tu_sd_jenjang_id"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->jenjang_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang_id" class="<?php echo $gaji_tu_sd_grid->jenjang_id->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_jenjang_id" class="gaji_tu_sd_jenjang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->jenjang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->jenjang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->jenjang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->jabatan_id) == "") { ?>
		<th data-name="jabatan_id" class="<?php echo $gaji_tu_sd_grid->jabatan_id->headerCellClass() ?>"><div id="elh_gaji_tu_sd_jabatan_id" class="gaji_tu_sd_jabatan_id"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->jabatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan_id" class="<?php echo $gaji_tu_sd_grid->jabatan_id->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_jabatan_id" class="gaji_tu_sd_jabatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->jabatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->jabatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->type_jabatan->Visible) { // type_jabatan ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->type_jabatan) == "") { ?>
		<th data-name="type_jabatan" class="<?php echo $gaji_tu_sd_grid->type_jabatan->headerCellClass() ?>"><div id="elh_gaji_tu_sd_type_jabatan" class="gaji_tu_sd_type_jabatan"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->type_jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="type_jabatan" class="<?php echo $gaji_tu_sd_grid->type_jabatan->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_type_jabatan" class="gaji_tu_sd_type_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->type_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->type_jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->type_jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->tambahan->Visible) { // tambahan ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->tambahan) == "") { ?>
		<th data-name="tambahan" class="<?php echo $gaji_tu_sd_grid->tambahan->headerCellClass() ?>"><div id="elh_gaji_tu_sd_tambahan" class="gaji_tu_sd_tambahan"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->tambahan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tambahan" class="<?php echo $gaji_tu_sd_grid->tambahan->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_tambahan" class="gaji_tu_sd_tambahan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->tambahan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->tambahan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->tambahan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->gapok->Visible) { // gapok ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->gapok) == "") { ?>
		<th data-name="gapok" class="<?php echo $gaji_tu_sd_grid->gapok->headerCellClass() ?>"><div id="elh_gaji_tu_sd_gapok" class="gaji_tu_sd_gapok"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->gapok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gapok" class="<?php echo $gaji_tu_sd_grid->gapok->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_gapok" class="gaji_tu_sd_gapok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->gapok->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->gapok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->gapok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->ijasah->Visible) { // ijasah ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->ijasah) == "") { ?>
		<th data-name="ijasah" class="<?php echo $gaji_tu_sd_grid->ijasah->headerCellClass() ?>"><div id="elh_gaji_tu_sd_ijasah" class="gaji_tu_sd_ijasah"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->ijasah->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ijasah" class="<?php echo $gaji_tu_sd_grid->ijasah->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_ijasah" class="gaji_tu_sd_ijasah">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->ijasah->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->ijasah->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->ijasah->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->kehadiran->Visible) { // kehadiran ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->kehadiran) == "") { ?>
		<th data-name="kehadiran" class="<?php echo $gaji_tu_sd_grid->kehadiran->headerCellClass() ?>"><div id="elh_gaji_tu_sd_kehadiran" class="gaji_tu_sd_kehadiran"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->kehadiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kehadiran" class="<?php echo $gaji_tu_sd_grid->kehadiran->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_kehadiran" class="gaji_tu_sd_kehadiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->kehadiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->kehadiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->lembur->Visible) { // lembur ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->lembur) == "") { ?>
		<th data-name="lembur" class="<?php echo $gaji_tu_sd_grid->lembur->headerCellClass() ?>"><div id="elh_gaji_tu_sd_lembur" class="gaji_tu_sd_lembur"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->lembur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lembur" class="<?php echo $gaji_tu_sd_grid->lembur->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_lembur" class="gaji_tu_sd_lembur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->lembur->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->lembur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->lembur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->value_lembur->Visible) { // value_lembur ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->value_lembur) == "") { ?>
		<th data-name="value_lembur" class="<?php echo $gaji_tu_sd_grid->value_lembur->headerCellClass() ?>"><div id="elh_gaji_tu_sd_value_lembur" class="gaji_tu_sd_value_lembur"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->value_lembur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_lembur" class="<?php echo $gaji_tu_sd_grid->value_lembur->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_value_lembur" class="gaji_tu_sd_value_lembur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->value_lembur->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->value_lembur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->value_lembur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->value_reward->Visible) { // value_reward ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->value_reward) == "") { ?>
		<th data-name="value_reward" class="<?php echo $gaji_tu_sd_grid->value_reward->headerCellClass() ?>"><div id="elh_gaji_tu_sd_value_reward" class="gaji_tu_sd_value_reward"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->value_reward->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_reward" class="<?php echo $gaji_tu_sd_grid->value_reward->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_value_reward" class="gaji_tu_sd_value_reward">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->value_reward->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->value_reward->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->value_reward->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->value_inval->Visible) { // value_inval ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->value_inval) == "") { ?>
		<th data-name="value_inval" class="<?php echo $gaji_tu_sd_grid->value_inval->headerCellClass() ?>"><div id="elh_gaji_tu_sd_value_inval" class="gaji_tu_sd_value_inval"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->value_inval->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_inval" class="<?php echo $gaji_tu_sd_grid->value_inval->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_value_inval" class="gaji_tu_sd_value_inval">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->value_inval->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->value_inval->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->value_inval->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->piket_count->Visible) { // piket_count ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->piket_count) == "") { ?>
		<th data-name="piket_count" class="<?php echo $gaji_tu_sd_grid->piket_count->headerCellClass() ?>"><div id="elh_gaji_tu_sd_piket_count" class="gaji_tu_sd_piket_count"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->piket_count->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="piket_count" class="<?php echo $gaji_tu_sd_grid->piket_count->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_piket_count" class="gaji_tu_sd_piket_count">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->piket_count->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->piket_count->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->piket_count->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->value_piket->Visible) { // value_piket ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->value_piket) == "") { ?>
		<th data-name="value_piket" class="<?php echo $gaji_tu_sd_grid->value_piket->headerCellClass() ?>"><div id="elh_gaji_tu_sd_value_piket" class="gaji_tu_sd_value_piket"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->value_piket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_piket" class="<?php echo $gaji_tu_sd_grid->value_piket->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_value_piket" class="gaji_tu_sd_value_piket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->value_piket->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->value_piket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->value_piket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->tugastambahan->Visible) { // tugastambahan ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->tugastambahan) == "") { ?>
		<th data-name="tugastambahan" class="<?php echo $gaji_tu_sd_grid->tugastambahan->headerCellClass() ?>"><div id="elh_gaji_tu_sd_tugastambahan" class="gaji_tu_sd_tugastambahan"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->tugastambahan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tugastambahan" class="<?php echo $gaji_tu_sd_grid->tugastambahan->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_tugastambahan" class="gaji_tu_sd_tugastambahan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->tugastambahan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->tugastambahan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->tugastambahan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->tj_jabatan->Visible) { // tj_jabatan ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->tj_jabatan) == "") { ?>
		<th data-name="tj_jabatan" class="<?php echo $gaji_tu_sd_grid->tj_jabatan->headerCellClass() ?>"><div id="elh_gaji_tu_sd_tj_jabatan" class="gaji_tu_sd_tj_jabatan"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->tj_jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tj_jabatan" class="<?php echo $gaji_tu_sd_grid->tj_jabatan->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_tj_jabatan" class="gaji_tu_sd_tj_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->tj_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->tj_jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->tj_jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->tunjangan2->Visible) { // tunjangan2 ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->tunjangan2) == "") { ?>
		<th data-name="tunjangan2" class="<?php echo $gaji_tu_sd_grid->tunjangan2->headerCellClass() ?>"><div id="elh_gaji_tu_sd_tunjangan2" class="gaji_tu_sd_tunjangan2"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->tunjangan2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tunjangan2" class="<?php echo $gaji_tu_sd_grid->tunjangan2->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_tunjangan2" class="gaji_tu_sd_tunjangan2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->tunjangan2->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->tunjangan2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->tunjangan2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->potongan->Visible) { // potongan ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->potongan) == "") { ?>
		<th data-name="potongan" class="<?php echo $gaji_tu_sd_grid->potongan->headerCellClass() ?>"><div id="elh_gaji_tu_sd_potongan" class="gaji_tu_sd_potongan"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->potongan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan" class="<?php echo $gaji_tu_sd_grid->potongan->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_potongan" class="gaji_tu_sd_potongan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->potongan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->potongan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->potongan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->sub_total->Visible) { // sub_total ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->sub_total) == "") { ?>
		<th data-name="sub_total" class="<?php echo $gaji_tu_sd_grid->sub_total->headerCellClass() ?>"><div id="elh_gaji_tu_sd_sub_total" class="gaji_tu_sd_sub_total"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->sub_total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sub_total" class="<?php echo $gaji_tu_sd_grid->sub_total->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_sub_total" class="gaji_tu_sd_sub_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->sub_total->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->sub_total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->sub_total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->penyesuaian->Visible) { // penyesuaian ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->penyesuaian) == "") { ?>
		<th data-name="penyesuaian" class="<?php echo $gaji_tu_sd_grid->penyesuaian->headerCellClass() ?>"><div id="elh_gaji_tu_sd_penyesuaian" class="gaji_tu_sd_penyesuaian"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="penyesuaian" class="<?php echo $gaji_tu_sd_grid->penyesuaian->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_penyesuaian" class="gaji_tu_sd_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_tu_sd_grid->total->Visible) { // total ?>
	<?php if ($gaji_tu_sd_grid->SortUrl($gaji_tu_sd_grid->total) == "") { ?>
		<th data-name="total" class="<?php echo $gaji_tu_sd_grid->total->headerCellClass() ?>"><div id="elh_gaji_tu_sd_total" class="gaji_tu_sd_total"><div class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $gaji_tu_sd_grid->total->headerCellClass() ?>"><div><div id="elh_gaji_tu_sd_total" class="gaji_tu_sd_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_tu_sd_grid->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_tu_sd_grid->total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_tu_sd_grid->total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gaji_tu_sd_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$gaji_tu_sd_grid->StartRecord = 1;
$gaji_tu_sd_grid->StopRecord = $gaji_tu_sd_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($gaji_tu_sd->isConfirm() || $gaji_tu_sd_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($gaji_tu_sd_grid->FormKeyCountName) && ($gaji_tu_sd_grid->isGridAdd() || $gaji_tu_sd_grid->isGridEdit() || $gaji_tu_sd->isConfirm())) {
		$gaji_tu_sd_grid->KeyCount = $CurrentForm->getValue($gaji_tu_sd_grid->FormKeyCountName);
		$gaji_tu_sd_grid->StopRecord = $gaji_tu_sd_grid->StartRecord + $gaji_tu_sd_grid->KeyCount - 1;
	}
}
$gaji_tu_sd_grid->RecordCount = $gaji_tu_sd_grid->StartRecord - 1;
if ($gaji_tu_sd_grid->Recordset && !$gaji_tu_sd_grid->Recordset->EOF) {
	$gaji_tu_sd_grid->Recordset->moveFirst();
	$selectLimit = $gaji_tu_sd_grid->UseSelectLimit;
	if (!$selectLimit && $gaji_tu_sd_grid->StartRecord > 1)
		$gaji_tu_sd_grid->Recordset->move($gaji_tu_sd_grid->StartRecord - 1);
} elseif (!$gaji_tu_sd->AllowAddDeleteRow && $gaji_tu_sd_grid->StopRecord == 0) {
	$gaji_tu_sd_grid->StopRecord = $gaji_tu_sd->GridAddRowCount;
}

// Initialize aggregate
$gaji_tu_sd->RowType = ROWTYPE_AGGREGATEINIT;
$gaji_tu_sd->resetAttributes();
$gaji_tu_sd_grid->renderRow();
if ($gaji_tu_sd_grid->isGridAdd())
	$gaji_tu_sd_grid->RowIndex = 0;
if ($gaji_tu_sd_grid->isGridEdit())
	$gaji_tu_sd_grid->RowIndex = 0;
while ($gaji_tu_sd_grid->RecordCount < $gaji_tu_sd_grid->StopRecord) {
	$gaji_tu_sd_grid->RecordCount++;
	if ($gaji_tu_sd_grid->RecordCount >= $gaji_tu_sd_grid->StartRecord) {
		$gaji_tu_sd_grid->RowCount++;
		if ($gaji_tu_sd_grid->isGridAdd() || $gaji_tu_sd_grid->isGridEdit() || $gaji_tu_sd->isConfirm()) {
			$gaji_tu_sd_grid->RowIndex++;
			$CurrentForm->Index = $gaji_tu_sd_grid->RowIndex;
			if ($CurrentForm->hasValue($gaji_tu_sd_grid->FormActionName) && ($gaji_tu_sd->isConfirm() || $gaji_tu_sd_grid->EventCancelled))
				$gaji_tu_sd_grid->RowAction = strval($CurrentForm->getValue($gaji_tu_sd_grid->FormActionName));
			elseif ($gaji_tu_sd_grid->isGridAdd())
				$gaji_tu_sd_grid->RowAction = "insert";
			else
				$gaji_tu_sd_grid->RowAction = "";
		}

		// Set up key count
		$gaji_tu_sd_grid->KeyCount = $gaji_tu_sd_grid->RowIndex;

		// Init row class and style
		$gaji_tu_sd->resetAttributes();
		$gaji_tu_sd->CssClass = "";
		if ($gaji_tu_sd_grid->isGridAdd()) {
			if ($gaji_tu_sd->CurrentMode == "copy") {
				$gaji_tu_sd_grid->loadRowValues($gaji_tu_sd_grid->Recordset); // Load row values
				$gaji_tu_sd_grid->setRecordKey($gaji_tu_sd_grid->RowOldKey, $gaji_tu_sd_grid->Recordset); // Set old record key
			} else {
				$gaji_tu_sd_grid->loadRowValues(); // Load default values
				$gaji_tu_sd_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$gaji_tu_sd_grid->loadRowValues($gaji_tu_sd_grid->Recordset); // Load row values
		}
		$gaji_tu_sd->RowType = ROWTYPE_VIEW; // Render view
		if ($gaji_tu_sd_grid->isGridAdd()) // Grid add
			$gaji_tu_sd->RowType = ROWTYPE_ADD; // Render add
		if ($gaji_tu_sd_grid->isGridAdd() && $gaji_tu_sd->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$gaji_tu_sd_grid->restoreCurrentRowFormValues($gaji_tu_sd_grid->RowIndex); // Restore form values
		if ($gaji_tu_sd_grid->isGridEdit()) { // Grid edit
			if ($gaji_tu_sd->EventCancelled)
				$gaji_tu_sd_grid->restoreCurrentRowFormValues($gaji_tu_sd_grid->RowIndex); // Restore form values
			if ($gaji_tu_sd_grid->RowAction == "insert")
				$gaji_tu_sd->RowType = ROWTYPE_ADD; // Render add
			else
				$gaji_tu_sd->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($gaji_tu_sd_grid->isGridEdit() && ($gaji_tu_sd->RowType == ROWTYPE_EDIT || $gaji_tu_sd->RowType == ROWTYPE_ADD) && $gaji_tu_sd->EventCancelled) // Update failed
			$gaji_tu_sd_grid->restoreCurrentRowFormValues($gaji_tu_sd_grid->RowIndex); // Restore form values
		if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) // Edit row
			$gaji_tu_sd_grid->EditRowCount++;
		if ($gaji_tu_sd->isConfirm()) // Confirm row
			$gaji_tu_sd_grid->restoreCurrentRowFormValues($gaji_tu_sd_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$gaji_tu_sd->RowAttrs->merge(["data-rowindex" => $gaji_tu_sd_grid->RowCount, "id" => "r" . $gaji_tu_sd_grid->RowCount . "_gaji_tu_sd", "data-rowtype" => $gaji_tu_sd->RowType]);

		// Render row
		$gaji_tu_sd_grid->renderRow();

		// Render list options
		$gaji_tu_sd_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($gaji_tu_sd_grid->RowAction != "delete" && $gaji_tu_sd_grid->RowAction != "insertdelete" && !($gaji_tu_sd_grid->RowAction == "insert" && $gaji_tu_sd->isConfirm() && $gaji_tu_sd_grid->emptyRow())) {
?>
	<tr <?php echo $gaji_tu_sd->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gaji_tu_sd_grid->ListOptions->render("body", "left", $gaji_tu_sd_grid->RowCount);
?>
	<?php if ($gaji_tu_sd_grid->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $gaji_tu_sd_grid->pegawai->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_pegawai" class="form-group">
<?php $gaji_tu_sd_grid->pegawai->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai"><?php echo EmptyValue(strval($gaji_tu_sd_grid->pegawai->ViewValue)) ? $Language->phrase("PleaseSelect") : $gaji_tu_sd_grid->pegawai->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gaji_tu_sd_grid->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gaji_tu_sd_grid->pegawai->ReadOnly || $gaji_tu_sd_grid->pegawai->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gaji_tu_sd_grid->pegawai->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_pegawai") ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gaji_tu_sd_grid->pegawai->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" value="<?php echo $gaji_tu_sd_grid->pegawai->CurrentValue ?>"<?php echo $gaji_tu_sd_grid->pegawai->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_pegawai" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_tu_sd_grid->pegawai->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_pegawai" class="form-group">
<?php $gaji_tu_sd_grid->pegawai->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai"><?php echo EmptyValue(strval($gaji_tu_sd_grid->pegawai->ViewValue)) ? $Language->phrase("PleaseSelect") : $gaji_tu_sd_grid->pegawai->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gaji_tu_sd_grid->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gaji_tu_sd_grid->pegawai->ReadOnly || $gaji_tu_sd_grid->pegawai->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gaji_tu_sd_grid->pegawai->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_pegawai") ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gaji_tu_sd_grid->pegawai->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" value="<?php echo $gaji_tu_sd_grid->pegawai->CurrentValue ?>"<?php echo $gaji_tu_sd_grid->pegawai->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_pegawai">
<span<?php echo $gaji_tu_sd_grid->pegawai->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->pegawai->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_pegawai" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_tu_sd_grid->pegawai->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_pegawai" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_tu_sd_grid->pegawai->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_pegawai" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_tu_sd_grid->pegawai->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_pegawai" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_tu_sd_grid->pegawai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_id" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_id" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_id" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_id" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT || $gaji_tu_sd->CurrentMode == "edit") { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_id" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_id" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($gaji_tu_sd_grid->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id" <?php echo $gaji_tu_sd_grid->jenjang_id->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_jenjang_id" class="form-group">
<?php
$onchange = $gaji_tu_sd_grid->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sd_grid->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" id="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" value="<?php echo RemoveHtml($gaji_tu_sd_grid->jenjang_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->getPlaceHolder()) ?>"<?php echo $gaji_tu_sd_grid->jenjang_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jenjang_id" data-value-separator="<?php echo $gaji_tu_sd_grid->jenjang_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_sdgrid"], function() {
	fgaji_tu_sdgrid.createAutoSuggest({"id":"x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sd_grid->jenjang_id->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_jenjang_id") ?>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jenjang_id" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_jenjang_id" class="form-group">
<?php
$onchange = $gaji_tu_sd_grid->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sd_grid->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" id="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" value="<?php echo RemoveHtml($gaji_tu_sd_grid->jenjang_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->getPlaceHolder()) ?>"<?php echo $gaji_tu_sd_grid->jenjang_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jenjang_id" data-value-separator="<?php echo $gaji_tu_sd_grid->jenjang_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_sdgrid"], function() {
	fgaji_tu_sdgrid.createAutoSuggest({"id":"x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sd_grid->jenjang_id->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_jenjang_id") ?>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_jenjang_id">
<span<?php echo $gaji_tu_sd_grid->jenjang_id->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->jenjang_id->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jenjang_id" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jenjang_id" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jenjang_id" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jenjang_id" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id" <?php echo $gaji_tu_sd_grid->jabatan_id->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_jabatan_id" class="form-group">
<?php
$onchange = $gaji_tu_sd_grid->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sd_grid->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" id="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" value="<?php echo RemoveHtml($gaji_tu_sd_grid->jabatan_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->getPlaceHolder()) ?>"<?php echo $gaji_tu_sd_grid->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jabatan_id" data-value-separator="<?php echo $gaji_tu_sd_grid->jabatan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_sdgrid"], function() {
	fgaji_tu_sdgrid.createAutoSuggest({"id":"x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sd_grid->jabatan_id->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_jabatan_id") ?>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jabatan_id" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_jabatan_id" class="form-group">
<?php
$onchange = $gaji_tu_sd_grid->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sd_grid->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" id="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" value="<?php echo RemoveHtml($gaji_tu_sd_grid->jabatan_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->getPlaceHolder()) ?>"<?php echo $gaji_tu_sd_grid->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jabatan_id" data-value-separator="<?php echo $gaji_tu_sd_grid->jabatan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_sdgrid"], function() {
	fgaji_tu_sdgrid.createAutoSuggest({"id":"x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sd_grid->jabatan_id->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_jabatan_id") ?>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_jabatan_id">
<span<?php echo $gaji_tu_sd_grid->jabatan_id->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->jabatan_id->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jabatan_id" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jabatan_id" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jabatan_id" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jabatan_id" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->type_jabatan->Visible) { // type_jabatan ?>
		<td data-name="type_jabatan" <?php echo $gaji_tu_sd_grid->type_jabatan->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_type_jabatan" class="form-group">
<?php
$onchange = $gaji_tu_sd_grid->type_jabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sd_grid->type_jabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" id="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" value="<?php echo RemoveHtml($gaji_tu_sd_grid->type_jabatan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->getPlaceHolder()) ?>"<?php echo $gaji_tu_sd_grid->type_jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_type_jabatan" data-value-separator="<?php echo $gaji_tu_sd_grid->type_jabatan->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_sdgrid"], function() {
	fgaji_tu_sdgrid.createAutoSuggest({"id":"x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sd_grid->type_jabatan->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_type_jabatan") ?>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_type_jabatan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_type_jabatan" class="form-group">
<?php
$onchange = $gaji_tu_sd_grid->type_jabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sd_grid->type_jabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" id="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" value="<?php echo RemoveHtml($gaji_tu_sd_grid->type_jabatan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->getPlaceHolder()) ?>"<?php echo $gaji_tu_sd_grid->type_jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_type_jabatan" data-value-separator="<?php echo $gaji_tu_sd_grid->type_jabatan->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_sdgrid"], function() {
	fgaji_tu_sdgrid.createAutoSuggest({"id":"x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sd_grid->type_jabatan->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_type_jabatan") ?>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_type_jabatan">
<span<?php echo $gaji_tu_sd_grid->type_jabatan->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->type_jabatan->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_type_jabatan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_type_jabatan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_type_jabatan" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_type_jabatan" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->tambahan->Visible) { // tambahan ?>
		<td data-name="tambahan" <?php echo $gaji_tu_sd_grid->tambahan->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_tambahan" class="form-group">
<?php
$onchange = $gaji_tu_sd_grid->tambahan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sd_grid->tambahan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" id="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" value="<?php echo RemoveHtml($gaji_tu_sd_grid->tambahan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->getPlaceHolder()) ?>"<?php echo $gaji_tu_sd_grid->tambahan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tambahan" data-value-separator="<?php echo $gaji_tu_sd_grid->tambahan->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_sdgrid"], function() {
	fgaji_tu_sdgrid.createAutoSuggest({"id":"x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sd_grid->tambahan->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_tambahan") ?>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tambahan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_tambahan" class="form-group">
<?php
$onchange = $gaji_tu_sd_grid->tambahan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sd_grid->tambahan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" id="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" value="<?php echo RemoveHtml($gaji_tu_sd_grid->tambahan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->getPlaceHolder()) ?>"<?php echo $gaji_tu_sd_grid->tambahan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tambahan" data-value-separator="<?php echo $gaji_tu_sd_grid->tambahan->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_sdgrid"], function() {
	fgaji_tu_sdgrid.createAutoSuggest({"id":"x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sd_grid->tambahan->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_tambahan") ?>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_tambahan">
<span<?php echo $gaji_tu_sd_grid->tambahan->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->tambahan->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tambahan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tambahan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tambahan" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tambahan" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->gapok->Visible) { // gapok ?>
		<td data-name="gapok" <?php echo $gaji_tu_sd_grid->gapok->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_gapok" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_gapok" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->gapok->EditValue ?>"<?php echo $gaji_tu_sd_grid->gapok->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_gapok" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_tu_sd_grid->gapok->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_gapok" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_gapok" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->gapok->EditValue ?>"<?php echo $gaji_tu_sd_grid->gapok->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_gapok">
<span<?php echo $gaji_tu_sd_grid->gapok->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->gapok->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_gapok" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_tu_sd_grid->gapok->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_gapok" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_tu_sd_grid->gapok->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_gapok" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_tu_sd_grid->gapok->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_gapok" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_tu_sd_grid->gapok->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->ijasah->Visible) { // ijasah ?>
		<td data-name="ijasah" <?php echo $gaji_tu_sd_grid->ijasah->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_ijasah" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_ijasah" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->ijasah->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->ijasah->EditValue ?>"<?php echo $gaji_tu_sd_grid->ijasah->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_ijasah" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" value="<?php echo HtmlEncode($gaji_tu_sd_grid->ijasah->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_ijasah" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_ijasah" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->ijasah->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->ijasah->EditValue ?>"<?php echo $gaji_tu_sd_grid->ijasah->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_ijasah">
<span<?php echo $gaji_tu_sd_grid->ijasah->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->ijasah->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_ijasah" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" value="<?php echo HtmlEncode($gaji_tu_sd_grid->ijasah->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_ijasah" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" value="<?php echo HtmlEncode($gaji_tu_sd_grid->ijasah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_ijasah" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" value="<?php echo HtmlEncode($gaji_tu_sd_grid->ijasah->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_ijasah" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" value="<?php echo HtmlEncode($gaji_tu_sd_grid->ijasah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran" <?php echo $gaji_tu_sd_grid->kehadiran->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_kehadiran" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_kehadiran" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->kehadiran->EditValue ?>"<?php echo $gaji_tu_sd_grid->kehadiran->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_kehadiran" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_tu_sd_grid->kehadiran->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_kehadiran" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_kehadiran" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->kehadiran->EditValue ?>"<?php echo $gaji_tu_sd_grid->kehadiran->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_kehadiran">
<span<?php echo $gaji_tu_sd_grid->kehadiran->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->kehadiran->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_kehadiran" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_tu_sd_grid->kehadiran->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_kehadiran" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_tu_sd_grid->kehadiran->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_kehadiran" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_tu_sd_grid->kehadiran->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_kehadiran" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_tu_sd_grid->kehadiran->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->lembur->Visible) { // lembur ?>
		<td data-name="lembur" <?php echo $gaji_tu_sd_grid->lembur->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_lembur" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_lembur" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->lembur->EditValue ?>"<?php echo $gaji_tu_sd_grid->lembur->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_lembur" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gaji_tu_sd_grid->lembur->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_lembur" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_lembur" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->lembur->EditValue ?>"<?php echo $gaji_tu_sd_grid->lembur->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_lembur">
<span<?php echo $gaji_tu_sd_grid->lembur->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->lembur->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_lembur" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gaji_tu_sd_grid->lembur->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_lembur" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gaji_tu_sd_grid->lembur->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_lembur" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gaji_tu_sd_grid->lembur->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_lembur" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gaji_tu_sd_grid->lembur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->value_lembur->Visible) { // value_lembur ?>
		<td data-name="value_lembur" <?php echo $gaji_tu_sd_grid->value_lembur->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_value_lembur" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_value_lembur" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->value_lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->value_lembur->EditValue ?>"<?php echo $gaji_tu_sd_grid->value_lembur->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_lembur" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_lembur->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_value_lembur" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_value_lembur" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->value_lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->value_lembur->EditValue ?>"<?php echo $gaji_tu_sd_grid->value_lembur->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_value_lembur">
<span<?php echo $gaji_tu_sd_grid->value_lembur->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->value_lembur->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_lembur" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_lembur->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_lembur" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_lembur->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_lembur" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_lembur->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_lembur" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_lembur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->value_reward->Visible) { // value_reward ?>
		<td data-name="value_reward" <?php echo $gaji_tu_sd_grid->value_reward->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_value_reward" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_value_reward" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->value_reward->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->value_reward->EditValue ?>"<?php echo $gaji_tu_sd_grid->value_reward->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_reward" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_reward->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_value_reward" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_value_reward" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->value_reward->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->value_reward->EditValue ?>"<?php echo $gaji_tu_sd_grid->value_reward->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_value_reward">
<span<?php echo $gaji_tu_sd_grid->value_reward->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->value_reward->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_reward" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_reward->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_reward" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_reward->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_reward" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_reward->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_reward" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_reward->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->value_inval->Visible) { // value_inval ?>
		<td data-name="value_inval" <?php echo $gaji_tu_sd_grid->value_inval->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_value_inval" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_value_inval" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->value_inval->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->value_inval->EditValue ?>"<?php echo $gaji_tu_sd_grid->value_inval->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_inval" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_inval->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_value_inval" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_value_inval" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->value_inval->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->value_inval->EditValue ?>"<?php echo $gaji_tu_sd_grid->value_inval->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_value_inval">
<span<?php echo $gaji_tu_sd_grid->value_inval->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->value_inval->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_inval" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_inval->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_inval" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_inval->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_inval" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_inval->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_inval" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_inval->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->piket_count->Visible) { // piket_count ?>
		<td data-name="piket_count" <?php echo $gaji_tu_sd_grid->piket_count->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_piket_count" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_piket_count" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->piket_count->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->piket_count->EditValue ?>"<?php echo $gaji_tu_sd_grid->piket_count->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_piket_count" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" value="<?php echo HtmlEncode($gaji_tu_sd_grid->piket_count->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_piket_count" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_piket_count" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->piket_count->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->piket_count->EditValue ?>"<?php echo $gaji_tu_sd_grid->piket_count->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_piket_count">
<span<?php echo $gaji_tu_sd_grid->piket_count->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->piket_count->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_piket_count" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" value="<?php echo HtmlEncode($gaji_tu_sd_grid->piket_count->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_piket_count" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" value="<?php echo HtmlEncode($gaji_tu_sd_grid->piket_count->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_piket_count" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" value="<?php echo HtmlEncode($gaji_tu_sd_grid->piket_count->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_piket_count" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" value="<?php echo HtmlEncode($gaji_tu_sd_grid->piket_count->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->value_piket->Visible) { // value_piket ?>
		<td data-name="value_piket" <?php echo $gaji_tu_sd_grid->value_piket->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_value_piket" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_value_piket" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->value_piket->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->value_piket->EditValue ?>"<?php echo $gaji_tu_sd_grid->value_piket->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_piket" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_piket->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_value_piket" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_value_piket" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->value_piket->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->value_piket->EditValue ?>"<?php echo $gaji_tu_sd_grid->value_piket->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_value_piket">
<span<?php echo $gaji_tu_sd_grid->value_piket->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->value_piket->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_piket" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_piket->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_piket" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_piket->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_piket" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_piket->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_piket" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_piket->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->tugastambahan->Visible) { // tugastambahan ?>
		<td data-name="tugastambahan" <?php echo $gaji_tu_sd_grid->tugastambahan->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_tugastambahan" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_tugastambahan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tugastambahan->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->tugastambahan->EditValue ?>"<?php echo $gaji_tu_sd_grid->tugastambahan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tugastambahan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tugastambahan->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_tugastambahan" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_tugastambahan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tugastambahan->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->tugastambahan->EditValue ?>"<?php echo $gaji_tu_sd_grid->tugastambahan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_tugastambahan">
<span<?php echo $gaji_tu_sd_grid->tugastambahan->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->tugastambahan->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tugastambahan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tugastambahan->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tugastambahan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tugastambahan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tugastambahan" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tugastambahan->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tugastambahan" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tugastambahan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->tj_jabatan->Visible) { // tj_jabatan ?>
		<td data-name="tj_jabatan" <?php echo $gaji_tu_sd_grid->tj_jabatan->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_tj_jabatan" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_tj_jabatan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tj_jabatan->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->tj_jabatan->EditValue ?>"<?php echo $gaji_tu_sd_grid->tj_jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tj_jabatan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tj_jabatan->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_tj_jabatan" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_tj_jabatan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tj_jabatan->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->tj_jabatan->EditValue ?>"<?php echo $gaji_tu_sd_grid->tj_jabatan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_tj_jabatan">
<span<?php echo $gaji_tu_sd_grid->tj_jabatan->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->tj_jabatan->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tj_jabatan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tj_jabatan->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tj_jabatan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tj_jabatan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tj_jabatan" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tj_jabatan->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tj_jabatan" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tj_jabatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->tunjangan2->Visible) { // tunjangan2 ?>
		<td data-name="tunjangan2" <?php echo $gaji_tu_sd_grid->tunjangan2->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_tunjangan2" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_tunjangan2" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tunjangan2->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->tunjangan2->EditValue ?>"<?php echo $gaji_tu_sd_grid->tunjangan2->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tunjangan2" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tunjangan2->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_tunjangan2" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_tunjangan2" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tunjangan2->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->tunjangan2->EditValue ?>"<?php echo $gaji_tu_sd_grid->tunjangan2->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_tunjangan2">
<span<?php echo $gaji_tu_sd_grid->tunjangan2->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->tunjangan2->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tunjangan2" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tunjangan2->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tunjangan2" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tunjangan2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tunjangan2" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tunjangan2->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tunjangan2" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tunjangan2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->potongan->Visible) { // potongan ?>
		<td data-name="potongan" <?php echo $gaji_tu_sd_grid->potongan->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_potongan" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_potongan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->potongan->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->potongan->EditValue ?>"<?php echo $gaji_tu_sd_grid->potongan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_potongan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->potongan->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_potongan" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_potongan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->potongan->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->potongan->EditValue ?>"<?php echo $gaji_tu_sd_grid->potongan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_potongan">
<span<?php echo $gaji_tu_sd_grid->potongan->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->potongan->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_potongan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->potongan->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_potongan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->potongan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_potongan" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->potongan->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_potongan" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->potongan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->sub_total->Visible) { // sub_total ?>
		<td data-name="sub_total" <?php echo $gaji_tu_sd_grid->sub_total->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_sub_total" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_sub_total" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->sub_total->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->sub_total->EditValue ?>"<?php echo $gaji_tu_sd_grid->sub_total->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_sub_total" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_tu_sd_grid->sub_total->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_sub_total" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_sub_total" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->sub_total->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->sub_total->EditValue ?>"<?php echo $gaji_tu_sd_grid->sub_total->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_sub_total">
<span<?php echo $gaji_tu_sd_grid->sub_total->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->sub_total->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_sub_total" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_tu_sd_grid->sub_total->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_sub_total" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_tu_sd_grid->sub_total->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_sub_total" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_tu_sd_grid->sub_total->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_sub_total" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_tu_sd_grid->sub_total->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->penyesuaian->Visible) { // penyesuaian ?>
		<td data-name="penyesuaian" <?php echo $gaji_tu_sd_grid->penyesuaian->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_penyesuaian" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_penyesuaian" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->penyesuaian->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->penyesuaian->EditValue ?>"<?php echo $gaji_tu_sd_grid->penyesuaian->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_penyesuaian" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_tu_sd_grid->penyesuaian->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_penyesuaian" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_penyesuaian" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->penyesuaian->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->penyesuaian->EditValue ?>"<?php echo $gaji_tu_sd_grid->penyesuaian->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_penyesuaian">
<span<?php echo $gaji_tu_sd_grid->penyesuaian->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->penyesuaian->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_penyesuaian" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_tu_sd_grid->penyesuaian->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_penyesuaian" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_tu_sd_grid->penyesuaian->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_penyesuaian" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_tu_sd_grid->penyesuaian->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_penyesuaian" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_tu_sd_grid->penyesuaian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->total->Visible) { // total ?>
		<td data-name="total" <?php echo $gaji_tu_sd_grid->total->cellAttributes() ?>>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_total" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_total" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->total->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->total->EditValue ?>"<?php echo $gaji_tu_sd_grid->total->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_total" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_tu_sd_grid->total->OldValue) ?>">
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_total" class="form-group">
<input type="text" data-table="gaji_tu_sd" data-field="x_total" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->total->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->total->EditValue ?>"<?php echo $gaji_tu_sd_grid->total->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_tu_sd_grid->RowCount ?>_gaji_tu_sd_total">
<span<?php echo $gaji_tu_sd_grid->total->viewAttributes() ?>><?php echo $gaji_tu_sd_grid->total->getViewValue() ?></span>
</span>
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_total" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_tu_sd_grid->total->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_total" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_tu_sd_grid->total->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_total" name="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" id="fgaji_tu_sdgrid$x<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_tu_sd_grid->total->FormValue) ?>">
<input type="hidden" data-table="gaji_tu_sd" data-field="x_total" name="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" id="fgaji_tu_sdgrid$o<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_tu_sd_grid->total->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gaji_tu_sd_grid->ListOptions->render("body", "right", $gaji_tu_sd_grid->RowCount);
?>
	</tr>
<?php if ($gaji_tu_sd->RowType == ROWTYPE_ADD || $gaji_tu_sd->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fgaji_tu_sdgrid", "load"], function() {
	fgaji_tu_sdgrid.updateLists(<?php echo $gaji_tu_sd_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$gaji_tu_sd_grid->isGridAdd() || $gaji_tu_sd->CurrentMode == "copy")
		if (!$gaji_tu_sd_grid->Recordset->EOF)
			$gaji_tu_sd_grid->Recordset->moveNext();
}
?>
<?php
	if ($gaji_tu_sd->CurrentMode == "add" || $gaji_tu_sd->CurrentMode == "copy" || $gaji_tu_sd->CurrentMode == "edit") {
		$gaji_tu_sd_grid->RowIndex = '$rowindex$';
		$gaji_tu_sd_grid->loadRowValues();

		// Set row properties
		$gaji_tu_sd->resetAttributes();
		$gaji_tu_sd->RowAttrs->merge(["data-rowindex" => $gaji_tu_sd_grid->RowIndex, "id" => "r0_gaji_tu_sd", "data-rowtype" => ROWTYPE_ADD]);
		$gaji_tu_sd->RowAttrs->appendClass("ew-template");
		$gaji_tu_sd->RowType = ROWTYPE_ADD;

		// Render row
		$gaji_tu_sd_grid->renderRow();

		// Render list options
		$gaji_tu_sd_grid->renderListOptions();
		$gaji_tu_sd_grid->StartRowCount = 0;
?>
	<tr <?php echo $gaji_tu_sd->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gaji_tu_sd_grid->ListOptions->render("body", "left", $gaji_tu_sd_grid->RowIndex);
?>
	<?php if ($gaji_tu_sd_grid->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_pegawai" class="form-group gaji_tu_sd_pegawai">
<?php $gaji_tu_sd_grid->pegawai->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai"><?php echo EmptyValue(strval($gaji_tu_sd_grid->pegawai->ViewValue)) ? $Language->phrase("PleaseSelect") : $gaji_tu_sd_grid->pegawai->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gaji_tu_sd_grid->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gaji_tu_sd_grid->pegawai->ReadOnly || $gaji_tu_sd_grid->pegawai->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gaji_tu_sd_grid->pegawai->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_pegawai") ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gaji_tu_sd_grid->pegawai->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" value="<?php echo $gaji_tu_sd_grid->pegawai->CurrentValue ?>"<?php echo $gaji_tu_sd_grid->pegawai->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_pegawai" class="form-group gaji_tu_sd_pegawai">
<span<?php echo $gaji_tu_sd_grid->pegawai->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->pegawai->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_pegawai" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_tu_sd_grid->pegawai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_pegawai" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_tu_sd_grid->pegawai->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_jenjang_id" class="form-group gaji_tu_sd_jenjang_id">
<?php
$onchange = $gaji_tu_sd_grid->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sd_grid->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" id="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" value="<?php echo RemoveHtml($gaji_tu_sd_grid->jenjang_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->getPlaceHolder()) ?>"<?php echo $gaji_tu_sd_grid->jenjang_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jenjang_id" data-value-separator="<?php echo $gaji_tu_sd_grid->jenjang_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_sdgrid"], function() {
	fgaji_tu_sdgrid.createAutoSuggest({"id":"x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sd_grid->jenjang_id->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_jenjang_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_jenjang_id" class="form-group gaji_tu_sd_jenjang_id">
<span<?php echo $gaji_tu_sd_grid->jenjang_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->jenjang_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jenjang_id" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jenjang_id" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jenjang_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_jabatan_id" class="form-group gaji_tu_sd_jabatan_id">
<?php
$onchange = $gaji_tu_sd_grid->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sd_grid->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" id="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" value="<?php echo RemoveHtml($gaji_tu_sd_grid->jabatan_id->EditValue) ?>" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->getPlaceHolder()) ?>"<?php echo $gaji_tu_sd_grid->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jabatan_id" data-value-separator="<?php echo $gaji_tu_sd_grid->jabatan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_sdgrid"], function() {
	fgaji_tu_sdgrid.createAutoSuggest({"id":"x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sd_grid->jabatan_id->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_jabatan_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_jabatan_id" class="form-group gaji_tu_sd_jabatan_id">
<span<?php echo $gaji_tu_sd_grid->jabatan_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->jabatan_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jabatan_id" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_jabatan_id" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_tu_sd_grid->jabatan_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->type_jabatan->Visible) { // type_jabatan ?>
		<td data-name="type_jabatan">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_type_jabatan" class="form-group gaji_tu_sd_type_jabatan">
<?php
$onchange = $gaji_tu_sd_grid->type_jabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sd_grid->type_jabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" id="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" value="<?php echo RemoveHtml($gaji_tu_sd_grid->type_jabatan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->getPlaceHolder()) ?>"<?php echo $gaji_tu_sd_grid->type_jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_type_jabatan" data-value-separator="<?php echo $gaji_tu_sd_grid->type_jabatan->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_sdgrid"], function() {
	fgaji_tu_sdgrid.createAutoSuggest({"id":"x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sd_grid->type_jabatan->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_type_jabatan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_type_jabatan" class="form-group gaji_tu_sd_type_jabatan">
<span<?php echo $gaji_tu_sd_grid->type_jabatan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->type_jabatan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_type_jabatan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_type_jabatan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_type_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->type_jabatan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->tambahan->Visible) { // tambahan ?>
		<td data-name="tambahan">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_tambahan" class="form-group gaji_tu_sd_tambahan">
<?php
$onchange = $gaji_tu_sd_grid->tambahan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_tu_sd_grid->tambahan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" id="sv_x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" value="<?php echo RemoveHtml($gaji_tu_sd_grid->tambahan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->getPlaceHolder()) ?>"<?php echo $gaji_tu_sd_grid->tambahan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tambahan" data-value-separator="<?php echo $gaji_tu_sd_grid->tambahan->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgaji_tu_sdgrid"], function() {
	fgaji_tu_sdgrid.createAutoSuggest({"id":"x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan","forceSelect":false});
});
</script>
<?php echo $gaji_tu_sd_grid->tambahan->Lookup->getParamTag($gaji_tu_sd_grid, "p_x" . $gaji_tu_sd_grid->RowIndex . "_tambahan") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_tambahan" class="form-group gaji_tu_sd_tambahan">
<span<?php echo $gaji_tu_sd_grid->tambahan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->tambahan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tambahan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tambahan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tambahan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->gapok->Visible) { // gapok ?>
		<td data-name="gapok">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_gapok" class="form-group gaji_tu_sd_gapok">
<input type="text" data-table="gaji_tu_sd" data-field="x_gapok" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->gapok->EditValue ?>"<?php echo $gaji_tu_sd_grid->gapok->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_gapok" class="form-group gaji_tu_sd_gapok">
<span<?php echo $gaji_tu_sd_grid->gapok->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->gapok->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_gapok" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_tu_sd_grid->gapok->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_gapok" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_tu_sd_grid->gapok->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->ijasah->Visible) { // ijasah ?>
		<td data-name="ijasah">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_ijasah" class="form-group gaji_tu_sd_ijasah">
<input type="text" data-table="gaji_tu_sd" data-field="x_ijasah" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->ijasah->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->ijasah->EditValue ?>"<?php echo $gaji_tu_sd_grid->ijasah->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_ijasah" class="form-group gaji_tu_sd_ijasah">
<span<?php echo $gaji_tu_sd_grid->ijasah->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->ijasah->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_ijasah" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" value="<?php echo HtmlEncode($gaji_tu_sd_grid->ijasah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_ijasah" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_ijasah" value="<?php echo HtmlEncode($gaji_tu_sd_grid->ijasah->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_kehadiran" class="form-group gaji_tu_sd_kehadiran">
<input type="text" data-table="gaji_tu_sd" data-field="x_kehadiran" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->kehadiran->EditValue ?>"<?php echo $gaji_tu_sd_grid->kehadiran->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_kehadiran" class="form-group gaji_tu_sd_kehadiran">
<span<?php echo $gaji_tu_sd_grid->kehadiran->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->kehadiran->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_kehadiran" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_tu_sd_grid->kehadiran->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_kehadiran" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_tu_sd_grid->kehadiran->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->lembur->Visible) { // lembur ?>
		<td data-name="lembur">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_lembur" class="form-group gaji_tu_sd_lembur">
<input type="text" data-table="gaji_tu_sd" data-field="x_lembur" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->lembur->EditValue ?>"<?php echo $gaji_tu_sd_grid->lembur->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_lembur" class="form-group gaji_tu_sd_lembur">
<span<?php echo $gaji_tu_sd_grid->lembur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->lembur->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_lembur" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gaji_tu_sd_grid->lembur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_lembur" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gaji_tu_sd_grid->lembur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->value_lembur->Visible) { // value_lembur ?>
		<td data-name="value_lembur">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_value_lembur" class="form-group gaji_tu_sd_value_lembur">
<input type="text" data-table="gaji_tu_sd" data-field="x_value_lembur" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->value_lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->value_lembur->EditValue ?>"<?php echo $gaji_tu_sd_grid->value_lembur->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_value_lembur" class="form-group gaji_tu_sd_value_lembur">
<span<?php echo $gaji_tu_sd_grid->value_lembur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->value_lembur->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_lembur" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_lembur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_lembur" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_lembur" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_lembur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->value_reward->Visible) { // value_reward ?>
		<td data-name="value_reward">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_value_reward" class="form-group gaji_tu_sd_value_reward">
<input type="text" data-table="gaji_tu_sd" data-field="x_value_reward" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->value_reward->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->value_reward->EditValue ?>"<?php echo $gaji_tu_sd_grid->value_reward->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_value_reward" class="form-group gaji_tu_sd_value_reward">
<span<?php echo $gaji_tu_sd_grid->value_reward->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->value_reward->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_reward" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_reward->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_reward" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_reward->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->value_inval->Visible) { // value_inval ?>
		<td data-name="value_inval">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_value_inval" class="form-group gaji_tu_sd_value_inval">
<input type="text" data-table="gaji_tu_sd" data-field="x_value_inval" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->value_inval->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->value_inval->EditValue ?>"<?php echo $gaji_tu_sd_grid->value_inval->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_value_inval" class="form-group gaji_tu_sd_value_inval">
<span<?php echo $gaji_tu_sd_grid->value_inval->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->value_inval->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_inval" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_inval->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_inval" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_inval->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->piket_count->Visible) { // piket_count ?>
		<td data-name="piket_count">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_piket_count" class="form-group gaji_tu_sd_piket_count">
<input type="text" data-table="gaji_tu_sd" data-field="x_piket_count" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->piket_count->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->piket_count->EditValue ?>"<?php echo $gaji_tu_sd_grid->piket_count->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_piket_count" class="form-group gaji_tu_sd_piket_count">
<span<?php echo $gaji_tu_sd_grid->piket_count->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->piket_count->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_piket_count" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" value="<?php echo HtmlEncode($gaji_tu_sd_grid->piket_count->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_piket_count" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_piket_count" value="<?php echo HtmlEncode($gaji_tu_sd_grid->piket_count->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->value_piket->Visible) { // value_piket ?>
		<td data-name="value_piket">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_value_piket" class="form-group gaji_tu_sd_value_piket">
<input type="text" data-table="gaji_tu_sd" data-field="x_value_piket" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->value_piket->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->value_piket->EditValue ?>"<?php echo $gaji_tu_sd_grid->value_piket->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_value_piket" class="form-group gaji_tu_sd_value_piket">
<span<?php echo $gaji_tu_sd_grid->value_piket->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->value_piket->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_piket" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_piket->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_value_piket" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_value_piket" value="<?php echo HtmlEncode($gaji_tu_sd_grid->value_piket->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->tugastambahan->Visible) { // tugastambahan ?>
		<td data-name="tugastambahan">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_tugastambahan" class="form-group gaji_tu_sd_tugastambahan">
<input type="text" data-table="gaji_tu_sd" data-field="x_tugastambahan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tugastambahan->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->tugastambahan->EditValue ?>"<?php echo $gaji_tu_sd_grid->tugastambahan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_tugastambahan" class="form-group gaji_tu_sd_tugastambahan">
<span<?php echo $gaji_tu_sd_grid->tugastambahan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->tugastambahan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tugastambahan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tugastambahan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tugastambahan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tugastambahan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tugastambahan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->tj_jabatan->Visible) { // tj_jabatan ?>
		<td data-name="tj_jabatan">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_tj_jabatan" class="form-group gaji_tu_sd_tj_jabatan">
<input type="text" data-table="gaji_tu_sd" data-field="x_tj_jabatan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tj_jabatan->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->tj_jabatan->EditValue ?>"<?php echo $gaji_tu_sd_grid->tj_jabatan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_tj_jabatan" class="form-group gaji_tu_sd_tj_jabatan">
<span<?php echo $gaji_tu_sd_grid->tj_jabatan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->tj_jabatan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tj_jabatan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tj_jabatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tj_jabatan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tj_jabatan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tj_jabatan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->tunjangan2->Visible) { // tunjangan2 ?>
		<td data-name="tunjangan2">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_tunjangan2" class="form-group gaji_tu_sd_tunjangan2">
<input type="text" data-table="gaji_tu_sd" data-field="x_tunjangan2" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->tunjangan2->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->tunjangan2->EditValue ?>"<?php echo $gaji_tu_sd_grid->tunjangan2->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_tunjangan2" class="form-group gaji_tu_sd_tunjangan2">
<span<?php echo $gaji_tu_sd_grid->tunjangan2->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->tunjangan2->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tunjangan2" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tunjangan2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_tunjangan2" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_tunjangan2" value="<?php echo HtmlEncode($gaji_tu_sd_grid->tunjangan2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->potongan->Visible) { // potongan ?>
		<td data-name="potongan">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_potongan" class="form-group gaji_tu_sd_potongan">
<input type="text" data-table="gaji_tu_sd" data-field="x_potongan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->potongan->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->potongan->EditValue ?>"<?php echo $gaji_tu_sd_grid->potongan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_potongan" class="form-group gaji_tu_sd_potongan">
<span<?php echo $gaji_tu_sd_grid->potongan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->potongan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_potongan" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->potongan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_potongan" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_tu_sd_grid->potongan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->sub_total->Visible) { // sub_total ?>
		<td data-name="sub_total">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_sub_total" class="form-group gaji_tu_sd_sub_total">
<input type="text" data-table="gaji_tu_sd" data-field="x_sub_total" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->sub_total->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->sub_total->EditValue ?>"<?php echo $gaji_tu_sd_grid->sub_total->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_sub_total" class="form-group gaji_tu_sd_sub_total">
<span<?php echo $gaji_tu_sd_grid->sub_total->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->sub_total->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_sub_total" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_tu_sd_grid->sub_total->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_sub_total" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_tu_sd_grid->sub_total->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->penyesuaian->Visible) { // penyesuaian ?>
		<td data-name="penyesuaian">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_penyesuaian" class="form-group gaji_tu_sd_penyesuaian">
<input type="text" data-table="gaji_tu_sd" data-field="x_penyesuaian" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->penyesuaian->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->penyesuaian->EditValue ?>"<?php echo $gaji_tu_sd_grid->penyesuaian->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_penyesuaian" class="form-group gaji_tu_sd_penyesuaian">
<span<?php echo $gaji_tu_sd_grid->penyesuaian->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->penyesuaian->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_penyesuaian" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_tu_sd_grid->penyesuaian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_penyesuaian" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_tu_sd_grid->penyesuaian->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_tu_sd_grid->total->Visible) { // total ?>
		<td data-name="total">
<?php if (!$gaji_tu_sd->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tu_sd_total" class="form-group gaji_tu_sd_total">
<input type="text" data-table="gaji_tu_sd" data-field="x_total" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" size="30" maxlength="19" placeholder="<?php echo HtmlEncode($gaji_tu_sd_grid->total->getPlaceHolder()) ?>" value="<?php echo $gaji_tu_sd_grid->total->EditValue ?>"<?php echo $gaji_tu_sd_grid->total->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tu_sd_total" class="form-group gaji_tu_sd_total">
<span<?php echo $gaji_tu_sd_grid->total->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_tu_sd_grid->total->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_total" name="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" id="x<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_tu_sd_grid->total->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji_tu_sd" data-field="x_total" name="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" id="o<?php echo $gaji_tu_sd_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_tu_sd_grid->total->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gaji_tu_sd_grid->ListOptions->render("body", "right", $gaji_tu_sd_grid->RowIndex);
?>
<script>
loadjs.ready(["fgaji_tu_sdgrid", "load"], function() {
	fgaji_tu_sdgrid.updateLists(<?php echo $gaji_tu_sd_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($gaji_tu_sd->CurrentMode == "add" || $gaji_tu_sd->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $gaji_tu_sd_grid->FormKeyCountName ?>" id="<?php echo $gaji_tu_sd_grid->FormKeyCountName ?>" value="<?php echo $gaji_tu_sd_grid->KeyCount ?>">
<?php echo $gaji_tu_sd_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($gaji_tu_sd->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $gaji_tu_sd_grid->FormKeyCountName ?>" id="<?php echo $gaji_tu_sd_grid->FormKeyCountName ?>" value="<?php echo $gaji_tu_sd_grid->KeyCount ?>">
<?php echo $gaji_tu_sd_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($gaji_tu_sd->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fgaji_tu_sdgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gaji_tu_sd_grid->Recordset)
	$gaji_tu_sd_grid->Recordset->Close();
?>
<?php if ($gaji_tu_sd_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $gaji_tu_sd_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gaji_tu_sd_grid->TotalRecords == 0 && !$gaji_tu_sd->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gaji_tu_sd_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$gaji_tu_sd_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$gaji_tu_sd_grid->terminate();
?>