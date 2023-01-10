<?php
namespace PHPMaker2020\sigap;

// Write header
WriteHeader(FALSE);

// Create page object
if (!isset($peg_keluarga_grid))
	$peg_keluarga_grid = new peg_keluarga_grid();

// Run the page
$peg_keluarga_grid->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$peg_keluarga_grid->Page_Render();
?>
<?php if (!$peg_keluarga_grid->isExport()) { ?>
<script>
var fpeg_keluargagrid, currentPageID;
loadjs.ready("head", function() {

	// Form object
	fpeg_keluargagrid = new ew.Form("fpeg_keluargagrid", "grid");
	fpeg_keluargagrid.formKeyCountName = '<?php echo $peg_keluarga_grid->FormKeyCountName ?>';

	// Validate form
	fpeg_keluargagrid.validate = function() {
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
			<?php if ($peg_keluarga_grid->id->Required) { ?>
				elm = this.getElements("x" + infix + "_id");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_grid->id->caption(), $peg_keluarga_grid->id->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_keluarga_grid->pid->Required) { ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_grid->pid->caption(), $peg_keluarga_grid->pid->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_pid");
				if (elm && !ew.checkInteger(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_keluarga_grid->pid->errorMessage()) ?>");
			<?php if ($peg_keluarga_grid->nama->Required) { ?>
				elm = this.getElements("x" + infix + "_nama");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_grid->nama->caption(), $peg_keluarga_grid->nama->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_keluarga_grid->hp->Required) { ?>
				elm = this.getElements("x" + infix + "_hp");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_grid->hp->caption(), $peg_keluarga_grid->hp->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_keluarga_grid->hubungan->Required) { ?>
				elm = this.getElements("x" + infix + "_hubungan");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_grid->hubungan->caption(), $peg_keluarga_grid->hubungan->RequiredErrorMessage)) ?>");
			<?php } ?>
			<?php if ($peg_keluarga_grid->tgl_lahir->Required) { ?>
				elm = this.getElements("x" + infix + "_tgl_lahir");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_grid->tgl_lahir->caption(), $peg_keluarga_grid->tgl_lahir->RequiredErrorMessage)) ?>");
			<?php } ?>
				elm = this.getElements("x" + infix + "_tgl_lahir");
				if (elm && !ew.checkDateDef(elm.value))
					return this.onError(elm, "<?php echo JsEncode($peg_keluarga_grid->tgl_lahir->errorMessage()) ?>");
			<?php if ($peg_keluarga_grid->jen_kel->Required) { ?>
				elm = this.getElements("x" + infix + "_jen_kel");
				if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
					return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $peg_keluarga_grid->jen_kel->caption(), $peg_keluarga_grid->jen_kel->RequiredErrorMessage)) ?>");
			<?php } ?>

				// Call Form_CustomValidate event
				if (!this.Form_CustomValidate(fobj))
					return false;
			} // End Grid Add checking
		}
		return true;
	}

	// Check empty row
	fpeg_keluargagrid.emptyRow = function(infix) {
		var fobj = this._form;
		if (ew.valueChanged(fobj, infix, "pid", false)) return false;
		if (ew.valueChanged(fobj, infix, "nama", false)) return false;
		if (ew.valueChanged(fobj, infix, "hp", false)) return false;
		if (ew.valueChanged(fobj, infix, "hubungan", false)) return false;
		if (ew.valueChanged(fobj, infix, "tgl_lahir", false)) return false;
		if (ew.valueChanged(fobj, infix, "jen_kel", false)) return false;
		return true;
	}

	// Form_CustomValidate
	fpeg_keluargagrid.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

		// Your custom validation code here, return false if invalid.
		return true;
	}

	// Use JavaScript validation or not
	fpeg_keluargagrid.validateRequired = <?php echo Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

	// Dynamic selection lists
	loadjs.done("fpeg_keluargagrid");
});
</script>
<?php } ?>
<?php
$peg_keluarga_grid->renderOtherOptions();
?>
<?php if ($peg_keluarga_grid->TotalRecords > 0 || $peg_keluarga->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($peg_keluarga_grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> peg_keluarga">
<?php if ($peg_keluarga_grid->ShowOtherOptions) { ?>
<div class="card-header ew-grid-upper-panel">
<?php $peg_keluarga_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="fpeg_keluargagrid" class="ew-form ew-list-form form-inline">
<div id="gmp_peg_keluarga" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_peg_keluargagrid" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$peg_keluarga->RowType = ROWTYPE_HEADER;

// Render list options
$peg_keluarga_grid->renderListOptions();

// Render list options (header, left)
$peg_keluarga_grid->ListOptions->render("header", "left");
?>
<?php if ($peg_keluarga_grid->id->Visible) { // id ?>
	<?php if ($peg_keluarga_grid->SortUrl($peg_keluarga_grid->id) == "") { ?>
		<th data-name="id" class="<?php echo $peg_keluarga_grid->id->headerCellClass() ?>"><div id="elh_peg_keluarga_id" class="peg_keluarga_id"><div class="ew-table-header-caption"><?php echo $peg_keluarga_grid->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $peg_keluarga_grid->id->headerCellClass() ?>"><div><div id="elh_peg_keluarga_id" class="peg_keluarga_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_grid->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_grid->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_grid->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_grid->pid->Visible) { // pid ?>
	<?php if ($peg_keluarga_grid->SortUrl($peg_keluarga_grid->pid) == "") { ?>
		<th data-name="pid" class="<?php echo $peg_keluarga_grid->pid->headerCellClass() ?>"><div id="elh_peg_keluarga_pid" class="peg_keluarga_pid"><div class="ew-table-header-caption"><?php echo $peg_keluarga_grid->pid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pid" class="<?php echo $peg_keluarga_grid->pid->headerCellClass() ?>"><div><div id="elh_peg_keluarga_pid" class="peg_keluarga_pid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_grid->pid->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_grid->pid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_grid->pid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_grid->nama->Visible) { // nama ?>
	<?php if ($peg_keluarga_grid->SortUrl($peg_keluarga_grid->nama) == "") { ?>
		<th data-name="nama" class="<?php echo $peg_keluarga_grid->nama->headerCellClass() ?>"><div id="elh_peg_keluarga_nama" class="peg_keluarga_nama"><div class="ew-table-header-caption"><?php echo $peg_keluarga_grid->nama->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nama" class="<?php echo $peg_keluarga_grid->nama->headerCellClass() ?>"><div><div id="elh_peg_keluarga_nama" class="peg_keluarga_nama">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_grid->nama->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_grid->nama->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_grid->nama->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_grid->hp->Visible) { // hp ?>
	<?php if ($peg_keluarga_grid->SortUrl($peg_keluarga_grid->hp) == "") { ?>
		<th data-name="hp" class="<?php echo $peg_keluarga_grid->hp->headerCellClass() ?>"><div id="elh_peg_keluarga_hp" class="peg_keluarga_hp"><div class="ew-table-header-caption"><?php echo $peg_keluarga_grid->hp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hp" class="<?php echo $peg_keluarga_grid->hp->headerCellClass() ?>"><div><div id="elh_peg_keluarga_hp" class="peg_keluarga_hp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_grid->hp->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_grid->hp->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_grid->hp->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_grid->hubungan->Visible) { // hubungan ?>
	<?php if ($peg_keluarga_grid->SortUrl($peg_keluarga_grid->hubungan) == "") { ?>
		<th data-name="hubungan" class="<?php echo $peg_keluarga_grid->hubungan->headerCellClass() ?>"><div id="elh_peg_keluarga_hubungan" class="peg_keluarga_hubungan"><div class="ew-table-header-caption"><?php echo $peg_keluarga_grid->hubungan->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="hubungan" class="<?php echo $peg_keluarga_grid->hubungan->headerCellClass() ?>"><div><div id="elh_peg_keluarga_hubungan" class="peg_keluarga_hubungan">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_grid->hubungan->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_grid->hubungan->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_grid->hubungan->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_grid->tgl_lahir->Visible) { // tgl_lahir ?>
	<?php if ($peg_keluarga_grid->SortUrl($peg_keluarga_grid->tgl_lahir) == "") { ?>
		<th data-name="tgl_lahir" class="<?php echo $peg_keluarga_grid->tgl_lahir->headerCellClass() ?>"><div id="elh_peg_keluarga_tgl_lahir" class="peg_keluarga_tgl_lahir"><div class="ew-table-header-caption"><?php echo $peg_keluarga_grid->tgl_lahir->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl_lahir" class="<?php echo $peg_keluarga_grid->tgl_lahir->headerCellClass() ?>"><div><div id="elh_peg_keluarga_tgl_lahir" class="peg_keluarga_tgl_lahir">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_grid->tgl_lahir->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_grid->tgl_lahir->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_grid->tgl_lahir->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($peg_keluarga_grid->jen_kel->Visible) { // jen_kel ?>
	<?php if ($peg_keluarga_grid->SortUrl($peg_keluarga_grid->jen_kel) == "") { ?>
		<th data-name="jen_kel" class="<?php echo $peg_keluarga_grid->jen_kel->headerCellClass() ?>"><div id="elh_peg_keluarga_jen_kel" class="peg_keluarga_jen_kel"><div class="ew-table-header-caption"><?php echo $peg_keluarga_grid->jen_kel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jen_kel" class="<?php echo $peg_keluarga_grid->jen_kel->headerCellClass() ?>"><div><div id="elh_peg_keluarga_jen_kel" class="peg_keluarga_jen_kel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $peg_keluarga_grid->jen_kel->caption() ?></span><span class="ew-table-header-sort"><?php if ($peg_keluarga_grid->jen_kel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($peg_keluarga_grid->jen_kel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$peg_keluarga_grid->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$peg_keluarga_grid->StartRecord = 1;
$peg_keluarga_grid->StopRecord = $peg_keluarga_grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($peg_keluarga->isConfirm() || $peg_keluarga_grid->EventCancelled)) {
	$CurrentForm->Index = -1;
	if ($CurrentForm->hasValue($peg_keluarga_grid->FormKeyCountName) && ($peg_keluarga_grid->isGridAdd() || $peg_keluarga_grid->isGridEdit() || $peg_keluarga->isConfirm())) {
		$peg_keluarga_grid->KeyCount = $CurrentForm->getValue($peg_keluarga_grid->FormKeyCountName);
		$peg_keluarga_grid->StopRecord = $peg_keluarga_grid->StartRecord + $peg_keluarga_grid->KeyCount - 1;
	}
}
$peg_keluarga_grid->RecordCount = $peg_keluarga_grid->StartRecord - 1;
if ($peg_keluarga_grid->Recordset && !$peg_keluarga_grid->Recordset->EOF) {
	$peg_keluarga_grid->Recordset->moveFirst();
	$selectLimit = $peg_keluarga_grid->UseSelectLimit;
	if (!$selectLimit && $peg_keluarga_grid->StartRecord > 1)
		$peg_keluarga_grid->Recordset->move($peg_keluarga_grid->StartRecord - 1);
} elseif (!$peg_keluarga->AllowAddDeleteRow && $peg_keluarga_grid->StopRecord == 0) {
	$peg_keluarga_grid->StopRecord = $peg_keluarga->GridAddRowCount;
}

// Initialize aggregate
$peg_keluarga->RowType = ROWTYPE_AGGREGATEINIT;
$peg_keluarga->resetAttributes();
$peg_keluarga_grid->renderRow();
if ($peg_keluarga_grid->isGridAdd())
	$peg_keluarga_grid->RowIndex = 0;
if ($peg_keluarga_grid->isGridEdit())
	$peg_keluarga_grid->RowIndex = 0;
while ($peg_keluarga_grid->RecordCount < $peg_keluarga_grid->StopRecord) {
	$peg_keluarga_grid->RecordCount++;
	if ($peg_keluarga_grid->RecordCount >= $peg_keluarga_grid->StartRecord) {
		$peg_keluarga_grid->RowCount++;
		if ($peg_keluarga_grid->isGridAdd() || $peg_keluarga_grid->isGridEdit() || $peg_keluarga->isConfirm()) {
			$peg_keluarga_grid->RowIndex++;
			$CurrentForm->Index = $peg_keluarga_grid->RowIndex;
			if ($CurrentForm->hasValue($peg_keluarga_grid->FormActionName) && ($peg_keluarga->isConfirm() || $peg_keluarga_grid->EventCancelled))
				$peg_keluarga_grid->RowAction = strval($CurrentForm->getValue($peg_keluarga_grid->FormActionName));
			elseif ($peg_keluarga_grid->isGridAdd())
				$peg_keluarga_grid->RowAction = "insert";
			else
				$peg_keluarga_grid->RowAction = "";
		}

		// Set up key count
		$peg_keluarga_grid->KeyCount = $peg_keluarga_grid->RowIndex;

		// Init row class and style
		$peg_keluarga->resetAttributes();
		$peg_keluarga->CssClass = "";
		if ($peg_keluarga_grid->isGridAdd()) {
			if ($peg_keluarga->CurrentMode == "copy") {
				$peg_keluarga_grid->loadRowValues($peg_keluarga_grid->Recordset); // Load row values
				$peg_keluarga_grid->setRecordKey($peg_keluarga_grid->RowOldKey, $peg_keluarga_grid->Recordset); // Set old record key
			} else {
				$peg_keluarga_grid->loadRowValues(); // Load default values
				$peg_keluarga_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$peg_keluarga_grid->loadRowValues($peg_keluarga_grid->Recordset); // Load row values
		}
		$peg_keluarga->RowType = ROWTYPE_VIEW; // Render view
		if ($peg_keluarga_grid->isGridAdd()) // Grid add
			$peg_keluarga->RowType = ROWTYPE_ADD; // Render add
		if ($peg_keluarga_grid->isGridAdd() && $peg_keluarga->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) // Insert failed
			$peg_keluarga_grid->restoreCurrentRowFormValues($peg_keluarga_grid->RowIndex); // Restore form values
		if ($peg_keluarga_grid->isGridEdit()) { // Grid edit
			if ($peg_keluarga->EventCancelled)
				$peg_keluarga_grid->restoreCurrentRowFormValues($peg_keluarga_grid->RowIndex); // Restore form values
			if ($peg_keluarga_grid->RowAction == "insert")
				$peg_keluarga->RowType = ROWTYPE_ADD; // Render add
			else
				$peg_keluarga->RowType = ROWTYPE_EDIT; // Render edit
		}
		if ($peg_keluarga_grid->isGridEdit() && ($peg_keluarga->RowType == ROWTYPE_EDIT || $peg_keluarga->RowType == ROWTYPE_ADD) && $peg_keluarga->EventCancelled) // Update failed
			$peg_keluarga_grid->restoreCurrentRowFormValues($peg_keluarga_grid->RowIndex); // Restore form values
		if ($peg_keluarga->RowType == ROWTYPE_EDIT) // Edit row
			$peg_keluarga_grid->EditRowCount++;
		if ($peg_keluarga->isConfirm()) // Confirm row
			$peg_keluarga_grid->restoreCurrentRowFormValues($peg_keluarga_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$peg_keluarga->RowAttrs->merge(["data-rowindex" => $peg_keluarga_grid->RowCount, "id" => "r" . $peg_keluarga_grid->RowCount . "_peg_keluarga", "data-rowtype" => $peg_keluarga->RowType]);

		// Render row
		$peg_keluarga_grid->renderRow();

		// Render list options
		$peg_keluarga_grid->renderListOptions();

		// Skip delete row / empty row for confirm page
		if ($peg_keluarga_grid->RowAction != "delete" && $peg_keluarga_grid->RowAction != "insertdelete" && !($peg_keluarga_grid->RowAction == "insert" && $peg_keluarga->isConfirm() && $peg_keluarga_grid->emptyRow())) {
?>
	<tr <?php echo $peg_keluarga->rowAttributes() ?>>
<?php

// Render list options (body, left)
$peg_keluarga_grid->ListOptions->render("body", "left", $peg_keluarga_grid->RowCount);
?>
	<?php if ($peg_keluarga_grid->id->Visible) { // id ?>
		<td data-name="id" <?php echo $peg_keluarga_grid->id->cellAttributes() ?>>
<?php if ($peg_keluarga->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_id" class="form-group"></span>
<input type="hidden" data-table="peg_keluarga" data-field="x_id" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_id" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_keluarga_grid->id->OldValue) ?>">
<?php } ?>
<?php if ($peg_keluarga->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_id" class="form-group">
<span<?php echo $peg_keluarga_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_keluarga_grid->id->EditValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_id" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_id" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_keluarga_grid->id->CurrentValue) ?>">
<?php } ?>
<?php if ($peg_keluarga->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_id">
<span<?php echo $peg_keluarga_grid->id->viewAttributes() ?>><?php echo $peg_keluarga_grid->id->getViewValue() ?></span>
</span>
<?php if (!$peg_keluarga->isConfirm()) { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_id" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_id" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_keluarga_grid->id->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_id" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_id" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_keluarga_grid->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_id" name="fpeg_keluargagrid$x<?php echo $peg_keluarga_grid->RowIndex ?>_id" id="fpeg_keluargagrid$x<?php echo $peg_keluarga_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_keluarga_grid->id->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_id" name="fpeg_keluargagrid$o<?php echo $peg_keluarga_grid->RowIndex ?>_id" id="fpeg_keluargagrid$o<?php echo $peg_keluarga_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_keluarga_grid->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_keluarga_grid->pid->Visible) { // pid ?>
		<td data-name="pid" <?php echo $peg_keluarga_grid->pid->cellAttributes() ?>>
<?php if ($peg_keluarga->RowType == ROWTYPE_ADD) { // Add record ?>
<?php if ($peg_keluarga_grid->pid->getSessionValue() != "") { ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_pid" class="form-group">
<span<?php echo $peg_keluarga_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_keluarga_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_keluarga_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_pid" class="form-group">
<input type="text" data-table="peg_keluarga" data-field="x_pid" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->pid->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->pid->EditValue ?>"<?php echo $peg_keluarga_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_pid" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_pid" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_keluarga_grid->pid->OldValue) ?>">
<?php } ?>
<?php if ($peg_keluarga->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php if ($peg_keluarga_grid->pid->getSessionValue() != "") { ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_pid" class="form-group">
<span<?php echo $peg_keluarga_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_keluarga_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_keluarga_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_pid" class="form-group">
<input type="text" data-table="peg_keluarga" data-field="x_pid" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->pid->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->pid->EditValue ?>"<?php echo $peg_keluarga_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($peg_keluarga->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_pid">
<span<?php echo $peg_keluarga_grid->pid->viewAttributes() ?>><?php echo $peg_keluarga_grid->pid->getViewValue() ?></span>
</span>
<?php if (!$peg_keluarga->isConfirm()) { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_pid" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_keluarga_grid->pid->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_pid" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_pid" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_keluarga_grid->pid->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_pid" name="fpeg_keluargagrid$x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" id="fpeg_keluargagrid$x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_keluarga_grid->pid->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_pid" name="fpeg_keluargagrid$o<?php echo $peg_keluarga_grid->RowIndex ?>_pid" id="fpeg_keluargagrid$o<?php echo $peg_keluarga_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_keluarga_grid->pid->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_keluarga_grid->nama->Visible) { // nama ?>
		<td data-name="nama" <?php echo $peg_keluarga_grid->nama->cellAttributes() ?>>
<?php if ($peg_keluarga->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_nama" class="form-group">
<input type="text" data-table="peg_keluarga" data-field="x_nama" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_nama" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->nama->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->nama->EditValue ?>"<?php echo $peg_keluarga_grid->nama->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_nama" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_nama" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($peg_keluarga_grid->nama->OldValue) ?>">
<?php } ?>
<?php if ($peg_keluarga->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_nama" class="form-group">
<input type="text" data-table="peg_keluarga" data-field="x_nama" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_nama" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->nama->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->nama->EditValue ?>"<?php echo $peg_keluarga_grid->nama->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_keluarga->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_nama">
<span<?php echo $peg_keluarga_grid->nama->viewAttributes() ?>><?php echo $peg_keluarga_grid->nama->getViewValue() ?></span>
</span>
<?php if (!$peg_keluarga->isConfirm()) { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_nama" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_nama" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($peg_keluarga_grid->nama->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_nama" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_nama" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($peg_keluarga_grid->nama->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_nama" name="fpeg_keluargagrid$x<?php echo $peg_keluarga_grid->RowIndex ?>_nama" id="fpeg_keluargagrid$x<?php echo $peg_keluarga_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($peg_keluarga_grid->nama->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_nama" name="fpeg_keluargagrid$o<?php echo $peg_keluarga_grid->RowIndex ?>_nama" id="fpeg_keluargagrid$o<?php echo $peg_keluarga_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($peg_keluarga_grid->nama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_keluarga_grid->hp->Visible) { // hp ?>
		<td data-name="hp" <?php echo $peg_keluarga_grid->hp->cellAttributes() ?>>
<?php if ($peg_keluarga->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_hp" class="form-group">
<input type="text" data-table="peg_keluarga" data-field="x_hp" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_hp" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_hp" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->hp->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->hp->EditValue ?>"<?php echo $peg_keluarga_grid->hp->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_hp" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_hp" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($peg_keluarga_grid->hp->OldValue) ?>">
<?php } ?>
<?php if ($peg_keluarga->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_hp" class="form-group">
<input type="text" data-table="peg_keluarga" data-field="x_hp" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_hp" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_hp" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->hp->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->hp->EditValue ?>"<?php echo $peg_keluarga_grid->hp->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_keluarga->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_hp">
<span<?php echo $peg_keluarga_grid->hp->viewAttributes() ?>><?php echo $peg_keluarga_grid->hp->getViewValue() ?></span>
</span>
<?php if (!$peg_keluarga->isConfirm()) { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_hp" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_hp" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($peg_keluarga_grid->hp->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_hp" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_hp" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($peg_keluarga_grid->hp->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_hp" name="fpeg_keluargagrid$x<?php echo $peg_keluarga_grid->RowIndex ?>_hp" id="fpeg_keluargagrid$x<?php echo $peg_keluarga_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($peg_keluarga_grid->hp->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_hp" name="fpeg_keluargagrid$o<?php echo $peg_keluarga_grid->RowIndex ?>_hp" id="fpeg_keluargagrid$o<?php echo $peg_keluarga_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($peg_keluarga_grid->hp->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_keluarga_grid->hubungan->Visible) { // hubungan ?>
		<td data-name="hubungan" <?php echo $peg_keluarga_grid->hubungan->cellAttributes() ?>>
<?php if ($peg_keluarga->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_hubungan" class="form-group">
<input type="text" data-table="peg_keluarga" data-field="x_hubungan" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->hubungan->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->hubungan->EditValue ?>"<?php echo $peg_keluarga_grid->hubungan->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_hubungan" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" value="<?php echo HtmlEncode($peg_keluarga_grid->hubungan->OldValue) ?>">
<?php } ?>
<?php if ($peg_keluarga->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_hubungan" class="form-group">
<input type="text" data-table="peg_keluarga" data-field="x_hubungan" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->hubungan->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->hubungan->EditValue ?>"<?php echo $peg_keluarga_grid->hubungan->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_keluarga->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_hubungan">
<span<?php echo $peg_keluarga_grid->hubungan->viewAttributes() ?>><?php echo $peg_keluarga_grid->hubungan->getViewValue() ?></span>
</span>
<?php if (!$peg_keluarga->isConfirm()) { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_hubungan" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" value="<?php echo HtmlEncode($peg_keluarga_grid->hubungan->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_hubungan" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" value="<?php echo HtmlEncode($peg_keluarga_grid->hubungan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_hubungan" name="fpeg_keluargagrid$x<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" id="fpeg_keluargagrid$x<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" value="<?php echo HtmlEncode($peg_keluarga_grid->hubungan->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_hubungan" name="fpeg_keluargagrid$o<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" id="fpeg_keluargagrid$o<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" value="<?php echo HtmlEncode($peg_keluarga_grid->hubungan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_keluarga_grid->tgl_lahir->Visible) { // tgl_lahir ?>
		<td data-name="tgl_lahir" <?php echo $peg_keluarga_grid->tgl_lahir->cellAttributes() ?>>
<?php if ($peg_keluarga->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_tgl_lahir" class="form-group">
<input type="text" data-table="peg_keluarga" data-field="x_tgl_lahir" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" maxlength="19" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->tgl_lahir->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->tgl_lahir->EditValue ?>"<?php echo $peg_keluarga_grid->tgl_lahir->editAttributes() ?>>
<?php if (!$peg_keluarga_grid->tgl_lahir->ReadOnly && !$peg_keluarga_grid->tgl_lahir->Disabled && !isset($peg_keluarga_grid->tgl_lahir->EditAttrs["readonly"]) && !isset($peg_keluarga_grid->tgl_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_keluargagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_keluargagrid", "x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_tgl_lahir" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" value="<?php echo HtmlEncode($peg_keluarga_grid->tgl_lahir->OldValue) ?>">
<?php } ?>
<?php if ($peg_keluarga->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_tgl_lahir" class="form-group">
<input type="text" data-table="peg_keluarga" data-field="x_tgl_lahir" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" maxlength="19" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->tgl_lahir->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->tgl_lahir->EditValue ?>"<?php echo $peg_keluarga_grid->tgl_lahir->editAttributes() ?>>
<?php if (!$peg_keluarga_grid->tgl_lahir->ReadOnly && !$peg_keluarga_grid->tgl_lahir->Disabled && !isset($peg_keluarga_grid->tgl_lahir->EditAttrs["readonly"]) && !isset($peg_keluarga_grid->tgl_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_keluargagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_keluargagrid", "x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($peg_keluarga->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_tgl_lahir">
<span<?php echo $peg_keluarga_grid->tgl_lahir->viewAttributes() ?>><?php echo $peg_keluarga_grid->tgl_lahir->getViewValue() ?></span>
</span>
<?php if (!$peg_keluarga->isConfirm()) { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_tgl_lahir" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" value="<?php echo HtmlEncode($peg_keluarga_grid->tgl_lahir->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_tgl_lahir" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" value="<?php echo HtmlEncode($peg_keluarga_grid->tgl_lahir->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_tgl_lahir" name="fpeg_keluargagrid$x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" id="fpeg_keluargagrid$x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" value="<?php echo HtmlEncode($peg_keluarga_grid->tgl_lahir->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_tgl_lahir" name="fpeg_keluargagrid$o<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" id="fpeg_keluargagrid$o<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" value="<?php echo HtmlEncode($peg_keluarga_grid->tgl_lahir->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($peg_keluarga_grid->jen_kel->Visible) { // jen_kel ?>
		<td data-name="jen_kel" <?php echo $peg_keluarga_grid->jen_kel->cellAttributes() ?>>
<?php if ($peg_keluarga->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_jen_kel" class="form-group">
<input type="text" data-table="peg_keluarga" data-field="x_jen_kel" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->jen_kel->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->jen_kel->EditValue ?>"<?php echo $peg_keluarga_grid->jen_kel->editAttributes() ?>>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_jen_kel" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" value="<?php echo HtmlEncode($peg_keluarga_grid->jen_kel->OldValue) ?>">
<?php } ?>
<?php if ($peg_keluarga->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_jen_kel" class="form-group">
<input type="text" data-table="peg_keluarga" data-field="x_jen_kel" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->jen_kel->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->jen_kel->EditValue ?>"<?php echo $peg_keluarga_grid->jen_kel->editAttributes() ?>>
</span>
<?php } ?>
<?php if ($peg_keluarga->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $peg_keluarga_grid->RowCount ?>_peg_keluarga_jen_kel">
<span<?php echo $peg_keluarga_grid->jen_kel->viewAttributes() ?>><?php echo $peg_keluarga_grid->jen_kel->getViewValue() ?></span>
</span>
<?php if (!$peg_keluarga->isConfirm()) { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_jen_kel" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" value="<?php echo HtmlEncode($peg_keluarga_grid->jen_kel->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_jen_kel" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" value="<?php echo HtmlEncode($peg_keluarga_grid->jen_kel->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_jen_kel" name="fpeg_keluargagrid$x<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" id="fpeg_keluargagrid$x<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" value="<?php echo HtmlEncode($peg_keluarga_grid->jen_kel->FormValue) ?>">
<input type="hidden" data-table="peg_keluarga" data-field="x_jen_kel" name="fpeg_keluargagrid$o<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" id="fpeg_keluargagrid$o<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" value="<?php echo HtmlEncode($peg_keluarga_grid->jen_kel->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$peg_keluarga_grid->ListOptions->render("body", "right", $peg_keluarga_grid->RowCount);
?>
	</tr>
<?php if ($peg_keluarga->RowType == ROWTYPE_ADD || $peg_keluarga->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fpeg_keluargagrid", "load"], function() {
	fpeg_keluargagrid.updateLists(<?php echo $peg_keluarga_grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if (!$peg_keluarga_grid->isGridAdd() || $peg_keluarga->CurrentMode == "copy")
		if (!$peg_keluarga_grid->Recordset->EOF)
			$peg_keluarga_grid->Recordset->moveNext();
}
?>
<?php
	if ($peg_keluarga->CurrentMode == "add" || $peg_keluarga->CurrentMode == "copy" || $peg_keluarga->CurrentMode == "edit") {
		$peg_keluarga_grid->RowIndex = '$rowindex$';
		$peg_keluarga_grid->loadRowValues();

		// Set row properties
		$peg_keluarga->resetAttributes();
		$peg_keluarga->RowAttrs->merge(["data-rowindex" => $peg_keluarga_grid->RowIndex, "id" => "r0_peg_keluarga", "data-rowtype" => ROWTYPE_ADD]);
		$peg_keluarga->RowAttrs->appendClass("ew-template");
		$peg_keluarga->RowType = ROWTYPE_ADD;

		// Render row
		$peg_keluarga_grid->renderRow();

		// Render list options
		$peg_keluarga_grid->renderListOptions();
		$peg_keluarga_grid->StartRowCount = 0;
?>
	<tr <?php echo $peg_keluarga->rowAttributes() ?>>
<?php

// Render list options (body, left)
$peg_keluarga_grid->ListOptions->render("body", "left", $peg_keluarga_grid->RowIndex);
?>
	<?php if ($peg_keluarga_grid->id->Visible) { // id ?>
		<td data-name="id">
<?php if (!$peg_keluarga->isConfirm()) { ?>
<span id="el$rowindex$_peg_keluarga_id" class="form-group peg_keluarga_id"></span>
<?php } else { ?>
<span id="el$rowindex$_peg_keluarga_id" class="form-group peg_keluarga_id">
<span<?php echo $peg_keluarga_grid->id->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_keluarga_grid->id->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_id" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_id" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_keluarga_grid->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_id" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_id" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_id" value="<?php echo HtmlEncode($peg_keluarga_grid->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_keluarga_grid->pid->Visible) { // pid ?>
		<td data-name="pid">
<?php if (!$peg_keluarga->isConfirm()) { ?>
<?php if ($peg_keluarga_grid->pid->getSessionValue() != "") { ?>
<span id="el$rowindex$_peg_keluarga_pid" class="form-group peg_keluarga_pid">
<span<?php echo $peg_keluarga_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_keluarga_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_keluarga_grid->pid->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_peg_keluarga_pid" class="form-group peg_keluarga_pid">
<input type="text" data-table="peg_keluarga" data-field="x_pid" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" size="30" maxlength="11" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->pid->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->pid->EditValue ?>"<?php echo $peg_keluarga_grid->pid->editAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_peg_keluarga_pid" class="form-group peg_keluarga_pid">
<span<?php echo $peg_keluarga_grid->pid->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_keluarga_grid->pid->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_pid" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_keluarga_grid->pid->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_pid" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_pid" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_pid" value="<?php echo HtmlEncode($peg_keluarga_grid->pid->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_keluarga_grid->nama->Visible) { // nama ?>
		<td data-name="nama">
<?php if (!$peg_keluarga->isConfirm()) { ?>
<span id="el$rowindex$_peg_keluarga_nama" class="form-group peg_keluarga_nama">
<input type="text" data-table="peg_keluarga" data-field="x_nama" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_nama" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_nama" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->nama->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->nama->EditValue ?>"<?php echo $peg_keluarga_grid->nama->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_keluarga_nama" class="form-group peg_keluarga_nama">
<span<?php echo $peg_keluarga_grid->nama->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_keluarga_grid->nama->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_nama" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_nama" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($peg_keluarga_grid->nama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_nama" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_nama" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_nama" value="<?php echo HtmlEncode($peg_keluarga_grid->nama->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_keluarga_grid->hp->Visible) { // hp ?>
		<td data-name="hp">
<?php if (!$peg_keluarga->isConfirm()) { ?>
<span id="el$rowindex$_peg_keluarga_hp" class="form-group peg_keluarga_hp">
<input type="text" data-table="peg_keluarga" data-field="x_hp" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_hp" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_hp" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->hp->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->hp->EditValue ?>"<?php echo $peg_keluarga_grid->hp->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_keluarga_hp" class="form-group peg_keluarga_hp">
<span<?php echo $peg_keluarga_grid->hp->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_keluarga_grid->hp->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_hp" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_hp" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($peg_keluarga_grid->hp->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_hp" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_hp" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_hp" value="<?php echo HtmlEncode($peg_keluarga_grid->hp->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_keluarga_grid->hubungan->Visible) { // hubungan ?>
		<td data-name="hubungan">
<?php if (!$peg_keluarga->isConfirm()) { ?>
<span id="el$rowindex$_peg_keluarga_hubungan" class="form-group peg_keluarga_hubungan">
<input type="text" data-table="peg_keluarga" data-field="x_hubungan" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->hubungan->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->hubungan->EditValue ?>"<?php echo $peg_keluarga_grid->hubungan->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_keluarga_hubungan" class="form-group peg_keluarga_hubungan">
<span<?php echo $peg_keluarga_grid->hubungan->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_keluarga_grid->hubungan->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_hubungan" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" value="<?php echo HtmlEncode($peg_keluarga_grid->hubungan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_hubungan" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_hubungan" value="<?php echo HtmlEncode($peg_keluarga_grid->hubungan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_keluarga_grid->tgl_lahir->Visible) { // tgl_lahir ?>
		<td data-name="tgl_lahir">
<?php if (!$peg_keluarga->isConfirm()) { ?>
<span id="el$rowindex$_peg_keluarga_tgl_lahir" class="form-group peg_keluarga_tgl_lahir">
<input type="text" data-table="peg_keluarga" data-field="x_tgl_lahir" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" maxlength="19" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->tgl_lahir->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->tgl_lahir->EditValue ?>"<?php echo $peg_keluarga_grid->tgl_lahir->editAttributes() ?>>
<?php if (!$peg_keluarga_grid->tgl_lahir->ReadOnly && !$peg_keluarga_grid->tgl_lahir->Disabled && !isset($peg_keluarga_grid->tgl_lahir->EditAttrs["readonly"]) && !isset($peg_keluarga_grid->tgl_lahir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fpeg_keluargagrid", "datetimepicker"], function() {
	ew.createDateTimePicker("fpeg_keluargagrid", "x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_keluarga_tgl_lahir" class="form-group peg_keluarga_tgl_lahir">
<span<?php echo $peg_keluarga_grid->tgl_lahir->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_keluarga_grid->tgl_lahir->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_tgl_lahir" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" value="<?php echo HtmlEncode($peg_keluarga_grid->tgl_lahir->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_tgl_lahir" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_tgl_lahir" value="<?php echo HtmlEncode($peg_keluarga_grid->tgl_lahir->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($peg_keluarga_grid->jen_kel->Visible) { // jen_kel ?>
		<td data-name="jen_kel">
<?php if (!$peg_keluarga->isConfirm()) { ?>
<span id="el$rowindex$_peg_keluarga_jen_kel" class="form-group peg_keluarga_jen_kel">
<input type="text" data-table="peg_keluarga" data-field="x_jen_kel" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" size="30" maxlength="255" placeholder="<?php echo HtmlEncode($peg_keluarga_grid->jen_kel->getPlaceHolder()) ?>" value="<?php echo $peg_keluarga_grid->jen_kel->EditValue ?>"<?php echo $peg_keluarga_grid->jen_kel->editAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_peg_keluarga_jen_kel" class="form-group peg_keluarga_jen_kel">
<span<?php echo $peg_keluarga_grid->jen_kel->viewAttributes() ?>><input type="text" readonly class="form-control-plaintext" value="<?php echo HtmlEncode(RemoveHtml($peg_keluarga_grid->jen_kel->ViewValue)) ?>"></span>
</span>
<input type="hidden" data-table="peg_keluarga" data-field="x_jen_kel" name="x<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" id="x<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" value="<?php echo HtmlEncode($peg_keluarga_grid->jen_kel->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="peg_keluarga" data-field="x_jen_kel" name="o<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" id="o<?php echo $peg_keluarga_grid->RowIndex ?>_jen_kel" value="<?php echo HtmlEncode($peg_keluarga_grid->jen_kel->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$peg_keluarga_grid->ListOptions->render("body", "right", $peg_keluarga_grid->RowIndex);
?>
<script>
loadjs.ready(["fpeg_keluargagrid", "load"], function() {
	fpeg_keluargagrid.updateLists(<?php echo $peg_keluarga_grid->RowIndex ?>);
});
</script>
	</tr>
<?php
	}
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($peg_keluarga->CurrentMode == "add" || $peg_keluarga->CurrentMode == "copy") { ?>
<input type="hidden" name="<?php echo $peg_keluarga_grid->FormKeyCountName ?>" id="<?php echo $peg_keluarga_grid->FormKeyCountName ?>" value="<?php echo $peg_keluarga_grid->KeyCount ?>">
<?php echo $peg_keluarga_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($peg_keluarga->CurrentMode == "edit") { ?>
<input type="hidden" name="<?php echo $peg_keluarga_grid->FormKeyCountName ?>" id="<?php echo $peg_keluarga_grid->FormKeyCountName ?>" value="<?php echo $peg_keluarga_grid->KeyCount ?>">
<?php echo $peg_keluarga_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($peg_keluarga->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fpeg_keluargagrid">
</div><!-- /.ew-list-form -->
<?php

// Close recordset
if ($peg_keluarga_grid->Recordset)
	$peg_keluarga_grid->Recordset->Close();
?>
<?php if ($peg_keluarga_grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $peg_keluarga_grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($peg_keluarga_grid->TotalRecords == 0 && !$peg_keluarga->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $peg_keluarga_grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$peg_keluarga_grid->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php
$peg_keluarga_grid->terminate();
?>