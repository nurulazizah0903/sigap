<?php
namespace PHPMaker2020\sigap;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($peg_dokumen_grid))
	$peg_dokumen_grid = new peg_dokumen_grid();

// Run the page
$peg_dokumen_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_dokumen_grid->Page_Render();
?>
<?php if (!$peg_dokumen_grid->isExport()) { ?>
<script>
var fpeg_dokumengrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fpeg_dokumengrid = new ew.Form("fpeg_dokumengrid", "grid");
	fpeg_dokumengrid.formKeyCountName = '<?php echo $peg_dokumen_grid->FormKeyCountName ?>';

	// Validate form
	fpeg_dokumengrid.validate = function() {
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
			<?php if ($peg_dokumen_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_grid->id->caption(), $peg_dokumen_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_dokumen_grid->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_grid->pid->caption(), $peg_dokumen_grid->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_dokumen_grid->pid->errorMessage()) ?>");
			<?php if ($peg_dokumen_grid->nama_dokumen->Required) { ?>
				elm = this.getElements("x" + infix + "_nama_dokumen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_grid->nama_dokumen->caption(), $peg_dokumen_grid->nama_dokumen->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_dokumen_grid->file_dokumen->Required) { ?>
				elm = this.getElements("x" + infix + "_file_dokumen");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_grid->file_dokumen->caption(), $peg_dokumen_grid->file_dokumen->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_dokumen_grid->keterangan->Required) { ?>
				elm = this.getElements("x" + infix + "_keterangan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_grid->keterangan->caption(), $peg_dokumen_grid->keterangan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_dokumen_grid->c_date->Required) { ?>
				elm = this.getElements("x" + infix + "_c_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_grid->c_date->caption(), $peg_dokumen_grid->c_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_c_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_dokumen_grid->c_date->errorMessage()) ?>");
			<?php if ($peg_dokumen_grid->u_date->Required) { ?>
				elm = this.getElements("x" + infix + "_u_date");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_grid->u_date->caption(), $peg_dokumen_grid->u_date->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_u_date");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_dokumen_grid->u_date->errorMessage()) ?>");
			<?php if ($peg_dokumen_grid->c_by->Required) { ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_grid->c_by->caption(), $peg_dokumen_grid->c_by->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_c_by");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_dokumen_grid->c_by->errorMessage()) ?>");
			<?php if ($peg_dokumen_grid->u_by->Required) { ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_dokumen_grid->u_by->caption(), $peg_dokumen_grid->u_by->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_u_by");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_dokumen_grid->u_by->errorMessage()) ?>");

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fpeg_dokumengrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pid", false)) return false;
		if (ew.valueChanged(fobj, infix, "nama_dokumen", false)) return false;
		if (ew.valueChanged(fobj, infix, "file_dokumen", false)) return false;
		if (ew.valueChanged(fobj, infix, "keterangan", false)) return false;
		if (ew.valueChanged(fobj, infix, "c_date", false)) return false;
		if (ew.valueChanged(fobj, infix, "u_date", false)) return false;
		if (ew.valueChanged(fobj, infix, "c_by", false)) return false;
		if (ew.valueChanged(fobj, infix, "u_by", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fpeg_dokumengrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpeg_dokumengrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpeg_dokumengrid");
});
</script>
<?php } ?>
<?php
$peg_dokumen_grid->renderOtherOptions();
?>
<?php if ($peg_dokumen_grid->TotalRecords > 0 || $peg_dokumen->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($peg_dokumen_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> peg_dokumen">
<?php if ($peg_dokumen_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $peg_dokumen_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fpeg_dokumengrid" class="ew-form ew-list-form form-inline">
<div id="gmp_peg_dokumen" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_peg_dokumengrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$peg_dokumen->RowType = ROWTYPE_HEADER;

// Render list options
$peg_dokumen_grid->renderListOptions();

// Render list options (header, left)
$peg_dokumen_grid->ListOptions->render("header", "left");
?>
<?php if ($peg_dokumen_grid->id->Visible) { // id ?>
	<?php if ($peg_dokumen_grid->SortUrl($peg_dokumen_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $peg_dokumen_grid->id->headerCellClass() ?>"><div id="elh_peg_dokumen_id" class="peg_dokumen_id"><div class="ew-table-header-caption"><?php echo $peg_dokumen_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $peg_dokumen_grid->id->headerCellClass() ?>"><div><div id="elh_peg_dokumen_id" class="peg_dokumen_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_grid->pid->Visible) { // pid ?>
	<?php if ($peg_dokumen_grid->SortUrl($peg_dokumen_grid->pid) == "") { ?>
		<th data-name="pid" class="<?php echo $peg_dokumen_grid->pid->headerCellClass() ?>"><div id="elh_peg_dokumen_pid" class="peg_dokumen_pid"><div class="ew-table-header-caption"><?php echo $peg_dokumen_grid->pid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid" class="<?php echo $peg_dokumen_grid->pid->headerCellClass() ?>"><div><div id="elh_peg_dokumen_pid" class="peg_dokumen_pid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_grid->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_grid->pid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_grid->pid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_grid->nama_dokumen->Visible) { // nama_dokumen ?>
	<?php if ($peg_dokumen_grid->SortUrl($peg_dokumen_grid->nama_dokumen) == "") { ?>
		<th data-name="nama_dokumen" class="<?php echo $peg_dokumen_grid->nama_dokumen->headerCellClass() ?>"><div id="elh_peg_dokumen_nama_dokumen" class="peg_dokumen_nama_dokumen"><div class="ew-table-header-caption"><?php echo $peg_dokumen_grid->nama_dokumen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama_dokumen" class="<?php echo $peg_dokumen_grid->nama_dokumen->headerCellClass() ?>"><div><div id="elh_peg_dokumen_nama_dokumen" class="peg_dokumen_nama_dokumen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_grid->nama_dokumen->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_grid->nama_dokumen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_grid->nama_dokumen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_grid->file_dokumen->Visible) { // file_dokumen ?>
	<?php if ($peg_dokumen_grid->SortUrl($peg_dokumen_grid->file_dokumen) == "") { ?>
		<th data-name="file_dokumen" class="<?php echo $peg_dokumen_grid->file_dokumen->headerCellClass() ?>"><div id="elh_peg_dokumen_file_dokumen" class="peg_dokumen_file_dokumen"><div class="ew-table-header-caption"><?php echo $peg_dokumen_grid->file_dokumen->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="file_dokumen" class="<?php echo $peg_dokumen_grid->file_dokumen->headerCellClass() ?>"><div><div id="elh_peg_dokumen_file_dokumen" class="peg_dokumen_file_dokumen">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_grid->file_dokumen->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_grid->file_dokumen->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_grid->file_dokumen->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_grid->keterangan->Visible) { // keterangan ?>
	<?php if ($peg_dokumen_grid->SortUrl($peg_dokumen_grid->keterangan) == "") { ?>
		<th data-name="keterangan" class="<?php echo $peg_dokumen_grid->keterangan->headerCellClass() ?>"><div id="elh_peg_dokumen_keterangan" class="peg_dokumen_keterangan"><div class="ew-table-header-caption"><?php echo $peg_dokumen_grid->keterangan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="keterangan" class="<?php echo $peg_dokumen_grid->keterangan->headerCellClass() ?>"><div><div id="elh_peg_dokumen_keterangan" class="peg_dokumen_keterangan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_grid->keterangan->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_grid->keterangan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_grid->keterangan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_grid->c_date->Visible) { // c_date ?>
	<?php if ($peg_dokumen_grid->SortUrl($peg_dokumen_grid->c_date) == "") { ?>
		<th data-name="c_date" class="<?php echo $peg_dokumen_grid->c_date->headerCellClass() ?>"><div id="elh_peg_dokumen_c_date" class="peg_dokumen_c_date"><div class="ew-table-header-caption"><?php echo $peg_dokumen_grid->c_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="c_date" class="<?php echo $peg_dokumen_grid->c_date->headerCellClass() ?>"><div><div id="elh_peg_dokumen_c_date" class="peg_dokumen_c_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_grid->c_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_grid->c_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_grid->c_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_grid->u_date->Visible) { // u_date ?>
	<?php if ($peg_dokumen_grid->SortUrl($peg_dokumen_grid->u_date) == "") { ?>
		<th data-name="u_date" class="<?php echo $peg_dokumen_grid->u_date->headerCellClass() ?>"><div id="elh_peg_dokumen_u_date" class="peg_dokumen_u_date"><div class="ew-table-header-caption"><?php echo $peg_dokumen_grid->u_date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="u_date" class="<?php echo $peg_dokumen_grid->u_date->headerCellClass() ?>"><div><div id="elh_peg_dokumen_u_date" class="peg_dokumen_u_date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_grid->u_date->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_grid->u_date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_grid->u_date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_grid->c_by->Visible) { // c_by ?>
	<?php if ($peg_dokumen_grid->SortUrl($peg_dokumen_grid->c_by) == "") { ?>
		<th data-name="c_by" class="<?php echo $peg_dokumen_grid->c_by->headerCellClass() ?>"><div id="elh_peg_dokumen_c_by" class="peg_dokumen_c_by"><div class="ew-table-header-caption"><?php echo $peg_dokumen_grid->c_by->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="c_by" class="<?php echo $peg_dokumen_grid->c_by->headerCellClass() ?>"><div><div id="elh_peg_dokumen_c_by" class="peg_dokumen_c_by">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_grid->c_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_grid->c_by->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_grid->c_by->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_dokumen_grid->u_by->Visible) { // u_by ?>
	<?php if ($peg_dokumen_grid->SortUrl($peg_dokumen_grid->u_by) == "") { ?>
		<th data-name="u_by" class="<?php echo $peg_dokumen_grid->u_by->headerCellClass() ?>"><div id="elh_peg_dokumen_u_by" class="peg_dokumen_u_by"><div class="ew-table-header-caption"><?php echo $peg_dokumen_grid->u_by->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="u_by" class="<?php echo $peg_dokumen_grid->u_by->headerCellClass() ?>"><div><div id="elh_peg_dokumen_u_by" class="peg_dokumen_u_by">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_dokumen_grid->u_by->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_dokumen_grid->u_by->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_dokumen_grid->u_by->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$peg_dokumen_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$peg_dokumen_grid->StartRecord = 1;
$peg_dokumen_grid->StopRecord = $peg_dokumen_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($peg_dokumen->isConfirm() || $peg_dokumen_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($peg_dokumen_grid->FormKeyCountName) && ($peg_dokumen_grid->isGridAdd() || $peg_dokumen_grid->isGridEdit() || $peg_dokumen->isConfirm())) {
		$peg_dokumen_grid->KeyCount = $CurrentForm->getValue($peg_dokumen_grid->FormKeyCountName);
		$peg_dokumen_grid->StopRecord = $peg_dokumen_grid->StartRecord + $peg_dokumen_grid->KeyCount - 1;
	}
}
$peg_dokumen_grid->RecordCount = $peg_dokumen_grid->StartRecord - 1;
if ($peg_dokumen_grid->Recordset && !$peg_dokumen_grid->Recordset->EOF) {
	$peg_dokumen_grid->Recordset->moveFirst();
	$selectLimit = $peg_dokumen_grid->UseSelectLimit;
	if (!$selectLimit && $peg_dokumen_grid->StartRecord > 1)
		$peg_dokumen_grid->Recordset->move($peg_dokumen_grid->StartRecord - 1);
} elseif (!$peg_dokumen->AllowAddDeleteRow && $peg_dokumen_grid->StopRecord == 0) {
	$peg_dokumen_grid->StopRecord = $peg_dokumen->GridAddRowCount;
}

// Initialize aggregate
$peg_dokumen->RowType = ROWTYPE_AGGREGATEINIT;
$peg_dokumen->resetAttributes();
$peg_dokumen_grid->renderRow();
if ($peg_dokumen_grid->isGridAdd())
	$peg_dokumen_grid->RowIndex = 0;
if ($peg_dokumen_grid->isGridEdit())
	$peg_dokumen_grid->RowIndex = 0;
while ($peg_dokumen_grid->RecordCount < $peg_dokumen_grid->StopRecord) {
	$peg_dokumen_grid->RecordCount++;
	if ($peg_dokumen_grid->RecordCount >= $peg_dokumen_grid->StartRecord) {
		$peg_dokumen_grid->RowCount++;
		if ($peg_dokumen_grid->isGridAdd() || $peg_dokumen_grid->isGridEdit() || $peg_dokumen->isConfirm()) {
			$peg_dokumen_grid->RowIndex++;
			$CurrentForm->Index = $peg_dokumen_grid->RowIndex;
			if ($CurrentForm->hasValue($peg_dokumen_grid->FormActionName) && ($peg_dokumen->isConfirm() || $peg_dokumen_grid->EventCancelled))
				$peg_dokumen_grid->RowAction = strval($CurrentForm->getValue($peg_dokumen_grid->FormActionName));
			elseif ($peg_dokumen_grid->isGridAdd())
				$peg_dokumen_grid->RowAction = "insert";
			else
				$peg_dokumen_grid->RowAction = "";
		}

		// Set up key count
		$peg_dokumen_grid->KeyCount = $peg_dokumen_grid->RowIndex;

		// Init row class and style
		$peg_dokumen->resetAttributes();
		$peg_dokumen->CssClass = "";
		if ($peg_dokumen_grid->isGridAdd()) {
			if ($peg_dokumen->CurrentMode == "copy") {
				$peg_dokumen_grid->loadRowValues($peg_dokumen_grid->Recordset); // Load row values
				$peg_dokumen_grid->setRecordKey($peg_dokumen_grid->RowOldKey, $peg_dokumen_grid->Recordset); // Set old record key
			} else {
				$peg_dokumen_grid->loadRowValues(); // Load default values
				$peg_dokumen_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$peg_dokumen_grid->loadRowValues($peg_dokumen_grid->Recordset); // Load row values
		}
		$peg_dokumen->RowType = ROWTYPE_VIEW; // Render view
		if ($peg_dokumen_grid->isGridAdd()) // Grid add
			$peg_dokumen->RowType = ROWTYPE_ADD; // Render add
		if ($peg_dokumen_grid->isGridAdd() && $peg_dokumen->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$peg_dokumen_grid->restoreCurrentRowFormValues($peg_dokumen_grid->RowIndex); // Restore form values
		if ($peg_dokumen_grid->isGridEdit()) { // Grid edit
			if ($peg_dokumen->EventCancelled)
				$peg_dokumen_grid->restoreCurrentRowFormValues($peg_dokumen_grid->RowIndex); // Restore form values
			if ($peg_dokumen_grid->RowAction == "insert")
				$peg_dokumen->RowType = ROWTYPE_ADD; // Render add
			else
				$peg_dokumen->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($peg_dokumen_grid->isGridEdit() && ($peg_dokumen->RowType == ROWTYPE_EDIT || $peg_dokumen->RowType == ROWTYPE_ADD) && $peg_dokumen->EventCancelled) // Update failed
			$peg_dokumen_grid->restoreCurrentRowFormValues($peg_dokumen_grid->RowIndex); // Restore form values
		if ($peg_dokumen->RowType == ROWTYPE_EDIT) // Edit row
			$peg_dokumen_grid->EditRowCount++;
		if ($peg_dokumen->isConfirm()) // Confirm row
			$peg_dokumen_grid->restoreCurrentRowFormValues($peg_dokumen_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$peg_dokumen->RowAttrs->merge(["data-rowindex" => $peg_dokumen_grid->RowCount, "id" => "r" . $peg_dokumen_grid->RowCount . "_peg_dokumen", "data-rowtype" => $peg_dokumen->RowType]);

		// Render row
		$peg_dokumen_grid->renderRow();

		// Render list options
		$peg_dokumen_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($peg_dokumen_grid->RowAction != "delete" && $peg_dokumen_grid->RowAction != "insertdelete" && !($peg_dokumen_grid->RowAction == "insert" && $peg_dokumen->isConfirm() && $peg_dokumen_grid->emptyRow())) {
?>
	<tr <?php echo $peg_dokumen->rowAttributes() ?>>
<?php

// Render list options (body, left)
$peg_dokumen_grid->ListOptions->render("body", "left", $peg_dokumen_grid->RowCount);
?>
	<?php if ($peg_dokumen_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $peg_dokumen_grid->id->cellAttributes() ?>>
<?php if ($peg_dokumen->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_id" class="form-group"></span>
<input type="hidden" data-table="peg_dokumen" data-field="x_id" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_id" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_dokumen_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_id" class="form-group">
<span<?php echo $peg_dokumen_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_dokumen_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_id" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_id" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_dokumen_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_id">
<span<?php echo $peg_dokumen_grid->id->viewAttributes() ?>><?php echo $peg_dokumen_grid->id->getViewValue() ?></span>
</span>
<?php if (!$peg_dokumen->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_id" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_id" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_dokumen_grid->id->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_id" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_id" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_dokumen_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_id" name="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_id" id="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_dokumen_grid->id->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_id" name="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_id" id="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_dokumen_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->pid->Visible) { // pid ?>
		<td data-name="pid" <?php echo $peg_dokumen_grid->pid->cellAttributes() ?>>
<?php if ($peg_dokumen->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($peg_dokumen_grid->pid->getSessionValue() != "") { ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_pid" class="form-group">
<span<?php echo $peg_dokumen_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_dokumen_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_dokumen_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_pid" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_pid" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->pid->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->pid->EditValue ?>"<?php echo $peg_dokumen_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_pid" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_pid" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_dokumen_grid->pid->OldValue) ?>">
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($peg_dokumen_grid->pid->getSessionValue() != "") { ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_pid" class="form-group">
<span<?php echo $peg_dokumen_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_dokumen_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_dokumen_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_pid" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_pid" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->pid->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->pid->EditValue ?>"<?php echo $peg_dokumen_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_pid">
<span<?php echo $peg_dokumen_grid->pid->viewAttributes() ?>><?php echo $peg_dokumen_grid->pid->getViewValue() ?></span>
</span>
<?php if (!$peg_dokumen->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_pid" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_dokumen_grid->pid->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_pid" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_pid" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_dokumen_grid->pid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_pid" name="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" id="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_dokumen_grid->pid->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_pid" name="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_pid" id="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_dokumen_grid->pid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->nama_dokumen->Visible) { // nama_dokumen ?>
		<td data-name="nama_dokumen" <?php echo $peg_dokumen_grid->nama_dokumen->cellAttributes() ?>>
<?php if ($peg_dokumen->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_nama_dokumen" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_nama_dokumen" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->nama_dokumen->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->nama_dokumen->EditValue ?>"<?php echo $peg_dokumen_grid->nama_dokumen->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_nama_dokumen" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" value="<?php echo HtmlEncode($peg_dokumen_grid->nama_dokumen->OldValue) ?>">
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_nama_dokumen" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_nama_dokumen" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->nama_dokumen->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->nama_dokumen->EditValue ?>"<?php echo $peg_dokumen_grid->nama_dokumen->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_nama_dokumen">
<span<?php echo $peg_dokumen_grid->nama_dokumen->viewAttributes() ?>><?php echo $peg_dokumen_grid->nama_dokumen->getViewValue() ?></span>
</span>
<?php if (!$peg_dokumen->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_nama_dokumen" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" value="<?php echo HtmlEncode($peg_dokumen_grid->nama_dokumen->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_nama_dokumen" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" value="<?php echo HtmlEncode($peg_dokumen_grid->nama_dokumen->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_nama_dokumen" name="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" id="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" value="<?php echo HtmlEncode($peg_dokumen_grid->nama_dokumen->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_nama_dokumen" name="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" id="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" value="<?php echo HtmlEncode($peg_dokumen_grid->nama_dokumen->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->file_dokumen->Visible) { // file_dokumen ?>
		<td data-name="file_dokumen" <?php echo $peg_dokumen_grid->file_dokumen->cellAttributes() ?>>
<?php if ($peg_dokumen->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_file_dokumen" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_file_dokumen" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->file_dokumen->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->file_dokumen->EditValue ?>"<?php echo $peg_dokumen_grid->file_dokumen->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_file_dokumen" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" value="<?php echo HtmlEncode($peg_dokumen_grid->file_dokumen->OldValue) ?>">
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_file_dokumen" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_file_dokumen" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->file_dokumen->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->file_dokumen->EditValue ?>"<?php echo $peg_dokumen_grid->file_dokumen->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_file_dokumen">
<span<?php echo $peg_dokumen_grid->file_dokumen->viewAttributes() ?>><?php echo $peg_dokumen_grid->file_dokumen->getViewValue() ?></span>
</span>
<?php if (!$peg_dokumen->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_file_dokumen" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" value="<?php echo HtmlEncode($peg_dokumen_grid->file_dokumen->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_file_dokumen" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" value="<?php echo HtmlEncode($peg_dokumen_grid->file_dokumen->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_file_dokumen" name="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" id="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" value="<?php echo HtmlEncode($peg_dokumen_grid->file_dokumen->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_file_dokumen" name="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" id="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" value="<?php echo HtmlEncode($peg_dokumen_grid->file_dokumen->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan" <?php echo $peg_dokumen_grid->keterangan->cellAttributes() ?>>
<?php if ($peg_dokumen->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_keterangan" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_keterangan" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->keterangan->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->keterangan->EditValue ?>"<?php echo $peg_dokumen_grid->keterangan->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_keterangan" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($peg_dokumen_grid->keterangan->OldValue) ?>">
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_keterangan" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_keterangan" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->keterangan->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->keterangan->EditValue ?>"<?php echo $peg_dokumen_grid->keterangan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_keterangan">
<span<?php echo $peg_dokumen_grid->keterangan->viewAttributes() ?>><?php echo $peg_dokumen_grid->keterangan->getViewValue() ?></span>
</span>
<?php if (!$peg_dokumen->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_keterangan" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($peg_dokumen_grid->keterangan->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_keterangan" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($peg_dokumen_grid->keterangan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_keterangan" name="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" id="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($peg_dokumen_grid->keterangan->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_keterangan" name="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" id="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($peg_dokumen_grid->keterangan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->c_date->Visible) { // c_date ?>
		<td data-name="c_date" <?php echo $peg_dokumen_grid->c_date->cellAttributes() ?>>
<?php if ($peg_dokumen->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_c_date" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_c_date" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->c_date->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->c_date->EditValue ?>"<?php echo $peg_dokumen_grid->c_date->editAttributes() ?>>
<?php if (!$peg_dokumen_grid->c_date->ReadOnly && !$peg_dokumen_grid->c_date->Disabled && !isset($peg_dokumen_grid->c_date->EditAttrs["readonly"]) && !isset($peg_dokumen_grid->c_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_dokumengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_dokumengrid", "x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_date" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" value="<?php echo HtmlEncode($peg_dokumen_grid->c_date->OldValue) ?>">
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_c_date" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_c_date" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->c_date->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->c_date->EditValue ?>"<?php echo $peg_dokumen_grid->c_date->editAttributes() ?>>
<?php if (!$peg_dokumen_grid->c_date->ReadOnly && !$peg_dokumen_grid->c_date->Disabled && !isset($peg_dokumen_grid->c_date->EditAttrs["readonly"]) && !isset($peg_dokumen_grid->c_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_dokumengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_dokumengrid", "x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_c_date">
<span<?php echo $peg_dokumen_grid->c_date->viewAttributes() ?>><?php echo $peg_dokumen_grid->c_date->getViewValue() ?></span>
</span>
<?php if (!$peg_dokumen->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_date" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" value="<?php echo HtmlEncode($peg_dokumen_grid->c_date->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_c_date" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" value="<?php echo HtmlEncode($peg_dokumen_grid->c_date->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_date" name="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" id="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" value="<?php echo HtmlEncode($peg_dokumen_grid->c_date->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_c_date" name="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" id="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" value="<?php echo HtmlEncode($peg_dokumen_grid->c_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->u_date->Visible) { // u_date ?>
		<td data-name="u_date" <?php echo $peg_dokumen_grid->u_date->cellAttributes() ?>>
<?php if ($peg_dokumen->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_u_date" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_u_date" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->u_date->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->u_date->EditValue ?>"<?php echo $peg_dokumen_grid->u_date->editAttributes() ?>>
<?php if (!$peg_dokumen_grid->u_date->ReadOnly && !$peg_dokumen_grid->u_date->Disabled && !isset($peg_dokumen_grid->u_date->EditAttrs["readonly"]) && !isset($peg_dokumen_grid->u_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_dokumengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_dokumengrid", "x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_date" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" value="<?php echo HtmlEncode($peg_dokumen_grid->u_date->OldValue) ?>">
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_u_date" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_u_date" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->u_date->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->u_date->EditValue ?>"<?php echo $peg_dokumen_grid->u_date->editAttributes() ?>>
<?php if (!$peg_dokumen_grid->u_date->ReadOnly && !$peg_dokumen_grid->u_date->Disabled && !isset($peg_dokumen_grid->u_date->EditAttrs["readonly"]) && !isset($peg_dokumen_grid->u_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_dokumengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_dokumengrid", "x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_u_date">
<span<?php echo $peg_dokumen_grid->u_date->viewAttributes() ?>><?php echo $peg_dokumen_grid->u_date->getViewValue() ?></span>
</span>
<?php if (!$peg_dokumen->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_date" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" value="<?php echo HtmlEncode($peg_dokumen_grid->u_date->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_u_date" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" value="<?php echo HtmlEncode($peg_dokumen_grid->u_date->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_date" name="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" id="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" value="<?php echo HtmlEncode($peg_dokumen_grid->u_date->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_u_date" name="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" id="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" value="<?php echo HtmlEncode($peg_dokumen_grid->u_date->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->c_by->Visible) { // c_by ?>
		<td data-name="c_by" <?php echo $peg_dokumen_grid->c_by->cellAttributes() ?>>
<?php if ($peg_dokumen->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_c_by" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_c_by" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->c_by->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->c_by->EditValue ?>"<?php echo $peg_dokumen_grid->c_by->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_by" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" value="<?php echo HtmlEncode($peg_dokumen_grid->c_by->OldValue) ?>">
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_c_by" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_c_by" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->c_by->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->c_by->EditValue ?>"<?php echo $peg_dokumen_grid->c_by->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_c_by">
<span<?php echo $peg_dokumen_grid->c_by->viewAttributes() ?>><?php echo $peg_dokumen_grid->c_by->getViewValue() ?></span>
</span>
<?php if (!$peg_dokumen->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_by" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" value="<?php echo HtmlEncode($peg_dokumen_grid->c_by->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_c_by" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" value="<?php echo HtmlEncode($peg_dokumen_grid->c_by->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_by" name="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" id="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" value="<?php echo HtmlEncode($peg_dokumen_grid->c_by->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_c_by" name="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" id="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" value="<?php echo HtmlEncode($peg_dokumen_grid->c_by->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->u_by->Visible) { // u_by ?>
		<td data-name="u_by" <?php echo $peg_dokumen_grid->u_by->cellAttributes() ?>>
<?php if ($peg_dokumen->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_u_by" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_u_by" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->u_by->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->u_by->EditValue ?>"<?php echo $peg_dokumen_grid->u_by->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_by" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" value="<?php echo HtmlEncode($peg_dokumen_grid->u_by->OldValue) ?>">
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_u_by" class="form-group">
<input type="text" data-table="peg_dokumen" data-field="x_u_by" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->u_by->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->u_by->EditValue ?>"<?php echo $peg_dokumen_grid->u_by->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_dokumen->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_dokumen_grid->RowCount ?>_peg_dokumen_u_by">
<span<?php echo $peg_dokumen_grid->u_by->viewAttributes() ?>><?php echo $peg_dokumen_grid->u_by->getViewValue() ?></span>
</span>
<?php if (!$peg_dokumen->isConfirm()) { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_by" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" value="<?php echo HtmlEncode($peg_dokumen_grid->u_by->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_u_by" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" value="<?php echo HtmlEncode($peg_dokumen_grid->u_by->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_by" name="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" id="fpeg_dokumengrid$x<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" value="<?php echo HtmlEncode($peg_dokumen_grid->u_by->FormValue) ?>">
<input type="hidden" data-table="peg_dokumen" data-field="x_u_by" name="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" id="fpeg_dokumengrid$o<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" value="<?php echo HtmlEncode($peg_dokumen_grid->u_by->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$peg_dokumen_grid->ListOptions->render("body", "right", $peg_dokumen_grid->RowCount);
?>
	</tr>
<?php if ($peg_dokumen->RowType == ROWTYPE_ADD || $peg_dokumen->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpeg_dokumengrid", "load"], function() {
	fpeg_dokumengrid.updateLists(<?php echo $peg_dokumen_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$peg_dokumen_grid->isGridAdd() || $peg_dokumen->CurrentMode == "copy")
		if (!$peg_dokumen_grid->Recordset->EOF)
			$peg_dokumen_grid->Recordset->moveNext();
}
?>
<?php
	if ($peg_dokumen->CurrentMode == "add" || $peg_dokumen->CurrentMode == "copy" || $peg_dokumen->CurrentMode == "edit") {
		$peg_dokumen_grid->RowIndex = '$rowindex$';
		$peg_dokumen_grid->loadRowValues();

		// Set row properties
		$peg_dokumen->resetAttributes();
		$peg_dokumen->RowAttrs->merge(["data-rowindex" => $peg_dokumen_grid->RowIndex, "id" => "r0_peg_dokumen", "data-rowtype" => ROWTYPE_ADD]);
		$peg_dokumen->RowAttrs->appendClass("ew-template");
		$peg_dokumen->RowType = ROWTYPE_ADD;

		// Render row
		$peg_dokumen_grid->renderRow();

		// Render list options
		$peg_dokumen_grid->renderListOptions();
		$peg_dokumen_grid->StartRowCount = 0;
?>
	<tr <?php echo $peg_dokumen->rowAttributes() ?>>
<?php

// Render list options (body, left)
$peg_dokumen_grid->ListOptions->render("body", "left", $peg_dokumen_grid->RowIndex);
?>
	<?php if ($peg_dokumen_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$peg_dokumen->isConfirm()) { ?>
<span id="el$rowindex$_peg_dokumen_id" class="form-group peg_dokumen_id"></span>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_id" class="form-group peg_dokumen_id">
<span<?php echo $peg_dokumen_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_dokumen_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_id" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_id" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_dokumen_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_id" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_id" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_dokumen_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->pid->Visible) { // pid ?>
		<td data-name="pid">
<?php if (!$peg_dokumen->isConfirm()) { ?>
<?php if ($peg_dokumen_grid->pid->getSessionValue() != "") { ?>
<span id="el$rowindex$_peg_dokumen_pid" class="form-group peg_dokumen_pid">
<span<?php echo $peg_dokumen_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_dokumen_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_dokumen_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_pid" class="form-group peg_dokumen_pid">
<input type="text" data-table="peg_dokumen" data-field="x_pid" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->pid->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->pid->EditValue ?>"<?php echo $peg_dokumen_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_pid" class="form-group peg_dokumen_pid">
<span<?php echo $peg_dokumen_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_dokumen_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_pid" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_dokumen_grid->pid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_pid" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_pid" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_dokumen_grid->pid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->nama_dokumen->Visible) { // nama_dokumen ?>
		<td data-name="nama_dokumen">
<?php if (!$peg_dokumen->isConfirm()) { ?>
<span id="el$rowindex$_peg_dokumen_nama_dokumen" class="form-group peg_dokumen_nama_dokumen">
<input type="text" data-table="peg_dokumen" data-field="x_nama_dokumen" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->nama_dokumen->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->nama_dokumen->EditValue ?>"<?php echo $peg_dokumen_grid->nama_dokumen->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_nama_dokumen" class="form-group peg_dokumen_nama_dokumen">
<span<?php echo $peg_dokumen_grid->nama_dokumen->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_dokumen_grid->nama_dokumen->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_nama_dokumen" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" value="<?php echo HtmlEncode($peg_dokumen_grid->nama_dokumen->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_nama_dokumen" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_nama_dokumen" value="<?php echo HtmlEncode($peg_dokumen_grid->nama_dokumen->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->file_dokumen->Visible) { // file_dokumen ?>
		<td data-name="file_dokumen">
<?php if (!$peg_dokumen->isConfirm()) { ?>
<span id="el$rowindex$_peg_dokumen_file_dokumen" class="form-group peg_dokumen_file_dokumen">
<input type="text" data-table="peg_dokumen" data-field="x_file_dokumen" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->file_dokumen->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->file_dokumen->EditValue ?>"<?php echo $peg_dokumen_grid->file_dokumen->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_file_dokumen" class="form-group peg_dokumen_file_dokumen">
<span<?php echo $peg_dokumen_grid->file_dokumen->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_dokumen_grid->file_dokumen->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_file_dokumen" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" value="<?php echo HtmlEncode($peg_dokumen_grid->file_dokumen->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_file_dokumen" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_file_dokumen" value="<?php echo HtmlEncode($peg_dokumen_grid->file_dokumen->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->keterangan->Visible) { // keterangan ?>
		<td data-name="keterangan">
<?php if (!$peg_dokumen->isConfirm()) { ?>
<span id="el$rowindex$_peg_dokumen_keterangan" class="form-group peg_dokumen_keterangan">
<input type="text" data-table="peg_dokumen" data-field="x_keterangan" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->keterangan->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->keterangan->EditValue ?>"<?php echo $peg_dokumen_grid->keterangan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_keterangan" class="form-group peg_dokumen_keterangan">
<span<?php echo $peg_dokumen_grid->keterangan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_dokumen_grid->keterangan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_keterangan" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($peg_dokumen_grid->keterangan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_keterangan" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_keterangan" value="<?php echo HtmlEncode($peg_dokumen_grid->keterangan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->c_date->Visible) { // c_date ?>
		<td data-name="c_date">
<?php if (!$peg_dokumen->isConfirm()) { ?>
<span id="el$rowindex$_peg_dokumen_c_date" class="form-group peg_dokumen_c_date">
<input type="text" data-table="peg_dokumen" data-field="x_c_date" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->c_date->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->c_date->EditValue ?>"<?php echo $peg_dokumen_grid->c_date->editAttributes() ?>>
<?php if (!$peg_dokumen_grid->c_date->ReadOnly && !$peg_dokumen_grid->c_date->Disabled && !isset($peg_dokumen_grid->c_date->EditAttrs["readonly"]) && !isset($peg_dokumen_grid->c_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_dokumengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_dokumengrid", "x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_c_date" class="form-group peg_dokumen_c_date">
<span<?php echo $peg_dokumen_grid->c_date->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_dokumen_grid->c_date->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_date" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" value="<?php echo HtmlEncode($peg_dokumen_grid->c_date->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_date" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_c_date" value="<?php echo HtmlEncode($peg_dokumen_grid->c_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->u_date->Visible) { // u_date ?>
		<td data-name="u_date">
<?php if (!$peg_dokumen->isConfirm()) { ?>
<span id="el$rowindex$_peg_dokumen_u_date" class="form-group peg_dokumen_u_date">
<input type="text" data-table="peg_dokumen" data-field="x_u_date" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" maxlength="19" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->u_date->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->u_date->EditValue ?>"<?php echo $peg_dokumen_grid->u_date->editAttributes() ?>>
<?php if (!$peg_dokumen_grid->u_date->ReadOnly && !$peg_dokumen_grid->u_date->Disabled && !isset($peg_dokumen_grid->u_date->EditAttrs["readonly"]) && !isset($peg_dokumen_grid->u_date->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_dokumengrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_dokumengrid", "x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_u_date" class="form-group peg_dokumen_u_date">
<span<?php echo $peg_dokumen_grid->u_date->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_dokumen_grid->u_date->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_date" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" value="<?php echo HtmlEncode($peg_dokumen_grid->u_date->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_date" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_u_date" value="<?php echo HtmlEncode($peg_dokumen_grid->u_date->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->c_by->Visible) { // c_by ?>
		<td data-name="c_by">
<?php if (!$peg_dokumen->isConfirm()) { ?>
<span id="el$rowindex$_peg_dokumen_c_by" class="form-group peg_dokumen_c_by">
<input type="text" data-table="peg_dokumen" data-field="x_c_by" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->c_by->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->c_by->EditValue ?>"<?php echo $peg_dokumen_grid->c_by->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_c_by" class="form-group peg_dokumen_c_by">
<span<?php echo $peg_dokumen_grid->c_by->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_dokumen_grid->c_by->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_by" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" value="<?php echo HtmlEncode($peg_dokumen_grid->c_by->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_c_by" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_c_by" value="<?php echo HtmlEncode($peg_dokumen_grid->c_by->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_dokumen_grid->u_by->Visible) { // u_by ?>
		<td data-name="u_by">
<?php if (!$peg_dokumen->isConfirm()) { ?>
<span id="el$rowindex$_peg_dokumen_u_by" class="form-group peg_dokumen_u_by">
<input type="text" data-table="peg_dokumen" data-field="x_u_by" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_dokumen_grid->u_by->getPlaceHolder()) ?>" value="<?php echo $peg_dokumen_grid->u_by->EditValue ?>"<?php echo $peg_dokumen_grid->u_by->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_dokumen_u_by" class="form-group peg_dokumen_u_by">
<span<?php echo $peg_dokumen_grid->u_by->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_dokumen_grid->u_by->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_by" name="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" id="x<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" value="<?php echo HtmlEncode($peg_dokumen_grid->u_by->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_dokumen" data-field="x_u_by" name="o<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" id="o<?php echo $peg_dokumen_grid->RowIndex ?>_u_by" value="<?php echo HtmlEncode($peg_dokumen_grid->u_by->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$peg_dokumen_grid->ListOptions->render("body", "right", $peg_dokumen_grid->RowIndex);
?>
<script>
loadjs.ready(["fpeg_dokumengrid", "load"], function() {
	fpeg_dokumengrid.updateLists(<?php echo $peg_dokumen_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($peg_dokumen->CurrentMode == "add" || $peg_dokumen->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $peg_dokumen_grid->FormKeyCountName ?>" id="<?php echo $peg_dokumen_grid->FormKeyCountName ?>" value="<?php echo $peg_dokumen_grid->KeyCount ?>">
<?php echo $peg_dokumen_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($peg_dokumen->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $peg_dokumen_grid->FormKeyCountName ?>" id="<?php echo $peg_dokumen_grid->FormKeyCountName ?>" value="<?php echo $peg_dokumen_grid->KeyCount ?>">
<?php echo $peg_dokumen_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($peg_dokumen->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fpeg_dokumengrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($peg_dokumen_grid->Recordset)
	$peg_dokumen_grid->Recordset->Close();
?>
<?php if ($peg_dokumen_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $peg_dokumen_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($peg_dokumen_grid->TotalRecords == 0 && !$peg_dokumen->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $peg_dokumen_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$peg_dokumen_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$peg_dokumen_grid->terminate();
?>