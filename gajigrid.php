<?php
namespace PHPMaker2020\sigap;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($gaji_grid))
	$gaji_grid = new gaji_grid();

// Run the page
$gaji_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gaji_grid->Page_Render();
?>
<?php if (!$gaji_grid->isExport()) { ?>
<script>
var fgajigrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fgajigrid = new ew.Form("fgajigrid", "grid");
	fgajigrid.formKeyCountName = '<?php echo $gaji_grid->FormKeyCountName ?>';

	// Validate form
	fgajigrid.validate = function() {
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
			<?php if ($gaji_grid->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->pegawai->caption(), $gaji_grid->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gaji_grid->jenjang_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jenjang_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->jenjang_id->caption(), $gaji_grid->jenjang_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gaji_grid->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->jabatan_id->caption(), $gaji_grid->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gaji_grid->lama_kerja->Required) { ?>
				elm = this.getElements("x" + infix + "_lama_kerja");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->lama_kerja->caption(), $gaji_grid->lama_kerja->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lama_kerja");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->lama_kerja->errorMessage()) ?>");
			<?php if ($gaji_grid->type->Required) { ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->type->caption(), $gaji_grid->type->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_type");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->type->errorMessage()) ?>");
			<?php if ($gaji_grid->jenis_guru->Required) { ?>
				elm = this.getElements("x" + infix + "_jenis_guru");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->jenis_guru->caption(), $gaji_grid->jenis_guru->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jenis_guru");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->jenis_guru->errorMessage()) ?>");
			<?php if ($gaji_grid->tambahan->Required) { ?>
				elm = this.getElements("x" + infix + "_tambahan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->tambahan->caption(), $gaji_grid->tambahan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tambahan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->tambahan->errorMessage()) ?>");
			<?php if ($gaji_grid->periode->Required) { ?>
				elm = this.getElements("x" + infix + "_periode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->periode->caption(), $gaji_grid->periode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_periode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->periode->errorMessage()) ?>");
			<?php if ($gaji_grid->tunjangan_periode->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_periode");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->tunjangan_periode->caption(), $gaji_grid->tunjangan_periode->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_periode");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->tunjangan_periode->errorMessage()) ?>");
			<?php if ($gaji_grid->kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->kehadiran->caption(), $gaji_grid->kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->kehadiran->errorMessage()) ?>");
			<?php if ($gaji_grid->value_kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_value_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->value_kehadiran->caption(), $gaji_grid->value_kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->value_kehadiran->errorMessage()) ?>");
			<?php if ($gaji_grid->jp->Required) { ?>
				elm = this.getElements("x" + infix + "_jp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->jp->caption(), $gaji_grid->jp->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jp");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->jp->errorMessage()) ?>");
			<?php if ($gaji_grid->gapok->Required) { ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->gapok->caption(), $gaji_grid->gapok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->gapok->errorMessage()) ?>");
			<?php if ($gaji_grid->total_gapok->Required) { ?>
				elm = this.getElements("x" + infix + "_total_gapok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->total_gapok->caption(), $gaji_grid->total_gapok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total_gapok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->total_gapok->errorMessage()) ?>");
			<?php if ($gaji_grid->lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->lembur->caption(), $gaji_grid->lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->lembur->errorMessage()) ?>");
			<?php if ($gaji_grid->value_lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_value_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->value_lembur->caption(), $gaji_grid->value_lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_lembur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->value_lembur->errorMessage()) ?>");
			<?php if ($gaji_grid->value_reward->Required) { ?>
				elm = this.getElements("x" + infix + "_value_reward");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->value_reward->caption(), $gaji_grid->value_reward->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_reward");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->value_reward->errorMessage()) ?>");
			<?php if ($gaji_grid->value_inval->Required) { ?>
				elm = this.getElements("x" + infix + "_value_inval");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->value_inval->caption(), $gaji_grid->value_inval->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_inval");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->value_inval->errorMessage()) ?>");
			<?php if ($gaji_grid->piket_count->Required) { ?>
				elm = this.getElements("x" + infix + "_piket_count");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->piket_count->caption(), $gaji_grid->piket_count->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_piket_count");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->piket_count->errorMessage()) ?>");
			<?php if ($gaji_grid->value_piket->Required) { ?>
				elm = this.getElements("x" + infix + "_value_piket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->value_piket->caption(), $gaji_grid->value_piket->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_piket");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->value_piket->errorMessage()) ?>");
			<?php if ($gaji_grid->tugastambahan->Required) { ?>
				elm = this.getElements("x" + infix + "_tugastambahan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->tugastambahan->caption(), $gaji_grid->tugastambahan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tugastambahan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->tugastambahan->errorMessage()) ?>");
			<?php if ($gaji_grid->tj_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_tj_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->tj_jabatan->caption(), $gaji_grid->tj_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tj_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->tj_jabatan->errorMessage()) ?>");
			<?php if ($gaji_grid->sub_total->Required) { ?>
				elm = this.getElements("x" + infix + "_sub_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->sub_total->caption(), $gaji_grid->sub_total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_sub_total");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->sub_total->errorMessage()) ?>");
			<?php if ($gaji_grid->potongan->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->potongan->caption(), $gaji_grid->potongan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->potongan->errorMessage()) ?>");
			<?php if ($gaji_grid->penyesuaian->Required) { ?>
				elm = this.getElements("x" + infix + "_penyesuaian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->penyesuaian->caption(), $gaji_grid->penyesuaian->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_penyesuaian");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->penyesuaian->errorMessage()) ?>");
			<?php if ($gaji_grid->total->Required) { ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gaji_grid->total->caption(), $gaji_grid->total->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_total");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gaji_grid->total->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fgajigrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pegawai", false)) return false;
		if (ew.valueChanged(fobj, infix, "jenjang_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "jabatan_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "lama_kerja", false)) return false;
		if (ew.valueChanged(fobj, infix, "type", false)) return false;
		if (ew.valueChanged(fobj, infix, "jenis_guru", false)) return false;
		if (ew.valueChanged(fobj, infix, "tambahan", false)) return false;
		if (ew.valueChanged(fobj, infix, "periode", false)) return false;
		if (ew.valueChanged(fobj, infix, "tunjangan_periode", false)) return false;
		if (ew.valueChanged(fobj, infix, "kehadiran", false)) return false;
		if (ew.valueChanged(fobj, infix, "value_kehadiran", false)) return false;
		if (ew.valueChanged(fobj, infix, "jp", false)) return false;
		if (ew.valueChanged(fobj, infix, "gapok", false)) return false;
		if (ew.valueChanged(fobj, infix, "total_gapok", false)) return false;
		if (ew.valueChanged(fobj, infix, "lembur", false)) return false;
		if (ew.valueChanged(fobj, infix, "value_lembur", false)) return false;
		if (ew.valueChanged(fobj, infix, "value_reward", false)) return false;
		if (ew.valueChanged(fobj, infix, "value_inval", false)) return false;
		if (ew.valueChanged(fobj, infix, "piket_count", false)) return false;
		if (ew.valueChanged(fobj, infix, "value_piket", false)) return false;
		if (ew.valueChanged(fobj, infix, "tugastambahan", false)) return false;
		if (ew.valueChanged(fobj, infix, "tj_jabatan", false)) return false;
		if (ew.valueChanged(fobj, infix, "sub_total", false)) return false;
		if (ew.valueChanged(fobj, infix, "potongan", false)) return false;
		if (ew.valueChanged(fobj, infix, "penyesuaian", false)) return false;
		if (ew.valueChanged(fobj, infix, "total", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fgajigrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgajigrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgajigrid.lists["x_pegawai"] = <?php echo $gaji_grid->pegawai->Lookup->toClientList($gaji_grid) ?>;
	fgajigrid.lists["x_pegawai"].options = <?php echo JsonEncode($gaji_grid->pegawai->lookupOptions()) ?>;
	fgajigrid.lists["x_jenjang_id"] = <?php echo $gaji_grid->jenjang_id->Lookup->toClientList($gaji_grid) ?>;
	fgajigrid.lists["x_jenjang_id"].options = <?php echo JsonEncode($gaji_grid->jenjang_id->lookupOptions()) ?>;
	fgajigrid.autoSuggests["x_jenjang_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	fgajigrid.lists["x_jabatan_id"] = <?php echo $gaji_grid->jabatan_id->Lookup->toClientList($gaji_grid) ?>;
	fgajigrid.lists["x_jabatan_id"].options = <?php echo JsonEncode($gaji_grid->jabatan_id->lookupOptions()) ?>;
	fgajigrid.autoSuggests["x_jabatan_id"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgajigrid");
});
</script>
<?php } ?>
<?php
$gaji_grid->renderOtherOptions();
?>
<?php if ($gaji_grid->TotalRecords > 0 || $gaji->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gaji_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gaji">
<?php if ($gaji_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $gaji_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fgajigrid" class="ew-form ew-list-form form-inline">
<div id="gmp_gaji" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_gajigrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gaji->RowType = ROWTYPE_HEADER;

// Render list options
$gaji_grid->renderListOptions();

// Render list options (header, left)
$gaji_grid->ListOptions->render("header", "left");
?>
<?php if ($gaji_grid->pegawai->Visible) { // pegawai ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $gaji_grid->pegawai->headerCellClass() ?>"><div id="elh_gaji_pegawai" class="gaji_pegawai"><div class="ew-table-header-caption"><?php echo $gaji_grid->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $gaji_grid->pegawai->headerCellClass() ?>"><div><div id="elh_gaji_pegawai" class="gaji_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->jenjang_id->Visible) { // jenjang_id ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->jenjang_id) == "") { ?>
		<th data-name="jenjang_id" class="<?php echo $gaji_grid->jenjang_id->headerCellClass() ?>"><div id="elh_gaji_jenjang_id" class="gaji_jenjang_id"><div class="ew-table-header-caption"><?php echo $gaji_grid->jenjang_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenjang_id" class="<?php echo $gaji_grid->jenjang_id->headerCellClass() ?>"><div><div id="elh_gaji_jenjang_id" class="gaji_jenjang_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->jenjang_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->jenjang_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->jenjang_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->jabatan_id) == "") { ?>
		<th data-name="jabatan_id" class="<?php echo $gaji_grid->jabatan_id->headerCellClass() ?>"><div id="elh_gaji_jabatan_id" class="gaji_jabatan_id"><div class="ew-table-header-caption"><?php echo $gaji_grid->jabatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan_id" class="<?php echo $gaji_grid->jabatan_id->headerCellClass() ?>"><div><div id="elh_gaji_jabatan_id" class="gaji_jabatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->jabatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->jabatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->lama_kerja->Visible) { // lama_kerja ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->lama_kerja) == "") { ?>
		<th data-name="lama_kerja" class="<?php echo $gaji_grid->lama_kerja->headerCellClass() ?>"><div id="elh_gaji_lama_kerja" class="gaji_lama_kerja"><div class="ew-table-header-caption"><?php echo $gaji_grid->lama_kerja->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lama_kerja" class="<?php echo $gaji_grid->lama_kerja->headerCellClass() ?>"><div><div id="elh_gaji_lama_kerja" class="gaji_lama_kerja">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->lama_kerja->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->lama_kerja->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->lama_kerja->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->type->Visible) { // type ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->type) == "") { ?>
		<th data-name="type" class="<?php echo $gaji_grid->type->headerCellClass() ?>"><div id="elh_gaji_type" class="gaji_type"><div class="ew-table-header-caption"><?php echo $gaji_grid->type->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="type" class="<?php echo $gaji_grid->type->headerCellClass() ?>"><div><div id="elh_gaji_type" class="gaji_type">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->type->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->type->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->type->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->jenis_guru->Visible) { // jenis_guru ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->jenis_guru) == "") { ?>
		<th data-name="jenis_guru" class="<?php echo $gaji_grid->jenis_guru->headerCellClass() ?>"><div id="elh_gaji_jenis_guru" class="gaji_jenis_guru"><div class="ew-table-header-caption"><?php echo $gaji_grid->jenis_guru->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jenis_guru" class="<?php echo $gaji_grid->jenis_guru->headerCellClass() ?>"><div><div id="elh_gaji_jenis_guru" class="gaji_jenis_guru">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->jenis_guru->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->jenis_guru->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->jenis_guru->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->tambahan->Visible) { // tambahan ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->tambahan) == "") { ?>
		<th data-name="tambahan" class="<?php echo $gaji_grid->tambahan->headerCellClass() ?>"><div id="elh_gaji_tambahan" class="gaji_tambahan"><div class="ew-table-header-caption"><?php echo $gaji_grid->tambahan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tambahan" class="<?php echo $gaji_grid->tambahan->headerCellClass() ?>"><div><div id="elh_gaji_tambahan" class="gaji_tambahan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->tambahan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->tambahan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->tambahan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->periode->Visible) { // periode ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->periode) == "") { ?>
		<th data-name="periode" class="<?php echo $gaji_grid->periode->headerCellClass() ?>"><div id="elh_gaji_periode" class="gaji_periode"><div class="ew-table-header-caption"><?php echo $gaji_grid->periode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="periode" class="<?php echo $gaji_grid->periode->headerCellClass() ?>"><div><div id="elh_gaji_periode" class="gaji_periode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->periode->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->periode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->periode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->tunjangan_periode->Visible) { // tunjangan_periode ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->tunjangan_periode) == "") { ?>
		<th data-name="tunjangan_periode" class="<?php echo $gaji_grid->tunjangan_periode->headerCellClass() ?>"><div id="elh_gaji_tunjangan_periode" class="gaji_tunjangan_periode"><div class="ew-table-header-caption"><?php echo $gaji_grid->tunjangan_periode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tunjangan_periode" class="<?php echo $gaji_grid->tunjangan_periode->headerCellClass() ?>"><div><div id="elh_gaji_tunjangan_periode" class="gaji_tunjangan_periode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->tunjangan_periode->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->tunjangan_periode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->tunjangan_periode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->kehadiran->Visible) { // kehadiran ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->kehadiran) == "") { ?>
		<th data-name="kehadiran" class="<?php echo $gaji_grid->kehadiran->headerCellClass() ?>"><div id="elh_gaji_kehadiran" class="gaji_kehadiran"><div class="ew-table-header-caption"><?php echo $gaji_grid->kehadiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kehadiran" class="<?php echo $gaji_grid->kehadiran->headerCellClass() ?>"><div><div id="elh_gaji_kehadiran" class="gaji_kehadiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->kehadiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->kehadiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->value_kehadiran->Visible) { // value_kehadiran ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->value_kehadiran) == "") { ?>
		<th data-name="value_kehadiran" class="<?php echo $gaji_grid->value_kehadiran->headerCellClass() ?>"><div id="elh_gaji_value_kehadiran" class="gaji_value_kehadiran"><div class="ew-table-header-caption"><?php echo $gaji_grid->value_kehadiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_kehadiran" class="<?php echo $gaji_grid->value_kehadiran->headerCellClass() ?>"><div><div id="elh_gaji_value_kehadiran" class="gaji_value_kehadiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->value_kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->value_kehadiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->value_kehadiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->jp->Visible) { // jp ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->jp) == "") { ?>
		<th data-name="jp" class="<?php echo $gaji_grid->jp->headerCellClass() ?>"><div id="elh_gaji_jp" class="gaji_jp"><div class="ew-table-header-caption"><?php echo $gaji_grid->jp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jp" class="<?php echo $gaji_grid->jp->headerCellClass() ?>"><div><div id="elh_gaji_jp" class="gaji_jp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->jp->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->jp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->jp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->gapok->Visible) { // gapok ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->gapok) == "") { ?>
		<th data-name="gapok" class="<?php echo $gaji_grid->gapok->headerCellClass() ?>"><div id="elh_gaji_gapok" class="gaji_gapok"><div class="ew-table-header-caption"><?php echo $gaji_grid->gapok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gapok" class="<?php echo $gaji_grid->gapok->headerCellClass() ?>"><div><div id="elh_gaji_gapok" class="gaji_gapok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->gapok->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->gapok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->gapok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->total_gapok->Visible) { // total_gapok ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->total_gapok) == "") { ?>
		<th data-name="total_gapok" class="<?php echo $gaji_grid->total_gapok->headerCellClass() ?>"><div id="elh_gaji_total_gapok" class="gaji_total_gapok"><div class="ew-table-header-caption"><?php echo $gaji_grid->total_gapok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_gapok" class="<?php echo $gaji_grid->total_gapok->headerCellClass() ?>"><div><div id="elh_gaji_total_gapok" class="gaji_total_gapok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->total_gapok->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->total_gapok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->total_gapok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->lembur->Visible) { // lembur ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->lembur) == "") { ?>
		<th data-name="lembur" class="<?php echo $gaji_grid->lembur->headerCellClass() ?>"><div id="elh_gaji_lembur" class="gaji_lembur"><div class="ew-table-header-caption"><?php echo $gaji_grid->lembur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lembur" class="<?php echo $gaji_grid->lembur->headerCellClass() ?>"><div><div id="elh_gaji_lembur" class="gaji_lembur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->lembur->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->lembur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->lembur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->value_lembur->Visible) { // value_lembur ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->value_lembur) == "") { ?>
		<th data-name="value_lembur" class="<?php echo $gaji_grid->value_lembur->headerCellClass() ?>"><div id="elh_gaji_value_lembur" class="gaji_value_lembur"><div class="ew-table-header-caption"><?php echo $gaji_grid->value_lembur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_lembur" class="<?php echo $gaji_grid->value_lembur->headerCellClass() ?>"><div><div id="elh_gaji_value_lembur" class="gaji_value_lembur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->value_lembur->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->value_lembur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->value_lembur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->value_reward->Visible) { // value_reward ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->value_reward) == "") { ?>
		<th data-name="value_reward" class="<?php echo $gaji_grid->value_reward->headerCellClass() ?>"><div id="elh_gaji_value_reward" class="gaji_value_reward"><div class="ew-table-header-caption"><?php echo $gaji_grid->value_reward->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_reward" class="<?php echo $gaji_grid->value_reward->headerCellClass() ?>"><div><div id="elh_gaji_value_reward" class="gaji_value_reward">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->value_reward->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->value_reward->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->value_reward->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->value_inval->Visible) { // value_inval ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->value_inval) == "") { ?>
		<th data-name="value_inval" class="<?php echo $gaji_grid->value_inval->headerCellClass() ?>"><div id="elh_gaji_value_inval" class="gaji_value_inval"><div class="ew-table-header-caption"><?php echo $gaji_grid->value_inval->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_inval" class="<?php echo $gaji_grid->value_inval->headerCellClass() ?>"><div><div id="elh_gaji_value_inval" class="gaji_value_inval">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->value_inval->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->value_inval->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->value_inval->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->piket_count->Visible) { // piket_count ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->piket_count) == "") { ?>
		<th data-name="piket_count" class="<?php echo $gaji_grid->piket_count->headerCellClass() ?>"><div id="elh_gaji_piket_count" class="gaji_piket_count"><div class="ew-table-header-caption"><?php echo $gaji_grid->piket_count->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="piket_count" class="<?php echo $gaji_grid->piket_count->headerCellClass() ?>"><div><div id="elh_gaji_piket_count" class="gaji_piket_count">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->piket_count->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->piket_count->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->piket_count->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->value_piket->Visible) { // value_piket ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->value_piket) == "") { ?>
		<th data-name="value_piket" class="<?php echo $gaji_grid->value_piket->headerCellClass() ?>"><div id="elh_gaji_value_piket" class="gaji_value_piket"><div class="ew-table-header-caption"><?php echo $gaji_grid->value_piket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_piket" class="<?php echo $gaji_grid->value_piket->headerCellClass() ?>"><div><div id="elh_gaji_value_piket" class="gaji_value_piket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->value_piket->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->value_piket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->value_piket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->tugastambahan->Visible) { // tugastambahan ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->tugastambahan) == "") { ?>
		<th data-name="tugastambahan" class="<?php echo $gaji_grid->tugastambahan->headerCellClass() ?>"><div id="elh_gaji_tugastambahan" class="gaji_tugastambahan"><div class="ew-table-header-caption"><?php echo $gaji_grid->tugastambahan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tugastambahan" class="<?php echo $gaji_grid->tugastambahan->headerCellClass() ?>"><div><div id="elh_gaji_tugastambahan" class="gaji_tugastambahan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->tugastambahan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->tugastambahan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->tugastambahan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->tj_jabatan->Visible) { // tj_jabatan ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->tj_jabatan) == "") { ?>
		<th data-name="tj_jabatan" class="<?php echo $gaji_grid->tj_jabatan->headerCellClass() ?>"><div id="elh_gaji_tj_jabatan" class="gaji_tj_jabatan"><div class="ew-table-header-caption"><?php echo $gaji_grid->tj_jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tj_jabatan" class="<?php echo $gaji_grid->tj_jabatan->headerCellClass() ?>"><div><div id="elh_gaji_tj_jabatan" class="gaji_tj_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->tj_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->tj_jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->tj_jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->sub_total->Visible) { // sub_total ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->sub_total) == "") { ?>
		<th data-name="sub_total" class="<?php echo $gaji_grid->sub_total->headerCellClass() ?>"><div id="elh_gaji_sub_total" class="gaji_sub_total"><div class="ew-table-header-caption"><?php echo $gaji_grid->sub_total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sub_total" class="<?php echo $gaji_grid->sub_total->headerCellClass() ?>"><div><div id="elh_gaji_sub_total" class="gaji_sub_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->sub_total->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->sub_total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->sub_total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->potongan->Visible) { // potongan ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->potongan) == "") { ?>
		<th data-name="potongan" class="<?php echo $gaji_grid->potongan->headerCellClass() ?>"><div id="elh_gaji_potongan" class="gaji_potongan"><div class="ew-table-header-caption"><?php echo $gaji_grid->potongan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan" class="<?php echo $gaji_grid->potongan->headerCellClass() ?>"><div><div id="elh_gaji_potongan" class="gaji_potongan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->potongan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->potongan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->potongan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->penyesuaian->Visible) { // penyesuaian ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->penyesuaian) == "") { ?>
		<th data-name="penyesuaian" class="<?php echo $gaji_grid->penyesuaian->headerCellClass() ?>"><div id="elh_gaji_penyesuaian" class="gaji_penyesuaian"><div class="ew-table-header-caption"><?php echo $gaji_grid->penyesuaian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="penyesuaian" class="<?php echo $gaji_grid->penyesuaian->headerCellClass() ?>"><div><div id="elh_gaji_penyesuaian" class="gaji_penyesuaian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->penyesuaian->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->penyesuaian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->penyesuaian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gaji_grid->total->Visible) { // total ?>
	<?php if ($gaji_grid->SortUrl($gaji_grid->total) == "") { ?>
		<th data-name="total" class="<?php echo $gaji_grid->total->headerCellClass() ?>"><div id="elh_gaji_total" class="gaji_total"><div class="ew-table-header-caption"><?php echo $gaji_grid->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $gaji_grid->total->headerCellClass() ?>"><div><div id="elh_gaji_total" class="gaji_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gaji_grid->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($gaji_grid->total->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gaji_grid->total->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gaji_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$gaji_grid->StartRecord = 1;
$gaji_grid->StopRecord = $gaji_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($gaji->isConfirm() || $gaji_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($gaji_grid->FormKeyCountName) && ($gaji_grid->isGridAdd() || $gaji_grid->isGridEdit() || $gaji->isConfirm())) {
		$gaji_grid->KeyCount = $CurrentForm->getValue($gaji_grid->FormKeyCountName);
		$gaji_grid->StopRecord = $gaji_grid->StartRecord + $gaji_grid->KeyCount - 1;
	}
}
$gaji_grid->RecordCount = $gaji_grid->StartRecord - 1;
if ($gaji_grid->Recordset && !$gaji_grid->Recordset->EOF) {
	$gaji_grid->Recordset->moveFirst();
	$selectLimit = $gaji_grid->UseSelectLimit;
	if (!$selectLimit && $gaji_grid->StartRecord > 1)
		$gaji_grid->Recordset->move($gaji_grid->StartRecord - 1);
} elseif (!$gaji->AllowAddDeleteRow && $gaji_grid->StopRecord == 0) {
	$gaji_grid->StopRecord = $gaji->GridAddRowCount;
}

// Initialize aggregate
$gaji->RowType = ROWTYPE_AGGREGATEINIT;
$gaji->resetAttributes();
$gaji_grid->renderRow();
if ($gaji_grid->isGridAdd())
	$gaji_grid->RowIndex = 0;
if ($gaji_grid->isGridEdit())
	$gaji_grid->RowIndex = 0;
while ($gaji_grid->RecordCount < $gaji_grid->StopRecord) {
	$gaji_grid->RecordCount++;
	if ($gaji_grid->RecordCount >= $gaji_grid->StartRecord) {
		$gaji_grid->RowCount++;
		if ($gaji_grid->isGridAdd() || $gaji_grid->isGridEdit() || $gaji->isConfirm()) {
			$gaji_grid->RowIndex++;
			$CurrentForm->Index = $gaji_grid->RowIndex;
			if ($CurrentForm->hasValue($gaji_grid->FormActionName) && ($gaji->isConfirm() || $gaji_grid->EventCancelled))
				$gaji_grid->RowAction = strval($CurrentForm->getValue($gaji_grid->FormActionName));
			elseif ($gaji_grid->isGridAdd())
				$gaji_grid->RowAction = "insert";
			else
				$gaji_grid->RowAction = "";
		}

		// Set up key count
		$gaji_grid->KeyCount = $gaji_grid->RowIndex;

		// Init row class and style
		$gaji->resetAttributes();
		$gaji->CssClass = "";
		if ($gaji_grid->isGridAdd()) {
			if ($gaji->CurrentMode == "copy") {
				$gaji_grid->loadRowValues($gaji_grid->Recordset); // Load row values
				$gaji_grid->setRecordKey($gaji_grid->RowOldKey, $gaji_grid->Recordset); // Set old record key
			} else {
				$gaji_grid->loadRowValues(); // Load default values
				$gaji_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$gaji_grid->loadRowValues($gaji_grid->Recordset); // Load row values
		}
		$gaji->RowType = ROWTYPE_VIEW; // Render view
		if ($gaji_grid->isGridAdd()) // Grid add
			$gaji->RowType = ROWTYPE_ADD; // Render add
		if ($gaji_grid->isGridAdd() && $gaji->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$gaji_grid->restoreCurrentRowFormValues($gaji_grid->RowIndex); // Restore form values
		if ($gaji_grid->isGridEdit()) { // Grid edit
			if ($gaji->EventCancelled)
				$gaji_grid->restoreCurrentRowFormValues($gaji_grid->RowIndex); // Restore form values
			if ($gaji_grid->RowAction == "insert")
				$gaji->RowType = ROWTYPE_ADD; // Render add
			else
				$gaji->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($gaji_grid->isGridEdit() && ($gaji->RowType == ROWTYPE_EDIT || $gaji->RowType == ROWTYPE_ADD) && $gaji->EventCancelled) // Update failed
			$gaji_grid->restoreCurrentRowFormValues($gaji_grid->RowIndex); // Restore form values
		if ($gaji->RowType == ROWTYPE_EDIT) // Edit row
			$gaji_grid->EditRowCount++;
		if ($gaji->isConfirm()) // Confirm row
			$gaji_grid->restoreCurrentRowFormValues($gaji_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$gaji->RowAttrs->merge(["data-rowindex" => $gaji_grid->RowCount, "id" => "r" . $gaji_grid->RowCount . "_gaji", "data-rowtype" => $gaji->RowType]);

		// Render row
		$gaji_grid->renderRow();

		// Render list options
		$gaji_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($gaji_grid->RowAction != "delete" && $gaji_grid->RowAction != "insertdelete" && !($gaji_grid->RowAction == "insert" && $gaji->isConfirm() && $gaji_grid->emptyRow())) {
?>
	<tr <?php echo $gaji->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gaji_grid->ListOptions->render("body", "left", $gaji_grid->RowCount);
?>
	<?php if ($gaji_grid->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $gaji_grid->pegawai->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_pegawai" class="form-group">
<?php $gaji_grid->pegawai->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gaji_grid->RowIndex ?>_pegawai"><?php echo EmptyValue(strval($gaji_grid->pegawai->ViewValue)) ? $Language->phrase("PleaseSelect") : $gaji_grid->pegawai->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gaji_grid->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gaji_grid->pegawai->ReadOnly || $gaji_grid->pegawai->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gaji_grid->RowIndex ?>_pegawai',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gaji_grid->pegawai->Lookup->getParamTag($gaji_grid, "p_x" . $gaji_grid->RowIndex . "_pegawai") ?>
<input type="hidden" data-table="gaji" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gaji_grid->pegawai->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_grid->RowIndex ?>_pegawai" value="<?php echo $gaji_grid->pegawai->CurrentValue ?>"<?php echo $gaji_grid->pegawai->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_pegawai" name="o<?php echo $gaji_grid->RowIndex ?>_pegawai" id="o<?php echo $gaji_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_grid->pegawai->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_pegawai" class="form-group">
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gaji_grid->RowIndex ?>_pegawai"><?php echo EmptyValue(strval($gaji_grid->pegawai->ViewValue)) ? $Language->phrase("PleaseSelect") : $gaji_grid->pegawai->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gaji_grid->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gaji_grid->pegawai->ReadOnly || $gaji_grid->pegawai->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gaji_grid->RowIndex ?>_pegawai',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gaji_grid->pegawai->Lookup->getParamTag($gaji_grid, "p_x" . $gaji_grid->RowIndex . "_pegawai") ?>
<input type="hidden" data-table="gaji" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gaji_grid->pegawai->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_grid->RowIndex ?>_pegawai" value="<?php echo $gaji_grid->pegawai->CurrentValue ?>"<?php echo $gaji_grid->pegawai->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_pegawai">
<span<?php echo $gaji_grid->pegawai->viewAttributes() ?>><?php echo $gaji_grid->pegawai->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_pegawai" name="x<?php echo $gaji_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_grid->pegawai->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_pegawai" name="o<?php echo $gaji_grid->RowIndex ?>_pegawai" id="o<?php echo $gaji_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_grid->pegawai->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_pegawai" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_pegawai" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_grid->pegawai->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_pegawai" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_pegawai" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_grid->pegawai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="gaji" data-field="x_id" name="x<?php echo $gaji_grid->RowIndex ?>_id" id="x<?php echo $gaji_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gaji_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_id" name="o<?php echo $gaji_grid->RowIndex ?>_id" id="o<?php echo $gaji_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gaji_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT || $gaji->CurrentMode == "edit") { ?>
<input type="hidden" data-table="gaji" data-field="x_id" name="x<?php echo $gaji_grid->RowIndex ?>_id" id="x<?php echo $gaji_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gaji_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($gaji_grid->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id" <?php echo $gaji_grid->jenjang_id->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_jenjang_id" class="form-group">
<?php
$onchange = $gaji_grid->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_grid->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_grid->RowIndex ?>_jenjang_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" id="sv_x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" value="<?php echo RemoveHtml($gaji_grid->jenjang_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_grid->jenjang_id->getPlaceHolder()) ?>"<?php echo $gaji_grid->jenjang_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_jenjang_id" data-value-separator="<?php echo $gaji_grid->jenjang_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_grid->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgajigrid"], function() {
	fgajigrid.createAutoSuggest({"id":"x<?php echo $gaji_grid->RowIndex ?>_jenjang_id","forceSelect":false});
});
</script>
<?php echo $gaji_grid->jenjang_id->Lookup->getParamTag($gaji_grid, "p_x" . $gaji_grid->RowIndex . "_jenjang_id") ?>
</span>
<input type="hidden" data-table="gaji" data-field="x_jenjang_id" name="o<?php echo $gaji_grid->RowIndex ?>_jenjang_id" id="o<?php echo $gaji_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_grid->jenjang_id->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_jenjang_id" class="form-group">
<span<?php echo $gaji_grid->jenjang_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->jenjang_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_jenjang_id" name="x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_grid->jenjang_id->CurrentValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_jenjang_id">
<span<?php echo $gaji_grid->jenjang_id->viewAttributes() ?>><?php echo $gaji_grid->jenjang_id->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_jenjang_id" name="x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_grid->jenjang_id->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_jenjang_id" name="o<?php echo $gaji_grid->RowIndex ?>_jenjang_id" id="o<?php echo $gaji_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_grid->jenjang_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_jenjang_id" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_grid->jenjang_id->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_jenjang_id" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_jenjang_id" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_grid->jenjang_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id" <?php echo $gaji_grid->jabatan_id->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_jabatan_id" class="form-group">
<?php
$onchange = $gaji_grid->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_grid->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_grid->RowIndex ?>_jabatan_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" id="sv_x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" value="<?php echo RemoveHtml($gaji_grid->jabatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_grid->jabatan_id->getPlaceHolder()) ?>"<?php echo $gaji_grid->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_jabatan_id" data-value-separator="<?php echo $gaji_grid->jabatan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_grid->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgajigrid"], function() {
	fgajigrid.createAutoSuggest({"id":"x<?php echo $gaji_grid->RowIndex ?>_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gaji_grid->jabatan_id->Lookup->getParamTag($gaji_grid, "p_x" . $gaji_grid->RowIndex . "_jabatan_id") ?>
</span>
<input type="hidden" data-table="gaji" data-field="x_jabatan_id" name="o<?php echo $gaji_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gaji_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_grid->jabatan_id->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_jabatan_id" class="form-group">
<span<?php echo $gaji_grid->jabatan_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->jabatan_id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_jabatan_id" name="x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_grid->jabatan_id->CurrentValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_jabatan_id">
<span<?php echo $gaji_grid->jabatan_id->viewAttributes() ?>><?php echo $gaji_grid->jabatan_id->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_jabatan_id" name="x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_grid->jabatan_id->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_jabatan_id" name="o<?php echo $gaji_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gaji_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_grid->jabatan_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_jabatan_id" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_grid->jabatan_id->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_jabatan_id" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_jabatan_id" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_grid->jabatan_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->lama_kerja->Visible) { // lama_kerja ?>
		<td data-name="lama_kerja" <?php echo $gaji_grid->lama_kerja->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_lama_kerja" class="form-group">
<input type="text" data-table="gaji" data-field="x_lama_kerja" name="x<?php echo $gaji_grid->RowIndex ?>_lama_kerja" id="x<?php echo $gaji_grid->RowIndex ?>_lama_kerja" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->lama_kerja->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->lama_kerja->EditValue ?>"<?php echo $gaji_grid->lama_kerja->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_lama_kerja" name="o<?php echo $gaji_grid->RowIndex ?>_lama_kerja" id="o<?php echo $gaji_grid->RowIndex ?>_lama_kerja" value="<?php echo HtmlEncode($gaji_grid->lama_kerja->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_lama_kerja" class="form-group">
<input type="text" data-table="gaji" data-field="x_lama_kerja" name="x<?php echo $gaji_grid->RowIndex ?>_lama_kerja" id="x<?php echo $gaji_grid->RowIndex ?>_lama_kerja" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->lama_kerja->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->lama_kerja->EditValue ?>"<?php echo $gaji_grid->lama_kerja->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_lama_kerja">
<span<?php echo $gaji_grid->lama_kerja->viewAttributes() ?>><?php echo $gaji_grid->lama_kerja->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_lama_kerja" name="x<?php echo $gaji_grid->RowIndex ?>_lama_kerja" id="x<?php echo $gaji_grid->RowIndex ?>_lama_kerja" value="<?php echo HtmlEncode($gaji_grid->lama_kerja->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_lama_kerja" name="o<?php echo $gaji_grid->RowIndex ?>_lama_kerja" id="o<?php echo $gaji_grid->RowIndex ?>_lama_kerja" value="<?php echo HtmlEncode($gaji_grid->lama_kerja->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_lama_kerja" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_lama_kerja" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_lama_kerja" value="<?php echo HtmlEncode($gaji_grid->lama_kerja->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_lama_kerja" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_lama_kerja" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_lama_kerja" value="<?php echo HtmlEncode($gaji_grid->lama_kerja->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->type->Visible) { // type ?>
		<td data-name="type" <?php echo $gaji_grid->type->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_type" class="form-group">
<input type="text" data-table="gaji" data-field="x_type" name="x<?php echo $gaji_grid->RowIndex ?>_type" id="x<?php echo $gaji_grid->RowIndex ?>_type" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_grid->type->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->type->EditValue ?>"<?php echo $gaji_grid->type->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_type" name="o<?php echo $gaji_grid->RowIndex ?>_type" id="o<?php echo $gaji_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($gaji_grid->type->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_type" class="form-group">
<input type="text" data-table="gaji" data-field="x_type" name="x<?php echo $gaji_grid->RowIndex ?>_type" id="x<?php echo $gaji_grid->RowIndex ?>_type" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_grid->type->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->type->EditValue ?>"<?php echo $gaji_grid->type->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_type">
<span<?php echo $gaji_grid->type->viewAttributes() ?>><?php echo $gaji_grid->type->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_type" name="x<?php echo $gaji_grid->RowIndex ?>_type" id="x<?php echo $gaji_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($gaji_grid->type->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_type" name="o<?php echo $gaji_grid->RowIndex ?>_type" id="o<?php echo $gaji_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($gaji_grid->type->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_type" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_type" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($gaji_grid->type->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_type" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_type" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($gaji_grid->type->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->jenis_guru->Visible) { // jenis_guru ?>
		<td data-name="jenis_guru" <?php echo $gaji_grid->jenis_guru->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_jenis_guru" class="form-group">
<input type="text" data-table="gaji" data-field="x_jenis_guru" name="x<?php echo $gaji_grid->RowIndex ?>_jenis_guru" id="x<?php echo $gaji_grid->RowIndex ?>_jenis_guru" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_grid->jenis_guru->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->jenis_guru->EditValue ?>"<?php echo $gaji_grid->jenis_guru->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_jenis_guru" name="o<?php echo $gaji_grid->RowIndex ?>_jenis_guru" id="o<?php echo $gaji_grid->RowIndex ?>_jenis_guru" value="<?php echo HtmlEncode($gaji_grid->jenis_guru->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_jenis_guru" class="form-group">
<input type="text" data-table="gaji" data-field="x_jenis_guru" name="x<?php echo $gaji_grid->RowIndex ?>_jenis_guru" id="x<?php echo $gaji_grid->RowIndex ?>_jenis_guru" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_grid->jenis_guru->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->jenis_guru->EditValue ?>"<?php echo $gaji_grid->jenis_guru->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_jenis_guru">
<span<?php echo $gaji_grid->jenis_guru->viewAttributes() ?>><?php echo $gaji_grid->jenis_guru->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_jenis_guru" name="x<?php echo $gaji_grid->RowIndex ?>_jenis_guru" id="x<?php echo $gaji_grid->RowIndex ?>_jenis_guru" value="<?php echo HtmlEncode($gaji_grid->jenis_guru->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_jenis_guru" name="o<?php echo $gaji_grid->RowIndex ?>_jenis_guru" id="o<?php echo $gaji_grid->RowIndex ?>_jenis_guru" value="<?php echo HtmlEncode($gaji_grid->jenis_guru->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_jenis_guru" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_jenis_guru" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_jenis_guru" value="<?php echo HtmlEncode($gaji_grid->jenis_guru->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_jenis_guru" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_jenis_guru" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_jenis_guru" value="<?php echo HtmlEncode($gaji_grid->jenis_guru->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->tambahan->Visible) { // tambahan ?>
		<td data-name="tambahan" <?php echo $gaji_grid->tambahan->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_tambahan" class="form-group">
<input type="text" data-table="gaji" data-field="x_tambahan" name="x<?php echo $gaji_grid->RowIndex ?>_tambahan" id="x<?php echo $gaji_grid->RowIndex ?>_tambahan" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_grid->tambahan->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->tambahan->EditValue ?>"<?php echo $gaji_grid->tambahan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_tambahan" name="o<?php echo $gaji_grid->RowIndex ?>_tambahan" id="o<?php echo $gaji_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_grid->tambahan->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_tambahan" class="form-group">
<input type="text" data-table="gaji" data-field="x_tambahan" name="x<?php echo $gaji_grid->RowIndex ?>_tambahan" id="x<?php echo $gaji_grid->RowIndex ?>_tambahan" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_grid->tambahan->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->tambahan->EditValue ?>"<?php echo $gaji_grid->tambahan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_tambahan">
<span<?php echo $gaji_grid->tambahan->viewAttributes() ?>><?php echo $gaji_grid->tambahan->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_tambahan" name="x<?php echo $gaji_grid->RowIndex ?>_tambahan" id="x<?php echo $gaji_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_grid->tambahan->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_tambahan" name="o<?php echo $gaji_grid->RowIndex ?>_tambahan" id="o<?php echo $gaji_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_grid->tambahan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_tambahan" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_tambahan" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_grid->tambahan->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_tambahan" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_tambahan" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_grid->tambahan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->periode->Visible) { // periode ?>
		<td data-name="periode" <?php echo $gaji_grid->periode->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_periode" class="form-group">
<input type="text" data-table="gaji" data-field="x_periode" name="x<?php echo $gaji_grid->RowIndex ?>_periode" id="x<?php echo $gaji_grid->RowIndex ?>_periode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->periode->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->periode->EditValue ?>"<?php echo $gaji_grid->periode->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_periode" name="o<?php echo $gaji_grid->RowIndex ?>_periode" id="o<?php echo $gaji_grid->RowIndex ?>_periode" value="<?php echo HtmlEncode($gaji_grid->periode->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_periode" class="form-group">
<input type="text" data-table="gaji" data-field="x_periode" name="x<?php echo $gaji_grid->RowIndex ?>_periode" id="x<?php echo $gaji_grid->RowIndex ?>_periode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->periode->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->periode->EditValue ?>"<?php echo $gaji_grid->periode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_periode">
<span<?php echo $gaji_grid->periode->viewAttributes() ?>><?php echo $gaji_grid->periode->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_periode" name="x<?php echo $gaji_grid->RowIndex ?>_periode" id="x<?php echo $gaji_grid->RowIndex ?>_periode" value="<?php echo HtmlEncode($gaji_grid->periode->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_periode" name="o<?php echo $gaji_grid->RowIndex ?>_periode" id="o<?php echo $gaji_grid->RowIndex ?>_periode" value="<?php echo HtmlEncode($gaji_grid->periode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_periode" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_periode" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_periode" value="<?php echo HtmlEncode($gaji_grid->periode->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_periode" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_periode" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_periode" value="<?php echo HtmlEncode($gaji_grid->periode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->tunjangan_periode->Visible) { // tunjangan_periode ?>
		<td data-name="tunjangan_periode" <?php echo $gaji_grid->tunjangan_periode->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_tunjangan_periode" class="form-group">
<input type="text" data-table="gaji" data-field="x_tunjangan_periode" name="x<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" id="x<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->tunjangan_periode->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->tunjangan_periode->EditValue ?>"<?php echo $gaji_grid->tunjangan_periode->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_tunjangan_periode" name="o<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" id="o<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" value="<?php echo HtmlEncode($gaji_grid->tunjangan_periode->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_tunjangan_periode" class="form-group">
<input type="text" data-table="gaji" data-field="x_tunjangan_periode" name="x<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" id="x<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->tunjangan_periode->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->tunjangan_periode->EditValue ?>"<?php echo $gaji_grid->tunjangan_periode->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_tunjangan_periode">
<span<?php echo $gaji_grid->tunjangan_periode->viewAttributes() ?>><?php echo $gaji_grid->tunjangan_periode->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_tunjangan_periode" name="x<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" id="x<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" value="<?php echo HtmlEncode($gaji_grid->tunjangan_periode->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_tunjangan_periode" name="o<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" id="o<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" value="<?php echo HtmlEncode($gaji_grid->tunjangan_periode->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_tunjangan_periode" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" value="<?php echo HtmlEncode($gaji_grid->tunjangan_periode->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_tunjangan_periode" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" value="<?php echo HtmlEncode($gaji_grid->tunjangan_periode->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran" <?php echo $gaji_grid->kehadiran->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_kehadiran" class="form-group">
<input type="text" data-table="gaji" data-field="x_kehadiran" name="x<?php echo $gaji_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_grid->RowIndex ?>_kehadiran" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->kehadiran->EditValue ?>"<?php echo $gaji_grid->kehadiran->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_kehadiran" name="o<?php echo $gaji_grid->RowIndex ?>_kehadiran" id="o<?php echo $gaji_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_grid->kehadiran->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_kehadiran" class="form-group">
<input type="text" data-table="gaji" data-field="x_kehadiran" name="x<?php echo $gaji_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_grid->RowIndex ?>_kehadiran" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->kehadiran->EditValue ?>"<?php echo $gaji_grid->kehadiran->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_kehadiran">
<span<?php echo $gaji_grid->kehadiran->viewAttributes() ?>><?php echo $gaji_grid->kehadiran->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_kehadiran" name="x<?php echo $gaji_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_grid->kehadiran->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_kehadiran" name="o<?php echo $gaji_grid->RowIndex ?>_kehadiran" id="o<?php echo $gaji_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_grid->kehadiran->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_kehadiran" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_kehadiran" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_grid->kehadiran->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_kehadiran" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_kehadiran" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_grid->kehadiran->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->value_kehadiran->Visible) { // value_kehadiran ?>
		<td data-name="value_kehadiran" <?php echo $gaji_grid->value_kehadiran->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_kehadiran" class="form-group">
<input type="text" data-table="gaji" data-field="x_value_kehadiran" name="x<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" id="x<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_kehadiran->EditValue ?>"<?php echo $gaji_grid->value_kehadiran->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_value_kehadiran" name="o<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" id="o<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" value="<?php echo HtmlEncode($gaji_grid->value_kehadiran->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_kehadiran" class="form-group">
<input type="text" data-table="gaji" data-field="x_value_kehadiran" name="x<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" id="x<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_kehadiran->EditValue ?>"<?php echo $gaji_grid->value_kehadiran->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_kehadiran">
<span<?php echo $gaji_grid->value_kehadiran->viewAttributes() ?>><?php echo $gaji_grid->value_kehadiran->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_value_kehadiran" name="x<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" id="x<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" value="<?php echo HtmlEncode($gaji_grid->value_kehadiran->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_value_kehadiran" name="o<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" id="o<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" value="<?php echo HtmlEncode($gaji_grid->value_kehadiran->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_value_kehadiran" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" value="<?php echo HtmlEncode($gaji_grid->value_kehadiran->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_value_kehadiran" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" value="<?php echo HtmlEncode($gaji_grid->value_kehadiran->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->jp->Visible) { // jp ?>
		<td data-name="jp" <?php echo $gaji_grid->jp->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_jp" class="form-group">
<input type="text" data-table="gaji" data-field="x_jp" name="x<?php echo $gaji_grid->RowIndex ?>_jp" id="x<?php echo $gaji_grid->RowIndex ?>_jp" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->jp->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->jp->EditValue ?>"<?php echo $gaji_grid->jp->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_jp" name="o<?php echo $gaji_grid->RowIndex ?>_jp" id="o<?php echo $gaji_grid->RowIndex ?>_jp" value="<?php echo HtmlEncode($gaji_grid->jp->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_jp" class="form-group">
<input type="text" data-table="gaji" data-field="x_jp" name="x<?php echo $gaji_grid->RowIndex ?>_jp" id="x<?php echo $gaji_grid->RowIndex ?>_jp" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->jp->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->jp->EditValue ?>"<?php echo $gaji_grid->jp->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_jp">
<span<?php echo $gaji_grid->jp->viewAttributes() ?>><?php echo $gaji_grid->jp->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_jp" name="x<?php echo $gaji_grid->RowIndex ?>_jp" id="x<?php echo $gaji_grid->RowIndex ?>_jp" value="<?php echo HtmlEncode($gaji_grid->jp->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_jp" name="o<?php echo $gaji_grid->RowIndex ?>_jp" id="o<?php echo $gaji_grid->RowIndex ?>_jp" value="<?php echo HtmlEncode($gaji_grid->jp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_jp" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_jp" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_jp" value="<?php echo HtmlEncode($gaji_grid->jp->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_jp" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_jp" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_jp" value="<?php echo HtmlEncode($gaji_grid->jp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->gapok->Visible) { // gapok ?>
		<td data-name="gapok" <?php echo $gaji_grid->gapok->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_gapok" class="form-group">
<input type="text" data-table="gaji" data-field="x_gapok" name="x<?php echo $gaji_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_grid->RowIndex ?>_gapok" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->gapok->EditValue ?>"<?php echo $gaji_grid->gapok->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_gapok" name="o<?php echo $gaji_grid->RowIndex ?>_gapok" id="o<?php echo $gaji_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_grid->gapok->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_gapok" class="form-group">
<input type="text" data-table="gaji" data-field="x_gapok" name="x<?php echo $gaji_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_grid->RowIndex ?>_gapok" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->gapok->EditValue ?>"<?php echo $gaji_grid->gapok->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_gapok">
<span<?php echo $gaji_grid->gapok->viewAttributes() ?>><?php echo $gaji_grid->gapok->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_gapok" name="x<?php echo $gaji_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_grid->gapok->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_gapok" name="o<?php echo $gaji_grid->RowIndex ?>_gapok" id="o<?php echo $gaji_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_grid->gapok->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_gapok" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_gapok" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_grid->gapok->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_gapok" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_gapok" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_grid->gapok->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->total_gapok->Visible) { // total_gapok ?>
		<td data-name="total_gapok" <?php echo $gaji_grid->total_gapok->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_total_gapok" class="form-group">
<input type="text" data-table="gaji" data-field="x_total_gapok" name="x<?php echo $gaji_grid->RowIndex ?>_total_gapok" id="x<?php echo $gaji_grid->RowIndex ?>_total_gapok" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->total_gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->total_gapok->EditValue ?>"<?php echo $gaji_grid->total_gapok->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_total_gapok" name="o<?php echo $gaji_grid->RowIndex ?>_total_gapok" id="o<?php echo $gaji_grid->RowIndex ?>_total_gapok" value="<?php echo HtmlEncode($gaji_grid->total_gapok->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_total_gapok" class="form-group">
<input type="text" data-table="gaji" data-field="x_total_gapok" name="x<?php echo $gaji_grid->RowIndex ?>_total_gapok" id="x<?php echo $gaji_grid->RowIndex ?>_total_gapok" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->total_gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->total_gapok->EditValue ?>"<?php echo $gaji_grid->total_gapok->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_total_gapok">
<span<?php echo $gaji_grid->total_gapok->viewAttributes() ?>><?php echo $gaji_grid->total_gapok->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_total_gapok" name="x<?php echo $gaji_grid->RowIndex ?>_total_gapok" id="x<?php echo $gaji_grid->RowIndex ?>_total_gapok" value="<?php echo HtmlEncode($gaji_grid->total_gapok->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_total_gapok" name="o<?php echo $gaji_grid->RowIndex ?>_total_gapok" id="o<?php echo $gaji_grid->RowIndex ?>_total_gapok" value="<?php echo HtmlEncode($gaji_grid->total_gapok->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_total_gapok" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_total_gapok" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_total_gapok" value="<?php echo HtmlEncode($gaji_grid->total_gapok->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_total_gapok" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_total_gapok" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_total_gapok" value="<?php echo HtmlEncode($gaji_grid->total_gapok->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->lembur->Visible) { // lembur ?>
		<td data-name="lembur" <?php echo $gaji_grid->lembur->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_lembur" class="form-group">
<input type="text" data-table="gaji" data-field="x_lembur" name="x<?php echo $gaji_grid->RowIndex ?>_lembur" id="x<?php echo $gaji_grid->RowIndex ?>_lembur" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->lembur->EditValue ?>"<?php echo $gaji_grid->lembur->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_lembur" name="o<?php echo $gaji_grid->RowIndex ?>_lembur" id="o<?php echo $gaji_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gaji_grid->lembur->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_lembur" class="form-group">
<input type="text" data-table="gaji" data-field="x_lembur" name="x<?php echo $gaji_grid->RowIndex ?>_lembur" id="x<?php echo $gaji_grid->RowIndex ?>_lembur" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->lembur->EditValue ?>"<?php echo $gaji_grid->lembur->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_lembur">
<span<?php echo $gaji_grid->lembur->viewAttributes() ?>><?php echo $gaji_grid->lembur->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_lembur" name="x<?php echo $gaji_grid->RowIndex ?>_lembur" id="x<?php echo $gaji_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gaji_grid->lembur->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_lembur" name="o<?php echo $gaji_grid->RowIndex ?>_lembur" id="o<?php echo $gaji_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gaji_grid->lembur->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_lembur" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_lembur" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gaji_grid->lembur->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_lembur" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_lembur" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gaji_grid->lembur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->value_lembur->Visible) { // value_lembur ?>
		<td data-name="value_lembur" <?php echo $gaji_grid->value_lembur->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_lembur" class="form-group">
<input type="text" data-table="gaji" data-field="x_value_lembur" name="x<?php echo $gaji_grid->RowIndex ?>_value_lembur" id="x<?php echo $gaji_grid->RowIndex ?>_value_lembur" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_lembur->EditValue ?>"<?php echo $gaji_grid->value_lembur->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_value_lembur" name="o<?php echo $gaji_grid->RowIndex ?>_value_lembur" id="o<?php echo $gaji_grid->RowIndex ?>_value_lembur" value="<?php echo HtmlEncode($gaji_grid->value_lembur->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_lembur" class="form-group">
<input type="text" data-table="gaji" data-field="x_value_lembur" name="x<?php echo $gaji_grid->RowIndex ?>_value_lembur" id="x<?php echo $gaji_grid->RowIndex ?>_value_lembur" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_lembur->EditValue ?>"<?php echo $gaji_grid->value_lembur->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_lembur">
<span<?php echo $gaji_grid->value_lembur->viewAttributes() ?>><?php echo $gaji_grid->value_lembur->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_value_lembur" name="x<?php echo $gaji_grid->RowIndex ?>_value_lembur" id="x<?php echo $gaji_grid->RowIndex ?>_value_lembur" value="<?php echo HtmlEncode($gaji_grid->value_lembur->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_value_lembur" name="o<?php echo $gaji_grid->RowIndex ?>_value_lembur" id="o<?php echo $gaji_grid->RowIndex ?>_value_lembur" value="<?php echo HtmlEncode($gaji_grid->value_lembur->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_value_lembur" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_value_lembur" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_value_lembur" value="<?php echo HtmlEncode($gaji_grid->value_lembur->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_value_lembur" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_value_lembur" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_value_lembur" value="<?php echo HtmlEncode($gaji_grid->value_lembur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->value_reward->Visible) { // value_reward ?>
		<td data-name="value_reward" <?php echo $gaji_grid->value_reward->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_reward" class="form-group">
<input type="text" data-table="gaji" data-field="x_value_reward" name="x<?php echo $gaji_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_grid->RowIndex ?>_value_reward" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_reward->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_reward->EditValue ?>"<?php echo $gaji_grid->value_reward->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_value_reward" name="o<?php echo $gaji_grid->RowIndex ?>_value_reward" id="o<?php echo $gaji_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_grid->value_reward->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_reward" class="form-group">
<input type="text" data-table="gaji" data-field="x_value_reward" name="x<?php echo $gaji_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_grid->RowIndex ?>_value_reward" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_reward->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_reward->EditValue ?>"<?php echo $gaji_grid->value_reward->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_reward">
<span<?php echo $gaji_grid->value_reward->viewAttributes() ?>><?php echo $gaji_grid->value_reward->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_value_reward" name="x<?php echo $gaji_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_grid->value_reward->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_value_reward" name="o<?php echo $gaji_grid->RowIndex ?>_value_reward" id="o<?php echo $gaji_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_grid->value_reward->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_value_reward" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_value_reward" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_grid->value_reward->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_value_reward" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_value_reward" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_grid->value_reward->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->value_inval->Visible) { // value_inval ?>
		<td data-name="value_inval" <?php echo $gaji_grid->value_inval->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_inval" class="form-group">
<input type="text" data-table="gaji" data-field="x_value_inval" name="x<?php echo $gaji_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_grid->RowIndex ?>_value_inval" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_inval->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_inval->EditValue ?>"<?php echo $gaji_grid->value_inval->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_value_inval" name="o<?php echo $gaji_grid->RowIndex ?>_value_inval" id="o<?php echo $gaji_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_grid->value_inval->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_inval" class="form-group">
<input type="text" data-table="gaji" data-field="x_value_inval" name="x<?php echo $gaji_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_grid->RowIndex ?>_value_inval" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_inval->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_inval->EditValue ?>"<?php echo $gaji_grid->value_inval->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_inval">
<span<?php echo $gaji_grid->value_inval->viewAttributes() ?>><?php echo $gaji_grid->value_inval->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_value_inval" name="x<?php echo $gaji_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_grid->value_inval->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_value_inval" name="o<?php echo $gaji_grid->RowIndex ?>_value_inval" id="o<?php echo $gaji_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_grid->value_inval->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_value_inval" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_value_inval" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_grid->value_inval->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_value_inval" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_value_inval" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_grid->value_inval->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->piket_count->Visible) { // piket_count ?>
		<td data-name="piket_count" <?php echo $gaji_grid->piket_count->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_piket_count" class="form-group">
<input type="text" data-table="gaji" data-field="x_piket_count" name="x<?php echo $gaji_grid->RowIndex ?>_piket_count" id="x<?php echo $gaji_grid->RowIndex ?>_piket_count" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->piket_count->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->piket_count->EditValue ?>"<?php echo $gaji_grid->piket_count->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_piket_count" name="o<?php echo $gaji_grid->RowIndex ?>_piket_count" id="o<?php echo $gaji_grid->RowIndex ?>_piket_count" value="<?php echo HtmlEncode($gaji_grid->piket_count->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_piket_count" class="form-group">
<input type="text" data-table="gaji" data-field="x_piket_count" name="x<?php echo $gaji_grid->RowIndex ?>_piket_count" id="x<?php echo $gaji_grid->RowIndex ?>_piket_count" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->piket_count->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->piket_count->EditValue ?>"<?php echo $gaji_grid->piket_count->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_piket_count">
<span<?php echo $gaji_grid->piket_count->viewAttributes() ?>><?php echo $gaji_grid->piket_count->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_piket_count" name="x<?php echo $gaji_grid->RowIndex ?>_piket_count" id="x<?php echo $gaji_grid->RowIndex ?>_piket_count" value="<?php echo HtmlEncode($gaji_grid->piket_count->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_piket_count" name="o<?php echo $gaji_grid->RowIndex ?>_piket_count" id="o<?php echo $gaji_grid->RowIndex ?>_piket_count" value="<?php echo HtmlEncode($gaji_grid->piket_count->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_piket_count" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_piket_count" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_piket_count" value="<?php echo HtmlEncode($gaji_grid->piket_count->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_piket_count" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_piket_count" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_piket_count" value="<?php echo HtmlEncode($gaji_grid->piket_count->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->value_piket->Visible) { // value_piket ?>
		<td data-name="value_piket" <?php echo $gaji_grid->value_piket->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_piket" class="form-group">
<input type="text" data-table="gaji" data-field="x_value_piket" name="x<?php echo $gaji_grid->RowIndex ?>_value_piket" id="x<?php echo $gaji_grid->RowIndex ?>_value_piket" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_piket->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_piket->EditValue ?>"<?php echo $gaji_grid->value_piket->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_value_piket" name="o<?php echo $gaji_grid->RowIndex ?>_value_piket" id="o<?php echo $gaji_grid->RowIndex ?>_value_piket" value="<?php echo HtmlEncode($gaji_grid->value_piket->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_piket" class="form-group">
<input type="text" data-table="gaji" data-field="x_value_piket" name="x<?php echo $gaji_grid->RowIndex ?>_value_piket" id="x<?php echo $gaji_grid->RowIndex ?>_value_piket" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_piket->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_piket->EditValue ?>"<?php echo $gaji_grid->value_piket->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_value_piket">
<span<?php echo $gaji_grid->value_piket->viewAttributes() ?>><?php echo $gaji_grid->value_piket->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_value_piket" name="x<?php echo $gaji_grid->RowIndex ?>_value_piket" id="x<?php echo $gaji_grid->RowIndex ?>_value_piket" value="<?php echo HtmlEncode($gaji_grid->value_piket->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_value_piket" name="o<?php echo $gaji_grid->RowIndex ?>_value_piket" id="o<?php echo $gaji_grid->RowIndex ?>_value_piket" value="<?php echo HtmlEncode($gaji_grid->value_piket->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_value_piket" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_value_piket" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_value_piket" value="<?php echo HtmlEncode($gaji_grid->value_piket->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_value_piket" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_value_piket" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_value_piket" value="<?php echo HtmlEncode($gaji_grid->value_piket->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->tugastambahan->Visible) { // tugastambahan ?>
		<td data-name="tugastambahan" <?php echo $gaji_grid->tugastambahan->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_tugastambahan" class="form-group">
<input type="text" data-table="gaji" data-field="x_tugastambahan" name="x<?php echo $gaji_grid->RowIndex ?>_tugastambahan" id="x<?php echo $gaji_grid->RowIndex ?>_tugastambahan" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->tugastambahan->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->tugastambahan->EditValue ?>"<?php echo $gaji_grid->tugastambahan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_tugastambahan" name="o<?php echo $gaji_grid->RowIndex ?>_tugastambahan" id="o<?php echo $gaji_grid->RowIndex ?>_tugastambahan" value="<?php echo HtmlEncode($gaji_grid->tugastambahan->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_tugastambahan" class="form-group">
<input type="text" data-table="gaji" data-field="x_tugastambahan" name="x<?php echo $gaji_grid->RowIndex ?>_tugastambahan" id="x<?php echo $gaji_grid->RowIndex ?>_tugastambahan" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->tugastambahan->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->tugastambahan->EditValue ?>"<?php echo $gaji_grid->tugastambahan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_tugastambahan">
<span<?php echo $gaji_grid->tugastambahan->viewAttributes() ?>><?php echo $gaji_grid->tugastambahan->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_tugastambahan" name="x<?php echo $gaji_grid->RowIndex ?>_tugastambahan" id="x<?php echo $gaji_grid->RowIndex ?>_tugastambahan" value="<?php echo HtmlEncode($gaji_grid->tugastambahan->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_tugastambahan" name="o<?php echo $gaji_grid->RowIndex ?>_tugastambahan" id="o<?php echo $gaji_grid->RowIndex ?>_tugastambahan" value="<?php echo HtmlEncode($gaji_grid->tugastambahan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_tugastambahan" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_tugastambahan" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_tugastambahan" value="<?php echo HtmlEncode($gaji_grid->tugastambahan->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_tugastambahan" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_tugastambahan" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_tugastambahan" value="<?php echo HtmlEncode($gaji_grid->tugastambahan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->tj_jabatan->Visible) { // tj_jabatan ?>
		<td data-name="tj_jabatan" <?php echo $gaji_grid->tj_jabatan->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_tj_jabatan" class="form-group">
<input type="text" data-table="gaji" data-field="x_tj_jabatan" name="x<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" id="x<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->tj_jabatan->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->tj_jabatan->EditValue ?>"<?php echo $gaji_grid->tj_jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_tj_jabatan" name="o<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" id="o<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" value="<?php echo HtmlEncode($gaji_grid->tj_jabatan->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_tj_jabatan" class="form-group">
<input type="text" data-table="gaji" data-field="x_tj_jabatan" name="x<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" id="x<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->tj_jabatan->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->tj_jabatan->EditValue ?>"<?php echo $gaji_grid->tj_jabatan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_tj_jabatan">
<span<?php echo $gaji_grid->tj_jabatan->viewAttributes() ?>><?php echo $gaji_grid->tj_jabatan->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_tj_jabatan" name="x<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" id="x<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" value="<?php echo HtmlEncode($gaji_grid->tj_jabatan->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_tj_jabatan" name="o<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" id="o<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" value="<?php echo HtmlEncode($gaji_grid->tj_jabatan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_tj_jabatan" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" value="<?php echo HtmlEncode($gaji_grid->tj_jabatan->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_tj_jabatan" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" value="<?php echo HtmlEncode($gaji_grid->tj_jabatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->sub_total->Visible) { // sub_total ?>
		<td data-name="sub_total" <?php echo $gaji_grid->sub_total->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_sub_total" class="form-group">
<input type="text" data-table="gaji" data-field="x_sub_total" name="x<?php echo $gaji_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_grid->RowIndex ?>_sub_total" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->sub_total->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->sub_total->EditValue ?>"<?php echo $gaji_grid->sub_total->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_sub_total" name="o<?php echo $gaji_grid->RowIndex ?>_sub_total" id="o<?php echo $gaji_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_grid->sub_total->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_sub_total" class="form-group">
<input type="text" data-table="gaji" data-field="x_sub_total" name="x<?php echo $gaji_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_grid->RowIndex ?>_sub_total" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->sub_total->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->sub_total->EditValue ?>"<?php echo $gaji_grid->sub_total->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_sub_total">
<span<?php echo $gaji_grid->sub_total->viewAttributes() ?>><?php echo $gaji_grid->sub_total->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_sub_total" name="x<?php echo $gaji_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_grid->sub_total->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_sub_total" name="o<?php echo $gaji_grid->RowIndex ?>_sub_total" id="o<?php echo $gaji_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_grid->sub_total->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_sub_total" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_sub_total" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_grid->sub_total->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_sub_total" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_sub_total" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_grid->sub_total->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->potongan->Visible) { // potongan ?>
		<td data-name="potongan" <?php echo $gaji_grid->potongan->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_potongan" class="form-group">
<input type="text" data-table="gaji" data-field="x_potongan" name="x<?php echo $gaji_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_grid->RowIndex ?>_potongan" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->potongan->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->potongan->EditValue ?>"<?php echo $gaji_grid->potongan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_potongan" name="o<?php echo $gaji_grid->RowIndex ?>_potongan" id="o<?php echo $gaji_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_grid->potongan->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_potongan" class="form-group">
<input type="text" data-table="gaji" data-field="x_potongan" name="x<?php echo $gaji_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_grid->RowIndex ?>_potongan" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->potongan->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->potongan->EditValue ?>"<?php echo $gaji_grid->potongan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_potongan">
<span<?php echo $gaji_grid->potongan->viewAttributes() ?>><?php echo $gaji_grid->potongan->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_potongan" name="x<?php echo $gaji_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_grid->potongan->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_potongan" name="o<?php echo $gaji_grid->RowIndex ?>_potongan" id="o<?php echo $gaji_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_grid->potongan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_potongan" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_potongan" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_grid->potongan->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_potongan" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_potongan" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_grid->potongan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->penyesuaian->Visible) { // penyesuaian ?>
		<td data-name="penyesuaian" <?php echo $gaji_grid->penyesuaian->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_penyesuaian" class="form-group">
<input type="text" data-table="gaji" data-field="x_penyesuaian" name="x<?php echo $gaji_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_grid->RowIndex ?>_penyesuaian" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->penyesuaian->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->penyesuaian->EditValue ?>"<?php echo $gaji_grid->penyesuaian->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_penyesuaian" name="o<?php echo $gaji_grid->RowIndex ?>_penyesuaian" id="o<?php echo $gaji_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_grid->penyesuaian->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_penyesuaian" class="form-group">
<input type="text" data-table="gaji" data-field="x_penyesuaian" name="x<?php echo $gaji_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_grid->RowIndex ?>_penyesuaian" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->penyesuaian->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->penyesuaian->EditValue ?>"<?php echo $gaji_grid->penyesuaian->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_penyesuaian">
<span<?php echo $gaji_grid->penyesuaian->viewAttributes() ?>><?php echo $gaji_grid->penyesuaian->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_penyesuaian" name="x<?php echo $gaji_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_grid->penyesuaian->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_penyesuaian" name="o<?php echo $gaji_grid->RowIndex ?>_penyesuaian" id="o<?php echo $gaji_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_grid->penyesuaian->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_penyesuaian" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_penyesuaian" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_grid->penyesuaian->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_penyesuaian" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_penyesuaian" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_grid->penyesuaian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gaji_grid->total->Visible) { // total ?>
		<td data-name="total" <?php echo $gaji_grid->total->cellAttributes() ?>>
<?php if ($gaji->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_total" class="form-group">
<input type="text" data-table="gaji" data-field="x_total" name="x<?php echo $gaji_grid->RowIndex ?>_total" id="x<?php echo $gaji_grid->RowIndex ?>_total" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->total->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->total->EditValue ?>"<?php echo $gaji_grid->total->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_total" name="o<?php echo $gaji_grid->RowIndex ?>_total" id="o<?php echo $gaji_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_grid->total->OldValue) ?>">
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_total" class="form-group">
<input type="text" data-table="gaji" data-field="x_total" name="x<?php echo $gaji_grid->RowIndex ?>_total" id="x<?php echo $gaji_grid->RowIndex ?>_total" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->total->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->total->EditValue ?>"<?php echo $gaji_grid->total->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gaji->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gaji_grid->RowCount ?>_gaji_total">
<span<?php echo $gaji_grid->total->viewAttributes() ?>><?php echo $gaji_grid->total->getViewValue() ?></span>
</span>
<?php if (!$gaji->isConfirm()) { ?>
<input type="hidden" data-table="gaji" data-field="x_total" name="x<?php echo $gaji_grid->RowIndex ?>_total" id="x<?php echo $gaji_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_grid->total->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_total" name="o<?php echo $gaji_grid->RowIndex ?>_total" id="o<?php echo $gaji_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_grid->total->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gaji" data-field="x_total" name="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_total" id="fgajigrid$x<?php echo $gaji_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_grid->total->FormValue) ?>">
<input type="hidden" data-table="gaji" data-field="x_total" name="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_total" id="fgajigrid$o<?php echo $gaji_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_grid->total->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gaji_grid->ListOptions->render("body", "right", $gaji_grid->RowCount);
?>
	</tr>
<?php if ($gaji->RowType == ROWTYPE_ADD || $gaji->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fgajigrid", "load"], function() {
	fgajigrid.updateLists(<?php echo $gaji_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$gaji_grid->isGridAdd() || $gaji->CurrentMode == "copy")
		if (!$gaji_grid->Recordset->EOF)
			$gaji_grid->Recordset->moveNext();
}
?>
<?php
	if ($gaji->CurrentMode == "add" || $gaji->CurrentMode == "copy" || $gaji->CurrentMode == "edit") {
		$gaji_grid->RowIndex = '$rowindex$';
		$gaji_grid->loadRowValues();

		// Set row properties
		$gaji->resetAttributes();
		$gaji->RowAttrs->merge(["data-rowindex" => $gaji_grid->RowIndex, "id" => "r0_gaji", "data-rowtype" => ROWTYPE_ADD]);
		$gaji->RowAttrs->appendClass("ew-template");
		$gaji->RowType = ROWTYPE_ADD;

		// Render row
		$gaji_grid->renderRow();

		// Render list options
		$gaji_grid->renderListOptions();
		$gaji_grid->StartRowCount = 0;
?>
	<tr <?php echo $gaji->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gaji_grid->ListOptions->render("body", "left", $gaji_grid->RowIndex);
?>
	<?php if ($gaji_grid->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_pegawai" class="form-group gaji_pegawai">
<?php $gaji_grid->pegawai->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gaji_grid->RowIndex ?>_pegawai"><?php echo EmptyValue(strval($gaji_grid->pegawai->ViewValue)) ? $Language->phrase("PleaseSelect") : $gaji_grid->pegawai->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gaji_grid->pegawai->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gaji_grid->pegawai->ReadOnly || $gaji_grid->pegawai->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gaji_grid->RowIndex ?>_pegawai',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gaji_grid->pegawai->Lookup->getParamTag($gaji_grid, "p_x" . $gaji_grid->RowIndex . "_pegawai") ?>
<input type="hidden" data-table="gaji" data-field="x_pegawai" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gaji_grid->pegawai->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_grid->RowIndex ?>_pegawai" value="<?php echo $gaji_grid->pegawai->CurrentValue ?>"<?php echo $gaji_grid->pegawai->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_pegawai" class="form-group gaji_pegawai">
<span<?php echo $gaji_grid->pegawai->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->pegawai->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_pegawai" name="x<?php echo $gaji_grid->RowIndex ?>_pegawai" id="x<?php echo $gaji_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_grid->pegawai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_pegawai" name="o<?php echo $gaji_grid->RowIndex ?>_pegawai" id="o<?php echo $gaji_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($gaji_grid->pegawai->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->jenjang_id->Visible) { // jenjang_id ?>
		<td data-name="jenjang_id">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_jenjang_id" class="form-group gaji_jenjang_id">
<?php
$onchange = $gaji_grid->jenjang_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_grid->jenjang_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_grid->RowIndex ?>_jenjang_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" id="sv_x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" value="<?php echo RemoveHtml($gaji_grid->jenjang_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->jenjang_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_grid->jenjang_id->getPlaceHolder()) ?>"<?php echo $gaji_grid->jenjang_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_jenjang_id" data-value-separator="<?php echo $gaji_grid->jenjang_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_grid->jenjang_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgajigrid"], function() {
	fgajigrid.createAutoSuggest({"id":"x<?php echo $gaji_grid->RowIndex ?>_jenjang_id","forceSelect":false});
});
</script>
<?php echo $gaji_grid->jenjang_id->Lookup->getParamTag($gaji_grid, "p_x" . $gaji_grid->RowIndex . "_jenjang_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_jenjang_id" class="form-group gaji_jenjang_id">
<span<?php echo $gaji_grid->jenjang_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->jenjang_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_jenjang_id" name="x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" id="x<?php echo $gaji_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_grid->jenjang_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_jenjang_id" name="o<?php echo $gaji_grid->RowIndex ?>_jenjang_id" id="o<?php echo $gaji_grid->RowIndex ?>_jenjang_id" value="<?php echo HtmlEncode($gaji_grid->jenjang_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_jabatan_id" class="form-group gaji_jabatan_id">
<?php
$onchange = $gaji_grid->jabatan_id->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gaji_grid->jabatan_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gaji_grid->RowIndex ?>_jabatan_id">
	<input type="text" class="form-control" name="sv_x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" id="sv_x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" value="<?php echo RemoveHtml($gaji_grid->jabatan_id->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->jabatan_id->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gaji_grid->jabatan_id->getPlaceHolder()) ?>"<?php echo $gaji_grid->jabatan_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gaji" data-field="x_jabatan_id" data-value-separator="<?php echo $gaji_grid->jabatan_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_grid->jabatan_id->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgajigrid"], function() {
	fgajigrid.createAutoSuggest({"id":"x<?php echo $gaji_grid->RowIndex ?>_jabatan_id","forceSelect":false});
});
</script>
<?php echo $gaji_grid->jabatan_id->Lookup->getParamTag($gaji_grid, "p_x" . $gaji_grid->RowIndex . "_jabatan_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_jabatan_id" class="form-group gaji_jabatan_id">
<span<?php echo $gaji_grid->jabatan_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->jabatan_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_jabatan_id" name="x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gaji_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_grid->jabatan_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_jabatan_id" name="o<?php echo $gaji_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gaji_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gaji_grid->jabatan_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->lama_kerja->Visible) { // lama_kerja ?>
		<td data-name="lama_kerja">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_lama_kerja" class="form-group gaji_lama_kerja">
<input type="text" data-table="gaji" data-field="x_lama_kerja" name="x<?php echo $gaji_grid->RowIndex ?>_lama_kerja" id="x<?php echo $gaji_grid->RowIndex ?>_lama_kerja" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->lama_kerja->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->lama_kerja->EditValue ?>"<?php echo $gaji_grid->lama_kerja->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_lama_kerja" class="form-group gaji_lama_kerja">
<span<?php echo $gaji_grid->lama_kerja->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->lama_kerja->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_lama_kerja" name="x<?php echo $gaji_grid->RowIndex ?>_lama_kerja" id="x<?php echo $gaji_grid->RowIndex ?>_lama_kerja" value="<?php echo HtmlEncode($gaji_grid->lama_kerja->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_lama_kerja" name="o<?php echo $gaji_grid->RowIndex ?>_lama_kerja" id="o<?php echo $gaji_grid->RowIndex ?>_lama_kerja" value="<?php echo HtmlEncode($gaji_grid->lama_kerja->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->type->Visible) { // type ?>
		<td data-name="type">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_type" class="form-group gaji_type">
<input type="text" data-table="gaji" data-field="x_type" name="x<?php echo $gaji_grid->RowIndex ?>_type" id="x<?php echo $gaji_grid->RowIndex ?>_type" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_grid->type->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->type->EditValue ?>"<?php echo $gaji_grid->type->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_type" class="form-group gaji_type">
<span<?php echo $gaji_grid->type->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->type->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_type" name="x<?php echo $gaji_grid->RowIndex ?>_type" id="x<?php echo $gaji_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($gaji_grid->type->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_type" name="o<?php echo $gaji_grid->RowIndex ?>_type" id="o<?php echo $gaji_grid->RowIndex ?>_type" value="<?php echo HtmlEncode($gaji_grid->type->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->jenis_guru->Visible) { // jenis_guru ?>
		<td data-name="jenis_guru">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_jenis_guru" class="form-group gaji_jenis_guru">
<input type="text" data-table="gaji" data-field="x_jenis_guru" name="x<?php echo $gaji_grid->RowIndex ?>_jenis_guru" id="x<?php echo $gaji_grid->RowIndex ?>_jenis_guru" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_grid->jenis_guru->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->jenis_guru->EditValue ?>"<?php echo $gaji_grid->jenis_guru->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_jenis_guru" class="form-group gaji_jenis_guru">
<span<?php echo $gaji_grid->jenis_guru->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->jenis_guru->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_jenis_guru" name="x<?php echo $gaji_grid->RowIndex ?>_jenis_guru" id="x<?php echo $gaji_grid->RowIndex ?>_jenis_guru" value="<?php echo HtmlEncode($gaji_grid->jenis_guru->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_jenis_guru" name="o<?php echo $gaji_grid->RowIndex ?>_jenis_guru" id="o<?php echo $gaji_grid->RowIndex ?>_jenis_guru" value="<?php echo HtmlEncode($gaji_grid->jenis_guru->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->tambahan->Visible) { // tambahan ?>
		<td data-name="tambahan">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tambahan" class="form-group gaji_tambahan">
<input type="text" data-table="gaji" data-field="x_tambahan" name="x<?php echo $gaji_grid->RowIndex ?>_tambahan" id="x<?php echo $gaji_grid->RowIndex ?>_tambahan" size="30" maxlength="10" placeholder="<?php echo HtmlEncode($gaji_grid->tambahan->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->tambahan->EditValue ?>"<?php echo $gaji_grid->tambahan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tambahan" class="form-group gaji_tambahan">
<span<?php echo $gaji_grid->tambahan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->tambahan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_tambahan" name="x<?php echo $gaji_grid->RowIndex ?>_tambahan" id="x<?php echo $gaji_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_grid->tambahan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_tambahan" name="o<?php echo $gaji_grid->RowIndex ?>_tambahan" id="o<?php echo $gaji_grid->RowIndex ?>_tambahan" value="<?php echo HtmlEncode($gaji_grid->tambahan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->periode->Visible) { // periode ?>
		<td data-name="periode">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_periode" class="form-group gaji_periode">
<input type="text" data-table="gaji" data-field="x_periode" name="x<?php echo $gaji_grid->RowIndex ?>_periode" id="x<?php echo $gaji_grid->RowIndex ?>_periode" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->periode->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->periode->EditValue ?>"<?php echo $gaji_grid->periode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_periode" class="form-group gaji_periode">
<span<?php echo $gaji_grid->periode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->periode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_periode" name="x<?php echo $gaji_grid->RowIndex ?>_periode" id="x<?php echo $gaji_grid->RowIndex ?>_periode" value="<?php echo HtmlEncode($gaji_grid->periode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_periode" name="o<?php echo $gaji_grid->RowIndex ?>_periode" id="o<?php echo $gaji_grid->RowIndex ?>_periode" value="<?php echo HtmlEncode($gaji_grid->periode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->tunjangan_periode->Visible) { // tunjangan_periode ?>
		<td data-name="tunjangan_periode">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tunjangan_periode" class="form-group gaji_tunjangan_periode">
<input type="text" data-table="gaji" data-field="x_tunjangan_periode" name="x<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" id="x<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->tunjangan_periode->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->tunjangan_periode->EditValue ?>"<?php echo $gaji_grid->tunjangan_periode->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tunjangan_periode" class="form-group gaji_tunjangan_periode">
<span<?php echo $gaji_grid->tunjangan_periode->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->tunjangan_periode->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_tunjangan_periode" name="x<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" id="x<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" value="<?php echo HtmlEncode($gaji_grid->tunjangan_periode->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_tunjangan_periode" name="o<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" id="o<?php echo $gaji_grid->RowIndex ?>_tunjangan_periode" value="<?php echo HtmlEncode($gaji_grid->tunjangan_periode->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_kehadiran" class="form-group gaji_kehadiran">
<input type="text" data-table="gaji" data-field="x_kehadiran" name="x<?php echo $gaji_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_grid->RowIndex ?>_kehadiran" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->kehadiran->EditValue ?>"<?php echo $gaji_grid->kehadiran->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_kehadiran" class="form-group gaji_kehadiran">
<span<?php echo $gaji_grid->kehadiran->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->kehadiran->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_kehadiran" name="x<?php echo $gaji_grid->RowIndex ?>_kehadiran" id="x<?php echo $gaji_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_grid->kehadiran->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_kehadiran" name="o<?php echo $gaji_grid->RowIndex ?>_kehadiran" id="o<?php echo $gaji_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gaji_grid->kehadiran->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->value_kehadiran->Visible) { // value_kehadiran ?>
		<td data-name="value_kehadiran">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_value_kehadiran" class="form-group gaji_value_kehadiran">
<input type="text" data-table="gaji" data-field="x_value_kehadiran" name="x<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" id="x<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_kehadiran->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_kehadiran->EditValue ?>"<?php echo $gaji_grid->value_kehadiran->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_value_kehadiran" class="form-group gaji_value_kehadiran">
<span<?php echo $gaji_grid->value_kehadiran->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->value_kehadiran->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_value_kehadiran" name="x<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" id="x<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" value="<?php echo HtmlEncode($gaji_grid->value_kehadiran->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_value_kehadiran" name="o<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" id="o<?php echo $gaji_grid->RowIndex ?>_value_kehadiran" value="<?php echo HtmlEncode($gaji_grid->value_kehadiran->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->jp->Visible) { // jp ?>
		<td data-name="jp">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_jp" class="form-group gaji_jp">
<input type="text" data-table="gaji" data-field="x_jp" name="x<?php echo $gaji_grid->RowIndex ?>_jp" id="x<?php echo $gaji_grid->RowIndex ?>_jp" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->jp->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->jp->EditValue ?>"<?php echo $gaji_grid->jp->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_jp" class="form-group gaji_jp">
<span<?php echo $gaji_grid->jp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->jp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_jp" name="x<?php echo $gaji_grid->RowIndex ?>_jp" id="x<?php echo $gaji_grid->RowIndex ?>_jp" value="<?php echo HtmlEncode($gaji_grid->jp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_jp" name="o<?php echo $gaji_grid->RowIndex ?>_jp" id="o<?php echo $gaji_grid->RowIndex ?>_jp" value="<?php echo HtmlEncode($gaji_grid->jp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->gapok->Visible) { // gapok ?>
		<td data-name="gapok">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_gapok" class="form-group gaji_gapok">
<input type="text" data-table="gaji" data-field="x_gapok" name="x<?php echo $gaji_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_grid->RowIndex ?>_gapok" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->gapok->EditValue ?>"<?php echo $gaji_grid->gapok->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_gapok" class="form-group gaji_gapok">
<span<?php echo $gaji_grid->gapok->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->gapok->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_gapok" name="x<?php echo $gaji_grid->RowIndex ?>_gapok" id="x<?php echo $gaji_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_grid->gapok->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_gapok" name="o<?php echo $gaji_grid->RowIndex ?>_gapok" id="o<?php echo $gaji_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gaji_grid->gapok->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->total_gapok->Visible) { // total_gapok ?>
		<td data-name="total_gapok">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_total_gapok" class="form-group gaji_total_gapok">
<input type="text" data-table="gaji" data-field="x_total_gapok" name="x<?php echo $gaji_grid->RowIndex ?>_total_gapok" id="x<?php echo $gaji_grid->RowIndex ?>_total_gapok" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->total_gapok->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->total_gapok->EditValue ?>"<?php echo $gaji_grid->total_gapok->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_total_gapok" class="form-group gaji_total_gapok">
<span<?php echo $gaji_grid->total_gapok->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->total_gapok->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_total_gapok" name="x<?php echo $gaji_grid->RowIndex ?>_total_gapok" id="x<?php echo $gaji_grid->RowIndex ?>_total_gapok" value="<?php echo HtmlEncode($gaji_grid->total_gapok->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_total_gapok" name="o<?php echo $gaji_grid->RowIndex ?>_total_gapok" id="o<?php echo $gaji_grid->RowIndex ?>_total_gapok" value="<?php echo HtmlEncode($gaji_grid->total_gapok->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->lembur->Visible) { // lembur ?>
		<td data-name="lembur">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_lembur" class="form-group gaji_lembur">
<input type="text" data-table="gaji" data-field="x_lembur" name="x<?php echo $gaji_grid->RowIndex ?>_lembur" id="x<?php echo $gaji_grid->RowIndex ?>_lembur" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->lembur->EditValue ?>"<?php echo $gaji_grid->lembur->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_lembur" class="form-group gaji_lembur">
<span<?php echo $gaji_grid->lembur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->lembur->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_lembur" name="x<?php echo $gaji_grid->RowIndex ?>_lembur" id="x<?php echo $gaji_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gaji_grid->lembur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_lembur" name="o<?php echo $gaji_grid->RowIndex ?>_lembur" id="o<?php echo $gaji_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gaji_grid->lembur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->value_lembur->Visible) { // value_lembur ?>
		<td data-name="value_lembur">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_value_lembur" class="form-group gaji_value_lembur">
<input type="text" data-table="gaji" data-field="x_value_lembur" name="x<?php echo $gaji_grid->RowIndex ?>_value_lembur" id="x<?php echo $gaji_grid->RowIndex ?>_value_lembur" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_lembur->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_lembur->EditValue ?>"<?php echo $gaji_grid->value_lembur->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_value_lembur" class="form-group gaji_value_lembur">
<span<?php echo $gaji_grid->value_lembur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->value_lembur->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_value_lembur" name="x<?php echo $gaji_grid->RowIndex ?>_value_lembur" id="x<?php echo $gaji_grid->RowIndex ?>_value_lembur" value="<?php echo HtmlEncode($gaji_grid->value_lembur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_value_lembur" name="o<?php echo $gaji_grid->RowIndex ?>_value_lembur" id="o<?php echo $gaji_grid->RowIndex ?>_value_lembur" value="<?php echo HtmlEncode($gaji_grid->value_lembur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->value_reward->Visible) { // value_reward ?>
		<td data-name="value_reward">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_value_reward" class="form-group gaji_value_reward">
<input type="text" data-table="gaji" data-field="x_value_reward" name="x<?php echo $gaji_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_grid->RowIndex ?>_value_reward" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_reward->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_reward->EditValue ?>"<?php echo $gaji_grid->value_reward->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_value_reward" class="form-group gaji_value_reward">
<span<?php echo $gaji_grid->value_reward->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->value_reward->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_value_reward" name="x<?php echo $gaji_grid->RowIndex ?>_value_reward" id="x<?php echo $gaji_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_grid->value_reward->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_value_reward" name="o<?php echo $gaji_grid->RowIndex ?>_value_reward" id="o<?php echo $gaji_grid->RowIndex ?>_value_reward" value="<?php echo HtmlEncode($gaji_grid->value_reward->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->value_inval->Visible) { // value_inval ?>
		<td data-name="value_inval">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_value_inval" class="form-group gaji_value_inval">
<input type="text" data-table="gaji" data-field="x_value_inval" name="x<?php echo $gaji_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_grid->RowIndex ?>_value_inval" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_inval->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_inval->EditValue ?>"<?php echo $gaji_grid->value_inval->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_value_inval" class="form-group gaji_value_inval">
<span<?php echo $gaji_grid->value_inval->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->value_inval->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_value_inval" name="x<?php echo $gaji_grid->RowIndex ?>_value_inval" id="x<?php echo $gaji_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_grid->value_inval->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_value_inval" name="o<?php echo $gaji_grid->RowIndex ?>_value_inval" id="o<?php echo $gaji_grid->RowIndex ?>_value_inval" value="<?php echo HtmlEncode($gaji_grid->value_inval->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->piket_count->Visible) { // piket_count ?>
		<td data-name="piket_count">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_piket_count" class="form-group gaji_piket_count">
<input type="text" data-table="gaji" data-field="x_piket_count" name="x<?php echo $gaji_grid->RowIndex ?>_piket_count" id="x<?php echo $gaji_grid->RowIndex ?>_piket_count" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gaji_grid->piket_count->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->piket_count->EditValue ?>"<?php echo $gaji_grid->piket_count->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_piket_count" class="form-group gaji_piket_count">
<span<?php echo $gaji_grid->piket_count->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->piket_count->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_piket_count" name="x<?php echo $gaji_grid->RowIndex ?>_piket_count" id="x<?php echo $gaji_grid->RowIndex ?>_piket_count" value="<?php echo HtmlEncode($gaji_grid->piket_count->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_piket_count" name="o<?php echo $gaji_grid->RowIndex ?>_piket_count" id="o<?php echo $gaji_grid->RowIndex ?>_piket_count" value="<?php echo HtmlEncode($gaji_grid->piket_count->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->value_piket->Visible) { // value_piket ?>
		<td data-name="value_piket">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_value_piket" class="form-group gaji_value_piket">
<input type="text" data-table="gaji" data-field="x_value_piket" name="x<?php echo $gaji_grid->RowIndex ?>_value_piket" id="x<?php echo $gaji_grid->RowIndex ?>_value_piket" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->value_piket->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->value_piket->EditValue ?>"<?php echo $gaji_grid->value_piket->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_value_piket" class="form-group gaji_value_piket">
<span<?php echo $gaji_grid->value_piket->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->value_piket->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_value_piket" name="x<?php echo $gaji_grid->RowIndex ?>_value_piket" id="x<?php echo $gaji_grid->RowIndex ?>_value_piket" value="<?php echo HtmlEncode($gaji_grid->value_piket->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_value_piket" name="o<?php echo $gaji_grid->RowIndex ?>_value_piket" id="o<?php echo $gaji_grid->RowIndex ?>_value_piket" value="<?php echo HtmlEncode($gaji_grid->value_piket->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->tugastambahan->Visible) { // tugastambahan ?>
		<td data-name="tugastambahan">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tugastambahan" class="form-group gaji_tugastambahan">
<input type="text" data-table="gaji" data-field="x_tugastambahan" name="x<?php echo $gaji_grid->RowIndex ?>_tugastambahan" id="x<?php echo $gaji_grid->RowIndex ?>_tugastambahan" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->tugastambahan->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->tugastambahan->EditValue ?>"<?php echo $gaji_grid->tugastambahan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tugastambahan" class="form-group gaji_tugastambahan">
<span<?php echo $gaji_grid->tugastambahan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->tugastambahan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_tugastambahan" name="x<?php echo $gaji_grid->RowIndex ?>_tugastambahan" id="x<?php echo $gaji_grid->RowIndex ?>_tugastambahan" value="<?php echo HtmlEncode($gaji_grid->tugastambahan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_tugastambahan" name="o<?php echo $gaji_grid->RowIndex ?>_tugastambahan" id="o<?php echo $gaji_grid->RowIndex ?>_tugastambahan" value="<?php echo HtmlEncode($gaji_grid->tugastambahan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->tj_jabatan->Visible) { // tj_jabatan ?>
		<td data-name="tj_jabatan">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_tj_jabatan" class="form-group gaji_tj_jabatan">
<input type="text" data-table="gaji" data-field="x_tj_jabatan" name="x<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" id="x<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->tj_jabatan->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->tj_jabatan->EditValue ?>"<?php echo $gaji_grid->tj_jabatan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_tj_jabatan" class="form-group gaji_tj_jabatan">
<span<?php echo $gaji_grid->tj_jabatan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->tj_jabatan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_tj_jabatan" name="x<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" id="x<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" value="<?php echo HtmlEncode($gaji_grid->tj_jabatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_tj_jabatan" name="o<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" id="o<?php echo $gaji_grid->RowIndex ?>_tj_jabatan" value="<?php echo HtmlEncode($gaji_grid->tj_jabatan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->sub_total->Visible) { // sub_total ?>
		<td data-name="sub_total">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_sub_total" class="form-group gaji_sub_total">
<input type="text" data-table="gaji" data-field="x_sub_total" name="x<?php echo $gaji_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_grid->RowIndex ?>_sub_total" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->sub_total->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->sub_total->EditValue ?>"<?php echo $gaji_grid->sub_total->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_sub_total" class="form-group gaji_sub_total">
<span<?php echo $gaji_grid->sub_total->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->sub_total->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_sub_total" name="x<?php echo $gaji_grid->RowIndex ?>_sub_total" id="x<?php echo $gaji_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_grid->sub_total->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_sub_total" name="o<?php echo $gaji_grid->RowIndex ?>_sub_total" id="o<?php echo $gaji_grid->RowIndex ?>_sub_total" value="<?php echo HtmlEncode($gaji_grid->sub_total->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->potongan->Visible) { // potongan ?>
		<td data-name="potongan">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_potongan" class="form-group gaji_potongan">
<input type="text" data-table="gaji" data-field="x_potongan" name="x<?php echo $gaji_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_grid->RowIndex ?>_potongan" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->potongan->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->potongan->EditValue ?>"<?php echo $gaji_grid->potongan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_potongan" class="form-group gaji_potongan">
<span<?php echo $gaji_grid->potongan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->potongan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_potongan" name="x<?php echo $gaji_grid->RowIndex ?>_potongan" id="x<?php echo $gaji_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_grid->potongan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_potongan" name="o<?php echo $gaji_grid->RowIndex ?>_potongan" id="o<?php echo $gaji_grid->RowIndex ?>_potongan" value="<?php echo HtmlEncode($gaji_grid->potongan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->penyesuaian->Visible) { // penyesuaian ?>
		<td data-name="penyesuaian">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_penyesuaian" class="form-group gaji_penyesuaian">
<input type="text" data-table="gaji" data-field="x_penyesuaian" name="x<?php echo $gaji_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_grid->RowIndex ?>_penyesuaian" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->penyesuaian->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->penyesuaian->EditValue ?>"<?php echo $gaji_grid->penyesuaian->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_penyesuaian" class="form-group gaji_penyesuaian">
<span<?php echo $gaji_grid->penyesuaian->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->penyesuaian->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_penyesuaian" name="x<?php echo $gaji_grid->RowIndex ?>_penyesuaian" id="x<?php echo $gaji_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_grid->penyesuaian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_penyesuaian" name="o<?php echo $gaji_grid->RowIndex ?>_penyesuaian" id="o<?php echo $gaji_grid->RowIndex ?>_penyesuaian" value="<?php echo HtmlEncode($gaji_grid->penyesuaian->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gaji_grid->total->Visible) { // total ?>
		<td data-name="total">
<?php if (!$gaji->isConfirm()) { ?>
<span id="el$rowindex$_gaji_total" class="form-group gaji_total">
<input type="text" data-table="gaji" data-field="x_total" name="x<?php echo $gaji_grid->RowIndex ?>_total" id="x<?php echo $gaji_grid->RowIndex ?>_total" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gaji_grid->total->getPlaceHolder()) ?>" value="<?php echo $gaji_grid->total->EditValue ?>"<?php echo $gaji_grid->total->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gaji_total" class="form-group gaji_total">
<span<?php echo $gaji_grid->total->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gaji_grid->total->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gaji" data-field="x_total" name="x<?php echo $gaji_grid->RowIndex ?>_total" id="x<?php echo $gaji_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_grid->total->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gaji" data-field="x_total" name="o<?php echo $gaji_grid->RowIndex ?>_total" id="o<?php echo $gaji_grid->RowIndex ?>_total" value="<?php echo HtmlEncode($gaji_grid->total->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gaji_grid->ListOptions->render("body", "right", $gaji_grid->RowIndex);
?>
<script>
loadjs.ready(["fgajigrid", "load"], function() {
	fgajigrid.updateLists(<?php echo $gaji_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($gaji->CurrentMode == "add" || $gaji->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $gaji_grid->FormKeyCountName ?>" id="<?php echo $gaji_grid->FormKeyCountName ?>" value="<?php echo $gaji_grid->KeyCount ?>">
<?php echo $gaji_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($gaji->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $gaji_grid->FormKeyCountName ?>" id="<?php echo $gaji_grid->FormKeyCountName ?>" value="<?php echo $gaji_grid->KeyCount ?>">
<?php echo $gaji_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($gaji->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fgajigrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gaji_grid->Recordset)
	$gaji_grid->Recordset->Close();
?>
<?php if ($gaji_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $gaji_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gaji_grid->TotalRecords == 0 && !$gaji->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gaji_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$gaji_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$gaji_grid->terminate();
?>