<?php
namespace PHPMaker2020\sigap;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($gajitk_detil_grid))
	$gajitk_detil_grid = new gajitk_detil_grid();

// Run the page
$gajitk_detil_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$gajitk_detil_grid->Page_Render();
?>
<?php if (!$gajitk_detil_grid->isExport()) { ?>
<script>
var fgajitk_detilgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fgajitk_detilgrid = new ew.Form("fgajitk_detilgrid", "grid");
	fgajitk_detilgrid.formKeyCountName = '<?php echo $gajitk_detil_grid->FormKeyCountName ?>';

	// Validate form
	fgajitk_detilgrid.validate = function() {
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
			<?php if ($gajitk_detil_grid->pegawai_id->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->pegawai_id->caption(), $gajitk_detil_grid->pegawai_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajitk_detil_grid->jabatan_id->Required) { ?>
				elm = this.getElements("x" + infix + "_jabatan_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->jabatan_id->caption(), $gajitk_detil_grid->jabatan_id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($gajitk_detil_grid->masakerja->Required) { ?>
				elm = this.getElements("x" + infix + "_masakerja");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->masakerja->caption(), $gajitk_detil_grid->masakerja->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masakerja");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_grid->masakerja->errorMessage()) ?>");
			<?php if ($gajitk_detil_grid->jumngajar->Required) { ?>
				elm = this.getElements("x" + infix + "_jumngajar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->jumngajar->caption(), $gajitk_detil_grid->jumngajar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumngajar");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_grid->jumngajar->errorMessage()) ?>");
			<?php if ($gajitk_detil_grid->ijin->Required) { ?>
				elm = this.getElements("x" + infix + "_ijin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->ijin->caption(), $gajitk_detil_grid->ijin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ijin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_grid->ijin->errorMessage()) ?>");
			<?php if ($gajitk_detil_grid->voucher->Required) { ?>
				elm = this.getElements("x" + infix + "_voucher");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->voucher->caption(), $gajitk_detil_grid->voucher->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_voucher");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_grid->voucher->errorMessage()) ?>");
			<?php if ($gajitk_detil_grid->tunjangan_khusus->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_khusus");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->tunjangan_khusus->caption(), $gajitk_detil_grid->tunjangan_khusus->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_khusus");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_grid->tunjangan_khusus->errorMessage()) ?>");
			<?php if ($gajitk_detil_grid->tunjangan_jabatan->Required) { ?>
				elm = this.getElements("x" + infix + "_tunjangan_jabatan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->tunjangan_jabatan->caption(), $gajitk_detil_grid->tunjangan_jabatan->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tunjangan_jabatan");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_grid->tunjangan_jabatan->errorMessage()) ?>");
			<?php if ($gajitk_detil_grid->baku->Required) { ?>
				elm = this.getElements("x" + infix + "_baku");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->baku->caption(), $gajitk_detil_grid->baku->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_baku");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_grid->baku->errorMessage()) ?>");
			<?php if ($gajitk_detil_grid->kehadiran->Required) { ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->kehadiran->caption(), $gajitk_detil_grid->kehadiran->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_kehadiran");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_grid->kehadiran->errorMessage()) ?>");
			<?php if ($gajitk_detil_grid->prestasi->Required) { ?>
				elm = this.getElements("x" + infix + "_prestasi");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->prestasi->caption(), $gajitk_detil_grid->prestasi->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_prestasi");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_grid->prestasi->errorMessage()) ?>");
			<?php if ($gajitk_detil_grid->jumlahgaji->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlahgaji");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->jumlahgaji->caption(), $gajitk_detil_grid->jumlahgaji->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlahgaji");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_grid->jumlahgaji->errorMessage()) ?>");
			<?php if ($gajitk_detil_grid->jumgajitotal->Required) { ?>
				elm = this.getElements("x" + infix + "_jumgajitotal");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->jumgajitotal->caption(), $gajitk_detil_grid->jumgajitotal->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumgajitotal");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_grid->jumgajitotal->errorMessage()) ?>");
			<?php if ($gajitk_detil_grid->potongan1->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan1");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->potongan1->caption(), $gajitk_detil_grid->potongan1->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan1");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_grid->potongan1->errorMessage()) ?>");
			<?php if ($gajitk_detil_grid->potongan2->Required) { ?>
				elm = this.getElements("x" + infix + "_potongan2");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->potongan2->caption(), $gajitk_detil_grid->potongan2->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_potongan2");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_grid->potongan2->errorMessage()) ?>");
			<?php if ($gajitk_detil_grid->jumlahterima->Required) { ?>
				elm = this.getElements("x" + infix + "_jumlahterima");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $gajitk_detil_grid->jumlahterima->caption(), $gajitk_detil_grid->jumlahterima->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_jumlahterima");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($gajitk_detil_grid->jumlahterima->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fgajitk_detilgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pegawai_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "jabatan_id", false)) return false;
		if (ew.valueChanged(fobj, infix, "masakerja", false)) return false;
		if (ew.valueChanged(fobj, infix, "jumngajar", false)) return false;
		if (ew.valueChanged(fobj, infix, "ijin", false)) return false;
		if (ew.valueChanged(fobj, infix, "voucher", false)) return false;
		if (ew.valueChanged(fobj, infix, "tunjangan_khusus", false)) return false;
		if (ew.valueChanged(fobj, infix, "tunjangan_jabatan", false)) return false;
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
	fgajitk_detilgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fgajitk_detilgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	fgajitk_detilgrid.lists["x_pegawai_id"] = <?php echo $gajitk_detil_grid->pegawai_id->Lookup->toClientList($gajitk_detil_grid) ?>;
	fgajitk_detilgrid.lists["x_pegawai_id"].options = <?php echo JsonEncode($gajitk_detil_grid->pegawai_id->lookupOptions()) ?>;
	fgajitk_detilgrid.lists["x_jabatan_id"] = <?php echo $gajitk_detil_grid->jabatan_id->Lookup->toClientList($gajitk_detil_grid) ?>;
	fgajitk_detilgrid.lists["x_jabatan_id"].options = <?php echo JsonEncode($gajitk_detil_grid->jabatan_id->lookupOptions()) ?>;
	loadjs.done("fgajitk_detilgrid");
});
</script>
<?php } ?>
<?php
$gajitk_detil_grid->renderOtherOptions();
?>
<?php if ($gajitk_detil_grid->TotalRecords > 0 || $gajitk_detil->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($gajitk_detil_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> gajitk_detil">
<?php if ($gajitk_detil_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $gajitk_detil_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fgajitk_detilgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_gajitk_detil" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_gajitk_detilgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$gajitk_detil->RowType = ROWTYPE_HEADER;

// Render list options
$gajitk_detil_grid->renderListOptions();

// Render list options (header, left)
$gajitk_detil_grid->ListOptions->render("header", "left");
?>
<?php if ($gajitk_detil_grid->pegawai_id->Visible) { // pegawai_id ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->pegawai_id) == "") { ?>
		<th data-name="pegawai_id" class="<?php echo $gajitk_detil_grid->pegawai_id->headerCellClass() ?>"><div id="elh_gajitk_detil_pegawai_id" class="gajitk_detil_pegawai_id"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->pegawai_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai_id" class="<?php echo $gajitk_detil_grid->pegawai_id->headerCellClass() ?>"><div><div id="elh_gajitk_detil_pegawai_id" class="gajitk_detil_pegawai_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->pegawai_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->pegawai_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->pegawai_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->jabatan_id->Visible) { // jabatan_id ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->jabatan_id) == "") { ?>
		<th data-name="jabatan_id" class="<?php echo $gajitk_detil_grid->jabatan_id->headerCellClass() ?>"><div id="elh_gajitk_detil_jabatan_id" class="gajitk_detil_jabatan_id"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->jabatan_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jabatan_id" class="<?php echo $gajitk_detil_grid->jabatan_id->headerCellClass() ?>"><div><div id="elh_gajitk_detil_jabatan_id" class="gajitk_detil_jabatan_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->jabatan_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->jabatan_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->jabatan_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->masakerja->Visible) { // masakerja ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->masakerja) == "") { ?>
		<th data-name="masakerja" class="<?php echo $gajitk_detil_grid->masakerja->headerCellClass() ?>"><div id="elh_gajitk_detil_masakerja" class="gajitk_detil_masakerja"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->masakerja->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masakerja" class="<?php echo $gajitk_detil_grid->masakerja->headerCellClass() ?>"><div><div id="elh_gajitk_detil_masakerja" class="gajitk_detil_masakerja">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->masakerja->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->masakerja->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->masakerja->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->jumngajar->Visible) { // jumngajar ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->jumngajar) == "") { ?>
		<th data-name="jumngajar" class="<?php echo $gajitk_detil_grid->jumngajar->headerCellClass() ?>"><div id="elh_gajitk_detil_jumngajar" class="gajitk_detil_jumngajar"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->jumngajar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumngajar" class="<?php echo $gajitk_detil_grid->jumngajar->headerCellClass() ?>"><div><div id="elh_gajitk_detil_jumngajar" class="gajitk_detil_jumngajar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->jumngajar->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->jumngajar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->jumngajar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->ijin->Visible) { // ijin ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->ijin) == "") { ?>
		<th data-name="ijin" class="<?php echo $gajitk_detil_grid->ijin->headerCellClass() ?>"><div id="elh_gajitk_detil_ijin" class="gajitk_detil_ijin"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->ijin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ijin" class="<?php echo $gajitk_detil_grid->ijin->headerCellClass() ?>"><div><div id="elh_gajitk_detil_ijin" class="gajitk_detil_ijin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->ijin->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->ijin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->ijin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->voucher->Visible) { // voucher ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->voucher) == "") { ?>
		<th data-name="voucher" class="<?php echo $gajitk_detil_grid->voucher->headerCellClass() ?>"><div id="elh_gajitk_detil_voucher" class="gajitk_detil_voucher"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->voucher->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="voucher" class="<?php echo $gajitk_detil_grid->voucher->headerCellClass() ?>"><div><div id="elh_gajitk_detil_voucher" class="gajitk_detil_voucher">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->voucher->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->voucher->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->voucher->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->tunjangan_khusus) == "") { ?>
		<th data-name="tunjangan_khusus" class="<?php echo $gajitk_detil_grid->tunjangan_khusus->headerCellClass() ?>"><div id="elh_gajitk_detil_tunjangan_khusus" class="gajitk_detil_tunjangan_khusus"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->tunjangan_khusus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tunjangan_khusus" class="<?php echo $gajitk_detil_grid->tunjangan_khusus->headerCellClass() ?>"><div><div id="elh_gajitk_detil_tunjangan_khusus" class="gajitk_detil_tunjangan_khusus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->tunjangan_khusus->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->tunjangan_khusus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->tunjangan_khusus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->tunjangan_jabatan) == "") { ?>
		<th data-name="tunjangan_jabatan" class="<?php echo $gajitk_detil_grid->tunjangan_jabatan->headerCellClass() ?>"><div id="elh_gajitk_detil_tunjangan_jabatan" class="gajitk_detil_tunjangan_jabatan"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->tunjangan_jabatan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tunjangan_jabatan" class="<?php echo $gajitk_detil_grid->tunjangan_jabatan->headerCellClass() ?>"><div><div id="elh_gajitk_detil_tunjangan_jabatan" class="gajitk_detil_tunjangan_jabatan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->tunjangan_jabatan->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->tunjangan_jabatan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->tunjangan_jabatan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->baku->Visible) { // baku ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->baku) == "") { ?>
		<th data-name="baku" class="<?php echo $gajitk_detil_grid->baku->headerCellClass() ?>"><div id="elh_gajitk_detil_baku" class="gajitk_detil_baku"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->baku->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="baku" class="<?php echo $gajitk_detil_grid->baku->headerCellClass() ?>"><div><div id="elh_gajitk_detil_baku" class="gajitk_detil_baku">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->baku->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->baku->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->baku->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->kehadiran->Visible) { // kehadiran ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->kehadiran) == "") { ?>
		<th data-name="kehadiran" class="<?php echo $gajitk_detil_grid->kehadiran->headerCellClass() ?>"><div id="elh_gajitk_detil_kehadiran" class="gajitk_detil_kehadiran"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->kehadiran->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kehadiran" class="<?php echo $gajitk_detil_grid->kehadiran->headerCellClass() ?>"><div><div id="elh_gajitk_detil_kehadiran" class="gajitk_detil_kehadiran">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->kehadiran->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->kehadiran->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->kehadiran->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->prestasi->Visible) { // prestasi ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->prestasi) == "") { ?>
		<th data-name="prestasi" class="<?php echo $gajitk_detil_grid->prestasi->headerCellClass() ?>"><div id="elh_gajitk_detil_prestasi" class="gajitk_detil_prestasi"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->prestasi->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="prestasi" class="<?php echo $gajitk_detil_grid->prestasi->headerCellClass() ?>"><div><div id="elh_gajitk_detil_prestasi" class="gajitk_detil_prestasi">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->prestasi->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->prestasi->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->prestasi->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->jumlahgaji->Visible) { // jumlahgaji ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->jumlahgaji) == "") { ?>
		<th data-name="jumlahgaji" class="<?php echo $gajitk_detil_grid->jumlahgaji->headerCellClass() ?>"><div id="elh_gajitk_detil_jumlahgaji" class="gajitk_detil_jumlahgaji"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->jumlahgaji->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlahgaji" class="<?php echo $gajitk_detil_grid->jumlahgaji->headerCellClass() ?>"><div><div id="elh_gajitk_detil_jumlahgaji" class="gajitk_detil_jumlahgaji">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->jumlahgaji->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->jumlahgaji->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->jumlahgaji->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->jumgajitotal->Visible) { // jumgajitotal ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->jumgajitotal) == "") { ?>
		<th data-name="jumgajitotal" class="<?php echo $gajitk_detil_grid->jumgajitotal->headerCellClass() ?>"><div id="elh_gajitk_detil_jumgajitotal" class="gajitk_detil_jumgajitotal"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->jumgajitotal->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumgajitotal" class="<?php echo $gajitk_detil_grid->jumgajitotal->headerCellClass() ?>"><div><div id="elh_gajitk_detil_jumgajitotal" class="gajitk_detil_jumgajitotal">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->jumgajitotal->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->jumgajitotal->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->jumgajitotal->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->potongan1->Visible) { // potongan1 ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->potongan1) == "") { ?>
		<th data-name="potongan1" class="<?php echo $gajitk_detil_grid->potongan1->headerCellClass() ?>"><div id="elh_gajitk_detil_potongan1" class="gajitk_detil_potongan1"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->potongan1->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan1" class="<?php echo $gajitk_detil_grid->potongan1->headerCellClass() ?>"><div><div id="elh_gajitk_detil_potongan1" class="gajitk_detil_potongan1">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->potongan1->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->potongan1->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->potongan1->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->potongan2->Visible) { // potongan2 ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->potongan2) == "") { ?>
		<th data-name="potongan2" class="<?php echo $gajitk_detil_grid->potongan2->headerCellClass() ?>"><div id="elh_gajitk_detil_potongan2" class="gajitk_detil_potongan2"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->potongan2->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="potongan2" class="<?php echo $gajitk_detil_grid->potongan2->headerCellClass() ?>"><div><div id="elh_gajitk_detil_potongan2" class="gajitk_detil_potongan2">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->potongan2->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->potongan2->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->potongan2->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($gajitk_detil_grid->jumlahterima->Visible) { // jumlahterima ?>
	<?php if ($gajitk_detil_grid->SortUrl($gajitk_detil_grid->jumlahterima) == "") { ?>
		<th data-name="jumlahterima" class="<?php echo $gajitk_detil_grid->jumlahterima->headerCellClass() ?>"><div id="elh_gajitk_detil_jumlahterima" class="gajitk_detil_jumlahterima"><div class="ew-table-header-caption"><?php echo $gajitk_detil_grid->jumlahterima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jumlahterima" class="<?php echo $gajitk_detil_grid->jumlahterima->headerCellClass() ?>"><div><div id="elh_gajitk_detil_jumlahterima" class="gajitk_detil_jumlahterima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $gajitk_detil_grid->jumlahterima->caption() ?></span><span class="ew-table-header-sort"><?php if ($gajitk_detil_grid->jumlahterima->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($gajitk_detil_grid->jumlahterima->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$gajitk_detil_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$gajitk_detil_grid->StartRecord = 1;
$gajitk_detil_grid->StopRecord = $gajitk_detil_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($gajitk_detil->isConfirm() || $gajitk_detil_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($gajitk_detil_grid->FormKeyCountName) && ($gajitk_detil_grid->isGridAdd() || $gajitk_detil_grid->isGridEdit() || $gajitk_detil->isConfirm())) {
		$gajitk_detil_grid->KeyCount = $CurrentForm->getValue($gajitk_detil_grid->FormKeyCountName);
		$gajitk_detil_grid->StopRecord = $gajitk_detil_grid->StartRecord + $gajitk_detil_grid->KeyCount - 1;
	}
}
$gajitk_detil_grid->RecordCount = $gajitk_detil_grid->StartRecord - 1;
if ($gajitk_detil_grid->Recordset && !$gajitk_detil_grid->Recordset->EOF) {
	$gajitk_detil_grid->Recordset->moveFirst();
	$selectLimit = $gajitk_detil_grid->UseSelectLimit;
	if (!$selectLimit && $gajitk_detil_grid->StartRecord > 1)
		$gajitk_detil_grid->Recordset->move($gajitk_detil_grid->StartRecord - 1);
} elseif (!$gajitk_detil->AllowAddDeleteRow && $gajitk_detil_grid->StopRecord == 0) {
	$gajitk_detil_grid->StopRecord = $gajitk_detil->GridAddRowCount;
}

// Initialize aggregate
$gajitk_detil->RowType = ROWTYPE_AGGREGATEINIT;
$gajitk_detil->resetAttributes();
$gajitk_detil_grid->renderRow();
if ($gajitk_detil_grid->isGridAdd())
	$gajitk_detil_grid->RowIndex = 0;
if ($gajitk_detil_grid->isGridEdit())
	$gajitk_detil_grid->RowIndex = 0;
while ($gajitk_detil_grid->RecordCount < $gajitk_detil_grid->StopRecord) {
	$gajitk_detil_grid->RecordCount++;
	if ($gajitk_detil_grid->RecordCount >= $gajitk_detil_grid->StartRecord) {
		$gajitk_detil_grid->RowCount++;
		if ($gajitk_detil_grid->isGridAdd() || $gajitk_detil_grid->isGridEdit() || $gajitk_detil->isConfirm()) {
			$gajitk_detil_grid->RowIndex++;
			$CurrentForm->Index = $gajitk_detil_grid->RowIndex;
			if ($CurrentForm->hasValue($gajitk_detil_grid->FormActionName) && ($gajitk_detil->isConfirm() || $gajitk_detil_grid->EventCancelled))
				$gajitk_detil_grid->RowAction = strval($CurrentForm->getValue($gajitk_detil_grid->FormActionName));
			elseif ($gajitk_detil_grid->isGridAdd())
				$gajitk_detil_grid->RowAction = "insert";
			else
				$gajitk_detil_grid->RowAction = "";
		}

		// Set up key count
		$gajitk_detil_grid->KeyCount = $gajitk_detil_grid->RowIndex;

		// Init row class and style
		$gajitk_detil->resetAttributes();
		$gajitk_detil->CssClass = "";
		if ($gajitk_detil_grid->isGridAdd()) {
			if ($gajitk_detil->CurrentMode == "copy") {
				$gajitk_detil_grid->loadRowValues($gajitk_detil_grid->Recordset); // Load row values
				$gajitk_detil_grid->setRecordKey($gajitk_detil_grid->RowOldKey, $gajitk_detil_grid->Recordset); // Set old record key
			} else {
				$gajitk_detil_grid->loadRowValues(); // Load default values
				$gajitk_detil_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$gajitk_detil_grid->loadRowValues($gajitk_detil_grid->Recordset); // Load row values
		}
		$gajitk_detil->RowType = ROWTYPE_VIEW; // Render view
		if ($gajitk_detil_grid->isGridAdd()) // Grid add
			$gajitk_detil->RowType = ROWTYPE_ADD; // Render add
		if ($gajitk_detil_grid->isGridAdd() && $gajitk_detil->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$gajitk_detil_grid->restoreCurrentRowFormValues($gajitk_detil_grid->RowIndex); // Restore form values
		if ($gajitk_detil_grid->isGridEdit()) { // Grid edit
			if ($gajitk_detil->EventCancelled)
				$gajitk_detil_grid->restoreCurrentRowFormValues($gajitk_detil_grid->RowIndex); // Restore form values
			if ($gajitk_detil_grid->RowAction == "insert")
				$gajitk_detil->RowType = ROWTYPE_ADD; // Render add
			else
				$gajitk_detil->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($gajitk_detil_grid->isGridEdit() && ($gajitk_detil->RowType == ROWTYPE_EDIT || $gajitk_detil->RowType == ROWTYPE_ADD) && $gajitk_detil->EventCancelled) // Update failed
			$gajitk_detil_grid->restoreCurrentRowFormValues($gajitk_detil_grid->RowIndex); // Restore form values
		if ($gajitk_detil->RowType == ROWTYPE_EDIT) // Edit row
			$gajitk_detil_grid->EditRowCount++;
		if ($gajitk_detil->isConfirm()) // Confirm row
			$gajitk_detil_grid->restoreCurrentRowFormValues($gajitk_detil_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$gajitk_detil->RowAttrs->merge(["data-rowindex" => $gajitk_detil_grid->RowCount, "id" => "r" . $gajitk_detil_grid->RowCount . "_gajitk_detil", "data-rowtype" => $gajitk_detil->RowType]);

		// Render row
		$gajitk_detil_grid->renderRow();

		// Render list options
		$gajitk_detil_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($gajitk_detil_grid->RowAction != "delete" && $gajitk_detil_grid->RowAction != "insertdelete" && !($gajitk_detil_grid->RowAction == "insert" && $gajitk_detil->isConfirm() && $gajitk_detil_grid->emptyRow())) {
?>
	<tr <?php echo $gajitk_detil->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajitk_detil_grid->ListOptions->render("body", "left", $gajitk_detil_grid->RowCount);
?>
	<?php if ($gajitk_detil_grid->pegawai_id->Visible) { // pegawai_id ?>
		<td data-name="pegawai_id" <?php echo $gajitk_detil_grid->pegawai_id->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_pegawai_id" class="form-group">
<?php $gajitk_detil_grid->pegawai_id->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id"><?php echo EmptyValue(strval($gajitk_detil_grid->pegawai_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $gajitk_detil_grid->pegawai_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajitk_detil_grid->pegawai_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gajitk_detil_grid->pegawai_id->ReadOnly || $gajitk_detil_grid->pegawai_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gajitk_detil_grid->pegawai_id->Lookup->getParamTag($gajitk_detil_grid, "p_x" . $gajitk_detil_grid->RowIndex . "_pegawai_id") ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajitk_detil_grid->pegawai_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo $gajitk_detil_grid->pegawai_id->CurrentValue ?>"<?php echo $gajitk_detil_grid->pegawai_id->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_pegawai_id" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo HtmlEncode($gajitk_detil_grid->pegawai_id->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_pegawai_id" class="form-group">
<?php $gajitk_detil_grid->pegawai_id->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id"><?php echo EmptyValue(strval($gajitk_detil_grid->pegawai_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $gajitk_detil_grid->pegawai_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajitk_detil_grid->pegawai_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gajitk_detil_grid->pegawai_id->ReadOnly || $gajitk_detil_grid->pegawai_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gajitk_detil_grid->pegawai_id->Lookup->getParamTag($gajitk_detil_grid, "p_x" . $gajitk_detil_grid->RowIndex . "_pegawai_id") ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajitk_detil_grid->pegawai_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo $gajitk_detil_grid->pegawai_id->CurrentValue ?>"<?php echo $gajitk_detil_grid->pegawai_id->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_pegawai_id">
<span<?php echo $gajitk_detil_grid->pegawai_id->viewAttributes() ?>><?php echo $gajitk_detil_grid->pegawai_id->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_pegawai_id" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo HtmlEncode($gajitk_detil_grid->pegawai_id->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_pegawai_id" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo HtmlEncode($gajitk_detil_grid->pegawai_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_pegawai_id" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo HtmlEncode($gajitk_detil_grid->pegawai_id->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_pegawai_id" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo HtmlEncode($gajitk_detil_grid->pegawai_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_id" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_id" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gajitk_detil_grid->id->CurrentValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_id" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_id" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gajitk_detil_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT || $gajitk_detil->CurrentMode == "edit") { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_id" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_id" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($gajitk_detil_grid->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($gajitk_detil_grid->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id" <?php echo $gajitk_detil_grid->jabatan_id->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jabatan_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="gajitk_detil" data-field="x_jabatan_id" data-value-separator="<?php echo $gajitk_detil_grid->jabatan_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id"<?php echo $gajitk_detil_grid->jabatan_id->editAttributes() ?>>
			<?php echo $gajitk_detil_grid->jabatan_id->selectOptionListHtml("x{$gajitk_detil_grid->RowIndex}_jabatan_id") ?>
		</select>
</div>
<?php echo $gajitk_detil_grid->jabatan_id->Lookup->getParamTag($gajitk_detil_grid, "p_x" . $gajitk_detil_grid->RowIndex . "_jabatan_id") ?>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_jabatan_id" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajitk_detil_grid->jabatan_id->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jabatan_id" class="form-group">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="gajitk_detil" data-field="x_jabatan_id" data-value-separator="<?php echo $gajitk_detil_grid->jabatan_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id"<?php echo $gajitk_detil_grid->jabatan_id->editAttributes() ?>>
			<?php echo $gajitk_detil_grid->jabatan_id->selectOptionListHtml("x{$gajitk_detil_grid->RowIndex}_jabatan_id") ?>
		</select>
</div>
<?php echo $gajitk_detil_grid->jabatan_id->Lookup->getParamTag($gajitk_detil_grid, "p_x" . $gajitk_detil_grid->RowIndex . "_jabatan_id") ?>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jabatan_id">
<span<?php echo $gajitk_detil_grid->jabatan_id->viewAttributes() ?>><?php echo $gajitk_detil_grid->jabatan_id->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jabatan_id" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajitk_detil_grid->jabatan_id->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_jabatan_id" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajitk_detil_grid->jabatan_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jabatan_id" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajitk_detil_grid->jabatan_id->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_jabatan_id" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajitk_detil_grid->jabatan_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->masakerja->Visible) { // masakerja ?>
		<td data-name="masakerja" <?php echo $gajitk_detil_grid->masakerja->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_masakerja" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_masakerja" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->masakerja->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->masakerja->EditValue ?>"<?php echo $gajitk_detil_grid->masakerja->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_masakerja" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" value="<?php echo HtmlEncode($gajitk_detil_grid->masakerja->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_masakerja" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_masakerja" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->masakerja->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->masakerja->EditValue ?>"<?php echo $gajitk_detil_grid->masakerja->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_masakerja">
<span<?php echo $gajitk_detil_grid->masakerja->viewAttributes() ?>><?php echo $gajitk_detil_grid->masakerja->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_masakerja" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" value="<?php echo HtmlEncode($gajitk_detil_grid->masakerja->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_masakerja" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" value="<?php echo HtmlEncode($gajitk_detil_grid->masakerja->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_masakerja" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" value="<?php echo HtmlEncode($gajitk_detil_grid->masakerja->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_masakerja" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" value="<?php echo HtmlEncode($gajitk_detil_grid->masakerja->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->jumngajar->Visible) { // jumngajar ?>
		<td data-name="jumngajar" <?php echo $gajitk_detil_grid->jumngajar->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jumngajar" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_jumngajar" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->jumngajar->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->jumngajar->EditValue ?>"<?php echo $gajitk_detil_grid->jumngajar->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumngajar" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" value="<?php echo HtmlEncode($gajitk_detil_grid->jumngajar->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jumngajar" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_jumngajar" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->jumngajar->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->jumngajar->EditValue ?>"<?php echo $gajitk_detil_grid->jumngajar->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jumngajar">
<span<?php echo $gajitk_detil_grid->jumngajar->viewAttributes() ?>><?php echo $gajitk_detil_grid->jumngajar->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumngajar" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" value="<?php echo HtmlEncode($gajitk_detil_grid->jumngajar->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_jumngajar" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" value="<?php echo HtmlEncode($gajitk_detil_grid->jumngajar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumngajar" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" value="<?php echo HtmlEncode($gajitk_detil_grid->jumngajar->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_jumngajar" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" value="<?php echo HtmlEncode($gajitk_detil_grid->jumngajar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->ijin->Visible) { // ijin ?>
		<td data-name="ijin" <?php echo $gajitk_detil_grid->ijin->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_ijin" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_ijin" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->ijin->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->ijin->EditValue ?>"<?php echo $gajitk_detil_grid->ijin->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_ijin" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($gajitk_detil_grid->ijin->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_ijin" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_ijin" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->ijin->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->ijin->EditValue ?>"<?php echo $gajitk_detil_grid->ijin->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_ijin">
<span<?php echo $gajitk_detil_grid->ijin->viewAttributes() ?>><?php echo $gajitk_detil_grid->ijin->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_ijin" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($gajitk_detil_grid->ijin->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_ijin" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($gajitk_detil_grid->ijin->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_ijin" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($gajitk_detil_grid->ijin->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_ijin" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($gajitk_detil_grid->ijin->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->voucher->Visible) { // voucher ?>
		<td data-name="voucher" <?php echo $gajitk_detil_grid->voucher->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_voucher" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_voucher" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->voucher->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->voucher->EditValue ?>"<?php echo $gajitk_detil_grid->voucher->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_voucher" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" value="<?php echo HtmlEncode($gajitk_detil_grid->voucher->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_voucher" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_voucher" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->voucher->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->voucher->EditValue ?>"<?php echo $gajitk_detil_grid->voucher->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_voucher">
<span<?php echo $gajitk_detil_grid->voucher->viewAttributes() ?>><?php echo $gajitk_detil_grid->voucher->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_voucher" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" value="<?php echo HtmlEncode($gajitk_detil_grid->voucher->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_voucher" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" value="<?php echo HtmlEncode($gajitk_detil_grid->voucher->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_voucher" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" value="<?php echo HtmlEncode($gajitk_detil_grid->voucher->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_voucher" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" value="<?php echo HtmlEncode($gajitk_detil_grid->voucher->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
		<td data-name="tunjangan_khusus" <?php echo $gajitk_detil_grid->tunjangan_khusus->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_tunjangan_khusus" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_tunjangan_khusus" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_khusus->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->tunjangan_khusus->EditValue ?>"<?php echo $gajitk_detil_grid->tunjangan_khusus->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_tunjangan_khusus" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" value="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_khusus->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_tunjangan_khusus" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_tunjangan_khusus" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_khusus->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->tunjangan_khusus->EditValue ?>"<?php echo $gajitk_detil_grid->tunjangan_khusus->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_tunjangan_khusus">
<span<?php echo $gajitk_detil_grid->tunjangan_khusus->viewAttributes() ?>><?php echo $gajitk_detil_grid->tunjangan_khusus->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_tunjangan_khusus" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" value="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_khusus->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_tunjangan_khusus" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" value="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_khusus->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_tunjangan_khusus" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" value="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_khusus->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_tunjangan_khusus" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" value="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_khusus->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
		<td data-name="tunjangan_jabatan" <?php echo $gajitk_detil_grid->tunjangan_jabatan->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_tunjangan_jabatan" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_tunjangan_jabatan" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_jabatan->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->tunjangan_jabatan->EditValue ?>"<?php echo $gajitk_detil_grid->tunjangan_jabatan->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_tunjangan_jabatan" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" value="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_jabatan->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_tunjangan_jabatan" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_tunjangan_jabatan" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_jabatan->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->tunjangan_jabatan->EditValue ?>"<?php echo $gajitk_detil_grid->tunjangan_jabatan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_tunjangan_jabatan">
<span<?php echo $gajitk_detil_grid->tunjangan_jabatan->viewAttributes() ?>><?php echo $gajitk_detil_grid->tunjangan_jabatan->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_tunjangan_jabatan" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" value="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_jabatan->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_tunjangan_jabatan" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" value="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_jabatan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_tunjangan_jabatan" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" value="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_jabatan->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_tunjangan_jabatan" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" value="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_jabatan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->baku->Visible) { // baku ?>
		<td data-name="baku" <?php echo $gajitk_detil_grid->baku->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_baku" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_baku" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_baku" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_baku" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->baku->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->baku->EditValue ?>"<?php echo $gajitk_detil_grid->baku->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_baku" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_baku" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_baku" value="<?php echo HtmlEncode($gajitk_detil_grid->baku->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_baku" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_baku" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_baku" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_baku" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->baku->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->baku->EditValue ?>"<?php echo $gajitk_detil_grid->baku->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_baku">
<span<?php echo $gajitk_detil_grid->baku->viewAttributes() ?>><?php echo $gajitk_detil_grid->baku->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_baku" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_baku" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_baku" value="<?php echo HtmlEncode($gajitk_detil_grid->baku->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_baku" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_baku" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_baku" value="<?php echo HtmlEncode($gajitk_detil_grid->baku->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_baku" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_baku" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_baku" value="<?php echo HtmlEncode($gajitk_detil_grid->baku->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_baku" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_baku" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_baku" value="<?php echo HtmlEncode($gajitk_detil_grid->baku->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran" <?php echo $gajitk_detil_grid->kehadiran->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_kehadiran" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_kehadiran" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->kehadiran->EditValue ?>"<?php echo $gajitk_detil_grid->kehadiran->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_kehadiran" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gajitk_detil_grid->kehadiran->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_kehadiran" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_kehadiran" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->kehadiran->EditValue ?>"<?php echo $gajitk_detil_grid->kehadiran->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_kehadiran">
<span<?php echo $gajitk_detil_grid->kehadiran->viewAttributes() ?>><?php echo $gajitk_detil_grid->kehadiran->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_kehadiran" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gajitk_detil_grid->kehadiran->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_kehadiran" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gajitk_detil_grid->kehadiran->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_kehadiran" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gajitk_detil_grid->kehadiran->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_kehadiran" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gajitk_detil_grid->kehadiran->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->prestasi->Visible) { // prestasi ?>
		<td data-name="prestasi" <?php echo $gajitk_detil_grid->prestasi->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_prestasi" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_prestasi" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->prestasi->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->prestasi->EditValue ?>"<?php echo $gajitk_detil_grid->prestasi->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_prestasi" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" value="<?php echo HtmlEncode($gajitk_detil_grid->prestasi->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_prestasi" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_prestasi" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->prestasi->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->prestasi->EditValue ?>"<?php echo $gajitk_detil_grid->prestasi->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_prestasi">
<span<?php echo $gajitk_detil_grid->prestasi->viewAttributes() ?>><?php echo $gajitk_detil_grid->prestasi->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_prestasi" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" value="<?php echo HtmlEncode($gajitk_detil_grid->prestasi->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_prestasi" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" value="<?php echo HtmlEncode($gajitk_detil_grid->prestasi->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_prestasi" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" value="<?php echo HtmlEncode($gajitk_detil_grid->prestasi->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_prestasi" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" value="<?php echo HtmlEncode($gajitk_detil_grid->prestasi->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->jumlahgaji->Visible) { // jumlahgaji ?>
		<td data-name="jumlahgaji" <?php echo $gajitk_detil_grid->jumlahgaji->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jumlahgaji" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_jumlahgaji" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->jumlahgaji->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->jumlahgaji->EditValue ?>"<?php echo $gajitk_detil_grid->jumlahgaji->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumlahgaji" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" value="<?php echo HtmlEncode($gajitk_detil_grid->jumlahgaji->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jumlahgaji" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_jumlahgaji" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->jumlahgaji->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->jumlahgaji->EditValue ?>"<?php echo $gajitk_detil_grid->jumlahgaji->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jumlahgaji">
<span<?php echo $gajitk_detil_grid->jumlahgaji->viewAttributes() ?>><?php echo $gajitk_detil_grid->jumlahgaji->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumlahgaji" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" value="<?php echo HtmlEncode($gajitk_detil_grid->jumlahgaji->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_jumlahgaji" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" value="<?php echo HtmlEncode($gajitk_detil_grid->jumlahgaji->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumlahgaji" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" value="<?php echo HtmlEncode($gajitk_detil_grid->jumlahgaji->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_jumlahgaji" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" value="<?php echo HtmlEncode($gajitk_detil_grid->jumlahgaji->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->jumgajitotal->Visible) { // jumgajitotal ?>
		<td data-name="jumgajitotal" <?php echo $gajitk_detil_grid->jumgajitotal->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jumgajitotal" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_jumgajitotal" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->jumgajitotal->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->jumgajitotal->EditValue ?>"<?php echo $gajitk_detil_grid->jumgajitotal->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumgajitotal" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" value="<?php echo HtmlEncode($gajitk_detil_grid->jumgajitotal->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jumgajitotal" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_jumgajitotal" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->jumgajitotal->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->jumgajitotal->EditValue ?>"<?php echo $gajitk_detil_grid->jumgajitotal->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jumgajitotal">
<span<?php echo $gajitk_detil_grid->jumgajitotal->viewAttributes() ?>><?php echo $gajitk_detil_grid->jumgajitotal->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumgajitotal" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" value="<?php echo HtmlEncode($gajitk_detil_grid->jumgajitotal->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_jumgajitotal" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" value="<?php echo HtmlEncode($gajitk_detil_grid->jumgajitotal->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumgajitotal" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" value="<?php echo HtmlEncode($gajitk_detil_grid->jumgajitotal->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_jumgajitotal" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" value="<?php echo HtmlEncode($gajitk_detil_grid->jumgajitotal->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->potongan1->Visible) { // potongan1 ?>
		<td data-name="potongan1" <?php echo $gajitk_detil_grid->potongan1->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_potongan1" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_potongan1" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->potongan1->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->potongan1->EditValue ?>"<?php echo $gajitk_detil_grid->potongan1->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_potongan1" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" value="<?php echo HtmlEncode($gajitk_detil_grid->potongan1->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_potongan1" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_potongan1" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->potongan1->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->potongan1->EditValue ?>"<?php echo $gajitk_detil_grid->potongan1->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_potongan1">
<span<?php echo $gajitk_detil_grid->potongan1->viewAttributes() ?>><?php echo $gajitk_detil_grid->potongan1->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_potongan1" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" value="<?php echo HtmlEncode($gajitk_detil_grid->potongan1->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_potongan1" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" value="<?php echo HtmlEncode($gajitk_detil_grid->potongan1->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_potongan1" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" value="<?php echo HtmlEncode($gajitk_detil_grid->potongan1->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_potongan1" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" value="<?php echo HtmlEncode($gajitk_detil_grid->potongan1->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->potongan2->Visible) { // potongan2 ?>
		<td data-name="potongan2" <?php echo $gajitk_detil_grid->potongan2->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_potongan2" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_potongan2" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->potongan2->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->potongan2->EditValue ?>"<?php echo $gajitk_detil_grid->potongan2->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_potongan2" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" value="<?php echo HtmlEncode($gajitk_detil_grid->potongan2->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_potongan2" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_potongan2" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->potongan2->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->potongan2->EditValue ?>"<?php echo $gajitk_detil_grid->potongan2->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_potongan2">
<span<?php echo $gajitk_detil_grid->potongan2->viewAttributes() ?>><?php echo $gajitk_detil_grid->potongan2->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_potongan2" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" value="<?php echo HtmlEncode($gajitk_detil_grid->potongan2->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_potongan2" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" value="<?php echo HtmlEncode($gajitk_detil_grid->potongan2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_potongan2" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" value="<?php echo HtmlEncode($gajitk_detil_grid->potongan2->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_potongan2" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" value="<?php echo HtmlEncode($gajitk_detil_grid->potongan2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->jumlahterima->Visible) { // jumlahterima ?>
		<td data-name="jumlahterima" <?php echo $gajitk_detil_grid->jumlahterima->cellAttributes() ?>>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jumlahterima" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_jumlahterima" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->jumlahterima->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->jumlahterima->EditValue ?>"<?php echo $gajitk_detil_grid->jumlahterima->editAttributes() ?>>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumlahterima" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" value="<?php echo HtmlEncode($gajitk_detil_grid->jumlahterima->OldValue) ?>">
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jumlahterima" class="form-group">
<input type="text" data-table="gajitk_detil" data-field="x_jumlahterima" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->jumlahterima->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->jumlahterima->EditValue ?>"<?php echo $gajitk_detil_grid->jumlahterima->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($gajitk_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $gajitk_detil_grid->RowCount ?>_gajitk_detil_jumlahterima">
<span<?php echo $gajitk_detil_grid->jumlahterima->viewAttributes() ?>><?php echo $gajitk_detil_grid->jumlahterima->getViewValue() ?></span>
</span>
<?php if (!$gajitk_detil->isConfirm()) { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumlahterima" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" value="<?php echo HtmlEncode($gajitk_detil_grid->jumlahterima->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_jumlahterima" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" value="<?php echo HtmlEncode($gajitk_detil_grid->jumlahterima->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumlahterima" name="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" id="fgajitk_detilgrid$x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" value="<?php echo HtmlEncode($gajitk_detil_grid->jumlahterima->FormValue) ?>">
<input type="hidden" data-table="gajitk_detil" data-field="x_jumlahterima" name="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" id="fgajitk_detilgrid$o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" value="<?php echo HtmlEncode($gajitk_detil_grid->jumlahterima->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajitk_detil_grid->ListOptions->render("body", "right", $gajitk_detil_grid->RowCount);
?>
	</tr>
<?php if ($gajitk_detil->RowType == ROWTYPE_ADD || $gajitk_detil->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fgajitk_detilgrid", "load"], function() {
	fgajitk_detilgrid.updateLists(<?php echo $gajitk_detil_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$gajitk_detil_grid->isGridAdd() || $gajitk_detil->CurrentMode == "copy")
		if (!$gajitk_detil_grid->Recordset->EOF)
			$gajitk_detil_grid->Recordset->moveNext();
}
?>
<?php
	if ($gajitk_detil->CurrentMode == "add" || $gajitk_detil->CurrentMode == "copy" || $gajitk_detil->CurrentMode == "edit") {
		$gajitk_detil_grid->RowIndex = '$rowindex$';
		$gajitk_detil_grid->loadRowValues();

		// Set row properties
		$gajitk_detil->resetAttributes();
		$gajitk_detil->RowAttrs->merge(["data-rowindex" => $gajitk_detil_grid->RowIndex, "id" => "r0_gajitk_detil", "data-rowtype" => ROWTYPE_ADD]);
		$gajitk_detil->RowAttrs->appendClass("ew-template");
		$gajitk_detil->RowType = ROWTYPE_ADD;

		// Render row
		$gajitk_detil_grid->renderRow();

		// Render list options
		$gajitk_detil_grid->renderListOptions();
		$gajitk_detil_grid->StartRowCount = 0;
?>
	<tr <?php echo $gajitk_detil->rowAttributes() ?>>
<?php

// Render list options (body, left)
$gajitk_detil_grid->ListOptions->render("body", "left", $gajitk_detil_grid->RowIndex);
?>
	<?php if ($gajitk_detil_grid->pegawai_id->Visible) { // pegawai_id ?>
		<td data-name="pegawai_id">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_pegawai_id" class="form-group gajitk_detil_pegawai_id">
<?php $gajitk_detil_grid->pegawai_id->EditAttrs->prepend("onchange", "ew.autoFill(this);"); ?>
<div class="input-group ew-lookup-list">
	<div class="form-control ew-lookup-text" tabindex="-1" id="lu_x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id"><?php echo EmptyValue(strval($gajitk_detil_grid->pegawai_id->ViewValue)) ? $Language->phrase("PleaseSelect") : $gajitk_detil_grid->pegawai_id->ViewValue ?></div>
	<div class="input-group-append">
		<button type="button" title="<?php echo HtmlEncode(str_replace("%s", RemoveHtml($gajitk_detil_grid->pegawai_id->caption()), $Language->phrase("LookupLink", TRUE))) ?>" class="ew-lookup-btn btn btn-default"<?php echo ($gajitk_detil_grid->pegawai_id->ReadOnly || $gajitk_detil_grid->pegawai_id->Disabled) ? " disabled" : "" ?> onclick="ew.modalLookupShow({lnk:this,el:'x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id',m:0,n:10});"><i class="fas fa-search ew-icon"></i></button>
	</div>
</div>
<?php echo $gajitk_detil_grid->pegawai_id->Lookup->getParamTag($gajitk_detil_grid, "p_x" . $gajitk_detil_grid->RowIndex . "_pegawai_id") ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $gajitk_detil_grid->pegawai_id->displayValueSeparatorAttribute() ?>" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo $gajitk_detil_grid->pegawai_id->CurrentValue ?>"<?php echo $gajitk_detil_grid->pegawai_id->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_pegawai_id" class="form-group gajitk_detil_pegawai_id">
<span<?php echo $gajitk_detil_grid->pegawai_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->pegawai_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_pegawai_id" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo HtmlEncode($gajitk_detil_grid->pegawai_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_pegawai_id" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_pegawai_id" value="<?php echo HtmlEncode($gajitk_detil_grid->pegawai_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->jabatan_id->Visible) { // jabatan_id ?>
		<td data-name="jabatan_id">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_jabatan_id" class="form-group gajitk_detil_jabatan_id">
<div class="input-group">
	<select class="custom-select ew-custom-select" data-table="gajitk_detil" data-field="x_jabatan_id" data-value-separator="<?php echo $gajitk_detil_grid->jabatan_id->displayValueSeparatorAttribute() ?>" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id"<?php echo $gajitk_detil_grid->jabatan_id->editAttributes() ?>>
			<?php echo $gajitk_detil_grid->jabatan_id->selectOptionListHtml("x{$gajitk_detil_grid->RowIndex}_jabatan_id") ?>
		</select>
</div>
<?php echo $gajitk_detil_grid->jabatan_id->Lookup->getParamTag($gajitk_detil_grid, "p_x" . $gajitk_detil_grid->RowIndex . "_jabatan_id") ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_jabatan_id" class="form-group gajitk_detil_jabatan_id">
<span<?php echo $gajitk_detil_grid->jabatan_id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->jabatan_id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_jabatan_id" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajitk_detil_grid->jabatan_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jabatan_id" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jabatan_id" value="<?php echo HtmlEncode($gajitk_detil_grid->jabatan_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->masakerja->Visible) { // masakerja ?>
		<td data-name="masakerja">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_masakerja" class="form-group gajitk_detil_masakerja">
<input type="text" data-table="gajitk_detil" data-field="x_masakerja" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->masakerja->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->masakerja->EditValue ?>"<?php echo $gajitk_detil_grid->masakerja->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_masakerja" class="form-group gajitk_detil_masakerja">
<span<?php echo $gajitk_detil_grid->masakerja->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->masakerja->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_masakerja" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" value="<?php echo HtmlEncode($gajitk_detil_grid->masakerja->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_masakerja" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_masakerja" value="<?php echo HtmlEncode($gajitk_detil_grid->masakerja->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->jumngajar->Visible) { // jumngajar ?>
		<td data-name="jumngajar">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_jumngajar" class="form-group gajitk_detil_jumngajar">
<input type="text" data-table="gajitk_detil" data-field="x_jumngajar" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->jumngajar->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->jumngajar->EditValue ?>"<?php echo $gajitk_detil_grid->jumngajar->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_jumngajar" class="form-group gajitk_detil_jumngajar">
<span<?php echo $gajitk_detil_grid->jumngajar->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->jumngajar->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumngajar" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" value="<?php echo HtmlEncode($gajitk_detil_grid->jumngajar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumngajar" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumngajar" value="<?php echo HtmlEncode($gajitk_detil_grid->jumngajar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->ijin->Visible) { // ijin ?>
		<td data-name="ijin">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_ijin" class="form-group gajitk_detil_ijin">
<input type="text" data-table="gajitk_detil" data-field="x_ijin" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" size="30" maxlength="6" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->ijin->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->ijin->EditValue ?>"<?php echo $gajitk_detil_grid->ijin->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_ijin" class="form-group gajitk_detil_ijin">
<span<?php echo $gajitk_detil_grid->ijin->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->ijin->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_ijin" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($gajitk_detil_grid->ijin->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_ijin" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($gajitk_detil_grid->ijin->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->voucher->Visible) { // voucher ?>
		<td data-name="voucher">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_voucher" class="form-group gajitk_detil_voucher">
<input type="text" data-table="gajitk_detil" data-field="x_voucher" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->voucher->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->voucher->EditValue ?>"<?php echo $gajitk_detil_grid->voucher->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_voucher" class="form-group gajitk_detil_voucher">
<span<?php echo $gajitk_detil_grid->voucher->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->voucher->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_voucher" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" value="<?php echo HtmlEncode($gajitk_detil_grid->voucher->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_voucher" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_voucher" value="<?php echo HtmlEncode($gajitk_detil_grid->voucher->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->tunjangan_khusus->Visible) { // tunjangan_khusus ?>
		<td data-name="tunjangan_khusus">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_tunjangan_khusus" class="form-group gajitk_detil_tunjangan_khusus">
<input type="text" data-table="gajitk_detil" data-field="x_tunjangan_khusus" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_khusus->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->tunjangan_khusus->EditValue ?>"<?php echo $gajitk_detil_grid->tunjangan_khusus->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_tunjangan_khusus" class="form-group gajitk_detil_tunjangan_khusus">
<span<?php echo $gajitk_detil_grid->tunjangan_khusus->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->tunjangan_khusus->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_tunjangan_khusus" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" value="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_khusus->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_tunjangan_khusus" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_khusus" value="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_khusus->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->tunjangan_jabatan->Visible) { // tunjangan_jabatan ?>
		<td data-name="tunjangan_jabatan">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_tunjangan_jabatan" class="form-group gajitk_detil_tunjangan_jabatan">
<input type="text" data-table="gajitk_detil" data-field="x_tunjangan_jabatan" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_jabatan->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->tunjangan_jabatan->EditValue ?>"<?php echo $gajitk_detil_grid->tunjangan_jabatan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_tunjangan_jabatan" class="form-group gajitk_detil_tunjangan_jabatan">
<span<?php echo $gajitk_detil_grid->tunjangan_jabatan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->tunjangan_jabatan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_tunjangan_jabatan" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" value="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_jabatan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_tunjangan_jabatan" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_tunjangan_jabatan" value="<?php echo HtmlEncode($gajitk_detil_grid->tunjangan_jabatan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->baku->Visible) { // baku ?>
		<td data-name="baku">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_baku" class="form-group gajitk_detil_baku">
<input type="text" data-table="gajitk_detil" data-field="x_baku" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_baku" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_baku" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->baku->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->baku->EditValue ?>"<?php echo $gajitk_detil_grid->baku->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_baku" class="form-group gajitk_detil_baku">
<span<?php echo $gajitk_detil_grid->baku->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->baku->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_baku" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_baku" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_baku" value="<?php echo HtmlEncode($gajitk_detil_grid->baku->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_baku" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_baku" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_baku" value="<?php echo HtmlEncode($gajitk_detil_grid->baku->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->kehadiran->Visible) { // kehadiran ?>
		<td data-name="kehadiran">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_kehadiran" class="form-group gajitk_detil_kehadiran">
<input type="text" data-table="gajitk_detil" data-field="x_kehadiran" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->kehadiran->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->kehadiran->EditValue ?>"<?php echo $gajitk_detil_grid->kehadiran->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_kehadiran" class="form-group gajitk_detil_kehadiran">
<span<?php echo $gajitk_detil_grid->kehadiran->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->kehadiran->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_kehadiran" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gajitk_detil_grid->kehadiran->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_kehadiran" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_kehadiran" value="<?php echo HtmlEncode($gajitk_detil_grid->kehadiran->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->prestasi->Visible) { // prestasi ?>
		<td data-name="prestasi">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_prestasi" class="form-group gajitk_detil_prestasi">
<input type="text" data-table="gajitk_detil" data-field="x_prestasi" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->prestasi->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->prestasi->EditValue ?>"<?php echo $gajitk_detil_grid->prestasi->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_prestasi" class="form-group gajitk_detil_prestasi">
<span<?php echo $gajitk_detil_grid->prestasi->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->prestasi->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_prestasi" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" value="<?php echo HtmlEncode($gajitk_detil_grid->prestasi->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_prestasi" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_prestasi" value="<?php echo HtmlEncode($gajitk_detil_grid->prestasi->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->jumlahgaji->Visible) { // jumlahgaji ?>
		<td data-name="jumlahgaji">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_jumlahgaji" class="form-group gajitk_detil_jumlahgaji">
<input type="text" data-table="gajitk_detil" data-field="x_jumlahgaji" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->jumlahgaji->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->jumlahgaji->EditValue ?>"<?php echo $gajitk_detil_grid->jumlahgaji->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_jumlahgaji" class="form-group gajitk_detil_jumlahgaji">
<span<?php echo $gajitk_detil_grid->jumlahgaji->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->jumlahgaji->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumlahgaji" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" value="<?php echo HtmlEncode($gajitk_detil_grid->jumlahgaji->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumlahgaji" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahgaji" value="<?php echo HtmlEncode($gajitk_detil_grid->jumlahgaji->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->jumgajitotal->Visible) { // jumgajitotal ?>
		<td data-name="jumgajitotal">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_jumgajitotal" class="form-group gajitk_detil_jumgajitotal">
<input type="text" data-table="gajitk_detil" data-field="x_jumgajitotal" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->jumgajitotal->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->jumgajitotal->EditValue ?>"<?php echo $gajitk_detil_grid->jumgajitotal->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_jumgajitotal" class="form-group gajitk_detil_jumgajitotal">
<span<?php echo $gajitk_detil_grid->jumgajitotal->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->jumgajitotal->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumgajitotal" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" value="<?php echo HtmlEncode($gajitk_detil_grid->jumgajitotal->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumgajitotal" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumgajitotal" value="<?php echo HtmlEncode($gajitk_detil_grid->jumgajitotal->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->potongan1->Visible) { // potongan1 ?>
		<td data-name="potongan1">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_potongan1" class="form-group gajitk_detil_potongan1">
<input type="text" data-table="gajitk_detil" data-field="x_potongan1" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->potongan1->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->potongan1->EditValue ?>"<?php echo $gajitk_detil_grid->potongan1->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_potongan1" class="form-group gajitk_detil_potongan1">
<span<?php echo $gajitk_detil_grid->potongan1->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->potongan1->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_potongan1" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" value="<?php echo HtmlEncode($gajitk_detil_grid->potongan1->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_potongan1" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan1" value="<?php echo HtmlEncode($gajitk_detil_grid->potongan1->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->potongan2->Visible) { // potongan2 ?>
		<td data-name="potongan2">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_potongan2" class="form-group gajitk_detil_potongan2">
<input type="text" data-table="gajitk_detil" data-field="x_potongan2" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->potongan2->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->potongan2->EditValue ?>"<?php echo $gajitk_detil_grid->potongan2->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_potongan2" class="form-group gajitk_detil_potongan2">
<span<?php echo $gajitk_detil_grid->potongan2->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->potongan2->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_potongan2" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" value="<?php echo HtmlEncode($gajitk_detil_grid->potongan2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_potongan2" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_potongan2" value="<?php echo HtmlEncode($gajitk_detil_grid->potongan2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($gajitk_detil_grid->jumlahterima->Visible) { // jumlahterima ?>
		<td data-name="jumlahterima">
<?php if (!$gajitk_detil->isConfirm()) { ?>
<span id="el$rowindex$_gajitk_detil_jumlahterima" class="form-group gajitk_detil_jumlahterima">
<input type="text" data-table="gajitk_detil" data-field="x_jumlahterima" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($gajitk_detil_grid->jumlahterima->getPlaceHolder()) ?>" value="<?php echo $gajitk_detil_grid->jumlahterima->EditValue ?>"<?php echo $gajitk_detil_grid->jumlahterima->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_gajitk_detil_jumlahterima" class="form-group gajitk_detil_jumlahterima">
<span<?php echo $gajitk_detil_grid->jumlahterima->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($gajitk_detil_grid->jumlahterima->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumlahterima" name="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" id="x<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" value="<?php echo HtmlEncode($gajitk_detil_grid->jumlahterima->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="gajitk_detil" data-field="x_jumlahterima" name="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" id="o<?php echo $gajitk_detil_grid->RowIndex ?>_jumlahterima" value="<?php echo HtmlEncode($gajitk_detil_grid->jumlahterima->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$gajitk_detil_grid->ListOptions->render("body", "right", $gajitk_detil_grid->RowIndex);
?>
<script>
loadjs.ready(["fgajitk_detilgrid", "load"], function() {
	fgajitk_detilgrid.updateLists(<?php echo $gajitk_detil_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($gajitk_detil->CurrentMode == "add" || $gajitk_detil->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $gajitk_detil_grid->FormKeyCountName ?>" id="<?php echo $gajitk_detil_grid->FormKeyCountName ?>" value="<?php echo $gajitk_detil_grid->KeyCount ?>">
<?php echo $gajitk_detil_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($gajitk_detil->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $gajitk_detil_grid->FormKeyCountName ?>" id="<?php echo $gajitk_detil_grid->FormKeyCountName ?>" value="<?php echo $gajitk_detil_grid->KeyCount ?>">
<?php echo $gajitk_detil_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($gajitk_detil->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fgajitk_detilgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($gajitk_detil_grid->Recordset)
	$gajitk_detil_grid->Recordset->Close();
?>
<?php if ($gajitk_detil_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $gajitk_detil_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($gajitk_detil_grid->TotalRecords == 0 && !$gajitk_detil->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $gajitk_detil_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$gajitk_detil_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$gajitk_detil_grid->terminate();
?>