<?php
namespace PHPMaker2020\sigap;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($absen_detil_grid))
	$absen_detil_grid = new absen_detil_grid();

// Run the page
$absen_detil_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$absen_detil_grid->Page_Render();
?>
<?php if (!$absen_detil_grid->isExport()) { ?>
<script>
var fabsen_detilgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fabsen_detilgrid = new ew.Form("fabsen_detilgrid", "grid");
	fabsen_detilgrid.formKeyCountName = '<?php echo $absen_detil_grid->FormKeyCountName ?>';

	// Validate form
	fabsen_detilgrid.validate = function() {
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
			<?php if ($absen_detil_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_grid->id->caption(), $absen_detil_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($absen_detil_grid->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_grid->pid->caption(), $absen_detil_grid->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_grid->pid->errorMessage()) ?>");
			<?php if ($absen_detil_grid->pegawai->Required) { ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_grid->pegawai->caption(), $absen_detil_grid->pegawai->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pegawai");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_grid->pegawai->errorMessage()) ?>");
			<?php if ($absen_detil_grid->masuk->Required) { ?>
				elm = this.getElements("x" + infix + "_masuk");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_grid->masuk->caption(), $absen_detil_grid->masuk->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_masuk");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_grid->masuk->errorMessage()) ?>");
			<?php if ($absen_detil_grid->absen->Required) { ?>
				elm = this.getElements("x" + infix + "_absen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_grid->absen->caption(), $absen_detil_grid->absen->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_absen");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_grid->absen->errorMessage()) ?>");
			<?php if ($absen_detil_grid->ijin->Required) { ?>
				elm = this.getElements("x" + infix + "_ijin");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_grid->ijin->caption(), $absen_detil_grid->ijin->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_ijin");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_grid->ijin->errorMessage()) ?>");
			<?php if ($absen_detil_grid->cuti->Required) { ?>
				elm = this.getElements("x" + infix + "_cuti");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_grid->cuti->caption(), $absen_detil_grid->cuti->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_cuti");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_grid->cuti->errorMessage()) ?>");
			<?php if ($absen_detil_grid->dinas_luar->Required) { ?>
				elm = this.getElements("x" + infix + "_dinas_luar");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_grid->dinas_luar->caption(), $absen_detil_grid->dinas_luar->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_dinas_luar");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_grid->dinas_luar->errorMessage()) ?>");
			<?php if ($absen_detil_grid->terlambat->Required) { ?>
				elm = this.getElements("x" + infix + "_terlambat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $absen_detil_grid->terlambat->caption(), $absen_detil_grid->terlambat->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_terlambat");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($absen_detil_grid->terlambat->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fabsen_detilgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pid", false)) return false;
		if (ew.valueChanged(fobj, infix, "pegawai", false)) return false;
		if (ew.valueChanged(fobj, infix, "masuk", false)) return false;
		if (ew.valueChanged(fobj, infix, "absen", false)) return false;
		if (ew.valueChanged(fobj, infix, "ijin", false)) return false;
		if (ew.valueChanged(fobj, infix, "cuti", false)) return false;
		if (ew.valueChanged(fobj, infix, "dinas_luar", false)) return false;
		if (ew.valueChanged(fobj, infix, "terlambat", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fabsen_detilgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fabsen_detilgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fabsen_detilgrid");
});
</script>
<?php } ?>
<?php
$absen_detil_grid->renderOtherOptions();
?>
<?php if ($absen_detil_grid->TotalRecords > 0 || $absen_detil->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($absen_detil_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> absen_detil">
<?php if ($absen_detil_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $absen_detil_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fabsen_detilgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_absen_detil" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_absen_detilgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$absen_detil->RowType = ROWTYPE_HEADER;

// Render list options
$absen_detil_grid->renderListOptions();

// Render list options (header, left)
$absen_detil_grid->ListOptions->render("header", "left");
?>
<?php if ($absen_detil_grid->id->Visible) { // id ?>
	<?php if ($absen_detil_grid->SortUrl($absen_detil_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $absen_detil_grid->id->headerCellClass() ?>"><div id="elh_absen_detil_id" class="absen_detil_id"><div class="ew-table-header-caption"><?php echo $absen_detil_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $absen_detil_grid->id->headerCellClass() ?>"><div><div id="elh_absen_detil_id" class="absen_detil_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $absen_detil_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($absen_detil_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($absen_detil_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($absen_detil_grid->pid->Visible) { // pid ?>
	<?php if ($absen_detil_grid->SortUrl($absen_detil_grid->pid) == "") { ?>
		<th data-name="pid" class="<?php echo $absen_detil_grid->pid->headerCellClass() ?>"><div id="elh_absen_detil_pid" class="absen_detil_pid"><div class="ew-table-header-caption"><?php echo $absen_detil_grid->pid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid" class="<?php echo $absen_detil_grid->pid->headerCellClass() ?>"><div><div id="elh_absen_detil_pid" class="absen_detil_pid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $absen_detil_grid->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($absen_detil_grid->pid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($absen_detil_grid->pid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($absen_detil_grid->pegawai->Visible) { // pegawai ?>
	<?php if ($absen_detil_grid->SortUrl($absen_detil_grid->pegawai) == "") { ?>
		<th data-name="pegawai" class="<?php echo $absen_detil_grid->pegawai->headerCellClass() ?>"><div id="elh_absen_detil_pegawai" class="absen_detil_pegawai"><div class="ew-table-header-caption"><?php echo $absen_detil_grid->pegawai->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai" class="<?php echo $absen_detil_grid->pegawai->headerCellClass() ?>"><div><div id="elh_absen_detil_pegawai" class="absen_detil_pegawai">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $absen_detil_grid->pegawai->caption() ?></span><span class="ew-table-header-sort"><?php if ($absen_detil_grid->pegawai->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($absen_detil_grid->pegawai->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($absen_detil_grid->masuk->Visible) { // masuk ?>
	<?php if ($absen_detil_grid->SortUrl($absen_detil_grid->masuk) == "") { ?>
		<th data-name="masuk" class="<?php echo $absen_detil_grid->masuk->headerCellClass() ?>"><div id="elh_absen_detil_masuk" class="absen_detil_masuk"><div class="ew-table-header-caption"><?php echo $absen_detil_grid->masuk->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="masuk" class="<?php echo $absen_detil_grid->masuk->headerCellClass() ?>"><div><div id="elh_absen_detil_masuk" class="absen_detil_masuk">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $absen_detil_grid->masuk->caption() ?></span><span class="ew-table-header-sort"><?php if ($absen_detil_grid->masuk->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($absen_detil_grid->masuk->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($absen_detil_grid->absen->Visible) { // absen ?>
	<?php if ($absen_detil_grid->SortUrl($absen_detil_grid->absen) == "") { ?>
		<th data-name="absen" class="<?php echo $absen_detil_grid->absen->headerCellClass() ?>"><div id="elh_absen_detil_absen" class="absen_detil_absen"><div class="ew-table-header-caption"><?php echo $absen_detil_grid->absen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="absen" class="<?php echo $absen_detil_grid->absen->headerCellClass() ?>"><div><div id="elh_absen_detil_absen" class="absen_detil_absen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $absen_detil_grid->absen->caption() ?></span><span class="ew-table-header-sort"><?php if ($absen_detil_grid->absen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($absen_detil_grid->absen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($absen_detil_grid->ijin->Visible) { // ijin ?>
	<?php if ($absen_detil_grid->SortUrl($absen_detil_grid->ijin) == "") { ?>
		<th data-name="ijin" class="<?php echo $absen_detil_grid->ijin->headerCellClass() ?>"><div id="elh_absen_detil_ijin" class="absen_detil_ijin"><div class="ew-table-header-caption"><?php echo $absen_detil_grid->ijin->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ijin" class="<?php echo $absen_detil_grid->ijin->headerCellClass() ?>"><div><div id="elh_absen_detil_ijin" class="absen_detil_ijin">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $absen_detil_grid->ijin->caption() ?></span><span class="ew-table-header-sort"><?php if ($absen_detil_grid->ijin->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($absen_detil_grid->ijin->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($absen_detil_grid->cuti->Visible) { // cuti ?>
	<?php if ($absen_detil_grid->SortUrl($absen_detil_grid->cuti) == "") { ?>
		<th data-name="cuti" class="<?php echo $absen_detil_grid->cuti->headerCellClass() ?>"><div id="elh_absen_detil_cuti" class="absen_detil_cuti"><div class="ew-table-header-caption"><?php echo $absen_detil_grid->cuti->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cuti" class="<?php echo $absen_detil_grid->cuti->headerCellClass() ?>"><div><div id="elh_absen_detil_cuti" class="absen_detil_cuti">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $absen_detil_grid->cuti->caption() ?></span><span class="ew-table-header-sort"><?php if ($absen_detil_grid->cuti->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($absen_detil_grid->cuti->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($absen_detil_grid->dinas_luar->Visible) { // dinas_luar ?>
	<?php if ($absen_detil_grid->SortUrl($absen_detil_grid->dinas_luar) == "") { ?>
		<th data-name="dinas_luar" class="<?php echo $absen_detil_grid->dinas_luar->headerCellClass() ?>"><div id="elh_absen_detil_dinas_luar" class="absen_detil_dinas_luar"><div class="ew-table-header-caption"><?php echo $absen_detil_grid->dinas_luar->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dinas_luar" class="<?php echo $absen_detil_grid->dinas_luar->headerCellClass() ?>"><div><div id="elh_absen_detil_dinas_luar" class="absen_detil_dinas_luar">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $absen_detil_grid->dinas_luar->caption() ?></span><span class="ew-table-header-sort"><?php if ($absen_detil_grid->dinas_luar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($absen_detil_grid->dinas_luar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($absen_detil_grid->terlambat->Visible) { // terlambat ?>
	<?php if ($absen_detil_grid->SortUrl($absen_detil_grid->terlambat) == "") { ?>
		<th data-name="terlambat" class="<?php echo $absen_detil_grid->terlambat->headerCellClass() ?>"><div id="elh_absen_detil_terlambat" class="absen_detil_terlambat"><div class="ew-table-header-caption"><?php echo $absen_detil_grid->terlambat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="terlambat" class="<?php echo $absen_detil_grid->terlambat->headerCellClass() ?>"><div><div id="elh_absen_detil_terlambat" class="absen_detil_terlambat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $absen_detil_grid->terlambat->caption() ?></span><span class="ew-table-header-sort"><?php if ($absen_detil_grid->terlambat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($absen_detil_grid->terlambat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$absen_detil_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$absen_detil_grid->StartRecord = 1;
$absen_detil_grid->StopRecord = $absen_detil_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($absen_detil->isConfirm() || $absen_detil_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($absen_detil_grid->FormKeyCountName) && ($absen_detil_grid->isGridAdd() || $absen_detil_grid->isGridEdit() || $absen_detil->isConfirm())) {
		$absen_detil_grid->KeyCount = $CurrentForm->getValue($absen_detil_grid->FormKeyCountName);
		$absen_detil_grid->StopRecord = $absen_detil_grid->StartRecord + $absen_detil_grid->KeyCount - 1;
	}
}
$absen_detil_grid->RecordCount = $absen_detil_grid->StartRecord - 1;
if ($absen_detil_grid->Recordset && !$absen_detil_grid->Recordset->EOF) {
	$absen_detil_grid->Recordset->moveFirst();
	$selectLimit = $absen_detil_grid->UseSelectLimit;
	if (!$selectLimit && $absen_detil_grid->StartRecord > 1)
		$absen_detil_grid->Recordset->move($absen_detil_grid->StartRecord - 1);
} elseif (!$absen_detil->AllowAddDeleteRow && $absen_detil_grid->StopRecord == 0) {
	$absen_detil_grid->StopRecord = $absen_detil->GridAddRowCount;
}

// Initialize aggregate
$absen_detil->RowType = ROWTYPE_AGGREGATEINIT;
$absen_detil->resetAttributes();
$absen_detil_grid->renderRow();
if ($absen_detil_grid->isGridAdd())
	$absen_detil_grid->RowIndex = 0;
if ($absen_detil_grid->isGridEdit())
	$absen_detil_grid->RowIndex = 0;
while ($absen_detil_grid->RecordCount < $absen_detil_grid->StopRecord) {
	$absen_detil_grid->RecordCount++;
	if ($absen_detil_grid->RecordCount >= $absen_detil_grid->StartRecord) {
		$absen_detil_grid->RowCount++;
		if ($absen_detil_grid->isGridAdd() || $absen_detil_grid->isGridEdit() || $absen_detil->isConfirm()) {
			$absen_detil_grid->RowIndex++;
			$CurrentForm->Index = $absen_detil_grid->RowIndex;
			if ($CurrentForm->hasValue($absen_detil_grid->FormActionName) && ($absen_detil->isConfirm() || $absen_detil_grid->EventCancelled))
				$absen_detil_grid->RowAction = strval($CurrentForm->getValue($absen_detil_grid->FormActionName));
			elseif ($absen_detil_grid->isGridAdd())
				$absen_detil_grid->RowAction = "insert";
			else
				$absen_detil_grid->RowAction = "";
		}

		// Set up key count
		$absen_detil_grid->KeyCount = $absen_detil_grid->RowIndex;

		// Init row class and style
		$absen_detil->resetAttributes();
		$absen_detil->CssClass = "";
		if ($absen_detil_grid->isGridAdd()) {
			if ($absen_detil->CurrentMode == "copy") {
				$absen_detil_grid->loadRowValues($absen_detil_grid->Recordset); // Load row values
				$absen_detil_grid->setRecordKey($absen_detil_grid->RowOldKey, $absen_detil_grid->Recordset); // Set old record key
			} else {
				$absen_detil_grid->loadRowValues(); // Load default values
				$absen_detil_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$absen_detil_grid->loadRowValues($absen_detil_grid->Recordset); // Load row values
		}
		$absen_detil->RowType = ROWTYPE_VIEW; // Render view
		if ($absen_detil_grid->isGridAdd()) // Grid add
			$absen_detil->RowType = ROWTYPE_ADD; // Render add
		if ($absen_detil_grid->isGridAdd() && $absen_detil->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$absen_detil_grid->restoreCurrentRowFormValues($absen_detil_grid->RowIndex); // Restore form values
		if ($absen_detil_grid->isGridEdit()) { // Grid edit
			if ($absen_detil->EventCancelled)
				$absen_detil_grid->restoreCurrentRowFormValues($absen_detil_grid->RowIndex); // Restore form values
			if ($absen_detil_grid->RowAction == "insert")
				$absen_detil->RowType = ROWTYPE_ADD; // Render add
			else
				$absen_detil->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($absen_detil_grid->isGridEdit() && ($absen_detil->RowType == ROWTYPE_EDIT || $absen_detil->RowType == ROWTYPE_ADD) && $absen_detil->EventCancelled) // Update failed
			$absen_detil_grid->restoreCurrentRowFormValues($absen_detil_grid->RowIndex); // Restore form values
		if ($absen_detil->RowType == ROWTYPE_EDIT) // Edit row
			$absen_detil_grid->EditRowCount++;
		if ($absen_detil->isConfirm()) // Confirm row
			$absen_detil_grid->restoreCurrentRowFormValues($absen_detil_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$absen_detil->RowAttrs->merge(["data-rowindex" => $absen_detil_grid->RowCount, "id" => "r" . $absen_detil_grid->RowCount . "_absen_detil", "data-rowtype" => $absen_detil->RowType]);

		// Render row
		$absen_detil_grid->renderRow();

		// Render list options
		$absen_detil_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($absen_detil_grid->RowAction != "delete" && $absen_detil_grid->RowAction != "insertdelete" && !($absen_detil_grid->RowAction == "insert" && $absen_detil->isConfirm() && $absen_detil_grid->emptyRow())) {
?>
	<tr <?php echo $absen_detil->rowAttributes() ?>>
<?php

// Render list options (body, left)
$absen_detil_grid->ListOptions->render("body", "left", $absen_detil_grid->RowCount);
?>
	<?php if ($absen_detil_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $absen_detil_grid->id->cellAttributes() ?>>
<?php if ($absen_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_id" class="form-group"></span>
<input type="hidden" data-table="absen_detil" data-field="x_id" name="o<?php echo $absen_detil_grid->RowIndex ?>_id" id="o<?php echo $absen_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($absen_detil_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_id" class="form-group">
<span<?php echo $absen_detil_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($absen_detil_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_id" name="x<?php echo $absen_detil_grid->RowIndex ?>_id" id="x<?php echo $absen_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($absen_detil_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_id">
<span<?php echo $absen_detil_grid->id->viewAttributes() ?>><?php echo $absen_detil_grid->id->getViewValue() ?></span>
</span>
<?php if (!$absen_detil->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_id" name="x<?php echo $absen_detil_grid->RowIndex ?>_id" id="x<?php echo $absen_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($absen_detil_grid->id->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_id" name="o<?php echo $absen_detil_grid->RowIndex ?>_id" id="o<?php echo $absen_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($absen_detil_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="absen_detil" data-field="x_id" name="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_id" id="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($absen_detil_grid->id->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_id" name="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_id" id="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($absen_detil_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->pid->Visible) { // pid ?>
		<td data-name="pid" <?php echo $absen_detil_grid->pid->cellAttributes() ?>>
<?php if ($absen_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($absen_detil_grid->pid->getSessionValue() != "") { ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_pid" class="form-group">
<span<?php echo $absen_detil_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($absen_detil_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $absen_detil_grid->RowIndex ?>_pid" name="x<?php echo $absen_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($absen_detil_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_pid" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_pid" name="x<?php echo $absen_detil_grid->RowIndex ?>_pid" id="x<?php echo $absen_detil_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($absen_detil_grid->pid->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->pid->EditValue ?>"<?php echo $absen_detil_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_pid" name="o<?php echo $absen_detil_grid->RowIndex ?>_pid" id="o<?php echo $absen_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($absen_detil_grid->pid->OldValue) ?>">
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($absen_detil_grid->pid->getSessionValue() != "") { ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_pid" class="form-group">
<span<?php echo $absen_detil_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($absen_detil_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $absen_detil_grid->RowIndex ?>_pid" name="x<?php echo $absen_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($absen_detil_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_pid" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_pid" name="x<?php echo $absen_detil_grid->RowIndex ?>_pid" id="x<?php echo $absen_detil_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($absen_detil_grid->pid->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->pid->EditValue ?>"<?php echo $absen_detil_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_pid">
<span<?php echo $absen_detil_grid->pid->viewAttributes() ?>><?php echo $absen_detil_grid->pid->getViewValue() ?></span>
</span>
<?php if (!$absen_detil->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_pid" name="x<?php echo $absen_detil_grid->RowIndex ?>_pid" id="x<?php echo $absen_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($absen_detil_grid->pid->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_pid" name="o<?php echo $absen_detil_grid->RowIndex ?>_pid" id="o<?php echo $absen_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($absen_detil_grid->pid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="absen_detil" data-field="x_pid" name="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_pid" id="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($absen_detil_grid->pid->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_pid" name="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_pid" id="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($absen_detil_grid->pid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai" <?php echo $absen_detil_grid->pegawai->cellAttributes() ?>>
<?php if ($absen_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_pegawai" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_pegawai" name="x<?php echo $absen_detil_grid->RowIndex ?>_pegawai" id="x<?php echo $absen_detil_grid->RowIndex ?>_pegawai" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($absen_detil_grid->pegawai->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->pegawai->EditValue ?>"<?php echo $absen_detil_grid->pegawai->editAttributes() ?>>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_pegawai" name="o<?php echo $absen_detil_grid->RowIndex ?>_pegawai" id="o<?php echo $absen_detil_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($absen_detil_grid->pegawai->OldValue) ?>">
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_pegawai" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_pegawai" name="x<?php echo $absen_detil_grid->RowIndex ?>_pegawai" id="x<?php echo $absen_detil_grid->RowIndex ?>_pegawai" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($absen_detil_grid->pegawai->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->pegawai->EditValue ?>"<?php echo $absen_detil_grid->pegawai->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_pegawai">
<span<?php echo $absen_detil_grid->pegawai->viewAttributes() ?>><?php echo $absen_detil_grid->pegawai->getViewValue() ?></span>
</span>
<?php if (!$absen_detil->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_pegawai" name="x<?php echo $absen_detil_grid->RowIndex ?>_pegawai" id="x<?php echo $absen_detil_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($absen_detil_grid->pegawai->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_pegawai" name="o<?php echo $absen_detil_grid->RowIndex ?>_pegawai" id="o<?php echo $absen_detil_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($absen_detil_grid->pegawai->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="absen_detil" data-field="x_pegawai" name="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_pegawai" id="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($absen_detil_grid->pegawai->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_pegawai" name="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_pegawai" id="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($absen_detil_grid->pegawai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->masuk->Visible) { // masuk ?>
		<td data-name="masuk" <?php echo $absen_detil_grid->masuk->cellAttributes() ?>>
<?php if ($absen_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_masuk" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_masuk" name="x<?php echo $absen_detil_grid->RowIndex ?>_masuk" id="x<?php echo $absen_detil_grid->RowIndex ?>_masuk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->masuk->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->masuk->EditValue ?>"<?php echo $absen_detil_grid->masuk->editAttributes() ?>>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_masuk" name="o<?php echo $absen_detil_grid->RowIndex ?>_masuk" id="o<?php echo $absen_detil_grid->RowIndex ?>_masuk" value="<?php echo HtmlEncode($absen_detil_grid->masuk->OldValue) ?>">
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_masuk" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_masuk" name="x<?php echo $absen_detil_grid->RowIndex ?>_masuk" id="x<?php echo $absen_detil_grid->RowIndex ?>_masuk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->masuk->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->masuk->EditValue ?>"<?php echo $absen_detil_grid->masuk->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_masuk">
<span<?php echo $absen_detil_grid->masuk->viewAttributes() ?>><?php echo $absen_detil_grid->masuk->getViewValue() ?></span>
</span>
<?php if (!$absen_detil->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_masuk" name="x<?php echo $absen_detil_grid->RowIndex ?>_masuk" id="x<?php echo $absen_detil_grid->RowIndex ?>_masuk" value="<?php echo HtmlEncode($absen_detil_grid->masuk->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_masuk" name="o<?php echo $absen_detil_grid->RowIndex ?>_masuk" id="o<?php echo $absen_detil_grid->RowIndex ?>_masuk" value="<?php echo HtmlEncode($absen_detil_grid->masuk->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="absen_detil" data-field="x_masuk" name="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_masuk" id="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_masuk" value="<?php echo HtmlEncode($absen_detil_grid->masuk->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_masuk" name="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_masuk" id="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_masuk" value="<?php echo HtmlEncode($absen_detil_grid->masuk->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->absen->Visible) { // absen ?>
		<td data-name="absen" <?php echo $absen_detil_grid->absen->cellAttributes() ?>>
<?php if ($absen_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_absen" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_absen" name="x<?php echo $absen_detil_grid->RowIndex ?>_absen" id="x<?php echo $absen_detil_grid->RowIndex ?>_absen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->absen->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->absen->EditValue ?>"<?php echo $absen_detil_grid->absen->editAttributes() ?>>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_absen" name="o<?php echo $absen_detil_grid->RowIndex ?>_absen" id="o<?php echo $absen_detil_grid->RowIndex ?>_absen" value="<?php echo HtmlEncode($absen_detil_grid->absen->OldValue) ?>">
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_absen" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_absen" name="x<?php echo $absen_detil_grid->RowIndex ?>_absen" id="x<?php echo $absen_detil_grid->RowIndex ?>_absen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->absen->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->absen->EditValue ?>"<?php echo $absen_detil_grid->absen->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_absen">
<span<?php echo $absen_detil_grid->absen->viewAttributes() ?>><?php echo $absen_detil_grid->absen->getViewValue() ?></span>
</span>
<?php if (!$absen_detil->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_absen" name="x<?php echo $absen_detil_grid->RowIndex ?>_absen" id="x<?php echo $absen_detil_grid->RowIndex ?>_absen" value="<?php echo HtmlEncode($absen_detil_grid->absen->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_absen" name="o<?php echo $absen_detil_grid->RowIndex ?>_absen" id="o<?php echo $absen_detil_grid->RowIndex ?>_absen" value="<?php echo HtmlEncode($absen_detil_grid->absen->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="absen_detil" data-field="x_absen" name="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_absen" id="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_absen" value="<?php echo HtmlEncode($absen_detil_grid->absen->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_absen" name="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_absen" id="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_absen" value="<?php echo HtmlEncode($absen_detil_grid->absen->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->ijin->Visible) { // ijin ?>
		<td data-name="ijin" <?php echo $absen_detil_grid->ijin->cellAttributes() ?>>
<?php if ($absen_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_ijin" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_ijin" name="x<?php echo $absen_detil_grid->RowIndex ?>_ijin" id="x<?php echo $absen_detil_grid->RowIndex ?>_ijin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->ijin->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->ijin->EditValue ?>"<?php echo $absen_detil_grid->ijin->editAttributes() ?>>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_ijin" name="o<?php echo $absen_detil_grid->RowIndex ?>_ijin" id="o<?php echo $absen_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($absen_detil_grid->ijin->OldValue) ?>">
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_ijin" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_ijin" name="x<?php echo $absen_detil_grid->RowIndex ?>_ijin" id="x<?php echo $absen_detil_grid->RowIndex ?>_ijin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->ijin->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->ijin->EditValue ?>"<?php echo $absen_detil_grid->ijin->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_ijin">
<span<?php echo $absen_detil_grid->ijin->viewAttributes() ?>><?php echo $absen_detil_grid->ijin->getViewValue() ?></span>
</span>
<?php if (!$absen_detil->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_ijin" name="x<?php echo $absen_detil_grid->RowIndex ?>_ijin" id="x<?php echo $absen_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($absen_detil_grid->ijin->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_ijin" name="o<?php echo $absen_detil_grid->RowIndex ?>_ijin" id="o<?php echo $absen_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($absen_detil_grid->ijin->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="absen_detil" data-field="x_ijin" name="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_ijin" id="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($absen_detil_grid->ijin->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_ijin" name="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_ijin" id="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($absen_detil_grid->ijin->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->cuti->Visible) { // cuti ?>
		<td data-name="cuti" <?php echo $absen_detil_grid->cuti->cellAttributes() ?>>
<?php if ($absen_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_cuti" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_cuti" name="x<?php echo $absen_detil_grid->RowIndex ?>_cuti" id="x<?php echo $absen_detil_grid->RowIndex ?>_cuti" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->cuti->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->cuti->EditValue ?>"<?php echo $absen_detil_grid->cuti->editAttributes() ?>>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_cuti" name="o<?php echo $absen_detil_grid->RowIndex ?>_cuti" id="o<?php echo $absen_detil_grid->RowIndex ?>_cuti" value="<?php echo HtmlEncode($absen_detil_grid->cuti->OldValue) ?>">
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_cuti" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_cuti" name="x<?php echo $absen_detil_grid->RowIndex ?>_cuti" id="x<?php echo $absen_detil_grid->RowIndex ?>_cuti" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->cuti->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->cuti->EditValue ?>"<?php echo $absen_detil_grid->cuti->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_cuti">
<span<?php echo $absen_detil_grid->cuti->viewAttributes() ?>><?php echo $absen_detil_grid->cuti->getViewValue() ?></span>
</span>
<?php if (!$absen_detil->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_cuti" name="x<?php echo $absen_detil_grid->RowIndex ?>_cuti" id="x<?php echo $absen_detil_grid->RowIndex ?>_cuti" value="<?php echo HtmlEncode($absen_detil_grid->cuti->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_cuti" name="o<?php echo $absen_detil_grid->RowIndex ?>_cuti" id="o<?php echo $absen_detil_grid->RowIndex ?>_cuti" value="<?php echo HtmlEncode($absen_detil_grid->cuti->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="absen_detil" data-field="x_cuti" name="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_cuti" id="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_cuti" value="<?php echo HtmlEncode($absen_detil_grid->cuti->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_cuti" name="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_cuti" id="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_cuti" value="<?php echo HtmlEncode($absen_detil_grid->cuti->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->dinas_luar->Visible) { // dinas_luar ?>
		<td data-name="dinas_luar" <?php echo $absen_detil_grid->dinas_luar->cellAttributes() ?>>
<?php if ($absen_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_dinas_luar" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_dinas_luar" name="x<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" id="x<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->dinas_luar->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->dinas_luar->EditValue ?>"<?php echo $absen_detil_grid->dinas_luar->editAttributes() ?>>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_dinas_luar" name="o<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" id="o<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" value="<?php echo HtmlEncode($absen_detil_grid->dinas_luar->OldValue) ?>">
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_dinas_luar" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_dinas_luar" name="x<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" id="x<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->dinas_luar->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->dinas_luar->EditValue ?>"<?php echo $absen_detil_grid->dinas_luar->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_dinas_luar">
<span<?php echo $absen_detil_grid->dinas_luar->viewAttributes() ?>><?php echo $absen_detil_grid->dinas_luar->getViewValue() ?></span>
</span>
<?php if (!$absen_detil->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_dinas_luar" name="x<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" id="x<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" value="<?php echo HtmlEncode($absen_detil_grid->dinas_luar->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_dinas_luar" name="o<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" id="o<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" value="<?php echo HtmlEncode($absen_detil_grid->dinas_luar->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="absen_detil" data-field="x_dinas_luar" name="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" id="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" value="<?php echo HtmlEncode($absen_detil_grid->dinas_luar->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_dinas_luar" name="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" id="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" value="<?php echo HtmlEncode($absen_detil_grid->dinas_luar->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->terlambat->Visible) { // terlambat ?>
		<td data-name="terlambat" <?php echo $absen_detil_grid->terlambat->cellAttributes() ?>>
<?php if ($absen_detil->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_terlambat" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_terlambat" name="x<?php echo $absen_detil_grid->RowIndex ?>_terlambat" id="x<?php echo $absen_detil_grid->RowIndex ?>_terlambat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->terlambat->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->terlambat->EditValue ?>"<?php echo $absen_detil_grid->terlambat->editAttributes() ?>>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_terlambat" name="o<?php echo $absen_detil_grid->RowIndex ?>_terlambat" id="o<?php echo $absen_detil_grid->RowIndex ?>_terlambat" value="<?php echo HtmlEncode($absen_detil_grid->terlambat->OldValue) ?>">
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_terlambat" class="form-group">
<input type="text" data-table="absen_detil" data-field="x_terlambat" name="x<?php echo $absen_detil_grid->RowIndex ?>_terlambat" id="x<?php echo $absen_detil_grid->RowIndex ?>_terlambat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->terlambat->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->terlambat->EditValue ?>"<?php echo $absen_detil_grid->terlambat->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($absen_detil->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $absen_detil_grid->RowCount ?>_absen_detil_terlambat">
<span<?php echo $absen_detil_grid->terlambat->viewAttributes() ?>><?php echo $absen_detil_grid->terlambat->getViewValue() ?></span>
</span>
<?php if (!$absen_detil->isConfirm()) { ?>
<input type="hidden" data-table="absen_detil" data-field="x_terlambat" name="x<?php echo $absen_detil_grid->RowIndex ?>_terlambat" id="x<?php echo $absen_detil_grid->RowIndex ?>_terlambat" value="<?php echo HtmlEncode($absen_detil_grid->terlambat->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_terlambat" name="o<?php echo $absen_detil_grid->RowIndex ?>_terlambat" id="o<?php echo $absen_detil_grid->RowIndex ?>_terlambat" value="<?php echo HtmlEncode($absen_detil_grid->terlambat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="absen_detil" data-field="x_terlambat" name="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_terlambat" id="fabsen_detilgrid$x<?php echo $absen_detil_grid->RowIndex ?>_terlambat" value="<?php echo HtmlEncode($absen_detil_grid->terlambat->FormValue) ?>">
<input type="hidden" data-table="absen_detil" data-field="x_terlambat" name="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_terlambat" id="fabsen_detilgrid$o<?php echo $absen_detil_grid->RowIndex ?>_terlambat" value="<?php echo HtmlEncode($absen_detil_grid->terlambat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$absen_detil_grid->ListOptions->render("body", "right", $absen_detil_grid->RowCount);
?>
	</tr>
<?php if ($absen_detil->RowType == ROWTYPE_ADD || $absen_detil->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fabsen_detilgrid", "load"], function() {
	fabsen_detilgrid.updateLists(<?php echo $absen_detil_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$absen_detil_grid->isGridAdd() || $absen_detil->CurrentMode == "copy")
		if (!$absen_detil_grid->Recordset->EOF)
			$absen_detil_grid->Recordset->moveNext();
}
?>
<?php
	if ($absen_detil->CurrentMode == "add" || $absen_detil->CurrentMode == "copy" || $absen_detil->CurrentMode == "edit") {
		$absen_detil_grid->RowIndex = '$rowindex$';
		$absen_detil_grid->loadRowValues();

		// Set row properties
		$absen_detil->resetAttributes();
		$absen_detil->RowAttrs->merge(["data-rowindex" => $absen_detil_grid->RowIndex, "id" => "r0_absen_detil", "data-rowtype" => ROWTYPE_ADD]);
		$absen_detil->RowAttrs->appendClass("ew-template");
		$absen_detil->RowType = ROWTYPE_ADD;

		// Render row
		$absen_detil_grid->renderRow();

		// Render list options
		$absen_detil_grid->renderListOptions();
		$absen_detil_grid->StartRowCount = 0;
?>
	<tr <?php echo $absen_detil->rowAttributes() ?>>
<?php

// Render list options (body, left)
$absen_detil_grid->ListOptions->render("body", "left", $absen_detil_grid->RowIndex);
?>
	<?php if ($absen_detil_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$absen_detil->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_id" class="form-group absen_detil_id"></span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_id" class="form-group absen_detil_id">
<span<?php echo $absen_detil_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($absen_detil_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_id" name="x<?php echo $absen_detil_grid->RowIndex ?>_id" id="x<?php echo $absen_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($absen_detil_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_id" name="o<?php echo $absen_detil_grid->RowIndex ?>_id" id="o<?php echo $absen_detil_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($absen_detil_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->pid->Visible) { // pid ?>
		<td data-name="pid">
<?php if (!$absen_detil->isConfirm()) { ?>
<?php if ($absen_detil_grid->pid->getSessionValue() != "") { ?>
<span id="el$rowindex$_absen_detil_pid" class="form-group absen_detil_pid">
<span<?php echo $absen_detil_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($absen_detil_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $absen_detil_grid->RowIndex ?>_pid" name="x<?php echo $absen_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($absen_detil_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_absen_detil_pid" class="form-group absen_detil_pid">
<input type="text" data-table="absen_detil" data-field="x_pid" name="x<?php echo $absen_detil_grid->RowIndex ?>_pid" id="x<?php echo $absen_detil_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($absen_detil_grid->pid->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->pid->EditValue ?>"<?php echo $absen_detil_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_pid" class="form-group absen_detil_pid">
<span<?php echo $absen_detil_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($absen_detil_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_pid" name="x<?php echo $absen_detil_grid->RowIndex ?>_pid" id="x<?php echo $absen_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($absen_detil_grid->pid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_pid" name="o<?php echo $absen_detil_grid->RowIndex ?>_pid" id="o<?php echo $absen_detil_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($absen_detil_grid->pid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->pegawai->Visible) { // pegawai ?>
		<td data-name="pegawai">
<?php if (!$absen_detil->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_pegawai" class="form-group absen_detil_pegawai">
<input type="text" data-table="absen_detil" data-field="x_pegawai" name="x<?php echo $absen_detil_grid->RowIndex ?>_pegawai" id="x<?php echo $absen_detil_grid->RowIndex ?>_pegawai" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($absen_detil_grid->pegawai->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->pegawai->EditValue ?>"<?php echo $absen_detil_grid->pegawai->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_pegawai" class="form-group absen_detil_pegawai">
<span<?php echo $absen_detil_grid->pegawai->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($absen_detil_grid->pegawai->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_pegawai" name="x<?php echo $absen_detil_grid->RowIndex ?>_pegawai" id="x<?php echo $absen_detil_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($absen_detil_grid->pegawai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_pegawai" name="o<?php echo $absen_detil_grid->RowIndex ?>_pegawai" id="o<?php echo $absen_detil_grid->RowIndex ?>_pegawai" value="<?php echo HtmlEncode($absen_detil_grid->pegawai->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->masuk->Visible) { // masuk ?>
		<td data-name="masuk">
<?php if (!$absen_detil->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_masuk" class="form-group absen_detil_masuk">
<input type="text" data-table="absen_detil" data-field="x_masuk" name="x<?php echo $absen_detil_grid->RowIndex ?>_masuk" id="x<?php echo $absen_detil_grid->RowIndex ?>_masuk" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->masuk->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->masuk->EditValue ?>"<?php echo $absen_detil_grid->masuk->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_masuk" class="form-group absen_detil_masuk">
<span<?php echo $absen_detil_grid->masuk->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($absen_detil_grid->masuk->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_masuk" name="x<?php echo $absen_detil_grid->RowIndex ?>_masuk" id="x<?php echo $absen_detil_grid->RowIndex ?>_masuk" value="<?php echo HtmlEncode($absen_detil_grid->masuk->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_masuk" name="o<?php echo $absen_detil_grid->RowIndex ?>_masuk" id="o<?php echo $absen_detil_grid->RowIndex ?>_masuk" value="<?php echo HtmlEncode($absen_detil_grid->masuk->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->absen->Visible) { // absen ?>
		<td data-name="absen">
<?php if (!$absen_detil->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_absen" class="form-group absen_detil_absen">
<input type="text" data-table="absen_detil" data-field="x_absen" name="x<?php echo $absen_detil_grid->RowIndex ?>_absen" id="x<?php echo $absen_detil_grid->RowIndex ?>_absen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->absen->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->absen->EditValue ?>"<?php echo $absen_detil_grid->absen->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_absen" class="form-group absen_detil_absen">
<span<?php echo $absen_detil_grid->absen->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($absen_detil_grid->absen->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_absen" name="x<?php echo $absen_detil_grid->RowIndex ?>_absen" id="x<?php echo $absen_detil_grid->RowIndex ?>_absen" value="<?php echo HtmlEncode($absen_detil_grid->absen->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_absen" name="o<?php echo $absen_detil_grid->RowIndex ?>_absen" id="o<?php echo $absen_detil_grid->RowIndex ?>_absen" value="<?php echo HtmlEncode($absen_detil_grid->absen->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->ijin->Visible) { // ijin ?>
		<td data-name="ijin">
<?php if (!$absen_detil->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_ijin" class="form-group absen_detil_ijin">
<input type="text" data-table="absen_detil" data-field="x_ijin" name="x<?php echo $absen_detil_grid->RowIndex ?>_ijin" id="x<?php echo $absen_detil_grid->RowIndex ?>_ijin" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->ijin->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->ijin->EditValue ?>"<?php echo $absen_detil_grid->ijin->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_ijin" class="form-group absen_detil_ijin">
<span<?php echo $absen_detil_grid->ijin->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($absen_detil_grid->ijin->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_ijin" name="x<?php echo $absen_detil_grid->RowIndex ?>_ijin" id="x<?php echo $absen_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($absen_detil_grid->ijin->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_ijin" name="o<?php echo $absen_detil_grid->RowIndex ?>_ijin" id="o<?php echo $absen_detil_grid->RowIndex ?>_ijin" value="<?php echo HtmlEncode($absen_detil_grid->ijin->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->cuti->Visible) { // cuti ?>
		<td data-name="cuti">
<?php if (!$absen_detil->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_cuti" class="form-group absen_detil_cuti">
<input type="text" data-table="absen_detil" data-field="x_cuti" name="x<?php echo $absen_detil_grid->RowIndex ?>_cuti" id="x<?php echo $absen_detil_grid->RowIndex ?>_cuti" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->cuti->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->cuti->EditValue ?>"<?php echo $absen_detil_grid->cuti->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_cuti" class="form-group absen_detil_cuti">
<span<?php echo $absen_detil_grid->cuti->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($absen_detil_grid->cuti->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_cuti" name="x<?php echo $absen_detil_grid->RowIndex ?>_cuti" id="x<?php echo $absen_detil_grid->RowIndex ?>_cuti" value="<?php echo HtmlEncode($absen_detil_grid->cuti->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_cuti" name="o<?php echo $absen_detil_grid->RowIndex ?>_cuti" id="o<?php echo $absen_detil_grid->RowIndex ?>_cuti" value="<?php echo HtmlEncode($absen_detil_grid->cuti->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->dinas_luar->Visible) { // dinas_luar ?>
		<td data-name="dinas_luar">
<?php if (!$absen_detil->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_dinas_luar" class="form-group absen_detil_dinas_luar">
<input type="text" data-table="absen_detil" data-field="x_dinas_luar" name="x<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" id="x<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->dinas_luar->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->dinas_luar->EditValue ?>"<?php echo $absen_detil_grid->dinas_luar->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_dinas_luar" class="form-group absen_detil_dinas_luar">
<span<?php echo $absen_detil_grid->dinas_luar->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($absen_detil_grid->dinas_luar->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_dinas_luar" name="x<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" id="x<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" value="<?php echo HtmlEncode($absen_detil_grid->dinas_luar->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_dinas_luar" name="o<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" id="o<?php echo $absen_detil_grid->RowIndex ?>_dinas_luar" value="<?php echo HtmlEncode($absen_detil_grid->dinas_luar->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($absen_detil_grid->terlambat->Visible) { // terlambat ?>
		<td data-name="terlambat">
<?php if (!$absen_detil->isConfirm()) { ?>
<span id="el$rowindex$_absen_detil_terlambat" class="form-group absen_detil_terlambat">
<input type="text" data-table="absen_detil" data-field="x_terlambat" name="x<?php echo $absen_detil_grid->RowIndex ?>_terlambat" id="x<?php echo $absen_detil_grid->RowIndex ?>_terlambat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($absen_detil_grid->terlambat->getPlaceHolder()) ?>" value="<?php echo $absen_detil_grid->terlambat->EditValue ?>"<?php echo $absen_detil_grid->terlambat->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_absen_detil_terlambat" class="form-group absen_detil_terlambat">
<span<?php echo $absen_detil_grid->terlambat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($absen_detil_grid->terlambat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="absen_detil" data-field="x_terlambat" name="x<?php echo $absen_detil_grid->RowIndex ?>_terlambat" id="x<?php echo $absen_detil_grid->RowIndex ?>_terlambat" value="<?php echo HtmlEncode($absen_detil_grid->terlambat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="absen_detil" data-field="x_terlambat" name="o<?php echo $absen_detil_grid->RowIndex ?>_terlambat" id="o<?php echo $absen_detil_grid->RowIndex ?>_terlambat" value="<?php echo HtmlEncode($absen_detil_grid->terlambat->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$absen_detil_grid->ListOptions->render("body", "right", $absen_detil_grid->RowIndex);
?>
<script>
loadjs.ready(["fabsen_detilgrid", "load"], function() {
	fabsen_detilgrid.updateLists(<?php echo $absen_detil_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($absen_detil->CurrentMode == "add" || $absen_detil->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $absen_detil_grid->FormKeyCountName ?>" id="<?php echo $absen_detil_grid->FormKeyCountName ?>" value="<?php echo $absen_detil_grid->KeyCount ?>">
<?php echo $absen_detil_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($absen_detil->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $absen_detil_grid->FormKeyCountName ?>" id="<?php echo $absen_detil_grid->FormKeyCountName ?>" value="<?php echo $absen_detil_grid->KeyCount ?>">
<?php echo $absen_detil_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($absen_detil->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fabsen_detilgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($absen_detil_grid->Recordset)
	$absen_detil_grid->Recordset->Close();
?>
<?php if ($absen_detil_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $absen_detil_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($absen_detil_grid->TotalRecords == 0 && !$absen_detil->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $absen_detil_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$absen_detil_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$absen_detil_grid->terminate();
?>