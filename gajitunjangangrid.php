<?php
namespace PHPMaker2020\sigap;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($gajitunjangan_grid))
	$gajitunjangan_grid = new gajitunjangan_grid();

// Run the page
$gajitunjangan_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitunjangan_grid->Page_Render();
?>
<?php if (!$gajitunjangan_grid->isExport()) { ?>
<script>
var fgajitunjangangrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fgajitunjangangrid = new ew.Form("fgajitunjangangrid", "grid");
	fgajitunjangangrid.formKeyCountName = '<?php echo $gajitunjangan_grid->FormKeyCountName ?>';

	// Validate form
	fgajitunjangangrid.validate = function() {
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
			<?php if ($gajitunjangan_grid->pidjabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_pidjabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_grid->pidjabatan->caption(), $gajitunjangan_grid->pidjabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajitunjangan_grid->value_kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_value_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_grid->value_kehadiran->caption(), $gajitunjangan_grid->value_kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_value_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_grid->value_kehadiran->errorMessage()) ?>");
			<?php if ($gajitunjangan_grid->gapok->Required) { ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_grid->gapok->caption(), $gajitunjangan_grid->gapok->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_gapok");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_grid->gapok->errorMessage()) ?>");
			<?php if ($gajitunjangan_grid->tunjangan_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_grid->tunjangan_jabatan->caption(), $gajitunjangan_grid->tunjangan_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_grid->tunjangan_jabatan->errorMessage()) ?>");
			<?php if ($gajitunjangan_grid->reward->Required) { ?>
				elm = this.getElements("x" + infix + "_reward");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_grid->reward->caption(), $gajitunjangan_grid->reward->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_reward");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_grid->reward->errorMessage()) ?>");
			<?php if ($gajitunjangan_grid->lembur->Required) { ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_grid->lembur->caption(), $gajitunjangan_grid->lembur->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_lembur");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_grid->lembur->errorMessage()) ?>");
			<?php if ($gajitunjangan_grid->piket->Required) { ?>
				elm = this.getElements("x" + infix + "_piket");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_grid->piket->caption(), $gajitunjangan_grid->piket->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_piket");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_grid->piket->errorMessage()) ?>");
			<?php if ($gajitunjangan_grid->inval->Required) { ?>
				elm = this.getElements("x" + infix + "_inval");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_grid->inval->caption(), $gajitunjangan_grid->inval->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_inval");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_grid->inval->errorMessage()) ?>");
			<?php if ($gajitunjangan_grid->jam_lebih->Required) { ?>
				elm = this.getElements("x" + infix + "_jam_lebih");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_grid->jam_lebih->caption(), $gajitunjangan_grid->jam_lebih->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jam_lebih");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_grid->jam_lebih->errorMessage()) ?>");
			<?php if ($gajitunjangan_grid->tunjangan_khusus->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_khusus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_grid->tunjangan_khusus->caption(), $gajitunjangan_grid->tunjangan_khusus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_khusus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_grid->tunjangan_khusus->errorMessage()) ?>");
			<?php if ($gajitunjangan_grid->ekstrakuri->Required) { ?>
				elm = this.getElements("x" + infix + "_ekstrakuri");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitunjangan_grid->ekstrakuri->caption(), $gajitunjangan_grid->ekstrakuri->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ekstrakuri");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitunjangan_grid->ekstrakuri->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fgajitunjangangrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pidjabatan", false)) return false;
		if (ew.valueChanged(fobj, infix, "value_kehadiran", false)) return false;
		if (ew.valueChanged(fobj, infix, "gapok", false)) return false;
		if (ew.valueChanged(fobj, infix, "tunjangan_jabatan", false)) return false;
		if (ew.valueChanged(fobj, infix, "reward", false)) return false;
		if (ew.valueChanged(fobj, infix, "lembur", false)) return false;
		if (ew.valueChanged(fobj, infix, "piket", false)) return false;
		if (ew.valueChanged(fobj, infix, "inval", false)) return false;
		if (ew.valueChanged(fobj, infix, "jam_lebih", false)) return false;
		if (ew.valueChanged(fobj, infix, "tunjangan_khusus", false)) return false;
		if (ew.valueChanged(fobj, infix, "ekstrakuri", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fgajitunjangangrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgajitunjangangrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgajitunjangangrid.lists["x_pidjabatan"] = <?php echo $gajitunjangan_grid->pidjabatan->Lookup->toClientList($gajitunjangan_grid) ?>;
	fgajitunjangangrid.lists["x_pidjabatan"].options = <?php echo JsonEncode($gajitunjangan_grid->pidjabatan->lookupOptions()) ?>;
	fgajitunjangangrid.autoSuggests["x_pidjabatan"] = <?php echo json_encode(["data" => "ajax=autosuggest"]) ?>;
	loadjs.done("fgajitunjangangrid");
});
</script>
<?php } ?>
<?php
$gajitunjangan_grid->renderOtherOptions();
?>
<?php if ($gajitunjangan_grid->TotalRecords > 0 || $gajitunjangan->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gajitunjangan_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajitunjangan">
<?php if ($gajitunjangan_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $gajitunjangan_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fgajitunjangangrid" class="ew-form ew-list-form form-inline">
<div id="gmp_gajitunjangan" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_gajitunjangangrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gajitunjangan->RowType = ROWTYPE_HEADER;

// Render list options
$gajitunjangan_grid->renderListOptions();

// Render list options (header, left)
$gajitunjangan_grid->ListOptions->render("header", "left");
?>
<?php if ($gajitunjangan_grid->pidjabatan->Visible) { // pidjabatan ?>
	<?php if ($gajitunjangan_grid->SortUrl($gajitunjangan_grid->pidjabatan) == "") { ?>
		<th data-name="pidjabatan" class="<?php echo $gajitunjangan_grid->pidjabatan->headerCellClass() ?>"><div id="elh_gajitunjangan_pidjabatan" class="gajitunjangan_pidjabatan"><div class="ew-table-header-caption"><?php echo $gajitunjangan_grid->pidjabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pidjabatan" class="<?php echo $gajitunjangan_grid->pidjabatan->headerCellClass() ?>"><div><div id="elh_gajitunjangan_pidjabatan" class="gajitunjangan_pidjabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_grid->pidjabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_grid->pidjabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_grid->pidjabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_grid->value_kehadiran->Visible) { // value_kehadiran ?>
	<?php if ($gajitunjangan_grid->SortUrl($gajitunjangan_grid->value_kehadiran) == "") { ?>
		<th data-name="value_kehadiran" class="<?php echo $gajitunjangan_grid->value_kehadiran->headerCellClass() ?>"><div id="elh_gajitunjangan_value_kehadiran" class="gajitunjangan_value_kehadiran"><div class="ew-table-header-caption"><?php echo $gajitunjangan_grid->value_kehadiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="value_kehadiran" class="<?php echo $gajitunjangan_grid->value_kehadiran->headerCellClass() ?>"><div><div id="elh_gajitunjangan_value_kehadiran" class="gajitunjangan_value_kehadiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_grid->value_kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_grid->value_kehadiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_grid->value_kehadiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_grid->gapok->Visible) { // gapok ?>
	<?php if ($gajitunjangan_grid->SortUrl($gajitunjangan_grid->gapok) == "") { ?>
		<th data-name="gapok" class="<?php echo $gajitunjangan_grid->gapok->headerCellClass() ?>"><div id="elh_gajitunjangan_gapok" class="gajitunjangan_gapok"><div class="ew-table-header-caption"><?php echo $gajitunjangan_grid->gapok->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="gapok" class="<?php echo $gajitunjangan_grid->gapok->headerCellClass() ?>"><div><div id="elh_gajitunjangan_gapok" class="gajitunjangan_gapok">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_grid->gapok->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_grid->gapok->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_grid->gapok->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_grid->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
	<?php if ($gajitunjangan_grid->SortUrl($gajitunjangan_grid->tunjangan_jabatan) == "") { ?>
		<th data-name="tunjangan_jabatan" class="<?php echo $gajitunjangan_grid->tunjangan_jabatan->headerCellClass() ?>"><div id="elh_gajitunjangan_tunjangan_jabatan" class="gajitunjangan_tunjangan_jabatan"><div class="ew-table-header-caption"><?php echo $gajitunjangan_grid->tunjangan_jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tunjangan_jabatan" class="<?php echo $gajitunjangan_grid->tunjangan_jabatan->headerCellClass() ?>"><div><div id="elh_gajitunjangan_tunjangan_jabatan" class="gajitunjangan_tunjangan_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_grid->tunjangan_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_grid->tunjangan_jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_grid->tunjangan_jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_grid->reward->Visible) { // reward ?>
	<?php if ($gajitunjangan_grid->SortUrl($gajitunjangan_grid->reward) == "") { ?>
		<th data-name="reward" class="<?php echo $gajitunjangan_grid->reward->headerCellClass() ?>"><div id="elh_gajitunjangan_reward" class="gajitunjangan_reward"><div class="ew-table-header-caption"><?php echo $gajitunjangan_grid->reward->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="reward" class="<?php echo $gajitunjangan_grid->reward->headerCellClass() ?>"><div><div id="elh_gajitunjangan_reward" class="gajitunjangan_reward">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_grid->reward->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_grid->reward->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_grid->reward->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_grid->lembur->Visible) { // lembur ?>
	<?php if ($gajitunjangan_grid->SortUrl($gajitunjangan_grid->lembur) == "") { ?>
		<th data-name="lembur" class="<?php echo $gajitunjangan_grid->lembur->headerCellClass() ?>"><div id="elh_gajitunjangan_lembur" class="gajitunjangan_lembur"><div class="ew-table-header-caption"><?php echo $gajitunjangan_grid->lembur->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lembur" class="<?php echo $gajitunjangan_grid->lembur->headerCellClass() ?>"><div><div id="elh_gajitunjangan_lembur" class="gajitunjangan_lembur">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_grid->lembur->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_grid->lembur->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_grid->lembur->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_grid->piket->Visible) { // piket ?>
	<?php if ($gajitunjangan_grid->SortUrl($gajitunjangan_grid->piket) == "") { ?>
		<th data-name="piket" class="<?php echo $gajitunjangan_grid->piket->headerCellClass() ?>"><div id="elh_gajitunjangan_piket" class="gajitunjangan_piket"><div class="ew-table-header-caption"><?php echo $gajitunjangan_grid->piket->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="piket" class="<?php echo $gajitunjangan_grid->piket->headerCellClass() ?>"><div><div id="elh_gajitunjangan_piket" class="gajitunjangan_piket">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_grid->piket->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_grid->piket->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_grid->piket->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_grid->inval->Visible) { // inval ?>
	<?php if ($gajitunjangan_grid->SortUrl($gajitunjangan_grid->inval) == "") { ?>
		<th data-name="inval" class="<?php echo $gajitunjangan_grid->inval->headerCellClass() ?>"><div id="elh_gajitunjangan_inval" class="gajitunjangan_inval"><div class="ew-table-header-caption"><?php echo $gajitunjangan_grid->inval->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="inval" class="<?php echo $gajitunjangan_grid->inval->headerCellClass() ?>"><div><div id="elh_gajitunjangan_inval" class="gajitunjangan_inval">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_grid->inval->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_grid->inval->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_grid->inval->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_grid->jam_lebih->Visible) { // jam_lebih ?>
	<?php if ($gajitunjangan_grid->SortUrl($gajitunjangan_grid->jam_lebih) == "") { ?>
		<th data-name="jam_lebih" class="<?php echo $gajitunjangan_grid->jam_lebih->headerCellClass() ?>"><div id="elh_gajitunjangan_jam_lebih" class="gajitunjangan_jam_lebih"><div class="ew-table-header-caption"><?php echo $gajitunjangan_grid->jam_lebih->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jam_lebih" class="<?php echo $gajitunjangan_grid->jam_lebih->headerCellClass() ?>"><div><div id="elh_gajitunjangan_jam_lebih" class="gajitunjangan_jam_lebih">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_grid->jam_lebih->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_grid->jam_lebih->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_grid->jam_lebih->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_grid->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
	<?php if ($gajitunjangan_grid->SortUrl($gajitunjangan_grid->tunjangan_khusus) == "") { ?>
		<th data-name="tunjangan_khusus" class="<?php echo $gajitunjangan_grid->tunjangan_khusus->headerCellClass() ?>"><div id="elh_gajitunjangan_tunjangan_khusus" class="gajitunjangan_tunjangan_khusus"><div class="ew-table-header-caption"><?php echo $gajitunjangan_grid->tunjangan_khusus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tunjangan_khusus" class="<?php echo $gajitunjangan_grid->tunjangan_khusus->headerCellClass() ?>"><div><div id="elh_gajitunjangan_tunjangan_khusus" class="gajitunjangan_tunjangan_khusus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_grid->tunjangan_khusus->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_grid->tunjangan_khusus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_grid->tunjangan_khusus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitunjangan_grid->ekstrakuri->Visible) { // ekstrakuri ?>
	<?php if ($gajitunjangan_grid->SortUrl($gajitunjangan_grid->ekstrakuri) == "") { ?>
		<th data-name="ekstrakuri" class="<?php echo $gajitunjangan_grid->ekstrakuri->headerCellClass() ?>"><div id="elh_gajitunjangan_ekstrakuri" class="gajitunjangan_ekstrakuri"><div class="ew-table-header-caption"><?php echo $gajitunjangan_grid->ekstrakuri->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ekstrakuri" class="<?php echo $gajitunjangan_grid->ekstrakuri->headerCellClass() ?>"><div><div id="elh_gajitunjangan_ekstrakuri" class="gajitunjangan_ekstrakuri">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitunjangan_grid->ekstrakuri->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitunjangan_grid->ekstrakuri->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitunjangan_grid->ekstrakuri->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajitunjangan_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$gajitunjangan_grid->StartRecord = 1;
$gajitunjangan_grid->StopRecord = $gajitunjangan_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($gajitunjangan->isConfirm() || $gajitunjangan_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($gajitunjangan_grid->FormKeyCountName) && ($gajitunjangan_grid->isGridAdd() || $gajitunjangan_grid->isGridEdit() || $gajitunjangan->isConfirm())) {
		$gajitunjangan_grid->KeyCount = $CurrentForm->getValue($gajitunjangan_grid->FormKeyCountName);
		$gajitunjangan_grid->StopRecord = $gajitunjangan_grid->StartRecord + $gajitunjangan_grid->KeyCount - 1;
	}
}
$gajitunjangan_grid->RecordCount = $gajitunjangan_grid->StartRecord - 1;
if ($gajitunjangan_grid->Recordset && !$gajitunjangan_grid->Recordset->EOF) {
	$gajitunjangan_grid->Recordset->moveFirst();
	$selectLimit = $gajitunjangan_grid->UseSelectLimit;
	if (!$selectLimit && $gajitunjangan_grid->StartRecord > 1)
		$gajitunjangan_grid->Recordset->move($gajitunjangan_grid->StartRecord - 1);
} elseif (!$gajitunjangan->AllowAddDeleteRow && $gajitunjangan_grid->StopRecord == 0) {
	$gajitunjangan_grid->StopRecord = $gajitunjangan->GridAddRowCount;
}

// Initialize aggregate
$gajitunjangan->RowType = ROWTYPE_AGGREGATEINIT;
$gajitunjangan->resetAttributes();
$gajitunjangan_grid->renderRow();
if ($gajitunjangan_grid->isGridAdd())
	$gajitunjangan_grid->RowIndex = 0;
if ($gajitunjangan_grid->isGridEdit())
	$gajitunjangan_grid->RowIndex = 0;
while ($gajitunjangan_grid->RecordCount < $gajitunjangan_grid->StopRecord) {
	$gajitunjangan_grid->RecordCount++;
	if ($gajitunjangan_grid->RecordCount >= $gajitunjangan_grid->StartRecord) {
		$gajitunjangan_grid->RowCount++;
		if ($gajitunjangan_grid->isGridAdd() || $gajitunjangan_grid->isGridEdit() || $gajitunjangan->isConfirm()) {
			$gajitunjangan_grid->RowIndex++;
			$CurrentForm->Index = $gajitunjangan_grid->RowIndex;
			if ($CurrentForm->hasValue($gajitunjangan_grid->FormActionName) && ($gajitunjangan->isConfirm() || $gajitunjangan_grid->EventCancelled))
				$gajitunjangan_grid->RowAction = strval($CurrentForm->getValue($gajitunjangan_grid->FormActionName));
			elseif ($gajitunjangan_grid->isGridAdd())
				$gajitunjangan_grid->RowAction = "insert";
			else
				$gajitunjangan_grid->RowAction = "";
		}

		// Set up key count
		$gajitunjangan_grid->KeyCount = $gajitunjangan_grid->RowIndex;

		// Init row class and style
		$gajitunjangan->resetAttributes();
		$gajitunjangan->CssClass = "";
		if ($gajitunjangan_grid->isGridAdd()) {
			if ($gajitunjangan->CurrentMode == "copy") {
				$gajitunjangan_grid->loadRowValues($gajitunjangan_grid->Recordset); // Load row values
				$gajitunjangan_grid->setRecordKey($gajitunjangan_grid->RowOldKey, $gajitunjangan_grid->Recordset); // Set old record key
			} else {
				$gajitunjangan_grid->loadRowValues(); // Load default values
				$gajitunjangan_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$gajitunjangan_grid->loadRowValues($gajitunjangan_grid->Recordset); // Load row values
		}
		$gajitunjangan->RowType = ROWTYPE_VIEW; // Render view
		if ($gajitunjangan_grid->isGridAdd()) // Grid add
			$gajitunjangan->RowType = ROWTYPE_ADD; // Render add
		if ($gajitunjangan_grid->isGridAdd() && $gajitunjangan->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$gajitunjangan_grid->restoreCurrentRowFormValues($gajitunjangan_grid->RowIndex); // Restore form values
		if ($gajitunjangan_grid->isGridEdit()) { // Grid edit
			if ($gajitunjangan->EventCancelled)
				$gajitunjangan_grid->restoreCurrentRowFormValues($gajitunjangan_grid->RowIndex); // Restore form values
			if ($gajitunjangan_grid->RowAction == "insert")
				$gajitunjangan->RowType = ROWTYPE_ADD; // Render add
			else
				$gajitunjangan->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($gajitunjangan_grid->isGridEdit() && ($gajitunjangan->RowType == ROWTYPE_EDIT || $gajitunjangan->RowType == ROWTYPE_ADD) && $gajitunjangan->EventCancelled) // Update failed
			$gajitunjangan_grid->restoreCurrentRowFormValues($gajitunjangan_grid->RowIndex); // Restore form values
		if ($gajitunjangan->RowType == ROWTYPE_EDIT) // Edit row
			$gajitunjangan_grid->EditRowCount++;
		if ($gajitunjangan->isConfirm()) // Confirm row
			$gajitunjangan_grid->restoreCurrentRowFormValues($gajitunjangan_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$gajitunjangan->RowAttrs->merge(["data-rowindex" => $gajitunjangan_grid->RowCount, "id" => "r" . $gajitunjangan_grid->RowCount . "_gajitunjangan", "data-rowtype" => $gajitunjangan->RowType]);

		// Render row
		$gajitunjangan_grid->renderRow();

		// Render list options
		$gajitunjangan_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($gajitunjangan_grid->RowAction != "delete" && $gajitunjangan_grid->RowAction != "insertdelete" && !($gajitunjangan_grid->RowAction == "insert" && $gajitunjangan->isConfirm() && $gajitunjangan_grid->emptyRow())) {
?>
	<tr <?php echo $gajitunjangan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajitunjangan_grid->ListOptions->render("body", "left", $gajitunjangan_grid->RowCount);
?>
	<?php if ($gajitunjangan_grid->pidjabatan->Visible) { // pidjabatan ?>
		<td data-name="pidjabatan" <?php echo $gajitunjangan_grid->pidjabatan->cellAttributes() ?>>
<?php if ($gajitunjangan->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($gajitunjangan_grid->pidjabatan->getSessionValue() != "") { ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_pidjabatan" class="form-group">
<span<?php echo $gajitunjangan_grid->pidjabatan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_grid->pidjabatan->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_pidjabatan" class="form-group">
<?php
$onchange = $gajitunjangan_grid->pidjabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gajitunjangan_grid->pidjabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" id="sv_x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" value="<?php echo RemoveHtml($gajitunjangan_grid->pidjabatan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->getPlaceHolder()) ?>"<?php echo $gajitunjangan_grid->pidjabatan->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajitunjangan_grid->pidjabatan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($gajitunjangan_grid->pidjabatan->ReadOnly || $gajitunjangan_grid->pidjabatan->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_pidjabatan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajitunjangan_grid->pidjabatan->displayValueSeparatorAttribute() ?>" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgajitunjangangrid"], function() {
	fgajitunjangangrid.createAutoSuggest({"id":"x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan","forceSelect":false});
});
</script>
<?php echo $gajitunjangan_grid->pidjabatan->Lookup->getParamTag($gajitunjangan_grid, "p_x" . $gajitunjangan_grid->RowIndex . "_pidjabatan") ?>
</span>
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_pidjabatan" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->OldValue) ?>">
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_pidjabatan" class="form-group">
<span<?php echo $gajitunjangan_grid->pidjabatan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_grid->pidjabatan->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_pidjabatan" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->CurrentValue) ?>">
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_pidjabatan">
<span<?php echo $gajitunjangan_grid->pidjabatan->viewAttributes() ?>><?php echo $gajitunjangan_grid->pidjabatan->getViewValue() ?></span>
</span>
<?php if (!$gajitunjangan->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_pidjabatan" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_pidjabatan" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_pidjabatan" name="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" id="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_pidjabatan" name="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" id="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_id" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_id" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gajitunjangan_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_id" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_id" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gajitunjangan_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_EDIT || $gajitunjangan->CurrentMode == "edit") { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_id" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_id" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gajitunjangan_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($gajitunjangan_grid->value_kehadiran->Visible) { // value_kehadiran ?>
		<td data-name="value_kehadiran" <?php echo $gajitunjangan_grid->value_kehadiran->cellAttributes() ?>>
<?php if ($gajitunjangan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_value_kehadiran" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_value_kehadiran" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->value_kehadiran->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->value_kehadiran->EditValue ?>"<?php echo $gajitunjangan_grid->value_kehadiran->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_value_kehadiran" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" value="<?php echo HtmlEncode($gajitunjangan_grid->value_kehadiran->OldValue) ?>">
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_value_kehadiran" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_value_kehadiran" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->value_kehadiran->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->value_kehadiran->EditValue ?>"<?php echo $gajitunjangan_grid->value_kehadiran->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_value_kehadiran">
<span<?php echo $gajitunjangan_grid->value_kehadiran->viewAttributes() ?>><?php echo $gajitunjangan_grid->value_kehadiran->getViewValue() ?></span>
</span>
<?php if (!$gajitunjangan->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_value_kehadiran" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" value="<?php echo HtmlEncode($gajitunjangan_grid->value_kehadiran->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_value_kehadiran" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" value="<?php echo HtmlEncode($gajitunjangan_grid->value_kehadiran->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_value_kehadiran" name="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" id="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" value="<?php echo HtmlEncode($gajitunjangan_grid->value_kehadiran->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_value_kehadiran" name="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" id="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" value="<?php echo HtmlEncode($gajitunjangan_grid->value_kehadiran->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->gapok->Visible) { // gapok ?>
		<td data-name="gapok" <?php echo $gajitunjangan_grid->gapok->cellAttributes() ?>>
<?php if ($gajitunjangan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_gapok" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_gapok" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->gapok->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->gapok->EditValue ?>"<?php echo $gajitunjangan_grid->gapok->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_gapok" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gajitunjangan_grid->gapok->OldValue) ?>">
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_gapok" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_gapok" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->gapok->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->gapok->EditValue ?>"<?php echo $gajitunjangan_grid->gapok->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_gapok">
<span<?php echo $gajitunjangan_grid->gapok->viewAttributes() ?>><?php echo $gajitunjangan_grid->gapok->getViewValue() ?></span>
</span>
<?php if (!$gajitunjangan->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_gapok" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gajitunjangan_grid->gapok->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_gapok" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gajitunjangan_grid->gapok->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_gapok" name="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" id="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gajitunjangan_grid->gapok->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_gapok" name="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" id="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gajitunjangan_grid->gapok->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
		<td data-name="tunjangan_jabatan" <?php echo $gajitunjangan_grid->tunjangan_jabatan->cellAttributes() ?>>
<?php if ($gajitunjangan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_tunjangan_jabatan" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_jabatan->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->tunjangan_jabatan->EditValue ?>"<?php echo $gajitunjangan_grid->tunjangan_jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_jabatan->OldValue) ?>">
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_tunjangan_jabatan" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_jabatan->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->tunjangan_jabatan->EditValue ?>"<?php echo $gajitunjangan_grid->tunjangan_jabatan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_tunjangan_jabatan">
<span<?php echo $gajitunjangan_grid->tunjangan_jabatan->viewAttributes() ?>><?php echo $gajitunjangan_grid->tunjangan_jabatan->getViewValue() ?></span>
</span>
<?php if (!$gajitunjangan->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_jabatan->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_jabatan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" name="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" id="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_jabatan->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" name="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" id="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_jabatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->reward->Visible) { // reward ?>
		<td data-name="reward" <?php echo $gajitunjangan_grid->reward->cellAttributes() ?>>
<?php if ($gajitunjangan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_reward" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_reward" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_reward" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_reward" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->reward->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->reward->EditValue ?>"<?php echo $gajitunjangan_grid->reward->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_reward" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_reward" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_reward" value="<?php echo HtmlEncode($gajitunjangan_grid->reward->OldValue) ?>">
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_reward" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_reward" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_reward" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_reward" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->reward->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->reward->EditValue ?>"<?php echo $gajitunjangan_grid->reward->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_reward">
<span<?php echo $gajitunjangan_grid->reward->viewAttributes() ?>><?php echo $gajitunjangan_grid->reward->getViewValue() ?></span>
</span>
<?php if (!$gajitunjangan->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_reward" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_reward" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_reward" value="<?php echo HtmlEncode($gajitunjangan_grid->reward->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_reward" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_reward" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_reward" value="<?php echo HtmlEncode($gajitunjangan_grid->reward->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_reward" name="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_reward" id="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_reward" value="<?php echo HtmlEncode($gajitunjangan_grid->reward->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_reward" name="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_reward" id="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_reward" value="<?php echo HtmlEncode($gajitunjangan_grid->reward->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->lembur->Visible) { // lembur ?>
		<td data-name="lembur" <?php echo $gajitunjangan_grid->lembur->cellAttributes() ?>>
<?php if ($gajitunjangan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_lembur" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_lembur" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->lembur->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->lembur->EditValue ?>"<?php echo $gajitunjangan_grid->lembur->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_lembur" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gajitunjangan_grid->lembur->OldValue) ?>">
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_lembur" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_lembur" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->lembur->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->lembur->EditValue ?>"<?php echo $gajitunjangan_grid->lembur->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_lembur">
<span<?php echo $gajitunjangan_grid->lembur->viewAttributes() ?>><?php echo $gajitunjangan_grid->lembur->getViewValue() ?></span>
</span>
<?php if (!$gajitunjangan->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_lembur" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gajitunjangan_grid->lembur->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_lembur" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gajitunjangan_grid->lembur->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_lembur" name="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" id="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gajitunjangan_grid->lembur->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_lembur" name="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" id="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gajitunjangan_grid->lembur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->piket->Visible) { // piket ?>
		<td data-name="piket" <?php echo $gajitunjangan_grid->piket->cellAttributes() ?>>
<?php if ($gajitunjangan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_piket" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_piket" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_piket" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_piket" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->piket->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->piket->EditValue ?>"<?php echo $gajitunjangan_grid->piket->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_piket" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_piket" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_piket" value="<?php echo HtmlEncode($gajitunjangan_grid->piket->OldValue) ?>">
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_piket" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_piket" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_piket" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_piket" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->piket->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->piket->EditValue ?>"<?php echo $gajitunjangan_grid->piket->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_piket">
<span<?php echo $gajitunjangan_grid->piket->viewAttributes() ?>><?php echo $gajitunjangan_grid->piket->getViewValue() ?></span>
</span>
<?php if (!$gajitunjangan->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_piket" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_piket" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_piket" value="<?php echo HtmlEncode($gajitunjangan_grid->piket->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_piket" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_piket" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_piket" value="<?php echo HtmlEncode($gajitunjangan_grid->piket->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_piket" name="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_piket" id="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_piket" value="<?php echo HtmlEncode($gajitunjangan_grid->piket->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_piket" name="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_piket" id="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_piket" value="<?php echo HtmlEncode($gajitunjangan_grid->piket->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->inval->Visible) { // inval ?>
		<td data-name="inval" <?php echo $gajitunjangan_grid->inval->cellAttributes() ?>>
<?php if ($gajitunjangan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_inval" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_inval" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_inval" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_inval" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->inval->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->inval->EditValue ?>"<?php echo $gajitunjangan_grid->inval->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_inval" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_inval" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_inval" value="<?php echo HtmlEncode($gajitunjangan_grid->inval->OldValue) ?>">
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_inval" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_inval" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_inval" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_inval" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->inval->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->inval->EditValue ?>"<?php echo $gajitunjangan_grid->inval->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_inval">
<span<?php echo $gajitunjangan_grid->inval->viewAttributes() ?>><?php echo $gajitunjangan_grid->inval->getViewValue() ?></span>
</span>
<?php if (!$gajitunjangan->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_inval" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_inval" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_inval" value="<?php echo HtmlEncode($gajitunjangan_grid->inval->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_inval" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_inval" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_inval" value="<?php echo HtmlEncode($gajitunjangan_grid->inval->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_inval" name="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_inval" id="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_inval" value="<?php echo HtmlEncode($gajitunjangan_grid->inval->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_inval" name="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_inval" id="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_inval" value="<?php echo HtmlEncode($gajitunjangan_grid->inval->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->jam_lebih->Visible) { // jam_lebih ?>
		<td data-name="jam_lebih" <?php echo $gajitunjangan_grid->jam_lebih->cellAttributes() ?>>
<?php if ($gajitunjangan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_jam_lebih" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_jam_lebih" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->jam_lebih->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->jam_lebih->EditValue ?>"<?php echo $gajitunjangan_grid->jam_lebih->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_jam_lebih" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" value="<?php echo HtmlEncode($gajitunjangan_grid->jam_lebih->OldValue) ?>">
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_jam_lebih" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_jam_lebih" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->jam_lebih->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->jam_lebih->EditValue ?>"<?php echo $gajitunjangan_grid->jam_lebih->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_jam_lebih">
<span<?php echo $gajitunjangan_grid->jam_lebih->viewAttributes() ?>><?php echo $gajitunjangan_grid->jam_lebih->getViewValue() ?></span>
</span>
<?php if (!$gajitunjangan->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_jam_lebih" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" value="<?php echo HtmlEncode($gajitunjangan_grid->jam_lebih->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_jam_lebih" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" value="<?php echo HtmlEncode($gajitunjangan_grid->jam_lebih->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_jam_lebih" name="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" id="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" value="<?php echo HtmlEncode($gajitunjangan_grid->jam_lebih->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_jam_lebih" name="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" id="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" value="<?php echo HtmlEncode($gajitunjangan_grid->jam_lebih->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
		<td data-name="tunjangan_khusus" <?php echo $gajitunjangan_grid->tunjangan_khusus->cellAttributes() ?>>
<?php if ($gajitunjangan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_tunjangan_khusus" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_tunjangan_khusus" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_khusus->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->tunjangan_khusus->EditValue ?>"<?php echo $gajitunjangan_grid->tunjangan_khusus->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_khusus" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" value="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_khusus->OldValue) ?>">
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_tunjangan_khusus" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_tunjangan_khusus" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_khusus->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->tunjangan_khusus->EditValue ?>"<?php echo $gajitunjangan_grid->tunjangan_khusus->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_tunjangan_khusus">
<span<?php echo $gajitunjangan_grid->tunjangan_khusus->viewAttributes() ?>><?php echo $gajitunjangan_grid->tunjangan_khusus->getViewValue() ?></span>
</span>
<?php if (!$gajitunjangan->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_khusus" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" value="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_khusus->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_khusus" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" value="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_khusus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_khusus" name="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" id="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" value="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_khusus->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_khusus" name="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" id="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" value="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_khusus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->ekstrakuri->Visible) { // ekstrakuri ?>
		<td data-name="ekstrakuri" <?php echo $gajitunjangan_grid->ekstrakuri->cellAttributes() ?>>
<?php if ($gajitunjangan->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_ekstrakuri" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_ekstrakuri" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->ekstrakuri->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->ekstrakuri->EditValue ?>"<?php echo $gajitunjangan_grid->ekstrakuri->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_ekstrakuri" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" value="<?php echo HtmlEncode($gajitunjangan_grid->ekstrakuri->OldValue) ?>">
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_ekstrakuri" class="form-group">
<input type="text" data-table="gajitunjangan" data-field="x_ekstrakuri" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->ekstrakuri->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->ekstrakuri->EditValue ?>"<?php echo $gajitunjangan_grid->ekstrakuri->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitunjangan->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitunjangan_grid->RowCount ?>_gajitunjangan_ekstrakuri">
<span<?php echo $gajitunjangan_grid->ekstrakuri->viewAttributes() ?>><?php echo $gajitunjangan_grid->ekstrakuri->getViewValue() ?></span>
</span>
<?php if (!$gajitunjangan->isConfirm()) { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_ekstrakuri" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" value="<?php echo HtmlEncode($gajitunjangan_grid->ekstrakuri->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_ekstrakuri" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" value="<?php echo HtmlEncode($gajitunjangan_grid->ekstrakuri->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_ekstrakuri" name="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" id="fgajitunjangangrid$x<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" value="<?php echo HtmlEncode($gajitunjangan_grid->ekstrakuri->FormValue) ?>">
<input type="hidden" data-table="gajitunjangan" data-field="x_ekstrakuri" name="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" id="fgajitunjangangrid$o<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" value="<?php echo HtmlEncode($gajitunjangan_grid->ekstrakuri->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajitunjangan_grid->ListOptions->render("body", "right", $gajitunjangan_grid->RowCount);
?>
	</tr>
<?php if ($gajitunjangan->RowType == ROWTYPE_ADD || $gajitunjangan->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fgajitunjangangrid", "load"], function() {
	fgajitunjangangrid.updateLists(<?php echo $gajitunjangan_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$gajitunjangan_grid->isGridAdd() || $gajitunjangan->CurrentMode == "copy")
		if (!$gajitunjangan_grid->Recordset->EOF)
			$gajitunjangan_grid->Recordset->moveNext();
}
?>
<?php
	if ($gajitunjangan->CurrentMode == "add" || $gajitunjangan->CurrentMode == "copy" || $gajitunjangan->CurrentMode == "edit") {
		$gajitunjangan_grid->RowIndex = '$rowindex$';
		$gajitunjangan_grid->loadRowValues();

		// Set row properties
		$gajitunjangan->resetAttributes();
		$gajitunjangan->RowAttrs->merge(["data-rowindex" => $gajitunjangan_grid->RowIndex, "id" => "r0_gajitunjangan", "data-rowtype" => ROWTYPE_ADD]);
		$gajitunjangan->RowAttrs->appendClass("ew-template");
		$gajitunjangan->RowType = ROWTYPE_ADD;

		// Render row
		$gajitunjangan_grid->renderRow();

		// Render list options
		$gajitunjangan_grid->renderListOptions();
		$gajitunjangan_grid->StartRowCount = 0;
?>
	<tr <?php echo $gajitunjangan->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajitunjangan_grid->ListOptions->render("body", "left", $gajitunjangan_grid->RowIndex);
?>
	<?php if ($gajitunjangan_grid->pidjabatan->Visible) { // pidjabatan ?>
		<td data-name="pidjabatan">
<?php if (!$gajitunjangan->isConfirm()) { ?>
<?php if ($gajitunjangan_grid->pidjabatan->getSessionValue() != "") { ?>
<span id="el$rowindex$_gajitunjangan_pidjabatan" class="form-group gajitunjangan_pidjabatan">
<span<?php echo $gajitunjangan_grid->pidjabatan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_grid->pidjabatan->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_pidjabatan" class="form-group gajitunjangan_pidjabatan">
<?php
$onchange = $gajitunjangan_grid->pidjabatan->EditAttrs->prepend("onchange", "");
$onchange = ($onchange) ? ' onchange="' . JsEncode($onchange) . '"' : '';
$gajitunjangan_grid->pidjabatan->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan">
	<div class="input-group">
		<input type="text" class="form-control" name="sv_x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" id="sv_x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" value="<?php echo RemoveHtml($gajitunjangan_grid->pidjabatan->EditValue) ?>" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->getPlaceHolder()) ?>" data-placeholder="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->getPlaceHolder()) ?>"<?php echo $gajitunjangan_grid->pidjabatan->editAttributes() ?>>
		<div class="input-group-append">
			<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajitunjangan_grid->pidjabatan->caption()), $Language->phrase("LookupLink", TRUE))) ?>" onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan',m:0,n:10,srch:true});" class="ew-lookup-btn btn btn-default"<?php echo ($gajitunjangan_grid->pidjabatan->ReadOnly || $gajitunjangan_grid->pidjabatan->Disabled) ? " disabled" : "" ?>><i class="fas fa-search ew-icon"></i></button>
		</div>
	</div>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_pidjabatan" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajitunjangan_grid->pidjabatan->displayValueSeparatorAttribute() ?>" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->CurrentValue) ?>"<?php echo $onchange ?>>
<script>
loadjs.ready(["fgajitunjangangrid"], function() {
	fgajitunjangangrid.createAutoSuggest({"id":"x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan","forceSelect":false});
});
</script>
<?php echo $gajitunjangan_grid->pidjabatan->Lookup->getParamTag($gajitunjangan_grid, "p_x" . $gajitunjangan_grid->RowIndex . "_pidjabatan") ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_pidjabatan" class="form-group gajitunjangan_pidjabatan">
<span<?php echo $gajitunjangan_grid->pidjabatan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_grid->pidjabatan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_pidjabatan" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_pidjabatan" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_pidjabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->pidjabatan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->value_kehadiran->Visible) { // value_kehadiran ?>
		<td data-name="value_kehadiran">
<?php if (!$gajitunjangan->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_value_kehadiran" class="form-group gajitunjangan_value_kehadiran">
<input type="text" data-table="gajitunjangan" data-field="x_value_kehadiran" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->value_kehadiran->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->value_kehadiran->EditValue ?>"<?php echo $gajitunjangan_grid->value_kehadiran->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_value_kehadiran" class="form-group gajitunjangan_value_kehadiran">
<span<?php echo $gajitunjangan_grid->value_kehadiran->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_grid->value_kehadiran->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_value_kehadiran" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" value="<?php echo HtmlEncode($gajitunjangan_grid->value_kehadiran->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_value_kehadiran" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_value_kehadiran" value="<?php echo HtmlEncode($gajitunjangan_grid->value_kehadiran->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->gapok->Visible) { // gapok ?>
		<td data-name="gapok">
<?php if (!$gajitunjangan->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_gapok" class="form-group gajitunjangan_gapok">
<input type="text" data-table="gajitunjangan" data-field="x_gapok" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->gapok->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->gapok->EditValue ?>"<?php echo $gajitunjangan_grid->gapok->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_gapok" class="form-group gajitunjangan_gapok">
<span<?php echo $gajitunjangan_grid->gapok->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_grid->gapok->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_gapok" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gajitunjangan_grid->gapok->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_gapok" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_gapok" value="<?php echo HtmlEncode($gajitunjangan_grid->gapok->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
		<td data-name="tunjangan_jabatan">
<?php if (!$gajitunjangan->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_tunjangan_jabatan" class="form-group gajitunjangan_tunjangan_jabatan">
<input type="text" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_jabatan->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->tunjangan_jabatan->EditValue ?>"<?php echo $gajitunjangan_grid->tunjangan_jabatan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_tunjangan_jabatan" class="form-group gajitunjangan_tunjangan_jabatan">
<span<?php echo $gajitunjangan_grid->tunjangan_jabatan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_grid->tunjangan_jabatan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_jabatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_jabatan" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_jabatan" value="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_jabatan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->reward->Visible) { // reward ?>
		<td data-name="reward">
<?php if (!$gajitunjangan->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_reward" class="form-group gajitunjangan_reward">
<input type="text" data-table="gajitunjangan" data-field="x_reward" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_reward" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_reward" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->reward->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->reward->EditValue ?>"<?php echo $gajitunjangan_grid->reward->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_reward" class="form-group gajitunjangan_reward">
<span<?php echo $gajitunjangan_grid->reward->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_grid->reward->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_reward" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_reward" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_reward" value="<?php echo HtmlEncode($gajitunjangan_grid->reward->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_reward" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_reward" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_reward" value="<?php echo HtmlEncode($gajitunjangan_grid->reward->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->lembur->Visible) { // lembur ?>
		<td data-name="lembur">
<?php if (!$gajitunjangan->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_lembur" class="form-group gajitunjangan_lembur">
<input type="text" data-table="gajitunjangan" data-field="x_lembur" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->lembur->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->lembur->EditValue ?>"<?php echo $gajitunjangan_grid->lembur->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_lembur" class="form-group gajitunjangan_lembur">
<span<?php echo $gajitunjangan_grid->lembur->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_grid->lembur->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_lembur" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gajitunjangan_grid->lembur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_lembur" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_lembur" value="<?php echo HtmlEncode($gajitunjangan_grid->lembur->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->piket->Visible) { // piket ?>
		<td data-name="piket">
<?php if (!$gajitunjangan->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_piket" class="form-group gajitunjangan_piket">
<input type="text" data-table="gajitunjangan" data-field="x_piket" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_piket" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_piket" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->piket->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->piket->EditValue ?>"<?php echo $gajitunjangan_grid->piket->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_piket" class="form-group gajitunjangan_piket">
<span<?php echo $gajitunjangan_grid->piket->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_grid->piket->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_piket" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_piket" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_piket" value="<?php echo HtmlEncode($gajitunjangan_grid->piket->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_piket" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_piket" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_piket" value="<?php echo HtmlEncode($gajitunjangan_grid->piket->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->inval->Visible) { // inval ?>
		<td data-name="inval">
<?php if (!$gajitunjangan->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_inval" class="form-group gajitunjangan_inval">
<input type="text" data-table="gajitunjangan" data-field="x_inval" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_inval" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_inval" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->inval->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->inval->EditValue ?>"<?php echo $gajitunjangan_grid->inval->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_inval" class="form-group gajitunjangan_inval">
<span<?php echo $gajitunjangan_grid->inval->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_grid->inval->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_inval" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_inval" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_inval" value="<?php echo HtmlEncode($gajitunjangan_grid->inval->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_inval" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_inval" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_inval" value="<?php echo HtmlEncode($gajitunjangan_grid->inval->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->jam_lebih->Visible) { // jam_lebih ?>
		<td data-name="jam_lebih">
<?php if (!$gajitunjangan->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_jam_lebih" class="form-group gajitunjangan_jam_lebih">
<input type="text" data-table="gajitunjangan" data-field="x_jam_lebih" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->jam_lebih->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->jam_lebih->EditValue ?>"<?php echo $gajitunjangan_grid->jam_lebih->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_jam_lebih" class="form-group gajitunjangan_jam_lebih">
<span<?php echo $gajitunjangan_grid->jam_lebih->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_grid->jam_lebih->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_jam_lebih" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" value="<?php echo HtmlEncode($gajitunjangan_grid->jam_lebih->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_jam_lebih" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_jam_lebih" value="<?php echo HtmlEncode($gajitunjangan_grid->jam_lebih->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
		<td data-name="tunjangan_khusus">
<?php if (!$gajitunjangan->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_tunjangan_khusus" class="form-group gajitunjangan_tunjangan_khusus">
<input type="text" data-table="gajitunjangan" data-field="x_tunjangan_khusus" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_khusus->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->tunjangan_khusus->EditValue ?>"<?php echo $gajitunjangan_grid->tunjangan_khusus->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_tunjangan_khusus" class="form-group gajitunjangan_tunjangan_khusus">
<span<?php echo $gajitunjangan_grid->tunjangan_khusus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_grid->tunjangan_khusus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_khusus" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" value="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_khusus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_tunjangan_khusus" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_tunjangan_khusus" value="<?php echo HtmlEncode($gajitunjangan_grid->tunjangan_khusus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitunjangan_grid->ekstrakuri->Visible) { // ekstrakuri ?>
		<td data-name="ekstrakuri">
<?php if (!$gajitunjangan->isConfirm()) { ?>
<span id="el$rowindex$_gajitunjangan_ekstrakuri" class="form-group gajitunjangan_ekstrakuri">
<input type="text" data-table="gajitunjangan" data-field="x_ekstrakuri" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" size="30" maxlength="20" placeholder="<?php echo HtmlEncode($gajitunjangan_grid->ekstrakuri->getPlaceHolder()) ?>" value="<?php echo $gajitunjangan_grid->ekstrakuri->EditValue ?>"<?php echo $gajitunjangan_grid->ekstrakuri->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitunjangan_ekstrakuri" class="form-group gajitunjangan_ekstrakuri">
<span<?php echo $gajitunjangan_grid->ekstrakuri->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitunjangan_grid->ekstrakuri->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitunjangan" data-field="x_ekstrakuri" name="x<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" id="x<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" value="<?php echo HtmlEncode($gajitunjangan_grid->ekstrakuri->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitunjangan" data-field="x_ekstrakuri" name="o<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" id="o<?php echo $gajitunjangan_grid->RowIndex ?>_ekstrakuri" value="<?php echo HtmlEncode($gajitunjangan_grid->ekstrakuri->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajitunjangan_grid->ListOptions->render("body", "right", $gajitunjangan_grid->RowIndex);
?>
<script>
loadjs.ready(["fgajitunjangangrid", "load"], function() {
	fgajitunjangangrid.updateLists(<?php echo $gajitunjangan_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($gajitunjangan->CurrentMode == "add" || $gajitunjangan->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $gajitunjangan_grid->FormKeyCountName ?>" id="<?php echo $gajitunjangan_grid->FormKeyCountName ?>" value="<?php echo $gajitunjangan_grid->KeyCount ?>">
<?php echo $gajitunjangan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($gajitunjangan->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $gajitunjangan_grid->FormKeyCountName ?>" id="<?php echo $gajitunjangan_grid->FormKeyCountName ?>" value="<?php echo $gajitunjangan_grid->KeyCount ?>">
<?php echo $gajitunjangan_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($gajitunjangan->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fgajitunjangangrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gajitunjangan_grid->Recordset)
	$gajitunjangan_grid->Recordset->Close();
?>
<?php if ($gajitunjangan_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $gajitunjangan_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gajitunjangan_grid->TotalRecords == 0 && !$gajitunjangan->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gajitunjangan_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$gajitunjangan_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$gajitunjangan_grid->terminate();
?>