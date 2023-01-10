<?php
namespace PHPMaker2020\sigap;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($peg_skill_grid))
	$peg_skill_grid = new peg_skill_grid();

// Run the page
$peg_skill_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_skill_grid->Page_Render();
?>
<?php if (!$peg_skill_grid->isExport()) { ?>
<script>
var fpeg_skillgrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fpeg_skillgrid = new ew.Form("fpeg_skillgrid", "grid");
	fpeg_skillgrid.formKeyCountName = '<?php echo $peg_skill_grid->FormKeyCountName ?>';

	// Validate form
	fpeg_skillgrid.validate = function() {
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
			<?php if ($peg_skill_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_grid->id->caption(), $peg_skill_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_skill_grid->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_grid->pid->caption(), $peg_skill_grid->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_skill_grid->pid->errorMessage()) ?>");
			<?php if ($peg_skill_grid->keahlian->Required) { ?>
				elm = this.getElements("x" + infix + "_keahlian");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_grid->keahlian->caption(), $peg_skill_grid->keahlian->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_skill_grid->tingkat->Required) { ?>
				elm = this.getElements("x" + infix + "_tingkat");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_grid->tingkat->caption(), $peg_skill_grid->tingkat->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_skill_grid->bukti->Required) { ?>
				elm = this.getElements("x" + infix + "_bukti");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_grid->bukti->caption(), $peg_skill_grid->bukti->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_skill_grid->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_grid->keterangan->caption(), $peg_skill_grid->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_skill_grid->c_date->Required) { ?>
				elm = this.getElements("x" + infix + "_c_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_grid->c_date->caption(), $peg_skill_grid->c_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_c_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_skill_grid->c_date->errorMessage()) ?>");
			<?php if ($peg_skill_grid->u_date->Required) { ?>
				elm = this.getElements("x" + infix + "_u_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_grid->u_date->caption(), $peg_skill_grid->u_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_u_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_skill_grid->u_date->errorMessage()) ?>");
			<?php if ($peg_skill_grid->c_by->Required) { ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_grid->c_by->caption(), $peg_skill_grid->c_by->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_skill_grid->c_by->errorMessage()) ?>");
			<?php if ($peg_skill_grid->u_by->Required) { ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_skill_grid->u_by->caption(), $peg_skill_grid->u_by->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_skill_grid->u_by->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fpeg_skillgrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pid", false)) return false;
		if (ew.valueChanged(fobj, infix, "keahlian", false)) return false;
		if (ew.valueChanged(fobj, infix, "tingkat", false)) return false;
		if (ew.valueChanged(fobj, infix, "bukti", false)) return false;
		if (ew.valueChanged(fobj, infix, "keterangan", false)) return false;
		if (ew.valueChanged(fobj, infix, "c_date", false)) return false;
		if (ew.valueChanged(fobj, infix, "u_date", false)) return false;
		if (ew.valueChanged(fobj, infix, "c_by", false)) return false;
		if (ew.valueChanged(fobj, infix, "u_by", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fpeg_skillgrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpeg_skillgrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpeg_skillgrid");
});
</script>
<?php } ?>
<?php
$peg_skill_grid->renderOtherOptions();
?>
<?php if ($peg_skill_grid->TotalRecords > 0 || $peg_skill->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($peg_skill_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> peg_skill">
<?php if ($peg_skill_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $peg_skill_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fpeg_skillgrid" class="ew-form ew-list-form form-inline">
<div id="gmp_peg_skill" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_peg_skillgrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$peg_skill->RowType = ROWTYPE_HEADER;

// Render list options
$peg_skill_grid->renderListOptions();

// Render list options (header, left)
$peg_skill_grid->ListOptions->render("header", "left");
?>
<?php if ($peg_skill_grid->id->Visible) { // id ?>
	<?php if ($peg_skill_grid->SortUrl($peg_skill_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $peg_skill_grid->id->headerCellClass() ?>"><div id="elh_peg_skill_id" class="peg_skill_id"><div class="ew-table-header-caption"><?php echo $peg_skill_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $peg_skill_grid->id->headerCellClass() ?>"><div><div id="elh_peg_skill_id" class="peg_skill_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_grid->pid->Visible) { // pid ?>
	<?php if ($peg_skill_grid->SortUrl($peg_skill_grid->pid) == "") { ?>
		<th data-name="pid" class="<?php echo $peg_skill_grid->pid->headerCellClass() ?>"><div id="elh_peg_skill_pid" class="peg_skill_pid"><div class="ew-table-header-caption"><?php echo $peg_skill_grid->pid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid" class="<?php echo $peg_skill_grid->pid->headerCellClass() ?>"><div><div id="elh_peg_skill_pid" class="peg_skill_pid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_grid->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_grid->pid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_grid->pid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_grid->keahlian->Visible) { // keahlian ?>
	<?php if ($peg_skill_grid->SortUrl($peg_skill_grid->keahlian) == "") { ?>
		<th data-name="keahlian" class="<?php echo $peg_skill_grid->keahlian->headerCellClass() ?>"><div id="elh_peg_skill_keahlian" class="peg_skill_keahlian"><div class="ew-table-header-caption"><?php echo $peg_skill_grid->keahlian->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keahlian" class="<?php echo $peg_skill_grid->keahlian->headerCellClass() ?>"><div><div id="elh_peg_skill_keahlian" class="peg_skill_keahlian">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_grid->keahlian->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_grid->keahlian->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_grid->keahlian->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_grid->tingkat->Visible) { // tingkat ?>
	<?php if ($peg_skill_grid->SortUrl($peg_skill_grid->tingkat) == "") { ?>
		<th data-name="tingkat" class="<?php echo $peg_skill_grid->tingkat->headerCellClass() ?>"><div id="elh_peg_skill_tingkat" class="peg_skill_tingkat"><div class="ew-table-header-caption"><?php echo $peg_skill_grid->tingkat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tingkat" class="<?php echo $peg_skill_grid->tingkat->headerCellClass() ?>"><div><div id="elh_peg_skill_tingkat" class="peg_skill_tingkat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_grid->tingkat->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_grid->tingkat->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_grid->tingkat->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_grid->bukti->Visible) { // bukti ?>
	<?php if ($peg_skill_grid->SortUrl($peg_skill_grid->bukti) == "") { ?>
		<th data-name="bukti" class="<?php echo $peg_skill_grid->bukti->headerCellClass() ?>"><div id="elh_peg_skill_bukti" class="peg_skill_bukti"><div class="ew-table-header-caption"><?php echo $peg_skill_grid->bukti->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="bukti" class="<?php echo $peg_skill_grid->bukti->headerCellClass() ?>"><div><div id="elh_peg_skill_bukti" class="peg_skill_bukti">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_grid->bukti->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_grid->bukti->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_grid->bukti->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_grid->keterangan->Visible) { // keterangan ?>
	<?php if ($peg_skill_grid->SortUrl($peg_skill_grid->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $peg_skill_grid->keterangan->headerCellClass() ?>"><div id="elh_peg_skill_keterangan" class="peg_skill_keterangan"><div class="ew-table-header-caption"><?php echo $peg_skill_grid->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $peg_skill_grid->keterangan->headerCellClass() ?>"><div><div id="elh_peg_skill_keterangan" class="peg_skill_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_grid->keterangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_grid->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_grid->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_grid->c_date->Visible) { // c_date ?>
	<?php if ($peg_skill_grid->SortUrl($peg_skill_grid->c_date) == "") { ?>
		<th data-name="c_date" class="<?php echo $peg_skill_grid->c_date->headerCellClass() ?>"><div id="elh_peg_skill_c_date" class="peg_skill_c_date"><div class="ew-table-header-caption"><?php echo $peg_skill_grid->c_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="c_date" class="<?php echo $peg_skill_grid->c_date->headerCellClass() ?>"><div><div id="elh_peg_skill_c_date" class="peg_skill_c_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_grid->c_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_grid->c_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_grid->c_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_grid->u_date->Visible) { // u_date ?>
	<?php if ($peg_skill_grid->SortUrl($peg_skill_grid->u_date) == "") { ?>
		<th data-name="u_date" class="<?php echo $peg_skill_grid->u_date->headerCellClass() ?>"><div id="elh_peg_skill_u_date" class="peg_skill_u_date"><div class="ew-table-header-caption"><?php echo $peg_skill_grid->u_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="u_date" class="<?php echo $peg_skill_grid->u_date->headerCellClass() ?>"><div><div id="elh_peg_skill_u_date" class="peg_skill_u_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_grid->u_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_grid->u_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_grid->u_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_grid->c_by->Visible) { // c_by ?>
	<?php if ($peg_skill_grid->SortUrl($peg_skill_grid->c_by) == "") { ?>
		<th data-name="c_by" class="<?php echo $peg_skill_grid->c_by->headerCellClass() ?>"><div id="elh_peg_skill_c_by" class="peg_skill_c_by"><div class="ew-table-header-caption"><?php echo $peg_skill_grid->c_by->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="c_by" class="<?php echo $peg_skill_grid->c_by->headerCellClass() ?>"><div><div id="elh_peg_skill_c_by" class="peg_skill_c_by">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_grid->c_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_grid->c_by->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_grid->c_by->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_skill_grid->u_by->Visible) { // u_by ?>
	<?php if ($peg_skill_grid->SortUrl($peg_skill_grid->u_by) == "") { ?>
		<th data-name="u_by" class="<?php echo $peg_skill_grid->u_by->headerCellClass() ?>"><div id="elh_peg_skill_u_by" class="peg_skill_u_by"><div class="ew-table-header-caption"><?php echo $peg_skill_grid->u_by->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="u_by" class="<?php echo $peg_skill_grid->u_by->headerCellClass() ?>"><div><div id="elh_peg_skill_u_by" class="peg_skill_u_by">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_skill_grid->u_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_skill_grid->u_by->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_skill_grid->u_by->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$peg_skill_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$peg_skill_grid->StartRecord = 1;
$peg_skill_grid->StopRecord = $peg_skill_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($peg_skill->isConfirm() || $peg_skill_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($peg_skill_grid->FormKeyCountName) && ($peg_skill_grid->isGridAdd() || $peg_skill_grid->isGridEdit() || $peg_skill->isConfirm())) {
		$peg_skill_grid->KeyCount = $CurrentForm->getValue($peg_skill_grid->FormKeyCountName);
		$peg_skill_grid->StopRecord = $peg_skill_grid->StartRecord + $peg_skill_grid->KeyCount - 1;
	}
}
$peg_skill_grid->RecordCount = $peg_skill_grid->StartRecord - 1;
if ($peg_skill_grid->Recordset && !$peg_skill_grid->Recordset->EOF) {
	$peg_skill_grid->Recordset->moveFirst();
	$selectLimit = $peg_skill_grid->UseSelectLimit;
	if (!$selectLimit && $peg_skill_grid->StartRecord > 1)
		$peg_skill_grid->Recordset->move($peg_skill_grid->StartRecord - 1);
} elseif (!$peg_skill->AllowAddDeleteRow && $peg_skill_grid->StopRecord == 0) {
	$peg_skill_grid->StopRecord = $peg_skill->GridAddRowCount;
}

// Initialize aggregate
$peg_skill->RowType = ROWTYPE_AGGREGATEINIT;
$peg_skill->resetAttributes();
$peg_skill_grid->renderRow();
if ($peg_skill_grid->isGridAdd())
	$peg_skill_grid->RowIndex = 0;
if ($peg_skill_grid->isGridEdit())
	$peg_skill_grid->RowIndex = 0;
while ($peg_skill_grid->RecordCount < $peg_skill_grid->StopRecord) {
	$peg_skill_grid->RecordCount++;
	if ($peg_skill_grid->RecordCount >= $peg_skill_grid->StartRecord) {
		$peg_skill_grid->RowCount++;
		if ($peg_skill_grid->isGridAdd() || $peg_skill_grid->isGridEdit() || $peg_skill->isConfirm()) {
			$peg_skill_grid->RowIndex++;
			$CurrentForm->Index = $peg_skill_grid->RowIndex;
			if ($CurrentForm->hasValue($peg_skill_grid->FormActionName) && ($peg_skill->isConfirm() || $peg_skill_grid->EventCancelled))
				$peg_skill_grid->RowAction = strval($CurrentForm->getValue($peg_skill_grid->FormActionName));
			elseif ($peg_skill_grid->isGridAdd())
				$peg_skill_grid->RowAction = "insert";
			else
				$peg_skill_grid->RowAction = "";
		}

		// Set up key count
		$peg_skill_grid->KeyCount = $peg_skill_grid->RowIndex;

		// Init row class and style
		$peg_skill->resetAttributes();
		$peg_skill->CssClass = "";
		if ($peg_skill_grid->isGridAdd()) {
			if ($peg_skill->CurrentMode == "copy") {
				$peg_skill_grid->loadRowValues($peg_skill_grid->Recordset); // Load row values
				$peg_skill_grid->setRecordKey($peg_skill_grid->RowOldKey, $peg_skill_grid->Recordset); // Set old record key
			} else {
				$peg_skill_grid->loadRowValues(); // Load default values
				$peg_skill_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$peg_skill_grid->loadRowValues($peg_skill_grid->Recordset); // Load row values
		}
		$peg_skill->RowType = ROWTYPE_VIEW; // Render view
		if ($peg_skill_grid->isGridAdd()) // Grid add
			$peg_skill->RowType = ROWTYPE_ADD; // Render add
		if ($peg_skill_grid->isGridAdd() && $peg_skill->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$peg_skill_grid->restoreCurrentRowFormValues($peg_skill_grid->RowIndex); // Restore form values
		if ($peg_skill_grid->isGridEdit()) { // Grid edit
			if ($peg_skill->EventCancelled)
				$peg_skill_grid->restoreCurrentRowFormValues($peg_skill_grid->RowIndex); // Restore form values
			if ($peg_skill_grid->RowAction == "insert")
				$peg_skill->RowType = ROWTYPE_ADD; // Render add
			else
				$peg_skill->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($peg_skill_grid->isGridEdit() && ($peg_skill->RowType == ROWTYPE_EDIT || $peg_skill->RowType == ROWTYPE_ADD) && $peg_skill->EventCancelled) // Update failed
			$peg_skill_grid->restoreCurrentRowFormValues($peg_skill_grid->RowIndex); // Restore form values
		if ($peg_skill->RowType == ROWTYPE_EDIT) // Edit row
			$peg_skill_grid->EditRowCount++;
		if ($peg_skill->isConfirm()) // Confirm row
			$peg_skill_grid->restoreCurrentRowFormValues($peg_skill_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$peg_skill->RowAttrs->merge(["data-rowindex" => $peg_skill_grid->RowCount, "id" => "r" . $peg_skill_grid->RowCount . "_peg_skill", "data-rowtype" => $peg_skill->RowType]);

		// Render row
		$peg_skill_grid->renderRow();

		// Render list options
		$peg_skill_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($peg_skill_grid->RowAction != "delete" && $peg_skill_grid->RowAction != "insertdelete" && !($peg_skill_grid->RowAction == "insert" && $peg_skill->isConfirm() && $peg_skill_grid->emptyRow())) {
?>
	<tr <?php echo $peg_skill->rowAttributes() ?>>
<?php

// Render list options (body, left)
$peg_skill_grid->ListOptions->render("body", "left", $peg_skill_grid->RowCount);
?>
	<?php if ($peg_skill_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $peg_skill_grid->id->cellAttributes() ?>>
<?php if ($peg_skill->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_id" class="form-group"></span>
<input type="hidden" data-table="peg_skill" data-field="x_id" name="o<?php echo $peg_skill_grid->RowIndex ?>_id" id="o<?php echo $peg_skill_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_skill_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_id" class="form-group">
<span<?php echo $peg_skill_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_id" name="x<?php echo $peg_skill_grid->RowIndex ?>_id" id="x<?php echo $peg_skill_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_skill_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_id">
<span<?php echo $peg_skill_grid->id->viewAttributes() ?>><?php echo $peg_skill_grid->id->getViewValue() ?></span>
</span>
<?php if (!$peg_skill->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_id" name="x<?php echo $peg_skill_grid->RowIndex ?>_id" id="x<?php echo $peg_skill_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_skill_grid->id->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_id" name="o<?php echo $peg_skill_grid->RowIndex ?>_id" id="o<?php echo $peg_skill_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_skill_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_skill" data-field="x_id" name="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_id" id="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_skill_grid->id->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_id" name="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_id" id="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_skill_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->pid->Visible) { // pid ?>
		<td data-name="pid" <?php echo $peg_skill_grid->pid->cellAttributes() ?>>
<?php if ($peg_skill->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($peg_skill_grid->pid->getSessionValue() != "") { ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_pid" class="form-group">
<span<?php echo $peg_skill_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $peg_skill_grid->RowIndex ?>_pid" name="x<?php echo $peg_skill_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_skill_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_pid" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_pid" name="x<?php echo $peg_skill_grid->RowIndex ?>_pid" id="x<?php echo $peg_skill_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_skill_grid->pid->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->pid->EditValue ?>"<?php echo $peg_skill_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_pid" name="o<?php echo $peg_skill_grid->RowIndex ?>_pid" id="o<?php echo $peg_skill_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_skill_grid->pid->OldValue) ?>">
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($peg_skill_grid->pid->getSessionValue() != "") { ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_pid" class="form-group">
<span<?php echo $peg_skill_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $peg_skill_grid->RowIndex ?>_pid" name="x<?php echo $peg_skill_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_skill_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_pid" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_pid" name="x<?php echo $peg_skill_grid->RowIndex ?>_pid" id="x<?php echo $peg_skill_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_skill_grid->pid->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->pid->EditValue ?>"<?php echo $peg_skill_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_pid">
<span<?php echo $peg_skill_grid->pid->viewAttributes() ?>><?php echo $peg_skill_grid->pid->getViewValue() ?></span>
</span>
<?php if (!$peg_skill->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_pid" name="x<?php echo $peg_skill_grid->RowIndex ?>_pid" id="x<?php echo $peg_skill_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_skill_grid->pid->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_pid" name="o<?php echo $peg_skill_grid->RowIndex ?>_pid" id="o<?php echo $peg_skill_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_skill_grid->pid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_skill" data-field="x_pid" name="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_pid" id="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_skill_grid->pid->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_pid" name="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_pid" id="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_skill_grid->pid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->keahlian->Visible) { // keahlian ?>
		<td data-name="keahlian" <?php echo $peg_skill_grid->keahlian->cellAttributes() ?>>
<?php if ($peg_skill->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_keahlian" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_keahlian" name="x<?php echo $peg_skill_grid->RowIndex ?>_keahlian" id="x<?php echo $peg_skill_grid->RowIndex ?>_keahlian" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_grid->keahlian->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->keahlian->EditValue ?>"<?php echo $peg_skill_grid->keahlian->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_keahlian" name="o<?php echo $peg_skill_grid->RowIndex ?>_keahlian" id="o<?php echo $peg_skill_grid->RowIndex ?>_keahlian" value="<?php echo HtmlEncode($peg_skill_grid->keahlian->OldValue) ?>">
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_keahlian" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_keahlian" name="x<?php echo $peg_skill_grid->RowIndex ?>_keahlian" id="x<?php echo $peg_skill_grid->RowIndex ?>_keahlian" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_grid->keahlian->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->keahlian->EditValue ?>"<?php echo $peg_skill_grid->keahlian->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_keahlian">
<span<?php echo $peg_skill_grid->keahlian->viewAttributes() ?>><?php echo $peg_skill_grid->keahlian->getViewValue() ?></span>
</span>
<?php if (!$peg_skill->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_keahlian" name="x<?php echo $peg_skill_grid->RowIndex ?>_keahlian" id="x<?php echo $peg_skill_grid->RowIndex ?>_keahlian" value="<?php echo HtmlEncode($peg_skill_grid->keahlian->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_keahlian" name="o<?php echo $peg_skill_grid->RowIndex ?>_keahlian" id="o<?php echo $peg_skill_grid->RowIndex ?>_keahlian" value="<?php echo HtmlEncode($peg_skill_grid->keahlian->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_skill" data-field="x_keahlian" name="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_keahlian" id="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_keahlian" value="<?php echo HtmlEncode($peg_skill_grid->keahlian->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_keahlian" name="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_keahlian" id="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_keahlian" value="<?php echo HtmlEncode($peg_skill_grid->keahlian->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->tingkat->Visible) { // tingkat ?>
		<td data-name="tingkat" <?php echo $peg_skill_grid->tingkat->cellAttributes() ?>>
<?php if ($peg_skill->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_tingkat" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_tingkat" name="x<?php echo $peg_skill_grid->RowIndex ?>_tingkat" id="x<?php echo $peg_skill_grid->RowIndex ?>_tingkat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_grid->tingkat->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->tingkat->EditValue ?>"<?php echo $peg_skill_grid->tingkat->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_tingkat" name="o<?php echo $peg_skill_grid->RowIndex ?>_tingkat" id="o<?php echo $peg_skill_grid->RowIndex ?>_tingkat" value="<?php echo HtmlEncode($peg_skill_grid->tingkat->OldValue) ?>">
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_tingkat" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_tingkat" name="x<?php echo $peg_skill_grid->RowIndex ?>_tingkat" id="x<?php echo $peg_skill_grid->RowIndex ?>_tingkat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_grid->tingkat->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->tingkat->EditValue ?>"<?php echo $peg_skill_grid->tingkat->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_tingkat">
<span<?php echo $peg_skill_grid->tingkat->viewAttributes() ?>><?php echo $peg_skill_grid->tingkat->getViewValue() ?></span>
</span>
<?php if (!$peg_skill->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_tingkat" name="x<?php echo $peg_skill_grid->RowIndex ?>_tingkat" id="x<?php echo $peg_skill_grid->RowIndex ?>_tingkat" value="<?php echo HtmlEncode($peg_skill_grid->tingkat->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_tingkat" name="o<?php echo $peg_skill_grid->RowIndex ?>_tingkat" id="o<?php echo $peg_skill_grid->RowIndex ?>_tingkat" value="<?php echo HtmlEncode($peg_skill_grid->tingkat->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_skill" data-field="x_tingkat" name="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_tingkat" id="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_tingkat" value="<?php echo HtmlEncode($peg_skill_grid->tingkat->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_tingkat" name="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_tingkat" id="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_tingkat" value="<?php echo HtmlEncode($peg_skill_grid->tingkat->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->bukti->Visible) { // bukti ?>
		<td data-name="bukti" <?php echo $peg_skill_grid->bukti->cellAttributes() ?>>
<?php if ($peg_skill->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_bukti" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_bukti" name="x<?php echo $peg_skill_grid->RowIndex ?>_bukti" id="x<?php echo $peg_skill_grid->RowIndex ?>_bukti" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_grid->bukti->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->bukti->EditValue ?>"<?php echo $peg_skill_grid->bukti->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_bukti" name="o<?php echo $peg_skill_grid->RowIndex ?>_bukti" id="o<?php echo $peg_skill_grid->RowIndex ?>_bukti" value="<?php echo HtmlEncode($peg_skill_grid->bukti->OldValue) ?>">
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_bukti" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_bukti" name="x<?php echo $peg_skill_grid->RowIndex ?>_bukti" id="x<?php echo $peg_skill_grid->RowIndex ?>_bukti" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_grid->bukti->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->bukti->EditValue ?>"<?php echo $peg_skill_grid->bukti->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_bukti">
<span<?php echo $peg_skill_grid->bukti->viewAttributes() ?>><?php echo $peg_skill_grid->bukti->getViewValue() ?></span>
</span>
<?php if (!$peg_skill->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_bukti" name="x<?php echo $peg_skill_grid->RowIndex ?>_bukti" id="x<?php echo $peg_skill_grid->RowIndex ?>_bukti" value="<?php echo HtmlEncode($peg_skill_grid->bukti->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_bukti" name="o<?php echo $peg_skill_grid->RowIndex ?>_bukti" id="o<?php echo $peg_skill_grid->RowIndex ?>_bukti" value="<?php echo HtmlEncode($peg_skill_grid->bukti->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_skill" data-field="x_bukti" name="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_bukti" id="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_bukti" value="<?php echo HtmlEncode($peg_skill_grid->bukti->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_bukti" name="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_bukti" id="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_bukti" value="<?php echo HtmlEncode($peg_skill_grid->bukti->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $peg_skill_grid->keterangan->cellAttributes() ?>>
<?php if ($peg_skill->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_keterangan" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_keterangan" name="x<?php echo $peg_skill_grid->RowIndex ?>_keterangan" id="x<?php echo $peg_skill_grid->RowIndex ?>_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_grid->keterangan->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->keterangan->EditValue ?>"<?php echo $peg_skill_grid->keterangan->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_keterangan" name="o<?php echo $peg_skill_grid->RowIndex ?>_keterangan" id="o<?php echo $peg_skill_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($peg_skill_grid->keterangan->OldValue) ?>">
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_keterangan" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_keterangan" name="x<?php echo $peg_skill_grid->RowIndex ?>_keterangan" id="x<?php echo $peg_skill_grid->RowIndex ?>_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_grid->keterangan->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->keterangan->EditValue ?>"<?php echo $peg_skill_grid->keterangan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_keterangan">
<span<?php echo $peg_skill_grid->keterangan->viewAttributes() ?>><?php echo $peg_skill_grid->keterangan->getViewValue() ?></span>
</span>
<?php if (!$peg_skill->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_keterangan" name="x<?php echo $peg_skill_grid->RowIndex ?>_keterangan" id="x<?php echo $peg_skill_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($peg_skill_grid->keterangan->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_keterangan" name="o<?php echo $peg_skill_grid->RowIndex ?>_keterangan" id="o<?php echo $peg_skill_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($peg_skill_grid->keterangan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_skill" data-field="x_keterangan" name="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_keterangan" id="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($peg_skill_grid->keterangan->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_keterangan" name="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_keterangan" id="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($peg_skill_grid->keterangan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->c_date->Visible) { // c_date ?>
		<td data-name="c_date" <?php echo $peg_skill_grid->c_date->cellAttributes() ?>>
<?php if ($peg_skill->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_c_date" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_c_date" name="x<?php echo $peg_skill_grid->RowIndex ?>_c_date" id="x<?php echo $peg_skill_grid->RowIndex ?>_c_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_skill_grid->c_date->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->c_date->EditValue ?>"<?php echo $peg_skill_grid->c_date->editAttributes() ?>>
<?php if (!$peg_skill_grid->c_date->ReadOnly && !$peg_skill_grid->c_date->Disabled && !isset($peg_skill_grid->c_date->EditAttrs["readonly"]) && !isset($peg_skill_grid->c_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_skillgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_skillgrid", "x<?php echo $peg_skill_grid->RowIndex ?>_c_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_c_date" name="o<?php echo $peg_skill_grid->RowIndex ?>_c_date" id="o<?php echo $peg_skill_grid->RowIndex ?>_c_date" value="<?php echo HtmlEncode($peg_skill_grid->c_date->OldValue) ?>">
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_c_date" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_c_date" name="x<?php echo $peg_skill_grid->RowIndex ?>_c_date" id="x<?php echo $peg_skill_grid->RowIndex ?>_c_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_skill_grid->c_date->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->c_date->EditValue ?>"<?php echo $peg_skill_grid->c_date->editAttributes() ?>>
<?php if (!$peg_skill_grid->c_date->ReadOnly && !$peg_skill_grid->c_date->Disabled && !isset($peg_skill_grid->c_date->EditAttrs["readonly"]) && !isset($peg_skill_grid->c_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_skillgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_skillgrid", "x<?php echo $peg_skill_grid->RowIndex ?>_c_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_c_date">
<span<?php echo $peg_skill_grid->c_date->viewAttributes() ?>><?php echo $peg_skill_grid->c_date->getViewValue() ?></span>
</span>
<?php if (!$peg_skill->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_c_date" name="x<?php echo $peg_skill_grid->RowIndex ?>_c_date" id="x<?php echo $peg_skill_grid->RowIndex ?>_c_date" value="<?php echo HtmlEncode($peg_skill_grid->c_date->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_c_date" name="o<?php echo $peg_skill_grid->RowIndex ?>_c_date" id="o<?php echo $peg_skill_grid->RowIndex ?>_c_date" value="<?php echo HtmlEncode($peg_skill_grid->c_date->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_skill" data-field="x_c_date" name="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_c_date" id="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_c_date" value="<?php echo HtmlEncode($peg_skill_grid->c_date->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_c_date" name="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_c_date" id="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_c_date" value="<?php echo HtmlEncode($peg_skill_grid->c_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->u_date->Visible) { // u_date ?>
		<td data-name="u_date" <?php echo $peg_skill_grid->u_date->cellAttributes() ?>>
<?php if ($peg_skill->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_u_date" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_u_date" name="x<?php echo $peg_skill_grid->RowIndex ?>_u_date" id="x<?php echo $peg_skill_grid->RowIndex ?>_u_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_skill_grid->u_date->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->u_date->EditValue ?>"<?php echo $peg_skill_grid->u_date->editAttributes() ?>>
<?php if (!$peg_skill_grid->u_date->ReadOnly && !$peg_skill_grid->u_date->Disabled && !isset($peg_skill_grid->u_date->EditAttrs["readonly"]) && !isset($peg_skill_grid->u_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_skillgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_skillgrid", "x<?php echo $peg_skill_grid->RowIndex ?>_u_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_u_date" name="o<?php echo $peg_skill_grid->RowIndex ?>_u_date" id="o<?php echo $peg_skill_grid->RowIndex ?>_u_date" value="<?php echo HtmlEncode($peg_skill_grid->u_date->OldValue) ?>">
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_u_date" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_u_date" name="x<?php echo $peg_skill_grid->RowIndex ?>_u_date" id="x<?php echo $peg_skill_grid->RowIndex ?>_u_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_skill_grid->u_date->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->u_date->EditValue ?>"<?php echo $peg_skill_grid->u_date->editAttributes() ?>>
<?php if (!$peg_skill_grid->u_date->ReadOnly && !$peg_skill_grid->u_date->Disabled && !isset($peg_skill_grid->u_date->EditAttrs["readonly"]) && !isset($peg_skill_grid->u_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_skillgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_skillgrid", "x<?php echo $peg_skill_grid->RowIndex ?>_u_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_u_date">
<span<?php echo $peg_skill_grid->u_date->viewAttributes() ?>><?php echo $peg_skill_grid->u_date->getViewValue() ?></span>
</span>
<?php if (!$peg_skill->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_u_date" name="x<?php echo $peg_skill_grid->RowIndex ?>_u_date" id="x<?php echo $peg_skill_grid->RowIndex ?>_u_date" value="<?php echo HtmlEncode($peg_skill_grid->u_date->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_u_date" name="o<?php echo $peg_skill_grid->RowIndex ?>_u_date" id="o<?php echo $peg_skill_grid->RowIndex ?>_u_date" value="<?php echo HtmlEncode($peg_skill_grid->u_date->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_skill" data-field="x_u_date" name="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_u_date" id="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_u_date" value="<?php echo HtmlEncode($peg_skill_grid->u_date->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_u_date" name="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_u_date" id="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_u_date" value="<?php echo HtmlEncode($peg_skill_grid->u_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->c_by->Visible) { // c_by ?>
		<td data-name="c_by" <?php echo $peg_skill_grid->c_by->cellAttributes() ?>>
<?php if ($peg_skill->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_c_by" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_c_by" name="x<?php echo $peg_skill_grid->RowIndex ?>_c_by" id="x<?php echo $peg_skill_grid->RowIndex ?>_c_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_skill_grid->c_by->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->c_by->EditValue ?>"<?php echo $peg_skill_grid->c_by->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_c_by" name="o<?php echo $peg_skill_grid->RowIndex ?>_c_by" id="o<?php echo $peg_skill_grid->RowIndex ?>_c_by" value="<?php echo HtmlEncode($peg_skill_grid->c_by->OldValue) ?>">
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_c_by" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_c_by" name="x<?php echo $peg_skill_grid->RowIndex ?>_c_by" id="x<?php echo $peg_skill_grid->RowIndex ?>_c_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_skill_grid->c_by->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->c_by->EditValue ?>"<?php echo $peg_skill_grid->c_by->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_c_by">
<span<?php echo $peg_skill_grid->c_by->viewAttributes() ?>><?php echo $peg_skill_grid->c_by->getViewValue() ?></span>
</span>
<?php if (!$peg_skill->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_c_by" name="x<?php echo $peg_skill_grid->RowIndex ?>_c_by" id="x<?php echo $peg_skill_grid->RowIndex ?>_c_by" value="<?php echo HtmlEncode($peg_skill_grid->c_by->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_c_by" name="o<?php echo $peg_skill_grid->RowIndex ?>_c_by" id="o<?php echo $peg_skill_grid->RowIndex ?>_c_by" value="<?php echo HtmlEncode($peg_skill_grid->c_by->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_skill" data-field="x_c_by" name="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_c_by" id="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_c_by" value="<?php echo HtmlEncode($peg_skill_grid->c_by->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_c_by" name="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_c_by" id="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_c_by" value="<?php echo HtmlEncode($peg_skill_grid->c_by->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->u_by->Visible) { // u_by ?>
		<td data-name="u_by" <?php echo $peg_skill_grid->u_by->cellAttributes() ?>>
<?php if ($peg_skill->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_u_by" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_u_by" name="x<?php echo $peg_skill_grid->RowIndex ?>_u_by" id="x<?php echo $peg_skill_grid->RowIndex ?>_u_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_skill_grid->u_by->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->u_by->EditValue ?>"<?php echo $peg_skill_grid->u_by->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_u_by" name="o<?php echo $peg_skill_grid->RowIndex ?>_u_by" id="o<?php echo $peg_skill_grid->RowIndex ?>_u_by" value="<?php echo HtmlEncode($peg_skill_grid->u_by->OldValue) ?>">
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_u_by" class="form-group">
<input type="text" data-table="peg_skill" data-field="x_u_by" name="x<?php echo $peg_skill_grid->RowIndex ?>_u_by" id="x<?php echo $peg_skill_grid->RowIndex ?>_u_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_skill_grid->u_by->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->u_by->EditValue ?>"<?php echo $peg_skill_grid->u_by->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_skill->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_skill_grid->RowCount ?>_peg_skill_u_by">
<span<?php echo $peg_skill_grid->u_by->viewAttributes() ?>><?php echo $peg_skill_grid->u_by->getViewValue() ?></span>
</span>
<?php if (!$peg_skill->isConfirm()) { ?>
<input type="hidden" data-table="peg_skill" data-field="x_u_by" name="x<?php echo $peg_skill_grid->RowIndex ?>_u_by" id="x<?php echo $peg_skill_grid->RowIndex ?>_u_by" value="<?php echo HtmlEncode($peg_skill_grid->u_by->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_u_by" name="o<?php echo $peg_skill_grid->RowIndex ?>_u_by" id="o<?php echo $peg_skill_grid->RowIndex ?>_u_by" value="<?php echo HtmlEncode($peg_skill_grid->u_by->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_skill" data-field="x_u_by" name="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_u_by" id="fpeg_skillgrid$x<?php echo $peg_skill_grid->RowIndex ?>_u_by" value="<?php echo HtmlEncode($peg_skill_grid->u_by->FormValue) ?>">
<input type="hidden" data-table="peg_skill" data-field="x_u_by" name="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_u_by" id="fpeg_skillgrid$o<?php echo $peg_skill_grid->RowIndex ?>_u_by" value="<?php echo HtmlEncode($peg_skill_grid->u_by->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$peg_skill_grid->ListOptions->render("body", "right", $peg_skill_grid->RowCount);
?>
	</tr>
<?php if ($peg_skill->RowType == ROWTYPE_ADD || $peg_skill->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpeg_skillgrid", "load"], function() {
	fpeg_skillgrid.updateLists(<?php echo $peg_skill_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$peg_skill_grid->isGridAdd() || $peg_skill->CurrentMode == "copy")
		if (!$peg_skill_grid->Recordset->EOF)
			$peg_skill_grid->Recordset->moveNext();
}
?>
<?php
	if ($peg_skill->CurrentMode == "add" || $peg_skill->CurrentMode == "copy" || $peg_skill->CurrentMode == "edit") {
		$peg_skill_grid->RowIndex = '$rowindex$';
		$peg_skill_grid->loadRowValues();

		// Set row properties
		$peg_skill->resetAttributes();
		$peg_skill->RowAttrs->merge(["data-rowindex" => $peg_skill_grid->RowIndex, "id" => "r0_peg_skill", "data-rowtype" => ROWTYPE_ADD]);
		$peg_skill->RowAttrs->appendClass("ew-template");
		$peg_skill->RowType = ROWTYPE_ADD;

		// Render row
		$peg_skill_grid->renderRow();

		// Render list options
		$peg_skill_grid->renderListOptions();
		$peg_skill_grid->StartRowCount = 0;
?>
	<tr <?php echo $peg_skill->rowAttributes() ?>>
<?php

// Render list options (body, left)
$peg_skill_grid->ListOptions->render("body", "left", $peg_skill_grid->RowIndex);
?>
	<?php if ($peg_skill_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$peg_skill->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_id" class="form-group peg_skill_id"></span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_id" class="form-group peg_skill_id">
<span<?php echo $peg_skill_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_id" name="x<?php echo $peg_skill_grid->RowIndex ?>_id" id="x<?php echo $peg_skill_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_skill_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_id" name="o<?php echo $peg_skill_grid->RowIndex ?>_id" id="o<?php echo $peg_skill_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_skill_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->pid->Visible) { // pid ?>
		<td data-name="pid">
<?php if (!$peg_skill->isConfirm()) { ?>
<?php if ($peg_skill_grid->pid->getSessionValue() != "") { ?>
<span id="el$rowindex$_peg_skill_pid" class="form-group peg_skill_pid">
<span<?php echo $peg_skill_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $peg_skill_grid->RowIndex ?>_pid" name="x<?php echo $peg_skill_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_skill_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_peg_skill_pid" class="form-group peg_skill_pid">
<input type="text" data-table="peg_skill" data-field="x_pid" name="x<?php echo $peg_skill_grid->RowIndex ?>_pid" id="x<?php echo $peg_skill_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_skill_grid->pid->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->pid->EditValue ?>"<?php echo $peg_skill_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_pid" class="form-group peg_skill_pid">
<span<?php echo $peg_skill_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_pid" name="x<?php echo $peg_skill_grid->RowIndex ?>_pid" id="x<?php echo $peg_skill_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_skill_grid->pid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_pid" name="o<?php echo $peg_skill_grid->RowIndex ?>_pid" id="o<?php echo $peg_skill_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_skill_grid->pid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->keahlian->Visible) { // keahlian ?>
		<td data-name="keahlian">
<?php if (!$peg_skill->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_keahlian" class="form-group peg_skill_keahlian">
<input type="text" data-table="peg_skill" data-field="x_keahlian" name="x<?php echo $peg_skill_grid->RowIndex ?>_keahlian" id="x<?php echo $peg_skill_grid->RowIndex ?>_keahlian" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_grid->keahlian->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->keahlian->EditValue ?>"<?php echo $peg_skill_grid->keahlian->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_keahlian" class="form-group peg_skill_keahlian">
<span<?php echo $peg_skill_grid->keahlian->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_grid->keahlian->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_keahlian" name="x<?php echo $peg_skill_grid->RowIndex ?>_keahlian" id="x<?php echo $peg_skill_grid->RowIndex ?>_keahlian" value="<?php echo HtmlEncode($peg_skill_grid->keahlian->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_keahlian" name="o<?php echo $peg_skill_grid->RowIndex ?>_keahlian" id="o<?php echo $peg_skill_grid->RowIndex ?>_keahlian" value="<?php echo HtmlEncode($peg_skill_grid->keahlian->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->tingkat->Visible) { // tingkat ?>
		<td data-name="tingkat">
<?php if (!$peg_skill->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_tingkat" class="form-group peg_skill_tingkat">
<input type="text" data-table="peg_skill" data-field="x_tingkat" name="x<?php echo $peg_skill_grid->RowIndex ?>_tingkat" id="x<?php echo $peg_skill_grid->RowIndex ?>_tingkat" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_grid->tingkat->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->tingkat->EditValue ?>"<?php echo $peg_skill_grid->tingkat->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_tingkat" class="form-group peg_skill_tingkat">
<span<?php echo $peg_skill_grid->tingkat->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_grid->tingkat->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_tingkat" name="x<?php echo $peg_skill_grid->RowIndex ?>_tingkat" id="x<?php echo $peg_skill_grid->RowIndex ?>_tingkat" value="<?php echo HtmlEncode($peg_skill_grid->tingkat->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_tingkat" name="o<?php echo $peg_skill_grid->RowIndex ?>_tingkat" id="o<?php echo $peg_skill_grid->RowIndex ?>_tingkat" value="<?php echo HtmlEncode($peg_skill_grid->tingkat->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->bukti->Visible) { // bukti ?>
		<td data-name="bukti">
<?php if (!$peg_skill->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_bukti" class="form-group peg_skill_bukti">
<input type="text" data-table="peg_skill" data-field="x_bukti" name="x<?php echo $peg_skill_grid->RowIndex ?>_bukti" id="x<?php echo $peg_skill_grid->RowIndex ?>_bukti" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_grid->bukti->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->bukti->EditValue ?>"<?php echo $peg_skill_grid->bukti->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_bukti" class="form-group peg_skill_bukti">
<span<?php echo $peg_skill_grid->bukti->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_grid->bukti->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_bukti" name="x<?php echo $peg_skill_grid->RowIndex ?>_bukti" id="x<?php echo $peg_skill_grid->RowIndex ?>_bukti" value="<?php echo HtmlEncode($peg_skill_grid->bukti->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_bukti" name="o<?php echo $peg_skill_grid->RowIndex ?>_bukti" id="o<?php echo $peg_skill_grid->RowIndex ?>_bukti" value="<?php echo HtmlEncode($peg_skill_grid->bukti->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan">
<?php if (!$peg_skill->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_keterangan" class="form-group peg_skill_keterangan">
<input type="text" data-table="peg_skill" data-field="x_keterangan" name="x<?php echo $peg_skill_grid->RowIndex ?>_keterangan" id="x<?php echo $peg_skill_grid->RowIndex ?>_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_skill_grid->keterangan->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->keterangan->EditValue ?>"<?php echo $peg_skill_grid->keterangan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_keterangan" class="form-group peg_skill_keterangan">
<span<?php echo $peg_skill_grid->keterangan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_grid->keterangan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_keterangan" name="x<?php echo $peg_skill_grid->RowIndex ?>_keterangan" id="x<?php echo $peg_skill_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($peg_skill_grid->keterangan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_keterangan" name="o<?php echo $peg_skill_grid->RowIndex ?>_keterangan" id="o<?php echo $peg_skill_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($peg_skill_grid->keterangan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->c_date->Visible) { // c_date ?>
		<td data-name="c_date">
<?php if (!$peg_skill->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_c_date" class="form-group peg_skill_c_date">
<input type="text" data-table="peg_skill" data-field="x_c_date" name="x<?php echo $peg_skill_grid->RowIndex ?>_c_date" id="x<?php echo $peg_skill_grid->RowIndex ?>_c_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_skill_grid->c_date->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->c_date->EditValue ?>"<?php echo $peg_skill_grid->c_date->editAttributes() ?>>
<?php if (!$peg_skill_grid->c_date->ReadOnly && !$peg_skill_grid->c_date->Disabled && !isset($peg_skill_grid->c_date->EditAttrs["readonly"]) && !isset($peg_skill_grid->c_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_skillgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_skillgrid", "x<?php echo $peg_skill_grid->RowIndex ?>_c_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_c_date" class="form-group peg_skill_c_date">
<span<?php echo $peg_skill_grid->c_date->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_grid->c_date->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_c_date" name="x<?php echo $peg_skill_grid->RowIndex ?>_c_date" id="x<?php echo $peg_skill_grid->RowIndex ?>_c_date" value="<?php echo HtmlEncode($peg_skill_grid->c_date->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_c_date" name="o<?php echo $peg_skill_grid->RowIndex ?>_c_date" id="o<?php echo $peg_skill_grid->RowIndex ?>_c_date" value="<?php echo HtmlEncode($peg_skill_grid->c_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->u_date->Visible) { // u_date ?>
		<td data-name="u_date">
<?php if (!$peg_skill->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_u_date" class="form-group peg_skill_u_date">
<input type="text" data-table="peg_skill" data-field="x_u_date" name="x<?php echo $peg_skill_grid->RowIndex ?>_u_date" id="x<?php echo $peg_skill_grid->RowIndex ?>_u_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_skill_grid->u_date->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->u_date->EditValue ?>"<?php echo $peg_skill_grid->u_date->editAttributes() ?>>
<?php if (!$peg_skill_grid->u_date->ReadOnly && !$peg_skill_grid->u_date->Disabled && !isset($peg_skill_grid->u_date->EditAttrs["readonly"]) && !isset($peg_skill_grid->u_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_skillgrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_skillgrid", "x<?php echo $peg_skill_grid->RowIndex ?>_u_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_u_date" class="form-group peg_skill_u_date">
<span<?php echo $peg_skill_grid->u_date->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_grid->u_date->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_u_date" name="x<?php echo $peg_skill_grid->RowIndex ?>_u_date" id="x<?php echo $peg_skill_grid->RowIndex ?>_u_date" value="<?php echo HtmlEncode($peg_skill_grid->u_date->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_u_date" name="o<?php echo $peg_skill_grid->RowIndex ?>_u_date" id="o<?php echo $peg_skill_grid->RowIndex ?>_u_date" value="<?php echo HtmlEncode($peg_skill_grid->u_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->c_by->Visible) { // c_by ?>
		<td data-name="c_by">
<?php if (!$peg_skill->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_c_by" class="form-group peg_skill_c_by">
<input type="text" data-table="peg_skill" data-field="x_c_by" name="x<?php echo $peg_skill_grid->RowIndex ?>_c_by" id="x<?php echo $peg_skill_grid->RowIndex ?>_c_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_skill_grid->c_by->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->c_by->EditValue ?>"<?php echo $peg_skill_grid->c_by->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_c_by" class="form-group peg_skill_c_by">
<span<?php echo $peg_skill_grid->c_by->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_grid->c_by->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_c_by" name="x<?php echo $peg_skill_grid->RowIndex ?>_c_by" id="x<?php echo $peg_skill_grid->RowIndex ?>_c_by" value="<?php echo HtmlEncode($peg_skill_grid->c_by->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_c_by" name="o<?php echo $peg_skill_grid->RowIndex ?>_c_by" id="o<?php echo $peg_skill_grid->RowIndex ?>_c_by" value="<?php echo HtmlEncode($peg_skill_grid->c_by->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_skill_grid->u_by->Visible) { // u_by ?>
		<td data-name="u_by">
<?php if (!$peg_skill->isConfirm()) { ?>
<span id="el$rowindex$_peg_skill_u_by" class="form-group peg_skill_u_by">
<input type="text" data-table="peg_skill" data-field="x_u_by" name="x<?php echo $peg_skill_grid->RowIndex ?>_u_by" id="x<?php echo $peg_skill_grid->RowIndex ?>_u_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_skill_grid->u_by->getPlaceHolder()) ?>" value="<?php echo $peg_skill_grid->u_by->EditValue ?>"<?php echo $peg_skill_grid->u_by->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_skill_u_by" class="form-group peg_skill_u_by">
<span<?php echo $peg_skill_grid->u_by->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_skill_grid->u_by->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_skill" data-field="x_u_by" name="x<?php echo $peg_skill_grid->RowIndex ?>_u_by" id="x<?php echo $peg_skill_grid->RowIndex ?>_u_by" value="<?php echo HtmlEncode($peg_skill_grid->u_by->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_skill" data-field="x_u_by" name="o<?php echo $peg_skill_grid->RowIndex ?>_u_by" id="o<?php echo $peg_skill_grid->RowIndex ?>_u_by" value="<?php echo HtmlEncode($peg_skill_grid->u_by->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$peg_skill_grid->ListOptions->render("body", "right", $peg_skill_grid->RowIndex);
?>
<script>
loadjs.ready(["fpeg_skillgrid", "load"], function() {
	fpeg_skillgrid.updateLists(<?php echo $peg_skill_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($peg_skill->CurrentMode == "add" || $peg_skill->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $peg_skill_grid->FormKeyCountName ?>" id="<?php echo $peg_skill_grid->FormKeyCountName ?>" value="<?php echo $peg_skill_grid->KeyCount ?>">
<?php echo $peg_skill_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($peg_skill->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $peg_skill_grid->FormKeyCountName ?>" id="<?php echo $peg_skill_grid->FormKeyCountName ?>" value="<?php echo $peg_skill_grid->KeyCount ?>">
<?php echo $peg_skill_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($peg_skill->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fpeg_skillgrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($peg_skill_grid->Recordset)
	$peg_skill_grid->Recordset->Close();
?>
<?php if ($peg_skill_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $peg_skill_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($peg_skill_grid->TotalRecords == 0 && !$peg_skill->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $peg_skill_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$peg_skill_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$peg_skill_grid->terminate();
?>